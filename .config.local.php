<?php
return [
	'profile' => [
		'oj-name' => 'PPSUC Online Judge',
<<<<<<< HEAD
		'oj-name-short' => 'PPSUC OJ',
		'administrator' => 'CyberSWAT TEAM',
		'admin-email' => 'CyberSWAT@ppsuc.cn',
=======
		'oj-name-short' => 'PPSUCOJ',
		'administrator' => 'root',
		'admin-email' => 'Andrew82106@local_uoj.ac',
>>>>>>> 42ae0f63f5caf925a774fa514ed3986208510af4
		'QQ-group' => '',
		'ICP-license' => ''
	],
	'database' => [
		'database' => 'app_uoj233',
		'username' => 'root',
		'password' => 'root',
		'host' => 'uoj-db'
	],
	'web' => [
		'domain' => null,
		'main' => [
			'protocol' => 'http',
			'host' => UOJContext::httpHost(),
			'port' => 80
		],
		'blog' => [
			'protocol' => 'http',
			'host' => UOJContext::httpHost(),
			'port' => 80
		]
	],
	'security' => [
		'user' => [
<<<<<<< HEAD
			'client_salt' => 'Qohidh9aUO7IW0xLjdJFeQes3f58f1fj'
		],
		'cookie' => [
			'checksum_salt' => ['O0TRSxiRkfevRcER', 'nrrjeG95ffnfIZ4z', 'TIcSkjssLlkJT19v']
=======
			'client_salt' => 'salt0'
		],
		'cookie' => [
			'checksum_salt' => ['salt1', 'salt2', 'salt3']
>>>>>>> 42ae0f63f5caf925a774fa514ed3986208510af4
		],
	],
	'mail' => [
		'noreply' => [
			'username' => 'noreply@local_uoj.ac',
			'password' => '_mail_noreply_password_',
			'host' => 'smtp.local_uoj.ac',
			'secure' => 'tls',
			'port' => 587
		]
	],
	'judger' => [
		'socket' => [
			'port' => '233',
			'password' => '_judger_socket_password_'
		]
	],
	'switch' => [
		// 请在 page-header.php 中修改统计代码后再启用
		'web-analytics' => false,
		'blog-domain-mode' => 3
	],
	'tools' => [
		// 请仅在https下启用以下功能.
		// 非https下, chrome无法进行复制.
		'map-copy-enabled' => false,
	]
];
