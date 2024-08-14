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
$cv_historipelatihanpeserta_delete = new cv_historipelatihanpeserta_delete();

// Run the page
$cv_historipelatihanpeserta_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cv_historipelatihanpeserta_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcv_historipelatihanpesertadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcv_historipelatihanpesertadelete = currentForm = new ew.Form("fcv_historipelatihanpesertadelete", "delete");
	loadjs.done("fcv_historipelatihanpesertadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cv_historipelatihanpeserta_delete->showPageHeader(); ?>
<?php
$cv_historipelatihanpeserta_delete->showMessage();
?>
<form name="fcv_historipelatihanpesertadelete" id="fcv_historipelatihanpesertadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cv_historipelatihanpeserta">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($cv_historipelatihanpeserta_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($cv_historipelatihanpeserta_delete->kdhistori->Visible) { // kdhistori ?>
		<th class="<?php echo $cv_historipelatihanpeserta_delete->kdhistori->headerCellClass() ?>"><span id="elh_cv_historipelatihanpeserta_kdhistori" class="cv_historipelatihanpeserta_kdhistori"><?php echo $cv_historipelatihanpeserta_delete->kdhistori->caption() ?></span></th>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_delete->id->Visible) { // id ?>
		<th class="<?php echo $cv_historipelatihanpeserta_delete->id->headerCellClass() ?>"><span id="elh_cv_historipelatihanpeserta_id" class="cv_historipelatihanpeserta_id"><?php echo $cv_historipelatihanpeserta_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_delete->kdpelat->Visible) { // kdpelat ?>
		<th class="<?php echo $cv_historipelatihanpeserta_delete->kdpelat->headerCellClass() ?>"><span id="elh_cv_historipelatihanpeserta_kdpelat" class="cv_historipelatihanpeserta_kdpelat"><?php echo $cv_historipelatihanpeserta_delete->kdpelat->caption() ?></span></th>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_delete->tahun->Visible) { // tahun ?>
		<th class="<?php echo $cv_historipelatihanpeserta_delete->tahun->headerCellClass() ?>"><span id="elh_cv_historipelatihanpeserta_tahun" class="cv_historipelatihanpeserta_tahun"><?php echo $cv_historipelatihanpeserta_delete->tahun->caption() ?></span></th>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_delete->kdinformasi->Visible) { // kdinformasi ?>
		<th class="<?php echo $cv_historipelatihanpeserta_delete->kdinformasi->headerCellClass() ?>"><span id="elh_cv_historipelatihanpeserta_kdinformasi" class="cv_historipelatihanpeserta_kdinformasi"><?php echo $cv_historipelatihanpeserta_delete->kdinformasi->caption() ?></span></th>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_delete->harapan->Visible) { // harapan ?>
		<th class="<?php echo $cv_historipelatihanpeserta_delete->harapan->headerCellClass() ?>"><span id="elh_cv_historipelatihanpeserta_harapan" class="cv_historipelatihanpeserta_harapan"><?php echo $cv_historipelatihanpeserta_delete->harapan->caption() ?></span></th>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_delete->sertifikat->Visible) { // sertifikat ?>
		<th class="<?php echo $cv_historipelatihanpeserta_delete->sertifikat->headerCellClass() ?>"><span id="elh_cv_historipelatihanpeserta_sertifikat" class="cv_historipelatihanpeserta_sertifikat"><?php echo $cv_historipelatihanpeserta_delete->sertifikat->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$cv_historipelatihanpeserta_delete->RecordCount = 0;
$i = 0;
while (!$cv_historipelatihanpeserta_delete->Recordset->EOF) {
	$cv_historipelatihanpeserta_delete->RecordCount++;
	$cv_historipelatihanpeserta_delete->RowCount++;

	// Set row properties
	$cv_historipelatihanpeserta->resetAttributes();
	$cv_historipelatihanpeserta->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$cv_historipelatihanpeserta_delete->loadRowValues($cv_historipelatihanpeserta_delete->Recordset);

	// Render row
	$cv_historipelatihanpeserta_delete->renderRow();
?>
	<tr <?php echo $cv_historipelatihanpeserta->rowAttributes() ?>>
<?php if ($cv_historipelatihanpeserta_delete->kdhistori->Visible) { // kdhistori ?>
		<td <?php echo $cv_historipelatihanpeserta_delete->kdhistori->cellAttributes() ?>>
<span id="el<?php echo $cv_historipelatihanpeserta_delete->RowCount ?>_cv_historipelatihanpeserta_kdhistori" class="cv_historipelatihanpeserta_kdhistori">
<span<?php echo $cv_historipelatihanpeserta_delete->kdhistori->viewAttributes() ?>><?php echo $cv_historipelatihanpeserta_delete->kdhistori->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_delete->id->Visible) { // id ?>
		<td <?php echo $cv_historipelatihanpeserta_delete->id->cellAttributes() ?>>
<span id="el<?php echo $cv_historipelatihanpeserta_delete->RowCount ?>_cv_historipelatihanpeserta_id" class="cv_historipelatihanpeserta_id">
<span<?php echo $cv_historipelatihanpeserta_delete->id->viewAttributes() ?>><?php if (!EmptyString($cv_historipelatihanpeserta_delete->id->getViewValue()) && $cv_historipelatihanpeserta_delete->id->linkAttributes() != "") { ?>
<a<?php echo $cv_historipelatihanpeserta_delete->id->linkAttributes() ?>><?php echo $cv_historipelatihanpeserta_delete->id->getViewValue() ?></a>
<?php } else { ?>
<?php echo $cv_historipelatihanpeserta_delete->id->getViewValue() ?>
<?php } ?></span>
</span>
</td>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_delete->kdpelat->Visible) { // kdpelat ?>
		<td <?php echo $cv_historipelatihanpeserta_delete->kdpelat->cellAttributes() ?>>
<span id="el<?php echo $cv_historipelatihanpeserta_delete->RowCount ?>_cv_historipelatihanpeserta_kdpelat" class="cv_historipelatihanpeserta_kdpelat">
<span<?php echo $cv_historipelatihanpeserta_delete->kdpelat->viewAttributes() ?>><?php echo $cv_historipelatihanpeserta_delete->kdpelat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_delete->tahun->Visible) { // tahun ?>
		<td <?php echo $cv_historipelatihanpeserta_delete->tahun->cellAttributes() ?>>
<span id="el<?php echo $cv_historipelatihanpeserta_delete->RowCount ?>_cv_historipelatihanpeserta_tahun" class="cv_historipelatihanpeserta_tahun">
<span<?php echo $cv_historipelatihanpeserta_delete->tahun->viewAttributes() ?>><?php echo $cv_historipelatihanpeserta_delete->tahun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_delete->kdinformasi->Visible) { // kdinformasi ?>
		<td <?php echo $cv_historipelatihanpeserta_delete->kdinformasi->cellAttributes() ?>>
<span id="el<?php echo $cv_historipelatihanpeserta_delete->RowCount ?>_cv_historipelatihanpeserta_kdinformasi" class="cv_historipelatihanpeserta_kdinformasi">
<span<?php echo $cv_historipelatihanpeserta_delete->kdinformasi->viewAttributes() ?>><?php echo $cv_historipelatihanpeserta_delete->kdinformasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_delete->harapan->Visible) { // harapan ?>
		<td <?php echo $cv_historipelatihanpeserta_delete->harapan->cellAttributes() ?>>
<span id="el<?php echo $cv_historipelatihanpeserta_delete->RowCount ?>_cv_historipelatihanpeserta_harapan" class="cv_historipelatihanpeserta_harapan">
<span<?php echo $cv_historipelatihanpeserta_delete->harapan->viewAttributes() ?>><?php echo $cv_historipelatihanpeserta_delete->harapan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_delete->sertifikat->Visible) { // sertifikat ?>
		<td <?php echo $cv_historipelatihanpeserta_delete->sertifikat->cellAttributes() ?>>
<span id="el<?php echo $cv_historipelatihanpeserta_delete->RowCount ?>_cv_historipelatihanpeserta_sertifikat" class="cv_historipelatihanpeserta_sertifikat">
<span<?php echo $cv_historipelatihanpeserta_delete->sertifikat->viewAttributes() ?>><?php echo $cv_historipelatihanpeserta_delete->sertifikat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$cv_historipelatihanpeserta_delete->Recordset->moveNext();
}
$cv_historipelatihanpeserta_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cv_historipelatihanpeserta_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$cv_historipelatihanpeserta_delete->showPageFooter();
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
$cv_historipelatihanpeserta_delete->terminate();
?>