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
$t_biointruktur_edit = new t_biointruktur_edit();

// Run the page
$t_biointruktur_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_biointruktur_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_biointrukturedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_biointrukturedit = currentForm = new ew.Form("ft_biointrukturedit", "edit");

	// Validate form
	ft_biointrukturedit.validate = function() {
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
			<?php if ($t_biointruktur_edit->bioid->Required) { ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_edit->bioid->caption(), $t_biointruktur_edit->bioid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_edit->kdinstruktur->Required) { ?>
				elm = this.getElements("x" + infix + "_kdinstruktur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_edit->kdinstruktur->caption(), $t_biointruktur_edit->kdinstruktur->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_edit->revisi->Required) { ?>
				elm = this.getElements("x" + infix + "_revisi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_edit->revisi->caption(), $t_biointruktur_edit->revisi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_edit->tglterbit->Required) { ?>
				elm = this.getElements("x" + infix + "_tglterbit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_edit->tglterbit->caption(), $t_biointruktur_edit->tglterbit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tglterbit");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_biointruktur_edit->tglterbit->errorMessage()) ?>");
			<?php if ($t_biointruktur_edit->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_edit->nama->caption(), $t_biointruktur_edit->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_edit->komp_materi->Required) { ?>
				elm = this.getElements("x" + infix + "_komp_materi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_edit->komp_materi->caption(), $t_biointruktur_edit->komp_materi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_komp_materi");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_biointruktur_edit->komp_materi->errorMessage()) ?>");
			<?php if ($t_biointruktur_edit->tmplahir->Required) { ?>
				elm = this.getElements("x" + infix + "_tmplahir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_edit->tmplahir->caption(), $t_biointruktur_edit->tmplahir->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_edit->tgllahir->Required) { ?>
				elm = this.getElements("x" + infix + "_tgllahir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_edit->tgllahir->caption(), $t_biointruktur_edit->tgllahir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgllahir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_biointruktur_edit->tgllahir->errorMessage()) ?>");
			<?php if ($t_biointruktur_edit->agama->Required) { ?>
				elm = this.getElements("x" + infix + "_agama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_edit->agama->caption(), $t_biointruktur_edit->agama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_edit->kategori->Required) { ?>
				elm = this.getElements("x" + infix + "_kategori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_edit->kategori->caption(), $t_biointruktur_edit->kategori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_edit->instansi->Required) { ?>
				elm = this.getElements("x" + infix + "_instansi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_edit->instansi->caption(), $t_biointruktur_edit->instansi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_edit->pekerjaan->Required) { ?>
				elm = this.getElements("x" + infix + "_pekerjaan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_edit->pekerjaan->caption(), $t_biointruktur_edit->pekerjaan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_edit->alamatkantor->Required) { ?>
				elm = this.getElements("x" + infix + "_alamatkantor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_edit->alamatkantor->caption(), $t_biointruktur_edit->alamatkantor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_edit->alamatrumah->Required) { ?>
				elm = this.getElements("x" + infix + "_alamatrumah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_edit->alamatrumah->caption(), $t_biointruktur_edit->alamatrumah->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_edit->telepon->Required) { ?>
				elm = this.getElements("x" + infix + "_telepon");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_edit->telepon->caption(), $t_biointruktur_edit->telepon->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_edit->hp->Required) { ?>
				elm = this.getElements("x" + infix + "_hp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_edit->hp->caption(), $t_biointruktur_edit->hp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_edit->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_edit->_email->caption(), $t_biointruktur_edit->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_biointruktur_edit->_email->errorMessage()) ?>");
			<?php if ($t_biointruktur_edit->fax->Required) { ?>
				elm = this.getElements("x" + infix + "_fax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_edit->fax->caption(), $t_biointruktur_edit->fax->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_edit->updated_by->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_edit->updated_by->caption(), $t_biointruktur_edit->updated_by->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_biointruktur_edit->updated_at->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_biointruktur_edit->updated_at->caption(), $t_biointruktur_edit->updated_at->RequiredErrorMessage)) ?>");
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
	ft_biointrukturedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_biointrukturedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_biointrukturedit.lists["x_komp_materi"] = <?php echo $t_biointruktur_edit->komp_materi->Lookup->toClientList($t_biointruktur_edit) ?>;
	ft_biointrukturedit.lists["x_komp_materi"].options = <?php echo JsonEncode($t_biointruktur_edit->komp_materi->lookupOptions()) ?>;
	ft_biointrukturedit.autoSuggests["x_komp_materi"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_biointrukturedit.lists["x_agama"] = <?php echo $t_biointruktur_edit->agama->Lookup->toClientList($t_biointruktur_edit) ?>;
	ft_biointrukturedit.lists["x_agama"].options = <?php echo JsonEncode($t_biointruktur_edit->agama->lookupOptions()) ?>;
	ft_biointrukturedit.lists["x_kategori"] = <?php echo $t_biointruktur_edit->kategori->Lookup->toClientList($t_biointruktur_edit) ?>;
	ft_biointrukturedit.lists["x_kategori"].options = <?php echo JsonEncode($t_biointruktur_edit->kategori->options(FALSE, TRUE)) ?>;
	loadjs.done("ft_biointrukturedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_biointruktur_edit->showPageHeader(); ?>
<?php
$t_biointruktur_edit->showMessage();
?>
<form name="ft_biointrukturedit" id="ft_biointrukturedit" class="<?php echo $t_biointruktur_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_biointruktur">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_biointruktur_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_biointruktur_edit->bioid->Visible) { // bioid ?>
	<div id="r_bioid" class="form-group row">
		<label id="elh_t_biointruktur_bioid" class="<?php echo $t_biointruktur_edit->LeftColumnClass ?>"><?php echo $t_biointruktur_edit->bioid->caption() ?><?php echo $t_biointruktur_edit->bioid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_edit->RightColumnClass ?>"><div <?php echo $t_biointruktur_edit->bioid->cellAttributes() ?>>
<span id="el_t_biointruktur_bioid">
<span<?php echo $t_biointruktur_edit->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_biointruktur_edit->bioid->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_biointruktur" data-field="x_bioid" name="x_bioid" id="x_bioid" value="<?php echo HtmlEncode($t_biointruktur_edit->bioid->CurrentValue) ?>">
<?php echo $t_biointruktur_edit->bioid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_edit->kdinstruktur->Visible) { // kdinstruktur ?>
	<div id="r_kdinstruktur" class="form-group row">
		<label id="elh_t_biointruktur_kdinstruktur" for="x_kdinstruktur" class="<?php echo $t_biointruktur_edit->LeftColumnClass ?>"><?php echo $t_biointruktur_edit->kdinstruktur->caption() ?><?php echo $t_biointruktur_edit->kdinstruktur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_edit->RightColumnClass ?>"><div <?php echo $t_biointruktur_edit->kdinstruktur->cellAttributes() ?>>
<span id="el_t_biointruktur_kdinstruktur">
<span<?php echo $t_biointruktur_edit->kdinstruktur->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_biointruktur_edit->kdinstruktur->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_biointruktur" data-field="x_kdinstruktur" name="x_kdinstruktur" id="x_kdinstruktur" value="<?php echo HtmlEncode($t_biointruktur_edit->kdinstruktur->CurrentValue) ?>">
<?php echo $t_biointruktur_edit->kdinstruktur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_edit->revisi->Visible) { // revisi ?>
	<div id="r_revisi" class="form-group row">
		<label id="elh_t_biointruktur_revisi" for="x_revisi" class="<?php echo $t_biointruktur_edit->LeftColumnClass ?>"><?php echo $t_biointruktur_edit->revisi->caption() ?><?php echo $t_biointruktur_edit->revisi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_edit->RightColumnClass ?>"><div <?php echo $t_biointruktur_edit->revisi->cellAttributes() ?>>
<span id="el_t_biointruktur_revisi">
<input type="text" data-table="t_biointruktur" data-field="x_revisi" name="x_revisi" id="x_revisi" size="2" maxlength="2" placeholder="<?php echo HtmlEncode($t_biointruktur_edit->revisi->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_edit->revisi->EditValue ?>"<?php echo $t_biointruktur_edit->revisi->editAttributes() ?>>
</span>
<?php echo $t_biointruktur_edit->revisi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_edit->tglterbit->Visible) { // tglterbit ?>
	<div id="r_tglterbit" class="form-group row">
		<label id="elh_t_biointruktur_tglterbit" for="x_tglterbit" class="<?php echo $t_biointruktur_edit->LeftColumnClass ?>"><?php echo $t_biointruktur_edit->tglterbit->caption() ?><?php echo $t_biointruktur_edit->tglterbit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_edit->RightColumnClass ?>"><div <?php echo $t_biointruktur_edit->tglterbit->cellAttributes() ?>>
<span id="el_t_biointruktur_tglterbit">
<input type="text" data-table="t_biointruktur" data-field="x_tglterbit" name="x_tglterbit" id="x_tglterbit" size="7" placeholder="<?php echo HtmlEncode($t_biointruktur_edit->tglterbit->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_edit->tglterbit->EditValue ?>"<?php echo $t_biointruktur_edit->tglterbit->editAttributes() ?>>
<?php if (!$t_biointruktur_edit->tglterbit->ReadOnly && !$t_biointruktur_edit->tglterbit->Disabled && !isset($t_biointruktur_edit->tglterbit->EditAttrs["readonly"]) && !isset($t_biointruktur_edit->tglterbit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_biointrukturedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_biointrukturedit", "x_tglterbit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_biointruktur_edit->tglterbit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_edit->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_t_biointruktur_nama" for="x_nama" class="<?php echo $t_biointruktur_edit->LeftColumnClass ?>"><?php echo $t_biointruktur_edit->nama->caption() ?><?php echo $t_biointruktur_edit->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_edit->RightColumnClass ?>"><div <?php echo $t_biointruktur_edit->nama->cellAttributes() ?>>
<span id="el_t_biointruktur_nama">
<input type="text" data-table="t_biointruktur" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($t_biointruktur_edit->nama->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_edit->nama->EditValue ?>"<?php echo $t_biointruktur_edit->nama->editAttributes() ?>>
</span>
<?php echo $t_biointruktur_edit->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_edit->komp_materi->Visible) { // komp_materi ?>
	<div id="r_komp_materi" class="form-group row">
		<label id="elh_t_biointruktur_komp_materi" class="<?php echo $t_biointruktur_edit->LeftColumnClass ?>"><?php echo $t_biointruktur_edit->komp_materi->caption() ?><?php echo $t_biointruktur_edit->komp_materi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_edit->RightColumnClass ?>"><div <?php echo $t_biointruktur_edit->komp_materi->cellAttributes() ?>>
<span id="el_t_biointruktur_komp_materi">
<?php
$onchange = $t_biointruktur_edit->komp_materi->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_biointruktur_edit->komp_materi->EditAttrs["onchange"] = "";
?>
<span id="as_x_komp_materi">
	<input type="text" class="form-control" name="sv_x_komp_materi" id="sv_x_komp_materi" value="<?php echo RemoveHtml($t_biointruktur_edit->komp_materi->EditValue) ?>" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_biointruktur_edit->komp_materi->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_biointruktur_edit->komp_materi->getPlaceHolder()) ?>"<?php echo $t_biointruktur_edit->komp_materi->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_biointruktur" data-field="x_komp_materi" data-value-separator="<?php echo $t_biointruktur_edit->komp_materi->displayValueSeparatorAttribute() ?>" name="x_komp_materi" id="x_komp_materi" value="<?php echo HtmlEncode($t_biointruktur_edit->komp_materi->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_biointrukturedit"], function() {
	ft_biointrukturedit.createAutoSuggest({"id":"x_komp_materi","forceSelect":true});
});
</script>
<?php echo $t_biointruktur_edit->komp_materi->Lookup->getParamTag($t_biointruktur_edit, "p_x_komp_materi") ?>
</span>
<?php echo $t_biointruktur_edit->komp_materi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_edit->tmplahir->Visible) { // tmplahir ?>
	<div id="r_tmplahir" class="form-group row">
		<label id="elh_t_biointruktur_tmplahir" for="x_tmplahir" class="<?php echo $t_biointruktur_edit->LeftColumnClass ?>"><?php echo $t_biointruktur_edit->tmplahir->caption() ?><?php echo $t_biointruktur_edit->tmplahir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_edit->RightColumnClass ?>"><div <?php echo $t_biointruktur_edit->tmplahir->cellAttributes() ?>>
<span id="el_t_biointruktur_tmplahir">
<input type="text" data-table="t_biointruktur" data-field="x_tmplahir" name="x_tmplahir" id="x_tmplahir" size="30" placeholder="<?php echo HtmlEncode($t_biointruktur_edit->tmplahir->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_edit->tmplahir->EditValue ?>"<?php echo $t_biointruktur_edit->tmplahir->editAttributes() ?>>
</span>
<?php echo $t_biointruktur_edit->tmplahir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_edit->tgllahir->Visible) { // tgllahir ?>
	<div id="r_tgllahir" class="form-group row">
		<label id="elh_t_biointruktur_tgllahir" for="x_tgllahir" class="<?php echo $t_biointruktur_edit->LeftColumnClass ?>"><?php echo $t_biointruktur_edit->tgllahir->caption() ?><?php echo $t_biointruktur_edit->tgllahir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_edit->RightColumnClass ?>"><div <?php echo $t_biointruktur_edit->tgllahir->cellAttributes() ?>>
<span id="el_t_biointruktur_tgllahir">
<input type="text" data-table="t_biointruktur" data-field="x_tgllahir" name="x_tgllahir" id="x_tgllahir" size="7" placeholder="<?php echo HtmlEncode($t_biointruktur_edit->tgllahir->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_edit->tgllahir->EditValue ?>"<?php echo $t_biointruktur_edit->tgllahir->editAttributes() ?>>
<?php if (!$t_biointruktur_edit->tgllahir->ReadOnly && !$t_biointruktur_edit->tgllahir->Disabled && !isset($t_biointruktur_edit->tgllahir->EditAttrs["readonly"]) && !isset($t_biointruktur_edit->tgllahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_biointrukturedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_biointrukturedit", "x_tgllahir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_biointruktur_edit->tgllahir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_edit->agama->Visible) { // agama ?>
	<div id="r_agama" class="form-group row">
		<label id="elh_t_biointruktur_agama" for="x_agama" class="<?php echo $t_biointruktur_edit->LeftColumnClass ?>"><?php echo $t_biointruktur_edit->agama->caption() ?><?php echo $t_biointruktur_edit->agama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_edit->RightColumnClass ?>"><div <?php echo $t_biointruktur_edit->agama->cellAttributes() ?>>
<span id="el_t_biointruktur_agama">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_biointruktur" data-field="x_agama" data-value-separator="<?php echo $t_biointruktur_edit->agama->displayValueSeparatorAttribute() ?>" id="x_agama" name="x_agama"<?php echo $t_biointruktur_edit->agama->editAttributes() ?>>
			<?php echo $t_biointruktur_edit->agama->selectOptionListHtml("x_agama") ?>
		</select>
</div>
<?php echo $t_biointruktur_edit->agama->Lookup->getParamTag($t_biointruktur_edit, "p_x_agama") ?>
</span>
<?php echo $t_biointruktur_edit->agama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_edit->kategori->Visible) { // kategori ?>
	<div id="r_kategori" class="form-group row">
		<label id="elh_t_biointruktur_kategori" class="<?php echo $t_biointruktur_edit->LeftColumnClass ?>"><?php echo $t_biointruktur_edit->kategori->caption() ?><?php echo $t_biointruktur_edit->kategori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_edit->RightColumnClass ?>"><div <?php echo $t_biointruktur_edit->kategori->cellAttributes() ?>>
<span id="el_t_biointruktur_kategori">
<div id="tp_x_kategori" class="ew-template"><input type="radio" class="custom-control-input" data-table="t_biointruktur" data-field="x_kategori" data-value-separator="<?php echo $t_biointruktur_edit->kategori->displayValueSeparatorAttribute() ?>" name="x_kategori" id="x_kategori" value="{value}"<?php echo $t_biointruktur_edit->kategori->editAttributes() ?>></div>
<div id="dsl_x_kategori" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_biointruktur_edit->kategori->radioButtonListHtml(FALSE, "x_kategori") ?>
</div></div>
</span>
<?php echo $t_biointruktur_edit->kategori->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_edit->instansi->Visible) { // instansi ?>
	<div id="r_instansi" class="form-group row">
		<label id="elh_t_biointruktur_instansi" for="x_instansi" class="<?php echo $t_biointruktur_edit->LeftColumnClass ?>"><?php echo $t_biointruktur_edit->instansi->caption() ?><?php echo $t_biointruktur_edit->instansi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_edit->RightColumnClass ?>"><div <?php echo $t_biointruktur_edit->instansi->cellAttributes() ?>>
<span id="el_t_biointruktur_instansi">
<input type="text" data-table="t_biointruktur" data-field="x_instansi" name="x_instansi" id="x_instansi" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($t_biointruktur_edit->instansi->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_edit->instansi->EditValue ?>"<?php echo $t_biointruktur_edit->instansi->editAttributes() ?>>
</span>
<?php echo $t_biointruktur_edit->instansi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_edit->pekerjaan->Visible) { // pekerjaan ?>
	<div id="r_pekerjaan" class="form-group row">
		<label id="elh_t_biointruktur_pekerjaan" for="x_pekerjaan" class="<?php echo $t_biointruktur_edit->LeftColumnClass ?>"><?php echo $t_biointruktur_edit->pekerjaan->caption() ?><?php echo $t_biointruktur_edit->pekerjaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_edit->RightColumnClass ?>"><div <?php echo $t_biointruktur_edit->pekerjaan->cellAttributes() ?>>
<span id="el_t_biointruktur_pekerjaan">
<input type="text" data-table="t_biointruktur" data-field="x_pekerjaan" name="x_pekerjaan" id="x_pekerjaan" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($t_biointruktur_edit->pekerjaan->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_edit->pekerjaan->EditValue ?>"<?php echo $t_biointruktur_edit->pekerjaan->editAttributes() ?>>
</span>
<?php echo $t_biointruktur_edit->pekerjaan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_edit->alamatkantor->Visible) { // alamatkantor ?>
	<div id="r_alamatkantor" class="form-group row">
		<label id="elh_t_biointruktur_alamatkantor" for="x_alamatkantor" class="<?php echo $t_biointruktur_edit->LeftColumnClass ?>"><?php echo $t_biointruktur_edit->alamatkantor->caption() ?><?php echo $t_biointruktur_edit->alamatkantor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_edit->RightColumnClass ?>"><div <?php echo $t_biointruktur_edit->alamatkantor->cellAttributes() ?>>
<span id="el_t_biointruktur_alamatkantor">
<textarea data-table="t_biointruktur" data-field="x_alamatkantor" name="x_alamatkantor" id="x_alamatkantor" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_biointruktur_edit->alamatkantor->getPlaceHolder()) ?>"<?php echo $t_biointruktur_edit->alamatkantor->editAttributes() ?>><?php echo $t_biointruktur_edit->alamatkantor->EditValue ?></textarea>
</span>
<?php echo $t_biointruktur_edit->alamatkantor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_edit->alamatrumah->Visible) { // alamatrumah ?>
	<div id="r_alamatrumah" class="form-group row">
		<label id="elh_t_biointruktur_alamatrumah" for="x_alamatrumah" class="<?php echo $t_biointruktur_edit->LeftColumnClass ?>"><?php echo $t_biointruktur_edit->alamatrumah->caption() ?><?php echo $t_biointruktur_edit->alamatrumah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_edit->RightColumnClass ?>"><div <?php echo $t_biointruktur_edit->alamatrumah->cellAttributes() ?>>
<span id="el_t_biointruktur_alamatrumah">
<textarea data-table="t_biointruktur" data-field="x_alamatrumah" name="x_alamatrumah" id="x_alamatrumah" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_biointruktur_edit->alamatrumah->getPlaceHolder()) ?>"<?php echo $t_biointruktur_edit->alamatrumah->editAttributes() ?>><?php echo $t_biointruktur_edit->alamatrumah->EditValue ?></textarea>
</span>
<?php echo $t_biointruktur_edit->alamatrumah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_edit->telepon->Visible) { // telepon ?>
	<div id="r_telepon" class="form-group row">
		<label id="elh_t_biointruktur_telepon" for="x_telepon" class="<?php echo $t_biointruktur_edit->LeftColumnClass ?>"><?php echo $t_biointruktur_edit->telepon->caption() ?><?php echo $t_biointruktur_edit->telepon->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_edit->RightColumnClass ?>"><div <?php echo $t_biointruktur_edit->telepon->cellAttributes() ?>>
<span id="el_t_biointruktur_telepon">
<input type="text" data-table="t_biointruktur" data-field="x_telepon" name="x_telepon" id="x_telepon" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($t_biointruktur_edit->telepon->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_edit->telepon->EditValue ?>"<?php echo $t_biointruktur_edit->telepon->editAttributes() ?>>
</span>
<?php echo $t_biointruktur_edit->telepon->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_edit->hp->Visible) { // hp ?>
	<div id="r_hp" class="form-group row">
		<label id="elh_t_biointruktur_hp" for="x_hp" class="<?php echo $t_biointruktur_edit->LeftColumnClass ?>"><?php echo $t_biointruktur_edit->hp->caption() ?><?php echo $t_biointruktur_edit->hp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_edit->RightColumnClass ?>"><div <?php echo $t_biointruktur_edit->hp->cellAttributes() ?>>
<span id="el_t_biointruktur_hp">
<input type="text" data-table="t_biointruktur" data-field="x_hp" name="x_hp" id="x_hp" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($t_biointruktur_edit->hp->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_edit->hp->EditValue ?>"<?php echo $t_biointruktur_edit->hp->editAttributes() ?>>
</span>
<?php echo $t_biointruktur_edit->hp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_edit->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_t_biointruktur__email" for="x__email" class="<?php echo $t_biointruktur_edit->LeftColumnClass ?>"><?php echo $t_biointruktur_edit->_email->caption() ?><?php echo $t_biointruktur_edit->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_edit->RightColumnClass ?>"><div <?php echo $t_biointruktur_edit->_email->cellAttributes() ?>>
<span id="el_t_biointruktur__email">
<input type="text" data-table="t_biointruktur" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_biointruktur_edit->_email->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_edit->_email->EditValue ?>"<?php echo $t_biointruktur_edit->_email->editAttributes() ?>>
</span>
<?php echo $t_biointruktur_edit->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_biointruktur_edit->fax->Visible) { // fax ?>
	<div id="r_fax" class="form-group row">
		<label id="elh_t_biointruktur_fax" for="x_fax" class="<?php echo $t_biointruktur_edit->LeftColumnClass ?>"><?php echo $t_biointruktur_edit->fax->caption() ?><?php echo $t_biointruktur_edit->fax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_biointruktur_edit->RightColumnClass ?>"><div <?php echo $t_biointruktur_edit->fax->cellAttributes() ?>>
<span id="el_t_biointruktur_fax">
<input type="text" data-table="t_biointruktur" data-field="x_fax" name="x_fax" id="x_fax" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($t_biointruktur_edit->fax->getPlaceHolder()) ?>" value="<?php echo $t_biointruktur_edit->fax->EditValue ?>"<?php echo $t_biointruktur_edit->fax->editAttributes() ?>>
</span>
<?php echo $t_biointruktur_edit->fax->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if ($t_biointruktur->getCurrentDetailTable() != "") { ?>
<?php
	$t_biointruktur_edit->DetailPages->ValidKeys = explode(",", $t_biointruktur->getCurrentDetailTable());
	$firstActiveDetailTable = $t_biointruktur_edit->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="t_biointruktur_edit_details"><!-- tabs -->
	<ul class="<?php echo $t_biointruktur_edit->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("t_rwpendd", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_rwpendd->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_rwpendd") {
			$firstActiveDetailTable = "t_rwpendd";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $t_biointruktur_edit->DetailPages->pageStyle("t_rwpendd") ?>" href="#tab_t_rwpendd" data-toggle="tab"><?php echo $Language->tablePhrase("t_rwpendd", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("t_rwpekerjaan", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_rwpekerjaan->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_rwpekerjaan") {
			$firstActiveDetailTable = "t_rwpekerjaan";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $t_biointruktur_edit->DetailPages->pageStyle("t_rwpekerjaan") ?>" href="#tab_t_rwpekerjaan" data-toggle="tab"><?php echo $Language->tablePhrase("t_rwpekerjaan", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("t_rwtraining", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_rwtraining->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_rwtraining") {
			$firstActiveDetailTable = "t_rwtraining";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $t_biointruktur_edit->DetailPages->pageStyle("t_rwtraining") ?>" href="#tab_t_rwtraining" data-toggle="tab"><?php echo $Language->tablePhrase("t_rwtraining", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("t_faskur", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_faskur->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_faskur") {
			$firstActiveDetailTable = "t_faskur";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $t_biointruktur_edit->DetailPages->pageStyle("t_faskur") ?>" href="#tab_t_faskur" data-toggle="tab"><?php echo $Language->tablePhrase("t_faskur", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("cv_rwipelatihaninstruktur", explode(",", $t_biointruktur->getCurrentDetailTable())) && $cv_rwipelatihaninstruktur->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "cv_rwipelatihaninstruktur") {
			$firstActiveDetailTable = "cv_rwipelatihaninstruktur";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $t_biointruktur_edit->DetailPages->pageStyle("cv_rwipelatihaninstruktur") ?>" href="#tab_cv_rwipelatihaninstruktur" data-toggle="tab"><?php echo $Language->tablePhrase("cv_rwipelatihaninstruktur", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("t_evaluasifas", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_evaluasifas->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_evaluasifas") {
			$firstActiveDetailTable = "t_evaluasifas";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $t_biointruktur_edit->DetailPages->pageStyle("t_evaluasifas") ?>" href="#tab_t_evaluasifas" data-toggle="tab"><?php echo $Language->tablePhrase("t_evaluasifas", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("t_rwpendd", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_rwpendd->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_rwpendd")
			$firstActiveDetailTable = "t_rwpendd";
?>
		<div class="tab-pane <?php echo $t_biointruktur_edit->DetailPages->pageStyle("t_rwpendd") ?>" id="tab_t_rwpendd"><!-- page* -->
<?php include_once "t_rwpenddgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("t_rwpekerjaan", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_rwpekerjaan->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_rwpekerjaan")
			$firstActiveDetailTable = "t_rwpekerjaan";
?>
		<div class="tab-pane <?php echo $t_biointruktur_edit->DetailPages->pageStyle("t_rwpekerjaan") ?>" id="tab_t_rwpekerjaan"><!-- page* -->
<?php include_once "t_rwpekerjaangrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("t_rwtraining", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_rwtraining->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_rwtraining")
			$firstActiveDetailTable = "t_rwtraining";
?>
		<div class="tab-pane <?php echo $t_biointruktur_edit->DetailPages->pageStyle("t_rwtraining") ?>" id="tab_t_rwtraining"><!-- page* -->
<?php include_once "t_rwtraininggrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("t_faskur", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_faskur->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_faskur")
			$firstActiveDetailTable = "t_faskur";
?>
		<div class="tab-pane <?php echo $t_biointruktur_edit->DetailPages->pageStyle("t_faskur") ?>" id="tab_t_faskur"><!-- page* -->
<?php include_once "t_faskurgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("cv_rwipelatihaninstruktur", explode(",", $t_biointruktur->getCurrentDetailTable())) && $cv_rwipelatihaninstruktur->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "cv_rwipelatihaninstruktur")
			$firstActiveDetailTable = "cv_rwipelatihaninstruktur";
?>
		<div class="tab-pane <?php echo $t_biointruktur_edit->DetailPages->pageStyle("cv_rwipelatihaninstruktur") ?>" id="tab_cv_rwipelatihaninstruktur"><!-- page* -->
<?php include_once "cv_rwipelatihaninstrukturgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("t_evaluasifas", explode(",", $t_biointruktur->getCurrentDetailTable())) && $t_evaluasifas->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "t_evaluasifas")
			$firstActiveDetailTable = "t_evaluasifas";
?>
		<div class="tab-pane <?php echo $t_biointruktur_edit->DetailPages->pageStyle("t_evaluasifas") ?>" id="tab_t_evaluasifas"><!-- page* -->
<?php include_once "t_evaluasifasgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
<?php if (!$t_biointruktur_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_biointruktur_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_biointruktur_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_biointruktur_edit->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$("#elh_t_biointruktur_bioid").hide(),$("#el_t_biointruktur_bioid").hide();
});
</script>
<?php include_once "footer.php"; ?>
<?php
$t_biointruktur_edit->terminate();
?>