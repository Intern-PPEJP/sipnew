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
$v_kerjasama_list = new v_kerjasama_list();

// Run the page
$v_kerjasama_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v_kerjasama_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$v_kerjasama_list->isExport()) { ?>
<script>
var fv_kerjasamalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fv_kerjasamalist = currentForm = new ew.Form("fv_kerjasamalist", "list");
	fv_kerjasamalist.formKeyCountName = '<?php echo $v_kerjasama_list->FormKeyCountName ?>';
	loadjs.done("fv_kerjasamalist");
});
var fv_kerjasamalistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fv_kerjasamalistsrch = currentSearchForm = new ew.Form("fv_kerjasamalistsrch");

	// Validate function for search
	fv_kerjasamalistsrch.validate = function(fobj) {
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
	fv_kerjasamalistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fv_kerjasamalistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fv_kerjasamalistsrch.lists["x_kdjudul"] = <?php echo $v_kerjasama_list->kdjudul->Lookup->toClientList($v_kerjasama_list) ?>;
	fv_kerjasamalistsrch.lists["x_kdjudul"].options = <?php echo JsonEncode($v_kerjasama_list->kdjudul->lookupOptions()) ?>;
	fv_kerjasamalistsrch.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

	// Filters
	fv_kerjasamalistsrch.filterList = <?php echo $v_kerjasama_list->getFilterList() ?>;
	loadjs.done("fv_kerjasamalistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//document.write('<?php echo cs_judul("list","Daftar Kerjasama");?>');

});
</script>
<?php } ?>
<?php if (!$v_kerjasama_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($v_kerjasama_list->TotalRecords > 0 && $v_kerjasama_list->ExportOptions->visible()) { ?>
<?php $v_kerjasama_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($v_kerjasama_list->ImportOptions->visible()) { ?>
<?php $v_kerjasama_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($v_kerjasama_list->SearchOptions->visible()) { ?>
<?php $v_kerjasama_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($v_kerjasama_list->FilterOptions->visible()) { ?>
<?php $v_kerjasama_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$v_kerjasama_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$v_kerjasama_list->isExport() && !$v_kerjasama->CurrentAction) { ?>
<form name="fv_kerjasamalistsrch" id="fv_kerjasamalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fv_kerjasamalistsrch-search-panel" class="<?php echo $v_kerjasama_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="v_kerjasama">
	<div class="ew-extended-search">
<?php

// Render search row
$v_kerjasama->RowType = ROWTYPE_SEARCH;
$v_kerjasama->resetAttributes();
$v_kerjasama_list->renderRow();
?>
<?php if ($v_kerjasama_list->kdjudul->Visible) { // kdjudul ?>
	<?php
		$v_kerjasama_list->SearchColumnCount++;
		if (($v_kerjasama_list->SearchColumnCount - 1) % $v_kerjasama_list->SearchFieldsPerRow == 0) {
			$v_kerjasama_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $v_kerjasama_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kdjudul" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $v_kerjasama_list->kdjudul->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdjudul" id="z_kdjudul" value="=">
</span>
		<span id="el_v_kerjasama_kdjudul" class="ew-search-field">
<?php
$onchange = $v_kerjasama_list->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$v_kerjasama_list->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($v_kerjasama_list->kdjudul->EditValue) ?>" size="100" placeholder="<?php echo HtmlEncode($v_kerjasama_list->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($v_kerjasama_list->kdjudul->getPlaceHolder()) ?>"<?php echo $v_kerjasama_list->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="v_kerjasama" data-field="x_kdjudul" data-value-separator="<?php echo $v_kerjasama_list->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($v_kerjasama_list->kdjudul->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fv_kerjasamalistsrch"], function() {
	fv_kerjasamalistsrch.createAutoSuggest({"id":"x_kdjudul","forceSelect":false,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $v_kerjasama_list->kdjudul->Lookup->getParamTag($v_kerjasama_list, "p_x_kdjudul") ?>
</span>
	</div>
	<?php if ($v_kerjasama_list->SearchColumnCount % $v_kerjasama_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($v_kerjasama_list->SearchColumnCount % $v_kerjasama_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $v_kerjasama_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $v_kerjasama_list->showPageHeader(); ?>
<?php
$v_kerjasama_list->showMessage();
?>
<?php if ($v_kerjasama_list->TotalRecords > 0 || $v_kerjasama->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($v_kerjasama_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> v_kerjasama">
<?php if (!$v_kerjasama_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$v_kerjasama_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $v_kerjasama_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_kerjasama_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fv_kerjasamalist" id="fv_kerjasamalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v_kerjasama">
<div id="gmp_v_kerjasama" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($v_kerjasama_list->TotalRecords > 0 || $v_kerjasama_list->isGridEdit()) { ?>
<table id="tbl_v_kerjasamalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$v_kerjasama->RowType = ROWTYPE_HEADER;

// Render list options
$v_kerjasama_list->renderListOptions();

// Render list options (header, left)
$v_kerjasama_list->ListOptions->render("header", "left");
?>
<?php if ($v_kerjasama_list->kdpelat->Visible) { // kdpelat ?>
	<?php if ($v_kerjasama_list->SortUrl($v_kerjasama_list->kdpelat) == "") { ?>
		<th data-name="kdpelat" class="<?php echo $v_kerjasama_list->kdpelat->headerCellClass() ?>"><div id="elh_v_kerjasama_kdpelat" class="v_kerjasama_kdpelat"><div class="ew-table-header-caption"><?php echo $v_kerjasama_list->kdpelat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdpelat" class="<?php echo $v_kerjasama_list->kdpelat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_kerjasama_list->SortUrl($v_kerjasama_list->kdpelat) ?>', 1);"><div id="elh_v_kerjasama_kdpelat" class="v_kerjasama_kdpelat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_kerjasama_list->kdpelat->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_kerjasama_list->kdpelat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_kerjasama_list->kdpelat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_kerjasama_list->kdjudul->Visible) { // kdjudul ?>
	<?php if ($v_kerjasama_list->SortUrl($v_kerjasama_list->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $v_kerjasama_list->kdjudul->headerCellClass() ?>"><div id="elh_v_kerjasama_kdjudul" class="v_kerjasama_kdjudul"><div class="ew-table-header-caption"><?php echo $v_kerjasama_list->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $v_kerjasama_list->kdjudul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_kerjasama_list->SortUrl($v_kerjasama_list->kdjudul) ?>', 1);"><div id="elh_v_kerjasama_kdjudul" class="v_kerjasama_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_kerjasama_list->kdjudul->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_kerjasama_list->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_kerjasama_list->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_kerjasama_list->tawal->Visible) { // tawal ?>
	<?php if ($v_kerjasama_list->SortUrl($v_kerjasama_list->tawal) == "") { ?>
		<th data-name="tawal" class="<?php echo $v_kerjasama_list->tawal->headerCellClass() ?>"><div id="elh_v_kerjasama_tawal" class="v_kerjasama_tawal"><div class="ew-table-header-caption"><?php echo $v_kerjasama_list->tawal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tawal" class="<?php echo $v_kerjasama_list->tawal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_kerjasama_list->SortUrl($v_kerjasama_list->tawal) ?>', 1);"><div id="elh_v_kerjasama_tawal" class="v_kerjasama_tawal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_kerjasama_list->tawal->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_kerjasama_list->tawal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_kerjasama_list->tawal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_kerjasama_list->takhir->Visible) { // takhir ?>
	<?php if ($v_kerjasama_list->SortUrl($v_kerjasama_list->takhir) == "") { ?>
		<th data-name="takhir" class="<?php echo $v_kerjasama_list->takhir->headerCellClass() ?>"><div id="elh_v_kerjasama_takhir" class="v_kerjasama_takhir"><div class="ew-table-header-caption"><?php echo $v_kerjasama_list->takhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="takhir" class="<?php echo $v_kerjasama_list->takhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_kerjasama_list->SortUrl($v_kerjasama_list->takhir) ?>', 1);"><div id="elh_v_kerjasama_takhir" class="v_kerjasama_takhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_kerjasama_list->takhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_kerjasama_list->takhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_kerjasama_list->takhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_kerjasama_list->jenispel->Visible) { // jenispel ?>
	<?php if ($v_kerjasama_list->SortUrl($v_kerjasama_list->jenispel) == "") { ?>
		<th data-name="jenispel" class="<?php echo $v_kerjasama_list->jenispel->headerCellClass() ?>"><div id="elh_v_kerjasama_jenispel" class="v_kerjasama_jenispel"><div class="ew-table-header-caption"><?php echo $v_kerjasama_list->jenispel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenispel" class="<?php echo $v_kerjasama_list->jenispel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_kerjasama_list->SortUrl($v_kerjasama_list->jenispel) ?>', 1);"><div id="elh_v_kerjasama_jenispel" class="v_kerjasama_jenispel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_kerjasama_list->jenispel->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_kerjasama_list->jenispel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_kerjasama_list->jenispel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_kerjasama_list->kdkategori->Visible) { // kdkategori ?>
	<?php if ($v_kerjasama_list->SortUrl($v_kerjasama_list->kdkategori) == "") { ?>
		<th data-name="kdkategori" class="<?php echo $v_kerjasama_list->kdkategori->headerCellClass() ?>"><div id="elh_v_kerjasama_kdkategori" class="v_kerjasama_kdkategori"><div class="ew-table-header-caption"><?php echo $v_kerjasama_list->kdkategori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkategori" class="<?php echo $v_kerjasama_list->kdkategori->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_kerjasama_list->SortUrl($v_kerjasama_list->kdkategori) ?>', 1);"><div id="elh_v_kerjasama_kdkategori" class="v_kerjasama_kdkategori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_kerjasama_list->kdkategori->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_kerjasama_list->kdkategori->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_kerjasama_list->kdkategori->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_kerjasama_list->kerjasama->Visible) { // kerjasama ?>
	<?php if ($v_kerjasama_list->SortUrl($v_kerjasama_list->kerjasama) == "") { ?>
		<th data-name="kerjasama" class="<?php echo $v_kerjasama_list->kerjasama->headerCellClass() ?>"><div id="elh_v_kerjasama_kerjasama" class="v_kerjasama_kerjasama"><div class="ew-table-header-caption"><?php echo $v_kerjasama_list->kerjasama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kerjasama" class="<?php echo $v_kerjasama_list->kerjasama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_kerjasama_list->SortUrl($v_kerjasama_list->kerjasama) ?>', 1);"><div id="elh_v_kerjasama_kerjasama" class="v_kerjasama_kerjasama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_kerjasama_list->kerjasama->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_kerjasama_list->kerjasama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_kerjasama_list->kerjasama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_kerjasama_list->biaya->Visible) { // biaya ?>
	<?php if ($v_kerjasama_list->SortUrl($v_kerjasama_list->biaya) == "") { ?>
		<th data-name="biaya" class="<?php echo $v_kerjasama_list->biaya->headerCellClass() ?>"><div id="elh_v_kerjasama_biaya" class="v_kerjasama_biaya"><div class="ew-table-header-caption"><?php echo $v_kerjasama_list->biaya->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="biaya" class="<?php echo $v_kerjasama_list->biaya->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_kerjasama_list->SortUrl($v_kerjasama_list->biaya) ?>', 1);"><div id="elh_v_kerjasama_biaya" class="v_kerjasama_biaya">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_kerjasama_list->biaya->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_kerjasama_list->biaya->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_kerjasama_list->biaya->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_kerjasama_list->tempat->Visible) { // tempat ?>
	<?php if ($v_kerjasama_list->SortUrl($v_kerjasama_list->tempat) == "") { ?>
		<th data-name="tempat" class="<?php echo $v_kerjasama_list->tempat->headerCellClass() ?>"><div id="elh_v_kerjasama_tempat" class="v_kerjasama_tempat"><div class="ew-table-header-caption"><?php echo $v_kerjasama_list->tempat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tempat" class="<?php echo $v_kerjasama_list->tempat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_kerjasama_list->SortUrl($v_kerjasama_list->tempat) ?>', 1);"><div id="elh_v_kerjasama_tempat" class="v_kerjasama_tempat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_kerjasama_list->tempat->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_kerjasama_list->tempat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_kerjasama_list->tempat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_kerjasama_list->target_peserta->Visible) { // target_peserta ?>
	<?php if ($v_kerjasama_list->SortUrl($v_kerjasama_list->target_peserta) == "") { ?>
		<th data-name="target_peserta" class="<?php echo $v_kerjasama_list->target_peserta->headerCellClass() ?>"><div id="elh_v_kerjasama_target_peserta" class="v_kerjasama_target_peserta"><div class="ew-table-header-caption"><?php echo $v_kerjasama_list->target_peserta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="target_peserta" class="<?php echo $v_kerjasama_list->target_peserta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_kerjasama_list->SortUrl($v_kerjasama_list->target_peserta) ?>', 1);"><div id="elh_v_kerjasama_target_peserta" class="v_kerjasama_target_peserta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_kerjasama_list->target_peserta->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_kerjasama_list->target_peserta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_kerjasama_list->target_peserta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_kerjasama_list->durasi1->Visible) { // durasi1 ?>
	<?php if ($v_kerjasama_list->SortUrl($v_kerjasama_list->durasi1) == "") { ?>
		<th data-name="durasi1" class="<?php echo $v_kerjasama_list->durasi1->headerCellClass() ?>"><div id="elh_v_kerjasama_durasi1" class="v_kerjasama_durasi1"><div class="ew-table-header-caption"><?php echo $v_kerjasama_list->durasi1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="durasi1" class="<?php echo $v_kerjasama_list->durasi1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_kerjasama_list->SortUrl($v_kerjasama_list->durasi1) ?>', 1);"><div id="elh_v_kerjasama_durasi1" class="v_kerjasama_durasi1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_kerjasama_list->durasi1->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_kerjasama_list->durasi1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_kerjasama_list->durasi1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_kerjasama_list->durasi2->Visible) { // durasi2 ?>
	<?php if ($v_kerjasama_list->SortUrl($v_kerjasama_list->durasi2) == "") { ?>
		<th data-name="durasi2" class="<?php echo $v_kerjasama_list->durasi2->headerCellClass() ?>"><div id="elh_v_kerjasama_durasi2" class="v_kerjasama_durasi2"><div class="ew-table-header-caption"><?php echo $v_kerjasama_list->durasi2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="durasi2" class="<?php echo $v_kerjasama_list->durasi2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_kerjasama_list->SortUrl($v_kerjasama_list->durasi2) ?>', 1);"><div id="elh_v_kerjasama_durasi2" class="v_kerjasama_durasi2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_kerjasama_list->durasi2->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_kerjasama_list->durasi2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_kerjasama_list->durasi2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_kerjasama_list->nmou->Visible) { // nmou ?>
	<?php if ($v_kerjasama_list->SortUrl($v_kerjasama_list->nmou) == "") { ?>
		<th data-name="nmou" class="<?php echo $v_kerjasama_list->nmou->headerCellClass() ?>"><div id="elh_v_kerjasama_nmou" class="v_kerjasama_nmou"><div class="ew-table-header-caption"><?php echo $v_kerjasama_list->nmou->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nmou" class="<?php echo $v_kerjasama_list->nmou->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_kerjasama_list->SortUrl($v_kerjasama_list->nmou) ?>', 1);"><div id="elh_v_kerjasama_nmou" class="v_kerjasama_nmou">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_kerjasama_list->nmou->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_kerjasama_list->nmou->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_kerjasama_list->nmou->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_kerjasama_list->nmou2->Visible) { // nmou2 ?>
	<?php if ($v_kerjasama_list->SortUrl($v_kerjasama_list->nmou2) == "") { ?>
		<th data-name="nmou2" class="<?php echo $v_kerjasama_list->nmou2->headerCellClass() ?>"><div id="elh_v_kerjasama_nmou2" class="v_kerjasama_nmou2"><div class="ew-table-header-caption"><?php echo $v_kerjasama_list->nmou2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nmou2" class="<?php echo $v_kerjasama_list->nmou2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_kerjasama_list->SortUrl($v_kerjasama_list->nmou2) ?>', 1);"><div id="elh_v_kerjasama_nmou2" class="v_kerjasama_nmou2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_kerjasama_list->nmou2->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_kerjasama_list->nmou2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_kerjasama_list->nmou2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$v_kerjasama_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($v_kerjasama_list->ExportAll && $v_kerjasama_list->isExport()) {
	$v_kerjasama_list->StopRecord = $v_kerjasama_list->TotalRecords;
} else {

	// Set the last record to display
	if ($v_kerjasama_list->TotalRecords > $v_kerjasama_list->StartRecord + $v_kerjasama_list->DisplayRecords - 1)
		$v_kerjasama_list->StopRecord = $v_kerjasama_list->StartRecord + $v_kerjasama_list->DisplayRecords - 1;
	else
		$v_kerjasama_list->StopRecord = $v_kerjasama_list->TotalRecords;
}
$v_kerjasama_list->RecordCount = $v_kerjasama_list->StartRecord - 1;
if ($v_kerjasama_list->Recordset && !$v_kerjasama_list->Recordset->EOF) {
	$v_kerjasama_list->Recordset->moveFirst();
	$selectLimit = $v_kerjasama_list->UseSelectLimit;
	if (!$selectLimit && $v_kerjasama_list->StartRecord > 1)
		$v_kerjasama_list->Recordset->move($v_kerjasama_list->StartRecord - 1);
} elseif (!$v_kerjasama->AllowAddDeleteRow && $v_kerjasama_list->StopRecord == 0) {
	$v_kerjasama_list->StopRecord = $v_kerjasama->GridAddRowCount;
}

// Initialize aggregate
$v_kerjasama->RowType = ROWTYPE_AGGREGATEINIT;
$v_kerjasama->resetAttributes();
$v_kerjasama_list->renderRow();
while ($v_kerjasama_list->RecordCount < $v_kerjasama_list->StopRecord) {
	$v_kerjasama_list->RecordCount++;
	if ($v_kerjasama_list->RecordCount >= $v_kerjasama_list->StartRecord) {
		$v_kerjasama_list->RowCount++;

		// Set up key count
		$v_kerjasama_list->KeyCount = $v_kerjasama_list->RowIndex;

		// Init row class and style
		$v_kerjasama->resetAttributes();
		$v_kerjasama->CssClass = "";
		if ($v_kerjasama_list->isGridAdd()) {
		} else {
			$v_kerjasama_list->loadRowValues($v_kerjasama_list->Recordset); // Load row values
		}
		$v_kerjasama->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$v_kerjasama->RowAttrs->merge(["data-rowindex" => $v_kerjasama_list->RowCount, "id" => "r" . $v_kerjasama_list->RowCount . "_v_kerjasama", "data-rowtype" => $v_kerjasama->RowType]);

		// Render row
		$v_kerjasama_list->renderRow();

		// Render list options
		$v_kerjasama_list->renderListOptions();
?>
	<tr <?php echo $v_kerjasama->rowAttributes() ?>>
<?php

// Render list options (body, left)
$v_kerjasama_list->ListOptions->render("body", "left", $v_kerjasama_list->RowCount);
?>
	<?php if ($v_kerjasama_list->kdpelat->Visible) { // kdpelat ?>
		<td data-name="kdpelat" <?php echo $v_kerjasama_list->kdpelat->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_list->RowCount ?>_v_kerjasama_kdpelat">
<span<?php echo $v_kerjasama_list->kdpelat->viewAttributes() ?>><?php echo $v_kerjasama_list->kdpelat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_kerjasama_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $v_kerjasama_list->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_list->RowCount ?>_v_kerjasama_kdjudul">
<span<?php echo $v_kerjasama_list->kdjudul->viewAttributes() ?>><?php echo $v_kerjasama_list->kdjudul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_kerjasama_list->tawal->Visible) { // tawal ?>
		<td data-name="tawal" <?php echo $v_kerjasama_list->tawal->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_list->RowCount ?>_v_kerjasama_tawal">
<span<?php echo $v_kerjasama_list->tawal->viewAttributes() ?>><?php echo $v_kerjasama_list->tawal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_kerjasama_list->takhir->Visible) { // takhir ?>
		<td data-name="takhir" <?php echo $v_kerjasama_list->takhir->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_list->RowCount ?>_v_kerjasama_takhir">
<span<?php echo $v_kerjasama_list->takhir->viewAttributes() ?>><?php echo $v_kerjasama_list->takhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_kerjasama_list->jenispel->Visible) { // jenispel ?>
		<td data-name="jenispel" <?php echo $v_kerjasama_list->jenispel->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_list->RowCount ?>_v_kerjasama_jenispel">
<span<?php echo $v_kerjasama_list->jenispel->viewAttributes() ?>><?php echo $v_kerjasama_list->jenispel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_kerjasama_list->kdkategori->Visible) { // kdkategori ?>
		<td data-name="kdkategori" <?php echo $v_kerjasama_list->kdkategori->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_list->RowCount ?>_v_kerjasama_kdkategori">
<span<?php echo $v_kerjasama_list->kdkategori->viewAttributes() ?>><?php echo $v_kerjasama_list->kdkategori->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_kerjasama_list->kerjasama->Visible) { // kerjasama ?>
		<td data-name="kerjasama" <?php echo $v_kerjasama_list->kerjasama->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_list->RowCount ?>_v_kerjasama_kerjasama">
<span<?php echo $v_kerjasama_list->kerjasama->viewAttributes() ?>><?php echo $v_kerjasama_list->kerjasama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_kerjasama_list->biaya->Visible) { // biaya ?>
		<td data-name="biaya" <?php echo $v_kerjasama_list->biaya->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_list->RowCount ?>_v_kerjasama_biaya">
<span<?php echo $v_kerjasama_list->biaya->viewAttributes() ?>><?php echo $v_kerjasama_list->biaya->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_kerjasama_list->tempat->Visible) { // tempat ?>
		<td data-name="tempat" <?php echo $v_kerjasama_list->tempat->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_list->RowCount ?>_v_kerjasama_tempat">
<span<?php echo $v_kerjasama_list->tempat->viewAttributes() ?>><?php echo $v_kerjasama_list->tempat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_kerjasama_list->target_peserta->Visible) { // target_peserta ?>
		<td data-name="target_peserta" <?php echo $v_kerjasama_list->target_peserta->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_list->RowCount ?>_v_kerjasama_target_peserta">
<span<?php echo $v_kerjasama_list->target_peserta->viewAttributes() ?>><?php echo $v_kerjasama_list->target_peserta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_kerjasama_list->durasi1->Visible) { // durasi1 ?>
		<td data-name="durasi1" <?php echo $v_kerjasama_list->durasi1->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_list->RowCount ?>_v_kerjasama_durasi1">
<span<?php echo $v_kerjasama_list->durasi1->viewAttributes() ?>><?php echo $v_kerjasama_list->durasi1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_kerjasama_list->durasi2->Visible) { // durasi2 ?>
		<td data-name="durasi2" <?php echo $v_kerjasama_list->durasi2->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_list->RowCount ?>_v_kerjasama_durasi2">
<span<?php echo $v_kerjasama_list->durasi2->viewAttributes() ?>><?php echo $v_kerjasama_list->durasi2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_kerjasama_list->nmou->Visible) { // nmou ?>
		<td data-name="nmou" <?php echo $v_kerjasama_list->nmou->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_list->RowCount ?>_v_kerjasama_nmou">
<span<?php echo $v_kerjasama_list->nmou->viewAttributes() ?>><?php echo GetFileViewTag($v_kerjasama_list->nmou, $v_kerjasama_list->nmou->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_kerjasama_list->nmou2->Visible) { // nmou2 ?>
		<td data-name="nmou2" <?php echo $v_kerjasama_list->nmou2->cellAttributes() ?>>
<span id="el<?php echo $v_kerjasama_list->RowCount ?>_v_kerjasama_nmou2">
<span<?php echo $v_kerjasama_list->nmou2->viewAttributes() ?>><?php echo GetFileViewTag($v_kerjasama_list->nmou2, $v_kerjasama_list->nmou2->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$v_kerjasama_list->ListOptions->render("body", "right", $v_kerjasama_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$v_kerjasama_list->isGridAdd())
		$v_kerjasama_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$v_kerjasama->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($v_kerjasama_list->Recordset)
	$v_kerjasama_list->Recordset->Close();
?>
<?php if (!$v_kerjasama_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$v_kerjasama_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $v_kerjasama_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_kerjasama_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($v_kerjasama_list->TotalRecords == 0 && !$v_kerjasama->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $v_kerjasama_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$v_kerjasama_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$v_kerjasama_list->isExport()) { ?>
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
$v_kerjasama_list->terminate();
?>