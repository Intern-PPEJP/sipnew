<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($t_rwpekerjaan_grid))
	$t_rwpekerjaan_grid = new t_rwpekerjaan_grid();

// Run the page
$t_rwpekerjaan_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rwpekerjaan_grid->Page_Render();
?>
<?php if (!$t_rwpekerjaan_grid->isExport()) { ?>
<script>
var ft_rwpekerjaangrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	ft_rwpekerjaangrid = new ew.Form("ft_rwpekerjaangrid", "grid");
	ft_rwpekerjaangrid.formKeyCountName = '<?php echo $t_rwpekerjaan_grid->FormKeyCountName ?>';

	// Validate form
	ft_rwpekerjaangrid.validate = function() {
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
			<?php if ($t_rwpekerjaan_grid->rwkerjaid->Required) { ?>
				elm = this.getElements("x" + infix + "_rwkerjaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpekerjaan_grid->rwkerjaid->caption(), $t_rwpekerjaan_grid->rwkerjaid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rwpekerjaan_grid->bioid->Required) { ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpekerjaan_grid->bioid->caption(), $t_rwpekerjaan_grid->bioid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rwpekerjaan_grid->bioid->errorMessage()) ?>");
			<?php if ($t_rwpekerjaan_grid->perusahaan->Required) { ?>
				elm = this.getElements("x" + infix + "_perusahaan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpekerjaan_grid->perusahaan->caption(), $t_rwpekerjaan_grid->perusahaan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rwpekerjaan_grid->jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpekerjaan_grid->jabatan->caption(), $t_rwpekerjaan_grid->jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rwpekerjaan_grid->mulai->Required) { ?>
				elm = this.getElements("x" + infix + "_mulai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpekerjaan_grid->mulai->caption(), $t_rwpekerjaan_grid->mulai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_mulai");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rwpekerjaan_grid->mulai->errorMessage()) ?>");
			<?php if ($t_rwpekerjaan_grid->hingga->Required) { ?>
				elm = this.getElements("x" + infix + "_hingga");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rwpekerjaan_grid->hingga->caption(), $t_rwpekerjaan_grid->hingga->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_hingga");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rwpekerjaan_grid->hingga->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	ft_rwpekerjaangrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "bioid", false)) return false;
		if (ew.valueChanged(fobj, infix, "perusahaan", false)) return false;
		if (ew.valueChanged(fobj, infix, "jabatan", false)) return false;
		if (ew.valueChanged(fobj, infix, "mulai", false)) return false;
		if (ew.valueChanged(fobj, infix, "hingga", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_rwpekerjaangrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_rwpekerjaangrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_rwpekerjaangrid");
});
</script>
<?php } ?>
<?php
$t_rwpekerjaan_grid->renderOtherOptions();
?>
<?php if ($t_rwpekerjaan_grid->TotalRecords > 0 || $t_rwpekerjaan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_rwpekerjaan_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_rwpekerjaan">
<?php if ($t_rwpekerjaan_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $t_rwpekerjaan_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ft_rwpekerjaangrid" class="ew-form ew-list-form form-inline">
<div id="gmp_t_rwpekerjaan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_t_rwpekerjaangrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_rwpekerjaan->RowType = ROWTYPE_HEADER;

// Render list options
$t_rwpekerjaan_grid->renderListOptions();

// Render list options (header, left)
$t_rwpekerjaan_grid->ListOptions->render("header", "left");
?>
<?php if ($t_rwpekerjaan_grid->rwkerjaid->Visible) { // rwkerjaid ?>
	<?php if ($t_rwpekerjaan_grid->SortUrl($t_rwpekerjaan_grid->rwkerjaid) == "") { ?>
		<th data-name="rwkerjaid" class="<?php echo $t_rwpekerjaan_grid->rwkerjaid->headerCellClass() ?>"><div id="elh_t_rwpekerjaan_rwkerjaid" class="t_rwpekerjaan_rwkerjaid"><div class="ew-table-header-caption"><?php echo $t_rwpekerjaan_grid->rwkerjaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rwkerjaid" class="<?php echo $t_rwpekerjaan_grid->rwkerjaid->headerCellClass() ?>"><div><div id="elh_t_rwpekerjaan_rwkerjaid" class="t_rwpekerjaan_rwkerjaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwpekerjaan_grid->rwkerjaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwpekerjaan_grid->rwkerjaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwpekerjaan_grid->rwkerjaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwpekerjaan_grid->bioid->Visible) { // bioid ?>
	<?php if ($t_rwpekerjaan_grid->SortUrl($t_rwpekerjaan_grid->bioid) == "") { ?>
		<th data-name="bioid" class="<?php echo $t_rwpekerjaan_grid->bioid->headerCellClass() ?>"><div id="elh_t_rwpekerjaan_bioid" class="t_rwpekerjaan_bioid"><div class="ew-table-header-caption"><?php echo $t_rwpekerjaan_grid->bioid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bioid" class="<?php echo $t_rwpekerjaan_grid->bioid->headerCellClass() ?>"><div><div id="elh_t_rwpekerjaan_bioid" class="t_rwpekerjaan_bioid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwpekerjaan_grid->bioid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwpekerjaan_grid->bioid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwpekerjaan_grid->bioid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwpekerjaan_grid->perusahaan->Visible) { // perusahaan ?>
	<?php if ($t_rwpekerjaan_grid->SortUrl($t_rwpekerjaan_grid->perusahaan) == "") { ?>
		<th data-name="perusahaan" class="<?php echo $t_rwpekerjaan_grid->perusahaan->headerCellClass() ?>"><div id="elh_t_rwpekerjaan_perusahaan" class="t_rwpekerjaan_perusahaan"><div class="ew-table-header-caption"><?php echo $t_rwpekerjaan_grid->perusahaan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="perusahaan" class="<?php echo $t_rwpekerjaan_grid->perusahaan->headerCellClass() ?>"><div><div id="elh_t_rwpekerjaan_perusahaan" class="t_rwpekerjaan_perusahaan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwpekerjaan_grid->perusahaan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwpekerjaan_grid->perusahaan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwpekerjaan_grid->perusahaan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwpekerjaan_grid->jabatan->Visible) { // jabatan ?>
	<?php if ($t_rwpekerjaan_grid->SortUrl($t_rwpekerjaan_grid->jabatan) == "") { ?>
		<th data-name="jabatan" class="<?php echo $t_rwpekerjaan_grid->jabatan->headerCellClass() ?>"><div id="elh_t_rwpekerjaan_jabatan" class="t_rwpekerjaan_jabatan"><div class="ew-table-header-caption"><?php echo $t_rwpekerjaan_grid->jabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan" class="<?php echo $t_rwpekerjaan_grid->jabatan->headerCellClass() ?>"><div><div id="elh_t_rwpekerjaan_jabatan" class="t_rwpekerjaan_jabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwpekerjaan_grid->jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwpekerjaan_grid->jabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwpekerjaan_grid->jabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwpekerjaan_grid->mulai->Visible) { // mulai ?>
	<?php if ($t_rwpekerjaan_grid->SortUrl($t_rwpekerjaan_grid->mulai) == "") { ?>
		<th data-name="mulai" class="<?php echo $t_rwpekerjaan_grid->mulai->headerCellClass() ?>"><div id="elh_t_rwpekerjaan_mulai" class="t_rwpekerjaan_mulai"><div class="ew-table-header-caption"><?php echo $t_rwpekerjaan_grid->mulai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="mulai" class="<?php echo $t_rwpekerjaan_grid->mulai->headerCellClass() ?>"><div><div id="elh_t_rwpekerjaan_mulai" class="t_rwpekerjaan_mulai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwpekerjaan_grid->mulai->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwpekerjaan_grid->mulai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwpekerjaan_grid->mulai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwpekerjaan_grid->hingga->Visible) { // hingga ?>
	<?php if ($t_rwpekerjaan_grid->SortUrl($t_rwpekerjaan_grid->hingga) == "") { ?>
		<th data-name="hingga" class="<?php echo $t_rwpekerjaan_grid->hingga->headerCellClass() ?>"><div id="elh_t_rwpekerjaan_hingga" class="t_rwpekerjaan_hingga"><div class="ew-table-header-caption"><?php echo $t_rwpekerjaan_grid->hingga->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hingga" class="<?php echo $t_rwpekerjaan_grid->hingga->headerCellClass() ?>"><div><div id="elh_t_rwpekerjaan_hingga" class="t_rwpekerjaan_hingga">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwpekerjaan_grid->hingga->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwpekerjaan_grid->hingga->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwpekerjaan_grid->hingga->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_rwpekerjaan_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_rwpekerjaan_grid->StartRecord = 1;
$t_rwpekerjaan_grid->StopRecord = $t_rwpekerjaan_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($t_rwpekerjaan->isConfirm() || $t_rwpekerjaan_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_rwpekerjaan_grid->FormKeyCountName) && ($t_rwpekerjaan_grid->isGridAdd() || $t_rwpekerjaan_grid->isGridEdit() || $t_rwpekerjaan->isConfirm())) {
		$t_rwpekerjaan_grid->KeyCount = $CurrentForm->getValue($t_rwpekerjaan_grid->FormKeyCountName);
		$t_rwpekerjaan_grid->StopRecord = $t_rwpekerjaan_grid->StartRecord + $t_rwpekerjaan_grid->KeyCount - 1;
	}
}
$t_rwpekerjaan_grid->RecordCount = $t_rwpekerjaan_grid->StartRecord - 1;
if ($t_rwpekerjaan_grid->Recordset && !$t_rwpekerjaan_grid->Recordset->EOF) {
	$t_rwpekerjaan_grid->Recordset->moveFirst();
	$selectLimit = $t_rwpekerjaan_grid->UseSelectLimit;
	if (!$selectLimit && $t_rwpekerjaan_grid->StartRecord > 1)
		$t_rwpekerjaan_grid->Recordset->move($t_rwpekerjaan_grid->StartRecord - 1);
} elseif (!$t_rwpekerjaan->AllowAddDeleteRow && $t_rwpekerjaan_grid->StopRecord == 0) {
	$t_rwpekerjaan_grid->StopRecord = $t_rwpekerjaan->GridAddRowCount;
}

// Initialize aggregate
$t_rwpekerjaan->RowType = ROWTYPE_AGGREGATEINIT;
$t_rwpekerjaan->resetAttributes();
$t_rwpekerjaan_grid->renderRow();
if ($t_rwpekerjaan_grid->isGridAdd())
	$t_rwpekerjaan_grid->RowIndex = 0;
if ($t_rwpekerjaan_grid->isGridEdit())
	$t_rwpekerjaan_grid->RowIndex = 0;
while ($t_rwpekerjaan_grid->RecordCount < $t_rwpekerjaan_grid->StopRecord) {
	$t_rwpekerjaan_grid->RecordCount++;
	if ($t_rwpekerjaan_grid->RecordCount >= $t_rwpekerjaan_grid->StartRecord) {
		$t_rwpekerjaan_grid->RowCount++;
		if ($t_rwpekerjaan_grid->isGridAdd() || $t_rwpekerjaan_grid->isGridEdit() || $t_rwpekerjaan->isConfirm()) {
			$t_rwpekerjaan_grid->RowIndex++;
			$CurrentForm->Index = $t_rwpekerjaan_grid->RowIndex;
			if ($CurrentForm->hasValue($t_rwpekerjaan_grid->FormActionName) && ($t_rwpekerjaan->isConfirm() || $t_rwpekerjaan_grid->EventCancelled))
				$t_rwpekerjaan_grid->RowAction = strval($CurrentForm->getValue($t_rwpekerjaan_grid->FormActionName));
			elseif ($t_rwpekerjaan_grid->isGridAdd())
				$t_rwpekerjaan_grid->RowAction = "insert";
			else
				$t_rwpekerjaan_grid->RowAction = "";
		}

		// Set up key count
		$t_rwpekerjaan_grid->KeyCount = $t_rwpekerjaan_grid->RowIndex;

		// Init row class and style
		$t_rwpekerjaan->resetAttributes();
		$t_rwpekerjaan->CssClass = "";
		if ($t_rwpekerjaan_grid->isGridAdd()) {
			if ($t_rwpekerjaan->CurrentMode == "copy") {
				$t_rwpekerjaan_grid->loadRowValues($t_rwpekerjaan_grid->Recordset); // Load row values
				$t_rwpekerjaan_grid->setRecordKey($t_rwpekerjaan_grid->RowOldKey, $t_rwpekerjaan_grid->Recordset); // Set old record key
			} else {
				$t_rwpekerjaan_grid->loadRowValues(); // Load default values
				$t_rwpekerjaan_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_rwpekerjaan_grid->loadRowValues($t_rwpekerjaan_grid->Recordset); // Load row values
		}
		$t_rwpekerjaan->RowType = ROWTYPE_VIEW; // Render view
		if ($t_rwpekerjaan_grid->isGridAdd()) // Grid add
			$t_rwpekerjaan->RowType = ROWTYPE_ADD; // Render add
		if ($t_rwpekerjaan_grid->isGridAdd() && $t_rwpekerjaan->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_rwpekerjaan_grid->restoreCurrentRowFormValues($t_rwpekerjaan_grid->RowIndex); // Restore form values
		if ($t_rwpekerjaan_grid->isGridEdit()) { // Grid edit
			if ($t_rwpekerjaan->EventCancelled)
				$t_rwpekerjaan_grid->restoreCurrentRowFormValues($t_rwpekerjaan_grid->RowIndex); // Restore form values
			if ($t_rwpekerjaan_grid->RowAction == "insert")
				$t_rwpekerjaan->RowType = ROWTYPE_ADD; // Render add
			else
				$t_rwpekerjaan->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_rwpekerjaan_grid->isGridEdit() && ($t_rwpekerjaan->RowType == ROWTYPE_EDIT || $t_rwpekerjaan->RowType == ROWTYPE_ADD) && $t_rwpekerjaan->EventCancelled) // Update failed
			$t_rwpekerjaan_grid->restoreCurrentRowFormValues($t_rwpekerjaan_grid->RowIndex); // Restore form values
		if ($t_rwpekerjaan->RowType == ROWTYPE_EDIT) // Edit row
			$t_rwpekerjaan_grid->EditRowCount++;
		if ($t_rwpekerjaan->isConfirm()) // Confirm row
			$t_rwpekerjaan_grid->restoreCurrentRowFormValues($t_rwpekerjaan_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_rwpekerjaan->RowAttrs->merge(["data-rowindex" => $t_rwpekerjaan_grid->RowCount, "id" => "r" . $t_rwpekerjaan_grid->RowCount . "_t_rwpekerjaan", "data-rowtype" => $t_rwpekerjaan->RowType]);

		// Render row
		$t_rwpekerjaan_grid->renderRow();

		// Render list options
		$t_rwpekerjaan_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_rwpekerjaan_grid->RowAction != "delete" && $t_rwpekerjaan_grid->RowAction != "insertdelete" && !($t_rwpekerjaan_grid->RowAction == "insert" && $t_rwpekerjaan->isConfirm() && $t_rwpekerjaan_grid->emptyRow())) {
?>
	<tr <?php echo $t_rwpekerjaan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_rwpekerjaan_grid->ListOptions->render("body", "left", $t_rwpekerjaan_grid->RowCount);
?>
	<?php if ($t_rwpekerjaan_grid->rwkerjaid->Visible) { // rwkerjaid ?>
		<td data-name="rwkerjaid" <?php echo $t_rwpekerjaan_grid->rwkerjaid->cellAttributes() ?>>
<?php if ($t_rwpekerjaan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_rwpekerjaan_grid->RowCount ?>_t_rwpekerjaan_rwkerjaid" class="form-group"></span>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_rwkerjaid" name="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_rwkerjaid" id="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_rwkerjaid" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->rwkerjaid->OldValue) ?>">
<?php } ?>
<?php if ($t_rwpekerjaan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_rwpekerjaan_grid->RowCount ?>_t_rwpekerjaan_rwkerjaid" class="form-group">
<span<?php echo $t_rwpekerjaan_grid->rwkerjaid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwpekerjaan_grid->rwkerjaid->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_rwkerjaid" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_rwkerjaid" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_rwkerjaid" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->rwkerjaid->CurrentValue) ?>">
<?php } ?>
<?php if ($t_rwpekerjaan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_rwpekerjaan_grid->RowCount ?>_t_rwpekerjaan_rwkerjaid">
<span<?php echo $t_rwpekerjaan_grid->rwkerjaid->viewAttributes() ?>><?php echo $t_rwpekerjaan_grid->rwkerjaid->getViewValue() ?></span>
</span>
<?php if (!$t_rwpekerjaan->isConfirm()) { ?>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_rwkerjaid" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_rwkerjaid" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_rwkerjaid" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->rwkerjaid->FormValue) ?>">
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_rwkerjaid" name="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_rwkerjaid" id="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_rwkerjaid" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->rwkerjaid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_rwkerjaid" name="ft_rwpekerjaangrid$x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_rwkerjaid" id="ft_rwpekerjaangrid$x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_rwkerjaid" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->rwkerjaid->FormValue) ?>">
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_rwkerjaid" name="ft_rwpekerjaangrid$o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_rwkerjaid" id="ft_rwpekerjaangrid$o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_rwkerjaid" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->rwkerjaid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_rwpekerjaan_grid->bioid->Visible) { // bioid ?>
		<td data-name="bioid" <?php echo $t_rwpekerjaan_grid->bioid->cellAttributes() ?>>
<?php if ($t_rwpekerjaan->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($t_rwpekerjaan_grid->bioid->getSessionValue() != "") { ?>
<span id="el<?php echo $t_rwpekerjaan_grid->RowCount ?>_t_rwpekerjaan_bioid" class="form-group">
<span<?php echo $t_rwpekerjaan_grid->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwpekerjaan_grid->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->bioid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_rwpekerjaan_grid->RowCount ?>_t_rwpekerjaan_bioid" class="form-group">
<input type="text" data-table="t_rwpekerjaan" data-field="x_bioid" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" size="30" placeholder="<?php echo HtmlEncode($t_rwpekerjaan_grid->bioid->getPlaceHolder()) ?>" value="<?php echo $t_rwpekerjaan_grid->bioid->EditValue ?>"<?php echo $t_rwpekerjaan_grid->bioid->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_bioid" name="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" id="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->bioid->OldValue) ?>">
<?php } ?>
<?php if ($t_rwpekerjaan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t_rwpekerjaan_grid->bioid->getSessionValue() != "") { ?>
<span id="el<?php echo $t_rwpekerjaan_grid->RowCount ?>_t_rwpekerjaan_bioid" class="form-group">
<span<?php echo $t_rwpekerjaan_grid->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwpekerjaan_grid->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->bioid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_rwpekerjaan_grid->RowCount ?>_t_rwpekerjaan_bioid" class="form-group">
<input type="text" data-table="t_rwpekerjaan" data-field="x_bioid" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" size="30" placeholder="<?php echo HtmlEncode($t_rwpekerjaan_grid->bioid->getPlaceHolder()) ?>" value="<?php echo $t_rwpekerjaan_grid->bioid->EditValue ?>"<?php echo $t_rwpekerjaan_grid->bioid->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($t_rwpekerjaan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_rwpekerjaan_grid->RowCount ?>_t_rwpekerjaan_bioid">
<span<?php echo $t_rwpekerjaan_grid->bioid->viewAttributes() ?>><?php echo $t_rwpekerjaan_grid->bioid->getViewValue() ?></span>
</span>
<?php if (!$t_rwpekerjaan->isConfirm()) { ?>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_bioid" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->bioid->FormValue) ?>">
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_bioid" name="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" id="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->bioid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_bioid" name="ft_rwpekerjaangrid$x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" id="ft_rwpekerjaangrid$x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->bioid->FormValue) ?>">
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_bioid" name="ft_rwpekerjaangrid$o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" id="ft_rwpekerjaangrid$o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->bioid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_rwpekerjaan_grid->perusahaan->Visible) { // perusahaan ?>
		<td data-name="perusahaan" <?php echo $t_rwpekerjaan_grid->perusahaan->cellAttributes() ?>>
<?php if ($t_rwpekerjaan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_rwpekerjaan_grid->RowCount ?>_t_rwpekerjaan_perusahaan" class="form-group">
<input type="text" data-table="t_rwpekerjaan" data-field="x_perusahaan" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_perusahaan" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_perusahaan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_rwpekerjaan_grid->perusahaan->getPlaceHolder()) ?>" value="<?php echo $t_rwpekerjaan_grid->perusahaan->EditValue ?>"<?php echo $t_rwpekerjaan_grid->perusahaan->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_perusahaan" name="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_perusahaan" id="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_perusahaan" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->perusahaan->OldValue) ?>">
<?php } ?>
<?php if ($t_rwpekerjaan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_rwpekerjaan_grid->RowCount ?>_t_rwpekerjaan_perusahaan" class="form-group">
<input type="text" data-table="t_rwpekerjaan" data-field="x_perusahaan" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_perusahaan" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_perusahaan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_rwpekerjaan_grid->perusahaan->getPlaceHolder()) ?>" value="<?php echo $t_rwpekerjaan_grid->perusahaan->EditValue ?>"<?php echo $t_rwpekerjaan_grid->perusahaan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_rwpekerjaan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_rwpekerjaan_grid->RowCount ?>_t_rwpekerjaan_perusahaan">
<span<?php echo $t_rwpekerjaan_grid->perusahaan->viewAttributes() ?>><?php echo $t_rwpekerjaan_grid->perusahaan->getViewValue() ?></span>
</span>
<?php if (!$t_rwpekerjaan->isConfirm()) { ?>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_perusahaan" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_perusahaan" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_perusahaan" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->perusahaan->FormValue) ?>">
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_perusahaan" name="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_perusahaan" id="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_perusahaan" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->perusahaan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_perusahaan" name="ft_rwpekerjaangrid$x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_perusahaan" id="ft_rwpekerjaangrid$x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_perusahaan" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->perusahaan->FormValue) ?>">
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_perusahaan" name="ft_rwpekerjaangrid$o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_perusahaan" id="ft_rwpekerjaangrid$o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_perusahaan" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->perusahaan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_rwpekerjaan_grid->jabatan->Visible) { // jabatan ?>
		<td data-name="jabatan" <?php echo $t_rwpekerjaan_grid->jabatan->cellAttributes() ?>>
<?php if ($t_rwpekerjaan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_rwpekerjaan_grid->RowCount ?>_t_rwpekerjaan_jabatan" class="form-group">
<input type="text" data-table="t_rwpekerjaan" data-field="x_jabatan" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_jabatan" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_jabatan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_rwpekerjaan_grid->jabatan->getPlaceHolder()) ?>" value="<?php echo $t_rwpekerjaan_grid->jabatan->EditValue ?>"<?php echo $t_rwpekerjaan_grid->jabatan->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_jabatan" name="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_jabatan" id="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_jabatan" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->jabatan->OldValue) ?>">
<?php } ?>
<?php if ($t_rwpekerjaan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_rwpekerjaan_grid->RowCount ?>_t_rwpekerjaan_jabatan" class="form-group">
<input type="text" data-table="t_rwpekerjaan" data-field="x_jabatan" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_jabatan" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_jabatan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_rwpekerjaan_grid->jabatan->getPlaceHolder()) ?>" value="<?php echo $t_rwpekerjaan_grid->jabatan->EditValue ?>"<?php echo $t_rwpekerjaan_grid->jabatan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_rwpekerjaan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_rwpekerjaan_grid->RowCount ?>_t_rwpekerjaan_jabatan">
<span<?php echo $t_rwpekerjaan_grid->jabatan->viewAttributes() ?>><?php echo $t_rwpekerjaan_grid->jabatan->getViewValue() ?></span>
</span>
<?php if (!$t_rwpekerjaan->isConfirm()) { ?>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_jabatan" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_jabatan" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_jabatan" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->jabatan->FormValue) ?>">
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_jabatan" name="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_jabatan" id="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_jabatan" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->jabatan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_jabatan" name="ft_rwpekerjaangrid$x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_jabatan" id="ft_rwpekerjaangrid$x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_jabatan" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->jabatan->FormValue) ?>">
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_jabatan" name="ft_rwpekerjaangrid$o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_jabatan" id="ft_rwpekerjaangrid$o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_jabatan" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->jabatan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_rwpekerjaan_grid->mulai->Visible) { // mulai ?>
		<td data-name="mulai" <?php echo $t_rwpekerjaan_grid->mulai->cellAttributes() ?>>
<?php if ($t_rwpekerjaan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_rwpekerjaan_grid->RowCount ?>_t_rwpekerjaan_mulai" class="form-group">
<input type="text" data-table="t_rwpekerjaan" data-field="x_mulai" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_mulai" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_mulai" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_rwpekerjaan_grid->mulai->getPlaceHolder()) ?>" value="<?php echo $t_rwpekerjaan_grid->mulai->EditValue ?>"<?php echo $t_rwpekerjaan_grid->mulai->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_mulai" name="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_mulai" id="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_mulai" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->mulai->OldValue) ?>">
<?php } ?>
<?php if ($t_rwpekerjaan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_rwpekerjaan_grid->RowCount ?>_t_rwpekerjaan_mulai" class="form-group">
<input type="text" data-table="t_rwpekerjaan" data-field="x_mulai" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_mulai" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_mulai" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_rwpekerjaan_grid->mulai->getPlaceHolder()) ?>" value="<?php echo $t_rwpekerjaan_grid->mulai->EditValue ?>"<?php echo $t_rwpekerjaan_grid->mulai->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_rwpekerjaan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_rwpekerjaan_grid->RowCount ?>_t_rwpekerjaan_mulai">
<span<?php echo $t_rwpekerjaan_grid->mulai->viewAttributes() ?>><?php echo $t_rwpekerjaan_grid->mulai->getViewValue() ?></span>
</span>
<?php if (!$t_rwpekerjaan->isConfirm()) { ?>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_mulai" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_mulai" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_mulai" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->mulai->FormValue) ?>">
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_mulai" name="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_mulai" id="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_mulai" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->mulai->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_mulai" name="ft_rwpekerjaangrid$x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_mulai" id="ft_rwpekerjaangrid$x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_mulai" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->mulai->FormValue) ?>">
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_mulai" name="ft_rwpekerjaangrid$o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_mulai" id="ft_rwpekerjaangrid$o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_mulai" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->mulai->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_rwpekerjaan_grid->hingga->Visible) { // hingga ?>
		<td data-name="hingga" <?php echo $t_rwpekerjaan_grid->hingga->cellAttributes() ?>>
<?php if ($t_rwpekerjaan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_rwpekerjaan_grid->RowCount ?>_t_rwpekerjaan_hingga" class="form-group">
<input type="text" data-table="t_rwpekerjaan" data-field="x_hingga" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_hingga" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_hingga" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_rwpekerjaan_grid->hingga->getPlaceHolder()) ?>" value="<?php echo $t_rwpekerjaan_grid->hingga->EditValue ?>"<?php echo $t_rwpekerjaan_grid->hingga->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_hingga" name="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_hingga" id="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_hingga" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->hingga->OldValue) ?>">
<?php } ?>
<?php if ($t_rwpekerjaan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_rwpekerjaan_grid->RowCount ?>_t_rwpekerjaan_hingga" class="form-group">
<input type="text" data-table="t_rwpekerjaan" data-field="x_hingga" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_hingga" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_hingga" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_rwpekerjaan_grid->hingga->getPlaceHolder()) ?>" value="<?php echo $t_rwpekerjaan_grid->hingga->EditValue ?>"<?php echo $t_rwpekerjaan_grid->hingga->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_rwpekerjaan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_rwpekerjaan_grid->RowCount ?>_t_rwpekerjaan_hingga">
<span<?php echo $t_rwpekerjaan_grid->hingga->viewAttributes() ?>><?php echo $t_rwpekerjaan_grid->hingga->getViewValue() ?></span>
</span>
<?php if (!$t_rwpekerjaan->isConfirm()) { ?>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_hingga" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_hingga" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_hingga" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->hingga->FormValue) ?>">
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_hingga" name="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_hingga" id="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_hingga" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->hingga->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_hingga" name="ft_rwpekerjaangrid$x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_hingga" id="ft_rwpekerjaangrid$x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_hingga" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->hingga->FormValue) ?>">
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_hingga" name="ft_rwpekerjaangrid$o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_hingga" id="ft_rwpekerjaangrid$o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_hingga" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->hingga->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_rwpekerjaan_grid->ListOptions->render("body", "right", $t_rwpekerjaan_grid->RowCount);
?>
	</tr>
<?php if ($t_rwpekerjaan->RowType == ROWTYPE_ADD || $t_rwpekerjaan->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_rwpekerjaangrid", "load"], function() {
	ft_rwpekerjaangrid.updateLists(<?php echo $t_rwpekerjaan_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_rwpekerjaan_grid->isGridAdd() || $t_rwpekerjaan->CurrentMode == "copy")
		if (!$t_rwpekerjaan_grid->Recordset->EOF)
			$t_rwpekerjaan_grid->Recordset->moveNext();
}
?>
<?php
	if ($t_rwpekerjaan->CurrentMode == "add" || $t_rwpekerjaan->CurrentMode == "copy" || $t_rwpekerjaan->CurrentMode == "edit") {
		$t_rwpekerjaan_grid->RowIndex = '$rowindex$';
		$t_rwpekerjaan_grid->loadRowValues();

		// Set row properties
		$t_rwpekerjaan->resetAttributes();
		$t_rwpekerjaan->RowAttrs->merge(["data-rowindex" => $t_rwpekerjaan_grid->RowIndex, "id" => "r0_t_rwpekerjaan", "data-rowtype" => ROWTYPE_ADD]);
		$t_rwpekerjaan->RowAttrs->appendClass("ew-template");
		$t_rwpekerjaan->RowType = ROWTYPE_ADD;

		// Render row
		$t_rwpekerjaan_grid->renderRow();

		// Render list options
		$t_rwpekerjaan_grid->renderListOptions();
		$t_rwpekerjaan_grid->StartRowCount = 0;
?>
	<tr <?php echo $t_rwpekerjaan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_rwpekerjaan_grid->ListOptions->render("body", "left", $t_rwpekerjaan_grid->RowIndex);
?>
	<?php if ($t_rwpekerjaan_grid->rwkerjaid->Visible) { // rwkerjaid ?>
		<td data-name="rwkerjaid">
<?php if (!$t_rwpekerjaan->isConfirm()) { ?>
<span id="el$rowindex$_t_rwpekerjaan_rwkerjaid" class="form-group t_rwpekerjaan_rwkerjaid"></span>
<?php } else { ?>
<span id="el$rowindex$_t_rwpekerjaan_rwkerjaid" class="form-group t_rwpekerjaan_rwkerjaid">
<span<?php echo $t_rwpekerjaan_grid->rwkerjaid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwpekerjaan_grid->rwkerjaid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_rwkerjaid" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_rwkerjaid" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_rwkerjaid" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->rwkerjaid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_rwkerjaid" name="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_rwkerjaid" id="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_rwkerjaid" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->rwkerjaid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_rwpekerjaan_grid->bioid->Visible) { // bioid ?>
		<td data-name="bioid">
<?php if (!$t_rwpekerjaan->isConfirm()) { ?>
<?php if ($t_rwpekerjaan_grid->bioid->getSessionValue() != "") { ?>
<span id="el$rowindex$_t_rwpekerjaan_bioid" class="form-group t_rwpekerjaan_bioid">
<span<?php echo $t_rwpekerjaan_grid->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwpekerjaan_grid->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->bioid->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_rwpekerjaan_bioid" class="form-group t_rwpekerjaan_bioid">
<input type="text" data-table="t_rwpekerjaan" data-field="x_bioid" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" size="30" placeholder="<?php echo HtmlEncode($t_rwpekerjaan_grid->bioid->getPlaceHolder()) ?>" value="<?php echo $t_rwpekerjaan_grid->bioid->EditValue ?>"<?php echo $t_rwpekerjaan_grid->bioid->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t_rwpekerjaan_bioid" class="form-group t_rwpekerjaan_bioid">
<span<?php echo $t_rwpekerjaan_grid->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwpekerjaan_grid->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_bioid" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->bioid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_bioid" name="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" id="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_bioid" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->bioid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_rwpekerjaan_grid->perusahaan->Visible) { // perusahaan ?>
		<td data-name="perusahaan">
<?php if (!$t_rwpekerjaan->isConfirm()) { ?>
<span id="el$rowindex$_t_rwpekerjaan_perusahaan" class="form-group t_rwpekerjaan_perusahaan">
<input type="text" data-table="t_rwpekerjaan" data-field="x_perusahaan" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_perusahaan" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_perusahaan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_rwpekerjaan_grid->perusahaan->getPlaceHolder()) ?>" value="<?php echo $t_rwpekerjaan_grid->perusahaan->EditValue ?>"<?php echo $t_rwpekerjaan_grid->perusahaan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_rwpekerjaan_perusahaan" class="form-group t_rwpekerjaan_perusahaan">
<span<?php echo $t_rwpekerjaan_grid->perusahaan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwpekerjaan_grid->perusahaan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_perusahaan" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_perusahaan" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_perusahaan" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->perusahaan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_perusahaan" name="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_perusahaan" id="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_perusahaan" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->perusahaan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_rwpekerjaan_grid->jabatan->Visible) { // jabatan ?>
		<td data-name="jabatan">
<?php if (!$t_rwpekerjaan->isConfirm()) { ?>
<span id="el$rowindex$_t_rwpekerjaan_jabatan" class="form-group t_rwpekerjaan_jabatan">
<input type="text" data-table="t_rwpekerjaan" data-field="x_jabatan" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_jabatan" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_jabatan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_rwpekerjaan_grid->jabatan->getPlaceHolder()) ?>" value="<?php echo $t_rwpekerjaan_grid->jabatan->EditValue ?>"<?php echo $t_rwpekerjaan_grid->jabatan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_rwpekerjaan_jabatan" class="form-group t_rwpekerjaan_jabatan">
<span<?php echo $t_rwpekerjaan_grid->jabatan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwpekerjaan_grid->jabatan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_jabatan" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_jabatan" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_jabatan" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->jabatan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_jabatan" name="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_jabatan" id="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_jabatan" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->jabatan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_rwpekerjaan_grid->mulai->Visible) { // mulai ?>
		<td data-name="mulai">
<?php if (!$t_rwpekerjaan->isConfirm()) { ?>
<span id="el$rowindex$_t_rwpekerjaan_mulai" class="form-group t_rwpekerjaan_mulai">
<input type="text" data-table="t_rwpekerjaan" data-field="x_mulai" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_mulai" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_mulai" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_rwpekerjaan_grid->mulai->getPlaceHolder()) ?>" value="<?php echo $t_rwpekerjaan_grid->mulai->EditValue ?>"<?php echo $t_rwpekerjaan_grid->mulai->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_rwpekerjaan_mulai" class="form-group t_rwpekerjaan_mulai">
<span<?php echo $t_rwpekerjaan_grid->mulai->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwpekerjaan_grid->mulai->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_mulai" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_mulai" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_mulai" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->mulai->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_mulai" name="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_mulai" id="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_mulai" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->mulai->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_rwpekerjaan_grid->hingga->Visible) { // hingga ?>
		<td data-name="hingga">
<?php if (!$t_rwpekerjaan->isConfirm()) { ?>
<span id="el$rowindex$_t_rwpekerjaan_hingga" class="form-group t_rwpekerjaan_hingga">
<input type="text" data-table="t_rwpekerjaan" data-field="x_hingga" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_hingga" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_hingga" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_rwpekerjaan_grid->hingga->getPlaceHolder()) ?>" value="<?php echo $t_rwpekerjaan_grid->hingga->EditValue ?>"<?php echo $t_rwpekerjaan_grid->hingga->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_rwpekerjaan_hingga" class="form-group t_rwpekerjaan_hingga">
<span<?php echo $t_rwpekerjaan_grid->hingga->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rwpekerjaan_grid->hingga->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_hingga" name="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_hingga" id="x<?php echo $t_rwpekerjaan_grid->RowIndex ?>_hingga" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->hingga->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_rwpekerjaan" data-field="x_hingga" name="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_hingga" id="o<?php echo $t_rwpekerjaan_grid->RowIndex ?>_hingga" value="<?php echo HtmlEncode($t_rwpekerjaan_grid->hingga->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_rwpekerjaan_grid->ListOptions->render("body", "right", $t_rwpekerjaan_grid->RowIndex);
?>
<script>
loadjs.ready(["ft_rwpekerjaangrid", "load"], function() {
	ft_rwpekerjaangrid.updateLists(<?php echo $t_rwpekerjaan_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($t_rwpekerjaan->CurrentMode == "add" || $t_rwpekerjaan->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $t_rwpekerjaan_grid->FormKeyCountName ?>" id="<?php echo $t_rwpekerjaan_grid->FormKeyCountName ?>" value="<?php echo $t_rwpekerjaan_grid->KeyCount ?>">
<?php echo $t_rwpekerjaan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_rwpekerjaan->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $t_rwpekerjaan_grid->FormKeyCountName ?>" id="<?php echo $t_rwpekerjaan_grid->FormKeyCountName ?>" value="<?php echo $t_rwpekerjaan_grid->KeyCount ?>">
<?php echo $t_rwpekerjaan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_rwpekerjaan->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_rwpekerjaangrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_rwpekerjaan_grid->Recordset)
	$t_rwpekerjaan_grid->Recordset->Close();
?>
<?php if ($t_rwpekerjaan_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $t_rwpekerjaan_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_rwpekerjaan_grid->TotalRecords == 0 && !$t_rwpekerjaan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_rwpekerjaan_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$t_rwpekerjaan_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$t_rwpekerjaan_grid->terminate();
?>