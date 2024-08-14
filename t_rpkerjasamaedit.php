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
$t_rpkerjasama_edit = new t_rpkerjasama_edit();

// Run the page
$t_rpkerjasama_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rpkerjasama_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_rpkerjasamaedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_rpkerjasamaedit = currentForm = new ew.Form("ft_rpkerjasamaedit", "edit");

	// Validate form
	ft_rpkerjasamaedit.validate = function() {
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
			<?php if ($t_rpkerjasama_edit->jenispel->Required) { ?>
				elm = this.getElements("x" + infix + "_jenispel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpkerjasama_edit->jenispel->caption(), $t_rpkerjasama_edit->jenispel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpkerjasama_edit->kdkategori->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkategori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpkerjasama_edit->kdkategori->caption(), $t_rpkerjasama_edit->kdkategori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpkerjasama_edit->kerjasama->Required) { ?>
				elm = this.getElements("x" + infix + "_kerjasama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpkerjasama_edit->kerjasama->caption(), $t_rpkerjasama_edit->kerjasama->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kerjasama");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rpkerjasama_edit->kerjasama->errorMessage()) ?>");
			<?php if ($t_rpkerjasama_edit->angkatan->Required) { ?>
				elm = this.getElements("x" + infix + "_angkatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpkerjasama_edit->angkatan->caption(), $t_rpkerjasama_edit->angkatan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_angkatan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rpkerjasama_edit->angkatan->errorMessage()) ?>");
			<?php if ($t_rpkerjasama_edit->targetpes->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpkerjasama_edit->targetpes->caption(), $t_rpkerjasama_edit->targetpes->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rpkerjasama_edit->targetpes->errorMessage()) ?>");
			<?php if ($t_rpkerjasama_edit->kontak_person->Required) { ?>
				elm = this.getElements("x" + infix + "_kontak_person");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpkerjasama_edit->kontak_person->caption(), $t_rpkerjasama_edit->kontak_person->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpkerjasama_edit->tglrevisi->Required) { ?>
				elm = this.getElements("x" + infix + "_tglrevisi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpkerjasama_edit->tglrevisi->caption(), $t_rpkerjasama_edit->tglrevisi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tglrevisi");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rpkerjasama_edit->tglrevisi->errorMessage()) ?>");
			<?php if ($t_rpkerjasama_edit->tahun_rencana->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun_rencana");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpkerjasama_edit->tahun_rencana->caption(), $t_rpkerjasama_edit->tahun_rencana->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun_rencana");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rpkerjasama_edit->tahun_rencana->errorMessage()) ?>");
			<?php if ($t_rpkerjasama_edit->mou->Required) { ?>
				felm = this.getElements("x" + infix + "_mou");
				elm = this.getElements("fn_x" + infix + "_mou");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_rpkerjasama_edit->mou->caption(), $t_rpkerjasama_edit->mou->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpkerjasama_edit->mou2->Required) { ?>
				felm = this.getElements("x" + infix + "_mou2");
				elm = this.getElements("fn_x" + infix + "_mou2");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_rpkerjasama_edit->mou2->caption(), $t_rpkerjasama_edit->mou2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpkerjasama_edit->mou3->Required) { ?>
				felm = this.getElements("x" + infix + "_mou3");
				elm = this.getElements("fn_x" + infix + "_mou3");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_rpkerjasama_edit->mou3->caption(), $t_rpkerjasama_edit->mou3->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpkerjasama_edit->sk->Required) { ?>
				felm = this.getElements("x" + infix + "_sk");
				elm = this.getElements("fn_x" + infix + "_sk");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_rpkerjasama_edit->sk->caption(), $t_rpkerjasama_edit->sk->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpkerjasama_edit->sk2->Required) { ?>
				felm = this.getElements("x" + infix + "_sk2");
				elm = this.getElements("fn_x" + infix + "_sk2");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_rpkerjasama_edit->sk2->caption(), $t_rpkerjasama_edit->sk2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpkerjasama_edit->sk3->Required) { ?>
				felm = this.getElements("x" + infix + "_sk3");
				elm = this.getElements("fn_x" + infix + "_sk3");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_rpkerjasama_edit->sk3->caption(), $t_rpkerjasama_edit->sk3->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpkerjasama_edit->sk4->Required) { ?>
				felm = this.getElements("x" + infix + "_sk4");
				elm = this.getElements("fn_x" + infix + "_sk4");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_rpkerjasama_edit->sk4->caption(), $t_rpkerjasama_edit->sk4->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpkerjasama_edit->sk5->Required) { ?>
				felm = this.getElements("x" + infix + "_sk5");
				elm = this.getElements("fn_x" + infix + "_sk5");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $t_rpkerjasama_edit->sk5->caption(), $t_rpkerjasama_edit->sk5->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpkerjasama_edit->jml_hari->Required) { ?>
				elm = this.getElements("x" + infix + "_jml_hari");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpkerjasama_edit->jml_hari->caption(), $t_rpkerjasama_edit->jml_hari->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jml_hari");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rpkerjasama_edit->jml_hari->errorMessage()) ?>");

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
	ft_rpkerjasamaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_rpkerjasamaedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_rpkerjasamaedit.lists["x_jenispel"] = <?php echo $t_rpkerjasama_edit->jenispel->Lookup->toClientList($t_rpkerjasama_edit) ?>;
	ft_rpkerjasamaedit.lists["x_jenispel"].options = <?php echo JsonEncode($t_rpkerjasama_edit->jenispel->options(FALSE, TRUE)) ?>;
	ft_rpkerjasamaedit.lists["x_kdkategori"] = <?php echo $t_rpkerjasama_edit->kdkategori->Lookup->toClientList($t_rpkerjasama_edit) ?>;
	ft_rpkerjasamaedit.lists["x_kdkategori"].options = <?php echo JsonEncode($t_rpkerjasama_edit->kdkategori->lookupOptions()) ?>;
	ft_rpkerjasamaedit.lists["x_kerjasama"] = <?php echo $t_rpkerjasama_edit->kerjasama->Lookup->toClientList($t_rpkerjasama_edit) ?>;
	ft_rpkerjasamaedit.lists["x_kerjasama"].options = <?php echo JsonEncode($t_rpkerjasama_edit->kerjasama->lookupOptions()) ?>;
	ft_rpkerjasamaedit.autoSuggests["x_kerjasama"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("ft_rpkerjasamaedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_rpkerjasama_edit->showPageHeader(); ?>
<?php
$t_rpkerjasama_edit->showMessage();
?>
<form name="ft_rpkerjasamaedit" id="ft_rpkerjasamaedit" class="<?php echo $t_rpkerjasama_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rpkerjasama">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_rpkerjasama_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_rpkerjasama_edit->jenispel->Visible) { // jenispel ?>
	<div id="r_jenispel" class="form-group row">
		<label id="elh_t_rpkerjasama_jenispel" for="x_jenispel" class="<?php echo $t_rpkerjasama_edit->LeftColumnClass ?>"><?php echo $t_rpkerjasama_edit->jenispel->caption() ?><?php echo $t_rpkerjasama_edit->jenispel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpkerjasama_edit->RightColumnClass ?>"><div <?php echo $t_rpkerjasama_edit->jenispel->cellAttributes() ?>>
<span id="el_t_rpkerjasama_jenispel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_rpkerjasama" data-field="x_jenispel" data-value-separator="<?php echo $t_rpkerjasama_edit->jenispel->displayValueSeparatorAttribute() ?>" id="x_jenispel" name="x_jenispel"<?php echo $t_rpkerjasama_edit->jenispel->editAttributes() ?>>
			<?php echo $t_rpkerjasama_edit->jenispel->selectOptionListHtml("x_jenispel") ?>
		</select>
</div>
</span>
<?php echo $t_rpkerjasama_edit->jenispel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpkerjasama_edit->kdkategori->Visible) { // kdkategori ?>
	<div id="r_kdkategori" class="form-group row">
		<label id="elh_t_rpkerjasama_kdkategori" for="x_kdkategori" class="<?php echo $t_rpkerjasama_edit->LeftColumnClass ?>"><?php echo $t_rpkerjasama_edit->kdkategori->caption() ?><?php echo $t_rpkerjasama_edit->kdkategori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpkerjasama_edit->RightColumnClass ?>"><div <?php echo $t_rpkerjasama_edit->kdkategori->cellAttributes() ?>>
<span id="el_t_rpkerjasama_kdkategori">
<?php $t_rpkerjasama_edit->kdkategori->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_rpkerjasama" data-field="x_kdkategori" data-value-separator="<?php echo $t_rpkerjasama_edit->kdkategori->displayValueSeparatorAttribute() ?>" id="x_kdkategori" name="x_kdkategori"<?php echo $t_rpkerjasama_edit->kdkategori->editAttributes() ?>>
			<?php echo $t_rpkerjasama_edit->kdkategori->selectOptionListHtml("x_kdkategori") ?>
		</select>
</div>
<?php echo $t_rpkerjasama_edit->kdkategori->Lookup->getParamTag($t_rpkerjasama_edit, "p_x_kdkategori") ?>
</span>
<?php echo $t_rpkerjasama_edit->kdkategori->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpkerjasama_edit->kerjasama->Visible) { // kerjasama ?>
	<div id="r_kerjasama" class="form-group row">
		<label id="elh_t_rpkerjasama_kerjasama" class="<?php echo $t_rpkerjasama_edit->LeftColumnClass ?>"><?php echo $t_rpkerjasama_edit->kerjasama->caption() ?><?php echo $t_rpkerjasama_edit->kerjasama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpkerjasama_edit->RightColumnClass ?>"><div <?php echo $t_rpkerjasama_edit->kerjasama->cellAttributes() ?>>
<span id="el_t_rpkerjasama_kerjasama">
<?php
$onchange = $t_rpkerjasama_edit->kerjasama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_rpkerjasama_edit->kerjasama->EditAttrs["onchange"] = "";
?>
<span id="as_x_kerjasama">
	<input type="text" class="form-control" name="sv_x_kerjasama" id="sv_x_kerjasama" value="<?php echo RemoveHtml($t_rpkerjasama_edit->kerjasama->EditValue) ?>" size="100" maxlength="30" placeholder="<?php echo HtmlEncode($t_rpkerjasama_edit->kerjasama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_rpkerjasama_edit->kerjasama->getPlaceHolder()) ?>"<?php echo $t_rpkerjasama_edit->kerjasama->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_rpkerjasama" data-field="x_kerjasama" data-value-separator="<?php echo $t_rpkerjasama_edit->kerjasama->displayValueSeparatorAttribute() ?>" name="x_kerjasama" id="x_kerjasama" value="<?php echo HtmlEncode($t_rpkerjasama_edit->kerjasama->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_rpkerjasamaedit"], function() {
	ft_rpkerjasamaedit.createAutoSuggest({"id":"x_kerjasama","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_rpkerjasama_edit->kerjasama->Lookup->getParamTag($t_rpkerjasama_edit, "p_x_kerjasama") ?>
</span>
<?php echo $t_rpkerjasama_edit->kerjasama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpkerjasama_edit->angkatan->Visible) { // angkatan ?>
	<div id="r_angkatan" class="form-group row">
		<label id="elh_t_rpkerjasama_angkatan" for="x_angkatan" class="<?php echo $t_rpkerjasama_edit->LeftColumnClass ?>"><?php echo $t_rpkerjasama_edit->angkatan->caption() ?><?php echo $t_rpkerjasama_edit->angkatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpkerjasama_edit->RightColumnClass ?>"><div <?php echo $t_rpkerjasama_edit->angkatan->cellAttributes() ?>>
<span id="el_t_rpkerjasama_angkatan">
<input type="text" data-table="t_rpkerjasama" data-field="x_angkatan" name="x_angkatan" id="x_angkatan" size="5" maxlength="3" placeholder="<?php echo HtmlEncode($t_rpkerjasama_edit->angkatan->getPlaceHolder()) ?>" value="<?php echo $t_rpkerjasama_edit->angkatan->EditValue ?>"<?php echo $t_rpkerjasama_edit->angkatan->editAttributes() ?>>
</span>
<?php echo $t_rpkerjasama_edit->angkatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpkerjasama_edit->targetpes->Visible) { // targetpes ?>
	<div id="r_targetpes" class="form-group row">
		<label id="elh_t_rpkerjasama_targetpes" for="x_targetpes" class="<?php echo $t_rpkerjasama_edit->LeftColumnClass ?>"><?php echo $t_rpkerjasama_edit->targetpes->caption() ?><?php echo $t_rpkerjasama_edit->targetpes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpkerjasama_edit->RightColumnClass ?>"><div <?php echo $t_rpkerjasama_edit->targetpes->cellAttributes() ?>>
<span id="el_t_rpkerjasama_targetpes">
<input type="text" data-table="t_rpkerjasama" data-field="x_targetpes" name="x_targetpes" id="x_targetpes" size="5" maxlength="3" placeholder="<?php echo HtmlEncode($t_rpkerjasama_edit->targetpes->getPlaceHolder()) ?>" value="<?php echo $t_rpkerjasama_edit->targetpes->EditValue ?>"<?php echo $t_rpkerjasama_edit->targetpes->editAttributes() ?>>
</span>
<?php echo $t_rpkerjasama_edit->targetpes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpkerjasama_edit->kontak_person->Visible) { // kontak_person ?>
	<div id="r_kontak_person" class="form-group row">
		<label id="elh_t_rpkerjasama_kontak_person" for="x_kontak_person" class="<?php echo $t_rpkerjasama_edit->LeftColumnClass ?>"><?php echo $t_rpkerjasama_edit->kontak_person->caption() ?><?php echo $t_rpkerjasama_edit->kontak_person->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpkerjasama_edit->RightColumnClass ?>"><div <?php echo $t_rpkerjasama_edit->kontak_person->cellAttributes() ?>>
<span id="el_t_rpkerjasama_kontak_person">
<textarea data-table="t_rpkerjasama" data-field="x_kontak_person" name="x_kontak_person" id="x_kontak_person" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_rpkerjasama_edit->kontak_person->getPlaceHolder()) ?>"<?php echo $t_rpkerjasama_edit->kontak_person->editAttributes() ?>><?php echo $t_rpkerjasama_edit->kontak_person->EditValue ?></textarea>
</span>
<?php echo $t_rpkerjasama_edit->kontak_person->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpkerjasama_edit->tglrevisi->Visible) { // tglrevisi ?>
	<div id="r_tglrevisi" class="form-group row">
		<label id="elh_t_rpkerjasama_tglrevisi" for="x_tglrevisi" class="<?php echo $t_rpkerjasama_edit->LeftColumnClass ?>"><?php echo $t_rpkerjasama_edit->tglrevisi->caption() ?><?php echo $t_rpkerjasama_edit->tglrevisi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpkerjasama_edit->RightColumnClass ?>"><div <?php echo $t_rpkerjasama_edit->tglrevisi->cellAttributes() ?>>
<span id="el_t_rpkerjasama_tglrevisi">
<input type="text" data-table="t_rpkerjasama" data-field="x_tglrevisi" name="x_tglrevisi" id="x_tglrevisi" size="10" placeholder="<?php echo HtmlEncode($t_rpkerjasama_edit->tglrevisi->getPlaceHolder()) ?>" value="<?php echo $t_rpkerjasama_edit->tglrevisi->EditValue ?>"<?php echo $t_rpkerjasama_edit->tglrevisi->editAttributes() ?>>
<?php if (!$t_rpkerjasama_edit->tglrevisi->ReadOnly && !$t_rpkerjasama_edit->tglrevisi->Disabled && !isset($t_rpkerjasama_edit->tglrevisi->EditAttrs["readonly"]) && !isset($t_rpkerjasama_edit->tglrevisi->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_rpkerjasamaedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_rpkerjasamaedit", "x_tglrevisi", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_rpkerjasama_edit->tglrevisi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpkerjasama_edit->tahun_rencana->Visible) { // tahun_rencana ?>
	<div id="r_tahun_rencana" class="form-group row">
		<label id="elh_t_rpkerjasama_tahun_rencana" for="x_tahun_rencana" class="<?php echo $t_rpkerjasama_edit->LeftColumnClass ?>"><?php echo $t_rpkerjasama_edit->tahun_rencana->caption() ?><?php echo $t_rpkerjasama_edit->tahun_rencana->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpkerjasama_edit->RightColumnClass ?>"><div <?php echo $t_rpkerjasama_edit->tahun_rencana->cellAttributes() ?>>
<span id="el_t_rpkerjasama_tahun_rencana">
<input type="text" data-table="t_rpkerjasama" data-field="x_tahun_rencana" name="x_tahun_rencana" id="x_tahun_rencana" size="5" maxlength="4" placeholder="<?php echo HtmlEncode($t_rpkerjasama_edit->tahun_rencana->getPlaceHolder()) ?>" value="<?php echo $t_rpkerjasama_edit->tahun_rencana->EditValue ?>"<?php echo $t_rpkerjasama_edit->tahun_rencana->editAttributes() ?>>
</span>
<?php echo $t_rpkerjasama_edit->tahun_rencana->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpkerjasama_edit->mou->Visible) { // mou ?>
	<div id="r_mou" class="form-group row">
		<label id="elh_t_rpkerjasama_mou" class="<?php echo $t_rpkerjasama_edit->LeftColumnClass ?>"><?php echo $t_rpkerjasama_edit->mou->caption() ?><?php echo $t_rpkerjasama_edit->mou->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpkerjasama_edit->RightColumnClass ?>"><div <?php echo $t_rpkerjasama_edit->mou->cellAttributes() ?>>
<span id="el_t_rpkerjasama_mou">
<div id="fd_x_mou">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_rpkerjasama_edit->mou->title() ?>" data-table="t_rpkerjasama" data-field="x_mou" name="x_mou" id="x_mou" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_rpkerjasama_edit->mou->editAttributes() ?><?php if ($t_rpkerjasama_edit->mou->ReadOnly || $t_rpkerjasama_edit->mou->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_mou"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_mou" id= "fn_x_mou" value="<?php echo $t_rpkerjasama_edit->mou->Upload->FileName ?>">
<input type="hidden" name="fa_x_mou" id= "fa_x_mou" value="<?php echo (Post("fa_x_mou") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_mou" id= "fs_x_mou" value="255">
<input type="hidden" name="fx_x_mou" id= "fx_x_mou" value="<?php echo $t_rpkerjasama_edit->mou->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_mou" id= "fm_x_mou" value="<?php echo $t_rpkerjasama_edit->mou->UploadMaxFileSize ?>">
</div>
<table id="ft_x_mou" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_rpkerjasama_edit->mou->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpkerjasama_edit->mou2->Visible) { // mou2 ?>
	<div id="r_mou2" class="form-group row">
		<label id="elh_t_rpkerjasama_mou2" class="<?php echo $t_rpkerjasama_edit->LeftColumnClass ?>"><?php echo $t_rpkerjasama_edit->mou2->caption() ?><?php echo $t_rpkerjasama_edit->mou2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpkerjasama_edit->RightColumnClass ?>"><div <?php echo $t_rpkerjasama_edit->mou2->cellAttributes() ?>>
<span id="el_t_rpkerjasama_mou2">
<div id="fd_x_mou2">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_rpkerjasama_edit->mou2->title() ?>" data-table="t_rpkerjasama" data-field="x_mou2" name="x_mou2" id="x_mou2" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_rpkerjasama_edit->mou2->editAttributes() ?><?php if ($t_rpkerjasama_edit->mou2->ReadOnly || $t_rpkerjasama_edit->mou2->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_mou2"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_mou2" id= "fn_x_mou2" value="<?php echo $t_rpkerjasama_edit->mou2->Upload->FileName ?>">
<input type="hidden" name="fa_x_mou2" id= "fa_x_mou2" value="<?php echo (Post("fa_x_mou2") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_mou2" id= "fs_x_mou2" value="255">
<input type="hidden" name="fx_x_mou2" id= "fx_x_mou2" value="<?php echo $t_rpkerjasama_edit->mou2->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_mou2" id= "fm_x_mou2" value="<?php echo $t_rpkerjasama_edit->mou2->UploadMaxFileSize ?>">
</div>
<table id="ft_x_mou2" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_rpkerjasama_edit->mou2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpkerjasama_edit->mou3->Visible) { // mou3 ?>
	<div id="r_mou3" class="form-group row">
		<label id="elh_t_rpkerjasama_mou3" class="<?php echo $t_rpkerjasama_edit->LeftColumnClass ?>"><?php echo $t_rpkerjasama_edit->mou3->caption() ?><?php echo $t_rpkerjasama_edit->mou3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpkerjasama_edit->RightColumnClass ?>"><div <?php echo $t_rpkerjasama_edit->mou3->cellAttributes() ?>>
<span id="el_t_rpkerjasama_mou3">
<div id="fd_x_mou3">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_rpkerjasama_edit->mou3->title() ?>" data-table="t_rpkerjasama" data-field="x_mou3" name="x_mou3" id="x_mou3" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_rpkerjasama_edit->mou3->editAttributes() ?><?php if ($t_rpkerjasama_edit->mou3->ReadOnly || $t_rpkerjasama_edit->mou3->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_mou3"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_mou3" id= "fn_x_mou3" value="<?php echo $t_rpkerjasama_edit->mou3->Upload->FileName ?>">
<input type="hidden" name="fa_x_mou3" id= "fa_x_mou3" value="<?php echo (Post("fa_x_mou3") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_mou3" id= "fs_x_mou3" value="255">
<input type="hidden" name="fx_x_mou3" id= "fx_x_mou3" value="<?php echo $t_rpkerjasama_edit->mou3->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_mou3" id= "fm_x_mou3" value="<?php echo $t_rpkerjasama_edit->mou3->UploadMaxFileSize ?>">
</div>
<table id="ft_x_mou3" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_rpkerjasama_edit->mou3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpkerjasama_edit->sk->Visible) { // sk ?>
	<div id="r_sk" class="form-group row">
		<label id="elh_t_rpkerjasama_sk" class="<?php echo $t_rpkerjasama_edit->LeftColumnClass ?>"><?php echo $t_rpkerjasama_edit->sk->caption() ?><?php echo $t_rpkerjasama_edit->sk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpkerjasama_edit->RightColumnClass ?>"><div <?php echo $t_rpkerjasama_edit->sk->cellAttributes() ?>>
<span id="el_t_rpkerjasama_sk">
<div id="fd_x_sk">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_rpkerjasama_edit->sk->title() ?>" data-table="t_rpkerjasama" data-field="x_sk" name="x_sk" id="x_sk" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_rpkerjasama_edit->sk->editAttributes() ?><?php if ($t_rpkerjasama_edit->sk->ReadOnly || $t_rpkerjasama_edit->sk->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_sk"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_sk" id= "fn_x_sk" value="<?php echo $t_rpkerjasama_edit->sk->Upload->FileName ?>">
<input type="hidden" name="fa_x_sk" id= "fa_x_sk" value="<?php echo (Post("fa_x_sk") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_sk" id= "fs_x_sk" value="255">
<input type="hidden" name="fx_x_sk" id= "fx_x_sk" value="<?php echo $t_rpkerjasama_edit->sk->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_sk" id= "fm_x_sk" value="<?php echo $t_rpkerjasama_edit->sk->UploadMaxFileSize ?>">
</div>
<table id="ft_x_sk" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_rpkerjasama_edit->sk->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpkerjasama_edit->sk2->Visible) { // sk2 ?>
	<div id="r_sk2" class="form-group row">
		<label id="elh_t_rpkerjasama_sk2" class="<?php echo $t_rpkerjasama_edit->LeftColumnClass ?>"><?php echo $t_rpkerjasama_edit->sk2->caption() ?><?php echo $t_rpkerjasama_edit->sk2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpkerjasama_edit->RightColumnClass ?>"><div <?php echo $t_rpkerjasama_edit->sk2->cellAttributes() ?>>
<span id="el_t_rpkerjasama_sk2">
<div id="fd_x_sk2">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_rpkerjasama_edit->sk2->title() ?>" data-table="t_rpkerjasama" data-field="x_sk2" name="x_sk2" id="x_sk2" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_rpkerjasama_edit->sk2->editAttributes() ?><?php if ($t_rpkerjasama_edit->sk2->ReadOnly || $t_rpkerjasama_edit->sk2->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_sk2"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_sk2" id= "fn_x_sk2" value="<?php echo $t_rpkerjasama_edit->sk2->Upload->FileName ?>">
<input type="hidden" name="fa_x_sk2" id= "fa_x_sk2" value="<?php echo (Post("fa_x_sk2") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_sk2" id= "fs_x_sk2" value="255">
<input type="hidden" name="fx_x_sk2" id= "fx_x_sk2" value="<?php echo $t_rpkerjasama_edit->sk2->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_sk2" id= "fm_x_sk2" value="<?php echo $t_rpkerjasama_edit->sk2->UploadMaxFileSize ?>">
</div>
<table id="ft_x_sk2" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_rpkerjasama_edit->sk2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpkerjasama_edit->sk3->Visible) { // sk3 ?>
	<div id="r_sk3" class="form-group row">
		<label id="elh_t_rpkerjasama_sk3" class="<?php echo $t_rpkerjasama_edit->LeftColumnClass ?>"><?php echo $t_rpkerjasama_edit->sk3->caption() ?><?php echo $t_rpkerjasama_edit->sk3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpkerjasama_edit->RightColumnClass ?>"><div <?php echo $t_rpkerjasama_edit->sk3->cellAttributes() ?>>
<span id="el_t_rpkerjasama_sk3">
<div id="fd_x_sk3">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_rpkerjasama_edit->sk3->title() ?>" data-table="t_rpkerjasama" data-field="x_sk3" name="x_sk3" id="x_sk3" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_rpkerjasama_edit->sk3->editAttributes() ?><?php if ($t_rpkerjasama_edit->sk3->ReadOnly || $t_rpkerjasama_edit->sk3->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_sk3"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_sk3" id= "fn_x_sk3" value="<?php echo $t_rpkerjasama_edit->sk3->Upload->FileName ?>">
<input type="hidden" name="fa_x_sk3" id= "fa_x_sk3" value="<?php echo (Post("fa_x_sk3") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_sk3" id= "fs_x_sk3" value="255">
<input type="hidden" name="fx_x_sk3" id= "fx_x_sk3" value="<?php echo $t_rpkerjasama_edit->sk3->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_sk3" id= "fm_x_sk3" value="<?php echo $t_rpkerjasama_edit->sk3->UploadMaxFileSize ?>">
</div>
<table id="ft_x_sk3" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_rpkerjasama_edit->sk3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpkerjasama_edit->sk4->Visible) { // sk4 ?>
	<div id="r_sk4" class="form-group row">
		<label id="elh_t_rpkerjasama_sk4" class="<?php echo $t_rpkerjasama_edit->LeftColumnClass ?>"><?php echo $t_rpkerjasama_edit->sk4->caption() ?><?php echo $t_rpkerjasama_edit->sk4->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpkerjasama_edit->RightColumnClass ?>"><div <?php echo $t_rpkerjasama_edit->sk4->cellAttributes() ?>>
<span id="el_t_rpkerjasama_sk4">
<div id="fd_x_sk4">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_rpkerjasama_edit->sk4->title() ?>" data-table="t_rpkerjasama" data-field="x_sk4" name="x_sk4" id="x_sk4" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_rpkerjasama_edit->sk4->editAttributes() ?><?php if ($t_rpkerjasama_edit->sk4->ReadOnly || $t_rpkerjasama_edit->sk4->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_sk4"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_sk4" id= "fn_x_sk4" value="<?php echo $t_rpkerjasama_edit->sk4->Upload->FileName ?>">
<input type="hidden" name="fa_x_sk4" id= "fa_x_sk4" value="<?php echo (Post("fa_x_sk4") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_sk4" id= "fs_x_sk4" value="255">
<input type="hidden" name="fx_x_sk4" id= "fx_x_sk4" value="<?php echo $t_rpkerjasama_edit->sk4->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_sk4" id= "fm_x_sk4" value="<?php echo $t_rpkerjasama_edit->sk4->UploadMaxFileSize ?>">
</div>
<table id="ft_x_sk4" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_rpkerjasama_edit->sk4->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpkerjasama_edit->sk5->Visible) { // sk5 ?>
	<div id="r_sk5" class="form-group row">
		<label id="elh_t_rpkerjasama_sk5" class="<?php echo $t_rpkerjasama_edit->LeftColumnClass ?>"><?php echo $t_rpkerjasama_edit->sk5->caption() ?><?php echo $t_rpkerjasama_edit->sk5->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpkerjasama_edit->RightColumnClass ?>"><div <?php echo $t_rpkerjasama_edit->sk5->cellAttributes() ?>>
<span id="el_t_rpkerjasama_sk5">
<div id="fd_x_sk5">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $t_rpkerjasama_edit->sk5->title() ?>" data-table="t_rpkerjasama" data-field="x_sk5" name="x_sk5" id="x_sk5" lang="<?php echo CurrentLanguageID() ?>"<?php echo $t_rpkerjasama_edit->sk5->editAttributes() ?><?php if ($t_rpkerjasama_edit->sk5->ReadOnly || $t_rpkerjasama_edit->sk5->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_sk5"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_sk5" id= "fn_x_sk5" value="<?php echo $t_rpkerjasama_edit->sk5->Upload->FileName ?>">
<input type="hidden" name="fa_x_sk5" id= "fa_x_sk5" value="<?php echo (Post("fa_x_sk5") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_sk5" id= "fs_x_sk5" value="255">
<input type="hidden" name="fx_x_sk5" id= "fx_x_sk5" value="<?php echo $t_rpkerjasama_edit->sk5->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_sk5" id= "fm_x_sk5" value="<?php echo $t_rpkerjasama_edit->sk5->UploadMaxFileSize ?>">
</div>
<table id="ft_x_sk5" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $t_rpkerjasama_edit->sk5->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpkerjasama_edit->jml_hari->Visible) { // jml_hari ?>
	<div id="r_jml_hari" class="form-group row">
		<label id="elh_t_rpkerjasama_jml_hari" for="x_jml_hari" class="<?php echo $t_rpkerjasama_edit->LeftColumnClass ?>"><?php echo $t_rpkerjasama_edit->jml_hari->caption() ?><?php echo $t_rpkerjasama_edit->jml_hari->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpkerjasama_edit->RightColumnClass ?>"><div <?php echo $t_rpkerjasama_edit->jml_hari->cellAttributes() ?>>
<span id="el_t_rpkerjasama_jml_hari">
<input type="text" data-table="t_rpkerjasama" data-field="x_jml_hari" name="x_jml_hari" id="x_jml_hari" size="30" placeholder="<?php echo HtmlEncode($t_rpkerjasama_edit->jml_hari->getPlaceHolder()) ?>" value="<?php echo $t_rpkerjasama_edit->jml_hari->EditValue ?>"<?php echo $t_rpkerjasama_edit->jml_hari->editAttributes() ?>>
</span>
<?php echo $t_rpkerjasama_edit->jml_hari->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="t_rpkerjasama" data-field="x_rpkid" name="x_rpkid" id="x_rpkid" value="<?php echo HtmlEncode($t_rpkerjasama_edit->rpkid->CurrentValue) ?>">
<?php
	if (in_array("diklatkerjasama", explode(",", $t_rpkerjasama->getCurrentDetailTable())) && $diklatkerjasama->DetailEdit) {
?>
<?php if ($t_rpkerjasama->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("diklatkerjasama", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "diklatkerjasamagrid.php" ?>
<?php } ?>
<?php if (!$t_rpkerjasama_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_rpkerjasama_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_rpkerjasama_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_rpkerjasama_edit->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// document.write("page loaded");

	$('[data-table=t_rpkerjasama][data-field=x_jenispel]').on(
			{ // keys = event types, values = handler functions
				"change": function(e) {

					// Your code
					if (this.value >= 8 && this.value <= 11) {
						$(this).fields("dana").value("0"); 
						$("#r_dana").hide("500");
					} else {
						$("#r_dana").show("500");
					}
				}
			}
		);
	<?php if($t_rpkerjasama->jenispel->CurrentValue > 7){ ?>
	$("#r_dana").hide();
	<?php } ?>
	$("#x_kerjasama").change(function() { 
	var cp1 = ew.ajax(ewVar.SqlCP1, $(this).val());
	var cp2 = ew.ajax(ewVar.SqlCP2, $(this).val());
	var cp3 = ew.ajax(ewVar.SqlCP3, $(this).val());
	var result = cp1 + "\n" + cp2 + "\n" + cp3;
	$("#x_kontak_person").val(result);
	}); 
	$("#x_kontak_person").prop("readonly", true);
	</script><script>
	$("#x1_statuspel option[value='4']").attr('disabled','disabled');	
	</script>
	<style>.ewGrid .ewTable .ewTableAltRow{background-color: #d6d6d6;}</style>
	<script>
});
</script>
<?php include_once "footer.php"; ?>
<?php
$t_rpkerjasama_edit->terminate();
?>