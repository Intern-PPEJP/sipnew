<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($t_kurikulum_grid))
	$t_kurikulum_grid = new t_kurikulum_grid();

// Run the page
$t_kurikulum_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_kurikulum_grid->Page_Render();
?>
<?php if (!$t_kurikulum_grid->isExport()) { ?>
<script>
var ft_kurikulumgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	ft_kurikulumgrid = new ew.Form("ft_kurikulumgrid", "grid");
	ft_kurikulumgrid.formKeyCountName = '<?php echo $t_kurikulum_grid->FormKeyCountName ?>';

	// Validate form
	ft_kurikulumgrid.validate = function() {
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
			<?php if ($t_kurikulum_grid->kdkursil->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkursil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kurikulum_grid->kdkursil->caption(), $t_kurikulum_grid->kdkursil->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_kurikulum_grid->hari->Required) { ?>
				elm = this.getElements("x" + infix + "_hari");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kurikulum_grid->hari->caption(), $t_kurikulum_grid->hari->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_kurikulum_grid->kurikulum->Required) { ?>
				elm = this.getElements("x" + infix + "_kurikulum");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kurikulum_grid->kurikulum->caption(), $t_kurikulum_grid->kurikulum->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_kurikulum_grid->silabus->Required) { ?>
				elm = this.getElements("x" + infix + "_silabus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kurikulum_grid->silabus->caption(), $t_kurikulum_grid->silabus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_kurikulum_grid->tujuan_instruksional->Required) { ?>
				elm = this.getElements("x" + infix + "_tujuan_instruksional");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kurikulum_grid->tujuan_instruksional->caption(), $t_kurikulum_grid->tujuan_instruksional->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_kurikulum_grid->sesi->Required) { ?>
				elm = this.getElements("x" + infix + "_sesi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kurikulum_grid->sesi->caption(), $t_kurikulum_grid->sesi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sesi");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kurikulum_grid->sesi->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	ft_kurikulumgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "kdkursil", false)) return false;
		if (ew.valueChanged(fobj, infix, "hari", false)) return false;
		if (ew.valueChanged(fobj, infix, "kurikulum", false)) return false;
		if (ew.valueChanged(fobj, infix, "silabus", false)) return false;
		if (ew.valueChanged(fobj, infix, "tujuan_instruksional", false)) return false;
		if (ew.valueChanged(fobj, infix, "sesi", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_kurikulumgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_kurikulumgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_kurikulumgrid.lists["x_hari"] = <?php echo $t_kurikulum_grid->hari->Lookup->toClientList($t_kurikulum_grid) ?>;
	ft_kurikulumgrid.lists["x_hari"].options = <?php echo JsonEncode($t_kurikulum_grid->hari->lookupOptions()) ?>;
	loadjs.done("ft_kurikulumgrid");
});
</script>
<?php } ?>
<?php
$t_kurikulum_grid->renderOtherOptions();
?>
<?php if ($t_kurikulum_grid->TotalRecords > 0 || $t_kurikulum->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_kurikulum_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_kurikulum">
<?php if ($t_kurikulum_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $t_kurikulum_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ft_kurikulumgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_t_kurikulum" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_t_kurikulumgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_kurikulum->RowType = ROWTYPE_HEADER;

// Render list options
$t_kurikulum_grid->renderListOptions();

// Render list options (header, left)
$t_kurikulum_grid->ListOptions->render("header", "left");
?>
<?php if ($t_kurikulum_grid->kdkursil->Visible) { // kdkursil ?>
	<?php if ($t_kurikulum_grid->SortUrl($t_kurikulum_grid->kdkursil) == "") { ?>
		<th data-name="kdkursil" class="<?php echo $t_kurikulum_grid->kdkursil->headerCellClass() ?>"><div id="elh_t_kurikulum_kdkursil" class="t_kurikulum_kdkursil"><div class="ew-table-header-caption"><?php echo $t_kurikulum_grid->kdkursil->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkursil" class="<?php echo $t_kurikulum_grid->kdkursil->headerCellClass() ?>"><div><div id="elh_t_kurikulum_kdkursil" class="t_kurikulum_kdkursil">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kurikulum_grid->kdkursil->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kurikulum_grid->kdkursil->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kurikulum_grid->kdkursil->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kurikulum_grid->hari->Visible) { // hari ?>
	<?php if ($t_kurikulum_grid->SortUrl($t_kurikulum_grid->hari) == "") { ?>
		<th data-name="hari" class="<?php echo $t_kurikulum_grid->hari->headerCellClass() ?>"><div id="elh_t_kurikulum_hari" class="t_kurikulum_hari"><div class="ew-table-header-caption"><?php echo $t_kurikulum_grid->hari->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hari" class="<?php echo $t_kurikulum_grid->hari->headerCellClass() ?>"><div><div id="elh_t_kurikulum_hari" class="t_kurikulum_hari">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kurikulum_grid->hari->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kurikulum_grid->hari->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kurikulum_grid->hari->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kurikulum_grid->kurikulum->Visible) { // kurikulum ?>
	<?php if ($t_kurikulum_grid->SortUrl($t_kurikulum_grid->kurikulum) == "") { ?>
		<th data-name="kurikulum" class="<?php echo $t_kurikulum_grid->kurikulum->headerCellClass() ?>"><div id="elh_t_kurikulum_kurikulum" class="t_kurikulum_kurikulum"><div class="ew-table-header-caption"><?php echo $t_kurikulum_grid->kurikulum->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kurikulum" class="<?php echo $t_kurikulum_grid->kurikulum->headerCellClass() ?>"><div><div id="elh_t_kurikulum_kurikulum" class="t_kurikulum_kurikulum">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kurikulum_grid->kurikulum->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kurikulum_grid->kurikulum->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kurikulum_grid->kurikulum->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kurikulum_grid->silabus->Visible) { // silabus ?>
	<?php if ($t_kurikulum_grid->SortUrl($t_kurikulum_grid->silabus) == "") { ?>
		<th data-name="silabus" class="<?php echo $t_kurikulum_grid->silabus->headerCellClass() ?>"><div id="elh_t_kurikulum_silabus" class="t_kurikulum_silabus"><div class="ew-table-header-caption"><?php echo $t_kurikulum_grid->silabus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="silabus" class="<?php echo $t_kurikulum_grid->silabus->headerCellClass() ?>"><div><div id="elh_t_kurikulum_silabus" class="t_kurikulum_silabus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kurikulum_grid->silabus->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kurikulum_grid->silabus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kurikulum_grid->silabus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kurikulum_grid->tujuan_instruksional->Visible) { // tujuan_instruksional ?>
	<?php if ($t_kurikulum_grid->SortUrl($t_kurikulum_grid->tujuan_instruksional) == "") { ?>
		<th data-name="tujuan_instruksional" class="<?php echo $t_kurikulum_grid->tujuan_instruksional->headerCellClass() ?>"><div id="elh_t_kurikulum_tujuan_instruksional" class="t_kurikulum_tujuan_instruksional"><div class="ew-table-header-caption"><?php echo $t_kurikulum_grid->tujuan_instruksional->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tujuan_instruksional" class="<?php echo $t_kurikulum_grid->tujuan_instruksional->headerCellClass() ?>"><div><div id="elh_t_kurikulum_tujuan_instruksional" class="t_kurikulum_tujuan_instruksional">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kurikulum_grid->tujuan_instruksional->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kurikulum_grid->tujuan_instruksional->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kurikulum_grid->tujuan_instruksional->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kurikulum_grid->sesi->Visible) { // sesi ?>
	<?php if ($t_kurikulum_grid->SortUrl($t_kurikulum_grid->sesi) == "") { ?>
		<th data-name="sesi" class="<?php echo $t_kurikulum_grid->sesi->headerCellClass() ?>"><div id="elh_t_kurikulum_sesi" class="t_kurikulum_sesi"><div class="ew-table-header-caption"><?php echo $t_kurikulum_grid->sesi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sesi" class="<?php echo $t_kurikulum_grid->sesi->headerCellClass() ?>"><div><div id="elh_t_kurikulum_sesi" class="t_kurikulum_sesi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kurikulum_grid->sesi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kurikulum_grid->sesi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kurikulum_grid->sesi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_kurikulum_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_kurikulum_grid->StartRecord = 1;
$t_kurikulum_grid->StopRecord = $t_kurikulum_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($t_kurikulum->isConfirm() || $t_kurikulum_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_kurikulum_grid->FormKeyCountName) && ($t_kurikulum_grid->isGridAdd() || $t_kurikulum_grid->isGridEdit() || $t_kurikulum->isConfirm())) {
		$t_kurikulum_grid->KeyCount = $CurrentForm->getValue($t_kurikulum_grid->FormKeyCountName);
		$t_kurikulum_grid->StopRecord = $t_kurikulum_grid->StartRecord + $t_kurikulum_grid->KeyCount - 1;
	}
}
$t_kurikulum_grid->RecordCount = $t_kurikulum_grid->StartRecord - 1;
if ($t_kurikulum_grid->Recordset && !$t_kurikulum_grid->Recordset->EOF) {
	$t_kurikulum_grid->Recordset->moveFirst();
	$selectLimit = $t_kurikulum_grid->UseSelectLimit;
	if (!$selectLimit && $t_kurikulum_grid->StartRecord > 1)
		$t_kurikulum_grid->Recordset->move($t_kurikulum_grid->StartRecord - 1);
} elseif (!$t_kurikulum->AllowAddDeleteRow && $t_kurikulum_grid->StopRecord == 0) {
	$t_kurikulum_grid->StopRecord = $t_kurikulum->GridAddRowCount;
}

// Initialize aggregate
$t_kurikulum->RowType = ROWTYPE_AGGREGATEINIT;
$t_kurikulum->resetAttributes();
$t_kurikulum_grid->renderRow();
if ($t_kurikulum_grid->isGridAdd())
	$t_kurikulum_grid->RowIndex = 0;
if ($t_kurikulum_grid->isGridEdit())
	$t_kurikulum_grid->RowIndex = 0;
while ($t_kurikulum_grid->RecordCount < $t_kurikulum_grid->StopRecord) {
	$t_kurikulum_grid->RecordCount++;
	if ($t_kurikulum_grid->RecordCount >= $t_kurikulum_grid->StartRecord) {
		$t_kurikulum_grid->RowCount++;
		if ($t_kurikulum_grid->isGridAdd() || $t_kurikulum_grid->isGridEdit() || $t_kurikulum->isConfirm()) {
			$t_kurikulum_grid->RowIndex++;
			$CurrentForm->Index = $t_kurikulum_grid->RowIndex;
			if ($CurrentForm->hasValue($t_kurikulum_grid->FormActionName) && ($t_kurikulum->isConfirm() || $t_kurikulum_grid->EventCancelled))
				$t_kurikulum_grid->RowAction = strval($CurrentForm->getValue($t_kurikulum_grid->FormActionName));
			elseif ($t_kurikulum_grid->isGridAdd())
				$t_kurikulum_grid->RowAction = "insert";
			else
				$t_kurikulum_grid->RowAction = "";
		}

		// Set up key count
		$t_kurikulum_grid->KeyCount = $t_kurikulum_grid->RowIndex;

		// Init row class and style
		$t_kurikulum->resetAttributes();
		$t_kurikulum->CssClass = "";
		if ($t_kurikulum_grid->isGridAdd()) {
			if ($t_kurikulum->CurrentMode == "copy") {
				$t_kurikulum_grid->loadRowValues($t_kurikulum_grid->Recordset); // Load row values
				$t_kurikulum_grid->setRecordKey($t_kurikulum_grid->RowOldKey, $t_kurikulum_grid->Recordset); // Set old record key
			} else {
				$t_kurikulum_grid->loadRowValues(); // Load default values
				$t_kurikulum_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_kurikulum_grid->loadRowValues($t_kurikulum_grid->Recordset); // Load row values
		}
		$t_kurikulum->RowType = ROWTYPE_VIEW; // Render view
		if ($t_kurikulum_grid->isGridAdd()) // Grid add
			$t_kurikulum->RowType = ROWTYPE_ADD; // Render add
		if ($t_kurikulum_grid->isGridAdd() && $t_kurikulum->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_kurikulum_grid->restoreCurrentRowFormValues($t_kurikulum_grid->RowIndex); // Restore form values
		if ($t_kurikulum_grid->isGridEdit()) { // Grid edit
			if ($t_kurikulum->EventCancelled)
				$t_kurikulum_grid->restoreCurrentRowFormValues($t_kurikulum_grid->RowIndex); // Restore form values
			if ($t_kurikulum_grid->RowAction == "insert")
				$t_kurikulum->RowType = ROWTYPE_ADD; // Render add
			else
				$t_kurikulum->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_kurikulum_grid->isGridEdit() && ($t_kurikulum->RowType == ROWTYPE_EDIT || $t_kurikulum->RowType == ROWTYPE_ADD) && $t_kurikulum->EventCancelled) // Update failed
			$t_kurikulum_grid->restoreCurrentRowFormValues($t_kurikulum_grid->RowIndex); // Restore form values
		if ($t_kurikulum->RowType == ROWTYPE_EDIT) // Edit row
			$t_kurikulum_grid->EditRowCount++;
		if ($t_kurikulum->isConfirm()) // Confirm row
			$t_kurikulum_grid->restoreCurrentRowFormValues($t_kurikulum_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_kurikulum->RowAttrs->merge(["data-rowindex" => $t_kurikulum_grid->RowCount, "id" => "r" . $t_kurikulum_grid->RowCount . "_t_kurikulum", "data-rowtype" => $t_kurikulum->RowType]);

		// Render row
		$t_kurikulum_grid->renderRow();

		// Render list options
		$t_kurikulum_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_kurikulum_grid->RowAction != "delete" && $t_kurikulum_grid->RowAction != "insertdelete" && !($t_kurikulum_grid->RowAction == "insert" && $t_kurikulum->isConfirm() && $t_kurikulum_grid->emptyRow())) {
?>
	<tr <?php echo $t_kurikulum->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_kurikulum_grid->ListOptions->render("body", "left", $t_kurikulum_grid->RowCount);
?>
	<?php if ($t_kurikulum_grid->kdkursil->Visible) { // kdkursil ?>
		<td data-name="kdkursil" <?php echo $t_kurikulum_grid->kdkursil->cellAttributes() ?>>
<?php if ($t_kurikulum->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($t_kurikulum_grid->kdkursil->getSessionValue() != "") { ?>
<span id="el<?php echo $t_kurikulum_grid->RowCount ?>_t_kurikulum_kdkursil" class="form-group">
<span<?php echo $t_kurikulum_grid->kdkursil->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_kurikulum_grid->kdkursil->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_kurikulum_grid->kdkursil->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_kurikulum_grid->RowCount ?>_t_kurikulum_kdkursil" class="form-group">
<input type="text" data-table="t_kurikulum" data-field="x_kdkursil" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" size="12" maxlength="12" placeholder="<?php echo HtmlEncode($t_kurikulum_grid->kdkursil->getPlaceHolder()) ?>" value="<?php echo $t_kurikulum_grid->kdkursil->EditValue ?>"<?php echo $t_kurikulum_grid->kdkursil->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="t_kurikulum" data-field="x_kdkursil" name="o<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" id="o<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_kurikulum_grid->kdkursil->OldValue) ?>">
<?php } ?>
<?php if ($t_kurikulum->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_kurikulum_grid->RowCount ?>_t_kurikulum_kdkursil" class="form-group">
<span<?php echo $t_kurikulum_grid->kdkursil->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_kurikulum_grid->kdkursil->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_kurikulum" data-field="x_kdkursil" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_kurikulum_grid->kdkursil->CurrentValue) ?>">
<?php } ?>
<?php if ($t_kurikulum->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_kurikulum_grid->RowCount ?>_t_kurikulum_kdkursil">
<span<?php echo $t_kurikulum_grid->kdkursil->viewAttributes() ?>><?php echo $t_kurikulum_grid->kdkursil->getViewValue() ?></span>
</span>
<?php if (!$t_kurikulum->isConfirm()) { ?>
<input type="hidden" data-table="t_kurikulum" data-field="x_kdkursil" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_kurikulum_grid->kdkursil->FormValue) ?>">
<input type="hidden" data-table="t_kurikulum" data-field="x_kdkursil" name="o<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" id="o<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_kurikulum_grid->kdkursil->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_kurikulum" data-field="x_kdkursil" name="ft_kurikulumgrid$x<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" id="ft_kurikulumgrid$x<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_kurikulum_grid->kdkursil->FormValue) ?>">
<input type="hidden" data-table="t_kurikulum" data-field="x_kdkursil" name="ft_kurikulumgrid$o<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" id="ft_kurikulumgrid$o<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_kurikulum_grid->kdkursil->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($t_kurikulum->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t_kurikulum" data-field="x_kurikulumid" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulumid" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_kurikulum_grid->kurikulumid->CurrentValue) ?>">
<input type="hidden" data-table="t_kurikulum" data-field="x_kurikulumid" name="o<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulumid" id="o<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_kurikulum_grid->kurikulumid->OldValue) ?>">
<?php } ?>
<?php if ($t_kurikulum->RowType == ROWTYPE_EDIT || $t_kurikulum->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t_kurikulum" data-field="x_kurikulumid" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulumid" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulumid" value="<?php echo HtmlEncode($t_kurikulum_grid->kurikulumid->CurrentValue) ?>">
<?php } ?>
	<?php if ($t_kurikulum_grid->hari->Visible) { // hari ?>
		<td data-name="hari" <?php echo $t_kurikulum_grid->hari->cellAttributes() ?>>
<?php if ($t_kurikulum->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_kurikulum_grid->RowCount ?>_t_kurikulum_hari" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_kurikulum" data-field="x_hari" data-value-separator="<?php echo $t_kurikulum_grid->hari->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_hari" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_hari"<?php echo $t_kurikulum_grid->hari->editAttributes() ?>>
			<?php echo $t_kurikulum_grid->hari->selectOptionListHtml("x{$t_kurikulum_grid->RowIndex}_hari") ?>
		</select>
</div>
<?php echo $t_kurikulum_grid->hari->Lookup->getParamTag($t_kurikulum_grid, "p_x" . $t_kurikulum_grid->RowIndex . "_hari") ?>
</span>
<input type="hidden" data-table="t_kurikulum" data-field="x_hari" name="o<?php echo $t_kurikulum_grid->RowIndex ?>_hari" id="o<?php echo $t_kurikulum_grid->RowIndex ?>_hari" value="<?php echo HtmlEncode($t_kurikulum_grid->hari->OldValue) ?>">
<?php } ?>
<?php if ($t_kurikulum->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_kurikulum_grid->RowCount ?>_t_kurikulum_hari" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_kurikulum" data-field="x_hari" data-value-separator="<?php echo $t_kurikulum_grid->hari->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_hari" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_hari"<?php echo $t_kurikulum_grid->hari->editAttributes() ?>>
			<?php echo $t_kurikulum_grid->hari->selectOptionListHtml("x{$t_kurikulum_grid->RowIndex}_hari") ?>
		</select>
</div>
<?php echo $t_kurikulum_grid->hari->Lookup->getParamTag($t_kurikulum_grid, "p_x" . $t_kurikulum_grid->RowIndex . "_hari") ?>
</span>
<?php } ?>
<?php if ($t_kurikulum->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_kurikulum_grid->RowCount ?>_t_kurikulum_hari">
<span<?php echo $t_kurikulum_grid->hari->viewAttributes() ?>><?php echo $t_kurikulum_grid->hari->getViewValue() ?></span>
</span>
<?php if (!$t_kurikulum->isConfirm()) { ?>
<input type="hidden" data-table="t_kurikulum" data-field="x_hari" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_hari" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_hari" value="<?php echo HtmlEncode($t_kurikulum_grid->hari->FormValue) ?>">
<input type="hidden" data-table="t_kurikulum" data-field="x_hari" name="o<?php echo $t_kurikulum_grid->RowIndex ?>_hari" id="o<?php echo $t_kurikulum_grid->RowIndex ?>_hari" value="<?php echo HtmlEncode($t_kurikulum_grid->hari->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_kurikulum" data-field="x_hari" name="ft_kurikulumgrid$x<?php echo $t_kurikulum_grid->RowIndex ?>_hari" id="ft_kurikulumgrid$x<?php echo $t_kurikulum_grid->RowIndex ?>_hari" value="<?php echo HtmlEncode($t_kurikulum_grid->hari->FormValue) ?>">
<input type="hidden" data-table="t_kurikulum" data-field="x_hari" name="ft_kurikulumgrid$o<?php echo $t_kurikulum_grid->RowIndex ?>_hari" id="ft_kurikulumgrid$o<?php echo $t_kurikulum_grid->RowIndex ?>_hari" value="<?php echo HtmlEncode($t_kurikulum_grid->hari->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_kurikulum_grid->kurikulum->Visible) { // kurikulum ?>
		<td data-name="kurikulum" <?php echo $t_kurikulum_grid->kurikulum->cellAttributes() ?>>
<?php if ($t_kurikulum->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_kurikulum_grid->RowCount ?>_t_kurikulum_kurikulum" class="form-group">
<textarea data-table="t_kurikulum" data-field="x_kurikulum" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulum" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulum" cols="10" rows="4" placeholder="<?php echo HtmlEncode($t_kurikulum_grid->kurikulum->getPlaceHolder()) ?>"<?php echo $t_kurikulum_grid->kurikulum->editAttributes() ?>><?php echo $t_kurikulum_grid->kurikulum->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t_kurikulum" data-field="x_kurikulum" name="o<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulum" id="o<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulum" value="<?php echo HtmlEncode($t_kurikulum_grid->kurikulum->OldValue) ?>">
<?php } ?>
<?php if ($t_kurikulum->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_kurikulum_grid->RowCount ?>_t_kurikulum_kurikulum" class="form-group">
<textarea data-table="t_kurikulum" data-field="x_kurikulum" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulum" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulum" cols="10" rows="4" placeholder="<?php echo HtmlEncode($t_kurikulum_grid->kurikulum->getPlaceHolder()) ?>"<?php echo $t_kurikulum_grid->kurikulum->editAttributes() ?>><?php echo $t_kurikulum_grid->kurikulum->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t_kurikulum->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_kurikulum_grid->RowCount ?>_t_kurikulum_kurikulum">
<span<?php echo $t_kurikulum_grid->kurikulum->viewAttributes() ?>><?php echo $t_kurikulum_grid->kurikulum->getViewValue() ?></span>
</span>
<?php if (!$t_kurikulum->isConfirm()) { ?>
<input type="hidden" data-table="t_kurikulum" data-field="x_kurikulum" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulum" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulum" value="<?php echo HtmlEncode($t_kurikulum_grid->kurikulum->FormValue) ?>">
<input type="hidden" data-table="t_kurikulum" data-field="x_kurikulum" name="o<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulum" id="o<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulum" value="<?php echo HtmlEncode($t_kurikulum_grid->kurikulum->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_kurikulum" data-field="x_kurikulum" name="ft_kurikulumgrid$x<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulum" id="ft_kurikulumgrid$x<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulum" value="<?php echo HtmlEncode($t_kurikulum_grid->kurikulum->FormValue) ?>">
<input type="hidden" data-table="t_kurikulum" data-field="x_kurikulum" name="ft_kurikulumgrid$o<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulum" id="ft_kurikulumgrid$o<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulum" value="<?php echo HtmlEncode($t_kurikulum_grid->kurikulum->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_kurikulum_grid->silabus->Visible) { // silabus ?>
		<td data-name="silabus" <?php echo $t_kurikulum_grid->silabus->cellAttributes() ?>>
<?php if ($t_kurikulum->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_kurikulum_grid->RowCount ?>_t_kurikulum_silabus" class="form-group">
<?php $t_kurikulum_grid->silabus->EditAttrs->appendClass("editor"); ?>
<textarea data-table="t_kurikulum" data-field="x_silabus" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_silabus" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_silabus" cols="95" rows="4" placeholder="<?php echo HtmlEncode($t_kurikulum_grid->silabus->getPlaceHolder()) ?>"<?php echo $t_kurikulum_grid->silabus->editAttributes() ?>><?php echo $t_kurikulum_grid->silabus->EditValue ?></textarea>
<script>
loadjs.ready(["ft_kurikulumgrid", "editor"], function() {
	ew.createEditor("ft_kurikulumgrid", "x<?php echo $t_kurikulum_grid->RowIndex ?>_silabus", 95, 4, <?php echo $t_kurikulum_grid->silabus->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<input type="hidden" data-table="t_kurikulum" data-field="x_silabus" name="o<?php echo $t_kurikulum_grid->RowIndex ?>_silabus" id="o<?php echo $t_kurikulum_grid->RowIndex ?>_silabus" value="<?php echo HtmlEncode($t_kurikulum_grid->silabus->OldValue) ?>">
<?php } ?>
<?php if ($t_kurikulum->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_kurikulum_grid->RowCount ?>_t_kurikulum_silabus" class="form-group">
<?php $t_kurikulum_grid->silabus->EditAttrs->appendClass("editor"); ?>
<textarea data-table="t_kurikulum" data-field="x_silabus" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_silabus" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_silabus" cols="95" rows="4" placeholder="<?php echo HtmlEncode($t_kurikulum_grid->silabus->getPlaceHolder()) ?>"<?php echo $t_kurikulum_grid->silabus->editAttributes() ?>><?php echo $t_kurikulum_grid->silabus->EditValue ?></textarea>
<script>
loadjs.ready(["ft_kurikulumgrid", "editor"], function() {
	ew.createEditor("ft_kurikulumgrid", "x<?php echo $t_kurikulum_grid->RowIndex ?>_silabus", 95, 4, <?php echo $t_kurikulum_grid->silabus->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php } ?>
<?php if ($t_kurikulum->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_kurikulum_grid->RowCount ?>_t_kurikulum_silabus">
<span<?php echo $t_kurikulum_grid->silabus->viewAttributes() ?>><?php echo $t_kurikulum_grid->silabus->getViewValue() ?></span>
</span>
<?php if (!$t_kurikulum->isConfirm()) { ?>
<input type="hidden" data-table="t_kurikulum" data-field="x_silabus" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_silabus" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_silabus" value="<?php echo HtmlEncode($t_kurikulum_grid->silabus->FormValue) ?>">
<input type="hidden" data-table="t_kurikulum" data-field="x_silabus" name="o<?php echo $t_kurikulum_grid->RowIndex ?>_silabus" id="o<?php echo $t_kurikulum_grid->RowIndex ?>_silabus" value="<?php echo HtmlEncode($t_kurikulum_grid->silabus->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_kurikulum" data-field="x_silabus" name="ft_kurikulumgrid$x<?php echo $t_kurikulum_grid->RowIndex ?>_silabus" id="ft_kurikulumgrid$x<?php echo $t_kurikulum_grid->RowIndex ?>_silabus" value="<?php echo HtmlEncode($t_kurikulum_grid->silabus->FormValue) ?>">
<input type="hidden" data-table="t_kurikulum" data-field="x_silabus" name="ft_kurikulumgrid$o<?php echo $t_kurikulum_grid->RowIndex ?>_silabus" id="ft_kurikulumgrid$o<?php echo $t_kurikulum_grid->RowIndex ?>_silabus" value="<?php echo HtmlEncode($t_kurikulum_grid->silabus->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_kurikulum_grid->tujuan_instruksional->Visible) { // tujuan_instruksional ?>
		<td data-name="tujuan_instruksional" <?php echo $t_kurikulum_grid->tujuan_instruksional->cellAttributes() ?>>
<?php if ($t_kurikulum->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_kurikulum_grid->RowCount ?>_t_kurikulum_tujuan_instruksional" class="form-group">
<textarea data-table="t_kurikulum" data-field="x_tujuan_instruksional" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_tujuan_instruksional" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_tujuan_instruksional" cols="10" rows="4" placeholder="<?php echo HtmlEncode($t_kurikulum_grid->tujuan_instruksional->getPlaceHolder()) ?>"<?php echo $t_kurikulum_grid->tujuan_instruksional->editAttributes() ?>><?php echo $t_kurikulum_grid->tujuan_instruksional->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t_kurikulum" data-field="x_tujuan_instruksional" name="o<?php echo $t_kurikulum_grid->RowIndex ?>_tujuan_instruksional" id="o<?php echo $t_kurikulum_grid->RowIndex ?>_tujuan_instruksional" value="<?php echo HtmlEncode($t_kurikulum_grid->tujuan_instruksional->OldValue) ?>">
<?php } ?>
<?php if ($t_kurikulum->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_kurikulum_grid->RowCount ?>_t_kurikulum_tujuan_instruksional" class="form-group">
<textarea data-table="t_kurikulum" data-field="x_tujuan_instruksional" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_tujuan_instruksional" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_tujuan_instruksional" cols="10" rows="4" placeholder="<?php echo HtmlEncode($t_kurikulum_grid->tujuan_instruksional->getPlaceHolder()) ?>"<?php echo $t_kurikulum_grid->tujuan_instruksional->editAttributes() ?>><?php echo $t_kurikulum_grid->tujuan_instruksional->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t_kurikulum->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_kurikulum_grid->RowCount ?>_t_kurikulum_tujuan_instruksional">
<span<?php echo $t_kurikulum_grid->tujuan_instruksional->viewAttributes() ?>><?php echo $t_kurikulum_grid->tujuan_instruksional->getViewValue() ?></span>
</span>
<?php if (!$t_kurikulum->isConfirm()) { ?>
<input type="hidden" data-table="t_kurikulum" data-field="x_tujuan_instruksional" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_tujuan_instruksional" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_tujuan_instruksional" value="<?php echo HtmlEncode($t_kurikulum_grid->tujuan_instruksional->FormValue) ?>">
<input type="hidden" data-table="t_kurikulum" data-field="x_tujuan_instruksional" name="o<?php echo $t_kurikulum_grid->RowIndex ?>_tujuan_instruksional" id="o<?php echo $t_kurikulum_grid->RowIndex ?>_tujuan_instruksional" value="<?php echo HtmlEncode($t_kurikulum_grid->tujuan_instruksional->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_kurikulum" data-field="x_tujuan_instruksional" name="ft_kurikulumgrid$x<?php echo $t_kurikulum_grid->RowIndex ?>_tujuan_instruksional" id="ft_kurikulumgrid$x<?php echo $t_kurikulum_grid->RowIndex ?>_tujuan_instruksional" value="<?php echo HtmlEncode($t_kurikulum_grid->tujuan_instruksional->FormValue) ?>">
<input type="hidden" data-table="t_kurikulum" data-field="x_tujuan_instruksional" name="ft_kurikulumgrid$o<?php echo $t_kurikulum_grid->RowIndex ?>_tujuan_instruksional" id="ft_kurikulumgrid$o<?php echo $t_kurikulum_grid->RowIndex ?>_tujuan_instruksional" value="<?php echo HtmlEncode($t_kurikulum_grid->tujuan_instruksional->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_kurikulum_grid->sesi->Visible) { // sesi ?>
		<td data-name="sesi" <?php echo $t_kurikulum_grid->sesi->cellAttributes() ?>>
<?php if ($t_kurikulum->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_kurikulum_grid->RowCount ?>_t_kurikulum_sesi" class="form-group">
<input type="text" data-table="t_kurikulum" data-field="x_sesi" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_sesi" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_sesi" size="1" maxlength="2" placeholder="<?php echo HtmlEncode($t_kurikulum_grid->sesi->getPlaceHolder()) ?>" value="<?php echo $t_kurikulum_grid->sesi->EditValue ?>"<?php echo $t_kurikulum_grid->sesi->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_kurikulum" data-field="x_sesi" name="o<?php echo $t_kurikulum_grid->RowIndex ?>_sesi" id="o<?php echo $t_kurikulum_grid->RowIndex ?>_sesi" value="<?php echo HtmlEncode($t_kurikulum_grid->sesi->OldValue) ?>">
<?php } ?>
<?php if ($t_kurikulum->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_kurikulum_grid->RowCount ?>_t_kurikulum_sesi" class="form-group">
<input type="text" data-table="t_kurikulum" data-field="x_sesi" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_sesi" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_sesi" size="1" maxlength="2" placeholder="<?php echo HtmlEncode($t_kurikulum_grid->sesi->getPlaceHolder()) ?>" value="<?php echo $t_kurikulum_grid->sesi->EditValue ?>"<?php echo $t_kurikulum_grid->sesi->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_kurikulum->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_kurikulum_grid->RowCount ?>_t_kurikulum_sesi">
<span<?php echo $t_kurikulum_grid->sesi->viewAttributes() ?>><?php echo $t_kurikulum_grid->sesi->getViewValue() ?></span>
</span>
<?php if (!$t_kurikulum->isConfirm()) { ?>
<input type="hidden" data-table="t_kurikulum" data-field="x_sesi" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_sesi" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_sesi" value="<?php echo HtmlEncode($t_kurikulum_grid->sesi->FormValue) ?>">
<input type="hidden" data-table="t_kurikulum" data-field="x_sesi" name="o<?php echo $t_kurikulum_grid->RowIndex ?>_sesi" id="o<?php echo $t_kurikulum_grid->RowIndex ?>_sesi" value="<?php echo HtmlEncode($t_kurikulum_grid->sesi->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_kurikulum" data-field="x_sesi" name="ft_kurikulumgrid$x<?php echo $t_kurikulum_grid->RowIndex ?>_sesi" id="ft_kurikulumgrid$x<?php echo $t_kurikulum_grid->RowIndex ?>_sesi" value="<?php echo HtmlEncode($t_kurikulum_grid->sesi->FormValue) ?>">
<input type="hidden" data-table="t_kurikulum" data-field="x_sesi" name="ft_kurikulumgrid$o<?php echo $t_kurikulum_grid->RowIndex ?>_sesi" id="ft_kurikulumgrid$o<?php echo $t_kurikulum_grid->RowIndex ?>_sesi" value="<?php echo HtmlEncode($t_kurikulum_grid->sesi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_kurikulum_grid->ListOptions->render("body", "right", $t_kurikulum_grid->RowCount);
?>
	</tr>
<?php if ($t_kurikulum->RowType == ROWTYPE_ADD || $t_kurikulum->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_kurikulumgrid", "load"], function() {
	ft_kurikulumgrid.updateLists(<?php echo $t_kurikulum_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_kurikulum_grid->isGridAdd() || $t_kurikulum->CurrentMode == "copy")
		if (!$t_kurikulum_grid->Recordset->EOF)
			$t_kurikulum_grid->Recordset->moveNext();
}
?>
<?php
	if ($t_kurikulum->CurrentMode == "add" || $t_kurikulum->CurrentMode == "copy" || $t_kurikulum->CurrentMode == "edit") {
		$t_kurikulum_grid->RowIndex = '$rowindex$';
		$t_kurikulum_grid->loadRowValues();

		// Set row properties
		$t_kurikulum->resetAttributes();
		$t_kurikulum->RowAttrs->merge(["data-rowindex" => $t_kurikulum_grid->RowIndex, "id" => "r0_t_kurikulum", "data-rowtype" => ROWTYPE_ADD]);
		$t_kurikulum->RowAttrs->appendClass("ew-template");
		$t_kurikulum->RowType = ROWTYPE_ADD;

		// Render row
		$t_kurikulum_grid->renderRow();

		// Render list options
		$t_kurikulum_grid->renderListOptions();
		$t_kurikulum_grid->StartRowCount = 0;
?>
	<tr <?php echo $t_kurikulum->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_kurikulum_grid->ListOptions->render("body", "left", $t_kurikulum_grid->RowIndex);
?>
	<?php if ($t_kurikulum_grid->kdkursil->Visible) { // kdkursil ?>
		<td data-name="kdkursil">
<?php if (!$t_kurikulum->isConfirm()) { ?>
<?php if ($t_kurikulum_grid->kdkursil->getSessionValue() != "") { ?>
<span id="el$rowindex$_t_kurikulum_kdkursil" class="form-group t_kurikulum_kdkursil">
<span<?php echo $t_kurikulum_grid->kdkursil->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_kurikulum_grid->kdkursil->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_kurikulum_grid->kdkursil->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_kurikulum_kdkursil" class="form-group t_kurikulum_kdkursil">
<input type="text" data-table="t_kurikulum" data-field="x_kdkursil" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" size="12" maxlength="12" placeholder="<?php echo HtmlEncode($t_kurikulum_grid->kdkursil->getPlaceHolder()) ?>" value="<?php echo $t_kurikulum_grid->kdkursil->EditValue ?>"<?php echo $t_kurikulum_grid->kdkursil->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t_kurikulum_kdkursil" class="form-group t_kurikulum_kdkursil">
<span<?php echo $t_kurikulum_grid->kdkursil->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_kurikulum_grid->kdkursil->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_kurikulum" data-field="x_kdkursil" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_kurikulum_grid->kdkursil->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_kurikulum" data-field="x_kdkursil" name="o<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" id="o<?php echo $t_kurikulum_grid->RowIndex ?>_kdkursil" value="<?php echo HtmlEncode($t_kurikulum_grid->kdkursil->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_kurikulum_grid->hari->Visible) { // hari ?>
		<td data-name="hari">
<?php if (!$t_kurikulum->isConfirm()) { ?>
<span id="el$rowindex$_t_kurikulum_hari" class="form-group t_kurikulum_hari">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_kurikulum" data-field="x_hari" data-value-separator="<?php echo $t_kurikulum_grid->hari->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_hari" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_hari"<?php echo $t_kurikulum_grid->hari->editAttributes() ?>>
			<?php echo $t_kurikulum_grid->hari->selectOptionListHtml("x{$t_kurikulum_grid->RowIndex}_hari") ?>
		</select>
</div>
<?php echo $t_kurikulum_grid->hari->Lookup->getParamTag($t_kurikulum_grid, "p_x" . $t_kurikulum_grid->RowIndex . "_hari") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_kurikulum_hari" class="form-group t_kurikulum_hari">
<span<?php echo $t_kurikulum_grid->hari->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_kurikulum_grid->hari->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_kurikulum" data-field="x_hari" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_hari" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_hari" value="<?php echo HtmlEncode($t_kurikulum_grid->hari->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_kurikulum" data-field="x_hari" name="o<?php echo $t_kurikulum_grid->RowIndex ?>_hari" id="o<?php echo $t_kurikulum_grid->RowIndex ?>_hari" value="<?php echo HtmlEncode($t_kurikulum_grid->hari->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_kurikulum_grid->kurikulum->Visible) { // kurikulum ?>
		<td data-name="kurikulum">
<?php if (!$t_kurikulum->isConfirm()) { ?>
<span id="el$rowindex$_t_kurikulum_kurikulum" class="form-group t_kurikulum_kurikulum">
<textarea data-table="t_kurikulum" data-field="x_kurikulum" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulum" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulum" cols="10" rows="4" placeholder="<?php echo HtmlEncode($t_kurikulum_grid->kurikulum->getPlaceHolder()) ?>"<?php echo $t_kurikulum_grid->kurikulum->editAttributes() ?>><?php echo $t_kurikulum_grid->kurikulum->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_kurikulum_kurikulum" class="form-group t_kurikulum_kurikulum">
<span<?php echo $t_kurikulum_grid->kurikulum->viewAttributes() ?>><?php echo $t_kurikulum_grid->kurikulum->ViewValue ?></span>
</span>
<input type="hidden" data-table="t_kurikulum" data-field="x_kurikulum" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulum" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulum" value="<?php echo HtmlEncode($t_kurikulum_grid->kurikulum->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_kurikulum" data-field="x_kurikulum" name="o<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulum" id="o<?php echo $t_kurikulum_grid->RowIndex ?>_kurikulum" value="<?php echo HtmlEncode($t_kurikulum_grid->kurikulum->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_kurikulum_grid->silabus->Visible) { // silabus ?>
		<td data-name="silabus">
<?php if (!$t_kurikulum->isConfirm()) { ?>
<span id="el$rowindex$_t_kurikulum_silabus" class="form-group t_kurikulum_silabus">
<?php $t_kurikulum_grid->silabus->EditAttrs->appendClass("editor"); ?>
<textarea data-table="t_kurikulum" data-field="x_silabus" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_silabus" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_silabus" cols="95" rows="4" placeholder="<?php echo HtmlEncode($t_kurikulum_grid->silabus->getPlaceHolder()) ?>"<?php echo $t_kurikulum_grid->silabus->editAttributes() ?>><?php echo $t_kurikulum_grid->silabus->EditValue ?></textarea>
<script>
loadjs.ready(["ft_kurikulumgrid", "editor"], function() {
	ew.createEditor("ft_kurikulumgrid", "x<?php echo $t_kurikulum_grid->RowIndex ?>_silabus", 95, 4, <?php echo $t_kurikulum_grid->silabus->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_kurikulum_silabus" class="form-group t_kurikulum_silabus">
<span<?php echo $t_kurikulum_grid->silabus->viewAttributes() ?>><?php echo $t_kurikulum_grid->silabus->ViewValue ?></span>
</span>
<input type="hidden" data-table="t_kurikulum" data-field="x_silabus" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_silabus" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_silabus" value="<?php echo HtmlEncode($t_kurikulum_grid->silabus->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_kurikulum" data-field="x_silabus" name="o<?php echo $t_kurikulum_grid->RowIndex ?>_silabus" id="o<?php echo $t_kurikulum_grid->RowIndex ?>_silabus" value="<?php echo HtmlEncode($t_kurikulum_grid->silabus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_kurikulum_grid->tujuan_instruksional->Visible) { // tujuan_instruksional ?>
		<td data-name="tujuan_instruksional">
<?php if (!$t_kurikulum->isConfirm()) { ?>
<span id="el$rowindex$_t_kurikulum_tujuan_instruksional" class="form-group t_kurikulum_tujuan_instruksional">
<textarea data-table="t_kurikulum" data-field="x_tujuan_instruksional" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_tujuan_instruksional" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_tujuan_instruksional" cols="10" rows="4" placeholder="<?php echo HtmlEncode($t_kurikulum_grid->tujuan_instruksional->getPlaceHolder()) ?>"<?php echo $t_kurikulum_grid->tujuan_instruksional->editAttributes() ?>><?php echo $t_kurikulum_grid->tujuan_instruksional->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_kurikulum_tujuan_instruksional" class="form-group t_kurikulum_tujuan_instruksional">
<span<?php echo $t_kurikulum_grid->tujuan_instruksional->viewAttributes() ?>><?php echo $t_kurikulum_grid->tujuan_instruksional->ViewValue ?></span>
</span>
<input type="hidden" data-table="t_kurikulum" data-field="x_tujuan_instruksional" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_tujuan_instruksional" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_tujuan_instruksional" value="<?php echo HtmlEncode($t_kurikulum_grid->tujuan_instruksional->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_kurikulum" data-field="x_tujuan_instruksional" name="o<?php echo $t_kurikulum_grid->RowIndex ?>_tujuan_instruksional" id="o<?php echo $t_kurikulum_grid->RowIndex ?>_tujuan_instruksional" value="<?php echo HtmlEncode($t_kurikulum_grid->tujuan_instruksional->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_kurikulum_grid->sesi->Visible) { // sesi ?>
		<td data-name="sesi">
<?php if (!$t_kurikulum->isConfirm()) { ?>
<span id="el$rowindex$_t_kurikulum_sesi" class="form-group t_kurikulum_sesi">
<input type="text" data-table="t_kurikulum" data-field="x_sesi" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_sesi" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_sesi" size="1" maxlength="2" placeholder="<?php echo HtmlEncode($t_kurikulum_grid->sesi->getPlaceHolder()) ?>" value="<?php echo $t_kurikulum_grid->sesi->EditValue ?>"<?php echo $t_kurikulum_grid->sesi->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_kurikulum_sesi" class="form-group t_kurikulum_sesi">
<span<?php echo $t_kurikulum_grid->sesi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_kurikulum_grid->sesi->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_kurikulum" data-field="x_sesi" name="x<?php echo $t_kurikulum_grid->RowIndex ?>_sesi" id="x<?php echo $t_kurikulum_grid->RowIndex ?>_sesi" value="<?php echo HtmlEncode($t_kurikulum_grid->sesi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_kurikulum" data-field="x_sesi" name="o<?php echo $t_kurikulum_grid->RowIndex ?>_sesi" id="o<?php echo $t_kurikulum_grid->RowIndex ?>_sesi" value="<?php echo HtmlEncode($t_kurikulum_grid->sesi->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_kurikulum_grid->ListOptions->render("body", "right", $t_kurikulum_grid->RowIndex);
?>
<script>
loadjs.ready(["ft_kurikulumgrid", "load"], function() {
	ft_kurikulumgrid.updateLists(<?php echo $t_kurikulum_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($t_kurikulum->CurrentMode == "add" || $t_kurikulum->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $t_kurikulum_grid->FormKeyCountName ?>" id="<?php echo $t_kurikulum_grid->FormKeyCountName ?>" value="<?php echo $t_kurikulum_grid->KeyCount ?>">
<?php echo $t_kurikulum_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_kurikulum->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $t_kurikulum_grid->FormKeyCountName ?>" id="<?php echo $t_kurikulum_grid->FormKeyCountName ?>" value="<?php echo $t_kurikulum_grid->KeyCount ?>">
<?php echo $t_kurikulum_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_kurikulum->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_kurikulumgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_kurikulum_grid->Recordset)
	$t_kurikulum_grid->Recordset->Close();
?>
<?php if ($t_kurikulum_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $t_kurikulum_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_kurikulum_grid->TotalRecords == 0 && !$t_kurikulum->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_kurikulum_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$t_kurikulum_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$t_kurikulum_grid->terminate();
?>