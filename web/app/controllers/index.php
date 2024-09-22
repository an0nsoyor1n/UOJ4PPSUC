<?php
	$blogs = DB::selectAll("select blogs.id, title, poster, post_time from important_blogs, blogs where is_hidden = 0 and important_blogs.blog_id = blogs.id order by level desc, important_blogs.blog_id desc limit 5");
?>
<?php echoUOJPageHeader(UOJConfig::$data['profile']['oj-name-short']) ?>

<!--开头块-->
<div style='margin:40px'>
	<h2 style='margin:10px'><?= UOJLocale::get('mainpage::welcome') ?></h2>
	<div class="row row-cols-1 row-cols-md-3 g-4">
		<div class="col">
		<div class="card h-100">
		  <img src="/images/UOJ.png" class="card-img-top" alt="...">
		  <div class="card-body">
			<h5 class="card-title"><?= UOJLocale::get('mainpage::welcome intro2 title') ?></h5>
			<p class="card-text"><?= UOJLocale::get('mainpage::welcome intro2') ?></p>
		  </div>
		  <div class="card-footer">
			<small class="text-muted">Last updated</small>
		  </div>
		</div>
	  </div>
	  <div class="col">
		<div class="card h-100">
		  <img src="/images/codinglanguage.png" class="card-img-top" alt="...">
		  <div class="card-body">
			<h5 class="card-title"><?= UOJLocale::get('mainpage::welcome intro1 title') ?></h5>
			<p class="card-text"><?= UOJLocale::get('mainpage::welcome intro1') ?></p>
		  </div>
		  <div class="card-footer">
			<small class="text-muted">Last updated</small>
		  </div>
		</div>
	  </div>

	  <div class="col">
		<div class="card h-100">
		  <img src="/images/ds.jpeg" class="card-img-top" alt="...">
		  <div class="card-body">
			<h5 class="card-title"><?= UOJLocale::get('mainpage::welcome intro3 title') ?></h5>
			<p class="card-text"><?= UOJLocale::get('mainpage::welcome intro3') ?></p>
		  </div>
		  <div class="card-footer">
			<small class="text-muted">Last updated</small>
		  </div>
		</div>
	  </div>
	</div>
</div>

<!--公告块-->
<h3><?= UOJLocale::get('announcements') ?></h3>
<div class="card card-default shadow rounded" style='padding: 20px;'>

	<div class="card-body">
		<div class="row">
			<div class="col-sm-12 col-md-9">
				<table class="table table-sm">
					<thead>
						<tr>
							<th style="width:60%"><?= UOJLocale::get('announcements') ?></th>
							<th style="width:20%"></th>
							<th style="width:20%"></th>
						</tr>
					</thead>
				  	<tbody>
					<?php $now_cnt = 0; ?>
					<?php foreach ($blogs as $blog): ?>
						<?php
							$now_cnt++;
							$new_tag = '';
							if ((time() - strtotime($blog['post_time'])) / 3600 / 24 <= 7) {
								$new_tag = '<sup style="color:red">&nbsp;new</sup>';
							}
						?>
						<tr>
							<td><a href="/blogs/<?= $blog['id'] ?>"><?= $blog['title'] ?></a><?= $new_tag ?></td>
							<td>by <?= getUserLink($blog['poster']) ?></td>
							<td><small><?= $blog['post_time'] ?></small></td>
						</tr>
					<?php endforeach ?>
					<?php for ($i = $now_cnt + 1; $i <= 5; $i++): ?>
						<tr><td colspan="233">&nbsp;</td></tr>
					<?php endfor ?>
						<tr><td class="text-right" colspan="233"><a href="/announcements"><?= UOJLocale::get('all the announcements') ?></a></td></tr>
					</tbody>
				</table>
			</div>
			<div class="col-xs-6 col-sm-4 col-md-3">
				<img class="media-object img-thumbnail" src="/images/logo.png" alt="Logo" />
			</div>
		</div>
	</div>
</div>

<!--排行榜块-->
<div class="row">
	<div class="col-sm-12 mt-4">
		<h3><?= UOJLocale::get('top rated') ?></h3>
		<div class='shadow rounded' style='padding: 20px;'>
			<?php echoRanklist(array('echo_full' => '', 'top10' => '')) ?>
			<div class="text-center">
				<a href="/ranklist"><?= UOJLocale::get('view all') ?></a>
			</div>
		</div>
	</div>
</div>

<!--比赛介绍块，展示蓝桥杯、ACM比赛的概况-->

<h3 style='margin-top: 20px'><?= UOJLocale::get('mainpage::platform and contest') ?></h3>
<div class='shadow rounded' style='margin-top:20px;padding: 20px;'>
	<div class="bd-example">
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="4"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="5"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="6"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="7"></li>
    </ol>
    <div class="carousel-inner">
		<!-- 蓝桥 -->
		<div class="carousel-item active">
			<img src="/images/lanqiao.png" class="d-block" alt="..." style='height: 400px; margin: 0 auto; position: relative;'>
			<div class="carousel-caption d-none d-md-block">
				<h5 style='color: black; padding: 5px;' ><?= UOJLocale::get('mainpage::Programming Competition') ?>:<?= UOJLocale::get('mainpage::lanqiao') ?></h5>
				<p style='color: black; padding: 5px;'><?= UOJLocale::get('mainpage::intro of lanqiao') ?></p>
				<button type="button" class="btn btn-primary" onclick="location.href='https://dasai.lanqiao.cn/'"><?= UOJLocale::get('mainpage::detail') ?></button>

			</div>
			<!-- 添加渐变层 -->
			<div style='
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background:
					linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0.7) 30%, rgba(255, 255, 255, 0.4) 60%, rgba(255, 255, 255, 0.1) 70%, rgba(255, 255, 255, 0) 80%),
					linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%);
			'></div>

		</div>

	    <!-- ACM -->
		<div class="carousel-item">
			<img src="/images/ACM.png" class="d-block" alt="..." style='height: 400px; margin: 0 auto; position: relative;'>
			<div class="carousel-caption d-none d-md-block">
				<h5 style='color: black; padding: 5px;'><?= UOJLocale::get('mainpage::Programming Competition') ?>:<?= UOJLocale::get('mainpage::acm') ?></h5>
				<p style='color: black; padding: 5px;'><?= UOJLocale::get('mainpage::intro of acm') ?></p>
				<button type="button" class="btn btn-primary" onclick="location.href='https://icpc.pku.edu.cn/'"><?= UOJLocale::get('mainpage::detail') ?></button>
			</div>
			<!-- 添加渐变层 -->
			<div style='
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background:
					linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0.7) 30%, rgba(255, 255, 255, 0.4) 60%, rgba(255, 255, 255, 0.1) 70%, rgba(255, 255, 255, 0) 80%),
					linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%);
			'></div>
		</div>

	    <!-- codeforces -->
		<div class="carousel-item">
			<img src="/images/codeforces.png" class="d-block" alt="..." style='height: 400px; margin: 0 auto; position: relative;'>
			<div class="carousel-caption d-none d-md-block">
				<h5 style='color: black; padding: 5px;'><?= UOJLocale::get('mainpage::Programming Competition Platform') ?>:<?= UOJLocale::get('mainpage::codeforces') ?></h5>
				<p style='color: black; padding: 5px;'><?= UOJLocale::get('mainpage::intro of codeforces') ?></p>
				<button type="button" class="btn btn-primary" onclick="location.href='https://codeforces.com/'"><?= UOJLocale::get('mainpage::detail') ?></button>
			</div>
			<!-- 添加渐变层 -->
			<div style='
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background:
					linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0.7) 30%, rgba(255, 255, 255, 0.4) 60%, rgba(255, 255, 255, 0.1) 70%, rgba(255, 255, 255, 0) 80%),
					linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%);
			'></div>
		</div>


		<!-- PKUOJ -->
		<div class="carousel-item">
			<img src="/images/POJ.png" class="d-block" alt="..." style='height: 400px; margin: 0 auto; position: relative;'>
			<div class="carousel-caption d-none d-md-block">
				<h5 style='color: black; padding: 5px;'><?= UOJLocale::get('mainpage::Programming Competition Platform') ?>:<?= UOJLocale::get('mainpage::PKU JudgeOnline') ?></h5>
				<p style='color: black; padding: 5px;'><?= UOJLocale::get('mainpage::intro of PKU JudgeOnline') ?></p>
				<button type="button" class="btn btn-primary" onclick="location.href='http://poj.org/problemlist'"><?= UOJLocale::get('mainpage::detail') ?></button>
			</div>
			<!-- 添加渐变层 -->
			<div style='
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background:
					linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0.7) 30%, rgba(255, 255, 255, 0.4) 60%, rgba(255, 255, 255, 0.1) 70%, rgba(255, 255, 255, 0) 80%),
					linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%);
			'></div>
		</div>

		<!-- Luogu -->
		<div class="carousel-item">
			<img src="/images/luogu.png" class="d-block" alt="..." style='height: 400px; margin: 0 auto; position: relative;'>
			<div class="carousel-caption d-none d-md-block">
				<h5 style='color: black; padding: 5px;'><?= UOJLocale::get('mainpage::Programming Competition Platform') ?>:<?= UOJLocale::get('mainpage::Luogu') ?></h5>
				<p style='color: black; padding: 5px;'><?= UOJLocale::get('mainpage::intro of Luogu') ?></p>
				<button type="button" class="btn btn-primary" onclick="location.href='https://www.luogu.com.cn/'"><?= UOJLocale::get('mainpage::detail') ?></button>
			</div>
			<!-- 添加渐变层 -->
			<div style='
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background:
					linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0.7) 30%, rgba(255, 255, 255, 0.4) 60%, rgba(255, 255, 255, 0.1) 70%, rgba(255, 255, 255, 0) 80%),
					linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%);
			'></div>
		</div>

		<!-- Virtual Judge -->
		<div class="carousel-item">
			<img src="/images/Voj.png" class="d-block" alt="..." style='height: 400px; margin: 0 auto; position: relative;'>
			<div class="carousel-caption d-none d-md-block">
				<h5 style='color: black; padding: 5px;'><?= UOJLocale::get('mainpage::Programming Competition Platform') ?>:<?= UOJLocale::get('mainpage::Virtual Judge') ?></h5>
				<p style='color: black; padding: 5px;'><?= UOJLocale::get('mainpage::intro of Virtual Judge') ?></p>
				<button type="button" class="btn btn-primary" onclick="location.href='https://vjudge.net/'"><?= UOJLocale::get('mainpage::detail') ?></button>
			</div>
			<!-- 添加渐变层 -->
			<div style='
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background:
					linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0.7) 30%, rgba(255, 255, 255, 0.4) 60%, rgba(255, 255, 255, 0.1) 70%, rgba(255, 255, 255, 0) 80%),
					linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%);
			'></div>
		</div>
 
		<!-- ACWing -->
		<div class="carousel-item">
				<img src="/images/acwing.jpeg" class="d-block" alt="..." style='height: 400px; margin: 0 auto; position: relative;'>
				<div class="carousel-caption d-none d-md-block">
					<h5 style='color: black; padding: 5px;'><?= UOJLocale::get('mainpage::Programming Competition Platform') ?>:<?= UOJLocale::get('mainpage::acwing') ?></h5>
					<p style='color: black; padding: 5px;'><?= UOJLocale::get('mainpage::intro of acwing') ?></p>
					<button type="button" class="btn btn-primary" onclick="location.href='https://www.acwing.com/'"><?= UOJLocale::get('mainpage::detail') ?></button>
				</div>
				<!-- 添加渐变层 -->
				<div style='
					position: absolute;
					top: 0;
					left: 0;
					width: 100%;
					height: 100%;
					background:
						linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0.7) 30%, rgba(255, 255, 255, 0.4) 60%, rgba(255, 255, 255, 0.1) 70%, rgba(255, 255, 255, 0) 80%),
						linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%);
				'></div>
			</div>
		

		<!-- oiwiki -->
		<div class="carousel-item">
			<img src="/images/oiwiki.jpeg" class="d-block" alt="..." style='height: 400px; width: 900px; margin: 0 auto; position: relative;'>
			<div class="carousel-caption d-none d-md-block">
				<h5 style='color: black; padding: 5px;'><?= UOJLocale::get('mainpage::Programming Competition Platform') ?>:<?= UOJLocale::get('mainpage::oiwiki') ?></h5>
				<p style='color: black; padding: 5px;'><?= UOJLocale::get('mainpage::intro of oiwiki') ?></p>
				<button type="button" class="btn btn-primary" onclick="location.href='https://oi-wiki.org/'"><?= UOJLocale::get('mainpage::detail') ?></button>
			</div>
			<!-- 添加渐变层 -->
			<div style='
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background:
					linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0.7) 30%, rgba(255, 255, 255, 0.4) 60%, rgba(255, 255, 255, 0.1) 70%, rgba(255, 255, 255, 0) 80%),
					linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%);
			'></div>
		</div>


	</div>

   <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev" style="color: #000000;">
	  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	  <span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next" style="color: #000000;">
	  <span class="carousel-control-next-icon" aria-hidden="true"></span>
	  <span class="sr-only">Next</span>
	</a>

  </div>
</div>
</div>


<?php echoUOJPageFooter() ?>
