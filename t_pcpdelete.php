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
$t_pcp_delete = new t_pcp_delete();

// Run the page
$t_pcp_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pcp_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_pcpdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_pcpdelete = currentForm = new ew.Form("ft_pcpdelete", "delete");
	loadjs.done("ft_pcpdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_pcp_delete->showPageHeader(); ?>
<?php
$t_pcp_delete->showMessage();
?>
<form name="ft_pcpdelete" id="ft_pcpdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_pcp">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_pcp_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_pcp_delete->nama_peserta->Visible) { // nama_peserta ?>
		<th class="<?php echo $t_pcp_delete->nama_peserta->headerCellClass() ?>"><span id="elh_t_pcp_nama_peserta" class="t_pcp_nama_peserta"><?php echo $t_pcp_delete->nama_peserta->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->email_add->Visible) { // email_add ?>
		<th class="<?php echo $t_pcp_delete->email_add->headerCellClass() ?>"><span id="elh_t_pcp_email_add" class="t_pcp_email_add"><?php echo $t_pcp_delete->email_add->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->handphone->Visible) { // handphone ?>
		<th class="<?php echo $t_pcp_delete->handphone->headerCellClass() ?>"><span id="elh_t_pcp_handphone" class="t_pcp_handphone"><?php echo $t_pcp_delete->handphone->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->namap->Visible) { // namap ?>
		<th class="<?php echo $t_pcp_delete->namap->headerCellClass() ?>"><span id="elh_t_pcp_namap" class="t_pcp_namap"><?php echo $t_pcp_delete->namap->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->kategori_produk->Visible) { // kategori_produk ?>
		<th class="<?php echo $t_pcp_delete->kategori_produk->headerCellClass() ?>"><span id="elh_t_pcp_kategori_produk" class="t_pcp_kategori_produk"><?php echo $t_pcp_delete->kategori_produk->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->kategori_produk2->Visible) { // kategori_produk2 ?>
		<th class="<?php echo $t_pcp_delete->kategori_produk2->headerCellClass() ?>"><span id="elh_t_pcp_kategori_produk2" class="t_pcp_kategori_produk2"><?php echo $t_pcp_delete->kategori_produk2->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->kategori_produk3->Visible) { // kategori_produk3 ?>
		<th class="<?php echo $t_pcp_delete->kategori_produk3->headerCellClass() ?>"><span id="elh_t_pcp_kategori_produk3" class="t_pcp_kategori_produk3"><?php echo $t_pcp_delete->kategori_produk3->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->produk->Visible) { // produk ?>
		<th class="<?php echo $t_pcp_delete->produk->headerCellClass() ?>"><span id="elh_t_pcp_produk" class="t_pcp_produk"><?php echo $t_pcp_delete->produk->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->merek_dagang->Visible) { // merek_dagang ?>
		<th class="<?php echo $t_pcp_delete->merek_dagang->headerCellClass() ?>"><span id="elh_t_pcp_merek_dagang" class="t_pcp_merek_dagang"><?php echo $t_pcp_delete->merek_dagang->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->jenis_perusahaan->Visible) { // jenis_perusahaan ?>
		<th class="<?php echo $t_pcp_delete->jenis_perusahaan->headerCellClass() ?>"><span id="elh_t_pcp_jenis_perusahaan" class="t_pcp_jenis_perusahaan"><?php echo $t_pcp_delete->jenis_perusahaan->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->kapasitas_produksi->Visible) { // kapasitas_produksi ?>
		<th class="<?php echo $t_pcp_delete->kapasitas_produksi->headerCellClass() ?>"><span id="elh_t_pcp_kapasitas_produksi" class="t_pcp_kapasitas_produksi"><?php echo $t_pcp_delete->kapasitas_produksi->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->omset->Visible) { // omset ?>
		<th class="<?php echo $t_pcp_delete->omset->headerCellClass() ?>"><span id="elh_t_pcp_omset" class="t_pcp_omset"><?php echo $t_pcp_delete->omset->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->website->Visible) { // website ?>
		<th class="<?php echo $t_pcp_delete->website->headerCellClass() ?>"><span id="elh_t_pcp_website" class="t_pcp_website"><?php echo $t_pcp_delete->website->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->jml_pegawai->Visible) { // jml_pegawai ?>
		<th class="<?php echo $t_pcp_delete->jml_pegawai->headerCellClass() ?>"><span id="elh_t_pcp_jml_pegawai" class="t_pcp_jml_pegawai"><?php echo $t_pcp_delete->jml_pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->jml_pegawai2->Visible) { // jml_pegawai2 ?>
		<th class="<?php echo $t_pcp_delete->jml_pegawai2->headerCellClass() ?>"><span id="elh_t_pcp_jml_pegawai2" class="t_pcp_jml_pegawai2"><?php echo $t_pcp_delete->jml_pegawai2->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->jml_pegawai_tidaktetap->Visible) { // jml_pegawai_tidaktetap ?>
		<th class="<?php echo $t_pcp_delete->jml_pegawai_tidaktetap->headerCellClass() ?>"><span id="elh_t_pcp_jml_pegawai_tidaktetap" class="t_pcp_jml_pegawai_tidaktetap"><?php echo $t_pcp_delete->jml_pegawai_tidaktetap->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->legalitas->Visible) { // legalitas ?>
		<th class="<?php echo $t_pcp_delete->legalitas->headerCellClass() ?>"><span id="elh_t_pcp_legalitas" class="t_pcp_legalitas"><?php echo $t_pcp_delete->legalitas->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->legalitas_lain->Visible) { // legalitas_lain ?>
		<th class="<?php echo $t_pcp_delete->legalitas_lain->headerCellClass() ?>"><span id="elh_t_pcp_legalitas_lain" class="t_pcp_legalitas_lain"><?php echo $t_pcp_delete->legalitas_lain->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->sertifikat->Visible) { // sertifikat ?>
		<th class="<?php echo $t_pcp_delete->sertifikat->headerCellClass() ?>"><span id="elh_t_pcp_sertifikat" class="t_pcp_sertifikat"><?php echo $t_pcp_delete->sertifikat->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->sertifikat_lain->Visible) { // sertifikat_lain ?>
		<th class="<?php echo $t_pcp_delete->sertifikat_lain->headerCellClass() ?>"><span id="elh_t_pcp_sertifikat_lain" class="t_pcp_sertifikat_lain"><?php echo $t_pcp_delete->sertifikat_lain->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->alat_promosi->Visible) { // alat_promosi ?>
		<th class="<?php echo $t_pcp_delete->alat_promosi->headerCellClass() ?>"><span id="elh_t_pcp_alat_promosi" class="t_pcp_alat_promosi"><?php echo $t_pcp_delete->alat_promosi->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->promosi_lain->Visible) { // promosi_lain ?>
		<th class="<?php echo $t_pcp_delete->promosi_lain->headerCellClass() ?>"><span id="elh_t_pcp_promosi_lain" class="t_pcp_promosi_lain"><?php echo $t_pcp_delete->promosi_lain->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->tahun_ecp->Visible) { // tahun_ecp ?>
		<th class="<?php echo $t_pcp_delete->tahun_ecp->headerCellClass() ?>"><span id="elh_t_pcp_tahun_ecp" class="t_pcp_tahun_ecp"><?php echo $t_pcp_delete->tahun_ecp->caption() ?></span></th>
<?php } ?>
<?php if ($t_pcp_delete->wilayah_ecp->Visible) { // wilayah_ecp ?>
		<th class="<?php echo $t_pcp_delete->wilayah_ecp->headerCellClass() ?>"><span id="elh_t_pcp_wilayah_ecp" class="t_pcp_wilayah_ecp"><?php echo $t_pcp_delete->wilayah_ecp->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_pcp_delete->RecordCount = 0;
$i = 0;
while (!$t_pcp_delete->Recordset->EOF) {
	$t_pcp_delete->RecordCount++;
	$t_pcp_delete->RowCount++;

	// Set row properties
	$t_pcp->resetAttributes();
	$t_pcp->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_pcp_delete->loadRowValues($t_pcp_delete->Recordset);

	// Render row
	$t_pcp_delete->renderRow();
?>
	<tr <?php echo $t_pcp->rowAttributes() ?>>
<?php if ($t_pcp_delete->nama_peserta->Visible) { // nama_peserta ?>
		<td <?php echo $t_pcp_delete->nama_peserta->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_nama_peserta" class="t_pcp_nama_peserta">
<span<?php echo $t_pcp_delete->nama_peserta->viewAttributes() ?>><?php echo $t_pcp_delete->nama_peserta->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->email_add->Visible) { // email_add ?>
		<td <?php echo $t_pcp_delete->email_add->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_email_add" class="t_pcp_email_add">
<span<?php echo $t_pcp_delete->email_add->viewAttributes() ?>><?php echo $t_pcp_delete->email_add->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->handphone->Visible) { // handphone ?>
		<td <?php echo $t_pcp_delete->handphone->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_handphone" class="t_pcp_handphone">
<span<?php echo $t_pcp_delete->handphone->viewAttributes() ?>><?php echo $t_pcp_delete->handphone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->namap->Visible) { // namap ?>
		<td <?php echo $t_pcp_delete->namap->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_namap" class="t_pcp_namap">
<span<?php echo $t_pcp_delete->namap->viewAttributes() ?>><?php echo $t_pcp_delete->namap->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->kategori_produk->Visible) { // kategori_produk ?>
		<td <?php echo $t_pcp_delete->kategori_produk->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_kategori_produk" class="t_pcp_kategori_produk">
<span<?php echo $t_pcp_delete->kategori_produk->viewAttributes() ?>><?php echo $t_pcp_delete->kategori_produk->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->kategori_produk2->Visible) { // kategori_produk2 ?>
		<td <?php echo $t_pcp_delete->kategori_produk2->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_kategori_produk2" class="t_pcp_kategori_produk2">
<span<?php echo $t_pcp_delete->kategori_produk2->viewAttributes() ?>><?php echo $t_pcp_delete->kategori_produk2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->kategori_produk3->Visible) { // kategori_produk3 ?>
		<td <?php echo $t_pcp_delete->kategori_produk3->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_kategori_produk3" class="t_pcp_kategori_produk3">
<span<?php echo $t_pcp_delete->kategori_produk3->viewAttributes() ?>><?php echo $t_pcp_delete->kategori_produk3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->produk->Visible) { // produk ?>
		<td <?php echo $t_pcp_delete->produk->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_produk" class="t_pcp_produk">
<span<?php echo $t_pcp_delete->produk->viewAttributes() ?>><?php echo $t_pcp_delete->produk->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->merek_dagang->Visible) { // merek_dagang ?>
		<td <?php echo $t_pcp_delete->merek_dagang->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_merek_dagang" class="t_pcp_merek_dagang">
<span<?php echo $t_pcp_delete->merek_dagang->viewAttributes() ?>><?php echo $t_pcp_delete->merek_dagang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->jenis_perusahaan->Visible) { // jenis_perusahaan ?>
		<td <?php echo $t_pcp_delete->jenis_perusahaan->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_jenis_perusahaan" class="t_pcp_jenis_perusahaan">
<span<?php echo $t_pcp_delete->jenis_perusahaan->viewAttributes() ?>><?php echo $t_pcp_delete->jenis_perusahaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->kapasitas_produksi->Visible) { // kapasitas_produksi ?>
		<td <?php echo $t_pcp_delete->kapasitas_produksi->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_kapasitas_produksi" class="t_pcp_kapasitas_produksi">
<span<?php echo $t_pcp_delete->kapasitas_produksi->viewAttributes() ?>><?php echo $t_pcp_delete->kapasitas_produksi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->omset->Visible) { // omset ?>
		<td <?php echo $t_pcp_delete->omset->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_omset" class="t_pcp_omset">
<span<?php echo $t_pcp_delete->omset->viewAttributes() ?>><?php echo $t_pcp_delete->omset->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->website->Visible) { // website ?>
		<td <?php echo $t_pcp_delete->website->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_website" class="t_pcp_website">
<span<?php echo $t_pcp_delete->website->viewAttributes() ?>><?php echo $t_pcp_delete->website->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->jml_pegawai->Visible) { // jml_pegawai ?>
		<td <?php echo $t_pcp_delete->jml_pegawai->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_jml_pegawai" class="t_pcp_jml_pegawai">
<span<?php echo $t_pcp_delete->jml_pegawai->viewAttributes() ?>><?php echo $t_pcp_delete->jml_pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->jml_pegawai2->Visible) { // jml_pegawai2 ?>
		<td <?php echo $t_pcp_delete->jml_pegawai2->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_jml_pegawai2" class="t_pcp_jml_pegawai2">
<span<?php echo $t_pcp_delete->jml_pegawai2->viewAttributes() ?>><?php echo $t_pcp_delete->jml_pegawai2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->jml_pegawai_tidaktetap->Visible) { // jml_pegawai_tidaktetap ?>
		<td <?php echo $t_pcp_delete->jml_pegawai_tidaktetap->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_jml_pegawai_tidaktetap" class="t_pcp_jml_pegawai_tidaktetap">
<span<?php echo $t_pcp_delete->jml_pegawai_tidaktetap->viewAttributes() ?>><?php echo $t_pcp_delete->jml_pegawai_tidaktetap->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->legalitas->Visible) { // legalitas ?>
		<td <?php echo $t_pcp_delete->legalitas->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_legalitas" class="t_pcp_legalitas">
<span<?php echo $t_pcp_delete->legalitas->viewAttributes() ?>><?php echo $t_pcp_delete->legalitas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->legalitas_lain->Visible) { // legalitas_lain ?>
		<td <?php echo $t_pcp_delete->legalitas_lain->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_legalitas_lain" class="t_pcp_legalitas_lain">
<span<?php echo $t_pcp_delete->legalitas_lain->viewAttributes() ?>><?php echo $t_pcp_delete->legalitas_lain->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->sertifikat->Visible) { // sertifikat ?>
		<td <?php echo $t_pcp_delete->sertifikat->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_sertifikat" class="t_pcp_sertifikat">
<span<?php echo $t_pcp_delete->sertifikat->viewAttributes() ?>><?php echo $t_pcp_delete->sertifikat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->sertifikat_lain->Visible) { // sertifikat_lain ?>
		<td <?php echo $t_pcp_delete->sertifikat_lain->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_sertifikat_lain" class="t_pcp_sertifikat_lain">
<span<?php echo $t_pcp_delete->sertifikat_lain->viewAttributes() ?>><?php echo $t_pcp_delete->sertifikat_lain->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->alat_promosi->Visible) { // alat_promosi ?>
		<td <?php echo $t_pcp_delete->alat_promosi->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_alat_promosi" class="t_pcp_alat_promosi">
<span<?php echo $t_pcp_delete->alat_promosi->viewAttributes() ?>><?php echo $t_pcp_delete->alat_promosi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->promosi_lain->Visible) { // promosi_lain ?>
		<td <?php echo $t_pcp_delete->promosi_lain->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_promosi_lain" class="t_pcp_promosi_lain">
<span<?php echo $t_pcp_delete->promosi_lain->viewAttributes() ?>><?php echo $t_pcp_delete->promosi_lain->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->tahun_ecp->Visible) { // tahun_ecp ?>
		<td <?php echo $t_pcp_delete->tahun_ecp->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_tahun_ecp" class="t_pcp_tahun_ecp">
<span<?php echo $t_pcp_delete->tahun_ecp->viewAttributes() ?>><?php echo $t_pcp_delete->tahun_ecp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_pcp_delete->wilayah_ecp->Visible) { // wilayah_ecp ?>
		<td <?php echo $t_pcp_delete->wilayah_ecp->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_delete->RowCount ?>_t_pcp_wilayah_ecp" class="t_pcp_wilayah_ecp">
<span<?php echo $t_pcp_delete->wilayah_ecp->viewAttributes() ?>><?php echo $t_pcp_delete->wilayah_ecp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_pcp_delete->Recordset->moveNext();
}
$t_pcp_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_pcp_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_pcp_delete->showPageFooter();
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
$t_pcp_delete->terminate();
?>