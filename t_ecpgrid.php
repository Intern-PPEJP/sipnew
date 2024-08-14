<?php
namespace PHPMaker2020\ppei_20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($t_ecp_grid))
	$t_ecp_grid = new t_ecp_grid();

// Run the page
$t_ecp_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_ecp_grid->Page_Render();
?>
<?php if (!$t_ecp_grid->isExport()) { ?>
<script>
var ft_ecpgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	ft_ecpgrid = new ew.Form("ft_ecpgrid", "grid");
	ft_ecpgrid.formKeyCountName = '<?php echo $t_ecp_grid->FormKeyCountName ?>';

	// Validate form
	ft_ecpgrid.validate = function() {
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
			<?php if ($t_ecp_grid->Daerah->Required) { ?>
				elm = this.getElements("x" + infix + "_Daerah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_grid->Daerah->caption(), $t_ecp_grid->Daerah->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_ecp_grid->Produk->Required) { ?>
				elm = this.getElements("x" + infix + "_Produk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_grid->Produk->caption(), $t_ecp_grid->Produk->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_ecp_grid->Tgl_Bln_Ekspor->Required) { ?>
				elm = this.getElements("x" + infix + "_Tgl_Bln_Ekspor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_grid->Tgl_Bln_Ekspor->caption(), $t_ecp_grid->Tgl_Bln_Ekspor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_ecp_grid->Tahun_Ekspor->Required) { ?>
				elm = this.getElements("x" + infix + "_Tahun_Ekspor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_grid->Tahun_Ekspor->caption(), $t_ecp_grid->Tahun_Ekspor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_ecp_grid->Negara_Tujuan->Required) { ?>
				elm = this.getElements("x" + infix + "_Negara_Tujuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_grid->Negara_Tujuan->caption(), $t_ecp_grid->Negara_Tujuan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_ecp_grid->Nilai_Ekspor_USD->Required) { ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_USD");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_grid->Nilai_Ekspor_USD->caption(), $t_ecp_grid->Nilai_Ekspor_USD->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_USD");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_ecp_grid->Nilai_Ekspor_USD->errorMessage()) ?>");
			<?php if ($t_ecp_grid->Nilai_Ekspor_Rupiah->Required) { ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_Rupiah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_grid->Nilai_Ekspor_Rupiah->caption(), $t_ecp_grid->Nilai_Ekspor_Rupiah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_Rupiah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_ecp_grid->Nilai_Ekspor_Rupiah->errorMessage()) ?>");
			<?php if ($t_ecp_grid->Keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_Keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_ecp_grid->Keterangan->caption(), $t_ecp_grid->Keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	ft_ecpgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Daerah", false)) return false;
		if (ew.valueChanged(fobj, infix, "Produk", false)) return false;
		if (ew.valueChanged(fobj, infix, "Tgl_Bln_Ekspor", false)) return false;
		if (ew.valueChanged(fobj, infix, "Tahun_Ekspor", false)) return false;
		if (ew.valueChanged(fobj, infix, "Negara_Tujuan", false)) return false;
		if (ew.valueChanged(fobj, infix, "Nilai_Ekspor_USD", false)) return false;
		if (ew.valueChanged(fobj, infix, "Nilai_Ekspor_Rupiah", false)) return false;
		if (ew.valueChanged(fobj, infix, "Keterangan", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_ecpgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_ecpgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_ecpgrid.lists["x_Tahun_Ekspor"] = <?php echo $t_ecp_grid->Tahun_Ekspor->Lookup->toClientList($t_ecp_grid) ?>;
	ft_ecpgrid.lists["x_Tahun_Ekspor"].options = <?php echo JsonEncode($t_ecp_grid->Tahun_Ekspor->lookupOptions()) ?>;
	ft_ecpgrid.lists["x_Negara_Tujuan"] = <?php echo $t_ecp_grid->Negara_Tujuan->Lookup->toClientList($t_ecp_grid) ?>;
	ft_ecpgrid.lists["x_Negara_Tujuan"].options = <?php echo JsonEncode($t_ecp_grid->Negara_Tujuan->lookupOptions()) ?>;
	loadjs.done("ft_ecpgrid");
});
</script>
<?php } ?>
<?php
$t_ecp_grid->renderOtherOptions();
?>
<?php if ($t_ecp_grid->TotalRecords > 0 || $t_ecp->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_ecp_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_ecp">
<?php if ($t_ecp_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $t_ecp_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ft_ecpgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_t_ecp" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_t_ecpgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_ecp->RowType = ROWTYPE_HEADER;

// Render list options
$t_ecp_grid->renderListOptions();

// Render list options (header, left)
$t_ecp_grid->ListOptions->render("header", "left");
?>
<?php if ($t_ecp_grid->Daerah->Visible) { // Daerah ?>
	<?php if ($t_ecp_grid->SortUrl($t_ecp_grid->Daerah) == "") { ?>
		<th data-name="Daerah" class="<?php echo $t_ecp_grid->Daerah->headerCellClass() ?>"><div id="elh_t_ecp_Daerah" class="t_ecp_Daerah"><div class="ew-table-header-caption"><?php echo $t_ecp_grid->Daerah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Daerah" class="<?php echo $t_ecp_grid->Daerah->headerCellClass() ?>"><div><div id="elh_t_ecp_Daerah" class="t_ecp_Daerah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_ecp_grid->Daerah->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_ecp_grid->Daerah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_ecp_grid->Daerah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_ecp_grid->Produk->Visible) { // Produk ?>
	<?php if ($t_ecp_grid->SortUrl($t_ecp_grid->Produk) == "") { ?>
		<th data-name="Produk" class="<?php echo $t_ecp_grid->Produk->headerCellClass() ?>"><div id="elh_t_ecp_Produk" class="t_ecp_Produk"><div class="ew-table-header-caption"><?php echo $t_ecp_grid->Produk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Produk" class="<?php echo $t_ecp_grid->Produk->headerCellClass() ?>"><div><div id="elh_t_ecp_Produk" class="t_ecp_Produk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_ecp_grid->Produk->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_ecp_grid->Produk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_ecp_grid->Produk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_ecp_grid->Tgl_Bln_Ekspor->Visible) { // Tgl_Bln_Ekspor ?>
	<?php if ($t_ecp_grid->SortUrl($t_ecp_grid->Tgl_Bln_Ekspor) == "") { ?>
		<th data-name="Tgl_Bln_Ekspor" class="<?php echo $t_ecp_grid->Tgl_Bln_Ekspor->headerCellClass() ?>"><div id="elh_t_ecp_Tgl_Bln_Ekspor" class="t_ecp_Tgl_Bln_Ekspor"><div class="ew-table-header-caption"><?php echo $t_ecp_grid->Tgl_Bln_Ekspor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tgl_Bln_Ekspor" class="<?php echo $t_ecp_grid->Tgl_Bln_Ekspor->headerCellClass() ?>"><div><div id="elh_t_ecp_Tgl_Bln_Ekspor" class="t_ecp_Tgl_Bln_Ekspor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_ecp_grid->Tgl_Bln_Ekspor->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_ecp_grid->Tgl_Bln_Ekspor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_ecp_grid->Tgl_Bln_Ekspor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_ecp_grid->Tahun_Ekspor->Visible) { // Tahun_Ekspor ?>
	<?php if ($t_ecp_grid->SortUrl($t_ecp_grid->Tahun_Ekspor) == "") { ?>
		<th data-name="Tahun_Ekspor" class="<?php echo $t_ecp_grid->Tahun_Ekspor->headerCellClass() ?>"><div id="elh_t_ecp_Tahun_Ekspor" class="t_ecp_Tahun_Ekspor"><div class="ew-table-header-caption"><?php echo $t_ecp_grid->Tahun_Ekspor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tahun_Ekspor" class="<?php echo $t_ecp_grid->Tahun_Ekspor->headerCellClass() ?>"><div><div id="elh_t_ecp_Tahun_Ekspor" class="t_ecp_Tahun_Ekspor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_ecp_grid->Tahun_Ekspor->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_ecp_grid->Tahun_Ekspor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_ecp_grid->Tahun_Ekspor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_ecp_grid->Negara_Tujuan->Visible) { // Negara_Tujuan ?>
	<?php if ($t_ecp_grid->SortUrl($t_ecp_grid->Negara_Tujuan) == "") { ?>
		<th data-name="Negara_Tujuan" class="<?php echo $t_ecp_grid->Negara_Tujuan->headerCellClass() ?>"><div id="elh_t_ecp_Negara_Tujuan" class="t_ecp_Negara_Tujuan"><div class="ew-table-header-caption"><?php echo $t_ecp_grid->Negara_Tujuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Negara_Tujuan" class="<?php echo $t_ecp_grid->Negara_Tujuan->headerCellClass() ?>"><div><div id="elh_t_ecp_Negara_Tujuan" class="t_ecp_Negara_Tujuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_ecp_grid->Negara_Tujuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_ecp_grid->Negara_Tujuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_ecp_grid->Negara_Tujuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_ecp_grid->Nilai_Ekspor_USD->Visible) { // Nilai_Ekspor_USD ?>
	<?php if ($t_ecp_grid->SortUrl($t_ecp_grid->Nilai_Ekspor_USD) == "") { ?>
		<th data-name="Nilai_Ekspor_USD" class="<?php echo $t_ecp_grid->Nilai_Ekspor_USD->headerCellClass() ?>"><div id="elh_t_ecp_Nilai_Ekspor_USD" class="t_ecp_Nilai_Ekspor_USD"><div class="ew-table-header-caption"><?php echo $t_ecp_grid->Nilai_Ekspor_USD->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nilai_Ekspor_USD" class="<?php echo $t_ecp_grid->Nilai_Ekspor_USD->headerCellClass() ?>"><div><div id="elh_t_ecp_Nilai_Ekspor_USD" class="t_ecp_Nilai_Ekspor_USD">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_ecp_grid->Nilai_Ekspor_USD->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_ecp_grid->Nilai_Ekspor_USD->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_ecp_grid->Nilai_Ekspor_USD->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_ecp_grid->Nilai_Ekspor_Rupiah->Visible) { // Nilai_Ekspor_Rupiah ?>
	<?php if ($t_ecp_grid->SortUrl($t_ecp_grid->Nilai_Ekspor_Rupiah) == "") { ?>
		<th data-name="Nilai_Ekspor_Rupiah" class="<?php echo $t_ecp_grid->Nilai_Ekspor_Rupiah->headerCellClass() ?>"><div id="elh_t_ecp_Nilai_Ekspor_Rupiah" class="t_ecp_Nilai_Ekspor_Rupiah"><div class="ew-table-header-caption"><?php echo $t_ecp_grid->Nilai_Ekspor_Rupiah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nilai_Ekspor_Rupiah" class="<?php echo $t_ecp_grid->Nilai_Ekspor_Rupiah->headerCellClass() ?>"><div><div id="elh_t_ecp_Nilai_Ekspor_Rupiah" class="t_ecp_Nilai_Ekspor_Rupiah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_ecp_grid->Nilai_Ekspor_Rupiah->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_ecp_grid->Nilai_Ekspor_Rupiah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_ecp_grid->Nilai_Ekspor_Rupiah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_ecp_grid->Keterangan->Visible) { // Keterangan ?>
	<?php if ($t_ecp_grid->SortUrl($t_ecp_grid->Keterangan) == "") { ?>
		<th data-name="Keterangan" class="<?php echo $t_ecp_grid->Keterangan->headerCellClass() ?>"><div id="elh_t_ecp_Keterangan" class="t_ecp_Keterangan"><div class="ew-table-header-caption"><?php echo $t_ecp_grid->Keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Keterangan" class="<?php echo $t_ecp_grid->Keterangan->headerCellClass() ?>"><div><div id="elh_t_ecp_Keterangan" class="t_ecp_Keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_ecp_grid->Keterangan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_ecp_grid->Keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_ecp_grid->Keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_ecp_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_ecp_grid->StartRecord = 1;
$t_ecp_grid->StopRecord = $t_ecp_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($t_ecp->isConfirm() || $t_ecp_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_ecp_grid->FormKeyCountName) && ($t_ecp_grid->isGridAdd() || $t_ecp_grid->isGridEdit() || $t_ecp->isConfirm())) {
		$t_ecp_grid->KeyCount = $CurrentForm->getValue($t_ecp_grid->FormKeyCountName);
		$t_ecp_grid->StopRecord = $t_ecp_grid->StartRecord + $t_ecp_grid->KeyCount - 1;
	}
}
$t_ecp_grid->RecordCount = $t_ecp_grid->StartRecord - 1;
if ($t_ecp_grid->Recordset && !$t_ecp_grid->Recordset->EOF) {
	$t_ecp_grid->Recordset->moveFirst();
	$selectLimit = $t_ecp_grid->UseSelectLimit;
	if (!$selectLimit && $t_ecp_grid->StartRecord > 1)
		$t_ecp_grid->Recordset->move($t_ecp_grid->StartRecord - 1);
} elseif (!$t_ecp->AllowAddDeleteRow && $t_ecp_grid->StopRecord == 0) {
	$t_ecp_grid->StopRecord = $t_ecp->GridAddRowCount;
}

// Initialize aggregate
$t_ecp->RowType = ROWTYPE_AGGREGATEINIT;
$t_ecp->resetAttributes();
$t_ecp_grid->renderRow();
if ($t_ecp_grid->isGridAdd())
	$t_ecp_grid->RowIndex = 0;
if ($t_ecp_grid->isGridEdit())
	$t_ecp_grid->RowIndex = 0;
while ($t_ecp_grid->RecordCount < $t_ecp_grid->StopRecord) {
	$t_ecp_grid->RecordCount++;
	if ($t_ecp_grid->RecordCount >= $t_ecp_grid->StartRecord) {
		$t_ecp_grid->RowCount++;
		if ($t_ecp_grid->isGridAdd() || $t_ecp_grid->isGridEdit() || $t_ecp->isConfirm()) {
			$t_ecp_grid->RowIndex++;
			$CurrentForm->Index = $t_ecp_grid->RowIndex;
			if ($CurrentForm->hasValue($t_ecp_grid->FormActionName) && ($t_ecp->isConfirm() || $t_ecp_grid->EventCancelled))
				$t_ecp_grid->RowAction = strval($CurrentForm->getValue($t_ecp_grid->FormActionName));
			elseif ($t_ecp_grid->isGridAdd())
				$t_ecp_grid->RowAction = "insert";
			else
				$t_ecp_grid->RowAction = "";
		}

		// Set up key count
		$t_ecp_grid->KeyCount = $t_ecp_grid->RowIndex;

		// Init row class and style
		$t_ecp->resetAttributes();
		$t_ecp->CssClass = "";
		if ($t_ecp_grid->isGridAdd()) {
			if ($t_ecp->CurrentMode == "copy") {
				$t_ecp_grid->loadRowValues($t_ecp_grid->Recordset); // Load row values
				$t_ecp_grid->setRecordKey($t_ecp_grid->RowOldKey, $t_ecp_grid->Recordset); // Set old record key
			} else {
				$t_ecp_grid->loadRowValues(); // Load default values
				$t_ecp_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_ecp_grid->loadRowValues($t_ecp_grid->Recordset); // Load row values
		}
		$t_ecp->RowType = ROWTYPE_VIEW; // Render view
		if ($t_ecp_grid->isGridAdd()) // Grid add
			$t_ecp->RowType = ROWTYPE_ADD; // Render add
		if ($t_ecp_grid->isGridAdd() && $t_ecp->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_ecp_grid->restoreCurrentRowFormValues($t_ecp_grid->RowIndex); // Restore form values
		if ($t_ecp_grid->isGridEdit()) { // Grid edit
			if ($t_ecp->EventCancelled)
				$t_ecp_grid->restoreCurrentRowFormValues($t_ecp_grid->RowIndex); // Restore form values
			if ($t_ecp_grid->RowAction == "insert")
				$t_ecp->RowType = ROWTYPE_ADD; // Render add
			else
				$t_ecp->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_ecp_grid->isGridEdit() && ($t_ecp->RowType == ROWTYPE_EDIT || $t_ecp->RowType == ROWTYPE_ADD) && $t_ecp->EventCancelled) // Update failed
			$t_ecp_grid->restoreCurrentRowFormValues($t_ecp_grid->RowIndex); // Restore form values
		if ($t_ecp->RowType == ROWTYPE_EDIT) // Edit row
			$t_ecp_grid->EditRowCount++;
		if ($t_ecp->isConfirm()) // Confirm row
			$t_ecp_grid->restoreCurrentRowFormValues($t_ecp_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_ecp->RowAttrs->merge(["data-rowindex" => $t_ecp_grid->RowCount, "id" => "r" . $t_ecp_grid->RowCount . "_t_ecp", "data-rowtype" => $t_ecp->RowType]);

		// Render row
		$t_ecp_grid->renderRow();

		// Render list options
		$t_ecp_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_ecp_grid->RowAction != "delete" && $t_ecp_grid->RowAction != "insertdelete" && !($t_ecp_grid->RowAction == "insert" && $t_ecp->isConfirm() && $t_ecp_grid->emptyRow())) {
?>
	<tr <?php echo $t_ecp->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_ecp_grid->ListOptions->render("body", "left", $t_ecp_grid->RowCount);
?>
	<?php if ($t_ecp_grid->Daerah->Visible) { // Daerah ?>
		<td data-name="Daerah" <?php echo $t_ecp_grid->Daerah->cellAttributes() ?>>
<?php if ($t_ecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Daerah" class="form-group">
<input type="text" data-table="t_ecp" data-field="x_Daerah" name="x<?php echo $t_ecp_grid->RowIndex ?>_Daerah" id="x<?php echo $t_ecp_grid->RowIndex ?>_Daerah" size="10" maxlength="100" placeholder="<?php echo HtmlEncode($t_ecp_grid->Daerah->getPlaceHolder()) ?>" value="<?php echo $t_ecp_grid->Daerah->EditValue ?>"<?php echo $t_ecp_grid->Daerah->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_ecp" data-field="x_Daerah" name="o<?php echo $t_ecp_grid->RowIndex ?>_Daerah" id="o<?php echo $t_ecp_grid->RowIndex ?>_Daerah" value="<?php echo HtmlEncode($t_ecp_grid->Daerah->OldValue) ?>">
<?php } ?>
<?php if ($t_ecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Daerah" class="form-group">
<input type="text" data-table="t_ecp" data-field="x_Daerah" name="x<?php echo $t_ecp_grid->RowIndex ?>_Daerah" id="x<?php echo $t_ecp_grid->RowIndex ?>_Daerah" size="10" maxlength="100" placeholder="<?php echo HtmlEncode($t_ecp_grid->Daerah->getPlaceHolder()) ?>" value="<?php echo $t_ecp_grid->Daerah->EditValue ?>"<?php echo $t_ecp_grid->Daerah->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_ecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Daerah">
<span<?php echo $t_ecp_grid->Daerah->viewAttributes() ?>><?php echo $t_ecp_grid->Daerah->getViewValue() ?></span>
</span>
<?php if (!$t_ecp->isConfirm()) { ?>
<input type="hidden" data-table="t_ecp" data-field="x_Daerah" name="x<?php echo $t_ecp_grid->RowIndex ?>_Daerah" id="x<?php echo $t_ecp_grid->RowIndex ?>_Daerah" value="<?php echo HtmlEncode($t_ecp_grid->Daerah->FormValue) ?>">
<input type="hidden" data-table="t_ecp" data-field="x_Daerah" name="o<?php echo $t_ecp_grid->RowIndex ?>_Daerah" id="o<?php echo $t_ecp_grid->RowIndex ?>_Daerah" value="<?php echo HtmlEncode($t_ecp_grid->Daerah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_ecp" data-field="x_Daerah" name="ft_ecpgrid$x<?php echo $t_ecp_grid->RowIndex ?>_Daerah" id="ft_ecpgrid$x<?php echo $t_ecp_grid->RowIndex ?>_Daerah" value="<?php echo HtmlEncode($t_ecp_grid->Daerah->FormValue) ?>">
<input type="hidden" data-table="t_ecp" data-field="x_Daerah" name="ft_ecpgrid$o<?php echo $t_ecp_grid->RowIndex ?>_Daerah" id="ft_ecpgrid$o<?php echo $t_ecp_grid->RowIndex ?>_Daerah" value="<?php echo HtmlEncode($t_ecp_grid->Daerah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($t_ecp->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t_ecp" data-field="x_ID_ECP" name="x<?php echo $t_ecp_grid->RowIndex ?>_ID_ECP" id="x<?php echo $t_ecp_grid->RowIndex ?>_ID_ECP" value="<?php echo HtmlEncode($t_ecp_grid->ID_ECP->CurrentValue) ?>">
<input type="hidden" data-table="t_ecp" data-field="x_ID_ECP" name="o<?php echo $t_ecp_grid->RowIndex ?>_ID_ECP" id="o<?php echo $t_ecp_grid->RowIndex ?>_ID_ECP" value="<?php echo HtmlEncode($t_ecp_grid->ID_ECP->OldValue) ?>">
<?php } ?>
<?php if ($t_ecp->RowType == ROWTYPE_EDIT || $t_ecp->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t_ecp" data-field="x_ID_ECP" name="x<?php echo $t_ecp_grid->RowIndex ?>_ID_ECP" id="x<?php echo $t_ecp_grid->RowIndex ?>_ID_ECP" value="<?php echo HtmlEncode($t_ecp_grid->ID_ECP->CurrentValue) ?>">
<?php } ?>
	<?php if ($t_ecp_grid->Produk->Visible) { // Produk ?>
		<td data-name="Produk" <?php echo $t_ecp_grid->Produk->cellAttributes() ?>>
<?php if ($t_ecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Produk" class="form-group">
<input type="text" data-table="t_ecp" data-field="x_Produk" name="x<?php echo $t_ecp_grid->RowIndex ?>_Produk" id="x<?php echo $t_ecp_grid->RowIndex ?>_Produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_ecp_grid->Produk->getPlaceHolder()) ?>" value="<?php echo $t_ecp_grid->Produk->EditValue ?>"<?php echo $t_ecp_grid->Produk->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_ecp" data-field="x_Produk" name="o<?php echo $t_ecp_grid->RowIndex ?>_Produk" id="o<?php echo $t_ecp_grid->RowIndex ?>_Produk" value="<?php echo HtmlEncode($t_ecp_grid->Produk->OldValue) ?>">
<?php } ?>
<?php if ($t_ecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Produk" class="form-group">
<input type="text" data-table="t_ecp" data-field="x_Produk" name="x<?php echo $t_ecp_grid->RowIndex ?>_Produk" id="x<?php echo $t_ecp_grid->RowIndex ?>_Produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_ecp_grid->Produk->getPlaceHolder()) ?>" value="<?php echo $t_ecp_grid->Produk->EditValue ?>"<?php echo $t_ecp_grid->Produk->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_ecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Produk">
<span<?php echo $t_ecp_grid->Produk->viewAttributes() ?>><?php echo $t_ecp_grid->Produk->getViewValue() ?></span>
</span>
<?php if (!$t_ecp->isConfirm()) { ?>
<input type="hidden" data-table="t_ecp" data-field="x_Produk" name="x<?php echo $t_ecp_grid->RowIndex ?>_Produk" id="x<?php echo $t_ecp_grid->RowIndex ?>_Produk" value="<?php echo HtmlEncode($t_ecp_grid->Produk->FormValue) ?>">
<input type="hidden" data-table="t_ecp" data-field="x_Produk" name="o<?php echo $t_ecp_grid->RowIndex ?>_Produk" id="o<?php echo $t_ecp_grid->RowIndex ?>_Produk" value="<?php echo HtmlEncode($t_ecp_grid->Produk->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_ecp" data-field="x_Produk" name="ft_ecpgrid$x<?php echo $t_ecp_grid->RowIndex ?>_Produk" id="ft_ecpgrid$x<?php echo $t_ecp_grid->RowIndex ?>_Produk" value="<?php echo HtmlEncode($t_ecp_grid->Produk->FormValue) ?>">
<input type="hidden" data-table="t_ecp" data-field="x_Produk" name="ft_ecpgrid$o<?php echo $t_ecp_grid->RowIndex ?>_Produk" id="ft_ecpgrid$o<?php echo $t_ecp_grid->RowIndex ?>_Produk" value="<?php echo HtmlEncode($t_ecp_grid->Produk->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_ecp_grid->Tgl_Bln_Ekspor->Visible) { // Tgl_Bln_Ekspor ?>
		<td data-name="Tgl_Bln_Ekspor" <?php echo $t_ecp_grid->Tgl_Bln_Ekspor->cellAttributes() ?>>
<?php if ($t_ecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Tgl_Bln_Ekspor" class="form-group">
<input type="text" data-table="t_ecp" data-field="x_Tgl_Bln_Ekspor" name="x<?php echo $t_ecp_grid->RowIndex ?>_Tgl_Bln_Ekspor" id="x<?php echo $t_ecp_grid->RowIndex ?>_Tgl_Bln_Ekspor" size="10" maxlength="50" placeholder="<?php echo HtmlEncode($t_ecp_grid->Tgl_Bln_Ekspor->getPlaceHolder()) ?>" value="<?php echo $t_ecp_grid->Tgl_Bln_Ekspor->EditValue ?>"<?php echo $t_ecp_grid->Tgl_Bln_Ekspor->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_ecp" data-field="x_Tgl_Bln_Ekspor" name="o<?php echo $t_ecp_grid->RowIndex ?>_Tgl_Bln_Ekspor" id="o<?php echo $t_ecp_grid->RowIndex ?>_Tgl_Bln_Ekspor" value="<?php echo HtmlEncode($t_ecp_grid->Tgl_Bln_Ekspor->OldValue) ?>">
<?php } ?>
<?php if ($t_ecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Tgl_Bln_Ekspor" class="form-group">
<input type="text" data-table="t_ecp" data-field="x_Tgl_Bln_Ekspor" name="x<?php echo $t_ecp_grid->RowIndex ?>_Tgl_Bln_Ekspor" id="x<?php echo $t_ecp_grid->RowIndex ?>_Tgl_Bln_Ekspor" size="10" maxlength="50" placeholder="<?php echo HtmlEncode($t_ecp_grid->Tgl_Bln_Ekspor->getPlaceHolder()) ?>" value="<?php echo $t_ecp_grid->Tgl_Bln_Ekspor->EditValue ?>"<?php echo $t_ecp_grid->Tgl_Bln_Ekspor->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_ecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Tgl_Bln_Ekspor">
<span<?php echo $t_ecp_grid->Tgl_Bln_Ekspor->viewAttributes() ?>><?php echo $t_ecp_grid->Tgl_Bln_Ekspor->getViewValue() ?></span>
</span>
<?php if (!$t_ecp->isConfirm()) { ?>
<input type="hidden" data-table="t_ecp" data-field="x_Tgl_Bln_Ekspor" name="x<?php echo $t_ecp_grid->RowIndex ?>_Tgl_Bln_Ekspor" id="x<?php echo $t_ecp_grid->RowIndex ?>_Tgl_Bln_Ekspor" value="<?php echo HtmlEncode($t_ecp_grid->Tgl_Bln_Ekspor->FormValue) ?>">
<input type="hidden" data-table="t_ecp" data-field="x_Tgl_Bln_Ekspor" name="o<?php echo $t_ecp_grid->RowIndex ?>_Tgl_Bln_Ekspor" id="o<?php echo $t_ecp_grid->RowIndex ?>_Tgl_Bln_Ekspor" value="<?php echo HtmlEncode($t_ecp_grid->Tgl_Bln_Ekspor->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_ecp" data-field="x_Tgl_Bln_Ekspor" name="ft_ecpgrid$x<?php echo $t_ecp_grid->RowIndex ?>_Tgl_Bln_Ekspor" id="ft_ecpgrid$x<?php echo $t_ecp_grid->RowIndex ?>_Tgl_Bln_Ekspor" value="<?php echo HtmlEncode($t_ecp_grid->Tgl_Bln_Ekspor->FormValue) ?>">
<input type="hidden" data-table="t_ecp" data-field="x_Tgl_Bln_Ekspor" name="ft_ecpgrid$o<?php echo $t_ecp_grid->RowIndex ?>_Tgl_Bln_Ekspor" id="ft_ecpgrid$o<?php echo $t_ecp_grid->RowIndex ?>_Tgl_Bln_Ekspor" value="<?php echo HtmlEncode($t_ecp_grid->Tgl_Bln_Ekspor->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_ecp_grid->Tahun_Ekspor->Visible) { // Tahun_Ekspor ?>
		<td data-name="Tahun_Ekspor" <?php echo $t_ecp_grid->Tahun_Ekspor->cellAttributes() ?>>
<?php if ($t_ecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Tahun_Ekspor" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_ecp" data-field="x_Tahun_Ekspor" data-value-separator="<?php echo $t_ecp_grid->Tahun_Ekspor->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_ecp_grid->RowIndex ?>_Tahun_Ekspor" name="x<?php echo $t_ecp_grid->RowIndex ?>_Tahun_Ekspor"<?php echo $t_ecp_grid->Tahun_Ekspor->editAttributes() ?>>
			<?php echo $t_ecp_grid->Tahun_Ekspor->selectOptionListHtml("x{$t_ecp_grid->RowIndex}_Tahun_Ekspor") ?>
		</select>
</div>
<?php echo $t_ecp_grid->Tahun_Ekspor->Lookup->getParamTag($t_ecp_grid, "p_x" . $t_ecp_grid->RowIndex . "_Tahun_Ekspor") ?>
</span>
<input type="hidden" data-table="t_ecp" data-field="x_Tahun_Ekspor" name="o<?php echo $t_ecp_grid->RowIndex ?>_Tahun_Ekspor" id="o<?php echo $t_ecp_grid->RowIndex ?>_Tahun_Ekspor" value="<?php echo HtmlEncode($t_ecp_grid->Tahun_Ekspor->OldValue) ?>">
<?php } ?>
<?php if ($t_ecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Tahun_Ekspor" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_ecp" data-field="x_Tahun_Ekspor" data-value-separator="<?php echo $t_ecp_grid->Tahun_Ekspor->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_ecp_grid->RowIndex ?>_Tahun_Ekspor" name="x<?php echo $t_ecp_grid->RowIndex ?>_Tahun_Ekspor"<?php echo $t_ecp_grid->Tahun_Ekspor->editAttributes() ?>>
			<?php echo $t_ecp_grid->Tahun_Ekspor->selectOptionListHtml("x{$t_ecp_grid->RowIndex}_Tahun_Ekspor") ?>
		</select>
</div>
<?php echo $t_ecp_grid->Tahun_Ekspor->Lookup->getParamTag($t_ecp_grid, "p_x" . $t_ecp_grid->RowIndex . "_Tahun_Ekspor") ?>
</span>
<?php } ?>
<?php if ($t_ecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Tahun_Ekspor">
<span<?php echo $t_ecp_grid->Tahun_Ekspor->viewAttributes() ?>><?php echo $t_ecp_grid->Tahun_Ekspor->getViewValue() ?></span>
</span>
<?php if (!$t_ecp->isConfirm()) { ?>
<input type="hidden" data-table="t_ecp" data-field="x_Tahun_Ekspor" name="x<?php echo $t_ecp_grid->RowIndex ?>_Tahun_Ekspor" id="x<?php echo $t_ecp_grid->RowIndex ?>_Tahun_Ekspor" value="<?php echo HtmlEncode($t_ecp_grid->Tahun_Ekspor->FormValue) ?>">
<input type="hidden" data-table="t_ecp" data-field="x_Tahun_Ekspor" name="o<?php echo $t_ecp_grid->RowIndex ?>_Tahun_Ekspor" id="o<?php echo $t_ecp_grid->RowIndex ?>_Tahun_Ekspor" value="<?php echo HtmlEncode($t_ecp_grid->Tahun_Ekspor->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_ecp" data-field="x_Tahun_Ekspor" name="ft_ecpgrid$x<?php echo $t_ecp_grid->RowIndex ?>_Tahun_Ekspor" id="ft_ecpgrid$x<?php echo $t_ecp_grid->RowIndex ?>_Tahun_Ekspor" value="<?php echo HtmlEncode($t_ecp_grid->Tahun_Ekspor->FormValue) ?>">
<input type="hidden" data-table="t_ecp" data-field="x_Tahun_Ekspor" name="ft_ecpgrid$o<?php echo $t_ecp_grid->RowIndex ?>_Tahun_Ekspor" id="ft_ecpgrid$o<?php echo $t_ecp_grid->RowIndex ?>_Tahun_Ekspor" value="<?php echo HtmlEncode($t_ecp_grid->Tahun_Ekspor->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_ecp_grid->Negara_Tujuan->Visible) { // Negara_Tujuan ?>
		<td data-name="Negara_Tujuan" <?php echo $t_ecp_grid->Negara_Tujuan->cellAttributes() ?>>
<?php if ($t_ecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Negara_Tujuan" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_ecp" data-field="x_Negara_Tujuan" data-value-separator="<?php echo $t_ecp_grid->Negara_Tujuan->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan" name="x<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan"<?php echo $t_ecp_grid->Negara_Tujuan->editAttributes() ?>>
			<?php echo $t_ecp_grid->Negara_Tujuan->selectOptionListHtml("x{$t_ecp_grid->RowIndex}_Negara_Tujuan") ?>
		</select>
	<?php if (AllowAdd(CurrentProjectID() . "t_negara") && !$t_ecp_grid->Negara_Tujuan->ReadOnly) { ?>
	<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $t_ecp_grid->Negara_Tujuan->caption() ?>" data-title="<?php echo $t_ecp_grid->Negara_Tujuan->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan',url:'t_negaraaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button></div>
	<?php } ?>
</div>
<?php echo $t_ecp_grid->Negara_Tujuan->Lookup->getParamTag($t_ecp_grid, "p_x" . $t_ecp_grid->RowIndex . "_Negara_Tujuan") ?>
</span>
<input type="hidden" data-table="t_ecp" data-field="x_Negara_Tujuan" name="o<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan" id="o<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan" value="<?php echo HtmlEncode($t_ecp_grid->Negara_Tujuan->OldValue) ?>">
<?php } ?>
<?php if ($t_ecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Negara_Tujuan" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_ecp" data-field="x_Negara_Tujuan" data-value-separator="<?php echo $t_ecp_grid->Negara_Tujuan->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan" name="x<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan"<?php echo $t_ecp_grid->Negara_Tujuan->editAttributes() ?>>
			<?php echo $t_ecp_grid->Negara_Tujuan->selectOptionListHtml("x{$t_ecp_grid->RowIndex}_Negara_Tujuan") ?>
		</select>
	<?php if (AllowAdd(CurrentProjectID() . "t_negara") && !$t_ecp_grid->Negara_Tujuan->ReadOnly) { ?>
	<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $t_ecp_grid->Negara_Tujuan->caption() ?>" data-title="<?php echo $t_ecp_grid->Negara_Tujuan->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan',url:'t_negaraaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button></div>
	<?php } ?>
</div>
<?php echo $t_ecp_grid->Negara_Tujuan->Lookup->getParamTag($t_ecp_grid, "p_x" . $t_ecp_grid->RowIndex . "_Negara_Tujuan") ?>
</span>
<?php } ?>
<?php if ($t_ecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Negara_Tujuan">
<span<?php echo $t_ecp_grid->Negara_Tujuan->viewAttributes() ?>><?php echo $t_ecp_grid->Negara_Tujuan->getViewValue() ?></span>
</span>
<?php if (!$t_ecp->isConfirm()) { ?>
<input type="hidden" data-table="t_ecp" data-field="x_Negara_Tujuan" name="x<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan" id="x<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan" value="<?php echo HtmlEncode($t_ecp_grid->Negara_Tujuan->FormValue) ?>">
<input type="hidden" data-table="t_ecp" data-field="x_Negara_Tujuan" name="o<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan" id="o<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan" value="<?php echo HtmlEncode($t_ecp_grid->Negara_Tujuan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_ecp" data-field="x_Negara_Tujuan" name="ft_ecpgrid$x<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan" id="ft_ecpgrid$x<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan" value="<?php echo HtmlEncode($t_ecp_grid->Negara_Tujuan->FormValue) ?>">
<input type="hidden" data-table="t_ecp" data-field="x_Negara_Tujuan" name="ft_ecpgrid$o<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan" id="ft_ecpgrid$o<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan" value="<?php echo HtmlEncode($t_ecp_grid->Negara_Tujuan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_ecp_grid->Nilai_Ekspor_USD->Visible) { // Nilai_Ekspor_USD ?>
		<td data-name="Nilai_Ekspor_USD" <?php echo $t_ecp_grid->Nilai_Ekspor_USD->cellAttributes() ?>>
<?php if ($t_ecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Nilai_Ekspor_USD" class="form-group">
<input type="text" data-table="t_ecp" data-field="x_Nilai_Ekspor_USD" name="x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_USD" id="x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_USD" size="10" maxlength="15" placeholder="<?php echo HtmlEncode($t_ecp_grid->Nilai_Ekspor_USD->getPlaceHolder()) ?>" value="<?php echo $t_ecp_grid->Nilai_Ekspor_USD->EditValue ?>"<?php echo $t_ecp_grid->Nilai_Ekspor_USD->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_ecp" data-field="x_Nilai_Ekspor_USD" name="o<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_USD" id="o<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_USD" value="<?php echo HtmlEncode($t_ecp_grid->Nilai_Ekspor_USD->OldValue) ?>">
<?php } ?>
<?php if ($t_ecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Nilai_Ekspor_USD" class="form-group">
<input type="text" data-table="t_ecp" data-field="x_Nilai_Ekspor_USD" name="x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_USD" id="x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_USD" size="10" maxlength="15" placeholder="<?php echo HtmlEncode($t_ecp_grid->Nilai_Ekspor_USD->getPlaceHolder()) ?>" value="<?php echo $t_ecp_grid->Nilai_Ekspor_USD->EditValue ?>"<?php echo $t_ecp_grid->Nilai_Ekspor_USD->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_ecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Nilai_Ekspor_USD">
<span<?php echo $t_ecp_grid->Nilai_Ekspor_USD->viewAttributes() ?>><?php echo $t_ecp_grid->Nilai_Ekspor_USD->getViewValue() ?></span>
</span>
<?php if (!$t_ecp->isConfirm()) { ?>
<input type="hidden" data-table="t_ecp" data-field="x_Nilai_Ekspor_USD" name="x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_USD" id="x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_USD" value="<?php echo HtmlEncode($t_ecp_grid->Nilai_Ekspor_USD->FormValue) ?>">
<input type="hidden" data-table="t_ecp" data-field="x_Nilai_Ekspor_USD" name="o<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_USD" id="o<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_USD" value="<?php echo HtmlEncode($t_ecp_grid->Nilai_Ekspor_USD->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_ecp" data-field="x_Nilai_Ekspor_USD" name="ft_ecpgrid$x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_USD" id="ft_ecpgrid$x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_USD" value="<?php echo HtmlEncode($t_ecp_grid->Nilai_Ekspor_USD->FormValue) ?>">
<input type="hidden" data-table="t_ecp" data-field="x_Nilai_Ekspor_USD" name="ft_ecpgrid$o<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_USD" id="ft_ecpgrid$o<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_USD" value="<?php echo HtmlEncode($t_ecp_grid->Nilai_Ekspor_USD->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_ecp_grid->Nilai_Ekspor_Rupiah->Visible) { // Nilai_Ekspor_Rupiah ?>
		<td data-name="Nilai_Ekspor_Rupiah" <?php echo $t_ecp_grid->Nilai_Ekspor_Rupiah->cellAttributes() ?>>
<?php if ($t_ecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Nilai_Ekspor_Rupiah" class="form-group">
<input type="text" data-table="t_ecp" data-field="x_Nilai_Ekspor_Rupiah" name="x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_Rupiah" id="x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_Rupiah" size="10" maxlength="15" placeholder="<?php echo HtmlEncode($t_ecp_grid->Nilai_Ekspor_Rupiah->getPlaceHolder()) ?>" value="<?php echo $t_ecp_grid->Nilai_Ekspor_Rupiah->EditValue ?>"<?php echo $t_ecp_grid->Nilai_Ekspor_Rupiah->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_ecp" data-field="x_Nilai_Ekspor_Rupiah" name="o<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_Rupiah" id="o<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_Rupiah" value="<?php echo HtmlEncode($t_ecp_grid->Nilai_Ekspor_Rupiah->OldValue) ?>">
<?php } ?>
<?php if ($t_ecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Nilai_Ekspor_Rupiah" class="form-group">
<input type="text" data-table="t_ecp" data-field="x_Nilai_Ekspor_Rupiah" name="x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_Rupiah" id="x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_Rupiah" size="10" maxlength="15" placeholder="<?php echo HtmlEncode($t_ecp_grid->Nilai_Ekspor_Rupiah->getPlaceHolder()) ?>" value="<?php echo $t_ecp_grid->Nilai_Ekspor_Rupiah->EditValue ?>"<?php echo $t_ecp_grid->Nilai_Ekspor_Rupiah->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_ecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Nilai_Ekspor_Rupiah">
<span<?php echo $t_ecp_grid->Nilai_Ekspor_Rupiah->viewAttributes() ?>><?php echo $t_ecp_grid->Nilai_Ekspor_Rupiah->getViewValue() ?></span>
</span>
<?php if (!$t_ecp->isConfirm()) { ?>
<input type="hidden" data-table="t_ecp" data-field="x_Nilai_Ekspor_Rupiah" name="x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_Rupiah" id="x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_Rupiah" value="<?php echo HtmlEncode($t_ecp_grid->Nilai_Ekspor_Rupiah->FormValue) ?>">
<input type="hidden" data-table="t_ecp" data-field="x_Nilai_Ekspor_Rupiah" name="o<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_Rupiah" id="o<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_Rupiah" value="<?php echo HtmlEncode($t_ecp_grid->Nilai_Ekspor_Rupiah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_ecp" data-field="x_Nilai_Ekspor_Rupiah" name="ft_ecpgrid$x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_Rupiah" id="ft_ecpgrid$x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_Rupiah" value="<?php echo HtmlEncode($t_ecp_grid->Nilai_Ekspor_Rupiah->FormValue) ?>">
<input type="hidden" data-table="t_ecp" data-field="x_Nilai_Ekspor_Rupiah" name="ft_ecpgrid$o<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_Rupiah" id="ft_ecpgrid$o<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_Rupiah" value="<?php echo HtmlEncode($t_ecp_grid->Nilai_Ekspor_Rupiah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_ecp_grid->Keterangan->Visible) { // Keterangan ?>
		<td data-name="Keterangan" <?php echo $t_ecp_grid->Keterangan->cellAttributes() ?>>
<?php if ($t_ecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Keterangan" class="form-group">
<input type="text" data-table="t_ecp" data-field="x_Keterangan" name="x<?php echo $t_ecp_grid->RowIndex ?>_Keterangan" id="x<?php echo $t_ecp_grid->RowIndex ?>_Keterangan" size="15" maxlength="255" placeholder="<?php echo HtmlEncode($t_ecp_grid->Keterangan->getPlaceHolder()) ?>" value="<?php echo $t_ecp_grid->Keterangan->EditValue ?>"<?php echo $t_ecp_grid->Keterangan->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_ecp" data-field="x_Keterangan" name="o<?php echo $t_ecp_grid->RowIndex ?>_Keterangan" id="o<?php echo $t_ecp_grid->RowIndex ?>_Keterangan" value="<?php echo HtmlEncode($t_ecp_grid->Keterangan->OldValue) ?>">
<?php } ?>
<?php if ($t_ecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Keterangan" class="form-group">
<input type="text" data-table="t_ecp" data-field="x_Keterangan" name="x<?php echo $t_ecp_grid->RowIndex ?>_Keterangan" id="x<?php echo $t_ecp_grid->RowIndex ?>_Keterangan" size="15" maxlength="255" placeholder="<?php echo HtmlEncode($t_ecp_grid->Keterangan->getPlaceHolder()) ?>" value="<?php echo $t_ecp_grid->Keterangan->EditValue ?>"<?php echo $t_ecp_grid->Keterangan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_ecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_ecp_grid->RowCount ?>_t_ecp_Keterangan">
<span<?php echo $t_ecp_grid->Keterangan->viewAttributes() ?>><?php echo $t_ecp_grid->Keterangan->getViewValue() ?></span>
</span>
<?php if (!$t_ecp->isConfirm()) { ?>
<input type="hidden" data-table="t_ecp" data-field="x_Keterangan" name="x<?php echo $t_ecp_grid->RowIndex ?>_Keterangan" id="x<?php echo $t_ecp_grid->RowIndex ?>_Keterangan" value="<?php echo HtmlEncode($t_ecp_grid->Keterangan->FormValue) ?>">
<input type="hidden" data-table="t_ecp" data-field="x_Keterangan" name="o<?php echo $t_ecp_grid->RowIndex ?>_Keterangan" id="o<?php echo $t_ecp_grid->RowIndex ?>_Keterangan" value="<?php echo HtmlEncode($t_ecp_grid->Keterangan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_ecp" data-field="x_Keterangan" name="ft_ecpgrid$x<?php echo $t_ecp_grid->RowIndex ?>_Keterangan" id="ft_ecpgrid$x<?php echo $t_ecp_grid->RowIndex ?>_Keterangan" value="<?php echo HtmlEncode($t_ecp_grid->Keterangan->FormValue) ?>">
<input type="hidden" data-table="t_ecp" data-field="x_Keterangan" name="ft_ecpgrid$o<?php echo $t_ecp_grid->RowIndex ?>_Keterangan" id="ft_ecpgrid$o<?php echo $t_ecp_grid->RowIndex ?>_Keterangan" value="<?php echo HtmlEncode($t_ecp_grid->Keterangan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_ecp_grid->ListOptions->render("body", "right", $t_ecp_grid->RowCount);
?>
	</tr>
<?php if ($t_ecp->RowType == ROWTYPE_ADD || $t_ecp->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_ecpgrid", "load"], function() {
	ft_ecpgrid.updateLists(<?php echo $t_ecp_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_ecp_grid->isGridAdd() || $t_ecp->CurrentMode == "copy")
		if (!$t_ecp_grid->Recordset->EOF)
			$t_ecp_grid->Recordset->moveNext();
}
?>
<?php
	if ($t_ecp->CurrentMode == "add" || $t_ecp->CurrentMode == "copy" || $t_ecp->CurrentMode == "edit") {
		$t_ecp_grid->RowIndex = '$rowindex$';
		$t_ecp_grid->loadRowValues();

		// Set row properties
		$t_ecp->resetAttributes();
		$t_ecp->RowAttrs->merge(["data-rowindex" => $t_ecp_grid->RowIndex, "id" => "r0_t_ecp", "data-rowtype" => ROWTYPE_ADD]);
		$t_ecp->RowAttrs->appendClass("ew-template");
		$t_ecp->RowType = ROWTYPE_ADD;

		// Render row
		$t_ecp_grid->renderRow();

		// Render list options
		$t_ecp_grid->renderListOptions();
		$t_ecp_grid->StartRowCount = 0;
?>
	<tr <?php echo $t_ecp->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_ecp_grid->ListOptions->render("body", "left", $t_ecp_grid->RowIndex);
?>
	<?php if ($t_ecp_grid->Daerah->Visible) { // Daerah ?>
		<td data-name="Daerah">
<?php if (!$t_ecp->isConfirm()) { ?>
<span id="el$rowindex$_t_ecp_Daerah" class="form-group t_ecp_Daerah">
<input type="text" data-table="t_ecp" data-field="x_Daerah" name="x<?php echo $t_ecp_grid->RowIndex ?>_Daerah" id="x<?php echo $t_ecp_grid->RowIndex ?>_Daerah" size="10" maxlength="100" placeholder="<?php echo HtmlEncode($t_ecp_grid->Daerah->getPlaceHolder()) ?>" value="<?php echo $t_ecp_grid->Daerah->EditValue ?>"<?php echo $t_ecp_grid->Daerah->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_ecp_Daerah" class="form-group t_ecp_Daerah">
<span<?php echo $t_ecp_grid->Daerah->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_ecp_grid->Daerah->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_ecp" data-field="x_Daerah" name="x<?php echo $t_ecp_grid->RowIndex ?>_Daerah" id="x<?php echo $t_ecp_grid->RowIndex ?>_Daerah" value="<?php echo HtmlEncode($t_ecp_grid->Daerah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_ecp" data-field="x_Daerah" name="o<?php echo $t_ecp_grid->RowIndex ?>_Daerah" id="o<?php echo $t_ecp_grid->RowIndex ?>_Daerah" value="<?php echo HtmlEncode($t_ecp_grid->Daerah->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_ecp_grid->Produk->Visible) { // Produk ?>
		<td data-name="Produk">
<?php if (!$t_ecp->isConfirm()) { ?>
<span id="el$rowindex$_t_ecp_Produk" class="form-group t_ecp_Produk">
<input type="text" data-table="t_ecp" data-field="x_Produk" name="x<?php echo $t_ecp_grid->RowIndex ?>_Produk" id="x<?php echo $t_ecp_grid->RowIndex ?>_Produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_ecp_grid->Produk->getPlaceHolder()) ?>" value="<?php echo $t_ecp_grid->Produk->EditValue ?>"<?php echo $t_ecp_grid->Produk->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_ecp_Produk" class="form-group t_ecp_Produk">
<span<?php echo $t_ecp_grid->Produk->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_ecp_grid->Produk->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_ecp" data-field="x_Produk" name="x<?php echo $t_ecp_grid->RowIndex ?>_Produk" id="x<?php echo $t_ecp_grid->RowIndex ?>_Produk" value="<?php echo HtmlEncode($t_ecp_grid->Produk->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_ecp" data-field="x_Produk" name="o<?php echo $t_ecp_grid->RowIndex ?>_Produk" id="o<?php echo $t_ecp_grid->RowIndex ?>_Produk" value="<?php echo HtmlEncode($t_ecp_grid->Produk->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_ecp_grid->Tgl_Bln_Ekspor->Visible) { // Tgl_Bln_Ekspor ?>
		<td data-name="Tgl_Bln_Ekspor">
<?php if (!$t_ecp->isConfirm()) { ?>
<span id="el$rowindex$_t_ecp_Tgl_Bln_Ekspor" class="form-group t_ecp_Tgl_Bln_Ekspor">
<input type="text" data-table="t_ecp" data-field="x_Tgl_Bln_Ekspor" name="x<?php echo $t_ecp_grid->RowIndex ?>_Tgl_Bln_Ekspor" id="x<?php echo $t_ecp_grid->RowIndex ?>_Tgl_Bln_Ekspor" size="10" maxlength="50" placeholder="<?php echo HtmlEncode($t_ecp_grid->Tgl_Bln_Ekspor->getPlaceHolder()) ?>" value="<?php echo $t_ecp_grid->Tgl_Bln_Ekspor->EditValue ?>"<?php echo $t_ecp_grid->Tgl_Bln_Ekspor->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_ecp_Tgl_Bln_Ekspor" class="form-group t_ecp_Tgl_Bln_Ekspor">
<span<?php echo $t_ecp_grid->Tgl_Bln_Ekspor->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_ecp_grid->Tgl_Bln_Ekspor->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_ecp" data-field="x_Tgl_Bln_Ekspor" name="x<?php echo $t_ecp_grid->RowIndex ?>_Tgl_Bln_Ekspor" id="x<?php echo $t_ecp_grid->RowIndex ?>_Tgl_Bln_Ekspor" value="<?php echo HtmlEncode($t_ecp_grid->Tgl_Bln_Ekspor->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_ecp" data-field="x_Tgl_Bln_Ekspor" name="o<?php echo $t_ecp_grid->RowIndex ?>_Tgl_Bln_Ekspor" id="o<?php echo $t_ecp_grid->RowIndex ?>_Tgl_Bln_Ekspor" value="<?php echo HtmlEncode($t_ecp_grid->Tgl_Bln_Ekspor->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_ecp_grid->Tahun_Ekspor->Visible) { // Tahun_Ekspor ?>
		<td data-name="Tahun_Ekspor">
<?php if (!$t_ecp->isConfirm()) { ?>
<span id="el$rowindex$_t_ecp_Tahun_Ekspor" class="form-group t_ecp_Tahun_Ekspor">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_ecp" data-field="x_Tahun_Ekspor" data-value-separator="<?php echo $t_ecp_grid->Tahun_Ekspor->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_ecp_grid->RowIndex ?>_Tahun_Ekspor" name="x<?php echo $t_ecp_grid->RowIndex ?>_Tahun_Ekspor"<?php echo $t_ecp_grid->Tahun_Ekspor->editAttributes() ?>>
			<?php echo $t_ecp_grid->Tahun_Ekspor->selectOptionListHtml("x{$t_ecp_grid->RowIndex}_Tahun_Ekspor") ?>
		</select>
</div>
<?php echo $t_ecp_grid->Tahun_Ekspor->Lookup->getParamTag($t_ecp_grid, "p_x" . $t_ecp_grid->RowIndex . "_Tahun_Ekspor") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_ecp_Tahun_Ekspor" class="form-group t_ecp_Tahun_Ekspor">
<span<?php echo $t_ecp_grid->Tahun_Ekspor->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_ecp_grid->Tahun_Ekspor->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_ecp" data-field="x_Tahun_Ekspor" name="x<?php echo $t_ecp_grid->RowIndex ?>_Tahun_Ekspor" id="x<?php echo $t_ecp_grid->RowIndex ?>_Tahun_Ekspor" value="<?php echo HtmlEncode($t_ecp_grid->Tahun_Ekspor->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_ecp" data-field="x_Tahun_Ekspor" name="o<?php echo $t_ecp_grid->RowIndex ?>_Tahun_Ekspor" id="o<?php echo $t_ecp_grid->RowIndex ?>_Tahun_Ekspor" value="<?php echo HtmlEncode($t_ecp_grid->Tahun_Ekspor->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_ecp_grid->Negara_Tujuan->Visible) { // Negara_Tujuan ?>
		<td data-name="Negara_Tujuan">
<?php if (!$t_ecp->isConfirm()) { ?>
<span id="el$rowindex$_t_ecp_Negara_Tujuan" class="form-group t_ecp_Negara_Tujuan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_ecp" data-field="x_Negara_Tujuan" data-value-separator="<?php echo $t_ecp_grid->Negara_Tujuan->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan" name="x<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan"<?php echo $t_ecp_grid->Negara_Tujuan->editAttributes() ?>>
			<?php echo $t_ecp_grid->Negara_Tujuan->selectOptionListHtml("x{$t_ecp_grid->RowIndex}_Negara_Tujuan") ?>
		</select>
	<?php if (AllowAdd(CurrentProjectID() . "t_negara") && !$t_ecp_grid->Negara_Tujuan->ReadOnly) { ?>
	<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $t_ecp_grid->Negara_Tujuan->caption() ?>" data-title="<?php echo $t_ecp_grid->Negara_Tujuan->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan',url:'t_negaraaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button></div>
	<?php } ?>
</div>
<?php echo $t_ecp_grid->Negara_Tujuan->Lookup->getParamTag($t_ecp_grid, "p_x" . $t_ecp_grid->RowIndex . "_Negara_Tujuan") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_ecp_Negara_Tujuan" class="form-group t_ecp_Negara_Tujuan">
<span<?php echo $t_ecp_grid->Negara_Tujuan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_ecp_grid->Negara_Tujuan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_ecp" data-field="x_Negara_Tujuan" name="x<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan" id="x<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan" value="<?php echo HtmlEncode($t_ecp_grid->Negara_Tujuan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_ecp" data-field="x_Negara_Tujuan" name="o<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan" id="o<?php echo $t_ecp_grid->RowIndex ?>_Negara_Tujuan" value="<?php echo HtmlEncode($t_ecp_grid->Negara_Tujuan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_ecp_grid->Nilai_Ekspor_USD->Visible) { // Nilai_Ekspor_USD ?>
		<td data-name="Nilai_Ekspor_USD">
<?php if (!$t_ecp->isConfirm()) { ?>
<span id="el$rowindex$_t_ecp_Nilai_Ekspor_USD" class="form-group t_ecp_Nilai_Ekspor_USD">
<input type="text" data-table="t_ecp" data-field="x_Nilai_Ekspor_USD" name="x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_USD" id="x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_USD" size="10" maxlength="15" placeholder="<?php echo HtmlEncode($t_ecp_grid->Nilai_Ekspor_USD->getPlaceHolder()) ?>" value="<?php echo $t_ecp_grid->Nilai_Ekspor_USD->EditValue ?>"<?php echo $t_ecp_grid->Nilai_Ekspor_USD->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_ecp_Nilai_Ekspor_USD" class="form-group t_ecp_Nilai_Ekspor_USD">
<span<?php echo $t_ecp_grid->Nilai_Ekspor_USD->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_ecp_grid->Nilai_Ekspor_USD->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_ecp" data-field="x_Nilai_Ekspor_USD" name="x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_USD" id="x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_USD" value="<?php echo HtmlEncode($t_ecp_grid->Nilai_Ekspor_USD->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_ecp" data-field="x_Nilai_Ekspor_USD" name="o<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_USD" id="o<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_USD" value="<?php echo HtmlEncode($t_ecp_grid->Nilai_Ekspor_USD->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_ecp_grid->Nilai_Ekspor_Rupiah->Visible) { // Nilai_Ekspor_Rupiah ?>
		<td data-name="Nilai_Ekspor_Rupiah">
<?php if (!$t_ecp->isConfirm()) { ?>
<span id="el$rowindex$_t_ecp_Nilai_Ekspor_Rupiah" class="form-group t_ecp_Nilai_Ekspor_Rupiah">
<input type="text" data-table="t_ecp" data-field="x_Nilai_Ekspor_Rupiah" name="x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_Rupiah" id="x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_Rupiah" size="10" maxlength="15" placeholder="<?php echo HtmlEncode($t_ecp_grid->Nilai_Ekspor_Rupiah->getPlaceHolder()) ?>" value="<?php echo $t_ecp_grid->Nilai_Ekspor_Rupiah->EditValue ?>"<?php echo $t_ecp_grid->Nilai_Ekspor_Rupiah->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_ecp_Nilai_Ekspor_Rupiah" class="form-group t_ecp_Nilai_Ekspor_Rupiah">
<span<?php echo $t_ecp_grid->Nilai_Ekspor_Rupiah->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_ecp_grid->Nilai_Ekspor_Rupiah->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_ecp" data-field="x_Nilai_Ekspor_Rupiah" name="x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_Rupiah" id="x<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_Rupiah" value="<?php echo HtmlEncode($t_ecp_grid->Nilai_Ekspor_Rupiah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_ecp" data-field="x_Nilai_Ekspor_Rupiah" name="o<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_Rupiah" id="o<?php echo $t_ecp_grid->RowIndex ?>_Nilai_Ekspor_Rupiah" value="<?php echo HtmlEncode($t_ecp_grid->Nilai_Ekspor_Rupiah->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_ecp_grid->Keterangan->Visible) { // Keterangan ?>
		<td data-name="Keterangan">
<?php if (!$t_ecp->isConfirm()) { ?>
<span id="el$rowindex$_t_ecp_Keterangan" class="form-group t_ecp_Keterangan">
<input type="text" data-table="t_ecp" data-field="x_Keterangan" name="x<?php echo $t_ecp_grid->RowIndex ?>_Keterangan" id="x<?php echo $t_ecp_grid->RowIndex ?>_Keterangan" size="15" maxlength="255" placeholder="<?php echo HtmlEncode($t_ecp_grid->Keterangan->getPlaceHolder()) ?>" value="<?php echo $t_ecp_grid->Keterangan->EditValue ?>"<?php echo $t_ecp_grid->Keterangan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_ecp_Keterangan" class="form-group t_ecp_Keterangan">
<span<?php echo $t_ecp_grid->Keterangan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_ecp_grid->Keterangan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_ecp" data-field="x_Keterangan" name="x<?php echo $t_ecp_grid->RowIndex ?>_Keterangan" id="x<?php echo $t_ecp_grid->RowIndex ?>_Keterangan" value="<?php echo HtmlEncode($t_ecp_grid->Keterangan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_ecp" data-field="x_Keterangan" name="o<?php echo $t_ecp_grid->RowIndex ?>_Keterangan" id="o<?php echo $t_ecp_grid->RowIndex ?>_Keterangan" value="<?php echo HtmlEncode($t_ecp_grid->Keterangan->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_ecp_grid->ListOptions->render("body", "right", $t_ecp_grid->RowIndex);
?>
<script>
loadjs.ready(["ft_ecpgrid", "load"], function() {
	ft_ecpgrid.updateLists(<?php echo $t_ecp_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($t_ecp->CurrentMode == "add" || $t_ecp->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $t_ecp_grid->FormKeyCountName ?>" id="<?php echo $t_ecp_grid->FormKeyCountName ?>" value="<?php echo $t_ecp_grid->KeyCount ?>">
<?php echo $t_ecp_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_ecp->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $t_ecp_grid->FormKeyCountName ?>" id="<?php echo $t_ecp_grid->FormKeyCountName ?>" value="<?php echo $t_ecp_grid->KeyCount ?>">
<?php echo $t_ecp_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_ecp->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_ecpgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_ecp_grid->Recordset)
	$t_ecp_grid->Recordset->Close();
?>
<?php if ($t_ecp_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $t_ecp_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_ecp_grid->TotalRecords == 0 && !$t_ecp->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_ecp_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$t_ecp_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$t_ecp_grid->terminate();
?>