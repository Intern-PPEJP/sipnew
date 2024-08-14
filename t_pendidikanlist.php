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
$t_pendidikan_list = new t_pendidikan_list();

// Run the page
$t_pendidikan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pendidikan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_pendidikan_list->isExport()) { ?>
<script>
var ft_pendidikanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_pendidikanlist = currentForm = new ew.Form("ft_pendidikanlist", "list");
	ft_pendidikanlist.formKeyCountName = '<?php echo $t_pendidikan_list->FormKeyCountName ?>';
	loadjs.done("ft_pendidikanlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_pendidikan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_pendidikan_list->TotalRecords > 0 && $t_pendidikan_list->ExportOptions->visible()) { ?>
<?php $t_pendidikan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_pendidikan_list->ImportOptions->visible()) { ?>
<?php $t_pendidikan_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_pendidikan_list->renderOtherOptions();
?>
<?php $t_pendidikan_list->showPageHeader(); ?>
<?php
$t_pendidikan_list->showMessage();
?>
<?php if ($t_pendidikan_list->TotalRecords > 0 || $t_pendidikan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_pendidikan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_pendidikan">
<?php if (!$t_pendidikan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_pendidikan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_pendidikan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_pendidikan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_pendidikanlist" id="ft_pendidikanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_pendidikan">
<div id="gmp_t_pendidikan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_pendidikan_list->TotalRecords > 0 || $t_pendidikan_list->isGridEdit()) { ?>
<table id="tbl_t_pendidikanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_pendidikan->RowType = ROWTYPE_HEADER;

// Render list options
$t_pendidikan_list->renderListOptions();

// Render list options (header, left)
$t_pendidikan_list->ListOptions->render("header", "left");
?>
<?php if ($t_pendidikan_list->kdpend->Visible) { // kdpend ?>
	<?php if ($t_pendidikan_list->SortUrl($t_pendidikan_list->kdpend) == "") { ?>
		<th data-name="kdpend" class="<?php echo $t_pendidikan_list->kdpend->headerCellClass() ?>"><div id="elh_t_pendidikan_kdpend" class="t_pendidikan_kdpend"><div class="ew-table-header-caption"><?php echo $t_pendidikan_list->kdpend->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdpend" class="<?php echo $t_pendidikan_list->kdpend->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pendidikan_list->SortUrl($t_pendidikan_list->kdpend) ?>', 1);"><div id="elh_t_pendidikan_kdpend" class="t_pendidikan_kdpend">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pendidikan_list->kdpend->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pendidikan_list->kdpend->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pendidikan_list->kdpend->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_pendidikan_list->pendidikan->Visible) { // pendidikan ?>
	<?php if ($t_pendidikan_list->SortUrl($t_pendidikan_list->pendidikan) == "") { ?>
		<th data-name="pendidikan" class="<?php echo $t_pendidikan_list->pendidikan->headerCellClass() ?>"><div id="elh_t_pendidikan_pendidikan" class="t_pendidikan_pendidikan"><div class="ew-table-header-caption"><?php echo $t_pendidikan_list->pendidikan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pendidikan" class="<?php echo $t_pendidikan_list->pendidikan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_pendidikan_list->SortUrl($t_pendidikan_list->pendidikan) ?>', 1);"><div id="elh_t_pendidikan_pendidikan" class="t_pendidikan_pendidikan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_pendidikan_list->pendidikan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_pendidikan_list->pendidikan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_pendidikan_list->pendidikan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_pendidikan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_pendidikan_list->ExportAll && $t_pendidikan_list->isExport()) {
	$t_pendidikan_list->StopRecord = $t_pendidikan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_pendidikan_list->TotalRecords > $t_pendidikan_list->StartRecord + $t_pendidikan_list->DisplayRecords - 1)
		$t_pendidikan_list->StopRecord = $t_pendidikan_list->StartRecord + $t_pendidikan_list->DisplayRecords - 1;
	else
		$t_pendidikan_list->StopRecord = $t_pendidikan_list->TotalRecords;
}
$t_pendidikan_list->RecordCount = $t_pendidikan_list->StartRecord - 1;
if ($t_pendidikan_list->Recordset && !$t_pendidikan_list->Recordset->EOF) {
	$t_pendidikan_list->Recordset->moveFirst();
	$selectLimit = $t_pendidikan_list->UseSelectLimit;
	if (!$selectLimit && $t_pendidikan_list->StartRecord > 1)
		$t_pendidikan_list->Recordset->move($t_pendidikan_list->StartRecord - 1);
} elseif (!$t_pendidikan->AllowAddDeleteRow && $t_pendidikan_list->StopRecord == 0) {
	$t_pendidikan_list->StopRecord = $t_pendidikan->GridAddRowCount;
}

// Initialize aggregate
$t_pendidikan->RowType = ROWTYPE_AGGREGATEINIT;
$t_pendidikan->resetAttributes();
$t_pendidikan_list->renderRow();
while ($t_pendidikan_list->RecordCount < $t_pendidikan_list->StopRecord) {
	$t_pendidikan_list->RecordCount++;
	if ($t_pendidikan_list->RecordCount >= $t_pendidikan_list->StartRecord) {
		$t_pendidikan_list->RowCount++;

		// Set up key count
		$t_pendidikan_list->KeyCount = $t_pendidikan_list->RowIndex;

		// Init row class and style
		$t_pendidikan->resetAttributes();
		$t_pendidikan->CssClass = "";
		if ($t_pendidikan_list->isGridAdd()) {
		} else {
			$t_pendidikan_list->loadRowValues($t_pendidikan_list->Recordset); // Load row values
		}
		$t_pendidikan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_pendidikan->RowAttrs->merge(["data-rowindex" => $t_pendidikan_list->RowCount, "id" => "r" . $t_pendidikan_list->RowCount . "_t_pendidikan", "data-rowtype" => $t_pendidikan->RowType]);

		// Render row
		$t_pendidikan_list->renderRow();

		// Render list options
		$t_pendidikan_list->renderListOptions();
?>
	<tr <?php echo $t_pendidikan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_pendidikan_list->ListOptions->render("body", "left", $t_pendidikan_list->RowCount);
?>
	<?php if ($t_pendidikan_list->kdpend->Visible) { // kdpend ?>
		<td data-name="kdpend" <?php echo $t_pendidikan_list->kdpend->cellAttributes() ?>>
<span id="el<?php echo $t_pendidikan_list->RowCount ?>_t_pendidikan_kdpend">
<span<?php echo $t_pendidikan_list->kdpend->viewAttributes() ?>><?php echo $t_pendidikan_list->kdpend->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_pendidikan_list->pendidikan->Visible) { // pendidikan ?>
		<td data-name="pendidikan" <?php echo $t_pendidikan_list->pendidikan->cellAttributes() ?>>
<span id="el<?php echo $t_pendidikan_list->RowCount ?>_t_pendidikan_pendidikan">
<span<?php echo $t_pendidikan_list->pendidikan->viewAttributes() ?>><?php echo $t_pendidikan_list->pendidikan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_pendidikan_list->ListOptions->render("body", "right", $t_pendidikan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_pendidikan_list->isGridAdd())
		$t_pendidikan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_pendidikan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_pendidikan_list->Recordset)
	$t_pendidikan_list->Recordset->Close();
?>
<?php if (!$t_pendidikan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_pendidikan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_pendidikan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_pendidikan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_pendidikan_list->TotalRecords == 0 && !$t_pendidikan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_pendidikan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_pendidikan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_pendidikan_list->isExport()) { ?>
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
$t_pendidikan_list->terminate();
?>