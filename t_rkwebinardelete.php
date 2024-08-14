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
$t_rkwebinar_delete = new t_rkwebinar_delete();

// Run the page
$t_rkwebinar_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rkwebinar_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_rkwebinardelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_rkwebinardelete = currentForm = new ew.Form("ft_rkwebinardelete", "delete");
	loadjs.done("ft_rkwebinardelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_rkwebinar_delete->showPageHeader(); ?>
<?php
$t_rkwebinar_delete->showMessage();
?>
<form name="ft_rkwebinardelete" id="ft_rkwebinardelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rkwebinar">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_rkwebinar_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_rkwebinar_delete->kegiatan->Visible) { // kegiatan ?>
		<th class="<?php echo $t_rkwebinar_delete->kegiatan->headerCellClass() ?>"><span id="elh_t_rkwebinar_kegiatan" class="t_rkwebinar_kegiatan"><?php echo $t_rkwebinar_delete->kegiatan->caption() ?></span></th>
<?php } ?>
<?php if ($t_rkwebinar_delete->tanggal_kegiatan->Visible) { // tanggal_kegiatan ?>
		<th class="<?php echo $t_rkwebinar_delete->tanggal_kegiatan->headerCellClass() ?>"><span id="elh_t_rkwebinar_tanggal_kegiatan" class="t_rkwebinar_tanggal_kegiatan"><?php echo $t_rkwebinar_delete->tanggal_kegiatan->caption() ?></span></th>
<?php } ?>
<?php if ($t_rkwebinar_delete->tahun->Visible) { // tahun ?>
		<th class="<?php echo $t_rkwebinar_delete->tahun->headerCellClass() ?>"><span id="elh_t_rkwebinar_tahun" class="t_rkwebinar_tahun"><?php echo $t_rkwebinar_delete->tahun->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_rkwebinar_delete->RecordCount = 0;
$i = 0;
while (!$t_rkwebinar_delete->Recordset->EOF) {
	$t_rkwebinar_delete->RecordCount++;
	$t_rkwebinar_delete->RowCount++;

	// Set row properties
	$t_rkwebinar->resetAttributes();
	$t_rkwebinar->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_rkwebinar_delete->loadRowValues($t_rkwebinar_delete->Recordset);

	// Render row
	$t_rkwebinar_delete->renderRow();
?>
	<tr <?php echo $t_rkwebinar->rowAttributes() ?>>
<?php if ($t_rkwebinar_delete->kegiatan->Visible) { // kegiatan ?>
		<td <?php echo $t_rkwebinar_delete->kegiatan->cellAttributes() ?>>
<span id="el<?php echo $t_rkwebinar_delete->RowCount ?>_t_rkwebinar_kegiatan" class="t_rkwebinar_kegiatan">
<span<?php echo $t_rkwebinar_delete->kegiatan->viewAttributes() ?>><?php echo $t_rkwebinar_delete->kegiatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rkwebinar_delete->tanggal_kegiatan->Visible) { // tanggal_kegiatan ?>
		<td <?php echo $t_rkwebinar_delete->tanggal_kegiatan->cellAttributes() ?>>
<span id="el<?php echo $t_rkwebinar_delete->RowCount ?>_t_rkwebinar_tanggal_kegiatan" class="t_rkwebinar_tanggal_kegiatan">
<span<?php echo $t_rkwebinar_delete->tanggal_kegiatan->viewAttributes() ?>><?php echo $t_rkwebinar_delete->tanggal_kegiatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rkwebinar_delete->tahun->Visible) { // tahun ?>
		<td <?php echo $t_rkwebinar_delete->tahun->cellAttributes() ?>>
<span id="el<?php echo $t_rkwebinar_delete->RowCount ?>_t_rkwebinar_tahun" class="t_rkwebinar_tahun">
<span<?php echo $t_rkwebinar_delete->tahun->viewAttributes() ?>><?php echo $t_rkwebinar_delete->tahun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_rkwebinar_delete->Recordset->moveNext();
}
$t_rkwebinar_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_rkwebinar_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_rkwebinar_delete->showPageFooter();
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
$t_rkwebinar_delete->terminate();
?>