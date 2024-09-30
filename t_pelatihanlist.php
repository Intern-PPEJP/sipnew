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
$t_pelatihan_list = new t_pelatihan_list();

// Run the page
$t_pelatihan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pelatihan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_pelatihan_list->isExport()) { ?>

<script>
var ft_pelatihanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_pelatihanlist = currentForm = new ew.Form("ft_pelatihanlist", "list");
	ft_pelatihanlist.formKeyCountName = '<?php echo $t_pelatihan_list->FormKeyCountName ?>';
	loadjs.done("ft_pelatihanlist");
});
var ft_pelatihanlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_pelatihanlistsrch = currentSearchForm = new ew.Form("ft_pelatihanlistsrch");

	// Validate function for search
	ft_pelatihanlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_Tahun");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_pelatihan_list->Tahun->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	ft_pelatihanlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_pelatihanlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_pelatihanlistsrch.lists["x_kdjudul"] = <?php echo $t_pelatihan_list->kdjudul->Lookup->toClientList($t_pelatihan_list) ?>;
	ft_pelatihanlistsrch.lists["x_kdjudul"].options = <?php echo JsonEncode($t_pelatihan_list->kdjudul->lookupOptions()) ?>;
	ft_pelatihanlistsrch.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

	// Filters
	ft_pelatihanlistsrch.filterList = <?php echo $t_pelatihan_list->getFilterList() ?>;
	loadjs.done("ft_pelatihanlistsrch");
});
</script>

<script>
ew.ready("head", "js/ewfixedheadertable.js", "fixedheadertable");
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	function noberkas(){alert("Berkas pdf tidak tersedia! Silahkan mengunggah berkas terlebih dahulu.")}
});
</script>
<?php } ?>

<?php if (!$t_pelatihan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_pelatihan_list->TotalRecords > 0 && $t_pelatihan_list->ExportOptions->visible()) { ?>
<?php $t_pelatihan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_pelatihan_list->ImportOptions->visible()) { ?>
<?php $t_pelatihan_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_pelatihan_list->SearchOptions->visible()) { ?>
<?php $t_pelatihan_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_pelatihan_list->FilterOptions->visible()) { ?>
<?php $t_pelatihan_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$t_pelatihan_list->isExport() || Config("EXPORT_MASTER_RECORD") && $t_pelatihan_list->isExport("print")) { ?>
<?php
if ($t_pelatihan_list->DbMasterFilter != "" && $t_pelatihan->getCurrentMasterTable() == "t_judul") {
	if ($t_pelatihan_list->MasterRecordExists) {
		include_once "t_judulmaster.php";
	}
}
?>
<?php
if ($t_pelatihan_list->DbMasterFilter != "" && $t_pelatihan->getCurrentMasterTable() == "t_kota") {
	if ($t_pelatihan_list->MasterRecordExists) {
		include_once "t_kotamaster.php";
	}
}
?>
<?php
if ($t_pelatihan_list->DbMasterFilter != "" && $t_pelatihan->getCurrentMasterTable() == "t_prop") {
	if ($t_pelatihan_list->MasterRecordExists) {
		include_once "t_propmaster.php";
	}
}
?>
<?php } ?>

<?php
$t_pelatihan_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_pelatihan_list->isExport() && !$t_pelatihan->CurrentAction) { ?>
<form name="ft_pelatihanlistsrch" id="ft_pelatihanlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_pelatihanlistsrch-search-panel" class="<?php echo $t_pelatihan_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_pelatihan">
	<div class="ew-extended-search">
<?php

// Render search row
$t_pelatihan->RowType = ROWTYPE_SEARCH;
$t_pelatihan->resetAttributes();
$t_pelatihan_list->renderRow();
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


<?php if ($t_pelatihan_list->kdjudul->Visible) { // kdjudul ?>
	<?php
		$t_pelatihan_list->SearchColumnCount++;
		if (($t_pelatihan_list->SearchColumnCount - 1) % $t_pelatihan_list->SearchFieldsPerRow == 0) {
			$t_pelatihan_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_pelatihan_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kdjudul" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $t_pelatihan_list->kdjudul->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdjudul" id="z_kdjudul" value="=">
</span>
		<span id="el_t_pelatihan_kdjudul" class="ew-search-field">
<?php
$onchange = $t_pelatihan_list->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_list->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($t_pelatihan_list->kdjudul->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($t_pelatihan_list->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_list->kdjudul->getPlaceHolder()) ?>"<?php echo $t_pelatihan_list->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_kdjudul" data-value-separator="<?php echo $t_pelatihan_list->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($t_pelatihan_list->kdjudul->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihanlistsrch"], function() {
	ft_pelatihanlistsrch.createAutoSuggest({"id":"x_kdjudul","forceSelect":false,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $t_pelatihan_list->kdjudul->Lookup->getParamTag($t_pelatihan_list, "p_x_kdjudul") ?>
</span>
	</div>
	<?php if ($t_pelatihan_list->SearchColumnCount % $t_pelatihan_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_list->Tahun->Visible) { // Tahun ?>
	<?php
		$t_pelatihan_list->SearchColumnCount++;
		if (($t_pelatihan_list->SearchColumnCount - 1) % $t_pelatihan_list->SearchFieldsPerRow == 0) {
			$t_pelatihan_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_pelatihan_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Tahun" class="ew-cell form-group">
		<label for="x_Tahun" class="ew-search-caption ew-label"><?php echo $t_pelatihan_list->Tahun->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Tahun" id="z_Tahun" value="=">
</span>
		<span id="el_t_pelatihan_Tahun" class="ew-search-field">
<input type="text" data-table="t_pelatihan" data-field="x_Tahun" name="x_Tahun" id="x_Tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pelatihan_list->Tahun->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_list->Tahun->EditValue ?>"<?php echo $t_pelatihan_list->Tahun->editAttributes() ?>>
</span>
	</div>
	<?php if ($t_pelatihan_list->SearchColumnCount % $t_pelatihan_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($t_pelatihan_list->SearchColumnCount % $t_pelatihan_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $t_pelatihan_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_pelatihan_list->showPageHeader(); ?>
<?php
$t_pelatihan_list->showMessage();
?>
<?php if ($t_pelatihan_list->TotalRecords > 0 || $t_pelatihan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_pelatihan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_pelatihan">
<?php if (!$t_pelatihan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_pelatihan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_pelatihan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_pelatihan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_pelatihanlist" id="ft_pelatihanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_pelatihan">
<?php if ($t_pelatihan->getCurrentMasterTable() == "t_judul" && $t_pelatihan->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_judul">
<input type="hidden" name="fk_kdjudul" value="<?php echo HtmlEncode($t_pelatihan_list->kdjudul->getSessionValue()) ?>">
<?php } ?>
<?php if ($t_pelatihan->getCurrentMasterTable() == "t_kota" && $t_pelatihan->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_kota">
<input type="hidden" name="fk_kdkota" value="<?php echo HtmlEncode($t_pelatihan_list->kdkota->getSessionValue()) ?>">
<?php } ?>
<?php if ($t_pelatihan->getCurrentMasterTable() == "t_prop" && $t_pelatihan->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_prop">
<input type="hidden" name="fk_kdprop" value="<?php echo HtmlEncode($t_pelatihan_list->kdprop->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_t_pelatihan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_pelatihan_list->TotalRecords > 0 || $t_pelatihan_list->isGridEdit()) { ?>
<table id="tbl_t_pelatihanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_pelatihan->RowType = ROWTYPE_HEADER;

// Render list options
$t_pelatihan_list->renderListOptions();

// Render list options (header, left)
$t_pelatihan_list->ListOptions->render("header", "left");
?>
<?php if ($t_pelatihan_list->kdjudul->Visible) { // kdjudul ?>
	<?php if ($t_pelatihan_list->SortUrl($t_pelatihan_list->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $t_pelatihan_list->kdjudul->headerCellClass() ?>"><div id="elh_t_pelatihan_kdjudul" class="t_pelatihan_kdjudul"><div class="ew-table-header-caption"><?php echo $t_pelatihan_list->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $t_pelatihan_list->kdjudul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pelatihan_list->SortUrl($t_pelatihan_list->kdjudul) ?>', 1);"><div id="elh_t_pelatihan_kdjudul" class="t_pelatihan_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_list->kdjudul->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_list->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_list->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_list->tawal->Visible) { // tawal ?>
	<?php if ($t_pelatihan_list->SortUrl($t_pelatihan_list->tawal) == "") { ?>
		<th data-name="tawal" class="<?php echo $t_pelatihan_list->tawal->headerCellClass() ?>"><div id="elh_t_pelatihan_tawal" class="t_pelatihan_tawal"><div class="ew-table-header-caption"><?php echo $t_pelatihan_list->tawal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tawal" class="<?php echo $t_pelatihan_list->tawal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pelatihan_list->SortUrl($t_pelatihan_list->tawal) ?>', 1);"><div id="elh_t_pelatihan_tawal" class="t_pelatihan_tawal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_list->tawal->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_list->tawal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_list->tawal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_list->takhir->Visible) { // takhir ?>
	<?php if ($t_pelatihan_list->SortUrl($t_pelatihan_list->takhir) == "") { ?>
		<th data-name="takhir" class="<?php echo $t_pelatihan_list->takhir->headerCellClass() ?>"><div id="elh_t_pelatihan_takhir" class="t_pelatihan_takhir"><div class="ew-table-header-caption"><?php echo $t_pelatihan_list->takhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="takhir" class="<?php echo $t_pelatihan_list->takhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pelatihan_list->SortUrl($t_pelatihan_list->takhir) ?>', 1);"><div id="elh_t_pelatihan_takhir" class="t_pelatihan_takhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_list->takhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_list->takhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_list->takhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_list->tglpel->Visible) { // tglpel ?>
	<?php if ($t_pelatihan_list->SortUrl($t_pelatihan_list->tglpel) == "") { ?>
		<th data-name="tglpel" class="<?php echo $t_pelatihan_list->tglpel->headerCellClass() ?>"><div id="elh_t_pelatihan_tglpel" class="t_pelatihan_tglpel"><div class="ew-table-header-caption"><?php echo $t_pelatihan_list->tglpel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tglpel" class="<?php echo $t_pelatihan_list->tglpel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pelatihan_list->SortUrl($t_pelatihan_list->tglpel) ?>', 1);"><div id="elh_t_pelatihan_tglpel" class="t_pelatihan_tglpel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_list->tglpel->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_list->tglpel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_list->tglpel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_list->jenispel->Visible) { // jenispel ?>
	<?php if ($t_pelatihan_list->SortUrl($t_pelatihan_list->jenispel) == "") { ?>
		<th data-name="jenispel" class="<?php echo $t_pelatihan_list->jenispel->headerCellClass() ?>"><div id="elh_t_pelatihan_jenispel" class="t_pelatihan_jenispel"><div class="ew-table-header-caption"><?php echo $t_pelatihan_list->jenispel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenispel" class="<?php echo $t_pelatihan_list->jenispel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pelatihan_list->SortUrl($t_pelatihan_list->jenispel) ?>', 1);"><div id="elh_t_pelatihan_jenispel" class="t_pelatihan_jenispel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_list->jenispel->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_list->jenispel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_list->jenispel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_list->kerjasama->Visible) { // kerjasama ?>
	<?php if ($t_pelatihan_list->SortUrl($t_pelatihan_list->kerjasama) == "") { ?>
		<th data-name="kerjasama" class="<?php echo $t_pelatihan_list->kerjasama->headerCellClass() ?>"><div id="elh_t_pelatihan_kerjasama" class="t_pelatihan_kerjasama"><div class="ew-table-header-caption"><?php echo $t_pelatihan_list->kerjasama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kerjasama" class="<?php echo $t_pelatihan_list->kerjasama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pelatihan_list->SortUrl($t_pelatihan_list->kerjasama) ?>', 1);"><div id="elh_t_pelatihan_kerjasama" class="t_pelatihan_kerjasama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_list->kerjasama->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_list->kerjasama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_list->kerjasama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_list->biaya->Visible) { // biaya ?>
	<?php if ($t_pelatihan_list->SortUrl($t_pelatihan_list->biaya) == "") { ?>
		<th data-name="biaya" class="<?php echo $t_pelatihan_list->biaya->headerCellClass() ?>"><div id="elh_t_pelatihan_biaya" class="t_pelatihan_biaya"><div class="ew-table-header-caption"><?php echo $t_pelatihan_list->biaya->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="biaya" class="<?php echo $t_pelatihan_list->biaya->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pelatihan_list->SortUrl($t_pelatihan_list->biaya) ?>', 1);"><div id="elh_t_pelatihan_biaya" class="t_pelatihan_biaya">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_list->biaya->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_list->biaya->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_list->biaya->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_list->coachingprogr->Visible) { // coachingprogr ?>
	<?php if ($t_pelatihan_list->SortUrl($t_pelatihan_list->coachingprogr) == "") { ?>
		<th data-name="coachingprogr" class="<?php echo $t_pelatihan_list->coachingprogr->headerCellClass() ?>"><div id="elh_t_pelatihan_coachingprogr" class="t_pelatihan_coachingprogr"><div class="ew-table-header-caption"><?php echo $t_pelatihan_list->coachingprogr->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="coachingprogr" class="<?php echo $t_pelatihan_list->coachingprogr->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pelatihan_list->SortUrl($t_pelatihan_list->coachingprogr) ?>', 1);"><div id="elh_t_pelatihan_coachingprogr" class="t_pelatihan_coachingprogr">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_list->coachingprogr->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_list->coachingprogr->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_list->coachingprogr->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_list->area->Visible) { // area ?>
	<?php if ($t_pelatihan_list->SortUrl($t_pelatihan_list->area) == "") { ?>
		<th data-name="area" class="<?php echo $t_pelatihan_list->area->headerCellClass() ?>"><div id="elh_t_pelatihan_area" class="t_pelatihan_area"><div class="ew-table-header-caption"><?php echo $t_pelatihan_list->area->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="area" class="<?php echo $t_pelatihan_list->area->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pelatihan_list->SortUrl($t_pelatihan_list->area) ?>', 1);"><div id="elh_t_pelatihan_area" class="t_pelatihan_area">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_list->area->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_list->area->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_list->area->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_list->periode_awal->Visible) { // periode_awal ?>
	<?php if ($t_pelatihan_list->SortUrl($t_pelatihan_list->periode_awal) == "") { ?>
		<th data-name="periode_awal" class="<?php echo $t_pelatihan_list->periode_awal->headerCellClass() ?>"><div id="elh_t_pelatihan_periode_awal" class="t_pelatihan_periode_awal"><div class="ew-table-header-caption"><?php echo $t_pelatihan_list->periode_awal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="periode_awal" class="<?php echo $t_pelatihan_list->periode_awal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pelatihan_list->SortUrl($t_pelatihan_list->periode_awal) ?>', 1);"><div id="elh_t_pelatihan_periode_awal" class="t_pelatihan_periode_awal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_list->periode_awal->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_list->periode_awal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_list->periode_awal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_list->periode_akhir->Visible) { // periode_akhir ?>
	<?php if ($t_pelatihan_list->SortUrl($t_pelatihan_list->periode_akhir) == "") { ?>
		<th data-name="periode_akhir" class="<?php echo $t_pelatihan_list->periode_akhir->headerCellClass() ?>"><div id="elh_t_pelatihan_periode_akhir" class="t_pelatihan_periode_akhir"><div class="ew-table-header-caption"><?php echo $t_pelatihan_list->periode_akhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="periode_akhir" class="<?php echo $t_pelatihan_list->periode_akhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pelatihan_list->SortUrl($t_pelatihan_list->periode_akhir) ?>', 1);"><div id="elh_t_pelatihan_periode_akhir" class="t_pelatihan_periode_akhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_list->periode_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_list->periode_akhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_list->periode_akhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_list->tahapan->Visible) { // tahapan ?>
	<?php if ($t_pelatihan_list->SortUrl($t_pelatihan_list->tahapan) == "") { ?>
		<th data-name="tahapan" class="<?php echo $t_pelatihan_list->tahapan->headerCellClass() ?>"><div id="elh_t_pelatihan_tahapan" class="t_pelatihan_tahapan"><div class="ew-table-header-caption"><?php echo $t_pelatihan_list->tahapan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahapan" class="<?php echo $t_pelatihan_list->tahapan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pelatihan_list->SortUrl($t_pelatihan_list->tahapan) ?>', 1);"><div id="elh_t_pelatihan_tahapan" class="t_pelatihan_tahapan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_list->tahapan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_list->tahapan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_list->tahapan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_list->namaberkas->Visible) { // namaberkas ?>
	<?php if ($t_pelatihan_list->SortUrl($t_pelatihan_list->namaberkas) == "") { ?>
		<th data-name="namaberkas" class="<?php echo $t_pelatihan_list->namaberkas->headerCellClass() ?>"><div id="elh_t_pelatihan_namaberkas" class="t_pelatihan_namaberkas"><div class="ew-table-header-caption"><?php echo $t_pelatihan_list->namaberkas->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="namaberkas" class="<?php echo $t_pelatihan_list->namaberkas->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pelatihan_list->SortUrl($t_pelatihan_list->namaberkas) ?>', 1);"><div id="elh_t_pelatihan_namaberkas" class="t_pelatihan_namaberkas">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_list->namaberkas->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_list->namaberkas->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_list->namaberkas->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_list->instruktur->Visible) { // instruktur ?>
	<?php if ($t_pelatihan_list->SortUrl($t_pelatihan_list->instruktur) == "") { ?>
		<th data-name="instruktur" class="<?php echo $t_pelatihan_list->instruktur->headerCellClass() ?>"><div id="elh_t_pelatihan_instruktur" class="t_pelatihan_instruktur"><div class="ew-table-header-caption"><?php echo $t_pelatihan_list->instruktur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="instruktur" class="<?php echo $t_pelatihan_list->instruktur->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pelatihan_list->SortUrl($t_pelatihan_list->instruktur) ?>', 1);"><div id="elh_t_pelatihan_instruktur" class="t_pelatihan_instruktur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_list->instruktur->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_list->instruktur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_list->instruktur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_list->tempat->Visible) { // tempat ?>
	<?php if ($t_pelatihan_list->SortUrl($t_pelatihan_list->tempat) == "") { ?>
		<th data-name="tempat" class="<?php echo $t_pelatihan_list->tempat->headerCellClass() ?>"><div id="elh_t_pelatihan_tempat" class="t_pelatihan_tempat"><div class="ew-table-header-caption"><?php echo $t_pelatihan_list->tempat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tempat" class="<?php echo $t_pelatihan_list->tempat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pelatihan_list->SortUrl($t_pelatihan_list->tempat) ?>', 1);"><div id="elh_t_pelatihan_tempat" class="t_pelatihan_tempat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_list->tempat->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_list->tempat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_list->tempat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_list->jpeserta->Visible) { // jpeserta ?>
	<?php if ($t_pelatihan_list->SortUrl($t_pelatihan_list->jpeserta) == "") { ?>
		<th data-name="jpeserta" class="<?php echo $t_pelatihan_list->jpeserta->headerCellClass() ?>"><div id="elh_t_pelatihan_jpeserta" class="t_pelatihan_jpeserta"><div class="ew-table-header-caption"><?php echo $t_pelatihan_list->jpeserta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jpeserta" class="<?php echo $t_pelatihan_list->jpeserta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pelatihan_list->SortUrl($t_pelatihan_list->jpeserta) ?>', 1);"><div id="elh_t_pelatihan_jpeserta" class="t_pelatihan_jpeserta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_list->jpeserta->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_list->jpeserta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_list->jpeserta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_list->targetpes->Visible) { // targetpes ?>
	<?php if ($t_pelatihan_list->SortUrl($t_pelatihan_list->targetpes) == "") { ?>
		<th data-name="targetpes" class="<?php echo $t_pelatihan_list->targetpes->headerCellClass() ?>"><div id="elh_t_pelatihan_targetpes" class="t_pelatihan_targetpes"><div class="ew-table-header-caption"><?php echo $t_pelatihan_list->targetpes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes" class="<?php echo $t_pelatihan_list->targetpes->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pelatihan_list->SortUrl($t_pelatihan_list->targetpes) ?>', 1);"><div id="elh_t_pelatihan_targetpes" class="t_pelatihan_targetpes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_list->targetpes->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_list->targetpes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_list->targetpes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pelatihan_list->Tahun->Visible) { // Tahun ?>
	<?php if ($t_pelatihan_list->SortUrl($t_pelatihan_list->Tahun) == "") { ?>
		<th data-name="Tahun" class="<?php echo $t_pelatihan_list->Tahun->headerCellClass() ?>"><div id="elh_t_pelatihan_Tahun" class="t_pelatihan_Tahun"><div class="ew-table-header-caption"><?php echo $t_pelatihan_list->Tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tahun" class="<?php echo $t_pelatihan_list->Tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pelatihan_list->SortUrl($t_pelatihan_list->Tahun) ?>', 1);"><div id="elh_t_pelatihan_Tahun" class="t_pelatihan_Tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pelatihan_list->Tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pelatihan_list->Tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pelatihan_list->Tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_pelatihan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_pelatihan_list->ExportAll && $t_pelatihan_list->isExport()) {
	$t_pelatihan_list->StopRecord = $t_pelatihan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_pelatihan_list->TotalRecords > $t_pelatihan_list->StartRecord + $t_pelatihan_list->DisplayRecords - 1)
		$t_pelatihan_list->StopRecord = $t_pelatihan_list->StartRecord + $t_pelatihan_list->DisplayRecords - 1;
	else
		$t_pelatihan_list->StopRecord = $t_pelatihan_list->TotalRecords;
}
$t_pelatihan_list->RecordCount = $t_pelatihan_list->StartRecord - 1;
if ($t_pelatihan_list->Recordset && !$t_pelatihan_list->Recordset->EOF) {
	$t_pelatihan_list->Recordset->moveFirst();
	$selectLimit = $t_pelatihan_list->UseSelectLimit;
	if (!$selectLimit && $t_pelatihan_list->StartRecord > 1)
		$t_pelatihan_list->Recordset->move($t_pelatihan_list->StartRecord - 1);
} elseif (!$t_pelatihan->AllowAddDeleteRow && $t_pelatihan_list->StopRecord == 0) {
	$t_pelatihan_list->StopRecord = $t_pelatihan->GridAddRowCount;
}

// Initialize aggregate
$t_pelatihan->RowType = ROWTYPE_AGGREGATEINIT;
$t_pelatihan->resetAttributes();
$t_pelatihan_list->renderRow();
while ($t_pelatihan_list->RecordCount < $t_pelatihan_list->StopRecord) {
	$t_pelatihan_list->RecordCount++;
	if ($t_pelatihan_list->RecordCount >= $t_pelatihan_list->StartRecord) {
		$t_pelatihan_list->RowCount++;

		// Set up key count
		$t_pelatihan_list->KeyCount = $t_pelatihan_list->RowIndex;

		// Init row class and style
		$t_pelatihan->resetAttributes();
		$t_pelatihan->CssClass = "";
		if ($t_pelatihan_list->isGridAdd()) {
		} else {
			$t_pelatihan_list->loadRowValues($t_pelatihan_list->Recordset); // Load row values
		}
		$t_pelatihan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_pelatihan->RowAttrs->merge(["data-rowindex" => $t_pelatihan_list->RowCount, "id" => "r" . $t_pelatihan_list->RowCount . "_t_pelatihan", "data-rowtype" => $t_pelatihan->RowType]);

		// Render row
		$t_pelatihan_list->renderRow();

		// Render list options
		$t_pelatihan_list->renderListOptions();
?>
	<tr <?php echo $t_pelatihan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_pelatihan_list->ListOptions->render("body", "left", $t_pelatihan_list->RowCount);
?>
	<?php if ($t_pelatihan_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $t_pelatihan_list->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_list->RowCount ?>_t_pelatihan_kdjudul">
<span<?php echo $t_pelatihan_list->kdjudul->viewAttributes() ?>><?php echo $t_pelatihan_list->kdjudul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_list->tawal->Visible) { // tawal ?>
		<td data-name="tawal" <?php echo $t_pelatihan_list->tawal->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_list->RowCount ?>_t_pelatihan_tawal">
<span<?php echo $t_pelatihan_list->tawal->viewAttributes() ?>><?php echo $t_pelatihan_list->tawal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_list->takhir->Visible) { // takhir ?>
		<td data-name="takhir" <?php echo $t_pelatihan_list->takhir->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_list->RowCount ?>_t_pelatihan_takhir">
<span<?php echo $t_pelatihan_list->takhir->viewAttributes() ?>><?php echo $t_pelatihan_list->takhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_list->tglpel->Visible) { // tglpel ?>
		<td data-name="tglpel" <?php echo $t_pelatihan_list->tglpel->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_list->RowCount ?>_t_pelatihan_tglpel">
<span<?php echo $t_pelatihan_list->tglpel->viewAttributes() ?>><?php echo $t_pelatihan_list->tglpel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_list->jenispel->Visible) { // jenispel ?>
		<td data-name="jenispel" <?php echo $t_pelatihan_list->jenispel->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_list->RowCount ?>_t_pelatihan_jenispel">
<span<?php echo $t_pelatihan_list->jenispel->viewAttributes() ?>><?php echo $t_pelatihan_list->jenispel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_list->kerjasama->Visible) { // kerjasama ?>
		<td data-name="kerjasama" <?php echo $t_pelatihan_list->kerjasama->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_list->RowCount ?>_t_pelatihan_kerjasama">
<span<?php echo $t_pelatihan_list->kerjasama->viewAttributes() ?>><?php echo $t_pelatihan_list->kerjasama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_list->biaya->Visible) { // biaya ?>
		<td data-name="biaya" <?php echo $t_pelatihan_list->biaya->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_list->RowCount ?>_t_pelatihan_biaya">
<span<?php echo $t_pelatihan_list->biaya->viewAttributes() ?>><?php echo $t_pelatihan_list->biaya->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_list->coachingprogr->Visible) { // coachingprogr ?>
		<td data-name="coachingprogr" <?php echo $t_pelatihan_list->coachingprogr->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_list->RowCount ?>_t_pelatihan_coachingprogr">
<span<?php echo $t_pelatihan_list->coachingprogr->viewAttributes() ?>><?php echo $t_pelatihan_list->coachingprogr->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_list->area->Visible) { // area ?>
		<td data-name="area" <?php echo $t_pelatihan_list->area->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_list->RowCount ?>_t_pelatihan_area">
<span<?php echo $t_pelatihan_list->area->viewAttributes() ?>><?php echo $t_pelatihan_list->area->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_list->periode_awal->Visible) { // periode_awal ?>
		<td data-name="periode_awal" <?php echo $t_pelatihan_list->periode_awal->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_list->RowCount ?>_t_pelatihan_periode_awal">
<span<?php echo $t_pelatihan_list->periode_awal->viewAttributes() ?>><?php echo $t_pelatihan_list->periode_awal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_list->periode_akhir->Visible) { // periode_akhir ?>
		<td data-name="periode_akhir" <?php echo $t_pelatihan_list->periode_akhir->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_list->RowCount ?>_t_pelatihan_periode_akhir">
<span<?php echo $t_pelatihan_list->periode_akhir->viewAttributes() ?>><?php echo $t_pelatihan_list->periode_akhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_list->tahapan->Visible) { // tahapan ?>
		<td data-name="tahapan" <?php echo $t_pelatihan_list->tahapan->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_list->RowCount ?>_t_pelatihan_tahapan">
<span<?php echo $t_pelatihan_list->tahapan->viewAttributes() ?>><?php echo $t_pelatihan_list->tahapan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_list->namaberkas->Visible) { // namaberkas ?>
		<td data-name="namaberkas" <?php echo $t_pelatihan_list->namaberkas->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_list->RowCount ?>_t_pelatihan_namaberkas">
<span<?php echo $t_pelatihan_list->namaberkas->viewAttributes() ?>><?php echo GetFileViewTag($t_pelatihan_list->namaberkas, $t_pelatihan_list->namaberkas->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_list->instruktur->Visible) { // instruktur ?>
		<td data-name="instruktur" <?php echo $t_pelatihan_list->instruktur->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_list->RowCount ?>_t_pelatihan_instruktur">
<span<?php echo $t_pelatihan_list->instruktur->viewAttributes() ?>><?php echo $t_pelatihan_list->instruktur->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_list->tempat->Visible) { // tempat ?>
		<td data-name="tempat" <?php echo $t_pelatihan_list->tempat->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_list->RowCount ?>_t_pelatihan_tempat">
<span<?php echo $t_pelatihan_list->tempat->viewAttributes() ?>><?php echo $t_pelatihan_list->tempat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_list->jpeserta->Visible) { // jpeserta ?>
		<td data-name="jpeserta" <?php echo $t_pelatihan_list->jpeserta->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_list->RowCount ?>_t_pelatihan_jpeserta">
<span<?php echo $t_pelatihan_list->jpeserta->viewAttributes() ?>><?php echo $t_pelatihan_list->jpeserta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_list->targetpes->Visible) { // targetpes ?>
		<td data-name="targetpes" <?php echo $t_pelatihan_list->targetpes->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_list->RowCount ?>_t_pelatihan_targetpes">
<span<?php echo $t_pelatihan_list->targetpes->viewAttributes() ?>><?php echo $t_pelatihan_list->targetpes->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pelatihan_list->Tahun->Visible) { // Tahun ?>
		<td data-name="Tahun" <?php echo $t_pelatihan_list->Tahun->cellAttributes() ?>>
<span id="el<?php echo $t_pelatihan_list->RowCount ?>_t_pelatihan_Tahun">
<span<?php echo $t_pelatihan_list->Tahun->viewAttributes() ?>><?php echo $t_pelatihan_list->Tahun->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_pelatihan_list->ListOptions->render("body", "right", $t_pelatihan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_pelatihan_list->isGridAdd())
		$t_pelatihan_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$t_pelatihan->RowType = ROWTYPE_AGGREGATE;
$t_pelatihan->resetAttributes();
$t_pelatihan_list->renderRow();
?>
<?php if ($t_pelatihan_list->TotalRecords > 0 && !$t_pelatihan_list->isGridAdd() && !$t_pelatihan_list->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$t_pelatihan_list->renderListOptions();

// Render list options (footer, left)
$t_pelatihan_list->ListOptions->render("footer", "left");
?>
	<?php if ($t_pelatihan_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" class="<?php echo $t_pelatihan_list->kdjudul->footerCellClass() ?>"><span id="elf_t_pelatihan_kdjudul" class="t_pelatihan_kdjudul">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_list->tawal->Visible) { // tawal ?>
		<td data-name="tawal" class="<?php echo $t_pelatihan_list->tawal->footerCellClass() ?>"><span id="elf_t_pelatihan_tawal" class="t_pelatihan_tawal">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_list->takhir->Visible) { // takhir ?>
		<td data-name="takhir" class="<?php echo $t_pelatihan_list->takhir->footerCellClass() ?>"><span id="elf_t_pelatihan_takhir" class="t_pelatihan_takhir">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_list->tglpel->Visible) { // tglpel ?>
		<td data-name="tglpel" class="<?php echo $t_pelatihan_list->tglpel->footerCellClass() ?>"><span id="elf_t_pelatihan_tglpel" class="t_pelatihan_tglpel">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_list->jenispel->Visible) { // jenispel ?>
		<td data-name="jenispel" class="<?php echo $t_pelatihan_list->jenispel->footerCellClass() ?>"><span id="elf_t_pelatihan_jenispel" class="t_pelatihan_jenispel">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_list->kerjasama->Visible) { // kerjasama ?>
		<td data-name="kerjasama" class="<?php echo $t_pelatihan_list->kerjasama->footerCellClass() ?>"><span id="elf_t_pelatihan_kerjasama" class="t_pelatihan_kerjasama">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_list->biaya->Visible) { // biaya ?>
		<td data-name="biaya" class="<?php echo $t_pelatihan_list->biaya->footerCellClass() ?>"><span id="elf_t_pelatihan_biaya" class="t_pelatihan_biaya">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_list->coachingprogr->Visible) { // coachingprogr ?>
		<td data-name="coachingprogr" class="<?php echo $t_pelatihan_list->coachingprogr->footerCellClass() ?>"><span id="elf_t_pelatihan_coachingprogr" class="t_pelatihan_coachingprogr">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_list->area->Visible) { // area ?>
		<td data-name="area" class="<?php echo $t_pelatihan_list->area->footerCellClass() ?>"><span id="elf_t_pelatihan_area" class="t_pelatihan_area">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_list->periode_awal->Visible) { // periode_awal ?>
		<td data-name="periode_awal" class="<?php echo $t_pelatihan_list->periode_awal->footerCellClass() ?>"><span id="elf_t_pelatihan_periode_awal" class="t_pelatihan_periode_awal">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_list->periode_akhir->Visible) { // periode_akhir ?>
		<td data-name="periode_akhir" class="<?php echo $t_pelatihan_list->periode_akhir->footerCellClass() ?>"><span id="elf_t_pelatihan_periode_akhir" class="t_pelatihan_periode_akhir">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_list->tahapan->Visible) { // tahapan ?>
		<td data-name="tahapan" class="<?php echo $t_pelatihan_list->tahapan->footerCellClass() ?>"><span id="elf_t_pelatihan_tahapan" class="t_pelatihan_tahapan">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_list->namaberkas->Visible) { // namaberkas ?>
		<td data-name="namaberkas" class="<?php echo $t_pelatihan_list->namaberkas->footerCellClass() ?>"><span id="elf_t_pelatihan_namaberkas" class="t_pelatihan_namaberkas">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_list->instruktur->Visible) { // instruktur ?>
		<td data-name="instruktur" class="<?php echo $t_pelatihan_list->instruktur->footerCellClass() ?>"><span id="elf_t_pelatihan_instruktur" class="t_pelatihan_instruktur">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_list->tempat->Visible) { // tempat ?>
		<td data-name="tempat" class="<?php echo $t_pelatihan_list->tempat->footerCellClass() ?>"><span id="elf_t_pelatihan_tempat" class="t_pelatihan_tempat">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_list->jpeserta->Visible) { // jpeserta ?>
		<td data-name="jpeserta" class="<?php echo $t_pelatihan_list->jpeserta->footerCellClass() ?>"><span id="elf_t_pelatihan_jpeserta" class="t_pelatihan_jpeserta">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $t_pelatihan_list->jpeserta->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_list->targetpes->Visible) { // targetpes ?>
		<td data-name="targetpes" class="<?php echo $t_pelatihan_list->targetpes->footerCellClass() ?>"><span id="elf_t_pelatihan_targetpes" class="t_pelatihan_targetpes">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $t_pelatihan_list->targetpes->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($t_pelatihan_list->Tahun->Visible) { // Tahun ?>
		<td data-name="Tahun" class="<?php echo $t_pelatihan_list->Tahun->footerCellClass() ?>"><span id="elf_t_pelatihan_Tahun" class="t_pelatihan_Tahun">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$t_pelatihan_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_pelatihan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_pelatihan_list->Recordset)
	$t_pelatihan_list->Recordset->Close();
?>
<?php if (!$t_pelatihan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_pelatihan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_pelatihan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_pelatihan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_pelatihan_list->TotalRecords == 0 && !$t_pelatihan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_pelatihan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_pelatihan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_pelatihan_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// document.write("page loaded");

	$('.ew-detail-add').hide();
	<?php if(isset($_GET["pegid"]) && !empty($_GET["pegid"])){ ?>
		$('.ew-ext-search-form').hide();
		$('.ew-search-option').hide();
		$('.ew-filter-option').hide();
	<?php } ?>
});
</script>
<?php if (!$t_pelatihan->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_t_pelatihan",
		width: "100%",
		height: "350px"
	});
});
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$t_pelatihan_list->terminate();
?>