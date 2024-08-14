<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($t_peserta_grid))
	$t_peserta_grid = new t_peserta_grid();

// Run the page
$t_peserta_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_peserta_grid->Page_Render();
?>
<?php if (!$t_peserta_grid->isExport()) { ?>
<script>
var ft_pesertagrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	ft_pesertagrid = new ew.Form("ft_pesertagrid", "grid");
	ft_pesertagrid.formKeyCountName = '<?php echo $t_peserta_grid->FormKeyCountName ?>';

	// Validate form
	ft_pesertagrid.validate = function() {
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
			<?php if ($t_peserta_grid->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_grid->id->caption(), $t_peserta_grid->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_grid->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_grid->nama->caption(), $t_peserta_grid->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_grid->idp->Required) { ?>
				elm = this.getElements("x" + infix + "_idp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_grid->idp->caption(), $t_peserta_grid->idp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_grid->tempat->Required) { ?>
				elm = this.getElements("x" + infix + "_tempat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_grid->tempat->caption(), $t_peserta_grid->tempat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_grid->kdagama->Required) { ?>
				elm = this.getElements("x" + infix + "_kdagama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_grid->kdagama->caption(), $t_peserta_grid->kdagama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_grid->kdsex->Required) { ?>
				elm = this.getElements("x" + infix + "_kdsex");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_grid->kdsex->caption(), $t_peserta_grid->kdsex->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_grid->kdprop->Required) { ?>
				elm = this.getElements("x" + infix + "_kdprop");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_grid->kdprop->caption(), $t_peserta_grid->kdprop->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_grid->kdkota->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkota");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_grid->kdkota->caption(), $t_peserta_grid->kdkota->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_grid->kdkec->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkec");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_grid->kdkec->caption(), $t_peserta_grid->kdkec->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_grid->alamat->Required) { ?>
				elm = this.getElements("x" + infix + "_alamat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_grid->alamat->caption(), $t_peserta_grid->alamat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_grid->telp->Required) { ?>
				elm = this.getElements("x" + infix + "_telp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_grid->telp->caption(), $t_peserta_grid->telp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_grid->hp->Required) { ?>
				elm = this.getElements("x" + infix + "_hp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_grid->hp->caption(), $t_peserta_grid->hp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_grid->kdjabat->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjabat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_grid->kdjabat->caption(), $t_peserta_grid->kdjabat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_grid->kdpend->Required) { ?>
				elm = this.getElements("x" + infix + "_kdpend");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_grid->kdpend->caption(), $t_peserta_grid->kdpend->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_grid->kdbahasa->Required) { ?>
				elm = this.getElements("x" + infix + "_kdbahasa");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_grid->kdbahasa->caption(), $t_peserta_grid->kdbahasa->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_grid->jpelatihan->Required) { ?>
				elm = this.getElements("x" + infix + "_jpelatihan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_grid->jpelatihan->caption(), $t_peserta_grid->jpelatihan->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	ft_pesertagrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "nama", false)) return false;
		if (ew.valueChanged(fobj, infix, "idp", false)) return false;
		if (ew.valueChanged(fobj, infix, "tempat", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdagama", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdsex", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdprop", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdkota", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdkec", false)) return false;
		if (ew.valueChanged(fobj, infix, "alamat", false)) return false;
		if (ew.valueChanged(fobj, infix, "telp", false)) return false;
		if (ew.valueChanged(fobj, infix, "hp", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdjabat", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdpend", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdbahasa", false)) return false;
		if (ew.valueChanged(fobj, infix, "jpelatihan", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_pesertagrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_pesertagrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_pesertagrid.lists["x_id"] = <?php echo $t_peserta_grid->id->Lookup->toClientList($t_peserta_grid) ?>;
	ft_pesertagrid.lists["x_id"].options = <?php echo JsonEncode($t_peserta_grid->id->lookupOptions()) ?>;
	ft_pesertagrid.autoSuggests["x_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pesertagrid.lists["x_idp"] = <?php echo $t_peserta_grid->idp->Lookup->toClientList($t_peserta_grid) ?>;
	ft_pesertagrid.lists["x_idp"].options = <?php echo JsonEncode($t_peserta_grid->idp->lookupOptions()) ?>;
	ft_pesertagrid.autoSuggests["x_idp"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pesertagrid.lists["x_kdagama"] = <?php echo $t_peserta_grid->kdagama->Lookup->toClientList($t_peserta_grid) ?>;
	ft_pesertagrid.lists["x_kdagama"].options = <?php echo JsonEncode($t_peserta_grid->kdagama->lookupOptions()) ?>;
	ft_pesertagrid.lists["x_kdsex"] = <?php echo $t_peserta_grid->kdsex->Lookup->toClientList($t_peserta_grid) ?>;
	ft_pesertagrid.lists["x_kdsex"].options = <?php echo JsonEncode($t_peserta_grid->kdsex->options(FALSE, TRUE)) ?>;
	ft_pesertagrid.lists["x_kdprop"] = <?php echo $t_peserta_grid->kdprop->Lookup->toClientList($t_peserta_grid) ?>;
	ft_pesertagrid.lists["x_kdprop"].options = <?php echo JsonEncode($t_peserta_grid->kdprop->lookupOptions()) ?>;
	ft_pesertagrid.lists["x_kdkota"] = <?php echo $t_peserta_grid->kdkota->Lookup->toClientList($t_peserta_grid) ?>;
	ft_pesertagrid.lists["x_kdkota"].options = <?php echo JsonEncode($t_peserta_grid->kdkota->lookupOptions()) ?>;
	ft_pesertagrid.lists["x_kdkec"] = <?php echo $t_peserta_grid->kdkec->Lookup->toClientList($t_peserta_grid) ?>;
	ft_pesertagrid.lists["x_kdkec"].options = <?php echo JsonEncode($t_peserta_grid->kdkec->lookupOptions()) ?>;
	ft_pesertagrid.lists["x_kdjabat"] = <?php echo $t_peserta_grid->kdjabat->Lookup->toClientList($t_peserta_grid) ?>;
	ft_pesertagrid.lists["x_kdjabat"].options = <?php echo JsonEncode($t_peserta_grid->kdjabat->lookupOptions()) ?>;
	ft_pesertagrid.lists["x_kdpend"] = <?php echo $t_peserta_grid->kdpend->Lookup->toClientList($t_peserta_grid) ?>;
	ft_pesertagrid.lists["x_kdpend"].options = <?php echo JsonEncode($t_peserta_grid->kdpend->lookupOptions()) ?>;
	ft_pesertagrid.lists["x_kdbahasa"] = <?php echo $t_peserta_grid->kdbahasa->Lookup->toClientList($t_peserta_grid) ?>;
	ft_pesertagrid.lists["x_kdbahasa"].options = <?php echo JsonEncode($t_peserta_grid->kdbahasa->lookupOptions()) ?>;
	loadjs.done("ft_pesertagrid");
});
</script>
<script>
ew.ready("head", "js/ewfixedheadertable.js", "fixedheadertable");
</script>
<?php } ?>
<?php
$t_peserta_grid->renderOtherOptions();
?>
<?php if ($t_peserta_grid->TotalRecords > 0 || $t_peserta->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_peserta_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_peserta">
<?php if ($t_peserta_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $t_peserta_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ft_pesertagrid" class="ew-form ew-list-form form-inline">
<div id="gmp_t_peserta" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_t_pesertagrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_peserta->RowType = ROWTYPE_HEADER;

// Render list options
$t_peserta_grid->renderListOptions();

// Render list options (header, left)
$t_peserta_grid->ListOptions->render("header", "left");
?>
<?php if ($t_peserta_grid->id->Visible) { // id ?>
	<?php if ($t_peserta_grid->SortUrl($t_peserta_grid->id) == "") { ?>
		<th data-name="id" class="<?php echo $t_peserta_grid->id->headerCellClass() ?>"><div id="elh_t_peserta_id" class="t_peserta_id"><div class="ew-table-header-caption"><?php echo $t_peserta_grid->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $t_peserta_grid->id->headerCellClass() ?>"><div><div id="elh_t_peserta_id" class="t_peserta_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_grid->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_grid->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_grid->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_grid->nama->Visible) { // nama ?>
	<?php if ($t_peserta_grid->SortUrl($t_peserta_grid->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $t_peserta_grid->nama->headerCellClass() ?>"><div id="elh_t_peserta_nama" class="t_peserta_nama"><div class="ew-table-header-caption"><?php echo $t_peserta_grid->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $t_peserta_grid->nama->headerCellClass() ?>"><div><div id="elh_t_peserta_nama" class="t_peserta_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_grid->nama->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_grid->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_grid->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_grid->idp->Visible) { // idp ?>
	<?php if ($t_peserta_grid->SortUrl($t_peserta_grid->idp) == "") { ?>
		<th data-name="idp" class="<?php echo $t_peserta_grid->idp->headerCellClass() ?>"><div id="elh_t_peserta_idp" class="t_peserta_idp"><div class="ew-table-header-caption"><?php echo $t_peserta_grid->idp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idp" class="<?php echo $t_peserta_grid->idp->headerCellClass() ?>"><div><div id="elh_t_peserta_idp" class="t_peserta_idp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_grid->idp->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_grid->idp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_grid->idp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_grid->tempat->Visible) { // tempat ?>
	<?php if ($t_peserta_grid->SortUrl($t_peserta_grid->tempat) == "") { ?>
		<th data-name="tempat" class="<?php echo $t_peserta_grid->tempat->headerCellClass() ?>"><div id="elh_t_peserta_tempat" class="t_peserta_tempat"><div class="ew-table-header-caption"><?php echo $t_peserta_grid->tempat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tempat" class="<?php echo $t_peserta_grid->tempat->headerCellClass() ?>"><div><div id="elh_t_peserta_tempat" class="t_peserta_tempat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_grid->tempat->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_grid->tempat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_grid->tempat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_grid->kdagama->Visible) { // kdagama ?>
	<?php if ($t_peserta_grid->SortUrl($t_peserta_grid->kdagama) == "") { ?>
		<th data-name="kdagama" class="<?php echo $t_peserta_grid->kdagama->headerCellClass() ?>"><div id="elh_t_peserta_kdagama" class="t_peserta_kdagama"><div class="ew-table-header-caption"><?php echo $t_peserta_grid->kdagama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdagama" class="<?php echo $t_peserta_grid->kdagama->headerCellClass() ?>"><div><div id="elh_t_peserta_kdagama" class="t_peserta_kdagama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_grid->kdagama->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_grid->kdagama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_grid->kdagama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_grid->kdsex->Visible) { // kdsex ?>
	<?php if ($t_peserta_grid->SortUrl($t_peserta_grid->kdsex) == "") { ?>
		<th data-name="kdsex" class="<?php echo $t_peserta_grid->kdsex->headerCellClass() ?>"><div id="elh_t_peserta_kdsex" class="t_peserta_kdsex"><div class="ew-table-header-caption"><?php echo $t_peserta_grid->kdsex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdsex" class="<?php echo $t_peserta_grid->kdsex->headerCellClass() ?>"><div><div id="elh_t_peserta_kdsex" class="t_peserta_kdsex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_grid->kdsex->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_grid->kdsex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_grid->kdsex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_grid->kdprop->Visible) { // kdprop ?>
	<?php if ($t_peserta_grid->SortUrl($t_peserta_grid->kdprop) == "") { ?>
		<th data-name="kdprop" class="<?php echo $t_peserta_grid->kdprop->headerCellClass() ?>"><div id="elh_t_peserta_kdprop" class="t_peserta_kdprop"><div class="ew-table-header-caption"><?php echo $t_peserta_grid->kdprop->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdprop" class="<?php echo $t_peserta_grid->kdprop->headerCellClass() ?>"><div><div id="elh_t_peserta_kdprop" class="t_peserta_kdprop">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_grid->kdprop->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_grid->kdprop->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_grid->kdprop->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_grid->kdkota->Visible) { // kdkota ?>
	<?php if ($t_peserta_grid->SortUrl($t_peserta_grid->kdkota) == "") { ?>
		<th data-name="kdkota" class="<?php echo $t_peserta_grid->kdkota->headerCellClass() ?>"><div id="elh_t_peserta_kdkota" class="t_peserta_kdkota"><div class="ew-table-header-caption"><?php echo $t_peserta_grid->kdkota->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkota" class="<?php echo $t_peserta_grid->kdkota->headerCellClass() ?>"><div><div id="elh_t_peserta_kdkota" class="t_peserta_kdkota">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_grid->kdkota->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_grid->kdkota->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_grid->kdkota->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_grid->kdkec->Visible) { // kdkec ?>
	<?php if ($t_peserta_grid->SortUrl($t_peserta_grid->kdkec) == "") { ?>
		<th data-name="kdkec" class="<?php echo $t_peserta_grid->kdkec->headerCellClass() ?>"><div id="elh_t_peserta_kdkec" class="t_peserta_kdkec"><div class="ew-table-header-caption"><?php echo $t_peserta_grid->kdkec->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkec" class="<?php echo $t_peserta_grid->kdkec->headerCellClass() ?>"><div><div id="elh_t_peserta_kdkec" class="t_peserta_kdkec">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_grid->kdkec->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_grid->kdkec->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_grid->kdkec->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_grid->alamat->Visible) { // alamat ?>
	<?php if ($t_peserta_grid->SortUrl($t_peserta_grid->alamat) == "") { ?>
		<th data-name="alamat" class="<?php echo $t_peserta_grid->alamat->headerCellClass() ?>"><div id="elh_t_peserta_alamat" class="t_peserta_alamat"><div class="ew-table-header-caption"><?php echo $t_peserta_grid->alamat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="alamat" class="<?php echo $t_peserta_grid->alamat->headerCellClass() ?>"><div><div id="elh_t_peserta_alamat" class="t_peserta_alamat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_grid->alamat->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_grid->alamat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_grid->alamat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_grid->telp->Visible) { // telp ?>
	<?php if ($t_peserta_grid->SortUrl($t_peserta_grid->telp) == "") { ?>
		<th data-name="telp" class="<?php echo $t_peserta_grid->telp->headerCellClass() ?>"><div id="elh_t_peserta_telp" class="t_peserta_telp"><div class="ew-table-header-caption"><?php echo $t_peserta_grid->telp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telp" class="<?php echo $t_peserta_grid->telp->headerCellClass() ?>"><div><div id="elh_t_peserta_telp" class="t_peserta_telp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_grid->telp->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_grid->telp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_grid->telp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_grid->hp->Visible) { // hp ?>
	<?php if ($t_peserta_grid->SortUrl($t_peserta_grid->hp) == "") { ?>
		<th data-name="hp" class="<?php echo $t_peserta_grid->hp->headerCellClass() ?>"><div id="elh_t_peserta_hp" class="t_peserta_hp"><div class="ew-table-header-caption"><?php echo $t_peserta_grid->hp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hp" class="<?php echo $t_peserta_grid->hp->headerCellClass() ?>"><div><div id="elh_t_peserta_hp" class="t_peserta_hp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_grid->hp->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_grid->hp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_grid->hp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_grid->kdjabat->Visible) { // kdjabat ?>
	<?php if ($t_peserta_grid->SortUrl($t_peserta_grid->kdjabat) == "") { ?>
		<th data-name="kdjabat" class="<?php echo $t_peserta_grid->kdjabat->headerCellClass() ?>"><div id="elh_t_peserta_kdjabat" class="t_peserta_kdjabat"><div class="ew-table-header-caption"><?php echo $t_peserta_grid->kdjabat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjabat" class="<?php echo $t_peserta_grid->kdjabat->headerCellClass() ?>"><div><div id="elh_t_peserta_kdjabat" class="t_peserta_kdjabat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_grid->kdjabat->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_grid->kdjabat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_grid->kdjabat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_grid->kdpend->Visible) { // kdpend ?>
	<?php if ($t_peserta_grid->SortUrl($t_peserta_grid->kdpend) == "") { ?>
		<th data-name="kdpend" class="<?php echo $t_peserta_grid->kdpend->headerCellClass() ?>"><div id="elh_t_peserta_kdpend" class="t_peserta_kdpend"><div class="ew-table-header-caption"><?php echo $t_peserta_grid->kdpend->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdpend" class="<?php echo $t_peserta_grid->kdpend->headerCellClass() ?>"><div><div id="elh_t_peserta_kdpend" class="t_peserta_kdpend">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_grid->kdpend->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_grid->kdpend->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_grid->kdpend->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_grid->kdbahasa->Visible) { // kdbahasa ?>
	<?php if ($t_peserta_grid->SortUrl($t_peserta_grid->kdbahasa) == "") { ?>
		<th data-name="kdbahasa" class="<?php echo $t_peserta_grid->kdbahasa->headerCellClass() ?>"><div id="elh_t_peserta_kdbahasa" class="t_peserta_kdbahasa"><div class="ew-table-header-caption"><?php echo $t_peserta_grid->kdbahasa->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdbahasa" class="<?php echo $t_peserta_grid->kdbahasa->headerCellClass() ?>"><div><div id="elh_t_peserta_kdbahasa" class="t_peserta_kdbahasa">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_grid->kdbahasa->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_grid->kdbahasa->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_grid->kdbahasa->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_grid->jpelatihan->Visible) { // jpelatihan ?>
	<?php if ($t_peserta_grid->SortUrl($t_peserta_grid->jpelatihan) == "") { ?>
		<th data-name="jpelatihan" class="<?php echo $t_peserta_grid->jpelatihan->headerCellClass() ?>"><div id="elh_t_peserta_jpelatihan" class="t_peserta_jpelatihan"><div class="ew-table-header-caption"><?php echo $t_peserta_grid->jpelatihan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jpelatihan" class="<?php echo $t_peserta_grid->jpelatihan->headerCellClass() ?>"><div><div id="elh_t_peserta_jpelatihan" class="t_peserta_jpelatihan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_grid->jpelatihan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_grid->jpelatihan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_grid->jpelatihan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_peserta_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_peserta_grid->StartRecord = 1;
$t_peserta_grid->StopRecord = $t_peserta_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($t_peserta->isConfirm() || $t_peserta_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_peserta_grid->FormKeyCountName) && ($t_peserta_grid->isGridAdd() || $t_peserta_grid->isGridEdit() || $t_peserta->isConfirm())) {
		$t_peserta_grid->KeyCount = $CurrentForm->getValue($t_peserta_grid->FormKeyCountName);
		$t_peserta_grid->StopRecord = $t_peserta_grid->StartRecord + $t_peserta_grid->KeyCount - 1;
	}
}
$t_peserta_grid->RecordCount = $t_peserta_grid->StartRecord - 1;
if ($t_peserta_grid->Recordset && !$t_peserta_grid->Recordset->EOF) {
	$t_peserta_grid->Recordset->moveFirst();
	$selectLimit = $t_peserta_grid->UseSelectLimit;
	if (!$selectLimit && $t_peserta_grid->StartRecord > 1)
		$t_peserta_grid->Recordset->move($t_peserta_grid->StartRecord - 1);
} elseif (!$t_peserta->AllowAddDeleteRow && $t_peserta_grid->StopRecord == 0) {
	$t_peserta_grid->StopRecord = $t_peserta->GridAddRowCount;
}

// Initialize aggregate
$t_peserta->RowType = ROWTYPE_AGGREGATEINIT;
$t_peserta->resetAttributes();
$t_peserta_grid->renderRow();
if ($t_peserta_grid->isGridAdd())
	$t_peserta_grid->RowIndex = 0;
if ($t_peserta_grid->isGridEdit())
	$t_peserta_grid->RowIndex = 0;
while ($t_peserta_grid->RecordCount < $t_peserta_grid->StopRecord) {
	$t_peserta_grid->RecordCount++;
	if ($t_peserta_grid->RecordCount >= $t_peserta_grid->StartRecord) {
		$t_peserta_grid->RowCount++;
		if ($t_peserta_grid->isGridAdd() || $t_peserta_grid->isGridEdit() || $t_peserta->isConfirm()) {
			$t_peserta_grid->RowIndex++;
			$CurrentForm->Index = $t_peserta_grid->RowIndex;
			if ($CurrentForm->hasValue($t_peserta_grid->FormActionName) && ($t_peserta->isConfirm() || $t_peserta_grid->EventCancelled))
				$t_peserta_grid->RowAction = strval($CurrentForm->getValue($t_peserta_grid->FormActionName));
			elseif ($t_peserta_grid->isGridAdd())
				$t_peserta_grid->RowAction = "insert";
			else
				$t_peserta_grid->RowAction = "";
		}

		// Set up key count
		$t_peserta_grid->KeyCount = $t_peserta_grid->RowIndex;

		// Init row class and style
		$t_peserta->resetAttributes();
		$t_peserta->CssClass = "";
		if ($t_peserta_grid->isGridAdd()) {
			if ($t_peserta->CurrentMode == "copy") {
				$t_peserta_grid->loadRowValues($t_peserta_grid->Recordset); // Load row values
				$t_peserta_grid->setRecordKey($t_peserta_grid->RowOldKey, $t_peserta_grid->Recordset); // Set old record key
			} else {
				$t_peserta_grid->loadRowValues(); // Load default values
				$t_peserta_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_peserta_grid->loadRowValues($t_peserta_grid->Recordset); // Load row values
		}
		$t_peserta->RowType = ROWTYPE_VIEW; // Render view
		if ($t_peserta_grid->isGridAdd()) // Grid add
			$t_peserta->RowType = ROWTYPE_ADD; // Render add
		if ($t_peserta_grid->isGridAdd() && $t_peserta->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_peserta_grid->restoreCurrentRowFormValues($t_peserta_grid->RowIndex); // Restore form values
		if ($t_peserta_grid->isGridEdit()) { // Grid edit
			if ($t_peserta->EventCancelled)
				$t_peserta_grid->restoreCurrentRowFormValues($t_peserta_grid->RowIndex); // Restore form values
			if ($t_peserta_grid->RowAction == "insert")
				$t_peserta->RowType = ROWTYPE_ADD; // Render add
			else
				$t_peserta->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_peserta_grid->isGridEdit() && ($t_peserta->RowType == ROWTYPE_EDIT || $t_peserta->RowType == ROWTYPE_ADD) && $t_peserta->EventCancelled) // Update failed
			$t_peserta_grid->restoreCurrentRowFormValues($t_peserta_grid->RowIndex); // Restore form values
		if ($t_peserta->RowType == ROWTYPE_EDIT) // Edit row
			$t_peserta_grid->EditRowCount++;
		if ($t_peserta->isConfirm()) // Confirm row
			$t_peserta_grid->restoreCurrentRowFormValues($t_peserta_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_peserta->RowAttrs->merge(["data-rowindex" => $t_peserta_grid->RowCount, "id" => "r" . $t_peserta_grid->RowCount . "_t_peserta", "data-rowtype" => $t_peserta->RowType]);

		// Render row
		$t_peserta_grid->renderRow();

		// Render list options
		$t_peserta_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_peserta_grid->RowAction != "delete" && $t_peserta_grid->RowAction != "insertdelete" && !($t_peserta_grid->RowAction == "insert" && $t_peserta->isConfirm() && $t_peserta_grid->emptyRow())) {
?>
	<tr <?php echo $t_peserta->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_peserta_grid->ListOptions->render("body", "left", $t_peserta_grid->RowCount);
?>
	<?php if ($t_peserta_grid->id->Visible) { // id ?>
		<td data-name="id" <?php echo $t_peserta_grid->id->cellAttributes() ?>>
<?php if ($t_peserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_id" class="form-group"></span>
<input type="hidden" data-table="t_peserta" data-field="x_id" name="o<?php echo $t_peserta_grid->RowIndex ?>_id" id="o<?php echo $t_peserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_peserta_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_id" class="form-group">
<span<?php echo $t_peserta_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_id" name="x<?php echo $t_peserta_grid->RowIndex ?>_id" id="x<?php echo $t_peserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_peserta_grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_id">
<span<?php echo $t_peserta_grid->id->viewAttributes() ?>><?php echo $t_peserta_grid->id->getViewValue() ?></span>
</span>
<?php if (!$t_peserta->isConfirm()) { ?>
<input type="hidden" data-table="t_peserta" data-field="x_id" name="x<?php echo $t_peserta_grid->RowIndex ?>_id" id="x<?php echo $t_peserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_peserta_grid->id->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_id" name="o<?php echo $t_peserta_grid->RowIndex ?>_id" id="o<?php echo $t_peserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_peserta_grid->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_peserta" data-field="x_id" name="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_id" id="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_peserta_grid->id->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_id" name="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_id" id="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_peserta_grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $t_peserta_grid->nama->cellAttributes() ?>>
<?php if ($t_peserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_nama" class="form-group">
<input type="text" data-table="t_peserta" data-field="x_nama" name="x<?php echo $t_peserta_grid->RowIndex ?>_nama" id="x<?php echo $t_peserta_grid->RowIndex ?>_nama" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_peserta_grid->nama->getPlaceHolder()) ?>" value="<?php echo $t_peserta_grid->nama->EditValue ?>"<?php echo $t_peserta_grid->nama->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_nama" name="o<?php echo $t_peserta_grid->RowIndex ?>_nama" id="o<?php echo $t_peserta_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($t_peserta_grid->nama->OldValue) ?>">
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_nama" class="form-group">
<input type="text" data-table="t_peserta" data-field="x_nama" name="x<?php echo $t_peserta_grid->RowIndex ?>_nama" id="x<?php echo $t_peserta_grid->RowIndex ?>_nama" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_peserta_grid->nama->getPlaceHolder()) ?>" value="<?php echo $t_peserta_grid->nama->EditValue ?>"<?php echo $t_peserta_grid->nama->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_nama">
<span<?php echo $t_peserta_grid->nama->viewAttributes() ?>><?php echo $t_peserta_grid->nama->getViewValue() ?></span>
</span>
<?php if (!$t_peserta->isConfirm()) { ?>
<input type="hidden" data-table="t_peserta" data-field="x_nama" name="x<?php echo $t_peserta_grid->RowIndex ?>_nama" id="x<?php echo $t_peserta_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($t_peserta_grid->nama->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_nama" name="o<?php echo $t_peserta_grid->RowIndex ?>_nama" id="o<?php echo $t_peserta_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($t_peserta_grid->nama->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_peserta" data-field="x_nama" name="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_nama" id="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($t_peserta_grid->nama->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_nama" name="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_nama" id="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($t_peserta_grid->nama->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->idp->Visible) { // idp ?>
		<td data-name="idp" <?php echo $t_peserta_grid->idp->cellAttributes() ?>>
<?php if ($t_peserta->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($t_peserta_grid->idp->getSessionValue() != "") { ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_idp" class="form-group">
<span<?php echo $t_peserta_grid->idp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->idp->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_peserta_grid->RowIndex ?>_idp" name="x<?php echo $t_peserta_grid->RowIndex ?>_idp" value="<?php echo HtmlEncode($t_peserta_grid->idp->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_idp" class="form-group">
<?php
$onchange = $t_peserta_grid->idp->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_peserta_grid->idp->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_peserta_grid->RowIndex ?>_idp">
	<input type="text" class="form-control" name="sv_x<?php echo $t_peserta_grid->RowIndex ?>_idp" id="sv_x<?php echo $t_peserta_grid->RowIndex ?>_idp" value="<?php echo RemoveHtml($t_peserta_grid->idp->EditValue) ?>" size="75" placeholder="<?php echo HtmlEncode($t_peserta_grid->idp->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_peserta_grid->idp->getPlaceHolder()) ?>"<?php echo $t_peserta_grid->idp->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_idp" data-value-separator="<?php echo $t_peserta_grid->idp->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_peserta_grid->RowIndex ?>_idp" id="x<?php echo $t_peserta_grid->RowIndex ?>_idp" value="<?php echo HtmlEncode($t_peserta_grid->idp->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pesertagrid"], function() {
	ft_pesertagrid.createAutoSuggest({"id":"x<?php echo $t_peserta_grid->RowIndex ?>_idp","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_peserta_grid->idp->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_idp") ?>
</span>
<?php } ?>
<input type="hidden" data-table="t_peserta" data-field="x_idp" name="o<?php echo $t_peserta_grid->RowIndex ?>_idp" id="o<?php echo $t_peserta_grid->RowIndex ?>_idp" value="<?php echo HtmlEncode($t_peserta_grid->idp->OldValue) ?>">
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t_peserta_grid->idp->getSessionValue() != "") { ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_idp" class="form-group">
<span<?php echo $t_peserta_grid->idp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->idp->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_peserta_grid->RowIndex ?>_idp" name="x<?php echo $t_peserta_grid->RowIndex ?>_idp" value="<?php echo HtmlEncode($t_peserta_grid->idp->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_idp" class="form-group">
<?php
$onchange = $t_peserta_grid->idp->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_peserta_grid->idp->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_peserta_grid->RowIndex ?>_idp">
	<input type="text" class="form-control" name="sv_x<?php echo $t_peserta_grid->RowIndex ?>_idp" id="sv_x<?php echo $t_peserta_grid->RowIndex ?>_idp" value="<?php echo RemoveHtml($t_peserta_grid->idp->EditValue) ?>" size="75" placeholder="<?php echo HtmlEncode($t_peserta_grid->idp->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_peserta_grid->idp->getPlaceHolder()) ?>"<?php echo $t_peserta_grid->idp->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_idp" data-value-separator="<?php echo $t_peserta_grid->idp->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_peserta_grid->RowIndex ?>_idp" id="x<?php echo $t_peserta_grid->RowIndex ?>_idp" value="<?php echo HtmlEncode($t_peserta_grid->idp->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pesertagrid"], function() {
	ft_pesertagrid.createAutoSuggest({"id":"x<?php echo $t_peserta_grid->RowIndex ?>_idp","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_peserta_grid->idp->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_idp") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_idp">
<span<?php echo $t_peserta_grid->idp->viewAttributes() ?>><?php echo $t_peserta_grid->idp->getViewValue() ?></span>
</span>
<?php if (!$t_peserta->isConfirm()) { ?>
<input type="hidden" data-table="t_peserta" data-field="x_idp" name="x<?php echo $t_peserta_grid->RowIndex ?>_idp" id="x<?php echo $t_peserta_grid->RowIndex ?>_idp" value="<?php echo HtmlEncode($t_peserta_grid->idp->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_idp" name="o<?php echo $t_peserta_grid->RowIndex ?>_idp" id="o<?php echo $t_peserta_grid->RowIndex ?>_idp" value="<?php echo HtmlEncode($t_peserta_grid->idp->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_peserta" data-field="x_idp" name="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_idp" id="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_idp" value="<?php echo HtmlEncode($t_peserta_grid->idp->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_idp" name="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_idp" id="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_idp" value="<?php echo HtmlEncode($t_peserta_grid->idp->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->tempat->Visible) { // tempat ?>
		<td data-name="tempat" <?php echo $t_peserta_grid->tempat->cellAttributes() ?>>
<?php if ($t_peserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_tempat" class="form-group">
<input type="text" data-table="t_peserta" data-field="x_tempat" name="x<?php echo $t_peserta_grid->RowIndex ?>_tempat" id="x<?php echo $t_peserta_grid->RowIndex ?>_tempat" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($t_peserta_grid->tempat->getPlaceHolder()) ?>" value="<?php echo $t_peserta_grid->tempat->EditValue ?>"<?php echo $t_peserta_grid->tempat->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_tempat" name="o<?php echo $t_peserta_grid->RowIndex ?>_tempat" id="o<?php echo $t_peserta_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_peserta_grid->tempat->OldValue) ?>">
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_tempat" class="form-group">
<input type="text" data-table="t_peserta" data-field="x_tempat" name="x<?php echo $t_peserta_grid->RowIndex ?>_tempat" id="x<?php echo $t_peserta_grid->RowIndex ?>_tempat" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($t_peserta_grid->tempat->getPlaceHolder()) ?>" value="<?php echo $t_peserta_grid->tempat->EditValue ?>"<?php echo $t_peserta_grid->tempat->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_tempat">
<span<?php echo $t_peserta_grid->tempat->viewAttributes() ?>><?php echo $t_peserta_grid->tempat->getViewValue() ?></span>
</span>
<?php if (!$t_peserta->isConfirm()) { ?>
<input type="hidden" data-table="t_peserta" data-field="x_tempat" name="x<?php echo $t_peserta_grid->RowIndex ?>_tempat" id="x<?php echo $t_peserta_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_peserta_grid->tempat->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_tempat" name="o<?php echo $t_peserta_grid->RowIndex ?>_tempat" id="o<?php echo $t_peserta_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_peserta_grid->tempat->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_peserta" data-field="x_tempat" name="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_tempat" id="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_peserta_grid->tempat->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_tempat" name="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_tempat" id="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_peserta_grid->tempat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->kdagama->Visible) { // kdagama ?>
		<td data-name="kdagama" <?php echo $t_peserta_grid->kdagama->cellAttributes() ?>>
<?php if ($t_peserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdagama" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdagama" data-value-separator="<?php echo $t_peserta_grid->kdagama->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdagama" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdagama"<?php echo $t_peserta_grid->kdagama->editAttributes() ?>>
			<?php echo $t_peserta_grid->kdagama->selectOptionListHtml("x{$t_peserta_grid->RowIndex}_kdagama") ?>
		</select>
</div>
<?php echo $t_peserta_grid->kdagama->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_kdagama") ?>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_kdagama" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdagama" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdagama" value="<?php echo HtmlEncode($t_peserta_grid->kdagama->OldValue) ?>">
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdagama" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdagama" data-value-separator="<?php echo $t_peserta_grid->kdagama->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdagama" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdagama"<?php echo $t_peserta_grid->kdagama->editAttributes() ?>>
			<?php echo $t_peserta_grid->kdagama->selectOptionListHtml("x{$t_peserta_grid->RowIndex}_kdagama") ?>
		</select>
</div>
<?php echo $t_peserta_grid->kdagama->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_kdagama") ?>
</span>
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdagama">
<span<?php echo $t_peserta_grid->kdagama->viewAttributes() ?>><?php echo $t_peserta_grid->kdagama->getViewValue() ?></span>
</span>
<?php if (!$t_peserta->isConfirm()) { ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdagama" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdagama" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdagama" value="<?php echo HtmlEncode($t_peserta_grid->kdagama->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_kdagama" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdagama" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdagama" value="<?php echo HtmlEncode($t_peserta_grid->kdagama->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdagama" name="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_kdagama" id="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_kdagama" value="<?php echo HtmlEncode($t_peserta_grid->kdagama->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_kdagama" name="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_kdagama" id="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_kdagama" value="<?php echo HtmlEncode($t_peserta_grid->kdagama->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->kdsex->Visible) { // kdsex ?>
		<td data-name="kdsex" <?php echo $t_peserta_grid->kdsex->cellAttributes() ?>>
<?php if ($t_peserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdsex" class="form-group">
<div id="tp_x<?php echo $t_peserta_grid->RowIndex ?>_kdsex" class="ew-template"><input type="radio" class="custom-control-input" data-table="t_peserta" data-field="x_kdsex" data-value-separator="<?php echo $t_peserta_grid->kdsex->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdsex" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdsex" value="{value}"<?php echo $t_peserta_grid->kdsex->editAttributes() ?>></div>
<div id="dsl_x<?php echo $t_peserta_grid->RowIndex ?>_kdsex" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_peserta_grid->kdsex->radioButtonListHtml(FALSE, "x{$t_peserta_grid->RowIndex}_kdsex") ?>
</div></div>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_kdsex" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdsex" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdsex" value="<?php echo HtmlEncode($t_peserta_grid->kdsex->OldValue) ?>">
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdsex" class="form-group">
<div id="tp_x<?php echo $t_peserta_grid->RowIndex ?>_kdsex" class="ew-template"><input type="radio" class="custom-control-input" data-table="t_peserta" data-field="x_kdsex" data-value-separator="<?php echo $t_peserta_grid->kdsex->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdsex" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdsex" value="{value}"<?php echo $t_peserta_grid->kdsex->editAttributes() ?>></div>
<div id="dsl_x<?php echo $t_peserta_grid->RowIndex ?>_kdsex" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_peserta_grid->kdsex->radioButtonListHtml(FALSE, "x{$t_peserta_grid->RowIndex}_kdsex") ?>
</div></div>
</span>
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdsex">
<span<?php echo $t_peserta_grid->kdsex->viewAttributes() ?>><?php echo $t_peserta_grid->kdsex->getViewValue() ?></span>
</span>
<?php if (!$t_peserta->isConfirm()) { ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdsex" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdsex" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdsex" value="<?php echo HtmlEncode($t_peserta_grid->kdsex->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_kdsex" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdsex" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdsex" value="<?php echo HtmlEncode($t_peserta_grid->kdsex->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdsex" name="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_kdsex" id="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_kdsex" value="<?php echo HtmlEncode($t_peserta_grid->kdsex->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_kdsex" name="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_kdsex" id="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_kdsex" value="<?php echo HtmlEncode($t_peserta_grid->kdsex->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" <?php echo $t_peserta_grid->kdprop->cellAttributes() ?>>
<?php if ($t_peserta->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($t_peserta_grid->kdprop->getSessionValue() != "") { ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdprop" class="form-group">
<span<?php echo $t_peserta_grid->kdprop->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->kdprop->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdprop" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($t_peserta_grid->kdprop->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdprop" class="form-group">
<?php $t_peserta_grid->kdprop->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdprop" data-value-separator="<?php echo $t_peserta_grid->kdprop->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdprop" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdprop"<?php echo $t_peserta_grid->kdprop->editAttributes() ?>>
			<?php echo $t_peserta_grid->kdprop->selectOptionListHtml("x{$t_peserta_grid->RowIndex}_kdprop") ?>
		</select>
</div>
<?php echo $t_peserta_grid->kdprop->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_kdprop") ?>
</span>
<?php } ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdprop" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdprop" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($t_peserta_grid->kdprop->OldValue) ?>">
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t_peserta_grid->kdprop->getSessionValue() != "") { ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdprop" class="form-group">
<span<?php echo $t_peserta_grid->kdprop->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->kdprop->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdprop" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($t_peserta_grid->kdprop->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdprop" class="form-group">
<?php $t_peserta_grid->kdprop->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdprop" data-value-separator="<?php echo $t_peserta_grid->kdprop->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdprop" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdprop"<?php echo $t_peserta_grid->kdprop->editAttributes() ?>>
			<?php echo $t_peserta_grid->kdprop->selectOptionListHtml("x{$t_peserta_grid->RowIndex}_kdprop") ?>
		</select>
</div>
<?php echo $t_peserta_grid->kdprop->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_kdprop") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdprop">
<span<?php echo $t_peserta_grid->kdprop->viewAttributes() ?>><?php echo $t_peserta_grid->kdprop->getViewValue() ?></span>
</span>
<?php if (!$t_peserta->isConfirm()) { ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdprop" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdprop" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($t_peserta_grid->kdprop->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_kdprop" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdprop" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($t_peserta_grid->kdprop->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdprop" name="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_kdprop" id="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($t_peserta_grid->kdprop->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_kdprop" name="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_kdprop" id="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($t_peserta_grid->kdprop->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->kdkota->Visible) { // kdkota ?>
		<td data-name="kdkota" <?php echo $t_peserta_grid->kdkota->cellAttributes() ?>>
<?php if ($t_peserta->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($t_peserta_grid->kdkota->getSessionValue() != "") { ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdkota" class="form-group">
<span<?php echo $t_peserta_grid->kdkota->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->kdkota->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdkota" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($t_peserta_grid->kdkota->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdkota" class="form-group">
<?php $t_peserta_grid->kdkota->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdkota" data-value-separator="<?php echo $t_peserta_grid->kdkota->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdkota" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdkota"<?php echo $t_peserta_grid->kdkota->editAttributes() ?>>
			<?php echo $t_peserta_grid->kdkota->selectOptionListHtml("x{$t_peserta_grid->RowIndex}_kdkota") ?>
		</select>
</div>
<?php echo $t_peserta_grid->kdkota->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_kdkota") ?>
</span>
<?php } ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdkota" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdkota" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($t_peserta_grid->kdkota->OldValue) ?>">
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t_peserta_grid->kdkota->getSessionValue() != "") { ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdkota" class="form-group">
<span<?php echo $t_peserta_grid->kdkota->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->kdkota->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdkota" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($t_peserta_grid->kdkota->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdkota" class="form-group">
<?php $t_peserta_grid->kdkota->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdkota" data-value-separator="<?php echo $t_peserta_grid->kdkota->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdkota" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdkota"<?php echo $t_peserta_grid->kdkota->editAttributes() ?>>
			<?php echo $t_peserta_grid->kdkota->selectOptionListHtml("x{$t_peserta_grid->RowIndex}_kdkota") ?>
		</select>
</div>
<?php echo $t_peserta_grid->kdkota->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_kdkota") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdkota">
<span<?php echo $t_peserta_grid->kdkota->viewAttributes() ?>><?php echo $t_peserta_grid->kdkota->getViewValue() ?></span>
</span>
<?php if (!$t_peserta->isConfirm()) { ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdkota" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdkota" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($t_peserta_grid->kdkota->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_kdkota" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdkota" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($t_peserta_grid->kdkota->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdkota" name="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_kdkota" id="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($t_peserta_grid->kdkota->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_kdkota" name="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_kdkota" id="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($t_peserta_grid->kdkota->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->kdkec->Visible) { // kdkec ?>
		<td data-name="kdkec" <?php echo $t_peserta_grid->kdkec->cellAttributes() ?>>
<?php if ($t_peserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdkec" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdkec" data-value-separator="<?php echo $t_peserta_grid->kdkec->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdkec" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdkec"<?php echo $t_peserta_grid->kdkec->editAttributes() ?>>
			<?php echo $t_peserta_grid->kdkec->selectOptionListHtml("x{$t_peserta_grid->RowIndex}_kdkec") ?>
		</select>
</div>
<?php echo $t_peserta_grid->kdkec->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_kdkec") ?>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_kdkec" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdkec" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdkec" value="<?php echo HtmlEncode($t_peserta_grid->kdkec->OldValue) ?>">
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdkec" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdkec" data-value-separator="<?php echo $t_peserta_grid->kdkec->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdkec" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdkec"<?php echo $t_peserta_grid->kdkec->editAttributes() ?>>
			<?php echo $t_peserta_grid->kdkec->selectOptionListHtml("x{$t_peserta_grid->RowIndex}_kdkec") ?>
		</select>
</div>
<?php echo $t_peserta_grid->kdkec->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_kdkec") ?>
</span>
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdkec">
<span<?php echo $t_peserta_grid->kdkec->viewAttributes() ?>><?php echo $t_peserta_grid->kdkec->getViewValue() ?></span>
</span>
<?php if (!$t_peserta->isConfirm()) { ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdkec" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdkec" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdkec" value="<?php echo HtmlEncode($t_peserta_grid->kdkec->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_kdkec" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdkec" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdkec" value="<?php echo HtmlEncode($t_peserta_grid->kdkec->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdkec" name="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_kdkec" id="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_kdkec" value="<?php echo HtmlEncode($t_peserta_grid->kdkec->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_kdkec" name="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_kdkec" id="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_kdkec" value="<?php echo HtmlEncode($t_peserta_grid->kdkec->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->alamat->Visible) { // alamat ?>
		<td data-name="alamat" <?php echo $t_peserta_grid->alamat->cellAttributes() ?>>
<?php if ($t_peserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_alamat" class="form-group">
<textarea data-table="t_peserta" data-field="x_alamat" name="x<?php echo $t_peserta_grid->RowIndex ?>_alamat" id="x<?php echo $t_peserta_grid->RowIndex ?>_alamat" cols="50" rows="2" placeholder="<?php echo HtmlEncode($t_peserta_grid->alamat->getPlaceHolder()) ?>"<?php echo $t_peserta_grid->alamat->editAttributes() ?>><?php echo $t_peserta_grid->alamat->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_alamat" name="o<?php echo $t_peserta_grid->RowIndex ?>_alamat" id="o<?php echo $t_peserta_grid->RowIndex ?>_alamat" value="<?php echo HtmlEncode($t_peserta_grid->alamat->OldValue) ?>">
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_alamat" class="form-group">
<textarea data-table="t_peserta" data-field="x_alamat" name="x<?php echo $t_peserta_grid->RowIndex ?>_alamat" id="x<?php echo $t_peserta_grid->RowIndex ?>_alamat" cols="50" rows="2" placeholder="<?php echo HtmlEncode($t_peserta_grid->alamat->getPlaceHolder()) ?>"<?php echo $t_peserta_grid->alamat->editAttributes() ?>><?php echo $t_peserta_grid->alamat->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_alamat">
<span<?php echo $t_peserta_grid->alamat->viewAttributes() ?>><?php echo $t_peserta_grid->alamat->getViewValue() ?></span>
</span>
<?php if (!$t_peserta->isConfirm()) { ?>
<input type="hidden" data-table="t_peserta" data-field="x_alamat" name="x<?php echo $t_peserta_grid->RowIndex ?>_alamat" id="x<?php echo $t_peserta_grid->RowIndex ?>_alamat" value="<?php echo HtmlEncode($t_peserta_grid->alamat->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_alamat" name="o<?php echo $t_peserta_grid->RowIndex ?>_alamat" id="o<?php echo $t_peserta_grid->RowIndex ?>_alamat" value="<?php echo HtmlEncode($t_peserta_grid->alamat->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_peserta" data-field="x_alamat" name="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_alamat" id="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_alamat" value="<?php echo HtmlEncode($t_peserta_grid->alamat->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_alamat" name="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_alamat" id="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_alamat" value="<?php echo HtmlEncode($t_peserta_grid->alamat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->telp->Visible) { // telp ?>
		<td data-name="telp" <?php echo $t_peserta_grid->telp->cellAttributes() ?>>
<?php if ($t_peserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_telp" class="form-group">
<input type="text" data-table="t_peserta" data-field="x_telp" name="x<?php echo $t_peserta_grid->RowIndex ?>_telp" id="x<?php echo $t_peserta_grid->RowIndex ?>_telp" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_peserta_grid->telp->getPlaceHolder()) ?>" value="<?php echo $t_peserta_grid->telp->EditValue ?>"<?php echo $t_peserta_grid->telp->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_telp" name="o<?php echo $t_peserta_grid->RowIndex ?>_telp" id="o<?php echo $t_peserta_grid->RowIndex ?>_telp" value="<?php echo HtmlEncode($t_peserta_grid->telp->OldValue) ?>">
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_telp" class="form-group">
<input type="text" data-table="t_peserta" data-field="x_telp" name="x<?php echo $t_peserta_grid->RowIndex ?>_telp" id="x<?php echo $t_peserta_grid->RowIndex ?>_telp" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_peserta_grid->telp->getPlaceHolder()) ?>" value="<?php echo $t_peserta_grid->telp->EditValue ?>"<?php echo $t_peserta_grid->telp->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_telp">
<span<?php echo $t_peserta_grid->telp->viewAttributes() ?>><?php echo $t_peserta_grid->telp->getViewValue() ?></span>
</span>
<?php if (!$t_peserta->isConfirm()) { ?>
<input type="hidden" data-table="t_peserta" data-field="x_telp" name="x<?php echo $t_peserta_grid->RowIndex ?>_telp" id="x<?php echo $t_peserta_grid->RowIndex ?>_telp" value="<?php echo HtmlEncode($t_peserta_grid->telp->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_telp" name="o<?php echo $t_peserta_grid->RowIndex ?>_telp" id="o<?php echo $t_peserta_grid->RowIndex ?>_telp" value="<?php echo HtmlEncode($t_peserta_grid->telp->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_peserta" data-field="x_telp" name="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_telp" id="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_telp" value="<?php echo HtmlEncode($t_peserta_grid->telp->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_telp" name="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_telp" id="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_telp" value="<?php echo HtmlEncode($t_peserta_grid->telp->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->hp->Visible) { // hp ?>
		<td data-name="hp" <?php echo $t_peserta_grid->hp->cellAttributes() ?>>
<?php if ($t_peserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_hp" class="form-group">
<input type="text" data-table="t_peserta" data-field="x_hp" name="x<?php echo $t_peserta_grid->RowIndex ?>_hp" id="x<?php echo $t_peserta_grid->RowIndex ?>_hp" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_peserta_grid->hp->getPlaceHolder()) ?>" value="<?php echo $t_peserta_grid->hp->EditValue ?>"<?php echo $t_peserta_grid->hp->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_hp" name="o<?php echo $t_peserta_grid->RowIndex ?>_hp" id="o<?php echo $t_peserta_grid->RowIndex ?>_hp" value="<?php echo HtmlEncode($t_peserta_grid->hp->OldValue) ?>">
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_hp" class="form-group">
<input type="text" data-table="t_peserta" data-field="x_hp" name="x<?php echo $t_peserta_grid->RowIndex ?>_hp" id="x<?php echo $t_peserta_grid->RowIndex ?>_hp" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_peserta_grid->hp->getPlaceHolder()) ?>" value="<?php echo $t_peserta_grid->hp->EditValue ?>"<?php echo $t_peserta_grid->hp->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_hp">
<span<?php echo $t_peserta_grid->hp->viewAttributes() ?>><?php echo $t_peserta_grid->hp->getViewValue() ?></span>
</span>
<?php if (!$t_peserta->isConfirm()) { ?>
<input type="hidden" data-table="t_peserta" data-field="x_hp" name="x<?php echo $t_peserta_grid->RowIndex ?>_hp" id="x<?php echo $t_peserta_grid->RowIndex ?>_hp" value="<?php echo HtmlEncode($t_peserta_grid->hp->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_hp" name="o<?php echo $t_peserta_grid->RowIndex ?>_hp" id="o<?php echo $t_peserta_grid->RowIndex ?>_hp" value="<?php echo HtmlEncode($t_peserta_grid->hp->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_peserta" data-field="x_hp" name="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_hp" id="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_hp" value="<?php echo HtmlEncode($t_peserta_grid->hp->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_hp" name="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_hp" id="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_hp" value="<?php echo HtmlEncode($t_peserta_grid->hp->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->kdjabat->Visible) { // kdjabat ?>
		<td data-name="kdjabat" <?php echo $t_peserta_grid->kdjabat->cellAttributes() ?>>
<?php if ($t_peserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdjabat" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdjabat" data-value-separator="<?php echo $t_peserta_grid->kdjabat->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdjabat" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdjabat"<?php echo $t_peserta_grid->kdjabat->editAttributes() ?>>
			<?php echo $t_peserta_grid->kdjabat->selectOptionListHtml("x{$t_peserta_grid->RowIndex}_kdjabat") ?>
		</select>
</div>
<?php echo $t_peserta_grid->kdjabat->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_kdjabat") ?>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_kdjabat" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdjabat" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdjabat" value="<?php echo HtmlEncode($t_peserta_grid->kdjabat->OldValue) ?>">
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdjabat" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdjabat" data-value-separator="<?php echo $t_peserta_grid->kdjabat->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdjabat" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdjabat"<?php echo $t_peserta_grid->kdjabat->editAttributes() ?>>
			<?php echo $t_peserta_grid->kdjabat->selectOptionListHtml("x{$t_peserta_grid->RowIndex}_kdjabat") ?>
		</select>
</div>
<?php echo $t_peserta_grid->kdjabat->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_kdjabat") ?>
</span>
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdjabat">
<span<?php echo $t_peserta_grid->kdjabat->viewAttributes() ?>><?php echo $t_peserta_grid->kdjabat->getViewValue() ?></span>
</span>
<?php if (!$t_peserta->isConfirm()) { ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdjabat" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdjabat" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdjabat" value="<?php echo HtmlEncode($t_peserta_grid->kdjabat->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_kdjabat" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdjabat" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdjabat" value="<?php echo HtmlEncode($t_peserta_grid->kdjabat->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdjabat" name="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_kdjabat" id="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_kdjabat" value="<?php echo HtmlEncode($t_peserta_grid->kdjabat->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_kdjabat" name="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_kdjabat" id="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_kdjabat" value="<?php echo HtmlEncode($t_peserta_grid->kdjabat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->kdpend->Visible) { // kdpend ?>
		<td data-name="kdpend" <?php echo $t_peserta_grid->kdpend->cellAttributes() ?>>
<?php if ($t_peserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdpend" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdpend" data-value-separator="<?php echo $t_peserta_grid->kdpend->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdpend" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdpend"<?php echo $t_peserta_grid->kdpend->editAttributes() ?>>
			<?php echo $t_peserta_grid->kdpend->selectOptionListHtml("x{$t_peserta_grid->RowIndex}_kdpend") ?>
		</select>
</div>
<?php echo $t_peserta_grid->kdpend->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_kdpend") ?>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_kdpend" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdpend" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdpend" value="<?php echo HtmlEncode($t_peserta_grid->kdpend->OldValue) ?>">
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdpend" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdpend" data-value-separator="<?php echo $t_peserta_grid->kdpend->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdpend" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdpend"<?php echo $t_peserta_grid->kdpend->editAttributes() ?>>
			<?php echo $t_peserta_grid->kdpend->selectOptionListHtml("x{$t_peserta_grid->RowIndex}_kdpend") ?>
		</select>
</div>
<?php echo $t_peserta_grid->kdpend->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_kdpend") ?>
</span>
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdpend">
<span<?php echo $t_peserta_grid->kdpend->viewAttributes() ?>><?php echo $t_peserta_grid->kdpend->getViewValue() ?></span>
</span>
<?php if (!$t_peserta->isConfirm()) { ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdpend" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdpend" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdpend" value="<?php echo HtmlEncode($t_peserta_grid->kdpend->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_kdpend" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdpend" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdpend" value="<?php echo HtmlEncode($t_peserta_grid->kdpend->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdpend" name="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_kdpend" id="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_kdpend" value="<?php echo HtmlEncode($t_peserta_grid->kdpend->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_kdpend" name="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_kdpend" id="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_kdpend" value="<?php echo HtmlEncode($t_peserta_grid->kdpend->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->kdbahasa->Visible) { // kdbahasa ?>
		<td data-name="kdbahasa" <?php echo $t_peserta_grid->kdbahasa->cellAttributes() ?>>
<?php if ($t_peserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdbahasa" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdbahasa" data-value-separator="<?php echo $t_peserta_grid->kdbahasa->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdbahasa" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdbahasa"<?php echo $t_peserta_grid->kdbahasa->editAttributes() ?>>
			<?php echo $t_peserta_grid->kdbahasa->selectOptionListHtml("x{$t_peserta_grid->RowIndex}_kdbahasa") ?>
		</select>
</div>
<?php echo $t_peserta_grid->kdbahasa->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_kdbahasa") ?>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_kdbahasa" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdbahasa" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdbahasa" value="<?php echo HtmlEncode($t_peserta_grid->kdbahasa->OldValue) ?>">
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdbahasa" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdbahasa" data-value-separator="<?php echo $t_peserta_grid->kdbahasa->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdbahasa" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdbahasa"<?php echo $t_peserta_grid->kdbahasa->editAttributes() ?>>
			<?php echo $t_peserta_grid->kdbahasa->selectOptionListHtml("x{$t_peserta_grid->RowIndex}_kdbahasa") ?>
		</select>
</div>
<?php echo $t_peserta_grid->kdbahasa->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_kdbahasa") ?>
</span>
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_kdbahasa">
<span<?php echo $t_peserta_grid->kdbahasa->viewAttributes() ?>><?php echo $t_peserta_grid->kdbahasa->getViewValue() ?></span>
</span>
<?php if (!$t_peserta->isConfirm()) { ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdbahasa" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdbahasa" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdbahasa" value="<?php echo HtmlEncode($t_peserta_grid->kdbahasa->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_kdbahasa" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdbahasa" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdbahasa" value="<?php echo HtmlEncode($t_peserta_grid->kdbahasa->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdbahasa" name="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_kdbahasa" id="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_kdbahasa" value="<?php echo HtmlEncode($t_peserta_grid->kdbahasa->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_kdbahasa" name="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_kdbahasa" id="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_kdbahasa" value="<?php echo HtmlEncode($t_peserta_grid->kdbahasa->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->jpelatihan->Visible) { // jpelatihan ?>
		<td data-name="jpelatihan" <?php echo $t_peserta_grid->jpelatihan->cellAttributes() ?>>
<?php if ($t_peserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_jpelatihan" class="form-group">
<input type="text" data-table="t_peserta" data-field="x_jpelatihan" name="x<?php echo $t_peserta_grid->RowIndex ?>_jpelatihan" id="x<?php echo $t_peserta_grid->RowIndex ?>_jpelatihan" size="30" placeholder="<?php echo HtmlEncode($t_peserta_grid->jpelatihan->getPlaceHolder()) ?>" value="<?php echo $t_peserta_grid->jpelatihan->EditValue ?>"<?php echo $t_peserta_grid->jpelatihan->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_jpelatihan" name="o<?php echo $t_peserta_grid->RowIndex ?>_jpelatihan" id="o<?php echo $t_peserta_grid->RowIndex ?>_jpelatihan" value="<?php echo HtmlEncode($t_peserta_grid->jpelatihan->OldValue) ?>">
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_jpelatihan" class="form-group">
<input type="hidden" data-table="t_peserta" data-field="x_jpelatihan" name="x<?php echo $t_peserta_grid->RowIndex ?>_jpelatihan" id="x<?php echo $t_peserta_grid->RowIndex ?>_jpelatihan" value="<?php echo HtmlEncode($t_peserta_grid->jpelatihan->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($t_peserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_peserta_grid->RowCount ?>_t_peserta_jpelatihan">
<span<?php echo $t_peserta_grid->jpelatihan->viewAttributes() ?>><?php echo $t_peserta_grid->jpelatihan->getViewValue() ?></span>
</span>
<?php if (!$t_peserta->isConfirm()) { ?>
<input type="hidden" data-table="t_peserta" data-field="x_jpelatihan" name="x<?php echo $t_peserta_grid->RowIndex ?>_jpelatihan" id="x<?php echo $t_peserta_grid->RowIndex ?>_jpelatihan" value="<?php echo HtmlEncode($t_peserta_grid->jpelatihan->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_jpelatihan" name="o<?php echo $t_peserta_grid->RowIndex ?>_jpelatihan" id="o<?php echo $t_peserta_grid->RowIndex ?>_jpelatihan" value="<?php echo HtmlEncode($t_peserta_grid->jpelatihan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_peserta" data-field="x_jpelatihan" name="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_jpelatihan" id="ft_pesertagrid$x<?php echo $t_peserta_grid->RowIndex ?>_jpelatihan" value="<?php echo HtmlEncode($t_peserta_grid->jpelatihan->FormValue) ?>">
<input type="hidden" data-table="t_peserta" data-field="x_jpelatihan" name="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_jpelatihan" id="ft_pesertagrid$o<?php echo $t_peserta_grid->RowIndex ?>_jpelatihan" value="<?php echo HtmlEncode($t_peserta_grid->jpelatihan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_peserta_grid->ListOptions->render("body", "right", $t_peserta_grid->RowCount);
?>
	</tr>
<?php if ($t_peserta->RowType == ROWTYPE_ADD || $t_peserta->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_pesertagrid", "load"], function() {
	ft_pesertagrid.updateLists(<?php echo $t_peserta_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_peserta_grid->isGridAdd() || $t_peserta->CurrentMode == "copy")
		if (!$t_peserta_grid->Recordset->EOF)
			$t_peserta_grid->Recordset->moveNext();
}
?>
<?php
	if ($t_peserta->CurrentMode == "add" || $t_peserta->CurrentMode == "copy" || $t_peserta->CurrentMode == "edit") {
		$t_peserta_grid->RowIndex = '$rowindex$';
		$t_peserta_grid->loadRowValues();

		// Set row properties
		$t_peserta->resetAttributes();
		$t_peserta->RowAttrs->merge(["data-rowindex" => $t_peserta_grid->RowIndex, "id" => "r0_t_peserta", "data-rowtype" => ROWTYPE_ADD]);
		$t_peserta->RowAttrs->appendClass("ew-template");
		$t_peserta->RowType = ROWTYPE_ADD;

		// Render row
		$t_peserta_grid->renderRow();

		// Render list options
		$t_peserta_grid->renderListOptions();
		$t_peserta_grid->StartRowCount = 0;
?>
	<tr <?php echo $t_peserta->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_peserta_grid->ListOptions->render("body", "left", $t_peserta_grid->RowIndex);
?>
	<?php if ($t_peserta_grid->id->Visible) { // id ?>
		<td data-name="id">
<?php if (!$t_peserta->isConfirm()) { ?>
<span id="el$rowindex$_t_peserta_id" class="form-group t_peserta_id"></span>
<?php } else { ?>
<span id="el$rowindex$_t_peserta_id" class="form-group t_peserta_id">
<span<?php echo $t_peserta_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_id" name="x<?php echo $t_peserta_grid->RowIndex ?>_id" id="x<?php echo $t_peserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_peserta_grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_peserta" data-field="x_id" name="o<?php echo $t_peserta_grid->RowIndex ?>_id" id="o<?php echo $t_peserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_peserta_grid->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->nama->Visible) { // nama ?>
		<td data-name="nama">
<?php if (!$t_peserta->isConfirm()) { ?>
<span id="el$rowindex$_t_peserta_nama" class="form-group t_peserta_nama">
<input type="text" data-table="t_peserta" data-field="x_nama" name="x<?php echo $t_peserta_grid->RowIndex ?>_nama" id="x<?php echo $t_peserta_grid->RowIndex ?>_nama" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_peserta_grid->nama->getPlaceHolder()) ?>" value="<?php echo $t_peserta_grid->nama->EditValue ?>"<?php echo $t_peserta_grid->nama->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_peserta_nama" class="form-group t_peserta_nama">
<span<?php echo $t_peserta_grid->nama->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->nama->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_nama" name="x<?php echo $t_peserta_grid->RowIndex ?>_nama" id="x<?php echo $t_peserta_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($t_peserta_grid->nama->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_peserta" data-field="x_nama" name="o<?php echo $t_peserta_grid->RowIndex ?>_nama" id="o<?php echo $t_peserta_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($t_peserta_grid->nama->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->idp->Visible) { // idp ?>
		<td data-name="idp">
<?php if (!$t_peserta->isConfirm()) { ?>
<?php if ($t_peserta_grid->idp->getSessionValue() != "") { ?>
<span id="el$rowindex$_t_peserta_idp" class="form-group t_peserta_idp">
<span<?php echo $t_peserta_grid->idp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->idp->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_peserta_grid->RowIndex ?>_idp" name="x<?php echo $t_peserta_grid->RowIndex ?>_idp" value="<?php echo HtmlEncode($t_peserta_grid->idp->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_peserta_idp" class="form-group t_peserta_idp">
<?php
$onchange = $t_peserta_grid->idp->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_peserta_grid->idp->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_peserta_grid->RowIndex ?>_idp">
	<input type="text" class="form-control" name="sv_x<?php echo $t_peserta_grid->RowIndex ?>_idp" id="sv_x<?php echo $t_peserta_grid->RowIndex ?>_idp" value="<?php echo RemoveHtml($t_peserta_grid->idp->EditValue) ?>" size="75" placeholder="<?php echo HtmlEncode($t_peserta_grid->idp->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_peserta_grid->idp->getPlaceHolder()) ?>"<?php echo $t_peserta_grid->idp->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_idp" data-value-separator="<?php echo $t_peserta_grid->idp->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_peserta_grid->RowIndex ?>_idp" id="x<?php echo $t_peserta_grid->RowIndex ?>_idp" value="<?php echo HtmlEncode($t_peserta_grid->idp->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pesertagrid"], function() {
	ft_pesertagrid.createAutoSuggest({"id":"x<?php echo $t_peserta_grid->RowIndex ?>_idp","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_peserta_grid->idp->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_idp") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t_peserta_idp" class="form-group t_peserta_idp">
<span<?php echo $t_peserta_grid->idp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->idp->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_idp" name="x<?php echo $t_peserta_grid->RowIndex ?>_idp" id="x<?php echo $t_peserta_grid->RowIndex ?>_idp" value="<?php echo HtmlEncode($t_peserta_grid->idp->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_peserta" data-field="x_idp" name="o<?php echo $t_peserta_grid->RowIndex ?>_idp" id="o<?php echo $t_peserta_grid->RowIndex ?>_idp" value="<?php echo HtmlEncode($t_peserta_grid->idp->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->tempat->Visible) { // tempat ?>
		<td data-name="tempat">
<?php if (!$t_peserta->isConfirm()) { ?>
<span id="el$rowindex$_t_peserta_tempat" class="form-group t_peserta_tempat">
<input type="text" data-table="t_peserta" data-field="x_tempat" name="x<?php echo $t_peserta_grid->RowIndex ?>_tempat" id="x<?php echo $t_peserta_grid->RowIndex ?>_tempat" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($t_peserta_grid->tempat->getPlaceHolder()) ?>" value="<?php echo $t_peserta_grid->tempat->EditValue ?>"<?php echo $t_peserta_grid->tempat->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_peserta_tempat" class="form-group t_peserta_tempat">
<span<?php echo $t_peserta_grid->tempat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->tempat->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_tempat" name="x<?php echo $t_peserta_grid->RowIndex ?>_tempat" id="x<?php echo $t_peserta_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_peserta_grid->tempat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_peserta" data-field="x_tempat" name="o<?php echo $t_peserta_grid->RowIndex ?>_tempat" id="o<?php echo $t_peserta_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_peserta_grid->tempat->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->kdagama->Visible) { // kdagama ?>
		<td data-name="kdagama">
<?php if (!$t_peserta->isConfirm()) { ?>
<span id="el$rowindex$_t_peserta_kdagama" class="form-group t_peserta_kdagama">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdagama" data-value-separator="<?php echo $t_peserta_grid->kdagama->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdagama" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdagama"<?php echo $t_peserta_grid->kdagama->editAttributes() ?>>
			<?php echo $t_peserta_grid->kdagama->selectOptionListHtml("x{$t_peserta_grid->RowIndex}_kdagama") ?>
		</select>
</div>
<?php echo $t_peserta_grid->kdagama->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_kdagama") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_peserta_kdagama" class="form-group t_peserta_kdagama">
<span<?php echo $t_peserta_grid->kdagama->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->kdagama->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_kdagama" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdagama" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdagama" value="<?php echo HtmlEncode($t_peserta_grid->kdagama->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdagama" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdagama" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdagama" value="<?php echo HtmlEncode($t_peserta_grid->kdagama->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->kdsex->Visible) { // kdsex ?>
		<td data-name="kdsex">
<?php if (!$t_peserta->isConfirm()) { ?>
<span id="el$rowindex$_t_peserta_kdsex" class="form-group t_peserta_kdsex">
<div id="tp_x<?php echo $t_peserta_grid->RowIndex ?>_kdsex" class="ew-template"><input type="radio" class="custom-control-input" data-table="t_peserta" data-field="x_kdsex" data-value-separator="<?php echo $t_peserta_grid->kdsex->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdsex" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdsex" value="{value}"<?php echo $t_peserta_grid->kdsex->editAttributes() ?>></div>
<div id="dsl_x<?php echo $t_peserta_grid->RowIndex ?>_kdsex" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_peserta_grid->kdsex->radioButtonListHtml(FALSE, "x{$t_peserta_grid->RowIndex}_kdsex") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_peserta_kdsex" class="form-group t_peserta_kdsex">
<span<?php echo $t_peserta_grid->kdsex->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->kdsex->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_kdsex" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdsex" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdsex" value="<?php echo HtmlEncode($t_peserta_grid->kdsex->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdsex" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdsex" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdsex" value="<?php echo HtmlEncode($t_peserta_grid->kdsex->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop">
<?php if (!$t_peserta->isConfirm()) { ?>
<?php if ($t_peserta_grid->kdprop->getSessionValue() != "") { ?>
<span id="el$rowindex$_t_peserta_kdprop" class="form-group t_peserta_kdprop">
<span<?php echo $t_peserta_grid->kdprop->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->kdprop->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdprop" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($t_peserta_grid->kdprop->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_peserta_kdprop" class="form-group t_peserta_kdprop">
<?php $t_peserta_grid->kdprop->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdprop" data-value-separator="<?php echo $t_peserta_grid->kdprop->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdprop" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdprop"<?php echo $t_peserta_grid->kdprop->editAttributes() ?>>
			<?php echo $t_peserta_grid->kdprop->selectOptionListHtml("x{$t_peserta_grid->RowIndex}_kdprop") ?>
		</select>
</div>
<?php echo $t_peserta_grid->kdprop->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_kdprop") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t_peserta_kdprop" class="form-group t_peserta_kdprop">
<span<?php echo $t_peserta_grid->kdprop->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->kdprop->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_kdprop" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdprop" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($t_peserta_grid->kdprop->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdprop" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdprop" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($t_peserta_grid->kdprop->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->kdkota->Visible) { // kdkota ?>
		<td data-name="kdkota">
<?php if (!$t_peserta->isConfirm()) { ?>
<?php if ($t_peserta_grid->kdkota->getSessionValue() != "") { ?>
<span id="el$rowindex$_t_peserta_kdkota" class="form-group t_peserta_kdkota">
<span<?php echo $t_peserta_grid->kdkota->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->kdkota->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdkota" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($t_peserta_grid->kdkota->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_peserta_kdkota" class="form-group t_peserta_kdkota">
<?php $t_peserta_grid->kdkota->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdkota" data-value-separator="<?php echo $t_peserta_grid->kdkota->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdkota" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdkota"<?php echo $t_peserta_grid->kdkota->editAttributes() ?>>
			<?php echo $t_peserta_grid->kdkota->selectOptionListHtml("x{$t_peserta_grid->RowIndex}_kdkota") ?>
		</select>
</div>
<?php echo $t_peserta_grid->kdkota->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_kdkota") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t_peserta_kdkota" class="form-group t_peserta_kdkota">
<span<?php echo $t_peserta_grid->kdkota->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->kdkota->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_kdkota" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdkota" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($t_peserta_grid->kdkota->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdkota" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdkota" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($t_peserta_grid->kdkota->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->kdkec->Visible) { // kdkec ?>
		<td data-name="kdkec">
<?php if (!$t_peserta->isConfirm()) { ?>
<span id="el$rowindex$_t_peserta_kdkec" class="form-group t_peserta_kdkec">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdkec" data-value-separator="<?php echo $t_peserta_grid->kdkec->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdkec" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdkec"<?php echo $t_peserta_grid->kdkec->editAttributes() ?>>
			<?php echo $t_peserta_grid->kdkec->selectOptionListHtml("x{$t_peserta_grid->RowIndex}_kdkec") ?>
		</select>
</div>
<?php echo $t_peserta_grid->kdkec->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_kdkec") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_peserta_kdkec" class="form-group t_peserta_kdkec">
<span<?php echo $t_peserta_grid->kdkec->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->kdkec->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_kdkec" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdkec" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdkec" value="<?php echo HtmlEncode($t_peserta_grid->kdkec->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdkec" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdkec" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdkec" value="<?php echo HtmlEncode($t_peserta_grid->kdkec->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->alamat->Visible) { // alamat ?>
		<td data-name="alamat">
<?php if (!$t_peserta->isConfirm()) { ?>
<span id="el$rowindex$_t_peserta_alamat" class="form-group t_peserta_alamat">
<textarea data-table="t_peserta" data-field="x_alamat" name="x<?php echo $t_peserta_grid->RowIndex ?>_alamat" id="x<?php echo $t_peserta_grid->RowIndex ?>_alamat" cols="50" rows="2" placeholder="<?php echo HtmlEncode($t_peserta_grid->alamat->getPlaceHolder()) ?>"<?php echo $t_peserta_grid->alamat->editAttributes() ?>><?php echo $t_peserta_grid->alamat->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_peserta_alamat" class="form-group t_peserta_alamat">
<span<?php echo $t_peserta_grid->alamat->viewAttributes() ?>><?php echo $t_peserta_grid->alamat->ViewValue ?></span>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_alamat" name="x<?php echo $t_peserta_grid->RowIndex ?>_alamat" id="x<?php echo $t_peserta_grid->RowIndex ?>_alamat" value="<?php echo HtmlEncode($t_peserta_grid->alamat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_peserta" data-field="x_alamat" name="o<?php echo $t_peserta_grid->RowIndex ?>_alamat" id="o<?php echo $t_peserta_grid->RowIndex ?>_alamat" value="<?php echo HtmlEncode($t_peserta_grid->alamat->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->telp->Visible) { // telp ?>
		<td data-name="telp">
<?php if (!$t_peserta->isConfirm()) { ?>
<span id="el$rowindex$_t_peserta_telp" class="form-group t_peserta_telp">
<input type="text" data-table="t_peserta" data-field="x_telp" name="x<?php echo $t_peserta_grid->RowIndex ?>_telp" id="x<?php echo $t_peserta_grid->RowIndex ?>_telp" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_peserta_grid->telp->getPlaceHolder()) ?>" value="<?php echo $t_peserta_grid->telp->EditValue ?>"<?php echo $t_peserta_grid->telp->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_peserta_telp" class="form-group t_peserta_telp">
<span<?php echo $t_peserta_grid->telp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->telp->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_telp" name="x<?php echo $t_peserta_grid->RowIndex ?>_telp" id="x<?php echo $t_peserta_grid->RowIndex ?>_telp" value="<?php echo HtmlEncode($t_peserta_grid->telp->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_peserta" data-field="x_telp" name="o<?php echo $t_peserta_grid->RowIndex ?>_telp" id="o<?php echo $t_peserta_grid->RowIndex ?>_telp" value="<?php echo HtmlEncode($t_peserta_grid->telp->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->hp->Visible) { // hp ?>
		<td data-name="hp">
<?php if (!$t_peserta->isConfirm()) { ?>
<span id="el$rowindex$_t_peserta_hp" class="form-group t_peserta_hp">
<input type="text" data-table="t_peserta" data-field="x_hp" name="x<?php echo $t_peserta_grid->RowIndex ?>_hp" id="x<?php echo $t_peserta_grid->RowIndex ?>_hp" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_peserta_grid->hp->getPlaceHolder()) ?>" value="<?php echo $t_peserta_grid->hp->EditValue ?>"<?php echo $t_peserta_grid->hp->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_peserta_hp" class="form-group t_peserta_hp">
<span<?php echo $t_peserta_grid->hp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->hp->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_hp" name="x<?php echo $t_peserta_grid->RowIndex ?>_hp" id="x<?php echo $t_peserta_grid->RowIndex ?>_hp" value="<?php echo HtmlEncode($t_peserta_grid->hp->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_peserta" data-field="x_hp" name="o<?php echo $t_peserta_grid->RowIndex ?>_hp" id="o<?php echo $t_peserta_grid->RowIndex ?>_hp" value="<?php echo HtmlEncode($t_peserta_grid->hp->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->kdjabat->Visible) { // kdjabat ?>
		<td data-name="kdjabat">
<?php if (!$t_peserta->isConfirm()) { ?>
<span id="el$rowindex$_t_peserta_kdjabat" class="form-group t_peserta_kdjabat">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdjabat" data-value-separator="<?php echo $t_peserta_grid->kdjabat->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdjabat" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdjabat"<?php echo $t_peserta_grid->kdjabat->editAttributes() ?>>
			<?php echo $t_peserta_grid->kdjabat->selectOptionListHtml("x{$t_peserta_grid->RowIndex}_kdjabat") ?>
		</select>
</div>
<?php echo $t_peserta_grid->kdjabat->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_kdjabat") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_peserta_kdjabat" class="form-group t_peserta_kdjabat">
<span<?php echo $t_peserta_grid->kdjabat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->kdjabat->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_kdjabat" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdjabat" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdjabat" value="<?php echo HtmlEncode($t_peserta_grid->kdjabat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdjabat" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdjabat" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdjabat" value="<?php echo HtmlEncode($t_peserta_grid->kdjabat->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->kdpend->Visible) { // kdpend ?>
		<td data-name="kdpend">
<?php if (!$t_peserta->isConfirm()) { ?>
<span id="el$rowindex$_t_peserta_kdpend" class="form-group t_peserta_kdpend">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdpend" data-value-separator="<?php echo $t_peserta_grid->kdpend->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdpend" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdpend"<?php echo $t_peserta_grid->kdpend->editAttributes() ?>>
			<?php echo $t_peserta_grid->kdpend->selectOptionListHtml("x{$t_peserta_grid->RowIndex}_kdpend") ?>
		</select>
</div>
<?php echo $t_peserta_grid->kdpend->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_kdpend") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_peserta_kdpend" class="form-group t_peserta_kdpend">
<span<?php echo $t_peserta_grid->kdpend->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->kdpend->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_kdpend" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdpend" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdpend" value="<?php echo HtmlEncode($t_peserta_grid->kdpend->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdpend" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdpend" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdpend" value="<?php echo HtmlEncode($t_peserta_grid->kdpend->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->kdbahasa->Visible) { // kdbahasa ?>
		<td data-name="kdbahasa">
<?php if (!$t_peserta->isConfirm()) { ?>
<span id="el$rowindex$_t_peserta_kdbahasa" class="form-group t_peserta_kdbahasa">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdbahasa" data-value-separator="<?php echo $t_peserta_grid->kdbahasa->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdbahasa" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdbahasa"<?php echo $t_peserta_grid->kdbahasa->editAttributes() ?>>
			<?php echo $t_peserta_grid->kdbahasa->selectOptionListHtml("x{$t_peserta_grid->RowIndex}_kdbahasa") ?>
		</select>
</div>
<?php echo $t_peserta_grid->kdbahasa->Lookup->getParamTag($t_peserta_grid, "p_x" . $t_peserta_grid->RowIndex . "_kdbahasa") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_peserta_kdbahasa" class="form-group t_peserta_kdbahasa">
<span<?php echo $t_peserta_grid->kdbahasa->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_grid->kdbahasa->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_kdbahasa" name="x<?php echo $t_peserta_grid->RowIndex ?>_kdbahasa" id="x<?php echo $t_peserta_grid->RowIndex ?>_kdbahasa" value="<?php echo HtmlEncode($t_peserta_grid->kdbahasa->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_peserta" data-field="x_kdbahasa" name="o<?php echo $t_peserta_grid->RowIndex ?>_kdbahasa" id="o<?php echo $t_peserta_grid->RowIndex ?>_kdbahasa" value="<?php echo HtmlEncode($t_peserta_grid->kdbahasa->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_peserta_grid->jpelatihan->Visible) { // jpelatihan ?>
		<td data-name="jpelatihan">
<?php if (!$t_peserta->isConfirm()) { ?>
<span id="el$rowindex$_t_peserta_jpelatihan" class="form-group t_peserta_jpelatihan">
<input type="text" data-table="t_peserta" data-field="x_jpelatihan" name="x<?php echo $t_peserta_grid->RowIndex ?>_jpelatihan" id="x<?php echo $t_peserta_grid->RowIndex ?>_jpelatihan" size="30" placeholder="<?php echo HtmlEncode($t_peserta_grid->jpelatihan->getPlaceHolder()) ?>" value="<?php echo $t_peserta_grid->jpelatihan->EditValue ?>"<?php echo $t_peserta_grid->jpelatihan->editAttributes() ?>>
</span>
<?php } else { ?>
<input type="hidden" data-table="t_peserta" data-field="x_jpelatihan" name="x<?php echo $t_peserta_grid->RowIndex ?>_jpelatihan" id="x<?php echo $t_peserta_grid->RowIndex ?>_jpelatihan" value="<?php echo HtmlEncode($t_peserta_grid->jpelatihan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_peserta" data-field="x_jpelatihan" name="o<?php echo $t_peserta_grid->RowIndex ?>_jpelatihan" id="o<?php echo $t_peserta_grid->RowIndex ?>_jpelatihan" value="<?php echo HtmlEncode($t_peserta_grid->jpelatihan->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_peserta_grid->ListOptions->render("body", "right", $t_peserta_grid->RowIndex);
?>
<script>
loadjs.ready(["ft_pesertagrid", "load"], function() {
	ft_pesertagrid.updateLists(<?php echo $t_peserta_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($t_peserta->CurrentMode == "add" || $t_peserta->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $t_peserta_grid->FormKeyCountName ?>" id="<?php echo $t_peserta_grid->FormKeyCountName ?>" value="<?php echo $t_peserta_grid->KeyCount ?>">
<?php echo $t_peserta_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_peserta->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $t_peserta_grid->FormKeyCountName ?>" id="<?php echo $t_peserta_grid->FormKeyCountName ?>" value="<?php echo $t_peserta_grid->KeyCount ?>">
<?php echo $t_peserta_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_peserta->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_pesertagrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_peserta_grid->Recordset)
	$t_peserta_grid->Recordset->Close();
?>
<?php if ($t_peserta_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $t_peserta_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_peserta_grid->TotalRecords == 0 && !$t_peserta->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_peserta_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$t_peserta_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// document.write("page loaded");

	/*
	<?php if (isset($_GET[TABLE_SHOW_MASTER]) <> "") { ?>
		$('#ft_pesertalistsrch_SearchPanel').hide();
		$('.ewSearchOption').hide();
		$('.ewFilterOption').hide();
	<?php } ?>
	<?php if (isset($_GET[TABLE_SHOW_MASTER]) == "t_perusahaan") { ?>
		$('#r_namap').hide();
	<?php } ?>
	*/
});
</script>
<?php if (!$t_peserta->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_t_peserta",
		width: "100%",
		height: "350px"
	});
});
</script>
<?php } ?>
<?php } ?>
<?php
$t_peserta_grid->terminate();
?>