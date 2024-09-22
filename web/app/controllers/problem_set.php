<?php
	requirePHPLib('form');
	requirePHPLib('judger');
	requirePHPLib('data');
	
	if (isSuperUser($myUser)) {
		$new_problem_form = new UOJForm('new_problem');
		$new_problem_form->handle = function() {
			DB::query("insert into problems (title, is_hidden, submission_requirement) values ('New Problem', 1, '{}')");
			$id = DB::insert_id();
			DB::query("insert into problems_contents (id, statement, statement_md) values ($id, '', '')");
			dataNewProblem($id);
		};
		$new_problem_form->submit_button_config['align'] = 'right';
		$new_problem_form->submit_button_config['class_str'] = 'btn btn-primary';
		$new_problem_form->submit_button_config['text'] = UOJLocale::get('problems::add new');
		$new_problem_form->submit_button_config['smart_confirm'] = '';
		
		$new_problem_form->runAtServer();
	}
	
	function echoProblem($problem) {
		global $myUser;
		if (isProblemVisibleToUser($problem, $myUser)) {
			echo '<tr class="text-center">';
			if ($problem['submission_id']) {
				echo '<td class="table-success">';
			} else {
				echo '<td>';
			}
			echo '#', $problem['id'], '</td>';
			echo '<td class="text-left">';
			if ($problem['is_hidden']) {
				echo ' <span class="text-danger">[隐藏]</span> ';
			}
			echo '<a href="/problem/', $problem['id'], '">', $problem['title'], '</a>';
			if (isset($_COOKIE['show_tags_mode'])) {
				foreach (queryProblemTags($problem['id']) as $tag) {
					echo '<a class="uoj-problem-tag">', '<span class="badge badge-pill badge-secondary">', HTML::escape($tag), '</span>', '</a>';
				}
			}
			echo '</td>';
			if (isset($_COOKIE['show_submit_mode'])) {
				$perc = $problem['submit_num'] > 0 ? round(100 * $problem['ac_num'] / $problem['submit_num']) : 0;
				echo <<<EOD
				<td><a href="/submissions?problem_id={$problem['id']}&min_score=100&max_score=100">&times;{$problem['ac_num']}</a></td>
				<td><a href="/submissions?problem_id={$problem['id']}">&times;{$problem['submit_num']}</a></td>
				<td>
					<div class="progress bot-buffer-no">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="$perc" aria-valuemin="0" aria-valuemax="100" style="width: $perc%; min-width: 20px;">{$perc}%</div>
					</div>
				</td>
EOD;
			}
			echo '<td class="text-left">', getClickZanBlock('P', $problem['id'], $problem['zan']), '</td>';
			echo '</tr>';
		}
	}
	
	$cond = array();
	
	$search_tag = null;
	
	$cur_tab = isset($_GET['tab']) ? $_GET['tab'] : 'all';
	if ($cur_tab == 'template') {
		$search_tag = "模板题";
	}
	if ($cur_tab == 'basic_grammar') {
		$search_tag = "基础语法";
	}
	if ($cur_tab == 'data_structure') {
		$search_tag = "数据结构";
	}
	if (isset($_GET['tag'])) {
		$search_tag = $_GET['tag'];
	}
	if ($search_tag) {
		$cond[] = "'".DB::escape($search_tag)."' in (select tag from problems_tags where problems_tags.problem_id = problems.id)";
	}
	if (isset($_GET["search"])) {
		$cond[]="title like '%".DB::escape($_GET["search"])."%' or id like '%".DB::escape($_GET["search"])."%'";
	}
	
	if ($cond) {
		$cond = join($cond, ' and ');
	} else {
		$cond = '1';
	}
	
	$header = '<tr>';
	$header .= '<th class="text-center" style="width:5em;">ID</th>';
	$header .= '<th>'.UOJLocale::get('problems::problem').'</th>';
	if (isset($_COOKIE['show_submit_mode'])) {
		$header .= '<th class="text-center" style="width:5em;">'.UOJLocale::get('problems::ac').'</th>';
		$header .= '<th class="text-center" style="width:5em;">'.UOJLocale::get('problems::submit').'</th>';
		$header .= '<th class="text-center" style="width:150px;">'.UOJLocale::get('problems::ac rate').'</th>';
	}
	$header .= '<th class="text-center" style="width:180px;">'.UOJLocale::get('appraisal').'</th>';
	$header .= '</tr>';
	
	$tabs_info = array(
		'all' => array(
			'name' => UOJLocale::get('problems::all problems'),
			'url' => "/problems"
		),
		'template' => array(
			'name' => UOJLocale::get('problems::template problems'),
			'url' => "/problems/template"
		),
		'basic_grammar' => array(
			'name' => UOJLocale::get('problems::basic grammar'),
			'url' => "/problems/basic_grammar"
		),
		'data_structure' => array(
			'name' => UOJLocale::get('problems::data structure'),
			'url' => "/problems/data_structure"
		)
	);
	
	/*
	<?php
	echoLongTable(array('*'),
		"problems left join best_ac_submissions on best_ac_submissions.submitter = '{$myUser['username']}' and problems.id = best_ac_submissions.problem_id", $cond, 'order by id asc',
		$header,
		'echoProblem',
		array('page_len' => 3,
			'table_classes' => array('table', 'table-bordered', 'table-hover', 'table-striped'),
			'print_after_table' => function() {
				global $myUser;
				if (isSuperUser($myUser)) {
					global $new_problem_form;
					$new_problem_form->printHTML();
				}
			},
			'head_pagination' => true
		)
	);
?>*/

	$pag_config = array('page_len' => 100);
	$pag_config['col_names'] = array('*');
	$pag_config['table_name'] = "problems left join best_ac_submissions on best_ac_submissions.submitter = '{$myUser['username']}' and problems.id = best_ac_submissions.problem_id";
	$pag_config['cond'] = $cond;
	$pag_config['tail'] = "order by id asc";
	$pag = new Paginator($pag_config);

	$div_classes = array('table-responsive');
	$table_classes = array('table', 'table-bordered', 'table-hover', 'table-striped');
?>
<?php echoUOJPageHeader(UOJLocale::get('problems')) ?>
<div class='shadow-lg rounded' style='padding: 20px;'>
	<div class="row">
		<div class="col-sm-4">
			<?= HTML::tablist($tabs_info, $cur_tab, 'nav-pills') ?> <!-- 显示标签列表 -->
		</div>
		<div class="col-sm-4 order-sm-9 checkbox text-right">
			<label class="checkbox-inline" for="input-show_tags_mode"><input type="checkbox" id="input-show_tags_mode" <?= isset($_COOKIE['show_tags_mode']) ? 'checked="checked" ': ''?>/> <?= UOJLocale::get('problems::show tags') ?></label> <!-- 显示标签的复选框 -->
			<label class="checkbox-inline" for="input-show_submit_mode"><input type="checkbox" id="input-show_submit_mode" <?= isset($_COOKIE['show_submit_mode']) ? 'checked="checked" ': ''?>/> <?= UOJLocale::get('problems::show statistics') ?></label> <!-- 显示统计信息的复选框 -->
		</div>
		<div class="col-sm-4 order-sm-5">
		<?php echo $pag->pagination(); ?> <!-- 显示分页 -->
		</div>
	</div>

	<div class="top-buffer-sm"></div>

	<script type="text/javascript">
	$('#input-show_tags_mode').click(function() { // 标签模式复选框点击事件
		if (this.checked) {
			$.cookie('show_tags_mode', '', {path: '/problems'}); // 设置cookie以显示标签
		} else {
			$.removeCookie('show_tags_mode', {path: '/problems'}); // 移除cookie以隐藏标签
		}
		location.reload(); // 刷新页面
	});
	$('#input-show_submit_mode').click(function() { // 提交模式复选框点击事件
		if (this.checked) {
			$.cookie('show_submit_mode', '', {path: '/problems'}); // 设置cookie以显示统计
		} else {
			$.removeCookie('show_submit_mode', {path: '/problems'}); // 移除cookie以隐藏统计
		}
		location.reload(); // 刷新页面
	});
	</script>
	<?php
		echo '<div class="', join($div_classes, ' '), '">'; // 创建表格容器
		echo '<table class="', join($table_classes, ' '), '">'; // 创建表格
		echo '<thead>';
		echo $header; // 输出表头
		echo '</thead>';
		echo '<tbody>';

		foreach ($pag->get() as $idx => $row) { // 遍历分页数据
			echoProblem($row); // 输出每个问题
			echo "\n";
		}
		if ($pag->isEmpty()) {
			echo '<tr><td class="text-center" colspan="233">'.UOJLocale::get('none').'</td></tr>'; // 如果没有数据，显示无内容提示
		}

		echo '</tbody>';
		echo '</table>';
		echo '</div>';

		if (isSuperUser($myUser)) {
			$new_problem_form->printHTML(); // 如果是超级用户，显示新问题表单
		}

		echo $pag->pagination(); // 输出分页
	?>
</div>
<?php echoUOJPageFooter() ?>
