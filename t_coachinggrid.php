<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($t_coaching_grid))
	$t_coaching_grid = new t_coaching_grid();

// Run the page
$t_coaching_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_coaching_grid->Page_Render();
?>
<?php if (!$t_coaching_grid->isExport()) { ?>
<script>
var ft_coachinggrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	ft_coachinggrid = new ew.Form("ft_coachinggrid", "grid");
	ft_coachinggrid.formKeyCountName = '<?php echo $t_coaching_grid->FormKeyCountName ?>';

	// Validate form
	ft_coachinggrid.validate = function() {
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
			<?php if ($t_coaching_grid->kdtahapan->Required) { ?>
				elm = this.getElements("x" + infix + "_kdtahapan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_grid->kdtahapan->caption(), $t_coaching_grid->kdtahapan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coaching_grid->kdkursil->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkursil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_grid->kdkursil->caption(), $t_coaching_grid->kdkursil->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coaching_grid->tawal->Required) { ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_grid->tawal->caption(), $t_coaching_grid->tawal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coaching_grid->tawal->errorMessage()) ?>");
			<?php if ($t_coaching_grid->takhir->Required) { ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_grid->takhir->caption(), $t_coaching_grid->takhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coaching_grid->takhir->errorMessage()) ?>");
			<?php if ($t_coaching_grid->jmlhari->Required) { ?>
				elm = this.getElements("x" + infix + "_jmlhari");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_grid->jmlhari->caption(), $t_coaching_grid->jmlhari->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jmlhari");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coaching_grid->jmlhari->errorMessage()) ?>");
			<?php if ($t_coaching_grid->kdprop->Required) { ?>
				elm = this.getElements("x" + infix + "_kdprop");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_grid->kdprop->caption(), $t_coaching_grid->kdprop->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coaching_grid->ketua->Required) { ?>
				elm = this.getElements("x" + infix + "_ketua");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_grid->ketua->caption(), $t_coaching_grid->ketua->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coaching_grid->sekretaris->Required) { ?>
				elm = this.getElements("x" + infix + "_sekretaris");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_grid->sekretaris->caption(), $t_coaching_grid->sekretaris->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coaching_grid->bendahara->Required) { ?>
				elm = this.getElements("x" + infix + "_bendahara");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_grid->bendahara->caption(), $t_coaching_grid->bendahara->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coaching_grid->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_grid->status->caption(), $t_coaching_grid->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coaching_grid->jenisevaluasi->Required) { ?>
				elm = this.getElements("x" + infix + "_jenisevaluasi[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_grid->jenisevaluasi->caption(), $t_coaching_grid->jenisevaluasi->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	ft_coachinggrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "kdtahapan", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdkursil", false)) return false;
		if (ew.valueChanged(fobj, infix, "tawal", false)) return false;
		if (ew.valueChanged(fobj, infix, "takhir", false)) return false;
		if (ew.valueChanged(fobj, infix, "jmlhari", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdprop", false)) return false;
		if (ew.valueChanged(fobj, infix, "ketua", false)) return false;
		if (ew.valueChanged(fobj, infix, "sekretaris", false)) return false;
		if (ew.valueChanged(fobj, infix, "bendahara", false)) return false;
		if (ew.valueChanged(fobj, infix, "status", false)) return false;
		if (ew.valueChanged(fobj, infix, "jenisevaluasi[]", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_coachinggrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_coachinggrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_coachinggrid.lists["x_kdtahapan"] = <?php echo $t_coaching_grid->kdtahapan->Lookup->toClientList($t_coaching_grid) ?>;
	ft_coachinggrid.lists["x_kdtahapan"].options = <?php echo JsonEncode($t_coaching_grid->kdtahapan->lookupOptions()) ?>;
	ft_coachinggrid.lists["x_kdkursil"] = <?php echo $t_coaching_grid->kdkursil->Lookup->toClientList($t_coaching_grid) ?>;
	ft_coachinggrid.lists["x_kdkursil"].options = <?php echo JsonEncode($t_coaching_grid->kdkursil->lookupOptions()) ?>;
	ft_coachinggrid.lists["x_kdprop"] = <?php echo $t_coaching_grid->kdprop->Lookup->toClientList($t_coaching_grid) ?>;
	ft_coachinggrid.lists["x_kdprop"].options = <?php echo JsonEncode($t_coaching_grid->kdprop->lookupOptions()) ?>;
	ft_coachinggrid.lists["x_ketua"] = <?php echo $t_coaching_grid->ketua->Lookup->toClientList($t_coaching_grid) ?>;
	ft_coachinggrid.lists["x_ketua"].options = <?php echo JsonEncode($t_coaching_grid->ketua->lookupOptions()) ?>;
	ft_coachinggrid.autoSuggests["x_ketua"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_coachinggrid.lists["x_sekretaris"] = <?php echo $t_coaching_grid->sekretaris->Lookup->toClientList($t_coaching_grid) ?>;
	ft_coachinggrid.lists["x_sekretaris"].options = <?php echo JsonEncode($t_coaching_grid->sekretaris->lookupOptions()) ?>;
	ft_coachinggrid.autoSuggests["x_sekretaris"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_coachinggrid.lists["x_bendahara"] = <?php echo $t_coaching_grid->bendahara->Lookup->toClientList($t_coaching_grid) ?>;
	ft_coachinggrid.lists["x_bendahara"].options = <?php echo JsonEncode($t_coaching_grid->bendahara->lookupOptions()) ?>;
	ft_coachinggrid.autoSuggests["x_bendahara"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_coachinggrid.lists["x_status"] = <?php echo $t_coaching_grid->status->Lookup->toClientList($t_coaching_grid) ?>;
	ft_coachinggrid.lists["x_status"].options = <?php echo JsonEncode($t_coaching_grid->status->options(FALSE, TRUE)) ?>;
	ft_coachinggrid.lists["x_jenisevaluasi[]"] = <?php echo $t_coaching_grid->jenisevaluasi->Lookup->toClientList($t_coaching_grid) ?>;
	ft_coachinggrid.lists["x_jenisevaluasi[]"].options = <?php echo JsonEncode($t_coaching_grid->jenisevaluasi->lookupOptions()) ?>;
	loadjs.done("ft_coachinggrid");
});
</script>
<?php } ?>
<?php
$t_coaching_grid->renderOtherOptions();
?>
<?php if ($t_coaching_grid->TotalRecords > 0 || $t_coaching->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_coaching_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_coaching">
<?php if ($t_coaching_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $t_coaching_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ft_coachinggrid" class="ew-form ew-list-form form-inline">
<div id="gmp_t_coaching" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_t_coachinggrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_coaching->RowType = ROWTYPE_HEADER;

// Render list options
$t_coaching_grid->renderListOptions();

// Render list options (header, left)
$t_coaching_grid->ListOptions->render("header", "left");
?>
<?php if ($t_coaching_grid->kdtahapan->Visible) { // kdtahapan ?>
	<?php if ($t_coaching_grid->SortUrl($t_coaching_grid->kdtahapan) == "") { ?>
		<th data-name="kdtahapan" class="<?php echo $t_coaching_grid->kdtahapan->headerCellClass() ?>"><div id="elh_t_coaching_kdtahapan" class="t_coaching_kdtahapan"><div class="ew-table-header-caption"><?php echo $t_coaching_grid->kdtahapan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdtahapan" class="<?php echo $t_coaching_grid->kdtahapan->headerCellClass() ?>"><div><div id="elh_t_coaching_kdtahapan" class="t_coaching_kdtahapan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coaching_grid->kdtahapan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coaching_grid->kdtahapan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coaching_grid->kdtahapan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coaching_grid->kdkursil->Visible) { // kdkursil ?>
	<?php if ($t_coaching_grid->SortUrl($t_coaching_grid->kdkursil) == "") { ?>
		<th data-name="kdkursil" class="<?php echo $t_coaching_grid->kdkursil->headerCellClass() ?>"><div id="elh_t_coaching_kdkursil" class="t_coaching_kdkursil"><div class="ew-table-header-caption"><?php echo $t_coaching_grid->kdkursil->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkursil" class="<?php echo $t_coaching_grid->kdkursil->headerCellClass() ?>"><div><div id="elh_t_coaching_kdkursil" class="t_coaching_kdkursil">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coaching_grid->kdkursil->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coaching_grid->kdkursil->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coaching_grid->kdkursil->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coaching_grid->tawal->Visible) { // tawal ?>
	<?php if ($t_coaching_grid->SortUrl($t_coaching_grid->tawal) == "") { ?>
		<th data-name="tawal" class="<?php echo $t_coaching_grid->tawal->headerCellClass() ?>"><div id="elh_t_coaching_tawal" class="t_coaching_tawal"><div class="ew-table-header-caption"><?php echo $t_coaching_grid->tawal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tawal" class="<?php echo $t_coaching_grid->tawal->headerCellClass() ?>"><div><div id="elh_t_coaching_tawal" class="t_coaching_tawal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coaching_grid->tawal->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coaching_grid->tawal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coaching_grid->tawal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coaching_grid->takhir->Visible) { // takhir ?>
	<?php if ($t_coaching_grid->SortUrl($t_coaching_grid->takhir) == "") { ?>
		<th data-name="takhir" class="<?php echo $t_coaching_grid->takhir->headerCellClass() ?>"><div id="elh_t_coaching_takhir" class="t_coaching_takhir"><div class="ew-table-header-caption"><?php echo $t_coaching_grid->takhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="takhir" class="<?php echo $t_coaching_grid->takhir->headerCellClass() ?>"><div><div id="elh_t_coaching_takhir" class="t_coaching_takhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coaching_grid->takhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coaching_grid->takhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coaching_grid->takhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coaching_grid->jmlhari->Visible) { // jmlhari ?>
	<?php if ($t_coaching_grid->SortUrl($t_coaching_grid->jmlhari) == "") { ?>
		<th data-name="jmlhari" class="<?php echo $t_coaching_grid->jmlhari->headerCellClass() ?>"><div id="elh_t_coaching_jmlhari" class="t_coaching_jmlhari"><div class="ew-table-header-caption"><?php echo $t_coaching_grid->jmlhari->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jmlhari" class="<?php echo $t_coaching_grid->jmlhari->headerCellClass() ?>"><div><div id="elh_t_coaching_jmlhari" class="t_coaching_jmlhari">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coaching_grid->jmlhari->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coaching_grid->jmlhari->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coaching_grid->jmlhari->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coaching_grid->kdprop->Visible) { // kdprop ?>
	<?php if ($t_coaching_grid->SortUrl($t_coaching_grid->kdprop) == "") { ?>
		<th data-name="kdprop" class="<?php echo $t_coaching_grid->kdprop->headerCellClass() ?>"><div id="elh_t_coaching_kdprop" class="t_coaching_kdprop"><div class="ew-table-header-caption"><?php echo $t_coaching_grid->kdprop->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdprop" class="<?php echo $t_coaching_grid->kdprop->headerCellClass() ?>"><div><div id="elh_t_coaching_kdprop" class="t_coaching_kdprop">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coaching_grid->kdprop->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coaching_grid->kdprop->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coaching_grid->kdprop->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coaching_grid->ketua->Visible) { // ketua ?>
	<?php if ($t_coaching_grid->SortUrl($t_coaching_grid->ketua) == "") { ?>
		<th data-name="ketua" class="<?php echo $t_coaching_grid->ketua->headerCellClass() ?>"><div id="elh_t_coaching_ketua" class="t_coaching_ketua"><div class="ew-table-header-caption"><?php echo $t_coaching_grid->ketua->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ketua" class="<?php echo $t_coaching_grid->ketua->headerCellClass() ?>"><div><div id="elh_t_coaching_ketua" class="t_coaching_ketua">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coaching_grid->ketua->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coaching_grid->ketua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coaching_grid->ketua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coaching_grid->sekretaris->Visible) { // sekretaris ?>
	<?php if ($t_coaching_grid->SortUrl($t_coaching_grid->sekretaris) == "") { ?>
		<th data-name="sekretaris" class="<?php echo $t_coaching_grid->sekretaris->headerCellClass() ?>"><div id="elh_t_coaching_sekretaris" class="t_coaching_sekretaris"><div class="ew-table-header-caption"><?php echo $t_coaching_grid->sekretaris->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sekretaris" class="<?php echo $t_coaching_grid->sekretaris->headerCellClass() ?>"><div><div id="elh_t_coaching_sekretaris" class="t_coaching_sekretaris">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coaching_grid->sekretaris->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coaching_grid->sekretaris->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coaching_grid->sekretaris->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coaching_grid->bendahara->Visible) { // bendahara ?>
	<?php if ($t_coaching_grid->SortUrl($t_coaching_grid->bendahara) == "") { ?>
		<th data-name="bendahara" class="<?php echo $t_coaching_grid->bendahara->headerCellClass() ?>"><div id="elh_t_coaching_bendahara" class="t_coaching_bendahara"><div class="ew-table-header-caption"><?php echo $t_coaching_grid->bendahara->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bendahara" class="<?php echo $t_coaching_grid->bendahara->headerCellClass() ?>"><div><div id="elh_t_coaching_bendahara" class="t_coaching_bendahara">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coaching_grid->bendahara->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coaching_grid->bendahara->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coaching_grid->bendahara->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coaching_grid->status->Visible) { // status ?>
	<?php if ($t_coaching_grid->SortUrl($t_coaching_grid->status) == "") { ?>
		<th data-name="status" class="<?php echo $t_coaching_grid->status->headerCellClass() ?>"><div id="elh_t_coaching_status" class="t_coaching_status"><div class="ew-table-header-caption"><?php echo $t_coaching_grid->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $t_coaching_grid->status->headerCellClass() ?>"><div><div id="elh_t_coaching_status" class="t_coaching_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coaching_grid->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coaching_grid->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coaching_grid->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coaching_grid->jenisevaluasi->Visible) { // jenisevaluasi ?>
	<?php if ($t_coaching_grid->SortUrl($t_coaching_grid->jenisevaluasi) == "") { ?>
		<th data-name="jenisevaluasi" class="<?php echo $t_coaching_grid->jenisevaluasi->headerCellClass() ?>"><div id="elh_t_coaching_jenisevaluasi" class="t_coaching_jenisevaluasi"><div class="ew-table-header-caption"><?php echo $t_coaching_grid->jenisevaluasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenisevaluasi" class="<?php echo $t_coaching_grid->jenisevaluasi->headerCellClass() ?>"><div><div id="elh_t_coaching_jenisevaluasi" class="t_coaching_jenisevaluasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coaching_grid->jenisevaluasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coaching_grid->jenisevaluasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coaching_grid->jenisevaluasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_coaching_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_coaching_grid->StartRecord = 1;
$t_coaching_grid->StopRecord = $t_coaching_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($t_coaching->isConfirm() || $t_coaching_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_coaching_grid->FormKeyCountName) && ($t_coaching_grid->isGridAdd() || $t_coaching_grid->isGridEdit() || $t_coaching->isConfirm())) {
		$t_coaching_grid->KeyCount = $CurrentForm->getValue($t_coaching_grid->FormKeyCountName);
		$t_coaching_grid->StopRecord = $t_coaching_grid->StartRecord + $t_coaching_grid->KeyCount - 1;
	}
}
$t_coaching_grid->RecordCount = $t_coaching_grid->StartRecord - 1;
if ($t_coaching_grid->Recordset && !$t_coaching_grid->Recordset->EOF) {
	$t_coaching_grid->Recordset->moveFirst();
	$selectLimit = $t_coaching_grid->UseSelectLimit;
	if (!$selectLimit && $t_coaching_grid->StartRecord > 1)
		$t_coaching_grid->Recordset->move($t_coaching_grid->StartRecord - 1);
} elseif (!$t_coaching->AllowAddDeleteRow && $t_coaching_grid->StopRecord == 0) {
	$t_coaching_grid->StopRecord = $t_coaching->GridAddRowCount;
}

// Initialize aggregate
$t_coaching->RowType = ROWTYPE_AGGREGATEINIT;
$t_coaching->resetAttributes();
$t_coaching_grid->renderRow();
if ($t_coaching_grid->isGridAdd())
	$t_coaching_grid->RowIndex = 0;
if ($t_coaching_grid->isGridEdit())
	$t_coaching_grid->RowIndex = 0;
while ($t_coaching_grid->RecordCount < $t_coaching_grid->StopRecord) {
	$t_coaching_grid->RecordCount++;
	if ($t_coaching_grid->RecordCount >= $t_coaching_grid->StartRecord) {
		$t_coaching_grid->RowCount++;
		if ($t_coaching_grid->isGridAdd() || $t_coaching_grid->isGridEdit() || $t_coaching->isConfirm()) {
			$t_coaching_grid->RowIndex++;
			$CurrentForm->Index = $t_coaching_grid->RowIndex;
			if ($CurrentForm->hasValue($t_coaching_grid->FormActionName) && ($t_coaching->isConfirm() || $t_coaching_grid->EventCancelled))
				$t_coaching_grid->RowAction = strval($CurrentForm->getValue($t_coaching_grid->FormActionName));
			elseif ($t_coaching_grid->isGridAdd())
				$t_coaching_grid->RowAction = "insert";
			else
				$t_coaching_grid->RowAction = "";
		}

		// Set up key count
		$t_coaching_grid->KeyCount = $t_coaching_grid->RowIndex;

		// Init row class and style
		$t_coaching->resetAttributes();
		$t_coaching->CssClass = "";
		if ($t_coaching_grid->isGridAdd()) {
			if ($t_coaching->CurrentMode == "copy") {
				$t_coaching_grid->loadRowValues($t_coaching_grid->Recordset); // Load row values
				$t_coaching_grid->setRecordKey($t_coaching_grid->RowOldKey, $t_coaching_grid->Recordset); // Set old record key
			} else {
				$t_coaching_grid->loadRowValues(); // Load default values
				$t_coaching_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_coaching_grid->loadRowValues($t_coaching_grid->Recordset); // Load row values
		}
		$t_coaching->RowType = ROWTYPE_VIEW; // Render view
		if ($t_coaching_grid->isGridAdd()) // Grid add
			$t_coaching->RowType = ROWTYPE_ADD; // Render add
		if ($t_coaching_grid->isGridAdd() && $t_coaching->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_coaching_grid->restoreCurrentRowFormValues($t_coaching_grid->RowIndex); // Restore form values
		if ($t_coaching_grid->isGridEdit()) { // Grid edit
			if ($t_coaching->EventCancelled)
				$t_coaching_grid->restoreCurrentRowFormValues($t_coaching_grid->RowIndex); // Restore form values
			if ($t_coaching_grid->RowAction == "insert")
				$t_coaching->RowType = ROWTYPE_ADD; // Render add
			else
				$t_coaching->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_coaching_grid->isGridEdit() && ($t_coaching->RowType == ROWTYPE_EDIT || $t_coaching->RowType == ROWTYPE_ADD) && $t_coaching->EventCancelled) // Update failed
			$t_coaching_grid->restoreCurrentRowFormValues($t_coaching_grid->RowIndex); // Restore form values
		if ($t_coaching->RowType == ROWTYPE_EDIT) // Edit row
			$t_coaching_grid->EditRowCount++;
		if ($t_coaching->isConfirm()) // Confirm row
			$t_coaching_grid->restoreCurrentRowFormValues($t_coaching_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_coaching->RowAttrs->merge(["data-rowindex" => $t_coaching_grid->RowCount, "id" => "r" . $t_coaching_grid->RowCount . "_t_coaching", "data-rowtype" => $t_coaching->RowType]);

		// Render row
		$t_coaching_grid->renderRow();

		// Render list options
		$t_coaching_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_coaching_grid->RowAction != "delete" && $t_coaching_grid->RowAction != "insertdelete" && !($t_coaching_grid->RowAction == "insert" && $t_coaching->isConfirm() && $t_coaching_grid->emptyRow())) {
?>
	<tr <?php echo $t_coaching->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_coaching_grid->ListOptions->render("body", "left", $t_coaching_grid->RowCount);
?>
	<?php if ($t_coaching_grid->kdtahapan->Visible) { // kdtahapan ?>
		<td data-name="kdtahapan" <?php echo $t_coaching_grid->kdtahapan->cellAttributes() ?>>
<?php if ($t_coaching->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_kdtahapan" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coaching" data-field="x_kdtahapan" data-value-separator="<?php echo $t_coaching_grid->kdtahapan->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_coaching_grid->RowIndex ?>_kdtahapan" name="x<?php echo $t_coaching_grid->RowIndex ?>_kdtahapan"<?php echo $t_coaching_grid->kdtahapan->editAttributes() ?>>
			<?php echo $t_coaching_grid->kdtahapan->selectOptionListHtml("x{$t_coaching_grid->RowIndex}_kdtahapan") ?>
		</select>
</div>
<?php echo $t_coaching_grid->kdtahapan->Lookup->getParamTag($t_coaching_grid, "p_x" . $t_coaching_grid->RowIndex . "_kdtahapan") ?>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_kdtahapan" name="o<?php echo $t_coaching_grid->RowIndex ?>_kdtahapan" id="o<?php echo $t_coaching_grid->RowIndex ?>_kdtahapan" value="<?php echo HtmlEncode($t_coaching_grid->kdtahapan->OldValue) ?>">
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_kdtahapan" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coaching" data-field="x_kdtahapan" data-value-separator="<?php echo $t_coaching_grid->kdtahapan->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_coaching_grid->RowIndex ?>_kdtahapan" name="x<?php echo $t_coaching_grid->RowIndex ?>_kdtahapan"<?php echo $t_coaching_grid->kdtahapan->editAttributes() ?>>
			<?php echo $t_coaching_grid->kdtahapan->selectOptionListHtml("x{$t_coaching_grid->RowIndex}_kdtahapan") ?>
		</select>
</div>
<?php echo $t_coaching_grid->kdtahapan->Lookup->getParamTag($t_coaching_grid, "p_x" . $t_coaching_grid->RowIndex . "_kdtahapan") ?>
</span>
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_kdtahapan">
<span<?php echo $t_coaching_grid->kdtahapan->viewAttributes() ?>><?php echo $t_coaching_grid->kdtahapan->getViewValue() ?></span>
</span>
<?php if (!$t_coaching->isConfirm()) { ?>
<input type="hidden" data-table="t_coaching" data-field="x_kdtahapan" name="x<?php echo $t_coaching_grid->RowIndex ?>_kdtahapan" id="x<?php echo $t_coaching_grid->RowIndex ?>_kdtahapan" value="<?php echo HtmlEncode($t_coaching_grid->kdtahapan->FormValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_kdtahapan" name="o<?php echo $t_coaching_grid->RowIndex ?>_kdtahapan" id="o<?php echo $t_coaching_grid->RowIndex ?>_kdtahapan" value="<?php echo HtmlEncode($t_coaching_grid->kdtahapan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coaching" data-field="x_kdtahapan" name="ft_coachinggrid$x<?php echo $t_coaching_grid->RowIndex ?>_kdtahapan" id="ft_coachinggrid$x<?php echo $t_coaching_grid->RowIndex ?>_kdtahapan" value="<?php echo HtmlEncode($t_coaching_grid->kdtahapan->FormValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_kdtahapan" name="ft_coachinggrid$o<?php echo $t_coaching_grid->RowIndex ?>_kdtahapan" id="ft_coachinggrid$o<?php echo $t_coaching_grid->RowIndex ?>_kdtahapan" value="<?php echo HtmlEncode($t_coaching_grid->kdtahapan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t_coaching" data-field="x_kdcoaching" name="x<?php echo $t_coaching_grid->RowIndex ?>_kdcoaching" id="x<?php echo $t_coaching_grid->RowIndex ?>_kdcoaching" value="<?php echo HtmlEncode($t_coaching_grid->kdcoaching->CurrentValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_kdcoaching" name="o<?php echo $t_coaching_grid->RowIndex ?>_kdcoaching" id="o<?php echo $t_coaching_grid->RowIndex ?>_kdcoaching" value="<?php echo HtmlEncode($t_coaching_grid->kdcoaching->OldValue) ?>">
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_EDIT || $t_coaching->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t_coaching" data-field="x_kdcoaching" name="x<?php echo $t_coaching_grid->RowIndex ?>_kdcoaching" id="x<?php echo $t_coaching_grid->RowIndex ?>_kdcoaching" value="<?php echo HtmlEncode($t_coaching_grid->kdcoaching->CurrentValue) ?>">
<?php } ?>
	<?php if ($t_coaching_grid->kdkursil->Visible) { // kdkursil ?>
		<td data-name="kdkursil" <?php echo $t_coaching_grid->kdkursil->cellAttributes() ?>>
<?php if ($t_coaching->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_kdkursil" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coaching" data-field="x_kdkursil" data-value-separator="<?php echo $t_coaching_grid->kdkursil->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_coaching_grid->RowIndex ?>_kdkursil" name="x<?php echo $t_coaching_grid->RowIndex ?>_kdkursil"<?php echo $t_coaching_grid->kdkursil->editAttributes() ?>>
			<?php echo $t_coaching_grid->kdkursil->selectOptionListHtml("x{$t_coaching_grid->RowIndex}_kdkursil") ?>
		</select>
</div>
<?php echo $t_coaching_grid->kdkursil->Lookup->getParamTag($t_coaching_grid, "p_x" . $t_coaching_grid->RowIndex . "_kdkursil") ?>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_kdkursil" name="o<?php echo $t_coaching_grid->RowIndex ?>_kdkursil" id="o<?php echo $t_coaching_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_coaching_grid->kdkursil->OldValue) ?>">
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_kdkursil" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coaching" data-field="x_kdkursil" data-value-separator="<?php echo $t_coaching_grid->kdkursil->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_coaching_grid->RowIndex ?>_kdkursil" name="x<?php echo $t_coaching_grid->RowIndex ?>_kdkursil"<?php echo $t_coaching_grid->kdkursil->editAttributes() ?>>
			<?php echo $t_coaching_grid->kdkursil->selectOptionListHtml("x{$t_coaching_grid->RowIndex}_kdkursil") ?>
		</select>
</div>
<?php echo $t_coaching_grid->kdkursil->Lookup->getParamTag($t_coaching_grid, "p_x" . $t_coaching_grid->RowIndex . "_kdkursil") ?>
</span>
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_kdkursil">
<span<?php echo $t_coaching_grid->kdkursil->viewAttributes() ?>><?php echo $t_coaching_grid->kdkursil->getViewValue() ?></span>
</span>
<?php if (!$t_coaching->isConfirm()) { ?>
<input type="hidden" data-table="t_coaching" data-field="x_kdkursil" name="x<?php echo $t_coaching_grid->RowIndex ?>_kdkursil" id="x<?php echo $t_coaching_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_coaching_grid->kdkursil->FormValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_kdkursil" name="o<?php echo $t_coaching_grid->RowIndex ?>_kdkursil" id="o<?php echo $t_coaching_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_coaching_grid->kdkursil->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coaching" data-field="x_kdkursil" name="ft_coachinggrid$x<?php echo $t_coaching_grid->RowIndex ?>_kdkursil" id="ft_coachinggrid$x<?php echo $t_coaching_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_coaching_grid->kdkursil->FormValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_kdkursil" name="ft_coachinggrid$o<?php echo $t_coaching_grid->RowIndex ?>_kdkursil" id="ft_coachinggrid$o<?php echo $t_coaching_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_coaching_grid->kdkursil->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coaching_grid->tawal->Visible) { // tawal ?>
		<td data-name="tawal" <?php echo $t_coaching_grid->tawal->cellAttributes() ?>>
<?php if ($t_coaching->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_tawal" class="form-group">
<input type="text" data-table="t_coaching" data-field="x_tawal" name="x<?php echo $t_coaching_grid->RowIndex ?>_tawal" id="x<?php echo $t_coaching_grid->RowIndex ?>_tawal" size="10" placeholder="<?php echo HtmlEncode($t_coaching_grid->tawal->getPlaceHolder()) ?>" value="<?php echo $t_coaching_grid->tawal->EditValue ?>"<?php echo $t_coaching_grid->tawal->editAttributes() ?>>
<?php if (!$t_coaching_grid->tawal->ReadOnly && !$t_coaching_grid->tawal->Disabled && !isset($t_coaching_grid->tawal->EditAttrs["readonly"]) && !isset($t_coaching_grid->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_coachinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_coachinggrid", "x<?php echo $t_coaching_grid->RowIndex ?>_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_tawal" name="o<?php echo $t_coaching_grid->RowIndex ?>_tawal" id="o<?php echo $t_coaching_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($t_coaching_grid->tawal->OldValue) ?>">
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_tawal" class="form-group">
<input type="text" data-table="t_coaching" data-field="x_tawal" name="x<?php echo $t_coaching_grid->RowIndex ?>_tawal" id="x<?php echo $t_coaching_grid->RowIndex ?>_tawal" size="10" placeholder="<?php echo HtmlEncode($t_coaching_grid->tawal->getPlaceHolder()) ?>" value="<?php echo $t_coaching_grid->tawal->EditValue ?>"<?php echo $t_coaching_grid->tawal->editAttributes() ?>>
<?php if (!$t_coaching_grid->tawal->ReadOnly && !$t_coaching_grid->tawal->Disabled && !isset($t_coaching_grid->tawal->EditAttrs["readonly"]) && !isset($t_coaching_grid->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_coachinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_coachinggrid", "x<?php echo $t_coaching_grid->RowIndex ?>_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_tawal">
<span<?php echo $t_coaching_grid->tawal->viewAttributes() ?>><?php echo $t_coaching_grid->tawal->getViewValue() ?></span>
</span>
<?php if (!$t_coaching->isConfirm()) { ?>
<input type="hidden" data-table="t_coaching" data-field="x_tawal" name="x<?php echo $t_coaching_grid->RowIndex ?>_tawal" id="x<?php echo $t_coaching_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($t_coaching_grid->tawal->FormValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_tawal" name="o<?php echo $t_coaching_grid->RowIndex ?>_tawal" id="o<?php echo $t_coaching_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($t_coaching_grid->tawal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coaching" data-field="x_tawal" name="ft_coachinggrid$x<?php echo $t_coaching_grid->RowIndex ?>_tawal" id="ft_coachinggrid$x<?php echo $t_coaching_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($t_coaching_grid->tawal->FormValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_tawal" name="ft_coachinggrid$o<?php echo $t_coaching_grid->RowIndex ?>_tawal" id="ft_coachinggrid$o<?php echo $t_coaching_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($t_coaching_grid->tawal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coaching_grid->takhir->Visible) { // takhir ?>
		<td data-name="takhir" <?php echo $t_coaching_grid->takhir->cellAttributes() ?>>
<?php if ($t_coaching->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_takhir" class="form-group">
<input type="text" data-table="t_coaching" data-field="x_takhir" name="x<?php echo $t_coaching_grid->RowIndex ?>_takhir" id="x<?php echo $t_coaching_grid->RowIndex ?>_takhir" size="10" placeholder="<?php echo HtmlEncode($t_coaching_grid->takhir->getPlaceHolder()) ?>" value="<?php echo $t_coaching_grid->takhir->EditValue ?>"<?php echo $t_coaching_grid->takhir->editAttributes() ?>>
<?php if (!$t_coaching_grid->takhir->ReadOnly && !$t_coaching_grid->takhir->Disabled && !isset($t_coaching_grid->takhir->EditAttrs["readonly"]) && !isset($t_coaching_grid->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_coachinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_coachinggrid", "x<?php echo $t_coaching_grid->RowIndex ?>_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_takhir" name="o<?php echo $t_coaching_grid->RowIndex ?>_takhir" id="o<?php echo $t_coaching_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($t_coaching_grid->takhir->OldValue) ?>">
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_takhir" class="form-group">
<input type="text" data-table="t_coaching" data-field="x_takhir" name="x<?php echo $t_coaching_grid->RowIndex ?>_takhir" id="x<?php echo $t_coaching_grid->RowIndex ?>_takhir" size="10" placeholder="<?php echo HtmlEncode($t_coaching_grid->takhir->getPlaceHolder()) ?>" value="<?php echo $t_coaching_grid->takhir->EditValue ?>"<?php echo $t_coaching_grid->takhir->editAttributes() ?>>
<?php if (!$t_coaching_grid->takhir->ReadOnly && !$t_coaching_grid->takhir->Disabled && !isset($t_coaching_grid->takhir->EditAttrs["readonly"]) && !isset($t_coaching_grid->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_coachinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_coachinggrid", "x<?php echo $t_coaching_grid->RowIndex ?>_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_takhir">
<span<?php echo $t_coaching_grid->takhir->viewAttributes() ?>><?php echo $t_coaching_grid->takhir->getViewValue() ?></span>
</span>
<?php if (!$t_coaching->isConfirm()) { ?>
<input type="hidden" data-table="t_coaching" data-field="x_takhir" name="x<?php echo $t_coaching_grid->RowIndex ?>_takhir" id="x<?php echo $t_coaching_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($t_coaching_grid->takhir->FormValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_takhir" name="o<?php echo $t_coaching_grid->RowIndex ?>_takhir" id="o<?php echo $t_coaching_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($t_coaching_grid->takhir->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coaching" data-field="x_takhir" name="ft_coachinggrid$x<?php echo $t_coaching_grid->RowIndex ?>_takhir" id="ft_coachinggrid$x<?php echo $t_coaching_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($t_coaching_grid->takhir->FormValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_takhir" name="ft_coachinggrid$o<?php echo $t_coaching_grid->RowIndex ?>_takhir" id="ft_coachinggrid$o<?php echo $t_coaching_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($t_coaching_grid->takhir->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coaching_grid->jmlhari->Visible) { // jmlhari ?>
		<td data-name="jmlhari" <?php echo $t_coaching_grid->jmlhari->cellAttributes() ?>>
<?php if ($t_coaching->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_jmlhari" class="form-group">
<input type="text" data-table="t_coaching" data-field="x_jmlhari" name="x<?php echo $t_coaching_grid->RowIndex ?>_jmlhari" id="x<?php echo $t_coaching_grid->RowIndex ?>_jmlhari" size="5" maxlength="5" placeholder="<?php echo HtmlEncode($t_coaching_grid->jmlhari->getPlaceHolder()) ?>" value="<?php echo $t_coaching_grid->jmlhari->EditValue ?>"<?php echo $t_coaching_grid->jmlhari->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_jmlhari" name="o<?php echo $t_coaching_grid->RowIndex ?>_jmlhari" id="o<?php echo $t_coaching_grid->RowIndex ?>_jmlhari" value="<?php echo HtmlEncode($t_coaching_grid->jmlhari->OldValue) ?>">
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_jmlhari" class="form-group">
<input type="text" data-table="t_coaching" data-field="x_jmlhari" name="x<?php echo $t_coaching_grid->RowIndex ?>_jmlhari" id="x<?php echo $t_coaching_grid->RowIndex ?>_jmlhari" size="5" maxlength="5" placeholder="<?php echo HtmlEncode($t_coaching_grid->jmlhari->getPlaceHolder()) ?>" value="<?php echo $t_coaching_grid->jmlhari->EditValue ?>"<?php echo $t_coaching_grid->jmlhari->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_jmlhari">
<span<?php echo $t_coaching_grid->jmlhari->viewAttributes() ?>><?php echo $t_coaching_grid->jmlhari->getViewValue() ?></span>
</span>
<?php if (!$t_coaching->isConfirm()) { ?>
<input type="hidden" data-table="t_coaching" data-field="x_jmlhari" name="x<?php echo $t_coaching_grid->RowIndex ?>_jmlhari" id="x<?php echo $t_coaching_grid->RowIndex ?>_jmlhari" value="<?php echo HtmlEncode($t_coaching_grid->jmlhari->FormValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_jmlhari" name="o<?php echo $t_coaching_grid->RowIndex ?>_jmlhari" id="o<?php echo $t_coaching_grid->RowIndex ?>_jmlhari" value="<?php echo HtmlEncode($t_coaching_grid->jmlhari->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coaching" data-field="x_jmlhari" name="ft_coachinggrid$x<?php echo $t_coaching_grid->RowIndex ?>_jmlhari" id="ft_coachinggrid$x<?php echo $t_coaching_grid->RowIndex ?>_jmlhari" value="<?php echo HtmlEncode($t_coaching_grid->jmlhari->FormValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_jmlhari" name="ft_coachinggrid$o<?php echo $t_coaching_grid->RowIndex ?>_jmlhari" id="ft_coachinggrid$o<?php echo $t_coaching_grid->RowIndex ?>_jmlhari" value="<?php echo HtmlEncode($t_coaching_grid->jmlhari->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coaching_grid->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" <?php echo $t_coaching_grid->kdprop->cellAttributes() ?>>
<?php if ($t_coaching->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($t_coaching_grid->kdprop->getSessionValue() != "") { ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_kdprop" class="form-group">
<span<?php echo $t_coaching_grid->kdprop->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coaching_grid->kdprop->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_coaching_grid->RowIndex ?>_kdprop" name="x<?php echo $t_coaching_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($t_coaching_grid->kdprop->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_kdprop" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coaching" data-field="x_kdprop" data-value-separator="<?php echo $t_coaching_grid->kdprop->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_coaching_grid->RowIndex ?>_kdprop" name="x<?php echo $t_coaching_grid->RowIndex ?>_kdprop"<?php echo $t_coaching_grid->kdprop->editAttributes() ?>>
			<?php echo $t_coaching_grid->kdprop->selectOptionListHtml("x{$t_coaching_grid->RowIndex}_kdprop") ?>
		</select>
</div>
<?php echo $t_coaching_grid->kdprop->Lookup->getParamTag($t_coaching_grid, "p_x" . $t_coaching_grid->RowIndex . "_kdprop") ?>
</span>
<?php } ?>
<input type="hidden" data-table="t_coaching" data-field="x_kdprop" name="o<?php echo $t_coaching_grid->RowIndex ?>_kdprop" id="o<?php echo $t_coaching_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($t_coaching_grid->kdprop->OldValue) ?>">
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t_coaching_grid->kdprop->getSessionValue() != "") { ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_kdprop" class="form-group">
<span<?php echo $t_coaching_grid->kdprop->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coaching_grid->kdprop->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_coaching_grid->RowIndex ?>_kdprop" name="x<?php echo $t_coaching_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($t_coaching_grid->kdprop->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_kdprop" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coaching" data-field="x_kdprop" data-value-separator="<?php echo $t_coaching_grid->kdprop->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_coaching_grid->RowIndex ?>_kdprop" name="x<?php echo $t_coaching_grid->RowIndex ?>_kdprop"<?php echo $t_coaching_grid->kdprop->editAttributes() ?>>
			<?php echo $t_coaching_grid->kdprop->selectOptionListHtml("x{$t_coaching_grid->RowIndex}_kdprop") ?>
		</select>
</div>
<?php echo $t_coaching_grid->kdprop->Lookup->getParamTag($t_coaching_grid, "p_x" . $t_coaching_grid->RowIndex . "_kdprop") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_kdprop">
<span<?php echo $t_coaching_grid->kdprop->viewAttributes() ?>><?php echo $t_coaching_grid->kdprop->getViewValue() ?></span>
</span>
<?php if (!$t_coaching->isConfirm()) { ?>
<input type="hidden" data-table="t_coaching" data-field="x_kdprop" name="x<?php echo $t_coaching_grid->RowIndex ?>_kdprop" id="x<?php echo $t_coaching_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($t_coaching_grid->kdprop->FormValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_kdprop" name="o<?php echo $t_coaching_grid->RowIndex ?>_kdprop" id="o<?php echo $t_coaching_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($t_coaching_grid->kdprop->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coaching" data-field="x_kdprop" name="ft_coachinggrid$x<?php echo $t_coaching_grid->RowIndex ?>_kdprop" id="ft_coachinggrid$x<?php echo $t_coaching_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($t_coaching_grid->kdprop->FormValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_kdprop" name="ft_coachinggrid$o<?php echo $t_coaching_grid->RowIndex ?>_kdprop" id="ft_coachinggrid$o<?php echo $t_coaching_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($t_coaching_grid->kdprop->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coaching_grid->ketua->Visible) { // ketua ?>
		<td data-name="ketua" <?php echo $t_coaching_grid->ketua->cellAttributes() ?>>
<?php if ($t_coaching->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_ketua" class="form-group">
<?php
$onchange = $t_coaching_grid->ketua->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_coaching_grid->ketua->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_coaching_grid->RowIndex ?>_ketua">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $t_coaching_grid->RowIndex ?>_ketua" id="sv_x<?php echo $t_coaching_grid->RowIndex ?>_ketua" value="<?php echo RemoveHtml($t_coaching_grid->ketua->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($t_coaching_grid->ketua->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_coaching_grid->ketua->getPlaceHolder()) ?>"<?php echo $t_coaching_grid->ketua->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_coaching_grid->ketua->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $t_coaching_grid->RowIndex ?>_ketua',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($t_coaching_grid->ketua->ReadOnly || $t_coaching_grid->ketua->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_ketua" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_coaching_grid->ketua->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_coaching_grid->RowIndex ?>_ketua" id="x<?php echo $t_coaching_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($t_coaching_grid->ketua->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_coachinggrid"], function() {
	ft_coachinggrid.createAutoSuggest({"id":"x<?php echo $t_coaching_grid->RowIndex ?>_ketua","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $t_coaching_grid->ketua->Lookup->getParamTag($t_coaching_grid, "p_x" . $t_coaching_grid->RowIndex . "_ketua") ?>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_ketua" name="o<?php echo $t_coaching_grid->RowIndex ?>_ketua" id="o<?php echo $t_coaching_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($t_coaching_grid->ketua->OldValue) ?>">
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_ketua" class="form-group">
<?php
$onchange = $t_coaching_grid->ketua->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_coaching_grid->ketua->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_coaching_grid->RowIndex ?>_ketua">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $t_coaching_grid->RowIndex ?>_ketua" id="sv_x<?php echo $t_coaching_grid->RowIndex ?>_ketua" value="<?php echo RemoveHtml($t_coaching_grid->ketua->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($t_coaching_grid->ketua->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_coaching_grid->ketua->getPlaceHolder()) ?>"<?php echo $t_coaching_grid->ketua->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_coaching_grid->ketua->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $t_coaching_grid->RowIndex ?>_ketua',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($t_coaching_grid->ketua->ReadOnly || $t_coaching_grid->ketua->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_ketua" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_coaching_grid->ketua->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_coaching_grid->RowIndex ?>_ketua" id="x<?php echo $t_coaching_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($t_coaching_grid->ketua->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_coachinggrid"], function() {
	ft_coachinggrid.createAutoSuggest({"id":"x<?php echo $t_coaching_grid->RowIndex ?>_ketua","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $t_coaching_grid->ketua->Lookup->getParamTag($t_coaching_grid, "p_x" . $t_coaching_grid->RowIndex . "_ketua") ?>
</span>
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_ketua">
<span<?php echo $t_coaching_grid->ketua->viewAttributes() ?>><?php echo $t_coaching_grid->ketua->getViewValue() ?></span>
</span>
<?php if (!$t_coaching->isConfirm()) { ?>
<input type="hidden" data-table="t_coaching" data-field="x_ketua" name="x<?php echo $t_coaching_grid->RowIndex ?>_ketua" id="x<?php echo $t_coaching_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($t_coaching_grid->ketua->FormValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_ketua" name="o<?php echo $t_coaching_grid->RowIndex ?>_ketua" id="o<?php echo $t_coaching_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($t_coaching_grid->ketua->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coaching" data-field="x_ketua" name="ft_coachinggrid$x<?php echo $t_coaching_grid->RowIndex ?>_ketua" id="ft_coachinggrid$x<?php echo $t_coaching_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($t_coaching_grid->ketua->FormValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_ketua" name="ft_coachinggrid$o<?php echo $t_coaching_grid->RowIndex ?>_ketua" id="ft_coachinggrid$o<?php echo $t_coaching_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($t_coaching_grid->ketua->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coaching_grid->sekretaris->Visible) { // sekretaris ?>
		<td data-name="sekretaris" <?php echo $t_coaching_grid->sekretaris->cellAttributes() ?>>
<?php if ($t_coaching->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_sekretaris" class="form-group">
<?php
$onchange = $t_coaching_grid->sekretaris->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_coaching_grid->sekretaris->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" id="sv_x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" value="<?php echo RemoveHtml($t_coaching_grid->sekretaris->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($t_coaching_grid->sekretaris->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_coaching_grid->sekretaris->getPlaceHolder()) ?>"<?php echo $t_coaching_grid->sekretaris->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_coaching_grid->sekretaris->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($t_coaching_grid->sekretaris->ReadOnly || $t_coaching_grid->sekretaris->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_sekretaris" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_coaching_grid->sekretaris->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" id="x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($t_coaching_grid->sekretaris->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_coachinggrid"], function() {
	ft_coachinggrid.createAutoSuggest({"id":"x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $t_coaching_grid->sekretaris->Lookup->getParamTag($t_coaching_grid, "p_x" . $t_coaching_grid->RowIndex . "_sekretaris") ?>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_sekretaris" name="o<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" id="o<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($t_coaching_grid->sekretaris->OldValue) ?>">
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_sekretaris" class="form-group">
<?php
$onchange = $t_coaching_grid->sekretaris->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_coaching_grid->sekretaris->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" id="sv_x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" value="<?php echo RemoveHtml($t_coaching_grid->sekretaris->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($t_coaching_grid->sekretaris->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_coaching_grid->sekretaris->getPlaceHolder()) ?>"<?php echo $t_coaching_grid->sekretaris->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_coaching_grid->sekretaris->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($t_coaching_grid->sekretaris->ReadOnly || $t_coaching_grid->sekretaris->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_sekretaris" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_coaching_grid->sekretaris->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" id="x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($t_coaching_grid->sekretaris->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_coachinggrid"], function() {
	ft_coachinggrid.createAutoSuggest({"id":"x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $t_coaching_grid->sekretaris->Lookup->getParamTag($t_coaching_grid, "p_x" . $t_coaching_grid->RowIndex . "_sekretaris") ?>
</span>
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_sekretaris">
<span<?php echo $t_coaching_grid->sekretaris->viewAttributes() ?>><?php echo $t_coaching_grid->sekretaris->getViewValue() ?></span>
</span>
<?php if (!$t_coaching->isConfirm()) { ?>
<input type="hidden" data-table="t_coaching" data-field="x_sekretaris" name="x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" id="x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($t_coaching_grid->sekretaris->FormValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_sekretaris" name="o<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" id="o<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($t_coaching_grid->sekretaris->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coaching" data-field="x_sekretaris" name="ft_coachinggrid$x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" id="ft_coachinggrid$x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($t_coaching_grid->sekretaris->FormValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_sekretaris" name="ft_coachinggrid$o<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" id="ft_coachinggrid$o<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($t_coaching_grid->sekretaris->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coaching_grid->bendahara->Visible) { // bendahara ?>
		<td data-name="bendahara" <?php echo $t_coaching_grid->bendahara->cellAttributes() ?>>
<?php if ($t_coaching->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_bendahara" class="form-group">
<?php
$onchange = $t_coaching_grid->bendahara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_coaching_grid->bendahara->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_coaching_grid->RowIndex ?>_bendahara">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $t_coaching_grid->RowIndex ?>_bendahara" id="sv_x<?php echo $t_coaching_grid->RowIndex ?>_bendahara" value="<?php echo RemoveHtml($t_coaching_grid->bendahara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($t_coaching_grid->bendahara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_coaching_grid->bendahara->getPlaceHolder()) ?>"<?php echo $t_coaching_grid->bendahara->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_coaching_grid->bendahara->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $t_coaching_grid->RowIndex ?>_bendahara',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($t_coaching_grid->bendahara->ReadOnly || $t_coaching_grid->bendahara->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_bendahara" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_coaching_grid->bendahara->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_coaching_grid->RowIndex ?>_bendahara" id="x<?php echo $t_coaching_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($t_coaching_grid->bendahara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_coachinggrid"], function() {
	ft_coachinggrid.createAutoSuggest({"id":"x<?php echo $t_coaching_grid->RowIndex ?>_bendahara","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $t_coaching_grid->bendahara->Lookup->getParamTag($t_coaching_grid, "p_x" . $t_coaching_grid->RowIndex . "_bendahara") ?>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_bendahara" name="o<?php echo $t_coaching_grid->RowIndex ?>_bendahara" id="o<?php echo $t_coaching_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($t_coaching_grid->bendahara->OldValue) ?>">
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_bendahara" class="form-group">
<?php
$onchange = $t_coaching_grid->bendahara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_coaching_grid->bendahara->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_coaching_grid->RowIndex ?>_bendahara">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $t_coaching_grid->RowIndex ?>_bendahara" id="sv_x<?php echo $t_coaching_grid->RowIndex ?>_bendahara" value="<?php echo RemoveHtml($t_coaching_grid->bendahara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($t_coaching_grid->bendahara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_coaching_grid->bendahara->getPlaceHolder()) ?>"<?php echo $t_coaching_grid->bendahara->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_coaching_grid->bendahara->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $t_coaching_grid->RowIndex ?>_bendahara',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($t_coaching_grid->bendahara->ReadOnly || $t_coaching_grid->bendahara->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_bendahara" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_coaching_grid->bendahara->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_coaching_grid->RowIndex ?>_bendahara" id="x<?php echo $t_coaching_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($t_coaching_grid->bendahara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_coachinggrid"], function() {
	ft_coachinggrid.createAutoSuggest({"id":"x<?php echo $t_coaching_grid->RowIndex ?>_bendahara","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $t_coaching_grid->bendahara->Lookup->getParamTag($t_coaching_grid, "p_x" . $t_coaching_grid->RowIndex . "_bendahara") ?>
</span>
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_bendahara">
<span<?php echo $t_coaching_grid->bendahara->viewAttributes() ?>><?php echo $t_coaching_grid->bendahara->getViewValue() ?></span>
</span>
<?php if (!$t_coaching->isConfirm()) { ?>
<input type="hidden" data-table="t_coaching" data-field="x_bendahara" name="x<?php echo $t_coaching_grid->RowIndex ?>_bendahara" id="x<?php echo $t_coaching_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($t_coaching_grid->bendahara->FormValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_bendahara" name="o<?php echo $t_coaching_grid->RowIndex ?>_bendahara" id="o<?php echo $t_coaching_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($t_coaching_grid->bendahara->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coaching" data-field="x_bendahara" name="ft_coachinggrid$x<?php echo $t_coaching_grid->RowIndex ?>_bendahara" id="ft_coachinggrid$x<?php echo $t_coaching_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($t_coaching_grid->bendahara->FormValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_bendahara" name="ft_coachinggrid$o<?php echo $t_coaching_grid->RowIndex ?>_bendahara" id="ft_coachinggrid$o<?php echo $t_coaching_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($t_coaching_grid->bendahara->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coaching_grid->status->Visible) { // status ?>
		<td data-name="status" <?php echo $t_coaching_grid->status->cellAttributes() ?>>
<?php if ($t_coaching->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_status" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coaching" data-field="x_status" data-value-separator="<?php echo $t_coaching_grid->status->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_coaching_grid->RowIndex ?>_status" name="x<?php echo $t_coaching_grid->RowIndex ?>_status"<?php echo $t_coaching_grid->status->editAttributes() ?>>
			<?php echo $t_coaching_grid->status->selectOptionListHtml("x{$t_coaching_grid->RowIndex}_status") ?>
		</select>
</div>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_status" name="o<?php echo $t_coaching_grid->RowIndex ?>_status" id="o<?php echo $t_coaching_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($t_coaching_grid->status->OldValue) ?>">
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_status" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coaching" data-field="x_status" data-value-separator="<?php echo $t_coaching_grid->status->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_coaching_grid->RowIndex ?>_status" name="x<?php echo $t_coaching_grid->RowIndex ?>_status"<?php echo $t_coaching_grid->status->editAttributes() ?>>
			<?php echo $t_coaching_grid->status->selectOptionListHtml("x{$t_coaching_grid->RowIndex}_status") ?>
		</select>
</div>
</span>
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_status">
<span<?php echo $t_coaching_grid->status->viewAttributes() ?>><?php echo $t_coaching_grid->status->getViewValue() ?></span>
</span>
<?php if (!$t_coaching->isConfirm()) { ?>
<input type="hidden" data-table="t_coaching" data-field="x_status" name="x<?php echo $t_coaching_grid->RowIndex ?>_status" id="x<?php echo $t_coaching_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($t_coaching_grid->status->FormValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_status" name="o<?php echo $t_coaching_grid->RowIndex ?>_status" id="o<?php echo $t_coaching_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($t_coaching_grid->status->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coaching" data-field="x_status" name="ft_coachinggrid$x<?php echo $t_coaching_grid->RowIndex ?>_status" id="ft_coachinggrid$x<?php echo $t_coaching_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($t_coaching_grid->status->FormValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_status" name="ft_coachinggrid$o<?php echo $t_coaching_grid->RowIndex ?>_status" id="ft_coachinggrid$o<?php echo $t_coaching_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($t_coaching_grid->status->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_coaching_grid->jenisevaluasi->Visible) { // jenisevaluasi ?>
		<td data-name="jenisevaluasi" <?php echo $t_coaching_grid->jenisevaluasi->cellAttributes() ?>>
<?php if ($t_coaching->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_jenisevaluasi" class="form-group">
<div id="tp_x<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="t_coaching" data-field="x_jenisevaluasi" data-value-separator="<?php echo $t_coaching_grid->jenisevaluasi->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi[]" id="x<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi[]" value="{value}"<?php echo $t_coaching_grid->jenisevaluasi->editAttributes() ?>></div>
<div id="dsl_x<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi" data-repeatcolumn="1" class="ew-item-list d-none"><div>
<?php echo $t_coaching_grid->jenisevaluasi->checkBoxListHtml(FALSE, "x{$t_coaching_grid->RowIndex}_jenisevaluasi[]") ?>
</div></div>
<?php echo $t_coaching_grid->jenisevaluasi->Lookup->getParamTag($t_coaching_grid, "p_x" . $t_coaching_grid->RowIndex . "_jenisevaluasi") ?>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_jenisevaluasi" name="o<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi[]" id="o<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi[]" value="<?php echo HtmlEncode($t_coaching_grid->jenisevaluasi->OldValue) ?>">
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_jenisevaluasi" class="form-group">
<div id="tp_x<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="t_coaching" data-field="x_jenisevaluasi" data-value-separator="<?php echo $t_coaching_grid->jenisevaluasi->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi[]" id="x<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi[]" value="{value}"<?php echo $t_coaching_grid->jenisevaluasi->editAttributes() ?>></div>
<div id="dsl_x<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi" data-repeatcolumn="1" class="ew-item-list d-none"><div>
<?php echo $t_coaching_grid->jenisevaluasi->checkBoxListHtml(FALSE, "x{$t_coaching_grid->RowIndex}_jenisevaluasi[]") ?>
</div></div>
<?php echo $t_coaching_grid->jenisevaluasi->Lookup->getParamTag($t_coaching_grid, "p_x" . $t_coaching_grid->RowIndex . "_jenisevaluasi") ?>
</span>
<?php } ?>
<?php if ($t_coaching->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_coaching_grid->RowCount ?>_t_coaching_jenisevaluasi">
<span<?php echo $t_coaching_grid->jenisevaluasi->viewAttributes() ?>><?php echo $t_coaching_grid->jenisevaluasi->getViewValue() ?></span>
</span>
<?php if (!$t_coaching->isConfirm()) { ?>
<input type="hidden" data-table="t_coaching" data-field="x_jenisevaluasi" name="x<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi" id="x<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi" value="<?php echo HtmlEncode($t_coaching_grid->jenisevaluasi->FormValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_jenisevaluasi" name="o<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi[]" id="o<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi[]" value="<?php echo HtmlEncode($t_coaching_grid->jenisevaluasi->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_coaching" data-field="x_jenisevaluasi" name="ft_coachinggrid$x<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi" id="ft_coachinggrid$x<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi" value="<?php echo HtmlEncode($t_coaching_grid->jenisevaluasi->FormValue) ?>">
<input type="hidden" data-table="t_coaching" data-field="x_jenisevaluasi" name="ft_coachinggrid$o<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi[]" id="ft_coachinggrid$o<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi[]" value="<?php echo HtmlEncode($t_coaching_grid->jenisevaluasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_coaching_grid->ListOptions->render("body", "right", $t_coaching_grid->RowCount);
?>
	</tr>
<?php if ($t_coaching->RowType == ROWTYPE_ADD || $t_coaching->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_coachinggrid", "load"], function() {
	ft_coachinggrid.updateLists(<?php echo $t_coaching_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_coaching_grid->isGridAdd() || $t_coaching->CurrentMode == "copy")
		if (!$t_coaching_grid->Recordset->EOF)
			$t_coaching_grid->Recordset->moveNext();
}
?>
<?php
	if ($t_coaching->CurrentMode == "add" || $t_coaching->CurrentMode == "copy" || $t_coaching->CurrentMode == "edit") {
		$t_coaching_grid->RowIndex = '$rowindex$';
		$t_coaching_grid->loadRowValues();

		// Set row properties
		$t_coaching->resetAttributes();
		$t_coaching->RowAttrs->merge(["data-rowindex" => $t_coaching_grid->RowIndex, "id" => "r0_t_coaching", "data-rowtype" => ROWTYPE_ADD]);
		$t_coaching->RowAttrs->appendClass("ew-template");
		$t_coaching->RowType = ROWTYPE_ADD;

		// Render row
		$t_coaching_grid->renderRow();

		// Render list options
		$t_coaching_grid->renderListOptions();
		$t_coaching_grid->StartRowCount = 0;
?>
	<tr <?php echo $t_coaching->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_coaching_grid->ListOptions->render("body", "left", $t_coaching_grid->RowIndex);
?>
	<?php if ($t_coaching_grid->kdtahapan->Visible) { // kdtahapan ?>
		<td data-name="kdtahapan">
<?php if (!$t_coaching->isConfirm()) { ?>
<span id="el$rowindex$_t_coaching_kdtahapan" class="form-group t_coaching_kdtahapan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coaching" data-field="x_kdtahapan" data-value-separator="<?php echo $t_coaching_grid->kdtahapan->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_coaching_grid->RowIndex ?>_kdtahapan" name="x<?php echo $t_coaching_grid->RowIndex ?>_kdtahapan"<?php echo $t_coaching_grid->kdtahapan->editAttributes() ?>>
			<?php echo $t_coaching_grid->kdtahapan->selectOptionListHtml("x{$t_coaching_grid->RowIndex}_kdtahapan") ?>
		</select>
</div>
<?php echo $t_coaching_grid->kdtahapan->Lookup->getParamTag($t_coaching_grid, "p_x" . $t_coaching_grid->RowIndex . "_kdtahapan") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coaching_kdtahapan" class="form-group t_coaching_kdtahapan">
<span<?php echo $t_coaching_grid->kdtahapan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coaching_grid->kdtahapan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_kdtahapan" name="x<?php echo $t_coaching_grid->RowIndex ?>_kdtahapan" id="x<?php echo $t_coaching_grid->RowIndex ?>_kdtahapan" value="<?php echo HtmlEncode($t_coaching_grid->kdtahapan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coaching" data-field="x_kdtahapan" name="o<?php echo $t_coaching_grid->RowIndex ?>_kdtahapan" id="o<?php echo $t_coaching_grid->RowIndex ?>_kdtahapan" value="<?php echo HtmlEncode($t_coaching_grid->kdtahapan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coaching_grid->kdkursil->Visible) { // kdkursil ?>
		<td data-name="kdkursil">
<?php if (!$t_coaching->isConfirm()) { ?>
<span id="el$rowindex$_t_coaching_kdkursil" class="form-group t_coaching_kdkursil">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coaching" data-field="x_kdkursil" data-value-separator="<?php echo $t_coaching_grid->kdkursil->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_coaching_grid->RowIndex ?>_kdkursil" name="x<?php echo $t_coaching_grid->RowIndex ?>_kdkursil"<?php echo $t_coaching_grid->kdkursil->editAttributes() ?>>
			<?php echo $t_coaching_grid->kdkursil->selectOptionListHtml("x{$t_coaching_grid->RowIndex}_kdkursil") ?>
		</select>
</div>
<?php echo $t_coaching_grid->kdkursil->Lookup->getParamTag($t_coaching_grid, "p_x" . $t_coaching_grid->RowIndex . "_kdkursil") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coaching_kdkursil" class="form-group t_coaching_kdkursil">
<span<?php echo $t_coaching_grid->kdkursil->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coaching_grid->kdkursil->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_kdkursil" name="x<?php echo $t_coaching_grid->RowIndex ?>_kdkursil" id="x<?php echo $t_coaching_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_coaching_grid->kdkursil->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coaching" data-field="x_kdkursil" name="o<?php echo $t_coaching_grid->RowIndex ?>_kdkursil" id="o<?php echo $t_coaching_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_coaching_grid->kdkursil->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coaching_grid->tawal->Visible) { // tawal ?>
		<td data-name="tawal">
<?php if (!$t_coaching->isConfirm()) { ?>
<span id="el$rowindex$_t_coaching_tawal" class="form-group t_coaching_tawal">
<input type="text" data-table="t_coaching" data-field="x_tawal" name="x<?php echo $t_coaching_grid->RowIndex ?>_tawal" id="x<?php echo $t_coaching_grid->RowIndex ?>_tawal" size="10" placeholder="<?php echo HtmlEncode($t_coaching_grid->tawal->getPlaceHolder()) ?>" value="<?php echo $t_coaching_grid->tawal->EditValue ?>"<?php echo $t_coaching_grid->tawal->editAttributes() ?>>
<?php if (!$t_coaching_grid->tawal->ReadOnly && !$t_coaching_grid->tawal->Disabled && !isset($t_coaching_grid->tawal->EditAttrs["readonly"]) && !isset($t_coaching_grid->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_coachinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_coachinggrid", "x<?php echo $t_coaching_grid->RowIndex ?>_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coaching_tawal" class="form-group t_coaching_tawal">
<span<?php echo $t_coaching_grid->tawal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coaching_grid->tawal->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_tawal" name="x<?php echo $t_coaching_grid->RowIndex ?>_tawal" id="x<?php echo $t_coaching_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($t_coaching_grid->tawal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coaching" data-field="x_tawal" name="o<?php echo $t_coaching_grid->RowIndex ?>_tawal" id="o<?php echo $t_coaching_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($t_coaching_grid->tawal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coaching_grid->takhir->Visible) { // takhir ?>
		<td data-name="takhir">
<?php if (!$t_coaching->isConfirm()) { ?>
<span id="el$rowindex$_t_coaching_takhir" class="form-group t_coaching_takhir">
<input type="text" data-table="t_coaching" data-field="x_takhir" name="x<?php echo $t_coaching_grid->RowIndex ?>_takhir" id="x<?php echo $t_coaching_grid->RowIndex ?>_takhir" size="10" placeholder="<?php echo HtmlEncode($t_coaching_grid->takhir->getPlaceHolder()) ?>" value="<?php echo $t_coaching_grid->takhir->EditValue ?>"<?php echo $t_coaching_grid->takhir->editAttributes() ?>>
<?php if (!$t_coaching_grid->takhir->ReadOnly && !$t_coaching_grid->takhir->Disabled && !isset($t_coaching_grid->takhir->EditAttrs["readonly"]) && !isset($t_coaching_grid->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_coachinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_coachinggrid", "x<?php echo $t_coaching_grid->RowIndex ?>_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coaching_takhir" class="form-group t_coaching_takhir">
<span<?php echo $t_coaching_grid->takhir->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coaching_grid->takhir->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_takhir" name="x<?php echo $t_coaching_grid->RowIndex ?>_takhir" id="x<?php echo $t_coaching_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($t_coaching_grid->takhir->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coaching" data-field="x_takhir" name="o<?php echo $t_coaching_grid->RowIndex ?>_takhir" id="o<?php echo $t_coaching_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($t_coaching_grid->takhir->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coaching_grid->jmlhari->Visible) { // jmlhari ?>
		<td data-name="jmlhari">
<?php if (!$t_coaching->isConfirm()) { ?>
<span id="el$rowindex$_t_coaching_jmlhari" class="form-group t_coaching_jmlhari">
<input type="text" data-table="t_coaching" data-field="x_jmlhari" name="x<?php echo $t_coaching_grid->RowIndex ?>_jmlhari" id="x<?php echo $t_coaching_grid->RowIndex ?>_jmlhari" size="5" maxlength="5" placeholder="<?php echo HtmlEncode($t_coaching_grid->jmlhari->getPlaceHolder()) ?>" value="<?php echo $t_coaching_grid->jmlhari->EditValue ?>"<?php echo $t_coaching_grid->jmlhari->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coaching_jmlhari" class="form-group t_coaching_jmlhari">
<span<?php echo $t_coaching_grid->jmlhari->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coaching_grid->jmlhari->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_jmlhari" name="x<?php echo $t_coaching_grid->RowIndex ?>_jmlhari" id="x<?php echo $t_coaching_grid->RowIndex ?>_jmlhari" value="<?php echo HtmlEncode($t_coaching_grid->jmlhari->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coaching" data-field="x_jmlhari" name="o<?php echo $t_coaching_grid->RowIndex ?>_jmlhari" id="o<?php echo $t_coaching_grid->RowIndex ?>_jmlhari" value="<?php echo HtmlEncode($t_coaching_grid->jmlhari->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coaching_grid->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop">
<?php if (!$t_coaching->isConfirm()) { ?>
<?php if ($t_coaching_grid->kdprop->getSessionValue() != "") { ?>
<span id="el$rowindex$_t_coaching_kdprop" class="form-group t_coaching_kdprop">
<span<?php echo $t_coaching_grid->kdprop->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coaching_grid->kdprop->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_coaching_grid->RowIndex ?>_kdprop" name="x<?php echo $t_coaching_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($t_coaching_grid->kdprop->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_coaching_kdprop" class="form-group t_coaching_kdprop">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coaching" data-field="x_kdprop" data-value-separator="<?php echo $t_coaching_grid->kdprop->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_coaching_grid->RowIndex ?>_kdprop" name="x<?php echo $t_coaching_grid->RowIndex ?>_kdprop"<?php echo $t_coaching_grid->kdprop->editAttributes() ?>>
			<?php echo $t_coaching_grid->kdprop->selectOptionListHtml("x{$t_coaching_grid->RowIndex}_kdprop") ?>
		</select>
</div>
<?php echo $t_coaching_grid->kdprop->Lookup->getParamTag($t_coaching_grid, "p_x" . $t_coaching_grid->RowIndex . "_kdprop") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t_coaching_kdprop" class="form-group t_coaching_kdprop">
<span<?php echo $t_coaching_grid->kdprop->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coaching_grid->kdprop->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_kdprop" name="x<?php echo $t_coaching_grid->RowIndex ?>_kdprop" id="x<?php echo $t_coaching_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($t_coaching_grid->kdprop->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coaching" data-field="x_kdprop" name="o<?php echo $t_coaching_grid->RowIndex ?>_kdprop" id="o<?php echo $t_coaching_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($t_coaching_grid->kdprop->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coaching_grid->ketua->Visible) { // ketua ?>
		<td data-name="ketua">
<?php if (!$t_coaching->isConfirm()) { ?>
<span id="el$rowindex$_t_coaching_ketua" class="form-group t_coaching_ketua">
<?php
$onchange = $t_coaching_grid->ketua->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_coaching_grid->ketua->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_coaching_grid->RowIndex ?>_ketua">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $t_coaching_grid->RowIndex ?>_ketua" id="sv_x<?php echo $t_coaching_grid->RowIndex ?>_ketua" value="<?php echo RemoveHtml($t_coaching_grid->ketua->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($t_coaching_grid->ketua->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_coaching_grid->ketua->getPlaceHolder()) ?>"<?php echo $t_coaching_grid->ketua->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_coaching_grid->ketua->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $t_coaching_grid->RowIndex ?>_ketua',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($t_coaching_grid->ketua->ReadOnly || $t_coaching_grid->ketua->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_ketua" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_coaching_grid->ketua->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_coaching_grid->RowIndex ?>_ketua" id="x<?php echo $t_coaching_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($t_coaching_grid->ketua->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_coachinggrid"], function() {
	ft_coachinggrid.createAutoSuggest({"id":"x<?php echo $t_coaching_grid->RowIndex ?>_ketua","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $t_coaching_grid->ketua->Lookup->getParamTag($t_coaching_grid, "p_x" . $t_coaching_grid->RowIndex . "_ketua") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coaching_ketua" class="form-group t_coaching_ketua">
<span<?php echo $t_coaching_grid->ketua->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coaching_grid->ketua->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_ketua" name="x<?php echo $t_coaching_grid->RowIndex ?>_ketua" id="x<?php echo $t_coaching_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($t_coaching_grid->ketua->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coaching" data-field="x_ketua" name="o<?php echo $t_coaching_grid->RowIndex ?>_ketua" id="o<?php echo $t_coaching_grid->RowIndex ?>_ketua" value="<?php echo HtmlEncode($t_coaching_grid->ketua->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coaching_grid->sekretaris->Visible) { // sekretaris ?>
		<td data-name="sekretaris">
<?php if (!$t_coaching->isConfirm()) { ?>
<span id="el$rowindex$_t_coaching_sekretaris" class="form-group t_coaching_sekretaris">
<?php
$onchange = $t_coaching_grid->sekretaris->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_coaching_grid->sekretaris->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" id="sv_x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" value="<?php echo RemoveHtml($t_coaching_grid->sekretaris->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($t_coaching_grid->sekretaris->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_coaching_grid->sekretaris->getPlaceHolder()) ?>"<?php echo $t_coaching_grid->sekretaris->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_coaching_grid->sekretaris->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($t_coaching_grid->sekretaris->ReadOnly || $t_coaching_grid->sekretaris->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_sekretaris" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_coaching_grid->sekretaris->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" id="x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($t_coaching_grid->sekretaris->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_coachinggrid"], function() {
	ft_coachinggrid.createAutoSuggest({"id":"x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $t_coaching_grid->sekretaris->Lookup->getParamTag($t_coaching_grid, "p_x" . $t_coaching_grid->RowIndex . "_sekretaris") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coaching_sekretaris" class="form-group t_coaching_sekretaris">
<span<?php echo $t_coaching_grid->sekretaris->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coaching_grid->sekretaris->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_sekretaris" name="x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" id="x<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($t_coaching_grid->sekretaris->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coaching" data-field="x_sekretaris" name="o<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" id="o<?php echo $t_coaching_grid->RowIndex ?>_sekretaris" value="<?php echo HtmlEncode($t_coaching_grid->sekretaris->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coaching_grid->bendahara->Visible) { // bendahara ?>
		<td data-name="bendahara">
<?php if (!$t_coaching->isConfirm()) { ?>
<span id="el$rowindex$_t_coaching_bendahara" class="form-group t_coaching_bendahara">
<?php
$onchange = $t_coaching_grid->bendahara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_coaching_grid->bendahara->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_coaching_grid->RowIndex ?>_bendahara">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $t_coaching_grid->RowIndex ?>_bendahara" id="sv_x<?php echo $t_coaching_grid->RowIndex ?>_bendahara" value="<?php echo RemoveHtml($t_coaching_grid->bendahara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($t_coaching_grid->bendahara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_coaching_grid->bendahara->getPlaceHolder()) ?>"<?php echo $t_coaching_grid->bendahara->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_coaching_grid->bendahara->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $t_coaching_grid->RowIndex ?>_bendahara',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($t_coaching_grid->bendahara->ReadOnly || $t_coaching_grid->bendahara->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_bendahara" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_coaching_grid->bendahara->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_coaching_grid->RowIndex ?>_bendahara" id="x<?php echo $t_coaching_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($t_coaching_grid->bendahara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_coachinggrid"], function() {
	ft_coachinggrid.createAutoSuggest({"id":"x<?php echo $t_coaching_grid->RowIndex ?>_bendahara","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $t_coaching_grid->bendahara->Lookup->getParamTag($t_coaching_grid, "p_x" . $t_coaching_grid->RowIndex . "_bendahara") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coaching_bendahara" class="form-group t_coaching_bendahara">
<span<?php echo $t_coaching_grid->bendahara->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coaching_grid->bendahara->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_bendahara" name="x<?php echo $t_coaching_grid->RowIndex ?>_bendahara" id="x<?php echo $t_coaching_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($t_coaching_grid->bendahara->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coaching" data-field="x_bendahara" name="o<?php echo $t_coaching_grid->RowIndex ?>_bendahara" id="o<?php echo $t_coaching_grid->RowIndex ?>_bendahara" value="<?php echo HtmlEncode($t_coaching_grid->bendahara->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coaching_grid->status->Visible) { // status ?>
		<td data-name="status">
<?php if (!$t_coaching->isConfirm()) { ?>
<span id="el$rowindex$_t_coaching_status" class="form-group t_coaching_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coaching" data-field="x_status" data-value-separator="<?php echo $t_coaching_grid->status->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_coaching_grid->RowIndex ?>_status" name="x<?php echo $t_coaching_grid->RowIndex ?>_status"<?php echo $t_coaching_grid->status->editAttributes() ?>>
			<?php echo $t_coaching_grid->status->selectOptionListHtml("x{$t_coaching_grid->RowIndex}_status") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coaching_status" class="form-group t_coaching_status">
<span<?php echo $t_coaching_grid->status->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coaching_grid->status->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_status" name="x<?php echo $t_coaching_grid->RowIndex ?>_status" id="x<?php echo $t_coaching_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($t_coaching_grid->status->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coaching" data-field="x_status" name="o<?php echo $t_coaching_grid->RowIndex ?>_status" id="o<?php echo $t_coaching_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($t_coaching_grid->status->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_coaching_grid->jenisevaluasi->Visible) { // jenisevaluasi ?>
		<td data-name="jenisevaluasi">
<?php if (!$t_coaching->isConfirm()) { ?>
<span id="el$rowindex$_t_coaching_jenisevaluasi" class="form-group t_coaching_jenisevaluasi">
<div id="tp_x<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="t_coaching" data-field="x_jenisevaluasi" data-value-separator="<?php echo $t_coaching_grid->jenisevaluasi->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi[]" id="x<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi[]" value="{value}"<?php echo $t_coaching_grid->jenisevaluasi->editAttributes() ?>></div>
<div id="dsl_x<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi" data-repeatcolumn="1" class="ew-item-list d-none"><div>
<?php echo $t_coaching_grid->jenisevaluasi->checkBoxListHtml(FALSE, "x{$t_coaching_grid->RowIndex}_jenisevaluasi[]") ?>
</div></div>
<?php echo $t_coaching_grid->jenisevaluasi->Lookup->getParamTag($t_coaching_grid, "p_x" . $t_coaching_grid->RowIndex . "_jenisevaluasi") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_coaching_jenisevaluasi" class="form-group t_coaching_jenisevaluasi">
<span<?php echo $t_coaching_grid->jenisevaluasi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coaching_grid->jenisevaluasi->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_jenisevaluasi" name="x<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi" id="x<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi" value="<?php echo HtmlEncode($t_coaching_grid->jenisevaluasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_coaching" data-field="x_jenisevaluasi" name="o<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi[]" id="o<?php echo $t_coaching_grid->RowIndex ?>_jenisevaluasi[]" value="<?php echo HtmlEncode($t_coaching_grid->jenisevaluasi->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_coaching_grid->ListOptions->render("body", "right", $t_coaching_grid->RowIndex);
?>
<script>
loadjs.ready(["ft_coachinggrid", "load"], function() {
	ft_coachinggrid.updateLists(<?php echo $t_coaching_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($t_coaching->CurrentMode == "add" || $t_coaching->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $t_coaching_grid->FormKeyCountName ?>" id="<?php echo $t_coaching_grid->FormKeyCountName ?>" value="<?php echo $t_coaching_grid->KeyCount ?>">
<?php echo $t_coaching_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_coaching->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $t_coaching_grid->FormKeyCountName ?>" id="<?php echo $t_coaching_grid->FormKeyCountName ?>" value="<?php echo $t_coaching_grid->KeyCount ?>">
<?php echo $t_coaching_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_coaching->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_coachinggrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_coaching_grid->Recordset)
	$t_coaching_grid->Recordset->Close();
?>
<?php if ($t_coaching_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $t_coaching_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_coaching_grid->TotalRecords == 0 && !$t_coaching->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_coaching_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$t_coaching_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$t_coaching_grid->terminate();
?>