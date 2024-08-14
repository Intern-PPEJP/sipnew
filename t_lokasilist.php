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
$t_lokasi_list = new t_lokasi_list();

// Run the page
$t_lokasi_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_lokasi_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_lokasi_list->isExport()) { ?>
<script>
var ft_lokasilist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_lokasilist = currentForm = new ew.Form("ft_lokasilist", "list");
	ft_lokasilist.formKeyCountName = '<?php echo $t_lokasi_list->FormKeyCountName ?>';
	loadjs.done("ft_lokasilist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_lokasi_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_lokasi_list->TotalRecords > 0 && $t_lokasi_list->ExportOptions->visible()) { ?>
<?php $t_lokasi_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_lokasi_list->ImportOptions->visible()) { ?>
<?php $t_lokasi_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_lokasi_list->renderOtherOptions();
?>
<?php $t_lokasi_list->showPageHeader(); ?>
<?php
$t_lokasi_list->showMessage();
?>
<?php if ($t_lokasi_list->TotalRecords > 0 || $t_lokasi->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_lokasi_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_lokasi">
<?php if (!$t_lokasi_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_lokasi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_lokasi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_lokasi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_lokasilist" id="ft_lokasilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_lokasi">
<div id="gmp_t_lokasi" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_lokasi_list->TotalRecords > 0 || $t_lokasi_list->isGridEdit()) { ?>
<table id="tbl_t_lokasilist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_lokasi->RowType = ROWTYPE_HEADER;

// Render list options
$t_lokasi_list->renderListOptions();

// Render list options (header, left)
$t_lokasi_list->ListOptions->render("header", "left");
?>
<?php if ($t_lokasi_list->kdlokasi->Visible) { // kdlokasi ?>
	<?php if ($t_lokasi_list->SortUrl($t_lokasi_list->kdlokasi) == "") { ?>
		<th data-name="kdlokasi" class="<?php echo $t_lokasi_list->kdlokasi->headerCellClass() ?>"><div id="elh_t_lokasi_kdlokasi" class="t_lokasi_kdlokasi"><div class="ew-table-header-caption"><?php echo $t_lokasi_list->kdlokasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdlokasi" class="<?php echo $t_lokasi_list->kdlokasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_lokasi_list->SortUrl($t_lokasi_list->kdlokasi) ?>', 1);"><div id="elh_t_lokasi_kdlokasi" class="t_lokasi_kdlokasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_lokasi_list->kdlokasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_lokasi_list->kdlokasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_lokasi_list->kdlokasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_lokasi_list->lokasi->Visible) { // lokasi ?>
	<?php if ($t_lokasi_list->SortUrl($t_lokasi_list->lokasi) == "") { ?>
		<th data-name="lokasi" class="<?php echo $t_lokasi_list->lokasi->headerCellClass() ?>"><div id="elh_t_lokasi_lokasi" class="t_lokasi_lokasi"><div class="ew-table-header-caption"><?php echo $t_lokasi_list->lokasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lokasi" class="<?php echo $t_lokasi_list->lokasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_lokasi_list->SortUrl($t_lokasi_list->lokasi) ?>', 1);"><div id="elh_t_lokasi_lokasi" class="t_lokasi_lokasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_lokasi_list->lokasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_lokasi_list->lokasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_lokasi_list->lokasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_lokasi_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_lokasi_list->ExportAll && $t_lokasi_list->isExport()) {
	$t_lokasi_list->StopRecord = $t_lokasi_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_lokasi_list->TotalRecords > $t_lokasi_list->StartRecord + $t_lokasi_list->DisplayRecords - 1)
		$t_lokasi_list->StopRecord = $t_lokasi_list->StartRecord + $t_lokasi_list->DisplayRecords - 1;
	else
		$t_lokasi_list->StopRecord = $t_lokasi_list->TotalRecords;
}
$t_lokasi_list->RecordCount = $t_lokasi_list->StartRecord - 1;
if ($t_lokasi_list->Recordset && !$t_lokasi_list->Recordset->EOF) {
	$t_lokasi_list->Recordset->moveFirst();
	$selectLimit = $t_lokasi_list->UseSelectLimit;
	if (!$selectLimit && $t_lokasi_list->StartRecord > 1)
		$t_lokasi_list->Recordset->move($t_lokasi_list->StartRecord - 1);
} elseif (!$t_lokasi->AllowAddDeleteRow && $t_lokasi_list->StopRecord == 0) {
	$t_lokasi_list->StopRecord = $t_lokasi->GridAddRowCount;
}

// Initialize aggregate
$t_lokasi->RowType = ROWTYPE_AGGREGATEINIT;
$t_lokasi->resetAttributes();
$t_lokasi_list->renderRow();
while ($t_lokasi_list->RecordCount < $t_lokasi_list->StopRecord) {
	$t_lokasi_list->RecordCount++;
	if ($t_lokasi_list->RecordCount >= $t_lokasi_list->StartRecord) {
		$t_lokasi_list->RowCount++;

		// Set up key count
		$t_lokasi_list->KeyCount = $t_lokasi_list->RowIndex;

		// Init row class and style
		$t_lokasi->resetAttributes();
		$t_lokasi->CssClass = "";
		if ($t_lokasi_list->isGridAdd()) {
		} else {
			$t_lokasi_list->loadRowValues($t_lokasi_list->Recordset); // Load row values
		}
		$t_lokasi->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_lokasi->RowAttrs->merge(["data-rowindex" => $t_lokasi_list->RowCount, "id" => "r" . $t_lokasi_list->RowCount . "_t_lokasi", "data-rowtype" => $t_lokasi->RowType]);

		// Render row
		$t_lokasi_list->renderRow();

		// Render list options
		$t_lokasi_list->renderListOptions();
?>
	<tr <?php echo $t_lokasi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_lokasi_list->ListOptions->render("body", "left", $t_lokasi_list->RowCount);
?>
	<?php if ($t_lokasi_list->kdlokasi->Visible) { // kdlokasi ?>
		<td data-name="kdlokasi" <?php echo $t_lokasi_list->kdlokasi->cellAttributes() ?>>
<span id="el<?php echo $t_lokasi_list->RowCount ?>_t_lokasi_kdlokasi">
<span<?php echo $t_lokasi_list->kdlokasi->viewAttributes() ?>><?php echo $t_lokasi_list->kdlokasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_lokasi_list->lokasi->Visible) { // lokasi ?>
		<td data-name="lokasi" <?php echo $t_lokasi_list->lokasi->cellAttributes() ?>>
<span id="el<?php echo $t_lokasi_list->RowCount ?>_t_lokasi_lokasi">
<span<?php echo $t_lokasi_list->lokasi->viewAttributes() ?>><?php echo $t_lokasi_list->lokasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_lokasi_list->ListOptions->render("body", "right", $t_lokasi_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_lokasi_list->isGridAdd())
		$t_lokasi_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_lokasi->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_lokasi_list->Recordset)
	$t_lokasi_list->Recordset->Close();
?>
<?php if (!$t_lokasi_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_lokasi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_lokasi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_lokasi_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_lokasi_list->TotalRecords == 0 && !$t_lokasi->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_lokasi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_lokasi_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_lokasi_list->isExport()) { ?>
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
$t_lokasi_list->terminate();
?>