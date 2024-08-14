<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($diklatkerjasama_grid))
	$diklatkerjasama_grid = new diklatkerjasama_grid();

// Run the page
$diklatkerjasama_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$diklatkerjasama_grid->Page_Render();
?>
<?php if (!$diklatkerjasama_grid->isExport()) { ?>
<script>
var fdiklatkerjasamagrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdiklatkerjasamagrid = new ew.Form("fdiklatkerjasamagrid", "grid");
	fdiklatkerjasamagrid.formKeyCountName = '<?php echo $diklatkerjasama_grid->FormKeyCountName ?>';

	// Validate form
	fdiklatkerjasamagrid.validate = function() {
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
			<?php if ($diklatkerjasama_grid->kdjudul->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjudul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_grid->kdjudul->caption(), $diklatkerjasama_grid->kdjudul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_grid->kdkursil->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkursil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_grid->kdkursil->caption(), $diklatkerjasama_grid->kdkursil->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_grid->tawal->Required) { ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_grid->tawal->caption(), $diklatkerjasama_grid->tawal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatkerjasama_grid->tawal->errorMessage()) ?>");
			<?php if ($diklatkerjasama_grid->takhir->Required) { ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_grid->takhir->caption(), $diklatkerjasama_grid->takhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatkerjasama_grid->takhir->errorMessage()) ?>");
			<?php if ($diklatkerjasama_grid->jml_hari->Required) { ?>
				elm = this.getElements("x" + infix + "_jml_hari");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_grid->jml_hari->caption(), $diklatkerjasama_grid->jml_hari->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jml_hari");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatkerjasama_grid->jml_hari->errorMessage()) ?>");
			<?php if ($diklatkerjasama_grid->targetpes->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_grid->targetpes->caption(), $diklatkerjasama_grid->targetpes->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatkerjasama_grid->targetpes->errorMessage()) ?>");
			<?php if ($diklatkerjasama_grid->ketua->Required) { ?>
				elm = this.getElements("x" + infix + "_ketua");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_grid->ketua->caption(), $diklatkerjasama_grid->ketua->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_grid->sekretaris->Required) { ?>
				elm = this.getElements("x" + infix + "_sekretaris");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_grid->sekretaris->caption(), $diklatkerjasama_grid->sekretaris->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_grid->bendahara->Required) { ?>
				elm = this.getElements("x" + infix + "_bendahara");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_grid->bendahara->caption(), $diklatkerjasama_grid->bendahara->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_grid->anggota2->Required) { ?>
				elm = this.getElements("x" + infix + "_anggota2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_grid->anggota2->caption(), $diklatkerjasama_grid->anggota2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_grid->widyaiswara->Required) { ?>
				elm = this.getElements("x" + infix + "_widyaiswara");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_grid->widyaiswara->caption(), $diklatkerjasama_grid->widyaiswara->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_widyaiswara");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatkerjasama_grid->widyaiswara->errorMessage()) ?>");
			<?php if ($diklatkerjasama_grid->kdprop->Required) { ?>
				elm = this.getElements("x" + infix + "_kdprop");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_grid->kdprop->caption(), $diklatkerjasama_grid->kdprop->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_grid->kdkota->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkota");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_grid->kdkota->caption(), $diklatkerjasama_grid->kdkota->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_grid->tempat->Required) { ?>
				elm = this.getElements("x" + infix + "_tempat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_grid->tempat->caption(), $diklatkerjasama_grid->tempat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_grid->biaya->Required) { ?>
				elm = this.getElements("x" + infix + "_biaya");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_grid->biaya->caption(), $diklatkerjasama_grid->biaya->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_biaya");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatkerjasama_grid->biaya->errorMessage()) ?>");
			<?php if ($diklatkerjasama_grid->statuspel->Required) { ?>
				elm = this.getElements("x" + infix + "_statuspel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_grid->statuspel->caption(), $diklatkerjasama_grid->statuspel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_grid->jenisevaluasi->Required) { ?>
				elm = this.getElements("x" + infix + "_jenisevaluasi[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_grid->jenisevaluasi->caption(), $diklatkerjasama_grid->jenisevaluasi->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdiklatkerjasamagrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "kdjudul", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdkursil", false)) return false;
		if (ew.valueChanged(fobj, infix, "tawal", false)) return false;
		if (ew.valueChanged(fobj, infix, "takhir", false)) return false;
		if (ew.valueChanged(fobj, infix, "jml_hari", false)) return false;
		if (ew.valueChanged(fobj, infix, "targetpes", false)) return false;
		if (ew.valueChanged(fobj, infix, "ketua", false)) return false;
		if (ew.valueChanged(fobj, infix, "sekretaris", false)) return false;
		if (ew.valueChanged(fobj, infix, "bendahara", false)) return false;
		if (ew.valueChanged(fobj, infix, "anggota2", false)) return false;
		if (ew.valueChanged(fobj, infix, "widyaiswara", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdprop", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdkota", false)) return false;
		if (ew.valueChanged(fobj, infix, "tempat", false)) return false;
		if (ew.valueChanged(fobj, infix, "biaya", false)) return false;
		if (ew.valueChanged(fobj, infix, "statuspel", false)) return false;
		if (ew.valueChanged(fobj, infix, "jenisevaluasi[]", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdiklatkerjasamagrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdiklatkerjasamagrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdiklatkerjasamagrid.lists["x_kdjudul"] = <?php echo $diklatkerjasama_grid->kdjudul->Lookup->toClientList($diklatkerjasama_grid) ?>;
	fdiklatkerjasamagrid.lists["x_kdjudul"].options = <?php echo JsonEncode($diklatkerjasama_grid->kdjudul->lookupOptions()) ?>;
	fdiklatkerjasamagrid.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatkerjasamagrid.lists["x_kdkursil"] = <?php echo $diklatkerjasama_grid->kdkursil->Lookup->toClientList($diklatkerjasama_grid) ?>;
	fdiklatkerjasamagrid.lists["x_kdkursil"].options = <?php echo JsonEncode($diklatkerjasama_grid->kdkursil->lookupOptions()) ?>;
	fdiklatkerjasamagrid.lists["x_ketua"] = <?php echo $diklatkerjasama_grid->ketua->Lookup->toClientList($diklatkerjasama_grid) ?>;
	fdiklatkerjasamagrid.lists["x_ketua"].options = <?php echo JsonEncode($diklatkerjasama_grid->ketua->lookupOptions()) ?>;
	fdiklatkerjasamagrid.autoSuggests["x_ketua"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatkerjasamagrid.lists["x_sekretaris"] = <?php echo $diklatkerjasama_grid->sekretaris->Lookup->toClientList($diklatkerjasama_grid) ?>;
	fdiklatkerjasamagrid.lists["x_sekretaris"].options = <?php echo JsonEncode($diklatkerjasama_grid->sekretaris->lookupOptions()) ?>;
	fdiklatkerjasamagrid.autoSuggests["x_sekretaris"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatkerjasamagrid.lists["x_bendahara"] = <?php echo $diklatkerjasama_grid->bendahara->Lookup->toClientList($diklatkerjasama_grid) ?>;
	fdiklatkerjasamagrid.lists["x_bendahara"].options = <?php echo JsonEncode($diklatkerjasama_grid->bendahara->lookupOptions()) ?>;
	fdiklatkerjasamagrid.autoSuggests["x_bendahara"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatkerjasamagrid.lists["x_anggota2"] = <?php echo $diklatkerjasama_grid->anggota2->Lookup->toClientList($diklatkerjasama_grid) ?>;
	fdiklatkerjasamagrid.lists["x_anggota2"].options = <?php echo JsonEncode($diklatkerjasama_grid->anggota2->lookupOptions()) ?>;
	fdiklatkerjasamagrid.autoSuggests["x_anggota2"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatkerjasamagrid.lists["x_widyaiswara"] = <?php echo $diklatkerjasama_grid->widyaiswara->Lookup->toClientList($diklatkerjasama_grid) ?>;
	fdiklatkerjasamagrid.lists["x_widyaiswara"].options = <?php echo JsonEncode($diklatkerjasama_grid->widyaiswara->lookupOptions()) ?>;
	fdiklatkerjasamagrid.autoSuggests["x_widyaiswara"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatkerjasamagrid.lists["x_kdprop"] = <?php echo $diklatkerjasama_grid->kdprop->Lookup->toClientList($diklatkerjasama_grid) ?>;
	fdiklatkerjasamagrid.lists["x_kdprop"].options = <?php echo JsonEncode($diklatkerjasama_grid->kdprop->lookupOptions()) ?>;
	fdiklatkerjasamagrid.lists["x_kdkota"] = <?php echo $diklatkerjasama_grid->kdkota->Lookup->toClientList($diklatkerjasama_grid) ?>;
	fdiklatkerjasamagrid.lists["x_kdkota"].options = <?php echo JsonEncode($diklatkerjasama_grid->kdkota->lookupOptions()) ?>;
	fdiklatkerjasamagrid.lists["x_statuspel"] = <?php echo $diklatkerjasama_grid->statuspel->Lookup->toClientList($diklatkerjasama_grid) ?>;
	fdiklatkerjasamagrid.lists["x_statuspel"].options = <?php echo JsonEncode($diklatkerjasama_grid->statuspel->options(FALSE, TRUE)) ?>;
	fdiklatkerjasamagrid.lists["x_jenisevaluasi[]"] = <?php echo $diklatkerjasama_grid->jenisevaluasi->Lookup->toClientList($diklatkerjasama_grid) ?>;
	fdiklatkerjasamagrid.lists["x_jenisevaluasi[]"].options = <?php echo JsonEncode($diklatkerjasama_grid->jenisevaluasi->lookupOptions()) ?>;
	loadjs.done("fdiklatkerjasamagrid");
});
</script>
<?php } ?>
<?php
$diklatkerjasama_grid->renderOtherOptions();
?>
<?php if ($diklatkerjasama_grid->TotalRecords > 0 || $diklatkerjasama->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($diklatkerjasama_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> diklatkerjasama">
<?php if ($diklatkerjasama_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $diklatkerjasama_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdiklatkerjasamagrid" class="ew-form ew-list-form form-inline">
<div id="gmp_diklatkerjasama" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_diklatkerjasamagrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$diklatkerjasama->RowType = ROWTYPE_HEADER;

// Render list options
$diklatkerjasama_grid->renderListOptions();

// Render list options (header, left)
$diklatkerjasama_grid->ListOptions->render("header", "left");
?>
<?php if ($diklatkerjasama_grid->kdjudul->Visible) { // kdjudul ?>
	<?php if ($diklatkerjasama_grid->SortUrl($diklatkerjasama_grid->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $diklatkerjasama_grid->kdjudul->headerCellClass() ?>"><div id="elh_diklatkerjasama_kdjudul" class="diklatkerjasama_kdjudul"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $diklatkerjasama_grid->kdjudul->headerCellClass() ?>"><div><div id="elh_diklatkerjasama_kdjudul" class="diklatkerjasama_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->kdjudul->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_grid->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_grid->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_grid->kdkursil->Visible) { // kdkursil ?>
	<?php if ($diklatkerjasama_grid->SortUrl($diklatkerjasama_grid->kdkursil) == "") { ?>
		<th data-name="kdkursil" class="<?php echo $diklatkerjasama_grid->kdkursil->headerCellClass() ?>"><div id="elh_diklatkerjasama_kdkursil" class="diklatkerjasama_kdkursil"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->kdkursil->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkursil" class="<?php echo $diklatkerjasama_grid->kdkursil->headerCellClass() ?>"><div><div id="elh_diklatkerjasama_kdkursil" class="diklatkerjasama_kdkursil">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->kdkursil->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_grid->kdkursil->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_grid->kdkursil->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_grid->tawal->Visible) { // tawal ?>
	<?php if ($diklatkerjasama_grid->SortUrl($diklatkerjasama_grid->tawal) == "") { ?>
		<th data-name="tawal" class="<?php echo $diklatkerjasama_grid->tawal->headerCellClass() ?>"><div id="elh_diklatkerjasama_tawal" class="diklatkerjasama_tawal"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->tawal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tawal" class="<?php echo $diklatkerjasama_grid->tawal->headerCellClass() ?>"><div><div id="elh_diklatkerjasama_tawal" class="diklatkerjasama_tawal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->tawal->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_grid->tawal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_grid->tawal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_grid->takhir->Visible) { // takhir ?>
	<?php if ($diklatkerjasama_grid->SortUrl($diklatkerjasama_grid->takhir) == "") { ?>
		<th data-name="takhir" class="<?php echo $diklatkerjasama_grid->takhir->headerCellClass() ?>"><div id="elh_diklatkerjasama_takhir" class="diklatkerjasama_takhir"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->takhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="takhir" class="<?php echo $diklatkerjasama_grid->takhir->headerCellClass() ?>"><div><div id="elh_diklatkerjasama_takhir" class="diklatkerjasama_takhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->takhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_grid->takhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_grid->takhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_grid->jml_hari->Visible) { // jml_hari ?>
	<?php if ($diklatkerjasama_grid->SortUrl($diklatkerjasama_grid->jml_hari) == "") { ?>
		<th data-name="jml_hari" class="<?php echo $diklatkerjasama_grid->jml_hari->headerCellClass() ?>"><div id="elh_diklatkerjasama_jml_hari" class="diklatkerjasama_jml_hari"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->jml_hari->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jml_hari" class="<?php echo $diklatkerjasama_grid->jml_hari->headerCellClass() ?>"><div><div id="elh_diklatkerjasama_jml_hari" class="diklatkerjasama_jml_hari">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->jml_hari->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_grid->jml_hari->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_grid->jml_hari->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_grid->targetpes->Visible) { // targetpes ?>
	<?php if ($diklatkerjasama_grid->SortUrl($diklatkerjasama_grid->targetpes) == "") { ?>
		<th data-name="targetpes" class="<?php echo $diklatkerjasama_grid->targetpes->headerCellClass() ?>"><div id="elh_diklatkerjasama_targetpes" class="diklatkerjasama_targetpes"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->targetpes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes" class="<?php echo $diklatkerjasama_grid->targetpes->headerCellClass() ?>"><div><div id="elh_diklatkerjasama_targetpes" class="diklatkerjasama_targetpes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->targetpes->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_grid->targetpes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_grid->targetpes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_grid->ketua->Visible) { // ketua ?>
	<?php if ($diklatkerjasama_grid->SortUrl($diklatkerjasama_grid->ketua) == "") { ?>
		<th data-name="ketua" class="<?php echo $diklatkerjasama_grid->ketua->headerCellClass() ?>"><div id="elh_diklatkerjasama_ketua" class="diklatkerjasama_ketua"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->ketua->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ketua" class="<?php echo $diklatkerjasama_grid->ketua->headerCellClass() ?>"><div><div id="elh_diklatkerjasama_ketua" class="diklatkerjasama_ketua">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->ketua->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_grid->ketua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_grid->ketua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_grid->sekretaris->Visible) { // sekretaris ?>
	<?php if ($diklatkerjasama_grid->SortUrl($diklatkerjasama_grid->sekretaris) == "") { ?>
		<th data-name="sekretaris" class="<?php echo $diklatkerjasama_grid->sekretaris->headerCellClass() ?>"><div id="elh_diklatkerjasama_sekretaris" class="diklatkerjasama_sekretaris"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->sekretaris->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sekretaris" class="<?php echo $diklatkerjasama_grid->sekretaris->headerCellClass() ?>"><div><div id="elh_diklatkerjasama_sekretaris" class="diklatkerjasama_sekretaris">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->sekretaris->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_grid->sekretaris->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_grid->sekretaris->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_grid->bendahara->Visible) { // bendahara ?>
	<?php if ($diklatkerjasama_grid->SortUrl($diklatkerjasama_grid->bendahara) == "") { ?>
		<th data-name="bendahara" class="<?php echo $diklatkerjasama_grid->bendahara->headerCellClass() ?>"><div id="elh_diklatkerjasama_bendahara" class="diklatkerjasama_bendahara"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->bendahara->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bendahara" class="<?php echo $diklatkerjasama_grid->bendahara->headerCellClass() ?>"><div><div id="elh_diklatkerjasama_bendahara" class="diklatkerjasama_bendahara">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->bendahara->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_grid->bendahara->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_grid->bendahara->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_grid->anggota2->Visible) { // anggota2 ?>
	<?php if ($diklatkerjasama_grid->SortUrl($diklatkerjasama_grid->anggota2) == "") { ?>
		<th data-name="anggota2" class="<?php echo $diklatkerjasama_grid->anggota2->headerCellClass() ?>"><div id="elh_diklatkerjasama_anggota2" class="diklatkerjasama_anggota2"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->anggota2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="anggota2" class="<?php echo $diklatkerjasama_grid->anggota2->headerCellClass() ?>"><div><div id="elh_diklatkerjasama_anggota2" class="diklatkerjasama_anggota2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->anggota2->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_grid->anggota2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_grid->anggota2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_grid->widyaiswara->Visible) { // widyaiswara ?>
	<?php if ($diklatkerjasama_grid->SortUrl($diklatkerjasama_grid->widyaiswara) == "") { ?>
		<th data-name="widyaiswara" class="<?php echo $diklatkerjasama_grid->widyaiswara->headerCellClass() ?>"><div id="elh_diklatkerjasama_widyaiswara" class="diklatkerjasama_widyaiswara"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->widyaiswara->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="widyaiswara" class="<?php echo $diklatkerjasama_grid->widyaiswara->headerCellClass() ?>"><div><div id="elh_diklatkerjasama_widyaiswara" class="diklatkerjasama_widyaiswara">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->widyaiswara->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_grid->widyaiswara->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_grid->widyaiswara->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_grid->kdprop->Visible) { // kdprop ?>
	<?php if ($diklatkerjasama_grid->SortUrl($diklatkerjasama_grid->kdprop) == "") { ?>
		<th data-name="kdprop" class="<?php echo $diklatkerjasama_grid->kdprop->headerCellClass() ?>"><div id="elh_diklatkerjasama_kdprop" class="diklatkerjasama_kdprop"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->kdprop->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdprop" class="<?php echo $diklatkerjasama_grid->kdprop->headerCellClass() ?>"><div><div id="elh_diklatkerjasama_kdprop" class="diklatkerjasama_kdprop">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->kdprop->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_grid->kdprop->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_grid->kdprop->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_grid->kdkota->Visible) { // kdkota ?>
	<?php if ($diklatkerjasama_grid->SortUrl($diklatkerjasama_grid->kdkota) == "") { ?>
		<th data-name="kdkota" class="<?php echo $diklatkerjasama_grid->kdkota->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_diklatkerjasama_kdkota" class="diklatkerjasama_kdkota"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->kdkota->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkota" class="<?php echo $diklatkerjasama_grid->kdkota->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_diklatkerjasama_kdkota" class="diklatkerjasama_kdkota">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->kdkota->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_grid->kdkota->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_grid->kdkota->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_grid->tempat->Visible) { // tempat ?>
	<?php if ($diklatkerjasama_grid->SortUrl($diklatkerjasama_grid->tempat) == "") { ?>
		<th data-name="tempat" class="<?php echo $diklatkerjasama_grid->tempat->headerCellClass() ?>"><div id="elh_diklatkerjasama_tempat" class="diklatkerjasama_tempat"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->tempat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tempat" class="<?php echo $diklatkerjasama_grid->tempat->headerCellClass() ?>"><div><div id="elh_diklatkerjasama_tempat" class="diklatkerjasama_tempat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->tempat->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_grid->tempat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_grid->tempat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_grid->biaya->Visible) { // biaya ?>
	<?php if ($diklatkerjasama_grid->SortUrl($diklatkerjasama_grid->biaya) == "") { ?>
		<th data-name="biaya" class="<?php echo $diklatkerjasama_grid->biaya->headerCellClass() ?>"><div id="elh_diklatkerjasama_biaya" class="diklatkerjasama_biaya"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->biaya->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="biaya" class="<?php echo $diklatkerjasama_grid->biaya->headerCellClass() ?>"><div><div id="elh_diklatkerjasama_biaya" class="diklatkerjasama_biaya">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->biaya->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_grid->biaya->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_grid->biaya->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_grid->statuspel->Visible) { // statuspel ?>
	<?php if ($diklatkerjasama_grid->SortUrl($diklatkerjasama_grid->statuspel) == "") { ?>
		<th data-name="statuspel" class="<?php echo $diklatkerjasama_grid->statuspel->headerCellClass() ?>"><div id="elh_diklatkerjasama_statuspel" class="diklatkerjasama_statuspel"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->statuspel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="statuspel" class="<?php echo $diklatkerjasama_grid->statuspel->headerCellClass() ?>"><div><div id="elh_diklatkerjasama_statuspel" class="diklatkerjasama_statuspel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->statuspel->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_grid->statuspel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_grid->statuspel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_grid->jenisevaluasi->Visible) { // jenisevaluasi ?>
	<?php if ($diklatkerjasama_grid->SortUrl($diklatkerjasama_grid->jenisevaluasi) == "") { ?>
		<th data-name="jenisevaluasi" class="<?php echo $diklatkerjasama_grid->jenisevaluasi->headerCellClass() ?>"><div id="elh_diklatkerjasama_jenisevaluasi" class="diklatkerjasama_jenisevaluasi"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->jenisevaluasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenisevaluasi" class="<?php echo $diklatkerjasama_grid->jenisevaluasi->headerCellClass() ?>"><div><div id="elh_diklatkerjasama_jenisevaluasi" class="diklatkerjasama_jenisevaluasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_grid->jenisevaluasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_grid->jenisevaluasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_grid->jenisevaluasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$diklatkerjasama_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$diklatkerjasama_grid->StartRecord = 1;
$diklatkerjasama_grid->StopRecord = $diklatkerjasama_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($diklatkerjasama->isConfirm() || $diklatkerjasama_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($diklatkerjasama_grid->FormKeyCountName) && ($diklatkerjasama_grid->isGridAdd() || $diklatkerjasama_grid->isGridEdit() || $diklatkerjasama->isConfirm())) {
		$diklatkerjasama_grid->KeyCount = $CurrentForm->getValue($diklatkerjasama_grid->FormKeyCountName);
		$diklatkerjasama_grid->StopRecord = $diklatkerjasama_grid->StartRecord + $diklatkerjasama_grid->KeyCount - 1;
	}
}
$diklatkerjasama_grid->RecordCount = $diklatkerjasama_grid->StartRecord - 1;
if ($diklatkerjasama_grid->Recordset && !$diklatkerjasama_grid->Recordset->EOF) {
	$diklatkerjasama_grid->Recordset->moveFirst();
	$selectLimit = $diklatkerjasama_grid->UseSelectLimit;
	if (!$selectLimit && $diklatkerjasama_grid->StartRecord > 1)
		$diklatkerjasama_grid->Recordset->move($diklatkerjasama_grid->StartRecord - 1);
} elseif (!$diklatkerjasama->AllowAddDeleteRow && $diklatkerjasama_grid->StopRecord == 0) {
	$diklatkerjasama_grid->StopRecord = $diklatkerjasama->GridAddRowCount;
}

// Initialize aggregate
$diklatkerjasama->RowType = ROWTYPE_AGGREGATEINIT;
$diklatkerjasama->resetAttributes();
$diklatkerjasama_grid->renderRow();
if ($diklatkerjasama_grid->isGridAdd())
	$diklatkerjasama_grid->RowIndex = 0;
if ($diklatkerjasama_grid->isGridEdit())
	$diklatkerjasama_grid->RowIndex = 0;
while ($diklatkerjasama_grid->RecordCount < $diklatkerjasama_grid->StopRecord) {
	$diklatkerjasama_grid->RecordCount++;
	if ($diklatkerjasama_grid->RecordCount >= $diklatkerjasama_grid->StartRecord) {
		$diklatkerjasama_grid->RowCount++;
		if ($diklatkerjasama_grid->isGridAdd() || $diklatkerjasama_grid->isGridEdit() || $diklatkerjasama->isConfirm()) {
			$diklatkerjasama_grid->RowIndex++;
			$CurrentForm->Index = $diklatkerjasama_grid->RowIndex;
			if ($CurrentForm->hasValue($diklatkerjasama_grid->FormActionName) && ($diklatkerjasama->isConfirm() || $diklatkerjasama_grid->EventCancelled))
				$diklatkerjasama_grid->RowAction = strval($CurrentForm->getValue($diklatkerjasama_grid->FormActionName));
			elseif ($diklatkerjasama_grid->isGridAdd())
				$diklatkerjasama_grid->RowAction = "insert";
			else
				$diklatkerjasama_grid->RowAction = "";
		}

		// Set up key count
		$diklatkerjasama_grid->KeyCount = $diklatkerjasama_grid->RowIndex;

		// Init row class and style
		$diklatkerjasama->resetAttributes();
		$diklatkerjasama->CssClass = "";
		if ($diklatkerjasama_grid->isGridAdd()) {
			if ($diklatkerjasama->CurrentMode == "copy") {
				$diklatkerjasama_grid->loadRowValues($diklatkerjasama_grid->Recordset); // Load row values
				$diklatkerjasama_grid->setRecordKey($diklatkerjasama_grid->RowOldKey, $diklatkerjasama_grid->Recordset); // Set old record key
			} else {
				$diklatkerjasama_grid->loadRowValues(); // Load default values
				$diklatkerjasama_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$diklatkerjasama_grid->loadRowValues($diklatkerjasama_grid->Recordset); // Load row values
		}
		$diklatkerjasama->RowType = ROWTYPE_VIEW; // Render view
		if ($diklatkerjasama_grid->isGridAdd()) // Grid add
			$diklatkerjasama->RowType = ROWTYPE_ADD; // Render add
		if ($diklatkerjasama_grid->isGridAdd() && $diklatkerjasama->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$diklatkerjasama_grid->restoreCurrentRowFormValues($diklatkerjasama_grid->RowIndex); // Restore form values
		if ($diklatkerjasama_grid->isGridEdit()) { // Grid edit
			if ($diklatkerjasama->EventCancelled)
				$diklatkerjasama_grid->restoreCurrentRowFormValues($diklatkerjasama_grid->RowIndex); // Restore form values
			if ($diklatkerjasama_grid->RowAction == "insert")
				$diklatkerjasama->RowType = ROWTYPE_ADD; // Render add
			else
				$diklatkerjasama->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($diklatkerjasama_grid->isGridEdit() && ($diklatkerjasama->RowType == ROWTYPE_EDIT || $diklatkerjasama->RowType == ROWTYPE_ADD) && $diklatkerjasama->EventCancelled) // Update failed
			$diklatkerjasama_grid->restoreCurrentRowFormValues($diklatkerjasama_grid->RowIndex); // Restore form values
		if ($diklatkerjasama->RowType == ROWTYPE_EDIT) // Edit row
			$diklatkerjasama_grid->EditRowCount++;
		if ($diklatkerjasama->isConfirm()) // Confirm row
			$diklatkerjasama_grid->restoreCurrentRowFormValues($diklatkerjasama_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$diklatkerjasama->RowAttrs->merge(["data-rowindex" => $diklatkerjasama_grid->RowCount, "id" => "r" . $diklatkerjasama_grid->RowCount . "_diklatkerjasama", "data-rowtype" => $diklatkerjasama->RowType]);

		// Render row
		$diklatkerjasama_grid->renderRow();

		// Render list options
		$diklatkerjasama_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($diklatkerjasama_grid->RowAction != "delete" && $diklatkerjasama_grid->RowAction != "insertdelete" && !($diklatkerjasama_grid->RowAction == "insert" && $diklatkerjasama->isConfirm() && $diklatkerjasama_grid->emptyRow())) {
?>
	<tr <?php echo $diklatkerjasama->rowAttributes() ?>>
<?php

// Render list options (body, left)
$diklatkerjasama_grid->ListOptions->render("body", "left", $diklatkerjasama_grid->RowCount);
?>
	<?php if ($diklatkerjasama_grid->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $diklatkerjasama_grid->kdjudul->cellAttributes() ?>>
<?php if ($diklatkerjasama->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_kdjudul" class="form-group">
<?php
$onchange = $diklatkerjasama_grid->kdjudul->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_grid->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" id="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" value="<?php echo RemoveHtml($diklatkerjasama_grid->kdjudul->EditValue) ?>" size="25" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->kdjudul->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_grid->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdjudul" data-value-separator="<?php echo $diklatkerjasama_grid->kdjudul->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdjudul->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamagrid"], function() {
	fdiklatkerjasamagrid.createAutoSuggest({"id":"x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul","forceSelect":true,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_grid->kdjudul->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_kdjudul") ?>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdjudul" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdjudul->OldValue) ?>">
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_kdjudul" class="form-group">
<?php
$onchange = $diklatkerjasama_grid->kdjudul->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_grid->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" id="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" value="<?php echo RemoveHtml($diklatkerjasama_grid->kdjudul->EditValue) ?>" size="25" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->kdjudul->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_grid->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdjudul" data-value-separator="<?php echo $diklatkerjasama_grid->kdjudul->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdjudul->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamagrid"], function() {
	fdiklatkerjasamagrid.createAutoSuggest({"id":"x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul","forceSelect":true,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_grid->kdjudul->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_kdjudul") ?>
</span>
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_kdjudul">
<span<?php echo $diklatkerjasama_grid->kdjudul->viewAttributes() ?>><?php echo $diklatkerjasama_grid->kdjudul->getViewValue() ?></span>
</span>
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdjudul" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdjudul->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdjudul" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdjudul->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdjudul" name="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" id="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdjudul->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdjudul" name="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" id="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdjudul->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_idpelat" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_idpelat" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_idpelat" value="<?php echo HtmlEncode($diklatkerjasama_grid->idpelat->CurrentValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_idpelat" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_idpelat" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_idpelat" value="<?php echo HtmlEncode($diklatkerjasama_grid->idpelat->OldValue) ?>">
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_EDIT || $diklatkerjasama->CurrentMode == "edit") { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_idpelat" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_idpelat" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_idpelat" value="<?php echo HtmlEncode($diklatkerjasama_grid->idpelat->CurrentValue) ?>">
<?php } ?>
	<?php if ($diklatkerjasama_grid->kdkursil->Visible) { // kdkursil ?>
		<td data-name="kdkursil" <?php echo $diklatkerjasama_grid->kdkursil->cellAttributes() ?>>
<?php if ($diklatkerjasama->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_kdkursil" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatkerjasama" data-field="x_kdkursil" data-value-separator="<?php echo $diklatkerjasama_grid->kdkursil->displayValueSeparatorAttribute() ?>" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkursil" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkursil"<?php echo $diklatkerjasama_grid->kdkursil->editAttributes() ?>>
			<?php echo $diklatkerjasama_grid->kdkursil->selectOptionListHtml("x{$diklatkerjasama_grid->RowIndex}_kdkursil") ?>
		</select>
</div>
<?php echo $diklatkerjasama_grid->kdkursil->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_kdkursil") ?>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdkursil" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkursil" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdkursil->OldValue) ?>">
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_kdkursil" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatkerjasama" data-field="x_kdkursil" data-value-separator="<?php echo $diklatkerjasama_grid->kdkursil->displayValueSeparatorAttribute() ?>" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkursil" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkursil"<?php echo $diklatkerjasama_grid->kdkursil->editAttributes() ?>>
			<?php echo $diklatkerjasama_grid->kdkursil->selectOptionListHtml("x{$diklatkerjasama_grid->RowIndex}_kdkursil") ?>
		</select>
</div>
<?php echo $diklatkerjasama_grid->kdkursil->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_kdkursil") ?>
</span>
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_kdkursil">
<span<?php echo $diklatkerjasama_grid->kdkursil->viewAttributes() ?>><?php echo $diklatkerjasama_grid->kdkursil->getViewValue() ?></span>
</span>
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdkursil" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkursil" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdkursil->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdkursil" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkursil" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdkursil->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdkursil" name="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkursil" id="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdkursil->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdkursil" name="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkursil" id="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdkursil->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->tawal->Visible) { // tawal ?>
		<td data-name="tawal" <?php echo $diklatkerjasama_grid->tawal->cellAttributes() ?>>
<?php if ($diklatkerjasama->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_tawal" class="form-group">
<input type="text" data-table="diklatkerjasama" data-field="x_tawal" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal" size="10" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->tawal->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_grid->tawal->EditValue ?>"<?php echo $diklatkerjasama_grid->tawal->editAttributes() ?>>
<?php if (!$diklatkerjasama_grid->tawal->ReadOnly && !$diklatkerjasama_grid->tawal->Disabled && !isset($diklatkerjasama_grid->tawal->EditAttrs["readonly"]) && !isset($diklatkerjasama_grid->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiklatkerjasamagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdiklatkerjasamagrid", "x<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_tawal" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($diklatkerjasama_grid->tawal->OldValue) ?>">
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_tawal" class="form-group">
<input type="text" data-table="diklatkerjasama" data-field="x_tawal" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal" size="10" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->tawal->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_grid->tawal->EditValue ?>"<?php echo $diklatkerjasama_grid->tawal->editAttributes() ?>>
<?php if (!$diklatkerjasama_grid->tawal->ReadOnly && !$diklatkerjasama_grid->tawal->Disabled && !isset($diklatkerjasama_grid->tawal->EditAttrs["readonly"]) && !isset($diklatkerjasama_grid->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiklatkerjasamagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdiklatkerjasamagrid", "x<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_tawal">
<span<?php echo $diklatkerjasama_grid->tawal->viewAttributes() ?>><?php echo $diklatkerjasama_grid->tawal->getViewValue() ?></span>
</span>
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_tawal" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($diklatkerjasama_grid->tawal->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_tawal" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($diklatkerjasama_grid->tawal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_tawal" name="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal" id="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($diklatkerjasama_grid->tawal->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_tawal" name="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal" id="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($diklatkerjasama_grid->tawal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->takhir->Visible) { // takhir ?>
		<td data-name="takhir" <?php echo $diklatkerjasama_grid->takhir->cellAttributes() ?>>
<?php if ($diklatkerjasama->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_takhir" class="form-group">
<input type="text" data-table="diklatkerjasama" data-field="x_takhir" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir" size="10" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->takhir->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_grid->takhir->EditValue ?>"<?php echo $diklatkerjasama_grid->takhir->editAttributes() ?>>
<?php if (!$diklatkerjasama_grid->takhir->ReadOnly && !$diklatkerjasama_grid->takhir->Disabled && !isset($diklatkerjasama_grid->takhir->EditAttrs["readonly"]) && !isset($diklatkerjasama_grid->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiklatkerjasamagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdiklatkerjasamagrid", "x<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_takhir" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($diklatkerjasama_grid->takhir->OldValue) ?>">
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_takhir" class="form-group">
<input type="text" data-table="diklatkerjasama" data-field="x_takhir" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir" size="10" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->takhir->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_grid->takhir->EditValue ?>"<?php echo $diklatkerjasama_grid->takhir->editAttributes() ?>>
<?php if (!$diklatkerjasama_grid->takhir->ReadOnly && !$diklatkerjasama_grid->takhir->Disabled && !isset($diklatkerjasama_grid->takhir->EditAttrs["readonly"]) && !isset($diklatkerjasama_grid->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiklatkerjasamagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdiklatkerjasamagrid", "x<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_takhir">
<span<?php echo $diklatkerjasama_grid->takhir->viewAttributes() ?>><?php echo $diklatkerjasama_grid->takhir->getViewValue() ?></span>
</span>
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_takhir" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($diklatkerjasama_grid->takhir->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_takhir" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($diklatkerjasama_grid->takhir->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_takhir" name="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir" id="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($diklatkerjasama_grid->takhir->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_takhir" name="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir" id="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($diklatkerjasama_grid->takhir->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->jml_hari->Visible) { // jml_hari ?>
		<td data-name="jml_hari" <?php echo $diklatkerjasama_grid->jml_hari->cellAttributes() ?>>
<?php if ($diklatkerjasama->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_jml_hari" class="form-group">
<input type="text" data-table="diklatkerjasama" data-field="x_jml_hari" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_jml_hari" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_jml_hari" size="5" maxlength="3" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->jml_hari->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_grid->jml_hari->EditValue ?>"<?php echo $diklatkerjasama_grid->jml_hari->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_jml_hari" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_jml_hari" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_jml_hari" value="<?php echo HtmlEncode($diklatkerjasama_grid->jml_hari->OldValue) ?>">
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_jml_hari" class="form-group">
<input type="text" data-table="diklatkerjasama" data-field="x_jml_hari" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_jml_hari" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_jml_hari" size="5" maxlength="3" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->jml_hari->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_grid->jml_hari->EditValue ?>"<?php echo $diklatkerjasama_grid->jml_hari->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_jml_hari">
<span<?php echo $diklatkerjasama_grid->jml_hari->viewAttributes() ?>><?php echo $diklatkerjasama_grid->jml_hari->getViewValue() ?></span>
</span>
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_jml_hari" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_jml_hari" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_jml_hari" value="<?php echo HtmlEncode($diklatkerjasama_grid->jml_hari->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_jml_hari" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_jml_hari" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_jml_hari" value="<?php echo HtmlEncode($diklatkerjasama_grid->jml_hari->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_jml_hari" name="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_jml_hari" id="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_jml_hari" value="<?php echo HtmlEncode($diklatkerjasama_grid->jml_hari->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_jml_hari" name="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_jml_hari" id="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_jml_hari" value="<?php echo HtmlEncode($diklatkerjasama_grid->jml_hari->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->targetpes->Visible) { // targetpes ?>
		<td data-name="targetpes" <?php echo $diklatkerjasama_grid->targetpes->cellAttributes() ?>>
<?php if ($diklatkerjasama->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_targetpes" class="form-group">
<input type="text" data-table="diklatkerjasama" data-field="x_targetpes" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_targetpes" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_targetpes" size="5" maxlength="3" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->targetpes->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_grid->targetpes->EditValue ?>"<?php echo $diklatkerjasama_grid->targetpes->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_targetpes" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_targetpes" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_targetpes" value="<?php echo HtmlEncode($diklatkerjasama_grid->targetpes->OldValue) ?>">
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_targetpes" class="form-group">
<input type="text" data-table="diklatkerjasama" data-field="x_targetpes" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_targetpes" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_targetpes" size="5" maxlength="3" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->targetpes->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_grid->targetpes->EditValue ?>"<?php echo $diklatkerjasama_grid->targetpes->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_targetpes">
<span<?php echo $diklatkerjasama_grid->targetpes->viewAttributes() ?>><?php echo $diklatkerjasama_grid->targetpes->getViewValue() ?></span>
</span>
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_targetpes" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_targetpes" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_targetpes" value="<?php echo HtmlEncode($diklatkerjasama_grid->targetpes->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_targetpes" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_targetpes" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_targetpes" value="<?php echo HtmlEncode($diklatkerjasama_grid->targetpes->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_targetpes" name="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_targetpes" id="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_targetpes" value="<?php echo HtmlEncode($diklatkerjasama_grid->targetpes->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_targetpes" name="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_targetpes" id="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_targetpes" value="<?php echo HtmlEncode($diklatkerjasama_grid->targetpes->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->ketua->Visible) { // ketua ?>
		<td data-name="ketua" <?php echo $diklatkerjasama_grid->ketua->cellAttributes() ?>>
<?php if ($diklatkerjasama->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_ketua" class="form-group">
<?php
$onchange = $diklatkerjasama_grid->ketua->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_grid->ketua->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" id="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" value="<?php echo RemoveHtml($diklatkerjasama_grid->ketua->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->ketua->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->ketua->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_grid->ketua->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($diklatkerjasama_grid->ketua->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($diklatkerjasama_grid->ketua->ReadOnly || $diklatkerjasama_grid->ketua->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_ketua" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $diklatkerjasama_grid->ketua->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($diklatkerjasama_grid->ketua->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamagrid"], function() {
	fdiklatkerjasamagrid.createAutoSuggest({"id":"x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_grid->ketua->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_ketua") ?>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_ketua" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($diklatkerjasama_grid->ketua->OldValue) ?>">
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_ketua" class="form-group">
<?php
$onchange = $diklatkerjasama_grid->ketua->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_grid->ketua->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" id="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" value="<?php echo RemoveHtml($diklatkerjasama_grid->ketua->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->ketua->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->ketua->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_grid->ketua->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($diklatkerjasama_grid->ketua->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($diklatkerjasama_grid->ketua->ReadOnly || $diklatkerjasama_grid->ketua->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_ketua" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $diklatkerjasama_grid->ketua->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($diklatkerjasama_grid->ketua->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamagrid"], function() {
	fdiklatkerjasamagrid.createAutoSuggest({"id":"x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_grid->ketua->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_ketua") ?>
</span>
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_ketua">
<span<?php echo $diklatkerjasama_grid->ketua->viewAttributes() ?>><?php echo $diklatkerjasama_grid->ketua->getViewValue() ?></span>
</span>
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_ketua" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($diklatkerjasama_grid->ketua->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_ketua" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($diklatkerjasama_grid->ketua->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_ketua" name="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" id="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($diklatkerjasama_grid->ketua->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_ketua" name="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" id="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($diklatkerjasama_grid->ketua->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->sekretaris->Visible) { // sekretaris ?>
		<td data-name="sekretaris" <?php echo $diklatkerjasama_grid->sekretaris->cellAttributes() ?>>
<?php if ($diklatkerjasama->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_sekretaris" class="form-group">
<?php
$onchange = $diklatkerjasama_grid->sekretaris->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_grid->sekretaris->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" id="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" value="<?php echo RemoveHtml($diklatkerjasama_grid->sekretaris->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->sekretaris->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->sekretaris->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_grid->sekretaris->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($diklatkerjasama_grid->sekretaris->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($diklatkerjasama_grid->sekretaris->ReadOnly || $diklatkerjasama_grid->sekretaris->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_sekretaris" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $diklatkerjasama_grid->sekretaris->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($diklatkerjasama_grid->sekretaris->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamagrid"], function() {
	fdiklatkerjasamagrid.createAutoSuggest({"id":"x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_grid->sekretaris->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_sekretaris") ?>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_sekretaris" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($diklatkerjasama_grid->sekretaris->OldValue) ?>">
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_sekretaris" class="form-group">
<?php
$onchange = $diklatkerjasama_grid->sekretaris->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_grid->sekretaris->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" id="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" value="<?php echo RemoveHtml($diklatkerjasama_grid->sekretaris->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->sekretaris->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->sekretaris->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_grid->sekretaris->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($diklatkerjasama_grid->sekretaris->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($diklatkerjasama_grid->sekretaris->ReadOnly || $diklatkerjasama_grid->sekretaris->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_sekretaris" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $diklatkerjasama_grid->sekretaris->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($diklatkerjasama_grid->sekretaris->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamagrid"], function() {
	fdiklatkerjasamagrid.createAutoSuggest({"id":"x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_grid->sekretaris->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_sekretaris") ?>
</span>
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_sekretaris">
<span<?php echo $diklatkerjasama_grid->sekretaris->viewAttributes() ?>><?php echo $diklatkerjasama_grid->sekretaris->getViewValue() ?></span>
</span>
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_sekretaris" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($diklatkerjasama_grid->sekretaris->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_sekretaris" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($diklatkerjasama_grid->sekretaris->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_sekretaris" name="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" id="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($diklatkerjasama_grid->sekretaris->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_sekretaris" name="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" id="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($diklatkerjasama_grid->sekretaris->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->bendahara->Visible) { // bendahara ?>
		<td data-name="bendahara" <?php echo $diklatkerjasama_grid->bendahara->cellAttributes() ?>>
<?php if ($diklatkerjasama->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_bendahara" class="form-group">
<?php
$onchange = $diklatkerjasama_grid->bendahara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_grid->bendahara->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" id="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" value="<?php echo RemoveHtml($diklatkerjasama_grid->bendahara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->bendahara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->bendahara->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_grid->bendahara->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($diklatkerjasama_grid->bendahara->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($diklatkerjasama_grid->bendahara->ReadOnly || $diklatkerjasama_grid->bendahara->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_bendahara" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $diklatkerjasama_grid->bendahara->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($diklatkerjasama_grid->bendahara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamagrid"], function() {
	fdiklatkerjasamagrid.createAutoSuggest({"id":"x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_grid->bendahara->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_bendahara") ?>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_bendahara" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($diklatkerjasama_grid->bendahara->OldValue) ?>">
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_bendahara" class="form-group">
<?php
$onchange = $diklatkerjasama_grid->bendahara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_grid->bendahara->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" id="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" value="<?php echo RemoveHtml($diklatkerjasama_grid->bendahara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->bendahara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->bendahara->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_grid->bendahara->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($diklatkerjasama_grid->bendahara->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($diklatkerjasama_grid->bendahara->ReadOnly || $diklatkerjasama_grid->bendahara->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_bendahara" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $diklatkerjasama_grid->bendahara->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($diklatkerjasama_grid->bendahara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamagrid"], function() {
	fdiklatkerjasamagrid.createAutoSuggest({"id":"x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_grid->bendahara->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_bendahara") ?>
</span>
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_bendahara">
<span<?php echo $diklatkerjasama_grid->bendahara->viewAttributes() ?>><?php echo $diklatkerjasama_grid->bendahara->getViewValue() ?></span>
</span>
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_bendahara" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($diklatkerjasama_grid->bendahara->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_bendahara" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($diklatkerjasama_grid->bendahara->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_bendahara" name="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" id="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($diklatkerjasama_grid->bendahara->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_bendahara" name="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" id="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($diklatkerjasama_grid->bendahara->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->anggota2->Visible) { // anggota2 ?>
		<td data-name="anggota2" <?php echo $diklatkerjasama_grid->anggota2->cellAttributes() ?>>
<?php if ($diklatkerjasama->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_anggota2" class="form-group">
<?php
$onchange = $diklatkerjasama_grid->anggota2->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_grid->anggota2->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" id="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" value="<?php echo RemoveHtml($diklatkerjasama_grid->anggota2->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->anggota2->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->anggota2->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_grid->anggota2->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($diklatkerjasama_grid->anggota2->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($diklatkerjasama_grid->anggota2->ReadOnly || $diklatkerjasama_grid->anggota2->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_anggota2" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $diklatkerjasama_grid->anggota2->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" value="<?php echo HtmlEncode($diklatkerjasama_grid->anggota2->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamagrid"], function() {
	fdiklatkerjasamagrid.createAutoSuggest({"id":"x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_grid->anggota2->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_anggota2") ?>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_anggota2" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" value="<?php echo HtmlEncode($diklatkerjasama_grid->anggota2->OldValue) ?>">
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_anggota2" class="form-group">
<?php
$onchange = $diklatkerjasama_grid->anggota2->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_grid->anggota2->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" id="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" value="<?php echo RemoveHtml($diklatkerjasama_grid->anggota2->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->anggota2->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->anggota2->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_grid->anggota2->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($diklatkerjasama_grid->anggota2->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($diklatkerjasama_grid->anggota2->ReadOnly || $diklatkerjasama_grid->anggota2->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_anggota2" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $diklatkerjasama_grid->anggota2->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" value="<?php echo HtmlEncode($diklatkerjasama_grid->anggota2->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamagrid"], function() {
	fdiklatkerjasamagrid.createAutoSuggest({"id":"x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_grid->anggota2->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_anggota2") ?>
</span>
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_anggota2">
<span<?php echo $diklatkerjasama_grid->anggota2->viewAttributes() ?>><?php echo $diklatkerjasama_grid->anggota2->getViewValue() ?></span>
</span>
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_anggota2" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" value="<?php echo HtmlEncode($diklatkerjasama_grid->anggota2->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_anggota2" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" value="<?php echo HtmlEncode($diklatkerjasama_grid->anggota2->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_anggota2" name="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" id="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" value="<?php echo HtmlEncode($diklatkerjasama_grid->anggota2->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_anggota2" name="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" id="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" value="<?php echo HtmlEncode($diklatkerjasama_grid->anggota2->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->widyaiswara->Visible) { // widyaiswara ?>
		<td data-name="widyaiswara" <?php echo $diklatkerjasama_grid->widyaiswara->cellAttributes() ?>>
<?php if ($diklatkerjasama->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_widyaiswara" class="form-group">
<?php
$onchange = $diklatkerjasama_grid->widyaiswara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_grid->widyaiswara->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" id="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" value="<?php echo RemoveHtml($diklatkerjasama_grid->widyaiswara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->widyaiswara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->widyaiswara->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_grid->widyaiswara->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_widyaiswara" data-value-separator="<?php echo $diklatkerjasama_grid->widyaiswara->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" value="<?php echo HtmlEncode($diklatkerjasama_grid->widyaiswara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamagrid"], function() {
	fdiklatkerjasamagrid.createAutoSuggest({"id":"x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara","forceSelect":true});
});
</script>
<?php echo $diklatkerjasama_grid->widyaiswara->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_widyaiswara") ?>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_widyaiswara" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" value="<?php echo HtmlEncode($diklatkerjasama_grid->widyaiswara->OldValue) ?>">
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_widyaiswara" class="form-group">
<?php
$onchange = $diklatkerjasama_grid->widyaiswara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_grid->widyaiswara->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" id="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" value="<?php echo RemoveHtml($diklatkerjasama_grid->widyaiswara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->widyaiswara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->widyaiswara->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_grid->widyaiswara->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_widyaiswara" data-value-separator="<?php echo $diklatkerjasama_grid->widyaiswara->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" value="<?php echo HtmlEncode($diklatkerjasama_grid->widyaiswara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamagrid"], function() {
	fdiklatkerjasamagrid.createAutoSuggest({"id":"x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara","forceSelect":true});
});
</script>
<?php echo $diklatkerjasama_grid->widyaiswara->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_widyaiswara") ?>
</span>
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_widyaiswara">
<span<?php echo $diklatkerjasama_grid->widyaiswara->viewAttributes() ?>><?php echo $diklatkerjasama_grid->widyaiswara->getViewValue() ?></span>
</span>
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_widyaiswara" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" value="<?php echo HtmlEncode($diklatkerjasama_grid->widyaiswara->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_widyaiswara" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" value="<?php echo HtmlEncode($diklatkerjasama_grid->widyaiswara->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_widyaiswara" name="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" id="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" value="<?php echo HtmlEncode($diklatkerjasama_grid->widyaiswara->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_widyaiswara" name="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" id="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" value="<?php echo HtmlEncode($diklatkerjasama_grid->widyaiswara->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" <?php echo $diklatkerjasama_grid->kdprop->cellAttributes() ?>>
<?php if ($diklatkerjasama->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_kdprop" class="form-group">
<?php $diklatkerjasama_grid->kdprop->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatkerjasama" data-field="x_kdprop" data-value-separator="<?php echo $diklatkerjasama_grid->kdprop->displayValueSeparatorAttribute() ?>" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdprop" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdprop"<?php echo $diklatkerjasama_grid->kdprop->editAttributes() ?>>
			<?php echo $diklatkerjasama_grid->kdprop->selectOptionListHtml("x{$diklatkerjasama_grid->RowIndex}_kdprop") ?>
		</select>
</div>
<?php echo $diklatkerjasama_grid->kdprop->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_kdprop") ?>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdprop" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdprop" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdprop->OldValue) ?>">
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_kdprop" class="form-group">
<?php $diklatkerjasama_grid->kdprop->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatkerjasama" data-field="x_kdprop" data-value-separator="<?php echo $diklatkerjasama_grid->kdprop->displayValueSeparatorAttribute() ?>" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdprop" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdprop"<?php echo $diklatkerjasama_grid->kdprop->editAttributes() ?>>
			<?php echo $diklatkerjasama_grid->kdprop->selectOptionListHtml("x{$diklatkerjasama_grid->RowIndex}_kdprop") ?>
		</select>
</div>
<?php echo $diklatkerjasama_grid->kdprop->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_kdprop") ?>
</span>
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_kdprop">
<span<?php echo $diklatkerjasama_grid->kdprop->viewAttributes() ?>><?php echo $diklatkerjasama_grid->kdprop->getViewValue() ?></span>
</span>
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdprop" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdprop" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdprop->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdprop" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdprop" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdprop->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdprop" name="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdprop" id="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdprop->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdprop" name="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdprop" id="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdprop->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->kdkota->Visible) { // kdkota ?>
		<td data-name="kdkota" <?php echo $diklatkerjasama_grid->kdkota->cellAttributes() ?>>
<?php if ($diklatkerjasama->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_kdkota" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatkerjasama" data-field="x_kdkota" data-value-separator="<?php echo $diklatkerjasama_grid->kdkota->displayValueSeparatorAttribute() ?>" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkota" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkota"<?php echo $diklatkerjasama_grid->kdkota->editAttributes() ?>>
			<?php echo $diklatkerjasama_grid->kdkota->selectOptionListHtml("x{$diklatkerjasama_grid->RowIndex}_kdkota") ?>
		</select>
</div>
<?php echo $diklatkerjasama_grid->kdkota->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_kdkota") ?>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdkota" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkota" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdkota->OldValue) ?>">
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_kdkota" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatkerjasama" data-field="x_kdkota" data-value-separator="<?php echo $diklatkerjasama_grid->kdkota->displayValueSeparatorAttribute() ?>" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkota" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkota"<?php echo $diklatkerjasama_grid->kdkota->editAttributes() ?>>
			<?php echo $diklatkerjasama_grid->kdkota->selectOptionListHtml("x{$diklatkerjasama_grid->RowIndex}_kdkota") ?>
		</select>
</div>
<?php echo $diklatkerjasama_grid->kdkota->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_kdkota") ?>
</span>
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_kdkota">
<span<?php echo $diklatkerjasama_grid->kdkota->viewAttributes() ?>><?php echo $diklatkerjasama_grid->kdkota->getViewValue() ?></span>
</span>
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdkota" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkota" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdkota->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdkota" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkota" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdkota->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdkota" name="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkota" id="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdkota->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdkota" name="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkota" id="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdkota->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->tempat->Visible) { // tempat ?>
		<td data-name="tempat" <?php echo $diklatkerjasama_grid->tempat->cellAttributes() ?>>
<?php if ($diklatkerjasama->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_tempat" class="form-group">
<input type="text" data-table="diklatkerjasama" data-field="x_tempat" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_tempat" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_tempat" size="40" maxlength="255" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->tempat->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_grid->tempat->EditValue ?>"<?php echo $diklatkerjasama_grid->tempat->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_tempat" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_tempat" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($diklatkerjasama_grid->tempat->OldValue) ?>">
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_tempat" class="form-group">
<input type="text" data-table="diklatkerjasama" data-field="x_tempat" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_tempat" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_tempat" size="40" maxlength="255" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->tempat->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_grid->tempat->EditValue ?>"<?php echo $diklatkerjasama_grid->tempat->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_tempat">
<span<?php echo $diklatkerjasama_grid->tempat->viewAttributes() ?>><?php echo $diklatkerjasama_grid->tempat->getViewValue() ?></span>
</span>
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_tempat" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_tempat" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($diklatkerjasama_grid->tempat->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_tempat" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_tempat" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($diklatkerjasama_grid->tempat->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_tempat" name="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_tempat" id="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($diklatkerjasama_grid->tempat->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_tempat" name="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_tempat" id="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($diklatkerjasama_grid->tempat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->biaya->Visible) { // biaya ?>
		<td data-name="biaya" <?php echo $diklatkerjasama_grid->biaya->cellAttributes() ?>>
<?php if ($diklatkerjasama->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_biaya" class="form-group">
<input type="text" data-table="diklatkerjasama" data-field="x_biaya" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_biaya" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_biaya" size="15" maxlength="17" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->biaya->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_grid->biaya->EditValue ?>"<?php echo $diklatkerjasama_grid->biaya->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_biaya" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_biaya" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_biaya" value="<?php echo HtmlEncode($diklatkerjasama_grid->biaya->OldValue) ?>">
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_biaya" class="form-group">
<input type="text" data-table="diklatkerjasama" data-field="x_biaya" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_biaya" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_biaya" size="15" maxlength="17" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->biaya->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_grid->biaya->EditValue ?>"<?php echo $diklatkerjasama_grid->biaya->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_biaya">
<span<?php echo $diklatkerjasama_grid->biaya->viewAttributes() ?>><?php echo $diklatkerjasama_grid->biaya->getViewValue() ?></span>
</span>
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_biaya" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_biaya" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_biaya" value="<?php echo HtmlEncode($diklatkerjasama_grid->biaya->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_biaya" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_biaya" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_biaya" value="<?php echo HtmlEncode($diklatkerjasama_grid->biaya->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_biaya" name="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_biaya" id="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_biaya" value="<?php echo HtmlEncode($diklatkerjasama_grid->biaya->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_biaya" name="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_biaya" id="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_biaya" value="<?php echo HtmlEncode($diklatkerjasama_grid->biaya->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->statuspel->Visible) { // statuspel ?>
		<td data-name="statuspel" <?php echo $diklatkerjasama_grid->statuspel->cellAttributes() ?>>
<?php if ($diklatkerjasama->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_statuspel" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatkerjasama" data-field="x_statuspel" data-value-separator="<?php echo $diklatkerjasama_grid->statuspel->displayValueSeparatorAttribute() ?>" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_statuspel" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_statuspel"<?php echo $diklatkerjasama_grid->statuspel->editAttributes() ?>>
			<?php echo $diklatkerjasama_grid->statuspel->selectOptionListHtml("x{$diklatkerjasama_grid->RowIndex}_statuspel") ?>
		</select>
</div>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_statuspel" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_statuspel" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_statuspel" value="<?php echo HtmlEncode($diklatkerjasama_grid->statuspel->OldValue) ?>">
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_statuspel" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatkerjasama" data-field="x_statuspel" data-value-separator="<?php echo $diklatkerjasama_grid->statuspel->displayValueSeparatorAttribute() ?>" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_statuspel" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_statuspel"<?php echo $diklatkerjasama_grid->statuspel->editAttributes() ?>>
			<?php echo $diklatkerjasama_grid->statuspel->selectOptionListHtml("x{$diklatkerjasama_grid->RowIndex}_statuspel") ?>
		</select>
</div>
</span>
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_statuspel">
<span<?php echo $diklatkerjasama_grid->statuspel->viewAttributes() ?>><?php echo $diklatkerjasama_grid->statuspel->getViewValue() ?></span>
</span>
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_statuspel" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_statuspel" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_statuspel" value="<?php echo HtmlEncode($diklatkerjasama_grid->statuspel->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_statuspel" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_statuspel" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_statuspel" value="<?php echo HtmlEncode($diklatkerjasama_grid->statuspel->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_statuspel" name="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_statuspel" id="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_statuspel" value="<?php echo HtmlEncode($diklatkerjasama_grid->statuspel->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_statuspel" name="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_statuspel" id="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_statuspel" value="<?php echo HtmlEncode($diklatkerjasama_grid->statuspel->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->jenisevaluasi->Visible) { // jenisevaluasi ?>
		<td data-name="jenisevaluasi" <?php echo $diklatkerjasama_grid->jenisevaluasi->cellAttributes() ?>>
<?php if ($diklatkerjasama->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_jenisevaluasi" class="form-group">
<div id="tp_x<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="diklatkerjasama" data-field="x_jenisevaluasi" data-value-separator="<?php echo $diklatkerjasama_grid->jenisevaluasi->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi[]" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi[]" value="{value}"<?php echo $diklatkerjasama_grid->jenisevaluasi->editAttributes() ?>></div>
<div id="dsl_x<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi" data-repeatcolumn="1" class="ew-item-list d-none"><div>
<?php echo $diklatkerjasama_grid->jenisevaluasi->checkBoxListHtml(FALSE, "x{$diklatkerjasama_grid->RowIndex}_jenisevaluasi[]") ?>
</div></div>
<?php echo $diklatkerjasama_grid->jenisevaluasi->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_jenisevaluasi") ?>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_jenisevaluasi" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi[]" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi[]" value="<?php echo HtmlEncode($diklatkerjasama_grid->jenisevaluasi->OldValue) ?>">
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_jenisevaluasi" class="form-group">
<div id="tp_x<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="diklatkerjasama" data-field="x_jenisevaluasi" data-value-separator="<?php echo $diklatkerjasama_grid->jenisevaluasi->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi[]" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi[]" value="{value}"<?php echo $diklatkerjasama_grid->jenisevaluasi->editAttributes() ?>></div>
<div id="dsl_x<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi" data-repeatcolumn="1" class="ew-item-list d-none"><div>
<?php echo $diklatkerjasama_grid->jenisevaluasi->checkBoxListHtml(FALSE, "x{$diklatkerjasama_grid->RowIndex}_jenisevaluasi[]") ?>
</div></div>
<?php echo $diklatkerjasama_grid->jenisevaluasi->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_jenisevaluasi") ?>
</span>
<?php } ?>
<?php if ($diklatkerjasama->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $diklatkerjasama_grid->RowCount ?>_diklatkerjasama_jenisevaluasi">
<span<?php echo $diklatkerjasama_grid->jenisevaluasi->viewAttributes() ?>><?php echo $diklatkerjasama_grid->jenisevaluasi->getViewValue() ?></span>
</span>
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_jenisevaluasi" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi" value="<?php echo HtmlEncode($diklatkerjasama_grid->jenisevaluasi->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_jenisevaluasi" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi[]" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi[]" value="<?php echo HtmlEncode($diklatkerjasama_grid->jenisevaluasi->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_jenisevaluasi" name="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi" id="fdiklatkerjasamagrid$x<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi" value="<?php echo HtmlEncode($diklatkerjasama_grid->jenisevaluasi->FormValue) ?>">
<input type="hidden" data-table="diklatkerjasama" data-field="x_jenisevaluasi" name="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi[]" id="fdiklatkerjasamagrid$o<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi[]" value="<?php echo HtmlEncode($diklatkerjasama_grid->jenisevaluasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$diklatkerjasama_grid->ListOptions->render("body", "right", $diklatkerjasama_grid->RowCount);
?>
	</tr>
<?php if ($diklatkerjasama->RowType == ROWTYPE_ADD || $diklatkerjasama->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdiklatkerjasamagrid", "load"], function() {
	fdiklatkerjasamagrid.updateLists(<?php echo $diklatkerjasama_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$diklatkerjasama_grid->isGridAdd() || $diklatkerjasama->CurrentMode == "copy")
		if (!$diklatkerjasama_grid->Recordset->EOF)
			$diklatkerjasama_grid->Recordset->moveNext();
}
?>
<?php
	if ($diklatkerjasama->CurrentMode == "add" || $diklatkerjasama->CurrentMode == "copy" || $diklatkerjasama->CurrentMode == "edit") {
		$diklatkerjasama_grid->RowIndex = '$rowindex$';
		$diklatkerjasama_grid->loadRowValues();

		// Set row properties
		$diklatkerjasama->resetAttributes();
		$diklatkerjasama->RowAttrs->merge(["data-rowindex" => $diklatkerjasama_grid->RowIndex, "id" => "r0_diklatkerjasama", "data-rowtype" => ROWTYPE_ADD]);
		$diklatkerjasama->RowAttrs->appendClass("ew-template");
		$diklatkerjasama->RowType = ROWTYPE_ADD;

		// Render row
		$diklatkerjasama_grid->renderRow();

		// Render list options
		$diklatkerjasama_grid->renderListOptions();
		$diklatkerjasama_grid->StartRowCount = 0;
?>
	<tr <?php echo $diklatkerjasama->rowAttributes() ?>>
<?php

// Render list options (body, left)
$diklatkerjasama_grid->ListOptions->render("body", "left", $diklatkerjasama_grid->RowIndex);
?>
	<?php if ($diklatkerjasama_grid->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul">
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<span id="el$rowindex$_diklatkerjasama_kdjudul" class="form-group diklatkerjasama_kdjudul">
<?php
$onchange = $diklatkerjasama_grid->kdjudul->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_grid->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" id="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" value="<?php echo RemoveHtml($diklatkerjasama_grid->kdjudul->EditValue) ?>" size="25" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->kdjudul->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_grid->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdjudul" data-value-separator="<?php echo $diklatkerjasama_grid->kdjudul->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdjudul->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamagrid"], function() {
	fdiklatkerjasamagrid.createAutoSuggest({"id":"x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul","forceSelect":true,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_grid->kdjudul->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_kdjudul") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatkerjasama_kdjudul" class="form-group diklatkerjasama_kdjudul">
<span<?php echo $diklatkerjasama_grid->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatkerjasama_grid->kdjudul->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdjudul" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdjudul->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdjudul" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdjudul->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->kdkursil->Visible) { // kdkursil ?>
		<td data-name="kdkursil">
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<span id="el$rowindex$_diklatkerjasama_kdkursil" class="form-group diklatkerjasama_kdkursil">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatkerjasama" data-field="x_kdkursil" data-value-separator="<?php echo $diklatkerjasama_grid->kdkursil->displayValueSeparatorAttribute() ?>" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkursil" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkursil"<?php echo $diklatkerjasama_grid->kdkursil->editAttributes() ?>>
			<?php echo $diklatkerjasama_grid->kdkursil->selectOptionListHtml("x{$diklatkerjasama_grid->RowIndex}_kdkursil") ?>
		</select>
</div>
<?php echo $diklatkerjasama_grid->kdkursil->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_kdkursil") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatkerjasama_kdkursil" class="form-group diklatkerjasama_kdkursil">
<span<?php echo $diklatkerjasama_grid->kdkursil->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatkerjasama_grid->kdkursil->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdkursil" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkursil" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdkursil->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdkursil" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkursil" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdkursil->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->tawal->Visible) { // tawal ?>
		<td data-name="tawal">
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<span id="el$rowindex$_diklatkerjasama_tawal" class="form-group diklatkerjasama_tawal">
<input type="text" data-table="diklatkerjasama" data-field="x_tawal" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal" size="10" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->tawal->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_grid->tawal->EditValue ?>"<?php echo $diklatkerjasama_grid->tawal->editAttributes() ?>>
<?php if (!$diklatkerjasama_grid->tawal->ReadOnly && !$diklatkerjasama_grid->tawal->Disabled && !isset($diklatkerjasama_grid->tawal->EditAttrs["readonly"]) && !isset($diklatkerjasama_grid->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiklatkerjasamagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdiklatkerjasamagrid", "x<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatkerjasama_tawal" class="form-group diklatkerjasama_tawal">
<span<?php echo $diklatkerjasama_grid->tawal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatkerjasama_grid->tawal->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_tawal" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($diklatkerjasama_grid->tawal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_tawal" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($diklatkerjasama_grid->tawal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->takhir->Visible) { // takhir ?>
		<td data-name="takhir">
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<span id="el$rowindex$_diklatkerjasama_takhir" class="form-group diklatkerjasama_takhir">
<input type="text" data-table="diklatkerjasama" data-field="x_takhir" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir" size="10" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->takhir->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_grid->takhir->EditValue ?>"<?php echo $diklatkerjasama_grid->takhir->editAttributes() ?>>
<?php if (!$diklatkerjasama_grid->takhir->ReadOnly && !$diklatkerjasama_grid->takhir->Disabled && !isset($diklatkerjasama_grid->takhir->EditAttrs["readonly"]) && !isset($diklatkerjasama_grid->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiklatkerjasamagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdiklatkerjasamagrid", "x<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatkerjasama_takhir" class="form-group diklatkerjasama_takhir">
<span<?php echo $diklatkerjasama_grid->takhir->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatkerjasama_grid->takhir->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_takhir" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($diklatkerjasama_grid->takhir->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_takhir" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($diklatkerjasama_grid->takhir->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->jml_hari->Visible) { // jml_hari ?>
		<td data-name="jml_hari">
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<span id="el$rowindex$_diklatkerjasama_jml_hari" class="form-group diklatkerjasama_jml_hari">
<input type="text" data-table="diklatkerjasama" data-field="x_jml_hari" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_jml_hari" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_jml_hari" size="5" maxlength="3" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->jml_hari->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_grid->jml_hari->EditValue ?>"<?php echo $diklatkerjasama_grid->jml_hari->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatkerjasama_jml_hari" class="form-group diklatkerjasama_jml_hari">
<span<?php echo $diklatkerjasama_grid->jml_hari->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatkerjasama_grid->jml_hari->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_jml_hari" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_jml_hari" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_jml_hari" value="<?php echo HtmlEncode($diklatkerjasama_grid->jml_hari->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_jml_hari" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_jml_hari" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_jml_hari" value="<?php echo HtmlEncode($diklatkerjasama_grid->jml_hari->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->targetpes->Visible) { // targetpes ?>
		<td data-name="targetpes">
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<span id="el$rowindex$_diklatkerjasama_targetpes" class="form-group diklatkerjasama_targetpes">
<input type="text" data-table="diklatkerjasama" data-field="x_targetpes" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_targetpes" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_targetpes" size="5" maxlength="3" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->targetpes->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_grid->targetpes->EditValue ?>"<?php echo $diklatkerjasama_grid->targetpes->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatkerjasama_targetpes" class="form-group diklatkerjasama_targetpes">
<span<?php echo $diklatkerjasama_grid->targetpes->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatkerjasama_grid->targetpes->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_targetpes" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_targetpes" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_targetpes" value="<?php echo HtmlEncode($diklatkerjasama_grid->targetpes->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_targetpes" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_targetpes" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_targetpes" value="<?php echo HtmlEncode($diklatkerjasama_grid->targetpes->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->ketua->Visible) { // ketua ?>
		<td data-name="ketua">
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<span id="el$rowindex$_diklatkerjasama_ketua" class="form-group diklatkerjasama_ketua">
<?php
$onchange = $diklatkerjasama_grid->ketua->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_grid->ketua->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" id="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" value="<?php echo RemoveHtml($diklatkerjasama_grid->ketua->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->ketua->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->ketua->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_grid->ketua->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($diklatkerjasama_grid->ketua->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($diklatkerjasama_grid->ketua->ReadOnly || $diklatkerjasama_grid->ketua->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_ketua" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $diklatkerjasama_grid->ketua->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($diklatkerjasama_grid->ketua->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamagrid"], function() {
	fdiklatkerjasamagrid.createAutoSuggest({"id":"x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_grid->ketua->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_ketua") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatkerjasama_ketua" class="form-group diklatkerjasama_ketua">
<span<?php echo $diklatkerjasama_grid->ketua->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatkerjasama_grid->ketua->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_ketua" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($diklatkerjasama_grid->ketua->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_ketua" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($diklatkerjasama_grid->ketua->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->sekretaris->Visible) { // sekretaris ?>
		<td data-name="sekretaris">
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<span id="el$rowindex$_diklatkerjasama_sekretaris" class="form-group diklatkerjasama_sekretaris">
<?php
$onchange = $diklatkerjasama_grid->sekretaris->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_grid->sekretaris->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" id="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" value="<?php echo RemoveHtml($diklatkerjasama_grid->sekretaris->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->sekretaris->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->sekretaris->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_grid->sekretaris->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($diklatkerjasama_grid->sekretaris->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($diklatkerjasama_grid->sekretaris->ReadOnly || $diklatkerjasama_grid->sekretaris->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_sekretaris" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $diklatkerjasama_grid->sekretaris->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($diklatkerjasama_grid->sekretaris->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamagrid"], function() {
	fdiklatkerjasamagrid.createAutoSuggest({"id":"x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_grid->sekretaris->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_sekretaris") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatkerjasama_sekretaris" class="form-group diklatkerjasama_sekretaris">
<span<?php echo $diklatkerjasama_grid->sekretaris->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatkerjasama_grid->sekretaris->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_sekretaris" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($diklatkerjasama_grid->sekretaris->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_sekretaris" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($diklatkerjasama_grid->sekretaris->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->bendahara->Visible) { // bendahara ?>
		<td data-name="bendahara">
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<span id="el$rowindex$_diklatkerjasama_bendahara" class="form-group diklatkerjasama_bendahara">
<?php
$onchange = $diklatkerjasama_grid->bendahara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_grid->bendahara->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" id="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" value="<?php echo RemoveHtml($diklatkerjasama_grid->bendahara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->bendahara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->bendahara->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_grid->bendahara->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($diklatkerjasama_grid->bendahara->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($diklatkerjasama_grid->bendahara->ReadOnly || $diklatkerjasama_grid->bendahara->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_bendahara" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $diklatkerjasama_grid->bendahara->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($diklatkerjasama_grid->bendahara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamagrid"], function() {
	fdiklatkerjasamagrid.createAutoSuggest({"id":"x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_grid->bendahara->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_bendahara") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatkerjasama_bendahara" class="form-group diklatkerjasama_bendahara">
<span<?php echo $diklatkerjasama_grid->bendahara->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatkerjasama_grid->bendahara->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_bendahara" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($diklatkerjasama_grid->bendahara->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_bendahara" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($diklatkerjasama_grid->bendahara->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->anggota2->Visible) { // anggota2 ?>
		<td data-name="anggota2">
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<span id="el$rowindex$_diklatkerjasama_anggota2" class="form-group diklatkerjasama_anggota2">
<?php
$onchange = $diklatkerjasama_grid->anggota2->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_grid->anggota2->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" id="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" value="<?php echo RemoveHtml($diklatkerjasama_grid->anggota2->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->anggota2->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->anggota2->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_grid->anggota2->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($diklatkerjasama_grid->anggota2->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($diklatkerjasama_grid->anggota2->ReadOnly || $diklatkerjasama_grid->anggota2->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_anggota2" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $diklatkerjasama_grid->anggota2->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" value="<?php echo HtmlEncode($diklatkerjasama_grid->anggota2->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamagrid"], function() {
	fdiklatkerjasamagrid.createAutoSuggest({"id":"x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_grid->anggota2->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_anggota2") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatkerjasama_anggota2" class="form-group diklatkerjasama_anggota2">
<span<?php echo $diklatkerjasama_grid->anggota2->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatkerjasama_grid->anggota2->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_anggota2" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" value="<?php echo HtmlEncode($diklatkerjasama_grid->anggota2->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_anggota2" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_anggota2" value="<?php echo HtmlEncode($diklatkerjasama_grid->anggota2->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->widyaiswara->Visible) { // widyaiswara ?>
		<td data-name="widyaiswara">
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<span id="el$rowindex$_diklatkerjasama_widyaiswara" class="form-group diklatkerjasama_widyaiswara">
<?php
$onchange = $diklatkerjasama_grid->widyaiswara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_grid->widyaiswara->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara">
	<input type="text" class="form-control" name="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" id="sv_x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" value="<?php echo RemoveHtml($diklatkerjasama_grid->widyaiswara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->widyaiswara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->widyaiswara->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_grid->widyaiswara->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_widyaiswara" data-value-separator="<?php echo $diklatkerjasama_grid->widyaiswara->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" value="<?php echo HtmlEncode($diklatkerjasama_grid->widyaiswara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamagrid"], function() {
	fdiklatkerjasamagrid.createAutoSuggest({"id":"x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara","forceSelect":true});
});
</script>
<?php echo $diklatkerjasama_grid->widyaiswara->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_widyaiswara") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatkerjasama_widyaiswara" class="form-group diklatkerjasama_widyaiswara">
<span<?php echo $diklatkerjasama_grid->widyaiswara->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatkerjasama_grid->widyaiswara->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_widyaiswara" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" value="<?php echo HtmlEncode($diklatkerjasama_grid->widyaiswara->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_widyaiswara" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_widyaiswara" value="<?php echo HtmlEncode($diklatkerjasama_grid->widyaiswara->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop">
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<span id="el$rowindex$_diklatkerjasama_kdprop" class="form-group diklatkerjasama_kdprop">
<?php $diklatkerjasama_grid->kdprop->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatkerjasama" data-field="x_kdprop" data-value-separator="<?php echo $diklatkerjasama_grid->kdprop->displayValueSeparatorAttribute() ?>" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdprop" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdprop"<?php echo $diklatkerjasama_grid->kdprop->editAttributes() ?>>
			<?php echo $diklatkerjasama_grid->kdprop->selectOptionListHtml("x{$diklatkerjasama_grid->RowIndex}_kdprop") ?>
		</select>
</div>
<?php echo $diklatkerjasama_grid->kdprop->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_kdprop") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatkerjasama_kdprop" class="form-group diklatkerjasama_kdprop">
<span<?php echo $diklatkerjasama_grid->kdprop->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatkerjasama_grid->kdprop->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdprop" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdprop" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdprop->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdprop" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdprop" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdprop->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->kdkota->Visible) { // kdkota ?>
		<td data-name="kdkota">
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<span id="el$rowindex$_diklatkerjasama_kdkota" class="form-group diklatkerjasama_kdkota">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatkerjasama" data-field="x_kdkota" data-value-separator="<?php echo $diklatkerjasama_grid->kdkota->displayValueSeparatorAttribute() ?>" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkota" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkota"<?php echo $diklatkerjasama_grid->kdkota->editAttributes() ?>>
			<?php echo $diklatkerjasama_grid->kdkota->selectOptionListHtml("x{$diklatkerjasama_grid->RowIndex}_kdkota") ?>
		</select>
</div>
<?php echo $diklatkerjasama_grid->kdkota->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_kdkota") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatkerjasama_kdkota" class="form-group diklatkerjasama_kdkota">
<span<?php echo $diklatkerjasama_grid->kdkota->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatkerjasama_grid->kdkota->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdkota" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkota" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdkota->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdkota" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkota" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($diklatkerjasama_grid->kdkota->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->tempat->Visible) { // tempat ?>
		<td data-name="tempat">
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<span id="el$rowindex$_diklatkerjasama_tempat" class="form-group diklatkerjasama_tempat">
<input type="text" data-table="diklatkerjasama" data-field="x_tempat" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_tempat" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_tempat" size="40" maxlength="255" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->tempat->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_grid->tempat->EditValue ?>"<?php echo $diklatkerjasama_grid->tempat->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatkerjasama_tempat" class="form-group diklatkerjasama_tempat">
<span<?php echo $diklatkerjasama_grid->tempat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatkerjasama_grid->tempat->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_tempat" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_tempat" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($diklatkerjasama_grid->tempat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_tempat" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_tempat" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($diklatkerjasama_grid->tempat->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->biaya->Visible) { // biaya ?>
		<td data-name="biaya">
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<span id="el$rowindex$_diklatkerjasama_biaya" class="form-group diklatkerjasama_biaya">
<input type="text" data-table="diklatkerjasama" data-field="x_biaya" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_biaya" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_biaya" size="15" maxlength="17" placeholder="<?php echo HtmlEncode($diklatkerjasama_grid->biaya->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_grid->biaya->EditValue ?>"<?php echo $diklatkerjasama_grid->biaya->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatkerjasama_biaya" class="form-group diklatkerjasama_biaya">
<span<?php echo $diklatkerjasama_grid->biaya->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatkerjasama_grid->biaya->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_biaya" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_biaya" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_biaya" value="<?php echo HtmlEncode($diklatkerjasama_grid->biaya->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_biaya" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_biaya" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_biaya" value="<?php echo HtmlEncode($diklatkerjasama_grid->biaya->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->statuspel->Visible) { // statuspel ?>
		<td data-name="statuspel">
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<span id="el$rowindex$_diklatkerjasama_statuspel" class="form-group diklatkerjasama_statuspel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatkerjasama" data-field="x_statuspel" data-value-separator="<?php echo $diklatkerjasama_grid->statuspel->displayValueSeparatorAttribute() ?>" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_statuspel" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_statuspel"<?php echo $diklatkerjasama_grid->statuspel->editAttributes() ?>>
			<?php echo $diklatkerjasama_grid->statuspel->selectOptionListHtml("x{$diklatkerjasama_grid->RowIndex}_statuspel") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatkerjasama_statuspel" class="form-group diklatkerjasama_statuspel">
<span<?php echo $diklatkerjasama_grid->statuspel->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatkerjasama_grid->statuspel->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_statuspel" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_statuspel" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_statuspel" value="<?php echo HtmlEncode($diklatkerjasama_grid->statuspel->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_statuspel" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_statuspel" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_statuspel" value="<?php echo HtmlEncode($diklatkerjasama_grid->statuspel->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->jenisevaluasi->Visible) { // jenisevaluasi ?>
		<td data-name="jenisevaluasi">
<?php if (!$diklatkerjasama->isConfirm()) { ?>
<span id="el$rowindex$_diklatkerjasama_jenisevaluasi" class="form-group diklatkerjasama_jenisevaluasi">
<div id="tp_x<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="diklatkerjasama" data-field="x_jenisevaluasi" data-value-separator="<?php echo $diklatkerjasama_grid->jenisevaluasi->displayValueSeparatorAttribute() ?>" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi[]" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi[]" value="{value}"<?php echo $diklatkerjasama_grid->jenisevaluasi->editAttributes() ?>></div>
<div id="dsl_x<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi" data-repeatcolumn="1" class="ew-item-list d-none"><div>
<?php echo $diklatkerjasama_grid->jenisevaluasi->checkBoxListHtml(FALSE, "x{$diklatkerjasama_grid->RowIndex}_jenisevaluasi[]") ?>
</div></div>
<?php echo $diklatkerjasama_grid->jenisevaluasi->Lookup->getParamTag($diklatkerjasama_grid, "p_x" . $diklatkerjasama_grid->RowIndex . "_jenisevaluasi") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_diklatkerjasama_jenisevaluasi" class="form-group diklatkerjasama_jenisevaluasi">
<span<?php echo $diklatkerjasama_grid->jenisevaluasi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($diklatkerjasama_grid->jenisevaluasi->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_jenisevaluasi" name="x<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi" id="x<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi" value="<?php echo HtmlEncode($diklatkerjasama_grid->jenisevaluasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="diklatkerjasama" data-field="x_jenisevaluasi" name="o<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi[]" id="o<?php echo $diklatkerjasama_grid->RowIndex ?>_jenisevaluasi[]" value="<?php echo HtmlEncode($diklatkerjasama_grid->jenisevaluasi->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$diklatkerjasama_grid->ListOptions->render("body", "right", $diklatkerjasama_grid->RowIndex);
?>
<script>
loadjs.ready(["fdiklatkerjasamagrid", "load"], function() {
	fdiklatkerjasamagrid.updateLists(<?php echo $diklatkerjasama_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
<?php

// Render aggregate row
$diklatkerjasama->RowType = ROWTYPE_AGGREGATE;
$diklatkerjasama->resetAttributes();
$diklatkerjasama_grid->renderRow();
?>
<?php if ($diklatkerjasama_grid->TotalRecords > 0 && $diklatkerjasama->CurrentMode == "view") { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$diklatkerjasama_grid->renderListOptions();

// Render list options (footer, left)
$diklatkerjasama_grid->ListOptions->render("footer", "left");
?>
	<?php if ($diklatkerjasama_grid->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" class="<?php echo $diklatkerjasama_grid->kdjudul->footerCellClass() ?>"><span id="elf_diklatkerjasama_kdjudul" class="diklatkerjasama_kdjudul">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->kdkursil->Visible) { // kdkursil ?>
		<td data-name="kdkursil" class="<?php echo $diklatkerjasama_grid->kdkursil->footerCellClass() ?>"><span id="elf_diklatkerjasama_kdkursil" class="diklatkerjasama_kdkursil">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->tawal->Visible) { // tawal ?>
		<td data-name="tawal" class="<?php echo $diklatkerjasama_grid->tawal->footerCellClass() ?>"><span id="elf_diklatkerjasama_tawal" class="diklatkerjasama_tawal">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->takhir->Visible) { // takhir ?>
		<td data-name="takhir" class="<?php echo $diklatkerjasama_grid->takhir->footerCellClass() ?>"><span id="elf_diklatkerjasama_takhir" class="diklatkerjasama_takhir">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->jml_hari->Visible) { // jml_hari ?>
		<td data-name="jml_hari" class="<?php echo $diklatkerjasama_grid->jml_hari->footerCellClass() ?>"><span id="elf_diklatkerjasama_jml_hari" class="diklatkerjasama_jml_hari">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->targetpes->Visible) { // targetpes ?>
		<td data-name="targetpes" class="<?php echo $diklatkerjasama_grid->targetpes->footerCellClass() ?>"><span id="elf_diklatkerjasama_targetpes" class="diklatkerjasama_targetpes">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $diklatkerjasama_grid->targetpes->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->ketua->Visible) { // ketua ?>
		<td data-name="ketua" class="<?php echo $diklatkerjasama_grid->ketua->footerCellClass() ?>"><span id="elf_diklatkerjasama_ketua" class="diklatkerjasama_ketua">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->sekretaris->Visible) { // sekretaris ?>
		<td data-name="sekretaris" class="<?php echo $diklatkerjasama_grid->sekretaris->footerCellClass() ?>"><span id="elf_diklatkerjasama_sekretaris" class="diklatkerjasama_sekretaris">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->bendahara->Visible) { // bendahara ?>
		<td data-name="bendahara" class="<?php echo $diklatkerjasama_grid->bendahara->footerCellClass() ?>"><span id="elf_diklatkerjasama_bendahara" class="diklatkerjasama_bendahara">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->anggota2->Visible) { // anggota2 ?>
		<td data-name="anggota2" class="<?php echo $diklatkerjasama_grid->anggota2->footerCellClass() ?>"><span id="elf_diklatkerjasama_anggota2" class="diklatkerjasama_anggota2">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->widyaiswara->Visible) { // widyaiswara ?>
		<td data-name="widyaiswara" class="<?php echo $diklatkerjasama_grid->widyaiswara->footerCellClass() ?>"><span id="elf_diklatkerjasama_widyaiswara" class="diklatkerjasama_widyaiswara">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" class="<?php echo $diklatkerjasama_grid->kdprop->footerCellClass() ?>"><span id="elf_diklatkerjasama_kdprop" class="diklatkerjasama_kdprop">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->kdkota->Visible) { // kdkota ?>
		<td data-name="kdkota" class="<?php echo $diklatkerjasama_grid->kdkota->footerCellClass() ?>"><span id="elf_diklatkerjasama_kdkota" class="diklatkerjasama_kdkota">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->tempat->Visible) { // tempat ?>
		<td data-name="tempat" class="<?php echo $diklatkerjasama_grid->tempat->footerCellClass() ?>"><span id="elf_diklatkerjasama_tempat" class="diklatkerjasama_tempat">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->biaya->Visible) { // biaya ?>
		<td data-name="biaya" class="<?php echo $diklatkerjasama_grid->biaya->footerCellClass() ?>"><span id="elf_diklatkerjasama_biaya" class="diklatkerjasama_biaya">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->statuspel->Visible) { // statuspel ?>
		<td data-name="statuspel" class="<?php echo $diklatkerjasama_grid->statuspel->footerCellClass() ?>"><span id="elf_diklatkerjasama_statuspel" class="diklatkerjasama_statuspel">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_grid->jenisevaluasi->Visible) { // jenisevaluasi ?>
		<td data-name="jenisevaluasi" class="<?php echo $diklatkerjasama_grid->jenisevaluasi->footerCellClass() ?>"><span id="elf_diklatkerjasama_jenisevaluasi" class="diklatkerjasama_jenisevaluasi">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$diklatkerjasama_grid->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($diklatkerjasama->CurrentMode == "add" || $diklatkerjasama->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $diklatkerjasama_grid->FormKeyCountName ?>" id="<?php echo $diklatkerjasama_grid->FormKeyCountName ?>" value="<?php echo $diklatkerjasama_grid->KeyCount ?>">
<?php echo $diklatkerjasama_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($diklatkerjasama->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $diklatkerjasama_grid->FormKeyCountName ?>" id="<?php echo $diklatkerjasama_grid->FormKeyCountName ?>" value="<?php echo $diklatkerjasama_grid->KeyCount ?>">
<?php echo $diklatkerjasama_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($diklatkerjasama->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdiklatkerjasamagrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($diklatkerjasama_grid->Recordset)
	$diklatkerjasama_grid->Recordset->Close();
?>
<?php if ($diklatkerjasama_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $diklatkerjasama_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($diklatkerjasama_grid->TotalRecords == 0 && !$diklatkerjasama->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $diklatkerjasama_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$diklatkerjasama_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$diklatkerjasama_grid->terminate();
?>