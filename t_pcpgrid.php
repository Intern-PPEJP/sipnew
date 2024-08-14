<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($t_pcp_grid))
	$t_pcp_grid = new t_pcp_grid();

// Run the page
$t_pcp_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pcp_grid->Page_Render();
?>
<?php if (!$t_pcp_grid->isExport()) { ?>
<script>
var ft_pcpgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	ft_pcpgrid = new ew.Form("ft_pcpgrid", "grid");
	ft_pcpgrid.formKeyCountName = '<?php echo $t_pcp_grid->FormKeyCountName ?>';

	// Validate form
	ft_pcpgrid.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($t_pcp_grid->nama_peserta->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_peserta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->nama_peserta->caption(), $t_pcp_grid->nama_peserta->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_grid->email_add->Required) { ?>
				elm = this.getElements("x" + infix + "_email_add");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->email_add->caption(), $t_pcp_grid->email_add->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_grid->handphone->Required) { ?>
				elm = this.getElements("x" + infix + "_handphone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->handphone->caption(), $t_pcp_grid->handphone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_grid->namap->Required) { ?>
				elm = this.getElements("x" + infix + "_namap");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->namap->caption(), $t_pcp_grid->namap->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_grid->kategori_produk->Required) { ?>
				elm = this.getElements("x" + infix + "_kategori_produk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->kategori_produk->caption(), $t_pcp_grid->kategori_produk->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_grid->kategori_produk2->Required) { ?>
				elm = this.getElements("x" + infix + "_kategori_produk2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->kategori_produk2->caption(), $t_pcp_grid->kategori_produk2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_grid->kategori_produk3->Required) { ?>
				elm = this.getElements("x" + infix + "_kategori_produk3");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->kategori_produk3->caption(), $t_pcp_grid->kategori_produk3->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_grid->produk->Required) { ?>
				elm = this.getElements("x" + infix + "_produk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->produk->caption(), $t_pcp_grid->produk->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_grid->merek_dagang->Required) { ?>
				elm = this.getElements("x" + infix + "_merek_dagang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->merek_dagang->caption(), $t_pcp_grid->merek_dagang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_grid->jenis_perusahaan->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis_perusahaan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->jenis_perusahaan->caption(), $t_pcp_grid->jenis_perusahaan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_grid->kapasitas_produksi->Required) { ?>
				elm = this.getElements("x" + infix + "_kapasitas_produksi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->kapasitas_produksi->caption(), $t_pcp_grid->kapasitas_produksi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_grid->omset->Required) { ?>
				elm = this.getElements("x" + infix + "_omset");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->omset->caption(), $t_pcp_grid->omset->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_grid->website->Required) { ?>
				elm = this.getElements("x" + infix + "_website");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->website->caption(), $t_pcp_grid->website->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_grid->jml_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_jml_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->jml_pegawai->caption(), $t_pcp_grid->jml_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_grid->jml_pegawai2->Required) { ?>
				elm = this.getElements("x" + infix + "_jml_pegawai2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->jml_pegawai2->caption(), $t_pcp_grid->jml_pegawai2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_grid->jml_pegawai_tidaktetap->Required) { ?>
				elm = this.getElements("x" + infix + "_jml_pegawai_tidaktetap");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->jml_pegawai_tidaktetap->caption(), $t_pcp_grid->jml_pegawai_tidaktetap->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_grid->legalitas->Required) { ?>
				elm = this.getElements("x" + infix + "_legalitas[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->legalitas->caption(), $t_pcp_grid->legalitas->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_grid->legalitas_lain->Required) { ?>
				elm = this.getElements("x" + infix + "_legalitas_lain");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->legalitas_lain->caption(), $t_pcp_grid->legalitas_lain->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_grid->sertifikat->Required) { ?>
				elm = this.getElements("x" + infix + "_sertifikat[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->sertifikat->caption(), $t_pcp_grid->sertifikat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_grid->sertifikat_lain->Required) { ?>
				elm = this.getElements("x" + infix + "_sertifikat_lain");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->sertifikat_lain->caption(), $t_pcp_grid->sertifikat_lain->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_grid->alat_promosi->Required) { ?>
				elm = this.getElements("x" + infix + "_alat_promosi[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->alat_promosi->caption(), $t_pcp_grid->alat_promosi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_grid->promosi_lain->Required) { ?>
				elm = this.getElements("x" + infix + "_promosi_lain");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->promosi_lain->caption(), $t_pcp_grid->promosi_lain->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_grid->tahun_ecp->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun_ecp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->tahun_ecp->caption(), $t_pcp_grid->tahun_ecp->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun_ecp");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pcp_grid->tahun_ecp->errorMessage()) ?>");
			<?php if ($t_pcp_grid->wilayah_ecp->Required) { ?>
				elm = this.getElements("x" + infix + "_wilayah_ecp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_grid->wilayah_ecp->caption(), $t_pcp_grid->wilayah_ecp->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	ft_pcpgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "nama_peserta", false)) return false;
		if (ew.valueChanged(fobj, infix, "email_add", false)) return false;
		if (ew.valueChanged(fobj, infix, "handphone", false)) return false;
		if (ew.valueChanged(fobj, infix, "namap", false)) return false;
		if (ew.valueChanged(fobj, infix, "kategori_produk", false)) return false;
		if (ew.valueChanged(fobj, infix, "kategori_produk2", false)) return false;
		if (ew.valueChanged(fobj, infix, "kategori_produk3", false)) return false;
		if (ew.valueChanged(fobj, infix, "produk", false)) return false;
		if (ew.valueChanged(fobj, infix, "merek_dagang", false)) return false;
		if (ew.valueChanged(fobj, infix, "jenis_perusahaan", false)) return false;
		if (ew.valueChanged(fobj, infix, "kapasitas_produksi", false)) return false;
		if (ew.valueChanged(fobj, infix, "omset", false)) return false;
		if (ew.valueChanged(fobj, infix, "website", false)) return false;
		if (ew.valueChanged(fobj, infix, "jml_pegawai", false)) return false;
		if (ew.valueChanged(fobj, infix, "jml_pegawai2", false)) return false;
		if (ew.valueChanged(fobj, infix, "jml_pegawai_tidaktetap", false)) return false;
		if (ew.valueChanged(fobj, infix, "legalitas[]", false)) return false;
		if (ew.valueChanged(fobj, infix, "legalitas_lain", false)) return false;
		if (ew.valueChanged(fobj, infix, "sertifikat[]", false)) return false;
		if (ew.valueChanged(fobj, infix, "sertifikat_lain", false)) return false;
		if (ew.valueChanged(fobj, infix, "alat_promosi[]", false)) return false;
		if (ew.valueChanged(fobj, infix, "promosi_lain", false)) return false;
		if (ew.valueChanged(fobj, infix, "tahun_ecp", false)) return false;
		if (ew.valueChanged(fobj, infix, "wilayah_ecp", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_pcpgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_pcpgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_pcpgrid.lists["x_namap"] = <?php echo $t_pcp_grid->namap->Lookup->toClientList($t_pcp_grid) ?>;
	ft_pcpgrid.lists["x_namap"].options = <?php echo JsonEncode($t_pcp_grid->namap->lookupOptions()) ?>;
	ft_pcpgrid.autoSuggests["x_namap"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pcpgrid.lists["x_kategori_produk"] = <?php echo $t_pcp_grid->kategori_produk->Lookup->toClientList($t_pcp_grid) ?>;
	ft_pcpgrid.lists["x_kategori_produk"].options = <?php echo JsonEncode($t_pcp_grid->kategori_produk->lookupOptions()) ?>;
	ft_pcpgrid.lists["x_kategori_produk2"] = <?php echo $t_pcp_grid->kategori_produk2->Lookup->toClientList($t_pcp_grid) ?>;
	ft_pcpgrid.lists["x_kategori_produk2"].options = <?php echo JsonEncode($t_pcp_grid->kategori_produk2->lookupOptions()) ?>;
	ft_pcpgrid.lists["x_kategori_produk3"] = <?php echo $t_pcp_grid->kategori_produk3->Lookup->toClientList($t_pcp_grid) ?>;
	ft_pcpgrid.lists["x_kategori_produk3"].options = <?php echo JsonEncode($t_pcp_grid->kategori_produk3->lookupOptions()) ?>;
	ft_pcpgrid.lists["x_jml_pegawai"] = <?php echo $t_pcp_grid->jml_pegawai->Lookup->toClientList($t_pcp_grid) ?>;
	ft_pcpgrid.lists["x_jml_pegawai"].options = <?php echo JsonEncode($t_pcp_grid->jml_pegawai->options(FALSE, TRUE)) ?>;
	ft_pcpgrid.lists["x_legalitas[]"] = <?php echo $t_pcp_grid->legalitas->Lookup->toClientList($t_pcp_grid) ?>;
	ft_pcpgrid.lists["x_legalitas[]"].options = <?php echo JsonEncode($t_pcp_grid->legalitas->options(FALSE, TRUE)) ?>;
	ft_pcpgrid.lists["x_sertifikat[]"] = <?php echo $t_pcp_grid->sertifikat->Lookup->toClientList($t_pcp_grid) ?>;
	ft_pcpgrid.lists["x_sertifikat[]"].options = <?php echo JsonEncode($t_pcp_grid->sertifikat->options(FALSE, TRUE)) ?>;
	ft_pcpgrid.lists["x_alat_promosi[]"] = <?php echo $t_pcp_grid->alat_promosi->Lookup->toClientList($t_pcp_grid) ?>;
	ft_pcpgrid.lists["x_alat_promosi[]"].options = <?php echo JsonEncode($t_pcp_grid->alat_promosi->options(FALSE, TRUE)) ?>;
	loadjs.done("ft_pcpgrid");
});
</script>
<script>
ew.ready("head", "js/ewfixedheadertable.js", "fixedheadertable");
</script>
<?php } ?>
<?php
$t_pcp_grid->renderOtherOptions();
?>
<?php if ($t_pcp_grid->TotalRecords > 0 || $t_pcp->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_pcp_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_pcp">
<?php if ($t_pcp_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $t_pcp_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ft_pcpgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_t_pcp" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_t_pcpgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_pcp->RowType = ROWTYPE_HEADER;

// Render list options
$t_pcp_grid->renderListOptions();

// Render list options (header, left)
$t_pcp_grid->ListOptions->render("header", "left");
?>
<?php if ($t_pcp_grid->nama_peserta->Visible) { // nama_peserta ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->nama_peserta) == "") { ?>
		<th data-name="nama_peserta" class="<?php echo $t_pcp_grid->nama_peserta->headerCellClass() ?>"><div id="elh_t_pcp_nama_peserta" class="t_pcp_nama_peserta"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->nama_peserta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_peserta" class="<?php echo $t_pcp_grid->nama_peserta->headerCellClass() ?>"><div><div id="elh_t_pcp_nama_peserta" class="t_pcp_nama_peserta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->nama_peserta->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->nama_peserta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->nama_peserta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->email_add->Visible) { // email_add ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->email_add) == "") { ?>
		<th data-name="email_add" class="<?php echo $t_pcp_grid->email_add->headerCellClass() ?>"><div id="elh_t_pcp_email_add" class="t_pcp_email_add"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->email_add->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="email_add" class="<?php echo $t_pcp_grid->email_add->headerCellClass() ?>"><div><div id="elh_t_pcp_email_add" class="t_pcp_email_add">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->email_add->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->email_add->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->email_add->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->handphone->Visible) { // handphone ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->handphone) == "") { ?>
		<th data-name="handphone" class="<?php echo $t_pcp_grid->handphone->headerCellClass() ?>"><div id="elh_t_pcp_handphone" class="t_pcp_handphone"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->handphone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="handphone" class="<?php echo $t_pcp_grid->handphone->headerCellClass() ?>"><div><div id="elh_t_pcp_handphone" class="t_pcp_handphone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->handphone->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->handphone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->handphone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->namap->Visible) { // namap ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->namap) == "") { ?>
		<th data-name="namap" class="<?php echo $t_pcp_grid->namap->headerCellClass() ?>"><div id="elh_t_pcp_namap" class="t_pcp_namap"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->namap->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="namap" class="<?php echo $t_pcp_grid->namap->headerCellClass() ?>"><div><div id="elh_t_pcp_namap" class="t_pcp_namap">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->namap->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->namap->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->namap->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->kategori_produk->Visible) { // kategori_produk ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->kategori_produk) == "") { ?>
		<th data-name="kategori_produk" class="<?php echo $t_pcp_grid->kategori_produk->headerCellClass() ?>"><div id="elh_t_pcp_kategori_produk" class="t_pcp_kategori_produk"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->kategori_produk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kategori_produk" class="<?php echo $t_pcp_grid->kategori_produk->headerCellClass() ?>"><div><div id="elh_t_pcp_kategori_produk" class="t_pcp_kategori_produk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->kategori_produk->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->kategori_produk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->kategori_produk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->kategori_produk2->Visible) { // kategori_produk2 ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->kategori_produk2) == "") { ?>
		<th data-name="kategori_produk2" class="<?php echo $t_pcp_grid->kategori_produk2->headerCellClass() ?>"><div id="elh_t_pcp_kategori_produk2" class="t_pcp_kategori_produk2"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->kategori_produk2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kategori_produk2" class="<?php echo $t_pcp_grid->kategori_produk2->headerCellClass() ?>"><div><div id="elh_t_pcp_kategori_produk2" class="t_pcp_kategori_produk2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->kategori_produk2->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->kategori_produk2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->kategori_produk2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->kategori_produk3->Visible) { // kategori_produk3 ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->kategori_produk3) == "") { ?>
		<th data-name="kategori_produk3" class="<?php echo $t_pcp_grid->kategori_produk3->headerCellClass() ?>"><div id="elh_t_pcp_kategori_produk3" class="t_pcp_kategori_produk3"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->kategori_produk3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kategori_produk3" class="<?php echo $t_pcp_grid->kategori_produk3->headerCellClass() ?>"><div><div id="elh_t_pcp_kategori_produk3" class="t_pcp_kategori_produk3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->kategori_produk3->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->kategori_produk3->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->kategori_produk3->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->produk->Visible) { // produk ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->produk) == "") { ?>
		<th data-name="produk" class="<?php echo $t_pcp_grid->produk->headerCellClass() ?>"><div id="elh_t_pcp_produk" class="t_pcp_produk"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->produk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="produk" class="<?php echo $t_pcp_grid->produk->headerCellClass() ?>"><div><div id="elh_t_pcp_produk" class="t_pcp_produk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->produk->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->produk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->produk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->merek_dagang->Visible) { // merek_dagang ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->merek_dagang) == "") { ?>
		<th data-name="merek_dagang" class="<?php echo $t_pcp_grid->merek_dagang->headerCellClass() ?>"><div id="elh_t_pcp_merek_dagang" class="t_pcp_merek_dagang"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->merek_dagang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="merek_dagang" class="<?php echo $t_pcp_grid->merek_dagang->headerCellClass() ?>"><div><div id="elh_t_pcp_merek_dagang" class="t_pcp_merek_dagang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->merek_dagang->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->merek_dagang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->merek_dagang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->jenis_perusahaan->Visible) { // jenis_perusahaan ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->jenis_perusahaan) == "") { ?>
		<th data-name="jenis_perusahaan" class="<?php echo $t_pcp_grid->jenis_perusahaan->headerCellClass() ?>"><div id="elh_t_pcp_jenis_perusahaan" class="t_pcp_jenis_perusahaan"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->jenis_perusahaan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis_perusahaan" class="<?php echo $t_pcp_grid->jenis_perusahaan->headerCellClass() ?>"><div><div id="elh_t_pcp_jenis_perusahaan" class="t_pcp_jenis_perusahaan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->jenis_perusahaan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->jenis_perusahaan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->jenis_perusahaan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->kapasitas_produksi->Visible) { // kapasitas_produksi ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->kapasitas_produksi) == "") { ?>
		<th data-name="kapasitas_produksi" class="<?php echo $t_pcp_grid->kapasitas_produksi->headerCellClass() ?>"><div id="elh_t_pcp_kapasitas_produksi" class="t_pcp_kapasitas_produksi"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->kapasitas_produksi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kapasitas_produksi" class="<?php echo $t_pcp_grid->kapasitas_produksi->headerCellClass() ?>"><div><div id="elh_t_pcp_kapasitas_produksi" class="t_pcp_kapasitas_produksi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->kapasitas_produksi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->kapasitas_produksi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->kapasitas_produksi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->omset->Visible) { // omset ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->omset) == "") { ?>
		<th data-name="omset" class="<?php echo $t_pcp_grid->omset->headerCellClass() ?>"><div id="elh_t_pcp_omset" class="t_pcp_omset"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->omset->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="omset" class="<?php echo $t_pcp_grid->omset->headerCellClass() ?>"><div><div id="elh_t_pcp_omset" class="t_pcp_omset">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->omset->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->omset->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->omset->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->website->Visible) { // website ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->website) == "") { ?>
		<th data-name="website" class="<?php echo $t_pcp_grid->website->headerCellClass() ?>"><div id="elh_t_pcp_website" class="t_pcp_website"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->website->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="website" class="<?php echo $t_pcp_grid->website->headerCellClass() ?>"><div><div id="elh_t_pcp_website" class="t_pcp_website">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->website->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->website->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->website->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->jml_pegawai->Visible) { // jml_pegawai ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->jml_pegawai) == "") { ?>
		<th data-name="jml_pegawai" class="<?php echo $t_pcp_grid->jml_pegawai->headerCellClass() ?>"><div id="elh_t_pcp_jml_pegawai" class="t_pcp_jml_pegawai"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->jml_pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jml_pegawai" class="<?php echo $t_pcp_grid->jml_pegawai->headerCellClass() ?>"><div><div id="elh_t_pcp_jml_pegawai" class="t_pcp_jml_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->jml_pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->jml_pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->jml_pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->jml_pegawai2->Visible) { // jml_pegawai2 ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->jml_pegawai2) == "") { ?>
		<th data-name="jml_pegawai2" class="<?php echo $t_pcp_grid->jml_pegawai2->headerCellClass() ?>"><div id="elh_t_pcp_jml_pegawai2" class="t_pcp_jml_pegawai2"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->jml_pegawai2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jml_pegawai2" class="<?php echo $t_pcp_grid->jml_pegawai2->headerCellClass() ?>"><div><div id="elh_t_pcp_jml_pegawai2" class="t_pcp_jml_pegawai2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->jml_pegawai2->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->jml_pegawai2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->jml_pegawai2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->jml_pegawai_tidaktetap->Visible) { // jml_pegawai_tidaktetap ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->jml_pegawai_tidaktetap) == "") { ?>
		<th data-name="jml_pegawai_tidaktetap" class="<?php echo $t_pcp_grid->jml_pegawai_tidaktetap->headerCellClass() ?>"><div id="elh_t_pcp_jml_pegawai_tidaktetap" class="t_pcp_jml_pegawai_tidaktetap"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->jml_pegawai_tidaktetap->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jml_pegawai_tidaktetap" class="<?php echo $t_pcp_grid->jml_pegawai_tidaktetap->headerCellClass() ?>"><div><div id="elh_t_pcp_jml_pegawai_tidaktetap" class="t_pcp_jml_pegawai_tidaktetap">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->jml_pegawai_tidaktetap->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->jml_pegawai_tidaktetap->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->jml_pegawai_tidaktetap->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->legalitas->Visible) { // legalitas ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->legalitas) == "") { ?>
		<th data-name="legalitas" class="<?php echo $t_pcp_grid->legalitas->headerCellClass() ?>"><div id="elh_t_pcp_legalitas" class="t_pcp_legalitas"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->legalitas->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="legalitas" class="<?php echo $t_pcp_grid->legalitas->headerCellClass() ?>"><div><div id="elh_t_pcp_legalitas" class="t_pcp_legalitas">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->legalitas->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->legalitas->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->legalitas->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->legalitas_lain->Visible) { // legalitas_lain ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->legalitas_lain) == "") { ?>
		<th data-name="legalitas_lain" class="<?php echo $t_pcp_grid->legalitas_lain->headerCellClass() ?>"><div id="elh_t_pcp_legalitas_lain" class="t_pcp_legalitas_lain"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->legalitas_lain->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="legalitas_lain" class="<?php echo $t_pcp_grid->legalitas_lain->headerCellClass() ?>"><div><div id="elh_t_pcp_legalitas_lain" class="t_pcp_legalitas_lain">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->legalitas_lain->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->legalitas_lain->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->legalitas_lain->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->sertifikat->Visible) { // sertifikat ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->sertifikat) == "") { ?>
		<th data-name="sertifikat" class="<?php echo $t_pcp_grid->sertifikat->headerCellClass() ?>"><div id="elh_t_pcp_sertifikat" class="t_pcp_sertifikat"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->sertifikat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sertifikat" class="<?php echo $t_pcp_grid->sertifikat->headerCellClass() ?>"><div><div id="elh_t_pcp_sertifikat" class="t_pcp_sertifikat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->sertifikat->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->sertifikat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->sertifikat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->sertifikat_lain->Visible) { // sertifikat_lain ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->sertifikat_lain) == "") { ?>
		<th data-name="sertifikat_lain" class="<?php echo $t_pcp_grid->sertifikat_lain->headerCellClass() ?>"><div id="elh_t_pcp_sertifikat_lain" class="t_pcp_sertifikat_lain"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->sertifikat_lain->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sertifikat_lain" class="<?php echo $t_pcp_grid->sertifikat_lain->headerCellClass() ?>"><div><div id="elh_t_pcp_sertifikat_lain" class="t_pcp_sertifikat_lain">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->sertifikat_lain->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->sertifikat_lain->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->sertifikat_lain->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->alat_promosi->Visible) { // alat_promosi ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->alat_promosi) == "") { ?>
		<th data-name="alat_promosi" class="<?php echo $t_pcp_grid->alat_promosi->headerCellClass() ?>"><div id="elh_t_pcp_alat_promosi" class="t_pcp_alat_promosi"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->alat_promosi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="alat_promosi" class="<?php echo $t_pcp_grid->alat_promosi->headerCellClass() ?>"><div><div id="elh_t_pcp_alat_promosi" class="t_pcp_alat_promosi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->alat_promosi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->alat_promosi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->alat_promosi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->promosi_lain->Visible) { // promosi_lain ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->promosi_lain) == "") { ?>
		<th data-name="promosi_lain" class="<?php echo $t_pcp_grid->promosi_lain->headerCellClass() ?>"><div id="elh_t_pcp_promosi_lain" class="t_pcp_promosi_lain"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->promosi_lain->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="promosi_lain" class="<?php echo $t_pcp_grid->promosi_lain->headerCellClass() ?>"><div><div id="elh_t_pcp_promosi_lain" class="t_pcp_promosi_lain">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->promosi_lain->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->promosi_lain->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->promosi_lain->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->tahun_ecp->Visible) { // tahun_ecp ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->tahun_ecp) == "") { ?>
		<th data-name="tahun_ecp" class="<?php echo $t_pcp_grid->tahun_ecp->headerCellClass() ?>"><div id="elh_t_pcp_tahun_ecp" class="t_pcp_tahun_ecp"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->tahun_ecp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun_ecp" class="<?php echo $t_pcp_grid->tahun_ecp->headerCellClass() ?>"><div><div id="elh_t_pcp_tahun_ecp" class="t_pcp_tahun_ecp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->tahun_ecp->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->tahun_ecp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->tahun_ecp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_grid->wilayah_ecp->Visible) { // wilayah_ecp ?>
	<?php if ($t_pcp_grid->SortUrl($t_pcp_grid->wilayah_ecp) == "") { ?>
		<th data-name="wilayah_ecp" class="<?php echo $t_pcp_grid->wilayah_ecp->headerCellClass() ?>"><div id="elh_t_pcp_wilayah_ecp" class="t_pcp_wilayah_ecp"><div class="ew-table-header-caption"><?php echo $t_pcp_grid->wilayah_ecp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="wilayah_ecp" class="<?php echo $t_pcp_grid->wilayah_ecp->headerCellClass() ?>"><div><div id="elh_t_pcp_wilayah_ecp" class="t_pcp_wilayah_ecp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_grid->wilayah_ecp->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_grid->wilayah_ecp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_grid->wilayah_ecp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_pcp_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_pcp_grid->StartRecord = 1;
$t_pcp_grid->StopRecord = $t_pcp_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($t_pcp->isConfirm() || $t_pcp_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_pcp_grid->FormKeyCountName) && ($t_pcp_grid->isGridAdd() || $t_pcp_grid->isGridEdit() || $t_pcp->isConfirm())) {
		$t_pcp_grid->KeyCount = $CurrentForm->getValue($t_pcp_grid->FormKeyCountName);
		$t_pcp_grid->StopRecord = $t_pcp_grid->StartRecord + $t_pcp_grid->KeyCount - 1;
	}
}
$t_pcp_grid->RecordCount = $t_pcp_grid->StartRecord - 1;
if ($t_pcp_grid->Recordset && !$t_pcp_grid->Recordset->EOF) {
	$t_pcp_grid->Recordset->moveFirst();
	$selectLimit = $t_pcp_grid->UseSelectLimit;
	if (!$selectLimit && $t_pcp_grid->StartRecord > 1)
		$t_pcp_grid->Recordset->move($t_pcp_grid->StartRecord - 1);
} elseif (!$t_pcp->AllowAddDeleteRow && $t_pcp_grid->StopRecord == 0) {
	$t_pcp_grid->StopRecord = $t_pcp->GridAddRowCount;
}

// Initialize aggregate
$t_pcp->RowType = ROWTYPE_AGGREGATEINIT;
$t_pcp->resetAttributes();
$t_pcp_grid->renderRow();
if ($t_pcp_grid->isGridAdd())
	$t_pcp_grid->RowIndex = 0;
if ($t_pcp_grid->isGridEdit())
	$t_pcp_grid->RowIndex = 0;
while ($t_pcp_grid->RecordCount < $t_pcp_grid->StopRecord) {
	$t_pcp_grid->RecordCount++;
	if ($t_pcp_grid->RecordCount >= $t_pcp_grid->StartRecord) {
		$t_pcp_grid->RowCount++;
		if ($t_pcp_grid->isGridAdd() || $t_pcp_grid->isGridEdit() || $t_pcp->isConfirm()) {
			$t_pcp_grid->RowIndex++;
			$CurrentForm->Index = $t_pcp_grid->RowIndex;
			if ($CurrentForm->hasValue($t_pcp_grid->FormActionName) && ($t_pcp->isConfirm() || $t_pcp_grid->EventCancelled))
				$t_pcp_grid->RowAction = strval($CurrentForm->getValue($t_pcp_grid->FormActionName));
			elseif ($t_pcp_grid->isGridAdd())
				$t_pcp_grid->RowAction = "insert";
			else
				$t_pcp_grid->RowAction = "";
		}

		// Set up key count
		$t_pcp_grid->KeyCount = $t_pcp_grid->RowIndex;

		// Init row class and style
		$t_pcp->resetAttributes();
		$t_pcp->CssClass = "";
		if ($t_pcp_grid->isGridAdd()) {
			if ($t_pcp->CurrentMode == "copy") {
				$t_pcp_grid->loadRowValues($t_pcp_grid->Recordset); // Load row values
				$t_pcp_grid->setRecordKey($t_pcp_grid->RowOldKey, $t_pcp_grid->Recordset); // Set old record key
			} else {
				$t_pcp_grid->loadRowValues(); // Load default values
				$t_pcp_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_pcp_grid->loadRowValues($t_pcp_grid->Recordset); // Load row values
		}
		$t_pcp->RowType = ROWTYPE_VIEW; // Render view
		if ($t_pcp_grid->isGridAdd()) // Grid add
			$t_pcp->RowType = ROWTYPE_ADD; // Render add
		if ($t_pcp_grid->isGridAdd() && $t_pcp->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_pcp_grid->restoreCurrentRowFormValues($t_pcp_grid->RowIndex); // Restore form values
		if ($t_pcp_grid->isGridEdit()) { // Grid edit
			if ($t_pcp->EventCancelled)
				$t_pcp_grid->restoreCurrentRowFormValues($t_pcp_grid->RowIndex); // Restore form values
			if ($t_pcp_grid->RowAction == "insert")
				$t_pcp->RowType = ROWTYPE_ADD; // Render add
			else
				$t_pcp->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_pcp_grid->isGridEdit() && ($t_pcp->RowType == ROWTYPE_EDIT || $t_pcp->RowType == ROWTYPE_ADD) && $t_pcp->EventCancelled) // Update failed
			$t_pcp_grid->restoreCurrentRowFormValues($t_pcp_grid->RowIndex); // Restore form values
		if ($t_pcp->RowType == ROWTYPE_EDIT) // Edit row
			$t_pcp_grid->EditRowCount++;
		if ($t_pcp->isConfirm()) // Confirm row
			$t_pcp_grid->restoreCurrentRowFormValues($t_pcp_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_pcp->RowAttrs->merge(["data-rowindex" => $t_pcp_grid->RowCount, "id" => "r" . $t_pcp_grid->RowCount . "_t_pcp", "data-rowtype" => $t_pcp->RowType]);

		// Render row
		$t_pcp_grid->renderRow();

		// Render list options
		$t_pcp_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_pcp_grid->RowAction != "delete" && $t_pcp_grid->RowAction != "insertdelete" && !($t_pcp_grid->RowAction == "insert" && $t_pcp->isConfirm() && $t_pcp_grid->emptyRow())) {
?>
	<tr <?php echo $t_pcp->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_pcp_grid->ListOptions->render("body", "left", $t_pcp_grid->RowCount);
?>
	<?php if ($t_pcp_grid->nama_peserta->Visible) { // nama_peserta ?>
		<td data-name="nama_peserta" <?php echo $t_pcp_grid->nama_peserta->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_nama_peserta" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_nama_peserta" name="x<?php echo $t_pcp_grid->RowIndex ?>_nama_peserta" id="x<?php echo $t_pcp_grid->RowIndex ?>_nama_peserta" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_grid->nama_peserta->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->nama_peserta->EditValue ?>"<?php echo $t_pcp_grid->nama_peserta->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_nama_peserta" name="o<?php echo $t_pcp_grid->RowIndex ?>_nama_peserta" id="o<?php echo $t_pcp_grid->RowIndex ?>_nama_peserta" value="<?php echo HtmlEncode($t_pcp_grid->nama_peserta->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_nama_peserta" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_nama_peserta" name="x<?php echo $t_pcp_grid->RowIndex ?>_nama_peserta" id="x<?php echo $t_pcp_grid->RowIndex ?>_nama_peserta" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_grid->nama_peserta->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->nama_peserta->EditValue ?>"<?php echo $t_pcp_grid->nama_peserta->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_nama_peserta">
<span<?php echo $t_pcp_grid->nama_peserta->viewAttributes() ?>><?php echo $t_pcp_grid->nama_peserta->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_nama_peserta" name="x<?php echo $t_pcp_grid->RowIndex ?>_nama_peserta" id="x<?php echo $t_pcp_grid->RowIndex ?>_nama_peserta" value="<?php echo HtmlEncode($t_pcp_grid->nama_peserta->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_nama_peserta" name="o<?php echo $t_pcp_grid->RowIndex ?>_nama_peserta" id="o<?php echo $t_pcp_grid->RowIndex ?>_nama_peserta" value="<?php echo HtmlEncode($t_pcp_grid->nama_peserta->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_nama_peserta" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_nama_peserta" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_nama_peserta" value="<?php echo HtmlEncode($t_pcp_grid->nama_peserta->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_nama_peserta" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_nama_peserta" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_nama_peserta" value="<?php echo HtmlEncode($t_pcp_grid->nama_peserta->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t_pcp" data-field="x_id" name="x<?php echo $t_pcp_grid->RowIndex ?>_id" id="x<?php echo $t_pcp_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_pcp_grid->id->CurrentValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_id" name="o<?php echo $t_pcp_grid->RowIndex ?>_id" id="o<?php echo $t_pcp_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_pcp_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT || $t_pcp->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t_pcp" data-field="x_id" name="x<?php echo $t_pcp_grid->RowIndex ?>_id" id="x<?php echo $t_pcp_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_pcp_grid->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t_pcp_grid->email_add->Visible) { // email_add ?>
		<td data-name="email_add" <?php echo $t_pcp_grid->email_add->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_email_add" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_email_add" name="x<?php echo $t_pcp_grid->RowIndex ?>_email_add" id="x<?php echo $t_pcp_grid->RowIndex ?>_email_add" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_grid->email_add->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->email_add->EditValue ?>"<?php echo $t_pcp_grid->email_add->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_email_add" name="o<?php echo $t_pcp_grid->RowIndex ?>_email_add" id="o<?php echo $t_pcp_grid->RowIndex ?>_email_add" value="<?php echo HtmlEncode($t_pcp_grid->email_add->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_email_add" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_email_add" name="x<?php echo $t_pcp_grid->RowIndex ?>_email_add" id="x<?php echo $t_pcp_grid->RowIndex ?>_email_add" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_grid->email_add->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->email_add->EditValue ?>"<?php echo $t_pcp_grid->email_add->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_email_add">
<span<?php echo $t_pcp_grid->email_add->viewAttributes() ?>><?php echo $t_pcp_grid->email_add->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_email_add" name="x<?php echo $t_pcp_grid->RowIndex ?>_email_add" id="x<?php echo $t_pcp_grid->RowIndex ?>_email_add" value="<?php echo HtmlEncode($t_pcp_grid->email_add->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_email_add" name="o<?php echo $t_pcp_grid->RowIndex ?>_email_add" id="o<?php echo $t_pcp_grid->RowIndex ?>_email_add" value="<?php echo HtmlEncode($t_pcp_grid->email_add->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_email_add" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_email_add" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_email_add" value="<?php echo HtmlEncode($t_pcp_grid->email_add->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_email_add" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_email_add" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_email_add" value="<?php echo HtmlEncode($t_pcp_grid->email_add->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->handphone->Visible) { // handphone ?>
		<td data-name="handphone" <?php echo $t_pcp_grid->handphone->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_handphone" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_handphone" name="x<?php echo $t_pcp_grid->RowIndex ?>_handphone" id="x<?php echo $t_pcp_grid->RowIndex ?>_handphone" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_pcp_grid->handphone->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->handphone->EditValue ?>"<?php echo $t_pcp_grid->handphone->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_handphone" name="o<?php echo $t_pcp_grid->RowIndex ?>_handphone" id="o<?php echo $t_pcp_grid->RowIndex ?>_handphone" value="<?php echo HtmlEncode($t_pcp_grid->handphone->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_handphone" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_handphone" name="x<?php echo $t_pcp_grid->RowIndex ?>_handphone" id="x<?php echo $t_pcp_grid->RowIndex ?>_handphone" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_pcp_grid->handphone->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->handphone->EditValue ?>"<?php echo $t_pcp_grid->handphone->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_handphone">
<span<?php echo $t_pcp_grid->handphone->viewAttributes() ?>><?php echo $t_pcp_grid->handphone->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_handphone" name="x<?php echo $t_pcp_grid->RowIndex ?>_handphone" id="x<?php echo $t_pcp_grid->RowIndex ?>_handphone" value="<?php echo HtmlEncode($t_pcp_grid->handphone->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_handphone" name="o<?php echo $t_pcp_grid->RowIndex ?>_handphone" id="o<?php echo $t_pcp_grid->RowIndex ?>_handphone" value="<?php echo HtmlEncode($t_pcp_grid->handphone->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_handphone" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_handphone" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_handphone" value="<?php echo HtmlEncode($t_pcp_grid->handphone->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_handphone" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_handphone" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_handphone" value="<?php echo HtmlEncode($t_pcp_grid->handphone->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->namap->Visible) { // namap ?>
		<td data-name="namap" <?php echo $t_pcp_grid->namap->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_namap" class="form-group">
<?php
$onchange = $t_pcp_grid->namap->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pcp_grid->namap->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_pcp_grid->RowIndex ?>_namap">
	<input type="text" class="form-control" name="sv_x<?php echo $t_pcp_grid->RowIndex ?>_namap" id="sv_x<?php echo $t_pcp_grid->RowIndex ?>_namap" value="<?php echo RemoveHtml($t_pcp_grid->namap->EditValue) ?>" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($t_pcp_grid->namap->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pcp_grid->namap->getPlaceHolder()) ?>"<?php echo $t_pcp_grid->namap->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_namap" data-value-separator="<?php echo $t_pcp_grid->namap->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pcp_grid->RowIndex ?>_namap" id="x<?php echo $t_pcp_grid->RowIndex ?>_namap" value="<?php echo HtmlEncode($t_pcp_grid->namap->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pcpgrid"], function() {
	ft_pcpgrid.createAutoSuggest({"id":"x<?php echo $t_pcp_grid->RowIndex ?>_namap","forceSelect":false});
});
</script>
<?php echo $t_pcp_grid->namap->Lookup->getParamTag($t_pcp_grid, "p_x" . $t_pcp_grid->RowIndex . "_namap") ?>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_namap" name="o<?php echo $t_pcp_grid->RowIndex ?>_namap" id="o<?php echo $t_pcp_grid->RowIndex ?>_namap" value="<?php echo HtmlEncode($t_pcp_grid->namap->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_namap" class="form-group">
<?php
$onchange = $t_pcp_grid->namap->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pcp_grid->namap->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_pcp_grid->RowIndex ?>_namap">
	<input type="text" class="form-control" name="sv_x<?php echo $t_pcp_grid->RowIndex ?>_namap" id="sv_x<?php echo $t_pcp_grid->RowIndex ?>_namap" value="<?php echo RemoveHtml($t_pcp_grid->namap->EditValue) ?>" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($t_pcp_grid->namap->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pcp_grid->namap->getPlaceHolder()) ?>"<?php echo $t_pcp_grid->namap->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_namap" data-value-separator="<?php echo $t_pcp_grid->namap->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pcp_grid->RowIndex ?>_namap" id="x<?php echo $t_pcp_grid->RowIndex ?>_namap" value="<?php echo HtmlEncode($t_pcp_grid->namap->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pcpgrid"], function() {
	ft_pcpgrid.createAutoSuggest({"id":"x<?php echo $t_pcp_grid->RowIndex ?>_namap","forceSelect":false});
});
</script>
<?php echo $t_pcp_grid->namap->Lookup->getParamTag($t_pcp_grid, "p_x" . $t_pcp_grid->RowIndex . "_namap") ?>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_namap">
<span<?php echo $t_pcp_grid->namap->viewAttributes() ?>><?php echo $t_pcp_grid->namap->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_namap" name="x<?php echo $t_pcp_grid->RowIndex ?>_namap" id="x<?php echo $t_pcp_grid->RowIndex ?>_namap" value="<?php echo HtmlEncode($t_pcp_grid->namap->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_namap" name="o<?php echo $t_pcp_grid->RowIndex ?>_namap" id="o<?php echo $t_pcp_grid->RowIndex ?>_namap" value="<?php echo HtmlEncode($t_pcp_grid->namap->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_namap" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_namap" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_namap" value="<?php echo HtmlEncode($t_pcp_grid->namap->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_namap" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_namap" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_namap" value="<?php echo HtmlEncode($t_pcp_grid->namap->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->kategori_produk->Visible) { // kategori_produk ?>
		<td data-name="kategori_produk" <?php echo $t_pcp_grid->kategori_produk->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_kategori_produk" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pcp" data-field="x_kategori_produk" data-value-separator="<?php echo $t_pcp_grid->kategori_produk->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk" name="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk"<?php echo $t_pcp_grid->kategori_produk->editAttributes() ?>>
			<?php echo $t_pcp_grid->kategori_produk->selectOptionListHtml("x{$t_pcp_grid->RowIndex}_kategori_produk") ?>
		</select>
	<?php if (AllowAdd(CurrentProjectID() . "t_kat_produk") && !$t_pcp_grid->kategori_produk->ReadOnly) { ?>
	<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $t_pcp_grid->kategori_produk->caption() ?>" data-title="<?php echo $t_pcp_grid->kategori_produk->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk',url:'t_kat_produkaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button></div>
	<?php } ?>
</div>
<?php echo $t_pcp_grid->kategori_produk->Lookup->getParamTag($t_pcp_grid, "p_x" . $t_pcp_grid->RowIndex . "_kategori_produk") ?>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_kategori_produk" name="o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk" id="o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk" value="<?php echo HtmlEncode($t_pcp_grid->kategori_produk->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_kategori_produk" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pcp" data-field="x_kategori_produk" data-value-separator="<?php echo $t_pcp_grid->kategori_produk->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk" name="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk"<?php echo $t_pcp_grid->kategori_produk->editAttributes() ?>>
			<?php echo $t_pcp_grid->kategori_produk->selectOptionListHtml("x{$t_pcp_grid->RowIndex}_kategori_produk") ?>
		</select>
	<?php if (AllowAdd(CurrentProjectID() . "t_kat_produk") && !$t_pcp_grid->kategori_produk->ReadOnly) { ?>
	<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $t_pcp_grid->kategori_produk->caption() ?>" data-title="<?php echo $t_pcp_grid->kategori_produk->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk',url:'t_kat_produkaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button></div>
	<?php } ?>
</div>
<?php echo $t_pcp_grid->kategori_produk->Lookup->getParamTag($t_pcp_grid, "p_x" . $t_pcp_grid->RowIndex . "_kategori_produk") ?>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_kategori_produk">
<span<?php echo $t_pcp_grid->kategori_produk->viewAttributes() ?>><?php echo $t_pcp_grid->kategori_produk->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_kategori_produk" name="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk" id="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk" value="<?php echo HtmlEncode($t_pcp_grid->kategori_produk->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_kategori_produk" name="o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk" id="o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk" value="<?php echo HtmlEncode($t_pcp_grid->kategori_produk->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_kategori_produk" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk" value="<?php echo HtmlEncode($t_pcp_grid->kategori_produk->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_kategori_produk" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk" value="<?php echo HtmlEncode($t_pcp_grid->kategori_produk->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->kategori_produk2->Visible) { // kategori_produk2 ?>
		<td data-name="kategori_produk2" <?php echo $t_pcp_grid->kategori_produk2->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_kategori_produk2" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pcp" data-field="x_kategori_produk2" data-value-separator="<?php echo $t_pcp_grid->kategori_produk2->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2" name="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2"<?php echo $t_pcp_grid->kategori_produk2->editAttributes() ?>>
			<?php echo $t_pcp_grid->kategori_produk2->selectOptionListHtml("x{$t_pcp_grid->RowIndex}_kategori_produk2") ?>
		</select>
	<?php if (AllowAdd(CurrentProjectID() . "t_kat_produk") && !$t_pcp_grid->kategori_produk2->ReadOnly) { ?>
	<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $t_pcp_grid->kategori_produk2->caption() ?>" data-title="<?php echo $t_pcp_grid->kategori_produk2->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2',url:'t_kat_produkaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button></div>
	<?php } ?>
</div>
<?php echo $t_pcp_grid->kategori_produk2->Lookup->getParamTag($t_pcp_grid, "p_x" . $t_pcp_grid->RowIndex . "_kategori_produk2") ?>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_kategori_produk2" name="o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2" id="o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2" value="<?php echo HtmlEncode($t_pcp_grid->kategori_produk2->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_kategori_produk2" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pcp" data-field="x_kategori_produk2" data-value-separator="<?php echo $t_pcp_grid->kategori_produk2->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2" name="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2"<?php echo $t_pcp_grid->kategori_produk2->editAttributes() ?>>
			<?php echo $t_pcp_grid->kategori_produk2->selectOptionListHtml("x{$t_pcp_grid->RowIndex}_kategori_produk2") ?>
		</select>
	<?php if (AllowAdd(CurrentProjectID() . "t_kat_produk") && !$t_pcp_grid->kategori_produk2->ReadOnly) { ?>
	<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $t_pcp_grid->kategori_produk2->caption() ?>" data-title="<?php echo $t_pcp_grid->kategori_produk2->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2',url:'t_kat_produkaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button></div>
	<?php } ?>
</div>
<?php echo $t_pcp_grid->kategori_produk2->Lookup->getParamTag($t_pcp_grid, "p_x" . $t_pcp_grid->RowIndex . "_kategori_produk2") ?>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_kategori_produk2">
<span<?php echo $t_pcp_grid->kategori_produk2->viewAttributes() ?>><?php echo $t_pcp_grid->kategori_produk2->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_kategori_produk2" name="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2" id="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2" value="<?php echo HtmlEncode($t_pcp_grid->kategori_produk2->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_kategori_produk2" name="o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2" id="o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2" value="<?php echo HtmlEncode($t_pcp_grid->kategori_produk2->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_kategori_produk2" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2" value="<?php echo HtmlEncode($t_pcp_grid->kategori_produk2->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_kategori_produk2" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2" value="<?php echo HtmlEncode($t_pcp_grid->kategori_produk2->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->kategori_produk3->Visible) { // kategori_produk3 ?>
		<td data-name="kategori_produk3" <?php echo $t_pcp_grid->kategori_produk3->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_kategori_produk3" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pcp" data-field="x_kategori_produk3" data-value-separator="<?php echo $t_pcp_grid->kategori_produk3->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3" name="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3"<?php echo $t_pcp_grid->kategori_produk3->editAttributes() ?>>
			<?php echo $t_pcp_grid->kategori_produk3->selectOptionListHtml("x{$t_pcp_grid->RowIndex}_kategori_produk3") ?>
		</select>
	<?php if (AllowAdd(CurrentProjectID() . "t_kat_produk") && !$t_pcp_grid->kategori_produk3->ReadOnly) { ?>
	<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $t_pcp_grid->kategori_produk3->caption() ?>" data-title="<?php echo $t_pcp_grid->kategori_produk3->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3',url:'t_kat_produkaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button></div>
	<?php } ?>
</div>
<?php echo $t_pcp_grid->kategori_produk3->Lookup->getParamTag($t_pcp_grid, "p_x" . $t_pcp_grid->RowIndex . "_kategori_produk3") ?>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_kategori_produk3" name="o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3" id="o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3" value="<?php echo HtmlEncode($t_pcp_grid->kategori_produk3->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_kategori_produk3" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pcp" data-field="x_kategori_produk3" data-value-separator="<?php echo $t_pcp_grid->kategori_produk3->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3" name="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3"<?php echo $t_pcp_grid->kategori_produk3->editAttributes() ?>>
			<?php echo $t_pcp_grid->kategori_produk3->selectOptionListHtml("x{$t_pcp_grid->RowIndex}_kategori_produk3") ?>
		</select>
	<?php if (AllowAdd(CurrentProjectID() . "t_kat_produk") && !$t_pcp_grid->kategori_produk3->ReadOnly) { ?>
	<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $t_pcp_grid->kategori_produk3->caption() ?>" data-title="<?php echo $t_pcp_grid->kategori_produk3->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3',url:'t_kat_produkaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button></div>
	<?php } ?>
</div>
<?php echo $t_pcp_grid->kategori_produk3->Lookup->getParamTag($t_pcp_grid, "p_x" . $t_pcp_grid->RowIndex . "_kategori_produk3") ?>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_kategori_produk3">
<span<?php echo $t_pcp_grid->kategori_produk3->viewAttributes() ?>><?php echo $t_pcp_grid->kategori_produk3->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_kategori_produk3" name="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3" id="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3" value="<?php echo HtmlEncode($t_pcp_grid->kategori_produk3->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_kategori_produk3" name="o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3" id="o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3" value="<?php echo HtmlEncode($t_pcp_grid->kategori_produk3->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_kategori_produk3" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3" value="<?php echo HtmlEncode($t_pcp_grid->kategori_produk3->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_kategori_produk3" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3" value="<?php echo HtmlEncode($t_pcp_grid->kategori_produk3->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->produk->Visible) { // produk ?>
		<td data-name="produk" <?php echo $t_pcp_grid->produk->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_produk" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_produk" name="x<?php echo $t_pcp_grid->RowIndex ?>_produk" id="x<?php echo $t_pcp_grid->RowIndex ?>_produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pcp_grid->produk->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->produk->EditValue ?>"<?php echo $t_pcp_grid->produk->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_produk" name="o<?php echo $t_pcp_grid->RowIndex ?>_produk" id="o<?php echo $t_pcp_grid->RowIndex ?>_produk" value="<?php echo HtmlEncode($t_pcp_grid->produk->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_produk" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_produk" name="x<?php echo $t_pcp_grid->RowIndex ?>_produk" id="x<?php echo $t_pcp_grid->RowIndex ?>_produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pcp_grid->produk->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->produk->EditValue ?>"<?php echo $t_pcp_grid->produk->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_produk">
<span<?php echo $t_pcp_grid->produk->viewAttributes() ?>><?php echo $t_pcp_grid->produk->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_produk" name="x<?php echo $t_pcp_grid->RowIndex ?>_produk" id="x<?php echo $t_pcp_grid->RowIndex ?>_produk" value="<?php echo HtmlEncode($t_pcp_grid->produk->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_produk" name="o<?php echo $t_pcp_grid->RowIndex ?>_produk" id="o<?php echo $t_pcp_grid->RowIndex ?>_produk" value="<?php echo HtmlEncode($t_pcp_grid->produk->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_produk" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_produk" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_produk" value="<?php echo HtmlEncode($t_pcp_grid->produk->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_produk" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_produk" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_produk" value="<?php echo HtmlEncode($t_pcp_grid->produk->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->merek_dagang->Visible) { // merek_dagang ?>
		<td data-name="merek_dagang" <?php echo $t_pcp_grid->merek_dagang->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_merek_dagang" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_merek_dagang" name="x<?php echo $t_pcp_grid->RowIndex ?>_merek_dagang" id="x<?php echo $t_pcp_grid->RowIndex ?>_merek_dagang" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_grid->merek_dagang->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->merek_dagang->EditValue ?>"<?php echo $t_pcp_grid->merek_dagang->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_merek_dagang" name="o<?php echo $t_pcp_grid->RowIndex ?>_merek_dagang" id="o<?php echo $t_pcp_grid->RowIndex ?>_merek_dagang" value="<?php echo HtmlEncode($t_pcp_grid->merek_dagang->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_merek_dagang" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_merek_dagang" name="x<?php echo $t_pcp_grid->RowIndex ?>_merek_dagang" id="x<?php echo $t_pcp_grid->RowIndex ?>_merek_dagang" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_grid->merek_dagang->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->merek_dagang->EditValue ?>"<?php echo $t_pcp_grid->merek_dagang->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_merek_dagang">
<span<?php echo $t_pcp_grid->merek_dagang->viewAttributes() ?>><?php echo $t_pcp_grid->merek_dagang->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_merek_dagang" name="x<?php echo $t_pcp_grid->RowIndex ?>_merek_dagang" id="x<?php echo $t_pcp_grid->RowIndex ?>_merek_dagang" value="<?php echo HtmlEncode($t_pcp_grid->merek_dagang->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_merek_dagang" name="o<?php echo $t_pcp_grid->RowIndex ?>_merek_dagang" id="o<?php echo $t_pcp_grid->RowIndex ?>_merek_dagang" value="<?php echo HtmlEncode($t_pcp_grid->merek_dagang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_merek_dagang" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_merek_dagang" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_merek_dagang" value="<?php echo HtmlEncode($t_pcp_grid->merek_dagang->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_merek_dagang" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_merek_dagang" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_merek_dagang" value="<?php echo HtmlEncode($t_pcp_grid->merek_dagang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->jenis_perusahaan->Visible) { // jenis_perusahaan ?>
		<td data-name="jenis_perusahaan" <?php echo $t_pcp_grid->jenis_perusahaan->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_jenis_perusahaan" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_jenis_perusahaan" name="x<?php echo $t_pcp_grid->RowIndex ?>_jenis_perusahaan" id="x<?php echo $t_pcp_grid->RowIndex ?>_jenis_perusahaan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_pcp_grid->jenis_perusahaan->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->jenis_perusahaan->EditValue ?>"<?php echo $t_pcp_grid->jenis_perusahaan->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_jenis_perusahaan" name="o<?php echo $t_pcp_grid->RowIndex ?>_jenis_perusahaan" id="o<?php echo $t_pcp_grid->RowIndex ?>_jenis_perusahaan" value="<?php echo HtmlEncode($t_pcp_grid->jenis_perusahaan->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_jenis_perusahaan" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_jenis_perusahaan" name="x<?php echo $t_pcp_grid->RowIndex ?>_jenis_perusahaan" id="x<?php echo $t_pcp_grid->RowIndex ?>_jenis_perusahaan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_pcp_grid->jenis_perusahaan->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->jenis_perusahaan->EditValue ?>"<?php echo $t_pcp_grid->jenis_perusahaan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_jenis_perusahaan">
<span<?php echo $t_pcp_grid->jenis_perusahaan->viewAttributes() ?>><?php echo $t_pcp_grid->jenis_perusahaan->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_jenis_perusahaan" name="x<?php echo $t_pcp_grid->RowIndex ?>_jenis_perusahaan" id="x<?php echo $t_pcp_grid->RowIndex ?>_jenis_perusahaan" value="<?php echo HtmlEncode($t_pcp_grid->jenis_perusahaan->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_jenis_perusahaan" name="o<?php echo $t_pcp_grid->RowIndex ?>_jenis_perusahaan" id="o<?php echo $t_pcp_grid->RowIndex ?>_jenis_perusahaan" value="<?php echo HtmlEncode($t_pcp_grid->jenis_perusahaan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_jenis_perusahaan" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_jenis_perusahaan" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_jenis_perusahaan" value="<?php echo HtmlEncode($t_pcp_grid->jenis_perusahaan->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_jenis_perusahaan" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_jenis_perusahaan" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_jenis_perusahaan" value="<?php echo HtmlEncode($t_pcp_grid->jenis_perusahaan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->kapasitas_produksi->Visible) { // kapasitas_produksi ?>
		<td data-name="kapasitas_produksi" <?php echo $t_pcp_grid->kapasitas_produksi->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_kapasitas_produksi" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_kapasitas_produksi" name="x<?php echo $t_pcp_grid->RowIndex ?>_kapasitas_produksi" id="x<?php echo $t_pcp_grid->RowIndex ?>_kapasitas_produksi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pcp_grid->kapasitas_produksi->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->kapasitas_produksi->EditValue ?>"<?php echo $t_pcp_grid->kapasitas_produksi->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_kapasitas_produksi" name="o<?php echo $t_pcp_grid->RowIndex ?>_kapasitas_produksi" id="o<?php echo $t_pcp_grid->RowIndex ?>_kapasitas_produksi" value="<?php echo HtmlEncode($t_pcp_grid->kapasitas_produksi->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_kapasitas_produksi" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_kapasitas_produksi" name="x<?php echo $t_pcp_grid->RowIndex ?>_kapasitas_produksi" id="x<?php echo $t_pcp_grid->RowIndex ?>_kapasitas_produksi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pcp_grid->kapasitas_produksi->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->kapasitas_produksi->EditValue ?>"<?php echo $t_pcp_grid->kapasitas_produksi->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_kapasitas_produksi">
<span<?php echo $t_pcp_grid->kapasitas_produksi->viewAttributes() ?>><?php echo $t_pcp_grid->kapasitas_produksi->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_kapasitas_produksi" name="x<?php echo $t_pcp_grid->RowIndex ?>_kapasitas_produksi" id="x<?php echo $t_pcp_grid->RowIndex ?>_kapasitas_produksi" value="<?php echo HtmlEncode($t_pcp_grid->kapasitas_produksi->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_kapasitas_produksi" name="o<?php echo $t_pcp_grid->RowIndex ?>_kapasitas_produksi" id="o<?php echo $t_pcp_grid->RowIndex ?>_kapasitas_produksi" value="<?php echo HtmlEncode($t_pcp_grid->kapasitas_produksi->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_kapasitas_produksi" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_kapasitas_produksi" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_kapasitas_produksi" value="<?php echo HtmlEncode($t_pcp_grid->kapasitas_produksi->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_kapasitas_produksi" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_kapasitas_produksi" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_kapasitas_produksi" value="<?php echo HtmlEncode($t_pcp_grid->kapasitas_produksi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->omset->Visible) { // omset ?>
		<td data-name="omset" <?php echo $t_pcp_grid->omset->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_omset" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_omset" name="x<?php echo $t_pcp_grid->RowIndex ?>_omset" id="x<?php echo $t_pcp_grid->RowIndex ?>_omset" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_grid->omset->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->omset->EditValue ?>"<?php echo $t_pcp_grid->omset->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_omset" name="o<?php echo $t_pcp_grid->RowIndex ?>_omset" id="o<?php echo $t_pcp_grid->RowIndex ?>_omset" value="<?php echo HtmlEncode($t_pcp_grid->omset->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_omset" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_omset" name="x<?php echo $t_pcp_grid->RowIndex ?>_omset" id="x<?php echo $t_pcp_grid->RowIndex ?>_omset" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_grid->omset->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->omset->EditValue ?>"<?php echo $t_pcp_grid->omset->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_omset">
<span<?php echo $t_pcp_grid->omset->viewAttributes() ?>><?php echo $t_pcp_grid->omset->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_omset" name="x<?php echo $t_pcp_grid->RowIndex ?>_omset" id="x<?php echo $t_pcp_grid->RowIndex ?>_omset" value="<?php echo HtmlEncode($t_pcp_grid->omset->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_omset" name="o<?php echo $t_pcp_grid->RowIndex ?>_omset" id="o<?php echo $t_pcp_grid->RowIndex ?>_omset" value="<?php echo HtmlEncode($t_pcp_grid->omset->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_omset" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_omset" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_omset" value="<?php echo HtmlEncode($t_pcp_grid->omset->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_omset" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_omset" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_omset" value="<?php echo HtmlEncode($t_pcp_grid->omset->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->website->Visible) { // website ?>
		<td data-name="website" <?php echo $t_pcp_grid->website->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_website" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_website" name="x<?php echo $t_pcp_grid->RowIndex ?>_website" id="x<?php echo $t_pcp_grid->RowIndex ?>_website" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_grid->website->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->website->EditValue ?>"<?php echo $t_pcp_grid->website->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_website" name="o<?php echo $t_pcp_grid->RowIndex ?>_website" id="o<?php echo $t_pcp_grid->RowIndex ?>_website" value="<?php echo HtmlEncode($t_pcp_grid->website->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_website" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_website" name="x<?php echo $t_pcp_grid->RowIndex ?>_website" id="x<?php echo $t_pcp_grid->RowIndex ?>_website" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_grid->website->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->website->EditValue ?>"<?php echo $t_pcp_grid->website->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_website">
<span<?php echo $t_pcp_grid->website->viewAttributes() ?>><?php echo $t_pcp_grid->website->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_website" name="x<?php echo $t_pcp_grid->RowIndex ?>_website" id="x<?php echo $t_pcp_grid->RowIndex ?>_website" value="<?php echo HtmlEncode($t_pcp_grid->website->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_website" name="o<?php echo $t_pcp_grid->RowIndex ?>_website" id="o<?php echo $t_pcp_grid->RowIndex ?>_website" value="<?php echo HtmlEncode($t_pcp_grid->website->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_website" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_website" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_website" value="<?php echo HtmlEncode($t_pcp_grid->website->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_website" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_website" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_website" value="<?php echo HtmlEncode($t_pcp_grid->website->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->jml_pegawai->Visible) { // jml_pegawai ?>
		<td data-name="jml_pegawai" <?php echo $t_pcp_grid->jml_pegawai->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_jml_pegawai" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pcp" data-field="x_jml_pegawai" data-value-separator="<?php echo $t_pcp_grid->jml_pegawai->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai" name="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai"<?php echo $t_pcp_grid->jml_pegawai->editAttributes() ?>>
			<?php echo $t_pcp_grid->jml_pegawai->selectOptionListHtml("x{$t_pcp_grid->RowIndex}_jml_pegawai") ?>
		</select>
</div>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_jml_pegawai" name="o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai" id="o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai" value="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_jml_pegawai" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pcp" data-field="x_jml_pegawai" data-value-separator="<?php echo $t_pcp_grid->jml_pegawai->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai" name="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai"<?php echo $t_pcp_grid->jml_pegawai->editAttributes() ?>>
			<?php echo $t_pcp_grid->jml_pegawai->selectOptionListHtml("x{$t_pcp_grid->RowIndex}_jml_pegawai") ?>
		</select>
</div>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_jml_pegawai">
<span<?php echo $t_pcp_grid->jml_pegawai->viewAttributes() ?>><?php echo $t_pcp_grid->jml_pegawai->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_jml_pegawai" name="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai" id="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai" value="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_jml_pegawai" name="o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai" id="o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai" value="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_jml_pegawai" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai" value="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_jml_pegawai" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai" value="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->jml_pegawai2->Visible) { // jml_pegawai2 ?>
		<td data-name="jml_pegawai2" <?php echo $t_pcp_grid->jml_pegawai2->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_jml_pegawai2" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_jml_pegawai2" name="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai2" id="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai2" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai2->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->jml_pegawai2->EditValue ?>"<?php echo $t_pcp_grid->jml_pegawai2->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_jml_pegawai2" name="o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai2" id="o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai2" value="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai2->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_jml_pegawai2" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_jml_pegawai2" name="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai2" id="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai2" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai2->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->jml_pegawai2->EditValue ?>"<?php echo $t_pcp_grid->jml_pegawai2->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_jml_pegawai2">
<span<?php echo $t_pcp_grid->jml_pegawai2->viewAttributes() ?>><?php echo $t_pcp_grid->jml_pegawai2->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_jml_pegawai2" name="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai2" id="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai2" value="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai2->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_jml_pegawai2" name="o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai2" id="o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai2" value="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai2->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_jml_pegawai2" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai2" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai2" value="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai2->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_jml_pegawai2" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai2" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai2" value="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai2->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->jml_pegawai_tidaktetap->Visible) { // jml_pegawai_tidaktetap ?>
		<td data-name="jml_pegawai_tidaktetap" <?php echo $t_pcp_grid->jml_pegawai_tidaktetap->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_jml_pegawai_tidaktetap" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_jml_pegawai_tidaktetap" name="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai_tidaktetap" id="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai_tidaktetap" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai_tidaktetap->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->jml_pegawai_tidaktetap->EditValue ?>"<?php echo $t_pcp_grid->jml_pegawai_tidaktetap->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_jml_pegawai_tidaktetap" name="o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai_tidaktetap" id="o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai_tidaktetap" value="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai_tidaktetap->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_jml_pegawai_tidaktetap" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_jml_pegawai_tidaktetap" name="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai_tidaktetap" id="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai_tidaktetap" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai_tidaktetap->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->jml_pegawai_tidaktetap->EditValue ?>"<?php echo $t_pcp_grid->jml_pegawai_tidaktetap->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_jml_pegawai_tidaktetap">
<span<?php echo $t_pcp_grid->jml_pegawai_tidaktetap->viewAttributes() ?>><?php echo $t_pcp_grid->jml_pegawai_tidaktetap->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_jml_pegawai_tidaktetap" name="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai_tidaktetap" id="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai_tidaktetap" value="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai_tidaktetap->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_jml_pegawai_tidaktetap" name="o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai_tidaktetap" id="o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai_tidaktetap" value="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai_tidaktetap->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_jml_pegawai_tidaktetap" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai_tidaktetap" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai_tidaktetap" value="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai_tidaktetap->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_jml_pegawai_tidaktetap" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai_tidaktetap" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai_tidaktetap" value="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai_tidaktetap->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->legalitas->Visible) { // legalitas ?>
		<td data-name="legalitas" <?php echo $t_pcp_grid->legalitas->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_legalitas" class="form-group">
<div id="tp_x<?php echo $t_pcp_grid->RowIndex ?>_legalitas" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="t_pcp" data-field="x_legalitas" data-value-separator="<?php echo $t_pcp_grid->legalitas->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pcp_grid->RowIndex ?>_legalitas[]" id="x<?php echo $t_pcp_grid->RowIndex ?>_legalitas[]" value="{value}"<?php echo $t_pcp_grid->legalitas->editAttributes() ?>></div>
<div id="dsl_x<?php echo $t_pcp_grid->RowIndex ?>_legalitas" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_pcp_grid->legalitas->checkBoxListHtml(FALSE, "x{$t_pcp_grid->RowIndex}_legalitas[]") ?>
</div></div>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_legalitas" name="o<?php echo $t_pcp_grid->RowIndex ?>_legalitas[]" id="o<?php echo $t_pcp_grid->RowIndex ?>_legalitas[]" value="<?php echo HtmlEncode($t_pcp_grid->legalitas->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_legalitas" class="form-group">
<div id="tp_x<?php echo $t_pcp_grid->RowIndex ?>_legalitas" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="t_pcp" data-field="x_legalitas" data-value-separator="<?php echo $t_pcp_grid->legalitas->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pcp_grid->RowIndex ?>_legalitas[]" id="x<?php echo $t_pcp_grid->RowIndex ?>_legalitas[]" value="{value}"<?php echo $t_pcp_grid->legalitas->editAttributes() ?>></div>
<div id="dsl_x<?php echo $t_pcp_grid->RowIndex ?>_legalitas" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_pcp_grid->legalitas->checkBoxListHtml(FALSE, "x{$t_pcp_grid->RowIndex}_legalitas[]") ?>
</div></div>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_legalitas">
<span<?php echo $t_pcp_grid->legalitas->viewAttributes() ?>><?php echo $t_pcp_grid->legalitas->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_legalitas" name="x<?php echo $t_pcp_grid->RowIndex ?>_legalitas" id="x<?php echo $t_pcp_grid->RowIndex ?>_legalitas" value="<?php echo HtmlEncode($t_pcp_grid->legalitas->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_legalitas" name="o<?php echo $t_pcp_grid->RowIndex ?>_legalitas[]" id="o<?php echo $t_pcp_grid->RowIndex ?>_legalitas[]" value="<?php echo HtmlEncode($t_pcp_grid->legalitas->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_legalitas" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_legalitas" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_legalitas" value="<?php echo HtmlEncode($t_pcp_grid->legalitas->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_legalitas" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_legalitas[]" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_legalitas[]" value="<?php echo HtmlEncode($t_pcp_grid->legalitas->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->legalitas_lain->Visible) { // legalitas_lain ?>
		<td data-name="legalitas_lain" <?php echo $t_pcp_grid->legalitas_lain->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_legalitas_lain" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_legalitas_lain" name="x<?php echo $t_pcp_grid->RowIndex ?>_legalitas_lain" id="x<?php echo $t_pcp_grid->RowIndex ?>_legalitas_lain" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pcp_grid->legalitas_lain->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->legalitas_lain->EditValue ?>"<?php echo $t_pcp_grid->legalitas_lain->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_legalitas_lain" name="o<?php echo $t_pcp_grid->RowIndex ?>_legalitas_lain" id="o<?php echo $t_pcp_grid->RowIndex ?>_legalitas_lain" value="<?php echo HtmlEncode($t_pcp_grid->legalitas_lain->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_legalitas_lain" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_legalitas_lain" name="x<?php echo $t_pcp_grid->RowIndex ?>_legalitas_lain" id="x<?php echo $t_pcp_grid->RowIndex ?>_legalitas_lain" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pcp_grid->legalitas_lain->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->legalitas_lain->EditValue ?>"<?php echo $t_pcp_grid->legalitas_lain->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_legalitas_lain">
<span<?php echo $t_pcp_grid->legalitas_lain->viewAttributes() ?>><?php echo $t_pcp_grid->legalitas_lain->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_legalitas_lain" name="x<?php echo $t_pcp_grid->RowIndex ?>_legalitas_lain" id="x<?php echo $t_pcp_grid->RowIndex ?>_legalitas_lain" value="<?php echo HtmlEncode($t_pcp_grid->legalitas_lain->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_legalitas_lain" name="o<?php echo $t_pcp_grid->RowIndex ?>_legalitas_lain" id="o<?php echo $t_pcp_grid->RowIndex ?>_legalitas_lain" value="<?php echo HtmlEncode($t_pcp_grid->legalitas_lain->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_legalitas_lain" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_legalitas_lain" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_legalitas_lain" value="<?php echo HtmlEncode($t_pcp_grid->legalitas_lain->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_legalitas_lain" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_legalitas_lain" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_legalitas_lain" value="<?php echo HtmlEncode($t_pcp_grid->legalitas_lain->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->sertifikat->Visible) { // sertifikat ?>
		<td data-name="sertifikat" <?php echo $t_pcp_grid->sertifikat->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_sertifikat" class="form-group">
<div id="tp_x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="t_pcp" data-field="x_sertifikat" data-value-separator="<?php echo $t_pcp_grid->sertifikat->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat[]" id="x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat[]" value="{value}"<?php echo $t_pcp_grid->sertifikat->editAttributes() ?>></div>
<div id="dsl_x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_pcp_grid->sertifikat->checkBoxListHtml(FALSE, "x{$t_pcp_grid->RowIndex}_sertifikat[]") ?>
</div></div>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_sertifikat" name="o<?php echo $t_pcp_grid->RowIndex ?>_sertifikat[]" id="o<?php echo $t_pcp_grid->RowIndex ?>_sertifikat[]" value="<?php echo HtmlEncode($t_pcp_grid->sertifikat->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_sertifikat" class="form-group">
<div id="tp_x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="t_pcp" data-field="x_sertifikat" data-value-separator="<?php echo $t_pcp_grid->sertifikat->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat[]" id="x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat[]" value="{value}"<?php echo $t_pcp_grid->sertifikat->editAttributes() ?>></div>
<div id="dsl_x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_pcp_grid->sertifikat->checkBoxListHtml(FALSE, "x{$t_pcp_grid->RowIndex}_sertifikat[]") ?>
</div></div>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_sertifikat">
<span<?php echo $t_pcp_grid->sertifikat->viewAttributes() ?>><?php echo $t_pcp_grid->sertifikat->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_sertifikat" name="x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat" id="x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($t_pcp_grid->sertifikat->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_sertifikat" name="o<?php echo $t_pcp_grid->RowIndex ?>_sertifikat[]" id="o<?php echo $t_pcp_grid->RowIndex ?>_sertifikat[]" value="<?php echo HtmlEncode($t_pcp_grid->sertifikat->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_sertifikat" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($t_pcp_grid->sertifikat->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_sertifikat" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_sertifikat[]" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_sertifikat[]" value="<?php echo HtmlEncode($t_pcp_grid->sertifikat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->sertifikat_lain->Visible) { // sertifikat_lain ?>
		<td data-name="sertifikat_lain" <?php echo $t_pcp_grid->sertifikat_lain->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_sertifikat_lain" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_sertifikat_lain" name="x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat_lain" id="x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat_lain" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pcp_grid->sertifikat_lain->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->sertifikat_lain->EditValue ?>"<?php echo $t_pcp_grid->sertifikat_lain->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_sertifikat_lain" name="o<?php echo $t_pcp_grid->RowIndex ?>_sertifikat_lain" id="o<?php echo $t_pcp_grid->RowIndex ?>_sertifikat_lain" value="<?php echo HtmlEncode($t_pcp_grid->sertifikat_lain->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_sertifikat_lain" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_sertifikat_lain" name="x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat_lain" id="x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat_lain" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pcp_grid->sertifikat_lain->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->sertifikat_lain->EditValue ?>"<?php echo $t_pcp_grid->sertifikat_lain->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_sertifikat_lain">
<span<?php echo $t_pcp_grid->sertifikat_lain->viewAttributes() ?>><?php echo $t_pcp_grid->sertifikat_lain->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_sertifikat_lain" name="x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat_lain" id="x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat_lain" value="<?php echo HtmlEncode($t_pcp_grid->sertifikat_lain->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_sertifikat_lain" name="o<?php echo $t_pcp_grid->RowIndex ?>_sertifikat_lain" id="o<?php echo $t_pcp_grid->RowIndex ?>_sertifikat_lain" value="<?php echo HtmlEncode($t_pcp_grid->sertifikat_lain->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_sertifikat_lain" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat_lain" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat_lain" value="<?php echo HtmlEncode($t_pcp_grid->sertifikat_lain->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_sertifikat_lain" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_sertifikat_lain" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_sertifikat_lain" value="<?php echo HtmlEncode($t_pcp_grid->sertifikat_lain->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->alat_promosi->Visible) { // alat_promosi ?>
		<td data-name="alat_promosi" <?php echo $t_pcp_grid->alat_promosi->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_alat_promosi" class="form-group">
<div id="tp_x<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="t_pcp" data-field="x_alat_promosi" data-value-separator="<?php echo $t_pcp_grid->alat_promosi->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi[]" id="x<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi[]" value="{value}"<?php echo $t_pcp_grid->alat_promosi->editAttributes() ?>></div>
<div id="dsl_x<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_pcp_grid->alat_promosi->checkBoxListHtml(FALSE, "x{$t_pcp_grid->RowIndex}_alat_promosi[]") ?>
</div></div>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_alat_promosi" name="o<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi[]" id="o<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi[]" value="<?php echo HtmlEncode($t_pcp_grid->alat_promosi->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_alat_promosi" class="form-group">
<div id="tp_x<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="t_pcp" data-field="x_alat_promosi" data-value-separator="<?php echo $t_pcp_grid->alat_promosi->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi[]" id="x<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi[]" value="{value}"<?php echo $t_pcp_grid->alat_promosi->editAttributes() ?>></div>
<div id="dsl_x<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_pcp_grid->alat_promosi->checkBoxListHtml(FALSE, "x{$t_pcp_grid->RowIndex}_alat_promosi[]") ?>
</div></div>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_alat_promosi">
<span<?php echo $t_pcp_grid->alat_promosi->viewAttributes() ?>><?php echo $t_pcp_grid->alat_promosi->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_alat_promosi" name="x<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi" id="x<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi" value="<?php echo HtmlEncode($t_pcp_grid->alat_promosi->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_alat_promosi" name="o<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi[]" id="o<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi[]" value="<?php echo HtmlEncode($t_pcp_grid->alat_promosi->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_alat_promosi" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi" value="<?php echo HtmlEncode($t_pcp_grid->alat_promosi->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_alat_promosi" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi[]" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi[]" value="<?php echo HtmlEncode($t_pcp_grid->alat_promosi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->promosi_lain->Visible) { // promosi_lain ?>
		<td data-name="promosi_lain" <?php echo $t_pcp_grid->promosi_lain->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_promosi_lain" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_promosi_lain" name="x<?php echo $t_pcp_grid->RowIndex ?>_promosi_lain" id="x<?php echo $t_pcp_grid->RowIndex ?>_promosi_lain" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pcp_grid->promosi_lain->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->promosi_lain->EditValue ?>"<?php echo $t_pcp_grid->promosi_lain->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_promosi_lain" name="o<?php echo $t_pcp_grid->RowIndex ?>_promosi_lain" id="o<?php echo $t_pcp_grid->RowIndex ?>_promosi_lain" value="<?php echo HtmlEncode($t_pcp_grid->promosi_lain->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_promosi_lain" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_promosi_lain" name="x<?php echo $t_pcp_grid->RowIndex ?>_promosi_lain" id="x<?php echo $t_pcp_grid->RowIndex ?>_promosi_lain" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pcp_grid->promosi_lain->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->promosi_lain->EditValue ?>"<?php echo $t_pcp_grid->promosi_lain->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_promosi_lain">
<span<?php echo $t_pcp_grid->promosi_lain->viewAttributes() ?>><?php echo $t_pcp_grid->promosi_lain->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_promosi_lain" name="x<?php echo $t_pcp_grid->RowIndex ?>_promosi_lain" id="x<?php echo $t_pcp_grid->RowIndex ?>_promosi_lain" value="<?php echo HtmlEncode($t_pcp_grid->promosi_lain->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_promosi_lain" name="o<?php echo $t_pcp_grid->RowIndex ?>_promosi_lain" id="o<?php echo $t_pcp_grid->RowIndex ?>_promosi_lain" value="<?php echo HtmlEncode($t_pcp_grid->promosi_lain->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_promosi_lain" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_promosi_lain" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_promosi_lain" value="<?php echo HtmlEncode($t_pcp_grid->promosi_lain->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_promosi_lain" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_promosi_lain" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_promosi_lain" value="<?php echo HtmlEncode($t_pcp_grid->promosi_lain->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->tahun_ecp->Visible) { // tahun_ecp ?>
		<td data-name="tahun_ecp" <?php echo $t_pcp_grid->tahun_ecp->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_tahun_ecp" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_tahun_ecp" name="x<?php echo $t_pcp_grid->RowIndex ?>_tahun_ecp" id="x<?php echo $t_pcp_grid->RowIndex ?>_tahun_ecp" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pcp_grid->tahun_ecp->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->tahun_ecp->EditValue ?>"<?php echo $t_pcp_grid->tahun_ecp->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_tahun_ecp" name="o<?php echo $t_pcp_grid->RowIndex ?>_tahun_ecp" id="o<?php echo $t_pcp_grid->RowIndex ?>_tahun_ecp" value="<?php echo HtmlEncode($t_pcp_grid->tahun_ecp->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_tahun_ecp" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_tahun_ecp" name="x<?php echo $t_pcp_grid->RowIndex ?>_tahun_ecp" id="x<?php echo $t_pcp_grid->RowIndex ?>_tahun_ecp" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pcp_grid->tahun_ecp->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->tahun_ecp->EditValue ?>"<?php echo $t_pcp_grid->tahun_ecp->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_tahun_ecp">
<span<?php echo $t_pcp_grid->tahun_ecp->viewAttributes() ?>><?php echo $t_pcp_grid->tahun_ecp->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_tahun_ecp" name="x<?php echo $t_pcp_grid->RowIndex ?>_tahun_ecp" id="x<?php echo $t_pcp_grid->RowIndex ?>_tahun_ecp" value="<?php echo HtmlEncode($t_pcp_grid->tahun_ecp->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_tahun_ecp" name="o<?php echo $t_pcp_grid->RowIndex ?>_tahun_ecp" id="o<?php echo $t_pcp_grid->RowIndex ?>_tahun_ecp" value="<?php echo HtmlEncode($t_pcp_grid->tahun_ecp->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_tahun_ecp" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_tahun_ecp" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_tahun_ecp" value="<?php echo HtmlEncode($t_pcp_grid->tahun_ecp->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_tahun_ecp" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_tahun_ecp" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_tahun_ecp" value="<?php echo HtmlEncode($t_pcp_grid->tahun_ecp->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->wilayah_ecp->Visible) { // wilayah_ecp ?>
		<td data-name="wilayah_ecp" <?php echo $t_pcp_grid->wilayah_ecp->cellAttributes() ?>>
<?php if ($t_pcp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_wilayah_ecp" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_wilayah_ecp" name="x<?php echo $t_pcp_grid->RowIndex ?>_wilayah_ecp" id="x<?php echo $t_pcp_grid->RowIndex ?>_wilayah_ecp" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_grid->wilayah_ecp->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->wilayah_ecp->EditValue ?>"<?php echo $t_pcp_grid->wilayah_ecp->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_wilayah_ecp" name="o<?php echo $t_pcp_grid->RowIndex ?>_wilayah_ecp" id="o<?php echo $t_pcp_grid->RowIndex ?>_wilayah_ecp" value="<?php echo HtmlEncode($t_pcp_grid->wilayah_ecp->OldValue) ?>">
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_wilayah_ecp" class="form-group">
<input type="text" data-table="t_pcp" data-field="x_wilayah_ecp" name="x<?php echo $t_pcp_grid->RowIndex ?>_wilayah_ecp" id="x<?php echo $t_pcp_grid->RowIndex ?>_wilayah_ecp" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_grid->wilayah_ecp->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->wilayah_ecp->EditValue ?>"<?php echo $t_pcp_grid->wilayah_ecp->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pcp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pcp_grid->RowCount ?>_t_pcp_wilayah_ecp">
<span<?php echo $t_pcp_grid->wilayah_ecp->viewAttributes() ?>><?php echo $t_pcp_grid->wilayah_ecp->getViewValue() ?></span>
</span>
<?php if (!$t_pcp->isConfirm()) { ?>
<input type="hidden" data-table="t_pcp" data-field="x_wilayah_ecp" name="x<?php echo $t_pcp_grid->RowIndex ?>_wilayah_ecp" id="x<?php echo $t_pcp_grid->RowIndex ?>_wilayah_ecp" value="<?php echo HtmlEncode($t_pcp_grid->wilayah_ecp->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_wilayah_ecp" name="o<?php echo $t_pcp_grid->RowIndex ?>_wilayah_ecp" id="o<?php echo $t_pcp_grid->RowIndex ?>_wilayah_ecp" value="<?php echo HtmlEncode($t_pcp_grid->wilayah_ecp->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pcp" data-field="x_wilayah_ecp" name="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_wilayah_ecp" id="ft_pcpgrid$x<?php echo $t_pcp_grid->RowIndex ?>_wilayah_ecp" value="<?php echo HtmlEncode($t_pcp_grid->wilayah_ecp->FormValue) ?>">
<input type="hidden" data-table="t_pcp" data-field="x_wilayah_ecp" name="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_wilayah_ecp" id="ft_pcpgrid$o<?php echo $t_pcp_grid->RowIndex ?>_wilayah_ecp" value="<?php echo HtmlEncode($t_pcp_grid->wilayah_ecp->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_pcp_grid->ListOptions->render("body", "right", $t_pcp_grid->RowCount);
?>
	</tr>
<?php if ($t_pcp->RowType == ROWTYPE_ADD || $t_pcp->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_pcpgrid", "load"], function() {
	ft_pcpgrid.updateLists(<?php echo $t_pcp_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_pcp_grid->isGridAdd() || $t_pcp->CurrentMode == "copy")
		if (!$t_pcp_grid->Recordset->EOF)
			$t_pcp_grid->Recordset->moveNext();
}
?>
<?php
	if ($t_pcp->CurrentMode == "add" || $t_pcp->CurrentMode == "copy" || $t_pcp->CurrentMode == "edit") {
		$t_pcp_grid->RowIndex = '$rowindex$';
		$t_pcp_grid->loadRowValues();

		// Set row properties
		$t_pcp->resetAttributes();
		$t_pcp->RowAttrs->merge(["data-rowindex" => $t_pcp_grid->RowIndex, "id" => "r0_t_pcp", "data-rowtype" => ROWTYPE_ADD]);
		$t_pcp->RowAttrs->appendClass("ew-template");
		$t_pcp->RowType = ROWTYPE_ADD;

		// Render row
		$t_pcp_grid->renderRow();

		// Render list options
		$t_pcp_grid->renderListOptions();
		$t_pcp_grid->StartRowCount = 0;
?>
	<tr <?php echo $t_pcp->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_pcp_grid->ListOptions->render("body", "left", $t_pcp_grid->RowIndex);
?>
	<?php if ($t_pcp_grid->nama_peserta->Visible) { // nama_peserta ?>
		<td data-name="nama_peserta">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_nama_peserta" class="form-group t_pcp_nama_peserta">
<input type="text" data-table="t_pcp" data-field="x_nama_peserta" name="x<?php echo $t_pcp_grid->RowIndex ?>_nama_peserta" id="x<?php echo $t_pcp_grid->RowIndex ?>_nama_peserta" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_grid->nama_peserta->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->nama_peserta->EditValue ?>"<?php echo $t_pcp_grid->nama_peserta->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_nama_peserta" class="form-group t_pcp_nama_peserta">
<span<?php echo $t_pcp_grid->nama_peserta->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->nama_peserta->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_nama_peserta" name="x<?php echo $t_pcp_grid->RowIndex ?>_nama_peserta" id="x<?php echo $t_pcp_grid->RowIndex ?>_nama_peserta" value="<?php echo HtmlEncode($t_pcp_grid->nama_peserta->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_nama_peserta" name="o<?php echo $t_pcp_grid->RowIndex ?>_nama_peserta" id="o<?php echo $t_pcp_grid->RowIndex ?>_nama_peserta" value="<?php echo HtmlEncode($t_pcp_grid->nama_peserta->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->email_add->Visible) { // email_add ?>
		<td data-name="email_add">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_email_add" class="form-group t_pcp_email_add">
<input type="text" data-table="t_pcp" data-field="x_email_add" name="x<?php echo $t_pcp_grid->RowIndex ?>_email_add" id="x<?php echo $t_pcp_grid->RowIndex ?>_email_add" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_grid->email_add->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->email_add->EditValue ?>"<?php echo $t_pcp_grid->email_add->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_email_add" class="form-group t_pcp_email_add">
<span<?php echo $t_pcp_grid->email_add->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->email_add->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_email_add" name="x<?php echo $t_pcp_grid->RowIndex ?>_email_add" id="x<?php echo $t_pcp_grid->RowIndex ?>_email_add" value="<?php echo HtmlEncode($t_pcp_grid->email_add->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_email_add" name="o<?php echo $t_pcp_grid->RowIndex ?>_email_add" id="o<?php echo $t_pcp_grid->RowIndex ?>_email_add" value="<?php echo HtmlEncode($t_pcp_grid->email_add->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->handphone->Visible) { // handphone ?>
		<td data-name="handphone">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_handphone" class="form-group t_pcp_handphone">
<input type="text" data-table="t_pcp" data-field="x_handphone" name="x<?php echo $t_pcp_grid->RowIndex ?>_handphone" id="x<?php echo $t_pcp_grid->RowIndex ?>_handphone" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_pcp_grid->handphone->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->handphone->EditValue ?>"<?php echo $t_pcp_grid->handphone->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_handphone" class="form-group t_pcp_handphone">
<span<?php echo $t_pcp_grid->handphone->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->handphone->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_handphone" name="x<?php echo $t_pcp_grid->RowIndex ?>_handphone" id="x<?php echo $t_pcp_grid->RowIndex ?>_handphone" value="<?php echo HtmlEncode($t_pcp_grid->handphone->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_handphone" name="o<?php echo $t_pcp_grid->RowIndex ?>_handphone" id="o<?php echo $t_pcp_grid->RowIndex ?>_handphone" value="<?php echo HtmlEncode($t_pcp_grid->handphone->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->namap->Visible) { // namap ?>
		<td data-name="namap">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_namap" class="form-group t_pcp_namap">
<?php
$onchange = $t_pcp_grid->namap->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pcp_grid->namap->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_pcp_grid->RowIndex ?>_namap">
	<input type="text" class="form-control" name="sv_x<?php echo $t_pcp_grid->RowIndex ?>_namap" id="sv_x<?php echo $t_pcp_grid->RowIndex ?>_namap" value="<?php echo RemoveHtml($t_pcp_grid->namap->EditValue) ?>" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($t_pcp_grid->namap->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pcp_grid->namap->getPlaceHolder()) ?>"<?php echo $t_pcp_grid->namap->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_namap" data-value-separator="<?php echo $t_pcp_grid->namap->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pcp_grid->RowIndex ?>_namap" id="x<?php echo $t_pcp_grid->RowIndex ?>_namap" value="<?php echo HtmlEncode($t_pcp_grid->namap->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pcpgrid"], function() {
	ft_pcpgrid.createAutoSuggest({"id":"x<?php echo $t_pcp_grid->RowIndex ?>_namap","forceSelect":false});
});
</script>
<?php echo $t_pcp_grid->namap->Lookup->getParamTag($t_pcp_grid, "p_x" . $t_pcp_grid->RowIndex . "_namap") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_namap" class="form-group t_pcp_namap">
<span<?php echo $t_pcp_grid->namap->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->namap->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_namap" name="x<?php echo $t_pcp_grid->RowIndex ?>_namap" id="x<?php echo $t_pcp_grid->RowIndex ?>_namap" value="<?php echo HtmlEncode($t_pcp_grid->namap->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_namap" name="o<?php echo $t_pcp_grid->RowIndex ?>_namap" id="o<?php echo $t_pcp_grid->RowIndex ?>_namap" value="<?php echo HtmlEncode($t_pcp_grid->namap->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->kategori_produk->Visible) { // kategori_produk ?>
		<td data-name="kategori_produk">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_kategori_produk" class="form-group t_pcp_kategori_produk">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pcp" data-field="x_kategori_produk" data-value-separator="<?php echo $t_pcp_grid->kategori_produk->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk" name="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk"<?php echo $t_pcp_grid->kategori_produk->editAttributes() ?>>
			<?php echo $t_pcp_grid->kategori_produk->selectOptionListHtml("x{$t_pcp_grid->RowIndex}_kategori_produk") ?>
		</select>
	<?php if (AllowAdd(CurrentProjectID() . "t_kat_produk") && !$t_pcp_grid->kategori_produk->ReadOnly) { ?>
	<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $t_pcp_grid->kategori_produk->caption() ?>" data-title="<?php echo $t_pcp_grid->kategori_produk->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk',url:'t_kat_produkaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button></div>
	<?php } ?>
</div>
<?php echo $t_pcp_grid->kategori_produk->Lookup->getParamTag($t_pcp_grid, "p_x" . $t_pcp_grid->RowIndex . "_kategori_produk") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_kategori_produk" class="form-group t_pcp_kategori_produk">
<span<?php echo $t_pcp_grid->kategori_produk->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->kategori_produk->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_kategori_produk" name="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk" id="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk" value="<?php echo HtmlEncode($t_pcp_grid->kategori_produk->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_kategori_produk" name="o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk" id="o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk" value="<?php echo HtmlEncode($t_pcp_grid->kategori_produk->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->kategori_produk2->Visible) { // kategori_produk2 ?>
		<td data-name="kategori_produk2">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_kategori_produk2" class="form-group t_pcp_kategori_produk2">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pcp" data-field="x_kategori_produk2" data-value-separator="<?php echo $t_pcp_grid->kategori_produk2->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2" name="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2"<?php echo $t_pcp_grid->kategori_produk2->editAttributes() ?>>
			<?php echo $t_pcp_grid->kategori_produk2->selectOptionListHtml("x{$t_pcp_grid->RowIndex}_kategori_produk2") ?>
		</select>
	<?php if (AllowAdd(CurrentProjectID() . "t_kat_produk") && !$t_pcp_grid->kategori_produk2->ReadOnly) { ?>
	<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $t_pcp_grid->kategori_produk2->caption() ?>" data-title="<?php echo $t_pcp_grid->kategori_produk2->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2',url:'t_kat_produkaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button></div>
	<?php } ?>
</div>
<?php echo $t_pcp_grid->kategori_produk2->Lookup->getParamTag($t_pcp_grid, "p_x" . $t_pcp_grid->RowIndex . "_kategori_produk2") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_kategori_produk2" class="form-group t_pcp_kategori_produk2">
<span<?php echo $t_pcp_grid->kategori_produk2->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->kategori_produk2->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_kategori_produk2" name="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2" id="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2" value="<?php echo HtmlEncode($t_pcp_grid->kategori_produk2->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_kategori_produk2" name="o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2" id="o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk2" value="<?php echo HtmlEncode($t_pcp_grid->kategori_produk2->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->kategori_produk3->Visible) { // kategori_produk3 ?>
		<td data-name="kategori_produk3">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_kategori_produk3" class="form-group t_pcp_kategori_produk3">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pcp" data-field="x_kategori_produk3" data-value-separator="<?php echo $t_pcp_grid->kategori_produk3->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3" name="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3"<?php echo $t_pcp_grid->kategori_produk3->editAttributes() ?>>
			<?php echo $t_pcp_grid->kategori_produk3->selectOptionListHtml("x{$t_pcp_grid->RowIndex}_kategori_produk3") ?>
		</select>
	<?php if (AllowAdd(CurrentProjectID() . "t_kat_produk") && !$t_pcp_grid->kategori_produk3->ReadOnly) { ?>
	<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $t_pcp_grid->kategori_produk3->caption() ?>" data-title="<?php echo $t_pcp_grid->kategori_produk3->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3',url:'t_kat_produkaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button></div>
	<?php } ?>
</div>
<?php echo $t_pcp_grid->kategori_produk3->Lookup->getParamTag($t_pcp_grid, "p_x" . $t_pcp_grid->RowIndex . "_kategori_produk3") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_kategori_produk3" class="form-group t_pcp_kategori_produk3">
<span<?php echo $t_pcp_grid->kategori_produk3->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->kategori_produk3->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_kategori_produk3" name="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3" id="x<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3" value="<?php echo HtmlEncode($t_pcp_grid->kategori_produk3->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_kategori_produk3" name="o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3" id="o<?php echo $t_pcp_grid->RowIndex ?>_kategori_produk3" value="<?php echo HtmlEncode($t_pcp_grid->kategori_produk3->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->produk->Visible) { // produk ?>
		<td data-name="produk">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_produk" class="form-group t_pcp_produk">
<input type="text" data-table="t_pcp" data-field="x_produk" name="x<?php echo $t_pcp_grid->RowIndex ?>_produk" id="x<?php echo $t_pcp_grid->RowIndex ?>_produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pcp_grid->produk->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->produk->EditValue ?>"<?php echo $t_pcp_grid->produk->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_produk" class="form-group t_pcp_produk">
<span<?php echo $t_pcp_grid->produk->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->produk->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_produk" name="x<?php echo $t_pcp_grid->RowIndex ?>_produk" id="x<?php echo $t_pcp_grid->RowIndex ?>_produk" value="<?php echo HtmlEncode($t_pcp_grid->produk->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_produk" name="o<?php echo $t_pcp_grid->RowIndex ?>_produk" id="o<?php echo $t_pcp_grid->RowIndex ?>_produk" value="<?php echo HtmlEncode($t_pcp_grid->produk->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->merek_dagang->Visible) { // merek_dagang ?>
		<td data-name="merek_dagang">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_merek_dagang" class="form-group t_pcp_merek_dagang">
<input type="text" data-table="t_pcp" data-field="x_merek_dagang" name="x<?php echo $t_pcp_grid->RowIndex ?>_merek_dagang" id="x<?php echo $t_pcp_grid->RowIndex ?>_merek_dagang" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_grid->merek_dagang->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->merek_dagang->EditValue ?>"<?php echo $t_pcp_grid->merek_dagang->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_merek_dagang" class="form-group t_pcp_merek_dagang">
<span<?php echo $t_pcp_grid->merek_dagang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->merek_dagang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_merek_dagang" name="x<?php echo $t_pcp_grid->RowIndex ?>_merek_dagang" id="x<?php echo $t_pcp_grid->RowIndex ?>_merek_dagang" value="<?php echo HtmlEncode($t_pcp_grid->merek_dagang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_merek_dagang" name="o<?php echo $t_pcp_grid->RowIndex ?>_merek_dagang" id="o<?php echo $t_pcp_grid->RowIndex ?>_merek_dagang" value="<?php echo HtmlEncode($t_pcp_grid->merek_dagang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->jenis_perusahaan->Visible) { // jenis_perusahaan ?>
		<td data-name="jenis_perusahaan">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_jenis_perusahaan" class="form-group t_pcp_jenis_perusahaan">
<input type="text" data-table="t_pcp" data-field="x_jenis_perusahaan" name="x<?php echo $t_pcp_grid->RowIndex ?>_jenis_perusahaan" id="x<?php echo $t_pcp_grid->RowIndex ?>_jenis_perusahaan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_pcp_grid->jenis_perusahaan->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->jenis_perusahaan->EditValue ?>"<?php echo $t_pcp_grid->jenis_perusahaan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_jenis_perusahaan" class="form-group t_pcp_jenis_perusahaan">
<span<?php echo $t_pcp_grid->jenis_perusahaan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->jenis_perusahaan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_jenis_perusahaan" name="x<?php echo $t_pcp_grid->RowIndex ?>_jenis_perusahaan" id="x<?php echo $t_pcp_grid->RowIndex ?>_jenis_perusahaan" value="<?php echo HtmlEncode($t_pcp_grid->jenis_perusahaan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_jenis_perusahaan" name="o<?php echo $t_pcp_grid->RowIndex ?>_jenis_perusahaan" id="o<?php echo $t_pcp_grid->RowIndex ?>_jenis_perusahaan" value="<?php echo HtmlEncode($t_pcp_grid->jenis_perusahaan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->kapasitas_produksi->Visible) { // kapasitas_produksi ?>
		<td data-name="kapasitas_produksi">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_kapasitas_produksi" class="form-group t_pcp_kapasitas_produksi">
<input type="text" data-table="t_pcp" data-field="x_kapasitas_produksi" name="x<?php echo $t_pcp_grid->RowIndex ?>_kapasitas_produksi" id="x<?php echo $t_pcp_grid->RowIndex ?>_kapasitas_produksi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pcp_grid->kapasitas_produksi->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->kapasitas_produksi->EditValue ?>"<?php echo $t_pcp_grid->kapasitas_produksi->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_kapasitas_produksi" class="form-group t_pcp_kapasitas_produksi">
<span<?php echo $t_pcp_grid->kapasitas_produksi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->kapasitas_produksi->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_kapasitas_produksi" name="x<?php echo $t_pcp_grid->RowIndex ?>_kapasitas_produksi" id="x<?php echo $t_pcp_grid->RowIndex ?>_kapasitas_produksi" value="<?php echo HtmlEncode($t_pcp_grid->kapasitas_produksi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_kapasitas_produksi" name="o<?php echo $t_pcp_grid->RowIndex ?>_kapasitas_produksi" id="o<?php echo $t_pcp_grid->RowIndex ?>_kapasitas_produksi" value="<?php echo HtmlEncode($t_pcp_grid->kapasitas_produksi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->omset->Visible) { // omset ?>
		<td data-name="omset">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_omset" class="form-group t_pcp_omset">
<input type="text" data-table="t_pcp" data-field="x_omset" name="x<?php echo $t_pcp_grid->RowIndex ?>_omset" id="x<?php echo $t_pcp_grid->RowIndex ?>_omset" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_grid->omset->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->omset->EditValue ?>"<?php echo $t_pcp_grid->omset->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_omset" class="form-group t_pcp_omset">
<span<?php echo $t_pcp_grid->omset->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->omset->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_omset" name="x<?php echo $t_pcp_grid->RowIndex ?>_omset" id="x<?php echo $t_pcp_grid->RowIndex ?>_omset" value="<?php echo HtmlEncode($t_pcp_grid->omset->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_omset" name="o<?php echo $t_pcp_grid->RowIndex ?>_omset" id="o<?php echo $t_pcp_grid->RowIndex ?>_omset" value="<?php echo HtmlEncode($t_pcp_grid->omset->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->website->Visible) { // website ?>
		<td data-name="website">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_website" class="form-group t_pcp_website">
<input type="text" data-table="t_pcp" data-field="x_website" name="x<?php echo $t_pcp_grid->RowIndex ?>_website" id="x<?php echo $t_pcp_grid->RowIndex ?>_website" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_grid->website->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->website->EditValue ?>"<?php echo $t_pcp_grid->website->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_website" class="form-group t_pcp_website">
<span<?php echo $t_pcp_grid->website->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->website->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_website" name="x<?php echo $t_pcp_grid->RowIndex ?>_website" id="x<?php echo $t_pcp_grid->RowIndex ?>_website" value="<?php echo HtmlEncode($t_pcp_grid->website->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_website" name="o<?php echo $t_pcp_grid->RowIndex ?>_website" id="o<?php echo $t_pcp_grid->RowIndex ?>_website" value="<?php echo HtmlEncode($t_pcp_grid->website->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->jml_pegawai->Visible) { // jml_pegawai ?>
		<td data-name="jml_pegawai">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_jml_pegawai" class="form-group t_pcp_jml_pegawai">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pcp" data-field="x_jml_pegawai" data-value-separator="<?php echo $t_pcp_grid->jml_pegawai->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai" name="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai"<?php echo $t_pcp_grid->jml_pegawai->editAttributes() ?>>
			<?php echo $t_pcp_grid->jml_pegawai->selectOptionListHtml("x{$t_pcp_grid->RowIndex}_jml_pegawai") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_jml_pegawai" class="form-group t_pcp_jml_pegawai">
<span<?php echo $t_pcp_grid->jml_pegawai->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->jml_pegawai->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_jml_pegawai" name="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai" id="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai" value="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_jml_pegawai" name="o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai" id="o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai" value="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->jml_pegawai2->Visible) { // jml_pegawai2 ?>
		<td data-name="jml_pegawai2">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_jml_pegawai2" class="form-group t_pcp_jml_pegawai2">
<input type="text" data-table="t_pcp" data-field="x_jml_pegawai2" name="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai2" id="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai2" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai2->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->jml_pegawai2->EditValue ?>"<?php echo $t_pcp_grid->jml_pegawai2->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_jml_pegawai2" class="form-group t_pcp_jml_pegawai2">
<span<?php echo $t_pcp_grid->jml_pegawai2->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->jml_pegawai2->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_jml_pegawai2" name="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai2" id="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai2" value="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai2->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_jml_pegawai2" name="o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai2" id="o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai2" value="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai2->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->jml_pegawai_tidaktetap->Visible) { // jml_pegawai_tidaktetap ?>
		<td data-name="jml_pegawai_tidaktetap">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_jml_pegawai_tidaktetap" class="form-group t_pcp_jml_pegawai_tidaktetap">
<input type="text" data-table="t_pcp" data-field="x_jml_pegawai_tidaktetap" name="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai_tidaktetap" id="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai_tidaktetap" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai_tidaktetap->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->jml_pegawai_tidaktetap->EditValue ?>"<?php echo $t_pcp_grid->jml_pegawai_tidaktetap->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_jml_pegawai_tidaktetap" class="form-group t_pcp_jml_pegawai_tidaktetap">
<span<?php echo $t_pcp_grid->jml_pegawai_tidaktetap->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->jml_pegawai_tidaktetap->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_jml_pegawai_tidaktetap" name="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai_tidaktetap" id="x<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai_tidaktetap" value="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai_tidaktetap->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_jml_pegawai_tidaktetap" name="o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai_tidaktetap" id="o<?php echo $t_pcp_grid->RowIndex ?>_jml_pegawai_tidaktetap" value="<?php echo HtmlEncode($t_pcp_grid->jml_pegawai_tidaktetap->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->legalitas->Visible) { // legalitas ?>
		<td data-name="legalitas">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_legalitas" class="form-group t_pcp_legalitas">
<div id="tp_x<?php echo $t_pcp_grid->RowIndex ?>_legalitas" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="t_pcp" data-field="x_legalitas" data-value-separator="<?php echo $t_pcp_grid->legalitas->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pcp_grid->RowIndex ?>_legalitas[]" id="x<?php echo $t_pcp_grid->RowIndex ?>_legalitas[]" value="{value}"<?php echo $t_pcp_grid->legalitas->editAttributes() ?>></div>
<div id="dsl_x<?php echo $t_pcp_grid->RowIndex ?>_legalitas" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_pcp_grid->legalitas->checkBoxListHtml(FALSE, "x{$t_pcp_grid->RowIndex}_legalitas[]") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_legalitas" class="form-group t_pcp_legalitas">
<span<?php echo $t_pcp_grid->legalitas->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->legalitas->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_legalitas" name="x<?php echo $t_pcp_grid->RowIndex ?>_legalitas" id="x<?php echo $t_pcp_grid->RowIndex ?>_legalitas" value="<?php echo HtmlEncode($t_pcp_grid->legalitas->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_legalitas" name="o<?php echo $t_pcp_grid->RowIndex ?>_legalitas[]" id="o<?php echo $t_pcp_grid->RowIndex ?>_legalitas[]" value="<?php echo HtmlEncode($t_pcp_grid->legalitas->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->legalitas_lain->Visible) { // legalitas_lain ?>
		<td data-name="legalitas_lain">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_legalitas_lain" class="form-group t_pcp_legalitas_lain">
<input type="text" data-table="t_pcp" data-field="x_legalitas_lain" name="x<?php echo $t_pcp_grid->RowIndex ?>_legalitas_lain" id="x<?php echo $t_pcp_grid->RowIndex ?>_legalitas_lain" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pcp_grid->legalitas_lain->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->legalitas_lain->EditValue ?>"<?php echo $t_pcp_grid->legalitas_lain->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_legalitas_lain" class="form-group t_pcp_legalitas_lain">
<span<?php echo $t_pcp_grid->legalitas_lain->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->legalitas_lain->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_legalitas_lain" name="x<?php echo $t_pcp_grid->RowIndex ?>_legalitas_lain" id="x<?php echo $t_pcp_grid->RowIndex ?>_legalitas_lain" value="<?php echo HtmlEncode($t_pcp_grid->legalitas_lain->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_legalitas_lain" name="o<?php echo $t_pcp_grid->RowIndex ?>_legalitas_lain" id="o<?php echo $t_pcp_grid->RowIndex ?>_legalitas_lain" value="<?php echo HtmlEncode($t_pcp_grid->legalitas_lain->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->sertifikat->Visible) { // sertifikat ?>
		<td data-name="sertifikat">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_sertifikat" class="form-group t_pcp_sertifikat">
<div id="tp_x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="t_pcp" data-field="x_sertifikat" data-value-separator="<?php echo $t_pcp_grid->sertifikat->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat[]" id="x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat[]" value="{value}"<?php echo $t_pcp_grid->sertifikat->editAttributes() ?>></div>
<div id="dsl_x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_pcp_grid->sertifikat->checkBoxListHtml(FALSE, "x{$t_pcp_grid->RowIndex}_sertifikat[]") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_sertifikat" class="form-group t_pcp_sertifikat">
<span<?php echo $t_pcp_grid->sertifikat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->sertifikat->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_sertifikat" name="x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat" id="x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($t_pcp_grid->sertifikat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_sertifikat" name="o<?php echo $t_pcp_grid->RowIndex ?>_sertifikat[]" id="o<?php echo $t_pcp_grid->RowIndex ?>_sertifikat[]" value="<?php echo HtmlEncode($t_pcp_grid->sertifikat->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->sertifikat_lain->Visible) { // sertifikat_lain ?>
		<td data-name="sertifikat_lain">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_sertifikat_lain" class="form-group t_pcp_sertifikat_lain">
<input type="text" data-table="t_pcp" data-field="x_sertifikat_lain" name="x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat_lain" id="x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat_lain" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pcp_grid->sertifikat_lain->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->sertifikat_lain->EditValue ?>"<?php echo $t_pcp_grid->sertifikat_lain->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_sertifikat_lain" class="form-group t_pcp_sertifikat_lain">
<span<?php echo $t_pcp_grid->sertifikat_lain->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->sertifikat_lain->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_sertifikat_lain" name="x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat_lain" id="x<?php echo $t_pcp_grid->RowIndex ?>_sertifikat_lain" value="<?php echo HtmlEncode($t_pcp_grid->sertifikat_lain->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_sertifikat_lain" name="o<?php echo $t_pcp_grid->RowIndex ?>_sertifikat_lain" id="o<?php echo $t_pcp_grid->RowIndex ?>_sertifikat_lain" value="<?php echo HtmlEncode($t_pcp_grid->sertifikat_lain->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->alat_promosi->Visible) { // alat_promosi ?>
		<td data-name="alat_promosi">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_alat_promosi" class="form-group t_pcp_alat_promosi">
<div id="tp_x<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="t_pcp" data-field="x_alat_promosi" data-value-separator="<?php echo $t_pcp_grid->alat_promosi->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi[]" id="x<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi[]" value="{value}"<?php echo $t_pcp_grid->alat_promosi->editAttributes() ?>></div>
<div id="dsl_x<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_pcp_grid->alat_promosi->checkBoxListHtml(FALSE, "x{$t_pcp_grid->RowIndex}_alat_promosi[]") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_alat_promosi" class="form-group t_pcp_alat_promosi">
<span<?php echo $t_pcp_grid->alat_promosi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->alat_promosi->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_alat_promosi" name="x<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi" id="x<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi" value="<?php echo HtmlEncode($t_pcp_grid->alat_promosi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_alat_promosi" name="o<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi[]" id="o<?php echo $t_pcp_grid->RowIndex ?>_alat_promosi[]" value="<?php echo HtmlEncode($t_pcp_grid->alat_promosi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->promosi_lain->Visible) { // promosi_lain ?>
		<td data-name="promosi_lain">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_promosi_lain" class="form-group t_pcp_promosi_lain">
<input type="text" data-table="t_pcp" data-field="x_promosi_lain" name="x<?php echo $t_pcp_grid->RowIndex ?>_promosi_lain" id="x<?php echo $t_pcp_grid->RowIndex ?>_promosi_lain" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pcp_grid->promosi_lain->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->promosi_lain->EditValue ?>"<?php echo $t_pcp_grid->promosi_lain->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_promosi_lain" class="form-group t_pcp_promosi_lain">
<span<?php echo $t_pcp_grid->promosi_lain->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->promosi_lain->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_promosi_lain" name="x<?php echo $t_pcp_grid->RowIndex ?>_promosi_lain" id="x<?php echo $t_pcp_grid->RowIndex ?>_promosi_lain" value="<?php echo HtmlEncode($t_pcp_grid->promosi_lain->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_promosi_lain" name="o<?php echo $t_pcp_grid->RowIndex ?>_promosi_lain" id="o<?php echo $t_pcp_grid->RowIndex ?>_promosi_lain" value="<?php echo HtmlEncode($t_pcp_grid->promosi_lain->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->tahun_ecp->Visible) { // tahun_ecp ?>
		<td data-name="tahun_ecp">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_tahun_ecp" class="form-group t_pcp_tahun_ecp">
<input type="text" data-table="t_pcp" data-field="x_tahun_ecp" name="x<?php echo $t_pcp_grid->RowIndex ?>_tahun_ecp" id="x<?php echo $t_pcp_grid->RowIndex ?>_tahun_ecp" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pcp_grid->tahun_ecp->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->tahun_ecp->EditValue ?>"<?php echo $t_pcp_grid->tahun_ecp->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_tahun_ecp" class="form-group t_pcp_tahun_ecp">
<span<?php echo $t_pcp_grid->tahun_ecp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->tahun_ecp->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_tahun_ecp" name="x<?php echo $t_pcp_grid->RowIndex ?>_tahun_ecp" id="x<?php echo $t_pcp_grid->RowIndex ?>_tahun_ecp" value="<?php echo HtmlEncode($t_pcp_grid->tahun_ecp->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_tahun_ecp" name="o<?php echo $t_pcp_grid->RowIndex ?>_tahun_ecp" id="o<?php echo $t_pcp_grid->RowIndex ?>_tahun_ecp" value="<?php echo HtmlEncode($t_pcp_grid->tahun_ecp->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pcp_grid->wilayah_ecp->Visible) { // wilayah_ecp ?>
		<td data-name="wilayah_ecp">
<?php if (!$t_pcp->isConfirm()) { ?>
<span id="el$rowindex$_t_pcp_wilayah_ecp" class="form-group t_pcp_wilayah_ecp">
<input type="text" data-table="t_pcp" data-field="x_wilayah_ecp" name="x<?php echo $t_pcp_grid->RowIndex ?>_wilayah_ecp" id="x<?php echo $t_pcp_grid->RowIndex ?>_wilayah_ecp" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_grid->wilayah_ecp->getPlaceHolder()) ?>" value="<?php echo $t_pcp_grid->wilayah_ecp->EditValue ?>"<?php echo $t_pcp_grid->wilayah_ecp->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pcp_wilayah_ecp" class="form-group t_pcp_wilayah_ecp">
<span<?php echo $t_pcp_grid->wilayah_ecp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pcp_grid->wilayah_ecp->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_wilayah_ecp" name="x<?php echo $t_pcp_grid->RowIndex ?>_wilayah_ecp" id="x<?php echo $t_pcp_grid->RowIndex ?>_wilayah_ecp" value="<?php echo HtmlEncode($t_pcp_grid->wilayah_ecp->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pcp" data-field="x_wilayah_ecp" name="o<?php echo $t_pcp_grid->RowIndex ?>_wilayah_ecp" id="o<?php echo $t_pcp_grid->RowIndex ?>_wilayah_ecp" value="<?php echo HtmlEncode($t_pcp_grid->wilayah_ecp->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_pcp_grid->ListOptions->render("body", "right", $t_pcp_grid->RowIndex);
?>
<script>
loadjs.ready(["ft_pcpgrid", "load"], function() {
	ft_pcpgrid.updateLists(<?php echo $t_pcp_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($t_pcp->CurrentMode == "add" || $t_pcp->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $t_pcp_grid->FormKeyCountName ?>" id="<?php echo $t_pcp_grid->FormKeyCountName ?>" value="<?php echo $t_pcp_grid->KeyCount ?>">
<?php echo $t_pcp_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_pcp->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $t_pcp_grid->FormKeyCountName ?>" id="<?php echo $t_pcp_grid->FormKeyCountName ?>" value="<?php echo $t_pcp_grid->KeyCount ?>">
<?php echo $t_pcp_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_pcp->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_pcpgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_pcp_grid->Recordset)
	$t_pcp_grid->Recordset->Close();
?>
<?php if ($t_pcp_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $t_pcp_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_pcp_grid->TotalRecords == 0 && !$t_pcp->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_pcp_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$t_pcp_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$(".ew-list-other-options").html('<span class="ew-detail-option ew-list-option-separator text-nowrap" data-name="button"><div class="btn-group btn-group-sm ew-btn-group"><a class="btn ew-detail-add-group ew-detail-add btn-info" title="" data-caption="Tambah Daftar Peserta Coaching Program/Data Ekspor" href="t_pcpadd.php?showdetail=t_ecp&showmaster=excp&fk_rkid=<?php echo Page("excp")->rkid->CurrentValue; ?>" data-original-title="Tambah Daftar Peserta Coaching Program/Data Ekspor"><i data-phrase="AddLink" class="fas fa-plus ew-icon" data-caption="Tambah"></i> Tambah Data</a></div></span>');
});
</script>
<?php if (!$t_pcp->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_t_pcp",
		width: "100%",
		height: "350px"
	});
});
</script>
<?php } ?>
<?php } ?>
<?php
$t_pcp_grid->terminate();
?>