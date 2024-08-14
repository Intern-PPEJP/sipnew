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
$real_prog_list = new real_prog_list();

// Run the page
$real_prog_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$real_prog_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$real_prog_list->isExport()) { ?>
<script>
var freal_proglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	freal_proglist = currentForm = new ew.Form("freal_proglist", "list");
	freal_proglist.formKeyCountName = '<?php echo $real_prog_list->FormKeyCountName ?>';
	loadjs.done("freal_proglist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$real_prog_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($real_prog_list->TotalRecords > 0 && $real_prog_list->ExportOptions->visible()) { ?>
<?php $real_prog_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($real_prog_list->ImportOptions->visible()) { ?>
<?php $real_prog_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$real_prog_list->renderOtherOptions();
?>
<?php $real_prog_list->showPageHeader(); ?>
<?php
$real_prog_list->showMessage();
?>
<?php if ($real_prog_list->TotalRecords > 0 || $real_prog->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($real_prog_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> real_prog">
<?php if (!$real_prog_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$real_prog_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $real_prog_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $real_prog_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="freal_proglist" id="freal_proglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="real_prog">
<div id="gmp_real_prog" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($real_prog_list->TotalRecords > 0 || $real_prog_list->isGridEdit()) { ?>
<table id="tbl_real_proglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$real_prog->RowType = ROWTYPE_HEADER;

// Render list options
$real_prog_list->renderListOptions();

// Render list options (header, left)
$real_prog_list->ListOptions->render("header", "left");
?>
<?php if ($real_prog_list->kdpelat->Visible) { // kdpelat ?>
	<?php if ($real_prog_list->SortUrl($real_prog_list->kdpelat) == "") { ?>
		<th data-name="kdpelat" class="<?php echo $real_prog_list->kdpelat->headerCellClass() ?>"><div id="elh_real_prog_kdpelat" class="real_prog_kdpelat"><div class="ew-table-header-caption"><?php echo $real_prog_list->kdpelat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdpelat" class="<?php echo $real_prog_list->kdpelat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_prog_list->SortUrl($real_prog_list->kdpelat) ?>', 1);"><div id="elh_real_prog_kdpelat" class="real_prog_kdpelat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_prog_list->kdpelat->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_prog_list->kdpelat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_prog_list->kdpelat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_prog_list->kdjudul->Visible) { // kdjudul ?>
	<?php if ($real_prog_list->SortUrl($real_prog_list->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $real_prog_list->kdjudul->headerCellClass() ?>"><div id="elh_real_prog_kdjudul" class="real_prog_kdjudul"><div class="ew-table-header-caption"><?php echo $real_prog_list->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $real_prog_list->kdjudul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_prog_list->SortUrl($real_prog_list->kdjudul) ?>', 1);"><div id="elh_real_prog_kdjudul" class="real_prog_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_prog_list->kdjudul->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_prog_list->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_prog_list->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_prog_list->kdkota->Visible) { // kdkota ?>
	<?php if ($real_prog_list->SortUrl($real_prog_list->kdkota) == "") { ?>
		<th data-name="kdkota" class="<?php echo $real_prog_list->kdkota->headerCellClass() ?>"><div id="elh_real_prog_kdkota" class="real_prog_kdkota"><div class="ew-table-header-caption"><?php echo $real_prog_list->kdkota->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkota" class="<?php echo $real_prog_list->kdkota->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_prog_list->SortUrl($real_prog_list->kdkota) ?>', 1);"><div id="elh_real_prog_kdkota" class="real_prog_kdkota">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_prog_list->kdkota->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_prog_list->kdkota->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_prog_list->kdkota->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_prog_list->tawal->Visible) { // tawal ?>
	<?php if ($real_prog_list->SortUrl($real_prog_list->tawal) == "") { ?>
		<th data-name="tawal" class="<?php echo $real_prog_list->tawal->headerCellClass() ?>"><div id="elh_real_prog_tawal" class="real_prog_tawal"><div class="ew-table-header-caption"><?php echo $real_prog_list->tawal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tawal" class="<?php echo $real_prog_list->tawal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_prog_list->SortUrl($real_prog_list->tawal) ?>', 1);"><div id="elh_real_prog_tawal" class="real_prog_tawal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_prog_list->tawal->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_prog_list->tawal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_prog_list->tawal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_prog_list->takhir->Visible) { // takhir ?>
	<?php if ($real_prog_list->SortUrl($real_prog_list->takhir) == "") { ?>
		<th data-name="takhir" class="<?php echo $real_prog_list->takhir->headerCellClass() ?>"><div id="elh_real_prog_takhir" class="real_prog_takhir"><div class="ew-table-header-caption"><?php echo $real_prog_list->takhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="takhir" class="<?php echo $real_prog_list->takhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_prog_list->SortUrl($real_prog_list->takhir) ?>', 1);"><div id="elh_real_prog_takhir" class="real_prog_takhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_prog_list->takhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_prog_list->takhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_prog_list->takhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_prog_list->jmlpes->Visible) { // jmlpes ?>
	<?php if ($real_prog_list->SortUrl($real_prog_list->jmlpes) == "") { ?>
		<th data-name="jmlpes" class="<?php echo $real_prog_list->jmlpes->headerCellClass() ?>"><div id="elh_real_prog_jmlpes" class="real_prog_jmlpes"><div class="ew-table-header-caption"><?php echo $real_prog_list->jmlpes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jmlpes" class="<?php echo $real_prog_list->jmlpes->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_prog_list->SortUrl($real_prog_list->jmlpes) ?>', 1);"><div id="elh_real_prog_jmlpes" class="real_prog_jmlpes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_prog_list->jmlpes->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_prog_list->jmlpes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_prog_list->jmlpes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_prog_list->biaya->Visible) { // biaya ?>
	<?php if ($real_prog_list->SortUrl($real_prog_list->biaya) == "") { ?>
		<th data-name="biaya" class="<?php echo $real_prog_list->biaya->headerCellClass() ?>"><div id="elh_real_prog_biaya" class="real_prog_biaya"><div class="ew-table-header-caption"><?php echo $real_prog_list->biaya->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="biaya" class="<?php echo $real_prog_list->biaya->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_prog_list->SortUrl($real_prog_list->biaya) ?>', 1);"><div id="elh_real_prog_biaya" class="real_prog_biaya">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_prog_list->biaya->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_prog_list->biaya->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_prog_list->biaya->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_prog_list->targetpes->Visible) { // targetpes ?>
	<?php if ($real_prog_list->SortUrl($real_prog_list->targetpes) == "") { ?>
		<th data-name="targetpes" class="<?php echo $real_prog_list->targetpes->headerCellClass() ?>"><div id="elh_real_prog_targetpes" class="real_prog_targetpes"><div class="ew-table-header-caption"><?php echo $real_prog_list->targetpes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes" class="<?php echo $real_prog_list->targetpes->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_prog_list->SortUrl($real_prog_list->targetpes) ?>', 1);"><div id="elh_real_prog_targetpes" class="real_prog_targetpes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_prog_list->targetpes->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_prog_list->targetpes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_prog_list->targetpes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_prog_list->dana->Visible) { // dana ?>
	<?php if ($real_prog_list->SortUrl($real_prog_list->dana) == "") { ?>
		<th data-name="dana" class="<?php echo $real_prog_list->dana->headerCellClass() ?>"><div id="elh_real_prog_dana" class="real_prog_dana"><div class="ew-table-header-caption"><?php echo $real_prog_list->dana->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="dana" class="<?php echo $real_prog_list->dana->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_prog_list->SortUrl($real_prog_list->dana) ?>', 1);"><div id="elh_real_prog_dana" class="real_prog_dana">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_prog_list->dana->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_prog_list->dana->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_prog_list->dana->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_prog_list->durasi->Visible) { // durasi ?>
	<?php if ($real_prog_list->SortUrl($real_prog_list->durasi) == "") { ?>
		<th data-name="durasi" class="<?php echo $real_prog_list->durasi->headerCellClass() ?>"><div id="elh_real_prog_durasi" class="real_prog_durasi"><div class="ew-table-header-caption"><?php echo $real_prog_list->durasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="durasi" class="<?php echo $real_prog_list->durasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_prog_list->SortUrl($real_prog_list->durasi) ?>', 1);"><div id="elh_real_prog_durasi" class="real_prog_durasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_prog_list->durasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_prog_list->durasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_prog_list->durasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_prog_list->ket->Visible) { // ket ?>
	<?php if ($real_prog_list->SortUrl($real_prog_list->ket) == "") { ?>
		<th data-name="ket" class="<?php echo $real_prog_list->ket->headerCellClass() ?>"><div id="elh_real_prog_ket" class="real_prog_ket"><div class="ew-table-header-caption"><?php echo $real_prog_list->ket->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ket" class="<?php echo $real_prog_list->ket->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_prog_list->SortUrl($real_prog_list->ket) ?>', 1);"><div id="elh_real_prog_ket" class="real_prog_ket">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_prog_list->ket->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_prog_list->ket->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_prog_list->ket->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_prog_list->bln->Visible) { // bln ?>
	<?php if ($real_prog_list->SortUrl($real_prog_list->bln) == "") { ?>
		<th data-name="bln" class="<?php echo $real_prog_list->bln->headerCellClass() ?>"><div id="elh_real_prog_bln" class="real_prog_bln"><div class="ew-table-header-caption"><?php echo $real_prog_list->bln->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bln" class="<?php echo $real_prog_list->bln->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_prog_list->SortUrl($real_prog_list->bln) ?>', 1);"><div id="elh_real_prog_bln" class="real_prog_bln">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_prog_list->bln->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_prog_list->bln->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_prog_list->bln->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_prog_list->thn->Visible) { // thn ?>
	<?php if ($real_prog_list->SortUrl($real_prog_list->thn) == "") { ?>
		<th data-name="thn" class="<?php echo $real_prog_list->thn->headerCellClass() ?>"><div id="elh_real_prog_thn" class="real_prog_thn"><div class="ew-table-header-caption"><?php echo $real_prog_list->thn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="thn" class="<?php echo $real_prog_list->thn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_prog_list->SortUrl($real_prog_list->thn) ?>', 1);"><div id="elh_real_prog_thn" class="real_prog_thn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_prog_list->thn->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_prog_list->thn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_prog_list->thn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_prog_list->kdprop->Visible) { // kdprop ?>
	<?php if ($real_prog_list->SortUrl($real_prog_list->kdprop) == "") { ?>
		<th data-name="kdprop" class="<?php echo $real_prog_list->kdprop->headerCellClass() ?>"><div id="elh_real_prog_kdprop" class="real_prog_kdprop"><div class="ew-table-header-caption"><?php echo $real_prog_list->kdprop->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdprop" class="<?php echo $real_prog_list->kdprop->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_prog_list->SortUrl($real_prog_list->kdprop) ?>', 1);"><div id="elh_real_prog_kdprop" class="real_prog_kdprop">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_prog_list->kdprop->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_prog_list->kdprop->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_prog_list->kdprop->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$real_prog_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($real_prog_list->ExportAll && $real_prog_list->isExport()) {
	$real_prog_list->StopRecord = $real_prog_list->TotalRecords;
} else {

	// Set the last record to display
	if ($real_prog_list->TotalRecords > $real_prog_list->StartRecord + $real_prog_list->DisplayRecords - 1)
		$real_prog_list->StopRecord = $real_prog_list->StartRecord + $real_prog_list->DisplayRecords - 1;
	else
		$real_prog_list->StopRecord = $real_prog_list->TotalRecords;
}
$real_prog_list->RecordCount = $real_prog_list->StartRecord - 1;
if ($real_prog_list->Recordset && !$real_prog_list->Recordset->EOF) {
	$real_prog_list->Recordset->moveFirst();
	$selectLimit = $real_prog_list->UseSelectLimit;
	if (!$selectLimit && $real_prog_list->StartRecord > 1)
		$real_prog_list->Recordset->move($real_prog_list->StartRecord - 1);
} elseif (!$real_prog->AllowAddDeleteRow && $real_prog_list->StopRecord == 0) {
	$real_prog_list->StopRecord = $real_prog->GridAddRowCount;
}

// Initialize aggregate
$real_prog->RowType = ROWTYPE_AGGREGATEINIT;
$real_prog->resetAttributes();
$real_prog_list->renderRow();
while ($real_prog_list->RecordCount < $real_prog_list->StopRecord) {
	$real_prog_list->RecordCount++;
	if ($real_prog_list->RecordCount >= $real_prog_list->StartRecord) {
		$real_prog_list->RowCount++;

		// Set up key count
		$real_prog_list->KeyCount = $real_prog_list->RowIndex;

		// Init row class and style
		$real_prog->resetAttributes();
		$real_prog->CssClass = "";
		if ($real_prog_list->isGridAdd()) {
		} else {
			$real_prog_list->loadRowValues($real_prog_list->Recordset); // Load row values
		}
		$real_prog->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$real_prog->RowAttrs->merge(["data-rowindex" => $real_prog_list->RowCount, "id" => "r" . $real_prog_list->RowCount . "_real_prog", "data-rowtype" => $real_prog->RowType]);

		// Render row
		$real_prog_list->renderRow();

		// Render list options
		$real_prog_list->renderListOptions();
?>
	<tr <?php echo $real_prog->rowAttributes() ?>>
<?php

// Render list options (body, left)
$real_prog_list->ListOptions->render("body", "left", $real_prog_list->RowCount);
?>
	<?php if ($real_prog_list->kdpelat->Visible) { // kdpelat ?>
		<td data-name="kdpelat" <?php echo $real_prog_list->kdpelat->cellAttributes() ?>>
<span id="el<?php echo $real_prog_list->RowCount ?>_real_prog_kdpelat">
<span<?php echo $real_prog_list->kdpelat->viewAttributes() ?>><?php echo $real_prog_list->kdpelat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_prog_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $real_prog_list->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $real_prog_list->RowCount ?>_real_prog_kdjudul">
<span<?php echo $real_prog_list->kdjudul->viewAttributes() ?>><?php echo $real_prog_list->kdjudul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_prog_list->kdkota->Visible) { // kdkota ?>
		<td data-name="kdkota" <?php echo $real_prog_list->kdkota->cellAttributes() ?>>
<span id="el<?php echo $real_prog_list->RowCount ?>_real_prog_kdkota">
<span<?php echo $real_prog_list->kdkota->viewAttributes() ?>><?php echo $real_prog_list->kdkota->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_prog_list->tawal->Visible) { // tawal ?>
		<td data-name="tawal" <?php echo $real_prog_list->tawal->cellAttributes() ?>>
<span id="el<?php echo $real_prog_list->RowCount ?>_real_prog_tawal">
<span<?php echo $real_prog_list->tawal->viewAttributes() ?>><?php echo $real_prog_list->tawal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_prog_list->takhir->Visible) { // takhir ?>
		<td data-name="takhir" <?php echo $real_prog_list->takhir->cellAttributes() ?>>
<span id="el<?php echo $real_prog_list->RowCount ?>_real_prog_takhir">
<span<?php echo $real_prog_list->takhir->viewAttributes() ?>><?php echo $real_prog_list->takhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_prog_list->jmlpes->Visible) { // jmlpes ?>
		<td data-name="jmlpes" <?php echo $real_prog_list->jmlpes->cellAttributes() ?>>
<span id="el<?php echo $real_prog_list->RowCount ?>_real_prog_jmlpes">
<span<?php echo $real_prog_list->jmlpes->viewAttributes() ?>><?php echo $real_prog_list->jmlpes->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_prog_list->biaya->Visible) { // biaya ?>
		<td data-name="biaya" <?php echo $real_prog_list->biaya->cellAttributes() ?>>
<span id="el<?php echo $real_prog_list->RowCount ?>_real_prog_biaya">
<span<?php echo $real_prog_list->biaya->viewAttributes() ?>><?php echo $real_prog_list->biaya->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_prog_list->targetpes->Visible) { // targetpes ?>
		<td data-name="targetpes" <?php echo $real_prog_list->targetpes->cellAttributes() ?>>
<span id="el<?php echo $real_prog_list->RowCount ?>_real_prog_targetpes">
<span<?php echo $real_prog_list->targetpes->viewAttributes() ?>><?php echo $real_prog_list->targetpes->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_prog_list->dana->Visible) { // dana ?>
		<td data-name="dana" <?php echo $real_prog_list->dana->cellAttributes() ?>>
<span id="el<?php echo $real_prog_list->RowCount ?>_real_prog_dana">
<span<?php echo $real_prog_list->dana->viewAttributes() ?>><?php echo $real_prog_list->dana->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_prog_list->durasi->Visible) { // durasi ?>
		<td data-name="durasi" <?php echo $real_prog_list->durasi->cellAttributes() ?>>
<span id="el<?php echo $real_prog_list->RowCount ?>_real_prog_durasi">
<span<?php echo $real_prog_list->durasi->viewAttributes() ?>><?php echo $real_prog_list->durasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_prog_list->ket->Visible) { // ket ?>
		<td data-name="ket" <?php echo $real_prog_list->ket->cellAttributes() ?>>
<span id="el<?php echo $real_prog_list->RowCount ?>_real_prog_ket">
<span<?php echo $real_prog_list->ket->viewAttributes() ?>><?php echo $real_prog_list->ket->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_prog_list->bln->Visible) { // bln ?>
		<td data-name="bln" <?php echo $real_prog_list->bln->cellAttributes() ?>>
<span id="el<?php echo $real_prog_list->RowCount ?>_real_prog_bln">
<span<?php echo $real_prog_list->bln->viewAttributes() ?>><?php echo $real_prog_list->bln->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_prog_list->thn->Visible) { // thn ?>
		<td data-name="thn" <?php echo $real_prog_list->thn->cellAttributes() ?>>
<span id="el<?php echo $real_prog_list->RowCount ?>_real_prog_thn">
<span<?php echo $real_prog_list->thn->viewAttributes() ?>><?php echo $real_prog_list->thn->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_prog_list->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" <?php echo $real_prog_list->kdprop->cellAttributes() ?>>
<span id="el<?php echo $real_prog_list->RowCount ?>_real_prog_kdprop">
<span<?php echo $real_prog_list->kdprop->viewAttributes() ?>><?php echo $real_prog_list->kdprop->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$real_prog_list->ListOptions->render("body", "right", $real_prog_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$real_prog_list->isGridAdd())
		$real_prog_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$real_prog->RowType = ROWTYPE_AGGREGATE;
$real_prog->resetAttributes();
$real_prog_list->renderRow();
?>
<?php if ($real_prog_list->TotalRecords > 0 && !$real_prog_list->isGridAdd() && !$real_prog_list->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$real_prog_list->renderListOptions();

// Render list options (footer, left)
$real_prog_list->ListOptions->render("footer", "left");
?>
	<?php if ($real_prog_list->kdpelat->Visible) { // kdpelat ?>
		<td data-name="kdpelat" class="<?php echo $real_prog_list->kdpelat->footerCellClass() ?>"><span id="elf_real_prog_kdpelat" class="real_prog_kdpelat">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($real_prog_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" class="<?php echo $real_prog_list->kdjudul->footerCellClass() ?>"><span id="elf_real_prog_kdjudul" class="real_prog_kdjudul">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($real_prog_list->kdkota->Visible) { // kdkota ?>
		<td data-name="kdkota" class="<?php echo $real_prog_list->kdkota->footerCellClass() ?>"><span id="elf_real_prog_kdkota" class="real_prog_kdkota">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($real_prog_list->tawal->Visible) { // tawal ?>
		<td data-name="tawal" class="<?php echo $real_prog_list->tawal->footerCellClass() ?>"><span id="elf_real_prog_tawal" class="real_prog_tawal">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($real_prog_list->takhir->Visible) { // takhir ?>
		<td data-name="takhir" class="<?php echo $real_prog_list->takhir->footerCellClass() ?>"><span id="elf_real_prog_takhir" class="real_prog_takhir">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($real_prog_list->jmlpes->Visible) { // jmlpes ?>
		<td data-name="jmlpes" class="<?php echo $real_prog_list->jmlpes->footerCellClass() ?>"><span id="elf_real_prog_jmlpes" class="real_prog_jmlpes">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $real_prog_list->jmlpes->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($real_prog_list->biaya->Visible) { // biaya ?>
		<td data-name="biaya" class="<?php echo $real_prog_list->biaya->footerCellClass() ?>"><span id="elf_real_prog_biaya" class="real_prog_biaya">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $real_prog_list->biaya->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($real_prog_list->targetpes->Visible) { // targetpes ?>
		<td data-name="targetpes" class="<?php echo $real_prog_list->targetpes->footerCellClass() ?>"><span id="elf_real_prog_targetpes" class="real_prog_targetpes">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($real_prog_list->dana->Visible) { // dana ?>
		<td data-name="dana" class="<?php echo $real_prog_list->dana->footerCellClass() ?>"><span id="elf_real_prog_dana" class="real_prog_dana">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($real_prog_list->durasi->Visible) { // durasi ?>
		<td data-name="durasi" class="<?php echo $real_prog_list->durasi->footerCellClass() ?>"><span id="elf_real_prog_durasi" class="real_prog_durasi">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($real_prog_list->ket->Visible) { // ket ?>
		<td data-name="ket" class="<?php echo $real_prog_list->ket->footerCellClass() ?>"><span id="elf_real_prog_ket" class="real_prog_ket">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($real_prog_list->bln->Visible) { // bln ?>
		<td data-name="bln" class="<?php echo $real_prog_list->bln->footerCellClass() ?>"><span id="elf_real_prog_bln" class="real_prog_bln">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($real_prog_list->thn->Visible) { // thn ?>
		<td data-name="thn" class="<?php echo $real_prog_list->thn->footerCellClass() ?>"><span id="elf_real_prog_thn" class="real_prog_thn">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($real_prog_list->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" class="<?php echo $real_prog_list->kdprop->footerCellClass() ?>"><span id="elf_real_prog_kdprop" class="real_prog_kdprop">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$real_prog_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$real_prog->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($real_prog_list->Recordset)
	$real_prog_list->Recordset->Close();
?>
<?php if (!$real_prog_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$real_prog_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $real_prog_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $real_prog_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($real_prog_list->TotalRecords == 0 && !$real_prog->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $real_prog_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$real_prog_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$real_prog_list->isExport()) { ?>
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
$real_prog_list->terminate();
?>