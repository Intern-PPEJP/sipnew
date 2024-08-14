<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($t_rwpendd_grid))
	$t_rwpendd_grid = new t_rwpendd_grid();

// Run the page
$t_rwpendd_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rwpendd_grid->Page_Render();
?>
<?php if (!$t_rwpendd_grid->isExport()) { ?>
<script>
var ft_rwpenddgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	ft_rwpenddgrid = new ew.Form("ft_rwpenddgrid", "grid");
	ft_rwpenddgrid.formKeyCountName = '<?php echo $t_rwpendd_grid->FormKeyCountName ?>';

	// Validate form
	ft_rwpenddgrid.validate = function() {
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
			<?php if ($t_rwpendd_grid->penddid->Required) { ?>
				elm = this.getElements("x" + infix + "_penddid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpendd_grid->penddid->caption(), $t_rwpendd_grid->penddid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rwpendd_grid->bioid->Required) { ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpendd_grid->bioid->caption(), $t_rwpendd_grid->bioid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rwpendd_grid->bioid->errorMessage()) ?>");
			<?php if ($t_rwpendd_grid->sekolah->Required) { ?>
				elm = this.getElements("x" + infix + "_sekolah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpendd_grid->sekolah->caption(), $t_rwpendd_grid->sekolah->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rwpendd_grid->tempat->Required) { ?>
				elm = this.getElements("x" + infix + "_tempat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpendd_grid->tempat->caption(), $t_rwpendd_grid->tempat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rwpendd_grid->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpendd_grid->tahun->caption(), $t_rwpendd_grid->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rwpendd_grid->tahun->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	ft_rwpenddgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "bioid", false)) return false;
		if (ew.valueChanged(fobj, infix, "sekolah", false)) return false;
		if (ew.valueChanged(fobj, infix, "tempat", false)) return false;
		if (ew.valueChanged(fobj, infix, "tahun", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_rwpenddgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_rwpenddgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_rwpenddgrid");
});
</script>
<?php } ?>
<?php
$t_rwpendd_grid->renderOtherOptions();
?>
<?php if ($t_rwpendd_grid->TotalRecords > 0 || $t_rwpendd->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_rwpendd_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_rwpendd">
<?php if ($t_rwpendd_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $t_rwpendd_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ft_rwpenddgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_t_rwpendd" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_t_rwpenddgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_rwpendd->RowType = ROWTYPE_HEADER;

// Render list options
$t_rwpendd_grid->renderListOptions();

// Render list options (header, left)
$t_rwpendd_grid->ListOptions->render("header", "left");
?>
<?php if ($t_rwpendd_grid->penddid->Visible) { // penddid ?>
	<?php if ($t_rwpendd_grid->SortUrl($t_rwpendd_grid->penddid) == "") { ?>
		<th data-name="penddid" class="<?php echo $t_rwpendd_grid->penddid->headerCellClass() ?>"><div id="elh_t_rwpendd_penddid" class="t_rwpendd_penddid"><div class="ew-table-header-caption"><?php echo $t_rwpendd_grid->penddid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="penddid" class="<?php echo $t_rwpendd_grid->penddid->headerCellClass() ?>"><div><div id="elh_t_rwpendd_penddid" class="t_rwpendd_penddid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwpendd_grid->penddid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwpendd_grid->penddid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwpendd_grid->penddid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwpendd_grid->bioid->Visible) { // bioid ?>
	<?php if ($t_rwpendd_grid->SortUrl($t_rwpendd_grid->bioid) == "") { ?>
		<th data-name="bioid" class="<?php echo $t_rwpendd_grid->bioid->headerCellClass() ?>"><div id="elh_t_rwpendd_bioid" class="t_rwpendd_bioid"><div class="ew-table-header-caption"><?php echo $t_rwpendd_grid->bioid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bioid" class="<?php echo $t_rwpendd_grid->bioid->headerCellClass() ?>"><div><div id="elh_t_rwpendd_bioid" class="t_rwpendd_bioid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwpendd_grid->bioid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwpendd_grid->bioid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwpendd_grid->bioid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwpendd_grid->sekolah->Visible) { // sekolah ?>
	<?php if ($t_rwpendd_grid->SortUrl($t_rwpendd_grid->sekolah) == "") { ?>
		<th data-name="sekolah" class="<?php echo $t_rwpendd_grid->sekolah->headerCellClass() ?>"><div id="elh_t_rwpendd_sekolah" class="t_rwpendd_sekolah"><div class="ew-table-header-caption"><?php echo $t_rwpendd_grid->sekolah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sekolah" class="<?php echo $t_rwpendd_grid->sekolah->headerCellClass() ?>"><div><div id="elh_t_rwpendd_sekolah" class="t_rwpendd_sekolah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwpendd_grid->sekolah->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwpendd_grid->sekolah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwpendd_grid->sekolah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwpendd_grid->tempat->Visible) { // tempat ?>
	<?php if ($t_rwpendd_grid->SortUrl($t_rwpendd_grid->tempat) == "") { ?>
		<th data-name="tempat" class="<?php echo $t_rwpendd_grid->tempat->headerCellClass() ?>"><div id="elh_t_rwpendd_tempat" class="t_rwpendd_tempat"><div class="ew-table-header-caption"><?php echo $t_rwpendd_grid->tempat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tempat" class="<?php echo $t_rwpendd_grid->tempat->headerCellClass() ?>"><div><div id="elh_t_rwpendd_tempat" class="t_rwpendd_tempat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwpendd_grid->tempat->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwpendd_grid->tempat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwpendd_grid->tempat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwpendd_grid->tahun->Visible) { // tahun ?>
	<?php if ($t_rwpendd_grid->SortUrl($t_rwpendd_grid->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $t_rwpendd_grid->tahun->headerCellClass() ?>"><div id="elh_t_rwpendd_tahun" class="t_rwpendd_tahun"><div class="ew-table-header-caption"><?php echo $t_rwpendd_grid->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $t_rwpendd_grid->tahun->headerCellClass() ?>"><div><div id="elh_t_rwpendd_tahun" class="t_rwpendd_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwpendd_grid->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwpendd_grid->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwpendd_grid->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_rwpendd_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_rwpendd_grid->StartRecord = 1;
$t_rwpendd_grid->StopRecord = $t_rwpendd_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($t_rwpendd->isConfirm() || $t_rwpendd_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_rwpendd_grid->FormKeyCountName) && ($t_rwpendd_grid->isGridAdd() || $t_rwpendd_grid->isGridEdit() || $t_rwpendd->isConfirm())) {
		$t_rwpendd_grid->KeyCount = $CurrentForm->getValue($t_rwpendd_grid->FormKeyCountName);
		$t_rwpendd_grid->StopRecord = $t_rwpendd_grid->StartRecord + $t_rwpendd_grid->KeyCount - 1;
	}
}
$t_rwpendd_grid->RecordCount = $t_rwpendd_grid->StartRecord - 1;
if ($t_rwpendd_grid->Recordset && !$t_rwpendd_grid->Recordset->EOF) {
	$t_rwpendd_grid->Recordset->moveFirst();
	$selectLimit = $t_rwpendd_grid->UseSelectLimit;
	if (!$selectLimit && $t_rwpendd_grid->StartRecord > 1)
		$t_rwpendd_grid->Recordset->move($t_rwpendd_grid->StartRecord - 1);
} elseif (!$t_rwpendd->AllowAddDeleteRow && $t_rwpendd_grid->StopRecord == 0) {
	$t_rwpendd_grid->StopRecord = $t_rwpendd->GridAddRowCount;
}

// Initialize aggregate
$t_rwpendd->RowType = ROWTYPE_AGGREGATEINIT;
$t_rwpendd->resetAttributes();
$t_rwpendd_grid->renderRow();
if ($t_rwpendd_grid->isGridAdd())
	$t_rwpendd_grid->RowIndex = 0;
if ($t_rwpendd_grid->isGridEdit())
	$t_rwpendd_grid->RowIndex = 0;
while ($t_rwpendd_grid->RecordCount < $t_rwpendd_grid->StopRecord) {
	$t_rwpendd_grid->RecordCount++;
	if ($t_rwpendd_grid->RecordCount >= $t_rwpendd_grid->StartRecord) {
		$t_rwpendd_grid->RowCount++;
		if ($t_rwpendd_grid->isGridAdd() || $t_rwpendd_grid->isGridEdit() || $t_rwpendd->isConfirm()) {
			$t_rwpendd_grid->RowIndex++;
			$CurrentForm->Index = $t_rwpendd_grid->RowIndex;
			if ($CurrentForm->hasValue($t_rwpendd_grid->FormActionName) && ($t_rwpendd->isConfirm() || $t_rwpendd_grid->EventCancelled))
				$t_rwpendd_grid->RowAction = strval($CurrentForm->getValue($t_rwpendd_grid->FormActionName));
			elseif ($t_rwpendd_grid->isGridAdd())
				$t_rwpendd_grid->RowAction = "insert";
			else
				$t_rwpendd_grid->RowAction = "";
		}

		// Set up key count
		$t_rwpendd_grid->KeyCount = $t_rwpendd_grid->RowIndex;

		// Init row class and style
		$t_rwpendd->resetAttributes();
		$t_rwpendd->CssClass = "";
		if ($t_rwpendd_grid->isGridAdd()) {
			if ($t_rwpendd->CurrentMode == "copy") {
				$t_rwpendd_grid->loadRowValues($t_rwpendd_grid->Recordset); // Load row values
				$t_rwpendd_grid->setRecordKey($t_rwpendd_grid->RowOldKey, $t_rwpendd_grid->Recordset); // Set old record key
			} else {
				$t_rwpendd_grid->loadRowValues(); // Load default values
				$t_rwpendd_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_rwpendd_grid->loadRowValues($t_rwpendd_grid->Recordset); // Load row values
		}
		$t_rwpendd->RowType = ROWTYPE_VIEW; // Render view
		if ($t_rwpendd_grid->isGridAdd()) // Grid add
			$t_rwpendd->RowType = ROWTYPE_ADD; // Render add
		if ($t_rwpendd_grid->isGridAdd() && $t_rwpendd->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_rwpendd_grid->restoreCurrentRowFormValues($t_rwpendd_grid->RowIndex); // Restore form values
		if ($t_rwpendd_grid->isGridEdit()) { // Grid edit
			if ($t_rwpendd->EventCancelled)
				$t_rwpendd_grid->restoreCurrentRowFormValues($t_rwpendd_grid->RowIndex); // Restore form values
			if ($t_rwpendd_grid->RowAction == "insert")
				$t_rwpendd->RowType = ROWTYPE_ADD; // Render add
			else
				$t_rwpendd->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_rwpendd_grid->isGridEdit() && ($t_rwpendd->RowType == ROWTYPE_EDIT || $t_rwpendd->RowType == ROWTYPE_ADD) && $t_rwpendd->EventCancelled) // Update failed
			$t_rwpendd_grid->restoreCurrentRowFormValues($t_rwpendd_grid->RowIndex); // Restore form values
		if ($t_rwpendd->RowType == ROWTYPE_EDIT) // Edit row
			$t_rwpendd_grid->EditRowCount++;
		if ($t_rwpendd->isConfirm()) // Confirm row
			$t_rwpendd_grid->restoreCurrentRowFormValues($t_rwpendd_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_rwpendd->RowAttrs->merge(["data-rowindex" => $t_rwpendd_grid->RowCount, "id" => "r" . $t_rwpendd_grid->RowCount . "_t_rwpendd", "data-rowtype" => $t_rwpendd->RowType]);

		// Render row
		$t_rwpendd_grid->renderRow();

		// Render list options
		$t_rwpendd_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_rwpendd_grid->RowAction != "delete" && $t_rwpendd_grid->RowAction != "insertdelete" && !($t_rwpendd_grid->RowAction == "insert" && $t_rwpendd->isConfirm() && $t_rwpendd_grid->emptyRow())) {
?>
	<tr <?php echo $t_rwpendd->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_rwpendd_grid->ListOptions->render("body", "left", $t_rwpendd_grid->RowCount);
?>
	<?php if ($t_rwpendd_grid->penddid->Visible) { // penddid ?>
		<td data-name="penddid" <?php echo $t_rwpendd_grid->penddid->cellAttributes() ?>>
<?php if ($t_rwpendd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_rwpendd_grid->RowCount ?>_t_rwpendd_penddid" class="form-group"></span>
<input type="hidden" data-table="t_rwpendd" data-field="x_penddid" name="o<?php echo $t_rwpendd_grid->RowIndex ?>_penddid" id="o<?php echo $t_rwpendd_grid->RowIndex ?>_penddid" value="<?php echo HtmlEncode($t_rwpendd_grid->penddid->OldValue) ?>">
<?php } ?>
<?php if ($t_rwpendd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_rwpendd_grid->RowCount ?>_t_rwpendd_penddid" class="form-group">
<span<?php echo $t_rwpendd_grid->penddid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwpendd_grid->penddid->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_rwpendd" data-field="x_penddid" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_penddid" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_penddid" value="<?php echo HtmlEncode($t_rwpendd_grid->penddid->CurrentValue) ?>">
<?php } ?>
<?php if ($t_rwpendd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_rwpendd_grid->RowCount ?>_t_rwpendd_penddid">
<span<?php echo $t_rwpendd_grid->penddid->viewAttributes() ?>><?php echo $t_rwpendd_grid->penddid->getViewValue() ?></span>
</span>
<?php if (!$t_rwpendd->isConfirm()) { ?>
<input type="hidden" data-table="t_rwpendd" data-field="x_penddid" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_penddid" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_penddid" value="<?php echo HtmlEncode($t_rwpendd_grid->penddid->FormValue) ?>">
<input type="hidden" data-table="t_rwpendd" data-field="x_penddid" name="o<?php echo $t_rwpendd_grid->RowIndex ?>_penddid" id="o<?php echo $t_rwpendd_grid->RowIndex ?>_penddid" value="<?php echo HtmlEncode($t_rwpendd_grid->penddid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_rwpendd" data-field="x_penddid" name="ft_rwpenddgrid$x<?php echo $t_rwpendd_grid->RowIndex ?>_penddid" id="ft_rwpenddgrid$x<?php echo $t_rwpendd_grid->RowIndex ?>_penddid" value="<?php echo HtmlEncode($t_rwpendd_grid->penddid->FormValue) ?>">
<input type="hidden" data-table="t_rwpendd" data-field="x_penddid" name="ft_rwpenddgrid$o<?php echo $t_rwpendd_grid->RowIndex ?>_penddid" id="ft_rwpenddgrid$o<?php echo $t_rwpendd_grid->RowIndex ?>_penddid" value="<?php echo HtmlEncode($t_rwpendd_grid->penddid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_rwpendd_grid->bioid->Visible) { // bioid ?>
		<td data-name="bioid" <?php echo $t_rwpendd_grid->bioid->cellAttributes() ?>>
<?php if ($t_rwpendd->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($t_rwpendd_grid->bioid->getSessionValue() != "") { ?>
<span id="el<?php echo $t_rwpendd_grid->RowCount ?>_t_rwpendd_bioid" class="form-group">
<span<?php echo $t_rwpendd_grid->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwpendd_grid->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwpendd_grid->bioid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_rwpendd_grid->RowCount ?>_t_rwpendd_bioid" class="form-group">
<input type="text" data-table="t_rwpendd" data-field="x_bioid" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" size="30" placeholder="<?php echo HtmlEncode($t_rwpendd_grid->bioid->getPlaceHolder()) ?>" value="<?php echo $t_rwpendd_grid->bioid->EditValue ?>"<?php echo $t_rwpendd_grid->bioid->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="t_rwpendd" data-field="x_bioid" name="o<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" id="o<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwpendd_grid->bioid->OldValue) ?>">
<?php } ?>
<?php if ($t_rwpendd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t_rwpendd_grid->bioid->getSessionValue() != "") { ?>
<span id="el<?php echo $t_rwpendd_grid->RowCount ?>_t_rwpendd_bioid" class="form-group">
<span<?php echo $t_rwpendd_grid->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwpendd_grid->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwpendd_grid->bioid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_rwpendd_grid->RowCount ?>_t_rwpendd_bioid" class="form-group">
<input type="text" data-table="t_rwpendd" data-field="x_bioid" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" size="30" placeholder="<?php echo HtmlEncode($t_rwpendd_grid->bioid->getPlaceHolder()) ?>" value="<?php echo $t_rwpendd_grid->bioid->EditValue ?>"<?php echo $t_rwpendd_grid->bioid->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($t_rwpendd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_rwpendd_grid->RowCount ?>_t_rwpendd_bioid">
<span<?php echo $t_rwpendd_grid->bioid->viewAttributes() ?>><?php echo $t_rwpendd_grid->bioid->getViewValue() ?></span>
</span>
<?php if (!$t_rwpendd->isConfirm()) { ?>
<input type="hidden" data-table="t_rwpendd" data-field="x_bioid" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwpendd_grid->bioid->FormValue) ?>">
<input type="hidden" data-table="t_rwpendd" data-field="x_bioid" name="o<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" id="o<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwpendd_grid->bioid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_rwpendd" data-field="x_bioid" name="ft_rwpenddgrid$x<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" id="ft_rwpenddgrid$x<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwpendd_grid->bioid->FormValue) ?>">
<input type="hidden" data-table="t_rwpendd" data-field="x_bioid" name="ft_rwpenddgrid$o<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" id="ft_rwpenddgrid$o<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwpendd_grid->bioid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_rwpendd_grid->sekolah->Visible) { // sekolah ?>
		<td data-name="sekolah" <?php echo $t_rwpendd_grid->sekolah->cellAttributes() ?>>
<?php if ($t_rwpendd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_rwpendd_grid->RowCount ?>_t_rwpendd_sekolah" class="form-group">
<textarea data-table="t_rwpendd" data-field="x_sekolah" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_sekolah" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_sekolah" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_rwpendd_grid->sekolah->getPlaceHolder()) ?>"<?php echo $t_rwpendd_grid->sekolah->editAttributes() ?>><?php echo $t_rwpendd_grid->sekolah->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t_rwpendd" data-field="x_sekolah" name="o<?php echo $t_rwpendd_grid->RowIndex ?>_sekolah" id="o<?php echo $t_rwpendd_grid->RowIndex ?>_sekolah" value="<?php echo HtmlEncode($t_rwpendd_grid->sekolah->OldValue) ?>">
<?php } ?>
<?php if ($t_rwpendd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_rwpendd_grid->RowCount ?>_t_rwpendd_sekolah" class="form-group">
<textarea data-table="t_rwpendd" data-field="x_sekolah" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_sekolah" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_sekolah" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_rwpendd_grid->sekolah->getPlaceHolder()) ?>"<?php echo $t_rwpendd_grid->sekolah->editAttributes() ?>><?php echo $t_rwpendd_grid->sekolah->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t_rwpendd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_rwpendd_grid->RowCount ?>_t_rwpendd_sekolah">
<span<?php echo $t_rwpendd_grid->sekolah->viewAttributes() ?>><?php echo $t_rwpendd_grid->sekolah->getViewValue() ?></span>
</span>
<?php if (!$t_rwpendd->isConfirm()) { ?>
<input type="hidden" data-table="t_rwpendd" data-field="x_sekolah" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_sekolah" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_sekolah" value="<?php echo HtmlEncode($t_rwpendd_grid->sekolah->FormValue) ?>">
<input type="hidden" data-table="t_rwpendd" data-field="x_sekolah" name="o<?php echo $t_rwpendd_grid->RowIndex ?>_sekolah" id="o<?php echo $t_rwpendd_grid->RowIndex ?>_sekolah" value="<?php echo HtmlEncode($t_rwpendd_grid->sekolah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_rwpendd" data-field="x_sekolah" name="ft_rwpenddgrid$x<?php echo $t_rwpendd_grid->RowIndex ?>_sekolah" id="ft_rwpenddgrid$x<?php echo $t_rwpendd_grid->RowIndex ?>_sekolah" value="<?php echo HtmlEncode($t_rwpendd_grid->sekolah->FormValue) ?>">
<input type="hidden" data-table="t_rwpendd" data-field="x_sekolah" name="ft_rwpenddgrid$o<?php echo $t_rwpendd_grid->RowIndex ?>_sekolah" id="ft_rwpenddgrid$o<?php echo $t_rwpendd_grid->RowIndex ?>_sekolah" value="<?php echo HtmlEncode($t_rwpendd_grid->sekolah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_rwpendd_grid->tempat->Visible) { // tempat ?>
		<td data-name="tempat" <?php echo $t_rwpendd_grid->tempat->cellAttributes() ?>>
<?php if ($t_rwpendd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_rwpendd_grid->RowCount ?>_t_rwpendd_tempat" class="form-group">
<input type="text" data-table="t_rwpendd" data-field="x_tempat" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_tempat" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_tempat" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_rwpendd_grid->tempat->getPlaceHolder()) ?>" value="<?php echo $t_rwpendd_grid->tempat->EditValue ?>"<?php echo $t_rwpendd_grid->tempat->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_rwpendd" data-field="x_tempat" name="o<?php echo $t_rwpendd_grid->RowIndex ?>_tempat" id="o<?php echo $t_rwpendd_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_rwpendd_grid->tempat->OldValue) ?>">
<?php } ?>
<?php if ($t_rwpendd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_rwpendd_grid->RowCount ?>_t_rwpendd_tempat" class="form-group">
<input type="text" data-table="t_rwpendd" data-field="x_tempat" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_tempat" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_tempat" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_rwpendd_grid->tempat->getPlaceHolder()) ?>" value="<?php echo $t_rwpendd_grid->tempat->EditValue ?>"<?php echo $t_rwpendd_grid->tempat->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_rwpendd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_rwpendd_grid->RowCount ?>_t_rwpendd_tempat">
<span<?php echo $t_rwpendd_grid->tempat->viewAttributes() ?>><?php echo $t_rwpendd_grid->tempat->getViewValue() ?></span>
</span>
<?php if (!$t_rwpendd->isConfirm()) { ?>
<input type="hidden" data-table="t_rwpendd" data-field="x_tempat" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_tempat" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_rwpendd_grid->tempat->FormValue) ?>">
<input type="hidden" data-table="t_rwpendd" data-field="x_tempat" name="o<?php echo $t_rwpendd_grid->RowIndex ?>_tempat" id="o<?php echo $t_rwpendd_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_rwpendd_grid->tempat->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_rwpendd" data-field="x_tempat" name="ft_rwpenddgrid$x<?php echo $t_rwpendd_grid->RowIndex ?>_tempat" id="ft_rwpenddgrid$x<?php echo $t_rwpendd_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_rwpendd_grid->tempat->FormValue) ?>">
<input type="hidden" data-table="t_rwpendd" data-field="x_tempat" name="ft_rwpenddgrid$o<?php echo $t_rwpendd_grid->RowIndex ?>_tempat" id="ft_rwpenddgrid$o<?php echo $t_rwpendd_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_rwpendd_grid->tempat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_rwpendd_grid->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $t_rwpendd_grid->tahun->cellAttributes() ?>>
<?php if ($t_rwpendd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_rwpendd_grid->RowCount ?>_t_rwpendd_tahun" class="form-group">
<input type="text" data-table="t_rwpendd" data-field="x_tahun" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_tahun" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_rwpendd_grid->tahun->getPlaceHolder()) ?>" value="<?php echo $t_rwpendd_grid->tahun->EditValue ?>"<?php echo $t_rwpendd_grid->tahun->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_rwpendd" data-field="x_tahun" name="o<?php echo $t_rwpendd_grid->RowIndex ?>_tahun" id="o<?php echo $t_rwpendd_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_rwpendd_grid->tahun->OldValue) ?>">
<?php } ?>
<?php if ($t_rwpendd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_rwpendd_grid->RowCount ?>_t_rwpendd_tahun" class="form-group">
<input type="text" data-table="t_rwpendd" data-field="x_tahun" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_tahun" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_rwpendd_grid->tahun->getPlaceHolder()) ?>" value="<?php echo $t_rwpendd_grid->tahun->EditValue ?>"<?php echo $t_rwpendd_grid->tahun->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_rwpendd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_rwpendd_grid->RowCount ?>_t_rwpendd_tahun">
<span<?php echo $t_rwpendd_grid->tahun->viewAttributes() ?>><?php echo $t_rwpendd_grid->tahun->getViewValue() ?></span>
</span>
<?php if (!$t_rwpendd->isConfirm()) { ?>
<input type="hidden" data-table="t_rwpendd" data-field="x_tahun" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_tahun" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_rwpendd_grid->tahun->FormValue) ?>">
<input type="hidden" data-table="t_rwpendd" data-field="x_tahun" name="o<?php echo $t_rwpendd_grid->RowIndex ?>_tahun" id="o<?php echo $t_rwpendd_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_rwpendd_grid->tahun->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_rwpendd" data-field="x_tahun" name="ft_rwpenddgrid$x<?php echo $t_rwpendd_grid->RowIndex ?>_tahun" id="ft_rwpenddgrid$x<?php echo $t_rwpendd_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_rwpendd_grid->tahun->FormValue) ?>">
<input type="hidden" data-table="t_rwpendd" data-field="x_tahun" name="ft_rwpenddgrid$o<?php echo $t_rwpendd_grid->RowIndex ?>_tahun" id="ft_rwpenddgrid$o<?php echo $t_rwpendd_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_rwpendd_grid->tahun->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_rwpendd_grid->ListOptions->render("body", "right", $t_rwpendd_grid->RowCount);
?>
	</tr>
<?php if ($t_rwpendd->RowType == ROWTYPE_ADD || $t_rwpendd->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_rwpenddgrid", "load"], function() {
	ft_rwpenddgrid.updateLists(<?php echo $t_rwpendd_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_rwpendd_grid->isGridAdd() || $t_rwpendd->CurrentMode == "copy")
		if (!$t_rwpendd_grid->Recordset->EOF)
			$t_rwpendd_grid->Recordset->moveNext();
}
?>
<?php
	if ($t_rwpendd->CurrentMode == "add" || $t_rwpendd->CurrentMode == "copy" || $t_rwpendd->CurrentMode == "edit") {
		$t_rwpendd_grid->RowIndex = '$rowindex$';
		$t_rwpendd_grid->loadRowValues();

		// Set row properties
		$t_rwpendd->resetAttributes();
		$t_rwpendd->RowAttrs->merge(["data-rowindex" => $t_rwpendd_grid->RowIndex, "id" => "r0_t_rwpendd", "data-rowtype" => ROWTYPE_ADD]);
		$t_rwpendd->RowAttrs->appendClass("ew-template");
		$t_rwpendd->RowType = ROWTYPE_ADD;

		// Render row
		$t_rwpendd_grid->renderRow();

		// Render list options
		$t_rwpendd_grid->renderListOptions();
		$t_rwpendd_grid->StartRowCount = 0;
?>
	<tr <?php echo $t_rwpendd->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_rwpendd_grid->ListOptions->render("body", "left", $t_rwpendd_grid->RowIndex);
?>
	<?php if ($t_rwpendd_grid->penddid->Visible) { // penddid ?>
		<td data-name="penddid">
<?php if (!$t_rwpendd->isConfirm()) { ?>
<span id="el$rowindex$_t_rwpendd_penddid" class="form-group t_rwpendd_penddid"></span>
<?php } else { ?>
<span id="el$rowindex$_t_rwpendd_penddid" class="form-group t_rwpendd_penddid">
<span<?php echo $t_rwpendd_grid->penddid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwpendd_grid->penddid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_rwpendd" data-field="x_penddid" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_penddid" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_penddid" value="<?php echo HtmlEncode($t_rwpendd_grid->penddid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_rwpendd" data-field="x_penddid" name="o<?php echo $t_rwpendd_grid->RowIndex ?>_penddid" id="o<?php echo $t_rwpendd_grid->RowIndex ?>_penddid" value="<?php echo HtmlEncode($t_rwpendd_grid->penddid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_rwpendd_grid->bioid->Visible) { // bioid ?>
		<td data-name="bioid">
<?php if (!$t_rwpendd->isConfirm()) { ?>
<?php if ($t_rwpendd_grid->bioid->getSessionValue() != "") { ?>
<span id="el$rowindex$_t_rwpendd_bioid" class="form-group t_rwpendd_bioid">
<span<?php echo $t_rwpendd_grid->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwpendd_grid->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwpendd_grid->bioid->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_rwpendd_bioid" class="form-group t_rwpendd_bioid">
<input type="text" data-table="t_rwpendd" data-field="x_bioid" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" size="30" placeholder="<?php echo HtmlEncode($t_rwpendd_grid->bioid->getPlaceHolder()) ?>" value="<?php echo $t_rwpendd_grid->bioid->EditValue ?>"<?php echo $t_rwpendd_grid->bioid->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t_rwpendd_bioid" class="form-group t_rwpendd_bioid">
<span<?php echo $t_rwpendd_grid->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwpendd_grid->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_rwpendd" data-field="x_bioid" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwpendd_grid->bioid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_rwpendd" data-field="x_bioid" name="o<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" id="o<?php echo $t_rwpendd_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwpendd_grid->bioid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_rwpendd_grid->sekolah->Visible) { // sekolah ?>
		<td data-name="sekolah">
<?php if (!$t_rwpendd->isConfirm()) { ?>
<span id="el$rowindex$_t_rwpendd_sekolah" class="form-group t_rwpendd_sekolah">
<textarea data-table="t_rwpendd" data-field="x_sekolah" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_sekolah" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_sekolah" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_rwpendd_grid->sekolah->getPlaceHolder()) ?>"<?php echo $t_rwpendd_grid->sekolah->editAttributes() ?>><?php echo $t_rwpendd_grid->sekolah->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_rwpendd_sekolah" class="form-group t_rwpendd_sekolah">
<span<?php echo $t_rwpendd_grid->sekolah->viewAttributes() ?>><?php echo $t_rwpendd_grid->sekolah->ViewValue ?></span>
</span>
<input type="hidden" data-table="t_rwpendd" data-field="x_sekolah" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_sekolah" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_sekolah" value="<?php echo HtmlEncode($t_rwpendd_grid->sekolah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_rwpendd" data-field="x_sekolah" name="o<?php echo $t_rwpendd_grid->RowIndex ?>_sekolah" id="o<?php echo $t_rwpendd_grid->RowIndex ?>_sekolah" value="<?php echo HtmlEncode($t_rwpendd_grid->sekolah->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_rwpendd_grid->tempat->Visible) { // tempat ?>
		<td data-name="tempat">
<?php if (!$t_rwpendd->isConfirm()) { ?>
<span id="el$rowindex$_t_rwpendd_tempat" class="form-group t_rwpendd_tempat">
<input type="text" data-table="t_rwpendd" data-field="x_tempat" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_tempat" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_tempat" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_rwpendd_grid->tempat->getPlaceHolder()) ?>" value="<?php echo $t_rwpendd_grid->tempat->EditValue ?>"<?php echo $t_rwpendd_grid->tempat->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_rwpendd_tempat" class="form-group t_rwpendd_tempat">
<span<?php echo $t_rwpendd_grid->tempat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwpendd_grid->tempat->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_rwpendd" data-field="x_tempat" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_tempat" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_rwpendd_grid->tempat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_rwpendd" data-field="x_tempat" name="o<?php echo $t_rwpendd_grid->RowIndex ?>_tempat" id="o<?php echo $t_rwpendd_grid->RowIndex ?>_tempat" value="<?php echo HtmlEncode($t_rwpendd_grid->tempat->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_rwpendd_grid->tahun->Visible) { // tahun ?>
		<td data-name="tahun">
<?php if (!$t_rwpendd->isConfirm()) { ?>
<span id="el$rowindex$_t_rwpendd_tahun" class="form-group t_rwpendd_tahun">
<input type="text" data-table="t_rwpendd" data-field="x_tahun" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_tahun" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_rwpendd_grid->tahun->getPlaceHolder()) ?>" value="<?php echo $t_rwpendd_grid->tahun->EditValue ?>"<?php echo $t_rwpendd_grid->tahun->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_rwpendd_tahun" class="form-group t_rwpendd_tahun">
<span<?php echo $t_rwpendd_grid->tahun->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwpendd_grid->tahun->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_rwpendd" data-field="x_tahun" name="x<?php echo $t_rwpendd_grid->RowIndex ?>_tahun" id="x<?php echo $t_rwpendd_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_rwpendd_grid->tahun->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_rwpendd" data-field="x_tahun" name="o<?php echo $t_rwpendd_grid->RowIndex ?>_tahun" id="o<?php echo $t_rwpendd_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_rwpendd_grid->tahun->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_rwpendd_grid->ListOptions->render("body", "right", $t_rwpendd_grid->RowIndex);
?>
<script>
loadjs.ready(["ft_rwpenddgrid", "load"], function() {
	ft_rwpenddgrid.updateLists(<?php echo $t_rwpendd_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($t_rwpendd->CurrentMode == "add" || $t_rwpendd->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $t_rwpendd_grid->FormKeyCountName ?>" id="<?php echo $t_rwpendd_grid->FormKeyCountName ?>" value="<?php echo $t_rwpendd_grid->KeyCount ?>">
<?php echo $t_rwpendd_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_rwpendd->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $t_rwpendd_grid->FormKeyCountName ?>" id="<?php echo $t_rwpendd_grid->FormKeyCountName ?>" value="<?php echo $t_rwpendd_grid->KeyCount ?>">
<?php echo $t_rwpendd_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_rwpendd->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_rwpenddgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_rwpendd_grid->Recordset)
	$t_rwpendd_grid->Recordset->Close();
?>
<?php if ($t_rwpendd_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $t_rwpendd_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_rwpendd_grid->TotalRecords == 0 && !$t_rwpendd->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_rwpendd_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$t_rwpendd_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$t_rwpendd_grid->terminate();
?>