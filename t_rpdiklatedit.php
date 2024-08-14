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
$t_rpdiklat_edit = new t_rpdiklat_edit();

// Run the page
$t_rpdiklat_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_rpdiklat_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_rpdiklatedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_rpdiklatedit = currentForm = new ew.Form("ft_rpdiklatedit", "edit");

	// Validate form
	ft_rpdiklatedit.validate = function() {
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
			<?php if ($t_rpdiklat_edit->kdjudul->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjudul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_edit->kdjudul->caption(), $t_rpdiklat_edit->kdjudul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpdiklat_edit->kdbidang->Required) { ?>
				elm = this.getElements("x" + infix + "_kdbidang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_edit->kdbidang->caption(), $t_rpdiklat_edit->kdbidang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpdiklat_edit->kdkursil->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkursil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_edit->kdkursil->caption(), $t_rpdiklat_edit->kdkursil->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpdiklat_edit->iso->Required) { ?>
				elm = this.getElements("x" + infix + "_iso");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_edit->iso->caption(), $t_rpdiklat_edit->iso->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpdiklat_edit->tempat->Required) { ?>
				elm = this.getElements("x" + infix + "_tempat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_edit->tempat->caption(), $t_rpdiklat_edit->tempat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpdiklat_edit->jml_hari->Required) { ?>
				elm = this.getElements("x" + infix + "_jml_hari");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_edit->jml_hari->caption(), $t_rpdiklat_edit->jml_hari->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jml_hari");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rpdiklat_edit->jml_hari->errorMessage()) ?>");
			<?php if ($t_rpdiklat_edit->jenisdurasi->Required) { ?>
				elm = this.getElements("x" + infix + "_jenisdurasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_edit->jenisdurasi->caption(), $t_rpdiklat_edit->jenisdurasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_rpdiklat_edit->targetpes->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_edit->targetpes->caption(), $t_rpdiklat_edit->targetpes->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rpdiklat_edit->targetpes->errorMessage()) ?>");
			<?php if ($t_rpdiklat_edit->angkatan->Required) { ?>
				elm = this.getElements("x" + infix + "_angkatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_edit->angkatan->caption(), $t_rpdiklat_edit->angkatan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_angkatan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rpdiklat_edit->angkatan->errorMessage()) ?>");
			<?php if ($t_rpdiklat_edit->harga_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_harga_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_edit->harga_satuan->caption(), $t_rpdiklat_edit->harga_satuan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_harga_satuan");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rpdiklat_edit->harga_satuan->errorMessage()) ?>");
			<?php if ($t_rpdiklat_edit->tglrevisi->Required) { ?>
				elm = this.getElements("x" + infix + "_tglrevisi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_edit->tglrevisi->caption(), $t_rpdiklat_edit->tglrevisi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tglrevisi");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rpdiklat_edit->tglrevisi->errorMessage()) ?>");
			<?php if ($t_rpdiklat_edit->tahun_rencana->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun_rencana");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_rpdiklat_edit->tahun_rencana->caption(), $t_rpdiklat_edit->tahun_rencana->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun_rencana");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_rpdiklat_edit->tahun_rencana->errorMessage()) ?>");

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
	ft_rpdiklatedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_rpdiklatedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_rpdiklatedit.lists["x_kdkursil"] = <?php echo $t_rpdiklat_edit->kdkursil->Lookup->toClientList($t_rpdiklat_edit) ?>;
	ft_rpdiklatedit.lists["x_kdkursil"].options = <?php echo JsonEncode($t_rpdiklat_edit->kdkursil->lookupOptions()) ?>;
	ft_rpdiklatedit.lists["x_iso"] = <?php echo $t_rpdiklat_edit->iso->Lookup->toClientList($t_rpdiklat_edit) ?>;
	ft_rpdiklatedit.lists["x_iso"].options = <?php echo JsonEncode($t_rpdiklat_edit->iso->options(FALSE, TRUE)) ?>;
	ft_rpdiklatedit.lists["x_jenisdurasi"] = <?php echo $t_rpdiklat_edit->jenisdurasi->Lookup->toClientList($t_rpdiklat_edit) ?>;
	ft_rpdiklatedit.lists["x_jenisdurasi"].options = <?php echo JsonEncode($t_rpdiklat_edit->jenisdurasi->options(FALSE, TRUE)) ?>;
	loadjs.done("ft_rpdiklatedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_rpdiklat_edit->showPageHeader(); ?>
<?php
$t_rpdiklat_edit->showMessage();
?>
<form name="ft_rpdiklatedit" id="ft_rpdiklatedit" class="<?php echo $t_rpdiklat_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_rpdiklat">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_rpdiklat_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_rpdiklat_edit->kdjudul->Visible) { // kdjudul ?>
	<div id="r_kdjudul" class="form-group row">
		<label id="elh_t_rpdiklat_kdjudul" class="<?php echo $t_rpdiklat_edit->LeftColumnClass ?>"><?php echo $t_rpdiklat_edit->kdjudul->caption() ?><?php echo $t_rpdiklat_edit->kdjudul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_edit->RightColumnClass ?>"><div <?php echo $t_rpdiklat_edit->kdjudul->cellAttributes() ?>>
<span id="el_t_rpdiklat_kdjudul">
<span<?php echo $t_rpdiklat_edit->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rpdiklat_edit->kdjudul->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_rpdiklat" data-field="x_kdjudul" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($t_rpdiklat_edit->kdjudul->CurrentValue) ?>">
<?php echo $t_rpdiklat_edit->kdjudul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpdiklat_edit->kdbidang->Visible) { // kdbidang ?>
	<div id="r_kdbidang" class="form-group row">
		<label id="elh_t_rpdiklat_kdbidang" for="x_kdbidang" class="<?php echo $t_rpdiklat_edit->LeftColumnClass ?>"><?php echo $t_rpdiklat_edit->kdbidang->caption() ?><?php echo $t_rpdiklat_edit->kdbidang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_edit->RightColumnClass ?>"><div <?php echo $t_rpdiklat_edit->kdbidang->cellAttributes() ?>>
<span id="el_t_rpdiklat_kdbidang">
<span<?php echo $t_rpdiklat_edit->kdbidang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rpdiklat_edit->kdbidang->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_rpdiklat" data-field="x_kdbidang" name="x_kdbidang" id="x_kdbidang" value="<?php echo HtmlEncode($t_rpdiklat_edit->kdbidang->CurrentValue) ?>">
<?php echo $t_rpdiklat_edit->kdbidang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpdiklat_edit->kdkursil->Visible) { // kdkursil ?>
	<div id="r_kdkursil" class="form-group row">
		<label id="elh_t_rpdiklat_kdkursil" for="x_kdkursil" class="<?php echo $t_rpdiklat_edit->LeftColumnClass ?>"><?php echo $t_rpdiklat_edit->kdkursil->caption() ?><?php echo $t_rpdiklat_edit->kdkursil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_edit->RightColumnClass ?>"><div <?php echo $t_rpdiklat_edit->kdkursil->cellAttributes() ?>>
<span id="el_t_rpdiklat_kdkursil">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_rpdiklat" data-field="x_kdkursil" data-value-separator="<?php echo $t_rpdiklat_edit->kdkursil->displayValueSeparatorAttribute() ?>" id="x_kdkursil" name="x_kdkursil"<?php echo $t_rpdiklat_edit->kdkursil->editAttributes() ?>>
			<?php echo $t_rpdiklat_edit->kdkursil->selectOptionListHtml("x_kdkursil") ?>
		</select>
</div>
<?php echo $t_rpdiklat_edit->kdkursil->Lookup->getParamTag($t_rpdiklat_edit, "p_x_kdkursil") ?>
</span>
<?php echo $t_rpdiklat_edit->kdkursil->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpdiklat_edit->iso->Visible) { // iso ?>
	<div id="r_iso" class="form-group row">
		<label id="elh_t_rpdiklat_iso" for="x_iso" class="<?php echo $t_rpdiklat_edit->LeftColumnClass ?>"><?php echo $t_rpdiklat_edit->iso->caption() ?><?php echo $t_rpdiklat_edit->iso->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_edit->RightColumnClass ?>"><div <?php echo $t_rpdiklat_edit->iso->cellAttributes() ?>>
<span id="el_t_rpdiklat_iso">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_rpdiklat" data-field="x_iso" data-value-separator="<?php echo $t_rpdiklat_edit->iso->displayValueSeparatorAttribute() ?>" id="x_iso" name="x_iso"<?php echo $t_rpdiklat_edit->iso->editAttributes() ?>>
			<?php echo $t_rpdiklat_edit->iso->selectOptionListHtml("x_iso") ?>
		</select>
</div>
</span>
<?php echo $t_rpdiklat_edit->iso->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpdiklat_edit->tempat->Visible) { // tempat ?>
	<div id="r_tempat" class="form-group row">
		<label id="elh_t_rpdiklat_tempat" for="x_tempat" class="<?php echo $t_rpdiklat_edit->LeftColumnClass ?>"><?php echo $t_rpdiklat_edit->tempat->caption() ?><?php echo $t_rpdiklat_edit->tempat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_edit->RightColumnClass ?>"><div <?php echo $t_rpdiklat_edit->tempat->cellAttributes() ?>>
<span id="el_t_rpdiklat_tempat">
<span<?php echo $t_rpdiklat_edit->tempat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_rpdiklat_edit->tempat->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_rpdiklat" data-field="x_tempat" name="x_tempat" id="x_tempat" value="<?php echo HtmlEncode($t_rpdiklat_edit->tempat->CurrentValue) ?>">
<?php echo $t_rpdiklat_edit->tempat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpdiklat_edit->jml_hari->Visible) { // jml_hari ?>
	<div id="r_jml_hari" class="form-group row">
		<label id="elh_t_rpdiklat_jml_hari" for="x_jml_hari" class="<?php echo $t_rpdiklat_edit->LeftColumnClass ?>"><?php echo $t_rpdiklat_edit->jml_hari->caption() ?><?php echo $t_rpdiklat_edit->jml_hari->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_edit->RightColumnClass ?>"><div <?php echo $t_rpdiklat_edit->jml_hari->cellAttributes() ?>>
<span id="el_t_rpdiklat_jml_hari">
<input type="text" data-table="t_rpdiklat" data-field="x_jml_hari" name="x_jml_hari" id="x_jml_hari" size="5" maxlength="2" placeholder="<?php echo HtmlEncode($t_rpdiklat_edit->jml_hari->getPlaceHolder()) ?>" value="<?php echo $t_rpdiklat_edit->jml_hari->EditValue ?>"<?php echo $t_rpdiklat_edit->jml_hari->editAttributes() ?>>
</span>
<?php echo $t_rpdiklat_edit->jml_hari->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpdiklat_edit->jenisdurasi->Visible) { // jenisdurasi ?>
	<div id="r_jenisdurasi" class="form-group row">
		<label id="elh_t_rpdiklat_jenisdurasi" for="x_jenisdurasi" class="<?php echo $t_rpdiklat_edit->LeftColumnClass ?>"><?php echo $t_rpdiklat_edit->jenisdurasi->caption() ?><?php echo $t_rpdiklat_edit->jenisdurasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_edit->RightColumnClass ?>"><div <?php echo $t_rpdiklat_edit->jenisdurasi->cellAttributes() ?>>
<span id="el_t_rpdiklat_jenisdurasi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_rpdiklat" data-field="x_jenisdurasi" data-value-separator="<?php echo $t_rpdiklat_edit->jenisdurasi->displayValueSeparatorAttribute() ?>" id="x_jenisdurasi" name="x_jenisdurasi"<?php echo $t_rpdiklat_edit->jenisdurasi->editAttributes() ?>>
			<?php echo $t_rpdiklat_edit->jenisdurasi->selectOptionListHtml("x_jenisdurasi") ?>
		</select>
</div>
</span>
<?php echo $t_rpdiklat_edit->jenisdurasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpdiklat_edit->targetpes->Visible) { // targetpes ?>
	<div id="r_targetpes" class="form-group row">
		<label id="elh_t_rpdiklat_targetpes" for="x_targetpes" class="<?php echo $t_rpdiklat_edit->LeftColumnClass ?>"><?php echo $t_rpdiklat_edit->targetpes->caption() ?><?php echo $t_rpdiklat_edit->targetpes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_edit->RightColumnClass ?>"><div <?php echo $t_rpdiklat_edit->targetpes->cellAttributes() ?>>
<span id="el_t_rpdiklat_targetpes">
<input type="text" data-table="t_rpdiklat" data-field="x_targetpes" name="x_targetpes" id="x_targetpes" size="5" maxlength="3" placeholder="<?php echo HtmlEncode($t_rpdiklat_edit->targetpes->getPlaceHolder()) ?>" value="<?php echo $t_rpdiklat_edit->targetpes->EditValue ?>"<?php echo $t_rpdiklat_edit->targetpes->editAttributes() ?>>
</span>
<?php echo $t_rpdiklat_edit->targetpes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpdiklat_edit->angkatan->Visible) { // angkatan ?>
	<div id="r_angkatan" class="form-group row">
		<label id="elh_t_rpdiklat_angkatan" for="x_angkatan" class="<?php echo $t_rpdiklat_edit->LeftColumnClass ?>"><?php echo $t_rpdiklat_edit->angkatan->caption() ?><?php echo $t_rpdiklat_edit->angkatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_edit->RightColumnClass ?>"><div <?php echo $t_rpdiklat_edit->angkatan->cellAttributes() ?>>
<span id="el_t_rpdiklat_angkatan">
<input type="text" data-table="t_rpdiklat" data-field="x_angkatan" name="x_angkatan" id="x_angkatan" size="5" maxlength="3" placeholder="<?php echo HtmlEncode($t_rpdiklat_edit->angkatan->getPlaceHolder()) ?>" value="<?php echo $t_rpdiklat_edit->angkatan->EditValue ?>"<?php echo $t_rpdiklat_edit->angkatan->editAttributes() ?>>
</span>
<?php echo $t_rpdiklat_edit->angkatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpdiklat_edit->harga_satuan->Visible) { // harga_satuan ?>
	<div id="r_harga_satuan" class="form-group row">
		<label id="elh_t_rpdiklat_harga_satuan" for="x_harga_satuan" class="<?php echo $t_rpdiklat_edit->LeftColumnClass ?>"><?php echo $t_rpdiklat_edit->harga_satuan->caption() ?><?php echo $t_rpdiklat_edit->harga_satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_edit->RightColumnClass ?>"><div <?php echo $t_rpdiklat_edit->harga_satuan->cellAttributes() ?>>
<span id="el_t_rpdiklat_harga_satuan">
<input type="text" data-table="t_rpdiklat" data-field="x_harga_satuan" name="x_harga_satuan" id="x_harga_satuan" size="30" maxlength="17" placeholder="<?php echo HtmlEncode($t_rpdiklat_edit->harga_satuan->getPlaceHolder()) ?>" value="<?php echo $t_rpdiklat_edit->harga_satuan->EditValue ?>"<?php echo $t_rpdiklat_edit->harga_satuan->editAttributes() ?>>
</span>
<?php echo $t_rpdiklat_edit->harga_satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpdiklat_edit->tglrevisi->Visible) { // tglrevisi ?>
	<div id="r_tglrevisi" class="form-group row">
		<label id="elh_t_rpdiklat_tglrevisi" for="x_tglrevisi" class="<?php echo $t_rpdiklat_edit->LeftColumnClass ?>"><?php echo $t_rpdiklat_edit->tglrevisi->caption() ?><?php echo $t_rpdiklat_edit->tglrevisi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_edit->RightColumnClass ?>"><div <?php echo $t_rpdiklat_edit->tglrevisi->cellAttributes() ?>>
<span id="el_t_rpdiklat_tglrevisi">
<input type="text" data-table="t_rpdiklat" data-field="x_tglrevisi" name="x_tglrevisi" id="x_tglrevisi" size="10" placeholder="<?php echo HtmlEncode($t_rpdiklat_edit->tglrevisi->getPlaceHolder()) ?>" value="<?php echo $t_rpdiklat_edit->tglrevisi->EditValue ?>"<?php echo $t_rpdiklat_edit->tglrevisi->editAttributes() ?>>
<?php if (!$t_rpdiklat_edit->tglrevisi->ReadOnly && !$t_rpdiklat_edit->tglrevisi->Disabled && !isset($t_rpdiklat_edit->tglrevisi->EditAttrs["readonly"]) && !isset($t_rpdiklat_edit->tglrevisi->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_rpdiklatedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_rpdiklatedit", "x_tglrevisi", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_rpdiklat_edit->tglrevisi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_rpdiklat_edit->tahun_rencana->Visible) { // tahun_rencana ?>
	<div id="r_tahun_rencana" class="form-group row">
		<label id="elh_t_rpdiklat_tahun_rencana" for="x_tahun_rencana" class="<?php echo $t_rpdiklat_edit->LeftColumnClass ?>"><?php echo $t_rpdiklat_edit->tahun_rencana->caption() ?><?php echo $t_rpdiklat_edit->tahun_rencana->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_rpdiklat_edit->RightColumnClass ?>"><div <?php echo $t_rpdiklat_edit->tahun_rencana->cellAttributes() ?>>
<span id="el_t_rpdiklat_tahun_rencana">
<input type="text" data-table="t_rpdiklat" data-field="x_tahun_rencana" name="x_tahun_rencana" id="x_tahun_rencana" size="5" maxlength="4" placeholder="<?php echo HtmlEncode($t_rpdiklat_edit->tahun_rencana->getPlaceHolder()) ?>" value="<?php echo $t_rpdiklat_edit->tahun_rencana->EditValue ?>"<?php echo $t_rpdiklat_edit->tahun_rencana->editAttributes() ?>>
</span>
<?php echo $t_rpdiklat_edit->tahun_rencana->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="t_rpdiklat" data-field="x_rpdid" name="x_rpdid" id="x_rpdid" value="<?php echo HtmlEncode($t_rpdiklat_edit->rpdid->CurrentValue) ?>">
<?php
	if (in_array("diklatpusat", explode(",", $t_rpdiklat->getCurrentDetailTable())) && $diklatpusat->DetailEdit) {
?>
<?php if ($t_rpdiklat->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("diklatpusat", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "diklatpusatgrid.php" ?>
<?php } ?>
<?php if (!$t_rpdiklat_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_rpdiklat_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_rpdiklat_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_rpdiklat_edit->showPageFooter();
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
	var result = <?php echo ExecuteScalar("SELECT detailjdid  FROM `t_juduldetail` WHERE `kdkursil` LIKE '".CurrentPage()->kdkursil->CurrentValue."'"); ?>;
	$("#el_t_rpdiklat_kdkursil").after("<span id='showdialog'><a onclick=\"ew.searchDialogShow({lnk:this,url:'t_juduldetailview.php?showdetail=t_kurikulum&detailjdid="+result+"&pop=1'})\" class='btn btn-info'>Lihat Kurikulum</a></span>");
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
	$("#elh_t_rpdiklat_jenisdurasi").html("&nbsp;");
	</script><script>
	$("#x1_statuspel option[value='4']").attr('disabled','disabled');
	</script>
	<style>.ewGrid .ewTable .ewTableAltRow{background-color: #d6d6d6;}</style>
	<script>
});
</script>
<?php include_once "footer.php"; ?>
<?php
$t_rpdiklat_edit->terminate();
?>