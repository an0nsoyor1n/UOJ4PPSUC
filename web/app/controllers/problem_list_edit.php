<?php
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

// 检查权限
if (!Auth::check() || (!isSuperUser($myUser) && $myUser['username'] !== $problem_list['creator_username'])) {
    become403Page();
}

$problems_form = new UOJForm('problems');
$problems_form->addInput('problem_id', 'text', '题目ID', '',
    function($x) {
        if (!validateUInt($x)) return '题目ID必须是一个整数';
        $problem = queryProblemBrief($x);
        if (!$problem) return '题目不存在';
        
        // 检查题目是否已在题单中
        global $list_id;
        $check = DB::selectFirst("SELECT * FROM problem_list_problems WHERE list_id = {$list_id} AND problem_id = {$x}");
        if ($check) return '该题目已在题单中';
        
        return '';
    },
    null
);

$problems_form->handle = function() {
    global $list_id;
    
    $problem_id = (int)$_POST['problem_id'];
    
    // 获取当前最大序号
    $max_order = DB::selectFirst("SELECT MAX(order_num) as max_num FROM problem_list_problems WHERE list_id = {$list_id}");
    $order_num = $max_order ? ($max_order['max_num'] + 1) : 1;
    
    $result = DB::insert("INSERT INTO problem_list_problems (list_id, problem_id, order_num) VALUES ({$list_id}, {$problem_id}, {$order_num})");
    
    if ($result) {
        header("Location: /problems/problem_lists/{$list_id}/edit");
        die();
    } else {
        return '添加题目失败';
    }
};

$list_form = new UOJForm('list');
$list_form->addInput('name', 'text', '题单名称', $problem_list['name'],
    function($name) {
        if (!$name) return '标题不能为空';
        if (strlen($name) > 100) return '标题太长';
        return '';
    },
    null
);
$list_form->addInput('description', 'textarea', '描述', $problem_list['description'],
    function($description) {
        return '';
    },
    null
);
$list_form->addInput('tags', 'text', '标签（用逗号分隔）', $problem_list['tags'],
    function($tags) {
        return '';
    },
    null
);
$list_form->addInput('is_public', 'checkbox', '公开题单', $problem_list['is_public'],
    function($is_public) {
        return '';
    },
    null
);
$list_form->handle = function() {
    global $list_id;
    
    $name = DB::escape($_POST['name']);
    $description = DB::escape($_POST['description']);
    $tags = DB::escape($_POST['tags']);
    $is_public = isset($_POST['is_public']) ? 1 : 0;
    
    $result = DB::update("UPDATE problem_lists 
                         SET name = '$name', 
                             description = '$description', 
                             tags = '$tags', 
                             is_public = $is_public 
                         WHERE id = $list_id");
                         
    if ($result) {
        header("Location: /problems/problem_lists/{$list_id}/edit");
        die();
    } else {
        return '修改失败';
    }
};

$remove_form = new UOJForm('remove');
$remove_form->handle = function() {
    global $list_id;
    
    if (isset($_POST['problem_id']) && validateUInt($_POST['problem_id'])) {
        $problem_id = $_POST['problem_id'];
        
        $result = DB::delete("DELETE FROM problem_list_problems 
                            WHERE list_id = ? AND problem_id = ?",
                            [$list_id, $problem_id]);
                            
        if ($result) {
            updateMsg('移除题目成功');
        }
        
        redirectTo("/problems/problem_lists/{$list_id}/edit");
    }
};

$list_form->runAtServer();
$problems_form->runAtServer();
$remove_form->runAtServer();
?>

<?php echoUOJPageHeader("编辑题单 - {$problem_list['name']}") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">编辑题单信息</h3>
            </div>
            <div class="card-body">
                <?php $list_form->printHTML() ?>
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">题目列表</h3>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addProblemModal">
                        <span class="glyphicon glyphicon-plus"></span> 添加题目
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 8%">序号</th>
                                <th style="width: 12%">题目ID</th>
                                <th style="width: 65%">题目名称</th>
                                <th style="width: 15%">操作</th>
                            </tr>
                        </thead>
                        <tbody id="problemList">
                            <?php
                            $problems = DB::selectAll("SELECT p.*, plp.order_num 
                                                     FROM problems p 
                                                     JOIN problem_list_problems plp ON p.id = plp.problem_id 
                                                     WHERE plp.list_id = {$list_id} 
                                                     ORDER BY plp.order_num");
                            foreach ($problems as $problem):
                            ?>
                            <tr>
                                <td><?= $problem['order_num'] ?></td>
                                <td>#<?= $problem['id'] ?></td>
                                <td>
                                    <a href="/problem/<?= $problem['id'] ?>" target="_blank">
                                        <?= HTML::escape($problem['title']) ?>
                                    </a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-xs remove-problem" data-id="<?= $problem['id'] ?>">
                                        <span class="glyphicon glyphicon-remove"></span> 移除
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 添加题目的模态框 -->
<div class="modal fade" id="addProblemModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">添加题目</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?php $problems_form->printHTML() ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    // 处理移除题目
    $('.remove-problem').click(function() {
        var problemId = $(this).data('id');
        if (confirm('确定要移除这道题目吗？')) {
            $.post(window.location.href, {
                _form_name: 'remove',
                problem_id: problemId
            }, function() {
                location.reload();
            });
        }
    });
    
    // 添加题目表单提交后自动关闭模态框
    $('#problems_form').submit(function() {
        setTimeout(function() {
            if (!$('#problems_form').find('.alert-danger').length) {
                $('#addProblemModal').modal('hide');
            }
        }, 100);
    });
});
</script>

<?php echoUOJPageFooter() ?> 