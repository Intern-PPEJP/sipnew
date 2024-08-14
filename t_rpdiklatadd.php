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
$t_rpdiklat_add = new t_rpdiklat_add();

// Run the page
$t_rpdiklat_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rpdiklat_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_rpdiklatadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_rpdiklatadd = currentForm = new ew.Form("ft_rpdiklatadd", "add");

	// Validate form
	ft_rpdiklatadd.validate = function() {
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
			<?php if ($t_rpdiklat_add->kdjudul->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjudul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_add->kdjudul->caption(), $t_rpdiklat_add->kdjudul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpdiklat_add->kdbidang->Required) { ?>
				elm = this.getElements("x" + infix + "_kdbidang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_add->kdbidang->caption(), $t_rpdiklat_add->kdbidang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpdiklat_add->kdkursil->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkursil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_add->kdkursil->caption(), $t_rpdiklat_add->kdkursil->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpdiklat_add->iso->Required) { ?>
				elm = this.getElements("x" + infix + "_iso");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_add->iso->caption(), $t_rpdiklat_add->iso->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpdiklat_add->tempat->Required) { ?>
				elm = this.getElements("x" + infix + "_tempat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_add->tempat->caption(), $t_rpdiklat_add->tempat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpdiklat_add->jml_hari->Required) { ?>
				elm = this.getElements("x" + infix + "_jml_hari");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_add->jml_hari->caption(), $t_rpdiklat_add->jml_hari->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jml_hari");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rpdiklat_add->jml_hari->errorMessage()) ?>");
			<?php if ($t_rpdiklat_add->jenisdurasi->Required) { ?>
				elm = this.getElements("x" + infix + "_jenisdurasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_add->jenisdurasi->caption(), $t_rpdiklat_add->jenisdurasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpdiklat_add->targetpes->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_add->targetpes->caption(), $t_rpdiklat_add->targetpes->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rpdiklat_add->targetpes->errorMessage()) ?>");
			<?php if ($t_rpdiklat_add->angkatan->Required) { ?>
				elm = this.getElements("x" + infix + "_angkatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_add->angkatan->caption(), $t_rpdiklat_add->angkatan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_angkatan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rpdiklat_add->angkatan->errorMessage()) ?>");
			<?php if ($t_rpdiklat_add->harga_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_harga_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_add->harga_satuan->caption(), $t_rpdiklat_add->harga_satuan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_harga_satuan");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rpdiklat_add->harga_satuan->errorMessage()) ?>");
			<?php if ($t_rpdiklat_add->tglrevisi->Required) { ?>
				elm = this.getElements("x" + infix + "_tglrevisi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_add->tglrevisi->caption(), $t_rpdiklat_add->tglrevisi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tglrevisi");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rpdiklat_add->tglrevisi->errorMessage()) ?>");
			<?php if ($t_rpdiklat_add->tahun_rencana->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun_rencana");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_add->tahun_rencana->caption(), $t_rpdiklat_add->tahun_rencana->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun_rencana");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rpdiklat_add->tahun_rencana->errorMessage()) ?>");

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
	ft_rpdiklatadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_rpdiklatadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_rpdiklatadd.lists["x_kdjudul"] = <?php echo $t_rpdiklat_add->kdjudul->Lookup->toClientList($t_rpdiklat_add) ?>;
	ft_rpdiklatadd.lists["x_kdjudul"].options = <?php echo JsonEncode($t_rpdiklat_add->kdjudul->lookupOptions()) ?>;
	ft_rpdiklatadd.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_rpdiklatadd.lists["x_kdbidang"] = <?php echo $t_rpdiklat_add->kdbidang->Lookup->toClientList($t_rpdiklat_add) ?>;
	ft_rpdiklatadd.lists["x_kdbidang"].options = <?php echo JsonEncode($t_rpdiklat_add->kdbidang->lookupOptions()) ?>;
	ft_rpdiklatadd.lists["x_kdkursil"] = <?php echo $t_rpdiklat_add->kdkursil->Lookup->toClientList($t_rpdiklat_add) ?>;
	ft_rpdiklatadd.lists["x_kdkursil"].options = <?php echo JsonEncode($t_rpdiklat_add->kdkursil->lookupOptions()) ?>;
	ft_rpdiklatadd.lists["x_iso"] = <?php echo $t_rpdiklat_add->iso->Lookup->toClientList($t_rpdiklat_add) ?>;
	ft_rpdiklatadd.lists["x_iso"].options = <?php echo JsonEncode($t_rpdiklat_add->iso->options(FALSE, TRUE)) ?>;
	ft_rpdiklatadd.lists["x_jenisdurasi"] = <?php echo $t_rpdiklat_add->jenisdurasi->Lookup->toClientList($t_rpdiklat_add) ?>;
	ft_rpdiklatadd.lists["x_jenisdurasi"].options = <?php echo JsonEncode($t_rpdiklat_add->jenisdurasi->options(FALSE, TRUE)) ?>;
	loadjs.done("ft_rpdiklatadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_rpdiklat_add->showPageHeader(); ?>
<?php
$t_rpdiklat_add->showMessage();
?>
<form name="ft_rpdiklatadd" id="ft_rpdiklatadd" class="<?php echo $t_rpdiklat_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rpdiklat">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_rpdiklat_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($t_rpdiklat_add->kdjudul->Visible) { // kdjudul ?>
	<div id="r_kdjudul" class="form-group row">
		<label id="elh_t_rpdiklat_kdjudul" class="<?php echo $t_rpdiklat_add->LeftColumnClass ?>"><?php echo $t_rpdiklat_add->kdjudul->caption() ?><?php echo $t_rpdiklat_add->kdjudul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_add->RightColumnClass ?>"><div <?php echo $t_rpdiklat_add->kdjudul->cellAttributes() ?>>
<span id="el_t_rpdiklat_kdjudul">
<?php
$onchange = $t_rpdiklat_add->kdjudul->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_rpdiklat_add->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($t_rpdiklat_add->kdjudul->EditValue) ?>" size="100" placeholder="<?php echo HtmlEncode($t_rpdiklat_add->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_rpdiklat_add->kdjudul->getPlaceHolder()) ?>"<?php echo $t_rpdiklat_add->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_rpdiklat" data-field="x_kdjudul" data-value-separator="<?php echo $t_rpdiklat_add->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($t_rpdiklat_add->kdjudul->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_rpdiklatadd"], function() {
	ft_rpdiklatadd.createAutoSuggest({"id":"x_kdjudul","forceSelect":true,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $t_rpdiklat_add->kdjudul->Lookup->getParamTag($t_rpdiklat_add, "p_x_kdjudul") ?>
</span>
<?php echo $t_rpdiklat_add->kdjudul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpdiklat_add->kdbidang->Visible) { // kdbidang ?>
	<div id="r_kdbidang" class="form-group row">
		<label id="elh_t_rpdiklat_kdbidang" for="x_kdbidang" class="<?php echo $t_rpdiklat_add->LeftColumnClass ?>"><?php echo $t_rpdiklat_add->kdbidang->caption() ?><?php echo $t_rpdiklat_add->kdbidang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_add->RightColumnClass ?>"><div <?php echo $t_rpdiklat_add->kdbidang->cellAttributes() ?>>
<span id="el_t_rpdiklat_kdbidang">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_rpdiklat" data-field="x_kdbidang" data-value-separator="<?php echo $t_rpdiklat_add->kdbidang->displayValueSeparatorAttribute() ?>" id="x_kdbidang" name="x_kdbidang"<?php echo $t_rpdiklat_add->kdbidang->editAttributes() ?>>
			<?php echo $t_rpdiklat_add->kdbidang->selectOptionListHtml("x_kdbidang") ?>
		</select>
</div>
<?php echo $t_rpdiklat_add->kdbidang->Lookup->getParamTag($t_rpdiklat_add, "p_x_kdbidang") ?>
</span>
<?php echo $t_rpdiklat_add->kdbidang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpdiklat_add->kdkursil->Visible) { // kdkursil ?>
	<div id="r_kdkursil" class="form-group row">
		<label id="elh_t_rpdiklat_kdkursil" for="x_kdkursil" class="<?php echo $t_rpdiklat_add->LeftColumnClass ?>"><?php echo $t_rpdiklat_add->kdkursil->caption() ?><?php echo $t_rpdiklat_add->kdkursil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_add->RightColumnClass ?>"><div <?php echo $t_rpdiklat_add->kdkursil->cellAttributes() ?>>
<span id="el_t_rpdiklat_kdkursil">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_rpdiklat" data-field="x_kdkursil" data-value-separator="<?php echo $t_rpdiklat_add->kdkursil->displayValueSeparatorAttribute() ?>" id="x_kdkursil" name="x_kdkursil"<?php echo $t_rpdiklat_add->kdkursil->editAttributes() ?>>
			<?php echo $t_rpdiklat_add->kdkursil->selectOptionListHtml("x_kdkursil") ?>
		</select>
</div>
<?php echo $t_rpdiklat_add->kdkursil->Lookup->getParamTag($t_rpdiklat_add, "p_x_kdkursil") ?>
</span>
<?php echo $t_rpdiklat_add->kdkursil->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpdiklat_add->iso->Visible) { // iso ?>
	<div id="r_iso" class="form-group row">
		<label id="elh_t_rpdiklat_iso" for="x_iso" class="<?php echo $t_rpdiklat_add->LeftColumnClass ?>"><?php echo $t_rpdiklat_add->iso->caption() ?><?php echo $t_rpdiklat_add->iso->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_add->RightColumnClass ?>"><div <?php echo $t_rpdiklat_add->iso->cellAttributes() ?>>
<span id="el_t_rpdiklat_iso">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_rpdiklat" data-field="x_iso" data-value-separator="<?php echo $t_rpdiklat_add->iso->displayValueSeparatorAttribute() ?>" id="x_iso" name="x_iso"<?php echo $t_rpdiklat_add->iso->editAttributes() ?>>
			<?php echo $t_rpdiklat_add->iso->selectOptionListHtml("x_iso") ?>
		</select>
</div>
</span>
<?php echo $t_rpdiklat_add->iso->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpdiklat_add->tempat->Visible) { // tempat ?>
	<div id="r_tempat" class="form-group row">
		<label id="elh_t_rpdiklat_tempat" for="x_tempat" class="<?php echo $t_rpdiklat_add->LeftColumnClass ?>"><?php echo $t_rpdiklat_add->tempat->caption() ?><?php echo $t_rpdiklat_add->tempat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_add->RightColumnClass ?>"><div <?php echo $t_rpdiklat_add->tempat->cellAttributes() ?>>
<span id="el_t_rpdiklat_tempat">
<input type="text" data-table="t_rpdiklat" data-field="x_tempat" name="x_tempat" id="x_tempat" size="40" maxlength="255" placeholder="<?php echo HtmlEncode($t_rpdiklat_add->tempat->getPlaceHolder()) ?>" value="<?php echo $t_rpdiklat_add->tempat->EditValue ?>"<?php echo $t_rpdiklat_add->tempat->editAttributes() ?>>
</span>
<?php echo $t_rpdiklat_add->tempat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpdiklat_add->jml_hari->Visible) { // jml_hari ?>
	<div id="r_jml_hari" class="form-group row">
		<label id="elh_t_rpdiklat_jml_hari" for="x_jml_hari" class="<?php echo $t_rpdiklat_add->LeftColumnClass ?>"><?php echo $t_rpdiklat_add->jml_hari->caption() ?><?php echo $t_rpdiklat_add->jml_hari->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_add->RightColumnClass ?>"><div <?php echo $t_rpdiklat_add->jml_hari->cellAttributes() ?>>
<span id="el_t_rpdiklat_jml_hari">
<input type="text" data-table="t_rpdiklat" data-field="x_jml_hari" name="x_jml_hari" id="x_jml_hari" size="5" maxlength="2" placeholder="<?php echo HtmlEncode($t_rpdiklat_add->jml_hari->getPlaceHolder()) ?>" value="<?php echo $t_rpdiklat_add->jml_hari->EditValue ?>"<?php echo $t_rpdiklat_add->jml_hari->editAttributes() ?>>
</span>
<?php echo $t_rpdiklat_add->jml_hari->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpdiklat_add->jenisdurasi->Visible) { // jenisdurasi ?>
	<div id="r_jenisdurasi" class="form-group row">
		<label id="elh_t_rpdiklat_jenisdurasi" for="x_jenisdurasi" class="<?php echo $t_rpdiklat_add->LeftColumnClass ?>"><?php echo $t_rpdiklat_add->jenisdurasi->caption() ?><?php echo $t_rpdiklat_add->jenisdurasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_add->RightColumnClass ?>"><div <?php echo $t_rpdiklat_add->jenisdurasi->cellAttributes() ?>>
<span id="el_t_rpdiklat_jenisdurasi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_rpdiklat" data-field="x_jenisdurasi" data-value-separator="<?php echo $t_rpdiklat_add->jenisdurasi->displayValueSeparatorAttribute() ?>" id="x_jenisdurasi" name="x_jenisdurasi"<?php echo $t_rpdiklat_add->jenisdurasi->editAttributes() ?>>
			<?php echo $t_rpdiklat_add->jenisdurasi->selectOptionListHtml("x_jenisdurasi") ?>
		</select>
</div>
</span>
<?php echo $t_rpdiklat_add->jenisdurasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpdiklat_add->targetpes->Visible) { // targetpes ?>
	<div id="r_targetpes" class="form-group row">
		<label id="elh_t_rpdiklat_targetpes" for="x_targetpes" class="<?php echo $t_rpdiklat_add->LeftColumnClass ?>"><?php echo $t_rpdiklat_add->targetpes->caption() ?><?php echo $t_rpdiklat_add->targetpes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_add->RightColumnClass ?>"><div <?php echo $t_rpdiklat_add->targetpes->cellAttributes() ?>>
<span id="el_t_rpdiklat_targetpes">
<input type="text" data-table="t_rpdiklat" data-field="x_targetpes" name="x_targetpes" id="x_targetpes" size="5" maxlength="3" placeholder="<?php echo HtmlEncode($t_rpdiklat_add->targetpes->getPlaceHolder()) ?>" value="<?php echo $t_rpdiklat_add->targetpes->EditValue ?>"<?php echo $t_rpdiklat_add->targetpes->editAttributes() ?>>
</span>
<?php echo $t_rpdiklat_add->targetpes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpdiklat_add->angkatan->Visible) { // angkatan ?>
	<div id="r_angkatan" class="form-group row">
		<label id="elh_t_rpdiklat_angkatan" for="x_angkatan" class="<?php echo $t_rpdiklat_add->LeftColumnClass ?>"><?php echo $t_rpdiklat_add->angkatan->caption() ?><?php echo $t_rpdiklat_add->angkatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_add->RightColumnClass ?>"><div <?php echo $t_rpdiklat_add->angkatan->cellAttributes() ?>>
<span id="el_t_rpdiklat_angkatan">
<input type="text" data-table="t_rpdiklat" data-field="x_angkatan" name="x_angkatan" id="x_angkatan" size="5" maxlength="3" placeholder="<?php echo HtmlEncode($t_rpdiklat_add->angkatan->getPlaceHolder()) ?>" value="<?php echo $t_rpdiklat_add->angkatan->EditValue ?>"<?php echo $t_rpdiklat_add->angkatan->editAttributes() ?>>
</span>
<?php echo $t_rpdiklat_add->angkatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpdiklat_add->harga_satuan->Visible) { // harga_satuan ?>
	<div id="r_harga_satuan" class="form-group row">
		<label id="elh_t_rpdiklat_harga_satuan" for="x_harga_satuan" class="<?php echo $t_rpdiklat_add->LeftColumnClass ?>"><?php echo $t_rpdiklat_add->harga_satuan->caption() ?><?php echo $t_rpdiklat_add->harga_satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_add->RightColumnClass ?>"><div <?php echo $t_rpdiklat_add->harga_satuan->cellAttributes() ?>>
<span id="el_t_rpdiklat_harga_satuan">
<input type="text" data-table="t_rpdiklat" data-field="x_harga_satuan" name="x_harga_satuan" id="x_harga_satuan" size="30" maxlength="17" placeholder="<?php echo HtmlEncode($t_rpdiklat_add->harga_satuan->getPlaceHolder()) ?>" value="<?php echo $t_rpdiklat_add->harga_satuan->EditValue ?>"<?php echo $t_rpdiklat_add->harga_satuan->editAttributes() ?>>
</span>
<?php echo $t_rpdiklat_add->harga_satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpdiklat_add->tglrevisi->Visible) { // tglrevisi ?>
	<div id="r_tglrevisi" class="form-group row">
		<label id="elh_t_rpdiklat_tglrevisi" for="x_tglrevisi" class="<?php echo $t_rpdiklat_add->LeftColumnClass ?>"><?php echo $t_rpdiklat_add->tglrevisi->caption() ?><?php echo $t_rpdiklat_add->tglrevisi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_add->RightColumnClass ?>"><div <?php echo $t_rpdiklat_add->tglrevisi->cellAttributes() ?>>
<span id="el_t_rpdiklat_tglrevisi">
<input type="text" data-table="t_rpdiklat" data-field="x_tglrevisi" name="x_tglrevisi" id="x_tglrevisi" size="10" placeholder="<?php echo HtmlEncode($t_rpdiklat_add->tglrevisi->getPlaceHolder()) ?>" value="<?php echo $t_rpdiklat_add->tglrevisi->EditValue ?>"<?php echo $t_rpdiklat_add->tglrevisi->editAttributes() ?>>
<?php if (!$t_rpdiklat_add->tglrevisi->ReadOnly && !$t_rpdiklat_add->tglrevisi->Disabled && !isset($t_rpdiklat_add->tglrevisi->EditAttrs["readonly"]) && !isset($t_rpdiklat_add->tglrevisi->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_rpdiklatadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_rpdiklatadd", "x_tglrevisi", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_rpdiklat_add->tglrevisi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpdiklat_add->tahun_rencana->Visible) { // tahun_rencana ?>
	<div id="r_tahun_rencana" class="form-group row">
		<label id="elh_t_rpdiklat_tahun_rencana" for="x_tahun_rencana" class="<?php echo $t_rpdiklat_add->LeftColumnClass ?>"><?php echo $t_rpdiklat_add->tahun_rencana->caption() ?><?php echo $t_rpdiklat_add->tahun_rencana->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_add->RightColumnClass ?>"><div <?php echo $t_rpdiklat_add->tahun_rencana->cellAttributes() ?>>
<span id="el_t_rpdiklat_tahun_rencana">
<input type="text" data-table="t_rpdiklat" data-field="x_tahun_rencana" name="x_tahun_rencana" id="x_tahun_rencana" size="5" maxlength="4" placeholder="<?php echo HtmlEncode($t_rpdiklat_add->tahun_rencana->getPlaceHolder()) ?>" value="<?php echo $t_rpdiklat_add->tahun_rencana->EditValue ?>"<?php echo $t_rpdiklat_add->tahun_rencana->editAttributes() ?>>
</span>
<?php echo $t_rpdiklat_add->tahun_rencana->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("diklatpusat", explode(",", $t_rpdiklat->getCurrentDetailTable())) && $diklatpusat->DetailAdd) {
?>
<?php if ($t_rpdiklat->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("diklatpusat", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "diklatpusatgrid.php" ?>
<?php } ?>
<?php if (!$t_rpdiklat_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_rpdiklat_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_rpdiklat_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_rpdiklat_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// document.write("page loaded");
	//$('#el_t_rpdiklat_jml_hari').after('<span id="el_t_rpdiklat_jenisdurasi" class=""> <select data-table="t_rpdiklat" data-field="x_jenisdurasi" data-value-separator=", " id="x_jenisdurasi" name="x_jenisdurasi" class="form-control"> <option value="" selected=""> Please select</option> <option value="Hari">Hari</option><option value="Bulan">Bulan</option></select> </span>');
	//$('#r_jenisdurasi').hide();

	$('#x_hargatotal').attr('readonly','readonly');
	$(document).ready(function() {
		$('#x_harga_satuan, #x_angkatan').on('change textInput input', function () {
			if ( ($("#x_harga_satuan").val() != "") && ($("#x_angkatan").val() != "")) {
			   	hargatot = $("#x_harga_satuan").val() * $("#x_angkatan").val();
				$("#x_hargatotal").val(hargatot);
			}
		});
	});
	$("#elh_t_rpdiklat_jenisdurasi").html("&nbsp;");
	$("#el_t_rpdiklat_kdkursil").after("<span id='showdialog'></span>");
	$("#x_kdbidang").prop("disabled", true); 
	$("#x_kdkursil").change(function() { 
		$.post(ew.currentPage(), { "myajax": 1, "token": ew.TOKEN, "value": $(this).val() }, function(result) { // Post back your custom data (with the synchronizer token)
			if(result > 0){
				$("#showdialog").html("<a onclick=\"ew.searchDialogShow({lnk:this,url:'t_juduldetailview.php?showdetail=t_kurikulum&detailjdid="+result+"&pop=1'})\" class='btn btn-info'>Lihat Kurikulum</a>");
			} else {
				$("#showdialog").html("");
			}
		});
	});
	</script><script>
	$("#x1_statuspel option[value='4']").attr('disabled','disabled');
	</script>
	<style>.ewGrid .ewTable .ewTableAltRow{background-color: #d6d6d6;}</style>
	<script>
});
</script>
<?php include_once "footer.php"; ?>
<?php
$t_rpdiklat_add->terminate();
?>