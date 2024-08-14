<?php

namespace PHPMaker2021\import_ppei;

// Page object
$DataMasterList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fdata_masterlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fdata_masterlist = currentForm = new ew.Form("fdata_masterlist", "list");
    fdata_masterlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fdata_masterlist");
});
var fdata_masterlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fdata_masterlistsrch = currentSearchForm = new ew.Form("fdata_masterlistsrch");

    // Dynamic selection lists

    // Filters
    fdata_masterlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fdata_masterlistsrch");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction) { ?>
<form name="fdata_masterlistsrch" id="fdata_masterlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fdata_masterlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="data_master">
    <div class="ew-extended-search">
<div id="xsr_<?= $Page->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
    <div class="ew-quick-search input-group">
        <input type="text" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>">
        <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
        <div class="input-group-append">
            <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
            <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?= $Language->phrase("QuickSearchAuto") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?= $Language->phrase("QuickSearchExact") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?= $Language->phrase("QuickSearchAll") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?= $Language->phrase("QuickSearchAny") ?></a>
            </div>
        </div>
    </div>
</div>
    </div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> data_master">
<?php if (!$Page->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdata_masterlist" id="fdata_masterlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="data_master">
<div id="gmp_data_master" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_data_masterlist" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->dipindahkan->Visible) { // dipindahkan ?>
        <th data-name="dipindahkan" class="<?= $Page->dipindahkan->headerCellClass() ?>"><div id="elh_data_master_dipindahkan" class="data_master_dipindahkan"><?= $Page->renderSort($Page->dipindahkan) ?></div></th>
<?php } ?>
<?php if ($Page->kdpelat->Visible) { // kdpelat ?>
        <th data-name="kdpelat" class="<?= $Page->kdpelat->headerCellClass() ?>"><div id="elh_data_master_kdpelat" class="data_master_kdpelat"><?= $Page->renderSort($Page->kdpelat) ?></div></th>
<?php } ?>
<?php if ($Page->Email_Address->Visible) { // Email_Address ?>
        <th data-name="Email_Address" class="<?= $Page->Email_Address->headerCellClass() ?>"><div id="elh_data_master_Email_Address" class="data_master_Email_Address"><?= $Page->renderSort($Page->Email_Address) ?></div></th>
<?php } ?>
<?php if ($Page->Nama_Lengkap->Visible) { // Nama_Lengkap ?>
        <th data-name="Nama_Lengkap" class="<?= $Page->Nama_Lengkap->headerCellClass() ?>"><div id="elh_data_master_Nama_Lengkap" class="data_master_Nama_Lengkap"><?= $Page->renderSort($Page->Nama_Lengkap) ?></div></th>
<?php } ?>
<?php if ($Page->Nomor_Handphone->Visible) { // Nomor_Handphone ?>
        <th data-name="Nomor_Handphone" class="<?= $Page->Nomor_Handphone->headerCellClass() ?>"><div id="elh_data_master_Nomor_Handphone" class="data_master_Nomor_Handphone"><?= $Page->renderSort($Page->Nomor_Handphone) ?></div></th>
<?php } ?>
<?php if ($Page->Jenis_Kelamin->Visible) { // Jenis_Kelamin ?>
        <th data-name="Jenis_Kelamin" class="<?= $Page->Jenis_Kelamin->headerCellClass() ?>"><div id="elh_data_master_Jenis_Kelamin" class="data_master_Jenis_Kelamin"><?= $Page->renderSort($Page->Jenis_Kelamin) ?></div></th>
<?php } ?>
<?php if ($Page->Tempat_Lahir->Visible) { // Tempat_Lahir ?>
        <th data-name="Tempat_Lahir" class="<?= $Page->Tempat_Lahir->headerCellClass() ?>"><div id="elh_data_master_Tempat_Lahir" class="data_master_Tempat_Lahir"><?= $Page->renderSort($Page->Tempat_Lahir) ?></div></th>
<?php } ?>
<?php if ($Page->Tanggal_Lahir->Visible) { // Tanggal_Lahir ?>
        <th data-name="Tanggal_Lahir" class="<?= $Page->Tanggal_Lahir->headerCellClass() ?>"><div id="elh_data_master_Tanggal_Lahir" class="data_master_Tanggal_Lahir"><?= $Page->renderSort($Page->Tanggal_Lahir) ?></div></th>
<?php } ?>
<?php if ($Page->Alamat_Tinggal->Visible) { // Alamat_Tinggal ?>
        <th data-name="Alamat_Tinggal" class="<?= $Page->Alamat_Tinggal->headerCellClass() ?>"><div id="elh_data_master_Alamat_Tinggal" class="data_master_Alamat_Tinggal"><?= $Page->renderSort($Page->Alamat_Tinggal) ?></div></th>
<?php } ?>
<?php if ($Page->Provinsi->Visible) { // Provinsi ?>
        <th data-name="Provinsi" class="<?= $Page->Provinsi->headerCellClass() ?>"><div id="elh_data_master_Provinsi" class="data_master_Provinsi"><?= $Page->renderSort($Page->Provinsi) ?></div></th>
<?php } ?>
<?php if ($Page->Kabupaten_Kota->Visible) { // Kabupaten_Kota ?>
        <th data-name="Kabupaten_Kota" class="<?= $Page->Kabupaten_Kota->headerCellClass() ?>"><div id="elh_data_master_Kabupaten_Kota" class="data_master_Kabupaten_Kota"><?= $Page->renderSort($Page->Kabupaten_Kota) ?></div></th>
<?php } ?>
<?php if ($Page->Jabatan_di_Perusahaan->Visible) { // Jabatan_di_Perusahaan ?>
        <th data-name="Jabatan_di_Perusahaan" class="<?= $Page->Jabatan_di_Perusahaan->headerCellClass() ?>"><div id="elh_data_master_Jabatan_di_Perusahaan" class="data_master_Jabatan_di_Perusahaan"><?= $Page->renderSort($Page->Jabatan_di_Perusahaan) ?></div></th>
<?php } ?>
<?php if ($Page->Pendidikan->Visible) { // Pendidikan ?>
        <th data-name="Pendidikan" class="<?= $Page->Pendidikan->headerCellClass() ?>"><div id="elh_data_master_Pendidikan" class="data_master_Pendidikan"><?= $Page->renderSort($Page->Pendidikan) ?></div></th>
<?php } ?>
<?php if ($Page->Nama_Perusahaan_Instansi->Visible) { // Nama_Perusahaan_Instansi ?>
        <th data-name="Nama_Perusahaan_Instansi" class="<?= $Page->Nama_Perusahaan_Instansi->headerCellClass() ?>"><div id="elh_data_master_Nama_Perusahaan_Instansi" class="data_master_Nama_Perusahaan_Instansi"><?= $Page->renderSort($Page->Nama_Perusahaan_Instansi) ?></div></th>
<?php } ?>
<?php if ($Page->Contact_Person_Perusahaan->Visible) { // Contact_Person_Perusahaan ?>
        <th data-name="Contact_Person_Perusahaan" class="<?= $Page->Contact_Person_Perusahaan->headerCellClass() ?>"><div id="elh_data_master_Contact_Person_Perusahaan" class="data_master_Contact_Person_Perusahaan"><?= $Page->renderSort($Page->Contact_Person_Perusahaan) ?></div></th>
<?php } ?>
<?php if ($Page->Telepon_Kantor->Visible) { // Telepon_Kantor ?>
        <th data-name="Telepon_Kantor" class="<?= $Page->Telepon_Kantor->headerCellClass() ?>"><div id="elh_data_master_Telepon_Kantor" class="data_master_Telepon_Kantor"><?= $Page->renderSort($Page->Telepon_Kantor) ?></div></th>
<?php } ?>
<?php if ($Page->_Email->Visible) { // Email ?>
        <th data-name="_Email" class="<?= $Page->_Email->headerCellClass() ?>"><div id="elh_data_master__Email" class="data_master__Email"><?= $Page->renderSort($Page->_Email) ?></div></th>
<?php } ?>
<?php if ($Page->Website->Visible) { // Website ?>
        <th data-name="Website" class="<?= $Page->Website->headerCellClass() ?>"><div id="elh_data_master_Website" class="data_master_Website"><?= $Page->renderSort($Page->Website) ?></div></th>
<?php } ?>
<?php if ($Page->Alamat_Kantor->Visible) { // Alamat_Kantor ?>
        <th data-name="Alamat_Kantor" class="<?= $Page->Alamat_Kantor->headerCellClass() ?>"><div id="elh_data_master_Alamat_Kantor" class="data_master_Alamat_Kantor"><?= $Page->renderSort($Page->Alamat_Kantor) ?></div></th>
<?php } ?>
<?php if ($Page->Provinsi2->Visible) { // Provinsi2 ?>
        <th data-name="Provinsi2" class="<?= $Page->Provinsi2->headerCellClass() ?>"><div id="elh_data_master_Provinsi2" class="data_master_Provinsi2"><?= $Page->renderSort($Page->Provinsi2) ?></div></th>
<?php } ?>
<?php if ($Page->Kabupaten_Kota2->Visible) { // Kabupaten_Kota2 ?>
        <th data-name="Kabupaten_Kota2" class="<?= $Page->Kabupaten_Kota2->headerCellClass() ?>"><div id="elh_data_master_Kabupaten_Kota2" class="data_master_Kabupaten_Kota2"><?= $Page->renderSort($Page->Kabupaten_Kota2) ?></div></th>
<?php } ?>
<?php if ($Page->ID_Sosial_Media->Visible) { // ID_Sosial_Media ?>
        <th data-name="ID_Sosial_Media" class="<?= $Page->ID_Sosial_Media->headerCellClass() ?>"><div id="elh_data_master_ID_Sosial_Media" class="data_master_ID_Sosial_Media"><?= $Page->renderSort($Page->ID_Sosial_Media) ?></div></th>
<?php } ?>
<?php if ($Page->Kategori_perusahaan->Visible) { // Kategori_perusahaan ?>
        <th data-name="Kategori_perusahaan" class="<?= $Page->Kategori_perusahaan->headerCellClass() ?>"><div id="elh_data_master_Kategori_perusahaan" class="data_master_Kategori_perusahaan"><?= $Page->renderSort($Page->Kategori_perusahaan) ?></div></th>
<?php } ?>
<?php if ($Page->Jenis_Usaha->Visible) { // Jenis_Usaha ?>
        <th data-name="Jenis_Usaha" class="<?= $Page->Jenis_Usaha->headerCellClass() ?>"><div id="elh_data_master_Jenis_Usaha" class="data_master_Jenis_Usaha"><?= $Page->renderSort($Page->Jenis_Usaha) ?></div></th>
<?php } ?>
<?php if ($Page->Skala_Perusahaan->Visible) { // Skala_Perusahaan ?>
        <th data-name="Skala_Perusahaan" class="<?= $Page->Skala_Perusahaan->headerCellClass() ?>"><div id="elh_data_master_Skala_Perusahaan" class="data_master_Skala_Perusahaan"><?= $Page->renderSort($Page->Skala_Perusahaan) ?></div></th>
<?php } ?>
<?php if ($Page->Kategori_Produk->Visible) { // Kategori_Produk ?>
        <th data-name="Kategori_Produk" class="<?= $Page->Kategori_Produk->headerCellClass() ?>"><div id="elh_data_master_Kategori_Produk" class="data_master_Kategori_Produk"><?= $Page->renderSort($Page->Kategori_Produk) ?></div></th>
<?php } ?>
<?php if ($Page->Produk_Perusahaan->Visible) { // Produk_Perusahaan ?>
        <th data-name="Produk_Perusahaan" class="<?= $Page->Produk_Perusahaan->headerCellClass() ?>"><div id="elh_data_master_Produk_Perusahaan" class="data_master_Produk_Perusahaan"><?= $Page->renderSort($Page->Produk_Perusahaan) ?></div></th>
<?php } ?>
<?php if ($Page->HS_Code_Product->Visible) { // HS_Code_Product ?>
        <th data-name="HS_Code_Product" class="<?= $Page->HS_Code_Product->headerCellClass() ?>"><div id="elh_data_master_HS_Code_Product" class="data_master_HS_Code_Product"><?= $Page->renderSort($Page->HS_Code_Product) ?></div></th>
<?php } ?>
<?php if ($Page->Omset_Perusahaan->Visible) { // Omset_Perusahaan ?>
        <th data-name="Omset_Perusahaan" class="<?= $Page->Omset_Perusahaan->headerCellClass() ?>"><div id="elh_data_master_Omset_Perusahaan" class="data_master_Omset_Perusahaan"><?= $Page->renderSort($Page->Omset_Perusahaan) ?></div></th>
<?php } ?>
<?php if ($Page->Kapasitas_Produksi->Visible) { // Kapasitas_Produksi ?>
        <th data-name="Kapasitas_Produksi" class="<?= $Page->Kapasitas_Produksi->headerCellClass() ?>"><div id="elh_data_master_Kapasitas_Produksi" class="data_master_Kapasitas_Produksi"><?= $Page->renderSort($Page->Kapasitas_Produksi) ?></div></th>
<?php } ?>
<?php if ($Page->ekspor_ke_negara_mana->Visible) { // ekspor_ke_negara_mana ?>
        <th data-name="ekspor_ke_negara_mana" class="<?= $Page->ekspor_ke_negara_mana->headerCellClass() ?>"><div id="elh_data_master_ekspor_ke_negara_mana" class="data_master_ekspor_ke_negara_mana"><?= $Page->renderSort($Page->ekspor_ke_negara_mana) ?></div></th>
<?php } ?>
<?php if ($Page->mengikuti_pelatihan_sebelumnya->Visible) { // mengikuti_pelatihan_sebelumnya ?>
        <th data-name="mengikuti_pelatihan_sebelumnya" class="<?= $Page->mengikuti_pelatihan_sebelumnya->headerCellClass() ?>"><div id="elh_data_master_mengikuti_pelatihan_sebelumnya" class="data_master_mengikuti_pelatihan_sebelumnya"><?= $Page->renderSort($Page->mengikuti_pelatihan_sebelumnya) ?></div></th>
<?php } ?>
<?php if ($Page->pelatihan_apa_dimana->Visible) { // pelatihan_apa_dimana ?>
        <th data-name="pelatihan_apa_dimana" class="<?= $Page->pelatihan_apa_dimana->headerCellClass() ?>"><div id="elh_data_master_pelatihan_apa_dimana" class="data_master_pelatihan_apa_dimana"><?= $Page->renderSort($Page->pelatihan_apa_dimana) ?></div></th>
<?php } ?>
<?php if ($Page->mendapatkan_informasi->Visible) { // mendapatkan_informasi ?>
        <th data-name="mendapatkan_informasi" class="<?= $Page->mendapatkan_informasi->headerCellClass() ?>"><div id="elh_data_master_mendapatkan_informasi" class="data_master_mendapatkan_informasi"><?= $Page->renderSort($Page->mendapatkan_informasi) ?></div></th>
<?php } ?>
<?php if ($Page->harapkan_dari_pelatihan->Visible) { // harapkan_dari_pelatihan ?>
        <th data-name="harapkan_dari_pelatihan" class="<?= $Page->harapkan_dari_pelatihan->headerCellClass() ?>"><div id="elh_data_master_harapkan_dari_pelatihan" class="data_master_harapkan_dari_pelatihan"><?= $Page->renderSort($Page->harapkan_dari_pelatihan) ?></div></th>
<?php } ?>
<?php if ($Page->data_diisi_benar->Visible) { // data_diisi_benar ?>
        <th data-name="data_diisi_benar" class="<?= $Page->data_diisi_benar->headerCellClass() ?>"><div id="elh_data_master_data_diisi_benar" class="data_master_data_diisi_benar"><?= $Page->renderSort($Page->data_diisi_benar) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif (!$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row id / data-rowindex
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_data_master", "data-rowtype" => $Page->RowType]);

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->dipindahkan->Visible) { // dipindahkan ?>
        <td data-name="dipindahkan" <?= $Page->dipindahkan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_dipindahkan">
<span<?= $Page->dipindahkan->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_dipindahkan_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->dipindahkan->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->dipindahkan->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_dipindahkan_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kdpelat->Visible) { // kdpelat ?>
        <td data-name="kdpelat" <?= $Page->kdpelat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_kdpelat">
<span<?= $Page->kdpelat->viewAttributes() ?>>
<?= $Page->kdpelat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Email_Address->Visible) { // Email_Address ?>
        <td data-name="Email_Address" <?= $Page->Email_Address->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Email_Address">
<span<?= $Page->Email_Address->viewAttributes() ?>>
<?= $Page->Email_Address->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Nama_Lengkap->Visible) { // Nama_Lengkap ?>
        <td data-name="Nama_Lengkap" <?= $Page->Nama_Lengkap->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Nama_Lengkap">
<span<?= $Page->Nama_Lengkap->viewAttributes() ?>>
<?= $Page->Nama_Lengkap->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Nomor_Handphone->Visible) { // Nomor_Handphone ?>
        <td data-name="Nomor_Handphone" <?= $Page->Nomor_Handphone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Nomor_Handphone">
<span<?= $Page->Nomor_Handphone->viewAttributes() ?>>
<?= $Page->Nomor_Handphone->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Jenis_Kelamin->Visible) { // Jenis_Kelamin ?>
        <td data-name="Jenis_Kelamin" <?= $Page->Jenis_Kelamin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Jenis_Kelamin">
<span<?= $Page->Jenis_Kelamin->viewAttributes() ?>>
<?= $Page->Jenis_Kelamin->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Tempat_Lahir->Visible) { // Tempat_Lahir ?>
        <td data-name="Tempat_Lahir" <?= $Page->Tempat_Lahir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Tempat_Lahir">
<span<?= $Page->Tempat_Lahir->viewAttributes() ?>>
<?= $Page->Tempat_Lahir->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Tanggal_Lahir->Visible) { // Tanggal_Lahir ?>
        <td data-name="Tanggal_Lahir" <?= $Page->Tanggal_Lahir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Tanggal_Lahir">
<span<?= $Page->Tanggal_Lahir->viewAttributes() ?>>
<?= $Page->Tanggal_Lahir->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Alamat_Tinggal->Visible) { // Alamat_Tinggal ?>
        <td data-name="Alamat_Tinggal" <?= $Page->Alamat_Tinggal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Alamat_Tinggal">
<span<?= $Page->Alamat_Tinggal->viewAttributes() ?>>
<?= $Page->Alamat_Tinggal->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Provinsi->Visible) { // Provinsi ?>
        <td data-name="Provinsi" <?= $Page->Provinsi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Provinsi">
<span<?= $Page->Provinsi->viewAttributes() ?>>
<?= $Page->Provinsi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Kabupaten_Kota->Visible) { // Kabupaten_Kota ?>
        <td data-name="Kabupaten_Kota" <?= $Page->Kabupaten_Kota->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Kabupaten_Kota">
<span<?= $Page->Kabupaten_Kota->viewAttributes() ?>>
<?= $Page->Kabupaten_Kota->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Jabatan_di_Perusahaan->Visible) { // Jabatan_di_Perusahaan ?>
        <td data-name="Jabatan_di_Perusahaan" <?= $Page->Jabatan_di_Perusahaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Jabatan_di_Perusahaan">
<span<?= $Page->Jabatan_di_Perusahaan->viewAttributes() ?>>
<?= $Page->Jabatan_di_Perusahaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Pendidikan->Visible) { // Pendidikan ?>
        <td data-name="Pendidikan" <?= $Page->Pendidikan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Pendidikan">
<span<?= $Page->Pendidikan->viewAttributes() ?>>
<?= $Page->Pendidikan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Nama_Perusahaan_Instansi->Visible) { // Nama_Perusahaan_Instansi ?>
        <td data-name="Nama_Perusahaan_Instansi" <?= $Page->Nama_Perusahaan_Instansi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Nama_Perusahaan_Instansi">
<span<?= $Page->Nama_Perusahaan_Instansi->viewAttributes() ?>>
<?= $Page->Nama_Perusahaan_Instansi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Contact_Person_Perusahaan->Visible) { // Contact_Person_Perusahaan ?>
        <td data-name="Contact_Person_Perusahaan" <?= $Page->Contact_Person_Perusahaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Contact_Person_Perusahaan">
<span<?= $Page->Contact_Person_Perusahaan->viewAttributes() ?>>
<?= $Page->Contact_Person_Perusahaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Telepon_Kantor->Visible) { // Telepon_Kantor ?>
        <td data-name="Telepon_Kantor" <?= $Page->Telepon_Kantor->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Telepon_Kantor">
<span<?= $Page->Telepon_Kantor->viewAttributes() ?>>
<?= $Page->Telepon_Kantor->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_Email->Visible) { // Email ?>
        <td data-name="_Email" <?= $Page->_Email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master__Email">
<span<?= $Page->_Email->viewAttributes() ?>>
<?= $Page->_Email->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Website->Visible) { // Website ?>
        <td data-name="Website" <?= $Page->Website->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Website">
<span<?= $Page->Website->viewAttributes() ?>>
<?= $Page->Website->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Alamat_Kantor->Visible) { // Alamat_Kantor ?>
        <td data-name="Alamat_Kantor" <?= $Page->Alamat_Kantor->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Alamat_Kantor">
<span<?= $Page->Alamat_Kantor->viewAttributes() ?>>
<?= $Page->Alamat_Kantor->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Provinsi2->Visible) { // Provinsi2 ?>
        <td data-name="Provinsi2" <?= $Page->Provinsi2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Provinsi2">
<span<?= $Page->Provinsi2->viewAttributes() ?>>
<?= $Page->Provinsi2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Kabupaten_Kota2->Visible) { // Kabupaten_Kota2 ?>
        <td data-name="Kabupaten_Kota2" <?= $Page->Kabupaten_Kota2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Kabupaten_Kota2">
<span<?= $Page->Kabupaten_Kota2->viewAttributes() ?>>
<?= $Page->Kabupaten_Kota2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ID_Sosial_Media->Visible) { // ID_Sosial_Media ?>
        <td data-name="ID_Sosial_Media" <?= $Page->ID_Sosial_Media->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_ID_Sosial_Media">
<span<?= $Page->ID_Sosial_Media->viewAttributes() ?>>
<?= $Page->ID_Sosial_Media->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Kategori_perusahaan->Visible) { // Kategori_perusahaan ?>
        <td data-name="Kategori_perusahaan" <?= $Page->Kategori_perusahaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Kategori_perusahaan">
<span<?= $Page->Kategori_perusahaan->viewAttributes() ?>>
<?= $Page->Kategori_perusahaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Jenis_Usaha->Visible) { // Jenis_Usaha ?>
        <td data-name="Jenis_Usaha" <?= $Page->Jenis_Usaha->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Jenis_Usaha">
<span<?= $Page->Jenis_Usaha->viewAttributes() ?>>
<?= $Page->Jenis_Usaha->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Skala_Perusahaan->Visible) { // Skala_Perusahaan ?>
        <td data-name="Skala_Perusahaan" <?= $Page->Skala_Perusahaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Skala_Perusahaan">
<span<?= $Page->Skala_Perusahaan->viewAttributes() ?>>
<?= $Page->Skala_Perusahaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Kategori_Produk->Visible) { // Kategori_Produk ?>
        <td data-name="Kategori_Produk" <?= $Page->Kategori_Produk->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Kategori_Produk">
<span<?= $Page->Kategori_Produk->viewAttributes() ?>>
<?= $Page->Kategori_Produk->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Produk_Perusahaan->Visible) { // Produk_Perusahaan ?>
        <td data-name="Produk_Perusahaan" <?= $Page->Produk_Perusahaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Produk_Perusahaan">
<span<?= $Page->Produk_Perusahaan->viewAttributes() ?>>
<?= $Page->Produk_Perusahaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->HS_Code_Product->Visible) { // HS_Code_Product ?>
        <td data-name="HS_Code_Product" <?= $Page->HS_Code_Product->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_HS_Code_Product">
<span<?= $Page->HS_Code_Product->viewAttributes() ?>>
<?= $Page->HS_Code_Product->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Omset_Perusahaan->Visible) { // Omset_Perusahaan ?>
        <td data-name="Omset_Perusahaan" <?= $Page->Omset_Perusahaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Omset_Perusahaan">
<span<?= $Page->Omset_Perusahaan->viewAttributes() ?>>
<?= $Page->Omset_Perusahaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Kapasitas_Produksi->Visible) { // Kapasitas_Produksi ?>
        <td data-name="Kapasitas_Produksi" <?= $Page->Kapasitas_Produksi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_Kapasitas_Produksi">
<span<?= $Page->Kapasitas_Produksi->viewAttributes() ?>>
<?= $Page->Kapasitas_Produksi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ekspor_ke_negara_mana->Visible) { // ekspor_ke_negara_mana ?>
        <td data-name="ekspor_ke_negara_mana" <?= $Page->ekspor_ke_negara_mana->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_ekspor_ke_negara_mana">
<span<?= $Page->ekspor_ke_negara_mana->viewAttributes() ?>>
<?= $Page->ekspor_ke_negara_mana->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->mengikuti_pelatihan_sebelumnya->Visible) { // mengikuti_pelatihan_sebelumnya ?>
        <td data-name="mengikuti_pelatihan_sebelumnya" <?= $Page->mengikuti_pelatihan_sebelumnya->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_mengikuti_pelatihan_sebelumnya">
<span<?= $Page->mengikuti_pelatihan_sebelumnya->viewAttributes() ?>>
<?= $Page->mengikuti_pelatihan_sebelumnya->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pelatihan_apa_dimana->Visible) { // pelatihan_apa_dimana ?>
        <td data-name="pelatihan_apa_dimana" <?= $Page->pelatihan_apa_dimana->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_pelatihan_apa_dimana">
<span<?= $Page->pelatihan_apa_dimana->viewAttributes() ?>>
<?= $Page->pelatihan_apa_dimana->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->mendapatkan_informasi->Visible) { // mendapatkan_informasi ?>
        <td data-name="mendapatkan_informasi" <?= $Page->mendapatkan_informasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_mendapatkan_informasi">
<span<?= $Page->mendapatkan_informasi->viewAttributes() ?>>
<?= $Page->mendapatkan_informasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->harapkan_dari_pelatihan->Visible) { // harapkan_dari_pelatihan ?>
        <td data-name="harapkan_dari_pelatihan" <?= $Page->harapkan_dari_pelatihan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_harapkan_dari_pelatihan">
<span<?= $Page->harapkan_dari_pelatihan->viewAttributes() ?>>
<?= $Page->harapkan_dari_pelatihan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->data_diisi_benar->Visible) { // data_diisi_benar ?>
        <td data-name="data_diisi_benar" <?= $Page->data_diisi_benar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_data_master_data_diisi_benar">
<span<?= $Page->data_diisi_benar->viewAttributes() ?>>
<?= $Page->data_diisi_benar->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Page->TotalRecords == 0 && !$Page->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("data_master");
});
</script>
<script>
loadjs.ready("load", function () {
    // Startup script
    $(".ew-add").hide(),$(".fa-upload").after(" Import data");
});
</script>
<?php } ?>
