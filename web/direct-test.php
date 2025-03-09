<?php
// 直接测试文件 - 不经过路由系统
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>直接测试页面</h1>";
echo "<p>时间戳：" . time() . "</p>";
echo "<p>时间：" . date('Y-m-d H:i:s') . "</p>";
echo "<pre>环境信息：\n";
echo "DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "SCRIPT_FILENAME: " . $_SERVER['SCRIPT_FILENAME'] . "\n";
echo "REQUEST_URI: " . $_SERVER['REQUEST_URI'] . "\n";
echo "</pre>";
?> 