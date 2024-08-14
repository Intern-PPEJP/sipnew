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
$t_area_list = new t_area_list();

// Run the page
$t_area_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_area_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_area_list->isExport()) { ?>
<script>
var ft_arealist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_arealist = currentForm = new ew.Form("ft_arealist", "list");
	ft_arealist.formKeyCountName = '<?php echo $t_area_list->FormKeyCountName ?>';
	loadjs.done("ft_arealist");
});
var ft_arealistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_arealistsrch = currentSearchForm = new ew.Form("ft_arealistsrch");

	// Dynamic selection lists
	// Filters

	ft_arealistsrch.filterList = <?php echo $t_area_list->getFilterList() ?>;
	loadjs.done("ft_arealistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_area_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_area_list->TotalRecords > 0 && $t_area_list->ExportOptions->visible()) { ?>
<?php $t_area_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_area_list->ImportOptions->visible()) { ?>
<?php $t_area_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_area_list->SearchOptions->visible()) { ?>
<?php $t_area_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_area_list->FilterOptions->visible()) { ?>
<?php $t_area_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_area_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_area_list->isExport() && !$t_area->CurrentAction) { ?>
<form name="ft_arealistsrch" id="ft_arealistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_arealistsrch-search-panel" class="<?php echo $t_area_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_area">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $t_area_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($t_area_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($t_area_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $t_area_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($t_area_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($t_area_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($t_area_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($t_area_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_area_list->showPageHeader(); ?>
<?php
$t_area_list->showMessage();
?>
<?php if ($t_area_list->TotalRecords > 0 || $t_area->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_area_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_area">
<?php if (!$t_area_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_area_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_area_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_area_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_arealist" id="ft_arealist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_area">
<div id="gmp_t_area" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_area_list->TotalRecords > 0 || $t_area_list->isGridEdit()) { ?>
<table id="tbl_t_arealist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_area->RowType = ROWTYPE_HEADER;

// Render list options
$t_area_list->renderListOptions();

// Render list options (header, left)
$t_area_list->ListOptions->render("header", "left");
?>
<?php if ($t_area_list->areaid->Visible) { // areaid ?>
	<?php if ($t_area_list->SortUrl($t_area_list->areaid) == "") { ?>
		<th data-name="areaid" class="<?php echo $t_area_list->areaid->headerCellClass() ?>"><div id="elh_t_area_areaid" class="t_area_areaid"><div class="ew-table-header-caption"><?php echo $t_area_list->areaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="areaid" class="<?php echo $t_area_list->areaid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_area_list->SortUrl($t_area_list->areaid) ?>', 1);"><div id="elh_t_area_areaid" class="t_area_areaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_area_list->areaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_area_list->areaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_area_list->areaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_area_list->area->Visible) { // area ?>
	<?php if ($t_area_list->SortUrl($t_area_list->area) == "") { ?>
		<th data-name="area" class="<?php echo $t_area_list->area->headerCellClass() ?>"><div id="elh_t_area_area" class="t_area_area"><div class="ew-table-header-caption"><?php echo $t_area_list->area->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="area" class="<?php echo $t_area_list->area->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_area_list->SortUrl($t_area_list->area) ?>', 1);"><div id="elh_t_area_area" class="t_area_area">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_area_list->area->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_area_list->area->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_area_list->area->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_area_list->ket->Visible) { // ket ?>
	<?php if ($t_area_list->SortUrl($t_area_list->ket) == "") { ?>
		<th data-name="ket" class="<?php echo $t_area_list->ket->headerCellClass() ?>"><div id="elh_t_area_ket" class="t_area_ket"><div class="ew-table-header-caption"><?php echo $t_area_list->ket->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ket" class="<?php echo $t_area_list->ket->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_area_list->SortUrl($t_area_list->ket) ?>', 1);"><div id="elh_t_area_ket" class="t_area_ket">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_area_list->ket->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_area_list->ket->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_area_list->ket->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_area_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_area_list->ExportAll && $t_area_list->isExport()) {
	$t_area_list->StopRecord = $t_area_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_area_list->TotalRecords > $t_area_list->StartRecord + $t_area_list->DisplayRecords - 1)
		$t_area_list->StopRecord = $t_area_list->StartRecord + $t_area_list->DisplayRecords - 1;
	else
		$t_area_list->StopRecord = $t_area_list->TotalRecords;
}
$t_area_list->RecordCount = $t_area_list->StartRecord - 1;
if ($t_area_list->Recordset && !$t_area_list->Recordset->EOF) {
	$t_area_list->Recordset->moveFirst();
	$selectLimit = $t_area_list->UseSelectLimit;
	if (!$selectLimit && $t_area_list->StartRecord > 1)
		$t_area_list->Recordset->move($t_area_list->StartRecord - 1);
} elseif (!$t_area->AllowAddDeleteRow && $t_area_list->StopRecord == 0) {
	$t_area_list->StopRecord = $t_area->GridAddRowCount;
}

// Initialize aggregate
$t_area->RowType = ROWTYPE_AGGREGATEINIT;
$t_area->resetAttributes();
$t_area_list->renderRow();
while ($t_area_list->RecordCount < $t_area_list->StopRecord) {
	$t_area_list->RecordCount++;
	if ($t_area_list->RecordCount >= $t_area_list->StartRecord) {
		$t_area_list->RowCount++;

		// Set up key count
		$t_area_list->KeyCount = $t_area_list->RowIndex;

		// Init row class and style
		$t_area->resetAttributes();
		$t_area->CssClass = "";
		if ($t_area_list->isGridAdd()) {
		} else {
			$t_area_list->loadRowValues($t_area_list->Recordset); // Load row values
		}
		$t_area->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_area->RowAttrs->merge(["data-rowindex" => $t_area_list->RowCount, "id" => "r" . $t_area_list->RowCount . "_t_area", "data-rowtype" => $t_area->RowType]);

		// Render row
		$t_area_list->renderRow();

		// Render list options
		$t_area_list->renderListOptions();
?>
	<tr <?php echo $t_area->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_area_list->ListOptions->render("body", "left", $t_area_list->RowCount);
?>
	<?php if ($t_area_list->areaid->Visible) { // areaid ?>
		<td data-name="areaid" <?php echo $t_area_list->areaid->cellAttributes() ?>>
<span id="el<?php echo $t_area_list->RowCount ?>_t_area_areaid">
<span<?php echo $t_area_list->areaid->viewAttributes() ?>><?php echo $t_area_list->areaid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_area_list->area->Visible) { // area ?>
		<td data-name="area" <?php echo $t_area_list->area->cellAttributes() ?>>
<span id="el<?php echo $t_area_list->RowCount ?>_t_area_area">
<span<?php echo $t_area_list->area->viewAttributes() ?>><?php echo $t_area_list->area->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_area_list->ket->Visible) { // ket ?>
		<td data-name="ket" <?php echo $t_area_list->ket->cellAttributes() ?>>
<span id="el<?php echo $t_area_list->RowCount ?>_t_area_ket">
<span<?php echo $t_area_list->ket->viewAttributes() ?>><?php echo $t_area_list->ket->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_area_list->ListOptions->render("body", "right", $t_area_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_area_list->isGridAdd())
		$t_area_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_area->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_area_list->Recordset)
	$t_area_list->Recordset->Close();
?>
<?php if (!$t_area_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_area_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_area_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_area_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_area_list->TotalRecords == 0 && !$t_area->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_area_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_area_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_area_list->isExport()) { ?>
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
$t_area_list->terminate();
?>