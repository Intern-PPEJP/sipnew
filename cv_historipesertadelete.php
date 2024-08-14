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
$cv_historipeserta_delete = new cv_historipeserta_delete();

// Run the page
$cv_historipeserta_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cv_historipeserta_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcv_historipesertadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcv_historipesertadelete = currentForm = new ew.Form("fcv_historipesertadelete", "delete");
	loadjs.done("fcv_historipesertadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cv_historipeserta_delete->showPageHeader(); ?>
<?php
$cv_historipeserta_delete->showMessage();
?>
<form name="fcv_historipesertadelete" id="fcv_historipesertadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cv_historipeserta">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($cv_historipeserta_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($cv_historipeserta_delete->kdhistori->Visible) { // kdhistori ?>
		<th class="<?php echo $cv_historipeserta_delete->kdhistori->headerCellClass() ?>"><span id="elh_cv_historipeserta_kdhistori" class="cv_historipeserta_kdhistori"><?php echo $cv_historipeserta_delete->kdhistori->caption() ?></span></th>
<?php } ?>
<?php if ($cv_historipeserta_delete->kdpelat->Visible) { // kdpelat ?>
		<th class="<?php echo $cv_historipeserta_delete->kdpelat->headerCellClass() ?>"><span id="elh_cv_historipeserta_kdpelat" class="cv_historipeserta_kdpelat"><?php echo $cv_historipeserta_delete->kdpelat->caption() ?></span></th>
<?php } ?>
<?php if ($cv_historipeserta_delete->id->Visible) { // id ?>
		<th class="<?php echo $cv_historipeserta_delete->id->headerCellClass() ?>"><span id="elh_cv_historipeserta_id" class="cv_historipeserta_id"><?php echo $cv_historipeserta_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($cv_historipeserta_delete->tahun->Visible) { // tahun ?>
		<th class="<?php echo $cv_historipeserta_delete->tahun->headerCellClass() ?>"><span id="elh_cv_historipeserta_tahun" class="cv_historipeserta_tahun"><?php echo $cv_historipeserta_delete->tahun->caption() ?></span></th>
<?php } ?>
<?php if ($cv_historipeserta_delete->kdinformasi->Visible) { // kdinformasi ?>
		<th class="<?php echo $cv_historipeserta_delete->kdinformasi->headerCellClass() ?>"><span id="elh_cv_historipeserta_kdinformasi" class="cv_historipeserta_kdinformasi"><?php echo $cv_historipeserta_delete->kdinformasi->caption() ?></span></th>
<?php } ?>
<?php if ($cv_historipeserta_delete->harapan->Visible) { // harapan ?>
		<th class="<?php echo $cv_historipeserta_delete->harapan->headerCellClass() ?>"><span id="elh_cv_historipeserta_harapan" class="cv_historipeserta_harapan"><?php echo $cv_historipeserta_delete->harapan->caption() ?></span></th>
<?php } ?>
<?php if ($cv_historipeserta_delete->sertifikat->Visible) { // sertifikat ?>
		<th class="<?php echo $cv_historipeserta_delete->sertifikat->headerCellClass() ?>"><span id="elh_cv_historipeserta_sertifikat" class="cv_historipeserta_sertifikat"><?php echo $cv_historipeserta_delete->sertifikat->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$cv_historipeserta_delete->RecordCount = 0;
$i = 0;
while (!$cv_historipeserta_delete->Recordset->EOF) {
	$cv_historipeserta_delete->RecordCount++;
	$cv_historipeserta_delete->RowCount++;

	// Set row properties
	$cv_historipeserta->resetAttributes();
	$cv_historipeserta->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$cv_historipeserta_delete->loadRowValues($cv_historipeserta_delete->Recordset);

	// Render row
	$cv_historipeserta_delete->renderRow();
?>
	<tr <?php echo $cv_historipeserta->rowAttributes() ?>>
<?php if ($cv_historipeserta_delete->kdhistori->Visible) { // kdhistori ?>
		<td <?php echo $cv_historipeserta_delete->kdhistori->cellAttributes() ?>>
<span id="el<?php echo $cv_historipeserta_delete->RowCount ?>_cv_historipeserta_kdhistori" class="cv_historipeserta_kdhistori">
<span<?php echo $cv_historipeserta_delete->kdhistori->viewAttributes() ?>><?php echo $cv_historipeserta_delete->kdhistori->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cv_historipeserta_delete->kdpelat->Visible) { // kdpelat ?>
		<td <?php echo $cv_historipeserta_delete->kdpelat->cellAttributes() ?>>
<span id="el<?php echo $cv_historipeserta_delete->RowCount ?>_cv_historipeserta_kdpelat" class="cv_historipeserta_kdpelat">
<span<?php echo $cv_historipeserta_delete->kdpelat->viewAttributes() ?>><?php echo $cv_historipeserta_delete->kdpelat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cv_historipeserta_delete->id->Visible) { // id ?>
		<td <?php echo $cv_historipeserta_delete->id->cellAttributes() ?>>
<span id="el<?php echo $cv_historipeserta_delete->RowCount ?>_cv_historipeserta_id" class="cv_historipeserta_id">
<span<?php echo $cv_historipeserta_delete->id->viewAttributes() ?>><?php echo $cv_historipeserta_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cv_historipeserta_delete->tahun->Visible) { // tahun ?>
		<td <?php echo $cv_historipeserta_delete->tahun->cellAttributes() ?>>
<span id="el<?php echo $cv_historipeserta_delete->RowCount ?>_cv_historipeserta_tahun" class="cv_historipeserta_tahun">
<span<?php echo $cv_historipeserta_delete->tahun->viewAttributes() ?>><?php echo $cv_historipeserta_delete->tahun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cv_historipeserta_delete->kdinformasi->Visible) { // kdinformasi ?>
		<td <?php echo $cv_historipeserta_delete->kdinformasi->cellAttributes() ?>>
<span id="el<?php echo $cv_historipeserta_delete->RowCount ?>_cv_historipeserta_kdinformasi" class="cv_historipeserta_kdinformasi">
<span<?php echo $cv_historipeserta_delete->kdinformasi->viewAttributes() ?>><?php echo $cv_historipeserta_delete->kdinformasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cv_historipeserta_delete->harapan->Visible) { // harapan ?>
		<td <?php echo $cv_historipeserta_delete->harapan->cellAttributes() ?>>
<span id="el<?php echo $cv_historipeserta_delete->RowCount ?>_cv_historipeserta_harapan" class="cv_historipeserta_harapan">
<span<?php echo $cv_historipeserta_delete->harapan->viewAttributes() ?>><?php echo $cv_historipeserta_delete->harapan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cv_historipeserta_delete->sertifikat->Visible) { // sertifikat ?>
		<td <?php echo $cv_historipeserta_delete->sertifikat->cellAttributes() ?>>
<span id="el<?php echo $cv_historipeserta_delete->RowCount ?>_cv_historipeserta_sertifikat" class="cv_historipeserta_sertifikat">
<span<?php echo $cv_historipeserta_delete->sertifikat->viewAttributes() ?>><?php echo $cv_historipeserta_delete->sertifikat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$cv_historipeserta_delete->Recordset->moveNext();
}
$cv_historipeserta_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cv_historipeserta_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$cv_historipeserta_delete->showPageFooter();
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
$cv_historipeserta_delete->terminate();
?>