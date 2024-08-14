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
$t_pcp_list = new t_pcp_list();

// Run the page
$t_pcp_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pcp_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_pcp_list->isExport()) { ?>
<script>
var ft_pcplist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_pcplist = currentForm = new ew.Form("ft_pcplist", "list");
	ft_pcplist.formKeyCountName = '<?php echo $t_pcp_list->FormKeyCountName ?>';
	loadjs.done("ft_pcplist");
});
var ft_pcplistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_pcplistsrch = currentSearchForm = new ew.Form("ft_pcplistsrch");

	// Dynamic selection lists
	// Filters

	ft_pcplistsrch.filterList = <?php echo $t_pcp_list->getFilterList() ?>;
	loadjs.done("ft_pcplistsrch");
});
</script>
<script>
ew.ready("head", "js/ewfixedheadertable.js", "fixedheadertable");
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_pcp_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_pcp_list->TotalRecords > 0 && $t_pcp_list->ExportOptions->visible()) { ?>
<?php $t_pcp_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_pcp_list->ImportOptions->visible()) { ?>
<?php $t_pcp_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_pcp_list->SearchOptions->visible()) { ?>
<?php $t_pcp_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_pcp_list->FilterOptions->visible()) { ?>
<?php $t_pcp_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$t_pcp_list->isExport() || Config("EXPORT_MASTER_RECORD") && $t_pcp_list->isExport("print")) { ?>
<?php
if ($t_pcp_list->DbMasterFilter != "" && $t_pcp->getCurrentMasterTable() == "excp") {
	if ($t_pcp_list->MasterRecordExists) {
		include_once "excpmaster.php";
	}
}
?>
<?php } ?>
<?php
$t_pcp_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_pcp_list->isExport() && !$t_pcp->CurrentAction) { ?>
<form name="ft_pcplistsrch" id="ft_pcplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_pcplistsrch-search-panel" class="<?php echo $t_pcp_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_pcp">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $t_pcp_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($t_pcp_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($t_pcp_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $t_pcp_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($t_pcp_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($t_pcp_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($t_pcp_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($t_pcp_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_pcp_list->showPageHeader(); ?>
<?php
$t_pcp_list->showMessage();
?>
<?php if ($t_pcp_list->TotalRecords > 0 || $t_pcp->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_pcp_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_pcp">
<?php if (!$t_pcp_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_pcp_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_pcp_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_pcp_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_pcplist" id="ft_pcplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_pcp">
<?php if ($t_pcp->getCurrentMasterTable() == "excp" && $t_pcp->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="excp">
<input type="hidden" name="fk_rkid" value="<?php echo HtmlEncode($t_pcp_list->rkid->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_t_pcp" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_pcp_list->TotalRecords > 0 || $t_pcp_list->isGridEdit()) { ?>
<table id="tbl_t_pcplist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_pcp->RowType = ROWTYPE_HEADER;

// Render list options
$t_pcp_list->renderListOptions();

// Render list options (header, left)
$t_pcp_list->ListOptions->render("header", "left");
?>
<?php if ($t_pcp_list->nama_peserta->Visible) { // nama_peserta ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->nama_peserta) == "") { ?>
		<th data-name="nama_peserta" class="<?php echo $t_pcp_list->nama_peserta->headerCellClass() ?>"><div id="elh_t_pcp_nama_peserta" class="t_pcp_nama_peserta"><div class="ew-table-header-caption"><?php echo $t_pcp_list->nama_peserta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_peserta" class="<?php echo $t_pcp_list->nama_peserta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->nama_peserta) ?>', 1);"><div id="elh_t_pcp_nama_peserta" class="t_pcp_nama_peserta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->nama_peserta->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->nama_peserta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->nama_peserta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->email_add->Visible) { // email_add ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->email_add) == "") { ?>
		<th data-name="email_add" class="<?php echo $t_pcp_list->email_add->headerCellClass() ?>"><div id="elh_t_pcp_email_add" class="t_pcp_email_add"><div class="ew-table-header-caption"><?php echo $t_pcp_list->email_add->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="email_add" class="<?php echo $t_pcp_list->email_add->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->email_add) ?>', 1);"><div id="elh_t_pcp_email_add" class="t_pcp_email_add">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->email_add->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->email_add->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->email_add->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->handphone->Visible) { // handphone ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->handphone) == "") { ?>
		<th data-name="handphone" class="<?php echo $t_pcp_list->handphone->headerCellClass() ?>"><div id="elh_t_pcp_handphone" class="t_pcp_handphone"><div class="ew-table-header-caption"><?php echo $t_pcp_list->handphone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="handphone" class="<?php echo $t_pcp_list->handphone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->handphone) ?>', 1);"><div id="elh_t_pcp_handphone" class="t_pcp_handphone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->handphone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->handphone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->handphone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->namap->Visible) { // namap ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->namap) == "") { ?>
		<th data-name="namap" class="<?php echo $t_pcp_list->namap->headerCellClass() ?>"><div id="elh_t_pcp_namap" class="t_pcp_namap"><div class="ew-table-header-caption"><?php echo $t_pcp_list->namap->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="namap" class="<?php echo $t_pcp_list->namap->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->namap) ?>', 1);"><div id="elh_t_pcp_namap" class="t_pcp_namap">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->namap->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->namap->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->namap->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->kategori_produk->Visible) { // kategori_produk ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->kategori_produk) == "") { ?>
		<th data-name="kategori_produk" class="<?php echo $t_pcp_list->kategori_produk->headerCellClass() ?>"><div id="elh_t_pcp_kategori_produk" class="t_pcp_kategori_produk"><div class="ew-table-header-caption"><?php echo $t_pcp_list->kategori_produk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kategori_produk" class="<?php echo $t_pcp_list->kategori_produk->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->kategori_produk) ?>', 1);"><div id="elh_t_pcp_kategori_produk" class="t_pcp_kategori_produk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->kategori_produk->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->kategori_produk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->kategori_produk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->kategori_produk2->Visible) { // kategori_produk2 ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->kategori_produk2) == "") { ?>
		<th data-name="kategori_produk2" class="<?php echo $t_pcp_list->kategori_produk2->headerCellClass() ?>"><div id="elh_t_pcp_kategori_produk2" class="t_pcp_kategori_produk2"><div class="ew-table-header-caption"><?php echo $t_pcp_list->kategori_produk2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kategori_produk2" class="<?php echo $t_pcp_list->kategori_produk2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->kategori_produk2) ?>', 1);"><div id="elh_t_pcp_kategori_produk2" class="t_pcp_kategori_produk2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->kategori_produk2->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->kategori_produk2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->kategori_produk2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->kategori_produk3->Visible) { // kategori_produk3 ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->kategori_produk3) == "") { ?>
		<th data-name="kategori_produk3" class="<?php echo $t_pcp_list->kategori_produk3->headerCellClass() ?>"><div id="elh_t_pcp_kategori_produk3" class="t_pcp_kategori_produk3"><div class="ew-table-header-caption"><?php echo $t_pcp_list->kategori_produk3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kategori_produk3" class="<?php echo $t_pcp_list->kategori_produk3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->kategori_produk3) ?>', 1);"><div id="elh_t_pcp_kategori_produk3" class="t_pcp_kategori_produk3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->kategori_produk3->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->kategori_produk3->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->kategori_produk3->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->produk->Visible) { // produk ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->produk) == "") { ?>
		<th data-name="produk" class="<?php echo $t_pcp_list->produk->headerCellClass() ?>"><div id="elh_t_pcp_produk" class="t_pcp_produk"><div class="ew-table-header-caption"><?php echo $t_pcp_list->produk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="produk" class="<?php echo $t_pcp_list->produk->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->produk) ?>', 1);"><div id="elh_t_pcp_produk" class="t_pcp_produk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->produk->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->produk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->produk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->merek_dagang->Visible) { // merek_dagang ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->merek_dagang) == "") { ?>
		<th data-name="merek_dagang" class="<?php echo $t_pcp_list->merek_dagang->headerCellClass() ?>"><div id="elh_t_pcp_merek_dagang" class="t_pcp_merek_dagang"><div class="ew-table-header-caption"><?php echo $t_pcp_list->merek_dagang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="merek_dagang" class="<?php echo $t_pcp_list->merek_dagang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->merek_dagang) ?>', 1);"><div id="elh_t_pcp_merek_dagang" class="t_pcp_merek_dagang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->merek_dagang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->merek_dagang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->merek_dagang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->jenis_perusahaan->Visible) { // jenis_perusahaan ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->jenis_perusahaan) == "") { ?>
		<th data-name="jenis_perusahaan" class="<?php echo $t_pcp_list->jenis_perusahaan->headerCellClass() ?>"><div id="elh_t_pcp_jenis_perusahaan" class="t_pcp_jenis_perusahaan"><div class="ew-table-header-caption"><?php echo $t_pcp_list->jenis_perusahaan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis_perusahaan" class="<?php echo $t_pcp_list->jenis_perusahaan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->jenis_perusahaan) ?>', 1);"><div id="elh_t_pcp_jenis_perusahaan" class="t_pcp_jenis_perusahaan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->jenis_perusahaan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->jenis_perusahaan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->jenis_perusahaan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->kapasitas_produksi->Visible) { // kapasitas_produksi ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->kapasitas_produksi) == "") { ?>
		<th data-name="kapasitas_produksi" class="<?php echo $t_pcp_list->kapasitas_produksi->headerCellClass() ?>"><div id="elh_t_pcp_kapasitas_produksi" class="t_pcp_kapasitas_produksi"><div class="ew-table-header-caption"><?php echo $t_pcp_list->kapasitas_produksi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kapasitas_produksi" class="<?php echo $t_pcp_list->kapasitas_produksi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->kapasitas_produksi) ?>', 1);"><div id="elh_t_pcp_kapasitas_produksi" class="t_pcp_kapasitas_produksi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->kapasitas_produksi->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->kapasitas_produksi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->kapasitas_produksi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->omset->Visible) { // omset ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->omset) == "") { ?>
		<th data-name="omset" class="<?php echo $t_pcp_list->omset->headerCellClass() ?>"><div id="elh_t_pcp_omset" class="t_pcp_omset"><div class="ew-table-header-caption"><?php echo $t_pcp_list->omset->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="omset" class="<?php echo $t_pcp_list->omset->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->omset) ?>', 1);"><div id="elh_t_pcp_omset" class="t_pcp_omset">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->omset->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->omset->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->omset->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->website->Visible) { // website ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->website) == "") { ?>
		<th data-name="website" class="<?php echo $t_pcp_list->website->headerCellClass() ?>"><div id="elh_t_pcp_website" class="t_pcp_website"><div class="ew-table-header-caption"><?php echo $t_pcp_list->website->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="website" class="<?php echo $t_pcp_list->website->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->website) ?>', 1);"><div id="elh_t_pcp_website" class="t_pcp_website">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->website->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->website->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->website->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->jml_pegawai->Visible) { // jml_pegawai ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->jml_pegawai) == "") { ?>
		<th data-name="jml_pegawai" class="<?php echo $t_pcp_list->jml_pegawai->headerCellClass() ?>"><div id="elh_t_pcp_jml_pegawai" class="t_pcp_jml_pegawai"><div class="ew-table-header-caption"><?php echo $t_pcp_list->jml_pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jml_pegawai" class="<?php echo $t_pcp_list->jml_pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->jml_pegawai) ?>', 1);"><div id="elh_t_pcp_jml_pegawai" class="t_pcp_jml_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->jml_pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->jml_pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->jml_pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->jml_pegawai2->Visible) { // jml_pegawai2 ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->jml_pegawai2) == "") { ?>
		<th data-name="jml_pegawai2" class="<?php echo $t_pcp_list->jml_pegawai2->headerCellClass() ?>"><div id="elh_t_pcp_jml_pegawai2" class="t_pcp_jml_pegawai2"><div class="ew-table-header-caption"><?php echo $t_pcp_list->jml_pegawai2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jml_pegawai2" class="<?php echo $t_pcp_list->jml_pegawai2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->jml_pegawai2) ?>', 1);"><div id="elh_t_pcp_jml_pegawai2" class="t_pcp_jml_pegawai2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->jml_pegawai2->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->jml_pegawai2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->jml_pegawai2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->jml_pegawai_tidaktetap->Visible) { // jml_pegawai_tidaktetap ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->jml_pegawai_tidaktetap) == "") { ?>
		<th data-name="jml_pegawai_tidaktetap" class="<?php echo $t_pcp_list->jml_pegawai_tidaktetap->headerCellClass() ?>"><div id="elh_t_pcp_jml_pegawai_tidaktetap" class="t_pcp_jml_pegawai_tidaktetap"><div class="ew-table-header-caption"><?php echo $t_pcp_list->jml_pegawai_tidaktetap->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jml_pegawai_tidaktetap" class="<?php echo $t_pcp_list->jml_pegawai_tidaktetap->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->jml_pegawai_tidaktetap) ?>', 1);"><div id="elh_t_pcp_jml_pegawai_tidaktetap" class="t_pcp_jml_pegawai_tidaktetap">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->jml_pegawai_tidaktetap->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->jml_pegawai_tidaktetap->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->jml_pegawai_tidaktetap->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->legalitas->Visible) { // legalitas ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->legalitas) == "") { ?>
		<th data-name="legalitas" class="<?php echo $t_pcp_list->legalitas->headerCellClass() ?>"><div id="elh_t_pcp_legalitas" class="t_pcp_legalitas"><div class="ew-table-header-caption"><?php echo $t_pcp_list->legalitas->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="legalitas" class="<?php echo $t_pcp_list->legalitas->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->legalitas) ?>', 1);"><div id="elh_t_pcp_legalitas" class="t_pcp_legalitas">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->legalitas->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->legalitas->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->legalitas->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->legalitas_lain->Visible) { // legalitas_lain ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->legalitas_lain) == "") { ?>
		<th data-name="legalitas_lain" class="<?php echo $t_pcp_list->legalitas_lain->headerCellClass() ?>"><div id="elh_t_pcp_legalitas_lain" class="t_pcp_legalitas_lain"><div class="ew-table-header-caption"><?php echo $t_pcp_list->legalitas_lain->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="legalitas_lain" class="<?php echo $t_pcp_list->legalitas_lain->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->legalitas_lain) ?>', 1);"><div id="elh_t_pcp_legalitas_lain" class="t_pcp_legalitas_lain">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->legalitas_lain->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->legalitas_lain->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->legalitas_lain->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->sertifikat->Visible) { // sertifikat ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->sertifikat) == "") { ?>
		<th data-name="sertifikat" class="<?php echo $t_pcp_list->sertifikat->headerCellClass() ?>"><div id="elh_t_pcp_sertifikat" class="t_pcp_sertifikat"><div class="ew-table-header-caption"><?php echo $t_pcp_list->sertifikat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sertifikat" class="<?php echo $t_pcp_list->sertifikat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->sertifikat) ?>', 1);"><div id="elh_t_pcp_sertifikat" class="t_pcp_sertifikat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->sertifikat->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->sertifikat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->sertifikat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->sertifikat_lain->Visible) { // sertifikat_lain ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->sertifikat_lain) == "") { ?>
		<th data-name="sertifikat_lain" class="<?php echo $t_pcp_list->sertifikat_lain->headerCellClass() ?>"><div id="elh_t_pcp_sertifikat_lain" class="t_pcp_sertifikat_lain"><div class="ew-table-header-caption"><?php echo $t_pcp_list->sertifikat_lain->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sertifikat_lain" class="<?php echo $t_pcp_list->sertifikat_lain->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->sertifikat_lain) ?>', 1);"><div id="elh_t_pcp_sertifikat_lain" class="t_pcp_sertifikat_lain">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->sertifikat_lain->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->sertifikat_lain->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->sertifikat_lain->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->alat_promosi->Visible) { // alat_promosi ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->alat_promosi) == "") { ?>
		<th data-name="alat_promosi" class="<?php echo $t_pcp_list->alat_promosi->headerCellClass() ?>"><div id="elh_t_pcp_alat_promosi" class="t_pcp_alat_promosi"><div class="ew-table-header-caption"><?php echo $t_pcp_list->alat_promosi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="alat_promosi" class="<?php echo $t_pcp_list->alat_promosi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->alat_promosi) ?>', 1);"><div id="elh_t_pcp_alat_promosi" class="t_pcp_alat_promosi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->alat_promosi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->alat_promosi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->alat_promosi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->promosi_lain->Visible) { // promosi_lain ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->promosi_lain) == "") { ?>
		<th data-name="promosi_lain" class="<?php echo $t_pcp_list->promosi_lain->headerCellClass() ?>"><div id="elh_t_pcp_promosi_lain" class="t_pcp_promosi_lain"><div class="ew-table-header-caption"><?php echo $t_pcp_list->promosi_lain->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="promosi_lain" class="<?php echo $t_pcp_list->promosi_lain->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->promosi_lain) ?>', 1);"><div id="elh_t_pcp_promosi_lain" class="t_pcp_promosi_lain">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->promosi_lain->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->promosi_lain->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->promosi_lain->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->tahun_ecp->Visible) { // tahun_ecp ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->tahun_ecp) == "") { ?>
		<th data-name="tahun_ecp" class="<?php echo $t_pcp_list->tahun_ecp->headerCellClass() ?>"><div id="elh_t_pcp_tahun_ecp" class="t_pcp_tahun_ecp"><div class="ew-table-header-caption"><?php echo $t_pcp_list->tahun_ecp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun_ecp" class="<?php echo $t_pcp_list->tahun_ecp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->tahun_ecp) ?>', 1);"><div id="elh_t_pcp_tahun_ecp" class="t_pcp_tahun_ecp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->tahun_ecp->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->tahun_ecp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->tahun_ecp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pcp_list->wilayah_ecp->Visible) { // wilayah_ecp ?>
	<?php if ($t_pcp_list->SortUrl($t_pcp_list->wilayah_ecp) == "") { ?>
		<th data-name="wilayah_ecp" class="<?php echo $t_pcp_list->wilayah_ecp->headerCellClass() ?>"><div id="elh_t_pcp_wilayah_ecp" class="t_pcp_wilayah_ecp"><div class="ew-table-header-caption"><?php echo $t_pcp_list->wilayah_ecp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="wilayah_ecp" class="<?php echo $t_pcp_list->wilayah_ecp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pcp_list->SortUrl($t_pcp_list->wilayah_ecp) ?>', 1);"><div id="elh_t_pcp_wilayah_ecp" class="t_pcp_wilayah_ecp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pcp_list->wilayah_ecp->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_pcp_list->wilayah_ecp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pcp_list->wilayah_ecp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_pcp_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_pcp_list->ExportAll && $t_pcp_list->isExport()) {
	$t_pcp_list->StopRecord = $t_pcp_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_pcp_list->TotalRecords > $t_pcp_list->StartRecord + $t_pcp_list->DisplayRecords - 1)
		$t_pcp_list->StopRecord = $t_pcp_list->StartRecord + $t_pcp_list->DisplayRecords - 1;
	else
		$t_pcp_list->StopRecord = $t_pcp_list->TotalRecords;
}
$t_pcp_list->RecordCount = $t_pcp_list->StartRecord - 1;
if ($t_pcp_list->Recordset && !$t_pcp_list->Recordset->EOF) {
	$t_pcp_list->Recordset->moveFirst();
	$selectLimit = $t_pcp_list->UseSelectLimit;
	if (!$selectLimit && $t_pcp_list->StartRecord > 1)
		$t_pcp_list->Recordset->move($t_pcp_list->StartRecord - 1);
} elseif (!$t_pcp->AllowAddDeleteRow && $t_pcp_list->StopRecord == 0) {
	$t_pcp_list->StopRecord = $t_pcp->GridAddRowCount;
}

// Initialize aggregate
$t_pcp->RowType = ROWTYPE_AGGREGATEINIT;
$t_pcp->resetAttributes();
$t_pcp_list->renderRow();
while ($t_pcp_list->RecordCount < $t_pcp_list->StopRecord) {
	$t_pcp_list->RecordCount++;
	if ($t_pcp_list->RecordCount >= $t_pcp_list->StartRecord) {
		$t_pcp_list->RowCount++;

		// Set up key count
		$t_pcp_list->KeyCount = $t_pcp_list->RowIndex;

		// Init row class and style
		$t_pcp->resetAttributes();
		$t_pcp->CssClass = "";
		if ($t_pcp_list->isGridAdd()) {
		} else {
			$t_pcp_list->loadRowValues($t_pcp_list->Recordset); // Load row values
		}
		$t_pcp->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_pcp->RowAttrs->merge(["data-rowindex" => $t_pcp_list->RowCount, "id" => "r" . $t_pcp_list->RowCount . "_t_pcp", "data-rowtype" => $t_pcp->RowType]);

		// Render row
		$t_pcp_list->renderRow();

		// Render list options
		$t_pcp_list->renderListOptions();
?>
	<tr <?php echo $t_pcp->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_pcp_list->ListOptions->render("body", "left", $t_pcp_list->RowCount);
?>
	<?php if ($t_pcp_list->nama_peserta->Visible) { // nama_peserta ?>
		<td data-name="nama_peserta" <?php echo $t_pcp_list->nama_peserta->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_nama_peserta">
<span<?php echo $t_pcp_list->nama_peserta->viewAttributes() ?>><?php echo $t_pcp_list->nama_peserta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->email_add->Visible) { // email_add ?>
		<td data-name="email_add" <?php echo $t_pcp_list->email_add->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_email_add">
<span<?php echo $t_pcp_list->email_add->viewAttributes() ?>><?php echo $t_pcp_list->email_add->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->handphone->Visible) { // handphone ?>
		<td data-name="handphone" <?php echo $t_pcp_list->handphone->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_handphone">
<span<?php echo $t_pcp_list->handphone->viewAttributes() ?>><?php echo $t_pcp_list->handphone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->namap->Visible) { // namap ?>
		<td data-name="namap" <?php echo $t_pcp_list->namap->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_namap">
<span<?php echo $t_pcp_list->namap->viewAttributes() ?>><?php echo $t_pcp_list->namap->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->kategori_produk->Visible) { // kategori_produk ?>
		<td data-name="kategori_produk" <?php echo $t_pcp_list->kategori_produk->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_kategori_produk">
<span<?php echo $t_pcp_list->kategori_produk->viewAttributes() ?>><?php echo $t_pcp_list->kategori_produk->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->kategori_produk2->Visible) { // kategori_produk2 ?>
		<td data-name="kategori_produk2" <?php echo $t_pcp_list->kategori_produk2->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_kategori_produk2">
<span<?php echo $t_pcp_list->kategori_produk2->viewAttributes() ?>><?php echo $t_pcp_list->kategori_produk2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->kategori_produk3->Visible) { // kategori_produk3 ?>
		<td data-name="kategori_produk3" <?php echo $t_pcp_list->kategori_produk3->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_kategori_produk3">
<span<?php echo $t_pcp_list->kategori_produk3->viewAttributes() ?>><?php echo $t_pcp_list->kategori_produk3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->produk->Visible) { // produk ?>
		<td data-name="produk" <?php echo $t_pcp_list->produk->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_produk">
<span<?php echo $t_pcp_list->produk->viewAttributes() ?>><?php echo $t_pcp_list->produk->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->merek_dagang->Visible) { // merek_dagang ?>
		<td data-name="merek_dagang" <?php echo $t_pcp_list->merek_dagang->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_merek_dagang">
<span<?php echo $t_pcp_list->merek_dagang->viewAttributes() ?>><?php echo $t_pcp_list->merek_dagang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->jenis_perusahaan->Visible) { // jenis_perusahaan ?>
		<td data-name="jenis_perusahaan" <?php echo $t_pcp_list->jenis_perusahaan->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_jenis_perusahaan">
<span<?php echo $t_pcp_list->jenis_perusahaan->viewAttributes() ?>><?php echo $t_pcp_list->jenis_perusahaan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->kapasitas_produksi->Visible) { // kapasitas_produksi ?>
		<td data-name="kapasitas_produksi" <?php echo $t_pcp_list->kapasitas_produksi->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_kapasitas_produksi">
<span<?php echo $t_pcp_list->kapasitas_produksi->viewAttributes() ?>><?php echo $t_pcp_list->kapasitas_produksi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->omset->Visible) { // omset ?>
		<td data-name="omset" <?php echo $t_pcp_list->omset->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_omset">
<span<?php echo $t_pcp_list->omset->viewAttributes() ?>><?php echo $t_pcp_list->omset->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->website->Visible) { // website ?>
		<td data-name="website" <?php echo $t_pcp_list->website->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_website">
<span<?php echo $t_pcp_list->website->viewAttributes() ?>><?php echo $t_pcp_list->website->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->jml_pegawai->Visible) { // jml_pegawai ?>
		<td data-name="jml_pegawai" <?php echo $t_pcp_list->jml_pegawai->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_jml_pegawai">
<span<?php echo $t_pcp_list->jml_pegawai->viewAttributes() ?>><?php echo $t_pcp_list->jml_pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->jml_pegawai2->Visible) { // jml_pegawai2 ?>
		<td data-name="jml_pegawai2" <?php echo $t_pcp_list->jml_pegawai2->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_jml_pegawai2">
<span<?php echo $t_pcp_list->jml_pegawai2->viewAttributes() ?>><?php echo $t_pcp_list->jml_pegawai2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->jml_pegawai_tidaktetap->Visible) { // jml_pegawai_tidaktetap ?>
		<td data-name="jml_pegawai_tidaktetap" <?php echo $t_pcp_list->jml_pegawai_tidaktetap->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_jml_pegawai_tidaktetap">
<span<?php echo $t_pcp_list->jml_pegawai_tidaktetap->viewAttributes() ?>><?php echo $t_pcp_list->jml_pegawai_tidaktetap->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->legalitas->Visible) { // legalitas ?>
		<td data-name="legalitas" <?php echo $t_pcp_list->legalitas->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_legalitas">
<span<?php echo $t_pcp_list->legalitas->viewAttributes() ?>><?php echo $t_pcp_list->legalitas->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->legalitas_lain->Visible) { // legalitas_lain ?>
		<td data-name="legalitas_lain" <?php echo $t_pcp_list->legalitas_lain->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_legalitas_lain">
<span<?php echo $t_pcp_list->legalitas_lain->viewAttributes() ?>><?php echo $t_pcp_list->legalitas_lain->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->sertifikat->Visible) { // sertifikat ?>
		<td data-name="sertifikat" <?php echo $t_pcp_list->sertifikat->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_sertifikat">
<span<?php echo $t_pcp_list->sertifikat->viewAttributes() ?>><?php echo $t_pcp_list->sertifikat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->sertifikat_lain->Visible) { // sertifikat_lain ?>
		<td data-name="sertifikat_lain" <?php echo $t_pcp_list->sertifikat_lain->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_sertifikat_lain">
<span<?php echo $t_pcp_list->sertifikat_lain->viewAttributes() ?>><?php echo $t_pcp_list->sertifikat_lain->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->alat_promosi->Visible) { // alat_promosi ?>
		<td data-name="alat_promosi" <?php echo $t_pcp_list->alat_promosi->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_alat_promosi">
<span<?php echo $t_pcp_list->alat_promosi->viewAttributes() ?>><?php echo $t_pcp_list->alat_promosi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->promosi_lain->Visible) { // promosi_lain ?>
		<td data-name="promosi_lain" <?php echo $t_pcp_list->promosi_lain->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_promosi_lain">
<span<?php echo $t_pcp_list->promosi_lain->viewAttributes() ?>><?php echo $t_pcp_list->promosi_lain->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->tahun_ecp->Visible) { // tahun_ecp ?>
		<td data-name="tahun_ecp" <?php echo $t_pcp_list->tahun_ecp->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_tahun_ecp">
<span<?php echo $t_pcp_list->tahun_ecp->viewAttributes() ?>><?php echo $t_pcp_list->tahun_ecp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pcp_list->wilayah_ecp->Visible) { // wilayah_ecp ?>
		<td data-name="wilayah_ecp" <?php echo $t_pcp_list->wilayah_ecp->cellAttributes() ?>>
<span id="el<?php echo $t_pcp_list->RowCount ?>_t_pcp_wilayah_ecp">
<span<?php echo $t_pcp_list->wilayah_ecp->viewAttributes() ?>><?php echo $t_pcp_list->wilayah_ecp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_pcp_list->ListOptions->render("body", "right", $t_pcp_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_pcp_list->isGridAdd())
		$t_pcp_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_pcp->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_pcp_list->Recordset)
	$t_pcp_list->Recordset->Close();
?>
<?php if (!$t_pcp_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_pcp_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_pcp_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_pcp_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_pcp_list->TotalRecords == 0 && !$t_pcp->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_pcp_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_pcp_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_pcp_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$(".ew-list-other-options").html('<span class="ew-detail-option ew-list-option-separator text-nowrap" data-name="button"><div class="btn-group btn-group-sm ew-btn-group"><a class="btn ew-detail-add-group ew-detail-add btn-info" title="" data-caption="Tambah Daftar Peserta Coaching Program/Data Ekspor" href="t_pcpadd.php?showdetail=t_ecp&showmaster=excp&fk_rkid=<?php echo Page("excp")->rkid->CurrentValue; ?>" data-original-title="Tambah Daftar Peserta Coaching Program/Data Ekspor"><i data-phrase="AddLink" class="fas fa-plus ew-icon" data-caption="Tambah"></i> Tambah Data</a></div></span>');
});
</script>
<?php if (!$t_pcp->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_t_pcp",
		width: "100%",
		height: "350px"
	});
});
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$t_pcp_list->terminate();
?>