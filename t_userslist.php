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
$t_users_list = new t_users_list();

// Run the page
$t_users_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_users_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_users_list->isExport()) { ?>
<script>
var ft_userslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_userslist = currentForm = new ew.Form("ft_userslist", "list");
	ft_userslist.formKeyCountName = '<?php echo $t_users_list->FormKeyCountName ?>';
	loadjs.done("ft_userslist");
});
var ft_userslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_userslistsrch = currentSearchForm = new ew.Form("ft_userslistsrch");

	// Dynamic selection lists
	// Filters

	ft_userslistsrch.filterList = <?php echo $t_users_list->getFilterList() ?>;
	loadjs.done("ft_userslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_users_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_users_list->TotalRecords > 0 && $t_users_list->ExportOptions->visible()) { ?>
<?php $t_users_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_users_list->ImportOptions->visible()) { ?>
<?php $t_users_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_users_list->SearchOptions->visible()) { ?>
<?php $t_users_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_users_list->FilterOptions->visible()) { ?>
<?php $t_users_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_users_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_users_list->isExport() && !$t_users->CurrentAction) { ?>
<form name="ft_userslistsrch" id="ft_userslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_userslistsrch-search-panel" class="<?php echo $t_users_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_users">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $t_users_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($t_users_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($t_users_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $t_users_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($t_users_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($t_users_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($t_users_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($t_users_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_users_list->showPageHeader(); ?>
<?php
$t_users_list->showMessage();
?>
<?php if ($t_users_list->TotalRecords > 0 || $t_users->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_users_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_users">
<?php if (!$t_users_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_users_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_users_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_users_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_userslist" id="ft_userslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_users">
<div id="gmp_t_users" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_users_list->TotalRecords > 0 || $t_users_list->isGridEdit()) { ?>
<table id="tbl_t_userslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_users->RowType = ROWTYPE_HEADER;

// Render list options
$t_users_list->renderListOptions();

// Render list options (header, left)
$t_users_list->ListOptions->render("header", "left");
?>
<?php if ($t_users_list->username->Visible) { // username ?>
	<?php if ($t_users_list->SortUrl($t_users_list->username) == "") { ?>
		<th data-name="username" class="<?php echo $t_users_list->username->headerCellClass() ?>"><div id="elh_t_users_username" class="t_users_username"><div class="ew-table-header-caption"><?php echo $t_users_list->username->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="username" class="<?php echo $t_users_list->username->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_users_list->SortUrl($t_users_list->username) ?>', 1);"><div id="elh_t_users_username" class="t_users_username">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_users_list->username->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_users_list->username->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_users_list->username->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_users_list->pass->Visible) { // pass ?>
	<?php if ($t_users_list->SortUrl($t_users_list->pass) == "") { ?>
		<th data-name="pass" class="<?php echo $t_users_list->pass->headerCellClass() ?>"><div id="elh_t_users_pass" class="t_users_pass"><div class="ew-table-header-caption"><?php echo $t_users_list->pass->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pass" class="<?php echo $t_users_list->pass->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_users_list->SortUrl($t_users_list->pass) ?>', 1);"><div id="elh_t_users_pass" class="t_users_pass">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_users_list->pass->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_users_list->pass->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_users_list->pass->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_users_list->_userlevel->Visible) { // userlevel ?>
	<?php if ($t_users_list->SortUrl($t_users_list->_userlevel) == "") { ?>
		<th data-name="_userlevel" class="<?php echo $t_users_list->_userlevel->headerCellClass() ?>"><div id="elh_t_users__userlevel" class="t_users__userlevel"><div class="ew-table-header-caption"><?php echo $t_users_list->_userlevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_userlevel" class="<?php echo $t_users_list->_userlevel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_users_list->SortUrl($t_users_list->_userlevel) ?>', 1);"><div id="elh_t_users__userlevel" class="t_users__userlevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_users_list->_userlevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_users_list->_userlevel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_users_list->_userlevel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_users_list->aktif->Visible) { // aktif ?>
	<?php if ($t_users_list->SortUrl($t_users_list->aktif) == "") { ?>
		<th data-name="aktif" class="<?php echo $t_users_list->aktif->headerCellClass() ?>"><div id="elh_t_users_aktif" class="t_users_aktif"><div class="ew-table-header-caption"><?php echo $t_users_list->aktif->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="aktif" class="<?php echo $t_users_list->aktif->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_users_list->SortUrl($t_users_list->aktif) ?>', 1);"><div id="elh_t_users_aktif" class="t_users_aktif">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_users_list->aktif->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_users_list->aktif->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_users_list->aktif->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_users_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_users_list->ExportAll && $t_users_list->isExport()) {
	$t_users_list->StopRecord = $t_users_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_users_list->TotalRecords > $t_users_list->StartRecord + $t_users_list->DisplayRecords - 1)
		$t_users_list->StopRecord = $t_users_list->StartRecord + $t_users_list->DisplayRecords - 1;
	else
		$t_users_list->StopRecord = $t_users_list->TotalRecords;
}
$t_users_list->RecordCount = $t_users_list->StartRecord - 1;
if ($t_users_list->Recordset && !$t_users_list->Recordset->EOF) {
	$t_users_list->Recordset->moveFirst();
	$selectLimit = $t_users_list->UseSelectLimit;
	if (!$selectLimit && $t_users_list->StartRecord > 1)
		$t_users_list->Recordset->move($t_users_list->StartRecord - 1);
} elseif (!$t_users->AllowAddDeleteRow && $t_users_list->StopRecord == 0) {
	$t_users_list->StopRecord = $t_users->GridAddRowCount;
}

// Initialize aggregate
$t_users->RowType = ROWTYPE_AGGREGATEINIT;
$t_users->resetAttributes();
$t_users_list->renderRow();
while ($t_users_list->RecordCount < $t_users_list->StopRecord) {
	$t_users_list->RecordCount++;
	if ($t_users_list->RecordCount >= $t_users_list->StartRecord) {
		$t_users_list->RowCount++;

		// Set up key count
		$t_users_list->KeyCount = $t_users_list->RowIndex;

		// Init row class and style
		$t_users->resetAttributes();
		$t_users->CssClass = "";
		if ($t_users_list->isGridAdd()) {
		} else {
			$t_users_list->loadRowValues($t_users_list->Recordset); // Load row values
		}
		$t_users->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_users->RowAttrs->merge(["data-rowindex" => $t_users_list->RowCount, "id" => "r" . $t_users_list->RowCount . "_t_users", "data-rowtype" => $t_users->RowType]);

		// Render row
		$t_users_list->renderRow();

		// Render list options
		$t_users_list->renderListOptions();
?>
	<tr <?php echo $t_users->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_users_list->ListOptions->render("body", "left", $t_users_list->RowCount);
?>
	<?php if ($t_users_list->username->Visible) { // username ?>
		<td data-name="username" <?php echo $t_users_list->username->cellAttributes() ?>>
<span id="el<?php echo $t_users_list->RowCount ?>_t_users_username">
<span<?php echo $t_users_list->username->viewAttributes() ?>><?php echo $t_users_list->username->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_users_list->pass->Visible) { // pass ?>
		<td data-name="pass" <?php echo $t_users_list->pass->cellAttributes() ?>>
<span id="el<?php echo $t_users_list->RowCount ?>_t_users_pass">
<span<?php echo $t_users_list->pass->viewAttributes() ?>><?php echo $t_users_list->pass->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_users_list->_userlevel->Visible) { // userlevel ?>
		<td data-name="_userlevel" <?php echo $t_users_list->_userlevel->cellAttributes() ?>>
<span id="el<?php echo $t_users_list->RowCount ?>_t_users__userlevel">
<span<?php echo $t_users_list->_userlevel->viewAttributes() ?>><?php echo $t_users_list->_userlevel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_users_list->aktif->Visible) { // aktif ?>
		<td data-name="aktif" <?php echo $t_users_list->aktif->cellAttributes() ?>>
<span id="el<?php echo $t_users_list->RowCount ?>_t_users_aktif">
<span<?php echo $t_users_list->aktif->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_aktif" class="custom-control-input" value="<?php echo $t_users_list->aktif->getViewValue() ?>" disabled<?php if (ConvertToBool($t_users_list->aktif->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_aktif"></label></div></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_users_list->ListOptions->render("body", "right", $t_users_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_users_list->isGridAdd())
		$t_users_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_users->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_users_list->Recordset)
	$t_users_list->Recordset->Close();
?>
<?php if (!$t_users_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_users_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_users_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_users_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_users_list->TotalRecords == 0 && !$t_users->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_users_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_users_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_users_list->isExport()) { ?>
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
$t_users_list->terminate();
?>