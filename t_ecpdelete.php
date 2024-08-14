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
$t_ecp_delete = new t_ecp_delete();

// Run the page
$t_ecp_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_ecp_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_ecpdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_ecpdelete = currentForm = new ew.Form("ft_ecpdelete", "delete");
	loadjs.done("ft_ecpdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_ecp_delete->showPageHeader(); ?>
<?php
$t_ecp_delete->showMessage();
?>
<form name="ft_ecpdelete" id="ft_ecpdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_ecp">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_ecp_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_ecp_delete->Daerah->Visible) { // Daerah ?>
		<th class="<?php echo $t_ecp_delete->Daerah->headerCellClass() ?>"><span id="elh_t_ecp_Daerah" class="t_ecp_Daerah"><?php echo $t_ecp_delete->Daerah->caption() ?></span></th>
<?php } ?>
<?php if ($t_ecp_delete->Produk->Visible) { // Produk ?>
		<th class="<?php echo $t_ecp_delete->Produk->headerCellClass() ?>"><span id="elh_t_ecp_Produk" class="t_ecp_Produk"><?php echo $t_ecp_delete->Produk->caption() ?></span></th>
<?php } ?>
<?php if ($t_ecp_delete->Tgl_Bln_Ekspor->Visible) { // Tgl_Bln_Ekspor ?>
		<th class="<?php echo $t_ecp_delete->Tgl_Bln_Ekspor->headerCellClass() ?>"><span id="elh_t_ecp_Tgl_Bln_Ekspor" class="t_ecp_Tgl_Bln_Ekspor"><?php echo $t_ecp_delete->Tgl_Bln_Ekspor->caption() ?></span></th>
<?php } ?>
<?php if ($t_ecp_delete->Tahun_Ekspor->Visible) { // Tahun_Ekspor ?>
		<th class="<?php echo $t_ecp_delete->Tahun_Ekspor->headerCellClass() ?>"><span id="elh_t_ecp_Tahun_Ekspor" class="t_ecp_Tahun_Ekspor"><?php echo $t_ecp_delete->Tahun_Ekspor->caption() ?></span></th>
<?php } ?>
<?php if ($t_ecp_delete->Negara_Tujuan->Visible) { // Negara_Tujuan ?>
		<th class="<?php echo $t_ecp_delete->Negara_Tujuan->headerCellClass() ?>"><span id="elh_t_ecp_Negara_Tujuan" class="t_ecp_Negara_Tujuan"><?php echo $t_ecp_delete->Negara_Tujuan->caption() ?></span></th>
<?php } ?>
<?php if ($t_ecp_delete->Nilai_Ekspor_USD->Visible) { // Nilai_Ekspor_USD ?>
		<th class="<?php echo $t_ecp_delete->Nilai_Ekspor_USD->headerCellClass() ?>"><span id="elh_t_ecp_Nilai_Ekspor_USD" class="t_ecp_Nilai_Ekspor_USD"><?php echo $t_ecp_delete->Nilai_Ekspor_USD->caption() ?></span></th>
<?php } ?>
<?php if ($t_ecp_delete->Nilai_Ekspor_Rupiah->Visible) { // Nilai_Ekspor_Rupiah ?>
		<th class="<?php echo $t_ecp_delete->Nilai_Ekspor_Rupiah->headerCellClass() ?>"><span id="elh_t_ecp_Nilai_Ekspor_Rupiah" class="t_ecp_Nilai_Ekspor_Rupiah"><?php echo $t_ecp_delete->Nilai_Ekspor_Rupiah->caption() ?></span></th>
<?php } ?>
<?php if ($t_ecp_delete->Keterangan->Visible) { // Keterangan ?>
		<th class="<?php echo $t_ecp_delete->Keterangan->headerCellClass() ?>"><span id="elh_t_ecp_Keterangan" class="t_ecp_Keterangan"><?php echo $t_ecp_delete->Keterangan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_ecp_delete->RecordCount = 0;
$i = 0;
while (!$t_ecp_delete->Recordset->EOF) {
	$t_ecp_delete->RecordCount++;
	$t_ecp_delete->RowCount++;

	// Set row properties
	$t_ecp->resetAttributes();
	$t_ecp->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_ecp_delete->loadRowValues($t_ecp_delete->Recordset);

	// Render row
	$t_ecp_delete->renderRow();
?>
	<tr <?php echo $t_ecp->rowAttributes() ?>>
<?php if ($t_ecp_delete->Daerah->Visible) { // Daerah ?>
		<td <?php echo $t_ecp_delete->Daerah->cellAttributes() ?>>
<span id="el<?php echo $t_ecp_delete->RowCount ?>_t_ecp_Daerah" class="t_ecp_Daerah">
<span<?php echo $t_ecp_delete->Daerah->viewAttributes() ?>><?php echo $t_ecp_delete->Daerah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_ecp_delete->Produk->Visible) { // Produk ?>
		<td <?php echo $t_ecp_delete->Produk->cellAttributes() ?>>
<span id="el<?php echo $t_ecp_delete->RowCount ?>_t_ecp_Produk" class="t_ecp_Produk">
<span<?php echo $t_ecp_delete->Produk->viewAttributes() ?>><?php echo $t_ecp_delete->Produk->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_ecp_delete->Tgl_Bln_Ekspor->Visible) { // Tgl_Bln_Ekspor ?>
		<td <?php echo $t_ecp_delete->Tgl_Bln_Ekspor->cellAttributes() ?>>
<span id="el<?php echo $t_ecp_delete->RowCount ?>_t_ecp_Tgl_Bln_Ekspor" class="t_ecp_Tgl_Bln_Ekspor">
<span<?php echo $t_ecp_delete->Tgl_Bln_Ekspor->viewAttributes() ?>><?php echo $t_ecp_delete->Tgl_Bln_Ekspor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_ecp_delete->Tahun_Ekspor->Visible) { // Tahun_Ekspor ?>
		<td <?php echo $t_ecp_delete->Tahun_Ekspor->cellAttributes() ?>>
<span id="el<?php echo $t_ecp_delete->RowCount ?>_t_ecp_Tahun_Ekspor" class="t_ecp_Tahun_Ekspor">
<span<?php echo $t_ecp_delete->Tahun_Ekspor->viewAttributes() ?>><?php echo $t_ecp_delete->Tahun_Ekspor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_ecp_delete->Negara_Tujuan->Visible) { // Negara_Tujuan ?>
		<td <?php echo $t_ecp_delete->Negara_Tujuan->cellAttributes() ?>>
<span id="el<?php echo $t_ecp_delete->RowCount ?>_t_ecp_Negara_Tujuan" class="t_ecp_Negara_Tujuan">
<span<?php echo $t_ecp_delete->Negara_Tujuan->viewAttributes() ?>><?php echo $t_ecp_delete->Negara_Tujuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_ecp_delete->Nilai_Ekspor_USD->Visible) { // Nilai_Ekspor_USD ?>
		<td <?php echo $t_ecp_delete->Nilai_Ekspor_USD->cellAttributes() ?>>
<span id="el<?php echo $t_ecp_delete->RowCount ?>_t_ecp_Nilai_Ekspor_USD" class="t_ecp_Nilai_Ekspor_USD">
<span<?php echo $t_ecp_delete->Nilai_Ekspor_USD->viewAttributes() ?>><?php echo $t_ecp_delete->Nilai_Ekspor_USD->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_ecp_delete->Nilai_Ekspor_Rupiah->Visible) { // Nilai_Ekspor_Rupiah ?>
		<td <?php echo $t_ecp_delete->Nilai_Ekspor_Rupiah->cellAttributes() ?>>
<span id="el<?php echo $t_ecp_delete->RowCount ?>_t_ecp_Nilai_Ekspor_Rupiah" class="t_ecp_Nilai_Ekspor_Rupiah">
<span<?php echo $t_ecp_delete->Nilai_Ekspor_Rupiah->viewAttributes() ?>><?php echo $t_ecp_delete->Nilai_Ekspor_Rupiah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_ecp_delete->Keterangan->Visible) { // Keterangan ?>
		<td <?php echo $t_ecp_delete->Keterangan->cellAttributes() ?>>
<span id="el<?php echo $t_ecp_delete->RowCount ?>_t_ecp_Keterangan" class="t_ecp_Keterangan">
<span<?php echo $t_ecp_delete->Keterangan->viewAttributes() ?>><?php echo $t_ecp_delete->Keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_ecp_delete->Recordset->moveNext();
}
$t_ecp_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_ecp_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_ecp_delete->showPageFooter();
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
$t_ecp_delete->terminate();
?>