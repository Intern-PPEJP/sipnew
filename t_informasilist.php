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
$t_informasi_list = new t_informasi_list();

// Run the page
$t_informasi_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_informasi_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_informasi_list->isExport()) { ?>
<script>
var ft_informasilist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_informasilist = currentForm = new ew.Form("ft_informasilist", "list");
	ft_informasilist.formKeyCountName = '<?php echo $t_informasi_list->FormKeyCountName ?>';
	loadjs.done("ft_informasilist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_informasi_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_informasi_list->TotalRecords > 0 && $t_informasi_list->ExportOptions->visible()) { ?>
<?php $t_informasi_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_informasi_list->ImportOptions->visible()) { ?>
<?php $t_informasi_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_informasi_list->renderOtherOptions();
?>
<?php $t_informasi_list->showPageHeader(); ?>
<?php
$t_informasi_list->showMessage();
?>
<?php if ($t_informasi_list->TotalRecords > 0 || $t_informasi->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_informasi_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_informasi">
<?php if (!$t_informasi_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_informasi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_informasi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_informasi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_informasilist" id="ft_informasilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_informasi">
<div id="gmp_t_informasi" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_informasi_list->TotalRecords > 0 || $t_informasi_list->isGridEdit()) { ?>
<table id="tbl_t_informasilist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_informasi->RowType = ROWTYPE_HEADER;

// Render list options
$t_informasi_list->renderListOptions();

// Render list options (header, left)
$t_informasi_list->ListOptions->render("header", "left");
?>
<?php if ($t_informasi_list->kdinformasi->Visible) { // kdinformasi ?>
	<?php if ($t_informasi_list->SortUrl($t_informasi_list->kdinformasi) == "") { ?>
		<th data-name="kdinformasi" class="<?php echo $t_informasi_list->kdinformasi->headerCellClass() ?>"><div id="elh_t_informasi_kdinformasi" class="t_informasi_kdinformasi"><div class="ew-table-header-caption"><?php echo $t_informasi_list->kdinformasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdinformasi" class="<?php echo $t_informasi_list->kdinformasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_informasi_list->SortUrl($t_informasi_list->kdinformasi) ?>', 1);"><div id="elh_t_informasi_kdinformasi" class="t_informasi_kdinformasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_informasi_list->kdinformasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_informasi_list->kdinformasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_informasi_list->kdinformasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_informasi_list->informasi->Visible) { // informasi ?>
	<?php if ($t_informasi_list->SortUrl($t_informasi_list->informasi) == "") { ?>
		<th data-name="informasi" class="<?php echo $t_informasi_list->informasi->headerCellClass() ?>"><div id="elh_t_informasi_informasi" class="t_informasi_informasi"><div class="ew-table-header-caption"><?php echo $t_informasi_list->informasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="informasi" class="<?php echo $t_informasi_list->informasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_informasi_list->SortUrl($t_informasi_list->informasi) ?>', 1);"><div id="elh_t_informasi_informasi" class="t_informasi_informasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_informasi_list->informasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_informasi_list->informasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_informasi_list->informasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_informasi_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_informasi_list->ExportAll && $t_informasi_list->isExport()) {
	$t_informasi_list->StopRecord = $t_informasi_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_informasi_list->TotalRecords > $t_informasi_list->StartRecord + $t_informasi_list->DisplayRecords - 1)
		$t_informasi_list->StopRecord = $t_informasi_list->StartRecord + $t_informasi_list->DisplayRecords - 1;
	else
		$t_informasi_list->StopRecord = $t_informasi_list->TotalRecords;
}
$t_informasi_list->RecordCount = $t_informasi_list->StartRecord - 1;
if ($t_informasi_list->Recordset && !$t_informasi_list->Recordset->EOF) {
	$t_informasi_list->Recordset->moveFirst();
	$selectLimit = $t_informasi_list->UseSelectLimit;
	if (!$selectLimit && $t_informasi_list->StartRecord > 1)
		$t_informasi_list->Recordset->move($t_informasi_list->StartRecord - 1);
} elseif (!$t_informasi->AllowAddDeleteRow && $t_informasi_list->StopRecord == 0) {
	$t_informasi_list->StopRecord = $t_informasi->GridAddRowCount;
}

// Initialize aggregate
$t_informasi->RowType = ROWTYPE_AGGREGATEINIT;
$t_informasi->resetAttributes();
$t_informasi_list->renderRow();
while ($t_informasi_list->RecordCount < $t_informasi_list->StopRecord) {
	$t_informasi_list->RecordCount++;
	if ($t_informasi_list->RecordCount >= $t_informasi_list->StartRecord) {
		$t_informasi_list->RowCount++;

		// Set up key count
		$t_informasi_list->KeyCount = $t_informasi_list->RowIndex;

		// Init row class and style
		$t_informasi->resetAttributes();
		$t_informasi->CssClass = "";
		if ($t_informasi_list->isGridAdd()) {
		} else {
			$t_informasi_list->loadRowValues($t_informasi_list->Recordset); // Load row values
		}
		$t_informasi->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_informasi->RowAttrs->merge(["data-rowindex" => $t_informasi_list->RowCount, "id" => "r" . $t_informasi_list->RowCount . "_t_informasi", "data-rowtype" => $t_informasi->RowType]);

		// Render row
		$t_informasi_list->renderRow();

		// Render list options
		$t_informasi_list->renderListOptions();
?>
	<tr <?php echo $t_informasi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_informasi_list->ListOptions->render("body", "left", $t_informasi_list->RowCount);
?>
	<?php if ($t_informasi_list->kdinformasi->Visible) { // kdinformasi ?>
		<td data-name="kdinformasi" <?php echo $t_informasi_list->kdinformasi->cellAttributes() ?>>
<span id="el<?php echo $t_informasi_list->RowCount ?>_t_informasi_kdinformasi">
<span<?php echo $t_informasi_list->kdinformasi->viewAttributes() ?>><?php echo $t_informasi_list->kdinformasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_informasi_list->informasi->Visible) { // informasi ?>
		<td data-name="informasi" <?php echo $t_informasi_list->informasi->cellAttributes() ?>>
<span id="el<?php echo $t_informasi_list->RowCount ?>_t_informasi_informasi">
<span<?php echo $t_informasi_list->informasi->viewAttributes() ?>><?php echo $t_informasi_list->informasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_informasi_list->ListOptions->render("body", "right", $t_informasi_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_informasi_list->isGridAdd())
		$t_informasi_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_informasi->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_informasi_list->Recordset)
	$t_informasi_list->Recordset->Close();
?>
<?php if (!$t_informasi_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_informasi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_informasi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_informasi_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_informasi_list->TotalRecords == 0 && !$t_informasi->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_informasi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_informasi_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_informasi_list->isExport()) { ?>
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
$t_informasi_list->terminate();
?>