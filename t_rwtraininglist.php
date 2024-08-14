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
$t_rwtraining_list = new t_rwtraining_list();

// Run the page
$t_rwtraining_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rwtraining_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_rwtraining_list->isExport()) { ?>
<script>
var ft_rwtraininglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_rwtraininglist = currentForm = new ew.Form("ft_rwtraininglist", "list");
	ft_rwtraininglist.formKeyCountName = '<?php echo $t_rwtraining_list->FormKeyCountName ?>';
	loadjs.done("ft_rwtraininglist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_rwtraining_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_rwtraining_list->TotalRecords > 0 && $t_rwtraining_list->ExportOptions->visible()) { ?>
<?php $t_rwtraining_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_rwtraining_list->ImportOptions->visible()) { ?>
<?php $t_rwtraining_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$t_rwtraining_list->isExport() || Config("EXPORT_MASTER_RECORD") && $t_rwtraining_list->isExport("print")) { ?>
<?php
if ($t_rwtraining_list->DbMasterFilter != "" && $t_rwtraining->getCurrentMasterTable() == "t_biointruktur") {
	if ($t_rwtraining_list->MasterRecordExists) {
		include_once "t_biointrukturmaster.php";
	}
}
?>
<?php } ?>
<?php
$t_rwtraining_list->renderOtherOptions();
?>
<?php $t_rwtraining_list->showPageHeader(); ?>
<?php
$t_rwtraining_list->showMessage();
?>
<?php if ($t_rwtraining_list->TotalRecords > 0 || $t_rwtraining->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_rwtraining_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_rwtraining">
<?php if (!$t_rwtraining_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_rwtraining_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_rwtraining_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_rwtraining_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_rwtraininglist" id="ft_rwtraininglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rwtraining">
<?php if ($t_rwtraining->getCurrentMasterTable() == "t_biointruktur" && $t_rwtraining->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_biointruktur">
<input type="hidden" name="fk_bioid" value="<?php echo HtmlEncode($t_rwtraining_list->bioid->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_t_rwtraining" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_rwtraining_list->TotalRecords > 0 || $t_rwtraining_list->isGridEdit()) { ?>
<table id="tbl_t_rwtraininglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_rwtraining->RowType = ROWTYPE_HEADER;

// Render list options
$t_rwtraining_list->renderListOptions();

// Render list options (header, left)
$t_rwtraining_list->ListOptions->render("header", "left");
?>
<?php if ($t_rwtraining_list->rwtrainingid->Visible) { // rwtrainingid ?>
	<?php if ($t_rwtraining_list->SortUrl($t_rwtraining_list->rwtrainingid) == "") { ?>
		<th data-name="rwtrainingid" class="<?php echo $t_rwtraining_list->rwtrainingid->headerCellClass() ?>"><div id="elh_t_rwtraining_rwtrainingid" class="t_rwtraining_rwtrainingid"><div class="ew-table-header-caption"><?php echo $t_rwtraining_list->rwtrainingid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rwtrainingid" class="<?php echo $t_rwtraining_list->rwtrainingid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rwtraining_list->SortUrl($t_rwtraining_list->rwtrainingid) ?>', 1);"><div id="elh_t_rwtraining_rwtrainingid" class="t_rwtraining_rwtrainingid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwtraining_list->rwtrainingid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwtraining_list->rwtrainingid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwtraining_list->rwtrainingid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwtraining_list->bioid->Visible) { // bioid ?>
	<?php if ($t_rwtraining_list->SortUrl($t_rwtraining_list->bioid) == "") { ?>
		<th data-name="bioid" class="<?php echo $t_rwtraining_list->bioid->headerCellClass() ?>"><div id="elh_t_rwtraining_bioid" class="t_rwtraining_bioid"><div class="ew-table-header-caption"><?php echo $t_rwtraining_list->bioid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bioid" class="<?php echo $t_rwtraining_list->bioid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rwtraining_list->SortUrl($t_rwtraining_list->bioid) ?>', 1);"><div id="elh_t_rwtraining_bioid" class="t_rwtraining_bioid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwtraining_list->bioid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwtraining_list->bioid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwtraining_list->bioid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwtraining_list->training->Visible) { // training ?>
	<?php if ($t_rwtraining_list->SortUrl($t_rwtraining_list->training) == "") { ?>
		<th data-name="training" class="<?php echo $t_rwtraining_list->training->headerCellClass() ?>"><div id="elh_t_rwtraining_training" class="t_rwtraining_training"><div class="ew-table-header-caption"><?php echo $t_rwtraining_list->training->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="training" class="<?php echo $t_rwtraining_list->training->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rwtraining_list->SortUrl($t_rwtraining_list->training) ?>', 1);"><div id="elh_t_rwtraining_training" class="t_rwtraining_training">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwtraining_list->training->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwtraining_list->training->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwtraining_list->training->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwtraining_list->tempat->Visible) { // tempat ?>
	<?php if ($t_rwtraining_list->SortUrl($t_rwtraining_list->tempat) == "") { ?>
		<th data-name="tempat" class="<?php echo $t_rwtraining_list->tempat->headerCellClass() ?>"><div id="elh_t_rwtraining_tempat" class="t_rwtraining_tempat"><div class="ew-table-header-caption"><?php echo $t_rwtraining_list->tempat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tempat" class="<?php echo $t_rwtraining_list->tempat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rwtraining_list->SortUrl($t_rwtraining_list->tempat) ?>', 1);"><div id="elh_t_rwtraining_tempat" class="t_rwtraining_tempat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwtraining_list->tempat->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwtraining_list->tempat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwtraining_list->tempat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwtraining_list->tahun->Visible) { // tahun ?>
	<?php if ($t_rwtraining_list->SortUrl($t_rwtraining_list->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $t_rwtraining_list->tahun->headerCellClass() ?>"><div id="elh_t_rwtraining_tahun" class="t_rwtraining_tahun"><div class="ew-table-header-caption"><?php echo $t_rwtraining_list->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $t_rwtraining_list->tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rwtraining_list->SortUrl($t_rwtraining_list->tahun) ?>', 1);"><div id="elh_t_rwtraining_tahun" class="t_rwtraining_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwtraining_list->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwtraining_list->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwtraining_list->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_rwtraining_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_rwtraining_list->ExportAll && $t_rwtraining_list->isExport()) {
	$t_rwtraining_list->StopRecord = $t_rwtraining_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_rwtraining_list->TotalRecords > $t_rwtraining_list->StartRecord + $t_rwtraining_list->DisplayRecords - 1)
		$t_rwtraining_list->StopRecord = $t_rwtraining_list->StartRecord + $t_rwtraining_list->DisplayRecords - 1;
	else
		$t_rwtraining_list->StopRecord = $t_rwtraining_list->TotalRecords;
}
$t_rwtraining_list->RecordCount = $t_rwtraining_list->StartRecord - 1;
if ($t_rwtraining_list->Recordset && !$t_rwtraining_list->Recordset->EOF) {
	$t_rwtraining_list->Recordset->moveFirst();
	$selectLimit = $t_rwtraining_list->UseSelectLimit;
	if (!$selectLimit && $t_rwtraining_list->StartRecord > 1)
		$t_rwtraining_list->Recordset->move($t_rwtraining_list->StartRecord - 1);
} elseif (!$t_rwtraining->AllowAddDeleteRow && $t_rwtraining_list->StopRecord == 0) {
	$t_rwtraining_list->StopRecord = $t_rwtraining->GridAddRowCount;
}

// Initialize aggregate
$t_rwtraining->RowType = ROWTYPE_AGGREGATEINIT;
$t_rwtraining->resetAttributes();
$t_rwtraining_list->renderRow();
while ($t_rwtraining_list->RecordCount < $t_rwtraining_list->StopRecord) {
	$t_rwtraining_list->RecordCount++;
	if ($t_rwtraining_list->RecordCount >= $t_rwtraining_list->StartRecord) {
		$t_rwtraining_list->RowCount++;

		// Set up key count
		$t_rwtraining_list->KeyCount = $t_rwtraining_list->RowIndex;

		// Init row class and style
		$t_rwtraining->resetAttributes();
		$t_rwtraining->CssClass = "";
		if ($t_rwtraining_list->isGridAdd()) {
		} else {
			$t_rwtraining_list->loadRowValues($t_rwtraining_list->Recordset); // Load row values
		}
		$t_rwtraining->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_rwtraining->RowAttrs->merge(["data-rowindex" => $t_rwtraining_list->RowCount, "id" => "r" . $t_rwtraining_list->RowCount . "_t_rwtraining", "data-rowtype" => $t_rwtraining->RowType]);

		// Render row
		$t_rwtraining_list->renderRow();

		// Render list options
		$t_rwtraining_list->renderListOptions();
?>
	<tr <?php echo $t_rwtraining->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_rwtraining_list->ListOptions->render("body", "left", $t_rwtraining_list->RowCount);
?>
	<?php if ($t_rwtraining_list->rwtrainingid->Visible) { // rwtrainingid ?>
		<td data-name="rwtrainingid" <?php echo $t_rwtraining_list->rwtrainingid->cellAttributes() ?>>
<span id="el<?php echo $t_rwtraining_list->RowCount ?>_t_rwtraining_rwtrainingid">
<span<?php echo $t_rwtraining_list->rwtrainingid->viewAttributes() ?>><?php echo $t_rwtraining_list->rwtrainingid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rwtraining_list->bioid->Visible) { // bioid ?>
		<td data-name="bioid" <?php echo $t_rwtraining_list->bioid->cellAttributes() ?>>
<span id="el<?php echo $t_rwtraining_list->RowCount ?>_t_rwtraining_bioid">
<span<?php echo $t_rwtraining_list->bioid->viewAttributes() ?>><?php echo $t_rwtraining_list->bioid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rwtraining_list->training->Visible) { // training ?>
		<td data-name="training" <?php echo $t_rwtraining_list->training->cellAttributes() ?>>
<span id="el<?php echo $t_rwtraining_list->RowCount ?>_t_rwtraining_training">
<span<?php echo $t_rwtraining_list->training->viewAttributes() ?>><?php echo $t_rwtraining_list->training->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rwtraining_list->tempat->Visible) { // tempat ?>
		<td data-name="tempat" <?php echo $t_rwtraining_list->tempat->cellAttributes() ?>>
<span id="el<?php echo $t_rwtraining_list->RowCount ?>_t_rwtraining_tempat">
<span<?php echo $t_rwtraining_list->tempat->viewAttributes() ?>><?php echo $t_rwtraining_list->tempat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rwtraining_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $t_rwtraining_list->tahun->cellAttributes() ?>>
<span id="el<?php echo $t_rwtraining_list->RowCount ?>_t_rwtraining_tahun">
<span<?php echo $t_rwtraining_list->tahun->viewAttributes() ?>><?php echo $t_rwtraining_list->tahun->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_rwtraining_list->ListOptions->render("body", "right", $t_rwtraining_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_rwtraining_list->isGridAdd())
		$t_rwtraining_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_rwtraining->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_rwtraining_list->Recordset)
	$t_rwtraining_list->Recordset->Close();
?>
<?php if (!$t_rwtraining_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_rwtraining_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_rwtraining_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_rwtraining_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_rwtraining_list->TotalRecords == 0 && !$t_rwtraining->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_rwtraining_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_rwtraining_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_rwtraining_list->isExport()) { ?>
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
$t_rwtraining_list->terminate();
?>