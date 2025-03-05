<?php
requirePHPLib('form');
requirePHPLib('judger');
requirePHPLib('data');

// 定义调试日志函数
function debug_log($message) {
    error_log($message, 3, '/var/log/php_errors.log');
}

// 获取所有可见的题单
function getAllVisibleProblemLists($user) {
    try {
        if (isSuperUser($user)) {
            // 管理员可以看到所有题单
            $sql = "SELECT pl.*, ui.username as creator_name 
                    FROM problem_lists pl 
                    JOIN user_info ui ON pl.creator_username = ui.username";
            return DB::selectAll($sql);
        } else {
            // 普通用户只能看到公开题单和自己创建的题单
            $sql = "SELECT pl.*, ui.username as creator_name 
                    FROM problem_lists pl 
                    JOIN user_info ui ON pl.creator_username = ui.username 
                    WHERE pl.is_public = 1";
            if ($user !== null) {
                $sql .= " OR pl.creator_username = '{$user['username']}'";
            }
            return DB::selectAll($sql);
        }
    } catch (Exception $e) {
        return array();
    }
}

// 删除处理函数
if (isset($_POST['delete_list']) && isset($_POST['list_id'])) {
    if (!Auth::check() || !isSuperUser($myUser)) {
        become403Page();
    }
    
    $list_id = (int)$_POST['list_id'];
    
    try {
        DB::delete("DELETE FROM problem_list_problems WHERE list_id = " . $list_id);
        $result = DB::delete("DELETE FROM problem_lists WHERE id = " . $list_id);
        
        echo json_encode(['status' => $result ? 'success' : 'failed']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'failed']);
    }
    die();
}

// 只有管理员才能添加题单
if (isSuperUser($myUser)) {
    $new_list_form = new UOJForm('new_list');
    $new_list_form->handle = function() {
        global $myUser;
        $result = DB::query("INSERT INTO problem_lists (name, creator_username, is_public) VALUES ('新题单', '{$myUser['username']}', 1)");
        if ($result) {
            $list_id = DB::insert_id();
            if ($list_id) {
                redirectTo("/problems/problem_lists/{$list_id}/edit");
            }
        }
    };
    
    $new_list_form->submit_button_config['align'] = 'right';
    $new_list_form->submit_button_config['class_str'] = 'btn btn-primary';
    $new_list_form->submit_button_config['text'] = '添加新题单';
    $new_list_form->submit_button_config['smart_confirm'] = '';

    $new_list_form->runAtServer();
}

$cond = array();

if (isset($_GET["search"])) {
    $cond[] = "name like '%".DB::escape($_GET["search"])."%' or id like '%".DB::escape($_GET["search"])."%'";
}
if ($cond) {
    $cond = implode(' and ', $cond); 
} else {
    $cond = '1';
}
$problem_lists = getAllVisibleProblemLists($myUser);

// 表头设置
$header = '<tr>';
$header .= '<th class="text-center" style="width:5em;">ID</th>';
$header .= '<th>题单名称</th>';
$header .= '<th class="text-center" style="width:8em;">创建者</th>';
$header .= '<th class="text-center" style="width:10em;">创建时间</th>';
$header .= '<th class="text-center" style="width:5em;">公开</th>';
$header .= '<th class="text-center" style="width:10em;">操作</th>';
$header .= '</tr>';

?>

<?php echoUOJPageHeader('题单列表') ?>
<div class="row">
    <div class="col-sm-4">
        <!-- 搜索框 -->
        <form class="form-inline" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="搜索题单..." value="<?= isset($_GET['search']) ? HTML::escape($_GET['search']) : '' ?>">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </form>
    </div>
    <div class="col-sm-4 order-sm-9 text-right">
        <?php if (isSuperUser($myUser)): ?>
            <?php $new_list_form->printHTML() ?>
        <?php endif ?>
    </div>
</div>

<div class="top-buffer-sm"></div>

<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <?php echo $header ?>
        </thead>
        <tbody>
            <?php foreach ($problem_lists as $list): ?>
            <tr class="text-center">
                <td>
                    #<?= $list['id'] ?>
                </td>
                <td class="text-left">
                    <?php if (!$list['is_public']): ?>
                        <span class="text-danger">[未公开]</span>
                    <?php endif ?>
                    <a href="/problems/problem_lists/<?= $list['id'] ?>">
                        <?= HTML::escape($list['name']) ?>
                    </a>
                    <?php if ($list['tags']): ?>
                        <?php foreach (explode(',', $list['tags']) as $tag): ?>
                            <span class="badge badge-secondary"><?= HTML::escape(trim($tag)) ?></span>
                        <?php endforeach ?>
                    <?php endif ?>
                </td>
                <td>
                    <a href="/user/profile/<?= HTML::escape($list['creator_name']) ?>">
                        <?= HTML::escape($list['creator_name']) ?>
                    </a>
                </td>
                <td><?= $list['create_time'] ?></td>
                <td>
                    <?php if ($list['is_public']): ?>
                        <span class="glyphicon glyphicon-ok text-success"></span>
                    <?php else: ?>
                        <span class="glyphicon glyphicon-remove text-danger"></span>
                    <?php endif ?>
                </td>
                <td>
                    <?php if (isSuperUser($myUser) || $myUser['username'] === $list['creator_username']): ?>
                        <a href="/problems/problem_lists/<?= $list['id'] ?>/edit" class="btn btn-xs btn-primary">
                            <span class="glyphicon glyphicon-edit"></span> 编辑
                        </a>
                        <?php if (isSuperUser($myUser)): ?>
                            <a href="#" class="btn btn-xs btn-danger delete-list" data-id="<?= $list['id'] ?>">
                                <span class="glyphicon glyphicon-trash"></span> 删除
                            </a>
                        <?php endif ?>
                    <?php endif ?>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
$(document).ready(function() {
    // 添加表格行悬停效果
    $('.table-hover tr').hover(
        function() { $(this).addClass('hover'); },
        function() { $(this).removeClass('hover'); }
    );
    
    // 搜索框自动聚焦
    $('input[name="search"]').focus();
    
    // 添加删除功能处理
    $('.delete-list').click(function(e) {
        e.preventDefault();
        var listId = $(this).data('id');
        
        if (confirm('确定要删除这个题单吗？此操作不可恢复！')) {
            $.post('/problems/problem_lists', {
                delete_list: true,
                list_id: listId
            }, function(response) {
                if (response.status === 'success') {
                    location.reload();
                } else {
                    alert('删除失败，请重试');
                }
            }, 'json');
        }
    });
});
</script>

<?php echoUOJPageFooter() ?>