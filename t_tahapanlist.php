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
$t_tahapan_list = new t_tahapan_list();

// Run the page
$t_tahapan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_tahapan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_tahapan_list->isExport()) { ?>
<script>
var ft_tahapanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_tahapanlist = currentForm = new ew.Form("ft_tahapanlist", "list");
	ft_tahapanlist.formKeyCountName = '<?php echo $t_tahapan_list->FormKeyCountName ?>';
	loadjs.done("ft_tahapanlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_tahapan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_tahapan_list->TotalRecords > 0 && $t_tahapan_list->ExportOptions->visible()) { ?>
<?php $t_tahapan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_tahapan_list->ImportOptions->visible()) { ?>
<?php $t_tahapan_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_tahapan_list->renderOtherOptions();
?>
<?php $t_tahapan_list->showPageHeader(); ?>
<?php
$t_tahapan_list->showMessage();
?>
<?php if ($t_tahapan_list->TotalRecords > 0 || $t_tahapan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_tahapan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_tahapan">
<?php if (!$t_tahapan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_tahapan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_tahapan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_tahapan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_tahapanlist" id="ft_tahapanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_tahapan">
<div id="gmp_t_tahapan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_tahapan_list->TotalRecords > 0 || $t_tahapan_list->isGridEdit()) { ?>
<table id="tbl_t_tahapanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_tahapan->RowType = ROWTYPE_HEADER;

// Render list options
$t_tahapan_list->renderListOptions();

// Render list options (header, left)
$t_tahapan_list->ListOptions->render("header", "left");
?>
<?php if ($t_tahapan_list->kdtahapan->Visible) { // kdtahapan ?>
	<?php if ($t_tahapan_list->SortUrl($t_tahapan_list->kdtahapan) == "") { ?>
		<th data-name="kdtahapan" class="<?php echo $t_tahapan_list->kdtahapan->headerCellClass() ?>"><div id="elh_t_tahapan_kdtahapan" class="t_tahapan_kdtahapan"><div class="ew-table-header-caption"><?php echo $t_tahapan_list->kdtahapan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdtahapan" class="<?php echo $t_tahapan_list->kdtahapan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_tahapan_list->SortUrl($t_tahapan_list->kdtahapan) ?>', 1);"><div id="elh_t_tahapan_kdtahapan" class="t_tahapan_kdtahapan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_tahapan_list->kdtahapan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_tahapan_list->kdtahapan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_tahapan_list->kdtahapan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_tahapan_list->Tahapan->Visible) { // Tahapan ?>
	<?php if ($t_tahapan_list->SortUrl($t_tahapan_list->Tahapan) == "") { ?>
		<th data-name="Tahapan" class="<?php echo $t_tahapan_list->Tahapan->headerCellClass() ?>"><div id="elh_t_tahapan_Tahapan" class="t_tahapan_Tahapan"><div class="ew-table-header-caption"><?php echo $t_tahapan_list->Tahapan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tahapan" class="<?php echo $t_tahapan_list->Tahapan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_tahapan_list->SortUrl($t_tahapan_list->Tahapan) ?>', 1);"><div id="elh_t_tahapan_Tahapan" class="t_tahapan_Tahapan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_tahapan_list->Tahapan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_tahapan_list->Tahapan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_tahapan_list->Tahapan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_tahapan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_tahapan_list->ExportAll && $t_tahapan_list->isExport()) {
	$t_tahapan_list->StopRecord = $t_tahapan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_tahapan_list->TotalRecords > $t_tahapan_list->StartRecord + $t_tahapan_list->DisplayRecords - 1)
		$t_tahapan_list->StopRecord = $t_tahapan_list->StartRecord + $t_tahapan_list->DisplayRecords - 1;
	else
		$t_tahapan_list->StopRecord = $t_tahapan_list->TotalRecords;
}
$t_tahapan_list->RecordCount = $t_tahapan_list->StartRecord - 1;
if ($t_tahapan_list->Recordset && !$t_tahapan_list->Recordset->EOF) {
	$t_tahapan_list->Recordset->moveFirst();
	$selectLimit = $t_tahapan_list->UseSelectLimit;
	if (!$selectLimit && $t_tahapan_list->StartRecord > 1)
		$t_tahapan_list->Recordset->move($t_tahapan_list->StartRecord - 1);
} elseif (!$t_tahapan->AllowAddDeleteRow && $t_tahapan_list->StopRecord == 0) {
	$t_tahapan_list->StopRecord = $t_tahapan->GridAddRowCount;
}

// Initialize aggregate
$t_tahapan->RowType = ROWTYPE_AGGREGATEINIT;
$t_tahapan->resetAttributes();
$t_tahapan_list->renderRow();
while ($t_tahapan_list->RecordCount < $t_tahapan_list->StopRecord) {
	$t_tahapan_list->RecordCount++;
	if ($t_tahapan_list->RecordCount >= $t_tahapan_list->StartRecord) {
		$t_tahapan_list->RowCount++;

		// Set up key count
		$t_tahapan_list->KeyCount = $t_tahapan_list->RowIndex;

		// Init row class and style
		$t_tahapan->resetAttributes();
		$t_tahapan->CssClass = "";
		if ($t_tahapan_list->isGridAdd()) {
		} else {
			$t_tahapan_list->loadRowValues($t_tahapan_list->Recordset); // Load row values
		}
		$t_tahapan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_tahapan->RowAttrs->merge(["data-rowindex" => $t_tahapan_list->RowCount, "id" => "r" . $t_tahapan_list->RowCount . "_t_tahapan", "data-rowtype" => $t_tahapan->RowType]);

		// Render row
		$t_tahapan_list->renderRow();

		// Render list options
		$t_tahapan_list->renderListOptions();
?>
	<tr <?php echo $t_tahapan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_tahapan_list->ListOptions->render("body", "left", $t_tahapan_list->RowCount);
?>
	<?php if ($t_tahapan_list->kdtahapan->Visible) { // kdtahapan ?>
		<td data-name="kdtahapan" <?php echo $t_tahapan_list->kdtahapan->cellAttributes() ?>>
<span id="el<?php echo $t_tahapan_list->RowCount ?>_t_tahapan_kdtahapan">
<span<?php echo $t_tahapan_list->kdtahapan->viewAttributes() ?>><?php echo $t_tahapan_list->kdtahapan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_tahapan_list->Tahapan->Visible) { // Tahapan ?>
		<td data-name="Tahapan" <?php echo $t_tahapan_list->Tahapan->cellAttributes() ?>>
<span id="el<?php echo $t_tahapan_list->RowCount ?>_t_tahapan_Tahapan">
<span<?php echo $t_tahapan_list->Tahapan->viewAttributes() ?>><?php echo $t_tahapan_list->Tahapan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_tahapan_list->ListOptions->render("body", "right", $t_tahapan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_tahapan_list->isGridAdd())
		$t_tahapan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_tahapan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_tahapan_list->Recordset)
	$t_tahapan_list->Recordset->Close();
?>
<?php if (!$t_tahapan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_tahapan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_tahapan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_tahapan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_tahapan_list->TotalRecords == 0 && !$t_tahapan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_tahapan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_tahapan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_tahapan_list->isExport()) { ?>
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
$t_tahapan_list->terminate();
?>