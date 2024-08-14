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
$diklatkerjasama_list = new diklatkerjasama_list();

// Run the page
$diklatkerjasama_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$diklatkerjasama_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$diklatkerjasama_list->isExport()) { ?>
<script>
var fdiklatkerjasamalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdiklatkerjasamalist = currentForm = new ew.Form("fdiklatkerjasamalist", "list");
	fdiklatkerjasamalist.formKeyCountName = '<?php echo $diklatkerjasama_list->FormKeyCountName ?>';
	loadjs.done("fdiklatkerjasamalist");
});
var fdiklatkerjasamalistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdiklatkerjasamalistsrch = currentSearchForm = new ew.Form("fdiklatkerjasamalistsrch");

	// Validate function for search
	fdiklatkerjasamalistsrch.validate = function(fobj) {
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
	fdiklatkerjasamalistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdiklatkerjasamalistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdiklatkerjasamalistsrch.lists["x_kdprop"] = <?php echo $diklatkerjasama_list->kdprop->Lookup->toClientList($diklatkerjasama_list) ?>;
	fdiklatkerjasamalistsrch.lists["x_kdprop"].options = <?php echo JsonEncode($diklatkerjasama_list->kdprop->lookupOptions()) ?>;
	fdiklatkerjasamalistsrch.lists["x_kdkota"] = <?php echo $diklatkerjasama_list->kdkota->Lookup->toClientList($diklatkerjasama_list) ?>;
	fdiklatkerjasamalistsrch.lists["x_kdkota"].options = <?php echo JsonEncode($diklatkerjasama_list->kdkota->lookupOptions()) ?>;

	// Filters
	fdiklatkerjasamalistsrch.filterList = <?php echo $diklatkerjasama_list->getFilterList() ?>;
	loadjs.done("fdiklatkerjasamalistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$diklatkerjasama_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($diklatkerjasama_list->TotalRecords > 0 && $diklatkerjasama_list->ExportOptions->visible()) { ?>
<?php $diklatkerjasama_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($diklatkerjasama_list->ImportOptions->visible()) { ?>
<?php $diklatkerjasama_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($diklatkerjasama_list->SearchOptions->visible()) { ?>
<?php $diklatkerjasama_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($diklatkerjasama_list->FilterOptions->visible()) { ?>
<?php $diklatkerjasama_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$diklatkerjasama_list->isExport() || Config("EXPORT_MASTER_RECORD") && $diklatkerjasama_list->isExport("print")) { ?>
<?php
if ($diklatkerjasama_list->DbMasterFilter != "" && $diklatkerjasama->getCurrentMasterTable() == "t_rpkerjasama") {
	if ($diklatkerjasama_list->MasterRecordExists) {
		include_once "t_rpkerjasamamaster.php";
	}
}
?>
<?php } ?>
<?php
$diklatkerjasama_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$diklatkerjasama_list->isExport() && !$diklatkerjasama->CurrentAction) { ?>
<form name="fdiklatkerjasamalistsrch" id="fdiklatkerjasamalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdiklatkerjasamalistsrch-search-panel" class="<?php echo $diklatkerjasama_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="diklatkerjasama">
	<div class="ew-extended-search">
<?php

// Render search row
$diklatkerjasama->RowType = ROWTYPE_SEARCH;
$diklatkerjasama->resetAttributes();
$diklatkerjasama_list->renderRow();
?>
<?php if ($diklatkerjasama_list->kdprop->Visible) { // kdprop ?>
	<?php
		$diklatkerjasama_list->SearchColumnCount++;
		if (($diklatkerjasama_list->SearchColumnCount - 1) % $diklatkerjasama_list->SearchFieldsPerRow == 0) {
			$diklatkerjasama_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $diklatkerjasama_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kdprop" class="ew-cell form-group">
		<label for="x_kdprop" class="ew-search-caption ew-label"><?php echo $diklatkerjasama_list->kdprop->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdprop" id="z_kdprop" value="=">
</span>
		<span id="el_diklatkerjasama_kdprop" class="ew-search-field">
<?php $diklatkerjasama_list->kdprop->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatkerjasama" data-field="x_kdprop" data-value-separator="<?php echo $diklatkerjasama_list->kdprop->displayValueSeparatorAttribute() ?>" id="x_kdprop" name="x_kdprop"<?php echo $diklatkerjasama_list->kdprop->editAttributes() ?>>
			<?php echo $diklatkerjasama_list->kdprop->selectOptionListHtml("x_kdprop") ?>
		</select>
</div>
<?php echo $diklatkerjasama_list->kdprop->Lookup->getParamTag($diklatkerjasama_list, "p_x_kdprop") ?>
</span>
	</div>
	<?php if ($diklatkerjasama_list->SearchColumnCount % $diklatkerjasama_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_list->kdkota->Visible) { // kdkota ?>
	<?php
		$diklatkerjasama_list->SearchColumnCount++;
		if (($diklatkerjasama_list->SearchColumnCount - 1) % $diklatkerjasama_list->SearchFieldsPerRow == 0) {
			$diklatkerjasama_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $diklatkerjasama_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kdkota" class="ew-cell form-group">
		<label for="x_kdkota" class="ew-search-caption ew-label"><?php echo $diklatkerjasama_list->kdkota->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdkota" id="z_kdkota" value="=">
</span>
		<span id="el_diklatkerjasama_kdkota" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatkerjasama" data-field="x_kdkota" data-value-separator="<?php echo $diklatkerjasama_list->kdkota->displayValueSeparatorAttribute() ?>" id="x_kdkota" name="x_kdkota"<?php echo $diklatkerjasama_list->kdkota->editAttributes() ?>>
			<?php echo $diklatkerjasama_list->kdkota->selectOptionListHtml("x_kdkota") ?>
		</select>
</div>
<?php echo $diklatkerjasama_list->kdkota->Lookup->getParamTag($diklatkerjasama_list, "p_x_kdkota") ?>
</span>
	</div>
	<?php if ($diklatkerjasama_list->SearchColumnCount % $diklatkerjasama_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($diklatkerjasama_list->SearchColumnCount % $diklatkerjasama_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $diklatkerjasama_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $diklatkerjasama_list->showPageHeader(); ?>
<?php
$diklatkerjasama_list->showMessage();
?>
<?php if ($diklatkerjasama_list->TotalRecords > 0 || $diklatkerjasama->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($diklatkerjasama_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> diklatkerjasama">
<?php if (!$diklatkerjasama_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$diklatkerjasama_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $diklatkerjasama_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $diklatkerjasama_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdiklatkerjasamalist" id="fdiklatkerjasamalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="diklatkerjasama">
<?php if ($diklatkerjasama->getCurrentMasterTable() == "t_rpkerjasama" && $diklatkerjasama->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_rpkerjasama">
<input type="hidden" name="fk_rpkid" value="<?php echo HtmlEncode($diklatkerjasama_list->rid->getSessionValue()) ?>">
<input type="hidden" name="fk_jenispel" value="<?php echo HtmlEncode($diklatkerjasama_list->jenispel->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_diklatkerjasama" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($diklatkerjasama_list->TotalRecords > 0 || $diklatkerjasama_list->isGridEdit()) { ?>
<table id="tbl_diklatkerjasamalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$diklatkerjasama->RowType = ROWTYPE_HEADER;

// Render list options
$diklatkerjasama_list->renderListOptions();

// Render list options (header, left)
$diklatkerjasama_list->ListOptions->render("header", "left");
?>
<?php if ($diklatkerjasama_list->kdjudul->Visible) { // kdjudul ?>
	<?php if ($diklatkerjasama_list->SortUrl($diklatkerjasama_list->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $diklatkerjasama_list->kdjudul->headerCellClass() ?>"><div id="elh_diklatkerjasama_kdjudul" class="diklatkerjasama_kdjudul"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_list->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $diklatkerjasama_list->kdjudul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatkerjasama_list->SortUrl($diklatkerjasama_list->kdjudul) ?>', 1);"><div id="elh_diklatkerjasama_kdjudul" class="diklatkerjasama_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_list->kdjudul->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_list->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_list->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_list->kdkursil->Visible) { // kdkursil ?>
	<?php if ($diklatkerjasama_list->SortUrl($diklatkerjasama_list->kdkursil) == "") { ?>
		<th data-name="kdkursil" class="<?php echo $diklatkerjasama_list->kdkursil->headerCellClass() ?>"><div id="elh_diklatkerjasama_kdkursil" class="diklatkerjasama_kdkursil"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_list->kdkursil->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkursil" class="<?php echo $diklatkerjasama_list->kdkursil->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatkerjasama_list->SortUrl($diklatkerjasama_list->kdkursil) ?>', 1);"><div id="elh_diklatkerjasama_kdkursil" class="diklatkerjasama_kdkursil">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_list->kdkursil->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_list->kdkursil->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_list->kdkursil->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_list->tawal->Visible) { // tawal ?>
	<?php if ($diklatkerjasama_list->SortUrl($diklatkerjasama_list->tawal) == "") { ?>
		<th data-name="tawal" class="<?php echo $diklatkerjasama_list->tawal->headerCellClass() ?>"><div id="elh_diklatkerjasama_tawal" class="diklatkerjasama_tawal"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_list->tawal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tawal" class="<?php echo $diklatkerjasama_list->tawal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatkerjasama_list->SortUrl($diklatkerjasama_list->tawal) ?>', 1);"><div id="elh_diklatkerjasama_tawal" class="diklatkerjasama_tawal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_list->tawal->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_list->tawal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_list->tawal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_list->takhir->Visible) { // takhir ?>
	<?php if ($diklatkerjasama_list->SortUrl($diklatkerjasama_list->takhir) == "") { ?>
		<th data-name="takhir" class="<?php echo $diklatkerjasama_list->takhir->headerCellClass() ?>"><div id="elh_diklatkerjasama_takhir" class="diklatkerjasama_takhir"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_list->takhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="takhir" class="<?php echo $diklatkerjasama_list->takhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatkerjasama_list->SortUrl($diklatkerjasama_list->takhir) ?>', 1);"><div id="elh_diklatkerjasama_takhir" class="diklatkerjasama_takhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_list->takhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_list->takhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_list->takhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_list->jml_hari->Visible) { // jml_hari ?>
	<?php if ($diklatkerjasama_list->SortUrl($diklatkerjasama_list->jml_hari) == "") { ?>
		<th data-name="jml_hari" class="<?php echo $diklatkerjasama_list->jml_hari->headerCellClass() ?>"><div id="elh_diklatkerjasama_jml_hari" class="diklatkerjasama_jml_hari"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_list->jml_hari->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jml_hari" class="<?php echo $diklatkerjasama_list->jml_hari->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatkerjasama_list->SortUrl($diklatkerjasama_list->jml_hari) ?>', 1);"><div id="elh_diklatkerjasama_jml_hari" class="diklatkerjasama_jml_hari">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_list->jml_hari->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_list->jml_hari->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_list->jml_hari->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_list->targetpes->Visible) { // targetpes ?>
	<?php if ($diklatkerjasama_list->SortUrl($diklatkerjasama_list->targetpes) == "") { ?>
		<th data-name="targetpes" class="<?php echo $diklatkerjasama_list->targetpes->headerCellClass() ?>"><div id="elh_diklatkerjasama_targetpes" class="diklatkerjasama_targetpes"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_list->targetpes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes" class="<?php echo $diklatkerjasama_list->targetpes->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatkerjasama_list->SortUrl($diklatkerjasama_list->targetpes) ?>', 1);"><div id="elh_diklatkerjasama_targetpes" class="diklatkerjasama_targetpes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_list->targetpes->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_list->targetpes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_list->targetpes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_list->ketua->Visible) { // ketua ?>
	<?php if ($diklatkerjasama_list->SortUrl($diklatkerjasama_list->ketua) == "") { ?>
		<th data-name="ketua" class="<?php echo $diklatkerjasama_list->ketua->headerCellClass() ?>"><div id="elh_diklatkerjasama_ketua" class="diklatkerjasama_ketua"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_list->ketua->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ketua" class="<?php echo $diklatkerjasama_list->ketua->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatkerjasama_list->SortUrl($diklatkerjasama_list->ketua) ?>', 1);"><div id="elh_diklatkerjasama_ketua" class="diklatkerjasama_ketua">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_list->ketua->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_list->ketua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_list->ketua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_list->sekretaris->Visible) { // sekretaris ?>
	<?php if ($diklatkerjasama_list->SortUrl($diklatkerjasama_list->sekretaris) == "") { ?>
		<th data-name="sekretaris" class="<?php echo $diklatkerjasama_list->sekretaris->headerCellClass() ?>"><div id="elh_diklatkerjasama_sekretaris" class="diklatkerjasama_sekretaris"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_list->sekretaris->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sekretaris" class="<?php echo $diklatkerjasama_list->sekretaris->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatkerjasama_list->SortUrl($diklatkerjasama_list->sekretaris) ?>', 1);"><div id="elh_diklatkerjasama_sekretaris" class="diklatkerjasama_sekretaris">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_list->sekretaris->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_list->sekretaris->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_list->sekretaris->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_list->bendahara->Visible) { // bendahara ?>
	<?php if ($diklatkerjasama_list->SortUrl($diklatkerjasama_list->bendahara) == "") { ?>
		<th data-name="bendahara" class="<?php echo $diklatkerjasama_list->bendahara->headerCellClass() ?>"><div id="elh_diklatkerjasama_bendahara" class="diklatkerjasama_bendahara"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_list->bendahara->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bendahara" class="<?php echo $diklatkerjasama_list->bendahara->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatkerjasama_list->SortUrl($diklatkerjasama_list->bendahara) ?>', 1);"><div id="elh_diklatkerjasama_bendahara" class="diklatkerjasama_bendahara">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_list->bendahara->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_list->bendahara->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_list->bendahara->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_list->anggota2->Visible) { // anggota2 ?>
	<?php if ($diklatkerjasama_list->SortUrl($diklatkerjasama_list->anggota2) == "") { ?>
		<th data-name="anggota2" class="<?php echo $diklatkerjasama_list->anggota2->headerCellClass() ?>"><div id="elh_diklatkerjasama_anggota2" class="diklatkerjasama_anggota2"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_list->anggota2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="anggota2" class="<?php echo $diklatkerjasama_list->anggota2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatkerjasama_list->SortUrl($diklatkerjasama_list->anggota2) ?>', 1);"><div id="elh_diklatkerjasama_anggota2" class="diklatkerjasama_anggota2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_list->anggota2->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_list->anggota2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_list->anggota2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_list->widyaiswara->Visible) { // widyaiswara ?>
	<?php if ($diklatkerjasama_list->SortUrl($diklatkerjasama_list->widyaiswara) == "") { ?>
		<th data-name="widyaiswara" class="<?php echo $diklatkerjasama_list->widyaiswara->headerCellClass() ?>"><div id="elh_diklatkerjasama_widyaiswara" class="diklatkerjasama_widyaiswara"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_list->widyaiswara->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="widyaiswara" class="<?php echo $diklatkerjasama_list->widyaiswara->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatkerjasama_list->SortUrl($diklatkerjasama_list->widyaiswara) ?>', 1);"><div id="elh_diklatkerjasama_widyaiswara" class="diklatkerjasama_widyaiswara">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_list->widyaiswara->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_list->widyaiswara->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_list->widyaiswara->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_list->kdprop->Visible) { // kdprop ?>
	<?php if ($diklatkerjasama_list->SortUrl($diklatkerjasama_list->kdprop) == "") { ?>
		<th data-name="kdprop" class="<?php echo $diklatkerjasama_list->kdprop->headerCellClass() ?>"><div id="elh_diklatkerjasama_kdprop" class="diklatkerjasama_kdprop"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_list->kdprop->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdprop" class="<?php echo $diklatkerjasama_list->kdprop->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatkerjasama_list->SortUrl($diklatkerjasama_list->kdprop) ?>', 1);"><div id="elh_diklatkerjasama_kdprop" class="diklatkerjasama_kdprop">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_list->kdprop->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_list->kdprop->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_list->kdprop->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_list->kdkota->Visible) { // kdkota ?>
	<?php if ($diklatkerjasama_list->SortUrl($diklatkerjasama_list->kdkota) == "") { ?>
		<th data-name="kdkota" class="<?php echo $diklatkerjasama_list->kdkota->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_diklatkerjasama_kdkota" class="diklatkerjasama_kdkota"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_list->kdkota->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkota" class="<?php echo $diklatkerjasama_list->kdkota->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatkerjasama_list->SortUrl($diklatkerjasama_list->kdkota) ?>', 1);"><div id="elh_diklatkerjasama_kdkota" class="diklatkerjasama_kdkota">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_list->kdkota->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_list->kdkota->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_list->kdkota->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_list->tempat->Visible) { // tempat ?>
	<?php if ($diklatkerjasama_list->SortUrl($diklatkerjasama_list->tempat) == "") { ?>
		<th data-name="tempat" class="<?php echo $diklatkerjasama_list->tempat->headerCellClass() ?>"><div id="elh_diklatkerjasama_tempat" class="diklatkerjasama_tempat"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_list->tempat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tempat" class="<?php echo $diklatkerjasama_list->tempat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatkerjasama_list->SortUrl($diklatkerjasama_list->tempat) ?>', 1);"><div id="elh_diklatkerjasama_tempat" class="diklatkerjasama_tempat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_list->tempat->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_list->tempat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_list->tempat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_list->biaya->Visible) { // biaya ?>
	<?php if ($diklatkerjasama_list->SortUrl($diklatkerjasama_list->biaya) == "") { ?>
		<th data-name="biaya" class="<?php echo $diklatkerjasama_list->biaya->headerCellClass() ?>"><div id="elh_diklatkerjasama_biaya" class="diklatkerjasama_biaya"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_list->biaya->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="biaya" class="<?php echo $diklatkerjasama_list->biaya->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatkerjasama_list->SortUrl($diklatkerjasama_list->biaya) ?>', 1);"><div id="elh_diklatkerjasama_biaya" class="diklatkerjasama_biaya">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_list->biaya->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_list->biaya->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_list->biaya->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_list->statuspel->Visible) { // statuspel ?>
	<?php if ($diklatkerjasama_list->SortUrl($diklatkerjasama_list->statuspel) == "") { ?>
		<th data-name="statuspel" class="<?php echo $diklatkerjasama_list->statuspel->headerCellClass() ?>"><div id="elh_diklatkerjasama_statuspel" class="diklatkerjasama_statuspel"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_list->statuspel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="statuspel" class="<?php echo $diklatkerjasama_list->statuspel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatkerjasama_list->SortUrl($diklatkerjasama_list->statuspel) ?>', 1);"><div id="elh_diklatkerjasama_statuspel" class="diklatkerjasama_statuspel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_list->statuspel->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_list->statuspel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_list->statuspel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatkerjasama_list->jenisevaluasi->Visible) { // jenisevaluasi ?>
	<?php if ($diklatkerjasama_list->SortUrl($diklatkerjasama_list->jenisevaluasi) == "") { ?>
		<th data-name="jenisevaluasi" class="<?php echo $diklatkerjasama_list->jenisevaluasi->headerCellClass() ?>"><div id="elh_diklatkerjasama_jenisevaluasi" class="diklatkerjasama_jenisevaluasi"><div class="ew-table-header-caption"><?php echo $diklatkerjasama_list->jenisevaluasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenisevaluasi" class="<?php echo $diklatkerjasama_list->jenisevaluasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatkerjasama_list->SortUrl($diklatkerjasama_list->jenisevaluasi) ?>', 1);"><div id="elh_diklatkerjasama_jenisevaluasi" class="diklatkerjasama_jenisevaluasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatkerjasama_list->jenisevaluasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatkerjasama_list->jenisevaluasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatkerjasama_list->jenisevaluasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$diklatkerjasama_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($diklatkerjasama_list->ExportAll && $diklatkerjasama_list->isExport()) {
	$diklatkerjasama_list->StopRecord = $diklatkerjasama_list->TotalRecords;
} else {

	// Set the last record to display
	if ($diklatkerjasama_list->TotalRecords > $diklatkerjasama_list->StartRecord + $diklatkerjasama_list->DisplayRecords - 1)
		$diklatkerjasama_list->StopRecord = $diklatkerjasama_list->StartRecord + $diklatkerjasama_list->DisplayRecords - 1;
	else
		$diklatkerjasama_list->StopRecord = $diklatkerjasama_list->TotalRecords;
}
$diklatkerjasama_list->RecordCount = $diklatkerjasama_list->StartRecord - 1;
if ($diklatkerjasama_list->Recordset && !$diklatkerjasama_list->Recordset->EOF) {
	$diklatkerjasama_list->Recordset->moveFirst();
	$selectLimit = $diklatkerjasama_list->UseSelectLimit;
	if (!$selectLimit && $diklatkerjasama_list->StartRecord > 1)
		$diklatkerjasama_list->Recordset->move($diklatkerjasama_list->StartRecord - 1);
} elseif (!$diklatkerjasama->AllowAddDeleteRow && $diklatkerjasama_list->StopRecord == 0) {
	$diklatkerjasama_list->StopRecord = $diklatkerjasama->GridAddRowCount;
}

// Initialize aggregate
$diklatkerjasama->RowType = ROWTYPE_AGGREGATEINIT;
$diklatkerjasama->resetAttributes();
$diklatkerjasama_list->renderRow();
while ($diklatkerjasama_list->RecordCount < $diklatkerjasama_list->StopRecord) {
	$diklatkerjasama_list->RecordCount++;
	if ($diklatkerjasama_list->RecordCount >= $diklatkerjasama_list->StartRecord) {
		$diklatkerjasama_list->RowCount++;

		// Set up key count
		$diklatkerjasama_list->KeyCount = $diklatkerjasama_list->RowIndex;

		// Init row class and style
		$diklatkerjasama->resetAttributes();
		$diklatkerjasama->CssClass = "";
		if ($diklatkerjasama_list->isGridAdd()) {
		} else {
			$diklatkerjasama_list->loadRowValues($diklatkerjasama_list->Recordset); // Load row values
		}
		$diklatkerjasama->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$diklatkerjasama->RowAttrs->merge(["data-rowindex" => $diklatkerjasama_list->RowCount, "id" => "r" . $diklatkerjasama_list->RowCount . "_diklatkerjasama", "data-rowtype" => $diklatkerjasama->RowType]);

		// Render row
		$diklatkerjasama_list->renderRow();

		// Render list options
		$diklatkerjasama_list->renderListOptions();
?>
	<tr <?php echo $diklatkerjasama->rowAttributes() ?>>
<?php

// Render list options (body, left)
$diklatkerjasama_list->ListOptions->render("body", "left", $diklatkerjasama_list->RowCount);
?>
	<?php if ($diklatkerjasama_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $diklatkerjasama_list->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_list->RowCount ?>_diklatkerjasama_kdjudul">
<span<?php echo $diklatkerjasama_list->kdjudul->viewAttributes() ?>><?php echo $diklatkerjasama_list->kdjudul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->kdkursil->Visible) { // kdkursil ?>
		<td data-name="kdkursil" <?php echo $diklatkerjasama_list->kdkursil->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_list->RowCount ?>_diklatkerjasama_kdkursil">
<span<?php echo $diklatkerjasama_list->kdkursil->viewAttributes() ?>><?php echo $diklatkerjasama_list->kdkursil->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->tawal->Visible) { // tawal ?>
		<td data-name="tawal" <?php echo $diklatkerjasama_list->tawal->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_list->RowCount ?>_diklatkerjasama_tawal">
<span<?php echo $diklatkerjasama_list->tawal->viewAttributes() ?>><?php echo $diklatkerjasama_list->tawal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->takhir->Visible) { // takhir ?>
		<td data-name="takhir" <?php echo $diklatkerjasama_list->takhir->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_list->RowCount ?>_diklatkerjasama_takhir">
<span<?php echo $diklatkerjasama_list->takhir->viewAttributes() ?>><?php echo $diklatkerjasama_list->takhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->jml_hari->Visible) { // jml_hari ?>
		<td data-name="jml_hari" <?php echo $diklatkerjasama_list->jml_hari->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_list->RowCount ?>_diklatkerjasama_jml_hari">
<span<?php echo $diklatkerjasama_list->jml_hari->viewAttributes() ?>><?php echo $diklatkerjasama_list->jml_hari->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->targetpes->Visible) { // targetpes ?>
		<td data-name="targetpes" <?php echo $diklatkerjasama_list->targetpes->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_list->RowCount ?>_diklatkerjasama_targetpes">
<span<?php echo $diklatkerjasama_list->targetpes->viewAttributes() ?>><?php echo $diklatkerjasama_list->targetpes->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->ketua->Visible) { // ketua ?>
		<td data-name="ketua" <?php echo $diklatkerjasama_list->ketua->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_list->RowCount ?>_diklatkerjasama_ketua">
<span<?php echo $diklatkerjasama_list->ketua->viewAttributes() ?>><?php echo $diklatkerjasama_list->ketua->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->sekretaris->Visible) { // sekretaris ?>
		<td data-name="sekretaris" <?php echo $diklatkerjasama_list->sekretaris->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_list->RowCount ?>_diklatkerjasama_sekretaris">
<span<?php echo $diklatkerjasama_list->sekretaris->viewAttributes() ?>><?php echo $diklatkerjasama_list->sekretaris->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->bendahara->Visible) { // bendahara ?>
		<td data-name="bendahara" <?php echo $diklatkerjasama_list->bendahara->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_list->RowCount ?>_diklatkerjasama_bendahara">
<span<?php echo $diklatkerjasama_list->bendahara->viewAttributes() ?>><?php echo $diklatkerjasama_list->bendahara->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->anggota2->Visible) { // anggota2 ?>
		<td data-name="anggota2" <?php echo $diklatkerjasama_list->anggota2->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_list->RowCount ?>_diklatkerjasama_anggota2">
<span<?php echo $diklatkerjasama_list->anggota2->viewAttributes() ?>><?php echo $diklatkerjasama_list->anggota2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->widyaiswara->Visible) { // widyaiswara ?>
		<td data-name="widyaiswara" <?php echo $diklatkerjasama_list->widyaiswara->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_list->RowCount ?>_diklatkerjasama_widyaiswara">
<span<?php echo $diklatkerjasama_list->widyaiswara->viewAttributes() ?>><?php echo $diklatkerjasama_list->widyaiswara->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" <?php echo $diklatkerjasama_list->kdprop->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_list->RowCount ?>_diklatkerjasama_kdprop">
<span<?php echo $diklatkerjasama_list->kdprop->viewAttributes() ?>><?php echo $diklatkerjasama_list->kdprop->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->kdkota->Visible) { // kdkota ?>
		<td data-name="kdkota" <?php echo $diklatkerjasama_list->kdkota->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_list->RowCount ?>_diklatkerjasama_kdkota">
<span<?php echo $diklatkerjasama_list->kdkota->viewAttributes() ?>><?php echo $diklatkerjasama_list->kdkota->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->tempat->Visible) { // tempat ?>
		<td data-name="tempat" <?php echo $diklatkerjasama_list->tempat->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_list->RowCount ?>_diklatkerjasama_tempat">
<span<?php echo $diklatkerjasama_list->tempat->viewAttributes() ?>><?php echo $diklatkerjasama_list->tempat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->biaya->Visible) { // biaya ?>
		<td data-name="biaya" <?php echo $diklatkerjasama_list->biaya->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_list->RowCount ?>_diklatkerjasama_biaya">
<span<?php echo $diklatkerjasama_list->biaya->viewAttributes() ?>><?php echo $diklatkerjasama_list->biaya->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->statuspel->Visible) { // statuspel ?>
		<td data-name="statuspel" <?php echo $diklatkerjasama_list->statuspel->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_list->RowCount ?>_diklatkerjasama_statuspel">
<span<?php echo $diklatkerjasama_list->statuspel->viewAttributes() ?>><?php echo $diklatkerjasama_list->statuspel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->jenisevaluasi->Visible) { // jenisevaluasi ?>
		<td data-name="jenisevaluasi" <?php echo $diklatkerjasama_list->jenisevaluasi->cellAttributes() ?>>
<span id="el<?php echo $diklatkerjasama_list->RowCount ?>_diklatkerjasama_jenisevaluasi">
<span<?php echo $diklatkerjasama_list->jenisevaluasi->viewAttributes() ?>><?php echo $diklatkerjasama_list->jenisevaluasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$diklatkerjasama_list->ListOptions->render("body", "right", $diklatkerjasama_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$diklatkerjasama_list->isGridAdd())
		$diklatkerjasama_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$diklatkerjasama->RowType = ROWTYPE_AGGREGATE;
$diklatkerjasama->resetAttributes();
$diklatkerjasama_list->renderRow();
?>
<?php if ($diklatkerjasama_list->TotalRecords > 0 && !$diklatkerjasama_list->isGridAdd() && !$diklatkerjasama_list->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$diklatkerjasama_list->renderListOptions();

// Render list options (footer, left)
$diklatkerjasama_list->ListOptions->render("footer", "left");
?>
	<?php if ($diklatkerjasama_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" class="<?php echo $diklatkerjasama_list->kdjudul->footerCellClass() ?>"><span id="elf_diklatkerjasama_kdjudul" class="diklatkerjasama_kdjudul">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->kdkursil->Visible) { // kdkursil ?>
		<td data-name="kdkursil" class="<?php echo $diklatkerjasama_list->kdkursil->footerCellClass() ?>"><span id="elf_diklatkerjasama_kdkursil" class="diklatkerjasama_kdkursil">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->tawal->Visible) { // tawal ?>
		<td data-name="tawal" class="<?php echo $diklatkerjasama_list->tawal->footerCellClass() ?>"><span id="elf_diklatkerjasama_tawal" class="diklatkerjasama_tawal">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->takhir->Visible) { // takhir ?>
		<td data-name="takhir" class="<?php echo $diklatkerjasama_list->takhir->footerCellClass() ?>"><span id="elf_diklatkerjasama_takhir" class="diklatkerjasama_takhir">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->jml_hari->Visible) { // jml_hari ?>
		<td data-name="jml_hari" class="<?php echo $diklatkerjasama_list->jml_hari->footerCellClass() ?>"><span id="elf_diklatkerjasama_jml_hari" class="diklatkerjasama_jml_hari">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->targetpes->Visible) { // targetpes ?>
		<td data-name="targetpes" class="<?php echo $diklatkerjasama_list->targetpes->footerCellClass() ?>"><span id="elf_diklatkerjasama_targetpes" class="diklatkerjasama_targetpes">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $diklatkerjasama_list->targetpes->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->ketua->Visible) { // ketua ?>
		<td data-name="ketua" class="<?php echo $diklatkerjasama_list->ketua->footerCellClass() ?>"><span id="elf_diklatkerjasama_ketua" class="diklatkerjasama_ketua">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->sekretaris->Visible) { // sekretaris ?>
		<td data-name="sekretaris" class="<?php echo $diklatkerjasama_list->sekretaris->footerCellClass() ?>"><span id="elf_diklatkerjasama_sekretaris" class="diklatkerjasama_sekretaris">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->bendahara->Visible) { // bendahara ?>
		<td data-name="bendahara" class="<?php echo $diklatkerjasama_list->bendahara->footerCellClass() ?>"><span id="elf_diklatkerjasama_bendahara" class="diklatkerjasama_bendahara">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->anggota2->Visible) { // anggota2 ?>
		<td data-name="anggota2" class="<?php echo $diklatkerjasama_list->anggota2->footerCellClass() ?>"><span id="elf_diklatkerjasama_anggota2" class="diklatkerjasama_anggota2">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->widyaiswara->Visible) { // widyaiswara ?>
		<td data-name="widyaiswara" class="<?php echo $diklatkerjasama_list->widyaiswara->footerCellClass() ?>"><span id="elf_diklatkerjasama_widyaiswara" class="diklatkerjasama_widyaiswara">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" class="<?php echo $diklatkerjasama_list->kdprop->footerCellClass() ?>"><span id="elf_diklatkerjasama_kdprop" class="diklatkerjasama_kdprop">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->kdkota->Visible) { // kdkota ?>
		<td data-name="kdkota" class="<?php echo $diklatkerjasama_list->kdkota->footerCellClass() ?>"><span id="elf_diklatkerjasama_kdkota" class="diklatkerjasama_kdkota">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->tempat->Visible) { // tempat ?>
		<td data-name="tempat" class="<?php echo $diklatkerjasama_list->tempat->footerCellClass() ?>"><span id="elf_diklatkerjasama_tempat" class="diklatkerjasama_tempat">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->biaya->Visible) { // biaya ?>
		<td data-name="biaya" class="<?php echo $diklatkerjasama_list->biaya->footerCellClass() ?>"><span id="elf_diklatkerjasama_biaya" class="diklatkerjasama_biaya">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->statuspel->Visible) { // statuspel ?>
		<td data-name="statuspel" class="<?php echo $diklatkerjasama_list->statuspel->footerCellClass() ?>"><span id="elf_diklatkerjasama_statuspel" class="diklatkerjasama_statuspel">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($diklatkerjasama_list->jenisevaluasi->Visible) { // jenisevaluasi ?>
		<td data-name="jenisevaluasi" class="<?php echo $diklatkerjasama_list->jenisevaluasi->footerCellClass() ?>"><span id="elf_diklatkerjasama_jenisevaluasi" class="diklatkerjasama_jenisevaluasi">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$diklatkerjasama_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$diklatkerjasama->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($diklatkerjasama_list->Recordset)
	$diklatkerjasama_list->Recordset->Close();
?>
<?php if (!$diklatkerjasama_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$diklatkerjasama_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $diklatkerjasama_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $diklatkerjasama_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($diklatkerjasama_list->TotalRecords == 0 && !$diklatkerjasama->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $diklatkerjasama_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$diklatkerjasama_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$diklatkerjasama_list->isExport()) { ?>
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
$diklatkerjasama_list->terminate();
?>