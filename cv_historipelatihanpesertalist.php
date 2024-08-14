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
$cv_historipelatihanpeserta_list = new cv_historipelatihanpeserta_list();

// Run the page
$cv_historipelatihanpeserta_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cv_historipelatihanpeserta_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cv_historipelatihanpeserta_list->isExport()) { ?>
<script>
var fcv_historipelatihanpesertalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcv_historipelatihanpesertalist = currentForm = new ew.Form("fcv_historipelatihanpesertalist", "list");
	fcv_historipelatihanpesertalist.formKeyCountName = '<?php echo $cv_historipelatihanpeserta_list->FormKeyCountName ?>';
	loadjs.done("fcv_historipelatihanpesertalist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//document.write('<?php echo cs_judul("list","Riwayat Pelatihan Peserta");?>');

});
</script>
<?php } ?>
<?php if (!$cv_historipelatihanpeserta_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cv_historipelatihanpeserta_list->TotalRecords > 0 && $cv_historipelatihanpeserta_list->ExportOptions->visible()) { ?>
<?php $cv_historipelatihanpeserta_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_list->ImportOptions->visible()) { ?>
<?php $cv_historipelatihanpeserta_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$cv_historipelatihanpeserta_list->isExport() || Config("EXPORT_MASTER_RECORD") && $cv_historipelatihanpeserta_list->isExport("print")) { ?>
<?php
if ($cv_historipelatihanpeserta_list->DbMasterFilter != "" && $cv_historipelatihanpeserta->getCurrentMasterTable() == "t_peserta") {
	if ($cv_historipelatihanpeserta_list->MasterRecordExists) {
		include_once "t_pesertamaster.php";
	}
}
?>
<?php } ?>
<?php
$cv_historipelatihanpeserta_list->renderOtherOptions();
?>
<?php $cv_historipelatihanpeserta_list->showPageHeader(); ?>
<?php
$cv_historipelatihanpeserta_list->showMessage();
?>
<?php if ($cv_historipelatihanpeserta_list->TotalRecords > 0 || $cv_historipelatihanpeserta->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cv_historipelatihanpeserta_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cv_historipelatihanpeserta">
<?php if (!$cv_historipelatihanpeserta_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$cv_historipelatihanpeserta_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cv_historipelatihanpeserta_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cv_historipelatihanpeserta_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcv_historipelatihanpesertalist" id="fcv_historipelatihanpesertalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cv_historipelatihanpeserta">
<?php if ($cv_historipelatihanpeserta->getCurrentMasterTable() == "t_peserta" && $cv_historipelatihanpeserta->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_peserta">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($cv_historipelatihanpeserta_list->id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_cv_historipelatihanpeserta" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($cv_historipelatihanpeserta_list->TotalRecords > 0 || $cv_historipelatihanpeserta_list->isGridEdit()) { ?>
<table id="tbl_cv_historipelatihanpesertalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cv_historipelatihanpeserta->RowType = ROWTYPE_HEADER;

// Render list options
$cv_historipelatihanpeserta_list->renderListOptions();

// Render list options (header, left)
$cv_historipelatihanpeserta_list->ListOptions->render("header", "left");
?>
<?php if ($cv_historipelatihanpeserta_list->kdhistori->Visible) { // kdhistori ?>
	<?php if ($cv_historipelatihanpeserta_list->SortUrl($cv_historipelatihanpeserta_list->kdhistori) == "") { ?>
		<th data-name="kdhistori" class="<?php echo $cv_historipelatihanpeserta_list->kdhistori->headerCellClass() ?>"><div id="elh_cv_historipelatihanpeserta_kdhistori" class="cv_historipelatihanpeserta_kdhistori"><div class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_list->kdhistori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdhistori" class="<?php echo $cv_historipelatihanpeserta_list->kdhistori->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_historipelatihanpeserta_list->SortUrl($cv_historipelatihanpeserta_list->kdhistori) ?>', 1);"><div id="elh_cv_historipelatihanpeserta_kdhistori" class="cv_historipelatihanpeserta_kdhistori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_list->kdhistori->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipelatihanpeserta_list->kdhistori->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipelatihanpeserta_list->kdhistori->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_list->id->Visible) { // id ?>
	<?php if ($cv_historipelatihanpeserta_list->SortUrl($cv_historipelatihanpeserta_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $cv_historipelatihanpeserta_list->id->headerCellClass() ?>"><div id="elh_cv_historipelatihanpeserta_id" class="cv_historipelatihanpeserta_id"><div class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $cv_historipelatihanpeserta_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_historipelatihanpeserta_list->SortUrl($cv_historipelatihanpeserta_list->id) ?>', 1);"><div id="elh_cv_historipelatihanpeserta_id" class="cv_historipelatihanpeserta_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipelatihanpeserta_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipelatihanpeserta_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_list->kdpelat->Visible) { // kdpelat ?>
	<?php if ($cv_historipelatihanpeserta_list->SortUrl($cv_historipelatihanpeserta_list->kdpelat) == "") { ?>
		<th data-name="kdpelat" class="<?php echo $cv_historipelatihanpeserta_list->kdpelat->headerCellClass() ?>"><div id="elh_cv_historipelatihanpeserta_kdpelat" class="cv_historipelatihanpeserta_kdpelat"><div class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_list->kdpelat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdpelat" class="<?php echo $cv_historipelatihanpeserta_list->kdpelat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_historipelatihanpeserta_list->SortUrl($cv_historipelatihanpeserta_list->kdpelat) ?>', 1);"><div id="elh_cv_historipelatihanpeserta_kdpelat" class="cv_historipelatihanpeserta_kdpelat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_list->kdpelat->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipelatihanpeserta_list->kdpelat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipelatihanpeserta_list->kdpelat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_list->tahun->Visible) { // tahun ?>
	<?php if ($cv_historipelatihanpeserta_list->SortUrl($cv_historipelatihanpeserta_list->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $cv_historipelatihanpeserta_list->tahun->headerCellClass() ?>"><div id="elh_cv_historipelatihanpeserta_tahun" class="cv_historipelatihanpeserta_tahun"><div class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_list->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $cv_historipelatihanpeserta_list->tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_historipelatihanpeserta_list->SortUrl($cv_historipelatihanpeserta_list->tahun) ?>', 1);"><div id="elh_cv_historipelatihanpeserta_tahun" class="cv_historipelatihanpeserta_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_list->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipelatihanpeserta_list->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipelatihanpeserta_list->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_list->kdinformasi->Visible) { // kdinformasi ?>
	<?php if ($cv_historipelatihanpeserta_list->SortUrl($cv_historipelatihanpeserta_list->kdinformasi) == "") { ?>
		<th data-name="kdinformasi" class="<?php echo $cv_historipelatihanpeserta_list->kdinformasi->headerCellClass() ?>"><div id="elh_cv_historipelatihanpeserta_kdinformasi" class="cv_historipelatihanpeserta_kdinformasi"><div class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_list->kdinformasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdinformasi" class="<?php echo $cv_historipelatihanpeserta_list->kdinformasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_historipelatihanpeserta_list->SortUrl($cv_historipelatihanpeserta_list->kdinformasi) ?>', 1);"><div id="elh_cv_historipelatihanpeserta_kdinformasi" class="cv_historipelatihanpeserta_kdinformasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_list->kdinformasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipelatihanpeserta_list->kdinformasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipelatihanpeserta_list->kdinformasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_list->harapan->Visible) { // harapan ?>
	<?php if ($cv_historipelatihanpeserta_list->SortUrl($cv_historipelatihanpeserta_list->harapan) == "") { ?>
		<th data-name="harapan" class="<?php echo $cv_historipelatihanpeserta_list->harapan->headerCellClass() ?>"><div id="elh_cv_historipelatihanpeserta_harapan" class="cv_historipelatihanpeserta_harapan"><div class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_list->harapan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="harapan" class="<?php echo $cv_historipelatihanpeserta_list->harapan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_historipelatihanpeserta_list->SortUrl($cv_historipelatihanpeserta_list->harapan) ?>', 1);"><div id="elh_cv_historipelatihanpeserta_harapan" class="cv_historipelatihanpeserta_harapan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_list->harapan->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipelatihanpeserta_list->harapan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipelatihanpeserta_list->harapan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cv_historipelatihanpeserta_list->sertifikat->Visible) { // sertifikat ?>
	<?php if ($cv_historipelatihanpeserta_list->SortUrl($cv_historipelatihanpeserta_list->sertifikat) == "") { ?>
		<th data-name="sertifikat" class="<?php echo $cv_historipelatihanpeserta_list->sertifikat->headerCellClass() ?>"><div id="elh_cv_historipelatihanpeserta_sertifikat" class="cv_historipelatihanpeserta_sertifikat"><div class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_list->sertifikat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sertifikat" class="<?php echo $cv_historipelatihanpeserta_list->sertifikat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cv_historipelatihanpeserta_list->SortUrl($cv_historipelatihanpeserta_list->sertifikat) ?>', 1);"><div id="elh_cv_historipelatihanpeserta_sertifikat" class="cv_historipelatihanpeserta_sertifikat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cv_historipelatihanpeserta_list->sertifikat->caption() ?></span><span class="ew-table-header-sort"><?php if ($cv_historipelatihanpeserta_list->sertifikat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cv_historipelatihanpeserta_list->sertifikat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cv_historipelatihanpeserta_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cv_historipelatihanpeserta_list->ExportAll && $cv_historipelatihanpeserta_list->isExport()) {
	$cv_historipelatihanpeserta_list->StopRecord = $cv_historipelatihanpeserta_list->TotalRecords;
} else {

	// Set the last record to display
	if ($cv_historipelatihanpeserta_list->TotalRecords > $cv_historipelatihanpeserta_list->StartRecord + $cv_historipelatihanpeserta_list->DisplayRecords - 1)
		$cv_historipelatihanpeserta_list->StopRecord = $cv_historipelatihanpeserta_list->StartRecord + $cv_historipelatihanpeserta_list->DisplayRecords - 1;
	else
		$cv_historipelatihanpeserta_list->StopRecord = $cv_historipelatihanpeserta_list->TotalRecords;
}
$cv_historipelatihanpeserta_list->RecordCount = $cv_historipelatihanpeserta_list->StartRecord - 1;
if ($cv_historipelatihanpeserta_list->Recordset && !$cv_historipelatihanpeserta_list->Recordset->EOF) {
	$cv_historipelatihanpeserta_list->Recordset->moveFirst();
	$selectLimit = $cv_historipelatihanpeserta_list->UseSelectLimit;
	if (!$selectLimit && $cv_historipelatihanpeserta_list->StartRecord > 1)
		$cv_historipelatihanpeserta_list->Recordset->move($cv_historipelatihanpeserta_list->StartRecord - 1);
} elseif (!$cv_historipelatihanpeserta->AllowAddDeleteRow && $cv_historipelatihanpeserta_list->StopRecord == 0) {
	$cv_historipelatihanpeserta_list->StopRecord = $cv_historipelatihanpeserta->GridAddRowCount;
}

// Initialize aggregate
$cv_historipelatihanpeserta->RowType = ROWTYPE_AGGREGATEINIT;
$cv_historipelatihanpeserta->resetAttributes();
$cv_historipelatihanpeserta_list->renderRow();
while ($cv_historipelatihanpeserta_list->RecordCount < $cv_historipelatihanpeserta_list->StopRecord) {
	$cv_historipelatihanpeserta_list->RecordCount++;
	if ($cv_historipelatihanpeserta_list->RecordCount >= $cv_historipelatihanpeserta_list->StartRecord) {
		$cv_historipelatihanpeserta_list->RowCount++;

		// Set up key count
		$cv_historipelatihanpeserta_list->KeyCount = $cv_historipelatihanpeserta_list->RowIndex;

		// Init row class and style
		$cv_historipelatihanpeserta->resetAttributes();
		$cv_historipelatihanpeserta->CssClass = "";
		if ($cv_historipelatihanpeserta_list->isGridAdd()) {
		} else {
			$cv_historipelatihanpeserta_list->loadRowValues($cv_historipelatihanpeserta_list->Recordset); // Load row values
		}
		$cv_historipelatihanpeserta->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cv_historipelatihanpeserta->RowAttrs->merge(["data-rowindex" => $cv_historipelatihanpeserta_list->RowCount, "id" => "r" . $cv_historipelatihanpeserta_list->RowCount . "_cv_historipelatihanpeserta", "data-rowtype" => $cv_historipelatihanpeserta->RowType]);

		// Render row
		$cv_historipelatihanpeserta_list->renderRow();

		// Render list options
		$cv_historipelatihanpeserta_list->renderListOptions();
?>
	<tr <?php echo $cv_historipelatihanpeserta->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cv_historipelatihanpeserta_list->ListOptions->render("body", "left", $cv_historipelatihanpeserta_list->RowCount);
?>
	<?php if ($cv_historipelatihanpeserta_list->kdhistori->Visible) { // kdhistori ?>
		<td data-name="kdhistori" <?php echo $cv_historipelatihanpeserta_list->kdhistori->cellAttributes() ?>>
<span id="el<?php echo $cv_historipelatihanpeserta_list->RowCount ?>_cv_historipelatihanpeserta_kdhistori">
<span<?php echo $cv_historipelatihanpeserta_list->kdhistori->viewAttributes() ?>><?php echo $cv_historipelatihanpeserta_list->kdhistori->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_historipelatihanpeserta_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $cv_historipelatihanpeserta_list->id->cellAttributes() ?>>
<span id="el<?php echo $cv_historipelatihanpeserta_list->RowCount ?>_cv_historipelatihanpeserta_id">
<span<?php echo $cv_historipelatihanpeserta_list->id->viewAttributes() ?>><?php if (!EmptyString($cv_historipelatihanpeserta_list->id->getViewValue()) && $cv_historipelatihanpeserta_list->id->linkAttributes() != "") { ?>
<a<?php echo $cv_historipelatihanpeserta_list->id->linkAttributes() ?>><?php echo $cv_historipelatihanpeserta_list->id->getViewValue() ?></a>
<?php } else { ?>
<?php echo $cv_historipelatihanpeserta_list->id->getViewValue() ?>
<?php } ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_historipelatihanpeserta_list->kdpelat->Visible) { // kdpelat ?>
		<td data-name="kdpelat" <?php echo $cv_historipelatihanpeserta_list->kdpelat->cellAttributes() ?>>
<span id="el<?php echo $cv_historipelatihanpeserta_list->RowCount ?>_cv_historipelatihanpeserta_kdpelat">
<span<?php echo $cv_historipelatihanpeserta_list->kdpelat->viewAttributes() ?>><?php echo $cv_historipelatihanpeserta_list->kdpelat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_historipelatihanpeserta_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $cv_historipelatihanpeserta_list->tahun->cellAttributes() ?>>
<span id="el<?php echo $cv_historipelatihanpeserta_list->RowCount ?>_cv_historipelatihanpeserta_tahun">
<span<?php echo $cv_historipelatihanpeserta_list->tahun->viewAttributes() ?>><?php echo $cv_historipelatihanpeserta_list->tahun->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_historipelatihanpeserta_list->kdinformasi->Visible) { // kdinformasi ?>
		<td data-name="kdinformasi" <?php echo $cv_historipelatihanpeserta_list->kdinformasi->cellAttributes() ?>>
<span id="el<?php echo $cv_historipelatihanpeserta_list->RowCount ?>_cv_historipelatihanpeserta_kdinformasi">
<span<?php echo $cv_historipelatihanpeserta_list->kdinformasi->viewAttributes() ?>><?php echo $cv_historipelatihanpeserta_list->kdinformasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_historipelatihanpeserta_list->harapan->Visible) { // harapan ?>
		<td data-name="harapan" <?php echo $cv_historipelatihanpeserta_list->harapan->cellAttributes() ?>>
<span id="el<?php echo $cv_historipelatihanpeserta_list->RowCount ?>_cv_historipelatihanpeserta_harapan">
<span<?php echo $cv_historipelatihanpeserta_list->harapan->viewAttributes() ?>><?php echo $cv_historipelatihanpeserta_list->harapan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cv_historipelatihanpeserta_list->sertifikat->Visible) { // sertifikat ?>
		<td data-name="sertifikat" <?php echo $cv_historipelatihanpeserta_list->sertifikat->cellAttributes() ?>>
<span id="el<?php echo $cv_historipelatihanpeserta_list->RowCount ?>_cv_historipelatihanpeserta_sertifikat">
<span<?php echo $cv_historipelatihanpeserta_list->sertifikat->viewAttributes() ?>><?php echo $cv_historipelatihanpeserta_list->sertifikat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cv_historipelatihanpeserta_list->ListOptions->render("body", "right", $cv_historipelatihanpeserta_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$cv_historipelatihanpeserta_list->isGridAdd())
		$cv_historipelatihanpeserta_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$cv_historipelatihanpeserta->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cv_historipelatihanpeserta_list->Recordset)
	$cv_historipelatihanpeserta_list->Recordset->Close();
?>
<?php if (!$cv_historipelatihanpeserta_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cv_historipelatihanpeserta_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cv_historipelatihanpeserta_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cv_historipelatihanpeserta_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cv_historipelatihanpeserta_list->TotalRecords == 0 && !$cv_historipelatihanpeserta->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cv_historipelatihanpeserta_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cv_historipelatihanpeserta_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cv_historipelatihanpeserta_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$("#r_id").hide();
});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$cv_historipelatihanpeserta_list->terminate();
?>