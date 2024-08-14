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
$t_pelatihan_delete = new t_pelatihan_delete();

// Run the page
$t_pelatihan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pelatihan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_pelatihandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_pelatihandelete = currentForm = new ew.Form("ft_pelatihandelete", "delete");
	loadjs.done("ft_pelatihandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_pelatihan_delete->showPageHeader(); ?>
<?php
$t_pelatihan_delete->showMessage();
?>
<form name="ft_pelatihandelete" id="ft_pelatihandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_pelatihan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_pelatihan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_pelatihan_delete->kdjudul->Visible) { // kdjudul ?>
		<th class="<?php echo $t_pelatihan_delete->kdjudul->headerCellClass() ?>"><span id="elh_t_pelatihan_kdjudul" class="t_pelatihan_kdjudul"><?php echo $t_pelatihan_delete->kdjudul->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->tawal->Visible) { // tawal ?>
		<th class="<?php echo $t_pelatihan_delete->tawal->headerCellClass() ?>"><span id="elh_t_pelatihan_tawal" class="t_pelatihan_tawal"><?php echo $t_pelatihan_delete->tawal->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->takhir->Visible) { // takhir ?>
		<th class="<?php echo $t_pelatihan_delete->takhir->headerCellClass() ?>"><span id="elh_t_pelatihan_takhir" class="t_pelatihan_takhir"><?php echo $t_pelatihan_delete->takhir->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->kdprop->Visible) { // kdprop ?>
		<th class="<?php echo $t_pelatihan_delete->kdprop->headerCellClass() ?>"><span id="elh_t_pelatihan_kdprop" class="t_pelatihan_kdprop"><?php echo $t_pelatihan_delete->kdprop->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->kdkota->Visible) { // kdkota ?>
		<th class="<?php echo $t_pelatihan_delete->kdkota->headerCellClass() ?>"><span id="elh_t_pelatihan_kdkota" class="t_pelatihan_kdkota"><?php echo $t_pelatihan_delete->kdkota->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->kdkec->Visible) { // kdkec ?>
		<th class="<?php echo $t_pelatihan_delete->kdkec->headerCellClass() ?>"><span id="elh_t_pelatihan_kdkec" class="t_pelatihan_kdkec"><?php echo $t_pelatihan_delete->kdkec->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->ketua->Visible) { // ketua ?>
		<th class="<?php echo $t_pelatihan_delete->ketua->headerCellClass() ?>"><span id="elh_t_pelatihan_ketua" class="t_pelatihan_ketua"><?php echo $t_pelatihan_delete->ketua->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->sekretaris->Visible) { // sekretaris ?>
		<th class="<?php echo $t_pelatihan_delete->sekretaris->headerCellClass() ?>"><span id="elh_t_pelatihan_sekretaris" class="t_pelatihan_sekretaris"><?php echo $t_pelatihan_delete->sekretaris->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->bendahara->Visible) { // bendahara ?>
		<th class="<?php echo $t_pelatihan_delete->bendahara->headerCellClass() ?>"><span id="elh_t_pelatihan_bendahara" class="t_pelatihan_bendahara"><?php echo $t_pelatihan_delete->bendahara->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->anggota2->Visible) { // anggota2 ?>
		<th class="<?php echo $t_pelatihan_delete->anggota2->headerCellClass() ?>"><span id="elh_t_pelatihan_anggota2" class="t_pelatihan_anggota2"><?php echo $t_pelatihan_delete->anggota2->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->widyaiswara->Visible) { // widyaiswara ?>
		<th class="<?php echo $t_pelatihan_delete->widyaiswara->headerCellClass() ?>"><span id="elh_t_pelatihan_widyaiswara" class="t_pelatihan_widyaiswara"><?php echo $t_pelatihan_delete->widyaiswara->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->jenispel->Visible) { // jenispel ?>
		<th class="<?php echo $t_pelatihan_delete->jenispel->headerCellClass() ?>"><span id="elh_t_pelatihan_jenispel" class="t_pelatihan_jenispel"><?php echo $t_pelatihan_delete->jenispel->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->kdkategori->Visible) { // kdkategori ?>
		<th class="<?php echo $t_pelatihan_delete->kdkategori->headerCellClass() ?>"><span id="elh_t_pelatihan_kdkategori" class="t_pelatihan_kdkategori"><?php echo $t_pelatihan_delete->kdkategori->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->kerjasama->Visible) { // kerjasama ?>
		<th class="<?php echo $t_pelatihan_delete->kerjasama->headerCellClass() ?>"><span id="elh_t_pelatihan_kerjasama" class="t_pelatihan_kerjasama"><?php echo $t_pelatihan_delete->kerjasama->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->biaya->Visible) { // biaya ?>
		<th class="<?php echo $t_pelatihan_delete->biaya->headerCellClass() ?>"><span id="elh_t_pelatihan_biaya" class="t_pelatihan_biaya"><?php echo $t_pelatihan_delete->biaya->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->coachingprogr->Visible) { // coachingprogr ?>
		<th class="<?php echo $t_pelatihan_delete->coachingprogr->headerCellClass() ?>"><span id="elh_t_pelatihan_coachingprogr" class="t_pelatihan_coachingprogr"><?php echo $t_pelatihan_delete->coachingprogr->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->area->Visible) { // area ?>
		<th class="<?php echo $t_pelatihan_delete->area->headerCellClass() ?>"><span id="elh_t_pelatihan_area" class="t_pelatihan_area"><?php echo $t_pelatihan_delete->area->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->periode_awal->Visible) { // periode_awal ?>
		<th class="<?php echo $t_pelatihan_delete->periode_awal->headerCellClass() ?>"><span id="elh_t_pelatihan_periode_awal" class="t_pelatihan_periode_awal"><?php echo $t_pelatihan_delete->periode_awal->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->periode_akhir->Visible) { // periode_akhir ?>
		<th class="<?php echo $t_pelatihan_delete->periode_akhir->headerCellClass() ?>"><span id="elh_t_pelatihan_periode_akhir" class="t_pelatihan_periode_akhir"><?php echo $t_pelatihan_delete->periode_akhir->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->tahapan->Visible) { // tahapan ?>
		<th class="<?php echo $t_pelatihan_delete->tahapan->headerCellClass() ?>"><span id="elh_t_pelatihan_tahapan" class="t_pelatihan_tahapan"><?php echo $t_pelatihan_delete->tahapan->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->namaberkas->Visible) { // namaberkas ?>
		<th class="<?php echo $t_pelatihan_delete->namaberkas->headerCellClass() ?>"><span id="elh_t_pelatihan_namaberkas" class="t_pelatihan_namaberkas"><?php echo $t_pelatihan_delete->namaberkas->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->instruktur->Visible) { // instruktur ?>
		<th class="<?php echo $t_pelatihan_delete->instruktur->headerCellClass() ?>"><span id="elh_t_pelatihan_instruktur" class="t_pelatihan_instruktur"><?php echo $t_pelatihan_delete->instruktur->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->jpeserta->Visible) { // jpeserta ?>
		<th class="<?php echo $t_pelatihan_delete->jpeserta->headerCellClass() ?>"><span id="elh_t_pelatihan_jpeserta" class="t_pelatihan_jpeserta"><?php echo $t_pelatihan_delete->jpeserta->caption() ?></span></th>
<?php } ?>
<?php if ($t_pelatihan_delete->Tahun->Visible) { // Tahun ?>
		<th class="<?php echo $t_pelatihan_delete->Tahun->headerCellClass() ?>"><span id="elh_t_pelatihan_Tahun" class="t_pelatihan_Tahun"><?php echo $t_pelatihan_delete->Tahun->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_pelatihan_delete->RecordCount = 0;
$i = 0;
while (!$t_pelatihan_delete->Recordset->EOF) {
	$t_pelatihan_delete->RecordCount++;
	$t_pelatihan_delete->RowCount++;

	// Set row properties
	$t_pelatihan->resetAttributes();
	$t_pelatihan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_pelatihan_delete->loadRowValues($t_pelatihan_delete->Recordset);

	// Render row
	$t_pelatihan_delete->renderRow();
?>
	<tr <?php echo $t_pelatihan->rowAttributes() ?>>
<?php if ($t_pelatihan_delete->kdjudul->Visible) { // kdjudul ?>
		<td <?php echo $t_pelatihan_delete->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_kdjudul" class="t_pelatihan_kdjudul">
<span<?php echo $t_pelatihan_delete->kdjudul->viewAttributes() ?>><?php echo $t_pelatihan_delete->kdjudul->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->tawal->Visible) { // tawal ?>
		<td <?php echo $t_pelatihan_delete->tawal->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_tawal" class="t_pelatihan_tawal">
<span<?php echo $t_pelatihan_delete->tawal->viewAttributes() ?>><?php echo $t_pelatihan_delete->tawal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->takhir->Visible) { // takhir ?>
		<td <?php echo $t_pelatihan_delete->takhir->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_takhir" class="t_pelatihan_takhir">
<span<?php echo $t_pelatihan_delete->takhir->viewAttributes() ?>><?php echo $t_pelatihan_delete->takhir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->kdprop->Visible) { // kdprop ?>
		<td <?php echo $t_pelatihan_delete->kdprop->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_kdprop" class="t_pelatihan_kdprop">
<span<?php echo $t_pelatihan_delete->kdprop->viewAttributes() ?>><?php echo $t_pelatihan_delete->kdprop->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->kdkota->Visible) { // kdkota ?>
		<td <?php echo $t_pelatihan_delete->kdkota->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_kdkota" class="t_pelatihan_kdkota">
<span<?php echo $t_pelatihan_delete->kdkota->viewAttributes() ?>><?php echo $t_pelatihan_delete->kdkota->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->kdkec->Visible) { // kdkec ?>
		<td <?php echo $t_pelatihan_delete->kdkec->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_kdkec" class="t_pelatihan_kdkec">
<span<?php echo $t_pelatihan_delete->kdkec->viewAttributes() ?>><?php echo $t_pelatihan_delete->kdkec->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->ketua->Visible) { // ketua ?>
		<td <?php echo $t_pelatihan_delete->ketua->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_ketua" class="t_pelatihan_ketua">
<span<?php echo $t_pelatihan_delete->ketua->viewAttributes() ?>><?php echo $t_pelatihan_delete->ketua->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->sekretaris->Visible) { // sekretaris ?>
		<td <?php echo $t_pelatihan_delete->sekretaris->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_sekretaris" class="t_pelatihan_sekretaris">
<span<?php echo $t_pelatihan_delete->sekretaris->viewAttributes() ?>><?php echo $t_pelatihan_delete->sekretaris->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->bendahara->Visible) { // bendahara ?>
		<td <?php echo $t_pelatihan_delete->bendahara->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_bendahara" class="t_pelatihan_bendahara">
<span<?php echo $t_pelatihan_delete->bendahara->viewAttributes() ?>><?php echo $t_pelatihan_delete->bendahara->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->anggota2->Visible) { // anggota2 ?>
		<td <?php echo $t_pelatihan_delete->anggota2->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_anggota2" class="t_pelatihan_anggota2">
<span<?php echo $t_pelatihan_delete->anggota2->viewAttributes() ?>><?php echo $t_pelatihan_delete->anggota2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->widyaiswara->Visible) { // widyaiswara ?>
		<td <?php echo $t_pelatihan_delete->widyaiswara->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_widyaiswara" class="t_pelatihan_widyaiswara">
<span<?php echo $t_pelatihan_delete->widyaiswara->viewAttributes() ?>><?php echo $t_pelatihan_delete->widyaiswara->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->jenispel->Visible) { // jenispel ?>
		<td <?php echo $t_pelatihan_delete->jenispel->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_jenispel" class="t_pelatihan_jenispel">
<span<?php echo $t_pelatihan_delete->jenispel->viewAttributes() ?>><?php echo $t_pelatihan_delete->jenispel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->kdkategori->Visible) { // kdkategori ?>
		<td <?php echo $t_pelatihan_delete->kdkategori->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_kdkategori" class="t_pelatihan_kdkategori">
<span<?php echo $t_pelatihan_delete->kdkategori->viewAttributes() ?>><?php echo $t_pelatihan_delete->kdkategori->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->kerjasama->Visible) { // kerjasama ?>
		<td <?php echo $t_pelatihan_delete->kerjasama->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_kerjasama" class="t_pelatihan_kerjasama">
<span<?php echo $t_pelatihan_delete->kerjasama->viewAttributes() ?>><?php echo $t_pelatihan_delete->kerjasama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->biaya->Visible) { // biaya ?>
		<td <?php echo $t_pelatihan_delete->biaya->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_biaya" class="t_pelatihan_biaya">
<span<?php echo $t_pelatihan_delete->biaya->viewAttributes() ?>><?php echo $t_pelatihan_delete->biaya->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->coachingprogr->Visible) { // coachingprogr ?>
		<td <?php echo $t_pelatihan_delete->coachingprogr->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_coachingprogr" class="t_pelatihan_coachingprogr">
<span<?php echo $t_pelatihan_delete->coachingprogr->viewAttributes() ?>><?php echo $t_pelatihan_delete->coachingprogr->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->area->Visible) { // area ?>
		<td <?php echo $t_pelatihan_delete->area->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_area" class="t_pelatihan_area">
<span<?php echo $t_pelatihan_delete->area->viewAttributes() ?>><?php echo $t_pelatihan_delete->area->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->periode_awal->Visible) { // periode_awal ?>
		<td <?php echo $t_pelatihan_delete->periode_awal->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_periode_awal" class="t_pelatihan_periode_awal">
<span<?php echo $t_pelatihan_delete->periode_awal->viewAttributes() ?>><?php echo $t_pelatihan_delete->periode_awal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->periode_akhir->Visible) { // periode_akhir ?>
		<td <?php echo $t_pelatihan_delete->periode_akhir->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_periode_akhir" class="t_pelatihan_periode_akhir">
<span<?php echo $t_pelatihan_delete->periode_akhir->viewAttributes() ?>><?php echo $t_pelatihan_delete->periode_akhir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->tahapan->Visible) { // tahapan ?>
		<td <?php echo $t_pelatihan_delete->tahapan->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_tahapan" class="t_pelatihan_tahapan">
<span<?php echo $t_pelatihan_delete->tahapan->viewAttributes() ?>><?php echo $t_pelatihan_delete->tahapan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->namaberkas->Visible) { // namaberkas ?>
		<td <?php echo $t_pelatihan_delete->namaberkas->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_namaberkas" class="t_pelatihan_namaberkas">
<span<?php echo $t_pelatihan_delete->namaberkas->viewAttributes() ?>><?php echo GetFileViewTag($t_pelatihan_delete->namaberkas, $t_pelatihan_delete->namaberkas->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->instruktur->Visible) { // instruktur ?>
		<td <?php echo $t_pelatihan_delete->instruktur->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_instruktur" class="t_pelatihan_instruktur">
<span<?php echo $t_pelatihan_delete->instruktur->viewAttributes() ?>><?php echo $t_pelatihan_delete->instruktur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->jpeserta->Visible) { // jpeserta ?>
		<td <?php echo $t_pelatihan_delete->jpeserta->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_jpeserta" class="t_pelatihan_jpeserta">
<span<?php echo $t_pelatihan_delete->jpeserta->viewAttributes() ?>><?php echo $t_pelatihan_delete->jpeserta->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pelatihan_delete->Tahun->Visible) { // Tahun ?>
		<td <?php echo $t_pelatihan_delete->Tahun->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_delete->RowCount ?>_t_pelatihan_Tahun" class="t_pelatihan_Tahun">
<span<?php echo $t_pelatihan_delete->Tahun->viewAttributes() ?>><?php echo $t_pelatihan_delete->Tahun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_pelatihan_delete->Recordset->moveNext();
}
$t_pelatihan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_pelatihan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_pelatihan_delete->showPageFooter();
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
$t_pelatihan_delete->terminate();
?>