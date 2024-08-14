<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($t_evaluasifas_grid))
	$t_evaluasifas_grid = new t_evaluasifas_grid();

// Run the page
$t_evaluasifas_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_evaluasifas_grid->Page_Render();
?>
<?php if (!$t_evaluasifas_grid->isExport()) { ?>
<script>
var ft_evaluasifasgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	ft_evaluasifasgrid = new ew.Form("ft_evaluasifasgrid", "grid");
	ft_evaluasifasgrid.formKeyCountName = '<?php echo $t_evaluasifas_grid->FormKeyCountName ?>';

	// Validate form
	ft_evaluasifasgrid.validate = function() {
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
			<?php if ($t_evaluasifas_grid->bioid->Required) { ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_evaluasifas_grid->bioid->caption(), $t_evaluasifas_grid->bioid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_evaluasifas_grid->bioid->errorMessage()) ?>");
			<?php if ($t_evaluasifas_grid->idpelat->Required) { ?>
				elm = this.getElements("x" + infix + "_idpelat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_evaluasifas_grid->idpelat->caption(), $t_evaluasifas_grid->idpelat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_evaluasifas_grid->kurikulumid->Required) { ?>
				elm = this.getElements("x" + infix + "_kurikulumid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_evaluasifas_grid->kurikulumid->caption(), $t_evaluasifas_grid->kurikulumid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_evaluasifas_grid->nilai->Required) { ?>
				elm = this.getElements("x" + infix + "_nilai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_evaluasifas_grid->nilai->caption(), $t_evaluasifas_grid->nilai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nilai");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_evaluasifas_grid->nilai->errorMessage()) ?>");
			<?php if ($t_evaluasifas_grid->komentar->Required) { ?>
				elm = this.getElements("x" + infix + "_komentar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_evaluasifas_grid->komentar->caption(), $t_evaluasifas_grid->komentar->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	ft_evaluasifasgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "bioid", false)) return false;
		if (ew.valueChanged(fobj, infix, "idpelat", false)) return false;
		if (ew.valueChanged(fobj, infix, "kurikulumid", false)) return false;
		if (ew.valueChanged(fobj, infix, "nilai", false)) return false;
		if (ew.valueChanged(fobj, infix, "komentar", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_evaluasifasgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_evaluasifasgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_evaluasifasgrid.lists["x_bioid"] = <?php echo $t_evaluasifas_grid->bioid->Lookup->toClientList($t_evaluasifas_grid) ?>;
	ft_evaluasifasgrid.lists["x_bioid"].options = <?php echo JsonEncode($t_evaluasifas_grid->bioid->lookupOptions()) ?>;
	ft_evaluasifasgrid.autoSuggests["x_bioid"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_evaluasifasgrid.lists["x_idpelat"] = <?php echo $t_evaluasifas_grid->idpelat->Lookup->toClientList($t_evaluasifas_grid) ?>;
	ft_evaluasifasgrid.lists["x_idpelat"].options = <?php echo JsonEncode($t_evaluasifas_grid->idpelat->lookupOptions()) ?>;
	ft_evaluasifasgrid.lists["x_kurikulumid"] = <?php echo $t_evaluasifas_grid->kurikulumid->Lookup->toClientList($t_evaluasifas_grid) ?>;
	ft_evaluasifasgrid.lists["x_kurikulumid"].options = <?php echo JsonEncode($t_evaluasifas_grid->kurikulumid->lookupOptions()) ?>;
	loadjs.done("ft_evaluasifasgrid");
});
</script>
<?php } ?>
<?php
$t_evaluasifas_grid->renderOtherOptions();
?>
<?php if ($t_evaluasifas_grid->TotalRecords > 0 || $t_evaluasifas->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_evaluasifas_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_evaluasifas">
<?php if ($t_evaluasifas_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $t_evaluasifas_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ft_evaluasifasgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_t_evaluasifas" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_t_evaluasifasgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_evaluasifas->RowType = ROWTYPE_HEADER;

// Render list options
$t_evaluasifas_grid->renderListOptions();

// Render list options (header, left)
$t_evaluasifas_grid->ListOptions->render("header", "left");
?>
<?php if ($t_evaluasifas_grid->bioid->Visible) { // bioid ?>
	<?php if ($t_evaluasifas_grid->SortUrl($t_evaluasifas_grid->bioid) == "") { ?>
		<th data-name="bioid" class="<?php echo $t_evaluasifas_grid->bioid->headerCellClass() ?>"><div id="elh_t_evaluasifas_bioid" class="t_evaluasifas_bioid"><div class="ew-table-header-caption"><?php echo $t_evaluasifas_grid->bioid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bioid" class="<?php echo $t_evaluasifas_grid->bioid->headerCellClass() ?>"><div><div id="elh_t_evaluasifas_bioid" class="t_evaluasifas_bioid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_evaluasifas_grid->bioid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_evaluasifas_grid->bioid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_evaluasifas_grid->bioid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_evaluasifas_grid->idpelat->Visible) { // idpelat ?>
	<?php if ($t_evaluasifas_grid->SortUrl($t_evaluasifas_grid->idpelat) == "") { ?>
		<th data-name="idpelat" class="<?php echo $t_evaluasifas_grid->idpelat->headerCellClass() ?>"><div id="elh_t_evaluasifas_idpelat" class="t_evaluasifas_idpelat"><div class="ew-table-header-caption"><?php echo $t_evaluasifas_grid->idpelat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idpelat" class="<?php echo $t_evaluasifas_grid->idpelat->headerCellClass() ?>"><div><div id="elh_t_evaluasifas_idpelat" class="t_evaluasifas_idpelat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_evaluasifas_grid->idpelat->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_evaluasifas_grid->idpelat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_evaluasifas_grid->idpelat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_evaluasifas_grid->kurikulumid->Visible) { // kurikulumid ?>
	<?php if ($t_evaluasifas_grid->SortUrl($t_evaluasifas_grid->kurikulumid) == "") { ?>
		<th data-name="kurikulumid" class="<?php echo $t_evaluasifas_grid->kurikulumid->headerCellClass() ?>"><div id="elh_t_evaluasifas_kurikulumid" class="t_evaluasifas_kurikulumid"><div class="ew-table-header-caption"><?php echo $t_evaluasifas_grid->kurikulumid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kurikulumid" class="<?php echo $t_evaluasifas_grid->kurikulumid->headerCellClass() ?>"><div><div id="elh_t_evaluasifas_kurikulumid" class="t_evaluasifas_kurikulumid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_evaluasifas_grid->kurikulumid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_evaluasifas_grid->kurikulumid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_evaluasifas_grid->kurikulumid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_evaluasifas_grid->nilai->Visible) { // nilai ?>
	<?php if ($t_evaluasifas_grid->SortUrl($t_evaluasifas_grid->nilai) == "") { ?>
		<th data-name="nilai" class="<?php echo $t_evaluasifas_grid->nilai->headerCellClass() ?>"><div id="elh_t_evaluasifas_nilai" class="t_evaluasifas_nilai"><div class="ew-table-header-caption"><?php echo $t_evaluasifas_grid->nilai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nilai" class="<?php echo $t_evaluasifas_grid->nilai->headerCellClass() ?>"><div><div id="elh_t_evaluasifas_nilai" class="t_evaluasifas_nilai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_evaluasifas_grid->nilai->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_evaluasifas_grid->nilai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_evaluasifas_grid->nilai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_evaluasifas_grid->komentar->Visible) { // komentar ?>
	<?php if ($t_evaluasifas_grid->SortUrl($t_evaluasifas_grid->komentar) == "") { ?>
		<th data-name="komentar" class="<?php echo $t_evaluasifas_grid->komentar->headerCellClass() ?>"><div id="elh_t_evaluasifas_komentar" class="t_evaluasifas_komentar"><div class="ew-table-header-caption"><?php echo $t_evaluasifas_grid->komentar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="komentar" class="<?php echo $t_evaluasifas_grid->komentar->headerCellClass() ?>"><div><div id="elh_t_evaluasifas_komentar" class="t_evaluasifas_komentar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_evaluasifas_grid->komentar->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_evaluasifas_grid->komentar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_evaluasifas_grid->komentar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_evaluasifas_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_evaluasifas_grid->StartRecord = 1;
$t_evaluasifas_grid->StopRecord = $t_evaluasifas_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($t_evaluasifas->isConfirm() || $t_evaluasifas_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_evaluasifas_grid->FormKeyCountName) && ($t_evaluasifas_grid->isGridAdd() || $t_evaluasifas_grid->isGridEdit() || $t_evaluasifas->isConfirm())) {
		$t_evaluasifas_grid->KeyCount = $CurrentForm->getValue($t_evaluasifas_grid->FormKeyCountName);
		$t_evaluasifas_grid->StopRecord = $t_evaluasifas_grid->StartRecord + $t_evaluasifas_grid->KeyCount - 1;
	}
}
$t_evaluasifas_grid->RecordCount = $t_evaluasifas_grid->StartRecord - 1;
if ($t_evaluasifas_grid->Recordset && !$t_evaluasifas_grid->Recordset->EOF) {
	$t_evaluasifas_grid->Recordset->moveFirst();
	$selectLimit = $t_evaluasifas_grid->UseSelectLimit;
	if (!$selectLimit && $t_evaluasifas_grid->StartRecord > 1)
		$t_evaluasifas_grid->Recordset->move($t_evaluasifas_grid->StartRecord - 1);
} elseif (!$t_evaluasifas->AllowAddDeleteRow && $t_evaluasifas_grid->StopRecord == 0) {
	$t_evaluasifas_grid->StopRecord = $t_evaluasifas->GridAddRowCount;
}

// Initialize aggregate
$t_evaluasifas->RowType = ROWTYPE_AGGREGATEINIT;
$t_evaluasifas->resetAttributes();
$t_evaluasifas_grid->renderRow();
if ($t_evaluasifas_grid->isGridAdd())
	$t_evaluasifas_grid->RowIndex = 0;
if ($t_evaluasifas_grid->isGridEdit())
	$t_evaluasifas_grid->RowIndex = 0;
while ($t_evaluasifas_grid->RecordCount < $t_evaluasifas_grid->StopRecord) {
	$t_evaluasifas_grid->RecordCount++;
	if ($t_evaluasifas_grid->RecordCount >= $t_evaluasifas_grid->StartRecord) {
		$t_evaluasifas_grid->RowCount++;
		if ($t_evaluasifas_grid->isGridAdd() || $t_evaluasifas_grid->isGridEdit() || $t_evaluasifas->isConfirm()) {
			$t_evaluasifas_grid->RowIndex++;
			$CurrentForm->Index = $t_evaluasifas_grid->RowIndex;
			if ($CurrentForm->hasValue($t_evaluasifas_grid->FormActionName) && ($t_evaluasifas->isConfirm() || $t_evaluasifas_grid->EventCancelled))
				$t_evaluasifas_grid->RowAction = strval($CurrentForm->getValue($t_evaluasifas_grid->FormActionName));
			elseif ($t_evaluasifas_grid->isGridAdd())
				$t_evaluasifas_grid->RowAction = "insert";
			else
				$t_evaluasifas_grid->RowAction = "";
		}

		// Set up key count
		$t_evaluasifas_grid->KeyCount = $t_evaluasifas_grid->RowIndex;

		// Init row class and style
		$t_evaluasifas->resetAttributes();
		$t_evaluasifas->CssClass = "";
		if ($t_evaluasifas_grid->isGridAdd()) {
			if ($t_evaluasifas->CurrentMode == "copy") {
				$t_evaluasifas_grid->loadRowValues($t_evaluasifas_grid->Recordset); // Load row values
				$t_evaluasifas_grid->setRecordKey($t_evaluasifas_grid->RowOldKey, $t_evaluasifas_grid->Recordset); // Set old record key
			} else {
				$t_evaluasifas_grid->loadRowValues(); // Load default values
				$t_evaluasifas_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_evaluasifas_grid->loadRowValues($t_evaluasifas_grid->Recordset); // Load row values
		}
		$t_evaluasifas->RowType = ROWTYPE_VIEW; // Render view
		if ($t_evaluasifas_grid->isGridAdd()) // Grid add
			$t_evaluasifas->RowType = ROWTYPE_ADD; // Render add
		if ($t_evaluasifas_grid->isGridAdd() && $t_evaluasifas->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_evaluasifas_grid->restoreCurrentRowFormValues($t_evaluasifas_grid->RowIndex); // Restore form values
		if ($t_evaluasifas_grid->isGridEdit()) { // Grid edit
			if ($t_evaluasifas->EventCancelled)
				$t_evaluasifas_grid->restoreCurrentRowFormValues($t_evaluasifas_grid->RowIndex); // Restore form values
			if ($t_evaluasifas_grid->RowAction == "insert")
				$t_evaluasifas->RowType = ROWTYPE_ADD; // Render add
			else
				$t_evaluasifas->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_evaluasifas_grid->isGridEdit() && ($t_evaluasifas->RowType == ROWTYPE_EDIT || $t_evaluasifas->RowType == ROWTYPE_ADD) && $t_evaluasifas->EventCancelled) // Update failed
			$t_evaluasifas_grid->restoreCurrentRowFormValues($t_evaluasifas_grid->RowIndex); // Restore form values
		if ($t_evaluasifas->RowType == ROWTYPE_EDIT) // Edit row
			$t_evaluasifas_grid->EditRowCount++;
		if ($t_evaluasifas->isConfirm()) // Confirm row
			$t_evaluasifas_grid->restoreCurrentRowFormValues($t_evaluasifas_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_evaluasifas->RowAttrs->merge(["data-rowindex" => $t_evaluasifas_grid->RowCount, "id" => "r" . $t_evaluasifas_grid->RowCount . "_t_evaluasifas", "data-rowtype" => $t_evaluasifas->RowType]);

		// Render row
		$t_evaluasifas_grid->renderRow();

		// Render list options
		$t_evaluasifas_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_evaluasifas_grid->RowAction != "delete" && $t_evaluasifas_grid->RowAction != "insertdelete" && !($t_evaluasifas_grid->RowAction == "insert" && $t_evaluasifas->isConfirm() && $t_evaluasifas_grid->emptyRow())) {
?>
	<tr <?php echo $t_evaluasifas->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_evaluasifas_grid->ListOptions->render("body", "left", $t_evaluasifas_grid->RowCount);
?>
	<?php if ($t_evaluasifas_grid->bioid->Visible) { // bioid ?>
		<td data-name="bioid" <?php echo $t_evaluasifas_grid->bioid->cellAttributes() ?>>
<?php if ($t_evaluasifas->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($t_evaluasifas_grid->bioid->getSessionValue() != "") { ?>
<span id="el<?php echo $t_evaluasifas_grid->RowCount ?>_t_evaluasifas_bioid" class="form-group">
<span<?php echo $t_evaluasifas_grid->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_evaluasifas_grid->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_evaluasifas_grid->bioid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_evaluasifas_grid->RowCount ?>_t_evaluasifas_bioid" class="form-group">
<?php
$onchange = $t_evaluasifas_grid->bioid->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_evaluasifas_grid->bioid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid">
	<input type="text" class="form-control" name="sv_x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" id="sv_x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" value="<?php echo RemoveHtml($t_evaluasifas_grid->bioid->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($t_evaluasifas_grid->bioid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_evaluasifas_grid->bioid->getPlaceHolder()) ?>"<?php echo $t_evaluasifas_grid->bioid->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_evaluasifas" data-field="x_bioid" data-value-separator="<?php echo $t_evaluasifas_grid->bioid->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_evaluasifas_grid->bioid->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_evaluasifasgrid"], function() {
	ft_evaluasifasgrid.createAutoSuggest({"id":"x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid","forceSelect":false});
});
</script>
<?php echo $t_evaluasifas_grid->bioid->Lookup->getParamTag($t_evaluasifas_grid, "p_x" . $t_evaluasifas_grid->RowIndex . "_bioid") ?>
</span>
<?php } ?>
<input type="hidden" data-table="t_evaluasifas" data-field="x_bioid" name="o<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" id="o<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_evaluasifas_grid->bioid->OldValue) ?>">
<?php } ?>
<?php if ($t_evaluasifas->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t_evaluasifas_grid->bioid->getSessionValue() != "") { ?>
<span id="el<?php echo $t_evaluasifas_grid->RowCount ?>_t_evaluasifas_bioid" class="form-group">
<span<?php echo $t_evaluasifas_grid->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_evaluasifas_grid->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_evaluasifas_grid->bioid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_evaluasifas_grid->RowCount ?>_t_evaluasifas_bioid" class="form-group">
<?php
$onchange = $t_evaluasifas_grid->bioid->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_evaluasifas_grid->bioid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid">
	<input type="text" class="form-control" name="sv_x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" id="sv_x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" value="<?php echo RemoveHtml($t_evaluasifas_grid->bioid->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($t_evaluasifas_grid->bioid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_evaluasifas_grid->bioid->getPlaceHolder()) ?>"<?php echo $t_evaluasifas_grid->bioid->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_evaluasifas" data-field="x_bioid" data-value-separator="<?php echo $t_evaluasifas_grid->bioid->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_evaluasifas_grid->bioid->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_evaluasifasgrid"], function() {
	ft_evaluasifasgrid.createAutoSuggest({"id":"x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid","forceSelect":false});
});
</script>
<?php echo $t_evaluasifas_grid->bioid->Lookup->getParamTag($t_evaluasifas_grid, "p_x" . $t_evaluasifas_grid->RowIndex . "_bioid") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($t_evaluasifas->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_evaluasifas_grid->RowCount ?>_t_evaluasifas_bioid">
<span<?php echo $t_evaluasifas_grid->bioid->viewAttributes() ?>><?php echo $t_evaluasifas_grid->bioid->getViewValue() ?></span>
</span>
<?php if (!$t_evaluasifas->isConfirm()) { ?>
<input type="hidden" data-table="t_evaluasifas" data-field="x_bioid" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_evaluasifas_grid->bioid->FormValue) ?>">
<input type="hidden" data-table="t_evaluasifas" data-field="x_bioid" name="o<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" id="o<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_evaluasifas_grid->bioid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_evaluasifas" data-field="x_bioid" name="ft_evaluasifasgrid$x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" id="ft_evaluasifasgrid$x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_evaluasifas_grid->bioid->FormValue) ?>">
<input type="hidden" data-table="t_evaluasifas" data-field="x_bioid" name="ft_evaluasifasgrid$o<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" id="ft_evaluasifasgrid$o<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_evaluasifas_grid->bioid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($t_evaluasifas->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t_evaluasifas" data-field="x_evafas_id" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_evafas_id" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_evafas_id" value="<?php echo HtmlEncode($t_evaluasifas_grid->evafas_id->CurrentValue) ?>">
<input type="hidden" data-table="t_evaluasifas" data-field="x_evafas_id" name="o<?php echo $t_evaluasifas_grid->RowIndex ?>_evafas_id" id="o<?php echo $t_evaluasifas_grid->RowIndex ?>_evafas_id" value="<?php echo HtmlEncode($t_evaluasifas_grid->evafas_id->OldValue) ?>">
<?php } ?>
<?php if ($t_evaluasifas->RowType == ROWTYPE_EDIT || $t_evaluasifas->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t_evaluasifas" data-field="x_evafas_id" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_evafas_id" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_evafas_id" value="<?php echo HtmlEncode($t_evaluasifas_grid->evafas_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t_evaluasifas_grid->idpelat->Visible) { // idpelat ?>
		<td data-name="idpelat" <?php echo $t_evaluasifas_grid->idpelat->cellAttributes() ?>>
<?php if ($t_evaluasifas->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($t_evaluasifas_grid->idpelat->getSessionValue() != "") { ?>
<span id="el<?php echo $t_evaluasifas_grid->RowCount ?>_t_evaluasifas_idpelat" class="form-group">
<span<?php echo $t_evaluasifas_grid->idpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_evaluasifas_grid->idpelat->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" value="<?php echo HtmlEncode($t_evaluasifas_grid->idpelat->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_evaluasifas_grid->RowCount ?>_t_evaluasifas_idpelat" class="form-group">
<?php $t_evaluasifas_grid->idpelat->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_evaluasifas" data-field="x_idpelat" data-value-separator="<?php echo $t_evaluasifas_grid->idpelat->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat"<?php echo $t_evaluasifas_grid->idpelat->editAttributes() ?>>
			<?php echo $t_evaluasifas_grid->idpelat->selectOptionListHtml("x{$t_evaluasifas_grid->RowIndex}_idpelat") ?>
		</select>
</div>
<?php echo $t_evaluasifas_grid->idpelat->Lookup->getParamTag($t_evaluasifas_grid, "p_x" . $t_evaluasifas_grid->RowIndex . "_idpelat") ?>
</span>
<?php } ?>
<input type="hidden" data-table="t_evaluasifas" data-field="x_idpelat" name="o<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" id="o<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" value="<?php echo HtmlEncode($t_evaluasifas_grid->idpelat->OldValue) ?>">
<?php } ?>
<?php if ($t_evaluasifas->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t_evaluasifas_grid->idpelat->getSessionValue() != "") { ?>
<span id="el<?php echo $t_evaluasifas_grid->RowCount ?>_t_evaluasifas_idpelat" class="form-group">
<span<?php echo $t_evaluasifas_grid->idpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_evaluasifas_grid->idpelat->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" value="<?php echo HtmlEncode($t_evaluasifas_grid->idpelat->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_evaluasifas_grid->RowCount ?>_t_evaluasifas_idpelat" class="form-group">
<?php $t_evaluasifas_grid->idpelat->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_evaluasifas" data-field="x_idpelat" data-value-separator="<?php echo $t_evaluasifas_grid->idpelat->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat"<?php echo $t_evaluasifas_grid->idpelat->editAttributes() ?>>
			<?php echo $t_evaluasifas_grid->idpelat->selectOptionListHtml("x{$t_evaluasifas_grid->RowIndex}_idpelat") ?>
		</select>
</div>
<?php echo $t_evaluasifas_grid->idpelat->Lookup->getParamTag($t_evaluasifas_grid, "p_x" . $t_evaluasifas_grid->RowIndex . "_idpelat") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($t_evaluasifas->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_evaluasifas_grid->RowCount ?>_t_evaluasifas_idpelat">
<span<?php echo $t_evaluasifas_grid->idpelat->viewAttributes() ?>><?php echo $t_evaluasifas_grid->idpelat->getViewValue() ?></span>
</span>
<?php if (!$t_evaluasifas->isConfirm()) { ?>
<input type="hidden" data-table="t_evaluasifas" data-field="x_idpelat" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" value="<?php echo HtmlEncode($t_evaluasifas_grid->idpelat->FormValue) ?>">
<input type="hidden" data-table="t_evaluasifas" data-field="x_idpelat" name="o<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" id="o<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" value="<?php echo HtmlEncode($t_evaluasifas_grid->idpelat->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_evaluasifas" data-field="x_idpelat" name="ft_evaluasifasgrid$x<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" id="ft_evaluasifasgrid$x<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" value="<?php echo HtmlEncode($t_evaluasifas_grid->idpelat->FormValue) ?>">
<input type="hidden" data-table="t_evaluasifas" data-field="x_idpelat" name="ft_evaluasifasgrid$o<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" id="ft_evaluasifasgrid$o<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" value="<?php echo HtmlEncode($t_evaluasifas_grid->idpelat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_evaluasifas_grid->kurikulumid->Visible) { // kurikulumid ?>
		<td data-name="kurikulumid" <?php echo $t_evaluasifas_grid->kurikulumid->cellAttributes() ?>>
<?php if ($t_evaluasifas->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($t_evaluasifas_grid->kurikulumid->getSessionValue() != "") { ?>
<span id="el<?php echo $t_evaluasifas_grid->RowCount ?>_t_evaluasifas_kurikulumid" class="form-group">
<span<?php echo $t_evaluasifas_grid->kurikulumid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_evaluasifas_grid->kurikulumid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_evaluasifas_grid->kurikulumid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_evaluasifas_grid->RowCount ?>_t_evaluasifas_kurikulumid" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_evaluasifas" data-field="x_kurikulumid" data-value-separator="<?php echo $t_evaluasifas_grid->kurikulumid->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid"<?php echo $t_evaluasifas_grid->kurikulumid->editAttributes() ?>>
			<?php echo $t_evaluasifas_grid->kurikulumid->selectOptionListHtml("x{$t_evaluasifas_grid->RowIndex}_kurikulumid") ?>
		</select>
</div>
<?php echo $t_evaluasifas_grid->kurikulumid->Lookup->getParamTag($t_evaluasifas_grid, "p_x" . $t_evaluasifas_grid->RowIndex . "_kurikulumid") ?>
</span>
<?php } ?>
<input type="hidden" data-table="t_evaluasifas" data-field="x_kurikulumid" name="o<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" id="o<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_evaluasifas_grid->kurikulumid->OldValue) ?>">
<?php } ?>
<?php if ($t_evaluasifas->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t_evaluasifas_grid->kurikulumid->getSessionValue() != "") { ?>
<span id="el<?php echo $t_evaluasifas_grid->RowCount ?>_t_evaluasifas_kurikulumid" class="form-group">
<span<?php echo $t_evaluasifas_grid->kurikulumid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_evaluasifas_grid->kurikulumid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_evaluasifas_grid->kurikulumid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_evaluasifas_grid->RowCount ?>_t_evaluasifas_kurikulumid" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_evaluasifas" data-field="x_kurikulumid" data-value-separator="<?php echo $t_evaluasifas_grid->kurikulumid->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid"<?php echo $t_evaluasifas_grid->kurikulumid->editAttributes() ?>>
			<?php echo $t_evaluasifas_grid->kurikulumid->selectOptionListHtml("x{$t_evaluasifas_grid->RowIndex}_kurikulumid") ?>
		</select>
</div>
<?php echo $t_evaluasifas_grid->kurikulumid->Lookup->getParamTag($t_evaluasifas_grid, "p_x" . $t_evaluasifas_grid->RowIndex . "_kurikulumid") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($t_evaluasifas->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_evaluasifas_grid->RowCount ?>_t_evaluasifas_kurikulumid">
<span<?php echo $t_evaluasifas_grid->kurikulumid->viewAttributes() ?>><?php echo $t_evaluasifas_grid->kurikulumid->getViewValue() ?></span>
</span>
<?php if (!$t_evaluasifas->isConfirm()) { ?>
<input type="hidden" data-table="t_evaluasifas" data-field="x_kurikulumid" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_evaluasifas_grid->kurikulumid->FormValue) ?>">
<input type="hidden" data-table="t_evaluasifas" data-field="x_kurikulumid" name="o<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" id="o<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_evaluasifas_grid->kurikulumid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_evaluasifas" data-field="x_kurikulumid" name="ft_evaluasifasgrid$x<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" id="ft_evaluasifasgrid$x<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_evaluasifas_grid->kurikulumid->FormValue) ?>">
<input type="hidden" data-table="t_evaluasifas" data-field="x_kurikulumid" name="ft_evaluasifasgrid$o<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" id="ft_evaluasifasgrid$o<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_evaluasifas_grid->kurikulumid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_evaluasifas_grid->nilai->Visible) { // nilai ?>
		<td data-name="nilai" <?php echo $t_evaluasifas_grid->nilai->cellAttributes() ?>>
<?php if ($t_evaluasifas->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_evaluasifas_grid->RowCount ?>_t_evaluasifas_nilai" class="form-group">
<input type="text" data-table="t_evaluasifas" data-field="x_nilai" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_nilai" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_nilai" size="4" maxlength="7" placeholder="<?php echo HtmlEncode($t_evaluasifas_grid->nilai->getPlaceHolder()) ?>" value="<?php echo $t_evaluasifas_grid->nilai->EditValue ?>"<?php echo $t_evaluasifas_grid->nilai->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_evaluasifas" data-field="x_nilai" name="o<?php echo $t_evaluasifas_grid->RowIndex ?>_nilai" id="o<?php echo $t_evaluasifas_grid->RowIndex ?>_nilai" value="<?php echo HtmlEncode($t_evaluasifas_grid->nilai->OldValue) ?>">
<?php } ?>
<?php if ($t_evaluasifas->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_evaluasifas_grid->RowCount ?>_t_evaluasifas_nilai" class="form-group">
<input type="text" data-table="t_evaluasifas" data-field="x_nilai" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_nilai" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_nilai" size="4" maxlength="7" placeholder="<?php echo HtmlEncode($t_evaluasifas_grid->nilai->getPlaceHolder()) ?>" value="<?php echo $t_evaluasifas_grid->nilai->EditValue ?>"<?php echo $t_evaluasifas_grid->nilai->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_evaluasifas->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_evaluasifas_grid->RowCount ?>_t_evaluasifas_nilai">
<span<?php echo $t_evaluasifas_grid->nilai->viewAttributes() ?>><?php echo $t_evaluasifas_grid->nilai->getViewValue() ?></span>
</span>
<?php if (!$t_evaluasifas->isConfirm()) { ?>
<input type="hidden" data-table="t_evaluasifas" data-field="x_nilai" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_nilai" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_nilai" value="<?php echo HtmlEncode($t_evaluasifas_grid->nilai->FormValue) ?>">
<input type="hidden" data-table="t_evaluasifas" data-field="x_nilai" name="o<?php echo $t_evaluasifas_grid->RowIndex ?>_nilai" id="o<?php echo $t_evaluasifas_grid->RowIndex ?>_nilai" value="<?php echo HtmlEncode($t_evaluasifas_grid->nilai->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_evaluasifas" data-field="x_nilai" name="ft_evaluasifasgrid$x<?php echo $t_evaluasifas_grid->RowIndex ?>_nilai" id="ft_evaluasifasgrid$x<?php echo $t_evaluasifas_grid->RowIndex ?>_nilai" value="<?php echo HtmlEncode($t_evaluasifas_grid->nilai->FormValue) ?>">
<input type="hidden" data-table="t_evaluasifas" data-field="x_nilai" name="ft_evaluasifasgrid$o<?php echo $t_evaluasifas_grid->RowIndex ?>_nilai" id="ft_evaluasifasgrid$o<?php echo $t_evaluasifas_grid->RowIndex ?>_nilai" value="<?php echo HtmlEncode($t_evaluasifas_grid->nilai->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_evaluasifas_grid->komentar->Visible) { // komentar ?>
		<td data-name="komentar" <?php echo $t_evaluasifas_grid->komentar->cellAttributes() ?>>
<?php if ($t_evaluasifas->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_evaluasifas_grid->RowCount ?>_t_evaluasifas_komentar" class="form-group">
<textarea data-table="t_evaluasifas" data-field="x_komentar" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_komentar" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_komentar" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_evaluasifas_grid->komentar->getPlaceHolder()) ?>"<?php echo $t_evaluasifas_grid->komentar->editAttributes() ?>><?php echo $t_evaluasifas_grid->komentar->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t_evaluasifas" data-field="x_komentar" name="o<?php echo $t_evaluasifas_grid->RowIndex ?>_komentar" id="o<?php echo $t_evaluasifas_grid->RowIndex ?>_komentar" value="<?php echo HtmlEncode($t_evaluasifas_grid->komentar->OldValue) ?>">
<?php } ?>
<?php if ($t_evaluasifas->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_evaluasifas_grid->RowCount ?>_t_evaluasifas_komentar" class="form-group">
<textarea data-table="t_evaluasifas" data-field="x_komentar" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_komentar" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_komentar" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_evaluasifas_grid->komentar->getPlaceHolder()) ?>"<?php echo $t_evaluasifas_grid->komentar->editAttributes() ?>><?php echo $t_evaluasifas_grid->komentar->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t_evaluasifas->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_evaluasifas_grid->RowCount ?>_t_evaluasifas_komentar">
<span<?php echo $t_evaluasifas_grid->komentar->viewAttributes() ?>><?php echo $t_evaluasifas_grid->komentar->getViewValue() ?></span>
</span>
<?php if (!$t_evaluasifas->isConfirm()) { ?>
<input type="hidden" data-table="t_evaluasifas" data-field="x_komentar" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_komentar" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_komentar" value="<?php echo HtmlEncode($t_evaluasifas_grid->komentar->FormValue) ?>">
<input type="hidden" data-table="t_evaluasifas" data-field="x_komentar" name="o<?php echo $t_evaluasifas_grid->RowIndex ?>_komentar" id="o<?php echo $t_evaluasifas_grid->RowIndex ?>_komentar" value="<?php echo HtmlEncode($t_evaluasifas_grid->komentar->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_evaluasifas" data-field="x_komentar" name="ft_evaluasifasgrid$x<?php echo $t_evaluasifas_grid->RowIndex ?>_komentar" id="ft_evaluasifasgrid$x<?php echo $t_evaluasifas_grid->RowIndex ?>_komentar" value="<?php echo HtmlEncode($t_evaluasifas_grid->komentar->FormValue) ?>">
<input type="hidden" data-table="t_evaluasifas" data-field="x_komentar" name="ft_evaluasifasgrid$o<?php echo $t_evaluasifas_grid->RowIndex ?>_komentar" id="ft_evaluasifasgrid$o<?php echo $t_evaluasifas_grid->RowIndex ?>_komentar" value="<?php echo HtmlEncode($t_evaluasifas_grid->komentar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_evaluasifas_grid->ListOptions->render("body", "right", $t_evaluasifas_grid->RowCount);
?>
	</tr>
<?php if ($t_evaluasifas->RowType == ROWTYPE_ADD || $t_evaluasifas->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_evaluasifasgrid", "load"], function() {
	ft_evaluasifasgrid.updateLists(<?php echo $t_evaluasifas_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_evaluasifas_grid->isGridAdd() || $t_evaluasifas->CurrentMode == "copy")
		if (!$t_evaluasifas_grid->Recordset->EOF)
			$t_evaluasifas_grid->Recordset->moveNext();
}
?>
<?php
	if ($t_evaluasifas->CurrentMode == "add" || $t_evaluasifas->CurrentMode == "copy" || $t_evaluasifas->CurrentMode == "edit") {
		$t_evaluasifas_grid->RowIndex = '$rowindex$';
		$t_evaluasifas_grid->loadRowValues();

		// Set row properties
		$t_evaluasifas->resetAttributes();
		$t_evaluasifas->RowAttrs->merge(["data-rowindex" => $t_evaluasifas_grid->RowIndex, "id" => "r0_t_evaluasifas", "data-rowtype" => ROWTYPE_ADD]);
		$t_evaluasifas->RowAttrs->appendClass("ew-template");
		$t_evaluasifas->RowType = ROWTYPE_ADD;

		// Render row
		$t_evaluasifas_grid->renderRow();

		// Render list options
		$t_evaluasifas_grid->renderListOptions();
		$t_evaluasifas_grid->StartRowCount = 0;
?>
	<tr <?php echo $t_evaluasifas->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_evaluasifas_grid->ListOptions->render("body", "left", $t_evaluasifas_grid->RowIndex);
?>
	<?php if ($t_evaluasifas_grid->bioid->Visible) { // bioid ?>
		<td data-name="bioid">
<?php if (!$t_evaluasifas->isConfirm()) { ?>
<?php if ($t_evaluasifas_grid->bioid->getSessionValue() != "") { ?>
<span id="el$rowindex$_t_evaluasifas_bioid" class="form-group t_evaluasifas_bioid">
<span<?php echo $t_evaluasifas_grid->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_evaluasifas_grid->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_evaluasifas_grid->bioid->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_evaluasifas_bioid" class="form-group t_evaluasifas_bioid">
<?php
$onchange = $t_evaluasifas_grid->bioid->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_evaluasifas_grid->bioid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid">
	<input type="text" class="form-control" name="sv_x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" id="sv_x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" value="<?php echo RemoveHtml($t_evaluasifas_grid->bioid->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($t_evaluasifas_grid->bioid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_evaluasifas_grid->bioid->getPlaceHolder()) ?>"<?php echo $t_evaluasifas_grid->bioid->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_evaluasifas" data-field="x_bioid" data-value-separator="<?php echo $t_evaluasifas_grid->bioid->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_evaluasifas_grid->bioid->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_evaluasifasgrid"], function() {
	ft_evaluasifasgrid.createAutoSuggest({"id":"x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid","forceSelect":false});
});
</script>
<?php echo $t_evaluasifas_grid->bioid->Lookup->getParamTag($t_evaluasifas_grid, "p_x" . $t_evaluasifas_grid->RowIndex . "_bioid") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t_evaluasifas_bioid" class="form-group t_evaluasifas_bioid">
<span<?php echo $t_evaluasifas_grid->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_evaluasifas_grid->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_evaluasifas" data-field="x_bioid" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_evaluasifas_grid->bioid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_evaluasifas" data-field="x_bioid" name="o<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" id="o<?php echo $t_evaluasifas_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_evaluasifas_grid->bioid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_evaluasifas_grid->idpelat->Visible) { // idpelat ?>
		<td data-name="idpelat">
<?php if (!$t_evaluasifas->isConfirm()) { ?>
<?php if ($t_evaluasifas_grid->idpelat->getSessionValue() != "") { ?>
<span id="el$rowindex$_t_evaluasifas_idpelat" class="form-group t_evaluasifas_idpelat">
<span<?php echo $t_evaluasifas_grid->idpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_evaluasifas_grid->idpelat->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" value="<?php echo HtmlEncode($t_evaluasifas_grid->idpelat->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_evaluasifas_idpelat" class="form-group t_evaluasifas_idpelat">
<?php $t_evaluasifas_grid->idpelat->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_evaluasifas" data-field="x_idpelat" data-value-separator="<?php echo $t_evaluasifas_grid->idpelat->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat"<?php echo $t_evaluasifas_grid->idpelat->editAttributes() ?>>
			<?php echo $t_evaluasifas_grid->idpelat->selectOptionListHtml("x{$t_evaluasifas_grid->RowIndex}_idpelat") ?>
		</select>
</div>
<?php echo $t_evaluasifas_grid->idpelat->Lookup->getParamTag($t_evaluasifas_grid, "p_x" . $t_evaluasifas_grid->RowIndex . "_idpelat") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t_evaluasifas_idpelat" class="form-group t_evaluasifas_idpelat">
<span<?php echo $t_evaluasifas_grid->idpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_evaluasifas_grid->idpelat->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_evaluasifas" data-field="x_idpelat" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" value="<?php echo HtmlEncode($t_evaluasifas_grid->idpelat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_evaluasifas" data-field="x_idpelat" name="o<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" id="o<?php echo $t_evaluasifas_grid->RowIndex ?>_idpelat" value="<?php echo HtmlEncode($t_evaluasifas_grid->idpelat->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_evaluasifas_grid->kurikulumid->Visible) { // kurikulumid ?>
		<td data-name="kurikulumid">
<?php if (!$t_evaluasifas->isConfirm()) { ?>
<?php if ($t_evaluasifas_grid->kurikulumid->getSessionValue() != "") { ?>
<span id="el$rowindex$_t_evaluasifas_kurikulumid" class="form-group t_evaluasifas_kurikulumid">
<span<?php echo $t_evaluasifas_grid->kurikulumid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_evaluasifas_grid->kurikulumid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_evaluasifas_grid->kurikulumid->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_evaluasifas_kurikulumid" class="form-group t_evaluasifas_kurikulumid">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_evaluasifas" data-field="x_kurikulumid" data-value-separator="<?php echo $t_evaluasifas_grid->kurikulumid->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid"<?php echo $t_evaluasifas_grid->kurikulumid->editAttributes() ?>>
			<?php echo $t_evaluasifas_grid->kurikulumid->selectOptionListHtml("x{$t_evaluasifas_grid->RowIndex}_kurikulumid") ?>
		</select>
</div>
<?php echo $t_evaluasifas_grid->kurikulumid->Lookup->getParamTag($t_evaluasifas_grid, "p_x" . $t_evaluasifas_grid->RowIndex . "_kurikulumid") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t_evaluasifas_kurikulumid" class="form-group t_evaluasifas_kurikulumid">
<span<?php echo $t_evaluasifas_grid->kurikulumid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_evaluasifas_grid->kurikulumid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_evaluasifas" data-field="x_kurikulumid" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_evaluasifas_grid->kurikulumid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_evaluasifas" data-field="x_kurikulumid" name="o<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" id="o<?php echo $t_evaluasifas_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_evaluasifas_grid->kurikulumid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_evaluasifas_grid->nilai->Visible) { // nilai ?>
		<td data-name="nilai">
<?php if (!$t_evaluasifas->isConfirm()) { ?>
<span id="el$rowindex$_t_evaluasifas_nilai" class="form-group t_evaluasifas_nilai">
<input type="text" data-table="t_evaluasifas" data-field="x_nilai" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_nilai" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_nilai" size="4" maxlength="7" placeholder="<?php echo HtmlEncode($t_evaluasifas_grid->nilai->getPlaceHolder()) ?>" value="<?php echo $t_evaluasifas_grid->nilai->EditValue ?>"<?php echo $t_evaluasifas_grid->nilai->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_evaluasifas_nilai" class="form-group t_evaluasifas_nilai">
<span<?php echo $t_evaluasifas_grid->nilai->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_evaluasifas_grid->nilai->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_evaluasifas" data-field="x_nilai" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_nilai" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_nilai" value="<?php echo HtmlEncode($t_evaluasifas_grid->nilai->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_evaluasifas" data-field="x_nilai" name="o<?php echo $t_evaluasifas_grid->RowIndex ?>_nilai" id="o<?php echo $t_evaluasifas_grid->RowIndex ?>_nilai" value="<?php echo HtmlEncode($t_evaluasifas_grid->nilai->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_evaluasifas_grid->komentar->Visible) { // komentar ?>
		<td data-name="komentar">
<?php if (!$t_evaluasifas->isConfirm()) { ?>
<span id="el$rowindex$_t_evaluasifas_komentar" class="form-group t_evaluasifas_komentar">
<textarea data-table="t_evaluasifas" data-field="x_komentar" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_komentar" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_komentar" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_evaluasifas_grid->komentar->getPlaceHolder()) ?>"<?php echo $t_evaluasifas_grid->komentar->editAttributes() ?>><?php echo $t_evaluasifas_grid->komentar->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_evaluasifas_komentar" class="form-group t_evaluasifas_komentar">
<span<?php echo $t_evaluasifas_grid->komentar->viewAttributes() ?>><?php echo $t_evaluasifas_grid->komentar->ViewValue ?></span>
</span>
<input type="hidden" data-table="t_evaluasifas" data-field="x_komentar" name="x<?php echo $t_evaluasifas_grid->RowIndex ?>_komentar" id="x<?php echo $t_evaluasifas_grid->RowIndex ?>_komentar" value="<?php echo HtmlEncode($t_evaluasifas_grid->komentar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_evaluasifas" data-field="x_komentar" name="o<?php echo $t_evaluasifas_grid->RowIndex ?>_komentar" id="o<?php echo $t_evaluasifas_grid->RowIndex ?>_komentar" value="<?php echo HtmlEncode($t_evaluasifas_grid->komentar->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_evaluasifas_grid->ListOptions->render("body", "right", $t_evaluasifas_grid->RowIndex);
?>
<script>
loadjs.ready(["ft_evaluasifasgrid", "load"], function() {
	ft_evaluasifasgrid.updateLists(<?php echo $t_evaluasifas_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($t_evaluasifas->CurrentMode == "add" || $t_evaluasifas->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $t_evaluasifas_grid->FormKeyCountName ?>" id="<?php echo $t_evaluasifas_grid->FormKeyCountName ?>" value="<?php echo $t_evaluasifas_grid->KeyCount ?>">
<?php echo $t_evaluasifas_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_evaluasifas->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $t_evaluasifas_grid->FormKeyCountName ?>" id="<?php echo $t_evaluasifas_grid->FormKeyCountName ?>" value="<?php echo $t_evaluasifas_grid->KeyCount ?>">
<?php echo $t_evaluasifas_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_evaluasifas->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_evaluasifasgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_evaluasifas_grid->Recordset)
	$t_evaluasifas_grid->Recordset->Close();
?>
<?php if ($t_evaluasifas_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $t_evaluasifas_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_evaluasifas_grid->TotalRecords == 0 && !$t_evaluasifas->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_evaluasifas_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$t_evaluasifas_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$t_evaluasifas_grid->terminate();
?>