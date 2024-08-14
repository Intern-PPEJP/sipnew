<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($cv_historipeserta_grid))
	$cv_historipeserta_grid = new cv_historipeserta_grid();

// Run the page
$cv_historipeserta_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cv_historipeserta_grid->Page_Render();
?>
<?php if (!$cv_historipeserta_grid->isExport()) { ?>
<script>
var fcv_historipesertagrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fcv_historipesertagrid = new ew.Form("fcv_historipesertagrid", "grid");
	fcv_historipesertagrid.formKeyCountName = '<?php echo $cv_historipeserta_grid->FormKeyCountName ?>';

	// Validate form
	fcv_historipesertagrid.validate = function() {
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
			<?php if ($cv_historipeserta_grid->kdhistori->Required) { ?>
				elm = this.getElements("x" + infix + "_kdhistori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_grid->kdhistori->caption(), $cv_historipeserta_grid->kdhistori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historipeserta_grid->kdpelat->Required) { ?>
				elm = this.getElements("x" + infix + "_kdpelat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_grid->kdpelat->caption(), $cv_historipeserta_grid->kdpelat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historipeserta_grid->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_grid->id->caption(), $cv_historipeserta_grid->id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cv_historipeserta_grid->id->errorMessage()) ?>");
			<?php if ($cv_historipeserta_grid->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_grid->tahun->caption(), $cv_historipeserta_grid->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cv_historipeserta_grid->tahun->errorMessage()) ?>");
			<?php if ($cv_historipeserta_grid->kdinformasi->Required) { ?>
				elm = this.getElements("x" + infix + "_kdinformasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_grid->kdinformasi->caption(), $cv_historipeserta_grid->kdinformasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historipeserta_grid->harapan->Required) { ?>
				elm = this.getElements("x" + infix + "_harapan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_grid->harapan->caption(), $cv_historipeserta_grid->harapan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historipeserta_grid->sertifikat->Required) { ?>
				elm = this.getElements("x" + infix + "_sertifikat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historipeserta_grid->sertifikat->caption(), $cv_historipeserta_grid->sertifikat->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fcv_historipesertagrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "kdpelat", false)) return false;
		if (ew.valueChanged(fobj, infix, "id", false)) return false;
		if (ew.valueChanged(fobj, infix, "tahun", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdinformasi", false)) return false;
		if (ew.valueChanged(fobj, infix, "harapan", false)) return false;
		if (ew.valueChanged(fobj, infix, "sertifikat", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fcv_historipesertagrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcv_historipesertagrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcv_historipesertagrid.lists["x_id"] = <?php echo $cv_historipeserta_grid->id->Lookup->toClientList($cv_historipeserta_grid) ?>;
	fcv_historipesertagrid.lists["x_id"].options = <?php echo JsonEncode($cv_historipeserta_grid->id->lookupOptions()) ?>;
	fcv_historipesertagrid.autoSuggests["x_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcv_historipesertagrid.lists["x_kdinformasi"] = <?php echo $cv_historipeserta_grid->kdinformasi->Lookup->toClientList($cv_historipeserta_grid) ?>;
	fcv_historipesertagrid.lists["x_kdinformasi"].options = <?php echo JsonEncode($cv_historipeserta_grid->kdinformasi->lookupOptions()) ?>;
	loadjs.done("fcv_historipesertagrid");
});
</script>
<?php } ?>
<?php
$cv_historipeserta_grid->renderOtherOptions();
?>
<?php if ($cv_historipeserta_grid->TotalRecords > 0 || $cv_historipeserta->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cv_historipeserta_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cv_historipeserta">
<?php if ($cv_historipeserta_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $cv_historipeserta_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fcv_historipesertagrid" class="ew-form ew-list-form form-inline">
<div id="gmp_cv_historipeserta" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_cv_historipesertagrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cv_historipeserta->RowType = ROWTYPE_HEADER;

// Render list options
$cv_historipeserta_grid->renderListOptions();

// Render list options (header, left)
$cv_historipeserta_grid->ListOptions->render("header", "left");
?>
<?php if ($cv_historipeserta_grid->kdhistori->Visible) { // kdhistori ?>
	<?php if ($cv_historipeserta_grid->SortUrl($cv_historipeserta_grid->kdhistori) == "") { ?>
		<th data-name="kdhistori" class="<?php echo $cv_historipeserta_grid->kdhistori->headerCellClass() ?>"><div id="elh_cv_historipeserta_kdhistori" class="cv_historipeserta_kdhistori"><div class="ew-table-header-caption"><?php echo $cv_historipeserta_grid->kdhistori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdhistori" class="<?php echo $cv_historipeserta_grid->kdhistori->headerCellClass() ?>"><div><div id="elh_cv_historipeserta_kdhistori" class="cv_historipeserta_kdhistori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipeserta_grid->kdhistori->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipeserta_grid->kdhistori->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipeserta_grid->kdhistori->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipeserta_grid->kdpelat->Visible) { // kdpelat ?>
	<?php if ($cv_historipeserta_grid->SortUrl($cv_historipeserta_grid->kdpelat) == "") { ?>
		<th data-name="kdpelat" class="<?php echo $cv_historipeserta_grid->kdpelat->headerCellClass() ?>"><div id="elh_cv_historipeserta_kdpelat" class="cv_historipeserta_kdpelat"><div class="ew-table-header-caption"><?php echo $cv_historipeserta_grid->kdpelat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdpelat" class="<?php echo $cv_historipeserta_grid->kdpelat->headerCellClass() ?>"><div><div id="elh_cv_historipeserta_kdpelat" class="cv_historipeserta_kdpelat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipeserta_grid->kdpelat->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipeserta_grid->kdpelat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipeserta_grid->kdpelat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipeserta_grid->id->Visible) { // id ?>
	<?php if ($cv_historipeserta_grid->SortUrl($cv_historipeserta_grid->id) == "") { ?>
		<th data-name="id" class="<?php echo $cv_historipeserta_grid->id->headerCellClass() ?>"><div id="elh_cv_historipeserta_id" class="cv_historipeserta_id"><div class="ew-table-header-caption"><?php echo $cv_historipeserta_grid->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $cv_historipeserta_grid->id->headerCellClass() ?>"><div><div id="elh_cv_historipeserta_id" class="cv_historipeserta_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipeserta_grid->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipeserta_grid->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipeserta_grid->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipeserta_grid->tahun->Visible) { // tahun ?>
	<?php if ($cv_historipeserta_grid->SortUrl($cv_historipeserta_grid->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $cv_historipeserta_grid->tahun->headerCellClass() ?>"><div id="elh_cv_historipeserta_tahun" class="cv_historipeserta_tahun"><div class="ew-table-header-caption"><?php echo $cv_historipeserta_grid->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $cv_historipeserta_grid->tahun->headerCellClass() ?>"><div><div id="elh_cv_historipeserta_tahun" class="cv_historipeserta_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipeserta_grid->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipeserta_grid->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipeserta_grid->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipeserta_grid->kdinformasi->Visible) { // kdinformasi ?>
	<?php if ($cv_historipeserta_grid->SortUrl($cv_historipeserta_grid->kdinformasi) == "") { ?>
		<th data-name="kdinformasi" class="<?php echo $cv_historipeserta_grid->kdinformasi->headerCellClass() ?>"><div id="elh_cv_historipeserta_kdinformasi" class="cv_historipeserta_kdinformasi"><div class="ew-table-header-caption"><?php echo $cv_historipeserta_grid->kdinformasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdinformasi" class="<?php echo $cv_historipeserta_grid->kdinformasi->headerCellClass() ?>"><div><div id="elh_cv_historipeserta_kdinformasi" class="cv_historipeserta_kdinformasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipeserta_grid->kdinformasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipeserta_grid->kdinformasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipeserta_grid->kdinformasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipeserta_grid->harapan->Visible) { // harapan ?>
	<?php if ($cv_historipeserta_grid->SortUrl($cv_historipeserta_grid->harapan) == "") { ?>
		<th data-name="harapan" class="<?php echo $cv_historipeserta_grid->harapan->headerCellClass() ?>"><div id="elh_cv_historipeserta_harapan" class="cv_historipeserta_harapan"><div class="ew-table-header-caption"><?php echo $cv_historipeserta_grid->harapan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="harapan" class="<?php echo $cv_historipeserta_grid->harapan->headerCellClass() ?>"><div><div id="elh_cv_historipeserta_harapan" class="cv_historipeserta_harapan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipeserta_grid->harapan->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipeserta_grid->harapan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipeserta_grid->harapan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipeserta_grid->sertifikat->Visible) { // sertifikat ?>
	<?php if ($cv_historipeserta_grid->SortUrl($cv_historipeserta_grid->sertifikat) == "") { ?>
		<th data-name="sertifikat" class="<?php echo $cv_historipeserta_grid->sertifikat->headerCellClass() ?>"><div id="elh_cv_historipeserta_sertifikat" class="cv_historipeserta_sertifikat"><div class="ew-table-header-caption"><?php echo $cv_historipeserta_grid->sertifikat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sertifikat" class="<?php echo $cv_historipeserta_grid->sertifikat->headerCellClass() ?>"><div><div id="elh_cv_historipeserta_sertifikat" class="cv_historipeserta_sertifikat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipeserta_grid->sertifikat->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipeserta_grid->sertifikat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipeserta_grid->sertifikat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cv_historipeserta_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$cv_historipeserta_grid->StartRecord = 1;
$cv_historipeserta_grid->StopRecord = $cv_historipeserta_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($cv_historipeserta->isConfirm() || $cv_historipeserta_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($cv_historipeserta_grid->FormKeyCountName) && ($cv_historipeserta_grid->isGridAdd() || $cv_historipeserta_grid->isGridEdit() || $cv_historipeserta->isConfirm())) {
		$cv_historipeserta_grid->KeyCount = $CurrentForm->getValue($cv_historipeserta_grid->FormKeyCountName);
		$cv_historipeserta_grid->StopRecord = $cv_historipeserta_grid->StartRecord + $cv_historipeserta_grid->KeyCount - 1;
	}
}
$cv_historipeserta_grid->RecordCount = $cv_historipeserta_grid->StartRecord - 1;
if ($cv_historipeserta_grid->Recordset && !$cv_historipeserta_grid->Recordset->EOF) {
	$cv_historipeserta_grid->Recordset->moveFirst();
	$selectLimit = $cv_historipeserta_grid->UseSelectLimit;
	if (!$selectLimit && $cv_historipeserta_grid->StartRecord > 1)
		$cv_historipeserta_grid->Recordset->move($cv_historipeserta_grid->StartRecord - 1);
} elseif (!$cv_historipeserta->AllowAddDeleteRow && $cv_historipeserta_grid->StopRecord == 0) {
	$cv_historipeserta_grid->StopRecord = $cv_historipeserta->GridAddRowCount;
}

// Initialize aggregate
$cv_historipeserta->RowType = ROWTYPE_AGGREGATEINIT;
$cv_historipeserta->resetAttributes();
$cv_historipeserta_grid->renderRow();
if ($cv_historipeserta_grid->isGridAdd())
	$cv_historipeserta_grid->RowIndex = 0;
if ($cv_historipeserta_grid->isGridEdit())
	$cv_historipeserta_grid->RowIndex = 0;
while ($cv_historipeserta_grid->RecordCount < $cv_historipeserta_grid->StopRecord) {
	$cv_historipeserta_grid->RecordCount++;
	if ($cv_historipeserta_grid->RecordCount >= $cv_historipeserta_grid->StartRecord) {
		$cv_historipeserta_grid->RowCount++;
		if ($cv_historipeserta_grid->isGridAdd() || $cv_historipeserta_grid->isGridEdit() || $cv_historipeserta->isConfirm()) {
			$cv_historipeserta_grid->RowIndex++;
			$CurrentForm->Index = $cv_historipeserta_grid->RowIndex;
			if ($CurrentForm->hasValue($cv_historipeserta_grid->FormActionName) && ($cv_historipeserta->isConfirm() || $cv_historipeserta_grid->EventCancelled))
				$cv_historipeserta_grid->RowAction = strval($CurrentForm->getValue($cv_historipeserta_grid->FormActionName));
			elseif ($cv_historipeserta_grid->isGridAdd())
				$cv_historipeserta_grid->RowAction = "insert";
			else
				$cv_historipeserta_grid->RowAction = "";
		}

		// Set up key count
		$cv_historipeserta_grid->KeyCount = $cv_historipeserta_grid->RowIndex;

		// Init row class and style
		$cv_historipeserta->resetAttributes();
		$cv_historipeserta->CssClass = "";
		if ($cv_historipeserta_grid->isGridAdd()) {
			if ($cv_historipeserta->CurrentMode == "copy") {
				$cv_historipeserta_grid->loadRowValues($cv_historipeserta_grid->Recordset); // Load row values
				$cv_historipeserta_grid->setRecordKey($cv_historipeserta_grid->RowOldKey, $cv_historipeserta_grid->Recordset); // Set old record key
			} else {
				$cv_historipeserta_grid->loadRowValues(); // Load default values
				$cv_historipeserta_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$cv_historipeserta_grid->loadRowValues($cv_historipeserta_grid->Recordset); // Load row values
		}
		$cv_historipeserta->RowType = ROWTYPE_VIEW; // Render view
		if ($cv_historipeserta_grid->isGridAdd()) // Grid add
			$cv_historipeserta->RowType = ROWTYPE_ADD; // Render add
		if ($cv_historipeserta_grid->isGridAdd() && $cv_historipeserta->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$cv_historipeserta_grid->restoreCurrentRowFormValues($cv_historipeserta_grid->RowIndex); // Restore form values
		if ($cv_historipeserta_grid->isGridEdit()) { // Grid edit
			if ($cv_historipeserta->EventCancelled)
				$cv_historipeserta_grid->restoreCurrentRowFormValues($cv_historipeserta_grid->RowIndex); // Restore form values
			if ($cv_historipeserta_grid->RowAction == "insert")
				$cv_historipeserta->RowType = ROWTYPE_ADD; // Render add
			else
				$cv_historipeserta->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($cv_historipeserta_grid->isGridEdit() && ($cv_historipeserta->RowType == ROWTYPE_EDIT || $cv_historipeserta->RowType == ROWTYPE_ADD) && $cv_historipeserta->EventCancelled) // Update failed
			$cv_historipeserta_grid->restoreCurrentRowFormValues($cv_historipeserta_grid->RowIndex); // Restore form values
		if ($cv_historipeserta->RowType == ROWTYPE_EDIT) // Edit row
			$cv_historipeserta_grid->EditRowCount++;
		if ($cv_historipeserta->isConfirm()) // Confirm row
			$cv_historipeserta_grid->restoreCurrentRowFormValues($cv_historipeserta_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$cv_historipeserta->RowAttrs->merge(["data-rowindex" => $cv_historipeserta_grid->RowCount, "id" => "r" . $cv_historipeserta_grid->RowCount . "_cv_historipeserta", "data-rowtype" => $cv_historipeserta->RowType]);

		// Render row
		$cv_historipeserta_grid->renderRow();

		// Render list options
		$cv_historipeserta_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($cv_historipeserta_grid->RowAction != "delete" && $cv_historipeserta_grid->RowAction != "insertdelete" && !($cv_historipeserta_grid->RowAction == "insert" && $cv_historipeserta->isConfirm() && $cv_historipeserta_grid->emptyRow())) {
?>
	<tr <?php echo $cv_historipeserta->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cv_historipeserta_grid->ListOptions->render("body", "left", $cv_historipeserta_grid->RowCount);
?>
	<?php if ($cv_historipeserta_grid->kdhistori->Visible) { // kdhistori ?>
		<td data-name="kdhistori" <?php echo $cv_historipeserta_grid->kdhistori->cellAttributes() ?>>
<?php if ($cv_historipeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_historipeserta_grid->RowCount ?>_cv_historipeserta_kdhistori" class="form-group"></span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdhistori" name="o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdhistori" id="o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdhistori->OldValue) ?>">
<?php } ?>
<?php if ($cv_historipeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cv_historipeserta_grid->RowCount ?>_cv_historipeserta_kdhistori" class="form-group">
<span<?php echo $cv_historipeserta_grid->kdhistori->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipeserta_grid->kdhistori->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdhistori" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdhistori" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdhistori->CurrentValue) ?>">
<?php } ?>
<?php if ($cv_historipeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_historipeserta_grid->RowCount ?>_cv_historipeserta_kdhistori">
<span<?php echo $cv_historipeserta_grid->kdhistori->viewAttributes() ?>><?php echo $cv_historipeserta_grid->kdhistori->getViewValue() ?></span>
</span>
<?php if (!$cv_historipeserta->isConfirm()) { ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdhistori" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdhistori" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdhistori->FormValue) ?>">
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdhistori" name="o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdhistori" id="o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdhistori->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdhistori" name="fcv_historipesertagrid$x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdhistori" id="fcv_historipesertagrid$x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdhistori->FormValue) ?>">
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdhistori" name="fcv_historipesertagrid$o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdhistori" id="fcv_historipesertagrid$o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdhistori->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_grid->kdpelat->Visible) { // kdpelat ?>
		<td data-name="kdpelat" <?php echo $cv_historipeserta_grid->kdpelat->cellAttributes() ?>>
<?php if ($cv_historipeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($cv_historipeserta_grid->kdpelat->getSessionValue() != "") { ?>
<span id="el<?php echo $cv_historipeserta_grid->RowCount ?>_cv_historipeserta_kdpelat" class="form-group">
<span<?php echo $cv_historipeserta_grid->kdpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipeserta_grid->kdpelat->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdpelat->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cv_historipeserta_grid->RowCount ?>_cv_historipeserta_kdpelat" class="form-group">
<input type="text" data-table="cv_historipeserta" data-field="x_kdpelat" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($cv_historipeserta_grid->kdpelat->getPlaceHolder()) ?>" value="<?php echo $cv_historipeserta_grid->kdpelat->EditValue ?>"<?php echo $cv_historipeserta_grid->kdpelat->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdpelat" name="o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" id="o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdpelat->OldValue) ?>">
<?php } ?>
<?php if ($cv_historipeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cv_historipeserta_grid->RowCount ?>_cv_historipeserta_kdpelat" class="form-group">
<span<?php echo $cv_historipeserta_grid->kdpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipeserta_grid->kdpelat->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdpelat" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdpelat->CurrentValue) ?>">
<?php } ?>
<?php if ($cv_historipeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_historipeserta_grid->RowCount ?>_cv_historipeserta_kdpelat">
<span<?php echo $cv_historipeserta_grid->kdpelat->viewAttributes() ?>><?php echo $cv_historipeserta_grid->kdpelat->getViewValue() ?></span>
</span>
<?php if (!$cv_historipeserta->isConfirm()) { ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdpelat" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdpelat->FormValue) ?>">
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdpelat" name="o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" id="o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdpelat->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdpelat" name="fcv_historipesertagrid$x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" id="fcv_historipesertagrid$x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdpelat->FormValue) ?>">
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdpelat" name="fcv_historipesertagrid$o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" id="fcv_historipesertagrid$o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdpelat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_grid->id->Visible) { // id ?>
		<td data-name="id" <?php echo $cv_historipeserta_grid->id->cellAttributes() ?>>
<?php if ($cv_historipeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_historipeserta_grid->RowCount ?>_cv_historipeserta_id" class="form-group">
<?php
$onchange = $cv_historipeserta_grid->id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_historipeserta_grid->id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $cv_historipeserta_grid->RowIndex ?>_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $cv_historipeserta_grid->RowIndex ?>_id" id="sv_x<?php echo $cv_historipeserta_grid->RowIndex ?>_id" value="<?php echo RemoveHtml($cv_historipeserta_grid->id->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($cv_historipeserta_grid->id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_historipeserta_grid->id->getPlaceHolder()) ?>"<?php echo $cv_historipeserta_grid->id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($cv_historipeserta_grid->id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $cv_historipeserta_grid->RowIndex ?>_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($cv_historipeserta_grid->id->ReadOnly || $cv_historipeserta_grid->id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $cv_historipeserta_grid->id->displayValueSeparatorAttribute() ?>" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_id" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipeserta_grid->id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_historipesertagrid"], function() {
	fcv_historipesertagrid.createAutoSuggest({"id":"x<?php echo $cv_historipeserta_grid->RowIndex ?>_id","forceSelect":false,"minWidth":"100px","maxHeight":"100px"});
});
</script>
<?php echo $cv_historipeserta_grid->id->Lookup->getParamTag($cv_historipeserta_grid, "p_x" . $cv_historipeserta_grid->RowIndex . "_id") ?>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_id" name="o<?php echo $cv_historipeserta_grid->RowIndex ?>_id" id="o<?php echo $cv_historipeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipeserta_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($cv_historipeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cv_historipeserta_grid->RowCount ?>_cv_historipeserta_id" class="form-group">
<?php
$onchange = $cv_historipeserta_grid->id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_historipeserta_grid->id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $cv_historipeserta_grid->RowIndex ?>_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $cv_historipeserta_grid->RowIndex ?>_id" id="sv_x<?php echo $cv_historipeserta_grid->RowIndex ?>_id" value="<?php echo RemoveHtml($cv_historipeserta_grid->id->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($cv_historipeserta_grid->id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_historipeserta_grid->id->getPlaceHolder()) ?>"<?php echo $cv_historipeserta_grid->id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($cv_historipeserta_grid->id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $cv_historipeserta_grid->RowIndex ?>_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($cv_historipeserta_grid->id->ReadOnly || $cv_historipeserta_grid->id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $cv_historipeserta_grid->id->displayValueSeparatorAttribute() ?>" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_id" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipeserta_grid->id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_historipesertagrid"], function() {
	fcv_historipesertagrid.createAutoSuggest({"id":"x<?php echo $cv_historipeserta_grid->RowIndex ?>_id","forceSelect":false,"minWidth":"100px","maxHeight":"100px"});
});
</script>
<?php echo $cv_historipeserta_grid->id->Lookup->getParamTag($cv_historipeserta_grid, "p_x" . $cv_historipeserta_grid->RowIndex . "_id") ?>
</span>
<?php } ?>
<?php if ($cv_historipeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_historipeserta_grid->RowCount ?>_cv_historipeserta_id">
<span<?php echo $cv_historipeserta_grid->id->viewAttributes() ?>><?php echo $cv_historipeserta_grid->id->getViewValue() ?></span>
</span>
<?php if (!$cv_historipeserta->isConfirm()) { ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_id" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_id" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipeserta_grid->id->FormValue) ?>">
<input type="hidden" data-table="cv_historipeserta" data-field="x_id" name="o<?php echo $cv_historipeserta_grid->RowIndex ?>_id" id="o<?php echo $cv_historipeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipeserta_grid->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_id" name="fcv_historipesertagrid$x<?php echo $cv_historipeserta_grid->RowIndex ?>_id" id="fcv_historipesertagrid$x<?php echo $cv_historipeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipeserta_grid->id->FormValue) ?>">
<input type="hidden" data-table="cv_historipeserta" data-field="x_id" name="fcv_historipesertagrid$o<?php echo $cv_historipeserta_grid->RowIndex ?>_id" id="fcv_historipesertagrid$o<?php echo $cv_historipeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipeserta_grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_grid->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $cv_historipeserta_grid->tahun->cellAttributes() ?>>
<?php if ($cv_historipeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_historipeserta_grid->RowCount ?>_cv_historipeserta_tahun" class="form-group">
<input type="text" data-table="cv_historipeserta" data-field="x_tahun" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_tahun" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($cv_historipeserta_grid->tahun->getPlaceHolder()) ?>" value="<?php echo $cv_historipeserta_grid->tahun->EditValue ?>"<?php echo $cv_historipeserta_grid->tahun->editAttributes() ?>>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_tahun" name="o<?php echo $cv_historipeserta_grid->RowIndex ?>_tahun" id="o<?php echo $cv_historipeserta_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($cv_historipeserta_grid->tahun->OldValue) ?>">
<?php } ?>
<?php if ($cv_historipeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cv_historipeserta_grid->RowCount ?>_cv_historipeserta_tahun" class="form-group">
<input type="text" data-table="cv_historipeserta" data-field="x_tahun" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_tahun" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($cv_historipeserta_grid->tahun->getPlaceHolder()) ?>" value="<?php echo $cv_historipeserta_grid->tahun->EditValue ?>"<?php echo $cv_historipeserta_grid->tahun->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($cv_historipeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_historipeserta_grid->RowCount ?>_cv_historipeserta_tahun">
<span<?php echo $cv_historipeserta_grid->tahun->viewAttributes() ?>><?php echo $cv_historipeserta_grid->tahun->getViewValue() ?></span>
</span>
<?php if (!$cv_historipeserta->isConfirm()) { ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_tahun" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_tahun" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($cv_historipeserta_grid->tahun->FormValue) ?>">
<input type="hidden" data-table="cv_historipeserta" data-field="x_tahun" name="o<?php echo $cv_historipeserta_grid->RowIndex ?>_tahun" id="o<?php echo $cv_historipeserta_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($cv_historipeserta_grid->tahun->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_tahun" name="fcv_historipesertagrid$x<?php echo $cv_historipeserta_grid->RowIndex ?>_tahun" id="fcv_historipesertagrid$x<?php echo $cv_historipeserta_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($cv_historipeserta_grid->tahun->FormValue) ?>">
<input type="hidden" data-table="cv_historipeserta" data-field="x_tahun" name="fcv_historipesertagrid$o<?php echo $cv_historipeserta_grid->RowIndex ?>_tahun" id="fcv_historipesertagrid$o<?php echo $cv_historipeserta_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($cv_historipeserta_grid->tahun->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_grid->kdinformasi->Visible) { // kdinformasi ?>
		<td data-name="kdinformasi" <?php echo $cv_historipeserta_grid->kdinformasi->cellAttributes() ?>>
<?php if ($cv_historipeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_historipeserta_grid->RowCount ?>_cv_historipeserta_kdinformasi" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cv_historipeserta" data-field="x_kdinformasi" data-value-separator="<?php echo $cv_historipeserta_grid->kdinformasi->displayValueSeparatorAttribute() ?>" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdinformasi" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdinformasi"<?php echo $cv_historipeserta_grid->kdinformasi->editAttributes() ?>>
			<?php echo $cv_historipeserta_grid->kdinformasi->selectOptionListHtml("x{$cv_historipeserta_grid->RowIndex}_kdinformasi") ?>
		</select>
</div>
<?php echo $cv_historipeserta_grid->kdinformasi->Lookup->getParamTag($cv_historipeserta_grid, "p_x" . $cv_historipeserta_grid->RowIndex . "_kdinformasi") ?>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdinformasi" name="o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdinformasi" id="o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdinformasi->OldValue) ?>">
<?php } ?>
<?php if ($cv_historipeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cv_historipeserta_grid->RowCount ?>_cv_historipeserta_kdinformasi" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cv_historipeserta" data-field="x_kdinformasi" data-value-separator="<?php echo $cv_historipeserta_grid->kdinformasi->displayValueSeparatorAttribute() ?>" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdinformasi" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdinformasi"<?php echo $cv_historipeserta_grid->kdinformasi->editAttributes() ?>>
			<?php echo $cv_historipeserta_grid->kdinformasi->selectOptionListHtml("x{$cv_historipeserta_grid->RowIndex}_kdinformasi") ?>
		</select>
</div>
<?php echo $cv_historipeserta_grid->kdinformasi->Lookup->getParamTag($cv_historipeserta_grid, "p_x" . $cv_historipeserta_grid->RowIndex . "_kdinformasi") ?>
</span>
<?php } ?>
<?php if ($cv_historipeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_historipeserta_grid->RowCount ?>_cv_historipeserta_kdinformasi">
<span<?php echo $cv_historipeserta_grid->kdinformasi->viewAttributes() ?>><?php echo $cv_historipeserta_grid->kdinformasi->getViewValue() ?></span>
</span>
<?php if (!$cv_historipeserta->isConfirm()) { ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdinformasi" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdinformasi" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdinformasi->FormValue) ?>">
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdinformasi" name="o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdinformasi" id="o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdinformasi->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdinformasi" name="fcv_historipesertagrid$x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdinformasi" id="fcv_historipesertagrid$x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdinformasi->FormValue) ?>">
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdinformasi" name="fcv_historipesertagrid$o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdinformasi" id="fcv_historipesertagrid$o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdinformasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_grid->harapan->Visible) { // harapan ?>
		<td data-name="harapan" <?php echo $cv_historipeserta_grid->harapan->cellAttributes() ?>>
<?php if ($cv_historipeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_historipeserta_grid->RowCount ?>_cv_historipeserta_harapan" class="form-group">
<textarea data-table="cv_historipeserta" data-field="x_harapan" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_harapan" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_harapan" cols="50" rows="4" placeholder="<?php echo HtmlEncode($cv_historipeserta_grid->harapan->getPlaceHolder()) ?>"<?php echo $cv_historipeserta_grid->harapan->editAttributes() ?>><?php echo $cv_historipeserta_grid->harapan->EditValue ?></textarea>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_harapan" name="o<?php echo $cv_historipeserta_grid->RowIndex ?>_harapan" id="o<?php echo $cv_historipeserta_grid->RowIndex ?>_harapan" value="<?php echo HtmlEncode($cv_historipeserta_grid->harapan->OldValue) ?>">
<?php } ?>
<?php if ($cv_historipeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cv_historipeserta_grid->RowCount ?>_cv_historipeserta_harapan" class="form-group">
<textarea data-table="cv_historipeserta" data-field="x_harapan" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_harapan" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_harapan" cols="50" rows="4" placeholder="<?php echo HtmlEncode($cv_historipeserta_grid->harapan->getPlaceHolder()) ?>"<?php echo $cv_historipeserta_grid->harapan->editAttributes() ?>><?php echo $cv_historipeserta_grid->harapan->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($cv_historipeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_historipeserta_grid->RowCount ?>_cv_historipeserta_harapan">
<span<?php echo $cv_historipeserta_grid->harapan->viewAttributes() ?>><?php echo $cv_historipeserta_grid->harapan->getViewValue() ?></span>
</span>
<?php if (!$cv_historipeserta->isConfirm()) { ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_harapan" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_harapan" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_harapan" value="<?php echo HtmlEncode($cv_historipeserta_grid->harapan->FormValue) ?>">
<input type="hidden" data-table="cv_historipeserta" data-field="x_harapan" name="o<?php echo $cv_historipeserta_grid->RowIndex ?>_harapan" id="o<?php echo $cv_historipeserta_grid->RowIndex ?>_harapan" value="<?php echo HtmlEncode($cv_historipeserta_grid->harapan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_harapan" name="fcv_historipesertagrid$x<?php echo $cv_historipeserta_grid->RowIndex ?>_harapan" id="fcv_historipesertagrid$x<?php echo $cv_historipeserta_grid->RowIndex ?>_harapan" value="<?php echo HtmlEncode($cv_historipeserta_grid->harapan->FormValue) ?>">
<input type="hidden" data-table="cv_historipeserta" data-field="x_harapan" name="fcv_historipesertagrid$o<?php echo $cv_historipeserta_grid->RowIndex ?>_harapan" id="fcv_historipesertagrid$o<?php echo $cv_historipeserta_grid->RowIndex ?>_harapan" value="<?php echo HtmlEncode($cv_historipeserta_grid->harapan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_grid->sertifikat->Visible) { // sertifikat ?>
		<td data-name="sertifikat" <?php echo $cv_historipeserta_grid->sertifikat->cellAttributes() ?>>
<?php if ($cv_historipeserta->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_historipeserta_grid->RowCount ?>_cv_historipeserta_sertifikat" class="form-group">
<input type="text" data-table="cv_historipeserta" data-field="x_sertifikat" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_sertifikat" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_sertifikat" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($cv_historipeserta_grid->sertifikat->getPlaceHolder()) ?>" value="<?php echo $cv_historipeserta_grid->sertifikat->EditValue ?>"<?php echo $cv_historipeserta_grid->sertifikat->editAttributes() ?>>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_sertifikat" name="o<?php echo $cv_historipeserta_grid->RowIndex ?>_sertifikat" id="o<?php echo $cv_historipeserta_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($cv_historipeserta_grid->sertifikat->OldValue) ?>">
<?php } ?>
<?php if ($cv_historipeserta->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cv_historipeserta_grid->RowCount ?>_cv_historipeserta_sertifikat" class="form-group">
<input type="text" data-table="cv_historipeserta" data-field="x_sertifikat" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_sertifikat" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_sertifikat" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($cv_historipeserta_grid->sertifikat->getPlaceHolder()) ?>" value="<?php echo $cv_historipeserta_grid->sertifikat->EditValue ?>"<?php echo $cv_historipeserta_grid->sertifikat->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($cv_historipeserta->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_historipeserta_grid->RowCount ?>_cv_historipeserta_sertifikat">
<span<?php echo $cv_historipeserta_grid->sertifikat->viewAttributes() ?>><?php echo $cv_historipeserta_grid->sertifikat->getViewValue() ?></span>
</span>
<?php if (!$cv_historipeserta->isConfirm()) { ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_sertifikat" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_sertifikat" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($cv_historipeserta_grid->sertifikat->FormValue) ?>">
<input type="hidden" data-table="cv_historipeserta" data-field="x_sertifikat" name="o<?php echo $cv_historipeserta_grid->RowIndex ?>_sertifikat" id="o<?php echo $cv_historipeserta_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($cv_historipeserta_grid->sertifikat->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_sertifikat" name="fcv_historipesertagrid$x<?php echo $cv_historipeserta_grid->RowIndex ?>_sertifikat" id="fcv_historipesertagrid$x<?php echo $cv_historipeserta_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($cv_historipeserta_grid->sertifikat->FormValue) ?>">
<input type="hidden" data-table="cv_historipeserta" data-field="x_sertifikat" name="fcv_historipesertagrid$o<?php echo $cv_historipeserta_grid->RowIndex ?>_sertifikat" id="fcv_historipesertagrid$o<?php echo $cv_historipeserta_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($cv_historipeserta_grid->sertifikat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cv_historipeserta_grid->ListOptions->render("body", "right", $cv_historipeserta_grid->RowCount);
?>
	</tr>
<?php if ($cv_historipeserta->RowType == ROWTYPE_ADD || $cv_historipeserta->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fcv_historipesertagrid", "load"], function() {
	fcv_historipesertagrid.updateLists(<?php echo $cv_historipeserta_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$cv_historipeserta_grid->isGridAdd() || $cv_historipeserta->CurrentMode == "copy")
		if (!$cv_historipeserta_grid->Recordset->EOF)
			$cv_historipeserta_grid->Recordset->moveNext();
}
?>
<?php
	if ($cv_historipeserta->CurrentMode == "add" || $cv_historipeserta->CurrentMode == "copy" || $cv_historipeserta->CurrentMode == "edit") {
		$cv_historipeserta_grid->RowIndex = '$rowindex$';
		$cv_historipeserta_grid->loadRowValues();

		// Set row properties
		$cv_historipeserta->resetAttributes();
		$cv_historipeserta->RowAttrs->merge(["data-rowindex" => $cv_historipeserta_grid->RowIndex, "id" => "r0_cv_historipeserta", "data-rowtype" => ROWTYPE_ADD]);
		$cv_historipeserta->RowAttrs->appendClass("ew-template");
		$cv_historipeserta->RowType = ROWTYPE_ADD;

		// Render row
		$cv_historipeserta_grid->renderRow();

		// Render list options
		$cv_historipeserta_grid->renderListOptions();
		$cv_historipeserta_grid->StartRowCount = 0;
?>
	<tr <?php echo $cv_historipeserta->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cv_historipeserta_grid->ListOptions->render("body", "left", $cv_historipeserta_grid->RowIndex);
?>
	<?php if ($cv_historipeserta_grid->kdhistori->Visible) { // kdhistori ?>
		<td data-name="kdhistori">
<?php if (!$cv_historipeserta->isConfirm()) { ?>
<span id="el$rowindex$_cv_historipeserta_kdhistori" class="form-group cv_historipeserta_kdhistori"></span>
<?php } else { ?>
<span id="el$rowindex$_cv_historipeserta_kdhistori" class="form-group cv_historipeserta_kdhistori">
<span<?php echo $cv_historipeserta_grid->kdhistori->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipeserta_grid->kdhistori->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdhistori" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdhistori" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdhistori->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdhistori" name="o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdhistori" id="o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdhistori->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_grid->kdpelat->Visible) { // kdpelat ?>
		<td data-name="kdpelat">
<?php if (!$cv_historipeserta->isConfirm()) { ?>
<?php if ($cv_historipeserta_grid->kdpelat->getSessionValue() != "") { ?>
<span id="el$rowindex$_cv_historipeserta_kdpelat" class="form-group cv_historipeserta_kdpelat">
<span<?php echo $cv_historipeserta_grid->kdpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipeserta_grid->kdpelat->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdpelat->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_cv_historipeserta_kdpelat" class="form-group cv_historipeserta_kdpelat">
<input type="text" data-table="cv_historipeserta" data-field="x_kdpelat" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($cv_historipeserta_grid->kdpelat->getPlaceHolder()) ?>" value="<?php echo $cv_historipeserta_grid->kdpelat->EditValue ?>"<?php echo $cv_historipeserta_grid->kdpelat->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_cv_historipeserta_kdpelat" class="form-group cv_historipeserta_kdpelat">
<span<?php echo $cv_historipeserta_grid->kdpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipeserta_grid->kdpelat->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdpelat" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdpelat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdpelat" name="o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" id="o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdpelat" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdpelat->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_grid->id->Visible) { // id ?>
		<td data-name="id">
<?php if (!$cv_historipeserta->isConfirm()) { ?>
<span id="el$rowindex$_cv_historipeserta_id" class="form-group cv_historipeserta_id">
<?php
$onchange = $cv_historipeserta_grid->id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_historipeserta_grid->id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $cv_historipeserta_grid->RowIndex ?>_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $cv_historipeserta_grid->RowIndex ?>_id" id="sv_x<?php echo $cv_historipeserta_grid->RowIndex ?>_id" value="<?php echo RemoveHtml($cv_historipeserta_grid->id->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($cv_historipeserta_grid->id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_historipeserta_grid->id->getPlaceHolder()) ?>"<?php echo $cv_historipeserta_grid->id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($cv_historipeserta_grid->id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $cv_historipeserta_grid->RowIndex ?>_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($cv_historipeserta_grid->id->ReadOnly || $cv_historipeserta_grid->id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $cv_historipeserta_grid->id->displayValueSeparatorAttribute() ?>" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_id" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipeserta_grid->id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_historipesertagrid"], function() {
	fcv_historipesertagrid.createAutoSuggest({"id":"x<?php echo $cv_historipeserta_grid->RowIndex ?>_id","forceSelect":false,"minWidth":"100px","maxHeight":"100px"});
});
</script>
<?php echo $cv_historipeserta_grid->id->Lookup->getParamTag($cv_historipeserta_grid, "p_x" . $cv_historipeserta_grid->RowIndex . "_id") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_cv_historipeserta_id" class="form-group cv_historipeserta_id">
<span<?php echo $cv_historipeserta_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipeserta_grid->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_id" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_id" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipeserta_grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_id" name="o<?php echo $cv_historipeserta_grid->RowIndex ?>_id" id="o<?php echo $cv_historipeserta_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($cv_historipeserta_grid->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_grid->tahun->Visible) { // tahun ?>
		<td data-name="tahun">
<?php if (!$cv_historipeserta->isConfirm()) { ?>
<span id="el$rowindex$_cv_historipeserta_tahun" class="form-group cv_historipeserta_tahun">
<input type="text" data-table="cv_historipeserta" data-field="x_tahun" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_tahun" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($cv_historipeserta_grid->tahun->getPlaceHolder()) ?>" value="<?php echo $cv_historipeserta_grid->tahun->EditValue ?>"<?php echo $cv_historipeserta_grid->tahun->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cv_historipeserta_tahun" class="form-group cv_historipeserta_tahun">
<span<?php echo $cv_historipeserta_grid->tahun->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipeserta_grid->tahun->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_tahun" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_tahun" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($cv_historipeserta_grid->tahun->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_tahun" name="o<?php echo $cv_historipeserta_grid->RowIndex ?>_tahun" id="o<?php echo $cv_historipeserta_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($cv_historipeserta_grid->tahun->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_grid->kdinformasi->Visible) { // kdinformasi ?>
		<td data-name="kdinformasi">
<?php if (!$cv_historipeserta->isConfirm()) { ?>
<span id="el$rowindex$_cv_historipeserta_kdinformasi" class="form-group cv_historipeserta_kdinformasi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cv_historipeserta" data-field="x_kdinformasi" data-value-separator="<?php echo $cv_historipeserta_grid->kdinformasi->displayValueSeparatorAttribute() ?>" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdinformasi" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdinformasi"<?php echo $cv_historipeserta_grid->kdinformasi->editAttributes() ?>>
			<?php echo $cv_historipeserta_grid->kdinformasi->selectOptionListHtml("x{$cv_historipeserta_grid->RowIndex}_kdinformasi") ?>
		</select>
</div>
<?php echo $cv_historipeserta_grid->kdinformasi->Lookup->getParamTag($cv_historipeserta_grid, "p_x" . $cv_historipeserta_grid->RowIndex . "_kdinformasi") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_cv_historipeserta_kdinformasi" class="form-group cv_historipeserta_kdinformasi">
<span<?php echo $cv_historipeserta_grid->kdinformasi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipeserta_grid->kdinformasi->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdinformasi" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdinformasi" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdinformasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_kdinformasi" name="o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdinformasi" id="o<?php echo $cv_historipeserta_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($cv_historipeserta_grid->kdinformasi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_grid->harapan->Visible) { // harapan ?>
		<td data-name="harapan">
<?php if (!$cv_historipeserta->isConfirm()) { ?>
<span id="el$rowindex$_cv_historipeserta_harapan" class="form-group cv_historipeserta_harapan">
<textarea data-table="cv_historipeserta" data-field="x_harapan" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_harapan" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_harapan" cols="50" rows="4" placeholder="<?php echo HtmlEncode($cv_historipeserta_grid->harapan->getPlaceHolder()) ?>"<?php echo $cv_historipeserta_grid->harapan->editAttributes() ?>><?php echo $cv_historipeserta_grid->harapan->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_cv_historipeserta_harapan" class="form-group cv_historipeserta_harapan">
<span<?php echo $cv_historipeserta_grid->harapan->viewAttributes() ?>><?php echo $cv_historipeserta_grid->harapan->ViewValue ?></span>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_harapan" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_harapan" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_harapan" value="<?php echo HtmlEncode($cv_historipeserta_grid->harapan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_harapan" name="o<?php echo $cv_historipeserta_grid->RowIndex ?>_harapan" id="o<?php echo $cv_historipeserta_grid->RowIndex ?>_harapan" value="<?php echo HtmlEncode($cv_historipeserta_grid->harapan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_historipeserta_grid->sertifikat->Visible) { // sertifikat ?>
		<td data-name="sertifikat">
<?php if (!$cv_historipeserta->isConfirm()) { ?>
<span id="el$rowindex$_cv_historipeserta_sertifikat" class="form-group cv_historipeserta_sertifikat">
<input type="text" data-table="cv_historipeserta" data-field="x_sertifikat" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_sertifikat" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_sertifikat" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($cv_historipeserta_grid->sertifikat->getPlaceHolder()) ?>" value="<?php echo $cv_historipeserta_grid->sertifikat->EditValue ?>"<?php echo $cv_historipeserta_grid->sertifikat->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cv_historipeserta_sertifikat" class="form-group cv_historipeserta_sertifikat">
<span<?php echo $cv_historipeserta_grid->sertifikat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historipeserta_grid->sertifikat->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_historipeserta" data-field="x_sertifikat" name="x<?php echo $cv_historipeserta_grid->RowIndex ?>_sertifikat" id="x<?php echo $cv_historipeserta_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($cv_historipeserta_grid->sertifikat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cv_historipeserta" data-field="x_sertifikat" name="o<?php echo $cv_historipeserta_grid->RowIndex ?>_sertifikat" id="o<?php echo $cv_historipeserta_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($cv_historipeserta_grid->sertifikat->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cv_historipeserta_grid->ListOptions->render("body", "right", $cv_historipeserta_grid->RowIndex);
?>
<script>
loadjs.ready(["fcv_historipesertagrid", "load"], function() {
	fcv_historipesertagrid.updateLists(<?php echo $cv_historipeserta_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($cv_historipeserta->CurrentMode == "add" || $cv_historipeserta->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $cv_historipeserta_grid->FormKeyCountName ?>" id="<?php echo $cv_historipeserta_grid->FormKeyCountName ?>" value="<?php echo $cv_historipeserta_grid->KeyCount ?>">
<?php echo $cv_historipeserta_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cv_historipeserta->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $cv_historipeserta_grid->FormKeyCountName ?>" id="<?php echo $cv_historipeserta_grid->FormKeyCountName ?>" value="<?php echo $cv_historipeserta_grid->KeyCount ?>">
<?php echo $cv_historipeserta_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cv_historipeserta->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcv_historipesertagrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cv_historipeserta_grid->Recordset)
	$cv_historipeserta_grid->Recordset->Close();
?>
<?php if ($cv_historipeserta_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $cv_historipeserta_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cv_historipeserta_grid->TotalRecords == 0 && !$cv_historipeserta->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cv_historipeserta_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$cv_historipeserta_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$cv_historipeserta_grid->terminate();
?>