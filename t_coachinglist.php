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
$t_coaching_list = new t_coaching_list();

// Run the page
$t_coaching_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_coaching_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_coaching_list->isExport()) { ?>
<script>
var ft_coachinglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_coachinglist = currentForm = new ew.Form("ft_coachinglist", "list");
	ft_coachinglist.formKeyCountName = '<?php echo $t_coaching_list->FormKeyCountName ?>';
	loadjs.done("ft_coachinglist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//document.write('<?php echo cs_judul("list","Coaching Program");?>');

});
</script>
<?php } ?>
<?php if (!$t_coaching_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_coaching_list->TotalRecords > 0 && $t_coaching_list->ExportOptions->visible()) { ?>
<?php $t_coaching_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_coaching_list->ImportOptions->visible()) { ?>
<?php $t_coaching_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$t_coaching_list->isExport() || Config("EXPORT_MASTER_RECORD") && $t_coaching_list->isExport("print")) { ?>
<?php
if ($t_coaching_list->DbMasterFilter != "" && $t_coaching->getCurrentMasterTable() == "t_rkcoaching") {
	if ($t_coaching_list->MasterRecordExists) {
		include_once "t_rkcoachingmaster.php";
	}
}
?>
<?php } ?>
<?php
$t_coaching_list->renderOtherOptions();
?>
<?php $t_coaching_list->showPageHeader(); ?>
<?php
$t_coaching_list->showMessage();
?>
<?php if ($t_coaching_list->TotalRecords > 0 || $t_coaching->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_coaching_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_coaching">
<?php if (!$t_coaching_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_coaching_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_coaching_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_coaching_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_coachinglist" id="ft_coachinglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_coaching">
<?php if ($t_coaching->getCurrentMasterTable() == "t_rkcoaching" && $t_coaching->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_rkcoaching">
<input type="hidden" name="fk_rkid" value="<?php echo HtmlEncode($t_coaching_list->rkid->getSessionValue()) ?>">
<input type="hidden" name="fk_area" value="<?php echo HtmlEncode($t_coaching_list->kdprop->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_t_coaching" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_coaching_list->TotalRecords > 0 || $t_coaching_list->isGridEdit()) { ?>
<table id="tbl_t_coachinglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_coaching->RowType = ROWTYPE_HEADER;

// Render list options
$t_coaching_list->renderListOptions();

// Render list options (header, left)
$t_coaching_list->ListOptions->render("header", "left");
?>
<?php if ($t_coaching_list->kdtahapan->Visible) { // kdtahapan ?>
	<?php if ($t_coaching_list->SortUrl($t_coaching_list->kdtahapan) == "") { ?>
		<th data-name="kdtahapan" class="<?php echo $t_coaching_list->kdtahapan->headerCellClass() ?>"><div id="elh_t_coaching_kdtahapan" class="t_coaching_kdtahapan"><div class="ew-table-header-caption"><?php echo $t_coaching_list->kdtahapan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdtahapan" class="<?php echo $t_coaching_list->kdtahapan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coaching_list->SortUrl($t_coaching_list->kdtahapan) ?>', 1);"><div id="elh_t_coaching_kdtahapan" class="t_coaching_kdtahapan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coaching_list->kdtahapan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coaching_list->kdtahapan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coaching_list->kdtahapan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coaching_list->kdkursil->Visible) { // kdkursil ?>
	<?php if ($t_coaching_list->SortUrl($t_coaching_list->kdkursil) == "") { ?>
		<th data-name="kdkursil" class="<?php echo $t_coaching_list->kdkursil->headerCellClass() ?>"><div id="elh_t_coaching_kdkursil" class="t_coaching_kdkursil"><div class="ew-table-header-caption"><?php echo $t_coaching_list->kdkursil->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkursil" class="<?php echo $t_coaching_list->kdkursil->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coaching_list->SortUrl($t_coaching_list->kdkursil) ?>', 1);"><div id="elh_t_coaching_kdkursil" class="t_coaching_kdkursil">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coaching_list->kdkursil->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coaching_list->kdkursil->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coaching_list->kdkursil->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coaching_list->tawal->Visible) { // tawal ?>
	<?php if ($t_coaching_list->SortUrl($t_coaching_list->tawal) == "") { ?>
		<th data-name="tawal" class="<?php echo $t_coaching_list->tawal->headerCellClass() ?>"><div id="elh_t_coaching_tawal" class="t_coaching_tawal"><div class="ew-table-header-caption"><?php echo $t_coaching_list->tawal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tawal" class="<?php echo $t_coaching_list->tawal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coaching_list->SortUrl($t_coaching_list->tawal) ?>', 1);"><div id="elh_t_coaching_tawal" class="t_coaching_tawal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coaching_list->tawal->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coaching_list->tawal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coaching_list->tawal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coaching_list->takhir->Visible) { // takhir ?>
	<?php if ($t_coaching_list->SortUrl($t_coaching_list->takhir) == "") { ?>
		<th data-name="takhir" class="<?php echo $t_coaching_list->takhir->headerCellClass() ?>"><div id="elh_t_coaching_takhir" class="t_coaching_takhir"><div class="ew-table-header-caption"><?php echo $t_coaching_list->takhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="takhir" class="<?php echo $t_coaching_list->takhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coaching_list->SortUrl($t_coaching_list->takhir) ?>', 1);"><div id="elh_t_coaching_takhir" class="t_coaching_takhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coaching_list->takhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coaching_list->takhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coaching_list->takhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coaching_list->jmlhari->Visible) { // jmlhari ?>
	<?php if ($t_coaching_list->SortUrl($t_coaching_list->jmlhari) == "") { ?>
		<th data-name="jmlhari" class="<?php echo $t_coaching_list->jmlhari->headerCellClass() ?>"><div id="elh_t_coaching_jmlhari" class="t_coaching_jmlhari"><div class="ew-table-header-caption"><?php echo $t_coaching_list->jmlhari->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jmlhari" class="<?php echo $t_coaching_list->jmlhari->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coaching_list->SortUrl($t_coaching_list->jmlhari) ?>', 1);"><div id="elh_t_coaching_jmlhari" class="t_coaching_jmlhari">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coaching_list->jmlhari->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coaching_list->jmlhari->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coaching_list->jmlhari->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coaching_list->kdprop->Visible) { // kdprop ?>
	<?php if ($t_coaching_list->SortUrl($t_coaching_list->kdprop) == "") { ?>
		<th data-name="kdprop" class="<?php echo $t_coaching_list->kdprop->headerCellClass() ?>"><div id="elh_t_coaching_kdprop" class="t_coaching_kdprop"><div class="ew-table-header-caption"><?php echo $t_coaching_list->kdprop->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdprop" class="<?php echo $t_coaching_list->kdprop->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coaching_list->SortUrl($t_coaching_list->kdprop) ?>', 1);"><div id="elh_t_coaching_kdprop" class="t_coaching_kdprop">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coaching_list->kdprop->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coaching_list->kdprop->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coaching_list->kdprop->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coaching_list->ketua->Visible) { // ketua ?>
	<?php if ($t_coaching_list->SortUrl($t_coaching_list->ketua) == "") { ?>
		<th data-name="ketua" class="<?php echo $t_coaching_list->ketua->headerCellClass() ?>"><div id="elh_t_coaching_ketua" class="t_coaching_ketua"><div class="ew-table-header-caption"><?php echo $t_coaching_list->ketua->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ketua" class="<?php echo $t_coaching_list->ketua->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coaching_list->SortUrl($t_coaching_list->ketua) ?>', 1);"><div id="elh_t_coaching_ketua" class="t_coaching_ketua">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coaching_list->ketua->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coaching_list->ketua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coaching_list->ketua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coaching_list->sekretaris->Visible) { // sekretaris ?>
	<?php if ($t_coaching_list->SortUrl($t_coaching_list->sekretaris) == "") { ?>
		<th data-name="sekretaris" class="<?php echo $t_coaching_list->sekretaris->headerCellClass() ?>"><div id="elh_t_coaching_sekretaris" class="t_coaching_sekretaris"><div class="ew-table-header-caption"><?php echo $t_coaching_list->sekretaris->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sekretaris" class="<?php echo $t_coaching_list->sekretaris->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coaching_list->SortUrl($t_coaching_list->sekretaris) ?>', 1);"><div id="elh_t_coaching_sekretaris" class="t_coaching_sekretaris">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coaching_list->sekretaris->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coaching_list->sekretaris->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coaching_list->sekretaris->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coaching_list->bendahara->Visible) { // bendahara ?>
	<?php if ($t_coaching_list->SortUrl($t_coaching_list->bendahara) == "") { ?>
		<th data-name="bendahara" class="<?php echo $t_coaching_list->bendahara->headerCellClass() ?>"><div id="elh_t_coaching_bendahara" class="t_coaching_bendahara"><div class="ew-table-header-caption"><?php echo $t_coaching_list->bendahara->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bendahara" class="<?php echo $t_coaching_list->bendahara->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coaching_list->SortUrl($t_coaching_list->bendahara) ?>', 1);"><div id="elh_t_coaching_bendahara" class="t_coaching_bendahara">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coaching_list->bendahara->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coaching_list->bendahara->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coaching_list->bendahara->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coaching_list->status->Visible) { // status ?>
	<?php if ($t_coaching_list->SortUrl($t_coaching_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $t_coaching_list->status->headerCellClass() ?>"><div id="elh_t_coaching_status" class="t_coaching_status"><div class="ew-table-header-caption"><?php echo $t_coaching_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $t_coaching_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coaching_list->SortUrl($t_coaching_list->status) ?>', 1);"><div id="elh_t_coaching_status" class="t_coaching_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coaching_list->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coaching_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coaching_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coaching_list->jenisevaluasi->Visible) { // jenisevaluasi ?>
	<?php if ($t_coaching_list->SortUrl($t_coaching_list->jenisevaluasi) == "") { ?>
		<th data-name="jenisevaluasi" class="<?php echo $t_coaching_list->jenisevaluasi->headerCellClass() ?>"><div id="elh_t_coaching_jenisevaluasi" class="t_coaching_jenisevaluasi"><div class="ew-table-header-caption"><?php echo $t_coaching_list->jenisevaluasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenisevaluasi" class="<?php echo $t_coaching_list->jenisevaluasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coaching_list->SortUrl($t_coaching_list->jenisevaluasi) ?>', 1);"><div id="elh_t_coaching_jenisevaluasi" class="t_coaching_jenisevaluasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coaching_list->jenisevaluasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coaching_list->jenisevaluasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coaching_list->jenisevaluasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_coaching_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_coaching_list->ExportAll && $t_coaching_list->isExport()) {
	$t_coaching_list->StopRecord = $t_coaching_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_coaching_list->TotalRecords > $t_coaching_list->StartRecord + $t_coaching_list->DisplayRecords - 1)
		$t_coaching_list->StopRecord = $t_coaching_list->StartRecord + $t_coaching_list->DisplayRecords - 1;
	else
		$t_coaching_list->StopRecord = $t_coaching_list->TotalRecords;
}
$t_coaching_list->RecordCount = $t_coaching_list->StartRecord - 1;
if ($t_coaching_list->Recordset && !$t_coaching_list->Recordset->EOF) {
	$t_coaching_list->Recordset->moveFirst();
	$selectLimit = $t_coaching_list->UseSelectLimit;
	if (!$selectLimit && $t_coaching_list->StartRecord > 1)
		$t_coaching_list->Recordset->move($t_coaching_list->StartRecord - 1);
} elseif (!$t_coaching->AllowAddDeleteRow && $t_coaching_list->StopRecord == 0) {
	$t_coaching_list->StopRecord = $t_coaching->GridAddRowCount;
}

// Initialize aggregate
$t_coaching->RowType = ROWTYPE_AGGREGATEINIT;
$t_coaching->resetAttributes();
$t_coaching_list->renderRow();
while ($t_coaching_list->RecordCount < $t_coaching_list->StopRecord) {
	$t_coaching_list->RecordCount++;
	if ($t_coaching_list->RecordCount >= $t_coaching_list->StartRecord) {
		$t_coaching_list->RowCount++;

		// Set up key count
		$t_coaching_list->KeyCount = $t_coaching_list->RowIndex;

		// Init row class and style
		$t_coaching->resetAttributes();
		$t_coaching->CssClass = "";
		if ($t_coaching_list->isGridAdd()) {
		} else {
			$t_coaching_list->loadRowValues($t_coaching_list->Recordset); // Load row values
		}
		$t_coaching->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_coaching->RowAttrs->merge(["data-rowindex" => $t_coaching_list->RowCount, "id" => "r" . $t_coaching_list->RowCount . "_t_coaching", "data-rowtype" => $t_coaching->RowType]);

		// Render row
		$t_coaching_list->renderRow();

		// Render list options
		$t_coaching_list->renderListOptions();
?>
	<tr <?php echo $t_coaching->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_coaching_list->ListOptions->render("body", "left", $t_coaching_list->RowCount);
?>
	<?php if ($t_coaching_list->kdtahapan->Visible) { // kdtahapan ?>
		<td data-name="kdtahapan" <?php echo $t_coaching_list->kdtahapan->cellAttributes() ?>>
<span id="el<?php echo $t_coaching_list->RowCount ?>_t_coaching_kdtahapan">
<span<?php echo $t_coaching_list->kdtahapan->viewAttributes() ?>><?php echo $t_coaching_list->kdtahapan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coaching_list->kdkursil->Visible) { // kdkursil ?>
		<td data-name="kdkursil" <?php echo $t_coaching_list->kdkursil->cellAttributes() ?>>
<span id="el<?php echo $t_coaching_list->RowCount ?>_t_coaching_kdkursil">
<span<?php echo $t_coaching_list->kdkursil->viewAttributes() ?>><?php echo $t_coaching_list->kdkursil->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coaching_list->tawal->Visible) { // tawal ?>
		<td data-name="tawal" <?php echo $t_coaching_list->tawal->cellAttributes() ?>>
<span id="el<?php echo $t_coaching_list->RowCount ?>_t_coaching_tawal">
<span<?php echo $t_coaching_list->tawal->viewAttributes() ?>><?php echo $t_coaching_list->tawal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coaching_list->takhir->Visible) { // takhir ?>
		<td data-name="takhir" <?php echo $t_coaching_list->takhir->cellAttributes() ?>>
<span id="el<?php echo $t_coaching_list->RowCount ?>_t_coaching_takhir">
<span<?php echo $t_coaching_list->takhir->viewAttributes() ?>><?php echo $t_coaching_list->takhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coaching_list->jmlhari->Visible) { // jmlhari ?>
		<td data-name="jmlhari" <?php echo $t_coaching_list->jmlhari->cellAttributes() ?>>
<span id="el<?php echo $t_coaching_list->RowCount ?>_t_coaching_jmlhari">
<span<?php echo $t_coaching_list->jmlhari->viewAttributes() ?>><?php echo $t_coaching_list->jmlhari->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coaching_list->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" <?php echo $t_coaching_list->kdprop->cellAttributes() ?>>
<span id="el<?php echo $t_coaching_list->RowCount ?>_t_coaching_kdprop">
<span<?php echo $t_coaching_list->kdprop->viewAttributes() ?>><?php echo $t_coaching_list->kdprop->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coaching_list->ketua->Visible) { // ketua ?>
		<td data-name="ketua" <?php echo $t_coaching_list->ketua->cellAttributes() ?>>
<span id="el<?php echo $t_coaching_list->RowCount ?>_t_coaching_ketua">
<span<?php echo $t_coaching_list->ketua->viewAttributes() ?>><?php echo $t_coaching_list->ketua->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coaching_list->sekretaris->Visible) { // sekretaris ?>
		<td data-name="sekretaris" <?php echo $t_coaching_list->sekretaris->cellAttributes() ?>>
<span id="el<?php echo $t_coaching_list->RowCount ?>_t_coaching_sekretaris">
<span<?php echo $t_coaching_list->sekretaris->viewAttributes() ?>><?php echo $t_coaching_list->sekretaris->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coaching_list->bendahara->Visible) { // bendahara ?>
		<td data-name="bendahara" <?php echo $t_coaching_list->bendahara->cellAttributes() ?>>
<span id="el<?php echo $t_coaching_list->RowCount ?>_t_coaching_bendahara">
<span<?php echo $t_coaching_list->bendahara->viewAttributes() ?>><?php echo $t_coaching_list->bendahara->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coaching_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $t_coaching_list->status->cellAttributes() ?>>
<span id="el<?php echo $t_coaching_list->RowCount ?>_t_coaching_status">
<span<?php echo $t_coaching_list->status->viewAttributes() ?>><?php echo $t_coaching_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coaching_list->jenisevaluasi->Visible) { // jenisevaluasi ?>
		<td data-name="jenisevaluasi" <?php echo $t_coaching_list->jenisevaluasi->cellAttributes() ?>>
<span id="el<?php echo $t_coaching_list->RowCount ?>_t_coaching_jenisevaluasi">
<span<?php echo $t_coaching_list->jenisevaluasi->viewAttributes() ?>><?php echo $t_coaching_list->jenisevaluasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_coaching_list->ListOptions->render("body", "right", $t_coaching_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_coaching_list->isGridAdd())
		$t_coaching_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_coaching->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_coaching_list->Recordset)
	$t_coaching_list->Recordset->Close();
?>
<?php if (!$t_coaching_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_coaching_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_coaching_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_coaching_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_coaching_list->TotalRecords == 0 && !$t_coaching->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_coaching_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_coaching_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_coaching_list->isExport()) { ?>
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
$t_coaching_list->terminate();
?>