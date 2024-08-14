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
$t_kota_list = new t_kota_list();

// Run the page
$t_kota_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_kota_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_kota_list->isExport()) { ?>
<script>
var ft_kotalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_kotalist = currentForm = new ew.Form("ft_kotalist", "list");
	ft_kotalist.formKeyCountName = '<?php echo $t_kota_list->FormKeyCountName ?>';
	loadjs.done("ft_kotalist");
});
var ft_kotalistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_kotalistsrch = currentSearchForm = new ew.Form("ft_kotalistsrch");

	// Dynamic selection lists
	// Filters

	ft_kotalistsrch.filterList = <?php echo $t_kota_list->getFilterList() ?>;
	loadjs.done("ft_kotalistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_kota_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_kota_list->TotalRecords > 0 && $t_kota_list->ExportOptions->visible()) { ?>
<?php $t_kota_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_kota_list->ImportOptions->visible()) { ?>
<?php $t_kota_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_kota_list->SearchOptions->visible()) { ?>
<?php $t_kota_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_kota_list->FilterOptions->visible()) { ?>
<?php $t_kota_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_kota_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_kota_list->isExport() && !$t_kota->CurrentAction) { ?>
<form name="ft_kotalistsrch" id="ft_kotalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_kotalistsrch-search-panel" class="<?php echo $t_kota_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_kota">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $t_kota_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($t_kota_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($t_kota_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $t_kota_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($t_kota_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($t_kota_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($t_kota_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($t_kota_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_kota_list->showPageHeader(); ?>
<?php
$t_kota_list->showMessage();
?>
<?php if ($t_kota_list->TotalRecords > 0 || $t_kota->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_kota_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_kota">
<?php if (!$t_kota_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_kota_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_kota_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_kota_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_kotalist" id="ft_kotalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_kota">
<div id="gmp_t_kota" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_kota_list->TotalRecords > 0 || $t_kota_list->isGridEdit()) { ?>
<table id="tbl_t_kotalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_kota->RowType = ROWTYPE_HEADER;

// Render list options
$t_kota_list->renderListOptions();

// Render list options (header, left)
$t_kota_list->ListOptions->render("header", "left");
?>
<?php if ($t_kota_list->kdkota->Visible) { // kdkota ?>
	<?php if ($t_kota_list->SortUrl($t_kota_list->kdkota) == "") { ?>
		<th data-name="kdkota" class="<?php echo $t_kota_list->kdkota->headerCellClass() ?>"><div id="elh_t_kota_kdkota" class="t_kota_kdkota"><div class="ew-table-header-caption"><?php echo $t_kota_list->kdkota->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkota" class="<?php echo $t_kota_list->kdkota->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kota_list->SortUrl($t_kota_list->kdkota) ?>', 1);"><div id="elh_t_kota_kdkota" class="t_kota_kdkota">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kota_list->kdkota->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_kota_list->kdkota->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kota_list->kdkota->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kota_list->kdprop->Visible) { // kdprop ?>
	<?php if ($t_kota_list->SortUrl($t_kota_list->kdprop) == "") { ?>
		<th data-name="kdprop" class="<?php echo $t_kota_list->kdprop->headerCellClass() ?>"><div id="elh_t_kota_kdprop" class="t_kota_kdprop"><div class="ew-table-header-caption"><?php echo $t_kota_list->kdprop->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdprop" class="<?php echo $t_kota_list->kdprop->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kota_list->SortUrl($t_kota_list->kdprop) ?>', 1);"><div id="elh_t_kota_kdprop" class="t_kota_kdprop">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kota_list->kdprop->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kota_list->kdprop->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kota_list->kdprop->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kota_list->kota->Visible) { // kota ?>
	<?php if ($t_kota_list->SortUrl($t_kota_list->kota) == "") { ?>
		<th data-name="kota" class="<?php echo $t_kota_list->kota->headerCellClass() ?>"><div id="elh_t_kota_kota" class="t_kota_kota"><div class="ew-table-header-caption"><?php echo $t_kota_list->kota->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kota" class="<?php echo $t_kota_list->kota->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kota_list->SortUrl($t_kota_list->kota) ?>', 1);"><div id="elh_t_kota_kota" class="t_kota_kota">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kota_list->kota->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_kota_list->kota->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kota_list->kota->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kota_list->jpelatihan->Visible) { // jpelatihan ?>
	<?php if ($t_kota_list->SortUrl($t_kota_list->jpelatihan) == "") { ?>
		<th data-name="jpelatihan" class="<?php echo $t_kota_list->jpelatihan->headerCellClass() ?>"><div id="elh_t_kota_jpelatihan" class="t_kota_jpelatihan"><div class="ew-table-header-caption"><?php echo $t_kota_list->jpelatihan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jpelatihan" class="<?php echo $t_kota_list->jpelatihan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kota_list->SortUrl($t_kota_list->jpelatihan) ?>', 1);"><div id="elh_t_kota_jpelatihan" class="t_kota_jpelatihan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kota_list->jpelatihan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kota_list->jpelatihan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kota_list->jpelatihan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kota_list->jpeserta->Visible) { // jpeserta ?>
	<?php if ($t_kota_list->SortUrl($t_kota_list->jpeserta) == "") { ?>
		<th data-name="jpeserta" class="<?php echo $t_kota_list->jpeserta->headerCellClass() ?>"><div id="elh_t_kota_jpeserta" class="t_kota_jpeserta"><div class="ew-table-header-caption"><?php echo $t_kota_list->jpeserta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jpeserta" class="<?php echo $t_kota_list->jpeserta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kota_list->SortUrl($t_kota_list->jpeserta) ?>', 1);"><div id="elh_t_kota_jpeserta" class="t_kota_jpeserta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kota_list->jpeserta->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kota_list->jpeserta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kota_list->jpeserta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_kota_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_kota_list->ExportAll && $t_kota_list->isExport()) {
	$t_kota_list->StopRecord = $t_kota_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_kota_list->TotalRecords > $t_kota_list->StartRecord + $t_kota_list->DisplayRecords - 1)
		$t_kota_list->StopRecord = $t_kota_list->StartRecord + $t_kota_list->DisplayRecords - 1;
	else
		$t_kota_list->StopRecord = $t_kota_list->TotalRecords;
}
$t_kota_list->RecordCount = $t_kota_list->StartRecord - 1;
if ($t_kota_list->Recordset && !$t_kota_list->Recordset->EOF) {
	$t_kota_list->Recordset->moveFirst();
	$selectLimit = $t_kota_list->UseSelectLimit;
	if (!$selectLimit && $t_kota_list->StartRecord > 1)
		$t_kota_list->Recordset->move($t_kota_list->StartRecord - 1);
} elseif (!$t_kota->AllowAddDeleteRow && $t_kota_list->StopRecord == 0) {
	$t_kota_list->StopRecord = $t_kota->GridAddRowCount;
}

// Initialize aggregate
$t_kota->RowType = ROWTYPE_AGGREGATEINIT;
$t_kota->resetAttributes();
$t_kota_list->renderRow();
while ($t_kota_list->RecordCount < $t_kota_list->StopRecord) {
	$t_kota_list->RecordCount++;
	if ($t_kota_list->RecordCount >= $t_kota_list->StartRecord) {
		$t_kota_list->RowCount++;

		// Set up key count
		$t_kota_list->KeyCount = $t_kota_list->RowIndex;

		// Init row class and style
		$t_kota->resetAttributes();
		$t_kota->CssClass = "";
		if ($t_kota_list->isGridAdd()) {
		} else {
			$t_kota_list->loadRowValues($t_kota_list->Recordset); // Load row values
		}
		$t_kota->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_kota->RowAttrs->merge(["data-rowindex" => $t_kota_list->RowCount, "id" => "r" . $t_kota_list->RowCount . "_t_kota", "data-rowtype" => $t_kota->RowType]);

		// Render row
		$t_kota_list->renderRow();

		// Render list options
		$t_kota_list->renderListOptions();
?>
	<tr <?php echo $t_kota->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_kota_list->ListOptions->render("body", "left", $t_kota_list->RowCount);
?>
	<?php if ($t_kota_list->kdkota->Visible) { // kdkota ?>
		<td data-name="kdkota" <?php echo $t_kota_list->kdkota->cellAttributes() ?>>
<span id="el<?php echo $t_kota_list->RowCount ?>_t_kota_kdkota">
<span<?php echo $t_kota_list->kdkota->viewAttributes() ?>><?php echo $t_kota_list->kdkota->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_kota_list->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" <?php echo $t_kota_list->kdprop->cellAttributes() ?>>
<span id="el<?php echo $t_kota_list->RowCount ?>_t_kota_kdprop">
<span<?php echo $t_kota_list->kdprop->viewAttributes() ?>><?php echo $t_kota_list->kdprop->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_kota_list->kota->Visible) { // kota ?>
		<td data-name="kota" <?php echo $t_kota_list->kota->cellAttributes() ?>>
<span id="el<?php echo $t_kota_list->RowCount ?>_t_kota_kota">
<span<?php echo $t_kota_list->kota->viewAttributes() ?>><?php echo $t_kota_list->kota->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_kota_list->jpelatihan->Visible) { // jpelatihan ?>
		<td data-name="jpelatihan" <?php echo $t_kota_list->jpelatihan->cellAttributes() ?>>
<span id="el<?php echo $t_kota_list->RowCount ?>_t_kota_jpelatihan">
<span<?php echo $t_kota_list->jpelatihan->viewAttributes() ?>><?php echo $t_kota_list->jpelatihan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_kota_list->jpeserta->Visible) { // jpeserta ?>
		<td data-name="jpeserta" <?php echo $t_kota_list->jpeserta->cellAttributes() ?>>
<span id="el<?php echo $t_kota_list->RowCount ?>_t_kota_jpeserta">
<span<?php echo $t_kota_list->jpeserta->viewAttributes() ?>><?php echo $t_kota_list->jpeserta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_kota_list->ListOptions->render("body", "right", $t_kota_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_kota_list->isGridAdd())
		$t_kota_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_kota->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_kota_list->Recordset)
	$t_kota_list->Recordset->Close();
?>
<?php if (!$t_kota_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_kota_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_kota_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_kota_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_kota_list->TotalRecords == 0 && !$t_kota->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_kota_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_kota_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_kota_list->isExport()) { ?>
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
$t_kota_list->terminate();
?>