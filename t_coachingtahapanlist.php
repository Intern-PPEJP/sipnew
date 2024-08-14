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
$t_coachingtahapan_list = new t_coachingtahapan_list();

// Run the page
$t_coachingtahapan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_coachingtahapan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_coachingtahapan_list->isExport()) { ?>
<script>
var ft_coachingtahapanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_coachingtahapanlist = currentForm = new ew.Form("ft_coachingtahapanlist", "list");
	ft_coachingtahapanlist.formKeyCountName = '<?php echo $t_coachingtahapan_list->FormKeyCountName ?>';
	loadjs.done("ft_coachingtahapanlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_coachingtahapan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_coachingtahapan_list->TotalRecords > 0 && $t_coachingtahapan_list->ExportOptions->visible()) { ?>
<?php $t_coachingtahapan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_coachingtahapan_list->ImportOptions->visible()) { ?>
<?php $t_coachingtahapan_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$t_coachingtahapan_list->isExport() || Config("EXPORT_MASTER_RECORD") && $t_coachingtahapan_list->isExport("print")) { ?>
<?php
if ($t_coachingtahapan_list->DbMasterFilter != "" && $t_coachingtahapan->getCurrentMasterTable() == "t_rkcoaching") {
	if ($t_coachingtahapan_list->MasterRecordExists) {
		include_once "t_rkcoachingmaster.php";
	}
}
?>
<?php } ?>
<?php
$t_coachingtahapan_list->renderOtherOptions();
?>
<?php $t_coachingtahapan_list->showPageHeader(); ?>
<?php
$t_coachingtahapan_list->showMessage();
?>
<?php if ($t_coachingtahapan_list->TotalRecords > 0 || $t_coachingtahapan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_coachingtahapan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_coachingtahapan">
<?php if (!$t_coachingtahapan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$t_coachingtahapan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_coachingtahapan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_coachingtahapan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft_coachingtahapanlist" id="ft_coachingtahapanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_coachingtahapan">
<?php if ($t_coachingtahapan->getCurrentMasterTable() == "t_rkcoaching" && $t_coachingtahapan->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_rkcoaching">
<input type="hidden" name="fk_rkid" value="<?php echo HtmlEncode($t_coachingtahapan_list->rkid->getSessionValue()) ?>">
<input type="hidden" name="fk_area" value="<?php echo HtmlEncode($t_coachingtahapan_list->area->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_t_coachingtahapan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_coachingtahapan_list->TotalRecords > 0 || $t_coachingtahapan_list->isGridEdit()) { ?>
<table id="tbl_t_coachingtahapanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_coachingtahapan->RowType = ROWTYPE_HEADER;

// Render list options
$t_coachingtahapan_list->renderListOptions();

// Render list options (header, left)
$t_coachingtahapan_list->ListOptions->render("header", "left");
?>
<?php if ($t_coachingtahapan_list->area->Visible) { // area ?>
	<?php if ($t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->area) == "") { ?>
		<th data-name="area" class="<?php echo $t_coachingtahapan_list->area->headerCellClass() ?>"><div id="elh_t_coachingtahapan_area" class="t_coachingtahapan_area"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->area->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="area" class="<?php echo $t_coachingtahapan_list->area->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->area) ?>', 1);"><div id="elh_t_coachingtahapan_area" class="t_coachingtahapan_area">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->area->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_list->area->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_list->area->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_list->jenispel->Visible) { // jenispel ?>
	<?php if ($t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->jenispel) == "") { ?>
		<th data-name="jenispel" class="<?php echo $t_coachingtahapan_list->jenispel->headerCellClass() ?>"><div id="elh_t_coachingtahapan_jenispel" class="t_coachingtahapan_jenispel"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->jenispel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenispel" class="<?php echo $t_coachingtahapan_list->jenispel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->jenispel) ?>', 1);"><div id="elh_t_coachingtahapan_jenispel" class="t_coachingtahapan_jenispel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->jenispel->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_list->jenispel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_list->jenispel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_list->kdkategori->Visible) { // kdkategori ?>
	<?php if ($t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->kdkategori) == "") { ?>
		<th data-name="kdkategori" class="<?php echo $t_coachingtahapan_list->kdkategori->headerCellClass() ?>"><div id="elh_t_coachingtahapan_kdkategori" class="t_coachingtahapan_kdkategori"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->kdkategori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkategori" class="<?php echo $t_coachingtahapan_list->kdkategori->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->kdkategori) ?>', 1);"><div id="elh_t_coachingtahapan_kdkategori" class="t_coachingtahapan_kdkategori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->kdkategori->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_list->kdkategori->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_list->kdkategori->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_list->kerjasama->Visible) { // kerjasama ?>
	<?php if ($t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->kerjasama) == "") { ?>
		<th data-name="kerjasama" class="<?php echo $t_coachingtahapan_list->kerjasama->headerCellClass() ?>"><div id="elh_t_coachingtahapan_kerjasama" class="t_coachingtahapan_kerjasama"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->kerjasama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kerjasama" class="<?php echo $t_coachingtahapan_list->kerjasama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->kerjasama) ?>', 1);"><div id="elh_t_coachingtahapan_kerjasama" class="t_coachingtahapan_kerjasama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->kerjasama->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_list->kerjasama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_list->kerjasama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_list->tglpelak1->Visible) { // tglpelak1 ?>
	<?php if ($t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->tglpelak1) == "") { ?>
		<th data-name="tglpelak1" class="<?php echo $t_coachingtahapan_list->tglpelak1->headerCellClass() ?>"><div id="elh_t_coachingtahapan_tglpelak1" class="t_coachingtahapan_tglpelak1"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->tglpelak1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tglpelak1" class="<?php echo $t_coachingtahapan_list->tglpelak1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->tglpelak1) ?>', 1);"><div id="elh_t_coachingtahapan_tglpelak1" class="t_coachingtahapan_tglpelak1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->tglpelak1->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_list->tglpelak1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_list->tglpelak1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_list->targetpes1->Visible) { // targetpes1 ?>
	<?php if ($t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->targetpes1) == "") { ?>
		<th data-name="targetpes1" class="<?php echo $t_coachingtahapan_list->targetpes1->headerCellClass() ?>"><div id="elh_t_coachingtahapan_targetpes1" class="t_coachingtahapan_targetpes1"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->targetpes1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes1" class="<?php echo $t_coachingtahapan_list->targetpes1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->targetpes1) ?>', 1);"><div id="elh_t_coachingtahapan_targetpes1" class="t_coachingtahapan_targetpes1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->targetpes1->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_list->targetpes1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_list->targetpes1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_list->tglpelak2->Visible) { // tglpelak2 ?>
	<?php if ($t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->tglpelak2) == "") { ?>
		<th data-name="tglpelak2" class="<?php echo $t_coachingtahapan_list->tglpelak2->headerCellClass() ?>"><div id="elh_t_coachingtahapan_tglpelak2" class="t_coachingtahapan_tglpelak2"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->tglpelak2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tglpelak2" class="<?php echo $t_coachingtahapan_list->tglpelak2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->tglpelak2) ?>', 1);"><div id="elh_t_coachingtahapan_tglpelak2" class="t_coachingtahapan_tglpelak2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->tglpelak2->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_list->tglpelak2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_list->tglpelak2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_list->targetpes2->Visible) { // targetpes2 ?>
	<?php if ($t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->targetpes2) == "") { ?>
		<th data-name="targetpes2" class="<?php echo $t_coachingtahapan_list->targetpes2->headerCellClass() ?>"><div id="elh_t_coachingtahapan_targetpes2" class="t_coachingtahapan_targetpes2"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->targetpes2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes2" class="<?php echo $t_coachingtahapan_list->targetpes2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->targetpes2) ?>', 1);"><div id="elh_t_coachingtahapan_targetpes2" class="t_coachingtahapan_targetpes2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->targetpes2->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_list->targetpes2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_list->targetpes2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_list->tglpelak3->Visible) { // tglpelak3 ?>
	<?php if ($t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->tglpelak3) == "") { ?>
		<th data-name="tglpelak3" class="<?php echo $t_coachingtahapan_list->tglpelak3->headerCellClass() ?>"><div id="elh_t_coachingtahapan_tglpelak3" class="t_coachingtahapan_tglpelak3"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->tglpelak3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tglpelak3" class="<?php echo $t_coachingtahapan_list->tglpelak3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->tglpelak3) ?>', 1);"><div id="elh_t_coachingtahapan_tglpelak3" class="t_coachingtahapan_tglpelak3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->tglpelak3->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_list->tglpelak3->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_list->tglpelak3->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_list->targetpes3->Visible) { // targetpes3 ?>
	<?php if ($t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->targetpes3) == "") { ?>
		<th data-name="targetpes3" class="<?php echo $t_coachingtahapan_list->targetpes3->headerCellClass() ?>"><div id="elh_t_coachingtahapan_targetpes3" class="t_coachingtahapan_targetpes3"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->targetpes3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes3" class="<?php echo $t_coachingtahapan_list->targetpes3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->targetpes3) ?>', 1);"><div id="elh_t_coachingtahapan_targetpes3" class="t_coachingtahapan_targetpes3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->targetpes3->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_list->targetpes3->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_list->targetpes3->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_list->tglpelak4->Visible) { // tglpelak4 ?>
	<?php if ($t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->tglpelak4) == "") { ?>
		<th data-name="tglpelak4" class="<?php echo $t_coachingtahapan_list->tglpelak4->headerCellClass() ?>"><div id="elh_t_coachingtahapan_tglpelak4" class="t_coachingtahapan_tglpelak4"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->tglpelak4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tglpelak4" class="<?php echo $t_coachingtahapan_list->tglpelak4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->tglpelak4) ?>', 1);"><div id="elh_t_coachingtahapan_tglpelak4" class="t_coachingtahapan_tglpelak4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->tglpelak4->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_list->tglpelak4->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_list->tglpelak4->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_list->targetpes4->Visible) { // targetpes4 ?>
	<?php if ($t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->targetpes4) == "") { ?>
		<th data-name="targetpes4" class="<?php echo $t_coachingtahapan_list->targetpes4->headerCellClass() ?>"><div id="elh_t_coachingtahapan_targetpes4" class="t_coachingtahapan_targetpes4"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->targetpes4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes4" class="<?php echo $t_coachingtahapan_list->targetpes4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->targetpes4) ?>', 1);"><div id="elh_t_coachingtahapan_targetpes4" class="t_coachingtahapan_targetpes4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->targetpes4->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_list->targetpes4->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_list->targetpes4->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_list->tglpelak5->Visible) { // tglpelak5 ?>
	<?php if ($t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->tglpelak5) == "") { ?>
		<th data-name="tglpelak5" class="<?php echo $t_coachingtahapan_list->tglpelak5->headerCellClass() ?>"><div id="elh_t_coachingtahapan_tglpelak5" class="t_coachingtahapan_tglpelak5"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->tglpelak5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tglpelak5" class="<?php echo $t_coachingtahapan_list->tglpelak5->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->tglpelak5) ?>', 1);"><div id="elh_t_coachingtahapan_tglpelak5" class="t_coachingtahapan_tglpelak5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->tglpelak5->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_list->tglpelak5->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_list->tglpelak5->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_list->targetpes5->Visible) { // targetpes5 ?>
	<?php if ($t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->targetpes5) == "") { ?>
		<th data-name="targetpes5" class="<?php echo $t_coachingtahapan_list->targetpes5->headerCellClass() ?>"><div id="elh_t_coachingtahapan_targetpes5" class="t_coachingtahapan_targetpes5"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->targetpes5->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes5" class="<?php echo $t_coachingtahapan_list->targetpes5->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->targetpes5) ?>', 1);"><div id="elh_t_coachingtahapan_targetpes5" class="t_coachingtahapan_targetpes5">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->targetpes5->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_list->targetpes5->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_list->targetpes5->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_list->tglpelak6->Visible) { // tglpelak6 ?>
	<?php if ($t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->tglpelak6) == "") { ?>
		<th data-name="tglpelak6" class="<?php echo $t_coachingtahapan_list->tglpelak6->headerCellClass() ?>"><div id="elh_t_coachingtahapan_tglpelak6" class="t_coachingtahapan_tglpelak6"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->tglpelak6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tglpelak6" class="<?php echo $t_coachingtahapan_list->tglpelak6->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->tglpelak6) ?>', 1);"><div id="elh_t_coachingtahapan_tglpelak6" class="t_coachingtahapan_tglpelak6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->tglpelak6->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_list->tglpelak6->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_list->tglpelak6->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_list->targetpes6->Visible) { // targetpes6 ?>
	<?php if ($t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->targetpes6) == "") { ?>
		<th data-name="targetpes6" class="<?php echo $t_coachingtahapan_list->targetpes6->headerCellClass() ?>"><div id="elh_t_coachingtahapan_targetpes6" class="t_coachingtahapan_targetpes6"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->targetpes6->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes6" class="<?php echo $t_coachingtahapan_list->targetpes6->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->targetpes6) ?>', 1);"><div id="elh_t_coachingtahapan_targetpes6" class="t_coachingtahapan_targetpes6">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->targetpes6->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_list->targetpes6->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_list->targetpes6->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_list->tglpelak7->Visible) { // tglpelak7 ?>
	<?php if ($t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->tglpelak7) == "") { ?>
		<th data-name="tglpelak7" class="<?php echo $t_coachingtahapan_list->tglpelak7->headerCellClass() ?>"><div id="elh_t_coachingtahapan_tglpelak7" class="t_coachingtahapan_tglpelak7"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->tglpelak7->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tglpelak7" class="<?php echo $t_coachingtahapan_list->tglpelak7->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->tglpelak7) ?>', 1);"><div id="elh_t_coachingtahapan_tglpelak7" class="t_coachingtahapan_tglpelak7">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->tglpelak7->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_list->tglpelak7->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_list->tglpelak7->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_list->targetpes7->Visible) { // targetpes7 ?>
	<?php if ($t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->targetpes7) == "") { ?>
		<th data-name="targetpes7" class="<?php echo $t_coachingtahapan_list->targetpes7->headerCellClass() ?>"><div id="elh_t_coachingtahapan_targetpes7" class="t_coachingtahapan_targetpes7"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->targetpes7->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes7" class="<?php echo $t_coachingtahapan_list->targetpes7->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->targetpes7) ?>', 1);"><div id="elh_t_coachingtahapan_targetpes7" class="t_coachingtahapan_targetpes7">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->targetpes7->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_list->targetpes7->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_list->targetpes7->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_list->tglpelak8->Visible) { // tglpelak8 ?>
	<?php if ($t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->tglpelak8) == "") { ?>
		<th data-name="tglpelak8" class="<?php echo $t_coachingtahapan_list->tglpelak8->headerCellClass() ?>"><div id="elh_t_coachingtahapan_tglpelak8" class="t_coachingtahapan_tglpelak8"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->tglpelak8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tglpelak8" class="<?php echo $t_coachingtahapan_list->tglpelak8->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->tglpelak8) ?>', 1);"><div id="elh_t_coachingtahapan_tglpelak8" class="t_coachingtahapan_tglpelak8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->tglpelak8->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_list->tglpelak8->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_list->tglpelak8->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_coachingtahapan_list->targetpes8->Visible) { // targetpes8 ?>
	<?php if ($t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->targetpes8) == "") { ?>
		<th data-name="targetpes8" class="<?php echo $t_coachingtahapan_list->targetpes8->headerCellClass() ?>"><div id="elh_t_coachingtahapan_targetpes8" class="t_coachingtahapan_targetpes8"><div class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->targetpes8->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="targetpes8" class="<?php echo $t_coachingtahapan_list->targetpes8->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_coachingtahapan_list->SortUrl($t_coachingtahapan_list->targetpes8) ?>', 1);"><div id="elh_t_coachingtahapan_targetpes8" class="t_coachingtahapan_targetpes8">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_coachingtahapan_list->targetpes8->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_coachingtahapan_list->targetpes8->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_coachingtahapan_list->targetpes8->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_coachingtahapan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_coachingtahapan_list->ExportAll && $t_coachingtahapan_list->isExport()) {
	$t_coachingtahapan_list->StopRecord = $t_coachingtahapan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_coachingtahapan_list->TotalRecords > $t_coachingtahapan_list->StartRecord + $t_coachingtahapan_list->DisplayRecords - 1)
		$t_coachingtahapan_list->StopRecord = $t_coachingtahapan_list->StartRecord + $t_coachingtahapan_list->DisplayRecords - 1;
	else
		$t_coachingtahapan_list->StopRecord = $t_coachingtahapan_list->TotalRecords;
}
$t_coachingtahapan_list->RecordCount = $t_coachingtahapan_list->StartRecord - 1;
if ($t_coachingtahapan_list->Recordset && !$t_coachingtahapan_list->Recordset->EOF) {
	$t_coachingtahapan_list->Recordset->moveFirst();
	$selectLimit = $t_coachingtahapan_list->UseSelectLimit;
	if (!$selectLimit && $t_coachingtahapan_list->StartRecord > 1)
		$t_coachingtahapan_list->Recordset->move($t_coachingtahapan_list->StartRecord - 1);
} elseif (!$t_coachingtahapan->AllowAddDeleteRow && $t_coachingtahapan_list->StopRecord == 0) {
	$t_coachingtahapan_list->StopRecord = $t_coachingtahapan->GridAddRowCount;
}

// Initialize aggregate
$t_coachingtahapan->RowType = ROWTYPE_AGGREGATEINIT;
$t_coachingtahapan->resetAttributes();
$t_coachingtahapan_list->renderRow();
while ($t_coachingtahapan_list->RecordCount < $t_coachingtahapan_list->StopRecord) {
	$t_coachingtahapan_list->RecordCount++;
	if ($t_coachingtahapan_list->RecordCount >= $t_coachingtahapan_list->StartRecord) {
		$t_coachingtahapan_list->RowCount++;

		// Set up key count
		$t_coachingtahapan_list->KeyCount = $t_coachingtahapan_list->RowIndex;

		// Init row class and style
		$t_coachingtahapan->resetAttributes();
		$t_coachingtahapan->CssClass = "";
		if ($t_coachingtahapan_list->isGridAdd()) {
		} else {
			$t_coachingtahapan_list->loadRowValues($t_coachingtahapan_list->Recordset); // Load row values
		}
		$t_coachingtahapan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_coachingtahapan->RowAttrs->merge(["data-rowindex" => $t_coachingtahapan_list->RowCount, "id" => "r" . $t_coachingtahapan_list->RowCount . "_t_coachingtahapan", "data-rowtype" => $t_coachingtahapan->RowType]);

		// Render row
		$t_coachingtahapan_list->renderRow();

		// Render list options
		$t_coachingtahapan_list->renderListOptions();
?>
	<tr <?php echo $t_coachingtahapan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_coachingtahapan_list->ListOptions->render("body", "left", $t_coachingtahapan_list->RowCount);
?>
	<?php if ($t_coachingtahapan_list->area->Visible) { // area ?>
		<td data-name="area" <?php echo $t_coachingtahapan_list->area->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_list->RowCount ?>_t_coachingtahapan_area">
<span<?php echo $t_coachingtahapan_list->area->viewAttributes() ?>><?php echo $t_coachingtahapan_list->area->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_list->jenispel->Visible) { // jenispel ?>
		<td data-name="jenispel" <?php echo $t_coachingtahapan_list->jenispel->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_list->RowCount ?>_t_coachingtahapan_jenispel">
<span<?php echo $t_coachingtahapan_list->jenispel->viewAttributes() ?>><?php echo $t_coachingtahapan_list->jenispel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_list->kdkategori->Visible) { // kdkategori ?>
		<td data-name="kdkategori" <?php echo $t_coachingtahapan_list->kdkategori->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_list->RowCount ?>_t_coachingtahapan_kdkategori">
<span<?php echo $t_coachingtahapan_list->kdkategori->viewAttributes() ?>><?php echo $t_coachingtahapan_list->kdkategori->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_list->kerjasama->Visible) { // kerjasama ?>
		<td data-name="kerjasama" <?php echo $t_coachingtahapan_list->kerjasama->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_list->RowCount ?>_t_coachingtahapan_kerjasama">
<span<?php echo $t_coachingtahapan_list->kerjasama->viewAttributes() ?>><?php echo $t_coachingtahapan_list->kerjasama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_list->tglpelak1->Visible) { // tglpelak1 ?>
		<td data-name="tglpelak1" <?php echo $t_coachingtahapan_list->tglpelak1->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_list->RowCount ?>_t_coachingtahapan_tglpelak1">
<span<?php echo $t_coachingtahapan_list->tglpelak1->viewAttributes() ?>><?php echo $t_coachingtahapan_list->tglpelak1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_list->targetpes1->Visible) { // targetpes1 ?>
		<td data-name="targetpes1" <?php echo $t_coachingtahapan_list->targetpes1->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_list->RowCount ?>_t_coachingtahapan_targetpes1">
<span<?php echo $t_coachingtahapan_list->targetpes1->viewAttributes() ?>><?php echo $t_coachingtahapan_list->targetpes1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_list->tglpelak2->Visible) { // tglpelak2 ?>
		<td data-name="tglpelak2" <?php echo $t_coachingtahapan_list->tglpelak2->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_list->RowCount ?>_t_coachingtahapan_tglpelak2">
<span<?php echo $t_coachingtahapan_list->tglpelak2->viewAttributes() ?>><?php echo $t_coachingtahapan_list->tglpelak2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_list->targetpes2->Visible) { // targetpes2 ?>
		<td data-name="targetpes2" <?php echo $t_coachingtahapan_list->targetpes2->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_list->RowCount ?>_t_coachingtahapan_targetpes2">
<span<?php echo $t_coachingtahapan_list->targetpes2->viewAttributes() ?>><?php echo $t_coachingtahapan_list->targetpes2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_list->tglpelak3->Visible) { // tglpelak3 ?>
		<td data-name="tglpelak3" <?php echo $t_coachingtahapan_list->tglpelak3->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_list->RowCount ?>_t_coachingtahapan_tglpelak3">
<span<?php echo $t_coachingtahapan_list->tglpelak3->viewAttributes() ?>><?php echo $t_coachingtahapan_list->tglpelak3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_list->targetpes3->Visible) { // targetpes3 ?>
		<td data-name="targetpes3" <?php echo $t_coachingtahapan_list->targetpes3->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_list->RowCount ?>_t_coachingtahapan_targetpes3">
<span<?php echo $t_coachingtahapan_list->targetpes3->viewAttributes() ?>><?php echo $t_coachingtahapan_list->targetpes3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_list->tglpelak4->Visible) { // tglpelak4 ?>
		<td data-name="tglpelak4" <?php echo $t_coachingtahapan_list->tglpelak4->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_list->RowCount ?>_t_coachingtahapan_tglpelak4">
<span<?php echo $t_coachingtahapan_list->tglpelak4->viewAttributes() ?>><?php echo $t_coachingtahapan_list->tglpelak4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_list->targetpes4->Visible) { // targetpes4 ?>
		<td data-name="targetpes4" <?php echo $t_coachingtahapan_list->targetpes4->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_list->RowCount ?>_t_coachingtahapan_targetpes4">
<span<?php echo $t_coachingtahapan_list->targetpes4->viewAttributes() ?>><?php echo $t_coachingtahapan_list->targetpes4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_list->tglpelak5->Visible) { // tglpelak5 ?>
		<td data-name="tglpelak5" <?php echo $t_coachingtahapan_list->tglpelak5->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_list->RowCount ?>_t_coachingtahapan_tglpelak5">
<span<?php echo $t_coachingtahapan_list->tglpelak5->viewAttributes() ?>><?php echo $t_coachingtahapan_list->tglpelak5->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_list->targetpes5->Visible) { // targetpes5 ?>
		<td data-name="targetpes5" <?php echo $t_coachingtahapan_list->targetpes5->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_list->RowCount ?>_t_coachingtahapan_targetpes5">
<span<?php echo $t_coachingtahapan_list->targetpes5->viewAttributes() ?>><?php echo $t_coachingtahapan_list->targetpes5->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_list->tglpelak6->Visible) { // tglpelak6 ?>
		<td data-name="tglpelak6" <?php echo $t_coachingtahapan_list->tglpelak6->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_list->RowCount ?>_t_coachingtahapan_tglpelak6">
<span<?php echo $t_coachingtahapan_list->tglpelak6->viewAttributes() ?>><?php echo $t_coachingtahapan_list->tglpelak6->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_list->targetpes6->Visible) { // targetpes6 ?>
		<td data-name="targetpes6" <?php echo $t_coachingtahapan_list->targetpes6->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_list->RowCount ?>_t_coachingtahapan_targetpes6">
<span<?php echo $t_coachingtahapan_list->targetpes6->viewAttributes() ?>><?php echo $t_coachingtahapan_list->targetpes6->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_list->tglpelak7->Visible) { // tglpelak7 ?>
		<td data-name="tglpelak7" <?php echo $t_coachingtahapan_list->tglpelak7->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_list->RowCount ?>_t_coachingtahapan_tglpelak7">
<span<?php echo $t_coachingtahapan_list->tglpelak7->viewAttributes() ?>><?php echo $t_coachingtahapan_list->tglpelak7->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_list->targetpes7->Visible) { // targetpes7 ?>
		<td data-name="targetpes7" <?php echo $t_coachingtahapan_list->targetpes7->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_list->RowCount ?>_t_coachingtahapan_targetpes7">
<span<?php echo $t_coachingtahapan_list->targetpes7->viewAttributes() ?>><?php echo $t_coachingtahapan_list->targetpes7->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_list->tglpelak8->Visible) { // tglpelak8 ?>
		<td data-name="tglpelak8" <?php echo $t_coachingtahapan_list->tglpelak8->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_list->RowCount ?>_t_coachingtahapan_tglpelak8">
<span<?php echo $t_coachingtahapan_list->tglpelak8->viewAttributes() ?>><?php echo $t_coachingtahapan_list->tglpelak8->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_coachingtahapan_list->targetpes8->Visible) { // targetpes8 ?>
		<td data-name="targetpes8" <?php echo $t_coachingtahapan_list->targetpes8->cellAttributes() ?>>
<span id="el<?php echo $t_coachingtahapan_list->RowCount ?>_t_coachingtahapan_targetpes8">
<span<?php echo $t_coachingtahapan_list->targetpes8->viewAttributes() ?>><?php echo $t_coachingtahapan_list->targetpes8->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_coachingtahapan_list->ListOptions->render("body", "right", $t_coachingtahapan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_coachingtahapan_list->isGridAdd())
		$t_coachingtahapan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_coachingtahapan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_coachingtahapan_list->Recordset)
	$t_coachingtahapan_list->Recordset->Close();
?>
<?php if (!$t_coachingtahapan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_coachingtahapan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_coachingtahapan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_coachingtahapan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_coachingtahapan_list->TotalRecords == 0 && !$t_coachingtahapan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_coachingtahapan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_coachingtahapan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_coachingtahapan_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$('[data-name="tglpelak1"],[data-name="targetpes1"],[data-name="bendahara1"]').hide(),$('[data-name="tglpelak2"],[data-name="targetpes2"],[data-name="bendahara2"]').hide(),$('[data-name="tglpelak3"],[data-name="targetpes3"],[data-name="bendahara3"]').hide(),$('[data-name="tglpelak4"],[data-name="targetpes4"],[data-name="bendahara4"]').hide(),$('[data-name="tglpelak5"],[data-name="targetpes5"],[data-name="bendahara5"]').hide(),$('[data-name="tglpelak6"],[data-name="targetpes6"],[data-name="bendahara6"]').hide(),$('[data-name="tglpelak7"],[data-name="targetpes7"],[data-name="bendahara7"]').hide(),$('[data-name="tglpelak8"],[data-name="targetpes8"],[data-name="bendahara8"]').hide(),$("#t1").click(function(){$('[data-name="tglpelak1"],[data-name="targetpes1"],[data-name="bendahara1"]').show(500),$('[data-name="tglpelak2"],[data-name="targetpes2"],[data-name="bendahara2"]').hide(500),$('[data-name="tglpelak3"],[data-name="targetpes3"],[data-name="bendahara3"]').hide(500),$('[data-name="tglpelak4"],[data-name="targetpes4"],[data-name="bendahara4"]').hide(500),$('[data-name="tglpelak5"],[data-name="targetpes5"],[data-name="bendahara5"]').hide(500),$('[data-name="tglpelak6"],[data-name="targetpes6"],[data-name="bendahara6"]').hide(500),$('[data-name="tglpelak7"],[data-name="targetpes7"],[data-name="bendahara7"]').hide(500),$('[data-name="tglpelak8"],[data-name="targetpes8"],[data-name="bendahara8"]').hide(500)}),$("#t2").click(function(){$('[data-name="tglpelak1"],[data-name="targetpes1"],[data-name="bendahara1"]').hide(500),$('[data-name="tglpelak2"],[data-name="targetpes2"],[data-name="bendahara2"]').show(500),$('[data-name="tglpelak3"],[data-name="targetpes3"],[data-name="bendahara3"]').hide(500),$('[data-name="tglpelak4"],[data-name="targetpes4"],[data-name="bendahara4"]').hide(500),$('[data-name="tglpelak5"],[data-name="targetpes5"],[data-name="bendahara5"]').hide(500),$('[data-name="tglpelak6"],[data-name="targetpes6"],[data-name="bendahara6"]').hide(500),$('[data-name="tglpelak7"],[data-name="targetpes7"],[data-name="bendahara7"]').hide(500),$('[data-name="tglpelak8"],[data-name="targetpes8"],[data-name="bendahara8"]').hide(500)}),$("#t3").click(function(){$('[data-name="tglpelak1"],[data-name="targetpes1"],[data-name="bendahara1"]').hide(500),$('[data-name="tglpelak2"],[data-name="targetpes2"],[data-name="bendahara2"]').hide(500),$('[data-name="tglpelak3"],[data-name="targetpes3"],[data-name="bendahara3"]').show(500),$('[data-name="tglpelak4"],[data-name="targetpes4"],[data-name="bendahara4"]').hide(500),$('[data-name="tglpelak5"],[data-name="targetpes5"],[data-name="bendahara5"]').hide(500),$('[data-name="tglpelak6"],[data-name="targetpes6"],[data-name="bendahara6"]').hide(500),$('[data-name="tglpelak7"],[data-name="targetpes7"],[data-name="bendahara7"]').hide(500),$('[data-name="tglpelak8"],[data-name="targetpes8"],[data-name="bendahara8"]').hide(500)}),$("#t4").click(function(){$('[data-name="tglpelak1"],[data-name="targetpes1"],[data-name="bendahara1"]').hide(500),$('[data-name="tglpelak2"],[data-name="targetpes2"],[data-name="bendahara2"]').hide(500),$('[data-name="tglpelak3"],[data-name="targetpes3"],[data-name="bendahara3"]').hide(500),$('[data-name="tglpelak4"],[data-name="targetpes4"],[data-name="bendahara4"]').show(500),$('[data-name="tglpelak5"],[data-name="targetpes5"],[data-name="bendahara5"]').hide(500),$('[data-name="tglpelak6"],[data-name="targetpes6"],[data-name="bendahara6"]').hide(500),$('[data-name="tglpelak7"],[data-name="targetpes7"],[data-name="bendahara7"]').hide(500),$('[data-name="tglpelak8"],[data-name="targetpes8"],[data-name="bendahara8"]').hide(500)}),$("#t5").click(function(){$('[data-name="tglpelak1"],[data-name="targetpes1"],[data-name="bendahara1"]').hide(500),$('[data-name="tglpelak2"],[data-name="targetpes2"],[data-name="bendahara2"]').hide(500),$('[data-name="tglpelak3"],[data-name="targetpes3"],[data-name="bendahara3"]').hide(500),$('[data-name="tglpelak4"],[data-name="targetpes4"],[data-name="bendahara4"]').hide(500),$('[data-name="tglpelak5"],[data-name="targetpes5"],[data-name="bendahara5"]').show(500),$('[data-name="tglpelak6"],[data-name="targetpes6"],[data-name="bendahara6"]').hide(500),$('[data-name="tglpelak7"],[data-name="targetpes7"],[data-name="bendahara7"]').hide(500),$('[data-name="tglpelak8"],[data-name="targetpes8"],[data-name="bendahara8"]').hide(500)}),$("#t6").click(function(){$('[data-name="tglpelak1"],[data-name="targetpes1"],[data-name="bendahara1"]').hide(500),$('[data-name="tglpelak2"],[data-name="targetpes2"],[data-name="bendahara2"]').hide(500),$('[data-name="tglpelak3"],[data-name="targetpes3"],[data-name="bendahara3"]').hide(500),$('[data-name="tglpelak4"],[data-name="targetpes4"],[data-name="bendahara4"]').hide(500),$('[data-name="tglpelak5"],[data-name="targetpes5"],[data-name="bendahara5"]').hide(500),$('[data-name="tglpelak6"],[data-name="targetpes6"],[data-name="bendahara6"]').show(500),$('[data-name="tglpelak7"],[data-name="targetpes7"],[data-name="bendahara7"]').hide(500),$('[data-name="tglpelak8"],[data-name="targetpes8"],[data-name="bendahara8"]').hide(500)}),$("#t7").click(function(){$('[data-name="tglpelak1"],[data-name="targetpes1"],[data-name="bendahara1"]').hide(500),$('[data-name="tglpelak2"],[data-name="targetpes2"],[data-name="bendahara2"]').hide(500),$('[data-name="tglpelak3"],[data-name="targetpes3"],[data-name="bendahara3"]').hide(500),$('[data-name="tglpelak4"],[data-name="targetpes4"],[data-name="bendahara4"]').hide(500),$('[data-name="tglpelak5"],[data-name="targetpes5"],[data-name="bendahara5"]').hide(500),$('[data-name="tglpelak6"],[data-name="targetpes6"],[data-name="bendahara6"]').hide(500),$('[data-name="tglpelak7"],[data-name="targetpes7"],[data-name="bendahara7"]').show(500),$('[data-name="tglpelak8"],[data-name="targetpes8"],[data-name="bendahara8"]').hide(500)}),$("#t8").click(function(){$('[data-name="tglpelak1"],[data-name="targetpes1"],[data-name="bendahara1"]').hide(500),$('[data-name="tglpelak2"],[data-name="targetpes2"],[data-name="bendahara2"]').hide(500),$('[data-name="tglpelak3"],[data-name="targetpes3"],[data-name="bendahara3"]').hide(500),$('[data-name="tglpelak4"],[data-name="targetpes4"],[data-name="bendahara4"]').hide(500),$('[data-name="tglpelak5"],[data-name="targetpes5"],[data-name="bendahara5"]').hide(500),$('[data-name="tglpelak6"],[data-name="targetpes6"],[data-name="bendahara6"]').hide(500),$('[data-name="tglpelak7"],[data-name="targetpes7"],[data-name="bendahara7"]').hide(500),$('[data-name="tglpelak8"],[data-name="targetpes8"],[data-name="bendahara8"]').show(500)});
});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$t_coachingtahapan_list->terminate();
?>