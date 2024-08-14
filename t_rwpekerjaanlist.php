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
$t_rwpekerjaan_list = new t_rwpekerjaan_list();

// Run the page
$t_rwpekerjaan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rwpekerjaan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_rwpekerjaan_list->isExport()) { ?>
<script>
var ft_rwpekerjaanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_rwpekerjaanlist = currentForm = new ew.Form("ft_rwpekerjaanlist", "list");
	ft_rwpekerjaanlist.formKeyCountName = '<?php echo $t_rwpekerjaan_list->FormKeyCountName ?>';
	loadjs.done("ft_rwpekerjaanlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_rwpekerjaan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_rwpekerjaan_list->TotalRecords > 0 && $t_rwpekerjaan_list->ExportOptions->visible()) { ?>
<?php $t_rwpekerjaan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_rwpekerjaan_list->ImportOptions->visible()) { ?>
<?php $t_rwpekerjaan_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$t_rwpekerjaan_list->isExport() || Config("EXPORT_MASTER_RECORD") && $t_rwpekerjaan_list->isExport("print")) { ?>
<?php
if ($t_rwpekerjaan_list->DbMasterFilter != "" && $t_rwpekerjaan->getCurrentMasterTable() == "t_biointruktur") {
	if ($t_rwpekerjaan_list->MasterRecordExists) {
		include_once "t_biointrukturmaster.php";
	}
}
?>
<?php } ?>
<?php
$t_rwpekerjaan_list->renderOtherOptions();
?>
<?php $t_rwpekerjaan_list->showPageHeader(); ?>
<?php
$t_rwpekerjaan_list->showMessage();
?>
<?php if ($t_rwpekerjaan_list->TotalRecords > 0 || $t_rwpekerjaan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_rwpekerjaan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_rwpekerjaan">
<?php if (!$t_rwpekerjaan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_rwpekerjaan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_rwpekerjaan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_rwpekerjaan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_rwpekerjaanlist" id="ft_rwpekerjaanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rwpekerjaan">
<?php if ($t_rwpekerjaan->getCurrentMasterTable() == "t_biointruktur" && $t_rwpekerjaan->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_biointruktur">
<input type="hidden" name="fk_bioid" value="<?php echo HtmlEncode($t_rwpekerjaan_list->bioid->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_t_rwpekerjaan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_rwpekerjaan_list->TotalRecords > 0 || $t_rwpekerjaan_list->isGridEdit()) { ?>
<table id="tbl_t_rwpekerjaanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_rwpekerjaan->RowType = ROWTYPE_HEADER;

// Render list options
$t_rwpekerjaan_list->renderListOptions();

// Render list options (header, left)
$t_rwpekerjaan_list->ListOptions->render("header", "left");
?>
<?php if ($t_rwpekerjaan_list->rwkerjaid->Visible) { // rwkerjaid ?>
	<?php if ($t_rwpekerjaan_list->SortUrl($t_rwpekerjaan_list->rwkerjaid) == "") { ?>
		<th data-name="rwkerjaid" class="<?php echo $t_rwpekerjaan_list->rwkerjaid->headerCellClass() ?>"><div id="elh_t_rwpekerjaan_rwkerjaid" class="t_rwpekerjaan_rwkerjaid"><div class="ew-table-header-caption"><?php echo $t_rwpekerjaan_list->rwkerjaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rwkerjaid" class="<?php echo $t_rwpekerjaan_list->rwkerjaid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rwpekerjaan_list->SortUrl($t_rwpekerjaan_list->rwkerjaid) ?>', 1);"><div id="elh_t_rwpekerjaan_rwkerjaid" class="t_rwpekerjaan_rwkerjaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwpekerjaan_list->rwkerjaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwpekerjaan_list->rwkerjaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwpekerjaan_list->rwkerjaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwpekerjaan_list->bioid->Visible) { // bioid ?>
	<?php if ($t_rwpekerjaan_list->SortUrl($t_rwpekerjaan_list->bioid) == "") { ?>
		<th data-name="bioid" class="<?php echo $t_rwpekerjaan_list->bioid->headerCellClass() ?>"><div id="elh_t_rwpekerjaan_bioid" class="t_rwpekerjaan_bioid"><div class="ew-table-header-caption"><?php echo $t_rwpekerjaan_list->bioid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bioid" class="<?php echo $t_rwpekerjaan_list->bioid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rwpekerjaan_list->SortUrl($t_rwpekerjaan_list->bioid) ?>', 1);"><div id="elh_t_rwpekerjaan_bioid" class="t_rwpekerjaan_bioid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwpekerjaan_list->bioid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwpekerjaan_list->bioid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwpekerjaan_list->bioid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwpekerjaan_list->perusahaan->Visible) { // perusahaan ?>
	<?php if ($t_rwpekerjaan_list->SortUrl($t_rwpekerjaan_list->perusahaan) == "") { ?>
		<th data-name="perusahaan" class="<?php echo $t_rwpekerjaan_list->perusahaan->headerCellClass() ?>"><div id="elh_t_rwpekerjaan_perusahaan" class="t_rwpekerjaan_perusahaan"><div class="ew-table-header-caption"><?php echo $t_rwpekerjaan_list->perusahaan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="perusahaan" class="<?php echo $t_rwpekerjaan_list->perusahaan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rwpekerjaan_list->SortUrl($t_rwpekerjaan_list->perusahaan) ?>', 1);"><div id="elh_t_rwpekerjaan_perusahaan" class="t_rwpekerjaan_perusahaan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwpekerjaan_list->perusahaan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwpekerjaan_list->perusahaan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwpekerjaan_list->perusahaan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwpekerjaan_list->jabatan->Visible) { // jabatan ?>
	<?php if ($t_rwpekerjaan_list->SortUrl($t_rwpekerjaan_list->jabatan) == "") { ?>
		<th data-name="jabatan" class="<?php echo $t_rwpekerjaan_list->jabatan->headerCellClass() ?>"><div id="elh_t_rwpekerjaan_jabatan" class="t_rwpekerjaan_jabatan"><div class="ew-table-header-caption"><?php echo $t_rwpekerjaan_list->jabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan" class="<?php echo $t_rwpekerjaan_list->jabatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rwpekerjaan_list->SortUrl($t_rwpekerjaan_list->jabatan) ?>', 1);"><div id="elh_t_rwpekerjaan_jabatan" class="t_rwpekerjaan_jabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwpekerjaan_list->jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwpekerjaan_list->jabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwpekerjaan_list->jabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwpekerjaan_list->mulai->Visible) { // mulai ?>
	<?php if ($t_rwpekerjaan_list->SortUrl($t_rwpekerjaan_list->mulai) == "") { ?>
		<th data-name="mulai" class="<?php echo $t_rwpekerjaan_list->mulai->headerCellClass() ?>"><div id="elh_t_rwpekerjaan_mulai" class="t_rwpekerjaan_mulai"><div class="ew-table-header-caption"><?php echo $t_rwpekerjaan_list->mulai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="mulai" class="<?php echo $t_rwpekerjaan_list->mulai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rwpekerjaan_list->SortUrl($t_rwpekerjaan_list->mulai) ?>', 1);"><div id="elh_t_rwpekerjaan_mulai" class="t_rwpekerjaan_mulai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwpekerjaan_list->mulai->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwpekerjaan_list->mulai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwpekerjaan_list->mulai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_rwpekerjaan_list->hingga->Visible) { // hingga ?>
	<?php if ($t_rwpekerjaan_list->SortUrl($t_rwpekerjaan_list->hingga) == "") { ?>
		<th data-name="hingga" class="<?php echo $t_rwpekerjaan_list->hingga->headerCellClass() ?>"><div id="elh_t_rwpekerjaan_hingga" class="t_rwpekerjaan_hingga"><div class="ew-table-header-caption"><?php echo $t_rwpekerjaan_list->hingga->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hingga" class="<?php echo $t_rwpekerjaan_list->hingga->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_rwpekerjaan_list->SortUrl($t_rwpekerjaan_list->hingga) ?>', 1);"><div id="elh_t_rwpekerjaan_hingga" class="t_rwpekerjaan_hingga">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_rwpekerjaan_list->hingga->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_rwpekerjaan_list->hingga->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_rwpekerjaan_list->hingga->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_rwpekerjaan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_rwpekerjaan_list->ExportAll && $t_rwpekerjaan_list->isExport()) {
	$t_rwpekerjaan_list->StopRecord = $t_rwpekerjaan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_rwpekerjaan_list->TotalRecords > $t_rwpekerjaan_list->StartRecord + $t_rwpekerjaan_list->DisplayRecords - 1)
		$t_rwpekerjaan_list->StopRecord = $t_rwpekerjaan_list->StartRecord + $t_rwpekerjaan_list->DisplayRecords - 1;
	else
		$t_rwpekerjaan_list->StopRecord = $t_rwpekerjaan_list->TotalRecords;
}
$t_rwpekerjaan_list->RecordCount = $t_rwpekerjaan_list->StartRecord - 1;
if ($t_rwpekerjaan_list->Recordset && !$t_rwpekerjaan_list->Recordset->EOF) {
	$t_rwpekerjaan_list->Recordset->moveFirst();
	$selectLimit = $t_rwpekerjaan_list->UseSelectLimit;
	if (!$selectLimit && $t_rwpekerjaan_list->StartRecord > 1)
		$t_rwpekerjaan_list->Recordset->move($t_rwpekerjaan_list->StartRecord - 1);
} elseif (!$t_rwpekerjaan->AllowAddDeleteRow && $t_rwpekerjaan_list->StopRecord == 0) {
	$t_rwpekerjaan_list->StopRecord = $t_rwpekerjaan->GridAddRowCount;
}

// Initialize aggregate
$t_rwpekerjaan->RowType = ROWTYPE_AGGREGATEINIT;
$t_rwpekerjaan->resetAttributes();
$t_rwpekerjaan_list->renderRow();
while ($t_rwpekerjaan_list->RecordCount < $t_rwpekerjaan_list->StopRecord) {
	$t_rwpekerjaan_list->RecordCount++;
	if ($t_rwpekerjaan_list->RecordCount >= $t_rwpekerjaan_list->StartRecord) {
		$t_rwpekerjaan_list->RowCount++;

		// Set up key count
		$t_rwpekerjaan_list->KeyCount = $t_rwpekerjaan_list->RowIndex;

		// Init row class and style
		$t_rwpekerjaan->resetAttributes();
		$t_rwpekerjaan->CssClass = "";
		if ($t_rwpekerjaan_list->isGridAdd()) {
		} else {
			$t_rwpekerjaan_list->loadRowValues($t_rwpekerjaan_list->Recordset); // Load row values
		}
		$t_rwpekerjaan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_rwpekerjaan->RowAttrs->merge(["data-rowindex" => $t_rwpekerjaan_list->RowCount, "id" => "r" . $t_rwpekerjaan_list->RowCount . "_t_rwpekerjaan", "data-rowtype" => $t_rwpekerjaan->RowType]);

		// Render row
		$t_rwpekerjaan_list->renderRow();

		// Render list options
		$t_rwpekerjaan_list->renderListOptions();
?>
	<tr <?php echo $t_rwpekerjaan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_rwpekerjaan_list->ListOptions->render("body", "left", $t_rwpekerjaan_list->RowCount);
?>
	<?php if ($t_rwpekerjaan_list->rwkerjaid->Visible) { // rwkerjaid ?>
		<td data-name="rwkerjaid" <?php echo $t_rwpekerjaan_list->rwkerjaid->cellAttributes() ?>>
<span id="el<?php echo $t_rwpekerjaan_list->RowCount ?>_t_rwpekerjaan_rwkerjaid">
<span<?php echo $t_rwpekerjaan_list->rwkerjaid->viewAttributes() ?>><?php echo $t_rwpekerjaan_list->rwkerjaid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rwpekerjaan_list->bioid->Visible) { // bioid ?>
		<td data-name="bioid" <?php echo $t_rwpekerjaan_list->bioid->cellAttributes() ?>>
<span id="el<?php echo $t_rwpekerjaan_list->RowCount ?>_t_rwpekerjaan_bioid">
<span<?php echo $t_rwpekerjaan_list->bioid->viewAttributes() ?>><?php echo $t_rwpekerjaan_list->bioid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rwpekerjaan_list->perusahaan->Visible) { // perusahaan ?>
		<td data-name="perusahaan" <?php echo $t_rwpekerjaan_list->perusahaan->cellAttributes() ?>>
<span id="el<?php echo $t_rwpekerjaan_list->RowCount ?>_t_rwpekerjaan_perusahaan">
<span<?php echo $t_rwpekerjaan_list->perusahaan->viewAttributes() ?>><?php echo $t_rwpekerjaan_list->perusahaan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rwpekerjaan_list->jabatan->Visible) { // jabatan ?>
		<td data-name="jabatan" <?php echo $t_rwpekerjaan_list->jabatan->cellAttributes() ?>>
<span id="el<?php echo $t_rwpekerjaan_list->RowCount ?>_t_rwpekerjaan_jabatan">
<span<?php echo $t_rwpekerjaan_list->jabatan->viewAttributes() ?>><?php echo $t_rwpekerjaan_list->jabatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rwpekerjaan_list->mulai->Visible) { // mulai ?>
		<td data-name="mulai" <?php echo $t_rwpekerjaan_list->mulai->cellAttributes() ?>>
<span id="el<?php echo $t_rwpekerjaan_list->RowCount ?>_t_rwpekerjaan_mulai">
<span<?php echo $t_rwpekerjaan_list->mulai->viewAttributes() ?>><?php echo $t_rwpekerjaan_list->mulai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_rwpekerjaan_list->hingga->Visible) { // hingga ?>
		<td data-name="hingga" <?php echo $t_rwpekerjaan_list->hingga->cellAttributes() ?>>
<span id="el<?php echo $t_rwpekerjaan_list->RowCount ?>_t_rwpekerjaan_hingga">
<span<?php echo $t_rwpekerjaan_list->hingga->viewAttributes() ?>><?php echo $t_rwpekerjaan_list->hingga->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_rwpekerjaan_list->ListOptions->render("body", "right", $t_rwpekerjaan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_rwpekerjaan_list->isGridAdd())
		$t_rwpekerjaan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_rwpekerjaan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_rwpekerjaan_list->Recordset)
	$t_rwpekerjaan_list->Recordset->Close();
?>
<?php if (!$t_rwpekerjaan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_rwpekerjaan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_rwpekerjaan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_rwpekerjaan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_rwpekerjaan_list->TotalRecords == 0 && !$t_rwpekerjaan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_rwpekerjaan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_rwpekerjaan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_rwpekerjaan_list->isExport()) { ?>
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
$t_rwpekerjaan_list->terminate();
?>