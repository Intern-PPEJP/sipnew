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
$t_judul_list = new t_judul_list();

// Run the page
$t_judul_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_judul_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_judul_list->isExport()) { ?>
<script>
var ft_judullist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_judullist = currentForm = new ew.Form("ft_judullist", "list");
	ft_judullist.formKeyCountName = '<?php echo $t_judul_list->FormKeyCountName ?>';
	loadjs.done("ft_judullist");
});
var ft_judullistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_judullistsrch = currentSearchForm = new ew.Form("ft_judullistsrch");

	// Validate function for search
	ft_judullistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_created_at");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_judul_list->created_at->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	ft_judullistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_judullistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_judullistsrch.lists["x_kdbidang"] = <?php echo $t_judul_list->kdbidang->Lookup->toClientList($t_judul_list) ?>;
	ft_judullistsrch.lists["x_kdbidang"].options = <?php echo JsonEncode($t_judul_list->kdbidang->lookupOptions()) ?>;

	// Filters
	ft_judullistsrch.filterList = <?php echo $t_judul_list->getFilterList() ?>;
	loadjs.done("ft_judullistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//document.write('<?php echo cs_judul("list","Daftar Judul");?>');

});
</script>
<?php } ?>
<?php if (!$t_judul_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_judul_list->TotalRecords > 0 && $t_judul_list->ExportOptions->visible()) { ?>
<?php $t_judul_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_judul_list->ImportOptions->visible()) { ?>
<?php $t_judul_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_judul_list->SearchOptions->visible()) { ?>
<?php $t_judul_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_judul_list->FilterOptions->visible()) { ?>
<?php $t_judul_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_judul_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_judul_list->isExport() && !$t_judul->CurrentAction) { ?>
<form name="ft_judullistsrch" id="ft_judullistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_judullistsrch-search-panel" class="<?php echo $t_judul_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_judul">
	<div class="ew-extended-search">
<?php

// Render search row
$t_judul->RowType = ROWTYPE_SEARCH;
$t_judul->resetAttributes();
$t_judul_list->renderRow();
?>
<?php if ($t_judul_list->kdbidang->Visible) { // kdbidang ?>
	<?php
		$t_judul_list->SearchColumnCount++;
		if (($t_judul_list->SearchColumnCount - 1) % $t_judul_list->SearchFieldsPerRow == 0) {
			$t_judul_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_judul_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kdbidang" class="ew-cell form-group">
		<label for="x_kdbidang" class="ew-search-caption ew-label"><?php echo $t_judul_list->kdbidang->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdbidang" id="z_kdbidang" value="=">
</span>
		<span id="el_t_judul_kdbidang" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_judul" data-field="x_kdbidang" data-value-separator="<?php echo $t_judul_list->kdbidang->displayValueSeparatorAttribute() ?>" id="x_kdbidang" name="x_kdbidang"<?php echo $t_judul_list->kdbidang->editAttributes() ?>>
			<?php echo $t_judul_list->kdbidang->selectOptionListHtml("x_kdbidang") ?>
		</select>
</div>
<?php echo $t_judul_list->kdbidang->Lookup->getParamTag($t_judul_list, "p_x_kdbidang") ?>
</span>
	</div>
	<?php if ($t_judul_list->SearchColumnCount % $t_judul_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($t_judul_list->judul->Visible) { // judul ?>
	<?php
		$t_judul_list->SearchColumnCount++;
		if (($t_judul_list->SearchColumnCount - 1) % $t_judul_list->SearchFieldsPerRow == 0) {
			$t_judul_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_judul_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_judul" class="ew-cell form-group">
		<label for="x_judul" class="ew-search-caption ew-label"><?php echo $t_judul_list->judul->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_judul" id="z_judul" value="LIKE">
</span>
		<span id="el_t_judul_judul" class="ew-search-field">
<input type="text" data-table="t_judul" data-field="x_judul" name="x_judul" id="x_judul" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($t_judul_list->judul->getPlaceHolder()) ?>" value="<?php echo $t_judul_list->judul->EditValue ?>"<?php echo $t_judul_list->judul->editAttributes() ?>>
</span>
	</div>
	<?php if ($t_judul_list->SearchColumnCount % $t_judul_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($t_judul_list->created_at->Visible) { // created_at ?>
	<?php
		$t_judul_list->SearchColumnCount++;
		if (($t_judul_list->SearchColumnCount - 1) % $t_judul_list->SearchFieldsPerRow == 0) {
			$t_judul_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_judul_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_created_at" class="ew-cell form-group">
		<label for="x_created_at" class="ew-search-caption ew-label"><?php echo $t_judul_list->created_at->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_created_at" id="z_created_at" value="BETWEEN">
</span>
		<span id="el_t_judul_created_at" class="ew-search-field">
<input type="text" data-table="t_judul" data-field="x_created_at" name="x_created_at" id="x_created_at" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_judul_list->created_at->getPlaceHolder()) ?>" value="<?php echo $t_judul_list->created_at->EditValue ?>"<?php echo $t_judul_list->created_at->editAttributes() ?>>
<?php if (!$t_judul_list->created_at->ReadOnly && !$t_judul_list->created_at->Disabled && !isset($t_judul_list->created_at->EditAttrs["readonly"]) && !isset($t_judul_list->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_judullistsrch", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_judullistsrch", "x_created_at", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		<span class="ew-search-and"><label><?php echo $Language->phrase("AND") ?></label></span>
		<span id="el2_t_judul_created_at" class="ew-search-field2">
<input type="text" data-table="t_judul" data-field="x_created_at" name="y_created_at" id="y_created_at" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_judul_list->created_at->getPlaceHolder()) ?>" value="<?php echo $t_judul_list->created_at->EditValue2 ?>"<?php echo $t_judul_list->created_at->editAttributes() ?>>
<?php if (!$t_judul_list->created_at->ReadOnly && !$t_judul_list->created_at->Disabled && !isset($t_judul_list->created_at->EditAttrs["readonly"]) && !isset($t_judul_list->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_judullistsrch", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_judullistsrch", "y_created_at", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
	</div>
	<?php if ($t_judul_list->SearchColumnCount % $t_judul_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($t_judul_list->SearchColumnCount % $t_judul_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $t_judul_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_judul_list->showPageHeader(); ?>
<?php
$t_judul_list->showMessage();
?>
<?php if ($t_judul_list->TotalRecords > 0 || $t_judul->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_judul_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_judul">
<?php if (!$t_judul_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_judul_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_judul_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_judul_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_judullist" id="ft_judullist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_judul">
<div id="gmp_t_judul" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_judul_list->TotalRecords > 0 || $t_judul_list->isGridEdit()) { ?>
<table id="tbl_t_judullist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_judul->RowType = ROWTYPE_HEADER;

// Render list options
$t_judul_list->renderListOptions();

// Render list options (header, left)
$t_judul_list->ListOptions->render("header", "left");
?>
<?php if ($t_judul_list->kdjudul->Visible) { // kdjudul ?>
	<?php if ($t_judul_list->SortUrl($t_judul_list->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $t_judul_list->kdjudul->headerCellClass() ?>"><div id="elh_t_judul_kdjudul" class="t_judul_kdjudul"><div class="ew-table-header-caption"><?php echo $t_judul_list->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $t_judul_list->kdjudul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_judul_list->SortUrl($t_judul_list->kdjudul) ?>', 1);"><div id="elh_t_judul_kdjudul" class="t_judul_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_judul_list->kdjudul->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_judul_list->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_judul_list->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_judul_list->kdbidang->Visible) { // kdbidang ?>
	<?php if ($t_judul_list->SortUrl($t_judul_list->kdbidang) == "") { ?>
		<th data-name="kdbidang" class="<?php echo $t_judul_list->kdbidang->headerCellClass() ?>"><div id="elh_t_judul_kdbidang" class="t_judul_kdbidang"><div class="ew-table-header-caption"><?php echo $t_judul_list->kdbidang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdbidang" class="<?php echo $t_judul_list->kdbidang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_judul_list->SortUrl($t_judul_list->kdbidang) ?>', 1);"><div id="elh_t_judul_kdbidang" class="t_judul_kdbidang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_judul_list->kdbidang->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_judul_list->kdbidang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_judul_list->kdbidang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_judul_list->judul->Visible) { // judul ?>
	<?php if ($t_judul_list->SortUrl($t_judul_list->judul) == "") { ?>
		<th data-name="judul" class="<?php echo $t_judul_list->judul->headerCellClass() ?>"><div id="elh_t_judul_judul" class="t_judul_judul"><div class="ew-table-header-caption"><?php echo $t_judul_list->judul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="judul" class="<?php echo $t_judul_list->judul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_judul_list->SortUrl($t_judul_list->judul) ?>', 1);"><div id="elh_t_judul_judul" class="t_judul_judul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_judul_list->judul->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_judul_list->judul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_judul_list->judul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_judul_list->singkatan->Visible) { // singkatan ?>
	<?php if ($t_judul_list->SortUrl($t_judul_list->singkatan) == "") { ?>
		<th data-name="singkatan" class="<?php echo $t_judul_list->singkatan->headerCellClass() ?>"><div id="elh_t_judul_singkatan" class="t_judul_singkatan"><div class="ew-table-header-caption"><?php echo $t_judul_list->singkatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="singkatan" class="<?php echo $t_judul_list->singkatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_judul_list->SortUrl($t_judul_list->singkatan) ?>', 1);"><div id="elh_t_judul_singkatan" class="t_judul_singkatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_judul_list->singkatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_judul_list->singkatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_judul_list->singkatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_judul_list->created_at->Visible) { // created_at ?>
	<?php if ($t_judul_list->SortUrl($t_judul_list->created_at) == "") { ?>
		<th data-name="created_at" class="<?php echo $t_judul_list->created_at->headerCellClass() ?>"><div id="elh_t_judul_created_at" class="t_judul_created_at"><div class="ew-table-header-caption"><?php echo $t_judul_list->created_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_at" class="<?php echo $t_judul_list->created_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_judul_list->SortUrl($t_judul_list->created_at) ?>', 1);"><div id="elh_t_judul_created_at" class="t_judul_created_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_judul_list->created_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_judul_list->created_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_judul_list->created_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_judul_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_judul_list->ExportAll && $t_judul_list->isExport()) {
	$t_judul_list->StopRecord = $t_judul_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_judul_list->TotalRecords > $t_judul_list->StartRecord + $t_judul_list->DisplayRecords - 1)
		$t_judul_list->StopRecord = $t_judul_list->StartRecord + $t_judul_list->DisplayRecords - 1;
	else
		$t_judul_list->StopRecord = $t_judul_list->TotalRecords;
}
$t_judul_list->RecordCount = $t_judul_list->StartRecord - 1;
if ($t_judul_list->Recordset && !$t_judul_list->Recordset->EOF) {
	$t_judul_list->Recordset->moveFirst();
	$selectLimit = $t_judul_list->UseSelectLimit;
	if (!$selectLimit && $t_judul_list->StartRecord > 1)
		$t_judul_list->Recordset->move($t_judul_list->StartRecord - 1);
} elseif (!$t_judul->AllowAddDeleteRow && $t_judul_list->StopRecord == 0) {
	$t_judul_list->StopRecord = $t_judul->GridAddRowCount;
}

// Initialize aggregate
$t_judul->RowType = ROWTYPE_AGGREGATEINIT;
$t_judul->resetAttributes();
$t_judul_list->renderRow();
while ($t_judul_list->RecordCount < $t_judul_list->StopRecord) {
	$t_judul_list->RecordCount++;
	if ($t_judul_list->RecordCount >= $t_judul_list->StartRecord) {
		$t_judul_list->RowCount++;

		// Set up key count
		$t_judul_list->KeyCount = $t_judul_list->RowIndex;

		// Init row class and style
		$t_judul->resetAttributes();
		$t_judul->CssClass = "";
		if ($t_judul_list->isGridAdd()) {
		} else {
			$t_judul_list->loadRowValues($t_judul_list->Recordset); // Load row values
		}
		$t_judul->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_judul->RowAttrs->merge(["data-rowindex" => $t_judul_list->RowCount, "id" => "r" . $t_judul_list->RowCount . "_t_judul", "data-rowtype" => $t_judul->RowType]);

		// Render row
		$t_judul_list->renderRow();

		// Render list options
		$t_judul_list->renderListOptions();
?>
	<tr <?php echo $t_judul->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_judul_list->ListOptions->render("body", "left", $t_judul_list->RowCount);
?>
	<?php if ($t_judul_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $t_judul_list->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $t_judul_list->RowCount ?>_t_judul_kdjudul">
<span<?php echo $t_judul_list->kdjudul->viewAttributes() ?>><?php echo $t_judul_list->kdjudul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_judul_list->kdbidang->Visible) { // kdbidang ?>
		<td data-name="kdbidang" <?php echo $t_judul_list->kdbidang->cellAttributes() ?>>
<span id="el<?php echo $t_judul_list->RowCount ?>_t_judul_kdbidang">
<span<?php echo $t_judul_list->kdbidang->viewAttributes() ?>><?php echo $t_judul_list->kdbidang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_judul_list->judul->Visible) { // judul ?>
		<td data-name="judul" <?php echo $t_judul_list->judul->cellAttributes() ?>>
<span id="el<?php echo $t_judul_list->RowCount ?>_t_judul_judul">
<span<?php echo $t_judul_list->judul->viewAttributes() ?>><?php echo $t_judul_list->judul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_judul_list->singkatan->Visible) { // singkatan ?>
		<td data-name="singkatan" <?php echo $t_judul_list->singkatan->cellAttributes() ?>>
<span id="el<?php echo $t_judul_list->RowCount ?>_t_judul_singkatan">
<span<?php echo $t_judul_list->singkatan->viewAttributes() ?>><?php echo $t_judul_list->singkatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_judul_list->created_at->Visible) { // created_at ?>
		<td data-name="created_at" <?php echo $t_judul_list->created_at->cellAttributes() ?>>
<span id="el<?php echo $t_judul_list->RowCount ?>_t_judul_created_at">
<span<?php echo $t_judul_list->created_at->viewAttributes() ?>><?php echo $t_judul_list->created_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_judul_list->ListOptions->render("body", "right", $t_judul_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_judul_list->isGridAdd())
		$t_judul_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_judul->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_judul_list->Recordset)
	$t_judul_list->Recordset->Close();
?>
<?php if (!$t_judul_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_judul_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_judul_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_judul_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_judul_list->TotalRecords == 0 && !$t_judul->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_judul_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_judul_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_judul_list->isExport()) { ?>
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
$t_judul_list->terminate();
?>