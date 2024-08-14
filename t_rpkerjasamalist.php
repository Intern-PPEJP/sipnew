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
$t_rpkerjasama_list = new t_rpkerjasama_list();

// Run the page
$t_rpkerjasama_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rpkerjasama_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_rpkerjasama_list->isExport()) { ?>
<script>
var ft_rpkerjasamalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_rpkerjasamalist = currentForm = new ew.Form("ft_rpkerjasamalist", "list");
	ft_rpkerjasamalist.formKeyCountName = '<?php echo $t_rpkerjasama_list->FormKeyCountName ?>';
	loadjs.done("ft_rpkerjasamalist");
});
var ft_rpkerjasamalistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_rpkerjasamalistsrch = currentSearchForm = new ew.Form("ft_rpkerjasamalistsrch");

	// Validate function for search
	ft_rpkerjasamalistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_kerjasama");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_rpkerjasama_list->kerjasama->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tahun_rencana");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_rpkerjasama_list->tahun_rencana->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	ft_rpkerjasamalistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_rpkerjasamalistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_rpkerjasamalistsrch.lists["x_jenispel"] = <?php echo $t_rpkerjasama_list->jenispel->Lookup->toClientList($t_rpkerjasama_list) ?>;
	ft_rpkerjasamalistsrch.lists["x_jenispel"].options = <?php echo JsonEncode($t_rpkerjasama_list->jenispel->options(FALSE, TRUE)) ?>;
	ft_rpkerjasamalistsrch.lists["x_kerjasama"] = <?php echo $t_rpkerjasama_list->kerjasama->Lookup->toClientList($t_rpkerjasama_list) ?>;
	ft_rpkerjasamalistsrch.lists["x_kerjasama"].options = <?php echo JsonEncode($t_rpkerjasama_list->kerjasama->lookupOptions()) ?>;
	ft_rpkerjasamalistsrch.autoSuggests["x_kerjasama"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

	// Filters
	ft_rpkerjasamalistsrch.filterList = <?php echo $t_rpkerjasama_list->getFilterList() ?>;
	loadjs.done("ft_rpkerjasamalistsrch");
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
<?php if (!$t_rpkerjasama_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_rpkerjasama_list->TotalRecords > 0 && $t_rpkerjasama_list->ExportOptions->visible()) { ?>
<?php $t_rpkerjasama_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_rpkerjasama_list->ImportOptions->visible()) { ?>
<?php $t_rpkerjasama_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_rpkerjasama_list->SearchOptions->visible()) { ?>
<?php $t_rpkerjasama_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_rpkerjasama_list->FilterOptions->visible()) { ?>
<?php $t_rpkerjasama_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_rpkerjasama_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_rpkerjasama_list->isExport() && !$t_rpkerjasama->CurrentAction) { ?>
<form name="ft_rpkerjasamalistsrch" id="ft_rpkerjasamalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_rpkerjasamalistsrch-search-panel" class="<?php echo $t_rpkerjasama_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_rpkerjasama">
	<div class="ew-extended-search">
<?php

// Render search row
$t_rpkerjasama->RowType = ROWTYPE_SEARCH;
$t_rpkerjasama->resetAttributes();
$t_rpkerjasama_list->renderRow();
?>
<?php if ($t_rpkerjasama_list->jenispel->Visible) { // jenispel ?>
	<?php
		$t_rpkerjasama_list->SearchColumnCount++;
		if (($t_rpkerjasama_list->SearchColumnCount - 1) % $t_rpkerjasama_list->SearchFieldsPerRow == 0) {
			$t_rpkerjasama_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_rpkerjasama_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_jenispel" class="ew-cell form-group">
		<label for="x_jenispel" class="ew-search-caption ew-label"><?php echo $t_rpkerjasama_list->jenispel->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jenispel" id="z_jenispel" value="=">
</span>
		<span id="el_t_rpkerjasama_jenispel" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_rpkerjasama" data-field="x_jenispel" data-value-separator="<?php echo $t_rpkerjasama_list->jenispel->displayValueSeparatorAttribute() ?>" id="x_jenispel" name="x_jenispel"<?php echo $t_rpkerjasama_list->jenispel->editAttributes() ?>>
			<?php echo $t_rpkerjasama_list->jenispel->selectOptionListHtml("x_jenispel") ?>
		</select>
</div>
</span>
	</div>
	<?php if ($t_rpkerjasama_list->SearchColumnCount % $t_rpkerjasama_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($t_rpkerjasama_list->kerjasama->Visible) { // kerjasama ?>
	<?php
		$t_rpkerjasama_list->SearchColumnCount++;
		if (($t_rpkerjasama_list->SearchColumnCount - 1) % $t_rpkerjasama_list->SearchFieldsPerRow == 0) {
			$t_rpkerjasama_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_rpkerjasama_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kerjasama" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $t_rpkerjasama_list->kerjasama->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kerjasama" id="z_kerjasama" value="=">
</span>
		<span id="el_t_rpkerjasama_kerjasama" class="ew-search-field">
<?php
$onchange = $t_rpkerjasama_list->kerjasama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_rpkerjasama_list->kerjasama->EditAttrs["onchange"] = "";
?>
<span id="as_x_kerjasama">
	<input type="text" class="form-control" name="sv_x_kerjasama" id="sv_x_kerjasama" value="<?php echo RemoveHtml($t_rpkerjasama_list->kerjasama->EditValue) ?>" size="100" maxlength="30" placeholder="<?php echo HtmlEncode($t_rpkerjasama_list->kerjasama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_rpkerjasama_list->kerjasama->getPlaceHolder()) ?>"<?php echo $t_rpkerjasama_list->kerjasama->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_rpkerjasama" data-field="x_kerjasama" data-value-separator="<?php echo $t_rpkerjasama_list->kerjasama->displayValueSeparatorAttribute() ?>" name="x_kerjasama" id="x_kerjasama" value="<?php echo HtmlEncode($t_rpkerjasama_list->kerjasama->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_rpkerjasamalistsrch"], function() {
	ft_rpkerjasamalistsrch.createAutoSuggest({"id":"x_kerjasama","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_rpkerjasama_list->kerjasama->Lookup->getParamTag($t_rpkerjasama_list, "p_x_kerjasama") ?>
</span>
	</div>
	<?php if ($t_rpkerjasama_list->SearchColumnCount % $t_rpkerjasama_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($t_rpkerjasama_list->tahun_rencana->Visible) { // tahun_rencana ?>
	<?php
		$t_rpkerjasama_list->SearchColumnCount++;
		if (($t_rpkerjasama_list->SearchColumnCount - 1) % $t_rpkerjasama_list->SearchFieldsPerRow == 0) {
			$t_rpkerjasama_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_rpkerjasama_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_tahun_rencana" class="ew-cell form-group">
		<label for="x_tahun_rencana" class="ew-search-caption ew-label"><?php echo $t_rpkerjasama_list->tahun_rencana->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tahun_rencana" id="z_tahun_rencana" value="=">
</span>
		<span id="el_t_rpkerjasama_tahun_rencana" class="ew-search-field">
<input type="text" data-table="t_rpkerjasama" data-field="x_tahun_rencana" name="x_tahun_rencana" id="x_tahun_rencana" size="5" maxlength="4" placeholder="<?php echo HtmlEncode($t_rpkerjasama_list->tahun_rencana->getPlaceHolder()) ?>" value="<?php echo $t_rpkerjasama_list->tahun_rencana->EditValue ?>"<?php echo $t_rpkerjasama_list->tahun_rencana->editAttributes() ?>>
</span>
	</div>
	<?php if ($t_rpkerjasama_list->SearchColumnCount % $t_rpkerjasama_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($t_rpkerjasama_list->SearchColumnCount % $t_rpkerjasama_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $t_rpkerjasama_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_rpkerjasama_list->showPageHeader(); ?>
<?php
$t_rpkerjasama_list->showMessage();
?>
<?php if ($t_rpkerjasama_list->TotalRecords > 0 || $t_rpkerjasama->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_rpkerjasama_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_rpkerjasama">
<?php if (!$t_rpkerjasama_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_rpkerjasama_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_rpkerjasama_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_rpkerjasama_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_rpkerjasamalist" id="ft_rpkerjasamalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rpkerjasama">
<div id="gmp_t_rpkerjasama" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_rpkerjasama_list->TotalRecords > 0 || $t_rpkerjasama_list->isGridEdit()) { ?>
<table id="tbl_t_rpkerjasamalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_rpkerjasama->RowType = ROWTYPE_HEADER;

// Render list options
$t_rpkerjasama_list->renderListOptions();

// Render list options (header, left)
$t_rpkerjasama_list->ListOptions->render("header", "left");
?>
<?php if ($t_rpkerjasama_list->jenispel->Visible) { // jenispel ?>
	<?php if ($t_rpkerjasama_list->SortUrl($t_rpkerjasama_list->jenispel) == "") { ?>
		<th data-name="jenispel" class="<?php echo $t_rpkerjasama_list->jenispel->headerCellClass() ?>"><div id="elh_t_rpkerjasama_jenispel" class="t_rpkerjasama_jenispel"><div class="ew-table-header-caption"><?php echo $t_rpkerjasama_list->jenispel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenispel" class="<?php echo $t_rpkerjasama_list->jenispel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rpkerjasama_list->SortUrl($t_rpkerjasama_list->jenispel) ?>', 1);"><div id="elh_t_rpkerjasama_jenispel" class="t_rpkerjasama_jenispel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rpkerjasama_list->jenispel->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rpkerjasama_list->jenispel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rpkerjasama_list->jenispel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rpkerjasama_list->kerjasama->Visible) { // kerjasama ?>
	<?php if ($t_rpkerjasama_list->SortUrl($t_rpkerjasama_list->kerjasama) == "") { ?>
		<th data-name="kerjasama" class="<?php echo $t_rpkerjasama_list->kerjasama->headerCellClass() ?>"><div id="elh_t_rpkerjasama_kerjasama" class="t_rpkerjasama_kerjasama"><div class="ew-table-header-caption"><?php echo $t_rpkerjasama_list->kerjasama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kerjasama" class="<?php echo $t_rpkerjasama_list->kerjasama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rpkerjasama_list->SortUrl($t_rpkerjasama_list->kerjasama) ?>', 1);"><div id="elh_t_rpkerjasama_kerjasama" class="t_rpkerjasama_kerjasama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rpkerjasama_list->kerjasama->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rpkerjasama_list->kerjasama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rpkerjasama_list->kerjasama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rpkerjasama_list->angkatan->Visible) { // angkatan ?>
	<?php if ($t_rpkerjasama_list->SortUrl($t_rpkerjasama_list->angkatan) == "") { ?>
		<th data-name="angkatan" class="<?php echo $t_rpkerjasama_list->angkatan->headerCellClass() ?>"><div id="elh_t_rpkerjasama_angkatan" class="t_rpkerjasama_angkatan"><div class="ew-table-header-caption"><?php echo $t_rpkerjasama_list->angkatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="angkatan" class="<?php echo $t_rpkerjasama_list->angkatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rpkerjasama_list->SortUrl($t_rpkerjasama_list->angkatan) ?>', 1);"><div id="elh_t_rpkerjasama_angkatan" class="t_rpkerjasama_angkatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rpkerjasama_list->angkatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rpkerjasama_list->angkatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rpkerjasama_list->angkatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rpkerjasama_list->sisa_angkatan->Visible) { // sisa_angkatan ?>
	<?php if ($t_rpkerjasama_list->SortUrl($t_rpkerjasama_list->sisa_angkatan) == "") { ?>
		<th data-name="sisa_angkatan" class="<?php echo $t_rpkerjasama_list->sisa_angkatan->headerCellClass() ?>"><div id="elh_t_rpkerjasama_sisa_angkatan" class="t_rpkerjasama_sisa_angkatan"><div class="ew-table-header-caption"><?php echo $t_rpkerjasama_list->sisa_angkatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sisa_angkatan" class="<?php echo $t_rpkerjasama_list->sisa_angkatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rpkerjasama_list->SortUrl($t_rpkerjasama_list->sisa_angkatan) ?>', 1);"><div id="elh_t_rpkerjasama_sisa_angkatan" class="t_rpkerjasama_sisa_angkatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rpkerjasama_list->sisa_angkatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rpkerjasama_list->sisa_angkatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rpkerjasama_list->sisa_angkatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rpkerjasama_list->targetpes->Visible) { // targetpes ?>
	<?php if ($t_rpkerjasama_list->SortUrl($t_rpkerjasama_list->targetpes) == "") { ?>
		<th data-name="targetpes" class="<?php echo $t_rpkerjasama_list->targetpes->headerCellClass() ?>"><div id="elh_t_rpkerjasama_targetpes" class="t_rpkerjasama_targetpes"><div class="ew-table-header-caption"><?php echo $t_rpkerjasama_list->targetpes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes" class="<?php echo $t_rpkerjasama_list->targetpes->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rpkerjasama_list->SortUrl($t_rpkerjasama_list->targetpes) ?>', 1);"><div id="elh_t_rpkerjasama_targetpes" class="t_rpkerjasama_targetpes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rpkerjasama_list->targetpes->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rpkerjasama_list->targetpes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rpkerjasama_list->targetpes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rpkerjasama_list->kontak_person->Visible) { // kontak_person ?>
	<?php if ($t_rpkerjasama_list->SortUrl($t_rpkerjasama_list->kontak_person) == "") { ?>
		<th data-name="kontak_person" class="<?php echo $t_rpkerjasama_list->kontak_person->headerCellClass() ?>"><div id="elh_t_rpkerjasama_kontak_person" class="t_rpkerjasama_kontak_person"><div class="ew-table-header-caption"><?php echo $t_rpkerjasama_list->kontak_person->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kontak_person" class="<?php echo $t_rpkerjasama_list->kontak_person->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rpkerjasama_list->SortUrl($t_rpkerjasama_list->kontak_person) ?>', 1);"><div id="elh_t_rpkerjasama_kontak_person" class="t_rpkerjasama_kontak_person">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rpkerjasama_list->kontak_person->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rpkerjasama_list->kontak_person->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rpkerjasama_list->kontak_person->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rpkerjasama_list->tahun_rencana->Visible) { // tahun_rencana ?>
	<?php if ($t_rpkerjasama_list->SortUrl($t_rpkerjasama_list->tahun_rencana) == "") { ?>
		<th data-name="tahun_rencana" class="<?php echo $t_rpkerjasama_list->tahun_rencana->headerCellClass() ?>"><div id="elh_t_rpkerjasama_tahun_rencana" class="t_rpkerjasama_tahun_rencana"><div class="ew-table-header-caption"><?php echo $t_rpkerjasama_list->tahun_rencana->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun_rencana" class="<?php echo $t_rpkerjasama_list->tahun_rencana->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rpkerjasama_list->SortUrl($t_rpkerjasama_list->tahun_rencana) ?>', 1);"><div id="elh_t_rpkerjasama_tahun_rencana" class="t_rpkerjasama_tahun_rencana">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rpkerjasama_list->tahun_rencana->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rpkerjasama_list->tahun_rencana->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rpkerjasama_list->tahun_rencana->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_rpkerjasama_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_rpkerjasama_list->ExportAll && $t_rpkerjasama_list->isExport()) {
	$t_rpkerjasama_list->StopRecord = $t_rpkerjasama_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_rpkerjasama_list->TotalRecords > $t_rpkerjasama_list->StartRecord + $t_rpkerjasama_list->DisplayRecords - 1)
		$t_rpkerjasama_list->StopRecord = $t_rpkerjasama_list->StartRecord + $t_rpkerjasama_list->DisplayRecords - 1;
	else
		$t_rpkerjasama_list->StopRecord = $t_rpkerjasama_list->TotalRecords;
}
$t_rpkerjasama_list->RecordCount = $t_rpkerjasama_list->StartRecord - 1;
if ($t_rpkerjasama_list->Recordset && !$t_rpkerjasama_list->Recordset->EOF) {
	$t_rpkerjasama_list->Recordset->moveFirst();
	$selectLimit = $t_rpkerjasama_list->UseSelectLimit;
	if (!$selectLimit && $t_rpkerjasama_list->StartRecord > 1)
		$t_rpkerjasama_list->Recordset->move($t_rpkerjasama_list->StartRecord - 1);
} elseif (!$t_rpkerjasama->AllowAddDeleteRow && $t_rpkerjasama_list->StopRecord == 0) {
	$t_rpkerjasama_list->StopRecord = $t_rpkerjasama->GridAddRowCount;
}

// Initialize aggregate
$t_rpkerjasama->RowType = ROWTYPE_AGGREGATEINIT;
$t_rpkerjasama->resetAttributes();
$t_rpkerjasama_list->renderRow();
while ($t_rpkerjasama_list->RecordCount < $t_rpkerjasama_list->StopRecord) {
	$t_rpkerjasama_list->RecordCount++;
	if ($t_rpkerjasama_list->RecordCount >= $t_rpkerjasama_list->StartRecord) {
		$t_rpkerjasama_list->RowCount++;

		// Set up key count
		$t_rpkerjasama_list->KeyCount = $t_rpkerjasama_list->RowIndex;

		// Init row class and style
		$t_rpkerjasama->resetAttributes();
		$t_rpkerjasama->CssClass = "";
		if ($t_rpkerjasama_list->isGridAdd()) {
		} else {
			$t_rpkerjasama_list->loadRowValues($t_rpkerjasama_list->Recordset); // Load row values
		}
		$t_rpkerjasama->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_rpkerjasama->RowAttrs->merge(["data-rowindex" => $t_rpkerjasama_list->RowCount, "id" => "r" . $t_rpkerjasama_list->RowCount . "_t_rpkerjasama", "data-rowtype" => $t_rpkerjasama->RowType]);

		// Render row
		$t_rpkerjasama_list->renderRow();

		// Render list options
		$t_rpkerjasama_list->renderListOptions();
?>
	<tr <?php echo $t_rpkerjasama->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_rpkerjasama_list->ListOptions->render("body", "left", $t_rpkerjasama_list->RowCount);
?>
	<?php if ($t_rpkerjasama_list->jenispel->Visible) { // jenispel ?>
		<td data-name="jenispel" <?php echo $t_rpkerjasama_list->jenispel->cellAttributes() ?>>
<span id="el<?php echo $t_rpkerjasama_list->RowCount ?>_t_rpkerjasama_jenispel">
<span<?php echo $t_rpkerjasama_list->jenispel->viewAttributes() ?>><?php echo $t_rpkerjasama_list->jenispel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rpkerjasama_list->kerjasama->Visible) { // kerjasama ?>
		<td data-name="kerjasama" <?php echo $t_rpkerjasama_list->kerjasama->cellAttributes() ?>>
<span id="el<?php echo $t_rpkerjasama_list->RowCount ?>_t_rpkerjasama_kerjasama">
<span<?php echo $t_rpkerjasama_list->kerjasama->viewAttributes() ?>><?php echo $t_rpkerjasama_list->kerjasama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rpkerjasama_list->angkatan->Visible) { // angkatan ?>
		<td data-name="angkatan" <?php echo $t_rpkerjasama_list->angkatan->cellAttributes() ?>>
<span id="el<?php echo $t_rpkerjasama_list->RowCount ?>_t_rpkerjasama_angkatan">
<span<?php echo $t_rpkerjasama_list->angkatan->viewAttributes() ?>><?php echo $t_rpkerjasama_list->angkatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rpkerjasama_list->sisa_angkatan->Visible) { // sisa_angkatan ?>
		<td data-name="sisa_angkatan" <?php echo $t_rpkerjasama_list->sisa_angkatan->cellAttributes() ?>>
<span id="el<?php echo $t_rpkerjasama_list->RowCount ?>_t_rpkerjasama_sisa_angkatan">
<span<?php echo $t_rpkerjasama_list->sisa_angkatan->viewAttributes() ?>><?php echo $t_rpkerjasama_list->sisa_angkatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rpkerjasama_list->targetpes->Visible) { // targetpes ?>
		<td data-name="targetpes" <?php echo $t_rpkerjasama_list->targetpes->cellAttributes() ?>>
<span id="el<?php echo $t_rpkerjasama_list->RowCount ?>_t_rpkerjasama_targetpes">
<span<?php echo $t_rpkerjasama_list->targetpes->viewAttributes() ?>><?php echo $t_rpkerjasama_list->targetpes->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rpkerjasama_list->kontak_person->Visible) { // kontak_person ?>
		<td data-name="kontak_person" <?php echo $t_rpkerjasama_list->kontak_person->cellAttributes() ?>>
<span id="el<?php echo $t_rpkerjasama_list->RowCount ?>_t_rpkerjasama_kontak_person">
<span<?php echo $t_rpkerjasama_list->kontak_person->viewAttributes() ?>><?php echo $t_rpkerjasama_list->kontak_person->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rpkerjasama_list->tahun_rencana->Visible) { // tahun_rencana ?>
		<td data-name="tahun_rencana" <?php echo $t_rpkerjasama_list->tahun_rencana->cellAttributes() ?>>
<span id="el<?php echo $t_rpkerjasama_list->RowCount ?>_t_rpkerjasama_tahun_rencana">
<span<?php echo $t_rpkerjasama_list->tahun_rencana->viewAttributes() ?>><?php echo $t_rpkerjasama_list->tahun_rencana->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_rpkerjasama_list->ListOptions->render("body", "right", $t_rpkerjasama_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_rpkerjasama_list->isGridAdd())
		$t_rpkerjasama_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$t_rpkerjasama->RowType = ROWTYPE_AGGREGATE;
$t_rpkerjasama->resetAttributes();
$t_rpkerjasama_list->renderRow();
?>
<?php if ($t_rpkerjasama_list->TotalRecords > 0 && !$t_rpkerjasama_list->isGridAdd() && !$t_rpkerjasama_list->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$t_rpkerjasama_list->renderListOptions();

// Render list options (footer, left)
$t_rpkerjasama_list->ListOptions->render("footer", "left");
?>
	<?php if ($t_rpkerjasama_list->jenispel->Visible) { // jenispel ?>
		<td data-name="jenispel" class="<?php echo $t_rpkerjasama_list->jenispel->footerCellClass() ?>"><span id="elf_t_rpkerjasama_jenispel" class="t_rpkerjasama_jenispel">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_rpkerjasama_list->kerjasama->Visible) { // kerjasama ?>
		<td data-name="kerjasama" class="<?php echo $t_rpkerjasama_list->kerjasama->footerCellClass() ?>"><span id="elf_t_rpkerjasama_kerjasama" class="t_rpkerjasama_kerjasama">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_rpkerjasama_list->angkatan->Visible) { // angkatan ?>
		<td data-name="angkatan" class="<?php echo $t_rpkerjasama_list->angkatan->footerCellClass() ?>"><span id="elf_t_rpkerjasama_angkatan" class="t_rpkerjasama_angkatan">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $t_rpkerjasama_list->angkatan->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($t_rpkerjasama_list->sisa_angkatan->Visible) { // sisa_angkatan ?>
		<td data-name="sisa_angkatan" class="<?php echo $t_rpkerjasama_list->sisa_angkatan->footerCellClass() ?>"><span id="elf_t_rpkerjasama_sisa_angkatan" class="t_rpkerjasama_sisa_angkatan">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_rpkerjasama_list->targetpes->Visible) { // targetpes ?>
		<td data-name="targetpes" class="<?php echo $t_rpkerjasama_list->targetpes->footerCellClass() ?>"><span id="elf_t_rpkerjasama_targetpes" class="t_rpkerjasama_targetpes">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $t_rpkerjasama_list->targetpes->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($t_rpkerjasama_list->kontak_person->Visible) { // kontak_person ?>
		<td data-name="kontak_person" class="<?php echo $t_rpkerjasama_list->kontak_person->footerCellClass() ?>"><span id="elf_t_rpkerjasama_kontak_person" class="t_rpkerjasama_kontak_person">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t_rpkerjasama_list->tahun_rencana->Visible) { // tahun_rencana ?>
		<td data-name="tahun_rencana" class="<?php echo $t_rpkerjasama_list->tahun_rencana->footerCellClass() ?>"><span id="elf_t_rpkerjasama_tahun_rencana" class="t_rpkerjasama_tahun_rencana">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$t_rpkerjasama_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_rpkerjasama->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_rpkerjasama_list->Recordset)
	$t_rpkerjasama_list->Recordset->Close();
?>
<?php if (!$t_rpkerjasama_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_rpkerjasama_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_rpkerjasama_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_rpkerjasama_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_rpkerjasama_list->TotalRecords == 0 && !$t_rpkerjasama->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_rpkerjasama_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_rpkerjasama_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_rpkerjasama_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// document.write("page loaded");
	//$('.ewDetail, .ewMenuColumn').hide();

	/* 
	var url = "csv_rencanakerjasamalist.php"; // url tujuan
	var count = 4; // dalam detik
	var width = 0;
	function countDown() {
		if (count > 0) {
			count--;
			var waktu = count + 1;
			if (width == 99){
				width = 100;
			}
			$('.ewGrid').html('<div class="container"> <h4>Mohon tunggu sebentar. Halaman segera ditampilkan...</h4> <div class="progress"> <span style=" position: fixed; left: 50%; color: #000; ">'+width+'% Complete</span><div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:'+width+'%">  </div> </div> </div>');
			setTimeout("countDown()", 1000);
			width = width + 33;
		} else {
			$('.container').html('<center><img src="tinymce/skins/lightgray/img/loader.gif" height="50px"></img></center>');
			window.location.href = url;
		}
	}
	//countDown();
	*/
	var thn = <?php echo CurrentPage()->tahun_rencana->AdvancedSearch->SearchValue; ?>;
	var newUrl = "v_rencanakerjasamalist.php?cmd=search&t=v_rencanakerjasama&z_kerjasama=%3D&x_kerjasama=&z_jenispel=%3D&x_jenispel=&z_kdjudul=%3D&x_kdjudul=&z_tahun_rencana=%3D&x_tahun_rencana="+ thn +"&psearch=&psearchtype=&export=excel";
	$(".ew-excel").attr("href", newUrl);
});
</script>
<?php if (!$t_rpkerjasama->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_t_rpkerjasama",
		width: "100%",
		height: "350px"
	});
});
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$t_rpkerjasama_list->terminate();
?>