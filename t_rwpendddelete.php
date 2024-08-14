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
$t_rwpendd_delete = new t_rwpendd_delete();

// Run the page
$t_rwpendd_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rwpendd_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_rwpendddelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_rwpendddelete = currentForm = new ew.Form("ft_rwpendddelete", "delete");
	loadjs.done("ft_rwpendddelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_rwpendd_delete->showPageHeader(); ?>
<?php
$t_rwpendd_delete->showMessage();
?>
<form name="ft_rwpendddelete" id="ft_rwpendddelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rwpendd">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_rwpendd_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_rwpendd_delete->penddid->Visible) { // penddid ?>
		<th class="<?php echo $t_rwpendd_delete->penddid->headerCellClass() ?>"><span id="elh_t_rwpendd_penddid" class="t_rwpendd_penddid"><?php echo $t_rwpendd_delete->penddid->caption() ?></span></th>
<?php } ?>
<?php if ($t_rwpendd_delete->bioid->Visible) { // bioid ?>
		<th class="<?php echo $t_rwpendd_delete->bioid->headerCellClass() ?>"><span id="elh_t_rwpendd_bioid" class="t_rwpendd_bioid"><?php echo $t_rwpendd_delete->bioid->caption() ?></span></th>
<?php } ?>
<?php if ($t_rwpendd_delete->sekolah->Visible) { // sekolah ?>
		<th class="<?php echo $t_rwpendd_delete->sekolah->headerCellClass() ?>"><span id="elh_t_rwpendd_sekolah" class="t_rwpendd_sekolah"><?php echo $t_rwpendd_delete->sekolah->caption() ?></span></th>
<?php } ?>
<?php if ($t_rwpendd_delete->tempat->Visible) { // tempat ?>
		<th class="<?php echo $t_rwpendd_delete->tempat->headerCellClass() ?>"><span id="elh_t_rwpendd_tempat" class="t_rwpendd_tempat"><?php echo $t_rwpendd_delete->tempat->caption() ?></span></th>
<?php } ?>
<?php if ($t_rwpendd_delete->tahun->Visible) { // tahun ?>
		<th class="<?php echo $t_rwpendd_delete->tahun->headerCellClass() ?>"><span id="elh_t_rwpendd_tahun" class="t_rwpendd_tahun"><?php echo $t_rwpendd_delete->tahun->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_rwpendd_delete->RecordCount = 0;
$i = 0;
while (!$t_rwpendd_delete->Recordset->EOF) {
	$t_rwpendd_delete->RecordCount++;
	$t_rwpendd_delete->RowCount++;

	// Set row properties
	$t_rwpendd->resetAttributes();
	$t_rwpendd->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_rwpendd_delete->loadRowValues($t_rwpendd_delete->Recordset);

	// Render row
	$t_rwpendd_delete->renderRow();
?>
	<tr <?php echo $t_rwpendd->rowAttributes() ?>>
<?php if ($t_rwpendd_delete->penddid->Visible) { // penddid ?>
		<td <?php echo $t_rwpendd_delete->penddid->cellAttributes() ?>>
<span id="el<?php echo $t_rwpendd_delete->RowCount ?>_t_rwpendd_penddid" class="t_rwpendd_penddid">
<span<?php echo $t_rwpendd_delete->penddid->viewAttributes() ?>><?php echo $t_rwpendd_delete->penddid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rwpendd_delete->bioid->Visible) { // bioid ?>
		<td <?php echo $t_rwpendd_delete->bioid->cellAttributes() ?>>
<span id="el<?php echo $t_rwpendd_delete->RowCount ?>_t_rwpendd_bioid" class="t_rwpendd_bioid">
<span<?php echo $t_rwpendd_delete->bioid->viewAttributes() ?>><?php echo $t_rwpendd_delete->bioid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rwpendd_delete->sekolah->Visible) { // sekolah ?>
		<td <?php echo $t_rwpendd_delete->sekolah->cellAttributes() ?>>
<span id="el<?php echo $t_rwpendd_delete->RowCount ?>_t_rwpendd_sekolah" class="t_rwpendd_sekolah">
<span<?php echo $t_rwpendd_delete->sekolah->viewAttributes() ?>><?php echo $t_rwpendd_delete->sekolah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rwpendd_delete->tempat->Visible) { // tempat ?>
		<td <?php echo $t_rwpendd_delete->tempat->cellAttributes() ?>>
<span id="el<?php echo $t_rwpendd_delete->RowCount ?>_t_rwpendd_tempat" class="t_rwpendd_tempat">
<span<?php echo $t_rwpendd_delete->tempat->viewAttributes() ?>><?php echo $t_rwpendd_delete->tempat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rwpendd_delete->tahun->Visible) { // tahun ?>
		<td <?php echo $t_rwpendd_delete->tahun->cellAttributes() ?>>
<span id="el<?php echo $t_rwpendd_delete->RowCount ?>_t_rwpendd_tahun" class="t_rwpendd_tahun">
<span<?php echo $t_rwpendd_delete->tahun->viewAttributes() ?>><?php echo $t_rwpendd_delete->tahun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_rwpendd_delete->Recordset->moveNext();
}
$t_rwpendd_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_rwpendd_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_rwpendd_delete->showPageFooter();
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
$t_rwpendd_delete->terminate();
?>