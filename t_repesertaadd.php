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
$t_repeserta_add = new t_repeserta_add();

// Run the page
$t_repeserta_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_repeserta_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_repesertaadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_repesertaadd = currentForm = new ew.Form("ft_repesertaadd", "add");

	// Validate form
	ft_repesertaadd.validate = function() {
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
			<?php if ($t_repeserta_add->idpelat->Required) { ?>
				elm = this.getElements("x" + infix + "_idpelat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_add->idpelat->caption(), $t_repeserta_add->idpelat->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_idpelat");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_repeserta_add->idpelat->errorMessage()) ?>");
			<?php if ($t_repeserta_add->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_add->nama->caption(), $t_repeserta_add->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_add->perusahaan->Required) { ?>
				elm = this.getElements("x" + infix + "_perusahaan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_add->perusahaan->caption(), $t_repeserta_add->perusahaan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_add->jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_add->jabatan->caption(), $t_repeserta_add->jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_add->tgl_daftar->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_daftar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_add->tgl_daftar->caption(), $t_repeserta_add->tgl_daftar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_daftar");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_repeserta_add->tgl_daftar->errorMessage()) ?>");
			<?php if ($t_repeserta_add->telp->Required) { ?>
				elm = this.getElements("x" + infix + "_telp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_add->telp->caption(), $t_repeserta_add->telp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_add->fax->Required) { ?>
				elm = this.getElements("x" + infix + "_fax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_add->fax->caption(), $t_repeserta_add->fax->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_add->hp->Required) { ?>
				elm = this.getElements("x" + infix + "_hp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_add->hp->caption(), $t_repeserta_add->hp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_add->produk->Required) { ?>
				elm = this.getElements("x" + infix + "_produk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_add->produk->caption(), $t_repeserta_add->produk->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_add->cara_bayar->Required) { ?>
				elm = this.getElements("x" + infix + "_cara_bayar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_add->cara_bayar->caption(), $t_repeserta_add->cara_bayar->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_add->ket_bayar->Required) { ?>
				elm = this.getElements("x" + infix + "_ket_bayar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_add->ket_bayar->caption(), $t_repeserta_add->ket_bayar->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_add->tgl_bayar->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_bayar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_add->tgl_bayar->caption(), $t_repeserta_add->tgl_bayar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_bayar");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_repeserta_add->tgl_bayar->errorMessage()) ?>");
			<?php if ($t_repeserta_add->kdinformasi->Required) { ?>
				elm = this.getElements("x" + infix + "_kdinformasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_add->kdinformasi->caption(), $t_repeserta_add->kdinformasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_add->konfirmasi->Required) { ?>
				elm = this.getElements("x" + infix + "_konfirmasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_add->konfirmasi->caption(), $t_repeserta_add->konfirmasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_add->ket->Required) { ?>
				elm = this.getElements("x" + infix + "_ket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_add->ket->caption(), $t_repeserta_add->ket->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_add->created_at->Required) { ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_add->created_at->caption(), $t_repeserta_add->created_at->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_add->ket_lainnya->Required) { ?>
				elm = this.getElements("x" + infix + "_ket_lainnya");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_add->ket_lainnya->caption(), $t_repeserta_add->ket_lainnya->RequiredErrorMessage)) ?>");
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
	ft_repesertaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_repesertaadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_repesertaadd.lists["x_idpelat"] = <?php echo $t_repeserta_add->idpelat->Lookup->toClientList($t_repeserta_add) ?>;
	ft_repesertaadd.lists["x_idpelat"].options = <?php echo JsonEncode($t_repeserta_add->idpelat->lookupOptions()) ?>;
	ft_repesertaadd.autoSuggests["x_idpelat"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_repesertaadd.lists["x_jabatan"] = <?php echo $t_repeserta_add->jabatan->Lookup->toClientList($t_repeserta_add) ?>;
	ft_repesertaadd.lists["x_jabatan"].options = <?php echo JsonEncode($t_repeserta_add->jabatan->lookupOptions()) ?>;
	ft_repesertaadd.autoSuggests["x_jabatan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_repesertaadd.lists["x_cara_bayar"] = <?php echo $t_repeserta_add->cara_bayar->Lookup->toClientList($t_repeserta_add) ?>;
	ft_repesertaadd.lists["x_cara_bayar"].options = <?php echo JsonEncode($t_repeserta_add->cara_bayar->options(FALSE, TRUE)) ?>;
	ft_repesertaadd.lists["x_kdinformasi"] = <?php echo $t_repeserta_add->kdinformasi->Lookup->toClientList($t_repeserta_add) ?>;
	ft_repesertaadd.lists["x_kdinformasi"].options = <?php echo JsonEncode($t_repeserta_add->kdinformasi->lookupOptions()) ?>;
	ft_repesertaadd.lists["x_konfirmasi"] = <?php echo $t_repeserta_add->konfirmasi->Lookup->toClientList($t_repeserta_add) ?>;
	ft_repesertaadd.lists["x_konfirmasi"].options = <?php echo JsonEncode($t_repeserta_add->konfirmasi->options(FALSE, TRUE)) ?>;
	ft_repesertaadd.lists["x_ket"] = <?php echo $t_repeserta_add->ket->Lookup->toClientList($t_repeserta_add) ?>;
	ft_repesertaadd.lists["x_ket"].options = <?php echo JsonEncode($t_repeserta_add->ket->options(FALSE, TRUE)) ?>;
	loadjs.done("ft_repesertaadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//document.write('<?php echo cs_judul("add","Menambah Data Rekrutmen Peserta");?>');

});
</script>
<?php $t_repeserta_add->showPageHeader(); ?>
<?php
$t_repeserta_add->showMessage();
?>
<form name="ft_repesertaadd" id="ft_repesertaadd" class="<?php echo $t_repeserta_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_repeserta">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_repeserta_add->IsModal ?>">
<?php if ($t_repeserta->getCurrentMasterTable() == "cv_pelrepes") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="cv_pelrepes">
<input type="hidden" name="fk_idpelat" value="<?php echo HtmlEncode($t_repeserta_add->idpelat->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($t_repeserta_add->idpelat->Visible) { // idpelat ?>
	<div id="r_idpelat" class="form-group row">
		<label id="elh_t_repeserta_idpelat" class="<?php echo $t_repeserta_add->LeftColumnClass ?>"><?php echo $t_repeserta_add->idpelat->caption() ?><?php echo $t_repeserta_add->idpelat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_add->RightColumnClass ?>"><div <?php echo $t_repeserta_add->idpelat->cellAttributes() ?>>
<?php if ($t_repeserta_add->idpelat->getSessionValue() != "") { ?>
<span id="el_t_repeserta_idpelat">
<span<?php echo $t_repeserta_add->idpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_repeserta_add->idpelat->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_idpelat" name="x_idpelat" value="<?php echo HtmlEncode($t_repeserta_add->idpelat->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_repeserta_idpelat">
<?php
$onchange = $t_repeserta_add->idpelat->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_repeserta_add->idpelat->EditAttrs["onchange"] = "";
?>
<span id="as_x_idpelat">
	<input type="text" class="form-control" name="sv_x_idpelat" id="sv_x_idpelat" value="<?php echo RemoveHtml($t_repeserta_add->idpelat->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($t_repeserta_add->idpelat->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_repeserta_add->idpelat->getPlaceHolder()) ?>"<?php echo $t_repeserta_add->idpelat->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_idpelat" data-value-separator="<?php echo $t_repeserta_add->idpelat->displayValueSeparatorAttribute() ?>" name="x_idpelat" id="x_idpelat" value="<?php echo HtmlEncode($t_repeserta_add->idpelat->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_repesertaadd"], function() {
	ft_repesertaadd.createAutoSuggest({"id":"x_idpelat","forceSelect":false});
});
</script>
<?php echo $t_repeserta_add->idpelat->Lookup->getParamTag($t_repeserta_add, "p_x_idpelat") ?>
</span>
<?php } ?>
<?php echo $t_repeserta_add->idpelat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_add->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_t_repeserta_nama" for="x_nama" class="<?php echo $t_repeserta_add->LeftColumnClass ?>"><?php echo $t_repeserta_add->nama->caption() ?><?php echo $t_repeserta_add->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_add->RightColumnClass ?>"><div <?php echo $t_repeserta_add->nama->cellAttributes() ?>>
<span id="el_t_repeserta_nama">
<input type="text" data-table="t_repeserta" data-field="x_nama" name="x_nama" id="x_nama" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_add->nama->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_add->nama->EditValue ?>"<?php echo $t_repeserta_add->nama->editAttributes() ?>>
</span>
<?php echo $t_repeserta_add->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_add->perusahaan->Visible) { // perusahaan ?>
	<div id="r_perusahaan" class="form-group row">
		<label id="elh_t_repeserta_perusahaan" for="x_perusahaan" class="<?php echo $t_repeserta_add->LeftColumnClass ?>"><?php echo $t_repeserta_add->perusahaan->caption() ?><?php echo $t_repeserta_add->perusahaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_add->RightColumnClass ?>"><div <?php echo $t_repeserta_add->perusahaan->cellAttributes() ?>>
<span id="el_t_repeserta_perusahaan">
<input type="text" data-table="t_repeserta" data-field="x_perusahaan" name="x_perusahaan" id="x_perusahaan" size="55" maxlength="255" placeholder="<?php echo HtmlEncode($t_repeserta_add->perusahaan->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_add->perusahaan->EditValue ?>"<?php echo $t_repeserta_add->perusahaan->editAttributes() ?>>
</span>
<?php echo $t_repeserta_add->perusahaan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_add->jabatan->Visible) { // jabatan ?>
	<div id="r_jabatan" class="form-group row">
		<label id="elh_t_repeserta_jabatan" class="<?php echo $t_repeserta_add->LeftColumnClass ?>"><?php echo $t_repeserta_add->jabatan->caption() ?><?php echo $t_repeserta_add->jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_add->RightColumnClass ?>"><div <?php echo $t_repeserta_add->jabatan->cellAttributes() ?>>
<span id="el_t_repeserta_jabatan">
<?php
$onchange = $t_repeserta_add->jabatan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_repeserta_add->jabatan->EditAttrs["onchange"] = "";
?>
<span id="as_x_jabatan">
	<input type="text" class="form-control" name="sv_x_jabatan" id="sv_x_jabatan" value="<?php echo RemoveHtml($t_repeserta_add->jabatan->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_add->jabatan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_repeserta_add->jabatan->getPlaceHolder()) ?>"<?php echo $t_repeserta_add->jabatan->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_jabatan" data-value-separator="<?php echo $t_repeserta_add->jabatan->displayValueSeparatorAttribute() ?>" name="x_jabatan" id="x_jabatan" value="<?php echo HtmlEncode($t_repeserta_add->jabatan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_repesertaadd"], function() {
	ft_repesertaadd.createAutoSuggest({"id":"x_jabatan","forceSelect":true});
});
</script>
<?php echo $t_repeserta_add->jabatan->Lookup->getParamTag($t_repeserta_add, "p_x_jabatan") ?>
</span>
<?php echo $t_repeserta_add->jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_add->tgl_daftar->Visible) { // tgl_daftar ?>
	<div id="r_tgl_daftar" class="form-group row">
		<label id="elh_t_repeserta_tgl_daftar" for="x_tgl_daftar" class="<?php echo $t_repeserta_add->LeftColumnClass ?>"><?php echo $t_repeserta_add->tgl_daftar->caption() ?><?php echo $t_repeserta_add->tgl_daftar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_add->RightColumnClass ?>"><div <?php echo $t_repeserta_add->tgl_daftar->cellAttributes() ?>>
<span id="el_t_repeserta_tgl_daftar">
<input type="text" data-table="t_repeserta" data-field="x_tgl_daftar" name="x_tgl_daftar" id="x_tgl_daftar" size="10" maxlength="19" placeholder="<?php echo HtmlEncode($t_repeserta_add->tgl_daftar->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_add->tgl_daftar->EditValue ?>"<?php echo $t_repeserta_add->tgl_daftar->editAttributes() ?>>
<?php if (!$t_repeserta_add->tgl_daftar->ReadOnly && !$t_repeserta_add->tgl_daftar->Disabled && !isset($t_repeserta_add->tgl_daftar->EditAttrs["readonly"]) && !isset($t_repeserta_add->tgl_daftar->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_repesertaadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_repesertaadd", "x_tgl_daftar", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_repeserta_add->tgl_daftar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_add->telp->Visible) { // telp ?>
	<div id="r_telp" class="form-group row">
		<label id="elh_t_repeserta_telp" for="x_telp" class="<?php echo $t_repeserta_add->LeftColumnClass ?>"><?php echo $t_repeserta_add->telp->caption() ?><?php echo $t_repeserta_add->telp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_add->RightColumnClass ?>"><div <?php echo $t_repeserta_add->telp->cellAttributes() ?>>
<span id="el_t_repeserta_telp">
<input type="text" data-table="t_repeserta" data-field="x_telp" name="x_telp" id="x_telp" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_add->telp->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_add->telp->EditValue ?>"<?php echo $t_repeserta_add->telp->editAttributes() ?>>
</span>
<?php echo $t_repeserta_add->telp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_add->fax->Visible) { // fax ?>
	<div id="r_fax" class="form-group row">
		<label id="elh_t_repeserta_fax" for="x_fax" class="<?php echo $t_repeserta_add->LeftColumnClass ?>"><?php echo $t_repeserta_add->fax->caption() ?><?php echo $t_repeserta_add->fax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_add->RightColumnClass ?>"><div <?php echo $t_repeserta_add->fax->cellAttributes() ?>>
<span id="el_t_repeserta_fax">
<input type="text" data-table="t_repeserta" data-field="x_fax" name="x_fax" id="x_fax" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_add->fax->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_add->fax->EditValue ?>"<?php echo $t_repeserta_add->fax->editAttributes() ?>>
</span>
<?php echo $t_repeserta_add->fax->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_add->hp->Visible) { // hp ?>
	<div id="r_hp" class="form-group row">
		<label id="elh_t_repeserta_hp" for="x_hp" class="<?php echo $t_repeserta_add->LeftColumnClass ?>"><?php echo $t_repeserta_add->hp->caption() ?><?php echo $t_repeserta_add->hp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_add->RightColumnClass ?>"><div <?php echo $t_repeserta_add->hp->cellAttributes() ?>>
<span id="el_t_repeserta_hp">
<input type="text" data-table="t_repeserta" data-field="x_hp" name="x_hp" id="x_hp" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_add->hp->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_add->hp->EditValue ?>"<?php echo $t_repeserta_add->hp->editAttributes() ?>>
</span>
<?php echo $t_repeserta_add->hp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_add->produk->Visible) { // produk ?>
	<div id="r_produk" class="form-group row">
		<label id="elh_t_repeserta_produk" for="x_produk" class="<?php echo $t_repeserta_add->LeftColumnClass ?>"><?php echo $t_repeserta_add->produk->caption() ?><?php echo $t_repeserta_add->produk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_add->RightColumnClass ?>"><div <?php echo $t_repeserta_add->produk->cellAttributes() ?>>
<span id="el_t_repeserta_produk">
<input type="text" data-table="t_repeserta" data-field="x_produk" name="x_produk" id="x_produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_repeserta_add->produk->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_add->produk->EditValue ?>"<?php echo $t_repeserta_add->produk->editAttributes() ?>>
</span>
<?php echo $t_repeserta_add->produk->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_add->cara_bayar->Visible) { // cara_bayar ?>
	<div id="r_cara_bayar" class="form-group row">
		<label id="elh_t_repeserta_cara_bayar" class="<?php echo $t_repeserta_add->LeftColumnClass ?>"><?php echo $t_repeserta_add->cara_bayar->caption() ?><?php echo $t_repeserta_add->cara_bayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_add->RightColumnClass ?>"><div <?php echo $t_repeserta_add->cara_bayar->cellAttributes() ?>>
<span id="el_t_repeserta_cara_bayar">
<div id="tp_x_cara_bayar" class="ew-template"><input type="radio" class="custom-control-input" data-table="t_repeserta" data-field="x_cara_bayar" data-value-separator="<?php echo $t_repeserta_add->cara_bayar->displayValueSeparatorAttribute() ?>" name="x_cara_bayar" id="x_cara_bayar" value="{value}"<?php echo $t_repeserta_add->cara_bayar->editAttributes() ?>></div>
<div id="dsl_x_cara_bayar" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_repeserta_add->cara_bayar->radioButtonListHtml(FALSE, "x_cara_bayar") ?>
</div></div>
</span>
<?php echo $t_repeserta_add->cara_bayar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_add->ket_bayar->Visible) { // ket_bayar ?>
	<div id="r_ket_bayar" class="form-group row">
		<label id="elh_t_repeserta_ket_bayar" for="x_ket_bayar" class="<?php echo $t_repeserta_add->LeftColumnClass ?>"><?php echo $t_repeserta_add->ket_bayar->caption() ?><?php echo $t_repeserta_add->ket_bayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_add->RightColumnClass ?>"><div <?php echo $t_repeserta_add->ket_bayar->cellAttributes() ?>>
<span id="el_t_repeserta_ket_bayar">
<textarea data-table="t_repeserta" data-field="x_ket_bayar" name="x_ket_bayar" id="x_ket_bayar" cols="35" rows="2" placeholder="<?php echo HtmlEncode($t_repeserta_add->ket_bayar->getPlaceHolder()) ?>"<?php echo $t_repeserta_add->ket_bayar->editAttributes() ?>><?php echo $t_repeserta_add->ket_bayar->EditValue ?></textarea>
</span>
<?php echo $t_repeserta_add->ket_bayar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_add->tgl_bayar->Visible) { // tgl_bayar ?>
	<div id="r_tgl_bayar" class="form-group row">
		<label id="elh_t_repeserta_tgl_bayar" for="x_tgl_bayar" class="<?php echo $t_repeserta_add->LeftColumnClass ?>"><?php echo $t_repeserta_add->tgl_bayar->caption() ?><?php echo $t_repeserta_add->tgl_bayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_add->RightColumnClass ?>"><div <?php echo $t_repeserta_add->tgl_bayar->cellAttributes() ?>>
<span id="el_t_repeserta_tgl_bayar">
<input type="text" data-table="t_repeserta" data-field="x_tgl_bayar" name="x_tgl_bayar" id="x_tgl_bayar" size="10" maxlength="19" placeholder="<?php echo HtmlEncode($t_repeserta_add->tgl_bayar->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_add->tgl_bayar->EditValue ?>"<?php echo $t_repeserta_add->tgl_bayar->editAttributes() ?>>
<?php if (!$t_repeserta_add->tgl_bayar->ReadOnly && !$t_repeserta_add->tgl_bayar->Disabled && !isset($t_repeserta_add->tgl_bayar->EditAttrs["readonly"]) && !isset($t_repeserta_add->tgl_bayar->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_repesertaadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_repesertaadd", "x_tgl_bayar", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_repeserta_add->tgl_bayar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_add->kdinformasi->Visible) { // kdinformasi ?>
	<div id="r_kdinformasi" class="form-group row">
		<label id="elh_t_repeserta_kdinformasi" for="x_kdinformasi" class="<?php echo $t_repeserta_add->LeftColumnClass ?>"><?php echo $t_repeserta_add->kdinformasi->caption() ?><?php echo $t_repeserta_add->kdinformasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_add->RightColumnClass ?>"><div <?php echo $t_repeserta_add->kdinformasi->cellAttributes() ?>>
<span id="el_t_repeserta_kdinformasi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_repeserta" data-field="x_kdinformasi" data-value-separator="<?php echo $t_repeserta_add->kdinformasi->displayValueSeparatorAttribute() ?>" id="x_kdinformasi" name="x_kdinformasi"<?php echo $t_repeserta_add->kdinformasi->editAttributes() ?>>
			<?php echo $t_repeserta_add->kdinformasi->selectOptionListHtml("x_kdinformasi") ?>
		</select>
</div>
<?php echo $t_repeserta_add->kdinformasi->Lookup->getParamTag($t_repeserta_add, "p_x_kdinformasi") ?>
</span>
<?php echo $t_repeserta_add->kdinformasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_add->konfirmasi->Visible) { // konfirmasi ?>
	<div id="r_konfirmasi" class="form-group row">
		<label id="elh_t_repeserta_konfirmasi" for="x_konfirmasi" class="<?php echo $t_repeserta_add->LeftColumnClass ?>"><?php echo $t_repeserta_add->konfirmasi->caption() ?><?php echo $t_repeserta_add->konfirmasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_add->RightColumnClass ?>"><div <?php echo $t_repeserta_add->konfirmasi->cellAttributes() ?>>
<span id="el_t_repeserta_konfirmasi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_repeserta" data-field="x_konfirmasi" data-value-separator="<?php echo $t_repeserta_add->konfirmasi->displayValueSeparatorAttribute() ?>" id="x_konfirmasi" name="x_konfirmasi"<?php echo $t_repeserta_add->konfirmasi->editAttributes() ?>>
			<?php echo $t_repeserta_add->konfirmasi->selectOptionListHtml("x_konfirmasi") ?>
		</select>
</div>
</span>
<?php echo $t_repeserta_add->konfirmasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_add->ket->Visible) { // ket ?>
	<div id="r_ket" class="form-group row">
		<label id="elh_t_repeserta_ket" for="x_ket" class="<?php echo $t_repeserta_add->LeftColumnClass ?>"><?php echo $t_repeserta_add->ket->caption() ?><?php echo $t_repeserta_add->ket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_add->RightColumnClass ?>"><div <?php echo $t_repeserta_add->ket->cellAttributes() ?>>
<span id="el_t_repeserta_ket">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_repeserta" data-field="x_ket" data-value-separator="<?php echo $t_repeserta_add->ket->displayValueSeparatorAttribute() ?>" id="x_ket" name="x_ket"<?php echo $t_repeserta_add->ket->editAttributes() ?>>
			<?php echo $t_repeserta_add->ket->selectOptionListHtml("x_ket") ?>
		</select>
</div>
</span>
<?php echo $t_repeserta_add->ket->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_add->ket_lainnya->Visible) { // ket_lainnya ?>
	<div id="r_ket_lainnya" class="form-group row">
		<label id="elh_t_repeserta_ket_lainnya" for="x_ket_lainnya" class="<?php echo $t_repeserta_add->LeftColumnClass ?>"><?php echo $t_repeserta_add->ket_lainnya->caption() ?><?php echo $t_repeserta_add->ket_lainnya->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_add->RightColumnClass ?>"><div <?php echo $t_repeserta_add->ket_lainnya->cellAttributes() ?>>
<span id="el_t_repeserta_ket_lainnya">
<textarea data-table="t_repeserta" data-field="x_ket_lainnya" name="x_ket_lainnya" id="x_ket_lainnya" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_repeserta_add->ket_lainnya->getPlaceHolder()) ?>"<?php echo $t_repeserta_add->ket_lainnya->editAttributes() ?>><?php echo $t_repeserta_add->ket_lainnya->EditValue ?></textarea>
</span>
<?php echo $t_repeserta_add->ket_lainnya->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_repeserta_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_repeserta_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_repeserta_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_repeserta_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$t_repeserta_add->terminate();
?>