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
$t_userlevelpermissions_list = new t_userlevelpermissions_list();

// Run the page
$t_userlevelpermissions_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_userlevelpermissions_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_userlevelpermissions_list->isExport()) { ?>
<script>
var ft_userlevelpermissionslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_userlevelpermissionslist = currentForm = new ew.Form("ft_userlevelpermissionslist", "list");
	ft_userlevelpermissionslist.formKeyCountName = '<?php echo $t_userlevelpermissions_list->FormKeyCountName ?>';
	loadjs.done("ft_userlevelpermissionslist");
});
var ft_userlevelpermissionslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_userlevelpermissionslistsrch = currentSearchForm = new ew.Form("ft_userlevelpermissionslistsrch");

	// Dynamic selection lists
	// Filters

	ft_userlevelpermissionslistsrch.filterList = <?php echo $t_userlevelpermissions_list->getFilterList() ?>;
	loadjs.done("ft_userlevelpermissionslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_userlevelpermissions_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_userlevelpermissions_list->TotalRecords > 0 && $t_userlevelpermissions_list->ExportOptions->visible()) { ?>
<?php $t_userlevelpermissions_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_userlevelpermissions_list->ImportOptions->visible()) { ?>
<?php $t_userlevelpermissions_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_userlevelpermissions_list->SearchOptions->visible()) { ?>
<?php $t_userlevelpermissions_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_userlevelpermissions_list->FilterOptions->visible()) { ?>
<?php $t_userlevelpermissions_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_userlevelpermissions_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_userlevelpermissions_list->isExport() && !$t_userlevelpermissions->CurrentAction) { ?>
<form name="ft_userlevelpermissionslistsrch" id="ft_userlevelpermissionslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_userlevelpermissionslistsrch-search-panel" class="<?php echo $t_userlevelpermissions_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_userlevelpermissions">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $t_userlevelpermissions_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($t_userlevelpermissions_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($t_userlevelpermissions_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $t_userlevelpermissions_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($t_userlevelpermissions_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($t_userlevelpermissions_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($t_userlevelpermissions_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($t_userlevelpermissions_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_userlevelpermissions_list->showPageHeader(); ?>
<?php
$t_userlevelpermissions_list->showMessage();
?>
<?php if ($t_userlevelpermissions_list->TotalRecords > 0 || $t_userlevelpermissions->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_userlevelpermissions_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_userlevelpermissions">
<?php if (!$t_userlevelpermissions_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_userlevelpermissions_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_userlevelpermissions_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_userlevelpermissions_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_userlevelpermissionslist" id="ft_userlevelpermissionslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_userlevelpermissions">
<div id="gmp_t_userlevelpermissions" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_userlevelpermissions_list->TotalRecords > 0 || $t_userlevelpermissions_list->isGridEdit()) { ?>
<table id="tbl_t_userlevelpermissionslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_userlevelpermissions->RowType = ROWTYPE_HEADER;

// Render list options
$t_userlevelpermissions_list->renderListOptions();

// Render list options (header, left)
$t_userlevelpermissions_list->ListOptions->render("header", "left");
?>
<?php if ($t_userlevelpermissions_list->user_level_id->Visible) { // user_level_id ?>
	<?php if ($t_userlevelpermissions_list->SortUrl($t_userlevelpermissions_list->user_level_id) == "") { ?>
		<th data-name="user_level_id" class="<?php echo $t_userlevelpermissions_list->user_level_id->headerCellClass() ?>"><div id="elh_t_userlevelpermissions_user_level_id" class="t_userlevelpermissions_user_level_id"><div class="ew-table-header-caption"><?php echo $t_userlevelpermissions_list->user_level_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_level_id" class="<?php echo $t_userlevelpermissions_list->user_level_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_userlevelpermissions_list->SortUrl($t_userlevelpermissions_list->user_level_id) ?>', 1);"><div id="elh_t_userlevelpermissions_user_level_id" class="t_userlevelpermissions_user_level_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_userlevelpermissions_list->user_level_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_userlevelpermissions_list->user_level_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_userlevelpermissions_list->user_level_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_userlevelpermissions_list->table_name->Visible) { // table_name ?>
	<?php if ($t_userlevelpermissions_list->SortUrl($t_userlevelpermissions_list->table_name) == "") { ?>
		<th data-name="table_name" class="<?php echo $t_userlevelpermissions_list->table_name->headerCellClass() ?>"><div id="elh_t_userlevelpermissions_table_name" class="t_userlevelpermissions_table_name"><div class="ew-table-header-caption"><?php echo $t_userlevelpermissions_list->table_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="table_name" class="<?php echo $t_userlevelpermissions_list->table_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_userlevelpermissions_list->SortUrl($t_userlevelpermissions_list->table_name) ?>', 1);"><div id="elh_t_userlevelpermissions_table_name" class="t_userlevelpermissions_table_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_userlevelpermissions_list->table_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_userlevelpermissions_list->table_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_userlevelpermissions_list->table_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_userlevelpermissions_list->permission->Visible) { // permission ?>
	<?php if ($t_userlevelpermissions_list->SortUrl($t_userlevelpermissions_list->permission) == "") { ?>
		<th data-name="permission" class="<?php echo $t_userlevelpermissions_list->permission->headerCellClass() ?>"><div id="elh_t_userlevelpermissions_permission" class="t_userlevelpermissions_permission"><div class="ew-table-header-caption"><?php echo $t_userlevelpermissions_list->permission->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="permission" class="<?php echo $t_userlevelpermissions_list->permission->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_userlevelpermissions_list->SortUrl($t_userlevelpermissions_list->permission) ?>', 1);"><div id="elh_t_userlevelpermissions_permission" class="t_userlevelpermissions_permission">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_userlevelpermissions_list->permission->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_userlevelpermissions_list->permission->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_userlevelpermissions_list->permission->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_userlevelpermissions_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_userlevelpermissions_list->ExportAll && $t_userlevelpermissions_list->isExport()) {
	$t_userlevelpermissions_list->StopRecord = $t_userlevelpermissions_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_userlevelpermissions_list->TotalRecords > $t_userlevelpermissions_list->StartRecord + $t_userlevelpermissions_list->DisplayRecords - 1)
		$t_userlevelpermissions_list->StopRecord = $t_userlevelpermissions_list->StartRecord + $t_userlevelpermissions_list->DisplayRecords - 1;
	else
		$t_userlevelpermissions_list->StopRecord = $t_userlevelpermissions_list->TotalRecords;
}
$t_userlevelpermissions_list->RecordCount = $t_userlevelpermissions_list->StartRecord - 1;
if ($t_userlevelpermissions_list->Recordset && !$t_userlevelpermissions_list->Recordset->EOF) {
	$t_userlevelpermissions_list->Recordset->moveFirst();
	$selectLimit = $t_userlevelpermissions_list->UseSelectLimit;
	if (!$selectLimit && $t_userlevelpermissions_list->StartRecord > 1)
		$t_userlevelpermissions_list->Recordset->move($t_userlevelpermissions_list->StartRecord - 1);
} elseif (!$t_userlevelpermissions->AllowAddDeleteRow && $t_userlevelpermissions_list->StopRecord == 0) {
	$t_userlevelpermissions_list->StopRecord = $t_userlevelpermissions->GridAddRowCount;
}

// Initialize aggregate
$t_userlevelpermissions->RowType = ROWTYPE_AGGREGATEINIT;
$t_userlevelpermissions->resetAttributes();
$t_userlevelpermissions_list->renderRow();
while ($t_userlevelpermissions_list->RecordCount < $t_userlevelpermissions_list->StopRecord) {
	$t_userlevelpermissions_list->RecordCount++;
	if ($t_userlevelpermissions_list->RecordCount >= $t_userlevelpermissions_list->StartRecord) {
		$t_userlevelpermissions_list->RowCount++;

		// Set up key count
		$t_userlevelpermissions_list->KeyCount = $t_userlevelpermissions_list->RowIndex;

		// Init row class and style
		$t_userlevelpermissions->resetAttributes();
		$t_userlevelpermissions->CssClass = "";
		if ($t_userlevelpermissions_list->isGridAdd()) {
		} else {
			$t_userlevelpermissions_list->loadRowValues($t_userlevelpermissions_list->Recordset); // Load row values
		}
		$t_userlevelpermissions->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_userlevelpermissions->RowAttrs->merge(["data-rowindex" => $t_userlevelpermissions_list->RowCount, "id" => "r" . $t_userlevelpermissions_list->RowCount . "_t_userlevelpermissions", "data-rowtype" => $t_userlevelpermissions->RowType]);

		// Render row
		$t_userlevelpermissions_list->renderRow();

		// Render list options
		$t_userlevelpermissions_list->renderListOptions();
?>
	<tr <?php echo $t_userlevelpermissions->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_userlevelpermissions_list->ListOptions->render("body", "left", $t_userlevelpermissions_list->RowCount);
?>
	<?php if ($t_userlevelpermissions_list->user_level_id->Visible) { // user_level_id ?>
		<td data-name="user_level_id" <?php echo $t_userlevelpermissions_list->user_level_id->cellAttributes() ?>>
<span id="el<?php echo $t_userlevelpermissions_list->RowCount ?>_t_userlevelpermissions_user_level_id">
<span<?php echo $t_userlevelpermissions_list->user_level_id->viewAttributes() ?>><?php echo $t_userlevelpermissions_list->user_level_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_userlevelpermissions_list->table_name->Visible) { // table_name ?>
		<td data-name="table_name" <?php echo $t_userlevelpermissions_list->table_name->cellAttributes() ?>>
<span id="el<?php echo $t_userlevelpermissions_list->RowCount ?>_t_userlevelpermissions_table_name">
<span<?php echo $t_userlevelpermissions_list->table_name->viewAttributes() ?>><?php echo $t_userlevelpermissions_list->table_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_userlevelpermissions_list->permission->Visible) { // permission ?>
		<td data-name="permission" <?php echo $t_userlevelpermissions_list->permission->cellAttributes() ?>>
<span id="el<?php echo $t_userlevelpermissions_list->RowCount ?>_t_userlevelpermissions_permission">
<span<?php echo $t_userlevelpermissions_list->permission->viewAttributes() ?>><?php echo $t_userlevelpermissions_list->permission->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_userlevelpermissions_list->ListOptions->render("body", "right", $t_userlevelpermissions_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_userlevelpermissions_list->isGridAdd())
		$t_userlevelpermissions_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_userlevelpermissions->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_userlevelpermissions_list->Recordset)
	$t_userlevelpermissions_list->Recordset->Close();
?>
<?php if (!$t_userlevelpermissions_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_userlevelpermissions_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_userlevelpermissions_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_userlevelpermissions_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_userlevelpermissions_list->TotalRecords == 0 && !$t_userlevelpermissions->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_userlevelpermissions_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_userlevelpermissions_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_userlevelpermissions_list->isExport()) { ?>
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
$t_userlevelpermissions_list->terminate();
?>