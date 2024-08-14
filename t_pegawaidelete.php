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
$t_pegawai_delete = new t_pegawai_delete();

// Run the page
$t_pegawai_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pegawai_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_pegawaidelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_pegawaidelete = currentForm = new ew.Form("ft_pegawaidelete", "delete");
	loadjs.done("ft_pegawaidelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_pegawai_delete->showPageHeader(); ?>
<?php
$t_pegawai_delete->showMessage();
?>
<form name="ft_pegawaidelete" id="ft_pegawaidelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_pegawai">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_pegawai_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_pegawai_delete->nip->Visible) { // nip ?>
		<th class="<?php echo $t_pegawai_delete->nip->headerCellClass() ?>"><span id="elh_t_pegawai_nip" class="t_pegawai_nip"><?php echo $t_pegawai_delete->nip->caption() ?></span></th>
<?php } ?>
<?php if ($t_pegawai_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $t_pegawai_delete->nama->headerCellClass() ?>"><span id="elh_t_pegawai_nama" class="t_pegawai_nama"><?php echo $t_pegawai_delete->nama->caption() ?></span></th>
<?php } ?>
<?php if ($t_pegawai_delete->bagian->Visible) { // bagian ?>
		<th class="<?php echo $t_pegawai_delete->bagian->headerCellClass() ?>"><span id="elh_t_pegawai_bagian" class="t_pegawai_bagian"><?php echo $t_pegawai_delete->bagian->caption() ?></span></th>
<?php } ?>
<?php if ($t_pegawai_delete->aktif->Visible) { // aktif ?>
		<th class="<?php echo $t_pegawai_delete->aktif->headerCellClass() ?>"><span id="elh_t_pegawai_aktif" class="t_pegawai_aktif"><?php echo $t_pegawai_delete->aktif->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_pegawai_delete->RecordCount = 0;
$i = 0;
while (!$t_pegawai_delete->Recordset->EOF) {
	$t_pegawai_delete->RecordCount++;
	$t_pegawai_delete->RowCount++;

	// Set row properties
	$t_pegawai->resetAttributes();
	$t_pegawai->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_pegawai_delete->loadRowValues($t_pegawai_delete->Recordset);

	// Render row
	$t_pegawai_delete->renderRow();
?>
	<tr <?php echo $t_pegawai->rowAttributes() ?>>
<?php if ($t_pegawai_delete->nip->Visible) { // nip ?>
		<td <?php echo $t_pegawai_delete->nip->cellAttributes() ?>>
<span id="el<?php echo $t_pegawai_delete->RowCount ?>_t_pegawai_nip" class="t_pegawai_nip">
<span<?php echo $t_pegawai_delete->nip->viewAttributes() ?>><?php echo $t_pegawai_delete->nip->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pegawai_delete->nama->Visible) { // nama ?>
		<td <?php echo $t_pegawai_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $t_pegawai_delete->RowCount ?>_t_pegawai_nama" class="t_pegawai_nama">
<span<?php echo $t_pegawai_delete->nama->viewAttributes() ?>><?php echo $t_pegawai_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pegawai_delete->bagian->Visible) { // bagian ?>
		<td <?php echo $t_pegawai_delete->bagian->cellAttributes() ?>>
<span id="el<?php echo $t_pegawai_delete->RowCount ?>_t_pegawai_bagian" class="t_pegawai_bagian">
<span<?php echo $t_pegawai_delete->bagian->viewAttributes() ?>><?php echo $t_pegawai_delete->bagian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pegawai_delete->aktif->Visible) { // aktif ?>
		<td <?php echo $t_pegawai_delete->aktif->cellAttributes() ?>>
<span id="el<?php echo $t_pegawai_delete->RowCount ?>_t_pegawai_aktif" class="t_pegawai_aktif">
<span<?php echo $t_pegawai_delete->aktif->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_aktif" class="custom-control-input" value="<?php echo $t_pegawai_delete->aktif->getViewValue() ?>" disabled<?php if (ConvertToBool($t_pegawai_delete->aktif->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_aktif"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_pegawai_delete->Recordset->moveNext();
}
$t_pegawai_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_pegawai_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_pegawai_delete->showPageFooter();
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
$t_pegawai_delete->terminate();
?>