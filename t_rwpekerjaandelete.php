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
$t_rwpekerjaan_delete = new t_rwpekerjaan_delete();

// Run the page
$t_rwpekerjaan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rwpekerjaan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_rwpekerjaandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_rwpekerjaandelete = currentForm = new ew.Form("ft_rwpekerjaandelete", "delete");
	loadjs.done("ft_rwpekerjaandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_rwpekerjaan_delete->showPageHeader(); ?>
<?php
$t_rwpekerjaan_delete->showMessage();
?>
<form name="ft_rwpekerjaandelete" id="ft_rwpekerjaandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rwpekerjaan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_rwpekerjaan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_rwpekerjaan_delete->rwkerjaid->Visible) { // rwkerjaid ?>
		<th class="<?php echo $t_rwpekerjaan_delete->rwkerjaid->headerCellClass() ?>"><span id="elh_t_rwpekerjaan_rwkerjaid" class="t_rwpekerjaan_rwkerjaid"><?php echo $t_rwpekerjaan_delete->rwkerjaid->caption() ?></span></th>
<?php } ?>
<?php if ($t_rwpekerjaan_delete->bioid->Visible) { // bioid ?>
		<th class="<?php echo $t_rwpekerjaan_delete->bioid->headerCellClass() ?>"><span id="elh_t_rwpekerjaan_bioid" class="t_rwpekerjaan_bioid"><?php echo $t_rwpekerjaan_delete->bioid->caption() ?></span></th>
<?php } ?>
<?php if ($t_rwpekerjaan_delete->perusahaan->Visible) { // perusahaan ?>
		<th class="<?php echo $t_rwpekerjaan_delete->perusahaan->headerCellClass() ?>"><span id="elh_t_rwpekerjaan_perusahaan" class="t_rwpekerjaan_perusahaan"><?php echo $t_rwpekerjaan_delete->perusahaan->caption() ?></span></th>
<?php } ?>
<?php if ($t_rwpekerjaan_delete->jabatan->Visible) { // jabatan ?>
		<th class="<?php echo $t_rwpekerjaan_delete->jabatan->headerCellClass() ?>"><span id="elh_t_rwpekerjaan_jabatan" class="t_rwpekerjaan_jabatan"><?php echo $t_rwpekerjaan_delete->jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($t_rwpekerjaan_delete->mulai->Visible) { // mulai ?>
		<th class="<?php echo $t_rwpekerjaan_delete->mulai->headerCellClass() ?>"><span id="elh_t_rwpekerjaan_mulai" class="t_rwpekerjaan_mulai"><?php echo $t_rwpekerjaan_delete->mulai->caption() ?></span></th>
<?php } ?>
<?php if ($t_rwpekerjaan_delete->hingga->Visible) { // hingga ?>
		<th class="<?php echo $t_rwpekerjaan_delete->hingga->headerCellClass() ?>"><span id="elh_t_rwpekerjaan_hingga" class="t_rwpekerjaan_hingga"><?php echo $t_rwpekerjaan_delete->hingga->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_rwpekerjaan_delete->RecordCount = 0;
$i = 0;
while (!$t_rwpekerjaan_delete->Recordset->EOF) {
	$t_rwpekerjaan_delete->RecordCount++;
	$t_rwpekerjaan_delete->RowCount++;

	// Set row properties
	$t_rwpekerjaan->resetAttributes();
	$t_rwpekerjaan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_rwpekerjaan_delete->loadRowValues($t_rwpekerjaan_delete->Recordset);

	// Render row
	$t_rwpekerjaan_delete->renderRow();
?>
	<tr <?php echo $t_rwpekerjaan->rowAttributes() ?>>
<?php if ($t_rwpekerjaan_delete->rwkerjaid->Visible) { // rwkerjaid ?>
		<td <?php echo $t_rwpekerjaan_delete->rwkerjaid->cellAttributes() ?>>
<span id="el<?php echo $t_rwpekerjaan_delete->RowCount ?>_t_rwpekerjaan_rwkerjaid" class="t_rwpekerjaan_rwkerjaid">
<span<?php echo $t_rwpekerjaan_delete->rwkerjaid->viewAttributes() ?>><?php echo $t_rwpekerjaan_delete->rwkerjaid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rwpekerjaan_delete->bioid->Visible) { // bioid ?>
		<td <?php echo $t_rwpekerjaan_delete->bioid->cellAttributes() ?>>
<span id="el<?php echo $t_rwpekerjaan_delete->RowCount ?>_t_rwpekerjaan_bioid" class="t_rwpekerjaan_bioid">
<span<?php echo $t_rwpekerjaan_delete->bioid->viewAttributes() ?>><?php echo $t_rwpekerjaan_delete->bioid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rwpekerjaan_delete->perusahaan->Visible) { // perusahaan ?>
		<td <?php echo $t_rwpekerjaan_delete->perusahaan->cellAttributes() ?>>
<span id="el<?php echo $t_rwpekerjaan_delete->RowCount ?>_t_rwpekerjaan_perusahaan" class="t_rwpekerjaan_perusahaan">
<span<?php echo $t_rwpekerjaan_delete->perusahaan->viewAttributes() ?>><?php echo $t_rwpekerjaan_delete->perusahaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rwpekerjaan_delete->jabatan->Visible) { // jabatan ?>
		<td <?php echo $t_rwpekerjaan_delete->jabatan->cellAttributes() ?>>
<span id="el<?php echo $t_rwpekerjaan_delete->RowCount ?>_t_rwpekerjaan_jabatan" class="t_rwpekerjaan_jabatan">
<span<?php echo $t_rwpekerjaan_delete->jabatan->viewAttributes() ?>><?php echo $t_rwpekerjaan_delete->jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rwpekerjaan_delete->mulai->Visible) { // mulai ?>
		<td <?php echo $t_rwpekerjaan_delete->mulai->cellAttributes() ?>>
<span id="el<?php echo $t_rwpekerjaan_delete->RowCount ?>_t_rwpekerjaan_mulai" class="t_rwpekerjaan_mulai">
<span<?php echo $t_rwpekerjaan_delete->mulai->viewAttributes() ?>><?php echo $t_rwpekerjaan_delete->mulai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rwpekerjaan_delete->hingga->Visible) { // hingga ?>
		<td <?php echo $t_rwpekerjaan_delete->hingga->cellAttributes() ?>>
<span id="el<?php echo $t_rwpekerjaan_delete->RowCount ?>_t_rwpekerjaan_hingga" class="t_rwpekerjaan_hingga">
<span<?php echo $t_rwpekerjaan_delete->hingga->viewAttributes() ?>><?php echo $t_rwpekerjaan_delete->hingga->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_rwpekerjaan_delete->Recordset->moveNext();
}
$t_rwpekerjaan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_rwpekerjaan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_rwpekerjaan_delete->showPageFooter();
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
$t_rwpekerjaan_delete->terminate();
?>