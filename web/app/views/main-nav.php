<div class="navbar navbar-light navbar-expand-md bg-light mb-4 shadow-lg rounded" role="navigation">
	<a class="navbar-brand" href="<?= HTML::url('/') ?>"><?= UOJConfig::$data['profile']['oj-name-short'] ?></a>
	<button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="nav navbar-nav mr-auto">
			<li class="nav-item"><a class="nav-link" href="<?= HTML::url('/contests') ?>"><span class="glyphicon glyphicon-stats"></span> <?= UOJLocale::get('contests') ?></a></li>
<<<<<<< HEAD
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="nav-problems" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="glyphicon glyphicon-list-alt"></span>
					<?= UOJLocale::get('problems') ?>
				</a>
				<div class="dropdown-menu" aria-labelledby="nav-problems">
					<a class="dropdown-item" href="/problems">题库</a>
					<a class="dropdown-item" href="/problems/problem_lists">题单</a>
					<a class="dropdown-item" href="<?= HTML::url('/problems/my') ?>"><?= UOJLocale::get('my problems') ?></a>
				</div>
			</li>
=======
			<li class="nav-item"><a class="nav-link" href="<?= HTML::url('/problems') ?>"><span class="glyphicon glyphicon-list-alt"></span> <?= UOJLocale::get('problems') ?></a></li>
>>>>>>> 42ae0f63f5caf925a774fa514ed3986208510af4
			<li class="nav-item"><a class="nav-link" href="<?= HTML::url('/submissions') ?>"><span class="glyphicon glyphicon-tasks"></span> <?= UOJLocale::get('submissions') ?></a></li>
			<li class="nav-item"><a class="nav-link" href="<?= HTML::url('/hacks') ?>"><span class="glyphicon glyphicon-flag"></span> <?= UOJLocale::get('hacks') ?></a></li>
			<li class="nav-item"><a class="nav-link" href="<?= HTML::blog_list_url() ?>"><span class="glyphicon glyphicon-edit"></span> <?= UOJLocale::get('blogs') ?></a></li>
			<li class="nav-item"><a class="nav-link" href="<?= HTML::url('/faq') ?>"><span class="glyphicon glyphicon-info-sign"></span> <?= UOJLocale::get('help') ?></a></li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="toolsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="glyphicon glyphicon-wrench"></span>

					<?= UOJLocale::get('tools') ?>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="<?= HTML::url('/paste') ?>"><span class="glyphicon glyphicon-paste"></span> <?= UOJLocale::get('code sharing') ?> </a>
					<a class="dropdown-item" href="<?= HTML::url('/map_visualizer') ?>"><span class="glyphicon glyphicon-retweet"></span> <?= UOJLocale::get('graph visualization') ?> </a>
				</div>
			</li>
		</ul>
		<form id="form-search-problem" class="form-inline my-2 my-lg-0" method="get">
			 <div class="input-group">
				<input type="text" class="form-control" name="search" id="input-search" placeholder="<?= UOJLocale::get('search')?>" />
				<div class="input-group-append">
					<button type="submit" class="btn btn-search btn-outline-primary" id="submit-search"><span class="glyphicon glyphicon-search"></span></button>
				</div>
			</div>
		</form>
	</div><!--/.nav-collapse -->
</div>
<script type="text/javascript">
	var zan_link = '';
	$('#form-search-problem').submit(function(e) {
		e.preventDefault();
		
		url = '<?= HTML::url('/problems') ?>';
		qs = [];
		$(['search']).each(function () {
			if ($('#input-' + this).val()) {
				qs.push(this + '=' + encodeURIComponent($('#input-' + this).val()));
			}
		});
		if (qs.length > 0) {
			url += '?' + qs.join('&');
		}
		location.href = url;
	});
</script>