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
$t_jabatan_list = new t_jabatan_list();

// Run the page
$t_jabatan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_jabatan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_jabatan_list->isExport()) { ?>
<script>
var ft_jabatanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_jabatanlist = currentForm = new ew.Form("ft_jabatanlist", "list");
	ft_jabatanlist.formKeyCountName = '<?php echo $t_jabatan_list->FormKeyCountName ?>';
	loadjs.done("ft_jabatanlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_jabatan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_jabatan_list->TotalRecords > 0 && $t_jabatan_list->ExportOptions->visible()) { ?>
<?php $t_jabatan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_jabatan_list->ImportOptions->visible()) { ?>
<?php $t_jabatan_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_jabatan_list->renderOtherOptions();
?>
<?php $t_jabatan_list->showPageHeader(); ?>
<?php
$t_jabatan_list->showMessage();
?>
<?php if ($t_jabatan_list->TotalRecords > 0 || $t_jabatan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_jabatan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_jabatan">
<?php if (!$t_jabatan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_jabatan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_jabatan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_jabatan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_jabatanlist" id="ft_jabatanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_jabatan">
<div id="gmp_t_jabatan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_jabatan_list->TotalRecords > 0 || $t_jabatan_list->isGridEdit()) { ?>
<table id="tbl_t_jabatanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_jabatan->RowType = ROWTYPE_HEADER;

// Render list options
$t_jabatan_list->renderListOptions();

// Render list options (header, left)
$t_jabatan_list->ListOptions->render("header", "left");
?>
<?php if ($t_jabatan_list->kdjabat->Visible) { // kdjabat ?>
	<?php if ($t_jabatan_list->SortUrl($t_jabatan_list->kdjabat) == "") { ?>
		<th data-name="kdjabat" class="<?php echo $t_jabatan_list->kdjabat->headerCellClass() ?>"><div id="elh_t_jabatan_kdjabat" class="t_jabatan_kdjabat"><div class="ew-table-header-caption"><?php echo $t_jabatan_list->kdjabat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjabat" class="<?php echo $t_jabatan_list->kdjabat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jabatan_list->SortUrl($t_jabatan_list->kdjabat) ?>', 1);"><div id="elh_t_jabatan_kdjabat" class="t_jabatan_kdjabat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jabatan_list->kdjabat->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jabatan_list->kdjabat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jabatan_list->kdjabat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_jabatan_list->jabatan->Visible) { // jabatan ?>
	<?php if ($t_jabatan_list->SortUrl($t_jabatan_list->jabatan) == "") { ?>
		<th data-name="jabatan" class="<?php echo $t_jabatan_list->jabatan->headerCellClass() ?>"><div id="elh_t_jabatan_jabatan" class="t_jabatan_jabatan"><div class="ew-table-header-caption"><?php echo $t_jabatan_list->jabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan" class="<?php echo $t_jabatan_list->jabatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_jabatan_list->SortUrl($t_jabatan_list->jabatan) ?>', 1);"><div id="elh_t_jabatan_jabatan" class="t_jabatan_jabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_jabatan_list->jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_jabatan_list->jabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_jabatan_list->jabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_jabatan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_jabatan_list->ExportAll && $t_jabatan_list->isExport()) {
	$t_jabatan_list->StopRecord = $t_jabatan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_jabatan_list->TotalRecords > $t_jabatan_list->StartRecord + $t_jabatan_list->DisplayRecords - 1)
		$t_jabatan_list->StopRecord = $t_jabatan_list->StartRecord + $t_jabatan_list->DisplayRecords - 1;
	else
		$t_jabatan_list->StopRecord = $t_jabatan_list->TotalRecords;
}
$t_jabatan_list->RecordCount = $t_jabatan_list->StartRecord - 1;
if ($t_jabatan_list->Recordset && !$t_jabatan_list->Recordset->EOF) {
	$t_jabatan_list->Recordset->moveFirst();
	$selectLimit = $t_jabatan_list->UseSelectLimit;
	if (!$selectLimit && $t_jabatan_list->StartRecord > 1)
		$t_jabatan_list->Recordset->move($t_jabatan_list->StartRecord - 1);
} elseif (!$t_jabatan->AllowAddDeleteRow && $t_jabatan_list->StopRecord == 0) {
	$t_jabatan_list->StopRecord = $t_jabatan->GridAddRowCount;
}

// Initialize aggregate
$t_jabatan->RowType = ROWTYPE_AGGREGATEINIT;
$t_jabatan->resetAttributes();
$t_jabatan_list->renderRow();
while ($t_jabatan_list->RecordCount < $t_jabatan_list->StopRecord) {
	$t_jabatan_list->RecordCount++;
	if ($t_jabatan_list->RecordCount >= $t_jabatan_list->StartRecord) {
		$t_jabatan_list->RowCount++;

		// Set up key count
		$t_jabatan_list->KeyCount = $t_jabatan_list->RowIndex;

		// Init row class and style
		$t_jabatan->resetAttributes();
		$t_jabatan->CssClass = "";
		if ($t_jabatan_list->isGridAdd()) {
		} else {
			$t_jabatan_list->loadRowValues($t_jabatan_list->Recordset); // Load row values
		}
		$t_jabatan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_jabatan->RowAttrs->merge(["data-rowindex" => $t_jabatan_list->RowCount, "id" => "r" . $t_jabatan_list->RowCount . "_t_jabatan", "data-rowtype" => $t_jabatan->RowType]);

		// Render row
		$t_jabatan_list->renderRow();

		// Render list options
		$t_jabatan_list->renderListOptions();
?>
	<tr <?php echo $t_jabatan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_jabatan_list->ListOptions->render("body", "left", $t_jabatan_list->RowCount);
?>
	<?php if ($t_jabatan_list->kdjabat->Visible) { // kdjabat ?>
		<td data-name="kdjabat" <?php echo $t_jabatan_list->kdjabat->cellAttributes() ?>>
<span id="el<?php echo $t_jabatan_list->RowCount ?>_t_jabatan_kdjabat">
<span<?php echo $t_jabatan_list->kdjabat->viewAttributes() ?>><?php echo $t_jabatan_list->kdjabat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_jabatan_list->jabatan->Visible) { // jabatan ?>
		<td data-name="jabatan" <?php echo $t_jabatan_list->jabatan->cellAttributes() ?>>
<span id="el<?php echo $t_jabatan_list->RowCount ?>_t_jabatan_jabatan">
<span<?php echo $t_jabatan_list->jabatan->viewAttributes() ?>><?php echo $t_jabatan_list->jabatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_jabatan_list->ListOptions->render("body", "right", $t_jabatan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_jabatan_list->isGridAdd())
		$t_jabatan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_jabatan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_jabatan_list->Recordset)
	$t_jabatan_list->Recordset->Close();
?>
<?php if (!$t_jabatan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_jabatan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_jabatan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_jabatan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_jabatan_list->TotalRecords == 0 && !$t_jabatan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_jabatan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_jabatan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_jabatan_list->isExport()) { ?>
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
$t_jabatan_list->terminate();
?>