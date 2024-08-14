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
$t_kec_list = new t_kec_list();

// Run the page
$t_kec_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_kec_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_kec_list->isExport()) { ?>
<script>
var ft_keclist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_keclist = currentForm = new ew.Form("ft_keclist", "list");
	ft_keclist.formKeyCountName = '<?php echo $t_kec_list->FormKeyCountName ?>';
	loadjs.done("ft_keclist");
});
var ft_keclistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_keclistsrch = currentSearchForm = new ew.Form("ft_keclistsrch");

	// Dynamic selection lists
	// Filters

	ft_keclistsrch.filterList = <?php echo $t_kec_list->getFilterList() ?>;
	loadjs.done("ft_keclistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_kec_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_kec_list->TotalRecords > 0 && $t_kec_list->ExportOptions->visible()) { ?>
<?php $t_kec_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_kec_list->ImportOptions->visible()) { ?>
<?php $t_kec_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_kec_list->SearchOptions->visible()) { ?>
<?php $t_kec_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_kec_list->FilterOptions->visible()) { ?>
<?php $t_kec_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_kec_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_kec_list->isExport() && !$t_kec->CurrentAction) { ?>
<form name="ft_keclistsrch" id="ft_keclistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_keclistsrch-search-panel" class="<?php echo $t_kec_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_kec">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $t_kec_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($t_kec_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($t_kec_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $t_kec_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($t_kec_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($t_kec_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($t_kec_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($t_kec_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_kec_list->showPageHeader(); ?>
<?php
$t_kec_list->showMessage();
?>
<?php if ($t_kec_list->TotalRecords > 0 || $t_kec->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_kec_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_kec">
<?php if (!$t_kec_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_kec_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_kec_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_kec_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_keclist" id="ft_keclist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_kec">
<div id="gmp_t_kec" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_kec_list->TotalRecords > 0 || $t_kec_list->isGridEdit()) { ?>
<table id="tbl_t_keclist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_kec->RowType = ROWTYPE_HEADER;

// Render list options
$t_kec_list->renderListOptions();

// Render list options (header, left)
$t_kec_list->ListOptions->render("header", "left");
?>
<?php if ($t_kec_list->kdkec->Visible) { // kdkec ?>
	<?php if ($t_kec_list->SortUrl($t_kec_list->kdkec) == "") { ?>
		<th data-name="kdkec" class="<?php echo $t_kec_list->kdkec->headerCellClass() ?>"><div id="elh_t_kec_kdkec" class="t_kec_kdkec"><div class="ew-table-header-caption"><?php echo $t_kec_list->kdkec->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkec" class="<?php echo $t_kec_list->kdkec->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kec_list->SortUrl($t_kec_list->kdkec) ?>', 1);"><div id="elh_t_kec_kdkec" class="t_kec_kdkec">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kec_list->kdkec->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kec_list->kdkec->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kec_list->kdkec->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kec_list->kdprop->Visible) { // kdprop ?>
	<?php if ($t_kec_list->SortUrl($t_kec_list->kdprop) == "") { ?>
		<th data-name="kdprop" class="<?php echo $t_kec_list->kdprop->headerCellClass() ?>"><div id="elh_t_kec_kdprop" class="t_kec_kdprop"><div class="ew-table-header-caption"><?php echo $t_kec_list->kdprop->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdprop" class="<?php echo $t_kec_list->kdprop->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kec_list->SortUrl($t_kec_list->kdprop) ?>', 1);"><div id="elh_t_kec_kdprop" class="t_kec_kdprop">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kec_list->kdprop->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kec_list->kdprop->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kec_list->kdprop->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kec_list->kdkota->Visible) { // kdkota ?>
	<?php if ($t_kec_list->SortUrl($t_kec_list->kdkota) == "") { ?>
		<th data-name="kdkota" class="<?php echo $t_kec_list->kdkota->headerCellClass() ?>"><div id="elh_t_kec_kdkota" class="t_kec_kdkota"><div class="ew-table-header-caption"><?php echo $t_kec_list->kdkota->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkota" class="<?php echo $t_kec_list->kdkota->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kec_list->SortUrl($t_kec_list->kdkota) ?>', 1);"><div id="elh_t_kec_kdkota" class="t_kec_kdkota">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kec_list->kdkota->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kec_list->kdkota->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kec_list->kdkota->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kec_list->kec->Visible) { // kec ?>
	<?php if ($t_kec_list->SortUrl($t_kec_list->kec) == "") { ?>
		<th data-name="kec" class="<?php echo $t_kec_list->kec->headerCellClass() ?>"><div id="elh_t_kec_kec" class="t_kec_kec"><div class="ew-table-header-caption"><?php echo $t_kec_list->kec->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kec" class="<?php echo $t_kec_list->kec->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kec_list->SortUrl($t_kec_list->kec) ?>', 1);"><div id="elh_t_kec_kec" class="t_kec_kec">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kec_list->kec->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_kec_list->kec->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kec_list->kec->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_kec_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_kec_list->ExportAll && $t_kec_list->isExport()) {
	$t_kec_list->StopRecord = $t_kec_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_kec_list->TotalRecords > $t_kec_list->StartRecord + $t_kec_list->DisplayRecords - 1)
		$t_kec_list->StopRecord = $t_kec_list->StartRecord + $t_kec_list->DisplayRecords - 1;
	else
		$t_kec_list->StopRecord = $t_kec_list->TotalRecords;
}
$t_kec_list->RecordCount = $t_kec_list->StartRecord - 1;
if ($t_kec_list->Recordset && !$t_kec_list->Recordset->EOF) {
	$t_kec_list->Recordset->moveFirst();
	$selectLimit = $t_kec_list->UseSelectLimit;
	if (!$selectLimit && $t_kec_list->StartRecord > 1)
		$t_kec_list->Recordset->move($t_kec_list->StartRecord - 1);
} elseif (!$t_kec->AllowAddDeleteRow && $t_kec_list->StopRecord == 0) {
	$t_kec_list->StopRecord = $t_kec->GridAddRowCount;
}

// Initialize aggregate
$t_kec->RowType = ROWTYPE_AGGREGATEINIT;
$t_kec->resetAttributes();
$t_kec_list->renderRow();
while ($t_kec_list->RecordCount < $t_kec_list->StopRecord) {
	$t_kec_list->RecordCount++;
	if ($t_kec_list->RecordCount >= $t_kec_list->StartRecord) {
		$t_kec_list->RowCount++;

		// Set up key count
		$t_kec_list->KeyCount = $t_kec_list->RowIndex;

		// Init row class and style
		$t_kec->resetAttributes();
		$t_kec->CssClass = "";
		if ($t_kec_list->isGridAdd()) {
		} else {
			$t_kec_list->loadRowValues($t_kec_list->Recordset); // Load row values
		}
		$t_kec->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_kec->RowAttrs->merge(["data-rowindex" => $t_kec_list->RowCount, "id" => "r" . $t_kec_list->RowCount . "_t_kec", "data-rowtype" => $t_kec->RowType]);

		// Render row
		$t_kec_list->renderRow();

		// Render list options
		$t_kec_list->renderListOptions();
?>
	<tr <?php echo $t_kec->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_kec_list->ListOptions->render("body", "left", $t_kec_list->RowCount);
?>
	<?php if ($t_kec_list->kdkec->Visible) { // kdkec ?>
		<td data-name="kdkec" <?php echo $t_kec_list->kdkec->cellAttributes() ?>>
<span id="el<?php echo $t_kec_list->RowCount ?>_t_kec_kdkec">
<span<?php echo $t_kec_list->kdkec->viewAttributes() ?>><?php echo $t_kec_list->kdkec->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_kec_list->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" <?php echo $t_kec_list->kdprop->cellAttributes() ?>>
<span id="el<?php echo $t_kec_list->RowCount ?>_t_kec_kdprop">
<span<?php echo $t_kec_list->kdprop->viewAttributes() ?>><?php echo $t_kec_list->kdprop->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_kec_list->kdkota->Visible) { // kdkota ?>
		<td data-name="kdkota" <?php echo $t_kec_list->kdkota->cellAttributes() ?>>
<span id="el<?php echo $t_kec_list->RowCount ?>_t_kec_kdkota">
<span<?php echo $t_kec_list->kdkota->viewAttributes() ?>><?php echo $t_kec_list->kdkota->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_kec_list->kec->Visible) { // kec ?>
		<td data-name="kec" <?php echo $t_kec_list->kec->cellAttributes() ?>>
<span id="el<?php echo $t_kec_list->RowCount ?>_t_kec_kec">
<span<?php echo $t_kec_list->kec->viewAttributes() ?>><?php echo $t_kec_list->kec->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_kec_list->ListOptions->render("body", "right", $t_kec_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_kec_list->isGridAdd())
		$t_kec_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_kec->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_kec_list->Recordset)
	$t_kec_list->Recordset->Close();
?>
<?php if (!$t_kec_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_kec_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_kec_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_kec_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_kec_list->TotalRecords == 0 && !$t_kec->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_kec_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_kec_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_kec_list->isExport()) { ?>
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
$t_kec_list->terminate();
?>