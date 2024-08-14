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
$t_repeserta_delete = new t_repeserta_delete();

// Run the page
$t_repeserta_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_repeserta_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_repesertadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_repesertadelete = currentForm = new ew.Form("ft_repesertadelete", "delete");
	loadjs.done("ft_repesertadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_repeserta_delete->showPageHeader(); ?>
<?php
$t_repeserta_delete->showMessage();
?>
<form name="ft_repesertadelete" id="ft_repesertadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_repeserta">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_repeserta_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_repeserta_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $t_repeserta_delete->nama->headerCellClass() ?>"><span id="elh_t_repeserta_nama" class="t_repeserta_nama"><?php echo $t_repeserta_delete->nama->caption() ?></span></th>
<?php } ?>
<?php if ($t_repeserta_delete->perusahaan->Visible) { // perusahaan ?>
		<th class="<?php echo $t_repeserta_delete->perusahaan->headerCellClass() ?>"><span id="elh_t_repeserta_perusahaan" class="t_repeserta_perusahaan"><?php echo $t_repeserta_delete->perusahaan->caption() ?></span></th>
<?php } ?>
<?php if ($t_repeserta_delete->jabatan->Visible) { // jabatan ?>
		<th class="<?php echo $t_repeserta_delete->jabatan->headerCellClass() ?>"><span id="elh_t_repeserta_jabatan" class="t_repeserta_jabatan"><?php echo $t_repeserta_delete->jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($t_repeserta_delete->tgl_daftar->Visible) { // tgl_daftar ?>
		<th class="<?php echo $t_repeserta_delete->tgl_daftar->headerCellClass() ?>"><span id="elh_t_repeserta_tgl_daftar" class="t_repeserta_tgl_daftar"><?php echo $t_repeserta_delete->tgl_daftar->caption() ?></span></th>
<?php } ?>
<?php if ($t_repeserta_delete->telp->Visible) { // telp ?>
		<th class="<?php echo $t_repeserta_delete->telp->headerCellClass() ?>"><span id="elh_t_repeserta_telp" class="t_repeserta_telp"><?php echo $t_repeserta_delete->telp->caption() ?></span></th>
<?php } ?>
<?php if ($t_repeserta_delete->fax->Visible) { // fax ?>
		<th class="<?php echo $t_repeserta_delete->fax->headerCellClass() ?>"><span id="elh_t_repeserta_fax" class="t_repeserta_fax"><?php echo $t_repeserta_delete->fax->caption() ?></span></th>
<?php } ?>
<?php if ($t_repeserta_delete->hp->Visible) { // hp ?>
		<th class="<?php echo $t_repeserta_delete->hp->headerCellClass() ?>"><span id="elh_t_repeserta_hp" class="t_repeserta_hp"><?php echo $t_repeserta_delete->hp->caption() ?></span></th>
<?php } ?>
<?php if ($t_repeserta_delete->produk->Visible) { // produk ?>
		<th class="<?php echo $t_repeserta_delete->produk->headerCellClass() ?>"><span id="elh_t_repeserta_produk" class="t_repeserta_produk"><?php echo $t_repeserta_delete->produk->caption() ?></span></th>
<?php } ?>
<?php if ($t_repeserta_delete->cara_bayar->Visible) { // cara_bayar ?>
		<th class="<?php echo $t_repeserta_delete->cara_bayar->headerCellClass() ?>"><span id="elh_t_repeserta_cara_bayar" class="t_repeserta_cara_bayar"><?php echo $t_repeserta_delete->cara_bayar->caption() ?></span></th>
<?php } ?>
<?php if ($t_repeserta_delete->ket_bayar->Visible) { // ket_bayar ?>
		<th class="<?php echo $t_repeserta_delete->ket_bayar->headerCellClass() ?>"><span id="elh_t_repeserta_ket_bayar" class="t_repeserta_ket_bayar"><?php echo $t_repeserta_delete->ket_bayar->caption() ?></span></th>
<?php } ?>
<?php if ($t_repeserta_delete->tgl_bayar->Visible) { // tgl_bayar ?>
		<th class="<?php echo $t_repeserta_delete->tgl_bayar->headerCellClass() ?>"><span id="elh_t_repeserta_tgl_bayar" class="t_repeserta_tgl_bayar"><?php echo $t_repeserta_delete->tgl_bayar->caption() ?></span></th>
<?php } ?>
<?php if ($t_repeserta_delete->kdinformasi->Visible) { // kdinformasi ?>
		<th class="<?php echo $t_repeserta_delete->kdinformasi->headerCellClass() ?>"><span id="elh_t_repeserta_kdinformasi" class="t_repeserta_kdinformasi"><?php echo $t_repeserta_delete->kdinformasi->caption() ?></span></th>
<?php } ?>
<?php if ($t_repeserta_delete->konfirmasi->Visible) { // konfirmasi ?>
		<th class="<?php echo $t_repeserta_delete->konfirmasi->headerCellClass() ?>"><span id="elh_t_repeserta_konfirmasi" class="t_repeserta_konfirmasi"><?php echo $t_repeserta_delete->konfirmasi->caption() ?></span></th>
<?php } ?>
<?php if ($t_repeserta_delete->ket->Visible) { // ket ?>
		<th class="<?php echo $t_repeserta_delete->ket->headerCellClass() ?>"><span id="elh_t_repeserta_ket" class="t_repeserta_ket"><?php echo $t_repeserta_delete->ket->caption() ?></span></th>
<?php } ?>
<?php if ($t_repeserta_delete->ket_lainnya->Visible) { // ket_lainnya ?>
		<th class="<?php echo $t_repeserta_delete->ket_lainnya->headerCellClass() ?>"><span id="elh_t_repeserta_ket_lainnya" class="t_repeserta_ket_lainnya"><?php echo $t_repeserta_delete->ket_lainnya->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_repeserta_delete->RecordCount = 0;
$i = 0;
while (!$t_repeserta_delete->Recordset->EOF) {
	$t_repeserta_delete->RecordCount++;
	$t_repeserta_delete->RowCount++;

	// Set row properties
	$t_repeserta->resetAttributes();
	$t_repeserta->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_repeserta_delete->loadRowValues($t_repeserta_delete->Recordset);

	// Render row
	$t_repeserta_delete->renderRow();
?>
	<tr <?php echo $t_repeserta->rowAttributes() ?>>
<?php if ($t_repeserta_delete->nama->Visible) { // nama ?>
		<td <?php echo $t_repeserta_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_delete->RowCount ?>_t_repeserta_nama" class="t_repeserta_nama">
<span<?php echo $t_repeserta_delete->nama->viewAttributes() ?>><?php echo $t_repeserta_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_repeserta_delete->perusahaan->Visible) { // perusahaan ?>
		<td <?php echo $t_repeserta_delete->perusahaan->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_delete->RowCount ?>_t_repeserta_perusahaan" class="t_repeserta_perusahaan">
<span<?php echo $t_repeserta_delete->perusahaan->viewAttributes() ?>><?php echo $t_repeserta_delete->perusahaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_repeserta_delete->jabatan->Visible) { // jabatan ?>
		<td <?php echo $t_repeserta_delete->jabatan->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_delete->RowCount ?>_t_repeserta_jabatan" class="t_repeserta_jabatan">
<span<?php echo $t_repeserta_delete->jabatan->viewAttributes() ?>><?php echo $t_repeserta_delete->jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_repeserta_delete->tgl_daftar->Visible) { // tgl_daftar ?>
		<td <?php echo $t_repeserta_delete->tgl_daftar->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_delete->RowCount ?>_t_repeserta_tgl_daftar" class="t_repeserta_tgl_daftar">
<span<?php echo $t_repeserta_delete->tgl_daftar->viewAttributes() ?>><?php echo $t_repeserta_delete->tgl_daftar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_repeserta_delete->telp->Visible) { // telp ?>
		<td <?php echo $t_repeserta_delete->telp->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_delete->RowCount ?>_t_repeserta_telp" class="t_repeserta_telp">
<span<?php echo $t_repeserta_delete->telp->viewAttributes() ?>><?php echo $t_repeserta_delete->telp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_repeserta_delete->fax->Visible) { // fax ?>
		<td <?php echo $t_repeserta_delete->fax->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_delete->RowCount ?>_t_repeserta_fax" class="t_repeserta_fax">
<span<?php echo $t_repeserta_delete->fax->viewAttributes() ?>><?php echo $t_repeserta_delete->fax->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_repeserta_delete->hp->Visible) { // hp ?>
		<td <?php echo $t_repeserta_delete->hp->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_delete->RowCount ?>_t_repeserta_hp" class="t_repeserta_hp">
<span<?php echo $t_repeserta_delete->hp->viewAttributes() ?>><?php echo $t_repeserta_delete->hp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_repeserta_delete->produk->Visible) { // produk ?>
		<td <?php echo $t_repeserta_delete->produk->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_delete->RowCount ?>_t_repeserta_produk" class="t_repeserta_produk">
<span<?php echo $t_repeserta_delete->produk->viewAttributes() ?>><?php echo $t_repeserta_delete->produk->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_repeserta_delete->cara_bayar->Visible) { // cara_bayar ?>
		<td <?php echo $t_repeserta_delete->cara_bayar->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_delete->RowCount ?>_t_repeserta_cara_bayar" class="t_repeserta_cara_bayar">
<span<?php echo $t_repeserta_delete->cara_bayar->viewAttributes() ?>><?php echo $t_repeserta_delete->cara_bayar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_repeserta_delete->ket_bayar->Visible) { // ket_bayar ?>
		<td <?php echo $t_repeserta_delete->ket_bayar->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_delete->RowCount ?>_t_repeserta_ket_bayar" class="t_repeserta_ket_bayar">
<span<?php echo $t_repeserta_delete->ket_bayar->viewAttributes() ?>><?php echo $t_repeserta_delete->ket_bayar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_repeserta_delete->tgl_bayar->Visible) { // tgl_bayar ?>
		<td <?php echo $t_repeserta_delete->tgl_bayar->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_delete->RowCount ?>_t_repeserta_tgl_bayar" class="t_repeserta_tgl_bayar">
<span<?php echo $t_repeserta_delete->tgl_bayar->viewAttributes() ?>><?php echo $t_repeserta_delete->tgl_bayar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_repeserta_delete->kdinformasi->Visible) { // kdinformasi ?>
		<td <?php echo $t_repeserta_delete->kdinformasi->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_delete->RowCount ?>_t_repeserta_kdinformasi" class="t_repeserta_kdinformasi">
<span<?php echo $t_repeserta_delete->kdinformasi->viewAttributes() ?>><?php echo $t_repeserta_delete->kdinformasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_repeserta_delete->konfirmasi->Visible) { // konfirmasi ?>
		<td <?php echo $t_repeserta_delete->konfirmasi->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_delete->RowCount ?>_t_repeserta_konfirmasi" class="t_repeserta_konfirmasi">
<span<?php echo $t_repeserta_delete->konfirmasi->viewAttributes() ?>><?php echo $t_repeserta_delete->konfirmasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_repeserta_delete->ket->Visible) { // ket ?>
		<td <?php echo $t_repeserta_delete->ket->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_delete->RowCount ?>_t_repeserta_ket" class="t_repeserta_ket">
<span<?php echo $t_repeserta_delete->ket->viewAttributes() ?>><?php echo $t_repeserta_delete->ket->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_repeserta_delete->ket_lainnya->Visible) { // ket_lainnya ?>
		<td <?php echo $t_repeserta_delete->ket_lainnya->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_delete->RowCount ?>_t_repeserta_ket_lainnya" class="t_repeserta_ket_lainnya">
<span<?php echo $t_repeserta_delete->ket_lainnya->viewAttributes() ?>><?php echo $t_repeserta_delete->ket_lainnya->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_repeserta_delete->Recordset->moveNext();
}
$t_repeserta_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_repeserta_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_repeserta_delete->showPageFooter();
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
$t_repeserta_delete->terminate();
?>