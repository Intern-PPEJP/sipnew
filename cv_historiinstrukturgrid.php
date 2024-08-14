<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($cv_historiinstruktur_grid))
	$cv_historiinstruktur_grid = new cv_historiinstruktur_grid();

// Run the page
$cv_historiinstruktur_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cv_historiinstruktur_grid->Page_Render();
?>
<?php if (!$cv_historiinstruktur_grid->isExport()) { ?>
<script>
var fcv_historiinstrukturgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fcv_historiinstrukturgrid = new ew.Form("fcv_historiinstrukturgrid", "grid");
	fcv_historiinstrukturgrid.formKeyCountName = '<?php echo $cv_historiinstruktur_grid->FormKeyCountName ?>';

	// Validate form
	fcv_historiinstrukturgrid.validate = function() {
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
			<?php if ($cv_historiinstruktur_grid->bioid->Required) { ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historiinstruktur_grid->bioid->caption(), $cv_historiinstruktur_grid->bioid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cv_historiinstruktur_grid->bioid->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fcv_historiinstrukturgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "bioid", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fcv_historiinstrukturgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcv_historiinstrukturgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcv_historiinstrukturgrid.lists["x_bioid"] = <?php echo $cv_historiinstruktur_grid->bioid->Lookup->toClientList($cv_historiinstruktur_grid) ?>;
	fcv_historiinstrukturgrid.lists["x_bioid"].options = <?php echo JsonEncode($cv_historiinstruktur_grid->bioid->lookupOptions()) ?>;
	fcv_historiinstrukturgrid.autoSuggests["x_bioid"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fcv_historiinstrukturgrid");
});
</script>
<?php } ?>
<?php
$cv_historiinstruktur_grid->renderOtherOptions();
?>
<?php if ($cv_historiinstruktur_grid->TotalRecords > 0 || $cv_historiinstruktur->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cv_historiinstruktur_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cv_historiinstruktur">
<?php if ($cv_historiinstruktur_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $cv_historiinstruktur_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fcv_historiinstrukturgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_cv_historiinstruktur" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_cv_historiinstrukturgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cv_historiinstruktur->RowType = ROWTYPE_HEADER;

// Render list options
$cv_historiinstruktur_grid->renderListOptions();

// Render list options (header, left)
$cv_historiinstruktur_grid->ListOptions->render("header", "left");
?>
<?php if ($cv_historiinstruktur_grid->bioid->Visible) { // bioid ?>
	<?php if ($cv_historiinstruktur_grid->SortUrl($cv_historiinstruktur_grid->bioid) == "") { ?>
		<th data-name="bioid" class="<?php echo $cv_historiinstruktur_grid->bioid->headerCellClass() ?>"><div id="elh_cv_historiinstruktur_bioid" class="cv_historiinstruktur_bioid"><div class="ew-table-header-caption"><?php echo $cv_historiinstruktur_grid->bioid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bioid" class="<?php echo $cv_historiinstruktur_grid->bioid->headerCellClass() ?>"><div><div id="elh_cv_historiinstruktur_bioid" class="cv_historiinstruktur_bioid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historiinstruktur_grid->bioid->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historiinstruktur_grid->bioid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historiinstruktur_grid->bioid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cv_historiinstruktur_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$cv_historiinstruktur_grid->StartRecord = 1;
$cv_historiinstruktur_grid->StopRecord = $cv_historiinstruktur_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($cv_historiinstruktur->isConfirm() || $cv_historiinstruktur_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($cv_historiinstruktur_grid->FormKeyCountName) && ($cv_historiinstruktur_grid->isGridAdd() || $cv_historiinstruktur_grid->isGridEdit() || $cv_historiinstruktur->isConfirm())) {
		$cv_historiinstruktur_grid->KeyCount = $CurrentForm->getValue($cv_historiinstruktur_grid->FormKeyCountName);
		$cv_historiinstruktur_grid->StopRecord = $cv_historiinstruktur_grid->StartRecord + $cv_historiinstruktur_grid->KeyCount - 1;
	}
}
$cv_historiinstruktur_grid->RecordCount = $cv_historiinstruktur_grid->StartRecord - 1;
if ($cv_historiinstruktur_grid->Recordset && !$cv_historiinstruktur_grid->Recordset->EOF) {
	$cv_historiinstruktur_grid->Recordset->moveFirst();
	$selectLimit = $cv_historiinstruktur_grid->UseSelectLimit;
	if (!$selectLimit && $cv_historiinstruktur_grid->StartRecord > 1)
		$cv_historiinstruktur_grid->Recordset->move($cv_historiinstruktur_grid->StartRecord - 1);
} elseif (!$cv_historiinstruktur->AllowAddDeleteRow && $cv_historiinstruktur_grid->StopRecord == 0) {
	$cv_historiinstruktur_grid->StopRecord = $cv_historiinstruktur->GridAddRowCount;
}

// Initialize aggregate
$cv_historiinstruktur->RowType = ROWTYPE_AGGREGATEINIT;
$cv_historiinstruktur->resetAttributes();
$cv_historiinstruktur_grid->renderRow();
if ($cv_historiinstruktur_grid->isGridAdd())
	$cv_historiinstruktur_grid->RowIndex = 0;
if ($cv_historiinstruktur_grid->isGridEdit())
	$cv_historiinstruktur_grid->RowIndex = 0;
while ($cv_historiinstruktur_grid->RecordCount < $cv_historiinstruktur_grid->StopRecord) {
	$cv_historiinstruktur_grid->RecordCount++;
	if ($cv_historiinstruktur_grid->RecordCount >= $cv_historiinstruktur_grid->StartRecord) {
		$cv_historiinstruktur_grid->RowCount++;
		if ($cv_historiinstruktur_grid->isGridAdd() || $cv_historiinstruktur_grid->isGridEdit() || $cv_historiinstruktur->isConfirm()) {
			$cv_historiinstruktur_grid->RowIndex++;
			$CurrentForm->Index = $cv_historiinstruktur_grid->RowIndex;
			if ($CurrentForm->hasValue($cv_historiinstruktur_grid->FormActionName) && ($cv_historiinstruktur->isConfirm() || $cv_historiinstruktur_grid->EventCancelled))
				$cv_historiinstruktur_grid->RowAction = strval($CurrentForm->getValue($cv_historiinstruktur_grid->FormActionName));
			elseif ($cv_historiinstruktur_grid->isGridAdd())
				$cv_historiinstruktur_grid->RowAction = "insert";
			else
				$cv_historiinstruktur_grid->RowAction = "";
		}

		// Set up key count
		$cv_historiinstruktur_grid->KeyCount = $cv_historiinstruktur_grid->RowIndex;

		// Init row class and style
		$cv_historiinstruktur->resetAttributes();
		$cv_historiinstruktur->CssClass = "";
		if ($cv_historiinstruktur_grid->isGridAdd()) {
			if ($cv_historiinstruktur->CurrentMode == "copy") {
				$cv_historiinstruktur_grid->loadRowValues($cv_historiinstruktur_grid->Recordset); // Load row values
				$cv_historiinstruktur_grid->setRecordKey($cv_historiinstruktur_grid->RowOldKey, $cv_historiinstruktur_grid->Recordset); // Set old record key
			} else {
				$cv_historiinstruktur_grid->loadRowValues(); // Load default values
				$cv_historiinstruktur_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$cv_historiinstruktur_grid->loadRowValues($cv_historiinstruktur_grid->Recordset); // Load row values
		}
		$cv_historiinstruktur->RowType = ROWTYPE_VIEW; // Render view
		if ($cv_historiinstruktur_grid->isGridAdd()) // Grid add
			$cv_historiinstruktur->RowType = ROWTYPE_ADD; // Render add
		if ($cv_historiinstruktur_grid->isGridAdd() && $cv_historiinstruktur->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$cv_historiinstruktur_grid->restoreCurrentRowFormValues($cv_historiinstruktur_grid->RowIndex); // Restore form values
		if ($cv_historiinstruktur_grid->isGridEdit()) { // Grid edit
			if ($cv_historiinstruktur->EventCancelled)
				$cv_historiinstruktur_grid->restoreCurrentRowFormValues($cv_historiinstruktur_grid->RowIndex); // Restore form values
			if ($cv_historiinstruktur_grid->RowAction == "insert")
				$cv_historiinstruktur->RowType = ROWTYPE_ADD; // Render add
			else
				$cv_historiinstruktur->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($cv_historiinstruktur_grid->isGridEdit() && ($cv_historiinstruktur->RowType == ROWTYPE_EDIT || $cv_historiinstruktur->RowType == ROWTYPE_ADD) && $cv_historiinstruktur->EventCancelled) // Update failed
			$cv_historiinstruktur_grid->restoreCurrentRowFormValues($cv_historiinstruktur_grid->RowIndex); // Restore form values
		if ($cv_historiinstruktur->RowType == ROWTYPE_EDIT) // Edit row
			$cv_historiinstruktur_grid->EditRowCount++;
		if ($cv_historiinstruktur->isConfirm()) // Confirm row
			$cv_historiinstruktur_grid->restoreCurrentRowFormValues($cv_historiinstruktur_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$cv_historiinstruktur->RowAttrs->merge(["data-rowindex" => $cv_historiinstruktur_grid->RowCount, "id" => "r" . $cv_historiinstruktur_grid->RowCount . "_cv_historiinstruktur", "data-rowtype" => $cv_historiinstruktur->RowType]);

		// Render row
		$cv_historiinstruktur_grid->renderRow();

		// Render list options
		$cv_historiinstruktur_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($cv_historiinstruktur_grid->RowAction != "delete" && $cv_historiinstruktur_grid->RowAction != "insertdelete" && !($cv_historiinstruktur_grid->RowAction == "insert" && $cv_historiinstruktur->isConfirm() && $cv_historiinstruktur_grid->emptyRow())) {
?>
	<tr <?php echo $cv_historiinstruktur->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cv_historiinstruktur_grid->ListOptions->render("body", "left", $cv_historiinstruktur_grid->RowCount);
?>
	<?php if ($cv_historiinstruktur_grid->bioid->Visible) { // bioid ?>
		<td data-name="bioid" <?php echo $cv_historiinstruktur_grid->bioid->cellAttributes() ?>>
<?php if ($cv_historiinstruktur->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_historiinstruktur_grid->RowCount ?>_cv_historiinstruktur_bioid" class="form-group">
<?php
$onchange = $cv_historiinstruktur_grid->bioid->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_historiinstruktur_grid->bioid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid">
	<input type="text" class="form-control" name="sv_x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" id="sv_x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" value="<?php echo RemoveHtml($cv_historiinstruktur_grid->bioid->EditValue) ?>" size="100" placeholder="<?php echo HtmlEncode($cv_historiinstruktur_grid->bioid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_historiinstruktur_grid->bioid->getPlaceHolder()) ?>"<?php echo $cv_historiinstruktur_grid->bioid->editAttributes() ?>>
</span>
<input type="hidden" data-table="cv_historiinstruktur" data-field="x_bioid" data-value-separator="<?php echo $cv_historiinstruktur_grid->bioid->displayValueSeparatorAttribute() ?>" name="x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" id="x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($cv_historiinstruktur_grid->bioid->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_historiinstrukturgrid"], function() {
	fcv_historiinstrukturgrid.createAutoSuggest({"id":"x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid","forceSelect":false});
});
</script>
<?php echo $cv_historiinstruktur_grid->bioid->Lookup->getParamTag($cv_historiinstruktur_grid, "p_x" . $cv_historiinstruktur_grid->RowIndex . "_bioid") ?>
</span>
<input type="hidden" data-table="cv_historiinstruktur" data-field="x_bioid" name="o<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" id="o<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($cv_historiinstruktur_grid->bioid->OldValue) ?>">
<?php } ?>
<?php if ($cv_historiinstruktur->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cv_historiinstruktur_grid->RowCount ?>_cv_historiinstruktur_bioid" class="form-group">
<?php
$onchange = $cv_historiinstruktur_grid->bioid->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_historiinstruktur_grid->bioid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid">
	<input type="text" class="form-control" name="sv_x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" id="sv_x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" value="<?php echo RemoveHtml($cv_historiinstruktur_grid->bioid->EditValue) ?>" size="100" placeholder="<?php echo HtmlEncode($cv_historiinstruktur_grid->bioid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_historiinstruktur_grid->bioid->getPlaceHolder()) ?>"<?php echo $cv_historiinstruktur_grid->bioid->editAttributes() ?>>
</span>
<input type="hidden" data-table="cv_historiinstruktur" data-field="x_bioid" data-value-separator="<?php echo $cv_historiinstruktur_grid->bioid->displayValueSeparatorAttribute() ?>" name="x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" id="x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($cv_historiinstruktur_grid->bioid->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_historiinstrukturgrid"], function() {
	fcv_historiinstrukturgrid.createAutoSuggest({"id":"x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid","forceSelect":false});
});
</script>
<?php echo $cv_historiinstruktur_grid->bioid->Lookup->getParamTag($cv_historiinstruktur_grid, "p_x" . $cv_historiinstruktur_grid->RowIndex . "_bioid") ?>
</span>
<?php } ?>
<?php if ($cv_historiinstruktur->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_historiinstruktur_grid->RowCount ?>_cv_historiinstruktur_bioid">
<span<?php echo $cv_historiinstruktur_grid->bioid->viewAttributes() ?>><?php echo $cv_historiinstruktur_grid->bioid->getViewValue() ?></span>
</span>
<?php if (!$cv_historiinstruktur->isConfirm()) { ?>
<input type="hidden" data-table="cv_historiinstruktur" data-field="x_bioid" name="x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" id="x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($cv_historiinstruktur_grid->bioid->FormValue) ?>">
<input type="hidden" data-table="cv_historiinstruktur" data-field="x_bioid" name="o<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" id="o<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($cv_historiinstruktur_grid->bioid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cv_historiinstruktur" data-field="x_bioid" name="fcv_historiinstrukturgrid$x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" id="fcv_historiinstrukturgrid$x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($cv_historiinstruktur_grid->bioid->FormValue) ?>">
<input type="hidden" data-table="cv_historiinstruktur" data-field="x_bioid" name="fcv_historiinstrukturgrid$o<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" id="fcv_historiinstrukturgrid$o<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($cv_historiinstruktur_grid->bioid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($cv_historiinstruktur->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="cv_historiinstruktur" data-field="x_ipid" name="x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_ipid" id="x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_ipid" value="<?php echo HtmlEncode($cv_historiinstruktur_grid->ipid->CurrentValue) ?>">
<input type="hidden" data-table="cv_historiinstruktur" data-field="x_ipid" name="o<?php echo $cv_historiinstruktur_grid->RowIndex ?>_ipid" id="o<?php echo $cv_historiinstruktur_grid->RowIndex ?>_ipid" value="<?php echo HtmlEncode($cv_historiinstruktur_grid->ipid->OldValue) ?>">
<?php } ?>
<?php if ($cv_historiinstruktur->RowType == ROWTYPE_EDIT || $cv_historiinstruktur->CurrentMode == "edit") { ?>
<input type="hidden" data-table="cv_historiinstruktur" data-field="x_ipid" name="x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_ipid" id="x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_ipid" value="<?php echo HtmlEncode($cv_historiinstruktur_grid->ipid->CurrentValue) ?>">
<?php } ?>
<?php

// Render list options (body, right)
$cv_historiinstruktur_grid->ListOptions->render("body", "right", $cv_historiinstruktur_grid->RowCount);
?>
	</tr>
<?php if ($cv_historiinstruktur->RowType == ROWTYPE_ADD || $cv_historiinstruktur->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fcv_historiinstrukturgrid", "load"], function() {
	fcv_historiinstrukturgrid.updateLists(<?php echo $cv_historiinstruktur_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$cv_historiinstruktur_grid->isGridAdd() || $cv_historiinstruktur->CurrentMode == "copy")
		if (!$cv_historiinstruktur_grid->Recordset->EOF)
			$cv_historiinstruktur_grid->Recordset->moveNext();
}
?>
<?php
	if ($cv_historiinstruktur->CurrentMode == "add" || $cv_historiinstruktur->CurrentMode == "copy" || $cv_historiinstruktur->CurrentMode == "edit") {
		$cv_historiinstruktur_grid->RowIndex = '$rowindex$';
		$cv_historiinstruktur_grid->loadRowValues();

		// Set row properties
		$cv_historiinstruktur->resetAttributes();
		$cv_historiinstruktur->RowAttrs->merge(["data-rowindex" => $cv_historiinstruktur_grid->RowIndex, "id" => "r0_cv_historiinstruktur", "data-rowtype" => ROWTYPE_ADD]);
		$cv_historiinstruktur->RowAttrs->appendClass("ew-template");
		$cv_historiinstruktur->RowType = ROWTYPE_ADD;

		// Render row
		$cv_historiinstruktur_grid->renderRow();

		// Render list options
		$cv_historiinstruktur_grid->renderListOptions();
		$cv_historiinstruktur_grid->StartRowCount = 0;
?>
	<tr <?php echo $cv_historiinstruktur->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cv_historiinstruktur_grid->ListOptions->render("body", "left", $cv_historiinstruktur_grid->RowIndex);
?>
	<?php if ($cv_historiinstruktur_grid->bioid->Visible) { // bioid ?>
		<td data-name="bioid">
<?php if (!$cv_historiinstruktur->isConfirm()) { ?>
<span id="el$rowindex$_cv_historiinstruktur_bioid" class="form-group cv_historiinstruktur_bioid">
<?php
$onchange = $cv_historiinstruktur_grid->bioid->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_historiinstruktur_grid->bioid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid">
	<input type="text" class="form-control" name="sv_x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" id="sv_x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" value="<?php echo RemoveHtml($cv_historiinstruktur_grid->bioid->EditValue) ?>" size="100" placeholder="<?php echo HtmlEncode($cv_historiinstruktur_grid->bioid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_historiinstruktur_grid->bioid->getPlaceHolder()) ?>"<?php echo $cv_historiinstruktur_grid->bioid->editAttributes() ?>>
</span>
<input type="hidden" data-table="cv_historiinstruktur" data-field="x_bioid" data-value-separator="<?php echo $cv_historiinstruktur_grid->bioid->displayValueSeparatorAttribute() ?>" name="x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" id="x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($cv_historiinstruktur_grid->bioid->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_historiinstrukturgrid"], function() {
	fcv_historiinstrukturgrid.createAutoSuggest({"id":"x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid","forceSelect":false});
});
</script>
<?php echo $cv_historiinstruktur_grid->bioid->Lookup->getParamTag($cv_historiinstruktur_grid, "p_x" . $cv_historiinstruktur_grid->RowIndex . "_bioid") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_cv_historiinstruktur_bioid" class="form-group cv_historiinstruktur_bioid">
<span<?php echo $cv_historiinstruktur_grid->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historiinstruktur_grid->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_historiinstruktur" data-field="x_bioid" name="x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" id="x<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($cv_historiinstruktur_grid->bioid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cv_historiinstruktur" data-field="x_bioid" name="o<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" id="o<?php echo $cv_historiinstruktur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($cv_historiinstruktur_grid->bioid->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cv_historiinstruktur_grid->ListOptions->render("body", "right", $cv_historiinstruktur_grid->RowIndex);
?>
<script>
loadjs.ready(["fcv_historiinstrukturgrid", "load"], function() {
	fcv_historiinstrukturgrid.updateLists(<?php echo $cv_historiinstruktur_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($cv_historiinstruktur->CurrentMode == "add" || $cv_historiinstruktur->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $cv_historiinstruktur_grid->FormKeyCountName ?>" id="<?php echo $cv_historiinstruktur_grid->FormKeyCountName ?>" value="<?php echo $cv_historiinstruktur_grid->KeyCount ?>">
<?php echo $cv_historiinstruktur_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cv_historiinstruktur->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $cv_historiinstruktur_grid->FormKeyCountName ?>" id="<?php echo $cv_historiinstruktur_grid->FormKeyCountName ?>" value="<?php echo $cv_historiinstruktur_grid->KeyCount ?>">
<?php echo $cv_historiinstruktur_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cv_historiinstruktur->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcv_historiinstrukturgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cv_historiinstruktur_grid->Recordset)
	$cv_historiinstruktur_grid->Recordset->Close();
?>
<?php if ($cv_historiinstruktur_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $cv_historiinstruktur_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cv_historiinstruktur_grid->TotalRecords == 0 && !$cv_historiinstruktur->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cv_historiinstruktur_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$cv_historiinstruktur_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$cv_historiinstruktur_grid->terminate();
?>