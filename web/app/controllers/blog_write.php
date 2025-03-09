<?php
requirePHPLib('form');

// 添加调试输出
error_log("博客写作控制器被加载");
error_log("REQUEST_URI: " . $_SERVER['REQUEST_URI']);
error_log("博客用户名: " . (isset($_GET['blog_username']) ? $_GET['blog_username'] : '未设置'));

// 最简单的测试输出
echo <<<HTML
<!DOCTYPE html>
<html>
<head>
    <title>博客写作测试页面</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>博客写作测试页面</h1>
    <p>如果您看到此页面，表示博客路由已经成功。</p>
    <p>博客用户名: {$_GET['blog_username']}</p>
    <p>当前时间: <?= date('Y-m-d H:i:s') ?></p>
</body>
</html>
HTML;
?> 