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
$t_juduldetail_list = new t_juduldetail_list();

// Run the page
$t_juduldetail_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_juduldetail_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_juduldetail_list->isExport()) { ?>

<script>
var ft_juduldetaillist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_juduldetaillist = currentForm = new ew.Form("ft_juduldetaillist", "list");
	ft_juduldetaillist.formKeyCountName = '<?php echo $t_juduldetail_list->FormKeyCountName ?>';
	loadjs.done("ft_juduldetaillist");
});
var ft_juduldetaillistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_juduldetaillistsrch = currentSearchForm = new ew.Form("ft_juduldetaillistsrch");

	// Validate function for search
	ft_juduldetaillistsrch.validate = function(fobj) {
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
	ft_juduldetaillistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_juduldetaillistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_juduldetaillistsrch.lists["x_singbagian"] = <?php echo $t_juduldetail_list->singbagian->Lookup->toClientList($t_juduldetail_list) ?>;
	ft_juduldetaillistsrch.lists["x_singbagian"].options = <?php echo JsonEncode($t_juduldetail_list->singbagian->lookupOptions()) ?>;
	ft_juduldetaillistsrch.lists["x_jpel"] = <?php echo $t_juduldetail_list->jpel->Lookup->toClientList($t_juduldetail_list) ?>;
	ft_juduldetaillistsrch.lists["x_jpel"].options = <?php echo JsonEncode($t_juduldetail_list->jpel->options(FALSE, TRUE)) ?>;
	ft_juduldetaillistsrch.lists["x_kdjudul"] = <?php echo $t_juduldetail_list->kdjudul->Lookup->toClientList($t_juduldetail_list) ?>;
	ft_juduldetaillistsrch.lists["x_kdjudul"].options = <?php echo JsonEncode($t_juduldetail_list->kdjudul->lookupOptions()) ?>;
	ft_juduldetaillistsrch.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

	// Filters
	ft_juduldetaillistsrch.filterList = <?php echo $t_juduldetail_list->getFilterList() ?>;
	loadjs.done("ft_juduldetaillistsrch");
});
</script>

<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_juduldetail_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_juduldetail_list->TotalRecords > 0 && $t_juduldetail_list->ExportOptions->visible()) { ?>
<?php $t_juduldetail_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_juduldetail_list->ImportOptions->visible()) { ?>
<?php $t_juduldetail_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_juduldetail_list->SearchOptions->visible()) { ?>
<?php $t_juduldetail_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_juduldetail_list->FilterOptions->visible()) { ?>
<?php $t_juduldetail_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>

<?php if (!$t_juduldetail_list->isExport() || Config("EXPORT_MASTER_RECORD") && $t_juduldetail_list->isExport("print")) { ?>
<?php
if ($t_juduldetail_list->DbMasterFilter != "" && $t_juduldetail->getCurrentMasterTable() == "t_judul") {
	if ($t_juduldetail_list->MasterRecordExists) {
		include_once "t_judulmaster.php";
	}
}
?>
<?php } ?>
<?php
$t_juduldetail_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_juduldetail_list->isExport() && !$t_juduldetail->CurrentAction) { ?>
<form name="ft_juduldetaillistsrch" id="ft_juduldetaillistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_juduldetaillistsrch-search-panel" class="<?php echo $t_juduldetail_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_juduldetail">
	<div class="ew-extended-search">
<?php

// Render search row
$t_juduldetail->RowType = ROWTYPE_SEARCH;
$t_juduldetail->resetAttributes();
$t_juduldetail_list->renderRow();
?>

<style>
	.ew-cell {
    display: flex;
    align-items: left; /* Untuk menyejajarkan label dan input secara vertikal */
    margin-bottom: 10px; /* Tambahkan margin antar elemen */
}

.ew-search-caption {
    width: 120px; /* Atur lebar label agar seragam */
    text-align: left !important;
    padding-right: 10px;
	justify-content: left !important;
	text-transform: uppercase;
}

.ew-search-field input,
.ew-search-field select {
    width: 300px; /* Atur lebar input dan select agar seragam */
}

.input-group .custom-select {
    width: 300px; /* Atur lebar select di dalam input-group */
}

</style>


<?php if ($t_juduldetail_list->singbagian->Visible) { // singbagian ?>
	<?php
		$t_juduldetail_list->SearchColumnCount++;
		if (($t_juduldetail_list->SearchColumnCount - 1) % $t_juduldetail_list->SearchFieldsPerRow == 0) {
			$t_juduldetail_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_juduldetail_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_singbagian" class="ew-cell form-group">
		<label for="x_singbagian" class="ew-search-caption ew-label"><?php echo $t_juduldetail_list->singbagian->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_singbagian" id="z_singbagian" value="LIKE">
</span>
		<span id="el_t_juduldetail_singbagian" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_juduldetail" data-field="x_singbagian" data-value-separator="<?php echo $t_juduldetail_list->singbagian->displayValueSeparatorAttribute() ?>" id="x_singbagian" name="x_singbagian"<?php echo $t_juduldetail_list->singbagian->editAttributes() ?>>
			<?php echo $t_juduldetail_list->singbagian->selectOptionListHtml("x_singbagian") ?>
		</select>
</div>
<?php echo $t_juduldetail_list->singbagian->Lookup->getParamTag($t_juduldetail_list, "p_x_singbagian") ?>
</span>
	</div>
	<?php if ($t_juduldetail_list->SearchColumnCount % $t_juduldetail_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>

<?php if ($t_juduldetail_list->jpel->Visible) { // jpel ?>
	<?php
		$t_juduldetail_list->SearchColumnCount++;
		if (($t_juduldetail_list->SearchColumnCount - 1) % $t_juduldetail_list->SearchFieldsPerRow == 0) {
			$t_juduldetail_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_juduldetail_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_jpel" class="ew-cell form-group">
		<label for="x_jpel" class="ew-search-caption ew-label"><?php echo $t_juduldetail_list->jpel->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_jpel" id="z_jpel" value="LIKE">
</span>
		<span id="el_t_juduldetail_jpel" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_juduldetail" data-field="x_jpel" data-value-separator="<?php echo $t_juduldetail_list->jpel->displayValueSeparatorAttribute() ?>" id="x_jpel" name="x_jpel"<?php echo $t_juduldetail_list->jpel->editAttributes() ?>>
			<?php echo $t_juduldetail_list->jpel->selectOptionListHtml("x_jpel") ?>
		</select>
</div>
</span>
	</div>
	<?php if ($t_juduldetail_list->SearchColumnCount % $t_juduldetail_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>

<?php if ($t_juduldetail_list->kdjudul->Visible) { // kdjudul ?>
	<?php
		$t_juduldetail_list->SearchColumnCount++;
		if (($t_juduldetail_list->SearchColumnCount - 1) % $t_juduldetail_list->SearchFieldsPerRow == 0) {
			$t_juduldetail_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_juduldetail_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kdjudul" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $t_juduldetail_list->kdjudul->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_kdjudul" id="z_kdjudul" value="LIKE">
</span>
		<span id="el_t_juduldetail_kdjudul" class="ew-search-field">
<?php
$onchange = $t_juduldetail_list->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_juduldetail_list->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($t_juduldetail_list->kdjudul->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($t_juduldetail_list->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_juduldetail_list->kdjudul->getPlaceHolder()) ?>"<?php echo $t_juduldetail_list->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_kdjudul" data-value-separator="<?php echo $t_juduldetail_list->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($t_juduldetail_list->kdjudul->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_juduldetaillistsrch"], function() {
	ft_juduldetaillistsrch.createAutoSuggest({"id":"x_kdjudul","forceSelect":false,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $t_juduldetail_list->kdjudul->Lookup->getParamTag($t_juduldetail_list, "p_x_kdjudul") ?>
</span>
	</div>
	<?php if ($t_juduldetail_list->SearchColumnCount % $t_juduldetail_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($t_juduldetail_list->SearchColumnCount % $t_juduldetail_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $t_juduldetail_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_juduldetail_list->showPageHeader(); ?>
<?php
$t_juduldetail_list->showMessage();
?>
<?php if ($t_juduldetail_list->TotalRecords > 0 || $t_juduldetail->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_juduldetail_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_juduldetail">
<?php if (!$t_juduldetail_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_juduldetail_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_juduldetail_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_juduldetail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_juduldetaillist" id="ft_juduldetaillist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_juduldetail">
<?php if ($t_juduldetail->getCurrentMasterTable() == "t_judul" && $t_juduldetail->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_judul">
<input type="hidden" name="fk_kdjudul" value="<?php echo HtmlEncode($t_juduldetail_list->kdjudul->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_t_juduldetail" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_juduldetail_list->TotalRecords > 0 || $t_juduldetail_list->isGridEdit()) { ?>
<table id="tbl_t_juduldetaillist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_juduldetail->RowType = ROWTYPE_HEADER;

// Render list options
$t_juduldetail_list->renderListOptions();

// Render list options (header, left)
$t_juduldetail_list->ListOptions->render("header", "left");
?>
<?php if ($t_juduldetail_list->singbagian->Visible) { // singbagian ?>
	<?php if ($t_juduldetail_list->SortUrl($t_juduldetail_list->singbagian) == "") { ?>
		<th data-name="singbagian" class="<?php echo $t_juduldetail_list->singbagian->headerCellClass() ?>"><div id="elh_t_juduldetail_singbagian" class="t_juduldetail_singbagian"><div class="ew-table-header-caption"><?php echo $t_juduldetail_list->singbagian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="singbagian" class="<?php echo $t_juduldetail_list->singbagian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_juduldetail_list->SortUrl($t_juduldetail_list->singbagian) ?>', 1);"><div id="elh_t_juduldetail_singbagian" class="t_juduldetail_singbagian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_juduldetail_list->singbagian->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_juduldetail_list->singbagian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_juduldetail_list->singbagian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_juduldetail_list->jpel->Visible) { // jpel ?>
	<?php if ($t_juduldetail_list->SortUrl($t_juduldetail_list->jpel) == "") { ?>
		<th data-name="jpel" class="<?php echo $t_juduldetail_list->jpel->headerCellClass() ?>"><div id="elh_t_juduldetail_jpel" class="t_juduldetail_jpel"><div class="ew-table-header-caption"><?php echo $t_juduldetail_list->jpel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jpel" class="<?php echo $t_juduldetail_list->jpel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_juduldetail_list->SortUrl($t_juduldetail_list->jpel) ?>', 1);"><div id="elh_t_juduldetail_jpel" class="t_juduldetail_jpel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_juduldetail_list->jpel->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_juduldetail_list->jpel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_juduldetail_list->jpel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_juduldetail_list->kdjudul->Visible) { // kdjudul ?>
	<?php if ($t_juduldetail_list->SortUrl($t_juduldetail_list->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $t_juduldetail_list->kdjudul->headerCellClass() ?>"><div id="elh_t_juduldetail_kdjudul" class="t_juduldetail_kdjudul"><div class="ew-table-header-caption"><?php echo $t_juduldetail_list->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $t_juduldetail_list->kdjudul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_juduldetail_list->SortUrl($t_juduldetail_list->kdjudul) ?>', 1);"><div id="elh_t_juduldetail_kdjudul" class="t_juduldetail_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_juduldetail_list->kdjudul->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_juduldetail_list->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_juduldetail_list->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_juduldetail_list->kdkursil->Visible) { // kdkursil ?>
	<?php if ($t_juduldetail_list->SortUrl($t_juduldetail_list->kdkursil) == "") { ?>
		<th data-name="kdkursil" class="<?php echo $t_juduldetail_list->kdkursil->headerCellClass() ?>"><div id="elh_t_juduldetail_kdkursil" class="t_juduldetail_kdkursil"><div class="ew-table-header-caption"><?php echo $t_juduldetail_list->kdkursil->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkursil" class="<?php echo $t_juduldetail_list->kdkursil->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_juduldetail_list->SortUrl($t_juduldetail_list->kdkursil) ?>', 1);"><div id="elh_t_juduldetail_kdkursil" class="t_juduldetail_kdkursil">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_juduldetail_list->kdkursil->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_juduldetail_list->kdkursil->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_juduldetail_list->kdkursil->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_juduldetail_list->revisi->Visible) { // revisi ?>
	<?php if ($t_juduldetail_list->SortUrl($t_juduldetail_list->revisi) == "") { ?>
		<th data-name="revisi" class="<?php echo $t_juduldetail_list->revisi->headerCellClass() ?>"><div id="elh_t_juduldetail_revisi" class="t_juduldetail_revisi"><div class="ew-table-header-caption"><?php echo $t_juduldetail_list->revisi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revisi" class="<?php echo $t_juduldetail_list->revisi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_juduldetail_list->SortUrl($t_juduldetail_list->revisi) ?>', 1);"><div id="elh_t_juduldetail_revisi" class="t_juduldetail_revisi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_juduldetail_list->revisi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_juduldetail_list->revisi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_juduldetail_list->revisi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_juduldetail_list->tgl_terbit->Visible) { // tgl_terbit ?>
	<?php if ($t_juduldetail_list->SortUrl($t_juduldetail_list->tgl_terbit) == "") { ?>
		<th data-name="tgl_terbit" class="<?php echo $t_juduldetail_list->tgl_terbit->headerCellClass() ?>"><div id="elh_t_juduldetail_tgl_terbit" class="t_juduldetail_tgl_terbit"><div class="ew-table-header-caption"><?php echo $t_juduldetail_list->tgl_terbit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_terbit" class="<?php echo $t_juduldetail_list->tgl_terbit->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_juduldetail_list->SortUrl($t_juduldetail_list->tgl_terbit) ?>', 1);"><div id="elh_t_juduldetail_tgl_terbit" class="t_juduldetail_tgl_terbit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_juduldetail_list->tgl_terbit->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_juduldetail_list->tgl_terbit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_juduldetail_list->tgl_terbit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_juduldetail_list->deskripsi_singkat->Visible) { // deskripsi_singkat ?>
	<?php if ($t_juduldetail_list->SortUrl($t_juduldetail_list->deskripsi_singkat) == "") { ?>
		<th data-name="deskripsi_singkat" class="<?php echo $t_juduldetail_list->deskripsi_singkat->headerCellClass() ?>"><div id="elh_t_juduldetail_deskripsi_singkat" class="t_juduldetail_deskripsi_singkat"><div class="ew-table-header-caption"><?php echo $t_juduldetail_list->deskripsi_singkat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="deskripsi_singkat" class="<?php echo $t_juduldetail_list->deskripsi_singkat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_juduldetail_list->SortUrl($t_juduldetail_list->deskripsi_singkat) ?>', 1);"><div id="elh_t_juduldetail_deskripsi_singkat" class="t_juduldetail_deskripsi_singkat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_juduldetail_list->deskripsi_singkat->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_juduldetail_list->deskripsi_singkat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_juduldetail_list->deskripsi_singkat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_juduldetail_list->tujuan->Visible) { // tujuan ?>
	<?php if ($t_juduldetail_list->SortUrl($t_juduldetail_list->tujuan) == "") { ?>
		<th data-name="tujuan" class="<?php echo $t_juduldetail_list->tujuan->headerCellClass() ?>"><div id="elh_t_juduldetail_tujuan" class="t_juduldetail_tujuan"><div class="ew-table-header-caption"><?php echo $t_juduldetail_list->tujuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tujuan" class="<?php echo $t_juduldetail_list->tujuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_juduldetail_list->SortUrl($t_juduldetail_list->tujuan) ?>', 1);"><div id="elh_t_juduldetail_tujuan" class="t_juduldetail_tujuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_juduldetail_list->tujuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_juduldetail_list->tujuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_juduldetail_list->tujuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_juduldetail_list->target_peserta->Visible) { // target_peserta ?>
	<?php if ($t_juduldetail_list->SortUrl($t_juduldetail_list->target_peserta) == "") { ?>
		<th data-name="target_peserta" class="<?php echo $t_juduldetail_list->target_peserta->headerCellClass() ?>"><div id="elh_t_juduldetail_target_peserta" class="t_juduldetail_target_peserta"><div class="ew-table-header-caption"><?php echo $t_juduldetail_list->target_peserta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="target_peserta" class="<?php echo $t_juduldetail_list->target_peserta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_juduldetail_list->SortUrl($t_juduldetail_list->target_peserta) ?>', 1);"><div id="elh_t_juduldetail_target_peserta" class="t_juduldetail_target_peserta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_juduldetail_list->target_peserta->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_juduldetail_list->target_peserta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_juduldetail_list->target_peserta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_juduldetail_list->lama_pelatihan->Visible) { // lama_pelatihan ?>
	<?php if ($t_juduldetail_list->SortUrl($t_juduldetail_list->lama_pelatihan) == "") { ?>
		<th data-name="lama_pelatihan" class="<?php echo $t_juduldetail_list->lama_pelatihan->headerCellClass() ?>"><div id="elh_t_juduldetail_lama_pelatihan" class="t_juduldetail_lama_pelatihan"><div class="ew-table-header-caption"><?php echo $t_juduldetail_list->lama_pelatihan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lama_pelatihan" class="<?php echo $t_juduldetail_list->lama_pelatihan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_juduldetail_list->SortUrl($t_juduldetail_list->lama_pelatihan) ?>', 1);"><div id="elh_t_juduldetail_lama_pelatihan" class="t_juduldetail_lama_pelatihan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_juduldetail_list->lama_pelatihan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_juduldetail_list->lama_pelatihan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_juduldetail_list->lama_pelatihan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_juduldetail_list->catatan->Visible) { // catatan ?>
	<?php if ($t_juduldetail_list->SortUrl($t_juduldetail_list->catatan) == "") { ?>
		<th data-name="catatan" class="<?php echo $t_juduldetail_list->catatan->headerCellClass() ?>"><div id="elh_t_juduldetail_catatan" class="t_juduldetail_catatan"><div class="ew-table-header-caption"><?php echo $t_juduldetail_list->catatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="catatan" class="<?php echo $t_juduldetail_list->catatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_juduldetail_list->SortUrl($t_juduldetail_list->catatan) ?>', 1);"><div id="elh_t_juduldetail_catatan" class="t_juduldetail_catatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_juduldetail_list->catatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_juduldetail_list->catatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_juduldetail_list->catatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_juduldetail_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_juduldetail_list->ExportAll && $t_juduldetail_list->isExport()) {
	$t_juduldetail_list->StopRecord = $t_juduldetail_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_juduldetail_list->TotalRecords > $t_juduldetail_list->StartRecord + $t_juduldetail_list->DisplayRecords - 1)
		$t_juduldetail_list->StopRecord = $t_juduldetail_list->StartRecord + $t_juduldetail_list->DisplayRecords - 1;
	else
		$t_juduldetail_list->StopRecord = $t_juduldetail_list->TotalRecords;
}
$t_juduldetail_list->RecordCount = $t_juduldetail_list->StartRecord - 1;
if ($t_juduldetail_list->Recordset && !$t_juduldetail_list->Recordset->EOF) {
	$t_juduldetail_list->Recordset->moveFirst();
	$selectLimit = $t_juduldetail_list->UseSelectLimit;
	if (!$selectLimit && $t_juduldetail_list->StartRecord > 1)
		$t_juduldetail_list->Recordset->move($t_juduldetail_list->StartRecord - 1);
} elseif (!$t_juduldetail->AllowAddDeleteRow && $t_juduldetail_list->StopRecord == 0) {
	$t_juduldetail_list->StopRecord = $t_juduldetail->GridAddRowCount;
}

// Initialize aggregate
$t_juduldetail->RowType = ROWTYPE_AGGREGATEINIT;
$t_juduldetail->resetAttributes();
$t_juduldetail_list->renderRow();
while ($t_juduldetail_list->RecordCount < $t_juduldetail_list->StopRecord) {
	$t_juduldetail_list->RecordCount++;
	if ($t_juduldetail_list->RecordCount >= $t_juduldetail_list->StartRecord) {
		$t_juduldetail_list->RowCount++;

		// Set up key count
		$t_juduldetail_list->KeyCount = $t_juduldetail_list->RowIndex;

		// Init row class and style
		$t_juduldetail->resetAttributes();
		$t_juduldetail->CssClass = "";
		if ($t_juduldetail_list->isGridAdd()) {
		} else {
			$t_juduldetail_list->loadRowValues($t_juduldetail_list->Recordset); // Load row values
		}
		$t_juduldetail->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_juduldetail->RowAttrs->merge(["data-rowindex" => $t_juduldetail_list->RowCount, "id" => "r" . $t_juduldetail_list->RowCount . "_t_juduldetail", "data-rowtype" => $t_juduldetail->RowType]);

		// Render row
		$t_juduldetail_list->renderRow();

		// Render list options
		$t_juduldetail_list->renderListOptions();
?>
	<tr <?php echo $t_juduldetail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_juduldetail_list->ListOptions->render("body", "left", $t_juduldetail_list->RowCount);
?>
	<?php if ($t_juduldetail_list->singbagian->Visible) { // singbagian ?>
		<td data-name="singbagian" <?php echo $t_juduldetail_list->singbagian->cellAttributes() ?>>
<span id="el<?php echo $t_juduldetail_list->RowCount ?>_t_juduldetail_singbagian">
<span<?php echo $t_juduldetail_list->singbagian->viewAttributes() ?>><?php echo $t_juduldetail_list->singbagian->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_juduldetail_list->jpel->Visible) { // jpel ?>
		<td data-name="jpel" <?php echo $t_juduldetail_list->jpel->cellAttributes() ?>>
<span id="el<?php echo $t_juduldetail_list->RowCount ?>_t_juduldetail_jpel">
<span<?php echo $t_juduldetail_list->jpel->viewAttributes() ?>><?php echo $t_juduldetail_list->jpel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_juduldetail_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $t_juduldetail_list->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $t_juduldetail_list->RowCount ?>_t_juduldetail_kdjudul">
<span<?php echo $t_juduldetail_list->kdjudul->viewAttributes() ?>><?php echo $t_juduldetail_list->kdjudul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_juduldetail_list->kdkursil->Visible) { // kdkursil ?>
		<td data-name="kdkursil" <?php echo $t_juduldetail_list->kdkursil->cellAttributes() ?>>
<span id="el<?php echo $t_juduldetail_list->RowCount ?>_t_juduldetail_kdkursil">
<span<?php echo $t_juduldetail_list->kdkursil->viewAttributes() ?>><?php echo $t_juduldetail_list->kdkursil->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_juduldetail_list->revisi->Visible) { // revisi ?>
		<td data-name="revisi" <?php echo $t_juduldetail_list->revisi->cellAttributes() ?>>
<span id="el<?php echo $t_juduldetail_list->RowCount ?>_t_juduldetail_revisi">
<span<?php echo $t_juduldetail_list->revisi->viewAttributes() ?>><?php echo $t_juduldetail_list->revisi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_juduldetail_list->tgl_terbit->Visible) { // tgl_terbit ?>
		<td data-name="tgl_terbit" <?php echo $t_juduldetail_list->tgl_terbit->cellAttributes() ?>>
<span id="el<?php echo $t_juduldetail_list->RowCount ?>_t_juduldetail_tgl_terbit">
<span<?php echo $t_juduldetail_list->tgl_terbit->viewAttributes() ?>><?php echo $t_juduldetail_list->tgl_terbit->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_juduldetail_list->deskripsi_singkat->Visible) { // deskripsi_singkat ?>
		<td data-name="deskripsi_singkat" <?php echo $t_juduldetail_list->deskripsi_singkat->cellAttributes() ?>>
<span id="el<?php echo $t_juduldetail_list->RowCount ?>_t_juduldetail_deskripsi_singkat">
<span<?php echo $t_juduldetail_list->deskripsi_singkat->viewAttributes() ?>><?php if (!EmptyString($t_juduldetail_list->deskripsi_singkat->TooltipValue) && $t_juduldetail_list->deskripsi_singkat->linkAttributes() != "") { ?>
<a<?php echo $t_juduldetail_list->deskripsi_singkat->linkAttributes() ?>><?php echo $t_juduldetail_list->deskripsi_singkat->getViewValue() ?></a>
<?php } else { ?>
<?php echo $t_juduldetail_list->deskripsi_singkat->getViewValue() ?>
<?php } ?>
<span id="tt_t_juduldetail_x<?php echo $t_juduldetail_list->RowCount ?>_deskripsi_singkat" class="d-none">
<?php echo $t_juduldetail_list->deskripsi_singkat->TooltipValue ?>
</span></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_juduldetail_list->tujuan->Visible) { // tujuan ?>
		<td data-name="tujuan" <?php echo $t_juduldetail_list->tujuan->cellAttributes() ?>>
<span id="el<?php echo $t_juduldetail_list->RowCount ?>_t_juduldetail_tujuan">
<span<?php echo $t_juduldetail_list->tujuan->viewAttributes() ?>><?php if (!EmptyString($t_juduldetail_list->tujuan->TooltipValue) && $t_juduldetail_list->tujuan->linkAttributes() != "") { ?>
<a<?php echo $t_juduldetail_list->tujuan->linkAttributes() ?>><?php echo $t_juduldetail_list->tujuan->getViewValue() ?></a>
<?php } else { ?>
<?php echo $t_juduldetail_list->tujuan->getViewValue() ?>
<?php } ?>
<span id="tt_t_juduldetail_x<?php echo $t_juduldetail_list->RowCount ?>_tujuan" class="d-none">
<?php echo $t_juduldetail_list->tujuan->TooltipValue ?>
</span></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_juduldetail_list->target_peserta->Visible) { // target_peserta ?>
		<td data-name="target_peserta" <?php echo $t_juduldetail_list->target_peserta->cellAttributes() ?>>
<span id="el<?php echo $t_juduldetail_list->RowCount ?>_t_juduldetail_target_peserta">
<span<?php echo $t_juduldetail_list->target_peserta->viewAttributes() ?>><?php if (!EmptyString($t_juduldetail_list->target_peserta->TooltipValue) && $t_juduldetail_list->target_peserta->linkAttributes() != "") { ?>
<a<?php echo $t_juduldetail_list->target_peserta->linkAttributes() ?>><?php echo $t_juduldetail_list->target_peserta->getViewValue() ?></a>
<?php } else { ?>
<?php echo $t_juduldetail_list->target_peserta->getViewValue() ?>
<?php } ?>
<span id="tt_t_juduldetail_x<?php echo $t_juduldetail_list->RowCount ?>_target_peserta" class="d-none">
<?php echo $t_juduldetail_list->target_peserta->TooltipValue ?>
</span></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_juduldetail_list->lama_pelatihan->Visible) { // lama_pelatihan ?>
		<td data-name="lama_pelatihan" <?php echo $t_juduldetail_list->lama_pelatihan->cellAttributes() ?>>
<span id="el<?php echo $t_juduldetail_list->RowCount ?>_t_juduldetail_lama_pelatihan">
<span<?php echo $t_juduldetail_list->lama_pelatihan->viewAttributes() ?>><?php echo $t_juduldetail_list->lama_pelatihan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_juduldetail_list->catatan->Visible) { // catatan ?>
		<td data-name="catatan" <?php echo $t_juduldetail_list->catatan->cellAttributes() ?>>
<span id="el<?php echo $t_juduldetail_list->RowCount ?>_t_juduldetail_catatan">
<span<?php echo $t_juduldetail_list->catatan->viewAttributes() ?>><?php echo $t_juduldetail_list->catatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_juduldetail_list->ListOptions->render("body", "right", $t_juduldetail_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_juduldetail_list->isGridAdd())
		$t_juduldetail_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_juduldetail->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_juduldetail_list->Recordset)
	$t_juduldetail_list->Recordset->Close();
?>
<?php if (!$t_juduldetail_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_juduldetail_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_juduldetail_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_juduldetail_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_juduldetail_list->TotalRecords == 0 && !$t_juduldetail->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_juduldetail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_juduldetail_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_juduldetail_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$("button.ewDetail").hide();
});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$t_juduldetail_list->terminate();
?>