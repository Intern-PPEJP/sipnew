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
$t_produknafed_list = new t_produknafed_list();

// Run the page
$t_produknafed_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_produknafed_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_produknafed_list->isExport()) { ?>
<script>
var ft_produknafedlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_produknafedlist = currentForm = new ew.Form("ft_produknafedlist", "list");
	ft_produknafedlist.formKeyCountName = '<?php echo $t_produknafed_list->FormKeyCountName ?>';
	loadjs.done("ft_produknafedlist");
});
var ft_produknafedlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_produknafedlistsrch = currentSearchForm = new ew.Form("ft_produknafedlistsrch");

	// Dynamic selection lists
	// Filters

	ft_produknafedlistsrch.filterList = <?php echo $t_produknafed_list->getFilterList() ?>;
	loadjs.done("ft_produknafedlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_produknafed_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_produknafed_list->TotalRecords > 0 && $t_produknafed_list->ExportOptions->visible()) { ?>
<?php $t_produknafed_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_produknafed_list->ImportOptions->visible()) { ?>
<?php $t_produknafed_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_produknafed_list->SearchOptions->visible()) { ?>
<?php $t_produknafed_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_produknafed_list->FilterOptions->visible()) { ?>
<?php $t_produknafed_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_produknafed_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_produknafed_list->isExport() && !$t_produknafed->CurrentAction) { ?>
<form name="ft_produknafedlistsrch" id="ft_produknafedlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_produknafedlistsrch-search-panel" class="<?php echo $t_produknafed_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_produknafed">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $t_produknafed_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($t_produknafed_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($t_produknafed_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $t_produknafed_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($t_produknafed_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($t_produknafed_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($t_produknafed_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($t_produknafed_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_produknafed_list->showPageHeader(); ?>
<?php
$t_produknafed_list->showMessage();
?>
<?php if ($t_produknafed_list->TotalRecords > 0 || $t_produknafed->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_produknafed_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_produknafed">
<?php if (!$t_produknafed_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_produknafed_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_produknafed_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_produknafed_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_produknafedlist" id="ft_produknafedlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_produknafed">
<div id="gmp_t_produknafed" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_produknafed_list->TotalRecords > 0 || $t_produknafed_list->isGridEdit()) { ?>
<table id="tbl_t_produknafedlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_produknafed->RowType = ROWTYPE_HEADER;

// Render list options
$t_produknafed_list->renderListOptions();

// Render list options (header, left)
$t_produknafed_list->ListOptions->render("header", "left");
?>
<?php if ($t_produknafed_list->kdproduknafed->Visible) { // kdproduknafed ?>
	<?php if ($t_produknafed_list->SortUrl($t_produknafed_list->kdproduknafed) == "") { ?>
		<th data-name="kdproduknafed" class="<?php echo $t_produknafed_list->kdproduknafed->headerCellClass() ?>"><div id="elh_t_produknafed_kdproduknafed" class="t_produknafed_kdproduknafed"><div class="ew-table-header-caption"><?php echo $t_produknafed_list->kdproduknafed->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdproduknafed" class="<?php echo $t_produknafed_list->kdproduknafed->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_produknafed_list->SortUrl($t_produknafed_list->kdproduknafed) ?>', 1);"><div id="elh_t_produknafed_kdproduknafed" class="t_produknafed_kdproduknafed">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_produknafed_list->kdproduknafed->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_produknafed_list->kdproduknafed->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_produknafed_list->kdproduknafed->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_produknafed_list->produknafed->Visible) { // produknafed ?>
	<?php if ($t_produknafed_list->SortUrl($t_produknafed_list->produknafed) == "") { ?>
		<th data-name="produknafed" class="<?php echo $t_produknafed_list->produknafed->headerCellClass() ?>"><div id="elh_t_produknafed_produknafed" class="t_produknafed_produknafed"><div class="ew-table-header-caption"><?php echo $t_produknafed_list->produknafed->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="produknafed" class="<?php echo $t_produknafed_list->produknafed->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_produknafed_list->SortUrl($t_produknafed_list->produknafed) ?>', 1);"><div id="elh_t_produknafed_produknafed" class="t_produknafed_produknafed">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_produknafed_list->produknafed->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_produknafed_list->produknafed->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_produknafed_list->produknafed->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_produknafed_list->produknafedid->Visible) { // produknafedid ?>
	<?php if ($t_produknafed_list->SortUrl($t_produknafed_list->produknafedid) == "") { ?>
		<th data-name="produknafedid" class="<?php echo $t_produknafed_list->produknafedid->headerCellClass() ?>"><div id="elh_t_produknafed_produknafedid" class="t_produknafed_produknafedid"><div class="ew-table-header-caption"><?php echo $t_produknafed_list->produknafedid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="produknafedid" class="<?php echo $t_produknafed_list->produknafedid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_produknafed_list->SortUrl($t_produknafed_list->produknafedid) ?>', 1);"><div id="elh_t_produknafed_produknafedid" class="t_produknafed_produknafedid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_produknafed_list->produknafedid->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_produknafed_list->produknafedid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_produknafed_list->produknafedid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_produknafed_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_produknafed_list->ExportAll && $t_produknafed_list->isExport()) {
	$t_produknafed_list->StopRecord = $t_produknafed_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_produknafed_list->TotalRecords > $t_produknafed_list->StartRecord + $t_produknafed_list->DisplayRecords - 1)
		$t_produknafed_list->StopRecord = $t_produknafed_list->StartRecord + $t_produknafed_list->DisplayRecords - 1;
	else
		$t_produknafed_list->StopRecord = $t_produknafed_list->TotalRecords;
}
$t_produknafed_list->RecordCount = $t_produknafed_list->StartRecord - 1;
if ($t_produknafed_list->Recordset && !$t_produknafed_list->Recordset->EOF) {
	$t_produknafed_list->Recordset->moveFirst();
	$selectLimit = $t_produknafed_list->UseSelectLimit;
	if (!$selectLimit && $t_produknafed_list->StartRecord > 1)
		$t_produknafed_list->Recordset->move($t_produknafed_list->StartRecord - 1);
} elseif (!$t_produknafed->AllowAddDeleteRow && $t_produknafed_list->StopRecord == 0) {
	$t_produknafed_list->StopRecord = $t_produknafed->GridAddRowCount;
}

// Initialize aggregate
$t_produknafed->RowType = ROWTYPE_AGGREGATEINIT;
$t_produknafed->resetAttributes();
$t_produknafed_list->renderRow();
while ($t_produknafed_list->RecordCount < $t_produknafed_list->StopRecord) {
	$t_produknafed_list->RecordCount++;
	if ($t_produknafed_list->RecordCount >= $t_produknafed_list->StartRecord) {
		$t_produknafed_list->RowCount++;

		// Set up key count
		$t_produknafed_list->KeyCount = $t_produknafed_list->RowIndex;

		// Init row class and style
		$t_produknafed->resetAttributes();
		$t_produknafed->CssClass = "";
		if ($t_produknafed_list->isGridAdd()) {
		} else {
			$t_produknafed_list->loadRowValues($t_produknafed_list->Recordset); // Load row values
		}
		$t_produknafed->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_produknafed->RowAttrs->merge(["data-rowindex" => $t_produknafed_list->RowCount, "id" => "r" . $t_produknafed_list->RowCount . "_t_produknafed", "data-rowtype" => $t_produknafed->RowType]);

		// Render row
		$t_produknafed_list->renderRow();

		// Render list options
		$t_produknafed_list->renderListOptions();
?>
	<tr <?php echo $t_produknafed->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_produknafed_list->ListOptions->render("body", "left", $t_produknafed_list->RowCount);
?>
	<?php if ($t_produknafed_list->kdproduknafed->Visible) { // kdproduknafed ?>
		<td data-name="kdproduknafed" <?php echo $t_produknafed_list->kdproduknafed->cellAttributes() ?>>
<span id="el<?php echo $t_produknafed_list->RowCount ?>_t_produknafed_kdproduknafed">
<span<?php echo $t_produknafed_list->kdproduknafed->viewAttributes() ?>><?php echo $t_produknafed_list->kdproduknafed->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_produknafed_list->produknafed->Visible) { // produknafed ?>
		<td data-name="produknafed" <?php echo $t_produknafed_list->produknafed->cellAttributes() ?>>
<span id="el<?php echo $t_produknafed_list->RowCount ?>_t_produknafed_produknafed">
<span<?php echo $t_produknafed_list->produknafed->viewAttributes() ?>><?php echo $t_produknafed_list->produknafed->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_produknafed_list->produknafedid->Visible) { // produknafedid ?>
		<td data-name="produknafedid" <?php echo $t_produknafed_list->produknafedid->cellAttributes() ?>>
<span id="el<?php echo $t_produknafed_list->RowCount ?>_t_produknafed_produknafedid">
<span<?php echo $t_produknafed_list->produknafedid->viewAttributes() ?>><?php echo $t_produknafed_list->produknafedid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_produknafed_list->ListOptions->render("body", "right", $t_produknafed_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_produknafed_list->isGridAdd())
		$t_produknafed_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_produknafed->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_produknafed_list->Recordset)
	$t_produknafed_list->Recordset->Close();
?>
<?php if (!$t_produknafed_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_produknafed_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_produknafed_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_produknafed_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_produknafed_list->TotalRecords == 0 && !$t_produknafed->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_produknafed_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_produknafed_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_produknafed_list->isExport()) { ?>
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
$t_produknafed_list->terminate();
?>