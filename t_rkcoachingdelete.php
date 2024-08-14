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
$t_rkcoaching_delete = new t_rkcoaching_delete();

// Run the page
$t_rkcoaching_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rkcoaching_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_rkcoachingdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_rkcoachingdelete = currentForm = new ew.Form("ft_rkcoachingdelete", "delete");
	loadjs.done("ft_rkcoachingdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_rkcoaching_delete->showPageHeader(); ?>
<?php
$t_rkcoaching_delete->showMessage();
?>
<form name="ft_rkcoachingdelete" id="ft_rkcoachingdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rkcoaching">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_rkcoaching_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_rkcoaching_delete->kdkategori->Visible) { // kdkategori ?>
		<th class="<?php echo $t_rkcoaching_delete->kdkategori->headerCellClass() ?>"><span id="elh_t_rkcoaching_kdkategori" class="t_rkcoaching_kdkategori"><?php echo $t_rkcoaching_delete->kdkategori->caption() ?></span></th>
<?php } ?>
<?php if ($t_rkcoaching_delete->kerjasama->Visible) { // kerjasama ?>
		<th class="<?php echo $t_rkcoaching_delete->kerjasama->headerCellClass() ?>"><span id="elh_t_rkcoaching_kerjasama" class="t_rkcoaching_kerjasama"><?php echo $t_rkcoaching_delete->kerjasama->caption() ?></span></th>
<?php } ?>
<?php if ($t_rkcoaching_delete->area->Visible) { // area ?>
		<th class="<?php echo $t_rkcoaching_delete->area->headerCellClass() ?>"><span id="elh_t_rkcoaching_area" class="t_rkcoaching_area"><?php echo $t_rkcoaching_delete->area->caption() ?></span></th>
<?php } ?>
<?php if ($t_rkcoaching_delete->area2->Visible) { // area2 ?>
		<th class="<?php echo $t_rkcoaching_delete->area2->headerCellClass() ?>"><span id="elh_t_rkcoaching_area2" class="t_rkcoaching_area2"><?php echo $t_rkcoaching_delete->area2->caption() ?></span></th>
<?php } ?>
<?php if ($t_rkcoaching_delete->tempat->Visible) { // tempat ?>
		<th class="<?php echo $t_rkcoaching_delete->tempat->headerCellClass() ?>"><span id="elh_t_rkcoaching_tempat" class="t_rkcoaching_tempat"><?php echo $t_rkcoaching_delete->tempat->caption() ?></span></th>
<?php } ?>
<?php if ($t_rkcoaching_delete->jml_tahapan->Visible) { // jml_tahapan ?>
		<th class="<?php echo $t_rkcoaching_delete->jml_tahapan->headerCellClass() ?>"><span id="elh_t_rkcoaching_jml_tahapan" class="t_rkcoaching_jml_tahapan"><?php echo $t_rkcoaching_delete->jml_tahapan->caption() ?></span></th>
<?php } ?>
<?php if ($t_rkcoaching_delete->jml_peserta->Visible) { // jml_peserta ?>
		<th class="<?php echo $t_rkcoaching_delete->jml_peserta->headerCellClass() ?>"><span id="elh_t_rkcoaching_jml_peserta" class="t_rkcoaching_jml_peserta"><?php echo $t_rkcoaching_delete->jml_peserta->caption() ?></span></th>
<?php } ?>
<?php if ($t_rkcoaching_delete->tahun_keg->Visible) { // tahun_keg ?>
		<th class="<?php echo $t_rkcoaching_delete->tahun_keg->headerCellClass() ?>"><span id="elh_t_rkcoaching_tahun_keg" class="t_rkcoaching_tahun_keg"><?php echo $t_rkcoaching_delete->tahun_keg->caption() ?></span></th>
<?php } ?>
<?php if ($t_rkcoaching_delete->mou->Visible) { // mou ?>
		<th class="<?php echo $t_rkcoaching_delete->mou->headerCellClass() ?>"><span id="elh_t_rkcoaching_mou" class="t_rkcoaching_mou"><?php echo $t_rkcoaching_delete->mou->caption() ?></span></th>
<?php } ?>
<?php if ($t_rkcoaching_delete->real->Visible) { // real ?>
		<th class="<?php echo $t_rkcoaching_delete->real->headerCellClass() ?>"><span id="elh_t_rkcoaching_real" class="t_rkcoaching_real"><?php echo $t_rkcoaching_delete->real->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_rkcoaching_delete->RecordCount = 0;
$i = 0;
while (!$t_rkcoaching_delete->Recordset->EOF) {
	$t_rkcoaching_delete->RecordCount++;
	$t_rkcoaching_delete->RowCount++;

	// Set row properties
	$t_rkcoaching->resetAttributes();
	$t_rkcoaching->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_rkcoaching_delete->loadRowValues($t_rkcoaching_delete->Recordset);

	// Render row
	$t_rkcoaching_delete->renderRow();
?>
	<tr <?php echo $t_rkcoaching->rowAttributes() ?>>
<?php if ($t_rkcoaching_delete->kdkategori->Visible) { // kdkategori ?>
		<td <?php echo $t_rkcoaching_delete->kdkategori->cellAttributes() ?>>
<span id="el<?php echo $t_rkcoaching_delete->RowCount ?>_t_rkcoaching_kdkategori" class="t_rkcoaching_kdkategori">
<span<?php echo $t_rkcoaching_delete->kdkategori->viewAttributes() ?>><?php echo $t_rkcoaching_delete->kdkategori->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rkcoaching_delete->kerjasama->Visible) { // kerjasama ?>
		<td <?php echo $t_rkcoaching_delete->kerjasama->cellAttributes() ?>>
<span id="el<?php echo $t_rkcoaching_delete->RowCount ?>_t_rkcoaching_kerjasama" class="t_rkcoaching_kerjasama">
<span<?php echo $t_rkcoaching_delete->kerjasama->viewAttributes() ?>><?php echo $t_rkcoaching_delete->kerjasama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rkcoaching_delete->area->Visible) { // area ?>
		<td <?php echo $t_rkcoaching_delete->area->cellAttributes() ?>>
<span id="el<?php echo $t_rkcoaching_delete->RowCount ?>_t_rkcoaching_area" class="t_rkcoaching_area">
<span<?php echo $t_rkcoaching_delete->area->viewAttributes() ?>><?php echo $t_rkcoaching_delete->area->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rkcoaching_delete->area2->Visible) { // area2 ?>
		<td <?php echo $t_rkcoaching_delete->area2->cellAttributes() ?>>
<span id="el<?php echo $t_rkcoaching_delete->RowCount ?>_t_rkcoaching_area2" class="t_rkcoaching_area2">
<span<?php echo $t_rkcoaching_delete->area2->viewAttributes() ?>><?php echo $t_rkcoaching_delete->area2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rkcoaching_delete->tempat->Visible) { // tempat ?>
		<td <?php echo $t_rkcoaching_delete->tempat->cellAttributes() ?>>
<span id="el<?php echo $t_rkcoaching_delete->RowCount ?>_t_rkcoaching_tempat" class="t_rkcoaching_tempat">
<span<?php echo $t_rkcoaching_delete->tempat->viewAttributes() ?>><?php echo $t_rkcoaching_delete->tempat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rkcoaching_delete->jml_tahapan->Visible) { // jml_tahapan ?>
		<td <?php echo $t_rkcoaching_delete->jml_tahapan->cellAttributes() ?>>
<span id="el<?php echo $t_rkcoaching_delete->RowCount ?>_t_rkcoaching_jml_tahapan" class="t_rkcoaching_jml_tahapan">
<span<?php echo $t_rkcoaching_delete->jml_tahapan->viewAttributes() ?>><?php echo $t_rkcoaching_delete->jml_tahapan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rkcoaching_delete->jml_peserta->Visible) { // jml_peserta ?>
		<td <?php echo $t_rkcoaching_delete->jml_peserta->cellAttributes() ?>>
<span id="el<?php echo $t_rkcoaching_delete->RowCount ?>_t_rkcoaching_jml_peserta" class="t_rkcoaching_jml_peserta">
<span<?php echo $t_rkcoaching_delete->jml_peserta->viewAttributes() ?>><?php echo $t_rkcoaching_delete->jml_peserta->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rkcoaching_delete->tahun_keg->Visible) { // tahun_keg ?>
		<td <?php echo $t_rkcoaching_delete->tahun_keg->cellAttributes() ?>>
<span id="el<?php echo $t_rkcoaching_delete->RowCount ?>_t_rkcoaching_tahun_keg" class="t_rkcoaching_tahun_keg">
<span<?php echo $t_rkcoaching_delete->tahun_keg->viewAttributes() ?>><?php echo $t_rkcoaching_delete->tahun_keg->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rkcoaching_delete->mou->Visible) { // mou ?>
		<td <?php echo $t_rkcoaching_delete->mou->cellAttributes() ?>>
<span id="el<?php echo $t_rkcoaching_delete->RowCount ?>_t_rkcoaching_mou" class="t_rkcoaching_mou">
<span<?php echo $t_rkcoaching_delete->mou->viewAttributes() ?>><?php echo GetFileViewTag($t_rkcoaching_delete->mou, $t_rkcoaching_delete->mou->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rkcoaching_delete->real->Visible) { // real ?>
		<td <?php echo $t_rkcoaching_delete->real->cellAttributes() ?>>
<span id="el<?php echo $t_rkcoaching_delete->RowCount ?>_t_rkcoaching_real" class="t_rkcoaching_real">
<span<?php echo $t_rkcoaching_delete->real->viewAttributes() ?>><?php echo $t_rkcoaching_delete->real->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_rkcoaching_delete->Recordset->moveNext();
}
$t_rkcoaching_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_rkcoaching_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_rkcoaching_delete->showPageFooter();
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
$t_rkcoaching_delete->terminate();
?>