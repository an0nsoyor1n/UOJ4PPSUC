<?php
// 加载必要的库和函数
requirePHPLib('form');

// 检查参数
if (!isset($_GET['id']) || !validateUInt($_GET['id'])) {
    become404Page();
}

$problem_list_id = $_GET['id'];
$export_type = isset($_GET['type']) ? $_GET['type'] : 'default';

// 获取题单信息
$problem_list = DB::selectFirst("SELECT * FROM problem_lists WHERE id = {$problem_list_id}");
if (!$problem_list) {
    become404Page();
}

// 检查权限
$user = Auth::user();
if (!$user || (!isSuperUser($user) && $problem_list['owner'] != $user['username'])) {
    become403Page();
}

// 获取题目列表
$problems = DB::selectAll("
    SELECT p.*, plp.order_index 
    FROM problems p
    JOIN problem_list_problems plp ON p.id = plp.problem_id
    WHERE plp.problem_list_id = {$problem_list_id}
    ORDER BY plp.order_index
");

// 获取参与者列表
if ($export_type == 'class') {
    // 班级视图 - 获取所有班级学生
    $participants = DB::selectAll("
        SELECT u.username, u.realname 
        FROM user_info u
        JOIN problem_list_participants plp ON u.username = plp.username
        WHERE plp.problem_list_id = {$problem_list_id}
        ORDER BY u.username
    ");
} else {
    // 默认视图 - 获取所有提交过该题单题目的用户
    $participants = DB::selectAll("
        SELECT DISTINCT u.username, u.realname 
        FROM user_info u
        JOIN submissions s ON u.username = s.submitter
        JOIN problem_list_problems plp ON s.problem_id = plp.problem_id
        WHERE plp.problem_list_id = {$problem_list_id}
        ORDER BY u.username
    ");
}

// 创建CSV数据
$filename = "题单_{$problem_list_id}_{$problem_list['name']}_成绩表.csv";
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

// 写入标题行
$header = ['学号/用户名', '姓名'];
foreach ($problems as $problem) {
    $header[] = "P{$problem['id']} - {$problem['title']}";
}
$header[] = '完成数';
$header[] = '完成率';

fputcsv($output, $header);

// 写入学生数据
foreach ($participants as $participant) {
    $row = [$participant['username'], $participant['realname'] ?? $participant['username']];
    
    // 初始化计数器
    $completed = 0;
    $total = count($problems);
    
    // 填充每个题目的完成情况
    foreach ($problems as $problem) {
        // 查询最高分提交
        $submission = DB::selectFirst("
            SELECT score, status 
            FROM submissions 
            WHERE submitter = '{$participant['username']}' 
            AND problem_id = {$problem['id']}
            ORDER BY score DESC, submit_time DESC 
            LIMIT 1
        ");
        
        if ($submission) {
            if ($submission['status'] == 'Accepted') {
                $row[] = '100';
                $completed++;
            } else {
                $row[] = $submission['score'];
                if ($submission['score'] >= 100) {
                    $completed++;
                }
            }
        } else {
            $row[] = '0';
        }
    }
    
    // 添加统计数据
    $row[] = $completed;
    $row[] = $total > 0 ? round(($completed / $total) * 100, 2) . '%' : '0%';
    
    fputcsv($output, $row);
}

fclose($output);
exit;
?> 