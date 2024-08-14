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
$t_bidang_list = new t_bidang_list();

// Run the page
$t_bidang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_bidang_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_bidang_list->isExport()) { ?>
<script>
var ft_bidanglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_bidanglist = currentForm = new ew.Form("ft_bidanglist", "list");
	ft_bidanglist.formKeyCountName = '<?php echo $t_bidang_list->FormKeyCountName ?>';
	loadjs.done("ft_bidanglist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//document.write('<?php echo cs_judul("list","Daftar Bidang");?>');

});
</script>
<?php } ?>
<?php if (!$t_bidang_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_bidang_list->TotalRecords > 0 && $t_bidang_list->ExportOptions->visible()) { ?>
<?php $t_bidang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_bidang_list->ImportOptions->visible()) { ?>
<?php $t_bidang_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_bidang_list->renderOtherOptions();
?>
<?php $t_bidang_list->showPageHeader(); ?>
<?php
$t_bidang_list->showMessage();
?>
<?php if ($t_bidang_list->TotalRecords > 0 || $t_bidang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_bidang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_bidang">
<?php if (!$t_bidang_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_bidang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_bidang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_bidang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_bidanglist" id="ft_bidanglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_bidang">
<div id="gmp_t_bidang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_bidang_list->TotalRecords > 0 || $t_bidang_list->isGridEdit()) { ?>
<table id="tbl_t_bidanglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_bidang->RowType = ROWTYPE_HEADER;

// Render list options
$t_bidang_list->renderListOptions();

// Render list options (header, left)
$t_bidang_list->ListOptions->render("header", "left");
?>
<?php if ($t_bidang_list->kdbidang->Visible) { // kdbidang ?>
	<?php if ($t_bidang_list->SortUrl($t_bidang_list->kdbidang) == "") { ?>
		<th data-name="kdbidang" class="<?php echo $t_bidang_list->kdbidang->headerCellClass() ?>"><div id="elh_t_bidang_kdbidang" class="t_bidang_kdbidang"><div class="ew-table-header-caption"><?php echo $t_bidang_list->kdbidang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdbidang" class="<?php echo $t_bidang_list->kdbidang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_bidang_list->SortUrl($t_bidang_list->kdbidang) ?>', 1);"><div id="elh_t_bidang_kdbidang" class="t_bidang_kdbidang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_bidang_list->kdbidang->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_bidang_list->kdbidang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_bidang_list->kdbidang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_bidang_list->bidang->Visible) { // bidang ?>
	<?php if ($t_bidang_list->SortUrl($t_bidang_list->bidang) == "") { ?>
		<th data-name="bidang" class="<?php echo $t_bidang_list->bidang->headerCellClass() ?>"><div id="elh_t_bidang_bidang" class="t_bidang_bidang"><div class="ew-table-header-caption"><?php echo $t_bidang_list->bidang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bidang" class="<?php echo $t_bidang_list->bidang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_bidang_list->SortUrl($t_bidang_list->bidang) ?>', 1);"><div id="elh_t_bidang_bidang" class="t_bidang_bidang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_bidang_list->bidang->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_bidang_list->bidang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_bidang_list->bidang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_bidang_list->singkatan->Visible) { // singkatan ?>
	<?php if ($t_bidang_list->SortUrl($t_bidang_list->singkatan) == "") { ?>
		<th data-name="singkatan" class="<?php echo $t_bidang_list->singkatan->headerCellClass() ?>"><div id="elh_t_bidang_singkatan" class="t_bidang_singkatan"><div class="ew-table-header-caption"><?php echo $t_bidang_list->singkatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="singkatan" class="<?php echo $t_bidang_list->singkatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_bidang_list->SortUrl($t_bidang_list->singkatan) ?>', 1);"><div id="elh_t_bidang_singkatan" class="t_bidang_singkatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_bidang_list->singkatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_bidang_list->singkatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_bidang_list->singkatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_bidang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_bidang_list->ExportAll && $t_bidang_list->isExport()) {
	$t_bidang_list->StopRecord = $t_bidang_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_bidang_list->TotalRecords > $t_bidang_list->StartRecord + $t_bidang_list->DisplayRecords - 1)
		$t_bidang_list->StopRecord = $t_bidang_list->StartRecord + $t_bidang_list->DisplayRecords - 1;
	else
		$t_bidang_list->StopRecord = $t_bidang_list->TotalRecords;
}
$t_bidang_list->RecordCount = $t_bidang_list->StartRecord - 1;
if ($t_bidang_list->Recordset && !$t_bidang_list->Recordset->EOF) {
	$t_bidang_list->Recordset->moveFirst();
	$selectLimit = $t_bidang_list->UseSelectLimit;
	if (!$selectLimit && $t_bidang_list->StartRecord > 1)
		$t_bidang_list->Recordset->move($t_bidang_list->StartRecord - 1);
} elseif (!$t_bidang->AllowAddDeleteRow && $t_bidang_list->StopRecord == 0) {
	$t_bidang_list->StopRecord = $t_bidang->GridAddRowCount;
}

// Initialize aggregate
$t_bidang->RowType = ROWTYPE_AGGREGATEINIT;
$t_bidang->resetAttributes();
$t_bidang_list->renderRow();
while ($t_bidang_list->RecordCount < $t_bidang_list->StopRecord) {
	$t_bidang_list->RecordCount++;
	if ($t_bidang_list->RecordCount >= $t_bidang_list->StartRecord) {
		$t_bidang_list->RowCount++;

		// Set up key count
		$t_bidang_list->KeyCount = $t_bidang_list->RowIndex;

		// Init row class and style
		$t_bidang->resetAttributes();
		$t_bidang->CssClass = "";
		if ($t_bidang_list->isGridAdd()) {
		} else {
			$t_bidang_list->loadRowValues($t_bidang_list->Recordset); // Load row values
		}
		$t_bidang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_bidang->RowAttrs->merge(["data-rowindex" => $t_bidang_list->RowCount, "id" => "r" . $t_bidang_list->RowCount . "_t_bidang", "data-rowtype" => $t_bidang->RowType]);

		// Render row
		$t_bidang_list->renderRow();

		// Render list options
		$t_bidang_list->renderListOptions();
?>
	<tr <?php echo $t_bidang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_bidang_list->ListOptions->render("body", "left", $t_bidang_list->RowCount);
?>
	<?php if ($t_bidang_list->kdbidang->Visible) { // kdbidang ?>
		<td data-name="kdbidang" <?php echo $t_bidang_list->kdbidang->cellAttributes() ?>>
<span id="el<?php echo $t_bidang_list->RowCount ?>_t_bidang_kdbidang">
<span<?php echo $t_bidang_list->kdbidang->viewAttributes() ?>><?php echo $t_bidang_list->kdbidang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_bidang_list->bidang->Visible) { // bidang ?>
		<td data-name="bidang" <?php echo $t_bidang_list->bidang->cellAttributes() ?>>
<span id="el<?php echo $t_bidang_list->RowCount ?>_t_bidang_bidang">
<span<?php echo $t_bidang_list->bidang->viewAttributes() ?>><?php echo $t_bidang_list->bidang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_bidang_list->singkatan->Visible) { // singkatan ?>
		<td data-name="singkatan" <?php echo $t_bidang_list->singkatan->cellAttributes() ?>>
<span id="el<?php echo $t_bidang_list->RowCount ?>_t_bidang_singkatan">
<span<?php echo $t_bidang_list->singkatan->viewAttributes() ?>><?php echo $t_bidang_list->singkatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_bidang_list->ListOptions->render("body", "right", $t_bidang_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_bidang_list->isGridAdd())
		$t_bidang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_bidang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_bidang_list->Recordset)
	$t_bidang_list->Recordset->Close();
?>
<?php if (!$t_bidang_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_bidang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_bidang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_bidang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_bidang_list->TotalRecords == 0 && !$t_bidang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_bidang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_bidang_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_bidang_list->isExport()) { ?>
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
$t_bidang_list->terminate();
?>