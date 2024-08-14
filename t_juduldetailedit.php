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
$t_juduldetail_edit = new t_juduldetail_edit();

// Run the page
$t_juduldetail_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_juduldetail_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_juduldetailedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_juduldetailedit = currentForm = new ew.Form("ft_juduldetailedit", "edit");

	// Validate form
	ft_juduldetailedit.validate = function() {
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
			<?php if ($t_juduldetail_edit->singbagian->Required) { ?>
				elm = this.getElements("x" + infix + "_singbagian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_edit->singbagian->caption(), $t_juduldetail_edit->singbagian->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_edit->jpel->Required) { ?>
				elm = this.getElements("x" + infix + "_jpel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_edit->jpel->caption(), $t_juduldetail_edit->jpel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_edit->kdjudul->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjudul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_edit->kdjudul->caption(), $t_juduldetail_edit->kdjudul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_edit->kdkursil->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkursil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_edit->kdkursil->caption(), $t_juduldetail_edit->kdkursil->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_edit->revisi->Required) { ?>
				elm = this.getElements("x" + infix + "_revisi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_edit->revisi->caption(), $t_juduldetail_edit->revisi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_edit->tgl_terbit->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_terbit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_edit->tgl_terbit->caption(), $t_juduldetail_edit->tgl_terbit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_terbit");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_juduldetail_edit->tgl_terbit->errorMessage()) ?>");
			<?php if ($t_juduldetail_edit->deskripsi_singkat->Required) { ?>
				elm = this.getElements("x" + infix + "_deskripsi_singkat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_edit->deskripsi_singkat->caption(), $t_juduldetail_edit->deskripsi_singkat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_edit->tujuan->Required) { ?>
				elm = this.getElements("x" + infix + "_tujuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_edit->tujuan->caption(), $t_juduldetail_edit->tujuan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_edit->target_peserta->Required) { ?>
				elm = this.getElements("x" + infix + "_target_peserta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_edit->target_peserta->caption(), $t_juduldetail_edit->target_peserta->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_edit->lama_pelatihan->Required) { ?>
				elm = this.getElements("x" + infix + "_lama_pelatihan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_edit->lama_pelatihan->caption(), $t_juduldetail_edit->lama_pelatihan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_edit->catatan->Required) { ?>
				elm = this.getElements("x" + infix + "_catatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_edit->catatan->caption(), $t_juduldetail_edit->catatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_edit->updated_by->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_edit->updated_by->caption(), $t_juduldetail_edit->updated_by->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_juduldetail_edit->updated_at->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_juduldetail_edit->updated_at->caption(), $t_juduldetail_edit->updated_at->RequiredErrorMessage)) ?>");
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
	ft_juduldetailedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_juduldetailedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_juduldetailedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_juduldetail_edit->showPageHeader(); ?>
<?php
$t_juduldetail_edit->showMessage();
?>
<form name="ft_juduldetailedit" id="ft_juduldetailedit" class="<?php echo $t_juduldetail_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_juduldetail">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_juduldetail_edit->IsModal ?>">
<?php if ($t_juduldetail->getCurrentMasterTable() == "t_judul") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_judul">
<input type="hidden" name="fk_kdjudul" value="<?php echo HtmlEncode($t_juduldetail_edit->kdjudul->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_juduldetail_edit->singbagian->Visible) { // singbagian ?>
	<div id="r_singbagian" class="form-group row">
		<label id="elh_t_juduldetail_singbagian" for="x_singbagian" class="<?php echo $t_juduldetail_edit->LeftColumnClass ?>"><?php echo $t_juduldetail_edit->singbagian->caption() ?><?php echo $t_juduldetail_edit->singbagian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_juduldetail_edit->RightColumnClass ?>"><div <?php echo $t_juduldetail_edit->singbagian->cellAttributes() ?>>
<span id="el_t_juduldetail_singbagian">
<span<?php echo $t_juduldetail_edit->singbagian->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_juduldetail_edit->singbagian->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_singbagian" name="x_singbagian" id="x_singbagian" value="<?php echo HtmlEncode($t_juduldetail_edit->singbagian->CurrentValue) ?>">
<?php echo $t_juduldetail_edit->singbagian->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_juduldetail_edit->jpel->Visible) { // jpel ?>
	<div id="r_jpel" class="form-group row">
		<label id="elh_t_juduldetail_jpel" for="x_jpel" class="<?php echo $t_juduldetail_edit->LeftColumnClass ?>"><?php echo $t_juduldetail_edit->jpel->caption() ?><?php echo $t_juduldetail_edit->jpel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_juduldetail_edit->RightColumnClass ?>"><div <?php echo $t_juduldetail_edit->jpel->cellAttributes() ?>>
<span id="el_t_juduldetail_jpel">
<span<?php echo $t_juduldetail_edit->jpel->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_juduldetail_edit->jpel->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_jpel" name="x_jpel" id="x_jpel" value="<?php echo HtmlEncode($t_juduldetail_edit->jpel->CurrentValue) ?>">
<?php echo $t_juduldetail_edit->jpel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_juduldetail_edit->kdjudul->Visible) { // kdjudul ?>
	<div id="r_kdjudul" class="form-group row">
		<label id="elh_t_juduldetail_kdjudul" class="<?php echo $t_juduldetail_edit->LeftColumnClass ?>"><?php echo $t_juduldetail_edit->kdjudul->caption() ?><?php echo $t_juduldetail_edit->kdjudul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_juduldetail_edit->RightColumnClass ?>"><div <?php echo $t_juduldetail_edit->kdjudul->cellAttributes() ?>>
<span id="el_t_juduldetail_kdjudul">
<span<?php echo $t_juduldetail_edit->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_juduldetail_edit->kdjudul->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_kdjudul" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($t_juduldetail_edit->kdjudul->CurrentValue) ?>">
<?php echo $t_juduldetail_edit->kdjudul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_juduldetail_edit->kdkursil->Visible) { // kdkursil ?>
	<div id="r_kdkursil" class="form-group row">
		<label id="elh_t_juduldetail_kdkursil" for="x_kdkursil" class="<?php echo $t_juduldetail_edit->LeftColumnClass ?>"><?php echo $t_juduldetail_edit->kdkursil->caption() ?><?php echo $t_juduldetail_edit->kdkursil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_juduldetail_edit->RightColumnClass ?>"><div <?php echo $t_juduldetail_edit->kdkursil->cellAttributes() ?>>
<span id="el_t_juduldetail_kdkursil">
<span<?php echo $t_juduldetail_edit->kdkursil->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_juduldetail_edit->kdkursil->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_kdkursil" name="x_kdkursil" id="x_kdkursil" value="<?php echo HtmlEncode($t_juduldetail_edit->kdkursil->CurrentValue) ?>">
<?php echo $t_juduldetail_edit->kdkursil->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_juduldetail_edit->revisi->Visible) { // revisi ?>
	<div id="r_revisi" class="form-group row">
		<label id="elh_t_juduldetail_revisi" for="x_revisi" class="<?php echo $t_juduldetail_edit->LeftColumnClass ?>"><?php echo $t_juduldetail_edit->revisi->caption() ?><?php echo $t_juduldetail_edit->revisi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_juduldetail_edit->RightColumnClass ?>"><div <?php echo $t_juduldetail_edit->revisi->cellAttributes() ?>>
<span id="el_t_juduldetail_revisi">
<span<?php echo $t_juduldetail_edit->revisi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_juduldetail_edit->revisi->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_revisi" name="x_revisi" id="x_revisi" value="<?php echo HtmlEncode($t_juduldetail_edit->revisi->CurrentValue) ?>">
<?php echo $t_juduldetail_edit->revisi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_juduldetail_edit->tgl_terbit->Visible) { // tgl_terbit ?>
	<div id="r_tgl_terbit" class="form-group row">
		<label id="elh_t_juduldetail_tgl_terbit" for="x_tgl_terbit" class="<?php echo $t_juduldetail_edit->LeftColumnClass ?>"><?php echo $t_juduldetail_edit->tgl_terbit->caption() ?><?php echo $t_juduldetail_edit->tgl_terbit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_juduldetail_edit->RightColumnClass ?>"><div <?php echo $t_juduldetail_edit->tgl_terbit->cellAttributes() ?>>
<span id="el_t_juduldetail_tgl_terbit">
<input type="text" data-table="t_juduldetail" data-field="x_tgl_terbit" name="x_tgl_terbit" id="x_tgl_terbit" size="7" maxlength="10" placeholder="<?php echo HtmlEncode($t_juduldetail_edit->tgl_terbit->getPlaceHolder()) ?>" value="<?php echo $t_juduldetail_edit->tgl_terbit->EditValue ?>"<?php echo $t_juduldetail_edit->tgl_terbit->editAttributes() ?>>
<?php if (!$t_juduldetail_edit->tgl_terbit->ReadOnly && !$t_juduldetail_edit->tgl_terbit->Disabled && !isset($t_juduldetail_edit->tgl_terbit->EditAttrs["readonly"]) && !isset($t_juduldetail_edit->tgl_terbit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_juduldetailedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_juduldetailedit", "x_tgl_terbit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_juduldetail_edit->tgl_terbit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_juduldetail_edit->deskripsi_singkat->Visible) { // deskripsi_singkat ?>
	<div id="r_deskripsi_singkat" class="form-group row">
		<label id="elh_t_juduldetail_deskripsi_singkat" for="x_deskripsi_singkat" class="<?php echo $t_juduldetail_edit->LeftColumnClass ?>"><?php echo $t_juduldetail_edit->deskripsi_singkat->caption() ?><?php echo $t_juduldetail_edit->deskripsi_singkat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_juduldetail_edit->RightColumnClass ?>"><div <?php echo $t_juduldetail_edit->deskripsi_singkat->cellAttributes() ?>>
<span id="el_t_juduldetail_deskripsi_singkat">
<textarea data-table="t_juduldetail" data-field="x_deskripsi_singkat" name="x_deskripsi_singkat" id="x_deskripsi_singkat" cols="95" rows="6" placeholder="<?php echo HtmlEncode($t_juduldetail_edit->deskripsi_singkat->getPlaceHolder()) ?>"<?php echo $t_juduldetail_edit->deskripsi_singkat->editAttributes() ?>><?php echo $t_juduldetail_edit->deskripsi_singkat->EditValue ?></textarea>
</span>
<?php echo $t_juduldetail_edit->deskripsi_singkat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_juduldetail_edit->tujuan->Visible) { // tujuan ?>
	<div id="r_tujuan" class="form-group row">
		<label id="elh_t_juduldetail_tujuan" for="x_tujuan" class="<?php echo $t_juduldetail_edit->LeftColumnClass ?>"><?php echo $t_juduldetail_edit->tujuan->caption() ?><?php echo $t_juduldetail_edit->tujuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_juduldetail_edit->RightColumnClass ?>"><div <?php echo $t_juduldetail_edit->tujuan->cellAttributes() ?>>
<span id="el_t_juduldetail_tujuan">
<textarea data-table="t_juduldetail" data-field="x_tujuan" name="x_tujuan" id="x_tujuan" cols="95" rows="2" placeholder="<?php echo HtmlEncode($t_juduldetail_edit->tujuan->getPlaceHolder()) ?>"<?php echo $t_juduldetail_edit->tujuan->editAttributes() ?>><?php echo $t_juduldetail_edit->tujuan->EditValue ?></textarea>
</span>
<?php echo $t_juduldetail_edit->tujuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_juduldetail_edit->target_peserta->Visible) { // target_peserta ?>
	<div id="r_target_peserta" class="form-group row">
		<label id="elh_t_juduldetail_target_peserta" for="x_target_peserta" class="<?php echo $t_juduldetail_edit->LeftColumnClass ?>"><?php echo $t_juduldetail_edit->target_peserta->caption() ?><?php echo $t_juduldetail_edit->target_peserta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_juduldetail_edit->RightColumnClass ?>"><div <?php echo $t_juduldetail_edit->target_peserta->cellAttributes() ?>>
<span id="el_t_juduldetail_target_peserta">
<textarea data-table="t_juduldetail" data-field="x_target_peserta" name="x_target_peserta" id="x_target_peserta" cols="95" rows="2" placeholder="<?php echo HtmlEncode($t_juduldetail_edit->target_peserta->getPlaceHolder()) ?>"<?php echo $t_juduldetail_edit->target_peserta->editAttributes() ?>><?php echo $t_juduldetail_edit->target_peserta->EditValue ?></textarea>
</span>
<?php echo $t_juduldetail_edit->target_peserta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_juduldetail_edit->lama_pelatihan->Visible) { // lama_pelatihan ?>
	<div id="r_lama_pelatihan" class="form-group row">
		<label id="elh_t_juduldetail_lama_pelatihan" for="x_lama_pelatihan" class="<?php echo $t_juduldetail_edit->LeftColumnClass ?>"><?php echo $t_juduldetail_edit->lama_pelatihan->caption() ?><?php echo $t_juduldetail_edit->lama_pelatihan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_juduldetail_edit->RightColumnClass ?>"><div <?php echo $t_juduldetail_edit->lama_pelatihan->cellAttributes() ?>>
<span id="el_t_juduldetail_lama_pelatihan">
<span<?php echo $t_juduldetail_edit->lama_pelatihan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_juduldetail_edit->lama_pelatihan->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_juduldetail" data-field="x_lama_pelatihan" name="x_lama_pelatihan" id="x_lama_pelatihan" value="<?php echo HtmlEncode($t_juduldetail_edit->lama_pelatihan->CurrentValue) ?>">
<?php echo $t_juduldetail_edit->lama_pelatihan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_juduldetail_edit->catatan->Visible) { // catatan ?>
	<div id="r_catatan" class="form-group row">
		<label id="elh_t_juduldetail_catatan" for="x_catatan" class="<?php echo $t_juduldetail_edit->LeftColumnClass ?>"><?php echo $t_juduldetail_edit->catatan->caption() ?><?php echo $t_juduldetail_edit->catatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_juduldetail_edit->RightColumnClass ?>"><div <?php echo $t_juduldetail_edit->catatan->cellAttributes() ?>>
<span id="el_t_juduldetail_catatan">
<textarea data-table="t_juduldetail" data-field="x_catatan" name="x_catatan" id="x_catatan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_juduldetail_edit->catatan->getPlaceHolder()) ?>"<?php echo $t_juduldetail_edit->catatan->editAttributes() ?>><?php echo $t_juduldetail_edit->catatan->EditValue ?></textarea>
</span>
<?php echo $t_juduldetail_edit->catatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="t_juduldetail" data-field="x_detailjdid" name="x_detailjdid" id="x_detailjdid" value="<?php echo HtmlEncode($t_juduldetail_edit->detailjdid->CurrentValue) ?>">
<?php
	if (in_array("t_kurikulum", explode(",", $t_juduldetail->getCurrentDetailTable())) && $t_kurikulum->DetailEdit) {
?>
<?php if ($t_juduldetail->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("t_kurikulum", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "t_kurikulumgrid.php" ?>
<?php } ?>
<?php if (!$t_juduldetail_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_juduldetail_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_juduldetail_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_juduldetail_edit->showPageFooter();
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
$t_juduldetail_edit->terminate();
?>