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
$t_ecp_view = new t_ecp_view();

// Run the page
$t_ecp_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_ecp_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_ecp_view->isExport()) { ?>
<script>
var ft_ecpview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ft_ecpview = currentForm = new ew.Form("ft_ecpview", "view");
	loadjs.done("ft_ecpview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_ecp_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_ecp_view->ExportOptions->render("body") ?>
<?php $t_ecp_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_ecp_view->showPageHeader(); ?>
<?php
$t_ecp_view->showMessage();
?>
<form name="ft_ecpview" id="ft_ecpview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_ecp">
<input type="hidden" name="modal" value="<?php echo (int)$t_ecp_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_ecp_view->ID_ECP->Visible) { // ID_ECP ?>
	<tr id="r_ID_ECP">
		<td class="<?php echo $t_ecp_view->TableLeftColumnClass ?>"><span id="elh_t_ecp_ID_ECP"><?php echo $t_ecp_view->ID_ECP->caption() ?></span></td>
		<td data-name="ID_ECP" <?php echo $t_ecp_view->ID_ECP->cellAttributes() ?>>
<span id="el_t_ecp_ID_ECP">
<span<?php echo $t_ecp_view->ID_ECP->viewAttributes() ?>><?php echo $t_ecp_view->ID_ECP->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_ecp_view->Peserta_ID->Visible) { // Peserta_ID ?>
	<tr id="r_Peserta_ID">
		<td class="<?php echo $t_ecp_view->TableLeftColumnClass ?>"><span id="elh_t_ecp_Peserta_ID"><?php echo $t_ecp_view->Peserta_ID->caption() ?></span></td>
		<td data-name="Peserta_ID" <?php echo $t_ecp_view->Peserta_ID->cellAttributes() ?>>
<span id="el_t_ecp_Peserta_ID">
<span<?php echo $t_ecp_view->Peserta_ID->viewAttributes() ?>><?php echo $t_ecp_view->Peserta_ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_ecp_view->Nama->Visible) { // Nama ?>
	<tr id="r_Nama">
		<td class="<?php echo $t_ecp_view->TableLeftColumnClass ?>"><span id="elh_t_ecp_Nama"><?php echo $t_ecp_view->Nama->caption() ?></span></td>
		<td data-name="Nama" <?php echo $t_ecp_view->Nama->cellAttributes() ?>>
<span id="el_t_ecp_Nama">
<span<?php echo $t_ecp_view->Nama->viewAttributes() ?>><?php echo $t_ecp_view->Nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_ecp_view->Perusahaan->Visible) { // Perusahaan ?>
	<tr id="r_Perusahaan">
		<td class="<?php echo $t_ecp_view->TableLeftColumnClass ?>"><span id="elh_t_ecp_Perusahaan"><?php echo $t_ecp_view->Perusahaan->caption() ?></span></td>
		<td data-name="Perusahaan" <?php echo $t_ecp_view->Perusahaan->cellAttributes() ?>>
<span id="el_t_ecp_Perusahaan">
<span<?php echo $t_ecp_view->Perusahaan->viewAttributes() ?>><?php echo $t_ecp_view->Perusahaan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_ecp_view->Daerah->Visible) { // Daerah ?>
	<tr id="r_Daerah">
		<td class="<?php echo $t_ecp_view->TableLeftColumnClass ?>"><span id="elh_t_ecp_Daerah"><?php echo $t_ecp_view->Daerah->caption() ?></span></td>
		<td data-name="Daerah" <?php echo $t_ecp_view->Daerah->cellAttributes() ?>>
<span id="el_t_ecp_Daerah">
<span<?php echo $t_ecp_view->Daerah->viewAttributes() ?>><?php echo $t_ecp_view->Daerah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_ecp_view->Produk->Visible) { // Produk ?>
	<tr id="r_Produk">
		<td class="<?php echo $t_ecp_view->TableLeftColumnClass ?>"><span id="elh_t_ecp_Produk"><?php echo $t_ecp_view->Produk->caption() ?></span></td>
		<td data-name="Produk" <?php echo $t_ecp_view->Produk->cellAttributes() ?>>
<span id="el_t_ecp_Produk">
<span<?php echo $t_ecp_view->Produk->viewAttributes() ?>><?php echo $t_ecp_view->Produk->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_ecp_view->Tgl_Bln_Ekspor->Visible) { // Tgl_Bln_Ekspor ?>
	<tr id="r_Tgl_Bln_Ekspor">
		<td class="<?php echo $t_ecp_view->TableLeftColumnClass ?>"><span id="elh_t_ecp_Tgl_Bln_Ekspor"><?php echo $t_ecp_view->Tgl_Bln_Ekspor->caption() ?></span></td>
		<td data-name="Tgl_Bln_Ekspor" <?php echo $t_ecp_view->Tgl_Bln_Ekspor->cellAttributes() ?>>
<span id="el_t_ecp_Tgl_Bln_Ekspor">
<span<?php echo $t_ecp_view->Tgl_Bln_Ekspor->viewAttributes() ?>><?php echo $t_ecp_view->Tgl_Bln_Ekspor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_ecp_view->Negara_Tujuan->Visible) { // Negara_Tujuan ?>
	<tr id="r_Negara_Tujuan">
		<td class="<?php echo $t_ecp_view->TableLeftColumnClass ?>"><span id="elh_t_ecp_Negara_Tujuan"><?php echo $t_ecp_view->Negara_Tujuan->caption() ?></span></td>
		<td data-name="Negara_Tujuan" <?php echo $t_ecp_view->Negara_Tujuan->cellAttributes() ?>>
<span id="el_t_ecp_Negara_Tujuan">
<span<?php echo $t_ecp_view->Negara_Tujuan->viewAttributes() ?>><?php echo $t_ecp_view->Negara_Tujuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_ecp_view->Nilai_Ekspor_USD->Visible) { // Nilai_Ekspor_USD ?>
	<tr id="r_Nilai_Ekspor_USD">
		<td class="<?php echo $t_ecp_view->TableLeftColumnClass ?>"><span id="elh_t_ecp_Nilai_Ekspor_USD"><?php echo $t_ecp_view->Nilai_Ekspor_USD->caption() ?></span></td>
		<td data-name="Nilai_Ekspor_USD" <?php echo $t_ecp_view->Nilai_Ekspor_USD->cellAttributes() ?>>
<span id="el_t_ecp_Nilai_Ekspor_USD">
<span<?php echo $t_ecp_view->Nilai_Ekspor_USD->viewAttributes() ?>><?php echo $t_ecp_view->Nilai_Ekspor_USD->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_ecp_view->Nilai_Ekspor_Rupiah->Visible) { // Nilai_Ekspor_Rupiah ?>
	<tr id="r_Nilai_Ekspor_Rupiah">
		<td class="<?php echo $t_ecp_view->TableLeftColumnClass ?>"><span id="elh_t_ecp_Nilai_Ekspor_Rupiah"><?php echo $t_ecp_view->Nilai_Ekspor_Rupiah->caption() ?></span></td>
		<td data-name="Nilai_Ekspor_Rupiah" <?php echo $t_ecp_view->Nilai_Ekspor_Rupiah->cellAttributes() ?>>
<span id="el_t_ecp_Nilai_Ekspor_Rupiah">
<span<?php echo $t_ecp_view->Nilai_Ekspor_Rupiah->viewAttributes() ?>><?php echo $t_ecp_view->Nilai_Ekspor_Rupiah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_ecp_view->Keterangan->Visible) { // Keterangan ?>
	<tr id="r_Keterangan">
		<td class="<?php echo $t_ecp_view->TableLeftColumnClass ?>"><span id="elh_t_ecp_Keterangan"><?php echo $t_ecp_view->Keterangan->caption() ?></span></td>
		<td data-name="Keterangan" <?php echo $t_ecp_view->Keterangan->cellAttributes() ?>>
<span id="el_t_ecp_Keterangan">
<span<?php echo $t_ecp_view->Keterangan->viewAttributes() ?>><?php echo $t_ecp_view->Keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_ecp_view->Wilayah_ECP->Visible) { // Wilayah_ECP ?>
	<tr id="r_Wilayah_ECP">
		<td class="<?php echo $t_ecp_view->TableLeftColumnClass ?>"><span id="elh_t_ecp_Wilayah_ECP"><?php echo $t_ecp_view->Wilayah_ECP->caption() ?></span></td>
		<td data-name="Wilayah_ECP" <?php echo $t_ecp_view->Wilayah_ECP->cellAttributes() ?>>
<span id="el_t_ecp_Wilayah_ECP">
<span<?php echo $t_ecp_view->Wilayah_ECP->viewAttributes() ?>><?php echo $t_ecp_view->Wilayah_ECP->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_ecp_view->Tahun_ECP->Visible) { // Tahun_ECP ?>
	<tr id="r_Tahun_ECP">
		<td class="<?php echo $t_ecp_view->TableLeftColumnClass ?>"><span id="elh_t_ecp_Tahun_ECP"><?php echo $t_ecp_view->Tahun_ECP->caption() ?></span></td>
		<td data-name="Tahun_ECP" <?php echo $t_ecp_view->Tahun_ECP->cellAttributes() ?>>
<span id="el_t_ecp_Tahun_ECP">
<span<?php echo $t_ecp_view->Tahun_ECP->viewAttributes() ?>><?php echo $t_ecp_view->Tahun_ECP->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$t_ecp_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_ecp_view->isExport()) { ?>
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
$t_ecp_view->terminate();
?>