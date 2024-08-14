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
$diklatkerjasama_delete = new diklatkerjasama_delete();

// Run the page
$diklatkerjasama_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$diklatkerjasama_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdiklatkerjasamadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdiklatkerjasamadelete = currentForm = new ew.Form("fdiklatkerjasamadelete", "delete");
	loadjs.done("fdiklatkerjasamadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $diklatkerjasama_delete->showPageHeader(); ?>
<?php
$diklatkerjasama_delete->showMessage();
?>
<form name="fdiklatkerjasamadelete" id="fdiklatkerjasamadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="diklatkerjasama">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($diklatkerjasama_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($diklatkerjasama_delete->kdjudul->Visible) { // kdjudul ?>
		<th class="<?php echo $diklatkerjasama_delete->kdjudul->headerCellClass() ?>"><span id="elh_diklatkerjasama_kdjudul" class="diklatkerjasama_kdjudul"><?php echo $diklatkerjasama_delete->kdjudul->caption() ?></span></th>
<?php } ?>
<?php if ($diklatkerjasama_delete->kdkursil->Visible) { // kdkursil ?>
		<th class="<?php echo $diklatkerjasama_delete->kdkursil->headerCellClass() ?>"><span id="elh_diklatkerjasama_kdkursil" class="diklatkerjasama_kdkursil"><?php echo $diklatkerjasama_delete->kdkursil->caption() ?></span></th>
<?php } ?>
<?php if ($diklatkerjasama_delete->tawal->Visible) { // tawal ?>
		<th class="<?php echo $diklatkerjasama_delete->tawal->headerCellClass() ?>"><span id="elh_diklatkerjasama_tawal" class="diklatkerjasama_tawal"><?php echo $diklatkerjasama_delete->tawal->caption() ?></span></th>
<?php } ?>
<?php if ($diklatkerjasama_delete->takhir->Visible) { // takhir ?>
		<th class="<?php echo $diklatkerjasama_delete->takhir->headerCellClass() ?>"><span id="elh_diklatkerjasama_takhir" class="diklatkerjasama_takhir"><?php echo $diklatkerjasama_delete->takhir->caption() ?></span></th>
<?php } ?>
<?php if ($diklatkerjasama_delete->jml_hari->Visible) { // jml_hari ?>
		<th class="<?php echo $diklatkerjasama_delete->jml_hari->headerCellClass() ?>"><span id="elh_diklatkerjasama_jml_hari" class="diklatkerjasama_jml_hari"><?php echo $diklatkerjasama_delete->jml_hari->caption() ?></span></th>
<?php } ?>
<?php if ($diklatkerjasama_delete->targetpes->Visible) { // targetpes ?>
		<th class="<?php echo $diklatkerjasama_delete->targetpes->headerCellClass() ?>"><span id="elh_diklatkerjasama_targetpes" class="diklatkerjasama_targetpes"><?php echo $diklatkerjasama_delete->targetpes->caption() ?></span></th>
<?php } ?>
<?php if ($diklatkerjasama_delete->ketua->Visible) { // ketua ?>
		<th class="<?php echo $diklatkerjasama_delete->ketua->headerCellClass() ?>"><span id="elh_diklatkerjasama_ketua" class="diklatkerjasama_ketua"><?php echo $diklatkerjasama_delete->ketua->caption() ?></span></th>
<?php } ?>
<?php if ($diklatkerjasama_delete->sekretaris->Visible) { // sekretaris ?>
		<th class="<?php echo $diklatkerjasama_delete->sekretaris->headerCellClass() ?>"><span id="elh_diklatkerjasama_sekretaris" class="diklatkerjasama_sekretaris"><?php echo $diklatkerjasama_delete->sekretaris->caption() ?></span></th>
<?php } ?>
<?php if ($diklatkerjasama_delete->bendahara->Visible) { // bendahara ?>
		<th class="<?php echo $diklatkerjasama_delete->bendahara->headerCellClass() ?>"><span id="elh_diklatkerjasama_bendahara" class="diklatkerjasama_bendahara"><?php echo $diklatkerjasama_delete->bendahara->caption() ?></span></th>
<?php } ?>
<?php if ($diklatkerjasama_delete->anggota2->Visible) { // anggota2 ?>
		<th class="<?php echo $diklatkerjasama_delete->anggota2->headerCellClass() ?>"><span id="elh_diklatkerjasama_anggota2" class="diklatkerjasama_anggota2"><?php echo $diklatkerjasama_delete->anggota2->caption() ?></span></th>
<?php } ?>
<?php if ($diklatkerjasama_delete->widyaiswara->Visible) { // widyaiswara ?>
		<th class="<?php echo $diklatkerjasama_delete->widyaiswara->headerCellClass() ?>"><span id="elh_diklatkerjasama_widyaiswara" class="diklatkerjasama_widyaiswara"><?php echo $diklatkerjasama_delete->widyaiswara->caption() ?></span></th>
<?php } ?>
<?php if ($diklatkerjasama_delete->kdprop->Visible) { // kdprop ?>
		<th class="<?php echo $diklatkerjasama_delete->kdprop->headerCellClass() ?>"><span id="elh_diklatkerjasama_kdprop" class="diklatkerjasama_kdprop"><?php echo $diklatkerjasama_delete->kdprop->caption() ?></span></th>
<?php } ?>
<?php if ($diklatkerjasama_delete->kdkota->Visible) { // kdkota ?>
		<th class="<?php echo $diklatkerjasama_delete->kdkota->headerCellClass() ?>"><span id="elh_diklatkerjasama_kdkota" class="diklatkerjasama_kdkota"><?php echo $diklatkerjasama_delete->kdkota->caption() ?></span></th>
<?php } ?>
<?php if ($diklatkerjasama_delete->tempat->Visible) { // tempat ?>
		<th class="<?php echo $diklatkerjasama_delete->tempat->headerCellClass() ?>"><span id="elh_diklatkerjasama_tempat" class="diklatkerjasama_tempat"><?php echo $diklatkerjasama_delete->tempat->caption() ?></span></th>
<?php } ?>
<?php if ($diklatkerjasama_delete->biaya->Visible) { // biaya ?>
		<th class="<?php echo $diklatkerjasama_delete->biaya->headerCellClass() ?>"><span id="elh_diklatkerjasama_biaya" class="diklatkerjasama_biaya"><?php echo $diklatkerjasama_delete->biaya->caption() ?></span></th>
<?php } ?>
<?php if ($diklatkerjasama_delete->statuspel->Visible) { // statuspel ?>
		<th class="<?php echo $diklatkerjasama_delete->statuspel->headerCellClass() ?>"><span id="elh_diklatkerjasama_statuspel" class="diklatkerjasama_statuspel"><?php echo $diklatkerjasama_delete->statuspel->caption() ?></span></th>
<?php } ?>
<?php if ($diklatkerjasama_delete->jenisevaluasi->Visible) { // jenisevaluasi ?>
		<th class="<?php echo $diklatkerjasama_delete->jenisevaluasi->headerCellClass() ?>"><span id="elh_diklatkerjasama_jenisevaluasi" class="diklatkerjasama_jenisevaluasi"><?php echo $diklatkerjasama_delete->jenisevaluasi->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$diklatkerjasama_delete->RecordCount = 0;
$i = 0;
while (!$diklatkerjasama_delete->Recordset->EOF) {
	$diklatkerjasama_delete->RecordCount++;
	$diklatkerjasama_delete->RowCount++;

	// Set row properties
	$diklatkerjasama->resetAttributes();
	$diklatkerjasama->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$diklatkerjasama_delete->loadRowValues($diklatkerjasama_delete->Recordset);

	// Render row
	$diklatkerjasama_delete->renderRow();
?>
	<tr <?php echo $diklatkerjasama->rowAttributes() ?>>
<?php if ($diklatkerjasama_delete->kdjudul->Visible) { // kdjudul ?>
		<td <?php echo $diklatkerjasama_delete->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_delete->RowCount ?>_diklatkerjasama_kdjudul" class="diklatkerjasama_kdjudul">
<span<?php echo $diklatkerjasama_delete->kdjudul->viewAttributes() ?>><?php echo $diklatkerjasama_delete->kdjudul->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($diklatkerjasama_delete->kdkursil->Visible) { // kdkursil ?>
		<td <?php echo $diklatkerjasama_delete->kdkursil->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_delete->RowCount ?>_diklatkerjasama_kdkursil" class="diklatkerjasama_kdkursil">
<span<?php echo $diklatkerjasama_delete->kdkursil->viewAttributes() ?>><?php echo $diklatkerjasama_delete->kdkursil->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($diklatkerjasama_delete->tawal->Visible) { // tawal ?>
		<td <?php echo $diklatkerjasama_delete->tawal->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_delete->RowCount ?>_diklatkerjasama_tawal" class="diklatkerjasama_tawal">
<span<?php echo $diklatkerjasama_delete->tawal->viewAttributes() ?>><?php echo $diklatkerjasama_delete->tawal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($diklatkerjasama_delete->takhir->Visible) { // takhir ?>
		<td <?php echo $diklatkerjasama_delete->takhir->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_delete->RowCount ?>_diklatkerjasama_takhir" class="diklatkerjasama_takhir">
<span<?php echo $diklatkerjasama_delete->takhir->viewAttributes() ?>><?php echo $diklatkerjasama_delete->takhir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($diklatkerjasama_delete->jml_hari->Visible) { // jml_hari ?>
		<td <?php echo $diklatkerjasama_delete->jml_hari->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_delete->RowCount ?>_diklatkerjasama_jml_hari" class="diklatkerjasama_jml_hari">
<span<?php echo $diklatkerjasama_delete->jml_hari->viewAttributes() ?>><?php echo $diklatkerjasama_delete->jml_hari->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($diklatkerjasama_delete->targetpes->Visible) { // targetpes ?>
		<td <?php echo $diklatkerjasama_delete->targetpes->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_delete->RowCount ?>_diklatkerjasama_targetpes" class="diklatkerjasama_targetpes">
<span<?php echo $diklatkerjasama_delete->targetpes->viewAttributes() ?>><?php echo $diklatkerjasama_delete->targetpes->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($diklatkerjasama_delete->ketua->Visible) { // ketua ?>
		<td <?php echo $diklatkerjasama_delete->ketua->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_delete->RowCount ?>_diklatkerjasama_ketua" class="diklatkerjasama_ketua">
<span<?php echo $diklatkerjasama_delete->ketua->viewAttributes() ?>><?php echo $diklatkerjasama_delete->ketua->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($diklatkerjasama_delete->sekretaris->Visible) { // sekretaris ?>
		<td <?php echo $diklatkerjasama_delete->sekretaris->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_delete->RowCount ?>_diklatkerjasama_sekretaris" class="diklatkerjasama_sekretaris">
<span<?php echo $diklatkerjasama_delete->sekretaris->viewAttributes() ?>><?php echo $diklatkerjasama_delete->sekretaris->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($diklatkerjasama_delete->bendahara->Visible) { // bendahara ?>
		<td <?php echo $diklatkerjasama_delete->bendahara->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_delete->RowCount ?>_diklatkerjasama_bendahara" class="diklatkerjasama_bendahara">
<span<?php echo $diklatkerjasama_delete->bendahara->viewAttributes() ?>><?php echo $diklatkerjasama_delete->bendahara->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($diklatkerjasama_delete->anggota2->Visible) { // anggota2 ?>
		<td <?php echo $diklatkerjasama_delete->anggota2->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_delete->RowCount ?>_diklatkerjasama_anggota2" class="diklatkerjasama_anggota2">
<span<?php echo $diklatkerjasama_delete->anggota2->viewAttributes() ?>><?php echo $diklatkerjasama_delete->anggota2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($diklatkerjasama_delete->widyaiswara->Visible) { // widyaiswara ?>
		<td <?php echo $diklatkerjasama_delete->widyaiswara->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_delete->RowCount ?>_diklatkerjasama_widyaiswara" class="diklatkerjasama_widyaiswara">
<span<?php echo $diklatkerjasama_delete->widyaiswara->viewAttributes() ?>><?php echo $diklatkerjasama_delete->widyaiswara->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($diklatkerjasama_delete->kdprop->Visible) { // kdprop ?>
		<td <?php echo $diklatkerjasama_delete->kdprop->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_delete->RowCount ?>_diklatkerjasama_kdprop" class="diklatkerjasama_kdprop">
<span<?php echo $diklatkerjasama_delete->kdprop->viewAttributes() ?>><?php echo $diklatkerjasama_delete->kdprop->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($diklatkerjasama_delete->kdkota->Visible) { // kdkota ?>
		<td <?php echo $diklatkerjasama_delete->kdkota->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_delete->RowCount ?>_diklatkerjasama_kdkota" class="diklatkerjasama_kdkota">
<span<?php echo $diklatkerjasama_delete->kdkota->viewAttributes() ?>><?php echo $diklatkerjasama_delete->kdkota->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($diklatkerjasama_delete->tempat->Visible) { // tempat ?>
		<td <?php echo $diklatkerjasama_delete->tempat->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_delete->RowCount ?>_diklatkerjasama_tempat" class="diklatkerjasama_tempat">
<span<?php echo $diklatkerjasama_delete->tempat->viewAttributes() ?>><?php echo $diklatkerjasama_delete->tempat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($diklatkerjasama_delete->biaya->Visible) { // biaya ?>
		<td <?php echo $diklatkerjasama_delete->biaya->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_delete->RowCount ?>_diklatkerjasama_biaya" class="diklatkerjasama_biaya">
<span<?php echo $diklatkerjasama_delete->biaya->viewAttributes() ?>><?php echo $diklatkerjasama_delete->biaya->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($diklatkerjasama_delete->statuspel->Visible) { // statuspel ?>
		<td <?php echo $diklatkerjasama_delete->statuspel->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_delete->RowCount ?>_diklatkerjasama_statuspel" class="diklatkerjasama_statuspel">
<span<?php echo $diklatkerjasama_delete->statuspel->viewAttributes() ?>><?php echo $diklatkerjasama_delete->statuspel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($diklatkerjasama_delete->jenisevaluasi->Visible) { // jenisevaluasi ?>
		<td <?php echo $diklatkerjasama_delete->jenisevaluasi->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_delete->RowCount ?>_diklatkerjasama_jenisevaluasi" class="diklatkerjasama_jenisevaluasi">
<span<?php echo $diklatkerjasama_delete->jenisevaluasi->viewAttributes() ?>><?php echo $diklatkerjasama_delete->jenisevaluasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$diklatkerjasama_delete->Recordset->moveNext();
}
$diklatkerjasama_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $diklatkerjasama_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$diklatkerjasama_delete->showPageFooter();
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
$diklatkerjasama_delete->terminate();
?>