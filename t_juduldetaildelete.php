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
$t_juduldetail_delete = new t_juduldetail_delete();

// Run the page
$t_juduldetail_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_juduldetail_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_juduldetaildelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_juduldetaildelete = currentForm = new ew.Form("ft_juduldetaildelete", "delete");
	loadjs.done("ft_juduldetaildelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_juduldetail_delete->showPageHeader(); ?>
<?php
$t_juduldetail_delete->showMessage();
?>
<form name="ft_juduldetaildelete" id="ft_juduldetaildelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_juduldetail">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_juduldetail_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_juduldetail_delete->singbagian->Visible) { // singbagian ?>
		<th class="<?php echo $t_juduldetail_delete->singbagian->headerCellClass() ?>"><span id="elh_t_juduldetail_singbagian" class="t_juduldetail_singbagian"><?php echo $t_juduldetail_delete->singbagian->caption() ?></span></th>
<?php } ?>
<?php if ($t_juduldetail_delete->jpel->Visible) { // jpel ?>
		<th class="<?php echo $t_juduldetail_delete->jpel->headerCellClass() ?>"><span id="elh_t_juduldetail_jpel" class="t_juduldetail_jpel"><?php echo $t_juduldetail_delete->jpel->caption() ?></span></th>
<?php } ?>
<?php if ($t_juduldetail_delete->kdjudul->Visible) { // kdjudul ?>
		<th class="<?php echo $t_juduldetail_delete->kdjudul->headerCellClass() ?>"><span id="elh_t_juduldetail_kdjudul" class="t_juduldetail_kdjudul"><?php echo $t_juduldetail_delete->kdjudul->caption() ?></span></th>
<?php } ?>
<?php if ($t_juduldetail_delete->kdkursil->Visible) { // kdkursil ?>
		<th class="<?php echo $t_juduldetail_delete->kdkursil->headerCellClass() ?>"><span id="elh_t_juduldetail_kdkursil" class="t_juduldetail_kdkursil"><?php echo $t_juduldetail_delete->kdkursil->caption() ?></span></th>
<?php } ?>
<?php if ($t_juduldetail_delete->revisi->Visible) { // revisi ?>
		<th class="<?php echo $t_juduldetail_delete->revisi->headerCellClass() ?>"><span id="elh_t_juduldetail_revisi" class="t_juduldetail_revisi"><?php echo $t_juduldetail_delete->revisi->caption() ?></span></th>
<?php } ?>
<?php if ($t_juduldetail_delete->tgl_terbit->Visible) { // tgl_terbit ?>
		<th class="<?php echo $t_juduldetail_delete->tgl_terbit->headerCellClass() ?>"><span id="elh_t_juduldetail_tgl_terbit" class="t_juduldetail_tgl_terbit"><?php echo $t_juduldetail_delete->tgl_terbit->caption() ?></span></th>
<?php } ?>
<?php if ($t_juduldetail_delete->deskripsi_singkat->Visible) { // deskripsi_singkat ?>
		<th class="<?php echo $t_juduldetail_delete->deskripsi_singkat->headerCellClass() ?>"><span id="elh_t_juduldetail_deskripsi_singkat" class="t_juduldetail_deskripsi_singkat"><?php echo $t_juduldetail_delete->deskripsi_singkat->caption() ?></span></th>
<?php } ?>
<?php if ($t_juduldetail_delete->tujuan->Visible) { // tujuan ?>
		<th class="<?php echo $t_juduldetail_delete->tujuan->headerCellClass() ?>"><span id="elh_t_juduldetail_tujuan" class="t_juduldetail_tujuan"><?php echo $t_juduldetail_delete->tujuan->caption() ?></span></th>
<?php } ?>
<?php if ($t_juduldetail_delete->target_peserta->Visible) { // target_peserta ?>
		<th class="<?php echo $t_juduldetail_delete->target_peserta->headerCellClass() ?>"><span id="elh_t_juduldetail_target_peserta" class="t_juduldetail_target_peserta"><?php echo $t_juduldetail_delete->target_peserta->caption() ?></span></th>
<?php } ?>
<?php if ($t_juduldetail_delete->lama_pelatihan->Visible) { // lama_pelatihan ?>
		<th class="<?php echo $t_juduldetail_delete->lama_pelatihan->headerCellClass() ?>"><span id="elh_t_juduldetail_lama_pelatihan" class="t_juduldetail_lama_pelatihan"><?php echo $t_juduldetail_delete->lama_pelatihan->caption() ?></span></th>
<?php } ?>
<?php if ($t_juduldetail_delete->catatan->Visible) { // catatan ?>
		<th class="<?php echo $t_juduldetail_delete->catatan->headerCellClass() ?>"><span id="elh_t_juduldetail_catatan" class="t_juduldetail_catatan"><?php echo $t_juduldetail_delete->catatan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_juduldetail_delete->RecordCount = 0;
$i = 0;
while (!$t_juduldetail_delete->Recordset->EOF) {
	$t_juduldetail_delete->RecordCount++;
	$t_juduldetail_delete->RowCount++;

	// Set row properties
	$t_juduldetail->resetAttributes();
	$t_juduldetail->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_juduldetail_delete->loadRowValues($t_juduldetail_delete->Recordset);

	// Render row
	$t_juduldetail_delete->renderRow();
?>
	<tr <?php echo $t_juduldetail->rowAttributes() ?>>
<?php if ($t_juduldetail_delete->singbagian->Visible) { // singbagian ?>
		<td <?php echo $t_juduldetail_delete->singbagian->cellAttributes() ?>>
<span id="el<?php echo $t_juduldetail_delete->RowCount ?>_t_juduldetail_singbagian" class="t_juduldetail_singbagian">
<span<?php echo $t_juduldetail_delete->singbagian->viewAttributes() ?>><?php echo $t_juduldetail_delete->singbagian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_juduldetail_delete->jpel->Visible) { // jpel ?>
		<td <?php echo $t_juduldetail_delete->jpel->cellAttributes() ?>>
<span id="el<?php echo $t_juduldetail_delete->RowCount ?>_t_juduldetail_jpel" class="t_juduldetail_jpel">
<span<?php echo $t_juduldetail_delete->jpel->viewAttributes() ?>><?php echo $t_juduldetail_delete->jpel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_juduldetail_delete->kdjudul->Visible) { // kdjudul ?>
		<td <?php echo $t_juduldetail_delete->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $t_juduldetail_delete->RowCount ?>_t_juduldetail_kdjudul" class="t_juduldetail_kdjudul">
<span<?php echo $t_juduldetail_delete->kdjudul->viewAttributes() ?>><?php echo $t_juduldetail_delete->kdjudul->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_juduldetail_delete->kdkursil->Visible) { // kdkursil ?>
		<td <?php echo $t_juduldetail_delete->kdkursil->cellAttributes() ?>>
<span id="el<?php echo $t_juduldetail_delete->RowCount ?>_t_juduldetail_kdkursil" class="t_juduldetail_kdkursil">
<span<?php echo $t_juduldetail_delete->kdkursil->viewAttributes() ?>><?php echo $t_juduldetail_delete->kdkursil->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_juduldetail_delete->revisi->Visible) { // revisi ?>
		<td <?php echo $t_juduldetail_delete->revisi->cellAttributes() ?>>
<span id="el<?php echo $t_juduldetail_delete->RowCount ?>_t_juduldetail_revisi" class="t_juduldetail_revisi">
<span<?php echo $t_juduldetail_delete->revisi->viewAttributes() ?>><?php echo $t_juduldetail_delete->revisi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_juduldetail_delete->tgl_terbit->Visible) { // tgl_terbit ?>
		<td <?php echo $t_juduldetail_delete->tgl_terbit->cellAttributes() ?>>
<span id="el<?php echo $t_juduldetail_delete->RowCount ?>_t_juduldetail_tgl_terbit" class="t_juduldetail_tgl_terbit">
<span<?php echo $t_juduldetail_delete->tgl_terbit->viewAttributes() ?>><?php echo $t_juduldetail_delete->tgl_terbit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_juduldetail_delete->deskripsi_singkat->Visible) { // deskripsi_singkat ?>
		<td <?php echo $t_juduldetail_delete->deskripsi_singkat->cellAttributes() ?>>
<span id="el<?php echo $t_juduldetail_delete->RowCount ?>_t_juduldetail_deskripsi_singkat" class="t_juduldetail_deskripsi_singkat">
<span<?php echo $t_juduldetail_delete->deskripsi_singkat->viewAttributes() ?>><?php if (!EmptyString($t_juduldetail_delete->deskripsi_singkat->TooltipValue) && $t_juduldetail_delete->deskripsi_singkat->linkAttributes() != "") { ?>
<a<?php echo $t_juduldetail_delete->deskripsi_singkat->linkAttributes() ?>><?php echo $t_juduldetail_delete->deskripsi_singkat->getViewValue() ?></a>
<?php } else { ?>
<?php echo $t_juduldetail_delete->deskripsi_singkat->getViewValue() ?>
<?php } ?>
<span id="tt_t_juduldetail_x_deskripsi_singkat" class="d-none">
<?php echo $t_juduldetail_delete->deskripsi_singkat->TooltipValue ?>
</span></span>
</span>
</td>
<?php } ?>
<?php if ($t_juduldetail_delete->tujuan->Visible) { // tujuan ?>
		<td <?php echo $t_juduldetail_delete->tujuan->cellAttributes() ?>>
<span id="el<?php echo $t_juduldetail_delete->RowCount ?>_t_juduldetail_tujuan" class="t_juduldetail_tujuan">
<span<?php echo $t_juduldetail_delete->tujuan->viewAttributes() ?>><?php if (!EmptyString($t_juduldetail_delete->tujuan->TooltipValue) && $t_juduldetail_delete->tujuan->linkAttributes() != "") { ?>
<a<?php echo $t_juduldetail_delete->tujuan->linkAttributes() ?>><?php echo $t_juduldetail_delete->tujuan->getViewValue() ?></a>
<?php } else { ?>
<?php echo $t_juduldetail_delete->tujuan->getViewValue() ?>
<?php } ?>
<span id="tt_t_juduldetail_x_tujuan" class="d-none">
<?php echo $t_juduldetail_delete->tujuan->TooltipValue ?>
</span></span>
</span>
</td>
<?php } ?>
<?php if ($t_juduldetail_delete->target_peserta->Visible) { // target_peserta ?>
		<td <?php echo $t_juduldetail_delete->target_peserta->cellAttributes() ?>>
<span id="el<?php echo $t_juduldetail_delete->RowCount ?>_t_juduldetail_target_peserta" class="t_juduldetail_target_peserta">
<span<?php echo $t_juduldetail_delete->target_peserta->viewAttributes() ?>><?php if (!EmptyString($t_juduldetail_delete->target_peserta->TooltipValue) && $t_juduldetail_delete->target_peserta->linkAttributes() != "") { ?>
<a<?php echo $t_juduldetail_delete->target_peserta->linkAttributes() ?>><?php echo $t_juduldetail_delete->target_peserta->getViewValue() ?></a>
<?php } else { ?>
<?php echo $t_juduldetail_delete->target_peserta->getViewValue() ?>
<?php } ?>
<span id="tt_t_juduldetail_x_target_peserta" class="d-none">
<?php echo $t_juduldetail_delete->target_peserta->TooltipValue ?>
</span></span>
</span>
</td>
<?php } ?>
<?php if ($t_juduldetail_delete->lama_pelatihan->Visible) { // lama_pelatihan ?>
		<td <?php echo $t_juduldetail_delete->lama_pelatihan->cellAttributes() ?>>
<span id="el<?php echo $t_juduldetail_delete->RowCount ?>_t_juduldetail_lama_pelatihan" class="t_juduldetail_lama_pelatihan">
<span<?php echo $t_juduldetail_delete->lama_pelatihan->viewAttributes() ?>><?php echo $t_juduldetail_delete->lama_pelatihan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_juduldetail_delete->catatan->Visible) { // catatan ?>
		<td <?php echo $t_juduldetail_delete->catatan->cellAttributes() ?>>
<span id="el<?php echo $t_juduldetail_delete->RowCount ?>_t_juduldetail_catatan" class="t_juduldetail_catatan">
<span<?php echo $t_juduldetail_delete->catatan->viewAttributes() ?>><?php echo $t_juduldetail_delete->catatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_juduldetail_delete->Recordset->moveNext();
}
$t_juduldetail_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_juduldetail_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_juduldetail_delete->showPageFooter();
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
$t_juduldetail_delete->terminate();
?>