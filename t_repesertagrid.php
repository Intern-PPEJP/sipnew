<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($t_repeserta_grid))
	$t_repeserta_grid = new t_repeserta_grid();

// Run the page
$t_repeserta_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_repeserta_grid->Page_Render();
?>
<?php if (!$t_repeserta_grid->isExport()) { ?>
<script>
var ft_repesertagrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	ft_repesertagrid = new ew.Form("ft_repesertagrid", "grid");
	ft_repesertagrid.formKeyCountName = '<?php echo $t_repeserta_grid->FormKeyCountName ?>';

	// Validate form
	ft_repesertagrid.validate = function() {
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
			<?php if ($t_repeserta_grid->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_grid->nama->caption(), $t_repeserta_grid->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_grid->perusahaan->Required) { ?>
				elm = this.getElements("x" + infix + "_perusahaan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_grid->perusahaan->caption(), $t_repeserta_grid->perusahaan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_grid->jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_grid->jabatan->caption(), $t_repeserta_grid->jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_grid->tgl_daftar->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_daftar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_grid->tgl_daftar->caption(), $t_repeserta_grid->tgl_daftar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_daftar");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_repeserta_grid->tgl_daftar->errorMessage()) ?>");
			<?php if ($t_repeserta_grid->telp->Required) { ?>
				elm = this.getElements("x" + infix + "_telp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_grid->telp->caption(), $t_repeserta_grid->telp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_grid->fax->Required) { ?>
				elm = this.getElements("x" + infix + "_fax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_grid->fax->caption(), $t_repeserta_grid->fax->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_grid->hp->Required) { ?>
				elm = this.getElements("x" + infix + "_hp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_grid->hp->caption(), $t_repeserta_grid->hp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_grid->produk->Required) { ?>
				elm = this.getElements("x" + infix + "_produk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_grid->produk->caption(), $t_repeserta_grid->produk->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_grid->cara_bayar->Required) { ?>
				elm = this.getElements("x" + infix + "_cara_bayar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_grid->cara_bayar->caption(), $t_repeserta_grid->cara_bayar->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_grid->ket_bayar->Required) { ?>
				elm = this.getElements("x" + infix + "_ket_bayar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_grid->ket_bayar->caption(), $t_repeserta_grid->ket_bayar->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_grid->tgl_bayar->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_bayar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_grid->tgl_bayar->caption(), $t_repeserta_grid->tgl_bayar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_bayar");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_repeserta_grid->tgl_bayar->errorMessage()) ?>");
			<?php if ($t_repeserta_grid->kdinformasi->Required) { ?>
				elm = this.getElements("x" + infix + "_kdinformasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_grid->kdinformasi->caption(), $t_repeserta_grid->kdinformasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_grid->konfirmasi->Required) { ?>
				elm = this.getElements("x" + infix + "_konfirmasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_grid->konfirmasi->caption(), $t_repeserta_grid->konfirmasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_grid->ket->Required) { ?>
				elm = this.getElements("x" + infix + "_ket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_grid->ket->caption(), $t_repeserta_grid->ket->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_grid->ket_lainnya->Required) { ?>
				elm = this.getElements("x" + infix + "_ket_lainnya");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_grid->ket_lainnya->caption(), $t_repeserta_grid->ket_lainnya->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	ft_repesertagrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "nama", false)) return false;
		if (ew.valueChanged(fobj, infix, "perusahaan", false)) return false;
		if (ew.valueChanged(fobj, infix, "jabatan", false)) return false;
		if (ew.valueChanged(fobj, infix, "tgl_daftar", false)) return false;
		if (ew.valueChanged(fobj, infix, "telp", false)) return false;
		if (ew.valueChanged(fobj, infix, "fax", false)) return false;
		if (ew.valueChanged(fobj, infix, "hp", false)) return false;
		if (ew.valueChanged(fobj, infix, "produk", false)) return false;
		if (ew.valueChanged(fobj, infix, "cara_bayar", false)) return false;
		if (ew.valueChanged(fobj, infix, "ket_bayar", false)) return false;
		if (ew.valueChanged(fobj, infix, "tgl_bayar", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdinformasi", false)) return false;
		if (ew.valueChanged(fobj, infix, "konfirmasi", false)) return false;
		if (ew.valueChanged(fobj, infix, "ket", false)) return false;
		if (ew.valueChanged(fobj, infix, "ket_lainnya", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_repesertagrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_repesertagrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_repesertagrid.lists["x_jabatan"] = <?php echo $t_repeserta_grid->jabatan->Lookup->toClientList($t_repeserta_grid) ?>;
	ft_repesertagrid.lists["x_jabatan"].options = <?php echo JsonEncode($t_repeserta_grid->jabatan->lookupOptions()) ?>;
	ft_repesertagrid.autoSuggests["x_jabatan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_repesertagrid.lists["x_cara_bayar"] = <?php echo $t_repeserta_grid->cara_bayar->Lookup->toClientList($t_repeserta_grid) ?>;
	ft_repesertagrid.lists["x_cara_bayar"].options = <?php echo JsonEncode($t_repeserta_grid->cara_bayar->options(FALSE, TRUE)) ?>;
	ft_repesertagrid.lists["x_kdinformasi"] = <?php echo $t_repeserta_grid->kdinformasi->Lookup->toClientList($t_repeserta_grid) ?>;
	ft_repesertagrid.lists["x_kdinformasi"].options = <?php echo JsonEncode($t_repeserta_grid->kdinformasi->lookupOptions()) ?>;
	ft_repesertagrid.lists["x_konfirmasi"] = <?php echo $t_repeserta_grid->konfirmasi->Lookup->toClientList($t_repeserta_grid) ?>;
	ft_repesertagrid.lists["x_konfirmasi"].options = <?php echo JsonEncode($t_repeserta_grid->konfirmasi->options(FALSE, TRUE)) ?>;
	ft_repesertagrid.lists["x_ket"] = <?php echo $t_repeserta_grid->ket->Lookup->toClientList($t_repeserta_grid) ?>;
	ft_repesertagrid.lists["x_ket"].options = <?php echo JsonEncode($t_repeserta_grid->ket->options(FALSE, TRUE)) ?>;
	loadjs.done("ft_repesertagrid");
});
</script>
<script>
ew.ready("head", "js/ewfixedheadertable.js", "fixedheadertable");
</script>
<?php } ?>
<?php
$t_repeserta_grid->renderOtherOptions();
?>
<?php if ($t_repeserta_grid->TotalRecords > 0 || $t_repeserta->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_repeserta_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_repeserta">
<?php if ($t_repeserta_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $t_repeserta_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ft_repesertagrid" class="ew-form ew-list-form form-inline">
<div id="gmp_t_repeserta" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_t_repesertagrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_repeserta->RowType = ROWTYPE_HEADER;

// Render list options
$t_repeserta_grid->renderListOptions();

// Render list options (header, left)
$t_repeserta_grid->ListOptions->render("header", "left");
?>
<?php if ($t_repeserta_grid->nama->Visible) { // nama ?>
	<?php if ($t_repeserta_grid->SortUrl($t_repeserta_grid->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $t_repeserta_grid->nama->headerCellClass() ?>"><div id="elh_t_repeserta_nama" class="t_repeserta_nama"><div class="ew-table-header-caption"><?php echo $t_repeserta_grid->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $t_repeserta_grid->nama->headerCellClass() ?>"><div><div id="elh_t_repeserta_nama" class="t_repeserta_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_grid->nama->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_grid->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_grid->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_grid->perusahaan->Visible) { // perusahaan ?>
	<?php if ($t_repeserta_grid->SortUrl($t_repeserta_grid->perusahaan) == "") { ?>
		<th data-name="perusahaan" class="<?php echo $t_repeserta_grid->perusahaan->headerCellClass() ?>"><div id="elh_t_repeserta_perusahaan" class="t_repeserta_perusahaan"><div class="ew-table-header-caption"><?php echo $t_repeserta_grid->perusahaan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="perusahaan" class="<?php echo $t_repeserta_grid->perusahaan->headerCellClass() ?>"><div><div id="elh_t_repeserta_perusahaan" class="t_repeserta_perusahaan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_grid->perusahaan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_grid->perusahaan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_grid->perusahaan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_grid->jabatan->Visible) { // jabatan ?>
	<?php if ($t_repeserta_grid->SortUrl($t_repeserta_grid->jabatan) == "") { ?>
		<th data-name="jabatan" class="<?php echo $t_repeserta_grid->jabatan->headerCellClass() ?>"><div id="elh_t_repeserta_jabatan" class="t_repeserta_jabatan"><div class="ew-table-header-caption"><?php echo $t_repeserta_grid->jabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan" class="<?php echo $t_repeserta_grid->jabatan->headerCellClass() ?>"><div><div id="elh_t_repeserta_jabatan" class="t_repeserta_jabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_grid->jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_grid->jabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_grid->jabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_grid->tgl_daftar->Visible) { // tgl_daftar ?>
	<?php if ($t_repeserta_grid->SortUrl($t_repeserta_grid->tgl_daftar) == "") { ?>
		<th data-name="tgl_daftar" class="<?php echo $t_repeserta_grid->tgl_daftar->headerCellClass() ?>"><div id="elh_t_repeserta_tgl_daftar" class="t_repeserta_tgl_daftar"><div class="ew-table-header-caption"><?php echo $t_repeserta_grid->tgl_daftar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_daftar" class="<?php echo $t_repeserta_grid->tgl_daftar->headerCellClass() ?>"><div><div id="elh_t_repeserta_tgl_daftar" class="t_repeserta_tgl_daftar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_grid->tgl_daftar->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_grid->tgl_daftar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_grid->tgl_daftar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_grid->telp->Visible) { // telp ?>
	<?php if ($t_repeserta_grid->SortUrl($t_repeserta_grid->telp) == "") { ?>
		<th data-name="telp" class="<?php echo $t_repeserta_grid->telp->headerCellClass() ?>"><div id="elh_t_repeserta_telp" class="t_repeserta_telp"><div class="ew-table-header-caption"><?php echo $t_repeserta_grid->telp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telp" class="<?php echo $t_repeserta_grid->telp->headerCellClass() ?>"><div><div id="elh_t_repeserta_telp" class="t_repeserta_telp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_grid->telp->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_grid->telp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_grid->telp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_grid->fax->Visible) { // fax ?>
	<?php if ($t_repeserta_grid->SortUrl($t_repeserta_grid->fax) == "") { ?>
		<th data-name="fax" class="<?php echo $t_repeserta_grid->fax->headerCellClass() ?>"><div id="elh_t_repeserta_fax" class="t_repeserta_fax"><div class="ew-table-header-caption"><?php echo $t_repeserta_grid->fax->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fax" class="<?php echo $t_repeserta_grid->fax->headerCellClass() ?>"><div><div id="elh_t_repeserta_fax" class="t_repeserta_fax">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_grid->fax->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_grid->fax->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_grid->fax->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_grid->hp->Visible) { // hp ?>
	<?php if ($t_repeserta_grid->SortUrl($t_repeserta_grid->hp) == "") { ?>
		<th data-name="hp" class="<?php echo $t_repeserta_grid->hp->headerCellClass() ?>"><div id="elh_t_repeserta_hp" class="t_repeserta_hp"><div class="ew-table-header-caption"><?php echo $t_repeserta_grid->hp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hp" class="<?php echo $t_repeserta_grid->hp->headerCellClass() ?>"><div><div id="elh_t_repeserta_hp" class="t_repeserta_hp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_grid->hp->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_grid->hp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_grid->hp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_grid->produk->Visible) { // produk ?>
	<?php if ($t_repeserta_grid->SortUrl($t_repeserta_grid->produk) == "") { ?>
		<th data-name="produk" class="<?php echo $t_repeserta_grid->produk->headerCellClass() ?>"><div id="elh_t_repeserta_produk" class="t_repeserta_produk"><div class="ew-table-header-caption"><?php echo $t_repeserta_grid->produk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="produk" class="<?php echo $t_repeserta_grid->produk->headerCellClass() ?>"><div><div id="elh_t_repeserta_produk" class="t_repeserta_produk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_grid->produk->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_grid->produk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_grid->produk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_grid->cara_bayar->Visible) { // cara_bayar ?>
	<?php if ($t_repeserta_grid->SortUrl($t_repeserta_grid->cara_bayar) == "") { ?>
		<th data-name="cara_bayar" class="<?php echo $t_repeserta_grid->cara_bayar->headerCellClass() ?>"><div id="elh_t_repeserta_cara_bayar" class="t_repeserta_cara_bayar"><div class="ew-table-header-caption"><?php echo $t_repeserta_grid->cara_bayar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cara_bayar" class="<?php echo $t_repeserta_grid->cara_bayar->headerCellClass() ?>"><div><div id="elh_t_repeserta_cara_bayar" class="t_repeserta_cara_bayar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_grid->cara_bayar->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_grid->cara_bayar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_grid->cara_bayar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_grid->ket_bayar->Visible) { // ket_bayar ?>
	<?php if ($t_repeserta_grid->SortUrl($t_repeserta_grid->ket_bayar) == "") { ?>
		<th data-name="ket_bayar" class="<?php echo $t_repeserta_grid->ket_bayar->headerCellClass() ?>"><div id="elh_t_repeserta_ket_bayar" class="t_repeserta_ket_bayar"><div class="ew-table-header-caption"><?php echo $t_repeserta_grid->ket_bayar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ket_bayar" class="<?php echo $t_repeserta_grid->ket_bayar->headerCellClass() ?>"><div><div id="elh_t_repeserta_ket_bayar" class="t_repeserta_ket_bayar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_grid->ket_bayar->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_grid->ket_bayar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_grid->ket_bayar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_grid->tgl_bayar->Visible) { // tgl_bayar ?>
	<?php if ($t_repeserta_grid->SortUrl($t_repeserta_grid->tgl_bayar) == "") { ?>
		<th data-name="tgl_bayar" class="<?php echo $t_repeserta_grid->tgl_bayar->headerCellClass() ?>"><div id="elh_t_repeserta_tgl_bayar" class="t_repeserta_tgl_bayar"><div class="ew-table-header-caption"><?php echo $t_repeserta_grid->tgl_bayar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_bayar" class="<?php echo $t_repeserta_grid->tgl_bayar->headerCellClass() ?>"><div><div id="elh_t_repeserta_tgl_bayar" class="t_repeserta_tgl_bayar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_grid->tgl_bayar->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_grid->tgl_bayar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_grid->tgl_bayar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_grid->kdinformasi->Visible) { // kdinformasi ?>
	<?php if ($t_repeserta_grid->SortUrl($t_repeserta_grid->kdinformasi) == "") { ?>
		<th data-name="kdinformasi" class="<?php echo $t_repeserta_grid->kdinformasi->headerCellClass() ?>"><div id="elh_t_repeserta_kdinformasi" class="t_repeserta_kdinformasi"><div class="ew-table-header-caption"><?php echo $t_repeserta_grid->kdinformasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdinformasi" class="<?php echo $t_repeserta_grid->kdinformasi->headerCellClass() ?>"><div><div id="elh_t_repeserta_kdinformasi" class="t_repeserta_kdinformasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_grid->kdinformasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_grid->kdinformasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_grid->kdinformasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_grid->konfirmasi->Visible) { // konfirmasi ?>
	<?php if ($t_repeserta_grid->SortUrl($t_repeserta_grid->konfirmasi) == "") { ?>
		<th data-name="konfirmasi" class="<?php echo $t_repeserta_grid->konfirmasi->headerCellClass() ?>"><div id="elh_t_repeserta_konfirmasi" class="t_repeserta_konfirmasi"><div class="ew-table-header-caption"><?php echo $t_repeserta_grid->konfirmasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="konfirmasi" class="<?php echo $t_repeserta_grid->konfirmasi->headerCellClass() ?>"><div><div id="elh_t_repeserta_konfirmasi" class="t_repeserta_konfirmasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_grid->konfirmasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_grid->konfirmasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_grid->konfirmasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_grid->ket->Visible) { // ket ?>
	<?php if ($t_repeserta_grid->SortUrl($t_repeserta_grid->ket) == "") { ?>
		<th data-name="ket" class="<?php echo $t_repeserta_grid->ket->headerCellClass() ?>"><div id="elh_t_repeserta_ket" class="t_repeserta_ket"><div class="ew-table-header-caption"><?php echo $t_repeserta_grid->ket->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ket" class="<?php echo $t_repeserta_grid->ket->headerCellClass() ?>"><div><div id="elh_t_repeserta_ket" class="t_repeserta_ket">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_grid->ket->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_grid->ket->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_grid->ket->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_grid->ket_lainnya->Visible) { // ket_lainnya ?>
	<?php if ($t_repeserta_grid->SortUrl($t_repeserta_grid->ket_lainnya) == "") { ?>
		<th data-name="ket_lainnya" class="<?php echo $t_repeserta_grid->ket_lainnya->headerCellClass() ?>"><div id="elh_t_repeserta_ket_lainnya" class="t_repeserta_ket_lainnya"><div class="ew-table-header-caption"><?php echo $t_repeserta_grid->ket_lainnya->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ket_lainnya" class="<?php echo $t_repeserta_grid->ket_lainnya->headerCellClass() ?>"><div><div id="elh_t_repeserta_ket_lainnya" class="t_repeserta_ket_lainnya">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_grid->ket_lainnya->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_grid->ket_lainnya->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_grid->ket_lainnya->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_repeserta_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_repeserta_grid->StartRecord = 1;
$t_repeserta_grid->StopRecord = $t_repeserta_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($t_repeserta->isConfirm() || $t_repeserta_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_repeserta_grid->FormKeyCountName) && ($t_repeserta_grid->isGridAdd() || $t_repeserta_grid->isGridEdit() || $t_repeserta->isConfirm())) {
		$t_repeserta_grid->KeyCount = $CurrentForm->getValue($t_repeserta_grid->FormKeyCountName);
		$t_repeserta_grid->StopRecord = $t_repeserta_grid->StartRecord + $t_repeserta_grid->KeyCount - 1;
	}
}
$t_repeserta_grid->RecordCount = $t_repeserta_grid->StartRecord - 1;
if ($t_repeserta_grid->Recordset && !$t_repeserta_grid->Recordset->EOF) {
	$t_repeserta_grid->Recordset->moveFirst();
	$selectLimit = $t_repeserta_grid->UseSelectLimit;
	if (!$selectLimit && $t_repeserta_grid->StartRecord > 1)
		$t_repeserta_grid->Recordset->move($t_repeserta_grid->StartRecord - 1);
} elseif (!$t_repeserta->AllowAddDeleteRow && $t_repeserta_grid->StopRecord == 0) {
	$t_repeserta_grid->StopRecord = $t_repeserta->GridAddRowCount;
}

// Initialize aggregate
$t_repeserta->RowType = ROWTYPE_AGGREGATEINIT;
$t_repeserta->resetAttributes();
$t_repeserta_grid->renderRow();
if ($t_repeserta_grid->isGridAdd())
	$t_repeserta_grid->RowIndex = 0;
if ($t_repeserta_grid->isGridEdit())
	$t_repeserta_grid->RowIndex = 0;
while ($t_repeserta_grid->RecordCount < $t_repeserta_grid->StopRecord) {
	$t_repeserta_grid->RecordCount++;
	if ($t_repeserta_grid->RecordCount >= $t_repeserta_grid->StartRecord) {
		$t_repeserta_grid->RowCount++;
		if ($t_repeserta_grid->isGridAdd() || $t_repeserta_grid->isGridEdit() || $t_repeserta->isConfirm()) {
			$t_repeserta_grid->RowIndex++;
			$CurrentForm->Index = $t_repeserta_grid->RowIndex;
			if ($CurrentForm->hasValue($t_repeserta_grid->FormActionName) && ($t_repeserta->isConfirm() || $t_repeserta_grid->EventCancelled))
				$t_repeserta_grid->RowAction = strval($CurrentForm->getValue($t_repeserta_grid->FormActionName));
			elseif ($t_repeserta_grid->isGridAdd())
				$t_repeserta_grid->RowAction = "insert";
			else
				$t_repeserta_grid->RowAction = "";
		}

		// Set up key count
		$t_repeserta_grid->KeyCount = $t_repeserta_grid->RowIndex;

		// Init row class and style
		$t_repeserta->resetAttributes();
		$t_repeserta->CssClass = "";
		if ($t_repeserta_grid->isGridAdd()) {
			if ($t_repeserta->CurrentMode == "copy") {
				$t_repeserta_grid->loadRowValues($t_repeserta_grid->Recordset); // Load row values
				$t_repeserta_grid->setRecordKey($t_repeserta_grid->RowOldKey, $t_repeserta_grid->Recordset); // Set old record key
			} else {
				$t_repeserta_grid->loadRowValues(); // Load default values
				$t_repeserta_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_repeserta_grid->loadRowValues($t_repeserta_grid->Recordset); // Load row values
		}
		$t_repeserta->RowType = ROWTYPE_VIEW; // Render view
		if ($t_repeserta_grid->isGridAdd()) // Grid add
			$t_repeserta->RowType = ROWTYPE_ADD; // Render add
		if ($t_repeserta_grid->isGridAdd() && $t_repeserta->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_repeserta_grid->restoreCurrentRowFormValues($t_repeserta_grid->RowIndex); // Restore form values
		if ($t_repeserta_grid->isGridEdit()) { // Grid edit
			if ($t_repeserta->EventCancelled)
				$t_repeserta_grid->restoreCurrentRowFormValues($t_repeserta_grid->RowIndex); // Restore form values
			if ($t_repeserta_grid->RowAction == "insert")
				$t_repeserta->RowType = ROWTYPE_ADD; // Render add
			else
				$t_repeserta->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_repeserta_grid->isGridEdit() && ($t_repeserta->RowType == ROWTYPE_EDIT || $t_repeserta->RowType == ROWTYPE_ADD) && $t_repeserta->EventCancelled) // Update failed
			$t_repeserta_grid->restoreCurrentRowFormValues($t_repeserta_grid->RowIndex); // Restore form values
		if ($t_repeserta->RowType == ROWTYPE_EDIT) // Edit row
			$t_repeserta_grid->EditRowCount++;
		if ($t_repeserta->isConfirm()) // Confirm row
			$t_repeserta_grid->restoreCurrentRowFormValues($t_repeserta_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_repeserta->RowAttrs->merge(["data-rowindex" => $t_repeserta_grid->RowCount, "id" => "r" . $t_repeserta_grid->RowCount . "_t_repeserta", "data-rowtype" => $t_repeserta->RowType]);

		// Render row
		$t_repeserta_grid->renderRow();

		// Render list options
		$t_repeserta_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_repeserta_grid->RowAction != "delete" && $t_repeserta_grid->RowAction != "insertdelete" && !($t_repeserta_grid->RowAction == "insert" && $t_repeserta->isConfirm() && $t_repeserta_grid->emptyRow())) {
?>
	<tr <?php echo $t_repeserta->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_repeserta_grid->ListOptions->render("body", "left", $t_repeserta_grid->RowCount);
?>
	<?php if ($t_repeserta_grid->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $t_repeserta_grid->nama->cellAttributes() ?>>
<?php if ($t_repeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_nama" class="form-group">
<input type="text" data-table="t_repeserta" data-field="x_nama" name="x<?php echo $t_repeserta_grid->RowIndex ?>_nama" id="x<?php echo $t_repeserta_grid->RowIndex ?>_nama" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_grid->nama->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->nama->EditValue ?>"<?php echo $t_repeserta_grid->nama->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_nama" name="o<?php echo $t_repeserta_grid->RowIndex ?>_nama" id="o<?php echo $t_repeserta_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($t_repeserta_grid->nama->OldValue) ?>">
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_nama" class="form-group">
<input type="text" data-table="t_repeserta" data-field="x_nama" name="x<?php echo $t_repeserta_grid->RowIndex ?>_nama" id="x<?php echo $t_repeserta_grid->RowIndex ?>_nama" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_grid->nama->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->nama->EditValue ?>"<?php echo $t_repeserta_grid->nama->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_nama">
<span<?php echo $t_repeserta_grid->nama->viewAttributes() ?>><?php echo $t_repeserta_grid->nama->getViewValue() ?></span>
</span>
<?php if (!$t_repeserta->isConfirm()) { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_nama" name="x<?php echo $t_repeserta_grid->RowIndex ?>_nama" id="x<?php echo $t_repeserta_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($t_repeserta_grid->nama->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_nama" name="o<?php echo $t_repeserta_grid->RowIndex ?>_nama" id="o<?php echo $t_repeserta_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($t_repeserta_grid->nama->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_nama" name="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_nama" id="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($t_repeserta_grid->nama->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_nama" name="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_nama" id="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($t_repeserta_grid->nama->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t_repeserta" data-field="x_id" name="x<?php echo $t_repeserta_grid->RowIndex ?>_id" id="x<?php echo $t_repeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_repeserta_grid->id->CurrentValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_id" name="o<?php echo $t_repeserta_grid->RowIndex ?>_id" id="o<?php echo $t_repeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_repeserta_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_EDIT || $t_repeserta->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_id" name="x<?php echo $t_repeserta_grid->RowIndex ?>_id" id="x<?php echo $t_repeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_repeserta_grid->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t_repeserta_grid->perusahaan->Visible) { // perusahaan ?>
		<td data-name="perusahaan" <?php echo $t_repeserta_grid->perusahaan->cellAttributes() ?>>
<?php if ($t_repeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_perusahaan" class="form-group">
<input type="text" data-table="t_repeserta" data-field="x_perusahaan" name="x<?php echo $t_repeserta_grid->RowIndex ?>_perusahaan" id="x<?php echo $t_repeserta_grid->RowIndex ?>_perusahaan" size="55" maxlength="255" placeholder="<?php echo HtmlEncode($t_repeserta_grid->perusahaan->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->perusahaan->EditValue ?>"<?php echo $t_repeserta_grid->perusahaan->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_perusahaan" name="o<?php echo $t_repeserta_grid->RowIndex ?>_perusahaan" id="o<?php echo $t_repeserta_grid->RowIndex ?>_perusahaan" value="<?php echo HtmlEncode($t_repeserta_grid->perusahaan->OldValue) ?>">
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_perusahaan" class="form-group">
<input type="text" data-table="t_repeserta" data-field="x_perusahaan" name="x<?php echo $t_repeserta_grid->RowIndex ?>_perusahaan" id="x<?php echo $t_repeserta_grid->RowIndex ?>_perusahaan" size="55" maxlength="255" placeholder="<?php echo HtmlEncode($t_repeserta_grid->perusahaan->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->perusahaan->EditValue ?>"<?php echo $t_repeserta_grid->perusahaan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_perusahaan">
<span<?php echo $t_repeserta_grid->perusahaan->viewAttributes() ?>><?php echo $t_repeserta_grid->perusahaan->getViewValue() ?></span>
</span>
<?php if (!$t_repeserta->isConfirm()) { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_perusahaan" name="x<?php echo $t_repeserta_grid->RowIndex ?>_perusahaan" id="x<?php echo $t_repeserta_grid->RowIndex ?>_perusahaan" value="<?php echo HtmlEncode($t_repeserta_grid->perusahaan->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_perusahaan" name="o<?php echo $t_repeserta_grid->RowIndex ?>_perusahaan" id="o<?php echo $t_repeserta_grid->RowIndex ?>_perusahaan" value="<?php echo HtmlEncode($t_repeserta_grid->perusahaan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_perusahaan" name="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_perusahaan" id="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_perusahaan" value="<?php echo HtmlEncode($t_repeserta_grid->perusahaan->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_perusahaan" name="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_perusahaan" id="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_perusahaan" value="<?php echo HtmlEncode($t_repeserta_grid->perusahaan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->jabatan->Visible) { // jabatan ?>
		<td data-name="jabatan" <?php echo $t_repeserta_grid->jabatan->cellAttributes() ?>>
<?php if ($t_repeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_jabatan" class="form-group">
<?php
$onchange = $t_repeserta_grid->jabatan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_repeserta_grid->jabatan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan">
	<input type="text" class="form-control" name="sv_x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" id="sv_x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" value="<?php echo RemoveHtml($t_repeserta_grid->jabatan->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_grid->jabatan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_repeserta_grid->jabatan->getPlaceHolder()) ?>"<?php echo $t_repeserta_grid->jabatan->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_jabatan" data-value-separator="<?php echo $t_repeserta_grid->jabatan->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" id="x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" value="<?php echo HtmlEncode($t_repeserta_grid->jabatan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_repesertagrid"], function() {
	ft_repesertagrid.createAutoSuggest({"id":"x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan","forceSelect":true});
});
</script>
<?php echo $t_repeserta_grid->jabatan->Lookup->getParamTag($t_repeserta_grid, "p_x" . $t_repeserta_grid->RowIndex . "_jabatan") ?>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_jabatan" name="o<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" id="o<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" value="<?php echo HtmlEncode($t_repeserta_grid->jabatan->OldValue) ?>">
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_jabatan" class="form-group">
<?php
$onchange = $t_repeserta_grid->jabatan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_repeserta_grid->jabatan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan">
	<input type="text" class="form-control" name="sv_x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" id="sv_x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" value="<?php echo RemoveHtml($t_repeserta_grid->jabatan->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_grid->jabatan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_repeserta_grid->jabatan->getPlaceHolder()) ?>"<?php echo $t_repeserta_grid->jabatan->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_jabatan" data-value-separator="<?php echo $t_repeserta_grid->jabatan->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" id="x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" value="<?php echo HtmlEncode($t_repeserta_grid->jabatan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_repesertagrid"], function() {
	ft_repesertagrid.createAutoSuggest({"id":"x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan","forceSelect":true});
});
</script>
<?php echo $t_repeserta_grid->jabatan->Lookup->getParamTag($t_repeserta_grid, "p_x" . $t_repeserta_grid->RowIndex . "_jabatan") ?>
</span>
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_jabatan">
<span<?php echo $t_repeserta_grid->jabatan->viewAttributes() ?>><?php echo $t_repeserta_grid->jabatan->getViewValue() ?></span>
</span>
<?php if (!$t_repeserta->isConfirm()) { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_jabatan" name="x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" id="x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" value="<?php echo HtmlEncode($t_repeserta_grid->jabatan->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_jabatan" name="o<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" id="o<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" value="<?php echo HtmlEncode($t_repeserta_grid->jabatan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_jabatan" name="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" id="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" value="<?php echo HtmlEncode($t_repeserta_grid->jabatan->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_jabatan" name="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" id="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" value="<?php echo HtmlEncode($t_repeserta_grid->jabatan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->tgl_daftar->Visible) { // tgl_daftar ?>
		<td data-name="tgl_daftar" <?php echo $t_repeserta_grid->tgl_daftar->cellAttributes() ?>>
<?php if ($t_repeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_tgl_daftar" class="form-group">
<input type="text" data-table="t_repeserta" data-field="x_tgl_daftar" name="x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar" id="x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar" size="10" maxlength="19" placeholder="<?php echo HtmlEncode($t_repeserta_grid->tgl_daftar->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->tgl_daftar->EditValue ?>"<?php echo $t_repeserta_grid->tgl_daftar->editAttributes() ?>>
<?php if (!$t_repeserta_grid->tgl_daftar->ReadOnly && !$t_repeserta_grid->tgl_daftar->Disabled && !isset($t_repeserta_grid->tgl_daftar->EditAttrs["readonly"]) && !isset($t_repeserta_grid->tgl_daftar->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_repesertagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_repesertagrid", "x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_tgl_daftar" name="o<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar" id="o<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar" value="<?php echo HtmlEncode($t_repeserta_grid->tgl_daftar->OldValue) ?>">
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_tgl_daftar" class="form-group">
<input type="text" data-table="t_repeserta" data-field="x_tgl_daftar" name="x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar" id="x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar" size="10" maxlength="19" placeholder="<?php echo HtmlEncode($t_repeserta_grid->tgl_daftar->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->tgl_daftar->EditValue ?>"<?php echo $t_repeserta_grid->tgl_daftar->editAttributes() ?>>
<?php if (!$t_repeserta_grid->tgl_daftar->ReadOnly && !$t_repeserta_grid->tgl_daftar->Disabled && !isset($t_repeserta_grid->tgl_daftar->EditAttrs["readonly"]) && !isset($t_repeserta_grid->tgl_daftar->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_repesertagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_repesertagrid", "x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_tgl_daftar">
<span<?php echo $t_repeserta_grid->tgl_daftar->viewAttributes() ?>><?php echo $t_repeserta_grid->tgl_daftar->getViewValue() ?></span>
</span>
<?php if (!$t_repeserta->isConfirm()) { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_tgl_daftar" name="x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar" id="x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar" value="<?php echo HtmlEncode($t_repeserta_grid->tgl_daftar->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_tgl_daftar" name="o<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar" id="o<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar" value="<?php echo HtmlEncode($t_repeserta_grid->tgl_daftar->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_tgl_daftar" name="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar" id="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar" value="<?php echo HtmlEncode($t_repeserta_grid->tgl_daftar->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_tgl_daftar" name="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar" id="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar" value="<?php echo HtmlEncode($t_repeserta_grid->tgl_daftar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->telp->Visible) { // telp ?>
		<td data-name="telp" <?php echo $t_repeserta_grid->telp->cellAttributes() ?>>
<?php if ($t_repeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_telp" class="form-group">
<input type="text" data-table="t_repeserta" data-field="x_telp" name="x<?php echo $t_repeserta_grid->RowIndex ?>_telp" id="x<?php echo $t_repeserta_grid->RowIndex ?>_telp" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_grid->telp->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->telp->EditValue ?>"<?php echo $t_repeserta_grid->telp->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_telp" name="o<?php echo $t_repeserta_grid->RowIndex ?>_telp" id="o<?php echo $t_repeserta_grid->RowIndex ?>_telp" value="<?php echo HtmlEncode($t_repeserta_grid->telp->OldValue) ?>">
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_telp" class="form-group">
<input type="text" data-table="t_repeserta" data-field="x_telp" name="x<?php echo $t_repeserta_grid->RowIndex ?>_telp" id="x<?php echo $t_repeserta_grid->RowIndex ?>_telp" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_grid->telp->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->telp->EditValue ?>"<?php echo $t_repeserta_grid->telp->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_telp">
<span<?php echo $t_repeserta_grid->telp->viewAttributes() ?>><?php echo $t_repeserta_grid->telp->getViewValue() ?></span>
</span>
<?php if (!$t_repeserta->isConfirm()) { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_telp" name="x<?php echo $t_repeserta_grid->RowIndex ?>_telp" id="x<?php echo $t_repeserta_grid->RowIndex ?>_telp" value="<?php echo HtmlEncode($t_repeserta_grid->telp->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_telp" name="o<?php echo $t_repeserta_grid->RowIndex ?>_telp" id="o<?php echo $t_repeserta_grid->RowIndex ?>_telp" value="<?php echo HtmlEncode($t_repeserta_grid->telp->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_telp" name="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_telp" id="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_telp" value="<?php echo HtmlEncode($t_repeserta_grid->telp->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_telp" name="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_telp" id="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_telp" value="<?php echo HtmlEncode($t_repeserta_grid->telp->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->fax->Visible) { // fax ?>
		<td data-name="fax" <?php echo $t_repeserta_grid->fax->cellAttributes() ?>>
<?php if ($t_repeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_fax" class="form-group">
<input type="text" data-table="t_repeserta" data-field="x_fax" name="x<?php echo $t_repeserta_grid->RowIndex ?>_fax" id="x<?php echo $t_repeserta_grid->RowIndex ?>_fax" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_grid->fax->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->fax->EditValue ?>"<?php echo $t_repeserta_grid->fax->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_fax" name="o<?php echo $t_repeserta_grid->RowIndex ?>_fax" id="o<?php echo $t_repeserta_grid->RowIndex ?>_fax" value="<?php echo HtmlEncode($t_repeserta_grid->fax->OldValue) ?>">
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_fax" class="form-group">
<input type="text" data-table="t_repeserta" data-field="x_fax" name="x<?php echo $t_repeserta_grid->RowIndex ?>_fax" id="x<?php echo $t_repeserta_grid->RowIndex ?>_fax" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_grid->fax->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->fax->EditValue ?>"<?php echo $t_repeserta_grid->fax->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_fax">
<span<?php echo $t_repeserta_grid->fax->viewAttributes() ?>><?php echo $t_repeserta_grid->fax->getViewValue() ?></span>
</span>
<?php if (!$t_repeserta->isConfirm()) { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_fax" name="x<?php echo $t_repeserta_grid->RowIndex ?>_fax" id="x<?php echo $t_repeserta_grid->RowIndex ?>_fax" value="<?php echo HtmlEncode($t_repeserta_grid->fax->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_fax" name="o<?php echo $t_repeserta_grid->RowIndex ?>_fax" id="o<?php echo $t_repeserta_grid->RowIndex ?>_fax" value="<?php echo HtmlEncode($t_repeserta_grid->fax->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_fax" name="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_fax" id="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_fax" value="<?php echo HtmlEncode($t_repeserta_grid->fax->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_fax" name="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_fax" id="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_fax" value="<?php echo HtmlEncode($t_repeserta_grid->fax->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->hp->Visible) { // hp ?>
		<td data-name="hp" <?php echo $t_repeserta_grid->hp->cellAttributes() ?>>
<?php if ($t_repeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_hp" class="form-group">
<input type="text" data-table="t_repeserta" data-field="x_hp" name="x<?php echo $t_repeserta_grid->RowIndex ?>_hp" id="x<?php echo $t_repeserta_grid->RowIndex ?>_hp" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_grid->hp->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->hp->EditValue ?>"<?php echo $t_repeserta_grid->hp->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_hp" name="o<?php echo $t_repeserta_grid->RowIndex ?>_hp" id="o<?php echo $t_repeserta_grid->RowIndex ?>_hp" value="<?php echo HtmlEncode($t_repeserta_grid->hp->OldValue) ?>">
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_hp" class="form-group">
<input type="text" data-table="t_repeserta" data-field="x_hp" name="x<?php echo $t_repeserta_grid->RowIndex ?>_hp" id="x<?php echo $t_repeserta_grid->RowIndex ?>_hp" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_grid->hp->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->hp->EditValue ?>"<?php echo $t_repeserta_grid->hp->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_hp">
<span<?php echo $t_repeserta_grid->hp->viewAttributes() ?>><?php echo $t_repeserta_grid->hp->getViewValue() ?></span>
</span>
<?php if (!$t_repeserta->isConfirm()) { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_hp" name="x<?php echo $t_repeserta_grid->RowIndex ?>_hp" id="x<?php echo $t_repeserta_grid->RowIndex ?>_hp" value="<?php echo HtmlEncode($t_repeserta_grid->hp->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_hp" name="o<?php echo $t_repeserta_grid->RowIndex ?>_hp" id="o<?php echo $t_repeserta_grid->RowIndex ?>_hp" value="<?php echo HtmlEncode($t_repeserta_grid->hp->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_hp" name="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_hp" id="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_hp" value="<?php echo HtmlEncode($t_repeserta_grid->hp->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_hp" name="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_hp" id="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_hp" value="<?php echo HtmlEncode($t_repeserta_grid->hp->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->produk->Visible) { // produk ?>
		<td data-name="produk" <?php echo $t_repeserta_grid->produk->cellAttributes() ?>>
<?php if ($t_repeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_produk" class="form-group">
<input type="text" data-table="t_repeserta" data-field="x_produk" name="x<?php echo $t_repeserta_grid->RowIndex ?>_produk" id="x<?php echo $t_repeserta_grid->RowIndex ?>_produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_repeserta_grid->produk->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->produk->EditValue ?>"<?php echo $t_repeserta_grid->produk->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_produk" name="o<?php echo $t_repeserta_grid->RowIndex ?>_produk" id="o<?php echo $t_repeserta_grid->RowIndex ?>_produk" value="<?php echo HtmlEncode($t_repeserta_grid->produk->OldValue) ?>">
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_produk" class="form-group">
<input type="text" data-table="t_repeserta" data-field="x_produk" name="x<?php echo $t_repeserta_grid->RowIndex ?>_produk" id="x<?php echo $t_repeserta_grid->RowIndex ?>_produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_repeserta_grid->produk->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->produk->EditValue ?>"<?php echo $t_repeserta_grid->produk->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_produk">
<span<?php echo $t_repeserta_grid->produk->viewAttributes() ?>><?php echo $t_repeserta_grid->produk->getViewValue() ?></span>
</span>
<?php if (!$t_repeserta->isConfirm()) { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_produk" name="x<?php echo $t_repeserta_grid->RowIndex ?>_produk" id="x<?php echo $t_repeserta_grid->RowIndex ?>_produk" value="<?php echo HtmlEncode($t_repeserta_grid->produk->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_produk" name="o<?php echo $t_repeserta_grid->RowIndex ?>_produk" id="o<?php echo $t_repeserta_grid->RowIndex ?>_produk" value="<?php echo HtmlEncode($t_repeserta_grid->produk->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_produk" name="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_produk" id="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_produk" value="<?php echo HtmlEncode($t_repeserta_grid->produk->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_produk" name="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_produk" id="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_produk" value="<?php echo HtmlEncode($t_repeserta_grid->produk->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->cara_bayar->Visible) { // cara_bayar ?>
		<td data-name="cara_bayar" <?php echo $t_repeserta_grid->cara_bayar->cellAttributes() ?>>
<?php if ($t_repeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_cara_bayar" class="form-group">
<div id="tp_x<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" class="ew-template"><input type="radio" class="custom-control-input" data-table="t_repeserta" data-field="x_cara_bayar" data-value-separator="<?php echo $t_repeserta_grid->cara_bayar->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" id="x<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" value="{value}"<?php echo $t_repeserta_grid->cara_bayar->editAttributes() ?>></div>
<div id="dsl_x<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_repeserta_grid->cara_bayar->radioButtonListHtml(FALSE, "x{$t_repeserta_grid->RowIndex}_cara_bayar") ?>
</div></div>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_cara_bayar" name="o<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" id="o<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" value="<?php echo HtmlEncode($t_repeserta_grid->cara_bayar->OldValue) ?>">
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_cara_bayar" class="form-group">
<div id="tp_x<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" class="ew-template"><input type="radio" class="custom-control-input" data-table="t_repeserta" data-field="x_cara_bayar" data-value-separator="<?php echo $t_repeserta_grid->cara_bayar->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" id="x<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" value="{value}"<?php echo $t_repeserta_grid->cara_bayar->editAttributes() ?>></div>
<div id="dsl_x<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_repeserta_grid->cara_bayar->radioButtonListHtml(FALSE, "x{$t_repeserta_grid->RowIndex}_cara_bayar") ?>
</div></div>
</span>
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_cara_bayar">
<span<?php echo $t_repeserta_grid->cara_bayar->viewAttributes() ?>><?php echo $t_repeserta_grid->cara_bayar->getViewValue() ?></span>
</span>
<?php if (!$t_repeserta->isConfirm()) { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_cara_bayar" name="x<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" id="x<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" value="<?php echo HtmlEncode($t_repeserta_grid->cara_bayar->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_cara_bayar" name="o<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" id="o<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" value="<?php echo HtmlEncode($t_repeserta_grid->cara_bayar->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_cara_bayar" name="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" id="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" value="<?php echo HtmlEncode($t_repeserta_grid->cara_bayar->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_cara_bayar" name="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" id="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" value="<?php echo HtmlEncode($t_repeserta_grid->cara_bayar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->ket_bayar->Visible) { // ket_bayar ?>
		<td data-name="ket_bayar" <?php echo $t_repeserta_grid->ket_bayar->cellAttributes() ?>>
<?php if ($t_repeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_ket_bayar" class="form-group">
<textarea data-table="t_repeserta" data-field="x_ket_bayar" name="x<?php echo $t_repeserta_grid->RowIndex ?>_ket_bayar" id="x<?php echo $t_repeserta_grid->RowIndex ?>_ket_bayar" cols="35" rows="2" placeholder="<?php echo HtmlEncode($t_repeserta_grid->ket_bayar->getPlaceHolder()) ?>"<?php echo $t_repeserta_grid->ket_bayar->editAttributes() ?>><?php echo $t_repeserta_grid->ket_bayar->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_ket_bayar" name="o<?php echo $t_repeserta_grid->RowIndex ?>_ket_bayar" id="o<?php echo $t_repeserta_grid->RowIndex ?>_ket_bayar" value="<?php echo HtmlEncode($t_repeserta_grid->ket_bayar->OldValue) ?>">
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_ket_bayar" class="form-group">
<textarea data-table="t_repeserta" data-field="x_ket_bayar" name="x<?php echo $t_repeserta_grid->RowIndex ?>_ket_bayar" id="x<?php echo $t_repeserta_grid->RowIndex ?>_ket_bayar" cols="35" rows="2" placeholder="<?php echo HtmlEncode($t_repeserta_grid->ket_bayar->getPlaceHolder()) ?>"<?php echo $t_repeserta_grid->ket_bayar->editAttributes() ?>><?php echo $t_repeserta_grid->ket_bayar->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_ket_bayar">
<span<?php echo $t_repeserta_grid->ket_bayar->viewAttributes() ?>><?php echo $t_repeserta_grid->ket_bayar->getViewValue() ?></span>
</span>
<?php if (!$t_repeserta->isConfirm()) { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_ket_bayar" name="x<?php echo $t_repeserta_grid->RowIndex ?>_ket_bayar" id="x<?php echo $t_repeserta_grid->RowIndex ?>_ket_bayar" value="<?php echo HtmlEncode($t_repeserta_grid->ket_bayar->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_ket_bayar" name="o<?php echo $t_repeserta_grid->RowIndex ?>_ket_bayar" id="o<?php echo $t_repeserta_grid->RowIndex ?>_ket_bayar" value="<?php echo HtmlEncode($t_repeserta_grid->ket_bayar->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_ket_bayar" name="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_ket_bayar" id="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_ket_bayar" value="<?php echo HtmlEncode($t_repeserta_grid->ket_bayar->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_ket_bayar" name="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_ket_bayar" id="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_ket_bayar" value="<?php echo HtmlEncode($t_repeserta_grid->ket_bayar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->tgl_bayar->Visible) { // tgl_bayar ?>
		<td data-name="tgl_bayar" <?php echo $t_repeserta_grid->tgl_bayar->cellAttributes() ?>>
<?php if ($t_repeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_tgl_bayar" class="form-group">
<input type="text" data-table="t_repeserta" data-field="x_tgl_bayar" name="x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar" id="x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar" size="10" maxlength="19" placeholder="<?php echo HtmlEncode($t_repeserta_grid->tgl_bayar->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->tgl_bayar->EditValue ?>"<?php echo $t_repeserta_grid->tgl_bayar->editAttributes() ?>>
<?php if (!$t_repeserta_grid->tgl_bayar->ReadOnly && !$t_repeserta_grid->tgl_bayar->Disabled && !isset($t_repeserta_grid->tgl_bayar->EditAttrs["readonly"]) && !isset($t_repeserta_grid->tgl_bayar->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_repesertagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_repesertagrid", "x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_tgl_bayar" name="o<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar" id="o<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar" value="<?php echo HtmlEncode($t_repeserta_grid->tgl_bayar->OldValue) ?>">
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_tgl_bayar" class="form-group">
<input type="text" data-table="t_repeserta" data-field="x_tgl_bayar" name="x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar" id="x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar" size="10" maxlength="19" placeholder="<?php echo HtmlEncode($t_repeserta_grid->tgl_bayar->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->tgl_bayar->EditValue ?>"<?php echo $t_repeserta_grid->tgl_bayar->editAttributes() ?>>
<?php if (!$t_repeserta_grid->tgl_bayar->ReadOnly && !$t_repeserta_grid->tgl_bayar->Disabled && !isset($t_repeserta_grid->tgl_bayar->EditAttrs["readonly"]) && !isset($t_repeserta_grid->tgl_bayar->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_repesertagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_repesertagrid", "x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_tgl_bayar">
<span<?php echo $t_repeserta_grid->tgl_bayar->viewAttributes() ?>><?php echo $t_repeserta_grid->tgl_bayar->getViewValue() ?></span>
</span>
<?php if (!$t_repeserta->isConfirm()) { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_tgl_bayar" name="x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar" id="x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar" value="<?php echo HtmlEncode($t_repeserta_grid->tgl_bayar->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_tgl_bayar" name="o<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar" id="o<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar" value="<?php echo HtmlEncode($t_repeserta_grid->tgl_bayar->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_tgl_bayar" name="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar" id="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar" value="<?php echo HtmlEncode($t_repeserta_grid->tgl_bayar->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_tgl_bayar" name="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar" id="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar" value="<?php echo HtmlEncode($t_repeserta_grid->tgl_bayar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->kdinformasi->Visible) { // kdinformasi ?>
		<td data-name="kdinformasi" <?php echo $t_repeserta_grid->kdinformasi->cellAttributes() ?>>
<?php if ($t_repeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_kdinformasi" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_repeserta" data-field="x_kdinformasi" data-value-separator="<?php echo $t_repeserta_grid->kdinformasi->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_repeserta_grid->RowIndex ?>_kdinformasi" name="x<?php echo $t_repeserta_grid->RowIndex ?>_kdinformasi"<?php echo $t_repeserta_grid->kdinformasi->editAttributes() ?>>
			<?php echo $t_repeserta_grid->kdinformasi->selectOptionListHtml("x{$t_repeserta_grid->RowIndex}_kdinformasi") ?>
		</select>
</div>
<?php echo $t_repeserta_grid->kdinformasi->Lookup->getParamTag($t_repeserta_grid, "p_x" . $t_repeserta_grid->RowIndex . "_kdinformasi") ?>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_kdinformasi" name="o<?php echo $t_repeserta_grid->RowIndex ?>_kdinformasi" id="o<?php echo $t_repeserta_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($t_repeserta_grid->kdinformasi->OldValue) ?>">
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_kdinformasi" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_repeserta" data-field="x_kdinformasi" data-value-separator="<?php echo $t_repeserta_grid->kdinformasi->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_repeserta_grid->RowIndex ?>_kdinformasi" name="x<?php echo $t_repeserta_grid->RowIndex ?>_kdinformasi"<?php echo $t_repeserta_grid->kdinformasi->editAttributes() ?>>
			<?php echo $t_repeserta_grid->kdinformasi->selectOptionListHtml("x{$t_repeserta_grid->RowIndex}_kdinformasi") ?>
		</select>
</div>
<?php echo $t_repeserta_grid->kdinformasi->Lookup->getParamTag($t_repeserta_grid, "p_x" . $t_repeserta_grid->RowIndex . "_kdinformasi") ?>
</span>
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_kdinformasi">
<span<?php echo $t_repeserta_grid->kdinformasi->viewAttributes() ?>><?php echo $t_repeserta_grid->kdinformasi->getViewValue() ?></span>
</span>
<?php if (!$t_repeserta->isConfirm()) { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_kdinformasi" name="x<?php echo $t_repeserta_grid->RowIndex ?>_kdinformasi" id="x<?php echo $t_repeserta_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($t_repeserta_grid->kdinformasi->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_kdinformasi" name="o<?php echo $t_repeserta_grid->RowIndex ?>_kdinformasi" id="o<?php echo $t_repeserta_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($t_repeserta_grid->kdinformasi->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_kdinformasi" name="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_kdinformasi" id="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($t_repeserta_grid->kdinformasi->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_kdinformasi" name="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_kdinformasi" id="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($t_repeserta_grid->kdinformasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->konfirmasi->Visible) { // konfirmasi ?>
		<td data-name="konfirmasi" <?php echo $t_repeserta_grid->konfirmasi->cellAttributes() ?>>
<?php if ($t_repeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_konfirmasi" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_repeserta" data-field="x_konfirmasi" data-value-separator="<?php echo $t_repeserta_grid->konfirmasi->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_repeserta_grid->RowIndex ?>_konfirmasi" name="x<?php echo $t_repeserta_grid->RowIndex ?>_konfirmasi"<?php echo $t_repeserta_grid->konfirmasi->editAttributes() ?>>
			<?php echo $t_repeserta_grid->konfirmasi->selectOptionListHtml("x{$t_repeserta_grid->RowIndex}_konfirmasi") ?>
		</select>
</div>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_konfirmasi" name="o<?php echo $t_repeserta_grid->RowIndex ?>_konfirmasi" id="o<?php echo $t_repeserta_grid->RowIndex ?>_konfirmasi" value="<?php echo HtmlEncode($t_repeserta_grid->konfirmasi->OldValue) ?>">
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_konfirmasi" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_repeserta" data-field="x_konfirmasi" data-value-separator="<?php echo $t_repeserta_grid->konfirmasi->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_repeserta_grid->RowIndex ?>_konfirmasi" name="x<?php echo $t_repeserta_grid->RowIndex ?>_konfirmasi"<?php echo $t_repeserta_grid->konfirmasi->editAttributes() ?>>
			<?php echo $t_repeserta_grid->konfirmasi->selectOptionListHtml("x{$t_repeserta_grid->RowIndex}_konfirmasi") ?>
		</select>
</div>
</span>
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_konfirmasi">
<span<?php echo $t_repeserta_grid->konfirmasi->viewAttributes() ?>><?php echo $t_repeserta_grid->konfirmasi->getViewValue() ?></span>
</span>
<?php if (!$t_repeserta->isConfirm()) { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_konfirmasi" name="x<?php echo $t_repeserta_grid->RowIndex ?>_konfirmasi" id="x<?php echo $t_repeserta_grid->RowIndex ?>_konfirmasi" value="<?php echo HtmlEncode($t_repeserta_grid->konfirmasi->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_konfirmasi" name="o<?php echo $t_repeserta_grid->RowIndex ?>_konfirmasi" id="o<?php echo $t_repeserta_grid->RowIndex ?>_konfirmasi" value="<?php echo HtmlEncode($t_repeserta_grid->konfirmasi->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_konfirmasi" name="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_konfirmasi" id="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_konfirmasi" value="<?php echo HtmlEncode($t_repeserta_grid->konfirmasi->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_konfirmasi" name="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_konfirmasi" id="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_konfirmasi" value="<?php echo HtmlEncode($t_repeserta_grid->konfirmasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->ket->Visible) { // ket ?>
		<td data-name="ket" <?php echo $t_repeserta_grid->ket->cellAttributes() ?>>
<?php if ($t_repeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_ket" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_repeserta" data-field="x_ket" data-value-separator="<?php echo $t_repeserta_grid->ket->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_repeserta_grid->RowIndex ?>_ket" name="x<?php echo $t_repeserta_grid->RowIndex ?>_ket"<?php echo $t_repeserta_grid->ket->editAttributes() ?>>
			<?php echo $t_repeserta_grid->ket->selectOptionListHtml("x{$t_repeserta_grid->RowIndex}_ket") ?>
		</select>
</div>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_ket" name="o<?php echo $t_repeserta_grid->RowIndex ?>_ket" id="o<?php echo $t_repeserta_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_repeserta_grid->ket->OldValue) ?>">
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_ket" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_repeserta" data-field="x_ket" data-value-separator="<?php echo $t_repeserta_grid->ket->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_repeserta_grid->RowIndex ?>_ket" name="x<?php echo $t_repeserta_grid->RowIndex ?>_ket"<?php echo $t_repeserta_grid->ket->editAttributes() ?>>
			<?php echo $t_repeserta_grid->ket->selectOptionListHtml("x{$t_repeserta_grid->RowIndex}_ket") ?>
		</select>
</div>
</span>
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_ket">
<span<?php echo $t_repeserta_grid->ket->viewAttributes() ?>><?php echo $t_repeserta_grid->ket->getViewValue() ?></span>
</span>
<?php if (!$t_repeserta->isConfirm()) { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_ket" name="x<?php echo $t_repeserta_grid->RowIndex ?>_ket" id="x<?php echo $t_repeserta_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_repeserta_grid->ket->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_ket" name="o<?php echo $t_repeserta_grid->RowIndex ?>_ket" id="o<?php echo $t_repeserta_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_repeserta_grid->ket->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_ket" name="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_ket" id="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_repeserta_grid->ket->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_ket" name="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_ket" id="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_repeserta_grid->ket->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->ket_lainnya->Visible) { // ket_lainnya ?>
		<td data-name="ket_lainnya" <?php echo $t_repeserta_grid->ket_lainnya->cellAttributes() ?>>
<?php if ($t_repeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_ket_lainnya" class="form-group">
<textarea data-table="t_repeserta" data-field="x_ket_lainnya" name="x<?php echo $t_repeserta_grid->RowIndex ?>_ket_lainnya" id="x<?php echo $t_repeserta_grid->RowIndex ?>_ket_lainnya" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_repeserta_grid->ket_lainnya->getPlaceHolder()) ?>"<?php echo $t_repeserta_grid->ket_lainnya->editAttributes() ?>><?php echo $t_repeserta_grid->ket_lainnya->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_ket_lainnya" name="o<?php echo $t_repeserta_grid->RowIndex ?>_ket_lainnya" id="o<?php echo $t_repeserta_grid->RowIndex ?>_ket_lainnya" value="<?php echo HtmlEncode($t_repeserta_grid->ket_lainnya->OldValue) ?>">
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_ket_lainnya" class="form-group">
<textarea data-table="t_repeserta" data-field="x_ket_lainnya" name="x<?php echo $t_repeserta_grid->RowIndex ?>_ket_lainnya" id="x<?php echo $t_repeserta_grid->RowIndex ?>_ket_lainnya" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_repeserta_grid->ket_lainnya->getPlaceHolder()) ?>"<?php echo $t_repeserta_grid->ket_lainnya->editAttributes() ?>><?php echo $t_repeserta_grid->ket_lainnya->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t_repeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_repeserta_grid->RowCount ?>_t_repeserta_ket_lainnya">
<span<?php echo $t_repeserta_grid->ket_lainnya->viewAttributes() ?>><?php echo $t_repeserta_grid->ket_lainnya->getViewValue() ?></span>
</span>
<?php if (!$t_repeserta->isConfirm()) { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_ket_lainnya" name="x<?php echo $t_repeserta_grid->RowIndex ?>_ket_lainnya" id="x<?php echo $t_repeserta_grid->RowIndex ?>_ket_lainnya" value="<?php echo HtmlEncode($t_repeserta_grid->ket_lainnya->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_ket_lainnya" name="o<?php echo $t_repeserta_grid->RowIndex ?>_ket_lainnya" id="o<?php echo $t_repeserta_grid->RowIndex ?>_ket_lainnya" value="<?php echo HtmlEncode($t_repeserta_grid->ket_lainnya->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_repeserta" data-field="x_ket_lainnya" name="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_ket_lainnya" id="ft_repesertagrid$x<?php echo $t_repeserta_grid->RowIndex ?>_ket_lainnya" value="<?php echo HtmlEncode($t_repeserta_grid->ket_lainnya->FormValue) ?>">
<input type="hidden" data-table="t_repeserta" data-field="x_ket_lainnya" name="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_ket_lainnya" id="ft_repesertagrid$o<?php echo $t_repeserta_grid->RowIndex ?>_ket_lainnya" value="<?php echo HtmlEncode($t_repeserta_grid->ket_lainnya->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_repeserta_grid->ListOptions->render("body", "right", $t_repeserta_grid->RowCount);
?>
	</tr>
<?php if ($t_repeserta->RowType == ROWTYPE_ADD || $t_repeserta->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_repesertagrid", "load"], function() {
	ft_repesertagrid.updateLists(<?php echo $t_repeserta_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_repeserta_grid->isGridAdd() || $t_repeserta->CurrentMode == "copy")
		if (!$t_repeserta_grid->Recordset->EOF)
			$t_repeserta_grid->Recordset->moveNext();
}
?>
<?php
	if ($t_repeserta->CurrentMode == "add" || $t_repeserta->CurrentMode == "copy" || $t_repeserta->CurrentMode == "edit") {
		$t_repeserta_grid->RowIndex = '$rowindex$';
		$t_repeserta_grid->loadRowValues();

		// Set row properties
		$t_repeserta->resetAttributes();
		$t_repeserta->RowAttrs->merge(["data-rowindex" => $t_repeserta_grid->RowIndex, "id" => "r0_t_repeserta", "data-rowtype" => ROWTYPE_ADD]);
		$t_repeserta->RowAttrs->appendClass("ew-template");
		$t_repeserta->RowType = ROWTYPE_ADD;

		// Render row
		$t_repeserta_grid->renderRow();

		// Render list options
		$t_repeserta_grid->renderListOptions();
		$t_repeserta_grid->StartRowCount = 0;
?>
	<tr <?php echo $t_repeserta->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_repeserta_grid->ListOptions->render("body", "left", $t_repeserta_grid->RowIndex);
?>
	<?php if ($t_repeserta_grid->nama->Visible) { // nama ?>
		<td data-name="nama">
<?php if (!$t_repeserta->isConfirm()) { ?>
<span id="el$rowindex$_t_repeserta_nama" class="form-group t_repeserta_nama">
<input type="text" data-table="t_repeserta" data-field="x_nama" name="x<?php echo $t_repeserta_grid->RowIndex ?>_nama" id="x<?php echo $t_repeserta_grid->RowIndex ?>_nama" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_grid->nama->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->nama->EditValue ?>"<?php echo $t_repeserta_grid->nama->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_repeserta_nama" class="form-group t_repeserta_nama">
<span<?php echo $t_repeserta_grid->nama->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_repeserta_grid->nama->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_nama" name="x<?php echo $t_repeserta_grid->RowIndex ?>_nama" id="x<?php echo $t_repeserta_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($t_repeserta_grid->nama->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_repeserta" data-field="x_nama" name="o<?php echo $t_repeserta_grid->RowIndex ?>_nama" id="o<?php echo $t_repeserta_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($t_repeserta_grid->nama->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->perusahaan->Visible) { // perusahaan ?>
		<td data-name="perusahaan">
<?php if (!$t_repeserta->isConfirm()) { ?>
<span id="el$rowindex$_t_repeserta_perusahaan" class="form-group t_repeserta_perusahaan">
<input type="text" data-table="t_repeserta" data-field="x_perusahaan" name="x<?php echo $t_repeserta_grid->RowIndex ?>_perusahaan" id="x<?php echo $t_repeserta_grid->RowIndex ?>_perusahaan" size="55" maxlength="255" placeholder="<?php echo HtmlEncode($t_repeserta_grid->perusahaan->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->perusahaan->EditValue ?>"<?php echo $t_repeserta_grid->perusahaan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_repeserta_perusahaan" class="form-group t_repeserta_perusahaan">
<span<?php echo $t_repeserta_grid->perusahaan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_repeserta_grid->perusahaan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_perusahaan" name="x<?php echo $t_repeserta_grid->RowIndex ?>_perusahaan" id="x<?php echo $t_repeserta_grid->RowIndex ?>_perusahaan" value="<?php echo HtmlEncode($t_repeserta_grid->perusahaan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_repeserta" data-field="x_perusahaan" name="o<?php echo $t_repeserta_grid->RowIndex ?>_perusahaan" id="o<?php echo $t_repeserta_grid->RowIndex ?>_perusahaan" value="<?php echo HtmlEncode($t_repeserta_grid->perusahaan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->jabatan->Visible) { // jabatan ?>
		<td data-name="jabatan">
<?php if (!$t_repeserta->isConfirm()) { ?>
<span id="el$rowindex$_t_repeserta_jabatan" class="form-group t_repeserta_jabatan">
<?php
$onchange = $t_repeserta_grid->jabatan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_repeserta_grid->jabatan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan">
	<input type="text" class="form-control" name="sv_x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" id="sv_x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" value="<?php echo RemoveHtml($t_repeserta_grid->jabatan->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_grid->jabatan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_repeserta_grid->jabatan->getPlaceHolder()) ?>"<?php echo $t_repeserta_grid->jabatan->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_jabatan" data-value-separator="<?php echo $t_repeserta_grid->jabatan->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" id="x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" value="<?php echo HtmlEncode($t_repeserta_grid->jabatan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_repesertagrid"], function() {
	ft_repesertagrid.createAutoSuggest({"id":"x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan","forceSelect":true});
});
</script>
<?php echo $t_repeserta_grid->jabatan->Lookup->getParamTag($t_repeserta_grid, "p_x" . $t_repeserta_grid->RowIndex . "_jabatan") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_repeserta_jabatan" class="form-group t_repeserta_jabatan">
<span<?php echo $t_repeserta_grid->jabatan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_repeserta_grid->jabatan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_jabatan" name="x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" id="x<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" value="<?php echo HtmlEncode($t_repeserta_grid->jabatan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_repeserta" data-field="x_jabatan" name="o<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" id="o<?php echo $t_repeserta_grid->RowIndex ?>_jabatan" value="<?php echo HtmlEncode($t_repeserta_grid->jabatan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->tgl_daftar->Visible) { // tgl_daftar ?>
		<td data-name="tgl_daftar">
<?php if (!$t_repeserta->isConfirm()) { ?>
<span id="el$rowindex$_t_repeserta_tgl_daftar" class="form-group t_repeserta_tgl_daftar">
<input type="text" data-table="t_repeserta" data-field="x_tgl_daftar" name="x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar" id="x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar" size="10" maxlength="19" placeholder="<?php echo HtmlEncode($t_repeserta_grid->tgl_daftar->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->tgl_daftar->EditValue ?>"<?php echo $t_repeserta_grid->tgl_daftar->editAttributes() ?>>
<?php if (!$t_repeserta_grid->tgl_daftar->ReadOnly && !$t_repeserta_grid->tgl_daftar->Disabled && !isset($t_repeserta_grid->tgl_daftar->EditAttrs["readonly"]) && !isset($t_repeserta_grid->tgl_daftar->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_repesertagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_repesertagrid", "x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_repeserta_tgl_daftar" class="form-group t_repeserta_tgl_daftar">
<span<?php echo $t_repeserta_grid->tgl_daftar->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_repeserta_grid->tgl_daftar->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_tgl_daftar" name="x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar" id="x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar" value="<?php echo HtmlEncode($t_repeserta_grid->tgl_daftar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_repeserta" data-field="x_tgl_daftar" name="o<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar" id="o<?php echo $t_repeserta_grid->RowIndex ?>_tgl_daftar" value="<?php echo HtmlEncode($t_repeserta_grid->tgl_daftar->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->telp->Visible) { // telp ?>
		<td data-name="telp">
<?php if (!$t_repeserta->isConfirm()) { ?>
<span id="el$rowindex$_t_repeserta_telp" class="form-group t_repeserta_telp">
<input type="text" data-table="t_repeserta" data-field="x_telp" name="x<?php echo $t_repeserta_grid->RowIndex ?>_telp" id="x<?php echo $t_repeserta_grid->RowIndex ?>_telp" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_grid->telp->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->telp->EditValue ?>"<?php echo $t_repeserta_grid->telp->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_repeserta_telp" class="form-group t_repeserta_telp">
<span<?php echo $t_repeserta_grid->telp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_repeserta_grid->telp->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_telp" name="x<?php echo $t_repeserta_grid->RowIndex ?>_telp" id="x<?php echo $t_repeserta_grid->RowIndex ?>_telp" value="<?php echo HtmlEncode($t_repeserta_grid->telp->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_repeserta" data-field="x_telp" name="o<?php echo $t_repeserta_grid->RowIndex ?>_telp" id="o<?php echo $t_repeserta_grid->RowIndex ?>_telp" value="<?php echo HtmlEncode($t_repeserta_grid->telp->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->fax->Visible) { // fax ?>
		<td data-name="fax">
<?php if (!$t_repeserta->isConfirm()) { ?>
<span id="el$rowindex$_t_repeserta_fax" class="form-group t_repeserta_fax">
<input type="text" data-table="t_repeserta" data-field="x_fax" name="x<?php echo $t_repeserta_grid->RowIndex ?>_fax" id="x<?php echo $t_repeserta_grid->RowIndex ?>_fax" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_grid->fax->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->fax->EditValue ?>"<?php echo $t_repeserta_grid->fax->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_repeserta_fax" class="form-group t_repeserta_fax">
<span<?php echo $t_repeserta_grid->fax->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_repeserta_grid->fax->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_fax" name="x<?php echo $t_repeserta_grid->RowIndex ?>_fax" id="x<?php echo $t_repeserta_grid->RowIndex ?>_fax" value="<?php echo HtmlEncode($t_repeserta_grid->fax->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_repeserta" data-field="x_fax" name="o<?php echo $t_repeserta_grid->RowIndex ?>_fax" id="o<?php echo $t_repeserta_grid->RowIndex ?>_fax" value="<?php echo HtmlEncode($t_repeserta_grid->fax->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->hp->Visible) { // hp ?>
		<td data-name="hp">
<?php if (!$t_repeserta->isConfirm()) { ?>
<span id="el$rowindex$_t_repeserta_hp" class="form-group t_repeserta_hp">
<input type="text" data-table="t_repeserta" data-field="x_hp" name="x<?php echo $t_repeserta_grid->RowIndex ?>_hp" id="x<?php echo $t_repeserta_grid->RowIndex ?>_hp" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_grid->hp->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->hp->EditValue ?>"<?php echo $t_repeserta_grid->hp->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_repeserta_hp" class="form-group t_repeserta_hp">
<span<?php echo $t_repeserta_grid->hp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_repeserta_grid->hp->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_hp" name="x<?php echo $t_repeserta_grid->RowIndex ?>_hp" id="x<?php echo $t_repeserta_grid->RowIndex ?>_hp" value="<?php echo HtmlEncode($t_repeserta_grid->hp->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_repeserta" data-field="x_hp" name="o<?php echo $t_repeserta_grid->RowIndex ?>_hp" id="o<?php echo $t_repeserta_grid->RowIndex ?>_hp" value="<?php echo HtmlEncode($t_repeserta_grid->hp->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->produk->Visible) { // produk ?>
		<td data-name="produk">
<?php if (!$t_repeserta->isConfirm()) { ?>
<span id="el$rowindex$_t_repeserta_produk" class="form-group t_repeserta_produk">
<input type="text" data-table="t_repeserta" data-field="x_produk" name="x<?php echo $t_repeserta_grid->RowIndex ?>_produk" id="x<?php echo $t_repeserta_grid->RowIndex ?>_produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_repeserta_grid->produk->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->produk->EditValue ?>"<?php echo $t_repeserta_grid->produk->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_repeserta_produk" class="form-group t_repeserta_produk">
<span<?php echo $t_repeserta_grid->produk->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_repeserta_grid->produk->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_produk" name="x<?php echo $t_repeserta_grid->RowIndex ?>_produk" id="x<?php echo $t_repeserta_grid->RowIndex ?>_produk" value="<?php echo HtmlEncode($t_repeserta_grid->produk->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_repeserta" data-field="x_produk" name="o<?php echo $t_repeserta_grid->RowIndex ?>_produk" id="o<?php echo $t_repeserta_grid->RowIndex ?>_produk" value="<?php echo HtmlEncode($t_repeserta_grid->produk->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->cara_bayar->Visible) { // cara_bayar ?>
		<td data-name="cara_bayar">
<?php if (!$t_repeserta->isConfirm()) { ?>
<span id="el$rowindex$_t_repeserta_cara_bayar" class="form-group t_repeserta_cara_bayar">
<div id="tp_x<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" class="ew-template"><input type="radio" class="custom-control-input" data-table="t_repeserta" data-field="x_cara_bayar" data-value-separator="<?php echo $t_repeserta_grid->cara_bayar->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" id="x<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" value="{value}"<?php echo $t_repeserta_grid->cara_bayar->editAttributes() ?>></div>
<div id="dsl_x<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_repeserta_grid->cara_bayar->radioButtonListHtml(FALSE, "x{$t_repeserta_grid->RowIndex}_cara_bayar") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_repeserta_cara_bayar" class="form-group t_repeserta_cara_bayar">
<span<?php echo $t_repeserta_grid->cara_bayar->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_repeserta_grid->cara_bayar->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_cara_bayar" name="x<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" id="x<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" value="<?php echo HtmlEncode($t_repeserta_grid->cara_bayar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_repeserta" data-field="x_cara_bayar" name="o<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" id="o<?php echo $t_repeserta_grid->RowIndex ?>_cara_bayar" value="<?php echo HtmlEncode($t_repeserta_grid->cara_bayar->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->ket_bayar->Visible) { // ket_bayar ?>
		<td data-name="ket_bayar">
<?php if (!$t_repeserta->isConfirm()) { ?>
<span id="el$rowindex$_t_repeserta_ket_bayar" class="form-group t_repeserta_ket_bayar">
<textarea data-table="t_repeserta" data-field="x_ket_bayar" name="x<?php echo $t_repeserta_grid->RowIndex ?>_ket_bayar" id="x<?php echo $t_repeserta_grid->RowIndex ?>_ket_bayar" cols="35" rows="2" placeholder="<?php echo HtmlEncode($t_repeserta_grid->ket_bayar->getPlaceHolder()) ?>"<?php echo $t_repeserta_grid->ket_bayar->editAttributes() ?>><?php echo $t_repeserta_grid->ket_bayar->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_repeserta_ket_bayar" class="form-group t_repeserta_ket_bayar">
<span<?php echo $t_repeserta_grid->ket_bayar->viewAttributes() ?>><?php echo $t_repeserta_grid->ket_bayar->ViewValue ?></span>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_ket_bayar" name="x<?php echo $t_repeserta_grid->RowIndex ?>_ket_bayar" id="x<?php echo $t_repeserta_grid->RowIndex ?>_ket_bayar" value="<?php echo HtmlEncode($t_repeserta_grid->ket_bayar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_repeserta" data-field="x_ket_bayar" name="o<?php echo $t_repeserta_grid->RowIndex ?>_ket_bayar" id="o<?php echo $t_repeserta_grid->RowIndex ?>_ket_bayar" value="<?php echo HtmlEncode($t_repeserta_grid->ket_bayar->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->tgl_bayar->Visible) { // tgl_bayar ?>
		<td data-name="tgl_bayar">
<?php if (!$t_repeserta->isConfirm()) { ?>
<span id="el$rowindex$_t_repeserta_tgl_bayar" class="form-group t_repeserta_tgl_bayar">
<input type="text" data-table="t_repeserta" data-field="x_tgl_bayar" name="x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar" id="x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar" size="10" maxlength="19" placeholder="<?php echo HtmlEncode($t_repeserta_grid->tgl_bayar->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_grid->tgl_bayar->EditValue ?>"<?php echo $t_repeserta_grid->tgl_bayar->editAttributes() ?>>
<?php if (!$t_repeserta_grid->tgl_bayar->ReadOnly && !$t_repeserta_grid->tgl_bayar->Disabled && !isset($t_repeserta_grid->tgl_bayar->EditAttrs["readonly"]) && !isset($t_repeserta_grid->tgl_bayar->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_repesertagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_repesertagrid", "x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_repeserta_tgl_bayar" class="form-group t_repeserta_tgl_bayar">
<span<?php echo $t_repeserta_grid->tgl_bayar->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_repeserta_grid->tgl_bayar->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_tgl_bayar" name="x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar" id="x<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar" value="<?php echo HtmlEncode($t_repeserta_grid->tgl_bayar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_repeserta" data-field="x_tgl_bayar" name="o<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar" id="o<?php echo $t_repeserta_grid->RowIndex ?>_tgl_bayar" value="<?php echo HtmlEncode($t_repeserta_grid->tgl_bayar->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->kdinformasi->Visible) { // kdinformasi ?>
		<td data-name="kdinformasi">
<?php if (!$t_repeserta->isConfirm()) { ?>
<span id="el$rowindex$_t_repeserta_kdinformasi" class="form-group t_repeserta_kdinformasi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_repeserta" data-field="x_kdinformasi" data-value-separator="<?php echo $t_repeserta_grid->kdinformasi->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_repeserta_grid->RowIndex ?>_kdinformasi" name="x<?php echo $t_repeserta_grid->RowIndex ?>_kdinformasi"<?php echo $t_repeserta_grid->kdinformasi->editAttributes() ?>>
			<?php echo $t_repeserta_grid->kdinformasi->selectOptionListHtml("x{$t_repeserta_grid->RowIndex}_kdinformasi") ?>
		</select>
</div>
<?php echo $t_repeserta_grid->kdinformasi->Lookup->getParamTag($t_repeserta_grid, "p_x" . $t_repeserta_grid->RowIndex . "_kdinformasi") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_repeserta_kdinformasi" class="form-group t_repeserta_kdinformasi">
<span<?php echo $t_repeserta_grid->kdinformasi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_repeserta_grid->kdinformasi->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_kdinformasi" name="x<?php echo $t_repeserta_grid->RowIndex ?>_kdinformasi" id="x<?php echo $t_repeserta_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($t_repeserta_grid->kdinformasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_repeserta" data-field="x_kdinformasi" name="o<?php echo $t_repeserta_grid->RowIndex ?>_kdinformasi" id="o<?php echo $t_repeserta_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($t_repeserta_grid->kdinformasi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->konfirmasi->Visible) { // konfirmasi ?>
		<td data-name="konfirmasi">
<?php if (!$t_repeserta->isConfirm()) { ?>
<span id="el$rowindex$_t_repeserta_konfirmasi" class="form-group t_repeserta_konfirmasi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_repeserta" data-field="x_konfirmasi" data-value-separator="<?php echo $t_repeserta_grid->konfirmasi->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_repeserta_grid->RowIndex ?>_konfirmasi" name="x<?php echo $t_repeserta_grid->RowIndex ?>_konfirmasi"<?php echo $t_repeserta_grid->konfirmasi->editAttributes() ?>>
			<?php echo $t_repeserta_grid->konfirmasi->selectOptionListHtml("x{$t_repeserta_grid->RowIndex}_konfirmasi") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_repeserta_konfirmasi" class="form-group t_repeserta_konfirmasi">
<span<?php echo $t_repeserta_grid->konfirmasi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_repeserta_grid->konfirmasi->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_konfirmasi" name="x<?php echo $t_repeserta_grid->RowIndex ?>_konfirmasi" id="x<?php echo $t_repeserta_grid->RowIndex ?>_konfirmasi" value="<?php echo HtmlEncode($t_repeserta_grid->konfirmasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_repeserta" data-field="x_konfirmasi" name="o<?php echo $t_repeserta_grid->RowIndex ?>_konfirmasi" id="o<?php echo $t_repeserta_grid->RowIndex ?>_konfirmasi" value="<?php echo HtmlEncode($t_repeserta_grid->konfirmasi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->ket->Visible) { // ket ?>
		<td data-name="ket">
<?php if (!$t_repeserta->isConfirm()) { ?>
<span id="el$rowindex$_t_repeserta_ket" class="form-group t_repeserta_ket">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_repeserta" data-field="x_ket" data-value-separator="<?php echo $t_repeserta_grid->ket->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_repeserta_grid->RowIndex ?>_ket" name="x<?php echo $t_repeserta_grid->RowIndex ?>_ket"<?php echo $t_repeserta_grid->ket->editAttributes() ?>>
			<?php echo $t_repeserta_grid->ket->selectOptionListHtml("x{$t_repeserta_grid->RowIndex}_ket") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_repeserta_ket" class="form-group t_repeserta_ket">
<span<?php echo $t_repeserta_grid->ket->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_repeserta_grid->ket->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_ket" name="x<?php echo $t_repeserta_grid->RowIndex ?>_ket" id="x<?php echo $t_repeserta_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_repeserta_grid->ket->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_repeserta" data-field="x_ket" name="o<?php echo $t_repeserta_grid->RowIndex ?>_ket" id="o<?php echo $t_repeserta_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_repeserta_grid->ket->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_repeserta_grid->ket_lainnya->Visible) { // ket_lainnya ?>
		<td data-name="ket_lainnya">
<?php if (!$t_repeserta->isConfirm()) { ?>
<span id="el$rowindex$_t_repeserta_ket_lainnya" class="form-group t_repeserta_ket_lainnya">
<textarea data-table="t_repeserta" data-field="x_ket_lainnya" name="x<?php echo $t_repeserta_grid->RowIndex ?>_ket_lainnya" id="x<?php echo $t_repeserta_grid->RowIndex ?>_ket_lainnya" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_repeserta_grid->ket_lainnya->getPlaceHolder()) ?>"<?php echo $t_repeserta_grid->ket_lainnya->editAttributes() ?>><?php echo $t_repeserta_grid->ket_lainnya->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_repeserta_ket_lainnya" class="form-group t_repeserta_ket_lainnya">
<span<?php echo $t_repeserta_grid->ket_lainnya->viewAttributes() ?>><?php echo $t_repeserta_grid->ket_lainnya->ViewValue ?></span>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_ket_lainnya" name="x<?php echo $t_repeserta_grid->RowIndex ?>_ket_lainnya" id="x<?php echo $t_repeserta_grid->RowIndex ?>_ket_lainnya" value="<?php echo HtmlEncode($t_repeserta_grid->ket_lainnya->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_repeserta" data-field="x_ket_lainnya" name="o<?php echo $t_repeserta_grid->RowIndex ?>_ket_lainnya" id="o<?php echo $t_repeserta_grid->RowIndex ?>_ket_lainnya" value="<?php echo HtmlEncode($t_repeserta_grid->ket_lainnya->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_repeserta_grid->ListOptions->render("body", "right", $t_repeserta_grid->RowIndex);
?>
<script>
loadjs.ready(["ft_repesertagrid", "load"], function() {
	ft_repesertagrid.updateLists(<?php echo $t_repeserta_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($t_repeserta->CurrentMode == "add" || $t_repeserta->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $t_repeserta_grid->FormKeyCountName ?>" id="<?php echo $t_repeserta_grid->FormKeyCountName ?>" value="<?php echo $t_repeserta_grid->KeyCount ?>">
<?php echo $t_repeserta_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_repeserta->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $t_repeserta_grid->FormKeyCountName ?>" id="<?php echo $t_repeserta_grid->FormKeyCountName ?>" value="<?php echo $t_repeserta_grid->KeyCount ?>">
<?php echo $t_repeserta_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_repeserta->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_repesertagrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_repeserta_grid->Recordset)
	$t_repeserta_grid->Recordset->Close();
?>
<?php if ($t_repeserta_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $t_repeserta_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_repeserta_grid->TotalRecords == 0 && !$t_repeserta->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_repeserta_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$t_repeserta_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php if (!$t_repeserta->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_t_repeserta",
		width: "100%",
		height: "350px"
	});
});
</script>
<?php } ?>
<?php } ?>
<?php
$t_repeserta_grid->terminate();
?>