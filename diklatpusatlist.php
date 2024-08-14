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
$diklatpusat_list = new diklatpusat_list();

// Run the page
$diklatpusat_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$diklatpusat_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$diklatpusat_list->isExport()) { ?>
<script>
var fdiklatpusatlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdiklatpusatlist = currentForm = new ew.Form("fdiklatpusatlist", "list");
	fdiklatpusatlist.formKeyCountName = '<?php echo $diklatpusat_list->FormKeyCountName ?>';
	loadjs.done("fdiklatpusatlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$diklatpusat_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($diklatpusat_list->TotalRecords > 0 && $diklatpusat_list->ExportOptions->visible()) { ?>
<?php $diklatpusat_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($diklatpusat_list->ImportOptions->visible()) { ?>
<?php $diklatpusat_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$diklatpusat_list->isExport() || Config("EXPORT_MASTER_RECORD") && $diklatpusat_list->isExport("print")) { ?>
<?php
if ($diklatpusat_list->DbMasterFilter != "" && $diklatpusat->getCurrentMasterTable() == "t_rpdiklat") {
	if ($diklatpusat_list->MasterRecordExists) {
		include_once "t_rpdiklatmaster.php";
	}
}
?>
<?php } ?>
<?php
$diklatpusat_list->renderOtherOptions();
?>
<?php $diklatpusat_list->showPageHeader(); ?>
<?php
$diklatpusat_list->showMessage();
?>
<?php if ($diklatpusat_list->TotalRecords > 0 || $diklatpusat->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($diklatpusat_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> diklatpusat">
<?php if (!$diklatpusat_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$diklatpusat_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $diklatpusat_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $diklatpusat_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdiklatpusatlist" id="fdiklatpusatlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="diklatpusat">
<?php if ($diklatpusat->getCurrentMasterTable() == "t_rpdiklat" && $diklatpusat->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_rpdiklat">
<input type="hidden" name="fk_rpdid" value="<?php echo HtmlEncode($diklatpusat_list->rid->getSessionValue()) ?>">
<input type="hidden" name="fk_kdjudul" value="<?php echo HtmlEncode($diklatpusat_list->kdjudul->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_diklatpusat" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($diklatpusat_list->TotalRecords > 0 || $diklatpusat_list->isGridEdit()) { ?>
<table id="tbl_diklatpusatlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$diklatpusat->RowType = ROWTYPE_HEADER;

// Render list options
$diklatpusat_list->renderListOptions();

// Render list options (header, left)
$diklatpusat_list->ListOptions->render("header", "left");
?>
<?php if ($diklatpusat_list->kdjudul->Visible) { // kdjudul ?>
	<?php if ($diklatpusat_list->SortUrl($diklatpusat_list->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $diklatpusat_list->kdjudul->headerCellClass() ?>"><div id="elh_diklatpusat_kdjudul" class="diklatpusat_kdjudul"><div class="ew-table-header-caption"><?php echo $diklatpusat_list->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $diklatpusat_list->kdjudul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatpusat_list->SortUrl($diklatpusat_list->kdjudul) ?>', 1);"><div id="elh_diklatpusat_kdjudul" class="diklatpusat_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_list->kdjudul->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_list->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_list->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatpusat_list->tawal->Visible) { // tawal ?>
	<?php if ($diklatpusat_list->SortUrl($diklatpusat_list->tawal) == "") { ?>
		<th data-name="tawal" class="<?php echo $diklatpusat_list->tawal->headerCellClass() ?>"><div id="elh_diklatpusat_tawal" class="diklatpusat_tawal"><div class="ew-table-header-caption"><?php echo $diklatpusat_list->tawal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tawal" class="<?php echo $diklatpusat_list->tawal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatpusat_list->SortUrl($diklatpusat_list->tawal) ?>', 1);"><div id="elh_diklatpusat_tawal" class="diklatpusat_tawal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_list->tawal->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_list->tawal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_list->tawal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatpusat_list->takhir->Visible) { // takhir ?>
	<?php if ($diklatpusat_list->SortUrl($diklatpusat_list->takhir) == "") { ?>
		<th data-name="takhir" class="<?php echo $diklatpusat_list->takhir->headerCellClass() ?>"><div id="elh_diklatpusat_takhir" class="diklatpusat_takhir"><div class="ew-table-header-caption"><?php echo $diklatpusat_list->takhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="takhir" class="<?php echo $diklatpusat_list->takhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatpusat_list->SortUrl($diklatpusat_list->takhir) ?>', 1);"><div id="elh_diklatpusat_takhir" class="diklatpusat_takhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_list->takhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_list->takhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_list->takhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatpusat_list->dana->Visible) { // dana ?>
	<?php if ($diklatpusat_list->SortUrl($diklatpusat_list->dana) == "") { ?>
		<th data-name="dana" class="<?php echo $diklatpusat_list->dana->headerCellClass() ?>"><div id="elh_diklatpusat_dana" class="diklatpusat_dana"><div class="ew-table-header-caption"><?php echo $diklatpusat_list->dana->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="dana" class="<?php echo $diklatpusat_list->dana->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatpusat_list->SortUrl($diklatpusat_list->dana) ?>', 1);"><div id="elh_diklatpusat_dana" class="diklatpusat_dana">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_list->dana->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_list->dana->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_list->dana->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatpusat_list->ketua->Visible) { // ketua ?>
	<?php if ($diklatpusat_list->SortUrl($diklatpusat_list->ketua) == "") { ?>
		<th data-name="ketua" class="<?php echo $diklatpusat_list->ketua->headerCellClass() ?>"><div id="elh_diklatpusat_ketua" class="diklatpusat_ketua"><div class="ew-table-header-caption"><?php echo $diklatpusat_list->ketua->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ketua" class="<?php echo $diklatpusat_list->ketua->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatpusat_list->SortUrl($diklatpusat_list->ketua) ?>', 1);"><div id="elh_diklatpusat_ketua" class="diklatpusat_ketua">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_list->ketua->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_list->ketua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_list->ketua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatpusat_list->sekretaris->Visible) { // sekretaris ?>
	<?php if ($diklatpusat_list->SortUrl($diklatpusat_list->sekretaris) == "") { ?>
		<th data-name="sekretaris" class="<?php echo $diklatpusat_list->sekretaris->headerCellClass() ?>"><div id="elh_diklatpusat_sekretaris" class="diklatpusat_sekretaris"><div class="ew-table-header-caption"><?php echo $diklatpusat_list->sekretaris->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sekretaris" class="<?php echo $diklatpusat_list->sekretaris->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatpusat_list->SortUrl($diklatpusat_list->sekretaris) ?>', 1);"><div id="elh_diklatpusat_sekretaris" class="diklatpusat_sekretaris">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_list->sekretaris->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_list->sekretaris->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_list->sekretaris->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatpusat_list->bendahara->Visible) { // bendahara ?>
	<?php if ($diklatpusat_list->SortUrl($diklatpusat_list->bendahara) == "") { ?>
		<th data-name="bendahara" class="<?php echo $diklatpusat_list->bendahara->headerCellClass() ?>"><div id="elh_diklatpusat_bendahara" class="diklatpusat_bendahara"><div class="ew-table-header-caption"><?php echo $diklatpusat_list->bendahara->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bendahara" class="<?php echo $diklatpusat_list->bendahara->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatpusat_list->SortUrl($diklatpusat_list->bendahara) ?>', 1);"><div id="elh_diklatpusat_bendahara" class="diklatpusat_bendahara">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_list->bendahara->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_list->bendahara->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_list->bendahara->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatpusat_list->anggota2->Visible) { // anggota2 ?>
	<?php if ($diklatpusat_list->SortUrl($diklatpusat_list->anggota2) == "") { ?>
		<th data-name="anggota2" class="<?php echo $diklatpusat_list->anggota2->headerCellClass() ?>"><div id="elh_diklatpusat_anggota2" class="diklatpusat_anggota2"><div class="ew-table-header-caption"><?php echo $diklatpusat_list->anggota2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="anggota2" class="<?php echo $diklatpusat_list->anggota2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatpusat_list->SortUrl($diklatpusat_list->anggota2) ?>', 1);"><div id="elh_diklatpusat_anggota2" class="diklatpusat_anggota2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_list->anggota2->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_list->anggota2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_list->anggota2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatpusat_list->widyaiswara->Visible) { // widyaiswara ?>
	<?php if ($diklatpusat_list->SortUrl($diklatpusat_list->widyaiswara) == "") { ?>
		<th data-name="widyaiswara" class="<?php echo $diklatpusat_list->widyaiswara->headerCellClass() ?>"><div id="elh_diklatpusat_widyaiswara" class="diklatpusat_widyaiswara"><div class="ew-table-header-caption"><?php echo $diklatpusat_list->widyaiswara->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="widyaiswara" class="<?php echo $diklatpusat_list->widyaiswara->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatpusat_list->SortUrl($diklatpusat_list->widyaiswara) ?>', 1);"><div id="elh_diklatpusat_widyaiswara" class="diklatpusat_widyaiswara">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_list->widyaiswara->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_list->widyaiswara->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_list->widyaiswara->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatpusat_list->statuspel->Visible) { // statuspel ?>
	<?php if ($diklatpusat_list->SortUrl($diklatpusat_list->statuspel) == "") { ?>
		<th data-name="statuspel" class="<?php echo $diklatpusat_list->statuspel->headerCellClass() ?>"><div id="elh_diklatpusat_statuspel" class="diklatpusat_statuspel"><div class="ew-table-header-caption"><?php echo $diklatpusat_list->statuspel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="statuspel" class="<?php echo $diklatpusat_list->statuspel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatpusat_list->SortUrl($diklatpusat_list->statuspel) ?>', 1);"><div id="elh_diklatpusat_statuspel" class="diklatpusat_statuspel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_list->statuspel->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_list->statuspel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_list->statuspel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatpusat_list->ket->Visible) { // ket ?>
	<?php if ($diklatpusat_list->SortUrl($diklatpusat_list->ket) == "") { ?>
		<th data-name="ket" class="<?php echo $diklatpusat_list->ket->headerCellClass() ?>"><div id="elh_diklatpusat_ket" class="diklatpusat_ket"><div class="ew-table-header-caption"><?php echo $diklatpusat_list->ket->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ket" class="<?php echo $diklatpusat_list->ket->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatpusat_list->SortUrl($diklatpusat_list->ket) ?>', 1);"><div id="elh_diklatpusat_ket" class="diklatpusat_ket">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_list->ket->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_list->ket->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_list->ket->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($diklatpusat_list->jenisevaluasi->Visible) { // jenisevaluasi ?>
	<?php if ($diklatpusat_list->SortUrl($diklatpusat_list->jenisevaluasi) == "") { ?>
		<th data-name="jenisevaluasi" class="<?php echo $diklatpusat_list->jenisevaluasi->headerCellClass() ?>"><div id="elh_diklatpusat_jenisevaluasi" class="diklatpusat_jenisevaluasi"><div class="ew-table-header-caption"><?php echo $diklatpusat_list->jenisevaluasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenisevaluasi" class="<?php echo $diklatpusat_list->jenisevaluasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $diklatpusat_list->SortUrl($diklatpusat_list->jenisevaluasi) ?>', 1);"><div id="elh_diklatpusat_jenisevaluasi" class="diklatpusat_jenisevaluasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $diklatpusat_list->jenisevaluasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($diklatpusat_list->jenisevaluasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($diklatpusat_list->jenisevaluasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$diklatpusat_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($diklatpusat_list->ExportAll && $diklatpusat_list->isExport()) {
	$diklatpusat_list->StopRecord = $diklatpusat_list->TotalRecords;
} else {

	// Set the last record to display
	if ($diklatpusat_list->TotalRecords > $diklatpusat_list->StartRecord + $diklatpusat_list->DisplayRecords - 1)
		$diklatpusat_list->StopRecord = $diklatpusat_list->StartRecord + $diklatpusat_list->DisplayRecords - 1;
	else
		$diklatpusat_list->StopRecord = $diklatpusat_list->TotalRecords;
}
$diklatpusat_list->RecordCount = $diklatpusat_list->StartRecord - 1;
if ($diklatpusat_list->Recordset && !$diklatpusat_list->Recordset->EOF) {
	$diklatpusat_list->Recordset->moveFirst();
	$selectLimit = $diklatpusat_list->UseSelectLimit;
	if (!$selectLimit && $diklatpusat_list->StartRecord > 1)
		$diklatpusat_list->Recordset->move($diklatpusat_list->StartRecord - 1);
} elseif (!$diklatpusat->AllowAddDeleteRow && $diklatpusat_list->StopRecord == 0) {
	$diklatpusat_list->StopRecord = $diklatpusat->GridAddRowCount;
}

// Initialize aggregate
$diklatpusat->RowType = ROWTYPE_AGGREGATEINIT;
$diklatpusat->resetAttributes();
$diklatpusat_list->renderRow();
while ($diklatpusat_list->RecordCount < $diklatpusat_list->StopRecord) {
	$diklatpusat_list->RecordCount++;
	if ($diklatpusat_list->RecordCount >= $diklatpusat_list->StartRecord) {
		$diklatpusat_list->RowCount++;

		// Set up key count
		$diklatpusat_list->KeyCount = $diklatpusat_list->RowIndex;

		// Init row class and style
		$diklatpusat->resetAttributes();
		$diklatpusat->CssClass = "";
		if ($diklatpusat_list->isGridAdd()) {
		} else {
			$diklatpusat_list->loadRowValues($diklatpusat_list->Recordset); // Load row values
		}
		$diklatpusat->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$diklatpusat->RowAttrs->merge(["data-rowindex" => $diklatpusat_list->RowCount, "id" => "r" . $diklatpusat_list->RowCount . "_diklatpusat", "data-rowtype" => $diklatpusat->RowType]);

		// Render row
		$diklatpusat_list->renderRow();

		// Render list options
		$diklatpusat_list->renderListOptions();
?>
	<tr <?php echo $diklatpusat->rowAttributes() ?>>
<?php

// Render list options (body, left)
$diklatpusat_list->ListOptions->render("body", "left", $diklatpusat_list->RowCount);
?>
	<?php if ($diklatpusat_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $diklatpusat_list->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $diklatpusat_list->RowCount ?>_diklatpusat_kdjudul">
<span<?php echo $diklatpusat_list->kdjudul->viewAttributes() ?>><?php echo $diklatpusat_list->kdjudul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatpusat_list->tawal->Visible) { // tawal ?>
		<td data-name="tawal" <?php echo $diklatpusat_list->tawal->cellAttributes() ?>>
<span id="el<?php echo $diklatpusat_list->RowCount ?>_diklatpusat_tawal">
<span<?php echo $diklatpusat_list->tawal->viewAttributes() ?>><?php echo $diklatpusat_list->tawal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatpusat_list->takhir->Visible) { // takhir ?>
		<td data-name="takhir" <?php echo $diklatpusat_list->takhir->cellAttributes() ?>>
<span id="el<?php echo $diklatpusat_list->RowCount ?>_diklatpusat_takhir">
<span<?php echo $diklatpusat_list->takhir->viewAttributes() ?>><?php echo $diklatpusat_list->takhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatpusat_list->dana->Visible) { // dana ?>
		<td data-name="dana" <?php echo $diklatpusat_list->dana->cellAttributes() ?>>
<span id="el<?php echo $diklatpusat_list->RowCount ?>_diklatpusat_dana">
<span<?php echo $diklatpusat_list->dana->viewAttributes() ?>><?php echo $diklatpusat_list->dana->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatpusat_list->ketua->Visible) { // ketua ?>
		<td data-name="ketua" <?php echo $diklatpusat_list->ketua->cellAttributes() ?>>
<span id="el<?php echo $diklatpusat_list->RowCount ?>_diklatpusat_ketua">
<span<?php echo $diklatpusat_list->ketua->viewAttributes() ?>><?php echo $diklatpusat_list->ketua->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatpusat_list->sekretaris->Visible) { // sekretaris ?>
		<td data-name="sekretaris" <?php echo $diklatpusat_list->sekretaris->cellAttributes() ?>>
<span id="el<?php echo $diklatpusat_list->RowCount ?>_diklatpusat_sekretaris">
<span<?php echo $diklatpusat_list->sekretaris->viewAttributes() ?>><?php echo $diklatpusat_list->sekretaris->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatpusat_list->bendahara->Visible) { // bendahara ?>
		<td data-name="bendahara" <?php echo $diklatpusat_list->bendahara->cellAttributes() ?>>
<span id="el<?php echo $diklatpusat_list->RowCount ?>_diklatpusat_bendahara">
<span<?php echo $diklatpusat_list->bendahara->viewAttributes() ?>><?php echo $diklatpusat_list->bendahara->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatpusat_list->anggota2->Visible) { // anggota2 ?>
		<td data-name="anggota2" <?php echo $diklatpusat_list->anggota2->cellAttributes() ?>>
<span id="el<?php echo $diklatpusat_list->RowCount ?>_diklatpusat_anggota2">
<span<?php echo $diklatpusat_list->anggota2->viewAttributes() ?>><?php echo $diklatpusat_list->anggota2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatpusat_list->widyaiswara->Visible) { // widyaiswara ?>
		<td data-name="widyaiswara" <?php echo $diklatpusat_list->widyaiswara->cellAttributes() ?>>
<span id="el<?php echo $diklatpusat_list->RowCount ?>_diklatpusat_widyaiswara">
<span<?php echo $diklatpusat_list->widyaiswara->viewAttributes() ?>><?php echo $diklatpusat_list->widyaiswara->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatpusat_list->statuspel->Visible) { // statuspel ?>
		<td data-name="statuspel" <?php echo $diklatpusat_list->statuspel->cellAttributes() ?>>
<span id="el<?php echo $diklatpusat_list->RowCount ?>_diklatpusat_statuspel">
<span<?php echo $diklatpusat_list->statuspel->viewAttributes() ?>><?php echo $diklatpusat_list->statuspel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatpusat_list->ket->Visible) { // ket ?>
		<td data-name="ket" <?php echo $diklatpusat_list->ket->cellAttributes() ?>>
<span id="el<?php echo $diklatpusat_list->RowCount ?>_diklatpusat_ket">
<span<?php echo $diklatpusat_list->ket->viewAttributes() ?>><?php echo $diklatpusat_list->ket->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($diklatpusat_list->jenisevaluasi->Visible) { // jenisevaluasi ?>
		<td data-name="jenisevaluasi" <?php echo $diklatpusat_list->jenisevaluasi->cellAttributes() ?>>
<span id="el<?php echo $diklatpusat_list->RowCount ?>_diklatpusat_jenisevaluasi">
<span<?php echo $diklatpusat_list->jenisevaluasi->viewAttributes() ?>><?php echo $diklatpusat_list->jenisevaluasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$diklatpusat_list->ListOptions->render("body", "right", $diklatpusat_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$diklatpusat_list->isGridAdd())
		$diklatpusat_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$diklatpusat->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($diklatpusat_list->Recordset)
	$diklatpusat_list->Recordset->Close();
?>
<?php if (!$diklatpusat_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$diklatpusat_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $diklatpusat_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $diklatpusat_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($diklatpusat_list->TotalRecords == 0 && !$diklatpusat->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $diklatpusat_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$diklatpusat_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$diklatpusat_list->isExport()) { ?>
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
$diklatpusat_list->terminate();
?>