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
$t_tahapan_view = new t_tahapan_view();

// Run the page
$t_tahapan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_tahapan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_tahapan_view->isExport()) { ?>
<script>
var ft_tahapanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ft_tahapanview = currentForm = new ew.Form("ft_tahapanview", "view");
	loadjs.done("ft_tahapanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_tahapan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_tahapan_view->ExportOptions->render("body") ?>
<?php $t_tahapan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_tahapan_view->showPageHeader(); ?>
<?php
$t_tahapan_view->showMessage();
?>
<form name="ft_tahapanview" id="ft_tahapanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_tahapan">
<input type="hidden" name="modal" value="<?php echo (int)$t_tahapan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_tahapan_view->kdtahapan->Visible) { // kdtahapan ?>
	<tr id="r_kdtahapan">
		<td class="<?php echo $t_tahapan_view->TableLeftColumnClass ?>"><span id="elh_t_tahapan_kdtahapan"><?php echo $t_tahapan_view->kdtahapan->caption() ?></span></td>
		<td data-name="kdtahapan" <?php echo $t_tahapan_view->kdtahapan->cellAttributes() ?>>
<span id="el_t_tahapan_kdtahapan">
<span<?php echo $t_tahapan_view->kdtahapan->viewAttributes() ?>></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_tahapan_view->Tahapan->Visible) { // Tahapan ?>
	<tr id="r_Tahapan">
		<td class="<?php echo $t_tahapan_view->TableLeftColumnClass ?>"><span id="elh_t_tahapan_Tahapan"><?php echo $t_tahapan_view->Tahapan->caption() ?></span></td>
		<td data-name="Tahapan" <?php echo $t_tahapan_view->Tahapan->cellAttributes() ?>>
<span id="el_t_tahapan_Tahapan">
<span<?php echo $t_tahapan_view->Tahapan->viewAttributes() ?>><?php echo $t_tahapan_view->Tahapan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$t_tahapan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_tahapan_view->isExport()) { ?>
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
$t_tahapan_view->terminate();
?>