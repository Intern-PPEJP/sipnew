<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($cv_rwipelatihaninstruktur_grid))
	$cv_rwipelatihaninstruktur_grid = new cv_rwipelatihaninstruktur_grid();

// Run the page
$cv_rwipelatihaninstruktur_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cv_rwipelatihaninstruktur_grid->Page_Render();
?>
<?php if (!$cv_rwipelatihaninstruktur_grid->isExport()) { ?>
<script>
var fcv_rwipelatihaninstrukturgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fcv_rwipelatihaninstrukturgrid = new ew.Form("fcv_rwipelatihaninstrukturgrid", "grid");
	fcv_rwipelatihaninstrukturgrid.formKeyCountName = '<?php echo $cv_rwipelatihaninstruktur_grid->FormKeyCountName ?>';

	// Validate form
	fcv_rwipelatihaninstrukturgrid.validate = function() {
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
			<?php if ($cv_rwipelatihaninstruktur_grid->kurikulum->Required) { ?>
				elm = this.getElements("x" + infix + "_kurikulum");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_rwipelatihaninstruktur_grid->kurikulum->caption(), $cv_rwipelatihaninstruktur_grid->kurikulum->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_rwipelatihaninstruktur_grid->kdjudul->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjudul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_rwipelatihaninstruktur_grid->kdjudul->caption(), $cv_rwipelatihaninstruktur_grid->kdjudul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_rwipelatihaninstruktur_grid->tawal->Required) { ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_rwipelatihaninstruktur_grid->tawal->caption(), $cv_rwipelatihaninstruktur_grid->tawal->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_rwipelatihaninstruktur_grid->takhir->Required) { ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_rwipelatihaninstruktur_grid->takhir->caption(), $cv_rwipelatihaninstruktur_grid->takhir->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_rwipelatihaninstruktur_grid->kdprop->Required) { ?>
				elm = this.getElements("x" + infix + "_kdprop");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_rwipelatihaninstruktur_grid->kdprop->caption(), $cv_rwipelatihaninstruktur_grid->kdprop->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_rwipelatihaninstruktur_grid->kdkota->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkota");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_rwipelatihaninstruktur_grid->kdkota->caption(), $cv_rwipelatihaninstruktur_grid->kdkota->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fcv_rwipelatihaninstrukturgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "kurikulum", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdjudul", false)) return false;
		if (ew.valueChanged(fobj, infix, "tawal", false)) return false;
		if (ew.valueChanged(fobj, infix, "takhir", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdprop", false)) return false;
		if (ew.valueChanged(fobj, infix, "kdkota", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fcv_rwipelatihaninstrukturgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcv_rwipelatihaninstrukturgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcv_rwipelatihaninstrukturgrid.lists["x_kdjudul"] = <?php echo $cv_rwipelatihaninstruktur_grid->kdjudul->Lookup->toClientList($cv_rwipelatihaninstruktur_grid) ?>;
	fcv_rwipelatihaninstrukturgrid.lists["x_kdjudul"].options = <?php echo JsonEncode($cv_rwipelatihaninstruktur_grid->kdjudul->lookupOptions()) ?>;
	fcv_rwipelatihaninstrukturgrid.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcv_rwipelatihaninstrukturgrid.lists["x_kdprop"] = <?php echo $cv_rwipelatihaninstruktur_grid->kdprop->Lookup->toClientList($cv_rwipelatihaninstruktur_grid) ?>;
	fcv_rwipelatihaninstrukturgrid.lists["x_kdprop"].options = <?php echo JsonEncode($cv_rwipelatihaninstruktur_grid->kdprop->lookupOptions()) ?>;
	fcv_rwipelatihaninstrukturgrid.lists["x_kdkota"] = <?php echo $cv_rwipelatihaninstruktur_grid->kdkota->Lookup->toClientList($cv_rwipelatihaninstruktur_grid) ?>;
	fcv_rwipelatihaninstrukturgrid.lists["x_kdkota"].options = <?php echo JsonEncode($cv_rwipelatihaninstruktur_grid->kdkota->lookupOptions()) ?>;
	loadjs.done("fcv_rwipelatihaninstrukturgrid");
});
</script>
<?php } ?>
<?php
$cv_rwipelatihaninstruktur_grid->renderOtherOptions();
?>
<?php if ($cv_rwipelatihaninstruktur_grid->TotalRecords > 0 || $cv_rwipelatihaninstruktur->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cv_rwipelatihaninstruktur_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cv_rwipelatihaninstruktur">
<?php if ($cv_rwipelatihaninstruktur_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $cv_rwipelatihaninstruktur_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fcv_rwipelatihaninstrukturgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_cv_rwipelatihaninstruktur" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_cv_rwipelatihaninstrukturgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cv_rwipelatihaninstruktur->RowType = ROWTYPE_HEADER;

// Render list options
$cv_rwipelatihaninstruktur_grid->renderListOptions();

// Render list options (header, left)
$cv_rwipelatihaninstruktur_grid->ListOptions->render("header", "left");
?>
<?php if ($cv_rwipelatihaninstruktur_grid->kurikulum->Visible) { // kurikulum ?>
	<?php if ($cv_rwipelatihaninstruktur_grid->SortUrl($cv_rwipelatihaninstruktur_grid->kurikulum) == "") { ?>
		<th data-name="kurikulum" class="<?php echo $cv_rwipelatihaninstruktur_grid->kurikulum->headerCellClass() ?>"><div id="elh_cv_rwipelatihaninstruktur_kurikulum" class="cv_rwipelatihaninstruktur_kurikulum"><div class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_grid->kurikulum->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kurikulum" class="<?php echo $cv_rwipelatihaninstruktur_grid->kurikulum->headerCellClass() ?>"><div><div id="elh_cv_rwipelatihaninstruktur_kurikulum" class="cv_rwipelatihaninstruktur_kurikulum">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_grid->kurikulum->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_rwipelatihaninstruktur_grid->kurikulum->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_rwipelatihaninstruktur_grid->kurikulum->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur_grid->kdjudul->Visible) { // kdjudul ?>
	<?php if ($cv_rwipelatihaninstruktur_grid->SortUrl($cv_rwipelatihaninstruktur_grid->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $cv_rwipelatihaninstruktur_grid->kdjudul->headerCellClass() ?>"><div id="elh_cv_rwipelatihaninstruktur_kdjudul" class="cv_rwipelatihaninstruktur_kdjudul"><div class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_grid->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $cv_rwipelatihaninstruktur_grid->kdjudul->headerCellClass() ?>"><div><div id="elh_cv_rwipelatihaninstruktur_kdjudul" class="cv_rwipelatihaninstruktur_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_grid->kdjudul->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_rwipelatihaninstruktur_grid->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_rwipelatihaninstruktur_grid->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur_grid->tawal->Visible) { // tawal ?>
	<?php if ($cv_rwipelatihaninstruktur_grid->SortUrl($cv_rwipelatihaninstruktur_grid->tawal) == "") { ?>
		<th data-name="tawal" class="<?php echo $cv_rwipelatihaninstruktur_grid->tawal->headerCellClass() ?>"><div id="elh_cv_rwipelatihaninstruktur_tawal" class="cv_rwipelatihaninstruktur_tawal"><div class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_grid->tawal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tawal" class="<?php echo $cv_rwipelatihaninstruktur_grid->tawal->headerCellClass() ?>"><div><div id="elh_cv_rwipelatihaninstruktur_tawal" class="cv_rwipelatihaninstruktur_tawal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_grid->tawal->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_rwipelatihaninstruktur_grid->tawal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_rwipelatihaninstruktur_grid->tawal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur_grid->takhir->Visible) { // takhir ?>
	<?php if ($cv_rwipelatihaninstruktur_grid->SortUrl($cv_rwipelatihaninstruktur_grid->takhir) == "") { ?>
		<th data-name="takhir" class="<?php echo $cv_rwipelatihaninstruktur_grid->takhir->headerCellClass() ?>"><div id="elh_cv_rwipelatihaninstruktur_takhir" class="cv_rwipelatihaninstruktur_takhir"><div class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_grid->takhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="takhir" class="<?php echo $cv_rwipelatihaninstruktur_grid->takhir->headerCellClass() ?>"><div><div id="elh_cv_rwipelatihaninstruktur_takhir" class="cv_rwipelatihaninstruktur_takhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_grid->takhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_rwipelatihaninstruktur_grid->takhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_rwipelatihaninstruktur_grid->takhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur_grid->kdprop->Visible) { // kdprop ?>
	<?php if ($cv_rwipelatihaninstruktur_grid->SortUrl($cv_rwipelatihaninstruktur_grid->kdprop) == "") { ?>
		<th data-name="kdprop" class="<?php echo $cv_rwipelatihaninstruktur_grid->kdprop->headerCellClass() ?>"><div id="elh_cv_rwipelatihaninstruktur_kdprop" class="cv_rwipelatihaninstruktur_kdprop"><div class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_grid->kdprop->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdprop" class="<?php echo $cv_rwipelatihaninstruktur_grid->kdprop->headerCellClass() ?>"><div><div id="elh_cv_rwipelatihaninstruktur_kdprop" class="cv_rwipelatihaninstruktur_kdprop">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_grid->kdprop->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_rwipelatihaninstruktur_grid->kdprop->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_rwipelatihaninstruktur_grid->kdprop->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur_grid->kdkota->Visible) { // kdkota ?>
	<?php if ($cv_rwipelatihaninstruktur_grid->SortUrl($cv_rwipelatihaninstruktur_grid->kdkota) == "") { ?>
		<th data-name="kdkota" class="<?php echo $cv_rwipelatihaninstruktur_grid->kdkota->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_cv_rwipelatihaninstruktur_kdkota" class="cv_rwipelatihaninstruktur_kdkota"><div class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_grid->kdkota->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkota" class="<?php echo $cv_rwipelatihaninstruktur_grid->kdkota->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_cv_rwipelatihaninstruktur_kdkota" class="cv_rwipelatihaninstruktur_kdkota">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_grid->kdkota->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_rwipelatihaninstruktur_grid->kdkota->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_rwipelatihaninstruktur_grid->kdkota->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cv_rwipelatihaninstruktur_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$cv_rwipelatihaninstruktur_grid->StartRecord = 1;
$cv_rwipelatihaninstruktur_grid->StopRecord = $cv_rwipelatihaninstruktur_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($cv_rwipelatihaninstruktur->isConfirm() || $cv_rwipelatihaninstruktur_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($cv_rwipelatihaninstruktur_grid->FormKeyCountName) && ($cv_rwipelatihaninstruktur_grid->isGridAdd() || $cv_rwipelatihaninstruktur_grid->isGridEdit() || $cv_rwipelatihaninstruktur->isConfirm())) {
		$cv_rwipelatihaninstruktur_grid->KeyCount = $CurrentForm->getValue($cv_rwipelatihaninstruktur_grid->FormKeyCountName);
		$cv_rwipelatihaninstruktur_grid->StopRecord = $cv_rwipelatihaninstruktur_grid->StartRecord + $cv_rwipelatihaninstruktur_grid->KeyCount - 1;
	}
}
$cv_rwipelatihaninstruktur_grid->RecordCount = $cv_rwipelatihaninstruktur_grid->StartRecord - 1;
if ($cv_rwipelatihaninstruktur_grid->Recordset && !$cv_rwipelatihaninstruktur_grid->Recordset->EOF) {
	$cv_rwipelatihaninstruktur_grid->Recordset->moveFirst();
	$selectLimit = $cv_rwipelatihaninstruktur_grid->UseSelectLimit;
	if (!$selectLimit && $cv_rwipelatihaninstruktur_grid->StartRecord > 1)
		$cv_rwipelatihaninstruktur_grid->Recordset->move($cv_rwipelatihaninstruktur_grid->StartRecord - 1);
} elseif (!$cv_rwipelatihaninstruktur->AllowAddDeleteRow && $cv_rwipelatihaninstruktur_grid->StopRecord == 0) {
	$cv_rwipelatihaninstruktur_grid->StopRecord = $cv_rwipelatihaninstruktur->GridAddRowCount;
}

// Initialize aggregate
$cv_rwipelatihaninstruktur->RowType = ROWTYPE_AGGREGATEINIT;
$cv_rwipelatihaninstruktur->resetAttributes();
$cv_rwipelatihaninstruktur_grid->renderRow();
if ($cv_rwipelatihaninstruktur_grid->isGridAdd())
	$cv_rwipelatihaninstruktur_grid->RowIndex = 0;
if ($cv_rwipelatihaninstruktur_grid->isGridEdit())
	$cv_rwipelatihaninstruktur_grid->RowIndex = 0;
while ($cv_rwipelatihaninstruktur_grid->RecordCount < $cv_rwipelatihaninstruktur_grid->StopRecord) {
	$cv_rwipelatihaninstruktur_grid->RecordCount++;
	if ($cv_rwipelatihaninstruktur_grid->RecordCount >= $cv_rwipelatihaninstruktur_grid->StartRecord) {
		$cv_rwipelatihaninstruktur_grid->RowCount++;
		if ($cv_rwipelatihaninstruktur_grid->isGridAdd() || $cv_rwipelatihaninstruktur_grid->isGridEdit() || $cv_rwipelatihaninstruktur->isConfirm()) {
			$cv_rwipelatihaninstruktur_grid->RowIndex++;
			$CurrentForm->Index = $cv_rwipelatihaninstruktur_grid->RowIndex;
			if ($CurrentForm->hasValue($cv_rwipelatihaninstruktur_grid->FormActionName) && ($cv_rwipelatihaninstruktur->isConfirm() || $cv_rwipelatihaninstruktur_grid->EventCancelled))
				$cv_rwipelatihaninstruktur_grid->RowAction = strval($CurrentForm->getValue($cv_rwipelatihaninstruktur_grid->FormActionName));
			elseif ($cv_rwipelatihaninstruktur_grid->isGridAdd())
				$cv_rwipelatihaninstruktur_grid->RowAction = "insert";
			else
				$cv_rwipelatihaninstruktur_grid->RowAction = "";
		}

		// Set up key count
		$cv_rwipelatihaninstruktur_grid->KeyCount = $cv_rwipelatihaninstruktur_grid->RowIndex;

		// Init row class and style
		$cv_rwipelatihaninstruktur->resetAttributes();
		$cv_rwipelatihaninstruktur->CssClass = "";
		if ($cv_rwipelatihaninstruktur_grid->isGridAdd()) {
			if ($cv_rwipelatihaninstruktur->CurrentMode == "copy") {
				$cv_rwipelatihaninstruktur_grid->loadRowValues($cv_rwipelatihaninstruktur_grid->Recordset); // Load row values
				$cv_rwipelatihaninstruktur_grid->setRecordKey($cv_rwipelatihaninstruktur_grid->RowOldKey, $cv_rwipelatihaninstruktur_grid->Recordset); // Set old record key
			} else {
				$cv_rwipelatihaninstruktur_grid->loadRowValues(); // Load default values
				$cv_rwipelatihaninstruktur_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$cv_rwipelatihaninstruktur_grid->loadRowValues($cv_rwipelatihaninstruktur_grid->Recordset); // Load row values
		}
		$cv_rwipelatihaninstruktur->RowType = ROWTYPE_VIEW; // Render view
		if ($cv_rwipelatihaninstruktur_grid->isGridAdd()) // Grid add
			$cv_rwipelatihaninstruktur->RowType = ROWTYPE_ADD; // Render add
		if ($cv_rwipelatihaninstruktur_grid->isGridAdd() && $cv_rwipelatihaninstruktur->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$cv_rwipelatihaninstruktur_grid->restoreCurrentRowFormValues($cv_rwipelatihaninstruktur_grid->RowIndex); // Restore form values
		if ($cv_rwipelatihaninstruktur_grid->isGridEdit()) { // Grid edit
			if ($cv_rwipelatihaninstruktur->EventCancelled)
				$cv_rwipelatihaninstruktur_grid->restoreCurrentRowFormValues($cv_rwipelatihaninstruktur_grid->RowIndex); // Restore form values
			if ($cv_rwipelatihaninstruktur_grid->RowAction == "insert")
				$cv_rwipelatihaninstruktur->RowType = ROWTYPE_ADD; // Render add
			else
				$cv_rwipelatihaninstruktur->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($cv_rwipelatihaninstruktur_grid->isGridEdit() && ($cv_rwipelatihaninstruktur->RowType == ROWTYPE_EDIT || $cv_rwipelatihaninstruktur->RowType == ROWTYPE_ADD) && $cv_rwipelatihaninstruktur->EventCancelled) // Update failed
			$cv_rwipelatihaninstruktur_grid->restoreCurrentRowFormValues($cv_rwipelatihaninstruktur_grid->RowIndex); // Restore form values
		if ($cv_rwipelatihaninstruktur->RowType == ROWTYPE_EDIT) // Edit row
			$cv_rwipelatihaninstruktur_grid->EditRowCount++;
		if ($cv_rwipelatihaninstruktur->isConfirm()) // Confirm row
			$cv_rwipelatihaninstruktur_grid->restoreCurrentRowFormValues($cv_rwipelatihaninstruktur_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$cv_rwipelatihaninstruktur->RowAttrs->merge(["data-rowindex" => $cv_rwipelatihaninstruktur_grid->RowCount, "id" => "r" . $cv_rwipelatihaninstruktur_grid->RowCount . "_cv_rwipelatihaninstruktur", "data-rowtype" => $cv_rwipelatihaninstruktur->RowType]);

		// Render row
		$cv_rwipelatihaninstruktur_grid->renderRow();

		// Render list options
		$cv_rwipelatihaninstruktur_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($cv_rwipelatihaninstruktur_grid->RowAction != "delete" && $cv_rwipelatihaninstruktur_grid->RowAction != "insertdelete" && !($cv_rwipelatihaninstruktur_grid->RowAction == "insert" && $cv_rwipelatihaninstruktur->isConfirm() && $cv_rwipelatihaninstruktur_grid->emptyRow())) {
?>
	<tr <?php echo $cv_rwipelatihaninstruktur->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cv_rwipelatihaninstruktur_grid->ListOptions->render("body", "left", $cv_rwipelatihaninstruktur_grid->RowCount);
?>
	<?php if ($cv_rwipelatihaninstruktur_grid->kurikulum->Visible) { // kurikulum ?>
		<td data-name="kurikulum" <?php echo $cv_rwipelatihaninstruktur_grid->kurikulum->cellAttributes() ?>>
<?php if ($cv_rwipelatihaninstruktur->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_rwipelatihaninstruktur_grid->RowCount ?>_cv_rwipelatihaninstruktur_kurikulum" class="form-group">
<input type="text" data-table="cv_rwipelatihaninstruktur" data-field="x_kurikulum" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kurikulum" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kurikulum" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kurikulum->getPlaceHolder()) ?>" value="<?php echo $cv_rwipelatihaninstruktur_grid->kurikulum->EditValue ?>"<?php echo $cv_rwipelatihaninstruktur_grid->kurikulum->editAttributes() ?>>
</span>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kurikulum" name="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kurikulum" id="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kurikulum" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kurikulum->OldValue) ?>">
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cv_rwipelatihaninstruktur_grid->RowCount ?>_cv_rwipelatihaninstruktur_kurikulum" class="form-group">
<span<?php echo $cv_rwipelatihaninstruktur_grid->kurikulum->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_rwipelatihaninstruktur_grid->kurikulum->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kurikulum" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kurikulum" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kurikulum" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kurikulum->CurrentValue) ?>">
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_rwipelatihaninstruktur_grid->RowCount ?>_cv_rwipelatihaninstruktur_kurikulum">
<span<?php echo $cv_rwipelatihaninstruktur_grid->kurikulum->viewAttributes() ?>><?php echo $cv_rwipelatihaninstruktur_grid->kurikulum->getViewValue() ?></span>
</span>
<?php if (!$cv_rwipelatihaninstruktur->isConfirm()) { ?>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kurikulum" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kurikulum" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kurikulum" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kurikulum->FormValue) ?>">
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kurikulum" name="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kurikulum" id="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kurikulum" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kurikulum->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kurikulum" name="fcv_rwipelatihaninstrukturgrid$x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kurikulum" id="fcv_rwipelatihaninstrukturgrid$x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kurikulum" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kurikulum->FormValue) ?>">
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kurikulum" name="fcv_rwipelatihaninstrukturgrid$o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kurikulum" id="fcv_rwipelatihaninstrukturgrid$o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kurikulum" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kurikulum->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_rwipelatihaninstruktur_grid->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $cv_rwipelatihaninstruktur_grid->kdjudul->cellAttributes() ?>>
<?php if ($cv_rwipelatihaninstruktur->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_rwipelatihaninstruktur_grid->RowCount ?>_cv_rwipelatihaninstruktur_kdjudul" class="form-group">
<?php
$onchange = $cv_rwipelatihaninstruktur_grid->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_rwipelatihaninstruktur_grid->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul">
	<input type="text" class="form-control" name="sv_x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" id="sv_x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" value="<?php echo RemoveHtml($cv_rwipelatihaninstruktur_grid->kdjudul->EditValue) ?>" size="100" placeholder="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdjudul->getPlaceHolder()) ?>"<?php echo $cv_rwipelatihaninstruktur_grid->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdjudul" data-value-separator="<?php echo $cv_rwipelatihaninstruktur_grid->kdjudul->displayValueSeparatorAttribute() ?>" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdjudul->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_rwipelatihaninstrukturgrid"], function() {
	fcv_rwipelatihaninstrukturgrid.createAutoSuggest({"id":"x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul","forceSelect":true,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $cv_rwipelatihaninstruktur_grid->kdjudul->Lookup->getParamTag($cv_rwipelatihaninstruktur_grid, "p_x" . $cv_rwipelatihaninstruktur_grid->RowIndex . "_kdjudul") ?>
</span>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdjudul" name="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" id="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdjudul->OldValue) ?>">
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cv_rwipelatihaninstruktur_grid->RowCount ?>_cv_rwipelatihaninstruktur_kdjudul" class="form-group">
<span<?php echo $cv_rwipelatihaninstruktur_grid->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_rwipelatihaninstruktur_grid->kdjudul->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdjudul" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdjudul->CurrentValue) ?>">
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_rwipelatihaninstruktur_grid->RowCount ?>_cv_rwipelatihaninstruktur_kdjudul">
<span<?php echo $cv_rwipelatihaninstruktur_grid->kdjudul->viewAttributes() ?>><?php echo $cv_rwipelatihaninstruktur_grid->kdjudul->getViewValue() ?></span>
</span>
<?php if (!$cv_rwipelatihaninstruktur->isConfirm()) { ?>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdjudul" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdjudul->FormValue) ?>">
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdjudul" name="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" id="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdjudul->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdjudul" name="fcv_rwipelatihaninstrukturgrid$x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" id="fcv_rwipelatihaninstrukturgrid$x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdjudul->FormValue) ?>">
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdjudul" name="fcv_rwipelatihaninstrukturgrid$o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" id="fcv_rwipelatihaninstrukturgrid$o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdjudul->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_rwipelatihaninstruktur_grid->tawal->Visible) { // tawal ?>
		<td data-name="tawal" <?php echo $cv_rwipelatihaninstruktur_grid->tawal->cellAttributes() ?>>
<?php if ($cv_rwipelatihaninstruktur->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_rwipelatihaninstruktur_grid->RowCount ?>_cv_rwipelatihaninstruktur_tawal" class="form-group">
<input type="text" data-table="cv_rwipelatihaninstruktur" data-field="x_tawal" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_tawal" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_tawal" size="10" placeholder="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->tawal->getPlaceHolder()) ?>" value="<?php echo $cv_rwipelatihaninstruktur_grid->tawal->EditValue ?>"<?php echo $cv_rwipelatihaninstruktur_grid->tawal->editAttributes() ?>>
<?php if (!$cv_rwipelatihaninstruktur_grid->tawal->ReadOnly && !$cv_rwipelatihaninstruktur_grid->tawal->Disabled && !isset($cv_rwipelatihaninstruktur_grid->tawal->EditAttrs["readonly"]) && !isset($cv_rwipelatihaninstruktur_grid->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcv_rwipelatihaninstrukturgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fcv_rwipelatihaninstrukturgrid", "x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_tawal" name="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_tawal" id="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->tawal->OldValue) ?>">
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cv_rwipelatihaninstruktur_grid->RowCount ?>_cv_rwipelatihaninstruktur_tawal" class="form-group">
<span<?php echo $cv_rwipelatihaninstruktur_grid->tawal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_rwipelatihaninstruktur_grid->tawal->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_tawal" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_tawal" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->tawal->CurrentValue) ?>">
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_rwipelatihaninstruktur_grid->RowCount ?>_cv_rwipelatihaninstruktur_tawal">
<span<?php echo $cv_rwipelatihaninstruktur_grid->tawal->viewAttributes() ?>><?php echo $cv_rwipelatihaninstruktur_grid->tawal->getViewValue() ?></span>
</span>
<?php if (!$cv_rwipelatihaninstruktur->isConfirm()) { ?>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_tawal" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_tawal" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->tawal->FormValue) ?>">
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_tawal" name="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_tawal" id="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->tawal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_tawal" name="fcv_rwipelatihaninstrukturgrid$x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_tawal" id="fcv_rwipelatihaninstrukturgrid$x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->tawal->FormValue) ?>">
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_tawal" name="fcv_rwipelatihaninstrukturgrid$o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_tawal" id="fcv_rwipelatihaninstrukturgrid$o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->tawal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_rwipelatihaninstruktur_grid->takhir->Visible) { // takhir ?>
		<td data-name="takhir" <?php echo $cv_rwipelatihaninstruktur_grid->takhir->cellAttributes() ?>>
<?php if ($cv_rwipelatihaninstruktur->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_rwipelatihaninstruktur_grid->RowCount ?>_cv_rwipelatihaninstruktur_takhir" class="form-group">
<input type="text" data-table="cv_rwipelatihaninstruktur" data-field="x_takhir" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_takhir" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_takhir" size="10" placeholder="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->takhir->getPlaceHolder()) ?>" value="<?php echo $cv_rwipelatihaninstruktur_grid->takhir->EditValue ?>"<?php echo $cv_rwipelatihaninstruktur_grid->takhir->editAttributes() ?>>
<?php if (!$cv_rwipelatihaninstruktur_grid->takhir->ReadOnly && !$cv_rwipelatihaninstruktur_grid->takhir->Disabled && !isset($cv_rwipelatihaninstruktur_grid->takhir->EditAttrs["readonly"]) && !isset($cv_rwipelatihaninstruktur_grid->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcv_rwipelatihaninstrukturgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fcv_rwipelatihaninstrukturgrid", "x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_takhir" name="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_takhir" id="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->takhir->OldValue) ?>">
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cv_rwipelatihaninstruktur_grid->RowCount ?>_cv_rwipelatihaninstruktur_takhir" class="form-group">
<span<?php echo $cv_rwipelatihaninstruktur_grid->takhir->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_rwipelatihaninstruktur_grid->takhir->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_takhir" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_takhir" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->takhir->CurrentValue) ?>">
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_rwipelatihaninstruktur_grid->RowCount ?>_cv_rwipelatihaninstruktur_takhir">
<span<?php echo $cv_rwipelatihaninstruktur_grid->takhir->viewAttributes() ?>><?php echo $cv_rwipelatihaninstruktur_grid->takhir->getViewValue() ?></span>
</span>
<?php if (!$cv_rwipelatihaninstruktur->isConfirm()) { ?>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_takhir" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_takhir" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->takhir->FormValue) ?>">
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_takhir" name="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_takhir" id="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->takhir->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_takhir" name="fcv_rwipelatihaninstrukturgrid$x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_takhir" id="fcv_rwipelatihaninstrukturgrid$x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->takhir->FormValue) ?>">
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_takhir" name="fcv_rwipelatihaninstrukturgrid$o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_takhir" id="fcv_rwipelatihaninstrukturgrid$o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->takhir->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_rwipelatihaninstruktur_grid->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" <?php echo $cv_rwipelatihaninstruktur_grid->kdprop->cellAttributes() ?>>
<?php if ($cv_rwipelatihaninstruktur->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_rwipelatihaninstruktur_grid->RowCount ?>_cv_rwipelatihaninstruktur_kdprop" class="form-group">
<?php $cv_rwipelatihaninstruktur_grid->kdprop->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cv_rwipelatihaninstruktur" data-field="x_kdprop" data-value-separator="<?php echo $cv_rwipelatihaninstruktur_grid->kdprop->displayValueSeparatorAttribute() ?>" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdprop" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdprop"<?php echo $cv_rwipelatihaninstruktur_grid->kdprop->editAttributes() ?>>
			<?php echo $cv_rwipelatihaninstruktur_grid->kdprop->selectOptionListHtml("x{$cv_rwipelatihaninstruktur_grid->RowIndex}_kdprop") ?>
		</select>
</div>
<?php echo $cv_rwipelatihaninstruktur_grid->kdprop->Lookup->getParamTag($cv_rwipelatihaninstruktur_grid, "p_x" . $cv_rwipelatihaninstruktur_grid->RowIndex . "_kdprop") ?>
</span>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdprop" name="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdprop" id="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdprop->OldValue) ?>">
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cv_rwipelatihaninstruktur_grid->RowCount ?>_cv_rwipelatihaninstruktur_kdprop" class="form-group">
<span<?php echo $cv_rwipelatihaninstruktur_grid->kdprop->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_rwipelatihaninstruktur_grid->kdprop->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdprop" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdprop" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdprop->CurrentValue) ?>">
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_rwipelatihaninstruktur_grid->RowCount ?>_cv_rwipelatihaninstruktur_kdprop">
<span<?php echo $cv_rwipelatihaninstruktur_grid->kdprop->viewAttributes() ?>><?php echo $cv_rwipelatihaninstruktur_grid->kdprop->getViewValue() ?></span>
</span>
<?php if (!$cv_rwipelatihaninstruktur->isConfirm()) { ?>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdprop" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdprop" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdprop->FormValue) ?>">
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdprop" name="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdprop" id="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdprop->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdprop" name="fcv_rwipelatihaninstrukturgrid$x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdprop" id="fcv_rwipelatihaninstrukturgrid$x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdprop->FormValue) ?>">
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdprop" name="fcv_rwipelatihaninstrukturgrid$o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdprop" id="fcv_rwipelatihaninstrukturgrid$o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdprop->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cv_rwipelatihaninstruktur_grid->kdkota->Visible) { // kdkota ?>
		<td data-name="kdkota" <?php echo $cv_rwipelatihaninstruktur_grid->kdkota->cellAttributes() ?>>
<?php if ($cv_rwipelatihaninstruktur->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cv_rwipelatihaninstruktur_grid->RowCount ?>_cv_rwipelatihaninstruktur_kdkota" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cv_rwipelatihaninstruktur" data-field="x_kdkota" data-value-separator="<?php echo $cv_rwipelatihaninstruktur_grid->kdkota->displayValueSeparatorAttribute() ?>" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdkota" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdkota"<?php echo $cv_rwipelatihaninstruktur_grid->kdkota->editAttributes() ?>>
			<?php echo $cv_rwipelatihaninstruktur_grid->kdkota->selectOptionListHtml("x{$cv_rwipelatihaninstruktur_grid->RowIndex}_kdkota") ?>
		</select>
</div>
<?php echo $cv_rwipelatihaninstruktur_grid->kdkota->Lookup->getParamTag($cv_rwipelatihaninstruktur_grid, "p_x" . $cv_rwipelatihaninstruktur_grid->RowIndex . "_kdkota") ?>
</span>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdkota" name="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdkota" id="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdkota->OldValue) ?>">
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cv_rwipelatihaninstruktur_grid->RowCount ?>_cv_rwipelatihaninstruktur_kdkota" class="form-group">
<span<?php echo $cv_rwipelatihaninstruktur_grid->kdkota->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_rwipelatihaninstruktur_grid->kdkota->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdkota" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdkota" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdkota->CurrentValue) ?>">
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cv_rwipelatihaninstruktur_grid->RowCount ?>_cv_rwipelatihaninstruktur_kdkota">
<span<?php echo $cv_rwipelatihaninstruktur_grid->kdkota->viewAttributes() ?>><?php echo $cv_rwipelatihaninstruktur_grid->kdkota->getViewValue() ?></span>
</span>
<?php if (!$cv_rwipelatihaninstruktur->isConfirm()) { ?>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdkota" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdkota" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdkota->FormValue) ?>">
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdkota" name="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdkota" id="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdkota->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdkota" name="fcv_rwipelatihaninstrukturgrid$x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdkota" id="fcv_rwipelatihaninstrukturgrid$x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdkota->FormValue) ?>">
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdkota" name="fcv_rwipelatihaninstrukturgrid$o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdkota" id="fcv_rwipelatihaninstrukturgrid$o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdkota->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cv_rwipelatihaninstruktur_grid->ListOptions->render("body", "right", $cv_rwipelatihaninstruktur_grid->RowCount);
?>
	</tr>
<?php if ($cv_rwipelatihaninstruktur->RowType == ROWTYPE_ADD || $cv_rwipelatihaninstruktur->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fcv_rwipelatihaninstrukturgrid", "load"], function() {
	fcv_rwipelatihaninstrukturgrid.updateLists(<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$cv_rwipelatihaninstruktur_grid->isGridAdd() || $cv_rwipelatihaninstruktur->CurrentMode == "copy")
		if (!$cv_rwipelatihaninstruktur_grid->Recordset->EOF)
			$cv_rwipelatihaninstruktur_grid->Recordset->moveNext();
}
?>
<?php
	if ($cv_rwipelatihaninstruktur->CurrentMode == "add" || $cv_rwipelatihaninstruktur->CurrentMode == "copy" || $cv_rwipelatihaninstruktur->CurrentMode == "edit") {
		$cv_rwipelatihaninstruktur_grid->RowIndex = '$rowindex$';
		$cv_rwipelatihaninstruktur_grid->loadRowValues();

		// Set row properties
		$cv_rwipelatihaninstruktur->resetAttributes();
		$cv_rwipelatihaninstruktur->RowAttrs->merge(["data-rowindex" => $cv_rwipelatihaninstruktur_grid->RowIndex, "id" => "r0_cv_rwipelatihaninstruktur", "data-rowtype" => ROWTYPE_ADD]);
		$cv_rwipelatihaninstruktur->RowAttrs->appendClass("ew-template");
		$cv_rwipelatihaninstruktur->RowType = ROWTYPE_ADD;

		// Render row
		$cv_rwipelatihaninstruktur_grid->renderRow();

		// Render list options
		$cv_rwipelatihaninstruktur_grid->renderListOptions();
		$cv_rwipelatihaninstruktur_grid->StartRowCount = 0;
?>
	<tr <?php echo $cv_rwipelatihaninstruktur->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cv_rwipelatihaninstruktur_grid->ListOptions->render("body", "left", $cv_rwipelatihaninstruktur_grid->RowIndex);
?>
	<?php if ($cv_rwipelatihaninstruktur_grid->kurikulum->Visible) { // kurikulum ?>
		<td data-name="kurikulum">
<?php if (!$cv_rwipelatihaninstruktur->isConfirm()) { ?>
<span id="el$rowindex$_cv_rwipelatihaninstruktur_kurikulum" class="form-group cv_rwipelatihaninstruktur_kurikulum">
<input type="text" data-table="cv_rwipelatihaninstruktur" data-field="x_kurikulum" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kurikulum" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kurikulum" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kurikulum->getPlaceHolder()) ?>" value="<?php echo $cv_rwipelatihaninstruktur_grid->kurikulum->EditValue ?>"<?php echo $cv_rwipelatihaninstruktur_grid->kurikulum->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cv_rwipelatihaninstruktur_kurikulum" class="form-group cv_rwipelatihaninstruktur_kurikulum">
<span<?php echo $cv_rwipelatihaninstruktur_grid->kurikulum->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_rwipelatihaninstruktur_grid->kurikulum->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kurikulum" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kurikulum" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kurikulum" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kurikulum->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kurikulum" name="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kurikulum" id="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kurikulum" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kurikulum->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_rwipelatihaninstruktur_grid->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul">
<?php if (!$cv_rwipelatihaninstruktur->isConfirm()) { ?>
<span id="el$rowindex$_cv_rwipelatihaninstruktur_kdjudul" class="form-group cv_rwipelatihaninstruktur_kdjudul">
<?php
$onchange = $cv_rwipelatihaninstruktur_grid->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_rwipelatihaninstruktur_grid->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul">
	<input type="text" class="form-control" name="sv_x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" id="sv_x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" value="<?php echo RemoveHtml($cv_rwipelatihaninstruktur_grid->kdjudul->EditValue) ?>" size="100" placeholder="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdjudul->getPlaceHolder()) ?>"<?php echo $cv_rwipelatihaninstruktur_grid->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdjudul" data-value-separator="<?php echo $cv_rwipelatihaninstruktur_grid->kdjudul->displayValueSeparatorAttribute() ?>" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdjudul->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_rwipelatihaninstrukturgrid"], function() {
	fcv_rwipelatihaninstrukturgrid.createAutoSuggest({"id":"x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul","forceSelect":true,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $cv_rwipelatihaninstruktur_grid->kdjudul->Lookup->getParamTag($cv_rwipelatihaninstruktur_grid, "p_x" . $cv_rwipelatihaninstruktur_grid->RowIndex . "_kdjudul") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_cv_rwipelatihaninstruktur_kdjudul" class="form-group cv_rwipelatihaninstruktur_kdjudul">
<span<?php echo $cv_rwipelatihaninstruktur_grid->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_rwipelatihaninstruktur_grid->kdjudul->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdjudul" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdjudul->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdjudul" name="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" id="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdjudul" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdjudul->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_rwipelatihaninstruktur_grid->tawal->Visible) { // tawal ?>
		<td data-name="tawal">
<?php if (!$cv_rwipelatihaninstruktur->isConfirm()) { ?>
<span id="el$rowindex$_cv_rwipelatihaninstruktur_tawal" class="form-group cv_rwipelatihaninstruktur_tawal">
<input type="text" data-table="cv_rwipelatihaninstruktur" data-field="x_tawal" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_tawal" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_tawal" size="10" placeholder="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->tawal->getPlaceHolder()) ?>" value="<?php echo $cv_rwipelatihaninstruktur_grid->tawal->EditValue ?>"<?php echo $cv_rwipelatihaninstruktur_grid->tawal->editAttributes() ?>>
<?php if (!$cv_rwipelatihaninstruktur_grid->tawal->ReadOnly && !$cv_rwipelatihaninstruktur_grid->tawal->Disabled && !isset($cv_rwipelatihaninstruktur_grid->tawal->EditAttrs["readonly"]) && !isset($cv_rwipelatihaninstruktur_grid->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcv_rwipelatihaninstrukturgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fcv_rwipelatihaninstrukturgrid", "x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_cv_rwipelatihaninstruktur_tawal" class="form-group cv_rwipelatihaninstruktur_tawal">
<span<?php echo $cv_rwipelatihaninstruktur_grid->tawal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_rwipelatihaninstruktur_grid->tawal->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_tawal" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_tawal" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->tawal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_tawal" name="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_tawal" id="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_tawal" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->tawal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_rwipelatihaninstruktur_grid->takhir->Visible) { // takhir ?>
		<td data-name="takhir">
<?php if (!$cv_rwipelatihaninstruktur->isConfirm()) { ?>
<span id="el$rowindex$_cv_rwipelatihaninstruktur_takhir" class="form-group cv_rwipelatihaninstruktur_takhir">
<input type="text" data-table="cv_rwipelatihaninstruktur" data-field="x_takhir" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_takhir" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_takhir" size="10" placeholder="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->takhir->getPlaceHolder()) ?>" value="<?php echo $cv_rwipelatihaninstruktur_grid->takhir->EditValue ?>"<?php echo $cv_rwipelatihaninstruktur_grid->takhir->editAttributes() ?>>
<?php if (!$cv_rwipelatihaninstruktur_grid->takhir->ReadOnly && !$cv_rwipelatihaninstruktur_grid->takhir->Disabled && !isset($cv_rwipelatihaninstruktur_grid->takhir->EditAttrs["readonly"]) && !isset($cv_rwipelatihaninstruktur_grid->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcv_rwipelatihaninstrukturgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fcv_rwipelatihaninstrukturgrid", "x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_cv_rwipelatihaninstruktur_takhir" class="form-group cv_rwipelatihaninstruktur_takhir">
<span<?php echo $cv_rwipelatihaninstruktur_grid->takhir->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_rwipelatihaninstruktur_grid->takhir->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_takhir" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_takhir" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->takhir->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_takhir" name="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_takhir" id="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_takhir" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->takhir->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_rwipelatihaninstruktur_grid->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop">
<?php if (!$cv_rwipelatihaninstruktur->isConfirm()) { ?>
<span id="el$rowindex$_cv_rwipelatihaninstruktur_kdprop" class="form-group cv_rwipelatihaninstruktur_kdprop">
<?php $cv_rwipelatihaninstruktur_grid->kdprop->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cv_rwipelatihaninstruktur" data-field="x_kdprop" data-value-separator="<?php echo $cv_rwipelatihaninstruktur_grid->kdprop->displayValueSeparatorAttribute() ?>" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdprop" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdprop"<?php echo $cv_rwipelatihaninstruktur_grid->kdprop->editAttributes() ?>>
			<?php echo $cv_rwipelatihaninstruktur_grid->kdprop->selectOptionListHtml("x{$cv_rwipelatihaninstruktur_grid->RowIndex}_kdprop") ?>
		</select>
</div>
<?php echo $cv_rwipelatihaninstruktur_grid->kdprop->Lookup->getParamTag($cv_rwipelatihaninstruktur_grid, "p_x" . $cv_rwipelatihaninstruktur_grid->RowIndex . "_kdprop") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_cv_rwipelatihaninstruktur_kdprop" class="form-group cv_rwipelatihaninstruktur_kdprop">
<span<?php echo $cv_rwipelatihaninstruktur_grid->kdprop->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_rwipelatihaninstruktur_grid->kdprop->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdprop" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdprop" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdprop->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdprop" name="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdprop" id="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdprop" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdprop->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cv_rwipelatihaninstruktur_grid->kdkota->Visible) { // kdkota ?>
		<td data-name="kdkota">
<?php if (!$cv_rwipelatihaninstruktur->isConfirm()) { ?>
<span id="el$rowindex$_cv_rwipelatihaninstruktur_kdkota" class="form-group cv_rwipelatihaninstruktur_kdkota">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cv_rwipelatihaninstruktur" data-field="x_kdkota" data-value-separator="<?php echo $cv_rwipelatihaninstruktur_grid->kdkota->displayValueSeparatorAttribute() ?>" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdkota" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdkota"<?php echo $cv_rwipelatihaninstruktur_grid->kdkota->editAttributes() ?>>
			<?php echo $cv_rwipelatihaninstruktur_grid->kdkota->selectOptionListHtml("x{$cv_rwipelatihaninstruktur_grid->RowIndex}_kdkota") ?>
		</select>
</div>
<?php echo $cv_rwipelatihaninstruktur_grid->kdkota->Lookup->getParamTag($cv_rwipelatihaninstruktur_grid, "p_x" . $cv_rwipelatihaninstruktur_grid->RowIndex . "_kdkota") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_cv_rwipelatihaninstruktur_kdkota" class="form-group cv_rwipelatihaninstruktur_kdkota">
<span<?php echo $cv_rwipelatihaninstruktur_grid->kdkota->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_rwipelatihaninstruktur_grid->kdkota->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdkota" name="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdkota" id="x<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdkota->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cv_rwipelatihaninstruktur" data-field="x_kdkota" name="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdkota" id="o<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>_kdkota" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_grid->kdkota->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cv_rwipelatihaninstruktur_grid->ListOptions->render("body", "right", $cv_rwipelatihaninstruktur_grid->RowIndex);
?>
<script>
loadjs.ready(["fcv_rwipelatihaninstrukturgrid", "load"], function() {
	fcv_rwipelatihaninstrukturgrid.updateLists(<?php echo $cv_rwipelatihaninstruktur_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($cv_rwipelatihaninstruktur->CurrentMode == "add" || $cv_rwipelatihaninstruktur->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $cv_rwipelatihaninstruktur_grid->FormKeyCountName ?>" id="<?php echo $cv_rwipelatihaninstruktur_grid->FormKeyCountName ?>" value="<?php echo $cv_rwipelatihaninstruktur_grid->KeyCount ?>">
<?php echo $cv_rwipelatihaninstruktur_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $cv_rwipelatihaninstruktur_grid->FormKeyCountName ?>" id="<?php echo $cv_rwipelatihaninstruktur_grid->FormKeyCountName ?>" value="<?php echo $cv_rwipelatihaninstruktur_grid->KeyCount ?>">
<?php echo $cv_rwipelatihaninstruktur_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcv_rwipelatihaninstrukturgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cv_rwipelatihaninstruktur_grid->Recordset)
	$cv_rwipelatihaninstruktur_grid->Recordset->Close();
?>
<?php if ($cv_rwipelatihaninstruktur_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $cv_rwipelatihaninstruktur_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur_grid->TotalRecords == 0 && !$cv_rwipelatihaninstruktur->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cv_rwipelatihaninstruktur_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$cv_rwipelatihaninstruktur_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$cv_rwipelatihaninstruktur_grid->terminate();
?>