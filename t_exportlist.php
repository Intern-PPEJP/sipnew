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
$t_export_list = new t_export_list();

// Run the page
$t_export_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_export_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_export_list->isExport()) { ?>
<script>
var ft_exportlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_exportlist = currentForm = new ew.Form("ft_exportlist", "list");
	ft_exportlist.formKeyCountName = '<?php echo $t_export_list->FormKeyCountName ?>';
	loadjs.done("ft_exportlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_export_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_export_list->TotalRecords > 0 && $t_export_list->ExportOptions->visible()) { ?>
<?php $t_export_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_export_list->ImportOptions->visible()) { ?>
<?php $t_export_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_export_list->renderOtherOptions();
?>
<?php $t_export_list->showPageHeader(); ?>
<?php
$t_export_list->showMessage();
?>
<?php if ($t_export_list->TotalRecords > 0 || $t_export->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_export_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_export">
<?php if (!$t_export_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_export_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_export_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_export_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_exportlist" id="ft_exportlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_export">
<div id="gmp_t_export" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_export_list->TotalRecords > 0 || $t_export_list->isGridEdit()) { ?>
<table id="tbl_t_exportlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_export->RowType = ROWTYPE_HEADER;

// Render list options
$t_export_list->renderListOptions();

// Render list options (header, left)
$t_export_list->ListOptions->render("header", "left");
?>
<?php if ($t_export_list->kdexport->Visible) { // kdexport ?>
	<?php if ($t_export_list->SortUrl($t_export_list->kdexport) == "") { ?>
		<th data-name="kdexport" class="<?php echo $t_export_list->kdexport->headerCellClass() ?>"><div id="elh_t_export_kdexport" class="t_export_kdexport"><div class="ew-table-header-caption"><?php echo $t_export_list->kdexport->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdexport" class="<?php echo $t_export_list->kdexport->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_export_list->SortUrl($t_export_list->kdexport) ?>', 1);"><div id="elh_t_export_kdexport" class="t_export_kdexport">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_export_list->kdexport->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_export_list->kdexport->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_export_list->kdexport->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_export_list->_export->Visible) { // export ?>
	<?php if ($t_export_list->SortUrl($t_export_list->_export) == "") { ?>
		<th data-name="_export" class="<?php echo $t_export_list->_export->headerCellClass() ?>"><div id="elh_t_export__export" class="t_export__export"><div class="ew-table-header-caption"><?php echo $t_export_list->_export->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_export" class="<?php echo $t_export_list->_export->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_export_list->SortUrl($t_export_list->_export) ?>', 1);"><div id="elh_t_export__export" class="t_export__export">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_export_list->_export->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_export_list->_export->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_export_list->_export->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_export_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_export_list->ExportAll && $t_export_list->isExport()) {
	$t_export_list->StopRecord = $t_export_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_export_list->TotalRecords > $t_export_list->StartRecord + $t_export_list->DisplayRecords - 1)
		$t_export_list->StopRecord = $t_export_list->StartRecord + $t_export_list->DisplayRecords - 1;
	else
		$t_export_list->StopRecord = $t_export_list->TotalRecords;
}
$t_export_list->RecordCount = $t_export_list->StartRecord - 1;
if ($t_export_list->Recordset && !$t_export_list->Recordset->EOF) {
	$t_export_list->Recordset->moveFirst();
	$selectLimit = $t_export_list->UseSelectLimit;
	if (!$selectLimit && $t_export_list->StartRecord > 1)
		$t_export_list->Recordset->move($t_export_list->StartRecord - 1);
} elseif (!$t_export->AllowAddDeleteRow && $t_export_list->StopRecord == 0) {
	$t_export_list->StopRecord = $t_export->GridAddRowCount;
}

// Initialize aggregate
$t_export->RowType = ROWTYPE_AGGREGATEINIT;
$t_export->resetAttributes();
$t_export_list->renderRow();
while ($t_export_list->RecordCount < $t_export_list->StopRecord) {
	$t_export_list->RecordCount++;
	if ($t_export_list->RecordCount >= $t_export_list->StartRecord) {
		$t_export_list->RowCount++;

		// Set up key count
		$t_export_list->KeyCount = $t_export_list->RowIndex;

		// Init row class and style
		$t_export->resetAttributes();
		$t_export->CssClass = "";
		if ($t_export_list->isGridAdd()) {
		} else {
			$t_export_list->loadRowValues($t_export_list->Recordset); // Load row values
		}
		$t_export->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_export->RowAttrs->merge(["data-rowindex" => $t_export_list->RowCount, "id" => "r" . $t_export_list->RowCount . "_t_export", "data-rowtype" => $t_export->RowType]);

		// Render row
		$t_export_list->renderRow();

		// Render list options
		$t_export_list->renderListOptions();
?>
	<tr <?php echo $t_export->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_export_list->ListOptions->render("body", "left", $t_export_list->RowCount);
?>
	<?php if ($t_export_list->kdexport->Visible) { // kdexport ?>
		<td data-name="kdexport" <?php echo $t_export_list->kdexport->cellAttributes() ?>>
<span id="el<?php echo $t_export_list->RowCount ?>_t_export_kdexport">
<span<?php echo $t_export_list->kdexport->viewAttributes() ?>><?php echo $t_export_list->kdexport->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_export_list->_export->Visible) { // export ?>
		<td data-name="_export" <?php echo $t_export_list->_export->cellAttributes() ?>>
<span id="el<?php echo $t_export_list->RowCount ?>_t_export__export">
<span<?php echo $t_export_list->_export->viewAttributes() ?>><?php echo $t_export_list->_export->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_export_list->ListOptions->render("body", "right", $t_export_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_export_list->isGridAdd())
		$t_export_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_export->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_export_list->Recordset)
	$t_export_list->Recordset->Close();
?>
<?php if (!$t_export_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_export_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_export_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_export_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_export_list->TotalRecords == 0 && !$t_export->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_export_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_export_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_export_list->isExport()) { ?>
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
$t_export_list->terminate();
?>