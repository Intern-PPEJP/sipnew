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
$cv_coachingprogram_list = new cv_coachingprogram_list();

// Run the page
$cv_coachingprogram_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cv_coachingprogram_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cv_coachingprogram_list->isExport()) { ?>
<script>
var fcv_coachingprogramlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcv_coachingprogramlist = currentForm = new ew.Form("fcv_coachingprogramlist", "list");
	fcv_coachingprogramlist.formKeyCountName = '<?php echo $cv_coachingprogram_list->FormKeyCountName ?>';
	loadjs.done("fcv_coachingprogramlist");
});
var fcv_coachingprogramlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcv_coachingprogramlistsrch = currentSearchForm = new ew.Form("fcv_coachingprogramlistsrch");

	// Validate function for search
	fcv_coachingprogramlistsrch.validate = function(fobj) {
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
	fcv_coachingprogramlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcv_coachingprogramlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcv_coachingprogramlistsrch.lists["x_kdjudul"] = <?php echo $cv_coachingprogram_list->kdjudul->Lookup->toClientList($cv_coachingprogram_list) ?>;
	fcv_coachingprogramlistsrch.lists["x_kdjudul"].options = <?php echo JsonEncode($cv_coachingprogram_list->kdjudul->lookupOptions()) ?>;
	fcv_coachingprogramlistsrch.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcv_coachingprogramlistsrch.lists["x_kdprop"] = <?php echo $cv_coachingprogram_list->kdprop->Lookup->toClientList($cv_coachingprogram_list) ?>;
	fcv_coachingprogramlistsrch.lists["x_kdprop"].options = <?php echo JsonEncode($cv_coachingprogram_list->kdprop->lookupOptions()) ?>;
	fcv_coachingprogramlistsrch.lists["x_kdkota"] = <?php echo $cv_coachingprogram_list->kdkota->Lookup->toClientList($cv_coachingprogram_list) ?>;
	fcv_coachingprogramlistsrch.lists["x_kdkota"].options = <?php echo JsonEncode($cv_coachingprogram_list->kdkota->lookupOptions()) ?>;

	// Filters
	fcv_coachingprogramlistsrch.filterList = <?php echo $cv_coachingprogram_list->getFilterList() ?>;
	loadjs.done("fcv_coachingprogramlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$cv_coachingprogram_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cv_coachingprogram_list->TotalRecords > 0 && $cv_coachingprogram_list->ExportOptions->visible()) { ?>
<?php $cv_coachingprogram_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cv_coachingprogram_list->ImportOptions->visible()) { ?>
<?php $cv_coachingprogram_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($cv_coachingprogram_list->SearchOptions->visible()) { ?>
<?php $cv_coachingprogram_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($cv_coachingprogram_list->FilterOptions->visible()) { ?>
<?php $cv_coachingprogram_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$cv_coachingprogram_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$cv_coachingprogram_list->isExport() && !$cv_coachingprogram->CurrentAction) { ?>
<form name="fcv_coachingprogramlistsrch" id="fcv_coachingprogramlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcv_coachingprogramlistsrch-search-panel" class="<?php echo $cv_coachingprogram_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cv_coachingprogram">
	<div class="ew-extended-search">
<?php

// Render search row
$cv_coachingprogram->RowType = ROWTYPE_SEARCH;
$cv_coachingprogram->resetAttributes();
$cv_coachingprogram_list->renderRow();
?>
<?php if ($cv_coachingprogram_list->kdjudul->Visible) { // kdjudul ?>
	<?php
		$cv_coachingprogram_list->SearchColumnCount++;
		if (($cv_coachingprogram_list->SearchColumnCount - 1) % $cv_coachingprogram_list->SearchFieldsPerRow == 0) {
			$cv_coachingprogram_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $cv_coachingprogram_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kdjudul" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $cv_coachingprogram_list->kdjudul->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_kdjudul" id="z_kdjudul" value="LIKE">
</span>
		<span id="el_cv_coachingprogram_kdjudul" class="ew-search-field">
<?php
$onchange = $cv_coachingprogram_list->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_coachingprogram_list->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($cv_coachingprogram_list->kdjudul->EditValue) ?>" size="100" placeholder="<?php echo HtmlEncode($cv_coachingprogram_list->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_coachingprogram_list->kdjudul->getPlaceHolder()) ?>"<?php echo $cv_coachingprogram_list->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="cv_coachingprogram" data-field="x_kdjudul" data-value-separator="<?php echo $cv_coachingprogram_list->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($cv_coachingprogram_list->kdjudul->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_coachingprogramlistsrch"], function() {
	fcv_coachingprogramlistsrch.createAutoSuggest({"id":"x_kdjudul","forceSelect":false,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $cv_coachingprogram_list->kdjudul->Lookup->getParamTag($cv_coachingprogram_list, "p_x_kdjudul") ?>
</span>
	</div>
	<?php if ($cv_coachingprogram_list->SearchColumnCount % $cv_coachingprogram_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($cv_coachingprogram_list->kdprop->Visible) { // kdprop ?>
	<?php
		$cv_coachingprogram_list->SearchColumnCount++;
		if (($cv_coachingprogram_list->SearchColumnCount - 1) % $cv_coachingprogram_list->SearchFieldsPerRow == 0) {
			$cv_coachingprogram_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $cv_coachingprogram_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kdprop" class="ew-cell form-group">
		<label for="x_kdprop" class="ew-search-caption ew-label"><?php echo $cv_coachingprogram_list->kdprop->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdprop" id="z_kdprop" value="=">
</span>
		<span id="el_cv_coachingprogram_kdprop" class="ew-search-field">
<?php $cv_coachingprogram_list->kdprop->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cv_coachingprogram" data-field="x_kdprop" data-value-separator="<?php echo $cv_coachingprogram_list->kdprop->displayValueSeparatorAttribute() ?>" id="x_kdprop" name="x_kdprop"<?php echo $cv_coachingprogram_list->kdprop->editAttributes() ?>>
			<?php echo $cv_coachingprogram_list->kdprop->selectOptionListHtml("x_kdprop") ?>
		</select>
</div>
<?php echo $cv_coachingprogram_list->kdprop->Lookup->getParamTag($cv_coachingprogram_list, "p_x_kdprop") ?>
</span>
	</div>
	<?php if ($cv_coachingprogram_list->SearchColumnCount % $cv_coachingprogram_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($cv_coachingprogram_list->kdkota->Visible) { // kdkota ?>
	<?php
		$cv_coachingprogram_list->SearchColumnCount++;
		if (($cv_coachingprogram_list->SearchColumnCount - 1) % $cv_coachingprogram_list->SearchFieldsPerRow == 0) {
			$cv_coachingprogram_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $cv_coachingprogram_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kdkota" class="ew-cell form-group">
		<label for="x_kdkota" class="ew-search-caption ew-label"><?php echo $cv_coachingprogram_list->kdkota->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdkota" id="z_kdkota" value="=">
</span>
		<span id="el_cv_coachingprogram_kdkota" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cv_coachingprogram" data-field="x_kdkota" data-value-separator="<?php echo $cv_coachingprogram_list->kdkota->displayValueSeparatorAttribute() ?>" id="x_kdkota" name="x_kdkota"<?php echo $cv_coachingprogram_list->kdkota->editAttributes() ?>>
			<?php echo $cv_coachingprogram_list->kdkota->selectOptionListHtml("x_kdkota") ?>
		</select>
</div>
<?php echo $cv_coachingprogram_list->kdkota->Lookup->getParamTag($cv_coachingprogram_list, "p_x_kdkota") ?>
</span>
	</div>
	<?php if ($cv_coachingprogram_list->SearchColumnCount % $cv_coachingprogram_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($cv_coachingprogram_list->SearchColumnCount % $cv_coachingprogram_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $cv_coachingprogram_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $cv_coachingprogram_list->showPageHeader(); ?>
<?php
$cv_coachingprogram_list->showMessage();
?>
<?php if ($cv_coachingprogram_list->TotalRecords > 0 || $cv_coachingprogram->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cv_coachingprogram_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cv_coachingprogram">
<?php if (!$cv_coachingprogram_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$cv_coachingprogram_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cv_coachingprogram_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cv_coachingprogram_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcv_coachingprogramlist" id="fcv_coachingprogramlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cv_coachingprogram">
<div id="gmp_cv_coachingprogram" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($cv_coachingprogram_list->TotalRecords > 0 || $cv_coachingprogram_list->isGridEdit()) { ?>
<table id="tbl_cv_coachingprogramlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cv_coachingprogram->RowType = ROWTYPE_HEADER;

// Render list options
$cv_coachingprogram_list->renderListOptions();

// Render list options (header, left)
$cv_coachingprogram_list->ListOptions->render("header", "left");
?>
<?php if ($cv_coachingprogram_list->kdpelat->Visible) { // kdpelat ?>
	<?php if ($cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->kdpelat) == "") { ?>
		<th data-name="kdpelat" class="<?php echo $cv_coachingprogram_list->kdpelat->headerCellClass() ?>"><div id="elh_cv_coachingprogram_kdpelat" class="cv_coachingprogram_kdpelat"><div class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->kdpelat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdpelat" class="<?php echo $cv_coachingprogram_list->kdpelat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->kdpelat) ?>', 1);"><div id="elh_cv_coachingprogram_kdpelat" class="cv_coachingprogram_kdpelat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->kdpelat->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_coachingprogram_list->kdpelat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_coachingprogram_list->kdpelat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_coachingprogram_list->kdjudul->Visible) { // kdjudul ?>
	<?php if ($cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $cv_coachingprogram_list->kdjudul->headerCellClass() ?>"><div id="elh_cv_coachingprogram_kdjudul" class="cv_coachingprogram_kdjudul"><div class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $cv_coachingprogram_list->kdjudul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->kdjudul) ?>', 1);"><div id="elh_cv_coachingprogram_kdjudul" class="cv_coachingprogram_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->kdjudul->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_coachingprogram_list->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_coachingprogram_list->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_coachingprogram_list->tawal->Visible) { // tawal ?>
	<?php if ($cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->tawal) == "") { ?>
		<th data-name="tawal" class="<?php echo $cv_coachingprogram_list->tawal->headerCellClass() ?>"><div id="elh_cv_coachingprogram_tawal" class="cv_coachingprogram_tawal"><div class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->tawal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tawal" class="<?php echo $cv_coachingprogram_list->tawal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->tawal) ?>', 1);"><div id="elh_cv_coachingprogram_tawal" class="cv_coachingprogram_tawal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->tawal->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_coachingprogram_list->tawal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_coachingprogram_list->tawal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_coachingprogram_list->takhir->Visible) { // takhir ?>
	<?php if ($cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->takhir) == "") { ?>
		<th data-name="takhir" class="<?php echo $cv_coachingprogram_list->takhir->headerCellClass() ?>"><div id="elh_cv_coachingprogram_takhir" class="cv_coachingprogram_takhir"><div class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->takhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="takhir" class="<?php echo $cv_coachingprogram_list->takhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->takhir) ?>', 1);"><div id="elh_cv_coachingprogram_takhir" class="cv_coachingprogram_takhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->takhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_coachingprogram_list->takhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_coachingprogram_list->takhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_coachingprogram_list->kdprop->Visible) { // kdprop ?>
	<?php if ($cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->kdprop) == "") { ?>
		<th data-name="kdprop" class="<?php echo $cv_coachingprogram_list->kdprop->headerCellClass() ?>"><div id="elh_cv_coachingprogram_kdprop" class="cv_coachingprogram_kdprop"><div class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->kdprop->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdprop" class="<?php echo $cv_coachingprogram_list->kdprop->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->kdprop) ?>', 1);"><div id="elh_cv_coachingprogram_kdprop" class="cv_coachingprogram_kdprop">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->kdprop->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_coachingprogram_list->kdprop->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_coachingprogram_list->kdprop->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_coachingprogram_list->kdkota->Visible) { // kdkota ?>
	<?php if ($cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->kdkota) == "") { ?>
		<th data-name="kdkota" class="<?php echo $cv_coachingprogram_list->kdkota->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_cv_coachingprogram_kdkota" class="cv_coachingprogram_kdkota"><div class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->kdkota->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkota" class="<?php echo $cv_coachingprogram_list->kdkota->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->kdkota) ?>', 1);"><div id="elh_cv_coachingprogram_kdkota" class="cv_coachingprogram_kdkota">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->kdkota->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_coachingprogram_list->kdkota->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_coachingprogram_list->kdkota->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_coachingprogram_list->ketua->Visible) { // ketua ?>
	<?php if ($cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->ketua) == "") { ?>
		<th data-name="ketua" class="<?php echo $cv_coachingprogram_list->ketua->headerCellClass() ?>"><div id="elh_cv_coachingprogram_ketua" class="cv_coachingprogram_ketua"><div class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->ketua->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ketua" class="<?php echo $cv_coachingprogram_list->ketua->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->ketua) ?>', 1);"><div id="elh_cv_coachingprogram_ketua" class="cv_coachingprogram_ketua">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->ketua->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_coachingprogram_list->ketua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_coachingprogram_list->ketua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_coachingprogram_list->bendahara->Visible) { // bendahara ?>
	<?php if ($cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->bendahara) == "") { ?>
		<th data-name="bendahara" class="<?php echo $cv_coachingprogram_list->bendahara->headerCellClass() ?>"><div id="elh_cv_coachingprogram_bendahara" class="cv_coachingprogram_bendahara"><div class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->bendahara->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bendahara" class="<?php echo $cv_coachingprogram_list->bendahara->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->bendahara) ?>', 1);"><div id="elh_cv_coachingprogram_bendahara" class="cv_coachingprogram_bendahara">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->bendahara->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_coachingprogram_list->bendahara->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_coachingprogram_list->bendahara->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_coachingprogram_list->sekretaris->Visible) { // sekretaris ?>
	<?php if ($cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->sekretaris) == "") { ?>
		<th data-name="sekretaris" class="<?php echo $cv_coachingprogram_list->sekretaris->headerCellClass() ?>"><div id="elh_cv_coachingprogram_sekretaris" class="cv_coachingprogram_sekretaris"><div class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->sekretaris->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sekretaris" class="<?php echo $cv_coachingprogram_list->sekretaris->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->sekretaris) ?>', 1);"><div id="elh_cv_coachingprogram_sekretaris" class="cv_coachingprogram_sekretaris">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->sekretaris->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_coachingprogram_list->sekretaris->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_coachingprogram_list->sekretaris->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_coachingprogram_list->periode_awal->Visible) { // periode_awal ?>
	<?php if ($cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->periode_awal) == "") { ?>
		<th data-name="periode_awal" class="<?php echo $cv_coachingprogram_list->periode_awal->headerCellClass() ?>"><div id="elh_cv_coachingprogram_periode_awal" class="cv_coachingprogram_periode_awal"><div class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->periode_awal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="periode_awal" class="<?php echo $cv_coachingprogram_list->periode_awal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->periode_awal) ?>', 1);"><div id="elh_cv_coachingprogram_periode_awal" class="cv_coachingprogram_periode_awal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->periode_awal->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_coachingprogram_list->periode_awal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_coachingprogram_list->periode_awal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_coachingprogram_list->periode_akhir->Visible) { // periode_akhir ?>
	<?php if ($cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->periode_akhir) == "") { ?>
		<th data-name="periode_akhir" class="<?php echo $cv_coachingprogram_list->periode_akhir->headerCellClass() ?>"><div id="elh_cv_coachingprogram_periode_akhir" class="cv_coachingprogram_periode_akhir"><div class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->periode_akhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="periode_akhir" class="<?php echo $cv_coachingprogram_list->periode_akhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->periode_akhir) ?>', 1);"><div id="elh_cv_coachingprogram_periode_akhir" class="cv_coachingprogram_periode_akhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->periode_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_coachingprogram_list->periode_akhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_coachingprogram_list->periode_akhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_coachingprogram_list->jpeserta2->Visible) { // jpeserta2 ?>
	<?php if ($cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->jpeserta2) == "") { ?>
		<th data-name="jpeserta2" class="<?php echo $cv_coachingprogram_list->jpeserta2->headerCellClass() ?>"><div id="elh_cv_coachingprogram_jpeserta2" class="cv_coachingprogram_jpeserta2"><div class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->jpeserta2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jpeserta2" class="<?php echo $cv_coachingprogram_list->jpeserta2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_coachingprogram_list->SortUrl($cv_coachingprogram_list->jpeserta2) ?>', 1);"><div id="elh_cv_coachingprogram_jpeserta2" class="cv_coachingprogram_jpeserta2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_coachingprogram_list->jpeserta2->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_coachingprogram_list->jpeserta2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_coachingprogram_list->jpeserta2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cv_coachingprogram_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cv_coachingprogram_list->ExportAll && $cv_coachingprogram_list->isExport()) {
	$cv_coachingprogram_list->StopRecord = $cv_coachingprogram_list->TotalRecords;
} else {

	// Set the last record to display
	if ($cv_coachingprogram_list->TotalRecords > $cv_coachingprogram_list->StartRecord + $cv_coachingprogram_list->DisplayRecords - 1)
		$cv_coachingprogram_list->StopRecord = $cv_coachingprogram_list->StartRecord + $cv_coachingprogram_list->DisplayRecords - 1;
	else
		$cv_coachingprogram_list->StopRecord = $cv_coachingprogram_list->TotalRecords;
}
$cv_coachingprogram_list->RecordCount = $cv_coachingprogram_list->StartRecord - 1;
if ($cv_coachingprogram_list->Recordset && !$cv_coachingprogram_list->Recordset->EOF) {
	$cv_coachingprogram_list->Recordset->moveFirst();
	$selectLimit = $cv_coachingprogram_list->UseSelectLimit;
	if (!$selectLimit && $cv_coachingprogram_list->StartRecord > 1)
		$cv_coachingprogram_list->Recordset->move($cv_coachingprogram_list->StartRecord - 1);
} elseif (!$cv_coachingprogram->AllowAddDeleteRow && $cv_coachingprogram_list->StopRecord == 0) {
	$cv_coachingprogram_list->StopRecord = $cv_coachingprogram->GridAddRowCount;
}

// Initialize aggregate
$cv_coachingprogram->RowType = ROWTYPE_AGGREGATEINIT;
$cv_coachingprogram->resetAttributes();
$cv_coachingprogram_list->renderRow();
while ($cv_coachingprogram_list->RecordCount < $cv_coachingprogram_list->StopRecord) {
	$cv_coachingprogram_list->RecordCount++;
	if ($cv_coachingprogram_list->RecordCount >= $cv_coachingprogram_list->StartRecord) {
		$cv_coachingprogram_list->RowCount++;

		// Set up key count
		$cv_coachingprogram_list->KeyCount = $cv_coachingprogram_list->RowIndex;

		// Init row class and style
		$cv_coachingprogram->resetAttributes();
		$cv_coachingprogram->CssClass = "";
		if ($cv_coachingprogram_list->isGridAdd()) {
		} else {
			$cv_coachingprogram_list->loadRowValues($cv_coachingprogram_list->Recordset); // Load row values
		}
		$cv_coachingprogram->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cv_coachingprogram->RowAttrs->merge(["data-rowindex" => $cv_coachingprogram_list->RowCount, "id" => "r" . $cv_coachingprogram_list->RowCount . "_cv_coachingprogram", "data-rowtype" => $cv_coachingprogram->RowType]);

		// Render row
		$cv_coachingprogram_list->renderRow();

		// Render list options
		$cv_coachingprogram_list->renderListOptions();
?>
	<tr <?php echo $cv_coachingprogram->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cv_coachingprogram_list->ListOptions->render("body", "left", $cv_coachingprogram_list->RowCount);
?>
	<?php if ($cv_coachingprogram_list->kdpelat->Visible) { // kdpelat ?>
		<td data-name="kdpelat" <?php echo $cv_coachingprogram_list->kdpelat->cellAttributes() ?>>
<span id="el<?php echo $cv_coachingprogram_list->RowCount ?>_cv_coachingprogram_kdpelat">
<span<?php echo $cv_coachingprogram_list->kdpelat->viewAttributes() ?>><?php echo $cv_coachingprogram_list->kdpelat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_coachingprogram_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $cv_coachingprogram_list->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $cv_coachingprogram_list->RowCount ?>_cv_coachingprogram_kdjudul">
<span<?php echo $cv_coachingprogram_list->kdjudul->viewAttributes() ?>><?php echo $cv_coachingprogram_list->kdjudul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_coachingprogram_list->tawal->Visible) { // tawal ?>
		<td data-name="tawal" <?php echo $cv_coachingprogram_list->tawal->cellAttributes() ?>>
<span id="el<?php echo $cv_coachingprogram_list->RowCount ?>_cv_coachingprogram_tawal">
<span<?php echo $cv_coachingprogram_list->tawal->viewAttributes() ?>><?php echo $cv_coachingprogram_list->tawal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_coachingprogram_list->takhir->Visible) { // takhir ?>
		<td data-name="takhir" <?php echo $cv_coachingprogram_list->takhir->cellAttributes() ?>>
<span id="el<?php echo $cv_coachingprogram_list->RowCount ?>_cv_coachingprogram_takhir">
<span<?php echo $cv_coachingprogram_list->takhir->viewAttributes() ?>><?php echo $cv_coachingprogram_list->takhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_coachingprogram_list->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" <?php echo $cv_coachingprogram_list->kdprop->cellAttributes() ?>>
<span id="el<?php echo $cv_coachingprogram_list->RowCount ?>_cv_coachingprogram_kdprop">
<span<?php echo $cv_coachingprogram_list->kdprop->viewAttributes() ?>><?php echo $cv_coachingprogram_list->kdprop->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_coachingprogram_list->kdkota->Visible) { // kdkota ?>
		<td data-name="kdkota" <?php echo $cv_coachingprogram_list->kdkota->cellAttributes() ?>>
<span id="el<?php echo $cv_coachingprogram_list->RowCount ?>_cv_coachingprogram_kdkota">
<span<?php echo $cv_coachingprogram_list->kdkota->viewAttributes() ?>><?php echo $cv_coachingprogram_list->kdkota->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_coachingprogram_list->ketua->Visible) { // ketua ?>
		<td data-name="ketua" <?php echo $cv_coachingprogram_list->ketua->cellAttributes() ?>>
<span id="el<?php echo $cv_coachingprogram_list->RowCount ?>_cv_coachingprogram_ketua">
<span<?php echo $cv_coachingprogram_list->ketua->viewAttributes() ?>><?php echo $cv_coachingprogram_list->ketua->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_coachingprogram_list->bendahara->Visible) { // bendahara ?>
		<td data-name="bendahara" <?php echo $cv_coachingprogram_list->bendahara->cellAttributes() ?>>
<span id="el<?php echo $cv_coachingprogram_list->RowCount ?>_cv_coachingprogram_bendahara">
<span<?php echo $cv_coachingprogram_list->bendahara->viewAttributes() ?>><?php echo $cv_coachingprogram_list->bendahara->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_coachingprogram_list->sekretaris->Visible) { // sekretaris ?>
		<td data-name="sekretaris" <?php echo $cv_coachingprogram_list->sekretaris->cellAttributes() ?>>
<span id="el<?php echo $cv_coachingprogram_list->RowCount ?>_cv_coachingprogram_sekretaris">
<span<?php echo $cv_coachingprogram_list->sekretaris->viewAttributes() ?>><?php echo $cv_coachingprogram_list->sekretaris->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_coachingprogram_list->periode_awal->Visible) { // periode_awal ?>
		<td data-name="periode_awal" <?php echo $cv_coachingprogram_list->periode_awal->cellAttributes() ?>>
<span id="el<?php echo $cv_coachingprogram_list->RowCount ?>_cv_coachingprogram_periode_awal">
<span<?php echo $cv_coachingprogram_list->periode_awal->viewAttributes() ?>><?php echo $cv_coachingprogram_list->periode_awal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_coachingprogram_list->periode_akhir->Visible) { // periode_akhir ?>
		<td data-name="periode_akhir" <?php echo $cv_coachingprogram_list->periode_akhir->cellAttributes() ?>>
<span id="el<?php echo $cv_coachingprogram_list->RowCount ?>_cv_coachingprogram_periode_akhir">
<span<?php echo $cv_coachingprogram_list->periode_akhir->viewAttributes() ?>><?php echo $cv_coachingprogram_list->periode_akhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_coachingprogram_list->jpeserta2->Visible) { // jpeserta2 ?>
		<td data-name="jpeserta2" <?php echo $cv_coachingprogram_list->jpeserta2->cellAttributes() ?>>
<span id="el<?php echo $cv_coachingprogram_list->RowCount ?>_cv_coachingprogram_jpeserta2">
<span<?php echo $cv_coachingprogram_list->jpeserta2->viewAttributes() ?>><?php echo $cv_coachingprogram_list->jpeserta2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cv_coachingprogram_list->ListOptions->render("body", "right", $cv_coachingprogram_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$cv_coachingprogram_list->isGridAdd())
		$cv_coachingprogram_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$cv_coachingprogram->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cv_coachingprogram_list->Recordset)
	$cv_coachingprogram_list->Recordset->Close();
?>
<?php if (!$cv_coachingprogram_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cv_coachingprogram_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cv_coachingprogram_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cv_coachingprogram_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cv_coachingprogram_list->TotalRecords == 0 && !$cv_coachingprogram->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cv_coachingprogram_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cv_coachingprogram_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cv_coachingprogram_list->isExport()) { ?>
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
$cv_coachingprogram_list->terminate();
?>