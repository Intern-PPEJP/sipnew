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
$t_rkcoaching_list = new t_rkcoaching_list();

// Run the page
$t_rkcoaching_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rkcoaching_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_rkcoaching_list->isExport()) { ?>
<script>
var ft_rkcoachinglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_rkcoachinglist = currentForm = new ew.Form("ft_rkcoachinglist", "list");
	ft_rkcoachinglist.formKeyCountName = '<?php echo $t_rkcoaching_list->FormKeyCountName ?>';
	loadjs.done("ft_rkcoachinglist");
});
var ft_rkcoachinglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_rkcoachinglistsrch = currentSearchForm = new ew.Form("ft_rkcoachinglistsrch");

	// Validate function for search
	ft_rkcoachinglistsrch.validate = function(fobj) {
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
	ft_rkcoachinglistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_rkcoachinglistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_rkcoachinglistsrch.lists["x_area2"] = <?php echo $t_rkcoaching_list->area2->Lookup->toClientList($t_rkcoaching_list) ?>;
	ft_rkcoachinglistsrch.lists["x_area2"].options = <?php echo JsonEncode($t_rkcoaching_list->area2->lookupOptions()) ?>;
	ft_rkcoachinglistsrch.lists["x_tahun_keg"] = <?php echo $t_rkcoaching_list->tahun_keg->Lookup->toClientList($t_rkcoaching_list) ?>;
	ft_rkcoachinglistsrch.lists["x_tahun_keg"].options = <?php echo JsonEncode($t_rkcoaching_list->tahun_keg->lookupOptions()) ?>;

	// Filters
	ft_rkcoachinglistsrch.filterList = <?php echo $t_rkcoaching_list->getFilterList() ?>;
	loadjs.done("ft_rkcoachinglistsrch");
});
</script>
<script>
ew.ready("head", "js/ewfixedheadertable.js", "fixedheadertable");
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	function nojadwal(){alert("Jadwal belum tersedia.")}
});
</script>
<?php } ?>
<?php if (!$t_rkcoaching_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_rkcoaching_list->TotalRecords > 0 && $t_rkcoaching_list->ExportOptions->visible()) { ?>
<?php $t_rkcoaching_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_rkcoaching_list->ImportOptions->visible()) { ?>
<?php $t_rkcoaching_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_rkcoaching_list->SearchOptions->visible()) { ?>
<?php $t_rkcoaching_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_rkcoaching_list->FilterOptions->visible()) { ?>
<?php $t_rkcoaching_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_rkcoaching_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_rkcoaching_list->isExport() && !$t_rkcoaching->CurrentAction) { ?>
<form name="ft_rkcoachinglistsrch" id="ft_rkcoachinglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_rkcoachinglistsrch-search-panel" class="<?php echo $t_rkcoaching_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_rkcoaching">
	<div class="ew-extended-search">
<?php

// Render search row
$t_rkcoaching->RowType = ROWTYPE_SEARCH;
$t_rkcoaching->resetAttributes();
$t_rkcoaching_list->renderRow();
?>
<?php if ($t_rkcoaching_list->area2->Visible) { // area2 ?>
	<?php
		$t_rkcoaching_list->SearchColumnCount++;
		if (($t_rkcoaching_list->SearchColumnCount - 1) % $t_rkcoaching_list->SearchFieldsPerRow == 0) {
			$t_rkcoaching_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_rkcoaching_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_area2" class="ew-cell form-group">
		<label for="x_area2" class="ew-search-caption ew-label"><?php echo $t_rkcoaching_list->area2->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_area2" id="z_area2" value="=">
</span>
		<span id="el_t_rkcoaching_area2" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_rkcoaching" data-field="x_area2" data-value-separator="<?php echo $t_rkcoaching_list->area2->displayValueSeparatorAttribute() ?>" id="x_area2" name="x_area2"<?php echo $t_rkcoaching_list->area2->editAttributes() ?>>
			<?php echo $t_rkcoaching_list->area2->selectOptionListHtml("x_area2") ?>
		</select>
</div>
<?php echo $t_rkcoaching_list->area2->Lookup->getParamTag($t_rkcoaching_list, "p_x_area2") ?>
</span>
	</div>
	<?php if ($t_rkcoaching_list->SearchColumnCount % $t_rkcoaching_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($t_rkcoaching_list->tahun_keg->Visible) { // tahun_keg ?>
	<?php
		$t_rkcoaching_list->SearchColumnCount++;
		if (($t_rkcoaching_list->SearchColumnCount - 1) % $t_rkcoaching_list->SearchFieldsPerRow == 0) {
			$t_rkcoaching_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_rkcoaching_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_tahun_keg" class="ew-cell form-group">
		<label for="x_tahun_keg" class="ew-search-caption ew-label"><?php echo $t_rkcoaching_list->tahun_keg->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tahun_keg" id="z_tahun_keg" value="=">
</span>
		<span id="el_t_rkcoaching_tahun_keg" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_rkcoaching" data-field="x_tahun_keg" data-value-separator="<?php echo $t_rkcoaching_list->tahun_keg->displayValueSeparatorAttribute() ?>" id="x_tahun_keg" name="x_tahun_keg"<?php echo $t_rkcoaching_list->tahun_keg->editAttributes() ?>>
			<?php echo $t_rkcoaching_list->tahun_keg->selectOptionListHtml("x_tahun_keg") ?>
		</select>
</div>
<?php echo $t_rkcoaching_list->tahun_keg->Lookup->getParamTag($t_rkcoaching_list, "p_x_tahun_keg") ?>
</span>
	</div>
	<?php if ($t_rkcoaching_list->SearchColumnCount % $t_rkcoaching_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($t_rkcoaching_list->SearchColumnCount % $t_rkcoaching_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $t_rkcoaching_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($t_rkcoaching_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($t_rkcoaching_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $t_rkcoaching_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($t_rkcoaching_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($t_rkcoaching_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($t_rkcoaching_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($t_rkcoaching_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_rkcoaching_list->showPageHeader(); ?>
<?php
$t_rkcoaching_list->showMessage();
?>
<?php if ($t_rkcoaching_list->TotalRecords > 0 || $t_rkcoaching->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_rkcoaching_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_rkcoaching">
<?php if (!$t_rkcoaching_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_rkcoaching_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_rkcoaching_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_rkcoaching_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_rkcoachinglist" id="ft_rkcoachinglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rkcoaching">
<div id="gmp_t_rkcoaching" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_rkcoaching_list->TotalRecords > 0 || $t_rkcoaching_list->isGridEdit()) { ?>
<table id="tbl_t_rkcoachinglist" class="table ew-table d-none"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_rkcoaching->RowType = ROWTYPE_HEADER;

// Render list options
$t_rkcoaching_list->renderListOptions();

// Render list options (header, left)
$t_rkcoaching_list->ListOptions->render("header", "left", "", "block", $t_rkcoaching->TableVar, "t_rkcoachinglist");
?>
<?php if ($t_rkcoaching_list->kdkategori->Visible) { // kdkategori ?>
	<?php if ($t_rkcoaching_list->SortUrl($t_rkcoaching_list->kdkategori) == "") { ?>
		<th data-name="kdkategori" class="<?php echo $t_rkcoaching_list->kdkategori->headerCellClass() ?>"><div id="elh_t_rkcoaching_kdkategori" class="t_rkcoaching_kdkategori"><div class="ew-table-header-caption"><script id="tpc_t_rkcoaching_kdkategori" type="text/html"><?php echo $t_rkcoaching_list->kdkategori->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="kdkategori" class="<?php echo $t_rkcoaching_list->kdkategori->headerCellClass() ?>"><script id="tpc_t_rkcoaching_kdkategori" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rkcoaching_list->SortUrl($t_rkcoaching_list->kdkategori) ?>', 1);"><div id="elh_t_rkcoaching_kdkategori" class="t_rkcoaching_kdkategori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rkcoaching_list->kdkategori->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rkcoaching_list->kdkategori->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rkcoaching_list->kdkategori->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rkcoaching_list->kerjasama->Visible) { // kerjasama ?>
	<?php if ($t_rkcoaching_list->SortUrl($t_rkcoaching_list->kerjasama) == "") { ?>
		<th data-name="kerjasama" class="<?php echo $t_rkcoaching_list->kerjasama->headerCellClass() ?>"><div id="elh_t_rkcoaching_kerjasama" class="t_rkcoaching_kerjasama"><div class="ew-table-header-caption"><script id="tpc_t_rkcoaching_kerjasama" type="text/html"><?php echo $t_rkcoaching_list->kerjasama->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="kerjasama" class="<?php echo $t_rkcoaching_list->kerjasama->headerCellClass() ?>"><script id="tpc_t_rkcoaching_kerjasama" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rkcoaching_list->SortUrl($t_rkcoaching_list->kerjasama) ?>', 1);"><div id="elh_t_rkcoaching_kerjasama" class="t_rkcoaching_kerjasama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rkcoaching_list->kerjasama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_rkcoaching_list->kerjasama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rkcoaching_list->kerjasama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rkcoaching_list->area->Visible) { // area ?>
	<?php if ($t_rkcoaching_list->SortUrl($t_rkcoaching_list->area) == "") { ?>
		<th data-name="area" class="<?php echo $t_rkcoaching_list->area->headerCellClass() ?>"><div id="elh_t_rkcoaching_area" class="t_rkcoaching_area"><div class="ew-table-header-caption"><script id="tpc_t_rkcoaching_area" type="text/html"><?php echo $t_rkcoaching_list->area->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="area" class="<?php echo $t_rkcoaching_list->area->headerCellClass() ?>"><script id="tpc_t_rkcoaching_area" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rkcoaching_list->SortUrl($t_rkcoaching_list->area) ?>', 1);"><div id="elh_t_rkcoaching_area" class="t_rkcoaching_area">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rkcoaching_list->area->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rkcoaching_list->area->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rkcoaching_list->area->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rkcoaching_list->area2->Visible) { // area2 ?>
	<?php if ($t_rkcoaching_list->SortUrl($t_rkcoaching_list->area2) == "") { ?>
		<th data-name="area2" class="<?php echo $t_rkcoaching_list->area2->headerCellClass() ?>"><div id="elh_t_rkcoaching_area2" class="t_rkcoaching_area2"><div class="ew-table-header-caption"><script id="tpc_t_rkcoaching_area2" type="text/html"><?php echo $t_rkcoaching_list->area2->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="area2" class="<?php echo $t_rkcoaching_list->area2->headerCellClass() ?>"><script id="tpc_t_rkcoaching_area2" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rkcoaching_list->SortUrl($t_rkcoaching_list->area2) ?>', 1);"><div id="elh_t_rkcoaching_area2" class="t_rkcoaching_area2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rkcoaching_list->area2->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rkcoaching_list->area2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rkcoaching_list->area2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rkcoaching_list->tempat->Visible) { // tempat ?>
	<?php if ($t_rkcoaching_list->SortUrl($t_rkcoaching_list->tempat) == "") { ?>
		<th data-name="tempat" class="<?php echo $t_rkcoaching_list->tempat->headerCellClass() ?>"><div id="elh_t_rkcoaching_tempat" class="t_rkcoaching_tempat"><div class="ew-table-header-caption"><script id="tpc_t_rkcoaching_tempat" type="text/html"><?php echo $t_rkcoaching_list->tempat->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="tempat" class="<?php echo $t_rkcoaching_list->tempat->headerCellClass() ?>"><script id="tpc_t_rkcoaching_tempat" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rkcoaching_list->SortUrl($t_rkcoaching_list->tempat) ?>', 1);"><div id="elh_t_rkcoaching_tempat" class="t_rkcoaching_tempat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rkcoaching_list->tempat->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_rkcoaching_list->tempat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rkcoaching_list->tempat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rkcoaching_list->jml_tahapan->Visible) { // jml_tahapan ?>
	<?php if ($t_rkcoaching_list->SortUrl($t_rkcoaching_list->jml_tahapan) == "") { ?>
		<th data-name="jml_tahapan" class="<?php echo $t_rkcoaching_list->jml_tahapan->headerCellClass() ?>"><div id="elh_t_rkcoaching_jml_tahapan" class="t_rkcoaching_jml_tahapan"><div class="ew-table-header-caption"><script id="tpc_t_rkcoaching_jml_tahapan" type="text/html"><?php echo $t_rkcoaching_list->jml_tahapan->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="jml_tahapan" class="<?php echo $t_rkcoaching_list->jml_tahapan->headerCellClass() ?>"><script id="tpc_t_rkcoaching_jml_tahapan" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rkcoaching_list->SortUrl($t_rkcoaching_list->jml_tahapan) ?>', 1);"><div id="elh_t_rkcoaching_jml_tahapan" class="t_rkcoaching_jml_tahapan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rkcoaching_list->jml_tahapan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rkcoaching_list->jml_tahapan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rkcoaching_list->jml_tahapan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rkcoaching_list->jml_peserta->Visible) { // jml_peserta ?>
	<?php if ($t_rkcoaching_list->SortUrl($t_rkcoaching_list->jml_peserta) == "") { ?>
		<th data-name="jml_peserta" class="<?php echo $t_rkcoaching_list->jml_peserta->headerCellClass() ?>"><div id="elh_t_rkcoaching_jml_peserta" class="t_rkcoaching_jml_peserta"><div class="ew-table-header-caption"><script id="tpc_t_rkcoaching_jml_peserta" type="text/html"><?php echo $t_rkcoaching_list->jml_peserta->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="jml_peserta" class="<?php echo $t_rkcoaching_list->jml_peserta->headerCellClass() ?>"><script id="tpc_t_rkcoaching_jml_peserta" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rkcoaching_list->SortUrl($t_rkcoaching_list->jml_peserta) ?>', 1);"><div id="elh_t_rkcoaching_jml_peserta" class="t_rkcoaching_jml_peserta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rkcoaching_list->jml_peserta->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rkcoaching_list->jml_peserta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rkcoaching_list->jml_peserta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rkcoaching_list->tahun_keg->Visible) { // tahun_keg ?>
	<?php if ($t_rkcoaching_list->SortUrl($t_rkcoaching_list->tahun_keg) == "") { ?>
		<th data-name="tahun_keg" class="<?php echo $t_rkcoaching_list->tahun_keg->headerCellClass() ?>"><div id="elh_t_rkcoaching_tahun_keg" class="t_rkcoaching_tahun_keg"><div class="ew-table-header-caption"><script id="tpc_t_rkcoaching_tahun_keg" type="text/html"><?php echo $t_rkcoaching_list->tahun_keg->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="tahun_keg" class="<?php echo $t_rkcoaching_list->tahun_keg->headerCellClass() ?>"><script id="tpc_t_rkcoaching_tahun_keg" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rkcoaching_list->SortUrl($t_rkcoaching_list->tahun_keg) ?>', 1);"><div id="elh_t_rkcoaching_tahun_keg" class="t_rkcoaching_tahun_keg">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rkcoaching_list->tahun_keg->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rkcoaching_list->tahun_keg->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rkcoaching_list->tahun_keg->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rkcoaching_list->mou->Visible) { // mou ?>
	<?php if ($t_rkcoaching_list->SortUrl($t_rkcoaching_list->mou) == "") { ?>
		<th data-name="mou" class="<?php echo $t_rkcoaching_list->mou->headerCellClass() ?>"><div id="elh_t_rkcoaching_mou" class="t_rkcoaching_mou"><div class="ew-table-header-caption"><script id="tpc_t_rkcoaching_mou" type="text/html"><?php echo $t_rkcoaching_list->mou->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="mou" class="<?php echo $t_rkcoaching_list->mou->headerCellClass() ?>"><script id="tpc_t_rkcoaching_mou" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rkcoaching_list->SortUrl($t_rkcoaching_list->mou) ?>', 1);"><div id="elh_t_rkcoaching_mou" class="t_rkcoaching_mou">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rkcoaching_list->mou->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rkcoaching_list->mou->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rkcoaching_list->mou->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rkcoaching_list->real->Visible) { // real ?>
	<?php if ($t_rkcoaching_list->SortUrl($t_rkcoaching_list->real) == "") { ?>
		<th data-name="real" class="<?php echo $t_rkcoaching_list->real->headerCellClass() ?>"><div id="elh_t_rkcoaching_real" class="t_rkcoaching_real"><div class="ew-table-header-caption"><script id="tpc_t_rkcoaching_real" type="text/html"><?php echo $t_rkcoaching_list->real->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="real" class="<?php echo $t_rkcoaching_list->real->headerCellClass() ?>"><script id="tpc_t_rkcoaching_real" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rkcoaching_list->SortUrl($t_rkcoaching_list->real) ?>', 1);"><div id="elh_t_rkcoaching_real" class="t_rkcoaching_real">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rkcoaching_list->real->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rkcoaching_list->real->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rkcoaching_list->real->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_rkcoaching_list->ListOptions->render("header", "right", "", "block", $t_rkcoaching->TableVar, "t_rkcoachinglist");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_rkcoaching_list->ExportAll && $t_rkcoaching_list->isExport()) {
	$t_rkcoaching_list->StopRecord = $t_rkcoaching_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_rkcoaching_list->TotalRecords > $t_rkcoaching_list->StartRecord + $t_rkcoaching_list->DisplayRecords - 1)
		$t_rkcoaching_list->StopRecord = $t_rkcoaching_list->StartRecord + $t_rkcoaching_list->DisplayRecords - 1;
	else
		$t_rkcoaching_list->StopRecord = $t_rkcoaching_list->TotalRecords;
}
$t_rkcoaching_list->RecordCount = $t_rkcoaching_list->StartRecord - 1;
if ($t_rkcoaching_list->Recordset && !$t_rkcoaching_list->Recordset->EOF) {
	$t_rkcoaching_list->Recordset->moveFirst();
	$selectLimit = $t_rkcoaching_list->UseSelectLimit;
	if (!$selectLimit && $t_rkcoaching_list->StartRecord > 1)
		$t_rkcoaching_list->Recordset->move($t_rkcoaching_list->StartRecord - 1);
} elseif (!$t_rkcoaching->AllowAddDeleteRow && $t_rkcoaching_list->StopRecord == 0) {
	$t_rkcoaching_list->StopRecord = $t_rkcoaching->GridAddRowCount;
}

// Initialize aggregate
$t_rkcoaching->RowType = ROWTYPE_AGGREGATEINIT;
$t_rkcoaching->resetAttributes();
$t_rkcoaching_list->renderRow();
while ($t_rkcoaching_list->RecordCount < $t_rkcoaching_list->StopRecord) {
	$t_rkcoaching_list->RecordCount++;
	if ($t_rkcoaching_list->RecordCount >= $t_rkcoaching_list->StartRecord) {
		$t_rkcoaching_list->RowCount++;

		// Set up key count
		$t_rkcoaching_list->KeyCount = $t_rkcoaching_list->RowIndex;

		// Init row class and style
		$t_rkcoaching->resetAttributes();
		$t_rkcoaching->CssClass = "";
		if ($t_rkcoaching_list->isGridAdd()) {
		} else {
			$t_rkcoaching_list->loadRowValues($t_rkcoaching_list->Recordset); // Load row values
		}
		$t_rkcoaching->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_rkcoaching->RowAttrs->merge(["data-rowindex" => $t_rkcoaching_list->RowCount, "id" => "r" . $t_rkcoaching_list->RowCount . "_t_rkcoaching", "data-rowtype" => $t_rkcoaching->RowType]);

		// Render row
		$t_rkcoaching_list->renderRow();

		// Render list options
		$t_rkcoaching_list->renderListOptions();

		// Save row and cell attributes
		$t_rkcoaching_list->Attrs[$t_rkcoaching_list->RowCount] = ["row_attrs" => $t_rkcoaching->rowAttributes(), "cell_attrs" => []];
		$t_rkcoaching_list->Attrs[$t_rkcoaching_list->RowCount]["cell_attrs"] = $t_rkcoaching->fieldCellAttributes();
?>
	<tr <?php echo $t_rkcoaching->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_rkcoaching_list->ListOptions->render("body", "left", $t_rkcoaching_list->RowCount, "block", $t_rkcoaching->TableVar, "t_rkcoachinglist");
?>
	<?php if ($t_rkcoaching_list->kdkategori->Visible) { // kdkategori ?>
		<td data-name="kdkategori" <?php echo $t_rkcoaching_list->kdkategori->cellAttributes() ?>>
<script id="tpx<?php echo $t_rkcoaching_list->RowCount ?>_t_rkcoaching_kdkategori" type="text/html"><span id="el<?php echo $t_rkcoaching_list->RowCount ?>_t_rkcoaching_kdkategori">
<span<?php echo $t_rkcoaching_list->kdkategori->viewAttributes() ?>><?php echo $t_rkcoaching_list->kdkategori->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($t_rkcoaching_list->kerjasama->Visible) { // kerjasama ?>
		<td data-name="kerjasama" <?php echo $t_rkcoaching_list->kerjasama->cellAttributes() ?>>
<script id="tpx<?php echo $t_rkcoaching_list->RowCount ?>_t_rkcoaching_kerjasama" type="text/html"><span id="el<?php echo $t_rkcoaching_list->RowCount ?>_t_rkcoaching_kerjasama">
<span<?php echo $t_rkcoaching_list->kerjasama->viewAttributes() ?>><?php echo $t_rkcoaching_list->kerjasama->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($t_rkcoaching_list->area->Visible) { // area ?>
		<td data-name="area" <?php echo $t_rkcoaching_list->area->cellAttributes() ?>>
<script id="tpx<?php echo $t_rkcoaching_list->RowCount ?>_t_rkcoaching_area" type="text/html"><span id="el<?php echo $t_rkcoaching_list->RowCount ?>_t_rkcoaching_area">
<span<?php echo $t_rkcoaching_list->area->viewAttributes() ?>><?php echo $t_rkcoaching_list->area->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($t_rkcoaching_list->area2->Visible) { // area2 ?>
		<td data-name="area2" <?php echo $t_rkcoaching_list->area2->cellAttributes() ?>>
<script id="tpx<?php echo $t_rkcoaching_list->RowCount ?>_t_rkcoaching_area2" type="text/html"><span id="el<?php echo $t_rkcoaching_list->RowCount ?>_t_rkcoaching_area2">
<span<?php echo $t_rkcoaching_list->area2->viewAttributes() ?>><?php echo $t_rkcoaching_list->area2->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($t_rkcoaching_list->tempat->Visible) { // tempat ?>
		<td data-name="tempat" <?php echo $t_rkcoaching_list->tempat->cellAttributes() ?>>
<script id="tpx<?php echo $t_rkcoaching_list->RowCount ?>_t_rkcoaching_tempat" type="text/html"><span id="el<?php echo $t_rkcoaching_list->RowCount ?>_t_rkcoaching_tempat">
<span<?php echo $t_rkcoaching_list->tempat->viewAttributes() ?>><?php echo $t_rkcoaching_list->tempat->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($t_rkcoaching_list->jml_tahapan->Visible) { // jml_tahapan ?>
		<td data-name="jml_tahapan" <?php echo $t_rkcoaching_list->jml_tahapan->cellAttributes() ?>>
<script id="tpx<?php echo $t_rkcoaching_list->RowCount ?>_t_rkcoaching_jml_tahapan" type="text/html"><span id="el<?php echo $t_rkcoaching_list->RowCount ?>_t_rkcoaching_jml_tahapan">
<span<?php echo $t_rkcoaching_list->jml_tahapan->viewAttributes() ?>><?php echo $t_rkcoaching_list->jml_tahapan->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($t_rkcoaching_list->jml_peserta->Visible) { // jml_peserta ?>
		<td data-name="jml_peserta" <?php echo $t_rkcoaching_list->jml_peserta->cellAttributes() ?>>
<script id="tpx<?php echo $t_rkcoaching_list->RowCount ?>_t_rkcoaching_jml_peserta" type="text/html"><span id="el<?php echo $t_rkcoaching_list->RowCount ?>_t_rkcoaching_jml_peserta">
<span<?php echo $t_rkcoaching_list->jml_peserta->viewAttributes() ?>><?php echo $t_rkcoaching_list->jml_peserta->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($t_rkcoaching_list->tahun_keg->Visible) { // tahun_keg ?>
		<td data-name="tahun_keg" <?php echo $t_rkcoaching_list->tahun_keg->cellAttributes() ?>>
<script id="tpx<?php echo $t_rkcoaching_list->RowCount ?>_t_rkcoaching_tahun_keg" type="text/html"><span id="el<?php echo $t_rkcoaching_list->RowCount ?>_t_rkcoaching_tahun_keg">
<span<?php echo $t_rkcoaching_list->tahun_keg->viewAttributes() ?>><?php echo $t_rkcoaching_list->tahun_keg->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($t_rkcoaching_list->mou->Visible) { // mou ?>
		<td data-name="mou" <?php echo $t_rkcoaching_list->mou->cellAttributes() ?>>
<script id="tpx<?php echo $t_rkcoaching_list->RowCount ?>_t_rkcoaching_mou" type="text/html"><span id="el<?php echo $t_rkcoaching_list->RowCount ?>_t_rkcoaching_mou">
<span<?php echo $t_rkcoaching_list->mou->viewAttributes() ?>><?php echo GetFileViewTag($t_rkcoaching_list->mou, $t_rkcoaching_list->mou->getViewValue(), FALSE) ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($t_rkcoaching_list->real->Visible) { // real ?>
		<td data-name="real" <?php echo $t_rkcoaching_list->real->cellAttributes() ?>>
<script id="tpx<?php echo $t_rkcoaching_list->RowCount ?>_t_rkcoaching_real" type="text/html"><span id="el<?php echo $t_rkcoaching_list->RowCount ?>_t_rkcoaching_real">
<span<?php echo $t_rkcoaching_list->real->viewAttributes() ?>><?php echo $t_rkcoaching_list->real->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_rkcoaching_list->ListOptions->render("body", "right", $t_rkcoaching_list->RowCount, "block", $t_rkcoaching->TableVar, "t_rkcoachinglist");
?>
	</tr>
<?php
	}
	if (!$t_rkcoaching_list->isGridAdd())
		$t_rkcoaching_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<div id="tpd_t_rkcoachinglist" class="ew-custom-template"></div>
<script id="tpm_t_rkcoachinglist" type="text/html">
<div id="ct_t_rkcoaching_list"><?php if ($t_rkcoaching_list->RowCount > 0) { ?>
<style>
.ew-table-header th, .ew-table-header td { text-align: center; }
</style>
<table class="table ew-table">
	<thead>
<tr class="ew-table-header">
	<th rowspan="2"></th>
	<th rowspan="2">WILAYAH</th>
	<th rowspan="2">INSTANSI KERJASAMA</th>
	<th colspan="2">TAHAPAN</th>
	<!--<th rowspan="2">TEMPAT PELAKSANAAN</th>-->
	<th rowspan="2">TAHUN KEGIATAN</th>
	<th rowspan="2">JML. PESERTA</th>
	{{include tmpl=~getTemplate("#tpoh_t_rkcoaching")/}}
</tr>
<tr class="ew-table-header">
	<th>JUMLAH</th><th>TEREALISASI</th>
</tr>
</thead>
	<tbody>
<?php for ($i = $t_rkcoaching_list->StartRowCount; $i <= $t_rkcoaching_list->RowCount; $i++) { ?>
	
	<tr<?php echo @$t_rkcoaching_list->Attrs[$i]['row_attrs'] ?>>
	<td><?php echo $i; ?>.</td>
	<td>{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_t_rkcoaching_area2")/}}</td>
	<td>{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_t_rkcoaching_kerjasama")/}}</td>
	<td>{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_t_rkcoaching_jml_tahapan")/}}</td>
	<td>{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_t_rkcoaching_real")/}}</td>
<!--	<td>{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_t_rkcoaching_tempat")/}}</td>-->
	<td>{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_t_rkcoaching_tahun_keg")/}}</td>
	<td>{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_t_rkcoaching_jml_peserta")/}}</td>
	{{include tmpl=~getTemplate("#tpob<?php echo $i ?>_t_rkcoaching")/}}
</tr>

<?php } ?>
</tbody></table>
<?php } ?>
</div>
</script>

</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_rkcoaching->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_rkcoaching_list->Recordset)
	$t_rkcoaching_list->Recordset->Close();
?>
<?php if (!$t_rkcoaching_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_rkcoaching_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_rkcoaching_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_rkcoaching_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_rkcoaching_list->TotalRecords == 0 && !$t_rkcoaching->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_rkcoaching_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($t_rkcoaching->Rows) ?> };
	ew.applyTemplate("tpd_t_rkcoachinglist", "tpm_t_rkcoachinglist", "t_rkcoachinglist", "<?php echo $t_rkcoaching->CustomExport ?>", ew.templateData);
	$("#tpd_t_rkcoachinglist th.ew-list-option-header").each(function() {
		this.rowSpan = 2;
	});
	$("script.t_rkcoachinglist_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$t_rkcoaching_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_rkcoaching_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php if (!$t_rkcoaching->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_t_rkcoaching",
		width: "100%",
		height: "350px"
	});
});
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$t_rkcoaching_list->terminate();
?>