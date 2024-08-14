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
$xprint_list = new xprint_list();

// Run the page
$xprint_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$xprint_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$xprint_list->isExport()) { ?>
<script>
var fxprintlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fxprintlist = currentForm = new ew.Form("fxprintlist", "list");
	fxprintlist.formKeyCountName = '<?php echo $xprint_list->FormKeyCountName ?>';
	loadjs.done("fxprintlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$xprint_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($xprint_list->TotalRecords > 0 && $xprint_list->ExportOptions->visible()) { ?>
<?php $xprint_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($xprint_list->ImportOptions->visible()) { ?>
<?php $xprint_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$xprint_list->renderOtherOptions();
?>
<?php $xprint_list->showPageHeader(); ?>
<?php
$xprint_list->showMessage();
?>
<?php if ($xprint_list->TotalRecords > 0 || $xprint->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($xprint_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> xprint">
<?php if (!$xprint_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$xprint_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $xprint_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $xprint_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fxprintlist" id="fxprintlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="xprint">
<div id="gmp_xprint" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($xprint_list->TotalRecords > 0 || $xprint_list->isGridEdit()) { ?>
<table id="tbl_xprintlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$xprint->RowType = ROWTYPE_HEADER;

// Render list options
$xprint_list->renderListOptions();

// Render list options (header, left)
$xprint_list->ListOptions->render("header", "left");
?>
<?php if ($xprint_list->u->Visible) { // u ?>
	<?php if ($xprint_list->SortUrl($xprint_list->u) == "") { ?>
		<th data-name="u" class="<?php echo $xprint_list->u->headerCellClass() ?>"><div id="elh_xprint_u" class="xprint_u"><div class="ew-table-header-caption"><?php echo $xprint_list->u->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="u" class="<?php echo $xprint_list->u->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $xprint_list->SortUrl($xprint_list->u) ?>', 1);"><div id="elh_xprint_u" class="xprint_u">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $xprint_list->u->caption() ?></span><span class="ew-table-header-sort"><?php if ($xprint_list->u->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($xprint_list->u->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$xprint_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($xprint_list->ExportAll && $xprint_list->isExport()) {
	$xprint_list->StopRecord = $xprint_list->TotalRecords;
} else {

	// Set the last record to display
	if ($xprint_list->TotalRecords > $xprint_list->StartRecord + $xprint_list->DisplayRecords - 1)
		$xprint_list->StopRecord = $xprint_list->StartRecord + $xprint_list->DisplayRecords - 1;
	else
		$xprint_list->StopRecord = $xprint_list->TotalRecords;
}
$xprint_list->RecordCount = $xprint_list->StartRecord - 1;
if ($xprint_list->Recordset && !$xprint_list->Recordset->EOF) {
	$xprint_list->Recordset->moveFirst();
	$selectLimit = $xprint_list->UseSelectLimit;
	if (!$selectLimit && $xprint_list->StartRecord > 1)
		$xprint_list->Recordset->move($xprint_list->StartRecord - 1);
} elseif (!$xprint->AllowAddDeleteRow && $xprint_list->StopRecord == 0) {
	$xprint_list->StopRecord = $xprint->GridAddRowCount;
}

// Initialize aggregate
$xprint->RowType = ROWTYPE_AGGREGATEINIT;
$xprint->resetAttributes();
$xprint_list->renderRow();
while ($xprint_list->RecordCount < $xprint_list->StopRecord) {
	$xprint_list->RecordCount++;
	if ($xprint_list->RecordCount >= $xprint_list->StartRecord) {
		$xprint_list->RowCount++;

		// Set up key count
		$xprint_list->KeyCount = $xprint_list->RowIndex;

		// Init row class and style
		$xprint->resetAttributes();
		$xprint->CssClass = "";
		if ($xprint_list->isGridAdd()) {
		} else {
			$xprint_list->loadRowValues($xprint_list->Recordset); // Load row values
		}
		$xprint->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$xprint->RowAttrs->merge(["data-rowindex" => $xprint_list->RowCount, "id" => "r" . $xprint_list->RowCount . "_xprint", "data-rowtype" => $xprint->RowType]);

		// Render row
		$xprint_list->renderRow();

		// Render list options
		$xprint_list->renderListOptions();
?>
	<tr <?php echo $xprint->rowAttributes() ?>>
<?php

// Render list options (body, left)
$xprint_list->ListOptions->render("body", "left", $xprint_list->RowCount);
?>
	<?php if ($xprint_list->u->Visible) { // u ?>
		<td data-name="u" <?php echo $xprint_list->u->cellAttributes() ?>>
<span id="el<?php echo $xprint_list->RowCount ?>_xprint_u">
<span<?php echo $xprint_list->u->viewAttributes() ?>><?php echo $xprint_list->u->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$xprint_list->ListOptions->render("body", "right", $xprint_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$xprint_list->isGridAdd())
		$xprint_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$xprint->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($xprint_list->Recordset)
	$xprint_list->Recordset->Close();
?>
<?php if (!$xprint_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$xprint_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $xprint_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $xprint_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($xprint_list->TotalRecords == 0 && !$xprint->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $xprint_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$xprint_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$xprint_list->isExport()) { ?>
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
$xprint_list->terminate();
?>