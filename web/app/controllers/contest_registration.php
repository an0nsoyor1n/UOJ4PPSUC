<?php
	requirePHPLib('form');
	if (!validateUInt($_GET['id']) || !($contest = queryContest($_GET['id']))) {
		become404Page();
	}
	genMoreContestInfo($contest);
	
	if ($myUser == null) {
		redirectToLogin();
	} elseif (hasContestPermission($myUser, $contest) || hasRegistered($myUser, $contest) || $contest['cur_progress'] != CONTEST_NOT_STARTED) {
		redirectTo('/contests');
	}
	
	$register_form = new UOJForm('register');
	$register_form->handle = function() {
		global $myUser, $contest;
		DB::query("insert into contests_registrants (username, user_rating, contest_id, has_participated) values ('{$myUser['username']}', {$myUser['rating']}, {$contest['id']}, 0)");
		updateContestPlayerNum($contest);
	};
	$register_form->submit_button_config['class_str'] = 'btn btn-primary';
	$register_form->submit_button_config['text'] = '报名比赛';
	$register_form->succ_href = "/contests";
	
	$register_form->runAtServer();
?>
<?php echoUOJPageHeader(HTML::stripTags($contest['name']) . ' - 报名') ?>
<h1 class="page-header"><?= UOJLocale::get('contests::contest rule') ?></h1>
<ul>
	<li><?= UOJLocale::get('contests::contest rule description 1') ?></li>
	<li><?= UOJLocale::get('contests::contest rule description 2') ?></li>
	<li><?= UOJLocale::get('contests::contest rule description 3') ?></li>
	<li><?= UOJLocale::get('contests::contest rule description 4') ?></li>
	<li><?= UOJLocale::get('contests::contest rule description 5') ?></li>
	<li><?= UOJLocale::get('contests::contest rule description 6') ?></li>
</ul>
<?php $register_form->printHTML(); ?>
<?php echoUOJPageFooter() ?>
