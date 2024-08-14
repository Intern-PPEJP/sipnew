<?php

namespace PHPMaker2021\import_ppei;

// Page object
$DataMasterView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fdata_masterview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fdata_masterview = currentForm = new ew.Form("fdata_masterview", "view");
    loadjs.done("fdata_masterview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.data_master) ew.vars.tables.data_master = <?= JsonEncode(GetClientVar("tables", "data_master")) ?>;
</script>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fdata_masterview" id="fdata_masterview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="data_master">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->dipindahkan->Visible) { // dipindahkan ?>
    <tr id="r_dipindahkan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_dipindahkan"><?= $Page->dipindahkan->caption() ?></span></td>
        <td data-name="dipindahkan" <?= $Page->dipindahkan->cellAttributes() ?>>
<span id="el_data_master_dipindahkan">
<span<?= $Page->dipindahkan->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_dipindahkan_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->dipindahkan->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->dipindahkan->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_dipindahkan_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_data_master_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kdpelat->Visible) { // kdpelat ?>
    <tr id="r_kdpelat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_kdpelat"><?= $Page->kdpelat->caption() ?></span></td>
        <td data-name="kdpelat" <?= $Page->kdpelat->cellAttributes() ?>>
<span id="el_data_master_kdpelat">
<span<?= $Page->kdpelat->viewAttributes() ?>>
<?= $Page->kdpelat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Email_Address->Visible) { // Email_Address ?>
    <tr id="r_Email_Address">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Email_Address"><?= $Page->Email_Address->caption() ?></span></td>
        <td data-name="Email_Address" <?= $Page->Email_Address->cellAttributes() ?>>
<span id="el_data_master_Email_Address">
<span<?= $Page->Email_Address->viewAttributes() ?>>
<?= $Page->Email_Address->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Nama_Lengkap->Visible) { // Nama_Lengkap ?>
    <tr id="r_Nama_Lengkap">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Nama_Lengkap"><?= $Page->Nama_Lengkap->caption() ?></span></td>
        <td data-name="Nama_Lengkap" <?= $Page->Nama_Lengkap->cellAttributes() ?>>
<span id="el_data_master_Nama_Lengkap">
<span<?= $Page->Nama_Lengkap->viewAttributes() ?>>
<?= $Page->Nama_Lengkap->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Nomor_Handphone->Visible) { // Nomor_Handphone ?>
    <tr id="r_Nomor_Handphone">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Nomor_Handphone"><?= $Page->Nomor_Handphone->caption() ?></span></td>
        <td data-name="Nomor_Handphone" <?= $Page->Nomor_Handphone->cellAttributes() ?>>
<span id="el_data_master_Nomor_Handphone">
<span<?= $Page->Nomor_Handphone->viewAttributes() ?>>
<?= $Page->Nomor_Handphone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Jenis_Kelamin->Visible) { // Jenis_Kelamin ?>
    <tr id="r_Jenis_Kelamin">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Jenis_Kelamin"><?= $Page->Jenis_Kelamin->caption() ?></span></td>
        <td data-name="Jenis_Kelamin" <?= $Page->Jenis_Kelamin->cellAttributes() ?>>
<span id="el_data_master_Jenis_Kelamin">
<span<?= $Page->Jenis_Kelamin->viewAttributes() ?>>
<?= $Page->Jenis_Kelamin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Tempat_Lahir->Visible) { // Tempat_Lahir ?>
    <tr id="r_Tempat_Lahir">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Tempat_Lahir"><?= $Page->Tempat_Lahir->caption() ?></span></td>
        <td data-name="Tempat_Lahir" <?= $Page->Tempat_Lahir->cellAttributes() ?>>
<span id="el_data_master_Tempat_Lahir">
<span<?= $Page->Tempat_Lahir->viewAttributes() ?>>
<?= $Page->Tempat_Lahir->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Tanggal_Lahir->Visible) { // Tanggal_Lahir ?>
    <tr id="r_Tanggal_Lahir">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Tanggal_Lahir"><?= $Page->Tanggal_Lahir->caption() ?></span></td>
        <td data-name="Tanggal_Lahir" <?= $Page->Tanggal_Lahir->cellAttributes() ?>>
<span id="el_data_master_Tanggal_Lahir">
<span<?= $Page->Tanggal_Lahir->viewAttributes() ?>>
<?= $Page->Tanggal_Lahir->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Alamat_Tinggal->Visible) { // Alamat_Tinggal ?>
    <tr id="r_Alamat_Tinggal">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Alamat_Tinggal"><?= $Page->Alamat_Tinggal->caption() ?></span></td>
        <td data-name="Alamat_Tinggal" <?= $Page->Alamat_Tinggal->cellAttributes() ?>>
<span id="el_data_master_Alamat_Tinggal">
<span<?= $Page->Alamat_Tinggal->viewAttributes() ?>>
<?= $Page->Alamat_Tinggal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Provinsi->Visible) { // Provinsi ?>
    <tr id="r_Provinsi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Provinsi"><?= $Page->Provinsi->caption() ?></span></td>
        <td data-name="Provinsi" <?= $Page->Provinsi->cellAttributes() ?>>
<span id="el_data_master_Provinsi">
<span<?= $Page->Provinsi->viewAttributes() ?>>
<?= $Page->Provinsi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Kabupaten_Kota->Visible) { // Kabupaten_Kota ?>
    <tr id="r_Kabupaten_Kota">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Kabupaten_Kota"><?= $Page->Kabupaten_Kota->caption() ?></span></td>
        <td data-name="Kabupaten_Kota" <?= $Page->Kabupaten_Kota->cellAttributes() ?>>
<span id="el_data_master_Kabupaten_Kota">
<span<?= $Page->Kabupaten_Kota->viewAttributes() ?>>
<?= $Page->Kabupaten_Kota->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Jabatan_di_Perusahaan->Visible) { // Jabatan_di_Perusahaan ?>
    <tr id="r_Jabatan_di_Perusahaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Jabatan_di_Perusahaan"><?= $Page->Jabatan_di_Perusahaan->caption() ?></span></td>
        <td data-name="Jabatan_di_Perusahaan" <?= $Page->Jabatan_di_Perusahaan->cellAttributes() ?>>
<span id="el_data_master_Jabatan_di_Perusahaan">
<span<?= $Page->Jabatan_di_Perusahaan->viewAttributes() ?>>
<?= $Page->Jabatan_di_Perusahaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Pendidikan->Visible) { // Pendidikan ?>
    <tr id="r_Pendidikan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Pendidikan"><?= $Page->Pendidikan->caption() ?></span></td>
        <td data-name="Pendidikan" <?= $Page->Pendidikan->cellAttributes() ?>>
<span id="el_data_master_Pendidikan">
<span<?= $Page->Pendidikan->viewAttributes() ?>>
<?= $Page->Pendidikan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Nama_Perusahaan_Instansi->Visible) { // Nama_Perusahaan_Instansi ?>
    <tr id="r_Nama_Perusahaan_Instansi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Nama_Perusahaan_Instansi"><?= $Page->Nama_Perusahaan_Instansi->caption() ?></span></td>
        <td data-name="Nama_Perusahaan_Instansi" <?= $Page->Nama_Perusahaan_Instansi->cellAttributes() ?>>
<span id="el_data_master_Nama_Perusahaan_Instansi">
<span<?= $Page->Nama_Perusahaan_Instansi->viewAttributes() ?>>
<?= $Page->Nama_Perusahaan_Instansi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Contact_Person_Perusahaan->Visible) { // Contact_Person_Perusahaan ?>
    <tr id="r_Contact_Person_Perusahaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Contact_Person_Perusahaan"><?= $Page->Contact_Person_Perusahaan->caption() ?></span></td>
        <td data-name="Contact_Person_Perusahaan" <?= $Page->Contact_Person_Perusahaan->cellAttributes() ?>>
<span id="el_data_master_Contact_Person_Perusahaan">
<span<?= $Page->Contact_Person_Perusahaan->viewAttributes() ?>>
<?= $Page->Contact_Person_Perusahaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Telepon_Kantor->Visible) { // Telepon_Kantor ?>
    <tr id="r_Telepon_Kantor">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Telepon_Kantor"><?= $Page->Telepon_Kantor->caption() ?></span></td>
        <td data-name="Telepon_Kantor" <?= $Page->Telepon_Kantor->cellAttributes() ?>>
<span id="el_data_master_Telepon_Kantor">
<span<?= $Page->Telepon_Kantor->viewAttributes() ?>>
<?= $Page->Telepon_Kantor->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_Email->Visible) { // Email ?>
    <tr id="r__Email">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master__Email"><?= $Page->_Email->caption() ?></span></td>
        <td data-name="_Email" <?= $Page->_Email->cellAttributes() ?>>
<span id="el_data_master__Email">
<span<?= $Page->_Email->viewAttributes() ?>>
<?= $Page->_Email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Website->Visible) { // Website ?>
    <tr id="r_Website">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Website"><?= $Page->Website->caption() ?></span></td>
        <td data-name="Website" <?= $Page->Website->cellAttributes() ?>>
<span id="el_data_master_Website">
<span<?= $Page->Website->viewAttributes() ?>>
<?= $Page->Website->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Alamat_Kantor->Visible) { // Alamat_Kantor ?>
    <tr id="r_Alamat_Kantor">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Alamat_Kantor"><?= $Page->Alamat_Kantor->caption() ?></span></td>
        <td data-name="Alamat_Kantor" <?= $Page->Alamat_Kantor->cellAttributes() ?>>
<span id="el_data_master_Alamat_Kantor">
<span<?= $Page->Alamat_Kantor->viewAttributes() ?>>
<?= $Page->Alamat_Kantor->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Provinsi2->Visible) { // Provinsi2 ?>
    <tr id="r_Provinsi2">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Provinsi2"><?= $Page->Provinsi2->caption() ?></span></td>
        <td data-name="Provinsi2" <?= $Page->Provinsi2->cellAttributes() ?>>
<span id="el_data_master_Provinsi2">
<span<?= $Page->Provinsi2->viewAttributes() ?>>
<?= $Page->Provinsi2->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Kabupaten_Kota2->Visible) { // Kabupaten_Kota2 ?>
    <tr id="r_Kabupaten_Kota2">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Kabupaten_Kota2"><?= $Page->Kabupaten_Kota2->caption() ?></span></td>
        <td data-name="Kabupaten_Kota2" <?= $Page->Kabupaten_Kota2->cellAttributes() ?>>
<span id="el_data_master_Kabupaten_Kota2">
<span<?= $Page->Kabupaten_Kota2->viewAttributes() ?>>
<?= $Page->Kabupaten_Kota2->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ID_Sosial_Media->Visible) { // ID_Sosial_Media ?>
    <tr id="r_ID_Sosial_Media">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_ID_Sosial_Media"><?= $Page->ID_Sosial_Media->caption() ?></span></td>
        <td data-name="ID_Sosial_Media" <?= $Page->ID_Sosial_Media->cellAttributes() ?>>
<span id="el_data_master_ID_Sosial_Media">
<span<?= $Page->ID_Sosial_Media->viewAttributes() ?>>
<?= $Page->ID_Sosial_Media->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Kategori_perusahaan->Visible) { // Kategori_perusahaan ?>
    <tr id="r_Kategori_perusahaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Kategori_perusahaan"><?= $Page->Kategori_perusahaan->caption() ?></span></td>
        <td data-name="Kategori_perusahaan" <?= $Page->Kategori_perusahaan->cellAttributes() ?>>
<span id="el_data_master_Kategori_perusahaan">
<span<?= $Page->Kategori_perusahaan->viewAttributes() ?>>
<?= $Page->Kategori_perusahaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Jenis_Usaha->Visible) { // Jenis_Usaha ?>
    <tr id="r_Jenis_Usaha">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Jenis_Usaha"><?= $Page->Jenis_Usaha->caption() ?></span></td>
        <td data-name="Jenis_Usaha" <?= $Page->Jenis_Usaha->cellAttributes() ?>>
<span id="el_data_master_Jenis_Usaha">
<span<?= $Page->Jenis_Usaha->viewAttributes() ?>>
<?= $Page->Jenis_Usaha->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Skala_Perusahaan->Visible) { // Skala_Perusahaan ?>
    <tr id="r_Skala_Perusahaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Skala_Perusahaan"><?= $Page->Skala_Perusahaan->caption() ?></span></td>
        <td data-name="Skala_Perusahaan" <?= $Page->Skala_Perusahaan->cellAttributes() ?>>
<span id="el_data_master_Skala_Perusahaan">
<span<?= $Page->Skala_Perusahaan->viewAttributes() ?>>
<?= $Page->Skala_Perusahaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Kategori_Produk->Visible) { // Kategori_Produk ?>
    <tr id="r_Kategori_Produk">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Kategori_Produk"><?= $Page->Kategori_Produk->caption() ?></span></td>
        <td data-name="Kategori_Produk" <?= $Page->Kategori_Produk->cellAttributes() ?>>
<span id="el_data_master_Kategori_Produk">
<span<?= $Page->Kategori_Produk->viewAttributes() ?>>
<?= $Page->Kategori_Produk->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Produk_Perusahaan->Visible) { // Produk_Perusahaan ?>
    <tr id="r_Produk_Perusahaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Produk_Perusahaan"><?= $Page->Produk_Perusahaan->caption() ?></span></td>
        <td data-name="Produk_Perusahaan" <?= $Page->Produk_Perusahaan->cellAttributes() ?>>
<span id="el_data_master_Produk_Perusahaan">
<span<?= $Page->Produk_Perusahaan->viewAttributes() ?>>
<?= $Page->Produk_Perusahaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->HS_Code_Product->Visible) { // HS_Code_Product ?>
    <tr id="r_HS_Code_Product">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_HS_Code_Product"><?= $Page->HS_Code_Product->caption() ?></span></td>
        <td data-name="HS_Code_Product" <?= $Page->HS_Code_Product->cellAttributes() ?>>
<span id="el_data_master_HS_Code_Product">
<span<?= $Page->HS_Code_Product->viewAttributes() ?>>
<?= $Page->HS_Code_Product->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Omset_Perusahaan->Visible) { // Omset_Perusahaan ?>
    <tr id="r_Omset_Perusahaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Omset_Perusahaan"><?= $Page->Omset_Perusahaan->caption() ?></span></td>
        <td data-name="Omset_Perusahaan" <?= $Page->Omset_Perusahaan->cellAttributes() ?>>
<span id="el_data_master_Omset_Perusahaan">
<span<?= $Page->Omset_Perusahaan->viewAttributes() ?>>
<?= $Page->Omset_Perusahaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Kapasitas_Produksi->Visible) { // Kapasitas_Produksi ?>
    <tr id="r_Kapasitas_Produksi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Kapasitas_Produksi"><?= $Page->Kapasitas_Produksi->caption() ?></span></td>
        <td data-name="Kapasitas_Produksi" <?= $Page->Kapasitas_Produksi->cellAttributes() ?>>
<span id="el_data_master_Kapasitas_Produksi">
<span<?= $Page->Kapasitas_Produksi->viewAttributes() ?>>
<?= $Page->Kapasitas_Produksi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Pengalaman_Ekspor->Visible) { // Pengalaman_Ekspor ?>
    <tr id="r_Pengalaman_Ekspor">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_Pengalaman_Ekspor"><?= $Page->Pengalaman_Ekspor->caption() ?></span></td>
        <td data-name="Pengalaman_Ekspor" <?= $Page->Pengalaman_Ekspor->cellAttributes() ?>>
<span id="el_data_master_Pengalaman_Ekspor">
<span<?= $Page->Pengalaman_Ekspor->viewAttributes() ?>>
<?= $Page->Pengalaman_Ekspor->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ekspor_ke_negara_mana->Visible) { // ekspor_ke_negara_mana ?>
    <tr id="r_ekspor_ke_negara_mana">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_ekspor_ke_negara_mana"><?= $Page->ekspor_ke_negara_mana->caption() ?></span></td>
        <td data-name="ekspor_ke_negara_mana" <?= $Page->ekspor_ke_negara_mana->cellAttributes() ?>>
<span id="el_data_master_ekspor_ke_negara_mana">
<span<?= $Page->ekspor_ke_negara_mana->viewAttributes() ?>>
<?= $Page->ekspor_ke_negara_mana->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->mengikuti_pelatihan_sebelumnya->Visible) { // mengikuti_pelatihan_sebelumnya ?>
    <tr id="r_mengikuti_pelatihan_sebelumnya">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_mengikuti_pelatihan_sebelumnya"><?= $Page->mengikuti_pelatihan_sebelumnya->caption() ?></span></td>
        <td data-name="mengikuti_pelatihan_sebelumnya" <?= $Page->mengikuti_pelatihan_sebelumnya->cellAttributes() ?>>
<span id="el_data_master_mengikuti_pelatihan_sebelumnya">
<span<?= $Page->mengikuti_pelatihan_sebelumnya->viewAttributes() ?>>
<?= $Page->mengikuti_pelatihan_sebelumnya->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pelatihan_apa_dimana->Visible) { // pelatihan_apa_dimana ?>
    <tr id="r_pelatihan_apa_dimana">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_pelatihan_apa_dimana"><?= $Page->pelatihan_apa_dimana->caption() ?></span></td>
        <td data-name="pelatihan_apa_dimana" <?= $Page->pelatihan_apa_dimana->cellAttributes() ?>>
<span id="el_data_master_pelatihan_apa_dimana">
<span<?= $Page->pelatihan_apa_dimana->viewAttributes() ?>>
<?= $Page->pelatihan_apa_dimana->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->mendapatkan_informasi->Visible) { // mendapatkan_informasi ?>
    <tr id="r_mendapatkan_informasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_mendapatkan_informasi"><?= $Page->mendapatkan_informasi->caption() ?></span></td>
        <td data-name="mendapatkan_informasi" <?= $Page->mendapatkan_informasi->cellAttributes() ?>>
<span id="el_data_master_mendapatkan_informasi">
<span<?= $Page->mendapatkan_informasi->viewAttributes() ?>>
<?= $Page->mendapatkan_informasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->harapkan_dari_pelatihan->Visible) { // harapkan_dari_pelatihan ?>
    <tr id="r_harapkan_dari_pelatihan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_harapkan_dari_pelatihan"><?= $Page->harapkan_dari_pelatihan->caption() ?></span></td>
        <td data-name="harapkan_dari_pelatihan" <?= $Page->harapkan_dari_pelatihan->cellAttributes() ?>>
<span id="el_data_master_harapkan_dari_pelatihan">
<span<?= $Page->harapkan_dari_pelatihan->viewAttributes() ?>>
<?= $Page->harapkan_dari_pelatihan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->data_diisi_benar->Visible) { // data_diisi_benar ?>
    <tr id="r_data_diisi_benar">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_master_data_diisi_benar"><?= $Page->data_diisi_benar->caption() ?></span></td>
        <td data-name="data_diisi_benar" <?= $Page->data_diisi_benar->cellAttributes() ?>>
<span id="el_data_master_data_diisi_benar">
<span<?= $Page->data_diisi_benar->viewAttributes() ?>>
<?= $Page->data_diisi_benar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
