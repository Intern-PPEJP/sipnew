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
$t_bagian_list = new t_bagian_list();

// Run the page
$t_bagian_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_bagian_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_bagian_list->isExport()) { ?>
<script>
var ft_bagianlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_bagianlist = currentForm = new ew.Form("ft_bagianlist", "list");
	ft_bagianlist.formKeyCountName = '<?php echo $t_bagian_list->FormKeyCountName ?>';
	loadjs.done("ft_bagianlist");
});
var ft_bagianlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_bagianlistsrch = currentSearchForm = new ew.Form("ft_bagianlistsrch");

	// Dynamic selection lists
	// Filters

	ft_bagianlistsrch.filterList = <?php echo $t_bagian_list->getFilterList() ?>;
	loadjs.done("ft_bagianlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_bagian_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_bagian_list->TotalRecords > 0 && $t_bagian_list->ExportOptions->visible()) { ?>
<?php $t_bagian_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_bagian_list->ImportOptions->visible()) { ?>
<?php $t_bagian_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_bagian_list->SearchOptions->visible()) { ?>
<?php $t_bagian_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_bagian_list->FilterOptions->visible()) { ?>
<?php $t_bagian_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_bagian_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_bagian_list->isExport() && !$t_bagian->CurrentAction) { ?>
<form name="ft_bagianlistsrch" id="ft_bagianlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_bagianlistsrch-search-panel" class="<?php echo $t_bagian_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_bagian">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $t_bagian_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($t_bagian_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($t_bagian_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $t_bagian_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($t_bagian_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($t_bagian_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($t_bagian_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($t_bagian_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_bagian_list->showPageHeader(); ?>
<?php
$t_bagian_list->showMessage();
?>
<?php if ($t_bagian_list->TotalRecords > 0 || $t_bagian->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_bagian_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_bagian">
<?php if (!$t_bagian_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_bagian_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_bagian_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_bagian_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_bagianlist" id="ft_bagianlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_bagian">
<div id="gmp_t_bagian" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_bagian_list->TotalRecords > 0 || $t_bagian_list->isGridEdit()) { ?>
<table id="tbl_t_bagianlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_bagian->RowType = ROWTYPE_HEADER;

// Render list options
$t_bagian_list->renderListOptions();

// Render list options (header, left)
$t_bagian_list->ListOptions->render("header", "left");
?>
<?php if ($t_bagian_list->kdbagian->Visible) { // kdbagian ?>
	<?php if ($t_bagian_list->SortUrl($t_bagian_list->kdbagian) == "") { ?>
		<th data-name="kdbagian" class="<?php echo $t_bagian_list->kdbagian->headerCellClass() ?>"><div id="elh_t_bagian_kdbagian" class="t_bagian_kdbagian"><div class="ew-table-header-caption"><?php echo $t_bagian_list->kdbagian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdbagian" class="<?php echo $t_bagian_list->kdbagian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_bagian_list->SortUrl($t_bagian_list->kdbagian) ?>', 1);"><div id="elh_t_bagian_kdbagian" class="t_bagian_kdbagian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_bagian_list->kdbagian->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_bagian_list->kdbagian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_bagian_list->kdbagian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_bagian_list->namabagian->Visible) { // namabagian ?>
	<?php if ($t_bagian_list->SortUrl($t_bagian_list->namabagian) == "") { ?>
		<th data-name="namabagian" class="<?php echo $t_bagian_list->namabagian->headerCellClass() ?>"><div id="elh_t_bagian_namabagian" class="t_bagian_namabagian"><div class="ew-table-header-caption"><?php echo $t_bagian_list->namabagian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="namabagian" class="<?php echo $t_bagian_list->namabagian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_bagian_list->SortUrl($t_bagian_list->namabagian) ?>', 1);"><div id="elh_t_bagian_namabagian" class="t_bagian_namabagian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_bagian_list->namabagian->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_bagian_list->namabagian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_bagian_list->namabagian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_bagian_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_bagian_list->ExportAll && $t_bagian_list->isExport()) {
	$t_bagian_list->StopRecord = $t_bagian_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_bagian_list->TotalRecords > $t_bagian_list->StartRecord + $t_bagian_list->DisplayRecords - 1)
		$t_bagian_list->StopRecord = $t_bagian_list->StartRecord + $t_bagian_list->DisplayRecords - 1;
	else
		$t_bagian_list->StopRecord = $t_bagian_list->TotalRecords;
}
$t_bagian_list->RecordCount = $t_bagian_list->StartRecord - 1;
if ($t_bagian_list->Recordset && !$t_bagian_list->Recordset->EOF) {
	$t_bagian_list->Recordset->moveFirst();
	$selectLimit = $t_bagian_list->UseSelectLimit;
	if (!$selectLimit && $t_bagian_list->StartRecord > 1)
		$t_bagian_list->Recordset->move($t_bagian_list->StartRecord - 1);
} elseif (!$t_bagian->AllowAddDeleteRow && $t_bagian_list->StopRecord == 0) {
	$t_bagian_list->StopRecord = $t_bagian->GridAddRowCount;
}

// Initialize aggregate
$t_bagian->RowType = ROWTYPE_AGGREGATEINIT;
$t_bagian->resetAttributes();
$t_bagian_list->renderRow();
while ($t_bagian_list->RecordCount < $t_bagian_list->StopRecord) {
	$t_bagian_list->RecordCount++;
	if ($t_bagian_list->RecordCount >= $t_bagian_list->StartRecord) {
		$t_bagian_list->RowCount++;

		// Set up key count
		$t_bagian_list->KeyCount = $t_bagian_list->RowIndex;

		// Init row class and style
		$t_bagian->resetAttributes();
		$t_bagian->CssClass = "";
		if ($t_bagian_list->isGridAdd()) {
		} else {
			$t_bagian_list->loadRowValues($t_bagian_list->Recordset); // Load row values
		}
		$t_bagian->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_bagian->RowAttrs->merge(["data-rowindex" => $t_bagian_list->RowCount, "id" => "r" . $t_bagian_list->RowCount . "_t_bagian", "data-rowtype" => $t_bagian->RowType]);

		// Render row
		$t_bagian_list->renderRow();

		// Render list options
		$t_bagian_list->renderListOptions();
?>
	<tr <?php echo $t_bagian->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_bagian_list->ListOptions->render("body", "left", $t_bagian_list->RowCount);
?>
	<?php if ($t_bagian_list->kdbagian->Visible) { // kdbagian ?>
		<td data-name="kdbagian" <?php echo $t_bagian_list->kdbagian->cellAttributes() ?>>
<span id="el<?php echo $t_bagian_list->RowCount ?>_t_bagian_kdbagian">
<span<?php echo $t_bagian_list->kdbagian->viewAttributes() ?>><?php echo $t_bagian_list->kdbagian->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_bagian_list->namabagian->Visible) { // namabagian ?>
		<td data-name="namabagian" <?php echo $t_bagian_list->namabagian->cellAttributes() ?>>
<span id="el<?php echo $t_bagian_list->RowCount ?>_t_bagian_namabagian">
<span<?php echo $t_bagian_list->namabagian->viewAttributes() ?>><?php echo $t_bagian_list->namabagian->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_bagian_list->ListOptions->render("body", "right", $t_bagian_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_bagian_list->isGridAdd())
		$t_bagian_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_bagian->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_bagian_list->Recordset)
	$t_bagian_list->Recordset->Close();
?>
<?php if (!$t_bagian_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_bagian_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_bagian_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_bagian_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_bagian_list->TotalRecords == 0 && !$t_bagian->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_bagian_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_bagian_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_bagian_list->isExport()) { ?>
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
$t_bagian_list->terminate();
?>