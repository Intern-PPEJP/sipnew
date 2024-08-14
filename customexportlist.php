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
$customexport_list = new customexport_list();

// Run the page
$customexport_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$customexport_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$customexport_list->isExport()) { ?>
<script>
var fcustomexportlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcustomexportlist = currentForm = new ew.Form("fcustomexportlist", "list");
	fcustomexportlist.formKeyCountName = '<?php echo $customexport_list->FormKeyCountName ?>';
	loadjs.done("fcustomexportlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$customexport_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($customexport_list->TotalRecords > 0 && $customexport_list->ExportOptions->visible()) { ?>
<?php $customexport_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($customexport_list->ImportOptions->visible()) { ?>
<?php $customexport_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$customexport_list->renderOtherOptions();
?>
<?php $customexport_list->showPageHeader(); ?>
<?php
$customexport_list->showMessage();
?>
<?php if ($customexport_list->TotalRecords > 0 || $customexport->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($customexport_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> customexport">
<?php if (!$customexport_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$customexport_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $customexport_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $customexport_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcustomexportlist" id="fcustomexportlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="customexport">
<div id="gmp_customexport" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($customexport_list->TotalRecords > 0 || $customexport_list->isGridEdit()) { ?>
<table id="tbl_customexportlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$customexport->RowType = ROWTYPE_HEADER;

// Render list options
$customexport_list->renderListOptions();

// Render list options (header, left)
$customexport_list->ListOptions->render("header", "left");
?>
<?php if ($customexport_list->u->Visible) { // u ?>
	<?php if ($customexport_list->SortUrl($customexport_list->u) == "") { ?>
		<th data-name="u" class="<?php echo $customexport_list->u->headerCellClass() ?>"><div id="elh_customexport_u" class="customexport_u"><div class="ew-table-header-caption"><?php echo $customexport_list->u->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="u" class="<?php echo $customexport_list->u->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customexport_list->SortUrl($customexport_list->u) ?>', 1);"><div id="elh_customexport_u" class="customexport_u">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customexport_list->u->caption() ?></span><span class="ew-table-header-sort"><?php if ($customexport_list->u->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customexport_list->u->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$customexport_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($customexport_list->ExportAll && $customexport_list->isExport()) {
	$customexport_list->StopRecord = $customexport_list->TotalRecords;
} else {

	// Set the last record to display
	if ($customexport_list->TotalRecords > $customexport_list->StartRecord + $customexport_list->DisplayRecords - 1)
		$customexport_list->StopRecord = $customexport_list->StartRecord + $customexport_list->DisplayRecords - 1;
	else
		$customexport_list->StopRecord = $customexport_list->TotalRecords;
}
$customexport_list->RecordCount = $customexport_list->StartRecord - 1;
if ($customexport_list->Recordset && !$customexport_list->Recordset->EOF) {
	$customexport_list->Recordset->moveFirst();
	$selectLimit = $customexport_list->UseSelectLimit;
	if (!$selectLimit && $customexport_list->StartRecord > 1)
		$customexport_list->Recordset->move($customexport_list->StartRecord - 1);
} elseif (!$customexport->AllowAddDeleteRow && $customexport_list->StopRecord == 0) {
	$customexport_list->StopRecord = $customexport->GridAddRowCount;
}

// Initialize aggregate
$customexport->RowType = ROWTYPE_AGGREGATEINIT;
$customexport->resetAttributes();
$customexport_list->renderRow();
while ($customexport_list->RecordCount < $customexport_list->StopRecord) {
	$customexport_list->RecordCount++;
	if ($customexport_list->RecordCount >= $customexport_list->StartRecord) {
		$customexport_list->RowCount++;

		// Set up key count
		$customexport_list->KeyCount = $customexport_list->RowIndex;

		// Init row class and style
		$customexport->resetAttributes();
		$customexport->CssClass = "";
		if ($customexport_list->isGridAdd()) {
		} else {
			$customexport_list->loadRowValues($customexport_list->Recordset); // Load row values
		}
		$customexport->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$customexport->RowAttrs->merge(["data-rowindex" => $customexport_list->RowCount, "id" => "r" . $customexport_list->RowCount . "_customexport", "data-rowtype" => $customexport->RowType]);

		// Render row
		$customexport_list->renderRow();

		// Render list options
		$customexport_list->renderListOptions();
?>
	<tr <?php echo $customexport->rowAttributes() ?>>
<?php

// Render list options (body, left)
$customexport_list->ListOptions->render("body", "left", $customexport_list->RowCount);
?>
	<?php if ($customexport_list->u->Visible) { // u ?>
		<td data-name="u" <?php echo $customexport_list->u->cellAttributes() ?>>
<span id="el<?php echo $customexport_list->RowCount ?>_customexport_u">
<span<?php echo $customexport_list->u->viewAttributes() ?>><?php echo $customexport_list->u->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$customexport_list->ListOptions->render("body", "right", $customexport_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$customexport_list->isGridAdd())
		$customexport_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$customexport->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($customexport_list->Recordset)
	$customexport_list->Recordset->Close();
?>
<?php if (!$customexport_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$customexport_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $customexport_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $customexport_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($customexport_list->TotalRecords == 0 && !$customexport->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $customexport_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$customexport_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$customexport_list->isExport()) { ?>
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
$customexport_list->terminate();
?>