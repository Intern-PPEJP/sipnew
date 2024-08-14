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
$t_rwpekerjaan_view = new t_rwpekerjaan_view();

// Run the page
$t_rwpekerjaan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rwpekerjaan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_rwpekerjaan_view->isExport()) { ?>
<script>
var ft_rwpekerjaanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ft_rwpekerjaanview = currentForm = new ew.Form("ft_rwpekerjaanview", "view");
	loadjs.done("ft_rwpekerjaanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_rwpekerjaan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_rwpekerjaan_view->ExportOptions->render("body") ?>
<?php $t_rwpekerjaan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_rwpekerjaan_view->showPageHeader(); ?>
<?php
$t_rwpekerjaan_view->showMessage();
?>
<form name="ft_rwpekerjaanview" id="ft_rwpekerjaanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rwpekerjaan">
<input type="hidden" name="modal" value="<?php echo (int)$t_rwpekerjaan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_rwpekerjaan_view->rwkerjaid->Visible) { // rwkerjaid ?>
	<tr id="r_rwkerjaid">
		<td class="<?php echo $t_rwpekerjaan_view->TableLeftColumnClass ?>"><span id="elh_t_rwpekerjaan_rwkerjaid"><?php echo $t_rwpekerjaan_view->rwkerjaid->caption() ?></span></td>
		<td data-name="rwkerjaid" <?php echo $t_rwpekerjaan_view->rwkerjaid->cellAttributes() ?>>
<span id="el_t_rwpekerjaan_rwkerjaid">
<span<?php echo $t_rwpekerjaan_view->rwkerjaid->viewAttributes() ?>><?php echo $t_rwpekerjaan_view->rwkerjaid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwpekerjaan_view->bioid->Visible) { // bioid ?>
	<tr id="r_bioid">
		<td class="<?php echo $t_rwpekerjaan_view->TableLeftColumnClass ?>"><span id="elh_t_rwpekerjaan_bioid"><?php echo $t_rwpekerjaan_view->bioid->caption() ?></span></td>
		<td data-name="bioid" <?php echo $t_rwpekerjaan_view->bioid->cellAttributes() ?>>
<span id="el_t_rwpekerjaan_bioid">
<span<?php echo $t_rwpekerjaan_view->bioid->viewAttributes() ?>><?php echo $t_rwpekerjaan_view->bioid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwpekerjaan_view->perusahaan->Visible) { // perusahaan ?>
	<tr id="r_perusahaan">
		<td class="<?php echo $t_rwpekerjaan_view->TableLeftColumnClass ?>"><span id="elh_t_rwpekerjaan_perusahaan"><?php echo $t_rwpekerjaan_view->perusahaan->caption() ?></span></td>
		<td data-name="perusahaan" <?php echo $t_rwpekerjaan_view->perusahaan->cellAttributes() ?>>
<span id="el_t_rwpekerjaan_perusahaan">
<span<?php echo $t_rwpekerjaan_view->perusahaan->viewAttributes() ?>><?php echo $t_rwpekerjaan_view->perusahaan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwpekerjaan_view->jabatan->Visible) { // jabatan ?>
	<tr id="r_jabatan">
		<td class="<?php echo $t_rwpekerjaan_view->TableLeftColumnClass ?>"><span id="elh_t_rwpekerjaan_jabatan"><?php echo $t_rwpekerjaan_view->jabatan->caption() ?></span></td>
		<td data-name="jabatan" <?php echo $t_rwpekerjaan_view->jabatan->cellAttributes() ?>>
<span id="el_t_rwpekerjaan_jabatan">
<span<?php echo $t_rwpekerjaan_view->jabatan->viewAttributes() ?>><?php echo $t_rwpekerjaan_view->jabatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwpekerjaan_view->mulai->Visible) { // mulai ?>
	<tr id="r_mulai">
		<td class="<?php echo $t_rwpekerjaan_view->TableLeftColumnClass ?>"><span id="elh_t_rwpekerjaan_mulai"><?php echo $t_rwpekerjaan_view->mulai->caption() ?></span></td>
		<td data-name="mulai" <?php echo $t_rwpekerjaan_view->mulai->cellAttributes() ?>>
<span id="el_t_rwpekerjaan_mulai">
<span<?php echo $t_rwpekerjaan_view->mulai->viewAttributes() ?>><?php echo $t_rwpekerjaan_view->mulai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwpekerjaan_view->hingga->Visible) { // hingga ?>
	<tr id="r_hingga">
		<td class="<?php echo $t_rwpekerjaan_view->TableLeftColumnClass ?>"><span id="elh_t_rwpekerjaan_hingga"><?php echo $t_rwpekerjaan_view->hingga->caption() ?></span></td>
		<td data-name="hingga" <?php echo $t_rwpekerjaan_view->hingga->cellAttributes() ?>>
<span id="el_t_rwpekerjaan_hingga">
<span<?php echo $t_rwpekerjaan_view->hingga->viewAttributes() ?>><?php echo $t_rwpekerjaan_view->hingga->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwpekerjaan_view->created_by->Visible) { // created_by ?>
	<tr id="r_created_by">
		<td class="<?php echo $t_rwpekerjaan_view->TableLeftColumnClass ?>"><span id="elh_t_rwpekerjaan_created_by"><?php echo $t_rwpekerjaan_view->created_by->caption() ?></span></td>
		<td data-name="created_by" <?php echo $t_rwpekerjaan_view->created_by->cellAttributes() ?>>
<span id="el_t_rwpekerjaan_created_by">
<span<?php echo $t_rwpekerjaan_view->created_by->viewAttributes() ?>><?php echo $t_rwpekerjaan_view->created_by->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwpekerjaan_view->created_at->Visible) { // created_at ?>
	<tr id="r_created_at">
		<td class="<?php echo $t_rwpekerjaan_view->TableLeftColumnClass ?>"><span id="elh_t_rwpekerjaan_created_at"><?php echo $t_rwpekerjaan_view->created_at->caption() ?></span></td>
		<td data-name="created_at" <?php echo $t_rwpekerjaan_view->created_at->cellAttributes() ?>>
<span id="el_t_rwpekerjaan_created_at">
<span<?php echo $t_rwpekerjaan_view->created_at->viewAttributes() ?>><?php echo $t_rwpekerjaan_view->created_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwpekerjaan_view->updated_by->Visible) { // updated_by ?>
	<tr id="r_updated_by">
		<td class="<?php echo $t_rwpekerjaan_view->TableLeftColumnClass ?>"><span id="elh_t_rwpekerjaan_updated_by"><?php echo $t_rwpekerjaan_view->updated_by->caption() ?></span></td>
		<td data-name="updated_by" <?php echo $t_rwpekerjaan_view->updated_by->cellAttributes() ?>>
<span id="el_t_rwpekerjaan_updated_by">
<span<?php echo $t_rwpekerjaan_view->updated_by->viewAttributes() ?>><?php echo $t_rwpekerjaan_view->updated_by->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rwpekerjaan_view->updated_at->Visible) { // updated_at ?>
	<tr id="r_updated_at">
		<td class="<?php echo $t_rwpekerjaan_view->TableLeftColumnClass ?>"><span id="elh_t_rwpekerjaan_updated_at"><?php echo $t_rwpekerjaan_view->updated_at->caption() ?></span></td>
		<td data-name="updated_at" <?php echo $t_rwpekerjaan_view->updated_at->cellAttributes() ?>>
<span id="el_t_rwpekerjaan_updated_at">
<span<?php echo $t_rwpekerjaan_view->updated_at->viewAttributes() ?>><?php echo $t_rwpekerjaan_view->updated_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$t_rwpekerjaan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_rwpekerjaan_view->isExport()) { ?>
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
$t_rwpekerjaan_view->terminate();
?>