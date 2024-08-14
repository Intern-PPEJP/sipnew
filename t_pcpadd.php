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
$t_pcp_add = new t_pcp_add();

// Run the page
$t_pcp_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pcp_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_pcpadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_pcpadd = currentForm = new ew.Form("ft_pcpadd", "add");

	// Validate form
	ft_pcpadd.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($t_pcp_add->nama_peserta->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_peserta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->nama_peserta->caption(), $t_pcp_add->nama_peserta->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->email_add->Required) { ?>
				elm = this.getElements("x" + infix + "_email_add");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->email_add->caption(), $t_pcp_add->email_add->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->handphone->Required) { ?>
				elm = this.getElements("x" + infix + "_handphone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->handphone->caption(), $t_pcp_add->handphone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->namap->Required) { ?>
				elm = this.getElements("x" + infix + "_namap");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->namap->caption(), $t_pcp_add->namap->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->tahun_berdiri->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun_berdiri");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->tahun_berdiri->caption(), $t_pcp_add->tahun_berdiri->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun_berdiri");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pcp_add->tahun_berdiri->errorMessage()) ?>");
			<?php if ($t_pcp_add->alamat->Required) { ?>
				elm = this.getElements("x" + infix + "_alamat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->alamat->caption(), $t_pcp_add->alamat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->alamat_prod->Required) { ?>
				elm = this.getElements("x" + infix + "_alamat_prod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->alamat_prod->caption(), $t_pcp_add->alamat_prod->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->kategori_produk->Required) { ?>
				elm = this.getElements("x" + infix + "_kategori_produk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->kategori_produk->caption(), $t_pcp_add->kategori_produk->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->kategori_produk2->Required) { ?>
				elm = this.getElements("x" + infix + "_kategori_produk2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->kategori_produk2->caption(), $t_pcp_add->kategori_produk2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->kategori_produk3->Required) { ?>
				elm = this.getElements("x" + infix + "_kategori_produk3");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->kategori_produk3->caption(), $t_pcp_add->kategori_produk3->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->produk->Required) { ?>
				elm = this.getElements("x" + infix + "_produk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->produk->caption(), $t_pcp_add->produk->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->merek_dagang->Required) { ?>
				elm = this.getElements("x" + infix + "_merek_dagang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->merek_dagang->caption(), $t_pcp_add->merek_dagang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->jenis_perusahaan->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis_perusahaan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->jenis_perusahaan->caption(), $t_pcp_add->jenis_perusahaan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->kapasitas_produksi->Required) { ?>
				elm = this.getElements("x" + infix + "_kapasitas_produksi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->kapasitas_produksi->caption(), $t_pcp_add->kapasitas_produksi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->omset->Required) { ?>
				elm = this.getElements("x" + infix + "_omset");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->omset->caption(), $t_pcp_add->omset->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->website->Required) { ?>
				elm = this.getElements("x" + infix + "_website");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->website->caption(), $t_pcp_add->website->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->fb->Required) { ?>
				elm = this.getElements("x" + infix + "_fb");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->fb->caption(), $t_pcp_add->fb->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->ig->Required) { ?>
				elm = this.getElements("x" + infix + "_ig");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->ig->caption(), $t_pcp_add->ig->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->sosmed_lain->Required) { ?>
				elm = this.getElements("x" + infix + "_sosmed_lain");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->sosmed_lain->caption(), $t_pcp_add->sosmed_lain->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->jml_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_jml_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->jml_pegawai->caption(), $t_pcp_add->jml_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->jml_pegawai2->Required) { ?>
				elm = this.getElements("x" + infix + "_jml_pegawai2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->jml_pegawai2->caption(), $t_pcp_add->jml_pegawai2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->jml_pegawai_tidaktetap->Required) { ?>
				elm = this.getElements("x" + infix + "_jml_pegawai_tidaktetap");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->jml_pegawai_tidaktetap->caption(), $t_pcp_add->jml_pegawai_tidaktetap->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->legalitas->Required) { ?>
				elm = this.getElements("x" + infix + "_legalitas[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->legalitas->caption(), $t_pcp_add->legalitas->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->legalitas_lain->Required) { ?>
				elm = this.getElements("x" + infix + "_legalitas_lain");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->legalitas_lain->caption(), $t_pcp_add->legalitas_lain->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->f_npwp->Required) { ?>
				felm = this.getElements("x" + infix + "_f_npwp");
				elm = this.getElements("fn_x" + infix + "_f_npwp");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->f_npwp->caption(), $t_pcp_add->f_npwp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->f_nib->Required) { ?>
				felm = this.getElements("x" + infix + "_f_nib");
				elm = this.getElements("fn_x" + infix + "_f_nib");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->f_nib->caption(), $t_pcp_add->f_nib->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->f_siup->Required) { ?>
				felm = this.getElements("x" + infix + "_f_siup");
				elm = this.getElements("fn_x" + infix + "_f_siup");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->f_siup->caption(), $t_pcp_add->f_siup->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->f_tdp->Required) { ?>
				felm = this.getElements("x" + infix + "_f_tdp");
				elm = this.getElements("fn_x" + infix + "_f_tdp");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->f_tdp->caption(), $t_pcp_add->f_tdp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->f_lain->Required) { ?>
				felm = this.getElements("x" + infix + "_f_lain");
				elm = this.getElements("fn_x" + infix + "_f_lain");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->f_lain->caption(), $t_pcp_add->f_lain->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->sertifikat->Required) { ?>
				elm = this.getElements("x" + infix + "_sertifikat[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->sertifikat->caption(), $t_pcp_add->sertifikat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->sertifikat_lain->Required) { ?>
				elm = this.getElements("x" + infix + "_sertifikat_lain");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->sertifikat_lain->caption(), $t_pcp_add->sertifikat_lain->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->f_sertifikat->Required) { ?>
				felm = this.getElements("x" + infix + "_f_sertifikat");
				elm = this.getElements("fn_x" + infix + "_f_sertifikat");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->f_sertifikat->caption(), $t_pcp_add->f_sertifikat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->alat_promosi->Required) { ?>
				elm = this.getElements("x" + infix + "_alat_promosi[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->alat_promosi->caption(), $t_pcp_add->alat_promosi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->promosi_lain->Required) { ?>
				elm = this.getElements("x" + infix + "_promosi_lain");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->promosi_lain->caption(), $t_pcp_add->promosi_lain->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->f_kartunama->Required) { ?>
				felm = this.getElements("x" + infix + "_f_kartunama");
				elm = this.getElements("fn_x" + infix + "_f_kartunama");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->f_kartunama->caption(), $t_pcp_add->f_kartunama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->f_brosur->Required) { ?>
				felm = this.getElements("x" + infix + "_f_brosur");
				elm = this.getElements("fn_x" + infix + "_f_brosur");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->f_brosur->caption(), $t_pcp_add->f_brosur->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->f_katalog->Required) { ?>
				felm = this.getElements("x" + infix + "_f_katalog");
				elm = this.getElements("fn_x" + infix + "_f_katalog");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->f_katalog->caption(), $t_pcp_add->f_katalog->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->f_profile->Required) { ?>
				felm = this.getElements("x" + infix + "_f_profile");
				elm = this.getElements("fn_x" + infix + "_f_profile");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->f_profile->caption(), $t_pcp_add->f_profile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pcp_add->tahun_ecp->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun_ecp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pcp_add->tahun_ecp->caption(), $t_pcp_add->tahun_ecp->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun_ecp");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pcp_add->tahun_ecp->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	ft_pcpadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_pcpadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Multi-Page
	ft_pcpadd.multiPage = new ew.MultiPage("ft_pcpadd");

	// Dynamic selection lists
	ft_pcpadd.lists["x_namap"] = <?php echo $t_pcp_add->namap->Lookup->toClientList($t_pcp_add) ?>;
	ft_pcpadd.lists["x_namap"].options = <?php echo JsonEncode($t_pcp_add->namap->lookupOptions()) ?>;
	ft_pcpadd.autoSuggests["x_namap"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pcpadd.lists["x_kategori_produk"] = <?php echo $t_pcp_add->kategori_produk->Lookup->toClientList($t_pcp_add) ?>;
	ft_pcpadd.lists["x_kategori_produk"].options = <?php echo JsonEncode($t_pcp_add->kategori_produk->lookupOptions()) ?>;
	ft_pcpadd.lists["x_kategori_produk2"] = <?php echo $t_pcp_add->kategori_produk2->Lookup->toClientList($t_pcp_add) ?>;
	ft_pcpadd.lists["x_kategori_produk2"].options = <?php echo JsonEncode($t_pcp_add->kategori_produk2->lookupOptions()) ?>;
	ft_pcpadd.lists["x_kategori_produk3"] = <?php echo $t_pcp_add->kategori_produk3->Lookup->toClientList($t_pcp_add) ?>;
	ft_pcpadd.lists["x_kategori_produk3"].options = <?php echo JsonEncode($t_pcp_add->kategori_produk3->lookupOptions()) ?>;
	ft_pcpadd.lists["x_jml_pegawai"] = <?php echo $t_pcp_add->jml_pegawai->Lookup->toClientList($t_pcp_add) ?>;
	ft_pcpadd.lists["x_jml_pegawai"].options = <?php echo JsonEncode($t_pcp_add->jml_pegawai->options(FALSE, TRUE)) ?>;
	ft_pcpadd.lists["x_legalitas[]"] = <?php echo $t_pcp_add->legalitas->Lookup->toClientList($t_pcp_add) ?>;
	ft_pcpadd.lists["x_legalitas[]"].options = <?php echo JsonEncode($t_pcp_add->legalitas->options(FALSE, TRUE)) ?>;
	ft_pcpadd.lists["x_sertifikat[]"] = <?php echo $t_pcp_add->sertifikat->Lookup->toClientList($t_pcp_add) ?>;
	ft_pcpadd.lists["x_sertifikat[]"].options = <?php echo JsonEncode($t_pcp_add->sertifikat->options(FALSE, TRUE)) ?>;
	ft_pcpadd.lists["x_alat_promosi[]"] = <?php echo $t_pcp_add->alat_promosi->Lookup->toClientList($t_pcp_add) ?>;
	ft_pcpadd.lists["x_alat_promosi[]"].options = <?php echo JsonEncode($t_pcp_add->alat_promosi->options(FALSE, TRUE)) ?>;
	loadjs.done("ft_pcpadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_pcp_add->showPageHeader(); ?>
<?php
$t_pcp_add->showMessage();
?>
<form name="ft_pcpadd" id="ft_pcpadd" class="<?php echo $t_pcp_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_pcp">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_pcp_add->IsModal ?>">
<?php if ($t_pcp->getCurrentMasterTable() == "excp") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="excp">
<input type="hidden" name="fk_rkid" value="<?php echo HtmlEncode($t_pcp_add->rkid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-multi-page"><!-- multi-page -->
<div class="ew-nav-tabs" id="t_pcp_add"><!-- multi-page tabs -->
	<ul class="<?php echo $t_pcp_add->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $t_pcp_add->MultiPages->pageStyle(1) ?>" href="#tab_t_pcp1" data-toggle="tab"><?php echo $t_pcp->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $t_pcp_add->MultiPages->pageStyle(2) ?>" href="#tab_t_pcp2" data-toggle="tab"><?php echo $t_pcp->pageCaption(2) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $t_pcp_add->MultiPages->pageStyle(3) ?>" href="#tab_t_pcp3" data-toggle="tab"><?php echo $t_pcp->pageCaption(3) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $t_pcp_add->MultiPages->pageStyle(4) ?>" href="#tab_t_pcp4" data-toggle="tab"><?php echo $t_pcp->pageCaption(4) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $t_pcp_add->MultiPages->pageStyle(5) ?>" href="#tab_t_pcp5" data-toggle="tab"><?php echo $t_pcp->pageCaption(5) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page tabs .tab-content -->
		<div class="tab-pane<?php echo $t_pcp_add->MultiPages->pageStyle(1) ?>" id="tab_t_pcp1"><!-- multi-page .tab-pane -->
<div class="ew-add-div"><!-- page* -->
<?php if ($t_pcp_add->nama_peserta->Visible) { // nama_peserta ?>
	<div id="r_nama_peserta" class="form-group row">
		<label id="elh_t_pcp_nama_peserta" for="x_nama_peserta" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->nama_peserta->caption() ?><?php echo $t_pcp_add->nama_peserta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->nama_peserta->cellAttributes() ?>>
<span id="el_t_pcp_nama_peserta">
<input type="text" data-table="t_pcp" data-field="x_nama_peserta" data-page="1" name="x_nama_peserta" id="x_nama_peserta" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_add->nama_peserta->getPlaceHolder()) ?>" value="<?php echo $t_pcp_add->nama_peserta->EditValue ?>"<?php echo $t_pcp_add->nama_peserta->editAttributes() ?>>
</span>
<?php echo $t_pcp_add->nama_peserta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->email_add->Visible) { // email_add ?>
	<div id="r_email_add" class="form-group row">
		<label id="elh_t_pcp_email_add" for="x_email_add" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->email_add->caption() ?><?php echo $t_pcp_add->email_add->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->email_add->cellAttributes() ?>>
<span id="el_t_pcp_email_add">
<input type="text" data-table="t_pcp" data-field="x_email_add" data-page="1" name="x_email_add" id="x_email_add" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_add->email_add->getPlaceHolder()) ?>" value="<?php echo $t_pcp_add->email_add->EditValue ?>"<?php echo $t_pcp_add->email_add->editAttributes() ?>>
</span>
<?php echo $t_pcp_add->email_add->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->handphone->Visible) { // handphone ?>
	<div id="r_handphone" class="form-group row">
		<label id="elh_t_pcp_handphone" for="x_handphone" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->handphone->caption() ?><?php echo $t_pcp_add->handphone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->handphone->cellAttributes() ?>>
<span id="el_t_pcp_handphone">
<input type="text" data-table="t_pcp" data-field="x_handphone" data-page="1" name="x_handphone" id="x_handphone" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_pcp_add->handphone->getPlaceHolder()) ?>" value="<?php echo $t_pcp_add->handphone->EditValue ?>"<?php echo $t_pcp_add->handphone->editAttributes() ?>>
</span>
<?php echo $t_pcp_add->handphone->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $t_pcp_add->MultiPages->pageStyle(2) ?>" id="tab_t_pcp2"><!-- multi-page .tab-pane -->
<div class="ew-add-div"><!-- page* -->
<?php if ($t_pcp_add->namap->Visible) { // namap ?>
	<div id="r_namap" class="form-group row">
		<label id="elh_t_pcp_namap" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->namap->caption() ?><?php echo $t_pcp_add->namap->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->namap->cellAttributes() ?>>
<span id="el_t_pcp_namap">
<?php
$onchange = $t_pcp_add->namap->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pcp_add->namap->EditAttrs["onchange"] = "";
?>
<span id="as_x_namap">
	<input type="text" class="form-control" name="sv_x_namap" id="sv_x_namap" value="<?php echo RemoveHtml($t_pcp_add->namap->EditValue) ?>" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($t_pcp_add->namap->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pcp_add->namap->getPlaceHolder()) ?>"<?php echo $t_pcp_add->namap->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pcp" data-field="x_namap" data-page="2" data-value-separator="<?php echo $t_pcp_add->namap->displayValueSeparatorAttribute() ?>" name="x_namap" id="x_namap" value="<?php echo HtmlEncode($t_pcp_add->namap->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pcpadd"], function() {
	ft_pcpadd.createAutoSuggest({"id":"x_namap","forceSelect":false});
});
</script>
<?php echo $t_pcp_add->namap->Lookup->getParamTag($t_pcp_add, "p_x_namap") ?>
</span>
<?php echo $t_pcp_add->namap->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->tahun_berdiri->Visible) { // tahun_berdiri ?>
	<div id="r_tahun_berdiri" class="form-group row">
		<label id="elh_t_pcp_tahun_berdiri" for="x_tahun_berdiri" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->tahun_berdiri->caption() ?><?php echo $t_pcp_add->tahun_berdiri->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->tahun_berdiri->cellAttributes() ?>>
<span id="el_t_pcp_tahun_berdiri">
<input type="text" data-table="t_pcp" data-field="x_tahun_berdiri" data-page="2" name="x_tahun_berdiri" id="x_tahun_berdiri" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pcp_add->tahun_berdiri->getPlaceHolder()) ?>" value="<?php echo $t_pcp_add->tahun_berdiri->EditValue ?>"<?php echo $t_pcp_add->tahun_berdiri->editAttributes() ?>>
</span>
<?php echo $t_pcp_add->tahun_berdiri->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->alamat->Visible) { // alamat ?>
	<div id="r_alamat" class="form-group row">
		<label id="elh_t_pcp_alamat" for="x_alamat" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->alamat->caption() ?><?php echo $t_pcp_add->alamat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->alamat->cellAttributes() ?>>
<span id="el_t_pcp_alamat">
<textarea data-table="t_pcp" data-field="x_alamat" data-page="2" name="x_alamat" id="x_alamat" cols="10" rows="2" placeholder="<?php echo HtmlEncode($t_pcp_add->alamat->getPlaceHolder()) ?>"<?php echo $t_pcp_add->alamat->editAttributes() ?>><?php echo $t_pcp_add->alamat->EditValue ?></textarea>
</span>
<?php echo $t_pcp_add->alamat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->alamat_prod->Visible) { // alamat_prod ?>
	<div id="r_alamat_prod" class="form-group row">
		<label id="elh_t_pcp_alamat_prod" for="x_alamat_prod" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->alamat_prod->caption() ?><?php echo $t_pcp_add->alamat_prod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->alamat_prod->cellAttributes() ?>>
<span id="el_t_pcp_alamat_prod">
<textarea data-table="t_pcp" data-field="x_alamat_prod" data-page="2" name="x_alamat_prod" id="x_alamat_prod" cols="35" rows="2" placeholder="<?php echo HtmlEncode($t_pcp_add->alamat_prod->getPlaceHolder()) ?>"<?php echo $t_pcp_add->alamat_prod->editAttributes() ?>><?php echo $t_pcp_add->alamat_prod->EditValue ?></textarea>
</span>
<?php echo $t_pcp_add->alamat_prod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->kategori_produk->Visible) { // kategori_produk ?>
	<div id="r_kategori_produk" class="form-group row">
		<label id="elh_t_pcp_kategori_produk" for="x_kategori_produk" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->kategori_produk->caption() ?><?php echo $t_pcp_add->kategori_produk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->kategori_produk->cellAttributes() ?>>
<span id="el_t_pcp_kategori_produk">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pcp" data-field="x_kategori_produk" data-page="2" data-value-separator="<?php echo $t_pcp_add->kategori_produk->displayValueSeparatorAttribute() ?>" id="x_kategori_produk" name="x_kategori_produk"<?php echo $t_pcp_add->kategori_produk->editAttributes() ?>>
			<?php echo $t_pcp_add->kategori_produk->selectOptionListHtml("x_kategori_produk") ?>
		</select>
	<?php if (AllowAdd(CurrentProjectID() . "t_kat_produk") && !$t_pcp_add->kategori_produk->ReadOnly) { ?>
	<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_kategori_produk" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $t_pcp_add->kategori_produk->caption() ?>" data-title="<?php echo $t_pcp_add->kategori_produk->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_kategori_produk',url:'t_kat_produkaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button></div>
	<?php } ?>
</div>
<?php echo $t_pcp_add->kategori_produk->Lookup->getParamTag($t_pcp_add, "p_x_kategori_produk") ?>
</span>
<?php echo $t_pcp_add->kategori_produk->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->kategori_produk2->Visible) { // kategori_produk2 ?>
	<div id="r_kategori_produk2" class="form-group row">
		<label id="elh_t_pcp_kategori_produk2" for="x_kategori_produk2" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->kategori_produk2->caption() ?><?php echo $t_pcp_add->kategori_produk2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->kategori_produk2->cellAttributes() ?>>
<span id="el_t_pcp_kategori_produk2">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pcp" data-field="x_kategori_produk2" data-page="2" data-value-separator="<?php echo $t_pcp_add->kategori_produk2->displayValueSeparatorAttribute() ?>" id="x_kategori_produk2" name="x_kategori_produk2"<?php echo $t_pcp_add->kategori_produk2->editAttributes() ?>>
			<?php echo $t_pcp_add->kategori_produk2->selectOptionListHtml("x_kategori_produk2") ?>
		</select>
	<?php if (AllowAdd(CurrentProjectID() . "t_kat_produk") && !$t_pcp_add->kategori_produk2->ReadOnly) { ?>
	<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_kategori_produk2" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $t_pcp_add->kategori_produk2->caption() ?>" data-title="<?php echo $t_pcp_add->kategori_produk2->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_kategori_produk2',url:'t_kat_produkaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button></div>
	<?php } ?>
</div>
<?php echo $t_pcp_add->kategori_produk2->Lookup->getParamTag($t_pcp_add, "p_x_kategori_produk2") ?>
</span>
<?php echo $t_pcp_add->kategori_produk2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->kategori_produk3->Visible) { // kategori_produk3 ?>
	<div id="r_kategori_produk3" class="form-group row">
		<label id="elh_t_pcp_kategori_produk3" for="x_kategori_produk3" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->kategori_produk3->caption() ?><?php echo $t_pcp_add->kategori_produk3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->kategori_produk3->cellAttributes() ?>>
<span id="el_t_pcp_kategori_produk3">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pcp" data-field="x_kategori_produk3" data-page="2" data-value-separator="<?php echo $t_pcp_add->kategori_produk3->displayValueSeparatorAttribute() ?>" id="x_kategori_produk3" name="x_kategori_produk3"<?php echo $t_pcp_add->kategori_produk3->editAttributes() ?>>
			<?php echo $t_pcp_add->kategori_produk3->selectOptionListHtml("x_kategori_produk3") ?>
		</select>
	<?php if (AllowAdd(CurrentProjectID() . "t_kat_produk") && !$t_pcp_add->kategori_produk3->ReadOnly) { ?>
	<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_kategori_produk3" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $t_pcp_add->kategori_produk3->caption() ?>" data-title="<?php echo $t_pcp_add->kategori_produk3->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_kategori_produk3',url:'t_kat_produkaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button></div>
	<?php } ?>
</div>
<?php echo $t_pcp_add->kategori_produk3->Lookup->getParamTag($t_pcp_add, "p_x_kategori_produk3") ?>
</span>
<?php echo $t_pcp_add->kategori_produk3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->produk->Visible) { // produk ?>
	<div id="r_produk" class="form-group row">
		<label id="elh_t_pcp_produk" for="x_produk" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->produk->caption() ?><?php echo $t_pcp_add->produk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->produk->cellAttributes() ?>>
<span id="el_t_pcp_produk">
<input type="text" data-table="t_pcp" data-field="x_produk" data-page="2" name="x_produk" id="x_produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pcp_add->produk->getPlaceHolder()) ?>" value="<?php echo $t_pcp_add->produk->EditValue ?>"<?php echo $t_pcp_add->produk->editAttributes() ?>>
</span>
<?php echo $t_pcp_add->produk->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->merek_dagang->Visible) { // merek_dagang ?>
	<div id="r_merek_dagang" class="form-group row">
		<label id="elh_t_pcp_merek_dagang" for="x_merek_dagang" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->merek_dagang->caption() ?><?php echo $t_pcp_add->merek_dagang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->merek_dagang->cellAttributes() ?>>
<span id="el_t_pcp_merek_dagang">
<input type="text" data-table="t_pcp" data-field="x_merek_dagang" data-page="2" name="x_merek_dagang" id="x_merek_dagang" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_add->merek_dagang->getPlaceHolder()) ?>" value="<?php echo $t_pcp_add->merek_dagang->EditValue ?>"<?php echo $t_pcp_add->merek_dagang->editAttributes() ?>>
</span>
<?php echo $t_pcp_add->merek_dagang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->jenis_perusahaan->Visible) { // jenis_perusahaan ?>
	<div id="r_jenis_perusahaan" class="form-group row">
		<label id="elh_t_pcp_jenis_perusahaan" for="x_jenis_perusahaan" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->jenis_perusahaan->caption() ?><?php echo $t_pcp_add->jenis_perusahaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->jenis_perusahaan->cellAttributes() ?>>
<span id="el_t_pcp_jenis_perusahaan">
<input type="text" data-table="t_pcp" data-field="x_jenis_perusahaan" data-page="2" name="x_jenis_perusahaan" id="x_jenis_perusahaan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_pcp_add->jenis_perusahaan->getPlaceHolder()) ?>" value="<?php echo $t_pcp_add->jenis_perusahaan->EditValue ?>"<?php echo $t_pcp_add->jenis_perusahaan->editAttributes() ?>>
</span>
<?php echo $t_pcp_add->jenis_perusahaan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->kapasitas_produksi->Visible) { // kapasitas_produksi ?>
	<div id="r_kapasitas_produksi" class="form-group row">
		<label id="elh_t_pcp_kapasitas_produksi" for="x_kapasitas_produksi" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->kapasitas_produksi->caption() ?><?php echo $t_pcp_add->kapasitas_produksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->kapasitas_produksi->cellAttributes() ?>>
<span id="el_t_pcp_kapasitas_produksi">
<input type="text" data-table="t_pcp" data-field="x_kapasitas_produksi" data-page="2" name="x_kapasitas_produksi" id="x_kapasitas_produksi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pcp_add->kapasitas_produksi->getPlaceHolder()) ?>" value="<?php echo $t_pcp_add->kapasitas_produksi->EditValue ?>"<?php echo $t_pcp_add->kapasitas_produksi->editAttributes() ?>>
</span>
<?php echo $t_pcp_add->kapasitas_produksi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->omset->Visible) { // omset ?>
	<div id="r_omset" class="form-group row">
		<label id="elh_t_pcp_omset" for="x_omset" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->omset->caption() ?><?php echo $t_pcp_add->omset->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->omset->cellAttributes() ?>>
<span id="el_t_pcp_omset">
<input type="text" data-table="t_pcp" data-field="x_omset" data-page="2" name="x_omset" id="x_omset" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_add->omset->getPlaceHolder()) ?>" value="<?php echo $t_pcp_add->omset->EditValue ?>"<?php echo $t_pcp_add->omset->editAttributes() ?>>
</span>
<?php echo $t_pcp_add->omset->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->website->Visible) { // website ?>
	<div id="r_website" class="form-group row">
		<label id="elh_t_pcp_website" for="x_website" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->website->caption() ?><?php echo $t_pcp_add->website->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->website->cellAttributes() ?>>
<span id="el_t_pcp_website">
<input type="text" data-table="t_pcp" data-field="x_website" data-page="2" name="x_website" id="x_website" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_add->website->getPlaceHolder()) ?>" value="<?php echo $t_pcp_add->website->EditValue ?>"<?php echo $t_pcp_add->website->editAttributes() ?>>
</span>
<?php echo $t_pcp_add->website->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->fb->Visible) { // fb ?>
	<div id="r_fb" class="form-group row">
		<label id="elh_t_pcp_fb" for="x_fb" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->fb->caption() ?><?php echo $t_pcp_add->fb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->fb->cellAttributes() ?>>
<span id="el_t_pcp_fb">
<input type="text" data-table="t_pcp" data-field="x_fb" data-page="2" name="x_fb" id="x_fb" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_add->fb->getPlaceHolder()) ?>" value="<?php echo $t_pcp_add->fb->EditValue ?>"<?php echo $t_pcp_add->fb->editAttributes() ?>>
</span>
<?php echo $t_pcp_add->fb->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->ig->Visible) { // ig ?>
	<div id="r_ig" class="form-group row">
		<label id="elh_t_pcp_ig" for="x_ig" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->ig->caption() ?><?php echo $t_pcp_add->ig->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->ig->cellAttributes() ?>>
<span id="el_t_pcp_ig">
<input type="text" data-table="t_pcp" data-field="x_ig" data-page="2" name="x_ig" id="x_ig" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_pcp_add->ig->getPlaceHolder()) ?>" value="<?php echo $t_pcp_add->ig->EditValue ?>"<?php echo $t_pcp_add->ig->editAttributes() ?>>
</span>
<?php echo $t_pcp_add->ig->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->sosmed_lain->Visible) { // sosmed_lain ?>
	<div id="r_sosmed_lain" class="form-group row">
		<label id="elh_t_pcp_sosmed_lain" for="x_sosmed_lain" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->sosmed_lain->caption() ?><?php echo $t_pcp_add->sosmed_lain->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->sosmed_lain->cellAttributes() ?>>
<span id="el_t_pcp_sosmed_lain">
<input type="text" data-table="t_pcp" data-field="x_sosmed_lain" data-page="2" name="x_sosmed_lain" id="x_sosmed_lain" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_pcp_add->sosmed_lain->getPlaceHolder()) ?>" value="<?php echo $t_pcp_add->sosmed_lain->EditValue ?>"<?php echo $t_pcp_add->sosmed_lain->editAttributes() ?>>
</span>
<?php echo $t_pcp_add->sosmed_lain->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->jml_pegawai->Visible) { // jml_pegawai ?>
	<div id="r_jml_pegawai" class="form-group row">
		<label id="elh_t_pcp_jml_pegawai" for="x_jml_pegawai" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->jml_pegawai->caption() ?><?php echo $t_pcp_add->jml_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->jml_pegawai->cellAttributes() ?>>
<span id="el_t_pcp_jml_pegawai">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pcp" data-field="x_jml_pegawai" data-page="2" data-value-separator="<?php echo $t_pcp_add->jml_pegawai->displayValueSeparatorAttribute() ?>" id="x_jml_pegawai" name="x_jml_pegawai"<?php echo $t_pcp_add->jml_pegawai->editAttributes() ?>>
			<?php echo $t_pcp_add->jml_pegawai->selectOptionListHtml("x_jml_pegawai") ?>
		</select>
</div>
</span>
<?php echo $t_pcp_add->jml_pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->jml_pegawai2->Visible) { // jml_pegawai2 ?>
	<div id="r_jml_pegawai2" class="form-group row">
		<label id="elh_t_pcp_jml_pegawai2" for="x_jml_pegawai2" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->jml_pegawai2->caption() ?><?php echo $t_pcp_add->jml_pegawai2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->jml_pegawai2->cellAttributes() ?>>
<span id="el_t_pcp_jml_pegawai2">
<input type="text" data-table="t_pcp" data-field="x_jml_pegawai2" data-page="2" name="x_jml_pegawai2" id="x_jml_pegawai2" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($t_pcp_add->jml_pegawai2->getPlaceHolder()) ?>" value="<?php echo $t_pcp_add->jml_pegawai2->EditValue ?>"<?php echo $t_pcp_add->jml_pegawai2->editAttributes() ?>>
</span>
<?php echo $t_pcp_add->jml_pegawai2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->jml_pegawai_tidaktetap->Visible) { // jml_pegawai_tidaktetap ?>
	<div id="r_jml_pegawai_tidaktetap" class="form-group row">
		<label id="elh_t_pcp_jml_pegawai_tidaktetap" for="x_jml_pegawai_tidaktetap" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->jml_pegawai_tidaktetap->caption() ?><?php echo $t_pcp_add->jml_pegawai_tidaktetap->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->jml_pegawai_tidaktetap->cellAttributes() ?>>
<span id="el_t_pcp_jml_pegawai_tidaktetap">
<input type="text" data-table="t_pcp" data-field="x_jml_pegawai_tidaktetap" data-page="2" name="x_jml_pegawai_tidaktetap" id="x_jml_pegawai_tidaktetap" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($t_pcp_add->jml_pegawai_tidaktetap->getPlaceHolder()) ?>" value="<?php echo $t_pcp_add->jml_pegawai_tidaktetap->EditValue ?>"<?php echo $t_pcp_add->jml_pegawai_tidaktetap->editAttributes() ?>>
</span>
<?php echo $t_pcp_add->jml_pegawai_tidaktetap->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $t_pcp_add->MultiPages->pageStyle(3) ?>" id="tab_t_pcp3"><!-- multi-page .tab-pane -->
<div class="ew-add-div"><!-- page* -->
<?php if ($t_pcp_add->legalitas->Visible) { // legalitas ?>
	<div id="r_legalitas" class="form-group row">
		<label id="elh_t_pcp_legalitas" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->legalitas->caption() ?><?php echo $t_pcp_add->legalitas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->legalitas->cellAttributes() ?>>
<span id="el_t_pcp_legalitas">
<div id="tp_x_legalitas" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="t_pcp" data-field="x_legalitas" data-page="3" data-value-separator="<?php echo $t_pcp_add->legalitas->displayValueSeparatorAttribute() ?>" name="x_legalitas[]" id="x_legalitas[]" value="{value}"<?php echo $t_pcp_add->legalitas->editAttributes() ?>></div>
<div id="dsl_x_legalitas" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_pcp_add->legalitas->checkBoxListHtml(FALSE, "x_legalitas[]", 3) ?>
</div></div>
</span>
<?php echo $t_pcp_add->legalitas->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->legalitas_lain->Visible) { // legalitas_lain ?>
	<div id="r_legalitas_lain" class="form-group row">
		<label id="elh_t_pcp_legalitas_lain" for="x_legalitas_lain" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->legalitas_lain->caption() ?><?php echo $t_pcp_add->legalitas_lain->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->legalitas_lain->cellAttributes() ?>>
<span id="el_t_pcp_legalitas_lain">
<input type="text" data-table="t_pcp" data-field="x_legalitas_lain" data-page="3" name="x_legalitas_lain" id="x_legalitas_lain" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pcp_add->legalitas_lain->getPlaceHolder()) ?>" value="<?php echo $t_pcp_add->legalitas_lain->EditValue ?>"<?php echo $t_pcp_add->legalitas_lain->editAttributes() ?>>
</span>
<?php echo $t_pcp_add->legalitas_lain->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->f_npwp->Visible) { // f_npwp ?>
	<div id="r_f_npwp" class="form-group row">
		<label id="elh_t_pcp_f_npwp" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->f_npwp->caption() ?><?php echo $t_pcp_add->f_npwp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->f_npwp->cellAttributes() ?>>
<span id="el_t_pcp_f_npwp">
<div id="fd_x_f_npwp">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pcp_add->f_npwp->title() ?>" data-table="t_pcp" data-field="x_f_npwp" data-page="3" name="x_f_npwp" id="x_f_npwp" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pcp_add->f_npwp->editAttributes() ?><?php if ($t_pcp_add->f_npwp->ReadOnly || $t_pcp_add->f_npwp->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_f_npwp"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_f_npwp" id= "fn_x_f_npwp" value="<?php echo $t_pcp_add->f_npwp->Upload->FileName ?>">
<input type="hidden" name="fa_x_f_npwp" id= "fa_x_f_npwp" value="0">
<input type="hidden" name="fs_x_f_npwp" id= "fs_x_f_npwp" value="255">
<input type="hidden" name="fx_x_f_npwp" id= "fx_x_f_npwp" value="<?php echo $t_pcp_add->f_npwp->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_f_npwp" id= "fm_x_f_npwp" value="<?php echo $t_pcp_add->f_npwp->UploadMaxFileSize ?>">
</div>
<table id="ft_x_f_npwp" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_pcp_add->f_npwp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->f_nib->Visible) { // f_nib ?>
	<div id="r_f_nib" class="form-group row">
		<label id="elh_t_pcp_f_nib" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->f_nib->caption() ?><?php echo $t_pcp_add->f_nib->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->f_nib->cellAttributes() ?>>
<span id="el_t_pcp_f_nib">
<div id="fd_x_f_nib">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pcp_add->f_nib->title() ?>" data-table="t_pcp" data-field="x_f_nib" data-page="3" name="x_f_nib" id="x_f_nib" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pcp_add->f_nib->editAttributes() ?><?php if ($t_pcp_add->f_nib->ReadOnly || $t_pcp_add->f_nib->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_f_nib"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_f_nib" id= "fn_x_f_nib" value="<?php echo $t_pcp_add->f_nib->Upload->FileName ?>">
<input type="hidden" name="fa_x_f_nib" id= "fa_x_f_nib" value="0">
<input type="hidden" name="fs_x_f_nib" id= "fs_x_f_nib" value="255">
<input type="hidden" name="fx_x_f_nib" id= "fx_x_f_nib" value="<?php echo $t_pcp_add->f_nib->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_f_nib" id= "fm_x_f_nib" value="<?php echo $t_pcp_add->f_nib->UploadMaxFileSize ?>">
</div>
<table id="ft_x_f_nib" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_pcp_add->f_nib->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->f_siup->Visible) { // f_siup ?>
	<div id="r_f_siup" class="form-group row">
		<label id="elh_t_pcp_f_siup" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->f_siup->caption() ?><?php echo $t_pcp_add->f_siup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->f_siup->cellAttributes() ?>>
<span id="el_t_pcp_f_siup">
<div id="fd_x_f_siup">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pcp_add->f_siup->title() ?>" data-table="t_pcp" data-field="x_f_siup" data-page="3" name="x_f_siup" id="x_f_siup" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pcp_add->f_siup->editAttributes() ?><?php if ($t_pcp_add->f_siup->ReadOnly || $t_pcp_add->f_siup->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_f_siup"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_f_siup" id= "fn_x_f_siup" value="<?php echo $t_pcp_add->f_siup->Upload->FileName ?>">
<input type="hidden" name="fa_x_f_siup" id= "fa_x_f_siup" value="0">
<input type="hidden" name="fs_x_f_siup" id= "fs_x_f_siup" value="255">
<input type="hidden" name="fx_x_f_siup" id= "fx_x_f_siup" value="<?php echo $t_pcp_add->f_siup->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_f_siup" id= "fm_x_f_siup" value="<?php echo $t_pcp_add->f_siup->UploadMaxFileSize ?>">
</div>
<table id="ft_x_f_siup" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_pcp_add->f_siup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->f_tdp->Visible) { // f_tdp ?>
	<div id="r_f_tdp" class="form-group row">
		<label id="elh_t_pcp_f_tdp" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->f_tdp->caption() ?><?php echo $t_pcp_add->f_tdp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->f_tdp->cellAttributes() ?>>
<span id="el_t_pcp_f_tdp">
<div id="fd_x_f_tdp">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pcp_add->f_tdp->title() ?>" data-table="t_pcp" data-field="x_f_tdp" data-page="3" name="x_f_tdp" id="x_f_tdp" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pcp_add->f_tdp->editAttributes() ?><?php if ($t_pcp_add->f_tdp->ReadOnly || $t_pcp_add->f_tdp->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_f_tdp"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_f_tdp" id= "fn_x_f_tdp" value="<?php echo $t_pcp_add->f_tdp->Upload->FileName ?>">
<input type="hidden" name="fa_x_f_tdp" id= "fa_x_f_tdp" value="0">
<input type="hidden" name="fs_x_f_tdp" id= "fs_x_f_tdp" value="255">
<input type="hidden" name="fx_x_f_tdp" id= "fx_x_f_tdp" value="<?php echo $t_pcp_add->f_tdp->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_f_tdp" id= "fm_x_f_tdp" value="<?php echo $t_pcp_add->f_tdp->UploadMaxFileSize ?>">
</div>
<table id="ft_x_f_tdp" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_pcp_add->f_tdp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->f_lain->Visible) { // f_lain ?>
	<div id="r_f_lain" class="form-group row">
		<label id="elh_t_pcp_f_lain" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->f_lain->caption() ?><?php echo $t_pcp_add->f_lain->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->f_lain->cellAttributes() ?>>
<span id="el_t_pcp_f_lain">
<div id="fd_x_f_lain">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pcp_add->f_lain->title() ?>" data-table="t_pcp" data-field="x_f_lain" data-page="3" name="x_f_lain" id="x_f_lain" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pcp_add->f_lain->editAttributes() ?><?php if ($t_pcp_add->f_lain->ReadOnly || $t_pcp_add->f_lain->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_f_lain"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_f_lain" id= "fn_x_f_lain" value="<?php echo $t_pcp_add->f_lain->Upload->FileName ?>">
<input type="hidden" name="fa_x_f_lain" id= "fa_x_f_lain" value="0">
<input type="hidden" name="fs_x_f_lain" id= "fs_x_f_lain" value="255">
<input type="hidden" name="fx_x_f_lain" id= "fx_x_f_lain" value="<?php echo $t_pcp_add->f_lain->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_f_lain" id= "fm_x_f_lain" value="<?php echo $t_pcp_add->f_lain->UploadMaxFileSize ?>">
</div>
<table id="ft_x_f_lain" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_pcp_add->f_lain->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $t_pcp_add->MultiPages->pageStyle(4) ?>" id="tab_t_pcp4"><!-- multi-page .tab-pane -->
<div class="ew-add-div"><!-- page* -->
<?php if ($t_pcp_add->sertifikat->Visible) { // sertifikat ?>
	<div id="r_sertifikat" class="form-group row">
		<label id="elh_t_pcp_sertifikat" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->sertifikat->caption() ?><?php echo $t_pcp_add->sertifikat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->sertifikat->cellAttributes() ?>>
<span id="el_t_pcp_sertifikat">
<div id="tp_x_sertifikat" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="t_pcp" data-field="x_sertifikat" data-page="4" data-value-separator="<?php echo $t_pcp_add->sertifikat->displayValueSeparatorAttribute() ?>" name="x_sertifikat[]" id="x_sertifikat[]" value="{value}"<?php echo $t_pcp_add->sertifikat->editAttributes() ?>></div>
<div id="dsl_x_sertifikat" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_pcp_add->sertifikat->checkBoxListHtml(FALSE, "x_sertifikat[]", 4) ?>
</div></div>
</span>
<?php echo $t_pcp_add->sertifikat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->sertifikat_lain->Visible) { // sertifikat_lain ?>
	<div id="r_sertifikat_lain" class="form-group row">
		<label id="elh_t_pcp_sertifikat_lain" for="x_sertifikat_lain" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->sertifikat_lain->caption() ?><?php echo $t_pcp_add->sertifikat_lain->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->sertifikat_lain->cellAttributes() ?>>
<span id="el_t_pcp_sertifikat_lain">
<input type="text" data-table="t_pcp" data-field="x_sertifikat_lain" data-page="4" name="x_sertifikat_lain" id="x_sertifikat_lain" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pcp_add->sertifikat_lain->getPlaceHolder()) ?>" value="<?php echo $t_pcp_add->sertifikat_lain->EditValue ?>"<?php echo $t_pcp_add->sertifikat_lain->editAttributes() ?>>
</span>
<?php echo $t_pcp_add->sertifikat_lain->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->f_sertifikat->Visible) { // f_sertifikat ?>
	<div id="r_f_sertifikat" class="form-group row">
		<label id="elh_t_pcp_f_sertifikat" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->f_sertifikat->caption() ?><?php echo $t_pcp_add->f_sertifikat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->f_sertifikat->cellAttributes() ?>>
<span id="el_t_pcp_f_sertifikat">
<div id="fd_x_f_sertifikat">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pcp_add->f_sertifikat->title() ?>" data-table="t_pcp" data-field="x_f_sertifikat" data-page="4" name="x_f_sertifikat" id="x_f_sertifikat" lang="<?php echo CurrentLanguageID() ?>" multiple="multiple"<?php echo $t_pcp_add->f_sertifikat->editAttributes() ?><?php if ($t_pcp_add->f_sertifikat->ReadOnly || $t_pcp_add->f_sertifikat->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_f_sertifikat"><?php echo $Language->phrase("ChooseFiles") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_f_sertifikat" id= "fn_x_f_sertifikat" value="<?php echo $t_pcp_add->f_sertifikat->Upload->FileName ?>">
<input type="hidden" name="fa_x_f_sertifikat" id= "fa_x_f_sertifikat" value="0">
<input type="hidden" name="fs_x_f_sertifikat" id= "fs_x_f_sertifikat" value="255">
<input type="hidden" name="fx_x_f_sertifikat" id= "fx_x_f_sertifikat" value="<?php echo $t_pcp_add->f_sertifikat->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_f_sertifikat" id= "fm_x_f_sertifikat" value="<?php echo $t_pcp_add->f_sertifikat->UploadMaxFileSize ?>">
<input type="hidden" name="fc_x_f_sertifikat" id= "fc_x_f_sertifikat" value="<?php echo $t_pcp_add->f_sertifikat->UploadMaxFileCount ?>">
</div>
<table id="ft_x_f_sertifikat" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_pcp_add->f_sertifikat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->alat_promosi->Visible) { // alat_promosi ?>
	<div id="r_alat_promosi" class="form-group row">
		<label id="elh_t_pcp_alat_promosi" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->alat_promosi->caption() ?><?php echo $t_pcp_add->alat_promosi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->alat_promosi->cellAttributes() ?>>
<span id="el_t_pcp_alat_promosi">
<div id="tp_x_alat_promosi" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="t_pcp" data-field="x_alat_promosi" data-page="4" data-value-separator="<?php echo $t_pcp_add->alat_promosi->displayValueSeparatorAttribute() ?>" name="x_alat_promosi[]" id="x_alat_promosi[]" value="{value}"<?php echo $t_pcp_add->alat_promosi->editAttributes() ?>></div>
<div id="dsl_x_alat_promosi" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_pcp_add->alat_promosi->checkBoxListHtml(FALSE, "x_alat_promosi[]", 4) ?>
</div></div>
</span>
<?php echo $t_pcp_add->alat_promosi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->promosi_lain->Visible) { // promosi_lain ?>
	<div id="r_promosi_lain" class="form-group row">
		<label id="elh_t_pcp_promosi_lain" for="x_promosi_lain" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->promosi_lain->caption() ?><?php echo $t_pcp_add->promosi_lain->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->promosi_lain->cellAttributes() ?>>
<span id="el_t_pcp_promosi_lain">
<input type="text" data-table="t_pcp" data-field="x_promosi_lain" data-page="4" name="x_promosi_lain" id="x_promosi_lain" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pcp_add->promosi_lain->getPlaceHolder()) ?>" value="<?php echo $t_pcp_add->promosi_lain->EditValue ?>"<?php echo $t_pcp_add->promosi_lain->editAttributes() ?>>
</span>
<?php echo $t_pcp_add->promosi_lain->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->f_kartunama->Visible) { // f_kartunama ?>
	<div id="r_f_kartunama" class="form-group row">
		<label id="elh_t_pcp_f_kartunama" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->f_kartunama->caption() ?><?php echo $t_pcp_add->f_kartunama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->f_kartunama->cellAttributes() ?>>
<span id="el_t_pcp_f_kartunama">
<div id="fd_x_f_kartunama">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pcp_add->f_kartunama->title() ?>" data-table="t_pcp" data-field="x_f_kartunama" data-page="4" name="x_f_kartunama" id="x_f_kartunama" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pcp_add->f_kartunama->editAttributes() ?><?php if ($t_pcp_add->f_kartunama->ReadOnly || $t_pcp_add->f_kartunama->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_f_kartunama"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_f_kartunama" id= "fn_x_f_kartunama" value="<?php echo $t_pcp_add->f_kartunama->Upload->FileName ?>">
<input type="hidden" name="fa_x_f_kartunama" id= "fa_x_f_kartunama" value="0">
<input type="hidden" name="fs_x_f_kartunama" id= "fs_x_f_kartunama" value="255">
<input type="hidden" name="fx_x_f_kartunama" id= "fx_x_f_kartunama" value="<?php echo $t_pcp_add->f_kartunama->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_f_kartunama" id= "fm_x_f_kartunama" value="<?php echo $t_pcp_add->f_kartunama->UploadMaxFileSize ?>">
</div>
<table id="ft_x_f_kartunama" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_pcp_add->f_kartunama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->f_brosur->Visible) { // f_brosur ?>
	<div id="r_f_brosur" class="form-group row">
		<label id="elh_t_pcp_f_brosur" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->f_brosur->caption() ?><?php echo $t_pcp_add->f_brosur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->f_brosur->cellAttributes() ?>>
<span id="el_t_pcp_f_brosur">
<div id="fd_x_f_brosur">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pcp_add->f_brosur->title() ?>" data-table="t_pcp" data-field="x_f_brosur" data-page="4" name="x_f_brosur" id="x_f_brosur" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pcp_add->f_brosur->editAttributes() ?><?php if ($t_pcp_add->f_brosur->ReadOnly || $t_pcp_add->f_brosur->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_f_brosur"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_f_brosur" id= "fn_x_f_brosur" value="<?php echo $t_pcp_add->f_brosur->Upload->FileName ?>">
<input type="hidden" name="fa_x_f_brosur" id= "fa_x_f_brosur" value="0">
<input type="hidden" name="fs_x_f_brosur" id= "fs_x_f_brosur" value="255">
<input type="hidden" name="fx_x_f_brosur" id= "fx_x_f_brosur" value="<?php echo $t_pcp_add->f_brosur->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_f_brosur" id= "fm_x_f_brosur" value="<?php echo $t_pcp_add->f_brosur->UploadMaxFileSize ?>">
</div>
<table id="ft_x_f_brosur" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_pcp_add->f_brosur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->f_katalog->Visible) { // f_katalog ?>
	<div id="r_f_katalog" class="form-group row">
		<label id="elh_t_pcp_f_katalog" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->f_katalog->caption() ?><?php echo $t_pcp_add->f_katalog->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->f_katalog->cellAttributes() ?>>
<span id="el_t_pcp_f_katalog">
<div id="fd_x_f_katalog">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pcp_add->f_katalog->title() ?>" data-table="t_pcp" data-field="x_f_katalog" data-page="4" name="x_f_katalog" id="x_f_katalog" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pcp_add->f_katalog->editAttributes() ?><?php if ($t_pcp_add->f_katalog->ReadOnly || $t_pcp_add->f_katalog->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_f_katalog"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_f_katalog" id= "fn_x_f_katalog" value="<?php echo $t_pcp_add->f_katalog->Upload->FileName ?>">
<input type="hidden" name="fa_x_f_katalog" id= "fa_x_f_katalog" value="0">
<input type="hidden" name="fs_x_f_katalog" id= "fs_x_f_katalog" value="255">
<input type="hidden" name="fx_x_f_katalog" id= "fx_x_f_katalog" value="<?php echo $t_pcp_add->f_katalog->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_f_katalog" id= "fm_x_f_katalog" value="<?php echo $t_pcp_add->f_katalog->UploadMaxFileSize ?>">
</div>
<table id="ft_x_f_katalog" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_pcp_add->f_katalog->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pcp_add->f_profile->Visible) { // f_profile ?>
	<div id="r_f_profile" class="form-group row">
		<label id="elh_t_pcp_f_profile" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->f_profile->caption() ?><?php echo $t_pcp_add->f_profile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->f_profile->cellAttributes() ?>>
<span id="el_t_pcp_f_profile">
<div id="fd_x_f_profile">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pcp_add->f_profile->title() ?>" data-table="t_pcp" data-field="x_f_profile" data-page="4" name="x_f_profile" id="x_f_profile" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pcp_add->f_profile->editAttributes() ?><?php if ($t_pcp_add->f_profile->ReadOnly || $t_pcp_add->f_profile->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_f_profile"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_f_profile" id= "fn_x_f_profile" value="<?php echo $t_pcp_add->f_profile->Upload->FileName ?>">
<input type="hidden" name="fa_x_f_profile" id= "fa_x_f_profile" value="0">
<input type="hidden" name="fs_x_f_profile" id= "fs_x_f_profile" value="255">
<input type="hidden" name="fx_x_f_profile" id= "fx_x_f_profile" value="<?php echo $t_pcp_add->f_profile->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_f_profile" id= "fm_x_f_profile" value="<?php echo $t_pcp_add->f_profile->UploadMaxFileSize ?>">
</div>
<table id="ft_x_f_profile" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_pcp_add->f_profile->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $t_pcp_add->MultiPages->pageStyle(5) ?>" id="tab_t_pcp5"><!-- multi-page .tab-pane -->
<div class="ew-add-div"><!-- page* -->
<?php if ($t_pcp_add->tahun_ecp->Visible) { // tahun_ecp ?>
	<div id="r_tahun_ecp" class="form-group row">
		<label id="elh_t_pcp_tahun_ecp" for="x_tahun_ecp" class="<?php echo $t_pcp_add->LeftColumnClass ?>"><?php echo $t_pcp_add->tahun_ecp->caption() ?><?php echo $t_pcp_add->tahun_ecp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pcp_add->RightColumnClass ?>"><div <?php echo $t_pcp_add->tahun_ecp->cellAttributes() ?>>
<span id="el_t_pcp_tahun_ecp">
<input type="text" data-table="t_pcp" data-field="x_tahun_ecp" data-page="5" name="x_tahun_ecp" id="x_tahun_ecp" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($t_pcp_add->tahun_ecp->getPlaceHolder()) ?>" value="<?php echo $t_pcp_add->tahun_ecp->EditValue ?>"<?php echo $t_pcp_add->tahun_ecp->editAttributes() ?>>
</span>
<?php echo $t_pcp_add->tahun_ecp->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page tabs .tab-content -->
</div><!-- /multi-page tabs -->
</div><!-- /multi-page -->
	<?php if (strval($t_pcp_add->rkid->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_rkid" id="x_rkid" value="<?php echo HtmlEncode(strval($t_pcp_add->rkid->getSessionValue())) ?>">
	<?php } ?>
<?php
	if (in_array("t_ecp", explode(",", $t_pcp->getCurrentDetailTable())) && $t_ecp->DetailAdd) {
?>
<?php if ($t_pcp->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("t_ecp", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "t_ecpgrid.php" ?>
<?php } ?>
<?php if (!$t_pcp_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_pcp_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_pcp_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_pcp_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$(".main-sidebar").removeClass("layout-fixed"),$("body").addClass("sidebar-collapse"),$(".ew-detail-caption").hide(),$(".t_ecp").hide(),$("#r_tahun_ecp").hide(),$(".nav-link").click(function(){"#tab_t_pcp5"==$(this).attr("href")?($(".ew-detail-caption").show(),$(".t_ecp").show()):($(".ew-detail-caption").hide(),$(".t_ecp").hide())}),$("#r_legalitas_lain").hide(),$("#r_sertifikat_lain").hide(),$("#r_promosi_lain").hide(),$("input[name='x_legalitas[]']").click(function(){"LAIN"==this.value&&(this.checked?$(this).fields("legalitas_lain").visible(!0):($(this).fields("legalitas_lain").visible(!1),$(this).fields("legalitas_lain").value("")))}),$("input[name='x_sertifikat[]']").click(function(){"LAIN"==this.value&&(this.checked?$(this).fields("sertifikat_lain").visible(!0):($(this).fields("sertifikat_lain").visible(!1),$(this).fields("sertifikat_lain").value("")))}),$("input[name='x_alat_promosi[]']").click(function(){"LAIN"==this.value&&(this.checked?$(this).fields("promosi_lain").visible(!0):($(this).fields("promosi_lain").visible(!1),$(this).fields("promosi_lain").value("")))});
});
</script>
<?php include_once "footer.php"; ?>
<?php
$t_pcp_add->terminate();
?>