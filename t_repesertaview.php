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
$t_repeserta_view = new t_repeserta_view();

// Run the page
$t_repeserta_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_repeserta_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_repeserta_view->isExport()) { ?>
<script>
var ft_repesertaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ft_repesertaview = currentForm = new ew.Form("ft_repesertaview", "view");
	loadjs.done("ft_repesertaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//document.write('<?php echo cs_judul("view","Rekrutmen Peserta : View Data");?>');

});
</script>
<?php } ?>
<?php if (!$t_repeserta_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_repeserta_view->ExportOptions->render("body") ?>
<?php $t_repeserta_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_repeserta_view->showPageHeader(); ?>
<?php
$t_repeserta_view->showMessage();
?>
<form name="ft_repesertaview" id="ft_repesertaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_repeserta">
<input type="hidden" name="modal" value="<?php echo (int)$t_repeserta_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_repeserta_view->idpelat->Visible) { // idpelat ?>
	<tr id="r_idpelat">
		<td class="<?php echo $t_repeserta_view->TableLeftColumnClass ?>"><span id="elh_t_repeserta_idpelat"><?php echo $t_repeserta_view->idpelat->caption() ?></span></td>
		<td data-name="idpelat" <?php echo $t_repeserta_view->idpelat->cellAttributes() ?>>
<span id="el_t_repeserta_idpelat">
<span<?php echo $t_repeserta_view->idpelat->viewAttributes() ?>><?php echo $t_repeserta_view->idpelat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_repeserta_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $t_repeserta_view->TableLeftColumnClass ?>"><span id="elh_t_repeserta_nama"><?php echo $t_repeserta_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $t_repeserta_view->nama->cellAttributes() ?>>
<span id="el_t_repeserta_nama">
<span<?php echo $t_repeserta_view->nama->viewAttributes() ?>><?php echo $t_repeserta_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_repeserta_view->perusahaan->Visible) { // perusahaan ?>
	<tr id="r_perusahaan">
		<td class="<?php echo $t_repeserta_view->TableLeftColumnClass ?>"><span id="elh_t_repeserta_perusahaan"><?php echo $t_repeserta_view->perusahaan->caption() ?></span></td>
		<td data-name="perusahaan" <?php echo $t_repeserta_view->perusahaan->cellAttributes() ?>>
<span id="el_t_repeserta_perusahaan">
<span<?php echo $t_repeserta_view->perusahaan->viewAttributes() ?>><?php echo $t_repeserta_view->perusahaan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_repeserta_view->jabatan->Visible) { // jabatan ?>
	<tr id="r_jabatan">
		<td class="<?php echo $t_repeserta_view->TableLeftColumnClass ?>"><span id="elh_t_repeserta_jabatan"><?php echo $t_repeserta_view->jabatan->caption() ?></span></td>
		<td data-name="jabatan" <?php echo $t_repeserta_view->jabatan->cellAttributes() ?>>
<span id="el_t_repeserta_jabatan">
<span<?php echo $t_repeserta_view->jabatan->viewAttributes() ?>><?php echo $t_repeserta_view->jabatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_repeserta_view->tgl_daftar->Visible) { // tgl_daftar ?>
	<tr id="r_tgl_daftar">
		<td class="<?php echo $t_repeserta_view->TableLeftColumnClass ?>"><span id="elh_t_repeserta_tgl_daftar"><?php echo $t_repeserta_view->tgl_daftar->caption() ?></span></td>
		<td data-name="tgl_daftar" <?php echo $t_repeserta_view->tgl_daftar->cellAttributes() ?>>
<span id="el_t_repeserta_tgl_daftar">
<span<?php echo $t_repeserta_view->tgl_daftar->viewAttributes() ?>><?php echo $t_repeserta_view->tgl_daftar->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_repeserta_view->telp->Visible) { // telp ?>
	<tr id="r_telp">
		<td class="<?php echo $t_repeserta_view->TableLeftColumnClass ?>"><span id="elh_t_repeserta_telp"><?php echo $t_repeserta_view->telp->caption() ?></span></td>
		<td data-name="telp" <?php echo $t_repeserta_view->telp->cellAttributes() ?>>
<span id="el_t_repeserta_telp">
<span<?php echo $t_repeserta_view->telp->viewAttributes() ?>><?php echo $t_repeserta_view->telp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_repeserta_view->fax->Visible) { // fax ?>
	<tr id="r_fax">
		<td class="<?php echo $t_repeserta_view->TableLeftColumnClass ?>"><span id="elh_t_repeserta_fax"><?php echo $t_repeserta_view->fax->caption() ?></span></td>
		<td data-name="fax" <?php echo $t_repeserta_view->fax->cellAttributes() ?>>
<span id="el_t_repeserta_fax">
<span<?php echo $t_repeserta_view->fax->viewAttributes() ?>><?php echo $t_repeserta_view->fax->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_repeserta_view->hp->Visible) { // hp ?>
	<tr id="r_hp">
		<td class="<?php echo $t_repeserta_view->TableLeftColumnClass ?>"><span id="elh_t_repeserta_hp"><?php echo $t_repeserta_view->hp->caption() ?></span></td>
		<td data-name="hp" <?php echo $t_repeserta_view->hp->cellAttributes() ?>>
<span id="el_t_repeserta_hp">
<span<?php echo $t_repeserta_view->hp->viewAttributes() ?>><?php echo $t_repeserta_view->hp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_repeserta_view->produk->Visible) { // produk ?>
	<tr id="r_produk">
		<td class="<?php echo $t_repeserta_view->TableLeftColumnClass ?>"><span id="elh_t_repeserta_produk"><?php echo $t_repeserta_view->produk->caption() ?></span></td>
		<td data-name="produk" <?php echo $t_repeserta_view->produk->cellAttributes() ?>>
<span id="el_t_repeserta_produk">
<span<?php echo $t_repeserta_view->produk->viewAttributes() ?>><?php echo $t_repeserta_view->produk->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_repeserta_view->cara_bayar->Visible) { // cara_bayar ?>
	<tr id="r_cara_bayar">
		<td class="<?php echo $t_repeserta_view->TableLeftColumnClass ?>"><span id="elh_t_repeserta_cara_bayar"><?php echo $t_repeserta_view->cara_bayar->caption() ?></span></td>
		<td data-name="cara_bayar" <?php echo $t_repeserta_view->cara_bayar->cellAttributes() ?>>
<span id="el_t_repeserta_cara_bayar">
<span<?php echo $t_repeserta_view->cara_bayar->viewAttributes() ?>><?php echo $t_repeserta_view->cara_bayar->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_repeserta_view->ket_bayar->Visible) { // ket_bayar ?>
	<tr id="r_ket_bayar">
		<td class="<?php echo $t_repeserta_view->TableLeftColumnClass ?>"><span id="elh_t_repeserta_ket_bayar"><?php echo $t_repeserta_view->ket_bayar->caption() ?></span></td>
		<td data-name="ket_bayar" <?php echo $t_repeserta_view->ket_bayar->cellAttributes() ?>>
<span id="el_t_repeserta_ket_bayar">
<span<?php echo $t_repeserta_view->ket_bayar->viewAttributes() ?>><?php echo $t_repeserta_view->ket_bayar->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_repeserta_view->tgl_bayar->Visible) { // tgl_bayar ?>
	<tr id="r_tgl_bayar">
		<td class="<?php echo $t_repeserta_view->TableLeftColumnClass ?>"><span id="elh_t_repeserta_tgl_bayar"><?php echo $t_repeserta_view->tgl_bayar->caption() ?></span></td>
		<td data-name="tgl_bayar" <?php echo $t_repeserta_view->tgl_bayar->cellAttributes() ?>>
<span id="el_t_repeserta_tgl_bayar">
<span<?php echo $t_repeserta_view->tgl_bayar->viewAttributes() ?>><?php echo $t_repeserta_view->tgl_bayar->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_repeserta_view->kdinformasi->Visible) { // kdinformasi ?>
	<tr id="r_kdinformasi">
		<td class="<?php echo $t_repeserta_view->TableLeftColumnClass ?>"><span id="elh_t_repeserta_kdinformasi"><?php echo $t_repeserta_view->kdinformasi->caption() ?></span></td>
		<td data-name="kdinformasi" <?php echo $t_repeserta_view->kdinformasi->cellAttributes() ?>>
<span id="el_t_repeserta_kdinformasi">
<span<?php echo $t_repeserta_view->kdinformasi->viewAttributes() ?>><?php echo $t_repeserta_view->kdinformasi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_repeserta_view->konfirmasi->Visible) { // konfirmasi ?>
	<tr id="r_konfirmasi">
		<td class="<?php echo $t_repeserta_view->TableLeftColumnClass ?>"><span id="elh_t_repeserta_konfirmasi"><?php echo $t_repeserta_view->konfirmasi->caption() ?></span></td>
		<td data-name="konfirmasi" <?php echo $t_repeserta_view->konfirmasi->cellAttributes() ?>>
<span id="el_t_repeserta_konfirmasi">
<span<?php echo $t_repeserta_view->konfirmasi->viewAttributes() ?>><?php echo $t_repeserta_view->konfirmasi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_repeserta_view->ket->Visible) { // ket ?>
	<tr id="r_ket">
		<td class="<?php echo $t_repeserta_view->TableLeftColumnClass ?>"><span id="elh_t_repeserta_ket"><?php echo $t_repeserta_view->ket->caption() ?></span></td>
		<td data-name="ket" <?php echo $t_repeserta_view->ket->cellAttributes() ?>>
<span id="el_t_repeserta_ket">
<span<?php echo $t_repeserta_view->ket->viewAttributes() ?>><?php echo $t_repeserta_view->ket->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_repeserta_view->updated_at->Visible) { // updated_at ?>
	<tr id="r_updated_at">
		<td class="<?php echo $t_repeserta_view->TableLeftColumnClass ?>"><span id="elh_t_repeserta_updated_at"><?php echo $t_repeserta_view->updated_at->caption() ?></span></td>
		<td data-name="updated_at" <?php echo $t_repeserta_view->updated_at->cellAttributes() ?>>
<span id="el_t_repeserta_updated_at">
<span<?php echo $t_repeserta_view->updated_at->viewAttributes() ?>><?php echo $t_repeserta_view->updated_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_repeserta_view->created_at->Visible) { // created_at ?>
	<tr id="r_created_at">
		<td class="<?php echo $t_repeserta_view->TableLeftColumnClass ?>"><span id="elh_t_repeserta_created_at"><?php echo $t_repeserta_view->created_at->caption() ?></span></td>
		<td data-name="created_at" <?php echo $t_repeserta_view->created_at->cellAttributes() ?>>
<span id="el_t_repeserta_created_at">
<span<?php echo $t_repeserta_view->created_at->viewAttributes() ?>><?php echo $t_repeserta_view->created_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_repeserta_view->ket_lainnya->Visible) { // ket_lainnya ?>
	<tr id="r_ket_lainnya">
		<td class="<?php echo $t_repeserta_view->TableLeftColumnClass ?>"><span id="elh_t_repeserta_ket_lainnya"><?php echo $t_repeserta_view->ket_lainnya->caption() ?></span></td>
		<td data-name="ket_lainnya" <?php echo $t_repeserta_view->ket_lainnya->cellAttributes() ?>>
<span id="el_t_repeserta_ket_lainnya">
<span<?php echo $t_repeserta_view->ket_lainnya->viewAttributes() ?>><?php echo $t_repeserta_view->ket_lainnya->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$t_repeserta_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_repeserta_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$("#r_idpelat").hide();
});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$t_repeserta_view->terminate();
?>