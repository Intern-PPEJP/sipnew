<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($t_pweb_grid))
	$t_pweb_grid = new t_pweb_grid();

// Run the page
$t_pweb_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pweb_grid->Page_Render();
?>
<?php if (!$t_pweb_grid->isExport()) { ?>
<script>
var ft_pwebgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	ft_pwebgrid = new ew.Form("ft_pwebgrid", "grid");
	ft_pwebgrid.formKeyCountName = '<?php echo $t_pweb_grid->FormKeyCountName ?>';

	// Validate form
	ft_pwebgrid.validate = function() {
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
			<?php if ($t_pweb_grid->kdhistori->Required) { ?>
				elm = this.getElements("x" + infix + "_kdhistori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_grid->kdhistori->caption(), $t_pweb_grid->kdhistori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pweb_grid->rkwid->Required) { ?>
				elm = this.getElements("x" + infix + "_rkwid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_grid->rkwid->caption(), $t_pweb_grid->rkwid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pweb_grid->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_grid->id->caption(), $t_pweb_grid->id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pweb_grid->id->errorMessage()) ?>");
			<?php if ($t_pweb_grid->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_grid->tahun->caption(), $t_pweb_grid->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pweb_grid->kdinformasi->Required) { ?>
				elm = this.getElements("x" + infix + "_kdinformasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_grid->kdinformasi->caption(), $t_pweb_grid->kdinformasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pweb_grid->harapan->Required) { ?>
				elm = this.getElements("x" + infix + "_harapan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_grid->harapan->caption(), $t_pweb_grid->harapan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pweb_grid->sertifikat->Required) { ?>
				elm = this.getElements("x" + infix + "_sertifikat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pweb_grid->sertifikat->caption(), $t_pweb_grid->sertifikat->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	ft_pwebgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "rkwid", false)) return false;
		if (ew.valueChanged(fobj, infix, "id", false)) return false;
		if (ew.valueChanged(fobj, infix, "tahun", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdinformasi", false)) return false;
		if (ew.valueChanged(fobj, infix, "harapan", false)) return false;
		if (ew.valueChanged(fobj, infix, "sertifikat", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_pwebgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_pwebgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_pwebgrid.lists["x_rkwid"] = <?php echo $t_pweb_grid->rkwid->Lookup->toClientList($t_pweb_grid) ?>;
	ft_pwebgrid.lists["x_rkwid"].options = <?php echo JsonEncode($t_pweb_grid->rkwid->lookupOptions()) ?>;
	ft_pwebgrid.autoSuggests["x_rkwid"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pwebgrid.lists["x_id"] = <?php echo $t_pweb_grid->id->Lookup->toClientList($t_pweb_grid) ?>;
	ft_pwebgrid.lists["x_id"].options = <?php echo JsonEncode($t_pweb_grid->id->lookupOptions()) ?>;
	ft_pwebgrid.autoSuggests["x_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pwebgrid.lists["x_kdinformasi"] = <?php echo $t_pweb_grid->kdinformasi->Lookup->toClientList($t_pweb_grid) ?>;
	ft_pwebgrid.lists["x_kdinformasi"].options = <?php echo JsonEncode($t_pweb_grid->kdinformasi->lookupOptions()) ?>;
	loadjs.done("ft_pwebgrid");
});
</script>
<?php } ?>
<?php
$t_pweb_grid->renderOtherOptions();
?>
<?php if ($t_pweb_grid->TotalRecords > 0 || $t_pweb->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_pweb_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_pweb">
<?php if ($t_pweb_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $t_pweb_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ft_pwebgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_t_pweb" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_t_pwebgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_pweb->RowType = ROWTYPE_HEADER;

// Render list options
$t_pweb_grid->renderListOptions();

// Render list options (header, left)
$t_pweb_grid->ListOptions->render("header", "left");
?>
<?php if ($t_pweb_grid->kdhistori->Visible) { // kdhistori ?>
	<?php if ($t_pweb_grid->SortUrl($t_pweb_grid->kdhistori) == "") { ?>
		<th data-name="kdhistori" class="<?php echo $t_pweb_grid->kdhistori->headerCellClass() ?>"><div id="elh_t_pweb_kdhistori" class="t_pweb_kdhistori"><div class="ew-table-header-caption"><?php echo $t_pweb_grid->kdhistori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdhistori" class="<?php echo $t_pweb_grid->kdhistori->headerCellClass() ?>"><div><div id="elh_t_pweb_kdhistori" class="t_pweb_kdhistori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pweb_grid->kdhistori->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pweb_grid->kdhistori->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pweb_grid->kdhistori->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pweb_grid->rkwid->Visible) { // rkwid ?>
	<?php if ($t_pweb_grid->SortUrl($t_pweb_grid->rkwid) == "") { ?>
		<th data-name="rkwid" class="<?php echo $t_pweb_grid->rkwid->headerCellClass() ?>"><div id="elh_t_pweb_rkwid" class="t_pweb_rkwid"><div class="ew-table-header-caption"><?php echo $t_pweb_grid->rkwid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rkwid" class="<?php echo $t_pweb_grid->rkwid->headerCellClass() ?>"><div><div id="elh_t_pweb_rkwid" class="t_pweb_rkwid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pweb_grid->rkwid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pweb_grid->rkwid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pweb_grid->rkwid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pweb_grid->id->Visible) { // id ?>
	<?php if ($t_pweb_grid->SortUrl($t_pweb_grid->id) == "") { ?>
		<th data-name="id" class="<?php echo $t_pweb_grid->id->headerCellClass() ?>"><div id="elh_t_pweb_id" class="t_pweb_id"><div class="ew-table-header-caption"><?php echo $t_pweb_grid->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $t_pweb_grid->id->headerCellClass() ?>"><div><div id="elh_t_pweb_id" class="t_pweb_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pweb_grid->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pweb_grid->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pweb_grid->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pweb_grid->tahun->Visible) { // tahun ?>
	<?php if ($t_pweb_grid->SortUrl($t_pweb_grid->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $t_pweb_grid->tahun->headerCellClass() ?>"><div id="elh_t_pweb_tahun" class="t_pweb_tahun"><div class="ew-table-header-caption"><?php echo $t_pweb_grid->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $t_pweb_grid->tahun->headerCellClass() ?>"><div><div id="elh_t_pweb_tahun" class="t_pweb_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pweb_grid->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pweb_grid->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pweb_grid->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pweb_grid->kdinformasi->Visible) { // kdinformasi ?>
	<?php if ($t_pweb_grid->SortUrl($t_pweb_grid->kdinformasi) == "") { ?>
		<th data-name="kdinformasi" class="<?php echo $t_pweb_grid->kdinformasi->headerCellClass() ?>"><div id="elh_t_pweb_kdinformasi" class="t_pweb_kdinformasi"><div class="ew-table-header-caption"><?php echo $t_pweb_grid->kdinformasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdinformasi" class="<?php echo $t_pweb_grid->kdinformasi->headerCellClass() ?>"><div><div id="elh_t_pweb_kdinformasi" class="t_pweb_kdinformasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pweb_grid->kdinformasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pweb_grid->kdinformasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pweb_grid->kdinformasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pweb_grid->harapan->Visible) { // harapan ?>
	<?php if ($t_pweb_grid->SortUrl($t_pweb_grid->harapan) == "") { ?>
		<th data-name="harapan" class="<?php echo $t_pweb_grid->harapan->headerCellClass() ?>"><div id="elh_t_pweb_harapan" class="t_pweb_harapan"><div class="ew-table-header-caption"><?php echo $t_pweb_grid->harapan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="harapan" class="<?php echo $t_pweb_grid->harapan->headerCellClass() ?>"><div><div id="elh_t_pweb_harapan" class="t_pweb_harapan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pweb_grid->harapan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pweb_grid->harapan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pweb_grid->harapan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pweb_grid->sertifikat->Visible) { // sertifikat ?>
	<?php if ($t_pweb_grid->SortUrl($t_pweb_grid->sertifikat) == "") { ?>
		<th data-name="sertifikat" class="<?php echo $t_pweb_grid->sertifikat->headerCellClass() ?>"><div id="elh_t_pweb_sertifikat" class="t_pweb_sertifikat"><div class="ew-table-header-caption"><?php echo $t_pweb_grid->sertifikat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sertifikat" class="<?php echo $t_pweb_grid->sertifikat->headerCellClass() ?>"><div><div id="elh_t_pweb_sertifikat" class="t_pweb_sertifikat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pweb_grid->sertifikat->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pweb_grid->sertifikat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pweb_grid->sertifikat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_pweb_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_pweb_grid->StartRecord = 1;
$t_pweb_grid->StopRecord = $t_pweb_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($t_pweb->isConfirm() || $t_pweb_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_pweb_grid->FormKeyCountName) && ($t_pweb_grid->isGridAdd() || $t_pweb_grid->isGridEdit() || $t_pweb->isConfirm())) {
		$t_pweb_grid->KeyCount = $CurrentForm->getValue($t_pweb_grid->FormKeyCountName);
		$t_pweb_grid->StopRecord = $t_pweb_grid->StartRecord + $t_pweb_grid->KeyCount - 1;
	}
}
$t_pweb_grid->RecordCount = $t_pweb_grid->StartRecord - 1;
if ($t_pweb_grid->Recordset && !$t_pweb_grid->Recordset->EOF) {
	$t_pweb_grid->Recordset->moveFirst();
	$selectLimit = $t_pweb_grid->UseSelectLimit;
	if (!$selectLimit && $t_pweb_grid->StartRecord > 1)
		$t_pweb_grid->Recordset->move($t_pweb_grid->StartRecord - 1);
} elseif (!$t_pweb->AllowAddDeleteRow && $t_pweb_grid->StopRecord == 0) {
	$t_pweb_grid->StopRecord = $t_pweb->GridAddRowCount;
}

// Initialize aggregate
$t_pweb->RowType = ROWTYPE_AGGREGATEINIT;
$t_pweb->resetAttributes();
$t_pweb_grid->renderRow();
if ($t_pweb_grid->isGridAdd())
	$t_pweb_grid->RowIndex = 0;
if ($t_pweb_grid->isGridEdit())
	$t_pweb_grid->RowIndex = 0;
while ($t_pweb_grid->RecordCount < $t_pweb_grid->StopRecord) {
	$t_pweb_grid->RecordCount++;
	if ($t_pweb_grid->RecordCount >= $t_pweb_grid->StartRecord) {
		$t_pweb_grid->RowCount++;
		if ($t_pweb_grid->isGridAdd() || $t_pweb_grid->isGridEdit() || $t_pweb->isConfirm()) {
			$t_pweb_grid->RowIndex++;
			$CurrentForm->Index = $t_pweb_grid->RowIndex;
			if ($CurrentForm->hasValue($t_pweb_grid->FormActionName) && ($t_pweb->isConfirm() || $t_pweb_grid->EventCancelled))
				$t_pweb_grid->RowAction = strval($CurrentForm->getValue($t_pweb_grid->FormActionName));
			elseif ($t_pweb_grid->isGridAdd())
				$t_pweb_grid->RowAction = "insert";
			else
				$t_pweb_grid->RowAction = "";
		}

		// Set up key count
		$t_pweb_grid->KeyCount = $t_pweb_grid->RowIndex;

		// Init row class and style
		$t_pweb->resetAttributes();
		$t_pweb->CssClass = "";
		if ($t_pweb_grid->isGridAdd()) {
			if ($t_pweb->CurrentMode == "copy") {
				$t_pweb_grid->loadRowValues($t_pweb_grid->Recordset); // Load row values
				$t_pweb_grid->setRecordKey($t_pweb_grid->RowOldKey, $t_pweb_grid->Recordset); // Set old record key
			} else {
				$t_pweb_grid->loadRowValues(); // Load default values
				$t_pweb_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_pweb_grid->loadRowValues($t_pweb_grid->Recordset); // Load row values
		}
		$t_pweb->RowType = ROWTYPE_VIEW; // Render view
		if ($t_pweb_grid->isGridAdd()) // Grid add
			$t_pweb->RowType = ROWTYPE_ADD; // Render add
		if ($t_pweb_grid->isGridAdd() && $t_pweb->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_pweb_grid->restoreCurrentRowFormValues($t_pweb_grid->RowIndex); // Restore form values
		if ($t_pweb_grid->isGridEdit()) { // Grid edit
			if ($t_pweb->EventCancelled)
				$t_pweb_grid->restoreCurrentRowFormValues($t_pweb_grid->RowIndex); // Restore form values
			if ($t_pweb_grid->RowAction == "insert")
				$t_pweb->RowType = ROWTYPE_ADD; // Render add
			else
				$t_pweb->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_pweb_grid->isGridEdit() && ($t_pweb->RowType == ROWTYPE_EDIT || $t_pweb->RowType == ROWTYPE_ADD) && $t_pweb->EventCancelled) // Update failed
			$t_pweb_grid->restoreCurrentRowFormValues($t_pweb_grid->RowIndex); // Restore form values
		if ($t_pweb->RowType == ROWTYPE_EDIT) // Edit row
			$t_pweb_grid->EditRowCount++;
		if ($t_pweb->isConfirm()) // Confirm row
			$t_pweb_grid->restoreCurrentRowFormValues($t_pweb_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_pweb->RowAttrs->merge(["data-rowindex" => $t_pweb_grid->RowCount, "id" => "r" . $t_pweb_grid->RowCount . "_t_pweb", "data-rowtype" => $t_pweb->RowType]);

		// Render row
		$t_pweb_grid->renderRow();

		// Render list options
		$t_pweb_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_pweb_grid->RowAction != "delete" && $t_pweb_grid->RowAction != "insertdelete" && !($t_pweb_grid->RowAction == "insert" && $t_pweb->isConfirm() && $t_pweb_grid->emptyRow())) {
?>
	<tr <?php echo $t_pweb->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_pweb_grid->ListOptions->render("body", "left", $t_pweb_grid->RowCount);
?>
	<?php if ($t_pweb_grid->kdhistori->Visible) { // kdhistori ?>
		<td data-name="kdhistori" <?php echo $t_pweb_grid->kdhistori->cellAttributes() ?>>
<?php if ($t_pweb->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_kdhistori" class="form-group"></span>
<input type="hidden" data-table="t_pweb" data-field="x_kdhistori" name="o<?php echo $t_pweb_grid->RowIndex ?>_kdhistori" id="o<?php echo $t_pweb_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($t_pweb_grid->kdhistori->OldValue) ?>">
<?php } ?>
<?php if ($t_pweb->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_kdhistori" class="form-group">
<span<?php echo $t_pweb_grid->kdhistori->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pweb_grid->kdhistori->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_kdhistori" name="x<?php echo $t_pweb_grid->RowIndex ?>_kdhistori" id="x<?php echo $t_pweb_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($t_pweb_grid->kdhistori->CurrentValue) ?>">
<?php } ?>
<?php if ($t_pweb->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_kdhistori">
<span<?php echo $t_pweb_grid->kdhistori->viewAttributes() ?>><?php echo $t_pweb_grid->kdhistori->getViewValue() ?></span>
</span>
<?php if (!$t_pweb->isConfirm()) { ?>
<input type="hidden" data-table="t_pweb" data-field="x_kdhistori" name="x<?php echo $t_pweb_grid->RowIndex ?>_kdhistori" id="x<?php echo $t_pweb_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($t_pweb_grid->kdhistori->FormValue) ?>">
<input type="hidden" data-table="t_pweb" data-field="x_kdhistori" name="o<?php echo $t_pweb_grid->RowIndex ?>_kdhistori" id="o<?php echo $t_pweb_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($t_pweb_grid->kdhistori->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pweb" data-field="x_kdhistori" name="ft_pwebgrid$x<?php echo $t_pweb_grid->RowIndex ?>_kdhistori" id="ft_pwebgrid$x<?php echo $t_pweb_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($t_pweb_grid->kdhistori->FormValue) ?>">
<input type="hidden" data-table="t_pweb" data-field="x_kdhistori" name="ft_pwebgrid$o<?php echo $t_pweb_grid->RowIndex ?>_kdhistori" id="ft_pwebgrid$o<?php echo $t_pweb_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($t_pweb_grid->kdhistori->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pweb_grid->rkwid->Visible) { // rkwid ?>
		<td data-name="rkwid" <?php echo $t_pweb_grid->rkwid->cellAttributes() ?>>
<?php if ($t_pweb->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($t_pweb_grid->rkwid->getSessionValue() != "") { ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_rkwid" class="form-group">
<span<?php echo $t_pweb_grid->rkwid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pweb_grid->rkwid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_pweb_grid->RowIndex ?>_rkwid" name="x<?php echo $t_pweb_grid->RowIndex ?>_rkwid" value="<?php echo HtmlEncode($t_pweb_grid->rkwid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_rkwid" class="form-group">
<?php
$onchange = $t_pweb_grid->rkwid->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pweb_grid->rkwid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_pweb_grid->RowIndex ?>_rkwid">
	<input type="text" class="form-control" name="sv_x<?php echo $t_pweb_grid->RowIndex ?>_rkwid" id="sv_x<?php echo $t_pweb_grid->RowIndex ?>_rkwid" value="<?php echo RemoveHtml($t_pweb_grid->rkwid->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($t_pweb_grid->rkwid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pweb_grid->rkwid->getPlaceHolder()) ?>"<?php echo $t_pweb_grid->rkwid->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_rkwid" data-value-separator="<?php echo $t_pweb_grid->rkwid->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pweb_grid->RowIndex ?>_rkwid" id="x<?php echo $t_pweb_grid->RowIndex ?>_rkwid" value="<?php echo HtmlEncode($t_pweb_grid->rkwid->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pwebgrid"], function() {
	ft_pwebgrid.createAutoSuggest({"id":"x<?php echo $t_pweb_grid->RowIndex ?>_rkwid","forceSelect":false});
});
</script>
<?php echo $t_pweb_grid->rkwid->Lookup->getParamTag($t_pweb_grid, "p_x" . $t_pweb_grid->RowIndex . "_rkwid") ?>
</span>
<?php } ?>
<input type="hidden" data-table="t_pweb" data-field="x_rkwid" name="o<?php echo $t_pweb_grid->RowIndex ?>_rkwid" id="o<?php echo $t_pweb_grid->RowIndex ?>_rkwid" value="<?php echo HtmlEncode($t_pweb_grid->rkwid->OldValue) ?>">
<?php } ?>
<?php if ($t_pweb->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_rkwid" class="form-group">
<span<?php echo $t_pweb_grid->rkwid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pweb_grid->rkwid->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_rkwid" name="x<?php echo $t_pweb_grid->RowIndex ?>_rkwid" id="x<?php echo $t_pweb_grid->RowIndex ?>_rkwid" value="<?php echo HtmlEncode($t_pweb_grid->rkwid->CurrentValue) ?>">
<?php } ?>
<?php if ($t_pweb->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_rkwid">
<span<?php echo $t_pweb_grid->rkwid->viewAttributes() ?>><?php echo $t_pweb_grid->rkwid->getViewValue() ?></span>
</span>
<?php if (!$t_pweb->isConfirm()) { ?>
<input type="hidden" data-table="t_pweb" data-field="x_rkwid" name="x<?php echo $t_pweb_grid->RowIndex ?>_rkwid" id="x<?php echo $t_pweb_grid->RowIndex ?>_rkwid" value="<?php echo HtmlEncode($t_pweb_grid->rkwid->FormValue) ?>">
<input type="hidden" data-table="t_pweb" data-field="x_rkwid" name="o<?php echo $t_pweb_grid->RowIndex ?>_rkwid" id="o<?php echo $t_pweb_grid->RowIndex ?>_rkwid" value="<?php echo HtmlEncode($t_pweb_grid->rkwid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pweb" data-field="x_rkwid" name="ft_pwebgrid$x<?php echo $t_pweb_grid->RowIndex ?>_rkwid" id="ft_pwebgrid$x<?php echo $t_pweb_grid->RowIndex ?>_rkwid" value="<?php echo HtmlEncode($t_pweb_grid->rkwid->FormValue) ?>">
<input type="hidden" data-table="t_pweb" data-field="x_rkwid" name="ft_pwebgrid$o<?php echo $t_pweb_grid->RowIndex ?>_rkwid" id="ft_pwebgrid$o<?php echo $t_pweb_grid->RowIndex ?>_rkwid" value="<?php echo HtmlEncode($t_pweb_grid->rkwid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pweb_grid->id->Visible) { // id ?>
		<td data-name="id" <?php echo $t_pweb_grid->id->cellAttributes() ?>>
<?php if ($t_pweb->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_id" class="form-group">
<?php
$onchange = $t_pweb_grid->id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pweb_grid->id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_pweb_grid->RowIndex ?>_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $t_pweb_grid->RowIndex ?>_id" id="sv_x<?php echo $t_pweb_grid->RowIndex ?>_id" value="<?php echo RemoveHtml($t_pweb_grid->id->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($t_pweb_grid->id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pweb_grid->id->getPlaceHolder()) ?>"<?php echo $t_pweb_grid->id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_pweb_grid->id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $t_pweb_grid->RowIndex ?>_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($t_pweb_grid->id->ReadOnly || $t_pweb_grid->id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_pweb_grid->id->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pweb_grid->RowIndex ?>_id" id="x<?php echo $t_pweb_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_pweb_grid->id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pwebgrid"], function() {
	ft_pwebgrid.createAutoSuggest({"id":"x<?php echo $t_pweb_grid->RowIndex ?>_id","forceSelect":false,"minWidth":"100px","maxHeight":"100px"});
});
</script>
<?php echo $t_pweb_grid->id->Lookup->getParamTag($t_pweb_grid, "p_x" . $t_pweb_grid->RowIndex . "_id") ?>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_id" name="o<?php echo $t_pweb_grid->RowIndex ?>_id" id="o<?php echo $t_pweb_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_pweb_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($t_pweb->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_id" class="form-group">
<?php
$onchange = $t_pweb_grid->id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pweb_grid->id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_pweb_grid->RowIndex ?>_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $t_pweb_grid->RowIndex ?>_id" id="sv_x<?php echo $t_pweb_grid->RowIndex ?>_id" value="<?php echo RemoveHtml($t_pweb_grid->id->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($t_pweb_grid->id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pweb_grid->id->getPlaceHolder()) ?>"<?php echo $t_pweb_grid->id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_pweb_grid->id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $t_pweb_grid->RowIndex ?>_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($t_pweb_grid->id->ReadOnly || $t_pweb_grid->id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_pweb_grid->id->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pweb_grid->RowIndex ?>_id" id="x<?php echo $t_pweb_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_pweb_grid->id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pwebgrid"], function() {
	ft_pwebgrid.createAutoSuggest({"id":"x<?php echo $t_pweb_grid->RowIndex ?>_id","forceSelect":false,"minWidth":"100px","maxHeight":"100px"});
});
</script>
<?php echo $t_pweb_grid->id->Lookup->getParamTag($t_pweb_grid, "p_x" . $t_pweb_grid->RowIndex . "_id") ?>
</span>
<?php } ?>
<?php if ($t_pweb->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_id">
<span<?php echo $t_pweb_grid->id->viewAttributes() ?>><?php echo $t_pweb_grid->id->getViewValue() ?></span>
</span>
<?php if (!$t_pweb->isConfirm()) { ?>
<input type="hidden" data-table="t_pweb" data-field="x_id" name="x<?php echo $t_pweb_grid->RowIndex ?>_id" id="x<?php echo $t_pweb_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_pweb_grid->id->FormValue) ?>">
<input type="hidden" data-table="t_pweb" data-field="x_id" name="o<?php echo $t_pweb_grid->RowIndex ?>_id" id="o<?php echo $t_pweb_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_pweb_grid->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pweb" data-field="x_id" name="ft_pwebgrid$x<?php echo $t_pweb_grid->RowIndex ?>_id" id="ft_pwebgrid$x<?php echo $t_pweb_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_pweb_grid->id->FormValue) ?>">
<input type="hidden" data-table="t_pweb" data-field="x_id" name="ft_pwebgrid$o<?php echo $t_pweb_grid->RowIndex ?>_id" id="ft_pwebgrid$o<?php echo $t_pweb_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_pweb_grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pweb_grid->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $t_pweb_grid->tahun->cellAttributes() ?>>
<?php if ($t_pweb->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($t_pweb_grid->tahun->getSessionValue() != "") { ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_tahun" class="form-group">
<span<?php echo $t_pweb_grid->tahun->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pweb_grid->tahun->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_pweb_grid->RowIndex ?>_tahun" name="x<?php echo $t_pweb_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_pweb_grid->tahun->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_tahun" class="form-group">
<input type="text" data-table="t_pweb" data-field="x_tahun" name="x<?php echo $t_pweb_grid->RowIndex ?>_tahun" id="x<?php echo $t_pweb_grid->RowIndex ?>_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pweb_grid->tahun->getPlaceHolder()) ?>" value="<?php echo $t_pweb_grid->tahun->EditValue ?>"<?php echo $t_pweb_grid->tahun->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="t_pweb" data-field="x_tahun" name="o<?php echo $t_pweb_grid->RowIndex ?>_tahun" id="o<?php echo $t_pweb_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_pweb_grid->tahun->OldValue) ?>">
<?php } ?>
<?php if ($t_pweb->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_tahun" class="form-group">
<span<?php echo $t_pweb_grid->tahun->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pweb_grid->tahun->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_tahun" name="x<?php echo $t_pweb_grid->RowIndex ?>_tahun" id="x<?php echo $t_pweb_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_pweb_grid->tahun->CurrentValue) ?>">
<?php } ?>
<?php if ($t_pweb->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_tahun">
<span<?php echo $t_pweb_grid->tahun->viewAttributes() ?>><?php echo $t_pweb_grid->tahun->getViewValue() ?></span>
</span>
<?php if (!$t_pweb->isConfirm()) { ?>
<input type="hidden" data-table="t_pweb" data-field="x_tahun" name="x<?php echo $t_pweb_grid->RowIndex ?>_tahun" id="x<?php echo $t_pweb_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_pweb_grid->tahun->FormValue) ?>">
<input type="hidden" data-table="t_pweb" data-field="x_tahun" name="o<?php echo $t_pweb_grid->RowIndex ?>_tahun" id="o<?php echo $t_pweb_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_pweb_grid->tahun->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pweb" data-field="x_tahun" name="ft_pwebgrid$x<?php echo $t_pweb_grid->RowIndex ?>_tahun" id="ft_pwebgrid$x<?php echo $t_pweb_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_pweb_grid->tahun->FormValue) ?>">
<input type="hidden" data-table="t_pweb" data-field="x_tahun" name="ft_pwebgrid$o<?php echo $t_pweb_grid->RowIndex ?>_tahun" id="ft_pwebgrid$o<?php echo $t_pweb_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_pweb_grid->tahun->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pweb_grid->kdinformasi->Visible) { // kdinformasi ?>
		<td data-name="kdinformasi" <?php echo $t_pweb_grid->kdinformasi->cellAttributes() ?>>
<?php if ($t_pweb->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_kdinformasi" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pweb" data-field="x_kdinformasi" data-value-separator="<?php echo $t_pweb_grid->kdinformasi->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pweb_grid->RowIndex ?>_kdinformasi" name="x<?php echo $t_pweb_grid->RowIndex ?>_kdinformasi"<?php echo $t_pweb_grid->kdinformasi->editAttributes() ?>>
			<?php echo $t_pweb_grid->kdinformasi->selectOptionListHtml("x{$t_pweb_grid->RowIndex}_kdinformasi") ?>
		</select>
</div>
<?php echo $t_pweb_grid->kdinformasi->Lookup->getParamTag($t_pweb_grid, "p_x" . $t_pweb_grid->RowIndex . "_kdinformasi") ?>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_kdinformasi" name="o<?php echo $t_pweb_grid->RowIndex ?>_kdinformasi" id="o<?php echo $t_pweb_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($t_pweb_grid->kdinformasi->OldValue) ?>">
<?php } ?>
<?php if ($t_pweb->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_kdinformasi" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pweb" data-field="x_kdinformasi" data-value-separator="<?php echo $t_pweb_grid->kdinformasi->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pweb_grid->RowIndex ?>_kdinformasi" name="x<?php echo $t_pweb_grid->RowIndex ?>_kdinformasi"<?php echo $t_pweb_grid->kdinformasi->editAttributes() ?>>
			<?php echo $t_pweb_grid->kdinformasi->selectOptionListHtml("x{$t_pweb_grid->RowIndex}_kdinformasi") ?>
		</select>
</div>
<?php echo $t_pweb_grid->kdinformasi->Lookup->getParamTag($t_pweb_grid, "p_x" . $t_pweb_grid->RowIndex . "_kdinformasi") ?>
</span>
<?php } ?>
<?php if ($t_pweb->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_kdinformasi">
<span<?php echo $t_pweb_grid->kdinformasi->viewAttributes() ?>><?php echo $t_pweb_grid->kdinformasi->getViewValue() ?></span>
</span>
<?php if (!$t_pweb->isConfirm()) { ?>
<input type="hidden" data-table="t_pweb" data-field="x_kdinformasi" name="x<?php echo $t_pweb_grid->RowIndex ?>_kdinformasi" id="x<?php echo $t_pweb_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($t_pweb_grid->kdinformasi->FormValue) ?>">
<input type="hidden" data-table="t_pweb" data-field="x_kdinformasi" name="o<?php echo $t_pweb_grid->RowIndex ?>_kdinformasi" id="o<?php echo $t_pweb_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($t_pweb_grid->kdinformasi->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pweb" data-field="x_kdinformasi" name="ft_pwebgrid$x<?php echo $t_pweb_grid->RowIndex ?>_kdinformasi" id="ft_pwebgrid$x<?php echo $t_pweb_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($t_pweb_grid->kdinformasi->FormValue) ?>">
<input type="hidden" data-table="t_pweb" data-field="x_kdinformasi" name="ft_pwebgrid$o<?php echo $t_pweb_grid->RowIndex ?>_kdinformasi" id="ft_pwebgrid$o<?php echo $t_pweb_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($t_pweb_grid->kdinformasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pweb_grid->harapan->Visible) { // harapan ?>
		<td data-name="harapan" <?php echo $t_pweb_grid->harapan->cellAttributes() ?>>
<?php if ($t_pweb->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_harapan" class="form-group">
<textarea data-table="t_pweb" data-field="x_harapan" name="x<?php echo $t_pweb_grid->RowIndex ?>_harapan" id="x<?php echo $t_pweb_grid->RowIndex ?>_harapan" cols="50" rows="4" placeholder="<?php echo HtmlEncode($t_pweb_grid->harapan->getPlaceHolder()) ?>"<?php echo $t_pweb_grid->harapan->editAttributes() ?>><?php echo $t_pweb_grid->harapan->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_harapan" name="o<?php echo $t_pweb_grid->RowIndex ?>_harapan" id="o<?php echo $t_pweb_grid->RowIndex ?>_harapan" value="<?php echo HtmlEncode($t_pweb_grid->harapan->OldValue) ?>">
<?php } ?>
<?php if ($t_pweb->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_harapan" class="form-group">
<textarea data-table="t_pweb" data-field="x_harapan" name="x<?php echo $t_pweb_grid->RowIndex ?>_harapan" id="x<?php echo $t_pweb_grid->RowIndex ?>_harapan" cols="50" rows="4" placeholder="<?php echo HtmlEncode($t_pweb_grid->harapan->getPlaceHolder()) ?>"<?php echo $t_pweb_grid->harapan->editAttributes() ?>><?php echo $t_pweb_grid->harapan->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t_pweb->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_harapan">
<span<?php echo $t_pweb_grid->harapan->viewAttributes() ?>><?php echo $t_pweb_grid->harapan->getViewValue() ?></span>
</span>
<?php if (!$t_pweb->isConfirm()) { ?>
<input type="hidden" data-table="t_pweb" data-field="x_harapan" name="x<?php echo $t_pweb_grid->RowIndex ?>_harapan" id="x<?php echo $t_pweb_grid->RowIndex ?>_harapan" value="<?php echo HtmlEncode($t_pweb_grid->harapan->FormValue) ?>">
<input type="hidden" data-table="t_pweb" data-field="x_harapan" name="o<?php echo $t_pweb_grid->RowIndex ?>_harapan" id="o<?php echo $t_pweb_grid->RowIndex ?>_harapan" value="<?php echo HtmlEncode($t_pweb_grid->harapan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pweb" data-field="x_harapan" name="ft_pwebgrid$x<?php echo $t_pweb_grid->RowIndex ?>_harapan" id="ft_pwebgrid$x<?php echo $t_pweb_grid->RowIndex ?>_harapan" value="<?php echo HtmlEncode($t_pweb_grid->harapan->FormValue) ?>">
<input type="hidden" data-table="t_pweb" data-field="x_harapan" name="ft_pwebgrid$o<?php echo $t_pweb_grid->RowIndex ?>_harapan" id="ft_pwebgrid$o<?php echo $t_pweb_grid->RowIndex ?>_harapan" value="<?php echo HtmlEncode($t_pweb_grid->harapan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_pweb_grid->sertifikat->Visible) { // sertifikat ?>
		<td data-name="sertifikat" <?php echo $t_pweb_grid->sertifikat->cellAttributes() ?>>
<?php if ($t_pweb->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_sertifikat" class="form-group">
<input type="text" data-table="t_pweb" data-field="x_sertifikat" name="x<?php echo $t_pweb_grid->RowIndex ?>_sertifikat" id="x<?php echo $t_pweb_grid->RowIndex ?>_sertifikat" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pweb_grid->sertifikat->getPlaceHolder()) ?>" value="<?php echo $t_pweb_grid->sertifikat->EditValue ?>"<?php echo $t_pweb_grid->sertifikat->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_sertifikat" name="o<?php echo $t_pweb_grid->RowIndex ?>_sertifikat" id="o<?php echo $t_pweb_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($t_pweb_grid->sertifikat->OldValue) ?>">
<?php } ?>
<?php if ($t_pweb->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_sertifikat" class="form-group">
<input type="text" data-table="t_pweb" data-field="x_sertifikat" name="x<?php echo $t_pweb_grid->RowIndex ?>_sertifikat" id="x<?php echo $t_pweb_grid->RowIndex ?>_sertifikat" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pweb_grid->sertifikat->getPlaceHolder()) ?>" value="<?php echo $t_pweb_grid->sertifikat->EditValue ?>"<?php echo $t_pweb_grid->sertifikat->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_pweb->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_pweb_grid->RowCount ?>_t_pweb_sertifikat">
<span<?php echo $t_pweb_grid->sertifikat->viewAttributes() ?>><?php echo $t_pweb_grid->sertifikat->getViewValue() ?></span>
</span>
<?php if (!$t_pweb->isConfirm()) { ?>
<input type="hidden" data-table="t_pweb" data-field="x_sertifikat" name="x<?php echo $t_pweb_grid->RowIndex ?>_sertifikat" id="x<?php echo $t_pweb_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($t_pweb_grid->sertifikat->FormValue) ?>">
<input type="hidden" data-table="t_pweb" data-field="x_sertifikat" name="o<?php echo $t_pweb_grid->RowIndex ?>_sertifikat" id="o<?php echo $t_pweb_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($t_pweb_grid->sertifikat->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_pweb" data-field="x_sertifikat" name="ft_pwebgrid$x<?php echo $t_pweb_grid->RowIndex ?>_sertifikat" id="ft_pwebgrid$x<?php echo $t_pweb_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($t_pweb_grid->sertifikat->FormValue) ?>">
<input type="hidden" data-table="t_pweb" data-field="x_sertifikat" name="ft_pwebgrid$o<?php echo $t_pweb_grid->RowIndex ?>_sertifikat" id="ft_pwebgrid$o<?php echo $t_pweb_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($t_pweb_grid->sertifikat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_pweb_grid->ListOptions->render("body", "right", $t_pweb_grid->RowCount);
?>
	</tr>
<?php if ($t_pweb->RowType == ROWTYPE_ADD || $t_pweb->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_pwebgrid", "load"], function() {
	ft_pwebgrid.updateLists(<?php echo $t_pweb_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_pweb_grid->isGridAdd() || $t_pweb->CurrentMode == "copy")
		if (!$t_pweb_grid->Recordset->EOF)
			$t_pweb_grid->Recordset->moveNext();
}
?>
<?php
	if ($t_pweb->CurrentMode == "add" || $t_pweb->CurrentMode == "copy" || $t_pweb->CurrentMode == "edit") {
		$t_pweb_grid->RowIndex = '$rowindex$';
		$t_pweb_grid->loadRowValues();

		// Set row properties
		$t_pweb->resetAttributes();
		$t_pweb->RowAttrs->merge(["data-rowindex" => $t_pweb_grid->RowIndex, "id" => "r0_t_pweb", "data-rowtype" => ROWTYPE_ADD]);
		$t_pweb->RowAttrs->appendClass("ew-template");
		$t_pweb->RowType = ROWTYPE_ADD;

		// Render row
		$t_pweb_grid->renderRow();

		// Render list options
		$t_pweb_grid->renderListOptions();
		$t_pweb_grid->StartRowCount = 0;
?>
	<tr <?php echo $t_pweb->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_pweb_grid->ListOptions->render("body", "left", $t_pweb_grid->RowIndex);
?>
	<?php if ($t_pweb_grid->kdhistori->Visible) { // kdhistori ?>
		<td data-name="kdhistori">
<?php if (!$t_pweb->isConfirm()) { ?>
<span id="el$rowindex$_t_pweb_kdhistori" class="form-group t_pweb_kdhistori"></span>
<?php } else { ?>
<span id="el$rowindex$_t_pweb_kdhistori" class="form-group t_pweb_kdhistori">
<span<?php echo $t_pweb_grid->kdhistori->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pweb_grid->kdhistori->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_kdhistori" name="x<?php echo $t_pweb_grid->RowIndex ?>_kdhistori" id="x<?php echo $t_pweb_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($t_pweb_grid->kdhistori->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pweb" data-field="x_kdhistori" name="o<?php echo $t_pweb_grid->RowIndex ?>_kdhistori" id="o<?php echo $t_pweb_grid->RowIndex ?>_kdhistori" value="<?php echo HtmlEncode($t_pweb_grid->kdhistori->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pweb_grid->rkwid->Visible) { // rkwid ?>
		<td data-name="rkwid">
<?php if (!$t_pweb->isConfirm()) { ?>
<?php if ($t_pweb_grid->rkwid->getSessionValue() != "") { ?>
<span id="el$rowindex$_t_pweb_rkwid" class="form-group t_pweb_rkwid">
<span<?php echo $t_pweb_grid->rkwid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pweb_grid->rkwid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_pweb_grid->RowIndex ?>_rkwid" name="x<?php echo $t_pweb_grid->RowIndex ?>_rkwid" value="<?php echo HtmlEncode($t_pweb_grid->rkwid->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_pweb_rkwid" class="form-group t_pweb_rkwid">
<?php
$onchange = $t_pweb_grid->rkwid->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pweb_grid->rkwid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_pweb_grid->RowIndex ?>_rkwid">
	<input type="text" class="form-control" name="sv_x<?php echo $t_pweb_grid->RowIndex ?>_rkwid" id="sv_x<?php echo $t_pweb_grid->RowIndex ?>_rkwid" value="<?php echo RemoveHtml($t_pweb_grid->rkwid->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($t_pweb_grid->rkwid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pweb_grid->rkwid->getPlaceHolder()) ?>"<?php echo $t_pweb_grid->rkwid->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_rkwid" data-value-separator="<?php echo $t_pweb_grid->rkwid->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pweb_grid->RowIndex ?>_rkwid" id="x<?php echo $t_pweb_grid->RowIndex ?>_rkwid" value="<?php echo HtmlEncode($t_pweb_grid->rkwid->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pwebgrid"], function() {
	ft_pwebgrid.createAutoSuggest({"id":"x<?php echo $t_pweb_grid->RowIndex ?>_rkwid","forceSelect":false});
});
</script>
<?php echo $t_pweb_grid->rkwid->Lookup->getParamTag($t_pweb_grid, "p_x" . $t_pweb_grid->RowIndex . "_rkwid") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t_pweb_rkwid" class="form-group t_pweb_rkwid">
<span<?php echo $t_pweb_grid->rkwid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pweb_grid->rkwid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_rkwid" name="x<?php echo $t_pweb_grid->RowIndex ?>_rkwid" id="x<?php echo $t_pweb_grid->RowIndex ?>_rkwid" value="<?php echo HtmlEncode($t_pweb_grid->rkwid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pweb" data-field="x_rkwid" name="o<?php echo $t_pweb_grid->RowIndex ?>_rkwid" id="o<?php echo $t_pweb_grid->RowIndex ?>_rkwid" value="<?php echo HtmlEncode($t_pweb_grid->rkwid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pweb_grid->id->Visible) { // id ?>
		<td data-name="id">
<?php if (!$t_pweb->isConfirm()) { ?>
<span id="el$rowindex$_t_pweb_id" class="form-group t_pweb_id">
<?php
$onchange = $t_pweb_grid->id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pweb_grid->id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_pweb_grid->RowIndex ?>_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $t_pweb_grid->RowIndex ?>_id" id="sv_x<?php echo $t_pweb_grid->RowIndex ?>_id" value="<?php echo RemoveHtml($t_pweb_grid->id->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($t_pweb_grid->id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pweb_grid->id->getPlaceHolder()) ?>"<?php echo $t_pweb_grid->id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_pweb_grid->id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $t_pweb_grid->RowIndex ?>_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($t_pweb_grid->id->ReadOnly || $t_pweb_grid->id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_pweb_grid->id->displayValueSeparatorAttribute() ?>" name="x<?php echo $t_pweb_grid->RowIndex ?>_id" id="x<?php echo $t_pweb_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_pweb_grid->id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pwebgrid"], function() {
	ft_pwebgrid.createAutoSuggest({"id":"x<?php echo $t_pweb_grid->RowIndex ?>_id","forceSelect":false,"minWidth":"100px","maxHeight":"100px"});
});
</script>
<?php echo $t_pweb_grid->id->Lookup->getParamTag($t_pweb_grid, "p_x" . $t_pweb_grid->RowIndex . "_id") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pweb_id" class="form-group t_pweb_id">
<span<?php echo $t_pweb_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pweb_grid->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_id" name="x<?php echo $t_pweb_grid->RowIndex ?>_id" id="x<?php echo $t_pweb_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_pweb_grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pweb" data-field="x_id" name="o<?php echo $t_pweb_grid->RowIndex ?>_id" id="o<?php echo $t_pweb_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_pweb_grid->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pweb_grid->tahun->Visible) { // tahun ?>
		<td data-name="tahun">
<?php if (!$t_pweb->isConfirm()) { ?>
<?php if ($t_pweb_grid->tahun->getSessionValue() != "") { ?>
<span id="el$rowindex$_t_pweb_tahun" class="form-group t_pweb_tahun">
<span<?php echo $t_pweb_grid->tahun->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pweb_grid->tahun->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_pweb_grid->RowIndex ?>_tahun" name="x<?php echo $t_pweb_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_pweb_grid->tahun->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_pweb_tahun" class="form-group t_pweb_tahun">
<input type="text" data-table="t_pweb" data-field="x_tahun" name="x<?php echo $t_pweb_grid->RowIndex ?>_tahun" id="x<?php echo $t_pweb_grid->RowIndex ?>_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pweb_grid->tahun->getPlaceHolder()) ?>" value="<?php echo $t_pweb_grid->tahun->EditValue ?>"<?php echo $t_pweb_grid->tahun->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t_pweb_tahun" class="form-group t_pweb_tahun">
<span<?php echo $t_pweb_grid->tahun->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pweb_grid->tahun->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_tahun" name="x<?php echo $t_pweb_grid->RowIndex ?>_tahun" id="x<?php echo $t_pweb_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_pweb_grid->tahun->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pweb" data-field="x_tahun" name="o<?php echo $t_pweb_grid->RowIndex ?>_tahun" id="o<?php echo $t_pweb_grid->RowIndex ?>_tahun" value="<?php echo HtmlEncode($t_pweb_grid->tahun->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pweb_grid->kdinformasi->Visible) { // kdinformasi ?>
		<td data-name="kdinformasi">
<?php if (!$t_pweb->isConfirm()) { ?>
<span id="el$rowindex$_t_pweb_kdinformasi" class="form-group t_pweb_kdinformasi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pweb" data-field="x_kdinformasi" data-value-separator="<?php echo $t_pweb_grid->kdinformasi->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_pweb_grid->RowIndex ?>_kdinformasi" name="x<?php echo $t_pweb_grid->RowIndex ?>_kdinformasi"<?php echo $t_pweb_grid->kdinformasi->editAttributes() ?>>
			<?php echo $t_pweb_grid->kdinformasi->selectOptionListHtml("x{$t_pweb_grid->RowIndex}_kdinformasi") ?>
		</select>
</div>
<?php echo $t_pweb_grid->kdinformasi->Lookup->getParamTag($t_pweb_grid, "p_x" . $t_pweb_grid->RowIndex . "_kdinformasi") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pweb_kdinformasi" class="form-group t_pweb_kdinformasi">
<span<?php echo $t_pweb_grid->kdinformasi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pweb_grid->kdinformasi->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_kdinformasi" name="x<?php echo $t_pweb_grid->RowIndex ?>_kdinformasi" id="x<?php echo $t_pweb_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($t_pweb_grid->kdinformasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pweb" data-field="x_kdinformasi" name="o<?php echo $t_pweb_grid->RowIndex ?>_kdinformasi" id="o<?php echo $t_pweb_grid->RowIndex ?>_kdinformasi" value="<?php echo HtmlEncode($t_pweb_grid->kdinformasi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pweb_grid->harapan->Visible) { // harapan ?>
		<td data-name="harapan">
<?php if (!$t_pweb->isConfirm()) { ?>
<span id="el$rowindex$_t_pweb_harapan" class="form-group t_pweb_harapan">
<textarea data-table="t_pweb" data-field="x_harapan" name="x<?php echo $t_pweb_grid->RowIndex ?>_harapan" id="x<?php echo $t_pweb_grid->RowIndex ?>_harapan" cols="50" rows="4" placeholder="<?php echo HtmlEncode($t_pweb_grid->harapan->getPlaceHolder()) ?>"<?php echo $t_pweb_grid->harapan->editAttributes() ?>><?php echo $t_pweb_grid->harapan->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pweb_harapan" class="form-group t_pweb_harapan">
<span<?php echo $t_pweb_grid->harapan->viewAttributes() ?>><?php echo $t_pweb_grid->harapan->ViewValue ?></span>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_harapan" name="x<?php echo $t_pweb_grid->RowIndex ?>_harapan" id="x<?php echo $t_pweb_grid->RowIndex ?>_harapan" value="<?php echo HtmlEncode($t_pweb_grid->harapan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pweb" data-field="x_harapan" name="o<?php echo $t_pweb_grid->RowIndex ?>_harapan" id="o<?php echo $t_pweb_grid->RowIndex ?>_harapan" value="<?php echo HtmlEncode($t_pweb_grid->harapan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_pweb_grid->sertifikat->Visible) { // sertifikat ?>
		<td data-name="sertifikat">
<?php if (!$t_pweb->isConfirm()) { ?>
<span id="el$rowindex$_t_pweb_sertifikat" class="form-group t_pweb_sertifikat">
<input type="text" data-table="t_pweb" data-field="x_sertifikat" name="x<?php echo $t_pweb_grid->RowIndex ?>_sertifikat" id="x<?php echo $t_pweb_grid->RowIndex ?>_sertifikat" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pweb_grid->sertifikat->getPlaceHolder()) ?>" value="<?php echo $t_pweb_grid->sertifikat->EditValue ?>"<?php echo $t_pweb_grid->sertifikat->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_pweb_sertifikat" class="form-group t_pweb_sertifikat">
<span<?php echo $t_pweb_grid->sertifikat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pweb_grid->sertifikat->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pweb" data-field="x_sertifikat" name="x<?php echo $t_pweb_grid->RowIndex ?>_sertifikat" id="x<?php echo $t_pweb_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($t_pweb_grid->sertifikat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_pweb" data-field="x_sertifikat" name="o<?php echo $t_pweb_grid->RowIndex ?>_sertifikat" id="o<?php echo $t_pweb_grid->RowIndex ?>_sertifikat" value="<?php echo HtmlEncode($t_pweb_grid->sertifikat->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_pweb_grid->ListOptions->render("body", "right", $t_pweb_grid->RowIndex);
?>
<script>
loadjs.ready(["ft_pwebgrid", "load"], function() {
	ft_pwebgrid.updateLists(<?php echo $t_pweb_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($t_pweb->CurrentMode == "add" || $t_pweb->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $t_pweb_grid->FormKeyCountName ?>" id="<?php echo $t_pweb_grid->FormKeyCountName ?>" value="<?php echo $t_pweb_grid->KeyCount ?>">
<?php echo $t_pweb_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_pweb->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $t_pweb_grid->FormKeyCountName ?>" id="<?php echo $t_pweb_grid->FormKeyCountName ?>" value="<?php echo $t_pweb_grid->KeyCount ?>">
<?php echo $t_pweb_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_pweb->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_pwebgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_pweb_grid->Recordset)
	$t_pweb_grid->Recordset->Close();
?>
<?php if ($t_pweb_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $t_pweb_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_pweb_grid->TotalRecords == 0 && !$t_pweb->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_pweb_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$t_pweb_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$t_pweb_grid->terminate();
?>