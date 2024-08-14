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
$t_negara_delete = new t_negara_delete();

// Run the page
$t_negara_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_negara_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_negaradelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_negaradelete = currentForm = new ew.Form("ft_negaradelete", "delete");
	loadjs.done("ft_negaradelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_negara_delete->showPageHeader(); ?>
<?php
$t_negara_delete->showMessage();
?>
<form name="ft_negaradelete" id="ft_negaradelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_negara">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_negara_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_negara_delete->kdnegara->Visible) { // kdnegara ?>
		<th class="<?php echo $t_negara_delete->kdnegara->headerCellClass() ?>"><span id="elh_t_negara_kdnegara" class="t_negara_kdnegara"><?php echo $t_negara_delete->kdnegara->caption() ?></span></th>
<?php } ?>
<?php if ($t_negara_delete->negara->Visible) { // negara ?>
		<th class="<?php echo $t_negara_delete->negara->headerCellClass() ?>"><span id="elh_t_negara_negara" class="t_negara_negara"><?php echo $t_negara_delete->negara->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_negara_delete->RecordCount = 0;
$i = 0;
while (!$t_negara_delete->Recordset->EOF) {
	$t_negara_delete->RecordCount++;
	$t_negara_delete->RowCount++;

	// Set row properties
	$t_negara->resetAttributes();
	$t_negara->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_negara_delete->loadRowValues($t_negara_delete->Recordset);

	// Render row
	$t_negara_delete->renderRow();
?>
	<tr <?php echo $t_negara->rowAttributes() ?>>
<?php if ($t_negara_delete->kdnegara->Visible) { // kdnegara ?>
		<td <?php echo $t_negara_delete->kdnegara->cellAttributes() ?>>
<span id="el<?php echo $t_negara_delete->RowCount ?>_t_negara_kdnegara" class="t_negara_kdnegara">
<span<?php echo $t_negara_delete->kdnegara->viewAttributes() ?>><?php echo $t_negara_delete->kdnegara->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_negara_delete->negara->Visible) { // negara ?>
		<td <?php echo $t_negara_delete->negara->cellAttributes() ?>>
<span id="el<?php echo $t_negara_delete->RowCount ?>_t_negara_negara" class="t_negara_negara">
<span<?php echo $t_negara_delete->negara->viewAttributes() ?>><?php echo $t_negara_delete->negara->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_negara_delete->Recordset->moveNext();
}
$t_negara_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_negara_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_negara_delete->showPageFooter();
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
$t_negara_delete->terminate();
?>