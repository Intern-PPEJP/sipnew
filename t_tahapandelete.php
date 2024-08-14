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
$t_tahapan_delete = new t_tahapan_delete();

// Run the page
$t_tahapan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_tahapan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_tahapandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_tahapandelete = currentForm = new ew.Form("ft_tahapandelete", "delete");
	loadjs.done("ft_tahapandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_tahapan_delete->showPageHeader(); ?>
<?php
$t_tahapan_delete->showMessage();
?>
<form name="ft_tahapandelete" id="ft_tahapandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_tahapan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_tahapan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_tahapan_delete->kdtahapan->Visible) { // kdtahapan ?>
		<th class="<?php echo $t_tahapan_delete->kdtahapan->headerCellClass() ?>"><span id="elh_t_tahapan_kdtahapan" class="t_tahapan_kdtahapan"><?php echo $t_tahapan_delete->kdtahapan->caption() ?></span></th>
<?php } ?>
<?php if ($t_tahapan_delete->Tahapan->Visible) { // Tahapan ?>
		<th class="<?php echo $t_tahapan_delete->Tahapan->headerCellClass() ?>"><span id="elh_t_tahapan_Tahapan" class="t_tahapan_Tahapan"><?php echo $t_tahapan_delete->Tahapan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_tahapan_delete->RecordCount = 0;
$i = 0;
while (!$t_tahapan_delete->Recordset->EOF) {
	$t_tahapan_delete->RecordCount++;
	$t_tahapan_delete->RowCount++;

	// Set row properties
	$t_tahapan->resetAttributes();
	$t_tahapan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_tahapan_delete->loadRowValues($t_tahapan_delete->Recordset);

	// Render row
	$t_tahapan_delete->renderRow();
?>
	<tr <?php echo $t_tahapan->rowAttributes() ?>>
<?php if ($t_tahapan_delete->kdtahapan->Visible) { // kdtahapan ?>
		<td <?php echo $t_tahapan_delete->kdtahapan->cellAttributes() ?>>
<span id="el<?php echo $t_tahapan_delete->RowCount ?>_t_tahapan_kdtahapan" class="t_tahapan_kdtahapan">
<span<?php echo $t_tahapan_delete->kdtahapan->viewAttributes() ?>><?php echo $t_tahapan_delete->kdtahapan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_tahapan_delete->Tahapan->Visible) { // Tahapan ?>
		<td <?php echo $t_tahapan_delete->Tahapan->cellAttributes() ?>>
<span id="el<?php echo $t_tahapan_delete->RowCount ?>_t_tahapan_Tahapan" class="t_tahapan_Tahapan">
<span<?php echo $t_tahapan_delete->Tahapan->viewAttributes() ?>><?php echo $t_tahapan_delete->Tahapan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_tahapan_delete->Recordset->moveNext();
}
$t_tahapan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_tahapan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_tahapan_delete->showPageFooter();
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
$t_tahapan_delete->terminate();
?>