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
$t_agama_delete = new t_agama_delete();

// Run the page
$t_agama_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_agama_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_agamadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_agamadelete = currentForm = new ew.Form("ft_agamadelete", "delete");
	loadjs.done("ft_agamadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_agama_delete->showPageHeader(); ?>
<?php
$t_agama_delete->showMessage();
?>
<form name="ft_agamadelete" id="ft_agamadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_agama">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_agama_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_agama_delete->kdagama->Visible) { // kdagama ?>
		<th class="<?php echo $t_agama_delete->kdagama->headerCellClass() ?>"><span id="elh_t_agama_kdagama" class="t_agama_kdagama"><?php echo $t_agama_delete->kdagama->caption() ?></span></th>
<?php } ?>
<?php if ($t_agama_delete->agama->Visible) { // agama ?>
		<th class="<?php echo $t_agama_delete->agama->headerCellClass() ?>"><span id="elh_t_agama_agama" class="t_agama_agama"><?php echo $t_agama_delete->agama->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_agama_delete->RecordCount = 0;
$i = 0;
while (!$t_agama_delete->Recordset->EOF) {
	$t_agama_delete->RecordCount++;
	$t_agama_delete->RowCount++;

	// Set row properties
	$t_agama->resetAttributes();
	$t_agama->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_agama_delete->loadRowValues($t_agama_delete->Recordset);

	// Render row
	$t_agama_delete->renderRow();
?>
	<tr <?php echo $t_agama->rowAttributes() ?>>
<?php if ($t_agama_delete->kdagama->Visible) { // kdagama ?>
		<td <?php echo $t_agama_delete->kdagama->cellAttributes() ?>>
<span id="el<?php echo $t_agama_delete->RowCount ?>_t_agama_kdagama" class="t_agama_kdagama">
<span<?php echo $t_agama_delete->kdagama->viewAttributes() ?>><?php echo $t_agama_delete->kdagama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_agama_delete->agama->Visible) { // agama ?>
		<td <?php echo $t_agama_delete->agama->cellAttributes() ?>>
<span id="el<?php echo $t_agama_delete->RowCount ?>_t_agama_agama" class="t_agama_agama">
<span<?php echo $t_agama_delete->agama->viewAttributes() ?>><?php echo $t_agama_delete->agama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_agama_delete->Recordset->moveNext();
}
$t_agama_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_agama_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_agama_delete->showPageFooter();
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
$t_agama_delete->terminate();
?>