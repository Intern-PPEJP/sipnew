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
$t_biointruktur_list = new t_biointruktur_list();

// Run the page
$t_biointruktur_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_biointruktur_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_biointruktur_list->isExport()) { ?>

<script>
var ft_biointrukturlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_biointrukturlist = currentForm = new ew.Form("ft_biointrukturlist", "list");
	ft_biointrukturlist.formKeyCountName = '<?php echo $t_biointruktur_list->FormKeyCountName ?>';
	loadjs.done("ft_biointrukturlist");
});
var ft_biointrukturlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_biointrukturlistsrch = currentSearchForm = new ew.Form("ft_biointrukturlistsrch");

	// Validate function for search
	ft_biointrukturlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_komp_materi");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_biointruktur_list->komp_materi->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	ft_biointrukturlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_biointrukturlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_biointrukturlistsrch.lists["x_komp_materi"] = <?php echo $t_biointruktur_list->komp_materi->Lookup->toClientList($t_biointruktur_list) ?>;
	ft_biointrukturlistsrch.lists["x_komp_materi"].options = <?php echo JsonEncode($t_biointruktur_list->komp_materi->lookupOptions()) ?>;
	ft_biointrukturlistsrch.autoSuggests["x_komp_materi"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

	// Filters
	ft_biointrukturlistsrch.filterList = <?php echo $t_biointruktur_list->getFilterList() ?>;
	loadjs.done("ft_biointrukturlistsrch");
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
<?php if (!$t_biointruktur_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_biointruktur_list->TotalRecords > 0 && $t_biointruktur_list->ExportOptions->visible()) { ?>
<?php $t_biointruktur_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_biointruktur_list->ImportOptions->visible()) { ?>
<?php $t_biointruktur_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_biointruktur_list->SearchOptions->visible()) { ?>
<?php $t_biointruktur_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_biointruktur_list->FilterOptions->visible()) { ?>
<?php $t_biointruktur_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>

<?php
$t_biointruktur_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_biointruktur_list->isExport() && !$t_biointruktur->CurrentAction) { ?>
<form name="ft_biointrukturlistsrch" id="ft_biointrukturlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_biointrukturlistsrch-search-panel" class="<?php echo $t_biointruktur_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_biointruktur">
	<div class="ew-extended-search">
<?php

// Render search row
$t_biointruktur->RowType = ROWTYPE_SEARCH;
$t_biointruktur->resetAttributes();
$t_biointruktur_list->renderRow();
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

<?php if ($t_biointruktur_list->nama->Visible) { // nama ?>
	<?php
		$t_biointruktur_list->SearchColumnCount++;
		if (($t_biointruktur_list->SearchColumnCount - 1) % $t_biointruktur_list->SearchFieldsPerRow == 0) {
			$t_biointruktur_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_biointruktur_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_nama" class="ew-cell form-group">
		<label for="x_nama" class="ew-search-caption ew-label"><?php echo $t_biointruktur_list->nama->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nama" id="z_nama" value="LIKE">
</span>
		<span id="el_t_biointruktur_nama" class="ew-search-field">
<input type="text" data-table="t_biointruktur" data-field="x_nama" name="x_nama" id="x_nama" size="50" maxlength="200" placeholder="<?php echo HtmlEncode($t_biointruktur_list->nama->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_list->nama->EditValue ?>"<?php echo $t_biointruktur_list->nama->editAttributes() ?>>
</span>
	</div>
	<?php if ($t_biointruktur_list->SearchColumnCount % $t_biointruktur_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>

<?php if ($t_biointruktur_list->komp_materi->Visible) { // komp_materi ?>
	<?php
		$t_biointruktur_list->SearchColumnCount++;
		if (($t_biointruktur_list->SearchColumnCount - 1) % $t_biointruktur_list->SearchFieldsPerRow == 0) {
			$t_biointruktur_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_biointruktur_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_komp_materi" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $t_biointruktur_list->komp_materi->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_komp_materi" id="z_komp_materi" value="=">
</span>
		<span id="el_t_biointruktur_komp_materi" class="ew-search-field">
<?php
$onchange = $t_biointruktur_list->komp_materi->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_biointruktur_list->komp_materi->EditAttrs["onchange"] = "";
?>
<span id="as_x_komp_materi">
	<input type="text" class="form-control" name="sv_x_komp_materi" id="sv_x_komp_materi" value="<?php echo RemoveHtml($t_biointruktur_list->komp_materi->EditValue) ?>" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_biointruktur_list->komp_materi->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_biointruktur_list->komp_materi->getPlaceHolder()) ?>"<?php echo $t_biointruktur_list->komp_materi->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_biointruktur" data-field="x_komp_materi" data-value-separator="<?php echo $t_biointruktur_list->komp_materi->displayValueSeparatorAttribute() ?>" name="x_komp_materi" id="x_komp_materi" value="<?php echo HtmlEncode($t_biointruktur_list->komp_materi->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>

<script>
loadjs.ready(["ft_biointrukturlistsrch"], function() {
	ft_biointrukturlistsrch.createAutoSuggest({"id":"x_komp_materi","forceSelect":true});
});
</script>

<?php echo $t_biointruktur_list->komp_materi->Lookup->getParamTag($t_biointruktur_list, "p_x_komp_materi") ?>
</span>
	</div>
	<?php if ($t_biointruktur_list->SearchColumnCount % $t_biointruktur_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($t_biointruktur_list->SearchColumnCount % $t_biointruktur_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $t_biointruktur_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_biointruktur_list->showPageHeader(); ?>
<?php
$t_biointruktur_list->showMessage();
?>
<?php if ($t_biointruktur_list->TotalRecords > 0 || $t_biointruktur->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_biointruktur_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_biointruktur">
<?php if (!$t_biointruktur_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_biointruktur_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_biointruktur_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_biointruktur_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_biointrukturlist" id="ft_biointrukturlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_biointruktur">
<div id="gmp_t_biointruktur" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_biointruktur_list->TotalRecords > 0 || $t_biointruktur_list->isGridEdit()) { ?>
<table id="tbl_t_biointrukturlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_biointruktur->RowType = ROWTYPE_HEADER;

// Render list options
$t_biointruktur_list->renderListOptions();

// Render list options (header, left)
$t_biointruktur_list->ListOptions->render("header", "left");
?>

<style>
	.ew-table-header-caption {
    text-transform: uppercase;
}
</style>

<?php if ($t_biointruktur_list->bioid->Visible) { // bioid ?>
	<?php if ($t_biointruktur_list->SortUrl($t_biointruktur_list->bioid) == "") { ?>
		<th data-name="bioid" class="<?php echo $t_biointruktur_list->bioid->headerCellClass() ?>"><div id="elh_t_biointruktur_bioid" class="t_biointruktur_bioid"><div class="ew-table-header-caption"><?php echo $t_biointruktur_list->bioid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bioid" class="<?php echo $t_biointruktur_list->bioid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_biointruktur_list->SortUrl($t_biointruktur_list->bioid) ?>', 1);"><div id="elh_t_biointruktur_bioid" class="t_biointruktur_bioid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_biointruktur_list->bioid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_biointruktur_list->bioid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_biointruktur_list->bioid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_biointruktur_list->kdinstruktur->Visible) { // kdinstruktur ?>
	<?php if ($t_biointruktur_list->SortUrl($t_biointruktur_list->kdinstruktur) == "") { ?>
		<th data-name="kdinstruktur" class="<?php echo $t_biointruktur_list->kdinstruktur->headerCellClass() ?>"><div id="elh_t_biointruktur_kdinstruktur" class="t_biointruktur_kdinstruktur"><div class="ew-table-header-caption"><?php echo $t_biointruktur_list->kdinstruktur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdinstruktur" class="<?php echo $t_biointruktur_list->kdinstruktur->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_biointruktur_list->SortUrl($t_biointruktur_list->kdinstruktur) ?>', 1);"><div id="elh_t_biointruktur_kdinstruktur" class="t_biointruktur_kdinstruktur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_biointruktur_list->kdinstruktur->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_biointruktur_list->kdinstruktur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_biointruktur_list->kdinstruktur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_biointruktur_list->revisi->Visible) { // revisi ?>
	<?php if ($t_biointruktur_list->SortUrl($t_biointruktur_list->revisi) == "") { ?>
		<th data-name="revisi" class="<?php echo $t_biointruktur_list->revisi->headerCellClass() ?>"><div id="elh_t_biointruktur_revisi" class="t_biointruktur_revisi"><div class="ew-table-header-caption"><?php echo $t_biointruktur_list->revisi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="revisi" class="<?php echo $t_biointruktur_list->revisi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_biointruktur_list->SortUrl($t_biointruktur_list->revisi) ?>', 1);"><div id="elh_t_biointruktur_revisi" class="t_biointruktur_revisi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_biointruktur_list->revisi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_biointruktur_list->revisi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_biointruktur_list->revisi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_biointruktur_list->tglterbit->Visible) { // tglterbit ?>
	<?php if ($t_biointruktur_list->SortUrl($t_biointruktur_list->tglterbit) == "") { ?>
		<th data-name="tglterbit" class="<?php echo $t_biointruktur_list->tglterbit->headerCellClass() ?>"><div id="elh_t_biointruktur_tglterbit" class="t_biointruktur_tglterbit"><div class="ew-table-header-caption"><?php echo $t_biointruktur_list->tglterbit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tglterbit" class="<?php echo $t_biointruktur_list->tglterbit->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_biointruktur_list->SortUrl($t_biointruktur_list->tglterbit) ?>', 1);"><div id="elh_t_biointruktur_tglterbit" class="t_biointruktur_tglterbit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_biointruktur_list->tglterbit->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_biointruktur_list->tglterbit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_biointruktur_list->tglterbit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_biointruktur_list->nama->Visible) { // nama ?>
	<?php if ($t_biointruktur_list->SortUrl($t_biointruktur_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $t_biointruktur_list->nama->headerCellClass() ?>"><div id="elh_t_biointruktur_nama" class="t_biointruktur_nama"><div class="ew-table-header-caption"><?php echo $t_biointruktur_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $t_biointruktur_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_biointruktur_list->SortUrl($t_biointruktur_list->nama) ?>', 1);"><div id="elh_t_biointruktur_nama" class="t_biointruktur_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_biointruktur_list->nama->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_biointruktur_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_biointruktur_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_biointruktur_list->komp_materi->Visible) { // komp_materi ?>
	<?php if ($t_biointruktur_list->SortUrl($t_biointruktur_list->komp_materi) == "") { ?>
		<th data-name="komp_materi" class="<?php echo $t_biointruktur_list->komp_materi->headerCellClass() ?>"><div id="elh_t_biointruktur_komp_materi" class="t_biointruktur_komp_materi"><div class="ew-table-header-caption"><?php echo $t_biointruktur_list->komp_materi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="komp_materi" class="<?php echo $t_biointruktur_list->komp_materi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_biointruktur_list->SortUrl($t_biointruktur_list->komp_materi) ?>', 1);"><div id="elh_t_biointruktur_komp_materi" class="t_biointruktur_komp_materi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_biointruktur_list->komp_materi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_biointruktur_list->komp_materi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_biointruktur_list->komp_materi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_biointruktur_list->instansi->Visible) { // instansi ?>
	<?php if ($t_biointruktur_list->SortUrl($t_biointruktur_list->instansi) == "") { ?>
		<th data-name="instansi" class="<?php echo $t_biointruktur_list->instansi->headerCellClass() ?>"><div id="elh_t_biointruktur_instansi" class="t_biointruktur_instansi"><div class="ew-table-header-caption"><?php echo $t_biointruktur_list->instansi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="instansi" class="<?php echo $t_biointruktur_list->instansi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_biointruktur_list->SortUrl($t_biointruktur_list->instansi) ?>', 1);"><div id="elh_t_biointruktur_instansi" class="t_biointruktur_instansi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_biointruktur_list->instansi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_biointruktur_list->instansi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_biointruktur_list->instansi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_biointruktur_list->pekerjaan->Visible) { // pekerjaan ?>
	<?php if ($t_biointruktur_list->SortUrl($t_biointruktur_list->pekerjaan) == "") { ?>
		<th data-name="pekerjaan" class="<?php echo $t_biointruktur_list->pekerjaan->headerCellClass() ?>"><div id="elh_t_biointruktur_pekerjaan" class="t_biointruktur_pekerjaan"><div class="ew-table-header-caption"><?php echo $t_biointruktur_list->pekerjaan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pekerjaan" class="<?php echo $t_biointruktur_list->pekerjaan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_biointruktur_list->SortUrl($t_biointruktur_list->pekerjaan) ?>', 1);"><div id="elh_t_biointruktur_pekerjaan" class="t_biointruktur_pekerjaan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_biointruktur_list->pekerjaan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_biointruktur_list->pekerjaan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_biointruktur_list->pekerjaan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_biointruktur_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_biointruktur_list->ExportAll && $t_biointruktur_list->isExport()) {
	$t_biointruktur_list->StopRecord = $t_biointruktur_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_biointruktur_list->TotalRecords > $t_biointruktur_list->StartRecord + $t_biointruktur_list->DisplayRecords - 1)
		$t_biointruktur_list->StopRecord = $t_biointruktur_list->StartRecord + $t_biointruktur_list->DisplayRecords - 1;
	else
		$t_biointruktur_list->StopRecord = $t_biointruktur_list->TotalRecords;
}
$t_biointruktur_list->RecordCount = $t_biointruktur_list->StartRecord - 1;
if ($t_biointruktur_list->Recordset && !$t_biointruktur_list->Recordset->EOF) {
	$t_biointruktur_list->Recordset->moveFirst();
	$selectLimit = $t_biointruktur_list->UseSelectLimit;
	if (!$selectLimit && $t_biointruktur_list->StartRecord > 1)
		$t_biointruktur_list->Recordset->move($t_biointruktur_list->StartRecord - 1);
} elseif (!$t_biointruktur->AllowAddDeleteRow && $t_biointruktur_list->StopRecord == 0) {
	$t_biointruktur_list->StopRecord = $t_biointruktur->GridAddRowCount;
}

// Initialize aggregate
$t_biointruktur->RowType = ROWTYPE_AGGREGATEINIT;
$t_biointruktur->resetAttributes();
$t_biointruktur_list->renderRow();
while ($t_biointruktur_list->RecordCount < $t_biointruktur_list->StopRecord) {
	$t_biointruktur_list->RecordCount++;
	if ($t_biointruktur_list->RecordCount >= $t_biointruktur_list->StartRecord) {
		$t_biointruktur_list->RowCount++;

		// Set up key count
		$t_biointruktur_list->KeyCount = $t_biointruktur_list->RowIndex;

		// Init row class and style
		$t_biointruktur->resetAttributes();
		$t_biointruktur->CssClass = "";
		if ($t_biointruktur_list->isGridAdd()) {
		} else {
			$t_biointruktur_list->loadRowValues($t_biointruktur_list->Recordset); // Load row values
		}
		$t_biointruktur->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_biointruktur->RowAttrs->merge(["data-rowindex" => $t_biointruktur_list->RowCount, "id" => "r" . $t_biointruktur_list->RowCount . "_t_biointruktur", "data-rowtype" => $t_biointruktur->RowType]);

		// Render row
		$t_biointruktur_list->renderRow();

		// Render list options
		$t_biointruktur_list->renderListOptions();
?>
	<tr <?php echo $t_biointruktur->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_biointruktur_list->ListOptions->render("body", "left", $t_biointruktur_list->RowCount);
?>
	<?php if ($t_biointruktur_list->bioid->Visible) { // bioid ?>
		<td data-name="bioid" <?php echo $t_biointruktur_list->bioid->cellAttributes() ?>>
<span id="el<?php echo $t_biointruktur_list->RowCount ?>_t_biointruktur_bioid">
<span<?php echo $t_biointruktur_list->bioid->viewAttributes() ?>><?php echo $t_biointruktur_list->bioid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_biointruktur_list->kdinstruktur->Visible) { // kdinstruktur ?>
		<td data-name="kdinstruktur" <?php echo $t_biointruktur_list->kdinstruktur->cellAttributes() ?>>
<span id="el<?php echo $t_biointruktur_list->RowCount ?>_t_biointruktur_kdinstruktur">
<span<?php echo $t_biointruktur_list->kdinstruktur->viewAttributes() ?>><?php echo $t_biointruktur_list->kdinstruktur->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_biointruktur_list->revisi->Visible) { // revisi ?>
		<td data-name="revisi" <?php echo $t_biointruktur_list->revisi->cellAttributes() ?>>
<span id="el<?php echo $t_biointruktur_list->RowCount ?>_t_biointruktur_revisi">
<span<?php echo $t_biointruktur_list->revisi->viewAttributes() ?>><?php echo $t_biointruktur_list->revisi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_biointruktur_list->tglterbit->Visible) { // tglterbit ?>
		<td data-name="tglterbit" <?php echo $t_biointruktur_list->tglterbit->cellAttributes() ?>>
<span id="el<?php echo $t_biointruktur_list->RowCount ?>_t_biointruktur_tglterbit">
<span<?php echo $t_biointruktur_list->tglterbit->viewAttributes() ?>><?php echo $t_biointruktur_list->tglterbit->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_biointruktur_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $t_biointruktur_list->nama->cellAttributes() ?>>
<span id="el<?php echo $t_biointruktur_list->RowCount ?>_t_biointruktur_nama">
<span<?php echo $t_biointruktur_list->nama->viewAttributes() ?>><?php echo $t_biointruktur_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_biointruktur_list->komp_materi->Visible) { // komp_materi ?>
		<td data-name="komp_materi" <?php echo $t_biointruktur_list->komp_materi->cellAttributes() ?>>
<span id="el<?php echo $t_biointruktur_list->RowCount ?>_t_biointruktur_komp_materi">
<span<?php echo $t_biointruktur_list->komp_materi->viewAttributes() ?>><?php echo $t_biointruktur_list->komp_materi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_biointruktur_list->instansi->Visible) { // instansi ?>
		<td data-name="instansi" <?php echo $t_biointruktur_list->instansi->cellAttributes() ?>>
<span id="el<?php echo $t_biointruktur_list->RowCount ?>_t_biointruktur_instansi">
<span<?php echo $t_biointruktur_list->instansi->viewAttributes() ?>><?php echo $t_biointruktur_list->instansi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_biointruktur_list->pekerjaan->Visible) { // pekerjaan ?>
		<td data-name="pekerjaan" <?php echo $t_biointruktur_list->pekerjaan->cellAttributes() ?>>
<span id="el<?php echo $t_biointruktur_list->RowCount ?>_t_biointruktur_pekerjaan">
<span<?php echo $t_biointruktur_list->pekerjaan->viewAttributes() ?>><?php echo $t_biointruktur_list->pekerjaan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_biointruktur_list->ListOptions->render("body", "right", $t_biointruktur_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_biointruktur_list->isGridAdd())
		$t_biointruktur_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_biointruktur->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_biointruktur_list->Recordset)
	$t_biointruktur_list->Recordset->Close();
?>
<?php if (!$t_biointruktur_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_biointruktur_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_biointruktur_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_biointruktur_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_biointruktur_list->TotalRecords == 0 && !$t_biointruktur->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_biointruktur_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_biointruktur_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_biointruktur_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// document.write("page loaded");
	//$('.ewAdd').hide();

});
</script>
<?php if (!$t_biointruktur->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_t_biointruktur",
		width: "100%",
		height: "350px"
	});
});
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$t_biointruktur_list->terminate();
?>