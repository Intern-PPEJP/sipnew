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
$t_rpdiklat_list = new t_rpdiklat_list();

// Run the page
$t_rpdiklat_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rpdiklat_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_rpdiklat_list->isExport()) { ?>

<script>
var ft_rpdiklatlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_rpdiklatlist = currentForm = new ew.Form("ft_rpdiklatlist", "list");
	ft_rpdiklatlist.formKeyCountName = '<?php echo $t_rpdiklat_list->FormKeyCountName ?>';
	loadjs.done("ft_rpdiklatlist");
});
var ft_rpdiklatlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_rpdiklatlistsrch = currentSearchForm = new ew.Form("ft_rpdiklatlistsrch");

	// Validate function for search
	ft_rpdiklatlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_tahun_rencana");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_rpdiklat_list->tahun_rencana->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	ft_rpdiklatlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_rpdiklatlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_rpdiklatlistsrch.lists["x_kdjudul"] = <?php echo $t_rpdiklat_list->kdjudul->Lookup->toClientList($t_rpdiklat_list) ?>;
	ft_rpdiklatlistsrch.lists["x_kdjudul"].options = <?php echo JsonEncode($t_rpdiklat_list->kdjudul->lookupOptions()) ?>;
	ft_rpdiklatlistsrch.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_rpdiklatlistsrch.lists["x_kdbidang"] = <?php echo $t_rpdiklat_list->kdbidang->Lookup->toClientList($t_rpdiklat_list) ?>;
	ft_rpdiklatlistsrch.lists["x_kdbidang"].options = <?php echo JsonEncode($t_rpdiklat_list->kdbidang->lookupOptions()) ?>;

	// Filters
	ft_rpdiklatlistsrch.filterList = <?php echo $t_rpdiklat_list->getFilterList() ?>;
	loadjs.done("ft_rpdiklatlistsrch");
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

<?php if (!$t_rpdiklat_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_rpdiklat_list->TotalRecords > 0 && $t_rpdiklat_list->ExportOptions->visible()) { ?>
<?php $t_rpdiklat_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_rpdiklat_list->ImportOptions->visible()) { ?>
<?php $t_rpdiklat_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_rpdiklat_list->SearchOptions->visible()) { ?>
<?php $t_rpdiklat_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_rpdiklat_list->FilterOptions->visible()) { ?>
<?php $t_rpdiklat_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>

<?php
$t_rpdiklat_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_rpdiklat_list->isExport() && !$t_rpdiklat->CurrentAction) { ?>
<form name="ft_rpdiklatlistsrch" id="ft_rpdiklatlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_rpdiklatlistsrch-search-panel" class="<?php echo $t_rpdiklat_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_rpdiklat">
	<div class="ew-extended-search">
<?php

// Render search row
$t_rpdiklat->RowType = ROWTYPE_SEARCH;
$t_rpdiklat->resetAttributes();
$t_rpdiklat_list->renderRow();
?>

<style>
	.ew-cell {
    display: flex;
    align-items: left; /* Untuk menyejajarkan label dan input secara vertikal */
    margin-bottom: 10px; /* Tambahkan margin antar elemen */
}

.ew-search-caption {
    width: 150px; /* Atur lebar label agar seragam */
    text-align: left !important;
    padding-right: 10px;
	justify-content: left !important;
}

.ew-search-field input,
.ew-search-field select {
    width: 300px; /* Atur lebar input dan select agar seragam */
}

.input-group .custom-select {
    width: 300px; /* Atur lebar select di dalam input-group */
}

</style>

<?php if ($t_rpdiklat_list->kdjudul->Visible) { // kdjudul ?>
	<?php
		$t_rpdiklat_list->SearchColumnCount++;
		if (($t_rpdiklat_list->SearchColumnCount - 1) % $t_rpdiklat_list->SearchFieldsPerRow == 0) {
			$t_rpdiklat_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_rpdiklat_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kdjudul" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $t_rpdiklat_list->kdjudul->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdjudul" id="z_kdjudul" value="=">
</span>
		<span id="el_t_rpdiklat_kdjudul" class="ew-search-field">
<?php
$onchange = $t_rpdiklat_list->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_rpdiklat_list->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($t_rpdiklat_list->kdjudul->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($t_rpdiklat_list->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_rpdiklat_list->kdjudul->getPlaceHolder()) ?>"<?php echo $t_rpdiklat_list->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_rpdiklat" data-field="x_kdjudul" data-value-separator="<?php echo $t_rpdiklat_list->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($t_rpdiklat_list->kdjudul->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_rpdiklatlistsrch"], function() {
	ft_rpdiklatlistsrch.createAutoSuggest({"id":"x_kdjudul","forceSelect":false,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $t_rpdiklat_list->kdjudul->Lookup->getParamTag($t_rpdiklat_list, "p_x_kdjudul") ?>
</span>
	</div>
	<?php if ($t_rpdiklat_list->SearchColumnCount % $t_rpdiklat_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>

<?php if ($t_rpdiklat_list->kdbidang->Visible) { // kdbidang ?>
	<?php
		$t_rpdiklat_list->SearchColumnCount++;
		if (($t_rpdiklat_list->SearchColumnCount - 1) % $t_rpdiklat_list->SearchFieldsPerRow == 0) {
			$t_rpdiklat_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_rpdiklat_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kdbidang" class="ew-cell form-group">
		<label for="x_kdbidang" class="ew-search-caption ew-label"><?php echo $t_rpdiklat_list->kdbidang->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdbidang" id="z_kdbidang" value="=">
</span>
		<span id="el_t_rpdiklat_kdbidang" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_rpdiklat" data-field="x_kdbidang" data-value-separator="<?php echo $t_rpdiklat_list->kdbidang->displayValueSeparatorAttribute() ?>" id="x_kdbidang" name="x_kdbidang"<?php echo $t_rpdiklat_list->kdbidang->editAttributes() ?>>
			<?php echo $t_rpdiklat_list->kdbidang->selectOptionListHtml("x_kdbidang") ?>
		</select>
</div>
<?php echo $t_rpdiklat_list->kdbidang->Lookup->getParamTag($t_rpdiklat_list, "p_x_kdbidang") ?>
</span>
	</div>
	<?php if ($t_rpdiklat_list->SearchColumnCount % $t_rpdiklat_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>

<?php if ($t_rpdiklat_list->tahun_rencana->Visible) { // tahun_rencana ?>
	<?php
		$t_rpdiklat_list->SearchColumnCount++;
		if (($t_rpdiklat_list->SearchColumnCount - 1) % $t_rpdiklat_list->SearchFieldsPerRow == 0) {
			$t_rpdiklat_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_rpdiklat_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_tahun_rencana" class="ew-cell form-group">
		<label for="x_tahun_rencana" class="ew-search-caption ew-label"><?php echo $t_rpdiklat_list->tahun_rencana->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tahun_rencana" id="z_tahun_rencana" value="=">
</span>
		<span id="el_t_rpdiklat_tahun_rencana" class="ew-search-field">
<input type="text" data-table="t_rpdiklat" data-field="x_tahun_rencana" name="x_tahun_rencana" id="x_tahun_rencana" size="13" maxlength="4" placeholder="<?php echo HtmlEncode($t_rpdiklat_list->tahun_rencana->getPlaceHolder()) ?>" value="<?php echo $t_rpdiklat_list->tahun_rencana->EditValue ?>"<?php echo $t_rpdiklat_list->tahun_rencana->editAttributes() ?>>
</span>
	</div>
	<?php if ($t_rpdiklat_list->SearchColumnCount % $t_rpdiklat_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($t_rpdiklat_list->SearchColumnCount % $t_rpdiklat_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $t_rpdiklat_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_rpdiklat_list->showPageHeader(); ?>
<?php
$t_rpdiklat_list->showMessage();
?>
<?php if ($t_rpdiklat_list->TotalRecords > 0 || $t_rpdiklat->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_rpdiklat_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_rpdiklat">
<?php if (!$t_rpdiklat_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_rpdiklat_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_rpdiklat_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_rpdiklat_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_rpdiklatlist" id="ft_rpdiklatlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rpdiklat">
<div id="gmp_t_rpdiklat" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_rpdiklat_list->TotalRecords > 0 || $t_rpdiklat_list->isGridEdit()) { ?>
<table id="tbl_t_rpdiklatlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_rpdiklat->RowType = ROWTYPE_HEADER;

// Render list options
$t_rpdiklat_list->renderListOptions();

// Render list options (header, left)
$t_rpdiklat_list->ListOptions->render("header", "left");
?>
<?php if ($t_rpdiklat_list->kdjudul->Visible) { // kdjudul ?>
	<?php if ($t_rpdiklat_list->SortUrl($t_rpdiklat_list->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $t_rpdiklat_list->kdjudul->headerCellClass() ?>"><div id="elh_t_rpdiklat_kdjudul" class="t_rpdiklat_kdjudul"><div class="ew-table-header-caption"><?php echo $t_rpdiklat_list->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $t_rpdiklat_list->kdjudul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rpdiklat_list->SortUrl($t_rpdiklat_list->kdjudul) ?>', 1);"><div id="elh_t_rpdiklat_kdjudul" class="t_rpdiklat_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rpdiklat_list->kdjudul->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rpdiklat_list->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rpdiklat_list->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rpdiklat_list->kdbidang->Visible) { // kdbidang ?>
	<?php if ($t_rpdiklat_list->SortUrl($t_rpdiklat_list->kdbidang) == "") { ?>
		<th data-name="kdbidang" class="<?php echo $t_rpdiklat_list->kdbidang->headerCellClass() ?>"><div id="elh_t_rpdiklat_kdbidang" class="t_rpdiklat_kdbidang"><div class="ew-table-header-caption"><?php echo $t_rpdiklat_list->kdbidang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdbidang" class="<?php echo $t_rpdiklat_list->kdbidang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rpdiklat_list->SortUrl($t_rpdiklat_list->kdbidang) ?>', 1);"><div id="elh_t_rpdiklat_kdbidang" class="t_rpdiklat_kdbidang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rpdiklat_list->kdbidang->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rpdiklat_list->kdbidang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rpdiklat_list->kdbidang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rpdiklat_list->jml_hari->Visible) { // jml_hari ?>
	<?php if ($t_rpdiklat_list->SortUrl($t_rpdiklat_list->jml_hari) == "") { ?>
		<th data-name="jml_hari" class="<?php echo $t_rpdiklat_list->jml_hari->headerCellClass() ?>"><div id="elh_t_rpdiklat_jml_hari" class="t_rpdiklat_jml_hari"><div class="ew-table-header-caption"><?php echo $t_rpdiklat_list->jml_hari->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jml_hari" class="<?php echo $t_rpdiklat_list->jml_hari->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rpdiklat_list->SortUrl($t_rpdiklat_list->jml_hari) ?>', 1);"><div id="elh_t_rpdiklat_jml_hari" class="t_rpdiklat_jml_hari">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rpdiklat_list->jml_hari->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rpdiklat_list->jml_hari->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rpdiklat_list->jml_hari->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rpdiklat_list->jenisdurasi->Visible) { // jenisdurasi ?>
	<?php if ($t_rpdiklat_list->SortUrl($t_rpdiklat_list->jenisdurasi) == "") { ?>
		<th data-name="jenisdurasi" class="<?php echo $t_rpdiklat_list->jenisdurasi->headerCellClass() ?>"><div id="elh_t_rpdiklat_jenisdurasi" class="t_rpdiklat_jenisdurasi"><div class="ew-table-header-caption"><?php echo $t_rpdiklat_list->jenisdurasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenisdurasi" class="<?php echo $t_rpdiklat_list->jenisdurasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rpdiklat_list->SortUrl($t_rpdiklat_list->jenisdurasi) ?>', 1);"><div id="elh_t_rpdiklat_jenisdurasi" class="t_rpdiklat_jenisdurasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rpdiklat_list->jenisdurasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rpdiklat_list->jenisdurasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rpdiklat_list->jenisdurasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rpdiklat_list->targetpes->Visible) { // targetpes ?>
	<?php if ($t_rpdiklat_list->SortUrl($t_rpdiklat_list->targetpes) == "") { ?>
		<th data-name="targetpes" class="<?php echo $t_rpdiklat_list->targetpes->headerCellClass() ?>"><div id="elh_t_rpdiklat_targetpes" class="t_rpdiklat_targetpes"><div class="ew-table-header-caption"><?php echo $t_rpdiklat_list->targetpes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes" class="<?php echo $t_rpdiklat_list->targetpes->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rpdiklat_list->SortUrl($t_rpdiklat_list->targetpes) ?>', 1);"><div id="elh_t_rpdiklat_targetpes" class="t_rpdiklat_targetpes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rpdiklat_list->targetpes->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rpdiklat_list->targetpes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rpdiklat_list->targetpes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rpdiklat_list->angkatan->Visible) { // angkatan ?>
	<?php if ($t_rpdiklat_list->SortUrl($t_rpdiklat_list->angkatan) == "") { ?>
		<th data-name="angkatan" class="<?php echo $t_rpdiklat_list->angkatan->headerCellClass() ?>"><div id="elh_t_rpdiklat_angkatan" class="t_rpdiklat_angkatan"><div class="ew-table-header-caption"><?php echo $t_rpdiklat_list->angkatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="angkatan" class="<?php echo $t_rpdiklat_list->angkatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rpdiklat_list->SortUrl($t_rpdiklat_list->angkatan) ?>', 1);"><div id="elh_t_rpdiklat_angkatan" class="t_rpdiklat_angkatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rpdiklat_list->angkatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rpdiklat_list->angkatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rpdiklat_list->angkatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rpdiklat_list->sisa_angkatan->Visible) { // sisa_angkatan ?>
	<?php if ($t_rpdiklat_list->SortUrl($t_rpdiklat_list->sisa_angkatan) == "") { ?>
		<th data-name="sisa_angkatan" class="<?php echo $t_rpdiklat_list->sisa_angkatan->headerCellClass() ?>"><div id="elh_t_rpdiklat_sisa_angkatan" class="t_rpdiklat_sisa_angkatan"><div class="ew-table-header-caption"><?php echo $t_rpdiklat_list->sisa_angkatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sisa_angkatan" class="<?php echo $t_rpdiklat_list->sisa_angkatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rpdiklat_list->SortUrl($t_rpdiklat_list->sisa_angkatan) ?>', 1);"><div id="elh_t_rpdiklat_sisa_angkatan" class="t_rpdiklat_sisa_angkatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rpdiklat_list->sisa_angkatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rpdiklat_list->sisa_angkatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rpdiklat_list->sisa_angkatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rpdiklat_list->harga_satuan->Visible) { // harga_satuan ?>
	<?php if ($t_rpdiklat_list->SortUrl($t_rpdiklat_list->harga_satuan) == "") { ?>
		<th data-name="harga_satuan" class="<?php echo $t_rpdiklat_list->harga_satuan->headerCellClass() ?>"><div id="elh_t_rpdiklat_harga_satuan" class="t_rpdiklat_harga_satuan"><div class="ew-table-header-caption"><?php echo $t_rpdiklat_list->harga_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="harga_satuan" class="<?php echo $t_rpdiklat_list->harga_satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rpdiklat_list->SortUrl($t_rpdiklat_list->harga_satuan) ?>', 1);"><div id="elh_t_rpdiklat_harga_satuan" class="t_rpdiklat_harga_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rpdiklat_list->harga_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rpdiklat_list->harga_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rpdiklat_list->harga_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rpdiklat_list->tahun_rencana->Visible) { // tahun_rencana ?>
	<?php if ($t_rpdiklat_list->SortUrl($t_rpdiklat_list->tahun_rencana) == "") { ?>
		<th data-name="tahun_rencana" class="<?php echo $t_rpdiklat_list->tahun_rencana->headerCellClass() ?>"><div id="elh_t_rpdiklat_tahun_rencana" class="t_rpdiklat_tahun_rencana"><div class="ew-table-header-caption"><?php echo $t_rpdiklat_list->tahun_rencana->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun_rencana" class="<?php echo $t_rpdiklat_list->tahun_rencana->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rpdiklat_list->SortUrl($t_rpdiklat_list->tahun_rencana) ?>', 1);"><div id="elh_t_rpdiklat_tahun_rencana" class="t_rpdiklat_tahun_rencana">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rpdiklat_list->tahun_rencana->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rpdiklat_list->tahun_rencana->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rpdiklat_list->tahun_rencana->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_rpdiklat_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_rpdiklat_list->ExportAll && $t_rpdiklat_list->isExport()) {
	$t_rpdiklat_list->StopRecord = $t_rpdiklat_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_rpdiklat_list->TotalRecords > $t_rpdiklat_list->StartRecord + $t_rpdiklat_list->DisplayRecords - 1)
		$t_rpdiklat_list->StopRecord = $t_rpdiklat_list->StartRecord + $t_rpdiklat_list->DisplayRecords - 1;
	else
		$t_rpdiklat_list->StopRecord = $t_rpdiklat_list->TotalRecords;
}
$t_rpdiklat_list->RecordCount = $t_rpdiklat_list->StartRecord - 1;
if ($t_rpdiklat_list->Recordset && !$t_rpdiklat_list->Recordset->EOF) {
	$t_rpdiklat_list->Recordset->moveFirst();
	$selectLimit = $t_rpdiklat_list->UseSelectLimit;
	if (!$selectLimit && $t_rpdiklat_list->StartRecord > 1)
		$t_rpdiklat_list->Recordset->move($t_rpdiklat_list->StartRecord - 1);
} elseif (!$t_rpdiklat->AllowAddDeleteRow && $t_rpdiklat_list->StopRecord == 0) {
	$t_rpdiklat_list->StopRecord = $t_rpdiklat->GridAddRowCount;
}

// Initialize aggregate
$t_rpdiklat->RowType = ROWTYPE_AGGREGATEINIT;
$t_rpdiklat->resetAttributes();
$t_rpdiklat_list->renderRow();
while ($t_rpdiklat_list->RecordCount < $t_rpdiklat_list->StopRecord) {
	$t_rpdiklat_list->RecordCount++;
	if ($t_rpdiklat_list->RecordCount >= $t_rpdiklat_list->StartRecord) {
		$t_rpdiklat_list->RowCount++;

		// Set up key count
		$t_rpdiklat_list->KeyCount = $t_rpdiklat_list->RowIndex;

		// Init row class and style
		$t_rpdiklat->resetAttributes();
		$t_rpdiklat->CssClass = "";
		if ($t_rpdiklat_list->isGridAdd()) {
		} else {
			$t_rpdiklat_list->loadRowValues($t_rpdiklat_list->Recordset); // Load row values
		}
		$t_rpdiklat->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_rpdiklat->RowAttrs->merge(["data-rowindex" => $t_rpdiklat_list->RowCount, "id" => "r" . $t_rpdiklat_list->RowCount . "_t_rpdiklat", "data-rowtype" => $t_rpdiklat->RowType]);

		// Render row
		$t_rpdiklat_list->renderRow();

		// Render list options
		$t_rpdiklat_list->renderListOptions();
?>
	<tr <?php echo $t_rpdiklat->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_rpdiklat_list->ListOptions->render("body", "left", $t_rpdiklat_list->RowCount);
?>
	<?php if ($t_rpdiklat_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $t_rpdiklat_list->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $t_rpdiklat_list->RowCount ?>_t_rpdiklat_kdjudul">
<span<?php echo $t_rpdiklat_list->kdjudul->viewAttributes() ?>><?php echo $t_rpdiklat_list->kdjudul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rpdiklat_list->kdbidang->Visible) { // kdbidang ?>
		<td data-name="kdbidang" <?php echo $t_rpdiklat_list->kdbidang->cellAttributes() ?>>
<span id="el<?php echo $t_rpdiklat_list->RowCount ?>_t_rpdiklat_kdbidang">
<span<?php echo $t_rpdiklat_list->kdbidang->viewAttributes() ?>><?php echo $t_rpdiklat_list->kdbidang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rpdiklat_list->jml_hari->Visible) { // jml_hari ?>
		<td data-name="jml_hari" <?php echo $t_rpdiklat_list->jml_hari->cellAttributes() ?>>
<span id="el<?php echo $t_rpdiklat_list->RowCount ?>_t_rpdiklat_jml_hari">
<span<?php echo $t_rpdiklat_list->jml_hari->viewAttributes() ?>><?php echo $t_rpdiklat_list->jml_hari->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rpdiklat_list->jenisdurasi->Visible) { // jenisdurasi ?>
		<td data-name="jenisdurasi" <?php echo $t_rpdiklat_list->jenisdurasi->cellAttributes() ?>>
<span id="el<?php echo $t_rpdiklat_list->RowCount ?>_t_rpdiklat_jenisdurasi">
<span<?php echo $t_rpdiklat_list->jenisdurasi->viewAttributes() ?>><?php echo $t_rpdiklat_list->jenisdurasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rpdiklat_list->targetpes->Visible) { // targetpes ?>
		<td data-name="targetpes" <?php echo $t_rpdiklat_list->targetpes->cellAttributes() ?>>
<span id="el<?php echo $t_rpdiklat_list->RowCount ?>_t_rpdiklat_targetpes">
<span<?php echo $t_rpdiklat_list->targetpes->viewAttributes() ?>><?php echo $t_rpdiklat_list->targetpes->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rpdiklat_list->angkatan->Visible) { // angkatan ?>
		<td data-name="angkatan" <?php echo $t_rpdiklat_list->angkatan->cellAttributes() ?>>
<span id="el<?php echo $t_rpdiklat_list->RowCount ?>_t_rpdiklat_angkatan">
<span<?php echo $t_rpdiklat_list->angkatan->viewAttributes() ?>><?php echo $t_rpdiklat_list->angkatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rpdiklat_list->sisa_angkatan->Visible) { // sisa_angkatan ?>
		<td data-name="sisa_angkatan" <?php echo $t_rpdiklat_list->sisa_angkatan->cellAttributes() ?>>
<span id="el<?php echo $t_rpdiklat_list->RowCount ?>_t_rpdiklat_sisa_angkatan">
<span<?php echo $t_rpdiklat_list->sisa_angkatan->viewAttributes() ?>><?php echo $t_rpdiklat_list->sisa_angkatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rpdiklat_list->harga_satuan->Visible) { // harga_satuan ?>
		<td data-name="harga_satuan" <?php echo $t_rpdiklat_list->harga_satuan->cellAttributes() ?>>
<span id="el<?php echo $t_rpdiklat_list->RowCount ?>_t_rpdiklat_harga_satuan">
<span<?php echo $t_rpdiklat_list->harga_satuan->viewAttributes() ?>><?php echo $t_rpdiklat_list->harga_satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rpdiklat_list->tahun_rencana->Visible) { // tahun_rencana ?>
		<td data-name="tahun_rencana" <?php echo $t_rpdiklat_list->tahun_rencana->cellAttributes() ?>>
<span id="el<?php echo $t_rpdiklat_list->RowCount ?>_t_rpdiklat_tahun_rencana">
<span<?php echo $t_rpdiklat_list->tahun_rencana->viewAttributes() ?>><?php echo $t_rpdiklat_list->tahun_rencana->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_rpdiklat_list->ListOptions->render("body", "right", $t_rpdiklat_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_rpdiklat_list->isGridAdd())
		$t_rpdiklat_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$t_rpdiklat->RowType = ROWTYPE_AGGREGATE;
$t_rpdiklat->resetAttributes();
$t_rpdiklat_list->renderRow();
?>
<?php if ($t_rpdiklat_list->TotalRecords > 0 && !$t_rpdiklat_list->isGridAdd() && !$t_rpdiklat_list->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$t_rpdiklat_list->renderListOptions();

// Render list options (footer, left)
$t_rpdiklat_list->ListOptions->render("footer", "left");
?>
	<?php if ($t_rpdiklat_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" class="<?php echo $t_rpdiklat_list->kdjudul->footerCellClass() ?>"><span id="elf_t_rpdiklat_kdjudul" class="t_rpdiklat_kdjudul">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_rpdiklat_list->kdbidang->Visible) { // kdbidang ?>
		<td data-name="kdbidang" class="<?php echo $t_rpdiklat_list->kdbidang->footerCellClass() ?>"><span id="elf_t_rpdiklat_kdbidang" class="t_rpdiklat_kdbidang">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_rpdiklat_list->jml_hari->Visible) { // jml_hari ?>
		<td data-name="jml_hari" class="<?php echo $t_rpdiklat_list->jml_hari->footerCellClass() ?>"><span id="elf_t_rpdiklat_jml_hari" class="t_rpdiklat_jml_hari">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_rpdiklat_list->jenisdurasi->Visible) { // jenisdurasi ?>
		<td data-name="jenisdurasi" class="<?php echo $t_rpdiklat_list->jenisdurasi->footerCellClass() ?>"><span id="elf_t_rpdiklat_jenisdurasi" class="t_rpdiklat_jenisdurasi">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_rpdiklat_list->targetpes->Visible) { // targetpes ?>
		<td data-name="targetpes" class="<?php echo $t_rpdiklat_list->targetpes->footerCellClass() ?>"><span id="elf_t_rpdiklat_targetpes" class="t_rpdiklat_targetpes">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $t_rpdiklat_list->targetpes->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($t_rpdiklat_list->angkatan->Visible) { // angkatan ?>
		<td data-name="angkatan" class="<?php echo $t_rpdiklat_list->angkatan->footerCellClass() ?>"><span id="elf_t_rpdiklat_angkatan" class="t_rpdiklat_angkatan">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $t_rpdiklat_list->angkatan->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($t_rpdiklat_list->sisa_angkatan->Visible) { // sisa_angkatan ?>
		<td data-name="sisa_angkatan" class="<?php echo $t_rpdiklat_list->sisa_angkatan->footerCellClass() ?>"><span id="elf_t_rpdiklat_sisa_angkatan" class="t_rpdiklat_sisa_angkatan">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_rpdiklat_list->harga_satuan->Visible) { // harga_satuan ?>
		<td data-name="harga_satuan" class="<?php echo $t_rpdiklat_list->harga_satuan->footerCellClass() ?>"><span id="elf_t_rpdiklat_harga_satuan" class="t_rpdiklat_harga_satuan">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_rpdiklat_list->tahun_rencana->Visible) { // tahun_rencana ?>
		<td data-name="tahun_rencana" class="<?php echo $t_rpdiklat_list->tahun_rencana->footerCellClass() ?>"><span id="elf_t_rpdiklat_tahun_rencana" class="t_rpdiklat_tahun_rencana">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$t_rpdiklat_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_rpdiklat->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_rpdiklat_list->Recordset)
	$t_rpdiklat_list->Recordset->Close();
?>
<?php if (!$t_rpdiklat_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_rpdiklat_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_rpdiklat_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_rpdiklat_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_rpdiklat_list->TotalRecords == 0 && !$t_rpdiklat->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_rpdiklat_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_rpdiklat_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_rpdiklat_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$(".ewDetail").hide();
});
</script>
<?php if (!$t_rpdiklat->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_t_rpdiklat",
		width: "100%",
		height: "350px"
	});
});
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$t_rpdiklat_list->terminate();
?>