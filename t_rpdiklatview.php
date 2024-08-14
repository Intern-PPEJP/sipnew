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
$t_rpdiklat_view = new t_rpdiklat_view();

// Run the page
$t_rpdiklat_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rpdiklat_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_rpdiklat_view->isExport()) { ?>
<script>
var ft_rpdiklatview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ft_rpdiklatview = currentForm = new ew.Form("ft_rpdiklatview", "view");
	loadjs.done("ft_rpdiklatview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_rpdiklat_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_rpdiklat_view->ExportOptions->render("body") ?>
<?php $t_rpdiklat_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_rpdiklat_view->showPageHeader(); ?>
<?php
$t_rpdiklat_view->showMessage();
?>
<form name="ft_rpdiklatview" id="ft_rpdiklatview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rpdiklat">
<input type="hidden" name="modal" value="<?php echo (int)$t_rpdiklat_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_rpdiklat_view->kdjudul->Visible) { // kdjudul ?>
	<tr id="r_kdjudul">
		<td class="<?php echo $t_rpdiklat_view->TableLeftColumnClass ?>"><span id="elh_t_rpdiklat_kdjudul"><?php echo $t_rpdiklat_view->kdjudul->caption() ?></span></td>
		<td data-name="kdjudul" <?php echo $t_rpdiklat_view->kdjudul->cellAttributes() ?>>
<span id="el_t_rpdiklat_kdjudul">
<span<?php echo $t_rpdiklat_view->kdjudul->viewAttributes() ?>><?php echo $t_rpdiklat_view->kdjudul->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpdiklat_view->kdbidang->Visible) { // kdbidang ?>
	<tr id="r_kdbidang">
		<td class="<?php echo $t_rpdiklat_view->TableLeftColumnClass ?>"><span id="elh_t_rpdiklat_kdbidang"><?php echo $t_rpdiklat_view->kdbidang->caption() ?></span></td>
		<td data-name="kdbidang" <?php echo $t_rpdiklat_view->kdbidang->cellAttributes() ?>>
<span id="el_t_rpdiklat_kdbidang">
<span<?php echo $t_rpdiklat_view->kdbidang->viewAttributes() ?>><?php echo $t_rpdiklat_view->kdbidang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpdiklat_view->kdkursil->Visible) { // kdkursil ?>
	<tr id="r_kdkursil">
		<td class="<?php echo $t_rpdiklat_view->TableLeftColumnClass ?>"><span id="elh_t_rpdiklat_kdkursil"><?php echo $t_rpdiklat_view->kdkursil->caption() ?></span></td>
		<td data-name="kdkursil" <?php echo $t_rpdiklat_view->kdkursil->cellAttributes() ?>>
<span id="el_t_rpdiklat_kdkursil">
<span<?php echo $t_rpdiklat_view->kdkursil->viewAttributes() ?>><?php echo $t_rpdiklat_view->kdkursil->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpdiklat_view->iso->Visible) { // iso ?>
	<tr id="r_iso">
		<td class="<?php echo $t_rpdiklat_view->TableLeftColumnClass ?>"><span id="elh_t_rpdiklat_iso"><?php echo $t_rpdiklat_view->iso->caption() ?></span></td>
		<td data-name="iso" <?php echo $t_rpdiklat_view->iso->cellAttributes() ?>>
<span id="el_t_rpdiklat_iso">
<span<?php echo $t_rpdiklat_view->iso->viewAttributes() ?>><?php echo $t_rpdiklat_view->iso->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpdiklat_view->tempat->Visible) { // tempat ?>
	<tr id="r_tempat">
		<td class="<?php echo $t_rpdiklat_view->TableLeftColumnClass ?>"><span id="elh_t_rpdiklat_tempat"><?php echo $t_rpdiklat_view->tempat->caption() ?></span></td>
		<td data-name="tempat" <?php echo $t_rpdiklat_view->tempat->cellAttributes() ?>>
<span id="el_t_rpdiklat_tempat">
<span<?php echo $t_rpdiklat_view->tempat->viewAttributes() ?>><?php echo $t_rpdiklat_view->tempat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpdiklat_view->jml_hari->Visible) { // jml_hari ?>
	<tr id="r_jml_hari">
		<td class="<?php echo $t_rpdiklat_view->TableLeftColumnClass ?>"><span id="elh_t_rpdiklat_jml_hari"><?php echo $t_rpdiklat_view->jml_hari->caption() ?></span></td>
		<td data-name="jml_hari" <?php echo $t_rpdiklat_view->jml_hari->cellAttributes() ?>>
<span id="el_t_rpdiklat_jml_hari">
<span<?php echo $t_rpdiklat_view->jml_hari->viewAttributes() ?>><?php echo $t_rpdiklat_view->jml_hari->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpdiklat_view->jenisdurasi->Visible) { // jenisdurasi ?>
	<tr id="r_jenisdurasi">
		<td class="<?php echo $t_rpdiklat_view->TableLeftColumnClass ?>"><span id="elh_t_rpdiklat_jenisdurasi"><?php echo $t_rpdiklat_view->jenisdurasi->caption() ?></span></td>
		<td data-name="jenisdurasi" <?php echo $t_rpdiklat_view->jenisdurasi->cellAttributes() ?>>
<span id="el_t_rpdiklat_jenisdurasi">
<span<?php echo $t_rpdiklat_view->jenisdurasi->viewAttributes() ?>><?php echo $t_rpdiklat_view->jenisdurasi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpdiklat_view->targetpes->Visible) { // targetpes ?>
	<tr id="r_targetpes">
		<td class="<?php echo $t_rpdiklat_view->TableLeftColumnClass ?>"><span id="elh_t_rpdiklat_targetpes"><?php echo $t_rpdiklat_view->targetpes->caption() ?></span></td>
		<td data-name="targetpes" <?php echo $t_rpdiklat_view->targetpes->cellAttributes() ?>>
<span id="el_t_rpdiklat_targetpes">
<span<?php echo $t_rpdiklat_view->targetpes->viewAttributes() ?>><?php echo $t_rpdiklat_view->targetpes->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpdiklat_view->angkatan->Visible) { // angkatan ?>
	<tr id="r_angkatan">
		<td class="<?php echo $t_rpdiklat_view->TableLeftColumnClass ?>"><span id="elh_t_rpdiklat_angkatan"><?php echo $t_rpdiklat_view->angkatan->caption() ?></span></td>
		<td data-name="angkatan" <?php echo $t_rpdiklat_view->angkatan->cellAttributes() ?>>
<span id="el_t_rpdiklat_angkatan">
<span<?php echo $t_rpdiklat_view->angkatan->viewAttributes() ?>><?php echo $t_rpdiklat_view->angkatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpdiklat_view->sisa_angkatan->Visible) { // sisa_angkatan ?>
	<tr id="r_sisa_angkatan">
		<td class="<?php echo $t_rpdiklat_view->TableLeftColumnClass ?>"><span id="elh_t_rpdiklat_sisa_angkatan"><?php echo $t_rpdiklat_view->sisa_angkatan->caption() ?></span></td>
		<td data-name="sisa_angkatan" <?php echo $t_rpdiklat_view->sisa_angkatan->cellAttributes() ?>>
<span id="el_t_rpdiklat_sisa_angkatan">
<span<?php echo $t_rpdiklat_view->sisa_angkatan->viewAttributes() ?>><?php echo $t_rpdiklat_view->sisa_angkatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpdiklat_view->harga_satuan->Visible) { // harga_satuan ?>
	<tr id="r_harga_satuan">
		<td class="<?php echo $t_rpdiklat_view->TableLeftColumnClass ?>"><span id="elh_t_rpdiklat_harga_satuan"><?php echo $t_rpdiklat_view->harga_satuan->caption() ?></span></td>
		<td data-name="harga_satuan" <?php echo $t_rpdiklat_view->harga_satuan->cellAttributes() ?>>
<span id="el_t_rpdiklat_harga_satuan">
<span<?php echo $t_rpdiklat_view->harga_satuan->viewAttributes() ?>><?php echo $t_rpdiklat_view->harga_satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpdiklat_view->hargatotal->Visible) { // hargatotal ?>
	<tr id="r_hargatotal">
		<td class="<?php echo $t_rpdiklat_view->TableLeftColumnClass ?>"><span id="elh_t_rpdiklat_hargatotal"><?php echo $t_rpdiklat_view->hargatotal->caption() ?></span></td>
		<td data-name="hargatotal" <?php echo $t_rpdiklat_view->hargatotal->cellAttributes() ?>>
<span id="el_t_rpdiklat_hargatotal">
<span<?php echo $t_rpdiklat_view->hargatotal->viewAttributes() ?>><?php echo $t_rpdiklat_view->hargatotal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpdiklat_view->tglrevisi->Visible) { // tglrevisi ?>
	<tr id="r_tglrevisi">
		<td class="<?php echo $t_rpdiklat_view->TableLeftColumnClass ?>"><span id="elh_t_rpdiklat_tglrevisi"><?php echo $t_rpdiklat_view->tglrevisi->caption() ?></span></td>
		<td data-name="tglrevisi" <?php echo $t_rpdiklat_view->tglrevisi->cellAttributes() ?>>
<span id="el_t_rpdiklat_tglrevisi">
<span<?php echo $t_rpdiklat_view->tglrevisi->viewAttributes() ?>><?php echo $t_rpdiklat_view->tglrevisi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_rpdiklat_view->tahun_rencana->Visible) { // tahun_rencana ?>
	<tr id="r_tahun_rencana">
		<td class="<?php echo $t_rpdiklat_view->TableLeftColumnClass ?>"><span id="elh_t_rpdiklat_tahun_rencana"><?php echo $t_rpdiklat_view->tahun_rencana->caption() ?></span></td>
		<td data-name="tahun_rencana" <?php echo $t_rpdiklat_view->tahun_rencana->cellAttributes() ?>>
<span id="el_t_rpdiklat_tahun_rencana">
<span<?php echo $t_rpdiklat_view->tahun_rencana->viewAttributes() ?>><?php echo $t_rpdiklat_view->tahun_rencana->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("diklatpusat", explode(",", $t_rpdiklat->getCurrentDetailTable())) && $diklatpusat->DetailView) {
?>
<?php if ($t_rpdiklat->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("diklatpusat", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $t_rpdiklat_view->diklatpusat_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "diklatpusatgrid.php" ?>
<?php } ?>
</form>
<?php
$t_rpdiklat_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_rpdiklat_view->isExport()) { ?>
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
$t_rpdiklat_view->terminate();
?>