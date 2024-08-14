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
$excp_list = new excp_list();

// Run the page
$excp_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$excp_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$excp_list->isExport()) { ?>
<script>
var fexcplist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fexcplist = currentForm = new ew.Form("fexcplist", "list");
	fexcplist.formKeyCountName = '<?php echo $excp_list->FormKeyCountName ?>';
	loadjs.done("fexcplist");
});
var fexcplistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fexcplistsrch = currentSearchForm = new ew.Form("fexcplistsrch");

	// Validate function for search
	fexcplistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_kerjasama");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($excp_list->kerjasama->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fexcplistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fexcplistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fexcplistsrch.lists["x_tahun_keg"] = <?php echo $excp_list->tahun_keg->Lookup->toClientList($excp_list) ?>;
	fexcplistsrch.lists["x_tahun_keg"].options = <?php echo JsonEncode($excp_list->tahun_keg->lookupOptions()) ?>;
	fexcplistsrch.lists["x_area2"] = <?php echo $excp_list->area2->Lookup->toClientList($excp_list) ?>;
	fexcplistsrch.lists["x_area2"].options = <?php echo JsonEncode($excp_list->area2->lookupOptions()) ?>;
	fexcplistsrch.lists["x_kerjasama"] = <?php echo $excp_list->kerjasama->Lookup->toClientList($excp_list) ?>;
	fexcplistsrch.lists["x_kerjasama"].options = <?php echo JsonEncode($excp_list->kerjasama->lookupOptions()) ?>;
	fexcplistsrch.autoSuggests["x_kerjasama"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

	// Filters
	fexcplistsrch.filterList = <?php echo $excp_list->getFilterList() ?>;
	loadjs.done("fexcplistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$excp_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($excp_list->TotalRecords > 0 && $excp_list->ExportOptions->visible()) { ?>
<?php $excp_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($excp_list->ImportOptions->visible()) { ?>
<?php $excp_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($excp_list->SearchOptions->visible()) { ?>
<?php $excp_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($excp_list->FilterOptions->visible()) { ?>
<?php $excp_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$excp_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$excp_list->isExport() && !$excp->CurrentAction) { ?>
<form name="fexcplistsrch" id="fexcplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fexcplistsrch-search-panel" class="<?php echo $excp_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="excp">
	<div class="ew-extended-search">
<?php

// Render search row
$excp->RowType = ROWTYPE_SEARCH;
$excp->resetAttributes();
$excp_list->renderRow();
?>
<?php if ($excp_list->tahun_keg->Visible) { // tahun_keg ?>
	<?php
		$excp_list->SearchColumnCount++;
		if (($excp_list->SearchColumnCount - 1) % $excp_list->SearchFieldsPerRow == 0) {
			$excp_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $excp_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_tahun_keg" class="ew-cell form-group">
		<label for="x_tahun_keg" class="ew-search-caption ew-label"><?php echo $excp_list->tahun_keg->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tahun_keg" id="z_tahun_keg" value="=">
</span>
		<span id="el_excp_tahun_keg" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="excp" data-field="x_tahun_keg" data-value-separator="<?php echo $excp_list->tahun_keg->displayValueSeparatorAttribute() ?>" id="x_tahun_keg" name="x_tahun_keg"<?php echo $excp_list->tahun_keg->editAttributes() ?>>
			<?php echo $excp_list->tahun_keg->selectOptionListHtml("x_tahun_keg") ?>
		</select>
</div>
<?php echo $excp_list->tahun_keg->Lookup->getParamTag($excp_list, "p_x_tahun_keg") ?>
</span>
	</div>
	<?php if ($excp_list->SearchColumnCount % $excp_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($excp_list->area2->Visible) { // area2 ?>
	<?php
		$excp_list->SearchColumnCount++;
		if (($excp_list->SearchColumnCount - 1) % $excp_list->SearchFieldsPerRow == 0) {
			$excp_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $excp_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_area2" class="ew-cell form-group">
		<label for="x_area2" class="ew-search-caption ew-label"><?php echo $excp_list->area2->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_area2" id="z_area2" value="=">
</span>
		<span id="el_excp_area2" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="excp" data-field="x_area2" data-value-separator="<?php echo $excp_list->area2->displayValueSeparatorAttribute() ?>" id="x_area2" name="x_area2"<?php echo $excp_list->area2->editAttributes() ?>>
			<?php echo $excp_list->area2->selectOptionListHtml("x_area2") ?>
		</select>
</div>
<?php echo $excp_list->area2->Lookup->getParamTag($excp_list, "p_x_area2") ?>
</span>
	</div>
	<?php if ($excp_list->SearchColumnCount % $excp_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($excp_list->kerjasama->Visible) { // kerjasama ?>
	<?php
		$excp_list->SearchColumnCount++;
		if (($excp_list->SearchColumnCount - 1) % $excp_list->SearchFieldsPerRow == 0) {
			$excp_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $excp_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kerjasama" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $excp_list->kerjasama->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kerjasama" id="z_kerjasama" value="=">
</span>
		<span id="el_excp_kerjasama" class="ew-search-field">
<?php
$onchange = $excp_list->kerjasama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$excp_list->kerjasama->EditAttrs["onchange"] = "";
?>
<span id="as_x_kerjasama">
	<input type="text" class="form-control" name="sv_x_kerjasama" id="sv_x_kerjasama" value="<?php echo RemoveHtml($excp_list->kerjasama->EditValue) ?>" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($excp_list->kerjasama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($excp_list->kerjasama->getPlaceHolder()) ?>"<?php echo $excp_list->kerjasama->editAttributes() ?>>
</span>
<input type="hidden" data-table="excp" data-field="x_kerjasama" data-value-separator="<?php echo $excp_list->kerjasama->displayValueSeparatorAttribute() ?>" name="x_kerjasama" id="x_kerjasama" value="<?php echo HtmlEncode($excp_list->kerjasama->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fexcplistsrch"], function() {
	fexcplistsrch.createAutoSuggest({"id":"x_kerjasama","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $excp_list->kerjasama->Lookup->getParamTag($excp_list, "p_x_kerjasama") ?>
</span>
	</div>
	<?php if ($excp_list->SearchColumnCount % $excp_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($excp_list->SearchColumnCount % $excp_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $excp_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($excp_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($excp_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $excp_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($excp_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($excp_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($excp_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($excp_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $excp_list->showPageHeader(); ?>
<?php
$excp_list->showMessage();
?>
<?php if ($excp_list->TotalRecords > 0 || $excp->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($excp_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> excp">
<?php if (!$excp_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$excp_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $excp_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $excp_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fexcplist" id="fexcplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="excp">
<div id="gmp_excp" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($excp_list->TotalRecords > 0 || $excp_list->isGridEdit()) { ?>
<table id="tbl_excplist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$excp->RowType = ROWTYPE_HEADER;

// Render list options
$excp_list->renderListOptions();

// Render list options (header, left)
$excp_list->ListOptions->render("header", "left");
?>
<?php if ($excp_list->tahun_keg->Visible) { // tahun_keg ?>
	<?php if ($excp_list->SortUrl($excp_list->tahun_keg) == "") { ?>
		<th data-name="tahun_keg" class="<?php echo $excp_list->tahun_keg->headerCellClass() ?>"><div id="elh_excp_tahun_keg" class="excp_tahun_keg"><div class="ew-table-header-caption"><?php echo $excp_list->tahun_keg->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun_keg" class="<?php echo $excp_list->tahun_keg->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $excp_list->SortUrl($excp_list->tahun_keg) ?>', 1);"><div id="elh_excp_tahun_keg" class="excp_tahun_keg">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $excp_list->tahun_keg->caption() ?></span><span class="ew-table-header-sort"><?php if ($excp_list->tahun_keg->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($excp_list->tahun_keg->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($excp_list->area2->Visible) { // area2 ?>
	<?php if ($excp_list->SortUrl($excp_list->area2) == "") { ?>
		<th data-name="area2" class="<?php echo $excp_list->area2->headerCellClass() ?>"><div id="elh_excp_area2" class="excp_area2"><div class="ew-table-header-caption"><?php echo $excp_list->area2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="area2" class="<?php echo $excp_list->area2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $excp_list->SortUrl($excp_list->area2) ?>', 1);"><div id="elh_excp_area2" class="excp_area2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $excp_list->area2->caption() ?></span><span class="ew-table-header-sort"><?php if ($excp_list->area2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($excp_list->area2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($excp_list->kerjasama->Visible) { // kerjasama ?>
	<?php if ($excp_list->SortUrl($excp_list->kerjasama) == "") { ?>
		<th data-name="kerjasama" class="<?php echo $excp_list->kerjasama->headerCellClass() ?>"><div id="elh_excp_kerjasama" class="excp_kerjasama"><div class="ew-table-header-caption"><?php echo $excp_list->kerjasama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kerjasama" class="<?php echo $excp_list->kerjasama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $excp_list->SortUrl($excp_list->kerjasama) ?>', 1);"><div id="elh_excp_kerjasama" class="excp_kerjasama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $excp_list->kerjasama->caption() ?></span><span class="ew-table-header-sort"><?php if ($excp_list->kerjasama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($excp_list->kerjasama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($excp_list->jml_peserta->Visible) { // jml_peserta ?>
	<?php if ($excp_list->SortUrl($excp_list->jml_peserta) == "") { ?>
		<th data-name="jml_peserta" class="<?php echo $excp_list->jml_peserta->headerCellClass() ?>"><div id="elh_excp_jml_peserta" class="excp_jml_peserta"><div class="ew-table-header-caption"><?php echo $excp_list->jml_peserta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jml_peserta" class="<?php echo $excp_list->jml_peserta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $excp_list->SortUrl($excp_list->jml_peserta) ?>', 1);"><div id="elh_excp_jml_peserta" class="excp_jml_peserta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $excp_list->jml_peserta->caption() ?></span><span class="ew-table-header-sort"><?php if ($excp_list->jml_peserta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($excp_list->jml_peserta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$excp_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($excp_list->ExportAll && $excp_list->isExport()) {
	$excp_list->StopRecord = $excp_list->TotalRecords;
} else {

	// Set the last record to display
	if ($excp_list->TotalRecords > $excp_list->StartRecord + $excp_list->DisplayRecords - 1)
		$excp_list->StopRecord = $excp_list->StartRecord + $excp_list->DisplayRecords - 1;
	else
		$excp_list->StopRecord = $excp_list->TotalRecords;
}
$excp_list->RecordCount = $excp_list->StartRecord - 1;
if ($excp_list->Recordset && !$excp_list->Recordset->EOF) {
	$excp_list->Recordset->moveFirst();
	$selectLimit = $excp_list->UseSelectLimit;
	if (!$selectLimit && $excp_list->StartRecord > 1)
		$excp_list->Recordset->move($excp_list->StartRecord - 1);
} elseif (!$excp->AllowAddDeleteRow && $excp_list->StopRecord == 0) {
	$excp_list->StopRecord = $excp->GridAddRowCount;
}

// Initialize aggregate
$excp->RowType = ROWTYPE_AGGREGATEINIT;
$excp->resetAttributes();
$excp_list->renderRow();
while ($excp_list->RecordCount < $excp_list->StopRecord) {
	$excp_list->RecordCount++;
	if ($excp_list->RecordCount >= $excp_list->StartRecord) {
		$excp_list->RowCount++;

		// Set up key count
		$excp_list->KeyCount = $excp_list->RowIndex;

		// Init row class and style
		$excp->resetAttributes();
		$excp->CssClass = "";
		if ($excp_list->isGridAdd()) {
		} else {
			$excp_list->loadRowValues($excp_list->Recordset); // Load row values
		}
		$excp->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$excp->RowAttrs->merge(["data-rowindex" => $excp_list->RowCount, "id" => "r" . $excp_list->RowCount . "_excp", "data-rowtype" => $excp->RowType]);

		// Render row
		$excp_list->renderRow();

		// Render list options
		$excp_list->renderListOptions();
?>
	<tr <?php echo $excp->rowAttributes() ?>>
<?php

// Render list options (body, left)
$excp_list->ListOptions->render("body", "left", $excp_list->RowCount);
?>
	<?php if ($excp_list->tahun_keg->Visible) { // tahun_keg ?>
		<td data-name="tahun_keg" <?php echo $excp_list->tahun_keg->cellAttributes() ?>>
<span id="el<?php echo $excp_list->RowCount ?>_excp_tahun_keg">
<span<?php echo $excp_list->tahun_keg->viewAttributes() ?>><?php echo $excp_list->tahun_keg->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($excp_list->area2->Visible) { // area2 ?>
		<td data-name="area2" <?php echo $excp_list->area2->cellAttributes() ?>>
<span id="el<?php echo $excp_list->RowCount ?>_excp_area2">
<span<?php echo $excp_list->area2->viewAttributes() ?>><?php echo $excp_list->area2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($excp_list->kerjasama->Visible) { // kerjasama ?>
		<td data-name="kerjasama" <?php echo $excp_list->kerjasama->cellAttributes() ?>>
<span id="el<?php echo $excp_list->RowCount ?>_excp_kerjasama">
<span<?php echo $excp_list->kerjasama->viewAttributes() ?>><?php echo $excp_list->kerjasama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($excp_list->jml_peserta->Visible) { // jml_peserta ?>
		<td data-name="jml_peserta" <?php echo $excp_list->jml_peserta->cellAttributes() ?>>
<span id="el<?php echo $excp_list->RowCount ?>_excp_jml_peserta">
<span<?php echo $excp_list->jml_peserta->viewAttributes() ?>><?php echo $excp_list->jml_peserta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$excp_list->ListOptions->render("body", "right", $excp_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$excp_list->isGridAdd())
		$excp_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$excp->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($excp_list->Recordset)
	$excp_list->Recordset->Close();
?>
<?php if (!$excp_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$excp_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $excp_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $excp_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($excp_list->TotalRecords == 0 && !$excp->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $excp_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$excp_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$excp_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$(".cdata").html("<?php echo Page()->TotalRecords; ?>");
});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$excp_list->terminate();
?>