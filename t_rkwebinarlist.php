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
$t_rkwebinar_list = new t_rkwebinar_list();

// Run the page
$t_rkwebinar_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rkwebinar_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_rkwebinar_list->isExport()) { ?>
<script>
var ft_rkwebinarlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_rkwebinarlist = currentForm = new ew.Form("ft_rkwebinarlist", "list");
	ft_rkwebinarlist.formKeyCountName = '<?php echo $t_rkwebinar_list->FormKeyCountName ?>';
	loadjs.done("ft_rkwebinarlist");
});
var ft_rkwebinarlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_rkwebinarlistsrch = currentSearchForm = new ew.Form("ft_rkwebinarlistsrch");

	// Validate function for search
	ft_rkwebinarlistsrch.validate = function(fobj) {
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
	ft_rkwebinarlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_rkwebinarlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_rkwebinarlistsrch.lists["x_tahun"] = <?php echo $t_rkwebinar_list->tahun->Lookup->toClientList($t_rkwebinar_list) ?>;
	ft_rkwebinarlistsrch.lists["x_tahun"].options = <?php echo JsonEncode($t_rkwebinar_list->tahun->lookupOptions()) ?>;

	// Filters
	ft_rkwebinarlistsrch.filterList = <?php echo $t_rkwebinar_list->getFilterList() ?>;
	loadjs.done("ft_rkwebinarlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_rkwebinar_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_rkwebinar_list->TotalRecords > 0 && $t_rkwebinar_list->ExportOptions->visible()) { ?>
<?php $t_rkwebinar_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_rkwebinar_list->ImportOptions->visible()) { ?>
<?php $t_rkwebinar_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_rkwebinar_list->SearchOptions->visible()) { ?>
<?php $t_rkwebinar_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_rkwebinar_list->FilterOptions->visible()) { ?>
<?php $t_rkwebinar_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_rkwebinar_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_rkwebinar_list->isExport() && !$t_rkwebinar->CurrentAction) { ?>
<form name="ft_rkwebinarlistsrch" id="ft_rkwebinarlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_rkwebinarlistsrch-search-panel" class="<?php echo $t_rkwebinar_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_rkwebinar">
	<div class="ew-extended-search">
<?php

// Render search row
$t_rkwebinar->RowType = ROWTYPE_SEARCH;
$t_rkwebinar->resetAttributes();
$t_rkwebinar_list->renderRow();
?>
<?php if ($t_rkwebinar_list->tahun->Visible) { // tahun ?>
	<?php
		$t_rkwebinar_list->SearchColumnCount++;
		if (($t_rkwebinar_list->SearchColumnCount - 1) % $t_rkwebinar_list->SearchFieldsPerRow == 0) {
			$t_rkwebinar_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $t_rkwebinar_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_tahun" class="ew-cell form-group">
		<label for="x_tahun" class="ew-search-caption ew-label"><?php echo $t_rkwebinar_list->tahun->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tahun" id="z_tahun" value="=">
</span>
		<span id="el_t_rkwebinar_tahun" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_rkwebinar" data-field="x_tahun" data-value-separator="<?php echo $t_rkwebinar_list->tahun->displayValueSeparatorAttribute() ?>" id="x_tahun" name="x_tahun"<?php echo $t_rkwebinar_list->tahun->editAttributes() ?>>
			<?php echo $t_rkwebinar_list->tahun->selectOptionListHtml("x_tahun") ?>
		</select>
</div>
<?php echo $t_rkwebinar_list->tahun->Lookup->getParamTag($t_rkwebinar_list, "p_x_tahun") ?>
</span>
	</div>
	<?php if ($t_rkwebinar_list->SearchColumnCount % $t_rkwebinar_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($t_rkwebinar_list->SearchColumnCount % $t_rkwebinar_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $t_rkwebinar_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_rkwebinar_list->showPageHeader(); ?>
<?php
$t_rkwebinar_list->showMessage();
?>
<?php if ($t_rkwebinar_list->TotalRecords > 0 || $t_rkwebinar->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_rkwebinar_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_rkwebinar">
<?php if (!$t_rkwebinar_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_rkwebinar_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_rkwebinar_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_rkwebinar_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_rkwebinarlist" id="ft_rkwebinarlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rkwebinar">
<div id="gmp_t_rkwebinar" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_rkwebinar_list->TotalRecords > 0 || $t_rkwebinar_list->isGridEdit()) { ?>
<table id="tbl_t_rkwebinarlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_rkwebinar->RowType = ROWTYPE_HEADER;

// Render list options
$t_rkwebinar_list->renderListOptions();

// Render list options (header, left)
$t_rkwebinar_list->ListOptions->render("header", "left");
?>
<?php if ($t_rkwebinar_list->kegiatan->Visible) { // kegiatan ?>
	<?php if ($t_rkwebinar_list->SortUrl($t_rkwebinar_list->kegiatan) == "") { ?>
		<th data-name="kegiatan" class="<?php echo $t_rkwebinar_list->kegiatan->headerCellClass() ?>"><div id="elh_t_rkwebinar_kegiatan" class="t_rkwebinar_kegiatan"><div class="ew-table-header-caption"><?php echo $t_rkwebinar_list->kegiatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kegiatan" class="<?php echo $t_rkwebinar_list->kegiatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rkwebinar_list->SortUrl($t_rkwebinar_list->kegiatan) ?>', 1);"><div id="elh_t_rkwebinar_kegiatan" class="t_rkwebinar_kegiatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rkwebinar_list->kegiatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rkwebinar_list->kegiatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rkwebinar_list->kegiatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rkwebinar_list->tanggal_kegiatan->Visible) { // tanggal_kegiatan ?>
	<?php if ($t_rkwebinar_list->SortUrl($t_rkwebinar_list->tanggal_kegiatan) == "") { ?>
		<th data-name="tanggal_kegiatan" class="<?php echo $t_rkwebinar_list->tanggal_kegiatan->headerCellClass() ?>"><div id="elh_t_rkwebinar_tanggal_kegiatan" class="t_rkwebinar_tanggal_kegiatan"><div class="ew-table-header-caption"><?php echo $t_rkwebinar_list->tanggal_kegiatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal_kegiatan" class="<?php echo $t_rkwebinar_list->tanggal_kegiatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rkwebinar_list->SortUrl($t_rkwebinar_list->tanggal_kegiatan) ?>', 1);"><div id="elh_t_rkwebinar_tanggal_kegiatan" class="t_rkwebinar_tanggal_kegiatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rkwebinar_list->tanggal_kegiatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rkwebinar_list->tanggal_kegiatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rkwebinar_list->tanggal_kegiatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rkwebinar_list->tahun->Visible) { // tahun ?>
	<?php if ($t_rkwebinar_list->SortUrl($t_rkwebinar_list->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $t_rkwebinar_list->tahun->headerCellClass() ?>"><div id="elh_t_rkwebinar_tahun" class="t_rkwebinar_tahun"><div class="ew-table-header-caption"><?php echo $t_rkwebinar_list->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $t_rkwebinar_list->tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rkwebinar_list->SortUrl($t_rkwebinar_list->tahun) ?>', 1);"><div id="elh_t_rkwebinar_tahun" class="t_rkwebinar_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rkwebinar_list->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rkwebinar_list->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rkwebinar_list->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_rkwebinar_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_rkwebinar_list->ExportAll && $t_rkwebinar_list->isExport()) {
	$t_rkwebinar_list->StopRecord = $t_rkwebinar_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_rkwebinar_list->TotalRecords > $t_rkwebinar_list->StartRecord + $t_rkwebinar_list->DisplayRecords - 1)
		$t_rkwebinar_list->StopRecord = $t_rkwebinar_list->StartRecord + $t_rkwebinar_list->DisplayRecords - 1;
	else
		$t_rkwebinar_list->StopRecord = $t_rkwebinar_list->TotalRecords;
}
$t_rkwebinar_list->RecordCount = $t_rkwebinar_list->StartRecord - 1;
if ($t_rkwebinar_list->Recordset && !$t_rkwebinar_list->Recordset->EOF) {
	$t_rkwebinar_list->Recordset->moveFirst();
	$selectLimit = $t_rkwebinar_list->UseSelectLimit;
	if (!$selectLimit && $t_rkwebinar_list->StartRecord > 1)
		$t_rkwebinar_list->Recordset->move($t_rkwebinar_list->StartRecord - 1);
} elseif (!$t_rkwebinar->AllowAddDeleteRow && $t_rkwebinar_list->StopRecord == 0) {
	$t_rkwebinar_list->StopRecord = $t_rkwebinar->GridAddRowCount;
}

// Initialize aggregate
$t_rkwebinar->RowType = ROWTYPE_AGGREGATEINIT;
$t_rkwebinar->resetAttributes();
$t_rkwebinar_list->renderRow();
while ($t_rkwebinar_list->RecordCount < $t_rkwebinar_list->StopRecord) {
	$t_rkwebinar_list->RecordCount++;
	if ($t_rkwebinar_list->RecordCount >= $t_rkwebinar_list->StartRecord) {
		$t_rkwebinar_list->RowCount++;

		// Set up key count
		$t_rkwebinar_list->KeyCount = $t_rkwebinar_list->RowIndex;

		// Init row class and style
		$t_rkwebinar->resetAttributes();
		$t_rkwebinar->CssClass = "";
		if ($t_rkwebinar_list->isGridAdd()) {
		} else {
			$t_rkwebinar_list->loadRowValues($t_rkwebinar_list->Recordset); // Load row values
		}
		$t_rkwebinar->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_rkwebinar->RowAttrs->merge(["data-rowindex" => $t_rkwebinar_list->RowCount, "id" => "r" . $t_rkwebinar_list->RowCount . "_t_rkwebinar", "data-rowtype" => $t_rkwebinar->RowType]);

		// Render row
		$t_rkwebinar_list->renderRow();

		// Render list options
		$t_rkwebinar_list->renderListOptions();
?>
	<tr <?php echo $t_rkwebinar->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_rkwebinar_list->ListOptions->render("body", "left", $t_rkwebinar_list->RowCount);
?>
	<?php if ($t_rkwebinar_list->kegiatan->Visible) { // kegiatan ?>
		<td data-name="kegiatan" <?php echo $t_rkwebinar_list->kegiatan->cellAttributes() ?>>
<span id="el<?php echo $t_rkwebinar_list->RowCount ?>_t_rkwebinar_kegiatan">
<span<?php echo $t_rkwebinar_list->kegiatan->viewAttributes() ?>><?php echo $t_rkwebinar_list->kegiatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rkwebinar_list->tanggal_kegiatan->Visible) { // tanggal_kegiatan ?>
		<td data-name="tanggal_kegiatan" <?php echo $t_rkwebinar_list->tanggal_kegiatan->cellAttributes() ?>>
<span id="el<?php echo $t_rkwebinar_list->RowCount ?>_t_rkwebinar_tanggal_kegiatan">
<span<?php echo $t_rkwebinar_list->tanggal_kegiatan->viewAttributes() ?>><?php echo $t_rkwebinar_list->tanggal_kegiatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rkwebinar_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $t_rkwebinar_list->tahun->cellAttributes() ?>>
<span id="el<?php echo $t_rkwebinar_list->RowCount ?>_t_rkwebinar_tahun">
<span<?php echo $t_rkwebinar_list->tahun->viewAttributes() ?>><?php echo $t_rkwebinar_list->tahun->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_rkwebinar_list->ListOptions->render("body", "right", $t_rkwebinar_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_rkwebinar_list->isGridAdd())
		$t_rkwebinar_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_rkwebinar->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_rkwebinar_list->Recordset)
	$t_rkwebinar_list->Recordset->Close();
?>
<?php if (!$t_rkwebinar_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_rkwebinar_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_rkwebinar_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_rkwebinar_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_rkwebinar_list->TotalRecords == 0 && !$t_rkwebinar->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_rkwebinar_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_rkwebinar_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_rkwebinar_list->isExport()) { ?>
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
$t_rkwebinar_list->terminate();
?>