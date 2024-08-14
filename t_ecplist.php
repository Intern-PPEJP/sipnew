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
$t_ecp_list = new t_ecp_list();

// Run the page
$t_ecp_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_ecp_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_ecp_list->isExport()) { ?>
<script>
var ft_ecplist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_ecplist = currentForm = new ew.Form("ft_ecplist", "list");
	ft_ecplist.formKeyCountName = '<?php echo $t_ecp_list->FormKeyCountName ?>';
	loadjs.done("ft_ecplist");
});
var ft_ecplistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_ecplistsrch = currentSearchForm = new ew.Form("ft_ecplistsrch");

	// Dynamic selection lists
	// Filters

	ft_ecplistsrch.filterList = <?php echo $t_ecp_list->getFilterList() ?>;
	loadjs.done("ft_ecplistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_ecp_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_ecp_list->TotalRecords > 0 && $t_ecp_list->ExportOptions->visible()) { ?>
<?php $t_ecp_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_ecp_list->ImportOptions->visible()) { ?>
<?php $t_ecp_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_ecp_list->SearchOptions->visible()) { ?>
<?php $t_ecp_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_ecp_list->FilterOptions->visible()) { ?>
<?php $t_ecp_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$t_ecp_list->isExport() || Config("EXPORT_MASTER_RECORD") && $t_ecp_list->isExport("print")) { ?>
<?php
if ($t_ecp_list->DbMasterFilter != "" && $t_ecp->getCurrentMasterTable() == "t_pcp") {
	if ($t_ecp_list->MasterRecordExists) {
		include_once "t_pcpmaster.php";
	}
}
?>
<?php } ?>
<?php
$t_ecp_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_ecp_list->isExport() && !$t_ecp->CurrentAction) { ?>
<form name="ft_ecplistsrch" id="ft_ecplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_ecplistsrch-search-panel" class="<?php echo $t_ecp_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_ecp">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $t_ecp_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($t_ecp_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($t_ecp_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $t_ecp_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($t_ecp_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($t_ecp_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($t_ecp_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($t_ecp_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_ecp_list->showPageHeader(); ?>
<?php
$t_ecp_list->showMessage();
?>
<?php if ($t_ecp_list->TotalRecords > 0 || $t_ecp->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_ecp_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_ecp">
<?php if (!$t_ecp_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_ecp_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_ecp_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_ecp_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_ecplist" id="ft_ecplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_ecp">
<?php if ($t_ecp->getCurrentMasterTable() == "t_pcp" && $t_ecp->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_pcp">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($t_ecp_list->Peserta_ID->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_t_ecp" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_ecp_list->TotalRecords > 0 || $t_ecp_list->isGridEdit()) { ?>
<table id="tbl_t_ecplist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_ecp->RowType = ROWTYPE_HEADER;

// Render list options
$t_ecp_list->renderListOptions();

// Render list options (header, left)
$t_ecp_list->ListOptions->render("header", "left");
?>
<?php if ($t_ecp_list->Daerah->Visible) { // Daerah ?>
	<?php if ($t_ecp_list->SortUrl($t_ecp_list->Daerah) == "") { ?>
		<th data-name="Daerah" class="<?php echo $t_ecp_list->Daerah->headerCellClass() ?>"><div id="elh_t_ecp_Daerah" class="t_ecp_Daerah"><div class="ew-table-header-caption"><?php echo $t_ecp_list->Daerah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Daerah" class="<?php echo $t_ecp_list->Daerah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_ecp_list->SortUrl($t_ecp_list->Daerah) ?>', 1);"><div id="elh_t_ecp_Daerah" class="t_ecp_Daerah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_ecp_list->Daerah->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_ecp_list->Daerah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_ecp_list->Daerah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_ecp_list->Produk->Visible) { // Produk ?>
	<?php if ($t_ecp_list->SortUrl($t_ecp_list->Produk) == "") { ?>
		<th data-name="Produk" class="<?php echo $t_ecp_list->Produk->headerCellClass() ?>"><div id="elh_t_ecp_Produk" class="t_ecp_Produk"><div class="ew-table-header-caption"><?php echo $t_ecp_list->Produk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Produk" class="<?php echo $t_ecp_list->Produk->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_ecp_list->SortUrl($t_ecp_list->Produk) ?>', 1);"><div id="elh_t_ecp_Produk" class="t_ecp_Produk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_ecp_list->Produk->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_ecp_list->Produk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_ecp_list->Produk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_ecp_list->Tgl_Bln_Ekspor->Visible) { // Tgl_Bln_Ekspor ?>
	<?php if ($t_ecp_list->SortUrl($t_ecp_list->Tgl_Bln_Ekspor) == "") { ?>
		<th data-name="Tgl_Bln_Ekspor" class="<?php echo $t_ecp_list->Tgl_Bln_Ekspor->headerCellClass() ?>"><div id="elh_t_ecp_Tgl_Bln_Ekspor" class="t_ecp_Tgl_Bln_Ekspor"><div class="ew-table-header-caption"><?php echo $t_ecp_list->Tgl_Bln_Ekspor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tgl_Bln_Ekspor" class="<?php echo $t_ecp_list->Tgl_Bln_Ekspor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_ecp_list->SortUrl($t_ecp_list->Tgl_Bln_Ekspor) ?>', 1);"><div id="elh_t_ecp_Tgl_Bln_Ekspor" class="t_ecp_Tgl_Bln_Ekspor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_ecp_list->Tgl_Bln_Ekspor->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_ecp_list->Tgl_Bln_Ekspor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_ecp_list->Tgl_Bln_Ekspor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_ecp_list->Tahun_Ekspor->Visible) { // Tahun_Ekspor ?>
	<?php if ($t_ecp_list->SortUrl($t_ecp_list->Tahun_Ekspor) == "") { ?>
		<th data-name="Tahun_Ekspor" class="<?php echo $t_ecp_list->Tahun_Ekspor->headerCellClass() ?>"><div id="elh_t_ecp_Tahun_Ekspor" class="t_ecp_Tahun_Ekspor"><div class="ew-table-header-caption"><?php echo $t_ecp_list->Tahun_Ekspor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tahun_Ekspor" class="<?php echo $t_ecp_list->Tahun_Ekspor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_ecp_list->SortUrl($t_ecp_list->Tahun_Ekspor) ?>', 1);"><div id="elh_t_ecp_Tahun_Ekspor" class="t_ecp_Tahun_Ekspor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_ecp_list->Tahun_Ekspor->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_ecp_list->Tahun_Ekspor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_ecp_list->Tahun_Ekspor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_ecp_list->Negara_Tujuan->Visible) { // Negara_Tujuan ?>
	<?php if ($t_ecp_list->SortUrl($t_ecp_list->Negara_Tujuan) == "") { ?>
		<th data-name="Negara_Tujuan" class="<?php echo $t_ecp_list->Negara_Tujuan->headerCellClass() ?>"><div id="elh_t_ecp_Negara_Tujuan" class="t_ecp_Negara_Tujuan"><div class="ew-table-header-caption"><?php echo $t_ecp_list->Negara_Tujuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Negara_Tujuan" class="<?php echo $t_ecp_list->Negara_Tujuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_ecp_list->SortUrl($t_ecp_list->Negara_Tujuan) ?>', 1);"><div id="elh_t_ecp_Negara_Tujuan" class="t_ecp_Negara_Tujuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_ecp_list->Negara_Tujuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_ecp_list->Negara_Tujuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_ecp_list->Negara_Tujuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_ecp_list->Nilai_Ekspor_USD->Visible) { // Nilai_Ekspor_USD ?>
	<?php if ($t_ecp_list->SortUrl($t_ecp_list->Nilai_Ekspor_USD) == "") { ?>
		<th data-name="Nilai_Ekspor_USD" class="<?php echo $t_ecp_list->Nilai_Ekspor_USD->headerCellClass() ?>"><div id="elh_t_ecp_Nilai_Ekspor_USD" class="t_ecp_Nilai_Ekspor_USD"><div class="ew-table-header-caption"><?php echo $t_ecp_list->Nilai_Ekspor_USD->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nilai_Ekspor_USD" class="<?php echo $t_ecp_list->Nilai_Ekspor_USD->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_ecp_list->SortUrl($t_ecp_list->Nilai_Ekspor_USD) ?>', 1);"><div id="elh_t_ecp_Nilai_Ekspor_USD" class="t_ecp_Nilai_Ekspor_USD">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_ecp_list->Nilai_Ekspor_USD->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_ecp_list->Nilai_Ekspor_USD->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_ecp_list->Nilai_Ekspor_USD->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_ecp_list->Nilai_Ekspor_Rupiah->Visible) { // Nilai_Ekspor_Rupiah ?>
	<?php if ($t_ecp_list->SortUrl($t_ecp_list->Nilai_Ekspor_Rupiah) == "") { ?>
		<th data-name="Nilai_Ekspor_Rupiah" class="<?php echo $t_ecp_list->Nilai_Ekspor_Rupiah->headerCellClass() ?>"><div id="elh_t_ecp_Nilai_Ekspor_Rupiah" class="t_ecp_Nilai_Ekspor_Rupiah"><div class="ew-table-header-caption"><?php echo $t_ecp_list->Nilai_Ekspor_Rupiah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nilai_Ekspor_Rupiah" class="<?php echo $t_ecp_list->Nilai_Ekspor_Rupiah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_ecp_list->SortUrl($t_ecp_list->Nilai_Ekspor_Rupiah) ?>', 1);"><div id="elh_t_ecp_Nilai_Ekspor_Rupiah" class="t_ecp_Nilai_Ekspor_Rupiah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_ecp_list->Nilai_Ekspor_Rupiah->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_ecp_list->Nilai_Ekspor_Rupiah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_ecp_list->Nilai_Ekspor_Rupiah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_ecp_list->Keterangan->Visible) { // Keterangan ?>
	<?php if ($t_ecp_list->SortUrl($t_ecp_list->Keterangan) == "") { ?>
		<th data-name="Keterangan" class="<?php echo $t_ecp_list->Keterangan->headerCellClass() ?>"><div id="elh_t_ecp_Keterangan" class="t_ecp_Keterangan"><div class="ew-table-header-caption"><?php echo $t_ecp_list->Keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Keterangan" class="<?php echo $t_ecp_list->Keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_ecp_list->SortUrl($t_ecp_list->Keterangan) ?>', 1);"><div id="elh_t_ecp_Keterangan" class="t_ecp_Keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_ecp_list->Keterangan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_ecp_list->Keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_ecp_list->Keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_ecp_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_ecp_list->ExportAll && $t_ecp_list->isExport()) {
	$t_ecp_list->StopRecord = $t_ecp_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_ecp_list->TotalRecords > $t_ecp_list->StartRecord + $t_ecp_list->DisplayRecords - 1)
		$t_ecp_list->StopRecord = $t_ecp_list->StartRecord + $t_ecp_list->DisplayRecords - 1;
	else
		$t_ecp_list->StopRecord = $t_ecp_list->TotalRecords;
}
$t_ecp_list->RecordCount = $t_ecp_list->StartRecord - 1;
if ($t_ecp_list->Recordset && !$t_ecp_list->Recordset->EOF) {
	$t_ecp_list->Recordset->moveFirst();
	$selectLimit = $t_ecp_list->UseSelectLimit;
	if (!$selectLimit && $t_ecp_list->StartRecord > 1)
		$t_ecp_list->Recordset->move($t_ecp_list->StartRecord - 1);
} elseif (!$t_ecp->AllowAddDeleteRow && $t_ecp_list->StopRecord == 0) {
	$t_ecp_list->StopRecord = $t_ecp->GridAddRowCount;
}

// Initialize aggregate
$t_ecp->RowType = ROWTYPE_AGGREGATEINIT;
$t_ecp->resetAttributes();
$t_ecp_list->renderRow();
while ($t_ecp_list->RecordCount < $t_ecp_list->StopRecord) {
	$t_ecp_list->RecordCount++;
	if ($t_ecp_list->RecordCount >= $t_ecp_list->StartRecord) {
		$t_ecp_list->RowCount++;

		// Set up key count
		$t_ecp_list->KeyCount = $t_ecp_list->RowIndex;

		// Init row class and style
		$t_ecp->resetAttributes();
		$t_ecp->CssClass = "";
		if ($t_ecp_list->isGridAdd()) {
		} else {
			$t_ecp_list->loadRowValues($t_ecp_list->Recordset); // Load row values
		}
		$t_ecp->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_ecp->RowAttrs->merge(["data-rowindex" => $t_ecp_list->RowCount, "id" => "r" . $t_ecp_list->RowCount . "_t_ecp", "data-rowtype" => $t_ecp->RowType]);

		// Render row
		$t_ecp_list->renderRow();

		// Render list options
		$t_ecp_list->renderListOptions();
?>
	<tr <?php echo $t_ecp->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_ecp_list->ListOptions->render("body", "left", $t_ecp_list->RowCount);
?>
	<?php if ($t_ecp_list->Daerah->Visible) { // Daerah ?>
		<td data-name="Daerah" <?php echo $t_ecp_list->Daerah->cellAttributes() ?>>
<span id="el<?php echo $t_ecp_list->RowCount ?>_t_ecp_Daerah">
<span<?php echo $t_ecp_list->Daerah->viewAttributes() ?>><?php echo $t_ecp_list->Daerah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_ecp_list->Produk->Visible) { // Produk ?>
		<td data-name="Produk" <?php echo $t_ecp_list->Produk->cellAttributes() ?>>
<span id="el<?php echo $t_ecp_list->RowCount ?>_t_ecp_Produk">
<span<?php echo $t_ecp_list->Produk->viewAttributes() ?>><?php echo $t_ecp_list->Produk->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_ecp_list->Tgl_Bln_Ekspor->Visible) { // Tgl_Bln_Ekspor ?>
		<td data-name="Tgl_Bln_Ekspor" <?php echo $t_ecp_list->Tgl_Bln_Ekspor->cellAttributes() ?>>
<span id="el<?php echo $t_ecp_list->RowCount ?>_t_ecp_Tgl_Bln_Ekspor">
<span<?php echo $t_ecp_list->Tgl_Bln_Ekspor->viewAttributes() ?>><?php echo $t_ecp_list->Tgl_Bln_Ekspor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_ecp_list->Tahun_Ekspor->Visible) { // Tahun_Ekspor ?>
		<td data-name="Tahun_Ekspor" <?php echo $t_ecp_list->Tahun_Ekspor->cellAttributes() ?>>
<span id="el<?php echo $t_ecp_list->RowCount ?>_t_ecp_Tahun_Ekspor">
<span<?php echo $t_ecp_list->Tahun_Ekspor->viewAttributes() ?>><?php echo $t_ecp_list->Tahun_Ekspor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_ecp_list->Negara_Tujuan->Visible) { // Negara_Tujuan ?>
		<td data-name="Negara_Tujuan" <?php echo $t_ecp_list->Negara_Tujuan->cellAttributes() ?>>
<span id="el<?php echo $t_ecp_list->RowCount ?>_t_ecp_Negara_Tujuan">
<span<?php echo $t_ecp_list->Negara_Tujuan->viewAttributes() ?>><?php echo $t_ecp_list->Negara_Tujuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_ecp_list->Nilai_Ekspor_USD->Visible) { // Nilai_Ekspor_USD ?>
		<td data-name="Nilai_Ekspor_USD" <?php echo $t_ecp_list->Nilai_Ekspor_USD->cellAttributes() ?>>
<span id="el<?php echo $t_ecp_list->RowCount ?>_t_ecp_Nilai_Ekspor_USD">
<span<?php echo $t_ecp_list->Nilai_Ekspor_USD->viewAttributes() ?>><?php echo $t_ecp_list->Nilai_Ekspor_USD->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_ecp_list->Nilai_Ekspor_Rupiah->Visible) { // Nilai_Ekspor_Rupiah ?>
		<td data-name="Nilai_Ekspor_Rupiah" <?php echo $t_ecp_list->Nilai_Ekspor_Rupiah->cellAttributes() ?>>
<span id="el<?php echo $t_ecp_list->RowCount ?>_t_ecp_Nilai_Ekspor_Rupiah">
<span<?php echo $t_ecp_list->Nilai_Ekspor_Rupiah->viewAttributes() ?>><?php echo $t_ecp_list->Nilai_Ekspor_Rupiah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_ecp_list->Keterangan->Visible) { // Keterangan ?>
		<td data-name="Keterangan" <?php echo $t_ecp_list->Keterangan->cellAttributes() ?>>
<span id="el<?php echo $t_ecp_list->RowCount ?>_t_ecp_Keterangan">
<span<?php echo $t_ecp_list->Keterangan->viewAttributes() ?>><?php echo $t_ecp_list->Keterangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_ecp_list->ListOptions->render("body", "right", $t_ecp_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_ecp_list->isGridAdd())
		$t_ecp_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_ecp->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_ecp_list->Recordset)
	$t_ecp_list->Recordset->Close();
?>
<?php if (!$t_ecp_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_ecp_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_ecp_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_ecp_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_ecp_list->TotalRecords == 0 && !$t_ecp->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_ecp_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_ecp_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_ecp_list->isExport()) { ?>
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
$t_ecp_list->terminate();
?>