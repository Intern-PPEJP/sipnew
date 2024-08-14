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
$t_juduldetail_add = new t_juduldetail_add();

// Run the page
$t_juduldetail_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_juduldetail_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_juduldetailadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_juduldetailadd = currentForm = new ew.Form("ft_juduldetailadd", "add");

	// Validate form
	ft_juduldetailadd.validate = function() {
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
			<?php if ($t_juduldetail_add->singbagian->Required) { ?>
				elm = this.getElements("x" + infix + "_singbagian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_add->singbagian->caption(), $t_juduldetail_add->singbagian->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_add->jpel->Required) { ?>
				elm = this.getElements("x" + infix + "_jpel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_add->jpel->caption(), $t_juduldetail_add->jpel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_add->kdjudul->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjudul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_add->kdjudul->caption(), $t_juduldetail_add->kdjudul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_add->revisi->Required) { ?>
				elm = this.getElements("x" + infix + "_revisi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_add->revisi->caption(), $t_juduldetail_add->revisi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_add->tgl_terbit->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_terbit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_add->tgl_terbit->caption(), $t_juduldetail_add->tgl_terbit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_terbit");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_juduldetail_add->tgl_terbit->errorMessage()) ?>");
			<?php if ($t_juduldetail_add->deskripsi_singkat->Required) { ?>
				elm = this.getElements("x" + infix + "_deskripsi_singkat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_add->deskripsi_singkat->caption(), $t_juduldetail_add->deskripsi_singkat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_add->tujuan->Required) { ?>
				elm = this.getElements("x" + infix + "_tujuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_add->tujuan->caption(), $t_juduldetail_add->tujuan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_add->target_peserta->Required) { ?>
				elm = this.getElements("x" + infix + "_target_peserta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_add->target_peserta->caption(), $t_juduldetail_add->target_peserta->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_add->lama_pelatihan->Required) { ?>
				elm = this.getElements("x" + infix + "_lama_pelatihan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_add->lama_pelatihan->caption(), $t_juduldetail_add->lama_pelatihan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_add->catatan->Required) { ?>
				elm = this.getElements("x" + infix + "_catatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_add->catatan->caption(), $t_juduldetail_add->catatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_add->created_by->Required) { ?>
				elm = this.getElements("x" + infix + "_created_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_add->created_by->caption(), $t_juduldetail_add->created_by->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_add->created_at->Required) { ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_add->created_at->caption(), $t_juduldetail_add->created_at->RequiredErrorMessage)) ?>");
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
	ft_juduldetailadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_juduldetailadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_juduldetailadd.lists["x_singbagian"] = <?php echo $t_juduldetail_add->singbagian->Lookup->toClientList($t_juduldetail_add) ?>;
	ft_juduldetailadd.lists["x_singbagian"].options = <?php echo JsonEncode($t_juduldetail_add->singbagian->lookupOptions()) ?>;
	ft_juduldetailadd.lists["x_jpel"] = <?php echo $t_juduldetail_add->jpel->Lookup->toClientList($t_juduldetail_add) ?>;
	ft_juduldetailadd.lists["x_jpel"].options = <?php echo JsonEncode($t_juduldetail_add->jpel->options(FALSE, TRUE)) ?>;
	ft_juduldetailadd.lists["x_kdjudul"] = <?php echo $t_juduldetail_add->kdjudul->Lookup->toClientList($t_juduldetail_add) ?>;
	ft_juduldetailadd.lists["x_kdjudul"].options = <?php echo JsonEncode($t_juduldetail_add->kdjudul->lookupOptions()) ?>;
	ft_juduldetailadd.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_juduldetailadd.lists["x_lama_pelatihan"] = <?php echo $t_juduldetail_add->lama_pelatihan->Lookup->toClientList($t_juduldetail_add) ?>;
	ft_juduldetailadd.lists["x_lama_pelatihan"].options = <?php echo JsonEncode($t_juduldetail_add->lama_pelatihan->lookupOptions()) ?>;
	loadjs.done("ft_juduldetailadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_juduldetail_add->showPageHeader(); ?>
<?php
$t_juduldetail_add->showMessage();
?>
<form name="ft_juduldetailadd" id="ft_juduldetailadd" class="<?php echo $t_juduldetail_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_juduldetail">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_juduldetail_add->IsModal ?>">
<?php if ($t_juduldetail->getCurrentMasterTable() == "t_judul") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_judul">
<input type="hidden" name="fk_kdjudul" value="<?php echo HtmlEncode($t_juduldetail_add->kdjudul->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($t_juduldetail_add->singbagian->Visible) { // singbagian ?>
	<div id="r_singbagian" class="form-group row">
		<label id="elh_t_juduldetail_singbagian" for="x_singbagian" class="<?php echo $t_juduldetail_add->LeftColumnClass ?>"><?php echo $t_juduldetail_add->singbagian->caption() ?><?php echo $t_juduldetail_add->singbagian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_juduldetail_add->RightColumnClass ?>"><div <?php echo $t_juduldetail_add->singbagian->cellAttributes() ?>>
<span id="el_t_juduldetail_singbagian">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_juduldetail" data-field="x_singbagian" data-value-separator="<?php echo $t_juduldetail_add->singbagian->displayValueSeparatorAttribute() ?>" id="x_singbagian" name="x_singbagian"<?php echo $t_juduldetail_add->singbagian->editAttributes() ?>>
			<?php echo $t_juduldetail_add->singbagian->selectOptionListHtml("x_singbagian") ?>
		</select>
</div>
<?php echo $t_juduldetail_add->singbagian->Lookup->getParamTag($t_juduldetail_add, "p_x_singbagian") ?>
</span>
<?php echo $t_juduldetail_add->singbagian->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_juduldetail_add->jpel->Visible) { // jpel ?>
	<div id="r_jpel" class="form-group row">
		<label id="elh_t_juduldetail_jpel" for="x_jpel" class="<?php echo $t_juduldetail_add->LeftColumnClass ?>"><?php echo $t_juduldetail_add->jpel->caption() ?><?php echo $t_juduldetail_add->jpel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_juduldetail_add->RightColumnClass ?>"><div <?php echo $t_juduldetail_add->jpel->cellAttributes() ?>>
<span id="el_t_juduldetail_jpel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_juduldetail" data-field="x_jpel" data-value-separator="<?php echo $t_juduldetail_add->jpel->displayValueSeparatorAttribute() ?>" id="x_jpel" name="x_jpel"<?php echo $t_juduldetail_add->jpel->editAttributes() ?>>
			<?php echo $t_juduldetail_add->jpel->selectOptionListHtml("x_jpel") ?>
		</select>
</div>
</span>
<?php echo $t_juduldetail_add->jpel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_juduldetail_add->kdjudul->Visible) { // kdjudul ?>
	<div id="r_kdjudul" class="form-group row">
		<label id="elh_t_juduldetail_kdjudul" class="<?php echo $t_juduldetail_add->LeftColumnClass ?>"><?php echo $t_juduldetail_add->kdjudul->caption() ?><?php echo $t_juduldetail_add->kdjudul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_juduldetail_add->RightColumnClass ?>"><div <?php echo $t_juduldetail_add->kdjudul->cellAttributes() ?>>
<?php if ($t_juduldetail_add->kdjudul->getSessionValue() != "") { ?>
<span id="el_t_juduldetail_kdjudul">
<span<?php echo $t_juduldetail_add->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_juduldetail_add->kdjudul->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_kdjudul" name="x_kdjudul" value="<?php echo HtmlEncode($t_juduldetail_add->kdjudul->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_juduldetail_kdjudul">
<?php
$onchange = $t_juduldetail_add->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_juduldetail_add->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($t_juduldetail_add->kdjudul->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($t_juduldetail_add->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_juduldetail_add->kdjudul->getPlaceHolder()) ?>"<?php echo $t_juduldetail_add->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_kdjudul" data-value-separator="<?php echo $t_juduldetail_add->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($t_juduldetail_add->kdjudul->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_juduldetailadd"], function() {
	ft_juduldetailadd.createAutoSuggest({"id":"x_kdjudul","forceSelect":true,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $t_juduldetail_add->kdjudul->Lookup->getParamTag($t_juduldetail_add, "p_x_kdjudul") ?>
</span>
<?php } ?>
<?php echo $t_juduldetail_add->kdjudul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_juduldetail_add->revisi->Visible) { // revisi ?>
	<div id="r_revisi" class="form-group row">
		<label id="elh_t_juduldetail_revisi" for="x_revisi" class="<?php echo $t_juduldetail_add->LeftColumnClass ?>"><?php echo $t_juduldetail_add->revisi->caption() ?><?php echo $t_juduldetail_add->revisi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_juduldetail_add->RightColumnClass ?>"><div <?php echo $t_juduldetail_add->revisi->cellAttributes() ?>>
<span id="el_t_juduldetail_revisi">
<input type="text" data-table="t_juduldetail" data-field="x_revisi" name="x_revisi" id="x_revisi" size="2" maxlength="2" placeholder="<?php echo HtmlEncode($t_juduldetail_add->revisi->getPlaceHolder()) ?>" value="<?php echo $t_juduldetail_add->revisi->EditValue ?>"<?php echo $t_juduldetail_add->revisi->editAttributes() ?>>
</span>
<?php echo $t_juduldetail_add->revisi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_juduldetail_add->tgl_terbit->Visible) { // tgl_terbit ?>
	<div id="r_tgl_terbit" class="form-group row">
		<label id="elh_t_juduldetail_tgl_terbit" for="x_tgl_terbit" class="<?php echo $t_juduldetail_add->LeftColumnClass ?>"><?php echo $t_juduldetail_add->tgl_terbit->caption() ?><?php echo $t_juduldetail_add->tgl_terbit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_juduldetail_add->RightColumnClass ?>"><div <?php echo $t_juduldetail_add->tgl_terbit->cellAttributes() ?>>
<span id="el_t_juduldetail_tgl_terbit">
<input type="text" data-table="t_juduldetail" data-field="x_tgl_terbit" name="x_tgl_terbit" id="x_tgl_terbit" size="7" maxlength="10" placeholder="<?php echo HtmlEncode($t_juduldetail_add->tgl_terbit->getPlaceHolder()) ?>" value="<?php echo $t_juduldetail_add->tgl_terbit->EditValue ?>"<?php echo $t_juduldetail_add->tgl_terbit->editAttributes() ?>>
<?php if (!$t_juduldetail_add->tgl_terbit->ReadOnly && !$t_juduldetail_add->tgl_terbit->Disabled && !isset($t_juduldetail_add->tgl_terbit->EditAttrs["readonly"]) && !isset($t_juduldetail_add->tgl_terbit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_juduldetailadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_juduldetailadd", "x_tgl_terbit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_juduldetail_add->tgl_terbit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_juduldetail_add->deskripsi_singkat->Visible) { // deskripsi_singkat ?>
	<div id="r_deskripsi_singkat" class="form-group row">
		<label id="elh_t_juduldetail_deskripsi_singkat" for="x_deskripsi_singkat" class="<?php echo $t_juduldetail_add->LeftColumnClass ?>"><?php echo $t_juduldetail_add->deskripsi_singkat->caption() ?><?php echo $t_juduldetail_add->deskripsi_singkat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_juduldetail_add->RightColumnClass ?>"><div <?php echo $t_juduldetail_add->deskripsi_singkat->cellAttributes() ?>>
<span id="el_t_juduldetail_deskripsi_singkat">
<textarea data-table="t_juduldetail" data-field="x_deskripsi_singkat" name="x_deskripsi_singkat" id="x_deskripsi_singkat" cols="95" rows="6" placeholder="<?php echo HtmlEncode($t_juduldetail_add->deskripsi_singkat->getPlaceHolder()) ?>"<?php echo $t_juduldetail_add->deskripsi_singkat->editAttributes() ?>><?php echo $t_juduldetail_add->deskripsi_singkat->EditValue ?></textarea>
</span>
<?php echo $t_juduldetail_add->deskripsi_singkat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_juduldetail_add->tujuan->Visible) { // tujuan ?>
	<div id="r_tujuan" class="form-group row">
		<label id="elh_t_juduldetail_tujuan" for="x_tujuan" class="<?php echo $t_juduldetail_add->LeftColumnClass ?>"><?php echo $t_juduldetail_add->tujuan->caption() ?><?php echo $t_juduldetail_add->tujuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_juduldetail_add->RightColumnClass ?>"><div <?php echo $t_juduldetail_add->tujuan->cellAttributes() ?>>
<span id="el_t_juduldetail_tujuan">
<textarea data-table="t_juduldetail" data-field="x_tujuan" name="x_tujuan" id="x_tujuan" cols="95" rows="2" placeholder="<?php echo HtmlEncode($t_juduldetail_add->tujuan->getPlaceHolder()) ?>"<?php echo $t_juduldetail_add->tujuan->editAttributes() ?>><?php echo $t_juduldetail_add->tujuan->EditValue ?></textarea>
</span>
<?php echo $t_juduldetail_add->tujuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_juduldetail_add->target_peserta->Visible) { // target_peserta ?>
	<div id="r_target_peserta" class="form-group row">
		<label id="elh_t_juduldetail_target_peserta" for="x_target_peserta" class="<?php echo $t_juduldetail_add->LeftColumnClass ?>"><?php echo $t_juduldetail_add->target_peserta->caption() ?><?php echo $t_juduldetail_add->target_peserta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_juduldetail_add->RightColumnClass ?>"><div <?php echo $t_juduldetail_add->target_peserta->cellAttributes() ?>>
<span id="el_t_juduldetail_target_peserta">
<textarea data-table="t_juduldetail" data-field="x_target_peserta" name="x_target_peserta" id="x_target_peserta" cols="95" rows="2" placeholder="<?php echo HtmlEncode($t_juduldetail_add->target_peserta->getPlaceHolder()) ?>"<?php echo $t_juduldetail_add->target_peserta->editAttributes() ?>><?php echo $t_juduldetail_add->target_peserta->EditValue ?></textarea>
</span>
<?php echo $t_juduldetail_add->target_peserta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_juduldetail_add->lama_pelatihan->Visible) { // lama_pelatihan ?>
	<div id="r_lama_pelatihan" class="form-group row">
		<label id="elh_t_juduldetail_lama_pelatihan" for="x_lama_pelatihan" class="<?php echo $t_juduldetail_add->LeftColumnClass ?>"><?php echo $t_juduldetail_add->lama_pelatihan->caption() ?><?php echo $t_juduldetail_add->lama_pelatihan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_juduldetail_add->RightColumnClass ?>"><div <?php echo $t_juduldetail_add->lama_pelatihan->cellAttributes() ?>>
<span id="el_t_juduldetail_lama_pelatihan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_juduldetail" data-field="x_lama_pelatihan" data-value-separator="<?php echo $t_juduldetail_add->lama_pelatihan->displayValueSeparatorAttribute() ?>" id="x_lama_pelatihan" name="x_lama_pelatihan"<?php echo $t_juduldetail_add->lama_pelatihan->editAttributes() ?>>
			<?php echo $t_juduldetail_add->lama_pelatihan->selectOptionListHtml("x_lama_pelatihan") ?>
		</select>
</div>
<?php echo $t_juduldetail_add->lama_pelatihan->Lookup->getParamTag($t_juduldetail_add, "p_x_lama_pelatihan") ?>
</span>
<?php echo $t_juduldetail_add->lama_pelatihan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_juduldetail_add->catatan->Visible) { // catatan ?>
	<div id="r_catatan" class="form-group row">
		<label id="elh_t_juduldetail_catatan" for="x_catatan" class="<?php echo $t_juduldetail_add->LeftColumnClass ?>"><?php echo $t_juduldetail_add->catatan->caption() ?><?php echo $t_juduldetail_add->catatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_juduldetail_add->RightColumnClass ?>"><div <?php echo $t_juduldetail_add->catatan->cellAttributes() ?>>
<span id="el_t_juduldetail_catatan">
<textarea data-table="t_juduldetail" data-field="x_catatan" name="x_catatan" id="x_catatan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_juduldetail_add->catatan->getPlaceHolder()) ?>"<?php echo $t_juduldetail_add->catatan->editAttributes() ?>><?php echo $t_juduldetail_add->catatan->EditValue ?></textarea>
</span>
<?php echo $t_juduldetail_add->catatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("t_kurikulum", explode(",", $t_juduldetail->getCurrentDetailTable())) && $t_kurikulum->DetailAdd) {
?>
<?php if ($t_juduldetail->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("t_kurikulum", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "t_kurikulumgrid.php" ?>
<?php } ?>
<?php if (!$t_juduldetail_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_juduldetail_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_juduldetail_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_juduldetail_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$("#x_lama_pelatihan").after(" hari");
});
</script>
<?php include_once "footer.php"; ?>
<?php
$t_juduldetail_add->terminate();
?>