<?php
	requirePHPLib('form');
	
	// 获取当前标签
	$blog_tab = isset($_GET['tab']) ? $_GET['tab'] : 'all';
	
	// 构建查询条件
	$cond = array();
	switch ($blog_tab) {
		case 'solutions':
			$cond[] = "type = 'S'"; // 题解
			$tab_name = '题解';
			break;
		case 'experiences':
			$cond[] = "type = 'E'"; // 分享
			$tab_name = '分享';
			break;
		default:
			$blog_tab = 'all';
			$tab_name = '全部';
	}
	
	// 搜索功能
	if (isset($_GET['search'])) {
		$cond[] = "title like '%".DB::escape($_GET['search'])."%'";
	}
	
	// 构建完整查询条件
	if ($cond) {
		$cond = join(' and ', $cond);
	} else {
		$cond = '1';
	}
	
	// 获取博客列表
	$blogs_pag = new Paginator(array(
		'col_names' => array('*'),
		'table_name' => 'blogs',
		'cond' => $cond,
		'tail' => 'order by post_time desc',
		'page_len' => 20
	));
	
	// 页面标题
	$page_title = $tab_name !== '全部' ? "博客 - {$tab_name}" : "博客";
?>
<?php echoUOJPageHeader($page_title) ?>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
					<div class="d-flex align-items-center">
						<h3 class="card-title mb-0">博客列表</h3>
					</div>
					<div>
						<ul class="nav nav-pills">
							<li class="nav-item">
								<a class="nav-link <?= $blog_tab === 'all' ? 'active' : '' ?>" 
								   href="/blogs">全部</a>
							</li>
							<li class="nav-item">
								<a class="nav-link <?= $blog_tab === 'solutions' ? 'active' : '' ?>" 
								   href="/blogs?tab=solutions">题解</a>
							</li>
							<li class="nav-item">
								<a class="nav-link <?= $blog_tab === 'experiences' ? 'active' : '' ?>" 
								   href="/blogs?tab=experiences">分享</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="card-body">
				<?php if ($blogs_pag->isEmpty()): ?>
					<div class="text-center text-muted">
						暂无博客
					</div>
				<?php else: ?>
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>标题</th>
									<th>作者</th>
									<th>发表时间</th>
									<th>类型</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($blogs_pag->get() as $blog): ?>
									<tr>
										<td>
											<a href="/blog/<?= $blog['id'] ?>">
												<?= HTML::escape($blog['title']) ?>
											</a>
										</td>
										<td><?= getUserLink($blog['poster']) ?></td>
										<td><?= $blog['post_time'] ?></td>
										<td>
											<?php if ($blog['type'] === 'S'): ?>
												<span class="badge bg-success">题解</span>
											<?php else: ?>
												<span class="badge bg-info">分享</span>
											<?php endif ?>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
					<?= $blogs_pag->pagination() ?>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>

<?php echoUOJPageFooter() ?>
