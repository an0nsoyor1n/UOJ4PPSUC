<?php

call_user_func(function() { // to prevent variable scope leak
	// 添加调试输出
	error_log("====== 博客路由调试 ======");
	error_log("REQUEST_URI: " . $_SERVER['REQUEST_URI']);
	error_log("博客用户名参数: " . (isset($_GET['blog_username']) ? $_GET['blog_username'] : '未设置'));

	Route::pattern('id', '[1-9][0-9]{0,9}');
	Route::pattern('blog_username', '[a-zA-Z0-9_]{1,20}');

	switch (UOJConfig::$data['switch']['blog-domain-mode']) {
		case 1:
			$domain = '{blog_username}.'.UOJConfig::$data['web']['blog']['host'];
			$prefix = '';
			break;
		case 2:
			$domain = UOJConfig::$data['web']['blog']['host'];
			$prefix = '/{blog_username}';
			break;
		case 3:
			$domain = UOJConfig::$data['web']['main']['host'];
			$prefix = '/blog/{blog_username}';
			error_log("博客URL前缀: $prefix");
			break;
	}

	Route::group([
			'domain' => $domain,
			'onload' => function() {
				UOJContext::setupBlog();
			}
		], function() use ($prefix) {
			// 基础路由
			Route::any("$prefix/", '/subdomain/blog/index.php');
			
			// 博客相关路由 - 修正控制器路径
			Route::any("$prefix/post/new/write", '/subdomain/blog/blog_write.php');
			Route::any("$prefix/post/{id}/write", '/subdomain/blog/blog_write.php');
			Route::any("$prefix/post/{id}", '/subdomain/blog/blog.php');
			Route::any("$prefix/post/{id}/delete", '/subdomain/blog/blog_delete.php');
			Route::any("$prefix/post/{id}/comment", '/subdomain/blog/blog_comment.php');
			
			// 其他路由
			Route::any("$prefix/archive", '/subdomain/blog/archive.php');
			Route::any("$prefix/aboutme", '/subdomain/blog/aboutme.php');
			Route::any("$prefix/click-zan", '/click_zan.php');
			Route::any("$prefix/slide/{id}", '/subdomain/blog/slide.php');
			Route::any("$prefix/slide/new/write", '/subdomain/blog/slide_write.php');
			Route::any("$prefix/slide/{id}/write", '/subdomain/blog/slide_write.php');
			Route::any("$prefix/solutions", '/subdomain/blog/index.php?tab=solutions');
		}
	);

	// 全局博客相关路由
	Route::any('/', '/blog.php');
	Route::any('/posts', '/blogs.php');
	Route::any('/post/new/write', '/blog_write.php');
	Route::any('/post/{id}/edit', '/blog_write.php');
	Route::any('/post/{id}', '/blog.php');
	Route::any('/post/{id}/comment', '/blog_comment.php');
	Route::any('/slide/new', '/slide_write.php');
	Route::any('/slide/{id}/edit', '/slide_write.php');
	Route::any('/tag/{tag}', '/blog_tag.php');
	Route::any('/feed', '/blog_feed.php');
});
