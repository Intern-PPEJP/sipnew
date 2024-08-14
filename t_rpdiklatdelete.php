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
$t_rpdiklat_delete = new t_rpdiklat_delete();

// Run the page
$t_rpdiklat_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rpdiklat_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_rpdiklatdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_rpdiklatdelete = currentForm = new ew.Form("ft_rpdiklatdelete", "delete");
	loadjs.done("ft_rpdiklatdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_rpdiklat_delete->showPageHeader(); ?>
<?php
$t_rpdiklat_delete->showMessage();
?>
<form name="ft_rpdiklatdelete" id="ft_rpdiklatdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rpdiklat">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_rpdiklat_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_rpdiklat_delete->kdjudul->Visible) { // kdjudul ?>
		<th class="<?php echo $t_rpdiklat_delete->kdjudul->headerCellClass() ?>"><span id="elh_t_rpdiklat_kdjudul" class="t_rpdiklat_kdjudul"><?php echo $t_rpdiklat_delete->kdjudul->caption() ?></span></th>
<?php } ?>
<?php if ($t_rpdiklat_delete->kdbidang->Visible) { // kdbidang ?>
		<th class="<?php echo $t_rpdiklat_delete->kdbidang->headerCellClass() ?>"><span id="elh_t_rpdiklat_kdbidang" class="t_rpdiklat_kdbidang"><?php echo $t_rpdiklat_delete->kdbidang->caption() ?></span></th>
<?php } ?>
<?php if ($t_rpdiklat_delete->jml_hari->Visible) { // jml_hari ?>
		<th class="<?php echo $t_rpdiklat_delete->jml_hari->headerCellClass() ?>"><span id="elh_t_rpdiklat_jml_hari" class="t_rpdiklat_jml_hari"><?php echo $t_rpdiklat_delete->jml_hari->caption() ?></span></th>
<?php } ?>
<?php if ($t_rpdiklat_delete->jenisdurasi->Visible) { // jenisdurasi ?>
		<th class="<?php echo $t_rpdiklat_delete->jenisdurasi->headerCellClass() ?>"><span id="elh_t_rpdiklat_jenisdurasi" class="t_rpdiklat_jenisdurasi"><?php echo $t_rpdiklat_delete->jenisdurasi->caption() ?></span></th>
<?php } ?>
<?php if ($t_rpdiklat_delete->targetpes->Visible) { // targetpes ?>
		<th class="<?php echo $t_rpdiklat_delete->targetpes->headerCellClass() ?>"><span id="elh_t_rpdiklat_targetpes" class="t_rpdiklat_targetpes"><?php echo $t_rpdiklat_delete->targetpes->caption() ?></span></th>
<?php } ?>
<?php if ($t_rpdiklat_delete->angkatan->Visible) { // angkatan ?>
		<th class="<?php echo $t_rpdiklat_delete->angkatan->headerCellClass() ?>"><span id="elh_t_rpdiklat_angkatan" class="t_rpdiklat_angkatan"><?php echo $t_rpdiklat_delete->angkatan->caption() ?></span></th>
<?php } ?>
<?php if ($t_rpdiklat_delete->sisa_angkatan->Visible) { // sisa_angkatan ?>
		<th class="<?php echo $t_rpdiklat_delete->sisa_angkatan->headerCellClass() ?>"><span id="elh_t_rpdiklat_sisa_angkatan" class="t_rpdiklat_sisa_angkatan"><?php echo $t_rpdiklat_delete->sisa_angkatan->caption() ?></span></th>
<?php } ?>
<?php if ($t_rpdiklat_delete->harga_satuan->Visible) { // harga_satuan ?>
		<th class="<?php echo $t_rpdiklat_delete->harga_satuan->headerCellClass() ?>"><span id="elh_t_rpdiklat_harga_satuan" class="t_rpdiklat_harga_satuan"><?php echo $t_rpdiklat_delete->harga_satuan->caption() ?></span></th>
<?php } ?>
<?php if ($t_rpdiklat_delete->tahun_rencana->Visible) { // tahun_rencana ?>
		<th class="<?php echo $t_rpdiklat_delete->tahun_rencana->headerCellClass() ?>"><span id="elh_t_rpdiklat_tahun_rencana" class="t_rpdiklat_tahun_rencana"><?php echo $t_rpdiklat_delete->tahun_rencana->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_rpdiklat_delete->RecordCount = 0;
$i = 0;
while (!$t_rpdiklat_delete->Recordset->EOF) {
	$t_rpdiklat_delete->RecordCount++;
	$t_rpdiklat_delete->RowCount++;

	// Set row properties
	$t_rpdiklat->resetAttributes();
	$t_rpdiklat->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_rpdiklat_delete->loadRowValues($t_rpdiklat_delete->Recordset);

	// Render row
	$t_rpdiklat_delete->renderRow();
?>
	<tr <?php echo $t_rpdiklat->rowAttributes() ?>>
<?php if ($t_rpdiklat_delete->kdjudul->Visible) { // kdjudul ?>
		<td <?php echo $t_rpdiklat_delete->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $t_rpdiklat_delete->RowCount ?>_t_rpdiklat_kdjudul" class="t_rpdiklat_kdjudul">
<span<?php echo $t_rpdiklat_delete->kdjudul->viewAttributes() ?>><?php echo $t_rpdiklat_delete->kdjudul->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rpdiklat_delete->kdbidang->Visible) { // kdbidang ?>
		<td <?php echo $t_rpdiklat_delete->kdbidang->cellAttributes() ?>>
<span id="el<?php echo $t_rpdiklat_delete->RowCount ?>_t_rpdiklat_kdbidang" class="t_rpdiklat_kdbidang">
<span<?php echo $t_rpdiklat_delete->kdbidang->viewAttributes() ?>><?php echo $t_rpdiklat_delete->kdbidang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rpdiklat_delete->jml_hari->Visible) { // jml_hari ?>
		<td <?php echo $t_rpdiklat_delete->jml_hari->cellAttributes() ?>>
<span id="el<?php echo $t_rpdiklat_delete->RowCount ?>_t_rpdiklat_jml_hari" class="t_rpdiklat_jml_hari">
<span<?php echo $t_rpdiklat_delete->jml_hari->viewAttributes() ?>><?php echo $t_rpdiklat_delete->jml_hari->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rpdiklat_delete->jenisdurasi->Visible) { // jenisdurasi ?>
		<td <?php echo $t_rpdiklat_delete->jenisdurasi->cellAttributes() ?>>
<span id="el<?php echo $t_rpdiklat_delete->RowCount ?>_t_rpdiklat_jenisdurasi" class="t_rpdiklat_jenisdurasi">
<span<?php echo $t_rpdiklat_delete->jenisdurasi->viewAttributes() ?>><?php echo $t_rpdiklat_delete->jenisdurasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rpdiklat_delete->targetpes->Visible) { // targetpes ?>
		<td <?php echo $t_rpdiklat_delete->targetpes->cellAttributes() ?>>
<span id="el<?php echo $t_rpdiklat_delete->RowCount ?>_t_rpdiklat_targetpes" class="t_rpdiklat_targetpes">
<span<?php echo $t_rpdiklat_delete->targetpes->viewAttributes() ?>><?php echo $t_rpdiklat_delete->targetpes->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rpdiklat_delete->angkatan->Visible) { // angkatan ?>
		<td <?php echo $t_rpdiklat_delete->angkatan->cellAttributes() ?>>
<span id="el<?php echo $t_rpdiklat_delete->RowCount ?>_t_rpdiklat_angkatan" class="t_rpdiklat_angkatan">
<span<?php echo $t_rpdiklat_delete->angkatan->viewAttributes() ?>><?php echo $t_rpdiklat_delete->angkatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rpdiklat_delete->sisa_angkatan->Visible) { // sisa_angkatan ?>
		<td <?php echo $t_rpdiklat_delete->sisa_angkatan->cellAttributes() ?>>
<span id="el<?php echo $t_rpdiklat_delete->RowCount ?>_t_rpdiklat_sisa_angkatan" class="t_rpdiklat_sisa_angkatan">
<span<?php echo $t_rpdiklat_delete->sisa_angkatan->viewAttributes() ?>><?php echo $t_rpdiklat_delete->sisa_angkatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rpdiklat_delete->harga_satuan->Visible) { // harga_satuan ?>
		<td <?php echo $t_rpdiklat_delete->harga_satuan->cellAttributes() ?>>
<span id="el<?php echo $t_rpdiklat_delete->RowCount ?>_t_rpdiklat_harga_satuan" class="t_rpdiklat_harga_satuan">
<span<?php echo $t_rpdiklat_delete->harga_satuan->viewAttributes() ?>><?php echo $t_rpdiklat_delete->harga_satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rpdiklat_delete->tahun_rencana->Visible) { // tahun_rencana ?>
		<td <?php echo $t_rpdiklat_delete->tahun_rencana->cellAttributes() ?>>
<span id="el<?php echo $t_rpdiklat_delete->RowCount ?>_t_rpdiklat_tahun_rencana" class="t_rpdiklat_tahun_rencana">
<span<?php echo $t_rpdiklat_delete->tahun_rencana->viewAttributes() ?>><?php echo $t_rpdiklat_delete->tahun_rencana->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_rpdiklat_delete->Recordset->moveNext();
}
$t_rpdiklat_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_rpdiklat_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_rpdiklat_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$t_rpdiklat_delete->terminate();
?>