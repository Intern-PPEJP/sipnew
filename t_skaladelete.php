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
$t_skala_delete = new t_skala_delete();

// Run the page
$t_skala_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_skala_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_skaladelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_skaladelete = currentForm = new ew.Form("ft_skaladelete", "delete");
	loadjs.done("ft_skaladelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_skala_delete->showPageHeader(); ?>
<?php
$t_skala_delete->showMessage();
?>
<form name="ft_skaladelete" id="ft_skaladelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_skala">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_skala_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_skala_delete->kdskala->Visible) { // kdskala ?>
		<th class="<?php echo $t_skala_delete->kdskala->headerCellClass() ?>"><span id="elh_t_skala_kdskala" class="t_skala_kdskala"><?php echo $t_skala_delete->kdskala->caption() ?></span></th>
<?php } ?>
<?php if ($t_skala_delete->skala->Visible) { // skala ?>
		<th class="<?php echo $t_skala_delete->skala->headerCellClass() ?>"><span id="elh_t_skala_skala" class="t_skala_skala"><?php echo $t_skala_delete->skala->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_skala_delete->RecordCount = 0;
$i = 0;
while (!$t_skala_delete->Recordset->EOF) {
	$t_skala_delete->RecordCount++;
	$t_skala_delete->RowCount++;

	// Set row properties
	$t_skala->resetAttributes();
	$t_skala->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_skala_delete->loadRowValues($t_skala_delete->Recordset);

	// Render row
	$t_skala_delete->renderRow();
?>
	<tr <?php echo $t_skala->rowAttributes() ?>>
<?php if ($t_skala_delete->kdskala->Visible) { // kdskala ?>
		<td <?php echo $t_skala_delete->kdskala->cellAttributes() ?>>
<span id="el<?php echo $t_skala_delete->RowCount ?>_t_skala_kdskala" class="t_skala_kdskala">
<span<?php echo $t_skala_delete->kdskala->viewAttributes() ?>><?php echo $t_skala_delete->kdskala->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_skala_delete->skala->Visible) { // skala ?>
		<td <?php echo $t_skala_delete->skala->cellAttributes() ?>>
<span id="el<?php echo $t_skala_delete->RowCount ?>_t_skala_skala" class="t_skala_skala">
<span<?php echo $t_skala_delete->skala->viewAttributes() ?>><?php echo $t_skala_delete->skala->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_skala_delete->Recordset->moveNext();
}
$t_skala_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_skala_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_skala_delete->showPageFooter();
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
$t_skala_delete->terminate();
?>