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
$t_peserta_list = new t_peserta_list();

// Run the page
$t_peserta_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_peserta_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_peserta_list->isExport()) { ?>
<script>
var ft_pesertalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_pesertalist = currentForm = new ew.Form("ft_pesertalist", "list");
	ft_pesertalist.formKeyCountName = '<?php echo $t_peserta_list->FormKeyCountName ?>';
	loadjs.done("ft_pesertalist");
});
var ft_pesertalistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_pesertalistsrch = currentSearchForm = new ew.Form("ft_pesertalistsrch");

	// Validate function for search
	ft_pesertalistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_peserta_list->id->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	ft_pesertalistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_pesertalistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_pesertalistsrch.lists["x_id"] = <?php echo $t_peserta_list->id->Lookup->toClientList($t_peserta_list) ?>;
	ft_pesertalistsrch.lists["x_id"].options = <?php echo JsonEncode($t_peserta_list->id->lookupOptions()) ?>;
	ft_pesertalistsrch.autoSuggests["x_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

	// Filters
	ft_pesertalistsrch.filterList = <?php echo $t_peserta_list->getFilterList() ?>;
	loadjs.done("ft_pesertalistsrch");
});
</script>

<script>
ew.ready("head", "js/ewfixedheadertable.js", "fixedheadertable");
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	////document.write('<?php echo cs_judul("list","Daftar Peserta");?>');
	//ft_pesertalist.Lists["x_kdkota"].ParentFields = ["x_kdprop"];
	//ft_pesertalist.Lists["x_kdkota"].FilterFields = ["x_kdprop"];
	//ft_pesertalist.Lists["x_kdkec"].ParentFields = ["x_kdkota"];
	//ft_pesertalist.Lists["x_kdkec"].FilterFields = ["x_kdkota"];

});
</script>

<?php } ?>

<?php if (!$t_peserta_list->isExport()) { ?>

<div class="btn-toolbar ew-toolbar">
<?php if ($t_peserta_list->TotalRecords > 0 && $t_peserta_list->ExportOptions->visible()) { ?>
<?php $t_peserta_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_peserta_list->ImportOptions->visible()) { ?>
<?php $t_peserta_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_peserta_list->SearchOptions->visible()) { ?>
<?php $t_peserta_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_peserta_list->FilterOptions->visible()) { ?>
<?php $t_peserta_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>

<?php } ?>

<?php if (!$t_peserta_list->isExport() || Config("EXPORT_MASTER_RECORD") && $t_peserta_list->isExport("print")) { ?>

<?php
if ($t_peserta_list->DbMasterFilter != "" && $t_peserta->getCurrentMasterTable() == "t_perusahaan") {
	if ($t_peserta_list->MasterRecordExists) {
		include_once "t_perusahaanmaster.php";
	}
}
?>

<?php
if ($t_peserta_list->DbMasterFilter != "" && $t_peserta->getCurrentMasterTable() == "t_kota") {
	if ($t_peserta_list->MasterRecordExists) {
		include_once "t_kotamaster.php";
	}
}
?>

<?php
if ($t_peserta_list->DbMasterFilter != "" && $t_peserta->getCurrentMasterTable() == "t_prop") {
	if ($t_peserta_list->MasterRecordExists) {
		include_once "t_propmaster.php";
	}
}
?>

<?php } ?>

<?php
$t_peserta_list->renderOtherOptions();

?>
<?php if ($Security->CanSearch()) { ?>

<?php if (!$t_peserta_list->isExport() && !$t_peserta->CurrentAction) { ?>

<form name="ft_pesertalistsrch" id="ft_pesertalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_pesertalistsrch-search-panel" class="<?php echo $t_peserta_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_peserta">
	<div class="ew-extended-search">

<?php
// Render search row
$t_peserta->RowType = ROWTYPE_SEARCH;
$t_peserta->resetAttributes();
$t_peserta_list->renderRow();
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
}

.ew-search-field input,
.ew-search-field select {
    width: 300px; /* Atur lebar input dan select agar seragam */
}

.input-group .custom-select {
    width: 300px; /* Atur lebar select di dalam input-group */
}
</style>

<?php if ($t_peserta_list->id->Visible) { // id ?>
	<?php
		$t_peserta_list->SearchColumnCount++;
		if (($t_peserta_list->SearchColumnCount - 1) % $t_peserta_list->SearchFieldsPerRow == 0) {
			$t_peserta_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_peserta_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $t_peserta_list->id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
		<span id="el_t_peserta_id" class="ew-search-field">
<?php
$onchange = $t_peserta_list->id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_peserta_list->id->EditAttrs["onchange"] = "";
?>
<span id="as_x_id">
	<input type="text" class="form-control" name="sv_x_id" id="sv_x_id" value="<?php echo RemoveHtml($t_peserta_list->id->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($t_peserta_list->id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_peserta_list->id->getPlaceHolder()) ?>"<?php echo $t_peserta_list->id->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_id" data-value-separator="<?php echo $t_peserta_list->id->displayValueSeparatorAttribute() ?>" name="x_id" id="x_id" value="<?php echo HtmlEncode($t_peserta_list->id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>

<script>
loadjs.ready(["ft_pesertalistsrch"], function() {
	ft_pesertalistsrch.createAutoSuggest({"id":"x_id","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>

<?php echo $t_peserta_list->id->Lookup->getParamTag($t_peserta_list, "p_x_id") ?>
</span>
	</div>
	<?php if ($t_peserta_list->SearchColumnCount % $t_peserta_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>

	<?php if ($t_peserta_list->SearchColumnCount % $t_peserta_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>

<div id="xsr_<?php echo $t_peserta_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_peserta_list->showPageHeader(); ?>
<?php
$t_peserta_list->showMessage();
?>
<?php if ($t_peserta_list->TotalRecords > 0 || $t_peserta->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_peserta_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_peserta">
<?php if (!$t_peserta_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_peserta_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_peserta_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_peserta_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_pesertalist" id="ft_pesertalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_peserta">
<?php if ($t_peserta->getCurrentMasterTable() == "t_perusahaan" && $t_peserta->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_perusahaan">
<input type="hidden" name="fk_idp" value="<?php echo HtmlEncode($t_peserta_list->idp->getSessionValue()) ?>">
<?php } ?>
<?php if ($t_peserta->getCurrentMasterTable() == "t_kota" && $t_peserta->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_kota">
<input type="hidden" name="fk_kdkota" value="<?php echo HtmlEncode($t_peserta_list->kdkota->getSessionValue()) ?>">
<?php } ?>
<?php if ($t_peserta->getCurrentMasterTable() == "t_prop" && $t_peserta->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_prop">
<input type="hidden" name="fk_kdprop" value="<?php echo HtmlEncode($t_peserta_list->kdprop->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_t_peserta" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_peserta_list->TotalRecords > 0 || $t_peserta_list->isGridEdit()) { ?>
<table id="tbl_t_pesertalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_peserta->RowType = ROWTYPE_HEADER;

// Render list options
$t_peserta_list->renderListOptions();

// Render list options (header, left)
$t_peserta_list->ListOptions->render("header", "left");
?>
<?php if ($t_peserta_list->id->Visible) { // id ?>
	<?php if ($t_peserta_list->SortUrl($t_peserta_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $t_peserta_list->id->headerCellClass() ?>"><div id="elh_t_peserta_id" class="t_peserta_id"><div class="ew-table-header-caption"><?php echo $t_peserta_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $t_peserta_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_peserta_list->SortUrl($t_peserta_list->id) ?>', 1);"><div id="elh_t_peserta_id" class="t_peserta_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_list->nama->Visible) { // nama ?>
	<?php if ($t_peserta_list->SortUrl($t_peserta_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $t_peserta_list->nama->headerCellClass() ?>"><div id="elh_t_peserta_nama" class="t_peserta_nama"><div class="ew-table-header-caption"><?php echo $t_peserta_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $t_peserta_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_peserta_list->SortUrl($t_peserta_list->nama) ?>', 1);"><div id="elh_t_peserta_nama" class="t_peserta_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_list->nama->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_list->idp->Visible) { // idp ?>
	<?php if ($t_peserta_list->SortUrl($t_peserta_list->idp) == "") { ?>
		<th data-name="idp" class="<?php echo $t_peserta_list->idp->headerCellClass() ?>"><div id="elh_t_peserta_idp" class="t_peserta_idp"><div class="ew-table-header-caption"><?php echo $t_peserta_list->idp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idp" class="<?php echo $t_peserta_list->idp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_peserta_list->SortUrl($t_peserta_list->idp) ?>', 1);"><div id="elh_t_peserta_idp" class="t_peserta_idp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_list->idp->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_list->idp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_list->idp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_list->tempat->Visible) { // tempat ?>
	<?php if ($t_peserta_list->SortUrl($t_peserta_list->tempat) == "") { ?>
		<th data-name="tempat" class="<?php echo $t_peserta_list->tempat->headerCellClass() ?>"><div id="elh_t_peserta_tempat" class="t_peserta_tempat"><div class="ew-table-header-caption"><?php echo $t_peserta_list->tempat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tempat" class="<?php echo $t_peserta_list->tempat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_peserta_list->SortUrl($t_peserta_list->tempat) ?>', 1);"><div id="elh_t_peserta_tempat" class="t_peserta_tempat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_list->tempat->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_list->tempat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_list->tempat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_list->kdagama->Visible) { // kdagama ?>
	<?php if ($t_peserta_list->SortUrl($t_peserta_list->kdagama) == "") { ?>
		<th data-name="kdagama" class="<?php echo $t_peserta_list->kdagama->headerCellClass() ?>"><div id="elh_t_peserta_kdagama" class="t_peserta_kdagama"><div class="ew-table-header-caption"><?php echo $t_peserta_list->kdagama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdagama" class="<?php echo $t_peserta_list->kdagama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_peserta_list->SortUrl($t_peserta_list->kdagama) ?>', 1);"><div id="elh_t_peserta_kdagama" class="t_peserta_kdagama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_list->kdagama->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_list->kdagama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_list->kdagama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_list->kdsex->Visible) { // kdsex ?>
	<?php if ($t_peserta_list->SortUrl($t_peserta_list->kdsex) == "") { ?>
		<th data-name="kdsex" class="<?php echo $t_peserta_list->kdsex->headerCellClass() ?>"><div id="elh_t_peserta_kdsex" class="t_peserta_kdsex"><div class="ew-table-header-caption"><?php echo $t_peserta_list->kdsex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdsex" class="<?php echo $t_peserta_list->kdsex->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_peserta_list->SortUrl($t_peserta_list->kdsex) ?>', 1);"><div id="elh_t_peserta_kdsex" class="t_peserta_kdsex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_list->kdsex->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_list->kdsex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_list->kdsex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_list->kdprop->Visible) { // kdprop ?>
	<?php if ($t_peserta_list->SortUrl($t_peserta_list->kdprop) == "") { ?>
		<th data-name="kdprop" class="<?php echo $t_peserta_list->kdprop->headerCellClass() ?>"><div id="elh_t_peserta_kdprop" class="t_peserta_kdprop"><div class="ew-table-header-caption"><?php echo $t_peserta_list->kdprop->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdprop" class="<?php echo $t_peserta_list->kdprop->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_peserta_list->SortUrl($t_peserta_list->kdprop) ?>', 1);"><div id="elh_t_peserta_kdprop" class="t_peserta_kdprop">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_list->kdprop->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_list->kdprop->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_list->kdprop->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_list->kdkota->Visible) { // kdkota ?>
	<?php if ($t_peserta_list->SortUrl($t_peserta_list->kdkota) == "") { ?>
		<th data-name="kdkota" class="<?php echo $t_peserta_list->kdkota->headerCellClass() ?>"><div id="elh_t_peserta_kdkota" class="t_peserta_kdkota"><div class="ew-table-header-caption"><?php echo $t_peserta_list->kdkota->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkota" class="<?php echo $t_peserta_list->kdkota->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_peserta_list->SortUrl($t_peserta_list->kdkota) ?>', 1);"><div id="elh_t_peserta_kdkota" class="t_peserta_kdkota">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_list->kdkota->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_list->kdkota->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_list->kdkota->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_list->kdkec->Visible) { // kdkec ?>
	<?php if ($t_peserta_list->SortUrl($t_peserta_list->kdkec) == "") { ?>
		<th data-name="kdkec" class="<?php echo $t_peserta_list->kdkec->headerCellClass() ?>"><div id="elh_t_peserta_kdkec" class="t_peserta_kdkec"><div class="ew-table-header-caption"><?php echo $t_peserta_list->kdkec->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkec" class="<?php echo $t_peserta_list->kdkec->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_peserta_list->SortUrl($t_peserta_list->kdkec) ?>', 1);"><div id="elh_t_peserta_kdkec" class="t_peserta_kdkec">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_list->kdkec->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_list->kdkec->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_list->kdkec->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_list->alamat->Visible) { // alamat ?>
	<?php if ($t_peserta_list->SortUrl($t_peserta_list->alamat) == "") { ?>
		<th data-name="alamat" class="<?php echo $t_peserta_list->alamat->headerCellClass() ?>"><div id="elh_t_peserta_alamat" class="t_peserta_alamat"><div class="ew-table-header-caption"><?php echo $t_peserta_list->alamat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="alamat" class="<?php echo $t_peserta_list->alamat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_peserta_list->SortUrl($t_peserta_list->alamat) ?>', 1);"><div id="elh_t_peserta_alamat" class="t_peserta_alamat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_list->alamat->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_list->alamat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_list->alamat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_list->telp->Visible) { // telp ?>
	<?php if ($t_peserta_list->SortUrl($t_peserta_list->telp) == "") { ?>
		<th data-name="telp" class="<?php echo $t_peserta_list->telp->headerCellClass() ?>"><div id="elh_t_peserta_telp" class="t_peserta_telp"><div class="ew-table-header-caption"><?php echo $t_peserta_list->telp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telp" class="<?php echo $t_peserta_list->telp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_peserta_list->SortUrl($t_peserta_list->telp) ?>', 1);"><div id="elh_t_peserta_telp" class="t_peserta_telp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_list->telp->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_list->telp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_list->telp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_list->hp->Visible) { // hp ?>
	<?php if ($t_peserta_list->SortUrl($t_peserta_list->hp) == "") { ?>
		<th data-name="hp" class="<?php echo $t_peserta_list->hp->headerCellClass() ?>"><div id="elh_t_peserta_hp" class="t_peserta_hp"><div class="ew-table-header-caption"><?php echo $t_peserta_list->hp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hp" class="<?php echo $t_peserta_list->hp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_peserta_list->SortUrl($t_peserta_list->hp) ?>', 1);"><div id="elh_t_peserta_hp" class="t_peserta_hp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_list->hp->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_list->hp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_list->hp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_list->kdjabat->Visible) { // kdjabat ?>
	<?php if ($t_peserta_list->SortUrl($t_peserta_list->kdjabat) == "") { ?>
		<th data-name="kdjabat" class="<?php echo $t_peserta_list->kdjabat->headerCellClass() ?>"><div id="elh_t_peserta_kdjabat" class="t_peserta_kdjabat"><div class="ew-table-header-caption"><?php echo $t_peserta_list->kdjabat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjabat" class="<?php echo $t_peserta_list->kdjabat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_peserta_list->SortUrl($t_peserta_list->kdjabat) ?>', 1);"><div id="elh_t_peserta_kdjabat" class="t_peserta_kdjabat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_list->kdjabat->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_list->kdjabat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_list->kdjabat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_list->kdpend->Visible) { // kdpend ?>
	<?php if ($t_peserta_list->SortUrl($t_peserta_list->kdpend) == "") { ?>
		<th data-name="kdpend" class="<?php echo $t_peserta_list->kdpend->headerCellClass() ?>"><div id="elh_t_peserta_kdpend" class="t_peserta_kdpend"><div class="ew-table-header-caption"><?php echo $t_peserta_list->kdpend->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdpend" class="<?php echo $t_peserta_list->kdpend->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_peserta_list->SortUrl($t_peserta_list->kdpend) ?>', 1);"><div id="elh_t_peserta_kdpend" class="t_peserta_kdpend">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_list->kdpend->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_list->kdpend->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_list->kdpend->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_list->kdbahasa->Visible) { // kdbahasa ?>
	<?php if ($t_peserta_list->SortUrl($t_peserta_list->kdbahasa) == "") { ?>
		<th data-name="kdbahasa" class="<?php echo $t_peserta_list->kdbahasa->headerCellClass() ?>"><div id="elh_t_peserta_kdbahasa" class="t_peserta_kdbahasa"><div class="ew-table-header-caption"><?php echo $t_peserta_list->kdbahasa->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdbahasa" class="<?php echo $t_peserta_list->kdbahasa->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_peserta_list->SortUrl($t_peserta_list->kdbahasa) ?>', 1);"><div id="elh_t_peserta_kdbahasa" class="t_peserta_kdbahasa">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_list->kdbahasa->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_list->kdbahasa->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_list->kdbahasa->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_peserta_list->jpelatihan->Visible) { // jpelatihan ?>
	<?php if ($t_peserta_list->SortUrl($t_peserta_list->jpelatihan) == "") { ?>
		<th data-name="jpelatihan" class="<?php echo $t_peserta_list->jpelatihan->headerCellClass() ?>"><div id="elh_t_peserta_jpelatihan" class="t_peserta_jpelatihan"><div class="ew-table-header-caption"><?php echo $t_peserta_list->jpelatihan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jpelatihan" class="<?php echo $t_peserta_list->jpelatihan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_peserta_list->SortUrl($t_peserta_list->jpelatihan) ?>', 1);"><div id="elh_t_peserta_jpelatihan" class="t_peserta_jpelatihan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_peserta_list->jpelatihan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_peserta_list->jpelatihan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_peserta_list->jpelatihan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_peserta_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_peserta_list->ExportAll && $t_peserta_list->isExport()) {
	$t_peserta_list->StopRecord = $t_peserta_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_peserta_list->TotalRecords > $t_peserta_list->StartRecord + $t_peserta_list->DisplayRecords - 1)
		$t_peserta_list->StopRecord = $t_peserta_list->StartRecord + $t_peserta_list->DisplayRecords - 1;
	else
		$t_peserta_list->StopRecord = $t_peserta_list->TotalRecords;
}
$t_peserta_list->RecordCount = $t_peserta_list->StartRecord - 1;
if ($t_peserta_list->Recordset && !$t_peserta_list->Recordset->EOF) {
	$t_peserta_list->Recordset->moveFirst();
	$selectLimit = $t_peserta_list->UseSelectLimit;
	if (!$selectLimit && $t_peserta_list->StartRecord > 1)
		$t_peserta_list->Recordset->move($t_peserta_list->StartRecord - 1);
} elseif (!$t_peserta->AllowAddDeleteRow && $t_peserta_list->StopRecord == 0) {
	$t_peserta_list->StopRecord = $t_peserta->GridAddRowCount;
}

// Initialize aggregate
$t_peserta->RowType = ROWTYPE_AGGREGATEINIT;
$t_peserta->resetAttributes();
$t_peserta_list->renderRow();
while ($t_peserta_list->RecordCount < $t_peserta_list->StopRecord) {
	$t_peserta_list->RecordCount++;
	if ($t_peserta_list->RecordCount >= $t_peserta_list->StartRecord) {
		$t_peserta_list->RowCount++;

		// Set up key count
		$t_peserta_list->KeyCount = $t_peserta_list->RowIndex;

		// Init row class and style
		$t_peserta->resetAttributes();
		$t_peserta->CssClass = "";
		if ($t_peserta_list->isGridAdd()) {
		} else {
			$t_peserta_list->loadRowValues($t_peserta_list->Recordset); // Load row values
		}
		$t_peserta->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_peserta->RowAttrs->merge(["data-rowindex" => $t_peserta_list->RowCount, "id" => "r" . $t_peserta_list->RowCount . "_t_peserta", "data-rowtype" => $t_peserta->RowType]);

		// Render row
		$t_peserta_list->renderRow();

		// Render list options
		$t_peserta_list->renderListOptions();
?>
	<tr <?php echo $t_peserta->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_peserta_list->ListOptions->render("body", "left", $t_peserta_list->RowCount);
?>
	<?php if ($t_peserta_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $t_peserta_list->id->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_list->RowCount ?>_t_peserta_id">
<span<?php echo $t_peserta_list->id->viewAttributes() ?>><?php echo $t_peserta_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_peserta_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $t_peserta_list->nama->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_list->RowCount ?>_t_peserta_nama">
<span<?php echo $t_peserta_list->nama->viewAttributes() ?>><?php echo $t_peserta_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_peserta_list->idp->Visible) { // idp ?>
		<td data-name="idp" <?php echo $t_peserta_list->idp->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_list->RowCount ?>_t_peserta_idp">
<span<?php echo $t_peserta_list->idp->viewAttributes() ?>><?php echo $t_peserta_list->idp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_peserta_list->tempat->Visible) { // tempat ?>
		<td data-name="tempat" <?php echo $t_peserta_list->tempat->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_list->RowCount ?>_t_peserta_tempat">
<span<?php echo $t_peserta_list->tempat->viewAttributes() ?>><?php echo $t_peserta_list->tempat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_peserta_list->kdagama->Visible) { // kdagama ?>
		<td data-name="kdagama" <?php echo $t_peserta_list->kdagama->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_list->RowCount ?>_t_peserta_kdagama">
<span<?php echo $t_peserta_list->kdagama->viewAttributes() ?>><?php echo $t_peserta_list->kdagama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_peserta_list->kdsex->Visible) { // kdsex ?>
		<td data-name="kdsex" <?php echo $t_peserta_list->kdsex->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_list->RowCount ?>_t_peserta_kdsex">
<span<?php echo $t_peserta_list->kdsex->viewAttributes() ?>><?php echo $t_peserta_list->kdsex->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_peserta_list->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" <?php echo $t_peserta_list->kdprop->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_list->RowCount ?>_t_peserta_kdprop">
<span<?php echo $t_peserta_list->kdprop->viewAttributes() ?>><?php echo $t_peserta_list->kdprop->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_peserta_list->kdkota->Visible) { // kdkota ?>
		<td data-name="kdkota" <?php echo $t_peserta_list->kdkota->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_list->RowCount ?>_t_peserta_kdkota">
<span<?php echo $t_peserta_list->kdkota->viewAttributes() ?>><?php echo $t_peserta_list->kdkota->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_peserta_list->kdkec->Visible) { // kdkec ?>
		<td data-name="kdkec" <?php echo $t_peserta_list->kdkec->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_list->RowCount ?>_t_peserta_kdkec">
<span<?php echo $t_peserta_list->kdkec->viewAttributes() ?>><?php echo $t_peserta_list->kdkec->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_peserta_list->alamat->Visible) { // alamat ?>
		<td data-name="alamat" <?php echo $t_peserta_list->alamat->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_list->RowCount ?>_t_peserta_alamat">
<span<?php echo $t_peserta_list->alamat->viewAttributes() ?>><?php echo $t_peserta_list->alamat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_peserta_list->telp->Visible) { // telp ?>
		<td data-name="telp" <?php echo $t_peserta_list->telp->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_list->RowCount ?>_t_peserta_telp">
<span<?php echo $t_peserta_list->telp->viewAttributes() ?>><?php echo $t_peserta_list->telp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_peserta_list->hp->Visible) { // hp ?>
		<td data-name="hp" <?php echo $t_peserta_list->hp->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_list->RowCount ?>_t_peserta_hp">
<span<?php echo $t_peserta_list->hp->viewAttributes() ?>><?php echo $t_peserta_list->hp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_peserta_list->kdjabat->Visible) { // kdjabat ?>
		<td data-name="kdjabat" <?php echo $t_peserta_list->kdjabat->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_list->RowCount ?>_t_peserta_kdjabat">
<span<?php echo $t_peserta_list->kdjabat->viewAttributes() ?>><?php echo $t_peserta_list->kdjabat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_peserta_list->kdpend->Visible) { // kdpend ?>
		<td data-name="kdpend" <?php echo $t_peserta_list->kdpend->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_list->RowCount ?>_t_peserta_kdpend">
<span<?php echo $t_peserta_list->kdpend->viewAttributes() ?>><?php echo $t_peserta_list->kdpend->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_peserta_list->kdbahasa->Visible) { // kdbahasa ?>
		<td data-name="kdbahasa" <?php echo $t_peserta_list->kdbahasa->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_list->RowCount ?>_t_peserta_kdbahasa">
<span<?php echo $t_peserta_list->kdbahasa->viewAttributes() ?>><?php echo $t_peserta_list->kdbahasa->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_peserta_list->jpelatihan->Visible) { // jpelatihan ?>
		<td data-name="jpelatihan" <?php echo $t_peserta_list->jpelatihan->cellAttributes() ?>>
<span id="el<?php echo $t_peserta_list->RowCount ?>_t_peserta_jpelatihan">
<span<?php echo $t_peserta_list->jpelatihan->viewAttributes() ?>><?php echo $t_peserta_list->jpelatihan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_peserta_list->ListOptions->render("body", "right", $t_peserta_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_peserta_list->isGridAdd())
		$t_peserta_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_peserta->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_peserta_list->Recordset)
	$t_peserta_list->Recordset->Close();
?>
<?php if (!$t_peserta_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_peserta_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_peserta_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_peserta_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_peserta_list->TotalRecords == 0 && !$t_peserta->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_peserta_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_peserta_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_peserta_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// document.write("page loaded");

	/*
	<?php if (isset($_GET[TABLE_SHOW_MASTER]) <> "") { ?>
		$('#ft_pesertalistsrch_SearchPanel').hide();
		$('.ewSearchOption').hide();
		$('.ewFilterOption').hide();
	<?php } ?>
	<?php if (isset($_GET[TABLE_SHOW_MASTER]) == "t_perusahaan") { ?>
		$('#r_namap').hide();
	<?php } ?>
	*/
});
</script>
<?php if (!$t_peserta->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_t_peserta",
		width: "100%",
		height: "350px"
	});
});
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$t_peserta_list->terminate();
?>