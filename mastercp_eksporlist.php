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
$mastercp_ekspor_list = new mastercp_ekspor_list();

// Run the page
$mastercp_ekspor_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mastercp_ekspor_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$mastercp_ekspor_list->isExport()) { ?>
<script>
var fmastercp_eksporlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmastercp_eksporlist = currentForm = new ew.Form("fmastercp_eksporlist", "list");
	fmastercp_eksporlist.formKeyCountName = '<?php echo $mastercp_ekspor_list->FormKeyCountName ?>';
	loadjs.done("fmastercp_eksporlist");
});
var fmastercp_eksporlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmastercp_eksporlistsrch = currentSearchForm = new ew.Form("fmastercp_eksporlistsrch");

	// Validate function for search
	fmastercp_eksporlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_Tahun_ECP");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($mastercp_ekspor_list->Tahun_ECP->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fmastercp_eksporlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmastercp_eksporlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmastercp_eksporlistsrch.lists["x_Wilayah_ECP"] = <?php echo $mastercp_ekspor_list->Wilayah_ECP->Lookup->toClientList($mastercp_ekspor_list) ?>;
	fmastercp_eksporlistsrch.lists["x_Wilayah_ECP"].options = <?php echo JsonEncode($mastercp_ekspor_list->Wilayah_ECP->lookupOptions()) ?>;
	fmastercp_eksporlistsrch.lists["x_Tahun_ECP"] = <?php echo $mastercp_ekspor_list->Tahun_ECP->Lookup->toClientList($mastercp_ekspor_list) ?>;
	fmastercp_eksporlistsrch.lists["x_Tahun_ECP"].options = <?php echo JsonEncode($mastercp_ekspor_list->Tahun_ECP->lookupOptions()) ?>;
	fmastercp_eksporlistsrch.autoSuggests["x_Tahun_ECP"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmastercp_eksporlistsrch.lists["x_Negara_Tujuan"] = <?php echo $mastercp_ekspor_list->Negara_Tujuan->Lookup->toClientList($mastercp_ekspor_list) ?>;
	fmastercp_eksporlistsrch.lists["x_Negara_Tujuan"].options = <?php echo JsonEncode($mastercp_ekspor_list->Negara_Tujuan->lookupOptions()) ?>;

	// Filters
	fmastercp_eksporlistsrch.filterList = <?php echo $mastercp_ekspor_list->getFilterList() ?>;
	loadjs.done("fmastercp_eksporlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$mastercp_ekspor_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($mastercp_ekspor_list->TotalRecords > 0 && $mastercp_ekspor_list->ExportOptions->visible()) { ?>
<?php $mastercp_ekspor_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($mastercp_ekspor_list->ImportOptions->visible()) { ?>
<?php $mastercp_ekspor_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($mastercp_ekspor_list->SearchOptions->visible()) { ?>
<?php $mastercp_ekspor_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($mastercp_ekspor_list->FilterOptions->visible()) { ?>
<?php $mastercp_ekspor_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$mastercp_ekspor_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$mastercp_ekspor_list->isExport() && !$mastercp_ekspor->CurrentAction) { ?>
<form name="fmastercp_eksporlistsrch" id="fmastercp_eksporlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmastercp_eksporlistsrch-search-panel" class="<?php echo $mastercp_ekspor_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="mastercp_ekspor">
	<div class="ew-extended-search">
<?php

// Render search row
$mastercp_ekspor->RowType = ROWTYPE_SEARCH;
$mastercp_ekspor->resetAttributes();
$mastercp_ekspor_list->renderRow();
?>
<?php if ($mastercp_ekspor_list->Wilayah_ECP->Visible) { // Wilayah_ECP ?>
	<?php
		$mastercp_ekspor_list->SearchColumnCount++;
		if (($mastercp_ekspor_list->SearchColumnCount - 1) % $mastercp_ekspor_list->SearchFieldsPerRow == 0) {
			$mastercp_ekspor_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $mastercp_ekspor_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Wilayah_ECP" class="ew-cell form-group">
		<label for="x_Wilayah_ECP" class="ew-search-caption ew-label"><?php echo $mastercp_ekspor_list->Wilayah_ECP->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Wilayah_ECP" id="z_Wilayah_ECP" value="LIKE">
</span>
		<span id="el_mastercp_ekspor_Wilayah_ECP" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mastercp_ekspor" data-field="x_Wilayah_ECP" data-value-separator="<?php echo $mastercp_ekspor_list->Wilayah_ECP->displayValueSeparatorAttribute() ?>" id="x_Wilayah_ECP" name="x_Wilayah_ECP"<?php echo $mastercp_ekspor_list->Wilayah_ECP->editAttributes() ?>>
			<?php echo $mastercp_ekspor_list->Wilayah_ECP->selectOptionListHtml("x_Wilayah_ECP") ?>
		</select>
</div>
<?php echo $mastercp_ekspor_list->Wilayah_ECP->Lookup->getParamTag($mastercp_ekspor_list, "p_x_Wilayah_ECP") ?>
</span>
	</div>
	<?php if ($mastercp_ekspor_list->SearchColumnCount % $mastercp_ekspor_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($mastercp_ekspor_list->Tahun_ECP->Visible) { // Tahun_ECP ?>
	<?php
		$mastercp_ekspor_list->SearchColumnCount++;
		if (($mastercp_ekspor_list->SearchColumnCount - 1) % $mastercp_ekspor_list->SearchFieldsPerRow == 0) {
			$mastercp_ekspor_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $mastercp_ekspor_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Tahun_ECP" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $mastercp_ekspor_list->Tahun_ECP->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Tahun_ECP" id="z_Tahun_ECP" value="=">
</span>
		<span id="el_mastercp_ekspor_Tahun_ECP" class="ew-search-field">
<?php
$onchange = $mastercp_ekspor_list->Tahun_ECP->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$mastercp_ekspor_list->Tahun_ECP->EditAttrs["onchange"] = "";
?>
<span id="as_x_Tahun_ECP">
	<input type="text" class="form-control" name="sv_x_Tahun_ECP" id="sv_x_Tahun_ECP" value="<?php echo RemoveHtml($mastercp_ekspor_list->Tahun_ECP->EditValue) ?>" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($mastercp_ekspor_list->Tahun_ECP->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($mastercp_ekspor_list->Tahun_ECP->getPlaceHolder()) ?>"<?php echo $mastercp_ekspor_list->Tahun_ECP->editAttributes() ?>>
</span>
<input type="hidden" data-table="mastercp_ekspor" data-field="x_Tahun_ECP" data-value-separator="<?php echo $mastercp_ekspor_list->Tahun_ECP->displayValueSeparatorAttribute() ?>" name="x_Tahun_ECP" id="x_Tahun_ECP" value="<?php echo HtmlEncode($mastercp_ekspor_list->Tahun_ECP->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmastercp_eksporlistsrch"], function() {
	fmastercp_eksporlistsrch.createAutoSuggest({"id":"x_Tahun_ECP","forceSelect":false});
});
</script>
<?php echo $mastercp_ekspor_list->Tahun_ECP->Lookup->getParamTag($mastercp_ekspor_list, "p_x_Tahun_ECP") ?>
</span>
	</div>
	<?php if ($mastercp_ekspor_list->SearchColumnCount % $mastercp_ekspor_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($mastercp_ekspor_list->Negara_Tujuan->Visible) { // Negara_Tujuan ?>
	<?php
		$mastercp_ekspor_list->SearchColumnCount++;
		if (($mastercp_ekspor_list->SearchColumnCount - 1) % $mastercp_ekspor_list->SearchFieldsPerRow == 0) {
			$mastercp_ekspor_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $mastercp_ekspor_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Negara_Tujuan" class="ew-cell form-group">
		<label for="x_Negara_Tujuan" class="ew-search-caption ew-label"><?php echo $mastercp_ekspor_list->Negara_Tujuan->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Negara_Tujuan" id="z_Negara_Tujuan" value="LIKE">
</span>
		<span id="el_mastercp_ekspor_Negara_Tujuan" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mastercp_ekspor" data-field="x_Negara_Tujuan" data-value-separator="<?php echo $mastercp_ekspor_list->Negara_Tujuan->displayValueSeparatorAttribute() ?>" id="x_Negara_Tujuan" name="x_Negara_Tujuan"<?php echo $mastercp_ekspor_list->Negara_Tujuan->editAttributes() ?>>
			<?php echo $mastercp_ekspor_list->Negara_Tujuan->selectOptionListHtml("x_Negara_Tujuan") ?>
		</select>
</div>
<?php echo $mastercp_ekspor_list->Negara_Tujuan->Lookup->getParamTag($mastercp_ekspor_list, "p_x_Negara_Tujuan") ?>
</span>
	</div>
	<?php if ($mastercp_ekspor_list->SearchColumnCount % $mastercp_ekspor_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($mastercp_ekspor_list->SearchColumnCount % $mastercp_ekspor_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $mastercp_ekspor_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $mastercp_ekspor_list->showPageHeader(); ?>
<?php
$mastercp_ekspor_list->showMessage();
?>
<?php if ($mastercp_ekspor_list->TotalRecords > 0 || $mastercp_ekspor->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($mastercp_ekspor_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> mastercp_ekspor">
<?php if (!$mastercp_ekspor_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$mastercp_ekspor_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $mastercp_ekspor_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $mastercp_ekspor_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmastercp_eksporlist" id="fmastercp_eksporlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mastercp_ekspor">
<div id="gmp_mastercp_ekspor" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($mastercp_ekspor_list->TotalRecords > 0 || $mastercp_ekspor_list->isGridEdit()) { ?>
<table id="tbl_mastercp_eksporlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$mastercp_ekspor->RowType = ROWTYPE_HEADER;

// Render list options
$mastercp_ekspor_list->renderListOptions();

// Render list options (header, left)
$mastercp_ekspor_list->ListOptions->render("header", "left");
?>
<?php if ($mastercp_ekspor_list->Wilayah_ECP->Visible) { // Wilayah_ECP ?>
	<?php if ($mastercp_ekspor_list->SortUrl($mastercp_ekspor_list->Wilayah_ECP) == "") { ?>
		<th data-name="Wilayah_ECP" class="<?php echo $mastercp_ekspor_list->Wilayah_ECP->headerCellClass() ?>"><div id="elh_mastercp_ekspor_Wilayah_ECP" class="mastercp_ekspor_Wilayah_ECP"><div class="ew-table-header-caption"><?php echo $mastercp_ekspor_list->Wilayah_ECP->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Wilayah_ECP" class="<?php echo $mastercp_ekspor_list->Wilayah_ECP->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mastercp_ekspor_list->SortUrl($mastercp_ekspor_list->Wilayah_ECP) ?>', 1);"><div id="elh_mastercp_ekspor_Wilayah_ECP" class="mastercp_ekspor_Wilayah_ECP">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mastercp_ekspor_list->Wilayah_ECP->caption() ?></span><span class="ew-table-header-sort"><?php if ($mastercp_ekspor_list->Wilayah_ECP->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mastercp_ekspor_list->Wilayah_ECP->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mastercp_ekspor_list->Tahun_ECP->Visible) { // Tahun_ECP ?>
	<?php if ($mastercp_ekspor_list->SortUrl($mastercp_ekspor_list->Tahun_ECP) == "") { ?>
		<th data-name="Tahun_ECP" class="<?php echo $mastercp_ekspor_list->Tahun_ECP->headerCellClass() ?>"><div id="elh_mastercp_ekspor_Tahun_ECP" class="mastercp_ekspor_Tahun_ECP"><div class="ew-table-header-caption"><?php echo $mastercp_ekspor_list->Tahun_ECP->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tahun_ECP" class="<?php echo $mastercp_ekspor_list->Tahun_ECP->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mastercp_ekspor_list->SortUrl($mastercp_ekspor_list->Tahun_ECP) ?>', 1);"><div id="elh_mastercp_ekspor_Tahun_ECP" class="mastercp_ekspor_Tahun_ECP">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mastercp_ekspor_list->Tahun_ECP->caption() ?></span><span class="ew-table-header-sort"><?php if ($mastercp_ekspor_list->Tahun_ECP->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mastercp_ekspor_list->Tahun_ECP->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mastercp_ekspor_list->Nama->Visible) { // Nama ?>
	<?php if ($mastercp_ekspor_list->SortUrl($mastercp_ekspor_list->Nama) == "") { ?>
		<th data-name="Nama" class="<?php echo $mastercp_ekspor_list->Nama->headerCellClass() ?>"><div id="elh_mastercp_ekspor_Nama" class="mastercp_ekspor_Nama"><div class="ew-table-header-caption"><?php echo $mastercp_ekspor_list->Nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nama" class="<?php echo $mastercp_ekspor_list->Nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mastercp_ekspor_list->SortUrl($mastercp_ekspor_list->Nama) ?>', 1);"><div id="elh_mastercp_ekspor_Nama" class="mastercp_ekspor_Nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mastercp_ekspor_list->Nama->caption() ?></span><span class="ew-table-header-sort"><?php if ($mastercp_ekspor_list->Nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mastercp_ekspor_list->Nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mastercp_ekspor_list->Perusahaan->Visible) { // Perusahaan ?>
	<?php if ($mastercp_ekspor_list->SortUrl($mastercp_ekspor_list->Perusahaan) == "") { ?>
		<th data-name="Perusahaan" class="<?php echo $mastercp_ekspor_list->Perusahaan->headerCellClass() ?>"><div id="elh_mastercp_ekspor_Perusahaan" class="mastercp_ekspor_Perusahaan"><div class="ew-table-header-caption"><?php echo $mastercp_ekspor_list->Perusahaan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Perusahaan" class="<?php echo $mastercp_ekspor_list->Perusahaan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mastercp_ekspor_list->SortUrl($mastercp_ekspor_list->Perusahaan) ?>', 1);"><div id="elh_mastercp_ekspor_Perusahaan" class="mastercp_ekspor_Perusahaan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mastercp_ekspor_list->Perusahaan->caption() ?></span><span class="ew-table-header-sort"><?php if ($mastercp_ekspor_list->Perusahaan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mastercp_ekspor_list->Perusahaan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mastercp_ekspor_list->Produk->Visible) { // Produk ?>
	<?php if ($mastercp_ekspor_list->SortUrl($mastercp_ekspor_list->Produk) == "") { ?>
		<th data-name="Produk" class="<?php echo $mastercp_ekspor_list->Produk->headerCellClass() ?>"><div id="elh_mastercp_ekspor_Produk" class="mastercp_ekspor_Produk"><div class="ew-table-header-caption"><?php echo $mastercp_ekspor_list->Produk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Produk" class="<?php echo $mastercp_ekspor_list->Produk->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mastercp_ekspor_list->SortUrl($mastercp_ekspor_list->Produk) ?>', 1);"><div id="elh_mastercp_ekspor_Produk" class="mastercp_ekspor_Produk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mastercp_ekspor_list->Produk->caption() ?></span><span class="ew-table-header-sort"><?php if ($mastercp_ekspor_list->Produk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mastercp_ekspor_list->Produk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mastercp_ekspor_list->Nilai_Ekspor_USD->Visible) { // Nilai_Ekspor_USD ?>
	<?php if ($mastercp_ekspor_list->SortUrl($mastercp_ekspor_list->Nilai_Ekspor_USD) == "") { ?>
		<th data-name="Nilai_Ekspor_USD" class="<?php echo $mastercp_ekspor_list->Nilai_Ekspor_USD->headerCellClass() ?>"><div id="elh_mastercp_ekspor_Nilai_Ekspor_USD" class="mastercp_ekspor_Nilai_Ekspor_USD"><div class="ew-table-header-caption"><?php echo $mastercp_ekspor_list->Nilai_Ekspor_USD->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nilai_Ekspor_USD" class="<?php echo $mastercp_ekspor_list->Nilai_Ekspor_USD->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mastercp_ekspor_list->SortUrl($mastercp_ekspor_list->Nilai_Ekspor_USD) ?>', 1);"><div id="elh_mastercp_ekspor_Nilai_Ekspor_USD" class="mastercp_ekspor_Nilai_Ekspor_USD">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mastercp_ekspor_list->Nilai_Ekspor_USD->caption() ?></span><span class="ew-table-header-sort"><?php if ($mastercp_ekspor_list->Nilai_Ekspor_USD->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mastercp_ekspor_list->Nilai_Ekspor_USD->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mastercp_ekspor_list->Nilai_Ekspor_Rupiah->Visible) { // Nilai_Ekspor_Rupiah ?>
	<?php if ($mastercp_ekspor_list->SortUrl($mastercp_ekspor_list->Nilai_Ekspor_Rupiah) == "") { ?>
		<th data-name="Nilai_Ekspor_Rupiah" class="<?php echo $mastercp_ekspor_list->Nilai_Ekspor_Rupiah->headerCellClass() ?>"><div id="elh_mastercp_ekspor_Nilai_Ekspor_Rupiah" class="mastercp_ekspor_Nilai_Ekspor_Rupiah"><div class="ew-table-header-caption"><?php echo $mastercp_ekspor_list->Nilai_Ekspor_Rupiah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nilai_Ekspor_Rupiah" class="<?php echo $mastercp_ekspor_list->Nilai_Ekspor_Rupiah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mastercp_ekspor_list->SortUrl($mastercp_ekspor_list->Nilai_Ekspor_Rupiah) ?>', 1);"><div id="elh_mastercp_ekspor_Nilai_Ekspor_Rupiah" class="mastercp_ekspor_Nilai_Ekspor_Rupiah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mastercp_ekspor_list->Nilai_Ekspor_Rupiah->caption() ?></span><span class="ew-table-header-sort"><?php if ($mastercp_ekspor_list->Nilai_Ekspor_Rupiah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mastercp_ekspor_list->Nilai_Ekspor_Rupiah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mastercp_ekspor_list->Tgl_Bln_Ekspor->Visible) { // Tgl_Bln_Ekspor ?>
	<?php if ($mastercp_ekspor_list->SortUrl($mastercp_ekspor_list->Tgl_Bln_Ekspor) == "") { ?>
		<th data-name="Tgl_Bln_Ekspor" class="<?php echo $mastercp_ekspor_list->Tgl_Bln_Ekspor->headerCellClass() ?>"><div id="elh_mastercp_ekspor_Tgl_Bln_Ekspor" class="mastercp_ekspor_Tgl_Bln_Ekspor"><div class="ew-table-header-caption"><?php echo $mastercp_ekspor_list->Tgl_Bln_Ekspor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tgl_Bln_Ekspor" class="<?php echo $mastercp_ekspor_list->Tgl_Bln_Ekspor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mastercp_ekspor_list->SortUrl($mastercp_ekspor_list->Tgl_Bln_Ekspor) ?>', 1);"><div id="elh_mastercp_ekspor_Tgl_Bln_Ekspor" class="mastercp_ekspor_Tgl_Bln_Ekspor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mastercp_ekspor_list->Tgl_Bln_Ekspor->caption() ?></span><span class="ew-table-header-sort"><?php if ($mastercp_ekspor_list->Tgl_Bln_Ekspor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mastercp_ekspor_list->Tgl_Bln_Ekspor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mastercp_ekspor_list->Tahun_Ekspor->Visible) { // Tahun_Ekspor ?>
	<?php if ($mastercp_ekspor_list->SortUrl($mastercp_ekspor_list->Tahun_Ekspor) == "") { ?>
		<th data-name="Tahun_Ekspor" class="<?php echo $mastercp_ekspor_list->Tahun_Ekspor->headerCellClass() ?>"><div id="elh_mastercp_ekspor_Tahun_Ekspor" class="mastercp_ekspor_Tahun_Ekspor"><div class="ew-table-header-caption"><?php echo $mastercp_ekspor_list->Tahun_Ekspor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tahun_Ekspor" class="<?php echo $mastercp_ekspor_list->Tahun_Ekspor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mastercp_ekspor_list->SortUrl($mastercp_ekspor_list->Tahun_Ekspor) ?>', 1);"><div id="elh_mastercp_ekspor_Tahun_Ekspor" class="mastercp_ekspor_Tahun_Ekspor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mastercp_ekspor_list->Tahun_Ekspor->caption() ?></span><span class="ew-table-header-sort"><?php if ($mastercp_ekspor_list->Tahun_Ekspor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mastercp_ekspor_list->Tahun_Ekspor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mastercp_ekspor_list->Negara_Tujuan->Visible) { // Negara_Tujuan ?>
	<?php if ($mastercp_ekspor_list->SortUrl($mastercp_ekspor_list->Negara_Tujuan) == "") { ?>
		<th data-name="Negara_Tujuan" class="<?php echo $mastercp_ekspor_list->Negara_Tujuan->headerCellClass() ?>"><div id="elh_mastercp_ekspor_Negara_Tujuan" class="mastercp_ekspor_Negara_Tujuan"><div class="ew-table-header-caption"><?php echo $mastercp_ekspor_list->Negara_Tujuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Negara_Tujuan" class="<?php echo $mastercp_ekspor_list->Negara_Tujuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mastercp_ekspor_list->SortUrl($mastercp_ekspor_list->Negara_Tujuan) ?>', 1);"><div id="elh_mastercp_ekspor_Negara_Tujuan" class="mastercp_ekspor_Negara_Tujuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mastercp_ekspor_list->Negara_Tujuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($mastercp_ekspor_list->Negara_Tujuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mastercp_ekspor_list->Negara_Tujuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$mastercp_ekspor_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($mastercp_ekspor_list->ExportAll && $mastercp_ekspor_list->isExport()) {
	$mastercp_ekspor_list->StopRecord = $mastercp_ekspor_list->TotalRecords;
} else {

	// Set the last record to display
	if ($mastercp_ekspor_list->TotalRecords > $mastercp_ekspor_list->StartRecord + $mastercp_ekspor_list->DisplayRecords - 1)
		$mastercp_ekspor_list->StopRecord = $mastercp_ekspor_list->StartRecord + $mastercp_ekspor_list->DisplayRecords - 1;
	else
		$mastercp_ekspor_list->StopRecord = $mastercp_ekspor_list->TotalRecords;
}
$mastercp_ekspor_list->RecordCount = $mastercp_ekspor_list->StartRecord - 1;
if ($mastercp_ekspor_list->Recordset && !$mastercp_ekspor_list->Recordset->EOF) {
	$mastercp_ekspor_list->Recordset->moveFirst();
	$selectLimit = $mastercp_ekspor_list->UseSelectLimit;
	if (!$selectLimit && $mastercp_ekspor_list->StartRecord > 1)
		$mastercp_ekspor_list->Recordset->move($mastercp_ekspor_list->StartRecord - 1);
} elseif (!$mastercp_ekspor->AllowAddDeleteRow && $mastercp_ekspor_list->StopRecord == 0) {
	$mastercp_ekspor_list->StopRecord = $mastercp_ekspor->GridAddRowCount;
}

// Initialize aggregate
$mastercp_ekspor->RowType = ROWTYPE_AGGREGATEINIT;
$mastercp_ekspor->resetAttributes();
$mastercp_ekspor_list->renderRow();
while ($mastercp_ekspor_list->RecordCount < $mastercp_ekspor_list->StopRecord) {
	$mastercp_ekspor_list->RecordCount++;
	if ($mastercp_ekspor_list->RecordCount >= $mastercp_ekspor_list->StartRecord) {
		$mastercp_ekspor_list->RowCount++;

		// Set up key count
		$mastercp_ekspor_list->KeyCount = $mastercp_ekspor_list->RowIndex;

		// Init row class and style
		$mastercp_ekspor->resetAttributes();
		$mastercp_ekspor->CssClass = "";
		if ($mastercp_ekspor_list->isGridAdd()) {
		} else {
			$mastercp_ekspor_list->loadRowValues($mastercp_ekspor_list->Recordset); // Load row values
		}
		$mastercp_ekspor->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$mastercp_ekspor->RowAttrs->merge(["data-rowindex" => $mastercp_ekspor_list->RowCount, "id" => "r" . $mastercp_ekspor_list->RowCount . "_mastercp_ekspor", "data-rowtype" => $mastercp_ekspor->RowType]);

		// Render row
		$mastercp_ekspor_list->renderRow();

		// Render list options
		$mastercp_ekspor_list->renderListOptions();
?>
	<tr <?php echo $mastercp_ekspor->rowAttributes() ?>>
<?php

// Render list options (body, left)
$mastercp_ekspor_list->ListOptions->render("body", "left", $mastercp_ekspor_list->RowCount);
?>
	<?php if ($mastercp_ekspor_list->Wilayah_ECP->Visible) { // Wilayah_ECP ?>
		<td data-name="Wilayah_ECP" <?php echo $mastercp_ekspor_list->Wilayah_ECP->cellAttributes() ?>>
<span id="el<?php echo $mastercp_ekspor_list->RowCount ?>_mastercp_ekspor_Wilayah_ECP">
<span<?php echo $mastercp_ekspor_list->Wilayah_ECP->viewAttributes() ?>><?php echo $mastercp_ekspor_list->Wilayah_ECP->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mastercp_ekspor_list->Tahun_ECP->Visible) { // Tahun_ECP ?>
		<td data-name="Tahun_ECP" <?php echo $mastercp_ekspor_list->Tahun_ECP->cellAttributes() ?>>
<span id="el<?php echo $mastercp_ekspor_list->RowCount ?>_mastercp_ekspor_Tahun_ECP">
<span<?php echo $mastercp_ekspor_list->Tahun_ECP->viewAttributes() ?>><?php echo $mastercp_ekspor_list->Tahun_ECP->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mastercp_ekspor_list->Nama->Visible) { // Nama ?>
		<td data-name="Nama" <?php echo $mastercp_ekspor_list->Nama->cellAttributes() ?>>
<span id="el<?php echo $mastercp_ekspor_list->RowCount ?>_mastercp_ekspor_Nama">
<span<?php echo $mastercp_ekspor_list->Nama->viewAttributes() ?>><?php echo $mastercp_ekspor_list->Nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mastercp_ekspor_list->Perusahaan->Visible) { // Perusahaan ?>
		<td data-name="Perusahaan" <?php echo $mastercp_ekspor_list->Perusahaan->cellAttributes() ?>>
<span id="el<?php echo $mastercp_ekspor_list->RowCount ?>_mastercp_ekspor_Perusahaan">
<span<?php echo $mastercp_ekspor_list->Perusahaan->viewAttributes() ?>><?php echo $mastercp_ekspor_list->Perusahaan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mastercp_ekspor_list->Produk->Visible) { // Produk ?>
		<td data-name="Produk" <?php echo $mastercp_ekspor_list->Produk->cellAttributes() ?>>
<span id="el<?php echo $mastercp_ekspor_list->RowCount ?>_mastercp_ekspor_Produk">
<span<?php echo $mastercp_ekspor_list->Produk->viewAttributes() ?>><?php echo $mastercp_ekspor_list->Produk->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mastercp_ekspor_list->Nilai_Ekspor_USD->Visible) { // Nilai_Ekspor_USD ?>
		<td data-name="Nilai_Ekspor_USD" <?php echo $mastercp_ekspor_list->Nilai_Ekspor_USD->cellAttributes() ?>>
<span id="el<?php echo $mastercp_ekspor_list->RowCount ?>_mastercp_ekspor_Nilai_Ekspor_USD">
<span<?php echo $mastercp_ekspor_list->Nilai_Ekspor_USD->viewAttributes() ?>><?php echo $mastercp_ekspor_list->Nilai_Ekspor_USD->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mastercp_ekspor_list->Nilai_Ekspor_Rupiah->Visible) { // Nilai_Ekspor_Rupiah ?>
		<td data-name="Nilai_Ekspor_Rupiah" <?php echo $mastercp_ekspor_list->Nilai_Ekspor_Rupiah->cellAttributes() ?>>
<span id="el<?php echo $mastercp_ekspor_list->RowCount ?>_mastercp_ekspor_Nilai_Ekspor_Rupiah">
<span<?php echo $mastercp_ekspor_list->Nilai_Ekspor_Rupiah->viewAttributes() ?>><?php echo $mastercp_ekspor_list->Nilai_Ekspor_Rupiah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mastercp_ekspor_list->Tgl_Bln_Ekspor->Visible) { // Tgl_Bln_Ekspor ?>
		<td data-name="Tgl_Bln_Ekspor" <?php echo $mastercp_ekspor_list->Tgl_Bln_Ekspor->cellAttributes() ?>>
<span id="el<?php echo $mastercp_ekspor_list->RowCount ?>_mastercp_ekspor_Tgl_Bln_Ekspor">
<span<?php echo $mastercp_ekspor_list->Tgl_Bln_Ekspor->viewAttributes() ?>><?php echo $mastercp_ekspor_list->Tgl_Bln_Ekspor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mastercp_ekspor_list->Tahun_Ekspor->Visible) { // Tahun_Ekspor ?>
		<td data-name="Tahun_Ekspor" <?php echo $mastercp_ekspor_list->Tahun_Ekspor->cellAttributes() ?>>
<span id="el<?php echo $mastercp_ekspor_list->RowCount ?>_mastercp_ekspor_Tahun_Ekspor">
<span<?php echo $mastercp_ekspor_list->Tahun_Ekspor->viewAttributes() ?>><?php echo $mastercp_ekspor_list->Tahun_Ekspor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mastercp_ekspor_list->Negara_Tujuan->Visible) { // Negara_Tujuan ?>
		<td data-name="Negara_Tujuan" <?php echo $mastercp_ekspor_list->Negara_Tujuan->cellAttributes() ?>>
<span id="el<?php echo $mastercp_ekspor_list->RowCount ?>_mastercp_ekspor_Negara_Tujuan">
<span<?php echo $mastercp_ekspor_list->Negara_Tujuan->viewAttributes() ?>><?php echo $mastercp_ekspor_list->Negara_Tujuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$mastercp_ekspor_list->ListOptions->render("body", "right", $mastercp_ekspor_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$mastercp_ekspor_list->isGridAdd())
		$mastercp_ekspor_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$mastercp_ekspor->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($mastercp_ekspor_list->Recordset)
	$mastercp_ekspor_list->Recordset->Close();
?>
<?php if (!$mastercp_ekspor_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$mastercp_ekspor_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $mastercp_ekspor_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $mastercp_ekspor_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($mastercp_ekspor_list->TotalRecords == 0 && !$mastercp_ekspor->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $mastercp_ekspor_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$mastercp_ekspor_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$mastercp_ekspor_list->isExport()) { ?>
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
$mastercp_ekspor_list->terminate();
?>