<?php
requirePHPLib('form');

if (!isset($_GET['id']) || !validateUInt($_GET['id']) || !($blog = queryBlog($_GET['id']))) {
    become404Page();
}

if (!Auth::check()) {
    become403Page();
}

$comment_form = new UOJForm('comment');
$comment_form->addTextArea('content', '评论内容', '', 
    function($content) {
        if (strlen($content) == 0) {
            return '评论不能为空';
        }
        if (strlen($content) > 1000) {
            return '评论太长了';
        }
        return '';
    },
    null
);

$comment_form->handle = function() {
    global $blog;
    
    $content = DB::escape($_POST['content']);
    $username = Auth::id();
    
    DB::insert("insert into blogs_comments (blog_id, poster, content, post_time) values ({$blog['id']}, '{$username}', '{$content}', now())");
    
    header("Location: /blog/{$blog['id']}");
    die();
};

?>

<?php echoUOJPageHeader('发表评论 - ' . $blog['title']) ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">发表评论</h3>
                <div class="card-subtitle text-muted mt-1">
                    <?= HTML::escape($blog['title']) ?>
                </div>
            </div>
            <div class="card-body">
                <?php $comment_form->printHTML() ?>
            </div>
        </div>
    </div>
</div>

<?php echoUOJPageFooter() ?> 