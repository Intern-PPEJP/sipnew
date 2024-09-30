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
$webinar_list = new webinar_list();

// Run the page
$webinar_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$webinar_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$webinar_list->isExport()) { ?>

<script>
var fwebinarlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fwebinarlist = currentForm = new ew.Form("fwebinarlist", "list");
	fwebinarlist.formKeyCountName = '<?php echo $webinar_list->FormKeyCountName ?>';
	loadjs.done("fwebinarlist");
});
var fwebinarlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fwebinarlistsrch = currentSearchForm = new ew.Form("fwebinarlistsrch");

	// Validate function for search
	fwebinarlistsrch.validate = function(fobj) {
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
	fwebinarlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fwebinarlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fwebinarlistsrch.lists["x_tahun"] = <?php echo $webinar_list->tahun->Lookup->toClientList($webinar_list) ?>;
	fwebinarlistsrch.lists["x_tahun"].options = <?php echo JsonEncode($webinar_list->tahun->lookupOptions()) ?>;

	// Filters
	fwebinarlistsrch.filterList = <?php echo $webinar_list->getFilterList() ?>;
	loadjs.done("fwebinarlistsrch");
});
</script>

<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$webinar_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($webinar_list->TotalRecords > 0 && $webinar_list->ExportOptions->visible()) { ?>
<?php $webinar_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($webinar_list->ImportOptions->visible()) { ?>
<?php $webinar_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($webinar_list->SearchOptions->visible()) { ?>
<?php $webinar_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($webinar_list->FilterOptions->visible()) { ?>
<?php $webinar_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>

<?php
$webinar_list->renderOtherOptions();
?>

<?php if ($Security->CanSearch()) { ?>
<?php if (!$webinar_list->isExport() && !$webinar->CurrentAction) { ?>
<form name="fwebinarlistsrch" id="fwebinarlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fwebinarlistsrch-search-panel" class="<?php echo $webinar_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="webinar">
	<div class="ew-extended-search">
<?php

// Render search row
$webinar->RowType = ROWTYPE_SEARCH;
$webinar->resetAttributes();
$webinar_list->renderRow();
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
	text-transform: uppercase;
}

.ew-search-field input,
.ew-search-field select {
    width: 300px; /* Atur lebar input dan select agar seragam */
}

.input-group .custom-select {
    width: 150px; /* Atur lebar select di dalam input-group */
}

</style>


<?php if ($webinar_list->tahun->Visible) { // tahun ?>
	<?php
		$webinar_list->SearchColumnCount++;
		if (($webinar_list->SearchColumnCount - 1) % $webinar_list->SearchFieldsPerRow == 0) {
			$webinar_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $webinar_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_tahun" class="ew-cell form-group">
		<label for="x_tahun" class="ew-search-caption ew-label"><?php echo $webinar_list->tahun->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tahun" id="z_tahun" value="=">
</span>
		<span id="el_webinar_tahun" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="webinar" data-field="x_tahun" data-value-separator="<?php echo $webinar_list->tahun->displayValueSeparatorAttribute() ?>" id="x_tahun" name="x_tahun"<?php echo $webinar_list->tahun->editAttributes() ?>>
			<?php echo $webinar_list->tahun->selectOptionListHtml("x_tahun") ?>
		</select>
</div>
<?php echo $webinar_list->tahun->Lookup->getParamTag($webinar_list, "p_x_tahun") ?>
</span>
	</div>
	<?php if ($webinar_list->SearchColumnCount % $webinar_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($webinar_list->SearchColumnCount % $webinar_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $webinar_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $webinar_list->showPageHeader(); ?>
<?php
$webinar_list->showMessage();
?>
<?php if ($webinar_list->TotalRecords > 0 || $webinar->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($webinar_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> webinar">
<?php if (!$webinar_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$webinar_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $webinar_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $webinar_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fwebinarlist" id="fwebinarlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="webinar">
<div id="gmp_webinar" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($webinar_list->TotalRecords > 0 || $webinar_list->isGridEdit()) { ?>
<table id="tbl_webinarlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$webinar->RowType = ROWTYPE_HEADER;

// Render list options
$webinar_list->renderListOptions();

// Render list options (header, left)
$webinar_list->ListOptions->render("header", "left");
?>
<?php if ($webinar_list->rkwid->Visible) { // rkwid ?>
	<?php if ($webinar_list->SortUrl($webinar_list->rkwid) == "") { ?>
		<th data-name="rkwid" class="<?php echo $webinar_list->rkwid->headerCellClass() ?>"><div id="elh_webinar_rkwid" class="webinar_rkwid"><div class="ew-table-header-caption"><?php echo $webinar_list->rkwid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rkwid" class="<?php echo $webinar_list->rkwid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $webinar_list->SortUrl($webinar_list->rkwid) ?>', 1);"><div id="elh_webinar_rkwid" class="webinar_rkwid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $webinar_list->rkwid->caption() ?></span><span class="ew-table-header-sort"><?php if ($webinar_list->rkwid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($webinar_list->rkwid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($webinar_list->kegiatan->Visible) { // kegiatan ?>
	<?php if ($webinar_list->SortUrl($webinar_list->kegiatan) == "") { ?>
		<th data-name="kegiatan" class="<?php echo $webinar_list->kegiatan->headerCellClass() ?>"><div id="elh_webinar_kegiatan" class="webinar_kegiatan"><div class="ew-table-header-caption"><?php echo $webinar_list->kegiatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kegiatan" class="<?php echo $webinar_list->kegiatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $webinar_list->SortUrl($webinar_list->kegiatan) ?>', 1);"><div id="elh_webinar_kegiatan" class="webinar_kegiatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $webinar_list->kegiatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($webinar_list->kegiatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($webinar_list->kegiatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($webinar_list->tanggal_kegiatan->Visible) { // tanggal_kegiatan ?>
	<?php if ($webinar_list->SortUrl($webinar_list->tanggal_kegiatan) == "") { ?>
		<th data-name="tanggal_kegiatan" class="<?php echo $webinar_list->tanggal_kegiatan->headerCellClass() ?>"><div id="elh_webinar_tanggal_kegiatan" class="webinar_tanggal_kegiatan"><div class="ew-table-header-caption"><?php echo $webinar_list->tanggal_kegiatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal_kegiatan" class="<?php echo $webinar_list->tanggal_kegiatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $webinar_list->SortUrl($webinar_list->tanggal_kegiatan) ?>', 1);"><div id="elh_webinar_tanggal_kegiatan" class="webinar_tanggal_kegiatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $webinar_list->tanggal_kegiatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($webinar_list->tanggal_kegiatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($webinar_list->tanggal_kegiatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($webinar_list->tahun->Visible) { // tahun ?>
	<?php if ($webinar_list->SortUrl($webinar_list->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $webinar_list->tahun->headerCellClass() ?>"><div id="elh_webinar_tahun" class="webinar_tahun"><div class="ew-table-header-caption"><?php echo $webinar_list->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $webinar_list->tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $webinar_list->SortUrl($webinar_list->tahun) ?>', 1);"><div id="elh_webinar_tahun" class="webinar_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $webinar_list->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($webinar_list->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($webinar_list->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$webinar_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($webinar_list->ExportAll && $webinar_list->isExport()) {
	$webinar_list->StopRecord = $webinar_list->TotalRecords;
} else {

	// Set the last record to display
	if ($webinar_list->TotalRecords > $webinar_list->StartRecord + $webinar_list->DisplayRecords - 1)
		$webinar_list->StopRecord = $webinar_list->StartRecord + $webinar_list->DisplayRecords - 1;
	else
		$webinar_list->StopRecord = $webinar_list->TotalRecords;
}
$webinar_list->RecordCount = $webinar_list->StartRecord - 1;
if ($webinar_list->Recordset && !$webinar_list->Recordset->EOF) {
	$webinar_list->Recordset->moveFirst();
	$selectLimit = $webinar_list->UseSelectLimit;
	if (!$selectLimit && $webinar_list->StartRecord > 1)
		$webinar_list->Recordset->move($webinar_list->StartRecord - 1);
} elseif (!$webinar->AllowAddDeleteRow && $webinar_list->StopRecord == 0) {
	$webinar_list->StopRecord = $webinar->GridAddRowCount;
}

// Initialize aggregate
$webinar->RowType = ROWTYPE_AGGREGATEINIT;
$webinar->resetAttributes();
$webinar_list->renderRow();
while ($webinar_list->RecordCount < $webinar_list->StopRecord) {
	$webinar_list->RecordCount++;
	if ($webinar_list->RecordCount >= $webinar_list->StartRecord) {
		$webinar_list->RowCount++;

		// Set up key count
		$webinar_list->KeyCount = $webinar_list->RowIndex;

		// Init row class and style
		$webinar->resetAttributes();
		$webinar->CssClass = "";
		if ($webinar_list->isGridAdd()) {
		} else {
			$webinar_list->loadRowValues($webinar_list->Recordset); // Load row values
		}
		$webinar->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$webinar->RowAttrs->merge(["data-rowindex" => $webinar_list->RowCount, "id" => "r" . $webinar_list->RowCount . "_webinar", "data-rowtype" => $webinar->RowType]);

		// Render row
		$webinar_list->renderRow();

		// Render list options
		$webinar_list->renderListOptions();
?>
	<tr <?php echo $webinar->rowAttributes() ?>>
<?php

// Render list options (body, left)
$webinar_list->ListOptions->render("body", "left", $webinar_list->RowCount);
?>
	<?php if ($webinar_list->rkwid->Visible) { // rkwid ?>
		<td data-name="rkwid" <?php echo $webinar_list->rkwid->cellAttributes() ?>>
<span id="el<?php echo $webinar_list->RowCount ?>_webinar_rkwid">
<span<?php echo $webinar_list->rkwid->viewAttributes() ?>><?php echo $webinar_list->rkwid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($webinar_list->kegiatan->Visible) { // kegiatan ?>
		<td data-name="kegiatan" <?php echo $webinar_list->kegiatan->cellAttributes() ?>>
<span id="el<?php echo $webinar_list->RowCount ?>_webinar_kegiatan">
<span<?php echo $webinar_list->kegiatan->viewAttributes() ?>><?php echo $webinar_list->kegiatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($webinar_list->tanggal_kegiatan->Visible) { // tanggal_kegiatan ?>
		<td data-name="tanggal_kegiatan" <?php echo $webinar_list->tanggal_kegiatan->cellAttributes() ?>>
<span id="el<?php echo $webinar_list->RowCount ?>_webinar_tanggal_kegiatan">
<span<?php echo $webinar_list->tanggal_kegiatan->viewAttributes() ?>><?php echo $webinar_list->tanggal_kegiatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($webinar_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $webinar_list->tahun->cellAttributes() ?>>
<span id="el<?php echo $webinar_list->RowCount ?>_webinar_tahun">
<span<?php echo $webinar_list->tahun->viewAttributes() ?>><?php echo $webinar_list->tahun->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$webinar_list->ListOptions->render("body", "right", $webinar_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$webinar_list->isGridAdd())
		$webinar_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$webinar->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($webinar_list->Recordset)
	$webinar_list->Recordset->Close();
?>
<?php if (!$webinar_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$webinar_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $webinar_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $webinar_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($webinar_list->TotalRecords == 0 && !$webinar->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $webinar_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$webinar_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$webinar_list->isExport()) { ?>
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
$webinar_list->terminate();
?>