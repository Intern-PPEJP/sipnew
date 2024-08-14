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
$t_biointruktur_view = new t_biointruktur_view();

// Run the page
$t_biointruktur_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_biointruktur_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_biointruktur_view->isExport()) { ?>
<script>
var ft_biointrukturview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ft_biointrukturview = currentForm = new ew.Form("ft_biointrukturview", "view");
	loadjs.done("ft_biointrukturview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_biointruktur_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_biointruktur_view->ExportOptions->render("body") ?>
<?php $t_biointruktur_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_biointruktur_view->showPageHeader(); ?>
<?php
$t_biointruktur_view->showMessage();
?>
<form name="ft_biointrukturview" id="ft_biointrukturview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_biointruktur">
<input type="hidden" name="modal" value="<?php echo (int)$t_biointruktur_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_biointruktur_view->bioid->Visible) { // bioid ?>
	<tr id="r_bioid">
		<td class="<?php echo $t_biointruktur_view->TableLeftColumnClass ?>"><span id="elh_t_biointruktur_bioid"><?php echo $t_biointruktur_view->bioid->caption() ?></span></td>
		<td data-name="bioid" <?php echo $t_biointruktur_view->bioid->cellAttributes() ?>>
<span id="el_t_biointruktur_bioid">
<span<?php echo $t_biointruktur_view->bioid->viewAttributes() ?>><?php echo $t_biointruktur_view->bioid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_biointruktur_view->kdinstruktur->Visible) { // kdinstruktur ?>
	<tr id="r_kdinstruktur">
		<td class="<?php echo $t_biointruktur_view->TableLeftColumnClass ?>"><span id="elh_t_biointruktur_kdinstruktur"><?php echo $t_biointruktur_view->kdinstruktur->caption() ?></span></td>
		<td data-name="kdinstruktur" <?php echo $t_biointruktur_view->kdinstruktur->cellAttributes() ?>>
<span id="el_t_biointruktur_kdinstruktur">
<span<?php echo $t_biointruktur_view->kdinstruktur->viewAttributes() ?>><?php echo $t_biointruktur_view->kdinstruktur->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_biointruktur_view->revisi->Visible) { // revisi ?>
	<tr id="r_revisi">
		<td class="<?php echo $t_biointruktur_view->TableLeftColumnClass ?>"><span id="elh_t_biointruktur_revisi"><?php echo $t_biointruktur_view->revisi->caption() ?></span></td>
		<td data-name="revisi" <?php echo $t_biointruktur_view->revisi->cellAttributes() ?>>
<span id="el_t_biointruktur_revisi">
<span<?php echo $t_biointruktur_view->revisi->viewAttributes() ?>><?php echo $t_biointruktur_view->revisi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_biointruktur_view->tglterbit->Visible) { // tglterbit ?>
	<tr id="r_tglterbit">
		<td class="<?php echo $t_biointruktur_view->TableLeftColumnClass ?>"><span id="elh_t_biointruktur_tglterbit"><?php echo $t_biointruktur_view->tglterbit->caption() ?></span></td>
		<td data-name="tglterbit" <?php echo $t_biointruktur_view->tglterbit->cellAttributes() ?>>
<span id="el_t_biointruktur_tglterbit">
<span<?php echo $t_biointruktur_view->tglterbit->viewAttributes() ?>><?php echo $t_biointruktur_view->tglterbit->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_biointruktur_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $t_biointruktur_view->TableLeftColumnClass ?>"><span id="elh_t_biointruktur_nama"><?php echo $t_biointruktur_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $t_biointruktur_view->nama->cellAttributes() ?>>
<span id="el_t_biointruktur_nama">
<span<?php echo $t_biointruktur_view->nama->viewAttributes() ?>><?php echo $t_biointruktur_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_biointruktur_view->komp_materi->Visible) { // komp_materi ?>
	<tr id="r_komp_materi">
		<td class="<?php echo $t_biointruktur_view->TableLeftColumnClass ?>"><span id="elh_t_biointruktur_komp_materi"><?php echo $t_biointruktur_view->komp_materi->caption() ?></span></td>
		<td data-name="komp_materi" <?php echo $t_biointruktur_view->komp_materi->cellAttributes() ?>>
<span id="el_t_biointruktur_komp_materi">
<span<?php echo $t_biointruktur_view->komp_materi->viewAttributes() ?>><?php echo $t_biointruktur_view->komp_materi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_biointruktur_view->tmplahir->Visible) { // tmplahir ?>
	<tr id="r_tmplahir">
		<td class="<?php echo $t_biointruktur_view->TableLeftColumnClass ?>"><span id="elh_t_biointruktur_tmplahir"><?php echo $t_biointruktur_view->tmplahir->caption() ?></span></td>
		<td data-name="tmplahir" <?php echo $t_biointruktur_view->tmplahir->cellAttributes() ?>>
<span id="el_t_biointruktur_tmplahir">
<span<?php echo $t_biointruktur_view->tmplahir->viewAttributes() ?>><?php echo $t_biointruktur_view->tmplahir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_biointruktur_view->tgllahir->Visible) { // tgllahir ?>
	<tr id="r_tgllahir">
		<td class="<?php echo $t_biointruktur_view->TableLeftColumnClass ?>"><span id="elh_t_biointruktur_tgllahir"><?php echo $t_biointruktur_view->tgllahir->caption() ?></span></td>
		<td data-name="tgllahir" <?php echo $t_biointruktur_view->tgllahir->cellAttributes() ?>>
<span id="el_t_biointruktur_tgllahir">
<span<?php echo $t_biointruktur_view->tgllahir->viewAttributes() ?>><?php echo $t_biointruktur_view->tgllahir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_biointruktur_view->agama->Visible) { // agama ?>
	<tr id="r_agama">
		<td class="<?php echo $t_biointruktur_view->TableLeftColumnClass ?>"><span id="elh_t_biointruktur_agama"><?php echo $t_biointruktur_view->agama->caption() ?></span></td>
		<td data-name="agama" <?php echo $t_biointruktur_view->agama->cellAttributes() ?>>
<span id="el_t_biointruktur_agama">
<span<?php echo $t_biointruktur_view->agama->viewAttributes() ?>><?php echo $t_biointruktur_view->agama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_biointruktur_view->kategori->Visible) { // kategori ?>
	<tr id="r_kategori">
		<td class="<?php echo $t_biointruktur_view->TableLeftColumnClass ?>"><span id="elh_t_biointruktur_kategori"><?php echo $t_biointruktur_view->kategori->caption() ?></span></td>
		<td data-name="kategori" <?php echo $t_biointruktur_view->kategori->cellAttributes() ?>>
<span id="el_t_biointruktur_kategori">
<span<?php echo $t_biointruktur_view->kategori->viewAttributes() ?>><?php echo $t_biointruktur_view->kategori->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_biointruktur_view->instansi->Visible) { // instansi ?>
	<tr id="r_instansi">
		<td class="<?php echo $t_biointruktur_view->TableLeftColumnClass ?>"><span id="elh_t_biointruktur_instansi"><?php echo $t_biointruktur_view->instansi->caption() ?></span></td>
		<td data-name="instansi" <?php echo $t_biointruktur_view->instansi->cellAttributes() ?>>
<span id="el_t_biointruktur_instansi">
<span<?php echo $t_biointruktur_view->instansi->viewAttributes() ?>><?php echo $t_biointruktur_view->instansi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_biointruktur_view->pekerjaan->Visible) { // pekerjaan ?>
	<tr id="r_pekerjaan">
		<td class="<?php echo $t_biointruktur_view->TableLeftColumnClass ?>"><span id="elh_t_biointruktur_pekerjaan"><?php echo $t_biointruktur_view->pekerjaan->caption() ?></span></td>
		<td data-name="pekerjaan" <?php echo $t_biointruktur_view->pekerjaan->cellAttributes() ?>>
<span id="el_t_biointruktur_pekerjaan">
<span<?php echo $t_biointruktur_view->pekerjaan->viewAttributes() ?>><?php echo $t_biointruktur_view->pekerjaan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_biointruktur_view->alamatkantor->Visible) { // alamatkantor ?>
	<tr id="r_alamatkantor">
		<td class="<?php echo $t_biointruktur_view->TableLeftColumnClass ?>"><span id="elh_t_biointruktur_alamatkantor"><?php echo $t_biointruktur_view->alamatkantor->caption() ?></span></td>
		<td data-name="alamatkantor" <?php echo $t_biointruktur_view->alamatkantor->cellAttributes() ?>>
<span id="el_t_biointruktur_alamatkantor">
<span<?php echo $t_biointruktur_view->alamatkantor->viewAttributes() ?>><?php echo $t_biointruktur_view->alamatkantor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_biointruktur_view->alamatrumah->Visible) { // alamatrumah ?>
	<tr id="r_alamatrumah">
		<td class="<?php echo $t_biointruktur_view->TableLeftColumnClass ?>"><span id="elh_t_biointruktur_alamatrumah"><?php echo $t_biointruktur_view->alamatrumah->caption() ?></span></td>
		<td data-name="alamatrumah" <?php echo $t_biointruktur_view->alamatrumah->cellAttributes() ?>>
<span id="el_t_biointruktur_alamatrumah">
<span<?php echo $t_biointruktur_view->alamatrumah->viewAttributes() ?>><?php echo $t_biointruktur_view->alamatrumah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_biointruktur_view->telepon->Visible) { // telepon ?>
	<tr id="r_telepon">
		<td class="<?php echo $t_biointruktur_view->TableLeftColumnClass ?>"><span id="elh_t_biointruktur_telepon"><?php echo $t_biointruktur_view->telepon->caption() ?></span></td>
		<td data-name="telepon" <?php echo $t_biointruktur_view->telepon->cellAttributes() ?>>
<span id="el_t_biointruktur_telepon">
<span<?php echo $t_biointruktur_view->telepon->viewAttributes() ?>><?php echo $t_biointruktur_view->telepon->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_biointruktur_view->hp->Visible) { // hp ?>
	<tr id="r_hp">
		<td class="<?php echo $t_biointruktur_view->TableLeftColumnClass ?>"><span id="elh_t_biointruktur_hp"><?php echo $t_biointruktur_view->hp->caption() ?></span></td>
		<td data-name="hp" <?php echo $t_biointruktur_view->hp->cellAttributes() ?>>
<span id="el_t_biointruktur_hp">
<span<?php echo $t_biointruktur_view->hp->viewAttributes() ?>><?php echo $t_biointruktur_view->hp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_biointruktur_view->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $t_biointruktur_view->TableLeftColumnClass ?>"><span id="elh_t_biointruktur__email"><?php echo $t_biointruktur_view->_email->caption() ?></span></td>
		<td data-name="_email" <?php echo $t_biointruktur_view->_email->cellAttributes() ?>>
<span id="el_t_biointruktur__email">
<span<?php echo $t_biointruktur_view->_email->viewAttributes() ?>><?php echo $t_biointruktur_view->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_biointruktur_view->fax->Visible) { // fax ?>
	<tr id="r_fax">
		<td class="<?php echo $t_biointruktur_view->TableLeftColumnClass ?>"><span id="elh_t_biointruktur_fax"><?php echo $t_biointruktur_view->fax->caption() ?></span></td>
		<td data-name="fax" <?php echo $t_biointruktur_view->fax->cellAttributes() ?>>
<span id="el_t_biointruktur_fax">
<span<?php echo $t_biointruktur_view->fax->viewAttributes() ?>><?php echo $t_biointruktur_view->fax->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($t_biointruktur->getCurrentDetailTable() != "") { ?>
<?php
	$t_biointruktur_view->DetailPages->ValidKeys = explode(",", $t_biointruktur->getCurrentDetailTable());
	$firstActiveDetailTable = $t_biointruktur_view->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="t_biointruktur_view_details"><!-- tabs -->
	<ul class="<?php echo $t_biointruktur_view->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("t_rwpendd", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_rwpendd->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_rwpendd") {
			$firstActiveDetailTable = "t_rwpendd";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $t_biointruktur_view->DetailPages->pageStyle("t_rwpendd") ?>" href="#tab_t_rwpendd" data-toggle="tab"><?php echo $Language->tablePhrase("t_rwpendd", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $t_biointruktur_view->t_rwpendd_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
<?php
	if (in_array("t_rwpekerjaan", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_rwpekerjaan->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_rwpekerjaan") {
			$firstActiveDetailTable = "t_rwpekerjaan";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $t_biointruktur_view->DetailPages->pageStyle("t_rwpekerjaan") ?>" href="#tab_t_rwpekerjaan" data-toggle="tab"><?php echo $Language->tablePhrase("t_rwpekerjaan", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $t_biointruktur_view->t_rwpekerjaan_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
<?php
	if (in_array("t_rwtraining", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_rwtraining->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_rwtraining") {
			$firstActiveDetailTable = "t_rwtraining";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $t_biointruktur_view->DetailPages->pageStyle("t_rwtraining") ?>" href="#tab_t_rwtraining" data-toggle="tab"><?php echo $Language->tablePhrase("t_rwtraining", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $t_biointruktur_view->t_rwtraining_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
<?php
	if (in_array("t_faskur", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_faskur->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_faskur") {
			$firstActiveDetailTable = "t_faskur";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $t_biointruktur_view->DetailPages->pageStyle("t_faskur") ?>" href="#tab_t_faskur" data-toggle="tab"><?php echo $Language->tablePhrase("t_faskur", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $t_biointruktur_view->t_faskur_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
<?php
	if (in_array("cv_rwipelatihaninstruktur", explode(",", $t_biointruktur->getCurrentDetailTable())) && $cv_rwipelatihaninstruktur->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "cv_rwipelatihaninstruktur") {
			$firstActiveDetailTable = "cv_rwipelatihaninstruktur";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $t_biointruktur_view->DetailPages->pageStyle("cv_rwipelatihaninstruktur") ?>" href="#tab_cv_rwipelatihaninstruktur" data-toggle="tab"><?php echo $Language->tablePhrase("cv_rwipelatihaninstruktur", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $t_biointruktur_view->cv_rwipelatihaninstruktur_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
<?php
	if (in_array("t_evaluasifas", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_evaluasifas->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_evaluasifas") {
			$firstActiveDetailTable = "t_evaluasifas";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $t_biointruktur_view->DetailPages->pageStyle("t_evaluasifas") ?>" href="#tab_t_evaluasifas" data-toggle="tab"><?php echo $Language->tablePhrase("t_evaluasifas", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $t_biointruktur_view->t_evaluasifas_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("t_rwpendd", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_rwpendd->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_rwpendd")
			$firstActiveDetailTable = "t_rwpendd";
?>
		<div class="tab-pane <?php echo $t_biointruktur_view->DetailPages->pageStyle("t_rwpendd") ?>" id="tab_t_rwpendd"><!-- page* -->
<?php include_once "t_rwpenddgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("t_rwpekerjaan", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_rwpekerjaan->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_rwpekerjaan")
			$firstActiveDetailTable = "t_rwpekerjaan";
?>
		<div class="tab-pane <?php echo $t_biointruktur_view->DetailPages->pageStyle("t_rwpekerjaan") ?>" id="tab_t_rwpekerjaan"><!-- page* -->
<?php include_once "t_rwpekerjaangrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("t_rwtraining", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_rwtraining->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_rwtraining")
			$firstActiveDetailTable = "t_rwtraining";
?>
		<div class="tab-pane <?php echo $t_biointruktur_view->DetailPages->pageStyle("t_rwtraining") ?>" id="tab_t_rwtraining"><!-- page* -->
<?php include_once "t_rwtraininggrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("t_faskur", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_faskur->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_faskur")
			$firstActiveDetailTable = "t_faskur";
?>
		<div class="tab-pane <?php echo $t_biointruktur_view->DetailPages->pageStyle("t_faskur") ?>" id="tab_t_faskur"><!-- page* -->
<?php include_once "t_faskurgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("cv_rwipelatihaninstruktur", explode(",", $t_biointruktur->getCurrentDetailTable())) && $cv_rwipelatihaninstruktur->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "cv_rwipelatihaninstruktur")
			$firstActiveDetailTable = "cv_rwipelatihaninstruktur";
?>
		<div class="tab-pane <?php echo $t_biointruktur_view->DetailPages->pageStyle("cv_rwipelatihaninstruktur") ?>" id="tab_cv_rwipelatihaninstruktur"><!-- page* -->
<?php include_once "cv_rwipelatihaninstrukturgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("t_evaluasifas", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_evaluasifas->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_evaluasifas")
			$firstActiveDetailTable = "t_evaluasifas";
?>
		<div class="tab-pane <?php echo $t_biointruktur_view->DetailPages->pageStyle("t_evaluasifas") ?>" id="tab_t_evaluasifas"><!-- page* -->
<?php include_once "t_evaluasifasgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
</form>
<?php
$t_biointruktur_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_biointruktur_view->isExport()) { ?>
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
$t_biointruktur_view->terminate();
?>