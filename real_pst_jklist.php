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
$real_pst_jk_list = new real_pst_jk_list();

// Run the page
$real_pst_jk_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$real_pst_jk_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$real_pst_jk_list->isExport()) { ?>
<script>
var freal_pst_jklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	freal_pst_jklist = currentForm = new ew.Form("freal_pst_jklist", "list");
	freal_pst_jklist.formKeyCountName = '<?php echo $real_pst_jk_list->FormKeyCountName ?>';
	loadjs.done("freal_pst_jklist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$real_pst_jk_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($real_pst_jk_list->TotalRecords > 0 && $real_pst_jk_list->ExportOptions->visible()) { ?>
<?php $real_pst_jk_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($real_pst_jk_list->ImportOptions->visible()) { ?>
<?php $real_pst_jk_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$real_pst_jk_list->renderOtherOptions();
?>
<?php $real_pst_jk_list->showPageHeader(); ?>
<?php
$real_pst_jk_list->showMessage();
?>
<?php if ($real_pst_jk_list->TotalRecords > 0 || $real_pst_jk->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($real_pst_jk_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> real_pst_jk">
<?php if (!$real_pst_jk_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$real_pst_jk_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $real_pst_jk_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $real_pst_jk_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="freal_pst_jklist" id="freal_pst_jklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="real_pst_jk">
<div id="gmp_real_pst_jk" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($real_pst_jk_list->TotalRecords > 0 || $real_pst_jk_list->isGridEdit()) { ?>
<table id="tbl_real_pst_jklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$real_pst_jk->RowType = ROWTYPE_HEADER;

// Render list options
$real_pst_jk_list->renderListOptions();

// Render list options (header, left)
$real_pst_jk_list->ListOptions->render("header", "left");
?>
<?php if ($real_pst_jk_list->kdjudul->Visible) { // kdjudul ?>
	<?php if ($real_pst_jk_list->SortUrl($real_pst_jk_list->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $real_pst_jk_list->kdjudul->headerCellClass() ?>"><div id="elh_real_pst_jk_kdjudul" class="real_pst_jk_kdjudul"><div class="ew-table-header-caption"><?php echo $real_pst_jk_list->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $real_pst_jk_list->kdjudul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_pst_jk_list->SortUrl($real_pst_jk_list->kdjudul) ?>', 1);"><div id="elh_real_pst_jk_kdjudul" class="real_pst_jk_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_pst_jk_list->kdjudul->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_pst_jk_list->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_pst_jk_list->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_pst_jk_list->kdkota->Visible) { // kdkota ?>
	<?php if ($real_pst_jk_list->SortUrl($real_pst_jk_list->kdkota) == "") { ?>
		<th data-name="kdkota" class="<?php echo $real_pst_jk_list->kdkota->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_real_pst_jk_kdkota" class="real_pst_jk_kdkota"><div class="ew-table-header-caption"><?php echo $real_pst_jk_list->kdkota->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkota" class="<?php echo $real_pst_jk_list->kdkota->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_pst_jk_list->SortUrl($real_pst_jk_list->kdkota) ?>', 1);"><div id="elh_real_pst_jk_kdkota" class="real_pst_jk_kdkota">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_pst_jk_list->kdkota->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_pst_jk_list->kdkota->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_pst_jk_list->kdkota->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_pst_jk_list->tawal->Visible) { // tawal ?>
	<?php if ($real_pst_jk_list->SortUrl($real_pst_jk_list->tawal) == "") { ?>
		<th data-name="tawal" class="<?php echo $real_pst_jk_list->tawal->headerCellClass() ?>"><div id="elh_real_pst_jk_tawal" class="real_pst_jk_tawal"><div class="ew-table-header-caption"><?php echo $real_pst_jk_list->tawal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tawal" class="<?php echo $real_pst_jk_list->tawal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_pst_jk_list->SortUrl($real_pst_jk_list->tawal) ?>', 1);"><div id="elh_real_pst_jk_tawal" class="real_pst_jk_tawal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_pst_jk_list->tawal->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_pst_jk_list->tawal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_pst_jk_list->tawal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_pst_jk_list->takhir->Visible) { // takhir ?>
	<?php if ($real_pst_jk_list->SortUrl($real_pst_jk_list->takhir) == "") { ?>
		<th data-name="takhir" class="<?php echo $real_pst_jk_list->takhir->headerCellClass() ?>"><div id="elh_real_pst_jk_takhir" class="real_pst_jk_takhir"><div class="ew-table-header-caption"><?php echo $real_pst_jk_list->takhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="takhir" class="<?php echo $real_pst_jk_list->takhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_pst_jk_list->SortUrl($real_pst_jk_list->takhir) ?>', 1);"><div id="elh_real_pst_jk_takhir" class="real_pst_jk_takhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_pst_jk_list->takhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_pst_jk_list->takhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_pst_jk_list->takhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_pst_jk_list->bln->Visible) { // bln ?>
	<?php if ($real_pst_jk_list->SortUrl($real_pst_jk_list->bln) == "") { ?>
		<th data-name="bln" class="<?php echo $real_pst_jk_list->bln->headerCellClass() ?>"><div id="elh_real_pst_jk_bln" class="real_pst_jk_bln"><div class="ew-table-header-caption"><?php echo $real_pst_jk_list->bln->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bln" class="<?php echo $real_pst_jk_list->bln->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_pst_jk_list->SortUrl($real_pst_jk_list->bln) ?>', 1);"><div id="elh_real_pst_jk_bln" class="real_pst_jk_bln">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_pst_jk_list->bln->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_pst_jk_list->bln->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_pst_jk_list->bln->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_pst_jk_list->thn->Visible) { // thn ?>
	<?php if ($real_pst_jk_list->SortUrl($real_pst_jk_list->thn) == "") { ?>
		<th data-name="thn" class="<?php echo $real_pst_jk_list->thn->headerCellClass() ?>"><div id="elh_real_pst_jk_thn" class="real_pst_jk_thn"><div class="ew-table-header-caption"><?php echo $real_pst_jk_list->thn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="thn" class="<?php echo $real_pst_jk_list->thn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_pst_jk_list->SortUrl($real_pst_jk_list->thn) ?>', 1);"><div id="elh_real_pst_jk_thn" class="real_pst_jk_thn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_pst_jk_list->thn->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_pst_jk_list->thn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_pst_jk_list->thn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_pst_jk_list->kdprop->Visible) { // kdprop ?>
	<?php if ($real_pst_jk_list->SortUrl($real_pst_jk_list->kdprop) == "") { ?>
		<th data-name="kdprop" class="<?php echo $real_pst_jk_list->kdprop->headerCellClass() ?>"><div id="elh_real_pst_jk_kdprop" class="real_pst_jk_kdprop"><div class="ew-table-header-caption"><?php echo $real_pst_jk_list->kdprop->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdprop" class="<?php echo $real_pst_jk_list->kdprop->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_pst_jk_list->SortUrl($real_pst_jk_list->kdprop) ?>', 1);"><div id="elh_real_pst_jk_kdprop" class="real_pst_jk_kdprop">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_pst_jk_list->kdprop->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_pst_jk_list->kdprop->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_pst_jk_list->kdprop->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_pst_jk_list->swasta_b->Visible) { // swasta_b ?>
	<?php if ($real_pst_jk_list->SortUrl($real_pst_jk_list->swasta_b) == "") { ?>
		<th data-name="swasta_b" class="<?php echo $real_pst_jk_list->swasta_b->headerCellClass() ?>"><div id="elh_real_pst_jk_swasta_b" class="real_pst_jk_swasta_b"><div class="ew-table-header-caption"><?php echo $real_pst_jk_list->swasta_b->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="swasta_b" class="<?php echo $real_pst_jk_list->swasta_b->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_pst_jk_list->SortUrl($real_pst_jk_list->swasta_b) ?>', 1);"><div id="elh_real_pst_jk_swasta_b" class="real_pst_jk_swasta_b">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_pst_jk_list->swasta_b->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_pst_jk_list->swasta_b->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_pst_jk_list->swasta_b->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$real_pst_jk_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($real_pst_jk_list->ExportAll && $real_pst_jk_list->isExport()) {
	$real_pst_jk_list->StopRecord = $real_pst_jk_list->TotalRecords;
} else {

	// Set the last record to display
	if ($real_pst_jk_list->TotalRecords > $real_pst_jk_list->StartRecord + $real_pst_jk_list->DisplayRecords - 1)
		$real_pst_jk_list->StopRecord = $real_pst_jk_list->StartRecord + $real_pst_jk_list->DisplayRecords - 1;
	else
		$real_pst_jk_list->StopRecord = $real_pst_jk_list->TotalRecords;
}
$real_pst_jk_list->RecordCount = $real_pst_jk_list->StartRecord - 1;
if ($real_pst_jk_list->Recordset && !$real_pst_jk_list->Recordset->EOF) {
	$real_pst_jk_list->Recordset->moveFirst();
	$selectLimit = $real_pst_jk_list->UseSelectLimit;
	if (!$selectLimit && $real_pst_jk_list->StartRecord > 1)
		$real_pst_jk_list->Recordset->move($real_pst_jk_list->StartRecord - 1);
} elseif (!$real_pst_jk->AllowAddDeleteRow && $real_pst_jk_list->StopRecord == 0) {
	$real_pst_jk_list->StopRecord = $real_pst_jk->GridAddRowCount;
}

// Initialize aggregate
$real_pst_jk->RowType = ROWTYPE_AGGREGATEINIT;
$real_pst_jk->resetAttributes();
$real_pst_jk_list->renderRow();
while ($real_pst_jk_list->RecordCount < $real_pst_jk_list->StopRecord) {
	$real_pst_jk_list->RecordCount++;
	if ($real_pst_jk_list->RecordCount >= $real_pst_jk_list->StartRecord) {
		$real_pst_jk_list->RowCount++;

		// Set up key count
		$real_pst_jk_list->KeyCount = $real_pst_jk_list->RowIndex;

		// Init row class and style
		$real_pst_jk->resetAttributes();
		$real_pst_jk->CssClass = "";
		if ($real_pst_jk_list->isGridAdd()) {
		} else {
			$real_pst_jk_list->loadRowValues($real_pst_jk_list->Recordset); // Load row values
		}
		$real_pst_jk->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$real_pst_jk->RowAttrs->merge(["data-rowindex" => $real_pst_jk_list->RowCount, "id" => "r" . $real_pst_jk_list->RowCount . "_real_pst_jk", "data-rowtype" => $real_pst_jk->RowType]);

		// Render row
		$real_pst_jk_list->renderRow();

		// Render list options
		$real_pst_jk_list->renderListOptions();
?>
	<tr <?php echo $real_pst_jk->rowAttributes() ?>>
<?php

// Render list options (body, left)
$real_pst_jk_list->ListOptions->render("body", "left", $real_pst_jk_list->RowCount);
?>
	<?php if ($real_pst_jk_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $real_pst_jk_list->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $real_pst_jk_list->RowCount ?>_real_pst_jk_kdjudul">
<span<?php echo $real_pst_jk_list->kdjudul->viewAttributes() ?>><?php echo $real_pst_jk_list->kdjudul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_pst_jk_list->kdkota->Visible) { // kdkota ?>
		<td data-name="kdkota" <?php echo $real_pst_jk_list->kdkota->cellAttributes() ?>>
<span id="el<?php echo $real_pst_jk_list->RowCount ?>_real_pst_jk_kdkota">
<span<?php echo $real_pst_jk_list->kdkota->viewAttributes() ?>><?php echo $real_pst_jk_list->kdkota->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_pst_jk_list->tawal->Visible) { // tawal ?>
		<td data-name="tawal" <?php echo $real_pst_jk_list->tawal->cellAttributes() ?>>
<span id="el<?php echo $real_pst_jk_list->RowCount ?>_real_pst_jk_tawal">
<span<?php echo $real_pst_jk_list->tawal->viewAttributes() ?>><?php echo $real_pst_jk_list->tawal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_pst_jk_list->takhir->Visible) { // takhir ?>
		<td data-name="takhir" <?php echo $real_pst_jk_list->takhir->cellAttributes() ?>>
<span id="el<?php echo $real_pst_jk_list->RowCount ?>_real_pst_jk_takhir">
<span<?php echo $real_pst_jk_list->takhir->viewAttributes() ?>><?php echo $real_pst_jk_list->takhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_pst_jk_list->bln->Visible) { // bln ?>
		<td data-name="bln" <?php echo $real_pst_jk_list->bln->cellAttributes() ?>>
<span id="el<?php echo $real_pst_jk_list->RowCount ?>_real_pst_jk_bln">
<span<?php echo $real_pst_jk_list->bln->viewAttributes() ?>><?php echo $real_pst_jk_list->bln->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_pst_jk_list->thn->Visible) { // thn ?>
		<td data-name="thn" <?php echo $real_pst_jk_list->thn->cellAttributes() ?>>
<span id="el<?php echo $real_pst_jk_list->RowCount ?>_real_pst_jk_thn">
<span<?php echo $real_pst_jk_list->thn->viewAttributes() ?>><?php echo $real_pst_jk_list->thn->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_pst_jk_list->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" <?php echo $real_pst_jk_list->kdprop->cellAttributes() ?>>
<span id="el<?php echo $real_pst_jk_list->RowCount ?>_real_pst_jk_kdprop">
<span<?php echo $real_pst_jk_list->kdprop->viewAttributes() ?>><?php echo $real_pst_jk_list->kdprop->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_pst_jk_list->swasta_b->Visible) { // swasta_b ?>
		<td data-name="swasta_b" <?php echo $real_pst_jk_list->swasta_b->cellAttributes() ?>>
<span id="el<?php echo $real_pst_jk_list->RowCount ?>_real_pst_jk_swasta_b">
<span<?php echo $real_pst_jk_list->swasta_b->viewAttributes() ?>><?php echo $real_pst_jk_list->swasta_b->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$real_pst_jk_list->ListOptions->render("body", "right", $real_pst_jk_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$real_pst_jk_list->isGridAdd())
		$real_pst_jk_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$real_pst_jk->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($real_pst_jk_list->Recordset)
	$real_pst_jk_list->Recordset->Close();
?>
<?php if (!$real_pst_jk_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$real_pst_jk_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $real_pst_jk_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $real_pst_jk_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($real_pst_jk_list->TotalRecords == 0 && !$real_pst_jk->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $real_pst_jk_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$real_pst_jk_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$real_pst_jk_list->isExport()) { ?>
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
$real_pst_jk_list->terminate();
?>