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
$t_agama_list = new t_agama_list();

// Run the page
$t_agama_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_agama_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_agama_list->isExport()) { ?>
<script>
var ft_agamalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_agamalist = currentForm = new ew.Form("ft_agamalist", "list");
	ft_agamalist.formKeyCountName = '<?php echo $t_agama_list->FormKeyCountName ?>';
	loadjs.done("ft_agamalist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//document.write('<?php echo cs_judul("list","Daftar Agama");?>');

});
</script>
<?php } ?>
<?php if (!$t_agama_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_agama_list->TotalRecords > 0 && $t_agama_list->ExportOptions->visible()) { ?>
<?php $t_agama_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_agama_list->ImportOptions->visible()) { ?>
<?php $t_agama_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_agama_list->renderOtherOptions();
?>
<?php $t_agama_list->showPageHeader(); ?>
<?php
$t_agama_list->showMessage();
?>
<?php if ($t_agama_list->TotalRecords > 0 || $t_agama->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_agama_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_agama">
<?php if (!$t_agama_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_agama_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_agama_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_agama_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_agamalist" id="ft_agamalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_agama">
<div id="gmp_t_agama" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_agama_list->TotalRecords > 0 || $t_agama_list->isGridEdit()) { ?>
<table id="tbl_t_agamalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_agama->RowType = ROWTYPE_HEADER;

// Render list options
$t_agama_list->renderListOptions();

// Render list options (header, left)
$t_agama_list->ListOptions->render("header", "left");
?>
<?php if ($t_agama_list->kdagama->Visible) { // kdagama ?>
	<?php if ($t_agama_list->SortUrl($t_agama_list->kdagama) == "") { ?>
		<th data-name="kdagama" class="<?php echo $t_agama_list->kdagama->headerCellClass() ?>"><div id="elh_t_agama_kdagama" class="t_agama_kdagama"><div class="ew-table-header-caption"><?php echo $t_agama_list->kdagama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdagama" class="<?php echo $t_agama_list->kdagama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_agama_list->SortUrl($t_agama_list->kdagama) ?>', 1);"><div id="elh_t_agama_kdagama" class="t_agama_kdagama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_agama_list->kdagama->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_agama_list->kdagama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_agama_list->kdagama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_agama_list->agama->Visible) { // agama ?>
	<?php if ($t_agama_list->SortUrl($t_agama_list->agama) == "") { ?>
		<th data-name="agama" class="<?php echo $t_agama_list->agama->headerCellClass() ?>"><div id="elh_t_agama_agama" class="t_agama_agama"><div class="ew-table-header-caption"><?php echo $t_agama_list->agama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="agama" class="<?php echo $t_agama_list->agama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_agama_list->SortUrl($t_agama_list->agama) ?>', 1);"><div id="elh_t_agama_agama" class="t_agama_agama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_agama_list->agama->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_agama_list->agama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_agama_list->agama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_agama_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_agama_list->ExportAll && $t_agama_list->isExport()) {
	$t_agama_list->StopRecord = $t_agama_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_agama_list->TotalRecords > $t_agama_list->StartRecord + $t_agama_list->DisplayRecords - 1)
		$t_agama_list->StopRecord = $t_agama_list->StartRecord + $t_agama_list->DisplayRecords - 1;
	else
		$t_agama_list->StopRecord = $t_agama_list->TotalRecords;
}
$t_agama_list->RecordCount = $t_agama_list->StartRecord - 1;
if ($t_agama_list->Recordset && !$t_agama_list->Recordset->EOF) {
	$t_agama_list->Recordset->moveFirst();
	$selectLimit = $t_agama_list->UseSelectLimit;
	if (!$selectLimit && $t_agama_list->StartRecord > 1)
		$t_agama_list->Recordset->move($t_agama_list->StartRecord - 1);
} elseif (!$t_agama->AllowAddDeleteRow && $t_agama_list->StopRecord == 0) {
	$t_agama_list->StopRecord = $t_agama->GridAddRowCount;
}

// Initialize aggregate
$t_agama->RowType = ROWTYPE_AGGREGATEINIT;
$t_agama->resetAttributes();
$t_agama_list->renderRow();
while ($t_agama_list->RecordCount < $t_agama_list->StopRecord) {
	$t_agama_list->RecordCount++;
	if ($t_agama_list->RecordCount >= $t_agama_list->StartRecord) {
		$t_agama_list->RowCount++;

		// Set up key count
		$t_agama_list->KeyCount = $t_agama_list->RowIndex;

		// Init row class and style
		$t_agama->resetAttributes();
		$t_agama->CssClass = "";
		if ($t_agama_list->isGridAdd()) {
		} else {
			$t_agama_list->loadRowValues($t_agama_list->Recordset); // Load row values
		}
		$t_agama->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_agama->RowAttrs->merge(["data-rowindex" => $t_agama_list->RowCount, "id" => "r" . $t_agama_list->RowCount . "_t_agama", "data-rowtype" => $t_agama->RowType]);

		// Render row
		$t_agama_list->renderRow();

		// Render list options
		$t_agama_list->renderListOptions();
?>
	<tr <?php echo $t_agama->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_agama_list->ListOptions->render("body", "left", $t_agama_list->RowCount);
?>
	<?php if ($t_agama_list->kdagama->Visible) { // kdagama ?>
		<td data-name="kdagama" <?php echo $t_agama_list->kdagama->cellAttributes() ?>>
<span id="el<?php echo $t_agama_list->RowCount ?>_t_agama_kdagama">
<span<?php echo $t_agama_list->kdagama->viewAttributes() ?>><?php echo $t_agama_list->kdagama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_agama_list->agama->Visible) { // agama ?>
		<td data-name="agama" <?php echo $t_agama_list->agama->cellAttributes() ?>>
<span id="el<?php echo $t_agama_list->RowCount ?>_t_agama_agama">
<span<?php echo $t_agama_list->agama->viewAttributes() ?>><?php echo $t_agama_list->agama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_agama_list->ListOptions->render("body", "right", $t_agama_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_agama_list->isGridAdd())
		$t_agama_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_agama->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_agama_list->Recordset)
	$t_agama_list->Recordset->Close();
?>
<?php if (!$t_agama_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_agama_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_agama_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_agama_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_agama_list->TotalRecords == 0 && !$t_agama->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_agama_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_agama_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_agama_list->isExport()) { ?>
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
$t_agama_list->terminate();
?>