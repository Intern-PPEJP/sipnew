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
$t_kurikulum_list = new t_kurikulum_list();

// Run the page
$t_kurikulum_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_kurikulum_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_kurikulum_list->isExport()) { ?>
<script>
var ft_kurikulumlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_kurikulumlist = currentForm = new ew.Form("ft_kurikulumlist", "list");
	ft_kurikulumlist.formKeyCountName = '<?php echo $t_kurikulum_list->FormKeyCountName ?>';
	loadjs.done("ft_kurikulumlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_kurikulum_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_kurikulum_list->TotalRecords > 0 && $t_kurikulum_list->ExportOptions->visible()) { ?>
<?php $t_kurikulum_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_kurikulum_list->ImportOptions->visible()) { ?>
<?php $t_kurikulum_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$t_kurikulum_list->isExport() || Config("EXPORT_MASTER_RECORD") && $t_kurikulum_list->isExport("print")) { ?>
<?php
if ($t_kurikulum_list->DbMasterFilter != "" && $t_kurikulum->getCurrentMasterTable() == "t_juduldetail") {
	if ($t_kurikulum_list->MasterRecordExists) {
		include_once "t_juduldetailmaster.php";
	}
}
?>
<?php } ?>
<?php
$t_kurikulum_list->renderOtherOptions();
?>
<?php $t_kurikulum_list->showPageHeader(); ?>
<?php
$t_kurikulum_list->showMessage();
?>
<?php if ($t_kurikulum_list->TotalRecords > 0 || $t_kurikulum->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_kurikulum_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_kurikulum">
<?php if (!$t_kurikulum_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_kurikulum_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_kurikulum_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_kurikulum_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_kurikulumlist" id="ft_kurikulumlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_kurikulum">
<?php if ($t_kurikulum->getCurrentMasterTable() == "t_juduldetail" && $t_kurikulum->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_juduldetail">
<input type="hidden" name="fk_kdkursil" value="<?php echo HtmlEncode($t_kurikulum_list->kdkursil->getSessionValue()) ?>">
<input type="hidden" name="fk_jpel" value="<?php echo HtmlEncode($t_kurikulum_list->jpel->getSessionValue()) ?>">
<input type="hidden" name="fk_kdjudul" value="<?php echo HtmlEncode($t_kurikulum_list->kdjudul->getSessionValue()) ?>">
<input type="hidden" name="fk_revisi" value="<?php echo HtmlEncode($t_kurikulum_list->revisi->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_t_kurikulum" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_kurikulum_list->TotalRecords > 0 || $t_kurikulum_list->isGridEdit()) { ?>
<table id="tbl_t_kurikulumlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_kurikulum->RowType = ROWTYPE_HEADER;

// Render list options
$t_kurikulum_list->renderListOptions();

// Render list options (header, left)
$t_kurikulum_list->ListOptions->render("header", "left");
?>
<?php if ($t_kurikulum_list->kdkursil->Visible) { // kdkursil ?>
	<?php if ($t_kurikulum_list->SortUrl($t_kurikulum_list->kdkursil) == "") { ?>
		<th data-name="kdkursil" class="<?php echo $t_kurikulum_list->kdkursil->headerCellClass() ?>"><div id="elh_t_kurikulum_kdkursil" class="t_kurikulum_kdkursil"><div class="ew-table-header-caption"><?php echo $t_kurikulum_list->kdkursil->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkursil" class="<?php echo $t_kurikulum_list->kdkursil->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kurikulum_list->SortUrl($t_kurikulum_list->kdkursil) ?>', 1);"><div id="elh_t_kurikulum_kdkursil" class="t_kurikulum_kdkursil">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kurikulum_list->kdkursil->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kurikulum_list->kdkursil->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kurikulum_list->kdkursil->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kurikulum_list->hari->Visible) { // hari ?>
	<?php if ($t_kurikulum_list->SortUrl($t_kurikulum_list->hari) == "") { ?>
		<th data-name="hari" class="<?php echo $t_kurikulum_list->hari->headerCellClass() ?>"><div id="elh_t_kurikulum_hari" class="t_kurikulum_hari"><div class="ew-table-header-caption"><?php echo $t_kurikulum_list->hari->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hari" class="<?php echo $t_kurikulum_list->hari->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kurikulum_list->SortUrl($t_kurikulum_list->hari) ?>', 1);"><div id="elh_t_kurikulum_hari" class="t_kurikulum_hari">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kurikulum_list->hari->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kurikulum_list->hari->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kurikulum_list->hari->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kurikulum_list->kurikulum->Visible) { // kurikulum ?>
	<?php if ($t_kurikulum_list->SortUrl($t_kurikulum_list->kurikulum) == "") { ?>
		<th data-name="kurikulum" class="<?php echo $t_kurikulum_list->kurikulum->headerCellClass() ?>"><div id="elh_t_kurikulum_kurikulum" class="t_kurikulum_kurikulum"><div class="ew-table-header-caption"><?php echo $t_kurikulum_list->kurikulum->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kurikulum" class="<?php echo $t_kurikulum_list->kurikulum->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kurikulum_list->SortUrl($t_kurikulum_list->kurikulum) ?>', 1);"><div id="elh_t_kurikulum_kurikulum" class="t_kurikulum_kurikulum">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kurikulum_list->kurikulum->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kurikulum_list->kurikulum->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kurikulum_list->kurikulum->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kurikulum_list->silabus->Visible) { // silabus ?>
	<?php if ($t_kurikulum_list->SortUrl($t_kurikulum_list->silabus) == "") { ?>
		<th data-name="silabus" class="<?php echo $t_kurikulum_list->silabus->headerCellClass() ?>"><div id="elh_t_kurikulum_silabus" class="t_kurikulum_silabus"><div class="ew-table-header-caption"><?php echo $t_kurikulum_list->silabus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="silabus" class="<?php echo $t_kurikulum_list->silabus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kurikulum_list->SortUrl($t_kurikulum_list->silabus) ?>', 1);"><div id="elh_t_kurikulum_silabus" class="t_kurikulum_silabus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kurikulum_list->silabus->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kurikulum_list->silabus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kurikulum_list->silabus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kurikulum_list->tujuan_instruksional->Visible) { // tujuan_instruksional ?>
	<?php if ($t_kurikulum_list->SortUrl($t_kurikulum_list->tujuan_instruksional) == "") { ?>
		<th data-name="tujuan_instruksional" class="<?php echo $t_kurikulum_list->tujuan_instruksional->headerCellClass() ?>"><div id="elh_t_kurikulum_tujuan_instruksional" class="t_kurikulum_tujuan_instruksional"><div class="ew-table-header-caption"><?php echo $t_kurikulum_list->tujuan_instruksional->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tujuan_instruksional" class="<?php echo $t_kurikulum_list->tujuan_instruksional->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kurikulum_list->SortUrl($t_kurikulum_list->tujuan_instruksional) ?>', 1);"><div id="elh_t_kurikulum_tujuan_instruksional" class="t_kurikulum_tujuan_instruksional">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kurikulum_list->tujuan_instruksional->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kurikulum_list->tujuan_instruksional->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kurikulum_list->tujuan_instruksional->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kurikulum_list->sesi->Visible) { // sesi ?>
	<?php if ($t_kurikulum_list->SortUrl($t_kurikulum_list->sesi) == "") { ?>
		<th data-name="sesi" class="<?php echo $t_kurikulum_list->sesi->headerCellClass() ?>"><div id="elh_t_kurikulum_sesi" class="t_kurikulum_sesi"><div class="ew-table-header-caption"><?php echo $t_kurikulum_list->sesi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sesi" class="<?php echo $t_kurikulum_list->sesi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kurikulum_list->SortUrl($t_kurikulum_list->sesi) ?>', 1);"><div id="elh_t_kurikulum_sesi" class="t_kurikulum_sesi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kurikulum_list->sesi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kurikulum_list->sesi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kurikulum_list->sesi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_kurikulum_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_kurikulum_list->ExportAll && $t_kurikulum_list->isExport()) {
	$t_kurikulum_list->StopRecord = $t_kurikulum_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_kurikulum_list->TotalRecords > $t_kurikulum_list->StartRecord + $t_kurikulum_list->DisplayRecords - 1)
		$t_kurikulum_list->StopRecord = $t_kurikulum_list->StartRecord + $t_kurikulum_list->DisplayRecords - 1;
	else
		$t_kurikulum_list->StopRecord = $t_kurikulum_list->TotalRecords;
}
$t_kurikulum_list->RecordCount = $t_kurikulum_list->StartRecord - 1;
if ($t_kurikulum_list->Recordset && !$t_kurikulum_list->Recordset->EOF) {
	$t_kurikulum_list->Recordset->moveFirst();
	$selectLimit = $t_kurikulum_list->UseSelectLimit;
	if (!$selectLimit && $t_kurikulum_list->StartRecord > 1)
		$t_kurikulum_list->Recordset->move($t_kurikulum_list->StartRecord - 1);
} elseif (!$t_kurikulum->AllowAddDeleteRow && $t_kurikulum_list->StopRecord == 0) {
	$t_kurikulum_list->StopRecord = $t_kurikulum->GridAddRowCount;
}

// Initialize aggregate
$t_kurikulum->RowType = ROWTYPE_AGGREGATEINIT;
$t_kurikulum->resetAttributes();
$t_kurikulum_list->renderRow();
while ($t_kurikulum_list->RecordCount < $t_kurikulum_list->StopRecord) {
	$t_kurikulum_list->RecordCount++;
	if ($t_kurikulum_list->RecordCount >= $t_kurikulum_list->StartRecord) {
		$t_kurikulum_list->RowCount++;

		// Set up key count
		$t_kurikulum_list->KeyCount = $t_kurikulum_list->RowIndex;

		// Init row class and style
		$t_kurikulum->resetAttributes();
		$t_kurikulum->CssClass = "";
		if ($t_kurikulum_list->isGridAdd()) {
		} else {
			$t_kurikulum_list->loadRowValues($t_kurikulum_list->Recordset); // Load row values
		}
		$t_kurikulum->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_kurikulum->RowAttrs->merge(["data-rowindex" => $t_kurikulum_list->RowCount, "id" => "r" . $t_kurikulum_list->RowCount . "_t_kurikulum", "data-rowtype" => $t_kurikulum->RowType]);

		// Render row
		$t_kurikulum_list->renderRow();

		// Render list options
		$t_kurikulum_list->renderListOptions();
?>
	<tr <?php echo $t_kurikulum->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_kurikulum_list->ListOptions->render("body", "left", $t_kurikulum_list->RowCount);
?>
	<?php if ($t_kurikulum_list->kdkursil->Visible) { // kdkursil ?>
		<td data-name="kdkursil" <?php echo $t_kurikulum_list->kdkursil->cellAttributes() ?>>
<span id="el<?php echo $t_kurikulum_list->RowCount ?>_t_kurikulum_kdkursil">
<span<?php echo $t_kurikulum_list->kdkursil->viewAttributes() ?>><?php echo $t_kurikulum_list->kdkursil->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_kurikulum_list->hari->Visible) { // hari ?>
		<td data-name="hari" <?php echo $t_kurikulum_list->hari->cellAttributes() ?>>
<span id="el<?php echo $t_kurikulum_list->RowCount ?>_t_kurikulum_hari">
<span<?php echo $t_kurikulum_list->hari->viewAttributes() ?>><?php echo $t_kurikulum_list->hari->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_kurikulum_list->kurikulum->Visible) { // kurikulum ?>
		<td data-name="kurikulum" <?php echo $t_kurikulum_list->kurikulum->cellAttributes() ?>>
<span id="el<?php echo $t_kurikulum_list->RowCount ?>_t_kurikulum_kurikulum">
<span<?php echo $t_kurikulum_list->kurikulum->viewAttributes() ?>><?php echo $t_kurikulum_list->kurikulum->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_kurikulum_list->silabus->Visible) { // silabus ?>
		<td data-name="silabus" <?php echo $t_kurikulum_list->silabus->cellAttributes() ?>>
<span id="el<?php echo $t_kurikulum_list->RowCount ?>_t_kurikulum_silabus">
<span<?php echo $t_kurikulum_list->silabus->viewAttributes() ?>><?php echo $t_kurikulum_list->silabus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_kurikulum_list->tujuan_instruksional->Visible) { // tujuan_instruksional ?>
		<td data-name="tujuan_instruksional" <?php echo $t_kurikulum_list->tujuan_instruksional->cellAttributes() ?>>
<span id="el<?php echo $t_kurikulum_list->RowCount ?>_t_kurikulum_tujuan_instruksional">
<span<?php echo $t_kurikulum_list->tujuan_instruksional->viewAttributes() ?>><?php echo $t_kurikulum_list->tujuan_instruksional->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_kurikulum_list->sesi->Visible) { // sesi ?>
		<td data-name="sesi" <?php echo $t_kurikulum_list->sesi->cellAttributes() ?>>
<span id="el<?php echo $t_kurikulum_list->RowCount ?>_t_kurikulum_sesi">
<span<?php echo $t_kurikulum_list->sesi->viewAttributes() ?>><?php echo $t_kurikulum_list->sesi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_kurikulum_list->ListOptions->render("body", "right", $t_kurikulum_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_kurikulum_list->isGridAdd())
		$t_kurikulum_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_kurikulum->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_kurikulum_list->Recordset)
	$t_kurikulum_list->Recordset->Close();
?>
<?php if (!$t_kurikulum_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_kurikulum_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_kurikulum_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_kurikulum_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_kurikulum_list->TotalRecords == 0 && !$t_kurikulum->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_kurikulum_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_kurikulum_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_kurikulum_list->isExport()) { ?>
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
$t_kurikulum_list->terminate();
?>