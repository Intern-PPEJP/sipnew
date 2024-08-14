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
$t_pegawai_view = new t_pegawai_view();

// Run the page
$t_pegawai_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pegawai_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_pegawai_view->isExport()) { ?>
<script>
var ft_pegawaiview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ft_pegawaiview = currentForm = new ew.Form("ft_pegawaiview", "view");
	loadjs.done("ft_pegawaiview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_pegawai_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_pegawai_view->ExportOptions->render("body") ?>
<?php $t_pegawai_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_pegawai_view->showPageHeader(); ?>
<?php
$t_pegawai_view->showMessage();
?>
<form name="ft_pegawaiview" id="ft_pegawaiview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_pegawai">
<input type="hidden" name="modal" value="<?php echo (int)$t_pegawai_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_pegawai_view->nip->Visible) { // nip ?>
	<tr id="r_nip">
		<td class="<?php echo $t_pegawai_view->TableLeftColumnClass ?>"><span id="elh_t_pegawai_nip"><?php echo $t_pegawai_view->nip->caption() ?></span></td>
		<td data-name="nip" <?php echo $t_pegawai_view->nip->cellAttributes() ?>>
<span id="el_t_pegawai_nip">
<span<?php echo $t_pegawai_view->nip->viewAttributes() ?>><?php echo $t_pegawai_view->nip->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pegawai_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $t_pegawai_view->TableLeftColumnClass ?>"><span id="elh_t_pegawai_nama"><?php echo $t_pegawai_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $t_pegawai_view->nama->cellAttributes() ?>>
<span id="el_t_pegawai_nama">
<span<?php echo $t_pegawai_view->nama->viewAttributes() ?>><?php echo $t_pegawai_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pegawai_view->bagian->Visible) { // bagian ?>
	<tr id="r_bagian">
		<td class="<?php echo $t_pegawai_view->TableLeftColumnClass ?>"><span id="elh_t_pegawai_bagian"><?php echo $t_pegawai_view->bagian->caption() ?></span></td>
		<td data-name="bagian" <?php echo $t_pegawai_view->bagian->cellAttributes() ?>>
<span id="el_t_pegawai_bagian">
<span<?php echo $t_pegawai_view->bagian->viewAttributes() ?>><?php echo $t_pegawai_view->bagian->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pegawai_view->username->Visible) { // username ?>
	<tr id="r_username">
		<td class="<?php echo $t_pegawai_view->TableLeftColumnClass ?>"><span id="elh_t_pegawai_username"><?php echo $t_pegawai_view->username->caption() ?></span></td>
		<td data-name="username" <?php echo $t_pegawai_view->username->cellAttributes() ?>>
<span id="el_t_pegawai_username">
<span<?php echo $t_pegawai_view->username->viewAttributes() ?>><?php echo $t_pegawai_view->username->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pegawai_view->password->Visible) { // password ?>
	<tr id="r_password">
		<td class="<?php echo $t_pegawai_view->TableLeftColumnClass ?>"><span id="elh_t_pegawai_password"><?php echo $t_pegawai_view->password->caption() ?></span></td>
		<td data-name="password" <?php echo $t_pegawai_view->password->cellAttributes() ?>>
<span id="el_t_pegawai_password">
<span<?php echo $t_pegawai_view->password->viewAttributes() ?>><?php echo $t_pegawai_view->password->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pegawai_view->role->Visible) { // role ?>
	<tr id="r_role">
		<td class="<?php echo $t_pegawai_view->TableLeftColumnClass ?>"><span id="elh_t_pegawai_role"><?php echo $t_pegawai_view->role->caption() ?></span></td>
		<td data-name="role" <?php echo $t_pegawai_view->role->cellAttributes() ?>>
<span id="el_t_pegawai_role">
<span<?php echo $t_pegawai_view->role->viewAttributes() ?>><?php echo $t_pegawai_view->role->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pegawai_view->aktif->Visible) { // aktif ?>
	<tr id="r_aktif">
		<td class="<?php echo $t_pegawai_view->TableLeftColumnClass ?>"><span id="elh_t_pegawai_aktif"><?php echo $t_pegawai_view->aktif->caption() ?></span></td>
		<td data-name="aktif" <?php echo $t_pegawai_view->aktif->cellAttributes() ?>>
<span id="el_t_pegawai_aktif">
<span<?php echo $t_pegawai_view->aktif->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_aktif" class="custom-control-input" value="<?php echo $t_pegawai_view->aktif->getViewValue() ?>" disabled<?php if (ConvertToBool($t_pegawai_view->aktif->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_aktif"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$t_pegawai_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_pegawai_view->isExport()) { ?>
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
$t_pegawai_view->terminate();
?>