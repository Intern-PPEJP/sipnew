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
$t_repeserta_edit = new t_repeserta_edit();

// Run the page
$t_repeserta_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_repeserta_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_repesertaedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_repesertaedit = currentForm = new ew.Form("ft_repesertaedit", "edit");

	// Validate form
	ft_repesertaedit.validate = function() {
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
			<?php if ($t_repeserta_edit->idpelat->Required) { ?>
				elm = this.getElements("x" + infix + "_idpelat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_edit->idpelat->caption(), $t_repeserta_edit->idpelat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_edit->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_edit->nama->caption(), $t_repeserta_edit->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_edit->perusahaan->Required) { ?>
				elm = this.getElements("x" + infix + "_perusahaan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_edit->perusahaan->caption(), $t_repeserta_edit->perusahaan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_edit->jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_edit->jabatan->caption(), $t_repeserta_edit->jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_edit->tgl_daftar->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_daftar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_edit->tgl_daftar->caption(), $t_repeserta_edit->tgl_daftar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_daftar");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_repeserta_edit->tgl_daftar->errorMessage()) ?>");
			<?php if ($t_repeserta_edit->telp->Required) { ?>
				elm = this.getElements("x" + infix + "_telp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_edit->telp->caption(), $t_repeserta_edit->telp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_edit->fax->Required) { ?>
				elm = this.getElements("x" + infix + "_fax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_edit->fax->caption(), $t_repeserta_edit->fax->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_edit->hp->Required) { ?>
				elm = this.getElements("x" + infix + "_hp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_edit->hp->caption(), $t_repeserta_edit->hp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_edit->produk->Required) { ?>
				elm = this.getElements("x" + infix + "_produk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_edit->produk->caption(), $t_repeserta_edit->produk->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_edit->cara_bayar->Required) { ?>
				elm = this.getElements("x" + infix + "_cara_bayar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_edit->cara_bayar->caption(), $t_repeserta_edit->cara_bayar->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_edit->ket_bayar->Required) { ?>
				elm = this.getElements("x" + infix + "_ket_bayar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_edit->ket_bayar->caption(), $t_repeserta_edit->ket_bayar->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_edit->tgl_bayar->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_bayar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_edit->tgl_bayar->caption(), $t_repeserta_edit->tgl_bayar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_bayar");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_repeserta_edit->tgl_bayar->errorMessage()) ?>");
			<?php if ($t_repeserta_edit->kdinformasi->Required) { ?>
				elm = this.getElements("x" + infix + "_kdinformasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_edit->kdinformasi->caption(), $t_repeserta_edit->kdinformasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_edit->konfirmasi->Required) { ?>
				elm = this.getElements("x" + infix + "_konfirmasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_edit->konfirmasi->caption(), $t_repeserta_edit->konfirmasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_edit->ket->Required) { ?>
				elm = this.getElements("x" + infix + "_ket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_edit->ket->caption(), $t_repeserta_edit->ket->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_edit->updated_at->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_edit->updated_at->caption(), $t_repeserta_edit->updated_at->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_repeserta_edit->ket_lainnya->Required) { ?>
				elm = this.getElements("x" + infix + "_ket_lainnya");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_repeserta_edit->ket_lainnya->caption(), $t_repeserta_edit->ket_lainnya->RequiredErrorMessage)) ?>");
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
	ft_repesertaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_repesertaedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_repesertaedit.lists["x_jabatan"] = <?php echo $t_repeserta_edit->jabatan->Lookup->toClientList($t_repeserta_edit) ?>;
	ft_repesertaedit.lists["x_jabatan"].options = <?php echo JsonEncode($t_repeserta_edit->jabatan->lookupOptions()) ?>;
	ft_repesertaedit.autoSuggests["x_jabatan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_repesertaedit.lists["x_cara_bayar"] = <?php echo $t_repeserta_edit->cara_bayar->Lookup->toClientList($t_repeserta_edit) ?>;
	ft_repesertaedit.lists["x_cara_bayar"].options = <?php echo JsonEncode($t_repeserta_edit->cara_bayar->options(FALSE, TRUE)) ?>;
	ft_repesertaedit.lists["x_kdinformasi"] = <?php echo $t_repeserta_edit->kdinformasi->Lookup->toClientList($t_repeserta_edit) ?>;
	ft_repesertaedit.lists["x_kdinformasi"].options = <?php echo JsonEncode($t_repeserta_edit->kdinformasi->lookupOptions()) ?>;
	ft_repesertaedit.lists["x_konfirmasi"] = <?php echo $t_repeserta_edit->konfirmasi->Lookup->toClientList($t_repeserta_edit) ?>;
	ft_repesertaedit.lists["x_konfirmasi"].options = <?php echo JsonEncode($t_repeserta_edit->konfirmasi->options(FALSE, TRUE)) ?>;
	ft_repesertaedit.lists["x_ket"] = <?php echo $t_repeserta_edit->ket->Lookup->toClientList($t_repeserta_edit) ?>;
	ft_repesertaedit.lists["x_ket"].options = <?php echo JsonEncode($t_repeserta_edit->ket->options(FALSE, TRUE)) ?>;
	loadjs.done("ft_repesertaedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//document.write('<?php echo cs_judul("edit","Rekrutmen Peserta : Mengubah Data");?>');

});
</script>
<?php $t_repeserta_edit->showPageHeader(); ?>
<?php
$t_repeserta_edit->showMessage();
?>
<form name="ft_repesertaedit" id="ft_repesertaedit" class="<?php echo $t_repeserta_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_repeserta">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_repeserta_edit->IsModal ?>">
<?php if ($t_repeserta->getCurrentMasterTable() == "cv_pelrepes") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="cv_pelrepes">
<input type="hidden" name="fk_idpelat" value="<?php echo HtmlEncode($t_repeserta_edit->idpelat->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_repeserta_edit->idpelat->Visible) { // idpelat ?>
	<div id="r_idpelat" class="form-group row">
		<label id="elh_t_repeserta_idpelat" class="<?php echo $t_repeserta_edit->LeftColumnClass ?>"><?php echo $t_repeserta_edit->idpelat->caption() ?><?php echo $t_repeserta_edit->idpelat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_edit->RightColumnClass ?>"><div <?php echo $t_repeserta_edit->idpelat->cellAttributes() ?>>
<span id="el_t_repeserta_idpelat">
<span<?php echo $t_repeserta_edit->idpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_repeserta_edit->idpelat->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_idpelat" name="x_idpelat" id="x_idpelat" value="<?php echo HtmlEncode($t_repeserta_edit->idpelat->CurrentValue) ?>">
<?php echo $t_repeserta_edit->idpelat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_edit->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_t_repeserta_nama" for="x_nama" class="<?php echo $t_repeserta_edit->LeftColumnClass ?>"><?php echo $t_repeserta_edit->nama->caption() ?><?php echo $t_repeserta_edit->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_edit->RightColumnClass ?>"><div <?php echo $t_repeserta_edit->nama->cellAttributes() ?>>
<span id="el_t_repeserta_nama">
<input type="text" data-table="t_repeserta" data-field="x_nama" name="x_nama" id="x_nama" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_edit->nama->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_edit->nama->EditValue ?>"<?php echo $t_repeserta_edit->nama->editAttributes() ?>>
</span>
<?php echo $t_repeserta_edit->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_edit->perusahaan->Visible) { // perusahaan ?>
	<div id="r_perusahaan" class="form-group row">
		<label id="elh_t_repeserta_perusahaan" for="x_perusahaan" class="<?php echo $t_repeserta_edit->LeftColumnClass ?>"><?php echo $t_repeserta_edit->perusahaan->caption() ?><?php echo $t_repeserta_edit->perusahaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_edit->RightColumnClass ?>"><div <?php echo $t_repeserta_edit->perusahaan->cellAttributes() ?>>
<span id="el_t_repeserta_perusahaan">
<input type="text" data-table="t_repeserta" data-field="x_perusahaan" name="x_perusahaan" id="x_perusahaan" size="55" maxlength="255" placeholder="<?php echo HtmlEncode($t_repeserta_edit->perusahaan->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_edit->perusahaan->EditValue ?>"<?php echo $t_repeserta_edit->perusahaan->editAttributes() ?>>
</span>
<?php echo $t_repeserta_edit->perusahaan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_edit->jabatan->Visible) { // jabatan ?>
	<div id="r_jabatan" class="form-group row">
		<label id="elh_t_repeserta_jabatan" class="<?php echo $t_repeserta_edit->LeftColumnClass ?>"><?php echo $t_repeserta_edit->jabatan->caption() ?><?php echo $t_repeserta_edit->jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_edit->RightColumnClass ?>"><div <?php echo $t_repeserta_edit->jabatan->cellAttributes() ?>>
<span id="el_t_repeserta_jabatan">
<?php
$onchange = $t_repeserta_edit->jabatan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_repeserta_edit->jabatan->EditAttrs["onchange"] = "";
?>
<span id="as_x_jabatan">
	<input type="text" class="form-control" name="sv_x_jabatan" id="sv_x_jabatan" value="<?php echo RemoveHtml($t_repeserta_edit->jabatan->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_edit->jabatan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_repeserta_edit->jabatan->getPlaceHolder()) ?>"<?php echo $t_repeserta_edit->jabatan->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_jabatan" data-value-separator="<?php echo $t_repeserta_edit->jabatan->displayValueSeparatorAttribute() ?>" name="x_jabatan" id="x_jabatan" value="<?php echo HtmlEncode($t_repeserta_edit->jabatan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_repesertaedit"], function() {
	ft_repesertaedit.createAutoSuggest({"id":"x_jabatan","forceSelect":true});
});
</script>
<?php echo $t_repeserta_edit->jabatan->Lookup->getParamTag($t_repeserta_edit, "p_x_jabatan") ?>
</span>
<?php echo $t_repeserta_edit->jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_edit->tgl_daftar->Visible) { // tgl_daftar ?>
	<div id="r_tgl_daftar" class="form-group row">
		<label id="elh_t_repeserta_tgl_daftar" for="x_tgl_daftar" class="<?php echo $t_repeserta_edit->LeftColumnClass ?>"><?php echo $t_repeserta_edit->tgl_daftar->caption() ?><?php echo $t_repeserta_edit->tgl_daftar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_edit->RightColumnClass ?>"><div <?php echo $t_repeserta_edit->tgl_daftar->cellAttributes() ?>>
<span id="el_t_repeserta_tgl_daftar">
<input type="text" data-table="t_repeserta" data-field="x_tgl_daftar" name="x_tgl_daftar" id="x_tgl_daftar" size="10" maxlength="19" placeholder="<?php echo HtmlEncode($t_repeserta_edit->tgl_daftar->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_edit->tgl_daftar->EditValue ?>"<?php echo $t_repeserta_edit->tgl_daftar->editAttributes() ?>>
<?php if (!$t_repeserta_edit->tgl_daftar->ReadOnly && !$t_repeserta_edit->tgl_daftar->Disabled && !isset($t_repeserta_edit->tgl_daftar->EditAttrs["readonly"]) && !isset($t_repeserta_edit->tgl_daftar->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_repesertaedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_repesertaedit", "x_tgl_daftar", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_repeserta_edit->tgl_daftar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_edit->telp->Visible) { // telp ?>
	<div id="r_telp" class="form-group row">
		<label id="elh_t_repeserta_telp" for="x_telp" class="<?php echo $t_repeserta_edit->LeftColumnClass ?>"><?php echo $t_repeserta_edit->telp->caption() ?><?php echo $t_repeserta_edit->telp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_edit->RightColumnClass ?>"><div <?php echo $t_repeserta_edit->telp->cellAttributes() ?>>
<span id="el_t_repeserta_telp">
<input type="text" data-table="t_repeserta" data-field="x_telp" name="x_telp" id="x_telp" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_edit->telp->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_edit->telp->EditValue ?>"<?php echo $t_repeserta_edit->telp->editAttributes() ?>>
</span>
<?php echo $t_repeserta_edit->telp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_edit->fax->Visible) { // fax ?>
	<div id="r_fax" class="form-group row">
		<label id="elh_t_repeserta_fax" for="x_fax" class="<?php echo $t_repeserta_edit->LeftColumnClass ?>"><?php echo $t_repeserta_edit->fax->caption() ?><?php echo $t_repeserta_edit->fax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_edit->RightColumnClass ?>"><div <?php echo $t_repeserta_edit->fax->cellAttributes() ?>>
<span id="el_t_repeserta_fax">
<input type="text" data-table="t_repeserta" data-field="x_fax" name="x_fax" id="x_fax" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_edit->fax->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_edit->fax->EditValue ?>"<?php echo $t_repeserta_edit->fax->editAttributes() ?>>
</span>
<?php echo $t_repeserta_edit->fax->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_edit->hp->Visible) { // hp ?>
	<div id="r_hp" class="form-group row">
		<label id="elh_t_repeserta_hp" for="x_hp" class="<?php echo $t_repeserta_edit->LeftColumnClass ?>"><?php echo $t_repeserta_edit->hp->caption() ?><?php echo $t_repeserta_edit->hp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_edit->RightColumnClass ?>"><div <?php echo $t_repeserta_edit->hp->cellAttributes() ?>>
<span id="el_t_repeserta_hp">
<input type="text" data-table="t_repeserta" data-field="x_hp" name="x_hp" id="x_hp" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_edit->hp->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_edit->hp->EditValue ?>"<?php echo $t_repeserta_edit->hp->editAttributes() ?>>
</span>
<?php echo $t_repeserta_edit->hp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_edit->produk->Visible) { // produk ?>
	<div id="r_produk" class="form-group row">
		<label id="elh_t_repeserta_produk" for="x_produk" class="<?php echo $t_repeserta_edit->LeftColumnClass ?>"><?php echo $t_repeserta_edit->produk->caption() ?><?php echo $t_repeserta_edit->produk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_edit->RightColumnClass ?>"><div <?php echo $t_repeserta_edit->produk->cellAttributes() ?>>
<span id="el_t_repeserta_produk">
<input type="text" data-table="t_repeserta" data-field="x_produk" name="x_produk" id="x_produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_repeserta_edit->produk->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_edit->produk->EditValue ?>"<?php echo $t_repeserta_edit->produk->editAttributes() ?>>
</span>
<?php echo $t_repeserta_edit->produk->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_edit->cara_bayar->Visible) { // cara_bayar ?>
	<div id="r_cara_bayar" class="form-group row">
		<label id="elh_t_repeserta_cara_bayar" class="<?php echo $t_repeserta_edit->LeftColumnClass ?>"><?php echo $t_repeserta_edit->cara_bayar->caption() ?><?php echo $t_repeserta_edit->cara_bayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_edit->RightColumnClass ?>"><div <?php echo $t_repeserta_edit->cara_bayar->cellAttributes() ?>>
<span id="el_t_repeserta_cara_bayar">
<div id="tp_x_cara_bayar" class="ew-template"><input type="radio" class="custom-control-input" data-table="t_repeserta" data-field="x_cara_bayar" data-value-separator="<?php echo $t_repeserta_edit->cara_bayar->displayValueSeparatorAttribute() ?>" name="x_cara_bayar" id="x_cara_bayar" value="{value}"<?php echo $t_repeserta_edit->cara_bayar->editAttributes() ?>></div>
<div id="dsl_x_cara_bayar" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_repeserta_edit->cara_bayar->radioButtonListHtml(FALSE, "x_cara_bayar") ?>
</div></div>
</span>
<?php echo $t_repeserta_edit->cara_bayar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_edit->ket_bayar->Visible) { // ket_bayar ?>
	<div id="r_ket_bayar" class="form-group row">
		<label id="elh_t_repeserta_ket_bayar" for="x_ket_bayar" class="<?php echo $t_repeserta_edit->LeftColumnClass ?>"><?php echo $t_repeserta_edit->ket_bayar->caption() ?><?php echo $t_repeserta_edit->ket_bayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_edit->RightColumnClass ?>"><div <?php echo $t_repeserta_edit->ket_bayar->cellAttributes() ?>>
<span id="el_t_repeserta_ket_bayar">
<textarea data-table="t_repeserta" data-field="x_ket_bayar" name="x_ket_bayar" id="x_ket_bayar" cols="35" rows="2" placeholder="<?php echo HtmlEncode($t_repeserta_edit->ket_bayar->getPlaceHolder()) ?>"<?php echo $t_repeserta_edit->ket_bayar->editAttributes() ?>><?php echo $t_repeserta_edit->ket_bayar->EditValue ?></textarea>
</span>
<?php echo $t_repeserta_edit->ket_bayar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_edit->tgl_bayar->Visible) { // tgl_bayar ?>
	<div id="r_tgl_bayar" class="form-group row">
		<label id="elh_t_repeserta_tgl_bayar" for="x_tgl_bayar" class="<?php echo $t_repeserta_edit->LeftColumnClass ?>"><?php echo $t_repeserta_edit->tgl_bayar->caption() ?><?php echo $t_repeserta_edit->tgl_bayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_edit->RightColumnClass ?>"><div <?php echo $t_repeserta_edit->tgl_bayar->cellAttributes() ?>>
<span id="el_t_repeserta_tgl_bayar">
<input type="text" data-table="t_repeserta" data-field="x_tgl_bayar" name="x_tgl_bayar" id="x_tgl_bayar" size="10" maxlength="19" placeholder="<?php echo HtmlEncode($t_repeserta_edit->tgl_bayar->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_edit->tgl_bayar->EditValue ?>"<?php echo $t_repeserta_edit->tgl_bayar->editAttributes() ?>>
<?php if (!$t_repeserta_edit->tgl_bayar->ReadOnly && !$t_repeserta_edit->tgl_bayar->Disabled && !isset($t_repeserta_edit->tgl_bayar->EditAttrs["readonly"]) && !isset($t_repeserta_edit->tgl_bayar->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_repesertaedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_repesertaedit", "x_tgl_bayar", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_repeserta_edit->tgl_bayar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_edit->kdinformasi->Visible) { // kdinformasi ?>
	<div id="r_kdinformasi" class="form-group row">
		<label id="elh_t_repeserta_kdinformasi" for="x_kdinformasi" class="<?php echo $t_repeserta_edit->LeftColumnClass ?>"><?php echo $t_repeserta_edit->kdinformasi->caption() ?><?php echo $t_repeserta_edit->kdinformasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_edit->RightColumnClass ?>"><div <?php echo $t_repeserta_edit->kdinformasi->cellAttributes() ?>>
<span id="el_t_repeserta_kdinformasi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_repeserta" data-field="x_kdinformasi" data-value-separator="<?php echo $t_repeserta_edit->kdinformasi->displayValueSeparatorAttribute() ?>" id="x_kdinformasi" name="x_kdinformasi"<?php echo $t_repeserta_edit->kdinformasi->editAttributes() ?>>
			<?php echo $t_repeserta_edit->kdinformasi->selectOptionListHtml("x_kdinformasi") ?>
		</select>
</div>
<?php echo $t_repeserta_edit->kdinformasi->Lookup->getParamTag($t_repeserta_edit, "p_x_kdinformasi") ?>
</span>
<?php echo $t_repeserta_edit->kdinformasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_edit->konfirmasi->Visible) { // konfirmasi ?>
	<div id="r_konfirmasi" class="form-group row">
		<label id="elh_t_repeserta_konfirmasi" for="x_konfirmasi" class="<?php echo $t_repeserta_edit->LeftColumnClass ?>"><?php echo $t_repeserta_edit->konfirmasi->caption() ?><?php echo $t_repeserta_edit->konfirmasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_edit->RightColumnClass ?>"><div <?php echo $t_repeserta_edit->konfirmasi->cellAttributes() ?>>
<span id="el_t_repeserta_konfirmasi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_repeserta" data-field="x_konfirmasi" data-value-separator="<?php echo $t_repeserta_edit->konfirmasi->displayValueSeparatorAttribute() ?>" id="x_konfirmasi" name="x_konfirmasi"<?php echo $t_repeserta_edit->konfirmasi->editAttributes() ?>>
			<?php echo $t_repeserta_edit->konfirmasi->selectOptionListHtml("x_konfirmasi") ?>
		</select>
</div>
</span>
<?php echo $t_repeserta_edit->konfirmasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_edit->ket->Visible) { // ket ?>
	<div id="r_ket" class="form-group row">
		<label id="elh_t_repeserta_ket" for="x_ket" class="<?php echo $t_repeserta_edit->LeftColumnClass ?>"><?php echo $t_repeserta_edit->ket->caption() ?><?php echo $t_repeserta_edit->ket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_edit->RightColumnClass ?>"><div <?php echo $t_repeserta_edit->ket->cellAttributes() ?>>
<span id="el_t_repeserta_ket">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_repeserta" data-field="x_ket" data-value-separator="<?php echo $t_repeserta_edit->ket->displayValueSeparatorAttribute() ?>" id="x_ket" name="x_ket"<?php echo $t_repeserta_edit->ket->editAttributes() ?>>
			<?php echo $t_repeserta_edit->ket->selectOptionListHtml("x_ket") ?>
		</select>
</div>
</span>
<?php echo $t_repeserta_edit->ket->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_edit->ket_lainnya->Visible) { // ket_lainnya ?>
	<div id="r_ket_lainnya" class="form-group row">
		<label id="elh_t_repeserta_ket_lainnya" for="x_ket_lainnya" class="<?php echo $t_repeserta_edit->LeftColumnClass ?>"><?php echo $t_repeserta_edit->ket_lainnya->caption() ?><?php echo $t_repeserta_edit->ket_lainnya->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_repeserta_edit->RightColumnClass ?>"><div <?php echo $t_repeserta_edit->ket_lainnya->cellAttributes() ?>>
<span id="el_t_repeserta_ket_lainnya">
<textarea data-table="t_repeserta" data-field="x_ket_lainnya" name="x_ket_lainnya" id="x_ket_lainnya" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_repeserta_edit->ket_lainnya->getPlaceHolder()) ?>"<?php echo $t_repeserta_edit->ket_lainnya->editAttributes() ?>><?php echo $t_repeserta_edit->ket_lainnya->EditValue ?></textarea>
</span>
<?php echo $t_repeserta_edit->ket_lainnya->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="t_repeserta" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($t_repeserta_edit->id->CurrentValue) ?>">
<?php if (!$t_repeserta_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_repeserta_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_repeserta_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_repeserta_edit->showPageFooter();
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
$t_repeserta_edit->terminate();
?>