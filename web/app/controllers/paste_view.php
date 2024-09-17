<?php

$paste_id = $_GET['rand_str_id'];

$paste = DB::selectFirst("select * from pastes where `index` = '".DB::escape($paste_id)."'");
if (!$paste) {
	become404Page();
}
$REQUIRE_LIB['shjs'] = "";
echoUOJPageHeader("Paste!");
<div class="d-none d-sm-block rounded" style="padding: 20px;box-shadow: 5px 10px 15px 5px rgba(0, 0, 0, 0.5);">
	echoPasteContent($paste);
</div>
echoUOJPageFooter();