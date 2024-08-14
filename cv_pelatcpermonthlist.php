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
$cv_pelatcpermonth_list = new cv_pelatcpermonth_list();

// Run the page
$cv_pelatcpermonth_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cv_pelatcpermonth_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cv_pelatcpermonth_list->isExport()) { ?>
<script>
var fcv_pelatcpermonthlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcv_pelatcpermonthlist = currentForm = new ew.Form("fcv_pelatcpermonthlist", "list");
	fcv_pelatcpermonthlist.formKeyCountName = '<?php echo $cv_pelatcpermonth_list->FormKeyCountName ?>';
	loadjs.done("fcv_pelatcpermonthlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$cv_pelatcpermonth_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cv_pelatcpermonth_list->TotalRecords > 0 && $cv_pelatcpermonth_list->ExportOptions->visible()) { ?>
<?php $cv_pelatcpermonth_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cv_pelatcpermonth_list->ImportOptions->visible()) { ?>
<?php $cv_pelatcpermonth_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$cv_pelatcpermonth_list->renderOtherOptions();
?>
<?php $cv_pelatcpermonth_list->showPageHeader(); ?>
<?php
$cv_pelatcpermonth_list->showMessage();
?>
<?php if ($cv_pelatcpermonth_list->TotalRecords > 0 || $cv_pelatcpermonth->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cv_pelatcpermonth_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cv_pelatcpermonth">
<?php if (!$cv_pelatcpermonth_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$cv_pelatcpermonth_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cv_pelatcpermonth_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cv_pelatcpermonth_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcv_pelatcpermonthlist" id="fcv_pelatcpermonthlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cv_pelatcpermonth">
<div id="gmp_cv_pelatcpermonth" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($cv_pelatcpermonth_list->TotalRecords > 0 || $cv_pelatcpermonth_list->isGridEdit()) { ?>
<table id="tbl_cv_pelatcpermonthlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cv_pelatcpermonth->RowType = ROWTYPE_HEADER;

// Render list options
$cv_pelatcpermonth_list->renderListOptions();

// Render list options (header, left)
$cv_pelatcpermonth_list->ListOptions->render("header", "left");
?>
<?php if ($cv_pelatcpermonth_list->u->Visible) { // u ?>
	<?php if ($cv_pelatcpermonth_list->SortUrl($cv_pelatcpermonth_list->u) == "") { ?>
		<th data-name="u" class="<?php echo $cv_pelatcpermonth_list->u->headerCellClass() ?>"><div id="elh_cv_pelatcpermonth_u" class="cv_pelatcpermonth_u"><div class="ew-table-header-caption"><?php echo $cv_pelatcpermonth_list->u->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="u" class="<?php echo $cv_pelatcpermonth_list->u->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_pelatcpermonth_list->SortUrl($cv_pelatcpermonth_list->u) ?>', 1);"><div id="elh_cv_pelatcpermonth_u" class="cv_pelatcpermonth_u">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_pelatcpermonth_list->u->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_pelatcpermonth_list->u->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_pelatcpermonth_list->u->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cv_pelatcpermonth_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cv_pelatcpermonth_list->ExportAll && $cv_pelatcpermonth_list->isExport()) {
	$cv_pelatcpermonth_list->StopRecord = $cv_pelatcpermonth_list->TotalRecords;
} else {

	// Set the last record to display
	if ($cv_pelatcpermonth_list->TotalRecords > $cv_pelatcpermonth_list->StartRecord + $cv_pelatcpermonth_list->DisplayRecords - 1)
		$cv_pelatcpermonth_list->StopRecord = $cv_pelatcpermonth_list->StartRecord + $cv_pelatcpermonth_list->DisplayRecords - 1;
	else
		$cv_pelatcpermonth_list->StopRecord = $cv_pelatcpermonth_list->TotalRecords;
}
$cv_pelatcpermonth_list->RecordCount = $cv_pelatcpermonth_list->StartRecord - 1;
if ($cv_pelatcpermonth_list->Recordset && !$cv_pelatcpermonth_list->Recordset->EOF) {
	$cv_pelatcpermonth_list->Recordset->moveFirst();
	$selectLimit = $cv_pelatcpermonth_list->UseSelectLimit;
	if (!$selectLimit && $cv_pelatcpermonth_list->StartRecord > 1)
		$cv_pelatcpermonth_list->Recordset->move($cv_pelatcpermonth_list->StartRecord - 1);
} elseif (!$cv_pelatcpermonth->AllowAddDeleteRow && $cv_pelatcpermonth_list->StopRecord == 0) {
	$cv_pelatcpermonth_list->StopRecord = $cv_pelatcpermonth->GridAddRowCount;
}

// Initialize aggregate
$cv_pelatcpermonth->RowType = ROWTYPE_AGGREGATEINIT;
$cv_pelatcpermonth->resetAttributes();
$cv_pelatcpermonth_list->renderRow();
while ($cv_pelatcpermonth_list->RecordCount < $cv_pelatcpermonth_list->StopRecord) {
	$cv_pelatcpermonth_list->RecordCount++;
	if ($cv_pelatcpermonth_list->RecordCount >= $cv_pelatcpermonth_list->StartRecord) {
		$cv_pelatcpermonth_list->RowCount++;

		// Set up key count
		$cv_pelatcpermonth_list->KeyCount = $cv_pelatcpermonth_list->RowIndex;

		// Init row class and style
		$cv_pelatcpermonth->resetAttributes();
		$cv_pelatcpermonth->CssClass = "";
		if ($cv_pelatcpermonth_list->isGridAdd()) {
		} else {
			$cv_pelatcpermonth_list->loadRowValues($cv_pelatcpermonth_list->Recordset); // Load row values
		}
		$cv_pelatcpermonth->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cv_pelatcpermonth->RowAttrs->merge(["data-rowindex" => $cv_pelatcpermonth_list->RowCount, "id" => "r" . $cv_pelatcpermonth_list->RowCount . "_cv_pelatcpermonth", "data-rowtype" => $cv_pelatcpermonth->RowType]);

		// Render row
		$cv_pelatcpermonth_list->renderRow();

		// Render list options
		$cv_pelatcpermonth_list->renderListOptions();
?>
	<tr <?php echo $cv_pelatcpermonth->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cv_pelatcpermonth_list->ListOptions->render("body", "left", $cv_pelatcpermonth_list->RowCount);
?>
	<?php if ($cv_pelatcpermonth_list->u->Visible) { // u ?>
		<td data-name="u" <?php echo $cv_pelatcpermonth_list->u->cellAttributes() ?>>
<span id="el<?php echo $cv_pelatcpermonth_list->RowCount ?>_cv_pelatcpermonth_u">
<span<?php echo $cv_pelatcpermonth_list->u->viewAttributes() ?>><?php echo $cv_pelatcpermonth_list->u->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cv_pelatcpermonth_list->ListOptions->render("body", "right", $cv_pelatcpermonth_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$cv_pelatcpermonth_list->isGridAdd())
		$cv_pelatcpermonth_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$cv_pelatcpermonth->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cv_pelatcpermonth_list->Recordset)
	$cv_pelatcpermonth_list->Recordset->Close();
?>
<?php if (!$cv_pelatcpermonth_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cv_pelatcpermonth_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cv_pelatcpermonth_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cv_pelatcpermonth_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cv_pelatcpermonth_list->TotalRecords == 0 && !$cv_pelatcpermonth->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cv_pelatcpermonth_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cv_pelatcpermonth_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cv_pelatcpermonth_list->isExport()) { ?>
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
$cv_pelatcpermonth_list->terminate();
?>