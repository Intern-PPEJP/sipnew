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
$t_jabatan_delete = new t_jabatan_delete();

// Run the page
$t_jabatan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_jabatan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_jabatandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_jabatandelete = currentForm = new ew.Form("ft_jabatandelete", "delete");
	loadjs.done("ft_jabatandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_jabatan_delete->showPageHeader(); ?>
<?php
$t_jabatan_delete->showMessage();
?>
<form name="ft_jabatandelete" id="ft_jabatandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_jabatan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_jabatan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_jabatan_delete->kdjabat->Visible) { // kdjabat ?>
		<th class="<?php echo $t_jabatan_delete->kdjabat->headerCellClass() ?>"><span id="elh_t_jabatan_kdjabat" class="t_jabatan_kdjabat"><?php echo $t_jabatan_delete->kdjabat->caption() ?></span></th>
<?php } ?>
<?php if ($t_jabatan_delete->jabatan->Visible) { // jabatan ?>
		<th class="<?php echo $t_jabatan_delete->jabatan->headerCellClass() ?>"><span id="elh_t_jabatan_jabatan" class="t_jabatan_jabatan"><?php echo $t_jabatan_delete->jabatan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_jabatan_delete->RecordCount = 0;
$i = 0;
while (!$t_jabatan_delete->Recordset->EOF) {
	$t_jabatan_delete->RecordCount++;
	$t_jabatan_delete->RowCount++;

	// Set row properties
	$t_jabatan->resetAttributes();
	$t_jabatan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_jabatan_delete->loadRowValues($t_jabatan_delete->Recordset);

	// Render row
	$t_jabatan_delete->renderRow();
?>
	<tr <?php echo $t_jabatan->rowAttributes() ?>>
<?php if ($t_jabatan_delete->kdjabat->Visible) { // kdjabat ?>
		<td <?php echo $t_jabatan_delete->kdjabat->cellAttributes() ?>>
<span id="el<?php echo $t_jabatan_delete->RowCount ?>_t_jabatan_kdjabat" class="t_jabatan_kdjabat">
<span<?php echo $t_jabatan_delete->kdjabat->viewAttributes() ?>><?php echo $t_jabatan_delete->kdjabat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jabatan_delete->jabatan->Visible) { // jabatan ?>
		<td <?php echo $t_jabatan_delete->jabatan->cellAttributes() ?>>
<span id="el<?php echo $t_jabatan_delete->RowCount ?>_t_jabatan_jabatan" class="t_jabatan_jabatan">
<span<?php echo $t_jabatan_delete->jabatan->viewAttributes() ?>><?php echo $t_jabatan_delete->jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_jabatan_delete->Recordset->moveNext();
}
$t_jabatan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_jabatan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_jabatan_delete->showPageFooter();
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
$t_jabatan_delete->terminate();
?>