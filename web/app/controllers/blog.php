<?php
requirePHPLib('form');

if (!isset($_GET['id']) || !validateUInt($_GET['id']) || !($blog = queryBlog($_GET['id']))) {
    become404Page();
}

// 获取关联的题目（如果是题解）
$problem = null;
if ($blog['type'] === 'S') {
    $problem_link = DB::selectFirst("select problem_id from blog_problems where blog_id = {$blog['id']}");
    if ($problem_link) {
        $problem = queryProblemBrief($problem_link['problem_id']);
    }
}

$comments_pag = new Paginator(array(
    'col_names' => array('*'),
    'table_name' => 'blogs_comments',
    'cond' => "blog_id = {$blog['id']}",
    'tail' => 'order by id asc',
    'page_len' => 20
));

$page_title = $blog['title'];
if ($blog['type'] === 'S' && $problem) {
    $page_title .= " - #{$problem['id']}. {$problem['title']} 题解";
}
?>

<?php echoUOJPageHeader($page_title) ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <?= HTML::escape($blog['title']) ?>
                    <?php if ($blog['type'] === 'S'): ?>
                        <span class="badge bg-success">题解</span>
                        <?php if ($problem): ?>
                            <small>- <?= getProblemLink($problem, '!id_and_title') ?></small>
                        <?php endif ?>
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

        <?php if ($comments_pag->isEmpty()): ?>
            <div class="card mt-3">
                <div class="card-body text-center text-muted">
                    暂无评论
                </div>
            </div>
        <?php else: ?>
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">评论</h3>
                </div>
                <div class="card-body">
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
                </div>
            </div>
        <?php endif ?>
    </div>
</div>

<?php echoUOJPageFooter() ?> 