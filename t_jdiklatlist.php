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
$t_jdiklat_list = new t_jdiklat_list();

// Run the page
$t_jdiklat_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_jdiklat_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_jdiklat_list->isExport()) { ?>
<script>
var ft_jdiklatlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_jdiklatlist = currentForm = new ew.Form("ft_jdiklatlist", "list");
	ft_jdiklatlist.formKeyCountName = '<?php echo $t_jdiklat_list->FormKeyCountName ?>';
	loadjs.done("ft_jdiklatlist");
});
var ft_jdiklatlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_jdiklatlistsrch = currentSearchForm = new ew.Form("ft_jdiklatlistsrch");

	// Validate function for search
	ft_jdiklatlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_tahun");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_jdiklat_list->tahun->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	ft_jdiklatlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_jdiklatlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	// Filters

	ft_jdiklatlistsrch.filterList = <?php echo $t_jdiklat_list->getFilterList() ?>;
	loadjs.done("ft_jdiklatlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_jdiklat_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_jdiklat_list->TotalRecords > 0 && $t_jdiklat_list->ExportOptions->visible()) { ?>
<?php $t_jdiklat_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_jdiklat_list->ImportOptions->visible()) { ?>
<?php $t_jdiklat_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_jdiklat_list->SearchOptions->visible()) { ?>
<?php $t_jdiklat_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_jdiklat_list->FilterOptions->visible()) { ?>
<?php $t_jdiklat_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_jdiklat_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_jdiklat_list->isExport() && !$t_jdiklat->CurrentAction) { ?>
<form name="ft_jdiklatlistsrch" id="ft_jdiklatlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_jdiklatlistsrch-search-panel" class="<?php echo $t_jdiklat_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_jdiklat">
	<div class="ew-extended-search">
<?php

// Render search row
$t_jdiklat->RowType = ROWTYPE_SEARCH;
$t_jdiklat->resetAttributes();
$t_jdiklat_list->renderRow();
?>
<?php if ($t_jdiklat_list->tahun->Visible) { // tahun ?>
	<?php
		$t_jdiklat_list->SearchColumnCount++;
		if (($t_jdiklat_list->SearchColumnCount - 1) % $t_jdiklat_list->SearchFieldsPerRow == 0) {
			$t_jdiklat_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_jdiklat_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_tahun" class="ew-cell form-group">
		<label for="x_tahun" class="ew-search-caption ew-label"><?php echo $t_jdiklat_list->tahun->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tahun" id="z_tahun" value="=">
</span>
		<span id="el_t_jdiklat_tahun" class="ew-search-field">
<input type="text" data-table="t_jdiklat" data-field="x_tahun" name="x_tahun" id="x_tahun" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_jdiklat_list->tahun->getPlaceHolder()) ?>" value="<?php echo $t_jdiklat_list->tahun->EditValue ?>"<?php echo $t_jdiklat_list->tahun->editAttributes() ?>>
</span>
	</div>
	<?php if ($t_jdiklat_list->SearchColumnCount % $t_jdiklat_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($t_jdiklat_list->SearchColumnCount % $t_jdiklat_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $t_jdiklat_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_jdiklat_list->showPageHeader(); ?>
<?php
$t_jdiklat_list->showMessage();
?>
<?php if ($t_jdiklat_list->TotalRecords > 0 || $t_jdiklat->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_jdiklat_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_jdiklat">
<?php if (!$t_jdiklat_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_jdiklat_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_jdiklat_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_jdiklat_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_jdiklatlist" id="ft_jdiklatlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_jdiklat">
<div id="gmp_t_jdiklat" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_jdiklat_list->TotalRecords > 0 || $t_jdiklat_list->isGridEdit()) { ?>
<table id="tbl_t_jdiklatlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_jdiklat->RowType = ROWTYPE_HEADER;

// Render list options
$t_jdiklat_list->renderListOptions();

// Render list options (header, left)
$t_jdiklat_list->ListOptions->render("header", "left");
?>
<?php if ($t_jdiklat_list->tahun->Visible) { // tahun ?>
	<?php if ($t_jdiklat_list->SortUrl($t_jdiklat_list->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $t_jdiklat_list->tahun->headerCellClass() ?>"><div id="elh_t_jdiklat_tahun" class="t_jdiklat_tahun"><div class="ew-table-header-caption"><?php echo $t_jdiklat_list->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $t_jdiklat_list->tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jdiklat_list->SortUrl($t_jdiklat_list->tahun) ?>', 1);"><div id="elh_t_jdiklat_tahun" class="t_jdiklat_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jdiklat_list->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jdiklat_list->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jdiklat_list->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jdiklat_list->angkatan_reg->Visible) { // angkatan_reg ?>
	<?php if ($t_jdiklat_list->SortUrl($t_jdiklat_list->angkatan_reg) == "") { ?>
		<th data-name="angkatan_reg" class="<?php echo $t_jdiklat_list->angkatan_reg->headerCellClass() ?>"><div id="elh_t_jdiklat_angkatan_reg" class="t_jdiklat_angkatan_reg"><div class="ew-table-header-caption"><?php echo $t_jdiklat_list->angkatan_reg->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="angkatan_reg" class="<?php echo $t_jdiklat_list->angkatan_reg->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jdiklat_list->SortUrl($t_jdiklat_list->angkatan_reg) ?>', 1);"><div id="elh_t_jdiklat_angkatan_reg" class="t_jdiklat_angkatan_reg">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jdiklat_list->angkatan_reg->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jdiklat_list->angkatan_reg->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jdiklat_list->angkatan_reg->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jdiklat_list->angkatan_kerjasama->Visible) { // angkatan_kerjasama ?>
	<?php if ($t_jdiklat_list->SortUrl($t_jdiklat_list->angkatan_kerjasama) == "") { ?>
		<th data-name="angkatan_kerjasama" class="<?php echo $t_jdiklat_list->angkatan_kerjasama->headerCellClass() ?>"><div id="elh_t_jdiklat_angkatan_kerjasama" class="t_jdiklat_angkatan_kerjasama"><div class="ew-table-header-caption"><?php echo $t_jdiklat_list->angkatan_kerjasama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="angkatan_kerjasama" class="<?php echo $t_jdiklat_list->angkatan_kerjasama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jdiklat_list->SortUrl($t_jdiklat_list->angkatan_kerjasama) ?>', 1);"><div id="elh_t_jdiklat_angkatan_kerjasama" class="t_jdiklat_angkatan_kerjasama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jdiklat_list->angkatan_kerjasama->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jdiklat_list->angkatan_kerjasama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jdiklat_list->angkatan_kerjasama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jdiklat_list->angkatan_web->Visible) { // angkatan_web ?>
	<?php if ($t_jdiklat_list->SortUrl($t_jdiklat_list->angkatan_web) == "") { ?>
		<th data-name="angkatan_web" class="<?php echo $t_jdiklat_list->angkatan_web->headerCellClass() ?>"><div id="elh_t_jdiklat_angkatan_web" class="t_jdiklat_angkatan_web"><div class="ew-table-header-caption"><?php echo $t_jdiklat_list->angkatan_web->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="angkatan_web" class="<?php echo $t_jdiklat_list->angkatan_web->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jdiklat_list->SortUrl($t_jdiklat_list->angkatan_web) ?>', 1);"><div id="elh_t_jdiklat_angkatan_web" class="t_jdiklat_angkatan_web">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jdiklat_list->angkatan_web->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jdiklat_list->angkatan_web->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jdiklat_list->angkatan_web->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jdiklat_list->angkatan_cp->Visible) { // angkatan_cp ?>
	<?php if ($t_jdiklat_list->SortUrl($t_jdiklat_list->angkatan_cp) == "") { ?>
		<th data-name="angkatan_cp" class="<?php echo $t_jdiklat_list->angkatan_cp->headerCellClass() ?>"><div id="elh_t_jdiklat_angkatan_cp" class="t_jdiklat_angkatan_cp"><div class="ew-table-header-caption"><?php echo $t_jdiklat_list->angkatan_cp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="angkatan_cp" class="<?php echo $t_jdiklat_list->angkatan_cp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jdiklat_list->SortUrl($t_jdiklat_list->angkatan_cp) ?>', 1);"><div id="elh_t_jdiklat_angkatan_cp" class="t_jdiklat_angkatan_cp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jdiklat_list->angkatan_cp->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jdiklat_list->angkatan_cp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jdiklat_list->angkatan_cp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_jdiklat_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_jdiklat_list->ExportAll && $t_jdiklat_list->isExport()) {
	$t_jdiklat_list->StopRecord = $t_jdiklat_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_jdiklat_list->TotalRecords > $t_jdiklat_list->StartRecord + $t_jdiklat_list->DisplayRecords - 1)
		$t_jdiklat_list->StopRecord = $t_jdiklat_list->StartRecord + $t_jdiklat_list->DisplayRecords - 1;
	else
		$t_jdiklat_list->StopRecord = $t_jdiklat_list->TotalRecords;
}
$t_jdiklat_list->RecordCount = $t_jdiklat_list->StartRecord - 1;
if ($t_jdiklat_list->Recordset && !$t_jdiklat_list->Recordset->EOF) {
	$t_jdiklat_list->Recordset->moveFirst();
	$selectLimit = $t_jdiklat_list->UseSelectLimit;
	if (!$selectLimit && $t_jdiklat_list->StartRecord > 1)
		$t_jdiklat_list->Recordset->move($t_jdiklat_list->StartRecord - 1);
} elseif (!$t_jdiklat->AllowAddDeleteRow && $t_jdiklat_list->StopRecord == 0) {
	$t_jdiklat_list->StopRecord = $t_jdiklat->GridAddRowCount;
}

// Initialize aggregate
$t_jdiklat->RowType = ROWTYPE_AGGREGATEINIT;
$t_jdiklat->resetAttributes();
$t_jdiklat_list->renderRow();
while ($t_jdiklat_list->RecordCount < $t_jdiklat_list->StopRecord) {
	$t_jdiklat_list->RecordCount++;
	if ($t_jdiklat_list->RecordCount >= $t_jdiklat_list->StartRecord) {
		$t_jdiklat_list->RowCount++;

		// Set up key count
		$t_jdiklat_list->KeyCount = $t_jdiklat_list->RowIndex;

		// Init row class and style
		$t_jdiklat->resetAttributes();
		$t_jdiklat->CssClass = "";
		if ($t_jdiklat_list->isGridAdd()) {
		} else {
			$t_jdiklat_list->loadRowValues($t_jdiklat_list->Recordset); // Load row values
		}
		$t_jdiklat->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_jdiklat->RowAttrs->merge(["data-rowindex" => $t_jdiklat_list->RowCount, "id" => "r" . $t_jdiklat_list->RowCount . "_t_jdiklat", "data-rowtype" => $t_jdiklat->RowType]);

		// Render row
		$t_jdiklat_list->renderRow();

		// Render list options
		$t_jdiklat_list->renderListOptions();
?>
	<tr <?php echo $t_jdiklat->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_jdiklat_list->ListOptions->render("body", "left", $t_jdiklat_list->RowCount);
?>
	<?php if ($t_jdiklat_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $t_jdiklat_list->tahun->cellAttributes() ?>>
<span id="el<?php echo $t_jdiklat_list->RowCount ?>_t_jdiklat_tahun">
<span<?php echo $t_jdiklat_list->tahun->viewAttributes() ?>><?php echo $t_jdiklat_list->tahun->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_jdiklat_list->angkatan_reg->Visible) { // angkatan_reg ?>
		<td data-name="angkatan_reg" <?php echo $t_jdiklat_list->angkatan_reg->cellAttributes() ?>>
<span id="el<?php echo $t_jdiklat_list->RowCount ?>_t_jdiklat_angkatan_reg">
<span<?php echo $t_jdiklat_list->angkatan_reg->viewAttributes() ?>><?php echo $t_jdiklat_list->angkatan_reg->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_jdiklat_list->angkatan_kerjasama->Visible) { // angkatan_kerjasama ?>
		<td data-name="angkatan_kerjasama" <?php echo $t_jdiklat_list->angkatan_kerjasama->cellAttributes() ?>>
<span id="el<?php echo $t_jdiklat_list->RowCount ?>_t_jdiklat_angkatan_kerjasama">
<span<?php echo $t_jdiklat_list->angkatan_kerjasama->viewAttributes() ?>><?php echo $t_jdiklat_list->angkatan_kerjasama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_jdiklat_list->angkatan_web->Visible) { // angkatan_web ?>
		<td data-name="angkatan_web" <?php echo $t_jdiklat_list->angkatan_web->cellAttributes() ?>>
<span id="el<?php echo $t_jdiklat_list->RowCount ?>_t_jdiklat_angkatan_web">
<span<?php echo $t_jdiklat_list->angkatan_web->viewAttributes() ?>><?php echo $t_jdiklat_list->angkatan_web->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_jdiklat_list->angkatan_cp->Visible) { // angkatan_cp ?>
		<td data-name="angkatan_cp" <?php echo $t_jdiklat_list->angkatan_cp->cellAttributes() ?>>
<span id="el<?php echo $t_jdiklat_list->RowCount ?>_t_jdiklat_angkatan_cp">
<span<?php echo $t_jdiklat_list->angkatan_cp->viewAttributes() ?>><?php echo $t_jdiklat_list->angkatan_cp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_jdiklat_list->ListOptions->render("body", "right", $t_jdiklat_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_jdiklat_list->isGridAdd())
		$t_jdiklat_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_jdiklat->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_jdiklat_list->Recordset)
	$t_jdiklat_list->Recordset->Close();
?>
<?php if (!$t_jdiklat_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_jdiklat_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_jdiklat_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_jdiklat_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_jdiklat_list->TotalRecords == 0 && !$t_jdiklat->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_jdiklat_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_jdiklat_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_jdiklat_list->isExport()) { ?>
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
$t_jdiklat_list->terminate();
?>