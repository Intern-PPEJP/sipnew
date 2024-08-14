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
$diklatkerjasama_view = new diklatkerjasama_view();

// Run the page
$diklatkerjasama_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$diklatkerjasama_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$diklatkerjasama_view->isExport()) { ?>
<script>
var fdiklatkerjasamaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdiklatkerjasamaview = currentForm = new ew.Form("fdiklatkerjasamaview", "view");
	loadjs.done("fdiklatkerjasamaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$diklatkerjasama_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $diklatkerjasama_view->ExportOptions->render("body") ?>
<?php $diklatkerjasama_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $diklatkerjasama_view->showPageHeader(); ?>
<?php
$diklatkerjasama_view->showMessage();
?>
<form name="fdiklatkerjasamaview" id="fdiklatkerjasamaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="diklatkerjasama">
<input type="hidden" name="modal" value="<?php echo (int)$diklatkerjasama_view->IsModal ?>">
<?php if (!$diklatkerjasama_view->isExport()) { ?>
<div class="ew-multi-page">
<div class="ew-nav-tabs" id="diklatkerjasama_view"><!-- multi-page tabs -->
	<ul class="<?php echo $diklatkerjasama_view->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $diklatkerjasama_view->MultiPages->pageStyle(1) ?>" href="#tab_diklatkerjasama1" data-toggle="tab"><?php echo $diklatkerjasama->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $diklatkerjasama_view->MultiPages->pageStyle(2) ?>" href="#tab_diklatkerjasama2" data-toggle="tab"><?php echo $diklatkerjasama->pageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if (!$diklatkerjasama_view->isExport()) { ?>
		<div class="tab-pane<?php echo $diklatkerjasama_view->MultiPages->pageStyle(1) ?>" id="tab_diklatkerjasama1"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($diklatkerjasama_view->idpelat->Visible) { // idpelat ?>
	<tr id="r_idpelat">
		<td class="<?php echo $diklatkerjasama_view->TableLeftColumnClass ?>"><span id="elh_diklatkerjasama_idpelat"><?php echo $diklatkerjasama_view->idpelat->caption() ?></span></td>
		<td data-name="idpelat" <?php echo $diklatkerjasama_view->idpelat->cellAttributes() ?>>
<span id="el_diklatkerjasama_idpelat" data-page="1">
<span<?php echo $diklatkerjasama_view->idpelat->viewAttributes() ?>><?php echo $diklatkerjasama_view->idpelat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatkerjasama_view->kdpelat->Visible) { // kdpelat ?>
	<tr id="r_kdpelat">
		<td class="<?php echo $diklatkerjasama_view->TableLeftColumnClass ?>"><span id="elh_diklatkerjasama_kdpelat"><?php echo $diklatkerjasama_view->kdpelat->caption() ?></span></td>
		<td data-name="kdpelat" <?php echo $diklatkerjasama_view->kdpelat->cellAttributes() ?>>
<span id="el_diklatkerjasama_kdpelat" data-page="1">
<span<?php echo $diklatkerjasama_view->kdpelat->viewAttributes() ?>><?php echo $diklatkerjasama_view->kdpelat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatkerjasama_view->kdjudul->Visible) { // kdjudul ?>
	<tr id="r_kdjudul">
		<td class="<?php echo $diklatkerjasama_view->TableLeftColumnClass ?>"><span id="elh_diklatkerjasama_kdjudul"><?php echo $diklatkerjasama_view->kdjudul->caption() ?></span></td>
		<td data-name="kdjudul" <?php echo $diklatkerjasama_view->kdjudul->cellAttributes() ?>>
<span id="el_diklatkerjasama_kdjudul" data-page="1">
<span<?php echo $diklatkerjasama_view->kdjudul->viewAttributes() ?>><?php echo $diklatkerjasama_view->kdjudul->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatkerjasama_view->kdkursil->Visible) { // kdkursil ?>
	<tr id="r_kdkursil">
		<td class="<?php echo $diklatkerjasama_view->TableLeftColumnClass ?>"><span id="elh_diklatkerjasama_kdkursil"><?php echo $diklatkerjasama_view->kdkursil->caption() ?></span></td>
		<td data-name="kdkursil" <?php echo $diklatkerjasama_view->kdkursil->cellAttributes() ?>>
<span id="el_diklatkerjasama_kdkursil" data-page="1">
<span<?php echo $diklatkerjasama_view->kdkursil->viewAttributes() ?>><?php echo $diklatkerjasama_view->kdkursil->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatkerjasama_view->tawal->Visible) { // tawal ?>
	<tr id="r_tawal">
		<td class="<?php echo $diklatkerjasama_view->TableLeftColumnClass ?>"><span id="elh_diklatkerjasama_tawal"><?php echo $diklatkerjasama_view->tawal->caption() ?></span></td>
		<td data-name="tawal" <?php echo $diklatkerjasama_view->tawal->cellAttributes() ?>>
<span id="el_diklatkerjasama_tawal" data-page="1">
<span<?php echo $diklatkerjasama_view->tawal->viewAttributes() ?>><?php echo $diklatkerjasama_view->tawal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatkerjasama_view->takhir->Visible) { // takhir ?>
	<tr id="r_takhir">
		<td class="<?php echo $diklatkerjasama_view->TableLeftColumnClass ?>"><span id="elh_diklatkerjasama_takhir"><?php echo $diklatkerjasama_view->takhir->caption() ?></span></td>
		<td data-name="takhir" <?php echo $diklatkerjasama_view->takhir->cellAttributes() ?>>
<span id="el_diklatkerjasama_takhir" data-page="1">
<span<?php echo $diklatkerjasama_view->takhir->viewAttributes() ?>><?php echo $diklatkerjasama_view->takhir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatkerjasama_view->jml_hari->Visible) { // jml_hari ?>
	<tr id="r_jml_hari">
		<td class="<?php echo $diklatkerjasama_view->TableLeftColumnClass ?>"><span id="elh_diklatkerjasama_jml_hari"><?php echo $diklatkerjasama_view->jml_hari->caption() ?></span></td>
		<td data-name="jml_hari" <?php echo $diklatkerjasama_view->jml_hari->cellAttributes() ?>>
<span id="el_diklatkerjasama_jml_hari" data-page="1">
<span<?php echo $diklatkerjasama_view->jml_hari->viewAttributes() ?>><?php echo $diklatkerjasama_view->jml_hari->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatkerjasama_view->targetpes->Visible) { // targetpes ?>
	<tr id="r_targetpes">
		<td class="<?php echo $diklatkerjasama_view->TableLeftColumnClass ?>"><span id="elh_diklatkerjasama_targetpes"><?php echo $diklatkerjasama_view->targetpes->caption() ?></span></td>
		<td data-name="targetpes" <?php echo $diklatkerjasama_view->targetpes->cellAttributes() ?>>
<span id="el_diklatkerjasama_targetpes" data-page="1">
<span<?php echo $diklatkerjasama_view->targetpes->viewAttributes() ?>><?php echo $diklatkerjasama_view->targetpes->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatkerjasama_view->kdprop->Visible) { // kdprop ?>
	<tr id="r_kdprop">
		<td class="<?php echo $diklatkerjasama_view->TableLeftColumnClass ?>"><span id="elh_diklatkerjasama_kdprop"><?php echo $diklatkerjasama_view->kdprop->caption() ?></span></td>
		<td data-name="kdprop" <?php echo $diklatkerjasama_view->kdprop->cellAttributes() ?>>
<span id="el_diklatkerjasama_kdprop" data-page="1">
<span<?php echo $diklatkerjasama_view->kdprop->viewAttributes() ?>><?php echo $diklatkerjasama_view->kdprop->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatkerjasama_view->kdkota->Visible) { // kdkota ?>
	<tr id="r_kdkota">
		<td class="<?php echo $diklatkerjasama_view->TableLeftColumnClass ?>"><span id="elh_diklatkerjasama_kdkota"><?php echo $diklatkerjasama_view->kdkota->caption() ?></span></td>
		<td data-name="kdkota" <?php echo $diklatkerjasama_view->kdkota->cellAttributes() ?>>
<span id="el_diklatkerjasama_kdkota" data-page="1">
<span<?php echo $diklatkerjasama_view->kdkota->viewAttributes() ?>><?php echo $diklatkerjasama_view->kdkota->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatkerjasama_view->tempat->Visible) { // tempat ?>
	<tr id="r_tempat">
		<td class="<?php echo $diklatkerjasama_view->TableLeftColumnClass ?>"><span id="elh_diklatkerjasama_tempat"><?php echo $diklatkerjasama_view->tempat->caption() ?></span></td>
		<td data-name="tempat" <?php echo $diklatkerjasama_view->tempat->cellAttributes() ?>>
<span id="el_diklatkerjasama_tempat" data-page="1">
<span<?php echo $diklatkerjasama_view->tempat->viewAttributes() ?>><?php echo $diklatkerjasama_view->tempat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatkerjasama_view->biaya->Visible) { // biaya ?>
	<tr id="r_biaya">
		<td class="<?php echo $diklatkerjasama_view->TableLeftColumnClass ?>"><span id="elh_diklatkerjasama_biaya"><?php echo $diklatkerjasama_view->biaya->caption() ?></span></td>
		<td data-name="biaya" <?php echo $diklatkerjasama_view->biaya->cellAttributes() ?>>
<span id="el_diklatkerjasama_biaya" data-page="1">
<span<?php echo $diklatkerjasama_view->biaya->viewAttributes() ?>><?php echo $diklatkerjasama_view->biaya->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatkerjasama_view->statuspel->Visible) { // statuspel ?>
	<tr id="r_statuspel">
		<td class="<?php echo $diklatkerjasama_view->TableLeftColumnClass ?>"><span id="elh_diklatkerjasama_statuspel"><?php echo $diklatkerjasama_view->statuspel->caption() ?></span></td>
		<td data-name="statuspel" <?php echo $diklatkerjasama_view->statuspel->cellAttributes() ?>>
<span id="el_diklatkerjasama_statuspel" data-page="1">
<span<?php echo $diklatkerjasama_view->statuspel->viewAttributes() ?>><?php echo $diklatkerjasama_view->statuspel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatkerjasama_view->jenisevaluasi->Visible) { // jenisevaluasi ?>
	<tr id="r_jenisevaluasi">
		<td class="<?php echo $diklatkerjasama_view->TableLeftColumnClass ?>"><span id="elh_diklatkerjasama_jenisevaluasi"><?php echo $diklatkerjasama_view->jenisevaluasi->caption() ?></span></td>
		<td data-name="jenisevaluasi" <?php echo $diklatkerjasama_view->jenisevaluasi->cellAttributes() ?>>
<span id="el_diklatkerjasama_jenisevaluasi" data-page="1">
<span<?php echo $diklatkerjasama_view->jenisevaluasi->viewAttributes() ?>><?php echo $diklatkerjasama_view->jenisevaluasi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$diklatkerjasama_view->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$diklatkerjasama_view->isExport()) { ?>
		<div class="tab-pane<?php echo $diklatkerjasama_view->MultiPages->pageStyle(2) ?>" id="tab_diklatkerjasama2"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($diklatkerjasama_view->ketua->Visible) { // ketua ?>
	<tr id="r_ketua">
		<td class="<?php echo $diklatkerjasama_view->TableLeftColumnClass ?>"><span id="elh_diklatkerjasama_ketua"><?php echo $diklatkerjasama_view->ketua->caption() ?></span></td>
		<td data-name="ketua" <?php echo $diklatkerjasama_view->ketua->cellAttributes() ?>>
<span id="el_diklatkerjasama_ketua" data-page="2">
<span<?php echo $diklatkerjasama_view->ketua->viewAttributes() ?>><?php echo $diklatkerjasama_view->ketua->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatkerjasama_view->sekretaris->Visible) { // sekretaris ?>
	<tr id="r_sekretaris">
		<td class="<?php echo $diklatkerjasama_view->TableLeftColumnClass ?>"><span id="elh_diklatkerjasama_sekretaris"><?php echo $diklatkerjasama_view->sekretaris->caption() ?></span></td>
		<td data-name="sekretaris" <?php echo $diklatkerjasama_view->sekretaris->cellAttributes() ?>>
<span id="el_diklatkerjasama_sekretaris" data-page="2">
<span<?php echo $diklatkerjasama_view->sekretaris->viewAttributes() ?>><?php echo $diklatkerjasama_view->sekretaris->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatkerjasama_view->bendahara->Visible) { // bendahara ?>
	<tr id="r_bendahara">
		<td class="<?php echo $diklatkerjasama_view->TableLeftColumnClass ?>"><span id="elh_diklatkerjasama_bendahara"><?php echo $diklatkerjasama_view->bendahara->caption() ?></span></td>
		<td data-name="bendahara" <?php echo $diklatkerjasama_view->bendahara->cellAttributes() ?>>
<span id="el_diklatkerjasama_bendahara" data-page="2">
<span<?php echo $diklatkerjasama_view->bendahara->viewAttributes() ?>><?php echo $diklatkerjasama_view->bendahara->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatkerjasama_view->anggota2->Visible) { // anggota2 ?>
	<tr id="r_anggota2">
		<td class="<?php echo $diklatkerjasama_view->TableLeftColumnClass ?>"><span id="elh_diklatkerjasama_anggota2"><?php echo $diklatkerjasama_view->anggota2->caption() ?></span></td>
		<td data-name="anggota2" <?php echo $diklatkerjasama_view->anggota2->cellAttributes() ?>>
<span id="el_diklatkerjasama_anggota2" data-page="2">
<span<?php echo $diklatkerjasama_view->anggota2->viewAttributes() ?>><?php echo $diklatkerjasama_view->anggota2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($diklatkerjasama_view->widyaiswara->Visible) { // widyaiswara ?>
	<tr id="r_widyaiswara">
		<td class="<?php echo $diklatkerjasama_view->TableLeftColumnClass ?>"><span id="elh_diklatkerjasama_widyaiswara"><?php echo $diklatkerjasama_view->widyaiswara->caption() ?></span></td>
		<td data-name="widyaiswara" <?php echo $diklatkerjasama_view->widyaiswara->cellAttributes() ?>>
<span id="el_diklatkerjasama_widyaiswara" data-page="2">
<span<?php echo $diklatkerjasama_view->widyaiswara->viewAttributes() ?>><?php echo $diklatkerjasama_view->widyaiswara->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$diklatkerjasama_view->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$diklatkerjasama_view->isExport()) { ?>
	</div>
</div>
</div>
<?php } ?>
</form>
<?php
$diklatkerjasama_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$diklatkerjasama_view->isExport()) { ?>
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
$diklatkerjasama_view->terminate();
?>