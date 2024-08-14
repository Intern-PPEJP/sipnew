<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($t_coachingtahapan_grid))
	$t_coachingtahapan_grid = new t_coachingtahapan_grid();

// Run the page
$t_coachingtahapan_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_coachingtahapan_grid->Page_Render();
?>
<?php if (!$t_coachingtahapan_grid->isExport()) { ?>
<script>
var ft_coachingtahapangrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	ft_coachingtahapangrid = new ew.Form("ft_coachingtahapangrid", "grid");
	ft_coachingtahapangrid.formKeyCountName = '<?php echo $t_coachingtahapan_grid->FormKeyCountName ?>';

	// Validate form
	ft_coachingtahapangrid.validate = function() {
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
			<?php if ($t_coachingtahapan_grid->area->Required) { ?>
				elm = this.getElements("x" + infix + "_area");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_grid->area->caption(), $t_coachingtahapan_grid->area->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coachingtahapan_grid->jenispel->Required) { ?>
				elm = this.getElements("x" + infix + "_jenispel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_grid->jenispel->caption(), $t_coachingtahapan_grid->jenispel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coachingtahapan_grid->kdkategori->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkategori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_grid->kdkategori->caption(), $t_coachingtahapan_grid->kdkategori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coachingtahapan_grid->kerjasama->Required) { ?>
				elm = this.getElements("x" + infix + "_kerjasama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_grid->kerjasama->caption(), $t_coachingtahapan_grid->kerjasama->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kerjasama");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coachingtahapan_grid->kerjasama->errorMessage()) ?>");
			<?php if ($t_coachingtahapan_grid->tglpelak1->Required) { ?>
				elm = this.getElements("x" + infix + "_tglpelak1");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_grid->tglpelak1->caption(), $t_coachingtahapan_grid->tglpelak1->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coachingtahapan_grid->targetpes1->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes1");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_grid->targetpes1->caption(), $t_coachingtahapan_grid->targetpes1->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes1");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coachingtahapan_grid->targetpes1->errorMessage()) ?>");
			<?php if ($t_coachingtahapan_grid->tglpelak2->Required) { ?>
				elm = this.getElements("x" + infix + "_tglpelak2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_grid->tglpelak2->caption(), $t_coachingtahapan_grid->tglpelak2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coachingtahapan_grid->targetpes2->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_grid->targetpes2->caption(), $t_coachingtahapan_grid->targetpes2->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes2");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coachingtahapan_grid->targetpes2->errorMessage()) ?>");
			<?php if ($t_coachingtahapan_grid->tglpelak3->Required) { ?>
				elm = this.getElements("x" + infix + "_tglpelak3");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_grid->tglpelak3->caption(), $t_coachingtahapan_grid->tglpelak3->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coachingtahapan_grid->targetpes3->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes3");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_grid->targetpes3->caption(), $t_coachingtahapan_grid->targetpes3->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes3");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coachingtahapan_grid->targetpes3->errorMessage()) ?>");
			<?php if ($t_coachingtahapan_grid->tglpelak4->Required) { ?>
				elm = this.getElements("x" + infix + "_tglpelak4");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_grid->tglpelak4->caption(), $t_coachingtahapan_grid->tglpelak4->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coachingtahapan_grid->targetpes4->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes4");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_grid->targetpes4->caption(), $t_coachingtahapan_grid->targetpes4->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes4");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coachingtahapan_grid->targetpes4->errorMessage()) ?>");
			<?php if ($t_coachingtahapan_grid->tglpelak5->Required) { ?>
				elm = this.getElements("x" + infix + "_tglpelak5");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_grid->tglpelak5->caption(), $t_coachingtahapan_grid->tglpelak5->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coachingtahapan_grid->targetpes5->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes5");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_grid->targetpes5->caption(), $t_coachingtahapan_grid->targetpes5->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes5");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coachingtahapan_grid->targetpes5->errorMessage()) ?>");
			<?php if ($t_coachingtahapan_grid->tglpelak6->Required) { ?>
				elm = this.getElements("x" + infix + "_tglpelak6");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_grid->tglpelak6->caption(), $t_coachingtahapan_grid->tglpelak6->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coachingtahapan_grid->targetpes6->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes6");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_grid->targetpes6->caption(), $t_coachingtahapan_grid->targetpes6->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes6");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coachingtahapan_grid->targetpes6->errorMessage()) ?>");
			<?php if ($t_coachingtahapan_grid->tglpelak7->Required) { ?>
				elm = this.getElements("x" + infix + "_tglpelak7");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_grid->tglpelak7->caption(), $t_coachingtahapan_grid->tglpelak7->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coachingtahapan_grid->targetpes7->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes7");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_grid->targetpes7->caption(), $t_coachingtahapan_grid->targetpes7->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes7");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coachingtahapan_grid->targetpes7->errorMessage()) ?>");
			<?php if ($t_coachingtahapan_grid->tglpelak8->Required) { ?>
				elm = this.getElements("x" + infix + "_tglpelak8");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_grid->tglpelak8->caption(), $t_coachingtahapan_grid->tglpelak8->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coachingtahapan_grid->targetpes8->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes8");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_grid->targetpes8->caption(), $t_coachingtahapan_grid->targetpes8->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes8");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coachingtahapan_grid->targetpes8->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	ft_coachingtahapangrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "area", false)) return false;
		if (ew.valueChanged(fobj, infix, "jenispel", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdkategori", false)) return false;
		if (ew.valueChanged(fobj, infix, "kerjasama", false)) return false;
		if (ew.valueChanged(fobj, infix, "tglpelak1", false)) return false;
		if (ew.valueChanged(fobj, infix, "targetpes1", false)) return false;
		if (ew.valueChanged(fobj, infix, "tglpelak2", false)) return false;
		if (ew.valueChanged(fobj, infix, "targetpes2", false)) return false;
		if (ew.valueChanged(fobj, infix, "tglpelak3", false)) return false;
		if (ew.valueChanged(fobj, infix, "targetpes3", false)) return false;
		if (ew.valueChanged(fobj, infix, "tglpelak4", false)) return false;
		if (ew.valueChanged(fobj, infix, "targetpes4", false)) return false;
		if (ew.valueChanged(fobj, infix, "tglpelak5", false)) return false;
		if (ew.valueChanged(fobj, infix, "targetpes5", false)) return false;
		if (ew.valueChanged(fobj, infix, "tglpelak6", false)) return false;
		if (ew.valueChanged(fobj, infix, "targetpes6", false)) return false;
		if (ew.valueChanged(fobj, infix, "tglpelak7", false)) return false;
		if (ew.valueChanged(fobj, infix, "targetpes7", false)) return false;
		if (ew.valueChanged(fobj, infix, "tglpelak8", false)) return false;
		if (ew.valueChanged(fobj, infix, "targetpes8", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_coachingtahapangrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_coachingtahapangrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_coachingtahapangrid.lists["x_area"] = <?php echo $t_coachingtahapan_grid->area->Lookup->toClientList($t_coachingtahapan_grid) ?>;
	ft_coachingtahapangrid.lists["x_area"].options = <?php echo JsonEncode($t_coachingtahapan_grid->area->lookupOptions()) ?>;
	ft_coachingtahapangrid.lists["x_jenispel"] = <?php echo $t_coachingtahapan_grid->jenispel->Lookup->toClientList($t_coachingtahapan_grid) ?>;
	ft_coachingtahapangrid.lists["x_jenispel"].options = <?php echo JsonEncode($t_coachingtahapan_grid->jenispel->options(FALSE, TRUE)) ?>;
	ft_coachingtahapangrid.lists["x_kdkategori"] = <?php echo $t_coachingtahapan_grid->kdkategori->Lookup->toClientList($t_coachingtahapan_grid) ?>;
	ft_coachingtahapangrid.lists["x_kdkategori"].options = <?php echo JsonEncode($t_coachingtahapan_grid->kdkategori->lookupOptions()) ?>;
	ft_coachingtahapangrid.lists["x_kerjasama"] = <?php echo $t_coachingtahapan_grid->kerjasama->Lookup->toClientList($t_coachingtahapan_grid) ?>;
	ft_coachingtahapangrid.lists["x_kerjasama"].options = <?php echo JsonEncode($t_coachingtahapan_grid->kerjasama->lookupOptions()) ?>;
	ft_coachingtahapangrid.autoSuggests["x_kerjasama"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("ft_coachingtahapangrid");
});
</script>
<?php } ?>
<?php
$t_coachingtahapan_grid->renderOtherOptions();
?>
<?php if ($t_coachingtahapan_grid->TotalRecords > 0 || $t_coachingtahapan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_coachingtahapan_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_coachingtahapan">
<?php if ($t_coachingtahapan_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $t_coachingtahapan_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ft_coachingtahapangrid" class="ew-form ew-list-form form-inline">
<div id="gmp_t_coachingtahapan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_t_coachingtahapangrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_coachingtahapan->RowType = ROWTYPE_HEADER;

// Render list options
$t_coachingtahapan_grid->renderListOptions();

// Render list options (header, left)
$t_coachingtahapan_grid->ListOptions->render("header", "left");
?>
<?php if ($t_coachingtahapan_grid->area->Visible) { // area ?>
	<?php if ($t_coachingtahapan_grid->SortUrl($t_coachingtahapan_grid->area) == "") { ?>
		<th data-name="area" class="<?php echo $t_coachingtahapan_grid->area->headerCellClass() ?>"><div id="elh_t_coachingtahapan_area" class="t_coachingtahapan_area"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->area->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="area" class="<?php echo $t_coachingtahapan_grid->area->headerCellClass() ?>"><div><div id="elh_t_coachingtahapan_area" class="t_coachingtahapan_area">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->area->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_grid->area->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_grid->area->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_grid->jenispel->Visible) { // jenispel ?>
	<?php if ($t_coachingtahapan_grid->SortUrl($t_coachingtahapan_grid->jenispel) == "") { ?>
		<th data-name="jenispel" class="<?php echo $t_coachingtahapan_grid->jenispel->headerCellClass() ?>"><div id="elh_t_coachingtahapan_jenispel" class="t_coachingtahapan_jenispel"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->jenispel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenispel" class="<?php echo $t_coachingtahapan_grid->jenispel->headerCellClass() ?>"><div><div id="elh_t_coachingtahapan_jenispel" class="t_coachingtahapan_jenispel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->jenispel->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_grid->jenispel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_grid->jenispel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_grid->kdkategori->Visible) { // kdkategori ?>
	<?php if ($t_coachingtahapan_grid->SortUrl($t_coachingtahapan_grid->kdkategori) == "") { ?>
		<th data-name="kdkategori" class="<?php echo $t_coachingtahapan_grid->kdkategori->headerCellClass() ?>"><div id="elh_t_coachingtahapan_kdkategori" class="t_coachingtahapan_kdkategori"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->kdkategori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkategori" class="<?php echo $t_coachingtahapan_grid->kdkategori->headerCellClass() ?>"><div><div id="elh_t_coachingtahapan_kdkategori" class="t_coachingtahapan_kdkategori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->kdkategori->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_grid->kdkategori->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_grid->kdkategori->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_grid->kerjasama->Visible) { // kerjasama ?>
	<?php if ($t_coachingtahapan_grid->SortUrl($t_coachingtahapan_grid->kerjasama) == "") { ?>
		<th data-name="kerjasama" class="<?php echo $t_coachingtahapan_grid->kerjasama->headerCellClass() ?>"><div id="elh_t_coachingtahapan_kerjasama" class="t_coachingtahapan_kerjasama"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->kerjasama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kerjasama" class="<?php echo $t_coachingtahapan_grid->kerjasama->headerCellClass() ?>"><div><div id="elh_t_coachingtahapan_kerjasama" class="t_coachingtahapan_kerjasama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->kerjasama->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_grid->kerjasama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_grid->kerjasama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_grid->tglpelak1->Visible) { // tglpelak1 ?>
	<?php if ($t_coachingtahapan_grid->SortUrl($t_coachingtahapan_grid->tglpelak1) == "") { ?>
		<th data-name="tglpelak1" class="<?php echo $t_coachingtahapan_grid->tglpelak1->headerCellClass() ?>"><div id="elh_t_coachingtahapan_tglpelak1" class="t_coachingtahapan_tglpelak1"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->tglpelak1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tglpelak1" class="<?php echo $t_coachingtahapan_grid->tglpelak1->headerCellClass() ?>"><div><div id="elh_t_coachingtahapan_tglpelak1" class="t_coachingtahapan_tglpelak1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->tglpelak1->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_grid->tglpelak1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_grid->tglpelak1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_grid->targetpes1->Visible) { // targetpes1 ?>
	<?php if ($t_coachingtahapan_grid->SortUrl($t_coachingtahapan_grid->targetpes1) == "") { ?>
		<th data-name="targetpes1" class="<?php echo $t_coachingtahapan_grid->targetpes1->headerCellClass() ?>"><div id="elh_t_coachingtahapan_targetpes1" class="t_coachingtahapan_targetpes1"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->targetpes1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes1" class="<?php echo $t_coachingtahapan_grid->targetpes1->headerCellClass() ?>"><div><div id="elh_t_coachingtahapan_targetpes1" class="t_coachingtahapan_targetpes1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->targetpes1->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_grid->targetpes1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_grid->targetpes1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_grid->tglpelak2->Visible) { // tglpelak2 ?>
	<?php if ($t_coachingtahapan_grid->SortUrl($t_coachingtahapan_grid->tglpelak2) == "") { ?>
		<th data-name="tglpelak2" class="<?php echo $t_coachingtahapan_grid->tglpelak2->headerCellClass() ?>"><div id="elh_t_coachingtahapan_tglpelak2" class="t_coachingtahapan_tglpelak2"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->tglpelak2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tglpelak2" class="<?php echo $t_coachingtahapan_grid->tglpelak2->headerCellClass() ?>"><div><div id="elh_t_coachingtahapan_tglpelak2" class="t_coachingtahapan_tglpelak2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->tglpelak2->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_grid->tglpelak2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_grid->tglpelak2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_grid->targetpes2->Visible) { // targetpes2 ?>
	<?php if ($t_coachingtahapan_grid->SortUrl($t_coachingtahapan_grid->targetpes2) == "") { ?>
		<th data-name="targetpes2" class="<?php echo $t_coachingtahapan_grid->targetpes2->headerCellClass() ?>"><div id="elh_t_coachingtahapan_targetpes2" class="t_coachingtahapan_targetpes2"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->targetpes2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes2" class="<?php echo $t_coachingtahapan_grid->targetpes2->headerCellClass() ?>"><div><div id="elh_t_coachingtahapan_targetpes2" class="t_coachingtahapan_targetpes2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->targetpes2->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_grid->targetpes2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_grid->targetpes2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_grid->tglpelak3->Visible) { // tglpelak3 ?>
	<?php if ($t_coachingtahapan_grid->SortUrl($t_coachingtahapan_grid->tglpelak3) == "") { ?>
		<th data-name="tglpelak3" class="<?php echo $t_coachingtahapan_grid->tglpelak3->headerCellClass() ?>"><div id="elh_t_coachingtahapan_tglpelak3" class="t_coachingtahapan_tglpelak3"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->tglpelak3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tglpelak3" class="<?php echo $t_coachingtahapan_grid->tglpelak3->headerCellClass() ?>"><div><div id="elh_t_coachingtahapan_tglpelak3" class="t_coachingtahapan_tglpelak3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->tglpelak3->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_grid->tglpelak3->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_grid->tglpelak3->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_grid->targetpes3->Visible) { // targetpes3 ?>
	<?php if ($t_coachingtahapan_grid->SortUrl($t_coachingtahapan_grid->targetpes3) == "") { ?>
		<th data-name="targetpes3" class="<?php echo $t_coachingtahapan_grid->targetpes3->headerCellClass() ?>"><div id="elh_t_coachingtahapan_targetpes3" class="t_coachingtahapan_targetpes3"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->targetpes3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes3" class="<?php echo $t_coachingtahapan_grid->targetpes3->headerCellClass() ?>"><div><div id="elh_t_coachingtahapan_targetpes3" class="t_coachingtahapan_targetpes3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->targetpes3->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_grid->targetpes3->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_grid->targetpes3->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_grid->tglpelak4->Visible) { // tglpelak4 ?>
	<?php if ($t_coachingtahapan_grid->SortUrl($t_coachingtahapan_grid->tglpelak4) == "") { ?>
		<th data-name="tglpelak4" class="<?php echo $t_coachingtahapan_grid->tglpelak4->headerCellClass() ?>"><div id="elh_t_coachingtahapan_tglpelak4" class="t_coachingtahapan_tglpelak4"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->tglpelak4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tglpelak4" class="<?php echo $t_coachingtahapan_grid->tglpelak4->headerCellClass() ?>"><div><div id="elh_t_coachingtahapan_tglpelak4" class="t_coachingtahapan_tglpelak4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->tglpelak4->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_grid->tglpelak4->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_grid->tglpelak4->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_grid->targetpes4->Visible) { // targetpes4 ?>
	<?php if ($t_coachingtahapan_grid->SortUrl($t_coachingtahapan_grid->targetpes4) == "") { ?>
		<th data-name="targetpes4" class="<?php echo $t_coachingtahapan_grid->targetpes4->headerCellClass() ?>"><div id="elh_t_coachingtahapan_targetpes4" class="t_coachingtahapan_targetpes4"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->targetpes4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes4" class="<?php echo $t_coachingtahapan_grid->targetpes4->headerCellClass() ?>"><div><div id="elh_t_coachingtahapan_targetpes4" class="t_coachingtahapan_targetpes4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->targetpes4->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_grid->targetpes4->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_grid->targetpes4->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_grid->tglpelak5->Visible) { // tglpelak5 ?>
	<?php if ($t_coachingtahapan_grid->SortUrl($t_coachingtahapan_grid->tglpelak5) == "") { ?>
		<th data-name="tglpelak5" class="<?php echo $t_coachingtahapan_grid->tglpelak5->headerCellClass() ?>"><div id="elh_t_coachingtahapan_tglpelak5" class="t_coachingtahapan_tglpelak5"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->tglpelak5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tglpelak5" class="<?php echo $t_coachingtahapan_grid->tglpelak5->headerCellClass() ?>"><div><div id="elh_t_coachingtahapan_tglpelak5" class="t_coachingtahapan_tglpelak5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->tglpelak5->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_grid->tglpelak5->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_grid->tglpelak5->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_grid->targetpes5->Visible) { // targetpes5 ?>
	<?php if ($t_coachingtahapan_grid->SortUrl($t_coachingtahapan_grid->targetpes5) == "") { ?>
		<th data-name="targetpes5" class="<?php echo $t_coachingtahapan_grid->targetpes5->headerCellClass() ?>"><div id="elh_t_coachingtahapan_targetpes5" class="t_coachingtahapan_targetpes5"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->targetpes5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes5" class="<?php echo $t_coachingtahapan_grid->targetpes5->headerCellClass() ?>"><div><div id="elh_t_coachingtahapan_targetpes5" class="t_coachingtahapan_targetpes5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->targetpes5->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_grid->targetpes5->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_grid->targetpes5->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_grid->tglpelak6->Visible) { // tglpelak6 ?>
	<?php if ($t_coachingtahapan_grid->SortUrl($t_coachingtahapan_grid->tglpelak6) == "") { ?>
		<th data-name="tglpelak6" class="<?php echo $t_coachingtahapan_grid->tglpelak6->headerCellClass() ?>"><div id="elh_t_coachingtahapan_tglpelak6" class="t_coachingtahapan_tglpelak6"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->tglpelak6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tglpelak6" class="<?php echo $t_coachingtahapan_grid->tglpelak6->headerCellClass() ?>"><div><div id="elh_t_coachingtahapan_tglpelak6" class="t_coachingtahapan_tglpelak6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->tglpelak6->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_grid->tglpelak6->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_grid->tglpelak6->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_grid->targetpes6->Visible) { // targetpes6 ?>
	<?php if ($t_coachingtahapan_grid->SortUrl($t_coachingtahapan_grid->targetpes6) == "") { ?>
		<th data-name="targetpes6" class="<?php echo $t_coachingtahapan_grid->targetpes6->headerCellClass() ?>"><div id="elh_t_coachingtahapan_targetpes6" class="t_coachingtahapan_targetpes6"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->targetpes6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes6" class="<?php echo $t_coachingtahapan_grid->targetpes6->headerCellClass() ?>"><div><div id="elh_t_coachingtahapan_targetpes6" class="t_coachingtahapan_targetpes6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->targetpes6->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_grid->targetpes6->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_grid->targetpes6->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_grid->tglpelak7->Visible) { // tglpelak7 ?>
	<?php if ($t_coachingtahapan_grid->SortUrl($t_coachingtahapan_grid->tglpelak7) == "") { ?>
		<th data-name="tglpelak7" class="<?php echo $t_coachingtahapan_grid->tglpelak7->headerCellClass() ?>"><div id="elh_t_coachingtahapan_tglpelak7" class="t_coachingtahapan_tglpelak7"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->tglpelak7->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tglpelak7" class="<?php echo $t_coachingtahapan_grid->tglpelak7->headerCellClass() ?>"><div><div id="elh_t_coachingtahapan_tglpelak7" class="t_coachingtahapan_tglpelak7">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->tglpelak7->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_grid->tglpelak7->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_grid->tglpelak7->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_grid->targetpes7->Visible) { // targetpes7 ?>
	<?php if ($t_coachingtahapan_grid->SortUrl($t_coachingtahapan_grid->targetpes7) == "") { ?>
		<th data-name="targetpes7" class="<?php echo $t_coachingtahapan_grid->targetpes7->headerCellClass() ?>"><div id="elh_t_coachingtahapan_targetpes7" class="t_coachingtahapan_targetpes7"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->targetpes7->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes7" class="<?php echo $t_coachingtahapan_grid->targetpes7->headerCellClass() ?>"><div><div id="elh_t_coachingtahapan_targetpes7" class="t_coachingtahapan_targetpes7">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->targetpes7->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_grid->targetpes7->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_grid->targetpes7->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_grid->tglpelak8->Visible) { // tglpelak8 ?>
	<?php if ($t_coachingtahapan_grid->SortUrl($t_coachingtahapan_grid->tglpelak8) == "") { ?>
		<th data-name="tglpelak8" class="<?php echo $t_coachingtahapan_grid->tglpelak8->headerCellClass() ?>"><div id="elh_t_coachingtahapan_tglpelak8" class="t_coachingtahapan_tglpelak8"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->tglpelak8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tglpelak8" class="<?php echo $t_coachingtahapan_grid->tglpelak8->headerCellClass() ?>"><div><div id="elh_t_coachingtahapan_tglpelak8" class="t_coachingtahapan_tglpelak8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->tglpelak8->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_grid->tglpelak8->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_grid->tglpelak8->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_grid->targetpes8->Visible) { // targetpes8 ?>
	<?php if ($t_coachingtahapan_grid->SortUrl($t_coachingtahapan_grid->targetpes8) == "") { ?>
		<th data-name="targetpes8" class="<?php echo $t_coachingtahapan_grid->targetpes8->headerCellClass() ?>"><div id="elh_t_coachingtahapan_targetpes8" class="t_coachingtahapan_targetpes8"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->targetpes8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes8" class="<?php echo $t_coachingtahapan_grid->targetpes8->headerCellClass() ?>"><div><div id="elh_t_coachingtahapan_targetpes8" class="t_coachingtahapan_targetpes8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_grid->targetpes8->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_grid->targetpes8->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_grid->targetpes8->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_coachingtahapan_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_coachingtahapan_grid->StartRecord = 1;
$t_coachingtahapan_grid->StopRecord = $t_coachingtahapan_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($t_coachingtahapan->isConfirm() || $t_coachingtahapan_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_coachingtahapan_grid->FormKeyCountName) && ($t_coachingtahapan_grid->isGridAdd() || $t_coachingtahapan_grid->isGridEdit() || $t_coachingtahapan->isConfirm())) {
		$t_coachingtahapan_grid->KeyCount = $CurrentForm->getValue($t_coachingtahapan_grid->FormKeyCountName);
		$t_coachingtahapan_grid->StopRecord = $t_coachingtahapan_grid->StartRecord + $t_coachingtahapan_grid->KeyCount - 1;
	}
}
$t_coachingtahapan_grid->RecordCount = $t_coachingtahapan_grid->StartRecord - 1;
if ($t_coachingtahapan_grid->Recordset && !$t_coachingtahapan_grid->Recordset->EOF) {
	$t_coachingtahapan_grid->Recordset->moveFirst();
	$selectLimit = $t_coachingtahapan_grid->UseSelectLimit;
	if (!$selectLimit && $t_coachingtahapan_grid->StartRecord > 1)
		$t_coachingtahapan_grid->Recordset->move($t_coachingtahapan_grid->StartRecord - 1);
} elseif (!$t_coachingtahapan->AllowAddDeleteRow && $t_coachingtahapan_grid->StopRecord == 0) {
	$t_coachingtahapan_grid->StopRecord = $t_coachingtahapan->GridAddRowCount;
}

// Initialize aggregate
$t_coachingtahapan->RowType = ROWTYPE_AGGREGATEINIT;
$t_coachingtahapan->resetAttributes();
$t_coachingtahapan_grid->renderRow();
if ($t_coachingtahapan_grid->isGridAdd())
	$t_coachingtahapan_grid->RowIndex = 0;
if ($t_coachingtahapan_grid->isGridEdit())
	$t_coachingtahapan_grid->RowIndex = 0;
while ($t_coachingtahapan_grid->RecordCount < $t_coachingtahapan_grid->StopRecord) {
	$t_coachingtahapan_grid->RecordCount++;
	if ($t_coachingtahapan_grid->RecordCount >= $t_coachingtahapan_grid->StartRecord) {
		$t_coachingtahapan_grid->RowCount++;
		if ($t_coachingtahapan_grid->isGridAdd() || $t_coachingtahapan_grid->isGridEdit() || $t_coachingtahapan->isConfirm()) {
			$t_coachingtahapan_grid->RowIndex++;
			$CurrentForm->Index = $t_coachingtahapan_grid->RowIndex;
			if ($CurrentForm->hasValue($t_coachingtahapan_grid->FormActionName) && ($t_coachingtahapan->isConfirm() || $t_coachingtahapan_grid->EventCancelled))
				$t_coachingtahapan_grid->RowAction = strval($CurrentForm->getValue($t_coachingtahapan_grid->FormActionName));
			elseif ($t_coachingtahapan_grid->isGridAdd())
				$t_coachingtahapan_grid->RowAction = "insert";
			else
				$t_coachingtahapan_grid->RowAction = "";
		}

		// Set up key count
		$t_coachingtahapan_grid->KeyCount = $t_coachingtahapan_grid->RowIndex;

		// Init row class and style
		$t_coachingtahapan->resetAttributes();
		$t_coachingtahapan->CssClass = "";
		if ($t_coachingtahapan_grid->isGridAdd()) {
			if ($t_coachingtahapan->CurrentMode == "copy") {
				$t_coachingtahapan_grid->loadRowValues($t_coachingtahapan_grid->Recordset); // Load row values
				$t_coachingtahapan_grid->setRecordKey($t_coachingtahapan_grid->RowOldKey, $t_coachingtahapan_grid->Recordset); // Set old record key
			} else {
				$t_coachingtahapan_grid->loadRowValues(); // Load default values
				$t_coachingtahapan_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_coachingtahapan_grid->loadRowValues($t_coachingtahapan_grid->Recordset); // Load row values
		}
		$t_coachingtahapan->RowType = ROWTYPE_VIEW; // Render view
		if ($t_coachingtahapan_grid->isGridAdd()) // Grid add
			$t_coachingtahapan->RowType = ROWTYPE_ADD; // Render add
		if ($t_coachingtahapan_grid->isGridAdd() && $t_coachingtahapan->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_coachingtahapan_grid->restoreCurrentRowFormValues($t_coachingtahapan_grid->RowIndex); // Restore form values
		if ($t_coachingtahapan_grid->isGridEdit()) { // Grid edit
			if ($t_coachingtahapan->EventCancelled)
				$t_coachingtahapan_grid->restoreCurrentRowFormValues($t_coachingtahapan_grid->RowIndex); // Restore form values
			if ($t_coachingtahapan_grid->RowAction == "insert")
				$t_coachingtahapan->RowType = ROWTYPE_ADD; // Render add
			else
				$t_coachingtahapan->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_coachingtahapan_grid->isGridEdit() && ($t_coachingtahapan->RowType == ROWTYPE_EDIT || $t_coachingtahapan->RowType == ROWTYPE_ADD) && $t_coachingtahapan->EventCancelled) // Update failed
			$t_coachingtahapan_grid->restoreCurrentRowFormValues($t_coachingtahapan_grid->RowIndex); // Restore form values
		if ($t_coachingtahapan->RowType == ROWTYPE_EDIT) // Edit row
			$t_coachingtahapan_grid->EditRowCount++;
		if ($t_coachingtahapan->isConfirm()) // Confirm row
			$t_coachingtahapan_grid->restoreCurrentRowFormValues($t_coachingtahapan_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_coachingtahapan->RowAttrs->merge(["data-rowindex" => $t_coachingtahapan_grid->RowCount, "id" => "r" . $t_coachingtahapan_grid->RowCount . "_t_coachingtahapan", "data-rowtype" => $t_coachingtahapan->RowType]);

		// Render row
		$t_coachingtahapan_grid->renderRow();

		// Render list options
		$t_coachingtahapan_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_coachingtahapan_grid->RowAction != "delete" && $t_coachingtahapan_grid->RowAction != "insertdelete" && !($t_coachingtahapan_grid->RowAction == "insert" && $t_coachingtahapan->isConfirm() && $t_coachingtahapan_grid->emptyRow())) {
?>
	<tr <?php echo $t_coachingtahapan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_coachingtahapan_grid->ListOptions->render("body", "left", $t_coachingtahapan_grid->RowCount);
?>
	<?php if ($t_coachingtahapan_grid->area->Visible) { // area ?>
		<td data-name="area" <?php echo $t_coachingtahapan_grid->area->cellAttributes() ?>>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($t_coachingtahapan_grid->area->getSessionValue() != "") { ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_area" class="form-group">
<span<?php echo $t_coachingtahapan_grid->area->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->area->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" value="<?php echo HtmlEncode($t_coachingtahapan_grid->area->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_area" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coachingtahapan" data-field="x_area" data-value-separator="<?php echo $t_coachingtahapan_grid->area->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_area"<?php echo $t_coachingtahapan_grid->area->editAttributes() ?>>
			<?php echo $t_coachingtahapan_grid->area->selectOptionListHtml("x{$t_coachingtahapan_grid->RowIndex}_area") ?>
		</select>
</div>
<?php echo $t_coachingtahapan_grid->area->Lookup->getParamTag($t_coachingtahapan_grid, "p_x" . $t_coachingtahapan_grid->RowIndex . "_area") ?>
</span>
<?php } ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_area" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" value="<?php echo HtmlEncode($t_coachingtahapan_grid->area->OldValue) ?>">
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t_coachingtahapan_grid->area->getSessionValue() != "") { ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_area" class="form-group">
<span<?php echo $t_coachingtahapan_grid->area->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->area->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" value="<?php echo HtmlEncode($t_coachingtahapan_grid->area->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_area" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coachingtahapan" data-field="x_area" data-value-separator="<?php echo $t_coachingtahapan_grid->area->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_area"<?php echo $t_coachingtahapan_grid->area->editAttributes() ?>>
			<?php echo $t_coachingtahapan_grid->area->selectOptionListHtml("x{$t_coachingtahapan_grid->RowIndex}_area") ?>
		</select>
</div>
<?php echo $t_coachingtahapan_grid->area->Lookup->getParamTag($t_coachingtahapan_grid, "p_x" . $t_coachingtahapan_grid->RowIndex . "_area") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_area">
<span<?php echo $t_coachingtahapan_grid->area->viewAttributes() ?>><?php echo $t_coachingtahapan_grid->area->getViewValue() ?></span>
</span>
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_area" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" value="<?php echo HtmlEncode($t_coachingtahapan_grid->area->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_area" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" value="<?php echo HtmlEncode($t_coachingtahapan_grid->area->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_area" name="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" id="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" value="<?php echo HtmlEncode($t_coachingtahapan_grid->area->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_area" name="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" id="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" value="<?php echo HtmlEncode($t_coachingtahapan_grid->area->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_ctid" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_ctid" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_ctid" value="<?php echo HtmlEncode($t_coachingtahapan_grid->ctid->CurrentValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_ctid" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_ctid" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_ctid" value="<?php echo HtmlEncode($t_coachingtahapan_grid->ctid->OldValue) ?>">
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_EDIT || $t_coachingtahapan->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_ctid" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_ctid" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_ctid" value="<?php echo HtmlEncode($t_coachingtahapan_grid->ctid->CurrentValue) ?>">
<?php } ?>
	<?php if ($t_coachingtahapan_grid->jenispel->Visible) { // jenispel ?>
		<td data-name="jenispel" <?php echo $t_coachingtahapan_grid->jenispel->cellAttributes() ?>>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_jenispel" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coachingtahapan" data-field="x_jenispel" data-value-separator="<?php echo $t_coachingtahapan_grid->jenispel->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_jenispel" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_jenispel"<?php echo $t_coachingtahapan_grid->jenispel->editAttributes() ?>>
			<?php echo $t_coachingtahapan_grid->jenispel->selectOptionListHtml("x{$t_coachingtahapan_grid->RowIndex}_jenispel") ?>
		</select>
</div>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_jenispel" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_jenispel" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_jenispel" value="<?php echo HtmlEncode($t_coachingtahapan_grid->jenispel->OldValue) ?>">
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_jenispel" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coachingtahapan" data-field="x_jenispel" data-value-separator="<?php echo $t_coachingtahapan_grid->jenispel->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_jenispel" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_jenispel"<?php echo $t_coachingtahapan_grid->jenispel->editAttributes() ?>>
			<?php echo $t_coachingtahapan_grid->jenispel->selectOptionListHtml("x{$t_coachingtahapan_grid->RowIndex}_jenispel") ?>
		</select>
</div>
</span>
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_jenispel">
<span<?php echo $t_coachingtahapan_grid->jenispel->viewAttributes() ?>><?php echo $t_coachingtahapan_grid->jenispel->getViewValue() ?></span>
</span>
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_jenispel" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_jenispel" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_jenispel" value="<?php echo HtmlEncode($t_coachingtahapan_grid->jenispel->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_jenispel" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_jenispel" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_jenispel" value="<?php echo HtmlEncode($t_coachingtahapan_grid->jenispel->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_jenispel" name="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_jenispel" id="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_jenispel" value="<?php echo HtmlEncode($t_coachingtahapan_grid->jenispel->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_jenispel" name="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_jenispel" id="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_jenispel" value="<?php echo HtmlEncode($t_coachingtahapan_grid->jenispel->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->kdkategori->Visible) { // kdkategori ?>
		<td data-name="kdkategori" <?php echo $t_coachingtahapan_grid->kdkategori->cellAttributes() ?>>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_kdkategori" class="form-group">
<?php $t_coachingtahapan_grid->kdkategori->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coachingtahapan" data-field="x_kdkategori" data-value-separator="<?php echo $t_coachingtahapan_grid->kdkategori->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kdkategori" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kdkategori"<?php echo $t_coachingtahapan_grid->kdkategori->editAttributes() ?>>
			<?php echo $t_coachingtahapan_grid->kdkategori->selectOptionListHtml("x{$t_coachingtahapan_grid->RowIndex}_kdkategori") ?>
		</select>
</div>
<?php echo $t_coachingtahapan_grid->kdkategori->Lookup->getParamTag($t_coachingtahapan_grid, "p_x" . $t_coachingtahapan_grid->RowIndex . "_kdkategori") ?>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_kdkategori" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_kdkategori" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_kdkategori" value="<?php echo HtmlEncode($t_coachingtahapan_grid->kdkategori->OldValue) ?>">
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_kdkategori" class="form-group">
<?php $t_coachingtahapan_grid->kdkategori->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coachingtahapan" data-field="x_kdkategori" data-value-separator="<?php echo $t_coachingtahapan_grid->kdkategori->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kdkategori" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kdkategori"<?php echo $t_coachingtahapan_grid->kdkategori->editAttributes() ?>>
			<?php echo $t_coachingtahapan_grid->kdkategori->selectOptionListHtml("x{$t_coachingtahapan_grid->RowIndex}_kdkategori") ?>
		</select>
</div>
<?php echo $t_coachingtahapan_grid->kdkategori->Lookup->getParamTag($t_coachingtahapan_grid, "p_x" . $t_coachingtahapan_grid->RowIndex . "_kdkategori") ?>
</span>
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_kdkategori">
<span<?php echo $t_coachingtahapan_grid->kdkategori->viewAttributes() ?>><?php echo $t_coachingtahapan_grid->kdkategori->getViewValue() ?></span>
</span>
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_kdkategori" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kdkategori" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kdkategori" value="<?php echo HtmlEncode($t_coachingtahapan_grid->kdkategori->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_kdkategori" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_kdkategori" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_kdkategori" value="<?php echo HtmlEncode($t_coachingtahapan_grid->kdkategori->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_kdkategori" name="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kdkategori" id="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kdkategori" value="<?php echo HtmlEncode($t_coachingtahapan_grid->kdkategori->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_kdkategori" name="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_kdkategori" id="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_kdkategori" value="<?php echo HtmlEncode($t_coachingtahapan_grid->kdkategori->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->kerjasama->Visible) { // kerjasama ?>
		<td data-name="kerjasama" <?php echo $t_coachingtahapan_grid->kerjasama->cellAttributes() ?>>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_kerjasama" class="form-group">
<?php
$onchange = $t_coachingtahapan_grid->kerjasama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_coachingtahapan_grid->kerjasama->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama">
	<input type="text" class="form-control" name="sv_x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" id="sv_x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" value="<?php echo RemoveHtml($t_coachingtahapan_grid->kerjasama->EditValue) ?>" size="100" maxlength="11" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->kerjasama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->kerjasama->getPlaceHolder()) ?>"<?php echo $t_coachingtahapan_grid->kerjasama->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_kerjasama" data-value-separator="<?php echo $t_coachingtahapan_grid->kerjasama->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" value="<?php echo HtmlEncode($t_coachingtahapan_grid->kerjasama->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_coachingtahapangrid"], function() {
	ft_coachingtahapangrid.createAutoSuggest({"id":"x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_coachingtahapan_grid->kerjasama->Lookup->getParamTag($t_coachingtahapan_grid, "p_x" . $t_coachingtahapan_grid->RowIndex . "_kerjasama") ?>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_kerjasama" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" value="<?php echo HtmlEncode($t_coachingtahapan_grid->kerjasama->OldValue) ?>">
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_kerjasama" class="form-group">
<?php
$onchange = $t_coachingtahapan_grid->kerjasama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_coachingtahapan_grid->kerjasama->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama">
	<input type="text" class="form-control" name="sv_x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" id="sv_x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" value="<?php echo RemoveHtml($t_coachingtahapan_grid->kerjasama->EditValue) ?>" size="100" maxlength="11" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->kerjasama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->kerjasama->getPlaceHolder()) ?>"<?php echo $t_coachingtahapan_grid->kerjasama->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_kerjasama" data-value-separator="<?php echo $t_coachingtahapan_grid->kerjasama->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" value="<?php echo HtmlEncode($t_coachingtahapan_grid->kerjasama->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_coachingtahapangrid"], function() {
	ft_coachingtahapangrid.createAutoSuggest({"id":"x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_coachingtahapan_grid->kerjasama->Lookup->getParamTag($t_coachingtahapan_grid, "p_x" . $t_coachingtahapan_grid->RowIndex . "_kerjasama") ?>
</span>
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_kerjasama">
<span<?php echo $t_coachingtahapan_grid->kerjasama->viewAttributes() ?>><?php echo $t_coachingtahapan_grid->kerjasama->getViewValue() ?></span>
</span>
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_kerjasama" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" value="<?php echo HtmlEncode($t_coachingtahapan_grid->kerjasama->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_kerjasama" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" value="<?php echo HtmlEncode($t_coachingtahapan_grid->kerjasama->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_kerjasama" name="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" id="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" value="<?php echo HtmlEncode($t_coachingtahapan_grid->kerjasama->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_kerjasama" name="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" id="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" value="<?php echo HtmlEncode($t_coachingtahapan_grid->kerjasama->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->tglpelak1->Visible) { // tglpelak1 ?>
		<td data-name="tglpelak1" <?php echo $t_coachingtahapan_grid->tglpelak1->cellAttributes() ?>>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak1" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak1" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak1" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak1" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak1->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak1->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak1->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak1" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak1" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak1" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak1->OldValue) ?>">
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak1" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak1" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak1" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak1" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak1->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak1->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak1->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak1">
<span<?php echo $t_coachingtahapan_grid->tglpelak1->viewAttributes() ?>><?php echo $t_coachingtahapan_grid->tglpelak1->getViewValue() ?></span>
</span>
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak1" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak1" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak1" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak1->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak1" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak1" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak1" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak1->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak1" name="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak1" id="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak1" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak1->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak1" name="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak1" id="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak1" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak1->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->targetpes1->Visible) { // targetpes1 ?>
		<td data-name="targetpes1" <?php echo $t_coachingtahapan_grid->targetpes1->cellAttributes() ?>>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes1" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes1" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes1" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes1" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes1->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes1->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes1->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes1" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes1" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes1" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes1->OldValue) ?>">
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes1" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes1" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes1" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes1" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes1->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes1->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes1->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes1">
<span<?php echo $t_coachingtahapan_grid->targetpes1->viewAttributes() ?>><?php echo $t_coachingtahapan_grid->targetpes1->getViewValue() ?></span>
</span>
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes1" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes1" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes1" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes1->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes1" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes1" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes1" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes1->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes1" name="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes1" id="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes1" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes1->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes1" name="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes1" id="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes1" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes1->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->tglpelak2->Visible) { // tglpelak2 ?>
		<td data-name="tglpelak2" <?php echo $t_coachingtahapan_grid->tglpelak2->cellAttributes() ?>>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak2" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak2" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak2" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak2" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak2->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak2->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak2->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak2" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak2" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak2" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak2->OldValue) ?>">
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak2" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak2" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak2" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak2" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak2->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak2->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak2->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak2">
<span<?php echo $t_coachingtahapan_grid->tglpelak2->viewAttributes() ?>><?php echo $t_coachingtahapan_grid->tglpelak2->getViewValue() ?></span>
</span>
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak2" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak2" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak2" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak2->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak2" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak2" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak2" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak2->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak2" name="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak2" id="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak2" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak2->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak2" name="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak2" id="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak2" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak2->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->targetpes2->Visible) { // targetpes2 ?>
		<td data-name="targetpes2" <?php echo $t_coachingtahapan_grid->targetpes2->cellAttributes() ?>>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes2" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes2" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes2" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes2" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes2->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes2->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes2->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes2" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes2" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes2" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes2->OldValue) ?>">
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes2" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes2" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes2" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes2" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes2->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes2->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes2->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes2">
<span<?php echo $t_coachingtahapan_grid->targetpes2->viewAttributes() ?>><?php echo $t_coachingtahapan_grid->targetpes2->getViewValue() ?></span>
</span>
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes2" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes2" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes2" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes2->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes2" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes2" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes2" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes2->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes2" name="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes2" id="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes2" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes2->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes2" name="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes2" id="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes2" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes2->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->tglpelak3->Visible) { // tglpelak3 ?>
		<td data-name="tglpelak3" <?php echo $t_coachingtahapan_grid->tglpelak3->cellAttributes() ?>>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak3" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak3" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak3" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak3" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak3->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak3->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak3->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak3" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak3" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak3" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak3->OldValue) ?>">
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak3" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak3" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak3" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak3" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak3->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak3->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak3->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak3">
<span<?php echo $t_coachingtahapan_grid->tglpelak3->viewAttributes() ?>><?php echo $t_coachingtahapan_grid->tglpelak3->getViewValue() ?></span>
</span>
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak3" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak3" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak3" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak3->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak3" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak3" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak3" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak3->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak3" name="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak3" id="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak3" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak3->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak3" name="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak3" id="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak3" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak3->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->targetpes3->Visible) { // targetpes3 ?>
		<td data-name="targetpes3" <?php echo $t_coachingtahapan_grid->targetpes3->cellAttributes() ?>>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes3" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes3" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes3" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes3" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes3->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes3->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes3->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes3" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes3" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes3" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes3->OldValue) ?>">
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes3" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes3" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes3" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes3" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes3->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes3->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes3->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes3">
<span<?php echo $t_coachingtahapan_grid->targetpes3->viewAttributes() ?>><?php echo $t_coachingtahapan_grid->targetpes3->getViewValue() ?></span>
</span>
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes3" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes3" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes3" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes3->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes3" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes3" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes3" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes3->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes3" name="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes3" id="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes3" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes3->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes3" name="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes3" id="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes3" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes3->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->tglpelak4->Visible) { // tglpelak4 ?>
		<td data-name="tglpelak4" <?php echo $t_coachingtahapan_grid->tglpelak4->cellAttributes() ?>>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak4" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak4" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak4" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak4" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak4->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak4->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak4->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak4" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak4" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak4" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak4->OldValue) ?>">
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak4" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak4" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak4" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak4" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak4->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak4->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak4->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak4">
<span<?php echo $t_coachingtahapan_grid->tglpelak4->viewAttributes() ?>><?php echo $t_coachingtahapan_grid->tglpelak4->getViewValue() ?></span>
</span>
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak4" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak4" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak4" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak4->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak4" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak4" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak4" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak4->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak4" name="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak4" id="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak4" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak4->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak4" name="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak4" id="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak4" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak4->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->targetpes4->Visible) { // targetpes4 ?>
		<td data-name="targetpes4" <?php echo $t_coachingtahapan_grid->targetpes4->cellAttributes() ?>>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes4" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes4" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes4" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes4" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes4->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes4->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes4->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes4" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes4" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes4" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes4->OldValue) ?>">
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes4" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes4" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes4" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes4" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes4->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes4->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes4->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes4">
<span<?php echo $t_coachingtahapan_grid->targetpes4->viewAttributes() ?>><?php echo $t_coachingtahapan_grid->targetpes4->getViewValue() ?></span>
</span>
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes4" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes4" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes4" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes4->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes4" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes4" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes4" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes4->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes4" name="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes4" id="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes4" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes4->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes4" name="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes4" id="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes4" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes4->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->tglpelak5->Visible) { // tglpelak5 ?>
		<td data-name="tglpelak5" <?php echo $t_coachingtahapan_grid->tglpelak5->cellAttributes() ?>>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak5" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak5" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak5" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak5" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak5->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak5->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak5->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak5" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak5" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak5" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak5->OldValue) ?>">
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak5" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak5" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak5" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak5" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak5->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak5->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak5->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak5">
<span<?php echo $t_coachingtahapan_grid->tglpelak5->viewAttributes() ?>><?php echo $t_coachingtahapan_grid->tglpelak5->getViewValue() ?></span>
</span>
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak5" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak5" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak5" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak5->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak5" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak5" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak5" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak5->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak5" name="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak5" id="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak5" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak5->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak5" name="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak5" id="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak5" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak5->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->targetpes5->Visible) { // targetpes5 ?>
		<td data-name="targetpes5" <?php echo $t_coachingtahapan_grid->targetpes5->cellAttributes() ?>>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes5" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes5" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes5" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes5" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes5->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes5->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes5->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes5" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes5" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes5" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes5->OldValue) ?>">
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes5" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes5" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes5" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes5" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes5->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes5->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes5->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes5">
<span<?php echo $t_coachingtahapan_grid->targetpes5->viewAttributes() ?>><?php echo $t_coachingtahapan_grid->targetpes5->getViewValue() ?></span>
</span>
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes5" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes5" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes5" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes5->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes5" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes5" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes5" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes5->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes5" name="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes5" id="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes5" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes5->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes5" name="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes5" id="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes5" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes5->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->tglpelak6->Visible) { // tglpelak6 ?>
		<td data-name="tglpelak6" <?php echo $t_coachingtahapan_grid->tglpelak6->cellAttributes() ?>>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak6" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak6" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak6" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak6" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak6->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak6->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak6->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak6" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak6" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak6" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak6->OldValue) ?>">
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak6" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak6" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak6" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak6" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak6->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak6->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak6->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak6">
<span<?php echo $t_coachingtahapan_grid->tglpelak6->viewAttributes() ?>><?php echo $t_coachingtahapan_grid->tglpelak6->getViewValue() ?></span>
</span>
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak6" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak6" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak6" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak6->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak6" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak6" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak6" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak6->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak6" name="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak6" id="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak6" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak6->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak6" name="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak6" id="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak6" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak6->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->targetpes6->Visible) { // targetpes6 ?>
		<td data-name="targetpes6" <?php echo $t_coachingtahapan_grid->targetpes6->cellAttributes() ?>>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes6" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes6" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes6" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes6" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes6->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes6->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes6->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes6" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes6" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes6" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes6->OldValue) ?>">
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes6" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes6" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes6" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes6" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes6->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes6->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes6->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes6">
<span<?php echo $t_coachingtahapan_grid->targetpes6->viewAttributes() ?>><?php echo $t_coachingtahapan_grid->targetpes6->getViewValue() ?></span>
</span>
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes6" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes6" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes6" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes6->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes6" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes6" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes6" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes6->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes6" name="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes6" id="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes6" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes6->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes6" name="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes6" id="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes6" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes6->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->tglpelak7->Visible) { // tglpelak7 ?>
		<td data-name="tglpelak7" <?php echo $t_coachingtahapan_grid->tglpelak7->cellAttributes() ?>>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak7" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak7" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak7" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak7" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak7->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak7->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak7->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak7" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak7" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak7" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak7->OldValue) ?>">
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak7" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak7" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak7" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak7" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak7->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak7->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak7->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak7">
<span<?php echo $t_coachingtahapan_grid->tglpelak7->viewAttributes() ?>><?php echo $t_coachingtahapan_grid->tglpelak7->getViewValue() ?></span>
</span>
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak7" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak7" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak7" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak7->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak7" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak7" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak7" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak7->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak7" name="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak7" id="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak7" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak7->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak7" name="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak7" id="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak7" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak7->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->targetpes7->Visible) { // targetpes7 ?>
		<td data-name="targetpes7" <?php echo $t_coachingtahapan_grid->targetpes7->cellAttributes() ?>>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes7" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes7" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes7" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes7" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes7->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes7->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes7->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes7" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes7" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes7" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes7->OldValue) ?>">
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes7" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes7" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes7" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes7" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes7->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes7->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes7->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes7">
<span<?php echo $t_coachingtahapan_grid->targetpes7->viewAttributes() ?>><?php echo $t_coachingtahapan_grid->targetpes7->getViewValue() ?></span>
</span>
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes7" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes7" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes7" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes7->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes7" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes7" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes7" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes7->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes7" name="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes7" id="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes7" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes7->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes7" name="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes7" id="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes7" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes7->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->tglpelak8->Visible) { // tglpelak8 ?>
		<td data-name="tglpelak8" <?php echo $t_coachingtahapan_grid->tglpelak8->cellAttributes() ?>>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak8" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak8" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak8" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak8" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak8->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak8->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak8->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak8" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak8" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak8" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak8->OldValue) ?>">
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak8" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak8" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak8" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak8" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak8->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak8->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak8->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_tglpelak8">
<span<?php echo $t_coachingtahapan_grid->tglpelak8->viewAttributes() ?>><?php echo $t_coachingtahapan_grid->tglpelak8->getViewValue() ?></span>
</span>
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak8" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak8" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak8" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak8->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak8" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak8" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak8" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak8->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak8" name="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak8" id="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak8" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak8->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak8" name="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak8" id="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak8" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak8->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->targetpes8->Visible) { // targetpes8 ?>
		<td data-name="targetpes8" <?php echo $t_coachingtahapan_grid->targetpes8->cellAttributes() ?>>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes8" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes8" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes8" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes8" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes8->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes8->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes8->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes8" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes8" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes8" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes8->OldValue) ?>">
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes8" class="form-group">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes8" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes8" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes8" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes8->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes8->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes8->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coachingtahapan_grid->RowCount ?>_t_coachingtahapan_targetpes8">
<span<?php echo $t_coachingtahapan_grid->targetpes8->viewAttributes() ?>><?php echo $t_coachingtahapan_grid->targetpes8->getViewValue() ?></span>
</span>
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes8" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes8" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes8" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes8->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes8" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes8" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes8" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes8->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes8" name="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes8" id="ft_coachingtahapangrid$x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes8" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes8->FormValue) ?>">
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes8" name="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes8" id="ft_coachingtahapangrid$o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes8" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes8->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_coachingtahapan_grid->ListOptions->render("body", "right", $t_coachingtahapan_grid->RowCount);
?>
	</tr>
<?php if ($t_coachingtahapan->RowType == ROWTYPE_ADD || $t_coachingtahapan->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_coachingtahapangrid", "load"], function() {
	ft_coachingtahapangrid.updateLists(<?php echo $t_coachingtahapan_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_coachingtahapan_grid->isGridAdd() || $t_coachingtahapan->CurrentMode == "copy")
		if (!$t_coachingtahapan_grid->Recordset->EOF)
			$t_coachingtahapan_grid->Recordset->moveNext();
}
?>
<?php
	if ($t_coachingtahapan->CurrentMode == "add" || $t_coachingtahapan->CurrentMode == "copy" || $t_coachingtahapan->CurrentMode == "edit") {
		$t_coachingtahapan_grid->RowIndex = '$rowindex$';
		$t_coachingtahapan_grid->loadRowValues();

		// Set row properties
		$t_coachingtahapan->resetAttributes();
		$t_coachingtahapan->RowAttrs->merge(["data-rowindex" => $t_coachingtahapan_grid->RowIndex, "id" => "r0_t_coachingtahapan", "data-rowtype" => ROWTYPE_ADD]);
		$t_coachingtahapan->RowAttrs->appendClass("ew-template");
		$t_coachingtahapan->RowType = ROWTYPE_ADD;

		// Render row
		$t_coachingtahapan_grid->renderRow();

		// Render list options
		$t_coachingtahapan_grid->renderListOptions();
		$t_coachingtahapan_grid->StartRowCount = 0;
?>
	<tr <?php echo $t_coachingtahapan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_coachingtahapan_grid->ListOptions->render("body", "left", $t_coachingtahapan_grid->RowIndex);
?>
	<?php if ($t_coachingtahapan_grid->area->Visible) { // area ?>
		<td data-name="area">
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<?php if ($t_coachingtahapan_grid->area->getSessionValue() != "") { ?>
<span id="el$rowindex$_t_coachingtahapan_area" class="form-group t_coachingtahapan_area">
<span<?php echo $t_coachingtahapan_grid->area->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->area->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" value="<?php echo HtmlEncode($t_coachingtahapan_grid->area->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_coachingtahapan_area" class="form-group t_coachingtahapan_area">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coachingtahapan" data-field="x_area" data-value-separator="<?php echo $t_coachingtahapan_grid->area->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_area"<?php echo $t_coachingtahapan_grid->area->editAttributes() ?>>
			<?php echo $t_coachingtahapan_grid->area->selectOptionListHtml("x{$t_coachingtahapan_grid->RowIndex}_area") ?>
		</select>
</div>
<?php echo $t_coachingtahapan_grid->area->Lookup->getParamTag($t_coachingtahapan_grid, "p_x" . $t_coachingtahapan_grid->RowIndex . "_area") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t_coachingtahapan_area" class="form-group t_coachingtahapan_area">
<span<?php echo $t_coachingtahapan_grid->area->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->area->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_area" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" value="<?php echo HtmlEncode($t_coachingtahapan_grid->area->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_area" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_area" value="<?php echo HtmlEncode($t_coachingtahapan_grid->area->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->jenispel->Visible) { // jenispel ?>
		<td data-name="jenispel">
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<span id="el$rowindex$_t_coachingtahapan_jenispel" class="form-group t_coachingtahapan_jenispel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coachingtahapan" data-field="x_jenispel" data-value-separator="<?php echo $t_coachingtahapan_grid->jenispel->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_jenispel" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_jenispel"<?php echo $t_coachingtahapan_grid->jenispel->editAttributes() ?>>
			<?php echo $t_coachingtahapan_grid->jenispel->selectOptionListHtml("x{$t_coachingtahapan_grid->RowIndex}_jenispel") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coachingtahapan_jenispel" class="form-group t_coachingtahapan_jenispel">
<span<?php echo $t_coachingtahapan_grid->jenispel->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->jenispel->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_jenispel" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_jenispel" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_jenispel" value="<?php echo HtmlEncode($t_coachingtahapan_grid->jenispel->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_jenispel" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_jenispel" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_jenispel" value="<?php echo HtmlEncode($t_coachingtahapan_grid->jenispel->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->kdkategori->Visible) { // kdkategori ?>
		<td data-name="kdkategori">
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<span id="el$rowindex$_t_coachingtahapan_kdkategori" class="form-group t_coachingtahapan_kdkategori">
<?php $t_coachingtahapan_grid->kdkategori->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coachingtahapan" data-field="x_kdkategori" data-value-separator="<?php echo $t_coachingtahapan_grid->kdkategori->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kdkategori" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kdkategori"<?php echo $t_coachingtahapan_grid->kdkategori->editAttributes() ?>>
			<?php echo $t_coachingtahapan_grid->kdkategori->selectOptionListHtml("x{$t_coachingtahapan_grid->RowIndex}_kdkategori") ?>
		</select>
</div>
<?php echo $t_coachingtahapan_grid->kdkategori->Lookup->getParamTag($t_coachingtahapan_grid, "p_x" . $t_coachingtahapan_grid->RowIndex . "_kdkategori") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coachingtahapan_kdkategori" class="form-group t_coachingtahapan_kdkategori">
<span<?php echo $t_coachingtahapan_grid->kdkategori->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->kdkategori->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_kdkategori" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kdkategori" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kdkategori" value="<?php echo HtmlEncode($t_coachingtahapan_grid->kdkategori->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_kdkategori" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_kdkategori" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_kdkategori" value="<?php echo HtmlEncode($t_coachingtahapan_grid->kdkategori->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->kerjasama->Visible) { // kerjasama ?>
		<td data-name="kerjasama">
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<span id="el$rowindex$_t_coachingtahapan_kerjasama" class="form-group t_coachingtahapan_kerjasama">
<?php
$onchange = $t_coachingtahapan_grid->kerjasama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_coachingtahapan_grid->kerjasama->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama">
	<input type="text" class="form-control" name="sv_x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" id="sv_x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" value="<?php echo RemoveHtml($t_coachingtahapan_grid->kerjasama->EditValue) ?>" size="100" maxlength="11" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->kerjasama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->kerjasama->getPlaceHolder()) ?>"<?php echo $t_coachingtahapan_grid->kerjasama->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_kerjasama" data-value-separator="<?php echo $t_coachingtahapan_grid->kerjasama->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" value="<?php echo HtmlEncode($t_coachingtahapan_grid->kerjasama->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_coachingtahapangrid"], function() {
	ft_coachingtahapangrid.createAutoSuggest({"id":"x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_coachingtahapan_grid->kerjasama->Lookup->getParamTag($t_coachingtahapan_grid, "p_x" . $t_coachingtahapan_grid->RowIndex . "_kerjasama") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coachingtahapan_kerjasama" class="form-group t_coachingtahapan_kerjasama">
<span<?php echo $t_coachingtahapan_grid->kerjasama->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->kerjasama->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_kerjasama" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" value="<?php echo HtmlEncode($t_coachingtahapan_grid->kerjasama->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_kerjasama" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_kerjasama" value="<?php echo HtmlEncode($t_coachingtahapan_grid->kerjasama->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->tglpelak1->Visible) { // tglpelak1 ?>
		<td data-name="tglpelak1">
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<span id="el$rowindex$_t_coachingtahapan_tglpelak1" class="form-group t_coachingtahapan_tglpelak1">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak1" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak1" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak1" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak1->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak1->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak1->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coachingtahapan_tglpelak1" class="form-group t_coachingtahapan_tglpelak1">
<span<?php echo $t_coachingtahapan_grid->tglpelak1->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->tglpelak1->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak1" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak1" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak1" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak1->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak1" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak1" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak1" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak1->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->targetpes1->Visible) { // targetpes1 ?>
		<td data-name="targetpes1">
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<span id="el$rowindex$_t_coachingtahapan_targetpes1" class="form-group t_coachingtahapan_targetpes1">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes1" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes1" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes1" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes1->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes1->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes1->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coachingtahapan_targetpes1" class="form-group t_coachingtahapan_targetpes1">
<span<?php echo $t_coachingtahapan_grid->targetpes1->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->targetpes1->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes1" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes1" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes1" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes1->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes1" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes1" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes1" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes1->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->tglpelak2->Visible) { // tglpelak2 ?>
		<td data-name="tglpelak2">
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<span id="el$rowindex$_t_coachingtahapan_tglpelak2" class="form-group t_coachingtahapan_tglpelak2">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak2" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak2" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak2" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak2->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak2->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak2->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coachingtahapan_tglpelak2" class="form-group t_coachingtahapan_tglpelak2">
<span<?php echo $t_coachingtahapan_grid->tglpelak2->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->tglpelak2->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak2" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak2" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak2" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak2->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak2" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak2" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak2" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak2->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->targetpes2->Visible) { // targetpes2 ?>
		<td data-name="targetpes2">
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<span id="el$rowindex$_t_coachingtahapan_targetpes2" class="form-group t_coachingtahapan_targetpes2">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes2" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes2" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes2" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes2->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes2->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes2->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coachingtahapan_targetpes2" class="form-group t_coachingtahapan_targetpes2">
<span<?php echo $t_coachingtahapan_grid->targetpes2->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->targetpes2->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes2" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes2" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes2" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes2->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes2" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes2" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes2" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes2->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->tglpelak3->Visible) { // tglpelak3 ?>
		<td data-name="tglpelak3">
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<span id="el$rowindex$_t_coachingtahapan_tglpelak3" class="form-group t_coachingtahapan_tglpelak3">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak3" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak3" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak3" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak3->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak3->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak3->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coachingtahapan_tglpelak3" class="form-group t_coachingtahapan_tglpelak3">
<span<?php echo $t_coachingtahapan_grid->tglpelak3->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->tglpelak3->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak3" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak3" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak3" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak3->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak3" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak3" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak3" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak3->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->targetpes3->Visible) { // targetpes3 ?>
		<td data-name="targetpes3">
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<span id="el$rowindex$_t_coachingtahapan_targetpes3" class="form-group t_coachingtahapan_targetpes3">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes3" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes3" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes3" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes3->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes3->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes3->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coachingtahapan_targetpes3" class="form-group t_coachingtahapan_targetpes3">
<span<?php echo $t_coachingtahapan_grid->targetpes3->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->targetpes3->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes3" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes3" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes3" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes3->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes3" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes3" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes3" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes3->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->tglpelak4->Visible) { // tglpelak4 ?>
		<td data-name="tglpelak4">
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<span id="el$rowindex$_t_coachingtahapan_tglpelak4" class="form-group t_coachingtahapan_tglpelak4">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak4" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak4" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak4" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak4->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak4->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak4->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coachingtahapan_tglpelak4" class="form-group t_coachingtahapan_tglpelak4">
<span<?php echo $t_coachingtahapan_grid->tglpelak4->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->tglpelak4->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak4" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak4" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak4" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak4->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak4" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak4" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak4" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak4->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->targetpes4->Visible) { // targetpes4 ?>
		<td data-name="targetpes4">
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<span id="el$rowindex$_t_coachingtahapan_targetpes4" class="form-group t_coachingtahapan_targetpes4">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes4" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes4" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes4" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes4->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes4->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes4->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coachingtahapan_targetpes4" class="form-group t_coachingtahapan_targetpes4">
<span<?php echo $t_coachingtahapan_grid->targetpes4->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->targetpes4->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes4" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes4" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes4" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes4->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes4" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes4" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes4" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes4->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->tglpelak5->Visible) { // tglpelak5 ?>
		<td data-name="tglpelak5">
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<span id="el$rowindex$_t_coachingtahapan_tglpelak5" class="form-group t_coachingtahapan_tglpelak5">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak5" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak5" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak5" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak5->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak5->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak5->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coachingtahapan_tglpelak5" class="form-group t_coachingtahapan_tglpelak5">
<span<?php echo $t_coachingtahapan_grid->tglpelak5->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->tglpelak5->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak5" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak5" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak5" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak5->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak5" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak5" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak5" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak5->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->targetpes5->Visible) { // targetpes5 ?>
		<td data-name="targetpes5">
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<span id="el$rowindex$_t_coachingtahapan_targetpes5" class="form-group t_coachingtahapan_targetpes5">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes5" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes5" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes5" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes5->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes5->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes5->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coachingtahapan_targetpes5" class="form-group t_coachingtahapan_targetpes5">
<span<?php echo $t_coachingtahapan_grid->targetpes5->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->targetpes5->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes5" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes5" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes5" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes5->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes5" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes5" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes5" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes5->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->tglpelak6->Visible) { // tglpelak6 ?>
		<td data-name="tglpelak6">
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<span id="el$rowindex$_t_coachingtahapan_tglpelak6" class="form-group t_coachingtahapan_tglpelak6">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak6" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak6" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak6" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak6->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak6->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak6->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coachingtahapan_tglpelak6" class="form-group t_coachingtahapan_tglpelak6">
<span<?php echo $t_coachingtahapan_grid->tglpelak6->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->tglpelak6->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak6" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak6" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak6" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak6->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak6" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak6" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak6" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak6->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->targetpes6->Visible) { // targetpes6 ?>
		<td data-name="targetpes6">
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<span id="el$rowindex$_t_coachingtahapan_targetpes6" class="form-group t_coachingtahapan_targetpes6">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes6" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes6" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes6" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes6->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes6->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes6->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coachingtahapan_targetpes6" class="form-group t_coachingtahapan_targetpes6">
<span<?php echo $t_coachingtahapan_grid->targetpes6->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->targetpes6->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes6" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes6" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes6" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes6->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes6" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes6" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes6" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes6->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->tglpelak7->Visible) { // tglpelak7 ?>
		<td data-name="tglpelak7">
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<span id="el$rowindex$_t_coachingtahapan_tglpelak7" class="form-group t_coachingtahapan_tglpelak7">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak7" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak7" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak7" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak7->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak7->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak7->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coachingtahapan_tglpelak7" class="form-group t_coachingtahapan_tglpelak7">
<span<?php echo $t_coachingtahapan_grid->tglpelak7->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->tglpelak7->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak7" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak7" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak7" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak7->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak7" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak7" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak7" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak7->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->targetpes7->Visible) { // targetpes7 ?>
		<td data-name="targetpes7">
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<span id="el$rowindex$_t_coachingtahapan_targetpes7" class="form-group t_coachingtahapan_targetpes7">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes7" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes7" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes7" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes7->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes7->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes7->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coachingtahapan_targetpes7" class="form-group t_coachingtahapan_targetpes7">
<span<?php echo $t_coachingtahapan_grid->targetpes7->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->targetpes7->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes7" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes7" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes7" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes7->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes7" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes7" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes7" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes7->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->tglpelak8->Visible) { // tglpelak8 ?>
		<td data-name="tglpelak8">
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<span id="el$rowindex$_t_coachingtahapan_tglpelak8" class="form-group t_coachingtahapan_tglpelak8">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak8" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak8" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak8" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak8->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->tglpelak8->EditValue ?>"<?php echo $t_coachingtahapan_grid->tglpelak8->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coachingtahapan_tglpelak8" class="form-group t_coachingtahapan_tglpelak8">
<span<?php echo $t_coachingtahapan_grid->tglpelak8->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->tglpelak8->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak8" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak8" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak8" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak8->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_tglpelak8" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak8" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_tglpelak8" value="<?php echo HtmlEncode($t_coachingtahapan_grid->tglpelak8->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_grid->targetpes8->Visible) { // targetpes8 ?>
		<td data-name="targetpes8">
<?php if (!$t_coachingtahapan->isConfirm()) { ?>
<span id="el$rowindex$_t_coachingtahapan_targetpes8" class="form-group t_coachingtahapan_targetpes8">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes8" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes8" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes8" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes8->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_grid->targetpes8->EditValue ?>"<?php echo $t_coachingtahapan_grid->targetpes8->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coachingtahapan_targetpes8" class="form-group t_coachingtahapan_targetpes8">
<span<?php echo $t_coachingtahapan_grid->targetpes8->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_grid->targetpes8->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes8" name="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes8" id="x<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes8" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes8->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_targetpes8" name="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes8" id="o<?php echo $t_coachingtahapan_grid->RowIndex ?>_targetpes8" value="<?php echo HtmlEncode($t_coachingtahapan_grid->targetpes8->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_coachingtahapan_grid->ListOptions->render("body", "right", $t_coachingtahapan_grid->RowIndex);
?>
<script>
loadjs.ready(["ft_coachingtahapangrid", "load"], function() {
	ft_coachingtahapangrid.updateLists(<?php echo $t_coachingtahapan_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($t_coachingtahapan->CurrentMode == "add" || $t_coachingtahapan->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $t_coachingtahapan_grid->FormKeyCountName ?>" id="<?php echo $t_coachingtahapan_grid->FormKeyCountName ?>" value="<?php echo $t_coachingtahapan_grid->KeyCount ?>">
<?php echo $t_coachingtahapan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_coachingtahapan->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $t_coachingtahapan_grid->FormKeyCountName ?>" id="<?php echo $t_coachingtahapan_grid->FormKeyCountName ?>" value="<?php echo $t_coachingtahapan_grid->KeyCount ?>">
<?php echo $t_coachingtahapan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_coachingtahapan->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_coachingtahapangrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_coachingtahapan_grid->Recordset)
	$t_coachingtahapan_grid->Recordset->Close();
?>
<?php if ($t_coachingtahapan_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $t_coachingtahapan_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_coachingtahapan_grid->TotalRecords == 0 && !$t_coachingtahapan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_coachingtahapan_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$t_coachingtahapan_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$('[data-name="tglpelak1"],[data-name="targetpes1"],[data-name="bendahara1"]').hide(),$('[data-name="tglpelak2"],[data-name="targetpes2"],[data-name="bendahara2"]').hide(),$('[data-name="tglpelak3"],[data-name="targetpes3"],[data-name="bendahara3"]').hide(),$('[data-name="tglpelak4"],[data-name="targetpes4"],[data-name="bendahara4"]').hide(),$('[data-name="tglpelak5"],[data-name="targetpes5"],[data-name="bendahara5"]').hide(),$('[data-name="tglpelak6"],[data-name="targetpes6"],[data-name="bendahara6"]').hide(),$('[data-name="tglpelak7"],[data-name="targetpes7"],[data-name="bendahara7"]').hide(),$('[data-name="tglpelak8"],[data-name="targetpes8"],[data-name="bendahara8"]').hide(),$("#t1").click(function(){$('[data-name="tglpelak1"],[data-name="targetpes1"],[data-name="bendahara1"]').show(500),$('[data-name="tglpelak2"],[data-name="targetpes2"],[data-name="bendahara2"]').hide(500),$('[data-name="tglpelak3"],[data-name="targetpes3"],[data-name="bendahara3"]').hide(500),$('[data-name="tglpelak4"],[data-name="targetpes4"],[data-name="bendahara4"]').hide(500),$('[data-name="tglpelak5"],[data-name="targetpes5"],[data-name="bendahara5"]').hide(500),$('[data-name="tglpelak6"],[data-name="targetpes6"],[data-name="bendahara6"]').hide(500),$('[data-name="tglpelak7"],[data-name="targetpes7"],[data-name="bendahara7"]').hide(500),$('[data-name="tglpelak8"],[data-name="targetpes8"],[data-name="bendahara8"]').hide(500)}),$("#t2").click(function(){$('[data-name="tglpelak1"],[data-name="targetpes1"],[data-name="bendahara1"]').hide(500),$('[data-name="tglpelak2"],[data-name="targetpes2"],[data-name="bendahara2"]').show(500),$('[data-name="tglpelak3"],[data-name="targetpes3"],[data-name="bendahara3"]').hide(500),$('[data-name="tglpelak4"],[data-name="targetpes4"],[data-name="bendahara4"]').hide(500),$('[data-name="tglpelak5"],[data-name="targetpes5"],[data-name="bendahara5"]').hide(500),$('[data-name="tglpelak6"],[data-name="targetpes6"],[data-name="bendahara6"]').hide(500),$('[data-name="tglpelak7"],[data-name="targetpes7"],[data-name="bendahara7"]').hide(500),$('[data-name="tglpelak8"],[data-name="targetpes8"],[data-name="bendahara8"]').hide(500)}),$("#t3").click(function(){$('[data-name="tglpelak1"],[data-name="targetpes1"],[data-name="bendahara1"]').hide(500),$('[data-name="tglpelak2"],[data-name="targetpes2"],[data-name="bendahara2"]').hide(500),$('[data-name="tglpelak3"],[data-name="targetpes3"],[data-name="bendahara3"]').show(500),$('[data-name="tglpelak4"],[data-name="targetpes4"],[data-name="bendahara4"]').hide(500),$('[data-name="tglpelak5"],[data-name="targetpes5"],[data-name="bendahara5"]').hide(500),$('[data-name="tglpelak6"],[data-name="targetpes6"],[data-name="bendahara6"]').hide(500),$('[data-name="tglpelak7"],[data-name="targetpes7"],[data-name="bendahara7"]').hide(500),$('[data-name="tglpelak8"],[data-name="targetpes8"],[data-name="bendahara8"]').hide(500)}),$("#t4").click(function(){$('[data-name="tglpelak1"],[data-name="targetpes1"],[data-name="bendahara1"]').hide(500),$('[data-name="tglpelak2"],[data-name="targetpes2"],[data-name="bendahara2"]').hide(500),$('[data-name="tglpelak3"],[data-name="targetpes3"],[data-name="bendahara3"]').hide(500),$('[data-name="tglpelak4"],[data-name="targetpes4"],[data-name="bendahara4"]').show(500),$('[data-name="tglpelak5"],[data-name="targetpes5"],[data-name="bendahara5"]').hide(500),$('[data-name="tglpelak6"],[data-name="targetpes6"],[data-name="bendahara6"]').hide(500),$('[data-name="tglpelak7"],[data-name="targetpes7"],[data-name="bendahara7"]').hide(500),$('[data-name="tglpelak8"],[data-name="targetpes8"],[data-name="bendahara8"]').hide(500)}),$("#t5").click(function(){$('[data-name="tglpelak1"],[data-name="targetpes1"],[data-name="bendahara1"]').hide(500),$('[data-name="tglpelak2"],[data-name="targetpes2"],[data-name="bendahara2"]').hide(500),$('[data-name="tglpelak3"],[data-name="targetpes3"],[data-name="bendahara3"]').hide(500),$('[data-name="tglpelak4"],[data-name="targetpes4"],[data-name="bendahara4"]').hide(500),$('[data-name="tglpelak5"],[data-name="targetpes5"],[data-name="bendahara5"]').show(500),$('[data-name="tglpelak6"],[data-name="targetpes6"],[data-name="bendahara6"]').hide(500),$('[data-name="tglpelak7"],[data-name="targetpes7"],[data-name="bendahara7"]').hide(500),$('[data-name="tglpelak8"],[data-name="targetpes8"],[data-name="bendahara8"]').hide(500)}),$("#t6").click(function(){$('[data-name="tglpelak1"],[data-name="targetpes1"],[data-name="bendahara1"]').hide(500),$('[data-name="tglpelak2"],[data-name="targetpes2"],[data-name="bendahara2"]').hide(500),$('[data-name="tglpelak3"],[data-name="targetpes3"],[data-name="bendahara3"]').hide(500),$('[data-name="tglpelak4"],[data-name="targetpes4"],[data-name="bendahara4"]').hide(500),$('[data-name="tglpelak5"],[data-name="targetpes5"],[data-name="bendahara5"]').hide(500),$('[data-name="tglpelak6"],[data-name="targetpes6"],[data-name="bendahara6"]').show(500),$('[data-name="tglpelak7"],[data-name="targetpes7"],[data-name="bendahara7"]').hide(500),$('[data-name="tglpelak8"],[data-name="targetpes8"],[data-name="bendahara8"]').hide(500)}),$("#t7").click(function(){$('[data-name="tglpelak1"],[data-name="targetpes1"],[data-name="bendahara1"]').hide(500),$('[data-name="tglpelak2"],[data-name="targetpes2"],[data-name="bendahara2"]').hide(500),$('[data-name="tglpelak3"],[data-name="targetpes3"],[data-name="bendahara3"]').hide(500),$('[data-name="tglpelak4"],[data-name="targetpes4"],[data-name="bendahara4"]').hide(500),$('[data-name="tglpelak5"],[data-name="targetpes5"],[data-name="bendahara5"]').hide(500),$('[data-name="tglpelak6"],[data-name="targetpes6"],[data-name="bendahara6"]').hide(500),$('[data-name="tglpelak7"],[data-name="targetpes7"],[data-name="bendahara7"]').show(500),$('[data-name="tglpelak8"],[data-name="targetpes8"],[data-name="bendahara8"]').hide(500)}),$("#t8").click(function(){$('[data-name="tglpelak1"],[data-name="targetpes1"],[data-name="bendahara1"]').hide(500),$('[data-name="tglpelak2"],[data-name="targetpes2"],[data-name="bendahara2"]').hide(500),$('[data-name="tglpelak3"],[data-name="targetpes3"],[data-name="bendahara3"]').hide(500),$('[data-name="tglpelak4"],[data-name="targetpes4"],[data-name="bendahara4"]').hide(500),$('[data-name="tglpelak5"],[data-name="targetpes5"],[data-name="bendahara5"]').hide(500),$('[data-name="tglpelak6"],[data-name="targetpes6"],[data-name="bendahara6"]').hide(500),$('[data-name="tglpelak7"],[data-name="targetpes7"],[data-name="bendahara7"]').hide(500),$('[data-name="tglpelak8"],[data-name="targetpes8"],[data-name="bendahara8"]').show(500)});
});
</script>
<?php } ?>
<?php
$t_coachingtahapan_grid->terminate();
?>