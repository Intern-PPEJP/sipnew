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
$t_prop_list = new t_prop_list();

// Run the page
$t_prop_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_prop_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_prop_list->isExport()) { ?>
<script>
var ft_proplist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_proplist = currentForm = new ew.Form("ft_proplist", "list");
	ft_proplist.formKeyCountName = '<?php echo $t_prop_list->FormKeyCountName ?>';
	loadjs.done("ft_proplist");
});
var ft_proplistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_proplistsrch = currentSearchForm = new ew.Form("ft_proplistsrch");

	// Dynamic selection lists
	// Filters

	ft_proplistsrch.filterList = <?php echo $t_prop_list->getFilterList() ?>;
	loadjs.done("ft_proplistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_prop_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_prop_list->TotalRecords > 0 && $t_prop_list->ExportOptions->visible()) { ?>
<?php $t_prop_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_prop_list->ImportOptions->visible()) { ?>
<?php $t_prop_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_prop_list->SearchOptions->visible()) { ?>
<?php $t_prop_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_prop_list->FilterOptions->visible()) { ?>
<?php $t_prop_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_prop_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_prop_list->isExport() && !$t_prop->CurrentAction) { ?>
<form name="ft_proplistsrch" id="ft_proplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_proplistsrch-search-panel" class="<?php echo $t_prop_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_prop">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $t_prop_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($t_prop_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($t_prop_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $t_prop_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($t_prop_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($t_prop_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($t_prop_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($t_prop_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_prop_list->showPageHeader(); ?>
<?php
$t_prop_list->showMessage();
?>
<?php if ($t_prop_list->TotalRecords > 0 || $t_prop->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_prop_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_prop">
<?php if (!$t_prop_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_prop_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_prop_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_prop_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_proplist" id="ft_proplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_prop">
<div id="gmp_t_prop" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_prop_list->TotalRecords > 0 || $t_prop_list->isGridEdit()) { ?>
<table id="tbl_t_proplist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_prop->RowType = ROWTYPE_HEADER;

// Render list options
$t_prop_list->renderListOptions();

// Render list options (header, left)
$t_prop_list->ListOptions->render("header", "left");
?>
<?php if ($t_prop_list->kdprop->Visible) { // kdprop ?>
	<?php if ($t_prop_list->SortUrl($t_prop_list->kdprop) == "") { ?>
		<th data-name="kdprop" class="<?php echo $t_prop_list->kdprop->headerCellClass() ?>"><div id="elh_t_prop_kdprop" class="t_prop_kdprop"><div class="ew-table-header-caption"><?php echo $t_prop_list->kdprop->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdprop" class="<?php echo $t_prop_list->kdprop->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_prop_list->SortUrl($t_prop_list->kdprop) ?>', 1);"><div id="elh_t_prop_kdprop" class="t_prop_kdprop">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_prop_list->kdprop->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_prop_list->kdprop->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_prop_list->kdprop->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_prop_list->prop->Visible) { // prop ?>
	<?php if ($t_prop_list->SortUrl($t_prop_list->prop) == "") { ?>
		<th data-name="prop" class="<?php echo $t_prop_list->prop->headerCellClass() ?>"><div id="elh_t_prop_prop" class="t_prop_prop"><div class="ew-table-header-caption"><?php echo $t_prop_list->prop->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="prop" class="<?php echo $t_prop_list->prop->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_prop_list->SortUrl($t_prop_list->prop) ?>', 1);"><div id="elh_t_prop_prop" class="t_prop_prop">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_prop_list->prop->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_prop_list->prop->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_prop_list->prop->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_prop_list->jpelatihan->Visible) { // jpelatihan ?>
	<?php if ($t_prop_list->SortUrl($t_prop_list->jpelatihan) == "") { ?>
		<th data-name="jpelatihan" class="<?php echo $t_prop_list->jpelatihan->headerCellClass() ?>"><div id="elh_t_prop_jpelatihan" class="t_prop_jpelatihan"><div class="ew-table-header-caption"><?php echo $t_prop_list->jpelatihan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jpelatihan" class="<?php echo $t_prop_list->jpelatihan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_prop_list->SortUrl($t_prop_list->jpelatihan) ?>', 1);"><div id="elh_t_prop_jpelatihan" class="t_prop_jpelatihan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_prop_list->jpelatihan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_prop_list->jpelatihan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_prop_list->jpelatihan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_prop_list->jpeserta->Visible) { // jpeserta ?>
	<?php if ($t_prop_list->SortUrl($t_prop_list->jpeserta) == "") { ?>
		<th data-name="jpeserta" class="<?php echo $t_prop_list->jpeserta->headerCellClass() ?>"><div id="elh_t_prop_jpeserta" class="t_prop_jpeserta"><div class="ew-table-header-caption"><?php echo $t_prop_list->jpeserta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jpeserta" class="<?php echo $t_prop_list->jpeserta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_prop_list->SortUrl($t_prop_list->jpeserta) ?>', 1);"><div id="elh_t_prop_jpeserta" class="t_prop_jpeserta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_prop_list->jpeserta->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_prop_list->jpeserta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_prop_list->jpeserta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_prop_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_prop_list->ExportAll && $t_prop_list->isExport()) {
	$t_prop_list->StopRecord = $t_prop_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_prop_list->TotalRecords > $t_prop_list->StartRecord + $t_prop_list->DisplayRecords - 1)
		$t_prop_list->StopRecord = $t_prop_list->StartRecord + $t_prop_list->DisplayRecords - 1;
	else
		$t_prop_list->StopRecord = $t_prop_list->TotalRecords;
}
$t_prop_list->RecordCount = $t_prop_list->StartRecord - 1;
if ($t_prop_list->Recordset && !$t_prop_list->Recordset->EOF) {
	$t_prop_list->Recordset->moveFirst();
	$selectLimit = $t_prop_list->UseSelectLimit;
	if (!$selectLimit && $t_prop_list->StartRecord > 1)
		$t_prop_list->Recordset->move($t_prop_list->StartRecord - 1);
} elseif (!$t_prop->AllowAddDeleteRow && $t_prop_list->StopRecord == 0) {
	$t_prop_list->StopRecord = $t_prop->GridAddRowCount;
}

// Initialize aggregate
$t_prop->RowType = ROWTYPE_AGGREGATEINIT;
$t_prop->resetAttributes();
$t_prop_list->renderRow();
while ($t_prop_list->RecordCount < $t_prop_list->StopRecord) {
	$t_prop_list->RecordCount++;
	if ($t_prop_list->RecordCount >= $t_prop_list->StartRecord) {
		$t_prop_list->RowCount++;

		// Set up key count
		$t_prop_list->KeyCount = $t_prop_list->RowIndex;

		// Init row class and style
		$t_prop->resetAttributes();
		$t_prop->CssClass = "";
		if ($t_prop_list->isGridAdd()) {
		} else {
			$t_prop_list->loadRowValues($t_prop_list->Recordset); // Load row values
		}
		$t_prop->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_prop->RowAttrs->merge(["data-rowindex" => $t_prop_list->RowCount, "id" => "r" . $t_prop_list->RowCount . "_t_prop", "data-rowtype" => $t_prop->RowType]);

		// Render row
		$t_prop_list->renderRow();

		// Render list options
		$t_prop_list->renderListOptions();
?>
	<tr <?php echo $t_prop->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_prop_list->ListOptions->render("body", "left", $t_prop_list->RowCount);
?>
	<?php if ($t_prop_list->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" <?php echo $t_prop_list->kdprop->cellAttributes() ?>>
<span id="el<?php echo $t_prop_list->RowCount ?>_t_prop_kdprop">
<span<?php echo $t_prop_list->kdprop->viewAttributes() ?>><?php echo $t_prop_list->kdprop->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_prop_list->prop->Visible) { // prop ?>
		<td data-name="prop" <?php echo $t_prop_list->prop->cellAttributes() ?>>
<span id="el<?php echo $t_prop_list->RowCount ?>_t_prop_prop">
<span<?php echo $t_prop_list->prop->viewAttributes() ?>><?php echo $t_prop_list->prop->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_prop_list->jpelatihan->Visible) { // jpelatihan ?>
		<td data-name="jpelatihan" <?php echo $t_prop_list->jpelatihan->cellAttributes() ?>>
<span id="el<?php echo $t_prop_list->RowCount ?>_t_prop_jpelatihan">
<span<?php echo $t_prop_list->jpelatihan->viewAttributes() ?>><?php echo $t_prop_list->jpelatihan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_prop_list->jpeserta->Visible) { // jpeserta ?>
		<td data-name="jpeserta" <?php echo $t_prop_list->jpeserta->cellAttributes() ?>>
<span id="el<?php echo $t_prop_list->RowCount ?>_t_prop_jpeserta">
<span<?php echo $t_prop_list->jpeserta->viewAttributes() ?>><?php echo $t_prop_list->jpeserta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_prop_list->ListOptions->render("body", "right", $t_prop_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_prop_list->isGridAdd())
		$t_prop_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_prop->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_prop_list->Recordset)
	$t_prop_list->Recordset->Close();
?>
<?php if (!$t_prop_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_prop_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_prop_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_prop_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_prop_list->TotalRecords == 0 && !$t_prop->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_prop_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_prop_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_prop_list->isExport()) { ?>
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
$t_prop_list->terminate();
?>