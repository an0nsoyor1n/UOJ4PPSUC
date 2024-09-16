<?php
	requireLib('hljs');
	requireLib('mathjax');
	echoUOJPageHeader(UOJLocale::get('help')) 
?>
<article>
	<header>
		<h2 class="page-header"><?= UOJLocale::get('frequently asked questions') ?></h2>
	</header>
	<section class='shadow rounded' style='padding: 20px;'>
		<div class="card my-1">
			<div class="card-header collapsed" id="headerOne" data-toggle="collapse" data-target="#collapseOne" style="cursor:pointer;">
				<h5 class="mb-0"><?= UOJLocale::get('faq::q1') ?></h5>
			</div>
			<div id="collapseOne" class="collapse">
				<div class="card-body">
					<p><?= UOJLocale::get('faq::a1') ?></p>
				</div>
			</div>
		</div>
		<div class="card my-1">
			<div class="card-header collapsed" id="headerTwo" data-toggle="collapse" data-target="#collapseTwo" style="cursor:pointer;">
				<h5 class="mb-0"><?= UOJLocale::get('faq::q2') ?></h5>
			</div>
			<div id="collapseTwo" class="collapse">
				<div class="card-body">
					<p><?= UOJLocale::get('faq::a2') ?></p>
				</div>
			</div>
		</div>
		<div class="card my-1">
			<div class="card-header collapsed" id="headerThree" data-toggle="collapse" data-target="#collapseThree" style="cursor:pointer;">
				<h5 class="mb-0"><?= UOJLocale::get('faq::q3') ?></h5>
			</div>
			<div id="collapseThree" class="collapse">
				<div class="card-body">
                    <p><?= UOJLocale::get('faq::a3') ?></p>
				</div>
			</div>
		</div>
		<div class="card my-1">
			<div class="card-header collapsed" id="headerFour" data-toggle="collapse" data-target="#collapseFour" style="cursor:pointer;">
				<h5 class="mb-0"><?= UOJLocale::get('faq::q4') ?></h5>
			</div>
			<div id="collapseFour" class="collapse">
				<div class="card-body">
	                <p><?= UOJLocale::get('faq::a4') ?></p>
				</div>
			</div>
		</div>
		<div class="card my-1">
			<div class="card-header collapsed" id="headerFive" data-toggle="collapse" data-target="#collapseFive" style="cursor:pointer;">
				<h5 class="mb-0"><?= UOJLocale::get('faq::q5') ?></h5>
			</div>
			<div id="collapseFive" class="collapse">
				<div class="card-body">
					<p><?= UOJLocale::get('faq::a5') ?></p>
				</div>
			</div>
		</div>
		<div class="card my-1">
			<div class="card-header collapsed" id="headerSix" data-toggle="collapse" data-target="#collapseSix" style="cursor:pointer;">
				<h5 class="mb-0"><?= UOJLocale::get('faq::q6') ?></h5>
			</div>
			<div id="collapseSix" class="collapse">
				<div class="card-body">
					<p><?= UOJLocale::get('faq::a6') ?></p>
				</div>
			</div>
		</div>
		<div class="card my-1">
			<div class="card-header collapsed" id="headerSeven" data-toggle="collapse" data-target="#collapseSeven" style="cursor:pointer;">
				<h5 class="mb-0"><?= UOJLocale::get('faq::q7') ?></h5>
			</div>
			<div id="collapseSeven" class="collapse">
				<div class="card-body">
					<p><?= UOJLocale::get('faq::a7') ?></p>
				</div>
			</div>
		</div>
		<div class="card my-1">
			<div class="card-header collapsed" id="headerEight" data-toggle="collapse" data-target="#collapseEight" style="cursor:pointer;">
				<h5 class="mb-0"><?= UOJLocale::get('faq::q8') ?></h5>
			</div>
			<div id="collapseEight" class="collapse">
				<div class="card-body">
					<p><?= UOJLocale::get('faq::a8') ?></p>
				</div>
			</div>
		</div>
		<div class="card my-1">
			<div class="card-header collapsed" id="headerNine" data-toggle="collapse" data-target="#collapseNine" style="cursor:pointer;">
				<h5 class="mb-0"><?= UOJLocale::get('faq::q9') ?></h5>
			</div>
			<div id="collapseNine" class="collapse">
				<div class="card-body">
					<p></p>
 					 <?= UOJLocale::get('faq::a9') ?>
				</div>
			</div>
		</div>
	</section>
</article>

<?php echoUOJPageFooter() ?>
