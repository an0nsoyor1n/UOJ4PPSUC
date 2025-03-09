<?php
// 检查参数
if (!isset($_GET['problem_list_id']) || !validateUInt($_GET['problem_list_id'])) {
    become404Page();
}

$problem_list_id = $_GET['problem_list_id'];
$export_type = isset($_GET['type']) ? $_GET['type'] : 'default';

// 获取题单信息
$problem_list = DB::selectFirst("SELECT * FROM problem_lists WHERE id = {$problem_list_id}");
if (!$problem_list) {
    become404Page();
}

// 检查权限
$myUser = Auth::user();
if (!$myUser || (!isSuperUser($myUser) && $problem_list['creator_username'] != $myUser['username'])) {
    become403Page();
}

// 获取题目列表
$problems = DB::selectAll("
    SELECT p.*, plp.problem_id, plp.order_num  
    FROM problems p
    JOIN problem_list_problems plp ON p.id = plp.problem_id
    WHERE plp.list_id = {$problem_list_id}
    ORDER BY plp.order_num
");

// 获取用户列表
if ($export_type === 'class') {
    $users = DB::selectAll("
        SELECT u.username, u.realname, u.jid, u.sid  
        FROM user_info u
        JOIN problem_list_participants plp ON u.username = plp.username
        WHERE plp.list_id = {$problem_list_id}
        ORDER BY u.sid
    ");
} else { // 'count' 或默认
    $users = DB::selectAll("
        SELECT u.username, u.realname, u.jid, u.sid  
        FROM user_info u
        JOIN problem_list_participants plp ON u.username = plp.username
        WHERE plp.list_id = {$problem_list_id}
        ORDER BY u.sid
    ");
}

// 获取每个用户的题目完成情况
foreach ($users as &$user) {
    // 获取用户完成的题目ID列表
    $solved_problems = DB::selectAll("
        SELECT DISTINCT problem_id 
        FROM best_ac_submissions 
        WHERE submitter = :username
        AND problem_id IN (
            SELECT problem_id 
            FROM problem_list_problems 
            WHERE list_id = {$problem_list_id}
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

// 处理排序
if ($export_type === 'count') {
    usort($users, function($a, $b) {
        if ($a['solved_count'] != $b['solved_count']) {
            return $b['solved_count'] - $a['solved_count'];
        }
        return strcmp($a['jid'], $b['jid']);
    });
} else if ($export_type === 'class') {
    usort($users, function($a, $b) {
        return strcmp($a['jid'], $b['jid']);
    });
}

// 准备CSV数据
$filename = "题单_{$problem_list_id}_{$problem_list['name']}_" . date('Y-m-d') . ".csv";
$filename = preg_replace('/[\/\\\:*?"<>|]/', '_', $filename);

// 设置HTTP头，触发下载
header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Pragma: no-cache');
header('Expires: 0');

// 创建输出流
$output = fopen('php://output', 'w');

// 输出UTF-8 BOM，确保Excel正确识别中文
fputs($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

// 准备表头
$header = ['班级', '学号', '姓名', '号数', '完成数'];
foreach ($problems as $problem) {
    $header[] = "P{$problem['problem_id']}";
}

fputcsv($output, $header);

// 输出数据行
foreach ($users as $user) {
    // 解析班级信息
    $classInfo = parseClassInfo($user['sid']);
    
    $row = [
        $classInfo['full_class'],
        $user['sid'],
        $user['realname'],
        $classInfo['number'],
        $user['solved_count']
    ];
    
    // 添加每道题的完成情况
    foreach ($problems as $problem) {
        $row[] = $user['solved_problems'][$problem['problem_id']] ? '100' : '0';
    }
    
    fputcsv($output, $row);
}

// 定义从学号解析班级信息的函数
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

fclose($output);
exit;
?> 