<?php
namespace PHPMaker2020\input_ecp;

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
$dm_ecp_list = new dm_ecp_list();

// Run the page
$dm_ecp_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dm_ecp_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$dm_ecp_list->isExport()) { ?>
<script>
var fdm_ecplist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdm_ecplist = currentForm = new ew.Form("fdm_ecplist", "list");
	fdm_ecplist.formKeyCountName = '<?php echo $dm_ecp_list->FormKeyCountName ?>';

	// Validate form
	fdm_ecplist.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($dm_ecp_list->ID_ECP->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_ECP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_list->ID_ECP->caption(), $dm_ecp_list->ID_ECP->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_list->Nama->Required) { ?>
				elm = this.getElements("x" + infix + "_Nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_list->Nama->caption(), $dm_ecp_list->Nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_list->Perusahaan->Required) { ?>
				elm = this.getElements("x" + infix + "_Perusahaan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_list->Perusahaan->caption(), $dm_ecp_list->Perusahaan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_list->Daerah->Required) { ?>
				elm = this.getElements("x" + infix + "_Daerah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_list->Daerah->caption(), $dm_ecp_list->Daerah->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_list->Produk->Required) { ?>
				elm = this.getElements("x" + infix + "_Produk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_list->Produk->caption(), $dm_ecp_list->Produk->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_list->Tgl_Bln_Ekspor->Required) { ?>
				elm = this.getElements("x" + infix + "_Tgl_Bln_Ekspor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_list->Tgl_Bln_Ekspor->caption(), $dm_ecp_list->Tgl_Bln_Ekspor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_list->Negara_Tujuan->Required) { ?>
				elm = this.getElements("x" + infix + "_Negara_Tujuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_list->Negara_Tujuan->caption(), $dm_ecp_list->Negara_Tujuan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_list->Nilai_Ekspor_USD->Required) { ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_USD");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_list->Nilai_Ekspor_USD->caption(), $dm_ecp_list->Nilai_Ekspor_USD->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_USD");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dm_ecp_list->Nilai_Ekspor_USD->errorMessage()) ?>");
			<?php if ($dm_ecp_list->Nilai_Ekspor_Rupiah->Required) { ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_Rupiah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_list->Nilai_Ekspor_Rupiah->caption(), $dm_ecp_list->Nilai_Ekspor_Rupiah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Nilai_Ekspor_Rupiah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dm_ecp_list->Nilai_Ekspor_Rupiah->errorMessage()) ?>");
			<?php if ($dm_ecp_list->Keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_Keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_list->Keterangan->caption(), $dm_ecp_list->Keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_list->Wilayah_ECP->Required) { ?>
				elm = this.getElements("x" + infix + "_Wilayah_ECP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_list->Wilayah_ECP->caption(), $dm_ecp_list->Wilayah_ECP->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_ecp_list->Tahun_ECP->Required) { ?>
				elm = this.getElements("x" + infix + "_Tahun_ECP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_ecp_list->Tahun_ECP->caption(), $dm_ecp_list->Tahun_ECP->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Tahun_ECP");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dm_ecp_list->Tahun_ECP->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		if (gridinsert && addcnt == 0) { // No row added
			ew.alert(ew.language.phrase("NoAddRecord"));
			return false;
		}
		return true;
	}

	// Check empty row
	fdm_ecplist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Nama", false)) return false;
		if (ew.valueChanged(fobj, infix, "Perusahaan", false)) return false;
		if (ew.valueChanged(fobj, infix, "Daerah", false)) return false;
		if (ew.valueChanged(fobj, infix, "Produk", false)) return false;
		if (ew.valueChanged(fobj, infix, "Tgl_Bln_Ekspor", false)) return false;
		if (ew.valueChanged(fobj, infix, "Negara_Tujuan", false)) return false;
		if (ew.valueChanged(fobj, infix, "Nilai_Ekspor_USD", false)) return false;
		if (ew.valueChanged(fobj, infix, "Nilai_Ekspor_Rupiah", false)) return false;
		if (ew.valueChanged(fobj, infix, "Keterangan", false)) return false;
		if (ew.valueChanged(fobj, infix, "Wilayah_ECP", false)) return false;
		if (ew.valueChanged(fobj, infix, "Tahun_ECP", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdm_ecplist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdm_ecplist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdm_ecplist.lists["x_Nama"] = <?php echo $dm_ecp_list->Nama->Lookup->toClientList($dm_ecp_list) ?>;
	fdm_ecplist.lists["x_Nama"].options = <?php echo JsonEncode($dm_ecp_list->Nama->lookupOptions()) ?>;
	fdm_ecplist.autoSuggests["x_Nama"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdm_ecplist.lists["x_Perusahaan"] = <?php echo $dm_ecp_list->Perusahaan->Lookup->toClientList($dm_ecp_list) ?>;
	fdm_ecplist.lists["x_Perusahaan"].options = <?php echo JsonEncode($dm_ecp_list->Perusahaan->lookupOptions()) ?>;
	fdm_ecplist.autoSuggests["x_Perusahaan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdm_ecplist.lists["x_Wilayah_ECP"] = <?php echo $dm_ecp_list->Wilayah_ECP->Lookup->toClientList($dm_ecp_list) ?>;
	fdm_ecplist.lists["x_Wilayah_ECP"].options = <?php echo JsonEncode($dm_ecp_list->Wilayah_ECP->lookupOptions()) ?>;
	loadjs.done("fdm_ecplist");
});
var fdm_ecplistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdm_ecplistsrch = currentSearchForm = new ew.Form("fdm_ecplistsrch");

	// Validate function for search
	fdm_ecplistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_Tahun_ECP");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($dm_ecp_list->Tahun_ECP->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fdm_ecplistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdm_ecplistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdm_ecplistsrch.lists["x_Wilayah_ECP"] = <?php echo $dm_ecp_list->Wilayah_ECP->Lookup->toClientList($dm_ecp_list) ?>;
	fdm_ecplistsrch.lists["x_Wilayah_ECP"].options = <?php echo JsonEncode($dm_ecp_list->Wilayah_ECP->lookupOptions()) ?>;

	// Filters
	fdm_ecplistsrch.filterList = <?php echo $dm_ecp_list->getFilterList() ?>;
	loadjs.done("fdm_ecplistsrch");
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
<?php if (!$dm_ecp_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($dm_ecp_list->TotalRecords > 0 && $dm_ecp_list->ExportOptions->visible()) { ?>
<?php $dm_ecp_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($dm_ecp_list->ImportOptions->visible()) { ?>
<?php $dm_ecp_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($dm_ecp_list->SearchOptions->visible()) { ?>
<?php $dm_ecp_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($dm_ecp_list->FilterOptions->visible()) { ?>
<?php $dm_ecp_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$dm_ecp_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$dm_ecp_list->isExport() && !$dm_ecp->CurrentAction) { ?>
<form name="fdm_ecplistsrch" id="fdm_ecplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdm_ecplistsrch-search-panel" class="<?php echo $dm_ecp_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="dm_ecp">
	<div class="ew-extended-search">
<?php

// Render search row
$dm_ecp->RowType = ROWTYPE_SEARCH;
$dm_ecp->resetAttributes();
$dm_ecp_list->renderRow();
?>
<?php if ($dm_ecp_list->Wilayah_ECP->Visible) { // Wilayah_ECP ?>
	<?php
		$dm_ecp_list->SearchColumnCount++;
		if (($dm_ecp_list->SearchColumnCount - 1) % $dm_ecp_list->SearchFieldsPerRow == 0) {
			$dm_ecp_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $dm_ecp_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Wilayah_ECP" class="ew-cell form-group">
		<label for="x_Wilayah_ECP" class="ew-search-caption ew-label"><?php echo $dm_ecp_list->Wilayah_ECP->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Wilayah_ECP" id="z_Wilayah_ECP" value="LIKE">
</span>
		<span id="el_dm_ecp_Wilayah_ECP" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dm_ecp" data-field="x_Wilayah_ECP" data-value-separator="<?php echo $dm_ecp_list->Wilayah_ECP->displayValueSeparatorAttribute() ?>" id="x_Wilayah_ECP" name="x_Wilayah_ECP"<?php echo $dm_ecp_list->Wilayah_ECP->editAttributes() ?>>
			<?php echo $dm_ecp_list->Wilayah_ECP->selectOptionListHtml("x_Wilayah_ECP") ?>
		</select>
</div>
<?php echo $dm_ecp_list->Wilayah_ECP->Lookup->getParamTag($dm_ecp_list, "p_x_Wilayah_ECP") ?>
</span>
	</div>
	<?php if ($dm_ecp_list->SearchColumnCount % $dm_ecp_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($dm_ecp_list->Tahun_ECP->Visible) { // Tahun_ECP ?>
	<?php
		$dm_ecp_list->SearchColumnCount++;
		if (($dm_ecp_list->SearchColumnCount - 1) % $dm_ecp_list->SearchFieldsPerRow == 0) {
			$dm_ecp_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $dm_ecp_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Tahun_ECP" class="ew-cell form-group">
		<label for="x_Tahun_ECP" class="ew-search-caption ew-label"><?php echo $dm_ecp_list->Tahun_ECP->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Tahun_ECP" id="z_Tahun_ECP" value="=">
</span>
		<span id="el_dm_ecp_Tahun_ECP" class="ew-search-field">
<input type="text" data-table="dm_ecp" data-field="x_Tahun_ECP" name="x_Tahun_ECP" id="x_Tahun_ECP" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($dm_ecp_list->Tahun_ECP->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Tahun_ECP->EditValue ?>"<?php echo $dm_ecp_list->Tahun_ECP->editAttributes() ?>>
</span>
	</div>
	<?php if ($dm_ecp_list->SearchColumnCount % $dm_ecp_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($dm_ecp_list->SearchColumnCount % $dm_ecp_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $dm_ecp_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($dm_ecp_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($dm_ecp_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $dm_ecp_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($dm_ecp_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($dm_ecp_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($dm_ecp_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($dm_ecp_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $dm_ecp_list->showPageHeader(); ?>
<?php
$dm_ecp_list->showMessage();
?>
<?php if ($dm_ecp_list->TotalRecords > 0 || $dm_ecp->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($dm_ecp_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> dm_ecp">
<form name="fdm_ecplist" id="fdm_ecplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dm_ecp">
<div id="gmp_dm_ecp" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($dm_ecp_list->TotalRecords > 0 || $dm_ecp_list->isGridEdit()) { ?>
<table id="tbl_dm_ecplist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$dm_ecp->RowType = ROWTYPE_HEADER;

// Render list options
$dm_ecp_list->renderListOptions();

// Render list options (header, left)
$dm_ecp_list->ListOptions->render("header", "left");
?>
<?php if ($dm_ecp_list->ID_ECP->Visible) { // ID_ECP ?>
	<?php if ($dm_ecp_list->SortUrl($dm_ecp_list->ID_ECP) == "") { ?>
		<th data-name="ID_ECP" class="<?php echo $dm_ecp_list->ID_ECP->headerCellClass() ?>"><div id="elh_dm_ecp_ID_ECP" class="dm_ecp_ID_ECP"><div class="ew-table-header-caption"><?php echo $dm_ecp_list->ID_ECP->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_ECP" class="<?php echo $dm_ecp_list->ID_ECP->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_ecp_list->SortUrl($dm_ecp_list->ID_ECP) ?>', 1);"><div id="elh_dm_ecp_ID_ECP" class="dm_ecp_ID_ECP">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_ecp_list->ID_ECP->caption() ?></span><span class="ew-table-header-sort"><?php if ($dm_ecp_list->ID_ECP->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_ecp_list->ID_ECP->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_ecp_list->Nama->Visible) { // Nama ?>
	<?php if ($dm_ecp_list->SortUrl($dm_ecp_list->Nama) == "") { ?>
		<th data-name="Nama" class="<?php echo $dm_ecp_list->Nama->headerCellClass() ?>"><div id="elh_dm_ecp_Nama" class="dm_ecp_Nama"><div class="ew-table-header-caption"><?php echo $dm_ecp_list->Nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nama" class="<?php echo $dm_ecp_list->Nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_ecp_list->SortUrl($dm_ecp_list->Nama) ?>', 1);"><div id="elh_dm_ecp_Nama" class="dm_ecp_Nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_ecp_list->Nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dm_ecp_list->Nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_ecp_list->Nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_ecp_list->Perusahaan->Visible) { // Perusahaan ?>
	<?php if ($dm_ecp_list->SortUrl($dm_ecp_list->Perusahaan) == "") { ?>
		<th data-name="Perusahaan" class="<?php echo $dm_ecp_list->Perusahaan->headerCellClass() ?>"><div id="elh_dm_ecp_Perusahaan" class="dm_ecp_Perusahaan"><div class="ew-table-header-caption"><?php echo $dm_ecp_list->Perusahaan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Perusahaan" class="<?php echo $dm_ecp_list->Perusahaan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_ecp_list->SortUrl($dm_ecp_list->Perusahaan) ?>', 1);"><div id="elh_dm_ecp_Perusahaan" class="dm_ecp_Perusahaan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_ecp_list->Perusahaan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dm_ecp_list->Perusahaan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_ecp_list->Perusahaan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_ecp_list->Daerah->Visible) { // Daerah ?>
	<?php if ($dm_ecp_list->SortUrl($dm_ecp_list->Daerah) == "") { ?>
		<th data-name="Daerah" class="<?php echo $dm_ecp_list->Daerah->headerCellClass() ?>"><div id="elh_dm_ecp_Daerah" class="dm_ecp_Daerah"><div class="ew-table-header-caption"><?php echo $dm_ecp_list->Daerah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Daerah" class="<?php echo $dm_ecp_list->Daerah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_ecp_list->SortUrl($dm_ecp_list->Daerah) ?>', 1);"><div id="elh_dm_ecp_Daerah" class="dm_ecp_Daerah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_ecp_list->Daerah->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dm_ecp_list->Daerah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_ecp_list->Daerah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_ecp_list->Produk->Visible) { // Produk ?>
	<?php if ($dm_ecp_list->SortUrl($dm_ecp_list->Produk) == "") { ?>
		<th data-name="Produk" class="<?php echo $dm_ecp_list->Produk->headerCellClass() ?>"><div id="elh_dm_ecp_Produk" class="dm_ecp_Produk"><div class="ew-table-header-caption"><?php echo $dm_ecp_list->Produk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Produk" class="<?php echo $dm_ecp_list->Produk->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_ecp_list->SortUrl($dm_ecp_list->Produk) ?>', 1);"><div id="elh_dm_ecp_Produk" class="dm_ecp_Produk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_ecp_list->Produk->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dm_ecp_list->Produk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_ecp_list->Produk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_ecp_list->Tgl_Bln_Ekspor->Visible) { // Tgl_Bln_Ekspor ?>
	<?php if ($dm_ecp_list->SortUrl($dm_ecp_list->Tgl_Bln_Ekspor) == "") { ?>
		<th data-name="Tgl_Bln_Ekspor" class="<?php echo $dm_ecp_list->Tgl_Bln_Ekspor->headerCellClass() ?>"><div id="elh_dm_ecp_Tgl_Bln_Ekspor" class="dm_ecp_Tgl_Bln_Ekspor"><div class="ew-table-header-caption"><?php echo $dm_ecp_list->Tgl_Bln_Ekspor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tgl_Bln_Ekspor" class="<?php echo $dm_ecp_list->Tgl_Bln_Ekspor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_ecp_list->SortUrl($dm_ecp_list->Tgl_Bln_Ekspor) ?>', 1);"><div id="elh_dm_ecp_Tgl_Bln_Ekspor" class="dm_ecp_Tgl_Bln_Ekspor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_ecp_list->Tgl_Bln_Ekspor->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dm_ecp_list->Tgl_Bln_Ekspor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_ecp_list->Tgl_Bln_Ekspor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_ecp_list->Negara_Tujuan->Visible) { // Negara_Tujuan ?>
	<?php if ($dm_ecp_list->SortUrl($dm_ecp_list->Negara_Tujuan) == "") { ?>
		<th data-name="Negara_Tujuan" class="<?php echo $dm_ecp_list->Negara_Tujuan->headerCellClass() ?>"><div id="elh_dm_ecp_Negara_Tujuan" class="dm_ecp_Negara_Tujuan"><div class="ew-table-header-caption"><?php echo $dm_ecp_list->Negara_Tujuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Negara_Tujuan" class="<?php echo $dm_ecp_list->Negara_Tujuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_ecp_list->SortUrl($dm_ecp_list->Negara_Tujuan) ?>', 1);"><div id="elh_dm_ecp_Negara_Tujuan" class="dm_ecp_Negara_Tujuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_ecp_list->Negara_Tujuan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dm_ecp_list->Negara_Tujuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_ecp_list->Negara_Tujuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_ecp_list->Nilai_Ekspor_USD->Visible) { // Nilai_Ekspor_USD ?>
	<?php if ($dm_ecp_list->SortUrl($dm_ecp_list->Nilai_Ekspor_USD) == "") { ?>
		<th data-name="Nilai_Ekspor_USD" class="<?php echo $dm_ecp_list->Nilai_Ekspor_USD->headerCellClass() ?>"><div id="elh_dm_ecp_Nilai_Ekspor_USD" class="dm_ecp_Nilai_Ekspor_USD"><div class="ew-table-header-caption"><?php echo $dm_ecp_list->Nilai_Ekspor_USD->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nilai_Ekspor_USD" class="<?php echo $dm_ecp_list->Nilai_Ekspor_USD->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_ecp_list->SortUrl($dm_ecp_list->Nilai_Ekspor_USD) ?>', 1);"><div id="elh_dm_ecp_Nilai_Ekspor_USD" class="dm_ecp_Nilai_Ekspor_USD">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_ecp_list->Nilai_Ekspor_USD->caption() ?></span><span class="ew-table-header-sort"><?php if ($dm_ecp_list->Nilai_Ekspor_USD->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_ecp_list->Nilai_Ekspor_USD->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_ecp_list->Nilai_Ekspor_Rupiah->Visible) { // Nilai_Ekspor_Rupiah ?>
	<?php if ($dm_ecp_list->SortUrl($dm_ecp_list->Nilai_Ekspor_Rupiah) == "") { ?>
		<th data-name="Nilai_Ekspor_Rupiah" class="<?php echo $dm_ecp_list->Nilai_Ekspor_Rupiah->headerCellClass() ?>"><div id="elh_dm_ecp_Nilai_Ekspor_Rupiah" class="dm_ecp_Nilai_Ekspor_Rupiah"><div class="ew-table-header-caption"><?php echo $dm_ecp_list->Nilai_Ekspor_Rupiah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nilai_Ekspor_Rupiah" class="<?php echo $dm_ecp_list->Nilai_Ekspor_Rupiah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_ecp_list->SortUrl($dm_ecp_list->Nilai_Ekspor_Rupiah) ?>', 1);"><div id="elh_dm_ecp_Nilai_Ekspor_Rupiah" class="dm_ecp_Nilai_Ekspor_Rupiah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_ecp_list->Nilai_Ekspor_Rupiah->caption() ?></span><span class="ew-table-header-sort"><?php if ($dm_ecp_list->Nilai_Ekspor_Rupiah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_ecp_list->Nilai_Ekspor_Rupiah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_ecp_list->Keterangan->Visible) { // Keterangan ?>
	<?php if ($dm_ecp_list->SortUrl($dm_ecp_list->Keterangan) == "") { ?>
		<th data-name="Keterangan" class="<?php echo $dm_ecp_list->Keterangan->headerCellClass() ?>"><div id="elh_dm_ecp_Keterangan" class="dm_ecp_Keterangan"><div class="ew-table-header-caption"><?php echo $dm_ecp_list->Keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Keterangan" class="<?php echo $dm_ecp_list->Keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_ecp_list->SortUrl($dm_ecp_list->Keterangan) ?>', 1);"><div id="elh_dm_ecp_Keterangan" class="dm_ecp_Keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_ecp_list->Keterangan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dm_ecp_list->Keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_ecp_list->Keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_ecp_list->Wilayah_ECP->Visible) { // Wilayah_ECP ?>
	<?php if ($dm_ecp_list->SortUrl($dm_ecp_list->Wilayah_ECP) == "") { ?>
		<th data-name="Wilayah_ECP" class="<?php echo $dm_ecp_list->Wilayah_ECP->headerCellClass() ?>"><div id="elh_dm_ecp_Wilayah_ECP" class="dm_ecp_Wilayah_ECP"><div class="ew-table-header-caption"><?php echo $dm_ecp_list->Wilayah_ECP->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Wilayah_ECP" class="<?php echo $dm_ecp_list->Wilayah_ECP->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_ecp_list->SortUrl($dm_ecp_list->Wilayah_ECP) ?>', 1);"><div id="elh_dm_ecp_Wilayah_ECP" class="dm_ecp_Wilayah_ECP">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_ecp_list->Wilayah_ECP->caption() ?></span><span class="ew-table-header-sort"><?php if ($dm_ecp_list->Wilayah_ECP->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_ecp_list->Wilayah_ECP->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_ecp_list->Tahun_ECP->Visible) { // Tahun_ECP ?>
	<?php if ($dm_ecp_list->SortUrl($dm_ecp_list->Tahun_ECP) == "") { ?>
		<th data-name="Tahun_ECP" class="<?php echo $dm_ecp_list->Tahun_ECP->headerCellClass() ?>"><div id="elh_dm_ecp_Tahun_ECP" class="dm_ecp_Tahun_ECP"><div class="ew-table-header-caption"><?php echo $dm_ecp_list->Tahun_ECP->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tahun_ECP" class="<?php echo $dm_ecp_list->Tahun_ECP->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_ecp_list->SortUrl($dm_ecp_list->Tahun_ECP) ?>', 1);"><div id="elh_dm_ecp_Tahun_ECP" class="dm_ecp_Tahun_ECP">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_ecp_list->Tahun_ECP->caption() ?></span><span class="ew-table-header-sort"><?php if ($dm_ecp_list->Tahun_ECP->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_ecp_list->Tahun_ECP->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$dm_ecp_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($dm_ecp_list->ExportAll && $dm_ecp_list->isExport()) {
	$dm_ecp_list->StopRecord = $dm_ecp_list->TotalRecords;
} else {

	// Set the last record to display
	if ($dm_ecp_list->TotalRecords > $dm_ecp_list->StartRecord + $dm_ecp_list->DisplayRecords - 1)
		$dm_ecp_list->StopRecord = $dm_ecp_list->StartRecord + $dm_ecp_list->DisplayRecords - 1;
	else
		$dm_ecp_list->StopRecord = $dm_ecp_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($dm_ecp->isConfirm() || $dm_ecp_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($dm_ecp_list->FormKeyCountName) && ($dm_ecp_list->isGridAdd() || $dm_ecp_list->isGridEdit() || $dm_ecp->isConfirm())) {
		$dm_ecp_list->KeyCount = $CurrentForm->getValue($dm_ecp_list->FormKeyCountName);
		$dm_ecp_list->StopRecord = $dm_ecp_list->StartRecord + $dm_ecp_list->KeyCount - 1;
	}
}
$dm_ecp_list->RecordCount = $dm_ecp_list->StartRecord - 1;
if ($dm_ecp_list->Recordset && !$dm_ecp_list->Recordset->EOF) {
	$dm_ecp_list->Recordset->moveFirst();
	$selectLimit = $dm_ecp_list->UseSelectLimit;
	if (!$selectLimit && $dm_ecp_list->StartRecord > 1)
		$dm_ecp_list->Recordset->move($dm_ecp_list->StartRecord - 1);
} elseif (!$dm_ecp->AllowAddDeleteRow && $dm_ecp_list->StopRecord == 0) {
	$dm_ecp_list->StopRecord = $dm_ecp->GridAddRowCount;
}

// Initialize aggregate
$dm_ecp->RowType = ROWTYPE_AGGREGATEINIT;
$dm_ecp->resetAttributes();
$dm_ecp_list->renderRow();
if ($dm_ecp_list->isGridAdd())
	$dm_ecp_list->RowIndex = 0;
if ($dm_ecp_list->isGridEdit())
	$dm_ecp_list->RowIndex = 0;
while ($dm_ecp_list->RecordCount < $dm_ecp_list->StopRecord) {
	$dm_ecp_list->RecordCount++;
	if ($dm_ecp_list->RecordCount >= $dm_ecp_list->StartRecord) {
		$dm_ecp_list->RowCount++;
		if ($dm_ecp_list->isGridAdd() || $dm_ecp_list->isGridEdit() || $dm_ecp->isConfirm()) {
			$dm_ecp_list->RowIndex++;
			$CurrentForm->Index = $dm_ecp_list->RowIndex;
			if ($CurrentForm->hasValue($dm_ecp_list->FormActionName) && ($dm_ecp->isConfirm() || $dm_ecp_list->EventCancelled))
				$dm_ecp_list->RowAction = strval($CurrentForm->getValue($dm_ecp_list->FormActionName));
			elseif ($dm_ecp_list->isGridAdd())
				$dm_ecp_list->RowAction = "insert";
			else
				$dm_ecp_list->RowAction = "";
		}

		// Set up key count
		$dm_ecp_list->KeyCount = $dm_ecp_list->RowIndex;

		// Init row class and style
		$dm_ecp->resetAttributes();
		$dm_ecp->CssClass = "";
		if ($dm_ecp_list->isGridAdd()) {
			$dm_ecp_list->loadRowValues(); // Load default values
		} else {
			$dm_ecp_list->loadRowValues($dm_ecp_list->Recordset); // Load row values
		}
		$dm_ecp->RowType = ROWTYPE_VIEW; // Render view
		if ($dm_ecp_list->isGridAdd()) // Grid add
			$dm_ecp->RowType = ROWTYPE_ADD; // Render add
		if ($dm_ecp_list->isGridAdd() && $dm_ecp->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$dm_ecp_list->restoreCurrentRowFormValues($dm_ecp_list->RowIndex); // Restore form values
		if ($dm_ecp_list->isGridEdit()) { // Grid edit
			if ($dm_ecp->EventCancelled)
				$dm_ecp_list->restoreCurrentRowFormValues($dm_ecp_list->RowIndex); // Restore form values
			if ($dm_ecp_list->RowAction == "insert")
				$dm_ecp->RowType = ROWTYPE_ADD; // Render add
			else
				$dm_ecp->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($dm_ecp_list->isGridEdit() && ($dm_ecp->RowType == ROWTYPE_EDIT || $dm_ecp->RowType == ROWTYPE_ADD) && $dm_ecp->EventCancelled) // Update failed
			$dm_ecp_list->restoreCurrentRowFormValues($dm_ecp_list->RowIndex); // Restore form values
		if ($dm_ecp->RowType == ROWTYPE_EDIT) // Edit row
			$dm_ecp_list->EditRowCount++;

		// Set up row id / data-rowindex
		$dm_ecp->RowAttrs->merge(["data-rowindex" => $dm_ecp_list->RowCount, "id" => "r" . $dm_ecp_list->RowCount . "_dm_ecp", "data-rowtype" => $dm_ecp->RowType]);

		// Render row
		$dm_ecp_list->renderRow();

		// Render list options
		$dm_ecp_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($dm_ecp_list->RowAction != "delete" && $dm_ecp_list->RowAction != "insertdelete" && !($dm_ecp_list->RowAction == "insert" && $dm_ecp->isConfirm() && $dm_ecp_list->emptyRow())) {
?>
	<tr <?php echo $dm_ecp->rowAttributes() ?>>
<?php

// Render list options (body, left)
$dm_ecp_list->ListOptions->render("body", "left", $dm_ecp_list->RowCount);
?>
	<?php if ($dm_ecp_list->ID_ECP->Visible) { // ID_ECP ?>
		<td data-name="ID_ECP" <?php echo $dm_ecp_list->ID_ECP->cellAttributes() ?>>
<?php if ($dm_ecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_ID_ECP" class="form-group"></span>
<input type="hidden" data-table="dm_ecp" data-field="x_ID_ECP" name="o<?php echo $dm_ecp_list->RowIndex ?>_ID_ECP" id="o<?php echo $dm_ecp_list->RowIndex ?>_ID_ECP" value="<?php echo HtmlEncode($dm_ecp_list->ID_ECP->OldValue) ?>">
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_ID_ECP" class="form-group">
<span<?php echo $dm_ecp_list->ID_ECP->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dm_ecp_list->ID_ECP->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_ID_ECP" name="x<?php echo $dm_ecp_list->RowIndex ?>_ID_ECP" id="x<?php echo $dm_ecp_list->RowIndex ?>_ID_ECP" value="<?php echo HtmlEncode($dm_ecp_list->ID_ECP->CurrentValue) ?>">
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_ID_ECP">
<span<?php echo $dm_ecp_list->ID_ECP->viewAttributes() ?>><?php echo $dm_ecp_list->ID_ECP->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_ecp_list->Nama->Visible) { // Nama ?>
		<td data-name="Nama" <?php echo $dm_ecp_list->Nama->cellAttributes() ?>>
<?php if ($dm_ecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Nama" class="form-group">
<?php
$onchange = $dm_ecp_list->Nama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$dm_ecp_list->Nama->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $dm_ecp_list->RowIndex ?>_Nama">
	<input type="text" class="form-control" name="sv_x<?php echo $dm_ecp_list->RowIndex ?>_Nama" id="sv_x<?php echo $dm_ecp_list->RowIndex ?>_Nama" value="<?php echo RemoveHtml($dm_ecp_list->Nama->EditValue) ?>" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($dm_ecp_list->Nama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($dm_ecp_list->Nama->getPlaceHolder()) ?>"<?php echo $dm_ecp_list->Nama->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Nama" data-value-separator="<?php echo $dm_ecp_list->Nama->displayValueSeparatorAttribute() ?>" name="x<?php echo $dm_ecp_list->RowIndex ?>_Nama" id="x<?php echo $dm_ecp_list->RowIndex ?>_Nama" value="<?php echo HtmlEncode($dm_ecp_list->Nama->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdm_ecplist"], function() {
	fdm_ecplist.createAutoSuggest({"id":"x<?php echo $dm_ecp_list->RowIndex ?>_Nama","forceSelect":false});
});
</script>
<?php echo $dm_ecp_list->Nama->Lookup->getParamTag($dm_ecp_list, "p_x" . $dm_ecp_list->RowIndex . "_Nama") ?>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Nama" name="o<?php echo $dm_ecp_list->RowIndex ?>_Nama" id="o<?php echo $dm_ecp_list->RowIndex ?>_Nama" value="<?php echo HtmlEncode($dm_ecp_list->Nama->OldValue) ?>">
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Nama" class="form-group">
<?php
$onchange = $dm_ecp_list->Nama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$dm_ecp_list->Nama->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $dm_ecp_list->RowIndex ?>_Nama">
	<input type="text" class="form-control" name="sv_x<?php echo $dm_ecp_list->RowIndex ?>_Nama" id="sv_x<?php echo $dm_ecp_list->RowIndex ?>_Nama" value="<?php echo RemoveHtml($dm_ecp_list->Nama->EditValue) ?>" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($dm_ecp_list->Nama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($dm_ecp_list->Nama->getPlaceHolder()) ?>"<?php echo $dm_ecp_list->Nama->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Nama" data-value-separator="<?php echo $dm_ecp_list->Nama->displayValueSeparatorAttribute() ?>" name="x<?php echo $dm_ecp_list->RowIndex ?>_Nama" id="x<?php echo $dm_ecp_list->RowIndex ?>_Nama" value="<?php echo HtmlEncode($dm_ecp_list->Nama->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdm_ecplist"], function() {
	fdm_ecplist.createAutoSuggest({"id":"x<?php echo $dm_ecp_list->RowIndex ?>_Nama","forceSelect":false});
});
</script>
<?php echo $dm_ecp_list->Nama->Lookup->getParamTag($dm_ecp_list, "p_x" . $dm_ecp_list->RowIndex . "_Nama") ?>
</span>
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Nama">
<span<?php echo $dm_ecp_list->Nama->viewAttributes() ?>><?php echo $dm_ecp_list->Nama->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_ecp_list->Perusahaan->Visible) { // Perusahaan ?>
		<td data-name="Perusahaan" <?php echo $dm_ecp_list->Perusahaan->cellAttributes() ?>>
<?php if ($dm_ecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Perusahaan" class="form-group">
<?php
$onchange = $dm_ecp_list->Perusahaan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$dm_ecp_list->Perusahaan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $dm_ecp_list->RowIndex ?>_Perusahaan">
	<input type="text" class="form-control" name="sv_x<?php echo $dm_ecp_list->RowIndex ?>_Perusahaan" id="sv_x<?php echo $dm_ecp_list->RowIndex ?>_Perusahaan" value="<?php echo RemoveHtml($dm_ecp_list->Perusahaan->EditValue) ?>" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_ecp_list->Perusahaan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($dm_ecp_list->Perusahaan->getPlaceHolder()) ?>"<?php echo $dm_ecp_list->Perusahaan->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Perusahaan" data-value-separator="<?php echo $dm_ecp_list->Perusahaan->displayValueSeparatorAttribute() ?>" name="x<?php echo $dm_ecp_list->RowIndex ?>_Perusahaan" id="x<?php echo $dm_ecp_list->RowIndex ?>_Perusahaan" value="<?php echo HtmlEncode($dm_ecp_list->Perusahaan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdm_ecplist"], function() {
	fdm_ecplist.createAutoSuggest({"id":"x<?php echo $dm_ecp_list->RowIndex ?>_Perusahaan","forceSelect":false});
});
</script>
<?php echo $dm_ecp_list->Perusahaan->Lookup->getParamTag($dm_ecp_list, "p_x" . $dm_ecp_list->RowIndex . "_Perusahaan") ?>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Perusahaan" name="o<?php echo $dm_ecp_list->RowIndex ?>_Perusahaan" id="o<?php echo $dm_ecp_list->RowIndex ?>_Perusahaan" value="<?php echo HtmlEncode($dm_ecp_list->Perusahaan->OldValue) ?>">
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Perusahaan" class="form-group">
<?php
$onchange = $dm_ecp_list->Perusahaan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$dm_ecp_list->Perusahaan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $dm_ecp_list->RowIndex ?>_Perusahaan">
	<input type="text" class="form-control" name="sv_x<?php echo $dm_ecp_list->RowIndex ?>_Perusahaan" id="sv_x<?php echo $dm_ecp_list->RowIndex ?>_Perusahaan" value="<?php echo RemoveHtml($dm_ecp_list->Perusahaan->EditValue) ?>" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_ecp_list->Perusahaan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($dm_ecp_list->Perusahaan->getPlaceHolder()) ?>"<?php echo $dm_ecp_list->Perusahaan->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Perusahaan" data-value-separator="<?php echo $dm_ecp_list->Perusahaan->displayValueSeparatorAttribute() ?>" name="x<?php echo $dm_ecp_list->RowIndex ?>_Perusahaan" id="x<?php echo $dm_ecp_list->RowIndex ?>_Perusahaan" value="<?php echo HtmlEncode($dm_ecp_list->Perusahaan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdm_ecplist"], function() {
	fdm_ecplist.createAutoSuggest({"id":"x<?php echo $dm_ecp_list->RowIndex ?>_Perusahaan","forceSelect":false});
});
</script>
<?php echo $dm_ecp_list->Perusahaan->Lookup->getParamTag($dm_ecp_list, "p_x" . $dm_ecp_list->RowIndex . "_Perusahaan") ?>
</span>
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Perusahaan">
<span<?php echo $dm_ecp_list->Perusahaan->viewAttributes() ?>><?php echo $dm_ecp_list->Perusahaan->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_ecp_list->Daerah->Visible) { // Daerah ?>
		<td data-name="Daerah" <?php echo $dm_ecp_list->Daerah->cellAttributes() ?>>
<?php if ($dm_ecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Daerah" class="form-group">
<input type="text" data-table="dm_ecp" data-field="x_Daerah" name="x<?php echo $dm_ecp_list->RowIndex ?>_Daerah" id="x<?php echo $dm_ecp_list->RowIndex ?>_Daerah" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_ecp_list->Daerah->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Daerah->EditValue ?>"<?php echo $dm_ecp_list->Daerah->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Daerah" name="o<?php echo $dm_ecp_list->RowIndex ?>_Daerah" id="o<?php echo $dm_ecp_list->RowIndex ?>_Daerah" value="<?php echo HtmlEncode($dm_ecp_list->Daerah->OldValue) ?>">
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Daerah" class="form-group">
<input type="text" data-table="dm_ecp" data-field="x_Daerah" name="x<?php echo $dm_ecp_list->RowIndex ?>_Daerah" id="x<?php echo $dm_ecp_list->RowIndex ?>_Daerah" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_ecp_list->Daerah->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Daerah->EditValue ?>"<?php echo $dm_ecp_list->Daerah->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Daerah">
<span<?php echo $dm_ecp_list->Daerah->viewAttributes() ?>><?php echo $dm_ecp_list->Daerah->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_ecp_list->Produk->Visible) { // Produk ?>
		<td data-name="Produk" <?php echo $dm_ecp_list->Produk->cellAttributes() ?>>
<?php if ($dm_ecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Produk" class="form-group">
<input type="text" data-table="dm_ecp" data-field="x_Produk" name="x<?php echo $dm_ecp_list->RowIndex ?>_Produk" id="x<?php echo $dm_ecp_list->RowIndex ?>_Produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_ecp_list->Produk->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Produk->EditValue ?>"<?php echo $dm_ecp_list->Produk->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Produk" name="o<?php echo $dm_ecp_list->RowIndex ?>_Produk" id="o<?php echo $dm_ecp_list->RowIndex ?>_Produk" value="<?php echo HtmlEncode($dm_ecp_list->Produk->OldValue) ?>">
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Produk" class="form-group">
<input type="text" data-table="dm_ecp" data-field="x_Produk" name="x<?php echo $dm_ecp_list->RowIndex ?>_Produk" id="x<?php echo $dm_ecp_list->RowIndex ?>_Produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_ecp_list->Produk->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Produk->EditValue ?>"<?php echo $dm_ecp_list->Produk->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Produk">
<span<?php echo $dm_ecp_list->Produk->viewAttributes() ?>><?php echo $dm_ecp_list->Produk->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_ecp_list->Tgl_Bln_Ekspor->Visible) { // Tgl_Bln_Ekspor ?>
		<td data-name="Tgl_Bln_Ekspor" <?php echo $dm_ecp_list->Tgl_Bln_Ekspor->cellAttributes() ?>>
<?php if ($dm_ecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Tgl_Bln_Ekspor" class="form-group">
<input type="text" data-table="dm_ecp" data-field="x_Tgl_Bln_Ekspor" name="x<?php echo $dm_ecp_list->RowIndex ?>_Tgl_Bln_Ekspor" id="x<?php echo $dm_ecp_list->RowIndex ?>_Tgl_Bln_Ekspor" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($dm_ecp_list->Tgl_Bln_Ekspor->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Tgl_Bln_Ekspor->EditValue ?>"<?php echo $dm_ecp_list->Tgl_Bln_Ekspor->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Tgl_Bln_Ekspor" name="o<?php echo $dm_ecp_list->RowIndex ?>_Tgl_Bln_Ekspor" id="o<?php echo $dm_ecp_list->RowIndex ?>_Tgl_Bln_Ekspor" value="<?php echo HtmlEncode($dm_ecp_list->Tgl_Bln_Ekspor->OldValue) ?>">
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Tgl_Bln_Ekspor" class="form-group">
<input type="text" data-table="dm_ecp" data-field="x_Tgl_Bln_Ekspor" name="x<?php echo $dm_ecp_list->RowIndex ?>_Tgl_Bln_Ekspor" id="x<?php echo $dm_ecp_list->RowIndex ?>_Tgl_Bln_Ekspor" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($dm_ecp_list->Tgl_Bln_Ekspor->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Tgl_Bln_Ekspor->EditValue ?>"<?php echo $dm_ecp_list->Tgl_Bln_Ekspor->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Tgl_Bln_Ekspor">
<span<?php echo $dm_ecp_list->Tgl_Bln_Ekspor->viewAttributes() ?>><?php echo $dm_ecp_list->Tgl_Bln_Ekspor->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_ecp_list->Negara_Tujuan->Visible) { // Negara_Tujuan ?>
		<td data-name="Negara_Tujuan" <?php echo $dm_ecp_list->Negara_Tujuan->cellAttributes() ?>>
<?php if ($dm_ecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Negara_Tujuan" class="form-group">
<input type="text" data-table="dm_ecp" data-field="x_Negara_Tujuan" name="x<?php echo $dm_ecp_list->RowIndex ?>_Negara_Tujuan" id="x<?php echo $dm_ecp_list->RowIndex ?>_Negara_Tujuan" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_ecp_list->Negara_Tujuan->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Negara_Tujuan->EditValue ?>"<?php echo $dm_ecp_list->Negara_Tujuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Negara_Tujuan" name="o<?php echo $dm_ecp_list->RowIndex ?>_Negara_Tujuan" id="o<?php echo $dm_ecp_list->RowIndex ?>_Negara_Tujuan" value="<?php echo HtmlEncode($dm_ecp_list->Negara_Tujuan->OldValue) ?>">
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Negara_Tujuan" class="form-group">
<input type="text" data-table="dm_ecp" data-field="x_Negara_Tujuan" name="x<?php echo $dm_ecp_list->RowIndex ?>_Negara_Tujuan" id="x<?php echo $dm_ecp_list->RowIndex ?>_Negara_Tujuan" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_ecp_list->Negara_Tujuan->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Negara_Tujuan->EditValue ?>"<?php echo $dm_ecp_list->Negara_Tujuan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Negara_Tujuan">
<span<?php echo $dm_ecp_list->Negara_Tujuan->viewAttributes() ?>><?php echo $dm_ecp_list->Negara_Tujuan->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_ecp_list->Nilai_Ekspor_USD->Visible) { // Nilai_Ekspor_USD ?>
		<td data-name="Nilai_Ekspor_USD" <?php echo $dm_ecp_list->Nilai_Ekspor_USD->cellAttributes() ?>>
<?php if ($dm_ecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Nilai_Ekspor_USD" class="form-group">
<input type="text" data-table="dm_ecp" data-field="x_Nilai_Ekspor_USD" name="x<?php echo $dm_ecp_list->RowIndex ?>_Nilai_Ekspor_USD" id="x<?php echo $dm_ecp_list->RowIndex ?>_Nilai_Ekspor_USD" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($dm_ecp_list->Nilai_Ekspor_USD->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Nilai_Ekspor_USD->EditValue ?>"<?php echo $dm_ecp_list->Nilai_Ekspor_USD->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Nilai_Ekspor_USD" name="o<?php echo $dm_ecp_list->RowIndex ?>_Nilai_Ekspor_USD" id="o<?php echo $dm_ecp_list->RowIndex ?>_Nilai_Ekspor_USD" value="<?php echo HtmlEncode($dm_ecp_list->Nilai_Ekspor_USD->OldValue) ?>">
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Nilai_Ekspor_USD" class="form-group">
<input type="text" data-table="dm_ecp" data-field="x_Nilai_Ekspor_USD" name="x<?php echo $dm_ecp_list->RowIndex ?>_Nilai_Ekspor_USD" id="x<?php echo $dm_ecp_list->RowIndex ?>_Nilai_Ekspor_USD" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($dm_ecp_list->Nilai_Ekspor_USD->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Nilai_Ekspor_USD->EditValue ?>"<?php echo $dm_ecp_list->Nilai_Ekspor_USD->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Nilai_Ekspor_USD">
<span<?php echo $dm_ecp_list->Nilai_Ekspor_USD->viewAttributes() ?>><?php echo $dm_ecp_list->Nilai_Ekspor_USD->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_ecp_list->Nilai_Ekspor_Rupiah->Visible) { // Nilai_Ekspor_Rupiah ?>
		<td data-name="Nilai_Ekspor_Rupiah" <?php echo $dm_ecp_list->Nilai_Ekspor_Rupiah->cellAttributes() ?>>
<?php if ($dm_ecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Nilai_Ekspor_Rupiah" class="form-group">
<input type="text" data-table="dm_ecp" data-field="x_Nilai_Ekspor_Rupiah" name="x<?php echo $dm_ecp_list->RowIndex ?>_Nilai_Ekspor_Rupiah" id="x<?php echo $dm_ecp_list->RowIndex ?>_Nilai_Ekspor_Rupiah" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($dm_ecp_list->Nilai_Ekspor_Rupiah->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Nilai_Ekspor_Rupiah->EditValue ?>"<?php echo $dm_ecp_list->Nilai_Ekspor_Rupiah->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Nilai_Ekspor_Rupiah" name="o<?php echo $dm_ecp_list->RowIndex ?>_Nilai_Ekspor_Rupiah" id="o<?php echo $dm_ecp_list->RowIndex ?>_Nilai_Ekspor_Rupiah" value="<?php echo HtmlEncode($dm_ecp_list->Nilai_Ekspor_Rupiah->OldValue) ?>">
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Nilai_Ekspor_Rupiah" class="form-group">
<input type="text" data-table="dm_ecp" data-field="x_Nilai_Ekspor_Rupiah" name="x<?php echo $dm_ecp_list->RowIndex ?>_Nilai_Ekspor_Rupiah" id="x<?php echo $dm_ecp_list->RowIndex ?>_Nilai_Ekspor_Rupiah" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($dm_ecp_list->Nilai_Ekspor_Rupiah->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Nilai_Ekspor_Rupiah->EditValue ?>"<?php echo $dm_ecp_list->Nilai_Ekspor_Rupiah->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Nilai_Ekspor_Rupiah">
<span<?php echo $dm_ecp_list->Nilai_Ekspor_Rupiah->viewAttributes() ?>><?php echo $dm_ecp_list->Nilai_Ekspor_Rupiah->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_ecp_list->Keterangan->Visible) { // Keterangan ?>
		<td data-name="Keterangan" <?php echo $dm_ecp_list->Keterangan->cellAttributes() ?>>
<?php if ($dm_ecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Keterangan" class="form-group">
<input type="text" data-table="dm_ecp" data-field="x_Keterangan" name="x<?php echo $dm_ecp_list->RowIndex ?>_Keterangan" id="x<?php echo $dm_ecp_list->RowIndex ?>_Keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_ecp_list->Keterangan->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Keterangan->EditValue ?>"<?php echo $dm_ecp_list->Keterangan->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Keterangan" name="o<?php echo $dm_ecp_list->RowIndex ?>_Keterangan" id="o<?php echo $dm_ecp_list->RowIndex ?>_Keterangan" value="<?php echo HtmlEncode($dm_ecp_list->Keterangan->OldValue) ?>">
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Keterangan" class="form-group">
<input type="text" data-table="dm_ecp" data-field="x_Keterangan" name="x<?php echo $dm_ecp_list->RowIndex ?>_Keterangan" id="x<?php echo $dm_ecp_list->RowIndex ?>_Keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_ecp_list->Keterangan->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Keterangan->EditValue ?>"<?php echo $dm_ecp_list->Keterangan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Keterangan">
<span<?php echo $dm_ecp_list->Keterangan->viewAttributes() ?>><?php echo $dm_ecp_list->Keterangan->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_ecp_list->Wilayah_ECP->Visible) { // Wilayah_ECP ?>
		<td data-name="Wilayah_ECP" <?php echo $dm_ecp_list->Wilayah_ECP->cellAttributes() ?>>
<?php if ($dm_ecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Wilayah_ECP" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dm_ecp" data-field="x_Wilayah_ECP" data-value-separator="<?php echo $dm_ecp_list->Wilayah_ECP->displayValueSeparatorAttribute() ?>" id="x<?php echo $dm_ecp_list->RowIndex ?>_Wilayah_ECP" name="x<?php echo $dm_ecp_list->RowIndex ?>_Wilayah_ECP"<?php echo $dm_ecp_list->Wilayah_ECP->editAttributes() ?>>
			<?php echo $dm_ecp_list->Wilayah_ECP->selectOptionListHtml("x{$dm_ecp_list->RowIndex}_Wilayah_ECP") ?>
		</select>
</div>
<?php echo $dm_ecp_list->Wilayah_ECP->Lookup->getParamTag($dm_ecp_list, "p_x" . $dm_ecp_list->RowIndex . "_Wilayah_ECP") ?>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Wilayah_ECP" name="o<?php echo $dm_ecp_list->RowIndex ?>_Wilayah_ECP" id="o<?php echo $dm_ecp_list->RowIndex ?>_Wilayah_ECP" value="<?php echo HtmlEncode($dm_ecp_list->Wilayah_ECP->OldValue) ?>">
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Wilayah_ECP" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dm_ecp" data-field="x_Wilayah_ECP" data-value-separator="<?php echo $dm_ecp_list->Wilayah_ECP->displayValueSeparatorAttribute() ?>" id="x<?php echo $dm_ecp_list->RowIndex ?>_Wilayah_ECP" name="x<?php echo $dm_ecp_list->RowIndex ?>_Wilayah_ECP"<?php echo $dm_ecp_list->Wilayah_ECP->editAttributes() ?>>
			<?php echo $dm_ecp_list->Wilayah_ECP->selectOptionListHtml("x{$dm_ecp_list->RowIndex}_Wilayah_ECP") ?>
		</select>
</div>
<?php echo $dm_ecp_list->Wilayah_ECP->Lookup->getParamTag($dm_ecp_list, "p_x" . $dm_ecp_list->RowIndex . "_Wilayah_ECP") ?>
</span>
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Wilayah_ECP">
<span<?php echo $dm_ecp_list->Wilayah_ECP->viewAttributes() ?>><?php echo $dm_ecp_list->Wilayah_ECP->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_ecp_list->Tahun_ECP->Visible) { // Tahun_ECP ?>
		<td data-name="Tahun_ECP" <?php echo $dm_ecp_list->Tahun_ECP->cellAttributes() ?>>
<?php if ($dm_ecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Tahun_ECP" class="form-group">
<input type="text" data-table="dm_ecp" data-field="x_Tahun_ECP" name="x<?php echo $dm_ecp_list->RowIndex ?>_Tahun_ECP" id="x<?php echo $dm_ecp_list->RowIndex ?>_Tahun_ECP" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($dm_ecp_list->Tahun_ECP->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Tahun_ECP->EditValue ?>"<?php echo $dm_ecp_list->Tahun_ECP->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Tahun_ECP" name="o<?php echo $dm_ecp_list->RowIndex ?>_Tahun_ECP" id="o<?php echo $dm_ecp_list->RowIndex ?>_Tahun_ECP" value="<?php echo HtmlEncode($dm_ecp_list->Tahun_ECP->OldValue) ?>">
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Tahun_ECP" class="form-group">
<input type="text" data-table="dm_ecp" data-field="x_Tahun_ECP" name="x<?php echo $dm_ecp_list->RowIndex ?>_Tahun_ECP" id="x<?php echo $dm_ecp_list->RowIndex ?>_Tahun_ECP" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($dm_ecp_list->Tahun_ECP->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Tahun_ECP->EditValue ?>"<?php echo $dm_ecp_list->Tahun_ECP->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dm_ecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_ecp_list->RowCount ?>_dm_ecp_Tahun_ECP">
<span<?php echo $dm_ecp_list->Tahun_ECP->viewAttributes() ?>><?php echo $dm_ecp_list->Tahun_ECP->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$dm_ecp_list->ListOptions->render("body", "right", $dm_ecp_list->RowCount);
?>
	</tr>
<?php if ($dm_ecp->RowType == ROWTYPE_ADD || $dm_ecp->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdm_ecplist", "load"], function() {
	fdm_ecplist.updateLists(<?php echo $dm_ecp_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$dm_ecp_list->isGridAdd())
		if (!$dm_ecp_list->Recordset->EOF)
			$dm_ecp_list->Recordset->moveNext();
}
?>
<?php
	if ($dm_ecp_list->isGridAdd() || $dm_ecp_list->isGridEdit()) {
		$dm_ecp_list->RowIndex = '$rowindex$';
		$dm_ecp_list->loadRowValues();

		// Set row properties
		$dm_ecp->resetAttributes();
		$dm_ecp->RowAttrs->merge(["data-rowindex" => $dm_ecp_list->RowIndex, "id" => "r0_dm_ecp", "data-rowtype" => ROWTYPE_ADD]);
		$dm_ecp->RowAttrs->appendClass("ew-template");
		$dm_ecp->RowType = ROWTYPE_ADD;

		// Render row
		$dm_ecp_list->renderRow();

		// Render list options
		$dm_ecp_list->renderListOptions();
		$dm_ecp_list->StartRowCount = 0;
?>
	<tr <?php echo $dm_ecp->rowAttributes() ?>>
<?php

// Render list options (body, left)
$dm_ecp_list->ListOptions->render("body", "left", $dm_ecp_list->RowIndex);
?>
	<?php if ($dm_ecp_list->ID_ECP->Visible) { // ID_ECP ?>
		<td data-name="ID_ECP">
<span id="el$rowindex$_dm_ecp_ID_ECP" class="form-group dm_ecp_ID_ECP"></span>
<input type="hidden" data-table="dm_ecp" data-field="x_ID_ECP" name="o<?php echo $dm_ecp_list->RowIndex ?>_ID_ECP" id="o<?php echo $dm_ecp_list->RowIndex ?>_ID_ECP" value="<?php echo HtmlEncode($dm_ecp_list->ID_ECP->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_ecp_list->Nama->Visible) { // Nama ?>
		<td data-name="Nama">
<span id="el$rowindex$_dm_ecp_Nama" class="form-group dm_ecp_Nama">
<?php
$onchange = $dm_ecp_list->Nama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$dm_ecp_list->Nama->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $dm_ecp_list->RowIndex ?>_Nama">
	<input type="text" class="form-control" name="sv_x<?php echo $dm_ecp_list->RowIndex ?>_Nama" id="sv_x<?php echo $dm_ecp_list->RowIndex ?>_Nama" value="<?php echo RemoveHtml($dm_ecp_list->Nama->EditValue) ?>" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($dm_ecp_list->Nama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($dm_ecp_list->Nama->getPlaceHolder()) ?>"<?php echo $dm_ecp_list->Nama->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Nama" data-value-separator="<?php echo $dm_ecp_list->Nama->displayValueSeparatorAttribute() ?>" name="x<?php echo $dm_ecp_list->RowIndex ?>_Nama" id="x<?php echo $dm_ecp_list->RowIndex ?>_Nama" value="<?php echo HtmlEncode($dm_ecp_list->Nama->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdm_ecplist"], function() {
	fdm_ecplist.createAutoSuggest({"id":"x<?php echo $dm_ecp_list->RowIndex ?>_Nama","forceSelect":false});
});
</script>
<?php echo $dm_ecp_list->Nama->Lookup->getParamTag($dm_ecp_list, "p_x" . $dm_ecp_list->RowIndex . "_Nama") ?>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Nama" name="o<?php echo $dm_ecp_list->RowIndex ?>_Nama" id="o<?php echo $dm_ecp_list->RowIndex ?>_Nama" value="<?php echo HtmlEncode($dm_ecp_list->Nama->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_ecp_list->Perusahaan->Visible) { // Perusahaan ?>
		<td data-name="Perusahaan">
<span id="el$rowindex$_dm_ecp_Perusahaan" class="form-group dm_ecp_Perusahaan">
<?php
$onchange = $dm_ecp_list->Perusahaan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$dm_ecp_list->Perusahaan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $dm_ecp_list->RowIndex ?>_Perusahaan">
	<input type="text" class="form-control" name="sv_x<?php echo $dm_ecp_list->RowIndex ?>_Perusahaan" id="sv_x<?php echo $dm_ecp_list->RowIndex ?>_Perusahaan" value="<?php echo RemoveHtml($dm_ecp_list->Perusahaan->EditValue) ?>" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_ecp_list->Perusahaan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($dm_ecp_list->Perusahaan->getPlaceHolder()) ?>"<?php echo $dm_ecp_list->Perusahaan->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Perusahaan" data-value-separator="<?php echo $dm_ecp_list->Perusahaan->displayValueSeparatorAttribute() ?>" name="x<?php echo $dm_ecp_list->RowIndex ?>_Perusahaan" id="x<?php echo $dm_ecp_list->RowIndex ?>_Perusahaan" value="<?php echo HtmlEncode($dm_ecp_list->Perusahaan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdm_ecplist"], function() {
	fdm_ecplist.createAutoSuggest({"id":"x<?php echo $dm_ecp_list->RowIndex ?>_Perusahaan","forceSelect":false});
});
</script>
<?php echo $dm_ecp_list->Perusahaan->Lookup->getParamTag($dm_ecp_list, "p_x" . $dm_ecp_list->RowIndex . "_Perusahaan") ?>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Perusahaan" name="o<?php echo $dm_ecp_list->RowIndex ?>_Perusahaan" id="o<?php echo $dm_ecp_list->RowIndex ?>_Perusahaan" value="<?php echo HtmlEncode($dm_ecp_list->Perusahaan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_ecp_list->Daerah->Visible) { // Daerah ?>
		<td data-name="Daerah">
<span id="el$rowindex$_dm_ecp_Daerah" class="form-group dm_ecp_Daerah">
<input type="text" data-table="dm_ecp" data-field="x_Daerah" name="x<?php echo $dm_ecp_list->RowIndex ?>_Daerah" id="x<?php echo $dm_ecp_list->RowIndex ?>_Daerah" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_ecp_list->Daerah->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Daerah->EditValue ?>"<?php echo $dm_ecp_list->Daerah->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Daerah" name="o<?php echo $dm_ecp_list->RowIndex ?>_Daerah" id="o<?php echo $dm_ecp_list->RowIndex ?>_Daerah" value="<?php echo HtmlEncode($dm_ecp_list->Daerah->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_ecp_list->Produk->Visible) { // Produk ?>
		<td data-name="Produk">
<span id="el$rowindex$_dm_ecp_Produk" class="form-group dm_ecp_Produk">
<input type="text" data-table="dm_ecp" data-field="x_Produk" name="x<?php echo $dm_ecp_list->RowIndex ?>_Produk" id="x<?php echo $dm_ecp_list->RowIndex ?>_Produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_ecp_list->Produk->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Produk->EditValue ?>"<?php echo $dm_ecp_list->Produk->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Produk" name="o<?php echo $dm_ecp_list->RowIndex ?>_Produk" id="o<?php echo $dm_ecp_list->RowIndex ?>_Produk" value="<?php echo HtmlEncode($dm_ecp_list->Produk->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_ecp_list->Tgl_Bln_Ekspor->Visible) { // Tgl_Bln_Ekspor ?>
		<td data-name="Tgl_Bln_Ekspor">
<span id="el$rowindex$_dm_ecp_Tgl_Bln_Ekspor" class="form-group dm_ecp_Tgl_Bln_Ekspor">
<input type="text" data-table="dm_ecp" data-field="x_Tgl_Bln_Ekspor" name="x<?php echo $dm_ecp_list->RowIndex ?>_Tgl_Bln_Ekspor" id="x<?php echo $dm_ecp_list->RowIndex ?>_Tgl_Bln_Ekspor" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($dm_ecp_list->Tgl_Bln_Ekspor->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Tgl_Bln_Ekspor->EditValue ?>"<?php echo $dm_ecp_list->Tgl_Bln_Ekspor->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Tgl_Bln_Ekspor" name="o<?php echo $dm_ecp_list->RowIndex ?>_Tgl_Bln_Ekspor" id="o<?php echo $dm_ecp_list->RowIndex ?>_Tgl_Bln_Ekspor" value="<?php echo HtmlEncode($dm_ecp_list->Tgl_Bln_Ekspor->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_ecp_list->Negara_Tujuan->Visible) { // Negara_Tujuan ?>
		<td data-name="Negara_Tujuan">
<span id="el$rowindex$_dm_ecp_Negara_Tujuan" class="form-group dm_ecp_Negara_Tujuan">
<input type="text" data-table="dm_ecp" data-field="x_Negara_Tujuan" name="x<?php echo $dm_ecp_list->RowIndex ?>_Negara_Tujuan" id="x<?php echo $dm_ecp_list->RowIndex ?>_Negara_Tujuan" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_ecp_list->Negara_Tujuan->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Negara_Tujuan->EditValue ?>"<?php echo $dm_ecp_list->Negara_Tujuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Negara_Tujuan" name="o<?php echo $dm_ecp_list->RowIndex ?>_Negara_Tujuan" id="o<?php echo $dm_ecp_list->RowIndex ?>_Negara_Tujuan" value="<?php echo HtmlEncode($dm_ecp_list->Negara_Tujuan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_ecp_list->Nilai_Ekspor_USD->Visible) { // Nilai_Ekspor_USD ?>
		<td data-name="Nilai_Ekspor_USD">
<span id="el$rowindex$_dm_ecp_Nilai_Ekspor_USD" class="form-group dm_ecp_Nilai_Ekspor_USD">
<input type="text" data-table="dm_ecp" data-field="x_Nilai_Ekspor_USD" name="x<?php echo $dm_ecp_list->RowIndex ?>_Nilai_Ekspor_USD" id="x<?php echo $dm_ecp_list->RowIndex ?>_Nilai_Ekspor_USD" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($dm_ecp_list->Nilai_Ekspor_USD->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Nilai_Ekspor_USD->EditValue ?>"<?php echo $dm_ecp_list->Nilai_Ekspor_USD->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Nilai_Ekspor_USD" name="o<?php echo $dm_ecp_list->RowIndex ?>_Nilai_Ekspor_USD" id="o<?php echo $dm_ecp_list->RowIndex ?>_Nilai_Ekspor_USD" value="<?php echo HtmlEncode($dm_ecp_list->Nilai_Ekspor_USD->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_ecp_list->Nilai_Ekspor_Rupiah->Visible) { // Nilai_Ekspor_Rupiah ?>
		<td data-name="Nilai_Ekspor_Rupiah">
<span id="el$rowindex$_dm_ecp_Nilai_Ekspor_Rupiah" class="form-group dm_ecp_Nilai_Ekspor_Rupiah">
<input type="text" data-table="dm_ecp" data-field="x_Nilai_Ekspor_Rupiah" name="x<?php echo $dm_ecp_list->RowIndex ?>_Nilai_Ekspor_Rupiah" id="x<?php echo $dm_ecp_list->RowIndex ?>_Nilai_Ekspor_Rupiah" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($dm_ecp_list->Nilai_Ekspor_Rupiah->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Nilai_Ekspor_Rupiah->EditValue ?>"<?php echo $dm_ecp_list->Nilai_Ekspor_Rupiah->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Nilai_Ekspor_Rupiah" name="o<?php echo $dm_ecp_list->RowIndex ?>_Nilai_Ekspor_Rupiah" id="o<?php echo $dm_ecp_list->RowIndex ?>_Nilai_Ekspor_Rupiah" value="<?php echo HtmlEncode($dm_ecp_list->Nilai_Ekspor_Rupiah->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_ecp_list->Keterangan->Visible) { // Keterangan ?>
		<td data-name="Keterangan">
<span id="el$rowindex$_dm_ecp_Keterangan" class="form-group dm_ecp_Keterangan">
<input type="text" data-table="dm_ecp" data-field="x_Keterangan" name="x<?php echo $dm_ecp_list->RowIndex ?>_Keterangan" id="x<?php echo $dm_ecp_list->RowIndex ?>_Keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_ecp_list->Keterangan->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Keterangan->EditValue ?>"<?php echo $dm_ecp_list->Keterangan->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Keterangan" name="o<?php echo $dm_ecp_list->RowIndex ?>_Keterangan" id="o<?php echo $dm_ecp_list->RowIndex ?>_Keterangan" value="<?php echo HtmlEncode($dm_ecp_list->Keterangan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_ecp_list->Wilayah_ECP->Visible) { // Wilayah_ECP ?>
		<td data-name="Wilayah_ECP">
<span id="el$rowindex$_dm_ecp_Wilayah_ECP" class="form-group dm_ecp_Wilayah_ECP">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dm_ecp" data-field="x_Wilayah_ECP" data-value-separator="<?php echo $dm_ecp_list->Wilayah_ECP->displayValueSeparatorAttribute() ?>" id="x<?php echo $dm_ecp_list->RowIndex ?>_Wilayah_ECP" name="x<?php echo $dm_ecp_list->RowIndex ?>_Wilayah_ECP"<?php echo $dm_ecp_list->Wilayah_ECP->editAttributes() ?>>
			<?php echo $dm_ecp_list->Wilayah_ECP->selectOptionListHtml("x{$dm_ecp_list->RowIndex}_Wilayah_ECP") ?>
		</select>
</div>
<?php echo $dm_ecp_list->Wilayah_ECP->Lookup->getParamTag($dm_ecp_list, "p_x" . $dm_ecp_list->RowIndex . "_Wilayah_ECP") ?>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Wilayah_ECP" name="o<?php echo $dm_ecp_list->RowIndex ?>_Wilayah_ECP" id="o<?php echo $dm_ecp_list->RowIndex ?>_Wilayah_ECP" value="<?php echo HtmlEncode($dm_ecp_list->Wilayah_ECP->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_ecp_list->Tahun_ECP->Visible) { // Tahun_ECP ?>
		<td data-name="Tahun_ECP">
<span id="el$rowindex$_dm_ecp_Tahun_ECP" class="form-group dm_ecp_Tahun_ECP">
<input type="text" data-table="dm_ecp" data-field="x_Tahun_ECP" name="x<?php echo $dm_ecp_list->RowIndex ?>_Tahun_ECP" id="x<?php echo $dm_ecp_list->RowIndex ?>_Tahun_ECP" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($dm_ecp_list->Tahun_ECP->getPlaceHolder()) ?>" value="<?php echo $dm_ecp_list->Tahun_ECP->EditValue ?>"<?php echo $dm_ecp_list->Tahun_ECP->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_ecp" data-field="x_Tahun_ECP" name="o<?php echo $dm_ecp_list->RowIndex ?>_Tahun_ECP" id="o<?php echo $dm_ecp_list->RowIndex ?>_Tahun_ECP" value="<?php echo HtmlEncode($dm_ecp_list->Tahun_ECP->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$dm_ecp_list->ListOptions->render("body", "right", $dm_ecp_list->RowIndex);
?>
<script>
loadjs.ready(["fdm_ecplist", "load"], function() {
	fdm_ecplist.updateLists(<?php echo $dm_ecp_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($dm_ecp_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $dm_ecp_list->FormKeyCountName ?>" id="<?php echo $dm_ecp_list->FormKeyCountName ?>" value="<?php echo $dm_ecp_list->KeyCount ?>">
<?php echo $dm_ecp_list->MultiSelectKey ?>
<?php } ?>
<?php if ($dm_ecp_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $dm_ecp_list->FormKeyCountName ?>" id="<?php echo $dm_ecp_list->FormKeyCountName ?>" value="<?php echo $dm_ecp_list->KeyCount ?>">
<?php echo $dm_ecp_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$dm_ecp->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($dm_ecp_list->Recordset)
	$dm_ecp_list->Recordset->Close();
?>
<?php if (!$dm_ecp_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$dm_ecp_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $dm_ecp_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $dm_ecp_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($dm_ecp_list->TotalRecords == 0 && !$dm_ecp->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $dm_ecp_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$dm_ecp_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$dm_ecp_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php if (!$dm_ecp->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_dm_ecp",
		width: "100%",
		height: "500px"
	});
});
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$dm_ecp_list->terminate();
?>