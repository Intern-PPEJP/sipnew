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
$t_pendidikan_delete = new t_pendidikan_delete();

// Run the page
$t_pendidikan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pendidikan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_pendidikandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_pendidikandelete = currentForm = new ew.Form("ft_pendidikandelete", "delete");
	loadjs.done("ft_pendidikandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_pendidikan_delete->showPageHeader(); ?>
<?php
$t_pendidikan_delete->showMessage();
?>
<form name="ft_pendidikandelete" id="ft_pendidikandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_pendidikan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_pendidikan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_pendidikan_delete->kdpend->Visible) { // kdpend ?>
		<th class="<?php echo $t_pendidikan_delete->kdpend->headerCellClass() ?>"><span id="elh_t_pendidikan_kdpend" class="t_pendidikan_kdpend"><?php echo $t_pendidikan_delete->kdpend->caption() ?></span></th>
<?php } ?>
<?php if ($t_pendidikan_delete->pendidikan->Visible) { // pendidikan ?>
		<th class="<?php echo $t_pendidikan_delete->pendidikan->headerCellClass() ?>"><span id="elh_t_pendidikan_pendidikan" class="t_pendidikan_pendidikan"><?php echo $t_pendidikan_delete->pendidikan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_pendidikan_delete->RecordCount = 0;
$i = 0;
while (!$t_pendidikan_delete->Recordset->EOF) {
	$t_pendidikan_delete->RecordCount++;
	$t_pendidikan_delete->RowCount++;

	// Set row properties
	$t_pendidikan->resetAttributes();
	$t_pendidikan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_pendidikan_delete->loadRowValues($t_pendidikan_delete->Recordset);

	// Render row
	$t_pendidikan_delete->renderRow();
?>
	<tr <?php echo $t_pendidikan->rowAttributes() ?>>
<?php if ($t_pendidikan_delete->kdpend->Visible) { // kdpend ?>
		<td <?php echo $t_pendidikan_delete->kdpend->cellAttributes() ?>>
<span id="el<?php echo $t_pendidikan_delete->RowCount ?>_t_pendidikan_kdpend" class="t_pendidikan_kdpend">
<span<?php echo $t_pendidikan_delete->kdpend->viewAttributes() ?>><?php echo $t_pendidikan_delete->kdpend->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pendidikan_delete->pendidikan->Visible) { // pendidikan ?>
		<td <?php echo $t_pendidikan_delete->pendidikan->cellAttributes() ?>>
<span id="el<?php echo $t_pendidikan_delete->RowCount ?>_t_pendidikan_pendidikan" class="t_pendidikan_pendidikan">
<span<?php echo $t_pendidikan_delete->pendidikan->viewAttributes() ?>><?php echo $t_pendidikan_delete->pendidikan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_pendidikan_delete->Recordset->moveNext();
}
$t_pendidikan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_pendidikan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_pendidikan_delete->showPageFooter();
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
$t_pendidikan_delete->terminate();
?>