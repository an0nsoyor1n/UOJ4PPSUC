<?php

class UOJContext {
	public static $data = array();
	
	public static function pageConfig() {
		if (!isset(self::$data['type'])) {
			return array(
				'PageNav' => 'main-nav'
			);
		} elseif (self::$data['type'] == 'blog') {
			return array(
				'PageNav' => 'blog-nav',
				'PageMainTitle' => UOJContext::$data['user']['username'] . '的博客',
				'PageMainTitleOnSmall' => '博客',
			);
		}
	}
	
	public static function isAjax() {
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}
	
	public static function contentLength() {
		if (!isset($_SERVER['CONTENT_LENGTH'])) {
			return null;
		}
		return (int)$_SERVER['CONTENT_LENGTH'];
	}
	
	public static function documentRoot() {
		return $_SERVER['DOCUMENT_ROOT'];
	}
	public static function storagePath() {
		return $_SERVER['DOCUMENT_ROOT'].'/app/storage';
	}
	public static function remoteAddr() {
		return $_SERVER['REMOTE_ADDR'];
	}
	public static function requestURI() {
		return $_SERVER['REQUEST_URI'];
	}
	public static function requestPath() {
		$uri = $_SERVER['REQUEST_URI'];
		$p = strpos($uri, '?');
		if ($p === false) {
			return $uri;
		} else {
			return substr($uri, 0, $p);
		}
	}
	public static function requestMethod() {
		return $_SERVER['REQUEST_METHOD'];
	}
	public static function httpHost() {
		if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
			return $_SERVER['HTTP_X_FORWARDED_HOST'];
		} elseif (isset($_SERVER['HTTP_HOST'])) {
			return $_SERVER['HTTP_HOST'];
		} else {
			return $_SERVER['SERVER_NAME'].($_SERVER['SERVER_PORT'] == '80' ? '' : ':'.$_SERVER['SERVER_PORT']);
		}
	}
	public static function cookieDomain() {
		$domain = UOJConfig::$data['web']['domain'];
		if ($domain === null) {
			$domain = UOJConfig::$data['web']['main']['host'];
		}
		
		$domain_str = $domain;  // 创建中间变量
		$parts = explode(':', $domain_str);
		$domain = $parts[0];
		
		if (validateIP($domain) || $domain === 'localhost') {
			$domain = '';
		} else {
			$domain = '.'.$domain;
		}
		return $domain;
	}
	
	public static function setupBlog() {
		global $uojMySQL;
		
		if (!isset($_GET['blog_username'])) {
			become404Page();
		}
		
		$user = DB::selectFirst("select * from users where username = '".DB::escape($_GET['blog_username'])."'");
		
		if ($user == null) {
			become404Page();
		}
		
		self::$data['user'] = $user;
		
		if ($_GET['blog_username'] !== blog_name_encode(self::$data['user']['username'])) {
			permanentlyRedirectTo(HTML::blog_url(self::$data['user']['username'], '/'));
		}
		self::$data['type'] = 'blog';
	}
	
	public static function __callStatic($name, array $args) {
		switch (self::$data['type']) {
			case 'blog':
				switch ($name) {
					case 'user':
						return self::$data['user'];
					case 'userid':
						return self::$data['user']['username'];
					case 'hasBlogPermission':
						return self::isAny() && self::user()['username'] === $_GET['blog_username'];
					case 'isHis':
						if (!isset($args[0])) {
							return false;
						}
						$blog = $args[0];
						return $blog['poster'] == self::$data['user']['username'];
					case 'isHisBlog':
						if (!isset($args[0])) {
							return false;
						}
						$blog = $args[0];
						return $blog['poster'] == self::$data['user']['username'] && 
							   ($blog['type'] == 'B' || $blog['type'] == 'S') && 
							   $blog['is_draft'] == false;
					case 'isHisSlide':
						if (!isset($args[0])) {
							return false;
						}
						$blog = $args[0];
						return $blog['poster'] == self::$data['user']['username'] && $blog['type'] == 'S' && $blog['is_draft'] == false;
				}
				break;
		}
	}
	
	function queryBlog($id) {
		if (!$id) {
			error_log("queryBlog: ID is empty");
			return null;
		}
		
		// 1. 先检查博客是否存在
		$blog = DB::selectFirst("select * from blogs where id = " . (int)$id);
		if (!$blog) {
			error_log("queryBlog: No blog found with ID {$id}");
			return null;
		}
		
		// 2. 获取作者信息（使用正确的表名和字符集）
		$poster = DB::selectFirst("select username from users where username = '" . DB::escape($blog['poster']) . "' COLLATE utf8mb4_unicode_ci");
		if ($poster) {
			$blog['poster_username'] = $poster['username'];
		} else {
			$blog['poster_username'] = $blog['poster'];
		}
		
		error_log("queryBlog success: found blog with title " . ($blog['title'] ?? 'untitled'));
		return $blog;
	}
	
	function queryBlogTags($id) {
		$tags = array();
		$result = DB::select("select tag from blogs_tags where blog_id = " . (int)$id);
		while ($row = DB::fetch($result)) {
			$tags[] = $row['tag'];
		}
		return $tags;
	}
	
	function checkBlogTableStructure() {
		error_log("Checking blogs table structure...");
		$result = DB::query("SHOW TABLES LIKE 'blogs'");
		if (DB::num_rows($result) === 0) {
			error_log("blogs table does not exist!");
			return false;
		}
		
		$result = DB::query("SHOW COLUMNS FROM blogs");
		if ($result === false) {
			error_log("Failed to get blogs table structure: " . DB::error());
			return false;
		}
		
		$columns = array();
		while ($row = DB::fetch($result)) {
			$columns[] = $row['Field'];
		}
		
		error_log("blogs table columns: " . implode(", ", $columns));
		return true;
	}
	
	function __construct() {
		checkBlogTableStructure();
	}
}
