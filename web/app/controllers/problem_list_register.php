<?php

function getClassFromJid($jid) {
    $grade = substr($jid, 0, 2);
    $majorCode = substr($jid, 2, 1);
    $class = substr($jid, 3, 1);
    
    $majorName = array(
        'Q' => '数据警务技术',
        'S' => '公安视听技术',
        'E' => '安全防范工程',
        'M' => '网络安全与执法'
    );
    
    if (!isset($majorName[$majorCode])) {
        return null;
    }
    
    return $grade . $majorName[$majorCode] . $class . '班';
}

// 在注册题单时
if (isset($_POST['register'])) {
    // ... 其他验证逻辑 ...
    
    $user_info = queryUser($_POST['username']);
    $class = getClassFromJid($user_info['jid']);
    
    $succ = DB::insert("insert into problem_list_registrants (
        list_id, username, real_name, class, register_time
    ) values (
        {$problem_list['id']}, 
        '{$_POST['username']}',
        '{$_POST['real_name']}',
        '{$class}',
        NOW()
    )");
    
    if ($succ) {
        // ... 成功处理逻辑 ...
    }
} 