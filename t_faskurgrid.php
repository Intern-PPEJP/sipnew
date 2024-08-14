<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($t_faskur_grid))
	$t_faskur_grid = new t_faskur_grid();

// Run the page
$t_faskur_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_faskur_grid->Page_Render();
?>
<?php if (!$t_faskur_grid->isExport()) { ?>
<script>
var ft_faskurgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	ft_faskurgrid = new ew.Form("ft_faskurgrid", "grid");
	ft_faskurgrid.formKeyCountName = '<?php echo $t_faskur_grid->FormKeyCountName ?>';

	// Validate form
	ft_faskurgrid.validate = function() {
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
			<?php if ($t_faskur_grid->bioid->Required) { ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_faskur_grid->bioid->caption(), $t_faskur_grid->bioid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_faskur_grid->bioid->errorMessage()) ?>");
			<?php if ($t_faskur_grid->kurikulumid->Required) { ?>
				elm = this.getElements("x" + infix + "_kurikulumid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_faskur_grid->kurikulumid->caption(), $t_faskur_grid->kurikulumid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kurikulumid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_faskur_grid->kurikulumid->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	ft_faskurgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "bioid", false)) return false;
		if (ew.valueChanged(fobj, infix, "kurikulumid", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_faskurgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_faskurgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_faskurgrid.lists["x_bioid"] = <?php echo $t_faskur_grid->bioid->Lookup->toClientList($t_faskur_grid) ?>;
	ft_faskurgrid.lists["x_bioid"].options = <?php echo JsonEncode($t_faskur_grid->bioid->lookupOptions()) ?>;
	ft_faskurgrid.autoSuggests["x_bioid"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_faskurgrid.lists["x_kurikulumid"] = <?php echo $t_faskur_grid->kurikulumid->Lookup->toClientList($t_faskur_grid) ?>;
	ft_faskurgrid.lists["x_kurikulumid"].options = <?php echo JsonEncode($t_faskur_grid->kurikulumid->lookupOptions()) ?>;
	ft_faskurgrid.autoSuggests["x_kurikulumid"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("ft_faskurgrid");
});
</script>
<script>
ew.ready("head", "js/ewfixedheadertable.js", "fixedheadertable");
</script>
<?php } ?>
<?php
$t_faskur_grid->renderOtherOptions();
?>
<?php if ($t_faskur_grid->TotalRecords > 0 || $t_faskur->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_faskur_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_faskur">
<?php if ($t_faskur_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $t_faskur_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ft_faskurgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_t_faskur" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_t_faskurgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_faskur->RowType = ROWTYPE_HEADER;

// Render list options
$t_faskur_grid->renderListOptions();

// Render list options (header, left)
$t_faskur_grid->ListOptions->render("header", "left");
?>
<?php if ($t_faskur_grid->bioid->Visible) { // bioid ?>
	<?php if ($t_faskur_grid->SortUrl($t_faskur_grid->bioid) == "") { ?>
		<th data-name="bioid" class="<?php echo $t_faskur_grid->bioid->headerCellClass() ?>"><div id="elh_t_faskur_bioid" class="t_faskur_bioid"><div class="ew-table-header-caption"><?php echo $t_faskur_grid->bioid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bioid" class="<?php echo $t_faskur_grid->bioid->headerCellClass() ?>"><div><div id="elh_t_faskur_bioid" class="t_faskur_bioid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_faskur_grid->bioid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_faskur_grid->bioid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_faskur_grid->bioid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_faskur_grid->kurikulumid->Visible) { // kurikulumid ?>
	<?php if ($t_faskur_grid->SortUrl($t_faskur_grid->kurikulumid) == "") { ?>
		<th data-name="kurikulumid" class="<?php echo $t_faskur_grid->kurikulumid->headerCellClass() ?>"><div id="elh_t_faskur_kurikulumid" class="t_faskur_kurikulumid"><div class="ew-table-header-caption"><?php echo $t_faskur_grid->kurikulumid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kurikulumid" class="<?php echo $t_faskur_grid->kurikulumid->headerCellClass() ?>"><div><div id="elh_t_faskur_kurikulumid" class="t_faskur_kurikulumid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_faskur_grid->kurikulumid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_faskur_grid->kurikulumid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_faskur_grid->kurikulumid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_faskur_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_faskur_grid->StartRecord = 1;
$t_faskur_grid->StopRecord = $t_faskur_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($t_faskur->isConfirm() || $t_faskur_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_faskur_grid->FormKeyCountName) && ($t_faskur_grid->isGridAdd() || $t_faskur_grid->isGridEdit() || $t_faskur->isConfirm())) {
		$t_faskur_grid->KeyCount = $CurrentForm->getValue($t_faskur_grid->FormKeyCountName);
		$t_faskur_grid->StopRecord = $t_faskur_grid->StartRecord + $t_faskur_grid->KeyCount - 1;
	}
}
$t_faskur_grid->RecordCount = $t_faskur_grid->StartRecord - 1;
if ($t_faskur_grid->Recordset && !$t_faskur_grid->Recordset->EOF) {
	$t_faskur_grid->Recordset->moveFirst();
	$selectLimit = $t_faskur_grid->UseSelectLimit;
	if (!$selectLimit && $t_faskur_grid->StartRecord > 1)
		$t_faskur_grid->Recordset->move($t_faskur_grid->StartRecord - 1);
} elseif (!$t_faskur->AllowAddDeleteRow && $t_faskur_grid->StopRecord == 0) {
	$t_faskur_grid->StopRecord = $t_faskur->GridAddRowCount;
}

// Initialize aggregate
$t_faskur->RowType = ROWTYPE_AGGREGATEINIT;
$t_faskur->resetAttributes();
$t_faskur_grid->renderRow();
if ($t_faskur_grid->isGridAdd())
	$t_faskur_grid->RowIndex = 0;
if ($t_faskur_grid->isGridEdit())
	$t_faskur_grid->RowIndex = 0;
while ($t_faskur_grid->RecordCount < $t_faskur_grid->StopRecord) {
	$t_faskur_grid->RecordCount++;
	if ($t_faskur_grid->RecordCount >= $t_faskur_grid->StartRecord) {
		$t_faskur_grid->RowCount++;
		if ($t_faskur_grid->isGridAdd() || $t_faskur_grid->isGridEdit() || $t_faskur->isConfirm()) {
			$t_faskur_grid->RowIndex++;
			$CurrentForm->Index = $t_faskur_grid->RowIndex;
			if ($CurrentForm->hasValue($t_faskur_grid->FormActionName) && ($t_faskur->isConfirm() || $t_faskur_grid->EventCancelled))
				$t_faskur_grid->RowAction = strval($CurrentForm->getValue($t_faskur_grid->FormActionName));
			elseif ($t_faskur_grid->isGridAdd())
				$t_faskur_grid->RowAction = "insert";
			else
				$t_faskur_grid->RowAction = "";
		}

		// Set up key count
		$t_faskur_grid->KeyCount = $t_faskur_grid->RowIndex;

		// Init row class and style
		$t_faskur->resetAttributes();
		$t_faskur->CssClass = "";
		if ($t_faskur_grid->isGridAdd()) {
			if ($t_faskur->CurrentMode == "copy") {
				$t_faskur_grid->loadRowValues($t_faskur_grid->Recordset); // Load row values
				$t_faskur_grid->setRecordKey($t_faskur_grid->RowOldKey, $t_faskur_grid->Recordset); // Set old record key
			} else {
				$t_faskur_grid->loadRowValues(); // Load default values
				$t_faskur_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_faskur_grid->loadRowValues($t_faskur_grid->Recordset); // Load row values
		}
		$t_faskur->RowType = ROWTYPE_VIEW; // Render view
		if ($t_faskur_grid->isGridAdd()) // Grid add
			$t_faskur->RowType = ROWTYPE_ADD; // Render add
		if ($t_faskur_grid->isGridAdd() && $t_faskur->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_faskur_grid->restoreCurrentRowFormValues($t_faskur_grid->RowIndex); // Restore form values
		if ($t_faskur_grid->isGridEdit()) { // Grid edit
			if ($t_faskur->EventCancelled)
				$t_faskur_grid->restoreCurrentRowFormValues($t_faskur_grid->RowIndex); // Restore form values
			if ($t_faskur_grid->RowAction == "insert")
				$t_faskur->RowType = ROWTYPE_ADD; // Render add
			else
				$t_faskur->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_faskur_grid->isGridEdit() && ($t_faskur->RowType == ROWTYPE_EDIT || $t_faskur->RowType == ROWTYPE_ADD) && $t_faskur->EventCancelled) // Update failed
			$t_faskur_grid->restoreCurrentRowFormValues($t_faskur_grid->RowIndex); // Restore form values
		if ($t_faskur->RowType == ROWTYPE_EDIT) // Edit row
			$t_faskur_grid->EditRowCount++;
		if ($t_faskur->isConfirm()) // Confirm row
			$t_faskur_grid->restoreCurrentRowFormValues($t_faskur_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_faskur->RowAttrs->merge(["data-rowindex" => $t_faskur_grid->RowCount, "id" => "r" . $t_faskur_grid->RowCount . "_t_faskur", "data-rowtype" => $t_faskur->RowType]);

		// Render row
		$t_faskur_grid->renderRow();

		// Render list options
		$t_faskur_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_faskur_grid->RowAction != "delete" && $t_faskur_grid->RowAction != "insertdelete" && !($t_faskur_grid->RowAction == "insert" && $t_faskur->isConfirm() && $t_faskur_grid->emptyRow())) {
?>
	<tr <?php echo $t_faskur->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_faskur_grid->ListOptions->render("body", "left", $t_faskur_grid->RowCount);
?>
	<?php if ($t_faskur_grid->bioid->Visible) { // bioid ?>
		<td data-name="bioid" <?php echo $t_faskur_grid->bioid->cellAttributes() ?>>
<?php if ($t_faskur->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($t_faskur_grid->bioid->getSessionValue() != "") { ?>
<span id="el<?php echo $t_faskur_grid->RowCount ?>_t_faskur_bioid" class="form-group">
<span<?php echo $t_faskur_grid->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_faskur_grid->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_faskur_grid->RowIndex ?>_bioid" name="x<?php echo $t_faskur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_faskur_grid->bioid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_faskur_grid->RowCount ?>_t_faskur_bioid" class="form-group">
<?php
$onchange = $t_faskur_grid->bioid->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_faskur_grid->bioid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_faskur_grid->RowIndex ?>_bioid">
	<input type="text" class="form-control" name="sv_x<?php echo $t_faskur_grid->RowIndex ?>_bioid" id="sv_x<?php echo $t_faskur_grid->RowIndex ?>_bioid" value="<?php echo RemoveHtml($t_faskur_grid->bioid->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($t_faskur_grid->bioid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_faskur_grid->bioid->getPlaceHolder()) ?>"<?php echo $t_faskur_grid->bioid->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_faskur" data-field="x_bioid" data-value-separator="<?php echo $t_faskur_grid->bioid->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_faskur_grid->RowIndex ?>_bioid" id="x<?php echo $t_faskur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_faskur_grid->bioid->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_faskurgrid"], function() {
	ft_faskurgrid.createAutoSuggest({"id":"x<?php echo $t_faskur_grid->RowIndex ?>_bioid","forceSelect":false,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_faskur_grid->bioid->Lookup->getParamTag($t_faskur_grid, "p_x" . $t_faskur_grid->RowIndex . "_bioid") ?>
</span>
<?php } ?>
<input type="hidden" data-table="t_faskur" data-field="x_bioid" name="o<?php echo $t_faskur_grid->RowIndex ?>_bioid" id="o<?php echo $t_faskur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_faskur_grid->bioid->OldValue) ?>">
<?php } ?>
<?php if ($t_faskur->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t_faskur_grid->bioid->getSessionValue() != "") { ?>
<span id="el<?php echo $t_faskur_grid->RowCount ?>_t_faskur_bioid" class="form-group">
<span<?php echo $t_faskur_grid->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_faskur_grid->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_faskur_grid->RowIndex ?>_bioid" name="x<?php echo $t_faskur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_faskur_grid->bioid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_faskur_grid->RowCount ?>_t_faskur_bioid" class="form-group">
<?php
$onchange = $t_faskur_grid->bioid->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_faskur_grid->bioid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_faskur_grid->RowIndex ?>_bioid">
	<input type="text" class="form-control" name="sv_x<?php echo $t_faskur_grid->RowIndex ?>_bioid" id="sv_x<?php echo $t_faskur_grid->RowIndex ?>_bioid" value="<?php echo RemoveHtml($t_faskur_grid->bioid->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($t_faskur_grid->bioid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_faskur_grid->bioid->getPlaceHolder()) ?>"<?php echo $t_faskur_grid->bioid->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_faskur" data-field="x_bioid" data-value-separator="<?php echo $t_faskur_grid->bioid->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_faskur_grid->RowIndex ?>_bioid" id="x<?php echo $t_faskur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_faskur_grid->bioid->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_faskurgrid"], function() {
	ft_faskurgrid.createAutoSuggest({"id":"x<?php echo $t_faskur_grid->RowIndex ?>_bioid","forceSelect":false,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_faskur_grid->bioid->Lookup->getParamTag($t_faskur_grid, "p_x" . $t_faskur_grid->RowIndex . "_bioid") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($t_faskur->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_faskur_grid->RowCount ?>_t_faskur_bioid">
<span<?php echo $t_faskur_grid->bioid->viewAttributes() ?>><?php echo $t_faskur_grid->bioid->getViewValue() ?></span>
</span>
<?php if (!$t_faskur->isConfirm()) { ?>
<input type="hidden" data-table="t_faskur" data-field="x_bioid" name="x<?php echo $t_faskur_grid->RowIndex ?>_bioid" id="x<?php echo $t_faskur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_faskur_grid->bioid->FormValue) ?>">
<input type="hidden" data-table="t_faskur" data-field="x_bioid" name="o<?php echo $t_faskur_grid->RowIndex ?>_bioid" id="o<?php echo $t_faskur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_faskur_grid->bioid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_faskur" data-field="x_bioid" name="ft_faskurgrid$x<?php echo $t_faskur_grid->RowIndex ?>_bioid" id="ft_faskurgrid$x<?php echo $t_faskur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_faskur_grid->bioid->FormValue) ?>">
<input type="hidden" data-table="t_faskur" data-field="x_bioid" name="ft_faskurgrid$o<?php echo $t_faskur_grid->RowIndex ?>_bioid" id="ft_faskurgrid$o<?php echo $t_faskur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_faskur_grid->bioid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($t_faskur->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t_faskur" data-field="x_faskurid" name="x<?php echo $t_faskur_grid->RowIndex ?>_faskurid" id="x<?php echo $t_faskur_grid->RowIndex ?>_faskurid" value="<?php echo HtmlEncode($t_faskur_grid->faskurid->CurrentValue) ?>">
<input type="hidden" data-table="t_faskur" data-field="x_faskurid" name="o<?php echo $t_faskur_grid->RowIndex ?>_faskurid" id="o<?php echo $t_faskur_grid->RowIndex ?>_faskurid" value="<?php echo HtmlEncode($t_faskur_grid->faskurid->OldValue) ?>">
<?php } ?>
<?php if ($t_faskur->RowType == ROWTYPE_EDIT || $t_faskur->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t_faskur" data-field="x_faskurid" name="x<?php echo $t_faskur_grid->RowIndex ?>_faskurid" id="x<?php echo $t_faskur_grid->RowIndex ?>_faskurid" value="<?php echo HtmlEncode($t_faskur_grid->faskurid->CurrentValue) ?>">
<?php } ?>
	<?php if ($t_faskur_grid->kurikulumid->Visible) { // kurikulumid ?>
		<td data-name="kurikulumid" <?php echo $t_faskur_grid->kurikulumid->cellAttributes() ?>>
<?php if ($t_faskur->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_faskur_grid->RowCount ?>_t_faskur_kurikulumid" class="form-group">
<?php
$onchange = $t_faskur_grid->kurikulumid->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_faskur_grid->kurikulumid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid">
	<input type="text" class="form-control" name="sv_x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" id="sv_x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" value="<?php echo RemoveHtml($t_faskur_grid->kurikulumid->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($t_faskur_grid->kurikulumid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_faskur_grid->kurikulumid->getPlaceHolder()) ?>"<?php echo $t_faskur_grid->kurikulumid->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_faskur" data-field="x_kurikulumid" data-value-separator="<?php echo $t_faskur_grid->kurikulumid->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" id="x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_faskur_grid->kurikulumid->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_faskurgrid"], function() {
	ft_faskurgrid.createAutoSuggest({"id":"x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_faskur_grid->kurikulumid->Lookup->getParamTag($t_faskur_grid, "p_x" . $t_faskur_grid->RowIndex . "_kurikulumid") ?>
</span>
<input type="hidden" data-table="t_faskur" data-field="x_kurikulumid" name="o<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" id="o<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_faskur_grid->kurikulumid->OldValue) ?>">
<?php } ?>
<?php if ($t_faskur->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_faskur_grid->RowCount ?>_t_faskur_kurikulumid" class="form-group">
<?php
$onchange = $t_faskur_grid->kurikulumid->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_faskur_grid->kurikulumid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid">
	<input type="text" class="form-control" name="sv_x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" id="sv_x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" value="<?php echo RemoveHtml($t_faskur_grid->kurikulumid->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($t_faskur_grid->kurikulumid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_faskur_grid->kurikulumid->getPlaceHolder()) ?>"<?php echo $t_faskur_grid->kurikulumid->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_faskur" data-field="x_kurikulumid" data-value-separator="<?php echo $t_faskur_grid->kurikulumid->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" id="x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_faskur_grid->kurikulumid->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_faskurgrid"], function() {
	ft_faskurgrid.createAutoSuggest({"id":"x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_faskur_grid->kurikulumid->Lookup->getParamTag($t_faskur_grid, "p_x" . $t_faskur_grid->RowIndex . "_kurikulumid") ?>
</span>
<?php } ?>
<?php if ($t_faskur->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_faskur_grid->RowCount ?>_t_faskur_kurikulumid">
<span<?php echo $t_faskur_grid->kurikulumid->viewAttributes() ?>><?php echo $t_faskur_grid->kurikulumid->getViewValue() ?></span>
</span>
<?php if (!$t_faskur->isConfirm()) { ?>
<input type="hidden" data-table="t_faskur" data-field="x_kurikulumid" name="x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" id="x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_faskur_grid->kurikulumid->FormValue) ?>">
<input type="hidden" data-table="t_faskur" data-field="x_kurikulumid" name="o<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" id="o<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_faskur_grid->kurikulumid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_faskur" data-field="x_kurikulumid" name="ft_faskurgrid$x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" id="ft_faskurgrid$x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_faskur_grid->kurikulumid->FormValue) ?>">
<input type="hidden" data-table="t_faskur" data-field="x_kurikulumid" name="ft_faskurgrid$o<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" id="ft_faskurgrid$o<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_faskur_grid->kurikulumid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_faskur_grid->ListOptions->render("body", "right", $t_faskur_grid->RowCount);
?>
	</tr>
<?php if ($t_faskur->RowType == ROWTYPE_ADD || $t_faskur->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_faskurgrid", "load"], function() {
	ft_faskurgrid.updateLists(<?php echo $t_faskur_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_faskur_grid->isGridAdd() || $t_faskur->CurrentMode == "copy")
		if (!$t_faskur_grid->Recordset->EOF)
			$t_faskur_grid->Recordset->moveNext();
}
?>
<?php
	if ($t_faskur->CurrentMode == "add" || $t_faskur->CurrentMode == "copy" || $t_faskur->CurrentMode == "edit") {
		$t_faskur_grid->RowIndex = '$rowindex$';
		$t_faskur_grid->loadRowValues();

		// Set row properties
		$t_faskur->resetAttributes();
		$t_faskur->RowAttrs->merge(["data-rowindex" => $t_faskur_grid->RowIndex, "id" => "r0_t_faskur", "data-rowtype" => ROWTYPE_ADD]);
		$t_faskur->RowAttrs->appendClass("ew-template");
		$t_faskur->RowType = ROWTYPE_ADD;

		// Render row
		$t_faskur_grid->renderRow();

		// Render list options
		$t_faskur_grid->renderListOptions();
		$t_faskur_grid->StartRowCount = 0;
?>
	<tr <?php echo $t_faskur->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_faskur_grid->ListOptions->render("body", "left", $t_faskur_grid->RowIndex);
?>
	<?php if ($t_faskur_grid->bioid->Visible) { // bioid ?>
		<td data-name="bioid">
<?php if (!$t_faskur->isConfirm()) { ?>
<?php if ($t_faskur_grid->bioid->getSessionValue() != "") { ?>
<span id="el$rowindex$_t_faskur_bioid" class="form-group t_faskur_bioid">
<span<?php echo $t_faskur_grid->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_faskur_grid->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_faskur_grid->RowIndex ?>_bioid" name="x<?php echo $t_faskur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_faskur_grid->bioid->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_faskur_bioid" class="form-group t_faskur_bioid">
<?php
$onchange = $t_faskur_grid->bioid->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_faskur_grid->bioid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_faskur_grid->RowIndex ?>_bioid">
	<input type="text" class="form-control" name="sv_x<?php echo $t_faskur_grid->RowIndex ?>_bioid" id="sv_x<?php echo $t_faskur_grid->RowIndex ?>_bioid" value="<?php echo RemoveHtml($t_faskur_grid->bioid->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($t_faskur_grid->bioid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_faskur_grid->bioid->getPlaceHolder()) ?>"<?php echo $t_faskur_grid->bioid->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_faskur" data-field="x_bioid" data-value-separator="<?php echo $t_faskur_grid->bioid->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_faskur_grid->RowIndex ?>_bioid" id="x<?php echo $t_faskur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_faskur_grid->bioid->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_faskurgrid"], function() {
	ft_faskurgrid.createAutoSuggest({"id":"x<?php echo $t_faskur_grid->RowIndex ?>_bioid","forceSelect":false,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_faskur_grid->bioid->Lookup->getParamTag($t_faskur_grid, "p_x" . $t_faskur_grid->RowIndex . "_bioid") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t_faskur_bioid" class="form-group t_faskur_bioid">
<span<?php echo $t_faskur_grid->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_faskur_grid->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_faskur" data-field="x_bioid" name="x<?php echo $t_faskur_grid->RowIndex ?>_bioid" id="x<?php echo $t_faskur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_faskur_grid->bioid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_faskur" data-field="x_bioid" name="o<?php echo $t_faskur_grid->RowIndex ?>_bioid" id="o<?php echo $t_faskur_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_faskur_grid->bioid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_faskur_grid->kurikulumid->Visible) { // kurikulumid ?>
		<td data-name="kurikulumid">
<?php if (!$t_faskur->isConfirm()) { ?>
<span id="el$rowindex$_t_faskur_kurikulumid" class="form-group t_faskur_kurikulumid">
<?php
$onchange = $t_faskur_grid->kurikulumid->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_faskur_grid->kurikulumid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid">
	<input type="text" class="form-control" name="sv_x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" id="sv_x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" value="<?php echo RemoveHtml($t_faskur_grid->kurikulumid->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($t_faskur_grid->kurikulumid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_faskur_grid->kurikulumid->getPlaceHolder()) ?>"<?php echo $t_faskur_grid->kurikulumid->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_faskur" data-field="x_kurikulumid" data-value-separator="<?php echo $t_faskur_grid->kurikulumid->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" id="x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_faskur_grid->kurikulumid->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_faskurgrid"], function() {
	ft_faskurgrid.createAutoSuggest({"id":"x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_faskur_grid->kurikulumid->Lookup->getParamTag($t_faskur_grid, "p_x" . $t_faskur_grid->RowIndex . "_kurikulumid") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_faskur_kurikulumid" class="form-group t_faskur_kurikulumid">
<span<?php echo $t_faskur_grid->kurikulumid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_faskur_grid->kurikulumid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_faskur" data-field="x_kurikulumid" name="x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" id="x<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_faskur_grid->kurikulumid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_faskur" data-field="x_kurikulumid" name="o<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" id="o<?php echo $t_faskur_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_faskur_grid->kurikulumid->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_faskur_grid->ListOptions->render("body", "right", $t_faskur_grid->RowIndex);
?>
<script>
loadjs.ready(["ft_faskurgrid", "load"], function() {
	ft_faskurgrid.updateLists(<?php echo $t_faskur_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($t_faskur->CurrentMode == "add" || $t_faskur->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $t_faskur_grid->FormKeyCountName ?>" id="<?php echo $t_faskur_grid->FormKeyCountName ?>" value="<?php echo $t_faskur_grid->KeyCount ?>">
<?php echo $t_faskur_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_faskur->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $t_faskur_grid->FormKeyCountName ?>" id="<?php echo $t_faskur_grid->FormKeyCountName ?>" value="<?php echo $t_faskur_grid->KeyCount ?>">
<?php echo $t_faskur_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_faskur->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_faskurgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_faskur_grid->Recordset)
	$t_faskur_grid->Recordset->Close();
?>
<?php if ($t_faskur_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $t_faskur_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_faskur_grid->TotalRecords == 0 && !$t_faskur->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_faskur_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$t_faskur_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php if (!$t_faskur->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_t_faskur",
		width: "100%",
		height: "350px"
	});
});
</script>
<?php } ?>
<?php } ?>
<?php
$t_faskur_grid->terminate();
?>