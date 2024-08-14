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
$t_bahasa_list = new t_bahasa_list();

// Run the page
$t_bahasa_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_bahasa_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_bahasa_list->isExport()) { ?>
<script>
var ft_bahasalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_bahasalist = currentForm = new ew.Form("ft_bahasalist", "list");
	ft_bahasalist.formKeyCountName = '<?php echo $t_bahasa_list->FormKeyCountName ?>';
	loadjs.done("ft_bahasalist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//document.write('<?php echo cs_judul("list","Daftar Bahasa");?>');

});
</script>
<?php } ?>
<?php if (!$t_bahasa_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_bahasa_list->TotalRecords > 0 && $t_bahasa_list->ExportOptions->visible()) { ?>
<?php $t_bahasa_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_bahasa_list->ImportOptions->visible()) { ?>
<?php $t_bahasa_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_bahasa_list->renderOtherOptions();
?>
<?php $t_bahasa_list->showPageHeader(); ?>
<?php
$t_bahasa_list->showMessage();
?>
<?php if ($t_bahasa_list->TotalRecords > 0 || $t_bahasa->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_bahasa_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_bahasa">
<?php if (!$t_bahasa_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_bahasa_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_bahasa_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_bahasa_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_bahasalist" id="ft_bahasalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_bahasa">
<div id="gmp_t_bahasa" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_bahasa_list->TotalRecords > 0 || $t_bahasa_list->isGridEdit()) { ?>
<table id="tbl_t_bahasalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_bahasa->RowType = ROWTYPE_HEADER;

// Render list options
$t_bahasa_list->renderListOptions();

// Render list options (header, left)
$t_bahasa_list->ListOptions->render("header", "left");
?>
<?php if ($t_bahasa_list->kdbahasa->Visible) { // kdbahasa ?>
	<?php if ($t_bahasa_list->SortUrl($t_bahasa_list->kdbahasa) == "") { ?>
		<th data-name="kdbahasa" class="<?php echo $t_bahasa_list->kdbahasa->headerCellClass() ?>"><div id="elh_t_bahasa_kdbahasa" class="t_bahasa_kdbahasa"><div class="ew-table-header-caption"><?php echo $t_bahasa_list->kdbahasa->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdbahasa" class="<?php echo $t_bahasa_list->kdbahasa->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_bahasa_list->SortUrl($t_bahasa_list->kdbahasa) ?>', 1);"><div id="elh_t_bahasa_kdbahasa" class="t_bahasa_kdbahasa">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_bahasa_list->kdbahasa->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_bahasa_list->kdbahasa->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_bahasa_list->kdbahasa->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_bahasa_list->bahasa->Visible) { // bahasa ?>
	<?php if ($t_bahasa_list->SortUrl($t_bahasa_list->bahasa) == "") { ?>
		<th data-name="bahasa" class="<?php echo $t_bahasa_list->bahasa->headerCellClass() ?>"><div id="elh_t_bahasa_bahasa" class="t_bahasa_bahasa"><div class="ew-table-header-caption"><?php echo $t_bahasa_list->bahasa->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bahasa" class="<?php echo $t_bahasa_list->bahasa->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_bahasa_list->SortUrl($t_bahasa_list->bahasa) ?>', 1);"><div id="elh_t_bahasa_bahasa" class="t_bahasa_bahasa">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_bahasa_list->bahasa->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_bahasa_list->bahasa->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_bahasa_list->bahasa->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_bahasa_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_bahasa_list->ExportAll && $t_bahasa_list->isExport()) {
	$t_bahasa_list->StopRecord = $t_bahasa_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_bahasa_list->TotalRecords > $t_bahasa_list->StartRecord + $t_bahasa_list->DisplayRecords - 1)
		$t_bahasa_list->StopRecord = $t_bahasa_list->StartRecord + $t_bahasa_list->DisplayRecords - 1;
	else
		$t_bahasa_list->StopRecord = $t_bahasa_list->TotalRecords;
}
$t_bahasa_list->RecordCount = $t_bahasa_list->StartRecord - 1;
if ($t_bahasa_list->Recordset && !$t_bahasa_list->Recordset->EOF) {
	$t_bahasa_list->Recordset->moveFirst();
	$selectLimit = $t_bahasa_list->UseSelectLimit;
	if (!$selectLimit && $t_bahasa_list->StartRecord > 1)
		$t_bahasa_list->Recordset->move($t_bahasa_list->StartRecord - 1);
} elseif (!$t_bahasa->AllowAddDeleteRow && $t_bahasa_list->StopRecord == 0) {
	$t_bahasa_list->StopRecord = $t_bahasa->GridAddRowCount;
}

// Initialize aggregate
$t_bahasa->RowType = ROWTYPE_AGGREGATEINIT;
$t_bahasa->resetAttributes();
$t_bahasa_list->renderRow();
while ($t_bahasa_list->RecordCount < $t_bahasa_list->StopRecord) {
	$t_bahasa_list->RecordCount++;
	if ($t_bahasa_list->RecordCount >= $t_bahasa_list->StartRecord) {
		$t_bahasa_list->RowCount++;

		// Set up key count
		$t_bahasa_list->KeyCount = $t_bahasa_list->RowIndex;

		// Init row class and style
		$t_bahasa->resetAttributes();
		$t_bahasa->CssClass = "";
		if ($t_bahasa_list->isGridAdd()) {
		} else {
			$t_bahasa_list->loadRowValues($t_bahasa_list->Recordset); // Load row values
		}
		$t_bahasa->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_bahasa->RowAttrs->merge(["data-rowindex" => $t_bahasa_list->RowCount, "id" => "r" . $t_bahasa_list->RowCount . "_t_bahasa", "data-rowtype" => $t_bahasa->RowType]);

		// Render row
		$t_bahasa_list->renderRow();

		// Render list options
		$t_bahasa_list->renderListOptions();
?>
	<tr <?php echo $t_bahasa->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_bahasa_list->ListOptions->render("body", "left", $t_bahasa_list->RowCount);
?>
	<?php if ($t_bahasa_list->kdbahasa->Visible) { // kdbahasa ?>
		<td data-name="kdbahasa" <?php echo $t_bahasa_list->kdbahasa->cellAttributes() ?>>
<span id="el<?php echo $t_bahasa_list->RowCount ?>_t_bahasa_kdbahasa">
<span<?php echo $t_bahasa_list->kdbahasa->viewAttributes() ?>><?php echo $t_bahasa_list->kdbahasa->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_bahasa_list->bahasa->Visible) { // bahasa ?>
		<td data-name="bahasa" <?php echo $t_bahasa_list->bahasa->cellAttributes() ?>>
<span id="el<?php echo $t_bahasa_list->RowCount ?>_t_bahasa_bahasa">
<span<?php echo $t_bahasa_list->bahasa->viewAttributes() ?>><?php echo $t_bahasa_list->bahasa->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_bahasa_list->ListOptions->render("body", "right", $t_bahasa_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_bahasa_list->isGridAdd())
		$t_bahasa_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_bahasa->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_bahasa_list->Recordset)
	$t_bahasa_list->Recordset->Close();
?>
<?php if (!$t_bahasa_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_bahasa_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_bahasa_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_bahasa_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_bahasa_list->TotalRecords == 0 && !$t_bahasa->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_bahasa_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_bahasa_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_bahasa_list->isExport()) { ?>
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
$t_bahasa_list->terminate();
?>