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
$t_skala_list = new t_skala_list();

// Run the page
$t_skala_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_skala_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_skala_list->isExport()) { ?>
<script>
var ft_skalalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_skalalist = currentForm = new ew.Form("ft_skalalist", "list");
	ft_skalalist.formKeyCountName = '<?php echo $t_skala_list->FormKeyCountName ?>';
	loadjs.done("ft_skalalist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_skala_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_skala_list->TotalRecords > 0 && $t_skala_list->ExportOptions->visible()) { ?>
<?php $t_skala_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_skala_list->ImportOptions->visible()) { ?>
<?php $t_skala_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_skala_list->renderOtherOptions();
?>
<?php $t_skala_list->showPageHeader(); ?>
<?php
$t_skala_list->showMessage();
?>
<?php if ($t_skala_list->TotalRecords > 0 || $t_skala->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_skala_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_skala">
<?php if (!$t_skala_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_skala_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_skala_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_skala_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_skalalist" id="ft_skalalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_skala">
<div id="gmp_t_skala" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_skala_list->TotalRecords > 0 || $t_skala_list->isGridEdit()) { ?>
<table id="tbl_t_skalalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_skala->RowType = ROWTYPE_HEADER;

// Render list options
$t_skala_list->renderListOptions();

// Render list options (header, left)
$t_skala_list->ListOptions->render("header", "left");
?>
<?php if ($t_skala_list->kdskala->Visible) { // kdskala ?>
	<?php if ($t_skala_list->SortUrl($t_skala_list->kdskala) == "") { ?>
		<th data-name="kdskala" class="<?php echo $t_skala_list->kdskala->headerCellClass() ?>"><div id="elh_t_skala_kdskala" class="t_skala_kdskala"><div class="ew-table-header-caption"><?php echo $t_skala_list->kdskala->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdskala" class="<?php echo $t_skala_list->kdskala->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_skala_list->SortUrl($t_skala_list->kdskala) ?>', 1);"><div id="elh_t_skala_kdskala" class="t_skala_kdskala">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_skala_list->kdskala->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_skala_list->kdskala->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_skala_list->kdskala->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_skala_list->skala->Visible) { // skala ?>
	<?php if ($t_skala_list->SortUrl($t_skala_list->skala) == "") { ?>
		<th data-name="skala" class="<?php echo $t_skala_list->skala->headerCellClass() ?>"><div id="elh_t_skala_skala" class="t_skala_skala"><div class="ew-table-header-caption"><?php echo $t_skala_list->skala->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="skala" class="<?php echo $t_skala_list->skala->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_skala_list->SortUrl($t_skala_list->skala) ?>', 1);"><div id="elh_t_skala_skala" class="t_skala_skala">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_skala_list->skala->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_skala_list->skala->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_skala_list->skala->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_skala_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_skala_list->ExportAll && $t_skala_list->isExport()) {
	$t_skala_list->StopRecord = $t_skala_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_skala_list->TotalRecords > $t_skala_list->StartRecord + $t_skala_list->DisplayRecords - 1)
		$t_skala_list->StopRecord = $t_skala_list->StartRecord + $t_skala_list->DisplayRecords - 1;
	else
		$t_skala_list->StopRecord = $t_skala_list->TotalRecords;
}
$t_skala_list->RecordCount = $t_skala_list->StartRecord - 1;
if ($t_skala_list->Recordset && !$t_skala_list->Recordset->EOF) {
	$t_skala_list->Recordset->moveFirst();
	$selectLimit = $t_skala_list->UseSelectLimit;
	if (!$selectLimit && $t_skala_list->StartRecord > 1)
		$t_skala_list->Recordset->move($t_skala_list->StartRecord - 1);
} elseif (!$t_skala->AllowAddDeleteRow && $t_skala_list->StopRecord == 0) {
	$t_skala_list->StopRecord = $t_skala->GridAddRowCount;
}

// Initialize aggregate
$t_skala->RowType = ROWTYPE_AGGREGATEINIT;
$t_skala->resetAttributes();
$t_skala_list->renderRow();
while ($t_skala_list->RecordCount < $t_skala_list->StopRecord) {
	$t_skala_list->RecordCount++;
	if ($t_skala_list->RecordCount >= $t_skala_list->StartRecord) {
		$t_skala_list->RowCount++;

		// Set up key count
		$t_skala_list->KeyCount = $t_skala_list->RowIndex;

		// Init row class and style
		$t_skala->resetAttributes();
		$t_skala->CssClass = "";
		if ($t_skala_list->isGridAdd()) {
		} else {
			$t_skala_list->loadRowValues($t_skala_list->Recordset); // Load row values
		}
		$t_skala->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_skala->RowAttrs->merge(["data-rowindex" => $t_skala_list->RowCount, "id" => "r" . $t_skala_list->RowCount . "_t_skala", "data-rowtype" => $t_skala->RowType]);

		// Render row
		$t_skala_list->renderRow();

		// Render list options
		$t_skala_list->renderListOptions();
?>
	<tr <?php echo $t_skala->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_skala_list->ListOptions->render("body", "left", $t_skala_list->RowCount);
?>
	<?php if ($t_skala_list->kdskala->Visible) { // kdskala ?>
		<td data-name="kdskala" <?php echo $t_skala_list->kdskala->cellAttributes() ?>>
<span id="el<?php echo $t_skala_list->RowCount ?>_t_skala_kdskala">
<span<?php echo $t_skala_list->kdskala->viewAttributes() ?>><?php echo $t_skala_list->kdskala->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_skala_list->skala->Visible) { // skala ?>
		<td data-name="skala" <?php echo $t_skala_list->skala->cellAttributes() ?>>
<span id="el<?php echo $t_skala_list->RowCount ?>_t_skala_skala">
<span<?php echo $t_skala_list->skala->viewAttributes() ?>><?php echo $t_skala_list->skala->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_skala_list->ListOptions->render("body", "right", $t_skala_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_skala_list->isGridAdd())
		$t_skala_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_skala->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_skala_list->Recordset)
	$t_skala_list->Recordset->Close();
?>
<?php if (!$t_skala_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_skala_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_skala_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_skala_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_skala_list->TotalRecords == 0 && !$t_skala->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_skala_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_skala_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_skala_list->isExport()) { ?>
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
$t_skala_list->terminate();
?>