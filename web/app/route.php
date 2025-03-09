<?php

Route::pattern('username', '[a-zA-Z0-9_]{1,20}');
Route::pattern('id', '[1-9][0-9]{0,9}');
Route::pattern('contest_id', '[1-9][0-9]{0,9}');
Route::pattern('tab', '\S{1,20}');
Route::pattern('rand_str_id', '[0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ]{20}');
Route::pattern('upgrade_name', '[a-zA-Z0-9_]{1,50}');
Route::pattern('problem_list_id', '[1-9][0-9]{0,9}');

Route::group([
		'domain' => '('.UOJConfig::$data['web']['main']['host'].'|127.0.0.1'.')'
	], function() {
		Route::any('/', '/index.php');
		Route::any('/problems', '/problem_set.php');
		Route::any('/problems/template', '/problem_set.php?tab=template');
		Route::any('/problems/basic_grammar', '/problem_set.php?tab=basic_grammar');
		Route::any('/problems/data_structure', '/problem_set.php?tab=data_structure');
		Route::any('/problem/{id}', '/problem.php');
		Route::any('/problem/{id}/statistics', '/problem_statistics.php');
		Route::any('/problem/{id}/manage/statement', '/problem_statement_manage.php');
		Route::any('/problem/{id}/manage/managers', '/problem_managers_manage.php');
		Route::any('/problem/{id}/manage/data', '/problem_data_manage.php');	
		Route::any('/problems/problem_lists', '/problem_lists.php'); //题单列表
		Route::any('/problems/problem_lists/{id}', '/problem_list.php'); //展示具体题单
		Route::any('/problems/problem_lists/{id}/edit', '/problem_list_edit.php'); //编辑题单
		Route::any('/problems/problem_lists/{problem_list_id}/export', '/problem_list_export.php');
		
		
		Route::any('/contests', '/contests.php');
		Route::any('/contest/new', '/add_contest.php');
		Route::any('/contest/{id}', '/contest_inside.php');
		Route::any('/contest/{id}/registrants', '/contest_members.php');
		Route::any('/contest/{id}/register', '/contest_registration.php');
		Route::any('/contest/{id}/manage', '/contest_manage.php');
		Route::any('/contest/{id}/submissions', '/contest_inside.php?tab=submissions');
		Route::any('/contest/{id}/standings', '/contest_inside.php?tab=standings');
		Route::any('/contest/{id}/backstage', '/contest_inside.php?tab=backstage');
		Route::any('/contest/{id}/export_standings', '/export_contest_standings_table.php');
		Route::any('/contest/{contest_id}/problem/{id}', '/problem.php');
		Route::any('/contest/{contest_id}/problem/{id}/statistics', '/problem_statistics.php');
		
		Route::any('/submissions', '/submissions_list.php');
		Route::any('/submission/{id}', '/submission.php');
		Route::any('/submission-status-details', '/submission_status_details.php');
		
		Route::any('/hacks', '/hack_list.php');
		Route::any('/hack/{id}', '/hack.php');
		
		Route::any('/blogs', '/blogs.php');
		if (UOJConfig::$data['switch']['blog-domain-mode'] != 3) {
			Route::any('/blog/{id}', '/blog_show.php');
		}
		Route::any('/blogs/{id}', '/blog_show.php');
		Route::any('/post/{id}', '/blog_show.php');
		
		Route::any('/blogs/solutions', '/blogs.php?tab=solutions');
		Route::any('/blogs/experiences', '/blogs.php?tab=experiences');


		Route::any('/post/{id}', '/blog_show.php');
		
		Route::any('/announcements', '/announcements.php');
		
		Route::any('/faq', '/faq.php');
		Route::any('/ranklist', '/ranklist.php?type=rating');
		
		Route::any('/login', '/login.php');
		Route::any('/logout', '/logout.php');
		Route::any('/register', '/register.php');
		Route::any('/forgot-password', '/forgot_pw.php');
		Route::any('/reset-password', '/reset_pw.php');
		Route::any('/user/profile/{username}', '/user_info.php');
		Route::any('/user/modify-profile', '/change_user_info.php');
		Route::any('/user/msg', '/user_msg.php');
		Route::any('/user/system-msg', '/user_system_msg.php');
		Route::any('/super-manage(?:/{tab})?', '/super_manage.php');
		
		Route::any('/download.php', '/download.php');
		
		Route::any('/click-zan', '/click_zan.php');

		Route::any('/paste', '/paste_post.php');
		Route::any('/pastes/{rand_str_id}', '/paste_view.php');

		Route::any('/map_visualizer', '/map_visualizer.php');
	}
);

Route::post('/judge/submit', '/judge/submit.php');
Route::post('/judge/sync-judge-client', '/judge/sync_judge_client.php');

Route::post('/judge/download/submission/{id}/{rand_str_id}', '/judge/download.php?type=submission');
Route::post('/judge/download/tmp/{rand_str_id}', '/judge/download.php?type=tmp');
Route::post('/judge/download/problem/{id}', '/judge/download.php?type=problem');
Route::post('/judge/download/judger', '/judge/download.php?type=judger');

// 在现有路由配置末尾添加这个路由
// 这是直接访问博客写作页面的路由

Route::any('/blog/{blog_username}/post/new/write', function() {
    // 设置博客用户名全局变量，给 UOJContext::setupBlog() 使用
    $_GET['blog_username'] = Route::var('blog_username');
    
    // 记录路由调试信息
    error_log("博客写作路由：" . $_SERVER['REQUEST_URI']);
    error_log("博客用户名: " . $_GET['blog_username']);
    
    // 强制设置博客环境
    UOJContext::setupBlog();
    
    // 包含控制器文件
    require $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/subdomain/blog/blog_write.php';
});

// 添加题单导出路由
Route::any('/problems/problem_lists/{id}/export', '/problems/problem_lists_export.php');

// 添加题单CSV下载路由
Route::any('/problem_list_download.php', '/problem_list_download.php');
