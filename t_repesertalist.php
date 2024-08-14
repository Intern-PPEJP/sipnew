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
$t_repeserta_list = new t_repeserta_list();

// Run the page
$t_repeserta_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_repeserta_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_repeserta_list->isExport()) { ?>
<script>
var ft_repesertalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_repesertalist = currentForm = new ew.Form("ft_repesertalist", "list");
	ft_repesertalist.formKeyCountName = '<?php echo $t_repeserta_list->FormKeyCountName ?>';
	loadjs.done("ft_repesertalist");
});
var ft_repesertalistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_repesertalistsrch = currentSearchForm = new ew.Form("ft_repesertalistsrch");

	// Validate function for search
	ft_repesertalistsrch.validate = function(fobj) {
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
	ft_repesertalistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_repesertalistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_repesertalistsrch.lists["x_konfirmasi"] = <?php echo $t_repeserta_list->konfirmasi->Lookup->toClientList($t_repeserta_list) ?>;
	ft_repesertalistsrch.lists["x_konfirmasi"].options = <?php echo JsonEncode($t_repeserta_list->konfirmasi->options(FALSE, TRUE)) ?>;

	// Filters
	ft_repesertalistsrch.filterList = <?php echo $t_repeserta_list->getFilterList() ?>;
	loadjs.done("ft_repesertalistsrch");
});
</script>
<script>
ew.ready("head", "js/ewfixedheadertable.js", "fixedheadertable");
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//document.write('<?php echo cs_judul("list","Daftar Rekrutmen Peserta");?>');

});
</script>
<?php } ?>
<?php if (!$t_repeserta_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_repeserta_list->TotalRecords > 0 && $t_repeserta_list->ExportOptions->visible()) { ?>
<?php $t_repeserta_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_repeserta_list->ImportOptions->visible()) { ?>
<?php $t_repeserta_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_repeserta_list->SearchOptions->visible()) { ?>
<?php $t_repeserta_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_repeserta_list->FilterOptions->visible()) { ?>
<?php $t_repeserta_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$t_repeserta_list->isExport() || Config("EXPORT_MASTER_RECORD") && $t_repeserta_list->isExport("print")) { ?>
<?php
if ($t_repeserta_list->DbMasterFilter != "" && $t_repeserta->getCurrentMasterTable() == "cv_pelrepes") {
	if ($t_repeserta_list->MasterRecordExists) {
		include_once "cv_pelrepesmaster.php";
	}
}
?>
<?php } ?>
<?php
$t_repeserta_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_repeserta_list->isExport() && !$t_repeserta->CurrentAction) { ?>
<form name="ft_repesertalistsrch" id="ft_repesertalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_repesertalistsrch-search-panel" class="<?php echo $t_repeserta_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_repeserta">
	<div class="ew-extended-search">
<?php

// Render search row
$t_repeserta->RowType = ROWTYPE_SEARCH;
$t_repeserta->resetAttributes();
$t_repeserta_list->renderRow();
?>
<?php if ($t_repeserta_list->konfirmasi->Visible) { // konfirmasi ?>
	<?php
		$t_repeserta_list->SearchColumnCount++;
		if (($t_repeserta_list->SearchColumnCount - 1) % $t_repeserta_list->SearchFieldsPerRow == 0) {
			$t_repeserta_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_repeserta_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_konfirmasi" class="ew-cell form-group">
		<label for="x_konfirmasi" class="ew-search-caption ew-label"><?php echo $t_repeserta_list->konfirmasi->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_konfirmasi" id="z_konfirmasi" value="LIKE">
</span>
		<span id="el_t_repeserta_konfirmasi" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_repeserta" data-field="x_konfirmasi" data-value-separator="<?php echo $t_repeserta_list->konfirmasi->displayValueSeparatorAttribute() ?>" id="x_konfirmasi" name="x_konfirmasi"<?php echo $t_repeserta_list->konfirmasi->editAttributes() ?>>
			<?php echo $t_repeserta_list->konfirmasi->selectOptionListHtml("x_konfirmasi") ?>
		</select>
</div>
</span>
	</div>
	<?php if ($t_repeserta_list->SearchColumnCount % $t_repeserta_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($t_repeserta_list->SearchColumnCount % $t_repeserta_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $t_repeserta_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_repeserta_list->showPageHeader(); ?>
<?php
$t_repeserta_list->showMessage();
?>
<?php if ($t_repeserta_list->TotalRecords > 0 || $t_repeserta->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_repeserta_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_repeserta">
<?php if (!$t_repeserta_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_repeserta_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_repeserta_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_repeserta_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_repesertalist" id="ft_repesertalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_repeserta">
<?php if ($t_repeserta->getCurrentMasterTable() == "cv_pelrepes" && $t_repeserta->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="cv_pelrepes">
<input type="hidden" name="fk_idpelat" value="<?php echo HtmlEncode($t_repeserta_list->idpelat->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_t_repeserta" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_repeserta_list->TotalRecords > 0 || $t_repeserta_list->isGridEdit()) { ?>
<table id="tbl_t_repesertalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_repeserta->RowType = ROWTYPE_HEADER;

// Render list options
$t_repeserta_list->renderListOptions();

// Render list options (header, left)
$t_repeserta_list->ListOptions->render("header", "left");
?>
<?php if ($t_repeserta_list->nama->Visible) { // nama ?>
	<?php if ($t_repeserta_list->SortUrl($t_repeserta_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $t_repeserta_list->nama->headerCellClass() ?>"><div id="elh_t_repeserta_nama" class="t_repeserta_nama"><div class="ew-table-header-caption"><?php echo $t_repeserta_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $t_repeserta_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_repeserta_list->SortUrl($t_repeserta_list->nama) ?>', 1);"><div id="elh_t_repeserta_nama" class="t_repeserta_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_list->nama->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_list->perusahaan->Visible) { // perusahaan ?>
	<?php if ($t_repeserta_list->SortUrl($t_repeserta_list->perusahaan) == "") { ?>
		<th data-name="perusahaan" class="<?php echo $t_repeserta_list->perusahaan->headerCellClass() ?>"><div id="elh_t_repeserta_perusahaan" class="t_repeserta_perusahaan"><div class="ew-table-header-caption"><?php echo $t_repeserta_list->perusahaan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="perusahaan" class="<?php echo $t_repeserta_list->perusahaan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_repeserta_list->SortUrl($t_repeserta_list->perusahaan) ?>', 1);"><div id="elh_t_repeserta_perusahaan" class="t_repeserta_perusahaan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_list->perusahaan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_list->perusahaan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_list->perusahaan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_list->jabatan->Visible) { // jabatan ?>
	<?php if ($t_repeserta_list->SortUrl($t_repeserta_list->jabatan) == "") { ?>
		<th data-name="jabatan" class="<?php echo $t_repeserta_list->jabatan->headerCellClass() ?>"><div id="elh_t_repeserta_jabatan" class="t_repeserta_jabatan"><div class="ew-table-header-caption"><?php echo $t_repeserta_list->jabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan" class="<?php echo $t_repeserta_list->jabatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_repeserta_list->SortUrl($t_repeserta_list->jabatan) ?>', 1);"><div id="elh_t_repeserta_jabatan" class="t_repeserta_jabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_list->jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_list->jabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_list->jabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_list->tgl_daftar->Visible) { // tgl_daftar ?>
	<?php if ($t_repeserta_list->SortUrl($t_repeserta_list->tgl_daftar) == "") { ?>
		<th data-name="tgl_daftar" class="<?php echo $t_repeserta_list->tgl_daftar->headerCellClass() ?>"><div id="elh_t_repeserta_tgl_daftar" class="t_repeserta_tgl_daftar"><div class="ew-table-header-caption"><?php echo $t_repeserta_list->tgl_daftar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_daftar" class="<?php echo $t_repeserta_list->tgl_daftar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_repeserta_list->SortUrl($t_repeserta_list->tgl_daftar) ?>', 1);"><div id="elh_t_repeserta_tgl_daftar" class="t_repeserta_tgl_daftar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_list->tgl_daftar->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_list->tgl_daftar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_list->tgl_daftar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_list->telp->Visible) { // telp ?>
	<?php if ($t_repeserta_list->SortUrl($t_repeserta_list->telp) == "") { ?>
		<th data-name="telp" class="<?php echo $t_repeserta_list->telp->headerCellClass() ?>"><div id="elh_t_repeserta_telp" class="t_repeserta_telp"><div class="ew-table-header-caption"><?php echo $t_repeserta_list->telp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telp" class="<?php echo $t_repeserta_list->telp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_repeserta_list->SortUrl($t_repeserta_list->telp) ?>', 1);"><div id="elh_t_repeserta_telp" class="t_repeserta_telp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_list->telp->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_list->telp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_list->telp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_list->fax->Visible) { // fax ?>
	<?php if ($t_repeserta_list->SortUrl($t_repeserta_list->fax) == "") { ?>
		<th data-name="fax" class="<?php echo $t_repeserta_list->fax->headerCellClass() ?>"><div id="elh_t_repeserta_fax" class="t_repeserta_fax"><div class="ew-table-header-caption"><?php echo $t_repeserta_list->fax->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fax" class="<?php echo $t_repeserta_list->fax->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_repeserta_list->SortUrl($t_repeserta_list->fax) ?>', 1);"><div id="elh_t_repeserta_fax" class="t_repeserta_fax">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_list->fax->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_list->fax->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_list->fax->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_list->hp->Visible) { // hp ?>
	<?php if ($t_repeserta_list->SortUrl($t_repeserta_list->hp) == "") { ?>
		<th data-name="hp" class="<?php echo $t_repeserta_list->hp->headerCellClass() ?>"><div id="elh_t_repeserta_hp" class="t_repeserta_hp"><div class="ew-table-header-caption"><?php echo $t_repeserta_list->hp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hp" class="<?php echo $t_repeserta_list->hp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_repeserta_list->SortUrl($t_repeserta_list->hp) ?>', 1);"><div id="elh_t_repeserta_hp" class="t_repeserta_hp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_list->hp->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_list->hp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_list->hp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_list->produk->Visible) { // produk ?>
	<?php if ($t_repeserta_list->SortUrl($t_repeserta_list->produk) == "") { ?>
		<th data-name="produk" class="<?php echo $t_repeserta_list->produk->headerCellClass() ?>"><div id="elh_t_repeserta_produk" class="t_repeserta_produk"><div class="ew-table-header-caption"><?php echo $t_repeserta_list->produk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="produk" class="<?php echo $t_repeserta_list->produk->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_repeserta_list->SortUrl($t_repeserta_list->produk) ?>', 1);"><div id="elh_t_repeserta_produk" class="t_repeserta_produk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_list->produk->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_list->produk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_list->produk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_list->cara_bayar->Visible) { // cara_bayar ?>
	<?php if ($t_repeserta_list->SortUrl($t_repeserta_list->cara_bayar) == "") { ?>
		<th data-name="cara_bayar" class="<?php echo $t_repeserta_list->cara_bayar->headerCellClass() ?>"><div id="elh_t_repeserta_cara_bayar" class="t_repeserta_cara_bayar"><div class="ew-table-header-caption"><?php echo $t_repeserta_list->cara_bayar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cara_bayar" class="<?php echo $t_repeserta_list->cara_bayar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_repeserta_list->SortUrl($t_repeserta_list->cara_bayar) ?>', 1);"><div id="elh_t_repeserta_cara_bayar" class="t_repeserta_cara_bayar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_list->cara_bayar->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_list->cara_bayar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_list->cara_bayar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_list->ket_bayar->Visible) { // ket_bayar ?>
	<?php if ($t_repeserta_list->SortUrl($t_repeserta_list->ket_bayar) == "") { ?>
		<th data-name="ket_bayar" class="<?php echo $t_repeserta_list->ket_bayar->headerCellClass() ?>"><div id="elh_t_repeserta_ket_bayar" class="t_repeserta_ket_bayar"><div class="ew-table-header-caption"><?php echo $t_repeserta_list->ket_bayar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ket_bayar" class="<?php echo $t_repeserta_list->ket_bayar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_repeserta_list->SortUrl($t_repeserta_list->ket_bayar) ?>', 1);"><div id="elh_t_repeserta_ket_bayar" class="t_repeserta_ket_bayar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_list->ket_bayar->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_list->ket_bayar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_list->ket_bayar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_list->tgl_bayar->Visible) { // tgl_bayar ?>
	<?php if ($t_repeserta_list->SortUrl($t_repeserta_list->tgl_bayar) == "") { ?>
		<th data-name="tgl_bayar" class="<?php echo $t_repeserta_list->tgl_bayar->headerCellClass() ?>"><div id="elh_t_repeserta_tgl_bayar" class="t_repeserta_tgl_bayar"><div class="ew-table-header-caption"><?php echo $t_repeserta_list->tgl_bayar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_bayar" class="<?php echo $t_repeserta_list->tgl_bayar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_repeserta_list->SortUrl($t_repeserta_list->tgl_bayar) ?>', 1);"><div id="elh_t_repeserta_tgl_bayar" class="t_repeserta_tgl_bayar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_list->tgl_bayar->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_list->tgl_bayar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_list->tgl_bayar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_list->kdinformasi->Visible) { // kdinformasi ?>
	<?php if ($t_repeserta_list->SortUrl($t_repeserta_list->kdinformasi) == "") { ?>
		<th data-name="kdinformasi" class="<?php echo $t_repeserta_list->kdinformasi->headerCellClass() ?>"><div id="elh_t_repeserta_kdinformasi" class="t_repeserta_kdinformasi"><div class="ew-table-header-caption"><?php echo $t_repeserta_list->kdinformasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdinformasi" class="<?php echo $t_repeserta_list->kdinformasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_repeserta_list->SortUrl($t_repeserta_list->kdinformasi) ?>', 1);"><div id="elh_t_repeserta_kdinformasi" class="t_repeserta_kdinformasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_list->kdinformasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_list->kdinformasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_list->kdinformasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_list->konfirmasi->Visible) { // konfirmasi ?>
	<?php if ($t_repeserta_list->SortUrl($t_repeserta_list->konfirmasi) == "") { ?>
		<th data-name="konfirmasi" class="<?php echo $t_repeserta_list->konfirmasi->headerCellClass() ?>"><div id="elh_t_repeserta_konfirmasi" class="t_repeserta_konfirmasi"><div class="ew-table-header-caption"><?php echo $t_repeserta_list->konfirmasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="konfirmasi" class="<?php echo $t_repeserta_list->konfirmasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_repeserta_list->SortUrl($t_repeserta_list->konfirmasi) ?>', 1);"><div id="elh_t_repeserta_konfirmasi" class="t_repeserta_konfirmasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_list->konfirmasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_list->konfirmasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_list->konfirmasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_list->ket->Visible) { // ket ?>
	<?php if ($t_repeserta_list->SortUrl($t_repeserta_list->ket) == "") { ?>
		<th data-name="ket" class="<?php echo $t_repeserta_list->ket->headerCellClass() ?>"><div id="elh_t_repeserta_ket" class="t_repeserta_ket"><div class="ew-table-header-caption"><?php echo $t_repeserta_list->ket->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ket" class="<?php echo $t_repeserta_list->ket->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_repeserta_list->SortUrl($t_repeserta_list->ket) ?>', 1);"><div id="elh_t_repeserta_ket" class="t_repeserta_ket">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_list->ket->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_list->ket->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_list->ket->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_repeserta_list->ket_lainnya->Visible) { // ket_lainnya ?>
	<?php if ($t_repeserta_list->SortUrl($t_repeserta_list->ket_lainnya) == "") { ?>
		<th data-name="ket_lainnya" class="<?php echo $t_repeserta_list->ket_lainnya->headerCellClass() ?>"><div id="elh_t_repeserta_ket_lainnya" class="t_repeserta_ket_lainnya"><div class="ew-table-header-caption"><?php echo $t_repeserta_list->ket_lainnya->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ket_lainnya" class="<?php echo $t_repeserta_list->ket_lainnya->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_repeserta_list->SortUrl($t_repeserta_list->ket_lainnya) ?>', 1);"><div id="elh_t_repeserta_ket_lainnya" class="t_repeserta_ket_lainnya">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_repeserta_list->ket_lainnya->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_repeserta_list->ket_lainnya->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_repeserta_list->ket_lainnya->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_repeserta_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_repeserta_list->ExportAll && $t_repeserta_list->isExport()) {
	$t_repeserta_list->StopRecord = $t_repeserta_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_repeserta_list->TotalRecords > $t_repeserta_list->StartRecord + $t_repeserta_list->DisplayRecords - 1)
		$t_repeserta_list->StopRecord = $t_repeserta_list->StartRecord + $t_repeserta_list->DisplayRecords - 1;
	else
		$t_repeserta_list->StopRecord = $t_repeserta_list->TotalRecords;
}
$t_repeserta_list->RecordCount = $t_repeserta_list->StartRecord - 1;
if ($t_repeserta_list->Recordset && !$t_repeserta_list->Recordset->EOF) {
	$t_repeserta_list->Recordset->moveFirst();
	$selectLimit = $t_repeserta_list->UseSelectLimit;
	if (!$selectLimit && $t_repeserta_list->StartRecord > 1)
		$t_repeserta_list->Recordset->move($t_repeserta_list->StartRecord - 1);
} elseif (!$t_repeserta->AllowAddDeleteRow && $t_repeserta_list->StopRecord == 0) {
	$t_repeserta_list->StopRecord = $t_repeserta->GridAddRowCount;
}

// Initialize aggregate
$t_repeserta->RowType = ROWTYPE_AGGREGATEINIT;
$t_repeserta->resetAttributes();
$t_repeserta_list->renderRow();
while ($t_repeserta_list->RecordCount < $t_repeserta_list->StopRecord) {
	$t_repeserta_list->RecordCount++;
	if ($t_repeserta_list->RecordCount >= $t_repeserta_list->StartRecord) {
		$t_repeserta_list->RowCount++;

		// Set up key count
		$t_repeserta_list->KeyCount = $t_repeserta_list->RowIndex;

		// Init row class and style
		$t_repeserta->resetAttributes();
		$t_repeserta->CssClass = "";
		if ($t_repeserta_list->isGridAdd()) {
		} else {
			$t_repeserta_list->loadRowValues($t_repeserta_list->Recordset); // Load row values
		}
		$t_repeserta->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_repeserta->RowAttrs->merge(["data-rowindex" => $t_repeserta_list->RowCount, "id" => "r" . $t_repeserta_list->RowCount . "_t_repeserta", "data-rowtype" => $t_repeserta->RowType]);

		// Render row
		$t_repeserta_list->renderRow();

		// Render list options
		$t_repeserta_list->renderListOptions();
?>
	<tr <?php echo $t_repeserta->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_repeserta_list->ListOptions->render("body", "left", $t_repeserta_list->RowCount);
?>
	<?php if ($t_repeserta_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $t_repeserta_list->nama->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_list->RowCount ?>_t_repeserta_nama">
<span<?php echo $t_repeserta_list->nama->viewAttributes() ?>><?php echo $t_repeserta_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_repeserta_list->perusahaan->Visible) { // perusahaan ?>
		<td data-name="perusahaan" <?php echo $t_repeserta_list->perusahaan->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_list->RowCount ?>_t_repeserta_perusahaan">
<span<?php echo $t_repeserta_list->perusahaan->viewAttributes() ?>><?php echo $t_repeserta_list->perusahaan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_repeserta_list->jabatan->Visible) { // jabatan ?>
		<td data-name="jabatan" <?php echo $t_repeserta_list->jabatan->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_list->RowCount ?>_t_repeserta_jabatan">
<span<?php echo $t_repeserta_list->jabatan->viewAttributes() ?>><?php echo $t_repeserta_list->jabatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_repeserta_list->tgl_daftar->Visible) { // tgl_daftar ?>
		<td data-name="tgl_daftar" <?php echo $t_repeserta_list->tgl_daftar->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_list->RowCount ?>_t_repeserta_tgl_daftar">
<span<?php echo $t_repeserta_list->tgl_daftar->viewAttributes() ?>><?php echo $t_repeserta_list->tgl_daftar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_repeserta_list->telp->Visible) { // telp ?>
		<td data-name="telp" <?php echo $t_repeserta_list->telp->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_list->RowCount ?>_t_repeserta_telp">
<span<?php echo $t_repeserta_list->telp->viewAttributes() ?>><?php echo $t_repeserta_list->telp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_repeserta_list->fax->Visible) { // fax ?>
		<td data-name="fax" <?php echo $t_repeserta_list->fax->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_list->RowCount ?>_t_repeserta_fax">
<span<?php echo $t_repeserta_list->fax->viewAttributes() ?>><?php echo $t_repeserta_list->fax->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_repeserta_list->hp->Visible) { // hp ?>
		<td data-name="hp" <?php echo $t_repeserta_list->hp->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_list->RowCount ?>_t_repeserta_hp">
<span<?php echo $t_repeserta_list->hp->viewAttributes() ?>><?php echo $t_repeserta_list->hp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_repeserta_list->produk->Visible) { // produk ?>
		<td data-name="produk" <?php echo $t_repeserta_list->produk->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_list->RowCount ?>_t_repeserta_produk">
<span<?php echo $t_repeserta_list->produk->viewAttributes() ?>><?php echo $t_repeserta_list->produk->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_repeserta_list->cara_bayar->Visible) { // cara_bayar ?>
		<td data-name="cara_bayar" <?php echo $t_repeserta_list->cara_bayar->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_list->RowCount ?>_t_repeserta_cara_bayar">
<span<?php echo $t_repeserta_list->cara_bayar->viewAttributes() ?>><?php echo $t_repeserta_list->cara_bayar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_repeserta_list->ket_bayar->Visible) { // ket_bayar ?>
		<td data-name="ket_bayar" <?php echo $t_repeserta_list->ket_bayar->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_list->RowCount ?>_t_repeserta_ket_bayar">
<span<?php echo $t_repeserta_list->ket_bayar->viewAttributes() ?>><?php echo $t_repeserta_list->ket_bayar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_repeserta_list->tgl_bayar->Visible) { // tgl_bayar ?>
		<td data-name="tgl_bayar" <?php echo $t_repeserta_list->tgl_bayar->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_list->RowCount ?>_t_repeserta_tgl_bayar">
<span<?php echo $t_repeserta_list->tgl_bayar->viewAttributes() ?>><?php echo $t_repeserta_list->tgl_bayar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_repeserta_list->kdinformasi->Visible) { // kdinformasi ?>
		<td data-name="kdinformasi" <?php echo $t_repeserta_list->kdinformasi->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_list->RowCount ?>_t_repeserta_kdinformasi">
<span<?php echo $t_repeserta_list->kdinformasi->viewAttributes() ?>><?php echo $t_repeserta_list->kdinformasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_repeserta_list->konfirmasi->Visible) { // konfirmasi ?>
		<td data-name="konfirmasi" <?php echo $t_repeserta_list->konfirmasi->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_list->RowCount ?>_t_repeserta_konfirmasi">
<span<?php echo $t_repeserta_list->konfirmasi->viewAttributes() ?>><?php echo $t_repeserta_list->konfirmasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_repeserta_list->ket->Visible) { // ket ?>
		<td data-name="ket" <?php echo $t_repeserta_list->ket->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_list->RowCount ?>_t_repeserta_ket">
<span<?php echo $t_repeserta_list->ket->viewAttributes() ?>><?php echo $t_repeserta_list->ket->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_repeserta_list->ket_lainnya->Visible) { // ket_lainnya ?>
		<td data-name="ket_lainnya" <?php echo $t_repeserta_list->ket_lainnya->cellAttributes() ?>>
<span id="el<?php echo $t_repeserta_list->RowCount ?>_t_repeserta_ket_lainnya">
<span<?php echo $t_repeserta_list->ket_lainnya->viewAttributes() ?>><?php echo $t_repeserta_list->ket_lainnya->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_repeserta_list->ListOptions->render("body", "right", $t_repeserta_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_repeserta_list->isGridAdd())
		$t_repeserta_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_repeserta->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_repeserta_list->Recordset)
	$t_repeserta_list->Recordset->Close();
?>
<?php if (!$t_repeserta_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_repeserta_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_repeserta_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_repeserta_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_repeserta_list->TotalRecords == 0 && !$t_repeserta->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_repeserta_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_repeserta_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_repeserta_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php if (!$t_repeserta->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_t_repeserta",
		width: "100%",
		height: "350px"
	});
});
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$t_repeserta_list->terminate();
?>