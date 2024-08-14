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
$t_produk_list = new t_produk_list();

// Run the page
$t_produk_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_produk_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_produk_list->isExport()) { ?>
<script>
var ft_produklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_produklist = currentForm = new ew.Form("ft_produklist", "list");
	ft_produklist.formKeyCountName = '<?php echo $t_produk_list->FormKeyCountName ?>';
	loadjs.done("ft_produklist");
});
var ft_produklistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_produklistsrch = currentSearchForm = new ew.Form("ft_produklistsrch");

	// Dynamic selection lists
	// Filters

	ft_produklistsrch.filterList = <?php echo $t_produk_list->getFilterList() ?>;
	loadjs.done("ft_produklistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_produk_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_produk_list->TotalRecords > 0 && $t_produk_list->ExportOptions->visible()) { ?>
<?php $t_produk_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_produk_list->ImportOptions->visible()) { ?>
<?php $t_produk_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_produk_list->SearchOptions->visible()) { ?>
<?php $t_produk_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_produk_list->FilterOptions->visible()) { ?>
<?php $t_produk_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_produk_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_produk_list->isExport() && !$t_produk->CurrentAction) { ?>
<form name="ft_produklistsrch" id="ft_produklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_produklistsrch-search-panel" class="<?php echo $t_produk_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_produk">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $t_produk_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($t_produk_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($t_produk_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $t_produk_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($t_produk_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($t_produk_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($t_produk_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($t_produk_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_produk_list->showPageHeader(); ?>
<?php
$t_produk_list->showMessage();
?>
<?php if ($t_produk_list->TotalRecords > 0 || $t_produk->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_produk_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_produk">
<?php if (!$t_produk_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_produk_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_produk_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_produk_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_produklist" id="ft_produklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_produk">
<div id="gmp_t_produk" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_produk_list->TotalRecords > 0 || $t_produk_list->isGridEdit()) { ?>
<table id="tbl_t_produklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_produk->RowType = ROWTYPE_HEADER;

// Render list options
$t_produk_list->renderListOptions();

// Render list options (header, left)
$t_produk_list->ListOptions->render("header", "left");
?>
<?php if ($t_produk_list->kdproduk->Visible) { // kdproduk ?>
	<?php if ($t_produk_list->SortUrl($t_produk_list->kdproduk) == "") { ?>
		<th data-name="kdproduk" class="<?php echo $t_produk_list->kdproduk->headerCellClass() ?>"><div id="elh_t_produk_kdproduk" class="t_produk_kdproduk"><div class="ew-table-header-caption"><?php echo $t_produk_list->kdproduk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdproduk" class="<?php echo $t_produk_list->kdproduk->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_produk_list->SortUrl($t_produk_list->kdproduk) ?>', 1);"><div id="elh_t_produk_kdproduk" class="t_produk_kdproduk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_produk_list->kdproduk->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_produk_list->kdproduk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_produk_list->kdproduk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_produk_list->produk->Visible) { // produk ?>
	<?php if ($t_produk_list->SortUrl($t_produk_list->produk) == "") { ?>
		<th data-name="produk" class="<?php echo $t_produk_list->produk->headerCellClass() ?>"><div id="elh_t_produk_produk" class="t_produk_produk"><div class="ew-table-header-caption"><?php echo $t_produk_list->produk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="produk" class="<?php echo $t_produk_list->produk->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_produk_list->SortUrl($t_produk_list->produk) ?>', 1);"><div id="elh_t_produk_produk" class="t_produk_produk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_produk_list->produk->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_produk_list->produk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_produk_list->produk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_produk_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_produk_list->ExportAll && $t_produk_list->isExport()) {
	$t_produk_list->StopRecord = $t_produk_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_produk_list->TotalRecords > $t_produk_list->StartRecord + $t_produk_list->DisplayRecords - 1)
		$t_produk_list->StopRecord = $t_produk_list->StartRecord + $t_produk_list->DisplayRecords - 1;
	else
		$t_produk_list->StopRecord = $t_produk_list->TotalRecords;
}
$t_produk_list->RecordCount = $t_produk_list->StartRecord - 1;
if ($t_produk_list->Recordset && !$t_produk_list->Recordset->EOF) {
	$t_produk_list->Recordset->moveFirst();
	$selectLimit = $t_produk_list->UseSelectLimit;
	if (!$selectLimit && $t_produk_list->StartRecord > 1)
		$t_produk_list->Recordset->move($t_produk_list->StartRecord - 1);
} elseif (!$t_produk->AllowAddDeleteRow && $t_produk_list->StopRecord == 0) {
	$t_produk_list->StopRecord = $t_produk->GridAddRowCount;
}

// Initialize aggregate
$t_produk->RowType = ROWTYPE_AGGREGATEINIT;
$t_produk->resetAttributes();
$t_produk_list->renderRow();
while ($t_produk_list->RecordCount < $t_produk_list->StopRecord) {
	$t_produk_list->RecordCount++;
	if ($t_produk_list->RecordCount >= $t_produk_list->StartRecord) {
		$t_produk_list->RowCount++;

		// Set up key count
		$t_produk_list->KeyCount = $t_produk_list->RowIndex;

		// Init row class and style
		$t_produk->resetAttributes();
		$t_produk->CssClass = "";
		if ($t_produk_list->isGridAdd()) {
		} else {
			$t_produk_list->loadRowValues($t_produk_list->Recordset); // Load row values
		}
		$t_produk->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_produk->RowAttrs->merge(["data-rowindex" => $t_produk_list->RowCount, "id" => "r" . $t_produk_list->RowCount . "_t_produk", "data-rowtype" => $t_produk->RowType]);

		// Render row
		$t_produk_list->renderRow();

		// Render list options
		$t_produk_list->renderListOptions();
?>
	<tr <?php echo $t_produk->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_produk_list->ListOptions->render("body", "left", $t_produk_list->RowCount);
?>
	<?php if ($t_produk_list->kdproduk->Visible) { // kdproduk ?>
		<td data-name="kdproduk" <?php echo $t_produk_list->kdproduk->cellAttributes() ?>>
<span id="el<?php echo $t_produk_list->RowCount ?>_t_produk_kdproduk">
<span<?php echo $t_produk_list->kdproduk->viewAttributes() ?>><?php echo $t_produk_list->kdproduk->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_produk_list->produk->Visible) { // produk ?>
		<td data-name="produk" <?php echo $t_produk_list->produk->cellAttributes() ?>>
<span id="el<?php echo $t_produk_list->RowCount ?>_t_produk_produk">
<span<?php echo $t_produk_list->produk->viewAttributes() ?>><?php echo $t_produk_list->produk->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_produk_list->ListOptions->render("body", "right", $t_produk_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_produk_list->isGridAdd())
		$t_produk_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_produk->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_produk_list->Recordset)
	$t_produk_list->Recordset->Close();
?>
<?php if (!$t_produk_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_produk_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_produk_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_produk_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_produk_list->TotalRecords == 0 && !$t_produk->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_produk_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_produk_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_produk_list->isExport()) { ?>
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
$t_produk_list->terminate();
?>