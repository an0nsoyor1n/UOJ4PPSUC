<?php

<!-- 在页面顶部添加导出按钮 -->
<div class="card mb-3">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">题目完成情况</h3>
            <?php if (Auth::check() && (isSuperUser(Auth::user()) || $problem_list['owner'] == Auth::user()['username'])): ?>
            <div>
                <a href="/problems/problem_lists/<?= $problem_list_id ?>/export?type=<?= isset($view_type) ? $view_type : 'default' ?>" class="btn btn-success btn-sm">
                    <i class="fas fa-file-export"></i> 导出成绩表
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">
        <!-- 完成情况表格应该在这里 -->
    </div>
</div> 