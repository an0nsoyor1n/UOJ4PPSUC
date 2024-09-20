<?php
define("CONTEST_NOT_STARTED", 0);
define("CONTEST_IN_PROGRESS", 1);
define("CONTEST_PENDING_FINAL_TEST", 2);
define("CONTEST_TESTING", 10);
define("CONTEST_FINISHED", 20);	

function calcRating($standings, $K = 400) {
	$DELTA = 500;

	$n = count($standings);
	
	$rating = array();
	for ($i = 0; $i < $n; ++$i) {
		$rating[$i] = $standings[$i][2][1];
	}
	
	$rank = array();
	$foot = array();
	for ($i = 0; $i < $n; ) {
		$j = $i;
		while ($j + 1 < $n && $standings[$j + 1][3] == $standings[$j][3]) {
			++$j;
		}
		$our_rk = 0.5 * (($i + 1) + ($j + 1));
		while ($i <= $j) {
			$rank[$i] = $our_rk;
			$foot[$i] = $n - $rank[$i];
			$i++;
		}
	}
	
	$weight = array();
	for ($i = 0; $i < $n; ++$i) {
		$weight[$i] = pow(7, $rating[$i] / $DELTA);
	}
	$exp = array_fill(0, $n, 0);
	for ($i = 0; $i < $n; ++$i) {
		for ($j = 0; $j < $n; ++$j) {
			if ($j != $i) {
				$exp[$i] += $weight[$i] / ($weight[$i] + $weight[$j]);
			}
		}
	}
	
	$new_rating = array();
	for ($i = 0; $i < $n; $i++) {
		$new_rating[$i] = $rating[$i];
		$new_rating[$i] += ceil($K * ($foot[$i] - $exp[$i]) / ($n - 1));
	}
	
	for ($i = $n - 1; $i >= 0; $i--) {
		if ($i + 1 < $n && $standings[$i][3] != $standings[$i + 1][3]) {
			break;
		}
		if ($new_rating[$i] > $rating[$i]) {
			$new_rating[$i] = $rating[$i];
		}
	}
	
	for ($i = 0; $i < $n; $i++) {
		if ($new_rating[$i] < 0) {
			$new_rating[$i] = 0;
		}
	}
	
	return $new_rating;
}

function calcRatingSelfTest() {
	$tests = [
		[[1500, 1], [1500, 1]],
		[[1500, 1], [1600, 1]],
		[[1500, 1], [1600, 2], [1600, 2]],
		[[1500, 1], [200, 2], [100, 2]],
		[[1500, 1], [100, 2], [200, 2]],
		[[1500, 1], [100, 2], [200, 3]],
		[[1500, 1], [200, 2], [100, 3]],
		[[1500, 1], [3000, 2], [1500, 3]],
		[[1500, 1], [3000, 2], [1500, 3], [1500, 3]],
		[[1500, 1], [1500, 2], [1500, 3], [3000, 4]],
		[[1500, 1], [1500, 2], [10, 3], [1, 4]]
	];
	foreach ($tests as $test_num => $test) {
		print "test #{$test_num}\n";
		
		$standings = array();
		$n = count($test);
		for ($i = 0; $i < $n; $i++) {
			$standings[] = [0, 0, [(string)$i, $test[$i][0]], $test[$i][1]];
		}
		$new_rating = calcRating($standings);
		
		for ($i = 0; $i < $n; $i++) {
			printf("%3d: %4d -> %4d delta: %+4d\n", $test[$i][1], $test[$i][0], $new_rating[$i], $new_rating[$i] - $test[$i][0]);
		}
		print "\n";
	}
}

function genMoreContestInfo(&$contest) {
	$contest['start_time_str'] = $contest['start_time'];
	$contest['start_time'] = new DateTime($contest['start_time']);
	$contest['end_time'] = clone $contest['start_time'];
	$contest['end_time']->add(new DateInterval("PT${contest['last_min']}M"));
	
	if ($contest['status'] == 'unfinished') {
		if (UOJTime::$time_now < $contest['start_time']) {
			$contest['cur_progress'] = CONTEST_NOT_STARTED;
		} elseif (UOJTime::$time_now < $contest['end_time']) {
			$contest['cur_progress'] = CONTEST_IN_PROGRESS;
		} else {
			$contest['cur_progress'] = CONTEST_PENDING_FINAL_TEST;
		}
	} elseif ($contest['status'] == 'testing') {
		$contest['cur_progress'] = CONTEST_TESTING;
	} elseif ($contest['status'] == 'finished') {
		$contest['cur_progress'] = CONTEST_FINISHED;
	}
	$contest['extra_config'] = json_decode($contest['extra_config'], true);
	
	if (!isset($contest['extra_config']['standings_version'])) {
		$contest['extra_config']['standings_version'] = 2;
	}
}

function updateContestPlayerNum($contest) {
	DB::update("update contests set player_num = (select count(*) from contests_registrants where contest_id = {$contest['id']}) where id = {$contest['id']}");
}

// problems: pos => id
// data    : id, submit_time, submitter, problem_pos, score
// people  : username, user_rating
function queryContestData($contest, $config = array()) {
	mergeConfig($config, [
		'pre_final' => false
	]);
	
	$problems = [];
	$prob_pos = [];
	$n_problems = 0;
	$result = DB::query("select problem_id from contests_problems where contest_id = {$contest['id']} order by problem_id");
	while ($row = DB::fetch($result, MYSQLI_NUM)) {
		$prob_pos[$problems[] = (int)$row[0]] = $n_problems++;
	}

	$data = [];
	if ($config['pre_final']) {
		$result = DB::query("select id, submit_time, submitter, problem_id, result from submissions"
				." where contest_id = {$contest['id']} and score is not null order by id");
		while ($row = DB::fetch($result, MYSQLI_NUM)) {
			$r = json_decode($row[4], true);
			if (!isset($r['final_result'])) {
				continue;
			}
			$row[0] = (int)$row[0];
			$row[3] = $prob_pos[$row[3]];
			$row[4] = (int)($r['final_result']['score']);
			$data[] = $row;
		}
	} else {
		if ($contest['cur_progress'] < CONTEST_FINISHED) {
			$result = DB::query("select id, submit_time, submitter, problem_id, score from submissions"
				." where contest_id = {$contest['id']} and score is not null order by id");
		} else {
			$result = DB::query("select submission_id, date_add('{$contest['start_time_str']}', interval penalty second),"
				." submitter, problem_id, score from contests_submissions where contest_id = {$contest['id']}");
		}
		while ($row = DB::fetch($result, MYSQLI_NUM)) {
			$row[0] = (int)$row[0];
			$row[3] = $prob_pos[$row[3]];
			$row[4] = (int)$row[4];
			$data[] = $row;
		}
	}

	$people = [];
	$result = DB::query("select username, user_rating from contests_registrants where contest_id = {$contest['id']} and has_participated = 1");
	while ($row = DB::fetch($result, MYSQLI_NUM)) {
		$row[1] = (int)$row[1];
		$people[] = $row;
	}

	return ['problems' => $problems, 'data' => $data, 'people' => $people];
}

function calcStandings($contest, $contest_data, &$score, &$standings, $update_contests_submissions = false) {
	// score: username, problem_pos => score, penalty, id
	/*
	`calcStandings` 函数中生成的 `$standings` 数组的结构如下：

		### `$standings` 数组结构

		每个元素代表一个参赛者的排名信息，数组的结构为：

		```php
		$standings = [
			[
				总得分,          // int: 参赛者的总得分
				总罚时,          // int: 参赛者的总罚时
				[用户名, 用户评级], // array: 包含用户名和用户评级的数组
				虚拟排名         // int: 参赛者的排名
			],
			// ... 其他参赛者的排名信息
		];
		```

		### 示例

		假设有三个参赛者，`Alice`、`Bob` 和 `Charlie`，他们的得分和罚时如下：

		- Alice: 得分 300，罚时 10，评级 1500
		- Bob: 得分 300，罚时 5，评级 1600
		- Charlie: 得分 250，罚时 20，评级 1400

		经过计算，`$standings` 数组可能会是这样的：

		```php
		$standings = [
			[300, 5, ['Bob', 1600], 1],      // Bob: 得分 300, 罚时 5, 排名 1
			[300, 10, ['Alice', 1500], 1],   // Alice: 得分 300, 罚时 10, 排名 1 (与 Bob 同分)
			[250, 20, ['Charlie', 1400], 3]  // Charlie: 得分 250, 罚时 20, 排名 3
		];
		```

		### 说明
		- **总得分**：参赛者在比赛中获得的总分数。
		- **总罚时**：参赛者在比赛中因提交错误或其他原因而产生的总罚时。
		- **[用户名, 用户评级]**：一个数组，包含参赛者的用户名和其评级。
		- **虚拟排名**：根据得分和罚时计算出的排名，可能会有相同的排名（例如，得分相同的参赛者）。
	*/
	$score = array();
	$n_people = count($contest_data['people']);
	$n_problems = count($contest_data['problems']);
	foreach ($contest_data['people'] as $person) {
		$score[$person[0]] = array();
	}
	foreach ($contest_data['data'] as $submission) {
		$penalty = (new DateTime($submission[1]))->getTimestamp() - $contest['start_time']->getTimestamp();
		if ($contest['extra_config']['standings_version'] >= 2) {
			if ($submission[4] == 0) {
				$penalty = 0;
			}
		}
		$score[$submission[2]][$submission[3]] = array($submission[4], $penalty, $submission[0]);
	}

	// standings: rank => score, penalty, [username, user_rating], virtual_rank
	$standings = array();
	foreach ($contest_data['people'] as $person) {

		$usr = queryUser($person[0]);
		//echo "usr: " . json_encode($usr) . "\n";
		
		// 添加学号、JID 和班级信息
		
		$sid = $usr['sid']; // 学号
		$jh = $usr['jid']; // Jing号
		$cla = $usr['class']; // 班级
		$cur = array(0, 0, $person, $sid, $jh, $cla);
		

		/*$cur = array(0, 0, $person);*/
		// debug: show $person
		//echo "person: " . json_encode($person) . "\n";
		//echo "cur: " . json_encode($cur) . "\n";
		for ($i = 0; $i < $n_problems; $i++) {
			if (isset($score[$person[0]][$i])) {
				$cur_row = $score[$person[0]][$i];
				$cur[0] += $cur_row[0];
				$cur[1] += $cur_row[1];
				if ($update_contests_submissions) {
					DB::insert("insert into contests_submissions (contest_id, submitter, problem_id, submission_id, score, penalty) values ({$contest['id']}, '{$person[0]}', {$contest_data['problems'][$i]}, {$cur_row[2]}, {$cur_row[0]}, {$cur_row[1]})");
				}
			}
			//echo "cur: " . json_encode($cur) . "\n";
		}
		
		
		
		// debug: show $cur
		//echo "cur: " . json_encode($cur) . "\n";
		//echo "sid: " . json_encode($usr[$person[0]]['sid'];) . "\n";

		$standings[] = $cur;
	}

	// 对 $standings 数组进行排序
	usort($standings, function($lhs, $rhs) {
		// 首先按总得分降序排序
		if ($lhs[0] != $rhs[0]) {
			return $rhs[0] - $lhs[0]; // 得分高的排在前面
		} 
		// 如果总得分相同，则按总罚时升序排序
		elseif ($lhs[1] != $rhs[1]) {
			return $lhs[1] - $rhs[1]; // 罚时少的排在前面
		} 
		// 如果总得分和总罚时都相同，则按用户名字母顺序排序
		else {
			return strcmp($lhs[2][0], $rhs[2][0]); // 按用户名的字母顺序排序
		}
	});

	// echo "standings: " . json_encode($standings) . "\n";

	// 定义一个函数，用于判断两个参赛者是否具有相同的排名
	$is_same_rank = function($lhs, $rhs) {
		return $lhs[0] == $rhs[0] && $lhs[1] == $rhs[1]; // 比较总得分和总罚时
	};

	// 遍历每个参赛者以分配排名
	for ($i = 0; $i < $n_people; $i++) {
		// 如果是第一个参赛者，或者当前参赛者与前一个参赛者的排名不同
		if ($i == 0 || !$is_same_rank($standings[$i - 1], $standings[$i])) {
			$standings[$i][] = $i + 1; // 分配当前排名
		} else {
			// 如果当前参赛者与前一个参赛者排名相同，则共享前一个参赛者的排名
			$standings[$i][] = $standings[$i - 1][6]; // 使用前一个参赛者的排名
		}
	}
	//echo "standings: " . json_encode($standings) . "\n";
}
