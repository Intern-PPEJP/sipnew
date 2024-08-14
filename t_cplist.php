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
$t_cp_list = new t_cp_list();

// Run the page
$t_cp_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_cp_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_cp_list->isExport()) { ?>
<script>
var ft_cplist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_cplist = currentForm = new ew.Form("ft_cplist", "list");
	ft_cplist.formKeyCountName = '<?php echo $t_cp_list->FormKeyCountName ?>';
	loadjs.done("ft_cplist");
});
var ft_cplistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_cplistsrch = currentSearchForm = new ew.Form("ft_cplistsrch");

	// Validate function for search
	ft_cplistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_namap");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_cp_list->namap->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	ft_cplistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_cplistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_cplistsrch.lists["x_namap"] = <?php echo $t_cp_list->namap->Lookup->toClientList($t_cp_list) ?>;
	ft_cplistsrch.lists["x_namap"].options = <?php echo JsonEncode($t_cp_list->namap->lookupOptions()) ?>;
	ft_cplistsrch.autoSuggests["x_namap"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

	// Filters
	ft_cplistsrch.filterList = <?php echo $t_cp_list->getFilterList() ?>;
	loadjs.done("ft_cplistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_cp_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_cp_list->TotalRecords > 0 && $t_cp_list->ExportOptions->visible()) { ?>
<?php $t_cp_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_cp_list->ImportOptions->visible()) { ?>
<?php $t_cp_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_cp_list->SearchOptions->visible()) { ?>
<?php $t_cp_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_cp_list->FilterOptions->visible()) { ?>
<?php $t_cp_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_cp_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_cp_list->isExport() && !$t_cp->CurrentAction) { ?>
<form name="ft_cplistsrch" id="ft_cplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_cplistsrch-search-panel" class="<?php echo $t_cp_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_cp">
	<div class="ew-extended-search">
<?php

// Render search row
$t_cp->RowType = ROWTYPE_SEARCH;
$t_cp->resetAttributes();
$t_cp_list->renderRow();
?>
<?php if ($t_cp_list->namap->Visible) { // namap ?>
	<?php
		$t_cp_list->SearchColumnCount++;
		if (($t_cp_list->SearchColumnCount - 1) % $t_cp_list->SearchFieldsPerRow == 0) {
			$t_cp_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_cp_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_namap" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $t_cp_list->namap->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_namap" id="z_namap" value="=">
</span>
		<span id="el_t_cp_namap" class="ew-search-field">
<?php
$onchange = $t_cp_list->namap->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_cp_list->namap->EditAttrs["onchange"] = "";
?>
<span id="as_x_namap">
	<input type="text" class="form-control" name="sv_x_namap" id="sv_x_namap" value="<?php echo RemoveHtml($t_cp_list->namap->EditValue) ?>" size="75" maxlength="25" placeholder="<?php echo HtmlEncode($t_cp_list->namap->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_cp_list->namap->getPlaceHolder()) ?>"<?php echo $t_cp_list->namap->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_cp" data-field="x_namap" data-value-separator="<?php echo $t_cp_list->namap->displayValueSeparatorAttribute() ?>" name="x_namap" id="x_namap" value="<?php echo HtmlEncode($t_cp_list->namap->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_cplistsrch"], function() {
	ft_cplistsrch.createAutoSuggest({"id":"x_namap","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_cp_list->namap->Lookup->getParamTag($t_cp_list, "p_x_namap") ?>
</span>
	</div>
	<?php if ($t_cp_list->SearchColumnCount % $t_cp_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($t_cp_list->SearchColumnCount % $t_cp_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $t_cp_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($t_cp_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($t_cp_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $t_cp_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($t_cp_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($t_cp_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($t_cp_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($t_cp_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_cp_list->showPageHeader(); ?>
<?php
$t_cp_list->showMessage();
?>
<?php if ($t_cp_list->TotalRecords > 0 || $t_cp->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_cp_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_cp">
<?php if (!$t_cp_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_cp_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_cp_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_cp_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_cplist" id="ft_cplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_cp">
<div id="gmp_t_cp" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_cp_list->TotalRecords > 0 || $t_cp_list->isGridEdit()) { ?>
<table id="tbl_t_cplist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_cp->RowType = ROWTYPE_HEADER;

// Render list options
$t_cp_list->renderListOptions();

// Render list options (header, left)
$t_cp_list->ListOptions->render("header", "left");
?>
<?php if ($t_cp_list->namap->Visible) { // namap ?>
	<?php if ($t_cp_list->SortUrl($t_cp_list->namap) == "") { ?>
		<th data-name="namap" class="<?php echo $t_cp_list->namap->headerCellClass() ?>"><div id="elh_t_cp_namap" class="t_cp_namap"><div class="ew-table-header-caption"><?php echo $t_cp_list->namap->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="namap" class="<?php echo $t_cp_list->namap->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_cp_list->SortUrl($t_cp_list->namap) ?>', 1);"><div id="elh_t_cp_namap" class="t_cp_namap">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_cp_list->namap->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_cp_list->namap->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_cp_list->namap->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_cp_list->cp1->Visible) { // cp1 ?>
	<?php if ($t_cp_list->SortUrl($t_cp_list->cp1) == "") { ?>
		<th data-name="cp1" class="<?php echo $t_cp_list->cp1->headerCellClass() ?>"><div id="elh_t_cp_cp1" class="t_cp_cp1"><div class="ew-table-header-caption"><?php echo $t_cp_list->cp1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cp1" class="<?php echo $t_cp_list->cp1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_cp_list->SortUrl($t_cp_list->cp1) ?>', 1);"><div id="elh_t_cp_cp1" class="t_cp_cp1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_cp_list->cp1->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_cp_list->cp1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_cp_list->cp1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_cp_list->cp2->Visible) { // cp2 ?>
	<?php if ($t_cp_list->SortUrl($t_cp_list->cp2) == "") { ?>
		<th data-name="cp2" class="<?php echo $t_cp_list->cp2->headerCellClass() ?>"><div id="elh_t_cp_cp2" class="t_cp_cp2"><div class="ew-table-header-caption"><?php echo $t_cp_list->cp2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cp2" class="<?php echo $t_cp_list->cp2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_cp_list->SortUrl($t_cp_list->cp2) ?>', 1);"><div id="elh_t_cp_cp2" class="t_cp_cp2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_cp_list->cp2->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_cp_list->cp2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_cp_list->cp2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_cp_list->cp3->Visible) { // cp3 ?>
	<?php if ($t_cp_list->SortUrl($t_cp_list->cp3) == "") { ?>
		<th data-name="cp3" class="<?php echo $t_cp_list->cp3->headerCellClass() ?>"><div id="elh_t_cp_cp3" class="t_cp_cp3"><div class="ew-table-header-caption"><?php echo $t_cp_list->cp3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cp3" class="<?php echo $t_cp_list->cp3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_cp_list->SortUrl($t_cp_list->cp3) ?>', 1);"><div id="elh_t_cp_cp3" class="t_cp_cp3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_cp_list->cp3->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_cp_list->cp3->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_cp_list->cp3->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_cp_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_cp_list->ExportAll && $t_cp_list->isExport()) {
	$t_cp_list->StopRecord = $t_cp_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_cp_list->TotalRecords > $t_cp_list->StartRecord + $t_cp_list->DisplayRecords - 1)
		$t_cp_list->StopRecord = $t_cp_list->StartRecord + $t_cp_list->DisplayRecords - 1;
	else
		$t_cp_list->StopRecord = $t_cp_list->TotalRecords;
}
$t_cp_list->RecordCount = $t_cp_list->StartRecord - 1;
if ($t_cp_list->Recordset && !$t_cp_list->Recordset->EOF) {
	$t_cp_list->Recordset->moveFirst();
	$selectLimit = $t_cp_list->UseSelectLimit;
	if (!$selectLimit && $t_cp_list->StartRecord > 1)
		$t_cp_list->Recordset->move($t_cp_list->StartRecord - 1);
} elseif (!$t_cp->AllowAddDeleteRow && $t_cp_list->StopRecord == 0) {
	$t_cp_list->StopRecord = $t_cp->GridAddRowCount;
}

// Initialize aggregate
$t_cp->RowType = ROWTYPE_AGGREGATEINIT;
$t_cp->resetAttributes();
$t_cp_list->renderRow();
while ($t_cp_list->RecordCount < $t_cp_list->StopRecord) {
	$t_cp_list->RecordCount++;
	if ($t_cp_list->RecordCount >= $t_cp_list->StartRecord) {
		$t_cp_list->RowCount++;

		// Set up key count
		$t_cp_list->KeyCount = $t_cp_list->RowIndex;

		// Init row class and style
		$t_cp->resetAttributes();
		$t_cp->CssClass = "";
		if ($t_cp_list->isGridAdd()) {
		} else {
			$t_cp_list->loadRowValues($t_cp_list->Recordset); // Load row values
		}
		$t_cp->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_cp->RowAttrs->merge(["data-rowindex" => $t_cp_list->RowCount, "id" => "r" . $t_cp_list->RowCount . "_t_cp", "data-rowtype" => $t_cp->RowType]);

		// Render row
		$t_cp_list->renderRow();

		// Render list options
		$t_cp_list->renderListOptions();
?>
	<tr <?php echo $t_cp->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_cp_list->ListOptions->render("body", "left", $t_cp_list->RowCount);
?>
	<?php if ($t_cp_list->namap->Visible) { // namap ?>
		<td data-name="namap" <?php echo $t_cp_list->namap->cellAttributes() ?>>
<span id="el<?php echo $t_cp_list->RowCount ?>_t_cp_namap">
<span<?php echo $t_cp_list->namap->viewAttributes() ?>><?php echo $t_cp_list->namap->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_cp_list->cp1->Visible) { // cp1 ?>
		<td data-name="cp1" <?php echo $t_cp_list->cp1->cellAttributes() ?>>
<span id="el<?php echo $t_cp_list->RowCount ?>_t_cp_cp1">
<span<?php echo $t_cp_list->cp1->viewAttributes() ?>><?php echo $t_cp_list->cp1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_cp_list->cp2->Visible) { // cp2 ?>
		<td data-name="cp2" <?php echo $t_cp_list->cp2->cellAttributes() ?>>
<span id="el<?php echo $t_cp_list->RowCount ?>_t_cp_cp2">
<span<?php echo $t_cp_list->cp2->viewAttributes() ?>><?php echo $t_cp_list->cp2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_cp_list->cp3->Visible) { // cp3 ?>
		<td data-name="cp3" <?php echo $t_cp_list->cp3->cellAttributes() ?>>
<span id="el<?php echo $t_cp_list->RowCount ?>_t_cp_cp3">
<span<?php echo $t_cp_list->cp3->viewAttributes() ?>><?php echo $t_cp_list->cp3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_cp_list->ListOptions->render("body", "right", $t_cp_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_cp_list->isGridAdd())
		$t_cp_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_cp->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_cp_list->Recordset)
	$t_cp_list->Recordset->Close();
?>
<?php if (!$t_cp_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_cp_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_cp_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_cp_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_cp_list->TotalRecords == 0 && !$t_cp->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_cp_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_cp_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_cp_list->isExport()) { ?>
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
$t_cp_list->terminate();
?>