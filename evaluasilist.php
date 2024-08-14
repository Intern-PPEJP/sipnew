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
$evaluasi_list = new evaluasi_list();

// Run the page
$evaluasi_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$evaluasi_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$evaluasi_list->isExport()) { ?>
<script>
var fevaluasilist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fevaluasilist = currentForm = new ew.Form("fevaluasilist", "list");
	fevaluasilist.formKeyCountName = '<?php echo $evaluasi_list->FormKeyCountName ?>';
	loadjs.done("fevaluasilist");
});
var fevaluasilistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fevaluasilistsrch = currentSearchForm = new ew.Form("fevaluasilistsrch");

	// Validate function for search
	fevaluasilistsrch.validate = function(fobj) {
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
	fevaluasilistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fevaluasilistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fevaluasilistsrch.lists["x_th"] = <?php echo $evaluasi_list->th->Lookup->toClientList($evaluasi_list) ?>;
	fevaluasilistsrch.lists["x_th"].options = <?php echo JsonEncode($evaluasi_list->th->lookupOptions()) ?>;
	fevaluasilistsrch.lists["x_idpelat"] = <?php echo $evaluasi_list->idpelat->Lookup->toClientList($evaluasi_list) ?>;
	fevaluasilistsrch.lists["x_idpelat"].options = <?php echo JsonEncode($evaluasi_list->idpelat->lookupOptions()) ?>;

	// Filters
	fevaluasilistsrch.filterList = <?php echo $evaluasi_list->getFilterList() ?>;
	loadjs.done("fevaluasilistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$evaluasi_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($evaluasi_list->TotalRecords > 0 && $evaluasi_list->ExportOptions->visible()) { ?>
<?php $evaluasi_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($evaluasi_list->ImportOptions->visible()) { ?>
<?php $evaluasi_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($evaluasi_list->SearchOptions->visible()) { ?>
<?php $evaluasi_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($evaluasi_list->FilterOptions->visible()) { ?>
<?php $evaluasi_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$evaluasi_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$evaluasi_list->isExport() && !$evaluasi->CurrentAction) { ?>
<form name="fevaluasilistsrch" id="fevaluasilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fevaluasilistsrch-search-panel" class="<?php echo $evaluasi_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="evaluasi">
	<div class="ew-extended-search">
<?php

// Render search row
$evaluasi->RowType = ROWTYPE_SEARCH;
$evaluasi->resetAttributes();
$evaluasi_list->renderRow();
?>
<?php if ($evaluasi_list->th->Visible) { // th ?>
	<?php
		$evaluasi_list->SearchColumnCount++;
		if (($evaluasi_list->SearchColumnCount - 1) % $evaluasi_list->SearchFieldsPerRow == 0) {
			$evaluasi_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $evaluasi_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_th" class="ew-cell form-group">
		<label for="x_th" class="ew-search-caption ew-label"><?php echo $evaluasi_list->th->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_th" id="z_th" value="=">
</span>
		<span id="el_evaluasi_th" class="ew-search-field">
<?php $evaluasi_list->th->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="evaluasi" data-field="x_th" data-value-separator="<?php echo $evaluasi_list->th->displayValueSeparatorAttribute() ?>" id="x_th" name="x_th"<?php echo $evaluasi_list->th->editAttributes() ?>>
			<?php echo $evaluasi_list->th->selectOptionListHtml("x_th") ?>
		</select>
</div>
<?php echo $evaluasi_list->th->Lookup->getParamTag($evaluasi_list, "p_x_th") ?>
</span>
	</div>
	<?php if ($evaluasi_list->SearchColumnCount % $evaluasi_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($evaluasi_list->idpelat->Visible) { // idpelat ?>
	<?php
		$evaluasi_list->SearchColumnCount++;
		if (($evaluasi_list->SearchColumnCount - 1) % $evaluasi_list->SearchFieldsPerRow == 0) {
			$evaluasi_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $evaluasi_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_idpelat" class="ew-cell form-group">
		<label for="x_idpelat" class="ew-search-caption ew-label"><?php echo $evaluasi_list->idpelat->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_idpelat" id="z_idpelat" value="=">
</span>
		<span id="el_evaluasi_idpelat" class="ew-search-field">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($evaluasi_list->idpelat->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $evaluasi_list->idpelat->AdvancedSearch->ViewValue ?></button>
		<div id="dsl_x_idpelat" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden; min-width: 650px; max-height: 333px; overflow-y: auto;">
<?php echo $evaluasi_list->idpelat->radioButtonListHtml(TRUE, "x_idpelat") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_idpelat" class="ew-template"><input type="radio" class="custom-control-input" data-table="evaluasi" data-field="x_idpelat" data-value-separator="<?php echo $evaluasi_list->idpelat->displayValueSeparatorAttribute() ?>" name="x_idpelat" id="x_idpelat" value="{value}"<?php echo $evaluasi_list->idpelat->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$evaluasi_list->idpelat->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $evaluasi_list->idpelat->Lookup->getParamTag($evaluasi_list, "p_x_idpelat") ?>
</span>
	</div>
	<?php if ($evaluasi_list->SearchColumnCount % $evaluasi_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($evaluasi_list->SearchColumnCount % $evaluasi_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $evaluasi_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $evaluasi_list->showPageHeader(); ?>
<?php
$evaluasi_list->showMessage();
?>
<?php if ($evaluasi_list->TotalRecords > 0 || $evaluasi->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($evaluasi_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> evaluasi">
<?php if (!$evaluasi_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$evaluasi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $evaluasi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $evaluasi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fevaluasilist" id="fevaluasilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="evaluasi">
<div id="gmp_evaluasi" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($evaluasi_list->TotalRecords > 0 || $evaluasi_list->isGridEdit()) { ?>
<table id="tbl_evaluasilist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$evaluasi->RowType = ROWTYPE_HEADER;

// Render list options
$evaluasi_list->renderListOptions();

// Render list options (header, left)
$evaluasi_list->ListOptions->render("header", "left");
?>
<?php if ($evaluasi_list->th->Visible) { // th ?>
	<?php if ($evaluasi_list->SortUrl($evaluasi_list->th) == "") { ?>
		<th data-name="th" class="<?php echo $evaluasi_list->th->headerCellClass() ?>"><div id="elh_evaluasi_th" class="evaluasi_th"><div class="ew-table-header-caption"><?php echo $evaluasi_list->th->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="th" class="<?php echo $evaluasi_list->th->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $evaluasi_list->SortUrl($evaluasi_list->th) ?>', 1);"><div id="elh_evaluasi_th" class="evaluasi_th">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $evaluasi_list->th->caption() ?></span><span class="ew-table-header-sort"><?php if ($evaluasi_list->th->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($evaluasi_list->th->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($evaluasi_list->idpelat->Visible) { // idpelat ?>
	<?php if ($evaluasi_list->SortUrl($evaluasi_list->idpelat) == "") { ?>
		<th data-name="idpelat" class="<?php echo $evaluasi_list->idpelat->headerCellClass() ?>"><div id="elh_evaluasi_idpelat" class="evaluasi_idpelat"><div class="ew-table-header-caption"><?php echo $evaluasi_list->idpelat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idpelat" class="<?php echo $evaluasi_list->idpelat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $evaluasi_list->SortUrl($evaluasi_list->idpelat) ?>', 1);"><div id="elh_evaluasi_idpelat" class="evaluasi_idpelat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $evaluasi_list->idpelat->caption() ?></span><span class="ew-table-header-sort"><?php if ($evaluasi_list->idpelat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($evaluasi_list->idpelat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($evaluasi_list->kdpelat->Visible) { // kdpelat ?>
	<?php if ($evaluasi_list->SortUrl($evaluasi_list->kdpelat) == "") { ?>
		<th data-name="kdpelat" class="<?php echo $evaluasi_list->kdpelat->headerCellClass() ?>"><div id="elh_evaluasi_kdpelat" class="evaluasi_kdpelat"><div class="ew-table-header-caption"><?php echo $evaluasi_list->kdpelat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdpelat" class="<?php echo $evaluasi_list->kdpelat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $evaluasi_list->SortUrl($evaluasi_list->kdpelat) ?>', 1);"><div id="elh_evaluasi_kdpelat" class="evaluasi_kdpelat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $evaluasi_list->kdpelat->caption() ?></span><span class="ew-table-header-sort"><?php if ($evaluasi_list->kdpelat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($evaluasi_list->kdpelat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($evaluasi_list->kdjudul->Visible) { // kdjudul ?>
	<?php if ($evaluasi_list->SortUrl($evaluasi_list->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $evaluasi_list->kdjudul->headerCellClass() ?>"><div id="elh_evaluasi_kdjudul" class="evaluasi_kdjudul"><div class="ew-table-header-caption"><?php echo $evaluasi_list->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $evaluasi_list->kdjudul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $evaluasi_list->SortUrl($evaluasi_list->kdjudul) ?>', 1);"><div id="elh_evaluasi_kdjudul" class="evaluasi_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $evaluasi_list->kdjudul->caption() ?></span><span class="ew-table-header-sort"><?php if ($evaluasi_list->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($evaluasi_list->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($evaluasi_list->tawal->Visible) { // tawal ?>
	<?php if ($evaluasi_list->SortUrl($evaluasi_list->tawal) == "") { ?>
		<th data-name="tawal" class="<?php echo $evaluasi_list->tawal->headerCellClass() ?>"><div id="elh_evaluasi_tawal" class="evaluasi_tawal"><div class="ew-table-header-caption"><?php echo $evaluasi_list->tawal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tawal" class="<?php echo $evaluasi_list->tawal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $evaluasi_list->SortUrl($evaluasi_list->tawal) ?>', 1);"><div id="elh_evaluasi_tawal" class="evaluasi_tawal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $evaluasi_list->tawal->caption() ?></span><span class="ew-table-header-sort"><?php if ($evaluasi_list->tawal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($evaluasi_list->tawal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($evaluasi_list->takhir->Visible) { // takhir ?>
	<?php if ($evaluasi_list->SortUrl($evaluasi_list->takhir) == "") { ?>
		<th data-name="takhir" class="<?php echo $evaluasi_list->takhir->headerCellClass() ?>"><div id="elh_evaluasi_takhir" class="evaluasi_takhir"><div class="ew-table-header-caption"><?php echo $evaluasi_list->takhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="takhir" class="<?php echo $evaluasi_list->takhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $evaluasi_list->SortUrl($evaluasi_list->takhir) ?>', 1);"><div id="elh_evaluasi_takhir" class="evaluasi_takhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $evaluasi_list->takhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($evaluasi_list->takhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($evaluasi_list->takhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($evaluasi_list->tglpel->Visible) { // tglpel ?>
	<?php if ($evaluasi_list->SortUrl($evaluasi_list->tglpel) == "") { ?>
		<th data-name="tglpel" class="<?php echo $evaluasi_list->tglpel->headerCellClass() ?>"><div id="elh_evaluasi_tglpel" class="evaluasi_tglpel"><div class="ew-table-header-caption"><?php echo $evaluasi_list->tglpel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tglpel" class="<?php echo $evaluasi_list->tglpel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $evaluasi_list->SortUrl($evaluasi_list->tglpel) ?>', 1);"><div id="elh_evaluasi_tglpel" class="evaluasi_tglpel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $evaluasi_list->tglpel->caption() ?></span><span class="ew-table-header-sort"><?php if ($evaluasi_list->tglpel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($evaluasi_list->tglpel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($evaluasi_list->panitia->Visible) { // panitia ?>
	<?php if ($evaluasi_list->SortUrl($evaluasi_list->panitia) == "") { ?>
		<th data-name="panitia" class="<?php echo $evaluasi_list->panitia->headerCellClass() ?>"><div id="elh_evaluasi_panitia" class="evaluasi_panitia"><div class="ew-table-header-caption"><?php echo $evaluasi_list->panitia->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="panitia" class="<?php echo $evaluasi_list->panitia->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $evaluasi_list->SortUrl($evaluasi_list->panitia) ?>', 1);"><div id="elh_evaluasi_panitia" class="evaluasi_panitia">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $evaluasi_list->panitia->caption() ?></span><span class="ew-table-header-sort"><?php if ($evaluasi_list->panitia->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($evaluasi_list->panitia->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($evaluasi_list->jenisevaluasi->Visible) { // jenisevaluasi ?>
	<?php if ($evaluasi_list->SortUrl($evaluasi_list->jenisevaluasi) == "") { ?>
		<th data-name="jenisevaluasi" class="<?php echo $evaluasi_list->jenisevaluasi->headerCellClass() ?>"><div id="elh_evaluasi_jenisevaluasi" class="evaluasi_jenisevaluasi"><div class="ew-table-header-caption"><?php echo $evaluasi_list->jenisevaluasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenisevaluasi" class="<?php echo $evaluasi_list->jenisevaluasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $evaluasi_list->SortUrl($evaluasi_list->jenisevaluasi) ?>', 1);"><div id="elh_evaluasi_jenisevaluasi" class="evaluasi_jenisevaluasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $evaluasi_list->jenisevaluasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($evaluasi_list->jenisevaluasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($evaluasi_list->jenisevaluasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$evaluasi_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($evaluasi_list->ExportAll && $evaluasi_list->isExport()) {
	$evaluasi_list->StopRecord = $evaluasi_list->TotalRecords;
} else {

	// Set the last record to display
	if ($evaluasi_list->TotalRecords > $evaluasi_list->StartRecord + $evaluasi_list->DisplayRecords - 1)
		$evaluasi_list->StopRecord = $evaluasi_list->StartRecord + $evaluasi_list->DisplayRecords - 1;
	else
		$evaluasi_list->StopRecord = $evaluasi_list->TotalRecords;
}
$evaluasi_list->RecordCount = $evaluasi_list->StartRecord - 1;
if ($evaluasi_list->Recordset && !$evaluasi_list->Recordset->EOF) {
	$evaluasi_list->Recordset->moveFirst();
	$selectLimit = $evaluasi_list->UseSelectLimit;
	if (!$selectLimit && $evaluasi_list->StartRecord > 1)
		$evaluasi_list->Recordset->move($evaluasi_list->StartRecord - 1);
} elseif (!$evaluasi->AllowAddDeleteRow && $evaluasi_list->StopRecord == 0) {
	$evaluasi_list->StopRecord = $evaluasi->GridAddRowCount;
}

// Initialize aggregate
$evaluasi->RowType = ROWTYPE_AGGREGATEINIT;
$evaluasi->resetAttributes();
$evaluasi_list->renderRow();
while ($evaluasi_list->RecordCount < $evaluasi_list->StopRecord) {
	$evaluasi_list->RecordCount++;
	if ($evaluasi_list->RecordCount >= $evaluasi_list->StartRecord) {
		$evaluasi_list->RowCount++;

		// Set up key count
		$evaluasi_list->KeyCount = $evaluasi_list->RowIndex;

		// Init row class and style
		$evaluasi->resetAttributes();
		$evaluasi->CssClass = "";
		if ($evaluasi_list->isGridAdd()) {
		} else {
			$evaluasi_list->loadRowValues($evaluasi_list->Recordset); // Load row values
		}
		$evaluasi->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$evaluasi->RowAttrs->merge(["data-rowindex" => $evaluasi_list->RowCount, "id" => "r" . $evaluasi_list->RowCount . "_evaluasi", "data-rowtype" => $evaluasi->RowType]);

		// Render row
		$evaluasi_list->renderRow();

		// Render list options
		$evaluasi_list->renderListOptions();
?>
	<tr <?php echo $evaluasi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$evaluasi_list->ListOptions->render("body", "left", $evaluasi_list->RowCount);
?>
	<?php if ($evaluasi_list->th->Visible) { // th ?>
		<td data-name="th" <?php echo $evaluasi_list->th->cellAttributes() ?>>
<span id="el<?php echo $evaluasi_list->RowCount ?>_evaluasi_th">
<span<?php echo $evaluasi_list->th->viewAttributes() ?>><?php echo $evaluasi_list->th->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($evaluasi_list->idpelat->Visible) { // idpelat ?>
		<td data-name="idpelat" <?php echo $evaluasi_list->idpelat->cellAttributes() ?>>
<span id="el<?php echo $evaluasi_list->RowCount ?>_evaluasi_idpelat">
<span<?php echo $evaluasi_list->idpelat->viewAttributes() ?>><?php echo $evaluasi_list->idpelat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($evaluasi_list->kdpelat->Visible) { // kdpelat ?>
		<td data-name="kdpelat" <?php echo $evaluasi_list->kdpelat->cellAttributes() ?>>
<span id="el<?php echo $evaluasi_list->RowCount ?>_evaluasi_kdpelat">
<span<?php echo $evaluasi_list->kdpelat->viewAttributes() ?>><?php echo $evaluasi_list->kdpelat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($evaluasi_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $evaluasi_list->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $evaluasi_list->RowCount ?>_evaluasi_kdjudul">
<span<?php echo $evaluasi_list->kdjudul->viewAttributes() ?>><?php echo $evaluasi_list->kdjudul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($evaluasi_list->tawal->Visible) { // tawal ?>
		<td data-name="tawal" <?php echo $evaluasi_list->tawal->cellAttributes() ?>>
<span id="el<?php echo $evaluasi_list->RowCount ?>_evaluasi_tawal">
<span<?php echo $evaluasi_list->tawal->viewAttributes() ?>><?php echo $evaluasi_list->tawal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($evaluasi_list->takhir->Visible) { // takhir ?>
		<td data-name="takhir" <?php echo $evaluasi_list->takhir->cellAttributes() ?>>
<span id="el<?php echo $evaluasi_list->RowCount ?>_evaluasi_takhir">
<span<?php echo $evaluasi_list->takhir->viewAttributes() ?>><?php echo $evaluasi_list->takhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($evaluasi_list->tglpel->Visible) { // tglpel ?>
		<td data-name="tglpel" <?php echo $evaluasi_list->tglpel->cellAttributes() ?>>
<span id="el<?php echo $evaluasi_list->RowCount ?>_evaluasi_tglpel">
<span<?php echo $evaluasi_list->tglpel->viewAttributes() ?>><?php echo $evaluasi_list->tglpel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($evaluasi_list->panitia->Visible) { // panitia ?>
		<td data-name="panitia" <?php echo $evaluasi_list->panitia->cellAttributes() ?>>
<span id="el<?php echo $evaluasi_list->RowCount ?>_evaluasi_panitia">
<span<?php echo $evaluasi_list->panitia->viewAttributes() ?>><?php echo $evaluasi_list->panitia->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($evaluasi_list->jenisevaluasi->Visible) { // jenisevaluasi ?>
		<td data-name="jenisevaluasi" <?php echo $evaluasi_list->jenisevaluasi->cellAttributes() ?>>
<span id="el<?php echo $evaluasi_list->RowCount ?>_evaluasi_jenisevaluasi">
<span<?php echo $evaluasi_list->jenisevaluasi->viewAttributes() ?>><?php echo $evaluasi_list->jenisevaluasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$evaluasi_list->ListOptions->render("body", "right", $evaluasi_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$evaluasi_list->isGridAdd())
		$evaluasi_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$evaluasi->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($evaluasi_list->Recordset)
	$evaluasi_list->Recordset->Close();
?>
<?php if (!$evaluasi_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$evaluasi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $evaluasi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $evaluasi_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($evaluasi_list->TotalRecords == 0 && !$evaluasi->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $evaluasi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$evaluasi_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$evaluasi_list->isExport()) { ?>
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
$evaluasi_list->terminate();
?>