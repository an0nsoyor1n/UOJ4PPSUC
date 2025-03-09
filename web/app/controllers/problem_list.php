<?php
function debug_log($message) {
    error_log($message, 3, '/var/log/php_errors.log');
}

requirePHPLib('form');

if (!isset($_GET['id'])) {
    become404Page();
}

$list_id = (int)$_GET['id'];

// 获取题单信息
$problem_list = DB::selectFirst("SELECT pl.*, ui.username as creator_name 
                                FROM problem_lists pl 
                                JOIN user_info ui ON pl.creator_username = ui.username 
                                WHERE pl.id = {$list_id}");

if (!$problem_list) {
    become404Page();
}

// 获取题单中的题目
$problems = DB::selectAll("SELECT p.*, plp.order_num 
                          FROM problems p 
                          JOIN problem_list_problems plp ON p.id = plp.problem_id 
                          WHERE plp.list_id = {$list_id} 
                          ORDER BY plp.order_num");

// 在获取题单信息后添加
if (Auth::check()) {
  $has_registered = DB::selectFirst("SELECT * FROM problem_list_registrants 
                                   WHERE list_id = {$list_id} AND username = '".Auth::id()."'");
} else {
  $has_registered = false;
}

// 处理报名请求
if (isset($_POST['register']) && Auth::check()) {
  DB::insert("INSERT INTO problem_list_registrants (list_id, username) 
             VALUES ({$list_id}, '".Auth::id()."')");
  $has_registered = true;
}

?>

<?php echoUOJPageHeader($problem_list['name']) ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= HTML::escape($problem_list['name']) ?></h3>
    </div>
    <div class="card-body">
        <?php if ($problem_list['description']): ?>
            <div class="problem-list-description">
                <?= HTML::escape($problem_list['description']) ?>
            </div>
            <hr>
        <?php endif ?>

        <?php if ($problem_list['tags']): ?>
            <div class="problem-list-tags">
                <strong>标签：</strong>
                <?php foreach (explode(',', $problem_list['tags']) as $tag): ?>
                    <span class="badge badge-secondary"><?= HTML::escape(trim($tag)) ?></span>
                <?php endforeach ?>
            </div>
            <hr>
        <?php endif ?>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width: 8%">序号</th>
                        <th style="width: 12%">题目ID</th>
                        <th>题目名称</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($problems as $problem): ?>
                    <tr>
                        <td class="text-center"><?= $problem['order_num'] ?></td>
                        <td class="text-center">#<?= $problem['id'] ?></td>
                        <td>
                            <a href="/problem/<?= $problem['id'] ?>" target="_blank">
                                <?= HTML::escape($problem['title']) ?>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-sm-6">
                <small class="text-muted">
                    创建者：<a href="/user/profile/<?= HTML::escape($problem_list['creator_name']) ?>"><?= HTML::escape($problem_list['creator_name']) ?></a>
                </small>
            </div>
            <?php if (Auth::check() && (isSuperUser($myUser) || $myUser['username'] === $problem_list['creator_username'])): ?>
            <div class="col-sm-6 text-right">
                <a href="/problems/problem_lists/<?= $list_id ?>/edit" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-edit"></span> 编辑
                </a>
            </div>
            <?php endif ?>
        </div>
    </div>
</div>

<?php if (isSuperUser($myUser)) {
    echo '<div class="float-right">';
    echo '<a href="/problems/problem_lists/'.$problem_list['id'].'/export?type=count" class="btn btn-primary">按完成数量导出</a> ';
    echo '<a href="/problems/problem_lists/'.$problem_list['id'].'/export?type=class" class="btn btn-primary">按班级导出</a> ';
    echo '<a href="/problem_list_download.php?problem_list_id='.$problem_list['id'].'&type=count" class="btn btn-success"><i class="fas fa-download"></i> 下载CSV(按完成数)</a> ';
    echo '<a href="/problem_list_download.php?problem_list_id='.$problem_list['id'].'&type=class" class="btn btn-success"><i class="fas fa-download"></i> 下载CSV(按班级)</a>';
    echo '</div>';
} ?>

<?php if (Auth::check() && !$has_registered) {
  echo <<<EOD
    <form method="post">
      <button type="submit" name="register" class="btn btn-primary">加入题单</button>
    </form>
  EOD;
} ?>

<?php echoUOJPageFooter() ?> 