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
$evaluasi_view = new evaluasi_view();

// Run the page
$evaluasi_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$evaluasi_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$evaluasi_view->isExport()) { ?>
<script>
var fevaluasiview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fevaluasiview = currentForm = new ew.Form("fevaluasiview", "view");
	loadjs.done("fevaluasiview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$evaluasi_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $evaluasi_view->ExportOptions->render("body") ?>
<?php $evaluasi_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $evaluasi_view->showPageHeader(); ?>
<?php
$evaluasi_view->showMessage();
?>
<form name="fevaluasiview" id="fevaluasiview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="evaluasi">
<input type="hidden" name="modal" value="<?php echo (int)$evaluasi_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($evaluasi_view->th->Visible) { // th ?>
	<tr id="r_th">
		<td class="<?php echo $evaluasi_view->TableLeftColumnClass ?>"><span id="elh_evaluasi_th"><?php echo $evaluasi_view->th->caption() ?></span></td>
		<td data-name="th" <?php echo $evaluasi_view->th->cellAttributes() ?>>
<span id="el_evaluasi_th">
<span<?php echo $evaluasi_view->th->viewAttributes() ?>><?php echo $evaluasi_view->th->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($evaluasi_view->idpelat->Visible) { // idpelat ?>
	<tr id="r_idpelat">
		<td class="<?php echo $evaluasi_view->TableLeftColumnClass ?>"><span id="elh_evaluasi_idpelat"><?php echo $evaluasi_view->idpelat->caption() ?></span></td>
		<td data-name="idpelat" <?php echo $evaluasi_view->idpelat->cellAttributes() ?>>
<span id="el_evaluasi_idpelat">
<span<?php echo $evaluasi_view->idpelat->viewAttributes() ?>><?php echo $evaluasi_view->idpelat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($evaluasi_view->kdpelat->Visible) { // kdpelat ?>
	<tr id="r_kdpelat">
		<td class="<?php echo $evaluasi_view->TableLeftColumnClass ?>"><span id="elh_evaluasi_kdpelat"><?php echo $evaluasi_view->kdpelat->caption() ?></span></td>
		<td data-name="kdpelat" <?php echo $evaluasi_view->kdpelat->cellAttributes() ?>>
<span id="el_evaluasi_kdpelat">
<span<?php echo $evaluasi_view->kdpelat->viewAttributes() ?>><?php echo $evaluasi_view->kdpelat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($evaluasi_view->kdjudul->Visible) { // kdjudul ?>
	<tr id="r_kdjudul">
		<td class="<?php echo $evaluasi_view->TableLeftColumnClass ?>"><span id="elh_evaluasi_kdjudul"><?php echo $evaluasi_view->kdjudul->caption() ?></span></td>
		<td data-name="kdjudul" <?php echo $evaluasi_view->kdjudul->cellAttributes() ?>>
<span id="el_evaluasi_kdjudul">
<span<?php echo $evaluasi_view->kdjudul->viewAttributes() ?>><?php echo $evaluasi_view->kdjudul->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($evaluasi_view->tawal->Visible) { // tawal ?>
	<tr id="r_tawal">
		<td class="<?php echo $evaluasi_view->TableLeftColumnClass ?>"><span id="elh_evaluasi_tawal"><?php echo $evaluasi_view->tawal->caption() ?></span></td>
		<td data-name="tawal" <?php echo $evaluasi_view->tawal->cellAttributes() ?>>
<span id="el_evaluasi_tawal">
<span<?php echo $evaluasi_view->tawal->viewAttributes() ?>><?php echo $evaluasi_view->tawal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($evaluasi_view->takhir->Visible) { // takhir ?>
	<tr id="r_takhir">
		<td class="<?php echo $evaluasi_view->TableLeftColumnClass ?>"><span id="elh_evaluasi_takhir"><?php echo $evaluasi_view->takhir->caption() ?></span></td>
		<td data-name="takhir" <?php echo $evaluasi_view->takhir->cellAttributes() ?>>
<span id="el_evaluasi_takhir">
<span<?php echo $evaluasi_view->takhir->viewAttributes() ?>><?php echo $evaluasi_view->takhir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($evaluasi_view->ketua->Visible) { // ketua ?>
	<tr id="r_ketua">
		<td class="<?php echo $evaluasi_view->TableLeftColumnClass ?>"><span id="elh_evaluasi_ketua"><?php echo $evaluasi_view->ketua->caption() ?></span></td>
		<td data-name="ketua" <?php echo $evaluasi_view->ketua->cellAttributes() ?>>
<span id="el_evaluasi_ketua">
<span<?php echo $evaluasi_view->ketua->viewAttributes() ?>><?php echo $evaluasi_view->ketua->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($evaluasi_view->sekretaris->Visible) { // sekretaris ?>
	<tr id="r_sekretaris">
		<td class="<?php echo $evaluasi_view->TableLeftColumnClass ?>"><span id="elh_evaluasi_sekretaris"><?php echo $evaluasi_view->sekretaris->caption() ?></span></td>
		<td data-name="sekretaris" <?php echo $evaluasi_view->sekretaris->cellAttributes() ?>>
<span id="el_evaluasi_sekretaris">
<span<?php echo $evaluasi_view->sekretaris->viewAttributes() ?>><?php echo $evaluasi_view->sekretaris->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($evaluasi_view->bendahara->Visible) { // bendahara ?>
	<tr id="r_bendahara">
		<td class="<?php echo $evaluasi_view->TableLeftColumnClass ?>"><span id="elh_evaluasi_bendahara"><?php echo $evaluasi_view->bendahara->caption() ?></span></td>
		<td data-name="bendahara" <?php echo $evaluasi_view->bendahara->cellAttributes() ?>>
<span id="el_evaluasi_bendahara">
<span<?php echo $evaluasi_view->bendahara->viewAttributes() ?>><?php echo $evaluasi_view->bendahara->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($evaluasi_view->anggota2->Visible) { // anggota2 ?>
	<tr id="r_anggota2">
		<td class="<?php echo $evaluasi_view->TableLeftColumnClass ?>"><span id="elh_evaluasi_anggota2"><?php echo $evaluasi_view->anggota2->caption() ?></span></td>
		<td data-name="anggota2" <?php echo $evaluasi_view->anggota2->cellAttributes() ?>>
<span id="el_evaluasi_anggota2">
<span<?php echo $evaluasi_view->anggota2->viewAttributes() ?>><?php echo $evaluasi_view->anggota2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($evaluasi_view->widyaiswara->Visible) { // widyaiswara ?>
	<tr id="r_widyaiswara">
		<td class="<?php echo $evaluasi_view->TableLeftColumnClass ?>"><span id="elh_evaluasi_widyaiswara"><?php echo $evaluasi_view->widyaiswara->caption() ?></span></td>
		<td data-name="widyaiswara" <?php echo $evaluasi_view->widyaiswara->cellAttributes() ?>>
<span id="el_evaluasi_widyaiswara">
<span<?php echo $evaluasi_view->widyaiswara->viewAttributes() ?>><?php echo $evaluasi_view->widyaiswara->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($evaluasi_view->tglpel->Visible) { // tglpel ?>
	<tr id="r_tglpel">
		<td class="<?php echo $evaluasi_view->TableLeftColumnClass ?>"><span id="elh_evaluasi_tglpel"><?php echo $evaluasi_view->tglpel->caption() ?></span></td>
		<td data-name="tglpel" <?php echo $evaluasi_view->tglpel->cellAttributes() ?>>
<span id="el_evaluasi_tglpel">
<span<?php echo $evaluasi_view->tglpel->viewAttributes() ?>><?php echo $evaluasi_view->tglpel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($evaluasi_view->panitia->Visible) { // panitia ?>
	<tr id="r_panitia">
		<td class="<?php echo $evaluasi_view->TableLeftColumnClass ?>"><span id="elh_evaluasi_panitia"><?php echo $evaluasi_view->panitia->caption() ?></span></td>
		<td data-name="panitia" <?php echo $evaluasi_view->panitia->cellAttributes() ?>>
<span id="el_evaluasi_panitia">
<span<?php echo $evaluasi_view->panitia->viewAttributes() ?>><?php echo $evaluasi_view->panitia->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($evaluasi_view->jenisevaluasi->Visible) { // jenisevaluasi ?>
	<tr id="r_jenisevaluasi">
		<td class="<?php echo $evaluasi_view->TableLeftColumnClass ?>"><span id="elh_evaluasi_jenisevaluasi"><?php echo $evaluasi_view->jenisevaluasi->caption() ?></span></td>
		<td data-name="jenisevaluasi" <?php echo $evaluasi_view->jenisevaluasi->cellAttributes() ?>>
<span id="el_evaluasi_jenisevaluasi">
<span<?php echo $evaluasi_view->jenisevaluasi->viewAttributes() ?>><?php echo $evaluasi_view->jenisevaluasi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$evaluasi_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$evaluasi_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$evaluasi_view->terminate();
?>