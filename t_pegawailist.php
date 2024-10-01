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
$t_pegawai_list = new t_pegawai_list();

// Run the page
$t_pegawai_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pegawai_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_pegawai_list->isExport()) { ?>

<script>
var ft_pegawailist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_pegawailist = currentForm = new ew.Form("ft_pegawailist", "list");
	ft_pegawailist.formKeyCountName = '<?php echo $t_pegawai_list->FormKeyCountName ?>';
	loadjs.done("ft_pegawailist");
});
var ft_pegawailistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_pegawailistsrch = currentSearchForm = new ew.Form("ft_pegawailistsrch");

	// Validate function for search
	ft_pegawailistsrch.validate = function(fobj) {
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
	ft_pegawailistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_pegawailistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_pegawailistsrch.lists["x_bagian"] = <?php echo $t_pegawai_list->bagian->Lookup->toClientList($t_pegawai_list) ?>;
	ft_pegawailistsrch.lists["x_bagian"].options = <?php echo JsonEncode($t_pegawai_list->bagian->lookupOptions()) ?>;

	// Filters
	ft_pegawailistsrch.filterList = <?php echo $t_pegawai_list->getFilterList() ?>;
	loadjs.done("ft_pegawailistsrch");
});
</script>

<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>

<?php if (!$t_pegawai_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_pegawai_list->TotalRecords > 0 && $t_pegawai_list->ExportOptions->visible()) { ?>
<?php $t_pegawai_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_pegawai_list->ImportOptions->visible()) { ?>
<?php $t_pegawai_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_pegawai_list->SearchOptions->visible()) { ?>
<?php $t_pegawai_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_pegawai_list->FilterOptions->visible()) { ?>
<?php $t_pegawai_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_pegawai_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_pegawai_list->isExport() && !$t_pegawai->CurrentAction) { ?>
<form name="ft_pegawailistsrch" id="ft_pegawailistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_pegawailistsrch-search-panel" class="<?php echo $t_pegawai_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_pegawai">
	<div class="ew-extended-search">
<?php

// Render search row
$t_pegawai->RowType = ROWTYPE_SEARCH;
$t_pegawai->resetAttributes();
$t_pegawai_list->renderRow();
?>

<style>
	.ew-search-caption {
    width: 60px; /* Atur lebar label agar seragam */
    text-align: left !important;
    padding-right: 10px;
	justify-content: left !important;
	text-transform: uppercase;
}

</style>

<?php if ($t_pegawai_list->bagian->Visible) { // bagian ?>
	<?php
		$t_pegawai_list->SearchColumnCount++;
		if (($t_pegawai_list->SearchColumnCount - 1) % $t_pegawai_list->SearchFieldsPerRow == 0) {
			$t_pegawai_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_pegawai_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_bagian" class="ew-cell form-group">
		<label for="x_bagian" class="ew-search-caption ew-label"><?php echo $t_pegawai_list->bagian->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_bagian" id="z_bagian" value="=">
</span>
		<span id="el_t_pegawai_bagian" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pegawai" data-field="x_bagian" data-value-separator="<?php echo $t_pegawai_list->bagian->displayValueSeparatorAttribute() ?>" id="x_bagian" name="x_bagian"<?php echo $t_pegawai_list->bagian->editAttributes() ?>>
			<?php echo $t_pegawai_list->bagian->selectOptionListHtml("x_bagian") ?>
		</select>
</div>
<?php echo $t_pegawai_list->bagian->Lookup->getParamTag($t_pegawai_list, "p_x_bagian") ?>
</span>
	</div>
	<?php if ($t_pegawai_list->SearchColumnCount % $t_pegawai_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($t_pegawai_list->SearchColumnCount % $t_pegawai_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $t_pegawai_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($t_pegawai_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($t_pegawai_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $t_pegawai_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($t_pegawai_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($t_pegawai_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($t_pegawai_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($t_pegawai_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_pegawai_list->showPageHeader(); ?>
<?php
$t_pegawai_list->showMessage();
?>
<?php if ($t_pegawai_list->TotalRecords > 0 || $t_pegawai->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_pegawai_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_pegawai">
<?php if (!$t_pegawai_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_pegawai_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_pegawai_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_pegawai_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_pegawailist" id="ft_pegawailist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_pegawai">
<div id="gmp_t_pegawai" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_pegawai_list->TotalRecords > 0 || $t_pegawai_list->isGridEdit()) { ?>
<table id="tbl_t_pegawailist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_pegawai->RowType = ROWTYPE_HEADER;

// Render list options
$t_pegawai_list->renderListOptions();

// Render list options (header, left)
$t_pegawai_list->ListOptions->render("header", "left");
?>
<?php if ($t_pegawai_list->nip->Visible) { // nip ?>
	<?php if ($t_pegawai_list->SortUrl($t_pegawai_list->nip) == "") { ?>
		<th data-name="nip" class="<?php echo $t_pegawai_list->nip->headerCellClass() ?>"><div id="elh_t_pegawai_nip" class="t_pegawai_nip"><div class="ew-table-header-caption"><?php echo $t_pegawai_list->nip->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nip" class="<?php echo $t_pegawai_list->nip->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pegawai_list->SortUrl($t_pegawai_list->nip) ?>', 1);"><div id="elh_t_pegawai_nip" class="t_pegawai_nip">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pegawai_list->nip->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_pegawai_list->nip->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pegawai_list->nip->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pegawai_list->nama->Visible) { // nama ?>
	<?php if ($t_pegawai_list->SortUrl($t_pegawai_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $t_pegawai_list->nama->headerCellClass() ?>"><div id="elh_t_pegawai_nama" class="t_pegawai_nama"><div class="ew-table-header-caption"><?php echo $t_pegawai_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $t_pegawai_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pegawai_list->SortUrl($t_pegawai_list->nama) ?>', 1);"><div id="elh_t_pegawai_nama" class="t_pegawai_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pegawai_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_pegawai_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pegawai_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pegawai_list->bagian->Visible) { // bagian ?>
	<?php if ($t_pegawai_list->SortUrl($t_pegawai_list->bagian) == "") { ?>
		<th data-name="bagian" class="<?php echo $t_pegawai_list->bagian->headerCellClass() ?>"><div id="elh_t_pegawai_bagian" class="t_pegawai_bagian"><div class="ew-table-header-caption"><?php echo $t_pegawai_list->bagian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bagian" class="<?php echo $t_pegawai_list->bagian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pegawai_list->SortUrl($t_pegawai_list->bagian) ?>', 1);"><div id="elh_t_pegawai_bagian" class="t_pegawai_bagian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pegawai_list->bagian->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pegawai_list->bagian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pegawai_list->bagian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pegawai_list->aktif->Visible) { // aktif ?>
	<?php if ($t_pegawai_list->SortUrl($t_pegawai_list->aktif) == "") { ?>
		<th data-name="aktif" class="<?php echo $t_pegawai_list->aktif->headerCellClass() ?>"><div id="elh_t_pegawai_aktif" class="t_pegawai_aktif"><div class="ew-table-header-caption"><?php echo $t_pegawai_list->aktif->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="aktif" class="<?php echo $t_pegawai_list->aktif->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pegawai_list->SortUrl($t_pegawai_list->aktif) ?>', 1);"><div id="elh_t_pegawai_aktif" class="t_pegawai_aktif">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pegawai_list->aktif->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pegawai_list->aktif->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pegawai_list->aktif->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_pegawai_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_pegawai_list->ExportAll && $t_pegawai_list->isExport()) {
	$t_pegawai_list->StopRecord = $t_pegawai_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_pegawai_list->TotalRecords > $t_pegawai_list->StartRecord + $t_pegawai_list->DisplayRecords - 1)
		$t_pegawai_list->StopRecord = $t_pegawai_list->StartRecord + $t_pegawai_list->DisplayRecords - 1;
	else
		$t_pegawai_list->StopRecord = $t_pegawai_list->TotalRecords;
}
$t_pegawai_list->RecordCount = $t_pegawai_list->StartRecord - 1;
if ($t_pegawai_list->Recordset && !$t_pegawai_list->Recordset->EOF) {
	$t_pegawai_list->Recordset->moveFirst();
	$selectLimit = $t_pegawai_list->UseSelectLimit;
	if (!$selectLimit && $t_pegawai_list->StartRecord > 1)
		$t_pegawai_list->Recordset->move($t_pegawai_list->StartRecord - 1);
} elseif (!$t_pegawai->AllowAddDeleteRow && $t_pegawai_list->StopRecord == 0) {
	$t_pegawai_list->StopRecord = $t_pegawai->GridAddRowCount;
}

// Initialize aggregate
$t_pegawai->RowType = ROWTYPE_AGGREGATEINIT;
$t_pegawai->resetAttributes();
$t_pegawai_list->renderRow();
while ($t_pegawai_list->RecordCount < $t_pegawai_list->StopRecord) {
	$t_pegawai_list->RecordCount++;
	if ($t_pegawai_list->RecordCount >= $t_pegawai_list->StartRecord) {
		$t_pegawai_list->RowCount++;

		// Set up key count
		$t_pegawai_list->KeyCount = $t_pegawai_list->RowIndex;

		// Init row class and style
		$t_pegawai->resetAttributes();
		$t_pegawai->CssClass = "";
		if ($t_pegawai_list->isGridAdd()) {
		} else {
			$t_pegawai_list->loadRowValues($t_pegawai_list->Recordset); // Load row values
		}
		$t_pegawai->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_pegawai->RowAttrs->merge(["data-rowindex" => $t_pegawai_list->RowCount, "id" => "r" . $t_pegawai_list->RowCount . "_t_pegawai", "data-rowtype" => $t_pegawai->RowType]);

		// Render row
		$t_pegawai_list->renderRow();

		// Render list options
		$t_pegawai_list->renderListOptions();
?>
	<tr <?php echo $t_pegawai->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_pegawai_list->ListOptions->render("body", "left", $t_pegawai_list->RowCount);
?>
	<?php if ($t_pegawai_list->nip->Visible) { // nip ?>
		<td data-name="nip" <?php echo $t_pegawai_list->nip->cellAttributes() ?>>
<span id="el<?php echo $t_pegawai_list->RowCount ?>_t_pegawai_nip">
<span<?php echo $t_pegawai_list->nip->viewAttributes() ?>><?php echo $t_pegawai_list->nip->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pegawai_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $t_pegawai_list->nama->cellAttributes() ?>>
<span id="el<?php echo $t_pegawai_list->RowCount ?>_t_pegawai_nama">
<span<?php echo $t_pegawai_list->nama->viewAttributes() ?>><?php echo $t_pegawai_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pegawai_list->bagian->Visible) { // bagian ?>
		<td data-name="bagian" <?php echo $t_pegawai_list->bagian->cellAttributes() ?>>
<span id="el<?php echo $t_pegawai_list->RowCount ?>_t_pegawai_bagian">
<span<?php echo $t_pegawai_list->bagian->viewAttributes() ?>><?php echo $t_pegawai_list->bagian->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pegawai_list->aktif->Visible) { // aktif ?>
		<td data-name="aktif" <?php echo $t_pegawai_list->aktif->cellAttributes() ?>>
<span id="el<?php echo $t_pegawai_list->RowCount ?>_t_pegawai_aktif">
<span<?php echo $t_pegawai_list->aktif->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_aktif" class="custom-control-input" value="<?php echo $t_pegawai_list->aktif->getViewValue() ?>" disabled<?php if (ConvertToBool($t_pegawai_list->aktif->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_aktif"></label></div></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_pegawai_list->ListOptions->render("body", "right", $t_pegawai_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_pegawai_list->isGridAdd())
		$t_pegawai_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_pegawai->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_pegawai_list->Recordset)
	$t_pegawai_list->Recordset->Close();
?>
<?php if (!$t_pegawai_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_pegawai_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_pegawai_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_pegawai_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_pegawai_list->TotalRecords == 0 && !$t_pegawai->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_pegawai_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_pegawai_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_pegawai_list->isExport()) { ?>
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
$t_pegawai_list->terminate();
?>