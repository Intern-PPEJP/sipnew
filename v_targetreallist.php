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
$v_targetreal_list = new v_targetreal_list();

// Run the page
$v_targetreal_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v_targetreal_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$v_targetreal_list->isExport()) { ?>
<script>
var fv_targetreallist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fv_targetreallist = currentForm = new ew.Form("fv_targetreallist", "list");
	fv_targetreallist.formKeyCountName = '<?php echo $v_targetreal_list->FormKeyCountName ?>';
	loadjs.done("fv_targetreallist");
});
var fv_targetreallistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fv_targetreallistsrch = currentSearchForm = new ew.Form("fv_targetreallistsrch");

	// Validate function for search
	fv_targetreallistsrch.validate = function(fobj) {
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
	fv_targetreallistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fv_targetreallistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fv_targetreallistsrch.lists["x_kdjudul"] = <?php echo $v_targetreal_list->kdjudul->Lookup->toClientList($v_targetreal_list) ?>;
	fv_targetreallistsrch.lists["x_kdjudul"].options = <?php echo JsonEncode($v_targetreal_list->kdjudul->lookupOptions()) ?>;
	fv_targetreallistsrch.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

	// Filters
	fv_targetreallistsrch.filterList = <?php echo $v_targetreal_list->getFilterList() ?>;
	loadjs.done("fv_targetreallistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$v_targetreal_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($v_targetreal_list->TotalRecords > 0 && $v_targetreal_list->ExportOptions->visible()) { ?>
<?php $v_targetreal_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($v_targetreal_list->ImportOptions->visible()) { ?>
<?php $v_targetreal_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($v_targetreal_list->SearchOptions->visible()) { ?>
<?php $v_targetreal_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($v_targetreal_list->FilterOptions->visible()) { ?>
<?php $v_targetreal_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$v_targetreal_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$v_targetreal_list->isExport() && !$v_targetreal->CurrentAction) { ?>
<form name="fv_targetreallistsrch" id="fv_targetreallistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fv_targetreallistsrch-search-panel" class="<?php echo $v_targetreal_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="v_targetreal">
	<div class="ew-extended-search">
<?php

// Render search row
$v_targetreal->RowType = ROWTYPE_SEARCH;
$v_targetreal->resetAttributes();
$v_targetreal_list->renderRow();
?>
<?php if ($v_targetreal_list->kdjudul->Visible) { // kdjudul ?>
	<?php
		$v_targetreal_list->SearchColumnCount++;
		if (($v_targetreal_list->SearchColumnCount - 1) % $v_targetreal_list->SearchFieldsPerRow == 0) {
			$v_targetreal_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $v_targetreal_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kdjudul" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $v_targetreal_list->kdjudul->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdjudul" id="z_kdjudul" value="=">
</span>
		<span id="el_v_targetreal_kdjudul" class="ew-search-field">
<?php
$onchange = $v_targetreal_list->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$v_targetreal_list->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($v_targetreal_list->kdjudul->EditValue) ?>" size="100" placeholder="<?php echo HtmlEncode($v_targetreal_list->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($v_targetreal_list->kdjudul->getPlaceHolder()) ?>"<?php echo $v_targetreal_list->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="v_targetreal" data-field="x_kdjudul" data-value-separator="<?php echo $v_targetreal_list->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($v_targetreal_list->kdjudul->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fv_targetreallistsrch"], function() {
	fv_targetreallistsrch.createAutoSuggest({"id":"x_kdjudul","forceSelect":false,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $v_targetreal_list->kdjudul->Lookup->getParamTag($v_targetreal_list, "p_x_kdjudul") ?>
</span>
	</div>
	<?php if ($v_targetreal_list->SearchColumnCount % $v_targetreal_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($v_targetreal_list->SearchColumnCount % $v_targetreal_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $v_targetreal_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($v_targetreal_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($v_targetreal_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $v_targetreal_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($v_targetreal_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($v_targetreal_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($v_targetreal_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($v_targetreal_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $v_targetreal_list->showPageHeader(); ?>
<?php
$v_targetreal_list->showMessage();
?>
<?php if ($v_targetreal_list->TotalRecords > 0 || $v_targetreal->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($v_targetreal_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> v_targetreal">
<?php if (!$v_targetreal_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$v_targetreal_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $v_targetreal_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_targetreal_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fv_targetreallist" id="fv_targetreallist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v_targetreal">
<div id="gmp_v_targetreal" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($v_targetreal_list->TotalRecords > 0 || $v_targetreal_list->isGridEdit()) { ?>
<table id="tbl_v_targetreallist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$v_targetreal->RowType = ROWTYPE_HEADER;

// Render list options
$v_targetreal_list->renderListOptions();

// Render list options (header, left)
$v_targetreal_list->ListOptions->render("header", "left");
?>
<?php if ($v_targetreal_list->idpelat->Visible) { // idpelat ?>
	<?php if ($v_targetreal_list->SortUrl($v_targetreal_list->idpelat) == "") { ?>
		<th data-name="idpelat" class="<?php echo $v_targetreal_list->idpelat->headerCellClass() ?>"><div id="elh_v_targetreal_idpelat" class="v_targetreal_idpelat"><div class="ew-table-header-caption"><?php echo $v_targetreal_list->idpelat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idpelat" class="<?php echo $v_targetreal_list->idpelat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_targetreal_list->SortUrl($v_targetreal_list->idpelat) ?>', 1);"><div id="elh_v_targetreal_idpelat" class="v_targetreal_idpelat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_targetreal_list->idpelat->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_targetreal_list->idpelat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_targetreal_list->idpelat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_targetreal_list->kdpelat->Visible) { // kdpelat ?>
	<?php if ($v_targetreal_list->SortUrl($v_targetreal_list->kdpelat) == "") { ?>
		<th data-name="kdpelat" class="<?php echo $v_targetreal_list->kdpelat->headerCellClass() ?>"><div id="elh_v_targetreal_kdpelat" class="v_targetreal_kdpelat"><div class="ew-table-header-caption"><?php echo $v_targetreal_list->kdpelat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdpelat" class="<?php echo $v_targetreal_list->kdpelat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_targetreal_list->SortUrl($v_targetreal_list->kdpelat) ?>', 1);"><div id="elh_v_targetreal_kdpelat" class="v_targetreal_kdpelat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_targetreal_list->kdpelat->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_targetreal_list->kdpelat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_targetreal_list->kdpelat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_targetreal_list->kdjudul->Visible) { // kdjudul ?>
	<?php if ($v_targetreal_list->SortUrl($v_targetreal_list->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $v_targetreal_list->kdjudul->headerCellClass() ?>"><div id="elh_v_targetreal_kdjudul" class="v_targetreal_kdjudul"><div class="ew-table-header-caption"><?php echo $v_targetreal_list->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $v_targetreal_list->kdjudul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_targetreal_list->SortUrl($v_targetreal_list->kdjudul) ?>', 1);"><div id="elh_v_targetreal_kdjudul" class="v_targetreal_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_targetreal_list->kdjudul->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_targetreal_list->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_targetreal_list->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_targetreal_list->kdprop->Visible) { // kdprop ?>
	<?php if ($v_targetreal_list->SortUrl($v_targetreal_list->kdprop) == "") { ?>
		<th data-name="kdprop" class="<?php echo $v_targetreal_list->kdprop->headerCellClass() ?>"><div id="elh_v_targetreal_kdprop" class="v_targetreal_kdprop"><div class="ew-table-header-caption"><?php echo $v_targetreal_list->kdprop->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdprop" class="<?php echo $v_targetreal_list->kdprop->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_targetreal_list->SortUrl($v_targetreal_list->kdprop) ?>', 1);"><div id="elh_v_targetreal_kdprop" class="v_targetreal_kdprop">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_targetreal_list->kdprop->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_targetreal_list->kdprop->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_targetreal_list->kdprop->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_targetreal_list->targetpes->Visible) { // targetpes ?>
	<?php if ($v_targetreal_list->SortUrl($v_targetreal_list->targetpes) == "") { ?>
		<th data-name="targetpes" class="<?php echo $v_targetreal_list->targetpes->headerCellClass() ?>"><div id="elh_v_targetreal_targetpes" class="v_targetreal_targetpes"><div class="ew-table-header-caption"><?php echo $v_targetreal_list->targetpes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes" class="<?php echo $v_targetreal_list->targetpes->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_targetreal_list->SortUrl($v_targetreal_list->targetpes) ?>', 1);"><div id="elh_v_targetreal_targetpes" class="v_targetreal_targetpes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_targetreal_list->targetpes->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_targetreal_list->targetpes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_targetreal_list->targetpes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_targetreal_list->durasi->Visible) { // durasi ?>
	<?php if ($v_targetreal_list->SortUrl($v_targetreal_list->durasi) == "") { ?>
		<th data-name="durasi" class="<?php echo $v_targetreal_list->durasi->headerCellClass() ?>"><div id="elh_v_targetreal_durasi" class="v_targetreal_durasi"><div class="ew-table-header-caption"><?php echo $v_targetreal_list->durasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="durasi" class="<?php echo $v_targetreal_list->durasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_targetreal_list->SortUrl($v_targetreal_list->durasi) ?>', 1);"><div id="elh_v_targetreal_durasi" class="v_targetreal_durasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_targetreal_list->durasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_targetreal_list->durasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_targetreal_list->durasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_targetreal_list->real_peserta->Visible) { // real_peserta ?>
	<?php if ($v_targetreal_list->SortUrl($v_targetreal_list->real_peserta) == "") { ?>
		<th data-name="real_peserta" class="<?php echo $v_targetreal_list->real_peserta->headerCellClass() ?>"><div id="elh_v_targetreal_real_peserta" class="v_targetreal_real_peserta"><div class="ew-table-header-caption"><?php echo $v_targetreal_list->real_peserta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="real_peserta" class="<?php echo $v_targetreal_list->real_peserta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_targetreal_list->SortUrl($v_targetreal_list->real_peserta) ?>', 1);"><div id="elh_v_targetreal_real_peserta" class="v_targetreal_real_peserta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_targetreal_list->real_peserta->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_targetreal_list->real_peserta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_targetreal_list->real_peserta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_targetreal_list->c_angk->Visible) { // c_angk ?>
	<?php if ($v_targetreal_list->SortUrl($v_targetreal_list->c_angk) == "") { ?>
		<th data-name="c_angk" class="<?php echo $v_targetreal_list->c_angk->headerCellClass() ?>"><div id="elh_v_targetreal_c_angk" class="v_targetreal_c_angk"><div class="ew-table-header-caption"><?php echo $v_targetreal_list->c_angk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="c_angk" class="<?php echo $v_targetreal_list->c_angk->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_targetreal_list->SortUrl($v_targetreal_list->c_angk) ?>', 1);"><div id="elh_v_targetreal_c_angk" class="v_targetreal_c_angk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_targetreal_list->c_angk->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_targetreal_list->c_angk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_targetreal_list->c_angk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_targetreal_list->tawal->Visible) { // tawal ?>
	<?php if ($v_targetreal_list->SortUrl($v_targetreal_list->tawal) == "") { ?>
		<th data-name="tawal" class="<?php echo $v_targetreal_list->tawal->headerCellClass() ?>"><div id="elh_v_targetreal_tawal" class="v_targetreal_tawal"><div class="ew-table-header-caption"><?php echo $v_targetreal_list->tawal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tawal" class="<?php echo $v_targetreal_list->tawal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_targetreal_list->SortUrl($v_targetreal_list->tawal) ?>', 1);"><div id="elh_v_targetreal_tawal" class="v_targetreal_tawal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_targetreal_list->tawal->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_targetreal_list->tawal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_targetreal_list->tawal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$v_targetreal_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($v_targetreal_list->ExportAll && $v_targetreal_list->isExport()) {
	$v_targetreal_list->StopRecord = $v_targetreal_list->TotalRecords;
} else {

	// Set the last record to display
	if ($v_targetreal_list->TotalRecords > $v_targetreal_list->StartRecord + $v_targetreal_list->DisplayRecords - 1)
		$v_targetreal_list->StopRecord = $v_targetreal_list->StartRecord + $v_targetreal_list->DisplayRecords - 1;
	else
		$v_targetreal_list->StopRecord = $v_targetreal_list->TotalRecords;
}
$v_targetreal_list->RecordCount = $v_targetreal_list->StartRecord - 1;
if ($v_targetreal_list->Recordset && !$v_targetreal_list->Recordset->EOF) {
	$v_targetreal_list->Recordset->moveFirst();
	$selectLimit = $v_targetreal_list->UseSelectLimit;
	if (!$selectLimit && $v_targetreal_list->StartRecord > 1)
		$v_targetreal_list->Recordset->move($v_targetreal_list->StartRecord - 1);
} elseif (!$v_targetreal->AllowAddDeleteRow && $v_targetreal_list->StopRecord == 0) {
	$v_targetreal_list->StopRecord = $v_targetreal->GridAddRowCount;
}

// Initialize aggregate
$v_targetreal->RowType = ROWTYPE_AGGREGATEINIT;
$v_targetreal->resetAttributes();
$v_targetreal_list->renderRow();
while ($v_targetreal_list->RecordCount < $v_targetreal_list->StopRecord) {
	$v_targetreal_list->RecordCount++;
	if ($v_targetreal_list->RecordCount >= $v_targetreal_list->StartRecord) {
		$v_targetreal_list->RowCount++;

		// Set up key count
		$v_targetreal_list->KeyCount = $v_targetreal_list->RowIndex;

		// Init row class and style
		$v_targetreal->resetAttributes();
		$v_targetreal->CssClass = "";
		if ($v_targetreal_list->isGridAdd()) {
		} else {
			$v_targetreal_list->loadRowValues($v_targetreal_list->Recordset); // Load row values
		}
		$v_targetreal->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$v_targetreal->RowAttrs->merge(["data-rowindex" => $v_targetreal_list->RowCount, "id" => "r" . $v_targetreal_list->RowCount . "_v_targetreal", "data-rowtype" => $v_targetreal->RowType]);

		// Render row
		$v_targetreal_list->renderRow();

		// Render list options
		$v_targetreal_list->renderListOptions();
?>
	<tr <?php echo $v_targetreal->rowAttributes() ?>>
<?php

// Render list options (body, left)
$v_targetreal_list->ListOptions->render("body", "left", $v_targetreal_list->RowCount);
?>
	<?php if ($v_targetreal_list->idpelat->Visible) { // idpelat ?>
		<td data-name="idpelat" <?php echo $v_targetreal_list->idpelat->cellAttributes() ?>>
<span id="el<?php echo $v_targetreal_list->RowCount ?>_v_targetreal_idpelat">
<span<?php echo $v_targetreal_list->idpelat->viewAttributes() ?>><?php echo $v_targetreal_list->idpelat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_targetreal_list->kdpelat->Visible) { // kdpelat ?>
		<td data-name="kdpelat" <?php echo $v_targetreal_list->kdpelat->cellAttributes() ?>>
<span id="el<?php echo $v_targetreal_list->RowCount ?>_v_targetreal_kdpelat">
<span<?php echo $v_targetreal_list->kdpelat->viewAttributes() ?>><?php echo $v_targetreal_list->kdpelat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_targetreal_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $v_targetreal_list->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $v_targetreal_list->RowCount ?>_v_targetreal_kdjudul">
<span<?php echo $v_targetreal_list->kdjudul->viewAttributes() ?>><?php echo $v_targetreal_list->kdjudul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_targetreal_list->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" <?php echo $v_targetreal_list->kdprop->cellAttributes() ?>>
<span id="el<?php echo $v_targetreal_list->RowCount ?>_v_targetreal_kdprop">
<span<?php echo $v_targetreal_list->kdprop->viewAttributes() ?>><?php echo $v_targetreal_list->kdprop->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_targetreal_list->targetpes->Visible) { // targetpes ?>
		<td data-name="targetpes" <?php echo $v_targetreal_list->targetpes->cellAttributes() ?>>
<span id="el<?php echo $v_targetreal_list->RowCount ?>_v_targetreal_targetpes">
<span<?php echo $v_targetreal_list->targetpes->viewAttributes() ?>><?php echo $v_targetreal_list->targetpes->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_targetreal_list->durasi->Visible) { // durasi ?>
		<td data-name="durasi" <?php echo $v_targetreal_list->durasi->cellAttributes() ?>>
<span id="el<?php echo $v_targetreal_list->RowCount ?>_v_targetreal_durasi">
<span<?php echo $v_targetreal_list->durasi->viewAttributes() ?>><?php echo $v_targetreal_list->durasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_targetreal_list->real_peserta->Visible) { // real_peserta ?>
		<td data-name="real_peserta" <?php echo $v_targetreal_list->real_peserta->cellAttributes() ?>>
<span id="el<?php echo $v_targetreal_list->RowCount ?>_v_targetreal_real_peserta">
<span<?php echo $v_targetreal_list->real_peserta->viewAttributes() ?>><?php echo $v_targetreal_list->real_peserta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_targetreal_list->c_angk->Visible) { // c_angk ?>
		<td data-name="c_angk" <?php echo $v_targetreal_list->c_angk->cellAttributes() ?>>
<span id="el<?php echo $v_targetreal_list->RowCount ?>_v_targetreal_c_angk">
<span<?php echo $v_targetreal_list->c_angk->viewAttributes() ?>><?php echo $v_targetreal_list->c_angk->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_targetreal_list->tawal->Visible) { // tawal ?>
		<td data-name="tawal" <?php echo $v_targetreal_list->tawal->cellAttributes() ?>>
<span id="el<?php echo $v_targetreal_list->RowCount ?>_v_targetreal_tawal">
<span<?php echo $v_targetreal_list->tawal->viewAttributes() ?>><?php echo $v_targetreal_list->tawal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$v_targetreal_list->ListOptions->render("body", "right", $v_targetreal_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$v_targetreal_list->isGridAdd())
		$v_targetreal_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$v_targetreal->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($v_targetreal_list->Recordset)
	$v_targetreal_list->Recordset->Close();
?>
<?php if (!$v_targetreal_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$v_targetreal_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $v_targetreal_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_targetreal_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($v_targetreal_list->TotalRecords == 0 && !$v_targetreal->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $v_targetreal_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$v_targetreal_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$v_targetreal_list->isExport()) { ?>
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
$v_targetreal_list->terminate();
?>