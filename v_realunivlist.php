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
$v_realuniv_list = new v_realuniv_list();

// Run the page
$v_realuniv_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v_realuniv_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$v_realuniv_list->isExport()) { ?>
<script>
var fv_realunivlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fv_realunivlist = currentForm = new ew.Form("fv_realunivlist", "list");
	fv_realunivlist.formKeyCountName = '<?php echo $v_realuniv_list->FormKeyCountName ?>';
	loadjs.done("fv_realunivlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$v_realuniv_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($v_realuniv_list->TotalRecords > 0 && $v_realuniv_list->ExportOptions->visible()) { ?>
<?php $v_realuniv_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($v_realuniv_list->ImportOptions->visible()) { ?>
<?php $v_realuniv_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$v_realuniv_list->renderOtherOptions();
?>
<?php $v_realuniv_list->showPageHeader(); ?>
<?php
$v_realuniv_list->showMessage();
?>
<?php if ($v_realuniv_list->TotalRecords > 0 || $v_realuniv->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($v_realuniv_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> v_realuniv">
<?php if (!$v_realuniv_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$v_realuniv_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $v_realuniv_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_realuniv_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fv_realunivlist" id="fv_realunivlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v_realuniv">
<div id="gmp_v_realuniv" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($v_realuniv_list->TotalRecords > 0 || $v_realuniv_list->isGridEdit()) { ?>
<table id="tbl_v_realunivlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$v_realuniv->RowType = ROWTYPE_HEADER;

// Render list options
$v_realuniv_list->renderListOptions();

// Render list options (header, left)
$v_realuniv_list->ListOptions->render("header", "left");
?>
<?php if ($v_realuniv_list->kdpelat->Visible) { // kdpelat ?>
	<?php if ($v_realuniv_list->SortUrl($v_realuniv_list->kdpelat) == "") { ?>
		<th data-name="kdpelat" class="<?php echo $v_realuniv_list->kdpelat->headerCellClass() ?>"><div id="elh_v_realuniv_kdpelat" class="v_realuniv_kdpelat"><div class="ew-table-header-caption"><?php echo $v_realuniv_list->kdpelat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdpelat" class="<?php echo $v_realuniv_list->kdpelat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_realuniv_list->SortUrl($v_realuniv_list->kdpelat) ?>', 1);"><div id="elh_v_realuniv_kdpelat" class="v_realuniv_kdpelat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_realuniv_list->kdpelat->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_realuniv_list->kdpelat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_realuniv_list->kdpelat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_realuniv_list->kdprop->Visible) { // kdprop ?>
	<?php if ($v_realuniv_list->SortUrl($v_realuniv_list->kdprop) == "") { ?>
		<th data-name="kdprop" class="<?php echo $v_realuniv_list->kdprop->headerCellClass() ?>"><div id="elh_v_realuniv_kdprop" class="v_realuniv_kdprop"><div class="ew-table-header-caption"><?php echo $v_realuniv_list->kdprop->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdprop" class="<?php echo $v_realuniv_list->kdprop->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_realuniv_list->SortUrl($v_realuniv_list->kdprop) ?>', 1);"><div id="elh_v_realuniv_kdprop" class="v_realuniv_kdprop">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_realuniv_list->kdprop->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_realuniv_list->kdprop->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_realuniv_list->kdprop->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_realuniv_list->kdkota->Visible) { // kdkota ?>
	<?php if ($v_realuniv_list->SortUrl($v_realuniv_list->kdkota) == "") { ?>
		<th data-name="kdkota" class="<?php echo $v_realuniv_list->kdkota->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_v_realuniv_kdkota" class="v_realuniv_kdkota"><div class="ew-table-header-caption"><?php echo $v_realuniv_list->kdkota->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkota" class="<?php echo $v_realuniv_list->kdkota->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_realuniv_list->SortUrl($v_realuniv_list->kdkota) ?>', 1);"><div id="elh_v_realuniv_kdkota" class="v_realuniv_kdkota">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_realuniv_list->kdkota->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_realuniv_list->kdkota->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_realuniv_list->kdkota->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_realuniv_list->tawal->Visible) { // tawal ?>
	<?php if ($v_realuniv_list->SortUrl($v_realuniv_list->tawal) == "") { ?>
		<th data-name="tawal" class="<?php echo $v_realuniv_list->tawal->headerCellClass() ?>"><div id="elh_v_realuniv_tawal" class="v_realuniv_tawal"><div class="ew-table-header-caption"><?php echo $v_realuniv_list->tawal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tawal" class="<?php echo $v_realuniv_list->tawal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_realuniv_list->SortUrl($v_realuniv_list->tawal) ?>', 1);"><div id="elh_v_realuniv_tawal" class="v_realuniv_tawal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_realuniv_list->tawal->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_realuniv_list->tawal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_realuniv_list->tawal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_realuniv_list->takhir->Visible) { // takhir ?>
	<?php if ($v_realuniv_list->SortUrl($v_realuniv_list->takhir) == "") { ?>
		<th data-name="takhir" class="<?php echo $v_realuniv_list->takhir->headerCellClass() ?>"><div id="elh_v_realuniv_takhir" class="v_realuniv_takhir"><div class="ew-table-header-caption"><?php echo $v_realuniv_list->takhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="takhir" class="<?php echo $v_realuniv_list->takhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_realuniv_list->SortUrl($v_realuniv_list->takhir) ?>', 1);"><div id="elh_v_realuniv_takhir" class="v_realuniv_takhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_realuniv_list->takhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_realuniv_list->takhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_realuniv_list->takhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_realuniv_list->kdjudul->Visible) { // kdjudul ?>
	<?php if ($v_realuniv_list->SortUrl($v_realuniv_list->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $v_realuniv_list->kdjudul->headerCellClass() ?>"><div id="elh_v_realuniv_kdjudul" class="v_realuniv_kdjudul"><div class="ew-table-header-caption"><?php echo $v_realuniv_list->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $v_realuniv_list->kdjudul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_realuniv_list->SortUrl($v_realuniv_list->kdjudul) ?>', 1);"><div id="elh_v_realuniv_kdjudul" class="v_realuniv_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_realuniv_list->kdjudul->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_realuniv_list->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_realuniv_list->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_realuniv_list->kerjasama->Visible) { // kerjasama ?>
	<?php if ($v_realuniv_list->SortUrl($v_realuniv_list->kerjasama) == "") { ?>
		<th data-name="kerjasama" class="<?php echo $v_realuniv_list->kerjasama->headerCellClass() ?>"><div id="elh_v_realuniv_kerjasama" class="v_realuniv_kerjasama"><div class="ew-table-header-caption"><?php echo $v_realuniv_list->kerjasama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kerjasama" class="<?php echo $v_realuniv_list->kerjasama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_realuniv_list->SortUrl($v_realuniv_list->kerjasama) ?>', 1);"><div id="elh_v_realuniv_kerjasama" class="v_realuniv_kerjasama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_realuniv_list->kerjasama->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_realuniv_list->kerjasama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_realuniv_list->kerjasama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_realuniv_list->namap->Visible) { // namap ?>
	<?php if ($v_realuniv_list->SortUrl($v_realuniv_list->namap) == "") { ?>
		<th data-name="namap" class="<?php echo $v_realuniv_list->namap->headerCellClass() ?>"><div id="elh_v_realuniv_namap" class="v_realuniv_namap"><div class="ew-table-header-caption"><?php echo $v_realuniv_list->namap->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="namap" class="<?php echo $v_realuniv_list->namap->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_realuniv_list->SortUrl($v_realuniv_list->namap) ?>', 1);"><div id="elh_v_realuniv_namap" class="v_realuniv_namap">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_realuniv_list->namap->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_realuniv_list->namap->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_realuniv_list->namap->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_realuniv_list->jml_pes->Visible) { // jml_pes ?>
	<?php if ($v_realuniv_list->SortUrl($v_realuniv_list->jml_pes) == "") { ?>
		<th data-name="jml_pes" class="<?php echo $v_realuniv_list->jml_pes->headerCellClass() ?>"><div id="elh_v_realuniv_jml_pes" class="v_realuniv_jml_pes"><div class="ew-table-header-caption"><?php echo $v_realuniv_list->jml_pes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jml_pes" class="<?php echo $v_realuniv_list->jml_pes->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_realuniv_list->SortUrl($v_realuniv_list->jml_pes) ?>', 1);"><div id="elh_v_realuniv_jml_pes" class="v_realuniv_jml_pes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_realuniv_list->jml_pes->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_realuniv_list->jml_pes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_realuniv_list->jml_pes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_realuniv_list->real_peserta->Visible) { // real_peserta ?>
	<?php if ($v_realuniv_list->SortUrl($v_realuniv_list->real_peserta) == "") { ?>
		<th data-name="real_peserta" class="<?php echo $v_realuniv_list->real_peserta->headerCellClass() ?>"><div id="elh_v_realuniv_real_peserta" class="v_realuniv_real_peserta"><div class="ew-table-header-caption"><?php echo $v_realuniv_list->real_peserta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="real_peserta" class="<?php echo $v_realuniv_list->real_peserta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_realuniv_list->SortUrl($v_realuniv_list->real_peserta) ?>', 1);"><div id="elh_v_realuniv_real_peserta" class="v_realuniv_real_peserta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_realuniv_list->real_peserta->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_realuniv_list->real_peserta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_realuniv_list->real_peserta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$v_realuniv_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($v_realuniv_list->ExportAll && $v_realuniv_list->isExport()) {
	$v_realuniv_list->StopRecord = $v_realuniv_list->TotalRecords;
} else {

	// Set the last record to display
	if ($v_realuniv_list->TotalRecords > $v_realuniv_list->StartRecord + $v_realuniv_list->DisplayRecords - 1)
		$v_realuniv_list->StopRecord = $v_realuniv_list->StartRecord + $v_realuniv_list->DisplayRecords - 1;
	else
		$v_realuniv_list->StopRecord = $v_realuniv_list->TotalRecords;
}
$v_realuniv_list->RecordCount = $v_realuniv_list->StartRecord - 1;
if ($v_realuniv_list->Recordset && !$v_realuniv_list->Recordset->EOF) {
	$v_realuniv_list->Recordset->moveFirst();
	$selectLimit = $v_realuniv_list->UseSelectLimit;
	if (!$selectLimit && $v_realuniv_list->StartRecord > 1)
		$v_realuniv_list->Recordset->move($v_realuniv_list->StartRecord - 1);
} elseif (!$v_realuniv->AllowAddDeleteRow && $v_realuniv_list->StopRecord == 0) {
	$v_realuniv_list->StopRecord = $v_realuniv->GridAddRowCount;
}

// Initialize aggregate
$v_realuniv->RowType = ROWTYPE_AGGREGATEINIT;
$v_realuniv->resetAttributes();
$v_realuniv_list->renderRow();
while ($v_realuniv_list->RecordCount < $v_realuniv_list->StopRecord) {
	$v_realuniv_list->RecordCount++;
	if ($v_realuniv_list->RecordCount >= $v_realuniv_list->StartRecord) {
		$v_realuniv_list->RowCount++;

		// Set up key count
		$v_realuniv_list->KeyCount = $v_realuniv_list->RowIndex;

		// Init row class and style
		$v_realuniv->resetAttributes();
		$v_realuniv->CssClass = "";
		if ($v_realuniv_list->isGridAdd()) {
		} else {
			$v_realuniv_list->loadRowValues($v_realuniv_list->Recordset); // Load row values
		}
		$v_realuniv->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$v_realuniv->RowAttrs->merge(["data-rowindex" => $v_realuniv_list->RowCount, "id" => "r" . $v_realuniv_list->RowCount . "_v_realuniv", "data-rowtype" => $v_realuniv->RowType]);

		// Render row
		$v_realuniv_list->renderRow();

		// Render list options
		$v_realuniv_list->renderListOptions();
?>
	<tr <?php echo $v_realuniv->rowAttributes() ?>>
<?php

// Render list options (body, left)
$v_realuniv_list->ListOptions->render("body", "left", $v_realuniv_list->RowCount);
?>
	<?php if ($v_realuniv_list->kdpelat->Visible) { // kdpelat ?>
		<td data-name="kdpelat" <?php echo $v_realuniv_list->kdpelat->cellAttributes() ?>>
<span id="el<?php echo $v_realuniv_list->RowCount ?>_v_realuniv_kdpelat">
<span<?php echo $v_realuniv_list->kdpelat->viewAttributes() ?>><?php echo $v_realuniv_list->kdpelat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_realuniv_list->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" <?php echo $v_realuniv_list->kdprop->cellAttributes() ?>>
<span id="el<?php echo $v_realuniv_list->RowCount ?>_v_realuniv_kdprop">
<span<?php echo $v_realuniv_list->kdprop->viewAttributes() ?>><?php echo $v_realuniv_list->kdprop->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_realuniv_list->kdkota->Visible) { // kdkota ?>
		<td data-name="kdkota" <?php echo $v_realuniv_list->kdkota->cellAttributes() ?>>
<span id="el<?php echo $v_realuniv_list->RowCount ?>_v_realuniv_kdkota">
<span<?php echo $v_realuniv_list->kdkota->viewAttributes() ?>><?php echo $v_realuniv_list->kdkota->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_realuniv_list->tawal->Visible) { // tawal ?>
		<td data-name="tawal" <?php echo $v_realuniv_list->tawal->cellAttributes() ?>>
<span id="el<?php echo $v_realuniv_list->RowCount ?>_v_realuniv_tawal">
<span<?php echo $v_realuniv_list->tawal->viewAttributes() ?>><?php echo $v_realuniv_list->tawal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_realuniv_list->takhir->Visible) { // takhir ?>
		<td data-name="takhir" <?php echo $v_realuniv_list->takhir->cellAttributes() ?>>
<span id="el<?php echo $v_realuniv_list->RowCount ?>_v_realuniv_takhir">
<span<?php echo $v_realuniv_list->takhir->viewAttributes() ?>><?php echo $v_realuniv_list->takhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_realuniv_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $v_realuniv_list->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $v_realuniv_list->RowCount ?>_v_realuniv_kdjudul">
<span<?php echo $v_realuniv_list->kdjudul->viewAttributes() ?>><?php echo $v_realuniv_list->kdjudul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_realuniv_list->kerjasama->Visible) { // kerjasama ?>
		<td data-name="kerjasama" <?php echo $v_realuniv_list->kerjasama->cellAttributes() ?>>
<span id="el<?php echo $v_realuniv_list->RowCount ?>_v_realuniv_kerjasama">
<span<?php echo $v_realuniv_list->kerjasama->viewAttributes() ?>><?php echo $v_realuniv_list->kerjasama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_realuniv_list->namap->Visible) { // namap ?>
		<td data-name="namap" <?php echo $v_realuniv_list->namap->cellAttributes() ?>>
<span id="el<?php echo $v_realuniv_list->RowCount ?>_v_realuniv_namap">
<span<?php echo $v_realuniv_list->namap->viewAttributes() ?>><?php echo $v_realuniv_list->namap->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_realuniv_list->jml_pes->Visible) { // jml_pes ?>
		<td data-name="jml_pes" <?php echo $v_realuniv_list->jml_pes->cellAttributes() ?>>
<span id="el<?php echo $v_realuniv_list->RowCount ?>_v_realuniv_jml_pes">
<span<?php echo $v_realuniv_list->jml_pes->viewAttributes() ?>><?php echo $v_realuniv_list->jml_pes->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_realuniv_list->real_peserta->Visible) { // real_peserta ?>
		<td data-name="real_peserta" <?php echo $v_realuniv_list->real_peserta->cellAttributes() ?>>
<span id="el<?php echo $v_realuniv_list->RowCount ?>_v_realuniv_real_peserta">
<span<?php echo $v_realuniv_list->real_peserta->viewAttributes() ?>><?php echo $v_realuniv_list->real_peserta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$v_realuniv_list->ListOptions->render("body", "right", $v_realuniv_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$v_realuniv_list->isGridAdd())
		$v_realuniv_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$v_realuniv->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($v_realuniv_list->Recordset)
	$v_realuniv_list->Recordset->Close();
?>
<?php if (!$v_realuniv_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$v_realuniv_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $v_realuniv_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_realuniv_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($v_realuniv_list->TotalRecords == 0 && !$v_realuniv->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $v_realuniv_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$v_realuniv_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$v_realuniv_list->isExport()) { ?>
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
$v_realuniv_list->terminate();
?>