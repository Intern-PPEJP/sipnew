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
$t_perusahaan_list = new t_perusahaan_list();

// Run the page
$t_perusahaan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_perusahaan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_perusahaan_list->isExport()) { ?>
<script>
var ft_perusahaanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_perusahaanlist = currentForm = new ew.Form("ft_perusahaanlist", "list");
	ft_perusahaanlist.formKeyCountName = '<?php echo $t_perusahaan_list->FormKeyCountName ?>';
	loadjs.done("ft_perusahaanlist");
});
var ft_perusahaanlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_perusahaanlistsrch = currentSearchForm = new ew.Form("ft_perusahaanlistsrch");

	// Validate function for search
	ft_perusahaanlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_idp");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_perusahaan_list->idp->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	ft_perusahaanlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_perusahaanlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_perusahaanlistsrch.lists["x_idp"] = <?php echo $t_perusahaan_list->idp->Lookup->toClientList($t_perusahaan_list) ?>;
	ft_perusahaanlistsrch.lists["x_idp"].options = <?php echo JsonEncode($t_perusahaan_list->idp->lookupOptions()) ?>;
	ft_perusahaanlistsrch.autoSuggests["x_idp"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

	// Filters
	ft_perusahaanlistsrch.filterList = <?php echo $t_perusahaan_list->getFilterList() ?>;
	loadjs.done("ft_perusahaanlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	////document.write('<?php echo cs_judul("list","Daftar Perusahaan");?>');

});
</script>
<?php } ?>
<?php if (!$t_perusahaan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_perusahaan_list->TotalRecords > 0 && $t_perusahaan_list->ExportOptions->visible()) { ?>
<?php $t_perusahaan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_perusahaan_list->ImportOptions->visible()) { ?>
<?php $t_perusahaan_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_perusahaan_list->SearchOptions->visible()) { ?>
<?php $t_perusahaan_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_perusahaan_list->FilterOptions->visible()) { ?>
<?php $t_perusahaan_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>

<?php
$t_perusahaan_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_perusahaan_list->isExport() && !$t_perusahaan->CurrentAction) { ?>

<form name="ft_perusahaanlistsrch" id="ft_perusahaanlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_perusahaanlistsrch-search-panel" class="<?php echo $t_perusahaan_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_perusahaan">
	<div class="ew-extended-search">
<?php

// Render search row
$t_perusahaan->RowType = ROWTYPE_SEARCH;
$t_perusahaan->resetAttributes();
$t_perusahaan_list->renderRow();
?>

<style>
	.ew-cell {
    display: flex;
    align-items: left; /* Untuk menyejajarkan label dan input secara vertikal */
    margin-bottom: 10px; /* Tambahkan margin antar elemen */
}

.ew-search-caption {
    width: 110px; /* Atur lebar label agar seragam */
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

<?php if ($t_perusahaan_list->idp->Visible) { // idp ?>
	<?php
		$t_perusahaan_list->SearchColumnCount++;
		if (($t_perusahaan_list->SearchColumnCount - 1) % $t_perusahaan_list->SearchFieldsPerRow == 0) {
			$t_perusahaan_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_perusahaan_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_idp" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $t_perusahaan_list->idp->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_idp" id="z_idp" value="=">
</span>
		<span id="el_t_perusahaan_idp" class="ew-search-field">
<?php
$onchange = $t_perusahaan_list->idp->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_perusahaan_list->idp->EditAttrs["onchange"] = "";
?>
<span id="as_x_idp">
	<input type="text" class="form-control" name="sv_x_idp" id="sv_x_idp" value="<?php echo RemoveHtml($t_perusahaan_list->idp->EditValue) ?>" size="50" maxlength="25" placeholder="<?php echo HtmlEncode($t_perusahaan_list->idp->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_perusahaan_list->idp->getPlaceHolder()) ?>"<?php echo $t_perusahaan_list->idp->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_perusahaan" data-field="x_idp" data-value-separator="<?php echo $t_perusahaan_list->idp->displayValueSeparatorAttribute() ?>" name="x_idp" id="x_idp" value="<?php echo HtmlEncode($t_perusahaan_list->idp->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_perusahaanlistsrch"], function() {
	ft_perusahaanlistsrch.createAutoSuggest({"id":"x_idp","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_perusahaan_list->idp->Lookup->getParamTag($t_perusahaan_list, "p_x_idp") ?>
</span>
	</div>
	<?php if ($t_perusahaan_list->SearchColumnCount % $t_perusahaan_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($t_perusahaan_list->SearchColumnCount % $t_perusahaan_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $t_perusahaan_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_perusahaan_list->showPageHeader(); ?>
<?php
$t_perusahaan_list->showMessage();
?>
<?php if ($t_perusahaan_list->TotalRecords > 0 || $t_perusahaan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_perusahaan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_perusahaan">
<?php if (!$t_perusahaan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_perusahaan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_perusahaan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_perusahaan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_perusahaanlist" id="ft_perusahaanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_perusahaan">
<div id="gmp_t_perusahaan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_perusahaan_list->TotalRecords > 0 || $t_perusahaan_list->isGridEdit()) { ?>
<table id="tbl_t_perusahaanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_perusahaan->RowType = ROWTYPE_HEADER;

// Render list options
$t_perusahaan_list->renderListOptions();

// Render list options (header, left)
$t_perusahaan_list->ListOptions->render("header", "left");
?>
<?php if ($t_perusahaan_list->namap->Visible) { // namap ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->namap) == "") { ?>
		<th data-name="namap" class="<?php echo $t_perusahaan_list->namap->headerCellClass() ?>"><div id="elh_t_perusahaan_namap" class="t_perusahaan_namap"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->namap->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="namap" class="<?php echo $t_perusahaan_list->namap->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->namap) ?>', 1);"><div id="elh_t_perusahaan_namap" class="t_perusahaan_namap">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->namap->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->namap->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->namap->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_perusahaan_list->idp->Visible) { // idp ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->idp) == "") { ?>
		<th data-name="idp" class="<?php echo $t_perusahaan_list->idp->headerCellClass() ?>"><div id="elh_t_perusahaan_idp" class="t_perusahaan_idp"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->idp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idp" class="<?php echo $t_perusahaan_list->idp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->idp) ?>', 1);"><div id="elh_t_perusahaan_idp" class="t_perusahaan_idp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->idp->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->idp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->idp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_perusahaan_list->kontak->Visible) { // kontak ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->kontak) == "") { ?>
		<th data-name="kontak" class="<?php echo $t_perusahaan_list->kontak->headerCellClass() ?>"><div id="elh_t_perusahaan_kontak" class="t_perusahaan_kontak"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->kontak->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kontak" class="<?php echo $t_perusahaan_list->kontak->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->kontak) ?>', 1);"><div id="elh_t_perusahaan_kontak" class="t_perusahaan_kontak">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->kontak->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->kontak->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->kontak->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_perusahaan_list->kdlokasi->Visible) { // kdlokasi ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->kdlokasi) == "") { ?>
		<th data-name="kdlokasi" class="<?php echo $t_perusahaan_list->kdlokasi->headerCellClass() ?>"><div id="elh_t_perusahaan_kdlokasi" class="t_perusahaan_kdlokasi"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->kdlokasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdlokasi" class="<?php echo $t_perusahaan_list->kdlokasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->kdlokasi) ?>', 1);"><div id="elh_t_perusahaan_kdlokasi" class="t_perusahaan_kdlokasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->kdlokasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->kdlokasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->kdlokasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_perusahaan_list->kdprop->Visible) { // kdprop ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->kdprop) == "") { ?>
		<th data-name="kdprop" class="<?php echo $t_perusahaan_list->kdprop->headerCellClass() ?>"><div id="elh_t_perusahaan_kdprop" class="t_perusahaan_kdprop"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->kdprop->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdprop" class="<?php echo $t_perusahaan_list->kdprop->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->kdprop) ?>', 1);"><div id="elh_t_perusahaan_kdprop" class="t_perusahaan_kdprop">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->kdprop->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->kdprop->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->kdprop->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_perusahaan_list->kdkota->Visible) { // kdkota ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->kdkota) == "") { ?>
		<th data-name="kdkota" class="<?php echo $t_perusahaan_list->kdkota->headerCellClass() ?>"><div id="elh_t_perusahaan_kdkota" class="t_perusahaan_kdkota"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->kdkota->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkota" class="<?php echo $t_perusahaan_list->kdkota->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->kdkota) ?>', 1);"><div id="elh_t_perusahaan_kdkota" class="t_perusahaan_kdkota">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->kdkota->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->kdkota->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->kdkota->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_perusahaan_list->kdkec->Visible) { // kdkec ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->kdkec) == "") { ?>
		<th data-name="kdkec" class="<?php echo $t_perusahaan_list->kdkec->headerCellClass() ?>"><div id="elh_t_perusahaan_kdkec" class="t_perusahaan_kdkec"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->kdkec->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkec" class="<?php echo $t_perusahaan_list->kdkec->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->kdkec) ?>', 1);"><div id="elh_t_perusahaan_kdkec" class="t_perusahaan_kdkec">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->kdkec->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->kdkec->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->kdkec->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_perusahaan_list->alamatp->Visible) { // alamatp ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->alamatp) == "") { ?>
		<th data-name="alamatp" class="<?php echo $t_perusahaan_list->alamatp->headerCellClass() ?>"><div id="elh_t_perusahaan_alamatp" class="t_perusahaan_alamatp"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->alamatp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="alamatp" class="<?php echo $t_perusahaan_list->alamatp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->alamatp) ?>', 1);"><div id="elh_t_perusahaan_alamatp" class="t_perusahaan_alamatp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->alamatp->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->alamatp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->alamatp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_perusahaan_list->telpp->Visible) { // telpp ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->telpp) == "") { ?>
		<th data-name="telpp" class="<?php echo $t_perusahaan_list->telpp->headerCellClass() ?>"><div id="elh_t_perusahaan_telpp" class="t_perusahaan_telpp"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->telpp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telpp" class="<?php echo $t_perusahaan_list->telpp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->telpp) ?>', 1);"><div id="elh_t_perusahaan_telpp" class="t_perusahaan_telpp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->telpp->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->telpp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->telpp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_perusahaan_list->faxp->Visible) { // faxp ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->faxp) == "") { ?>
		<th data-name="faxp" class="<?php echo $t_perusahaan_list->faxp->headerCellClass() ?>"><div id="elh_t_perusahaan_faxp" class="t_perusahaan_faxp"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->faxp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="faxp" class="<?php echo $t_perusahaan_list->faxp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->faxp) ?>', 1);"><div id="elh_t_perusahaan_faxp" class="t_perusahaan_faxp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->faxp->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->faxp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->faxp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_perusahaan_list->emailp->Visible) { // emailp ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->emailp) == "") { ?>
		<th data-name="emailp" class="<?php echo $t_perusahaan_list->emailp->headerCellClass() ?>"><div id="elh_t_perusahaan_emailp" class="t_perusahaan_emailp"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->emailp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="emailp" class="<?php echo $t_perusahaan_list->emailp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->emailp) ?>', 1);"><div id="elh_t_perusahaan_emailp" class="t_perusahaan_emailp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->emailp->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->emailp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->emailp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_perusahaan_list->webp->Visible) { // webp ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->webp) == "") { ?>
		<th data-name="webp" class="<?php echo $t_perusahaan_list->webp->headerCellClass() ?>"><div id="elh_t_perusahaan_webp" class="t_perusahaan_webp"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->webp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="webp" class="<?php echo $t_perusahaan_list->webp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->webp) ?>', 1);"><div id="elh_t_perusahaan_webp" class="t_perusahaan_webp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->webp->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->webp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->webp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_perusahaan_list->medsos->Visible) { // medsos ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->medsos) == "") { ?>
		<th data-name="medsos" class="<?php echo $t_perusahaan_list->medsos->headerCellClass() ?>"><div id="elh_t_perusahaan_medsos" class="t_perusahaan_medsos"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->medsos->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="medsos" class="<?php echo $t_perusahaan_list->medsos->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->medsos) ?>', 1);"><div id="elh_t_perusahaan_medsos" class="t_perusahaan_medsos">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->medsos->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->medsos->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->medsos->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_perusahaan_list->kdjenis->Visible) { // kdjenis ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->kdjenis) == "") { ?>
		<th data-name="kdjenis" class="<?php echo $t_perusahaan_list->kdjenis->headerCellClass() ?>"><div id="elh_t_perusahaan_kdjenis" class="t_perusahaan_kdjenis"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->kdjenis->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjenis" class="<?php echo $t_perusahaan_list->kdjenis->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->kdjenis) ?>', 1);"><div id="elh_t_perusahaan_kdjenis" class="t_perusahaan_kdjenis">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->kdjenis->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->kdjenis->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->kdjenis->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_perusahaan_list->kdproduknafed->Visible) { // kdproduknafed ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->kdproduknafed) == "") { ?>
		<th data-name="kdproduknafed" class="<?php echo $t_perusahaan_list->kdproduknafed->headerCellClass() ?>"><div id="elh_t_perusahaan_kdproduknafed" class="t_perusahaan_kdproduknafed"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->kdproduknafed->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdproduknafed" class="<?php echo $t_perusahaan_list->kdproduknafed->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->kdproduknafed) ?>', 1);"><div id="elh_t_perusahaan_kdproduknafed" class="t_perusahaan_kdproduknafed">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->kdproduknafed->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->kdproduknafed->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->kdproduknafed->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_perusahaan_list->kdproduknafed2->Visible) { // kdproduknafed2 ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->kdproduknafed2) == "") { ?>
		<th data-name="kdproduknafed2" class="<?php echo $t_perusahaan_list->kdproduknafed2->headerCellClass() ?>"><div id="elh_t_perusahaan_kdproduknafed2" class="t_perusahaan_kdproduknafed2"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->kdproduknafed2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdproduknafed2" class="<?php echo $t_perusahaan_list->kdproduknafed2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->kdproduknafed2) ?>', 1);"><div id="elh_t_perusahaan_kdproduknafed2" class="t_perusahaan_kdproduknafed2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->kdproduknafed2->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->kdproduknafed2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->kdproduknafed2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_perusahaan_list->kdproduknafed3->Visible) { // kdproduknafed3 ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->kdproduknafed3) == "") { ?>
		<th data-name="kdproduknafed3" class="<?php echo $t_perusahaan_list->kdproduknafed3->headerCellClass() ?>"><div id="elh_t_perusahaan_kdproduknafed3" class="t_perusahaan_kdproduknafed3"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->kdproduknafed3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdproduknafed3" class="<?php echo $t_perusahaan_list->kdproduknafed3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->kdproduknafed3) ?>', 1);"><div id="elh_t_perusahaan_kdproduknafed3" class="t_perusahaan_kdproduknafed3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->kdproduknafed3->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->kdproduknafed3->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->kdproduknafed3->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_perusahaan_list->pproduk->Visible) { // pproduk ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->pproduk) == "") { ?>
		<th data-name="pproduk" class="<?php echo $t_perusahaan_list->pproduk->headerCellClass() ?>"><div id="elh_t_perusahaan_pproduk" class="t_perusahaan_pproduk"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->pproduk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pproduk" class="<?php echo $t_perusahaan_list->pproduk->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->pproduk) ?>', 1);"><div id="elh_t_perusahaan_pproduk" class="t_perusahaan_pproduk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->pproduk->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->pproduk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->pproduk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_perusahaan_list->kdexport->Visible) { // kdexport ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->kdexport) == "") { ?>
		<th data-name="kdexport" class="<?php echo $t_perusahaan_list->kdexport->headerCellClass() ?>"><div id="elh_t_perusahaan_kdexport" class="t_perusahaan_kdexport"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->kdexport->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdexport" class="<?php echo $t_perusahaan_list->kdexport->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->kdexport) ?>', 1);"><div id="elh_t_perusahaan_kdexport" class="t_perusahaan_kdexport">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->kdexport->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->kdexport->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->kdexport->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_perusahaan_list->nexport->Visible) { // nexport ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->nexport) == "") { ?>
		<th data-name="nexport" class="<?php echo $t_perusahaan_list->nexport->headerCellClass() ?>"><div id="elh_t_perusahaan_nexport" class="t_perusahaan_nexport"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->nexport->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nexport" class="<?php echo $t_perusahaan_list->nexport->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->nexport) ?>', 1);"><div id="elh_t_perusahaan_nexport" class="t_perusahaan_nexport">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->nexport->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->nexport->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->nexport->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_perusahaan_list->kdskala->Visible) { // kdskala ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->kdskala) == "") { ?>
		<th data-name="kdskala" class="<?php echo $t_perusahaan_list->kdskala->headerCellClass() ?>"><div id="elh_t_perusahaan_kdskala" class="t_perusahaan_kdskala"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->kdskala->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdskala" class="<?php echo $t_perusahaan_list->kdskala->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->kdskala) ?>', 1);"><div id="elh_t_perusahaan_kdskala" class="t_perusahaan_kdskala">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->kdskala->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->kdskala->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->kdskala->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_perusahaan_list->kdkategori->Visible) { // kdkategori ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->kdkategori) == "") { ?>
		<th data-name="kdkategori" class="<?php echo $t_perusahaan_list->kdkategori->headerCellClass() ?>"><div id="elh_t_perusahaan_kdkategori" class="t_perusahaan_kdkategori"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->kdkategori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkategori" class="<?php echo $t_perusahaan_list->kdkategori->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->kdkategori) ?>', 1);"><div id="elh_t_perusahaan_kdkategori" class="t_perusahaan_kdkategori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->kdkategori->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->kdkategori->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->kdkategori->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_perusahaan_list->jpeserta->Visible) { // jpeserta ?>
	<?php if ($t_perusahaan_list->SortUrl($t_perusahaan_list->jpeserta) == "") { ?>
		<th data-name="jpeserta" class="<?php echo $t_perusahaan_list->jpeserta->headerCellClass() ?>"><div id="elh_t_perusahaan_jpeserta" class="t_perusahaan_jpeserta"><div class="ew-table-header-caption"><?php echo $t_perusahaan_list->jpeserta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jpeserta" class="<?php echo $t_perusahaan_list->jpeserta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_perusahaan_list->SortUrl($t_perusahaan_list->jpeserta) ?>', 1);"><div id="elh_t_perusahaan_jpeserta" class="t_perusahaan_jpeserta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_perusahaan_list->jpeserta->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_perusahaan_list->jpeserta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_perusahaan_list->jpeserta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_perusahaan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_perusahaan_list->ExportAll && $t_perusahaan_list->isExport()) {
	$t_perusahaan_list->StopRecord = $t_perusahaan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_perusahaan_list->TotalRecords > $t_perusahaan_list->StartRecord + $t_perusahaan_list->DisplayRecords - 1)
		$t_perusahaan_list->StopRecord = $t_perusahaan_list->StartRecord + $t_perusahaan_list->DisplayRecords - 1;
	else
		$t_perusahaan_list->StopRecord = $t_perusahaan_list->TotalRecords;
}
$t_perusahaan_list->RecordCount = $t_perusahaan_list->StartRecord - 1;
if ($t_perusahaan_list->Recordset && !$t_perusahaan_list->Recordset->EOF) {
	$t_perusahaan_list->Recordset->moveFirst();
	$selectLimit = $t_perusahaan_list->UseSelectLimit;
	if (!$selectLimit && $t_perusahaan_list->StartRecord > 1)
		$t_perusahaan_list->Recordset->move($t_perusahaan_list->StartRecord - 1);
} elseif (!$t_perusahaan->AllowAddDeleteRow && $t_perusahaan_list->StopRecord == 0) {
	$t_perusahaan_list->StopRecord = $t_perusahaan->GridAddRowCount;
}

// Initialize aggregate
$t_perusahaan->RowType = ROWTYPE_AGGREGATEINIT;
$t_perusahaan->resetAttributes();
$t_perusahaan_list->renderRow();
while ($t_perusahaan_list->RecordCount < $t_perusahaan_list->StopRecord) {
	$t_perusahaan_list->RecordCount++;
	if ($t_perusahaan_list->RecordCount >= $t_perusahaan_list->StartRecord) {
		$t_perusahaan_list->RowCount++;

		// Set up key count
		$t_perusahaan_list->KeyCount = $t_perusahaan_list->RowIndex;

		// Init row class and style
		$t_perusahaan->resetAttributes();
		$t_perusahaan->CssClass = "";
		if ($t_perusahaan_list->isGridAdd()) {
		} else {
			$t_perusahaan_list->loadRowValues($t_perusahaan_list->Recordset); // Load row values
		}
		$t_perusahaan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_perusahaan->RowAttrs->merge(["data-rowindex" => $t_perusahaan_list->RowCount, "id" => "r" . $t_perusahaan_list->RowCount . "_t_perusahaan", "data-rowtype" => $t_perusahaan->RowType]);

		// Render row
		$t_perusahaan_list->renderRow();

		// Render list options
		$t_perusahaan_list->renderListOptions();
?>
	<tr <?php echo $t_perusahaan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_perusahaan_list->ListOptions->render("body", "left", $t_perusahaan_list->RowCount);
?>
	<?php if ($t_perusahaan_list->namap->Visible) { // namap ?>
		<td data-name="namap" <?php echo $t_perusahaan_list->namap->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_namap">
<span<?php echo $t_perusahaan_list->namap->viewAttributes() ?>><?php echo $t_perusahaan_list->namap->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_perusahaan_list->idp->Visible) { // idp ?>
		<td data-name="idp" <?php echo $t_perusahaan_list->idp->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_idp">
<span<?php echo $t_perusahaan_list->idp->viewAttributes() ?>><?php echo $t_perusahaan_list->idp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_perusahaan_list->kontak->Visible) { // kontak ?>
		<td data-name="kontak" <?php echo $t_perusahaan_list->kontak->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_kontak">
<span<?php echo $t_perusahaan_list->kontak->viewAttributes() ?>><?php echo $t_perusahaan_list->kontak->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_perusahaan_list->kdlokasi->Visible) { // kdlokasi ?>
		<td data-name="kdlokasi" <?php echo $t_perusahaan_list->kdlokasi->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_kdlokasi">
<span<?php echo $t_perusahaan_list->kdlokasi->viewAttributes() ?>><?php echo $t_perusahaan_list->kdlokasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_perusahaan_list->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" <?php echo $t_perusahaan_list->kdprop->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_kdprop">
<span<?php echo $t_perusahaan_list->kdprop->viewAttributes() ?>><?php echo $t_perusahaan_list->kdprop->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_perusahaan_list->kdkota->Visible) { // kdkota ?>
		<td data-name="kdkota" <?php echo $t_perusahaan_list->kdkota->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_kdkota">
<span<?php echo $t_perusahaan_list->kdkota->viewAttributes() ?>><?php echo $t_perusahaan_list->kdkota->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_perusahaan_list->kdkec->Visible) { // kdkec ?>
		<td data-name="kdkec" <?php echo $t_perusahaan_list->kdkec->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_kdkec">
<span<?php echo $t_perusahaan_list->kdkec->viewAttributes() ?>><?php echo $t_perusahaan_list->kdkec->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_perusahaan_list->alamatp->Visible) { // alamatp ?>
		<td data-name="alamatp" <?php echo $t_perusahaan_list->alamatp->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_alamatp">
<span<?php echo $t_perusahaan_list->alamatp->viewAttributes() ?>><?php echo $t_perusahaan_list->alamatp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_perusahaan_list->telpp->Visible) { // telpp ?>
		<td data-name="telpp" <?php echo $t_perusahaan_list->telpp->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_telpp">
<span<?php echo $t_perusahaan_list->telpp->viewAttributes() ?>><?php echo $t_perusahaan_list->telpp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_perusahaan_list->faxp->Visible) { // faxp ?>
		<td data-name="faxp" <?php echo $t_perusahaan_list->faxp->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_faxp">
<span<?php echo $t_perusahaan_list->faxp->viewAttributes() ?>><?php echo $t_perusahaan_list->faxp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_perusahaan_list->emailp->Visible) { // emailp ?>
		<td data-name="emailp" <?php echo $t_perusahaan_list->emailp->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_emailp">
<span<?php echo $t_perusahaan_list->emailp->viewAttributes() ?>><?php echo $t_perusahaan_list->emailp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_perusahaan_list->webp->Visible) { // webp ?>
		<td data-name="webp" <?php echo $t_perusahaan_list->webp->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_webp">
<span<?php echo $t_perusahaan_list->webp->viewAttributes() ?>><?php echo $t_perusahaan_list->webp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_perusahaan_list->medsos->Visible) { // medsos ?>
		<td data-name="medsos" <?php echo $t_perusahaan_list->medsos->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_medsos">
<span<?php echo $t_perusahaan_list->medsos->viewAttributes() ?>><?php echo $t_perusahaan_list->medsos->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_perusahaan_list->kdjenis->Visible) { // kdjenis ?>
		<td data-name="kdjenis" <?php echo $t_perusahaan_list->kdjenis->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_kdjenis">
<span<?php echo $t_perusahaan_list->kdjenis->viewAttributes() ?>><?php echo $t_perusahaan_list->kdjenis->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_perusahaan_list->kdproduknafed->Visible) { // kdproduknafed ?>
		<td data-name="kdproduknafed" <?php echo $t_perusahaan_list->kdproduknafed->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_kdproduknafed">
<span<?php echo $t_perusahaan_list->kdproduknafed->viewAttributes() ?>><?php echo $t_perusahaan_list->kdproduknafed->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_perusahaan_list->kdproduknafed2->Visible) { // kdproduknafed2 ?>
		<td data-name="kdproduknafed2" <?php echo $t_perusahaan_list->kdproduknafed2->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_kdproduknafed2">
<span<?php echo $t_perusahaan_list->kdproduknafed2->viewAttributes() ?>><?php echo $t_perusahaan_list->kdproduknafed2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_perusahaan_list->kdproduknafed3->Visible) { // kdproduknafed3 ?>
		<td data-name="kdproduknafed3" <?php echo $t_perusahaan_list->kdproduknafed3->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_kdproduknafed3">
<span<?php echo $t_perusahaan_list->kdproduknafed3->viewAttributes() ?>><?php echo $t_perusahaan_list->kdproduknafed3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_perusahaan_list->pproduk->Visible) { // pproduk ?>
		<td data-name="pproduk" <?php echo $t_perusahaan_list->pproduk->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_pproduk">
<span<?php echo $t_perusahaan_list->pproduk->viewAttributes() ?>><?php echo $t_perusahaan_list->pproduk->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_perusahaan_list->kdexport->Visible) { // kdexport ?>
		<td data-name="kdexport" <?php echo $t_perusahaan_list->kdexport->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_kdexport">
<span<?php echo $t_perusahaan_list->kdexport->viewAttributes() ?>><?php echo $t_perusahaan_list->kdexport->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_perusahaan_list->nexport->Visible) { // nexport ?>
		<td data-name="nexport" <?php echo $t_perusahaan_list->nexport->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_nexport">
<span<?php echo $t_perusahaan_list->nexport->viewAttributes() ?>><?php echo $t_perusahaan_list->nexport->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_perusahaan_list->kdskala->Visible) { // kdskala ?>
		<td data-name="kdskala" <?php echo $t_perusahaan_list->kdskala->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_kdskala">
<span<?php echo $t_perusahaan_list->kdskala->viewAttributes() ?>><?php echo $t_perusahaan_list->kdskala->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_perusahaan_list->kdkategori->Visible) { // kdkategori ?>
		<td data-name="kdkategori" <?php echo $t_perusahaan_list->kdkategori->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_kdkategori">
<span<?php echo $t_perusahaan_list->kdkategori->viewAttributes() ?>><?php echo $t_perusahaan_list->kdkategori->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_perusahaan_list->jpeserta->Visible) { // jpeserta ?>
		<td data-name="jpeserta" <?php echo $t_perusahaan_list->jpeserta->cellAttributes() ?>>
<span id="el<?php echo $t_perusahaan_list->RowCount ?>_t_perusahaan_jpeserta">
<span<?php echo $t_perusahaan_list->jpeserta->viewAttributes() ?>><?php echo $t_perusahaan_list->jpeserta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_perusahaan_list->ListOptions->render("body", "right", $t_perusahaan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_perusahaan_list->isGridAdd())
		$t_perusahaan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_perusahaan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_perusahaan_list->Recordset)
	$t_perusahaan_list->Recordset->Close();
?>
<?php if (!$t_perusahaan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_perusahaan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_perusahaan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_perusahaan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_perusahaan_list->TotalRecords == 0 && !$t_perusahaan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_perusahaan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_perusahaan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_perusahaan_list->isExport()) { ?>
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
$t_perusahaan_list->terminate();
?>