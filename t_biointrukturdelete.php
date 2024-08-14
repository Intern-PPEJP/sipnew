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
$t_biointruktur_delete = new t_biointruktur_delete();

// Run the page
$t_biointruktur_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_biointruktur_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_biointrukturdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_biointrukturdelete = currentForm = new ew.Form("ft_biointrukturdelete", "delete");
	loadjs.done("ft_biointrukturdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_biointruktur_delete->showPageHeader(); ?>
<?php
$t_biointruktur_delete->showMessage();
?>
<form name="ft_biointrukturdelete" id="ft_biointrukturdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_biointruktur">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_biointruktur_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_biointruktur_delete->bioid->Visible) { // bioid ?>
		<th class="<?php echo $t_biointruktur_delete->bioid->headerCellClass() ?>"><span id="elh_t_biointruktur_bioid" class="t_biointruktur_bioid"><?php echo $t_biointruktur_delete->bioid->caption() ?></span></th>
<?php } ?>
<?php if ($t_biointruktur_delete->kdinstruktur->Visible) { // kdinstruktur ?>
		<th class="<?php echo $t_biointruktur_delete->kdinstruktur->headerCellClass() ?>"><span id="elh_t_biointruktur_kdinstruktur" class="t_biointruktur_kdinstruktur"><?php echo $t_biointruktur_delete->kdinstruktur->caption() ?></span></th>
<?php } ?>
<?php if ($t_biointruktur_delete->revisi->Visible) { // revisi ?>
		<th class="<?php echo $t_biointruktur_delete->revisi->headerCellClass() ?>"><span id="elh_t_biointruktur_revisi" class="t_biointruktur_revisi"><?php echo $t_biointruktur_delete->revisi->caption() ?></span></th>
<?php } ?>
<?php if ($t_biointruktur_delete->tglterbit->Visible) { // tglterbit ?>
		<th class="<?php echo $t_biointruktur_delete->tglterbit->headerCellClass() ?>"><span id="elh_t_biointruktur_tglterbit" class="t_biointruktur_tglterbit"><?php echo $t_biointruktur_delete->tglterbit->caption() ?></span></th>
<?php } ?>
<?php if ($t_biointruktur_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $t_biointruktur_delete->nama->headerCellClass() ?>"><span id="elh_t_biointruktur_nama" class="t_biointruktur_nama"><?php echo $t_biointruktur_delete->nama->caption() ?></span></th>
<?php } ?>
<?php if ($t_biointruktur_delete->komp_materi->Visible) { // komp_materi ?>
		<th class="<?php echo $t_biointruktur_delete->komp_materi->headerCellClass() ?>"><span id="elh_t_biointruktur_komp_materi" class="t_biointruktur_komp_materi"><?php echo $t_biointruktur_delete->komp_materi->caption() ?></span></th>
<?php } ?>
<?php if ($t_biointruktur_delete->instansi->Visible) { // instansi ?>
		<th class="<?php echo $t_biointruktur_delete->instansi->headerCellClass() ?>"><span id="elh_t_biointruktur_instansi" class="t_biointruktur_instansi"><?php echo $t_biointruktur_delete->instansi->caption() ?></span></th>
<?php } ?>
<?php if ($t_biointruktur_delete->pekerjaan->Visible) { // pekerjaan ?>
		<th class="<?php echo $t_biointruktur_delete->pekerjaan->headerCellClass() ?>"><span id="elh_t_biointruktur_pekerjaan" class="t_biointruktur_pekerjaan"><?php echo $t_biointruktur_delete->pekerjaan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_biointruktur_delete->RecordCount = 0;
$i = 0;
while (!$t_biointruktur_delete->Recordset->EOF) {
	$t_biointruktur_delete->RecordCount++;
	$t_biointruktur_delete->RowCount++;

	// Set row properties
	$t_biointruktur->resetAttributes();
	$t_biointruktur->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_biointruktur_delete->loadRowValues($t_biointruktur_delete->Recordset);

	// Render row
	$t_biointruktur_delete->renderRow();
?>
	<tr <?php echo $t_biointruktur->rowAttributes() ?>>
<?php if ($t_biointruktur_delete->bioid->Visible) { // bioid ?>
		<td <?php echo $t_biointruktur_delete->bioid->cellAttributes() ?>>
<span id="el<?php echo $t_biointruktur_delete->RowCount ?>_t_biointruktur_bioid" class="t_biointruktur_bioid">
<span<?php echo $t_biointruktur_delete->bioid->viewAttributes() ?>><?php echo $t_biointruktur_delete->bioid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_biointruktur_delete->kdinstruktur->Visible) { // kdinstruktur ?>
		<td <?php echo $t_biointruktur_delete->kdinstruktur->cellAttributes() ?>>
<span id="el<?php echo $t_biointruktur_delete->RowCount ?>_t_biointruktur_kdinstruktur" class="t_biointruktur_kdinstruktur">
<span<?php echo $t_biointruktur_delete->kdinstruktur->viewAttributes() ?>><?php echo $t_biointruktur_delete->kdinstruktur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_biointruktur_delete->revisi->Visible) { // revisi ?>
		<td <?php echo $t_biointruktur_delete->revisi->cellAttributes() ?>>
<span id="el<?php echo $t_biointruktur_delete->RowCount ?>_t_biointruktur_revisi" class="t_biointruktur_revisi">
<span<?php echo $t_biointruktur_delete->revisi->viewAttributes() ?>><?php echo $t_biointruktur_delete->revisi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_biointruktur_delete->tglterbit->Visible) { // tglterbit ?>
		<td <?php echo $t_biointruktur_delete->tglterbit->cellAttributes() ?>>
<span id="el<?php echo $t_biointruktur_delete->RowCount ?>_t_biointruktur_tglterbit" class="t_biointruktur_tglterbit">
<span<?php echo $t_biointruktur_delete->tglterbit->viewAttributes() ?>><?php echo $t_biointruktur_delete->tglterbit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_biointruktur_delete->nama->Visible) { // nama ?>
		<td <?php echo $t_biointruktur_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $t_biointruktur_delete->RowCount ?>_t_biointruktur_nama" class="t_biointruktur_nama">
<span<?php echo $t_biointruktur_delete->nama->viewAttributes() ?>><?php echo $t_biointruktur_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_biointruktur_delete->komp_materi->Visible) { // komp_materi ?>
		<td <?php echo $t_biointruktur_delete->komp_materi->cellAttributes() ?>>
<span id="el<?php echo $t_biointruktur_delete->RowCount ?>_t_biointruktur_komp_materi" class="t_biointruktur_komp_materi">
<span<?php echo $t_biointruktur_delete->komp_materi->viewAttributes() ?>><?php echo $t_biointruktur_delete->komp_materi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_biointruktur_delete->instansi->Visible) { // instansi ?>
		<td <?php echo $t_biointruktur_delete->instansi->cellAttributes() ?>>
<span id="el<?php echo $t_biointruktur_delete->RowCount ?>_t_biointruktur_instansi" class="t_biointruktur_instansi">
<span<?php echo $t_biointruktur_delete->instansi->viewAttributes() ?>><?php echo $t_biointruktur_delete->instansi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_biointruktur_delete->pekerjaan->Visible) { // pekerjaan ?>
		<td <?php echo $t_biointruktur_delete->pekerjaan->cellAttributes() ?>>
<span id="el<?php echo $t_biointruktur_delete->RowCount ?>_t_biointruktur_pekerjaan" class="t_biointruktur_pekerjaan">
<span<?php echo $t_biointruktur_delete->pekerjaan->viewAttributes() ?>><?php echo $t_biointruktur_delete->pekerjaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_biointruktur_delete->Recordset->moveNext();
}
$t_biointruktur_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_biointruktur_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_biointruktur_delete->showPageFooter();
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
$t_biointruktur_delete->terminate();
?>