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
$t_rwtraining_view = new t_rwtraining_view();

// Run the page
$t_rwtraining_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rwtraining_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_rwtraining_view->isExport()) { ?>
<script>
var ft_rwtrainingview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ft_rwtrainingview = currentForm = new ew.Form("ft_rwtrainingview", "view");
	loadjs.done("ft_rwtrainingview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_rwtraining_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_rwtraining_view->ExportOptions->render("body") ?>
<?php $t_rwtraining_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_rwtraining_view->showPageHeader(); ?>
<?php
$t_rwtraining_view->showMessage();
?>
<form name="ft_rwtrainingview" id="ft_rwtrainingview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rwtraining">
<input type="hidden" name="modal" value="<?php echo (int)$t_rwtraining_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_rwtraining_view->rwtrainingid->Visible) { // rwtrainingid ?>
	<tr id="r_rwtrainingid">
		<td class="<?php echo $t_rwtraining_view->TableLeftColumnClass ?>"><span id="elh_t_rwtraining_rwtrainingid"><?php echo $t_rwtraining_view->rwtrainingid->caption() ?></span></td>
		<td data-name="rwtrainingid" <?php echo $t_rwtraining_view->rwtrainingid->cellAttributes() ?>>
<span id="el_t_rwtraining_rwtrainingid">
<span<?php echo $t_rwtraining_view->rwtrainingid->viewAttributes() ?>><?php echo $t_rwtraining_view->rwtrainingid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwtraining_view->bioid->Visible) { // bioid ?>
	<tr id="r_bioid">
		<td class="<?php echo $t_rwtraining_view->TableLeftColumnClass ?>"><span id="elh_t_rwtraining_bioid"><?php echo $t_rwtraining_view->bioid->caption() ?></span></td>
		<td data-name="bioid" <?php echo $t_rwtraining_view->bioid->cellAttributes() ?>>
<span id="el_t_rwtraining_bioid">
<span<?php echo $t_rwtraining_view->bioid->viewAttributes() ?>><?php echo $t_rwtraining_view->bioid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwtraining_view->training->Visible) { // training ?>
	<tr id="r_training">
		<td class="<?php echo $t_rwtraining_view->TableLeftColumnClass ?>"><span id="elh_t_rwtraining_training"><?php echo $t_rwtraining_view->training->caption() ?></span></td>
		<td data-name="training" <?php echo $t_rwtraining_view->training->cellAttributes() ?>>
<span id="el_t_rwtraining_training">
<span<?php echo $t_rwtraining_view->training->viewAttributes() ?>><?php echo $t_rwtraining_view->training->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwtraining_view->tempat->Visible) { // tempat ?>
	<tr id="r_tempat">
		<td class="<?php echo $t_rwtraining_view->TableLeftColumnClass ?>"><span id="elh_t_rwtraining_tempat"><?php echo $t_rwtraining_view->tempat->caption() ?></span></td>
		<td data-name="tempat" <?php echo $t_rwtraining_view->tempat->cellAttributes() ?>>
<span id="el_t_rwtraining_tempat">
<span<?php echo $t_rwtraining_view->tempat->viewAttributes() ?>><?php echo $t_rwtraining_view->tempat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwtraining_view->tahun->Visible) { // tahun ?>
	<tr id="r_tahun">
		<td class="<?php echo $t_rwtraining_view->TableLeftColumnClass ?>"><span id="elh_t_rwtraining_tahun"><?php echo $t_rwtraining_view->tahun->caption() ?></span></td>
		<td data-name="tahun" <?php echo $t_rwtraining_view->tahun->cellAttributes() ?>>
<span id="el_t_rwtraining_tahun">
<span<?php echo $t_rwtraining_view->tahun->viewAttributes() ?>><?php echo $t_rwtraining_view->tahun->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwtraining_view->created_at->Visible) { // created_at ?>
	<tr id="r_created_at">
		<td class="<?php echo $t_rwtraining_view->TableLeftColumnClass ?>"><span id="elh_t_rwtraining_created_at"><?php echo $t_rwtraining_view->created_at->caption() ?></span></td>
		<td data-name="created_at" <?php echo $t_rwtraining_view->created_at->cellAttributes() ?>>
<span id="el_t_rwtraining_created_at">
<span<?php echo $t_rwtraining_view->created_at->viewAttributes() ?>><?php echo $t_rwtraining_view->created_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwtraining_view->created_by->Visible) { // created_by ?>
	<tr id="r_created_by">
		<td class="<?php echo $t_rwtraining_view->TableLeftColumnClass ?>"><span id="elh_t_rwtraining_created_by"><?php echo $t_rwtraining_view->created_by->caption() ?></span></td>
		<td data-name="created_by" <?php echo $t_rwtraining_view->created_by->cellAttributes() ?>>
<span id="el_t_rwtraining_created_by">
<span<?php echo $t_rwtraining_view->created_by->viewAttributes() ?>><?php echo $t_rwtraining_view->created_by->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwtraining_view->updated_by->Visible) { // updated_by ?>
	<tr id="r_updated_by">
		<td class="<?php echo $t_rwtraining_view->TableLeftColumnClass ?>"><span id="elh_t_rwtraining_updated_by"><?php echo $t_rwtraining_view->updated_by->caption() ?></span></td>
		<td data-name="updated_by" <?php echo $t_rwtraining_view->updated_by->cellAttributes() ?>>
<span id="el_t_rwtraining_updated_by">
<span<?php echo $t_rwtraining_view->updated_by->viewAttributes() ?>><?php echo $t_rwtraining_view->updated_by->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwtraining_view->updated_at->Visible) { // updated_at ?>
	<tr id="r_updated_at">
		<td class="<?php echo $t_rwtraining_view->TableLeftColumnClass ?>"><span id="elh_t_rwtraining_updated_at"><?php echo $t_rwtraining_view->updated_at->caption() ?></span></td>
		<td data-name="updated_at" <?php echo $t_rwtraining_view->updated_at->cellAttributes() ?>>
<span id="el_t_rwtraining_updated_at">
<span<?php echo $t_rwtraining_view->updated_at->viewAttributes() ?>><?php echo $t_rwtraining_view->updated_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$t_rwtraining_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_rwtraining_view->isExport()) { ?>
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
$t_rwtraining_view->terminate();
?>