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
$t_userlevels_list = new t_userlevels_list();

// Run the page
$t_userlevels_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_userlevels_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_userlevels_list->isExport()) { ?>
<script>
var ft_userlevelslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_userlevelslist = currentForm = new ew.Form("ft_userlevelslist", "list");
	ft_userlevelslist.formKeyCountName = '<?php echo $t_userlevels_list->FormKeyCountName ?>';
	loadjs.done("ft_userlevelslist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_userlevels_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_userlevels_list->TotalRecords > 0 && $t_userlevels_list->ExportOptions->visible()) { ?>
<?php $t_userlevels_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_userlevels_list->ImportOptions->visible()) { ?>
<?php $t_userlevels_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_userlevels_list->renderOtherOptions();
?>
<?php $t_userlevels_list->showPageHeader(); ?>
<?php
$t_userlevels_list->showMessage();
?>
<?php if ($t_userlevels_list->TotalRecords > 0 || $t_userlevels->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_userlevels_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_userlevels">
<?php if (!$t_userlevels_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_userlevels_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_userlevels_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_userlevels_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_userlevelslist" id="ft_userlevelslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_userlevels">
<div id="gmp_t_userlevels" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_userlevels_list->TotalRecords > 0 || $t_userlevels_list->isGridEdit()) { ?>
<table id="tbl_t_userlevelslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_userlevels->RowType = ROWTYPE_HEADER;

// Render list options
$t_userlevels_list->renderListOptions();

// Render list options (header, left)
$t_userlevels_list->ListOptions->render("header", "left");
?>
<?php if ($t_userlevels_list->user_level_name->Visible) { // user_level_name ?>
	<?php if ($t_userlevels_list->SortUrl($t_userlevels_list->user_level_name) == "") { ?>
		<th data-name="user_level_name" class="<?php echo $t_userlevels_list->user_level_name->headerCellClass() ?>"><div id="elh_t_userlevels_user_level_name" class="t_userlevels_user_level_name"><div class="ew-table-header-caption"><?php echo $t_userlevels_list->user_level_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_level_name" class="<?php echo $t_userlevels_list->user_level_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_userlevels_list->SortUrl($t_userlevels_list->user_level_name) ?>', 1);"><div id="elh_t_userlevels_user_level_name" class="t_userlevels_user_level_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_userlevels_list->user_level_name->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_userlevels_list->user_level_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_userlevels_list->user_level_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_userlevels_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_userlevels_list->ExportAll && $t_userlevels_list->isExport()) {
	$t_userlevels_list->StopRecord = $t_userlevels_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_userlevels_list->TotalRecords > $t_userlevels_list->StartRecord + $t_userlevels_list->DisplayRecords - 1)
		$t_userlevels_list->StopRecord = $t_userlevels_list->StartRecord + $t_userlevels_list->DisplayRecords - 1;
	else
		$t_userlevels_list->StopRecord = $t_userlevels_list->TotalRecords;
}
$t_userlevels_list->RecordCount = $t_userlevels_list->StartRecord - 1;
if ($t_userlevels_list->Recordset && !$t_userlevels_list->Recordset->EOF) {
	$t_userlevels_list->Recordset->moveFirst();
	$selectLimit = $t_userlevels_list->UseSelectLimit;
	if (!$selectLimit && $t_userlevels_list->StartRecord > 1)
		$t_userlevels_list->Recordset->move($t_userlevels_list->StartRecord - 1);
} elseif (!$t_userlevels->AllowAddDeleteRow && $t_userlevels_list->StopRecord == 0) {
	$t_userlevels_list->StopRecord = $t_userlevels->GridAddRowCount;
}

// Initialize aggregate
$t_userlevels->RowType = ROWTYPE_AGGREGATEINIT;
$t_userlevels->resetAttributes();
$t_userlevels_list->renderRow();
while ($t_userlevels_list->RecordCount < $t_userlevels_list->StopRecord) {
	$t_userlevels_list->RecordCount++;
	if ($t_userlevels_list->RecordCount >= $t_userlevels_list->StartRecord) {
		$t_userlevels_list->RowCount++;

		// Set up key count
		$t_userlevels_list->KeyCount = $t_userlevels_list->RowIndex;

		// Init row class and style
		$t_userlevels->resetAttributes();
		$t_userlevels->CssClass = "";
		if ($t_userlevels_list->isGridAdd()) {
		} else {
			$t_userlevels_list->loadRowValues($t_userlevels_list->Recordset); // Load row values
		}
		$t_userlevels->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_userlevels->RowAttrs->merge(["data-rowindex" => $t_userlevels_list->RowCount, "id" => "r" . $t_userlevels_list->RowCount . "_t_userlevels", "data-rowtype" => $t_userlevels->RowType]);

		// Render row
		$t_userlevels_list->renderRow();

		// Render list options
		$t_userlevels_list->renderListOptions();
?>
	<tr <?php echo $t_userlevels->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_userlevels_list->ListOptions->render("body", "left", $t_userlevels_list->RowCount);
?>
	<?php if ($t_userlevels_list->user_level_name->Visible) { // user_level_name ?>
		<td data-name="user_level_name" <?php echo $t_userlevels_list->user_level_name->cellAttributes() ?>>
<span id="el<?php echo $t_userlevels_list->RowCount ?>_t_userlevels_user_level_name">
<span<?php echo $t_userlevels_list->user_level_name->viewAttributes() ?>><?php echo $t_userlevels_list->user_level_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_userlevels_list->ListOptions->render("body", "right", $t_userlevels_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_userlevels_list->isGridAdd())
		$t_userlevels_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_userlevels->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_userlevels_list->Recordset)
	$t_userlevels_list->Recordset->Close();
?>
<?php if (!$t_userlevels_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_userlevels_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_userlevels_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_userlevels_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_userlevels_list->TotalRecords == 0 && !$t_userlevels->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_userlevels_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_userlevels_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_userlevels_list->isExport()) { ?>
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
$t_userlevels_list->terminate();
?>