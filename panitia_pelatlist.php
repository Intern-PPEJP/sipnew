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
$panitia_pelat_list = new panitia_pelat_list();

// Run the page
$panitia_pelat_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$panitia_pelat_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$panitia_pelat_list->isExport()) { ?>

<script>
var fpanitia_pelatlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpanitia_pelatlist = currentForm = new ew.Form("fpanitia_pelatlist", "list");
	fpanitia_pelatlist.formKeyCountName = '<?php echo $panitia_pelat_list->FormKeyCountName ?>';
	loadjs.done("fpanitia_pelatlist");
});
var fpanitia_pelatlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpanitia_pelatlistsrch = currentSearchForm = new ew.Form("fpanitia_pelatlistsrch");

	// Validate function for search
	fpanitia_pelatlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id_peg");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($panitia_pelat_list->id_peg->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fpanitia_pelatlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpanitia_pelatlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpanitia_pelatlistsrch.lists["x_tahun"] = <?php echo $panitia_pelat_list->tahun->Lookup->toClientList($panitia_pelat_list) ?>;
	fpanitia_pelatlistsrch.lists["x_tahun"].options = <?php echo JsonEncode($panitia_pelat_list->tahun->lookupOptions()) ?>;
	fpanitia_pelatlistsrch.lists["x_id_peg"] = <?php echo $panitia_pelat_list->id_peg->Lookup->toClientList($panitia_pelat_list) ?>;
	fpanitia_pelatlistsrch.lists["x_id_peg"].options = <?php echo JsonEncode($panitia_pelat_list->id_peg->lookupOptions()) ?>;
	fpanitia_pelatlistsrch.autoSuggests["x_id_peg"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

	// Filters
	fpanitia_pelatlistsrch.filterList = <?php echo $panitia_pelat_list->getFilterList() ?>;
	loadjs.done("fpanitia_pelatlistsrch");
});
</script>

<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>

<?php if (!$panitia_pelat_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($panitia_pelat_list->TotalRecords > 0 && $panitia_pelat_list->ExportOptions->visible()) { ?>
<?php $panitia_pelat_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($panitia_pelat_list->ImportOptions->visible()) { ?>
<?php $panitia_pelat_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($panitia_pelat_list->SearchOptions->visible()) { ?>
<?php $panitia_pelat_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($panitia_pelat_list->FilterOptions->visible()) { ?>
<?php $panitia_pelat_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>

<?php
$panitia_pelat_list->renderOtherOptions();
?>

<?php if ($Security->CanSearch()) { ?>
<?php if (!$panitia_pelat_list->isExport() && !$panitia_pelat->CurrentAction) { ?>
<form name="fpanitia_pelatlistsrch" id="fpanitia_pelatlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpanitia_pelatlistsrch-search-panel" class="<?php echo $panitia_pelat_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="panitia_pelat">
	<div class="ew-extended-search">
<?php

// Render search row
$panitia_pelat->RowType = ROWTYPE_SEARCH;
$panitia_pelat->resetAttributes();
$panitia_pelat_list->renderRow();
?>

<style>
	.ew-cell {
    display: flex;
    align-items: left; /* Untuk menyejajarkan label dan input secara vertikal */
    margin-bottom: 10px; /* Tambahkan margin antar elemen */
}

.ew-search-caption {
    width: 60px; /* Atur lebar label agar seragam */
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
    width: 130px; /* Atur lebar select di dalam input-group */
}

</style>


<?php if ($panitia_pelat_list->id_peg->Visible) { // id_peg ?>
	<?php
		$panitia_pelat_list->SearchColumnCount++;
		if (($panitia_pelat_list->SearchColumnCount - 1) % $panitia_pelat_list->SearchFieldsPerRow == 0) {
			$panitia_pelat_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $panitia_pelat_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_id_peg" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $panitia_pelat_list->id_peg->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_peg" id="z_id_peg" value="=">
</span>
		<span id="el_panitia_pelat_id_peg" class="ew-search-field">
<?php
$onchange = $panitia_pelat_list->id_peg->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$panitia_pelat_list->id_peg->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_peg">
	<input type="text" class="form-control" name="sv_x_id_peg" id="sv_x_id_peg" value="<?php echo RemoveHtml($panitia_pelat_list->id_peg->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($panitia_pelat_list->id_peg->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($panitia_pelat_list->id_peg->getPlaceHolder()) ?>"<?php echo $panitia_pelat_list->id_peg->editAttributes() ?>>
</span>
<input type="hidden" data-table="panitia_pelat" data-field="x_id_peg" data-value-separator="<?php echo $panitia_pelat_list->id_peg->displayValueSeparatorAttribute() ?>" name="x_id_peg" id="x_id_peg" value="<?php echo HtmlEncode($panitia_pelat_list->id_peg->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpanitia_pelatlistsrch"], function() {
	fpanitia_pelatlistsrch.createAutoSuggest({"id":"x_id_peg","forceSelect":true});
});
</script>
<?php echo $panitia_pelat_list->id_peg->Lookup->getParamTag($panitia_pelat_list, "p_x_id_peg") ?>
</span>
	</div>
	<?php if ($panitia_pelat_list->SearchColumnCount % $panitia_pelat_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>

<?php if ($panitia_pelat_list->tahun->Visible) { // tahun ?>
	<?php
		$panitia_pelat_list->SearchColumnCount++;
		if (($panitia_pelat_list->SearchColumnCount - 1) % $panitia_pelat_list->SearchFieldsPerRow == 0) {
			$panitia_pelat_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $panitia_pelat_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_tahun" class="ew-cell form-group">
		<label for="x_tahun" class="ew-search-caption ew-label"><?php echo $panitia_pelat_list->tahun->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tahun" id="z_tahun" value="=">
</span>
		<span id="el_panitia_pelat_tahun" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="panitia_pelat" data-field="x_tahun" data-value-separator="<?php echo $panitia_pelat_list->tahun->displayValueSeparatorAttribute() ?>" id="x_tahun" name="x_tahun"<?php echo $panitia_pelat_list->tahun->editAttributes() ?>>
			<?php echo $panitia_pelat_list->tahun->selectOptionListHtml("x_tahun") ?>
		</select>
</div>
<?php echo $panitia_pelat_list->tahun->Lookup->getParamTag($panitia_pelat_list, "p_x_tahun") ?>
</span>
	</div>
	<?php if ($panitia_pelat_list->SearchColumnCount % $panitia_pelat_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>

	<?php if ($panitia_pelat_list->SearchColumnCount % $panitia_pelat_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $panitia_pelat_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $panitia_pelat_list->showPageHeader(); ?>
<?php
$panitia_pelat_list->showMessage();
?>
<?php if ($panitia_pelat_list->TotalRecords > 0 || $panitia_pelat->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($panitia_pelat_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> panitia_pelat">
<?php if (!$panitia_pelat_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$panitia_pelat_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $panitia_pelat_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $panitia_pelat_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpanitia_pelatlist" id="fpanitia_pelatlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="panitia_pelat">
<div id="gmp_panitia_pelat" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($panitia_pelat_list->TotalRecords > 0 || $panitia_pelat_list->isGridEdit()) { ?>
<table id="tbl_panitia_pelatlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$panitia_pelat->RowType = ROWTYPE_HEADER;

// Render list options
$panitia_pelat_list->renderListOptions();

// Render list options (header, left)
$panitia_pelat_list->ListOptions->render("header", "left");
?>

<style>
	.ew-table-header-caption {
    text-transform: uppercase;
}
</style>

<?php if ($panitia_pelat_list->tahun->Visible) { // tahun ?>
	<?php if ($panitia_pelat_list->SortUrl($panitia_pelat_list->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $panitia_pelat_list->tahun->headerCellClass() ?>"><div id="elh_panitia_pelat_tahun" class="panitia_pelat_tahun"><div class="ew-table-header-caption"><?php echo $panitia_pelat_list->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $panitia_pelat_list->tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $panitia_pelat_list->SortUrl($panitia_pelat_list->tahun) ?>', 1);"><div id="elh_panitia_pelat_tahun" class="panitia_pelat_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $panitia_pelat_list->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($panitia_pelat_list->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($panitia_pelat_list->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($panitia_pelat_list->id_peg->Visible) { // id_peg ?>
	<?php if ($panitia_pelat_list->SortUrl($panitia_pelat_list->id_peg) == "") { ?>
		<th data-name="id_peg" class="<?php echo $panitia_pelat_list->id_peg->headerCellClass() ?>"><div id="elh_panitia_pelat_id_peg" class="panitia_pelat_id_peg"><div class="ew-table-header-caption"><?php echo $panitia_pelat_list->id_peg->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_peg" class="<?php echo $panitia_pelat_list->id_peg->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $panitia_pelat_list->SortUrl($panitia_pelat_list->id_peg) ?>', 1);"><div id="elh_panitia_pelat_id_peg" class="panitia_pelat_id_peg">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $panitia_pelat_list->id_peg->caption() ?></span><span class="ew-table-header-sort"><?php if ($panitia_pelat_list->id_peg->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($panitia_pelat_list->id_peg->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($panitia_pelat_list->panitia->Visible) { // panitia ?>
	<?php if ($panitia_pelat_list->SortUrl($panitia_pelat_list->panitia) == "") { ?>
		<th data-name="panitia" class="<?php echo $panitia_pelat_list->panitia->headerCellClass() ?>"><div id="elh_panitia_pelat_panitia" class="panitia_pelat_panitia"><div class="ew-table-header-caption"><?php echo $panitia_pelat_list->panitia->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="panitia" class="<?php echo $panitia_pelat_list->panitia->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $panitia_pelat_list->SortUrl($panitia_pelat_list->panitia) ?>', 1);"><div id="elh_panitia_pelat_panitia" class="panitia_pelat_panitia">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $panitia_pelat_list->panitia->caption() ?></span><span class="ew-table-header-sort"><?php if ($panitia_pelat_list->panitia->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($panitia_pelat_list->panitia->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($panitia_pelat_list->nama->Visible) { // nama ?>
	<?php if ($panitia_pelat_list->SortUrl($panitia_pelat_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $panitia_pelat_list->nama->headerCellClass() ?>"><div id="elh_panitia_pelat_nama" class="panitia_pelat_nama"><div class="ew-table-header-caption"><?php echo $panitia_pelat_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $panitia_pelat_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $panitia_pelat_list->SortUrl($panitia_pelat_list->nama) ?>', 1);"><div id="elh_panitia_pelat_nama" class="panitia_pelat_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $panitia_pelat_list->nama->caption() ?></span><span class="ew-table-header-sort"><?php if ($panitia_pelat_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($panitia_pelat_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($panitia_pelat_list->bagian->Visible) { // bagian ?>
	<?php if ($panitia_pelat_list->SortUrl($panitia_pelat_list->bagian) == "") { ?>
		<th data-name="bagian" class="<?php echo $panitia_pelat_list->bagian->headerCellClass() ?>"><div id="elh_panitia_pelat_bagian" class="panitia_pelat_bagian"><div class="ew-table-header-caption"><?php echo $panitia_pelat_list->bagian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bagian" class="<?php echo $panitia_pelat_list->bagian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $panitia_pelat_list->SortUrl($panitia_pelat_list->bagian) ?>', 1);"><div id="elh_panitia_pelat_bagian" class="panitia_pelat_bagian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $panitia_pelat_list->bagian->caption() ?></span><span class="ew-table-header-sort"><?php if ($panitia_pelat_list->bagian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($panitia_pelat_list->bagian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($panitia_pelat_list->jml_pelat->Visible) { // jml_pelat ?>
	<?php if ($panitia_pelat_list->SortUrl($panitia_pelat_list->jml_pelat) == "") { ?>
		<th data-name="jml_pelat" class="<?php echo $panitia_pelat_list->jml_pelat->headerCellClass() ?>"><div id="elh_panitia_pelat_jml_pelat" class="panitia_pelat_jml_pelat"><div class="ew-table-header-caption"><?php echo $panitia_pelat_list->jml_pelat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jml_pelat" class="<?php echo $panitia_pelat_list->jml_pelat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $panitia_pelat_list->SortUrl($panitia_pelat_list->jml_pelat) ?>', 1);"><div id="elh_panitia_pelat_jml_pelat" class="panitia_pelat_jml_pelat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $panitia_pelat_list->jml_pelat->caption() ?></span><span class="ew-table-header-sort"><?php if ($panitia_pelat_list->jml_pelat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($panitia_pelat_list->jml_pelat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($panitia_pelat_list->tempat->Visible) { // tempat ?>
	<?php if ($panitia_pelat_list->SortUrl($panitia_pelat_list->tempat) == "") { ?>
		<th data-name="tempat" class="<?php echo $panitia_pelat_list->tempat->headerCellClass() ?>"><div id="elh_panitia_pelat_tempat" class="panitia_pelat_tempat"><div class="ew-table-header-caption"><?php echo $panitia_pelat_list->tempat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tempat" class="<?php echo $panitia_pelat_list->tempat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $panitia_pelat_list->SortUrl($panitia_pelat_list->tempat) ?>', 1);"><div id="elh_panitia_pelat_tempat" class="panitia_pelat_tempat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $panitia_pelat_list->tempat->caption() ?></span><span class="ew-table-header-sort"><?php if ($panitia_pelat_list->tempat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($panitia_pelat_list->tempat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$panitia_pelat_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($panitia_pelat_list->ExportAll && $panitia_pelat_list->isExport()) {
	$panitia_pelat_list->StopRecord = $panitia_pelat_list->TotalRecords;
} else {

	// Set the last record to display
	if ($panitia_pelat_list->TotalRecords > $panitia_pelat_list->StartRecord + $panitia_pelat_list->DisplayRecords - 1)
		$panitia_pelat_list->StopRecord = $panitia_pelat_list->StartRecord + $panitia_pelat_list->DisplayRecords - 1;
	else
		$panitia_pelat_list->StopRecord = $panitia_pelat_list->TotalRecords;
}
$panitia_pelat_list->RecordCount = $panitia_pelat_list->StartRecord - 1;
if ($panitia_pelat_list->Recordset && !$panitia_pelat_list->Recordset->EOF) {
	$panitia_pelat_list->Recordset->moveFirst();
	$selectLimit = $panitia_pelat_list->UseSelectLimit;
	if (!$selectLimit && $panitia_pelat_list->StartRecord > 1)
		$panitia_pelat_list->Recordset->move($panitia_pelat_list->StartRecord - 1);
} elseif (!$panitia_pelat->AllowAddDeleteRow && $panitia_pelat_list->StopRecord == 0) {
	$panitia_pelat_list->StopRecord = $panitia_pelat->GridAddRowCount;
}

// Initialize aggregate
$panitia_pelat->RowType = ROWTYPE_AGGREGATEINIT;
$panitia_pelat->resetAttributes();
$panitia_pelat_list->renderRow();
while ($panitia_pelat_list->RecordCount < $panitia_pelat_list->StopRecord) {
	$panitia_pelat_list->RecordCount++;
	if ($panitia_pelat_list->RecordCount >= $panitia_pelat_list->StartRecord) {
		$panitia_pelat_list->RowCount++;

		// Set up key count
		$panitia_pelat_list->KeyCount = $panitia_pelat_list->RowIndex;

		// Init row class and style
		$panitia_pelat->resetAttributes();
		$panitia_pelat->CssClass = "";
		if ($panitia_pelat_list->isGridAdd()) {
		} else {
			$panitia_pelat_list->loadRowValues($panitia_pelat_list->Recordset); // Load row values
		}
		$panitia_pelat->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$panitia_pelat->RowAttrs->merge(["data-rowindex" => $panitia_pelat_list->RowCount, "id" => "r" . $panitia_pelat_list->RowCount . "_panitia_pelat", "data-rowtype" => $panitia_pelat->RowType]);

		// Render row
		$panitia_pelat_list->renderRow();

		// Render list options
		$panitia_pelat_list->renderListOptions();
?>
	<tr <?php echo $panitia_pelat->rowAttributes() ?>>
<?php

// Render list options (body, left)
$panitia_pelat_list->ListOptions->render("body", "left", $panitia_pelat_list->RowCount);
?>
	<?php if ($panitia_pelat_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $panitia_pelat_list->tahun->cellAttributes() ?>>
<span id="el<?php echo $panitia_pelat_list->RowCount ?>_panitia_pelat_tahun">
<span<?php echo $panitia_pelat_list->tahun->viewAttributes() ?>><?php echo $panitia_pelat_list->tahun->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($panitia_pelat_list->id_peg->Visible) { // id_peg ?>
		<td data-name="id_peg" <?php echo $panitia_pelat_list->id_peg->cellAttributes() ?>>
<span id="el<?php echo $panitia_pelat_list->RowCount ?>_panitia_pelat_id_peg">
<span<?php echo $panitia_pelat_list->id_peg->viewAttributes() ?>><?php echo $panitia_pelat_list->id_peg->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($panitia_pelat_list->panitia->Visible) { // panitia ?>
		<td data-name="panitia" <?php echo $panitia_pelat_list->panitia->cellAttributes() ?>>
<span id="el<?php echo $panitia_pelat_list->RowCount ?>_panitia_pelat_panitia">
<span<?php echo $panitia_pelat_list->panitia->viewAttributes() ?>><?php echo $panitia_pelat_list->panitia->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($panitia_pelat_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $panitia_pelat_list->nama->cellAttributes() ?>>
<span id="el<?php echo $panitia_pelat_list->RowCount ?>_panitia_pelat_nama">
<span<?php echo $panitia_pelat_list->nama->viewAttributes() ?>><?php echo $panitia_pelat_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($panitia_pelat_list->bagian->Visible) { // bagian ?>
		<td data-name="bagian" <?php echo $panitia_pelat_list->bagian->cellAttributes() ?>>
<span id="el<?php echo $panitia_pelat_list->RowCount ?>_panitia_pelat_bagian">
<span<?php echo $panitia_pelat_list->bagian->viewAttributes() ?>><?php echo $panitia_pelat_list->bagian->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($panitia_pelat_list->jml_pelat->Visible) { // jml_pelat ?>
		<td data-name="jml_pelat" <?php echo $panitia_pelat_list->jml_pelat->cellAttributes() ?>>
<span id="el<?php echo $panitia_pelat_list->RowCount ?>_panitia_pelat_jml_pelat">
<span<?php echo $panitia_pelat_list->jml_pelat->viewAttributes() ?>><?php echo $panitia_pelat_list->jml_pelat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($panitia_pelat_list->tempat->Visible) { // tempat ?>
		<td data-name="tempat" <?php echo $panitia_pelat_list->tempat->cellAttributes() ?>>
<span id="el<?php echo $panitia_pelat_list->RowCount ?>_panitia_pelat_tempat">
<span<?php echo $panitia_pelat_list->tempat->viewAttributes() ?>><?php echo $panitia_pelat_list->tempat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$panitia_pelat_list->ListOptions->render("body", "right", $panitia_pelat_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$panitia_pelat_list->isGridAdd())
		$panitia_pelat_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$panitia_pelat->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($panitia_pelat_list->Recordset)
	$panitia_pelat_list->Recordset->Close();
?>
<?php if (!$panitia_pelat_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$panitia_pelat_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $panitia_pelat_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $panitia_pelat_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($panitia_pelat_list->TotalRecords == 0 && !$panitia_pelat->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $panitia_pelat_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$panitia_pelat_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$panitia_pelat_list->isExport()) { ?>
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
$panitia_pelat_list->terminate();
?>