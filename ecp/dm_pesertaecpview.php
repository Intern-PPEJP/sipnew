<?php
namespace PHPMaker2020\input_ecp;

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
$dm_pesertaecp_view = new dm_pesertaecp_view();

// Run the page
$dm_pesertaecp_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dm_pesertaecp_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$dm_pesertaecp_view->isExport()) { ?>
<script>
var fdm_pesertaecpview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdm_pesertaecpview = currentForm = new ew.Form("fdm_pesertaecpview", "view");
	loadjs.done("fdm_pesertaecpview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$dm_pesertaecp_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $dm_pesertaecp_view->ExportOptions->render("body") ?>
<?php $dm_pesertaecp_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $dm_pesertaecp_view->showPageHeader(); ?>
<?php
$dm_pesertaecp_view->showMessage();
?>
<form name="fdm_pesertaecpview" id="fdm_pesertaecpview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dm_pesertaecp">
<input type="hidden" name="modal" value="<?php echo (int)$dm_pesertaecp_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($dm_pesertaecp_view->ID_Unik->Visible) { // ID_Unik ?>
	<tr id="r_ID_Unik">
		<td class="<?php echo $dm_pesertaecp_view->TableLeftColumnClass ?>"><span id="elh_dm_pesertaecp_ID_Unik"><?php echo $dm_pesertaecp_view->ID_Unik->caption() ?></span></td>
		<td data-name="ID_Unik" <?php echo $dm_pesertaecp_view->ID_Unik->cellAttributes() ?>>
<span id="el_dm_pesertaecp_ID_Unik">
<span<?php echo $dm_pesertaecp_view->ID_Unik->viewAttributes() ?>><?php echo $dm_pesertaecp_view->ID_Unik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dm_pesertaecp_view->Nama->Visible) { // Nama ?>
	<tr id="r_Nama">
		<td class="<?php echo $dm_pesertaecp_view->TableLeftColumnClass ?>"><span id="elh_dm_pesertaecp_Nama"><?php echo $dm_pesertaecp_view->Nama->caption() ?></span></td>
		<td data-name="Nama" <?php echo $dm_pesertaecp_view->Nama->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Nama">
<span<?php echo $dm_pesertaecp_view->Nama->viewAttributes() ?>><?php echo $dm_pesertaecp_view->Nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dm_pesertaecp_view->Perusahaan->Visible) { // Perusahaan ?>
	<tr id="r_Perusahaan">
		<td class="<?php echo $dm_pesertaecp_view->TableLeftColumnClass ?>"><span id="elh_dm_pesertaecp_Perusahaan"><?php echo $dm_pesertaecp_view->Perusahaan->caption() ?></span></td>
		<td data-name="Perusahaan" <?php echo $dm_pesertaecp_view->Perusahaan->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Perusahaan">
<span<?php echo $dm_pesertaecp_view->Perusahaan->viewAttributes() ?>><?php echo $dm_pesertaecp_view->Perusahaan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dm_pesertaecp_view->Alamat->Visible) { // Alamat ?>
	<tr id="r_Alamat">
		<td class="<?php echo $dm_pesertaecp_view->TableLeftColumnClass ?>"><span id="elh_dm_pesertaecp_Alamat"><?php echo $dm_pesertaecp_view->Alamat->caption() ?></span></td>
		<td data-name="Alamat" <?php echo $dm_pesertaecp_view->Alamat->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Alamat">
<span<?php echo $dm_pesertaecp_view->Alamat->viewAttributes() ?>><?php echo $dm_pesertaecp_view->Alamat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dm_pesertaecp_view->Produk->Visible) { // Produk ?>
	<tr id="r_Produk">
		<td class="<?php echo $dm_pesertaecp_view->TableLeftColumnClass ?>"><span id="elh_dm_pesertaecp_Produk"><?php echo $dm_pesertaecp_view->Produk->caption() ?></span></td>
		<td data-name="Produk" <?php echo $dm_pesertaecp_view->Produk->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Produk">
<span<?php echo $dm_pesertaecp_view->Produk->viewAttributes() ?>><?php echo $dm_pesertaecp_view->Produk->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dm_pesertaecp_view->Kapasitas_Produksi->Visible) { // Kapasitas_Produksi ?>
	<tr id="r_Kapasitas_Produksi">
		<td class="<?php echo $dm_pesertaecp_view->TableLeftColumnClass ?>"><span id="elh_dm_pesertaecp_Kapasitas_Produksi"><?php echo $dm_pesertaecp_view->Kapasitas_Produksi->caption() ?></span></td>
		<td data-name="Kapasitas_Produksi" <?php echo $dm_pesertaecp_view->Kapasitas_Produksi->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Kapasitas_Produksi">
<span<?php echo $dm_pesertaecp_view->Kapasitas_Produksi->viewAttributes() ?>><?php echo $dm_pesertaecp_view->Kapasitas_Produksi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dm_pesertaecp_view->Omset->Visible) { // Omset ?>
	<tr id="r_Omset">
		<td class="<?php echo $dm_pesertaecp_view->TableLeftColumnClass ?>"><span id="elh_dm_pesertaecp_Omset"><?php echo $dm_pesertaecp_view->Omset->caption() ?></span></td>
		<td data-name="Omset" <?php echo $dm_pesertaecp_view->Omset->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Omset">
<span<?php echo $dm_pesertaecp_view->Omset->viewAttributes() ?>><?php echo $dm_pesertaecp_view->Omset->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dm_pesertaecp_view->Jumlah_Pegawai->Visible) { // Jumlah_Pegawai ?>
	<tr id="r_Jumlah_Pegawai">
		<td class="<?php echo $dm_pesertaecp_view->TableLeftColumnClass ?>"><span id="elh_dm_pesertaecp_Jumlah_Pegawai"><?php echo $dm_pesertaecp_view->Jumlah_Pegawai->caption() ?></span></td>
		<td data-name="Jumlah_Pegawai" <?php echo $dm_pesertaecp_view->Jumlah_Pegawai->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Jumlah_Pegawai">
<span<?php echo $dm_pesertaecp_view->Jumlah_Pegawai->viewAttributes() ?>><?php echo $dm_pesertaecp_view->Jumlah_Pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dm_pesertaecp_view->Legalitas_Perusahaan->Visible) { // Legalitas_Perusahaan ?>
	<tr id="r_Legalitas_Perusahaan">
		<td class="<?php echo $dm_pesertaecp_view->TableLeftColumnClass ?>"><span id="elh_dm_pesertaecp_Legalitas_Perusahaan"><?php echo $dm_pesertaecp_view->Legalitas_Perusahaan->caption() ?></span></td>
		<td data-name="Legalitas_Perusahaan" <?php echo $dm_pesertaecp_view->Legalitas_Perusahaan->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Legalitas_Perusahaan">
<span<?php echo $dm_pesertaecp_view->Legalitas_Perusahaan->viewAttributes() ?>><?php echo $dm_pesertaecp_view->Legalitas_Perusahaan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dm_pesertaecp_view->Sertifikasi_dimiliki->Visible) { // Sertifikasi_dimiliki ?>
	<tr id="r_Sertifikasi_dimiliki">
		<td class="<?php echo $dm_pesertaecp_view->TableLeftColumnClass ?>"><span id="elh_dm_pesertaecp_Sertifikasi_dimiliki"><?php echo $dm_pesertaecp_view->Sertifikasi_dimiliki->caption() ?></span></td>
		<td data-name="Sertifikasi_dimiliki" <?php echo $dm_pesertaecp_view->Sertifikasi_dimiliki->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Sertifikasi_dimiliki">
<span<?php echo $dm_pesertaecp_view->Sertifikasi_dimiliki->viewAttributes() ?>><?php echo $dm_pesertaecp_view->Sertifikasi_dimiliki->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dm_pesertaecp_view->Handphone->Visible) { // Handphone ?>
	<tr id="r_Handphone">
		<td class="<?php echo $dm_pesertaecp_view->TableLeftColumnClass ?>"><span id="elh_dm_pesertaecp_Handphone"><?php echo $dm_pesertaecp_view->Handphone->caption() ?></span></td>
		<td data-name="Handphone" <?php echo $dm_pesertaecp_view->Handphone->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Handphone">
<span<?php echo $dm_pesertaecp_view->Handphone->viewAttributes() ?>><?php echo $dm_pesertaecp_view->Handphone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dm_pesertaecp_view->Email_Add->Visible) { // Email_Add ?>
	<tr id="r_Email_Add">
		<td class="<?php echo $dm_pesertaecp_view->TableLeftColumnClass ?>"><span id="elh_dm_pesertaecp_Email_Add"><?php echo $dm_pesertaecp_view->Email_Add->caption() ?></span></td>
		<td data-name="Email_Add" <?php echo $dm_pesertaecp_view->Email_Add->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Email_Add">
<span<?php echo $dm_pesertaecp_view->Email_Add->viewAttributes() ?>><?php echo $dm_pesertaecp_view->Email_Add->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dm_pesertaecp_view->Website->Visible) { // Website ?>
	<tr id="r_Website">
		<td class="<?php echo $dm_pesertaecp_view->TableLeftColumnClass ?>"><span id="elh_dm_pesertaecp_Website"><?php echo $dm_pesertaecp_view->Website->caption() ?></span></td>
		<td data-name="Website" <?php echo $dm_pesertaecp_view->Website->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Website">
<span<?php echo $dm_pesertaecp_view->Website->viewAttributes() ?>><?php echo $dm_pesertaecp_view->Website->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dm_pesertaecp_view->Tahun_Berdiri->Visible) { // Tahun_Berdiri ?>
	<tr id="r_Tahun_Berdiri">
		<td class="<?php echo $dm_pesertaecp_view->TableLeftColumnClass ?>"><span id="elh_dm_pesertaecp_Tahun_Berdiri"><?php echo $dm_pesertaecp_view->Tahun_Berdiri->caption() ?></span></td>
		<td data-name="Tahun_Berdiri" <?php echo $dm_pesertaecp_view->Tahun_Berdiri->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Tahun_Berdiri">
<span<?php echo $dm_pesertaecp_view->Tahun_Berdiri->viewAttributes() ?>><?php echo $dm_pesertaecp_view->Tahun_Berdiri->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dm_pesertaecp_view->Alamat_Produksi->Visible) { // Alamat_Produksi ?>
	<tr id="r_Alamat_Produksi">
		<td class="<?php echo $dm_pesertaecp_view->TableLeftColumnClass ?>"><span id="elh_dm_pesertaecp_Alamat_Produksi"><?php echo $dm_pesertaecp_view->Alamat_Produksi->caption() ?></span></td>
		<td data-name="Alamat_Produksi" <?php echo $dm_pesertaecp_view->Alamat_Produksi->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Alamat_Produksi">
<span<?php echo $dm_pesertaecp_view->Alamat_Produksi->viewAttributes() ?>><?php echo $dm_pesertaecp_view->Alamat_Produksi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dm_pesertaecp_view->Wilayah_ECP->Visible) { // Wilayah_ECP ?>
	<tr id="r_Wilayah_ECP">
		<td class="<?php echo $dm_pesertaecp_view->TableLeftColumnClass ?>"><span id="elh_dm_pesertaecp_Wilayah_ECP"><?php echo $dm_pesertaecp_view->Wilayah_ECP->caption() ?></span></td>
		<td data-name="Wilayah_ECP" <?php echo $dm_pesertaecp_view->Wilayah_ECP->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Wilayah_ECP">
<span<?php echo $dm_pesertaecp_view->Wilayah_ECP->viewAttributes() ?>><?php echo $dm_pesertaecp_view->Wilayah_ECP->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dm_pesertaecp_view->Tahun_ECP->Visible) { // Tahun_ECP ?>
	<tr id="r_Tahun_ECP">
		<td class="<?php echo $dm_pesertaecp_view->TableLeftColumnClass ?>"><span id="elh_dm_pesertaecp_Tahun_ECP"><?php echo $dm_pesertaecp_view->Tahun_ECP->caption() ?></span></td>
		<td data-name="Tahun_ECP" <?php echo $dm_pesertaecp_view->Tahun_ECP->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Tahun_ECP">
<span<?php echo $dm_pesertaecp_view->Tahun_ECP->viewAttributes() ?>><?php echo $dm_pesertaecp_view->Tahun_ECP->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$dm_pesertaecp_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$dm_pesertaecp_view->isExport()) { ?>
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
$dm_pesertaecp_view->terminate();
?>