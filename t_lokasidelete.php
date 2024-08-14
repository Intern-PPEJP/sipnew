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
$t_lokasi_delete = new t_lokasi_delete();

// Run the page
$t_lokasi_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_lokasi_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_lokasidelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_lokasidelete = currentForm = new ew.Form("ft_lokasidelete", "delete");
	loadjs.done("ft_lokasidelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_lokasi_delete->showPageHeader(); ?>
<?php
$t_lokasi_delete->showMessage();
?>
<form name="ft_lokasidelete" id="ft_lokasidelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_lokasi">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_lokasi_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_lokasi_delete->kdlokasi->Visible) { // kdlokasi ?>
		<th class="<?php echo $t_lokasi_delete->kdlokasi->headerCellClass() ?>"><span id="elh_t_lokasi_kdlokasi" class="t_lokasi_kdlokasi"><?php echo $t_lokasi_delete->kdlokasi->caption() ?></span></th>
<?php } ?>
<?php if ($t_lokasi_delete->lokasi->Visible) { // lokasi ?>
		<th class="<?php echo $t_lokasi_delete->lokasi->headerCellClass() ?>"><span id="elh_t_lokasi_lokasi" class="t_lokasi_lokasi"><?php echo $t_lokasi_delete->lokasi->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_lokasi_delete->RecordCount = 0;
$i = 0;
while (!$t_lokasi_delete->Recordset->EOF) {
	$t_lokasi_delete->RecordCount++;
	$t_lokasi_delete->RowCount++;

	// Set row properties
	$t_lokasi->resetAttributes();
	$t_lokasi->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_lokasi_delete->loadRowValues($t_lokasi_delete->Recordset);

	// Render row
	$t_lokasi_delete->renderRow();
?>
	<tr <?php echo $t_lokasi->rowAttributes() ?>>
<?php if ($t_lokasi_delete->kdlokasi->Visible) { // kdlokasi ?>
		<td <?php echo $t_lokasi_delete->kdlokasi->cellAttributes() ?>>
<span id="el<?php echo $t_lokasi_delete->RowCount ?>_t_lokasi_kdlokasi" class="t_lokasi_kdlokasi">
<span<?php echo $t_lokasi_delete->kdlokasi->viewAttributes() ?>><?php echo $t_lokasi_delete->kdlokasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_lokasi_delete->lokasi->Visible) { // lokasi ?>
		<td <?php echo $t_lokasi_delete->lokasi->cellAttributes() ?>>
<span id="el<?php echo $t_lokasi_delete->RowCount ?>_t_lokasi_lokasi" class="t_lokasi_lokasi">
<span<?php echo $t_lokasi_delete->lokasi->viewAttributes() ?>><?php echo $t_lokasi_delete->lokasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_lokasi_delete->Recordset->moveNext();
}
$t_lokasi_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_lokasi_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_lokasi_delete->showPageFooter();
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
$t_lokasi_delete->terminate();
?>