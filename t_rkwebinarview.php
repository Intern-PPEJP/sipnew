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
$t_rkwebinar_view = new t_rkwebinar_view();

// Run the page
$t_rkwebinar_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rkwebinar_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_rkwebinar_view->isExport()) { ?>
<script>
var ft_rkwebinarview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ft_rkwebinarview = currentForm = new ew.Form("ft_rkwebinarview", "view");
	loadjs.done("ft_rkwebinarview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_rkwebinar_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_rkwebinar_view->ExportOptions->render("body") ?>
<?php $t_rkwebinar_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_rkwebinar_view->showPageHeader(); ?>
<?php
$t_rkwebinar_view->showMessage();
?>
<form name="ft_rkwebinarview" id="ft_rkwebinarview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rkwebinar">
<input type="hidden" name="modal" value="<?php echo (int)$t_rkwebinar_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_rkwebinar_view->rkwid->Visible) { // rkwid ?>
	<tr id="r_rkwid">
		<td class="<?php echo $t_rkwebinar_view->TableLeftColumnClass ?>"><span id="elh_t_rkwebinar_rkwid"><?php echo $t_rkwebinar_view->rkwid->caption() ?></span></td>
		<td data-name="rkwid" <?php echo $t_rkwebinar_view->rkwid->cellAttributes() ?>>
<span id="el_t_rkwebinar_rkwid">
<span<?php echo $t_rkwebinar_view->rkwid->viewAttributes() ?>><?php echo $t_rkwebinar_view->rkwid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rkwebinar_view->kegiatan->Visible) { // kegiatan ?>
	<tr id="r_kegiatan">
		<td class="<?php echo $t_rkwebinar_view->TableLeftColumnClass ?>"><span id="elh_t_rkwebinar_kegiatan"><?php echo $t_rkwebinar_view->kegiatan->caption() ?></span></td>
		<td data-name="kegiatan" <?php echo $t_rkwebinar_view->kegiatan->cellAttributes() ?>>
<span id="el_t_rkwebinar_kegiatan">
<span<?php echo $t_rkwebinar_view->kegiatan->viewAttributes() ?>><?php echo $t_rkwebinar_view->kegiatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rkwebinar_view->tanggal_kegiatan->Visible) { // tanggal_kegiatan ?>
	<tr id="r_tanggal_kegiatan">
		<td class="<?php echo $t_rkwebinar_view->TableLeftColumnClass ?>"><span id="elh_t_rkwebinar_tanggal_kegiatan"><?php echo $t_rkwebinar_view->tanggal_kegiatan->caption() ?></span></td>
		<td data-name="tanggal_kegiatan" <?php echo $t_rkwebinar_view->tanggal_kegiatan->cellAttributes() ?>>
<span id="el_t_rkwebinar_tanggal_kegiatan">
<span<?php echo $t_rkwebinar_view->tanggal_kegiatan->viewAttributes() ?>><?php echo $t_rkwebinar_view->tanggal_kegiatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rkwebinar_view->tahun->Visible) { // tahun ?>
	<tr id="r_tahun">
		<td class="<?php echo $t_rkwebinar_view->TableLeftColumnClass ?>"><span id="elh_t_rkwebinar_tahun"><?php echo $t_rkwebinar_view->tahun->caption() ?></span></td>
		<td data-name="tahun" <?php echo $t_rkwebinar_view->tahun->cellAttributes() ?>>
<span id="el_t_rkwebinar_tahun">
<span<?php echo $t_rkwebinar_view->tahun->viewAttributes() ?>><?php echo $t_rkwebinar_view->tahun->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$t_rkwebinar_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_rkwebinar_view->isExport()) { ?>
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
$t_rkwebinar_view->terminate();
?>