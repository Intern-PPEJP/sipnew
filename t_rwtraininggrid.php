<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($t_rwtraining_grid))
	$t_rwtraining_grid = new t_rwtraining_grid();

// Run the page
$t_rwtraining_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rwtraining_grid->Page_Render();
?>
<?php if (!$t_rwtraining_grid->isExport()) { ?>
<script>
var ft_rwtraininggrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	ft_rwtraininggrid = new ew.Form("ft_rwtraininggrid", "grid");
	ft_rwtraininggrid.formKeyCountName = '<?php echo $t_rwtraining_grid->FormKeyCountName ?>';

	// Validate form
	ft_rwtraininggrid.validate = function() {
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
			<?php if ($t_rwtraining_grid->rwtrainingid->Required) { ?>
				elm = this.getElements("x" + infix + "_rwtrainingid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwtraining_grid->rwtrainingid->caption(), $t_rwtraining_grid->rwtrainingid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rwtraining_grid->bioid->Required) { ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwtraining_grid->bioid->caption(), $t_rwtraining_grid->bioid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rwtraining_grid->bioid->errorMessage()) ?>");
			<?php if ($t_rwtraining_grid->training->Required) { ?>
				elm = this.getElements("x" + infix + "_training");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwtraining_grid->training->caption(), $t_rwtraining_grid->training->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rwtraining_grid->tempat->Required) { ?>
				elm = this.getElements("x" + infix + "_tempat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwtraining_grid->tempat->caption(), $t_rwtraining_grid->tempat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rwtraining_grid->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwtraining_grid->tahun->caption(), $t_rwtraining_grid->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rwtraining_grid->tahun->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	ft_rwtraininggrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "bioid", false)) return false;
		if (ew.valueChanged(fobj, infix, "training", false)) return false;
		if (ew.valueChanged(fobj, infix, "tempat", false)) return false;
		if (ew.valueChanged(fobj, infix, "tahun", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_rwtraininggrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_rwtraininggrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_rwtraininggrid");
});
</script>
<?php } ?>
<?php
$t_rwtraining_grid->renderOtherOptions();
?>
<?php if ($t_rwtraining_grid->TotalRecords > 0 || $t_rwtraining->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_rwtraining_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_rwtraining">
<?php if ($t_rwtraining_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $t_rwtraining_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ft_rwtraininggrid" class="ew-form ew-list-form form-inline">
<div id="gmp_t_rwtraining" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_t_rwtraininggrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_rwtraining->RowType = ROWTYPE_HEADER;

// Render list options
$t_rwtraining_grid->renderListOptions();

// Render list options (header, left)
$t_rwtraining_grid->ListOptions->render("header", "left");
?>
<?php if ($t_rwtraining_grid->rwtrainingid->Visible) { // rwtrainingid ?>
	<?php if ($t_rwtraining_grid->SortUrl($t_rwtraining_grid->rwtrainingid) == "") { ?>
		<th data-name="rwtrainingid" class="<?php echo $t_rwtraining_grid->rwtrainingid->headerCellClass() ?>"><div id="elh_t_rwtraining_rwtrainingid" class="t_rwtraining_rwtrainingid"><div class="ew-table-header-caption"><?php echo $t_rwtraining_grid->rwtrainingid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rwtrainingid" class="<?php echo $t_rwtraining_grid->rwtrainingid->headerCellClass() ?>"><div><div id="elh_t_rwtraining_rwtrainingid" class="t_rwtraining_rwtrainingid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwtraining_grid->rwtrainingid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwtraining_grid->rwtrainingid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwtraining_grid->rwtrainingid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwtraining_grid->bioid->Visible) { // bioid ?>
	<?php if ($t_rwtraining_grid->SortUrl($t_rwtraining_grid->bioid) == "") { ?>
		<th data-name="bioid" class="<?php echo $t_rwtraining_grid->bioid->headerCellClass() ?>"><div id="elh_t_rwtraining_bioid" class="t_rwtraining_bioid"><div class="ew-table-header-caption"><?php echo $t_rwtraining_grid->bioid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bioid" class="<?php echo $t_rwtraining_grid->bioid->headerCellClass() ?>"><div><div id="elh_t_rwtraining_bioid" class="t_rwtraining_bioid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwtraining_grid->bioid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwtraining_grid->bioid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwtraining_grid->bioid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwtraining_grid->training->Visible) { // training ?>
	<?php if ($t_rwtraining_grid->SortUrl($t_rwtraining_grid->training) == "") { ?>
		<th data-name="training" class="<?php echo $t_rwtraining_grid->training->headerCellClass() ?>"><div id="elh_t_rwtraining_training" class="t_rwtraining_training"><div class="ew-table-header-caption"><?php echo $t_rwtraining_grid->training->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="training" class="<?php echo $t_rwtraining_grid->training->headerCellClass() ?>"><div><div id="elh_t_rwtraining_training" class="t_rwtraining_training">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwtraining_grid->training->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwtraining_grid->training->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwtraining_grid->training->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwtraining_grid->tempat->Visible) { // tempat ?>
	<?php if ($t_rwtraining_grid->SortUrl($t_rwtraining_grid->tempat) == "") { ?>
		<th data-name="tempat" class="<?php echo $t_rwtraining_grid->tempat->headerCellClass() ?>"><div id="elh_t_rwtraining_tempat" class="t_rwtraining_tempat"><div class="ew-table-header-caption"><?php echo $t_rwtraining_grid->tempat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tempat" class="<?php echo $t_rwtraining_grid->tempat->headerCellClass() ?>"><div><div id="elh_t_rwtraining_tempat" class="t_rwtraining_tempat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwtraining_grid->tempat->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwtraining_grid->tempat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwtraining_grid->tempat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwtraining_grid->tahun->Visible) { // tahun ?>
	<?php if ($t_rwtraining_grid->SortUrl($t_rwtraining_grid->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $t_rwtraining_grid->tahun->headerCellClass() ?>"><div id="elh_t_rwtraining_tahun" class="t_rwtraining_tahun"><div class="ew-table-header-caption"><?php echo $t_rwtraining_grid->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $t_rwtraining_grid->tahun->headerCellClass() ?>"><div><div id="elh_t_rwtraining_tahun" class="t_rwtraining_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwtraining_grid->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwtraining_grid->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwtraining_grid->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_rwtraining_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_rwtraining_grid->StartRecord = 1;
$t_rwtraining_grid->StopRecord = $t_rwtraining_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($t_rwtraining->isConfirm() || $t_rwtraining_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_rwtraining_grid->FormKeyCountName) && ($t_rwtraining_grid->isGridAdd() || $t_rwtraining_grid->isGridEdit() || $t_rwtraining->isConfirm())) {
		$t_rwtraining_grid->KeyCount = $CurrentForm->getValue($t_rwtraining_grid->FormKeyCountName);
		$t_rwtraining_grid->StopRecord = $t_rwtraining_grid->StartRecord + $t_rwtraining_grid->KeyCount - 1;
	}
}
$t_rwtraining_grid->RecordCount = $t_rwtraining_grid->StartRecord - 1;
if ($t_rwtraining_grid->Recordset && !$t_rwtraining_grid->Recordset->EOF) {
	$t_rwtraining_grid->Recordset->moveFirst();
	$selectLimit = $t_rwtraining_grid->UseSelectLimit;
	if (!$selectLimit && $t_rwtraining_grid->StartRecord > 1)
		$t_rwtraining_grid->Recordset->move($t_rwtraining_grid->StartRecord - 1);
} elseif (!$t_rwtraining->AllowAddDeleteRow && $t_rwtraining_grid->StopRecord == 0) {
	$t_rwtraining_grid->StopRecord = $t_rwtraining->GridAddRowCount;
}

// Initialize aggregate
$t_rwtraining->RowType = ROWTYPE_AGGREGATEINIT;
$t_rwtraining->resetAttributes();
$t_rwtraining_grid->renderRow();
if ($t_rwtraining_grid->isGridAdd())
	$t_rwtraining_grid->RowIndex = 0;
if ($t_rwtraining_grid->isGridEdit())
	$t_rwtraining_grid->RowIndex = 0;
while ($t_rwtraining_grid->RecordCount < $t_rwtraining_grid->StopRecord) {
	$t_rwtraining_grid->RecordCount++;
	if ($t_rwtraining_grid->RecordCount >= $t_rwtraining_grid->StartRecord) {
		$t_rwtraining_grid->RowCount++;
		if ($t_rwtraining_grid->isGridAdd() || $t_rwtraining_grid->isGridEdit() || $t_rwtraining->isConfirm()) {
			$t_rwtraining_grid->RowIndex++;
			$CurrentForm->Index = $t_rwtraining_grid->RowIndex;
			if ($CurrentForm->hasValue($t_rwtraining_grid->FormActionName) && ($t_rwtraining->isConfirm() || $t_rwtraining_grid->EventCancelled))
				$t_rwtraining_grid->RowAction = strval($CurrentForm->getValue($t_rwtraining_grid->FormActionName));
			elseif ($t_rwtraining_grid->isGridAdd())
				$t_rwtraining_grid->RowAction = "insert";
			else
				$t_rwtraining_grid->RowAction = "";
		}

		// Set up key count
		$t_rwtraining_grid->KeyCount = $t_rwtraining_grid->RowIndex;

		// Init row class and style
		$t_rwtraining->resetAttributes();
		$t_rwtraining->CssClass = "";
		if ($t_rwtraining_grid->isGridAdd()) {
			if ($t_rwtraining->CurrentMode == "copy") {
				$t_rwtraining_grid->loadRowValues($t_rwtraining_grid->Recordset); // Load row values
				$t_rwtraining_grid->setRecordKey($t_rwtraining_grid->RowOldKey, $t_rwtraining_grid->Recordset); // Set old record key
			} else {
				$t_rwtraining_grid->loadRowValues(); // Load default values
				$t_rwtraining_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_rwtraining_grid->loadRowValues($t_rwtraining_grid->Recordset); // Load row values
		}
		$t_rwtraining->RowType = ROWTYPE_VIEW; // Render view
		if ($t_rwtraining_grid->isGridAdd()) // Grid add
			$t_rwtraining->RowType = ROWTYPE_ADD; // Render add
		if ($t_rwtraining_grid->isGridAdd() && $t_rwtraining->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_rwtraining_grid->restoreCurrentRowFormValues($t_rwtraining_grid->RowIndex); // Restore form values
		if ($t_rwtraining_grid->isGridEdit()) { // Grid edit
			if ($t_rwtraining->EventCancelled)
				$t_rwtraining_grid->restoreCurrentRowFormValues($t_rwtraining_grid->RowIndex); // Restore form values
			if ($t_rwtraining_grid->RowAction == "insert")
				$t_rwtraining->RowType = ROWTYPE_ADD; // Render add
			else
				$t_rwtraining->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_rwtraining_grid->isGridEdit() && ($t_rwtraining->RowType == ROWTYPE_EDIT || $t_rwtraining->RowType == ROWTYPE_ADD) && $t_rwtraining->EventCancelled) // Update failed
			$t_rwtraining_grid->restoreCurrentRowFormValues($t_rwtraining_grid->RowIndex); // Restore form values
		if ($t_rwtraining->RowType == ROWTYPE_EDIT) // Edit row
			$t_rwtraining_grid->EditRowCount++;
		if ($t_rwtraining->isConfirm()) // Confirm row
			$t_rwtraining_grid->restoreCurrentRowFormValues($t_rwtraining_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_rwtraining->RowAttrs->merge(["data-rowindex" => $t_rwtraining_grid->RowCount, "id" => "r" . $t_rwtraining_grid->RowCount . "_t_rwtraining", "data-rowtype" => $t_rwtraining->RowType]);

		// Render row
		$t_rwtraining_grid->renderRow();

		// Render list options
		$t_rwtraining_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_rwtraining_grid->RowAction != "delete" && $t_rwtraining_grid->RowAction != "insertdelete" && !($t_rwtraining_grid->RowAction == "insert" && $t_rwtraining->isConfirm() && $t_rwtraining_grid->emptyRow())) {
?>
	<tr <?php echo $t_rwtraining->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_rwtraining_grid->ListOptions->render("body", "left", $t_rwtraining_grid->RowCount);
?>
	<?php if ($t_rwtraining_grid->rwtrainingid->Visible) { // rwtrainingid ?>
		<td data-name="rwtrainingid" <?php echo $t_rwtraining_grid->rwtrainingid->cellAttributes() ?>>
<?php if ($t_rwtraining->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_rwtraining_grid->RowCount ?>_t_rwtraining_rwtrainingid" class="form-group"></span>
<input type="hidden" data-table="t_rwtraining" data-field="x_rwtrainingid" name="o<?php echo $t_rwtraining_grid->RowIndex ?>_rwtrainingid" id="o<?php echo $t_rwtraining_grid->RowIndex ?>_rwtrainingid" value="<?php echo HtmlEncode($t_rwtraining_grid->rwtrainingid->OldValue) ?>">
<?php } ?>
<?php if ($t_rwtraining->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_rwtraining_grid->RowCount ?>_t_rwtraining_rwtrainingid" class="form-group">
<span<?php echo $t_rwtraining_grid->rwtrainingid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwtraining_grid->rwtrainingid->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_rwtraining" data-field="x_rwtrainingid" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_rwtrainingid" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_rwtrainingid" value="<?php echo HtmlEncode($t_rwtraining_grid->rwtrainingid->CurrentValue) ?>">
<?php } ?>
<?php if ($t_rwtraining->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_rwtraining_grid->RowCount ?>_t_rwtraining_rwtrainingid">
<span<?php echo $t_rwtraining_grid->rwtrainingid->viewAttributes() ?>><?php echo $t_rwtraining_grid->rwtrainingid->getViewValue() ?></span>
</span>
<?php if (!$t_rwtraining->isConfirm()) { ?>
<input type="hidden" data-table="t_rwtraining" data-field="x_rwtrainingid" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_rwtrainingid" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_rwtrainingid" value="<?php echo HtmlEncode($t_rwtraining_grid->rwtrainingid->FormValue) ?>">
<input type="hidden" data-table="t_rwtraining" data-field="x_rwtrainingid" name="o<?php echo $t_rwtraining_grid->RowIndex ?>_rwtrainingid" id="o<?php echo $t_rwtraining_grid->RowIndex ?>_rwtrainingid" value="<?php echo HtmlEncode($t_rwtraining_grid->rwtrainingid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_rwtraining" data-field="x_rwtrainingid" name="ft_rwtraininggrid$x<?php echo $t_rwtraining_grid->RowIndex ?>_rwtrainingid" id="ft_rwtraininggrid$x<?php echo $t_rwtraining_grid->RowIndex ?>_rwtrainingid" value="<?php echo HtmlEncode($t_rwtraining_grid->rwtrainingid->FormValue) ?>">
<input type="hidden" data-table="t_rwtraining" data-field="x_rwtrainingid" name="ft_rwtraininggrid$o<?php echo $t_rwtraining_grid->RowIndex ?>_rwtrainingid" id="ft_rwtraininggrid$o<?php echo $t_rwtraining_grid->RowIndex ?>_rwtrainingid" value="<?php echo HtmlEncode($t_rwtraining_grid->rwtrainingid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_rwtraining_grid->bioid->Visible) { // bioid ?>
		<td data-name="bioid" <?php echo $t_rwtraining_grid->bioid->cellAttributes() ?>>
<?php if ($t_rwtraining->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($t_rwtraining_grid->bioid->getSessionValue() != "") { ?>
<span id="el<?php echo $t_rwtraining_grid->RowCount ?>_t_rwtraining_bioid" class="form-group">
<span<?php echo $t_rwtraining_grid->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwtraining_grid->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwtraining_grid->bioid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_rwtraining_grid->RowCount ?>_t_rwtraining_bioid" class="form-group">
<input type="text" data-table="t_rwtraining" data-field="x_bioid" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" size="30" placeholder="<?php echo HtmlEncode($t_rwtraining_grid->bioid->getPlaceHolder()) ?>" value="<?php echo $t_rwtraining_grid->bioid->EditValue ?>"<?php echo $t_rwtraining_grid->bioid->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="t_rwtraining" data-field="x_bioid" name="o<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" id="o<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwtraining_grid->bioid->OldValue) ?>">
<?php } ?>
<?php if ($t_rwtraining->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t_rwtraining_grid->bioid->getSessionValue() != "") { ?>
<span id="el<?php echo $t_rwtraining_grid->RowCount ?>_t_rwtraining_bioid" class="form-group">
<span<?php echo $t_rwtraining_grid->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwtraining_grid->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwtraining_grid->bioid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_rwtraining_grid->RowCount ?>_t_rwtraining_bioid" class="form-group">
<input type="text" data-table="t_rwtraining" data-field="x_bioid" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" size="30" placeholder="<?php echo HtmlEncode($t_rwtraining_grid->bioid->getPlaceHolder()) ?>" value="<?php echo $t_rwtraining_grid->bioid->EditValue ?>"<?php echo $t_rwtraining_grid->bioid->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($t_rwtraining->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_rwtraining_grid->RowCount ?>_t_rwtraining_bioid">
<span<?php echo $t_rwtraining_grid->bioid->viewAttributes() ?>><?php echo $t_rwtraining_grid->bioid->getViewValue() ?></span>
</span>
<?php if (!$t_rwtraining->isConfirm()) { ?>
<input type="hidden" data-table="t_rwtraining" data-field="x_bioid" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwtraining_grid->bioid->FormValue) ?>">
<input type="hidden" data-table="t_rwtraining" data-field="x_bioid" name="o<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" id="o<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwtraining_grid->bioid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_rwtraining" data-field="x_bioid" name="ft_rwtraininggrid$x<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" id="ft_rwtraininggrid$x<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwtraining_grid->bioid->FormValue) ?>">
<input type="hidden" data-table="t_rwtraining" data-field="x_bioid" name="ft_rwtraininggrid$o<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" id="ft_rwtraininggrid$o<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwtraining_grid->bioid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_rwtraining_grid->training->Visible) { // training ?>
		<td data-name="training" <?php echo $t_rwtraining_grid->training->cellAttributes() ?>>
<?php if ($t_rwtraining->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_rwtraining_grid->RowCount ?>_t_rwtraining_training" class="form-group">
<textarea data-table="t_rwtraining" data-field="x_training" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_training" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_training" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_rwtraining_grid->training->getPlaceHolder()) ?>"<?php echo $t_rwtraining_grid->training->editAttributes() ?>><?php echo $t_rwtraining_grid->training->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t_rwtraining" data-field="x_training" name="o<?php echo $t_rwtraining_grid->RowIndex ?>_training" id="o<?php echo $t_rwtraining_grid->RowIndex ?>_training" value="<?php echo HtmlEncode($t_rwtraining_grid->training->OldValue) ?>">
<?php } ?>
<?php if ($t_rwtraining->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_rwtraining_grid->RowCount ?>_t_rwtraining_training" class="form-group">
<textarea data-table="t_rwtraining" data-field="x_training" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_training" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_training" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_rwtraining_grid->training->getPlaceHolder()) ?>"<?php echo $t_rwtraining_grid->training->editAttributes() ?>><?php echo $t_rwtraining_grid->training->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t_rwtraining->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_rwtraining_grid->RowCount ?>_t_rwtraining_training">
<span<?php echo $t_rwtraining_grid->training->viewAttributes() ?>><?php echo $t_rwtraining_grid->training->getViewValue() ?></span>
</span>
<?php if (!$t_rwtraining->isConfirm()) { ?>
<input type="hidden" data-table="t_rwtraining" data-field="x_training" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_training" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_training" value="<?php echo HtmlEncode($t_rwtraining_grid->training->FormValue) ?>">
<input type="hidden" data-table="t_rwtraining" data-field="x_training" name="o<?php echo $t_rwtraining_grid->RowIndex ?>_training" id="o<?php echo $t_rwtraining_grid->RowIndex ?>_training" value="<?php echo HtmlEncode($t_rwtraining_grid->training->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_rwtraining" data-field="x_training" name="ft_rwtraininggrid$x<?php echo $t_rwtraining_grid->RowIndex ?>_training" id="ft_rwtraininggrid$x<?php echo $t_rwtraining_grid->RowIndex ?>_training" value="<?php echo HtmlEncode($t_rwtraining_grid->training->FormValue) ?>">
<input type="hidden" data-table="t_rwtraining" data-field="x_training" name="ft_rwtraininggrid$o<?php echo $t_rwtraining_grid->RowIndex ?>_training" id="ft_rwtraininggrid$o<?php echo $t_rwtraining_grid->RowIndex ?>_training" value="<?php echo HtmlEncode($t_rwtraining_grid->training->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_rwtraining_grid->tempat->Visible) { // tempat ?>
		<td data-name="tempat" <?php echo $t_rwtraining_grid->tempat->cellAttributes() ?>>
<?php if ($t_rwtraining->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_rwtraining_grid->RowCount ?>_t_rwtraining_tempat" class="form-group">
<input type="text" data-table="t_rwtraining" data-field="x_tempat" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_tempat" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_tempat" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_rwtraining_grid->tempat->getPlaceHolder()) ?>" value="<?php echo $t_rwtraining_grid->tempat->EditValue ?>"<?php echo $t_rwtraining_grid->tempat->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_rwtraining" data-field="x_tempat" name="o<?php echo $t_rwtraining_grid->RowIndex ?>_tempat" id="o<?php echo $t_rwtraining_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_rwtraining_grid->tempat->OldValue) ?>">
<?php } ?>
<?php if ($t_rwtraining->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_rwtraining_grid->RowCount ?>_t_rwtraining_tempat" class="form-group">
<input type="text" data-table="t_rwtraining" data-field="x_tempat" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_tempat" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_tempat" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_rwtraining_grid->tempat->getPlaceHolder()) ?>" value="<?php echo $t_rwtraining_grid->tempat->EditValue ?>"<?php echo $t_rwtraining_grid->tempat->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_rwtraining->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_rwtraining_grid->RowCount ?>_t_rwtraining_tempat">
<span<?php echo $t_rwtraining_grid->tempat->viewAttributes() ?>><?php echo $t_rwtraining_grid->tempat->getViewValue() ?></span>
</span>
<?php if (!$t_rwtraining->isConfirm()) { ?>
<input type="hidden" data-table="t_rwtraining" data-field="x_tempat" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_tempat" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_rwtraining_grid->tempat->FormValue) ?>">
<input type="hidden" data-table="t_rwtraining" data-field="x_tempat" name="o<?php echo $t_rwtraining_grid->RowIndex ?>_tempat" id="o<?php echo $t_rwtraining_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_rwtraining_grid->tempat->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_rwtraining" data-field="x_tempat" name="ft_rwtraininggrid$x<?php echo $t_rwtraining_grid->RowIndex ?>_tempat" id="ft_rwtraininggrid$x<?php echo $t_rwtraining_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_rwtraining_grid->tempat->FormValue) ?>">
<input type="hidden" data-table="t_rwtraining" data-field="x_tempat" name="ft_rwtraininggrid$o<?php echo $t_rwtraining_grid->RowIndex ?>_tempat" id="ft_rwtraininggrid$o<?php echo $t_rwtraining_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_rwtraining_grid->tempat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_rwtraining_grid->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $t_rwtraining_grid->tahun->cellAttributes() ?>>
<?php if ($t_rwtraining->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_rwtraining_grid->RowCount ?>_t_rwtraining_tahun" class="form-group">
<input type="text" data-table="t_rwtraining" data-field="x_tahun" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_tahun" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_tahun" size="30" placeholder="<?php echo HtmlEncode($t_rwtraining_grid->tahun->getPlaceHolder()) ?>" value="<?php echo $t_rwtraining_grid->tahun->EditValue ?>"<?php echo $t_rwtraining_grid->tahun->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_rwtraining" data-field="x_tahun" name="o<?php echo $t_rwtraining_grid->RowIndex ?>_tahun" id="o<?php echo $t_rwtraining_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_rwtraining_grid->tahun->OldValue) ?>">
<?php } ?>
<?php if ($t_rwtraining->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_rwtraining_grid->RowCount ?>_t_rwtraining_tahun" class="form-group">
<input type="text" data-table="t_rwtraining" data-field="x_tahun" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_tahun" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_tahun" size="30" placeholder="<?php echo HtmlEncode($t_rwtraining_grid->tahun->getPlaceHolder()) ?>" value="<?php echo $t_rwtraining_grid->tahun->EditValue ?>"<?php echo $t_rwtraining_grid->tahun->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_rwtraining->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_rwtraining_grid->RowCount ?>_t_rwtraining_tahun">
<span<?php echo $t_rwtraining_grid->tahun->viewAttributes() ?>><?php echo $t_rwtraining_grid->tahun->getViewValue() ?></span>
</span>
<?php if (!$t_rwtraining->isConfirm()) { ?>
<input type="hidden" data-table="t_rwtraining" data-field="x_tahun" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_tahun" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_rwtraining_grid->tahun->FormValue) ?>">
<input type="hidden" data-table="t_rwtraining" data-field="x_tahun" name="o<?php echo $t_rwtraining_grid->RowIndex ?>_tahun" id="o<?php echo $t_rwtraining_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_rwtraining_grid->tahun->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_rwtraining" data-field="x_tahun" name="ft_rwtraininggrid$x<?php echo $t_rwtraining_grid->RowIndex ?>_tahun" id="ft_rwtraininggrid$x<?php echo $t_rwtraining_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_rwtraining_grid->tahun->FormValue) ?>">
<input type="hidden" data-table="t_rwtraining" data-field="x_tahun" name="ft_rwtraininggrid$o<?php echo $t_rwtraining_grid->RowIndex ?>_tahun" id="ft_rwtraininggrid$o<?php echo $t_rwtraining_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_rwtraining_grid->tahun->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_rwtraining_grid->ListOptions->render("body", "right", $t_rwtraining_grid->RowCount);
?>
	</tr>
<?php if ($t_rwtraining->RowType == ROWTYPE_ADD || $t_rwtraining->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_rwtraininggrid", "load"], function() {
	ft_rwtraininggrid.updateLists(<?php echo $t_rwtraining_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_rwtraining_grid->isGridAdd() || $t_rwtraining->CurrentMode == "copy")
		if (!$t_rwtraining_grid->Recordset->EOF)
			$t_rwtraining_grid->Recordset->moveNext();
}
?>
<?php
	if ($t_rwtraining->CurrentMode == "add" || $t_rwtraining->CurrentMode == "copy" || $t_rwtraining->CurrentMode == "edit") {
		$t_rwtraining_grid->RowIndex = '$rowindex$';
		$t_rwtraining_grid->loadRowValues();

		// Set row properties
		$t_rwtraining->resetAttributes();
		$t_rwtraining->RowAttrs->merge(["data-rowindex" => $t_rwtraining_grid->RowIndex, "id" => "r0_t_rwtraining", "data-rowtype" => ROWTYPE_ADD]);
		$t_rwtraining->RowAttrs->appendClass("ew-template");
		$t_rwtraining->RowType = ROWTYPE_ADD;

		// Render row
		$t_rwtraining_grid->renderRow();

		// Render list options
		$t_rwtraining_grid->renderListOptions();
		$t_rwtraining_grid->StartRowCount = 0;
?>
	<tr <?php echo $t_rwtraining->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_rwtraining_grid->ListOptions->render("body", "left", $t_rwtraining_grid->RowIndex);
?>
	<?php if ($t_rwtraining_grid->rwtrainingid->Visible) { // rwtrainingid ?>
		<td data-name="rwtrainingid">
<?php if (!$t_rwtraining->isConfirm()) { ?>
<span id="el$rowindex$_t_rwtraining_rwtrainingid" class="form-group t_rwtraining_rwtrainingid"></span>
<?php } else { ?>
<span id="el$rowindex$_t_rwtraining_rwtrainingid" class="form-group t_rwtraining_rwtrainingid">
<span<?php echo $t_rwtraining_grid->rwtrainingid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwtraining_grid->rwtrainingid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_rwtraining" data-field="x_rwtrainingid" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_rwtrainingid" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_rwtrainingid" value="<?php echo HtmlEncode($t_rwtraining_grid->rwtrainingid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_rwtraining" data-field="x_rwtrainingid" name="o<?php echo $t_rwtraining_grid->RowIndex ?>_rwtrainingid" id="o<?php echo $t_rwtraining_grid->RowIndex ?>_rwtrainingid" value="<?php echo HtmlEncode($t_rwtraining_grid->rwtrainingid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_rwtraining_grid->bioid->Visible) { // bioid ?>
		<td data-name="bioid">
<?php if (!$t_rwtraining->isConfirm()) { ?>
<?php if ($t_rwtraining_grid->bioid->getSessionValue() != "") { ?>
<span id="el$rowindex$_t_rwtraining_bioid" class="form-group t_rwtraining_bioid">
<span<?php echo $t_rwtraining_grid->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwtraining_grid->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwtraining_grid->bioid->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_rwtraining_bioid" class="form-group t_rwtraining_bioid">
<input type="text" data-table="t_rwtraining" data-field="x_bioid" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" size="30" placeholder="<?php echo HtmlEncode($t_rwtraining_grid->bioid->getPlaceHolder()) ?>" value="<?php echo $t_rwtraining_grid->bioid->EditValue ?>"<?php echo $t_rwtraining_grid->bioid->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t_rwtraining_bioid" class="form-group t_rwtraining_bioid">
<span<?php echo $t_rwtraining_grid->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwtraining_grid->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_rwtraining" data-field="x_bioid" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwtraining_grid->bioid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_rwtraining" data-field="x_bioid" name="o<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" id="o<?php echo $t_rwtraining_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwtraining_grid->bioid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_rwtraining_grid->training->Visible) { // training ?>
		<td data-name="training">
<?php if (!$t_rwtraining->isConfirm()) { ?>
<span id="el$rowindex$_t_rwtraining_training" class="form-group t_rwtraining_training">
<textarea data-table="t_rwtraining" data-field="x_training" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_training" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_training" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_rwtraining_grid->training->getPlaceHolder()) ?>"<?php echo $t_rwtraining_grid->training->editAttributes() ?>><?php echo $t_rwtraining_grid->training->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_rwtraining_training" class="form-group t_rwtraining_training">
<span<?php echo $t_rwtraining_grid->training->viewAttributes() ?>><?php echo $t_rwtraining_grid->training->ViewValue ?></span>
</span>
<input type="hidden" data-table="t_rwtraining" data-field="x_training" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_training" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_training" value="<?php echo HtmlEncode($t_rwtraining_grid->training->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_rwtraining" data-field="x_training" name="o<?php echo $t_rwtraining_grid->RowIndex ?>_training" id="o<?php echo $t_rwtraining_grid->RowIndex ?>_training" value="<?php echo HtmlEncode($t_rwtraining_grid->training->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_rwtraining_grid->tempat->Visible) { // tempat ?>
		<td data-name="tempat">
<?php if (!$t_rwtraining->isConfirm()) { ?>
<span id="el$rowindex$_t_rwtraining_tempat" class="form-group t_rwtraining_tempat">
<input type="text" data-table="t_rwtraining" data-field="x_tempat" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_tempat" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_tempat" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_rwtraining_grid->tempat->getPlaceHolder()) ?>" value="<?php echo $t_rwtraining_grid->tempat->EditValue ?>"<?php echo $t_rwtraining_grid->tempat->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_rwtraining_tempat" class="form-group t_rwtraining_tempat">
<span<?php echo $t_rwtraining_grid->tempat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwtraining_grid->tempat->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_rwtraining" data-field="x_tempat" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_tempat" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_rwtraining_grid->tempat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_rwtraining" data-field="x_tempat" name="o<?php echo $t_rwtraining_grid->RowIndex ?>_tempat" id="o<?php echo $t_rwtraining_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_rwtraining_grid->tempat->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_rwtraining_grid->tahun->Visible) { // tahun ?>
		<td data-name="tahun">
<?php if (!$t_rwtraining->isConfirm()) { ?>
<span id="el$rowindex$_t_rwtraining_tahun" class="form-group t_rwtraining_tahun">
<input type="text" data-table="t_rwtraining" data-field="x_tahun" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_tahun" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_tahun" size="30" placeholder="<?php echo HtmlEncode($t_rwtraining_grid->tahun->getPlaceHolder()) ?>" value="<?php echo $t_rwtraining_grid->tahun->EditValue ?>"<?php echo $t_rwtraining_grid->tahun->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_rwtraining_tahun" class="form-group t_rwtraining_tahun">
<span<?php echo $t_rwtraining_grid->tahun->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwtraining_grid->tahun->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_rwtraining" data-field="x_tahun" name="x<?php echo $t_rwtraining_grid->RowIndex ?>_tahun" id="x<?php echo $t_rwtraining_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_rwtraining_grid->tahun->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_rwtraining" data-field="x_tahun" name="o<?php echo $t_rwtraining_grid->RowIndex ?>_tahun" id="o<?php echo $t_rwtraining_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_rwtraining_grid->tahun->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_rwtraining_grid->ListOptions->render("body", "right", $t_rwtraining_grid->RowIndex);
?>
<script>
loadjs.ready(["ft_rwtraininggrid", "load"], function() {
	ft_rwtraininggrid.updateLists(<?php echo $t_rwtraining_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($t_rwtraining->CurrentMode == "add" || $t_rwtraining->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $t_rwtraining_grid->FormKeyCountName ?>" id="<?php echo $t_rwtraining_grid->FormKeyCountName ?>" value="<?php echo $t_rwtraining_grid->KeyCount ?>">
<?php echo $t_rwtraining_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_rwtraining->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $t_rwtraining_grid->FormKeyCountName ?>" id="<?php echo $t_rwtraining_grid->FormKeyCountName ?>" value="<?php echo $t_rwtraining_grid->KeyCount ?>">
<?php echo $t_rwtraining_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_rwtraining->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_rwtraininggrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_rwtraining_grid->Recordset)
	$t_rwtraining_grid->Recordset->Close();
?>
<?php if ($t_rwtraining_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $t_rwtraining_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_rwtraining_grid->TotalRecords == 0 && !$t_rwtraining->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_rwtraining_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$t_rwtraining_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$t_rwtraining_grid->terminate();
?>