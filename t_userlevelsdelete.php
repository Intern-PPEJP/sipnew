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
$t_userlevels_delete = new t_userlevels_delete();

// Run the page
$t_userlevels_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_userlevels_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_userlevelsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_userlevelsdelete = currentForm = new ew.Form("ft_userlevelsdelete", "delete");
	loadjs.done("ft_userlevelsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_userlevels_delete->showPageHeader(); ?>
<?php
$t_userlevels_delete->showMessage();
?>
<form name="ft_userlevelsdelete" id="ft_userlevelsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_userlevels">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_userlevels_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_userlevels_delete->user_level_id->Visible) { // user_level_id ?>
		<th class="<?php echo $t_userlevels_delete->user_level_id->headerCellClass() ?>"><span id="elh_t_userlevels_user_level_id" class="t_userlevels_user_level_id"><?php echo $t_userlevels_delete->user_level_id->caption() ?></span></th>
<?php } ?>
<?php if ($t_userlevels_delete->user_level_name->Visible) { // user_level_name ?>
		<th class="<?php echo $t_userlevels_delete->user_level_name->headerCellClass() ?>"><span id="elh_t_userlevels_user_level_name" class="t_userlevels_user_level_name"><?php echo $t_userlevels_delete->user_level_name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_userlevels_delete->RecordCount = 0;
$i = 0;
while (!$t_userlevels_delete->Recordset->EOF) {
	$t_userlevels_delete->RecordCount++;
	$t_userlevels_delete->RowCount++;

	// Set row properties
	$t_userlevels->resetAttributes();
	$t_userlevels->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_userlevels_delete->loadRowValues($t_userlevels_delete->Recordset);

	// Render row
	$t_userlevels_delete->renderRow();
?>
	<tr <?php echo $t_userlevels->rowAttributes() ?>>
<?php if ($t_userlevels_delete->user_level_id->Visible) { // user_level_id ?>
		<td <?php echo $t_userlevels_delete->user_level_id->cellAttributes() ?>>
<span id="el<?php echo $t_userlevels_delete->RowCount ?>_t_userlevels_user_level_id" class="t_userlevels_user_level_id">
<span<?php echo $t_userlevels_delete->user_level_id->viewAttributes() ?>><?php echo $t_userlevels_delete->user_level_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_userlevels_delete->user_level_name->Visible) { // user_level_name ?>
		<td <?php echo $t_userlevels_delete->user_level_name->cellAttributes() ?>>
<span id="el<?php echo $t_userlevels_delete->RowCount ?>_t_userlevels_user_level_name" class="t_userlevels_user_level_name">
<span<?php echo $t_userlevels_delete->user_level_name->viewAttributes() ?>><?php echo $t_userlevels_delete->user_level_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_userlevels_delete->Recordset->moveNext();
}
$t_userlevels_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_userlevels_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_userlevels_delete->showPageFooter();
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
$t_userlevels_delete->terminate();
?>