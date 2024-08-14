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
$petri_list = new petri_list();

// Run the page
$petri_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$petri_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$petri_list->isExport()) { ?>
<script>
var fpetrilist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpetrilist = currentForm = new ew.Form("fpetrilist", "list");
	fpetrilist.formKeyCountName = '<?php echo $petri_list->FormKeyCountName ?>';
	loadjs.done("fpetrilist");
});
var fpetrilistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpetrilistsrch = currentSearchForm = new ew.Form("fpetrilistsrch");

	// Validate function for search
	fpetrilistsrch.validate = function(fobj) {
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
	fpetrilistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpetrilistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpetrilistsrch.lists["x_kdjudul"] = <?php echo $petri_list->kdjudul->Lookup->toClientList($petri_list) ?>;
	fpetrilistsrch.lists["x_kdjudul"].options = <?php echo JsonEncode($petri_list->kdjudul->lookupOptions()) ?>;
	fpetrilistsrch.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpetrilistsrch.lists["x_kdprop"] = <?php echo $petri_list->kdprop->Lookup->toClientList($petri_list) ?>;
	fpetrilistsrch.lists["x_kdprop"].options = <?php echo JsonEncode($petri_list->kdprop->lookupOptions()) ?>;
	fpetrilistsrch.lists["x_kdkota"] = <?php echo $petri_list->kdkota->Lookup->toClientList($petri_list) ?>;
	fpetrilistsrch.lists["x_kdkota"].options = <?php echo JsonEncode($petri_list->kdkota->lookupOptions()) ?>;

	// Filters
	fpetrilistsrch.filterList = <?php echo $petri_list->getFilterList() ?>;
	loadjs.done("fpetrilistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$petri_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($petri_list->TotalRecords > 0 && $petri_list->ExportOptions->visible()) { ?>
<?php $petri_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($petri_list->ImportOptions->visible()) { ?>
<?php $petri_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($petri_list->SearchOptions->visible()) { ?>
<?php $petri_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($petri_list->FilterOptions->visible()) { ?>
<?php $petri_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$petri_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$petri_list->isExport() && !$petri->CurrentAction) { ?>
<form name="fpetrilistsrch" id="fpetrilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpetrilistsrch-search-panel" class="<?php echo $petri_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="petri">
	<div class="ew-extended-search">
<?php

// Render search row
$petri->RowType = ROWTYPE_SEARCH;
$petri->resetAttributes();
$petri_list->renderRow();
?>
<?php if ($petri_list->kdjudul->Visible) { // kdjudul ?>
	<?php
		$petri_list->SearchColumnCount++;
		if (($petri_list->SearchColumnCount - 1) % $petri_list->SearchFieldsPerRow == 0) {
			$petri_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $petri_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kdjudul" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $petri_list->kdjudul->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdjudul" id="z_kdjudul" value="=">
</span>
		<span id="el_petri_kdjudul" class="ew-search-field">
<?php
$onchange = $petri_list->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$petri_list->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($petri_list->kdjudul->EditValue) ?>" size="100" placeholder="<?php echo HtmlEncode($petri_list->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($petri_list->kdjudul->getPlaceHolder()) ?>"<?php echo $petri_list->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="petri" data-field="x_kdjudul" data-value-separator="<?php echo $petri_list->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($petri_list->kdjudul->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpetrilistsrch"], function() {
	fpetrilistsrch.createAutoSuggest({"id":"x_kdjudul","forceSelect":false,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $petri_list->kdjudul->Lookup->getParamTag($petri_list, "p_x_kdjudul") ?>
</span>
	</div>
	<?php if ($petri_list->SearchColumnCount % $petri_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->kdprop->Visible) { // kdprop ?>
	<?php
		$petri_list->SearchColumnCount++;
		if (($petri_list->SearchColumnCount - 1) % $petri_list->SearchFieldsPerRow == 0) {
			$petri_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $petri_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kdprop" class="ew-cell form-group">
		<label for="x_kdprop" class="ew-search-caption ew-label"><?php echo $petri_list->kdprop->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdprop" id="z_kdprop" value="=">
</span>
		<span id="el_petri_kdprop" class="ew-search-field">
<?php $petri_list->kdprop->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="petri" data-field="x_kdprop" data-value-separator="<?php echo $petri_list->kdprop->displayValueSeparatorAttribute() ?>" id="x_kdprop" name="x_kdprop"<?php echo $petri_list->kdprop->editAttributes() ?>>
			<?php echo $petri_list->kdprop->selectOptionListHtml("x_kdprop") ?>
		</select>
</div>
<?php echo $petri_list->kdprop->Lookup->getParamTag($petri_list, "p_x_kdprop") ?>
</span>
	</div>
	<?php if ($petri_list->SearchColumnCount % $petri_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->kdkota->Visible) { // kdkota ?>
	<?php
		$petri_list->SearchColumnCount++;
		if (($petri_list->SearchColumnCount - 1) % $petri_list->SearchFieldsPerRow == 0) {
			$petri_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $petri_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kdkota" class="ew-cell form-group">
		<label for="x_kdkota" class="ew-search-caption ew-label"><?php echo $petri_list->kdkota->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdkota" id="z_kdkota" value="=">
</span>
		<span id="el_petri_kdkota" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="petri" data-field="x_kdkota" data-value-separator="<?php echo $petri_list->kdkota->displayValueSeparatorAttribute() ?>" id="x_kdkota" name="x_kdkota"<?php echo $petri_list->kdkota->editAttributes() ?>>
			<?php echo $petri_list->kdkota->selectOptionListHtml("x_kdkota") ?>
		</select>
</div>
<?php echo $petri_list->kdkota->Lookup->getParamTag($petri_list, "p_x_kdkota") ?>
</span>
	</div>
	<?php if ($petri_list->SearchColumnCount % $petri_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($petri_list->SearchColumnCount % $petri_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $petri_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($petri_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($petri_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $petri_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($petri_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($petri_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($petri_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($petri_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $petri_list->showPageHeader(); ?>
<?php
$petri_list->showMessage();
?>
<?php if ($petri_list->TotalRecords > 0 || $petri->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($petri_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> petri">
<?php if (!$petri_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$petri_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $petri_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $petri_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpetrilist" id="fpetrilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="petri">
<div id="gmp_petri" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($petri_list->TotalRecords > 0 || $petri_list->isGridEdit()) { ?>
<table id="tbl_petrilist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$petri->RowType = ROWTYPE_HEADER;

// Render list options
$petri_list->renderListOptions();

// Render list options (header, left)
$petri_list->ListOptions->render("header", "left");
?>
<?php if ($petri_list->kdjudul->Visible) { // kdjudul ?>
	<?php if ($petri_list->SortUrl($petri_list->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $petri_list->kdjudul->headerCellClass() ?>"><div id="elh_petri_kdjudul" class="petri_kdjudul"><div class="ew-table-header-caption"><?php echo $petri_list->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $petri_list->kdjudul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->kdjudul) ?>', 1);"><div id="elh_petri_kdjudul" class="petri_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->kdjudul->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($petri_list->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->tawal->Visible) { // tawal ?>
	<?php if ($petri_list->SortUrl($petri_list->tawal) == "") { ?>
		<th data-name="tawal" class="<?php echo $petri_list->tawal->headerCellClass() ?>"><div id="elh_petri_tawal" class="petri_tawal"><div class="ew-table-header-caption"><?php echo $petri_list->tawal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tawal" class="<?php echo $petri_list->tawal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->tawal) ?>', 1);"><div id="elh_petri_tawal" class="petri_tawal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->tawal->caption() ?></span><span class="ew-table-header-sort"><?php if ($petri_list->tawal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->tawal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->takhir->Visible) { // takhir ?>
	<?php if ($petri_list->SortUrl($petri_list->takhir) == "") { ?>
		<th data-name="takhir" class="<?php echo $petri_list->takhir->headerCellClass() ?>"><div id="elh_petri_takhir" class="petri_takhir"><div class="ew-table-header-caption"><?php echo $petri_list->takhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="takhir" class="<?php echo $petri_list->takhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->takhir) ?>', 1);"><div id="elh_petri_takhir" class="petri_takhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->takhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($petri_list->takhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->takhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->nama->Visible) { // nama ?>
	<?php if ($petri_list->SortUrl($petri_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $petri_list->nama->headerCellClass() ?>"><div id="elh_petri_nama" class="petri_nama"><div class="ew-table-header-caption"><?php echo $petri_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $petri_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->nama) ?>', 1);"><div id="elh_petri_nama" class="petri_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($petri_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->kdprop->Visible) { // kdprop ?>
	<?php if ($petri_list->SortUrl($petri_list->kdprop) == "") { ?>
		<th data-name="kdprop" class="<?php echo $petri_list->kdprop->headerCellClass() ?>"><div id="elh_petri_kdprop" class="petri_kdprop"><div class="ew-table-header-caption"><?php echo $petri_list->kdprop->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdprop" class="<?php echo $petri_list->kdprop->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->kdprop) ?>', 1);"><div id="elh_petri_kdprop" class="petri_kdprop">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->kdprop->caption() ?></span><span class="ew-table-header-sort"><?php if ($petri_list->kdprop->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->kdprop->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->kdkota->Visible) { // kdkota ?>
	<?php if ($petri_list->SortUrl($petri_list->kdkota) == "") { ?>
		<th data-name="kdkota" class="<?php echo $petri_list->kdkota->headerCellClass() ?>"><div id="elh_petri_kdkota" class="petri_kdkota"><div class="ew-table-header-caption"><?php echo $petri_list->kdkota->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkota" class="<?php echo $petri_list->kdkota->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->kdkota) ?>', 1);"><div id="elh_petri_kdkota" class="petri_kdkota">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->kdkota->caption() ?></span><span class="ew-table-header-sort"><?php if ($petri_list->kdkota->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->kdkota->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->kdsex->Visible) { // kdsex ?>
	<?php if ($petri_list->SortUrl($petri_list->kdsex) == "") { ?>
		<th data-name="kdsex" class="<?php echo $petri_list->kdsex->headerCellClass() ?>"><div id="elh_petri_kdsex" class="petri_kdsex"><div class="ew-table-header-caption"><?php echo $petri_list->kdsex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdsex" class="<?php echo $petri_list->kdsex->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->kdsex) ?>', 1);"><div id="elh_petri_kdsex" class="petri_kdsex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->kdsex->caption() ?></span><span class="ew-table-header-sort"><?php if ($petri_list->kdsex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->kdsex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->kdjabat->Visible) { // kdjabat ?>
	<?php if ($petri_list->SortUrl($petri_list->kdjabat) == "") { ?>
		<th data-name="kdjabat" class="<?php echo $petri_list->kdjabat->headerCellClass() ?>"><div id="elh_petri_kdjabat" class="petri_kdjabat"><div class="ew-table-header-caption"><?php echo $petri_list->kdjabat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjabat" class="<?php echo $petri_list->kdjabat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->kdjabat) ?>', 1);"><div id="elh_petri_kdjabat" class="petri_kdjabat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->kdjabat->caption() ?></span><span class="ew-table-header-sort"><?php if ($petri_list->kdjabat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->kdjabat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->telp->Visible) { // telp ?>
	<?php if ($petri_list->SortUrl($petri_list->telp) == "") { ?>
		<th data-name="telp" class="<?php echo $petri_list->telp->headerCellClass() ?>"><div id="elh_petri_telp" class="petri_telp"><div class="ew-table-header-caption"><?php echo $petri_list->telp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telp" class="<?php echo $petri_list->telp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->telp) ?>', 1);"><div id="elh_petri_telp" class="petri_telp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->telp->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($petri_list->telp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->telp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->hp->Visible) { // hp ?>
	<?php if ($petri_list->SortUrl($petri_list->hp) == "") { ?>
		<th data-name="hp" class="<?php echo $petri_list->hp->headerCellClass() ?>"><div id="elh_petri_hp" class="petri_hp"><div class="ew-table-header-caption"><?php echo $petri_list->hp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hp" class="<?php echo $petri_list->hp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->hp) ?>', 1);"><div id="elh_petri_hp" class="petri_hp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->hp->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($petri_list->hp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->hp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->_email->Visible) { // email ?>
	<?php if ($petri_list->SortUrl($petri_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $petri_list->_email->headerCellClass() ?>"><div id="elh_petri__email" class="petri__email"><div class="ew-table-header-caption"><?php echo $petri_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $petri_list->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->_email) ?>', 1);"><div id="elh_petri__email" class="petri__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($petri_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->namap->Visible) { // namap ?>
	<?php if ($petri_list->SortUrl($petri_list->namap) == "") { ?>
		<th data-name="namap" class="<?php echo $petri_list->namap->headerCellClass() ?>"><div id="elh_petri_namap" class="petri_namap"><div class="ew-table-header-caption"><?php echo $petri_list->namap->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="namap" class="<?php echo $petri_list->namap->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->namap) ?>', 1);"><div id="elh_petri_namap" class="petri_namap">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->namap->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($petri_list->namap->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->namap->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->kdprop_perusahaan->Visible) { // kdprop_perusahaan ?>
	<?php if ($petri_list->SortUrl($petri_list->kdprop_perusahaan) == "") { ?>
		<th data-name="kdprop_perusahaan" class="<?php echo $petri_list->kdprop_perusahaan->headerCellClass() ?>"><div id="elh_petri_kdprop_perusahaan" class="petri_kdprop_perusahaan"><div class="ew-table-header-caption"><?php echo $petri_list->kdprop_perusahaan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdprop_perusahaan" class="<?php echo $petri_list->kdprop_perusahaan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->kdprop_perusahaan) ?>', 1);"><div id="elh_petri_kdprop_perusahaan" class="petri_kdprop_perusahaan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->kdprop_perusahaan->caption() ?></span><span class="ew-table-header-sort"><?php if ($petri_list->kdprop_perusahaan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->kdprop_perusahaan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->kdkota_perusahaan->Visible) { // kdkota_perusahaan ?>
	<?php if ($petri_list->SortUrl($petri_list->kdkota_perusahaan) == "") { ?>
		<th data-name="kdkota_perusahaan" class="<?php echo $petri_list->kdkota_perusahaan->headerCellClass() ?>"><div id="elh_petri_kdkota_perusahaan" class="petri_kdkota_perusahaan"><div class="ew-table-header-caption"><?php echo $petri_list->kdkota_perusahaan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkota_perusahaan" class="<?php echo $petri_list->kdkota_perusahaan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->kdkota_perusahaan) ?>', 1);"><div id="elh_petri_kdkota_perusahaan" class="petri_kdkota_perusahaan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->kdkota_perusahaan->caption() ?></span><span class="ew-table-header-sort"><?php if ($petri_list->kdkota_perusahaan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->kdkota_perusahaan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->kdkategori->Visible) { // kdkategori ?>
	<?php if ($petri_list->SortUrl($petri_list->kdkategori) == "") { ?>
		<th data-name="kdkategori" class="<?php echo $petri_list->kdkategori->headerCellClass() ?>"><div id="elh_petri_kdkategori" class="petri_kdkategori"><div class="ew-table-header-caption"><?php echo $petri_list->kdkategori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkategori" class="<?php echo $petri_list->kdkategori->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->kdkategori) ?>', 1);"><div id="elh_petri_kdkategori" class="petri_kdkategori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->kdkategori->caption() ?></span><span class="ew-table-header-sort"><?php if ($petri_list->kdkategori->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->kdkategori->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->kdjenis->Visible) { // kdjenis ?>
	<?php if ($petri_list->SortUrl($petri_list->kdjenis) == "") { ?>
		<th data-name="kdjenis" class="<?php echo $petri_list->kdjenis->headerCellClass() ?>"><div id="elh_petri_kdjenis" class="petri_kdjenis"><div class="ew-table-header-caption"><?php echo $petri_list->kdjenis->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjenis" class="<?php echo $petri_list->kdjenis->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->kdjenis) ?>', 1);"><div id="elh_petri_kdjenis" class="petri_kdjenis">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->kdjenis->caption() ?></span><span class="ew-table-header-sort"><?php if ($petri_list->kdjenis->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->kdjenis->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->kdskala->Visible) { // kdskala ?>
	<?php if ($petri_list->SortUrl($petri_list->kdskala) == "") { ?>
		<th data-name="kdskala" class="<?php echo $petri_list->kdskala->headerCellClass() ?>"><div id="elh_petri_kdskala" class="petri_kdskala"><div class="ew-table-header-caption"><?php echo $petri_list->kdskala->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdskala" class="<?php echo $petri_list->kdskala->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->kdskala) ?>', 1);"><div id="elh_petri_kdskala" class="petri_kdskala">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->kdskala->caption() ?></span><span class="ew-table-header-sort"><?php if ($petri_list->kdskala->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->kdskala->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->kdexport->Visible) { // kdexport ?>
	<?php if ($petri_list->SortUrl($petri_list->kdexport) == "") { ?>
		<th data-name="kdexport" class="<?php echo $petri_list->kdexport->headerCellClass() ?>"><div id="elh_petri_kdexport" class="petri_kdexport"><div class="ew-table-header-caption"><?php echo $petri_list->kdexport->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdexport" class="<?php echo $petri_list->kdexport->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->kdexport) ?>', 1);"><div id="elh_petri_kdexport" class="petri_kdexport">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->kdexport->caption() ?></span><span class="ew-table-header-sort"><?php if ($petri_list->kdexport->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->kdexport->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->nexport->Visible) { // nexport ?>
	<?php if ($petri_list->SortUrl($petri_list->nexport) == "") { ?>
		<th data-name="nexport" class="<?php echo $petri_list->nexport->headerCellClass() ?>"><div id="elh_petri_nexport" class="petri_nexport"><div class="ew-table-header-caption"><?php echo $petri_list->nexport->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nexport" class="<?php echo $petri_list->nexport->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->nexport) ?>', 1);"><div id="elh_petri_nexport" class="petri_nexport">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->nexport->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($petri_list->nexport->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->nexport->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->kontak->Visible) { // kontak ?>
	<?php if ($petri_list->SortUrl($petri_list->kontak) == "") { ?>
		<th data-name="kontak" class="<?php echo $petri_list->kontak->headerCellClass() ?>"><div id="elh_petri_kontak" class="petri_kontak"><div class="ew-table-header-caption"><?php echo $petri_list->kontak->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kontak" class="<?php echo $petri_list->kontak->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->kontak) ?>', 1);"><div id="elh_petri_kontak" class="petri_kontak">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->kontak->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($petri_list->kontak->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->kontak->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->independen->Visible) { // independen ?>
	<?php if ($petri_list->SortUrl($petri_list->independen) == "") { ?>
		<th data-name="independen" class="<?php echo $petri_list->independen->headerCellClass() ?>"><div id="elh_petri_independen" class="petri_independen"><div class="ew-table-header-caption"><?php echo $petri_list->independen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="independen" class="<?php echo $petri_list->independen->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->independen) ?>', 1);"><div id="elh_petri_independen" class="petri_independen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->independen->caption() ?></span><span class="ew-table-header-sort"><?php if ($petri_list->independen->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->independen->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->kdproduknafed->Visible) { // kdproduknafed ?>
	<?php if ($petri_list->SortUrl($petri_list->kdproduknafed) == "") { ?>
		<th data-name="kdproduknafed" class="<?php echo $petri_list->kdproduknafed->headerCellClass() ?>"><div id="elh_petri_kdproduknafed" class="petri_kdproduknafed"><div class="ew-table-header-caption"><?php echo $petri_list->kdproduknafed->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdproduknafed" class="<?php echo $petri_list->kdproduknafed->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->kdproduknafed) ?>', 1);"><div id="elh_petri_kdproduknafed" class="petri_kdproduknafed">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->kdproduknafed->caption() ?></span><span class="ew-table-header-sort"><?php if ($petri_list->kdproduknafed->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->kdproduknafed->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->kdproduknafed2->Visible) { // kdproduknafed2 ?>
	<?php if ($petri_list->SortUrl($petri_list->kdproduknafed2) == "") { ?>
		<th data-name="kdproduknafed2" class="<?php echo $petri_list->kdproduknafed2->headerCellClass() ?>"><div id="elh_petri_kdproduknafed2" class="petri_kdproduknafed2"><div class="ew-table-header-caption"><?php echo $petri_list->kdproduknafed2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdproduknafed2" class="<?php echo $petri_list->kdproduknafed2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->kdproduknafed2) ?>', 1);"><div id="elh_petri_kdproduknafed2" class="petri_kdproduknafed2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->kdproduknafed2->caption() ?></span><span class="ew-table-header-sort"><?php if ($petri_list->kdproduknafed2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->kdproduknafed2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->kdproduknafed3->Visible) { // kdproduknafed3 ?>
	<?php if ($petri_list->SortUrl($petri_list->kdproduknafed3) == "") { ?>
		<th data-name="kdproduknafed3" class="<?php echo $petri_list->kdproduknafed3->headerCellClass() ?>"><div id="elh_petri_kdproduknafed3" class="petri_kdproduknafed3"><div class="ew-table-header-caption"><?php echo $petri_list->kdproduknafed3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdproduknafed3" class="<?php echo $petri_list->kdproduknafed3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->kdproduknafed3) ?>', 1);"><div id="elh_petri_kdproduknafed3" class="petri_kdproduknafed3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->kdproduknafed3->caption() ?></span><span class="ew-table-header-sort"><?php if ($petri_list->kdproduknafed3->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->kdproduknafed3->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->pproduk->Visible) { // pproduk ?>
	<?php if ($petri_list->SortUrl($petri_list->pproduk) == "") { ?>
		<th data-name="pproduk" class="<?php echo $petri_list->pproduk->headerCellClass() ?>"><div id="elh_petri_pproduk" class="petri_pproduk"><div class="ew-table-header-caption"><?php echo $petri_list->pproduk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pproduk" class="<?php echo $petri_list->pproduk->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->pproduk) ?>', 1);"><div id="elh_petri_pproduk" class="petri_pproduk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->pproduk->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($petri_list->pproduk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->pproduk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($petri_list->alamatp->Visible) { // alamatp ?>
	<?php if ($petri_list->SortUrl($petri_list->alamatp) == "") { ?>
		<th data-name="alamatp" class="<?php echo $petri_list->alamatp->headerCellClass() ?>"><div id="elh_petri_alamatp" class="petri_alamatp"><div class="ew-table-header-caption"><?php echo $petri_list->alamatp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="alamatp" class="<?php echo $petri_list->alamatp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $petri_list->SortUrl($petri_list->alamatp) ?>', 1);"><div id="elh_petri_alamatp" class="petri_alamatp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $petri_list->alamatp->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($petri_list->alamatp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($petri_list->alamatp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$petri_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($petri_list->ExportAll && $petri_list->isExport()) {
	$petri_list->StopRecord = $petri_list->TotalRecords;
} else {

	// Set the last record to display
	if ($petri_list->TotalRecords > $petri_list->StartRecord + $petri_list->DisplayRecords - 1)
		$petri_list->StopRecord = $petri_list->StartRecord + $petri_list->DisplayRecords - 1;
	else
		$petri_list->StopRecord = $petri_list->TotalRecords;
}
$petri_list->RecordCount = $petri_list->StartRecord - 1;
if ($petri_list->Recordset && !$petri_list->Recordset->EOF) {
	$petri_list->Recordset->moveFirst();
	$selectLimit = $petri_list->UseSelectLimit;
	if (!$selectLimit && $petri_list->StartRecord > 1)
		$petri_list->Recordset->move($petri_list->StartRecord - 1);
} elseif (!$petri->AllowAddDeleteRow && $petri_list->StopRecord == 0) {
	$petri_list->StopRecord = $petri->GridAddRowCount;
}

// Initialize aggregate
$petri->RowType = ROWTYPE_AGGREGATEINIT;
$petri->resetAttributes();
$petri_list->renderRow();
while ($petri_list->RecordCount < $petri_list->StopRecord) {
	$petri_list->RecordCount++;
	if ($petri_list->RecordCount >= $petri_list->StartRecord) {
		$petri_list->RowCount++;

		// Set up key count
		$petri_list->KeyCount = $petri_list->RowIndex;

		// Init row class and style
		$petri->resetAttributes();
		$petri->CssClass = "";
		if ($petri_list->isGridAdd()) {
		} else {
			$petri_list->loadRowValues($petri_list->Recordset); // Load row values
		}
		$petri->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$petri->RowAttrs->merge(["data-rowindex" => $petri_list->RowCount, "id" => "r" . $petri_list->RowCount . "_petri", "data-rowtype" => $petri->RowType]);

		// Render row
		$petri_list->renderRow();

		// Render list options
		$petri_list->renderListOptions();
?>
	<tr <?php echo $petri->rowAttributes() ?>>
<?php

// Render list options (body, left)
$petri_list->ListOptions->render("body", "left", $petri_list->RowCount);
?>
	<?php if ($petri_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $petri_list->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_kdjudul">
<span<?php echo $petri_list->kdjudul->viewAttributes() ?>><?php echo $petri_list->kdjudul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->tawal->Visible) { // tawal ?>
		<td data-name="tawal" <?php echo $petri_list->tawal->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_tawal">
<span<?php echo $petri_list->tawal->viewAttributes() ?>><?php echo $petri_list->tawal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->takhir->Visible) { // takhir ?>
		<td data-name="takhir" <?php echo $petri_list->takhir->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_takhir">
<span<?php echo $petri_list->takhir->viewAttributes() ?>><?php echo $petri_list->takhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $petri_list->nama->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_nama">
<span<?php echo $petri_list->nama->viewAttributes() ?>><?php echo $petri_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" <?php echo $petri_list->kdprop->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_kdprop">
<span<?php echo $petri_list->kdprop->viewAttributes() ?>><?php echo $petri_list->kdprop->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->kdkota->Visible) { // kdkota ?>
		<td data-name="kdkota" <?php echo $petri_list->kdkota->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_kdkota">
<span<?php echo $petri_list->kdkota->viewAttributes() ?>><?php echo $petri_list->kdkota->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->kdsex->Visible) { // kdsex ?>
		<td data-name="kdsex" <?php echo $petri_list->kdsex->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_kdsex">
<span<?php echo $petri_list->kdsex->viewAttributes() ?>><?php echo $petri_list->kdsex->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->kdjabat->Visible) { // kdjabat ?>
		<td data-name="kdjabat" <?php echo $petri_list->kdjabat->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_kdjabat">
<span<?php echo $petri_list->kdjabat->viewAttributes() ?>><?php echo $petri_list->kdjabat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->telp->Visible) { // telp ?>
		<td data-name="telp" <?php echo $petri_list->telp->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_telp">
<span<?php echo $petri_list->telp->viewAttributes() ?>><?php echo $petri_list->telp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->hp->Visible) { // hp ?>
		<td data-name="hp" <?php echo $petri_list->hp->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_hp">
<span<?php echo $petri_list->hp->viewAttributes() ?>><?php echo $petri_list->hp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $petri_list->_email->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri__email">
<span<?php echo $petri_list->_email->viewAttributes() ?>><?php echo $petri_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->namap->Visible) { // namap ?>
		<td data-name="namap" <?php echo $petri_list->namap->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_namap">
<span<?php echo $petri_list->namap->viewAttributes() ?>><?php echo $petri_list->namap->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->kdprop_perusahaan->Visible) { // kdprop_perusahaan ?>
		<td data-name="kdprop_perusahaan" <?php echo $petri_list->kdprop_perusahaan->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_kdprop_perusahaan">
<span<?php echo $petri_list->kdprop_perusahaan->viewAttributes() ?>><?php echo $petri_list->kdprop_perusahaan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->kdkota_perusahaan->Visible) { // kdkota_perusahaan ?>
		<td data-name="kdkota_perusahaan" <?php echo $petri_list->kdkota_perusahaan->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_kdkota_perusahaan">
<span<?php echo $petri_list->kdkota_perusahaan->viewAttributes() ?>><?php echo $petri_list->kdkota_perusahaan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->kdkategori->Visible) { // kdkategori ?>
		<td data-name="kdkategori" <?php echo $petri_list->kdkategori->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_kdkategori">
<span<?php echo $petri_list->kdkategori->viewAttributes() ?>><?php echo $petri_list->kdkategori->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->kdjenis->Visible) { // kdjenis ?>
		<td data-name="kdjenis" <?php echo $petri_list->kdjenis->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_kdjenis">
<span<?php echo $petri_list->kdjenis->viewAttributes() ?>><?php echo $petri_list->kdjenis->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->kdskala->Visible) { // kdskala ?>
		<td data-name="kdskala" <?php echo $petri_list->kdskala->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_kdskala">
<span<?php echo $petri_list->kdskala->viewAttributes() ?>><?php echo $petri_list->kdskala->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->kdexport->Visible) { // kdexport ?>
		<td data-name="kdexport" <?php echo $petri_list->kdexport->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_kdexport">
<span<?php echo $petri_list->kdexport->viewAttributes() ?>><?php echo $petri_list->kdexport->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->nexport->Visible) { // nexport ?>
		<td data-name="nexport" <?php echo $petri_list->nexport->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_nexport">
<span<?php echo $petri_list->nexport->viewAttributes() ?>><?php echo $petri_list->nexport->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->kontak->Visible) { // kontak ?>
		<td data-name="kontak" <?php echo $petri_list->kontak->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_kontak">
<span<?php echo $petri_list->kontak->viewAttributes() ?>><?php echo $petri_list->kontak->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->independen->Visible) { // independen ?>
		<td data-name="independen" <?php echo $petri_list->independen->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_independen">
<span<?php echo $petri_list->independen->viewAttributes() ?>><?php echo $petri_list->independen->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->kdproduknafed->Visible) { // kdproduknafed ?>
		<td data-name="kdproduknafed" <?php echo $petri_list->kdproduknafed->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_kdproduknafed">
<span<?php echo $petri_list->kdproduknafed->viewAttributes() ?>><?php echo $petri_list->kdproduknafed->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->kdproduknafed2->Visible) { // kdproduknafed2 ?>
		<td data-name="kdproduknafed2" <?php echo $petri_list->kdproduknafed2->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_kdproduknafed2">
<span<?php echo $petri_list->kdproduknafed2->viewAttributes() ?>><?php echo $petri_list->kdproduknafed2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->kdproduknafed3->Visible) { // kdproduknafed3 ?>
		<td data-name="kdproduknafed3" <?php echo $petri_list->kdproduknafed3->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_kdproduknafed3">
<span<?php echo $petri_list->kdproduknafed3->viewAttributes() ?>><?php echo $petri_list->kdproduknafed3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->pproduk->Visible) { // pproduk ?>
		<td data-name="pproduk" <?php echo $petri_list->pproduk->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_pproduk">
<span<?php echo $petri_list->pproduk->viewAttributes() ?>><?php echo $petri_list->pproduk->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($petri_list->alamatp->Visible) { // alamatp ?>
		<td data-name="alamatp" <?php echo $petri_list->alamatp->cellAttributes() ?>>
<span id="el<?php echo $petri_list->RowCount ?>_petri_alamatp">
<span<?php echo $petri_list->alamatp->viewAttributes() ?>><?php echo $petri_list->alamatp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$petri_list->ListOptions->render("body", "right", $petri_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$petri_list->isGridAdd())
		$petri_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$petri->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($petri_list->Recordset)
	$petri_list->Recordset->Close();
?>
<?php if (!$petri_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$petri_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $petri_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $petri_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($petri_list->TotalRecords == 0 && !$petri->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $petri_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$petri_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$petri_list->isExport()) { ?>
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
$petri_list->terminate();
?>