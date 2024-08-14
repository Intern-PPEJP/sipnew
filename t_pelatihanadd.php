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
$t_pelatihan_add = new t_pelatihan_add();

// Run the page
$t_pelatihan_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pelatihan_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_pelatihanadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_pelatihanadd = currentForm = new ew.Form("ft_pelatihanadd", "add");

	// Validate form
	ft_pelatihanadd.validate = function() {
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
			<?php if ($t_pelatihan_add->kdpelat->Required) { ?>
				elm = this.getElements("x" + infix + "_kdpelat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->kdpelat->caption(), $t_pelatihan_add->kdpelat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->kdjudul->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjudul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->kdjudul->caption(), $t_pelatihan_add->kdjudul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->kdkursil->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkursil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->kdkursil->caption(), $t_pelatihan_add->kdkursil->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->revisi->Required) { ?>
				elm = this.getElements("x" + infix + "_revisi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->revisi->caption(), $t_pelatihan_add->revisi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->tgl_terbit->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_terbit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->tgl_terbit->caption(), $t_pelatihan_add->tgl_terbit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_terbit");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_add->tgl_terbit->errorMessage()) ?>");
			<?php if ($t_pelatihan_add->pilihan_iso->Required) { ?>
				elm = this.getElements("x" + infix + "_pilihan_iso");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->pilihan_iso->caption(), $t_pelatihan_add->pilihan_iso->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->tawal->Required) { ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->tawal->caption(), $t_pelatihan_add->tawal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_add->tawal->errorMessage()) ?>");
			<?php if ($t_pelatihan_add->takhir->Required) { ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->takhir->caption(), $t_pelatihan_add->takhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_add->takhir->errorMessage()) ?>");
			<?php if ($t_pelatihan_add->kdprop->Required) { ?>
				elm = this.getElements("x" + infix + "_kdprop");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->kdprop->caption(), $t_pelatihan_add->kdprop->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->kdkota->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkota");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->kdkota->caption(), $t_pelatihan_add->kdkota->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->kdkec->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkec");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->kdkec->caption(), $t_pelatihan_add->kdkec->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->ketua->Required) { ?>
				elm = this.getElements("x" + infix + "_ketua");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->ketua->caption(), $t_pelatihan_add->ketua->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->sekretaris->Required) { ?>
				elm = this.getElements("x" + infix + "_sekretaris");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->sekretaris->caption(), $t_pelatihan_add->sekretaris->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->bendahara->Required) { ?>
				elm = this.getElements("x" + infix + "_bendahara");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->bendahara->caption(), $t_pelatihan_add->bendahara->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->anggota2->Required) { ?>
				elm = this.getElements("x" + infix + "_anggota2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->anggota2->caption(), $t_pelatihan_add->anggota2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->widyaiswara->Required) { ?>
				elm = this.getElements("x" + infix + "_widyaiswara");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->widyaiswara->caption(), $t_pelatihan_add->widyaiswara->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_widyaiswara");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_add->widyaiswara->errorMessage()) ?>");
			<?php if ($t_pelatihan_add->jenisevaluasi->Required) { ?>
				elm = this.getElements("x" + infix + "_jenisevaluasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->jenisevaluasi->caption(), $t_pelatihan_add->jenisevaluasi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jenisevaluasi");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_add->jenisevaluasi->errorMessage()) ?>");
			<?php if ($t_pelatihan_add->created_at->Required) { ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->created_at->caption(), $t_pelatihan_add->created_at->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->user_created_by->Required) { ?>
				elm = this.getElements("x" + infix + "_user_created_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->user_created_by->caption(), $t_pelatihan_add->user_created_by->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->jenispel->Required) { ?>
				elm = this.getElements("x" + infix + "_jenispel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->jenispel->caption(), $t_pelatihan_add->jenispel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->kdkategori->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkategori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->kdkategori->caption(), $t_pelatihan_add->kdkategori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->kerjasama->Required) { ?>
				elm = this.getElements("x" + infix + "_kerjasama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->kerjasama->caption(), $t_pelatihan_add->kerjasama->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kerjasama");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_add->kerjasama->errorMessage()) ?>");
			<?php if ($t_pelatihan_add->biaya->Required) { ?>
				elm = this.getElements("x" + infix + "_biaya");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->biaya->caption(), $t_pelatihan_add->biaya->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_biaya");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_add->biaya->errorMessage()) ?>");
			<?php if ($t_pelatihan_add->namaberkas->Required) { ?>
				felm = this.getElements("x" + infix + "_namaberkas");
				elm = this.getElements("fn_x" + infix + "_namaberkas");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->namaberkas->caption(), $t_pelatihan_add->namaberkas->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->statuspel->Required) { ?>
				elm = this.getElements("x" + infix + "_statuspel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->statuspel->caption(), $t_pelatihan_add->statuspel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->ket->Required) { ?>
				elm = this.getElements("x" + infix + "_ket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->ket->caption(), $t_pelatihan_add->ket->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->jpeserta->Required) { ?>
				elm = this.getElements("x" + infix + "_jpeserta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->jpeserta->caption(), $t_pelatihan_add->jpeserta->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jpeserta");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_add->jpeserta->errorMessage()) ?>");
			<?php if ($t_pelatihan_add->real_peserta->Required) { ?>
				elm = this.getElements("x" + infix + "_real_peserta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->real_peserta->caption(), $t_pelatihan_add->real_peserta->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_real_peserta");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_add->real_peserta->errorMessage()) ?>");
			<?php if ($t_pelatihan_add->independen->Required) { ?>
				elm = this.getElements("x" + infix + "_independen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->independen->caption(), $t_pelatihan_add->independen->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_independen");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_add->independen->errorMessage()) ?>");
			<?php if ($t_pelatihan_add->swasta_k->Required) { ?>
				elm = this.getElements("x" + infix + "_swasta_k");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->swasta_k->caption(), $t_pelatihan_add->swasta_k->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_swasta_k");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_add->swasta_k->errorMessage()) ?>");
			<?php if ($t_pelatihan_add->swasta_m->Required) { ?>
				elm = this.getElements("x" + infix + "_swasta_m");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->swasta_m->caption(), $t_pelatihan_add->swasta_m->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_swasta_m");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_add->swasta_m->errorMessage()) ?>");
			<?php if ($t_pelatihan_add->swasta_b->Required) { ?>
				elm = this.getElements("x" + infix + "_swasta_b");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->swasta_b->caption(), $t_pelatihan_add->swasta_b->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_swasta_b");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_add->swasta_b->errorMessage()) ?>");
			<?php if ($t_pelatihan_add->bumn->Required) { ?>
				elm = this.getElements("x" + infix + "_bumn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->bumn->caption(), $t_pelatihan_add->bumn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_bumn");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_add->bumn->errorMessage()) ?>");
			<?php if ($t_pelatihan_add->koperasi->Required) { ?>
				elm = this.getElements("x" + infix + "_koperasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->koperasi->caption(), $t_pelatihan_add->koperasi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_koperasi");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_add->koperasi->errorMessage()) ?>");
			<?php if ($t_pelatihan_add->pns->Required) { ?>
				elm = this.getElements("x" + infix + "_pns");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->pns->caption(), $t_pelatihan_add->pns->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pns");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_add->pns->errorMessage()) ?>");
			<?php if ($t_pelatihan_add->pt_dosen->Required) { ?>
				elm = this.getElements("x" + infix + "_pt_dosen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->pt_dosen->caption(), $t_pelatihan_add->pt_dosen->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pt_dosen");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_add->pt_dosen->errorMessage()) ?>");
			<?php if ($t_pelatihan_add->pt_mhs->Required) { ?>
				elm = this.getElements("x" + infix + "_pt_mhs");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->pt_mhs->caption(), $t_pelatihan_add->pt_mhs->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pt_mhs");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_add->pt_mhs->errorMessage()) ?>");
			<?php if ($t_pelatihan_add->jk_l->Required) { ?>
				elm = this.getElements("x" + infix + "_jk_l");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->jk_l->caption(), $t_pelatihan_add->jk_l->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jk_l");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_add->jk_l->errorMessage()) ?>");
			<?php if ($t_pelatihan_add->jk_p->Required) { ?>
				elm = this.getElements("x" + infix + "_jk_p");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->jk_p->caption(), $t_pelatihan_add->jk_p->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jk_p");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_add->jk_p->errorMessage()) ?>");
			<?php if ($t_pelatihan_add->usia_k45->Required) { ?>
				elm = this.getElements("x" + infix + "_usia_k45");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->usia_k45->caption(), $t_pelatihan_add->usia_k45->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_usia_k45");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_add->usia_k45->errorMessage()) ?>");
			<?php if ($t_pelatihan_add->usia_b45->Required) { ?>
				elm = this.getElements("x" + infix + "_usia_b45");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->usia_b45->caption(), $t_pelatihan_add->usia_b45->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_usia_b45");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_add->usia_b45->errorMessage()) ?>");
			<?php if ($t_pelatihan_add->produk->Required) { ?>
				elm = this.getElements("x" + infix + "_produk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->produk->caption(), $t_pelatihan_add->produk->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->bbio->Required) { ?>
				felm = this.getElements("x" + infix + "_bbio");
				elm = this.getElements("fn_x" + infix + "_bbio");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->bbio->caption(), $t_pelatihan_add->bbio->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->bbio2->Required) { ?>
				felm = this.getElements("x" + infix + "_bbio2");
				elm = this.getElements("fn_x" + infix + "_bbio2");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->bbio2->caption(), $t_pelatihan_add->bbio2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->bbio3->Required) { ?>
				felm = this.getElements("x" + infix + "_bbio3");
				elm = this.getElements("fn_x" + infix + "_bbio3");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->bbio3->caption(), $t_pelatihan_add->bbio3->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->bbio4->Required) { ?>
				felm = this.getElements("x" + infix + "_bbio4");
				elm = this.getElements("fn_x" + infix + "_bbio4");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->bbio4->caption(), $t_pelatihan_add->bbio4->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_add->bbio5->Required) { ?>
				felm = this.getElements("x" + infix + "_bbio5");
				elm = this.getElements("fn_x" + infix + "_bbio5");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_add->bbio5->caption(), $t_pelatihan_add->bbio5->RequiredErrorMessage)) ?>");
			<?php } ?>

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
	ft_pelatihanadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_pelatihanadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_pelatihanadd.lists["x_kdjudul"] = <?php echo $t_pelatihan_add->kdjudul->Lookup->toClientList($t_pelatihan_add) ?>;
	ft_pelatihanadd.lists["x_kdjudul"].options = <?php echo JsonEncode($t_pelatihan_add->kdjudul->lookupOptions()) ?>;
	ft_pelatihanadd.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pelatihanadd.lists["x_kdkursil"] = <?php echo $t_pelatihan_add->kdkursil->Lookup->toClientList($t_pelatihan_add) ?>;
	ft_pelatihanadd.lists["x_kdkursil"].options = <?php echo JsonEncode($t_pelatihan_add->kdkursil->lookupOptions()) ?>;
	ft_pelatihanadd.autoSuggests["x_kdkursil"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pelatihanadd.lists["x_pilihan_iso"] = <?php echo $t_pelatihan_add->pilihan_iso->Lookup->toClientList($t_pelatihan_add) ?>;
	ft_pelatihanadd.lists["x_pilihan_iso"].options = <?php echo JsonEncode($t_pelatihan_add->pilihan_iso->options(FALSE, TRUE)) ?>;
	ft_pelatihanadd.lists["x_kdprop"] = <?php echo $t_pelatihan_add->kdprop->Lookup->toClientList($t_pelatihan_add) ?>;
	ft_pelatihanadd.lists["x_kdprop"].options = <?php echo JsonEncode($t_pelatihan_add->kdprop->lookupOptions()) ?>;
	ft_pelatihanadd.lists["x_kdkota"] = <?php echo $t_pelatihan_add->kdkota->Lookup->toClientList($t_pelatihan_add) ?>;
	ft_pelatihanadd.lists["x_kdkota"].options = <?php echo JsonEncode($t_pelatihan_add->kdkota->lookupOptions()) ?>;
	ft_pelatihanadd.lists["x_kdkec"] = <?php echo $t_pelatihan_add->kdkec->Lookup->toClientList($t_pelatihan_add) ?>;
	ft_pelatihanadd.lists["x_kdkec"].options = <?php echo JsonEncode($t_pelatihan_add->kdkec->lookupOptions()) ?>;
	ft_pelatihanadd.lists["x_ketua"] = <?php echo $t_pelatihan_add->ketua->Lookup->toClientList($t_pelatihan_add) ?>;
	ft_pelatihanadd.lists["x_ketua"].options = <?php echo JsonEncode($t_pelatihan_add->ketua->lookupOptions()) ?>;
	ft_pelatihanadd.autoSuggests["x_ketua"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pelatihanadd.lists["x_sekretaris"] = <?php echo $t_pelatihan_add->sekretaris->Lookup->toClientList($t_pelatihan_add) ?>;
	ft_pelatihanadd.lists["x_sekretaris"].options = <?php echo JsonEncode($t_pelatihan_add->sekretaris->lookupOptions()) ?>;
	ft_pelatihanadd.autoSuggests["x_sekretaris"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pelatihanadd.lists["x_bendahara"] = <?php echo $t_pelatihan_add->bendahara->Lookup->toClientList($t_pelatihan_add) ?>;
	ft_pelatihanadd.lists["x_bendahara"].options = <?php echo JsonEncode($t_pelatihan_add->bendahara->lookupOptions()) ?>;
	ft_pelatihanadd.autoSuggests["x_bendahara"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pelatihanadd.lists["x_anggota2"] = <?php echo $t_pelatihan_add->anggota2->Lookup->toClientList($t_pelatihan_add) ?>;
	ft_pelatihanadd.lists["x_anggota2"].options = <?php echo JsonEncode($t_pelatihan_add->anggota2->lookupOptions()) ?>;
	ft_pelatihanadd.autoSuggests["x_anggota2"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pelatihanadd.lists["x_widyaiswara"] = <?php echo $t_pelatihan_add->widyaiswara->Lookup->toClientList($t_pelatihan_add) ?>;
	ft_pelatihanadd.lists["x_widyaiswara"].options = <?php echo JsonEncode($t_pelatihan_add->widyaiswara->lookupOptions()) ?>;
	ft_pelatihanadd.autoSuggests["x_widyaiswara"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pelatihanadd.lists["x_jenispel"] = <?php echo $t_pelatihan_add->jenispel->Lookup->toClientList($t_pelatihan_add) ?>;
	ft_pelatihanadd.lists["x_jenispel"].options = <?php echo JsonEncode($t_pelatihan_add->jenispel->options(FALSE, TRUE)) ?>;
	ft_pelatihanadd.lists["x_kdkategori"] = <?php echo $t_pelatihan_add->kdkategori->Lookup->toClientList($t_pelatihan_add) ?>;
	ft_pelatihanadd.lists["x_kdkategori"].options = <?php echo JsonEncode($t_pelatihan_add->kdkategori->lookupOptions()) ?>;
	ft_pelatihanadd.lists["x_kerjasama"] = <?php echo $t_pelatihan_add->kerjasama->Lookup->toClientList($t_pelatihan_add) ?>;
	ft_pelatihanadd.lists["x_kerjasama"].options = <?php echo JsonEncode($t_pelatihan_add->kerjasama->lookupOptions()) ?>;
	ft_pelatihanadd.autoSuggests["x_kerjasama"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pelatihanadd.lists["x_statuspel"] = <?php echo $t_pelatihan_add->statuspel->Lookup->toClientList($t_pelatihan_add) ?>;
	ft_pelatihanadd.lists["x_statuspel"].options = <?php echo JsonEncode($t_pelatihan_add->statuspel->options(FALSE, TRUE)) ?>;
	loadjs.done("ft_pelatihanadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//document.write('<?php echo cs_judul("add","Menambah Data Pelatihan");?>');

});
</script>
<?php $t_pelatihan_add->showPageHeader(); ?>
<?php
$t_pelatihan_add->showMessage();
?>
<form name="ft_pelatihanadd" id="ft_pelatihanadd" class="<?php echo $t_pelatihan_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_pelatihan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_pelatihan_add->IsModal ?>">
<?php if ($t_pelatihan->getCurrentMasterTable() == "t_judul") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_judul">
<input type="hidden" name="fk_kdjudul" value="<?php echo HtmlEncode($t_pelatihan_add->kdjudul->getSessionValue()) ?>">
<?php } ?>
<?php if ($t_pelatihan->getCurrentMasterTable() == "t_kota") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_kota">
<input type="hidden" name="fk_kdkota" value="<?php echo HtmlEncode($t_pelatihan_add->kdkota->getSessionValue()) ?>">
<?php } ?>
<?php if ($t_pelatihan->getCurrentMasterTable() == "t_prop") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_prop">
<input type="hidden" name="fk_kdprop" value="<?php echo HtmlEncode($t_pelatihan_add->kdprop->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($t_pelatihan_add->kdpelat->Visible) { // kdpelat ?>
	<div id="r_kdpelat" class="form-group row">
		<label id="elh_t_pelatihan_kdpelat" for="x_kdpelat" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->kdpelat->caption() ?><?php echo $t_pelatihan_add->kdpelat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->kdpelat->cellAttributes() ?>>
<span id="el_t_pelatihan_kdpelat">
<input type="text" data-table="t_pelatihan" data-field="x_kdpelat" name="x_kdpelat" id="x_kdpelat" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($t_pelatihan_add->kdpelat->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_add->kdpelat->EditValue ?>"<?php echo $t_pelatihan_add->kdpelat->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_add->kdpelat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->kdjudul->Visible) { // kdjudul ?>
	<div id="r_kdjudul" class="form-group row">
		<label id="elh_t_pelatihan_kdjudul" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->kdjudul->caption() ?><?php echo $t_pelatihan_add->kdjudul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->kdjudul->cellAttributes() ?>>
<?php if ($t_pelatihan_add->kdjudul->getSessionValue() != "") { ?>
<span id="el_t_pelatihan_kdjudul">
<span<?php echo $t_pelatihan_add->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_add->kdjudul->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_kdjudul" name="x_kdjudul" value="<?php echo HtmlEncode($t_pelatihan_add->kdjudul->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_pelatihan_kdjudul">
<?php
$onchange = $t_pelatihan_add->kdjudul->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_add->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($t_pelatihan_add->kdjudul->EditValue) ?>" size="100" placeholder="<?php echo HtmlEncode($t_pelatihan_add->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_add->kdjudul->getPlaceHolder()) ?>"<?php echo $t_pelatihan_add->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_kdjudul" data-value-separator="<?php echo $t_pelatihan_add->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($t_pelatihan_add->kdjudul->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihanadd"], function() {
	ft_pelatihanadd.createAutoSuggest({"id":"x_kdjudul","forceSelect":true,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $t_pelatihan_add->kdjudul->Lookup->getParamTag($t_pelatihan_add, "p_x_kdjudul") ?>
</span>
<?php } ?>
<?php echo $t_pelatihan_add->kdjudul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->kdkursil->Visible) { // kdkursil ?>
	<div id="r_kdkursil" class="form-group row">
		<label id="elh_t_pelatihan_kdkursil" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->kdkursil->caption() ?><?php echo $t_pelatihan_add->kdkursil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->kdkursil->cellAttributes() ?>>
<span id="el_t_pelatihan_kdkursil">
<?php
$onchange = $t_pelatihan_add->kdkursil->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_add->kdkursil->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdkursil">
	<input type="text" class="form-control" name="sv_x_kdkursil" id="sv_x_kdkursil" value="<?php echo RemoveHtml($t_pelatihan_add->kdkursil->EditValue) ?>" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($t_pelatihan_add->kdkursil->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_add->kdkursil->getPlaceHolder()) ?>"<?php echo $t_pelatihan_add->kdkursil->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_kdkursil" data-value-separator="<?php echo $t_pelatihan_add->kdkursil->displayValueSeparatorAttribute() ?>" name="x_kdkursil" id="x_kdkursil" value="<?php echo HtmlEncode($t_pelatihan_add->kdkursil->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihanadd"], function() {
	ft_pelatihanadd.createAutoSuggest({"id":"x_kdkursil","forceSelect":true});
});
</script>
<?php echo $t_pelatihan_add->kdkursil->Lookup->getParamTag($t_pelatihan_add, "p_x_kdkursil") ?>
</span>
<?php echo $t_pelatihan_add->kdkursil->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->revisi->Visible) { // revisi ?>
	<div id="r_revisi" class="form-group row">
		<label id="elh_t_pelatihan_revisi" for="x_revisi" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->revisi->caption() ?><?php echo $t_pelatihan_add->revisi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->revisi->cellAttributes() ?>>
<span id="el_t_pelatihan_revisi">
<input type="text" data-table="t_pelatihan" data-field="x_revisi" name="x_revisi" id="x_revisi" size="2" maxlength="2" placeholder="<?php echo HtmlEncode($t_pelatihan_add->revisi->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_add->revisi->EditValue ?>"<?php echo $t_pelatihan_add->revisi->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_add->revisi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->tgl_terbit->Visible) { // tgl_terbit ?>
	<div id="r_tgl_terbit" class="form-group row">
		<label id="elh_t_pelatihan_tgl_terbit" for="x_tgl_terbit" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->tgl_terbit->caption() ?><?php echo $t_pelatihan_add->tgl_terbit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->tgl_terbit->cellAttributes() ?>>
<span id="el_t_pelatihan_tgl_terbit">
<input type="text" data-table="t_pelatihan" data-field="x_tgl_terbit" name="x_tgl_terbit" id="x_tgl_terbit" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_pelatihan_add->tgl_terbit->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_add->tgl_terbit->EditValue ?>"<?php echo $t_pelatihan_add->tgl_terbit->editAttributes() ?>>
<?php if (!$t_pelatihan_add->tgl_terbit->ReadOnly && !$t_pelatihan_add->tgl_terbit->Disabled && !isset($t_pelatihan_add->tgl_terbit->EditAttrs["readonly"]) && !isset($t_pelatihan_add->tgl_terbit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_pelatihanadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_pelatihanadd", "x_tgl_terbit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_pelatihan_add->tgl_terbit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->pilihan_iso->Visible) { // pilihan_iso ?>
	<div id="r_pilihan_iso" class="form-group row">
		<label id="elh_t_pelatihan_pilihan_iso" for="x_pilihan_iso" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->pilihan_iso->caption() ?><?php echo $t_pelatihan_add->pilihan_iso->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->pilihan_iso->cellAttributes() ?>>
<span id="el_t_pelatihan_pilihan_iso">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_pilihan_iso" data-value-separator="<?php echo $t_pelatihan_add->pilihan_iso->displayValueSeparatorAttribute() ?>" id="x_pilihan_iso" name="x_pilihan_iso"<?php echo $t_pelatihan_add->pilihan_iso->editAttributes() ?>>
			<?php echo $t_pelatihan_add->pilihan_iso->selectOptionListHtml("x_pilihan_iso") ?>
		</select>
</div>
</span>
<?php echo $t_pelatihan_add->pilihan_iso->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->tawal->Visible) { // tawal ?>
	<div id="r_tawal" class="form-group row">
		<label id="elh_t_pelatihan_tawal" for="x_tawal" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->tawal->caption() ?><?php echo $t_pelatihan_add->tawal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->tawal->cellAttributes() ?>>
<span id="el_t_pelatihan_tawal">
<input type="text" data-table="t_pelatihan" data-field="x_tawal" name="x_tawal" id="x_tawal" size="10" placeholder="<?php echo HtmlEncode($t_pelatihan_add->tawal->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_add->tawal->EditValue ?>"<?php echo $t_pelatihan_add->tawal->editAttributes() ?>>
<?php if (!$t_pelatihan_add->tawal->ReadOnly && !$t_pelatihan_add->tawal->Disabled && !isset($t_pelatihan_add->tawal->EditAttrs["readonly"]) && !isset($t_pelatihan_add->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_pelatihanadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_pelatihanadd", "x_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_pelatihan_add->tawal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->takhir->Visible) { // takhir ?>
	<div id="r_takhir" class="form-group row">
		<label id="elh_t_pelatihan_takhir" for="x_takhir" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->takhir->caption() ?><?php echo $t_pelatihan_add->takhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->takhir->cellAttributes() ?>>
<span id="el_t_pelatihan_takhir">
<input type="text" data-table="t_pelatihan" data-field="x_takhir" name="x_takhir" id="x_takhir" size="10" placeholder="<?php echo HtmlEncode($t_pelatihan_add->takhir->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_add->takhir->EditValue ?>"<?php echo $t_pelatihan_add->takhir->editAttributes() ?>>
<?php if (!$t_pelatihan_add->takhir->ReadOnly && !$t_pelatihan_add->takhir->Disabled && !isset($t_pelatihan_add->takhir->EditAttrs["readonly"]) && !isset($t_pelatihan_add->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_pelatihanadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_pelatihanadd", "x_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_pelatihan_add->takhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->kdprop->Visible) { // kdprop ?>
	<div id="r_kdprop" class="form-group row">
		<label id="elh_t_pelatihan_kdprop" for="x_kdprop" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->kdprop->caption() ?><?php echo $t_pelatihan_add->kdprop->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->kdprop->cellAttributes() ?>>
<?php if ($t_pelatihan_add->kdprop->getSessionValue() != "") { ?>
<span id="el_t_pelatihan_kdprop">
<span<?php echo $t_pelatihan_add->kdprop->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_add->kdprop->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_kdprop" name="x_kdprop" value="<?php echo HtmlEncode($t_pelatihan_add->kdprop->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_pelatihan_kdprop">
<?php $t_pelatihan_add->kdprop->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_kdprop" data-value-separator="<?php echo $t_pelatihan_add->kdprop->displayValueSeparatorAttribute() ?>" id="x_kdprop" name="x_kdprop"<?php echo $t_pelatihan_add->kdprop->editAttributes() ?>>
			<?php echo $t_pelatihan_add->kdprop->selectOptionListHtml("x_kdprop") ?>
		</select>
</div>
<?php echo $t_pelatihan_add->kdprop->Lookup->getParamTag($t_pelatihan_add, "p_x_kdprop") ?>
</span>
<?php } ?>
<?php echo $t_pelatihan_add->kdprop->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->kdkota->Visible) { // kdkota ?>
	<div id="r_kdkota" class="form-group row">
		<label id="elh_t_pelatihan_kdkota" for="x_kdkota" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->kdkota->caption() ?><?php echo $t_pelatihan_add->kdkota->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->kdkota->cellAttributes() ?>>
<?php if ($t_pelatihan_add->kdkota->getSessionValue() != "") { ?>
<span id="el_t_pelatihan_kdkota">
<span<?php echo $t_pelatihan_add->kdkota->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_add->kdkota->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_kdkota" name="x_kdkota" value="<?php echo HtmlEncode($t_pelatihan_add->kdkota->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_pelatihan_kdkota">
<?php $t_pelatihan_add->kdkota->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_kdkota" data-value-separator="<?php echo $t_pelatihan_add->kdkota->displayValueSeparatorAttribute() ?>" id="x_kdkota" name="x_kdkota"<?php echo $t_pelatihan_add->kdkota->editAttributes() ?>>
			<?php echo $t_pelatihan_add->kdkota->selectOptionListHtml("x_kdkota") ?>
		</select>
</div>
<?php echo $t_pelatihan_add->kdkota->Lookup->getParamTag($t_pelatihan_add, "p_x_kdkota") ?>
</span>
<?php } ?>
<?php echo $t_pelatihan_add->kdkota->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->kdkec->Visible) { // kdkec ?>
	<div id="r_kdkec" class="form-group row">
		<label id="elh_t_pelatihan_kdkec" for="x_kdkec" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->kdkec->caption() ?><?php echo $t_pelatihan_add->kdkec->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->kdkec->cellAttributes() ?>>
<span id="el_t_pelatihan_kdkec">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_kdkec" data-value-separator="<?php echo $t_pelatihan_add->kdkec->displayValueSeparatorAttribute() ?>" id="x_kdkec" name="x_kdkec"<?php echo $t_pelatihan_add->kdkec->editAttributes() ?>>
			<?php echo $t_pelatihan_add->kdkec->selectOptionListHtml("x_kdkec") ?>
		</select>
</div>
<?php echo $t_pelatihan_add->kdkec->Lookup->getParamTag($t_pelatihan_add, "p_x_kdkec") ?>
</span>
<?php echo $t_pelatihan_add->kdkec->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->ketua->Visible) { // ketua ?>
	<div id="r_ketua" class="form-group row">
		<label id="elh_t_pelatihan_ketua" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->ketua->caption() ?><?php echo $t_pelatihan_add->ketua->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->ketua->cellAttributes() ?>>
<span id="el_t_pelatihan_ketua">
<?php
$onchange = $t_pelatihan_add->ketua->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_add->ketua->EditAttrs["onchange"] = "";
?>
<span id="as_x_ketua">
	<input type="text" class="form-control" name="sv_x_ketua" id="sv_x_ketua" value="<?php echo RemoveHtml($t_pelatihan_add->ketua->EditValue) ?>" size="80" maxlength="40" placeholder="<?php echo HtmlEncode($t_pelatihan_add->ketua->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_add->ketua->getPlaceHolder()) ?>"<?php echo $t_pelatihan_add->ketua->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_ketua" data-value-separator="<?php echo $t_pelatihan_add->ketua->displayValueSeparatorAttribute() ?>" name="x_ketua" id="x_ketua" value="<?php echo HtmlEncode($t_pelatihan_add->ketua->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihanadd"], function() {
	ft_pelatihanadd.createAutoSuggest({"id":"x_ketua","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_pelatihan_add->ketua->Lookup->getParamTag($t_pelatihan_add, "p_x_ketua") ?>
</span>
<?php echo $t_pelatihan_add->ketua->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->sekretaris->Visible) { // sekretaris ?>
	<div id="r_sekretaris" class="form-group row">
		<label id="elh_t_pelatihan_sekretaris" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->sekretaris->caption() ?><?php echo $t_pelatihan_add->sekretaris->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->sekretaris->cellAttributes() ?>>
<span id="el_t_pelatihan_sekretaris">
<?php
$onchange = $t_pelatihan_add->sekretaris->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_add->sekretaris->EditAttrs["onchange"] = "";
?>
<span id="as_x_sekretaris">
	<input type="text" class="form-control" name="sv_x_sekretaris" id="sv_x_sekretaris" value="<?php echo RemoveHtml($t_pelatihan_add->sekretaris->EditValue) ?>" size="80" maxlength="40" placeholder="<?php echo HtmlEncode($t_pelatihan_add->sekretaris->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_add->sekretaris->getPlaceHolder()) ?>"<?php echo $t_pelatihan_add->sekretaris->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_sekretaris" data-value-separator="<?php echo $t_pelatihan_add->sekretaris->displayValueSeparatorAttribute() ?>" name="x_sekretaris" id="x_sekretaris" value="<?php echo HtmlEncode($t_pelatihan_add->sekretaris->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihanadd"], function() {
	ft_pelatihanadd.createAutoSuggest({"id":"x_sekretaris","forceSelect":true,"minWidth":"505px","maxHeight":"333px"});
});
</script>
<?php echo $t_pelatihan_add->sekretaris->Lookup->getParamTag($t_pelatihan_add, "p_x_sekretaris") ?>
</span>
<?php echo $t_pelatihan_add->sekretaris->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->bendahara->Visible) { // bendahara ?>
	<div id="r_bendahara" class="form-group row">
		<label id="elh_t_pelatihan_bendahara" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->bendahara->caption() ?><?php echo $t_pelatihan_add->bendahara->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->bendahara->cellAttributes() ?>>
<span id="el_t_pelatihan_bendahara">
<?php
$onchange = $t_pelatihan_add->bendahara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_add->bendahara->EditAttrs["onchange"] = "";
?>
<span id="as_x_bendahara">
	<input type="text" class="form-control" name="sv_x_bendahara" id="sv_x_bendahara" value="<?php echo RemoveHtml($t_pelatihan_add->bendahara->EditValue) ?>" size="80" maxlength="40" placeholder="<?php echo HtmlEncode($t_pelatihan_add->bendahara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_add->bendahara->getPlaceHolder()) ?>"<?php echo $t_pelatihan_add->bendahara->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_bendahara" data-value-separator="<?php echo $t_pelatihan_add->bendahara->displayValueSeparatorAttribute() ?>" name="x_bendahara" id="x_bendahara" value="<?php echo HtmlEncode($t_pelatihan_add->bendahara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihanadd"], function() {
	ft_pelatihanadd.createAutoSuggest({"id":"x_bendahara","forceSelect":false,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_pelatihan_add->bendahara->Lookup->getParamTag($t_pelatihan_add, "p_x_bendahara") ?>
</span>
<?php echo $t_pelatihan_add->bendahara->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->anggota2->Visible) { // anggota2 ?>
	<div id="r_anggota2" class="form-group row">
		<label id="elh_t_pelatihan_anggota2" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->anggota2->caption() ?><?php echo $t_pelatihan_add->anggota2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->anggota2->cellAttributes() ?>>
<span id="el_t_pelatihan_anggota2">
<?php
$onchange = $t_pelatihan_add->anggota2->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_add->anggota2->EditAttrs["onchange"] = "";
?>
<span id="as_x_anggota2">
	<input type="text" class="form-control" name="sv_x_anggota2" id="sv_x_anggota2" value="<?php echo RemoveHtml($t_pelatihan_add->anggota2->EditValue) ?>" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($t_pelatihan_add->anggota2->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_add->anggota2->getPlaceHolder()) ?>"<?php echo $t_pelatihan_add->anggota2->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_anggota2" data-value-separator="<?php echo $t_pelatihan_add->anggota2->displayValueSeparatorAttribute() ?>" name="x_anggota2" id="x_anggota2" value="<?php echo HtmlEncode($t_pelatihan_add->anggota2->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihanadd"], function() {
	ft_pelatihanadd.createAutoSuggest({"id":"x_anggota2","forceSelect":false});
});
</script>
<?php echo $t_pelatihan_add->anggota2->Lookup->getParamTag($t_pelatihan_add, "p_x_anggota2") ?>
</span>
<?php echo $t_pelatihan_add->anggota2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->widyaiswara->Visible) { // widyaiswara ?>
	<div id="r_widyaiswara" class="form-group row">
		<label id="elh_t_pelatihan_widyaiswara" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->widyaiswara->caption() ?><?php echo $t_pelatihan_add->widyaiswara->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->widyaiswara->cellAttributes() ?>>
<span id="el_t_pelatihan_widyaiswara">
<?php
$onchange = $t_pelatihan_add->widyaiswara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_add->widyaiswara->EditAttrs["onchange"] = "";
?>
<span id="as_x_widyaiswara">
	<input type="text" class="form-control" name="sv_x_widyaiswara" id="sv_x_widyaiswara" value="<?php echo RemoveHtml($t_pelatihan_add->widyaiswara->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($t_pelatihan_add->widyaiswara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_add->widyaiswara->getPlaceHolder()) ?>"<?php echo $t_pelatihan_add->widyaiswara->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_widyaiswara" data-value-separator="<?php echo $t_pelatihan_add->widyaiswara->displayValueSeparatorAttribute() ?>" name="x_widyaiswara" id="x_widyaiswara" value="<?php echo HtmlEncode($t_pelatihan_add->widyaiswara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihanadd"], function() {
	ft_pelatihanadd.createAutoSuggest({"id":"x_widyaiswara","forceSelect":true});
});
</script>
<?php echo $t_pelatihan_add->widyaiswara->Lookup->getParamTag($t_pelatihan_add, "p_x_widyaiswara") ?>
</span>
<?php echo $t_pelatihan_add->widyaiswara->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->jenisevaluasi->Visible) { // jenisevaluasi ?>
	<div id="r_jenisevaluasi" class="form-group row">
		<label id="elh_t_pelatihan_jenisevaluasi" for="x_jenisevaluasi" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->jenisevaluasi->caption() ?><?php echo $t_pelatihan_add->jenisevaluasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->jenisevaluasi->cellAttributes() ?>>
<span id="el_t_pelatihan_jenisevaluasi">
<input type="text" data-table="t_pelatihan" data-field="x_jenisevaluasi" name="x_jenisevaluasi" id="x_jenisevaluasi" size="30" placeholder="<?php echo HtmlEncode($t_pelatihan_add->jenisevaluasi->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_add->jenisevaluasi->EditValue ?>"<?php echo $t_pelatihan_add->jenisevaluasi->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_add->jenisevaluasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->jenispel->Visible) { // jenispel ?>
	<div id="r_jenispel" class="form-group row">
		<label id="elh_t_pelatihan_jenispel" for="x_jenispel" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->jenispel->caption() ?><?php echo $t_pelatihan_add->jenispel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->jenispel->cellAttributes() ?>>
<span id="el_t_pelatihan_jenispel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_jenispel" data-value-separator="<?php echo $t_pelatihan_add->jenispel->displayValueSeparatorAttribute() ?>" id="x_jenispel" name="x_jenispel"<?php echo $t_pelatihan_add->jenispel->editAttributes() ?>>
			<?php echo $t_pelatihan_add->jenispel->selectOptionListHtml("x_jenispel") ?>
		</select>
</div>
</span>
<?php echo $t_pelatihan_add->jenispel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->kdkategori->Visible) { // kdkategori ?>
	<div id="r_kdkategori" class="form-group row">
		<label id="elh_t_pelatihan_kdkategori" for="x_kdkategori" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->kdkategori->caption() ?><?php echo $t_pelatihan_add->kdkategori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->kdkategori->cellAttributes() ?>>
<span id="el_t_pelatihan_kdkategori">
<?php $t_pelatihan_add->kdkategori->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_kdkategori" data-value-separator="<?php echo $t_pelatihan_add->kdkategori->displayValueSeparatorAttribute() ?>" id="x_kdkategori" name="x_kdkategori"<?php echo $t_pelatihan_add->kdkategori->editAttributes() ?>>
			<?php echo $t_pelatihan_add->kdkategori->selectOptionListHtml("x_kdkategori") ?>
		</select>
</div>
<?php echo $t_pelatihan_add->kdkategori->Lookup->getParamTag($t_pelatihan_add, "p_x_kdkategori") ?>
</span>
<?php echo $t_pelatihan_add->kdkategori->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->kerjasama->Visible) { // kerjasama ?>
	<div id="r_kerjasama" class="form-group row">
		<label id="elh_t_pelatihan_kerjasama" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->kerjasama->caption() ?><?php echo $t_pelatihan_add->kerjasama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->kerjasama->cellAttributes() ?>>
<span id="el_t_pelatihan_kerjasama">
<?php
$onchange = $t_pelatihan_add->kerjasama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_add->kerjasama->EditAttrs["onchange"] = "";
?>
<span id="as_x_kerjasama">
	<input type="text" class="form-control" name="sv_x_kerjasama" id="sv_x_kerjasama" value="<?php echo RemoveHtml($t_pelatihan_add->kerjasama->EditValue) ?>" size="100" maxlength="11" placeholder="<?php echo HtmlEncode($t_pelatihan_add->kerjasama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_add->kerjasama->getPlaceHolder()) ?>"<?php echo $t_pelatihan_add->kerjasama->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_kerjasama" data-value-separator="<?php echo $t_pelatihan_add->kerjasama->displayValueSeparatorAttribute() ?>" name="x_kerjasama" id="x_kerjasama" value="<?php echo HtmlEncode($t_pelatihan_add->kerjasama->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihanadd"], function() {
	ft_pelatihanadd.createAutoSuggest({"id":"x_kerjasama","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_pelatihan_add->kerjasama->Lookup->getParamTag($t_pelatihan_add, "p_x_kerjasama") ?>
</span>
<?php echo $t_pelatihan_add->kerjasama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->biaya->Visible) { // biaya ?>
	<div id="r_biaya" class="form-group row">
		<label id="elh_t_pelatihan_biaya" for="x_biaya" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->biaya->caption() ?><?php echo $t_pelatihan_add->biaya->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->biaya->cellAttributes() ?>>
<span id="el_t_pelatihan_biaya">
<input type="text" data-table="t_pelatihan" data-field="x_biaya" name="x_biaya" id="x_biaya" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($t_pelatihan_add->biaya->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_add->biaya->EditValue ?>"<?php echo $t_pelatihan_add->biaya->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_add->biaya->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->namaberkas->Visible) { // namaberkas ?>
	<div id="r_namaberkas" class="form-group row">
		<label id="elh_t_pelatihan_namaberkas" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->namaberkas->caption() ?><?php echo $t_pelatihan_add->namaberkas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->namaberkas->cellAttributes() ?>>
<span id="el_t_pelatihan_namaberkas">
<div id="fd_x_namaberkas">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pelatihan_add->namaberkas->title() ?>" data-table="t_pelatihan" data-field="x_namaberkas" name="x_namaberkas" id="x_namaberkas" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pelatihan_add->namaberkas->editAttributes() ?><?php if ($t_pelatihan_add->namaberkas->ReadOnly || $t_pelatihan_add->namaberkas->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_namaberkas"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_namaberkas" id= "fn_x_namaberkas" value="<?php echo $t_pelatihan_add->namaberkas->Upload->FileName ?>">
<input type="hidden" name="fa_x_namaberkas" id= "fa_x_namaberkas" value="0">
<input type="hidden" name="fs_x_namaberkas" id= "fs_x_namaberkas" value="255">
<input type="hidden" name="fx_x_namaberkas" id= "fx_x_namaberkas" value="<?php echo $t_pelatihan_add->namaberkas->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_namaberkas" id= "fm_x_namaberkas" value="<?php echo $t_pelatihan_add->namaberkas->UploadMaxFileSize ?>">
</div>
<table id="ft_x_namaberkas" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_pelatihan_add->namaberkas->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->statuspel->Visible) { // statuspel ?>
	<div id="r_statuspel" class="form-group row">
		<label id="elh_t_pelatihan_statuspel" for="x_statuspel" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->statuspel->caption() ?><?php echo $t_pelatihan_add->statuspel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->statuspel->cellAttributes() ?>>
<span id="el_t_pelatihan_statuspel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_statuspel" data-value-separator="<?php echo $t_pelatihan_add->statuspel->displayValueSeparatorAttribute() ?>" id="x_statuspel" name="x_statuspel"<?php echo $t_pelatihan_add->statuspel->editAttributes() ?>>
			<?php echo $t_pelatihan_add->statuspel->selectOptionListHtml("x_statuspel") ?>
		</select>
</div>
</span>
<?php echo $t_pelatihan_add->statuspel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->ket->Visible) { // ket ?>
	<div id="r_ket" class="form-group row">
		<label id="elh_t_pelatihan_ket" for="x_ket" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->ket->caption() ?><?php echo $t_pelatihan_add->ket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->ket->cellAttributes() ?>>
<span id="el_t_pelatihan_ket">
<textarea data-table="t_pelatihan" data-field="x_ket" name="x_ket" id="x_ket" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_pelatihan_add->ket->getPlaceHolder()) ?>"<?php echo $t_pelatihan_add->ket->editAttributes() ?>><?php echo $t_pelatihan_add->ket->EditValue ?></textarea>
</span>
<?php echo $t_pelatihan_add->ket->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->jpeserta->Visible) { // jpeserta ?>
	<div id="r_jpeserta" class="form-group row">
		<label id="elh_t_pelatihan_jpeserta" for="x_jpeserta" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->jpeserta->caption() ?><?php echo $t_pelatihan_add->jpeserta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->jpeserta->cellAttributes() ?>>
<span id="el_t_pelatihan_jpeserta">
<input type="text" data-table="t_pelatihan" data-field="x_jpeserta" name="x_jpeserta" id="x_jpeserta" size="30" maxlength="21" placeholder="<?php echo HtmlEncode($t_pelatihan_add->jpeserta->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_add->jpeserta->EditValue ?>"<?php echo $t_pelatihan_add->jpeserta->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_add->jpeserta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->real_peserta->Visible) { // real_peserta ?>
	<div id="r_real_peserta" class="form-group row">
		<label id="elh_t_pelatihan_real_peserta" for="x_real_peserta" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->real_peserta->caption() ?><?php echo $t_pelatihan_add->real_peserta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->real_peserta->cellAttributes() ?>>
<span id="el_t_pelatihan_real_peserta">
<input type="text" data-table="t_pelatihan" data-field="x_real_peserta" name="x_real_peserta" id="x_real_peserta" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_add->real_peserta->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_add->real_peserta->EditValue ?>"<?php echo $t_pelatihan_add->real_peserta->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_add->real_peserta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->independen->Visible) { // independen ?>
	<div id="r_independen" class="form-group row">
		<label id="elh_t_pelatihan_independen" for="x_independen" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->independen->caption() ?><?php echo $t_pelatihan_add->independen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->independen->cellAttributes() ?>>
<span id="el_t_pelatihan_independen">
<input type="text" data-table="t_pelatihan" data-field="x_independen" name="x_independen" id="x_independen" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_add->independen->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_add->independen->EditValue ?>"<?php echo $t_pelatihan_add->independen->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_add->independen->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->swasta_k->Visible) { // swasta_k ?>
	<div id="r_swasta_k" class="form-group row">
		<label id="elh_t_pelatihan_swasta_k" for="x_swasta_k" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->swasta_k->caption() ?><?php echo $t_pelatihan_add->swasta_k->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->swasta_k->cellAttributes() ?>>
<span id="el_t_pelatihan_swasta_k">
<input type="text" data-table="t_pelatihan" data-field="x_swasta_k" name="x_swasta_k" id="x_swasta_k" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_add->swasta_k->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_add->swasta_k->EditValue ?>"<?php echo $t_pelatihan_add->swasta_k->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_add->swasta_k->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->swasta_m->Visible) { // swasta_m ?>
	<div id="r_swasta_m" class="form-group row">
		<label id="elh_t_pelatihan_swasta_m" for="x_swasta_m" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->swasta_m->caption() ?><?php echo $t_pelatihan_add->swasta_m->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->swasta_m->cellAttributes() ?>>
<span id="el_t_pelatihan_swasta_m">
<input type="text" data-table="t_pelatihan" data-field="x_swasta_m" name="x_swasta_m" id="x_swasta_m" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_add->swasta_m->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_add->swasta_m->EditValue ?>"<?php echo $t_pelatihan_add->swasta_m->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_add->swasta_m->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->swasta_b->Visible) { // swasta_b ?>
	<div id="r_swasta_b" class="form-group row">
		<label id="elh_t_pelatihan_swasta_b" for="x_swasta_b" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->swasta_b->caption() ?><?php echo $t_pelatihan_add->swasta_b->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->swasta_b->cellAttributes() ?>>
<span id="el_t_pelatihan_swasta_b">
<input type="text" data-table="t_pelatihan" data-field="x_swasta_b" name="x_swasta_b" id="x_swasta_b" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_add->swasta_b->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_add->swasta_b->EditValue ?>"<?php echo $t_pelatihan_add->swasta_b->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_add->swasta_b->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->bumn->Visible) { // bumn ?>
	<div id="r_bumn" class="form-group row">
		<label id="elh_t_pelatihan_bumn" for="x_bumn" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->bumn->caption() ?><?php echo $t_pelatihan_add->bumn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->bumn->cellAttributes() ?>>
<span id="el_t_pelatihan_bumn">
<input type="text" data-table="t_pelatihan" data-field="x_bumn" name="x_bumn" id="x_bumn" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_add->bumn->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_add->bumn->EditValue ?>"<?php echo $t_pelatihan_add->bumn->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_add->bumn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->koperasi->Visible) { // koperasi ?>
	<div id="r_koperasi" class="form-group row">
		<label id="elh_t_pelatihan_koperasi" for="x_koperasi" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->koperasi->caption() ?><?php echo $t_pelatihan_add->koperasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->koperasi->cellAttributes() ?>>
<span id="el_t_pelatihan_koperasi">
<input type="text" data-table="t_pelatihan" data-field="x_koperasi" name="x_koperasi" id="x_koperasi" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_add->koperasi->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_add->koperasi->EditValue ?>"<?php echo $t_pelatihan_add->koperasi->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_add->koperasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->pns->Visible) { // pns ?>
	<div id="r_pns" class="form-group row">
		<label id="elh_t_pelatihan_pns" for="x_pns" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->pns->caption() ?><?php echo $t_pelatihan_add->pns->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->pns->cellAttributes() ?>>
<span id="el_t_pelatihan_pns">
<input type="text" data-table="t_pelatihan" data-field="x_pns" name="x_pns" id="x_pns" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_add->pns->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_add->pns->EditValue ?>"<?php echo $t_pelatihan_add->pns->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_add->pns->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->pt_dosen->Visible) { // pt_dosen ?>
	<div id="r_pt_dosen" class="form-group row">
		<label id="elh_t_pelatihan_pt_dosen" for="x_pt_dosen" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->pt_dosen->caption() ?><?php echo $t_pelatihan_add->pt_dosen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->pt_dosen->cellAttributes() ?>>
<span id="el_t_pelatihan_pt_dosen">
<input type="text" data-table="t_pelatihan" data-field="x_pt_dosen" name="x_pt_dosen" id="x_pt_dosen" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_add->pt_dosen->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_add->pt_dosen->EditValue ?>"<?php echo $t_pelatihan_add->pt_dosen->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_add->pt_dosen->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->pt_mhs->Visible) { // pt_mhs ?>
	<div id="r_pt_mhs" class="form-group row">
		<label id="elh_t_pelatihan_pt_mhs" for="x_pt_mhs" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->pt_mhs->caption() ?><?php echo $t_pelatihan_add->pt_mhs->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->pt_mhs->cellAttributes() ?>>
<span id="el_t_pelatihan_pt_mhs">
<input type="text" data-table="t_pelatihan" data-field="x_pt_mhs" name="x_pt_mhs" id="x_pt_mhs" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_add->pt_mhs->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_add->pt_mhs->EditValue ?>"<?php echo $t_pelatihan_add->pt_mhs->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_add->pt_mhs->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->jk_l->Visible) { // jk_l ?>
	<div id="r_jk_l" class="form-group row">
		<label id="elh_t_pelatihan_jk_l" for="x_jk_l" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->jk_l->caption() ?><?php echo $t_pelatihan_add->jk_l->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->jk_l->cellAttributes() ?>>
<span id="el_t_pelatihan_jk_l">
<input type="text" data-table="t_pelatihan" data-field="x_jk_l" name="x_jk_l" id="x_jk_l" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_add->jk_l->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_add->jk_l->EditValue ?>"<?php echo $t_pelatihan_add->jk_l->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_add->jk_l->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->jk_p->Visible) { // jk_p ?>
	<div id="r_jk_p" class="form-group row">
		<label id="elh_t_pelatihan_jk_p" for="x_jk_p" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->jk_p->caption() ?><?php echo $t_pelatihan_add->jk_p->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->jk_p->cellAttributes() ?>>
<span id="el_t_pelatihan_jk_p">
<input type="text" data-table="t_pelatihan" data-field="x_jk_p" name="x_jk_p" id="x_jk_p" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_add->jk_p->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_add->jk_p->EditValue ?>"<?php echo $t_pelatihan_add->jk_p->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_add->jk_p->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->usia_k45->Visible) { // usia_k45 ?>
	<div id="r_usia_k45" class="form-group row">
		<label id="elh_t_pelatihan_usia_k45" for="x_usia_k45" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->usia_k45->caption() ?><?php echo $t_pelatihan_add->usia_k45->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->usia_k45->cellAttributes() ?>>
<span id="el_t_pelatihan_usia_k45">
<input type="text" data-table="t_pelatihan" data-field="x_usia_k45" name="x_usia_k45" id="x_usia_k45" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_add->usia_k45->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_add->usia_k45->EditValue ?>"<?php echo $t_pelatihan_add->usia_k45->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_add->usia_k45->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->usia_b45->Visible) { // usia_b45 ?>
	<div id="r_usia_b45" class="form-group row">
		<label id="elh_t_pelatihan_usia_b45" for="x_usia_b45" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->usia_b45->caption() ?><?php echo $t_pelatihan_add->usia_b45->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->usia_b45->cellAttributes() ?>>
<span id="el_t_pelatihan_usia_b45">
<input type="text" data-table="t_pelatihan" data-field="x_usia_b45" name="x_usia_b45" id="x_usia_b45" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_add->usia_b45->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_add->usia_b45->EditValue ?>"<?php echo $t_pelatihan_add->usia_b45->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_add->usia_b45->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->produk->Visible) { // produk ?>
	<div id="r_produk" class="form-group row">
		<label id="elh_t_pelatihan_produk" for="x_produk" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->produk->caption() ?><?php echo $t_pelatihan_add->produk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->produk->cellAttributes() ?>>
<span id="el_t_pelatihan_produk">
<textarea data-table="t_pelatihan" data-field="x_produk" name="x_produk" id="x_produk" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_pelatihan_add->produk->getPlaceHolder()) ?>"<?php echo $t_pelatihan_add->produk->editAttributes() ?>><?php echo $t_pelatihan_add->produk->EditValue ?></textarea>
</span>
<?php echo $t_pelatihan_add->produk->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->bbio->Visible) { // bbio ?>
	<div id="r_bbio" class="form-group row">
		<label id="elh_t_pelatihan_bbio" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->bbio->caption() ?><?php echo $t_pelatihan_add->bbio->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->bbio->cellAttributes() ?>>
<span id="el_t_pelatihan_bbio">
<div id="fd_x_bbio">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pelatihan_add->bbio->title() ?>" data-table="t_pelatihan" data-field="x_bbio" name="x_bbio" id="x_bbio" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pelatihan_add->bbio->editAttributes() ?><?php if ($t_pelatihan_add->bbio->ReadOnly || $t_pelatihan_add->bbio->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_bbio"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_bbio" id= "fn_x_bbio" value="<?php echo $t_pelatihan_add->bbio->Upload->FileName ?>">
<input type="hidden" name="fa_x_bbio" id= "fa_x_bbio" value="0">
<input type="hidden" name="fs_x_bbio" id= "fs_x_bbio" value="255">
<input type="hidden" name="fx_x_bbio" id= "fx_x_bbio" value="<?php echo $t_pelatihan_add->bbio->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bbio" id= "fm_x_bbio" value="<?php echo $t_pelatihan_add->bbio->UploadMaxFileSize ?>">
</div>
<table id="ft_x_bbio" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_pelatihan_add->bbio->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->bbio2->Visible) { // bbio2 ?>
	<div id="r_bbio2" class="form-group row">
		<label id="elh_t_pelatihan_bbio2" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->bbio2->caption() ?><?php echo $t_pelatihan_add->bbio2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->bbio2->cellAttributes() ?>>
<span id="el_t_pelatihan_bbio2">
<div id="fd_x_bbio2">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pelatihan_add->bbio2->title() ?>" data-table="t_pelatihan" data-field="x_bbio2" name="x_bbio2" id="x_bbio2" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pelatihan_add->bbio2->editAttributes() ?><?php if ($t_pelatihan_add->bbio2->ReadOnly || $t_pelatihan_add->bbio2->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_bbio2"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_bbio2" id= "fn_x_bbio2" value="<?php echo $t_pelatihan_add->bbio2->Upload->FileName ?>">
<input type="hidden" name="fa_x_bbio2" id= "fa_x_bbio2" value="0">
<input type="hidden" name="fs_x_bbio2" id= "fs_x_bbio2" value="255">
<input type="hidden" name="fx_x_bbio2" id= "fx_x_bbio2" value="<?php echo $t_pelatihan_add->bbio2->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bbio2" id= "fm_x_bbio2" value="<?php echo $t_pelatihan_add->bbio2->UploadMaxFileSize ?>">
</div>
<table id="ft_x_bbio2" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_pelatihan_add->bbio2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->bbio3->Visible) { // bbio3 ?>
	<div id="r_bbio3" class="form-group row">
		<label id="elh_t_pelatihan_bbio3" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->bbio3->caption() ?><?php echo $t_pelatihan_add->bbio3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->bbio3->cellAttributes() ?>>
<span id="el_t_pelatihan_bbio3">
<div id="fd_x_bbio3">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pelatihan_add->bbio3->title() ?>" data-table="t_pelatihan" data-field="x_bbio3" name="x_bbio3" id="x_bbio3" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pelatihan_add->bbio3->editAttributes() ?><?php if ($t_pelatihan_add->bbio3->ReadOnly || $t_pelatihan_add->bbio3->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_bbio3"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_bbio3" id= "fn_x_bbio3" value="<?php echo $t_pelatihan_add->bbio3->Upload->FileName ?>">
<input type="hidden" name="fa_x_bbio3" id= "fa_x_bbio3" value="0">
<input type="hidden" name="fs_x_bbio3" id= "fs_x_bbio3" value="255">
<input type="hidden" name="fx_x_bbio3" id= "fx_x_bbio3" value="<?php echo $t_pelatihan_add->bbio3->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bbio3" id= "fm_x_bbio3" value="<?php echo $t_pelatihan_add->bbio3->UploadMaxFileSize ?>">
</div>
<table id="ft_x_bbio3" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_pelatihan_add->bbio3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->bbio4->Visible) { // bbio4 ?>
	<div id="r_bbio4" class="form-group row">
		<label id="elh_t_pelatihan_bbio4" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->bbio4->caption() ?><?php echo $t_pelatihan_add->bbio4->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->bbio4->cellAttributes() ?>>
<span id="el_t_pelatihan_bbio4">
<div id="fd_x_bbio4">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pelatihan_add->bbio4->title() ?>" data-table="t_pelatihan" data-field="x_bbio4" name="x_bbio4" id="x_bbio4" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pelatihan_add->bbio4->editAttributes() ?><?php if ($t_pelatihan_add->bbio4->ReadOnly || $t_pelatihan_add->bbio4->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_bbio4"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_bbio4" id= "fn_x_bbio4" value="<?php echo $t_pelatihan_add->bbio4->Upload->FileName ?>">
<input type="hidden" name="fa_x_bbio4" id= "fa_x_bbio4" value="0">
<input type="hidden" name="fs_x_bbio4" id= "fs_x_bbio4" value="255">
<input type="hidden" name="fx_x_bbio4" id= "fx_x_bbio4" value="<?php echo $t_pelatihan_add->bbio4->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bbio4" id= "fm_x_bbio4" value="<?php echo $t_pelatihan_add->bbio4->UploadMaxFileSize ?>">
</div>
<table id="ft_x_bbio4" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_pelatihan_add->bbio4->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_add->bbio5->Visible) { // bbio5 ?>
	<div id="r_bbio5" class="form-group row">
		<label id="elh_t_pelatihan_bbio5" class="<?php echo $t_pelatihan_add->LeftColumnClass ?>"><?php echo $t_pelatihan_add->bbio5->caption() ?><?php echo $t_pelatihan_add->bbio5->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_add->RightColumnClass ?>"><div <?php echo $t_pelatihan_add->bbio5->cellAttributes() ?>>
<span id="el_t_pelatihan_bbio5">
<div id="fd_x_bbio5">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pelatihan_add->bbio5->title() ?>" data-table="t_pelatihan" data-field="x_bbio5" name="x_bbio5" id="x_bbio5" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pelatihan_add->bbio5->editAttributes() ?><?php if ($t_pelatihan_add->bbio5->ReadOnly || $t_pelatihan_add->bbio5->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_bbio5"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_bbio5" id= "fn_x_bbio5" value="<?php echo $t_pelatihan_add->bbio5->Upload->FileName ?>">
<input type="hidden" name="fa_x_bbio5" id= "fa_x_bbio5" value="0">
<input type="hidden" name="fs_x_bbio5" id= "fs_x_bbio5" value="255">
<input type="hidden" name="fx_x_bbio5" id= "fx_x_bbio5" value="<?php echo $t_pelatihan_add->bbio5->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bbio5" id= "fm_x_bbio5" value="<?php echo $t_pelatihan_add->bbio5->UploadMaxFileSize ?>">
</div>
<table id="ft_x_bbio5" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_pelatihan_add->bbio5->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("cv_historipeserta", explode(",", $t_pelatihan->getCurrentDetailTable())) && $cv_historipeserta->DetailAdd) {
?>
<?php if ($t_pelatihan->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("cv_historipeserta", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "cv_historipesertagrid.php" ?>
<?php } ?>
<?php
	if (in_array("cv_historiinstruktur", explode(",", $t_pelatihan->getCurrentDetailTable())) && $cv_historiinstruktur->DetailAdd) {
?>
<?php if ($t_pelatihan->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("cv_historiinstruktur", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "cv_historiinstrukturgrid.php" ?>
<?php } ?>
<?php
	if (in_array("t_jadwalpel", explode(",", $t_pelatihan->getCurrentDetailTable())) && $t_jadwalpel->DetailAdd) {
?>
<?php if ($t_pelatihan->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("t_jadwalpel", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "t_jadwalpelgrid.php" ?>
<?php } ?>
<?php if (!$t_pelatihan_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_pelatihan_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_pelatihan_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_pelatihan_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$("#r_idpelat").hide(),$("#r_kdpelat").hide(),$("#r_biaya").hide(),$("#r_kerjasama").hide(),$("#r_kdkategori").hide();
});
</script>
<?php include_once "footer.php"; ?>
<?php
$t_pelatihan_add->terminate();
?>