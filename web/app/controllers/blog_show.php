<?php
	requirePHPLib('form');

	if (!isset($_GET['id']) || !validateUInt($_GET['id']) || !($blog = queryBlog($_GET['id']))) {
		become404Page();
	}

	$comments_pag = new Paginator(array(
		'col_names' => array('*'),
		'table_name' => 'blogs_comments',
		'cond' => "blog_id = {$blog['id']}",
		'tail' => 'order by id asc',
		'page_len' => 20
	));

?>

<?php echoUOJPageHeader($blog['title']) ?>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">
					<?= HTML::escape($blog['title']) ?>
					<?php if ($blog['type'] === 'S'): ?>
						<span class="badge bg-success">题解</span>
					<?php else: ?>
						<span class="badge bg-info">分享</span>
					<?php endif ?>
				</h3>
				<div class="card-subtitle text-muted mt-1">
					<?= getUserLink($blog['poster']) ?> 发表于 <?= $blog['post_time'] ?>
				</div>
			</div>
			<div class="card-body">
				<?= $blog['content'] ?>
			</div>
		</div>

		<!-- 评论区 -->
		<div class="card mt-3">
			<div class="card-header">
				<h3 class="card-title">评论</h3>
			</div>
			<div class="card-body">
				<?php if ($comments_pag->isEmpty()): ?>
					<div class="text-center text-muted">
						暂无评论
					</div>
				<?php else: ?>
					<?php foreach ($comments_pag->get() as $comment): ?>
						<div class="comment mb-3">
							<div class="comment-header">
								<?= getUserLink($comment['poster']) ?> 
								<span class="text-muted"><?= $comment['post_time'] ?></span>
							</div>
							<div class="comment-content mt-2">
								<?= $comment['content'] ?>
							</div>
						</div>
					<?php endforeach ?>
					<?= $comments_pag->pagination() ?>
				<?php endif ?>

				<?php if (Auth::check()): ?>
					<div class="comment-form mt-4">
						<form action="" method="post">
							<div class="mb-3">
								<label class="form-label">发表评论</label>
								<textarea class="form-control" name="comment" rows="3" required></textarea>
							</div>
							<button type="submit" class="btn btn-primary">提交</button>
						</form>
					</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>

<?php echoUOJPageFooter() ?>
