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
$t_evaluasifas_list = new t_evaluasifas_list();

// Run the page
$t_evaluasifas_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_evaluasifas_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_evaluasifas_list->isExport()) { ?>
<script>
var ft_evaluasifaslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_evaluasifaslist = currentForm = new ew.Form("ft_evaluasifaslist", "list");
	ft_evaluasifaslist.formKeyCountName = '<?php echo $t_evaluasifas_list->FormKeyCountName ?>';
	loadjs.done("ft_evaluasifaslist");
});
var ft_evaluasifaslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_evaluasifaslistsrch = currentSearchForm = new ew.Form("ft_evaluasifaslistsrch");

	// Dynamic selection lists
	// Filters

	ft_evaluasifaslistsrch.filterList = <?php echo $t_evaluasifas_list->getFilterList() ?>;
	loadjs.done("ft_evaluasifaslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_evaluasifas_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_evaluasifas_list->TotalRecords > 0 && $t_evaluasifas_list->ExportOptions->visible()) { ?>
<?php $t_evaluasifas_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_evaluasifas_list->ImportOptions->visible()) { ?>
<?php $t_evaluasifas_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_evaluasifas_list->SearchOptions->visible()) { ?>
<?php $t_evaluasifas_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_evaluasifas_list->FilterOptions->visible()) { ?>
<?php $t_evaluasifas_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$t_evaluasifas_list->isExport() || Config("EXPORT_MASTER_RECORD") && $t_evaluasifas_list->isExport("print")) { ?>
<?php
if ($t_evaluasifas_list->DbMasterFilter != "" && $t_evaluasifas->getCurrentMasterTable() == "t_biointruktur") {
	if ($t_evaluasifas_list->MasterRecordExists) {
		include_once "t_biointrukturmaster.php";
	}
}
?>
<?php
if ($t_evaluasifas_list->DbMasterFilter != "" && $t_evaluasifas->getCurrentMasterTable() == "cv_jp") {
	if ($t_evaluasifas_list->MasterRecordExists) {
		include_once "cv_jpmaster.php";
	}
}
?>
<?php } ?>
<?php
$t_evaluasifas_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_evaluasifas_list->isExport() && !$t_evaluasifas->CurrentAction) { ?>
<form name="ft_evaluasifaslistsrch" id="ft_evaluasifaslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_evaluasifaslistsrch-search-panel" class="<?php echo $t_evaluasifas_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_evaluasifas">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $t_evaluasifas_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($t_evaluasifas_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($t_evaluasifas_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $t_evaluasifas_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($t_evaluasifas_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($t_evaluasifas_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($t_evaluasifas_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($t_evaluasifas_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $t_evaluasifas_list->showPageHeader(); ?>
<?php
$t_evaluasifas_list->showMessage();
?>
<?php if ($t_evaluasifas_list->TotalRecords > 0 || $t_evaluasifas->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_evaluasifas_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_evaluasifas">
<?php if (!$t_evaluasifas_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_evaluasifas_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_evaluasifas_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_evaluasifas_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_evaluasifaslist" id="ft_evaluasifaslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_evaluasifas">
<?php if ($t_evaluasifas->getCurrentMasterTable() == "t_biointruktur" && $t_evaluasifas->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_biointruktur">
<input type="hidden" name="fk_bioid" value="<?php echo HtmlEncode($t_evaluasifas_list->bioid->getSessionValue()) ?>">
<?php } ?>
<?php if ($t_evaluasifas->getCurrentMasterTable() == "cv_jp" && $t_evaluasifas->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="cv_jp">
<input type="hidden" name="fk_bioid" value="<?php echo HtmlEncode($t_evaluasifas_list->bioid->getSessionValue()) ?>">
<input type="hidden" name="fk_idpelat" value="<?php echo HtmlEncode($t_evaluasifas_list->idpelat->getSessionValue()) ?>">
<input type="hidden" name="fk_kurikulumid" value="<?php echo HtmlEncode($t_evaluasifas_list->kurikulumid->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_t_evaluasifas" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_evaluasifas_list->TotalRecords > 0 || $t_evaluasifas_list->isGridEdit()) { ?>
<table id="tbl_t_evaluasifaslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_evaluasifas->RowType = ROWTYPE_HEADER;

// Render list options
$t_evaluasifas_list->renderListOptions();

// Render list options (header, left)
$t_evaluasifas_list->ListOptions->render("header", "left");
?>
<?php if ($t_evaluasifas_list->bioid->Visible) { // bioid ?>
	<?php if ($t_evaluasifas_list->SortUrl($t_evaluasifas_list->bioid) == "") { ?>
		<th data-name="bioid" class="<?php echo $t_evaluasifas_list->bioid->headerCellClass() ?>"><div id="elh_t_evaluasifas_bioid" class="t_evaluasifas_bioid"><div class="ew-table-header-caption"><?php echo $t_evaluasifas_list->bioid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bioid" class="<?php echo $t_evaluasifas_list->bioid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_evaluasifas_list->SortUrl($t_evaluasifas_list->bioid) ?>', 1);"><div id="elh_t_evaluasifas_bioid" class="t_evaluasifas_bioid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_evaluasifas_list->bioid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_evaluasifas_list->bioid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_evaluasifas_list->bioid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_evaluasifas_list->idpelat->Visible) { // idpelat ?>
	<?php if ($t_evaluasifas_list->SortUrl($t_evaluasifas_list->idpelat) == "") { ?>
		<th data-name="idpelat" class="<?php echo $t_evaluasifas_list->idpelat->headerCellClass() ?>"><div id="elh_t_evaluasifas_idpelat" class="t_evaluasifas_idpelat"><div class="ew-table-header-caption"><?php echo $t_evaluasifas_list->idpelat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idpelat" class="<?php echo $t_evaluasifas_list->idpelat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_evaluasifas_list->SortUrl($t_evaluasifas_list->idpelat) ?>', 1);"><div id="elh_t_evaluasifas_idpelat" class="t_evaluasifas_idpelat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_evaluasifas_list->idpelat->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_evaluasifas_list->idpelat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_evaluasifas_list->idpelat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_evaluasifas_list->kurikulumid->Visible) { // kurikulumid ?>
	<?php if ($t_evaluasifas_list->SortUrl($t_evaluasifas_list->kurikulumid) == "") { ?>
		<th data-name="kurikulumid" class="<?php echo $t_evaluasifas_list->kurikulumid->headerCellClass() ?>"><div id="elh_t_evaluasifas_kurikulumid" class="t_evaluasifas_kurikulumid"><div class="ew-table-header-caption"><?php echo $t_evaluasifas_list->kurikulumid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kurikulumid" class="<?php echo $t_evaluasifas_list->kurikulumid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_evaluasifas_list->SortUrl($t_evaluasifas_list->kurikulumid) ?>', 1);"><div id="elh_t_evaluasifas_kurikulumid" class="t_evaluasifas_kurikulumid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_evaluasifas_list->kurikulumid->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_evaluasifas_list->kurikulumid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_evaluasifas_list->kurikulumid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_evaluasifas_list->nilai->Visible) { // nilai ?>
	<?php if ($t_evaluasifas_list->SortUrl($t_evaluasifas_list->nilai) == "") { ?>
		<th data-name="nilai" class="<?php echo $t_evaluasifas_list->nilai->headerCellClass() ?>"><div id="elh_t_evaluasifas_nilai" class="t_evaluasifas_nilai"><div class="ew-table-header-caption"><?php echo $t_evaluasifas_list->nilai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nilai" class="<?php echo $t_evaluasifas_list->nilai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_evaluasifas_list->SortUrl($t_evaluasifas_list->nilai) ?>', 1);"><div id="elh_t_evaluasifas_nilai" class="t_evaluasifas_nilai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_evaluasifas_list->nilai->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_evaluasifas_list->nilai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_evaluasifas_list->nilai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_evaluasifas_list->komentar->Visible) { // komentar ?>
	<?php if ($t_evaluasifas_list->SortUrl($t_evaluasifas_list->komentar) == "") { ?>
		<th data-name="komentar" class="<?php echo $t_evaluasifas_list->komentar->headerCellClass() ?>"><div id="elh_t_evaluasifas_komentar" class="t_evaluasifas_komentar"><div class="ew-table-header-caption"><?php echo $t_evaluasifas_list->komentar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="komentar" class="<?php echo $t_evaluasifas_list->komentar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_evaluasifas_list->SortUrl($t_evaluasifas_list->komentar) ?>', 1);"><div id="elh_t_evaluasifas_komentar" class="t_evaluasifas_komentar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_evaluasifas_list->komentar->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_evaluasifas_list->komentar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_evaluasifas_list->komentar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_evaluasifas_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_evaluasifas_list->ExportAll && $t_evaluasifas_list->isExport()) {
	$t_evaluasifas_list->StopRecord = $t_evaluasifas_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_evaluasifas_list->TotalRecords > $t_evaluasifas_list->StartRecord + $t_evaluasifas_list->DisplayRecords - 1)
		$t_evaluasifas_list->StopRecord = $t_evaluasifas_list->StartRecord + $t_evaluasifas_list->DisplayRecords - 1;
	else
		$t_evaluasifas_list->StopRecord = $t_evaluasifas_list->TotalRecords;
}
$t_evaluasifas_list->RecordCount = $t_evaluasifas_list->StartRecord - 1;
if ($t_evaluasifas_list->Recordset && !$t_evaluasifas_list->Recordset->EOF) {
	$t_evaluasifas_list->Recordset->moveFirst();
	$selectLimit = $t_evaluasifas_list->UseSelectLimit;
	if (!$selectLimit && $t_evaluasifas_list->StartRecord > 1)
		$t_evaluasifas_list->Recordset->move($t_evaluasifas_list->StartRecord - 1);
} elseif (!$t_evaluasifas->AllowAddDeleteRow && $t_evaluasifas_list->StopRecord == 0) {
	$t_evaluasifas_list->StopRecord = $t_evaluasifas->GridAddRowCount;
}

// Initialize aggregate
$t_evaluasifas->RowType = ROWTYPE_AGGREGATEINIT;
$t_evaluasifas->resetAttributes();
$t_evaluasifas_list->renderRow();
while ($t_evaluasifas_list->RecordCount < $t_evaluasifas_list->StopRecord) {
	$t_evaluasifas_list->RecordCount++;
	if ($t_evaluasifas_list->RecordCount >= $t_evaluasifas_list->StartRecord) {
		$t_evaluasifas_list->RowCount++;

		// Set up key count
		$t_evaluasifas_list->KeyCount = $t_evaluasifas_list->RowIndex;

		// Init row class and style
		$t_evaluasifas->resetAttributes();
		$t_evaluasifas->CssClass = "";
		if ($t_evaluasifas_list->isGridAdd()) {
		} else {
			$t_evaluasifas_list->loadRowValues($t_evaluasifas_list->Recordset); // Load row values
		}
		$t_evaluasifas->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_evaluasifas->RowAttrs->merge(["data-rowindex" => $t_evaluasifas_list->RowCount, "id" => "r" . $t_evaluasifas_list->RowCount . "_t_evaluasifas", "data-rowtype" => $t_evaluasifas->RowType]);

		// Render row
		$t_evaluasifas_list->renderRow();

		// Render list options
		$t_evaluasifas_list->renderListOptions();
?>
	<tr <?php echo $t_evaluasifas->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_evaluasifas_list->ListOptions->render("body", "left", $t_evaluasifas_list->RowCount);
?>
	<?php if ($t_evaluasifas_list->bioid->Visible) { // bioid ?>
		<td data-name="bioid" <?php echo $t_evaluasifas_list->bioid->cellAttributes() ?>>
<span id="el<?php echo $t_evaluasifas_list->RowCount ?>_t_evaluasifas_bioid">
<span<?php echo $t_evaluasifas_list->bioid->viewAttributes() ?>><?php echo $t_evaluasifas_list->bioid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_evaluasifas_list->idpelat->Visible) { // idpelat ?>
		<td data-name="idpelat" <?php echo $t_evaluasifas_list->idpelat->cellAttributes() ?>>
<span id="el<?php echo $t_evaluasifas_list->RowCount ?>_t_evaluasifas_idpelat">
<span<?php echo $t_evaluasifas_list->idpelat->viewAttributes() ?>><?php echo $t_evaluasifas_list->idpelat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_evaluasifas_list->kurikulumid->Visible) { // kurikulumid ?>
		<td data-name="kurikulumid" <?php echo $t_evaluasifas_list->kurikulumid->cellAttributes() ?>>
<span id="el<?php echo $t_evaluasifas_list->RowCount ?>_t_evaluasifas_kurikulumid">
<span<?php echo $t_evaluasifas_list->kurikulumid->viewAttributes() ?>><?php echo $t_evaluasifas_list->kurikulumid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_evaluasifas_list->nilai->Visible) { // nilai ?>
		<td data-name="nilai" <?php echo $t_evaluasifas_list->nilai->cellAttributes() ?>>
<span id="el<?php echo $t_evaluasifas_list->RowCount ?>_t_evaluasifas_nilai">
<span<?php echo $t_evaluasifas_list->nilai->viewAttributes() ?>><?php echo $t_evaluasifas_list->nilai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_evaluasifas_list->komentar->Visible) { // komentar ?>
		<td data-name="komentar" <?php echo $t_evaluasifas_list->komentar->cellAttributes() ?>>
<span id="el<?php echo $t_evaluasifas_list->RowCount ?>_t_evaluasifas_komentar">
<span<?php echo $t_evaluasifas_list->komentar->viewAttributes() ?>><?php echo $t_evaluasifas_list->komentar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_evaluasifas_list->ListOptions->render("body", "right", $t_evaluasifas_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_evaluasifas_list->isGridAdd())
		$t_evaluasifas_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_evaluasifas->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_evaluasifas_list->Recordset)
	$t_evaluasifas_list->Recordset->Close();
?>
<?php if (!$t_evaluasifas_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_evaluasifas_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_evaluasifas_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_evaluasifas_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_evaluasifas_list->TotalRecords == 0 && !$t_evaluasifas->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_evaluasifas_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_evaluasifas_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_evaluasifas_list->isExport()) { ?>
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
$t_evaluasifas_list->terminate();
?>