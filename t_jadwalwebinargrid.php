<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($t_jadwalwebinar_grid))
	$t_jadwalwebinar_grid = new t_jadwalwebinar_grid();

// Run the page
$t_jadwalwebinar_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_jadwalwebinar_grid->Page_Render();
?>
<?php if (!$t_jadwalwebinar_grid->isExport()) { ?>
<script>
var ft_jadwalwebinargrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	ft_jadwalwebinargrid = new ew.Form("ft_jadwalwebinargrid", "grid");
	ft_jadwalwebinargrid.formKeyCountName = '<?php echo $t_jadwalwebinar_grid->FormKeyCountName ?>';

	// Validate form
	ft_jadwalwebinargrid.validate = function() {
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
			<?php if ($t_jadwalwebinar_grid->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_grid->tgl->caption(), $t_jadwalwebinar_grid->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalwebinar_grid->tgl->errorMessage()) ?>");
			<?php if ($t_jadwalwebinar_grid->jam->Required) { ?>
				elm = this.getElements("x" + infix + "_jam");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_grid->jam->caption(), $t_jadwalwebinar_grid->jam->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalwebinar_grid->jam->errorMessage()) ?>");
			<?php if ($t_jadwalwebinar_grid->jam_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_jam_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_grid->jam_akhir->caption(), $t_jadwalwebinar_grid->jam_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam_akhir");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalwebinar_grid->jam_akhir->errorMessage()) ?>");
			<?php if ($t_jadwalwebinar_grid->materi->Required) { ?>
				elm = this.getElements("x" + infix + "_materi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_grid->materi->caption(), $t_jadwalwebinar_grid->materi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalwebinar_grid->instruktur->Required) { ?>
				elm = this.getElements("x" + infix + "_instruktur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_grid->instruktur->caption(), $t_jadwalwebinar_grid->instruktur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_instruktur");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalwebinar_grid->instruktur->errorMessage()) ?>");
			<?php if ($t_jadwalwebinar_grid->instansi->Required) { ?>
				elm = this.getElements("x" + infix + "_instansi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_grid->instansi->caption(), $t_jadwalwebinar_grid->instansi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalwebinar_grid->ket->Required) { ?>
				elm = this.getElements("x" + infix + "_ket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_grid->ket->caption(), $t_jadwalwebinar_grid->ket->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	ft_jadwalwebinargrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "tgl", false)) return false;
		if (ew.valueChanged(fobj, infix, "jam", false)) return false;
		if (ew.valueChanged(fobj, infix, "jam_akhir", false)) return false;
		if (ew.valueChanged(fobj, infix, "materi", false)) return false;
		if (ew.valueChanged(fobj, infix, "instruktur", false)) return false;
		if (ew.valueChanged(fobj, infix, "instansi", false)) return false;
		if (ew.valueChanged(fobj, infix, "ket", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_jadwalwebinargrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_jadwalwebinargrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_jadwalwebinargrid");
});
</script>
<script>
ew.ready("head", "js/ewfixedheadertable.js", "fixedheadertable");
</script>
<?php } ?>
<?php
$t_jadwalwebinar_grid->renderOtherOptions();
?>
<?php if ($t_jadwalwebinar_grid->TotalRecords > 0 || $t_jadwalwebinar->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_jadwalwebinar_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_jadwalwebinar">
<?php if ($t_jadwalwebinar_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $t_jadwalwebinar_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ft_jadwalwebinargrid" class="ew-form ew-list-form form-inline">
<div id="gmp_t_jadwalwebinar" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_t_jadwalwebinargrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_jadwalwebinar->RowType = ROWTYPE_HEADER;

// Render list options
$t_jadwalwebinar_grid->renderListOptions();

// Render list options (header, left)
$t_jadwalwebinar_grid->ListOptions->render("header", "left");
?>
<?php if ($t_jadwalwebinar_grid->tgl->Visible) { // tgl ?>
	<?php if ($t_jadwalwebinar_grid->SortUrl($t_jadwalwebinar_grid->tgl) == "") { ?>
		<th data-name="tgl" class="<?php echo $t_jadwalwebinar_grid->tgl->headerCellClass() ?>"><div id="elh_t_jadwalwebinar_tgl" class="t_jadwalwebinar_tgl"><div class="ew-table-header-caption"><?php echo $t_jadwalwebinar_grid->tgl->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl" class="<?php echo $t_jadwalwebinar_grid->tgl->headerCellClass() ?>"><div><div id="elh_t_jadwalwebinar_tgl" class="t_jadwalwebinar_tgl">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalwebinar_grid->tgl->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalwebinar_grid->tgl->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalwebinar_grid->tgl->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalwebinar_grid->jam->Visible) { // jam ?>
	<?php if ($t_jadwalwebinar_grid->SortUrl($t_jadwalwebinar_grid->jam) == "") { ?>
		<th data-name="jam" class="<?php echo $t_jadwalwebinar_grid->jam->headerCellClass() ?>"><div id="elh_t_jadwalwebinar_jam" class="t_jadwalwebinar_jam"><div class="ew-table-header-caption"><?php echo $t_jadwalwebinar_grid->jam->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jam" class="<?php echo $t_jadwalwebinar_grid->jam->headerCellClass() ?>"><div><div id="elh_t_jadwalwebinar_jam" class="t_jadwalwebinar_jam">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalwebinar_grid->jam->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalwebinar_grid->jam->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalwebinar_grid->jam->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalwebinar_grid->jam_akhir->Visible) { // jam_akhir ?>
	<?php if ($t_jadwalwebinar_grid->SortUrl($t_jadwalwebinar_grid->jam_akhir) == "") { ?>
		<th data-name="jam_akhir" class="<?php echo $t_jadwalwebinar_grid->jam_akhir->headerCellClass() ?>"><div id="elh_t_jadwalwebinar_jam_akhir" class="t_jadwalwebinar_jam_akhir"><div class="ew-table-header-caption"><?php echo $t_jadwalwebinar_grid->jam_akhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jam_akhir" class="<?php echo $t_jadwalwebinar_grid->jam_akhir->headerCellClass() ?>"><div><div id="elh_t_jadwalwebinar_jam_akhir" class="t_jadwalwebinar_jam_akhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalwebinar_grid->jam_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalwebinar_grid->jam_akhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalwebinar_grid->jam_akhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalwebinar_grid->materi->Visible) { // materi ?>
	<?php if ($t_jadwalwebinar_grid->SortUrl($t_jadwalwebinar_grid->materi) == "") { ?>
		<th data-name="materi" class="<?php echo $t_jadwalwebinar_grid->materi->headerCellClass() ?>"><div id="elh_t_jadwalwebinar_materi" class="t_jadwalwebinar_materi"><div class="ew-table-header-caption"><?php echo $t_jadwalwebinar_grid->materi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="materi" class="<?php echo $t_jadwalwebinar_grid->materi->headerCellClass() ?>"><div><div id="elh_t_jadwalwebinar_materi" class="t_jadwalwebinar_materi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalwebinar_grid->materi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalwebinar_grid->materi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalwebinar_grid->materi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalwebinar_grid->instruktur->Visible) { // instruktur ?>
	<?php if ($t_jadwalwebinar_grid->SortUrl($t_jadwalwebinar_grid->instruktur) == "") { ?>
		<th data-name="instruktur" class="<?php echo $t_jadwalwebinar_grid->instruktur->headerCellClass() ?>"><div id="elh_t_jadwalwebinar_instruktur" class="t_jadwalwebinar_instruktur"><div class="ew-table-header-caption"><?php echo $t_jadwalwebinar_grid->instruktur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="instruktur" class="<?php echo $t_jadwalwebinar_grid->instruktur->headerCellClass() ?>"><div><div id="elh_t_jadwalwebinar_instruktur" class="t_jadwalwebinar_instruktur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalwebinar_grid->instruktur->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalwebinar_grid->instruktur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalwebinar_grid->instruktur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalwebinar_grid->instansi->Visible) { // instansi ?>
	<?php if ($t_jadwalwebinar_grid->SortUrl($t_jadwalwebinar_grid->instansi) == "") { ?>
		<th data-name="instansi" class="<?php echo $t_jadwalwebinar_grid->instansi->headerCellClass() ?>"><div id="elh_t_jadwalwebinar_instansi" class="t_jadwalwebinar_instansi"><div class="ew-table-header-caption"><?php echo $t_jadwalwebinar_grid->instansi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="instansi" class="<?php echo $t_jadwalwebinar_grid->instansi->headerCellClass() ?>"><div><div id="elh_t_jadwalwebinar_instansi" class="t_jadwalwebinar_instansi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalwebinar_grid->instansi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalwebinar_grid->instansi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalwebinar_grid->instansi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalwebinar_grid->ket->Visible) { // ket ?>
	<?php if ($t_jadwalwebinar_grid->SortUrl($t_jadwalwebinar_grid->ket) == "") { ?>
		<th data-name="ket" class="<?php echo $t_jadwalwebinar_grid->ket->headerCellClass() ?>"><div id="elh_t_jadwalwebinar_ket" class="t_jadwalwebinar_ket"><div class="ew-table-header-caption"><?php echo $t_jadwalwebinar_grid->ket->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ket" class="<?php echo $t_jadwalwebinar_grid->ket->headerCellClass() ?>"><div><div id="elh_t_jadwalwebinar_ket" class="t_jadwalwebinar_ket">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalwebinar_grid->ket->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalwebinar_grid->ket->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalwebinar_grid->ket->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_jadwalwebinar_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_jadwalwebinar_grid->StartRecord = 1;
$t_jadwalwebinar_grid->StopRecord = $t_jadwalwebinar_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($t_jadwalwebinar->isConfirm() || $t_jadwalwebinar_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_jadwalwebinar_grid->FormKeyCountName) && ($t_jadwalwebinar_grid->isGridAdd() || $t_jadwalwebinar_grid->isGridEdit() || $t_jadwalwebinar->isConfirm())) {
		$t_jadwalwebinar_grid->KeyCount = $CurrentForm->getValue($t_jadwalwebinar_grid->FormKeyCountName);
		$t_jadwalwebinar_grid->StopRecord = $t_jadwalwebinar_grid->StartRecord + $t_jadwalwebinar_grid->KeyCount - 1;
	}
}
$t_jadwalwebinar_grid->RecordCount = $t_jadwalwebinar_grid->StartRecord - 1;
if ($t_jadwalwebinar_grid->Recordset && !$t_jadwalwebinar_grid->Recordset->EOF) {
	$t_jadwalwebinar_grid->Recordset->moveFirst();
	$selectLimit = $t_jadwalwebinar_grid->UseSelectLimit;
	if (!$selectLimit && $t_jadwalwebinar_grid->StartRecord > 1)
		$t_jadwalwebinar_grid->Recordset->move($t_jadwalwebinar_grid->StartRecord - 1);
} elseif (!$t_jadwalwebinar->AllowAddDeleteRow && $t_jadwalwebinar_grid->StopRecord == 0) {
	$t_jadwalwebinar_grid->StopRecord = $t_jadwalwebinar->GridAddRowCount;
}

// Initialize aggregate
$t_jadwalwebinar->RowType = ROWTYPE_AGGREGATEINIT;
$t_jadwalwebinar->resetAttributes();
$t_jadwalwebinar_grid->renderRow();
if ($t_jadwalwebinar_grid->isGridAdd())
	$t_jadwalwebinar_grid->RowIndex = 0;
if ($t_jadwalwebinar_grid->isGridEdit())
	$t_jadwalwebinar_grid->RowIndex = 0;
while ($t_jadwalwebinar_grid->RecordCount < $t_jadwalwebinar_grid->StopRecord) {
	$t_jadwalwebinar_grid->RecordCount++;
	if ($t_jadwalwebinar_grid->RecordCount >= $t_jadwalwebinar_grid->StartRecord) {
		$t_jadwalwebinar_grid->RowCount++;
		if ($t_jadwalwebinar_grid->isGridAdd() || $t_jadwalwebinar_grid->isGridEdit() || $t_jadwalwebinar->isConfirm()) {
			$t_jadwalwebinar_grid->RowIndex++;
			$CurrentForm->Index = $t_jadwalwebinar_grid->RowIndex;
			if ($CurrentForm->hasValue($t_jadwalwebinar_grid->FormActionName) && ($t_jadwalwebinar->isConfirm() || $t_jadwalwebinar_grid->EventCancelled))
				$t_jadwalwebinar_grid->RowAction = strval($CurrentForm->getValue($t_jadwalwebinar_grid->FormActionName));
			elseif ($t_jadwalwebinar_grid->isGridAdd())
				$t_jadwalwebinar_grid->RowAction = "insert";
			else
				$t_jadwalwebinar_grid->RowAction = "";
		}

		// Set up key count
		$t_jadwalwebinar_grid->KeyCount = $t_jadwalwebinar_grid->RowIndex;

		// Init row class and style
		$t_jadwalwebinar->resetAttributes();
		$t_jadwalwebinar->CssClass = "";
		if ($t_jadwalwebinar_grid->isGridAdd()) {
			if ($t_jadwalwebinar->CurrentMode == "copy") {
				$t_jadwalwebinar_grid->loadRowValues($t_jadwalwebinar_grid->Recordset); // Load row values
				$t_jadwalwebinar_grid->setRecordKey($t_jadwalwebinar_grid->RowOldKey, $t_jadwalwebinar_grid->Recordset); // Set old record key
			} else {
				$t_jadwalwebinar_grid->loadRowValues(); // Load default values
				$t_jadwalwebinar_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_jadwalwebinar_grid->loadRowValues($t_jadwalwebinar_grid->Recordset); // Load row values
		}
		$t_jadwalwebinar->RowType = ROWTYPE_VIEW; // Render view
		if ($t_jadwalwebinar_grid->isGridAdd()) // Grid add
			$t_jadwalwebinar->RowType = ROWTYPE_ADD; // Render add
		if ($t_jadwalwebinar_grid->isGridAdd() && $t_jadwalwebinar->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_jadwalwebinar_grid->restoreCurrentRowFormValues($t_jadwalwebinar_grid->RowIndex); // Restore form values
		if ($t_jadwalwebinar_grid->isGridEdit()) { // Grid edit
			if ($t_jadwalwebinar->EventCancelled)
				$t_jadwalwebinar_grid->restoreCurrentRowFormValues($t_jadwalwebinar_grid->RowIndex); // Restore form values
			if ($t_jadwalwebinar_grid->RowAction == "insert")
				$t_jadwalwebinar->RowType = ROWTYPE_ADD; // Render add
			else
				$t_jadwalwebinar->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_jadwalwebinar_grid->isGridEdit() && ($t_jadwalwebinar->RowType == ROWTYPE_EDIT || $t_jadwalwebinar->RowType == ROWTYPE_ADD) && $t_jadwalwebinar->EventCancelled) // Update failed
			$t_jadwalwebinar_grid->restoreCurrentRowFormValues($t_jadwalwebinar_grid->RowIndex); // Restore form values
		if ($t_jadwalwebinar->RowType == ROWTYPE_EDIT) // Edit row
			$t_jadwalwebinar_grid->EditRowCount++;
		if ($t_jadwalwebinar->isConfirm()) // Confirm row
			$t_jadwalwebinar_grid->restoreCurrentRowFormValues($t_jadwalwebinar_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_jadwalwebinar->RowAttrs->merge(["data-rowindex" => $t_jadwalwebinar_grid->RowCount, "id" => "r" . $t_jadwalwebinar_grid->RowCount . "_t_jadwalwebinar", "data-rowtype" => $t_jadwalwebinar->RowType]);

		// Render row
		$t_jadwalwebinar_grid->renderRow();

		// Render list options
		$t_jadwalwebinar_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_jadwalwebinar_grid->RowAction != "delete" && $t_jadwalwebinar_grid->RowAction != "insertdelete" && !($t_jadwalwebinar_grid->RowAction == "insert" && $t_jadwalwebinar->isConfirm() && $t_jadwalwebinar_grid->emptyRow())) {
?>
	<tr <?php echo $t_jadwalwebinar->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_jadwalwebinar_grid->ListOptions->render("body", "left", $t_jadwalwebinar_grid->RowCount);
?>
	<?php if ($t_jadwalwebinar_grid->tgl->Visible) { // tgl ?>
		<td data-name="tgl" <?php echo $t_jadwalwebinar_grid->tgl->cellAttributes() ?>>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalwebinar_grid->RowCount ?>_t_jadwalwebinar_tgl" class="form-group">
<input type="text" data-table="t_jadwalwebinar" data-field="x_tgl" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_grid->tgl->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_grid->tgl->EditValue ?>"<?php echo $t_jadwalwebinar_grid->tgl->editAttributes() ?>>
<?php if (!$t_jadwalwebinar_grid->tgl->ReadOnly && !$t_jadwalwebinar_grid->tgl->Disabled && !isset($t_jadwalwebinar_grid->tgl->EditAttrs["readonly"]) && !isset($t_jadwalwebinar_grid->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalwebinargrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_jadwalwebinargrid", "x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_tgl" name="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl" id="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->tgl->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jadwalwebinar_grid->RowCount ?>_t_jadwalwebinar_tgl" class="form-group">
<input type="text" data-table="t_jadwalwebinar" data-field="x_tgl" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_grid->tgl->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_grid->tgl->EditValue ?>"<?php echo $t_jadwalwebinar_grid->tgl->editAttributes() ?>>
<?php if (!$t_jadwalwebinar_grid->tgl->ReadOnly && !$t_jadwalwebinar_grid->tgl->Disabled && !isset($t_jadwalwebinar_grid->tgl->EditAttrs["readonly"]) && !isset($t_jadwalwebinar_grid->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalwebinargrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_jadwalwebinargrid", "x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalwebinar_grid->RowCount ?>_t_jadwalwebinar_tgl">
<span<?php echo $t_jadwalwebinar_grid->tgl->viewAttributes() ?>><?php echo $t_jadwalwebinar_grid->tgl->getViewValue() ?></span>
</span>
<?php if (!$t_jadwalwebinar->isConfirm()) { ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_tgl" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->tgl->FormValue) ?>">
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_tgl" name="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl" id="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->tgl->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_tgl" name="ft_jadwalwebinargrid$x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl" id="ft_jadwalwebinargrid$x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->tgl->FormValue) ?>">
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_tgl" name="ft_jadwalwebinargrid$o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl" id="ft_jadwalwebinargrid$o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->tgl->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_idjadwal" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_idjadwal" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_idjadwal" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->idjadwal->CurrentValue) ?>">
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_idjadwal" name="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_idjadwal" id="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_idjadwal" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->idjadwal->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_EDIT || $t_jadwalwebinar->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_idjadwal" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_idjadwal" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_idjadwal" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->idjadwal->CurrentValue) ?>">
<?php } ?>
	<?php if ($t_jadwalwebinar_grid->jam->Visible) { // jam ?>
		<td data-name="jam" <?php echo $t_jadwalwebinar_grid->jam->cellAttributes() ?>>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalwebinar_grid->RowCount ?>_t_jadwalwebinar_jam" class="form-group">
<input type="text" data-table="t_jadwalwebinar" data-field="x_jam" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam" size="5" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_grid->jam->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_grid->jam->EditValue ?>"<?php echo $t_jadwalwebinar_grid->jam->editAttributes() ?>>
<?php if (!$t_jadwalwebinar_grid->jam->ReadOnly && !$t_jadwalwebinar_grid->jam->Disabled && !isset($t_jadwalwebinar_grid->jam->EditAttrs["readonly"]) && !isset($t_jadwalwebinar_grid->jam->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalwebinargrid", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalwebinargrid", "x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_jam" name="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam" id="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->jam->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jadwalwebinar_grid->RowCount ?>_t_jadwalwebinar_jam" class="form-group">
<input type="text" data-table="t_jadwalwebinar" data-field="x_jam" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam" size="5" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_grid->jam->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_grid->jam->EditValue ?>"<?php echo $t_jadwalwebinar_grid->jam->editAttributes() ?>>
<?php if (!$t_jadwalwebinar_grid->jam->ReadOnly && !$t_jadwalwebinar_grid->jam->Disabled && !isset($t_jadwalwebinar_grid->jam->EditAttrs["readonly"]) && !isset($t_jadwalwebinar_grid->jam->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalwebinargrid", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalwebinargrid", "x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalwebinar_grid->RowCount ?>_t_jadwalwebinar_jam">
<span<?php echo $t_jadwalwebinar_grid->jam->viewAttributes() ?>><?php echo $t_jadwalwebinar_grid->jam->getViewValue() ?></span>
</span>
<?php if (!$t_jadwalwebinar->isConfirm()) { ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_jam" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->jam->FormValue) ?>">
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_jam" name="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam" id="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->jam->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_jam" name="ft_jadwalwebinargrid$x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam" id="ft_jadwalwebinargrid$x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->jam->FormValue) ?>">
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_jam" name="ft_jadwalwebinargrid$o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam" id="ft_jadwalwebinargrid$o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->jam->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_grid->jam_akhir->Visible) { // jam_akhir ?>
		<td data-name="jam_akhir" <?php echo $t_jadwalwebinar_grid->jam_akhir->cellAttributes() ?>>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalwebinar_grid->RowCount ?>_t_jadwalwebinar_jam_akhir" class="form-group">
<input type="text" data-table="t_jadwalwebinar" data-field="x_jam_akhir" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir" size="5" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_grid->jam_akhir->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_grid->jam_akhir->EditValue ?>"<?php echo $t_jadwalwebinar_grid->jam_akhir->editAttributes() ?>>
<?php if (!$t_jadwalwebinar_grid->jam_akhir->ReadOnly && !$t_jadwalwebinar_grid->jam_akhir->Disabled && !isset($t_jadwalwebinar_grid->jam_akhir->EditAttrs["readonly"]) && !isset($t_jadwalwebinar_grid->jam_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalwebinargrid", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalwebinargrid", "x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_jam_akhir" name="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir" id="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->jam_akhir->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jadwalwebinar_grid->RowCount ?>_t_jadwalwebinar_jam_akhir" class="form-group">
<input type="text" data-table="t_jadwalwebinar" data-field="x_jam_akhir" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir" size="5" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_grid->jam_akhir->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_grid->jam_akhir->EditValue ?>"<?php echo $t_jadwalwebinar_grid->jam_akhir->editAttributes() ?>>
<?php if (!$t_jadwalwebinar_grid->jam_akhir->ReadOnly && !$t_jadwalwebinar_grid->jam_akhir->Disabled && !isset($t_jadwalwebinar_grid->jam_akhir->EditAttrs["readonly"]) && !isset($t_jadwalwebinar_grid->jam_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalwebinargrid", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalwebinargrid", "x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalwebinar_grid->RowCount ?>_t_jadwalwebinar_jam_akhir">
<span<?php echo $t_jadwalwebinar_grid->jam_akhir->viewAttributes() ?>><?php echo $t_jadwalwebinar_grid->jam_akhir->getViewValue() ?></span>
</span>
<?php if (!$t_jadwalwebinar->isConfirm()) { ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_jam_akhir" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->jam_akhir->FormValue) ?>">
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_jam_akhir" name="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir" id="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->jam_akhir->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_jam_akhir" name="ft_jadwalwebinargrid$x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir" id="ft_jadwalwebinargrid$x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->jam_akhir->FormValue) ?>">
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_jam_akhir" name="ft_jadwalwebinargrid$o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir" id="ft_jadwalwebinargrid$o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->jam_akhir->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_grid->materi->Visible) { // materi ?>
		<td data-name="materi" <?php echo $t_jadwalwebinar_grid->materi->cellAttributes() ?>>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalwebinar_grid->RowCount ?>_t_jadwalwebinar_materi" class="form-group">
<input type="text" data-table="t_jadwalwebinar" data-field="x_materi" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_materi" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_materi" size="50" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_grid->materi->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_grid->materi->EditValue ?>"<?php echo $t_jadwalwebinar_grid->materi->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_materi" name="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_materi" id="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_materi" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->materi->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jadwalwebinar_grid->RowCount ?>_t_jadwalwebinar_materi" class="form-group">
<input type="text" data-table="t_jadwalwebinar" data-field="x_materi" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_materi" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_materi" size="50" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_grid->materi->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_grid->materi->EditValue ?>"<?php echo $t_jadwalwebinar_grid->materi->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalwebinar_grid->RowCount ?>_t_jadwalwebinar_materi">
<span<?php echo $t_jadwalwebinar_grid->materi->viewAttributes() ?>><?php echo $t_jadwalwebinar_grid->materi->getViewValue() ?></span>
</span>
<?php if (!$t_jadwalwebinar->isConfirm()) { ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_materi" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_materi" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_materi" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->materi->FormValue) ?>">
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_materi" name="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_materi" id="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_materi" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->materi->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_materi" name="ft_jadwalwebinargrid$x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_materi" id="ft_jadwalwebinargrid$x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_materi" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->materi->FormValue) ?>">
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_materi" name="ft_jadwalwebinargrid$o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_materi" id="ft_jadwalwebinargrid$o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_materi" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->materi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_grid->instruktur->Visible) { // instruktur ?>
		<td data-name="instruktur" <?php echo $t_jadwalwebinar_grid->instruktur->cellAttributes() ?>>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalwebinar_grid->RowCount ?>_t_jadwalwebinar_instruktur" class="form-group">
<input type="text" data-table="t_jadwalwebinar" data-field="x_instruktur" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instruktur" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instruktur" size="30" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_grid->instruktur->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_grid->instruktur->EditValue ?>"<?php echo $t_jadwalwebinar_grid->instruktur->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_instruktur" name="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instruktur" id="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->instruktur->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jadwalwebinar_grid->RowCount ?>_t_jadwalwebinar_instruktur" class="form-group">
<input type="text" data-table="t_jadwalwebinar" data-field="x_instruktur" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instruktur" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instruktur" size="30" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_grid->instruktur->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_grid->instruktur->EditValue ?>"<?php echo $t_jadwalwebinar_grid->instruktur->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalwebinar_grid->RowCount ?>_t_jadwalwebinar_instruktur">
<span<?php echo $t_jadwalwebinar_grid->instruktur->viewAttributes() ?>><?php echo $t_jadwalwebinar_grid->instruktur->getViewValue() ?></span>
</span>
<?php if (!$t_jadwalwebinar->isConfirm()) { ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_instruktur" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instruktur" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->instruktur->FormValue) ?>">
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_instruktur" name="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instruktur" id="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->instruktur->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_instruktur" name="ft_jadwalwebinargrid$x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instruktur" id="ft_jadwalwebinargrid$x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->instruktur->FormValue) ?>">
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_instruktur" name="ft_jadwalwebinargrid$o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instruktur" id="ft_jadwalwebinargrid$o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->instruktur->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_grid->instansi->Visible) { // instansi ?>
		<td data-name="instansi" <?php echo $t_jadwalwebinar_grid->instansi->cellAttributes() ?>>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalwebinar_grid->RowCount ?>_t_jadwalwebinar_instansi" class="form-group">
<input type="text" data-table="t_jadwalwebinar" data-field="x_instansi" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instansi" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instansi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_grid->instansi->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_grid->instansi->EditValue ?>"<?php echo $t_jadwalwebinar_grid->instansi->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_instansi" name="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instansi" id="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instansi" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->instansi->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jadwalwebinar_grid->RowCount ?>_t_jadwalwebinar_instansi" class="form-group">
<input type="text" data-table="t_jadwalwebinar" data-field="x_instansi" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instansi" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instansi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_grid->instansi->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_grid->instansi->EditValue ?>"<?php echo $t_jadwalwebinar_grid->instansi->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalwebinar_grid->RowCount ?>_t_jadwalwebinar_instansi">
<span<?php echo $t_jadwalwebinar_grid->instansi->viewAttributes() ?>><?php echo $t_jadwalwebinar_grid->instansi->getViewValue() ?></span>
</span>
<?php if (!$t_jadwalwebinar->isConfirm()) { ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_instansi" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instansi" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instansi" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->instansi->FormValue) ?>">
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_instansi" name="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instansi" id="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instansi" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->instansi->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_instansi" name="ft_jadwalwebinargrid$x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instansi" id="ft_jadwalwebinargrid$x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instansi" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->instansi->FormValue) ?>">
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_instansi" name="ft_jadwalwebinargrid$o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instansi" id="ft_jadwalwebinargrid$o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instansi" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->instansi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_grid->ket->Visible) { // ket ?>
		<td data-name="ket" <?php echo $t_jadwalwebinar_grid->ket->cellAttributes() ?>>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalwebinar_grid->RowCount ?>_t_jadwalwebinar_ket" class="form-group">
<input type="text" data-table="t_jadwalwebinar" data-field="x_ket" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_ket" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_ket" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_grid->ket->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_grid->ket->EditValue ?>"<?php echo $t_jadwalwebinar_grid->ket->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_ket" name="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_ket" id="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->ket->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jadwalwebinar_grid->RowCount ?>_t_jadwalwebinar_ket" class="form-group">
<input type="text" data-table="t_jadwalwebinar" data-field="x_ket" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_ket" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_ket" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_grid->ket->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_grid->ket->EditValue ?>"<?php echo $t_jadwalwebinar_grid->ket->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalwebinar_grid->RowCount ?>_t_jadwalwebinar_ket">
<span<?php echo $t_jadwalwebinar_grid->ket->viewAttributes() ?>><?php echo $t_jadwalwebinar_grid->ket->getViewValue() ?></span>
</span>
<?php if (!$t_jadwalwebinar->isConfirm()) { ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_ket" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_ket" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->ket->FormValue) ?>">
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_ket" name="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_ket" id="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->ket->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_ket" name="ft_jadwalwebinargrid$x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_ket" id="ft_jadwalwebinargrid$x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->ket->FormValue) ?>">
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_ket" name="ft_jadwalwebinargrid$o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_ket" id="ft_jadwalwebinargrid$o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->ket->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_jadwalwebinar_grid->ListOptions->render("body", "right", $t_jadwalwebinar_grid->RowCount);
?>
	</tr>
<?php if ($t_jadwalwebinar->RowType == ROWTYPE_ADD || $t_jadwalwebinar->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_jadwalwebinargrid", "load"], function() {
	ft_jadwalwebinargrid.updateLists(<?php echo $t_jadwalwebinar_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_jadwalwebinar_grid->isGridAdd() || $t_jadwalwebinar->CurrentMode == "copy")
		if (!$t_jadwalwebinar_grid->Recordset->EOF)
			$t_jadwalwebinar_grid->Recordset->moveNext();
}
?>
<?php
	if ($t_jadwalwebinar->CurrentMode == "add" || $t_jadwalwebinar->CurrentMode == "copy" || $t_jadwalwebinar->CurrentMode == "edit") {
		$t_jadwalwebinar_grid->RowIndex = '$rowindex$';
		$t_jadwalwebinar_grid->loadRowValues();

		// Set row properties
		$t_jadwalwebinar->resetAttributes();
		$t_jadwalwebinar->RowAttrs->merge(["data-rowindex" => $t_jadwalwebinar_grid->RowIndex, "id" => "r0_t_jadwalwebinar", "data-rowtype" => ROWTYPE_ADD]);
		$t_jadwalwebinar->RowAttrs->appendClass("ew-template");
		$t_jadwalwebinar->RowType = ROWTYPE_ADD;

		// Render row
		$t_jadwalwebinar_grid->renderRow();

		// Render list options
		$t_jadwalwebinar_grid->renderListOptions();
		$t_jadwalwebinar_grid->StartRowCount = 0;
?>
	<tr <?php echo $t_jadwalwebinar->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_jadwalwebinar_grid->ListOptions->render("body", "left", $t_jadwalwebinar_grid->RowIndex);
?>
	<?php if ($t_jadwalwebinar_grid->tgl->Visible) { // tgl ?>
		<td data-name="tgl">
<?php if (!$t_jadwalwebinar->isConfirm()) { ?>
<span id="el$rowindex$_t_jadwalwebinar_tgl" class="form-group t_jadwalwebinar_tgl">
<input type="text" data-table="t_jadwalwebinar" data-field="x_tgl" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_grid->tgl->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_grid->tgl->EditValue ?>"<?php echo $t_jadwalwebinar_grid->tgl->editAttributes() ?>>
<?php if (!$t_jadwalwebinar_grid->tgl->ReadOnly && !$t_jadwalwebinar_grid->tgl->Disabled && !isset($t_jadwalwebinar_grid->tgl->EditAttrs["readonly"]) && !isset($t_jadwalwebinar_grid->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalwebinargrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_jadwalwebinargrid", "x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jadwalwebinar_tgl" class="form-group t_jadwalwebinar_tgl">
<span<?php echo $t_jadwalwebinar_grid->tgl->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_jadwalwebinar_grid->tgl->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_tgl" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->tgl->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_tgl" name="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl" id="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_tgl" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->tgl->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_grid->jam->Visible) { // jam ?>
		<td data-name="jam">
<?php if (!$t_jadwalwebinar->isConfirm()) { ?>
<span id="el$rowindex$_t_jadwalwebinar_jam" class="form-group t_jadwalwebinar_jam">
<input type="text" data-table="t_jadwalwebinar" data-field="x_jam" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam" size="5" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_grid->jam->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_grid->jam->EditValue ?>"<?php echo $t_jadwalwebinar_grid->jam->editAttributes() ?>>
<?php if (!$t_jadwalwebinar_grid->jam->ReadOnly && !$t_jadwalwebinar_grid->jam->Disabled && !isset($t_jadwalwebinar_grid->jam->EditAttrs["readonly"]) && !isset($t_jadwalwebinar_grid->jam->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalwebinargrid", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalwebinargrid", "x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jadwalwebinar_jam" class="form-group t_jadwalwebinar_jam">
<span<?php echo $t_jadwalwebinar_grid->jam->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_jadwalwebinar_grid->jam->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_jam" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->jam->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_jam" name="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam" id="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->jam->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_grid->jam_akhir->Visible) { // jam_akhir ?>
		<td data-name="jam_akhir">
<?php if (!$t_jadwalwebinar->isConfirm()) { ?>
<span id="el$rowindex$_t_jadwalwebinar_jam_akhir" class="form-group t_jadwalwebinar_jam_akhir">
<input type="text" data-table="t_jadwalwebinar" data-field="x_jam_akhir" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir" size="5" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_grid->jam_akhir->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_grid->jam_akhir->EditValue ?>"<?php echo $t_jadwalwebinar_grid->jam_akhir->editAttributes() ?>>
<?php if (!$t_jadwalwebinar_grid->jam_akhir->ReadOnly && !$t_jadwalwebinar_grid->jam_akhir->Disabled && !isset($t_jadwalwebinar_grid->jam_akhir->EditAttrs["readonly"]) && !isset($t_jadwalwebinar_grid->jam_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalwebinargrid", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalwebinargrid", "x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jadwalwebinar_jam_akhir" class="form-group t_jadwalwebinar_jam_akhir">
<span<?php echo $t_jadwalwebinar_grid->jam_akhir->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_jadwalwebinar_grid->jam_akhir->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_jam_akhir" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->jam_akhir->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_jam_akhir" name="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir" id="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_jam_akhir" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->jam_akhir->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_grid->materi->Visible) { // materi ?>
		<td data-name="materi">
<?php if (!$t_jadwalwebinar->isConfirm()) { ?>
<span id="el$rowindex$_t_jadwalwebinar_materi" class="form-group t_jadwalwebinar_materi">
<input type="text" data-table="t_jadwalwebinar" data-field="x_materi" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_materi" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_materi" size="50" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_grid->materi->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_grid->materi->EditValue ?>"<?php echo $t_jadwalwebinar_grid->materi->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jadwalwebinar_materi" class="form-group t_jadwalwebinar_materi">
<span<?php echo $t_jadwalwebinar_grid->materi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_jadwalwebinar_grid->materi->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_materi" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_materi" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_materi" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->materi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_materi" name="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_materi" id="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_materi" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->materi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_grid->instruktur->Visible) { // instruktur ?>
		<td data-name="instruktur">
<?php if (!$t_jadwalwebinar->isConfirm()) { ?>
<span id="el$rowindex$_t_jadwalwebinar_instruktur" class="form-group t_jadwalwebinar_instruktur">
<input type="text" data-table="t_jadwalwebinar" data-field="x_instruktur" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instruktur" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instruktur" size="30" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_grid->instruktur->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_grid->instruktur->EditValue ?>"<?php echo $t_jadwalwebinar_grid->instruktur->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jadwalwebinar_instruktur" class="form-group t_jadwalwebinar_instruktur">
<span<?php echo $t_jadwalwebinar_grid->instruktur->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_jadwalwebinar_grid->instruktur->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_instruktur" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instruktur" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->instruktur->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_instruktur" name="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instruktur" id="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->instruktur->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_grid->instansi->Visible) { // instansi ?>
		<td data-name="instansi">
<?php if (!$t_jadwalwebinar->isConfirm()) { ?>
<span id="el$rowindex$_t_jadwalwebinar_instansi" class="form-group t_jadwalwebinar_instansi">
<input type="text" data-table="t_jadwalwebinar" data-field="x_instansi" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instansi" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instansi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_grid->instansi->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_grid->instansi->EditValue ?>"<?php echo $t_jadwalwebinar_grid->instansi->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jadwalwebinar_instansi" class="form-group t_jadwalwebinar_instansi">
<span<?php echo $t_jadwalwebinar_grid->instansi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_jadwalwebinar_grid->instansi->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_instansi" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instansi" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instansi" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->instansi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_instansi" name="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instansi" id="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_instansi" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->instansi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalwebinar_grid->ket->Visible) { // ket ?>
		<td data-name="ket">
<?php if (!$t_jadwalwebinar->isConfirm()) { ?>
<span id="el$rowindex$_t_jadwalwebinar_ket" class="form-group t_jadwalwebinar_ket">
<input type="text" data-table="t_jadwalwebinar" data-field="x_ket" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_ket" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_ket" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_grid->ket->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_grid->ket->EditValue ?>"<?php echo $t_jadwalwebinar_grid->ket->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jadwalwebinar_ket" class="form-group t_jadwalwebinar_ket">
<span<?php echo $t_jadwalwebinar_grid->ket->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_jadwalwebinar_grid->ket->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_ket" name="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_ket" id="x<?php echo $t_jadwalwebinar_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->ket->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_ket" name="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_ket" id="o<?php echo $t_jadwalwebinar_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_jadwalwebinar_grid->ket->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_jadwalwebinar_grid->ListOptions->render("body", "right", $t_jadwalwebinar_grid->RowIndex);
?>
<script>
loadjs.ready(["ft_jadwalwebinargrid", "load"], function() {
	ft_jadwalwebinargrid.updateLists(<?php echo $t_jadwalwebinar_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($t_jadwalwebinar->CurrentMode == "add" || $t_jadwalwebinar->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $t_jadwalwebinar_grid->FormKeyCountName ?>" id="<?php echo $t_jadwalwebinar_grid->FormKeyCountName ?>" value="<?php echo $t_jadwalwebinar_grid->KeyCount ?>">
<?php echo $t_jadwalwebinar_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_jadwalwebinar->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $t_jadwalwebinar_grid->FormKeyCountName ?>" id="<?php echo $t_jadwalwebinar_grid->FormKeyCountName ?>" value="<?php echo $t_jadwalwebinar_grid->KeyCount ?>">
<?php echo $t_jadwalwebinar_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_jadwalwebinar->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_jadwalwebinargrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_jadwalwebinar_grid->Recordset)
	$t_jadwalwebinar_grid->Recordset->Close();
?>
<?php if ($t_jadwalwebinar_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $t_jadwalwebinar_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_jadwalwebinar_grid->TotalRecords == 0 && !$t_jadwalwebinar->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_jadwalwebinar_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$t_jadwalwebinar_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php if (!$t_jadwalwebinar->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_t_jadwalwebinar",
		width: "100%",
		height: "350px"
	});
});
</script>
<?php } ?>
<?php } ?>
<?php
$t_jadwalwebinar_grid->terminate();
?>