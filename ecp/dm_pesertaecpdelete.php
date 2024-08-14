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
$dm_pesertaecp_delete = new dm_pesertaecp_delete();

// Run the page
$dm_pesertaecp_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dm_pesertaecp_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdm_pesertaecpdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdm_pesertaecpdelete = currentForm = new ew.Form("fdm_pesertaecpdelete", "delete");
	loadjs.done("fdm_pesertaecpdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $dm_pesertaecp_delete->showPageHeader(); ?>
<?php
$dm_pesertaecp_delete->showMessage();
?>
<form name="fdm_pesertaecpdelete" id="fdm_pesertaecpdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dm_pesertaecp">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($dm_pesertaecp_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($dm_pesertaecp_delete->ID_Unik->Visible) { // ID_Unik ?>
		<th class="<?php echo $dm_pesertaecp_delete->ID_Unik->headerCellClass() ?>"><span id="elh_dm_pesertaecp_ID_Unik" class="dm_pesertaecp_ID_Unik"><?php echo $dm_pesertaecp_delete->ID_Unik->caption() ?></span></th>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Nama->Visible) { // Nama ?>
		<th class="<?php echo $dm_pesertaecp_delete->Nama->headerCellClass() ?>"><span id="elh_dm_pesertaecp_Nama" class="dm_pesertaecp_Nama"><?php echo $dm_pesertaecp_delete->Nama->caption() ?></span></th>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Perusahaan->Visible) { // Perusahaan ?>
		<th class="<?php echo $dm_pesertaecp_delete->Perusahaan->headerCellClass() ?>"><span id="elh_dm_pesertaecp_Perusahaan" class="dm_pesertaecp_Perusahaan"><?php echo $dm_pesertaecp_delete->Perusahaan->caption() ?></span></th>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Produk->Visible) { // Produk ?>
		<th class="<?php echo $dm_pesertaecp_delete->Produk->headerCellClass() ?>"><span id="elh_dm_pesertaecp_Produk" class="dm_pesertaecp_Produk"><?php echo $dm_pesertaecp_delete->Produk->caption() ?></span></th>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Kapasitas_Produksi->Visible) { // Kapasitas_Produksi ?>
		<th class="<?php echo $dm_pesertaecp_delete->Kapasitas_Produksi->headerCellClass() ?>"><span id="elh_dm_pesertaecp_Kapasitas_Produksi" class="dm_pesertaecp_Kapasitas_Produksi"><?php echo $dm_pesertaecp_delete->Kapasitas_Produksi->caption() ?></span></th>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Omset->Visible) { // Omset ?>
		<th class="<?php echo $dm_pesertaecp_delete->Omset->headerCellClass() ?>"><span id="elh_dm_pesertaecp_Omset" class="dm_pesertaecp_Omset"><?php echo $dm_pesertaecp_delete->Omset->caption() ?></span></th>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Jumlah_Pegawai->Visible) { // Jumlah_Pegawai ?>
		<th class="<?php echo $dm_pesertaecp_delete->Jumlah_Pegawai->headerCellClass() ?>"><span id="elh_dm_pesertaecp_Jumlah_Pegawai" class="dm_pesertaecp_Jumlah_Pegawai"><?php echo $dm_pesertaecp_delete->Jumlah_Pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Legalitas_Perusahaan->Visible) { // Legalitas_Perusahaan ?>
		<th class="<?php echo $dm_pesertaecp_delete->Legalitas_Perusahaan->headerCellClass() ?>"><span id="elh_dm_pesertaecp_Legalitas_Perusahaan" class="dm_pesertaecp_Legalitas_Perusahaan"><?php echo $dm_pesertaecp_delete->Legalitas_Perusahaan->caption() ?></span></th>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Sertifikasi_dimiliki->Visible) { // Sertifikasi_dimiliki ?>
		<th class="<?php echo $dm_pesertaecp_delete->Sertifikasi_dimiliki->headerCellClass() ?>"><span id="elh_dm_pesertaecp_Sertifikasi_dimiliki" class="dm_pesertaecp_Sertifikasi_dimiliki"><?php echo $dm_pesertaecp_delete->Sertifikasi_dimiliki->caption() ?></span></th>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Handphone->Visible) { // Handphone ?>
		<th class="<?php echo $dm_pesertaecp_delete->Handphone->headerCellClass() ?>"><span id="elh_dm_pesertaecp_Handphone" class="dm_pesertaecp_Handphone"><?php echo $dm_pesertaecp_delete->Handphone->caption() ?></span></th>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Email_Add->Visible) { // Email_Add ?>
		<th class="<?php echo $dm_pesertaecp_delete->Email_Add->headerCellClass() ?>"><span id="elh_dm_pesertaecp_Email_Add" class="dm_pesertaecp_Email_Add"><?php echo $dm_pesertaecp_delete->Email_Add->caption() ?></span></th>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Website->Visible) { // Website ?>
		<th class="<?php echo $dm_pesertaecp_delete->Website->headerCellClass() ?>"><span id="elh_dm_pesertaecp_Website" class="dm_pesertaecp_Website"><?php echo $dm_pesertaecp_delete->Website->caption() ?></span></th>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Tahun_Berdiri->Visible) { // Tahun_Berdiri ?>
		<th class="<?php echo $dm_pesertaecp_delete->Tahun_Berdiri->headerCellClass() ?>"><span id="elh_dm_pesertaecp_Tahun_Berdiri" class="dm_pesertaecp_Tahun_Berdiri"><?php echo $dm_pesertaecp_delete->Tahun_Berdiri->caption() ?></span></th>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Wilayah_ECP->Visible) { // Wilayah_ECP ?>
		<th class="<?php echo $dm_pesertaecp_delete->Wilayah_ECP->headerCellClass() ?>"><span id="elh_dm_pesertaecp_Wilayah_ECP" class="dm_pesertaecp_Wilayah_ECP"><?php echo $dm_pesertaecp_delete->Wilayah_ECP->caption() ?></span></th>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Tahun_ECP->Visible) { // Tahun_ECP ?>
		<th class="<?php echo $dm_pesertaecp_delete->Tahun_ECP->headerCellClass() ?>"><span id="elh_dm_pesertaecp_Tahun_ECP" class="dm_pesertaecp_Tahun_ECP"><?php echo $dm_pesertaecp_delete->Tahun_ECP->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$dm_pesertaecp_delete->RecordCount = 0;
$i = 0;
while (!$dm_pesertaecp_delete->Recordset->EOF) {
	$dm_pesertaecp_delete->RecordCount++;
	$dm_pesertaecp_delete->RowCount++;

	// Set row properties
	$dm_pesertaecp->resetAttributes();
	$dm_pesertaecp->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$dm_pesertaecp_delete->loadRowValues($dm_pesertaecp_delete->Recordset);

	// Render row
	$dm_pesertaecp_delete->renderRow();
?>
	<tr <?php echo $dm_pesertaecp->rowAttributes() ?>>
<?php if ($dm_pesertaecp_delete->ID_Unik->Visible) { // ID_Unik ?>
		<td <?php echo $dm_pesertaecp_delete->ID_Unik->cellAttributes() ?>>
<span id="el<?php echo $dm_pesertaecp_delete->RowCount ?>_dm_pesertaecp_ID_Unik" class="dm_pesertaecp_ID_Unik">
<span<?php echo $dm_pesertaecp_delete->ID_Unik->viewAttributes() ?>><?php echo $dm_pesertaecp_delete->ID_Unik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Nama->Visible) { // Nama ?>
		<td <?php echo $dm_pesertaecp_delete->Nama->cellAttributes() ?>>
<span id="el<?php echo $dm_pesertaecp_delete->RowCount ?>_dm_pesertaecp_Nama" class="dm_pesertaecp_Nama">
<span<?php echo $dm_pesertaecp_delete->Nama->viewAttributes() ?>><?php echo $dm_pesertaecp_delete->Nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Perusahaan->Visible) { // Perusahaan ?>
		<td <?php echo $dm_pesertaecp_delete->Perusahaan->cellAttributes() ?>>
<span id="el<?php echo $dm_pesertaecp_delete->RowCount ?>_dm_pesertaecp_Perusahaan" class="dm_pesertaecp_Perusahaan">
<span<?php echo $dm_pesertaecp_delete->Perusahaan->viewAttributes() ?>><?php echo $dm_pesertaecp_delete->Perusahaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Produk->Visible) { // Produk ?>
		<td <?php echo $dm_pesertaecp_delete->Produk->cellAttributes() ?>>
<span id="el<?php echo $dm_pesertaecp_delete->RowCount ?>_dm_pesertaecp_Produk" class="dm_pesertaecp_Produk">
<span<?php echo $dm_pesertaecp_delete->Produk->viewAttributes() ?>><?php echo $dm_pesertaecp_delete->Produk->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Kapasitas_Produksi->Visible) { // Kapasitas_Produksi ?>
		<td <?php echo $dm_pesertaecp_delete->Kapasitas_Produksi->cellAttributes() ?>>
<span id="el<?php echo $dm_pesertaecp_delete->RowCount ?>_dm_pesertaecp_Kapasitas_Produksi" class="dm_pesertaecp_Kapasitas_Produksi">
<span<?php echo $dm_pesertaecp_delete->Kapasitas_Produksi->viewAttributes() ?>><?php echo $dm_pesertaecp_delete->Kapasitas_Produksi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Omset->Visible) { // Omset ?>
		<td <?php echo $dm_pesertaecp_delete->Omset->cellAttributes() ?>>
<span id="el<?php echo $dm_pesertaecp_delete->RowCount ?>_dm_pesertaecp_Omset" class="dm_pesertaecp_Omset">
<span<?php echo $dm_pesertaecp_delete->Omset->viewAttributes() ?>><?php echo $dm_pesertaecp_delete->Omset->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Jumlah_Pegawai->Visible) { // Jumlah_Pegawai ?>
		<td <?php echo $dm_pesertaecp_delete->Jumlah_Pegawai->cellAttributes() ?>>
<span id="el<?php echo $dm_pesertaecp_delete->RowCount ?>_dm_pesertaecp_Jumlah_Pegawai" class="dm_pesertaecp_Jumlah_Pegawai">
<span<?php echo $dm_pesertaecp_delete->Jumlah_Pegawai->viewAttributes() ?>><?php echo $dm_pesertaecp_delete->Jumlah_Pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Legalitas_Perusahaan->Visible) { // Legalitas_Perusahaan ?>
		<td <?php echo $dm_pesertaecp_delete->Legalitas_Perusahaan->cellAttributes() ?>>
<span id="el<?php echo $dm_pesertaecp_delete->RowCount ?>_dm_pesertaecp_Legalitas_Perusahaan" class="dm_pesertaecp_Legalitas_Perusahaan">
<span<?php echo $dm_pesertaecp_delete->Legalitas_Perusahaan->viewAttributes() ?>><?php echo $dm_pesertaecp_delete->Legalitas_Perusahaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Sertifikasi_dimiliki->Visible) { // Sertifikasi_dimiliki ?>
		<td <?php echo $dm_pesertaecp_delete->Sertifikasi_dimiliki->cellAttributes() ?>>
<span id="el<?php echo $dm_pesertaecp_delete->RowCount ?>_dm_pesertaecp_Sertifikasi_dimiliki" class="dm_pesertaecp_Sertifikasi_dimiliki">
<span<?php echo $dm_pesertaecp_delete->Sertifikasi_dimiliki->viewAttributes() ?>><?php echo $dm_pesertaecp_delete->Sertifikasi_dimiliki->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Handphone->Visible) { // Handphone ?>
		<td <?php echo $dm_pesertaecp_delete->Handphone->cellAttributes() ?>>
<span id="el<?php echo $dm_pesertaecp_delete->RowCount ?>_dm_pesertaecp_Handphone" class="dm_pesertaecp_Handphone">
<span<?php echo $dm_pesertaecp_delete->Handphone->viewAttributes() ?>><?php echo $dm_pesertaecp_delete->Handphone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Email_Add->Visible) { // Email_Add ?>
		<td <?php echo $dm_pesertaecp_delete->Email_Add->cellAttributes() ?>>
<span id="el<?php echo $dm_pesertaecp_delete->RowCount ?>_dm_pesertaecp_Email_Add" class="dm_pesertaecp_Email_Add">
<span<?php echo $dm_pesertaecp_delete->Email_Add->viewAttributes() ?>><?php echo $dm_pesertaecp_delete->Email_Add->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Website->Visible) { // Website ?>
		<td <?php echo $dm_pesertaecp_delete->Website->cellAttributes() ?>>
<span id="el<?php echo $dm_pesertaecp_delete->RowCount ?>_dm_pesertaecp_Website" class="dm_pesertaecp_Website">
<span<?php echo $dm_pesertaecp_delete->Website->viewAttributes() ?>><?php echo $dm_pesertaecp_delete->Website->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Tahun_Berdiri->Visible) { // Tahun_Berdiri ?>
		<td <?php echo $dm_pesertaecp_delete->Tahun_Berdiri->cellAttributes() ?>>
<span id="el<?php echo $dm_pesertaecp_delete->RowCount ?>_dm_pesertaecp_Tahun_Berdiri" class="dm_pesertaecp_Tahun_Berdiri">
<span<?php echo $dm_pesertaecp_delete->Tahun_Berdiri->viewAttributes() ?>><?php echo $dm_pesertaecp_delete->Tahun_Berdiri->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Wilayah_ECP->Visible) { // Wilayah_ECP ?>
		<td <?php echo $dm_pesertaecp_delete->Wilayah_ECP->cellAttributes() ?>>
<span id="el<?php echo $dm_pesertaecp_delete->RowCount ?>_dm_pesertaecp_Wilayah_ECP" class="dm_pesertaecp_Wilayah_ECP">
<span<?php echo $dm_pesertaecp_delete->Wilayah_ECP->viewAttributes() ?>><?php echo $dm_pesertaecp_delete->Wilayah_ECP->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dm_pesertaecp_delete->Tahun_ECP->Visible) { // Tahun_ECP ?>
		<td <?php echo $dm_pesertaecp_delete->Tahun_ECP->cellAttributes() ?>>
<span id="el<?php echo $dm_pesertaecp_delete->RowCount ?>_dm_pesertaecp_Tahun_ECP" class="dm_pesertaecp_Tahun_ECP">
<span<?php echo $dm_pesertaecp_delete->Tahun_ECP->viewAttributes() ?>><?php echo $dm_pesertaecp_delete->Tahun_ECP->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$dm_pesertaecp_delete->Recordset->moveNext();
}
$dm_pesertaecp_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $dm_pesertaecp_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$dm_pesertaecp_delete->showPageFooter();
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
$dm_pesertaecp_delete->terminate();
?>