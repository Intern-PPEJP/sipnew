<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($cv_historipelatihanpeserta_grid))
	$cv_historipelatihanpeserta_grid = new cv_historipelatihanpeserta_grid();

// Run the page
$cv_historipelatihanpeserta_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cv_historipelatihanpeserta_grid->Page_Render();
?>
<?php if (!$cv_historipelatihanpeserta_grid->isExport()) { ?>
<script>
var fcv_historipelatihanpesertagrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fcv_historipelatihanpesertagrid = new ew.Form("fcv_historipelatihanpesertagrid", "grid");
	fcv_historipelatihanpesertagrid.formKeyCountName = '<?php echo $cv_historipelatihanpeserta_grid->FormKeyCountName ?>';

	// Validate form
	fcv_historipelatihanpesertagrid.validate = function() {
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
			<?php if ($cv_historipelatihanpeserta_grid->kdhistori->Required) { ?>
				elm = this.getElements("x" + infix + "_kdhistori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipelatihanpeserta_grid->kdhistori->caption(), $cv_historipelatihanpeserta_grid->kdhistori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historipelatihanpeserta_grid->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipelatihanpeserta_grid->id->caption(), $cv_historipelatihanpeserta_grid->id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cv_historipelatihanpeserta_grid->id->errorMessage()) ?>");
			<?php if ($cv_historipelatihanpeserta_grid->kdpelat->Required) { ?>
				elm = this.getElements("x" + infix + "_kdpelat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipelatihanpeserta_grid->kdpelat->caption(), $cv_historipelatihanpeserta_grid->kdpelat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historipelatihanpeserta_grid->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipelatihanpeserta_grid->tahun->caption(), $cv_historipelatihanpeserta_grid->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cv_historipelatihanpeserta_grid->tahun->errorMessage()) ?>");
			<?php if ($cv_historipelatihanpeserta_grid->kdinformasi->Required) { ?>
				elm = this.getElements("x" + infix + "_kdinformasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipelatihanpeserta_grid->kdinformasi->caption(), $cv_historipelatihanpeserta_grid->kdinformasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historipelatihanpeserta_grid->harapan->Required) { ?>
				elm = this.getElements("x" + infix + "_harapan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipelatihanpeserta_grid->harapan->caption(), $cv_historipelatihanpeserta_grid->harapan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historipelatihanpeserta_grid->sertifikat->Required) { ?>
				elm = this.getElements("x" + infix + "_sertifikat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipelatihanpeserta_grid->sertifikat->caption(), $cv_historipelatihanpeserta_grid->sertifikat->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fcv_historipelatihanpesertagrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "id", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdpelat", false)) return false;
		if (ew.valueChanged(fobj, infix, "tahun", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdinformasi", false)) return false;
		if (ew.valueChanged(fobj, infix, "harapan", false)) return false;
		if (ew.valueChanged(fobj, infix, "sertifikat", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fcv_historipelatihanpesertagrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcv_historipelatihanpesertagrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcv_historipelatihanpesertagrid.lists["x_id"] = <?php echo $cv_historipelatihanpeserta_grid->id->Lookup->toClientList($cv_historipelatihanpeserta_grid) ?>;
	fcv_historipelatihanpesertagrid.lists["x_id"].options = <?php echo JsonEncode($cv_historipelatihanpeserta_grid->id->lookupOptions()) ?>;
	fcv_historipelatihanpesertagrid.autoSuggests["x_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcv_historipelatihanpesertagrid.lists["x_kdpelat"] = <?php echo $cv_historipelatihanpeserta_grid->kdpelat->Lookup->toClientList($cv_historipelatihanpeserta_grid) ?>;
	fcv_historipelatihanpesertagrid.lists["x_kdpelat"].options = <?php echo JsonEncode($cv_historipelatihanpeserta_grid->kdpelat->lookupOptions()) ?>;
	fcv_historipelatihanpesertagrid.autoSuggests["x_kdpelat"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcv_historipelatihanpesertagrid.lists["x_kdinformasi"] = <?php echo $cv_historipelatihanpeserta_grid->kdinformasi->Lookup->toClientList($cv_historipelatihanpeserta_grid) ?>;
	fcv_historipelatihanpesertagrid.lists["x_kdinformasi"].options = <?php echo JsonEncode($cv_historipelatihanpeserta_grid->kdinformasi->lookupOptions()) ?>;
	loadjs.done("fcv_historipelatihanpesertagrid");
});
</script>
<?php } ?>
<?php
$cv_historipelatihanpeserta_grid->renderOtherOptions();
?>
<?php if ($cv_historipelatihanpeserta_grid->TotalRecords > 0 || $cv_historipelatihanpeserta->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cv_historipelatihanpeserta_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cv_historipelatihanpeserta">
<?php if ($cv_historipelatihanpeserta_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $cv_historipelatihanpeserta_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fcv_historipelatihanpesertagrid" class="ew-form ew-list-form form-inline">
<div id="gmp_cv_historipelatihanpeserta" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_cv_historipelatihanpesertagrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cv_historipelatihanpeserta->RowType = ROWTYPE_HEADER;

// Render list options
$cv_historipelatihanpeserta_grid->renderListOptions();

// Render list options (header, left)
$cv_historipelatihanpeserta_grid->ListOptions->render("header", "left");
?>
<?php if ($cv_historipelatihanpeserta_grid->kdhistori->Visible) { // kdhistori ?>
	<?php if ($cv_historipelatihanpeserta_grid->SortUrl($cv_historipelatihanpeserta_grid->kdhistori) == "") { ?>
		<th data-name="kdhistori" class="<?php echo $cv_historipelatihanpeserta_grid->kdhistori->headerCellClass() ?>"><div id="elh_cv_historipelatihanpeserta_kdhistori" class="cv_historipelatihanpeserta_kdhistori"><div class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_grid->kdhistori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdhistori" class="<?php echo $cv_historipelatihanpeserta_grid->kdhistori->headerCellClass() ?>"><div><div id="elh_cv_historipelatihanpeserta_kdhistori" class="cv_historipelatihanpeserta_kdhistori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_grid->kdhistori->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipelatihanpeserta_grid->kdhistori->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipelatihanpeserta_grid->kdhistori->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_grid->id->Visible) { // id ?>
	<?php if ($cv_historipelatihanpeserta_grid->SortUrl($cv_historipelatihanpeserta_grid->id) == "") { ?>
		<th data-name="id" class="<?php echo $cv_historipelatihanpeserta_grid->id->headerCellClass() ?>"><div id="elh_cv_historipelatihanpeserta_id" class="cv_historipelatihanpeserta_id"><div class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_grid->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $cv_historipelatihanpeserta_grid->id->headerCellClass() ?>"><div><div id="elh_cv_historipelatihanpeserta_id" class="cv_historipelatihanpeserta_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_grid->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipelatihanpeserta_grid->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipelatihanpeserta_grid->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_grid->kdpelat->Visible) { // kdpelat ?>
	<?php if ($cv_historipelatihanpeserta_grid->SortUrl($cv_historipelatihanpeserta_grid->kdpelat) == "") { ?>
		<th data-name="kdpelat" class="<?php echo $cv_historipelatihanpeserta_grid->kdpelat->headerCellClass() ?>"><div id="elh_cv_historipelatihanpeserta_kdpelat" class="cv_historipelatihanpeserta_kdpelat"><div class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_grid->kdpelat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdpelat" class="<?php echo $cv_historipelatihanpeserta_grid->kdpelat->headerCellClass() ?>"><div><div id="elh_cv_historipelatihanpeserta_kdpelat" class="cv_historipelatihanpeserta_kdpelat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_grid->kdpelat->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipelatihanpeserta_grid->kdpelat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipelatihanpeserta_grid->kdpelat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_grid->tahun->Visible) { // tahun ?>
	<?php if ($cv_historipelatihanpeserta_grid->SortUrl($cv_historipelatihanpeserta_grid->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $cv_historipelatihanpeserta_grid->tahun->headerCellClass() ?>"><div id="elh_cv_historipelatihanpeserta_tahun" class="cv_historipelatihanpeserta_tahun"><div class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_grid->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $cv_historipelatihanpeserta_grid->tahun->headerCellClass() ?>"><div><div id="elh_cv_historipelatihanpeserta_tahun" class="cv_historipelatihanpeserta_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_grid->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipelatihanpeserta_grid->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipelatihanpeserta_grid->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_grid->kdinformasi->Visible) { // kdinformasi ?>
	<?php if ($cv_historipelatihanpeserta_grid->SortUrl($cv_historipelatihanpeserta_grid->kdinformasi) == "") { ?>
		<th data-name="kdinformasi" class="<?php echo $cv_historipelatihanpeserta_grid->kdinformasi->headerCellClass() ?>"><div id="elh_cv_historipelatihanpeserta_kdinformasi" class="cv_historipelatihanpeserta_kdinformasi"><div class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_grid->kdinformasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdinformasi" class="<?php echo $cv_historipelatihanpeserta_grid->kdinformasi->headerCellClass() ?>"><div><div id="elh_cv_historipelatihanpeserta_kdinformasi" class="cv_historipelatihanpeserta_kdinformasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_grid->kdinformasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipelatihanpeserta_grid->kdinformasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipelatihanpeserta_grid->kdinformasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_grid->harapan->Visible) { // harapan ?>
	<?php if ($cv_historipelatihanpeserta_grid->SortUrl($cv_historipelatihanpeserta_grid->harapan) == "") { ?>
		<th data-name="harapan" class="<?php echo $cv_historipelatihanpeserta_grid->harapan->headerCellClass() ?>"><div id="elh_cv_historipelatihanpeserta_harapan" class="cv_historipelatihanpeserta_harapan"><div class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_grid->harapan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="harapan" class="<?php echo $cv_historipelatihanpeserta_grid->harapan->headerCellClass() ?>"><div><div id="elh_cv_historipelatihanpeserta_harapan" class="cv_historipelatihanpeserta_harapan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_grid->harapan->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipelatihanpeserta_grid->harapan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipelatihanpeserta_grid->harapan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_grid->sertifikat->Visible) { // sertifikat ?>
	<?php if ($cv_historipelatihanpeserta_grid->SortUrl($cv_historipelatihanpeserta_grid->sertifikat) == "") { ?>
		<th data-name="sertifikat" class="<?php echo $cv_historipelatihanpeserta_grid->sertifikat->headerCellClass() ?>"><div id="elh_cv_historipelatihanpeserta_sertifikat" class="cv_historipelatihanpeserta_sertifikat"><div class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_grid->sertifikat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sertifikat" class="<?php echo $cv_historipelatihanpeserta_grid->sertifikat->headerCellClass() ?>"><div><div id="elh_cv_historipelatihanpeserta_sertifikat" class="cv_historipelatihanpeserta_sertifikat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_grid->sertifikat->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipelatihanpeserta_grid->sertifikat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipelatihanpeserta_grid->sertifikat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cv_historipelatihanpeserta_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$cv_historipelatihanpeserta_grid->StartRecord = 1;
$cv_historipelatihanpeserta_grid->StopRecord = $cv_historipelatihanpeserta_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($cv_historipelatihanpeserta->isConfirm() || $cv_historipelatihanpeserta_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($cv_historipelatihanpeserta_grid->FormKeyCountName) && ($cv_historipelatihanpeserta_grid->isGridAdd() || $cv_historipelatihanpeserta_grid->isGridEdit() || $cv_historipelatihanpeserta->isConfirm())) {
		$cv_historipelatihanpeserta_grid->KeyCount = $CurrentForm->getValue($cv_historipelatihanpeserta_grid->FormKeyCountName);
		$cv_historipelatihanpeserta_grid->StopRecord = $cv_historipelatihanpeserta_grid->StartRecord + $cv_historipelatihanpeserta_grid->KeyCount - 1;
	}
}
$cv_historipelatihanpeserta_grid->RecordCount = $cv_historipelatihanpeserta_grid->StartRecord - 1;
if ($cv_historipelatihanpeserta_grid->Recordset && !$cv_historipelatihanpeserta_grid->Recordset->EOF) {
	$cv_historipelatihanpeserta_grid->Recordset->moveFirst();
	$selectLimit = $cv_historipelatihanpeserta_grid->UseSelectLimit;
	if (!$selectLimit && $cv_historipelatihanpeserta_grid->StartRecord > 1)
		$cv_historipelatihanpeserta_grid->Recordset->move($cv_historipelatihanpeserta_grid->StartRecord - 1);
} elseif (!$cv_historipelatihanpeserta->AllowAddDeleteRow && $cv_historipelatihanpeserta_grid->StopRecord == 0) {
	$cv_historipelatihanpeserta_grid->StopRecord = $cv_historipelatihanpeserta->GridAddRowCount;
}

// Initialize aggregate
$cv_historipelatihanpeserta->RowType = ROWTYPE_AGGREGATEINIT;
$cv_historipelatihanpeserta->resetAttributes();
$cv_historipelatihanpeserta_grid->renderRow();
if ($cv_historipelatihanpeserta_grid->isGridAdd())
	$cv_historipelatihanpeserta_grid->RowIndex = 0;
if ($cv_historipelatihanpeserta_grid->isGridEdit())
	$cv_historipelatihanpeserta_grid->RowIndex = 0;
while ($cv_historipelatihanpeserta_grid->RecordCount < $cv_historipelatihanpeserta_grid->StopRecord) {
	$cv_historipelatihanpeserta_grid->RecordCount++;
	if ($cv_historipelatihanpeserta_grid->RecordCount >= $cv_historipelatihanpeserta_grid->StartRecord) {
		$cv_historipelatihanpeserta_grid->RowCount++;
		if ($cv_historipelatihanpeserta_grid->isGridAdd() || $cv_historipelatihanpeserta_grid->isGridEdit() || $cv_historipelatihanpeserta->isConfirm()) {
			$cv_historipelatihanpeserta_grid->RowIndex++;
			$CurrentForm->Index = $cv_historipelatihanpeserta_grid->RowIndex;
			if ($CurrentForm->hasValue($cv_historipelatihanpeserta_grid->FormActionName) && ($cv_historipelatihanpeserta->isConfirm() || $cv_historipelatihanpeserta_grid->EventCancelled))
				$cv_historipelatihanpeserta_grid->RowAction = strval($CurrentForm->getValue($cv_historipelatihanpeserta_grid->FormActionName));
			elseif ($cv_historipelatihanpeserta_grid->isGridAdd())
				$cv_historipelatihanpeserta_grid->RowAction = "insert";
			else
				$cv_historipelatihanpeserta_grid->RowAction = "";
		}

		// Set up key count
		$cv_historipelatihanpeserta_grid->KeyCount = $cv_historipelatihanpeserta_grid->RowIndex;

		// Init row class and style
		$cv_historipelatihanpeserta->resetAttributes();
		$cv_historipelatihanpeserta->CssClass = "";
		if ($cv_historipelatihanpeserta_grid->isGridAdd()) {
			if ($cv_historipelatihanpeserta->CurrentMode == "copy") {
				$cv_historipelatihanpeserta_grid->loadRowValues($cv_historipelatihanpeserta_grid->Recordset); // Load row values
				$cv_historipelatihanpeserta_grid->setRecordKey($cv_historipelatihanpeserta_grid->RowOldKey, $cv_historipelatihanpeserta_grid->Recordset); // Set old record key
			} else {
				$cv_historipelatihanpeserta_grid->loadRowValues(); // Load default values
				$cv_historipelatihanpeserta_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$cv_historipelatihanpeserta_grid->loadRowValues($cv_historipelatihanpeserta_grid->Recordset); // Load row values
		}
		$cv_historipelatihanpeserta->RowType = ROWTYPE_VIEW; // Render view
		if ($cv_historipelatihanpeserta_grid->isGridAdd()) // Grid add
			$cv_historipelatihanpeserta->RowType = ROWTYPE_ADD; // Render add
		if ($cv_historipelatihanpeserta_grid->isGridAdd() && $cv_historipelatihanpeserta->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$cv_historipelatihanpeserta_grid->restoreCurrentRowFormValues($cv_historipelatihanpeserta_grid->RowIndex); // Restore form values
		if ($cv_historipelatihanpeserta_grid->isGridEdit()) { // Grid edit
			if ($cv_historipelatihanpeserta->EventCancelled)
				$cv_historipelatihanpeserta_grid->restoreCurrentRowFormValues($cv_historipelatihanpeserta_grid->RowIndex); // Restore form values
			if ($cv_historipelatihanpeserta_grid->RowAction == "insert")
				$cv_historipelatihanpeserta->RowType = ROWTYPE_ADD; // Render add
			else
				$cv_historipelatihanpeserta->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($cv_historipelatihanpeserta_grid->isGridEdit() && ($cv_historipelatihanpeserta->RowType == ROWTYPE_EDIT || $cv_historipelatihanpeserta->RowType == ROWTYPE_ADD) && $cv_historipelatihanpeserta->EventCancelled) // Update failed
			$cv_historipelatihanpeserta_grid->restoreCurrentRowFormValues($cv_historipelatihanpeserta_grid->RowIndex); // Restore form values
		if ($cv_historipelatihanpeserta->RowType == ROWTYPE_EDIT) // Edit row
			$cv_historipelatihanpeserta_grid->EditRowCount++;
		if ($cv_historipelatihanpeserta->isConfirm()) // Confirm row
			$cv_historipelatihanpeserta_grid->restoreCurrentRowFormValues($cv_historipelatihanpeserta_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$cv_historipelatihanpeserta->RowAttrs->merge(["data-rowindex" => $cv_historipelatihanpeserta_grid->RowCount, "id" => "r" . $cv_historipelatihanpeserta_grid->RowCount . "_cv_historipelatihanpeserta", "data-rowtype" => $cv_historipelatihanpeserta->RowType]);

		// Render row
		$cv_historipelatihanpeserta_grid->renderRow();

		// Render list options
		$cv_historipelatihanpeserta_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($cv_historipelatihanpeserta_grid->RowAction != "delete" && $cv_historipelatihanpeserta_grid->RowAction != "insertdelete" && !($cv_historipelatihanpeserta_grid->RowAction == "insert" && $cv_historipelatihanpeserta->isConfirm() && $cv_historipelatihanpeserta_grid->emptyRow())) {
?>
	<tr <?php echo $cv_historipelatihanpeserta->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cv_historipelatihanpeserta_grid->ListOptions->render("body", "left", $cv_historipelatihanpeserta_grid->RowCount);
?>
	<?php if ($cv_historipelatihanpeserta_grid->kdhistori->Visible) { // kdhistori ?>
		<td data-name="kdhistori" <?php echo $cv_historipelatihanpeserta_grid->kdhistori->cellAttributes() ?>>
<?php if ($cv_historipelatihanpeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_kdhistori" class="form-group"></span>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdhistori" name="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdhistori" id="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdhistori->OldValue) ?>">
<?php } ?>
<?php if ($cv_historipelatihanpeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_kdhistori" class="form-group">
<span<?php echo $cv_historipelatihanpeserta_grid->kdhistori->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipelatihanpeserta_grid->kdhistori->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdhistori" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdhistori" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdhistori->CurrentValue) ?>">
<?php } ?>
<?php if ($cv_historipelatihanpeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_kdhistori">
<span<?php echo $cv_historipelatihanpeserta_grid->kdhistori->viewAttributes() ?>><?php echo $cv_historipelatihanpeserta_grid->kdhistori->getViewValue() ?></span>
</span>
<?php if (!$cv_historipelatihanpeserta->isConfirm()) { ?>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdhistori" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdhistori" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdhistori->FormValue) ?>">
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdhistori" name="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdhistori" id="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdhistori->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdhistori" name="fcv_historipelatihanpesertagrid$x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdhistori" id="fcv_historipelatihanpesertagrid$x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdhistori->FormValue) ?>">
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdhistori" name="fcv_historipelatihanpesertagrid$o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdhistori" id="fcv_historipelatihanpesertagrid$o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdhistori->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_historipelatihanpeserta_grid->id->Visible) { // id ?>
		<td data-name="id" <?php echo $cv_historipelatihanpeserta_grid->id->cellAttributes() ?>>
<?php if ($cv_historipelatihanpeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($cv_historipelatihanpeserta_grid->id->getSessionValue() != "") { ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_id" class="form-group">
<span<?php echo $cv_historipelatihanpeserta_grid->id->viewAttributes() ?>><?php if (!EmptyString($cv_historipelatihanpeserta_grid->id->ViewValue) && $cv_historipelatihanpeserta_grid->id->linkAttributes() != "") { ?>
<a<?php echo $cv_historipelatihanpeserta_grid->id->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipelatihanpeserta_grid->id->ViewValue)) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipelatihanpeserta_grid->id->ViewValue)) ?>">
<?php } ?></span>
</span>
<input type="hidden" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_id" class="form-group">
<?php
$onchange = $cv_historipelatihanpeserta_grid->id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_historipelatihanpeserta_grid->id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id">
	<input type="text" class="form-control" name="sv_x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" id="sv_x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" value="<?php echo RemoveHtml($cv_historipelatihanpeserta_grid->id->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->id->getPlaceHolder()) ?>"<?php echo $cv_historipelatihanpeserta_grid->id->editAttributes() ?>>
</span>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_id" data-value-separator="<?php echo $cv_historipelatihanpeserta_grid->id->displayValueSeparatorAttribute() ?>" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_historipelatihanpesertagrid"], function() {
	fcv_historipelatihanpesertagrid.createAutoSuggest({"id":"x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $cv_historipelatihanpeserta_grid->id->Lookup->getParamTag($cv_historipelatihanpeserta_grid, "p_x" . $cv_historipelatihanpeserta_grid->RowIndex . "_id") ?>
</span>
<?php } ?>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_id" name="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" id="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($cv_historipelatihanpeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($cv_historipelatihanpeserta_grid->id->getSessionValue() != "") { ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_id" class="form-group">
<span<?php echo $cv_historipelatihanpeserta_grid->id->viewAttributes() ?>><?php if (!EmptyString($cv_historipelatihanpeserta_grid->id->ViewValue) && $cv_historipelatihanpeserta_grid->id->linkAttributes() != "") { ?>
<a<?php echo $cv_historipelatihanpeserta_grid->id->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipelatihanpeserta_grid->id->ViewValue)) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipelatihanpeserta_grid->id->ViewValue)) ?>">
<?php } ?></span>
</span>
<input type="hidden" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_id" class="form-group">
<?php
$onchange = $cv_historipelatihanpeserta_grid->id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_historipelatihanpeserta_grid->id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id">
	<input type="text" class="form-control" name="sv_x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" id="sv_x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" value="<?php echo RemoveHtml($cv_historipelatihanpeserta_grid->id->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->id->getPlaceHolder()) ?>"<?php echo $cv_historipelatihanpeserta_grid->id->editAttributes() ?>>
</span>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_id" data-value-separator="<?php echo $cv_historipelatihanpeserta_grid->id->displayValueSeparatorAttribute() ?>" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_historipelatihanpesertagrid"], function() {
	fcv_historipelatihanpesertagrid.createAutoSuggest({"id":"x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $cv_historipelatihanpeserta_grid->id->Lookup->getParamTag($cv_historipelatihanpeserta_grid, "p_x" . $cv_historipelatihanpeserta_grid->RowIndex . "_id") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($cv_historipelatihanpeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_id">
<span<?php echo $cv_historipelatihanpeserta_grid->id->viewAttributes() ?>><?php if (!EmptyString($cv_historipelatihanpeserta_grid->id->getViewValue()) && $cv_historipelatihanpeserta_grid->id->linkAttributes() != "") { ?>
<a<?php echo $cv_historipelatihanpeserta_grid->id->linkAttributes() ?>><?php echo $cv_historipelatihanpeserta_grid->id->getViewValue() ?></a>
<?php } else { ?>
<?php echo $cv_historipelatihanpeserta_grid->id->getViewValue() ?>
<?php } ?></span>
</span>
<?php if (!$cv_historipelatihanpeserta->isConfirm()) { ?>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_id" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->id->FormValue) ?>">
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_id" name="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" id="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_id" name="fcv_historipelatihanpesertagrid$x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" id="fcv_historipelatihanpesertagrid$x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->id->FormValue) ?>">
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_id" name="fcv_historipelatihanpesertagrid$o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" id="fcv_historipelatihanpesertagrid$o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_historipelatihanpeserta_grid->kdpelat->Visible) { // kdpelat ?>
		<td data-name="kdpelat" <?php echo $cv_historipelatihanpeserta_grid->kdpelat->cellAttributes() ?>>
<?php if ($cv_historipelatihanpeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_kdpelat" class="form-group">
<?php
$onchange = $cv_historipelatihanpeserta_grid->kdpelat->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_historipelatihanpeserta_grid->kdpelat->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" id="sv_x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" value="<?php echo RemoveHtml($cv_historipelatihanpeserta_grid->kdpelat->EditValue) ?>" size="70" maxlength="19" placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdpelat->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdpelat->getPlaceHolder()) ?>"<?php echo $cv_historipelatihanpeserta_grid->kdpelat->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($cv_historipelatihanpeserta_grid->kdpelat->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($cv_historipelatihanpeserta_grid->kdpelat->ReadOnly || $cv_historipelatihanpeserta_grid->kdpelat->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdpelat" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $cv_historipelatihanpeserta_grid->kdpelat->displayValueSeparatorAttribute() ?>" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdpelat->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_historipelatihanpesertagrid"], function() {
	fcv_historipelatihanpesertagrid.createAutoSuggest({"id":"x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat","forceSelect":false,"minWidth":"100px","maxHeight":"120px"});
});
</script>
<?php echo $cv_historipelatihanpeserta_grid->kdpelat->Lookup->getParamTag($cv_historipelatihanpeserta_grid, "p_x" . $cv_historipelatihanpeserta_grid->RowIndex . "_kdpelat") ?>
</span>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdpelat" name="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" id="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdpelat->OldValue) ?>">
<?php } ?>
<?php if ($cv_historipelatihanpeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_kdpelat" class="form-group">
<span<?php echo $cv_historipelatihanpeserta_grid->kdpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipelatihanpeserta_grid->kdpelat->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdpelat" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdpelat->CurrentValue) ?>">
<?php } ?>
<?php if ($cv_historipelatihanpeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_kdpelat">
<span<?php echo $cv_historipelatihanpeserta_grid->kdpelat->viewAttributes() ?>><?php echo $cv_historipelatihanpeserta_grid->kdpelat->getViewValue() ?></span>
</span>
<?php if (!$cv_historipelatihanpeserta->isConfirm()) { ?>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdpelat" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdpelat->FormValue) ?>">
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdpelat" name="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" id="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdpelat->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdpelat" name="fcv_historipelatihanpesertagrid$x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" id="fcv_historipelatihanpesertagrid$x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdpelat->FormValue) ?>">
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdpelat" name="fcv_historipelatihanpesertagrid$o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" id="fcv_historipelatihanpesertagrid$o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdpelat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_historipelatihanpeserta_grid->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $cv_historipelatihanpeserta_grid->tahun->cellAttributes() ?>>
<?php if ($cv_historipelatihanpeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_tahun" class="form-group">
<input type="text" data-table="cv_historipelatihanpeserta" data-field="x_tahun" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_tahun" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->tahun->getPlaceHolder()) ?>" value="<?php echo $cv_historipelatihanpeserta_grid->tahun->EditValue ?>"<?php echo $cv_historipelatihanpeserta_grid->tahun->editAttributes() ?>>
</span>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_tahun" name="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_tahun" id="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->tahun->OldValue) ?>">
<?php } ?>
<?php if ($cv_historipelatihanpeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_tahun" class="form-group">
<input type="text" data-table="cv_historipelatihanpeserta" data-field="x_tahun" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_tahun" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->tahun->getPlaceHolder()) ?>" value="<?php echo $cv_historipelatihanpeserta_grid->tahun->EditValue ?>"<?php echo $cv_historipelatihanpeserta_grid->tahun->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($cv_historipelatihanpeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_tahun">
<span<?php echo $cv_historipelatihanpeserta_grid->tahun->viewAttributes() ?>><?php echo $cv_historipelatihanpeserta_grid->tahun->getViewValue() ?></span>
</span>
<?php if (!$cv_historipelatihanpeserta->isConfirm()) { ?>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_tahun" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_tahun" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->tahun->FormValue) ?>">
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_tahun" name="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_tahun" id="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->tahun->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_tahun" name="fcv_historipelatihanpesertagrid$x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_tahun" id="fcv_historipelatihanpesertagrid$x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->tahun->FormValue) ?>">
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_tahun" name="fcv_historipelatihanpesertagrid$o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_tahun" id="fcv_historipelatihanpesertagrid$o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->tahun->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_historipelatihanpeserta_grid->kdinformasi->Visible) { // kdinformasi ?>
		<td data-name="kdinformasi" <?php echo $cv_historipelatihanpeserta_grid->kdinformasi->cellAttributes() ?>>
<?php if ($cv_historipelatihanpeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_kdinformasi" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cv_historipelatihanpeserta" data-field="x_kdinformasi" data-value-separator="<?php echo $cv_historipelatihanpeserta_grid->kdinformasi->displayValueSeparatorAttribute() ?>" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdinformasi" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdinformasi"<?php echo $cv_historipelatihanpeserta_grid->kdinformasi->editAttributes() ?>>
			<?php echo $cv_historipelatihanpeserta_grid->kdinformasi->selectOptionListHtml("x{$cv_historipelatihanpeserta_grid->RowIndex}_kdinformasi") ?>
		</select>
</div>
<?php echo $cv_historipelatihanpeserta_grid->kdinformasi->Lookup->getParamTag($cv_historipelatihanpeserta_grid, "p_x" . $cv_historipelatihanpeserta_grid->RowIndex . "_kdinformasi") ?>
</span>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdinformasi" name="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdinformasi" id="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdinformasi->OldValue) ?>">
<?php } ?>
<?php if ($cv_historipelatihanpeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_kdinformasi" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cv_historipelatihanpeserta" data-field="x_kdinformasi" data-value-separator="<?php echo $cv_historipelatihanpeserta_grid->kdinformasi->displayValueSeparatorAttribute() ?>" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdinformasi" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdinformasi"<?php echo $cv_historipelatihanpeserta_grid->kdinformasi->editAttributes() ?>>
			<?php echo $cv_historipelatihanpeserta_grid->kdinformasi->selectOptionListHtml("x{$cv_historipelatihanpeserta_grid->RowIndex}_kdinformasi") ?>
		</select>
</div>
<?php echo $cv_historipelatihanpeserta_grid->kdinformasi->Lookup->getParamTag($cv_historipelatihanpeserta_grid, "p_x" . $cv_historipelatihanpeserta_grid->RowIndex . "_kdinformasi") ?>
</span>
<?php } ?>
<?php if ($cv_historipelatihanpeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_kdinformasi">
<span<?php echo $cv_historipelatihanpeserta_grid->kdinformasi->viewAttributes() ?>><?php echo $cv_historipelatihanpeserta_grid->kdinformasi->getViewValue() ?></span>
</span>
<?php if (!$cv_historipelatihanpeserta->isConfirm()) { ?>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdinformasi" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdinformasi" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdinformasi->FormValue) ?>">
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdinformasi" name="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdinformasi" id="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdinformasi->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdinformasi" name="fcv_historipelatihanpesertagrid$x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdinformasi" id="fcv_historipelatihanpesertagrid$x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdinformasi->FormValue) ?>">
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdinformasi" name="fcv_historipelatihanpesertagrid$o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdinformasi" id="fcv_historipelatihanpesertagrid$o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdinformasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_historipelatihanpeserta_grid->harapan->Visible) { // harapan ?>
		<td data-name="harapan" <?php echo $cv_historipelatihanpeserta_grid->harapan->cellAttributes() ?>>
<?php if ($cv_historipelatihanpeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_harapan" class="form-group">
<textarea data-table="cv_historipelatihanpeserta" data-field="x_harapan" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_harapan" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_harapan" cols="50" rows="4" placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->harapan->getPlaceHolder()) ?>"<?php echo $cv_historipelatihanpeserta_grid->harapan->editAttributes() ?>><?php echo $cv_historipelatihanpeserta_grid->harapan->EditValue ?></textarea>
</span>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_harapan" name="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_harapan" id="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_harapan" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->harapan->OldValue) ?>">
<?php } ?>
<?php if ($cv_historipelatihanpeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_harapan" class="form-group">
<textarea data-table="cv_historipelatihanpeserta" data-field="x_harapan" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_harapan" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_harapan" cols="50" rows="4" placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->harapan->getPlaceHolder()) ?>"<?php echo $cv_historipelatihanpeserta_grid->harapan->editAttributes() ?>><?php echo $cv_historipelatihanpeserta_grid->harapan->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($cv_historipelatihanpeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_harapan">
<span<?php echo $cv_historipelatihanpeserta_grid->harapan->viewAttributes() ?>><?php echo $cv_historipelatihanpeserta_grid->harapan->getViewValue() ?></span>
</span>
<?php if (!$cv_historipelatihanpeserta->isConfirm()) { ?>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_harapan" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_harapan" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_harapan" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->harapan->FormValue) ?>">
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_harapan" name="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_harapan" id="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_harapan" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->harapan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_harapan" name="fcv_historipelatihanpesertagrid$x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_harapan" id="fcv_historipelatihanpesertagrid$x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_harapan" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->harapan->FormValue) ?>">
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_harapan" name="fcv_historipelatihanpesertagrid$o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_harapan" id="fcv_historipelatihanpesertagrid$o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_harapan" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->harapan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_historipelatihanpeserta_grid->sertifikat->Visible) { // sertifikat ?>
		<td data-name="sertifikat" <?php echo $cv_historipelatihanpeserta_grid->sertifikat->cellAttributes() ?>>
<?php if ($cv_historipelatihanpeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_sertifikat" class="form-group">
<input type="text" data-table="cv_historipelatihanpeserta" data-field="x_sertifikat" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_sertifikat" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_sertifikat" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->sertifikat->getPlaceHolder()) ?>" value="<?php echo $cv_historipelatihanpeserta_grid->sertifikat->EditValue ?>"<?php echo $cv_historipelatihanpeserta_grid->sertifikat->editAttributes() ?>>
</span>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_sertifikat" name="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_sertifikat" id="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->sertifikat->OldValue) ?>">
<?php } ?>
<?php if ($cv_historipelatihanpeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_sertifikat" class="form-group">
<input type="text" data-table="cv_historipelatihanpeserta" data-field="x_sertifikat" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_sertifikat" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_sertifikat" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->sertifikat->getPlaceHolder()) ?>" value="<?php echo $cv_historipelatihanpeserta_grid->sertifikat->EditValue ?>"<?php echo $cv_historipelatihanpeserta_grid->sertifikat->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($cv_historipelatihanpeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_historipelatihanpeserta_grid->RowCount ?>_cv_historipelatihanpeserta_sertifikat">
<span<?php echo $cv_historipelatihanpeserta_grid->sertifikat->viewAttributes() ?>><?php echo $cv_historipelatihanpeserta_grid->sertifikat->getViewValue() ?></span>
</span>
<?php if (!$cv_historipelatihanpeserta->isConfirm()) { ?>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_sertifikat" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_sertifikat" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->sertifikat->FormValue) ?>">
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_sertifikat" name="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_sertifikat" id="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->sertifikat->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_sertifikat" name="fcv_historipelatihanpesertagrid$x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_sertifikat" id="fcv_historipelatihanpesertagrid$x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->sertifikat->FormValue) ?>">
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_sertifikat" name="fcv_historipelatihanpesertagrid$o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_sertifikat" id="fcv_historipelatihanpesertagrid$o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->sertifikat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cv_historipelatihanpeserta_grid->ListOptions->render("body", "right", $cv_historipelatihanpeserta_grid->RowCount);
?>
	</tr>
<?php if ($cv_historipelatihanpeserta->RowType == ROWTYPE_ADD || $cv_historipelatihanpeserta->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fcv_historipelatihanpesertagrid", "load"], function() {
	fcv_historipelatihanpesertagrid.updateLists(<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$cv_historipelatihanpeserta_grid->isGridAdd() || $cv_historipelatihanpeserta->CurrentMode == "copy")
		if (!$cv_historipelatihanpeserta_grid->Recordset->EOF)
			$cv_historipelatihanpeserta_grid->Recordset->moveNext();
}
?>
<?php
	if ($cv_historipelatihanpeserta->CurrentMode == "add" || $cv_historipelatihanpeserta->CurrentMode == "copy" || $cv_historipelatihanpeserta->CurrentMode == "edit") {
		$cv_historipelatihanpeserta_grid->RowIndex = '$rowindex$';
		$cv_historipelatihanpeserta_grid->loadRowValues();

		// Set row properties
		$cv_historipelatihanpeserta->resetAttributes();
		$cv_historipelatihanpeserta->RowAttrs->merge(["data-rowindex" => $cv_historipelatihanpeserta_grid->RowIndex, "id" => "r0_cv_historipelatihanpeserta", "data-rowtype" => ROWTYPE_ADD]);
		$cv_historipelatihanpeserta->RowAttrs->appendClass("ew-template");
		$cv_historipelatihanpeserta->RowType = ROWTYPE_ADD;

		// Render row
		$cv_historipelatihanpeserta_grid->renderRow();

		// Render list options
		$cv_historipelatihanpeserta_grid->renderListOptions();
		$cv_historipelatihanpeserta_grid->StartRowCount = 0;
?>
	<tr <?php echo $cv_historipelatihanpeserta->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cv_historipelatihanpeserta_grid->ListOptions->render("body", "left", $cv_historipelatihanpeserta_grid->RowIndex);
?>
	<?php if ($cv_historipelatihanpeserta_grid->kdhistori->Visible) { // kdhistori ?>
		<td data-name="kdhistori">
<?php if (!$cv_historipelatihanpeserta->isConfirm()) { ?>
<span id="el$rowindex$_cv_historipelatihanpeserta_kdhistori" class="form-group cv_historipelatihanpeserta_kdhistori"></span>
<?php } else { ?>
<span id="el$rowindex$_cv_historipelatihanpeserta_kdhistori" class="form-group cv_historipelatihanpeserta_kdhistori">
<span<?php echo $cv_historipelatihanpeserta_grid->kdhistori->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipelatihanpeserta_grid->kdhistori->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdhistori" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdhistori" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdhistori->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdhistori" name="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdhistori" id="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdhistori->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_historipelatihanpeserta_grid->id->Visible) { // id ?>
		<td data-name="id">
<?php if (!$cv_historipelatihanpeserta->isConfirm()) { ?>
<?php if ($cv_historipelatihanpeserta_grid->id->getSessionValue() != "") { ?>
<span id="el$rowindex$_cv_historipelatihanpeserta_id" class="form-group cv_historipelatihanpeserta_id">
<span<?php echo $cv_historipelatihanpeserta_grid->id->viewAttributes() ?>><?php if (!EmptyString($cv_historipelatihanpeserta_grid->id->ViewValue) && $cv_historipelatihanpeserta_grid->id->linkAttributes() != "") { ?>
<a<?php echo $cv_historipelatihanpeserta_grid->id->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipelatihanpeserta_grid->id->ViewValue)) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipelatihanpeserta_grid->id->ViewValue)) ?>">
<?php } ?></span>
</span>
<input type="hidden" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_cv_historipelatihanpeserta_id" class="form-group cv_historipelatihanpeserta_id">
<?php
$onchange = $cv_historipelatihanpeserta_grid->id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_historipelatihanpeserta_grid->id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id">
	<input type="text" class="form-control" name="sv_x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" id="sv_x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" value="<?php echo RemoveHtml($cv_historipelatihanpeserta_grid->id->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->id->getPlaceHolder()) ?>"<?php echo $cv_historipelatihanpeserta_grid->id->editAttributes() ?>>
</span>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_id" data-value-separator="<?php echo $cv_historipelatihanpeserta_grid->id->displayValueSeparatorAttribute() ?>" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_historipelatihanpesertagrid"], function() {
	fcv_historipelatihanpesertagrid.createAutoSuggest({"id":"x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $cv_historipelatihanpeserta_grid->id->Lookup->getParamTag($cv_historipelatihanpeserta_grid, "p_x" . $cv_historipelatihanpeserta_grid->RowIndex . "_id") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_cv_historipelatihanpeserta_id" class="form-group cv_historipelatihanpeserta_id">
<span<?php echo $cv_historipelatihanpeserta_grid->id->viewAttributes() ?>><?php if (!EmptyString($cv_historipelatihanpeserta_grid->id->ViewValue) && $cv_historipelatihanpeserta_grid->id->linkAttributes() != "") { ?>
<a<?php echo $cv_historipelatihanpeserta_grid->id->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipelatihanpeserta_grid->id->ViewValue)) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipelatihanpeserta_grid->id->ViewValue)) ?>">
<?php } ?></span>
</span>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_id" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_id" name="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" id="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_historipelatihanpeserta_grid->kdpelat->Visible) { // kdpelat ?>
		<td data-name="kdpelat">
<?php if (!$cv_historipelatihanpeserta->isConfirm()) { ?>
<span id="el$rowindex$_cv_historipelatihanpeserta_kdpelat" class="form-group cv_historipelatihanpeserta_kdpelat">
<?php
$onchange = $cv_historipelatihanpeserta_grid->kdpelat->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_historipelatihanpeserta_grid->kdpelat->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" id="sv_x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" value="<?php echo RemoveHtml($cv_historipelatihanpeserta_grid->kdpelat->EditValue) ?>" size="70" maxlength="19" placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdpelat->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdpelat->getPlaceHolder()) ?>"<?php echo $cv_historipelatihanpeserta_grid->kdpelat->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($cv_historipelatihanpeserta_grid->kdpelat->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($cv_historipelatihanpeserta_grid->kdpelat->ReadOnly || $cv_historipelatihanpeserta_grid->kdpelat->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdpelat" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $cv_historipelatihanpeserta_grid->kdpelat->displayValueSeparatorAttribute() ?>" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdpelat->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_historipelatihanpesertagrid"], function() {
	fcv_historipelatihanpesertagrid.createAutoSuggest({"id":"x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat","forceSelect":false,"minWidth":"100px","maxHeight":"120px"});
});
</script>
<?php echo $cv_historipelatihanpeserta_grid->kdpelat->Lookup->getParamTag($cv_historipelatihanpeserta_grid, "p_x" . $cv_historipelatihanpeserta_grid->RowIndex . "_kdpelat") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_cv_historipelatihanpeserta_kdpelat" class="form-group cv_historipelatihanpeserta_kdpelat">
<span<?php echo $cv_historipelatihanpeserta_grid->kdpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipelatihanpeserta_grid->kdpelat->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdpelat" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdpelat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdpelat" name="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" id="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdpelat->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_historipelatihanpeserta_grid->tahun->Visible) { // tahun ?>
		<td data-name="tahun">
<?php if (!$cv_historipelatihanpeserta->isConfirm()) { ?>
<span id="el$rowindex$_cv_historipelatihanpeserta_tahun" class="form-group cv_historipelatihanpeserta_tahun">
<input type="text" data-table="cv_historipelatihanpeserta" data-field="x_tahun" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_tahun" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->tahun->getPlaceHolder()) ?>" value="<?php echo $cv_historipelatihanpeserta_grid->tahun->EditValue ?>"<?php echo $cv_historipelatihanpeserta_grid->tahun->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cv_historipelatihanpeserta_tahun" class="form-group cv_historipelatihanpeserta_tahun">
<span<?php echo $cv_historipelatihanpeserta_grid->tahun->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipelatihanpeserta_grid->tahun->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_tahun" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_tahun" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->tahun->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_tahun" name="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_tahun" id="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->tahun->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_historipelatihanpeserta_grid->kdinformasi->Visible) { // kdinformasi ?>
		<td data-name="kdinformasi">
<?php if (!$cv_historipelatihanpeserta->isConfirm()) { ?>
<span id="el$rowindex$_cv_historipelatihanpeserta_kdinformasi" class="form-group cv_historipelatihanpeserta_kdinformasi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cv_historipelatihanpeserta" data-field="x_kdinformasi" data-value-separator="<?php echo $cv_historipelatihanpeserta_grid->kdinformasi->displayValueSeparatorAttribute() ?>" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdinformasi" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdinformasi"<?php echo $cv_historipelatihanpeserta_grid->kdinformasi->editAttributes() ?>>
			<?php echo $cv_historipelatihanpeserta_grid->kdinformasi->selectOptionListHtml("x{$cv_historipelatihanpeserta_grid->RowIndex}_kdinformasi") ?>
		</select>
</div>
<?php echo $cv_historipelatihanpeserta_grid->kdinformasi->Lookup->getParamTag($cv_historipelatihanpeserta_grid, "p_x" . $cv_historipelatihanpeserta_grid->RowIndex . "_kdinformasi") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_cv_historipelatihanpeserta_kdinformasi" class="form-group cv_historipelatihanpeserta_kdinformasi">
<span<?php echo $cv_historipelatihanpeserta_grid->kdinformasi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipelatihanpeserta_grid->kdinformasi->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdinformasi" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdinformasi" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdinformasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_kdinformasi" name="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdinformasi" id="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->kdinformasi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_historipelatihanpeserta_grid->harapan->Visible) { // harapan ?>
		<td data-name="harapan">
<?php if (!$cv_historipelatihanpeserta->isConfirm()) { ?>
<span id="el$rowindex$_cv_historipelatihanpeserta_harapan" class="form-group cv_historipelatihanpeserta_harapan">
<textarea data-table="cv_historipelatihanpeserta" data-field="x_harapan" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_harapan" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_harapan" cols="50" rows="4" placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->harapan->getPlaceHolder()) ?>"<?php echo $cv_historipelatihanpeserta_grid->harapan->editAttributes() ?>><?php echo $cv_historipelatihanpeserta_grid->harapan->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_cv_historipelatihanpeserta_harapan" class="form-group cv_historipelatihanpeserta_harapan">
<span<?php echo $cv_historipelatihanpeserta_grid->harapan->viewAttributes() ?>><?php echo $cv_historipelatihanpeserta_grid->harapan->ViewValue ?></span>
</span>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_harapan" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_harapan" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_harapan" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->harapan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_harapan" name="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_harapan" id="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_harapan" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->harapan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_historipelatihanpeserta_grid->sertifikat->Visible) { // sertifikat ?>
		<td data-name="sertifikat">
<?php if (!$cv_historipelatihanpeserta->isConfirm()) { ?>
<span id="el$rowindex$_cv_historipelatihanpeserta_sertifikat" class="form-group cv_historipelatihanpeserta_sertifikat">
<input type="text" data-table="cv_historipelatihanpeserta" data-field="x_sertifikat" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_sertifikat" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_sertifikat" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->sertifikat->getPlaceHolder()) ?>" value="<?php echo $cv_historipelatihanpeserta_grid->sertifikat->EditValue ?>"<?php echo $cv_historipelatihanpeserta_grid->sertifikat->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cv_historipelatihanpeserta_sertifikat" class="form-group cv_historipelatihanpeserta_sertifikat">
<span<?php echo $cv_historipelatihanpeserta_grid->sertifikat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipelatihanpeserta_grid->sertifikat->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_sertifikat" name="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_sertifikat" id="x<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->sertifikat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cv_historipelatihanpeserta" data-field="x_sertifikat" name="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_sertifikat" id="o<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_grid->sertifikat->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cv_historipelatihanpeserta_grid->ListOptions->render("body", "right", $cv_historipelatihanpeserta_grid->RowIndex);
?>
<script>
loadjs.ready(["fcv_historipelatihanpesertagrid", "load"], function() {
	fcv_historipelatihanpesertagrid.updateLists(<?php echo $cv_historipelatihanpeserta_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($cv_historipelatihanpeserta->CurrentMode == "add" || $cv_historipelatihanpeserta->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $cv_historipelatihanpeserta_grid->FormKeyCountName ?>" id="<?php echo $cv_historipelatihanpeserta_grid->FormKeyCountName ?>" value="<?php echo $cv_historipelatihanpeserta_grid->KeyCount ?>">
<?php echo $cv_historipelatihanpeserta_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cv_historipelatihanpeserta->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $cv_historipelatihanpeserta_grid->FormKeyCountName ?>" id="<?php echo $cv_historipelatihanpeserta_grid->FormKeyCountName ?>" value="<?php echo $cv_historipelatihanpeserta_grid->KeyCount ?>">
<?php echo $cv_historipelatihanpeserta_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cv_historipelatihanpeserta->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcv_historipelatihanpesertagrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cv_historipelatihanpeserta_grid->Recordset)
	$cv_historipelatihanpeserta_grid->Recordset->Close();
?>
<?php if ($cv_historipelatihanpeserta_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $cv_historipelatihanpeserta_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cv_historipelatihanpeserta_grid->TotalRecords == 0 && !$cv_historipelatihanpeserta->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cv_historipelatihanpeserta_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$cv_historipelatihanpeserta_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$("#r_id").hide();
});
</script>
<?php } ?>
<?php
$cv_historipelatihanpeserta_grid->terminate();
?>