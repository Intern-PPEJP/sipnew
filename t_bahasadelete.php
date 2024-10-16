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
$t_bahasa_delete = new t_bahasa_delete();

// Run the page
$t_bahasa_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_bahasa_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_bahasadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_bahasadelete = currentForm = new ew.Form("ft_bahasadelete", "delete");
	loadjs.done("ft_bahasadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_bahasa_delete->showPageHeader(); ?>
<?php
$t_bahasa_delete->showMessage();
?>
<form name="ft_bahasadelete" id="ft_bahasadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_bahasa">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_bahasa_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_bahasa_delete->kdbahasa->Visible) { // kdbahasa ?>
		<th class="<?php echo $t_bahasa_delete->kdbahasa->headerCellClass() ?>"><span id="elh_t_bahasa_kdbahasa" class="t_bahasa_kdbahasa"><?php echo $t_bahasa_delete->kdbahasa->caption() ?></span></th>
<?php } ?>
<?php if ($t_bahasa_delete->bahasa->Visible) { // bahasa ?>
		<th class="<?php echo $t_bahasa_delete->bahasa->headerCellClass() ?>"><span id="elh_t_bahasa_bahasa" class="t_bahasa_bahasa"><?php echo $t_bahasa_delete->bahasa->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_bahasa_delete->RecordCount = 0;
$i = 0;
while (!$t_bahasa_delete->Recordset->EOF) {
	$t_bahasa_delete->RecordCount++;
	$t_bahasa_delete->RowCount++;

	// Set row properties
	$t_bahasa->resetAttributes();
	$t_bahasa->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_bahasa_delete->loadRowValues($t_bahasa_delete->Recordset);

	// Render row
	$t_bahasa_delete->renderRow();
?>
	<tr <?php echo $t_bahasa->rowAttributes() ?>>
<?php if ($t_bahasa_delete->kdbahasa->Visible) { // kdbahasa ?>
		<td <?php echo $t_bahasa_delete->kdbahasa->cellAttributes() ?>>
<span id="el<?php echo $t_bahasa_delete->RowCount ?>_t_bahasa_kdbahasa" class="t_bahasa_kdbahasa">
<span<?php echo $t_bahasa_delete->kdbahasa->viewAttributes() ?>><?php echo $t_bahasa_delete->kdbahasa->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_bahasa_delete->bahasa->Visible) { // bahasa ?>
		<td <?php echo $t_bahasa_delete->bahasa->cellAttributes() ?>>
<span id="el<?php echo $t_bahasa_delete->RowCount ?>_t_bahasa_bahasa" class="t_bahasa_bahasa">
<span<?php echo $t_bahasa_delete->bahasa->viewAttributes() ?>><?php echo $t_bahasa_delete->bahasa->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_bahasa_delete->Recordset->moveNext();
}
$t_bahasa_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_bahasa_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_bahasa_delete->showPageFooter();
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
$t_bahasa_delete->terminate();
?>