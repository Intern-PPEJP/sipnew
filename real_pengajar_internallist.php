<?php
namespace PHPMaker2020\ppei_20;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$real_pengajar_internal_list = new real_pengajar_internal_list();

// Run the page
$real_pengajar_internal_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$real_pengajar_internal_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$real_pengajar_internal_list->isExport()) { ?>
<script>
var freal_pengajar_internallist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	freal_pengajar_internallist = currentForm = new ew.Form("freal_pengajar_internallist", "list");
	freal_pengajar_internallist.formKeyCountName = '<?php echo $real_pengajar_internal_list->FormKeyCountName ?>';
	loadjs.done("freal_pengajar_internallist");
});
var freal_pengajar_internallistsrch;
loadjs.ready("head", function() {

	// Form object for search
	freal_pengajar_internallistsrch = currentSearchForm = new ew.Form("freal_pengajar_internallistsrch");

	// Validate function for search
	freal_pengajar_internallistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	freal_pengajar_internallistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	freal_pengajar_internallistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	freal_pengajar_internallistsrch.lists["x_bln"] = <?php echo $real_pengajar_internal_list->bln->Lookup->toClientList($real_pengajar_internal_list) ?>;
	freal_pengajar_internallistsrch.lists["x_bln"].options = <?php echo JsonEncode($real_pengajar_internal_list->bln->options(FALSE, TRUE)) ?>;
	freal_pengajar_internallistsrch.lists["x_thn"] = <?php echo $real_pengajar_internal_list->thn->Lookup->toClientList($real_pengajar_internal_list) ?>;
	freal_pengajar_internallistsrch.lists["x_thn"].options = <?php echo JsonEncode($real_pengajar_internal_list->thn->options(FALSE, TRUE)) ?>;

	// Filters
	freal_pengajar_internallistsrch.filterList = <?php echo $real_pengajar_internal_list->getFilterList() ?>;
	loadjs.done("freal_pengajar_internallistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$real_pengajar_internal_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($real_pengajar_internal_list->TotalRecords > 0 && $real_pengajar_internal_list->ExportOptions->visible()) { ?>
<?php $real_pengajar_internal_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($real_pengajar_internal_list->ImportOptions->visible()) { ?>
<?php $real_pengajar_internal_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($real_pengajar_internal_list->SearchOptions->visible()) { ?>
<?php $real_pengajar_internal_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($real_pengajar_internal_list->FilterOptions->visible()) { ?>
<?php $real_pengajar_internal_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$real_pengajar_internal_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$real_pengajar_internal_list->isExport() && !$real_pengajar_internal->CurrentAction) { ?>
<form name="freal_pengajar_internallistsrch" id="freal_pengajar_internallistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="freal_pengajar_internallistsrch-search-panel" class="<?php echo $real_pengajar_internal_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="real_pengajar_internal">
	<div class="ew-extended-search">
<?php

// Render search row
$real_pengajar_internal->RowType = ROWTYPE_SEARCH;
$real_pengajar_internal->resetAttributes();
$real_pengajar_internal_list->renderRow();
?>
<?php if ($real_pengajar_internal_list->bln->Visible) { // bln ?>
	<?php
		$real_pengajar_internal_list->SearchColumnCount++;
		if (($real_pengajar_internal_list->SearchColumnCount - 1) % $real_pengajar_internal_list->SearchFieldsPerRow == 0) {
			$real_pengajar_internal_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $real_pengajar_internal_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_bln" class="ew-cell form-group">
		<label for="x_bln" class="ew-search-caption ew-label"><?php echo $real_pengajar_internal_list->bln->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_bln" id="z_bln" value="=">
</span>
		<span id="el_real_pengajar_internal_bln" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="real_pengajar_internal" data-field="x_bln" data-value-separator="<?php echo $real_pengajar_internal_list->bln->displayValueSeparatorAttribute() ?>" id="x_bln" name="x_bln"<?php echo $real_pengajar_internal_list->bln->editAttributes() ?>>
			<?php echo $real_pengajar_internal_list->bln->selectOptionListHtml("x_bln") ?>
		</select>
</div>
</span>
	</div>
	<?php if ($real_pengajar_internal_list->SearchColumnCount % $real_pengajar_internal_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($real_pengajar_internal_list->thn->Visible) { // thn ?>
	<?php
		$real_pengajar_internal_list->SearchColumnCount++;
		if (($real_pengajar_internal_list->SearchColumnCount - 1) % $real_pengajar_internal_list->SearchFieldsPerRow == 0) {
			$real_pengajar_internal_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $real_pengajar_internal_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_thn" class="ew-cell form-group">
		<label for="x_thn" class="ew-search-caption ew-label"><?php echo $real_pengajar_internal_list->thn->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_thn" id="z_thn" value="=">
</span>
		<span id="el_real_pengajar_internal_thn" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="real_pengajar_internal" data-field="x_thn" data-value-separator="<?php echo $real_pengajar_internal_list->thn->displayValueSeparatorAttribute() ?>" id="x_thn" name="x_thn"<?php echo $real_pengajar_internal_list->thn->editAttributes() ?>>
			<?php echo $real_pengajar_internal_list->thn->selectOptionListHtml("x_thn") ?>
		</select>
</div>
</span>
	</div>
	<?php if ($real_pengajar_internal_list->SearchColumnCount % $real_pengajar_internal_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($real_pengajar_internal_list->SearchColumnCount % $real_pengajar_internal_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $real_pengajar_internal_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $real_pengajar_internal_list->showPageHeader(); ?>
<?php
$real_pengajar_internal_list->showMessage();
?>
<?php if ($real_pengajar_internal_list->TotalRecords > 0 || $real_pengajar_internal->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($real_pengajar_internal_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> real_pengajar_internal">
<?php if (!$real_pengajar_internal_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$real_pengajar_internal_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $real_pengajar_internal_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $real_pengajar_internal_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="freal_pengajar_internallist" id="freal_pengajar_internallist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="real_pengajar_internal">
<div id="gmp_real_pengajar_internal" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($real_pengajar_internal_list->TotalRecords > 0 || $real_pengajar_internal_list->isGridEdit()) { ?>
<table id="tbl_real_pengajar_internallist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$real_pengajar_internal->RowType = ROWTYPE_HEADER;

// Render list options
$real_pengajar_internal_list->renderListOptions();

// Render list options (header, left)
$real_pengajar_internal_list->ListOptions->render("header", "left");
?>
<?php if ($real_pengajar_internal_list->nama->Visible) { // nama ?>
	<?php if ($real_pengajar_internal_list->SortUrl($real_pengajar_internal_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $real_pengajar_internal_list->nama->headerCellClass() ?>"><div id="elh_real_pengajar_internal_nama" class="real_pengajar_internal_nama"><div class="ew-table-header-caption"><?php echo $real_pengajar_internal_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $real_pengajar_internal_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_pengajar_internal_list->SortUrl($real_pengajar_internal_list->nama) ?>', 1);"><div id="elh_real_pengajar_internal_nama" class="real_pengajar_internal_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_pengajar_internal_list->nama->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_pengajar_internal_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_pengajar_internal_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_pengajar_internal_list->pusat->Visible) { // pusat ?>
	<?php if ($real_pengajar_internal_list->SortUrl($real_pengajar_internal_list->pusat) == "") { ?>
		<th data-name="pusat" class="<?php echo $real_pengajar_internal_list->pusat->headerCellClass() ?>"><div id="elh_real_pengajar_internal_pusat" class="real_pengajar_internal_pusat"><div class="ew-table-header-caption"><?php echo $real_pengajar_internal_list->pusat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pusat" class="<?php echo $real_pengajar_internal_list->pusat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_pengajar_internal_list->SortUrl($real_pengajar_internal_list->pusat) ?>', 1);"><div id="elh_real_pengajar_internal_pusat" class="real_pengajar_internal_pusat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_pengajar_internal_list->pusat->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_pengajar_internal_list->pusat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_pengajar_internal_list->pusat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_pengajar_internal_list->daerah->Visible) { // daerah ?>
	<?php if ($real_pengajar_internal_list->SortUrl($real_pengajar_internal_list->daerah) == "") { ?>
		<th data-name="daerah" class="<?php echo $real_pengajar_internal_list->daerah->headerCellClass() ?>"><div id="elh_real_pengajar_internal_daerah" class="real_pengajar_internal_daerah"><div class="ew-table-header-caption"><?php echo $real_pengajar_internal_list->daerah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="daerah" class="<?php echo $real_pengajar_internal_list->daerah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_pengajar_internal_list->SortUrl($real_pengajar_internal_list->daerah) ?>', 1);"><div id="elh_real_pengajar_internal_daerah" class="real_pengajar_internal_daerah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_pengajar_internal_list->daerah->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_pengajar_internal_list->daerah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_pengajar_internal_list->daerah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_pengajar_internal_list->ket->Visible) { // ket ?>
	<?php if ($real_pengajar_internal_list->SortUrl($real_pengajar_internal_list->ket) == "") { ?>
		<th data-name="ket" class="<?php echo $real_pengajar_internal_list->ket->headerCellClass() ?>"><div id="elh_real_pengajar_internal_ket" class="real_pengajar_internal_ket"><div class="ew-table-header-caption"><?php echo $real_pengajar_internal_list->ket->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ket" class="<?php echo $real_pengajar_internal_list->ket->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_pengajar_internal_list->SortUrl($real_pengajar_internal_list->ket) ?>', 1);"><div id="elh_real_pengajar_internal_ket" class="real_pengajar_internal_ket">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_pengajar_internal_list->ket->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_pengajar_internal_list->ket->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_pengajar_internal_list->ket->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_pengajar_internal_list->bln->Visible) { // bln ?>
	<?php if ($real_pengajar_internal_list->SortUrl($real_pengajar_internal_list->bln) == "") { ?>
		<th data-name="bln" class="<?php echo $real_pengajar_internal_list->bln->headerCellClass() ?>"><div id="elh_real_pengajar_internal_bln" class="real_pengajar_internal_bln"><div class="ew-table-header-caption"><?php echo $real_pengajar_internal_list->bln->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bln" class="<?php echo $real_pengajar_internal_list->bln->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_pengajar_internal_list->SortUrl($real_pengajar_internal_list->bln) ?>', 1);"><div id="elh_real_pengajar_internal_bln" class="real_pengajar_internal_bln">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_pengajar_internal_list->bln->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_pengajar_internal_list->bln->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_pengajar_internal_list->bln->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_pengajar_internal_list->thn->Visible) { // thn ?>
	<?php if ($real_pengajar_internal_list->SortUrl($real_pengajar_internal_list->thn) == "") { ?>
		<th data-name="thn" class="<?php echo $real_pengajar_internal_list->thn->headerCellClass() ?>"><div id="elh_real_pengajar_internal_thn" class="real_pengajar_internal_thn"><div class="ew-table-header-caption"><?php echo $real_pengajar_internal_list->thn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="thn" class="<?php echo $real_pengajar_internal_list->thn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_pengajar_internal_list->SortUrl($real_pengajar_internal_list->thn) ?>', 1);"><div id="elh_real_pengajar_internal_thn" class="real_pengajar_internal_thn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_pengajar_internal_list->thn->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_pengajar_internal_list->thn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_pengajar_internal_list->thn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$real_pengajar_internal_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($real_pengajar_internal_list->ExportAll && $real_pengajar_internal_list->isExport()) {
	$real_pengajar_internal_list->StopRecord = $real_pengajar_internal_list->TotalRecords;
} else {

	// Set the last record to display
	if ($real_pengajar_internal_list->TotalRecords > $real_pengajar_internal_list->StartRecord + $real_pengajar_internal_list->DisplayRecords - 1)
		$real_pengajar_internal_list->StopRecord = $real_pengajar_internal_list->StartRecord + $real_pengajar_internal_list->DisplayRecords - 1;
	else
		$real_pengajar_internal_list->StopRecord = $real_pengajar_internal_list->TotalRecords;
}
$real_pengajar_internal_list->RecordCount = $real_pengajar_internal_list->StartRecord - 1;
if ($real_pengajar_internal_list->Recordset && !$real_pengajar_internal_list->Recordset->EOF) {
	$real_pengajar_internal_list->Recordset->moveFirst();
	$selectLimit = $real_pengajar_internal_list->UseSelectLimit;
	if (!$selectLimit && $real_pengajar_internal_list->StartRecord > 1)
		$real_pengajar_internal_list->Recordset->move($real_pengajar_internal_list->StartRecord - 1);
} elseif (!$real_pengajar_internal->AllowAddDeleteRow && $real_pengajar_internal_list->StopRecord == 0) {
	$real_pengajar_internal_list->StopRecord = $real_pengajar_internal->GridAddRowCount;
}

// Initialize aggregate
$real_pengajar_internal->RowType = ROWTYPE_AGGREGATEINIT;
$real_pengajar_internal->resetAttributes();
$real_pengajar_internal_list->renderRow();
while ($real_pengajar_internal_list->RecordCount < $real_pengajar_internal_list->StopRecord) {
	$real_pengajar_internal_list->RecordCount++;
	if ($real_pengajar_internal_list->RecordCount >= $real_pengajar_internal_list->StartRecord) {
		$real_pengajar_internal_list->RowCount++;

		// Set up key count
		$real_pengajar_internal_list->KeyCount = $real_pengajar_internal_list->RowIndex;

		// Init row class and style
		$real_pengajar_internal->resetAttributes();
		$real_pengajar_internal->CssClass = "";
		if ($real_pengajar_internal_list->isGridAdd()) {
		} else {
			$real_pengajar_internal_list->loadRowValues($real_pengajar_internal_list->Recordset); // Load row values
		}
		$real_pengajar_internal->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$real_pengajar_internal->RowAttrs->merge(["data-rowindex" => $real_pengajar_internal_list->RowCount, "id" => "r" . $real_pengajar_internal_list->RowCount . "_real_pengajar_internal", "data-rowtype" => $real_pengajar_internal->RowType]);

		// Render row
		$real_pengajar_internal_list->renderRow();

		// Render list options
		$real_pengajar_internal_list->renderListOptions();
?>
	<tr <?php echo $real_pengajar_internal->rowAttributes() ?>>
<?php

// Render list options (body, left)
$real_pengajar_internal_list->ListOptions->render("body", "left", $real_pengajar_internal_list->RowCount);
?>
	<?php if ($real_pengajar_internal_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $real_pengajar_internal_list->nama->cellAttributes() ?>>
<span id="el<?php echo $real_pengajar_internal_list->RowCount ?>_real_pengajar_internal_nama">
<span<?php echo $real_pengajar_internal_list->nama->viewAttributes() ?>><?php echo $real_pengajar_internal_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_pengajar_internal_list->pusat->Visible) { // pusat ?>
		<td data-name="pusat" <?php echo $real_pengajar_internal_list->pusat->cellAttributes() ?>>
<span id="el<?php echo $real_pengajar_internal_list->RowCount ?>_real_pengajar_internal_pusat">
<span<?php echo $real_pengajar_internal_list->pusat->viewAttributes() ?>><?php echo $real_pengajar_internal_list->pusat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_pengajar_internal_list->daerah->Visible) { // daerah ?>
		<td data-name="daerah" <?php echo $real_pengajar_internal_list->daerah->cellAttributes() ?>>
<span id="el<?php echo $real_pengajar_internal_list->RowCount ?>_real_pengajar_internal_daerah">
<span<?php echo $real_pengajar_internal_list->daerah->viewAttributes() ?>><?php echo $real_pengajar_internal_list->daerah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_pengajar_internal_list->ket->Visible) { // ket ?>
		<td data-name="ket" <?php echo $real_pengajar_internal_list->ket->cellAttributes() ?>>
<span id="el<?php echo $real_pengajar_internal_list->RowCount ?>_real_pengajar_internal_ket">
<span<?php echo $real_pengajar_internal_list->ket->viewAttributes() ?>><?php echo $real_pengajar_internal_list->ket->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_pengajar_internal_list->bln->Visible) { // bln ?>
		<td data-name="bln" <?php echo $real_pengajar_internal_list->bln->cellAttributes() ?>>
<span id="el<?php echo $real_pengajar_internal_list->RowCount ?>_real_pengajar_internal_bln">
<span<?php echo $real_pengajar_internal_list->bln->viewAttributes() ?>><?php echo $real_pengajar_internal_list->bln->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_pengajar_internal_list->thn->Visible) { // thn ?>
		<td data-name="thn" <?php echo $real_pengajar_internal_list->thn->cellAttributes() ?>>
<span id="el<?php echo $real_pengajar_internal_list->RowCount ?>_real_pengajar_internal_thn">
<span<?php echo $real_pengajar_internal_list->thn->viewAttributes() ?>><?php echo $real_pengajar_internal_list->thn->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$real_pengajar_internal_list->ListOptions->render("body", "right", $real_pengajar_internal_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$real_pengajar_internal_list->isGridAdd())
		$real_pengajar_internal_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$real_pengajar_internal->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($real_pengajar_internal_list->Recordset)
	$real_pengajar_internal_list->Recordset->Close();
?>
<?php if (!$real_pengajar_internal_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$real_pengajar_internal_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $real_pengajar_internal_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $real_pengajar_internal_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($real_pengajar_internal_list->TotalRecords == 0 && !$real_pengajar_internal->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $real_pengajar_internal_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$real_pengajar_internal_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$real_pengajar_internal_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$real_pengajar_internal_list->terminate();
?>