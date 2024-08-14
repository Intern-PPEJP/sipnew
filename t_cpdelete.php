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
$t_cp_delete = new t_cp_delete();

// Run the page
$t_cp_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_cp_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_cpdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_cpdelete = currentForm = new ew.Form("ft_cpdelete", "delete");
	loadjs.done("ft_cpdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_cp_delete->showPageHeader(); ?>
<?php
$t_cp_delete->showMessage();
?>
<form name="ft_cpdelete" id="ft_cpdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_cp">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_cp_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_cp_delete->namap->Visible) { // namap ?>
		<th class="<?php echo $t_cp_delete->namap->headerCellClass() ?>"><span id="elh_t_cp_namap" class="t_cp_namap"><?php echo $t_cp_delete->namap->caption() ?></span></th>
<?php } ?>
<?php if ($t_cp_delete->cp1->Visible) { // cp1 ?>
		<th class="<?php echo $t_cp_delete->cp1->headerCellClass() ?>"><span id="elh_t_cp_cp1" class="t_cp_cp1"><?php echo $t_cp_delete->cp1->caption() ?></span></th>
<?php } ?>
<?php if ($t_cp_delete->cp2->Visible) { // cp2 ?>
		<th class="<?php echo $t_cp_delete->cp2->headerCellClass() ?>"><span id="elh_t_cp_cp2" class="t_cp_cp2"><?php echo $t_cp_delete->cp2->caption() ?></span></th>
<?php } ?>
<?php if ($t_cp_delete->cp3->Visible) { // cp3 ?>
		<th class="<?php echo $t_cp_delete->cp3->headerCellClass() ?>"><span id="elh_t_cp_cp3" class="t_cp_cp3"><?php echo $t_cp_delete->cp3->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_cp_delete->RecordCount = 0;
$i = 0;
while (!$t_cp_delete->Recordset->EOF) {
	$t_cp_delete->RecordCount++;
	$t_cp_delete->RowCount++;

	// Set row properties
	$t_cp->resetAttributes();
	$t_cp->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_cp_delete->loadRowValues($t_cp_delete->Recordset);

	// Render row
	$t_cp_delete->renderRow();
?>
	<tr <?php echo $t_cp->rowAttributes() ?>>
<?php if ($t_cp_delete->namap->Visible) { // namap ?>
		<td <?php echo $t_cp_delete->namap->cellAttributes() ?>>
<span id="el<?php echo $t_cp_delete->RowCount ?>_t_cp_namap" class="t_cp_namap">
<span<?php echo $t_cp_delete->namap->viewAttributes() ?>><?php echo $t_cp_delete->namap->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_cp_delete->cp1->Visible) { // cp1 ?>
		<td <?php echo $t_cp_delete->cp1->cellAttributes() ?>>
<span id="el<?php echo $t_cp_delete->RowCount ?>_t_cp_cp1" class="t_cp_cp1">
<span<?php echo $t_cp_delete->cp1->viewAttributes() ?>><?php echo $t_cp_delete->cp1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_cp_delete->cp2->Visible) { // cp2 ?>
		<td <?php echo $t_cp_delete->cp2->cellAttributes() ?>>
<span id="el<?php echo $t_cp_delete->RowCount ?>_t_cp_cp2" class="t_cp_cp2">
<span<?php echo $t_cp_delete->cp2->viewAttributes() ?>><?php echo $t_cp_delete->cp2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_cp_delete->cp3->Visible) { // cp3 ?>
		<td <?php echo $t_cp_delete->cp3->cellAttributes() ?>>
<span id="el<?php echo $t_cp_delete->RowCount ?>_t_cp_cp3" class="t_cp_cp3">
<span<?php echo $t_cp_delete->cp3->viewAttributes() ?>><?php echo $t_cp_delete->cp3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_cp_delete->Recordset->moveNext();
}
$t_cp_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_cp_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_cp_delete->showPageFooter();
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
$t_cp_delete->terminate();
?>