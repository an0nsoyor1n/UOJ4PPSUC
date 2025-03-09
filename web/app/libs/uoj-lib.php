<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 0);
	ini_set('log_errors', 1);
	ini_set('error_log', '/var/log/php_errors.log');
	
	spl_autoload_register(function($class_name) {
		require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/' . $class_name . '.php';
	});
	
	function requireLib($name) { // html lib
		global $REQUIRE_LIB;
		$REQUIRE_LIB[$name] = '';
	}
	function requirePHPLib($name) { // uoj php lib
		require $_SERVER['DOCUMENT_ROOT'].'/app/libs/uoj-'.$name.'-lib.php';
	}
	
	requirePHPLib('validate');
	requirePHPLib('query');
	requirePHPLib('rand');
	requirePHPLib('utility');
	requirePHPLib('security');
	requirePHPLib('contest');
	requirePHPLib('html');
	
	Session::init();
	UOJTime::init();
	DB::init([
		'host' => UOJConfig::$data['database']['host'],
		'username' => UOJConfig::$data['database']['username'],
		'password' => UOJConfig::$data['database']['password'],
		'database' => UOJConfig::$data['database']['database']
	]);
	Auth::init();
	
	if (isset($_GET['locale'])) {
		UOJLocale::setLocale($_GET['locale']);
	}
	UOJLocale::requireModule('basic');
	
	// 设置自定义错误处理函数
	function uojErrorHandler($errno, $errstr, $errfile, $errline) {
		$message = date('[Y-m-d H:i:s]') . " $errstr in $errfile on line $errline\n";
		error_log($message, 3, '/var/log/php_errors.log');
		
		// 对于致命错误，显示友好的错误页面
		if ($errno == E_ERROR || $errno == E_USER_ERROR) {
			include($_SERVER['DOCUMENT_ROOT'] . '/error.php');
			exit(1);
		}
		
		return true;
	}
	
	// 注册错误处理函数
	set_error_handler('uojErrorHandler');
?>
