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
$v_rencanakerjasama_list = new v_rencanakerjasama_list();

// Run the page
$v_rencanakerjasama_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v_rencanakerjasama_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$v_rencanakerjasama_list->isExport()) { ?>
<script>
var fv_rencanakerjasamalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fv_rencanakerjasamalist = currentForm = new ew.Form("fv_rencanakerjasamalist", "list");
	fv_rencanakerjasamalist.formKeyCountName = '<?php echo $v_rencanakerjasama_list->FormKeyCountName ?>';
	loadjs.done("fv_rencanakerjasamalist");
});
var fv_rencanakerjasamalistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fv_rencanakerjasamalistsrch = currentSearchForm = new ew.Form("fv_rencanakerjasamalistsrch");

	// Validate function for search
	fv_rencanakerjasamalistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_kerjasama");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($v_rencanakerjasama_list->kerjasama->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tahun_rencana");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($v_rencanakerjasama_list->tahun_rencana->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fv_rencanakerjasamalistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fv_rencanakerjasamalistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fv_rencanakerjasamalistsrch.lists["x_kerjasama"] = <?php echo $v_rencanakerjasama_list->kerjasama->Lookup->toClientList($v_rencanakerjasama_list) ?>;
	fv_rencanakerjasamalistsrch.lists["x_kerjasama"].options = <?php echo JsonEncode($v_rencanakerjasama_list->kerjasama->lookupOptions()) ?>;
	fv_rencanakerjasamalistsrch.autoSuggests["x_kerjasama"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fv_rencanakerjasamalistsrch.lists["x_jenispel"] = <?php echo $v_rencanakerjasama_list->jenispel->Lookup->toClientList($v_rencanakerjasama_list) ?>;
	fv_rencanakerjasamalistsrch.lists["x_jenispel"].options = <?php echo JsonEncode($v_rencanakerjasama_list->jenispel->options(FALSE, TRUE)) ?>;
	fv_rencanakerjasamalistsrch.lists["x_kdjudul"] = <?php echo $v_rencanakerjasama_list->kdjudul->Lookup->toClientList($v_rencanakerjasama_list) ?>;
	fv_rencanakerjasamalistsrch.lists["x_kdjudul"].options = <?php echo JsonEncode($v_rencanakerjasama_list->kdjudul->lookupOptions()) ?>;
	fv_rencanakerjasamalistsrch.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

	// Filters
	fv_rencanakerjasamalistsrch.filterList = <?php echo $v_rencanakerjasama_list->getFilterList() ?>;
	loadjs.done("fv_rencanakerjasamalistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$v_rencanakerjasama_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($v_rencanakerjasama_list->TotalRecords > 0 && $v_rencanakerjasama_list->ExportOptions->visible()) { ?>
<?php $v_rencanakerjasama_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($v_rencanakerjasama_list->ImportOptions->visible()) { ?>
<?php $v_rencanakerjasama_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($v_rencanakerjasama_list->SearchOptions->visible()) { ?>
<?php $v_rencanakerjasama_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($v_rencanakerjasama_list->FilterOptions->visible()) { ?>
<?php $v_rencanakerjasama_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$v_rencanakerjasama_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$v_rencanakerjasama_list->isExport() && !$v_rencanakerjasama->CurrentAction) { ?>
<form name="fv_rencanakerjasamalistsrch" id="fv_rencanakerjasamalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fv_rencanakerjasamalistsrch-search-panel" class="<?php echo $v_rencanakerjasama_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="v_rencanakerjasama">
	<div class="ew-extended-search">
<?php

// Render search row
$v_rencanakerjasama->RowType = ROWTYPE_SEARCH;
$v_rencanakerjasama->resetAttributes();
$v_rencanakerjasama_list->renderRow();
?>
<?php if ($v_rencanakerjasama_list->kerjasama->Visible) { // kerjasama ?>
	<?php
		$v_rencanakerjasama_list->SearchColumnCount++;
		if (($v_rencanakerjasama_list->SearchColumnCount - 1) % $v_rencanakerjasama_list->SearchFieldsPerRow == 0) {
			$v_rencanakerjasama_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $v_rencanakerjasama_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kerjasama" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $v_rencanakerjasama_list->kerjasama->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kerjasama" id="z_kerjasama" value="=">
</span>
		<span id="el_v_rencanakerjasama_kerjasama" class="ew-search-field">
<?php
$onchange = $v_rencanakerjasama_list->kerjasama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$v_rencanakerjasama_list->kerjasama->EditAttrs["onchange"] = "";
?>
<span id="as_x_kerjasama">
	<input type="text" class="form-control" name="sv_x_kerjasama" id="sv_x_kerjasama" value="<?php echo RemoveHtml($v_rencanakerjasama_list->kerjasama->EditValue) ?>" size="100" maxlength="30" placeholder="<?php echo HtmlEncode($v_rencanakerjasama_list->kerjasama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($v_rencanakerjasama_list->kerjasama->getPlaceHolder()) ?>"<?php echo $v_rencanakerjasama_list->kerjasama->editAttributes() ?>>
</span>
<input type="hidden" data-table="v_rencanakerjasama" data-field="x_kerjasama" data-value-separator="<?php echo $v_rencanakerjasama_list->kerjasama->displayValueSeparatorAttribute() ?>" name="x_kerjasama" id="x_kerjasama" value="<?php echo HtmlEncode($v_rencanakerjasama_list->kerjasama->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fv_rencanakerjasamalistsrch"], function() {
	fv_rencanakerjasamalistsrch.createAutoSuggest({"id":"x_kerjasama","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $v_rencanakerjasama_list->kerjasama->Lookup->getParamTag($v_rencanakerjasama_list, "p_x_kerjasama") ?>
</span>
	</div>
	<?php if ($v_rencanakerjasama_list->SearchColumnCount % $v_rencanakerjasama_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($v_rencanakerjasama_list->jenispel->Visible) { // jenispel ?>
	<?php
		$v_rencanakerjasama_list->SearchColumnCount++;
		if (($v_rencanakerjasama_list->SearchColumnCount - 1) % $v_rencanakerjasama_list->SearchFieldsPerRow == 0) {
			$v_rencanakerjasama_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $v_rencanakerjasama_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_jenispel" class="ew-cell form-group">
		<label for="x_jenispel" class="ew-search-caption ew-label"><?php echo $v_rencanakerjasama_list->jenispel->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jenispel" id="z_jenispel" value="=">
</span>
		<span id="el_v_rencanakerjasama_jenispel" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="v_rencanakerjasama" data-field="x_jenispel" data-value-separator="<?php echo $v_rencanakerjasama_list->jenispel->displayValueSeparatorAttribute() ?>" id="x_jenispel" name="x_jenispel"<?php echo $v_rencanakerjasama_list->jenispel->editAttributes() ?>>
			<?php echo $v_rencanakerjasama_list->jenispel->selectOptionListHtml("x_jenispel") ?>
		</select>
</div>
</span>
	</div>
	<?php if ($v_rencanakerjasama_list->SearchColumnCount % $v_rencanakerjasama_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($v_rencanakerjasama_list->kdjudul->Visible) { // kdjudul ?>
	<?php
		$v_rencanakerjasama_list->SearchColumnCount++;
		if (($v_rencanakerjasama_list->SearchColumnCount - 1) % $v_rencanakerjasama_list->SearchFieldsPerRow == 0) {
			$v_rencanakerjasama_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $v_rencanakerjasama_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kdjudul" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $v_rencanakerjasama_list->kdjudul->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdjudul" id="z_kdjudul" value="=">
</span>
		<span id="el_v_rencanakerjasama_kdjudul" class="ew-search-field">
<?php
$onchange = $v_rencanakerjasama_list->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$v_rencanakerjasama_list->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($v_rencanakerjasama_list->kdjudul->EditValue) ?>" size="25" placeholder="<?php echo HtmlEncode($v_rencanakerjasama_list->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($v_rencanakerjasama_list->kdjudul->getPlaceHolder()) ?>"<?php echo $v_rencanakerjasama_list->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="v_rencanakerjasama" data-field="x_kdjudul" data-value-separator="<?php echo $v_rencanakerjasama_list->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($v_rencanakerjasama_list->kdjudul->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fv_rencanakerjasamalistsrch"], function() {
	fv_rencanakerjasamalistsrch.createAutoSuggest({"id":"x_kdjudul","forceSelect":false,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $v_rencanakerjasama_list->kdjudul->Lookup->getParamTag($v_rencanakerjasama_list, "p_x_kdjudul") ?>
</span>
	</div>
	<?php if ($v_rencanakerjasama_list->SearchColumnCount % $v_rencanakerjasama_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($v_rencanakerjasama_list->tahun_rencana->Visible) { // tahun_rencana ?>
	<?php
		$v_rencanakerjasama_list->SearchColumnCount++;
		if (($v_rencanakerjasama_list->SearchColumnCount - 1) % $v_rencanakerjasama_list->SearchFieldsPerRow == 0) {
			$v_rencanakerjasama_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $v_rencanakerjasama_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_tahun_rencana" class="ew-cell form-group">
		<label for="x_tahun_rencana" class="ew-search-caption ew-label"><?php echo $v_rencanakerjasama_list->tahun_rencana->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tahun_rencana" id="z_tahun_rencana" value="=">
</span>
		<span id="el_v_rencanakerjasama_tahun_rencana" class="ew-search-field">
<input type="text" data-table="v_rencanakerjasama" data-field="x_tahun_rencana" name="x_tahun_rencana" id="x_tahun_rencana" size="5" maxlength="4" placeholder="<?php echo HtmlEncode($v_rencanakerjasama_list->tahun_rencana->getPlaceHolder()) ?>" value="<?php echo $v_rencanakerjasama_list->tahun_rencana->EditValue ?>"<?php echo $v_rencanakerjasama_list->tahun_rencana->editAttributes() ?>>
</span>
	</div>
	<?php if ($v_rencanakerjasama_list->SearchColumnCount % $v_rencanakerjasama_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($v_rencanakerjasama_list->SearchColumnCount % $v_rencanakerjasama_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $v_rencanakerjasama_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($v_rencanakerjasama_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($v_rencanakerjasama_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $v_rencanakerjasama_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($v_rencanakerjasama_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($v_rencanakerjasama_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($v_rencanakerjasama_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($v_rencanakerjasama_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $v_rencanakerjasama_list->showPageHeader(); ?>
<?php
$v_rencanakerjasama_list->showMessage();
?>
<?php if ($v_rencanakerjasama_list->TotalRecords > 0 || $v_rencanakerjasama->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($v_rencanakerjasama_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> v_rencanakerjasama">
<?php if (!$v_rencanakerjasama_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$v_rencanakerjasama_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $v_rencanakerjasama_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_rencanakerjasama_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fv_rencanakerjasamalist" id="fv_rencanakerjasamalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v_rencanakerjasama">
<div id="gmp_v_rencanakerjasama" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($v_rencanakerjasama_list->TotalRecords > 0 || $v_rencanakerjasama_list->isGridEdit()) { ?>
<table id="tbl_v_rencanakerjasamalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$v_rencanakerjasama->RowType = ROWTYPE_HEADER;

// Render list options
$v_rencanakerjasama_list->renderListOptions();

// Render list options (header, left)
$v_rencanakerjasama_list->ListOptions->render("header", "left");
?>
<?php if ($v_rencanakerjasama_list->kerjasama->Visible) { // kerjasama ?>
	<?php if ($v_rencanakerjasama_list->SortUrl($v_rencanakerjasama_list->kerjasama) == "") { ?>
		<th data-name="kerjasama" class="<?php echo $v_rencanakerjasama_list->kerjasama->headerCellClass() ?>"><div id="elh_v_rencanakerjasama_kerjasama" class="v_rencanakerjasama_kerjasama"><div class="ew-table-header-caption"><?php echo $v_rencanakerjasama_list->kerjasama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kerjasama" class="<?php echo $v_rencanakerjasama_list->kerjasama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_rencanakerjasama_list->SortUrl($v_rencanakerjasama_list->kerjasama) ?>', 1);"><div id="elh_v_rencanakerjasama_kerjasama" class="v_rencanakerjasama_kerjasama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_rencanakerjasama_list->kerjasama->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_rencanakerjasama_list->kerjasama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_rencanakerjasama_list->kerjasama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_rencanakerjasama_list->jenispel->Visible) { // jenispel ?>
	<?php if ($v_rencanakerjasama_list->SortUrl($v_rencanakerjasama_list->jenispel) == "") { ?>
		<th data-name="jenispel" class="<?php echo $v_rencanakerjasama_list->jenispel->headerCellClass() ?>"><div id="elh_v_rencanakerjasama_jenispel" class="v_rencanakerjasama_jenispel"><div class="ew-table-header-caption"><?php echo $v_rencanakerjasama_list->jenispel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenispel" class="<?php echo $v_rencanakerjasama_list->jenispel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_rencanakerjasama_list->SortUrl($v_rencanakerjasama_list->jenispel) ?>', 1);"><div id="elh_v_rencanakerjasama_jenispel" class="v_rencanakerjasama_jenispel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_rencanakerjasama_list->jenispel->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_rencanakerjasama_list->jenispel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_rencanakerjasama_list->jenispel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_rencanakerjasama_list->kdjudul->Visible) { // kdjudul ?>
	<?php if ($v_rencanakerjasama_list->SortUrl($v_rencanakerjasama_list->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $v_rencanakerjasama_list->kdjudul->headerCellClass() ?>"><div id="elh_v_rencanakerjasama_kdjudul" class="v_rencanakerjasama_kdjudul"><div class="ew-table-header-caption"><?php echo $v_rencanakerjasama_list->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $v_rencanakerjasama_list->kdjudul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_rencanakerjasama_list->SortUrl($v_rencanakerjasama_list->kdjudul) ?>', 1);"><div id="elh_v_rencanakerjasama_kdjudul" class="v_rencanakerjasama_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_rencanakerjasama_list->kdjudul->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_rencanakerjasama_list->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_rencanakerjasama_list->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_rencanakerjasama_list->jml_hari->Visible) { // jml_hari ?>
	<?php if ($v_rencanakerjasama_list->SortUrl($v_rencanakerjasama_list->jml_hari) == "") { ?>
		<th data-name="jml_hari" class="<?php echo $v_rencanakerjasama_list->jml_hari->headerCellClass() ?>"><div id="elh_v_rencanakerjasama_jml_hari" class="v_rencanakerjasama_jml_hari"><div class="ew-table-header-caption"><?php echo $v_rencanakerjasama_list->jml_hari->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jml_hari" class="<?php echo $v_rencanakerjasama_list->jml_hari->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_rencanakerjasama_list->SortUrl($v_rencanakerjasama_list->jml_hari) ?>', 1);"><div id="elh_v_rencanakerjasama_jml_hari" class="v_rencanakerjasama_jml_hari">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_rencanakerjasama_list->jml_hari->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_rencanakerjasama_list->jml_hari->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_rencanakerjasama_list->jml_hari->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_rencanakerjasama_list->dana->Visible) { // dana ?>
	<?php if ($v_rencanakerjasama_list->SortUrl($v_rencanakerjasama_list->dana) == "") { ?>
		<th data-name="dana" class="<?php echo $v_rencanakerjasama_list->dana->headerCellClass() ?>"><div id="elh_v_rencanakerjasama_dana" class="v_rencanakerjasama_dana"><div class="ew-table-header-caption"><?php echo $v_rencanakerjasama_list->dana->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="dana" class="<?php echo $v_rencanakerjasama_list->dana->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_rencanakerjasama_list->SortUrl($v_rencanakerjasama_list->dana) ?>', 1);"><div id="elh_v_rencanakerjasama_dana" class="v_rencanakerjasama_dana">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_rencanakerjasama_list->dana->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_rencanakerjasama_list->dana->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_rencanakerjasama_list->dana->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_rencanakerjasama_list->angkatan->Visible) { // angkatan ?>
	<?php if ($v_rencanakerjasama_list->SortUrl($v_rencanakerjasama_list->angkatan) == "") { ?>
		<th data-name="angkatan" class="<?php echo $v_rencanakerjasama_list->angkatan->headerCellClass() ?>"><div id="elh_v_rencanakerjasama_angkatan" class="v_rencanakerjasama_angkatan"><div class="ew-table-header-caption"><?php echo $v_rencanakerjasama_list->angkatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="angkatan" class="<?php echo $v_rencanakerjasama_list->angkatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_rencanakerjasama_list->SortUrl($v_rencanakerjasama_list->angkatan) ?>', 1);"><div id="elh_v_rencanakerjasama_angkatan" class="v_rencanakerjasama_angkatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_rencanakerjasama_list->angkatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_rencanakerjasama_list->angkatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_rencanakerjasama_list->angkatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_rencanakerjasama_list->targetpes->Visible) { // targetpes ?>
	<?php if ($v_rencanakerjasama_list->SortUrl($v_rencanakerjasama_list->targetpes) == "") { ?>
		<th data-name="targetpes" class="<?php echo $v_rencanakerjasama_list->targetpes->headerCellClass() ?>"><div id="elh_v_rencanakerjasama_targetpes" class="v_rencanakerjasama_targetpes"><div class="ew-table-header-caption"><?php echo $v_rencanakerjasama_list->targetpes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes" class="<?php echo $v_rencanakerjasama_list->targetpes->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_rencanakerjasama_list->SortUrl($v_rencanakerjasama_list->targetpes) ?>', 1);"><div id="elh_v_rencanakerjasama_targetpes" class="v_rencanakerjasama_targetpes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_rencanakerjasama_list->targetpes->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_rencanakerjasama_list->targetpes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_rencanakerjasama_list->targetpes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_rencanakerjasama_list->kontak_person->Visible) { // kontak_person ?>
	<?php if ($v_rencanakerjasama_list->SortUrl($v_rencanakerjasama_list->kontak_person) == "") { ?>
		<th data-name="kontak_person" class="<?php echo $v_rencanakerjasama_list->kontak_person->headerCellClass() ?>"><div id="elh_v_rencanakerjasama_kontak_person" class="v_rencanakerjasama_kontak_person"><div class="ew-table-header-caption"><?php echo $v_rencanakerjasama_list->kontak_person->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kontak_person" class="<?php echo $v_rencanakerjasama_list->kontak_person->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_rencanakerjasama_list->SortUrl($v_rencanakerjasama_list->kontak_person) ?>', 1);"><div id="elh_v_rencanakerjasama_kontak_person" class="v_rencanakerjasama_kontak_person">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_rencanakerjasama_list->kontak_person->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_rencanakerjasama_list->kontak_person->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_rencanakerjasama_list->kontak_person->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_rencanakerjasama_list->rpkid->Visible) { // rpkid ?>
	<?php if ($v_rencanakerjasama_list->SortUrl($v_rencanakerjasama_list->rpkid) == "") { ?>
		<th data-name="rpkid" class="<?php echo $v_rencanakerjasama_list->rpkid->headerCellClass() ?>"><div id="elh_v_rencanakerjasama_rpkid" class="v_rencanakerjasama_rpkid"><div class="ew-table-header-caption"><?php echo $v_rencanakerjasama_list->rpkid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rpkid" class="<?php echo $v_rencanakerjasama_list->rpkid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_rencanakerjasama_list->SortUrl($v_rencanakerjasama_list->rpkid) ?>', 1);"><div id="elh_v_rencanakerjasama_rpkid" class="v_rencanakerjasama_rpkid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_rencanakerjasama_list->rpkid->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_rencanakerjasama_list->rpkid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_rencanakerjasama_list->rpkid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_rencanakerjasama_list->tahun_rencana->Visible) { // tahun_rencana ?>
	<?php if ($v_rencanakerjasama_list->SortUrl($v_rencanakerjasama_list->tahun_rencana) == "") { ?>
		<th data-name="tahun_rencana" class="<?php echo $v_rencanakerjasama_list->tahun_rencana->headerCellClass() ?>"><div id="elh_v_rencanakerjasama_tahun_rencana" class="v_rencanakerjasama_tahun_rencana"><div class="ew-table-header-caption"><?php echo $v_rencanakerjasama_list->tahun_rencana->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun_rencana" class="<?php echo $v_rencanakerjasama_list->tahun_rencana->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_rencanakerjasama_list->SortUrl($v_rencanakerjasama_list->tahun_rencana) ?>', 1);"><div id="elh_v_rencanakerjasama_tahun_rencana" class="v_rencanakerjasama_tahun_rencana">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_rencanakerjasama_list->tahun_rencana->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_rencanakerjasama_list->tahun_rencana->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_rencanakerjasama_list->tahun_rencana->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$v_rencanakerjasama_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($v_rencanakerjasama_list->ExportAll && $v_rencanakerjasama_list->isExport()) {
	$v_rencanakerjasama_list->StopRecord = $v_rencanakerjasama_list->TotalRecords;
} else {

	// Set the last record to display
	if ($v_rencanakerjasama_list->TotalRecords > $v_rencanakerjasama_list->StartRecord + $v_rencanakerjasama_list->DisplayRecords - 1)
		$v_rencanakerjasama_list->StopRecord = $v_rencanakerjasama_list->StartRecord + $v_rencanakerjasama_list->DisplayRecords - 1;
	else
		$v_rencanakerjasama_list->StopRecord = $v_rencanakerjasama_list->TotalRecords;
}
$v_rencanakerjasama_list->RecordCount = $v_rencanakerjasama_list->StartRecord - 1;
if ($v_rencanakerjasama_list->Recordset && !$v_rencanakerjasama_list->Recordset->EOF) {
	$v_rencanakerjasama_list->Recordset->moveFirst();
	$selectLimit = $v_rencanakerjasama_list->UseSelectLimit;
	if (!$selectLimit && $v_rencanakerjasama_list->StartRecord > 1)
		$v_rencanakerjasama_list->Recordset->move($v_rencanakerjasama_list->StartRecord - 1);
} elseif (!$v_rencanakerjasama->AllowAddDeleteRow && $v_rencanakerjasama_list->StopRecord == 0) {
	$v_rencanakerjasama_list->StopRecord = $v_rencanakerjasama->GridAddRowCount;
}

// Initialize aggregate
$v_rencanakerjasama->RowType = ROWTYPE_AGGREGATEINIT;
$v_rencanakerjasama->resetAttributes();
$v_rencanakerjasama_list->renderRow();
while ($v_rencanakerjasama_list->RecordCount < $v_rencanakerjasama_list->StopRecord) {
	$v_rencanakerjasama_list->RecordCount++;
	if ($v_rencanakerjasama_list->RecordCount >= $v_rencanakerjasama_list->StartRecord) {
		$v_rencanakerjasama_list->RowCount++;

		// Set up key count
		$v_rencanakerjasama_list->KeyCount = $v_rencanakerjasama_list->RowIndex;

		// Init row class and style
		$v_rencanakerjasama->resetAttributes();
		$v_rencanakerjasama->CssClass = "";
		if ($v_rencanakerjasama_list->isGridAdd()) {
		} else {
			$v_rencanakerjasama_list->loadRowValues($v_rencanakerjasama_list->Recordset); // Load row values
		}
		$v_rencanakerjasama->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$v_rencanakerjasama->RowAttrs->merge(["data-rowindex" => $v_rencanakerjasama_list->RowCount, "id" => "r" . $v_rencanakerjasama_list->RowCount . "_v_rencanakerjasama", "data-rowtype" => $v_rencanakerjasama->RowType]);

		// Render row
		$v_rencanakerjasama_list->renderRow();

		// Render list options
		$v_rencanakerjasama_list->renderListOptions();
?>
	<tr <?php echo $v_rencanakerjasama->rowAttributes() ?>>
<?php

// Render list options (body, left)
$v_rencanakerjasama_list->ListOptions->render("body", "left", $v_rencanakerjasama_list->RowCount);
?>
	<?php if ($v_rencanakerjasama_list->kerjasama->Visible) { // kerjasama ?>
		<td data-name="kerjasama" <?php echo $v_rencanakerjasama_list->kerjasama->cellAttributes() ?>>
<span id="el<?php echo $v_rencanakerjasama_list->RowCount ?>_v_rencanakerjasama_kerjasama">
<span<?php echo $v_rencanakerjasama_list->kerjasama->viewAttributes() ?>><?php echo $v_rencanakerjasama_list->kerjasama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_rencanakerjasama_list->jenispel->Visible) { // jenispel ?>
		<td data-name="jenispel" <?php echo $v_rencanakerjasama_list->jenispel->cellAttributes() ?>>
<span id="el<?php echo $v_rencanakerjasama_list->RowCount ?>_v_rencanakerjasama_jenispel">
<span<?php echo $v_rencanakerjasama_list->jenispel->viewAttributes() ?>><?php echo $v_rencanakerjasama_list->jenispel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_rencanakerjasama_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $v_rencanakerjasama_list->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $v_rencanakerjasama_list->RowCount ?>_v_rencanakerjasama_kdjudul">
<span<?php echo $v_rencanakerjasama_list->kdjudul->viewAttributes() ?>><?php echo $v_rencanakerjasama_list->kdjudul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_rencanakerjasama_list->jml_hari->Visible) { // jml_hari ?>
		<td data-name="jml_hari" <?php echo $v_rencanakerjasama_list->jml_hari->cellAttributes() ?>>
<span id="el<?php echo $v_rencanakerjasama_list->RowCount ?>_v_rencanakerjasama_jml_hari">
<span<?php echo $v_rencanakerjasama_list->jml_hari->viewAttributes() ?>><?php echo $v_rencanakerjasama_list->jml_hari->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_rencanakerjasama_list->dana->Visible) { // dana ?>
		<td data-name="dana" <?php echo $v_rencanakerjasama_list->dana->cellAttributes() ?>>
<span id="el<?php echo $v_rencanakerjasama_list->RowCount ?>_v_rencanakerjasama_dana">
<span<?php echo $v_rencanakerjasama_list->dana->viewAttributes() ?>><?php echo $v_rencanakerjasama_list->dana->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_rencanakerjasama_list->angkatan->Visible) { // angkatan ?>
		<td data-name="angkatan" <?php echo $v_rencanakerjasama_list->angkatan->cellAttributes() ?>>
<span id="el<?php echo $v_rencanakerjasama_list->RowCount ?>_v_rencanakerjasama_angkatan">
<span<?php echo $v_rencanakerjasama_list->angkatan->viewAttributes() ?>><?php echo $v_rencanakerjasama_list->angkatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_rencanakerjasama_list->targetpes->Visible) { // targetpes ?>
		<td data-name="targetpes" <?php echo $v_rencanakerjasama_list->targetpes->cellAttributes() ?>>
<span id="el<?php echo $v_rencanakerjasama_list->RowCount ?>_v_rencanakerjasama_targetpes">
<span<?php echo $v_rencanakerjasama_list->targetpes->viewAttributes() ?>><?php echo $v_rencanakerjasama_list->targetpes->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_rencanakerjasama_list->kontak_person->Visible) { // kontak_person ?>
		<td data-name="kontak_person" <?php echo $v_rencanakerjasama_list->kontak_person->cellAttributes() ?>>
<span id="el<?php echo $v_rencanakerjasama_list->RowCount ?>_v_rencanakerjasama_kontak_person">
<span<?php echo $v_rencanakerjasama_list->kontak_person->viewAttributes() ?>><?php echo $v_rencanakerjasama_list->kontak_person->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_rencanakerjasama_list->rpkid->Visible) { // rpkid ?>
		<td data-name="rpkid" <?php echo $v_rencanakerjasama_list->rpkid->cellAttributes() ?>>
<span id="el<?php echo $v_rencanakerjasama_list->RowCount ?>_v_rencanakerjasama_rpkid">
<span<?php echo $v_rencanakerjasama_list->rpkid->viewAttributes() ?>><?php echo $v_rencanakerjasama_list->rpkid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_rencanakerjasama_list->tahun_rencana->Visible) { // tahun_rencana ?>
		<td data-name="tahun_rencana" <?php echo $v_rencanakerjasama_list->tahun_rencana->cellAttributes() ?>>
<span id="el<?php echo $v_rencanakerjasama_list->RowCount ?>_v_rencanakerjasama_tahun_rencana">
<span<?php echo $v_rencanakerjasama_list->tahun_rencana->viewAttributes() ?>><?php echo $v_rencanakerjasama_list->tahun_rencana->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$v_rencanakerjasama_list->ListOptions->render("body", "right", $v_rencanakerjasama_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$v_rencanakerjasama_list->isGridAdd())
		$v_rencanakerjasama_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$v_rencanakerjasama->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($v_rencanakerjasama_list->Recordset)
	$v_rencanakerjasama_list->Recordset->Close();
?>
<?php if (!$v_rencanakerjasama_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$v_rencanakerjasama_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $v_rencanakerjasama_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_rencanakerjasama_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($v_rencanakerjasama_list->TotalRecords == 0 && !$v_rencanakerjasama->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $v_rencanakerjasama_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$v_rencanakerjasama_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$v_rencanakerjasama_list->isExport()) { ?>
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
$v_rencanakerjasama_list->terminate();
?>