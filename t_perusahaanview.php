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
$t_perusahaan_view = new t_perusahaan_view();

// Run the page
$t_perusahaan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_perusahaan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_perusahaan_view->isExport()) { ?>
<script>
var ft_perusahaanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ft_perusahaanview = currentForm = new ew.Form("ft_perusahaanview", "view");
	loadjs.done("ft_perusahaanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//document.write('<?php echo cs_judul("view","Perusahaan : View Data");?>');

});
</script>
<?php } ?>
<?php if (!$t_perusahaan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_perusahaan_view->ExportOptions->render("body") ?>
<?php $t_perusahaan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_perusahaan_view->showPageHeader(); ?>
<?php
$t_perusahaan_view->showMessage();
?>
<form name="ft_perusahaanview" id="ft_perusahaanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_perusahaan">
<input type="hidden" name="modal" value="<?php echo (int)$t_perusahaan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_perusahaan_view->namap->Visible) { // namap ?>
	<tr id="r_namap">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_namap"><?php echo $t_perusahaan_view->namap->caption() ?></span></td>
		<td data-name="namap" <?php echo $t_perusahaan_view->namap->cellAttributes() ?>>
<span id="el_t_perusahaan_namap">
<span<?php echo $t_perusahaan_view->namap->viewAttributes() ?>><?php echo $t_perusahaan_view->namap->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->kontak->Visible) { // kontak ?>
	<tr id="r_kontak">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_kontak"><?php echo $t_perusahaan_view->kontak->caption() ?></span></td>
		<td data-name="kontak" <?php echo $t_perusahaan_view->kontak->cellAttributes() ?>>
<span id="el_t_perusahaan_kontak">
<span<?php echo $t_perusahaan_view->kontak->viewAttributes() ?>><?php echo $t_perusahaan_view->kontak->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->kdlokasi->Visible) { // kdlokasi ?>
	<tr id="r_kdlokasi">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_kdlokasi"><?php echo $t_perusahaan_view->kdlokasi->caption() ?></span></td>
		<td data-name="kdlokasi" <?php echo $t_perusahaan_view->kdlokasi->cellAttributes() ?>>
<span id="el_t_perusahaan_kdlokasi">
<span<?php echo $t_perusahaan_view->kdlokasi->viewAttributes() ?>><?php echo $t_perusahaan_view->kdlokasi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->kdprop->Visible) { // kdprop ?>
	<tr id="r_kdprop">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_kdprop"><?php echo $t_perusahaan_view->kdprop->caption() ?></span></td>
		<td data-name="kdprop" <?php echo $t_perusahaan_view->kdprop->cellAttributes() ?>>
<span id="el_t_perusahaan_kdprop">
<span<?php echo $t_perusahaan_view->kdprop->viewAttributes() ?>><?php echo $t_perusahaan_view->kdprop->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->kdkota->Visible) { // kdkota ?>
	<tr id="r_kdkota">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_kdkota"><?php echo $t_perusahaan_view->kdkota->caption() ?></span></td>
		<td data-name="kdkota" <?php echo $t_perusahaan_view->kdkota->cellAttributes() ?>>
<span id="el_t_perusahaan_kdkota">
<span<?php echo $t_perusahaan_view->kdkota->viewAttributes() ?>><?php echo $t_perusahaan_view->kdkota->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->kdkec->Visible) { // kdkec ?>
	<tr id="r_kdkec">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_kdkec"><?php echo $t_perusahaan_view->kdkec->caption() ?></span></td>
		<td data-name="kdkec" <?php echo $t_perusahaan_view->kdkec->cellAttributes() ?>>
<span id="el_t_perusahaan_kdkec">
<span<?php echo $t_perusahaan_view->kdkec->viewAttributes() ?>><?php echo $t_perusahaan_view->kdkec->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->alamatp->Visible) { // alamatp ?>
	<tr id="r_alamatp">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_alamatp"><?php echo $t_perusahaan_view->alamatp->caption() ?></span></td>
		<td data-name="alamatp" <?php echo $t_perusahaan_view->alamatp->cellAttributes() ?>>
<span id="el_t_perusahaan_alamatp">
<span<?php echo $t_perusahaan_view->alamatp->viewAttributes() ?>><?php echo $t_perusahaan_view->alamatp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->kdpos->Visible) { // kdpos ?>
	<tr id="r_kdpos">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_kdpos"><?php echo $t_perusahaan_view->kdpos->caption() ?></span></td>
		<td data-name="kdpos" <?php echo $t_perusahaan_view->kdpos->cellAttributes() ?>>
<span id="el_t_perusahaan_kdpos">
<span<?php echo $t_perusahaan_view->kdpos->viewAttributes() ?>><?php echo $t_perusahaan_view->kdpos->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->telpp->Visible) { // telpp ?>
	<tr id="r_telpp">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_telpp"><?php echo $t_perusahaan_view->telpp->caption() ?></span></td>
		<td data-name="telpp" <?php echo $t_perusahaan_view->telpp->cellAttributes() ?>>
<span id="el_t_perusahaan_telpp">
<span<?php echo $t_perusahaan_view->telpp->viewAttributes() ?>><?php echo $t_perusahaan_view->telpp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->faxp->Visible) { // faxp ?>
	<tr id="r_faxp">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_faxp"><?php echo $t_perusahaan_view->faxp->caption() ?></span></td>
		<td data-name="faxp" <?php echo $t_perusahaan_view->faxp->cellAttributes() ?>>
<span id="el_t_perusahaan_faxp">
<span<?php echo $t_perusahaan_view->faxp->viewAttributes() ?>><?php echo $t_perusahaan_view->faxp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->emailp->Visible) { // emailp ?>
	<tr id="r_emailp">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_emailp"><?php echo $t_perusahaan_view->emailp->caption() ?></span></td>
		<td data-name="emailp" <?php echo $t_perusahaan_view->emailp->cellAttributes() ?>>
<span id="el_t_perusahaan_emailp">
<span<?php echo $t_perusahaan_view->emailp->viewAttributes() ?>><?php echo $t_perusahaan_view->emailp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->webp->Visible) { // webp ?>
	<tr id="r_webp">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_webp"><?php echo $t_perusahaan_view->webp->caption() ?></span></td>
		<td data-name="webp" <?php echo $t_perusahaan_view->webp->cellAttributes() ?>>
<span id="el_t_perusahaan_webp">
<span<?php echo $t_perusahaan_view->webp->viewAttributes() ?>><?php echo $t_perusahaan_view->webp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->medsos->Visible) { // medsos ?>
	<tr id="r_medsos">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_medsos"><?php echo $t_perusahaan_view->medsos->caption() ?></span></td>
		<td data-name="medsos" <?php echo $t_perusahaan_view->medsos->cellAttributes() ?>>
<span id="el_t_perusahaan_medsos">
<span<?php echo $t_perusahaan_view->medsos->viewAttributes() ?>><?php echo $t_perusahaan_view->medsos->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->kdjenis->Visible) { // kdjenis ?>
	<tr id="r_kdjenis">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_kdjenis"><?php echo $t_perusahaan_view->kdjenis->caption() ?></span></td>
		<td data-name="kdjenis" <?php echo $t_perusahaan_view->kdjenis->cellAttributes() ?>>
<span id="el_t_perusahaan_kdjenis">
<span<?php echo $t_perusahaan_view->kdjenis->viewAttributes() ?>><?php echo $t_perusahaan_view->kdjenis->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->kdproduknafed->Visible) { // kdproduknafed ?>
	<tr id="r_kdproduknafed">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_kdproduknafed"><?php echo $t_perusahaan_view->kdproduknafed->caption() ?></span></td>
		<td data-name="kdproduknafed" <?php echo $t_perusahaan_view->kdproduknafed->cellAttributes() ?>>
<span id="el_t_perusahaan_kdproduknafed">
<span<?php echo $t_perusahaan_view->kdproduknafed->viewAttributes() ?>><?php echo $t_perusahaan_view->kdproduknafed->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->kdproduknafed2->Visible) { // kdproduknafed2 ?>
	<tr id="r_kdproduknafed2">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_kdproduknafed2"><?php echo $t_perusahaan_view->kdproduknafed2->caption() ?></span></td>
		<td data-name="kdproduknafed2" <?php echo $t_perusahaan_view->kdproduknafed2->cellAttributes() ?>>
<span id="el_t_perusahaan_kdproduknafed2">
<span<?php echo $t_perusahaan_view->kdproduknafed2->viewAttributes() ?>><?php echo $t_perusahaan_view->kdproduknafed2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->kdproduknafed3->Visible) { // kdproduknafed3 ?>
	<tr id="r_kdproduknafed3">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_kdproduknafed3"><?php echo $t_perusahaan_view->kdproduknafed3->caption() ?></span></td>
		<td data-name="kdproduknafed3" <?php echo $t_perusahaan_view->kdproduknafed3->cellAttributes() ?>>
<span id="el_t_perusahaan_kdproduknafed3">
<span<?php echo $t_perusahaan_view->kdproduknafed3->viewAttributes() ?>><?php echo $t_perusahaan_view->kdproduknafed3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->pproduk->Visible) { // pproduk ?>
	<tr id="r_pproduk">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_pproduk"><?php echo $t_perusahaan_view->pproduk->caption() ?></span></td>
		<td data-name="pproduk" <?php echo $t_perusahaan_view->pproduk->cellAttributes() ?>>
<span id="el_t_perusahaan_pproduk">
<span<?php echo $t_perusahaan_view->pproduk->viewAttributes() ?>><?php echo $t_perusahaan_view->pproduk->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->kdexport->Visible) { // kdexport ?>
	<tr id="r_kdexport">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_kdexport"><?php echo $t_perusahaan_view->kdexport->caption() ?></span></td>
		<td data-name="kdexport" <?php echo $t_perusahaan_view->kdexport->cellAttributes() ?>>
<span id="el_t_perusahaan_kdexport">
<span<?php echo $t_perusahaan_view->kdexport->viewAttributes() ?>><?php echo $t_perusahaan_view->kdexport->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->nexport->Visible) { // nexport ?>
	<tr id="r_nexport">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_nexport"><?php echo $t_perusahaan_view->nexport->caption() ?></span></td>
		<td data-name="nexport" <?php echo $t_perusahaan_view->nexport->cellAttributes() ?>>
<span id="el_t_perusahaan_nexport">
<span<?php echo $t_perusahaan_view->nexport->viewAttributes() ?>><?php echo $t_perusahaan_view->nexport->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->kdskala->Visible) { // kdskala ?>
	<tr id="r_kdskala">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_kdskala"><?php echo $t_perusahaan_view->kdskala->caption() ?></span></td>
		<td data-name="kdskala" <?php echo $t_perusahaan_view->kdskala->cellAttributes() ?>>
<span id="el_t_perusahaan_kdskala">
<span<?php echo $t_perusahaan_view->kdskala->viewAttributes() ?>><?php echo $t_perusahaan_view->kdskala->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->kdkategori->Visible) { // kdkategori ?>
	<tr id="r_kdkategori">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_kdkategori"><?php echo $t_perusahaan_view->kdkategori->caption() ?></span></td>
		<td data-name="kdkategori" <?php echo $t_perusahaan_view->kdkategori->cellAttributes() ?>>
<span id="el_t_perusahaan_kdkategori">
<span<?php echo $t_perusahaan_view->kdkategori->viewAttributes() ?>><?php echo $t_perusahaan_view->kdkategori->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->omzet_saat_ini->Visible) { // omzet_saat_ini ?>
	<tr id="r_omzet_saat_ini">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_omzet_saat_ini"><?php echo $t_perusahaan_view->omzet_saat_ini->caption() ?></span></td>
		<td data-name="omzet_saat_ini" <?php echo $t_perusahaan_view->omzet_saat_ini->cellAttributes() ?>>
<span id="el_t_perusahaan_omzet_saat_ini">
<span<?php echo $t_perusahaan_view->omzet_saat_ini->viewAttributes() ?>><?php echo $t_perusahaan_view->omzet_saat_ini->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->omzet_stl_6bln->Visible) { // omzet_stl_6bln ?>
	<tr id="r_omzet_stl_6bln">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_omzet_stl_6bln"><?php echo $t_perusahaan_view->omzet_stl_6bln->caption() ?></span></td>
		<td data-name="omzet_stl_6bln" <?php echo $t_perusahaan_view->omzet_stl_6bln->cellAttributes() ?>>
<span id="el_t_perusahaan_omzet_stl_6bln">
<span<?php echo $t_perusahaan_view->omzet_stl_6bln->viewAttributes() ?>><?php echo $t_perusahaan_view->omzet_stl_6bln->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->omzet_stl_1thn->Visible) { // omzet_stl_1thn ?>
	<tr id="r_omzet_stl_1thn">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_omzet_stl_1thn"><?php echo $t_perusahaan_view->omzet_stl_1thn->caption() ?></span></td>
		<td data-name="omzet_stl_1thn" <?php echo $t_perusahaan_view->omzet_stl_1thn->cellAttributes() ?>>
<span id="el_t_perusahaan_omzet_stl_1thn">
<span<?php echo $t_perusahaan_view->omzet_stl_1thn->viewAttributes() ?>><?php echo $t_perusahaan_view->omzet_stl_1thn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->omzet_stl_2thn->Visible) { // omzet_stl_2thn ?>
	<tr id="r_omzet_stl_2thn">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_omzet_stl_2thn"><?php echo $t_perusahaan_view->omzet_stl_2thn->caption() ?></span></td>
		<td data-name="omzet_stl_2thn" <?php echo $t_perusahaan_view->omzet_stl_2thn->cellAttributes() ?>>
<span id="el_t_perusahaan_omzet_stl_2thn">
<span<?php echo $t_perusahaan_view->omzet_stl_2thn->viewAttributes() ?>><?php echo $t_perusahaan_view->omzet_stl_2thn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->kapasitas_saat_ini->Visible) { // kapasitas_saat_ini ?>
	<tr id="r_kapasitas_saat_ini">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_kapasitas_saat_ini"><?php echo $t_perusahaan_view->kapasitas_saat_ini->caption() ?></span></td>
		<td data-name="kapasitas_saat_ini" <?php echo $t_perusahaan_view->kapasitas_saat_ini->cellAttributes() ?>>
<span id="el_t_perusahaan_kapasitas_saat_ini">
<span<?php echo $t_perusahaan_view->kapasitas_saat_ini->viewAttributes() ?>><?php echo $t_perusahaan_view->kapasitas_saat_ini->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->kapasitas_stl_6bln->Visible) { // kapasitas_stl_6bln ?>
	<tr id="r_kapasitas_stl_6bln">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_kapasitas_stl_6bln"><?php echo $t_perusahaan_view->kapasitas_stl_6bln->caption() ?></span></td>
		<td data-name="kapasitas_stl_6bln" <?php echo $t_perusahaan_view->kapasitas_stl_6bln->cellAttributes() ?>>
<span id="el_t_perusahaan_kapasitas_stl_6bln">
<span<?php echo $t_perusahaan_view->kapasitas_stl_6bln->viewAttributes() ?>><?php echo $t_perusahaan_view->kapasitas_stl_6bln->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->kapasitas_stl_1thn->Visible) { // kapasitas_stl_1thn ?>
	<tr id="r_kapasitas_stl_1thn">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_kapasitas_stl_1thn"><?php echo $t_perusahaan_view->kapasitas_stl_1thn->caption() ?></span></td>
		<td data-name="kapasitas_stl_1thn" <?php echo $t_perusahaan_view->kapasitas_stl_1thn->cellAttributes() ?>>
<span id="el_t_perusahaan_kapasitas_stl_1thn">
<span<?php echo $t_perusahaan_view->kapasitas_stl_1thn->viewAttributes() ?>><?php echo $t_perusahaan_view->kapasitas_stl_1thn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->kapasitas_stl_2thn->Visible) { // kapasitas_stl_2thn ?>
	<tr id="r_kapasitas_stl_2thn">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_kapasitas_stl_2thn"><?php echo $t_perusahaan_view->kapasitas_stl_2thn->caption() ?></span></td>
		<td data-name="kapasitas_stl_2thn" <?php echo $t_perusahaan_view->kapasitas_stl_2thn->cellAttributes() ?>>
<span id="el_t_perusahaan_kapasitas_stl_2thn">
<span<?php echo $t_perusahaan_view->kapasitas_stl_2thn->viewAttributes() ?>><?php echo $t_perusahaan_view->kapasitas_stl_2thn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_perusahaan_view->jpeserta->Visible) { // jpeserta ?>
	<tr id="r_jpeserta">
		<td class="<?php echo $t_perusahaan_view->TableLeftColumnClass ?>"><span id="elh_t_perusahaan_jpeserta"><?php echo $t_perusahaan_view->jpeserta->caption() ?></span></td>
		<td data-name="jpeserta" <?php echo $t_perusahaan_view->jpeserta->cellAttributes() ?>>
<span id="el_t_perusahaan_jpeserta">
<span<?php echo $t_perusahaan_view->jpeserta->viewAttributes() ?>><?php echo $t_perusahaan_view->jpeserta->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("t_peserta", explode(",", $t_perusahaan->getCurrentDetailTable())) && $t_peserta->DetailView) {
?>
<?php if ($t_perusahaan->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("t_peserta", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $t_perusahaan_view->t_peserta_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "t_pesertagrid.php" ?>
<?php } ?>
</form>
<?php
$t_perusahaan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_perusahaan_view->isExport()) { ?>
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
$t_perusahaan_view->terminate();
?>