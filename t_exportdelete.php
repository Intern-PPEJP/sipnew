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
$t_export_delete = new t_export_delete();

// Run the page
$t_export_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_export_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_exportdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_exportdelete = currentForm = new ew.Form("ft_exportdelete", "delete");
	loadjs.done("ft_exportdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_export_delete->showPageHeader(); ?>
<?php
$t_export_delete->showMessage();
?>
<form name="ft_exportdelete" id="ft_exportdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_export">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_export_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_export_delete->kdexport->Visible) { // kdexport ?>
		<th class="<?php echo $t_export_delete->kdexport->headerCellClass() ?>"><span id="elh_t_export_kdexport" class="t_export_kdexport"><?php echo $t_export_delete->kdexport->caption() ?></span></th>
<?php } ?>
<?php if ($t_export_delete->_export->Visible) { // export ?>
		<th class="<?php echo $t_export_delete->_export->headerCellClass() ?>"><span id="elh_t_export__export" class="t_export__export"><?php echo $t_export_delete->_export->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_export_delete->RecordCount = 0;
$i = 0;
while (!$t_export_delete->Recordset->EOF) {
	$t_export_delete->RecordCount++;
	$t_export_delete->RowCount++;

	// Set row properties
	$t_export->resetAttributes();
	$t_export->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_export_delete->loadRowValues($t_export_delete->Recordset);

	// Render row
	$t_export_delete->renderRow();
?>
	<tr <?php echo $t_export->rowAttributes() ?>>
<?php if ($t_export_delete->kdexport->Visible) { // kdexport ?>
		<td <?php echo $t_export_delete->kdexport->cellAttributes() ?>>
<span id="el<?php echo $t_export_delete->RowCount ?>_t_export_kdexport" class="t_export_kdexport">
<span<?php echo $t_export_delete->kdexport->viewAttributes() ?>><?php echo $t_export_delete->kdexport->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_export_delete->_export->Visible) { // export ?>
		<td <?php echo $t_export_delete->_export->cellAttributes() ?>>
<span id="el<?php echo $t_export_delete->RowCount ?>_t_export__export" class="t_export__export">
<span<?php echo $t_export_delete->_export->viewAttributes() ?>><?php echo $t_export_delete->_export->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_export_delete->Recordset->moveNext();
}
$t_export_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_export_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_export_delete->showPageFooter();
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
$t_export_delete->terminate();
?>