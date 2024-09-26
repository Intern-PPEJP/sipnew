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
$cv_pelrepes_list = new cv_pelrepes_list();

// Run the page
$cv_pelrepes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cv_pelrepes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cv_pelrepes_list->isExport()) { ?>
<script>
var fcv_pelrepeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcv_pelrepeslist = currentForm = new ew.Form("fcv_pelrepeslist", "list");
	fcv_pelrepeslist.formKeyCountName = '<?php echo $cv_pelrepes_list->FormKeyCountName ?>';
	loadjs.done("fcv_pelrepeslist");
});
var fcv_pelrepeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcv_pelrepeslistsrch = currentSearchForm = new ew.Form("fcv_pelrepeslistsrch");

	// Validate function for search
	fcv_pelrepeslistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_tahun_pelatihan");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($cv_pelrepes_list->tahun_pelatihan->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fcv_pelrepeslistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcv_pelrepeslistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcv_pelrepeslistsrch.lists["x_kdjudul"] = <?php echo $cv_pelrepes_list->kdjudul->Lookup->toClientList($cv_pelrepes_list) ?>;
	fcv_pelrepeslistsrch.lists["x_kdjudul"].options = <?php echo JsonEncode($cv_pelrepes_list->kdjudul->lookupOptions()) ?>;
	fcv_pelrepeslistsrch.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcv_pelrepeslistsrch.lists["x_kdprop"] = <?php echo $cv_pelrepes_list->kdprop->Lookup->toClientList($cv_pelrepes_list) ?>;
	fcv_pelrepeslistsrch.lists["x_kdprop"].options = <?php echo JsonEncode($cv_pelrepes_list->kdprop->lookupOptions()) ?>;
	fcv_pelrepeslistsrch.lists["x_kdkota"] = <?php echo $cv_pelrepes_list->kdkota->Lookup->toClientList($cv_pelrepes_list) ?>;
	fcv_pelrepeslistsrch.lists["x_kdkota"].options = <?php echo JsonEncode($cv_pelrepes_list->kdkota->lookupOptions()) ?>;
	fcv_pelrepeslistsrch.lists["x_statuspel"] = <?php echo $cv_pelrepes_list->statuspel->Lookup->toClientList($cv_pelrepes_list) ?>;
	fcv_pelrepeslistsrch.lists["x_statuspel"].options = <?php echo JsonEncode($cv_pelrepes_list->statuspel->options(FALSE, TRUE)) ?>;

	// Filters
	fcv_pelrepeslistsrch.filterList = <?php echo $cv_pelrepes_list->getFilterList() ?>;
	loadjs.done("fcv_pelrepeslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$cv_pelrepes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cv_pelrepes_list->TotalRecords > 0 && $cv_pelrepes_list->ExportOptions->visible()) { ?>
<?php $cv_pelrepes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cv_pelrepes_list->ImportOptions->visible()) { ?>
<?php $cv_pelrepes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($cv_pelrepes_list->SearchOptions->visible()) { ?>
<?php $cv_pelrepes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($cv_pelrepes_list->FilterOptions->visible()) { ?>
<?php $cv_pelrepes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>

<?php } ?>


<?php
$cv_pelrepes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$cv_pelrepes_list->isExport() && !$cv_pelrepes->CurrentAction) { ?>


<form name="fcv_pelrepeslistsrch" id="fcv_pelrepeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcv_pelrepeslistsrch-search-panel" class="<?php echo $cv_pelrepes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cv_pelrepes">
	<div class="ew-extended-search">

<?php
// Render search row
$cv_pelrepes->RowType = ROWTYPE_SEARCH;
$cv_pelrepes->resetAttributes();
$cv_pelrepes_list->renderRow();
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


<?php if ($cv_pelrepes_list->kdjudul->Visible) { // kdjudul ?>
	<?php
		$cv_pelrepes_list->SearchColumnCount++;
		if (($cv_pelrepes_list->SearchColumnCount - 1) % $cv_pelrepes_list->SearchFieldsPerRow == 0) {
			$cv_pelrepes_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $cv_pelrepes_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kdjudul" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $cv_pelrepes_list->kdjudul->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdjudul" id="z_kdjudul" value="=">
</span>
		<span id="el_cv_pelrepes_kdjudul" class="ew-search-field">
<?php
$onchange = $cv_pelrepes_list->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_pelrepes_list->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($cv_pelrepes_list->kdjudul->EditValue) ?>" size="60" placeholder="<?php echo HtmlEncode($cv_pelrepes_list->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_pelrepes_list->kdjudul->getPlaceHolder()) ?>"<?php echo $cv_pelrepes_list->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="cv_pelrepes" data-field="x_kdjudul" data-value-separator="<?php echo $cv_pelrepes_list->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($cv_pelrepes_list->kdjudul->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_pelrepeslistsrch"], function() {
	fcv_pelrepeslistsrch.createAutoSuggest({"id":"x_kdjudul","forceSelect":false,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $cv_pelrepes_list->kdjudul->Lookup->getParamTag($cv_pelrepes_list, "p_x_kdjudul") ?>
</span>
	</div>
	<?php if ($cv_pelrepes_list->SearchColumnCount % $cv_pelrepes_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>


<?php if ($cv_pelrepes_list->kdprop->Visible) { // kdprop ?>
	<?php
		$cv_pelrepes_list->SearchColumnCount++;
		if (($cv_pelrepes_list->SearchColumnCount - 1) % $cv_pelrepes_list->SearchFieldsPerRow == 0) {
			$cv_pelrepes_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $cv_pelrepes_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kdprop" class="ew-cell form-group">
		<label for="x_kdprop" class="ew-search-caption ew-label"><?php echo $cv_pelrepes_list->kdprop->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdprop" id="z_kdprop" value="=">
</span>
		<span id="el_cv_pelrepes_kdprop" class="ew-search-field">
<?php $cv_pelrepes_list->kdprop->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cv_pelrepes" data-field="x_kdprop" data-value-separator="<?php echo $cv_pelrepes_list->kdprop->displayValueSeparatorAttribute() ?>" id="x_kdprop" name="x_kdprop"<?php echo $cv_pelrepes_list->kdprop->editAttributes() ?>>
			<?php echo $cv_pelrepes_list->kdprop->selectOptionListHtml("x_kdprop") ?>
		</select>
</div>
<?php echo $cv_pelrepes_list->kdprop->Lookup->getParamTag($cv_pelrepes_list, "p_x_kdprop") ?>
</span>
	</div>
	<?php if ($cv_pelrepes_list->SearchColumnCount % $cv_pelrepes_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>


<?php if ($cv_pelrepes_list->kdkota->Visible) { // kdkota ?>
	<?php
		$cv_pelrepes_list->SearchColumnCount++;
		if (($cv_pelrepes_list->SearchColumnCount - 1) % $cv_pelrepes_list->SearchFieldsPerRow == 0) {
			$cv_pelrepes_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $cv_pelrepes_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kdkota" class="ew-cell form-group">
		<label for="x_kdkota" class="ew-search-caption ew-label"><?php echo $cv_pelrepes_list->kdkota->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdkota" id="z_kdkota" value="=">
</span>
		<span id="el_cv_pelrepes_kdkota" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cv_pelrepes" data-field="x_kdkota" data-value-separator="<?php echo $cv_pelrepes_list->kdkota->displayValueSeparatorAttribute() ?>" id="x_kdkota" name="x_kdkota"<?php echo $cv_pelrepes_list->kdkota->editAttributes() ?>>
			<?php echo $cv_pelrepes_list->kdkota->selectOptionListHtml("x_kdkota") ?>
		</select>
</div>
<?php echo $cv_pelrepes_list->kdkota->Lookup->getParamTag($cv_pelrepes_list, "p_x_kdkota") ?>
</span>
	</div>
	<?php if ($cv_pelrepes_list->SearchColumnCount % $cv_pelrepes_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>


<?php if ($cv_pelrepes_list->statuspel->Visible) { // statuspel ?>
	<?php
		$cv_pelrepes_list->SearchColumnCount++;
		if (($cv_pelrepes_list->SearchColumnCount - 1) % $cv_pelrepes_list->SearchFieldsPerRow == 0) {
			$cv_pelrepes_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $cv_pelrepes_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_statuspel" class="ew-cell form-group">
		<label for="x_statuspel" class="ew-search-caption ew-label"><?php echo $cv_pelrepes_list->statuspel->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_statuspel" id="z_statuspel" value="=">
</span>
		<span id="el_cv_pelrepes_statuspel" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cv_pelrepes" data-field="x_statuspel" data-value-separator="<?php echo $cv_pelrepes_list->statuspel->displayValueSeparatorAttribute() ?>" id="x_statuspel" name="x_statuspel"<?php echo $cv_pelrepes_list->statuspel->editAttributes() ?>>
			<?php echo $cv_pelrepes_list->statuspel->selectOptionListHtml("x_statuspel") ?>
		</select>
</div>
</span>
	</div>
	<?php if ($cv_pelrepes_list->SearchColumnCount % $cv_pelrepes_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>


<?php if ($cv_pelrepes_list->tahun_pelatihan->Visible) { // tahun_pelatihan ?>
	<?php
		$cv_pelrepes_list->SearchColumnCount++;
		if (($cv_pelrepes_list->SearchColumnCount - 1) % $cv_pelrepes_list->SearchFieldsPerRow == 0) {
			$cv_pelrepes_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $cv_pelrepes_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_tahun_pelatihan" class="ew-cell form-group">
		<label for="x_tahun_pelatihan" class="ew-search-caption ew-label"><?php echo $cv_pelrepes_list->tahun_pelatihan->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tahun_pelatihan" id="z_tahun_pelatihan" value="=">
</span>
		<span id="el_cv_pelrepes_tahun_pelatihan" class="ew-search-field">
<input type="text" data-table="cv_pelrepes" data-field="x_tahun_pelatihan" name="x_tahun_pelatihan" id="x_tahun_pelatihan" size="4" placeholder="<?php echo HtmlEncode($cv_pelrepes_list->tahun_pelatihan->getPlaceHolder()) ?>" value="<?php echo $cv_pelrepes_list->tahun_pelatihan->EditValue ?>"<?php echo $cv_pelrepes_list->tahun_pelatihan->editAttributes() ?>>
</span>
	</div>
	<?php if ($cv_pelrepes_list->SearchColumnCount % $cv_pelrepes_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>

	<?php if ($cv_pelrepes_list->SearchColumnCount % $cv_pelrepes_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>


<div id="xsr_<?php echo $cv_pelrepes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>


<?php } ?>
<?php } ?>
<?php $cv_pelrepes_list->showPageHeader(); ?>
<?php
$cv_pelrepes_list->showMessage();
?>
<?php if ($cv_pelrepes_list->TotalRecords > 0 || $cv_pelrepes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cv_pelrepes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cv_pelrepes">
<?php if (!$cv_pelrepes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$cv_pelrepes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cv_pelrepes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cv_pelrepes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcv_pelrepeslist" id="fcv_pelrepeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cv_pelrepes">
<div id="gmp_cv_pelrepes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($cv_pelrepes_list->TotalRecords > 0 || $cv_pelrepes_list->isGridEdit()) { ?>
<table id="tbl_cv_pelrepeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cv_pelrepes->RowType = ROWTYPE_HEADER;

// Render list options
$cv_pelrepes_list->renderListOptions();

// Render list options (header, left)
$cv_pelrepes_list->ListOptions->render("header", "left");
?>
<?php if ($cv_pelrepes_list->kdjudul->Visible) { // kdjudul ?>
	<?php if ($cv_pelrepes_list->SortUrl($cv_pelrepes_list->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $cv_pelrepes_list->kdjudul->headerCellClass() ?>"><div id="elh_cv_pelrepes_kdjudul" class="cv_pelrepes_kdjudul"><div class="ew-table-header-caption"><?php echo $cv_pelrepes_list->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $cv_pelrepes_list->kdjudul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_pelrepes_list->SortUrl($cv_pelrepes_list->kdjudul) ?>', 1);"><div id="elh_cv_pelrepes_kdjudul" class="cv_pelrepes_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_pelrepes_list->kdjudul->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_pelrepes_list->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_pelrepes_list->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_pelrepes_list->tawal->Visible) { // tawal ?>
	<?php if ($cv_pelrepes_list->SortUrl($cv_pelrepes_list->tawal) == "") { ?>
		<th data-name="tawal" class="<?php echo $cv_pelrepes_list->tawal->headerCellClass() ?>"><div id="elh_cv_pelrepes_tawal" class="cv_pelrepes_tawal"><div class="ew-table-header-caption"><?php echo $cv_pelrepes_list->tawal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tawal" class="<?php echo $cv_pelrepes_list->tawal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_pelrepes_list->SortUrl($cv_pelrepes_list->tawal) ?>', 1);"><div id="elh_cv_pelrepes_tawal" class="cv_pelrepes_tawal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_pelrepes_list->tawal->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_pelrepes_list->tawal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_pelrepes_list->tawal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_pelrepes_list->takhir->Visible) { // takhir ?>
	<?php if ($cv_pelrepes_list->SortUrl($cv_pelrepes_list->takhir) == "") { ?>
		<th data-name="takhir" class="<?php echo $cv_pelrepes_list->takhir->headerCellClass() ?>"><div id="elh_cv_pelrepes_takhir" class="cv_pelrepes_takhir"><div class="ew-table-header-caption"><?php echo $cv_pelrepes_list->takhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="takhir" class="<?php echo $cv_pelrepes_list->takhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_pelrepes_list->SortUrl($cv_pelrepes_list->takhir) ?>', 1);"><div id="elh_cv_pelrepes_takhir" class="cv_pelrepes_takhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_pelrepes_list->takhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_pelrepes_list->takhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_pelrepes_list->takhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_pelrepes_list->kdprop->Visible) { // kdprop ?>
	<?php if ($cv_pelrepes_list->SortUrl($cv_pelrepes_list->kdprop) == "") { ?>
		<th data-name="kdprop" class="<?php echo $cv_pelrepes_list->kdprop->headerCellClass() ?>"><div id="elh_cv_pelrepes_kdprop" class="cv_pelrepes_kdprop"><div class="ew-table-header-caption"><?php echo $cv_pelrepes_list->kdprop->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdprop" class="<?php echo $cv_pelrepes_list->kdprop->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_pelrepes_list->SortUrl($cv_pelrepes_list->kdprop) ?>', 1);"><div id="elh_cv_pelrepes_kdprop" class="cv_pelrepes_kdprop">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_pelrepes_list->kdprop->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_pelrepes_list->kdprop->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_pelrepes_list->kdprop->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_pelrepes_list->kdkota->Visible) { // kdkota ?>
	<?php if ($cv_pelrepes_list->SortUrl($cv_pelrepes_list->kdkota) == "") { ?>
		<th data-name="kdkota" class="<?php echo $cv_pelrepes_list->kdkota->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_cv_pelrepes_kdkota" class="cv_pelrepes_kdkota"><div class="ew-table-header-caption"><?php echo $cv_pelrepes_list->kdkota->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkota" class="<?php echo $cv_pelrepes_list->kdkota->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_pelrepes_list->SortUrl($cv_pelrepes_list->kdkota) ?>', 1);"><div id="elh_cv_pelrepes_kdkota" class="cv_pelrepes_kdkota">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_pelrepes_list->kdkota->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_pelrepes_list->kdkota->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_pelrepes_list->kdkota->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_pelrepes_list->kdkec->Visible) { // kdkec ?>
	<?php if ($cv_pelrepes_list->SortUrl($cv_pelrepes_list->kdkec) == "") { ?>
		<th data-name="kdkec" class="<?php echo $cv_pelrepes_list->kdkec->headerCellClass() ?>"><div id="elh_cv_pelrepes_kdkec" class="cv_pelrepes_kdkec"><div class="ew-table-header-caption"><?php echo $cv_pelrepes_list->kdkec->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkec" class="<?php echo $cv_pelrepes_list->kdkec->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_pelrepes_list->SortUrl($cv_pelrepes_list->kdkec) ?>', 1);"><div id="elh_cv_pelrepes_kdkec" class="cv_pelrepes_kdkec">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_pelrepes_list->kdkec->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_pelrepes_list->kdkec->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_pelrepes_list->kdkec->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_pelrepes_list->statuspel->Visible) { // statuspel ?>
	<?php if ($cv_pelrepes_list->SortUrl($cv_pelrepes_list->statuspel) == "") { ?>
		<th data-name="statuspel" class="<?php echo $cv_pelrepes_list->statuspel->headerCellClass() ?>"><div id="elh_cv_pelrepes_statuspel" class="cv_pelrepes_statuspel"><div class="ew-table-header-caption"><?php echo $cv_pelrepes_list->statuspel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="statuspel" class="<?php echo $cv_pelrepes_list->statuspel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_pelrepes_list->SortUrl($cv_pelrepes_list->statuspel) ?>', 1);"><div id="elh_cv_pelrepes_statuspel" class="cv_pelrepes_statuspel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_pelrepes_list->statuspel->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_pelrepes_list->statuspel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_pelrepes_list->statuspel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_pelrepes_list->tahun_pelatihan->Visible) { // tahun_pelatihan ?>
	<?php if ($cv_pelrepes_list->SortUrl($cv_pelrepes_list->tahun_pelatihan) == "") { ?>
		<th data-name="tahun_pelatihan" class="<?php echo $cv_pelrepes_list->tahun_pelatihan->headerCellClass() ?>"><div id="elh_cv_pelrepes_tahun_pelatihan" class="cv_pelrepes_tahun_pelatihan"><div class="ew-table-header-caption"><?php echo $cv_pelrepes_list->tahun_pelatihan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun_pelatihan" class="<?php echo $cv_pelrepes_list->tahun_pelatihan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_pelrepes_list->SortUrl($cv_pelrepes_list->tahun_pelatihan) ?>', 1);"><div id="elh_cv_pelrepes_tahun_pelatihan" class="cv_pelrepes_tahun_pelatihan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_pelrepes_list->tahun_pelatihan->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_pelrepes_list->tahun_pelatihan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_pelrepes_list->tahun_pelatihan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cv_pelrepes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cv_pelrepes_list->ExportAll && $cv_pelrepes_list->isExport()) {
	$cv_pelrepes_list->StopRecord = $cv_pelrepes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($cv_pelrepes_list->TotalRecords > $cv_pelrepes_list->StartRecord + $cv_pelrepes_list->DisplayRecords - 1)
		$cv_pelrepes_list->StopRecord = $cv_pelrepes_list->StartRecord + $cv_pelrepes_list->DisplayRecords - 1;
	else
		$cv_pelrepes_list->StopRecord = $cv_pelrepes_list->TotalRecords;
}
$cv_pelrepes_list->RecordCount = $cv_pelrepes_list->StartRecord - 1;
if ($cv_pelrepes_list->Recordset && !$cv_pelrepes_list->Recordset->EOF) {
	$cv_pelrepes_list->Recordset->moveFirst();
	$selectLimit = $cv_pelrepes_list->UseSelectLimit;
	if (!$selectLimit && $cv_pelrepes_list->StartRecord > 1)
		$cv_pelrepes_list->Recordset->move($cv_pelrepes_list->StartRecord - 1);
} elseif (!$cv_pelrepes->AllowAddDeleteRow && $cv_pelrepes_list->StopRecord == 0) {
	$cv_pelrepes_list->StopRecord = $cv_pelrepes->GridAddRowCount;
}

// Initialize aggregate
$cv_pelrepes->RowType = ROWTYPE_AGGREGATEINIT;
$cv_pelrepes->resetAttributes();
$cv_pelrepes_list->renderRow();
while ($cv_pelrepes_list->RecordCount < $cv_pelrepes_list->StopRecord) {
	$cv_pelrepes_list->RecordCount++;
	if ($cv_pelrepes_list->RecordCount >= $cv_pelrepes_list->StartRecord) {
		$cv_pelrepes_list->RowCount++;

		// Set up key count
		$cv_pelrepes_list->KeyCount = $cv_pelrepes_list->RowIndex;

		// Init row class and style
		$cv_pelrepes->resetAttributes();
		$cv_pelrepes->CssClass = "";
		if ($cv_pelrepes_list->isGridAdd()) {
		} else {
			$cv_pelrepes_list->loadRowValues($cv_pelrepes_list->Recordset); // Load row values
		}
		$cv_pelrepes->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cv_pelrepes->RowAttrs->merge(["data-rowindex" => $cv_pelrepes_list->RowCount, "id" => "r" . $cv_pelrepes_list->RowCount . "_cv_pelrepes", "data-rowtype" => $cv_pelrepes->RowType]);

		// Render row
		$cv_pelrepes_list->renderRow();

		// Render list options
		$cv_pelrepes_list->renderListOptions();
?>
	<tr <?php echo $cv_pelrepes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cv_pelrepes_list->ListOptions->render("body", "left", $cv_pelrepes_list->RowCount);
?>
	<?php if ($cv_pelrepes_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $cv_pelrepes_list->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $cv_pelrepes_list->RowCount ?>_cv_pelrepes_kdjudul">
<span<?php echo $cv_pelrepes_list->kdjudul->viewAttributes() ?>><?php echo $cv_pelrepes_list->kdjudul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_pelrepes_list->tawal->Visible) { // tawal ?>
		<td data-name="tawal" <?php echo $cv_pelrepes_list->tawal->cellAttributes() ?>>
<span id="el<?php echo $cv_pelrepes_list->RowCount ?>_cv_pelrepes_tawal">
<span<?php echo $cv_pelrepes_list->tawal->viewAttributes() ?>><?php echo $cv_pelrepes_list->tawal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_pelrepes_list->takhir->Visible) { // takhir ?>
		<td data-name="takhir" <?php echo $cv_pelrepes_list->takhir->cellAttributes() ?>>
<span id="el<?php echo $cv_pelrepes_list->RowCount ?>_cv_pelrepes_takhir">
<span<?php echo $cv_pelrepes_list->takhir->viewAttributes() ?>><?php echo $cv_pelrepes_list->takhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_pelrepes_list->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" <?php echo $cv_pelrepes_list->kdprop->cellAttributes() ?>>
<span id="el<?php echo $cv_pelrepes_list->RowCount ?>_cv_pelrepes_kdprop">
<span<?php echo $cv_pelrepes_list->kdprop->viewAttributes() ?>><?php echo $cv_pelrepes_list->kdprop->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_pelrepes_list->kdkota->Visible) { // kdkota ?>
		<td data-name="kdkota" <?php echo $cv_pelrepes_list->kdkota->cellAttributes() ?>>
<span id="el<?php echo $cv_pelrepes_list->RowCount ?>_cv_pelrepes_kdkota">
<span<?php echo $cv_pelrepes_list->kdkota->viewAttributes() ?>><?php echo $cv_pelrepes_list->kdkota->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_pelrepes_list->kdkec->Visible) { // kdkec ?>
		<td data-name="kdkec" <?php echo $cv_pelrepes_list->kdkec->cellAttributes() ?>>
<span id="el<?php echo $cv_pelrepes_list->RowCount ?>_cv_pelrepes_kdkec">
<span<?php echo $cv_pelrepes_list->kdkec->viewAttributes() ?>><?php echo $cv_pelrepes_list->kdkec->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_pelrepes_list->statuspel->Visible) { // statuspel ?>
		<td data-name="statuspel" <?php echo $cv_pelrepes_list->statuspel->cellAttributes() ?>>
<span id="el<?php echo $cv_pelrepes_list->RowCount ?>_cv_pelrepes_statuspel">
<span<?php echo $cv_pelrepes_list->statuspel->viewAttributes() ?>><?php echo $cv_pelrepes_list->statuspel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_pelrepes_list->tahun_pelatihan->Visible) { // tahun_pelatihan ?>
		<td data-name="tahun_pelatihan" <?php echo $cv_pelrepes_list->tahun_pelatihan->cellAttributes() ?>>
<span id="el<?php echo $cv_pelrepes_list->RowCount ?>_cv_pelrepes_tahun_pelatihan">
<span<?php echo $cv_pelrepes_list->tahun_pelatihan->viewAttributes() ?>><?php echo $cv_pelrepes_list->tahun_pelatihan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cv_pelrepes_list->ListOptions->render("body", "right", $cv_pelrepes_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$cv_pelrepes_list->isGridAdd())
		$cv_pelrepes_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$cv_pelrepes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cv_pelrepes_list->Recordset)
	$cv_pelrepes_list->Recordset->Close();
?>
<?php if (!$cv_pelrepes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cv_pelrepes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cv_pelrepes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cv_pelrepes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cv_pelrepes_list->TotalRecords == 0 && !$cv_pelrepes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cv_pelrepes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cv_pelrepes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cv_pelrepes_list->isExport()) { ?>
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
$cv_pelrepes_list->terminate();
?>