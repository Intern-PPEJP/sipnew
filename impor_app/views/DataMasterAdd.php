<?php

namespace PHPMaker2021\import_ppei;

// Page object
$DataMasterAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fdata_masteradd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fdata_masteradd = currentForm = new ew.Form("fdata_masteradd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "data_master")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.data_master)
        ew.vars.tables.data_master = currentTable;
    fdata_masteradd.addFields([
        ["dipindahkan", [fields.dipindahkan.visible && fields.dipindahkan.required ? ew.Validators.required(fields.dipindahkan.caption) : null], fields.dipindahkan.isInvalid],
        ["kdpelat", [fields.kdpelat.visible && fields.kdpelat.required ? ew.Validators.required(fields.kdpelat.caption) : null], fields.kdpelat.isInvalid],
        ["Email_Address", [fields.Email_Address.visible && fields.Email_Address.required ? ew.Validators.required(fields.Email_Address.caption) : null], fields.Email_Address.isInvalid],
        ["Nama_Lengkap", [fields.Nama_Lengkap.visible && fields.Nama_Lengkap.required ? ew.Validators.required(fields.Nama_Lengkap.caption) : null], fields.Nama_Lengkap.isInvalid],
        ["Nomor_Handphone", [fields.Nomor_Handphone.visible && fields.Nomor_Handphone.required ? ew.Validators.required(fields.Nomor_Handphone.caption) : null], fields.Nomor_Handphone.isInvalid],
        ["Jenis_Kelamin", [fields.Jenis_Kelamin.visible && fields.Jenis_Kelamin.required ? ew.Validators.required(fields.Jenis_Kelamin.caption) : null], fields.Jenis_Kelamin.isInvalid],
        ["Tempat_Lahir", [fields.Tempat_Lahir.visible && fields.Tempat_Lahir.required ? ew.Validators.required(fields.Tempat_Lahir.caption) : null], fields.Tempat_Lahir.isInvalid],
        ["Tanggal_Lahir", [fields.Tanggal_Lahir.visible && fields.Tanggal_Lahir.required ? ew.Validators.required(fields.Tanggal_Lahir.caption) : null], fields.Tanggal_Lahir.isInvalid],
        ["Alamat_Tinggal", [fields.Alamat_Tinggal.visible && fields.Alamat_Tinggal.required ? ew.Validators.required(fields.Alamat_Tinggal.caption) : null], fields.Alamat_Tinggal.isInvalid],
        ["Provinsi", [fields.Provinsi.visible && fields.Provinsi.required ? ew.Validators.required(fields.Provinsi.caption) : null], fields.Provinsi.isInvalid],
        ["Kabupaten_Kota", [fields.Kabupaten_Kota.visible && fields.Kabupaten_Kota.required ? ew.Validators.required(fields.Kabupaten_Kota.caption) : null], fields.Kabupaten_Kota.isInvalid],
        ["Jabatan_di_Perusahaan", [fields.Jabatan_di_Perusahaan.visible && fields.Jabatan_di_Perusahaan.required ? ew.Validators.required(fields.Jabatan_di_Perusahaan.caption) : null], fields.Jabatan_di_Perusahaan.isInvalid],
        ["Pendidikan", [fields.Pendidikan.visible && fields.Pendidikan.required ? ew.Validators.required(fields.Pendidikan.caption) : null], fields.Pendidikan.isInvalid],
        ["Nama_Perusahaan_Instansi", [fields.Nama_Perusahaan_Instansi.visible && fields.Nama_Perusahaan_Instansi.required ? ew.Validators.required(fields.Nama_Perusahaan_Instansi.caption) : null], fields.Nama_Perusahaan_Instansi.isInvalid],
        ["Contact_Person_Perusahaan", [fields.Contact_Person_Perusahaan.visible && fields.Contact_Person_Perusahaan.required ? ew.Validators.required(fields.Contact_Person_Perusahaan.caption) : null], fields.Contact_Person_Perusahaan.isInvalid],
        ["Telepon_Kantor", [fields.Telepon_Kantor.visible && fields.Telepon_Kantor.required ? ew.Validators.required(fields.Telepon_Kantor.caption) : null], fields.Telepon_Kantor.isInvalid],
        ["_Email", [fields._Email.visible && fields._Email.required ? ew.Validators.required(fields._Email.caption) : null], fields._Email.isInvalid],
        ["Website", [fields.Website.visible && fields.Website.required ? ew.Validators.required(fields.Website.caption) : null], fields.Website.isInvalid],
        ["Alamat_Kantor", [fields.Alamat_Kantor.visible && fields.Alamat_Kantor.required ? ew.Validators.required(fields.Alamat_Kantor.caption) : null], fields.Alamat_Kantor.isInvalid],
        ["Provinsi2", [fields.Provinsi2.visible && fields.Provinsi2.required ? ew.Validators.required(fields.Provinsi2.caption) : null], fields.Provinsi2.isInvalid],
        ["Kabupaten_Kota2", [fields.Kabupaten_Kota2.visible && fields.Kabupaten_Kota2.required ? ew.Validators.required(fields.Kabupaten_Kota2.caption) : null], fields.Kabupaten_Kota2.isInvalid],
        ["ID_Sosial_Media", [fields.ID_Sosial_Media.visible && fields.ID_Sosial_Media.required ? ew.Validators.required(fields.ID_Sosial_Media.caption) : null], fields.ID_Sosial_Media.isInvalid],
        ["Kategori_perusahaan", [fields.Kategori_perusahaan.visible && fields.Kategori_perusahaan.required ? ew.Validators.required(fields.Kategori_perusahaan.caption) : null], fields.Kategori_perusahaan.isInvalid],
        ["Jenis_Usaha", [fields.Jenis_Usaha.visible && fields.Jenis_Usaha.required ? ew.Validators.required(fields.Jenis_Usaha.caption) : null], fields.Jenis_Usaha.isInvalid],
        ["Skala_Perusahaan", [fields.Skala_Perusahaan.visible && fields.Skala_Perusahaan.required ? ew.Validators.required(fields.Skala_Perusahaan.caption) : null], fields.Skala_Perusahaan.isInvalid],
        ["Kategori_Produk", [fields.Kategori_Produk.visible && fields.Kategori_Produk.required ? ew.Validators.required(fields.Kategori_Produk.caption) : null], fields.Kategori_Produk.isInvalid],
        ["Produk_Perusahaan", [fields.Produk_Perusahaan.visible && fields.Produk_Perusahaan.required ? ew.Validators.required(fields.Produk_Perusahaan.caption) : null], fields.Produk_Perusahaan.isInvalid],
        ["HS_Code_Product", [fields.HS_Code_Product.visible && fields.HS_Code_Product.required ? ew.Validators.required(fields.HS_Code_Product.caption) : null], fields.HS_Code_Product.isInvalid],
        ["Omset_Perusahaan", [fields.Omset_Perusahaan.visible && fields.Omset_Perusahaan.required ? ew.Validators.required(fields.Omset_Perusahaan.caption) : null], fields.Omset_Perusahaan.isInvalid],
        ["Kapasitas_Produksi", [fields.Kapasitas_Produksi.visible && fields.Kapasitas_Produksi.required ? ew.Validators.required(fields.Kapasitas_Produksi.caption) : null], fields.Kapasitas_Produksi.isInvalid],
        ["Pengalaman_Ekspor", [fields.Pengalaman_Ekspor.visible && fields.Pengalaman_Ekspor.required ? ew.Validators.required(fields.Pengalaman_Ekspor.caption) : null], fields.Pengalaman_Ekspor.isInvalid],
        ["ekspor_ke_negara_mana", [fields.ekspor_ke_negara_mana.visible && fields.ekspor_ke_negara_mana.required ? ew.Validators.required(fields.ekspor_ke_negara_mana.caption) : null], fields.ekspor_ke_negara_mana.isInvalid],
        ["mengikuti_pelatihan_sebelumnya", [fields.mengikuti_pelatihan_sebelumnya.visible && fields.mengikuti_pelatihan_sebelumnya.required ? ew.Validators.required(fields.mengikuti_pelatihan_sebelumnya.caption) : null], fields.mengikuti_pelatihan_sebelumnya.isInvalid],
        ["pelatihan_apa_dimana", [fields.pelatihan_apa_dimana.visible && fields.pelatihan_apa_dimana.required ? ew.Validators.required(fields.pelatihan_apa_dimana.caption) : null], fields.pelatihan_apa_dimana.isInvalid],
        ["mendapatkan_informasi", [fields.mendapatkan_informasi.visible && fields.mendapatkan_informasi.required ? ew.Validators.required(fields.mendapatkan_informasi.caption) : null], fields.mendapatkan_informasi.isInvalid],
        ["harapkan_dari_pelatihan", [fields.harapkan_dari_pelatihan.visible && fields.harapkan_dari_pelatihan.required ? ew.Validators.required(fields.harapkan_dari_pelatihan.caption) : null], fields.harapkan_dari_pelatihan.isInvalid],
        ["data_diisi_benar", [fields.data_diisi_benar.visible && fields.data_diisi_benar.required ? ew.Validators.required(fields.data_diisi_benar.caption) : null], fields.data_diisi_benar.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fdata_masteradd,
            fobj = f.getForm(),
            $fobj = $(fobj),
            $k = $fobj.find("#" + f.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            f.setInvalid(rowIndex);
        }
    });

    // Validate form
    fdata_masteradd.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj);
        if ($fobj.find("#confirm").val() == "confirm")
            return true;
        var addcnt = 0,
            $k = $fobj.find("#" + this.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1, // Check rowcnt == 0 => Inline-Add
            gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            $fobj.data("rowindex", rowIndex);

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
        }

        // Process detail forms
        var dfs = $fobj.find("input[name='detailpage']").get();
        for (var i = 0; i < dfs.length; i++) {
            var df = dfs[i],
                val = df.value,
                frm = ew.forms.get(val);
            if (val && frm && !frm.validate())
                return false;
        }
        return true;
    }

    // Form_CustomValidate
    fdata_masteradd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdata_masteradd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fdata_masteradd.lists.dipindahkan = <?= $Page->dipindahkan->toClientList($Page) ?>;
    loadjs.done("fdata_masteradd");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fdata_masteradd" id="fdata_masteradd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="data_master">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->dipindahkan->Visible) { // dipindahkan ?>
    <div id="r_dipindahkan" class="form-group row">
        <label id="elh_data_master_dipindahkan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dipindahkan->caption() ?><?= $Page->dipindahkan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->dipindahkan->cellAttributes() ?>>
<span id="el_data_master_dipindahkan">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Page->dipindahkan->isInvalidClass() ?>" data-table="data_master" data-field="x_dipindahkan" name="x_dipindahkan[]" id="x_dipindahkan_924277" value="1"<?= ConvertToBool($Page->dipindahkan->CurrentValue) ? " checked" : "" ?><?= $Page->dipindahkan->editAttributes() ?> aria-describedby="x_dipindahkan_help">
    <label class="custom-control-label" for="x_dipindahkan_924277"></label>
</div>
<?= $Page->dipindahkan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dipindahkan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kdpelat->Visible) { // kdpelat ?>
    <div id="r_kdpelat" class="form-group row">
        <label id="elh_data_master_kdpelat" for="x_kdpelat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kdpelat->caption() ?><?= $Page->kdpelat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kdpelat->cellAttributes() ?>>
<span id="el_data_master_kdpelat">
<input type="<?= $Page->kdpelat->getInputTextType() ?>" data-table="data_master" data-field="x_kdpelat" name="x_kdpelat" id="x_kdpelat" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->kdpelat->getPlaceHolder()) ?>" value="<?= $Page->kdpelat->EditValue ?>"<?= $Page->kdpelat->editAttributes() ?> aria-describedby="x_kdpelat_help">
<?= $Page->kdpelat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kdpelat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Email_Address->Visible) { // Email_Address ?>
    <div id="r_Email_Address" class="form-group row">
        <label id="elh_data_master_Email_Address" for="x_Email_Address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Email_Address->caption() ?><?= $Page->Email_Address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Email_Address->cellAttributes() ?>>
<span id="el_data_master_Email_Address">
<textarea data-table="data_master" data-field="x_Email_Address" name="x_Email_Address" id="x_Email_Address" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Email_Address->getPlaceHolder()) ?>"<?= $Page->Email_Address->editAttributes() ?> aria-describedby="x_Email_Address_help"><?= $Page->Email_Address->EditValue ?></textarea>
<?= $Page->Email_Address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Email_Address->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Nama_Lengkap->Visible) { // Nama_Lengkap ?>
    <div id="r_Nama_Lengkap" class="form-group row">
        <label id="elh_data_master_Nama_Lengkap" for="x_Nama_Lengkap" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Nama_Lengkap->caption() ?><?= $Page->Nama_Lengkap->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Nama_Lengkap->cellAttributes() ?>>
<span id="el_data_master_Nama_Lengkap">
<textarea data-table="data_master" data-field="x_Nama_Lengkap" name="x_Nama_Lengkap" id="x_Nama_Lengkap" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Nama_Lengkap->getPlaceHolder()) ?>"<?= $Page->Nama_Lengkap->editAttributes() ?> aria-describedby="x_Nama_Lengkap_help"><?= $Page->Nama_Lengkap->EditValue ?></textarea>
<?= $Page->Nama_Lengkap->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Nama_Lengkap->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Nomor_Handphone->Visible) { // Nomor_Handphone ?>
    <div id="r_Nomor_Handphone" class="form-group row">
        <label id="elh_data_master_Nomor_Handphone" for="x_Nomor_Handphone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Nomor_Handphone->caption() ?><?= $Page->Nomor_Handphone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Nomor_Handphone->cellAttributes() ?>>
<span id="el_data_master_Nomor_Handphone">
<textarea data-table="data_master" data-field="x_Nomor_Handphone" name="x_Nomor_Handphone" id="x_Nomor_Handphone" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Nomor_Handphone->getPlaceHolder()) ?>"<?= $Page->Nomor_Handphone->editAttributes() ?> aria-describedby="x_Nomor_Handphone_help"><?= $Page->Nomor_Handphone->EditValue ?></textarea>
<?= $Page->Nomor_Handphone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Nomor_Handphone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Jenis_Kelamin->Visible) { // Jenis_Kelamin ?>
    <div id="r_Jenis_Kelamin" class="form-group row">
        <label id="elh_data_master_Jenis_Kelamin" for="x_Jenis_Kelamin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Jenis_Kelamin->caption() ?><?= $Page->Jenis_Kelamin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Jenis_Kelamin->cellAttributes() ?>>
<span id="el_data_master_Jenis_Kelamin">
<textarea data-table="data_master" data-field="x_Jenis_Kelamin" name="x_Jenis_Kelamin" id="x_Jenis_Kelamin" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Jenis_Kelamin->getPlaceHolder()) ?>"<?= $Page->Jenis_Kelamin->editAttributes() ?> aria-describedby="x_Jenis_Kelamin_help"><?= $Page->Jenis_Kelamin->EditValue ?></textarea>
<?= $Page->Jenis_Kelamin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Jenis_Kelamin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Tempat_Lahir->Visible) { // Tempat_Lahir ?>
    <div id="r_Tempat_Lahir" class="form-group row">
        <label id="elh_data_master_Tempat_Lahir" for="x_Tempat_Lahir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Tempat_Lahir->caption() ?><?= $Page->Tempat_Lahir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Tempat_Lahir->cellAttributes() ?>>
<span id="el_data_master_Tempat_Lahir">
<textarea data-table="data_master" data-field="x_Tempat_Lahir" name="x_Tempat_Lahir" id="x_Tempat_Lahir" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Tempat_Lahir->getPlaceHolder()) ?>"<?= $Page->Tempat_Lahir->editAttributes() ?> aria-describedby="x_Tempat_Lahir_help"><?= $Page->Tempat_Lahir->EditValue ?></textarea>
<?= $Page->Tempat_Lahir->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Tempat_Lahir->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Tanggal_Lahir->Visible) { // Tanggal_Lahir ?>
    <div id="r_Tanggal_Lahir" class="form-group row">
        <label id="elh_data_master_Tanggal_Lahir" for="x_Tanggal_Lahir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Tanggal_Lahir->caption() ?><?= $Page->Tanggal_Lahir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Tanggal_Lahir->cellAttributes() ?>>
<span id="el_data_master_Tanggal_Lahir">
<textarea data-table="data_master" data-field="x_Tanggal_Lahir" name="x_Tanggal_Lahir" id="x_Tanggal_Lahir" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Tanggal_Lahir->getPlaceHolder()) ?>"<?= $Page->Tanggal_Lahir->editAttributes() ?> aria-describedby="x_Tanggal_Lahir_help"><?= $Page->Tanggal_Lahir->EditValue ?></textarea>
<?= $Page->Tanggal_Lahir->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Tanggal_Lahir->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Alamat_Tinggal->Visible) { // Alamat_Tinggal ?>
    <div id="r_Alamat_Tinggal" class="form-group row">
        <label id="elh_data_master_Alamat_Tinggal" for="x_Alamat_Tinggal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Alamat_Tinggal->caption() ?><?= $Page->Alamat_Tinggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Alamat_Tinggal->cellAttributes() ?>>
<span id="el_data_master_Alamat_Tinggal">
<textarea data-table="data_master" data-field="x_Alamat_Tinggal" name="x_Alamat_Tinggal" id="x_Alamat_Tinggal" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Alamat_Tinggal->getPlaceHolder()) ?>"<?= $Page->Alamat_Tinggal->editAttributes() ?> aria-describedby="x_Alamat_Tinggal_help"><?= $Page->Alamat_Tinggal->EditValue ?></textarea>
<?= $Page->Alamat_Tinggal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Alamat_Tinggal->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Provinsi->Visible) { // Provinsi ?>
    <div id="r_Provinsi" class="form-group row">
        <label id="elh_data_master_Provinsi" for="x_Provinsi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Provinsi->caption() ?><?= $Page->Provinsi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Provinsi->cellAttributes() ?>>
<span id="el_data_master_Provinsi">
<input type="<?= $Page->Provinsi->getInputTextType() ?>" data-table="data_master" data-field="x_Provinsi" name="x_Provinsi" id="x_Provinsi" placeholder="<?= HtmlEncode($Page->Provinsi->getPlaceHolder()) ?>" value="<?= $Page->Provinsi->EditValue ?>"<?= $Page->Provinsi->editAttributes() ?> aria-describedby="x_Provinsi_help">
<?= $Page->Provinsi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Provinsi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Kabupaten_Kota->Visible) { // Kabupaten_Kota ?>
    <div id="r_Kabupaten_Kota" class="form-group row">
        <label id="elh_data_master_Kabupaten_Kota" for="x_Kabupaten_Kota" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Kabupaten_Kota->caption() ?><?= $Page->Kabupaten_Kota->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Kabupaten_Kota->cellAttributes() ?>>
<span id="el_data_master_Kabupaten_Kota">
<input type="<?= $Page->Kabupaten_Kota->getInputTextType() ?>" data-table="data_master" data-field="x_Kabupaten_Kota" name="x_Kabupaten_Kota" id="x_Kabupaten_Kota" placeholder="<?= HtmlEncode($Page->Kabupaten_Kota->getPlaceHolder()) ?>" value="<?= $Page->Kabupaten_Kota->EditValue ?>"<?= $Page->Kabupaten_Kota->editAttributes() ?> aria-describedby="x_Kabupaten_Kota_help">
<?= $Page->Kabupaten_Kota->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Kabupaten_Kota->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Jabatan_di_Perusahaan->Visible) { // Jabatan_di_Perusahaan ?>
    <div id="r_Jabatan_di_Perusahaan" class="form-group row">
        <label id="elh_data_master_Jabatan_di_Perusahaan" for="x_Jabatan_di_Perusahaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Jabatan_di_Perusahaan->caption() ?><?= $Page->Jabatan_di_Perusahaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Jabatan_di_Perusahaan->cellAttributes() ?>>
<span id="el_data_master_Jabatan_di_Perusahaan">
<textarea data-table="data_master" data-field="x_Jabatan_di_Perusahaan" name="x_Jabatan_di_Perusahaan" id="x_Jabatan_di_Perusahaan" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Jabatan_di_Perusahaan->getPlaceHolder()) ?>"<?= $Page->Jabatan_di_Perusahaan->editAttributes() ?> aria-describedby="x_Jabatan_di_Perusahaan_help"><?= $Page->Jabatan_di_Perusahaan->EditValue ?></textarea>
<?= $Page->Jabatan_di_Perusahaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Jabatan_di_Perusahaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Pendidikan->Visible) { // Pendidikan ?>
    <div id="r_Pendidikan" class="form-group row">
        <label id="elh_data_master_Pendidikan" for="x_Pendidikan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Pendidikan->caption() ?><?= $Page->Pendidikan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Pendidikan->cellAttributes() ?>>
<span id="el_data_master_Pendidikan">
<textarea data-table="data_master" data-field="x_Pendidikan" name="x_Pendidikan" id="x_Pendidikan" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Pendidikan->getPlaceHolder()) ?>"<?= $Page->Pendidikan->editAttributes() ?> aria-describedby="x_Pendidikan_help"><?= $Page->Pendidikan->EditValue ?></textarea>
<?= $Page->Pendidikan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Pendidikan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Nama_Perusahaan_Instansi->Visible) { // Nama_Perusahaan_Instansi ?>
    <div id="r_Nama_Perusahaan_Instansi" class="form-group row">
        <label id="elh_data_master_Nama_Perusahaan_Instansi" for="x_Nama_Perusahaan_Instansi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Nama_Perusahaan_Instansi->caption() ?><?= $Page->Nama_Perusahaan_Instansi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Nama_Perusahaan_Instansi->cellAttributes() ?>>
<span id="el_data_master_Nama_Perusahaan_Instansi">
<textarea data-table="data_master" data-field="x_Nama_Perusahaan_Instansi" name="x_Nama_Perusahaan_Instansi" id="x_Nama_Perusahaan_Instansi" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Nama_Perusahaan_Instansi->getPlaceHolder()) ?>"<?= $Page->Nama_Perusahaan_Instansi->editAttributes() ?> aria-describedby="x_Nama_Perusahaan_Instansi_help"><?= $Page->Nama_Perusahaan_Instansi->EditValue ?></textarea>
<?= $Page->Nama_Perusahaan_Instansi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Nama_Perusahaan_Instansi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Contact_Person_Perusahaan->Visible) { // Contact_Person_Perusahaan ?>
    <div id="r_Contact_Person_Perusahaan" class="form-group row">
        <label id="elh_data_master_Contact_Person_Perusahaan" for="x_Contact_Person_Perusahaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Contact_Person_Perusahaan->caption() ?><?= $Page->Contact_Person_Perusahaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Contact_Person_Perusahaan->cellAttributes() ?>>
<span id="el_data_master_Contact_Person_Perusahaan">
<textarea data-table="data_master" data-field="x_Contact_Person_Perusahaan" name="x_Contact_Person_Perusahaan" id="x_Contact_Person_Perusahaan" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Contact_Person_Perusahaan->getPlaceHolder()) ?>"<?= $Page->Contact_Person_Perusahaan->editAttributes() ?> aria-describedby="x_Contact_Person_Perusahaan_help"><?= $Page->Contact_Person_Perusahaan->EditValue ?></textarea>
<?= $Page->Contact_Person_Perusahaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Contact_Person_Perusahaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Telepon_Kantor->Visible) { // Telepon_Kantor ?>
    <div id="r_Telepon_Kantor" class="form-group row">
        <label id="elh_data_master_Telepon_Kantor" for="x_Telepon_Kantor" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Telepon_Kantor->caption() ?><?= $Page->Telepon_Kantor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Telepon_Kantor->cellAttributes() ?>>
<span id="el_data_master_Telepon_Kantor">
<textarea data-table="data_master" data-field="x_Telepon_Kantor" name="x_Telepon_Kantor" id="x_Telepon_Kantor" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Telepon_Kantor->getPlaceHolder()) ?>"<?= $Page->Telepon_Kantor->editAttributes() ?> aria-describedby="x_Telepon_Kantor_help"><?= $Page->Telepon_Kantor->EditValue ?></textarea>
<?= $Page->Telepon_Kantor->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Telepon_Kantor->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_Email->Visible) { // Email ?>
    <div id="r__Email" class="form-group row">
        <label id="elh_data_master__Email" for="x__Email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_Email->caption() ?><?= $Page->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_Email->cellAttributes() ?>>
<span id="el_data_master__Email">
<textarea data-table="data_master" data-field="x__Email" name="x__Email" id="x__Email" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->_Email->getPlaceHolder()) ?>"<?= $Page->_Email->editAttributes() ?> aria-describedby="x__Email_help"><?= $Page->_Email->EditValue ?></textarea>
<?= $Page->_Email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_Email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Website->Visible) { // Website ?>
    <div id="r_Website" class="form-group row">
        <label id="elh_data_master_Website" for="x_Website" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Website->caption() ?><?= $Page->Website->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Website->cellAttributes() ?>>
<span id="el_data_master_Website">
<textarea data-table="data_master" data-field="x_Website" name="x_Website" id="x_Website" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Website->getPlaceHolder()) ?>"<?= $Page->Website->editAttributes() ?> aria-describedby="x_Website_help"><?= $Page->Website->EditValue ?></textarea>
<?= $Page->Website->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Website->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Alamat_Kantor->Visible) { // Alamat_Kantor ?>
    <div id="r_Alamat_Kantor" class="form-group row">
        <label id="elh_data_master_Alamat_Kantor" for="x_Alamat_Kantor" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Alamat_Kantor->caption() ?><?= $Page->Alamat_Kantor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Alamat_Kantor->cellAttributes() ?>>
<span id="el_data_master_Alamat_Kantor">
<textarea data-table="data_master" data-field="x_Alamat_Kantor" name="x_Alamat_Kantor" id="x_Alamat_Kantor" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Alamat_Kantor->getPlaceHolder()) ?>"<?= $Page->Alamat_Kantor->editAttributes() ?> aria-describedby="x_Alamat_Kantor_help"><?= $Page->Alamat_Kantor->EditValue ?></textarea>
<?= $Page->Alamat_Kantor->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Alamat_Kantor->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Provinsi2->Visible) { // Provinsi2 ?>
    <div id="r_Provinsi2" class="form-group row">
        <label id="elh_data_master_Provinsi2" for="x_Provinsi2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Provinsi2->caption() ?><?= $Page->Provinsi2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Provinsi2->cellAttributes() ?>>
<span id="el_data_master_Provinsi2">
<textarea data-table="data_master" data-field="x_Provinsi2" name="x_Provinsi2" id="x_Provinsi2" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Provinsi2->getPlaceHolder()) ?>"<?= $Page->Provinsi2->editAttributes() ?> aria-describedby="x_Provinsi2_help"><?= $Page->Provinsi2->EditValue ?></textarea>
<?= $Page->Provinsi2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Provinsi2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Kabupaten_Kota2->Visible) { // Kabupaten_Kota2 ?>
    <div id="r_Kabupaten_Kota2" class="form-group row">
        <label id="elh_data_master_Kabupaten_Kota2" for="x_Kabupaten_Kota2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Kabupaten_Kota2->caption() ?><?= $Page->Kabupaten_Kota2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Kabupaten_Kota2->cellAttributes() ?>>
<span id="el_data_master_Kabupaten_Kota2">
<textarea data-table="data_master" data-field="x_Kabupaten_Kota2" name="x_Kabupaten_Kota2" id="x_Kabupaten_Kota2" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Kabupaten_Kota2->getPlaceHolder()) ?>"<?= $Page->Kabupaten_Kota2->editAttributes() ?> aria-describedby="x_Kabupaten_Kota2_help"><?= $Page->Kabupaten_Kota2->EditValue ?></textarea>
<?= $Page->Kabupaten_Kota2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Kabupaten_Kota2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ID_Sosial_Media->Visible) { // ID_Sosial_Media ?>
    <div id="r_ID_Sosial_Media" class="form-group row">
        <label id="elh_data_master_ID_Sosial_Media" for="x_ID_Sosial_Media" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ID_Sosial_Media->caption() ?><?= $Page->ID_Sosial_Media->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ID_Sosial_Media->cellAttributes() ?>>
<span id="el_data_master_ID_Sosial_Media">
<textarea data-table="data_master" data-field="x_ID_Sosial_Media" name="x_ID_Sosial_Media" id="x_ID_Sosial_Media" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->ID_Sosial_Media->getPlaceHolder()) ?>"<?= $Page->ID_Sosial_Media->editAttributes() ?> aria-describedby="x_ID_Sosial_Media_help"><?= $Page->ID_Sosial_Media->EditValue ?></textarea>
<?= $Page->ID_Sosial_Media->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ID_Sosial_Media->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Kategori_perusahaan->Visible) { // Kategori_perusahaan ?>
    <div id="r_Kategori_perusahaan" class="form-group row">
        <label id="elh_data_master_Kategori_perusahaan" for="x_Kategori_perusahaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Kategori_perusahaan->caption() ?><?= $Page->Kategori_perusahaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Kategori_perusahaan->cellAttributes() ?>>
<span id="el_data_master_Kategori_perusahaan">
<textarea data-table="data_master" data-field="x_Kategori_perusahaan" name="x_Kategori_perusahaan" id="x_Kategori_perusahaan" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Kategori_perusahaan->getPlaceHolder()) ?>"<?= $Page->Kategori_perusahaan->editAttributes() ?> aria-describedby="x_Kategori_perusahaan_help"><?= $Page->Kategori_perusahaan->EditValue ?></textarea>
<?= $Page->Kategori_perusahaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Kategori_perusahaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Jenis_Usaha->Visible) { // Jenis_Usaha ?>
    <div id="r_Jenis_Usaha" class="form-group row">
        <label id="elh_data_master_Jenis_Usaha" for="x_Jenis_Usaha" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Jenis_Usaha->caption() ?><?= $Page->Jenis_Usaha->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Jenis_Usaha->cellAttributes() ?>>
<span id="el_data_master_Jenis_Usaha">
<textarea data-table="data_master" data-field="x_Jenis_Usaha" name="x_Jenis_Usaha" id="x_Jenis_Usaha" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Jenis_Usaha->getPlaceHolder()) ?>"<?= $Page->Jenis_Usaha->editAttributes() ?> aria-describedby="x_Jenis_Usaha_help"><?= $Page->Jenis_Usaha->EditValue ?></textarea>
<?= $Page->Jenis_Usaha->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Jenis_Usaha->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Skala_Perusahaan->Visible) { // Skala_Perusahaan ?>
    <div id="r_Skala_Perusahaan" class="form-group row">
        <label id="elh_data_master_Skala_Perusahaan" for="x_Skala_Perusahaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Skala_Perusahaan->caption() ?><?= $Page->Skala_Perusahaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Skala_Perusahaan->cellAttributes() ?>>
<span id="el_data_master_Skala_Perusahaan">
<textarea data-table="data_master" data-field="x_Skala_Perusahaan" name="x_Skala_Perusahaan" id="x_Skala_Perusahaan" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Skala_Perusahaan->getPlaceHolder()) ?>"<?= $Page->Skala_Perusahaan->editAttributes() ?> aria-describedby="x_Skala_Perusahaan_help"><?= $Page->Skala_Perusahaan->EditValue ?></textarea>
<?= $Page->Skala_Perusahaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Skala_Perusahaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Kategori_Produk->Visible) { // Kategori_Produk ?>
    <div id="r_Kategori_Produk" class="form-group row">
        <label id="elh_data_master_Kategori_Produk" for="x_Kategori_Produk" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Kategori_Produk->caption() ?><?= $Page->Kategori_Produk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Kategori_Produk->cellAttributes() ?>>
<span id="el_data_master_Kategori_Produk">
<textarea data-table="data_master" data-field="x_Kategori_Produk" name="x_Kategori_Produk" id="x_Kategori_Produk" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Kategori_Produk->getPlaceHolder()) ?>"<?= $Page->Kategori_Produk->editAttributes() ?> aria-describedby="x_Kategori_Produk_help"><?= $Page->Kategori_Produk->EditValue ?></textarea>
<?= $Page->Kategori_Produk->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Kategori_Produk->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Produk_Perusahaan->Visible) { // Produk_Perusahaan ?>
    <div id="r_Produk_Perusahaan" class="form-group row">
        <label id="elh_data_master_Produk_Perusahaan" for="x_Produk_Perusahaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Produk_Perusahaan->caption() ?><?= $Page->Produk_Perusahaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Produk_Perusahaan->cellAttributes() ?>>
<span id="el_data_master_Produk_Perusahaan">
<textarea data-table="data_master" data-field="x_Produk_Perusahaan" name="x_Produk_Perusahaan" id="x_Produk_Perusahaan" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Produk_Perusahaan->getPlaceHolder()) ?>"<?= $Page->Produk_Perusahaan->editAttributes() ?> aria-describedby="x_Produk_Perusahaan_help"><?= $Page->Produk_Perusahaan->EditValue ?></textarea>
<?= $Page->Produk_Perusahaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Produk_Perusahaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->HS_Code_Product->Visible) { // HS_Code_Product ?>
    <div id="r_HS_Code_Product" class="form-group row">
        <label id="elh_data_master_HS_Code_Product" for="x_HS_Code_Product" class="<?= $Page->LeftColumnClass ?>"><?= $Page->HS_Code_Product->caption() ?><?= $Page->HS_Code_Product->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->HS_Code_Product->cellAttributes() ?>>
<span id="el_data_master_HS_Code_Product">
<textarea data-table="data_master" data-field="x_HS_Code_Product" name="x_HS_Code_Product" id="x_HS_Code_Product" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->HS_Code_Product->getPlaceHolder()) ?>"<?= $Page->HS_Code_Product->editAttributes() ?> aria-describedby="x_HS_Code_Product_help"><?= $Page->HS_Code_Product->EditValue ?></textarea>
<?= $Page->HS_Code_Product->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->HS_Code_Product->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Omset_Perusahaan->Visible) { // Omset_Perusahaan ?>
    <div id="r_Omset_Perusahaan" class="form-group row">
        <label id="elh_data_master_Omset_Perusahaan" for="x_Omset_Perusahaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Omset_Perusahaan->caption() ?><?= $Page->Omset_Perusahaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Omset_Perusahaan->cellAttributes() ?>>
<span id="el_data_master_Omset_Perusahaan">
<textarea data-table="data_master" data-field="x_Omset_Perusahaan" name="x_Omset_Perusahaan" id="x_Omset_Perusahaan" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Omset_Perusahaan->getPlaceHolder()) ?>"<?= $Page->Omset_Perusahaan->editAttributes() ?> aria-describedby="x_Omset_Perusahaan_help"><?= $Page->Omset_Perusahaan->EditValue ?></textarea>
<?= $Page->Omset_Perusahaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Omset_Perusahaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Kapasitas_Produksi->Visible) { // Kapasitas_Produksi ?>
    <div id="r_Kapasitas_Produksi" class="form-group row">
        <label id="elh_data_master_Kapasitas_Produksi" for="x_Kapasitas_Produksi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Kapasitas_Produksi->caption() ?><?= $Page->Kapasitas_Produksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Kapasitas_Produksi->cellAttributes() ?>>
<span id="el_data_master_Kapasitas_Produksi">
<textarea data-table="data_master" data-field="x_Kapasitas_Produksi" name="x_Kapasitas_Produksi" id="x_Kapasitas_Produksi" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Kapasitas_Produksi->getPlaceHolder()) ?>"<?= $Page->Kapasitas_Produksi->editAttributes() ?> aria-describedby="x_Kapasitas_Produksi_help"><?= $Page->Kapasitas_Produksi->EditValue ?></textarea>
<?= $Page->Kapasitas_Produksi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Kapasitas_Produksi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Pengalaman_Ekspor->Visible) { // Pengalaman_Ekspor ?>
    <div id="r_Pengalaman_Ekspor" class="form-group row">
        <label id="elh_data_master_Pengalaman_Ekspor" for="x_Pengalaman_Ekspor" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Pengalaman_Ekspor->caption() ?><?= $Page->Pengalaman_Ekspor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Pengalaman_Ekspor->cellAttributes() ?>>
<span id="el_data_master_Pengalaman_Ekspor">
<textarea data-table="data_master" data-field="x_Pengalaman_Ekspor" name="x_Pengalaman_Ekspor" id="x_Pengalaman_Ekspor" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Pengalaman_Ekspor->getPlaceHolder()) ?>"<?= $Page->Pengalaman_Ekspor->editAttributes() ?> aria-describedby="x_Pengalaman_Ekspor_help"><?= $Page->Pengalaman_Ekspor->EditValue ?></textarea>
<?= $Page->Pengalaman_Ekspor->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Pengalaman_Ekspor->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ekspor_ke_negara_mana->Visible) { // ekspor_ke_negara_mana ?>
    <div id="r_ekspor_ke_negara_mana" class="form-group row">
        <label id="elh_data_master_ekspor_ke_negara_mana" for="x_ekspor_ke_negara_mana" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ekspor_ke_negara_mana->caption() ?><?= $Page->ekspor_ke_negara_mana->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ekspor_ke_negara_mana->cellAttributes() ?>>
<span id="el_data_master_ekspor_ke_negara_mana">
<textarea data-table="data_master" data-field="x_ekspor_ke_negara_mana" name="x_ekspor_ke_negara_mana" id="x_ekspor_ke_negara_mana" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->ekspor_ke_negara_mana->getPlaceHolder()) ?>"<?= $Page->ekspor_ke_negara_mana->editAttributes() ?> aria-describedby="x_ekspor_ke_negara_mana_help"><?= $Page->ekspor_ke_negara_mana->EditValue ?></textarea>
<?= $Page->ekspor_ke_negara_mana->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ekspor_ke_negara_mana->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->mengikuti_pelatihan_sebelumnya->Visible) { // mengikuti_pelatihan_sebelumnya ?>
    <div id="r_mengikuti_pelatihan_sebelumnya" class="form-group row">
        <label id="elh_data_master_mengikuti_pelatihan_sebelumnya" for="x_mengikuti_pelatihan_sebelumnya" class="<?= $Page->LeftColumnClass ?>"><?= $Page->mengikuti_pelatihan_sebelumnya->caption() ?><?= $Page->mengikuti_pelatihan_sebelumnya->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->mengikuti_pelatihan_sebelumnya->cellAttributes() ?>>
<span id="el_data_master_mengikuti_pelatihan_sebelumnya">
<textarea data-table="data_master" data-field="x_mengikuti_pelatihan_sebelumnya" name="x_mengikuti_pelatihan_sebelumnya" id="x_mengikuti_pelatihan_sebelumnya" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->mengikuti_pelatihan_sebelumnya->getPlaceHolder()) ?>"<?= $Page->mengikuti_pelatihan_sebelumnya->editAttributes() ?> aria-describedby="x_mengikuti_pelatihan_sebelumnya_help"><?= $Page->mengikuti_pelatihan_sebelumnya->EditValue ?></textarea>
<?= $Page->mengikuti_pelatihan_sebelumnya->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->mengikuti_pelatihan_sebelumnya->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pelatihan_apa_dimana->Visible) { // pelatihan_apa_dimana ?>
    <div id="r_pelatihan_apa_dimana" class="form-group row">
        <label id="elh_data_master_pelatihan_apa_dimana" for="x_pelatihan_apa_dimana" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pelatihan_apa_dimana->caption() ?><?= $Page->pelatihan_apa_dimana->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pelatihan_apa_dimana->cellAttributes() ?>>
<span id="el_data_master_pelatihan_apa_dimana">
<textarea data-table="data_master" data-field="x_pelatihan_apa_dimana" name="x_pelatihan_apa_dimana" id="x_pelatihan_apa_dimana" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->pelatihan_apa_dimana->getPlaceHolder()) ?>"<?= $Page->pelatihan_apa_dimana->editAttributes() ?> aria-describedby="x_pelatihan_apa_dimana_help"><?= $Page->pelatihan_apa_dimana->EditValue ?></textarea>
<?= $Page->pelatihan_apa_dimana->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pelatihan_apa_dimana->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->mendapatkan_informasi->Visible) { // mendapatkan_informasi ?>
    <div id="r_mendapatkan_informasi" class="form-group row">
        <label id="elh_data_master_mendapatkan_informasi" for="x_mendapatkan_informasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->mendapatkan_informasi->caption() ?><?= $Page->mendapatkan_informasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->mendapatkan_informasi->cellAttributes() ?>>
<span id="el_data_master_mendapatkan_informasi">
<textarea data-table="data_master" data-field="x_mendapatkan_informasi" name="x_mendapatkan_informasi" id="x_mendapatkan_informasi" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->mendapatkan_informasi->getPlaceHolder()) ?>"<?= $Page->mendapatkan_informasi->editAttributes() ?> aria-describedby="x_mendapatkan_informasi_help"><?= $Page->mendapatkan_informasi->EditValue ?></textarea>
<?= $Page->mendapatkan_informasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->mendapatkan_informasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->harapkan_dari_pelatihan->Visible) { // harapkan_dari_pelatihan ?>
    <div id="r_harapkan_dari_pelatihan" class="form-group row">
        <label id="elh_data_master_harapkan_dari_pelatihan" for="x_harapkan_dari_pelatihan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->harapkan_dari_pelatihan->caption() ?><?= $Page->harapkan_dari_pelatihan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->harapkan_dari_pelatihan->cellAttributes() ?>>
<span id="el_data_master_harapkan_dari_pelatihan">
<textarea data-table="data_master" data-field="x_harapkan_dari_pelatihan" name="x_harapkan_dari_pelatihan" id="x_harapkan_dari_pelatihan" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->harapkan_dari_pelatihan->getPlaceHolder()) ?>"<?= $Page->harapkan_dari_pelatihan->editAttributes() ?> aria-describedby="x_harapkan_dari_pelatihan_help"><?= $Page->harapkan_dari_pelatihan->EditValue ?></textarea>
<?= $Page->harapkan_dari_pelatihan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->harapkan_dari_pelatihan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->data_diisi_benar->Visible) { // data_diisi_benar ?>
    <div id="r_data_diisi_benar" class="form-group row">
        <label id="elh_data_master_data_diisi_benar" for="x_data_diisi_benar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->data_diisi_benar->caption() ?><?= $Page->data_diisi_benar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->data_diisi_benar->cellAttributes() ?>>
<span id="el_data_master_data_diisi_benar">
<textarea data-table="data_master" data-field="x_data_diisi_benar" name="x_data_diisi_benar" id="x_data_diisi_benar" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->data_diisi_benar->getPlaceHolder()) ?>"<?= $Page->data_diisi_benar->editAttributes() ?> aria-describedby="x_data_diisi_benar_help"><?= $Page->data_diisi_benar->EditValue ?></textarea>
<?= $Page->data_diisi_benar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->data_diisi_benar->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("data_master");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
