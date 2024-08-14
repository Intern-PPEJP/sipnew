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
$t_kategori_list = new t_kategori_list();

// Run the page
$t_kategori_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_kategori_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_kategori_list->isExport()) { ?>
<script>
var ft_kategorilist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_kategorilist = currentForm = new ew.Form("ft_kategorilist", "list");
	ft_kategorilist.formKeyCountName = '<?php echo $t_kategori_list->FormKeyCountName ?>';
	loadjs.done("ft_kategorilist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_kategori_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_kategori_list->TotalRecords > 0 && $t_kategori_list->ExportOptions->visible()) { ?>
<?php $t_kategori_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_kategori_list->ImportOptions->visible()) { ?>
<?php $t_kategori_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_kategori_list->renderOtherOptions();
?>
<?php $t_kategori_list->showPageHeader(); ?>
<?php
$t_kategori_list->showMessage();
?>
<?php if ($t_kategori_list->TotalRecords > 0 || $t_kategori->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_kategori_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_kategori">
<?php if (!$t_kategori_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_kategori_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_kategori_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_kategori_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_kategorilist" id="ft_kategorilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_kategori">
<div id="gmp_t_kategori" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_kategori_list->TotalRecords > 0 || $t_kategori_list->isGridEdit()) { ?>
<table id="tbl_t_kategorilist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_kategori->RowType = ROWTYPE_HEADER;

// Render list options
$t_kategori_list->renderListOptions();

// Render list options (header, left)
$t_kategori_list->ListOptions->render("header", "left");
?>
<?php if ($t_kategori_list->kdkategori->Visible) { // kdkategori ?>
	<?php if ($t_kategori_list->SortUrl($t_kategori_list->kdkategori) == "") { ?>
		<th data-name="kdkategori" class="<?php echo $t_kategori_list->kdkategori->headerCellClass() ?>"><div id="elh_t_kategori_kdkategori" class="t_kategori_kdkategori"><div class="ew-table-header-caption"><?php echo $t_kategori_list->kdkategori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkategori" class="<?php echo $t_kategori_list->kdkategori->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kategori_list->SortUrl($t_kategori_list->kdkategori) ?>', 1);"><div id="elh_t_kategori_kdkategori" class="t_kategori_kdkategori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kategori_list->kdkategori->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kategori_list->kdkategori->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kategori_list->kdkategori->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kategori_list->kategori->Visible) { // kategori ?>
	<?php if ($t_kategori_list->SortUrl($t_kategori_list->kategori) == "") { ?>
		<th data-name="kategori" class="<?php echo $t_kategori_list->kategori->headerCellClass() ?>"><div id="elh_t_kategori_kategori" class="t_kategori_kategori"><div class="ew-table-header-caption"><?php echo $t_kategori_list->kategori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kategori" class="<?php echo $t_kategori_list->kategori->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kategori_list->SortUrl($t_kategori_list->kategori) ?>', 1);"><div id="elh_t_kategori_kategori" class="t_kategori_kategori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kategori_list->kategori->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kategori_list->kategori->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kategori_list->kategori->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_kategori_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_kategori_list->ExportAll && $t_kategori_list->isExport()) {
	$t_kategori_list->StopRecord = $t_kategori_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_kategori_list->TotalRecords > $t_kategori_list->StartRecord + $t_kategori_list->DisplayRecords - 1)
		$t_kategori_list->StopRecord = $t_kategori_list->StartRecord + $t_kategori_list->DisplayRecords - 1;
	else
		$t_kategori_list->StopRecord = $t_kategori_list->TotalRecords;
}
$t_kategori_list->RecordCount = $t_kategori_list->StartRecord - 1;
if ($t_kategori_list->Recordset && !$t_kategori_list->Recordset->EOF) {
	$t_kategori_list->Recordset->moveFirst();
	$selectLimit = $t_kategori_list->UseSelectLimit;
	if (!$selectLimit && $t_kategori_list->StartRecord > 1)
		$t_kategori_list->Recordset->move($t_kategori_list->StartRecord - 1);
} elseif (!$t_kategori->AllowAddDeleteRow && $t_kategori_list->StopRecord == 0) {
	$t_kategori_list->StopRecord = $t_kategori->GridAddRowCount;
}

// Initialize aggregate
$t_kategori->RowType = ROWTYPE_AGGREGATEINIT;
$t_kategori->resetAttributes();
$t_kategori_list->renderRow();
while ($t_kategori_list->RecordCount < $t_kategori_list->StopRecord) {
	$t_kategori_list->RecordCount++;
	if ($t_kategori_list->RecordCount >= $t_kategori_list->StartRecord) {
		$t_kategori_list->RowCount++;

		// Set up key count
		$t_kategori_list->KeyCount = $t_kategori_list->RowIndex;

		// Init row class and style
		$t_kategori->resetAttributes();
		$t_kategori->CssClass = "";
		if ($t_kategori_list->isGridAdd()) {
		} else {
			$t_kategori_list->loadRowValues($t_kategori_list->Recordset); // Load row values
		}
		$t_kategori->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_kategori->RowAttrs->merge(["data-rowindex" => $t_kategori_list->RowCount, "id" => "r" . $t_kategori_list->RowCount . "_t_kategori", "data-rowtype" => $t_kategori->RowType]);

		// Render row
		$t_kategori_list->renderRow();

		// Render list options
		$t_kategori_list->renderListOptions();
?>
	<tr <?php echo $t_kategori->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_kategori_list->ListOptions->render("body", "left", $t_kategori_list->RowCount);
?>
	<?php if ($t_kategori_list->kdkategori->Visible) { // kdkategori ?>
		<td data-name="kdkategori" <?php echo $t_kategori_list->kdkategori->cellAttributes() ?>>
<span id="el<?php echo $t_kategori_list->RowCount ?>_t_kategori_kdkategori">
<span<?php echo $t_kategori_list->kdkategori->viewAttributes() ?>><?php echo $t_kategori_list->kdkategori->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_kategori_list->kategori->Visible) { // kategori ?>
		<td data-name="kategori" <?php echo $t_kategori_list->kategori->cellAttributes() ?>>
<span id="el<?php echo $t_kategori_list->RowCount ?>_t_kategori_kategori">
<span<?php echo $t_kategori_list->kategori->viewAttributes() ?>><?php echo $t_kategori_list->kategori->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_kategori_list->ListOptions->render("body", "right", $t_kategori_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_kategori_list->isGridAdd())
		$t_kategori_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_kategori->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_kategori_list->Recordset)
	$t_kategori_list->Recordset->Close();
?>
<?php if (!$t_kategori_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_kategori_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_kategori_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_kategori_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_kategori_list->TotalRecords == 0 && !$t_kategori->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_kategori_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_kategori_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_kategori_list->isExport()) { ?>
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
$t_kategori_list->terminate();
?>