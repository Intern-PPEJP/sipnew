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
$t_pelatihan_view = new t_pelatihan_view();

// Run the page
$t_pelatihan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pelatihan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_pelatihan_view->isExport()) { ?>
<script>
var ft_pelatihanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ft_pelatihanview = currentForm = new ew.Form("ft_pelatihanview", "view");
	loadjs.done("ft_pelatihanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//document.write('<?php echo cs_judul("view","Pelatihan : View Data");?>');

});
</script>
<?php } ?>
<?php if (!$t_pelatihan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_pelatihan_view->ExportOptions->render("body") ?>
<?php $t_pelatihan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_pelatihan_view->showPageHeader(); ?>
<?php
$t_pelatihan_view->showMessage();
?>
<form name="ft_pelatihanview" id="ft_pelatihanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_pelatihan">
<input type="hidden" name="modal" value="<?php echo (int)$t_pelatihan_view->IsModal ?>">
<?php if (!$t_pelatihan_view->isExport()) { ?>
<div class="ew-multi-page">
<div class="ew-nav-tabs" id="t_pelatihan_view"><!-- multi-page tabs -->
	<ul class="<?php echo $t_pelatihan_view->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $t_pelatihan_view->MultiPages->pageStyle(1) ?>" href="#tab_t_pelatihan1" data-toggle="tab"><?php echo $t_pelatihan->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $t_pelatihan_view->MultiPages->pageStyle(2) ?>" href="#tab_t_pelatihan2" data-toggle="tab"><?php echo $t_pelatihan->pageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if (!$t_pelatihan_view->isExport()) { ?>
		<div class="tab-pane<?php echo $t_pelatihan_view->MultiPages->pageStyle(1) ?>" id="tab_t_pelatihan1"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_pelatihan_view->idpelat->Visible) { // idpelat ?>
	<tr id="r_idpelat">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_idpelat"><?php echo $t_pelatihan_view->idpelat->caption() ?></span></td>
		<td data-name="idpelat" <?php echo $t_pelatihan_view->idpelat->cellAttributes() ?>>
<span id="el_t_pelatihan_idpelat" data-page="1">
<span<?php echo $t_pelatihan_view->idpelat->viewAttributes() ?>><?php echo $t_pelatihan_view->idpelat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->kdpelat->Visible) { // kdpelat ?>
	<tr id="r_kdpelat">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_kdpelat"><?php echo $t_pelatihan_view->kdpelat->caption() ?></span></td>
		<td data-name="kdpelat" <?php echo $t_pelatihan_view->kdpelat->cellAttributes() ?>>
<span id="el_t_pelatihan_kdpelat" data-page="1">
<span<?php echo $t_pelatihan_view->kdpelat->viewAttributes() ?>><?php echo $t_pelatihan_view->kdpelat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->kdjudul->Visible) { // kdjudul ?>
	<tr id="r_kdjudul">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_kdjudul"><?php echo $t_pelatihan_view->kdjudul->caption() ?></span></td>
		<td data-name="kdjudul" <?php echo $t_pelatihan_view->kdjudul->cellAttributes() ?>>
<span id="el_t_pelatihan_kdjudul" data-page="1">
<span<?php echo $t_pelatihan_view->kdjudul->viewAttributes() ?>><?php echo $t_pelatihan_view->kdjudul->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->kdkursil->Visible) { // kdkursil ?>
	<tr id="r_kdkursil">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_kdkursil"><?php echo $t_pelatihan_view->kdkursil->caption() ?></span></td>
		<td data-name="kdkursil" <?php echo $t_pelatihan_view->kdkursil->cellAttributes() ?>>
<span id="el_t_pelatihan_kdkursil" data-page="1">
<span<?php echo $t_pelatihan_view->kdkursil->viewAttributes() ?>><?php echo $t_pelatihan_view->kdkursil->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->revisi->Visible) { // revisi ?>
	<tr id="r_revisi">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_revisi"><?php echo $t_pelatihan_view->revisi->caption() ?></span></td>
		<td data-name="revisi" <?php echo $t_pelatihan_view->revisi->cellAttributes() ?>>
<span id="el_t_pelatihan_revisi" data-page="1">
<span<?php echo $t_pelatihan_view->revisi->viewAttributes() ?>><?php echo $t_pelatihan_view->revisi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->tgl_terbit->Visible) { // tgl_terbit ?>
	<tr id="r_tgl_terbit">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_tgl_terbit"><?php echo $t_pelatihan_view->tgl_terbit->caption() ?></span></td>
		<td data-name="tgl_terbit" <?php echo $t_pelatihan_view->tgl_terbit->cellAttributes() ?>>
<span id="el_t_pelatihan_tgl_terbit" data-page="1">
<span<?php echo $t_pelatihan_view->tgl_terbit->viewAttributes() ?>><?php echo $t_pelatihan_view->tgl_terbit->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->pilihan_iso->Visible) { // pilihan_iso ?>
	<tr id="r_pilihan_iso">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_pilihan_iso"><?php echo $t_pelatihan_view->pilihan_iso->caption() ?></span></td>
		<td data-name="pilihan_iso" <?php echo $t_pelatihan_view->pilihan_iso->cellAttributes() ?>>
<span id="el_t_pelatihan_pilihan_iso" data-page="1">
<span<?php echo $t_pelatihan_view->pilihan_iso->viewAttributes() ?>><?php echo $t_pelatihan_view->pilihan_iso->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->tawal->Visible) { // tawal ?>
	<tr id="r_tawal">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_tawal"><?php echo $t_pelatihan_view->tawal->caption() ?></span></td>
		<td data-name="tawal" <?php echo $t_pelatihan_view->tawal->cellAttributes() ?>>
<span id="el_t_pelatihan_tawal" data-page="1">
<span<?php echo $t_pelatihan_view->tawal->viewAttributes() ?>><?php echo $t_pelatihan_view->tawal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->takhir->Visible) { // takhir ?>
	<tr id="r_takhir">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_takhir"><?php echo $t_pelatihan_view->takhir->caption() ?></span></td>
		<td data-name="takhir" <?php echo $t_pelatihan_view->takhir->cellAttributes() ?>>
<span id="el_t_pelatihan_takhir" data-page="1">
<span<?php echo $t_pelatihan_view->takhir->viewAttributes() ?>><?php echo $t_pelatihan_view->takhir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->kdprop->Visible) { // kdprop ?>
	<tr id="r_kdprop">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_kdprop"><?php echo $t_pelatihan_view->kdprop->caption() ?></span></td>
		<td data-name="kdprop" <?php echo $t_pelatihan_view->kdprop->cellAttributes() ?>>
<span id="el_t_pelatihan_kdprop" data-page="1">
<span<?php echo $t_pelatihan_view->kdprop->viewAttributes() ?>><?php echo $t_pelatihan_view->kdprop->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->kdkota->Visible) { // kdkota ?>
	<tr id="r_kdkota">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_kdkota"><?php echo $t_pelatihan_view->kdkota->caption() ?></span></td>
		<td data-name="kdkota" <?php echo $t_pelatihan_view->kdkota->cellAttributes() ?>>
<span id="el_t_pelatihan_kdkota" data-page="1">
<span<?php echo $t_pelatihan_view->kdkota->viewAttributes() ?>><?php echo $t_pelatihan_view->kdkota->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->kdkec->Visible) { // kdkec ?>
	<tr id="r_kdkec">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_kdkec"><?php echo $t_pelatihan_view->kdkec->caption() ?></span></td>
		<td data-name="kdkec" <?php echo $t_pelatihan_view->kdkec->cellAttributes() ?>>
<span id="el_t_pelatihan_kdkec" data-page="1">
<span<?php echo $t_pelatihan_view->kdkec->viewAttributes() ?>><?php echo $t_pelatihan_view->kdkec->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->ketua->Visible) { // ketua ?>
	<tr id="r_ketua">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_ketua"><?php echo $t_pelatihan_view->ketua->caption() ?></span></td>
		<td data-name="ketua" <?php echo $t_pelatihan_view->ketua->cellAttributes() ?>>
<span id="el_t_pelatihan_ketua" data-page="1">
<span<?php echo $t_pelatihan_view->ketua->viewAttributes() ?>><?php echo $t_pelatihan_view->ketua->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->sekretaris->Visible) { // sekretaris ?>
	<tr id="r_sekretaris">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_sekretaris"><?php echo $t_pelatihan_view->sekretaris->caption() ?></span></td>
		<td data-name="sekretaris" <?php echo $t_pelatihan_view->sekretaris->cellAttributes() ?>>
<span id="el_t_pelatihan_sekretaris" data-page="1">
<span<?php echo $t_pelatihan_view->sekretaris->viewAttributes() ?>><?php echo $t_pelatihan_view->sekretaris->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->bendahara->Visible) { // bendahara ?>
	<tr id="r_bendahara">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_bendahara"><?php echo $t_pelatihan_view->bendahara->caption() ?></span></td>
		<td data-name="bendahara" <?php echo $t_pelatihan_view->bendahara->cellAttributes() ?>>
<span id="el_t_pelatihan_bendahara" data-page="1">
<span<?php echo $t_pelatihan_view->bendahara->viewAttributes() ?>><?php echo $t_pelatihan_view->bendahara->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->anggota2->Visible) { // anggota2 ?>
	<tr id="r_anggota2">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_anggota2"><?php echo $t_pelatihan_view->anggota2->caption() ?></span></td>
		<td data-name="anggota2" <?php echo $t_pelatihan_view->anggota2->cellAttributes() ?>>
<span id="el_t_pelatihan_anggota2" data-page="1">
<span<?php echo $t_pelatihan_view->anggota2->viewAttributes() ?>><?php echo $t_pelatihan_view->anggota2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->widyaiswara->Visible) { // widyaiswara ?>
	<tr id="r_widyaiswara">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_widyaiswara"><?php echo $t_pelatihan_view->widyaiswara->caption() ?></span></td>
		<td data-name="widyaiswara" <?php echo $t_pelatihan_view->widyaiswara->cellAttributes() ?>>
<span id="el_t_pelatihan_widyaiswara" data-page="1">
<span<?php echo $t_pelatihan_view->widyaiswara->viewAttributes() ?>><?php echo $t_pelatihan_view->widyaiswara->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->jenisevaluasi->Visible) { // jenisevaluasi ?>
	<tr id="r_jenisevaluasi">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_jenisevaluasi"><?php echo $t_pelatihan_view->jenisevaluasi->caption() ?></span></td>
		<td data-name="jenisevaluasi" <?php echo $t_pelatihan_view->jenisevaluasi->cellAttributes() ?>>
<span id="el_t_pelatihan_jenisevaluasi" data-page="1">
<span<?php echo $t_pelatihan_view->jenisevaluasi->viewAttributes() ?>><?php echo $t_pelatihan_view->jenisevaluasi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->jenispel->Visible) { // jenispel ?>
	<tr id="r_jenispel">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_jenispel"><?php echo $t_pelatihan_view->jenispel->caption() ?></span></td>
		<td data-name="jenispel" <?php echo $t_pelatihan_view->jenispel->cellAttributes() ?>>
<span id="el_t_pelatihan_jenispel" data-page="1">
<span<?php echo $t_pelatihan_view->jenispel->viewAttributes() ?>><?php echo $t_pelatihan_view->jenispel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->kdkategori->Visible) { // kdkategori ?>
	<tr id="r_kdkategori">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_kdkategori"><?php echo $t_pelatihan_view->kdkategori->caption() ?></span></td>
		<td data-name="kdkategori" <?php echo $t_pelatihan_view->kdkategori->cellAttributes() ?>>
<span id="el_t_pelatihan_kdkategori" data-page="1">
<span<?php echo $t_pelatihan_view->kdkategori->viewAttributes() ?>><?php echo $t_pelatihan_view->kdkategori->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->kerjasama->Visible) { // kerjasama ?>
	<tr id="r_kerjasama">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_kerjasama"><?php echo $t_pelatihan_view->kerjasama->caption() ?></span></td>
		<td data-name="kerjasama" <?php echo $t_pelatihan_view->kerjasama->cellAttributes() ?>>
<span id="el_t_pelatihan_kerjasama" data-page="1">
<span<?php echo $t_pelatihan_view->kerjasama->viewAttributes() ?>><?php echo $t_pelatihan_view->kerjasama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->biaya->Visible) { // biaya ?>
	<tr id="r_biaya">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_biaya"><?php echo $t_pelatihan_view->biaya->caption() ?></span></td>
		<td data-name="biaya" <?php echo $t_pelatihan_view->biaya->cellAttributes() ?>>
<span id="el_t_pelatihan_biaya" data-page="1">
<span<?php echo $t_pelatihan_view->biaya->viewAttributes() ?>><?php echo $t_pelatihan_view->biaya->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->coachingprogr->Visible) { // coachingprogr ?>
	<tr id="r_coachingprogr">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_coachingprogr"><?php echo $t_pelatihan_view->coachingprogr->caption() ?></span></td>
		<td data-name="coachingprogr" <?php echo $t_pelatihan_view->coachingprogr->cellAttributes() ?>>
<span id="el_t_pelatihan_coachingprogr" data-page="1">
<span<?php echo $t_pelatihan_view->coachingprogr->viewAttributes() ?>><?php echo $t_pelatihan_view->coachingprogr->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->area->Visible) { // area ?>
	<tr id="r_area">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_area"><?php echo $t_pelatihan_view->area->caption() ?></span></td>
		<td data-name="area" <?php echo $t_pelatihan_view->area->cellAttributes() ?>>
<span id="el_t_pelatihan_area" data-page="1">
<span<?php echo $t_pelatihan_view->area->viewAttributes() ?>><?php echo $t_pelatihan_view->area->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->periode_awal->Visible) { // periode_awal ?>
	<tr id="r_periode_awal">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_periode_awal"><?php echo $t_pelatihan_view->periode_awal->caption() ?></span></td>
		<td data-name="periode_awal" <?php echo $t_pelatihan_view->periode_awal->cellAttributes() ?>>
<span id="el_t_pelatihan_periode_awal" data-page="1">
<span<?php echo $t_pelatihan_view->periode_awal->viewAttributes() ?>><?php echo $t_pelatihan_view->periode_awal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->periode_akhir->Visible) { // periode_akhir ?>
	<tr id="r_periode_akhir">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_periode_akhir"><?php echo $t_pelatihan_view->periode_akhir->caption() ?></span></td>
		<td data-name="periode_akhir" <?php echo $t_pelatihan_view->periode_akhir->cellAttributes() ?>>
<span id="el_t_pelatihan_periode_akhir" data-page="1">
<span<?php echo $t_pelatihan_view->periode_akhir->viewAttributes() ?>><?php echo $t_pelatihan_view->periode_akhir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->tahapan->Visible) { // tahapan ?>
	<tr id="r_tahapan">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_tahapan"><?php echo $t_pelatihan_view->tahapan->caption() ?></span></td>
		<td data-name="tahapan" <?php echo $t_pelatihan_view->tahapan->cellAttributes() ?>>
<span id="el_t_pelatihan_tahapan" data-page="1">
<span<?php echo $t_pelatihan_view->tahapan->viewAttributes() ?>><?php echo $t_pelatihan_view->tahapan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->namaberkas->Visible) { // namaberkas ?>
	<tr id="r_namaberkas">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_namaberkas"><?php echo $t_pelatihan_view->namaberkas->caption() ?></span></td>
		<td data-name="namaberkas" <?php echo $t_pelatihan_view->namaberkas->cellAttributes() ?>>
<span id="el_t_pelatihan_namaberkas" data-page="1">
<span<?php echo $t_pelatihan_view->namaberkas->viewAttributes() ?>><?php echo GetFileViewTag($t_pelatihan_view->namaberkas, $t_pelatihan_view->namaberkas->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->instruktur->Visible) { // instruktur ?>
	<tr id="r_instruktur">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_instruktur"><?php echo $t_pelatihan_view->instruktur->caption() ?></span></td>
		<td data-name="instruktur" <?php echo $t_pelatihan_view->instruktur->cellAttributes() ?>>
<span id="el_t_pelatihan_instruktur" data-page="1">
<span<?php echo $t_pelatihan_view->instruktur->viewAttributes() ?>><?php echo $t_pelatihan_view->instruktur->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->statuspel->Visible) { // statuspel ?>
	<tr id="r_statuspel">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_statuspel"><?php echo $t_pelatihan_view->statuspel->caption() ?></span></td>
		<td data-name="statuspel" <?php echo $t_pelatihan_view->statuspel->cellAttributes() ?>>
<span id="el_t_pelatihan_statuspel" data-page="1">
<span<?php echo $t_pelatihan_view->statuspel->viewAttributes() ?>><?php echo $t_pelatihan_view->statuspel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->ket->Visible) { // ket ?>
	<tr id="r_ket">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_ket"><?php echo $t_pelatihan_view->ket->caption() ?></span></td>
		<td data-name="ket" <?php echo $t_pelatihan_view->ket->cellAttributes() ?>>
<span id="el_t_pelatihan_ket" data-page="1">
<span<?php echo $t_pelatihan_view->ket->viewAttributes() ?>><?php echo $t_pelatihan_view->ket->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->jpeserta->Visible) { // jpeserta ?>
	<tr id="r_jpeserta">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_jpeserta"><?php echo $t_pelatihan_view->jpeserta->caption() ?></span></td>
		<td data-name="jpeserta" <?php echo $t_pelatihan_view->jpeserta->cellAttributes() ?>>
<span id="el_t_pelatihan_jpeserta" data-page="1">
<span<?php echo $t_pelatihan_view->jpeserta->viewAttributes() ?>><?php echo $t_pelatihan_view->jpeserta->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->bbio->Visible) { // bbio ?>
	<tr id="r_bbio">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_bbio"><?php echo $t_pelatihan_view->bbio->caption() ?></span></td>
		<td data-name="bbio" <?php echo $t_pelatihan_view->bbio->cellAttributes() ?>>
<span id="el_t_pelatihan_bbio" data-page="1">
<span<?php echo $t_pelatihan_view->bbio->viewAttributes() ?>><?php echo GetFileViewTag($t_pelatihan_view->bbio, $t_pelatihan_view->bbio->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->bbio2->Visible) { // bbio2 ?>
	<tr id="r_bbio2">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_bbio2"><?php echo $t_pelatihan_view->bbio2->caption() ?></span></td>
		<td data-name="bbio2" <?php echo $t_pelatihan_view->bbio2->cellAttributes() ?>>
<span id="el_t_pelatihan_bbio2" data-page="1">
<span<?php echo $t_pelatihan_view->bbio2->viewAttributes() ?>><?php echo GetFileViewTag($t_pelatihan_view->bbio2, $t_pelatihan_view->bbio2->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->bbio3->Visible) { // bbio3 ?>
	<tr id="r_bbio3">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_bbio3"><?php echo $t_pelatihan_view->bbio3->caption() ?></span></td>
		<td data-name="bbio3" <?php echo $t_pelatihan_view->bbio3->cellAttributes() ?>>
<span id="el_t_pelatihan_bbio3" data-page="1">
<span<?php echo $t_pelatihan_view->bbio3->viewAttributes() ?>><?php echo GetFileViewTag($t_pelatihan_view->bbio3, $t_pelatihan_view->bbio3->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->bbio4->Visible) { // bbio4 ?>
	<tr id="r_bbio4">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_bbio4"><?php echo $t_pelatihan_view->bbio4->caption() ?></span></td>
		<td data-name="bbio4" <?php echo $t_pelatihan_view->bbio4->cellAttributes() ?>>
<span id="el_t_pelatihan_bbio4" data-page="1">
<span<?php echo $t_pelatihan_view->bbio4->viewAttributes() ?>><?php echo GetFileViewTag($t_pelatihan_view->bbio4, $t_pelatihan_view->bbio4->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->bbio5->Visible) { // bbio5 ?>
	<tr id="r_bbio5">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_bbio5"><?php echo $t_pelatihan_view->bbio5->caption() ?></span></td>
		<td data-name="bbio5" <?php echo $t_pelatihan_view->bbio5->cellAttributes() ?>>
<span id="el_t_pelatihan_bbio5" data-page="1">
<span<?php echo $t_pelatihan_view->bbio5->viewAttributes() ?>><?php echo GetFileViewTag($t_pelatihan_view->bbio5, $t_pelatihan_view->bbio5->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$t_pelatihan_view->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$t_pelatihan_view->isExport()) { ?>
		<div class="tab-pane<?php echo $t_pelatihan_view->MultiPages->pageStyle(2) ?>" id="tab_t_pelatihan2"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_pelatihan_view->real_peserta->Visible) { // real_peserta ?>
	<tr id="r_real_peserta">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_real_peserta"><?php echo $t_pelatihan_view->real_peserta->caption() ?></span></td>
		<td data-name="real_peserta" <?php echo $t_pelatihan_view->real_peserta->cellAttributes() ?>>
<span id="el_t_pelatihan_real_peserta" data-page="2">
<span<?php echo $t_pelatihan_view->real_peserta->viewAttributes() ?>><?php echo $t_pelatihan_view->real_peserta->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->independen->Visible) { // independen ?>
	<tr id="r_independen">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_independen"><?php echo $t_pelatihan_view->independen->caption() ?></span></td>
		<td data-name="independen" <?php echo $t_pelatihan_view->independen->cellAttributes() ?>>
<span id="el_t_pelatihan_independen" data-page="2">
<span<?php echo $t_pelatihan_view->independen->viewAttributes() ?>><?php echo $t_pelatihan_view->independen->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->swasta_k->Visible) { // swasta_k ?>
	<tr id="r_swasta_k">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_swasta_k"><?php echo $t_pelatihan_view->swasta_k->caption() ?></span></td>
		<td data-name="swasta_k" <?php echo $t_pelatihan_view->swasta_k->cellAttributes() ?>>
<span id="el_t_pelatihan_swasta_k" data-page="2">
<span<?php echo $t_pelatihan_view->swasta_k->viewAttributes() ?>><?php echo $t_pelatihan_view->swasta_k->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->swasta_m->Visible) { // swasta_m ?>
	<tr id="r_swasta_m">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_swasta_m"><?php echo $t_pelatihan_view->swasta_m->caption() ?></span></td>
		<td data-name="swasta_m" <?php echo $t_pelatihan_view->swasta_m->cellAttributes() ?>>
<span id="el_t_pelatihan_swasta_m" data-page="2">
<span<?php echo $t_pelatihan_view->swasta_m->viewAttributes() ?>><?php echo $t_pelatihan_view->swasta_m->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->swasta_b->Visible) { // swasta_b ?>
	<tr id="r_swasta_b">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_swasta_b"><?php echo $t_pelatihan_view->swasta_b->caption() ?></span></td>
		<td data-name="swasta_b" <?php echo $t_pelatihan_view->swasta_b->cellAttributes() ?>>
<span id="el_t_pelatihan_swasta_b" data-page="2">
<span<?php echo $t_pelatihan_view->swasta_b->viewAttributes() ?>><?php echo $t_pelatihan_view->swasta_b->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->bumn->Visible) { // bumn ?>
	<tr id="r_bumn">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_bumn"><?php echo $t_pelatihan_view->bumn->caption() ?></span></td>
		<td data-name="bumn" <?php echo $t_pelatihan_view->bumn->cellAttributes() ?>>
<span id="el_t_pelatihan_bumn" data-page="2">
<span<?php echo $t_pelatihan_view->bumn->viewAttributes() ?>><?php echo $t_pelatihan_view->bumn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->koperasi->Visible) { // koperasi ?>
	<tr id="r_koperasi">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_koperasi"><?php echo $t_pelatihan_view->koperasi->caption() ?></span></td>
		<td data-name="koperasi" <?php echo $t_pelatihan_view->koperasi->cellAttributes() ?>>
<span id="el_t_pelatihan_koperasi" data-page="2">
<span<?php echo $t_pelatihan_view->koperasi->viewAttributes() ?>><?php echo $t_pelatihan_view->koperasi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->pns->Visible) { // pns ?>
	<tr id="r_pns">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_pns"><?php echo $t_pelatihan_view->pns->caption() ?></span></td>
		<td data-name="pns" <?php echo $t_pelatihan_view->pns->cellAttributes() ?>>
<span id="el_t_pelatihan_pns" data-page="2">
<span<?php echo $t_pelatihan_view->pns->viewAttributes() ?>><?php echo $t_pelatihan_view->pns->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->pt_dosen->Visible) { // pt_dosen ?>
	<tr id="r_pt_dosen">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_pt_dosen"><?php echo $t_pelatihan_view->pt_dosen->caption() ?></span></td>
		<td data-name="pt_dosen" <?php echo $t_pelatihan_view->pt_dosen->cellAttributes() ?>>
<span id="el_t_pelatihan_pt_dosen" data-page="2">
<span<?php echo $t_pelatihan_view->pt_dosen->viewAttributes() ?>><?php echo $t_pelatihan_view->pt_dosen->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->pt_mhs->Visible) { // pt_mhs ?>
	<tr id="r_pt_mhs">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_pt_mhs"><?php echo $t_pelatihan_view->pt_mhs->caption() ?></span></td>
		<td data-name="pt_mhs" <?php echo $t_pelatihan_view->pt_mhs->cellAttributes() ?>>
<span id="el_t_pelatihan_pt_mhs" data-page="2">
<span<?php echo $t_pelatihan_view->pt_mhs->viewAttributes() ?>><?php echo $t_pelatihan_view->pt_mhs->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->jk_l->Visible) { // jk_l ?>
	<tr id="r_jk_l">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_jk_l"><?php echo $t_pelatihan_view->jk_l->caption() ?></span></td>
		<td data-name="jk_l" <?php echo $t_pelatihan_view->jk_l->cellAttributes() ?>>
<span id="el_t_pelatihan_jk_l" data-page="2">
<span<?php echo $t_pelatihan_view->jk_l->viewAttributes() ?>><?php echo $t_pelatihan_view->jk_l->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->jk_p->Visible) { // jk_p ?>
	<tr id="r_jk_p">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_jk_p"><?php echo $t_pelatihan_view->jk_p->caption() ?></span></td>
		<td data-name="jk_p" <?php echo $t_pelatihan_view->jk_p->cellAttributes() ?>>
<span id="el_t_pelatihan_jk_p" data-page="2">
<span<?php echo $t_pelatihan_view->jk_p->viewAttributes() ?>><?php echo $t_pelatihan_view->jk_p->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->usia_k45->Visible) { // usia_k45 ?>
	<tr id="r_usia_k45">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_usia_k45"><?php echo $t_pelatihan_view->usia_k45->caption() ?></span></td>
		<td data-name="usia_k45" <?php echo $t_pelatihan_view->usia_k45->cellAttributes() ?>>
<span id="el_t_pelatihan_usia_k45" data-page="2">
<span<?php echo $t_pelatihan_view->usia_k45->viewAttributes() ?>><?php echo $t_pelatihan_view->usia_k45->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->usia_b45->Visible) { // usia_b45 ?>
	<tr id="r_usia_b45">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_usia_b45"><?php echo $t_pelatihan_view->usia_b45->caption() ?></span></td>
		<td data-name="usia_b45" <?php echo $t_pelatihan_view->usia_b45->cellAttributes() ?>>
<span id="el_t_pelatihan_usia_b45" data-page="2">
<span<?php echo $t_pelatihan_view->usia_b45->viewAttributes() ?>><?php echo $t_pelatihan_view->usia_b45->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pelatihan_view->produk->Visible) { // produk ?>
	<tr id="r_produk">
		<td class="<?php echo $t_pelatihan_view->TableLeftColumnClass ?>"><span id="elh_t_pelatihan_produk"><?php echo $t_pelatihan_view->produk->caption() ?></span></td>
		<td data-name="produk" <?php echo $t_pelatihan_view->produk->cellAttributes() ?>>
<span id="el_t_pelatihan_produk" data-page="2">
<span<?php echo $t_pelatihan_view->produk->viewAttributes() ?>><?php echo $t_pelatihan_view->produk->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$t_pelatihan_view->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$t_pelatihan_view->isExport()) { ?>
	</div>
</div>
</div>
<?php } ?>
<?php
	if (in_array("cv_historipeserta", explode(",", $t_pelatihan->getCurrentDetailTable())) && $cv_historipeserta->DetailView) {
?>
<?php if ($t_pelatihan->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("cv_historipeserta", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $t_pelatihan_view->cv_historipeserta_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "cv_historipesertagrid.php" ?>
<?php } ?>
<?php
	if (in_array("cv_historiinstruktur", explode(",", $t_pelatihan->getCurrentDetailTable())) && $cv_historiinstruktur->DetailView) {
?>
<?php if ($t_pelatihan->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("cv_historiinstruktur", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $t_pelatihan_view->cv_historiinstruktur_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "cv_historiinstrukturgrid.php" ?>
<?php } ?>
<?php
	if (in_array("t_jadwalpel", explode(",", $t_pelatihan->getCurrentDetailTable())) && $t_jadwalpel->DetailView) {
?>
<?php if ($t_pelatihan->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("t_jadwalpel", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $t_pelatihan_view->t_jadwalpel_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "t_jadwalpelgrid.php" ?>
<?php } ?>
</form>
<?php
$t_pelatihan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_pelatihan_view->isExport()) { ?>
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
$t_pelatihan_view->terminate();
?>