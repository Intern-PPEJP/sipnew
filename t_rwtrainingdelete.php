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
$t_rwtraining_delete = new t_rwtraining_delete();

// Run the page
$t_rwtraining_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rwtraining_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_rwtrainingdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_rwtrainingdelete = currentForm = new ew.Form("ft_rwtrainingdelete", "delete");
	loadjs.done("ft_rwtrainingdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_rwtraining_delete->showPageHeader(); ?>
<?php
$t_rwtraining_delete->showMessage();
?>
<form name="ft_rwtrainingdelete" id="ft_rwtrainingdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rwtraining">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_rwtraining_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_rwtraining_delete->rwtrainingid->Visible) { // rwtrainingid ?>
		<th class="<?php echo $t_rwtraining_delete->rwtrainingid->headerCellClass() ?>"><span id="elh_t_rwtraining_rwtrainingid" class="t_rwtraining_rwtrainingid"><?php echo $t_rwtraining_delete->rwtrainingid->caption() ?></span></th>
<?php } ?>
<?php if ($t_rwtraining_delete->bioid->Visible) { // bioid ?>
		<th class="<?php echo $t_rwtraining_delete->bioid->headerCellClass() ?>"><span id="elh_t_rwtraining_bioid" class="t_rwtraining_bioid"><?php echo $t_rwtraining_delete->bioid->caption() ?></span></th>
<?php } ?>
<?php if ($t_rwtraining_delete->training->Visible) { // training ?>
		<th class="<?php echo $t_rwtraining_delete->training->headerCellClass() ?>"><span id="elh_t_rwtraining_training" class="t_rwtraining_training"><?php echo $t_rwtraining_delete->training->caption() ?></span></th>
<?php } ?>
<?php if ($t_rwtraining_delete->tempat->Visible) { // tempat ?>
		<th class="<?php echo $t_rwtraining_delete->tempat->headerCellClass() ?>"><span id="elh_t_rwtraining_tempat" class="t_rwtraining_tempat"><?php echo $t_rwtraining_delete->tempat->caption() ?></span></th>
<?php } ?>
<?php if ($t_rwtraining_delete->tahun->Visible) { // tahun ?>
		<th class="<?php echo $t_rwtraining_delete->tahun->headerCellClass() ?>"><span id="elh_t_rwtraining_tahun" class="t_rwtraining_tahun"><?php echo $t_rwtraining_delete->tahun->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_rwtraining_delete->RecordCount = 0;
$i = 0;
while (!$t_rwtraining_delete->Recordset->EOF) {
	$t_rwtraining_delete->RecordCount++;
	$t_rwtraining_delete->RowCount++;

	// Set row properties
	$t_rwtraining->resetAttributes();
	$t_rwtraining->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_rwtraining_delete->loadRowValues($t_rwtraining_delete->Recordset);

	// Render row
	$t_rwtraining_delete->renderRow();
?>
	<tr <?php echo $t_rwtraining->rowAttributes() ?>>
<?php if ($t_rwtraining_delete->rwtrainingid->Visible) { // rwtrainingid ?>
		<td <?php echo $t_rwtraining_delete->rwtrainingid->cellAttributes() ?>>
<span id="el<?php echo $t_rwtraining_delete->RowCount ?>_t_rwtraining_rwtrainingid" class="t_rwtraining_rwtrainingid">
<span<?php echo $t_rwtraining_delete->rwtrainingid->viewAttributes() ?>><?php echo $t_rwtraining_delete->rwtrainingid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rwtraining_delete->bioid->Visible) { // bioid ?>
		<td <?php echo $t_rwtraining_delete->bioid->cellAttributes() ?>>
<span id="el<?php echo $t_rwtraining_delete->RowCount ?>_t_rwtraining_bioid" class="t_rwtraining_bioid">
<span<?php echo $t_rwtraining_delete->bioid->viewAttributes() ?>><?php echo $t_rwtraining_delete->bioid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rwtraining_delete->training->Visible) { // training ?>
		<td <?php echo $t_rwtraining_delete->training->cellAttributes() ?>>
<span id="el<?php echo $t_rwtraining_delete->RowCount ?>_t_rwtraining_training" class="t_rwtraining_training">
<span<?php echo $t_rwtraining_delete->training->viewAttributes() ?>><?php echo $t_rwtraining_delete->training->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rwtraining_delete->tempat->Visible) { // tempat ?>
		<td <?php echo $t_rwtraining_delete->tempat->cellAttributes() ?>>
<span id="el<?php echo $t_rwtraining_delete->RowCount ?>_t_rwtraining_tempat" class="t_rwtraining_tempat">
<span<?php echo $t_rwtraining_delete->tempat->viewAttributes() ?>><?php echo $t_rwtraining_delete->tempat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rwtraining_delete->tahun->Visible) { // tahun ?>
		<td <?php echo $t_rwtraining_delete->tahun->cellAttributes() ?>>
<span id="el<?php echo $t_rwtraining_delete->RowCount ?>_t_rwtraining_tahun" class="t_rwtraining_tahun">
<span<?php echo $t_rwtraining_delete->tahun->viewAttributes() ?>><?php echo $t_rwtraining_delete->tahun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_rwtraining_delete->Recordset->moveNext();
}
$t_rwtraining_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_rwtraining_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_rwtraining_delete->showPageFooter();
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
$t_rwtraining_delete->terminate();
?>