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
$t_bagian_delete = new t_bagian_delete();

// Run the page
$t_bagian_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_bagian_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_bagiandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_bagiandelete = currentForm = new ew.Form("ft_bagiandelete", "delete");
	loadjs.done("ft_bagiandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_bagian_delete->showPageHeader(); ?>
<?php
$t_bagian_delete->showMessage();
?>
<form name="ft_bagiandelete" id="ft_bagiandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_bagian">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_bagian_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_bagian_delete->kdbagian->Visible) { // kdbagian ?>
		<th class="<?php echo $t_bagian_delete->kdbagian->headerCellClass() ?>"><span id="elh_t_bagian_kdbagian" class="t_bagian_kdbagian"><?php echo $t_bagian_delete->kdbagian->caption() ?></span></th>
<?php } ?>
<?php if ($t_bagian_delete->namabagian->Visible) { // namabagian ?>
		<th class="<?php echo $t_bagian_delete->namabagian->headerCellClass() ?>"><span id="elh_t_bagian_namabagian" class="t_bagian_namabagian"><?php echo $t_bagian_delete->namabagian->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_bagian_delete->RecordCount = 0;
$i = 0;
while (!$t_bagian_delete->Recordset->EOF) {
	$t_bagian_delete->RecordCount++;
	$t_bagian_delete->RowCount++;

	// Set row properties
	$t_bagian->resetAttributes();
	$t_bagian->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_bagian_delete->loadRowValues($t_bagian_delete->Recordset);

	// Render row
	$t_bagian_delete->renderRow();
?>
	<tr <?php echo $t_bagian->rowAttributes() ?>>
<?php if ($t_bagian_delete->kdbagian->Visible) { // kdbagian ?>
		<td <?php echo $t_bagian_delete->kdbagian->cellAttributes() ?>>
<span id="el<?php echo $t_bagian_delete->RowCount ?>_t_bagian_kdbagian" class="t_bagian_kdbagian">
<span<?php echo $t_bagian_delete->kdbagian->viewAttributes() ?>><?php echo $t_bagian_delete->kdbagian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_bagian_delete->namabagian->Visible) { // namabagian ?>
		<td <?php echo $t_bagian_delete->namabagian->cellAttributes() ?>>
<span id="el<?php echo $t_bagian_delete->RowCount ?>_t_bagian_namabagian" class="t_bagian_namabagian">
<span<?php echo $t_bagian_delete->namabagian->viewAttributes() ?>><?php echo $t_bagian_delete->namabagian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_bagian_delete->Recordset->moveNext();
}
$t_bagian_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_bagian_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_bagian_delete->showPageFooter();
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
$t_bagian_delete->terminate();
?>