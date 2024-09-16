<?php
	if (!isset($ShowPageFooter)) {
		$ShowPageFooter = true;
	}
?>
			</div>
			<?php if ($ShowPageFooter): ?>
			<div class="uoj-footer">
				<div class="btn-group dropright mb-3">
					<button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown">
						<span class="glyphicon glyphicon-globe"></span> <?= UOJLocale::get('_common_name') ?>
					</button>
					<!--更改语言选项-->
					<div class="dropdown-menu">
						<a class="dropdown-item" href="<?= HTML::url(UOJContext::requestURI(), array('params' => array('locale' => 'zh-cn'))) ?>">中文</a>
						<a class="dropdown-item" href="<?= HTML::url(UOJContext::requestURI(), array('params' => array('locale' => 'en'))) ?>">English</a>
						<a class="dropdown-item" href="<?= HTML::url(UOJContext::requestURI(), array('params' => array('locale' => 'rus'))) ?>">Русский язык</a>
						<a class="dropdown-item" href="<?= HTML::url(UOJContext::requestURI(), array('params' => array('locale' => 'ger'))) ?>">Deutsch</a>
						<a class="dropdown-item" href="<?= HTML::url(UOJContext::requestURI(), array('params' => array('locale' => 'fra'))) ?>">Français</a>
						<a class="dropdown-item" href="<?= HTML::url(UOJContext::requestURI(), array('params' => array('locale' => 'spa'))) ?>">Español</a>
						<a class="dropdown-item" href="<?= HTML::url(UOJContext::requestURI(), array('params' => array('locale' => 'por'))) ?>">Português</a>
					</div>
				</div>
				
				<ul class="list-inline"><li class="list-inline-item"><?= UOJConfig::$data['profile']['oj-name'] ?></li></ul>
				<?php if (UOJConfig::$data['profile']['ICP-license'] != '' && preg_match_all('/(\d+\.?\d+)/', UOJConfig::$data['profile']['ICP-license'], $ICP_number)): ?>
				<p><a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=<?= $ICP_number[0][0] ?>" style="text-decoration:none;"><img src="http://uoj.ac/pictures/beian.png" /> <?= UOJConfig::$data['profile']['ICP-license'] ?></a></p>
				<?php endif ?>
				<p><?= UOJLocale::get('server time') ?>: <?= UOJTime::$time_now_str ?> | <a href="https://github.com/UniversalOJ/UOJ-System" target="_blank"><?= UOJLocale::get('opensource project') ?></a></p>
			</div>
			<?php endif ?>
		</div>
		<!-- /container -->
	</body>
</html>
