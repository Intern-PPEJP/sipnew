<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($t_pelatihan_grid))
	$t_pelatihan_grid = new t_pelatihan_grid();

// Run the page
$t_pelatihan_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pelatihan_grid->Page_Render();
?>
<?php if (!$t_pelatihan_grid->isExport()) { ?>
<script>
var ft_pelatihangrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	ft_pelatihangrid = new ew.Form("ft_pelatihangrid", "grid");
	ft_pelatihangrid.formKeyCountName = '<?php echo $t_pelatihan_grid->FormKeyCountName ?>';

	// Validate form
	ft_pelatihangrid.validate = function() {
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
			<?php if ($t_pelatihan_grid->kdjudul->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjudul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_grid->kdjudul->caption(), $t_pelatihan_grid->kdjudul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_grid->tawal->Required) { ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_grid->tawal->caption(), $t_pelatihan_grid->tawal->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_grid->takhir->Required) { ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_grid->takhir->caption(), $t_pelatihan_grid->takhir->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_grid->tglpel->Required) { ?>
				elm = this.getElements("x" + infix + "_tglpel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_grid->tglpel->caption(), $t_pelatihan_grid->tglpel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_grid->jenispel->Required) { ?>
				elm = this.getElements("x" + infix + "_jenispel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_grid->jenispel->caption(), $t_pelatihan_grid->jenispel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_grid->kerjasama->Required) { ?>
				elm = this.getElements("x" + infix + "_kerjasama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_grid->kerjasama->caption(), $t_pelatihan_grid->kerjasama->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kerjasama");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_grid->kerjasama->errorMessage()) ?>");
			<?php if ($t_pelatihan_grid->biaya->Required) { ?>
				elm = this.getElements("x" + infix + "_biaya");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_grid->biaya->caption(), $t_pelatihan_grid->biaya->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_biaya");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_grid->biaya->errorMessage()) ?>");
			<?php if ($t_pelatihan_grid->coachingprogr->Required) { ?>
				elm = this.getElements("x" + infix + "_coachingprogr");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_grid->coachingprogr->caption(), $t_pelatihan_grid->coachingprogr->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_grid->area->Required) { ?>
				elm = this.getElements("x" + infix + "_area");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_grid->area->caption(), $t_pelatihan_grid->area->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_grid->periode_awal->Required) { ?>
				elm = this.getElements("x" + infix + "_periode_awal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_grid->periode_awal->caption(), $t_pelatihan_grid->periode_awal->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_grid->periode_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_periode_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_grid->periode_akhir->caption(), $t_pelatihan_grid->periode_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_periode_akhir");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_grid->periode_akhir->errorMessage()) ?>");
			<?php if ($t_pelatihan_grid->tahapan->Required) { ?>
				elm = this.getElements("x" + infix + "_tahapan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_grid->tahapan->caption(), $t_pelatihan_grid->tahapan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_grid->namaberkas->Required) { ?>
				felm = this.getElements("x" + infix + "_namaberkas");
				elm = this.getElements("fn_x" + infix + "_namaberkas");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_grid->namaberkas->caption(), $t_pelatihan_grid->namaberkas->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_grid->instruktur->Required) { ?>
				elm = this.getElements("x" + infix + "_instruktur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_grid->instruktur->caption(), $t_pelatihan_grid->instruktur->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_grid->tempat->Required) { ?>
				elm = this.getElements("x" + infix + "_tempat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_grid->tempat->caption(), $t_pelatihan_grid->tempat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_grid->jpeserta->Required) { ?>
				elm = this.getElements("x" + infix + "_jpeserta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_grid->jpeserta->caption(), $t_pelatihan_grid->jpeserta->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jpeserta");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_grid->jpeserta->errorMessage()) ?>");
			<?php if ($t_pelatihan_grid->targetpes->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_grid->targetpes->caption(), $t_pelatihan_grid->targetpes->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_grid->targetpes->errorMessage()) ?>");
			<?php if ($t_pelatihan_grid->Tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_Tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_grid->Tahun->caption(), $t_pelatihan_grid->Tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Tahun");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_grid->Tahun->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	ft_pelatihangrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "kdjudul", false)) return false;
		if (ew.valueChanged(fobj, infix, "tawal", false)) return false;
		if (ew.valueChanged(fobj, infix, "takhir", false)) return false;
		if (ew.valueChanged(fobj, infix, "tglpel", false)) return false;
		if (ew.valueChanged(fobj, infix, "jenispel", false)) return false;
		if (ew.valueChanged(fobj, infix, "kerjasama", false)) return false;
		if (ew.valueChanged(fobj, infix, "biaya", false)) return false;
		if (ew.valueChanged(fobj, infix, "coachingprogr", false)) return false;
		if (ew.valueChanged(fobj, infix, "area", false)) return false;
		if (ew.valueChanged(fobj, infix, "periode_awal", false)) return false;
		if (ew.valueChanged(fobj, infix, "periode_akhir", false)) return false;
		if (ew.valueChanged(fobj, infix, "tahapan", false)) return false;
		if (ew.valueChanged(fobj, infix, "namaberkas", false)) return false;
		if (ew.valueChanged(fobj, infix, "instruktur", false)) return false;
		if (ew.valueChanged(fobj, infix, "tempat", false)) return false;
		if (ew.valueChanged(fobj, infix, "jpeserta", false)) return false;
		if (ew.valueChanged(fobj, infix, "targetpes", false)) return false;
		if (ew.valueChanged(fobj, infix, "Tahun", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_pelatihangrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_pelatihangrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_pelatihangrid.lists["x_kdjudul"] = <?php echo $t_pelatihan_grid->kdjudul->Lookup->toClientList($t_pelatihan_grid) ?>;
	ft_pelatihangrid.lists["x_kdjudul"].options = <?php echo JsonEncode($t_pelatihan_grid->kdjudul->lookupOptions()) ?>;
	ft_pelatihangrid.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pelatihangrid.lists["x_jenispel"] = <?php echo $t_pelatihan_grid->jenispel->Lookup->toClientList($t_pelatihan_grid) ?>;
	ft_pelatihangrid.lists["x_jenispel"].options = <?php echo JsonEncode($t_pelatihan_grid->jenispel->options(FALSE, TRUE)) ?>;
	ft_pelatihangrid.lists["x_kerjasama"] = <?php echo $t_pelatihan_grid->kerjasama->Lookup->toClientList($t_pelatihan_grid) ?>;
	ft_pelatihangrid.lists["x_kerjasama"].options = <?php echo JsonEncode($t_pelatihan_grid->kerjasama->lookupOptions()) ?>;
	ft_pelatihangrid.autoSuggests["x_kerjasama"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pelatihangrid.lists["x_coachingprogr"] = <?php echo $t_pelatihan_grid->coachingprogr->Lookup->toClientList($t_pelatihan_grid) ?>;
	ft_pelatihangrid.lists["x_coachingprogr"].options = <?php echo JsonEncode($t_pelatihan_grid->coachingprogr->options(FALSE, TRUE)) ?>;
	ft_pelatihangrid.lists["x_tahapan"] = <?php echo $t_pelatihan_grid->tahapan->Lookup->toClientList($t_pelatihan_grid) ?>;
	ft_pelatihangrid.lists["x_tahapan"].options = <?php echo JsonEncode($t_pelatihan_grid->tahapan->lookupOptions()) ?>;
	loadjs.done("ft_pelatihangrid");
});
</script>
<script>
ew.ready("head", "js/ewfixedheadertable.js", "fixedheadertable");
</script>
<?php } ?>
<?php
$t_pelatihan_grid->renderOtherOptions();
?>
<?php if ($t_pelatihan_grid->TotalRecords > 0 || $t_pelatihan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_pelatihan_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_pelatihan">
<?php if ($t_pelatihan_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $t_pelatihan_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ft_pelatihangrid" class="ew-form ew-list-form form-inline">
<div id="gmp_t_pelatihan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_t_pelatihangrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_pelatihan->RowType = ROWTYPE_HEADER;

// Render list options
$t_pelatihan_grid->renderListOptions();

// Render list options (header, left)
$t_pelatihan_grid->ListOptions->render("header", "left");
?>
<?php if ($t_pelatihan_grid->kdjudul->Visible) { // kdjudul ?>
	<?php if ($t_pelatihan_grid->SortUrl($t_pelatihan_grid->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $t_pelatihan_grid->kdjudul->headerCellClass() ?>"><div id="elh_t_pelatihan_kdjudul" class="t_pelatihan_kdjudul"><div class="ew-table-header-caption"><?php echo $t_pelatihan_grid->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $t_pelatihan_grid->kdjudul->headerCellClass() ?>"><div><div id="elh_t_pelatihan_kdjudul" class="t_pelatihan_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_grid->kdjudul->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_grid->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_grid->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_grid->tawal->Visible) { // tawal ?>
	<?php if ($t_pelatihan_grid->SortUrl($t_pelatihan_grid->tawal) == "") { ?>
		<th data-name="tawal" class="<?php echo $t_pelatihan_grid->tawal->headerCellClass() ?>"><div id="elh_t_pelatihan_tawal" class="t_pelatihan_tawal"><div class="ew-table-header-caption"><?php echo $t_pelatihan_grid->tawal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tawal" class="<?php echo $t_pelatihan_grid->tawal->headerCellClass() ?>"><div><div id="elh_t_pelatihan_tawal" class="t_pelatihan_tawal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_grid->tawal->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_grid->tawal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_grid->tawal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_grid->takhir->Visible) { // takhir ?>
	<?php if ($t_pelatihan_grid->SortUrl($t_pelatihan_grid->takhir) == "") { ?>
		<th data-name="takhir" class="<?php echo $t_pelatihan_grid->takhir->headerCellClass() ?>"><div id="elh_t_pelatihan_takhir" class="t_pelatihan_takhir"><div class="ew-table-header-caption"><?php echo $t_pelatihan_grid->takhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="takhir" class="<?php echo $t_pelatihan_grid->takhir->headerCellClass() ?>"><div><div id="elh_t_pelatihan_takhir" class="t_pelatihan_takhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_grid->takhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_grid->takhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_grid->takhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_grid->tglpel->Visible) { // tglpel ?>
	<?php if ($t_pelatihan_grid->SortUrl($t_pelatihan_grid->tglpel) == "") { ?>
		<th data-name="tglpel" class="<?php echo $t_pelatihan_grid->tglpel->headerCellClass() ?>"><div id="elh_t_pelatihan_tglpel" class="t_pelatihan_tglpel"><div class="ew-table-header-caption"><?php echo $t_pelatihan_grid->tglpel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tglpel" class="<?php echo $t_pelatihan_grid->tglpel->headerCellClass() ?>"><div><div id="elh_t_pelatihan_tglpel" class="t_pelatihan_tglpel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_grid->tglpel->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_grid->tglpel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_grid->tglpel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_grid->jenispel->Visible) { // jenispel ?>
	<?php if ($t_pelatihan_grid->SortUrl($t_pelatihan_grid->jenispel) == "") { ?>
		<th data-name="jenispel" class="<?php echo $t_pelatihan_grid->jenispel->headerCellClass() ?>"><div id="elh_t_pelatihan_jenispel" class="t_pelatihan_jenispel"><div class="ew-table-header-caption"><?php echo $t_pelatihan_grid->jenispel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenispel" class="<?php echo $t_pelatihan_grid->jenispel->headerCellClass() ?>"><div><div id="elh_t_pelatihan_jenispel" class="t_pelatihan_jenispel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_grid->jenispel->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_grid->jenispel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_grid->jenispel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_grid->kerjasama->Visible) { // kerjasama ?>
	<?php if ($t_pelatihan_grid->SortUrl($t_pelatihan_grid->kerjasama) == "") { ?>
		<th data-name="kerjasama" class="<?php echo $t_pelatihan_grid->kerjasama->headerCellClass() ?>"><div id="elh_t_pelatihan_kerjasama" class="t_pelatihan_kerjasama"><div class="ew-table-header-caption"><?php echo $t_pelatihan_grid->kerjasama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kerjasama" class="<?php echo $t_pelatihan_grid->kerjasama->headerCellClass() ?>"><div><div id="elh_t_pelatihan_kerjasama" class="t_pelatihan_kerjasama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_grid->kerjasama->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_grid->kerjasama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_grid->kerjasama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_grid->biaya->Visible) { // biaya ?>
	<?php if ($t_pelatihan_grid->SortUrl($t_pelatihan_grid->biaya) == "") { ?>
		<th data-name="biaya" class="<?php echo $t_pelatihan_grid->biaya->headerCellClass() ?>"><div id="elh_t_pelatihan_biaya" class="t_pelatihan_biaya"><div class="ew-table-header-caption"><?php echo $t_pelatihan_grid->biaya->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="biaya" class="<?php echo $t_pelatihan_grid->biaya->headerCellClass() ?>"><div><div id="elh_t_pelatihan_biaya" class="t_pelatihan_biaya">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_grid->biaya->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_grid->biaya->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_grid->biaya->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_grid->coachingprogr->Visible) { // coachingprogr ?>
	<?php if ($t_pelatihan_grid->SortUrl($t_pelatihan_grid->coachingprogr) == "") { ?>
		<th data-name="coachingprogr" class="<?php echo $t_pelatihan_grid->coachingprogr->headerCellClass() ?>"><div id="elh_t_pelatihan_coachingprogr" class="t_pelatihan_coachingprogr"><div class="ew-table-header-caption"><?php echo $t_pelatihan_grid->coachingprogr->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="coachingprogr" class="<?php echo $t_pelatihan_grid->coachingprogr->headerCellClass() ?>"><div><div id="elh_t_pelatihan_coachingprogr" class="t_pelatihan_coachingprogr">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_grid->coachingprogr->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_grid->coachingprogr->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_grid->coachingprogr->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_grid->area->Visible) { // area ?>
	<?php if ($t_pelatihan_grid->SortUrl($t_pelatihan_grid->area) == "") { ?>
		<th data-name="area" class="<?php echo $t_pelatihan_grid->area->headerCellClass() ?>"><div id="elh_t_pelatihan_area" class="t_pelatihan_area"><div class="ew-table-header-caption"><?php echo $t_pelatihan_grid->area->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="area" class="<?php echo $t_pelatihan_grid->area->headerCellClass() ?>"><div><div id="elh_t_pelatihan_area" class="t_pelatihan_area">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_grid->area->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_grid->area->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_grid->area->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_grid->periode_awal->Visible) { // periode_awal ?>
	<?php if ($t_pelatihan_grid->SortUrl($t_pelatihan_grid->periode_awal) == "") { ?>
		<th data-name="periode_awal" class="<?php echo $t_pelatihan_grid->periode_awal->headerCellClass() ?>"><div id="elh_t_pelatihan_periode_awal" class="t_pelatihan_periode_awal"><div class="ew-table-header-caption"><?php echo $t_pelatihan_grid->periode_awal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="periode_awal" class="<?php echo $t_pelatihan_grid->periode_awal->headerCellClass() ?>"><div><div id="elh_t_pelatihan_periode_awal" class="t_pelatihan_periode_awal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_grid->periode_awal->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_grid->periode_awal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_grid->periode_awal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_grid->periode_akhir->Visible) { // periode_akhir ?>
	<?php if ($t_pelatihan_grid->SortUrl($t_pelatihan_grid->periode_akhir) == "") { ?>
		<th data-name="periode_akhir" class="<?php echo $t_pelatihan_grid->periode_akhir->headerCellClass() ?>"><div id="elh_t_pelatihan_periode_akhir" class="t_pelatihan_periode_akhir"><div class="ew-table-header-caption"><?php echo $t_pelatihan_grid->periode_akhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="periode_akhir" class="<?php echo $t_pelatihan_grid->periode_akhir->headerCellClass() ?>"><div><div id="elh_t_pelatihan_periode_akhir" class="t_pelatihan_periode_akhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_grid->periode_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_grid->periode_akhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_grid->periode_akhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_grid->tahapan->Visible) { // tahapan ?>
	<?php if ($t_pelatihan_grid->SortUrl($t_pelatihan_grid->tahapan) == "") { ?>
		<th data-name="tahapan" class="<?php echo $t_pelatihan_grid->tahapan->headerCellClass() ?>"><div id="elh_t_pelatihan_tahapan" class="t_pelatihan_tahapan"><div class="ew-table-header-caption"><?php echo $t_pelatihan_grid->tahapan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahapan" class="<?php echo $t_pelatihan_grid->tahapan->headerCellClass() ?>"><div><div id="elh_t_pelatihan_tahapan" class="t_pelatihan_tahapan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_grid->tahapan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_grid->tahapan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_grid->tahapan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_grid->namaberkas->Visible) { // namaberkas ?>
	<?php if ($t_pelatihan_grid->SortUrl($t_pelatihan_grid->namaberkas) == "") { ?>
		<th data-name="namaberkas" class="<?php echo $t_pelatihan_grid->namaberkas->headerCellClass() ?>"><div id="elh_t_pelatihan_namaberkas" class="t_pelatihan_namaberkas"><div class="ew-table-header-caption"><?php echo $t_pelatihan_grid->namaberkas->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="namaberkas" class="<?php echo $t_pelatihan_grid->namaberkas->headerCellClass() ?>"><div><div id="elh_t_pelatihan_namaberkas" class="t_pelatihan_namaberkas">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_grid->namaberkas->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_grid->namaberkas->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_grid->namaberkas->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_grid->instruktur->Visible) { // instruktur ?>
	<?php if ($t_pelatihan_grid->SortUrl($t_pelatihan_grid->instruktur) == "") { ?>
		<th data-name="instruktur" class="<?php echo $t_pelatihan_grid->instruktur->headerCellClass() ?>"><div id="elh_t_pelatihan_instruktur" class="t_pelatihan_instruktur"><div class="ew-table-header-caption"><?php echo $t_pelatihan_grid->instruktur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="instruktur" class="<?php echo $t_pelatihan_grid->instruktur->headerCellClass() ?>"><div><div id="elh_t_pelatihan_instruktur" class="t_pelatihan_instruktur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_grid->instruktur->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_grid->instruktur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_grid->instruktur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_grid->tempat->Visible) { // tempat ?>
	<?php if ($t_pelatihan_grid->SortUrl($t_pelatihan_grid->tempat) == "") { ?>
		<th data-name="tempat" class="<?php echo $t_pelatihan_grid->tempat->headerCellClass() ?>"><div id="elh_t_pelatihan_tempat" class="t_pelatihan_tempat"><div class="ew-table-header-caption"><?php echo $t_pelatihan_grid->tempat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tempat" class="<?php echo $t_pelatihan_grid->tempat->headerCellClass() ?>"><div><div id="elh_t_pelatihan_tempat" class="t_pelatihan_tempat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_grid->tempat->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_grid->tempat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_grid->tempat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_grid->jpeserta->Visible) { // jpeserta ?>
	<?php if ($t_pelatihan_grid->SortUrl($t_pelatihan_grid->jpeserta) == "") { ?>
		<th data-name="jpeserta" class="<?php echo $t_pelatihan_grid->jpeserta->headerCellClass() ?>"><div id="elh_t_pelatihan_jpeserta" class="t_pelatihan_jpeserta"><div class="ew-table-header-caption"><?php echo $t_pelatihan_grid->jpeserta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jpeserta" class="<?php echo $t_pelatihan_grid->jpeserta->headerCellClass() ?>"><div><div id="elh_t_pelatihan_jpeserta" class="t_pelatihan_jpeserta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_grid->jpeserta->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_grid->jpeserta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_grid->jpeserta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_grid->targetpes->Visible) { // targetpes ?>
	<?php if ($t_pelatihan_grid->SortUrl($t_pelatihan_grid->targetpes) == "") { ?>
		<th data-name="targetpes" class="<?php echo $t_pelatihan_grid->targetpes->headerCellClass() ?>"><div id="elh_t_pelatihan_targetpes" class="t_pelatihan_targetpes"><div class="ew-table-header-caption"><?php echo $t_pelatihan_grid->targetpes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes" class="<?php echo $t_pelatihan_grid->targetpes->headerCellClass() ?>"><div><div id="elh_t_pelatihan_targetpes" class="t_pelatihan_targetpes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_grid->targetpes->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_grid->targetpes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_grid->targetpes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_grid->Tahun->Visible) { // Tahun ?>
	<?php if ($t_pelatihan_grid->SortUrl($t_pelatihan_grid->Tahun) == "") { ?>
		<th data-name="Tahun" class="<?php echo $t_pelatihan_grid->Tahun->headerCellClass() ?>"><div id="elh_t_pelatihan_Tahun" class="t_pelatihan_Tahun"><div class="ew-table-header-caption"><?php echo $t_pelatihan_grid->Tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tahun" class="<?php echo $t_pelatihan_grid->Tahun->headerCellClass() ?>"><div><div id="elh_t_pelatihan_Tahun" class="t_pelatihan_Tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_grid->Tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_grid->Tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_grid->Tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_pelatihan_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_pelatihan_grid->StartRecord = 1;
$t_pelatihan_grid->StopRecord = $t_pelatihan_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($t_pelatihan->isConfirm() || $t_pelatihan_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_pelatihan_grid->FormKeyCountName) && ($t_pelatihan_grid->isGridAdd() || $t_pelatihan_grid->isGridEdit() || $t_pelatihan->isConfirm())) {
		$t_pelatihan_grid->KeyCount = $CurrentForm->getValue($t_pelatihan_grid->FormKeyCountName);
		$t_pelatihan_grid->StopRecord = $t_pelatihan_grid->StartRecord + $t_pelatihan_grid->KeyCount - 1;
	}
}
$t_pelatihan_grid->RecordCount = $t_pelatihan_grid->StartRecord - 1;
if ($t_pelatihan_grid->Recordset && !$t_pelatihan_grid->Recordset->EOF) {
	$t_pelatihan_grid->Recordset->moveFirst();
	$selectLimit = $t_pelatihan_grid->UseSelectLimit;
	if (!$selectLimit && $t_pelatihan_grid->StartRecord > 1)
		$t_pelatihan_grid->Recordset->move($t_pelatihan_grid->StartRecord - 1);
} elseif (!$t_pelatihan->AllowAddDeleteRow && $t_pelatihan_grid->StopRecord == 0) {
	$t_pelatihan_grid->StopRecord = $t_pelatihan->GridAddRowCount;
}

// Initialize aggregate
$t_pelatihan->RowType = ROWTYPE_AGGREGATEINIT;
$t_pelatihan->resetAttributes();
$t_pelatihan_grid->renderRow();
if ($t_pelatihan_grid->isGridAdd())
	$t_pelatihan_grid->RowIndex = 0;
if ($t_pelatihan_grid->isGridEdit())
	$t_pelatihan_grid->RowIndex = 0;
while ($t_pelatihan_grid->RecordCount < $t_pelatihan_grid->StopRecord) {
	$t_pelatihan_grid->RecordCount++;
	if ($t_pelatihan_grid->RecordCount >= $t_pelatihan_grid->StartRecord) {
		$t_pelatihan_grid->RowCount++;
		if ($t_pelatihan_grid->isGridAdd() || $t_pelatihan_grid->isGridEdit() || $t_pelatihan->isConfirm()) {
			$t_pelatihan_grid->RowIndex++;
			$CurrentForm->Index = $t_pelatihan_grid->RowIndex;
			if ($CurrentForm->hasValue($t_pelatihan_grid->FormActionName) && ($t_pelatihan->isConfirm() || $t_pelatihan_grid->EventCancelled))
				$t_pelatihan_grid->RowAction = strval($CurrentForm->getValue($t_pelatihan_grid->FormActionName));
			elseif ($t_pelatihan_grid->isGridAdd())
				$t_pelatihan_grid->RowAction = "insert";
			else
				$t_pelatihan_grid->RowAction = "";
		}

		// Set up key count
		$t_pelatihan_grid->KeyCount = $t_pelatihan_grid->RowIndex;

		// Init row class and style
		$t_pelatihan->resetAttributes();
		$t_pelatihan->CssClass = "";
		if ($t_pelatihan_grid->isGridAdd()) {
			if ($t_pelatihan->CurrentMode == "copy") {
				$t_pelatihan_grid->loadRowValues($t_pelatihan_grid->Recordset); // Load row values
				$t_pelatihan_grid->setRecordKey($t_pelatihan_grid->RowOldKey, $t_pelatihan_grid->Recordset); // Set old record key
			} else {
				$t_pelatihan_grid->loadRowValues(); // Load default values
				$t_pelatihan_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_pelatihan_grid->loadRowValues($t_pelatihan_grid->Recordset); // Load row values
		}
		$t_pelatihan->RowType = ROWTYPE_VIEW; // Render view
		if ($t_pelatihan_grid->isGridAdd()) // Grid add
			$t_pelatihan->RowType = ROWTYPE_ADD; // Render add
		if ($t_pelatihan_grid->isGridAdd() && $t_pelatihan->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_pelatihan_grid->restoreCurrentRowFormValues($t_pelatihan_grid->RowIndex); // Restore form values
		if ($t_pelatihan_grid->isGridEdit()) { // Grid edit
			if ($t_pelatihan->EventCancelled)
				$t_pelatihan_grid->restoreCurrentRowFormValues($t_pelatihan_grid->RowIndex); // Restore form values
			if ($t_pelatihan_grid->RowAction == "insert")
				$t_pelatihan->RowType = ROWTYPE_ADD; // Render add
			else
				$t_pelatihan->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_pelatihan_grid->isGridEdit() && ($t_pelatihan->RowType == ROWTYPE_EDIT || $t_pelatihan->RowType == ROWTYPE_ADD) && $t_pelatihan->EventCancelled) // Update failed
			$t_pelatihan_grid->restoreCurrentRowFormValues($t_pelatihan_grid->RowIndex); // Restore form values
		if ($t_pelatihan->RowType == ROWTYPE_EDIT) // Edit row
			$t_pelatihan_grid->EditRowCount++;
		if ($t_pelatihan->isConfirm()) // Confirm row
			$t_pelatihan_grid->restoreCurrentRowFormValues($t_pelatihan_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_pelatihan->RowAttrs->merge(["data-rowindex" => $t_pelatihan_grid->RowCount, "id" => "r" . $t_pelatihan_grid->RowCount . "_t_pelatihan", "data-rowtype" => $t_pelatihan->RowType]);

		// Render row
		$t_pelatihan_grid->renderRow();

		// Render list options
		$t_pelatihan_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_pelatihan_grid->RowAction != "delete" && $t_pelatihan_grid->RowAction != "insertdelete" && !($t_pelatihan_grid->RowAction == "insert" && $t_pelatihan->isConfirm() && $t_pelatihan_grid->emptyRow())) {
?>
	<tr <?php echo $t_pelatihan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_pelatihan_grid->ListOptions->render("body", "left", $t_pelatihan_grid->RowCount);
?>
	<?php if ($t_pelatihan_grid->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $t_pelatihan_grid->kdjudul->cellAttributes() ?>>
<?php if ($t_pelatihan->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($t_pelatihan_grid->kdjudul->getSessionValue() != "") { ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_kdjudul" class="form-group">
<span<?php echo $t_pelatihan_grid->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_grid->kdjudul->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_pelatihan_grid->kdjudul->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_kdjudul" class="form-group">
<?php
$onchange = $t_pelatihan_grid->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_grid->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul">
	<input type="text" class="form-control" name="sv_x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" id="sv_x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" value="<?php echo RemoveHtml($t_pelatihan_grid->kdjudul->EditValue) ?>" size="100" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_grid->kdjudul->getPlaceHolder()) ?>"<?php echo $t_pelatihan_grid->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_kdjudul" data-value-separator="<?php echo $t_pelatihan_grid->kdjudul->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_pelatihan_grid->kdjudul->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihangrid"], function() {
	ft_pelatihangrid.createAutoSuggest({"id":"x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul","forceSelect":true,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $t_pelatihan_grid->kdjudul->Lookup->getParamTag($t_pelatihan_grid, "p_x" . $t_pelatihan_grid->RowIndex . "_kdjudul") ?>
</span>
<?php } ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_kdjudul" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_pelatihan_grid->kdjudul->OldValue) ?>">
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_kdjudul" class="form-group">
<span<?php echo $t_pelatihan_grid->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_grid->kdjudul->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_kdjudul" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_pelatihan_grid->kdjudul->CurrentValue) ?>">
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_kdjudul">
<span<?php echo $t_pelatihan_grid->kdjudul->viewAttributes() ?>><?php echo $t_pelatihan_grid->kdjudul->getViewValue() ?></span>
</span>
<?php if (!$t_pelatihan->isConfirm()) { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_kdjudul" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_pelatihan_grid->kdjudul->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_kdjudul" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_pelatihan_grid->kdjudul->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_kdjudul" name="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" id="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_pelatihan_grid->kdjudul->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_kdjudul" name="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" id="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_pelatihan_grid->kdjudul->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_idpelat" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_idpelat" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_idpelat" value="<?php echo HtmlEncode($t_pelatihan_grid->idpelat->CurrentValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_idpelat" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_idpelat" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_idpelat" value="<?php echo HtmlEncode($t_pelatihan_grid->idpelat->OldValue) ?>">
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_EDIT || $t_pelatihan->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_idpelat" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_idpelat" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_idpelat" value="<?php echo HtmlEncode($t_pelatihan_grid->idpelat->CurrentValue) ?>">
<?php } ?>
	<?php if ($t_pelatihan_grid->tawal->Visible) { // tawal ?>
		<td data-name="tawal" <?php echo $t_pelatihan_grid->tawal->cellAttributes() ?>>
<?php if ($t_pelatihan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_tawal" class="form-group">
<input type="text" data-table="t_pelatihan" data-field="x_tawal" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_tawal" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_tawal" size="10" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->tawal->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->tawal->EditValue ?>"<?php echo $t_pelatihan_grid->tawal->editAttributes() ?>>
<?php if (!$t_pelatihan_grid->tawal->ReadOnly && !$t_pelatihan_grid->tawal->Disabled && !isset($t_pelatihan_grid->tawal->EditAttrs["readonly"]) && !isset($t_pelatihan_grid->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_pelatihangrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_pelatihangrid", "x<?php echo $t_pelatihan_grid->RowIndex ?>_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_tawal" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_tawal" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($t_pelatihan_grid->tawal->OldValue) ?>">
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_tawal" class="form-group">
<span<?php echo $t_pelatihan_grid->tawal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_grid->tawal->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_tawal" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_tawal" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($t_pelatihan_grid->tawal->CurrentValue) ?>">
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_tawal">
<span<?php echo $t_pelatihan_grid->tawal->viewAttributes() ?>><?php echo $t_pelatihan_grid->tawal->getViewValue() ?></span>
</span>
<?php if (!$t_pelatihan->isConfirm()) { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_tawal" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_tawal" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($t_pelatihan_grid->tawal->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_tawal" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_tawal" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($t_pelatihan_grid->tawal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_tawal" name="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_tawal" id="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($t_pelatihan_grid->tawal->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_tawal" name="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_tawal" id="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($t_pelatihan_grid->tawal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->takhir->Visible) { // takhir ?>
		<td data-name="takhir" <?php echo $t_pelatihan_grid->takhir->cellAttributes() ?>>
<?php if ($t_pelatihan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_takhir" class="form-group">
<input type="text" data-table="t_pelatihan" data-field="x_takhir" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_takhir" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_takhir" size="10" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->takhir->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->takhir->EditValue ?>"<?php echo $t_pelatihan_grid->takhir->editAttributes() ?>>
<?php if (!$t_pelatihan_grid->takhir->ReadOnly && !$t_pelatihan_grid->takhir->Disabled && !isset($t_pelatihan_grid->takhir->EditAttrs["readonly"]) && !isset($t_pelatihan_grid->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_pelatihangrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_pelatihangrid", "x<?php echo $t_pelatihan_grid->RowIndex ?>_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_takhir" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_takhir" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($t_pelatihan_grid->takhir->OldValue) ?>">
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_takhir" class="form-group">
<span<?php echo $t_pelatihan_grid->takhir->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_grid->takhir->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_takhir" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_takhir" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($t_pelatihan_grid->takhir->CurrentValue) ?>">
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_takhir">
<span<?php echo $t_pelatihan_grid->takhir->viewAttributes() ?>><?php echo $t_pelatihan_grid->takhir->getViewValue() ?></span>
</span>
<?php if (!$t_pelatihan->isConfirm()) { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_takhir" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_takhir" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($t_pelatihan_grid->takhir->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_takhir" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_takhir" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($t_pelatihan_grid->takhir->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_takhir" name="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_takhir" id="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($t_pelatihan_grid->takhir->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_takhir" name="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_takhir" id="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($t_pelatihan_grid->takhir->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->tglpel->Visible) { // tglpel ?>
		<td data-name="tglpel" <?php echo $t_pelatihan_grid->tglpel->cellAttributes() ?>>
<?php if ($t_pelatihan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_tglpel" class="form-group">
<input type="text" data-table="t_pelatihan" data-field="x_tglpel" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_tglpel" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_tglpel" size="30" maxlength="65530" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->tglpel->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->tglpel->EditValue ?>"<?php echo $t_pelatihan_grid->tglpel->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_tglpel" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_tglpel" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_tglpel" value="<?php echo HtmlEncode($t_pelatihan_grid->tglpel->OldValue) ?>">
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_tglpel" class="form-group">
<input type="text" data-table="t_pelatihan" data-field="x_tglpel" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_tglpel" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_tglpel" size="30" maxlength="65530" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->tglpel->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->tglpel->EditValue ?>"<?php echo $t_pelatihan_grid->tglpel->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_tglpel">
<span<?php echo $t_pelatihan_grid->tglpel->viewAttributes() ?>><?php echo $t_pelatihan_grid->tglpel->getViewValue() ?></span>
</span>
<?php if (!$t_pelatihan->isConfirm()) { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_tglpel" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_tglpel" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_tglpel" value="<?php echo HtmlEncode($t_pelatihan_grid->tglpel->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_tglpel" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_tglpel" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_tglpel" value="<?php echo HtmlEncode($t_pelatihan_grid->tglpel->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_tglpel" name="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_tglpel" id="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_tglpel" value="<?php echo HtmlEncode($t_pelatihan_grid->tglpel->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_tglpel" name="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_tglpel" id="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_tglpel" value="<?php echo HtmlEncode($t_pelatihan_grid->tglpel->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->jenispel->Visible) { // jenispel ?>
		<td data-name="jenispel" <?php echo $t_pelatihan_grid->jenispel->cellAttributes() ?>>
<?php if ($t_pelatihan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_jenispel" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_jenispel" data-value-separator="<?php echo $t_pelatihan_grid->jenispel->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_jenispel" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_jenispel"<?php echo $t_pelatihan_grid->jenispel->editAttributes() ?>>
			<?php echo $t_pelatihan_grid->jenispel->selectOptionListHtml("x{$t_pelatihan_grid->RowIndex}_jenispel") ?>
		</select>
</div>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_jenispel" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_jenispel" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_jenispel" value="<?php echo HtmlEncode($t_pelatihan_grid->jenispel->OldValue) ?>">
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_jenispel" class="form-group">
<span<?php echo $t_pelatihan_grid->jenispel->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_grid->jenispel->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_jenispel" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_jenispel" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_jenispel" value="<?php echo HtmlEncode($t_pelatihan_grid->jenispel->CurrentValue) ?>">
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_jenispel">
<span<?php echo $t_pelatihan_grid->jenispel->viewAttributes() ?>><?php echo $t_pelatihan_grid->jenispel->getViewValue() ?></span>
</span>
<?php if (!$t_pelatihan->isConfirm()) { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_jenispel" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_jenispel" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_jenispel" value="<?php echo HtmlEncode($t_pelatihan_grid->jenispel->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_jenispel" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_jenispel" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_jenispel" value="<?php echo HtmlEncode($t_pelatihan_grid->jenispel->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_jenispel" name="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_jenispel" id="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_jenispel" value="<?php echo HtmlEncode($t_pelatihan_grid->jenispel->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_jenispel" name="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_jenispel" id="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_jenispel" value="<?php echo HtmlEncode($t_pelatihan_grid->jenispel->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->kerjasama->Visible) { // kerjasama ?>
		<td data-name="kerjasama" <?php echo $t_pelatihan_grid->kerjasama->cellAttributes() ?>>
<?php if ($t_pelatihan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_kerjasama" class="form-group">
<?php
$onchange = $t_pelatihan_grid->kerjasama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_grid->kerjasama->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama">
	<input type="text" class="form-control" name="sv_x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" id="sv_x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" value="<?php echo RemoveHtml($t_pelatihan_grid->kerjasama->EditValue) ?>" size="100" maxlength="11" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->kerjasama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_grid->kerjasama->getPlaceHolder()) ?>"<?php echo $t_pelatihan_grid->kerjasama->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_kerjasama" data-value-separator="<?php echo $t_pelatihan_grid->kerjasama->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" value="<?php echo HtmlEncode($t_pelatihan_grid->kerjasama->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihangrid"], function() {
	ft_pelatihangrid.createAutoSuggest({"id":"x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_pelatihan_grid->kerjasama->Lookup->getParamTag($t_pelatihan_grid, "p_x" . $t_pelatihan_grid->RowIndex . "_kerjasama") ?>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_kerjasama" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" value="<?php echo HtmlEncode($t_pelatihan_grid->kerjasama->OldValue) ?>">
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_kerjasama" class="form-group">
<?php
$onchange = $t_pelatihan_grid->kerjasama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_grid->kerjasama->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama">
	<input type="text" class="form-control" name="sv_x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" id="sv_x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" value="<?php echo RemoveHtml($t_pelatihan_grid->kerjasama->EditValue) ?>" size="100" maxlength="11" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->kerjasama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_grid->kerjasama->getPlaceHolder()) ?>"<?php echo $t_pelatihan_grid->kerjasama->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_kerjasama" data-value-separator="<?php echo $t_pelatihan_grid->kerjasama->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" value="<?php echo HtmlEncode($t_pelatihan_grid->kerjasama->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihangrid"], function() {
	ft_pelatihangrid.createAutoSuggest({"id":"x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_pelatihan_grid->kerjasama->Lookup->getParamTag($t_pelatihan_grid, "p_x" . $t_pelatihan_grid->RowIndex . "_kerjasama") ?>
</span>
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_kerjasama">
<span<?php echo $t_pelatihan_grid->kerjasama->viewAttributes() ?>><?php echo $t_pelatihan_grid->kerjasama->getViewValue() ?></span>
</span>
<?php if (!$t_pelatihan->isConfirm()) { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_kerjasama" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" value="<?php echo HtmlEncode($t_pelatihan_grid->kerjasama->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_kerjasama" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" value="<?php echo HtmlEncode($t_pelatihan_grid->kerjasama->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_kerjasama" name="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" id="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" value="<?php echo HtmlEncode($t_pelatihan_grid->kerjasama->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_kerjasama" name="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" id="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" value="<?php echo HtmlEncode($t_pelatihan_grid->kerjasama->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->biaya->Visible) { // biaya ?>
		<td data-name="biaya" <?php echo $t_pelatihan_grid->biaya->cellAttributes() ?>>
<?php if ($t_pelatihan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_biaya" class="form-group">
<input type="text" data-table="t_pelatihan" data-field="x_biaya" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_biaya" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_biaya" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->biaya->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->biaya->EditValue ?>"<?php echo $t_pelatihan_grid->biaya->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_biaya" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_biaya" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_biaya" value="<?php echo HtmlEncode($t_pelatihan_grid->biaya->OldValue) ?>">
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_biaya" class="form-group">
<input type="text" data-table="t_pelatihan" data-field="x_biaya" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_biaya" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_biaya" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->biaya->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->biaya->EditValue ?>"<?php echo $t_pelatihan_grid->biaya->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_biaya">
<span<?php echo $t_pelatihan_grid->biaya->viewAttributes() ?>><?php echo $t_pelatihan_grid->biaya->getViewValue() ?></span>
</span>
<?php if (!$t_pelatihan->isConfirm()) { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_biaya" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_biaya" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_biaya" value="<?php echo HtmlEncode($t_pelatihan_grid->biaya->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_biaya" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_biaya" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_biaya" value="<?php echo HtmlEncode($t_pelatihan_grid->biaya->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_biaya" name="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_biaya" id="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_biaya" value="<?php echo HtmlEncode($t_pelatihan_grid->biaya->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_biaya" name="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_biaya" id="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_biaya" value="<?php echo HtmlEncode($t_pelatihan_grid->biaya->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->coachingprogr->Visible) { // coachingprogr ?>
		<td data-name="coachingprogr" <?php echo $t_pelatihan_grid->coachingprogr->cellAttributes() ?>>
<?php if ($t_pelatihan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_coachingprogr" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_coachingprogr" data-value-separator="<?php echo $t_pelatihan_grid->coachingprogr->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_coachingprogr" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_coachingprogr"<?php echo $t_pelatihan_grid->coachingprogr->editAttributes() ?>>
			<?php echo $t_pelatihan_grid->coachingprogr->selectOptionListHtml("x{$t_pelatihan_grid->RowIndex}_coachingprogr") ?>
		</select>
</div>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_coachingprogr" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_coachingprogr" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_coachingprogr" value="<?php echo HtmlEncode($t_pelatihan_grid->coachingprogr->OldValue) ?>">
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_coachingprogr" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_coachingprogr" data-value-separator="<?php echo $t_pelatihan_grid->coachingprogr->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_coachingprogr" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_coachingprogr"<?php echo $t_pelatihan_grid->coachingprogr->editAttributes() ?>>
			<?php echo $t_pelatihan_grid->coachingprogr->selectOptionListHtml("x{$t_pelatihan_grid->RowIndex}_coachingprogr") ?>
		</select>
</div>
</span>
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_coachingprogr">
<span<?php echo $t_pelatihan_grid->coachingprogr->viewAttributes() ?>><?php echo $t_pelatihan_grid->coachingprogr->getViewValue() ?></span>
</span>
<?php if (!$t_pelatihan->isConfirm()) { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_coachingprogr" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_coachingprogr" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_coachingprogr" value="<?php echo HtmlEncode($t_pelatihan_grid->coachingprogr->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_coachingprogr" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_coachingprogr" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_coachingprogr" value="<?php echo HtmlEncode($t_pelatihan_grid->coachingprogr->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_coachingprogr" name="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_coachingprogr" id="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_coachingprogr" value="<?php echo HtmlEncode($t_pelatihan_grid->coachingprogr->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_coachingprogr" name="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_coachingprogr" id="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_coachingprogr" value="<?php echo HtmlEncode($t_pelatihan_grid->coachingprogr->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->area->Visible) { // area ?>
		<td data-name="area" <?php echo $t_pelatihan_grid->area->cellAttributes() ?>>
<?php if ($t_pelatihan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_area" class="form-group">
<input type="text" data-table="t_pelatihan" data-field="x_area" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_area" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_area" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->area->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->area->EditValue ?>"<?php echo $t_pelatihan_grid->area->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_area" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_area" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_area" value="<?php echo HtmlEncode($t_pelatihan_grid->area->OldValue) ?>">
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_area" class="form-group">
<input type="text" data-table="t_pelatihan" data-field="x_area" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_area" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_area" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->area->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->area->EditValue ?>"<?php echo $t_pelatihan_grid->area->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_area">
<span<?php echo $t_pelatihan_grid->area->viewAttributes() ?>><?php echo $t_pelatihan_grid->area->getViewValue() ?></span>
</span>
<?php if (!$t_pelatihan->isConfirm()) { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_area" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_area" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_area" value="<?php echo HtmlEncode($t_pelatihan_grid->area->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_area" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_area" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_area" value="<?php echo HtmlEncode($t_pelatihan_grid->area->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_area" name="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_area" id="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_area" value="<?php echo HtmlEncode($t_pelatihan_grid->area->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_area" name="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_area" id="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_area" value="<?php echo HtmlEncode($t_pelatihan_grid->area->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->periode_awal->Visible) { // periode_awal ?>
		<td data-name="periode_awal" <?php echo $t_pelatihan_grid->periode_awal->cellAttributes() ?>>
<?php if ($t_pelatihan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_periode_awal" class="form-group">
<input type="text" data-table="t_pelatihan" data-field="x_periode_awal" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_awal" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_awal" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->periode_awal->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->periode_awal->EditValue ?>"<?php echo $t_pelatihan_grid->periode_awal->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_periode_awal" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_periode_awal" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_periode_awal" value="<?php echo HtmlEncode($t_pelatihan_grid->periode_awal->OldValue) ?>">
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_periode_awal" class="form-group">
<input type="text" data-table="t_pelatihan" data-field="x_periode_awal" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_awal" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_awal" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->periode_awal->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->periode_awal->EditValue ?>"<?php echo $t_pelatihan_grid->periode_awal->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_periode_awal">
<span<?php echo $t_pelatihan_grid->periode_awal->viewAttributes() ?>><?php echo $t_pelatihan_grid->periode_awal->getViewValue() ?></span>
</span>
<?php if (!$t_pelatihan->isConfirm()) { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_periode_awal" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_awal" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_awal" value="<?php echo HtmlEncode($t_pelatihan_grid->periode_awal->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_periode_awal" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_periode_awal" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_periode_awal" value="<?php echo HtmlEncode($t_pelatihan_grid->periode_awal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_periode_awal" name="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_awal" id="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_awal" value="<?php echo HtmlEncode($t_pelatihan_grid->periode_awal->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_periode_awal" name="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_periode_awal" id="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_periode_awal" value="<?php echo HtmlEncode($t_pelatihan_grid->periode_awal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->periode_akhir->Visible) { // periode_akhir ?>
		<td data-name="periode_akhir" <?php echo $t_pelatihan_grid->periode_akhir->cellAttributes() ?>>
<?php if ($t_pelatihan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_periode_akhir" class="form-group">
<input type="text" data-table="t_pelatihan" data-field="x_periode_akhir" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_akhir" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_akhir" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->periode_akhir->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->periode_akhir->EditValue ?>"<?php echo $t_pelatihan_grid->periode_akhir->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_periode_akhir" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_periode_akhir" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_periode_akhir" value="<?php echo HtmlEncode($t_pelatihan_grid->periode_akhir->OldValue) ?>">
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_periode_akhir" class="form-group">
<input type="text" data-table="t_pelatihan" data-field="x_periode_akhir" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_akhir" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_akhir" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->periode_akhir->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->periode_akhir->EditValue ?>"<?php echo $t_pelatihan_grid->periode_akhir->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_periode_akhir">
<span<?php echo $t_pelatihan_grid->periode_akhir->viewAttributes() ?>><?php echo $t_pelatihan_grid->periode_akhir->getViewValue() ?></span>
</span>
<?php if (!$t_pelatihan->isConfirm()) { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_periode_akhir" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_akhir" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_akhir" value="<?php echo HtmlEncode($t_pelatihan_grid->periode_akhir->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_periode_akhir" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_periode_akhir" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_periode_akhir" value="<?php echo HtmlEncode($t_pelatihan_grid->periode_akhir->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_periode_akhir" name="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_akhir" id="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_akhir" value="<?php echo HtmlEncode($t_pelatihan_grid->periode_akhir->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_periode_akhir" name="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_periode_akhir" id="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_periode_akhir" value="<?php echo HtmlEncode($t_pelatihan_grid->periode_akhir->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->tahapan->Visible) { // tahapan ?>
		<td data-name="tahapan" <?php echo $t_pelatihan_grid->tahapan->cellAttributes() ?>>
<?php if ($t_pelatihan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_tahapan" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_tahapan" data-value-separator="<?php echo $t_pelatihan_grid->tahapan->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_tahapan" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_tahapan"<?php echo $t_pelatihan_grid->tahapan->editAttributes() ?>>
			<?php echo $t_pelatihan_grid->tahapan->selectOptionListHtml("x{$t_pelatihan_grid->RowIndex}_tahapan") ?>
		</select>
</div>
<?php echo $t_pelatihan_grid->tahapan->Lookup->getParamTag($t_pelatihan_grid, "p_x" . $t_pelatihan_grid->RowIndex . "_tahapan") ?>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_tahapan" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_tahapan" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_tahapan" value="<?php echo HtmlEncode($t_pelatihan_grid->tahapan->OldValue) ?>">
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_tahapan" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_tahapan" data-value-separator="<?php echo $t_pelatihan_grid->tahapan->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_tahapan" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_tahapan"<?php echo $t_pelatihan_grid->tahapan->editAttributes() ?>>
			<?php echo $t_pelatihan_grid->tahapan->selectOptionListHtml("x{$t_pelatihan_grid->RowIndex}_tahapan") ?>
		</select>
</div>
<?php echo $t_pelatihan_grid->tahapan->Lookup->getParamTag($t_pelatihan_grid, "p_x" . $t_pelatihan_grid->RowIndex . "_tahapan") ?>
</span>
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_tahapan">
<span<?php echo $t_pelatihan_grid->tahapan->viewAttributes() ?>><?php echo $t_pelatihan_grid->tahapan->getViewValue() ?></span>
</span>
<?php if (!$t_pelatihan->isConfirm()) { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_tahapan" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_tahapan" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_tahapan" value="<?php echo HtmlEncode($t_pelatihan_grid->tahapan->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_tahapan" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_tahapan" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_tahapan" value="<?php echo HtmlEncode($t_pelatihan_grid->tahapan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_tahapan" name="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_tahapan" id="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_tahapan" value="<?php echo HtmlEncode($t_pelatihan_grid->tahapan->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_tahapan" name="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_tahapan" id="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_tahapan" value="<?php echo HtmlEncode($t_pelatihan_grid->tahapan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->namaberkas->Visible) { // namaberkas ?>
		<td data-name="namaberkas" <?php echo $t_pelatihan_grid->namaberkas->cellAttributes() ?>>
<?php if ($t_pelatihan_grid->RowAction == "insert") { // Add record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_namaberkas" class="form-group t_pelatihan_namaberkas">
<div id="fd_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pelatihan_grid->namaberkas->title() ?>" data-table="t_pelatihan" data-field="x_namaberkas" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pelatihan_grid->namaberkas->editAttributes() ?><?php if ($t_pelatihan_grid->namaberkas->ReadOnly || $t_pelatihan_grid->namaberkas->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" id= "fn_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" value="<?php echo $t_pelatihan_grid->namaberkas->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" id= "fa_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" value="0">
<input type="hidden" name="fs_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" id= "fs_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" value="255">
<input type="hidden" name="fx_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" id= "fx_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" value="<?php echo $t_pelatihan_grid->namaberkas->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" id= "fm_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" value="<?php echo $t_pelatihan_grid->namaberkas->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_namaberkas" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" value="<?php echo HtmlEncode($t_pelatihan_grid->namaberkas->OldValue) ?>">
<?php } elseif ($t_pelatihan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_namaberkas">
<span<?php echo $t_pelatihan_grid->namaberkas->viewAttributes() ?>><?php echo GetFileViewTag($t_pelatihan_grid->namaberkas, $t_pelatihan_grid->namaberkas->getViewValue(), FALSE) ?></span>
</span>
<?php } else  { // Edit record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_namaberkas" class="form-group t_pelatihan_namaberkas">
<div id="fd_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pelatihan_grid->namaberkas->title() ?>" data-table="t_pelatihan" data-field="x_namaberkas" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pelatihan_grid->namaberkas->editAttributes() ?><?php if ($t_pelatihan_grid->namaberkas->ReadOnly || $t_pelatihan_grid->namaberkas->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" id= "fn_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" value="<?php echo $t_pelatihan_grid->namaberkas->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" id= "fa_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" value="<?php echo (Post("fa_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" id= "fs_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" value="255">
<input type="hidden" name="fx_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" id= "fx_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" value="<?php echo $t_pelatihan_grid->namaberkas->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" id= "fm_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" value="<?php echo $t_pelatihan_grid->namaberkas->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->instruktur->Visible) { // instruktur ?>
		<td data-name="instruktur" <?php echo $t_pelatihan_grid->instruktur->cellAttributes() ?>>
<?php if ($t_pelatihan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_instruktur" class="form-group">
<input type="text" data-table="t_pelatihan" data-field="x_instruktur" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_instruktur" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_instruktur" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->instruktur->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->instruktur->EditValue ?>"<?php echo $t_pelatihan_grid->instruktur->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_instruktur" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_instruktur" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_pelatihan_grid->instruktur->OldValue) ?>">
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_instruktur" class="form-group">
<input type="text" data-table="t_pelatihan" data-field="x_instruktur" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_instruktur" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_instruktur" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->instruktur->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->instruktur->EditValue ?>"<?php echo $t_pelatihan_grid->instruktur->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_instruktur">
<span<?php echo $t_pelatihan_grid->instruktur->viewAttributes() ?>><?php echo $t_pelatihan_grid->instruktur->getViewValue() ?></span>
</span>
<?php if (!$t_pelatihan->isConfirm()) { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_instruktur" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_instruktur" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_pelatihan_grid->instruktur->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_instruktur" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_instruktur" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_pelatihan_grid->instruktur->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_instruktur" name="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_instruktur" id="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_pelatihan_grid->instruktur->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_instruktur" name="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_instruktur" id="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_pelatihan_grid->instruktur->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->tempat->Visible) { // tempat ?>
		<td data-name="tempat" <?php echo $t_pelatihan_grid->tempat->cellAttributes() ?>>
<?php if ($t_pelatihan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_tempat" class="form-group">
<textarea data-table="t_pelatihan" data-field="x_tempat" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_tempat" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_tempat" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->tempat->getPlaceHolder()) ?>"<?php echo $t_pelatihan_grid->tempat->editAttributes() ?>><?php echo $t_pelatihan_grid->tempat->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_tempat" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_tempat" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_pelatihan_grid->tempat->OldValue) ?>">
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_tempat" class="form-group">
<textarea data-table="t_pelatihan" data-field="x_tempat" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_tempat" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_tempat" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->tempat->getPlaceHolder()) ?>"<?php echo $t_pelatihan_grid->tempat->editAttributes() ?>><?php echo $t_pelatihan_grid->tempat->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_tempat">
<span<?php echo $t_pelatihan_grid->tempat->viewAttributes() ?>><?php echo $t_pelatihan_grid->tempat->getViewValue() ?></span>
</span>
<?php if (!$t_pelatihan->isConfirm()) { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_tempat" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_tempat" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_pelatihan_grid->tempat->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_tempat" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_tempat" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_pelatihan_grid->tempat->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_tempat" name="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_tempat" id="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_pelatihan_grid->tempat->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_tempat" name="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_tempat" id="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_pelatihan_grid->tempat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->jpeserta->Visible) { // jpeserta ?>
		<td data-name="jpeserta" <?php echo $t_pelatihan_grid->jpeserta->cellAttributes() ?>>
<?php if ($t_pelatihan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_jpeserta" class="form-group">
<input type="text" data-table="t_pelatihan" data-field="x_jpeserta" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_jpeserta" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_jpeserta" size="30" maxlength="21" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->jpeserta->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->jpeserta->EditValue ?>"<?php echo $t_pelatihan_grid->jpeserta->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_jpeserta" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_jpeserta" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_jpeserta" value="<?php echo HtmlEncode($t_pelatihan_grid->jpeserta->OldValue) ?>">
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_jpeserta" class="form-group">
<input type="text" data-table="t_pelatihan" data-field="x_jpeserta" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_jpeserta" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_jpeserta" size="30" maxlength="21" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->jpeserta->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->jpeserta->EditValue ?>"<?php echo $t_pelatihan_grid->jpeserta->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_jpeserta">
<span<?php echo $t_pelatihan_grid->jpeserta->viewAttributes() ?>><?php echo $t_pelatihan_grid->jpeserta->getViewValue() ?></span>
</span>
<?php if (!$t_pelatihan->isConfirm()) { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_jpeserta" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_jpeserta" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_jpeserta" value="<?php echo HtmlEncode($t_pelatihan_grid->jpeserta->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_jpeserta" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_jpeserta" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_jpeserta" value="<?php echo HtmlEncode($t_pelatihan_grid->jpeserta->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_jpeserta" name="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_jpeserta" id="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_jpeserta" value="<?php echo HtmlEncode($t_pelatihan_grid->jpeserta->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_jpeserta" name="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_jpeserta" id="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_jpeserta" value="<?php echo HtmlEncode($t_pelatihan_grid->jpeserta->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->targetpes->Visible) { // targetpes ?>
		<td data-name="targetpes" <?php echo $t_pelatihan_grid->targetpes->cellAttributes() ?>>
<?php if ($t_pelatihan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_targetpes" class="form-group">
<input type="text" data-table="t_pelatihan" data-field="x_targetpes" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_targetpes" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_targetpes" size="30" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->targetpes->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->targetpes->EditValue ?>"<?php echo $t_pelatihan_grid->targetpes->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_targetpes" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_targetpes" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_targetpes" value="<?php echo HtmlEncode($t_pelatihan_grid->targetpes->OldValue) ?>">
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_targetpes" class="form-group">
<input type="text" data-table="t_pelatihan" data-field="x_targetpes" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_targetpes" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_targetpes" size="30" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->targetpes->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->targetpes->EditValue ?>"<?php echo $t_pelatihan_grid->targetpes->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_targetpes">
<span<?php echo $t_pelatihan_grid->targetpes->viewAttributes() ?>><?php echo $t_pelatihan_grid->targetpes->getViewValue() ?></span>
</span>
<?php if (!$t_pelatihan->isConfirm()) { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_targetpes" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_targetpes" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_targetpes" value="<?php echo HtmlEncode($t_pelatihan_grid->targetpes->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_targetpes" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_targetpes" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_targetpes" value="<?php echo HtmlEncode($t_pelatihan_grid->targetpes->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_targetpes" name="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_targetpes" id="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_targetpes" value="<?php echo HtmlEncode($t_pelatihan_grid->targetpes->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_targetpes" name="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_targetpes" id="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_targetpes" value="<?php echo HtmlEncode($t_pelatihan_grid->targetpes->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->Tahun->Visible) { // Tahun ?>
		<td data-name="Tahun" <?php echo $t_pelatihan_grid->Tahun->cellAttributes() ?>>
<?php if ($t_pelatihan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_Tahun" class="form-group">
<input type="text" data-table="t_pelatihan" data-field="x_Tahun" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_Tahun" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_Tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->Tahun->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->Tahun->EditValue ?>"<?php echo $t_pelatihan_grid->Tahun->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_Tahun" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_Tahun" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_Tahun" value="<?php echo HtmlEncode($t_pelatihan_grid->Tahun->OldValue) ?>">
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_Tahun" class="form-group">
<input type="text" data-table="t_pelatihan" data-field="x_Tahun" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_Tahun" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_Tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->Tahun->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->Tahun->EditValue ?>"<?php echo $t_pelatihan_grid->Tahun->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pelatihan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pelatihan_grid->RowCount ?>_t_pelatihan_Tahun">
<span<?php echo $t_pelatihan_grid->Tahun->viewAttributes() ?>><?php echo $t_pelatihan_grid->Tahun->getViewValue() ?></span>
</span>
<?php if (!$t_pelatihan->isConfirm()) { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_Tahun" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_Tahun" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_Tahun" value="<?php echo HtmlEncode($t_pelatihan_grid->Tahun->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_Tahun" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_Tahun" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_Tahun" value="<?php echo HtmlEncode($t_pelatihan_grid->Tahun->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_Tahun" name="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_Tahun" id="ft_pelatihangrid$x<?php echo $t_pelatihan_grid->RowIndex ?>_Tahun" value="<?php echo HtmlEncode($t_pelatihan_grid->Tahun->FormValue) ?>">
<input type="hidden" data-table="t_pelatihan" data-field="x_Tahun" name="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_Tahun" id="ft_pelatihangrid$o<?php echo $t_pelatihan_grid->RowIndex ?>_Tahun" value="<?php echo HtmlEncode($t_pelatihan_grid->Tahun->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_pelatihan_grid->ListOptions->render("body", "right", $t_pelatihan_grid->RowCount);
?>
	</tr>
<?php if ($t_pelatihan->RowType == ROWTYPE_ADD || $t_pelatihan->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_pelatihangrid", "load"], function() {
	ft_pelatihangrid.updateLists(<?php echo $t_pelatihan_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_pelatihan_grid->isGridAdd() || $t_pelatihan->CurrentMode == "copy")
		if (!$t_pelatihan_grid->Recordset->EOF)
			$t_pelatihan_grid->Recordset->moveNext();
}
?>
<?php
	if ($t_pelatihan->CurrentMode == "add" || $t_pelatihan->CurrentMode == "copy" || $t_pelatihan->CurrentMode == "edit") {
		$t_pelatihan_grid->RowIndex = '$rowindex$';
		$t_pelatihan_grid->loadRowValues();

		// Set row properties
		$t_pelatihan->resetAttributes();
		$t_pelatihan->RowAttrs->merge(["data-rowindex" => $t_pelatihan_grid->RowIndex, "id" => "r0_t_pelatihan", "data-rowtype" => ROWTYPE_ADD]);
		$t_pelatihan->RowAttrs->appendClass("ew-template");
		$t_pelatihan->RowType = ROWTYPE_ADD;

		// Render row
		$t_pelatihan_grid->renderRow();

		// Render list options
		$t_pelatihan_grid->renderListOptions();
		$t_pelatihan_grid->StartRowCount = 0;
?>
	<tr <?php echo $t_pelatihan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_pelatihan_grid->ListOptions->render("body", "left", $t_pelatihan_grid->RowIndex);
?>
	<?php if ($t_pelatihan_grid->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul">
<?php if (!$t_pelatihan->isConfirm()) { ?>
<?php if ($t_pelatihan_grid->kdjudul->getSessionValue() != "") { ?>
<span id="el$rowindex$_t_pelatihan_kdjudul" class="form-group t_pelatihan_kdjudul">
<span<?php echo $t_pelatihan_grid->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_grid->kdjudul->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_pelatihan_grid->kdjudul->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_pelatihan_kdjudul" class="form-group t_pelatihan_kdjudul">
<?php
$onchange = $t_pelatihan_grid->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_grid->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul">
	<input type="text" class="form-control" name="sv_x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" id="sv_x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" value="<?php echo RemoveHtml($t_pelatihan_grid->kdjudul->EditValue) ?>" size="100" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_grid->kdjudul->getPlaceHolder()) ?>"<?php echo $t_pelatihan_grid->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_kdjudul" data-value-separator="<?php echo $t_pelatihan_grid->kdjudul->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_pelatihan_grid->kdjudul->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihangrid"], function() {
	ft_pelatihangrid.createAutoSuggest({"id":"x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul","forceSelect":true,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $t_pelatihan_grid->kdjudul->Lookup->getParamTag($t_pelatihan_grid, "p_x" . $t_pelatihan_grid->RowIndex . "_kdjudul") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t_pelatihan_kdjudul" class="form-group t_pelatihan_kdjudul">
<span<?php echo $t_pelatihan_grid->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_grid->kdjudul->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_kdjudul" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_pelatihan_grid->kdjudul->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_kdjudul" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($t_pelatihan_grid->kdjudul->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->tawal->Visible) { // tawal ?>
		<td data-name="tawal">
<?php if (!$t_pelatihan->isConfirm()) { ?>
<span id="el$rowindex$_t_pelatihan_tawal" class="form-group t_pelatihan_tawal">
<input type="text" data-table="t_pelatihan" data-field="x_tawal" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_tawal" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_tawal" size="10" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->tawal->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->tawal->EditValue ?>"<?php echo $t_pelatihan_grid->tawal->editAttributes() ?>>
<?php if (!$t_pelatihan_grid->tawal->ReadOnly && !$t_pelatihan_grid->tawal->Disabled && !isset($t_pelatihan_grid->tawal->EditAttrs["readonly"]) && !isset($t_pelatihan_grid->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_pelatihangrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_pelatihangrid", "x<?php echo $t_pelatihan_grid->RowIndex ?>_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pelatihan_tawal" class="form-group t_pelatihan_tawal">
<span<?php echo $t_pelatihan_grid->tawal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_grid->tawal->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_tawal" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_tawal" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($t_pelatihan_grid->tawal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_tawal" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_tawal" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($t_pelatihan_grid->tawal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->takhir->Visible) { // takhir ?>
		<td data-name="takhir">
<?php if (!$t_pelatihan->isConfirm()) { ?>
<span id="el$rowindex$_t_pelatihan_takhir" class="form-group t_pelatihan_takhir">
<input type="text" data-table="t_pelatihan" data-field="x_takhir" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_takhir" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_takhir" size="10" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->takhir->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->takhir->EditValue ?>"<?php echo $t_pelatihan_grid->takhir->editAttributes() ?>>
<?php if (!$t_pelatihan_grid->takhir->ReadOnly && !$t_pelatihan_grid->takhir->Disabled && !isset($t_pelatihan_grid->takhir->EditAttrs["readonly"]) && !isset($t_pelatihan_grid->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_pelatihangrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_pelatihangrid", "x<?php echo $t_pelatihan_grid->RowIndex ?>_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pelatihan_takhir" class="form-group t_pelatihan_takhir">
<span<?php echo $t_pelatihan_grid->takhir->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_grid->takhir->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_takhir" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_takhir" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($t_pelatihan_grid->takhir->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_takhir" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_takhir" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($t_pelatihan_grid->takhir->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->tglpel->Visible) { // tglpel ?>
		<td data-name="tglpel">
<?php if (!$t_pelatihan->isConfirm()) { ?>
<span id="el$rowindex$_t_pelatihan_tglpel" class="form-group t_pelatihan_tglpel">
<input type="text" data-table="t_pelatihan" data-field="x_tglpel" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_tglpel" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_tglpel" size="30" maxlength="65530" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->tglpel->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->tglpel->EditValue ?>"<?php echo $t_pelatihan_grid->tglpel->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pelatihan_tglpel" class="form-group t_pelatihan_tglpel">
<span<?php echo $t_pelatihan_grid->tglpel->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_grid->tglpel->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_tglpel" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_tglpel" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_tglpel" value="<?php echo HtmlEncode($t_pelatihan_grid->tglpel->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_tglpel" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_tglpel" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_tglpel" value="<?php echo HtmlEncode($t_pelatihan_grid->tglpel->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->jenispel->Visible) { // jenispel ?>
		<td data-name="jenispel">
<?php if (!$t_pelatihan->isConfirm()) { ?>
<span id="el$rowindex$_t_pelatihan_jenispel" class="form-group t_pelatihan_jenispel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_jenispel" data-value-separator="<?php echo $t_pelatihan_grid->jenispel->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_jenispel" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_jenispel"<?php echo $t_pelatihan_grid->jenispel->editAttributes() ?>>
			<?php echo $t_pelatihan_grid->jenispel->selectOptionListHtml("x{$t_pelatihan_grid->RowIndex}_jenispel") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pelatihan_jenispel" class="form-group t_pelatihan_jenispel">
<span<?php echo $t_pelatihan_grid->jenispel->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_grid->jenispel->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_jenispel" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_jenispel" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_jenispel" value="<?php echo HtmlEncode($t_pelatihan_grid->jenispel->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_jenispel" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_jenispel" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_jenispel" value="<?php echo HtmlEncode($t_pelatihan_grid->jenispel->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->kerjasama->Visible) { // kerjasama ?>
		<td data-name="kerjasama">
<?php if (!$t_pelatihan->isConfirm()) { ?>
<span id="el$rowindex$_t_pelatihan_kerjasama" class="form-group t_pelatihan_kerjasama">
<?php
$onchange = $t_pelatihan_grid->kerjasama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_grid->kerjasama->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama">
	<input type="text" class="form-control" name="sv_x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" id="sv_x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" value="<?php echo RemoveHtml($t_pelatihan_grid->kerjasama->EditValue) ?>" size="100" maxlength="11" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->kerjasama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_grid->kerjasama->getPlaceHolder()) ?>"<?php echo $t_pelatihan_grid->kerjasama->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_kerjasama" data-value-separator="<?php echo $t_pelatihan_grid->kerjasama->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" value="<?php echo HtmlEncode($t_pelatihan_grid->kerjasama->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihangrid"], function() {
	ft_pelatihangrid.createAutoSuggest({"id":"x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_pelatihan_grid->kerjasama->Lookup->getParamTag($t_pelatihan_grid, "p_x" . $t_pelatihan_grid->RowIndex . "_kerjasama") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pelatihan_kerjasama" class="form-group t_pelatihan_kerjasama">
<span<?php echo $t_pelatihan_grid->kerjasama->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_grid->kerjasama->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_kerjasama" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" value="<?php echo HtmlEncode($t_pelatihan_grid->kerjasama->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_kerjasama" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_kerjasama" value="<?php echo HtmlEncode($t_pelatihan_grid->kerjasama->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->biaya->Visible) { // biaya ?>
		<td data-name="biaya">
<?php if (!$t_pelatihan->isConfirm()) { ?>
<span id="el$rowindex$_t_pelatihan_biaya" class="form-group t_pelatihan_biaya">
<input type="text" data-table="t_pelatihan" data-field="x_biaya" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_biaya" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_biaya" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->biaya->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->biaya->EditValue ?>"<?php echo $t_pelatihan_grid->biaya->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pelatihan_biaya" class="form-group t_pelatihan_biaya">
<span<?php echo $t_pelatihan_grid->biaya->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_grid->biaya->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_biaya" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_biaya" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_biaya" value="<?php echo HtmlEncode($t_pelatihan_grid->biaya->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_biaya" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_biaya" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_biaya" value="<?php echo HtmlEncode($t_pelatihan_grid->biaya->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->coachingprogr->Visible) { // coachingprogr ?>
		<td data-name="coachingprogr">
<?php if (!$t_pelatihan->isConfirm()) { ?>
<span id="el$rowindex$_t_pelatihan_coachingprogr" class="form-group t_pelatihan_coachingprogr">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_coachingprogr" data-value-separator="<?php echo $t_pelatihan_grid->coachingprogr->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_coachingprogr" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_coachingprogr"<?php echo $t_pelatihan_grid->coachingprogr->editAttributes() ?>>
			<?php echo $t_pelatihan_grid->coachingprogr->selectOptionListHtml("x{$t_pelatihan_grid->RowIndex}_coachingprogr") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pelatihan_coachingprogr" class="form-group t_pelatihan_coachingprogr">
<span<?php echo $t_pelatihan_grid->coachingprogr->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_grid->coachingprogr->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_coachingprogr" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_coachingprogr" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_coachingprogr" value="<?php echo HtmlEncode($t_pelatihan_grid->coachingprogr->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_coachingprogr" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_coachingprogr" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_coachingprogr" value="<?php echo HtmlEncode($t_pelatihan_grid->coachingprogr->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->area->Visible) { // area ?>
		<td data-name="area">
<?php if (!$t_pelatihan->isConfirm()) { ?>
<span id="el$rowindex$_t_pelatihan_area" class="form-group t_pelatihan_area">
<input type="text" data-table="t_pelatihan" data-field="x_area" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_area" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_area" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->area->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->area->EditValue ?>"<?php echo $t_pelatihan_grid->area->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pelatihan_area" class="form-group t_pelatihan_area">
<span<?php echo $t_pelatihan_grid->area->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_grid->area->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_area" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_area" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_area" value="<?php echo HtmlEncode($t_pelatihan_grid->area->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_area" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_area" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_area" value="<?php echo HtmlEncode($t_pelatihan_grid->area->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->periode_awal->Visible) { // periode_awal ?>
		<td data-name="periode_awal">
<?php if (!$t_pelatihan->isConfirm()) { ?>
<span id="el$rowindex$_t_pelatihan_periode_awal" class="form-group t_pelatihan_periode_awal">
<input type="text" data-table="t_pelatihan" data-field="x_periode_awal" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_awal" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_awal" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->periode_awal->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->periode_awal->EditValue ?>"<?php echo $t_pelatihan_grid->periode_awal->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pelatihan_periode_awal" class="form-group t_pelatihan_periode_awal">
<span<?php echo $t_pelatihan_grid->periode_awal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_grid->periode_awal->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_periode_awal" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_awal" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_awal" value="<?php echo HtmlEncode($t_pelatihan_grid->periode_awal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_periode_awal" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_periode_awal" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_periode_awal" value="<?php echo HtmlEncode($t_pelatihan_grid->periode_awal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->periode_akhir->Visible) { // periode_akhir ?>
		<td data-name="periode_akhir">
<?php if (!$t_pelatihan->isConfirm()) { ?>
<span id="el$rowindex$_t_pelatihan_periode_akhir" class="form-group t_pelatihan_periode_akhir">
<input type="text" data-table="t_pelatihan" data-field="x_periode_akhir" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_akhir" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_akhir" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->periode_akhir->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->periode_akhir->EditValue ?>"<?php echo $t_pelatihan_grid->periode_akhir->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pelatihan_periode_akhir" class="form-group t_pelatihan_periode_akhir">
<span<?php echo $t_pelatihan_grid->periode_akhir->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_grid->periode_akhir->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_periode_akhir" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_akhir" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_periode_akhir" value="<?php echo HtmlEncode($t_pelatihan_grid->periode_akhir->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_periode_akhir" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_periode_akhir" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_periode_akhir" value="<?php echo HtmlEncode($t_pelatihan_grid->periode_akhir->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->tahapan->Visible) { // tahapan ?>
		<td data-name="tahapan">
<?php if (!$t_pelatihan->isConfirm()) { ?>
<span id="el$rowindex$_t_pelatihan_tahapan" class="form-group t_pelatihan_tahapan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_tahapan" data-value-separator="<?php echo $t_pelatihan_grid->tahapan->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_tahapan" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_tahapan"<?php echo $t_pelatihan_grid->tahapan->editAttributes() ?>>
			<?php echo $t_pelatihan_grid->tahapan->selectOptionListHtml("x{$t_pelatihan_grid->RowIndex}_tahapan") ?>
		</select>
</div>
<?php echo $t_pelatihan_grid->tahapan->Lookup->getParamTag($t_pelatihan_grid, "p_x" . $t_pelatihan_grid->RowIndex . "_tahapan") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pelatihan_tahapan" class="form-group t_pelatihan_tahapan">
<span<?php echo $t_pelatihan_grid->tahapan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_grid->tahapan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_tahapan" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_tahapan" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_tahapan" value="<?php echo HtmlEncode($t_pelatihan_grid->tahapan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_tahapan" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_tahapan" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_tahapan" value="<?php echo HtmlEncode($t_pelatihan_grid->tahapan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->namaberkas->Visible) { // namaberkas ?>
		<td data-name="namaberkas">
<span id="el$rowindex$_t_pelatihan_namaberkas" class="form-group t_pelatihan_namaberkas">
<div id="fd_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pelatihan_grid->namaberkas->title() ?>" data-table="t_pelatihan" data-field="x_namaberkas" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pelatihan_grid->namaberkas->editAttributes() ?><?php if ($t_pelatihan_grid->namaberkas->ReadOnly || $t_pelatihan_grid->namaberkas->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" id= "fn_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" value="<?php echo $t_pelatihan_grid->namaberkas->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" id= "fa_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" value="0">
<input type="hidden" name="fs_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" id= "fs_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" value="255">
<input type="hidden" name="fx_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" id= "fx_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" value="<?php echo $t_pelatihan_grid->namaberkas->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" id= "fm_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" value="<?php echo $t_pelatihan_grid->namaberkas->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_namaberkas" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_namaberkas" value="<?php echo HtmlEncode($t_pelatihan_grid->namaberkas->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->instruktur->Visible) { // instruktur ?>
		<td data-name="instruktur">
<?php if (!$t_pelatihan->isConfirm()) { ?>
<span id="el$rowindex$_t_pelatihan_instruktur" class="form-group t_pelatihan_instruktur">
<input type="text" data-table="t_pelatihan" data-field="x_instruktur" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_instruktur" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_instruktur" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->instruktur->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->instruktur->EditValue ?>"<?php echo $t_pelatihan_grid->instruktur->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pelatihan_instruktur" class="form-group t_pelatihan_instruktur">
<span<?php echo $t_pelatihan_grid->instruktur->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_grid->instruktur->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_instruktur" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_instruktur" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_pelatihan_grid->instruktur->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_instruktur" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_instruktur" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_pelatihan_grid->instruktur->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->tempat->Visible) { // tempat ?>
		<td data-name="tempat">
<?php if (!$t_pelatihan->isConfirm()) { ?>
<span id="el$rowindex$_t_pelatihan_tempat" class="form-group t_pelatihan_tempat">
<textarea data-table="t_pelatihan" data-field="x_tempat" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_tempat" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_tempat" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->tempat->getPlaceHolder()) ?>"<?php echo $t_pelatihan_grid->tempat->editAttributes() ?>><?php echo $t_pelatihan_grid->tempat->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pelatihan_tempat" class="form-group t_pelatihan_tempat">
<span<?php echo $t_pelatihan_grid->tempat->viewAttributes() ?>><?php echo $t_pelatihan_grid->tempat->ViewValue ?></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_tempat" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_tempat" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_pelatihan_grid->tempat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_tempat" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_tempat" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_pelatihan_grid->tempat->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->jpeserta->Visible) { // jpeserta ?>
		<td data-name="jpeserta">
<?php if (!$t_pelatihan->isConfirm()) { ?>
<span id="el$rowindex$_t_pelatihan_jpeserta" class="form-group t_pelatihan_jpeserta">
<input type="text" data-table="t_pelatihan" data-field="x_jpeserta" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_jpeserta" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_jpeserta" size="30" maxlength="21" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->jpeserta->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->jpeserta->EditValue ?>"<?php echo $t_pelatihan_grid->jpeserta->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pelatihan_jpeserta" class="form-group t_pelatihan_jpeserta">
<span<?php echo $t_pelatihan_grid->jpeserta->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_grid->jpeserta->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_jpeserta" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_jpeserta" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_jpeserta" value="<?php echo HtmlEncode($t_pelatihan_grid->jpeserta->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_jpeserta" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_jpeserta" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_jpeserta" value="<?php echo HtmlEncode($t_pelatihan_grid->jpeserta->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->targetpes->Visible) { // targetpes ?>
		<td data-name="targetpes">
<?php if (!$t_pelatihan->isConfirm()) { ?>
<span id="el$rowindex$_t_pelatihan_targetpes" class="form-group t_pelatihan_targetpes">
<input type="text" data-table="t_pelatihan" data-field="x_targetpes" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_targetpes" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_targetpes" size="30" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->targetpes->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->targetpes->EditValue ?>"<?php echo $t_pelatihan_grid->targetpes->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pelatihan_targetpes" class="form-group t_pelatihan_targetpes">
<span<?php echo $t_pelatihan_grid->targetpes->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_grid->targetpes->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_targetpes" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_targetpes" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_targetpes" value="<?php echo HtmlEncode($t_pelatihan_grid->targetpes->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_targetpes" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_targetpes" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_targetpes" value="<?php echo HtmlEncode($t_pelatihan_grid->targetpes->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->Tahun->Visible) { // Tahun ?>
		<td data-name="Tahun">
<?php if (!$t_pelatihan->isConfirm()) { ?>
<span id="el$rowindex$_t_pelatihan_Tahun" class="form-group t_pelatihan_Tahun">
<input type="text" data-table="t_pelatihan" data-field="x_Tahun" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_Tahun" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_Tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pelatihan_grid->Tahun->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_grid->Tahun->EditValue ?>"<?php echo $t_pelatihan_grid->Tahun->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pelatihan_Tahun" class="form-group t_pelatihan_Tahun">
<span<?php echo $t_pelatihan_grid->Tahun->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_grid->Tahun->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_Tahun" name="x<?php echo $t_pelatihan_grid->RowIndex ?>_Tahun" id="x<?php echo $t_pelatihan_grid->RowIndex ?>_Tahun" value="<?php echo HtmlEncode($t_pelatihan_grid->Tahun->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pelatihan" data-field="x_Tahun" name="o<?php echo $t_pelatihan_grid->RowIndex ?>_Tahun" id="o<?php echo $t_pelatihan_grid->RowIndex ?>_Tahun" value="<?php echo HtmlEncode($t_pelatihan_grid->Tahun->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_pelatihan_grid->ListOptions->render("body", "right", $t_pelatihan_grid->RowIndex);
?>
<script>
loadjs.ready(["ft_pelatihangrid", "load"], function() {
	ft_pelatihangrid.updateLists(<?php echo $t_pelatihan_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
<?php

// Render aggregate row
$t_pelatihan->RowType = ROWTYPE_AGGREGATE;
$t_pelatihan->resetAttributes();
$t_pelatihan_grid->renderRow();
?>
<?php if ($t_pelatihan_grid->TotalRecords > 0 && $t_pelatihan->CurrentMode == "view") { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$t_pelatihan_grid->renderListOptions();

// Render list options (footer, left)
$t_pelatihan_grid->ListOptions->render("footer", "left");
?>
	<?php if ($t_pelatihan_grid->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" class="<?php echo $t_pelatihan_grid->kdjudul->footerCellClass() ?>"><span id="elf_t_pelatihan_kdjudul" class="t_pelatihan_kdjudul">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->tawal->Visible) { // tawal ?>
		<td data-name="tawal" class="<?php echo $t_pelatihan_grid->tawal->footerCellClass() ?>"><span id="elf_t_pelatihan_tawal" class="t_pelatihan_tawal">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->takhir->Visible) { // takhir ?>
		<td data-name="takhir" class="<?php echo $t_pelatihan_grid->takhir->footerCellClass() ?>"><span id="elf_t_pelatihan_takhir" class="t_pelatihan_takhir">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->tglpel->Visible) { // tglpel ?>
		<td data-name="tglpel" class="<?php echo $t_pelatihan_grid->tglpel->footerCellClass() ?>"><span id="elf_t_pelatihan_tglpel" class="t_pelatihan_tglpel">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->jenispel->Visible) { // jenispel ?>
		<td data-name="jenispel" class="<?php echo $t_pelatihan_grid->jenispel->footerCellClass() ?>"><span id="elf_t_pelatihan_jenispel" class="t_pelatihan_jenispel">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->kerjasama->Visible) { // kerjasama ?>
		<td data-name="kerjasama" class="<?php echo $t_pelatihan_grid->kerjasama->footerCellClass() ?>"><span id="elf_t_pelatihan_kerjasama" class="t_pelatihan_kerjasama">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->biaya->Visible) { // biaya ?>
		<td data-name="biaya" class="<?php echo $t_pelatihan_grid->biaya->footerCellClass() ?>"><span id="elf_t_pelatihan_biaya" class="t_pelatihan_biaya">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->coachingprogr->Visible) { // coachingprogr ?>
		<td data-name="coachingprogr" class="<?php echo $t_pelatihan_grid->coachingprogr->footerCellClass() ?>"><span id="elf_t_pelatihan_coachingprogr" class="t_pelatihan_coachingprogr">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->area->Visible) { // area ?>
		<td data-name="area" class="<?php echo $t_pelatihan_grid->area->footerCellClass() ?>"><span id="elf_t_pelatihan_area" class="t_pelatihan_area">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->periode_awal->Visible) { // periode_awal ?>
		<td data-name="periode_awal" class="<?php echo $t_pelatihan_grid->periode_awal->footerCellClass() ?>"><span id="elf_t_pelatihan_periode_awal" class="t_pelatihan_periode_awal">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->periode_akhir->Visible) { // periode_akhir ?>
		<td data-name="periode_akhir" class="<?php echo $t_pelatihan_grid->periode_akhir->footerCellClass() ?>"><span id="elf_t_pelatihan_periode_akhir" class="t_pelatihan_periode_akhir">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->tahapan->Visible) { // tahapan ?>
		<td data-name="tahapan" class="<?php echo $t_pelatihan_grid->tahapan->footerCellClass() ?>"><span id="elf_t_pelatihan_tahapan" class="t_pelatihan_tahapan">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->namaberkas->Visible) { // namaberkas ?>
		<td data-name="namaberkas" class="<?php echo $t_pelatihan_grid->namaberkas->footerCellClass() ?>"><span id="elf_t_pelatihan_namaberkas" class="t_pelatihan_namaberkas">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->instruktur->Visible) { // instruktur ?>
		<td data-name="instruktur" class="<?php echo $t_pelatihan_grid->instruktur->footerCellClass() ?>"><span id="elf_t_pelatihan_instruktur" class="t_pelatihan_instruktur">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->tempat->Visible) { // tempat ?>
		<td data-name="tempat" class="<?php echo $t_pelatihan_grid->tempat->footerCellClass() ?>"><span id="elf_t_pelatihan_tempat" class="t_pelatihan_tempat">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->jpeserta->Visible) { // jpeserta ?>
		<td data-name="jpeserta" class="<?php echo $t_pelatihan_grid->jpeserta->footerCellClass() ?>"><span id="elf_t_pelatihan_jpeserta" class="t_pelatihan_jpeserta">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $t_pelatihan_grid->jpeserta->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->targetpes->Visible) { // targetpes ?>
		<td data-name="targetpes" class="<?php echo $t_pelatihan_grid->targetpes->footerCellClass() ?>"><span id="elf_t_pelatihan_targetpes" class="t_pelatihan_targetpes">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $t_pelatihan_grid->targetpes->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_grid->Tahun->Visible) { // Tahun ?>
		<td data-name="Tahun" class="<?php echo $t_pelatihan_grid->Tahun->footerCellClass() ?>"><span id="elf_t_pelatihan_Tahun" class="t_pelatihan_Tahun">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$t_pelatihan_grid->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($t_pelatihan->CurrentMode == "add" || $t_pelatihan->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $t_pelatihan_grid->FormKeyCountName ?>" id="<?php echo $t_pelatihan_grid->FormKeyCountName ?>" value="<?php echo $t_pelatihan_grid->KeyCount ?>">
<?php echo $t_pelatihan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_pelatihan->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $t_pelatihan_grid->FormKeyCountName ?>" id="<?php echo $t_pelatihan_grid->FormKeyCountName ?>" value="<?php echo $t_pelatihan_grid->KeyCount ?>">
<?php echo $t_pelatihan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_pelatihan->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_pelatihangrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_pelatihan_grid->Recordset)
	$t_pelatihan_grid->Recordset->Close();
?>
<?php if ($t_pelatihan_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $t_pelatihan_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_pelatihan_grid->TotalRecords == 0 && !$t_pelatihan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_pelatihan_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$t_pelatihan_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// document.write("page loaded");

	$('.ew-detail-add').hide();
	<?php if(isset($_GET["pegid"]) && !empty($_GET["pegid"])){ ?>
		$('.ew-ext-search-form').hide();
		$('.ew-search-option').hide();
		$('.ew-filter-option').hide();
	<?php } ?>
});
</script>
<?php if (!$t_pelatihan->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_t_pelatihan",
		width: "100%",
		height: "350px"
	});
});
</script>
<?php } ?>
<?php } ?>
<?php
$t_pelatihan_grid->terminate();
?>