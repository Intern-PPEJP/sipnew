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
$cv_jp_list = new cv_jp_list();

// Run the page
$cv_jp_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cv_jp_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cv_jp_list->isExport()) { ?>
<script>
var fcv_jplist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcv_jplist = currentForm = new ew.Form("fcv_jplist", "list");
	fcv_jplist.formKeyCountName = '<?php echo $cv_jp_list->FormKeyCountName ?>';
	loadjs.done("fcv_jplist");
});
var fcv_jplistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcv_jplistsrch = currentSearchForm = new ew.Form("fcv_jplistsrch");

	// Validate function for search
	fcv_jplistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_tahun");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($cv_jp_list->tahun->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fcv_jplistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcv_jplistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcv_jplistsrch.lists["x_kdjudul"] = <?php echo $cv_jp_list->kdjudul->Lookup->toClientList($cv_jp_list) ?>;
	fcv_jplistsrch.lists["x_kdjudul"].options = <?php echo JsonEncode($cv_jp_list->kdjudul->lookupOptions()) ?>;
	fcv_jplistsrch.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

	// Filters
	fcv_jplistsrch.filterList = <?php echo $cv_jp_list->getFilterList() ?>;
	loadjs.done("fcv_jplistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$cv_jp_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cv_jp_list->TotalRecords > 0 && $cv_jp_list->ExportOptions->visible()) { ?>
<?php $cv_jp_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cv_jp_list->ImportOptions->visible()) { ?>
<?php $cv_jp_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($cv_jp_list->SearchOptions->visible()) { ?>
<?php $cv_jp_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($cv_jp_list->FilterOptions->visible()) { ?>
<?php $cv_jp_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$cv_jp_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$cv_jp_list->isExport() && !$cv_jp->CurrentAction) { ?>
<form name="fcv_jplistsrch" id="fcv_jplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcv_jplistsrch-search-panel" class="<?php echo $cv_jp_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cv_jp">
	<div class="ew-extended-search">
<?php

// Render search row
$cv_jp->RowType = ROWTYPE_SEARCH;
$cv_jp->resetAttributes();
$cv_jp_list->renderRow();
?>
<?php if ($cv_jp_list->tahun->Visible) { // tahun ?>
	<?php
		$cv_jp_list->SearchColumnCount++;
		if (($cv_jp_list->SearchColumnCount - 1) % $cv_jp_list->SearchFieldsPerRow == 0) {
			$cv_jp_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $cv_jp_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_tahun" class="ew-cell form-group">
		<label for="x_tahun" class="ew-search-caption ew-label"><?php echo $cv_jp_list->tahun->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tahun" id="z_tahun" value="=">
</span>
		<span id="el_cv_jp_tahun" class="ew-search-field">
<input type="text" data-table="cv_jp" data-field="x_tahun" name="x_tahun" id="x_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($cv_jp_list->tahun->getPlaceHolder()) ?>" value="<?php echo $cv_jp_list->tahun->EditValue ?>"<?php echo $cv_jp_list->tahun->editAttributes() ?>>
</span>
	</div>
	<?php if ($cv_jp_list->SearchColumnCount % $cv_jp_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($cv_jp_list->kdjudul->Visible) { // kdjudul ?>
	<?php
		$cv_jp_list->SearchColumnCount++;
		if (($cv_jp_list->SearchColumnCount - 1) % $cv_jp_list->SearchFieldsPerRow == 0) {
			$cv_jp_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $cv_jp_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kdjudul" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $cv_jp_list->kdjudul->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_kdjudul" id="z_kdjudul" value="LIKE">
</span>
		<span id="el_cv_jp_kdjudul" class="ew-search-field">
<?php
$onchange = $cv_jp_list->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_jp_list->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($cv_jp_list->kdjudul->EditValue) ?>" size="60" maxlength="9" placeholder="<?php echo HtmlEncode($cv_jp_list->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_jp_list->kdjudul->getPlaceHolder()) ?>"<?php echo $cv_jp_list->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="cv_jp" data-field="x_kdjudul" data-value-separator="<?php echo $cv_jp_list->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($cv_jp_list->kdjudul->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_jplistsrch"], function() {
	fcv_jplistsrch.createAutoSuggest({"id":"x_kdjudul","forceSelect":false});
});
</script>
<?php echo $cv_jp_list->kdjudul->Lookup->getParamTag($cv_jp_list, "p_x_kdjudul") ?>
</span>
	</div>
	<?php if ($cv_jp_list->SearchColumnCount % $cv_jp_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($cv_jp_list->SearchColumnCount % $cv_jp_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $cv_jp_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $cv_jp_list->showPageHeader(); ?>
<?php
$cv_jp_list->showMessage();
?>
<?php if ($cv_jp_list->TotalRecords > 0 || $cv_jp->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cv_jp_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cv_jp">
<?php if (!$cv_jp_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$cv_jp_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cv_jp_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cv_jp_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcv_jplist" id="fcv_jplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cv_jp">
<div id="gmp_cv_jp" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($cv_jp_list->TotalRecords > 0 || $cv_jp_list->isGridEdit()) { ?>
<table id="tbl_cv_jplist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cv_jp->RowType = ROWTYPE_HEADER;

// Render list options
$cv_jp_list->renderListOptions();

// Render list options (header, left)
$cv_jp_list->ListOptions->render("header", "left");
?>
<?php if ($cv_jp_list->idpelat->Visible) { // idpelat ?>
	<?php if ($cv_jp_list->SortUrl($cv_jp_list->idpelat) == "") { ?>
		<th data-name="idpelat" class="<?php echo $cv_jp_list->idpelat->headerCellClass() ?>"><div id="elh_cv_jp_idpelat" class="cv_jp_idpelat"><div class="ew-table-header-caption"><?php echo $cv_jp_list->idpelat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idpelat" class="<?php echo $cv_jp_list->idpelat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_jp_list->SortUrl($cv_jp_list->idpelat) ?>', 1);"><div id="elh_cv_jp_idpelat" class="cv_jp_idpelat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_jp_list->idpelat->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_jp_list->idpelat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_jp_list->idpelat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_jp_list->kurikulumid->Visible) { // kurikulumid ?>
	<?php if ($cv_jp_list->SortUrl($cv_jp_list->kurikulumid) == "") { ?>
		<th data-name="kurikulumid" class="<?php echo $cv_jp_list->kurikulumid->headerCellClass() ?>"><div id="elh_cv_jp_kurikulumid" class="cv_jp_kurikulumid"><div class="ew-table-header-caption"><?php echo $cv_jp_list->kurikulumid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kurikulumid" class="<?php echo $cv_jp_list->kurikulumid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_jp_list->SortUrl($cv_jp_list->kurikulumid) ?>', 1);"><div id="elh_cv_jp_kurikulumid" class="cv_jp_kurikulumid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_jp_list->kurikulumid->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_jp_list->kurikulumid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_jp_list->kurikulumid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_jp_list->tahun->Visible) { // tahun ?>
	<?php if ($cv_jp_list->SortUrl($cv_jp_list->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $cv_jp_list->tahun->headerCellClass() ?>"><div id="elh_cv_jp_tahun" class="cv_jp_tahun"><div class="ew-table-header-caption"><?php echo $cv_jp_list->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $cv_jp_list->tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_jp_list->SortUrl($cv_jp_list->tahun) ?>', 1);"><div id="elh_cv_jp_tahun" class="cv_jp_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_jp_list->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_jp_list->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_jp_list->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_jp_list->kdjudul->Visible) { // kdjudul ?>
	<?php if ($cv_jp_list->SortUrl($cv_jp_list->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $cv_jp_list->kdjudul->headerCellClass() ?>"><div id="elh_cv_jp_kdjudul" class="cv_jp_kdjudul"><div class="ew-table-header-caption"><?php echo $cv_jp_list->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $cv_jp_list->kdjudul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_jp_list->SortUrl($cv_jp_list->kdjudul) ?>', 1);"><div id="elh_cv_jp_kdjudul" class="cv_jp_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_jp_list->kdjudul->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_jp_list->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_jp_list->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_jp_list->tgl->Visible) { // tgl ?>
	<?php if ($cv_jp_list->SortUrl($cv_jp_list->tgl) == "") { ?>
		<th data-name="tgl" class="<?php echo $cv_jp_list->tgl->headerCellClass() ?>"><div id="elh_cv_jp_tgl" class="cv_jp_tgl"><div class="ew-table-header-caption"><?php echo $cv_jp_list->tgl->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl" class="<?php echo $cv_jp_list->tgl->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_jp_list->SortUrl($cv_jp_list->tgl) ?>', 1);"><div id="elh_cv_jp_tgl" class="cv_jp_tgl">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_jp_list->tgl->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_jp_list->tgl->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_jp_list->tgl->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_jp_list->bioid->Visible) { // bioid ?>
	<?php if ($cv_jp_list->SortUrl($cv_jp_list->bioid) == "") { ?>
		<th data-name="bioid" class="<?php echo $cv_jp_list->bioid->headerCellClass() ?>"><div id="elh_cv_jp_bioid" class="cv_jp_bioid"><div class="ew-table-header-caption"><?php echo $cv_jp_list->bioid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bioid" class="<?php echo $cv_jp_list->bioid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_jp_list->SortUrl($cv_jp_list->bioid) ?>', 1);"><div id="elh_cv_jp_bioid" class="cv_jp_bioid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_jp_list->bioid->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_jp_list->bioid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_jp_list->bioid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_jp_list->nilai->Visible) { // nilai ?>
	<?php if ($cv_jp_list->SortUrl($cv_jp_list->nilai) == "") { ?>
		<th data-name="nilai" class="<?php echo $cv_jp_list->nilai->headerCellClass() ?>"><div id="elh_cv_jp_nilai" class="cv_jp_nilai"><div class="ew-table-header-caption"><?php echo $cv_jp_list->nilai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nilai" class="<?php echo $cv_jp_list->nilai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_jp_list->SortUrl($cv_jp_list->nilai) ?>', 1);"><div id="elh_cv_jp_nilai" class="cv_jp_nilai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_jp_list->nilai->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_jp_list->nilai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_jp_list->nilai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_jp_list->komentar->Visible) { // komentar ?>
	<?php if ($cv_jp_list->SortUrl($cv_jp_list->komentar) == "") { ?>
		<th data-name="komentar" class="<?php echo $cv_jp_list->komentar->headerCellClass() ?>"><div id="elh_cv_jp_komentar" class="cv_jp_komentar"><div class="ew-table-header-caption"><?php echo $cv_jp_list->komentar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="komentar" class="<?php echo $cv_jp_list->komentar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_jp_list->SortUrl($cv_jp_list->komentar) ?>', 1);"><div id="elh_cv_jp_komentar" class="cv_jp_komentar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_jp_list->komentar->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_jp_list->komentar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_jp_list->komentar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cv_jp_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cv_jp_list->ExportAll && $cv_jp_list->isExport()) {
	$cv_jp_list->StopRecord = $cv_jp_list->TotalRecords;
} else {

	// Set the last record to display
	if ($cv_jp_list->TotalRecords > $cv_jp_list->StartRecord + $cv_jp_list->DisplayRecords - 1)
		$cv_jp_list->StopRecord = $cv_jp_list->StartRecord + $cv_jp_list->DisplayRecords - 1;
	else
		$cv_jp_list->StopRecord = $cv_jp_list->TotalRecords;
}
$cv_jp_list->RecordCount = $cv_jp_list->StartRecord - 1;
if ($cv_jp_list->Recordset && !$cv_jp_list->Recordset->EOF) {
	$cv_jp_list->Recordset->moveFirst();
	$selectLimit = $cv_jp_list->UseSelectLimit;
	if (!$selectLimit && $cv_jp_list->StartRecord > 1)
		$cv_jp_list->Recordset->move($cv_jp_list->StartRecord - 1);
} elseif (!$cv_jp->AllowAddDeleteRow && $cv_jp_list->StopRecord == 0) {
	$cv_jp_list->StopRecord = $cv_jp->GridAddRowCount;
}

// Initialize aggregate
$cv_jp->RowType = ROWTYPE_AGGREGATEINIT;
$cv_jp->resetAttributes();
$cv_jp_list->renderRow();
while ($cv_jp_list->RecordCount < $cv_jp_list->StopRecord) {
	$cv_jp_list->RecordCount++;
	if ($cv_jp_list->RecordCount >= $cv_jp_list->StartRecord) {
		$cv_jp_list->RowCount++;

		// Set up key count
		$cv_jp_list->KeyCount = $cv_jp_list->RowIndex;

		// Init row class and style
		$cv_jp->resetAttributes();
		$cv_jp->CssClass = "";
		if ($cv_jp_list->isGridAdd()) {
		} else {
			$cv_jp_list->loadRowValues($cv_jp_list->Recordset); // Load row values
		}
		$cv_jp->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cv_jp->RowAttrs->merge(["data-rowindex" => $cv_jp_list->RowCount, "id" => "r" . $cv_jp_list->RowCount . "_cv_jp", "data-rowtype" => $cv_jp->RowType]);

		// Render row
		$cv_jp_list->renderRow();

		// Render list options
		$cv_jp_list->renderListOptions();
?>
	<tr <?php echo $cv_jp->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cv_jp_list->ListOptions->render("body", "left", $cv_jp_list->RowCount);
?>
	<?php if ($cv_jp_list->idpelat->Visible) { // idpelat ?>
		<td data-name="idpelat" <?php echo $cv_jp_list->idpelat->cellAttributes() ?>>
<span id="el<?php echo $cv_jp_list->RowCount ?>_cv_jp_idpelat">
<span<?php echo $cv_jp_list->idpelat->viewAttributes() ?>><?php echo $cv_jp_list->idpelat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_jp_list->kurikulumid->Visible) { // kurikulumid ?>
		<td data-name="kurikulumid" <?php echo $cv_jp_list->kurikulumid->cellAttributes() ?>>
<span id="el<?php echo $cv_jp_list->RowCount ?>_cv_jp_kurikulumid">
<span<?php echo $cv_jp_list->kurikulumid->viewAttributes() ?>><?php echo $cv_jp_list->kurikulumid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_jp_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $cv_jp_list->tahun->cellAttributes() ?>>
<span id="el<?php echo $cv_jp_list->RowCount ?>_cv_jp_tahun">
<span<?php echo $cv_jp_list->tahun->viewAttributes() ?>><?php echo $cv_jp_list->tahun->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_jp_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $cv_jp_list->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $cv_jp_list->RowCount ?>_cv_jp_kdjudul">
<span<?php echo $cv_jp_list->kdjudul->viewAttributes() ?>><?php echo $cv_jp_list->kdjudul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_jp_list->tgl->Visible) { // tgl ?>
		<td data-name="tgl" <?php echo $cv_jp_list->tgl->cellAttributes() ?>>
<span id="el<?php echo $cv_jp_list->RowCount ?>_cv_jp_tgl">
<span<?php echo $cv_jp_list->tgl->viewAttributes() ?>><?php echo $cv_jp_list->tgl->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_jp_list->bioid->Visible) { // bioid ?>
		<td data-name="bioid" <?php echo $cv_jp_list->bioid->cellAttributes() ?>>
<span id="el<?php echo $cv_jp_list->RowCount ?>_cv_jp_bioid">
<span<?php echo $cv_jp_list->bioid->viewAttributes() ?>><?php echo $cv_jp_list->bioid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_jp_list->nilai->Visible) { // nilai ?>
		<td data-name="nilai" <?php echo $cv_jp_list->nilai->cellAttributes() ?>>
<span id="el<?php echo $cv_jp_list->RowCount ?>_cv_jp_nilai">
<span<?php echo $cv_jp_list->nilai->viewAttributes() ?>><?php echo $cv_jp_list->nilai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_jp_list->komentar->Visible) { // komentar ?>
		<td data-name="komentar" <?php echo $cv_jp_list->komentar->cellAttributes() ?>>
<span id="el<?php echo $cv_jp_list->RowCount ?>_cv_jp_komentar">
<span<?php echo $cv_jp_list->komentar->viewAttributes() ?>><?php echo $cv_jp_list->komentar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cv_jp_list->ListOptions->render("body", "right", $cv_jp_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$cv_jp_list->isGridAdd())
		$cv_jp_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$cv_jp->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cv_jp_list->Recordset)
	$cv_jp_list->Recordset->Close();
?>
<?php if (!$cv_jp_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cv_jp_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cv_jp_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cv_jp_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cv_jp_list->TotalRecords == 0 && !$cv_jp->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cv_jp_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cv_jp_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cv_jp_list->isExport()) { ?>
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
$cv_jp_list->terminate();
?>