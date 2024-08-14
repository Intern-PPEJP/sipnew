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
$t_pelatihan_edit = new t_pelatihan_edit();

// Run the page
$t_pelatihan_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pelatihan_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_pelatihanedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_pelatihanedit = currentForm = new ew.Form("ft_pelatihanedit", "edit");

	// Validate form
	ft_pelatihanedit.validate = function() {
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
			<?php if ($t_pelatihan_edit->idpelat->Required) { ?>
				elm = this.getElements("x" + infix + "_idpelat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->idpelat->caption(), $t_pelatihan_edit->idpelat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_edit->kdpelat->Required) { ?>
				elm = this.getElements("x" + infix + "_kdpelat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->kdpelat->caption(), $t_pelatihan_edit->kdpelat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_edit->kdjudul->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjudul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->kdjudul->caption(), $t_pelatihan_edit->kdjudul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_edit->tawal->Required) { ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->tawal->caption(), $t_pelatihan_edit->tawal->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_edit->takhir->Required) { ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->takhir->caption(), $t_pelatihan_edit->takhir->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_edit->kdprop->Required) { ?>
				elm = this.getElements("x" + infix + "_kdprop");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->kdprop->caption(), $t_pelatihan_edit->kdprop->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_edit->kdkota->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkota");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->kdkota->caption(), $t_pelatihan_edit->kdkota->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_edit->anggota2->Required) { ?>
				elm = this.getElements("x" + infix + "_anggota2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->anggota2->caption(), $t_pelatihan_edit->anggota2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_edit->widyaiswara->Required) { ?>
				elm = this.getElements("x" + infix + "_widyaiswara");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->widyaiswara->caption(), $t_pelatihan_edit->widyaiswara->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_widyaiswara");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_edit->widyaiswara->errorMessage()) ?>");
			<?php if ($t_pelatihan_edit->jenisevaluasi->Required) { ?>
				elm = this.getElements("x" + infix + "_jenisevaluasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->jenisevaluasi->caption(), $t_pelatihan_edit->jenisevaluasi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jenisevaluasi");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_edit->jenisevaluasi->errorMessage()) ?>");
			<?php if ($t_pelatihan_edit->updated_at->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->updated_at->caption(), $t_pelatihan_edit->updated_at->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_edit->user_updated_by->Required) { ?>
				elm = this.getElements("x" + infix + "_user_updated_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->user_updated_by->caption(), $t_pelatihan_edit->user_updated_by->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_edit->jenispel->Required) { ?>
				elm = this.getElements("x" + infix + "_jenispel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->jenispel->caption(), $t_pelatihan_edit->jenispel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_edit->dana->Required) { ?>
				elm = this.getElements("x" + infix + "_dana");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->dana->caption(), $t_pelatihan_edit->dana->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_edit->namaberkas->Required) { ?>
				felm = this.getElements("x" + infix + "_namaberkas");
				elm = this.getElements("fn_x" + infix + "_namaberkas");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->namaberkas->caption(), $t_pelatihan_edit->namaberkas->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_edit->statuspel->Required) { ?>
				elm = this.getElements("x" + infix + "_statuspel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->statuspel->caption(), $t_pelatihan_edit->statuspel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_edit->ket->Required) { ?>
				elm = this.getElements("x" + infix + "_ket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->ket->caption(), $t_pelatihan_edit->ket->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_edit->jpeserta->Required) { ?>
				elm = this.getElements("x" + infix + "_jpeserta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->jpeserta->caption(), $t_pelatihan_edit->jpeserta->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jpeserta");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_edit->jpeserta->errorMessage()) ?>");
			<?php if ($t_pelatihan_edit->real_peserta->Required) { ?>
				elm = this.getElements("x" + infix + "_real_peserta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->real_peserta->caption(), $t_pelatihan_edit->real_peserta->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_real_peserta");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_edit->real_peserta->errorMessage()) ?>");
			<?php if ($t_pelatihan_edit->independen->Required) { ?>
				elm = this.getElements("x" + infix + "_independen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->independen->caption(), $t_pelatihan_edit->independen->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_independen");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_edit->independen->errorMessage()) ?>");
			<?php if ($t_pelatihan_edit->swasta_k->Required) { ?>
				elm = this.getElements("x" + infix + "_swasta_k");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->swasta_k->caption(), $t_pelatihan_edit->swasta_k->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_swasta_k");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_edit->swasta_k->errorMessage()) ?>");
			<?php if ($t_pelatihan_edit->swasta_m->Required) { ?>
				elm = this.getElements("x" + infix + "_swasta_m");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->swasta_m->caption(), $t_pelatihan_edit->swasta_m->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_swasta_m");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_edit->swasta_m->errorMessage()) ?>");
			<?php if ($t_pelatihan_edit->swasta_b->Required) { ?>
				elm = this.getElements("x" + infix + "_swasta_b");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->swasta_b->caption(), $t_pelatihan_edit->swasta_b->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_swasta_b");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_edit->swasta_b->errorMessage()) ?>");
			<?php if ($t_pelatihan_edit->bumn->Required) { ?>
				elm = this.getElements("x" + infix + "_bumn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->bumn->caption(), $t_pelatihan_edit->bumn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_bumn");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_edit->bumn->errorMessage()) ?>");
			<?php if ($t_pelatihan_edit->koperasi->Required) { ?>
				elm = this.getElements("x" + infix + "_koperasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->koperasi->caption(), $t_pelatihan_edit->koperasi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_koperasi");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_edit->koperasi->errorMessage()) ?>");
			<?php if ($t_pelatihan_edit->pns->Required) { ?>
				elm = this.getElements("x" + infix + "_pns");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->pns->caption(), $t_pelatihan_edit->pns->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pns");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_edit->pns->errorMessage()) ?>");
			<?php if ($t_pelatihan_edit->pt_dosen->Required) { ?>
				elm = this.getElements("x" + infix + "_pt_dosen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->pt_dosen->caption(), $t_pelatihan_edit->pt_dosen->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pt_dosen");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_edit->pt_dosen->errorMessage()) ?>");
			<?php if ($t_pelatihan_edit->pt_mhs->Required) { ?>
				elm = this.getElements("x" + infix + "_pt_mhs");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->pt_mhs->caption(), $t_pelatihan_edit->pt_mhs->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pt_mhs");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_edit->pt_mhs->errorMessage()) ?>");
			<?php if ($t_pelatihan_edit->jk_l->Required) { ?>
				elm = this.getElements("x" + infix + "_jk_l");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->jk_l->caption(), $t_pelatihan_edit->jk_l->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jk_l");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_edit->jk_l->errorMessage()) ?>");
			<?php if ($t_pelatihan_edit->jk_p->Required) { ?>
				elm = this.getElements("x" + infix + "_jk_p");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->jk_p->caption(), $t_pelatihan_edit->jk_p->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jk_p");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_edit->jk_p->errorMessage()) ?>");
			<?php if ($t_pelatihan_edit->usia_k45->Required) { ?>
				elm = this.getElements("x" + infix + "_usia_k45");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->usia_k45->caption(), $t_pelatihan_edit->usia_k45->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_usia_k45");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_edit->usia_k45->errorMessage()) ?>");
			<?php if ($t_pelatihan_edit->usia_b45->Required) { ?>
				elm = this.getElements("x" + infix + "_usia_b45");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->usia_b45->caption(), $t_pelatihan_edit->usia_b45->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_usia_b45");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_pelatihan_edit->usia_b45->errorMessage()) ?>");
			<?php if ($t_pelatihan_edit->produk->Required) { ?>
				elm = this.getElements("x" + infix + "_produk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->produk->caption(), $t_pelatihan_edit->produk->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_edit->bbio->Required) { ?>
				felm = this.getElements("x" + infix + "_bbio");
				elm = this.getElements("fn_x" + infix + "_bbio");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->bbio->caption(), $t_pelatihan_edit->bbio->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_edit->bbio2->Required) { ?>
				felm = this.getElements("x" + infix + "_bbio2");
				elm = this.getElements("fn_x" + infix + "_bbio2");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->bbio2->caption(), $t_pelatihan_edit->bbio2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_edit->bbio3->Required) { ?>
				felm = this.getElements("x" + infix + "_bbio3");
				elm = this.getElements("fn_x" + infix + "_bbio3");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->bbio3->caption(), $t_pelatihan_edit->bbio3->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_edit->bbio4->Required) { ?>
				felm = this.getElements("x" + infix + "_bbio4");
				elm = this.getElements("fn_x" + infix + "_bbio4");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->bbio4->caption(), $t_pelatihan_edit->bbio4->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pelatihan_edit->bbio5->Required) { ?>
				felm = this.getElements("x" + infix + "_bbio5");
				elm = this.getElements("fn_x" + infix + "_bbio5");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_pelatihan_edit->bbio5->caption(), $t_pelatihan_edit->bbio5->RequiredErrorMessage)) ?>");
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
	ft_pelatihanedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_pelatihanedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Multi-Page
	ft_pelatihanedit.multiPage = new ew.MultiPage("ft_pelatihanedit");

	// Dynamic selection lists
	ft_pelatihanedit.lists["x_anggota2"] = <?php echo $t_pelatihan_edit->anggota2->Lookup->toClientList($t_pelatihan_edit) ?>;
	ft_pelatihanedit.lists["x_anggota2"].options = <?php echo JsonEncode($t_pelatihan_edit->anggota2->lookupOptions()) ?>;
	ft_pelatihanedit.autoSuggests["x_anggota2"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pelatihanedit.lists["x_widyaiswara"] = <?php echo $t_pelatihan_edit->widyaiswara->Lookup->toClientList($t_pelatihan_edit) ?>;
	ft_pelatihanedit.lists["x_widyaiswara"].options = <?php echo JsonEncode($t_pelatihan_edit->widyaiswara->lookupOptions()) ?>;
	ft_pelatihanedit.autoSuggests["x_widyaiswara"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pelatihanedit.lists["x_dana"] = <?php echo $t_pelatihan_edit->dana->Lookup->toClientList($t_pelatihan_edit) ?>;
	ft_pelatihanedit.lists["x_dana"].options = <?php echo JsonEncode($t_pelatihan_edit->dana->options(FALSE, TRUE)) ?>;
	ft_pelatihanedit.lists["x_statuspel"] = <?php echo $t_pelatihan_edit->statuspel->Lookup->toClientList($t_pelatihan_edit) ?>;
	ft_pelatihanedit.lists["x_statuspel"].options = <?php echo JsonEncode($t_pelatihan_edit->statuspel->options(FALSE, TRUE)) ?>;
	loadjs.done("ft_pelatihanedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_pelatihan_edit->showPageHeader(); ?>
<?php
$t_pelatihan_edit->showMessage();
?>
<form name="ft_pelatihanedit" id="ft_pelatihanedit" class="<?php echo $t_pelatihan_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_pelatihan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_pelatihan_edit->IsModal ?>">
<?php if ($t_pelatihan->getCurrentMasterTable() == "t_judul") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_judul">
<input type="hidden" name="fk_kdjudul" value="<?php echo HtmlEncode($t_pelatihan_edit->kdjudul->getSessionValue()) ?>">
<?php } ?>
<?php if ($t_pelatihan->getCurrentMasterTable() == "t_kota") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_kota">
<input type="hidden" name="fk_kdkota" value="<?php echo HtmlEncode($t_pelatihan_edit->kdkota->getSessionValue()) ?>">
<?php } ?>
<?php if ($t_pelatihan->getCurrentMasterTable() == "t_prop") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_prop">
<input type="hidden" name="fk_kdprop" value="<?php echo HtmlEncode($t_pelatihan_edit->kdprop->getSessionValue()) ?>">
<?php } ?>
<div class="ew-multi-page"><!-- multi-page -->
<div class="ew-nav-tabs" id="t_pelatihan_edit"><!-- multi-page tabs -->
	<ul class="<?php echo $t_pelatihan_edit->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $t_pelatihan_edit->MultiPages->pageStyle(1) ?>" href="#tab_t_pelatihan1" data-toggle="tab"><?php echo $t_pelatihan->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $t_pelatihan_edit->MultiPages->pageStyle(2) ?>" href="#tab_t_pelatihan2" data-toggle="tab"><?php echo $t_pelatihan->pageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page tabs .tab-content -->
		<div class="tab-pane<?php echo $t_pelatihan_edit->MultiPages->pageStyle(1) ?>" id="tab_t_pelatihan1"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_pelatihan_edit->idpelat->Visible) { // idpelat ?>
	<div id="r_idpelat" class="form-group row">
		<label id="elh_t_pelatihan_idpelat" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->idpelat->caption() ?><?php echo $t_pelatihan_edit->idpelat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->idpelat->cellAttributes() ?>>
<span id="el_t_pelatihan_idpelat">
<span<?php echo $t_pelatihan_edit->idpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_edit->idpelat->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_idpelat" data-page="1" name="x_idpelat" id="x_idpelat" value="<?php echo HtmlEncode($t_pelatihan_edit->idpelat->CurrentValue) ?>">
<?php echo $t_pelatihan_edit->idpelat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->kdpelat->Visible) { // kdpelat ?>
	<div id="r_kdpelat" class="form-group row">
		<label id="elh_t_pelatihan_kdpelat" for="x_kdpelat" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->kdpelat->caption() ?><?php echo $t_pelatihan_edit->kdpelat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->kdpelat->cellAttributes() ?>>
<span id="el_t_pelatihan_kdpelat">
<span<?php echo $t_pelatihan_edit->kdpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_edit->kdpelat->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_kdpelat" data-page="1" name="x_kdpelat" id="x_kdpelat" value="<?php echo HtmlEncode($t_pelatihan_edit->kdpelat->CurrentValue) ?>">
<?php echo $t_pelatihan_edit->kdpelat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->kdjudul->Visible) { // kdjudul ?>
	<div id="r_kdjudul" class="form-group row">
		<label id="elh_t_pelatihan_kdjudul" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->kdjudul->caption() ?><?php echo $t_pelatihan_edit->kdjudul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->kdjudul->cellAttributes() ?>>
<span id="el_t_pelatihan_kdjudul">
<span<?php echo $t_pelatihan_edit->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_edit->kdjudul->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_kdjudul" data-page="1" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($t_pelatihan_edit->kdjudul->CurrentValue) ?>">
<?php echo $t_pelatihan_edit->kdjudul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->tawal->Visible) { // tawal ?>
	<div id="r_tawal" class="form-group row">
		<label id="elh_t_pelatihan_tawal" for="x_tawal" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->tawal->caption() ?><?php echo $t_pelatihan_edit->tawal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->tawal->cellAttributes() ?>>
<span id="el_t_pelatihan_tawal">
<span<?php echo $t_pelatihan_edit->tawal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_edit->tawal->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_tawal" data-page="1" name="x_tawal" id="x_tawal" value="<?php echo HtmlEncode($t_pelatihan_edit->tawal->CurrentValue) ?>">
<?php echo $t_pelatihan_edit->tawal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->takhir->Visible) { // takhir ?>
	<div id="r_takhir" class="form-group row">
		<label id="elh_t_pelatihan_takhir" for="x_takhir" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->takhir->caption() ?><?php echo $t_pelatihan_edit->takhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->takhir->cellAttributes() ?>>
<span id="el_t_pelatihan_takhir">
<span<?php echo $t_pelatihan_edit->takhir->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_edit->takhir->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_takhir" data-page="1" name="x_takhir" id="x_takhir" value="<?php echo HtmlEncode($t_pelatihan_edit->takhir->CurrentValue) ?>">
<?php echo $t_pelatihan_edit->takhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->kdprop->Visible) { // kdprop ?>
	<div id="r_kdprop" class="form-group row">
		<label id="elh_t_pelatihan_kdprop" for="x_kdprop" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->kdprop->caption() ?><?php echo $t_pelatihan_edit->kdprop->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->kdprop->cellAttributes() ?>>
<span id="el_t_pelatihan_kdprop">
<span<?php echo $t_pelatihan_edit->kdprop->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_edit->kdprop->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_kdprop" data-page="1" name="x_kdprop" id="x_kdprop" value="<?php echo HtmlEncode($t_pelatihan_edit->kdprop->CurrentValue) ?>">
<?php echo $t_pelatihan_edit->kdprop->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->kdkota->Visible) { // kdkota ?>
	<div id="r_kdkota" class="form-group row">
		<label id="elh_t_pelatihan_kdkota" for="x_kdkota" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->kdkota->caption() ?><?php echo $t_pelatihan_edit->kdkota->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->kdkota->cellAttributes() ?>>
<span id="el_t_pelatihan_kdkota">
<span<?php echo $t_pelatihan_edit->kdkota->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_edit->kdkota->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_kdkota" data-page="1" name="x_kdkota" id="x_kdkota" value="<?php echo HtmlEncode($t_pelatihan_edit->kdkota->CurrentValue) ?>">
<?php echo $t_pelatihan_edit->kdkota->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->anggota2->Visible) { // anggota2 ?>
	<div id="r_anggota2" class="form-group row">
		<label id="elh_t_pelatihan_anggota2" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->anggota2->caption() ?><?php echo $t_pelatihan_edit->anggota2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->anggota2->cellAttributes() ?>>
<span id="el_t_pelatihan_anggota2">
<?php
$onchange = $t_pelatihan_edit->anggota2->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_edit->anggota2->EditAttrs["onchange"] = "";
?>
<span id="as_x_anggota2">
	<input type="text" class="form-control" name="sv_x_anggota2" id="sv_x_anggota2" value="<?php echo RemoveHtml($t_pelatihan_edit->anggota2->EditValue) ?>" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($t_pelatihan_edit->anggota2->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_edit->anggota2->getPlaceHolder()) ?>"<?php echo $t_pelatihan_edit->anggota2->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_anggota2" data-page="1" data-value-separator="<?php echo $t_pelatihan_edit->anggota2->displayValueSeparatorAttribute() ?>" name="x_anggota2" id="x_anggota2" value="<?php echo HtmlEncode($t_pelatihan_edit->anggota2->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihanedit"], function() {
	ft_pelatihanedit.createAutoSuggest({"id":"x_anggota2","forceSelect":false});
});
</script>
<?php echo $t_pelatihan_edit->anggota2->Lookup->getParamTag($t_pelatihan_edit, "p_x_anggota2") ?>
</span>
<?php echo $t_pelatihan_edit->anggota2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->widyaiswara->Visible) { // widyaiswara ?>
	<div id="r_widyaiswara" class="form-group row">
		<label id="elh_t_pelatihan_widyaiswara" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->widyaiswara->caption() ?><?php echo $t_pelatihan_edit->widyaiswara->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->widyaiswara->cellAttributes() ?>>
<span id="el_t_pelatihan_widyaiswara">
<?php
$onchange = $t_pelatihan_edit->widyaiswara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_pelatihan_edit->widyaiswara->EditAttrs["onchange"] = "";
?>
<span id="as_x_widyaiswara">
	<input type="text" class="form-control" name="sv_x_widyaiswara" id="sv_x_widyaiswara" value="<?php echo RemoveHtml($t_pelatihan_edit->widyaiswara->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($t_pelatihan_edit->widyaiswara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_pelatihan_edit->widyaiswara->getPlaceHolder()) ?>"<?php echo $t_pelatihan_edit->widyaiswara->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_widyaiswara" data-page="1" data-value-separator="<?php echo $t_pelatihan_edit->widyaiswara->displayValueSeparatorAttribute() ?>" name="x_widyaiswara" id="x_widyaiswara" value="<?php echo HtmlEncode($t_pelatihan_edit->widyaiswara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pelatihanedit"], function() {
	ft_pelatihanedit.createAutoSuggest({"id":"x_widyaiswara","forceSelect":true});
});
</script>
<?php echo $t_pelatihan_edit->widyaiswara->Lookup->getParamTag($t_pelatihan_edit, "p_x_widyaiswara") ?>
</span>
<?php echo $t_pelatihan_edit->widyaiswara->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->jenisevaluasi->Visible) { // jenisevaluasi ?>
	<div id="r_jenisevaluasi" class="form-group row">
		<label id="elh_t_pelatihan_jenisevaluasi" for="x_jenisevaluasi" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->jenisevaluasi->caption() ?><?php echo $t_pelatihan_edit->jenisevaluasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->jenisevaluasi->cellAttributes() ?>>
<span id="el_t_pelatihan_jenisevaluasi">
<input type="text" data-table="t_pelatihan" data-field="x_jenisevaluasi" data-page="1" name="x_jenisevaluasi" id="x_jenisevaluasi" size="30" placeholder="<?php echo HtmlEncode($t_pelatihan_edit->jenisevaluasi->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_edit->jenisevaluasi->EditValue ?>"<?php echo $t_pelatihan_edit->jenisevaluasi->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_edit->jenisevaluasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->jenispel->Visible) { // jenispel ?>
	<div id="r_jenispel" class="form-group row">
		<label id="elh_t_pelatihan_jenispel" for="x_jenispel" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->jenispel->caption() ?><?php echo $t_pelatihan_edit->jenispel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->jenispel->cellAttributes() ?>>
<span id="el_t_pelatihan_jenispel">
<span<?php echo $t_pelatihan_edit->jenispel->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pelatihan_edit->jenispel->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pelatihan" data-field="x_jenispel" data-page="1" name="x_jenispel" id="x_jenispel" value="<?php echo HtmlEncode($t_pelatihan_edit->jenispel->CurrentValue) ?>">
<?php echo $t_pelatihan_edit->jenispel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->dana->Visible) { // dana ?>
	<div id="r_dana" class="form-group row">
		<label id="elh_t_pelatihan_dana" for="x_dana" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->dana->caption() ?><?php echo $t_pelatihan_edit->dana->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->dana->cellAttributes() ?>>
<span id="el_t_pelatihan_dana">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_dana" data-page="1" data-value-separator="<?php echo $t_pelatihan_edit->dana->displayValueSeparatorAttribute() ?>" id="x_dana" name="x_dana"<?php echo $t_pelatihan_edit->dana->editAttributes() ?>>
			<?php echo $t_pelatihan_edit->dana->selectOptionListHtml("x_dana") ?>
		</select>
</div>
</span>
<?php echo $t_pelatihan_edit->dana->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->namaberkas->Visible) { // namaberkas ?>
	<div id="r_namaberkas" class="form-group row">
		<label id="elh_t_pelatihan_namaberkas" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->namaberkas->caption() ?><?php echo $t_pelatihan_edit->namaberkas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->namaberkas->cellAttributes() ?>>
<span id="el_t_pelatihan_namaberkas">
<div id="fd_x_namaberkas">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pelatihan_edit->namaberkas->title() ?>" data-table="t_pelatihan" data-field="x_namaberkas" data-page="1" name="x_namaberkas" id="x_namaberkas" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pelatihan_edit->namaberkas->editAttributes() ?><?php if ($t_pelatihan_edit->namaberkas->ReadOnly || $t_pelatihan_edit->namaberkas->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_namaberkas"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_namaberkas" id= "fn_x_namaberkas" value="<?php echo $t_pelatihan_edit->namaberkas->Upload->FileName ?>">
<input type="hidden" name="fa_x_namaberkas" id= "fa_x_namaberkas" value="<?php echo (Post("fa_x_namaberkas") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_namaberkas" id= "fs_x_namaberkas" value="255">
<input type="hidden" name="fx_x_namaberkas" id= "fx_x_namaberkas" value="<?php echo $t_pelatihan_edit->namaberkas->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_namaberkas" id= "fm_x_namaberkas" value="<?php echo $t_pelatihan_edit->namaberkas->UploadMaxFileSize ?>">
</div>
<table id="ft_x_namaberkas" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_pelatihan_edit->namaberkas->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->statuspel->Visible) { // statuspel ?>
	<div id="r_statuspel" class="form-group row">
		<label id="elh_t_pelatihan_statuspel" for="x_statuspel" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->statuspel->caption() ?><?php echo $t_pelatihan_edit->statuspel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->statuspel->cellAttributes() ?>>
<span id="el_t_pelatihan_statuspel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pelatihan" data-field="x_statuspel" data-page="1" data-value-separator="<?php echo $t_pelatihan_edit->statuspel->displayValueSeparatorAttribute() ?>" id="x_statuspel" name="x_statuspel"<?php echo $t_pelatihan_edit->statuspel->editAttributes() ?>>
			<?php echo $t_pelatihan_edit->statuspel->selectOptionListHtml("x_statuspel") ?>
		</select>
</div>
</span>
<?php echo $t_pelatihan_edit->statuspel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->ket->Visible) { // ket ?>
	<div id="r_ket" class="form-group row">
		<label id="elh_t_pelatihan_ket" for="x_ket" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->ket->caption() ?><?php echo $t_pelatihan_edit->ket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->ket->cellAttributes() ?>>
<span id="el_t_pelatihan_ket">
<textarea data-table="t_pelatihan" data-field="x_ket" data-page="1" name="x_ket" id="x_ket" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_pelatihan_edit->ket->getPlaceHolder()) ?>"<?php echo $t_pelatihan_edit->ket->editAttributes() ?>><?php echo $t_pelatihan_edit->ket->EditValue ?></textarea>
</span>
<?php echo $t_pelatihan_edit->ket->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->jpeserta->Visible) { // jpeserta ?>
	<div id="r_jpeserta" class="form-group row">
		<label id="elh_t_pelatihan_jpeserta" for="x_jpeserta" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->jpeserta->caption() ?><?php echo $t_pelatihan_edit->jpeserta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->jpeserta->cellAttributes() ?>>
<span id="el_t_pelatihan_jpeserta">
<input type="text" data-table="t_pelatihan" data-field="x_jpeserta" data-page="1" name="x_jpeserta" id="x_jpeserta" size="30" maxlength="21" placeholder="<?php echo HtmlEncode($t_pelatihan_edit->jpeserta->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_edit->jpeserta->EditValue ?>"<?php echo $t_pelatihan_edit->jpeserta->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_edit->jpeserta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->bbio->Visible) { // bbio ?>
	<div id="r_bbio" class="form-group row">
		<label id="elh_t_pelatihan_bbio" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->bbio->caption() ?><?php echo $t_pelatihan_edit->bbio->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->bbio->cellAttributes() ?>>
<span id="el_t_pelatihan_bbio">
<div id="fd_x_bbio">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pelatihan_edit->bbio->title() ?>" data-table="t_pelatihan" data-field="x_bbio" data-page="1" name="x_bbio" id="x_bbio" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pelatihan_edit->bbio->editAttributes() ?><?php if ($t_pelatihan_edit->bbio->ReadOnly || $t_pelatihan_edit->bbio->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_bbio"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_bbio" id= "fn_x_bbio" value="<?php echo $t_pelatihan_edit->bbio->Upload->FileName ?>">
<input type="hidden" name="fa_x_bbio" id= "fa_x_bbio" value="<?php echo (Post("fa_x_bbio") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_bbio" id= "fs_x_bbio" value="255">
<input type="hidden" name="fx_x_bbio" id= "fx_x_bbio" value="<?php echo $t_pelatihan_edit->bbio->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bbio" id= "fm_x_bbio" value="<?php echo $t_pelatihan_edit->bbio->UploadMaxFileSize ?>">
</div>
<table id="ft_x_bbio" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_pelatihan_edit->bbio->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->bbio2->Visible) { // bbio2 ?>
	<div id="r_bbio2" class="form-group row">
		<label id="elh_t_pelatihan_bbio2" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->bbio2->caption() ?><?php echo $t_pelatihan_edit->bbio2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->bbio2->cellAttributes() ?>>
<span id="el_t_pelatihan_bbio2">
<div id="fd_x_bbio2">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pelatihan_edit->bbio2->title() ?>" data-table="t_pelatihan" data-field="x_bbio2" data-page="1" name="x_bbio2" id="x_bbio2" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pelatihan_edit->bbio2->editAttributes() ?><?php if ($t_pelatihan_edit->bbio2->ReadOnly || $t_pelatihan_edit->bbio2->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_bbio2"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_bbio2" id= "fn_x_bbio2" value="<?php echo $t_pelatihan_edit->bbio2->Upload->FileName ?>">
<input type="hidden" name="fa_x_bbio2" id= "fa_x_bbio2" value="<?php echo (Post("fa_x_bbio2") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_bbio2" id= "fs_x_bbio2" value="255">
<input type="hidden" name="fx_x_bbio2" id= "fx_x_bbio2" value="<?php echo $t_pelatihan_edit->bbio2->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bbio2" id= "fm_x_bbio2" value="<?php echo $t_pelatihan_edit->bbio2->UploadMaxFileSize ?>">
</div>
<table id="ft_x_bbio2" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_pelatihan_edit->bbio2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->bbio3->Visible) { // bbio3 ?>
	<div id="r_bbio3" class="form-group row">
		<label id="elh_t_pelatihan_bbio3" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->bbio3->caption() ?><?php echo $t_pelatihan_edit->bbio3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->bbio3->cellAttributes() ?>>
<span id="el_t_pelatihan_bbio3">
<div id="fd_x_bbio3">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pelatihan_edit->bbio3->title() ?>" data-table="t_pelatihan" data-field="x_bbio3" data-page="1" name="x_bbio3" id="x_bbio3" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pelatihan_edit->bbio3->editAttributes() ?><?php if ($t_pelatihan_edit->bbio3->ReadOnly || $t_pelatihan_edit->bbio3->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_bbio3"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_bbio3" id= "fn_x_bbio3" value="<?php echo $t_pelatihan_edit->bbio3->Upload->FileName ?>">
<input type="hidden" name="fa_x_bbio3" id= "fa_x_bbio3" value="<?php echo (Post("fa_x_bbio3") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_bbio3" id= "fs_x_bbio3" value="255">
<input type="hidden" name="fx_x_bbio3" id= "fx_x_bbio3" value="<?php echo $t_pelatihan_edit->bbio3->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bbio3" id= "fm_x_bbio3" value="<?php echo $t_pelatihan_edit->bbio3->UploadMaxFileSize ?>">
</div>
<table id="ft_x_bbio3" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_pelatihan_edit->bbio3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->bbio4->Visible) { // bbio4 ?>
	<div id="r_bbio4" class="form-group row">
		<label id="elh_t_pelatihan_bbio4" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->bbio4->caption() ?><?php echo $t_pelatihan_edit->bbio4->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->bbio4->cellAttributes() ?>>
<span id="el_t_pelatihan_bbio4">
<div id="fd_x_bbio4">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pelatihan_edit->bbio4->title() ?>" data-table="t_pelatihan" data-field="x_bbio4" data-page="1" name="x_bbio4" id="x_bbio4" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pelatihan_edit->bbio4->editAttributes() ?><?php if ($t_pelatihan_edit->bbio4->ReadOnly || $t_pelatihan_edit->bbio4->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_bbio4"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_bbio4" id= "fn_x_bbio4" value="<?php echo $t_pelatihan_edit->bbio4->Upload->FileName ?>">
<input type="hidden" name="fa_x_bbio4" id= "fa_x_bbio4" value="<?php echo (Post("fa_x_bbio4") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_bbio4" id= "fs_x_bbio4" value="255">
<input type="hidden" name="fx_x_bbio4" id= "fx_x_bbio4" value="<?php echo $t_pelatihan_edit->bbio4->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bbio4" id= "fm_x_bbio4" value="<?php echo $t_pelatihan_edit->bbio4->UploadMaxFileSize ?>">
</div>
<table id="ft_x_bbio4" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_pelatihan_edit->bbio4->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->bbio5->Visible) { // bbio5 ?>
	<div id="r_bbio5" class="form-group row">
		<label id="elh_t_pelatihan_bbio5" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->bbio5->caption() ?><?php echo $t_pelatihan_edit->bbio5->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->bbio5->cellAttributes() ?>>
<span id="el_t_pelatihan_bbio5">
<div id="fd_x_bbio5">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_pelatihan_edit->bbio5->title() ?>" data-table="t_pelatihan" data-field="x_bbio5" data-page="1" name="x_bbio5" id="x_bbio5" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_pelatihan_edit->bbio5->editAttributes() ?><?php if ($t_pelatihan_edit->bbio5->ReadOnly || $t_pelatihan_edit->bbio5->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_bbio5"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_bbio5" id= "fn_x_bbio5" value="<?php echo $t_pelatihan_edit->bbio5->Upload->FileName ?>">
<input type="hidden" name="fa_x_bbio5" id= "fa_x_bbio5" value="<?php echo (Post("fa_x_bbio5") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_bbio5" id= "fs_x_bbio5" value="255">
<input type="hidden" name="fx_x_bbio5" id= "fx_x_bbio5" value="<?php echo $t_pelatihan_edit->bbio5->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bbio5" id= "fm_x_bbio5" value="<?php echo $t_pelatihan_edit->bbio5->UploadMaxFileSize ?>">
</div>
<table id="ft_x_bbio5" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_pelatihan_edit->bbio5->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $t_pelatihan_edit->MultiPages->pageStyle(2) ?>" id="tab_t_pelatihan2"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_pelatihan_edit->real_peserta->Visible) { // real_peserta ?>
	<div id="r_real_peserta" class="form-group row">
		<label id="elh_t_pelatihan_real_peserta" for="x_real_peserta" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->real_peserta->caption() ?><?php echo $t_pelatihan_edit->real_peserta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->real_peserta->cellAttributes() ?>>
<span id="el_t_pelatihan_real_peserta">
<input type="text" data-table="t_pelatihan" data-field="x_real_peserta" data-page="2" name="x_real_peserta" id="x_real_peserta" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_edit->real_peserta->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_edit->real_peserta->EditValue ?>"<?php echo $t_pelatihan_edit->real_peserta->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_edit->real_peserta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->independen->Visible) { // independen ?>
	<div id="r_independen" class="form-group row">
		<label id="elh_t_pelatihan_independen" for="x_independen" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->independen->caption() ?><?php echo $t_pelatihan_edit->independen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->independen->cellAttributes() ?>>
<span id="el_t_pelatihan_independen">
<input type="text" data-table="t_pelatihan" data-field="x_independen" data-page="2" name="x_independen" id="x_independen" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_edit->independen->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_edit->independen->EditValue ?>"<?php echo $t_pelatihan_edit->independen->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_edit->independen->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->swasta_k->Visible) { // swasta_k ?>
	<div id="r_swasta_k" class="form-group row">
		<label id="elh_t_pelatihan_swasta_k" for="x_swasta_k" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->swasta_k->caption() ?><?php echo $t_pelatihan_edit->swasta_k->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->swasta_k->cellAttributes() ?>>
<span id="el_t_pelatihan_swasta_k">
<input type="text" data-table="t_pelatihan" data-field="x_swasta_k" data-page="2" name="x_swasta_k" id="x_swasta_k" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_edit->swasta_k->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_edit->swasta_k->EditValue ?>"<?php echo $t_pelatihan_edit->swasta_k->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_edit->swasta_k->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->swasta_m->Visible) { // swasta_m ?>
	<div id="r_swasta_m" class="form-group row">
		<label id="elh_t_pelatihan_swasta_m" for="x_swasta_m" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->swasta_m->caption() ?><?php echo $t_pelatihan_edit->swasta_m->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->swasta_m->cellAttributes() ?>>
<span id="el_t_pelatihan_swasta_m">
<input type="text" data-table="t_pelatihan" data-field="x_swasta_m" data-page="2" name="x_swasta_m" id="x_swasta_m" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_edit->swasta_m->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_edit->swasta_m->EditValue ?>"<?php echo $t_pelatihan_edit->swasta_m->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_edit->swasta_m->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->swasta_b->Visible) { // swasta_b ?>
	<div id="r_swasta_b" class="form-group row">
		<label id="elh_t_pelatihan_swasta_b" for="x_swasta_b" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->swasta_b->caption() ?><?php echo $t_pelatihan_edit->swasta_b->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->swasta_b->cellAttributes() ?>>
<span id="el_t_pelatihan_swasta_b">
<input type="text" data-table="t_pelatihan" data-field="x_swasta_b" data-page="2" name="x_swasta_b" id="x_swasta_b" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_edit->swasta_b->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_edit->swasta_b->EditValue ?>"<?php echo $t_pelatihan_edit->swasta_b->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_edit->swasta_b->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->bumn->Visible) { // bumn ?>
	<div id="r_bumn" class="form-group row">
		<label id="elh_t_pelatihan_bumn" for="x_bumn" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->bumn->caption() ?><?php echo $t_pelatihan_edit->bumn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->bumn->cellAttributes() ?>>
<span id="el_t_pelatihan_bumn">
<input type="text" data-table="t_pelatihan" data-field="x_bumn" data-page="2" name="x_bumn" id="x_bumn" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_edit->bumn->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_edit->bumn->EditValue ?>"<?php echo $t_pelatihan_edit->bumn->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_edit->bumn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->koperasi->Visible) { // koperasi ?>
	<div id="r_koperasi" class="form-group row">
		<label id="elh_t_pelatihan_koperasi" for="x_koperasi" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->koperasi->caption() ?><?php echo $t_pelatihan_edit->koperasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->koperasi->cellAttributes() ?>>
<span id="el_t_pelatihan_koperasi">
<input type="text" data-table="t_pelatihan" data-field="x_koperasi" data-page="2" name="x_koperasi" id="x_koperasi" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_edit->koperasi->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_edit->koperasi->EditValue ?>"<?php echo $t_pelatihan_edit->koperasi->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_edit->koperasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->pns->Visible) { // pns ?>
	<div id="r_pns" class="form-group row">
		<label id="elh_t_pelatihan_pns" for="x_pns" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->pns->caption() ?><?php echo $t_pelatihan_edit->pns->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->pns->cellAttributes() ?>>
<span id="el_t_pelatihan_pns">
<input type="text" data-table="t_pelatihan" data-field="x_pns" data-page="2" name="x_pns" id="x_pns" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_edit->pns->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_edit->pns->EditValue ?>"<?php echo $t_pelatihan_edit->pns->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_edit->pns->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->pt_dosen->Visible) { // pt_dosen ?>
	<div id="r_pt_dosen" class="form-group row">
		<label id="elh_t_pelatihan_pt_dosen" for="x_pt_dosen" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->pt_dosen->caption() ?><?php echo $t_pelatihan_edit->pt_dosen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->pt_dosen->cellAttributes() ?>>
<span id="el_t_pelatihan_pt_dosen">
<input type="text" data-table="t_pelatihan" data-field="x_pt_dosen" data-page="2" name="x_pt_dosen" id="x_pt_dosen" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_edit->pt_dosen->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_edit->pt_dosen->EditValue ?>"<?php echo $t_pelatihan_edit->pt_dosen->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_edit->pt_dosen->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->pt_mhs->Visible) { // pt_mhs ?>
	<div id="r_pt_mhs" class="form-group row">
		<label id="elh_t_pelatihan_pt_mhs" for="x_pt_mhs" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->pt_mhs->caption() ?><?php echo $t_pelatihan_edit->pt_mhs->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->pt_mhs->cellAttributes() ?>>
<span id="el_t_pelatihan_pt_mhs">
<input type="text" data-table="t_pelatihan" data-field="x_pt_mhs" data-page="2" name="x_pt_mhs" id="x_pt_mhs" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_edit->pt_mhs->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_edit->pt_mhs->EditValue ?>"<?php echo $t_pelatihan_edit->pt_mhs->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_edit->pt_mhs->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->jk_l->Visible) { // jk_l ?>
	<div id="r_jk_l" class="form-group row">
		<label id="elh_t_pelatihan_jk_l" for="x_jk_l" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->jk_l->caption() ?><?php echo $t_pelatihan_edit->jk_l->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->jk_l->cellAttributes() ?>>
<span id="el_t_pelatihan_jk_l">
<input type="text" data-table="t_pelatihan" data-field="x_jk_l" data-page="2" name="x_jk_l" id="x_jk_l" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_edit->jk_l->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_edit->jk_l->EditValue ?>"<?php echo $t_pelatihan_edit->jk_l->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_edit->jk_l->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->jk_p->Visible) { // jk_p ?>
	<div id="r_jk_p" class="form-group row">
		<label id="elh_t_pelatihan_jk_p" for="x_jk_p" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->jk_p->caption() ?><?php echo $t_pelatihan_edit->jk_p->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->jk_p->cellAttributes() ?>>
<span id="el_t_pelatihan_jk_p">
<input type="text" data-table="t_pelatihan" data-field="x_jk_p" data-page="2" name="x_jk_p" id="x_jk_p" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_edit->jk_p->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_edit->jk_p->EditValue ?>"<?php echo $t_pelatihan_edit->jk_p->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_edit->jk_p->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->usia_k45->Visible) { // usia_k45 ?>
	<div id="r_usia_k45" class="form-group row">
		<label id="elh_t_pelatihan_usia_k45" for="x_usia_k45" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->usia_k45->caption() ?><?php echo $t_pelatihan_edit->usia_k45->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->usia_k45->cellAttributes() ?>>
<span id="el_t_pelatihan_usia_k45">
<input type="text" data-table="t_pelatihan" data-field="x_usia_k45" data-page="2" name="x_usia_k45" id="x_usia_k45" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_edit->usia_k45->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_edit->usia_k45->EditValue ?>"<?php echo $t_pelatihan_edit->usia_k45->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_edit->usia_k45->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->usia_b45->Visible) { // usia_b45 ?>
	<div id="r_usia_b45" class="form-group row">
		<label id="elh_t_pelatihan_usia_b45" for="x_usia_b45" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->usia_b45->caption() ?><?php echo $t_pelatihan_edit->usia_b45->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->usia_b45->cellAttributes() ?>>
<span id="el_t_pelatihan_usia_b45">
<input type="text" data-table="t_pelatihan" data-field="x_usia_b45" data-page="2" name="x_usia_b45" id="x_usia_b45" size="3" maxlength="3" placeholder="<?php echo HtmlEncode($t_pelatihan_edit->usia_b45->getPlaceHolder()) ?>" value="<?php echo $t_pelatihan_edit->usia_b45->EditValue ?>"<?php echo $t_pelatihan_edit->usia_b45->editAttributes() ?>>
</span>
<?php echo $t_pelatihan_edit->usia_b45->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pelatihan_edit->produk->Visible) { // produk ?>
	<div id="r_produk" class="form-group row">
		<label id="elh_t_pelatihan_produk" for="x_produk" class="<?php echo $t_pelatihan_edit->LeftColumnClass ?>"><?php echo $t_pelatihan_edit->produk->caption() ?><?php echo $t_pelatihan_edit->produk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pelatihan_edit->RightColumnClass ?>"><div <?php echo $t_pelatihan_edit->produk->cellAttributes() ?>>
<span id="el_t_pelatihan_produk">
<textarea data-table="t_pelatihan" data-field="x_produk" data-page="2" name="x_produk" id="x_produk" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_pelatihan_edit->produk->getPlaceHolder()) ?>"<?php echo $t_pelatihan_edit->produk->editAttributes() ?>><?php echo $t_pelatihan_edit->produk->EditValue ?></textarea>
</span>
<?php echo $t_pelatihan_edit->produk->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page tabs .tab-content -->
</div><!-- /multi-page tabs -->
</div><!-- /multi-page -->
<?php
	if (in_array("cv_historipeserta", explode(",", $t_pelatihan->getCurrentDetailTable())) && $cv_historipeserta->DetailEdit) {
?>
<?php if ($t_pelatihan->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("cv_historipeserta", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "cv_historipesertagrid.php" ?>
<?php } ?>
<?php
	if (in_array("cv_historiinstruktur", explode(",", $t_pelatihan->getCurrentDetailTable())) && $cv_historiinstruktur->DetailEdit) {
?>
<?php if ($t_pelatihan->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("cv_historiinstruktur", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "cv_historiinstrukturgrid.php" ?>
<?php } ?>
<?php
	if (in_array("t_jadwalpel", explode(",", $t_pelatihan->getCurrentDetailTable())) && $t_jadwalpel->DetailEdit) {
?>
<?php if ($t_pelatihan->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("t_jadwalpel", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "t_jadwalpelgrid.php" ?>
<?php } ?>
<?php if (!$t_pelatihan_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_pelatihan_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_pelatihan_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_pelatihan_edit->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// document.write("page loaded");

	$("#r_idpelat").hide();
	<?php if(CurrentPage()->coachingprogr->CurrentValue <> 1){ ?>
	$("#r_area").hide();
	$("#r_periode_awal").hide();
	$("#r_periode_akhir").hide();
	$("#r_tahapan").hide();
	<?php } ?>
});
</script>
<?php include_once "footer.php"; ?>
<?php
$t_pelatihan_edit->terminate();
?>