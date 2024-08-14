<?php
namespace PHPMaker2020\ppei_20;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$t_rwpendd_view = new t_rwpendd_view();

// Run the page
$t_rwpendd_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rwpendd_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_rwpendd_view->isExport()) { ?>
<script>
var ft_rwpenddview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ft_rwpenddview = currentForm = new ew.Form("ft_rwpenddview", "view");
	loadjs.done("ft_rwpenddview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_rwpendd_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_rwpendd_view->ExportOptions->render("body") ?>
<?php $t_rwpendd_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_rwpendd_view->showPageHeader(); ?>
<?php
$t_rwpendd_view->showMessage();
?>
<form name="ft_rwpenddview" id="ft_rwpenddview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rwpendd">
<input type="hidden" name="modal" value="<?php echo (int)$t_rwpendd_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_rwpendd_view->penddid->Visible) { // penddid ?>
	<tr id="r_penddid">
		<td class="<?php echo $t_rwpendd_view->TableLeftColumnClass ?>"><span id="elh_t_rwpendd_penddid"><?php echo $t_rwpendd_view->penddid->caption() ?></span></td>
		<td data-name="penddid" <?php echo $t_rwpendd_view->penddid->cellAttributes() ?>>
<span id="el_t_rwpendd_penddid">
<span<?php echo $t_rwpendd_view->penddid->viewAttributes() ?>><?php echo $t_rwpendd_view->penddid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwpendd_view->bioid->Visible) { // bioid ?>
	<tr id="r_bioid">
		<td class="<?php echo $t_rwpendd_view->TableLeftColumnClass ?>"><span id="elh_t_rwpendd_bioid"><?php echo $t_rwpendd_view->bioid->caption() ?></span></td>
		<td data-name="bioid" <?php echo $t_rwpendd_view->bioid->cellAttributes() ?>>
<span id="el_t_rwpendd_bioid">
<span<?php echo $t_rwpendd_view->bioid->viewAttributes() ?>><?php echo $t_rwpendd_view->bioid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwpendd_view->sekolah->Visible) { // sekolah ?>
	<tr id="r_sekolah">
		<td class="<?php echo $t_rwpendd_view->TableLeftColumnClass ?>"><span id="elh_t_rwpendd_sekolah"><?php echo $t_rwpendd_view->sekolah->caption() ?></span></td>
		<td data-name="sekolah" <?php echo $t_rwpendd_view->sekolah->cellAttributes() ?>>
<span id="el_t_rwpendd_sekolah">
<span<?php echo $t_rwpendd_view->sekolah->viewAttributes() ?>><?php echo $t_rwpendd_view->sekolah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwpendd_view->tempat->Visible) { // tempat ?>
	<tr id="r_tempat">
		<td class="<?php echo $t_rwpendd_view->TableLeftColumnClass ?>"><span id="elh_t_rwpendd_tempat"><?php echo $t_rwpendd_view->tempat->caption() ?></span></td>
		<td data-name="tempat" <?php echo $t_rwpendd_view->tempat->cellAttributes() ?>>
<span id="el_t_rwpendd_tempat">
<span<?php echo $t_rwpendd_view->tempat->viewAttributes() ?>><?php echo $t_rwpendd_view->tempat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwpendd_view->tahun->Visible) { // tahun ?>
	<tr id="r_tahun">
		<td class="<?php echo $t_rwpendd_view->TableLeftColumnClass ?>"><span id="elh_t_rwpendd_tahun"><?php echo $t_rwpendd_view->tahun->caption() ?></span></td>
		<td data-name="tahun" <?php echo $t_rwpendd_view->tahun->cellAttributes() ?>>
<span id="el_t_rwpendd_tahun">
<span<?php echo $t_rwpendd_view->tahun->viewAttributes() ?>><?php echo $t_rwpendd_view->tahun->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwpendd_view->created_by->Visible) { // created_by ?>
	<tr id="r_created_by">
		<td class="<?php echo $t_rwpendd_view->TableLeftColumnClass ?>"><span id="elh_t_rwpendd_created_by"><?php echo $t_rwpendd_view->created_by->caption() ?></span></td>
		<td data-name="created_by" <?php echo $t_rwpendd_view->created_by->cellAttributes() ?>>
<span id="el_t_rwpendd_created_by">
<span<?php echo $t_rwpendd_view->created_by->viewAttributes() ?>><?php echo $t_rwpendd_view->created_by->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwpendd_view->created_at->Visible) { // created_at ?>
	<tr id="r_created_at">
		<td class="<?php echo $t_rwpendd_view->TableLeftColumnClass ?>"><span id="elh_t_rwpendd_created_at"><?php echo $t_rwpendd_view->created_at->caption() ?></span></td>
		<td data-name="created_at" <?php echo $t_rwpendd_view->created_at->cellAttributes() ?>>
<span id="el_t_rwpendd_created_at">
<span<?php echo $t_rwpendd_view->created_at->viewAttributes() ?>><?php echo $t_rwpendd_view->created_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwpendd_view->updated_by->Visible) { // updated_by ?>
	<tr id="r_updated_by">
		<td class="<?php echo $t_rwpendd_view->TableLeftColumnClass ?>"><span id="elh_t_rwpendd_updated_by"><?php echo $t_rwpendd_view->updated_by->caption() ?></span></td>
		<td data-name="updated_by" <?php echo $t_rwpendd_view->updated_by->cellAttributes() ?>>
<span id="el_t_rwpendd_updated_by">
<span<?php echo $t_rwpendd_view->updated_by->viewAttributes() ?>><?php echo $t_rwpendd_view->updated_by->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwpendd_view->updated_at->Visible) { // updated_at ?>
	<tr id="r_updated_at">
		<td class="<?php echo $t_rwpendd_view->TableLeftColumnClass ?>"><span id="elh_t_rwpendd_updated_at"><?php echo $t_rwpendd_view->updated_at->caption() ?></span></td>
		<td data-name="updated_at" <?php echo $t_rwpendd_view->updated_at->cellAttributes() ?>>
<span id="el_t_rwpendd_updated_at">
<span<?php echo $t_rwpendd_view->updated_at->viewAttributes() ?>><?php echo $t_rwpendd_view->updated_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$t_rwpendd_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_rwpendd_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$t_rwpendd_view->terminate();
?>