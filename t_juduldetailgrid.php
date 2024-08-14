<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($t_juduldetail_grid))
	$t_juduldetail_grid = new t_juduldetail_grid();

// Run the page
$t_juduldetail_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_juduldetail_grid->Page_Render();
?>
<?php if (!$t_juduldetail_grid->isExport()) { ?>
<script>
var ft_juduldetailgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	ft_juduldetailgrid = new ew.Form("ft_juduldetailgrid", "grid");
	ft_juduldetailgrid.formKeyCountName = '<?php echo $t_juduldetail_grid->FormKeyCountName ?>';

	// Validate form
	ft_juduldetailgrid.validate = function() {
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
			<?php if ($t_juduldetail_grid->singbagian->Required) { ?>
				elm = this.getElements("x" + infix + "_singbagian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_grid->singbagian->caption(), $t_juduldetail_grid->singbagian->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_grid->jpel->Required) { ?>
				elm = this.getElements("x" + infix + "_jpel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_grid->jpel->caption(), $t_juduldetail_grid->jpel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_grid->kdjudul->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjudul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_grid->kdjudul->caption(), $t_juduldetail_grid->kdjudul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_grid->kdkursil->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkursil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_grid->kdkursil->caption(), $t_juduldetail_grid->kdkursil->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_grid->revisi->Required) { ?>
				elm = this.getElements("x" + infix + "_revisi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_grid->revisi->caption(), $t_juduldetail_grid->revisi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_grid->tgl_terbit->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_terbit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_grid->tgl_terbit->caption(), $t_juduldetail_grid->tgl_terbit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_terbit");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_juduldetail_grid->tgl_terbit->errorMessage()) ?>");
			<?php if ($t_juduldetail_grid->deskripsi_singkat->Required) { ?>
				elm = this.getElements("x" + infix + "_deskripsi_singkat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_grid->deskripsi_singkat->caption(), $t_juduldetail_grid->deskripsi_singkat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_grid->tujuan->Required) { ?>
				elm = this.getElements("x" + infix + "_tujuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_grid->tujuan->caption(), $t_juduldetail_grid->tujuan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_grid->target_peserta->Required) { ?>
				elm = this.getElements("x" + infix + "_target_peserta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_grid->target_peserta->caption(), $t_juduldetail_grid->target_peserta->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_grid->lama_pelatihan->Required) { ?>
				elm = this.getElements("x" + infix + "_lama_pelatihan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_grid->lama_pelatihan->caption(), $t_juduldetail_grid->lama_pelatihan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_grid->catatan->Required) { ?>
				elm = this.getElements("x" + infix + "_catatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_grid->catatan->caption(), $t_juduldetail_grid->catatan->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	ft_juduldetailgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "singbagian", false)) return false;
		if (ew.valueChanged(fobj, infix, "jpel", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdjudul", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdkursil", false)) return false;
		if (ew.valueChanged(fobj, infix, "revisi", false)) return false;
		if (ew.valueChanged(fobj, infix, "tgl_terbit", false)) return false;
		if (ew.valueChanged(fobj, infix, "deskripsi_singkat", false)) return false;
		if (ew.valueChanged(fobj, infix, "tujuan", false)) return false;
		if (ew.valueChanged(fobj, infix, "target_peserta", false)) return false;
		if (ew.valueChanged(fobj, infix, "lama_pelatihan", false)) return false;
		if (ew.valueChanged(fobj, infix, "catatan", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_juduldetailgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_juduldetailgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_juduldetailgrid.lists["x_singbagian"] = <?php echo $t_juduldetail_grid->singbagian->Lookup->toClientList($t_juduldetail_grid) ?>;
	ft_juduldetailgrid.lists["x_singbagian"].options = <?php echo JsonEncode($t_juduldetail_grid->singbagian->lookupOptions()) ?>;
	ft_juduldetailgrid.lists["x_jpel"] = <?php echo $t_juduldetail_grid->jpel->Lookup->toClientList($t_juduldetail_grid) ?>;
	ft_juduldetailgrid.lists["x_jpel"].options = <?php echo JsonEncode($t_juduldetail_grid->jpel->options(FALSE, TRUE)) ?>;
	ft_juduldetailgrid.lists["x_kdjudul"] = <?php echo $t_juduldetail_grid->kdjudul->Lookup->toClientList($t_juduldetail_grid) ?>;
	ft_juduldetailgrid.lists["x_kdjudul"].options = <?php echo JsonEncode($t_juduldetail_grid->kdjudul->lookupOptions()) ?>;
	ft_juduldetailgrid.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_juduldetailgrid.lists["x_lama_pelatihan"] = <?php echo $t_juduldetail_grid->lama_pelatihan->Lookup->toClientList($t_juduldetail_grid) ?>;
	ft_juduldetailgrid.lists["x_lama_pelatihan"].options = <?php echo JsonEncode($t_juduldetail_grid->lama_pelatihan->lookupOptions()) ?>;
	loadjs.done("ft_juduldetailgrid");
});
</script>
<?php } ?>
<?php
$t_juduldetail_grid->renderOtherOptions();
?>
<?php if ($t_juduldetail_grid->TotalRecords > 0 || $t_juduldetail->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_juduldetail_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_juduldetail">
<?php if ($t_juduldetail_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $t_juduldetail_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ft_juduldetailgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_t_juduldetail" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_t_juduldetailgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_juduldetail->RowType = ROWTYPE_HEADER;

// Render list options
$t_juduldetail_grid->renderListOptions();

// Render list options (header, left)
$t_juduldetail_grid->ListOptions->render("header", "left");
?>
<?php if ($t_juduldetail_grid->singbagian->Visible) { // singbagian ?>
	<?php if ($t_juduldetail_grid->SortUrl($t_juduldetail_grid->singbagian) == "") { ?>
		<th data-name="singbagian" class="<?php echo $t_juduldetail_grid->singbagian->headerCellClass() ?>"><div id="elh_t_juduldetail_singbagian" class="t_juduldetail_singbagian"><div class="ew-table-header-caption"><?php echo $t_juduldetail_grid->singbagian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="singbagian" class="<?php echo $t_juduldetail_grid->singbagian->headerCellClass() ?>"><div><div id="elh_t_juduldetail_singbagian" class="t_juduldetail_singbagian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_juduldetail_grid->singbagian->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_juduldetail_grid->singbagian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_juduldetail_grid->singbagian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_juduldetail_grid->jpel->Visible) { // jpel ?>
	<?php if ($t_juduldetail_grid->SortUrl($t_juduldetail_grid->jpel) == "") { ?>
		<th data-name="jpel" class="<?php echo $t_juduldetail_grid->jpel->headerCellClass() ?>"><div id="elh_t_juduldetail_jpel" class="t_juduldetail_jpel"><div class="ew-table-header-caption"><?php echo $t_juduldetail_grid->jpel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jpel" class="<?php echo $t_juduldetail_grid->jpel->headerCellClass() ?>"><div><div id="elh_t_juduldetail_jpel" class="t_juduldetail_jpel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_juduldetail_grid->jpel->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_juduldetail_grid->jpel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_juduldetail_grid->jpel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_juduldetail_grid->kdjudul->Visible) { // kdjudul ?>
	<?php if ($t_juduldetail_grid->SortUrl($t_juduldetail_grid->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $t_juduldetail_grid->kdjudul->headerCellClass() ?>"><div id="elh_t_juduldetail_kdjudul" class="t_juduldetail_kdjudul"><div class="ew-table-header-caption"><?php echo $t_juduldetail_grid->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $t_juduldetail_grid->kdjudul->headerCellClass() ?>"><div><div id="elh_t_juduldetail_kdjudul" class="t_juduldetail_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_juduldetail_grid->kdjudul->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_juduldetail_grid->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_juduldetail_grid->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_juduldetail_grid->kdkursil->Visible) { // kdkursil ?>
	<?php if ($t_juduldetail_grid->SortUrl($t_juduldetail_grid->kdkursil) == "") { ?>
		<th data-name="kdkursil" class="<?php echo $t_juduldetail_grid->kdkursil->headerCellClass() ?>"><div id="elh_t_juduldetail_kdkursil" class="t_juduldetail_kdkursil"><div class="ew-table-header-caption"><?php echo $t_juduldetail_grid->kdkursil->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkursil" class="<?php echo $t_juduldetail_grid->kdkursil->headerCellClass() ?>"><div><div id="elh_t_juduldetail_kdkursil" class="t_juduldetail_kdkursil">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_juduldetail_grid->kdkursil->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_juduldetail_grid->kdkursil->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_juduldetail_grid->kdkursil->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_juduldetail_grid->revisi->Visible) { // revisi ?>
	<?php if ($t_juduldetail_grid->SortUrl($t_juduldetail_grid->revisi) == "") { ?>
		<th data-name="revisi" class="<?php echo $t_juduldetail_grid->revisi->headerCellClass() ?>"><div id="elh_t_juduldetail_revisi" class="t_juduldetail_revisi"><div class="ew-table-header-caption"><?php echo $t_juduldetail_grid->revisi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revisi" class="<?php echo $t_juduldetail_grid->revisi->headerCellClass() ?>"><div><div id="elh_t_juduldetail_revisi" class="t_juduldetail_revisi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_juduldetail_grid->revisi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_juduldetail_grid->revisi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_juduldetail_grid->revisi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_juduldetail_grid->tgl_terbit->Visible) { // tgl_terbit ?>
	<?php if ($t_juduldetail_grid->SortUrl($t_juduldetail_grid->tgl_terbit) == "") { ?>
		<th data-name="tgl_terbit" class="<?php echo $t_juduldetail_grid->tgl_terbit->headerCellClass() ?>"><div id="elh_t_juduldetail_tgl_terbit" class="t_juduldetail_tgl_terbit"><div class="ew-table-header-caption"><?php echo $t_juduldetail_grid->tgl_terbit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_terbit" class="<?php echo $t_juduldetail_grid->tgl_terbit->headerCellClass() ?>"><div><div id="elh_t_juduldetail_tgl_terbit" class="t_juduldetail_tgl_terbit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_juduldetail_grid->tgl_terbit->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_juduldetail_grid->tgl_terbit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_juduldetail_grid->tgl_terbit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_juduldetail_grid->deskripsi_singkat->Visible) { // deskripsi_singkat ?>
	<?php if ($t_juduldetail_grid->SortUrl($t_juduldetail_grid->deskripsi_singkat) == "") { ?>
		<th data-name="deskripsi_singkat" class="<?php echo $t_juduldetail_grid->deskripsi_singkat->headerCellClass() ?>"><div id="elh_t_juduldetail_deskripsi_singkat" class="t_juduldetail_deskripsi_singkat"><div class="ew-table-header-caption"><?php echo $t_juduldetail_grid->deskripsi_singkat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="deskripsi_singkat" class="<?php echo $t_juduldetail_grid->deskripsi_singkat->headerCellClass() ?>"><div><div id="elh_t_juduldetail_deskripsi_singkat" class="t_juduldetail_deskripsi_singkat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_juduldetail_grid->deskripsi_singkat->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_juduldetail_grid->deskripsi_singkat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_juduldetail_grid->deskripsi_singkat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_juduldetail_grid->tujuan->Visible) { // tujuan ?>
	<?php if ($t_juduldetail_grid->SortUrl($t_juduldetail_grid->tujuan) == "") { ?>
		<th data-name="tujuan" class="<?php echo $t_juduldetail_grid->tujuan->headerCellClass() ?>"><div id="elh_t_juduldetail_tujuan" class="t_juduldetail_tujuan"><div class="ew-table-header-caption"><?php echo $t_juduldetail_grid->tujuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tujuan" class="<?php echo $t_juduldetail_grid->tujuan->headerCellClass() ?>"><div><div id="elh_t_juduldetail_tujuan" class="t_juduldetail_tujuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_juduldetail_grid->tujuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_juduldetail_grid->tujuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_juduldetail_grid->tujuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_juduldetail_grid->target_peserta->Visible) { // target_peserta ?>
	<?php if ($t_juduldetail_grid->SortUrl($t_juduldetail_grid->target_peserta) == "") { ?>
		<th data-name="target_peserta" class="<?php echo $t_juduldetail_grid->target_peserta->headerCellClass() ?>"><div id="elh_t_juduldetail_target_peserta" class="t_juduldetail_target_peserta"><div class="ew-table-header-caption"><?php echo $t_juduldetail_grid->target_peserta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="target_peserta" class="<?php echo $t_juduldetail_grid->target_peserta->headerCellClass() ?>"><div><div id="elh_t_juduldetail_target_peserta" class="t_juduldetail_target_peserta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_juduldetail_grid->target_peserta->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_juduldetail_grid->target_peserta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_juduldetail_grid->target_peserta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_juduldetail_grid->lama_pelatihan->Visible) { // lama_pelatihan ?>
	<?php if ($t_juduldetail_grid->SortUrl($t_juduldetail_grid->lama_pelatihan) == "") { ?>
		<th data-name="lama_pelatihan" class="<?php echo $t_juduldetail_grid->lama_pelatihan->headerCellClass() ?>"><div id="elh_t_juduldetail_lama_pelatihan" class="t_juduldetail_lama_pelatihan"><div class="ew-table-header-caption"><?php echo $t_juduldetail_grid->lama_pelatihan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lama_pelatihan" class="<?php echo $t_juduldetail_grid->lama_pelatihan->headerCellClass() ?>"><div><div id="elh_t_juduldetail_lama_pelatihan" class="t_juduldetail_lama_pelatihan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_juduldetail_grid->lama_pelatihan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_juduldetail_grid->lama_pelatihan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_juduldetail_grid->lama_pelatihan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_juduldetail_grid->catatan->Visible) { // catatan ?>
	<?php if ($t_juduldetail_grid->SortUrl($t_juduldetail_grid->catatan) == "") { ?>
		<th data-name="catatan" class="<?php echo $t_juduldetail_grid->catatan->headerCellClass() ?>"><div id="elh_t_juduldetail_catatan" class="t_juduldetail_catatan"><div class="ew-table-header-caption"><?php echo $t_juduldetail_grid->catatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="catatan" class="<?php echo $t_juduldetail_grid->catatan->headerCellClass() ?>"><div><div id="elh_t_juduldetail_catatan" class="t_juduldetail_catatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_juduldetail_grid->catatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_juduldetail_grid->catatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_juduldetail_grid->catatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_juduldetail_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_juduldetail_grid->StartRecord = 1;
$t_juduldetail_grid->StopRecord = $t_juduldetail_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($t_juduldetail->isConfirm() || $t_juduldetail_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_juduldetail_grid->FormKeyCountName) && ($t_juduldetail_grid->isGridAdd() || $t_juduldetail_grid->isGridEdit() || $t_juduldetail->isConfirm())) {
		$t_juduldetail_grid->KeyCount = $CurrentForm->getValue($t_juduldetail_grid->FormKeyCountName);
		$t_juduldetail_grid->StopRecord = $t_juduldetail_grid->StartRecord + $t_juduldetail_grid->KeyCount - 1;
	}
}
$t_juduldetail_grid->RecordCount = $t_juduldetail_grid->StartRecord - 1;
if ($t_juduldetail_grid->Recordset && !$t_juduldetail_grid->Recordset->EOF) {
	$t_juduldetail_grid->Recordset->moveFirst();
	$selectLimit = $t_juduldetail_grid->UseSelectLimit;
	if (!$selectLimit && $t_juduldetail_grid->StartRecord > 1)
		$t_juduldetail_grid->Recordset->move($t_juduldetail_grid->StartRecord - 1);
} elseif (!$t_juduldetail->AllowAddDeleteRow && $t_juduldetail_grid->StopRecord == 0) {
	$t_juduldetail_grid->StopRecord = $t_juduldetail->GridAddRowCount;
}

// Initialize aggregate
$t_juduldetail->RowType = ROWTYPE_AGGREGATEINIT;
$t_juduldetail->resetAttributes();
$t_juduldetail_grid->renderRow();
if ($t_juduldetail_grid->isGridAdd())
	$t_juduldetail_grid->RowIndex = 0;
if ($t_juduldetail_grid->isGridEdit())
	$t_juduldetail_grid->RowIndex = 0;
while ($t_juduldetail_grid->RecordCount < $t_juduldetail_grid->StopRecord) {
	$t_juduldetail_grid->RecordCount++;
	if ($t_juduldetail_grid->RecordCount >= $t_juduldetail_grid->StartRecord) {
		$t_juduldetail_grid->RowCount++;
		if ($t_juduldetail_grid->isGridAdd() || $t_juduldetail_grid->isGridEdit() || $t_juduldetail->isConfirm()) {
			$t_juduldetail_grid->RowIndex++;
			$CurrentForm->Index = $t_juduldetail_grid->RowIndex;
			if ($CurrentForm->hasValue($t_juduldetail_grid->FormActionName) && ($t_juduldetail->isConfirm() || $t_juduldetail_grid->EventCancelled))
				$t_juduldetail_grid->RowAction = strval($CurrentForm->getValue($t_juduldetail_grid->FormActionName));
			elseif ($t_juduldetail_grid->isGridAdd())
				$t_juduldetail_grid->RowAction = "insert";
			else
				$t_juduldetail_grid->RowAction = "";
		}

		// Set up key count
		$t_juduldetail_grid->KeyCount = $t_juduldetail_grid->RowIndex;

		// Init row class and style
		$t_juduldetail->resetAttributes();
		$t_juduldetail->CssClass = "";
		if ($t_juduldetail_grid->isGridAdd()) {
			if ($t_juduldetail->CurrentMode == "copy") {
				$t_juduldetail_grid->loadRowValues($t_juduldetail_grid->Recordset); // Load row values
				$t_juduldetail_grid->setRecordKey($t_juduldetail_grid->RowOldKey, $t_juduldetail_grid->Recordset); // Set old record key
			} else {
				$t_juduldetail_grid->loadRowValues(); // Load default values
				$t_juduldetail_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_juduldetail_grid->loadRowValues($t_juduldetail_grid->Recordset); // Load row values
		}
		$t_juduldetail->RowType = ROWTYPE_VIEW; // Render view
		if ($t_juduldetail_grid->isGridAdd()) // Grid add
			$t_juduldetail->RowType = ROWTYPE_ADD; // Render add
		if ($t_juduldetail_grid->isGridAdd() && $t_juduldetail->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_juduldetail_grid->restoreCurrentRowFormValues($t_juduldetail_grid->RowIndex); // Restore form values
		if ($t_juduldetail_grid->isGridEdit()) { // Grid edit
			if ($t_juduldetail->EventCancelled)
				$t_juduldetail_grid->restoreCurrentRowFormValues($t_juduldetail_grid->RowIndex); // Restore form values
			if ($t_juduldetail_grid->RowAction == "insert")
				$t_juduldetail->RowType = ROWTYPE_ADD; // Render add
			else
				$t_juduldetail->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_juduldetail_grid->isGridEdit() && ($t_juduldetail->RowType == ROWTYPE_EDIT || $t_juduldetail->RowType == ROWTYPE_ADD) && $t_juduldetail->EventCancelled) // Update failed
			$t_juduldetail_grid->restoreCurrentRowFormValues($t_juduldetail_grid->RowIndex); // Restore form values
		if ($t_juduldetail->RowType == ROWTYPE_EDIT) // Edit row
			$t_juduldetail_grid->EditRowCount++;
		if ($t_juduldetail->isConfirm()) // Confirm row
			$t_juduldetail_grid->restoreCurrentRowFormValues($t_juduldetail_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_juduldetail->RowAttrs->merge(["data-rowindex" => $t_juduldetail_grid->RowCount, "id" => "r" . $t_juduldetail_grid->RowCount . "_t_juduldetail", "data-rowtype" => $t_juduldetail->RowType]);

		// Render row
		$t_juduldetail_grid->renderRow();

		// Render list options
		$t_juduldetail_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_juduldetail_grid->RowAction != "delete" && $t_juduldetail_grid->RowAction != "insertdelete" && !($t_juduldetail_grid->RowAction == "insert" && $t_juduldetail->isConfirm() && $t_juduldetail_grid->emptyRow())) {
?>
	<tr <?php echo $t_juduldetail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_juduldetail_grid->ListOptions->render("body", "left", $t_juduldetail_grid->RowCount);
?>
	<?php if ($t_juduldetail_grid->singbagian->Visible) { // singbagian ?>
		<td data-name="singbagian" <?php echo $t_juduldetail_grid->singbagian->cellAttributes() ?>>
<?php if ($t_juduldetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_singbagian" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_juduldetail" data-field="x_singbagian" data-value-separator="<?php echo $t_juduldetail_grid->singbagian->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_singbagian" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_singbagian"<?php echo $t_juduldetail_grid->singbagian->editAttributes() ?>>
			<?php echo $t_juduldetail_grid->singbagian->selectOptionListHtml("x{$t_juduldetail_grid->RowIndex}_singbagian") ?>
		</select>
</div>
<?php echo $t_juduldetail_grid->singbagian->Lookup->getParamTag($t_juduldetail_grid, "p_x" . $t_juduldetail_grid->RowIndex . "_singbagian") ?>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_singbagian" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_singbagian" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_singbagian" value="<?php echo HtmlEncode($t_juduldetail_grid->singbagian->OldValue) ?>">
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_singbagian" class="form-group">
<span<?php echo $t_juduldetail_grid->singbagian->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_juduldetail_grid->singbagian->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_singbagian" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_singbagian" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_singbagian" value="<?php echo HtmlEncode($t_juduldetail_grid->singbagian->CurrentValue) ?>">
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_singbagian">
<span<?php echo $t_juduldetail_grid->singbagian->viewAttributes() ?>><?php echo $t_juduldetail_grid->singbagian->getViewValue() ?></span>
</span>
<?php if (!$t_juduldetail->isConfirm()) { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_singbagian" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_singbagian" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_singbagian" value="<?php echo HtmlEncode($t_juduldetail_grid->singbagian->FormValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_singbagian" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_singbagian" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_singbagian" value="<?php echo HtmlEncode($t_juduldetail_grid->singbagian->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_singbagian" name="ft_juduldetailgrid$x<?php echo $t_juduldetail_grid->RowIndex ?>_singbagian" id="ft_juduldetailgrid$x<?php echo $t_juduldetail_grid->RowIndex ?>_singbagian" value="<?php echo HtmlEncode($t_juduldetail_grid->singbagian->FormValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_singbagian" name="ft_juduldetailgrid$o<?php echo $t_juduldetail_grid->RowIndex ?>_singbagian" id="ft_juduldetailgrid$o<?php echo $t_juduldetail_grid->RowIndex ?>_singbagian" value="<?php echo HtmlEncode($t_juduldetail_grid->singbagian->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_detailjdid" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_detailjdid" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_detailjdid" value="<?php echo HtmlEncode($t_juduldetail_grid->detailjdid->CurrentValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_detailjdid" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_detailjdid" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_detailjdid" value="<?php echo HtmlEncode($t_juduldetail_grid->detailjdid->OldValue) ?>">
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_EDIT || $t_juduldetail->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_detailjdid" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_detailjdid" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_detailjdid" value="<?php echo HtmlEncode($t_juduldetail_grid->detailjdid->CurrentValue) ?>">
<?php } ?>
	<?php if ($t_juduldetail_grid->jpel->Visible) { // jpel ?>
		<td data-name="jpel" <?php echo $t_juduldetail_grid->jpel->cellAttributes() ?>>
<?php if ($t_juduldetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_jpel" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_juduldetail" data-field="x_jpel" data-value-separator="<?php echo $t_juduldetail_grid->jpel->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_jpel" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_jpel"<?php echo $t_juduldetail_grid->jpel->editAttributes() ?>>
			<?php echo $t_juduldetail_grid->jpel->selectOptionListHtml("x{$t_juduldetail_grid->RowIndex}_jpel") ?>
		</select>
</div>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_jpel" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_jpel" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_jpel" value="<?php echo HtmlEncode($t_juduldetail_grid->jpel->OldValue) ?>">
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_jpel" class="form-group">
<span<?php echo $t_juduldetail_grid->jpel->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_juduldetail_grid->jpel->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_jpel" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_jpel" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_jpel" value="<?php echo HtmlEncode($t_juduldetail_grid->jpel->CurrentValue) ?>">
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_jpel">
<span<?php echo $t_juduldetail_grid->jpel->viewAttributes() ?>><?php echo $t_juduldetail_grid->jpel->getViewValue() ?></span>
</span>
<?php if (!$t_juduldetail->isConfirm()) { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_jpel" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_jpel" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_jpel" value="<?php echo HtmlEncode($t_juduldetail_grid->jpel->FormValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_jpel" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_jpel" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_jpel" value="<?php echo HtmlEncode($t_juduldetail_grid->jpel->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_jpel" name="ft_juduldetailgrid$x<?php echo $t_juduldetail_grid->RowIndex ?>_jpel" id="ft_juduldetailgrid$x<?php echo $t_juduldetail_grid->RowIndex ?>_jpel" value="<?php echo HtmlEncode($t_juduldetail_grid->jpel->FormValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_jpel" name="ft_juduldetailgrid$o<?php echo $t_juduldetail_grid->RowIndex ?>_jpel" id="ft_juduldetailgrid$o<?php echo $t_juduldetail_grid->RowIndex ?>_jpel" value="<?php echo HtmlEncode($t_juduldetail_grid->jpel->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_juduldetail_grid->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $t_juduldetail_grid->kdjudul->cellAttributes() ?>>
<?php if ($t_juduldetail->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($t_juduldetail_grid->kdjudul->getSessionValue() != "") { ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_kdjudul" class="form-group">
<span<?php echo $t_juduldetail_grid->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_juduldetail_grid->kdjudul->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_juduldetail_grid->kdjudul->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_kdjudul" class="form-group">
<?php
$onchange = $t_juduldetail_grid->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_juduldetail_grid->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul">
	<input type="text" class="form-control" name="sv_x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" id="sv_x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" value="<?php echo RemoveHtml($t_juduldetail_grid->kdjudul->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($t_juduldetail_grid->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_juduldetail_grid->kdjudul->getPlaceHolder()) ?>"<?php echo $t_juduldetail_grid->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_kdjudul" data-value-separator="<?php echo $t_juduldetail_grid->kdjudul->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_juduldetail_grid->kdjudul->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_juduldetailgrid"], function() {
	ft_juduldetailgrid.createAutoSuggest({"id":"x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul","forceSelect":true,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $t_juduldetail_grid->kdjudul->Lookup->getParamTag($t_juduldetail_grid, "p_x" . $t_juduldetail_grid->RowIndex . "_kdjudul") ?>
</span>
<?php } ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_kdjudul" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_juduldetail_grid->kdjudul->OldValue) ?>">
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_kdjudul" class="form-group">
<span<?php echo $t_juduldetail_grid->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_juduldetail_grid->kdjudul->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_kdjudul" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_juduldetail_grid->kdjudul->CurrentValue) ?>">
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_kdjudul">
<span<?php echo $t_juduldetail_grid->kdjudul->viewAttributes() ?>><?php echo $t_juduldetail_grid->kdjudul->getViewValue() ?></span>
</span>
<?php if (!$t_juduldetail->isConfirm()) { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_kdjudul" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_juduldetail_grid->kdjudul->FormValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_kdjudul" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_juduldetail_grid->kdjudul->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_kdjudul" name="ft_juduldetailgrid$x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" id="ft_juduldetailgrid$x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_juduldetail_grid->kdjudul->FormValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_kdjudul" name="ft_juduldetailgrid$o<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" id="ft_juduldetailgrid$o<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_juduldetail_grid->kdjudul->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_juduldetail_grid->kdkursil->Visible) { // kdkursil ?>
		<td data-name="kdkursil" <?php echo $t_juduldetail_grid->kdkursil->cellAttributes() ?>>
<?php if ($t_juduldetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_kdkursil" class="form-group">
<input type="text" data-table="t_juduldetail" data-field="x_kdkursil" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdkursil" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdkursil" size="12" maxlength="20" placeholder="<?php echo HtmlEncode($t_juduldetail_grid->kdkursil->getPlaceHolder()) ?>" value="<?php echo $t_juduldetail_grid->kdkursil->EditValue ?>"<?php echo $t_juduldetail_grid->kdkursil->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_kdkursil" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_kdkursil" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_juduldetail_grid->kdkursil->OldValue) ?>">
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_kdkursil" class="form-group">
<span<?php echo $t_juduldetail_grid->kdkursil->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_juduldetail_grid->kdkursil->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_kdkursil" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdkursil" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_juduldetail_grid->kdkursil->CurrentValue) ?>">
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_kdkursil">
<span<?php echo $t_juduldetail_grid->kdkursil->viewAttributes() ?>><?php echo $t_juduldetail_grid->kdkursil->getViewValue() ?></span>
</span>
<?php if (!$t_juduldetail->isConfirm()) { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_kdkursil" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdkursil" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_juduldetail_grid->kdkursil->FormValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_kdkursil" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_kdkursil" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_juduldetail_grid->kdkursil->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_kdkursil" name="ft_juduldetailgrid$x<?php echo $t_juduldetail_grid->RowIndex ?>_kdkursil" id="ft_juduldetailgrid$x<?php echo $t_juduldetail_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_juduldetail_grid->kdkursil->FormValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_kdkursil" name="ft_juduldetailgrid$o<?php echo $t_juduldetail_grid->RowIndex ?>_kdkursil" id="ft_juduldetailgrid$o<?php echo $t_juduldetail_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_juduldetail_grid->kdkursil->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_juduldetail_grid->revisi->Visible) { // revisi ?>
		<td data-name="revisi" <?php echo $t_juduldetail_grid->revisi->cellAttributes() ?>>
<?php if ($t_juduldetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_revisi" class="form-group">
<input type="text" data-table="t_juduldetail" data-field="x_revisi" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_revisi" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_revisi" size="2" maxlength="2" placeholder="<?php echo HtmlEncode($t_juduldetail_grid->revisi->getPlaceHolder()) ?>" value="<?php echo $t_juduldetail_grid->revisi->EditValue ?>"<?php echo $t_juduldetail_grid->revisi->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_revisi" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_revisi" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_revisi" value="<?php echo HtmlEncode($t_juduldetail_grid->revisi->OldValue) ?>">
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_revisi" class="form-group">
<span<?php echo $t_juduldetail_grid->revisi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_juduldetail_grid->revisi->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_revisi" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_revisi" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_revisi" value="<?php echo HtmlEncode($t_juduldetail_grid->revisi->CurrentValue) ?>">
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_revisi">
<span<?php echo $t_juduldetail_grid->revisi->viewAttributes() ?>><?php echo $t_juduldetail_grid->revisi->getViewValue() ?></span>
</span>
<?php if (!$t_juduldetail->isConfirm()) { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_revisi" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_revisi" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_revisi" value="<?php echo HtmlEncode($t_juduldetail_grid->revisi->FormValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_revisi" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_revisi" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_revisi" value="<?php echo HtmlEncode($t_juduldetail_grid->revisi->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_revisi" name="ft_juduldetailgrid$x<?php echo $t_juduldetail_grid->RowIndex ?>_revisi" id="ft_juduldetailgrid$x<?php echo $t_juduldetail_grid->RowIndex ?>_revisi" value="<?php echo HtmlEncode($t_juduldetail_grid->revisi->FormValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_revisi" name="ft_juduldetailgrid$o<?php echo $t_juduldetail_grid->RowIndex ?>_revisi" id="ft_juduldetailgrid$o<?php echo $t_juduldetail_grid->RowIndex ?>_revisi" value="<?php echo HtmlEncode($t_juduldetail_grid->revisi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_juduldetail_grid->tgl_terbit->Visible) { // tgl_terbit ?>
		<td data-name="tgl_terbit" <?php echo $t_juduldetail_grid->tgl_terbit->cellAttributes() ?>>
<?php if ($t_juduldetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_tgl_terbit" class="form-group">
<input type="text" data-table="t_juduldetail" data-field="x_tgl_terbit" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit" size="7" maxlength="10" placeholder="<?php echo HtmlEncode($t_juduldetail_grid->tgl_terbit->getPlaceHolder()) ?>" value="<?php echo $t_juduldetail_grid->tgl_terbit->EditValue ?>"<?php echo $t_juduldetail_grid->tgl_terbit->editAttributes() ?>>
<?php if (!$t_juduldetail_grid->tgl_terbit->ReadOnly && !$t_juduldetail_grid->tgl_terbit->Disabled && !isset($t_juduldetail_grid->tgl_terbit->EditAttrs["readonly"]) && !isset($t_juduldetail_grid->tgl_terbit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_juduldetailgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_juduldetailgrid", "x<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_tgl_terbit" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit" value="<?php echo HtmlEncode($t_juduldetail_grid->tgl_terbit->OldValue) ?>">
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_tgl_terbit" class="form-group">
<input type="text" data-table="t_juduldetail" data-field="x_tgl_terbit" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit" size="7" maxlength="10" placeholder="<?php echo HtmlEncode($t_juduldetail_grid->tgl_terbit->getPlaceHolder()) ?>" value="<?php echo $t_juduldetail_grid->tgl_terbit->EditValue ?>"<?php echo $t_juduldetail_grid->tgl_terbit->editAttributes() ?>>
<?php if (!$t_juduldetail_grid->tgl_terbit->ReadOnly && !$t_juduldetail_grid->tgl_terbit->Disabled && !isset($t_juduldetail_grid->tgl_terbit->EditAttrs["readonly"]) && !isset($t_juduldetail_grid->tgl_terbit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_juduldetailgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_juduldetailgrid", "x<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_tgl_terbit">
<span<?php echo $t_juduldetail_grid->tgl_terbit->viewAttributes() ?>><?php echo $t_juduldetail_grid->tgl_terbit->getViewValue() ?></span>
</span>
<?php if (!$t_juduldetail->isConfirm()) { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_tgl_terbit" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit" value="<?php echo HtmlEncode($t_juduldetail_grid->tgl_terbit->FormValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_tgl_terbit" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit" value="<?php echo HtmlEncode($t_juduldetail_grid->tgl_terbit->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_tgl_terbit" name="ft_juduldetailgrid$x<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit" id="ft_juduldetailgrid$x<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit" value="<?php echo HtmlEncode($t_juduldetail_grid->tgl_terbit->FormValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_tgl_terbit" name="ft_juduldetailgrid$o<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit" id="ft_juduldetailgrid$o<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit" value="<?php echo HtmlEncode($t_juduldetail_grid->tgl_terbit->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_juduldetail_grid->deskripsi_singkat->Visible) { // deskripsi_singkat ?>
		<td data-name="deskripsi_singkat" <?php echo $t_juduldetail_grid->deskripsi_singkat->cellAttributes() ?>>
<?php if ($t_juduldetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_deskripsi_singkat" class="form-group">
<textarea data-table="t_juduldetail" data-field="x_deskripsi_singkat" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_deskripsi_singkat" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_deskripsi_singkat" cols="95" rows="6" placeholder="<?php echo HtmlEncode($t_juduldetail_grid->deskripsi_singkat->getPlaceHolder()) ?>"<?php echo $t_juduldetail_grid->deskripsi_singkat->editAttributes() ?>><?php echo $t_juduldetail_grid->deskripsi_singkat->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_deskripsi_singkat" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_deskripsi_singkat" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_deskripsi_singkat" value="<?php echo HtmlEncode($t_juduldetail_grid->deskripsi_singkat->OldValue) ?>">
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_deskripsi_singkat" class="form-group">
<textarea data-table="t_juduldetail" data-field="x_deskripsi_singkat" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_deskripsi_singkat" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_deskripsi_singkat" cols="95" rows="6" placeholder="<?php echo HtmlEncode($t_juduldetail_grid->deskripsi_singkat->getPlaceHolder()) ?>"<?php echo $t_juduldetail_grid->deskripsi_singkat->editAttributes() ?>><?php echo $t_juduldetail_grid->deskripsi_singkat->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_deskripsi_singkat">
<span<?php echo $t_juduldetail_grid->deskripsi_singkat->viewAttributes() ?>><?php if (!EmptyString($t_juduldetail_grid->deskripsi_singkat->TooltipValue) && $t_juduldetail_grid->deskripsi_singkat->linkAttributes() != "") { ?>
<a<?php echo $t_juduldetail_grid->deskripsi_singkat->linkAttributes() ?>><?php echo $t_juduldetail_grid->deskripsi_singkat->getViewValue() ?></a>
<?php } else { ?>
<?php echo $t_juduldetail_grid->deskripsi_singkat->getViewValue() ?>
<?php } ?>
<span id="tt_t_juduldetail_x<?php echo $t_juduldetail_grid->RowCount ?>_deskripsi_singkat" class="d-none">
<?php echo $t_juduldetail_grid->deskripsi_singkat->TooltipValue ?>
</span></span>
</span>
<?php if (!$t_juduldetail->isConfirm()) { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_deskripsi_singkat" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_deskripsi_singkat" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_deskripsi_singkat" value="<?php echo HtmlEncode($t_juduldetail_grid->deskripsi_singkat->FormValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_deskripsi_singkat" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_deskripsi_singkat" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_deskripsi_singkat" value="<?php echo HtmlEncode($t_juduldetail_grid->deskripsi_singkat->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_deskripsi_singkat" name="ft_juduldetailgrid$x<?php echo $t_juduldetail_grid->RowIndex ?>_deskripsi_singkat" id="ft_juduldetailgrid$x<?php echo $t_juduldetail_grid->RowIndex ?>_deskripsi_singkat" value="<?php echo HtmlEncode($t_juduldetail_grid->deskripsi_singkat->FormValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_deskripsi_singkat" name="ft_juduldetailgrid$o<?php echo $t_juduldetail_grid->RowIndex ?>_deskripsi_singkat" id="ft_juduldetailgrid$o<?php echo $t_juduldetail_grid->RowIndex ?>_deskripsi_singkat" value="<?php echo HtmlEncode($t_juduldetail_grid->deskripsi_singkat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_juduldetail_grid->tujuan->Visible) { // tujuan ?>
		<td data-name="tujuan" <?php echo $t_juduldetail_grid->tujuan->cellAttributes() ?>>
<?php if ($t_juduldetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_tujuan" class="form-group">
<textarea data-table="t_juduldetail" data-field="x_tujuan" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_tujuan" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_tujuan" cols="95" rows="2" placeholder="<?php echo HtmlEncode($t_juduldetail_grid->tujuan->getPlaceHolder()) ?>"<?php echo $t_juduldetail_grid->tujuan->editAttributes() ?>><?php echo $t_juduldetail_grid->tujuan->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_tujuan" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_tujuan" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_tujuan" value="<?php echo HtmlEncode($t_juduldetail_grid->tujuan->OldValue) ?>">
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_tujuan" class="form-group">
<textarea data-table="t_juduldetail" data-field="x_tujuan" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_tujuan" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_tujuan" cols="95" rows="2" placeholder="<?php echo HtmlEncode($t_juduldetail_grid->tujuan->getPlaceHolder()) ?>"<?php echo $t_juduldetail_grid->tujuan->editAttributes() ?>><?php echo $t_juduldetail_grid->tujuan->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_tujuan">
<span<?php echo $t_juduldetail_grid->tujuan->viewAttributes() ?>><?php if (!EmptyString($t_juduldetail_grid->tujuan->TooltipValue) && $t_juduldetail_grid->tujuan->linkAttributes() != "") { ?>
<a<?php echo $t_juduldetail_grid->tujuan->linkAttributes() ?>><?php echo $t_juduldetail_grid->tujuan->getViewValue() ?></a>
<?php } else { ?>
<?php echo $t_juduldetail_grid->tujuan->getViewValue() ?>
<?php } ?>
<span id="tt_t_juduldetail_x<?php echo $t_juduldetail_grid->RowCount ?>_tujuan" class="d-none">
<?php echo $t_juduldetail_grid->tujuan->TooltipValue ?>
</span></span>
</span>
<?php if (!$t_juduldetail->isConfirm()) { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_tujuan" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_tujuan" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_tujuan" value="<?php echo HtmlEncode($t_juduldetail_grid->tujuan->FormValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_tujuan" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_tujuan" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_tujuan" value="<?php echo HtmlEncode($t_juduldetail_grid->tujuan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_tujuan" name="ft_juduldetailgrid$x<?php echo $t_juduldetail_grid->RowIndex ?>_tujuan" id="ft_juduldetailgrid$x<?php echo $t_juduldetail_grid->RowIndex ?>_tujuan" value="<?php echo HtmlEncode($t_juduldetail_grid->tujuan->FormValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_tujuan" name="ft_juduldetailgrid$o<?php echo $t_juduldetail_grid->RowIndex ?>_tujuan" id="ft_juduldetailgrid$o<?php echo $t_juduldetail_grid->RowIndex ?>_tujuan" value="<?php echo HtmlEncode($t_juduldetail_grid->tujuan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_juduldetail_grid->target_peserta->Visible) { // target_peserta ?>
		<td data-name="target_peserta" <?php echo $t_juduldetail_grid->target_peserta->cellAttributes() ?>>
<?php if ($t_juduldetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_target_peserta" class="form-group">
<textarea data-table="t_juduldetail" data-field="x_target_peserta" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_target_peserta" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_target_peserta" cols="95" rows="2" placeholder="<?php echo HtmlEncode($t_juduldetail_grid->target_peserta->getPlaceHolder()) ?>"<?php echo $t_juduldetail_grid->target_peserta->editAttributes() ?>><?php echo $t_juduldetail_grid->target_peserta->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_target_peserta" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_target_peserta" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_target_peserta" value="<?php echo HtmlEncode($t_juduldetail_grid->target_peserta->OldValue) ?>">
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_target_peserta" class="form-group">
<textarea data-table="t_juduldetail" data-field="x_target_peserta" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_target_peserta" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_target_peserta" cols="95" rows="2" placeholder="<?php echo HtmlEncode($t_juduldetail_grid->target_peserta->getPlaceHolder()) ?>"<?php echo $t_juduldetail_grid->target_peserta->editAttributes() ?>><?php echo $t_juduldetail_grid->target_peserta->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_target_peserta">
<span<?php echo $t_juduldetail_grid->target_peserta->viewAttributes() ?>><?php if (!EmptyString($t_juduldetail_grid->target_peserta->TooltipValue) && $t_juduldetail_grid->target_peserta->linkAttributes() != "") { ?>
<a<?php echo $t_juduldetail_grid->target_peserta->linkAttributes() ?>><?php echo $t_juduldetail_grid->target_peserta->getViewValue() ?></a>
<?php } else { ?>
<?php echo $t_juduldetail_grid->target_peserta->getViewValue() ?>
<?php } ?>
<span id="tt_t_juduldetail_x<?php echo $t_juduldetail_grid->RowCount ?>_target_peserta" class="d-none">
<?php echo $t_juduldetail_grid->target_peserta->TooltipValue ?>
</span></span>
</span>
<?php if (!$t_juduldetail->isConfirm()) { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_target_peserta" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_target_peserta" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_target_peserta" value="<?php echo HtmlEncode($t_juduldetail_grid->target_peserta->FormValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_target_peserta" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_target_peserta" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_target_peserta" value="<?php echo HtmlEncode($t_juduldetail_grid->target_peserta->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_target_peserta" name="ft_juduldetailgrid$x<?php echo $t_juduldetail_grid->RowIndex ?>_target_peserta" id="ft_juduldetailgrid$x<?php echo $t_juduldetail_grid->RowIndex ?>_target_peserta" value="<?php echo HtmlEncode($t_juduldetail_grid->target_peserta->FormValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_target_peserta" name="ft_juduldetailgrid$o<?php echo $t_juduldetail_grid->RowIndex ?>_target_peserta" id="ft_juduldetailgrid$o<?php echo $t_juduldetail_grid->RowIndex ?>_target_peserta" value="<?php echo HtmlEncode($t_juduldetail_grid->target_peserta->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_juduldetail_grid->lama_pelatihan->Visible) { // lama_pelatihan ?>
		<td data-name="lama_pelatihan" <?php echo $t_juduldetail_grid->lama_pelatihan->cellAttributes() ?>>
<?php if ($t_juduldetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_lama_pelatihan" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_juduldetail" data-field="x_lama_pelatihan" data-value-separator="<?php echo $t_juduldetail_grid->lama_pelatihan->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_lama_pelatihan" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_lama_pelatihan"<?php echo $t_juduldetail_grid->lama_pelatihan->editAttributes() ?>>
			<?php echo $t_juduldetail_grid->lama_pelatihan->selectOptionListHtml("x{$t_juduldetail_grid->RowIndex}_lama_pelatihan") ?>
		</select>
</div>
<?php echo $t_juduldetail_grid->lama_pelatihan->Lookup->getParamTag($t_juduldetail_grid, "p_x" . $t_juduldetail_grid->RowIndex . "_lama_pelatihan") ?>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_lama_pelatihan" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_lama_pelatihan" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_lama_pelatihan" value="<?php echo HtmlEncode($t_juduldetail_grid->lama_pelatihan->OldValue) ?>">
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_lama_pelatihan" class="form-group">
<span<?php echo $t_juduldetail_grid->lama_pelatihan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_juduldetail_grid->lama_pelatihan->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_lama_pelatihan" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_lama_pelatihan" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_lama_pelatihan" value="<?php echo HtmlEncode($t_juduldetail_grid->lama_pelatihan->CurrentValue) ?>">
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_lama_pelatihan">
<span<?php echo $t_juduldetail_grid->lama_pelatihan->viewAttributes() ?>><?php echo $t_juduldetail_grid->lama_pelatihan->getViewValue() ?></span>
</span>
<?php if (!$t_juduldetail->isConfirm()) { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_lama_pelatihan" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_lama_pelatihan" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_lama_pelatihan" value="<?php echo HtmlEncode($t_juduldetail_grid->lama_pelatihan->FormValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_lama_pelatihan" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_lama_pelatihan" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_lama_pelatihan" value="<?php echo HtmlEncode($t_juduldetail_grid->lama_pelatihan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_lama_pelatihan" name="ft_juduldetailgrid$x<?php echo $t_juduldetail_grid->RowIndex ?>_lama_pelatihan" id="ft_juduldetailgrid$x<?php echo $t_juduldetail_grid->RowIndex ?>_lama_pelatihan" value="<?php echo HtmlEncode($t_juduldetail_grid->lama_pelatihan->FormValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_lama_pelatihan" name="ft_juduldetailgrid$o<?php echo $t_juduldetail_grid->RowIndex ?>_lama_pelatihan" id="ft_juduldetailgrid$o<?php echo $t_juduldetail_grid->RowIndex ?>_lama_pelatihan" value="<?php echo HtmlEncode($t_juduldetail_grid->lama_pelatihan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_juduldetail_grid->catatan->Visible) { // catatan ?>
		<td data-name="catatan" <?php echo $t_juduldetail_grid->catatan->cellAttributes() ?>>
<?php if ($t_juduldetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_catatan" class="form-group">
<textarea data-table="t_juduldetail" data-field="x_catatan" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_catatan" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_catatan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_juduldetail_grid->catatan->getPlaceHolder()) ?>"<?php echo $t_juduldetail_grid->catatan->editAttributes() ?>><?php echo $t_juduldetail_grid->catatan->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_catatan" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_catatan" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_catatan" value="<?php echo HtmlEncode($t_juduldetail_grid->catatan->OldValue) ?>">
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_catatan" class="form-group">
<textarea data-table="t_juduldetail" data-field="x_catatan" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_catatan" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_catatan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_juduldetail_grid->catatan->getPlaceHolder()) ?>"<?php echo $t_juduldetail_grid->catatan->editAttributes() ?>><?php echo $t_juduldetail_grid->catatan->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t_juduldetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_juduldetail_grid->RowCount ?>_t_juduldetail_catatan">
<span<?php echo $t_juduldetail_grid->catatan->viewAttributes() ?>><?php echo $t_juduldetail_grid->catatan->getViewValue() ?></span>
</span>
<?php if (!$t_juduldetail->isConfirm()) { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_catatan" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_catatan" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_catatan" value="<?php echo HtmlEncode($t_juduldetail_grid->catatan->FormValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_catatan" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_catatan" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_catatan" value="<?php echo HtmlEncode($t_juduldetail_grid->catatan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_catatan" name="ft_juduldetailgrid$x<?php echo $t_juduldetail_grid->RowIndex ?>_catatan" id="ft_juduldetailgrid$x<?php echo $t_juduldetail_grid->RowIndex ?>_catatan" value="<?php echo HtmlEncode($t_juduldetail_grid->catatan->FormValue) ?>">
<input type="hidden" data-table="t_juduldetail" data-field="x_catatan" name="ft_juduldetailgrid$o<?php echo $t_juduldetail_grid->RowIndex ?>_catatan" id="ft_juduldetailgrid$o<?php echo $t_juduldetail_grid->RowIndex ?>_catatan" value="<?php echo HtmlEncode($t_juduldetail_grid->catatan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_juduldetail_grid->ListOptions->render("body", "right", $t_juduldetail_grid->RowCount);
?>
	</tr>
<?php if ($t_juduldetail->RowType == ROWTYPE_ADD || $t_juduldetail->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_juduldetailgrid", "load"], function() {
	ft_juduldetailgrid.updateLists(<?php echo $t_juduldetail_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_juduldetail_grid->isGridAdd() || $t_juduldetail->CurrentMode == "copy")
		if (!$t_juduldetail_grid->Recordset->EOF)
			$t_juduldetail_grid->Recordset->moveNext();
}
?>
<?php
	if ($t_juduldetail->CurrentMode == "add" || $t_juduldetail->CurrentMode == "copy" || $t_juduldetail->CurrentMode == "edit") {
		$t_juduldetail_grid->RowIndex = '$rowindex$';
		$t_juduldetail_grid->loadRowValues();

		// Set row properties
		$t_juduldetail->resetAttributes();
		$t_juduldetail->RowAttrs->merge(["data-rowindex" => $t_juduldetail_grid->RowIndex, "id" => "r0_t_juduldetail", "data-rowtype" => ROWTYPE_ADD]);
		$t_juduldetail->RowAttrs->appendClass("ew-template");
		$t_juduldetail->RowType = ROWTYPE_ADD;

		// Render row
		$t_juduldetail_grid->renderRow();

		// Render list options
		$t_juduldetail_grid->renderListOptions();
		$t_juduldetail_grid->StartRowCount = 0;
?>
	<tr <?php echo $t_juduldetail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_juduldetail_grid->ListOptions->render("body", "left", $t_juduldetail_grid->RowIndex);
?>
	<?php if ($t_juduldetail_grid->singbagian->Visible) { // singbagian ?>
		<td data-name="singbagian">
<?php if (!$t_juduldetail->isConfirm()) { ?>
<span id="el$rowindex$_t_juduldetail_singbagian" class="form-group t_juduldetail_singbagian">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_juduldetail" data-field="x_singbagian" data-value-separator="<?php echo $t_juduldetail_grid->singbagian->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_singbagian" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_singbagian"<?php echo $t_juduldetail_grid->singbagian->editAttributes() ?>>
			<?php echo $t_juduldetail_grid->singbagian->selectOptionListHtml("x{$t_juduldetail_grid->RowIndex}_singbagian") ?>
		</select>
</div>
<?php echo $t_juduldetail_grid->singbagian->Lookup->getParamTag($t_juduldetail_grid, "p_x" . $t_juduldetail_grid->RowIndex . "_singbagian") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_juduldetail_singbagian" class="form-group t_juduldetail_singbagian">
<span<?php echo $t_juduldetail_grid->singbagian->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_juduldetail_grid->singbagian->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_singbagian" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_singbagian" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_singbagian" value="<?php echo HtmlEncode($t_juduldetail_grid->singbagian->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_singbagian" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_singbagian" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_singbagian" value="<?php echo HtmlEncode($t_juduldetail_grid->singbagian->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_juduldetail_grid->jpel->Visible) { // jpel ?>
		<td data-name="jpel">
<?php if (!$t_juduldetail->isConfirm()) { ?>
<span id="el$rowindex$_t_juduldetail_jpel" class="form-group t_juduldetail_jpel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_juduldetail" data-field="x_jpel" data-value-separator="<?php echo $t_juduldetail_grid->jpel->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_jpel" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_jpel"<?php echo $t_juduldetail_grid->jpel->editAttributes() ?>>
			<?php echo $t_juduldetail_grid->jpel->selectOptionListHtml("x{$t_juduldetail_grid->RowIndex}_jpel") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_juduldetail_jpel" class="form-group t_juduldetail_jpel">
<span<?php echo $t_juduldetail_grid->jpel->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_juduldetail_grid->jpel->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_jpel" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_jpel" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_jpel" value="<?php echo HtmlEncode($t_juduldetail_grid->jpel->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_jpel" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_jpel" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_jpel" value="<?php echo HtmlEncode($t_juduldetail_grid->jpel->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_juduldetail_grid->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul">
<?php if (!$t_juduldetail->isConfirm()) { ?>
<?php if ($t_juduldetail_grid->kdjudul->getSessionValue() != "") { ?>
<span id="el$rowindex$_t_juduldetail_kdjudul" class="form-group t_juduldetail_kdjudul">
<span<?php echo $t_juduldetail_grid->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_juduldetail_grid->kdjudul->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_juduldetail_grid->kdjudul->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_juduldetail_kdjudul" class="form-group t_juduldetail_kdjudul">
<?php
$onchange = $t_juduldetail_grid->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_juduldetail_grid->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul">
	<input type="text" class="form-control" name="sv_x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" id="sv_x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" value="<?php echo RemoveHtml($t_juduldetail_grid->kdjudul->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($t_juduldetail_grid->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_juduldetail_grid->kdjudul->getPlaceHolder()) ?>"<?php echo $t_juduldetail_grid->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_kdjudul" data-value-separator="<?php echo $t_juduldetail_grid->kdjudul->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_juduldetail_grid->kdjudul->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_juduldetailgrid"], function() {
	ft_juduldetailgrid.createAutoSuggest({"id":"x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul","forceSelect":true,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $t_juduldetail_grid->kdjudul->Lookup->getParamTag($t_juduldetail_grid, "p_x" . $t_juduldetail_grid->RowIndex . "_kdjudul") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t_juduldetail_kdjudul" class="form-group t_juduldetail_kdjudul">
<span<?php echo $t_juduldetail_grid->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_juduldetail_grid->kdjudul->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_kdjudul" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_juduldetail_grid->kdjudul->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_kdjudul" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_juduldetail_grid->kdjudul->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_juduldetail_grid->kdkursil->Visible) { // kdkursil ?>
		<td data-name="kdkursil">
<?php if (!$t_juduldetail->isConfirm()) { ?>
<span id="el$rowindex$_t_juduldetail_kdkursil" class="form-group t_juduldetail_kdkursil">
<input type="text" data-table="t_juduldetail" data-field="x_kdkursil" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdkursil" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdkursil" size="12" maxlength="20" placeholder="<?php echo HtmlEncode($t_juduldetail_grid->kdkursil->getPlaceHolder()) ?>" value="<?php echo $t_juduldetail_grid->kdkursil->EditValue ?>"<?php echo $t_juduldetail_grid->kdkursil->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_juduldetail_kdkursil" class="form-group t_juduldetail_kdkursil">
<span<?php echo $t_juduldetail_grid->kdkursil->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_juduldetail_grid->kdkursil->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_kdkursil" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdkursil" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_juduldetail_grid->kdkursil->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_kdkursil" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_kdkursil" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_juduldetail_grid->kdkursil->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_juduldetail_grid->revisi->Visible) { // revisi ?>
		<td data-name="revisi">
<?php if (!$t_juduldetail->isConfirm()) { ?>
<span id="el$rowindex$_t_juduldetail_revisi" class="form-group t_juduldetail_revisi">
<input type="text" data-table="t_juduldetail" data-field="x_revisi" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_revisi" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_revisi" size="2" maxlength="2" placeholder="<?php echo HtmlEncode($t_juduldetail_grid->revisi->getPlaceHolder()) ?>" value="<?php echo $t_juduldetail_grid->revisi->EditValue ?>"<?php echo $t_juduldetail_grid->revisi->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_juduldetail_revisi" class="form-group t_juduldetail_revisi">
<span<?php echo $t_juduldetail_grid->revisi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_juduldetail_grid->revisi->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_revisi" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_revisi" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_revisi" value="<?php echo HtmlEncode($t_juduldetail_grid->revisi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_revisi" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_revisi" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_revisi" value="<?php echo HtmlEncode($t_juduldetail_grid->revisi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_juduldetail_grid->tgl_terbit->Visible) { // tgl_terbit ?>
		<td data-name="tgl_terbit">
<?php if (!$t_juduldetail->isConfirm()) { ?>
<span id="el$rowindex$_t_juduldetail_tgl_terbit" class="form-group t_juduldetail_tgl_terbit">
<input type="text" data-table="t_juduldetail" data-field="x_tgl_terbit" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit" size="7" maxlength="10" placeholder="<?php echo HtmlEncode($t_juduldetail_grid->tgl_terbit->getPlaceHolder()) ?>" value="<?php echo $t_juduldetail_grid->tgl_terbit->EditValue ?>"<?php echo $t_juduldetail_grid->tgl_terbit->editAttributes() ?>>
<?php if (!$t_juduldetail_grid->tgl_terbit->ReadOnly && !$t_juduldetail_grid->tgl_terbit->Disabled && !isset($t_juduldetail_grid->tgl_terbit->EditAttrs["readonly"]) && !isset($t_juduldetail_grid->tgl_terbit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_juduldetailgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_juduldetailgrid", "x<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_juduldetail_tgl_terbit" class="form-group t_juduldetail_tgl_terbit">
<span<?php echo $t_juduldetail_grid->tgl_terbit->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_juduldetail_grid->tgl_terbit->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_tgl_terbit" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit" value="<?php echo HtmlEncode($t_juduldetail_grid->tgl_terbit->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_tgl_terbit" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_tgl_terbit" value="<?php echo HtmlEncode($t_juduldetail_grid->tgl_terbit->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_juduldetail_grid->deskripsi_singkat->Visible) { // deskripsi_singkat ?>
		<td data-name="deskripsi_singkat">
<?php if (!$t_juduldetail->isConfirm()) { ?>
<span id="el$rowindex$_t_juduldetail_deskripsi_singkat" class="form-group t_juduldetail_deskripsi_singkat">
<textarea data-table="t_juduldetail" data-field="x_deskripsi_singkat" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_deskripsi_singkat" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_deskripsi_singkat" cols="95" rows="6" placeholder="<?php echo HtmlEncode($t_juduldetail_grid->deskripsi_singkat->getPlaceHolder()) ?>"<?php echo $t_juduldetail_grid->deskripsi_singkat->editAttributes() ?>><?php echo $t_juduldetail_grid->deskripsi_singkat->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_juduldetail_deskripsi_singkat" class="form-group t_juduldetail_deskripsi_singkat">
<span<?php echo $t_juduldetail_grid->deskripsi_singkat->viewAttributes() ?>><?php if (!EmptyString($t_juduldetail_grid->deskripsi_singkat->TooltipValue) && $t_juduldetail_grid->deskripsi_singkat->linkAttributes() != "") { ?>
<a<?php echo $t_juduldetail_grid->deskripsi_singkat->linkAttributes() ?>><?php echo $t_juduldetail_grid->deskripsi_singkat->ViewValue ?></a>
<?php } else { ?>
<?php echo $t_juduldetail_grid->deskripsi_singkat->ViewValue ?>
<?php } ?>
<span id="tt_t_juduldetail_x<?php echo $t_juduldetail_grid->RowCount ?>_deskripsi_singkat" class="d-none">
<?php echo $t_juduldetail_grid->deskripsi_singkat->TooltipValue ?>
</span></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_deskripsi_singkat" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_deskripsi_singkat" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_deskripsi_singkat" value="<?php echo HtmlEncode($t_juduldetail_grid->deskripsi_singkat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_deskripsi_singkat" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_deskripsi_singkat" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_deskripsi_singkat" value="<?php echo HtmlEncode($t_juduldetail_grid->deskripsi_singkat->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_juduldetail_grid->tujuan->Visible) { // tujuan ?>
		<td data-name="tujuan">
<?php if (!$t_juduldetail->isConfirm()) { ?>
<span id="el$rowindex$_t_juduldetail_tujuan" class="form-group t_juduldetail_tujuan">
<textarea data-table="t_juduldetail" data-field="x_tujuan" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_tujuan" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_tujuan" cols="95" rows="2" placeholder="<?php echo HtmlEncode($t_juduldetail_grid->tujuan->getPlaceHolder()) ?>"<?php echo $t_juduldetail_grid->tujuan->editAttributes() ?>><?php echo $t_juduldetail_grid->tujuan->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_juduldetail_tujuan" class="form-group t_juduldetail_tujuan">
<span<?php echo $t_juduldetail_grid->tujuan->viewAttributes() ?>><?php if (!EmptyString($t_juduldetail_grid->tujuan->TooltipValue) && $t_juduldetail_grid->tujuan->linkAttributes() != "") { ?>
<a<?php echo $t_juduldetail_grid->tujuan->linkAttributes() ?>><?php echo $t_juduldetail_grid->tujuan->ViewValue ?></a>
<?php } else { ?>
<?php echo $t_juduldetail_grid->tujuan->ViewValue ?>
<?php } ?>
<span id="tt_t_juduldetail_x<?php echo $t_juduldetail_grid->RowCount ?>_tujuan" class="d-none">
<?php echo $t_juduldetail_grid->tujuan->TooltipValue ?>
</span></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_tujuan" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_tujuan" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_tujuan" value="<?php echo HtmlEncode($t_juduldetail_grid->tujuan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_tujuan" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_tujuan" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_tujuan" value="<?php echo HtmlEncode($t_juduldetail_grid->tujuan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_juduldetail_grid->target_peserta->Visible) { // target_peserta ?>
		<td data-name="target_peserta">
<?php if (!$t_juduldetail->isConfirm()) { ?>
<span id="el$rowindex$_t_juduldetail_target_peserta" class="form-group t_juduldetail_target_peserta">
<textarea data-table="t_juduldetail" data-field="x_target_peserta" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_target_peserta" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_target_peserta" cols="95" rows="2" placeholder="<?php echo HtmlEncode($t_juduldetail_grid->target_peserta->getPlaceHolder()) ?>"<?php echo $t_juduldetail_grid->target_peserta->editAttributes() ?>><?php echo $t_juduldetail_grid->target_peserta->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_juduldetail_target_peserta" class="form-group t_juduldetail_target_peserta">
<span<?php echo $t_juduldetail_grid->target_peserta->viewAttributes() ?>><?php if (!EmptyString($t_juduldetail_grid->target_peserta->TooltipValue) && $t_juduldetail_grid->target_peserta->linkAttributes() != "") { ?>
<a<?php echo $t_juduldetail_grid->target_peserta->linkAttributes() ?>><?php echo $t_juduldetail_grid->target_peserta->ViewValue ?></a>
<?php } else { ?>
<?php echo $t_juduldetail_grid->target_peserta->ViewValue ?>
<?php } ?>
<span id="tt_t_juduldetail_x<?php echo $t_juduldetail_grid->RowCount ?>_target_peserta" class="d-none">
<?php echo $t_juduldetail_grid->target_peserta->TooltipValue ?>
</span></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_target_peserta" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_target_peserta" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_target_peserta" value="<?php echo HtmlEncode($t_juduldetail_grid->target_peserta->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_target_peserta" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_target_peserta" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_target_peserta" value="<?php echo HtmlEncode($t_juduldetail_grid->target_peserta->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_juduldetail_grid->lama_pelatihan->Visible) { // lama_pelatihan ?>
		<td data-name="lama_pelatihan">
<?php if (!$t_juduldetail->isConfirm()) { ?>
<span id="el$rowindex$_t_juduldetail_lama_pelatihan" class="form-group t_juduldetail_lama_pelatihan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_juduldetail" data-field="x_lama_pelatihan" data-value-separator="<?php echo $t_juduldetail_grid->lama_pelatihan->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_lama_pelatihan" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_lama_pelatihan"<?php echo $t_juduldetail_grid->lama_pelatihan->editAttributes() ?>>
			<?php echo $t_juduldetail_grid->lama_pelatihan->selectOptionListHtml("x{$t_juduldetail_grid->RowIndex}_lama_pelatihan") ?>
		</select>
</div>
<?php echo $t_juduldetail_grid->lama_pelatihan->Lookup->getParamTag($t_juduldetail_grid, "p_x" . $t_juduldetail_grid->RowIndex . "_lama_pelatihan") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_juduldetail_lama_pelatihan" class="form-group t_juduldetail_lama_pelatihan">
<span<?php echo $t_juduldetail_grid->lama_pelatihan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_juduldetail_grid->lama_pelatihan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_lama_pelatihan" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_lama_pelatihan" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_lama_pelatihan" value="<?php echo HtmlEncode($t_juduldetail_grid->lama_pelatihan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_lama_pelatihan" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_lama_pelatihan" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_lama_pelatihan" value="<?php echo HtmlEncode($t_juduldetail_grid->lama_pelatihan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_juduldetail_grid->catatan->Visible) { // catatan ?>
		<td data-name="catatan">
<?php if (!$t_juduldetail->isConfirm()) { ?>
<span id="el$rowindex$_t_juduldetail_catatan" class="form-group t_juduldetail_catatan">
<textarea data-table="t_juduldetail" data-field="x_catatan" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_catatan" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_catatan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_juduldetail_grid->catatan->getPlaceHolder()) ?>"<?php echo $t_juduldetail_grid->catatan->editAttributes() ?>><?php echo $t_juduldetail_grid->catatan->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_juduldetail_catatan" class="form-group t_juduldetail_catatan">
<span<?php echo $t_juduldetail_grid->catatan->viewAttributes() ?>><?php echo $t_juduldetail_grid->catatan->ViewValue ?></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_catatan" name="x<?php echo $t_juduldetail_grid->RowIndex ?>_catatan" id="x<?php echo $t_juduldetail_grid->RowIndex ?>_catatan" value="<?php echo HtmlEncode($t_juduldetail_grid->catatan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_juduldetail" data-field="x_catatan" name="o<?php echo $t_juduldetail_grid->RowIndex ?>_catatan" id="o<?php echo $t_juduldetail_grid->RowIndex ?>_catatan" value="<?php echo HtmlEncode($t_juduldetail_grid->catatan->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_juduldetail_grid->ListOptions->render("body", "right", $t_juduldetail_grid->RowIndex);
?>
<script>
loadjs.ready(["ft_juduldetailgrid", "load"], function() {
	ft_juduldetailgrid.updateLists(<?php echo $t_juduldetail_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($t_juduldetail->CurrentMode == "add" || $t_juduldetail->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $t_juduldetail_grid->FormKeyCountName ?>" id="<?php echo $t_juduldetail_grid->FormKeyCountName ?>" value="<?php echo $t_juduldetail_grid->KeyCount ?>">
<?php echo $t_juduldetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_juduldetail->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $t_juduldetail_grid->FormKeyCountName ?>" id="<?php echo $t_juduldetail_grid->FormKeyCountName ?>" value="<?php echo $t_juduldetail_grid->KeyCount ?>">
<?php echo $t_juduldetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_juduldetail->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_juduldetailgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_juduldetail_grid->Recordset)
	$t_juduldetail_grid->Recordset->Close();
?>
<?php if ($t_juduldetail_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $t_juduldetail_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_juduldetail_grid->TotalRecords == 0 && !$t_juduldetail->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_juduldetail_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$t_juduldetail_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$("button.ewDetail").hide();
});
</script>
<?php } ?>
<?php
$t_juduldetail_grid->terminate();
?>