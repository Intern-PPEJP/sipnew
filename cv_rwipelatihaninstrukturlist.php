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
$cv_rwipelatihaninstruktur_list = new cv_rwipelatihaninstruktur_list();

// Run the page
$cv_rwipelatihaninstruktur_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cv_rwipelatihaninstruktur_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cv_rwipelatihaninstruktur_list->isExport()) { ?>
<script>
var fcv_rwipelatihaninstrukturlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcv_rwipelatihaninstrukturlist = currentForm = new ew.Form("fcv_rwipelatihaninstrukturlist", "list");
	fcv_rwipelatihaninstrukturlist.formKeyCountName = '<?php echo $cv_rwipelatihaninstruktur_list->FormKeyCountName ?>';
	loadjs.done("fcv_rwipelatihaninstrukturlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$cv_rwipelatihaninstruktur_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cv_rwipelatihaninstruktur_list->TotalRecords > 0 && $cv_rwipelatihaninstruktur_list->ExportOptions->visible()) { ?>
<?php $cv_rwipelatihaninstruktur_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur_list->ImportOptions->visible()) { ?>
<?php $cv_rwipelatihaninstruktur_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$cv_rwipelatihaninstruktur_list->isExport() || Config("EXPORT_MASTER_RECORD") && $cv_rwipelatihaninstruktur_list->isExport("print")) { ?>
<?php
if ($cv_rwipelatihaninstruktur_list->DbMasterFilter != "" && $cv_rwipelatihaninstruktur->getCurrentMasterTable() == "t_biointruktur") {
	if ($cv_rwipelatihaninstruktur_list->MasterRecordExists) {
		include_once "t_biointrukturmaster.php";
	}
}
?>
<?php } ?>
<?php
$cv_rwipelatihaninstruktur_list->renderOtherOptions();
?>
<?php $cv_rwipelatihaninstruktur_list->showPageHeader(); ?>
<?php
$cv_rwipelatihaninstruktur_list->showMessage();
?>
<?php if ($cv_rwipelatihaninstruktur_list->TotalRecords > 0 || $cv_rwipelatihaninstruktur->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cv_rwipelatihaninstruktur_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cv_rwipelatihaninstruktur">
<?php if (!$cv_rwipelatihaninstruktur_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$cv_rwipelatihaninstruktur_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cv_rwipelatihaninstruktur_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cv_rwipelatihaninstruktur_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcv_rwipelatihaninstrukturlist" id="fcv_rwipelatihaninstrukturlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cv_rwipelatihaninstruktur">
<?php if ($cv_rwipelatihaninstruktur->getCurrentMasterTable() == "t_biointruktur" && $cv_rwipelatihaninstruktur->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_biointruktur">
<input type="hidden" name="fk_bioid" value="<?php echo HtmlEncode($cv_rwipelatihaninstruktur_list->bioid->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_cv_rwipelatihaninstruktur" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($cv_rwipelatihaninstruktur_list->TotalRecords > 0 || $cv_rwipelatihaninstruktur_list->isGridEdit()) { ?>
<table id="tbl_cv_rwipelatihaninstrukturlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cv_rwipelatihaninstruktur->RowType = ROWTYPE_HEADER;

// Render list options
$cv_rwipelatihaninstruktur_list->renderListOptions();

// Render list options (header, left)
$cv_rwipelatihaninstruktur_list->ListOptions->render("header", "left");
?>
<?php if ($cv_rwipelatihaninstruktur_list->kurikulum->Visible) { // kurikulum ?>
	<?php if ($cv_rwipelatihaninstruktur_list->SortUrl($cv_rwipelatihaninstruktur_list->kurikulum) == "") { ?>
		<th data-name="kurikulum" class="<?php echo $cv_rwipelatihaninstruktur_list->kurikulum->headerCellClass() ?>"><div id="elh_cv_rwipelatihaninstruktur_kurikulum" class="cv_rwipelatihaninstruktur_kurikulum"><div class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_list->kurikulum->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kurikulum" class="<?php echo $cv_rwipelatihaninstruktur_list->kurikulum->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_rwipelatihaninstruktur_list->SortUrl($cv_rwipelatihaninstruktur_list->kurikulum) ?>', 1);"><div id="elh_cv_rwipelatihaninstruktur_kurikulum" class="cv_rwipelatihaninstruktur_kurikulum">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_list->kurikulum->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_rwipelatihaninstruktur_list->kurikulum->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_rwipelatihaninstruktur_list->kurikulum->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur_list->kdjudul->Visible) { // kdjudul ?>
	<?php if ($cv_rwipelatihaninstruktur_list->SortUrl($cv_rwipelatihaninstruktur_list->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $cv_rwipelatihaninstruktur_list->kdjudul->headerCellClass() ?>"><div id="elh_cv_rwipelatihaninstruktur_kdjudul" class="cv_rwipelatihaninstruktur_kdjudul"><div class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_list->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $cv_rwipelatihaninstruktur_list->kdjudul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_rwipelatihaninstruktur_list->SortUrl($cv_rwipelatihaninstruktur_list->kdjudul) ?>', 1);"><div id="elh_cv_rwipelatihaninstruktur_kdjudul" class="cv_rwipelatihaninstruktur_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_list->kdjudul->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_rwipelatihaninstruktur_list->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_rwipelatihaninstruktur_list->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur_list->tawal->Visible) { // tawal ?>
	<?php if ($cv_rwipelatihaninstruktur_list->SortUrl($cv_rwipelatihaninstruktur_list->tawal) == "") { ?>
		<th data-name="tawal" class="<?php echo $cv_rwipelatihaninstruktur_list->tawal->headerCellClass() ?>"><div id="elh_cv_rwipelatihaninstruktur_tawal" class="cv_rwipelatihaninstruktur_tawal"><div class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_list->tawal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tawal" class="<?php echo $cv_rwipelatihaninstruktur_list->tawal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_rwipelatihaninstruktur_list->SortUrl($cv_rwipelatihaninstruktur_list->tawal) ?>', 1);"><div id="elh_cv_rwipelatihaninstruktur_tawal" class="cv_rwipelatihaninstruktur_tawal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_list->tawal->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_rwipelatihaninstruktur_list->tawal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_rwipelatihaninstruktur_list->tawal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur_list->takhir->Visible) { // takhir ?>
	<?php if ($cv_rwipelatihaninstruktur_list->SortUrl($cv_rwipelatihaninstruktur_list->takhir) == "") { ?>
		<th data-name="takhir" class="<?php echo $cv_rwipelatihaninstruktur_list->takhir->headerCellClass() ?>"><div id="elh_cv_rwipelatihaninstruktur_takhir" class="cv_rwipelatihaninstruktur_takhir"><div class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_list->takhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="takhir" class="<?php echo $cv_rwipelatihaninstruktur_list->takhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_rwipelatihaninstruktur_list->SortUrl($cv_rwipelatihaninstruktur_list->takhir) ?>', 1);"><div id="elh_cv_rwipelatihaninstruktur_takhir" class="cv_rwipelatihaninstruktur_takhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_list->takhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_rwipelatihaninstruktur_list->takhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_rwipelatihaninstruktur_list->takhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur_list->kdprop->Visible) { // kdprop ?>
	<?php if ($cv_rwipelatihaninstruktur_list->SortUrl($cv_rwipelatihaninstruktur_list->kdprop) == "") { ?>
		<th data-name="kdprop" class="<?php echo $cv_rwipelatihaninstruktur_list->kdprop->headerCellClass() ?>"><div id="elh_cv_rwipelatihaninstruktur_kdprop" class="cv_rwipelatihaninstruktur_kdprop"><div class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_list->kdprop->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdprop" class="<?php echo $cv_rwipelatihaninstruktur_list->kdprop->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_rwipelatihaninstruktur_list->SortUrl($cv_rwipelatihaninstruktur_list->kdprop) ?>', 1);"><div id="elh_cv_rwipelatihaninstruktur_kdprop" class="cv_rwipelatihaninstruktur_kdprop">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_list->kdprop->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_rwipelatihaninstruktur_list->kdprop->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_rwipelatihaninstruktur_list->kdprop->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur_list->kdkota->Visible) { // kdkota ?>
	<?php if ($cv_rwipelatihaninstruktur_list->SortUrl($cv_rwipelatihaninstruktur_list->kdkota) == "") { ?>
		<th data-name="kdkota" class="<?php echo $cv_rwipelatihaninstruktur_list->kdkota->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_cv_rwipelatihaninstruktur_kdkota" class="cv_rwipelatihaninstruktur_kdkota"><div class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_list->kdkota->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkota" class="<?php echo $cv_rwipelatihaninstruktur_list->kdkota->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_rwipelatihaninstruktur_list->SortUrl($cv_rwipelatihaninstruktur_list->kdkota) ?>', 1);"><div id="elh_cv_rwipelatihaninstruktur_kdkota" class="cv_rwipelatihaninstruktur_kdkota">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_rwipelatihaninstruktur_list->kdkota->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_rwipelatihaninstruktur_list->kdkota->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_rwipelatihaninstruktur_list->kdkota->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cv_rwipelatihaninstruktur_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cv_rwipelatihaninstruktur_list->ExportAll && $cv_rwipelatihaninstruktur_list->isExport()) {
	$cv_rwipelatihaninstruktur_list->StopRecord = $cv_rwipelatihaninstruktur_list->TotalRecords;
} else {

	// Set the last record to display
	if ($cv_rwipelatihaninstruktur_list->TotalRecords > $cv_rwipelatihaninstruktur_list->StartRecord + $cv_rwipelatihaninstruktur_list->DisplayRecords - 1)
		$cv_rwipelatihaninstruktur_list->StopRecord = $cv_rwipelatihaninstruktur_list->StartRecord + $cv_rwipelatihaninstruktur_list->DisplayRecords - 1;
	else
		$cv_rwipelatihaninstruktur_list->StopRecord = $cv_rwipelatihaninstruktur_list->TotalRecords;
}
$cv_rwipelatihaninstruktur_list->RecordCount = $cv_rwipelatihaninstruktur_list->StartRecord - 1;
if ($cv_rwipelatihaninstruktur_list->Recordset && !$cv_rwipelatihaninstruktur_list->Recordset->EOF) {
	$cv_rwipelatihaninstruktur_list->Recordset->moveFirst();
	$selectLimit = $cv_rwipelatihaninstruktur_list->UseSelectLimit;
	if (!$selectLimit && $cv_rwipelatihaninstruktur_list->StartRecord > 1)
		$cv_rwipelatihaninstruktur_list->Recordset->move($cv_rwipelatihaninstruktur_list->StartRecord - 1);
} elseif (!$cv_rwipelatihaninstruktur->AllowAddDeleteRow && $cv_rwipelatihaninstruktur_list->StopRecord == 0) {
	$cv_rwipelatihaninstruktur_list->StopRecord = $cv_rwipelatihaninstruktur->GridAddRowCount;
}

// Initialize aggregate
$cv_rwipelatihaninstruktur->RowType = ROWTYPE_AGGREGATEINIT;
$cv_rwipelatihaninstruktur->resetAttributes();
$cv_rwipelatihaninstruktur_list->renderRow();
while ($cv_rwipelatihaninstruktur_list->RecordCount < $cv_rwipelatihaninstruktur_list->StopRecord) {
	$cv_rwipelatihaninstruktur_list->RecordCount++;
	if ($cv_rwipelatihaninstruktur_list->RecordCount >= $cv_rwipelatihaninstruktur_list->StartRecord) {
		$cv_rwipelatihaninstruktur_list->RowCount++;

		// Set up key count
		$cv_rwipelatihaninstruktur_list->KeyCount = $cv_rwipelatihaninstruktur_list->RowIndex;

		// Init row class and style
		$cv_rwipelatihaninstruktur->resetAttributes();
		$cv_rwipelatihaninstruktur->CssClass = "";
		if ($cv_rwipelatihaninstruktur_list->isGridAdd()) {
		} else {
			$cv_rwipelatihaninstruktur_list->loadRowValues($cv_rwipelatihaninstruktur_list->Recordset); // Load row values
		}
		$cv_rwipelatihaninstruktur->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cv_rwipelatihaninstruktur->RowAttrs->merge(["data-rowindex" => $cv_rwipelatihaninstruktur_list->RowCount, "id" => "r" . $cv_rwipelatihaninstruktur_list->RowCount . "_cv_rwipelatihaninstruktur", "data-rowtype" => $cv_rwipelatihaninstruktur->RowType]);

		// Render row
		$cv_rwipelatihaninstruktur_list->renderRow();

		// Render list options
		$cv_rwipelatihaninstruktur_list->renderListOptions();
?>
	<tr <?php echo $cv_rwipelatihaninstruktur->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cv_rwipelatihaninstruktur_list->ListOptions->render("body", "left", $cv_rwipelatihaninstruktur_list->RowCount);
?>
	<?php if ($cv_rwipelatihaninstruktur_list->kurikulum->Visible) { // kurikulum ?>
		<td data-name="kurikulum" <?php echo $cv_rwipelatihaninstruktur_list->kurikulum->cellAttributes() ?>>
<span id="el<?php echo $cv_rwipelatihaninstruktur_list->RowCount ?>_cv_rwipelatihaninstruktur_kurikulum">
<span<?php echo $cv_rwipelatihaninstruktur_list->kurikulum->viewAttributes() ?>><?php echo $cv_rwipelatihaninstruktur_list->kurikulum->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_rwipelatihaninstruktur_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $cv_rwipelatihaninstruktur_list->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $cv_rwipelatihaninstruktur_list->RowCount ?>_cv_rwipelatihaninstruktur_kdjudul">
<span<?php echo $cv_rwipelatihaninstruktur_list->kdjudul->viewAttributes() ?>><?php echo $cv_rwipelatihaninstruktur_list->kdjudul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_rwipelatihaninstruktur_list->tawal->Visible) { // tawal ?>
		<td data-name="tawal" <?php echo $cv_rwipelatihaninstruktur_list->tawal->cellAttributes() ?>>
<span id="el<?php echo $cv_rwipelatihaninstruktur_list->RowCount ?>_cv_rwipelatihaninstruktur_tawal">
<span<?php echo $cv_rwipelatihaninstruktur_list->tawal->viewAttributes() ?>><?php echo $cv_rwipelatihaninstruktur_list->tawal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_rwipelatihaninstruktur_list->takhir->Visible) { // takhir ?>
		<td data-name="takhir" <?php echo $cv_rwipelatihaninstruktur_list->takhir->cellAttributes() ?>>
<span id="el<?php echo $cv_rwipelatihaninstruktur_list->RowCount ?>_cv_rwipelatihaninstruktur_takhir">
<span<?php echo $cv_rwipelatihaninstruktur_list->takhir->viewAttributes() ?>><?php echo $cv_rwipelatihaninstruktur_list->takhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_rwipelatihaninstruktur_list->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" <?php echo $cv_rwipelatihaninstruktur_list->kdprop->cellAttributes() ?>>
<span id="el<?php echo $cv_rwipelatihaninstruktur_list->RowCount ?>_cv_rwipelatihaninstruktur_kdprop">
<span<?php echo $cv_rwipelatihaninstruktur_list->kdprop->viewAttributes() ?>><?php echo $cv_rwipelatihaninstruktur_list->kdprop->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_rwipelatihaninstruktur_list->kdkota->Visible) { // kdkota ?>
		<td data-name="kdkota" <?php echo $cv_rwipelatihaninstruktur_list->kdkota->cellAttributes() ?>>
<span id="el<?php echo $cv_rwipelatihaninstruktur_list->RowCount ?>_cv_rwipelatihaninstruktur_kdkota">
<span<?php echo $cv_rwipelatihaninstruktur_list->kdkota->viewAttributes() ?>><?php echo $cv_rwipelatihaninstruktur_list->kdkota->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cv_rwipelatihaninstruktur_list->ListOptions->render("body", "right", $cv_rwipelatihaninstruktur_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$cv_rwipelatihaninstruktur_list->isGridAdd())
		$cv_rwipelatihaninstruktur_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$cv_rwipelatihaninstruktur->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cv_rwipelatihaninstruktur_list->Recordset)
	$cv_rwipelatihaninstruktur_list->Recordset->Close();
?>
<?php if (!$cv_rwipelatihaninstruktur_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cv_rwipelatihaninstruktur_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cv_rwipelatihaninstruktur_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cv_rwipelatihaninstruktur_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cv_rwipelatihaninstruktur_list->TotalRecords == 0 && !$cv_rwipelatihaninstruktur->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cv_rwipelatihaninstruktur_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cv_rwipelatihaninstruktur_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cv_rwipelatihaninstruktur_list->isExport()) { ?>
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
$cv_rwipelatihaninstruktur_list->terminate();
?>