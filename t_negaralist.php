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
$t_negara_list = new t_negara_list();

// Run the page
$t_negara_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_negara_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_negara_list->isExport()) { ?>
<script>
var ft_negaralist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_negaralist = currentForm = new ew.Form("ft_negaralist", "list");
	ft_negaralist.formKeyCountName = '<?php echo $t_negara_list->FormKeyCountName ?>';
	loadjs.done("ft_negaralist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_negara_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_negara_list->TotalRecords > 0 && $t_negara_list->ExportOptions->visible()) { ?>
<?php $t_negara_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_negara_list->ImportOptions->visible()) { ?>
<?php $t_negara_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_negara_list->renderOtherOptions();
?>
<?php $t_negara_list->showPageHeader(); ?>
<?php
$t_negara_list->showMessage();
?>
<?php if ($t_negara_list->TotalRecords > 0 || $t_negara->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_negara_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_negara">
<?php if (!$t_negara_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_negara_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_negara_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_negara_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_negaralist" id="ft_negaralist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_negara">
<div id="gmp_t_negara" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_negara_list->TotalRecords > 0 || $t_negara_list->isGridEdit()) { ?>
<table id="tbl_t_negaralist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_negara->RowType = ROWTYPE_HEADER;

// Render list options
$t_negara_list->renderListOptions();

// Render list options (header, left)
$t_negara_list->ListOptions->render("header", "left");
?>
<?php if ($t_negara_list->kdnegara->Visible) { // kdnegara ?>
	<?php if ($t_negara_list->SortUrl($t_negara_list->kdnegara) == "") { ?>
		<th data-name="kdnegara" class="<?php echo $t_negara_list->kdnegara->headerCellClass() ?>"><div id="elh_t_negara_kdnegara" class="t_negara_kdnegara"><div class="ew-table-header-caption"><?php echo $t_negara_list->kdnegara->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdnegara" class="<?php echo $t_negara_list->kdnegara->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_negara_list->SortUrl($t_negara_list->kdnegara) ?>', 1);"><div id="elh_t_negara_kdnegara" class="t_negara_kdnegara">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_negara_list->kdnegara->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_negara_list->kdnegara->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_negara_list->kdnegara->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_negara_list->negara->Visible) { // negara ?>
	<?php if ($t_negara_list->SortUrl($t_negara_list->negara) == "") { ?>
		<th data-name="negara" class="<?php echo $t_negara_list->negara->headerCellClass() ?>"><div id="elh_t_negara_negara" class="t_negara_negara"><div class="ew-table-header-caption"><?php echo $t_negara_list->negara->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="negara" class="<?php echo $t_negara_list->negara->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_negara_list->SortUrl($t_negara_list->negara) ?>', 1);"><div id="elh_t_negara_negara" class="t_negara_negara">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_negara_list->negara->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_negara_list->negara->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_negara_list->negara->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_negara_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_negara_list->ExportAll && $t_negara_list->isExport()) {
	$t_negara_list->StopRecord = $t_negara_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_negara_list->TotalRecords > $t_negara_list->StartRecord + $t_negara_list->DisplayRecords - 1)
		$t_negara_list->StopRecord = $t_negara_list->StartRecord + $t_negara_list->DisplayRecords - 1;
	else
		$t_negara_list->StopRecord = $t_negara_list->TotalRecords;
}
$t_negara_list->RecordCount = $t_negara_list->StartRecord - 1;
if ($t_negara_list->Recordset && !$t_negara_list->Recordset->EOF) {
	$t_negara_list->Recordset->moveFirst();
	$selectLimit = $t_negara_list->UseSelectLimit;
	if (!$selectLimit && $t_negara_list->StartRecord > 1)
		$t_negara_list->Recordset->move($t_negara_list->StartRecord - 1);
} elseif (!$t_negara->AllowAddDeleteRow && $t_negara_list->StopRecord == 0) {
	$t_negara_list->StopRecord = $t_negara->GridAddRowCount;
}

// Initialize aggregate
$t_negara->RowType = ROWTYPE_AGGREGATEINIT;
$t_negara->resetAttributes();
$t_negara_list->renderRow();
while ($t_negara_list->RecordCount < $t_negara_list->StopRecord) {
	$t_negara_list->RecordCount++;
	if ($t_negara_list->RecordCount >= $t_negara_list->StartRecord) {
		$t_negara_list->RowCount++;

		// Set up key count
		$t_negara_list->KeyCount = $t_negara_list->RowIndex;

		// Init row class and style
		$t_negara->resetAttributes();
		$t_negara->CssClass = "";
		if ($t_negara_list->isGridAdd()) {
		} else {
			$t_negara_list->loadRowValues($t_negara_list->Recordset); // Load row values
		}
		$t_negara->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_negara->RowAttrs->merge(["data-rowindex" => $t_negara_list->RowCount, "id" => "r" . $t_negara_list->RowCount . "_t_negara", "data-rowtype" => $t_negara->RowType]);

		// Render row
		$t_negara_list->renderRow();

		// Render list options
		$t_negara_list->renderListOptions();
?>
	<tr <?php echo $t_negara->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_negara_list->ListOptions->render("body", "left", $t_negara_list->RowCount);
?>
	<?php if ($t_negara_list->kdnegara->Visible) { // kdnegara ?>
		<td data-name="kdnegara" <?php echo $t_negara_list->kdnegara->cellAttributes() ?>>
<span id="el<?php echo $t_negara_list->RowCount ?>_t_negara_kdnegara">
<span<?php echo $t_negara_list->kdnegara->viewAttributes() ?>><?php echo $t_negara_list->kdnegara->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_negara_list->negara->Visible) { // negara ?>
		<td data-name="negara" <?php echo $t_negara_list->negara->cellAttributes() ?>>
<span id="el<?php echo $t_negara_list->RowCount ?>_t_negara_negara">
<span<?php echo $t_negara_list->negara->viewAttributes() ?>><?php echo $t_negara_list->negara->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_negara_list->ListOptions->render("body", "right", $t_negara_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_negara_list->isGridAdd())
		$t_negara_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_negara->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_negara_list->Recordset)
	$t_negara_list->Recordset->Close();
?>
<?php if (!$t_negara_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_negara_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_negara_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_negara_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_negara_list->TotalRecords == 0 && !$t_negara->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_negara_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_negara_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_negara_list->isExport()) { ?>
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
$t_negara_list->terminate();
?>