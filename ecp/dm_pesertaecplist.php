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
$dm_pesertaecp_list = new dm_pesertaecp_list();

// Run the page
$dm_pesertaecp_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dm_pesertaecp_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$dm_pesertaecp_list->isExport()) { ?>
<script>
var fdm_pesertaecplist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdm_pesertaecplist = currentForm = new ew.Form("fdm_pesertaecplist", "list");
	fdm_pesertaecplist.formKeyCountName = '<?php echo $dm_pesertaecp_list->FormKeyCountName ?>';

	// Validate form
	fdm_pesertaecplist.validate = function() {
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
			<?php if ($dm_pesertaecp_list->ID_Unik->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Unik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_list->ID_Unik->caption(), $dm_pesertaecp_list->ID_Unik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_list->Nama->Required) { ?>
				elm = this.getElements("x" + infix + "_Nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_list->Nama->caption(), $dm_pesertaecp_list->Nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_list->Perusahaan->Required) { ?>
				elm = this.getElements("x" + infix + "_Perusahaan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_list->Perusahaan->caption(), $dm_pesertaecp_list->Perusahaan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_list->Produk->Required) { ?>
				elm = this.getElements("x" + infix + "_Produk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_list->Produk->caption(), $dm_pesertaecp_list->Produk->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_list->Kapasitas_Produksi->Required) { ?>
				elm = this.getElements("x" + infix + "_Kapasitas_Produksi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_list->Kapasitas_Produksi->caption(), $dm_pesertaecp_list->Kapasitas_Produksi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_list->Omset->Required) { ?>
				elm = this.getElements("x" + infix + "_Omset");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_list->Omset->caption(), $dm_pesertaecp_list->Omset->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_list->Jumlah_Pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_Jumlah_Pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_list->Jumlah_Pegawai->caption(), $dm_pesertaecp_list->Jumlah_Pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_list->Legalitas_Perusahaan->Required) { ?>
				elm = this.getElements("x" + infix + "_Legalitas_Perusahaan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_list->Legalitas_Perusahaan->caption(), $dm_pesertaecp_list->Legalitas_Perusahaan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_list->Sertifikasi_dimiliki->Required) { ?>
				elm = this.getElements("x" + infix + "_Sertifikasi_dimiliki");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_list->Sertifikasi_dimiliki->caption(), $dm_pesertaecp_list->Sertifikasi_dimiliki->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_list->Handphone->Required) { ?>
				elm = this.getElements("x" + infix + "_Handphone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_list->Handphone->caption(), $dm_pesertaecp_list->Handphone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_list->Email_Add->Required) { ?>
				elm = this.getElements("x" + infix + "_Email_Add");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_list->Email_Add->caption(), $dm_pesertaecp_list->Email_Add->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_list->Website->Required) { ?>
				elm = this.getElements("x" + infix + "_Website");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_list->Website->caption(), $dm_pesertaecp_list->Website->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_list->Tahun_Berdiri->Required) { ?>
				elm = this.getElements("x" + infix + "_Tahun_Berdiri");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_list->Tahun_Berdiri->caption(), $dm_pesertaecp_list->Tahun_Berdiri->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_list->Wilayah_ECP->Required) { ?>
				elm = this.getElements("x" + infix + "_Wilayah_ECP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_list->Wilayah_ECP->caption(), $dm_pesertaecp_list->Wilayah_ECP->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_list->Tahun_ECP->Required) { ?>
				elm = this.getElements("x" + infix + "_Tahun_ECP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_list->Tahun_ECP->caption(), $dm_pesertaecp_list->Tahun_ECP->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Tahun_ECP");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dm_pesertaecp_list->Tahun_ECP->errorMessage()) ?>");

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
	fdm_pesertaecplist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Nama", false)) return false;
		if (ew.valueChanged(fobj, infix, "Perusahaan", false)) return false;
		if (ew.valueChanged(fobj, infix, "Produk", false)) return false;
		if (ew.valueChanged(fobj, infix, "Kapasitas_Produksi", false)) return false;
		if (ew.valueChanged(fobj, infix, "Omset", false)) return false;
		if (ew.valueChanged(fobj, infix, "Jumlah_Pegawai", false)) return false;
		if (ew.valueChanged(fobj, infix, "Legalitas_Perusahaan", false)) return false;
		if (ew.valueChanged(fobj, infix, "Sertifikasi_dimiliki", false)) return false;
		if (ew.valueChanged(fobj, infix, "Handphone", false)) return false;
		if (ew.valueChanged(fobj, infix, "Email_Add", false)) return false;
		if (ew.valueChanged(fobj, infix, "Website", false)) return false;
		if (ew.valueChanged(fobj, infix, "Tahun_Berdiri", false)) return false;
		if (ew.valueChanged(fobj, infix, "Wilayah_ECP", false)) return false;
		if (ew.valueChanged(fobj, infix, "Tahun_ECP", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdm_pesertaecplist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdm_pesertaecplist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdm_pesertaecplist.lists["x_Wilayah_ECP"] = <?php echo $dm_pesertaecp_list->Wilayah_ECP->Lookup->toClientList($dm_pesertaecp_list) ?>;
	fdm_pesertaecplist.lists["x_Wilayah_ECP"].options = <?php echo JsonEncode($dm_pesertaecp_list->Wilayah_ECP->lookupOptions()) ?>;
	loadjs.done("fdm_pesertaecplist");
});
var fdm_pesertaecplistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdm_pesertaecplistsrch = currentSearchForm = new ew.Form("fdm_pesertaecplistsrch");

	// Validate function for search
	fdm_pesertaecplistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_Tahun_ECP");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($dm_pesertaecp_list->Tahun_ECP->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fdm_pesertaecplistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdm_pesertaecplistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdm_pesertaecplistsrch.lists["x_Wilayah_ECP"] = <?php echo $dm_pesertaecp_list->Wilayah_ECP->Lookup->toClientList($dm_pesertaecp_list) ?>;
	fdm_pesertaecplistsrch.lists["x_Wilayah_ECP"].options = <?php echo JsonEncode($dm_pesertaecp_list->Wilayah_ECP->lookupOptions()) ?>;

	// Filters
	fdm_pesertaecplistsrch.filterList = <?php echo $dm_pesertaecp_list->getFilterList() ?>;
	loadjs.done("fdm_pesertaecplistsrch");
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
<?php if (!$dm_pesertaecp_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($dm_pesertaecp_list->TotalRecords > 0 && $dm_pesertaecp_list->ExportOptions->visible()) { ?>
<?php $dm_pesertaecp_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($dm_pesertaecp_list->ImportOptions->visible()) { ?>
<?php $dm_pesertaecp_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($dm_pesertaecp_list->SearchOptions->visible()) { ?>
<?php $dm_pesertaecp_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($dm_pesertaecp_list->FilterOptions->visible()) { ?>
<?php $dm_pesertaecp_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$dm_pesertaecp_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$dm_pesertaecp_list->isExport() && !$dm_pesertaecp->CurrentAction) { ?>
<form name="fdm_pesertaecplistsrch" id="fdm_pesertaecplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdm_pesertaecplistsrch-search-panel" class="<?php echo $dm_pesertaecp_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="dm_pesertaecp">
	<div class="ew-extended-search">
<?php

// Render search row
$dm_pesertaecp->RowType = ROWTYPE_SEARCH;
$dm_pesertaecp->resetAttributes();
$dm_pesertaecp_list->renderRow();
?>
<?php if ($dm_pesertaecp_list->Wilayah_ECP->Visible) { // Wilayah_ECP ?>
	<?php
		$dm_pesertaecp_list->SearchColumnCount++;
		if (($dm_pesertaecp_list->SearchColumnCount - 1) % $dm_pesertaecp_list->SearchFieldsPerRow == 0) {
			$dm_pesertaecp_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $dm_pesertaecp_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Wilayah_ECP" class="ew-cell form-group">
		<label for="x_Wilayah_ECP" class="ew-search-caption ew-label"><?php echo $dm_pesertaecp_list->Wilayah_ECP->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Wilayah_ECP" id="z_Wilayah_ECP" value="=">
</span>
		<span id="el_dm_pesertaecp_Wilayah_ECP" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dm_pesertaecp" data-field="x_Wilayah_ECP" data-value-separator="<?php echo $dm_pesertaecp_list->Wilayah_ECP->displayValueSeparatorAttribute() ?>" id="x_Wilayah_ECP" name="x_Wilayah_ECP"<?php echo $dm_pesertaecp_list->Wilayah_ECP->editAttributes() ?>>
			<?php echo $dm_pesertaecp_list->Wilayah_ECP->selectOptionListHtml("x_Wilayah_ECP") ?>
		</select>
</div>
<?php echo $dm_pesertaecp_list->Wilayah_ECP->Lookup->getParamTag($dm_pesertaecp_list, "p_x_Wilayah_ECP") ?>
</span>
	</div>
	<?php if ($dm_pesertaecp_list->SearchColumnCount % $dm_pesertaecp_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($dm_pesertaecp_list->Tahun_ECP->Visible) { // Tahun_ECP ?>
	<?php
		$dm_pesertaecp_list->SearchColumnCount++;
		if (($dm_pesertaecp_list->SearchColumnCount - 1) % $dm_pesertaecp_list->SearchFieldsPerRow == 0) {
			$dm_pesertaecp_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $dm_pesertaecp_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Tahun_ECP" class="ew-cell form-group">
		<label for="x_Tahun_ECP" class="ew-search-caption ew-label"><?php echo $dm_pesertaecp_list->Tahun_ECP->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Tahun_ECP" id="z_Tahun_ECP" value="=">
</span>
		<span id="el_dm_pesertaecp_Tahun_ECP" class="ew-search-field">
<input type="text" data-table="dm_pesertaecp" data-field="x_Tahun_ECP" name="x_Tahun_ECP" id="x_Tahun_ECP" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Tahun_ECP->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Tahun_ECP->EditValue ?>"<?php echo $dm_pesertaecp_list->Tahun_ECP->editAttributes() ?>>
</span>
	</div>
	<?php if ($dm_pesertaecp_list->SearchColumnCount % $dm_pesertaecp_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($dm_pesertaecp_list->SearchColumnCount % $dm_pesertaecp_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $dm_pesertaecp_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($dm_pesertaecp_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($dm_pesertaecp_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $dm_pesertaecp_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($dm_pesertaecp_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($dm_pesertaecp_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($dm_pesertaecp_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($dm_pesertaecp_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $dm_pesertaecp_list->showPageHeader(); ?>
<?php
$dm_pesertaecp_list->showMessage();
?>
<?php if ($dm_pesertaecp_list->TotalRecords > 0 || $dm_pesertaecp->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($dm_pesertaecp_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> dm_pesertaecp">
<form name="fdm_pesertaecplist" id="fdm_pesertaecplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dm_pesertaecp">
<div id="gmp_dm_pesertaecp" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($dm_pesertaecp_list->TotalRecords > 0 || $dm_pesertaecp_list->isGridEdit()) { ?>
<table id="tbl_dm_pesertaecplist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$dm_pesertaecp->RowType = ROWTYPE_HEADER;

// Render list options
$dm_pesertaecp_list->renderListOptions();

// Render list options (header, left)
$dm_pesertaecp_list->ListOptions->render("header", "left");
?>
<?php if ($dm_pesertaecp_list->ID_Unik->Visible) { // ID_Unik ?>
	<?php if ($dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->ID_Unik) == "") { ?>
		<th data-name="ID_Unik" class="<?php echo $dm_pesertaecp_list->ID_Unik->headerCellClass() ?>"><div id="elh_dm_pesertaecp_ID_Unik" class="dm_pesertaecp_ID_Unik"><div class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->ID_Unik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Unik" class="<?php echo $dm_pesertaecp_list->ID_Unik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->ID_Unik) ?>', 1);"><div id="elh_dm_pesertaecp_ID_Unik" class="dm_pesertaecp_ID_Unik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->ID_Unik->caption() ?></span><span class="ew-table-header-sort"><?php if ($dm_pesertaecp_list->ID_Unik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_pesertaecp_list->ID_Unik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_pesertaecp_list->Nama->Visible) { // Nama ?>
	<?php if ($dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Nama) == "") { ?>
		<th data-name="Nama" class="<?php echo $dm_pesertaecp_list->Nama->headerCellClass() ?>"><div id="elh_dm_pesertaecp_Nama" class="dm_pesertaecp_Nama"><div class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nama" class="<?php echo $dm_pesertaecp_list->Nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Nama) ?>', 1);"><div id="elh_dm_pesertaecp_Nama" class="dm_pesertaecp_Nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dm_pesertaecp_list->Nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_pesertaecp_list->Nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_pesertaecp_list->Perusahaan->Visible) { // Perusahaan ?>
	<?php if ($dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Perusahaan) == "") { ?>
		<th data-name="Perusahaan" class="<?php echo $dm_pesertaecp_list->Perusahaan->headerCellClass() ?>"><div id="elh_dm_pesertaecp_Perusahaan" class="dm_pesertaecp_Perusahaan"><div class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Perusahaan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Perusahaan" class="<?php echo $dm_pesertaecp_list->Perusahaan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Perusahaan) ?>', 1);"><div id="elh_dm_pesertaecp_Perusahaan" class="dm_pesertaecp_Perusahaan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Perusahaan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dm_pesertaecp_list->Perusahaan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_pesertaecp_list->Perusahaan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_pesertaecp_list->Produk->Visible) { // Produk ?>
	<?php if ($dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Produk) == "") { ?>
		<th data-name="Produk" class="<?php echo $dm_pesertaecp_list->Produk->headerCellClass() ?>"><div id="elh_dm_pesertaecp_Produk" class="dm_pesertaecp_Produk"><div class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Produk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Produk" class="<?php echo $dm_pesertaecp_list->Produk->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Produk) ?>', 1);"><div id="elh_dm_pesertaecp_Produk" class="dm_pesertaecp_Produk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Produk->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dm_pesertaecp_list->Produk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_pesertaecp_list->Produk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_pesertaecp_list->Kapasitas_Produksi->Visible) { // Kapasitas_Produksi ?>
	<?php if ($dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Kapasitas_Produksi) == "") { ?>
		<th data-name="Kapasitas_Produksi" class="<?php echo $dm_pesertaecp_list->Kapasitas_Produksi->headerCellClass() ?>"><div id="elh_dm_pesertaecp_Kapasitas_Produksi" class="dm_pesertaecp_Kapasitas_Produksi"><div class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Kapasitas_Produksi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Kapasitas_Produksi" class="<?php echo $dm_pesertaecp_list->Kapasitas_Produksi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Kapasitas_Produksi) ?>', 1);"><div id="elh_dm_pesertaecp_Kapasitas_Produksi" class="dm_pesertaecp_Kapasitas_Produksi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Kapasitas_Produksi->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dm_pesertaecp_list->Kapasitas_Produksi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_pesertaecp_list->Kapasitas_Produksi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_pesertaecp_list->Omset->Visible) { // Omset ?>
	<?php if ($dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Omset) == "") { ?>
		<th data-name="Omset" class="<?php echo $dm_pesertaecp_list->Omset->headerCellClass() ?>"><div id="elh_dm_pesertaecp_Omset" class="dm_pesertaecp_Omset"><div class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Omset->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Omset" class="<?php echo $dm_pesertaecp_list->Omset->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Omset) ?>', 1);"><div id="elh_dm_pesertaecp_Omset" class="dm_pesertaecp_Omset">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Omset->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dm_pesertaecp_list->Omset->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_pesertaecp_list->Omset->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_pesertaecp_list->Jumlah_Pegawai->Visible) { // Jumlah_Pegawai ?>
	<?php if ($dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Jumlah_Pegawai) == "") { ?>
		<th data-name="Jumlah_Pegawai" class="<?php echo $dm_pesertaecp_list->Jumlah_Pegawai->headerCellClass() ?>"><div id="elh_dm_pesertaecp_Jumlah_Pegawai" class="dm_pesertaecp_Jumlah_Pegawai"><div class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Jumlah_Pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Jumlah_Pegawai" class="<?php echo $dm_pesertaecp_list->Jumlah_Pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Jumlah_Pegawai) ?>', 1);"><div id="elh_dm_pesertaecp_Jumlah_Pegawai" class="dm_pesertaecp_Jumlah_Pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Jumlah_Pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($dm_pesertaecp_list->Jumlah_Pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_pesertaecp_list->Jumlah_Pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_pesertaecp_list->Legalitas_Perusahaan->Visible) { // Legalitas_Perusahaan ?>
	<?php if ($dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Legalitas_Perusahaan) == "") { ?>
		<th data-name="Legalitas_Perusahaan" class="<?php echo $dm_pesertaecp_list->Legalitas_Perusahaan->headerCellClass() ?>"><div id="elh_dm_pesertaecp_Legalitas_Perusahaan" class="dm_pesertaecp_Legalitas_Perusahaan"><div class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Legalitas_Perusahaan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Legalitas_Perusahaan" class="<?php echo $dm_pesertaecp_list->Legalitas_Perusahaan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Legalitas_Perusahaan) ?>', 1);"><div id="elh_dm_pesertaecp_Legalitas_Perusahaan" class="dm_pesertaecp_Legalitas_Perusahaan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Legalitas_Perusahaan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dm_pesertaecp_list->Legalitas_Perusahaan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_pesertaecp_list->Legalitas_Perusahaan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_pesertaecp_list->Sertifikasi_dimiliki->Visible) { // Sertifikasi_dimiliki ?>
	<?php if ($dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Sertifikasi_dimiliki) == "") { ?>
		<th data-name="Sertifikasi_dimiliki" class="<?php echo $dm_pesertaecp_list->Sertifikasi_dimiliki->headerCellClass() ?>"><div id="elh_dm_pesertaecp_Sertifikasi_dimiliki" class="dm_pesertaecp_Sertifikasi_dimiliki"><div class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Sertifikasi_dimiliki->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sertifikasi_dimiliki" class="<?php echo $dm_pesertaecp_list->Sertifikasi_dimiliki->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Sertifikasi_dimiliki) ?>', 1);"><div id="elh_dm_pesertaecp_Sertifikasi_dimiliki" class="dm_pesertaecp_Sertifikasi_dimiliki">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Sertifikasi_dimiliki->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dm_pesertaecp_list->Sertifikasi_dimiliki->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_pesertaecp_list->Sertifikasi_dimiliki->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_pesertaecp_list->Handphone->Visible) { // Handphone ?>
	<?php if ($dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Handphone) == "") { ?>
		<th data-name="Handphone" class="<?php echo $dm_pesertaecp_list->Handphone->headerCellClass() ?>"><div id="elh_dm_pesertaecp_Handphone" class="dm_pesertaecp_Handphone"><div class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Handphone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Handphone" class="<?php echo $dm_pesertaecp_list->Handphone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Handphone) ?>', 1);"><div id="elh_dm_pesertaecp_Handphone" class="dm_pesertaecp_Handphone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Handphone->caption() ?></span><span class="ew-table-header-sort"><?php if ($dm_pesertaecp_list->Handphone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_pesertaecp_list->Handphone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_pesertaecp_list->Email_Add->Visible) { // Email_Add ?>
	<?php if ($dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Email_Add) == "") { ?>
		<th data-name="Email_Add" class="<?php echo $dm_pesertaecp_list->Email_Add->headerCellClass() ?>"><div id="elh_dm_pesertaecp_Email_Add" class="dm_pesertaecp_Email_Add"><div class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Email_Add->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Email_Add" class="<?php echo $dm_pesertaecp_list->Email_Add->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Email_Add) ?>', 1);"><div id="elh_dm_pesertaecp_Email_Add" class="dm_pesertaecp_Email_Add">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Email_Add->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dm_pesertaecp_list->Email_Add->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_pesertaecp_list->Email_Add->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_pesertaecp_list->Website->Visible) { // Website ?>
	<?php if ($dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Website) == "") { ?>
		<th data-name="Website" class="<?php echo $dm_pesertaecp_list->Website->headerCellClass() ?>"><div id="elh_dm_pesertaecp_Website" class="dm_pesertaecp_Website"><div class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Website->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Website" class="<?php echo $dm_pesertaecp_list->Website->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Website) ?>', 1);"><div id="elh_dm_pesertaecp_Website" class="dm_pesertaecp_Website">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Website->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dm_pesertaecp_list->Website->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_pesertaecp_list->Website->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_pesertaecp_list->Tahun_Berdiri->Visible) { // Tahun_Berdiri ?>
	<?php if ($dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Tahun_Berdiri) == "") { ?>
		<th data-name="Tahun_Berdiri" class="<?php echo $dm_pesertaecp_list->Tahun_Berdiri->headerCellClass() ?>"><div id="elh_dm_pesertaecp_Tahun_Berdiri" class="dm_pesertaecp_Tahun_Berdiri"><div class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Tahun_Berdiri->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tahun_Berdiri" class="<?php echo $dm_pesertaecp_list->Tahun_Berdiri->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Tahun_Berdiri) ?>', 1);"><div id="elh_dm_pesertaecp_Tahun_Berdiri" class="dm_pesertaecp_Tahun_Berdiri">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Tahun_Berdiri->caption() ?></span><span class="ew-table-header-sort"><?php if ($dm_pesertaecp_list->Tahun_Berdiri->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_pesertaecp_list->Tahun_Berdiri->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_pesertaecp_list->Wilayah_ECP->Visible) { // Wilayah_ECP ?>
	<?php if ($dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Wilayah_ECP) == "") { ?>
		<th data-name="Wilayah_ECP" class="<?php echo $dm_pesertaecp_list->Wilayah_ECP->headerCellClass() ?>"><div id="elh_dm_pesertaecp_Wilayah_ECP" class="dm_pesertaecp_Wilayah_ECP"><div class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Wilayah_ECP->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Wilayah_ECP" class="<?php echo $dm_pesertaecp_list->Wilayah_ECP->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Wilayah_ECP) ?>', 1);"><div id="elh_dm_pesertaecp_Wilayah_ECP" class="dm_pesertaecp_Wilayah_ECP">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Wilayah_ECP->caption() ?></span><span class="ew-table-header-sort"><?php if ($dm_pesertaecp_list->Wilayah_ECP->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_pesertaecp_list->Wilayah_ECP->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dm_pesertaecp_list->Tahun_ECP->Visible) { // Tahun_ECP ?>
	<?php if ($dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Tahun_ECP) == "") { ?>
		<th data-name="Tahun_ECP" class="<?php echo $dm_pesertaecp_list->Tahun_ECP->headerCellClass() ?>"><div id="elh_dm_pesertaecp_Tahun_ECP" class="dm_pesertaecp_Tahun_ECP"><div class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Tahun_ECP->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tahun_ECP" class="<?php echo $dm_pesertaecp_list->Tahun_ECP->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dm_pesertaecp_list->SortUrl($dm_pesertaecp_list->Tahun_ECP) ?>', 1);"><div id="elh_dm_pesertaecp_Tahun_ECP" class="dm_pesertaecp_Tahun_ECP">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dm_pesertaecp_list->Tahun_ECP->caption() ?></span><span class="ew-table-header-sort"><?php if ($dm_pesertaecp_list->Tahun_ECP->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dm_pesertaecp_list->Tahun_ECP->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$dm_pesertaecp_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($dm_pesertaecp_list->ExportAll && $dm_pesertaecp_list->isExport()) {
	$dm_pesertaecp_list->StopRecord = $dm_pesertaecp_list->TotalRecords;
} else {

	// Set the last record to display
	if ($dm_pesertaecp_list->TotalRecords > $dm_pesertaecp_list->StartRecord + $dm_pesertaecp_list->DisplayRecords - 1)
		$dm_pesertaecp_list->StopRecord = $dm_pesertaecp_list->StartRecord + $dm_pesertaecp_list->DisplayRecords - 1;
	else
		$dm_pesertaecp_list->StopRecord = $dm_pesertaecp_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($dm_pesertaecp->isConfirm() || $dm_pesertaecp_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($dm_pesertaecp_list->FormKeyCountName) && ($dm_pesertaecp_list->isGridAdd() || $dm_pesertaecp_list->isGridEdit() || $dm_pesertaecp->isConfirm())) {
		$dm_pesertaecp_list->KeyCount = $CurrentForm->getValue($dm_pesertaecp_list->FormKeyCountName);
		$dm_pesertaecp_list->StopRecord = $dm_pesertaecp_list->StartRecord + $dm_pesertaecp_list->KeyCount - 1;
	}
}
$dm_pesertaecp_list->RecordCount = $dm_pesertaecp_list->StartRecord - 1;
if ($dm_pesertaecp_list->Recordset && !$dm_pesertaecp_list->Recordset->EOF) {
	$dm_pesertaecp_list->Recordset->moveFirst();
	$selectLimit = $dm_pesertaecp_list->UseSelectLimit;
	if (!$selectLimit && $dm_pesertaecp_list->StartRecord > 1)
		$dm_pesertaecp_list->Recordset->move($dm_pesertaecp_list->StartRecord - 1);
} elseif (!$dm_pesertaecp->AllowAddDeleteRow && $dm_pesertaecp_list->StopRecord == 0) {
	$dm_pesertaecp_list->StopRecord = $dm_pesertaecp->GridAddRowCount;
}

// Initialize aggregate
$dm_pesertaecp->RowType = ROWTYPE_AGGREGATEINIT;
$dm_pesertaecp->resetAttributes();
$dm_pesertaecp_list->renderRow();
if ($dm_pesertaecp_list->isGridAdd())
	$dm_pesertaecp_list->RowIndex = 0;
if ($dm_pesertaecp_list->isGridEdit())
	$dm_pesertaecp_list->RowIndex = 0;
while ($dm_pesertaecp_list->RecordCount < $dm_pesertaecp_list->StopRecord) {
	$dm_pesertaecp_list->RecordCount++;
	if ($dm_pesertaecp_list->RecordCount >= $dm_pesertaecp_list->StartRecord) {
		$dm_pesertaecp_list->RowCount++;
		if ($dm_pesertaecp_list->isGridAdd() || $dm_pesertaecp_list->isGridEdit() || $dm_pesertaecp->isConfirm()) {
			$dm_pesertaecp_list->RowIndex++;
			$CurrentForm->Index = $dm_pesertaecp_list->RowIndex;
			if ($CurrentForm->hasValue($dm_pesertaecp_list->FormActionName) && ($dm_pesertaecp->isConfirm() || $dm_pesertaecp_list->EventCancelled))
				$dm_pesertaecp_list->RowAction = strval($CurrentForm->getValue($dm_pesertaecp_list->FormActionName));
			elseif ($dm_pesertaecp_list->isGridAdd())
				$dm_pesertaecp_list->RowAction = "insert";
			else
				$dm_pesertaecp_list->RowAction = "";
		}

		// Set up key count
		$dm_pesertaecp_list->KeyCount = $dm_pesertaecp_list->RowIndex;

		// Init row class and style
		$dm_pesertaecp->resetAttributes();
		$dm_pesertaecp->CssClass = "";
		if ($dm_pesertaecp_list->isGridAdd()) {
			$dm_pesertaecp_list->loadRowValues(); // Load default values
		} else {
			$dm_pesertaecp_list->loadRowValues($dm_pesertaecp_list->Recordset); // Load row values
		}
		$dm_pesertaecp->RowType = ROWTYPE_VIEW; // Render view
		if ($dm_pesertaecp_list->isGridAdd()) // Grid add
			$dm_pesertaecp->RowType = ROWTYPE_ADD; // Render add
		if ($dm_pesertaecp_list->isGridAdd() && $dm_pesertaecp->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$dm_pesertaecp_list->restoreCurrentRowFormValues($dm_pesertaecp_list->RowIndex); // Restore form values
		if ($dm_pesertaecp_list->isGridEdit()) { // Grid edit
			if ($dm_pesertaecp->EventCancelled)
				$dm_pesertaecp_list->restoreCurrentRowFormValues($dm_pesertaecp_list->RowIndex); // Restore form values
			if ($dm_pesertaecp_list->RowAction == "insert")
				$dm_pesertaecp->RowType = ROWTYPE_ADD; // Render add
			else
				$dm_pesertaecp->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($dm_pesertaecp_list->isGridEdit() && ($dm_pesertaecp->RowType == ROWTYPE_EDIT || $dm_pesertaecp->RowType == ROWTYPE_ADD) && $dm_pesertaecp->EventCancelled) // Update failed
			$dm_pesertaecp_list->restoreCurrentRowFormValues($dm_pesertaecp_list->RowIndex); // Restore form values
		if ($dm_pesertaecp->RowType == ROWTYPE_EDIT) // Edit row
			$dm_pesertaecp_list->EditRowCount++;

		// Set up row id / data-rowindex
		$dm_pesertaecp->RowAttrs->merge(["data-rowindex" => $dm_pesertaecp_list->RowCount, "id" => "r" . $dm_pesertaecp_list->RowCount . "_dm_pesertaecp", "data-rowtype" => $dm_pesertaecp->RowType]);

		// Render row
		$dm_pesertaecp_list->renderRow();

		// Render list options
		$dm_pesertaecp_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($dm_pesertaecp_list->RowAction != "delete" && $dm_pesertaecp_list->RowAction != "insertdelete" && !($dm_pesertaecp_list->RowAction == "insert" && $dm_pesertaecp->isConfirm() && $dm_pesertaecp_list->emptyRow())) {
?>
	<tr <?php echo $dm_pesertaecp->rowAttributes() ?>>
<?php

// Render list options (body, left)
$dm_pesertaecp_list->ListOptions->render("body", "left", $dm_pesertaecp_list->RowCount);
?>
	<?php if ($dm_pesertaecp_list->ID_Unik->Visible) { // ID_Unik ?>
		<td data-name="ID_Unik" <?php echo $dm_pesertaecp_list->ID_Unik->cellAttributes() ?>>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_ID_Unik" class="form-group"></span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_ID_Unik" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_ID_Unik" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_ID_Unik" value="<?php echo HtmlEncode($dm_pesertaecp_list->ID_Unik->OldValue) ?>">
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_ID_Unik" class="form-group">
<span<?php echo $dm_pesertaecp_list->ID_Unik->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dm_pesertaecp_list->ID_Unik->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_ID_Unik" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_ID_Unik" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_ID_Unik" value="<?php echo HtmlEncode($dm_pesertaecp_list->ID_Unik->CurrentValue) ?>">
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_ID_Unik">
<span<?php echo $dm_pesertaecp_list->ID_Unik->viewAttributes() ?>><?php echo $dm_pesertaecp_list->ID_Unik->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Nama->Visible) { // Nama ?>
		<td data-name="Nama" <?php echo $dm_pesertaecp_list->Nama->cellAttributes() ?>>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Nama" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Nama" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Nama" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Nama" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Nama->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Nama->EditValue ?>"<?php echo $dm_pesertaecp_list->Nama->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Nama" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Nama" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Nama" value="<?php echo HtmlEncode($dm_pesertaecp_list->Nama->OldValue) ?>">
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Nama" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Nama" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Nama" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Nama" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Nama->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Nama->EditValue ?>"<?php echo $dm_pesertaecp_list->Nama->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Nama">
<span<?php echo $dm_pesertaecp_list->Nama->viewAttributes() ?>><?php echo $dm_pesertaecp_list->Nama->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Perusahaan->Visible) { // Perusahaan ?>
		<td data-name="Perusahaan" <?php echo $dm_pesertaecp_list->Perusahaan->cellAttributes() ?>>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Perusahaan" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Perusahaan" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Perusahaan" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Perusahaan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Perusahaan->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Perusahaan->EditValue ?>"<?php echo $dm_pesertaecp_list->Perusahaan->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Perusahaan" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Perusahaan" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Perusahaan" value="<?php echo HtmlEncode($dm_pesertaecp_list->Perusahaan->OldValue) ?>">
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Perusahaan" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Perusahaan" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Perusahaan" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Perusahaan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Perusahaan->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Perusahaan->EditValue ?>"<?php echo $dm_pesertaecp_list->Perusahaan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Perusahaan">
<span<?php echo $dm_pesertaecp_list->Perusahaan->viewAttributes() ?>><?php echo $dm_pesertaecp_list->Perusahaan->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Produk->Visible) { // Produk ?>
		<td data-name="Produk" <?php echo $dm_pesertaecp_list->Produk->cellAttributes() ?>>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Produk" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Produk" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Produk" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Produk->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Produk->EditValue ?>"<?php echo $dm_pesertaecp_list->Produk->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Produk" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Produk" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Produk" value="<?php echo HtmlEncode($dm_pesertaecp_list->Produk->OldValue) ?>">
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Produk" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Produk" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Produk" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Produk->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Produk->EditValue ?>"<?php echo $dm_pesertaecp_list->Produk->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Produk">
<span<?php echo $dm_pesertaecp_list->Produk->viewAttributes() ?>><?php echo $dm_pesertaecp_list->Produk->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Kapasitas_Produksi->Visible) { // Kapasitas_Produksi ?>
		<td data-name="Kapasitas_Produksi" <?php echo $dm_pesertaecp_list->Kapasitas_Produksi->cellAttributes() ?>>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Kapasitas_Produksi" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Kapasitas_Produksi" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Kapasitas_Produksi" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Kapasitas_Produksi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Kapasitas_Produksi->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Kapasitas_Produksi->EditValue ?>"<?php echo $dm_pesertaecp_list->Kapasitas_Produksi->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Kapasitas_Produksi" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Kapasitas_Produksi" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Kapasitas_Produksi" value="<?php echo HtmlEncode($dm_pesertaecp_list->Kapasitas_Produksi->OldValue) ?>">
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Kapasitas_Produksi" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Kapasitas_Produksi" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Kapasitas_Produksi" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Kapasitas_Produksi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Kapasitas_Produksi->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Kapasitas_Produksi->EditValue ?>"<?php echo $dm_pesertaecp_list->Kapasitas_Produksi->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Kapasitas_Produksi">
<span<?php echo $dm_pesertaecp_list->Kapasitas_Produksi->viewAttributes() ?>><?php echo $dm_pesertaecp_list->Kapasitas_Produksi->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Omset->Visible) { // Omset ?>
		<td data-name="Omset" <?php echo $dm_pesertaecp_list->Omset->cellAttributes() ?>>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Omset" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Omset" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Omset" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Omset" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Omset->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Omset->EditValue ?>"<?php echo $dm_pesertaecp_list->Omset->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Omset" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Omset" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Omset" value="<?php echo HtmlEncode($dm_pesertaecp_list->Omset->OldValue) ?>">
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Omset" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Omset" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Omset" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Omset" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Omset->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Omset->EditValue ?>"<?php echo $dm_pesertaecp_list->Omset->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Omset">
<span<?php echo $dm_pesertaecp_list->Omset->viewAttributes() ?>><?php echo $dm_pesertaecp_list->Omset->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Jumlah_Pegawai->Visible) { // Jumlah_Pegawai ?>
		<td data-name="Jumlah_Pegawai" <?php echo $dm_pesertaecp_list->Jumlah_Pegawai->cellAttributes() ?>>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Jumlah_Pegawai" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Jumlah_Pegawai" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Jumlah_Pegawai" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Jumlah_Pegawai" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Jumlah_Pegawai->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Jumlah_Pegawai->EditValue ?>"<?php echo $dm_pesertaecp_list->Jumlah_Pegawai->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Jumlah_Pegawai" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Jumlah_Pegawai" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Jumlah_Pegawai" value="<?php echo HtmlEncode($dm_pesertaecp_list->Jumlah_Pegawai->OldValue) ?>">
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Jumlah_Pegawai" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Jumlah_Pegawai" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Jumlah_Pegawai" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Jumlah_Pegawai" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Jumlah_Pegawai->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Jumlah_Pegawai->EditValue ?>"<?php echo $dm_pesertaecp_list->Jumlah_Pegawai->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Jumlah_Pegawai">
<span<?php echo $dm_pesertaecp_list->Jumlah_Pegawai->viewAttributes() ?>><?php echo $dm_pesertaecp_list->Jumlah_Pegawai->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Legalitas_Perusahaan->Visible) { // Legalitas_Perusahaan ?>
		<td data-name="Legalitas_Perusahaan" <?php echo $dm_pesertaecp_list->Legalitas_Perusahaan->cellAttributes() ?>>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Legalitas_Perusahaan" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Legalitas_Perusahaan" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Legalitas_Perusahaan" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Legalitas_Perusahaan" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Legalitas_Perusahaan->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Legalitas_Perusahaan->EditValue ?>"<?php echo $dm_pesertaecp_list->Legalitas_Perusahaan->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Legalitas_Perusahaan" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Legalitas_Perusahaan" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Legalitas_Perusahaan" value="<?php echo HtmlEncode($dm_pesertaecp_list->Legalitas_Perusahaan->OldValue) ?>">
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Legalitas_Perusahaan" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Legalitas_Perusahaan" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Legalitas_Perusahaan" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Legalitas_Perusahaan" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Legalitas_Perusahaan->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Legalitas_Perusahaan->EditValue ?>"<?php echo $dm_pesertaecp_list->Legalitas_Perusahaan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Legalitas_Perusahaan">
<span<?php echo $dm_pesertaecp_list->Legalitas_Perusahaan->viewAttributes() ?>><?php echo $dm_pesertaecp_list->Legalitas_Perusahaan->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Sertifikasi_dimiliki->Visible) { // Sertifikasi_dimiliki ?>
		<td data-name="Sertifikasi_dimiliki" <?php echo $dm_pesertaecp_list->Sertifikasi_dimiliki->cellAttributes() ?>>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Sertifikasi_dimiliki" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Sertifikasi_dimiliki" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Sertifikasi_dimiliki" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Sertifikasi_dimiliki" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Sertifikasi_dimiliki->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Sertifikasi_dimiliki->EditValue ?>"<?php echo $dm_pesertaecp_list->Sertifikasi_dimiliki->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Sertifikasi_dimiliki" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Sertifikasi_dimiliki" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Sertifikasi_dimiliki" value="<?php echo HtmlEncode($dm_pesertaecp_list->Sertifikasi_dimiliki->OldValue) ?>">
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Sertifikasi_dimiliki" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Sertifikasi_dimiliki" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Sertifikasi_dimiliki" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Sertifikasi_dimiliki" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Sertifikasi_dimiliki->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Sertifikasi_dimiliki->EditValue ?>"<?php echo $dm_pesertaecp_list->Sertifikasi_dimiliki->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Sertifikasi_dimiliki">
<span<?php echo $dm_pesertaecp_list->Sertifikasi_dimiliki->viewAttributes() ?>><?php echo $dm_pesertaecp_list->Sertifikasi_dimiliki->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Handphone->Visible) { // Handphone ?>
		<td data-name="Handphone" <?php echo $dm_pesertaecp_list->Handphone->cellAttributes() ?>>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Handphone" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Handphone" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Handphone" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Handphone" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Handphone->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Handphone->EditValue ?>"<?php echo $dm_pesertaecp_list->Handphone->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Handphone" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Handphone" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Handphone" value="<?php echo HtmlEncode($dm_pesertaecp_list->Handphone->OldValue) ?>">
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Handphone" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Handphone" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Handphone" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Handphone" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Handphone->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Handphone->EditValue ?>"<?php echo $dm_pesertaecp_list->Handphone->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Handphone">
<span<?php echo $dm_pesertaecp_list->Handphone->viewAttributes() ?>><?php echo $dm_pesertaecp_list->Handphone->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Email_Add->Visible) { // Email_Add ?>
		<td data-name="Email_Add" <?php echo $dm_pesertaecp_list->Email_Add->cellAttributes() ?>>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Email_Add" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Email_Add" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Email_Add" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Email_Add" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Email_Add->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Email_Add->EditValue ?>"<?php echo $dm_pesertaecp_list->Email_Add->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Email_Add" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Email_Add" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Email_Add" value="<?php echo HtmlEncode($dm_pesertaecp_list->Email_Add->OldValue) ?>">
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Email_Add" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Email_Add" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Email_Add" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Email_Add" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Email_Add->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Email_Add->EditValue ?>"<?php echo $dm_pesertaecp_list->Email_Add->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Email_Add">
<span<?php echo $dm_pesertaecp_list->Email_Add->viewAttributes() ?>><?php echo $dm_pesertaecp_list->Email_Add->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Website->Visible) { // Website ?>
		<td data-name="Website" <?php echo $dm_pesertaecp_list->Website->cellAttributes() ?>>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Website" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Website" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Website" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Website" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Website->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Website->EditValue ?>"<?php echo $dm_pesertaecp_list->Website->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Website" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Website" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Website" value="<?php echo HtmlEncode($dm_pesertaecp_list->Website->OldValue) ?>">
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Website" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Website" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Website" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Website" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Website->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Website->EditValue ?>"<?php echo $dm_pesertaecp_list->Website->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Website">
<span<?php echo $dm_pesertaecp_list->Website->viewAttributes() ?>><?php echo $dm_pesertaecp_list->Website->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Tahun_Berdiri->Visible) { // Tahun_Berdiri ?>
		<td data-name="Tahun_Berdiri" <?php echo $dm_pesertaecp_list->Tahun_Berdiri->cellAttributes() ?>>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Tahun_Berdiri" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Tahun_Berdiri" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Tahun_Berdiri" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Tahun_Berdiri" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Tahun_Berdiri->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Tahun_Berdiri->EditValue ?>"<?php echo $dm_pesertaecp_list->Tahun_Berdiri->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Tahun_Berdiri" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Tahun_Berdiri" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Tahun_Berdiri" value="<?php echo HtmlEncode($dm_pesertaecp_list->Tahun_Berdiri->OldValue) ?>">
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Tahun_Berdiri" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Tahun_Berdiri" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Tahun_Berdiri" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Tahun_Berdiri" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Tahun_Berdiri->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Tahun_Berdiri->EditValue ?>"<?php echo $dm_pesertaecp_list->Tahun_Berdiri->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Tahun_Berdiri">
<span<?php echo $dm_pesertaecp_list->Tahun_Berdiri->viewAttributes() ?>><?php echo $dm_pesertaecp_list->Tahun_Berdiri->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Wilayah_ECP->Visible) { // Wilayah_ECP ?>
		<td data-name="Wilayah_ECP" <?php echo $dm_pesertaecp_list->Wilayah_ECP->cellAttributes() ?>>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Wilayah_ECP" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dm_pesertaecp" data-field="x_Wilayah_ECP" data-value-separator="<?php echo $dm_pesertaecp_list->Wilayah_ECP->displayValueSeparatorAttribute() ?>" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Wilayah_ECP" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Wilayah_ECP"<?php echo $dm_pesertaecp_list->Wilayah_ECP->editAttributes() ?>>
			<?php echo $dm_pesertaecp_list->Wilayah_ECP->selectOptionListHtml("x{$dm_pesertaecp_list->RowIndex}_Wilayah_ECP") ?>
		</select>
</div>
<?php echo $dm_pesertaecp_list->Wilayah_ECP->Lookup->getParamTag($dm_pesertaecp_list, "p_x" . $dm_pesertaecp_list->RowIndex . "_Wilayah_ECP") ?>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Wilayah_ECP" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Wilayah_ECP" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Wilayah_ECP" value="<?php echo HtmlEncode($dm_pesertaecp_list->Wilayah_ECP->OldValue) ?>">
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Wilayah_ECP" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dm_pesertaecp" data-field="x_Wilayah_ECP" data-value-separator="<?php echo $dm_pesertaecp_list->Wilayah_ECP->displayValueSeparatorAttribute() ?>" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Wilayah_ECP" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Wilayah_ECP"<?php echo $dm_pesertaecp_list->Wilayah_ECP->editAttributes() ?>>
			<?php echo $dm_pesertaecp_list->Wilayah_ECP->selectOptionListHtml("x{$dm_pesertaecp_list->RowIndex}_Wilayah_ECP") ?>
		</select>
</div>
<?php echo $dm_pesertaecp_list->Wilayah_ECP->Lookup->getParamTag($dm_pesertaecp_list, "p_x" . $dm_pesertaecp_list->RowIndex . "_Wilayah_ECP") ?>
</span>
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Wilayah_ECP">
<span<?php echo $dm_pesertaecp_list->Wilayah_ECP->viewAttributes() ?>><?php echo $dm_pesertaecp_list->Wilayah_ECP->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Tahun_ECP->Visible) { // Tahun_ECP ?>
		<td data-name="Tahun_ECP" <?php echo $dm_pesertaecp_list->Tahun_ECP->cellAttributes() ?>>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Tahun_ECP" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Tahun_ECP" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Tahun_ECP" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Tahun_ECP" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Tahun_ECP->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Tahun_ECP->EditValue ?>"<?php echo $dm_pesertaecp_list->Tahun_ECP->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Tahun_ECP" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Tahun_ECP" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Tahun_ECP" value="<?php echo HtmlEncode($dm_pesertaecp_list->Tahun_ECP->OldValue) ?>">
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Tahun_ECP" class="form-group">
<input type="text" data-table="dm_pesertaecp" data-field="x_Tahun_ECP" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Tahun_ECP" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Tahun_ECP" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Tahun_ECP->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Tahun_ECP->EditValue ?>"<?php echo $dm_pesertaecp_list->Tahun_ECP->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dm_pesertaecp_list->RowCount ?>_dm_pesertaecp_Tahun_ECP">
<span<?php echo $dm_pesertaecp_list->Tahun_ECP->viewAttributes() ?>><?php echo $dm_pesertaecp_list->Tahun_ECP->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$dm_pesertaecp_list->ListOptions->render("body", "right", $dm_pesertaecp_list->RowCount);
?>
	</tr>
<?php if ($dm_pesertaecp->RowType == ROWTYPE_ADD || $dm_pesertaecp->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdm_pesertaecplist", "load"], function() {
	fdm_pesertaecplist.updateLists(<?php echo $dm_pesertaecp_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$dm_pesertaecp_list->isGridAdd())
		if (!$dm_pesertaecp_list->Recordset->EOF)
			$dm_pesertaecp_list->Recordset->moveNext();
}
?>
<?php
	if ($dm_pesertaecp_list->isGridAdd() || $dm_pesertaecp_list->isGridEdit()) {
		$dm_pesertaecp_list->RowIndex = '$rowindex$';
		$dm_pesertaecp_list->loadRowValues();

		// Set row properties
		$dm_pesertaecp->resetAttributes();
		$dm_pesertaecp->RowAttrs->merge(["data-rowindex" => $dm_pesertaecp_list->RowIndex, "id" => "r0_dm_pesertaecp", "data-rowtype" => ROWTYPE_ADD]);
		$dm_pesertaecp->RowAttrs->appendClass("ew-template");
		$dm_pesertaecp->RowType = ROWTYPE_ADD;

		// Render row
		$dm_pesertaecp_list->renderRow();

		// Render list options
		$dm_pesertaecp_list->renderListOptions();
		$dm_pesertaecp_list->StartRowCount = 0;
?>
	<tr <?php echo $dm_pesertaecp->rowAttributes() ?>>
<?php

// Render list options (body, left)
$dm_pesertaecp_list->ListOptions->render("body", "left", $dm_pesertaecp_list->RowIndex);
?>
	<?php if ($dm_pesertaecp_list->ID_Unik->Visible) { // ID_Unik ?>
		<td data-name="ID_Unik">
<span id="el$rowindex$_dm_pesertaecp_ID_Unik" class="form-group dm_pesertaecp_ID_Unik"></span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_ID_Unik" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_ID_Unik" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_ID_Unik" value="<?php echo HtmlEncode($dm_pesertaecp_list->ID_Unik->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Nama->Visible) { // Nama ?>
		<td data-name="Nama">
<span id="el$rowindex$_dm_pesertaecp_Nama" class="form-group dm_pesertaecp_Nama">
<input type="text" data-table="dm_pesertaecp" data-field="x_Nama" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Nama" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Nama" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Nama->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Nama->EditValue ?>"<?php echo $dm_pesertaecp_list->Nama->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Nama" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Nama" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Nama" value="<?php echo HtmlEncode($dm_pesertaecp_list->Nama->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Perusahaan->Visible) { // Perusahaan ?>
		<td data-name="Perusahaan">
<span id="el$rowindex$_dm_pesertaecp_Perusahaan" class="form-group dm_pesertaecp_Perusahaan">
<input type="text" data-table="dm_pesertaecp" data-field="x_Perusahaan" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Perusahaan" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Perusahaan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Perusahaan->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Perusahaan->EditValue ?>"<?php echo $dm_pesertaecp_list->Perusahaan->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Perusahaan" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Perusahaan" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Perusahaan" value="<?php echo HtmlEncode($dm_pesertaecp_list->Perusahaan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Produk->Visible) { // Produk ?>
		<td data-name="Produk">
<span id="el$rowindex$_dm_pesertaecp_Produk" class="form-group dm_pesertaecp_Produk">
<input type="text" data-table="dm_pesertaecp" data-field="x_Produk" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Produk" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Produk->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Produk->EditValue ?>"<?php echo $dm_pesertaecp_list->Produk->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Produk" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Produk" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Produk" value="<?php echo HtmlEncode($dm_pesertaecp_list->Produk->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Kapasitas_Produksi->Visible) { // Kapasitas_Produksi ?>
		<td data-name="Kapasitas_Produksi">
<span id="el$rowindex$_dm_pesertaecp_Kapasitas_Produksi" class="form-group dm_pesertaecp_Kapasitas_Produksi">
<input type="text" data-table="dm_pesertaecp" data-field="x_Kapasitas_Produksi" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Kapasitas_Produksi" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Kapasitas_Produksi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Kapasitas_Produksi->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Kapasitas_Produksi->EditValue ?>"<?php echo $dm_pesertaecp_list->Kapasitas_Produksi->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Kapasitas_Produksi" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Kapasitas_Produksi" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Kapasitas_Produksi" value="<?php echo HtmlEncode($dm_pesertaecp_list->Kapasitas_Produksi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Omset->Visible) { // Omset ?>
		<td data-name="Omset">
<span id="el$rowindex$_dm_pesertaecp_Omset" class="form-group dm_pesertaecp_Omset">
<input type="text" data-table="dm_pesertaecp" data-field="x_Omset" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Omset" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Omset" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Omset->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Omset->EditValue ?>"<?php echo $dm_pesertaecp_list->Omset->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Omset" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Omset" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Omset" value="<?php echo HtmlEncode($dm_pesertaecp_list->Omset->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Jumlah_Pegawai->Visible) { // Jumlah_Pegawai ?>
		<td data-name="Jumlah_Pegawai">
<span id="el$rowindex$_dm_pesertaecp_Jumlah_Pegawai" class="form-group dm_pesertaecp_Jumlah_Pegawai">
<input type="text" data-table="dm_pesertaecp" data-field="x_Jumlah_Pegawai" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Jumlah_Pegawai" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Jumlah_Pegawai" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Jumlah_Pegawai->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Jumlah_Pegawai->EditValue ?>"<?php echo $dm_pesertaecp_list->Jumlah_Pegawai->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Jumlah_Pegawai" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Jumlah_Pegawai" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Jumlah_Pegawai" value="<?php echo HtmlEncode($dm_pesertaecp_list->Jumlah_Pegawai->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Legalitas_Perusahaan->Visible) { // Legalitas_Perusahaan ?>
		<td data-name="Legalitas_Perusahaan">
<span id="el$rowindex$_dm_pesertaecp_Legalitas_Perusahaan" class="form-group dm_pesertaecp_Legalitas_Perusahaan">
<input type="text" data-table="dm_pesertaecp" data-field="x_Legalitas_Perusahaan" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Legalitas_Perusahaan" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Legalitas_Perusahaan" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Legalitas_Perusahaan->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Legalitas_Perusahaan->EditValue ?>"<?php echo $dm_pesertaecp_list->Legalitas_Perusahaan->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Legalitas_Perusahaan" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Legalitas_Perusahaan" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Legalitas_Perusahaan" value="<?php echo HtmlEncode($dm_pesertaecp_list->Legalitas_Perusahaan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Sertifikasi_dimiliki->Visible) { // Sertifikasi_dimiliki ?>
		<td data-name="Sertifikasi_dimiliki">
<span id="el$rowindex$_dm_pesertaecp_Sertifikasi_dimiliki" class="form-group dm_pesertaecp_Sertifikasi_dimiliki">
<input type="text" data-table="dm_pesertaecp" data-field="x_Sertifikasi_dimiliki" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Sertifikasi_dimiliki" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Sertifikasi_dimiliki" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Sertifikasi_dimiliki->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Sertifikasi_dimiliki->EditValue ?>"<?php echo $dm_pesertaecp_list->Sertifikasi_dimiliki->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Sertifikasi_dimiliki" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Sertifikasi_dimiliki" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Sertifikasi_dimiliki" value="<?php echo HtmlEncode($dm_pesertaecp_list->Sertifikasi_dimiliki->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Handphone->Visible) { // Handphone ?>
		<td data-name="Handphone">
<span id="el$rowindex$_dm_pesertaecp_Handphone" class="form-group dm_pesertaecp_Handphone">
<input type="text" data-table="dm_pesertaecp" data-field="x_Handphone" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Handphone" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Handphone" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Handphone->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Handphone->EditValue ?>"<?php echo $dm_pesertaecp_list->Handphone->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Handphone" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Handphone" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Handphone" value="<?php echo HtmlEncode($dm_pesertaecp_list->Handphone->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Email_Add->Visible) { // Email_Add ?>
		<td data-name="Email_Add">
<span id="el$rowindex$_dm_pesertaecp_Email_Add" class="form-group dm_pesertaecp_Email_Add">
<input type="text" data-table="dm_pesertaecp" data-field="x_Email_Add" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Email_Add" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Email_Add" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Email_Add->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Email_Add->EditValue ?>"<?php echo $dm_pesertaecp_list->Email_Add->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Email_Add" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Email_Add" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Email_Add" value="<?php echo HtmlEncode($dm_pesertaecp_list->Email_Add->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Website->Visible) { // Website ?>
		<td data-name="Website">
<span id="el$rowindex$_dm_pesertaecp_Website" class="form-group dm_pesertaecp_Website">
<input type="text" data-table="dm_pesertaecp" data-field="x_Website" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Website" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Website" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Website->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Website->EditValue ?>"<?php echo $dm_pesertaecp_list->Website->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Website" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Website" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Website" value="<?php echo HtmlEncode($dm_pesertaecp_list->Website->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Tahun_Berdiri->Visible) { // Tahun_Berdiri ?>
		<td data-name="Tahun_Berdiri">
<span id="el$rowindex$_dm_pesertaecp_Tahun_Berdiri" class="form-group dm_pesertaecp_Tahun_Berdiri">
<input type="text" data-table="dm_pesertaecp" data-field="x_Tahun_Berdiri" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Tahun_Berdiri" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Tahun_Berdiri" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Tahun_Berdiri->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Tahun_Berdiri->EditValue ?>"<?php echo $dm_pesertaecp_list->Tahun_Berdiri->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Tahun_Berdiri" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Tahun_Berdiri" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Tahun_Berdiri" value="<?php echo HtmlEncode($dm_pesertaecp_list->Tahun_Berdiri->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Wilayah_ECP->Visible) { // Wilayah_ECP ?>
		<td data-name="Wilayah_ECP">
<span id="el$rowindex$_dm_pesertaecp_Wilayah_ECP" class="form-group dm_pesertaecp_Wilayah_ECP">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dm_pesertaecp" data-field="x_Wilayah_ECP" data-value-separator="<?php echo $dm_pesertaecp_list->Wilayah_ECP->displayValueSeparatorAttribute() ?>" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Wilayah_ECP" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Wilayah_ECP"<?php echo $dm_pesertaecp_list->Wilayah_ECP->editAttributes() ?>>
			<?php echo $dm_pesertaecp_list->Wilayah_ECP->selectOptionListHtml("x{$dm_pesertaecp_list->RowIndex}_Wilayah_ECP") ?>
		</select>
</div>
<?php echo $dm_pesertaecp_list->Wilayah_ECP->Lookup->getParamTag($dm_pesertaecp_list, "p_x" . $dm_pesertaecp_list->RowIndex . "_Wilayah_ECP") ?>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Wilayah_ECP" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Wilayah_ECP" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Wilayah_ECP" value="<?php echo HtmlEncode($dm_pesertaecp_list->Wilayah_ECP->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dm_pesertaecp_list->Tahun_ECP->Visible) { // Tahun_ECP ?>
		<td data-name="Tahun_ECP">
<span id="el$rowindex$_dm_pesertaecp_Tahun_ECP" class="form-group dm_pesertaecp_Tahun_ECP">
<input type="text" data-table="dm_pesertaecp" data-field="x_Tahun_ECP" name="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Tahun_ECP" id="x<?php echo $dm_pesertaecp_list->RowIndex ?>_Tahun_ECP" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($dm_pesertaecp_list->Tahun_ECP->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_list->Tahun_ECP->EditValue ?>"<?php echo $dm_pesertaecp_list->Tahun_ECP->editAttributes() ?>>
</span>
<input type="hidden" data-table="dm_pesertaecp" data-field="x_Tahun_ECP" name="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Tahun_ECP" id="o<?php echo $dm_pesertaecp_list->RowIndex ?>_Tahun_ECP" value="<?php echo HtmlEncode($dm_pesertaecp_list->Tahun_ECP->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$dm_pesertaecp_list->ListOptions->render("body", "right", $dm_pesertaecp_list->RowIndex);
?>
<script>
loadjs.ready(["fdm_pesertaecplist", "load"], function() {
	fdm_pesertaecplist.updateLists(<?php echo $dm_pesertaecp_list->RowIndex ?>);
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
<?php if ($dm_pesertaecp_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $dm_pesertaecp_list->FormKeyCountName ?>" id="<?php echo $dm_pesertaecp_list->FormKeyCountName ?>" value="<?php echo $dm_pesertaecp_list->KeyCount ?>">
<?php echo $dm_pesertaecp_list->MultiSelectKey ?>
<?php } ?>
<?php if ($dm_pesertaecp_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $dm_pesertaecp_list->FormKeyCountName ?>" id="<?php echo $dm_pesertaecp_list->FormKeyCountName ?>" value="<?php echo $dm_pesertaecp_list->KeyCount ?>">
<?php echo $dm_pesertaecp_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$dm_pesertaecp->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($dm_pesertaecp_list->Recordset)
	$dm_pesertaecp_list->Recordset->Close();
?>
<?php if (!$dm_pesertaecp_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$dm_pesertaecp_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $dm_pesertaecp_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $dm_pesertaecp_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($dm_pesertaecp_list->TotalRecords == 0 && !$dm_pesertaecp->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $dm_pesertaecp_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$dm_pesertaecp_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$dm_pesertaecp_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php if (!$dm_pesertaecp->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_dm_pesertaecp",
		width: "100%",
		height: "500px"
	});
});
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$dm_pesertaecp_list->terminate();
?>