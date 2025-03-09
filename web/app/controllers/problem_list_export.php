<?php
requirePHPLib('form');

function queryProblemList($id) {
    return DB::selectFirst("SELECT pl.*, ui.username as creator_name 
                           FROM problem_lists pl 
                           JOIN user_info ui ON pl.creator_username = ui.username 
                           WHERE pl.id = {$id}");
}

if (!validateUInt($_GET['problem_list_id']) || !($problem_list = queryProblemList($_GET['problem_list_id']))) {
    become404Page();
}

// 检查权限
if (!isSuperUser($myUser)) {
    become403Page();
}

// 获取题单中的所有题目
$problems = DB::selectAll("
    SELECT problem_id, order_num 
    FROM problem_list_problems 
    WHERE list_id = {$problem_list['id']} 
    ORDER BY order_num
");

// 获取已报名的用户
$users = DB::selectAll("
  SELECT 
    u.username,
    u.sid,
    u.jid,
    plr.class,
    plr.real_name,
    plr.register_time
  FROM user_info u
  JOIN problem_list_registrants plr ON u.username = plr.username 
  WHERE plr.list_id = {$problem_list['id']}
  ORDER BY plr.class ASC, u.jid ASC
");

// 获取每个用户的完成情况
foreach ($users as &$user) {
    // 获取用户完成的题目ID列表
    $solved_problems = DB::selectAll("
        SELECT DISTINCT problem_id 
        FROM best_ac_submissions 
        WHERE submitter = :username
        AND problem_id IN (
            SELECT problem_id 
            FROM problem_list_problems 
            WHERE list_id = {$problem_list['id']}
        )
    ", array('username' => $user['username']));
    
    // 记录每道题的完成情况
    $user['solved_problems'] = array();
    foreach ($problems as $problem) {
        $is_solved = false;
        foreach ($solved_problems as $solved) {
            if ($solved['problem_id'] == $problem['problem_id']) {
                $is_solved = true;
                break;
            }
        }
        $user['solved_problems'][$problem['problem_id']] = $is_solved;
    }
    
    $user['solved_count'] = count($solved_problems);
}

// 解析班级信息
function parseClassInfo($sid) {
    $grade = substr($sid, 0, 2);
    $major = substr($sid, 2, 1);
    $class = substr($sid, 3, 1);
    $number = substr($sid, 4, 2);
    return [
        'grade' => $grade,
        'major' => $major,
        'class' => $class,
        'number' => $number,
        'full_class' => $grade . $major . $class
    ];
}

// 修改表格展示逻辑
if ($_GET['type'] === 'count') {
    usort($users, function($a, $b) {
        if ($a['solved_count'] != $b['solved_count']) {
            return $b['solved_count'] - $a['solved_count'];
        }
        return strcmp($a['jid'], $b['jid']);
    });
} else if ($_GET['type'] === 'class') {
    usort($users, function($a, $b) {
        return strcmp($a['jid'], $b['jid']);
    });
}

// 生成表格
$html = '<div class="table-responsive">';
$html .= '<table class="table table-bordered table-hover table-striped">';
$html .= '<thead><tr>';
$html .= '<th>班级</th>';
$html .= '<th>学号</th>';
$html .= '<th>姓名</th>';
$html .= '<th>号数</th>';
$html .= '<th>完成数</th>';

// 添加每个题目的列
foreach ($problems as $problem) {
    $html .= '<th>P' . $problem['problem_id'] . '</th>';
}

$html .= '</tr></thead><tbody>';

foreach ($users as $user) {
    $html .= '<tr>';
    $html .= '<td>' . htmlspecialchars($user['class']) . '</td>';
    $html .= '<td>' . htmlspecialchars($user['sid']) . '</td>';
    $html .= '<td>' . htmlspecialchars($user['real_name']) . '</td>';
    $html .= '<td>' . substr($user['jid'], -2) . '</td>';
    $html .= '<td>' . $user['solved_count'] . '</td>';
    
    // 显示每题完成情况
    foreach ($problems as $problem) {
        $status = $user['solved_problems'][$problem['problem_id']] ? '✓' : '✗';
        $color = $user['solved_problems'][$problem['problem_id']] ? 'success' : 'danger';
        $html .= '<td class="text-' . $color . '">' . $status . '</td>';
    }
    
    $html .= '</tr>';
}

$html .= '</tbody></table></div>';

?>

<?php echoUOJPageHeader('导出题单完成情况 - ' . $problem_list['name']) ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h2 class="panel-title"><?= $problem_list['name'] ?> - 完成情况</h2>
    </div>
    <div class="panel-body">
        <?= $html ?>
    </div>
</div>
<?php echoUOJPageFooter() ?> 