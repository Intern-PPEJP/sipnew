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
$t_rwpendd_list = new t_rwpendd_list();

// Run the page
$t_rwpendd_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rwpendd_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_rwpendd_list->isExport()) { ?>
<script>
var ft_rwpenddlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_rwpenddlist = currentForm = new ew.Form("ft_rwpenddlist", "list");
	ft_rwpenddlist.formKeyCountName = '<?php echo $t_rwpendd_list->FormKeyCountName ?>';
	loadjs.done("ft_rwpenddlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_rwpendd_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_rwpendd_list->TotalRecords > 0 && $t_rwpendd_list->ExportOptions->visible()) { ?>
<?php $t_rwpendd_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_rwpendd_list->ImportOptions->visible()) { ?>
<?php $t_rwpendd_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$t_rwpendd_list->isExport() || Config("EXPORT_MASTER_RECORD") && $t_rwpendd_list->isExport("print")) { ?>
<?php
if ($t_rwpendd_list->DbMasterFilter != "" && $t_rwpendd->getCurrentMasterTable() == "t_biointruktur") {
	if ($t_rwpendd_list->MasterRecordExists) {
		include_once "t_biointrukturmaster.php";
	}
}
?>
<?php } ?>
<?php
$t_rwpendd_list->renderOtherOptions();
?>
<?php $t_rwpendd_list->showPageHeader(); ?>
<?php
$t_rwpendd_list->showMessage();
?>
<?php if ($t_rwpendd_list->TotalRecords > 0 || $t_rwpendd->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_rwpendd_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_rwpendd">
<?php if (!$t_rwpendd_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_rwpendd_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_rwpendd_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_rwpendd_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_rwpenddlist" id="ft_rwpenddlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rwpendd">
<?php if ($t_rwpendd->getCurrentMasterTable() == "t_biointruktur" && $t_rwpendd->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_biointruktur">
<input type="hidden" name="fk_bioid" value="<?php echo HtmlEncode($t_rwpendd_list->bioid->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_t_rwpendd" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_rwpendd_list->TotalRecords > 0 || $t_rwpendd_list->isGridEdit()) { ?>
<table id="tbl_t_rwpenddlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_rwpendd->RowType = ROWTYPE_HEADER;

// Render list options
$t_rwpendd_list->renderListOptions();

// Render list options (header, left)
$t_rwpendd_list->ListOptions->render("header", "left");
?>
<?php if ($t_rwpendd_list->penddid->Visible) { // penddid ?>
	<?php if ($t_rwpendd_list->SortUrl($t_rwpendd_list->penddid) == "") { ?>
		<th data-name="penddid" class="<?php echo $t_rwpendd_list->penddid->headerCellClass() ?>"><div id="elh_t_rwpendd_penddid" class="t_rwpendd_penddid"><div class="ew-table-header-caption"><?php echo $t_rwpendd_list->penddid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="penddid" class="<?php echo $t_rwpendd_list->penddid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rwpendd_list->SortUrl($t_rwpendd_list->penddid) ?>', 1);"><div id="elh_t_rwpendd_penddid" class="t_rwpendd_penddid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwpendd_list->penddid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwpendd_list->penddid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwpendd_list->penddid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwpendd_list->bioid->Visible) { // bioid ?>
	<?php if ($t_rwpendd_list->SortUrl($t_rwpendd_list->bioid) == "") { ?>
		<th data-name="bioid" class="<?php echo $t_rwpendd_list->bioid->headerCellClass() ?>"><div id="elh_t_rwpendd_bioid" class="t_rwpendd_bioid"><div class="ew-table-header-caption"><?php echo $t_rwpendd_list->bioid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bioid" class="<?php echo $t_rwpendd_list->bioid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rwpendd_list->SortUrl($t_rwpendd_list->bioid) ?>', 1);"><div id="elh_t_rwpendd_bioid" class="t_rwpendd_bioid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwpendd_list->bioid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwpendd_list->bioid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwpendd_list->bioid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwpendd_list->sekolah->Visible) { // sekolah ?>
	<?php if ($t_rwpendd_list->SortUrl($t_rwpendd_list->sekolah) == "") { ?>
		<th data-name="sekolah" class="<?php echo $t_rwpendd_list->sekolah->headerCellClass() ?>"><div id="elh_t_rwpendd_sekolah" class="t_rwpendd_sekolah"><div class="ew-table-header-caption"><?php echo $t_rwpendd_list->sekolah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sekolah" class="<?php echo $t_rwpendd_list->sekolah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rwpendd_list->SortUrl($t_rwpendd_list->sekolah) ?>', 1);"><div id="elh_t_rwpendd_sekolah" class="t_rwpendd_sekolah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwpendd_list->sekolah->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwpendd_list->sekolah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwpendd_list->sekolah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwpendd_list->tempat->Visible) { // tempat ?>
	<?php if ($t_rwpendd_list->SortUrl($t_rwpendd_list->tempat) == "") { ?>
		<th data-name="tempat" class="<?php echo $t_rwpendd_list->tempat->headerCellClass() ?>"><div id="elh_t_rwpendd_tempat" class="t_rwpendd_tempat"><div class="ew-table-header-caption"><?php echo $t_rwpendd_list->tempat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tempat" class="<?php echo $t_rwpendd_list->tempat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rwpendd_list->SortUrl($t_rwpendd_list->tempat) ?>', 1);"><div id="elh_t_rwpendd_tempat" class="t_rwpendd_tempat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwpendd_list->tempat->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwpendd_list->tempat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwpendd_list->tempat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwpendd_list->tahun->Visible) { // tahun ?>
	<?php if ($t_rwpendd_list->SortUrl($t_rwpendd_list->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $t_rwpendd_list->tahun->headerCellClass() ?>"><div id="elh_t_rwpendd_tahun" class="t_rwpendd_tahun"><div class="ew-table-header-caption"><?php echo $t_rwpendd_list->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $t_rwpendd_list->tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rwpendd_list->SortUrl($t_rwpendd_list->tahun) ?>', 1);"><div id="elh_t_rwpendd_tahun" class="t_rwpendd_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwpendd_list->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwpendd_list->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwpendd_list->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_rwpendd_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_rwpendd_list->ExportAll && $t_rwpendd_list->isExport()) {
	$t_rwpendd_list->StopRecord = $t_rwpendd_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_rwpendd_list->TotalRecords > $t_rwpendd_list->StartRecord + $t_rwpendd_list->DisplayRecords - 1)
		$t_rwpendd_list->StopRecord = $t_rwpendd_list->StartRecord + $t_rwpendd_list->DisplayRecords - 1;
	else
		$t_rwpendd_list->StopRecord = $t_rwpendd_list->TotalRecords;
}
$t_rwpendd_list->RecordCount = $t_rwpendd_list->StartRecord - 1;
if ($t_rwpendd_list->Recordset && !$t_rwpendd_list->Recordset->EOF) {
	$t_rwpendd_list->Recordset->moveFirst();
	$selectLimit = $t_rwpendd_list->UseSelectLimit;
	if (!$selectLimit && $t_rwpendd_list->StartRecord > 1)
		$t_rwpendd_list->Recordset->move($t_rwpendd_list->StartRecord - 1);
} elseif (!$t_rwpendd->AllowAddDeleteRow && $t_rwpendd_list->StopRecord == 0) {
	$t_rwpendd_list->StopRecord = $t_rwpendd->GridAddRowCount;
}

// Initialize aggregate
$t_rwpendd->RowType = ROWTYPE_AGGREGATEINIT;
$t_rwpendd->resetAttributes();
$t_rwpendd_list->renderRow();
while ($t_rwpendd_list->RecordCount < $t_rwpendd_list->StopRecord) {
	$t_rwpendd_list->RecordCount++;
	if ($t_rwpendd_list->RecordCount >= $t_rwpendd_list->StartRecord) {
		$t_rwpendd_list->RowCount++;

		// Set up key count
		$t_rwpendd_list->KeyCount = $t_rwpendd_list->RowIndex;

		// Init row class and style
		$t_rwpendd->resetAttributes();
		$t_rwpendd->CssClass = "";
		if ($t_rwpendd_list->isGridAdd()) {
		} else {
			$t_rwpendd_list->loadRowValues($t_rwpendd_list->Recordset); // Load row values
		}
		$t_rwpendd->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_rwpendd->RowAttrs->merge(["data-rowindex" => $t_rwpendd_list->RowCount, "id" => "r" . $t_rwpendd_list->RowCount . "_t_rwpendd", "data-rowtype" => $t_rwpendd->RowType]);

		// Render row
		$t_rwpendd_list->renderRow();

		// Render list options
		$t_rwpendd_list->renderListOptions();
?>
	<tr <?php echo $t_rwpendd->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_rwpendd_list->ListOptions->render("body", "left", $t_rwpendd_list->RowCount);
?>
	<?php if ($t_rwpendd_list->penddid->Visible) { // penddid ?>
		<td data-name="penddid" <?php echo $t_rwpendd_list->penddid->cellAttributes() ?>>
<span id="el<?php echo $t_rwpendd_list->RowCount ?>_t_rwpendd_penddid">
<span<?php echo $t_rwpendd_list->penddid->viewAttributes() ?>><?php echo $t_rwpendd_list->penddid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rwpendd_list->bioid->Visible) { // bioid ?>
		<td data-name="bioid" <?php echo $t_rwpendd_list->bioid->cellAttributes() ?>>
<span id="el<?php echo $t_rwpendd_list->RowCount ?>_t_rwpendd_bioid">
<span<?php echo $t_rwpendd_list->bioid->viewAttributes() ?>><?php echo $t_rwpendd_list->bioid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rwpendd_list->sekolah->Visible) { // sekolah ?>
		<td data-name="sekolah" <?php echo $t_rwpendd_list->sekolah->cellAttributes() ?>>
<span id="el<?php echo $t_rwpendd_list->RowCount ?>_t_rwpendd_sekolah">
<span<?php echo $t_rwpendd_list->sekolah->viewAttributes() ?>><?php echo $t_rwpendd_list->sekolah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rwpendd_list->tempat->Visible) { // tempat ?>
		<td data-name="tempat" <?php echo $t_rwpendd_list->tempat->cellAttributes() ?>>
<span id="el<?php echo $t_rwpendd_list->RowCount ?>_t_rwpendd_tempat">
<span<?php echo $t_rwpendd_list->tempat->viewAttributes() ?>><?php echo $t_rwpendd_list->tempat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rwpendd_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $t_rwpendd_list->tahun->cellAttributes() ?>>
<span id="el<?php echo $t_rwpendd_list->RowCount ?>_t_rwpendd_tahun">
<span<?php echo $t_rwpendd_list->tahun->viewAttributes() ?>><?php echo $t_rwpendd_list->tahun->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_rwpendd_list->ListOptions->render("body", "right", $t_rwpendd_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_rwpendd_list->isGridAdd())
		$t_rwpendd_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_rwpendd->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_rwpendd_list->Recordset)
	$t_rwpendd_list->Recordset->Close();
?>
<?php if (!$t_rwpendd_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_rwpendd_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_rwpendd_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_rwpendd_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_rwpendd_list->TotalRecords == 0 && !$t_rwpendd->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_rwpendd_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_rwpendd_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_rwpendd_list->isExport()) { ?>
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
$t_rwpendd_list->terminate();
?>