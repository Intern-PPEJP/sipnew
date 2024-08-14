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
$t_users_delete = new t_users_delete();

// Run the page
$t_users_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_users_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_usersdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_usersdelete = currentForm = new ew.Form("ft_usersdelete", "delete");
	loadjs.done("ft_usersdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_users_delete->showPageHeader(); ?>
<?php
$t_users_delete->showMessage();
?>
<form name="ft_usersdelete" id="ft_usersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_users">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_users_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_users_delete->username->Visible) { // username ?>
		<th class="<?php echo $t_users_delete->username->headerCellClass() ?>"><span id="elh_t_users_username" class="t_users_username"><?php echo $t_users_delete->username->caption() ?></span></th>
<?php } ?>
<?php if ($t_users_delete->pass->Visible) { // pass ?>
		<th class="<?php echo $t_users_delete->pass->headerCellClass() ?>"><span id="elh_t_users_pass" class="t_users_pass"><?php echo $t_users_delete->pass->caption() ?></span></th>
<?php } ?>
<?php if ($t_users_delete->_userlevel->Visible) { // userlevel ?>
		<th class="<?php echo $t_users_delete->_userlevel->headerCellClass() ?>"><span id="elh_t_users__userlevel" class="t_users__userlevel"><?php echo $t_users_delete->_userlevel->caption() ?></span></th>
<?php } ?>
<?php if ($t_users_delete->aktif->Visible) { // aktif ?>
		<th class="<?php echo $t_users_delete->aktif->headerCellClass() ?>"><span id="elh_t_users_aktif" class="t_users_aktif"><?php echo $t_users_delete->aktif->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_users_delete->RecordCount = 0;
$i = 0;
while (!$t_users_delete->Recordset->EOF) {
	$t_users_delete->RecordCount++;
	$t_users_delete->RowCount++;

	// Set row properties
	$t_users->resetAttributes();
	$t_users->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_users_delete->loadRowValues($t_users_delete->Recordset);

	// Render row
	$t_users_delete->renderRow();
?>
	<tr <?php echo $t_users->rowAttributes() ?>>
<?php if ($t_users_delete->username->Visible) { // username ?>
		<td <?php echo $t_users_delete->username->cellAttributes() ?>>
<span id="el<?php echo $t_users_delete->RowCount ?>_t_users_username" class="t_users_username">
<span<?php echo $t_users_delete->username->viewAttributes() ?>><?php echo $t_users_delete->username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_users_delete->pass->Visible) { // pass ?>
		<td <?php echo $t_users_delete->pass->cellAttributes() ?>>
<span id="el<?php echo $t_users_delete->RowCount ?>_t_users_pass" class="t_users_pass">
<span<?php echo $t_users_delete->pass->viewAttributes() ?>><?php echo $t_users_delete->pass->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_users_delete->_userlevel->Visible) { // userlevel ?>
		<td <?php echo $t_users_delete->_userlevel->cellAttributes() ?>>
<span id="el<?php echo $t_users_delete->RowCount ?>_t_users__userlevel" class="t_users__userlevel">
<span<?php echo $t_users_delete->_userlevel->viewAttributes() ?>><?php echo $t_users_delete->_userlevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_users_delete->aktif->Visible) { // aktif ?>
		<td <?php echo $t_users_delete->aktif->cellAttributes() ?>>
<span id="el<?php echo $t_users_delete->RowCount ?>_t_users_aktif" class="t_users_aktif">
<span<?php echo $t_users_delete->aktif->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_aktif" class="custom-control-input" value="<?php echo $t_users_delete->aktif->getViewValue() ?>" disabled<?php if (ConvertToBool($t_users_delete->aktif->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_aktif"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_users_delete->Recordset->moveNext();
}
$t_users_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_users_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_users_delete->showPageFooter();
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
$t_users_delete->terminate();
?>