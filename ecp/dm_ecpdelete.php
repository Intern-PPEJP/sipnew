<?php
namespace PHPMaker2020\input_ecp;

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
$dm_ecp_delete = new dm_ecp_delete();

// Run the page
$dm_ecp_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dm_ecp_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdm_ecpdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdm_ecpdelete = currentForm = new ew.Form("fdm_ecpdelete", "delete");
	loadjs.done("fdm_ecpdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $dm_ecp_delete->showPageHeader(); ?>
<?php
$dm_ecp_delete->showMessage();
?>
<form name="fdm_ecpdelete" id="fdm_ecpdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dm_ecp">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($dm_ecp_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($dm_ecp_delete->ID_ECP->Visible) { // ID_ECP ?>
		<th class="<?php echo $dm_ecp_delete->ID_ECP->headerCellClass() ?>"><span id="elh_dm_ecp_ID_ECP" class="dm_ecp_ID_ECP"><?php echo $dm_ecp_delete->ID_ECP->caption() ?></span></th>
<?php } ?>
<?php if ($dm_ecp_delete->Nama->Visible) { // Nama ?>
		<th class="<?php echo $dm_ecp_delete->Nama->headerCellClass() ?>"><span id="elh_dm_ecp_Nama" class="dm_ecp_Nama"><?php echo $dm_ecp_delete->Nama->caption() ?></span></th>
<?php } ?>
<?php if ($dm_ecp_delete->Perusahaan->Visible) { // Perusahaan ?>
		<th class="<?php echo $dm_ecp_delete->Perusahaan->headerCellClass() ?>"><span id="elh_dm_ecp_Perusahaan" class="dm_ecp_Perusahaan"><?php echo $dm_ecp_delete->Perusahaan->caption() ?></span></th>
<?php } ?>
<?php if ($dm_ecp_delete->Daerah->Visible) { // Daerah ?>
		<th class="<?php echo $dm_ecp_delete->Daerah->headerCellClass() ?>"><span id="elh_dm_ecp_Daerah" class="dm_ecp_Daerah"><?php echo $dm_ecp_delete->Daerah->caption() ?></span></th>
<?php } ?>
<?php if ($dm_ecp_delete->Produk->Visible) { // Produk ?>
		<th class="<?php echo $dm_ecp_delete->Produk->headerCellClass() ?>"><span id="elh_dm_ecp_Produk" class="dm_ecp_Produk"><?php echo $dm_ecp_delete->Produk->caption() ?></span></th>
<?php } ?>
<?php if ($dm_ecp_delete->Tgl_Bln_Ekspor->Visible) { // Tgl_Bln_Ekspor ?>
		<th class="<?php echo $dm_ecp_delete->Tgl_Bln_Ekspor->headerCellClass() ?>"><span id="elh_dm_ecp_Tgl_Bln_Ekspor" class="dm_ecp_Tgl_Bln_Ekspor"><?php echo $dm_ecp_delete->Tgl_Bln_Ekspor->caption() ?></span></th>
<?php } ?>
<?php if ($dm_ecp_delete->Negara_Tujuan->Visible) { // Negara_Tujuan ?>
		<th class="<?php echo $dm_ecp_delete->Negara_Tujuan->headerCellClass() ?>"><span id="elh_dm_ecp_Negara_Tujuan" class="dm_ecp_Negara_Tujuan"><?php echo $dm_ecp_delete->Negara_Tujuan->caption() ?></span></th>
<?php } ?>
<?php if ($dm_ecp_delete->Nilai_Ekspor_USD->Visible) { // Nilai_Ekspor_USD ?>
		<th class="<?php echo $dm_ecp_delete->Nilai_Ekspor_USD->headerCellClass() ?>"><span id="elh_dm_ecp_Nilai_Ekspor_USD" class="dm_ecp_Nilai_Ekspor_USD"><?php echo $dm_ecp_delete->Nilai_Ekspor_USD->caption() ?></span></th>
<?php } ?>
<?php if ($dm_ecp_delete->Nilai_Ekspor_Rupiah->Visible) { // Nilai_Ekspor_Rupiah ?>
		<th class="<?php echo $dm_ecp_delete->Nilai_Ekspor_Rupiah->headerCellClass() ?>"><span id="elh_dm_ecp_Nilai_Ekspor_Rupiah" class="dm_ecp_Nilai_Ekspor_Rupiah"><?php echo $dm_ecp_delete->Nilai_Ekspor_Rupiah->caption() ?></span></th>
<?php } ?>
<?php if ($dm_ecp_delete->Keterangan->Visible) { // Keterangan ?>
		<th class="<?php echo $dm_ecp_delete->Keterangan->headerCellClass() ?>"><span id="elh_dm_ecp_Keterangan" class="dm_ecp_Keterangan"><?php echo $dm_ecp_delete->Keterangan->caption() ?></span></th>
<?php } ?>
<?php if ($dm_ecp_delete->Wilayah_ECP->Visible) { // Wilayah_ECP ?>
		<th class="<?php echo $dm_ecp_delete->Wilayah_ECP->headerCellClass() ?>"><span id="elh_dm_ecp_Wilayah_ECP" class="dm_ecp_Wilayah_ECP"><?php echo $dm_ecp_delete->Wilayah_ECP->caption() ?></span></th>
<?php } ?>
<?php if ($dm_ecp_delete->Tahun_ECP->Visible) { // Tahun_ECP ?>
		<th class="<?php echo $dm_ecp_delete->Tahun_ECP->headerCellClass() ?>"><span id="elh_dm_ecp_Tahun_ECP" class="dm_ecp_Tahun_ECP"><?php echo $dm_ecp_delete->Tahun_ECP->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$dm_ecp_delete->RecordCount = 0;
$i = 0;
while (!$dm_ecp_delete->Recordset->EOF) {
	$dm_ecp_delete->RecordCount++;
	$dm_ecp_delete->RowCount++;

	// Set row properties
	$dm_ecp->resetAttributes();
	$dm_ecp->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$dm_ecp_delete->loadRowValues($dm_ecp_delete->Recordset);

	// Render row
	$dm_ecp_delete->renderRow();
?>
	<tr <?php echo $dm_ecp->rowAttributes() ?>>
<?php if ($dm_ecp_delete->ID_ECP->Visible) { // ID_ECP ?>
		<td <?php echo $dm_ecp_delete->ID_ECP->cellAttributes() ?>>
<span id="el<?php echo $dm_ecp_delete->RowCount ?>_dm_ecp_ID_ECP" class="dm_ecp_ID_ECP">
<span<?php echo $dm_ecp_delete->ID_ECP->viewAttributes() ?>><?php echo $dm_ecp_delete->ID_ECP->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_ecp_delete->Nama->Visible) { // Nama ?>
		<td <?php echo $dm_ecp_delete->Nama->cellAttributes() ?>>
<span id="el<?php echo $dm_ecp_delete->RowCount ?>_dm_ecp_Nama" class="dm_ecp_Nama">
<span<?php echo $dm_ecp_delete->Nama->viewAttributes() ?>><?php echo $dm_ecp_delete->Nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_ecp_delete->Perusahaan->Visible) { // Perusahaan ?>
		<td <?php echo $dm_ecp_delete->Perusahaan->cellAttributes() ?>>
<span id="el<?php echo $dm_ecp_delete->RowCount ?>_dm_ecp_Perusahaan" class="dm_ecp_Perusahaan">
<span<?php echo $dm_ecp_delete->Perusahaan->viewAttributes() ?>><?php echo $dm_ecp_delete->Perusahaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_ecp_delete->Daerah->Visible) { // Daerah ?>
		<td <?php echo $dm_ecp_delete->Daerah->cellAttributes() ?>>
<span id="el<?php echo $dm_ecp_delete->RowCount ?>_dm_ecp_Daerah" class="dm_ecp_Daerah">
<span<?php echo $dm_ecp_delete->Daerah->viewAttributes() ?>><?php echo $dm_ecp_delete->Daerah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_ecp_delete->Produk->Visible) { // Produk ?>
		<td <?php echo $dm_ecp_delete->Produk->cellAttributes() ?>>
<span id="el<?php echo $dm_ecp_delete->RowCount ?>_dm_ecp_Produk" class="dm_ecp_Produk">
<span<?php echo $dm_ecp_delete->Produk->viewAttributes() ?>><?php echo $dm_ecp_delete->Produk->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_ecp_delete->Tgl_Bln_Ekspor->Visible) { // Tgl_Bln_Ekspor ?>
		<td <?php echo $dm_ecp_delete->Tgl_Bln_Ekspor->cellAttributes() ?>>
<span id="el<?php echo $dm_ecp_delete->RowCount ?>_dm_ecp_Tgl_Bln_Ekspor" class="dm_ecp_Tgl_Bln_Ekspor">
<span<?php echo $dm_ecp_delete->Tgl_Bln_Ekspor->viewAttributes() ?>><?php echo $dm_ecp_delete->Tgl_Bln_Ekspor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_ecp_delete->Negara_Tujuan->Visible) { // Negara_Tujuan ?>
		<td <?php echo $dm_ecp_delete->Negara_Tujuan->cellAttributes() ?>>
<span id="el<?php echo $dm_ecp_delete->RowCount ?>_dm_ecp_Negara_Tujuan" class="dm_ecp_Negara_Tujuan">
<span<?php echo $dm_ecp_delete->Negara_Tujuan->viewAttributes() ?>><?php echo $dm_ecp_delete->Negara_Tujuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_ecp_delete->Nilai_Ekspor_USD->Visible) { // Nilai_Ekspor_USD ?>
		<td <?php echo $dm_ecp_delete->Nilai_Ekspor_USD->cellAttributes() ?>>
<span id="el<?php echo $dm_ecp_delete->RowCount ?>_dm_ecp_Nilai_Ekspor_USD" class="dm_ecp_Nilai_Ekspor_USD">
<span<?php echo $dm_ecp_delete->Nilai_Ekspor_USD->viewAttributes() ?>><?php echo $dm_ecp_delete->Nilai_Ekspor_USD->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_ecp_delete->Nilai_Ekspor_Rupiah->Visible) { // Nilai_Ekspor_Rupiah ?>
		<td <?php echo $dm_ecp_delete->Nilai_Ekspor_Rupiah->cellAttributes() ?>>
<span id="el<?php echo $dm_ecp_delete->RowCount ?>_dm_ecp_Nilai_Ekspor_Rupiah" class="dm_ecp_Nilai_Ekspor_Rupiah">
<span<?php echo $dm_ecp_delete->Nilai_Ekspor_Rupiah->viewAttributes() ?>><?php echo $dm_ecp_delete->Nilai_Ekspor_Rupiah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_ecp_delete->Keterangan->Visible) { // Keterangan ?>
		<td <?php echo $dm_ecp_delete->Keterangan->cellAttributes() ?>>
<span id="el<?php echo $dm_ecp_delete->RowCount ?>_dm_ecp_Keterangan" class="dm_ecp_Keterangan">
<span<?php echo $dm_ecp_delete->Keterangan->viewAttributes() ?>><?php echo $dm_ecp_delete->Keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_ecp_delete->Wilayah_ECP->Visible) { // Wilayah_ECP ?>
		<td <?php echo $dm_ecp_delete->Wilayah_ECP->cellAttributes() ?>>
<span id="el<?php echo $dm_ecp_delete->RowCount ?>_dm_ecp_Wilayah_ECP" class="dm_ecp_Wilayah_ECP">
<span<?php echo $dm_ecp_delete->Wilayah_ECP->viewAttributes() ?>><?php echo $dm_ecp_delete->Wilayah_ECP->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_ecp_delete->Tahun_ECP->Visible) { // Tahun_ECP ?>
		<td <?php echo $dm_ecp_delete->Tahun_ECP->cellAttributes() ?>>
<span id="el<?php echo $dm_ecp_delete->RowCount ?>_dm_ecp_Tahun_ECP" class="dm_ecp_Tahun_ECP">
<span<?php echo $dm_ecp_delete->Tahun_ECP->viewAttributes() ?>><?php echo $dm_ecp_delete->Tahun_ECP->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$dm_ecp_delete->Recordset->moveNext();
}
$dm_ecp_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $dm_ecp_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$dm_ecp_delete->showPageFooter();
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
$dm_ecp_delete->terminate();
?>