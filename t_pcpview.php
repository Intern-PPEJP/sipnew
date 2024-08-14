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
$t_pcp_view = new t_pcp_view();

// Run the page
$t_pcp_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pcp_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_pcp_view->isExport()) { ?>
<script>
var ft_pcpview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ft_pcpview = currentForm = new ew.Form("ft_pcpview", "view");
	loadjs.done("ft_pcpview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_pcp_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_pcp_view->ExportOptions->render("body") ?>
<?php $t_pcp_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_pcp_view->showPageHeader(); ?>
<?php
$t_pcp_view->showMessage();
?>
<form name="ft_pcpview" id="ft_pcpview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_pcp">
<input type="hidden" name="modal" value="<?php echo (int)$t_pcp_view->IsModal ?>">
<?php if (!$t_pcp_view->isExport()) { ?>
<div class="ew-multi-page">
<div class="ew-nav-tabs" id="t_pcp_view"><!-- multi-page tabs -->
	<ul class="<?php echo $t_pcp_view->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $t_pcp_view->MultiPages->pageStyle(1) ?>" href="#tab_t_pcp1" data-toggle="tab"><?php echo $t_pcp->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $t_pcp_view->MultiPages->pageStyle(2) ?>" href="#tab_t_pcp2" data-toggle="tab"><?php echo $t_pcp->pageCaption(2) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $t_pcp_view->MultiPages->pageStyle(3) ?>" href="#tab_t_pcp3" data-toggle="tab"><?php echo $t_pcp->pageCaption(3) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $t_pcp_view->MultiPages->pageStyle(4) ?>" href="#tab_t_pcp4" data-toggle="tab"><?php echo $t_pcp->pageCaption(4) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $t_pcp_view->MultiPages->pageStyle(5) ?>" href="#tab_t_pcp5" data-toggle="tab"><?php echo $t_pcp->pageCaption(5) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if (!$t_pcp_view->isExport()) { ?>
		<div class="tab-pane<?php echo $t_pcp_view->MultiPages->pageStyle(1) ?>" id="tab_t_pcp1"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_pcp_view->nama_peserta->Visible) { // nama_peserta ?>
	<tr id="r_nama_peserta">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_nama_peserta"><?php echo $t_pcp_view->nama_peserta->caption() ?></span></td>
		<td data-name="nama_peserta" <?php echo $t_pcp_view->nama_peserta->cellAttributes() ?>>
<span id="el_t_pcp_nama_peserta" data-page="1">
<span<?php echo $t_pcp_view->nama_peserta->viewAttributes() ?>><?php echo $t_pcp_view->nama_peserta->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->email_add->Visible) { // email_add ?>
	<tr id="r_email_add">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_email_add"><?php echo $t_pcp_view->email_add->caption() ?></span></td>
		<td data-name="email_add" <?php echo $t_pcp_view->email_add->cellAttributes() ?>>
<span id="el_t_pcp_email_add" data-page="1">
<span<?php echo $t_pcp_view->email_add->viewAttributes() ?>><?php echo $t_pcp_view->email_add->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->handphone->Visible) { // handphone ?>
	<tr id="r_handphone">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_handphone"><?php echo $t_pcp_view->handphone->caption() ?></span></td>
		<td data-name="handphone" <?php echo $t_pcp_view->handphone->cellAttributes() ?>>
<span id="el_t_pcp_handphone" data-page="1">
<span<?php echo $t_pcp_view->handphone->viewAttributes() ?>><?php echo $t_pcp_view->handphone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$t_pcp_view->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$t_pcp_view->isExport()) { ?>
		<div class="tab-pane<?php echo $t_pcp_view->MultiPages->pageStyle(2) ?>" id="tab_t_pcp2"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_pcp_view->namap->Visible) { // namap ?>
	<tr id="r_namap">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_namap"><?php echo $t_pcp_view->namap->caption() ?></span></td>
		<td data-name="namap" <?php echo $t_pcp_view->namap->cellAttributes() ?>>
<span id="el_t_pcp_namap" data-page="2">
<span<?php echo $t_pcp_view->namap->viewAttributes() ?>><?php echo $t_pcp_view->namap->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->tahun_berdiri->Visible) { // tahun_berdiri ?>
	<tr id="r_tahun_berdiri">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_tahun_berdiri"><?php echo $t_pcp_view->tahun_berdiri->caption() ?></span></td>
		<td data-name="tahun_berdiri" <?php echo $t_pcp_view->tahun_berdiri->cellAttributes() ?>>
<span id="el_t_pcp_tahun_berdiri" data-page="2">
<span<?php echo $t_pcp_view->tahun_berdiri->viewAttributes() ?>><?php echo $t_pcp_view->tahun_berdiri->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->alamat->Visible) { // alamat ?>
	<tr id="r_alamat">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_alamat"><?php echo $t_pcp_view->alamat->caption() ?></span></td>
		<td data-name="alamat" <?php echo $t_pcp_view->alamat->cellAttributes() ?>>
<span id="el_t_pcp_alamat" data-page="2">
<span<?php echo $t_pcp_view->alamat->viewAttributes() ?>><?php echo $t_pcp_view->alamat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->alamat_prod->Visible) { // alamat_prod ?>
	<tr id="r_alamat_prod">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_alamat_prod"><?php echo $t_pcp_view->alamat_prod->caption() ?></span></td>
		<td data-name="alamat_prod" <?php echo $t_pcp_view->alamat_prod->cellAttributes() ?>>
<span id="el_t_pcp_alamat_prod" data-page="2">
<span<?php echo $t_pcp_view->alamat_prod->viewAttributes() ?>><?php echo $t_pcp_view->alamat_prod->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->kategori_produk->Visible) { // kategori_produk ?>
	<tr id="r_kategori_produk">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_kategori_produk"><?php echo $t_pcp_view->kategori_produk->caption() ?></span></td>
		<td data-name="kategori_produk" <?php echo $t_pcp_view->kategori_produk->cellAttributes() ?>>
<span id="el_t_pcp_kategori_produk" data-page="2">
<span<?php echo $t_pcp_view->kategori_produk->viewAttributes() ?>><?php echo $t_pcp_view->kategori_produk->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->kategori_produk2->Visible) { // kategori_produk2 ?>
	<tr id="r_kategori_produk2">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_kategori_produk2"><?php echo $t_pcp_view->kategori_produk2->caption() ?></span></td>
		<td data-name="kategori_produk2" <?php echo $t_pcp_view->kategori_produk2->cellAttributes() ?>>
<span id="el_t_pcp_kategori_produk2" data-page="2">
<span<?php echo $t_pcp_view->kategori_produk2->viewAttributes() ?>><?php echo $t_pcp_view->kategori_produk2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->kategori_produk3->Visible) { // kategori_produk3 ?>
	<tr id="r_kategori_produk3">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_kategori_produk3"><?php echo $t_pcp_view->kategori_produk3->caption() ?></span></td>
		<td data-name="kategori_produk3" <?php echo $t_pcp_view->kategori_produk3->cellAttributes() ?>>
<span id="el_t_pcp_kategori_produk3" data-page="2">
<span<?php echo $t_pcp_view->kategori_produk3->viewAttributes() ?>><?php echo $t_pcp_view->kategori_produk3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->produk->Visible) { // produk ?>
	<tr id="r_produk">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_produk"><?php echo $t_pcp_view->produk->caption() ?></span></td>
		<td data-name="produk" <?php echo $t_pcp_view->produk->cellAttributes() ?>>
<span id="el_t_pcp_produk" data-page="2">
<span<?php echo $t_pcp_view->produk->viewAttributes() ?>><?php echo $t_pcp_view->produk->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->merek_dagang->Visible) { // merek_dagang ?>
	<tr id="r_merek_dagang">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_merek_dagang"><?php echo $t_pcp_view->merek_dagang->caption() ?></span></td>
		<td data-name="merek_dagang" <?php echo $t_pcp_view->merek_dagang->cellAttributes() ?>>
<span id="el_t_pcp_merek_dagang" data-page="2">
<span<?php echo $t_pcp_view->merek_dagang->viewAttributes() ?>><?php echo $t_pcp_view->merek_dagang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->jenis_perusahaan->Visible) { // jenis_perusahaan ?>
	<tr id="r_jenis_perusahaan">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_jenis_perusahaan"><?php echo $t_pcp_view->jenis_perusahaan->caption() ?></span></td>
		<td data-name="jenis_perusahaan" <?php echo $t_pcp_view->jenis_perusahaan->cellAttributes() ?>>
<span id="el_t_pcp_jenis_perusahaan" data-page="2">
<span<?php echo $t_pcp_view->jenis_perusahaan->viewAttributes() ?>><?php echo $t_pcp_view->jenis_perusahaan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->kapasitas_produksi->Visible) { // kapasitas_produksi ?>
	<tr id="r_kapasitas_produksi">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_kapasitas_produksi"><?php echo $t_pcp_view->kapasitas_produksi->caption() ?></span></td>
		<td data-name="kapasitas_produksi" <?php echo $t_pcp_view->kapasitas_produksi->cellAttributes() ?>>
<span id="el_t_pcp_kapasitas_produksi" data-page="2">
<span<?php echo $t_pcp_view->kapasitas_produksi->viewAttributes() ?>><?php echo $t_pcp_view->kapasitas_produksi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->omset->Visible) { // omset ?>
	<tr id="r_omset">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_omset"><?php echo $t_pcp_view->omset->caption() ?></span></td>
		<td data-name="omset" <?php echo $t_pcp_view->omset->cellAttributes() ?>>
<span id="el_t_pcp_omset" data-page="2">
<span<?php echo $t_pcp_view->omset->viewAttributes() ?>><?php echo $t_pcp_view->omset->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->website->Visible) { // website ?>
	<tr id="r_website">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_website"><?php echo $t_pcp_view->website->caption() ?></span></td>
		<td data-name="website" <?php echo $t_pcp_view->website->cellAttributes() ?>>
<span id="el_t_pcp_website" data-page="2">
<span<?php echo $t_pcp_view->website->viewAttributes() ?>><?php echo $t_pcp_view->website->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->fb->Visible) { // fb ?>
	<tr id="r_fb">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_fb"><?php echo $t_pcp_view->fb->caption() ?></span></td>
		<td data-name="fb" <?php echo $t_pcp_view->fb->cellAttributes() ?>>
<span id="el_t_pcp_fb" data-page="2">
<span<?php echo $t_pcp_view->fb->viewAttributes() ?>><?php echo $t_pcp_view->fb->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->ig->Visible) { // ig ?>
	<tr id="r_ig">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_ig"><?php echo $t_pcp_view->ig->caption() ?></span></td>
		<td data-name="ig" <?php echo $t_pcp_view->ig->cellAttributes() ?>>
<span id="el_t_pcp_ig" data-page="2">
<span<?php echo $t_pcp_view->ig->viewAttributes() ?>><?php echo $t_pcp_view->ig->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->sosmed_lain->Visible) { // sosmed_lain ?>
	<tr id="r_sosmed_lain">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_sosmed_lain"><?php echo $t_pcp_view->sosmed_lain->caption() ?></span></td>
		<td data-name="sosmed_lain" <?php echo $t_pcp_view->sosmed_lain->cellAttributes() ?>>
<span id="el_t_pcp_sosmed_lain" data-page="2">
<span<?php echo $t_pcp_view->sosmed_lain->viewAttributes() ?>><?php echo $t_pcp_view->sosmed_lain->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->jml_pegawai->Visible) { // jml_pegawai ?>
	<tr id="r_jml_pegawai">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_jml_pegawai"><?php echo $t_pcp_view->jml_pegawai->caption() ?></span></td>
		<td data-name="jml_pegawai" <?php echo $t_pcp_view->jml_pegawai->cellAttributes() ?>>
<span id="el_t_pcp_jml_pegawai" data-page="2">
<span<?php echo $t_pcp_view->jml_pegawai->viewAttributes() ?>><?php echo $t_pcp_view->jml_pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->jml_pegawai2->Visible) { // jml_pegawai2 ?>
	<tr id="r_jml_pegawai2">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_jml_pegawai2"><?php echo $t_pcp_view->jml_pegawai2->caption() ?></span></td>
		<td data-name="jml_pegawai2" <?php echo $t_pcp_view->jml_pegawai2->cellAttributes() ?>>
<span id="el_t_pcp_jml_pegawai2" data-page="2">
<span<?php echo $t_pcp_view->jml_pegawai2->viewAttributes() ?>><?php echo $t_pcp_view->jml_pegawai2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->jml_pegawai_tidaktetap->Visible) { // jml_pegawai_tidaktetap ?>
	<tr id="r_jml_pegawai_tidaktetap">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_jml_pegawai_tidaktetap"><?php echo $t_pcp_view->jml_pegawai_tidaktetap->caption() ?></span></td>
		<td data-name="jml_pegawai_tidaktetap" <?php echo $t_pcp_view->jml_pegawai_tidaktetap->cellAttributes() ?>>
<span id="el_t_pcp_jml_pegawai_tidaktetap" data-page="2">
<span<?php echo $t_pcp_view->jml_pegawai_tidaktetap->viewAttributes() ?>><?php echo $t_pcp_view->jml_pegawai_tidaktetap->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$t_pcp_view->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$t_pcp_view->isExport()) { ?>
		<div class="tab-pane<?php echo $t_pcp_view->MultiPages->pageStyle(3) ?>" id="tab_t_pcp3"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_pcp_view->legalitas->Visible) { // legalitas ?>
	<tr id="r_legalitas">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_legalitas"><?php echo $t_pcp_view->legalitas->caption() ?></span></td>
		<td data-name="legalitas" <?php echo $t_pcp_view->legalitas->cellAttributes() ?>>
<span id="el_t_pcp_legalitas" data-page="3">
<span<?php echo $t_pcp_view->legalitas->viewAttributes() ?>><?php echo $t_pcp_view->legalitas->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->legalitas_lain->Visible) { // legalitas_lain ?>
	<tr id="r_legalitas_lain">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_legalitas_lain"><?php echo $t_pcp_view->legalitas_lain->caption() ?></span></td>
		<td data-name="legalitas_lain" <?php echo $t_pcp_view->legalitas_lain->cellAttributes() ?>>
<span id="el_t_pcp_legalitas_lain" data-page="3">
<span<?php echo $t_pcp_view->legalitas_lain->viewAttributes() ?>><?php echo $t_pcp_view->legalitas_lain->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->f_npwp->Visible) { // f_npwp ?>
	<tr id="r_f_npwp">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_f_npwp"><?php echo $t_pcp_view->f_npwp->caption() ?></span></td>
		<td data-name="f_npwp" <?php echo $t_pcp_view->f_npwp->cellAttributes() ?>>
<span id="el_t_pcp_f_npwp" data-page="3">
<span<?php echo $t_pcp_view->f_npwp->viewAttributes() ?>><?php echo GetFileViewTag($t_pcp_view->f_npwp, $t_pcp_view->f_npwp->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->f_nib->Visible) { // f_nib ?>
	<tr id="r_f_nib">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_f_nib"><?php echo $t_pcp_view->f_nib->caption() ?></span></td>
		<td data-name="f_nib" <?php echo $t_pcp_view->f_nib->cellAttributes() ?>>
<span id="el_t_pcp_f_nib" data-page="3">
<span<?php echo $t_pcp_view->f_nib->viewAttributes() ?>><?php echo GetFileViewTag($t_pcp_view->f_nib, $t_pcp_view->f_nib->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->f_siup->Visible) { // f_siup ?>
	<tr id="r_f_siup">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_f_siup"><?php echo $t_pcp_view->f_siup->caption() ?></span></td>
		<td data-name="f_siup" <?php echo $t_pcp_view->f_siup->cellAttributes() ?>>
<span id="el_t_pcp_f_siup" data-page="3">
<span<?php echo $t_pcp_view->f_siup->viewAttributes() ?>><?php echo GetFileViewTag($t_pcp_view->f_siup, $t_pcp_view->f_siup->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->f_tdp->Visible) { // f_tdp ?>
	<tr id="r_f_tdp">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_f_tdp"><?php echo $t_pcp_view->f_tdp->caption() ?></span></td>
		<td data-name="f_tdp" <?php echo $t_pcp_view->f_tdp->cellAttributes() ?>>
<span id="el_t_pcp_f_tdp" data-page="3">
<span<?php echo $t_pcp_view->f_tdp->viewAttributes() ?>><?php echo GetFileViewTag($t_pcp_view->f_tdp, $t_pcp_view->f_tdp->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->f_lain->Visible) { // f_lain ?>
	<tr id="r_f_lain">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_f_lain"><?php echo $t_pcp_view->f_lain->caption() ?></span></td>
		<td data-name="f_lain" <?php echo $t_pcp_view->f_lain->cellAttributes() ?>>
<span id="el_t_pcp_f_lain" data-page="3">
<span<?php echo $t_pcp_view->f_lain->viewAttributes() ?>><?php echo GetFileViewTag($t_pcp_view->f_lain, $t_pcp_view->f_lain->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$t_pcp_view->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$t_pcp_view->isExport()) { ?>
		<div class="tab-pane<?php echo $t_pcp_view->MultiPages->pageStyle(4) ?>" id="tab_t_pcp4"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_pcp_view->sertifikat->Visible) { // sertifikat ?>
	<tr id="r_sertifikat">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_sertifikat"><?php echo $t_pcp_view->sertifikat->caption() ?></span></td>
		<td data-name="sertifikat" <?php echo $t_pcp_view->sertifikat->cellAttributes() ?>>
<span id="el_t_pcp_sertifikat" data-page="4">
<span<?php echo $t_pcp_view->sertifikat->viewAttributes() ?>><?php echo $t_pcp_view->sertifikat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->sertifikat_lain->Visible) { // sertifikat_lain ?>
	<tr id="r_sertifikat_lain">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_sertifikat_lain"><?php echo $t_pcp_view->sertifikat_lain->caption() ?></span></td>
		<td data-name="sertifikat_lain" <?php echo $t_pcp_view->sertifikat_lain->cellAttributes() ?>>
<span id="el_t_pcp_sertifikat_lain" data-page="4">
<span<?php echo $t_pcp_view->sertifikat_lain->viewAttributes() ?>><?php echo $t_pcp_view->sertifikat_lain->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->f_sertifikat->Visible) { // f_sertifikat ?>
	<tr id="r_f_sertifikat">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_f_sertifikat"><?php echo $t_pcp_view->f_sertifikat->caption() ?></span></td>
		<td data-name="f_sertifikat" <?php echo $t_pcp_view->f_sertifikat->cellAttributes() ?>>
<span id="el_t_pcp_f_sertifikat" data-page="4">
<span<?php echo $t_pcp_view->f_sertifikat->viewAttributes() ?>><?php echo GetFileViewTag($t_pcp_view->f_sertifikat, $t_pcp_view->f_sertifikat->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->alat_promosi->Visible) { // alat_promosi ?>
	<tr id="r_alat_promosi">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_alat_promosi"><?php echo $t_pcp_view->alat_promosi->caption() ?></span></td>
		<td data-name="alat_promosi" <?php echo $t_pcp_view->alat_promosi->cellAttributes() ?>>
<span id="el_t_pcp_alat_promosi" data-page="4">
<span<?php echo $t_pcp_view->alat_promosi->viewAttributes() ?>><?php echo $t_pcp_view->alat_promosi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->promosi_lain->Visible) { // promosi_lain ?>
	<tr id="r_promosi_lain">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_promosi_lain"><?php echo $t_pcp_view->promosi_lain->caption() ?></span></td>
		<td data-name="promosi_lain" <?php echo $t_pcp_view->promosi_lain->cellAttributes() ?>>
<span id="el_t_pcp_promosi_lain" data-page="4">
<span<?php echo $t_pcp_view->promosi_lain->viewAttributes() ?>><?php echo $t_pcp_view->promosi_lain->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->f_kartunama->Visible) { // f_kartunama ?>
	<tr id="r_f_kartunama">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_f_kartunama"><?php echo $t_pcp_view->f_kartunama->caption() ?></span></td>
		<td data-name="f_kartunama" <?php echo $t_pcp_view->f_kartunama->cellAttributes() ?>>
<span id="el_t_pcp_f_kartunama" data-page="4">
<span<?php echo $t_pcp_view->f_kartunama->viewAttributes() ?>><?php echo GetFileViewTag($t_pcp_view->f_kartunama, $t_pcp_view->f_kartunama->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->f_brosur->Visible) { // f_brosur ?>
	<tr id="r_f_brosur">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_f_brosur"><?php echo $t_pcp_view->f_brosur->caption() ?></span></td>
		<td data-name="f_brosur" <?php echo $t_pcp_view->f_brosur->cellAttributes() ?>>
<span id="el_t_pcp_f_brosur" data-page="4">
<span<?php echo $t_pcp_view->f_brosur->viewAttributes() ?>><?php echo GetFileViewTag($t_pcp_view->f_brosur, $t_pcp_view->f_brosur->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->f_katalog->Visible) { // f_katalog ?>
	<tr id="r_f_katalog">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_f_katalog"><?php echo $t_pcp_view->f_katalog->caption() ?></span></td>
		<td data-name="f_katalog" <?php echo $t_pcp_view->f_katalog->cellAttributes() ?>>
<span id="el_t_pcp_f_katalog" data-page="4">
<span<?php echo $t_pcp_view->f_katalog->viewAttributes() ?>><?php echo GetFileViewTag($t_pcp_view->f_katalog, $t_pcp_view->f_katalog->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->f_profile->Visible) { // f_profile ?>
	<tr id="r_f_profile">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_f_profile"><?php echo $t_pcp_view->f_profile->caption() ?></span></td>
		<td data-name="f_profile" <?php echo $t_pcp_view->f_profile->cellAttributes() ?>>
<span id="el_t_pcp_f_profile" data-page="4">
<span<?php echo $t_pcp_view->f_profile->viewAttributes() ?>><?php echo GetFileViewTag($t_pcp_view->f_profile, $t_pcp_view->f_profile->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$t_pcp_view->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$t_pcp_view->isExport()) { ?>
		<div class="tab-pane<?php echo $t_pcp_view->MultiPages->pageStyle(5) ?>" id="tab_t_pcp5"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_pcp_view->tahun_ecp->Visible) { // tahun_ecp ?>
	<tr id="r_tahun_ecp">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_tahun_ecp"><?php echo $t_pcp_view->tahun_ecp->caption() ?></span></td>
		<td data-name="tahun_ecp" <?php echo $t_pcp_view->tahun_ecp->cellAttributes() ?>>
<span id="el_t_pcp_tahun_ecp" data-page="5">
<span<?php echo $t_pcp_view->tahun_ecp->viewAttributes() ?>><?php echo $t_pcp_view->tahun_ecp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_pcp_view->wilayah_ecp->Visible) { // wilayah_ecp ?>
	<tr id="r_wilayah_ecp">
		<td class="<?php echo $t_pcp_view->TableLeftColumnClass ?>"><span id="elh_t_pcp_wilayah_ecp"><?php echo $t_pcp_view->wilayah_ecp->caption() ?></span></td>
		<td data-name="wilayah_ecp" <?php echo $t_pcp_view->wilayah_ecp->cellAttributes() ?>>
<span id="el_t_pcp_wilayah_ecp" data-page="5">
<span<?php echo $t_pcp_view->wilayah_ecp->viewAttributes() ?>><?php echo $t_pcp_view->wilayah_ecp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$t_pcp_view->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$t_pcp_view->isExport()) { ?>
	</div>
</div>
</div>
<?php } ?>
<?php
	if (in_array("t_ecp", explode(",", $t_pcp->getCurrentDetailTable())) && $t_ecp->DetailView) {
?>
<?php if ($t_pcp->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("t_ecp", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "t_ecpgrid.php" ?>
<?php } ?>
</form>
<?php
$t_pcp_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_pcp_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$(".ew-db-table").hide(),$(".t_head").hide(),$(".nav-link").click(function(){"#tab_t_pcp5"==$(this).attr("href")?($(".ew-db-table").show(),$(".t_head").show()):($(".ew-db-table").hide(),$(".t_head").hide())});
});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$t_pcp_view->terminate();
?>