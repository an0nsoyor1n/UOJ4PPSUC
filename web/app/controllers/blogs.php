<?php
	requirePHPLib('form');
	
	function echoBlogCell($blog) {
		echo '<tr>';
		echo '<td>' . getBlogLink($blog['id']) . '</td>';
		echo '<td>' . getUserLink($blog['poster']) . '</td>';
		echo '<td>' . $blog['post_time'] . '</td>';
		echo '</tr>';
	}
	$header = <<<EOD
	<tr>
		<th width="60%">标题</th>
		<th width="20%">发表者</th>
		<th width="20%">发表日期</th>
	</tr>
EOD;
	$config = array();
	$config['table_classes'] = array('table', 'table-hover');
?>
<?php echoUOJPageHeader(UOJLocale::get('blogs')) ?>
<?php if (Auth::check()): ?>
<div class="float-right" style='margin: 10px'>
	<div class="btn-group">
		<a href="<?= HTML::blog_url(Auth::id(), '/') ?>" class="btn btn-secondary btn-sm"><?= UOJLocale::get('my blog home page') ?></a>
		<a href="<?= HTML::blog_url(Auth::id(), '/post/new/write')?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span> <?= UOJLocale::get('write a new blog') ?></a>
	</div>
</div>
<?php endif ?>
<div class='shadow rounded' style='padding: 20px;'>
	<h3><?= UOJLocale::get('blog Overview') ?></h3>
	<?php echoLongTable(array('id', 'poster', 'title', 'post_time', 'zan'), 'blogs', 'is_hidden = 0', 'order by post_time desc', $header, 'echoBlogCell', $config); ?>
</div>
<?php echoUOJPageFooter() ?>
