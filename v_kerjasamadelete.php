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
$v_kerjasama_delete = new v_kerjasama_delete();

// Run the page
$v_kerjasama_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v_kerjasama_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fv_kerjasamadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fv_kerjasamadelete = currentForm = new ew.Form("fv_kerjasamadelete", "delete");
	loadjs.done("fv_kerjasamadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $v_kerjasama_delete->showPageHeader(); ?>
<?php
$v_kerjasama_delete->showMessage();
?>
<form name="fv_kerjasamadelete" id="fv_kerjasamadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v_kerjasama">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($v_kerjasama_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($v_kerjasama_delete->kdpelat->Visible) { // kdpelat ?>
		<th class="<?php echo $v_kerjasama_delete->kdpelat->headerCellClass() ?>"><span id="elh_v_kerjasama_kdpelat" class="v_kerjasama_kdpelat"><?php echo $v_kerjasama_delete->kdpelat->caption() ?></span></th>
<?php } ?>
<?php if ($v_kerjasama_delete->kdjudul->Visible) { // kdjudul ?>
		<th class="<?php echo $v_kerjasama_delete->kdjudul->headerCellClass() ?>"><span id="elh_v_kerjasama_kdjudul" class="v_kerjasama_kdjudul"><?php echo $v_kerjasama_delete->kdjudul->caption() ?></span></th>
<?php } ?>
<?php if ($v_kerjasama_delete->tawal->Visible) { // tawal ?>
		<th class="<?php echo $v_kerjasama_delete->tawal->headerCellClass() ?>"><span id="elh_v_kerjasama_tawal" class="v_kerjasama_tawal"><?php echo $v_kerjasama_delete->tawal->caption() ?></span></th>
<?php } ?>
<?php if ($v_kerjasama_delete->takhir->Visible) { // takhir ?>
		<th class="<?php echo $v_kerjasama_delete->takhir->headerCellClass() ?>"><span id="elh_v_kerjasama_takhir" class="v_kerjasama_takhir"><?php echo $v_kerjasama_delete->takhir->caption() ?></span></th>
<?php } ?>
<?php if ($v_kerjasama_delete->jenispel->Visible) { // jenispel ?>
		<th class="<?php echo $v_kerjasama_delete->jenispel->headerCellClass() ?>"><span id="elh_v_kerjasama_jenispel" class="v_kerjasama_jenispel"><?php echo $v_kerjasama_delete->jenispel->caption() ?></span></th>
<?php } ?>
<?php if ($v_kerjasama_delete->kdkategori->Visible) { // kdkategori ?>
		<th class="<?php echo $v_kerjasama_delete->kdkategori->headerCellClass() ?>"><span id="elh_v_kerjasama_kdkategori" class="v_kerjasama_kdkategori"><?php echo $v_kerjasama_delete->kdkategori->caption() ?></span></th>
<?php } ?>
<?php if ($v_kerjasama_delete->kerjasama->Visible) { // kerjasama ?>
		<th class="<?php echo $v_kerjasama_delete->kerjasama->headerCellClass() ?>"><span id="elh_v_kerjasama_kerjasama" class="v_kerjasama_kerjasama"><?php echo $v_kerjasama_delete->kerjasama->caption() ?></span></th>
<?php } ?>
<?php if ($v_kerjasama_delete->biaya->Visible) { // biaya ?>
		<th class="<?php echo $v_kerjasama_delete->biaya->headerCellClass() ?>"><span id="elh_v_kerjasama_biaya" class="v_kerjasama_biaya"><?php echo $v_kerjasama_delete->biaya->caption() ?></span></th>
<?php } ?>
<?php if ($v_kerjasama_delete->tempat->Visible) { // tempat ?>
		<th class="<?php echo $v_kerjasama_delete->tempat->headerCellClass() ?>"><span id="elh_v_kerjasama_tempat" class="v_kerjasama_tempat"><?php echo $v_kerjasama_delete->tempat->caption() ?></span></th>
<?php } ?>
<?php if ($v_kerjasama_delete->target_peserta->Visible) { // target_peserta ?>
		<th class="<?php echo $v_kerjasama_delete->target_peserta->headerCellClass() ?>"><span id="elh_v_kerjasama_target_peserta" class="v_kerjasama_target_peserta"><?php echo $v_kerjasama_delete->target_peserta->caption() ?></span></th>
<?php } ?>
<?php if ($v_kerjasama_delete->durasi1->Visible) { // durasi1 ?>
		<th class="<?php echo $v_kerjasama_delete->durasi1->headerCellClass() ?>"><span id="elh_v_kerjasama_durasi1" class="v_kerjasama_durasi1"><?php echo $v_kerjasama_delete->durasi1->caption() ?></span></th>
<?php } ?>
<?php if ($v_kerjasama_delete->durasi2->Visible) { // durasi2 ?>
		<th class="<?php echo $v_kerjasama_delete->durasi2->headerCellClass() ?>"><span id="elh_v_kerjasama_durasi2" class="v_kerjasama_durasi2"><?php echo $v_kerjasama_delete->durasi2->caption() ?></span></th>
<?php } ?>
<?php if ($v_kerjasama_delete->nmou->Visible) { // nmou ?>
		<th class="<?php echo $v_kerjasama_delete->nmou->headerCellClass() ?>"><span id="elh_v_kerjasama_nmou" class="v_kerjasama_nmou"><?php echo $v_kerjasama_delete->nmou->caption() ?></span></th>
<?php } ?>
<?php if ($v_kerjasama_delete->nmou2->Visible) { // nmou2 ?>
		<th class="<?php echo $v_kerjasama_delete->nmou2->headerCellClass() ?>"><span id="elh_v_kerjasama_nmou2" class="v_kerjasama_nmou2"><?php echo $v_kerjasama_delete->nmou2->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$v_kerjasama_delete->RecordCount = 0;
$i = 0;
while (!$v_kerjasama_delete->Recordset->EOF) {
	$v_kerjasama_delete->RecordCount++;
	$v_kerjasama_delete->RowCount++;

	// Set row properties
	$v_kerjasama->resetAttributes();
	$v_kerjasama->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$v_kerjasama_delete->loadRowValues($v_kerjasama_delete->Recordset);

	// Render row
	$v_kerjasama_delete->renderRow();
?>
	<tr <?php echo $v_kerjasama->rowAttributes() ?>>
<?php if ($v_kerjasama_delete->kdpelat->Visible) { // kdpelat ?>
		<td <?php echo $v_kerjasama_delete->kdpelat->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_delete->RowCount ?>_v_kerjasama_kdpelat" class="v_kerjasama_kdpelat">
<span<?php echo $v_kerjasama_delete->kdpelat->viewAttributes() ?>><?php echo $v_kerjasama_delete->kdpelat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($v_kerjasama_delete->kdjudul->Visible) { // kdjudul ?>
		<td <?php echo $v_kerjasama_delete->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_delete->RowCount ?>_v_kerjasama_kdjudul" class="v_kerjasama_kdjudul">
<span<?php echo $v_kerjasama_delete->kdjudul->viewAttributes() ?>><?php echo $v_kerjasama_delete->kdjudul->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($v_kerjasama_delete->tawal->Visible) { // tawal ?>
		<td <?php echo $v_kerjasama_delete->tawal->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_delete->RowCount ?>_v_kerjasama_tawal" class="v_kerjasama_tawal">
<span<?php echo $v_kerjasama_delete->tawal->viewAttributes() ?>><?php echo $v_kerjasama_delete->tawal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($v_kerjasama_delete->takhir->Visible) { // takhir ?>
		<td <?php echo $v_kerjasama_delete->takhir->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_delete->RowCount ?>_v_kerjasama_takhir" class="v_kerjasama_takhir">
<span<?php echo $v_kerjasama_delete->takhir->viewAttributes() ?>><?php echo $v_kerjasama_delete->takhir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($v_kerjasama_delete->jenispel->Visible) { // jenispel ?>
		<td <?php echo $v_kerjasama_delete->jenispel->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_delete->RowCount ?>_v_kerjasama_jenispel" class="v_kerjasama_jenispel">
<span<?php echo $v_kerjasama_delete->jenispel->viewAttributes() ?>><?php echo $v_kerjasama_delete->jenispel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($v_kerjasama_delete->kdkategori->Visible) { // kdkategori ?>
		<td <?php echo $v_kerjasama_delete->kdkategori->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_delete->RowCount ?>_v_kerjasama_kdkategori" class="v_kerjasama_kdkategori">
<span<?php echo $v_kerjasama_delete->kdkategori->viewAttributes() ?>><?php echo $v_kerjasama_delete->kdkategori->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($v_kerjasama_delete->kerjasama->Visible) { // kerjasama ?>
		<td <?php echo $v_kerjasama_delete->kerjasama->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_delete->RowCount ?>_v_kerjasama_kerjasama" class="v_kerjasama_kerjasama">
<span<?php echo $v_kerjasama_delete->kerjasama->viewAttributes() ?>><?php echo $v_kerjasama_delete->kerjasama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($v_kerjasama_delete->biaya->Visible) { // biaya ?>
		<td <?php echo $v_kerjasama_delete->biaya->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_delete->RowCount ?>_v_kerjasama_biaya" class="v_kerjasama_biaya">
<span<?php echo $v_kerjasama_delete->biaya->viewAttributes() ?>><?php echo $v_kerjasama_delete->biaya->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($v_kerjasama_delete->tempat->Visible) { // tempat ?>
		<td <?php echo $v_kerjasama_delete->tempat->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_delete->RowCount ?>_v_kerjasama_tempat" class="v_kerjasama_tempat">
<span<?php echo $v_kerjasama_delete->tempat->viewAttributes() ?>><?php echo $v_kerjasama_delete->tempat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($v_kerjasama_delete->target_peserta->Visible) { // target_peserta ?>
		<td <?php echo $v_kerjasama_delete->target_peserta->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_delete->RowCount ?>_v_kerjasama_target_peserta" class="v_kerjasama_target_peserta">
<span<?php echo $v_kerjasama_delete->target_peserta->viewAttributes() ?>><?php echo $v_kerjasama_delete->target_peserta->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($v_kerjasama_delete->durasi1->Visible) { // durasi1 ?>
		<td <?php echo $v_kerjasama_delete->durasi1->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_delete->RowCount ?>_v_kerjasama_durasi1" class="v_kerjasama_durasi1">
<span<?php echo $v_kerjasama_delete->durasi1->viewAttributes() ?>><?php echo $v_kerjasama_delete->durasi1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($v_kerjasama_delete->durasi2->Visible) { // durasi2 ?>
		<td <?php echo $v_kerjasama_delete->durasi2->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_delete->RowCount ?>_v_kerjasama_durasi2" class="v_kerjasama_durasi2">
<span<?php echo $v_kerjasama_delete->durasi2->viewAttributes() ?>><?php echo $v_kerjasama_delete->durasi2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($v_kerjasama_delete->nmou->Visible) { // nmou ?>
		<td <?php echo $v_kerjasama_delete->nmou->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_delete->RowCount ?>_v_kerjasama_nmou" class="v_kerjasama_nmou">
<span<?php echo $v_kerjasama_delete->nmou->viewAttributes() ?>><?php echo GetFileViewTag($v_kerjasama_delete->nmou, $v_kerjasama_delete->nmou->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
<?php if ($v_kerjasama_delete->nmou2->Visible) { // nmou2 ?>
		<td <?php echo $v_kerjasama_delete->nmou2->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_delete->RowCount ?>_v_kerjasama_nmou2" class="v_kerjasama_nmou2">
<span<?php echo $v_kerjasama_delete->nmou2->viewAttributes() ?>><?php echo GetFileViewTag($v_kerjasama_delete->nmou2, $v_kerjasama_delete->nmou2->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$v_kerjasama_delete->Recordset->moveNext();
}
$v_kerjasama_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $v_kerjasama_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$v_kerjasama_delete->showPageFooter();
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
$v_kerjasama_delete->terminate();
?>