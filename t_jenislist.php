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
$t_jenis_list = new t_jenis_list();

// Run the page
$t_jenis_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_jenis_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_jenis_list->isExport()) { ?>
<script>
var ft_jenislist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_jenislist = currentForm = new ew.Form("ft_jenislist", "list");
	ft_jenislist.formKeyCountName = '<?php echo $t_jenis_list->FormKeyCountName ?>';
	loadjs.done("ft_jenislist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_jenis_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_jenis_list->TotalRecords > 0 && $t_jenis_list->ExportOptions->visible()) { ?>
<?php $t_jenis_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_jenis_list->ImportOptions->visible()) { ?>
<?php $t_jenis_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_jenis_list->renderOtherOptions();
?>
<?php $t_jenis_list->showPageHeader(); ?>
<?php
$t_jenis_list->showMessage();
?>
<?php if ($t_jenis_list->TotalRecords > 0 || $t_jenis->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_jenis_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_jenis">
<?php if (!$t_jenis_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_jenis_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_jenis_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_jenis_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_jenislist" id="ft_jenislist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_jenis">
<div id="gmp_t_jenis" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_jenis_list->TotalRecords > 0 || $t_jenis_list->isGridEdit()) { ?>
<table id="tbl_t_jenislist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_jenis->RowType = ROWTYPE_HEADER;

// Render list options
$t_jenis_list->renderListOptions();

// Render list options (header, left)
$t_jenis_list->ListOptions->render("header", "left");
?>
<?php if ($t_jenis_list->kdjenis->Visible) { // kdjenis ?>
	<?php if ($t_jenis_list->SortUrl($t_jenis_list->kdjenis) == "") { ?>
		<th data-name="kdjenis" class="<?php echo $t_jenis_list->kdjenis->headerCellClass() ?>"><div id="elh_t_jenis_kdjenis" class="t_jenis_kdjenis"><div class="ew-table-header-caption"><?php echo $t_jenis_list->kdjenis->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjenis" class="<?php echo $t_jenis_list->kdjenis->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jenis_list->SortUrl($t_jenis_list->kdjenis) ?>', 1);"><div id="elh_t_jenis_kdjenis" class="t_jenis_kdjenis">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jenis_list->kdjenis->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jenis_list->kdjenis->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jenis_list->kdjenis->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jenis_list->jenis->Visible) { // jenis ?>
	<?php if ($t_jenis_list->SortUrl($t_jenis_list->jenis) == "") { ?>
		<th data-name="jenis" class="<?php echo $t_jenis_list->jenis->headerCellClass() ?>"><div id="elh_t_jenis_jenis" class="t_jenis_jenis"><div class="ew-table-header-caption"><?php echo $t_jenis_list->jenis->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis" class="<?php echo $t_jenis_list->jenis->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jenis_list->SortUrl($t_jenis_list->jenis) ?>', 1);"><div id="elh_t_jenis_jenis" class="t_jenis_jenis">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jenis_list->jenis->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jenis_list->jenis->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jenis_list->jenis->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_jenis_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_jenis_list->ExportAll && $t_jenis_list->isExport()) {
	$t_jenis_list->StopRecord = $t_jenis_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_jenis_list->TotalRecords > $t_jenis_list->StartRecord + $t_jenis_list->DisplayRecords - 1)
		$t_jenis_list->StopRecord = $t_jenis_list->StartRecord + $t_jenis_list->DisplayRecords - 1;
	else
		$t_jenis_list->StopRecord = $t_jenis_list->TotalRecords;
}
$t_jenis_list->RecordCount = $t_jenis_list->StartRecord - 1;
if ($t_jenis_list->Recordset && !$t_jenis_list->Recordset->EOF) {
	$t_jenis_list->Recordset->moveFirst();
	$selectLimit = $t_jenis_list->UseSelectLimit;
	if (!$selectLimit && $t_jenis_list->StartRecord > 1)
		$t_jenis_list->Recordset->move($t_jenis_list->StartRecord - 1);
} elseif (!$t_jenis->AllowAddDeleteRow && $t_jenis_list->StopRecord == 0) {
	$t_jenis_list->StopRecord = $t_jenis->GridAddRowCount;
}

// Initialize aggregate
$t_jenis->RowType = ROWTYPE_AGGREGATEINIT;
$t_jenis->resetAttributes();
$t_jenis_list->renderRow();
while ($t_jenis_list->RecordCount < $t_jenis_list->StopRecord) {
	$t_jenis_list->RecordCount++;
	if ($t_jenis_list->RecordCount >= $t_jenis_list->StartRecord) {
		$t_jenis_list->RowCount++;

		// Set up key count
		$t_jenis_list->KeyCount = $t_jenis_list->RowIndex;

		// Init row class and style
		$t_jenis->resetAttributes();
		$t_jenis->CssClass = "";
		if ($t_jenis_list->isGridAdd()) {
		} else {
			$t_jenis_list->loadRowValues($t_jenis_list->Recordset); // Load row values
		}
		$t_jenis->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_jenis->RowAttrs->merge(["data-rowindex" => $t_jenis_list->RowCount, "id" => "r" . $t_jenis_list->RowCount . "_t_jenis", "data-rowtype" => $t_jenis->RowType]);

		// Render row
		$t_jenis_list->renderRow();

		// Render list options
		$t_jenis_list->renderListOptions();
?>
	<tr <?php echo $t_jenis->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_jenis_list->ListOptions->render("body", "left", $t_jenis_list->RowCount);
?>
	<?php if ($t_jenis_list->kdjenis->Visible) { // kdjenis ?>
		<td data-name="kdjenis" <?php echo $t_jenis_list->kdjenis->cellAttributes() ?>>
<span id="el<?php echo $t_jenis_list->RowCount ?>_t_jenis_kdjenis">
<span<?php echo $t_jenis_list->kdjenis->viewAttributes() ?>><?php echo $t_jenis_list->kdjenis->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_jenis_list->jenis->Visible) { // jenis ?>
		<td data-name="jenis" <?php echo $t_jenis_list->jenis->cellAttributes() ?>>
<span id="el<?php echo $t_jenis_list->RowCount ?>_t_jenis_jenis">
<span<?php echo $t_jenis_list->jenis->viewAttributes() ?>><?php echo $t_jenis_list->jenis->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_jenis_list->ListOptions->render("body", "right", $t_jenis_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_jenis_list->isGridAdd())
		$t_jenis_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_jenis->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_jenis_list->Recordset)
	$t_jenis_list->Recordset->Close();
?>
<?php if (!$t_jenis_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_jenis_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_jenis_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_jenis_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_jenis_list->TotalRecords == 0 && !$t_jenis->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_jenis_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_jenis_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_jenis_list->isExport()) { ?>
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
$t_jenis_list->terminate();
?>