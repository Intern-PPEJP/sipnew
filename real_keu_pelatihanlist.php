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
$real_keu_pelatihan_list = new real_keu_pelatihan_list();

// Run the page
$real_keu_pelatihan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$real_keu_pelatihan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$real_keu_pelatihan_list->isExport()) { ?>
<script>
var freal_keu_pelatihanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	freal_keu_pelatihanlist = currentForm = new ew.Form("freal_keu_pelatihanlist", "list");
	freal_keu_pelatihanlist.formKeyCountName = '<?php echo $real_keu_pelatihan_list->FormKeyCountName ?>';
	loadjs.done("freal_keu_pelatihanlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$real_keu_pelatihan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($real_keu_pelatihan_list->TotalRecords > 0 && $real_keu_pelatihan_list->ExportOptions->visible()) { ?>
<?php $real_keu_pelatihan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($real_keu_pelatihan_list->ImportOptions->visible()) { ?>
<?php $real_keu_pelatihan_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$real_keu_pelatihan_list->renderOtherOptions();
?>
<?php $real_keu_pelatihan_list->showPageHeader(); ?>
<?php
$real_keu_pelatihan_list->showMessage();
?>
<?php if ($real_keu_pelatihan_list->TotalRecords > 0 || $real_keu_pelatihan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($real_keu_pelatihan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> real_keu_pelatihan">
<?php if (!$real_keu_pelatihan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$real_keu_pelatihan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $real_keu_pelatihan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $real_keu_pelatihan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="freal_keu_pelatihanlist" id="freal_keu_pelatihanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="real_keu_pelatihan">
<div id="gmp_real_keu_pelatihan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($real_keu_pelatihan_list->TotalRecords > 0 || $real_keu_pelatihan_list->isGridEdit()) { ?>
<table id="tbl_real_keu_pelatihanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$real_keu_pelatihan->RowType = ROWTYPE_HEADER;

// Render list options
$real_keu_pelatihan_list->renderListOptions();

// Render list options (header, left)
$real_keu_pelatihan_list->ListOptions->render("header", "left");
?>
<?php if ($real_keu_pelatihan_list->kdpelat->Visible) { // kdpelat ?>
	<?php if ($real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->kdpelat) == "") { ?>
		<th data-name="kdpelat" class="<?php echo $real_keu_pelatihan_list->kdpelat->headerCellClass() ?>"><div id="elh_real_keu_pelatihan_kdpelat" class="real_keu_pelatihan_kdpelat"><div class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->kdpelat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdpelat" class="<?php echo $real_keu_pelatihan_list->kdpelat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->kdpelat) ?>', 1);"><div id="elh_real_keu_pelatihan_kdpelat" class="real_keu_pelatihan_kdpelat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->kdpelat->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_keu_pelatihan_list->kdpelat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_keu_pelatihan_list->kdpelat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_keu_pelatihan_list->kdjudul->Visible) { // kdjudul ?>
	<?php if ($real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->kdjudul) == "") { ?>
		<th data-name="kdjudul" class="<?php echo $real_keu_pelatihan_list->kdjudul->headerCellClass() ?>"><div id="elh_real_keu_pelatihan_kdjudul" class="real_keu_pelatihan_kdjudul"><div class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->kdjudul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdjudul" class="<?php echo $real_keu_pelatihan_list->kdjudul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->kdjudul) ?>', 1);"><div id="elh_real_keu_pelatihan_kdjudul" class="real_keu_pelatihan_kdjudul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->kdjudul->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_keu_pelatihan_list->kdjudul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_keu_pelatihan_list->kdjudul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_keu_pelatihan_list->kdkota->Visible) { // kdkota ?>
	<?php if ($real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->kdkota) == "") { ?>
		<th data-name="kdkota" class="<?php echo $real_keu_pelatihan_list->kdkota->headerCellClass() ?>"><div id="elh_real_keu_pelatihan_kdkota" class="real_keu_pelatihan_kdkota"><div class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->kdkota->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdkota" class="<?php echo $real_keu_pelatihan_list->kdkota->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->kdkota) ?>', 1);"><div id="elh_real_keu_pelatihan_kdkota" class="real_keu_pelatihan_kdkota">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->kdkota->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_keu_pelatihan_list->kdkota->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_keu_pelatihan_list->kdkota->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_keu_pelatihan_list->tawal->Visible) { // tawal ?>
	<?php if ($real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->tawal) == "") { ?>
		<th data-name="tawal" class="<?php echo $real_keu_pelatihan_list->tawal->headerCellClass() ?>"><div id="elh_real_keu_pelatihan_tawal" class="real_keu_pelatihan_tawal"><div class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->tawal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tawal" class="<?php echo $real_keu_pelatihan_list->tawal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->tawal) ?>', 1);"><div id="elh_real_keu_pelatihan_tawal" class="real_keu_pelatihan_tawal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->tawal->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_keu_pelatihan_list->tawal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_keu_pelatihan_list->tawal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_keu_pelatihan_list->takhir->Visible) { // takhir ?>
	<?php if ($real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->takhir) == "") { ?>
		<th data-name="takhir" class="<?php echo $real_keu_pelatihan_list->takhir->headerCellClass() ?>"><div id="elh_real_keu_pelatihan_takhir" class="real_keu_pelatihan_takhir"><div class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->takhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="takhir" class="<?php echo $real_keu_pelatihan_list->takhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->takhir) ?>', 1);"><div id="elh_real_keu_pelatihan_takhir" class="real_keu_pelatihan_takhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->takhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_keu_pelatihan_list->takhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_keu_pelatihan_list->takhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_keu_pelatihan_list->biaya->Visible) { // biaya ?>
	<?php if ($real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->biaya) == "") { ?>
		<th data-name="biaya" class="<?php echo $real_keu_pelatihan_list->biaya->headerCellClass() ?>"><div id="elh_real_keu_pelatihan_biaya" class="real_keu_pelatihan_biaya"><div class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->biaya->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="biaya" class="<?php echo $real_keu_pelatihan_list->biaya->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->biaya) ?>', 1);"><div id="elh_real_keu_pelatihan_biaya" class="real_keu_pelatihan_biaya">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->biaya->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_keu_pelatihan_list->biaya->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_keu_pelatihan_list->biaya->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_keu_pelatihan_list->jmlpes->Visible) { // jmlpes ?>
	<?php if ($real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->jmlpes) == "") { ?>
		<th data-name="jmlpes" class="<?php echo $real_keu_pelatihan_list->jmlpes->headerCellClass() ?>"><div id="elh_real_keu_pelatihan_jmlpes" class="real_keu_pelatihan_jmlpes"><div class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->jmlpes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jmlpes" class="<?php echo $real_keu_pelatihan_list->jmlpes->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->jmlpes) ?>', 1);"><div id="elh_real_keu_pelatihan_jmlpes" class="real_keu_pelatihan_jmlpes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->jmlpes->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_keu_pelatihan_list->jmlpes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_keu_pelatihan_list->jmlpes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_keu_pelatihan_list->jml->Visible) { // jml ?>
	<?php if ($real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->jml) == "") { ?>
		<th data-name="jml" class="<?php echo $real_keu_pelatihan_list->jml->headerCellClass() ?>"><div id="elh_real_keu_pelatihan_jml" class="real_keu_pelatihan_jml"><div class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->jml->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jml" class="<?php echo $real_keu_pelatihan_list->jml->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->jml) ?>', 1);"><div id="elh_real_keu_pelatihan_jml" class="real_keu_pelatihan_jml">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->jml->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_keu_pelatihan_list->jml->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_keu_pelatihan_list->jml->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_keu_pelatihan_list->total->Visible) { // total ?>
	<?php if ($real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->total) == "") { ?>
		<th data-name="total" class="<?php echo $real_keu_pelatihan_list->total->headerCellClass() ?>"><div id="elh_real_keu_pelatihan_total" class="real_keu_pelatihan_total"><div class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->total->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total" class="<?php echo $real_keu_pelatihan_list->total->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->total) ?>', 1);"><div id="elh_real_keu_pelatihan_total" class="real_keu_pelatihan_total">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->total->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_keu_pelatihan_list->total->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_keu_pelatihan_list->total->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_keu_pelatihan_list->ket->Visible) { // ket ?>
	<?php if ($real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->ket) == "") { ?>
		<th data-name="ket" class="<?php echo $real_keu_pelatihan_list->ket->headerCellClass() ?>"><div id="elh_real_keu_pelatihan_ket" class="real_keu_pelatihan_ket"><div class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->ket->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ket" class="<?php echo $real_keu_pelatihan_list->ket->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->ket) ?>', 1);"><div id="elh_real_keu_pelatihan_ket" class="real_keu_pelatihan_ket">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->ket->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_keu_pelatihan_list->ket->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_keu_pelatihan_list->ket->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_keu_pelatihan_list->bln->Visible) { // bln ?>
	<?php if ($real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->bln) == "") { ?>
		<th data-name="bln" class="<?php echo $real_keu_pelatihan_list->bln->headerCellClass() ?>"><div id="elh_real_keu_pelatihan_bln" class="real_keu_pelatihan_bln"><div class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->bln->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bln" class="<?php echo $real_keu_pelatihan_list->bln->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->bln) ?>', 1);"><div id="elh_real_keu_pelatihan_bln" class="real_keu_pelatihan_bln">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->bln->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_keu_pelatihan_list->bln->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_keu_pelatihan_list->bln->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_keu_pelatihan_list->thn->Visible) { // thn ?>
	<?php if ($real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->thn) == "") { ?>
		<th data-name="thn" class="<?php echo $real_keu_pelatihan_list->thn->headerCellClass() ?>"><div id="elh_real_keu_pelatihan_thn" class="real_keu_pelatihan_thn"><div class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->thn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="thn" class="<?php echo $real_keu_pelatihan_list->thn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->thn) ?>', 1);"><div id="elh_real_keu_pelatihan_thn" class="real_keu_pelatihan_thn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->thn->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_keu_pelatihan_list->thn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_keu_pelatihan_list->thn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_keu_pelatihan_list->kdprop->Visible) { // kdprop ?>
	<?php if ($real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->kdprop) == "") { ?>
		<th data-name="kdprop" class="<?php echo $real_keu_pelatihan_list->kdprop->headerCellClass() ?>"><div id="elh_real_keu_pelatihan_kdprop" class="real_keu_pelatihan_kdprop"><div class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->kdprop->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kdprop" class="<?php echo $real_keu_pelatihan_list->kdprop->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->kdprop) ?>', 1);"><div id="elh_real_keu_pelatihan_kdprop" class="real_keu_pelatihan_kdprop">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->kdprop->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_keu_pelatihan_list->kdprop->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_keu_pelatihan_list->kdprop->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($real_keu_pelatihan_list->jenispel->Visible) { // jenispel ?>
	<?php if ($real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->jenispel) == "") { ?>
		<th data-name="jenispel" class="<?php echo $real_keu_pelatihan_list->jenispel->headerCellClass() ?>"><div id="elh_real_keu_pelatihan_jenispel" class="real_keu_pelatihan_jenispel"><div class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->jenispel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenispel" class="<?php echo $real_keu_pelatihan_list->jenispel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $real_keu_pelatihan_list->SortUrl($real_keu_pelatihan_list->jenispel) ?>', 1);"><div id="elh_real_keu_pelatihan_jenispel" class="real_keu_pelatihan_jenispel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $real_keu_pelatihan_list->jenispel->caption() ?></span><span class="ew-table-header-sort"><?php if ($real_keu_pelatihan_list->jenispel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($real_keu_pelatihan_list->jenispel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$real_keu_pelatihan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($real_keu_pelatihan_list->ExportAll && $real_keu_pelatihan_list->isExport()) {
	$real_keu_pelatihan_list->StopRecord = $real_keu_pelatihan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($real_keu_pelatihan_list->TotalRecords > $real_keu_pelatihan_list->StartRecord + $real_keu_pelatihan_list->DisplayRecords - 1)
		$real_keu_pelatihan_list->StopRecord = $real_keu_pelatihan_list->StartRecord + $real_keu_pelatihan_list->DisplayRecords - 1;
	else
		$real_keu_pelatihan_list->StopRecord = $real_keu_pelatihan_list->TotalRecords;
}
$real_keu_pelatihan_list->RecordCount = $real_keu_pelatihan_list->StartRecord - 1;
if ($real_keu_pelatihan_list->Recordset && !$real_keu_pelatihan_list->Recordset->EOF) {
	$real_keu_pelatihan_list->Recordset->moveFirst();
	$selectLimit = $real_keu_pelatihan_list->UseSelectLimit;
	if (!$selectLimit && $real_keu_pelatihan_list->StartRecord > 1)
		$real_keu_pelatihan_list->Recordset->move($real_keu_pelatihan_list->StartRecord - 1);
} elseif (!$real_keu_pelatihan->AllowAddDeleteRow && $real_keu_pelatihan_list->StopRecord == 0) {
	$real_keu_pelatihan_list->StopRecord = $real_keu_pelatihan->GridAddRowCount;
}

// Initialize aggregate
$real_keu_pelatihan->RowType = ROWTYPE_AGGREGATEINIT;
$real_keu_pelatihan->resetAttributes();
$real_keu_pelatihan_list->renderRow();
while ($real_keu_pelatihan_list->RecordCount < $real_keu_pelatihan_list->StopRecord) {
	$real_keu_pelatihan_list->RecordCount++;
	if ($real_keu_pelatihan_list->RecordCount >= $real_keu_pelatihan_list->StartRecord) {
		$real_keu_pelatihan_list->RowCount++;

		// Set up key count
		$real_keu_pelatihan_list->KeyCount = $real_keu_pelatihan_list->RowIndex;

		// Init row class and style
		$real_keu_pelatihan->resetAttributes();
		$real_keu_pelatihan->CssClass = "";
		if ($real_keu_pelatihan_list->isGridAdd()) {
		} else {
			$real_keu_pelatihan_list->loadRowValues($real_keu_pelatihan_list->Recordset); // Load row values
		}
		$real_keu_pelatihan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$real_keu_pelatihan->RowAttrs->merge(["data-rowindex" => $real_keu_pelatihan_list->RowCount, "id" => "r" . $real_keu_pelatihan_list->RowCount . "_real_keu_pelatihan", "data-rowtype" => $real_keu_pelatihan->RowType]);

		// Render row
		$real_keu_pelatihan_list->renderRow();

		// Render list options
		$real_keu_pelatihan_list->renderListOptions();
?>
	<tr <?php echo $real_keu_pelatihan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$real_keu_pelatihan_list->ListOptions->render("body", "left", $real_keu_pelatihan_list->RowCount);
?>
	<?php if ($real_keu_pelatihan_list->kdpelat->Visible) { // kdpelat ?>
		<td data-name="kdpelat" <?php echo $real_keu_pelatihan_list->kdpelat->cellAttributes() ?>>
<span id="el<?php echo $real_keu_pelatihan_list->RowCount ?>_real_keu_pelatihan_kdpelat">
<span<?php echo $real_keu_pelatihan_list->kdpelat->viewAttributes() ?>><?php echo $real_keu_pelatihan_list->kdpelat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_keu_pelatihan_list->kdjudul->Visible) { // kdjudul ?>
		<td data-name="kdjudul" <?php echo $real_keu_pelatihan_list->kdjudul->cellAttributes() ?>>
<span id="el<?php echo $real_keu_pelatihan_list->RowCount ?>_real_keu_pelatihan_kdjudul">
<span<?php echo $real_keu_pelatihan_list->kdjudul->viewAttributes() ?>><?php echo $real_keu_pelatihan_list->kdjudul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_keu_pelatihan_list->kdkota->Visible) { // kdkota ?>
		<td data-name="kdkota" <?php echo $real_keu_pelatihan_list->kdkota->cellAttributes() ?>>
<span id="el<?php echo $real_keu_pelatihan_list->RowCount ?>_real_keu_pelatihan_kdkota">
<span<?php echo $real_keu_pelatihan_list->kdkota->viewAttributes() ?>><?php echo $real_keu_pelatihan_list->kdkota->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_keu_pelatihan_list->tawal->Visible) { // tawal ?>
		<td data-name="tawal" <?php echo $real_keu_pelatihan_list->tawal->cellAttributes() ?>>
<span id="el<?php echo $real_keu_pelatihan_list->RowCount ?>_real_keu_pelatihan_tawal">
<span<?php echo $real_keu_pelatihan_list->tawal->viewAttributes() ?>><?php echo $real_keu_pelatihan_list->tawal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_keu_pelatihan_list->takhir->Visible) { // takhir ?>
		<td data-name="takhir" <?php echo $real_keu_pelatihan_list->takhir->cellAttributes() ?>>
<span id="el<?php echo $real_keu_pelatihan_list->RowCount ?>_real_keu_pelatihan_takhir">
<span<?php echo $real_keu_pelatihan_list->takhir->viewAttributes() ?>><?php echo $real_keu_pelatihan_list->takhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_keu_pelatihan_list->biaya->Visible) { // biaya ?>
		<td data-name="biaya" <?php echo $real_keu_pelatihan_list->biaya->cellAttributes() ?>>
<span id="el<?php echo $real_keu_pelatihan_list->RowCount ?>_real_keu_pelatihan_biaya">
<span<?php echo $real_keu_pelatihan_list->biaya->viewAttributes() ?>><?php echo $real_keu_pelatihan_list->biaya->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_keu_pelatihan_list->jmlpes->Visible) { // jmlpes ?>
		<td data-name="jmlpes" <?php echo $real_keu_pelatihan_list->jmlpes->cellAttributes() ?>>
<span id="el<?php echo $real_keu_pelatihan_list->RowCount ?>_real_keu_pelatihan_jmlpes">
<span<?php echo $real_keu_pelatihan_list->jmlpes->viewAttributes() ?>><?php echo $real_keu_pelatihan_list->jmlpes->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_keu_pelatihan_list->jml->Visible) { // jml ?>
		<td data-name="jml" <?php echo $real_keu_pelatihan_list->jml->cellAttributes() ?>>
<span id="el<?php echo $real_keu_pelatihan_list->RowCount ?>_real_keu_pelatihan_jml">
<span<?php echo $real_keu_pelatihan_list->jml->viewAttributes() ?>><?php echo $real_keu_pelatihan_list->jml->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_keu_pelatihan_list->total->Visible) { // total ?>
		<td data-name="total" <?php echo $real_keu_pelatihan_list->total->cellAttributes() ?>>
<span id="el<?php echo $real_keu_pelatihan_list->RowCount ?>_real_keu_pelatihan_total">
<span<?php echo $real_keu_pelatihan_list->total->viewAttributes() ?>><?php echo $real_keu_pelatihan_list->total->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_keu_pelatihan_list->ket->Visible) { // ket ?>
		<td data-name="ket" <?php echo $real_keu_pelatihan_list->ket->cellAttributes() ?>>
<span id="el<?php echo $real_keu_pelatihan_list->RowCount ?>_real_keu_pelatihan_ket">
<span<?php echo $real_keu_pelatihan_list->ket->viewAttributes() ?>><?php echo $real_keu_pelatihan_list->ket->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_keu_pelatihan_list->bln->Visible) { // bln ?>
		<td data-name="bln" <?php echo $real_keu_pelatihan_list->bln->cellAttributes() ?>>
<span id="el<?php echo $real_keu_pelatihan_list->RowCount ?>_real_keu_pelatihan_bln">
<span<?php echo $real_keu_pelatihan_list->bln->viewAttributes() ?>><?php echo $real_keu_pelatihan_list->bln->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_keu_pelatihan_list->thn->Visible) { // thn ?>
		<td data-name="thn" <?php echo $real_keu_pelatihan_list->thn->cellAttributes() ?>>
<span id="el<?php echo $real_keu_pelatihan_list->RowCount ?>_real_keu_pelatihan_thn">
<span<?php echo $real_keu_pelatihan_list->thn->viewAttributes() ?>><?php echo $real_keu_pelatihan_list->thn->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_keu_pelatihan_list->kdprop->Visible) { // kdprop ?>
		<td data-name="kdprop" <?php echo $real_keu_pelatihan_list->kdprop->cellAttributes() ?>>
<span id="el<?php echo $real_keu_pelatihan_list->RowCount ?>_real_keu_pelatihan_kdprop">
<span<?php echo $real_keu_pelatihan_list->kdprop->viewAttributes() ?>><?php echo $real_keu_pelatihan_list->kdprop->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($real_keu_pelatihan_list->jenispel->Visible) { // jenispel ?>
		<td data-name="jenispel" <?php echo $real_keu_pelatihan_list->jenispel->cellAttributes() ?>>
<span id="el<?php echo $real_keu_pelatihan_list->RowCount ?>_real_keu_pelatihan_jenispel">
<span<?php echo $real_keu_pelatihan_list->jenispel->viewAttributes() ?>><?php echo $real_keu_pelatihan_list->jenispel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$real_keu_pelatihan_list->ListOptions->render("body", "right", $real_keu_pelatihan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$real_keu_pelatihan_list->isGridAdd())
		$real_keu_pelatihan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$real_keu_pelatihan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($real_keu_pelatihan_list->Recordset)
	$real_keu_pelatihan_list->Recordset->Close();
?>
<?php if (!$real_keu_pelatihan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$real_keu_pelatihan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $real_keu_pelatihan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $real_keu_pelatihan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($real_keu_pelatihan_list->TotalRecords == 0 && !$real_keu_pelatihan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $real_keu_pelatihan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$real_keu_pelatihan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$real_keu_pelatihan_list->isExport()) { ?>
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
$real_keu_pelatihan_list->terminate();
?>