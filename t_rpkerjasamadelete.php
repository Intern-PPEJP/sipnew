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
$t_rpkerjasama_delete = new t_rpkerjasama_delete();

// Run the page
$t_rpkerjasama_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rpkerjasama_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_rpkerjasamadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_rpkerjasamadelete = currentForm = new ew.Form("ft_rpkerjasamadelete", "delete");
	loadjs.done("ft_rpkerjasamadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_rpkerjasama_delete->showPageHeader(); ?>
<?php
$t_rpkerjasama_delete->showMessage();
?>
<form name="ft_rpkerjasamadelete" id="ft_rpkerjasamadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rpkerjasama">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_rpkerjasama_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_rpkerjasama_delete->jenispel->Visible) { // jenispel ?>
		<th class="<?php echo $t_rpkerjasama_delete->jenispel->headerCellClass() ?>"><span id="elh_t_rpkerjasama_jenispel" class="t_rpkerjasama_jenispel"><?php echo $t_rpkerjasama_delete->jenispel->caption() ?></span></th>
<?php } ?>
<?php if ($t_rpkerjasama_delete->kerjasama->Visible) { // kerjasama ?>
		<th class="<?php echo $t_rpkerjasama_delete->kerjasama->headerCellClass() ?>"><span id="elh_t_rpkerjasama_kerjasama" class="t_rpkerjasama_kerjasama"><?php echo $t_rpkerjasama_delete->kerjasama->caption() ?></span></th>
<?php } ?>
<?php if ($t_rpkerjasama_delete->angkatan->Visible) { // angkatan ?>
		<th class="<?php echo $t_rpkerjasama_delete->angkatan->headerCellClass() ?>"><span id="elh_t_rpkerjasama_angkatan" class="t_rpkerjasama_angkatan"><?php echo $t_rpkerjasama_delete->angkatan->caption() ?></span></th>
<?php } ?>
<?php if ($t_rpkerjasama_delete->sisa_angkatan->Visible) { // sisa_angkatan ?>
		<th class="<?php echo $t_rpkerjasama_delete->sisa_angkatan->headerCellClass() ?>"><span id="elh_t_rpkerjasama_sisa_angkatan" class="t_rpkerjasama_sisa_angkatan"><?php echo $t_rpkerjasama_delete->sisa_angkatan->caption() ?></span></th>
<?php } ?>
<?php if ($t_rpkerjasama_delete->targetpes->Visible) { // targetpes ?>
		<th class="<?php echo $t_rpkerjasama_delete->targetpes->headerCellClass() ?>"><span id="elh_t_rpkerjasama_targetpes" class="t_rpkerjasama_targetpes"><?php echo $t_rpkerjasama_delete->targetpes->caption() ?></span></th>
<?php } ?>
<?php if ($t_rpkerjasama_delete->kontak_person->Visible) { // kontak_person ?>
		<th class="<?php echo $t_rpkerjasama_delete->kontak_person->headerCellClass() ?>"><span id="elh_t_rpkerjasama_kontak_person" class="t_rpkerjasama_kontak_person"><?php echo $t_rpkerjasama_delete->kontak_person->caption() ?></span></th>
<?php } ?>
<?php if ($t_rpkerjasama_delete->tahun_rencana->Visible) { // tahun_rencana ?>
		<th class="<?php echo $t_rpkerjasama_delete->tahun_rencana->headerCellClass() ?>"><span id="elh_t_rpkerjasama_tahun_rencana" class="t_rpkerjasama_tahun_rencana"><?php echo $t_rpkerjasama_delete->tahun_rencana->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_rpkerjasama_delete->RecordCount = 0;
$i = 0;
while (!$t_rpkerjasama_delete->Recordset->EOF) {
	$t_rpkerjasama_delete->RecordCount++;
	$t_rpkerjasama_delete->RowCount++;

	// Set row properties
	$t_rpkerjasama->resetAttributes();
	$t_rpkerjasama->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_rpkerjasama_delete->loadRowValues($t_rpkerjasama_delete->Recordset);

	// Render row
	$t_rpkerjasama_delete->renderRow();
?>
	<tr <?php echo $t_rpkerjasama->rowAttributes() ?>>
<?php if ($t_rpkerjasama_delete->jenispel->Visible) { // jenispel ?>
		<td <?php echo $t_rpkerjasama_delete->jenispel->cellAttributes() ?>>
<span id="el<?php echo $t_rpkerjasama_delete->RowCount ?>_t_rpkerjasama_jenispel" class="t_rpkerjasama_jenispel">
<span<?php echo $t_rpkerjasama_delete->jenispel->viewAttributes() ?>><?php echo $t_rpkerjasama_delete->jenispel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rpkerjasama_delete->kerjasama->Visible) { // kerjasama ?>
		<td <?php echo $t_rpkerjasama_delete->kerjasama->cellAttributes() ?>>
<span id="el<?php echo $t_rpkerjasama_delete->RowCount ?>_t_rpkerjasama_kerjasama" class="t_rpkerjasama_kerjasama">
<span<?php echo $t_rpkerjasama_delete->kerjasama->viewAttributes() ?>><?php echo $t_rpkerjasama_delete->kerjasama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rpkerjasama_delete->angkatan->Visible) { // angkatan ?>
		<td <?php echo $t_rpkerjasama_delete->angkatan->cellAttributes() ?>>
<span id="el<?php echo $t_rpkerjasama_delete->RowCount ?>_t_rpkerjasama_angkatan" class="t_rpkerjasama_angkatan">
<span<?php echo $t_rpkerjasama_delete->angkatan->viewAttributes() ?>><?php echo $t_rpkerjasama_delete->angkatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rpkerjasama_delete->sisa_angkatan->Visible) { // sisa_angkatan ?>
		<td <?php echo $t_rpkerjasama_delete->sisa_angkatan->cellAttributes() ?>>
<span id="el<?php echo $t_rpkerjasama_delete->RowCount ?>_t_rpkerjasama_sisa_angkatan" class="t_rpkerjasama_sisa_angkatan">
<span<?php echo $t_rpkerjasama_delete->sisa_angkatan->viewAttributes() ?>><?php echo $t_rpkerjasama_delete->sisa_angkatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rpkerjasama_delete->targetpes->Visible) { // targetpes ?>
		<td <?php echo $t_rpkerjasama_delete->targetpes->cellAttributes() ?>>
<span id="el<?php echo $t_rpkerjasama_delete->RowCount ?>_t_rpkerjasama_targetpes" class="t_rpkerjasama_targetpes">
<span<?php echo $t_rpkerjasama_delete->targetpes->viewAttributes() ?>><?php echo $t_rpkerjasama_delete->targetpes->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rpkerjasama_delete->kontak_person->Visible) { // kontak_person ?>
		<td <?php echo $t_rpkerjasama_delete->kontak_person->cellAttributes() ?>>
<span id="el<?php echo $t_rpkerjasama_delete->RowCount ?>_t_rpkerjasama_kontak_person" class="t_rpkerjasama_kontak_person">
<span<?php echo $t_rpkerjasama_delete->kontak_person->viewAttributes() ?>><?php echo $t_rpkerjasama_delete->kontak_person->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_rpkerjasama_delete->tahun_rencana->Visible) { // tahun_rencana ?>
		<td <?php echo $t_rpkerjasama_delete->tahun_rencana->cellAttributes() ?>>
<span id="el<?php echo $t_rpkerjasama_delete->RowCount ?>_t_rpkerjasama_tahun_rencana" class="t_rpkerjasama_tahun_rencana">
<span<?php echo $t_rpkerjasama_delete->tahun_rencana->viewAttributes() ?>><?php echo $t_rpkerjasama_delete->tahun_rencana->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_rpkerjasama_delete->Recordset->moveNext();
}
$t_rpkerjasama_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_rpkerjasama_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_rpkerjasama_delete->showPageFooter();
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
$t_rpkerjasama_delete->terminate();
?>