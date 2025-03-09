<?php
http_response_code(500);
?>
<!DOCTYPE html>
<html>
<head>
    <title>系统错误</title>
    <meta charset="utf-8" />
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            text-align: center;
            padding-top: 100px;
        }
        h1 { color: #444; }
        .error-text {
            color: #666;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h1>系统错误</h1>
    <div class="error-text">
        抱歉，系统遇到了一些问题。请稍后再试。
    </div>
    <div>
        <a href="/">返回首页</a>
    </div>
</body>
</html> 