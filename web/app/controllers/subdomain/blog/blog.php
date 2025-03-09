<?php
	requirePHPLib('form');
	
	// 记录所有请求参数
	error_log("=== Blog Request Debug ===");
	error_log("REQUEST_URI: " . $_SERVER['REQUEST_URI']);
	error_log("REQUEST_METHOD: " . $_SERVER['REQUEST_METHOD']);
	error_log("GET params: " . print_r($_GET, true));
	error_log("POST params: " . print_r($_POST, true));
	error_log("COOKIE params: " . print_r($_COOKIE, true));
	error_log("=========================");
	
	// 检查博客ID
	if (!isset($_GET['id']) || !validateUInt($_GET['id']) || !($blog = queryBlog($_GET['id']))) {
		become404Page();
	}
	
	// 检查博客用户名
	if (isset($_GET['blog_username'])) {
		if ($blog['poster'] !== $_GET['blog_username']) {
			become404Page();
		}
	}
	
	// 获取博客标签
	$blog_tags = queryBlogTags($blog['id']);
	
	// 获取关联的题目（如果是题解）
	$problem = null;
	if ($blog['type'] === 'S') {
		// 查找题解关联的题目
		$result = DB::select("SELECT problem_id FROM blogs_solutions WHERE blog_id = {$blog['id']}");
		if ($result) {
			$problem_id = $result[0]['problem_id'];
			$problem = queryProblemBrief($problem_id);
		}
	}
	
	// 获取评论
	$comments_pag = new Paginator([
		'col_names' => ['*'],
		'table_name' => 'blogs_comments',
		'cond' => "blog_id = {$blog['id']}",
		'order' => 'post_time ASC',
		'page_len' => 10
	]);
	
	// 处理点赞功能
	$is_liked = false;
	if (Auth::check()) {
		// 检查用户是否已点赞
		$result = DB::select("SELECT * FROM blogs_likes WHERE blog_id = {$blog['id']} AND username = '".Auth::id()."'");
		$is_liked = (count($result) > 0);
	}
	
	$like_count = DB::selectCount("SELECT COUNT(*) FROM blogs_likes WHERE blog_id = {$blog['id']}");
	
	// 浏览量增加
	if (Auth::check() && $blog['poster'] !== Auth::id()) {
		DB::update("UPDATE blogs SET view_count = view_count + 1 WHERE id = {$blog['id']}");
	}
	
	// 渲染页面
	$REQUIRE_LIB['mathjax'] = '';
	$REQUIRE_LIB['shjs'] = '';
	
	// 设置页面标题
	$page_title = $blog['title'];
	requireLib('blog');
	
	// 显示博客内容
	$content_md = $blog['content_md'];
	$content_html = $blog['content'];
?>
<?php echoUOJPageHeader($blog['title']) ?>

<div class="card">
	<div class="card-header">
		<div class="d-flex justify-content-between align-items-center">
			<h1 class="card-title mb-0"><?= $blog['title'] ?></h1>
			<?php if (UOJContext::hasBlogPermission() && UOJContext::isHis($blog)): ?>
			<div class="btn-group">
				<a href="<?= HTML::blog_url(UOJContext::userid(), "/post/{$blog['id']}/write") ?>" class="btn btn-outline-secondary">编辑</a>
				<a href="<?= HTML::blog_url(UOJContext::userid(), "/post/{$blog['id']}/delete") ?>" class="btn btn-outline-danger">删除</a>
			</div>
			<?php endif ?>
		</div>
		<div class="card-subtitle text-muted mt-2">
			<span class="me-3">作者：<a href="<?= HTML::url('/user/profile/'.$blog['poster']) ?>"><?= $blog['poster'] ?></a></span>
			<span class="me-3">发表于：<?= $blog['post_time'] ?></span>
			<span class="me-3">浏览：<?= $blog['view_count'] ?></span>
			<span id="like-count"><?= $like_count ?> 人赞</span>
		</div>
	</div>
	<div class="card-body">
		<?php if ($blog['type'] === 'S' && $problem): ?>
		<div class="alert alert-info">
			这是 <a href="<?= HTML::url('/problem/'.$problem['id']) ?>"><?= $problem['title'] ?></a> 的题解
		</div>
		<?php endif ?>
		
		<?php if (!empty($blog_tags)): ?>
		<div class="mb-3">
			<?php foreach ($blog_tags as $tag): ?>
			<span class="badge bg-primary me-1"><?= $tag ?></span>
			<?php endforeach ?>
		</div>
		<?php endif ?>
		
		<div class="blog-content">
			<?= $blog['content'] ?>
		</div>
		
		<div class="mt-4 text-center">
			<button class="btn <?= $is_liked ? 'btn-primary' : 'btn-outline-primary' ?>" 
					id="blog-like-button" 
					data-blog-id="<?= $blog['id'] ?>">
				<i class="fas fa-thumbs-up"></i> <?= $is_liked ? '已赞' : '点赞' ?>
			</button>
		</div>
	</div>
</div>

<!-- 评论区 -->
<div class="card mt-4">
	<div class="card-header">
		<h3 class="card-title">评论</h3>
	</div>
	<div class="card-body">
		<?php if (Auth::check()): ?>
		<div class="mb-4">
			<a href="/post/<?= $blog['id'] ?>/comment" class="btn btn-primary">发表评论</a>
		</div>
		<?php endif ?>
		
		<?php if ($comments_pag->isEmpty()): ?>
		<div class="text-center text-muted">暂无评论</div>
		<?php else: ?>
		<?php foreach ($comments_pag->get() as $comment): ?>
		<div class="comment mb-3 pb-3 border-bottom">
			<div class="d-flex justify-content-between">
				<div>
					<a href="<?= HTML::url('/user/profile/'.$comment['poster']) ?>"><?= $comment['poster'] ?></a>
				</div>
				<div class="text-muted">
					<?= $comment['post_time'] ?>
				</div>
			</div>
			<div class="mt-2">
				<?= $comment['content'] ?>
			</div>
		</div>
		<?php endforeach ?>
		
		<?php $comments_pag->echoPageSelector() ?>
		<?php endif ?>
	</div>
</div>

<script>
$(function() {
	$('#blog-like-button').click(function() {
		var blogId = $(this).data('blog-id');
		$.post('<?= HTML::blog_url(UOJContext::userid(), "/click-zan") ?>', {
			blog_id: blogId,
			_token: '<?= crsf_token() ?>'
		}, function(response) {
			if (response.status === 'success') {
				var likeButton = $('#blog-like-button');
				if (response.liked) {
					likeButton.removeClass('btn-outline-primary').addClass('btn-primary');
					likeButton.html('<i class="fas fa-thumbs-up"></i> 已赞');
				} else {
					likeButton.removeClass('btn-primary').addClass('btn-outline-primary');
					likeButton.html('<i class="fas fa-thumbs-up"></i> 点赞');
				}
				$('#like-count').text(response.like_count + ' 人赞');
			} else {
				alert('操作失败：' + response.message);
			}
		}, 'json');
	});
});
</script>

<?php echoUOJPageFooter() ?>
