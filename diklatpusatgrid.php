<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($diklatpusat_grid))
	$diklatpusat_grid = new diklatpusat_grid();

// Run the page
$diklatpusat_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$diklatpusat_grid->Page_Render();
?>
<?php if (!$diklatpusat_grid->isExport()) { ?>
<script>
var fdiklatpusatgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdiklatpusatgrid = new ew.Form("fdiklatpusatgrid", "grid");
	fdiklatpusatgrid.formKeyCountName = '<?php echo $diklatpusat_grid->FormKeyCountName ?>';

	// Validate form
	fdiklatpusatgrid.validate = function() {
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
			<?php if ($diklatpusat_grid->kdjudul->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjudul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_grid->kdjudul->caption(), $diklatpusat_grid->kdjudul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatpusat_grid->tawal->Required) { ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_grid->tawal->caption(), $diklatpusat_grid->tawal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatpusat_grid->tawal->errorMessage()) ?>");
			<?php if ($diklatpusat_grid->takhir->Required) { ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_grid->takhir->caption(), $diklatpusat_grid->takhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatpusat_grid->takhir->errorMessage()) ?>");
			<?php if ($diklatpusat_grid->dana->Required) { ?>
				elm = this.getElements("x" + infix + "_dana");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_grid->dana->caption(), $diklatpusat_grid->dana->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatpusat_grid->ketua->Required) { ?>
				elm = this.getElements("x" + infix + "_ketua");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_grid->ketua->caption(), $diklatpusat_grid->ketua->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatpusat_grid->sekretaris->Required) { ?>
				elm = this.getElements("x" + infix + "_sekretaris");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_grid->sekretaris->caption(), $diklatpusat_grid->sekretaris->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatpusat_grid->bendahara->Required) { ?>
				elm = this.getElements("x" + infix + "_bendahara");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_grid->bendahara->caption(), $diklatpusat_grid->bendahara->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatpusat_grid->anggota2->Required) { ?>
				elm = this.getElements("x" + infix + "_anggota2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_grid->anggota2->caption(), $diklatpusat_grid->anggota2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatpusat_grid->widyaiswara->Required) { ?>
				elm = this.getElements("x" + infix + "_widyaiswara");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_grid->widyaiswara->caption(), $diklatpusat_grid->widyaiswara->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_widyaiswara");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatpusat_grid->widyaiswara->errorMessage()) ?>");
			<?php if ($diklatpusat_grid->statuspel->Required) { ?>
				elm = this.getElements("x" + infix + "_statuspel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_grid->statuspel->caption(), $diklatpusat_grid->statuspel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatpusat_grid->ket->Required) { ?>
				elm = this.getElements("x" + infix + "_ket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_grid->ket->caption(), $diklatpusat_grid->ket->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatpusat_grid->jenisevaluasi->Required) { ?>
				elm = this.getElements("x" + infix + "_jenisevaluasi[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatpusat_grid->jenisevaluasi->caption(), $diklatpusat_grid->jenisevaluasi->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdiklatpusatgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "kdjudul", false)) return false;
		if (ew.valueChanged(fobj, infix, "tawal", false)) return false;
		if (ew.valueChanged(fobj, infix, "takhir", false)) return false;
		if (ew.valueChanged(fobj, infix, "dana", false)) return false;
		if (ew.valueChanged(fobj, infix, "ketua", false)) return false;
		if (ew.valueChanged(fobj, infix, "sekretaris", false)) return false;
		if (ew.valueChanged(fobj, infix, "bendahara", false)) return false;
		if (ew.valueChanged(fobj, infix, "anggota2", false)) return false;
		if (ew.valueChanged(fobj, infix, "widyaiswara", false)) return false;
		if (ew.valueChanged(fobj, infix, "statuspel", false)) return false;
		if (ew.valueChanged(fobj, infix, "ket", false)) return false;
		if (ew.valueChanged(fobj, infix, "jenisevaluasi[]", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdiklatpusatgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdiklatpusatgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdiklatpusatgrid.lists["x_kdjudul"] = <?php echo $diklatpusat_grid->kdjudul->Lookup->toClientList($diklatpusat_grid) ?>;
	fdiklatpusatgrid.lists["x_kdjudul"].options = <?php echo JsonEncode($diklatpusat_grid->kdjudul->lookupOptions()) ?>;
	fdiklatpusatgrid.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatpusatgrid.lists["x_dana"] = <?php echo $diklatpusat_grid->dana->Lookup->toClientList($diklatpusat_grid) ?>;
	fdiklatpusatgrid.lists["x_dana"].options = <?php echo JsonEncode($diklatpusat_grid->dana->options(FALSE, TRUE)) ?>;
	fdiklatpusatgrid.lists["x_ketua"] = <?php echo $diklatpusat_grid->ketua->Lookup->toClientList($diklatpusat_grid) ?>;
	fdiklatpusatgrid.lists["x_ketua"].options = <?php echo JsonEncode($diklatpusat_grid->ketua->lookupOptions()) ?>;
	fdiklatpusatgrid.autoSuggests["x_ketua"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatpusatgrid.lists["x_sekretaris"] = <?php echo $diklatpusat_grid->sekretaris->Lookup->toClientList($diklatpusat_grid) ?>;
	fdiklatpusatgrid.lists["x_sekretaris"].options = <?php echo JsonEncode($diklatpusat_grid->sekretaris->lookupOptions()) ?>;
	fdiklatpusatgrid.autoSuggests["x_sekretaris"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatpusatgrid.lists["x_bendahara"] = <?php echo $diklatpusat_grid->bendahara->Lookup->toClientList($diklatpusat_grid) ?>;
	fdiklatpusatgrid.lists["x_bendahara"].options = <?php echo JsonEncode($diklatpusat_grid->bendahara->lookupOptions()) ?>;
	fdiklatpusatgrid.autoSuggests["x_bendahara"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatpusatgrid.lists["x_anggota2"] = <?php echo $diklatpusat_grid->anggota2->Lookup->toClientList($diklatpusat_grid) ?>;
	fdiklatpusatgrid.lists["x_anggota2"].options = <?php echo JsonEncode($diklatpusat_grid->anggota2->lookupOptions()) ?>;
	fdiklatpusatgrid.autoSuggests["x_anggota2"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatpusatgrid.lists["x_widyaiswara"] = <?php echo $diklatpusat_grid->widyaiswara->Lookup->toClientList($diklatpusat_grid) ?>;
	fdiklatpusatgrid.lists["x_widyaiswara"].options = <?php echo JsonEncode($diklatpusat_grid->widyaiswara->lookupOptions()) ?>;
	fdiklatpusatgrid.autoSuggests["x_widyaiswara"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatpusatgrid.lists["x_statuspel"] = <?php echo $diklatpusat_grid->statuspel->Lookup->toClientList($diklatpusat_grid) ?>;
	fdiklatpusatgrid.lists["x_statuspel"].options = <?php echo JsonEncode($diklatpusat_grid->statuspel->options(FALSE, TRUE)) ?>;
	fdiklatpusatgrid.lists["x_jenisevaluasi[]"] = <?php echo $diklatpusat_grid->jenisevaluasi->Lookup->toClientList($diklatpusat_grid) ?>;
	fdiklatpusatgrid.lists["x_jenisevaluasi[]"].options = <?php echo JsonEncode($diklatpusat_grid->jenisevaluasi->lookupOptions()) ?>;
	loadjs.done("fdiklatpusatgrid");
});
</script>
<?php } ?>
<?php
$diklatpusat_grid->renderOtherOptions();
?>
<?php if ($diklatpusat_grid->TotalRecords > 0 || $diklatpusat->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($diklatpusat_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> diklatpusat">
<?php if ($diklatpusat_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $diklatpusat_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdiklatpusatgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_diklatpusat" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_diklatpusatgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$diklatpusat->RowType = ROWTYPE_HEADER;

// Render list options
$diklatpusat_grid->renderListOptions();

// Render list options (header, left)
$diklatpusat_grid->ListOptions->render("header", "left");
?>
<?php if ($diklatpusat_grid->kdjudul->Visible) { // kdjudul ?>
	<?php if ($diklatpusat_grid->SortUrl($diklatpusat_grid->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $diklatpusat_grid->kdjudul->headerCellClass() ?>"><div id="elh_diklatpusat_kdjudul" class="diklatpusat_kdjudul"><div class="ew-table-header-caption"><?php echo $diklatpusat_grid->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $diklatpusat_grid->kdjudul->headerCellClass() ?>"><div><div id="elh_diklatpusat_kdjudul" class="diklatpusat_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_grid->kdjudul->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_grid->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_grid->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatpusat_grid->tawal->Visible) { // tawal ?>
	<?php if ($diklatpusat_grid->SortUrl($diklatpusat_grid->tawal) == "") { ?>
		<th data-name="tawal" class="<?php echo $diklatpusat_grid->tawal->headerCellClass() ?>"><div id="elh_diklatpusat_tawal" class="diklatpusat_tawal"><div class="ew-table-header-caption"><?php echo $diklatpusat_grid->tawal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tawal" class="<?php echo $diklatpusat_grid->tawal->headerCellClass() ?>"><div><div id="elh_diklatpusat_tawal" class="diklatpusat_tawal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_grid->tawal->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_grid->tawal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_grid->tawal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatpusat_grid->takhir->Visible) { // takhir ?>
	<?php if ($diklatpusat_grid->SortUrl($diklatpusat_grid->takhir) == "") { ?>
		<th data-name="takhir" class="<?php echo $diklatpusat_grid->takhir->headerCellClass() ?>"><div id="elh_diklatpusat_takhir" class="diklatpusat_takhir"><div class="ew-table-header-caption"><?php echo $diklatpusat_grid->takhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="takhir" class="<?php echo $diklatpusat_grid->takhir->headerCellClass() ?>"><div><div id="elh_diklatpusat_takhir" class="diklatpusat_takhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_grid->takhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_grid->takhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_grid->takhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatpusat_grid->dana->Visible) { // dana ?>
	<?php if ($diklatpusat_grid->SortUrl($diklatpusat_grid->dana) == "") { ?>
		<th data-name="dana" class="<?php echo $diklatpusat_grid->dana->headerCellClass() ?>"><div id="elh_diklatpusat_dana" class="diklatpusat_dana"><div class="ew-table-header-caption"><?php echo $diklatpusat_grid->dana->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="dana" class="<?php echo $diklatpusat_grid->dana->headerCellClass() ?>"><div><div id="elh_diklatpusat_dana" class="diklatpusat_dana">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_grid->dana->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_grid->dana->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_grid->dana->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatpusat_grid->ketua->Visible) { // ketua ?>
	<?php if ($diklatpusat_grid->SortUrl($diklatpusat_grid->ketua) == "") { ?>
		<th data-name="ketua" class="<?php echo $diklatpusat_grid->ketua->headerCellClass() ?>"><div id="elh_diklatpusat_ketua" class="diklatpusat_ketua"><div class="ew-table-header-caption"><?php echo $diklatpusat_grid->ketua->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ketua" class="<?php echo $diklatpusat_grid->ketua->headerCellClass() ?>"><div><div id="elh_diklatpusat_ketua" class="diklatpusat_ketua">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_grid->ketua->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_grid->ketua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_grid->ketua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatpusat_grid->sekretaris->Visible) { // sekretaris ?>
	<?php if ($diklatpusat_grid->SortUrl($diklatpusat_grid->sekretaris) == "") { ?>
		<th data-name="sekretaris" class="<?php echo $diklatpusat_grid->sekretaris->headerCellClass() ?>"><div id="elh_diklatpusat_sekretaris" class="diklatpusat_sekretaris"><div class="ew-table-header-caption"><?php echo $diklatpusat_grid->sekretaris->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sekretaris" class="<?php echo $diklatpusat_grid->sekretaris->headerCellClass() ?>"><div><div id="elh_diklatpusat_sekretaris" class="diklatpusat_sekretaris">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_grid->sekretaris->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_grid->sekretaris->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_grid->sekretaris->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatpusat_grid->bendahara->Visible) { // bendahara ?>
	<?php if ($diklatpusat_grid->SortUrl($diklatpusat_grid->bendahara) == "") { ?>
		<th data-name="bendahara" class="<?php echo $diklatpusat_grid->bendahara->headerCellClass() ?>"><div id="elh_diklatpusat_bendahara" class="diklatpusat_bendahara"><div class="ew-table-header-caption"><?php echo $diklatpusat_grid->bendahara->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bendahara" class="<?php echo $diklatpusat_grid->bendahara->headerCellClass() ?>"><div><div id="elh_diklatpusat_bendahara" class="diklatpusat_bendahara">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_grid->bendahara->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_grid->bendahara->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_grid->bendahara->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatpusat_grid->anggota2->Visible) { // anggota2 ?>
	<?php if ($diklatpusat_grid->SortUrl($diklatpusat_grid->anggota2) == "") { ?>
		<th data-name="anggota2" class="<?php echo $diklatpusat_grid->anggota2->headerCellClass() ?>"><div id="elh_diklatpusat_anggota2" class="diklatpusat_anggota2"><div class="ew-table-header-caption"><?php echo $diklatpusat_grid->anggota2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="anggota2" class="<?php echo $diklatpusat_grid->anggota2->headerCellClass() ?>"><div><div id="elh_diklatpusat_anggota2" class="diklatpusat_anggota2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_grid->anggota2->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_grid->anggota2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_grid->anggota2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatpusat_grid->widyaiswara->Visible) { // widyaiswara ?>
	<?php if ($diklatpusat_grid->SortUrl($diklatpusat_grid->widyaiswara) == "") { ?>
		<th data-name="widyaiswara" class="<?php echo $diklatpusat_grid->widyaiswara->headerCellClass() ?>"><div id="elh_diklatpusat_widyaiswara" class="diklatpusat_widyaiswara"><div class="ew-table-header-caption"><?php echo $diklatpusat_grid->widyaiswara->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="widyaiswara" class="<?php echo $diklatpusat_grid->widyaiswara->headerCellClass() ?>"><div><div id="elh_diklatpusat_widyaiswara" class="diklatpusat_widyaiswara">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_grid->widyaiswara->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_grid->widyaiswara->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_grid->widyaiswara->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatpusat_grid->statuspel->Visible) { // statuspel ?>
	<?php if ($diklatpusat_grid->SortUrl($diklatpusat_grid->statuspel) == "") { ?>
		<th data-name="statuspel" class="<?php echo $diklatpusat_grid->statuspel->headerCellClass() ?>"><div id="elh_diklatpusat_statuspel" class="diklatpusat_statuspel"><div class="ew-table-header-caption"><?php echo $diklatpusat_grid->statuspel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="statuspel" class="<?php echo $diklatpusat_grid->statuspel->headerCellClass() ?>"><div><div id="elh_diklatpusat_statuspel" class="diklatpusat_statuspel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_grid->statuspel->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_grid->statuspel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_grid->statuspel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatpusat_grid->ket->Visible) { // ket ?>
	<?php if ($diklatpusat_grid->SortUrl($diklatpusat_grid->ket) == "") { ?>
		<th data-name="ket" class="<?php echo $diklatpusat_grid->ket->headerCellClass() ?>"><div id="elh_diklatpusat_ket" class="diklatpusat_ket"><div class="ew-table-header-caption"><?php echo $diklatpusat_grid->ket->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ket" class="<?php echo $diklatpusat_grid->ket->headerCellClass() ?>"><div><div id="elh_diklatpusat_ket" class="diklatpusat_ket">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_grid->ket->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_grid->ket->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_grid->ket->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatpusat_grid->jenisevaluasi->Visible) { // jenisevaluasi ?>
	<?php if ($diklatpusat_grid->SortUrl($diklatpusat_grid->jenisevaluasi) == "") { ?>
		<th data-name="jenisevaluasi" class="<?php echo $diklatpusat_grid->jenisevaluasi->headerCellClass() ?>"><div id="elh_diklatpusat_jenisevaluasi" class="diklatpusat_jenisevaluasi"><div class="ew-table-header-caption"><?php echo $diklatpusat_grid->jenisevaluasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenisevaluasi" class="<?php echo $diklatpusat_grid->jenisevaluasi->headerCellClass() ?>"><div><div id="elh_diklatpusat_jenisevaluasi" class="diklatpusat_jenisevaluasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_grid->jenisevaluasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_grid->jenisevaluasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_grid->jenisevaluasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$diklatpusat_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$diklatpusat_grid->StartRecord = 1;
$diklatpusat_grid->StopRecord = $diklatpusat_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($diklatpusat->isConfirm() || $diklatpusat_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($diklatpusat_grid->FormKeyCountName) && ($diklatpusat_grid->isGridAdd() || $diklatpusat_grid->isGridEdit() || $diklatpusat->isConfirm())) {
		$diklatpusat_grid->KeyCount = $CurrentForm->getValue($diklatpusat_grid->FormKeyCountName);
		$diklatpusat_grid->StopRecord = $diklatpusat_grid->StartRecord + $diklatpusat_grid->KeyCount - 1;
	}
}
$diklatpusat_grid->RecordCount = $diklatpusat_grid->StartRecord - 1;
if ($diklatpusat_grid->Recordset && !$diklatpusat_grid->Recordset->EOF) {
	$diklatpusat_grid->Recordset->moveFirst();
	$selectLimit = $diklatpusat_grid->UseSelectLimit;
	if (!$selectLimit && $diklatpusat_grid->StartRecord > 1)
		$diklatpusat_grid->Recordset->move($diklatpusat_grid->StartRecord - 1);
} elseif (!$diklatpusat->AllowAddDeleteRow && $diklatpusat_grid->StopRecord == 0) {
	$diklatpusat_grid->StopRecord = $diklatpusat->GridAddRowCount;
}

// Initialize aggregate
$diklatpusat->RowType = ROWTYPE_AGGREGATEINIT;
$diklatpusat->resetAttributes();
$diklatpusat_grid->renderRow();
if ($diklatpusat_grid->isGridAdd())
	$diklatpusat_grid->RowIndex = 0;
if ($diklatpusat_grid->isGridEdit())
	$diklatpusat_grid->RowIndex = 0;
while ($diklatpusat_grid->RecordCount < $diklatpusat_grid->StopRecord) {
	$diklatpusat_grid->RecordCount++;
	if ($diklatpusat_grid->RecordCount >= $diklatpusat_grid->StartRecord) {
		$diklatpusat_grid->RowCount++;
		if ($diklatpusat_grid->isGridAdd() || $diklatpusat_grid->isGridEdit() || $diklatpusat->isConfirm()) {
			$diklatpusat_grid->RowIndex++;
			$CurrentForm->Index = $diklatpusat_grid->RowIndex;
			if ($CurrentForm->hasValue($diklatpusat_grid->FormActionName) && ($diklatpusat->isConfirm() || $diklatpusat_grid->EventCancelled))
				$diklatpusat_grid->RowAction = strval($CurrentForm->getValue($diklatpusat_grid->FormActionName));
			elseif ($diklatpusat_grid->isGridAdd())
				$diklatpusat_grid->RowAction = "insert";
			else
				$diklatpusat_grid->RowAction = "";
		}

		// Set up key count
		$diklatpusat_grid->KeyCount = $diklatpusat_grid->RowIndex;

		// Init row class and style
		$diklatpusat->resetAttributes();
		$diklatpusat->CssClass = "";
		if ($diklatpusat_grid->isGridAdd()) {
			if ($diklatpusat->CurrentMode == "copy") {
				$diklatpusat_grid->loadRowValues($diklatpusat_grid->Recordset); // Load row values
				$diklatpusat_grid->setRecordKey($diklatpusat_grid->RowOldKey, $diklatpusat_grid->Recordset); // Set old record key
			} else {
				$diklatpusat_grid->loadRowValues(); // Load default values
				$diklatpusat_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$diklatpusat_grid->loadRowValues($diklatpusat_grid->Recordset); // Load row values
		}
		$diklatpusat->RowType = ROWTYPE_VIEW; // Render view
		if ($diklatpusat_grid->isGridAdd()) // Grid add
			$diklatpusat->RowType = ROWTYPE_ADD; // Render add
		if ($diklatpusat_grid->isGridAdd() && $diklatpusat->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$diklatpusat_grid->restoreCurrentRowFormValues($diklatpusat_grid->RowIndex); // Restore form values
		if ($diklatpusat_grid->isGridEdit()) { // Grid edit
			if ($diklatpusat->EventCancelled)
				$diklatpusat_grid->restoreCurrentRowFormValues($diklatpusat_grid->RowIndex); // Restore form values
			if ($diklatpusat_grid->RowAction == "insert")
				$diklatpusat->RowType = ROWTYPE_ADD; // Render add
			else
				$diklatpusat->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($diklatpusat_grid->isGridEdit() && ($diklatpusat->RowType == ROWTYPE_EDIT || $diklatpusat->RowType == ROWTYPE_ADD) && $diklatpusat->EventCancelled) // Update failed
			$diklatpusat_grid->restoreCurrentRowFormValues($diklatpusat_grid->RowIndex); // Restore form values
		if ($diklatpusat->RowType == ROWTYPE_EDIT) // Edit row
			$diklatpusat_grid->EditRowCount++;
		if ($diklatpusat->isConfirm()) // Confirm row
			$diklatpusat_grid->restoreCurrentRowFormValues($diklatpusat_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$diklatpusat->RowAttrs->merge(["data-rowindex" => $diklatpusat_grid->RowCount, "id" => "r" . $diklatpusat_grid->RowCount . "_diklatpusat", "data-rowtype" => $diklatpusat->RowType]);

		// Render row
		$diklatpusat_grid->renderRow();

		// Render list options
		$diklatpusat_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($diklatpusat_grid->RowAction != "delete" && $diklatpusat_grid->RowAction != "insertdelete" && !($diklatpusat_grid->RowAction == "insert" && $diklatpusat->isConfirm() && $diklatpusat_grid->emptyRow())) {
?>
	<tr <?php echo $diklatpusat->rowAttributes() ?>>
<?php

// Render list options (body, left)
$diklatpusat_grid->ListOptions->render("body", "left", $diklatpusat_grid->RowCount);
?>
	<?php if ($diklatpusat_grid->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $diklatpusat_grid->kdjudul->cellAttributes() ?>>
<?php if ($diklatpusat->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($diklatpusat_grid->kdjudul->getSessionValue() != "") { ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_kdjudul" class="form-group">
<span<?php echo $diklatpusat_grid->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatpusat_grid->kdjudul->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" name="x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($diklatpusat_grid->kdjudul->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_kdjudul" class="form-group">
<?php
$onchange = $diklatpusat_grid->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_grid->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" id="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" value="<?php echo RemoveHtml($diklatpusat_grid->kdjudul->EditValue) ?>" size="100" placeholder="<?php echo HtmlEncode($diklatpusat_grid->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_grid->kdjudul->getPlaceHolder()) ?>"<?php echo $diklatpusat_grid->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_kdjudul" data-value-separator="<?php echo $diklatpusat_grid->kdjudul->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" id="x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($diklatpusat_grid->kdjudul->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatgrid"], function() {
	fdiklatpusatgrid.createAutoSuggest({"id":"x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul","forceSelect":true,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $diklatpusat_grid->kdjudul->Lookup->getParamTag($diklatpusat_grid, "p_x" . $diklatpusat_grid->RowIndex . "_kdjudul") ?>
</span>
<?php } ?>
<input type="hidden" data-table="diklatpusat" data-field="x_kdjudul" name="o<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" id="o<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($diklatpusat_grid->kdjudul->OldValue) ?>">
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_kdjudul" class="form-group">
<span<?php echo $diklatpusat_grid->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatpusat_grid->kdjudul->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_kdjudul" name="x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" id="x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($diklatpusat_grid->kdjudul->CurrentValue) ?>">
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_kdjudul">
<span<?php echo $diklatpusat_grid->kdjudul->viewAttributes() ?>><?php echo $diklatpusat_grid->kdjudul->getViewValue() ?></span>
</span>
<?php if (!$diklatpusat->isConfirm()) { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_kdjudul" name="x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" id="x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($diklatpusat_grid->kdjudul->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_kdjudul" name="o<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" id="o<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($diklatpusat_grid->kdjudul->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_kdjudul" name="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" id="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($diklatpusat_grid->kdjudul->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_kdjudul" name="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" id="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($diklatpusat_grid->kdjudul->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="diklatpusat" data-field="x_idpelat" name="x<?php echo $diklatpusat_grid->RowIndex ?>_idpelat" id="x<?php echo $diklatpusat_grid->RowIndex ?>_idpelat" value="<?php echo HtmlEncode($diklatpusat_grid->idpelat->CurrentValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_idpelat" name="o<?php echo $diklatpusat_grid->RowIndex ?>_idpelat" id="o<?php echo $diklatpusat_grid->RowIndex ?>_idpelat" value="<?php echo HtmlEncode($diklatpusat_grid->idpelat->OldValue) ?>">
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_EDIT || $diklatpusat->CurrentMode == "edit") { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_idpelat" name="x<?php echo $diklatpusat_grid->RowIndex ?>_idpelat" id="x<?php echo $diklatpusat_grid->RowIndex ?>_idpelat" value="<?php echo HtmlEncode($diklatpusat_grid->idpelat->CurrentValue) ?>">
<?php } ?>
	<?php if ($diklatpusat_grid->tawal->Visible) { // tawal ?>
		<td data-name="tawal" <?php echo $diklatpusat_grid->tawal->cellAttributes() ?>>
<?php if ($diklatpusat->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_tawal" class="form-group">
<input type="text" data-table="diklatpusat" data-field="x_tawal" name="x<?php echo $diklatpusat_grid->RowIndex ?>_tawal" id="x<?php echo $diklatpusat_grid->RowIndex ?>_tawal" size="10" placeholder="<?php echo HtmlEncode($diklatpusat_grid->tawal->getPlaceHolder()) ?>" value="<?php echo $diklatpusat_grid->tawal->EditValue ?>"<?php echo $diklatpusat_grid->tawal->editAttributes() ?>>
<?php if (!$diklatpusat_grid->tawal->ReadOnly && !$diklatpusat_grid->tawal->Disabled && !isset($diklatpusat_grid->tawal->EditAttrs["readonly"]) && !isset($diklatpusat_grid->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiklatpusatgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdiklatpusatgrid", "x<?php echo $diklatpusat_grid->RowIndex ?>_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_tawal" name="o<?php echo $diklatpusat_grid->RowIndex ?>_tawal" id="o<?php echo $diklatpusat_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($diklatpusat_grid->tawal->OldValue) ?>">
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_tawal" class="form-group">
<input type="text" data-table="diklatpusat" data-field="x_tawal" name="x<?php echo $diklatpusat_grid->RowIndex ?>_tawal" id="x<?php echo $diklatpusat_grid->RowIndex ?>_tawal" size="10" placeholder="<?php echo HtmlEncode($diklatpusat_grid->tawal->getPlaceHolder()) ?>" value="<?php echo $diklatpusat_grid->tawal->EditValue ?>"<?php echo $diklatpusat_grid->tawal->editAttributes() ?>>
<?php if (!$diklatpusat_grid->tawal->ReadOnly && !$diklatpusat_grid->tawal->Disabled && !isset($diklatpusat_grid->tawal->EditAttrs["readonly"]) && !isset($diklatpusat_grid->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiklatpusatgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdiklatpusatgrid", "x<?php echo $diklatpusat_grid->RowIndex ?>_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_tawal">
<span<?php echo $diklatpusat_grid->tawal->viewAttributes() ?>><?php echo $diklatpusat_grid->tawal->getViewValue() ?></span>
</span>
<?php if (!$diklatpusat->isConfirm()) { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_tawal" name="x<?php echo $diklatpusat_grid->RowIndex ?>_tawal" id="x<?php echo $diklatpusat_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($diklatpusat_grid->tawal->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_tawal" name="o<?php echo $diklatpusat_grid->RowIndex ?>_tawal" id="o<?php echo $diklatpusat_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($diklatpusat_grid->tawal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_tawal" name="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_tawal" id="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($diklatpusat_grid->tawal->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_tawal" name="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_tawal" id="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($diklatpusat_grid->tawal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatpusat_grid->takhir->Visible) { // takhir ?>
		<td data-name="takhir" <?php echo $diklatpusat_grid->takhir->cellAttributes() ?>>
<?php if ($diklatpusat->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_takhir" class="form-group">
<input type="text" data-table="diklatpusat" data-field="x_takhir" name="x<?php echo $diklatpusat_grid->RowIndex ?>_takhir" id="x<?php echo $diklatpusat_grid->RowIndex ?>_takhir" size="10" placeholder="<?php echo HtmlEncode($diklatpusat_grid->takhir->getPlaceHolder()) ?>" value="<?php echo $diklatpusat_grid->takhir->EditValue ?>"<?php echo $diklatpusat_grid->takhir->editAttributes() ?>>
<?php if (!$diklatpusat_grid->takhir->ReadOnly && !$diklatpusat_grid->takhir->Disabled && !isset($diklatpusat_grid->takhir->EditAttrs["readonly"]) && !isset($diklatpusat_grid->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiklatpusatgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdiklatpusatgrid", "x<?php echo $diklatpusat_grid->RowIndex ?>_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_takhir" name="o<?php echo $diklatpusat_grid->RowIndex ?>_takhir" id="o<?php echo $diklatpusat_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($diklatpusat_grid->takhir->OldValue) ?>">
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_takhir" class="form-group">
<input type="text" data-table="diklatpusat" data-field="x_takhir" name="x<?php echo $diklatpusat_grid->RowIndex ?>_takhir" id="x<?php echo $diklatpusat_grid->RowIndex ?>_takhir" size="10" placeholder="<?php echo HtmlEncode($diklatpusat_grid->takhir->getPlaceHolder()) ?>" value="<?php echo $diklatpusat_grid->takhir->EditValue ?>"<?php echo $diklatpusat_grid->takhir->editAttributes() ?>>
<?php if (!$diklatpusat_grid->takhir->ReadOnly && !$diklatpusat_grid->takhir->Disabled && !isset($diklatpusat_grid->takhir->EditAttrs["readonly"]) && !isset($diklatpusat_grid->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiklatpusatgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdiklatpusatgrid", "x<?php echo $diklatpusat_grid->RowIndex ?>_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_takhir">
<span<?php echo $diklatpusat_grid->takhir->viewAttributes() ?>><?php echo $diklatpusat_grid->takhir->getViewValue() ?></span>
</span>
<?php if (!$diklatpusat->isConfirm()) { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_takhir" name="x<?php echo $diklatpusat_grid->RowIndex ?>_takhir" id="x<?php echo $diklatpusat_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($diklatpusat_grid->takhir->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_takhir" name="o<?php echo $diklatpusat_grid->RowIndex ?>_takhir" id="o<?php echo $diklatpusat_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($diklatpusat_grid->takhir->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_takhir" name="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_takhir" id="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($diklatpusat_grid->takhir->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_takhir" name="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_takhir" id="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($diklatpusat_grid->takhir->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatpusat_grid->dana->Visible) { // dana ?>
		<td data-name="dana" <?php echo $diklatpusat_grid->dana->cellAttributes() ?>>
<?php if ($diklatpusat->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_dana" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatpusat" data-field="x_dana" data-value-separator="<?php echo $diklatpusat_grid->dana->displayValueSeparatorAttribute() ?>" id="x<?php echo $diklatpusat_grid->RowIndex ?>_dana" name="x<?php echo $diklatpusat_grid->RowIndex ?>_dana"<?php echo $diklatpusat_grid->dana->editAttributes() ?>>
			<?php echo $diklatpusat_grid->dana->selectOptionListHtml("x{$diklatpusat_grid->RowIndex}_dana") ?>
		</select>
</div>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_dana" name="o<?php echo $diklatpusat_grid->RowIndex ?>_dana" id="o<?php echo $diklatpusat_grid->RowIndex ?>_dana" value="<?php echo HtmlEncode($diklatpusat_grid->dana->OldValue) ?>">
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_dana" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatpusat" data-field="x_dana" data-value-separator="<?php echo $diklatpusat_grid->dana->displayValueSeparatorAttribute() ?>" id="x<?php echo $diklatpusat_grid->RowIndex ?>_dana" name="x<?php echo $diklatpusat_grid->RowIndex ?>_dana"<?php echo $diklatpusat_grid->dana->editAttributes() ?>>
			<?php echo $diklatpusat_grid->dana->selectOptionListHtml("x{$diklatpusat_grid->RowIndex}_dana") ?>
		</select>
</div>
</span>
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_dana">
<span<?php echo $diklatpusat_grid->dana->viewAttributes() ?>><?php echo $diklatpusat_grid->dana->getViewValue() ?></span>
</span>
<?php if (!$diklatpusat->isConfirm()) { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_dana" name="x<?php echo $diklatpusat_grid->RowIndex ?>_dana" id="x<?php echo $diklatpusat_grid->RowIndex ?>_dana" value="<?php echo HtmlEncode($diklatpusat_grid->dana->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_dana" name="o<?php echo $diklatpusat_grid->RowIndex ?>_dana" id="o<?php echo $diklatpusat_grid->RowIndex ?>_dana" value="<?php echo HtmlEncode($diklatpusat_grid->dana->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_dana" name="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_dana" id="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_dana" value="<?php echo HtmlEncode($diklatpusat_grid->dana->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_dana" name="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_dana" id="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_dana" value="<?php echo HtmlEncode($diklatpusat_grid->dana->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatpusat_grid->ketua->Visible) { // ketua ?>
		<td data-name="ketua" <?php echo $diklatpusat_grid->ketua->cellAttributes() ?>>
<?php if ($diklatpusat->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_ketua" class="form-group">
<?php
$onchange = $diklatpusat_grid->ketua->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_grid->ketua->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatpusat_grid->RowIndex ?>_ketua">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_ketua" id="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_ketua" value="<?php echo RemoveHtml($diklatpusat_grid->ketua->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatpusat_grid->ketua->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_grid->ketua->getPlaceHolder()) ?>"<?php echo $diklatpusat_grid->ketua->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_ketua" data-value-separator="<?php echo $diklatpusat_grid->ketua->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatpusat_grid->RowIndex ?>_ketua" id="x<?php echo $diklatpusat_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($diklatpusat_grid->ketua->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatgrid"], function() {
	fdiklatpusatgrid.createAutoSuggest({"id":"x<?php echo $diklatpusat_grid->RowIndex ?>_ketua","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $diklatpusat_grid->ketua->Lookup->getParamTag($diklatpusat_grid, "p_x" . $diklatpusat_grid->RowIndex . "_ketua") ?>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_ketua" name="o<?php echo $diklatpusat_grid->RowIndex ?>_ketua" id="o<?php echo $diklatpusat_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($diklatpusat_grid->ketua->OldValue) ?>">
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_ketua" class="form-group">
<?php
$onchange = $diklatpusat_grid->ketua->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_grid->ketua->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatpusat_grid->RowIndex ?>_ketua">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_ketua" id="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_ketua" value="<?php echo RemoveHtml($diklatpusat_grid->ketua->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatpusat_grid->ketua->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_grid->ketua->getPlaceHolder()) ?>"<?php echo $diklatpusat_grid->ketua->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_ketua" data-value-separator="<?php echo $diklatpusat_grid->ketua->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatpusat_grid->RowIndex ?>_ketua" id="x<?php echo $diklatpusat_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($diklatpusat_grid->ketua->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatgrid"], function() {
	fdiklatpusatgrid.createAutoSuggest({"id":"x<?php echo $diklatpusat_grid->RowIndex ?>_ketua","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $diklatpusat_grid->ketua->Lookup->getParamTag($diklatpusat_grid, "p_x" . $diklatpusat_grid->RowIndex . "_ketua") ?>
</span>
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_ketua">
<span<?php echo $diklatpusat_grid->ketua->viewAttributes() ?>><?php echo $diklatpusat_grid->ketua->getViewValue() ?></span>
</span>
<?php if (!$diklatpusat->isConfirm()) { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_ketua" name="x<?php echo $diklatpusat_grid->RowIndex ?>_ketua" id="x<?php echo $diklatpusat_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($diklatpusat_grid->ketua->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_ketua" name="o<?php echo $diklatpusat_grid->RowIndex ?>_ketua" id="o<?php echo $diklatpusat_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($diklatpusat_grid->ketua->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_ketua" name="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_ketua" id="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($diklatpusat_grid->ketua->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_ketua" name="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_ketua" id="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($diklatpusat_grid->ketua->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatpusat_grid->sekretaris->Visible) { // sekretaris ?>
		<td data-name="sekretaris" <?php echo $diklatpusat_grid->sekretaris->cellAttributes() ?>>
<?php if ($diklatpusat->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_sekretaris" class="form-group">
<?php
$onchange = $diklatpusat_grid->sekretaris->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_grid->sekretaris->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" id="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" value="<?php echo RemoveHtml($diklatpusat_grid->sekretaris->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatpusat_grid->sekretaris->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_grid->sekretaris->getPlaceHolder()) ?>"<?php echo $diklatpusat_grid->sekretaris->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_sekretaris" data-value-separator="<?php echo $diklatpusat_grid->sekretaris->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" id="x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($diklatpusat_grid->sekretaris->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatgrid"], function() {
	fdiklatpusatgrid.createAutoSuggest({"id":"x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris","forceSelect":true,"minWidth":"505px","maxHeight":"333px"});
});
</script>
<?php echo $diklatpusat_grid->sekretaris->Lookup->getParamTag($diklatpusat_grid, "p_x" . $diklatpusat_grid->RowIndex . "_sekretaris") ?>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_sekretaris" name="o<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" id="o<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($diklatpusat_grid->sekretaris->OldValue) ?>">
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_sekretaris" class="form-group">
<?php
$onchange = $diklatpusat_grid->sekretaris->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_grid->sekretaris->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" id="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" value="<?php echo RemoveHtml($diklatpusat_grid->sekretaris->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatpusat_grid->sekretaris->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_grid->sekretaris->getPlaceHolder()) ?>"<?php echo $diklatpusat_grid->sekretaris->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_sekretaris" data-value-separator="<?php echo $diklatpusat_grid->sekretaris->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" id="x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($diklatpusat_grid->sekretaris->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatgrid"], function() {
	fdiklatpusatgrid.createAutoSuggest({"id":"x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris","forceSelect":true,"minWidth":"505px","maxHeight":"333px"});
});
</script>
<?php echo $diklatpusat_grid->sekretaris->Lookup->getParamTag($diklatpusat_grid, "p_x" . $diklatpusat_grid->RowIndex . "_sekretaris") ?>
</span>
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_sekretaris">
<span<?php echo $diklatpusat_grid->sekretaris->viewAttributes() ?>><?php echo $diklatpusat_grid->sekretaris->getViewValue() ?></span>
</span>
<?php if (!$diklatpusat->isConfirm()) { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_sekretaris" name="x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" id="x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($diklatpusat_grid->sekretaris->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_sekretaris" name="o<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" id="o<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($diklatpusat_grid->sekretaris->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_sekretaris" name="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" id="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($diklatpusat_grid->sekretaris->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_sekretaris" name="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" id="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($diklatpusat_grid->sekretaris->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatpusat_grid->bendahara->Visible) { // bendahara ?>
		<td data-name="bendahara" <?php echo $diklatpusat_grid->bendahara->cellAttributes() ?>>
<?php if ($diklatpusat->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_bendahara" class="form-group">
<?php
$onchange = $diklatpusat_grid->bendahara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_grid->bendahara->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" id="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" value="<?php echo RemoveHtml($diklatpusat_grid->bendahara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatpusat_grid->bendahara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_grid->bendahara->getPlaceHolder()) ?>"<?php echo $diklatpusat_grid->bendahara->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_bendahara" data-value-separator="<?php echo $diklatpusat_grid->bendahara->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" id="x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($diklatpusat_grid->bendahara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatgrid"], function() {
	fdiklatpusatgrid.createAutoSuggest({"id":"x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $diklatpusat_grid->bendahara->Lookup->getParamTag($diklatpusat_grid, "p_x" . $diklatpusat_grid->RowIndex . "_bendahara") ?>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_bendahara" name="o<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" id="o<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($diklatpusat_grid->bendahara->OldValue) ?>">
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_bendahara" class="form-group">
<?php
$onchange = $diklatpusat_grid->bendahara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_grid->bendahara->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" id="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" value="<?php echo RemoveHtml($diklatpusat_grid->bendahara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatpusat_grid->bendahara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_grid->bendahara->getPlaceHolder()) ?>"<?php echo $diklatpusat_grid->bendahara->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_bendahara" data-value-separator="<?php echo $diklatpusat_grid->bendahara->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" id="x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($diklatpusat_grid->bendahara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatgrid"], function() {
	fdiklatpusatgrid.createAutoSuggest({"id":"x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $diklatpusat_grid->bendahara->Lookup->getParamTag($diklatpusat_grid, "p_x" . $diklatpusat_grid->RowIndex . "_bendahara") ?>
</span>
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_bendahara">
<span<?php echo $diklatpusat_grid->bendahara->viewAttributes() ?>><?php echo $diklatpusat_grid->bendahara->getViewValue() ?></span>
</span>
<?php if (!$diklatpusat->isConfirm()) { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_bendahara" name="x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" id="x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($diklatpusat_grid->bendahara->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_bendahara" name="o<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" id="o<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($diklatpusat_grid->bendahara->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_bendahara" name="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" id="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($diklatpusat_grid->bendahara->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_bendahara" name="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" id="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($diklatpusat_grid->bendahara->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatpusat_grid->anggota2->Visible) { // anggota2 ?>
		<td data-name="anggota2" <?php echo $diklatpusat_grid->anggota2->cellAttributes() ?>>
<?php if ($diklatpusat->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_anggota2" class="form-group">
<?php
$onchange = $diklatpusat_grid->anggota2->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_grid->anggota2->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" id="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" value="<?php echo RemoveHtml($diklatpusat_grid->anggota2->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatpusat_grid->anggota2->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_grid->anggota2->getPlaceHolder()) ?>"<?php echo $diklatpusat_grid->anggota2->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_anggota2" data-value-separator="<?php echo $diklatpusat_grid->anggota2->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" id="x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" value="<?php echo HtmlEncode($diklatpusat_grid->anggota2->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatgrid"], function() {
	fdiklatpusatgrid.createAutoSuggest({"id":"x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2","forceSelect":true});
});
</script>
<?php echo $diklatpusat_grid->anggota2->Lookup->getParamTag($diklatpusat_grid, "p_x" . $diklatpusat_grid->RowIndex . "_anggota2") ?>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_anggota2" name="o<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" id="o<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" value="<?php echo HtmlEncode($diklatpusat_grid->anggota2->OldValue) ?>">
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_anggota2" class="form-group">
<?php
$onchange = $diklatpusat_grid->anggota2->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_grid->anggota2->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" id="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" value="<?php echo RemoveHtml($diklatpusat_grid->anggota2->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatpusat_grid->anggota2->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_grid->anggota2->getPlaceHolder()) ?>"<?php echo $diklatpusat_grid->anggota2->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_anggota2" data-value-separator="<?php echo $diklatpusat_grid->anggota2->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" id="x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" value="<?php echo HtmlEncode($diklatpusat_grid->anggota2->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatgrid"], function() {
	fdiklatpusatgrid.createAutoSuggest({"id":"x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2","forceSelect":true});
});
</script>
<?php echo $diklatpusat_grid->anggota2->Lookup->getParamTag($diklatpusat_grid, "p_x" . $diklatpusat_grid->RowIndex . "_anggota2") ?>
</span>
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_anggota2">
<span<?php echo $diklatpusat_grid->anggota2->viewAttributes() ?>><?php echo $diklatpusat_grid->anggota2->getViewValue() ?></span>
</span>
<?php if (!$diklatpusat->isConfirm()) { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_anggota2" name="x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" id="x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" value="<?php echo HtmlEncode($diklatpusat_grid->anggota2->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_anggota2" name="o<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" id="o<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" value="<?php echo HtmlEncode($diklatpusat_grid->anggota2->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_anggota2" name="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" id="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" value="<?php echo HtmlEncode($diklatpusat_grid->anggota2->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_anggota2" name="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" id="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" value="<?php echo HtmlEncode($diklatpusat_grid->anggota2->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatpusat_grid->widyaiswara->Visible) { // widyaiswara ?>
		<td data-name="widyaiswara" <?php echo $diklatpusat_grid->widyaiswara->cellAttributes() ?>>
<?php if ($diklatpusat->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_widyaiswara" class="form-group">
<?php
$onchange = $diklatpusat_grid->widyaiswara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_grid->widyaiswara->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" id="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" value="<?php echo RemoveHtml($diklatpusat_grid->widyaiswara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatpusat_grid->widyaiswara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_grid->widyaiswara->getPlaceHolder()) ?>"<?php echo $diklatpusat_grid->widyaiswara->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_widyaiswara" data-value-separator="<?php echo $diklatpusat_grid->widyaiswara->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" id="x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" value="<?php echo HtmlEncode($diklatpusat_grid->widyaiswara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatgrid"], function() {
	fdiklatpusatgrid.createAutoSuggest({"id":"x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara","forceSelect":true});
});
</script>
<?php echo $diklatpusat_grid->widyaiswara->Lookup->getParamTag($diklatpusat_grid, "p_x" . $diklatpusat_grid->RowIndex . "_widyaiswara") ?>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_widyaiswara" name="o<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" id="o<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" value="<?php echo HtmlEncode($diklatpusat_grid->widyaiswara->OldValue) ?>">
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_widyaiswara" class="form-group">
<?php
$onchange = $diklatpusat_grid->widyaiswara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_grid->widyaiswara->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" id="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" value="<?php echo RemoveHtml($diklatpusat_grid->widyaiswara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatpusat_grid->widyaiswara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_grid->widyaiswara->getPlaceHolder()) ?>"<?php echo $diklatpusat_grid->widyaiswara->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_widyaiswara" data-value-separator="<?php echo $diklatpusat_grid->widyaiswara->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" id="x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" value="<?php echo HtmlEncode($diklatpusat_grid->widyaiswara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatgrid"], function() {
	fdiklatpusatgrid.createAutoSuggest({"id":"x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara","forceSelect":true});
});
</script>
<?php echo $diklatpusat_grid->widyaiswara->Lookup->getParamTag($diklatpusat_grid, "p_x" . $diklatpusat_grid->RowIndex . "_widyaiswara") ?>
</span>
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_widyaiswara">
<span<?php echo $diklatpusat_grid->widyaiswara->viewAttributes() ?>><?php echo $diklatpusat_grid->widyaiswara->getViewValue() ?></span>
</span>
<?php if (!$diklatpusat->isConfirm()) { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_widyaiswara" name="x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" id="x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" value="<?php echo HtmlEncode($diklatpusat_grid->widyaiswara->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_widyaiswara" name="o<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" id="o<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" value="<?php echo HtmlEncode($diklatpusat_grid->widyaiswara->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_widyaiswara" name="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" id="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" value="<?php echo HtmlEncode($diklatpusat_grid->widyaiswara->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_widyaiswara" name="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" id="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" value="<?php echo HtmlEncode($diklatpusat_grid->widyaiswara->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatpusat_grid->statuspel->Visible) { // statuspel ?>
		<td data-name="statuspel" <?php echo $diklatpusat_grid->statuspel->cellAttributes() ?>>
<?php if ($diklatpusat->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_statuspel" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatpusat" data-field="x_statuspel" data-value-separator="<?php echo $diklatpusat_grid->statuspel->displayValueSeparatorAttribute() ?>" id="x<?php echo $diklatpusat_grid->RowIndex ?>_statuspel" name="x<?php echo $diklatpusat_grid->RowIndex ?>_statuspel"<?php echo $diklatpusat_grid->statuspel->editAttributes() ?>>
			<?php echo $diklatpusat_grid->statuspel->selectOptionListHtml("x{$diklatpusat_grid->RowIndex}_statuspel") ?>
		</select>
</div>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_statuspel" name="o<?php echo $diklatpusat_grid->RowIndex ?>_statuspel" id="o<?php echo $diklatpusat_grid->RowIndex ?>_statuspel" value="<?php echo HtmlEncode($diklatpusat_grid->statuspel->OldValue) ?>">
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_statuspel" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatpusat" data-field="x_statuspel" data-value-separator="<?php echo $diklatpusat_grid->statuspel->displayValueSeparatorAttribute() ?>" id="x<?php echo $diklatpusat_grid->RowIndex ?>_statuspel" name="x<?php echo $diklatpusat_grid->RowIndex ?>_statuspel"<?php echo $diklatpusat_grid->statuspel->editAttributes() ?>>
			<?php echo $diklatpusat_grid->statuspel->selectOptionListHtml("x{$diklatpusat_grid->RowIndex}_statuspel") ?>
		</select>
</div>
</span>
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_statuspel">
<span<?php echo $diklatpusat_grid->statuspel->viewAttributes() ?>><?php echo $diklatpusat_grid->statuspel->getViewValue() ?></span>
</span>
<?php if (!$diklatpusat->isConfirm()) { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_statuspel" name="x<?php echo $diklatpusat_grid->RowIndex ?>_statuspel" id="x<?php echo $diklatpusat_grid->RowIndex ?>_statuspel" value="<?php echo HtmlEncode($diklatpusat_grid->statuspel->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_statuspel" name="o<?php echo $diklatpusat_grid->RowIndex ?>_statuspel" id="o<?php echo $diklatpusat_grid->RowIndex ?>_statuspel" value="<?php echo HtmlEncode($diklatpusat_grid->statuspel->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_statuspel" name="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_statuspel" id="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_statuspel" value="<?php echo HtmlEncode($diklatpusat_grid->statuspel->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_statuspel" name="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_statuspel" id="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_statuspel" value="<?php echo HtmlEncode($diklatpusat_grid->statuspel->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatpusat_grid->ket->Visible) { // ket ?>
		<td data-name="ket" <?php echo $diklatpusat_grid->ket->cellAttributes() ?>>
<?php if ($diklatpusat->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_ket" class="form-group">
<textarea data-table="diklatpusat" data-field="x_ket" name="x<?php echo $diklatpusat_grid->RowIndex ?>_ket" id="x<?php echo $diklatpusat_grid->RowIndex ?>_ket" cols="15" rows="2" placeholder="<?php echo HtmlEncode($diklatpusat_grid->ket->getPlaceHolder()) ?>"<?php echo $diklatpusat_grid->ket->editAttributes() ?>><?php echo $diklatpusat_grid->ket->EditValue ?></textarea>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_ket" name="o<?php echo $diklatpusat_grid->RowIndex ?>_ket" id="o<?php echo $diklatpusat_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($diklatpusat_grid->ket->OldValue) ?>">
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_ket" class="form-group">
<textarea data-table="diklatpusat" data-field="x_ket" name="x<?php echo $diklatpusat_grid->RowIndex ?>_ket" id="x<?php echo $diklatpusat_grid->RowIndex ?>_ket" cols="15" rows="2" placeholder="<?php echo HtmlEncode($diklatpusat_grid->ket->getPlaceHolder()) ?>"<?php echo $diklatpusat_grid->ket->editAttributes() ?>><?php echo $diklatpusat_grid->ket->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_ket">
<span<?php echo $diklatpusat_grid->ket->viewAttributes() ?>><?php echo $diklatpusat_grid->ket->getViewValue() ?></span>
</span>
<?php if (!$diklatpusat->isConfirm()) { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_ket" name="x<?php echo $diklatpusat_grid->RowIndex ?>_ket" id="x<?php echo $diklatpusat_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($diklatpusat_grid->ket->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_ket" name="o<?php echo $diklatpusat_grid->RowIndex ?>_ket" id="o<?php echo $diklatpusat_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($diklatpusat_grid->ket->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_ket" name="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_ket" id="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($diklatpusat_grid->ket->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_ket" name="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_ket" id="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($diklatpusat_grid->ket->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatpusat_grid->jenisevaluasi->Visible) { // jenisevaluasi ?>
		<td data-name="jenisevaluasi" <?php echo $diklatpusat_grid->jenisevaluasi->cellAttributes() ?>>
<?php if ($diklatpusat->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_jenisevaluasi" class="form-group">
<div id="tp_x<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="diklatpusat" data-field="x_jenisevaluasi" data-value-separator="<?php echo $diklatpusat_grid->jenisevaluasi->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi[]" id="x<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi[]" value="{value}"<?php echo $diklatpusat_grid->jenisevaluasi->editAttributes() ?>></div>
<div id="dsl_x<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi" data-repeatcolumn="1" class="ew-item-list d-none"><div>
<?php echo $diklatpusat_grid->jenisevaluasi->checkBoxListHtml(FALSE, "x{$diklatpusat_grid->RowIndex}_jenisevaluasi[]") ?>
</div></div>
<?php echo $diklatpusat_grid->jenisevaluasi->Lookup->getParamTag($diklatpusat_grid, "p_x" . $diklatpusat_grid->RowIndex . "_jenisevaluasi") ?>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_jenisevaluasi" name="o<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi[]" id="o<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi[]" value="<?php echo HtmlEncode($diklatpusat_grid->jenisevaluasi->OldValue) ?>">
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_jenisevaluasi" class="form-group">
<div id="tp_x<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="diklatpusat" data-field="x_jenisevaluasi" data-value-separator="<?php echo $diklatpusat_grid->jenisevaluasi->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi[]" id="x<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi[]" value="{value}"<?php echo $diklatpusat_grid->jenisevaluasi->editAttributes() ?>></div>
<div id="dsl_x<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi" data-repeatcolumn="1" class="ew-item-list d-none"><div>
<?php echo $diklatpusat_grid->jenisevaluasi->checkBoxListHtml(FALSE, "x{$diklatpusat_grid->RowIndex}_jenisevaluasi[]") ?>
</div></div>
<?php echo $diklatpusat_grid->jenisevaluasi->Lookup->getParamTag($diklatpusat_grid, "p_x" . $diklatpusat_grid->RowIndex . "_jenisevaluasi") ?>
</span>
<?php } ?>
<?php if ($diklatpusat->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatpusat_grid->RowCount ?>_diklatpusat_jenisevaluasi">
<span<?php echo $diklatpusat_grid->jenisevaluasi->viewAttributes() ?>><?php echo $diklatpusat_grid->jenisevaluasi->getViewValue() ?></span>
</span>
<?php if (!$diklatpusat->isConfirm()) { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_jenisevaluasi" name="x<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi" id="x<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi" value="<?php echo HtmlEncode($diklatpusat_grid->jenisevaluasi->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_jenisevaluasi" name="o<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi[]" id="o<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi[]" value="<?php echo HtmlEncode($diklatpusat_grid->jenisevaluasi->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatpusat" data-field="x_jenisevaluasi" name="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi" id="fdiklatpusatgrid$x<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi" value="<?php echo HtmlEncode($diklatpusat_grid->jenisevaluasi->FormValue) ?>">
<input type="hidden" data-table="diklatpusat" data-field="x_jenisevaluasi" name="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi[]" id="fdiklatpusatgrid$o<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi[]" value="<?php echo HtmlEncode($diklatpusat_grid->jenisevaluasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$diklatpusat_grid->ListOptions->render("body", "right", $diklatpusat_grid->RowCount);
?>
	</tr>
<?php if ($diklatpusat->RowType == ROWTYPE_ADD || $diklatpusat->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdiklatpusatgrid", "load"], function() {
	fdiklatpusatgrid.updateLists(<?php echo $diklatpusat_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$diklatpusat_grid->isGridAdd() || $diklatpusat->CurrentMode == "copy")
		if (!$diklatpusat_grid->Recordset->EOF)
			$diklatpusat_grid->Recordset->moveNext();
}
?>
<?php
	if ($diklatpusat->CurrentMode == "add" || $diklatpusat->CurrentMode == "copy" || $diklatpusat->CurrentMode == "edit") {
		$diklatpusat_grid->RowIndex = '$rowindex$';
		$diklatpusat_grid->loadRowValues();

		// Set row properties
		$diklatpusat->resetAttributes();
		$diklatpusat->RowAttrs->merge(["data-rowindex" => $diklatpusat_grid->RowIndex, "id" => "r0_diklatpusat", "data-rowtype" => ROWTYPE_ADD]);
		$diklatpusat->RowAttrs->appendClass("ew-template");
		$diklatpusat->RowType = ROWTYPE_ADD;

		// Render row
		$diklatpusat_grid->renderRow();

		// Render list options
		$diklatpusat_grid->renderListOptions();
		$diklatpusat_grid->StartRowCount = 0;
?>
	<tr <?php echo $diklatpusat->rowAttributes() ?>>
<?php

// Render list options (body, left)
$diklatpusat_grid->ListOptions->render("body", "left", $diklatpusat_grid->RowIndex);
?>
	<?php if ($diklatpusat_grid->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul">
<?php if (!$diklatpusat->isConfirm()) { ?>
<?php if ($diklatpusat_grid->kdjudul->getSessionValue() != "") { ?>
<span id="el$rowindex$_diklatpusat_kdjudul" class="form-group diklatpusat_kdjudul">
<span<?php echo $diklatpusat_grid->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatpusat_grid->kdjudul->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" name="x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($diklatpusat_grid->kdjudul->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_diklatpusat_kdjudul" class="form-group diklatpusat_kdjudul">
<?php
$onchange = $diklatpusat_grid->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_grid->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" id="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" value="<?php echo RemoveHtml($diklatpusat_grid->kdjudul->EditValue) ?>" size="100" placeholder="<?php echo HtmlEncode($diklatpusat_grid->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_grid->kdjudul->getPlaceHolder()) ?>"<?php echo $diklatpusat_grid->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_kdjudul" data-value-separator="<?php echo $diklatpusat_grid->kdjudul->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" id="x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($diklatpusat_grid->kdjudul->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatgrid"], function() {
	fdiklatpusatgrid.createAutoSuggest({"id":"x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul","forceSelect":true,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $diklatpusat_grid->kdjudul->Lookup->getParamTag($diklatpusat_grid, "p_x" . $diklatpusat_grid->RowIndex . "_kdjudul") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_diklatpusat_kdjudul" class="form-group diklatpusat_kdjudul">
<span<?php echo $diklatpusat_grid->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatpusat_grid->kdjudul->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_kdjudul" name="x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" id="x<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($diklatpusat_grid->kdjudul->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatpusat" data-field="x_kdjudul" name="o<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" id="o<?php echo $diklatpusat_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($diklatpusat_grid->kdjudul->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatpusat_grid->tawal->Visible) { // tawal ?>
		<td data-name="tawal">
<?php if (!$diklatpusat->isConfirm()) { ?>
<span id="el$rowindex$_diklatpusat_tawal" class="form-group diklatpusat_tawal">
<input type="text" data-table="diklatpusat" data-field="x_tawal" name="x<?php echo $diklatpusat_grid->RowIndex ?>_tawal" id="x<?php echo $diklatpusat_grid->RowIndex ?>_tawal" size="10" placeholder="<?php echo HtmlEncode($diklatpusat_grid->tawal->getPlaceHolder()) ?>" value="<?php echo $diklatpusat_grid->tawal->EditValue ?>"<?php echo $diklatpusat_grid->tawal->editAttributes() ?>>
<?php if (!$diklatpusat_grid->tawal->ReadOnly && !$diklatpusat_grid->tawal->Disabled && !isset($diklatpusat_grid->tawal->EditAttrs["readonly"]) && !isset($diklatpusat_grid->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiklatpusatgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdiklatpusatgrid", "x<?php echo $diklatpusat_grid->RowIndex ?>_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatpusat_tawal" class="form-group diklatpusat_tawal">
<span<?php echo $diklatpusat_grid->tawal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatpusat_grid->tawal->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_tawal" name="x<?php echo $diklatpusat_grid->RowIndex ?>_tawal" id="x<?php echo $diklatpusat_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($diklatpusat_grid->tawal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatpusat" data-field="x_tawal" name="o<?php echo $diklatpusat_grid->RowIndex ?>_tawal" id="o<?php echo $diklatpusat_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($diklatpusat_grid->tawal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatpusat_grid->takhir->Visible) { // takhir ?>
		<td data-name="takhir">
<?php if (!$diklatpusat->isConfirm()) { ?>
<span id="el$rowindex$_diklatpusat_takhir" class="form-group diklatpusat_takhir">
<input type="text" data-table="diklatpusat" data-field="x_takhir" name="x<?php echo $diklatpusat_grid->RowIndex ?>_takhir" id="x<?php echo $diklatpusat_grid->RowIndex ?>_takhir" size="10" placeholder="<?php echo HtmlEncode($diklatpusat_grid->takhir->getPlaceHolder()) ?>" value="<?php echo $diklatpusat_grid->takhir->EditValue ?>"<?php echo $diklatpusat_grid->takhir->editAttributes() ?>>
<?php if (!$diklatpusat_grid->takhir->ReadOnly && !$diklatpusat_grid->takhir->Disabled && !isset($diklatpusat_grid->takhir->EditAttrs["readonly"]) && !isset($diklatpusat_grid->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiklatpusatgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdiklatpusatgrid", "x<?php echo $diklatpusat_grid->RowIndex ?>_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatpusat_takhir" class="form-group diklatpusat_takhir">
<span<?php echo $diklatpusat_grid->takhir->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatpusat_grid->takhir->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_takhir" name="x<?php echo $diklatpusat_grid->RowIndex ?>_takhir" id="x<?php echo $diklatpusat_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($diklatpusat_grid->takhir->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatpusat" data-field="x_takhir" name="o<?php echo $diklatpusat_grid->RowIndex ?>_takhir" id="o<?php echo $diklatpusat_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($diklatpusat_grid->takhir->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatpusat_grid->dana->Visible) { // dana ?>
		<td data-name="dana">
<?php if (!$diklatpusat->isConfirm()) { ?>
<span id="el$rowindex$_diklatpusat_dana" class="form-group diklatpusat_dana">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatpusat" data-field="x_dana" data-value-separator="<?php echo $diklatpusat_grid->dana->displayValueSeparatorAttribute() ?>" id="x<?php echo $diklatpusat_grid->RowIndex ?>_dana" name="x<?php echo $diklatpusat_grid->RowIndex ?>_dana"<?php echo $diklatpusat_grid->dana->editAttributes() ?>>
			<?php echo $diklatpusat_grid->dana->selectOptionListHtml("x{$diklatpusat_grid->RowIndex}_dana") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatpusat_dana" class="form-group diklatpusat_dana">
<span<?php echo $diklatpusat_grid->dana->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatpusat_grid->dana->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_dana" name="x<?php echo $diklatpusat_grid->RowIndex ?>_dana" id="x<?php echo $diklatpusat_grid->RowIndex ?>_dana" value="<?php echo HtmlEncode($diklatpusat_grid->dana->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatpusat" data-field="x_dana" name="o<?php echo $diklatpusat_grid->RowIndex ?>_dana" id="o<?php echo $diklatpusat_grid->RowIndex ?>_dana" value="<?php echo HtmlEncode($diklatpusat_grid->dana->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatpusat_grid->ketua->Visible) { // ketua ?>
		<td data-name="ketua">
<?php if (!$diklatpusat->isConfirm()) { ?>
<span id="el$rowindex$_diklatpusat_ketua" class="form-group diklatpusat_ketua">
<?php
$onchange = $diklatpusat_grid->ketua->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_grid->ketua->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatpusat_grid->RowIndex ?>_ketua">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_ketua" id="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_ketua" value="<?php echo RemoveHtml($diklatpusat_grid->ketua->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatpusat_grid->ketua->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_grid->ketua->getPlaceHolder()) ?>"<?php echo $diklatpusat_grid->ketua->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_ketua" data-value-separator="<?php echo $diklatpusat_grid->ketua->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatpusat_grid->RowIndex ?>_ketua" id="x<?php echo $diklatpusat_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($diklatpusat_grid->ketua->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatgrid"], function() {
	fdiklatpusatgrid.createAutoSuggest({"id":"x<?php echo $diklatpusat_grid->RowIndex ?>_ketua","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $diklatpusat_grid->ketua->Lookup->getParamTag($diklatpusat_grid, "p_x" . $diklatpusat_grid->RowIndex . "_ketua") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatpusat_ketua" class="form-group diklatpusat_ketua">
<span<?php echo $diklatpusat_grid->ketua->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatpusat_grid->ketua->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_ketua" name="x<?php echo $diklatpusat_grid->RowIndex ?>_ketua" id="x<?php echo $diklatpusat_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($diklatpusat_grid->ketua->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatpusat" data-field="x_ketua" name="o<?php echo $diklatpusat_grid->RowIndex ?>_ketua" id="o<?php echo $diklatpusat_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($diklatpusat_grid->ketua->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatpusat_grid->sekretaris->Visible) { // sekretaris ?>
		<td data-name="sekretaris">
<?php if (!$diklatpusat->isConfirm()) { ?>
<span id="el$rowindex$_diklatpusat_sekretaris" class="form-group diklatpusat_sekretaris">
<?php
$onchange = $diklatpusat_grid->sekretaris->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_grid->sekretaris->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" id="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" value="<?php echo RemoveHtml($diklatpusat_grid->sekretaris->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatpusat_grid->sekretaris->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_grid->sekretaris->getPlaceHolder()) ?>"<?php echo $diklatpusat_grid->sekretaris->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_sekretaris" data-value-separator="<?php echo $diklatpusat_grid->sekretaris->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" id="x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($diklatpusat_grid->sekretaris->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatgrid"], function() {
	fdiklatpusatgrid.createAutoSuggest({"id":"x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris","forceSelect":true,"minWidth":"505px","maxHeight":"333px"});
});
</script>
<?php echo $diklatpusat_grid->sekretaris->Lookup->getParamTag($diklatpusat_grid, "p_x" . $diklatpusat_grid->RowIndex . "_sekretaris") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatpusat_sekretaris" class="form-group diklatpusat_sekretaris">
<span<?php echo $diklatpusat_grid->sekretaris->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatpusat_grid->sekretaris->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_sekretaris" name="x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" id="x<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($diklatpusat_grid->sekretaris->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatpusat" data-field="x_sekretaris" name="o<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" id="o<?php echo $diklatpusat_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($diklatpusat_grid->sekretaris->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatpusat_grid->bendahara->Visible) { // bendahara ?>
		<td data-name="bendahara">
<?php if (!$diklatpusat->isConfirm()) { ?>
<span id="el$rowindex$_diklatpusat_bendahara" class="form-group diklatpusat_bendahara">
<?php
$onchange = $diklatpusat_grid->bendahara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_grid->bendahara->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" id="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" value="<?php echo RemoveHtml($diklatpusat_grid->bendahara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatpusat_grid->bendahara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_grid->bendahara->getPlaceHolder()) ?>"<?php echo $diklatpusat_grid->bendahara->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_bendahara" data-value-separator="<?php echo $diklatpusat_grid->bendahara->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" id="x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($diklatpusat_grid->bendahara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatgrid"], function() {
	fdiklatpusatgrid.createAutoSuggest({"id":"x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $diklatpusat_grid->bendahara->Lookup->getParamTag($diklatpusat_grid, "p_x" . $diklatpusat_grid->RowIndex . "_bendahara") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatpusat_bendahara" class="form-group diklatpusat_bendahara">
<span<?php echo $diklatpusat_grid->bendahara->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatpusat_grid->bendahara->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_bendahara" name="x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" id="x<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($diklatpusat_grid->bendahara->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatpusat" data-field="x_bendahara" name="o<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" id="o<?php echo $diklatpusat_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($diklatpusat_grid->bendahara->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatpusat_grid->anggota2->Visible) { // anggota2 ?>
		<td data-name="anggota2">
<?php if (!$diklatpusat->isConfirm()) { ?>
<span id="el$rowindex$_diklatpusat_anggota2" class="form-group diklatpusat_anggota2">
<?php
$onchange = $diklatpusat_grid->anggota2->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_grid->anggota2->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" id="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" value="<?php echo RemoveHtml($diklatpusat_grid->anggota2->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatpusat_grid->anggota2->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_grid->anggota2->getPlaceHolder()) ?>"<?php echo $diklatpusat_grid->anggota2->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_anggota2" data-value-separator="<?php echo $diklatpusat_grid->anggota2->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" id="x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" value="<?php echo HtmlEncode($diklatpusat_grid->anggota2->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatgrid"], function() {
	fdiklatpusatgrid.createAutoSuggest({"id":"x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2","forceSelect":true});
});
</script>
<?php echo $diklatpusat_grid->anggota2->Lookup->getParamTag($diklatpusat_grid, "p_x" . $diklatpusat_grid->RowIndex . "_anggota2") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatpusat_anggota2" class="form-group diklatpusat_anggota2">
<span<?php echo $diklatpusat_grid->anggota2->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatpusat_grid->anggota2->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_anggota2" name="x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" id="x<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" value="<?php echo HtmlEncode($diklatpusat_grid->anggota2->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatpusat" data-field="x_anggota2" name="o<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" id="o<?php echo $diklatpusat_grid->RowIndex ?>_anggota2" value="<?php echo HtmlEncode($diklatpusat_grid->anggota2->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatpusat_grid->widyaiswara->Visible) { // widyaiswara ?>
		<td data-name="widyaiswara">
<?php if (!$diklatpusat->isConfirm()) { ?>
<span id="el$rowindex$_diklatpusat_widyaiswara" class="form-group diklatpusat_widyaiswara">
<?php
$onchange = $diklatpusat_grid->widyaiswara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatpusat_grid->widyaiswara->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" id="sv_x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" value="<?php echo RemoveHtml($diklatpusat_grid->widyaiswara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatpusat_grid->widyaiswara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatpusat_grid->widyaiswara->getPlaceHolder()) ?>"<?php echo $diklatpusat_grid->widyaiswara->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_widyaiswara" data-value-separator="<?php echo $diklatpusat_grid->widyaiswara->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" id="x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" value="<?php echo HtmlEncode($diklatpusat_grid->widyaiswara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatpusatgrid"], function() {
	fdiklatpusatgrid.createAutoSuggest({"id":"x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara","forceSelect":true});
});
</script>
<?php echo $diklatpusat_grid->widyaiswara->Lookup->getParamTag($diklatpusat_grid, "p_x" . $diklatpusat_grid->RowIndex . "_widyaiswara") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatpusat_widyaiswara" class="form-group diklatpusat_widyaiswara">
<span<?php echo $diklatpusat_grid->widyaiswara->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatpusat_grid->widyaiswara->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_widyaiswara" name="x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" id="x<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" value="<?php echo HtmlEncode($diklatpusat_grid->widyaiswara->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatpusat" data-field="x_widyaiswara" name="o<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" id="o<?php echo $diklatpusat_grid->RowIndex ?>_widyaiswara" value="<?php echo HtmlEncode($diklatpusat_grid->widyaiswara->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatpusat_grid->statuspel->Visible) { // statuspel ?>
		<td data-name="statuspel">
<?php if (!$diklatpusat->isConfirm()) { ?>
<span id="el$rowindex$_diklatpusat_statuspel" class="form-group diklatpusat_statuspel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatpusat" data-field="x_statuspel" data-value-separator="<?php echo $diklatpusat_grid->statuspel->displayValueSeparatorAttribute() ?>" id="x<?php echo $diklatpusat_grid->RowIndex ?>_statuspel" name="x<?php echo $diklatpusat_grid->RowIndex ?>_statuspel"<?php echo $diklatpusat_grid->statuspel->editAttributes() ?>>
			<?php echo $diklatpusat_grid->statuspel->selectOptionListHtml("x{$diklatpusat_grid->RowIndex}_statuspel") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatpusat_statuspel" class="form-group diklatpusat_statuspel">
<span<?php echo $diklatpusat_grid->statuspel->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatpusat_grid->statuspel->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_statuspel" name="x<?php echo $diklatpusat_grid->RowIndex ?>_statuspel" id="x<?php echo $diklatpusat_grid->RowIndex ?>_statuspel" value="<?php echo HtmlEncode($diklatpusat_grid->statuspel->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatpusat" data-field="x_statuspel" name="o<?php echo $diklatpusat_grid->RowIndex ?>_statuspel" id="o<?php echo $diklatpusat_grid->RowIndex ?>_statuspel" value="<?php echo HtmlEncode($diklatpusat_grid->statuspel->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatpusat_grid->ket->Visible) { // ket ?>
		<td data-name="ket">
<?php if (!$diklatpusat->isConfirm()) { ?>
<span id="el$rowindex$_diklatpusat_ket" class="form-group diklatpusat_ket">
<textarea data-table="diklatpusat" data-field="x_ket" name="x<?php echo $diklatpusat_grid->RowIndex ?>_ket" id="x<?php echo $diklatpusat_grid->RowIndex ?>_ket" cols="15" rows="2" placeholder="<?php echo HtmlEncode($diklatpusat_grid->ket->getPlaceHolder()) ?>"<?php echo $diklatpusat_grid->ket->editAttributes() ?>><?php echo $diklatpusat_grid->ket->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatpusat_ket" class="form-group diklatpusat_ket">
<span<?php echo $diklatpusat_grid->ket->viewAttributes() ?>><?php echo $diklatpusat_grid->ket->ViewValue ?></span>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_ket" name="x<?php echo $diklatpusat_grid->RowIndex ?>_ket" id="x<?php echo $diklatpusat_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($diklatpusat_grid->ket->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatpusat" data-field="x_ket" name="o<?php echo $diklatpusat_grid->RowIndex ?>_ket" id="o<?php echo $diklatpusat_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($diklatpusat_grid->ket->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatpusat_grid->jenisevaluasi->Visible) { // jenisevaluasi ?>
		<td data-name="jenisevaluasi">
<?php if (!$diklatpusat->isConfirm()) { ?>
<span id="el$rowindex$_diklatpusat_jenisevaluasi" class="form-group diklatpusat_jenisevaluasi">
<div id="tp_x<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="diklatpusat" data-field="x_jenisevaluasi" data-value-separator="<?php echo $diklatpusat_grid->jenisevaluasi->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi[]" id="x<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi[]" value="{value}"<?php echo $diklatpusat_grid->jenisevaluasi->editAttributes() ?>></div>
<div id="dsl_x<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi" data-repeatcolumn="1" class="ew-item-list d-none"><div>
<?php echo $diklatpusat_grid->jenisevaluasi->checkBoxListHtml(FALSE, "x{$diklatpusat_grid->RowIndex}_jenisevaluasi[]") ?>
</div></div>
<?php echo $diklatpusat_grid->jenisevaluasi->Lookup->getParamTag($diklatpusat_grid, "p_x" . $diklatpusat_grid->RowIndex . "_jenisevaluasi") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatpusat_jenisevaluasi" class="form-group diklatpusat_jenisevaluasi">
<span<?php echo $diklatpusat_grid->jenisevaluasi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatpusat_grid->jenisevaluasi->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatpusat" data-field="x_jenisevaluasi" name="x<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi" id="x<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi" value="<?php echo HtmlEncode($diklatpusat_grid->jenisevaluasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatpusat" data-field="x_jenisevaluasi" name="o<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi[]" id="o<?php echo $diklatpusat_grid->RowIndex ?>_jenisevaluasi[]" value="<?php echo HtmlEncode($diklatpusat_grid->jenisevaluasi->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$diklatpusat_grid->ListOptions->render("body", "right", $diklatpusat_grid->RowIndex);
?>
<script>
loadjs.ready(["fdiklatpusatgrid", "load"], function() {
	fdiklatpusatgrid.updateLists(<?php echo $diklatpusat_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($diklatpusat->CurrentMode == "add" || $diklatpusat->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $diklatpusat_grid->FormKeyCountName ?>" id="<?php echo $diklatpusat_grid->FormKeyCountName ?>" value="<?php echo $diklatpusat_grid->KeyCount ?>">
<?php echo $diklatpusat_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($diklatpusat->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $diklatpusat_grid->FormKeyCountName ?>" id="<?php echo $diklatpusat_grid->FormKeyCountName ?>" value="<?php echo $diklatpusat_grid->KeyCount ?>">
<?php echo $diklatpusat_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($diklatpusat->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdiklatpusatgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($diklatpusat_grid->Recordset)
	$diklatpusat_grid->Recordset->Close();
?>
<?php if ($diklatpusat_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $diklatpusat_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($diklatpusat_grid->TotalRecords == 0 && !$diklatpusat->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $diklatpusat_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$diklatpusat_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$diklatpusat_grid->terminate();
?>