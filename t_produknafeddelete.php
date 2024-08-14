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
$t_produknafed_delete = new t_produknafed_delete();

// Run the page
$t_produknafed_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_produknafed_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_produknafeddelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_produknafeddelete = currentForm = new ew.Form("ft_produknafeddelete", "delete");
	loadjs.done("ft_produknafeddelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_produknafed_delete->showPageHeader(); ?>
<?php
$t_produknafed_delete->showMessage();
?>
<form name="ft_produknafeddelete" id="ft_produknafeddelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_produknafed">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_produknafed_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_produknafed_delete->kdproduknafed->Visible) { // kdproduknafed ?>
		<th class="<?php echo $t_produknafed_delete->kdproduknafed->headerCellClass() ?>"><span id="elh_t_produknafed_kdproduknafed" class="t_produknafed_kdproduknafed"><?php echo $t_produknafed_delete->kdproduknafed->caption() ?></span></th>
<?php } ?>
<?php if ($t_produknafed_delete->produknafed->Visible) { // produknafed ?>
		<th class="<?php echo $t_produknafed_delete->produknafed->headerCellClass() ?>"><span id="elh_t_produknafed_produknafed" class="t_produknafed_produknafed"><?php echo $t_produknafed_delete->produknafed->caption() ?></span></th>
<?php } ?>
<?php if ($t_produknafed_delete->produknafedid->Visible) { // produknafedid ?>
		<th class="<?php echo $t_produknafed_delete->produknafedid->headerCellClass() ?>"><span id="elh_t_produknafed_produknafedid" class="t_produknafed_produknafedid"><?php echo $t_produknafed_delete->produknafedid->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_produknafed_delete->RecordCount = 0;
$i = 0;
while (!$t_produknafed_delete->Recordset->EOF) {
	$t_produknafed_delete->RecordCount++;
	$t_produknafed_delete->RowCount++;

	// Set row properties
	$t_produknafed->resetAttributes();
	$t_produknafed->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_produknafed_delete->loadRowValues($t_produknafed_delete->Recordset);

	// Render row
	$t_produknafed_delete->renderRow();
?>
	<tr <?php echo $t_produknafed->rowAttributes() ?>>
<?php if ($t_produknafed_delete->kdproduknafed->Visible) { // kdproduknafed ?>
		<td <?php echo $t_produknafed_delete->kdproduknafed->cellAttributes() ?>>
<span id="el<?php echo $t_produknafed_delete->RowCount ?>_t_produknafed_kdproduknafed" class="t_produknafed_kdproduknafed">
<span<?php echo $t_produknafed_delete->kdproduknafed->viewAttributes() ?>><?php echo $t_produknafed_delete->kdproduknafed->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_produknafed_delete->produknafed->Visible) { // produknafed ?>
		<td <?php echo $t_produknafed_delete->produknafed->cellAttributes() ?>>
<span id="el<?php echo $t_produknafed_delete->RowCount ?>_t_produknafed_produknafed" class="t_produknafed_produknafed">
<span<?php echo $t_produknafed_delete->produknafed->viewAttributes() ?>><?php echo $t_produknafed_delete->produknafed->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_produknafed_delete->produknafedid->Visible) { // produknafedid ?>
		<td <?php echo $t_produknafed_delete->produknafedid->cellAttributes() ?>>
<span id="el<?php echo $t_produknafed_delete->RowCount ?>_t_produknafed_produknafedid" class="t_produknafed_produknafedid">
<span<?php echo $t_produknafed_delete->produknafedid->viewAttributes() ?>><?php echo $t_produknafed_delete->produknafedid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_produknafed_delete->Recordset->moveNext();
}
$t_produknafed_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_produknafed_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_produknafed_delete->showPageFooter();
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
$t_produknafed_delete->terminate();
?>