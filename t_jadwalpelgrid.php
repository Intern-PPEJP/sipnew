<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($t_jadwalpel_grid))
	$t_jadwalpel_grid = new t_jadwalpel_grid();

// Run the page
$t_jadwalpel_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_jadwalpel_grid->Page_Render();
?>
<?php if (!$t_jadwalpel_grid->isExport()) { ?>
<script>
var ft_jadwalpelgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	ft_jadwalpelgrid = new ew.Form("ft_jadwalpelgrid", "grid");
	ft_jadwalpelgrid.formKeyCountName = '<?php echo $t_jadwalpel_grid->FormKeyCountName ?>';

	// Validate form
	ft_jadwalpelgrid.validate = function() {
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
			<?php if ($t_jadwalpel_grid->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_grid->tgl->caption(), $t_jadwalpel_grid->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalpel_grid->tgl->errorMessage()) ?>");
			<?php if ($t_jadwalpel_grid->jam->Required) { ?>
				elm = this.getElements("x" + infix + "_jam");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_grid->jam->caption(), $t_jadwalpel_grid->jam->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalpel_grid->jam->errorMessage()) ?>");
			<?php if ($t_jadwalpel_grid->jam_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_jam_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_grid->jam_akhir->caption(), $t_jadwalpel_grid->jam_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam_akhir");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalpel_grid->jam_akhir->errorMessage()) ?>");
			<?php if ($t_jadwalpel_grid->materi->Required) { ?>
				elm = this.getElements("x" + infix + "_materi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_grid->materi->caption(), $t_jadwalpel_grid->materi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalpel_grid->instruktur->Required) { ?>
				elm = this.getElements("x" + infix + "_instruktur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_grid->instruktur->caption(), $t_jadwalpel_grid->instruktur->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalpel_grid->instansi->Required) { ?>
				elm = this.getElements("x" + infix + "_instansi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_grid->instansi->caption(), $t_jadwalpel_grid->instansi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalpel_grid->ket->Required) { ?>
				elm = this.getElements("x" + infix + "_ket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_grid->ket->caption(), $t_jadwalpel_grid->ket->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	ft_jadwalpelgrid.emptyRow = function(infix) {
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
	ft_jadwalpelgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_jadwalpelgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_jadwalpelgrid.lists["x_materi"] = <?php echo $t_jadwalpel_grid->materi->Lookup->toClientList($t_jadwalpel_grid) ?>;
	ft_jadwalpelgrid.lists["x_materi"].options = <?php echo JsonEncode($t_jadwalpel_grid->materi->lookupOptions()) ?>;
	ft_jadwalpelgrid.lists["x_instruktur"] = <?php echo $t_jadwalpel_grid->instruktur->Lookup->toClientList($t_jadwalpel_grid) ?>;
	ft_jadwalpelgrid.lists["x_instruktur"].options = <?php echo JsonEncode($t_jadwalpel_grid->instruktur->lookupOptions()) ?>;
	loadjs.done("ft_jadwalpelgrid");
});
</script>
<script>
ew.ready("head", "js/ewfixedheadertable.js", "fixedheadertable");
</script>
<?php } ?>
<?php
$t_jadwalpel_grid->renderOtherOptions();
?>
<?php if ($t_jadwalpel_grid->TotalRecords > 0 || $t_jadwalpel->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_jadwalpel_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_jadwalpel">
<?php if ($t_jadwalpel_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $t_jadwalpel_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ft_jadwalpelgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_t_jadwalpel" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_t_jadwalpelgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_jadwalpel->RowType = ROWTYPE_HEADER;

// Render list options
$t_jadwalpel_grid->renderListOptions();

// Render list options (header, left)
$t_jadwalpel_grid->ListOptions->render("header", "left");
?>
<?php if ($t_jadwalpel_grid->tgl->Visible) { // tgl ?>
	<?php if ($t_jadwalpel_grid->SortUrl($t_jadwalpel_grid->tgl) == "") { ?>
		<th data-name="tgl" class="<?php echo $t_jadwalpel_grid->tgl->headerCellClass() ?>"><div id="elh_t_jadwalpel_tgl" class="t_jadwalpel_tgl"><div class="ew-table-header-caption"><?php echo $t_jadwalpel_grid->tgl->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl" class="<?php echo $t_jadwalpel_grid->tgl->headerCellClass() ?>"><div><div id="elh_t_jadwalpel_tgl" class="t_jadwalpel_tgl">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalpel_grid->tgl->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalpel_grid->tgl->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalpel_grid->tgl->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalpel_grid->jam->Visible) { // jam ?>
	<?php if ($t_jadwalpel_grid->SortUrl($t_jadwalpel_grid->jam) == "") { ?>
		<th data-name="jam" class="<?php echo $t_jadwalpel_grid->jam->headerCellClass() ?>"><div id="elh_t_jadwalpel_jam" class="t_jadwalpel_jam"><div class="ew-table-header-caption"><?php echo $t_jadwalpel_grid->jam->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jam" class="<?php echo $t_jadwalpel_grid->jam->headerCellClass() ?>"><div><div id="elh_t_jadwalpel_jam" class="t_jadwalpel_jam">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalpel_grid->jam->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalpel_grid->jam->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalpel_grid->jam->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalpel_grid->jam_akhir->Visible) { // jam_akhir ?>
	<?php if ($t_jadwalpel_grid->SortUrl($t_jadwalpel_grid->jam_akhir) == "") { ?>
		<th data-name="jam_akhir" class="<?php echo $t_jadwalpel_grid->jam_akhir->headerCellClass() ?>"><div id="elh_t_jadwalpel_jam_akhir" class="t_jadwalpel_jam_akhir"><div class="ew-table-header-caption"><?php echo $t_jadwalpel_grid->jam_akhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jam_akhir" class="<?php echo $t_jadwalpel_grid->jam_akhir->headerCellClass() ?>"><div><div id="elh_t_jadwalpel_jam_akhir" class="t_jadwalpel_jam_akhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalpel_grid->jam_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalpel_grid->jam_akhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalpel_grid->jam_akhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalpel_grid->materi->Visible) { // materi ?>
	<?php if ($t_jadwalpel_grid->SortUrl($t_jadwalpel_grid->materi) == "") { ?>
		<th data-name="materi" class="<?php echo $t_jadwalpel_grid->materi->headerCellClass() ?>"><div id="elh_t_jadwalpel_materi" class="t_jadwalpel_materi"><div class="ew-table-header-caption"><?php echo $t_jadwalpel_grid->materi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="materi" class="<?php echo $t_jadwalpel_grid->materi->headerCellClass() ?>"><div><div id="elh_t_jadwalpel_materi" class="t_jadwalpel_materi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalpel_grid->materi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalpel_grid->materi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalpel_grid->materi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalpel_grid->instruktur->Visible) { // instruktur ?>
	<?php if ($t_jadwalpel_grid->SortUrl($t_jadwalpel_grid->instruktur) == "") { ?>
		<th data-name="instruktur" class="<?php echo $t_jadwalpel_grid->instruktur->headerCellClass() ?>"><div id="elh_t_jadwalpel_instruktur" class="t_jadwalpel_instruktur"><div class="ew-table-header-caption"><?php echo $t_jadwalpel_grid->instruktur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="instruktur" class="<?php echo $t_jadwalpel_grid->instruktur->headerCellClass() ?>"><div><div id="elh_t_jadwalpel_instruktur" class="t_jadwalpel_instruktur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalpel_grid->instruktur->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalpel_grid->instruktur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalpel_grid->instruktur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalpel_grid->instansi->Visible) { // instansi ?>
	<?php if ($t_jadwalpel_grid->SortUrl($t_jadwalpel_grid->instansi) == "") { ?>
		<th data-name="instansi" class="<?php echo $t_jadwalpel_grid->instansi->headerCellClass() ?>"><div id="elh_t_jadwalpel_instansi" class="t_jadwalpel_instansi"><div class="ew-table-header-caption"><?php echo $t_jadwalpel_grid->instansi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="instansi" class="<?php echo $t_jadwalpel_grid->instansi->headerCellClass() ?>"><div><div id="elh_t_jadwalpel_instansi" class="t_jadwalpel_instansi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalpel_grid->instansi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalpel_grid->instansi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalpel_grid->instansi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jadwalpel_grid->ket->Visible) { // ket ?>
	<?php if ($t_jadwalpel_grid->SortUrl($t_jadwalpel_grid->ket) == "") { ?>
		<th data-name="ket" class="<?php echo $t_jadwalpel_grid->ket->headerCellClass() ?>"><div id="elh_t_jadwalpel_ket" class="t_jadwalpel_ket"><div class="ew-table-header-caption"><?php echo $t_jadwalpel_grid->ket->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ket" class="<?php echo $t_jadwalpel_grid->ket->headerCellClass() ?>"><div><div id="elh_t_jadwalpel_ket" class="t_jadwalpel_ket">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jadwalpel_grid->ket->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jadwalpel_grid->ket->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jadwalpel_grid->ket->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_jadwalpel_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_jadwalpel_grid->StartRecord = 1;
$t_jadwalpel_grid->StopRecord = $t_jadwalpel_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($t_jadwalpel->isConfirm() || $t_jadwalpel_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_jadwalpel_grid->FormKeyCountName) && ($t_jadwalpel_grid->isGridAdd() || $t_jadwalpel_grid->isGridEdit() || $t_jadwalpel->isConfirm())) {
		$t_jadwalpel_grid->KeyCount = $CurrentForm->getValue($t_jadwalpel_grid->FormKeyCountName);
		$t_jadwalpel_grid->StopRecord = $t_jadwalpel_grid->StartRecord + $t_jadwalpel_grid->KeyCount - 1;
	}
}
$t_jadwalpel_grid->RecordCount = $t_jadwalpel_grid->StartRecord - 1;
if ($t_jadwalpel_grid->Recordset && !$t_jadwalpel_grid->Recordset->EOF) {
	$t_jadwalpel_grid->Recordset->moveFirst();
	$selectLimit = $t_jadwalpel_grid->UseSelectLimit;
	if (!$selectLimit && $t_jadwalpel_grid->StartRecord > 1)
		$t_jadwalpel_grid->Recordset->move($t_jadwalpel_grid->StartRecord - 1);
} elseif (!$t_jadwalpel->AllowAddDeleteRow && $t_jadwalpel_grid->StopRecord == 0) {
	$t_jadwalpel_grid->StopRecord = $t_jadwalpel->GridAddRowCount;
}

// Initialize aggregate
$t_jadwalpel->RowType = ROWTYPE_AGGREGATEINIT;
$t_jadwalpel->resetAttributes();
$t_jadwalpel_grid->renderRow();
if ($t_jadwalpel_grid->isGridAdd())
	$t_jadwalpel_grid->RowIndex = 0;
if ($t_jadwalpel_grid->isGridEdit())
	$t_jadwalpel_grid->RowIndex = 0;
while ($t_jadwalpel_grid->RecordCount < $t_jadwalpel_grid->StopRecord) {
	$t_jadwalpel_grid->RecordCount++;
	if ($t_jadwalpel_grid->RecordCount >= $t_jadwalpel_grid->StartRecord) {
		$t_jadwalpel_grid->RowCount++;
		if ($t_jadwalpel_grid->isGridAdd() || $t_jadwalpel_grid->isGridEdit() || $t_jadwalpel->isConfirm()) {
			$t_jadwalpel_grid->RowIndex++;
			$CurrentForm->Index = $t_jadwalpel_grid->RowIndex;
			if ($CurrentForm->hasValue($t_jadwalpel_grid->FormActionName) && ($t_jadwalpel->isConfirm() || $t_jadwalpel_grid->EventCancelled))
				$t_jadwalpel_grid->RowAction = strval($CurrentForm->getValue($t_jadwalpel_grid->FormActionName));
			elseif ($t_jadwalpel_grid->isGridAdd())
				$t_jadwalpel_grid->RowAction = "insert";
			else
				$t_jadwalpel_grid->RowAction = "";
		}

		// Set up key count
		$t_jadwalpel_grid->KeyCount = $t_jadwalpel_grid->RowIndex;

		// Init row class and style
		$t_jadwalpel->resetAttributes();
		$t_jadwalpel->CssClass = "";
		if ($t_jadwalpel_grid->isGridAdd()) {
			if ($t_jadwalpel->CurrentMode == "copy") {
				$t_jadwalpel_grid->loadRowValues($t_jadwalpel_grid->Recordset); // Load row values
				$t_jadwalpel_grid->setRecordKey($t_jadwalpel_grid->RowOldKey, $t_jadwalpel_grid->Recordset); // Set old record key
			} else {
				$t_jadwalpel_grid->loadRowValues(); // Load default values
				$t_jadwalpel_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_jadwalpel_grid->loadRowValues($t_jadwalpel_grid->Recordset); // Load row values
		}
		$t_jadwalpel->RowType = ROWTYPE_VIEW; // Render view
		if ($t_jadwalpel_grid->isGridAdd()) // Grid add
			$t_jadwalpel->RowType = ROWTYPE_ADD; // Render add
		if ($t_jadwalpel_grid->isGridAdd() && $t_jadwalpel->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_jadwalpel_grid->restoreCurrentRowFormValues($t_jadwalpel_grid->RowIndex); // Restore form values
		if ($t_jadwalpel_grid->isGridEdit()) { // Grid edit
			if ($t_jadwalpel->EventCancelled)
				$t_jadwalpel_grid->restoreCurrentRowFormValues($t_jadwalpel_grid->RowIndex); // Restore form values
			if ($t_jadwalpel_grid->RowAction == "insert")
				$t_jadwalpel->RowType = ROWTYPE_ADD; // Render add
			else
				$t_jadwalpel->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_jadwalpel_grid->isGridEdit() && ($t_jadwalpel->RowType == ROWTYPE_EDIT || $t_jadwalpel->RowType == ROWTYPE_ADD) && $t_jadwalpel->EventCancelled) // Update failed
			$t_jadwalpel_grid->restoreCurrentRowFormValues($t_jadwalpel_grid->RowIndex); // Restore form values
		if ($t_jadwalpel->RowType == ROWTYPE_EDIT) // Edit row
			$t_jadwalpel_grid->EditRowCount++;
		if ($t_jadwalpel->isConfirm()) // Confirm row
			$t_jadwalpel_grid->restoreCurrentRowFormValues($t_jadwalpel_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_jadwalpel->RowAttrs->merge(["data-rowindex" => $t_jadwalpel_grid->RowCount, "id" => "r" . $t_jadwalpel_grid->RowCount . "_t_jadwalpel", "data-rowtype" => $t_jadwalpel->RowType]);

		// Render row
		$t_jadwalpel_grid->renderRow();

		// Render list options
		$t_jadwalpel_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_jadwalpel_grid->RowAction != "delete" && $t_jadwalpel_grid->RowAction != "insertdelete" && !($t_jadwalpel_grid->RowAction == "insert" && $t_jadwalpel->isConfirm() && $t_jadwalpel_grid->emptyRow())) {
?>
	<tr <?php echo $t_jadwalpel->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_jadwalpel_grid->ListOptions->render("body", "left", $t_jadwalpel_grid->RowCount);
?>
	<?php if ($t_jadwalpel_grid->tgl->Visible) { // tgl ?>
		<td data-name="tgl" <?php echo $t_jadwalpel_grid->tgl->cellAttributes() ?>>
<?php if ($t_jadwalpel->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalpel_grid->RowCount ?>_t_jadwalpel_tgl" class="form-group">
<input type="text" data-table="t_jadwalpel" data-field="x_tgl" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_jadwalpel_grid->tgl->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_grid->tgl->EditValue ?>"<?php echo $t_jadwalpel_grid->tgl->editAttributes() ?>>
<?php if (!$t_jadwalpel_grid->tgl->ReadOnly && !$t_jadwalpel_grid->tgl->Disabled && !isset($t_jadwalpel_grid->tgl->EditAttrs["readonly"]) && !isset($t_jadwalpel_grid->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpelgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_jadwalpelgrid", "x<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_tgl" name="o<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl" id="o<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl" value="<?php echo HtmlEncode($t_jadwalpel_grid->tgl->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jadwalpel_grid->RowCount ?>_t_jadwalpel_tgl" class="form-group">
<input type="text" data-table="t_jadwalpel" data-field="x_tgl" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_jadwalpel_grid->tgl->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_grid->tgl->EditValue ?>"<?php echo $t_jadwalpel_grid->tgl->editAttributes() ?>>
<?php if (!$t_jadwalpel_grid->tgl->ReadOnly && !$t_jadwalpel_grid->tgl->Disabled && !isset($t_jadwalpel_grid->tgl->EditAttrs["readonly"]) && !isset($t_jadwalpel_grid->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpelgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_jadwalpelgrid", "x<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalpel_grid->RowCount ?>_t_jadwalpel_tgl">
<span<?php echo $t_jadwalpel_grid->tgl->viewAttributes() ?>><?php echo $t_jadwalpel_grid->tgl->getViewValue() ?></span>
</span>
<?php if (!$t_jadwalpel->isConfirm()) { ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_tgl" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl" value="<?php echo HtmlEncode($t_jadwalpel_grid->tgl->FormValue) ?>">
<input type="hidden" data-table="t_jadwalpel" data-field="x_tgl" name="o<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl" id="o<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl" value="<?php echo HtmlEncode($t_jadwalpel_grid->tgl->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_tgl" name="ft_jadwalpelgrid$x<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl" id="ft_jadwalpelgrid$x<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl" value="<?php echo HtmlEncode($t_jadwalpel_grid->tgl->FormValue) ?>">
<input type="hidden" data-table="t_jadwalpel" data-field="x_tgl" name="ft_jadwalpelgrid$o<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl" id="ft_jadwalpelgrid$o<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl" value="<?php echo HtmlEncode($t_jadwalpel_grid->tgl->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_idjadwal" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_idjadwal" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_idjadwal" value="<?php echo HtmlEncode($t_jadwalpel_grid->idjadwal->CurrentValue) ?>">
<input type="hidden" data-table="t_jadwalpel" data-field="x_idjadwal" name="o<?php echo $t_jadwalpel_grid->RowIndex ?>_idjadwal" id="o<?php echo $t_jadwalpel_grid->RowIndex ?>_idjadwal" value="<?php echo HtmlEncode($t_jadwalpel_grid->idjadwal->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_EDIT || $t_jadwalpel->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_idjadwal" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_idjadwal" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_idjadwal" value="<?php echo HtmlEncode($t_jadwalpel_grid->idjadwal->CurrentValue) ?>">
<?php } ?>
	<?php if ($t_jadwalpel_grid->jam->Visible) { // jam ?>
		<td data-name="jam" <?php echo $t_jadwalpel_grid->jam->cellAttributes() ?>>
<?php if ($t_jadwalpel->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalpel_grid->RowCount ?>_t_jadwalpel_jam" class="form-group">
<input type="text" data-table="t_jadwalpel" data-field="x_jam" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam" size="5" placeholder="<?php echo HtmlEncode($t_jadwalpel_grid->jam->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_grid->jam->EditValue ?>"<?php echo $t_jadwalpel_grid->jam->editAttributes() ?>>
<?php if (!$t_jadwalpel_grid->jam->ReadOnly && !$t_jadwalpel_grid->jam->Disabled && !isset($t_jadwalpel_grid->jam->EditAttrs["readonly"]) && !isset($t_jadwalpel_grid->jam->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpelgrid", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalpelgrid", "x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_jam" name="o<?php echo $t_jadwalpel_grid->RowIndex ?>_jam" id="o<?php echo $t_jadwalpel_grid->RowIndex ?>_jam" value="<?php echo HtmlEncode($t_jadwalpel_grid->jam->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jadwalpel_grid->RowCount ?>_t_jadwalpel_jam" class="form-group">
<input type="text" data-table="t_jadwalpel" data-field="x_jam" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam" size="5" placeholder="<?php echo HtmlEncode($t_jadwalpel_grid->jam->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_grid->jam->EditValue ?>"<?php echo $t_jadwalpel_grid->jam->editAttributes() ?>>
<?php if (!$t_jadwalpel_grid->jam->ReadOnly && !$t_jadwalpel_grid->jam->Disabled && !isset($t_jadwalpel_grid->jam->EditAttrs["readonly"]) && !isset($t_jadwalpel_grid->jam->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpelgrid", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalpelgrid", "x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalpel_grid->RowCount ?>_t_jadwalpel_jam">
<span<?php echo $t_jadwalpel_grid->jam->viewAttributes() ?>><?php echo $t_jadwalpel_grid->jam->getViewValue() ?></span>
</span>
<?php if (!$t_jadwalpel->isConfirm()) { ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_jam" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam" value="<?php echo HtmlEncode($t_jadwalpel_grid->jam->FormValue) ?>">
<input type="hidden" data-table="t_jadwalpel" data-field="x_jam" name="o<?php echo $t_jadwalpel_grid->RowIndex ?>_jam" id="o<?php echo $t_jadwalpel_grid->RowIndex ?>_jam" value="<?php echo HtmlEncode($t_jadwalpel_grid->jam->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_jam" name="ft_jadwalpelgrid$x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam" id="ft_jadwalpelgrid$x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam" value="<?php echo HtmlEncode($t_jadwalpel_grid->jam->FormValue) ?>">
<input type="hidden" data-table="t_jadwalpel" data-field="x_jam" name="ft_jadwalpelgrid$o<?php echo $t_jadwalpel_grid->RowIndex ?>_jam" id="ft_jadwalpelgrid$o<?php echo $t_jadwalpel_grid->RowIndex ?>_jam" value="<?php echo HtmlEncode($t_jadwalpel_grid->jam->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_grid->jam_akhir->Visible) { // jam_akhir ?>
		<td data-name="jam_akhir" <?php echo $t_jadwalpel_grid->jam_akhir->cellAttributes() ?>>
<?php if ($t_jadwalpel->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalpel_grid->RowCount ?>_t_jadwalpel_jam_akhir" class="form-group">
<input type="text" data-table="t_jadwalpel" data-field="x_jam_akhir" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir" size="5" placeholder="<?php echo HtmlEncode($t_jadwalpel_grid->jam_akhir->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_grid->jam_akhir->EditValue ?>"<?php echo $t_jadwalpel_grid->jam_akhir->editAttributes() ?>>
<?php if (!$t_jadwalpel_grid->jam_akhir->ReadOnly && !$t_jadwalpel_grid->jam_akhir->Disabled && !isset($t_jadwalpel_grid->jam_akhir->EditAttrs["readonly"]) && !isset($t_jadwalpel_grid->jam_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpelgrid", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalpelgrid", "x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_jam_akhir" name="o<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir" id="o<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir" value="<?php echo HtmlEncode($t_jadwalpel_grid->jam_akhir->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jadwalpel_grid->RowCount ?>_t_jadwalpel_jam_akhir" class="form-group">
<input type="text" data-table="t_jadwalpel" data-field="x_jam_akhir" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir" size="5" placeholder="<?php echo HtmlEncode($t_jadwalpel_grid->jam_akhir->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_grid->jam_akhir->EditValue ?>"<?php echo $t_jadwalpel_grid->jam_akhir->editAttributes() ?>>
<?php if (!$t_jadwalpel_grid->jam_akhir->ReadOnly && !$t_jadwalpel_grid->jam_akhir->Disabled && !isset($t_jadwalpel_grid->jam_akhir->EditAttrs["readonly"]) && !isset($t_jadwalpel_grid->jam_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpelgrid", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalpelgrid", "x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalpel_grid->RowCount ?>_t_jadwalpel_jam_akhir">
<span<?php echo $t_jadwalpel_grid->jam_akhir->viewAttributes() ?>><?php echo $t_jadwalpel_grid->jam_akhir->getViewValue() ?></span>
</span>
<?php if (!$t_jadwalpel->isConfirm()) { ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_jam_akhir" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir" value="<?php echo HtmlEncode($t_jadwalpel_grid->jam_akhir->FormValue) ?>">
<input type="hidden" data-table="t_jadwalpel" data-field="x_jam_akhir" name="o<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir" id="o<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir" value="<?php echo HtmlEncode($t_jadwalpel_grid->jam_akhir->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_jam_akhir" name="ft_jadwalpelgrid$x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir" id="ft_jadwalpelgrid$x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir" value="<?php echo HtmlEncode($t_jadwalpel_grid->jam_akhir->FormValue) ?>">
<input type="hidden" data-table="t_jadwalpel" data-field="x_jam_akhir" name="ft_jadwalpelgrid$o<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir" id="ft_jadwalpelgrid$o<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir" value="<?php echo HtmlEncode($t_jadwalpel_grid->jam_akhir->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_grid->materi->Visible) { // materi ?>
		<td data-name="materi" <?php echo $t_jadwalpel_grid->materi->cellAttributes() ?>>
<?php if ($t_jadwalpel->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalpel_grid->RowCount ?>_t_jadwalpel_materi" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_jadwalpel" data-field="x_materi" data-value-separator="<?php echo $t_jadwalpel_grid->materi->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_materi" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_materi"<?php echo $t_jadwalpel_grid->materi->editAttributes() ?>>
			<?php echo $t_jadwalpel_grid->materi->selectOptionListHtml("x{$t_jadwalpel_grid->RowIndex}_materi") ?>
		</select>
</div>
<?php echo $t_jadwalpel_grid->materi->Lookup->getParamTag($t_jadwalpel_grid, "p_x" . $t_jadwalpel_grid->RowIndex . "_materi") ?>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_materi" name="o<?php echo $t_jadwalpel_grid->RowIndex ?>_materi" id="o<?php echo $t_jadwalpel_grid->RowIndex ?>_materi" value="<?php echo HtmlEncode($t_jadwalpel_grid->materi->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jadwalpel_grid->RowCount ?>_t_jadwalpel_materi" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_jadwalpel" data-field="x_materi" data-value-separator="<?php echo $t_jadwalpel_grid->materi->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_materi" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_materi"<?php echo $t_jadwalpel_grid->materi->editAttributes() ?>>
			<?php echo $t_jadwalpel_grid->materi->selectOptionListHtml("x{$t_jadwalpel_grid->RowIndex}_materi") ?>
		</select>
</div>
<?php echo $t_jadwalpel_grid->materi->Lookup->getParamTag($t_jadwalpel_grid, "p_x" . $t_jadwalpel_grid->RowIndex . "_materi") ?>
</span>
<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalpel_grid->RowCount ?>_t_jadwalpel_materi">
<span<?php echo $t_jadwalpel_grid->materi->viewAttributes() ?>><?php echo $t_jadwalpel_grid->materi->getViewValue() ?></span>
</span>
<?php if (!$t_jadwalpel->isConfirm()) { ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_materi" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_materi" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_materi" value="<?php echo HtmlEncode($t_jadwalpel_grid->materi->FormValue) ?>">
<input type="hidden" data-table="t_jadwalpel" data-field="x_materi" name="o<?php echo $t_jadwalpel_grid->RowIndex ?>_materi" id="o<?php echo $t_jadwalpel_grid->RowIndex ?>_materi" value="<?php echo HtmlEncode($t_jadwalpel_grid->materi->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_materi" name="ft_jadwalpelgrid$x<?php echo $t_jadwalpel_grid->RowIndex ?>_materi" id="ft_jadwalpelgrid$x<?php echo $t_jadwalpel_grid->RowIndex ?>_materi" value="<?php echo HtmlEncode($t_jadwalpel_grid->materi->FormValue) ?>">
<input type="hidden" data-table="t_jadwalpel" data-field="x_materi" name="ft_jadwalpelgrid$o<?php echo $t_jadwalpel_grid->RowIndex ?>_materi" id="ft_jadwalpelgrid$o<?php echo $t_jadwalpel_grid->RowIndex ?>_materi" value="<?php echo HtmlEncode($t_jadwalpel_grid->materi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_grid->instruktur->Visible) { // instruktur ?>
		<td data-name="instruktur" <?php echo $t_jadwalpel_grid->instruktur->cellAttributes() ?>>
<?php if ($t_jadwalpel->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalpel_grid->RowCount ?>_t_jadwalpel_instruktur" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_jadwalpel" data-field="x_instruktur" data-value-separator="<?php echo $t_jadwalpel_grid->instruktur->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_instruktur" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_instruktur"<?php echo $t_jadwalpel_grid->instruktur->editAttributes() ?>>
			<?php echo $t_jadwalpel_grid->instruktur->selectOptionListHtml("x{$t_jadwalpel_grid->RowIndex}_instruktur") ?>
		</select>
</div>
<?php echo $t_jadwalpel_grid->instruktur->Lookup->getParamTag($t_jadwalpel_grid, "p_x" . $t_jadwalpel_grid->RowIndex . "_instruktur") ?>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_instruktur" name="o<?php echo $t_jadwalpel_grid->RowIndex ?>_instruktur" id="o<?php echo $t_jadwalpel_grid->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_jadwalpel_grid->instruktur->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jadwalpel_grid->RowCount ?>_t_jadwalpel_instruktur" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_jadwalpel" data-field="x_instruktur" data-value-separator="<?php echo $t_jadwalpel_grid->instruktur->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_instruktur" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_instruktur"<?php echo $t_jadwalpel_grid->instruktur->editAttributes() ?>>
			<?php echo $t_jadwalpel_grid->instruktur->selectOptionListHtml("x{$t_jadwalpel_grid->RowIndex}_instruktur") ?>
		</select>
</div>
<?php echo $t_jadwalpel_grid->instruktur->Lookup->getParamTag($t_jadwalpel_grid, "p_x" . $t_jadwalpel_grid->RowIndex . "_instruktur") ?>
</span>
<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalpel_grid->RowCount ?>_t_jadwalpel_instruktur">
<span<?php echo $t_jadwalpel_grid->instruktur->viewAttributes() ?>><?php echo $t_jadwalpel_grid->instruktur->getViewValue() ?></span>
</span>
<?php if (!$t_jadwalpel->isConfirm()) { ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_instruktur" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_instruktur" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_jadwalpel_grid->instruktur->FormValue) ?>">
<input type="hidden" data-table="t_jadwalpel" data-field="x_instruktur" name="o<?php echo $t_jadwalpel_grid->RowIndex ?>_instruktur" id="o<?php echo $t_jadwalpel_grid->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_jadwalpel_grid->instruktur->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_instruktur" name="ft_jadwalpelgrid$x<?php echo $t_jadwalpel_grid->RowIndex ?>_instruktur" id="ft_jadwalpelgrid$x<?php echo $t_jadwalpel_grid->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_jadwalpel_grid->instruktur->FormValue) ?>">
<input type="hidden" data-table="t_jadwalpel" data-field="x_instruktur" name="ft_jadwalpelgrid$o<?php echo $t_jadwalpel_grid->RowIndex ?>_instruktur" id="ft_jadwalpelgrid$o<?php echo $t_jadwalpel_grid->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_jadwalpel_grid->instruktur->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_grid->instansi->Visible) { // instansi ?>
		<td data-name="instansi" <?php echo $t_jadwalpel_grid->instansi->cellAttributes() ?>>
<?php if ($t_jadwalpel->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalpel_grid->RowCount ?>_t_jadwalpel_instansi" class="form-group">
<input type="text" data-table="t_jadwalpel" data-field="x_instansi" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_instansi" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_instansi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_jadwalpel_grid->instansi->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_grid->instansi->EditValue ?>"<?php echo $t_jadwalpel_grid->instansi->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_instansi" name="o<?php echo $t_jadwalpel_grid->RowIndex ?>_instansi" id="o<?php echo $t_jadwalpel_grid->RowIndex ?>_instansi" value="<?php echo HtmlEncode($t_jadwalpel_grid->instansi->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jadwalpel_grid->RowCount ?>_t_jadwalpel_instansi" class="form-group">
<input type="text" data-table="t_jadwalpel" data-field="x_instansi" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_instansi" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_instansi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_jadwalpel_grid->instansi->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_grid->instansi->EditValue ?>"<?php echo $t_jadwalpel_grid->instansi->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalpel_grid->RowCount ?>_t_jadwalpel_instansi">
<span<?php echo $t_jadwalpel_grid->instansi->viewAttributes() ?>><?php echo $t_jadwalpel_grid->instansi->getViewValue() ?></span>
</span>
<?php if (!$t_jadwalpel->isConfirm()) { ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_instansi" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_instansi" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_instansi" value="<?php echo HtmlEncode($t_jadwalpel_grid->instansi->FormValue) ?>">
<input type="hidden" data-table="t_jadwalpel" data-field="x_instansi" name="o<?php echo $t_jadwalpel_grid->RowIndex ?>_instansi" id="o<?php echo $t_jadwalpel_grid->RowIndex ?>_instansi" value="<?php echo HtmlEncode($t_jadwalpel_grid->instansi->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_instansi" name="ft_jadwalpelgrid$x<?php echo $t_jadwalpel_grid->RowIndex ?>_instansi" id="ft_jadwalpelgrid$x<?php echo $t_jadwalpel_grid->RowIndex ?>_instansi" value="<?php echo HtmlEncode($t_jadwalpel_grid->instansi->FormValue) ?>">
<input type="hidden" data-table="t_jadwalpel" data-field="x_instansi" name="ft_jadwalpelgrid$o<?php echo $t_jadwalpel_grid->RowIndex ?>_instansi" id="ft_jadwalpelgrid$o<?php echo $t_jadwalpel_grid->RowIndex ?>_instansi" value="<?php echo HtmlEncode($t_jadwalpel_grid->instansi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_grid->ket->Visible) { // ket ?>
		<td data-name="ket" <?php echo $t_jadwalpel_grid->ket->cellAttributes() ?>>
<?php if ($t_jadwalpel->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jadwalpel_grid->RowCount ?>_t_jadwalpel_ket" class="form-group">
<input type="text" data-table="t_jadwalpel" data-field="x_ket" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_ket" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_ket" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_jadwalpel_grid->ket->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_grid->ket->EditValue ?>"<?php echo $t_jadwalpel_grid->ket->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_ket" name="o<?php echo $t_jadwalpel_grid->RowIndex ?>_ket" id="o<?php echo $t_jadwalpel_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_jadwalpel_grid->ket->OldValue) ?>">
<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jadwalpel_grid->RowCount ?>_t_jadwalpel_ket" class="form-group">
<input type="text" data-table="t_jadwalpel" data-field="x_ket" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_ket" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_ket" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_jadwalpel_grid->ket->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_grid->ket->EditValue ?>"<?php echo $t_jadwalpel_grid->ket->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_jadwalpel->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jadwalpel_grid->RowCount ?>_t_jadwalpel_ket">
<span<?php echo $t_jadwalpel_grid->ket->viewAttributes() ?>><?php echo $t_jadwalpel_grid->ket->getViewValue() ?></span>
</span>
<?php if (!$t_jadwalpel->isConfirm()) { ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_ket" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_ket" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_jadwalpel_grid->ket->FormValue) ?>">
<input type="hidden" data-table="t_jadwalpel" data-field="x_ket" name="o<?php echo $t_jadwalpel_grid->RowIndex ?>_ket" id="o<?php echo $t_jadwalpel_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_jadwalpel_grid->ket->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_ket" name="ft_jadwalpelgrid$x<?php echo $t_jadwalpel_grid->RowIndex ?>_ket" id="ft_jadwalpelgrid$x<?php echo $t_jadwalpel_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_jadwalpel_grid->ket->FormValue) ?>">
<input type="hidden" data-table="t_jadwalpel" data-field="x_ket" name="ft_jadwalpelgrid$o<?php echo $t_jadwalpel_grid->RowIndex ?>_ket" id="ft_jadwalpelgrid$o<?php echo $t_jadwalpel_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_jadwalpel_grid->ket->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_jadwalpel_grid->ListOptions->render("body", "right", $t_jadwalpel_grid->RowCount);
?>
	</tr>
<?php if ($t_jadwalpel->RowType == ROWTYPE_ADD || $t_jadwalpel->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_jadwalpelgrid", "load"], function() {
	ft_jadwalpelgrid.updateLists(<?php echo $t_jadwalpel_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_jadwalpel_grid->isGridAdd() || $t_jadwalpel->CurrentMode == "copy")
		if (!$t_jadwalpel_grid->Recordset->EOF)
			$t_jadwalpel_grid->Recordset->moveNext();
}
?>
<?php
	if ($t_jadwalpel->CurrentMode == "add" || $t_jadwalpel->CurrentMode == "copy" || $t_jadwalpel->CurrentMode == "edit") {
		$t_jadwalpel_grid->RowIndex = '$rowindex$';
		$t_jadwalpel_grid->loadRowValues();

		// Set row properties
		$t_jadwalpel->resetAttributes();
		$t_jadwalpel->RowAttrs->merge(["data-rowindex" => $t_jadwalpel_grid->RowIndex, "id" => "r0_t_jadwalpel", "data-rowtype" => ROWTYPE_ADD]);
		$t_jadwalpel->RowAttrs->appendClass("ew-template");
		$t_jadwalpel->RowType = ROWTYPE_ADD;

		// Render row
		$t_jadwalpel_grid->renderRow();

		// Render list options
		$t_jadwalpel_grid->renderListOptions();
		$t_jadwalpel_grid->StartRowCount = 0;
?>
	<tr <?php echo $t_jadwalpel->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_jadwalpel_grid->ListOptions->render("body", "left", $t_jadwalpel_grid->RowIndex);
?>
	<?php if ($t_jadwalpel_grid->tgl->Visible) { // tgl ?>
		<td data-name="tgl">
<?php if (!$t_jadwalpel->isConfirm()) { ?>
<span id="el$rowindex$_t_jadwalpel_tgl" class="form-group t_jadwalpel_tgl">
<input type="text" data-table="t_jadwalpel" data-field="x_tgl" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_jadwalpel_grid->tgl->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_grid->tgl->EditValue ?>"<?php echo $t_jadwalpel_grid->tgl->editAttributes() ?>>
<?php if (!$t_jadwalpel_grid->tgl->ReadOnly && !$t_jadwalpel_grid->tgl->Disabled && !isset($t_jadwalpel_grid->tgl->EditAttrs["readonly"]) && !isset($t_jadwalpel_grid->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpelgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_jadwalpelgrid", "x<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jadwalpel_tgl" class="form-group t_jadwalpel_tgl">
<span<?php echo $t_jadwalpel_grid->tgl->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_jadwalpel_grid->tgl->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_tgl" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl" value="<?php echo HtmlEncode($t_jadwalpel_grid->tgl->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_tgl" name="o<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl" id="o<?php echo $t_jadwalpel_grid->RowIndex ?>_tgl" value="<?php echo HtmlEncode($t_jadwalpel_grid->tgl->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_grid->jam->Visible) { // jam ?>
		<td data-name="jam">
<?php if (!$t_jadwalpel->isConfirm()) { ?>
<span id="el$rowindex$_t_jadwalpel_jam" class="form-group t_jadwalpel_jam">
<input type="text" data-table="t_jadwalpel" data-field="x_jam" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam" size="5" placeholder="<?php echo HtmlEncode($t_jadwalpel_grid->jam->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_grid->jam->EditValue ?>"<?php echo $t_jadwalpel_grid->jam->editAttributes() ?>>
<?php if (!$t_jadwalpel_grid->jam->ReadOnly && !$t_jadwalpel_grid->jam->Disabled && !isset($t_jadwalpel_grid->jam->EditAttrs["readonly"]) && !isset($t_jadwalpel_grid->jam->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpelgrid", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalpelgrid", "x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jadwalpel_jam" class="form-group t_jadwalpel_jam">
<span<?php echo $t_jadwalpel_grid->jam->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_jadwalpel_grid->jam->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_jam" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam" value="<?php echo HtmlEncode($t_jadwalpel_grid->jam->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_jam" name="o<?php echo $t_jadwalpel_grid->RowIndex ?>_jam" id="o<?php echo $t_jadwalpel_grid->RowIndex ?>_jam" value="<?php echo HtmlEncode($t_jadwalpel_grid->jam->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_grid->jam_akhir->Visible) { // jam_akhir ?>
		<td data-name="jam_akhir">
<?php if (!$t_jadwalpel->isConfirm()) { ?>
<span id="el$rowindex$_t_jadwalpel_jam_akhir" class="form-group t_jadwalpel_jam_akhir">
<input type="text" data-table="t_jadwalpel" data-field="x_jam_akhir" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir" size="5" placeholder="<?php echo HtmlEncode($t_jadwalpel_grid->jam_akhir->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_grid->jam_akhir->EditValue ?>"<?php echo $t_jadwalpel_grid->jam_akhir->editAttributes() ?>>
<?php if (!$t_jadwalpel_grid->jam_akhir->ReadOnly && !$t_jadwalpel_grid->jam_akhir->Disabled && !isset($t_jadwalpel_grid->jam_akhir->EditAttrs["readonly"]) && !isset($t_jadwalpel_grid->jam_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpelgrid", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalpelgrid", "x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jadwalpel_jam_akhir" class="form-group t_jadwalpel_jam_akhir">
<span<?php echo $t_jadwalpel_grid->jam_akhir->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_jadwalpel_grid->jam_akhir->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_jam_akhir" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir" value="<?php echo HtmlEncode($t_jadwalpel_grid->jam_akhir->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_jam_akhir" name="o<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir" id="o<?php echo $t_jadwalpel_grid->RowIndex ?>_jam_akhir" value="<?php echo HtmlEncode($t_jadwalpel_grid->jam_akhir->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_grid->materi->Visible) { // materi ?>
		<td data-name="materi">
<?php if (!$t_jadwalpel->isConfirm()) { ?>
<span id="el$rowindex$_t_jadwalpel_materi" class="form-group t_jadwalpel_materi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_jadwalpel" data-field="x_materi" data-value-separator="<?php echo $t_jadwalpel_grid->materi->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_materi" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_materi"<?php echo $t_jadwalpel_grid->materi->editAttributes() ?>>
			<?php echo $t_jadwalpel_grid->materi->selectOptionListHtml("x{$t_jadwalpel_grid->RowIndex}_materi") ?>
		</select>
</div>
<?php echo $t_jadwalpel_grid->materi->Lookup->getParamTag($t_jadwalpel_grid, "p_x" . $t_jadwalpel_grid->RowIndex . "_materi") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jadwalpel_materi" class="form-group t_jadwalpel_materi">
<span<?php echo $t_jadwalpel_grid->materi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_jadwalpel_grid->materi->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_materi" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_materi" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_materi" value="<?php echo HtmlEncode($t_jadwalpel_grid->materi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_materi" name="o<?php echo $t_jadwalpel_grid->RowIndex ?>_materi" id="o<?php echo $t_jadwalpel_grid->RowIndex ?>_materi" value="<?php echo HtmlEncode($t_jadwalpel_grid->materi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_grid->instruktur->Visible) { // instruktur ?>
		<td data-name="instruktur">
<?php if (!$t_jadwalpel->isConfirm()) { ?>
<span id="el$rowindex$_t_jadwalpel_instruktur" class="form-group t_jadwalpel_instruktur">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_jadwalpel" data-field="x_instruktur" data-value-separator="<?php echo $t_jadwalpel_grid->instruktur->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_instruktur" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_instruktur"<?php echo $t_jadwalpel_grid->instruktur->editAttributes() ?>>
			<?php echo $t_jadwalpel_grid->instruktur->selectOptionListHtml("x{$t_jadwalpel_grid->RowIndex}_instruktur") ?>
		</select>
</div>
<?php echo $t_jadwalpel_grid->instruktur->Lookup->getParamTag($t_jadwalpel_grid, "p_x" . $t_jadwalpel_grid->RowIndex . "_instruktur") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jadwalpel_instruktur" class="form-group t_jadwalpel_instruktur">
<span<?php echo $t_jadwalpel_grid->instruktur->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_jadwalpel_grid->instruktur->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_instruktur" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_instruktur" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_jadwalpel_grid->instruktur->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_instruktur" name="o<?php echo $t_jadwalpel_grid->RowIndex ?>_instruktur" id="o<?php echo $t_jadwalpel_grid->RowIndex ?>_instruktur" value="<?php echo HtmlEncode($t_jadwalpel_grid->instruktur->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_grid->instansi->Visible) { // instansi ?>
		<td data-name="instansi">
<?php if (!$t_jadwalpel->isConfirm()) { ?>
<span id="el$rowindex$_t_jadwalpel_instansi" class="form-group t_jadwalpel_instansi">
<input type="text" data-table="t_jadwalpel" data-field="x_instansi" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_instansi" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_instansi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_jadwalpel_grid->instansi->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_grid->instansi->EditValue ?>"<?php echo $t_jadwalpel_grid->instansi->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jadwalpel_instansi" class="form-group t_jadwalpel_instansi">
<span<?php echo $t_jadwalpel_grid->instansi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_jadwalpel_grid->instansi->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_instansi" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_instansi" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_instansi" value="<?php echo HtmlEncode($t_jadwalpel_grid->instansi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_instansi" name="o<?php echo $t_jadwalpel_grid->RowIndex ?>_instansi" id="o<?php echo $t_jadwalpel_grid->RowIndex ?>_instansi" value="<?php echo HtmlEncode($t_jadwalpel_grid->instansi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jadwalpel_grid->ket->Visible) { // ket ?>
		<td data-name="ket">
<?php if (!$t_jadwalpel->isConfirm()) { ?>
<span id="el$rowindex$_t_jadwalpel_ket" class="form-group t_jadwalpel_ket">
<input type="text" data-table="t_jadwalpel" data-field="x_ket" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_ket" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_ket" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_jadwalpel_grid->ket->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_grid->ket->EditValue ?>"<?php echo $t_jadwalpel_grid->ket->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jadwalpel_ket" class="form-group t_jadwalpel_ket">
<span<?php echo $t_jadwalpel_grid->ket->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_jadwalpel_grid->ket->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_ket" name="x<?php echo $t_jadwalpel_grid->RowIndex ?>_ket" id="x<?php echo $t_jadwalpel_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_jadwalpel_grid->ket->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jadwalpel" data-field="x_ket" name="o<?php echo $t_jadwalpel_grid->RowIndex ?>_ket" id="o<?php echo $t_jadwalpel_grid->RowIndex ?>_ket" value="<?php echo HtmlEncode($t_jadwalpel_grid->ket->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_jadwalpel_grid->ListOptions->render("body", "right", $t_jadwalpel_grid->RowIndex);
?>
<script>
loadjs.ready(["ft_jadwalpelgrid", "load"], function() {
	ft_jadwalpelgrid.updateLists(<?php echo $t_jadwalpel_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($t_jadwalpel->CurrentMode == "add" || $t_jadwalpel->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $t_jadwalpel_grid->FormKeyCountName ?>" id="<?php echo $t_jadwalpel_grid->FormKeyCountName ?>" value="<?php echo $t_jadwalpel_grid->KeyCount ?>">
<?php echo $t_jadwalpel_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_jadwalpel->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $t_jadwalpel_grid->FormKeyCountName ?>" id="<?php echo $t_jadwalpel_grid->FormKeyCountName ?>" value="<?php echo $t_jadwalpel_grid->KeyCount ?>">
<?php echo $t_jadwalpel_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_jadwalpel->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_jadwalpelgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_jadwalpel_grid->Recordset)
	$t_jadwalpel_grid->Recordset->Close();
?>
<?php if ($t_jadwalpel_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $t_jadwalpel_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_jadwalpel_grid->TotalRecords == 0 && !$t_jadwalpel->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_jadwalpel_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$t_jadwalpel_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$("th[data-name='tgl'],th[data-name='jam']").css("width","100px"),$(".ewAdd").hide(),$("#r_real_peserta td").hide(),$("#r_independen td").hide(),$("#r_swasta_k td").hide(),$("#r_swasta_m td").hide(),$("#r_swasta_b td").hide(),$("#r_bumn td").hide(),$("#r_koperasi td").hide(),$("#r_pns td").hide(),$("#r_pt_dosen td").hide(),$("#r_pt_mhs td").hide(),$("#r_jk_l td").hide(),$("#r_jk_p td").hide(),$("#r_usia_k45 td").hide(),$("#r_usia_b45 td").hide(),$("#r_produk td").hide(),$("#tab_t_pelatihan2").click(function(){$("#r_kdkec td").hide("slow"),$("#r_ketua td").hide("slow"),$("#r_sekretaris td").hide("slow"),$("#r_bendahara td").hide("slow"),$("#r_jenispel td").hide("slow"),$("#r_kdkategori td").hide("slow"),$("#r_kerjasama td").hide("slow"),$("#r_biaya td").hide("slow"),$("#r_coachingprogr td").hide("slow"),$("#r_area td").hide("slow"),$("#r_periode_awal td").hide("slow"),$("#r_periode_akhir td").hide("slow"),$("#r_tahapan td").hide("slow"),$("#r_namaberkas td").hide("slow"),$("#r_instruktur td").hide("slow"),$("#r_jpeserta td").hide("slow"),$("#r_bbio td").hide("slow"),$("#r_real_peserta td").show("slow"),$("#r_independen td").show("slow"),$("#r_swasta_k td").show("slow"),$("#r_swasta_m td").show("slow"),$("#r_swasta_b td").show("slow"),$("#r_bumn td").show("slow"),$("#r_koperasi td").show("slow"),$("#r_pns td").show("slow"),$("#r_pt_dosen td").show("slow"),$("#r_pt_mhs td").show("slow"),$("#r_jk_l td").show("slow"),$("#r_jk_p td").show("slow"),$("#r_usia_k45 td").show("slow"),$("#r_usia_b45 td").show("slow"),$("#r_produk td").show("slow")}),$("#tab_t_pelatihan1").click(function(){$("#r_real_peserta td").hide("slow"),$("#r_independen td").hide("slow"),$("#r_swasta_k td").hide("slow"),$("#r_swasta_m td").hide("slow"),$("#r_swasta_b td").hide("slow"),$("#r_bumn td").hide("slow"),$("#r_koperasi td").hide("slow"),$("#r_pns td").hide("slow"),$("#r_pt_dosen td").hide("slow"),$("#r_pt_mhs td").hide("slow"),$("#r_jk_l td").hide("slow"),$("#r_jk_p td").hide("slow"),$("#r_usia_k45 td").hide("slow"),$("#r_usia_b45 td").hide("slow"),$("#r_produk td").hide("slow"),$("#r_kdkec td").show("slow"),$("#r_ketua td").show("slow"),$("#r_sekretaris td").show("slow"),$("#r_bendahara td").show("slow"),$("#r_jenispel td").show("slow"),$("#r_kdkategori td").show("slow"),$("#r_kerjasama td").show("slow"),$("#r_biaya td").show("slow"),$("#r_coachingprogr td").show("slow"),$("#r_area td").show("slow"),$("#r_periode_awal td").show("slow"),$("#r_periode_akhir td").show("slow"),$("#r_tahapan td").show("slow"),$("#r_namaberkas td").show("slow"),$("#r_instruktur td").show("slow"),$("#r_jpeserta td").show("slow"),$("#r_bbio td").show("slow")}),$("body").mouseover(function(){$(".ui-timepicker-input").css("width","100px")}),$("#el0_t_jadwalpel_materi").after("<div class='badge badge-secondary'>Kosongkan jika diluar materi</div?"),$("#el0_t_jadwalpel_instruktur").after("<div class='badge badge-secondary'>Kosongkan jika diluar materi</div?"),$("#el0_t_jadwalpel_instansi").after("<div class='badge badge-secondary'>Kosongkan jika diluar materi</div?");
});
</script>
<?php if (!$t_jadwalpel->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_t_jadwalpel",
		width: "100%",
		height: "350px"
	});
});
</script>
<?php } ?>
<?php } ?>
<?php
$t_jadwalpel_grid->terminate();
?>