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
$v_kerjasama_edit = new v_kerjasama_edit();

// Run the page
$v_kerjasama_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v_kerjasama_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fv_kerjasamaedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fv_kerjasamaedit = currentForm = new ew.Form("fv_kerjasamaedit", "edit");

	// Validate form
	fv_kerjasamaedit.validate = function() {
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
			<?php if ($v_kerjasama_edit->kdpelat->Required) { ?>
				elm = this.getElements("x" + infix + "_kdpelat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_edit->kdpelat->caption(), $v_kerjasama_edit->kdpelat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_edit->kdjudul->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjudul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_edit->kdjudul->caption(), $v_kerjasama_edit->kdjudul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_edit->kdkursil->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkursil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_edit->kdkursil->caption(), $v_kerjasama_edit->kdkursil->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_edit->revisi->Required) { ?>
				elm = this.getElements("x" + infix + "_revisi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_edit->revisi->caption(), $v_kerjasama_edit->revisi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_edit->tgl_terbit->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_terbit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_edit->tgl_terbit->caption(), $v_kerjasama_edit->tgl_terbit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_terbit");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($v_kerjasama_edit->tgl_terbit->errorMessage()) ?>");
			<?php if ($v_kerjasama_edit->tawal->Required) { ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_edit->tawal->caption(), $v_kerjasama_edit->tawal->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_edit->takhir->Required) { ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_edit->takhir->caption(), $v_kerjasama_edit->takhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($v_kerjasama_edit->takhir->errorMessage()) ?>");
			<?php if ($v_kerjasama_edit->jenispel->Required) { ?>
				elm = this.getElements("x" + infix + "_jenispel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_edit->jenispel->caption(), $v_kerjasama_edit->jenispel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_edit->kdkategori->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkategori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_edit->kdkategori->caption(), $v_kerjasama_edit->kdkategori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_edit->kerjasama->Required) { ?>
				elm = this.getElements("x" + infix + "_kerjasama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_edit->kerjasama->caption(), $v_kerjasama_edit->kerjasama->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kerjasama");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($v_kerjasama_edit->kerjasama->errorMessage()) ?>");
			<?php if ($v_kerjasama_edit->biaya->Required) { ?>
				elm = this.getElements("x" + infix + "_biaya");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_edit->biaya->caption(), $v_kerjasama_edit->biaya->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_biaya");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($v_kerjasama_edit->biaya->errorMessage()) ?>");
			<?php if ($v_kerjasama_edit->tempat->Required) { ?>
				elm = this.getElements("x" + infix + "_tempat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_edit->tempat->caption(), $v_kerjasama_edit->tempat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_edit->target_peserta->Required) { ?>
				elm = this.getElements("x" + infix + "_target_peserta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_edit->target_peserta->caption(), $v_kerjasama_edit->target_peserta->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_edit->durasi1->Required) { ?>
				elm = this.getElements("x" + infix + "_durasi1");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_edit->durasi1->caption(), $v_kerjasama_edit->durasi1->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_edit->durasi2->Required) { ?>
				elm = this.getElements("x" + infix + "_durasi2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_edit->durasi2->caption(), $v_kerjasama_edit->durasi2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_edit->nmou->Required) { ?>
				felm = this.getElements("x" + infix + "_nmou");
				elm = this.getElements("fn_x" + infix + "_nmou");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_edit->nmou->caption(), $v_kerjasama_edit->nmou->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_edit->nmou2->Required) { ?>
				felm = this.getElements("x" + infix + "_nmou2");
				elm = this.getElements("fn_x" + infix + "_nmou2");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_edit->nmou2->caption(), $v_kerjasama_edit->nmou2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_edit->statuspel->Required) { ?>
				elm = this.getElements("x" + infix + "_statuspel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_edit->statuspel->caption(), $v_kerjasama_edit->statuspel->RequiredErrorMessage)) ?>");
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
	fv_kerjasamaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fv_kerjasamaedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fv_kerjasamaedit.lists["x_kdkursil"] = <?php echo $v_kerjasama_edit->kdkursil->Lookup->toClientList($v_kerjasama_edit) ?>;
	fv_kerjasamaedit.lists["x_kdkursil"].options = <?php echo JsonEncode($v_kerjasama_edit->kdkursil->lookupOptions()) ?>;
	fv_kerjasamaedit.autoSuggests["x_kdkursil"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fv_kerjasamaedit.lists["x_jenispel"] = <?php echo $v_kerjasama_edit->jenispel->Lookup->toClientList($v_kerjasama_edit) ?>;
	fv_kerjasamaedit.lists["x_jenispel"].options = <?php echo JsonEncode($v_kerjasama_edit->jenispel->options(FALSE, TRUE)) ?>;
	fv_kerjasamaedit.lists["x_kdkategori"] = <?php echo $v_kerjasama_edit->kdkategori->Lookup->toClientList($v_kerjasama_edit) ?>;
	fv_kerjasamaedit.lists["x_kdkategori"].options = <?php echo JsonEncode($v_kerjasama_edit->kdkategori->lookupOptions()) ?>;
	fv_kerjasamaedit.lists["x_kerjasama"] = <?php echo $v_kerjasama_edit->kerjasama->Lookup->toClientList($v_kerjasama_edit) ?>;
	fv_kerjasamaedit.lists["x_kerjasama"].options = <?php echo JsonEncode($v_kerjasama_edit->kerjasama->lookupOptions()) ?>;
	fv_kerjasamaedit.autoSuggests["x_kerjasama"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fv_kerjasamaedit.lists["x_statuspel"] = <?php echo $v_kerjasama_edit->statuspel->Lookup->toClientList($v_kerjasama_edit) ?>;
	fv_kerjasamaedit.lists["x_statuspel"].options = <?php echo JsonEncode($v_kerjasama_edit->statuspel->options(FALSE, TRUE)) ?>;
	loadjs.done("fv_kerjasamaedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//document.write('<?php echo cs_judul("edit","Mengubah Data Kerjasama");?>');

});
</script>
<?php $v_kerjasama_edit->showPageHeader(); ?>
<?php
$v_kerjasama_edit->showMessage();
?>
<form name="fv_kerjasamaedit" id="fv_kerjasamaedit" class="<?php echo $v_kerjasama_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v_kerjasama">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$v_kerjasama_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($v_kerjasama_edit->kdpelat->Visible) { // kdpelat ?>
	<div id="r_kdpelat" class="form-group row">
		<label id="elh_v_kerjasama_kdpelat" for="x_kdpelat" class="<?php echo $v_kerjasama_edit->LeftColumnClass ?>"><?php echo $v_kerjasama_edit->kdpelat->caption() ?><?php echo $v_kerjasama_edit->kdpelat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_edit->RightColumnClass ?>"><div <?php echo $v_kerjasama_edit->kdpelat->cellAttributes() ?>>
<span id="el_v_kerjasama_kdpelat">
<span<?php echo $v_kerjasama_edit->kdpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($v_kerjasama_edit->kdpelat->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="v_kerjasama" data-field="x_kdpelat" name="x_kdpelat" id="x_kdpelat" value="<?php echo HtmlEncode($v_kerjasama_edit->kdpelat->CurrentValue) ?>">
<?php echo $v_kerjasama_edit->kdpelat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_edit->kdjudul->Visible) { // kdjudul ?>
	<div id="r_kdjudul" class="form-group row">
		<label id="elh_v_kerjasama_kdjudul" class="<?php echo $v_kerjasama_edit->LeftColumnClass ?>"><?php echo $v_kerjasama_edit->kdjudul->caption() ?><?php echo $v_kerjasama_edit->kdjudul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_edit->RightColumnClass ?>"><div <?php echo $v_kerjasama_edit->kdjudul->cellAttributes() ?>>
<span id="el_v_kerjasama_kdjudul">
<span<?php echo $v_kerjasama_edit->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($v_kerjasama_edit->kdjudul->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="v_kerjasama" data-field="x_kdjudul" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($v_kerjasama_edit->kdjudul->CurrentValue) ?>">
<?php echo $v_kerjasama_edit->kdjudul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_edit->kdkursil->Visible) { // kdkursil ?>
	<div id="r_kdkursil" class="form-group row">
		<label id="elh_v_kerjasama_kdkursil" class="<?php echo $v_kerjasama_edit->LeftColumnClass ?>"><?php echo $v_kerjasama_edit->kdkursil->caption() ?><?php echo $v_kerjasama_edit->kdkursil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_edit->RightColumnClass ?>"><div <?php echo $v_kerjasama_edit->kdkursil->cellAttributes() ?>>
<span id="el_v_kerjasama_kdkursil">
<?php
$onchange = $v_kerjasama_edit->kdkursil->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$v_kerjasama_edit->kdkursil->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdkursil">
	<input type="text" class="form-control" name="sv_x_kdkursil" id="sv_x_kdkursil" value="<?php echo RemoveHtml($v_kerjasama_edit->kdkursil->EditValue) ?>" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($v_kerjasama_edit->kdkursil->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($v_kerjasama_edit->kdkursil->getPlaceHolder()) ?>"<?php echo $v_kerjasama_edit->kdkursil->editAttributes() ?>>
</span>
<input type="hidden" data-table="v_kerjasama" data-field="x_kdkursil" data-value-separator="<?php echo $v_kerjasama_edit->kdkursil->displayValueSeparatorAttribute() ?>" name="x_kdkursil" id="x_kdkursil" value="<?php echo HtmlEncode($v_kerjasama_edit->kdkursil->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fv_kerjasamaedit"], function() {
	fv_kerjasamaedit.createAutoSuggest({"id":"x_kdkursil","forceSelect":true});
});
</script>
<?php echo $v_kerjasama_edit->kdkursil->Lookup->getParamTag($v_kerjasama_edit, "p_x_kdkursil") ?>
</span>
<?php echo $v_kerjasama_edit->kdkursil->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_edit->revisi->Visible) { // revisi ?>
	<div id="r_revisi" class="form-group row">
		<label id="elh_v_kerjasama_revisi" for="x_revisi" class="<?php echo $v_kerjasama_edit->LeftColumnClass ?>"><?php echo $v_kerjasama_edit->revisi->caption() ?><?php echo $v_kerjasama_edit->revisi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_edit->RightColumnClass ?>"><div <?php echo $v_kerjasama_edit->revisi->cellAttributes() ?>>
<span id="el_v_kerjasama_revisi">
<input type="text" data-table="v_kerjasama" data-field="x_revisi" name="x_revisi" id="x_revisi" size="2" maxlength="2" placeholder="<?php echo HtmlEncode($v_kerjasama_edit->revisi->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_edit->revisi->EditValue ?>"<?php echo $v_kerjasama_edit->revisi->editAttributes() ?>>
</span>
<?php echo $v_kerjasama_edit->revisi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_edit->tgl_terbit->Visible) { // tgl_terbit ?>
	<div id="r_tgl_terbit" class="form-group row">
		<label id="elh_v_kerjasama_tgl_terbit" for="x_tgl_terbit" class="<?php echo $v_kerjasama_edit->LeftColumnClass ?>"><?php echo $v_kerjasama_edit->tgl_terbit->caption() ?><?php echo $v_kerjasama_edit->tgl_terbit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_edit->RightColumnClass ?>"><div <?php echo $v_kerjasama_edit->tgl_terbit->cellAttributes() ?>>
<span id="el_v_kerjasama_tgl_terbit">
<input type="text" data-table="v_kerjasama" data-field="x_tgl_terbit" name="x_tgl_terbit" id="x_tgl_terbit" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($v_kerjasama_edit->tgl_terbit->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_edit->tgl_terbit->EditValue ?>"<?php echo $v_kerjasama_edit->tgl_terbit->editAttributes() ?>>
<?php if (!$v_kerjasama_edit->tgl_terbit->ReadOnly && !$v_kerjasama_edit->tgl_terbit->Disabled && !isset($v_kerjasama_edit->tgl_terbit->EditAttrs["readonly"]) && !isset($v_kerjasama_edit->tgl_terbit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fv_kerjasamaedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fv_kerjasamaedit", "x_tgl_terbit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $v_kerjasama_edit->tgl_terbit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_edit->tawal->Visible) { // tawal ?>
	<div id="r_tawal" class="form-group row">
		<label id="elh_v_kerjasama_tawal" for="x_tawal" class="<?php echo $v_kerjasama_edit->LeftColumnClass ?>"><?php echo $v_kerjasama_edit->tawal->caption() ?><?php echo $v_kerjasama_edit->tawal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_edit->RightColumnClass ?>"><div <?php echo $v_kerjasama_edit->tawal->cellAttributes() ?>>
<span id="el_v_kerjasama_tawal">
<span<?php echo $v_kerjasama_edit->tawal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($v_kerjasama_edit->tawal->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="v_kerjasama" data-field="x_tawal" name="x_tawal" id="x_tawal" value="<?php echo HtmlEncode($v_kerjasama_edit->tawal->CurrentValue) ?>">
<?php echo $v_kerjasama_edit->tawal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_edit->takhir->Visible) { // takhir ?>
	<div id="r_takhir" class="form-group row">
		<label id="elh_v_kerjasama_takhir" for="x_takhir" class="<?php echo $v_kerjasama_edit->LeftColumnClass ?>"><?php echo $v_kerjasama_edit->takhir->caption() ?><?php echo $v_kerjasama_edit->takhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_edit->RightColumnClass ?>"><div <?php echo $v_kerjasama_edit->takhir->cellAttributes() ?>>
<span id="el_v_kerjasama_takhir">
<input type="text" data-table="v_kerjasama" data-field="x_takhir" name="x_takhir" id="x_takhir" size="10" placeholder="<?php echo HtmlEncode($v_kerjasama_edit->takhir->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_edit->takhir->EditValue ?>"<?php echo $v_kerjasama_edit->takhir->editAttributes() ?>>
<?php if (!$v_kerjasama_edit->takhir->ReadOnly && !$v_kerjasama_edit->takhir->Disabled && !isset($v_kerjasama_edit->takhir->EditAttrs["readonly"]) && !isset($v_kerjasama_edit->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fv_kerjasamaedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fv_kerjasamaedit", "x_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $v_kerjasama_edit->takhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_edit->jenispel->Visible) { // jenispel ?>
	<div id="r_jenispel" class="form-group row">
		<label id="elh_v_kerjasama_jenispel" for="x_jenispel" class="<?php echo $v_kerjasama_edit->LeftColumnClass ?>"><?php echo $v_kerjasama_edit->jenispel->caption() ?><?php echo $v_kerjasama_edit->jenispel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_edit->RightColumnClass ?>"><div <?php echo $v_kerjasama_edit->jenispel->cellAttributes() ?>>
<span id="el_v_kerjasama_jenispel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="v_kerjasama" data-field="x_jenispel" data-value-separator="<?php echo $v_kerjasama_edit->jenispel->displayValueSeparatorAttribute() ?>" id="x_jenispel" name="x_jenispel"<?php echo $v_kerjasama_edit->jenispel->editAttributes() ?>>
			<?php echo $v_kerjasama_edit->jenispel->selectOptionListHtml("x_jenispel") ?>
		</select>
</div>
</span>
<?php echo $v_kerjasama_edit->jenispel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_edit->kdkategori->Visible) { // kdkategori ?>
	<div id="r_kdkategori" class="form-group row">
		<label id="elh_v_kerjasama_kdkategori" for="x_kdkategori" class="<?php echo $v_kerjasama_edit->LeftColumnClass ?>"><?php echo $v_kerjasama_edit->kdkategori->caption() ?><?php echo $v_kerjasama_edit->kdkategori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_edit->RightColumnClass ?>"><div <?php echo $v_kerjasama_edit->kdkategori->cellAttributes() ?>>
<span id="el_v_kerjasama_kdkategori">
<?php $v_kerjasama_edit->kdkategori->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="v_kerjasama" data-field="x_kdkategori" data-value-separator="<?php echo $v_kerjasama_edit->kdkategori->displayValueSeparatorAttribute() ?>" id="x_kdkategori" name="x_kdkategori"<?php echo $v_kerjasama_edit->kdkategori->editAttributes() ?>>
			<?php echo $v_kerjasama_edit->kdkategori->selectOptionListHtml("x_kdkategori") ?>
		</select>
</div>
<?php echo $v_kerjasama_edit->kdkategori->Lookup->getParamTag($v_kerjasama_edit, "p_x_kdkategori") ?>
</span>
<?php echo $v_kerjasama_edit->kdkategori->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_edit->kerjasama->Visible) { // kerjasama ?>
	<div id="r_kerjasama" class="form-group row">
		<label id="elh_v_kerjasama_kerjasama" class="<?php echo $v_kerjasama_edit->LeftColumnClass ?>"><?php echo $v_kerjasama_edit->kerjasama->caption() ?><?php echo $v_kerjasama_edit->kerjasama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_edit->RightColumnClass ?>"><div <?php echo $v_kerjasama_edit->kerjasama->cellAttributes() ?>>
<span id="el_v_kerjasama_kerjasama">
<?php
$onchange = $v_kerjasama_edit->kerjasama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$v_kerjasama_edit->kerjasama->EditAttrs["onchange"] = "";
?>
<span id="as_x_kerjasama">
	<input type="text" class="form-control" name="sv_x_kerjasama" id="sv_x_kerjasama" value="<?php echo RemoveHtml($v_kerjasama_edit->kerjasama->EditValue) ?>" size="100" maxlength="11" placeholder="<?php echo HtmlEncode($v_kerjasama_edit->kerjasama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($v_kerjasama_edit->kerjasama->getPlaceHolder()) ?>"<?php echo $v_kerjasama_edit->kerjasama->editAttributes() ?>>
</span>
<input type="hidden" data-table="v_kerjasama" data-field="x_kerjasama" data-value-separator="<?php echo $v_kerjasama_edit->kerjasama->displayValueSeparatorAttribute() ?>" name="x_kerjasama" id="x_kerjasama" value="<?php echo HtmlEncode($v_kerjasama_edit->kerjasama->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fv_kerjasamaedit"], function() {
	fv_kerjasamaedit.createAutoSuggest({"id":"x_kerjasama","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $v_kerjasama_edit->kerjasama->Lookup->getParamTag($v_kerjasama_edit, "p_x_kerjasama") ?>
</span>
<?php echo $v_kerjasama_edit->kerjasama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_edit->biaya->Visible) { // biaya ?>
	<div id="r_biaya" class="form-group row">
		<label id="elh_v_kerjasama_biaya" for="x_biaya" class="<?php echo $v_kerjasama_edit->LeftColumnClass ?>"><?php echo $v_kerjasama_edit->biaya->caption() ?><?php echo $v_kerjasama_edit->biaya->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_edit->RightColumnClass ?>"><div <?php echo $v_kerjasama_edit->biaya->cellAttributes() ?>>
<span id="el_v_kerjasama_biaya">
<input type="text" data-table="v_kerjasama" data-field="x_biaya" name="x_biaya" id="x_biaya" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($v_kerjasama_edit->biaya->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_edit->biaya->EditValue ?>"<?php echo $v_kerjasama_edit->biaya->editAttributes() ?>>
</span>
<?php echo $v_kerjasama_edit->biaya->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_edit->tempat->Visible) { // tempat ?>
	<div id="r_tempat" class="form-group row">
		<label id="elh_v_kerjasama_tempat" for="x_tempat" class="<?php echo $v_kerjasama_edit->LeftColumnClass ?>"><?php echo $v_kerjasama_edit->tempat->caption() ?><?php echo $v_kerjasama_edit->tempat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_edit->RightColumnClass ?>"><div <?php echo $v_kerjasama_edit->tempat->cellAttributes() ?>>
<span id="el_v_kerjasama_tempat">
<input type="text" data-table="v_kerjasama" data-field="x_tempat" name="x_tempat" id="x_tempat" placeholder="<?php echo HtmlEncode($v_kerjasama_edit->tempat->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_edit->tempat->EditValue ?>"<?php echo $v_kerjasama_edit->tempat->editAttributes() ?>>
</span>
<?php echo $v_kerjasama_edit->tempat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_edit->target_peserta->Visible) { // target_peserta ?>
	<div id="r_target_peserta" class="form-group row">
		<label id="elh_v_kerjasama_target_peserta" for="x_target_peserta" class="<?php echo $v_kerjasama_edit->LeftColumnClass ?>"><?php echo $v_kerjasama_edit->target_peserta->caption() ?><?php echo $v_kerjasama_edit->target_peserta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_edit->RightColumnClass ?>"><div <?php echo $v_kerjasama_edit->target_peserta->cellAttributes() ?>>
<span id="el_v_kerjasama_target_peserta">
<input type="text" data-table="v_kerjasama" data-field="x_target_peserta" name="x_target_peserta" id="x_target_peserta" placeholder="<?php echo HtmlEncode($v_kerjasama_edit->target_peserta->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_edit->target_peserta->EditValue ?>"<?php echo $v_kerjasama_edit->target_peserta->editAttributes() ?>>
</span>
<?php echo $v_kerjasama_edit->target_peserta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_edit->durasi1->Visible) { // durasi1 ?>
	<div id="r_durasi1" class="form-group row">
		<label id="elh_v_kerjasama_durasi1" for="x_durasi1" class="<?php echo $v_kerjasama_edit->LeftColumnClass ?>"><?php echo $v_kerjasama_edit->durasi1->caption() ?><?php echo $v_kerjasama_edit->durasi1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_edit->RightColumnClass ?>"><div <?php echo $v_kerjasama_edit->durasi1->cellAttributes() ?>>
<span id="el_v_kerjasama_durasi1">
<input type="text" data-table="v_kerjasama" data-field="x_durasi1" name="x_durasi1" id="x_durasi1" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($v_kerjasama_edit->durasi1->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_edit->durasi1->EditValue ?>"<?php echo $v_kerjasama_edit->durasi1->editAttributes() ?>>
<?php if (!$v_kerjasama_edit->durasi1->ReadOnly && !$v_kerjasama_edit->durasi1->Disabled && !isset($v_kerjasama_edit->durasi1->EditAttrs["readonly"]) && !isset($v_kerjasama_edit->durasi1->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fv_kerjasamaedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fv_kerjasamaedit", "x_durasi1", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $v_kerjasama_edit->durasi1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_edit->durasi2->Visible) { // durasi2 ?>
	<div id="r_durasi2" class="form-group row">
		<label id="elh_v_kerjasama_durasi2" for="x_durasi2" class="<?php echo $v_kerjasama_edit->LeftColumnClass ?>"><?php echo $v_kerjasama_edit->durasi2->caption() ?><?php echo $v_kerjasama_edit->durasi2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_edit->RightColumnClass ?>"><div <?php echo $v_kerjasama_edit->durasi2->cellAttributes() ?>>
<span id="el_v_kerjasama_durasi2">
<input type="text" data-table="v_kerjasama" data-field="x_durasi2" name="x_durasi2" id="x_durasi2" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($v_kerjasama_edit->durasi2->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_edit->durasi2->EditValue ?>"<?php echo $v_kerjasama_edit->durasi2->editAttributes() ?>>
</span>
<?php echo $v_kerjasama_edit->durasi2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_edit->nmou->Visible) { // nmou ?>
	<div id="r_nmou" class="form-group row">
		<label id="elh_v_kerjasama_nmou" class="<?php echo $v_kerjasama_edit->LeftColumnClass ?>"><?php echo $v_kerjasama_edit->nmou->caption() ?><?php echo $v_kerjasama_edit->nmou->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_edit->RightColumnClass ?>"><div <?php echo $v_kerjasama_edit->nmou->cellAttributes() ?>>
<span id="el_v_kerjasama_nmou">
<div id="fd_x_nmou">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $v_kerjasama_edit->nmou->title() ?>" data-table="v_kerjasama" data-field="x_nmou" name="x_nmou" id="x_nmou" lang="<?php echo CurrentLanguageID() ?>"<?php echo $v_kerjasama_edit->nmou->editAttributes() ?><?php if ($v_kerjasama_edit->nmou->ReadOnly || $v_kerjasama_edit->nmou->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_nmou"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_nmou" id= "fn_x_nmou" value="<?php echo $v_kerjasama_edit->nmou->Upload->FileName ?>">
<input type="hidden" name="fa_x_nmou" id= "fa_x_nmou" value="<?php echo (Post("fa_x_nmou") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_nmou" id= "fs_x_nmou" value="255">
<input type="hidden" name="fx_x_nmou" id= "fx_x_nmou" value="<?php echo $v_kerjasama_edit->nmou->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_nmou" id= "fm_x_nmou" value="<?php echo $v_kerjasama_edit->nmou->UploadMaxFileSize ?>">
</div>
<table id="ft_x_nmou" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $v_kerjasama_edit->nmou->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_edit->nmou2->Visible) { // nmou2 ?>
	<div id="r_nmou2" class="form-group row">
		<label id="elh_v_kerjasama_nmou2" class="<?php echo $v_kerjasama_edit->LeftColumnClass ?>"><?php echo $v_kerjasama_edit->nmou2->caption() ?><?php echo $v_kerjasama_edit->nmou2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_edit->RightColumnClass ?>"><div <?php echo $v_kerjasama_edit->nmou2->cellAttributes() ?>>
<span id="el_v_kerjasama_nmou2">
<div id="fd_x_nmou2">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $v_kerjasama_edit->nmou2->title() ?>" data-table="v_kerjasama" data-field="x_nmou2" name="x_nmou2" id="x_nmou2" lang="<?php echo CurrentLanguageID() ?>"<?php echo $v_kerjasama_edit->nmou2->editAttributes() ?><?php if ($v_kerjasama_edit->nmou2->ReadOnly || $v_kerjasama_edit->nmou2->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_nmou2"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_nmou2" id= "fn_x_nmou2" value="<?php echo $v_kerjasama_edit->nmou2->Upload->FileName ?>">
<input type="hidden" name="fa_x_nmou2" id= "fa_x_nmou2" value="<?php echo (Post("fa_x_nmou2") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_nmou2" id= "fs_x_nmou2" value="255">
<input type="hidden" name="fx_x_nmou2" id= "fx_x_nmou2" value="<?php echo $v_kerjasama_edit->nmou2->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_nmou2" id= "fm_x_nmou2" value="<?php echo $v_kerjasama_edit->nmou2->UploadMaxFileSize ?>">
</div>
<table id="ft_x_nmou2" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $v_kerjasama_edit->nmou2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_edit->statuspel->Visible) { // statuspel ?>
	<div id="r_statuspel" class="form-group row">
		<label id="elh_v_kerjasama_statuspel" for="x_statuspel" class="<?php echo $v_kerjasama_edit->LeftColumnClass ?>"><?php echo $v_kerjasama_edit->statuspel->caption() ?><?php echo $v_kerjasama_edit->statuspel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_edit->RightColumnClass ?>"><div <?php echo $v_kerjasama_edit->statuspel->cellAttributes() ?>>
<span id="el_v_kerjasama_statuspel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="v_kerjasama" data-field="x_statuspel" data-value-separator="<?php echo $v_kerjasama_edit->statuspel->displayValueSeparatorAttribute() ?>" id="x_statuspel" name="x_statuspel"<?php echo $v_kerjasama_edit->statuspel->editAttributes() ?>>
			<?php echo $v_kerjasama_edit->statuspel->selectOptionListHtml("x_statuspel") ?>
		</select>
</div>
</span>
<?php echo $v_kerjasama_edit->statuspel->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$v_kerjasama_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $v_kerjasama_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $v_kerjasama_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$v_kerjasama_edit->showPageFooter();
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
$v_kerjasama_edit->terminate();
?>