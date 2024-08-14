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
$t_jenis_delete = new t_jenis_delete();

// Run the page
$t_jenis_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_jenis_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_jenisdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_jenisdelete = currentForm = new ew.Form("ft_jenisdelete", "delete");
	loadjs.done("ft_jenisdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_jenis_delete->showPageHeader(); ?>
<?php
$t_jenis_delete->showMessage();
?>
<form name="ft_jenisdelete" id="ft_jenisdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_jenis">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_jenis_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_jenis_delete->kdjenis->Visible) { // kdjenis ?>
		<th class="<?php echo $t_jenis_delete->kdjenis->headerCellClass() ?>"><span id="elh_t_jenis_kdjenis" class="t_jenis_kdjenis"><?php echo $t_jenis_delete->kdjenis->caption() ?></span></th>
<?php } ?>
<?php if ($t_jenis_delete->jenis->Visible) { // jenis ?>
		<th class="<?php echo $t_jenis_delete->jenis->headerCellClass() ?>"><span id="elh_t_jenis_jenis" class="t_jenis_jenis"><?php echo $t_jenis_delete->jenis->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_jenis_delete->RecordCount = 0;
$i = 0;
while (!$t_jenis_delete->Recordset->EOF) {
	$t_jenis_delete->RecordCount++;
	$t_jenis_delete->RowCount++;

	// Set row properties
	$t_jenis->resetAttributes();
	$t_jenis->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_jenis_delete->loadRowValues($t_jenis_delete->Recordset);

	// Render row
	$t_jenis_delete->renderRow();
?>
	<tr <?php echo $t_jenis->rowAttributes() ?>>
<?php if ($t_jenis_delete->kdjenis->Visible) { // kdjenis ?>
		<td <?php echo $t_jenis_delete->kdjenis->cellAttributes() ?>>
<span id="el<?php echo $t_jenis_delete->RowCount ?>_t_jenis_kdjenis" class="t_jenis_kdjenis">
<span<?php echo $t_jenis_delete->kdjenis->viewAttributes() ?>><?php echo $t_jenis_delete->kdjenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jenis_delete->jenis->Visible) { // jenis ?>
		<td <?php echo $t_jenis_delete->jenis->cellAttributes() ?>>
<span id="el<?php echo $t_jenis_delete->RowCount ?>_t_jenis_jenis" class="t_jenis_jenis">
<span<?php echo $t_jenis_delete->jenis->viewAttributes() ?>><?php echo $t_jenis_delete->jenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_jenis_delete->Recordset->moveNext();
}
$t_jenis_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_jenis_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_jenis_delete->showPageFooter();
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
$t_jenis_delete->terminate();
?>