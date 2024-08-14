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
$v_kerjasama_add = new v_kerjasama_add();

// Run the page
$v_kerjasama_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v_kerjasama_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fv_kerjasamaadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fv_kerjasamaadd = currentForm = new ew.Form("fv_kerjasamaadd", "add");

	// Validate form
	fv_kerjasamaadd.validate = function() {
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
			<?php if ($v_kerjasama_add->kdpelat->Required) { ?>
				elm = this.getElements("x" + infix + "_kdpelat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_add->kdpelat->caption(), $v_kerjasama_add->kdpelat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_add->kdjudul->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjudul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_add->kdjudul->caption(), $v_kerjasama_add->kdjudul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_add->kdkursil->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkursil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_add->kdkursil->caption(), $v_kerjasama_add->kdkursil->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_add->revisi->Required) { ?>
				elm = this.getElements("x" + infix + "_revisi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_add->revisi->caption(), $v_kerjasama_add->revisi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_add->tgl_terbit->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_terbit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_add->tgl_terbit->caption(), $v_kerjasama_add->tgl_terbit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_terbit");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($v_kerjasama_add->tgl_terbit->errorMessage()) ?>");
			<?php if ($v_kerjasama_add->tawal->Required) { ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_add->tawal->caption(), $v_kerjasama_add->tawal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($v_kerjasama_add->tawal->errorMessage()) ?>");
			<?php if ($v_kerjasama_add->takhir->Required) { ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_add->takhir->caption(), $v_kerjasama_add->takhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($v_kerjasama_add->takhir->errorMessage()) ?>");
			<?php if ($v_kerjasama_add->jenispel->Required) { ?>
				elm = this.getElements("x" + infix + "_jenispel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_add->jenispel->caption(), $v_kerjasama_add->jenispel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_add->kdkategori->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkategori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_add->kdkategori->caption(), $v_kerjasama_add->kdkategori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_add->kerjasama->Required) { ?>
				elm = this.getElements("x" + infix + "_kerjasama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_add->kerjasama->caption(), $v_kerjasama_add->kerjasama->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kerjasama");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($v_kerjasama_add->kerjasama->errorMessage()) ?>");
			<?php if ($v_kerjasama_add->biaya->Required) { ?>
				elm = this.getElements("x" + infix + "_biaya");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_add->biaya->caption(), $v_kerjasama_add->biaya->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_biaya");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($v_kerjasama_add->biaya->errorMessage()) ?>");
			<?php if ($v_kerjasama_add->tempat->Required) { ?>
				elm = this.getElements("x" + infix + "_tempat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_add->tempat->caption(), $v_kerjasama_add->tempat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_add->target_peserta->Required) { ?>
				elm = this.getElements("x" + infix + "_target_peserta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_add->target_peserta->caption(), $v_kerjasama_add->target_peserta->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_add->durasi1->Required) { ?>
				elm = this.getElements("x" + infix + "_durasi1");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_add->durasi1->caption(), $v_kerjasama_add->durasi1->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_add->durasi2->Required) { ?>
				elm = this.getElements("x" + infix + "_durasi2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_add->durasi2->caption(), $v_kerjasama_add->durasi2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_add->nmou->Required) { ?>
				felm = this.getElements("x" + infix + "_nmou");
				elm = this.getElements("fn_x" + infix + "_nmou");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_add->nmou->caption(), $v_kerjasama_add->nmou->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_add->nmou2->Required) { ?>
				felm = this.getElements("x" + infix + "_nmou2");
				elm = this.getElements("fn_x" + infix + "_nmou2");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_add->nmou2->caption(), $v_kerjasama_add->nmou2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($v_kerjasama_add->statuspel->Required) { ?>
				elm = this.getElements("x" + infix + "_statuspel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $v_kerjasama_add->statuspel->caption(), $v_kerjasama_add->statuspel->RequiredErrorMessage)) ?>");
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
	fv_kerjasamaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fv_kerjasamaadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fv_kerjasamaadd.lists["x_kdjudul"] = <?php echo $v_kerjasama_add->kdjudul->Lookup->toClientList($v_kerjasama_add) ?>;
	fv_kerjasamaadd.lists["x_kdjudul"].options = <?php echo JsonEncode($v_kerjasama_add->kdjudul->lookupOptions()) ?>;
	fv_kerjasamaadd.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fv_kerjasamaadd.lists["x_kdkursil"] = <?php echo $v_kerjasama_add->kdkursil->Lookup->toClientList($v_kerjasama_add) ?>;
	fv_kerjasamaadd.lists["x_kdkursil"].options = <?php echo JsonEncode($v_kerjasama_add->kdkursil->lookupOptions()) ?>;
	fv_kerjasamaadd.autoSuggests["x_kdkursil"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fv_kerjasamaadd.lists["x_jenispel"] = <?php echo $v_kerjasama_add->jenispel->Lookup->toClientList($v_kerjasama_add) ?>;
	fv_kerjasamaadd.lists["x_jenispel"].options = <?php echo JsonEncode($v_kerjasama_add->jenispel->options(FALSE, TRUE)) ?>;
	fv_kerjasamaadd.lists["x_kdkategori"] = <?php echo $v_kerjasama_add->kdkategori->Lookup->toClientList($v_kerjasama_add) ?>;
	fv_kerjasamaadd.lists["x_kdkategori"].options = <?php echo JsonEncode($v_kerjasama_add->kdkategori->lookupOptions()) ?>;
	fv_kerjasamaadd.lists["x_kerjasama"] = <?php echo $v_kerjasama_add->kerjasama->Lookup->toClientList($v_kerjasama_add) ?>;
	fv_kerjasamaadd.lists["x_kerjasama"].options = <?php echo JsonEncode($v_kerjasama_add->kerjasama->lookupOptions()) ?>;
	fv_kerjasamaadd.autoSuggests["x_kerjasama"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fv_kerjasamaadd.lists["x_statuspel"] = <?php echo $v_kerjasama_add->statuspel->Lookup->toClientList($v_kerjasama_add) ?>;
	fv_kerjasamaadd.lists["x_statuspel"].options = <?php echo JsonEncode($v_kerjasama_add->statuspel->options(FALSE, TRUE)) ?>;
	loadjs.done("fv_kerjasamaadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//document.write('<?php echo cs_judul("add","Menambah Data Kerjasama");?>');

});
</script>
<?php $v_kerjasama_add->showPageHeader(); ?>
<?php
$v_kerjasama_add->showMessage();
?>
<form name="fv_kerjasamaadd" id="fv_kerjasamaadd" class="<?php echo $v_kerjasama_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v_kerjasama">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$v_kerjasama_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($v_kerjasama_add->kdpelat->Visible) { // kdpelat ?>
	<div id="r_kdpelat" class="form-group row">
		<label id="elh_v_kerjasama_kdpelat" for="x_kdpelat" class="<?php echo $v_kerjasama_add->LeftColumnClass ?>"><?php echo $v_kerjasama_add->kdpelat->caption() ?><?php echo $v_kerjasama_add->kdpelat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_add->RightColumnClass ?>"><div <?php echo $v_kerjasama_add->kdpelat->cellAttributes() ?>>
<span id="el_v_kerjasama_kdpelat">
<input type="text" data-table="v_kerjasama" data-field="x_kdpelat" name="x_kdpelat" id="x_kdpelat" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($v_kerjasama_add->kdpelat->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_add->kdpelat->EditValue ?>"<?php echo $v_kerjasama_add->kdpelat->editAttributes() ?>>
</span>
<?php echo $v_kerjasama_add->kdpelat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_add->kdjudul->Visible) { // kdjudul ?>
	<div id="r_kdjudul" class="form-group row">
		<label id="elh_v_kerjasama_kdjudul" class="<?php echo $v_kerjasama_add->LeftColumnClass ?>"><?php echo $v_kerjasama_add->kdjudul->caption() ?><?php echo $v_kerjasama_add->kdjudul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_add->RightColumnClass ?>"><div <?php echo $v_kerjasama_add->kdjudul->cellAttributes() ?>>
<span id="el_v_kerjasama_kdjudul">
<?php
$onchange = $v_kerjasama_add->kdjudul->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$v_kerjasama_add->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($v_kerjasama_add->kdjudul->EditValue) ?>" size="100" placeholder="<?php echo HtmlEncode($v_kerjasama_add->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($v_kerjasama_add->kdjudul->getPlaceHolder()) ?>"<?php echo $v_kerjasama_add->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="v_kerjasama" data-field="x_kdjudul" data-value-separator="<?php echo $v_kerjasama_add->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($v_kerjasama_add->kdjudul->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fv_kerjasamaadd"], function() {
	fv_kerjasamaadd.createAutoSuggest({"id":"x_kdjudul","forceSelect":true,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $v_kerjasama_add->kdjudul->Lookup->getParamTag($v_kerjasama_add, "p_x_kdjudul") ?>
</span>
<?php echo $v_kerjasama_add->kdjudul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_add->kdkursil->Visible) { // kdkursil ?>
	<div id="r_kdkursil" class="form-group row">
		<label id="elh_v_kerjasama_kdkursil" class="<?php echo $v_kerjasama_add->LeftColumnClass ?>"><?php echo $v_kerjasama_add->kdkursil->caption() ?><?php echo $v_kerjasama_add->kdkursil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_add->RightColumnClass ?>"><div <?php echo $v_kerjasama_add->kdkursil->cellAttributes() ?>>
<span id="el_v_kerjasama_kdkursil">
<?php
$onchange = $v_kerjasama_add->kdkursil->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$v_kerjasama_add->kdkursil->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdkursil">
	<input type="text" class="form-control" name="sv_x_kdkursil" id="sv_x_kdkursil" value="<?php echo RemoveHtml($v_kerjasama_add->kdkursil->EditValue) ?>" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($v_kerjasama_add->kdkursil->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($v_kerjasama_add->kdkursil->getPlaceHolder()) ?>"<?php echo $v_kerjasama_add->kdkursil->editAttributes() ?>>
</span>
<input type="hidden" data-table="v_kerjasama" data-field="x_kdkursil" data-value-separator="<?php echo $v_kerjasama_add->kdkursil->displayValueSeparatorAttribute() ?>" name="x_kdkursil" id="x_kdkursil" value="<?php echo HtmlEncode($v_kerjasama_add->kdkursil->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fv_kerjasamaadd"], function() {
	fv_kerjasamaadd.createAutoSuggest({"id":"x_kdkursil","forceSelect":true});
});
</script>
<?php echo $v_kerjasama_add->kdkursil->Lookup->getParamTag($v_kerjasama_add, "p_x_kdkursil") ?>
</span>
<?php echo $v_kerjasama_add->kdkursil->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_add->revisi->Visible) { // revisi ?>
	<div id="r_revisi" class="form-group row">
		<label id="elh_v_kerjasama_revisi" for="x_revisi" class="<?php echo $v_kerjasama_add->LeftColumnClass ?>"><?php echo $v_kerjasama_add->revisi->caption() ?><?php echo $v_kerjasama_add->revisi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_add->RightColumnClass ?>"><div <?php echo $v_kerjasama_add->revisi->cellAttributes() ?>>
<span id="el_v_kerjasama_revisi">
<input type="text" data-table="v_kerjasama" data-field="x_revisi" name="x_revisi" id="x_revisi" size="2" maxlength="2" placeholder="<?php echo HtmlEncode($v_kerjasama_add->revisi->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_add->revisi->EditValue ?>"<?php echo $v_kerjasama_add->revisi->editAttributes() ?>>
</span>
<?php echo $v_kerjasama_add->revisi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_add->tgl_terbit->Visible) { // tgl_terbit ?>
	<div id="r_tgl_terbit" class="form-group row">
		<label id="elh_v_kerjasama_tgl_terbit" for="x_tgl_terbit" class="<?php echo $v_kerjasama_add->LeftColumnClass ?>"><?php echo $v_kerjasama_add->tgl_terbit->caption() ?><?php echo $v_kerjasama_add->tgl_terbit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_add->RightColumnClass ?>"><div <?php echo $v_kerjasama_add->tgl_terbit->cellAttributes() ?>>
<span id="el_v_kerjasama_tgl_terbit">
<input type="text" data-table="v_kerjasama" data-field="x_tgl_terbit" name="x_tgl_terbit" id="x_tgl_terbit" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($v_kerjasama_add->tgl_terbit->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_add->tgl_terbit->EditValue ?>"<?php echo $v_kerjasama_add->tgl_terbit->editAttributes() ?>>
<?php if (!$v_kerjasama_add->tgl_terbit->ReadOnly && !$v_kerjasama_add->tgl_terbit->Disabled && !isset($v_kerjasama_add->tgl_terbit->EditAttrs["readonly"]) && !isset($v_kerjasama_add->tgl_terbit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fv_kerjasamaadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fv_kerjasamaadd", "x_tgl_terbit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $v_kerjasama_add->tgl_terbit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_add->tawal->Visible) { // tawal ?>
	<div id="r_tawal" class="form-group row">
		<label id="elh_v_kerjasama_tawal" for="x_tawal" class="<?php echo $v_kerjasama_add->LeftColumnClass ?>"><?php echo $v_kerjasama_add->tawal->caption() ?><?php echo $v_kerjasama_add->tawal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_add->RightColumnClass ?>"><div <?php echo $v_kerjasama_add->tawal->cellAttributes() ?>>
<span id="el_v_kerjasama_tawal">
<input type="text" data-table="v_kerjasama" data-field="x_tawal" name="x_tawal" id="x_tawal" size="10" placeholder="<?php echo HtmlEncode($v_kerjasama_add->tawal->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_add->tawal->EditValue ?>"<?php echo $v_kerjasama_add->tawal->editAttributes() ?>>
<?php if (!$v_kerjasama_add->tawal->ReadOnly && !$v_kerjasama_add->tawal->Disabled && !isset($v_kerjasama_add->tawal->EditAttrs["readonly"]) && !isset($v_kerjasama_add->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fv_kerjasamaadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fv_kerjasamaadd", "x_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $v_kerjasama_add->tawal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_add->takhir->Visible) { // takhir ?>
	<div id="r_takhir" class="form-group row">
		<label id="elh_v_kerjasama_takhir" for="x_takhir" class="<?php echo $v_kerjasama_add->LeftColumnClass ?>"><?php echo $v_kerjasama_add->takhir->caption() ?><?php echo $v_kerjasama_add->takhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_add->RightColumnClass ?>"><div <?php echo $v_kerjasama_add->takhir->cellAttributes() ?>>
<span id="el_v_kerjasama_takhir">
<input type="text" data-table="v_kerjasama" data-field="x_takhir" name="x_takhir" id="x_takhir" size="10" placeholder="<?php echo HtmlEncode($v_kerjasama_add->takhir->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_add->takhir->EditValue ?>"<?php echo $v_kerjasama_add->takhir->editAttributes() ?>>
<?php if (!$v_kerjasama_add->takhir->ReadOnly && !$v_kerjasama_add->takhir->Disabled && !isset($v_kerjasama_add->takhir->EditAttrs["readonly"]) && !isset($v_kerjasama_add->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fv_kerjasamaadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fv_kerjasamaadd", "x_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $v_kerjasama_add->takhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_add->jenispel->Visible) { // jenispel ?>
	<div id="r_jenispel" class="form-group row">
		<label id="elh_v_kerjasama_jenispel" for="x_jenispel" class="<?php echo $v_kerjasama_add->LeftColumnClass ?>"><?php echo $v_kerjasama_add->jenispel->caption() ?><?php echo $v_kerjasama_add->jenispel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_add->RightColumnClass ?>"><div <?php echo $v_kerjasama_add->jenispel->cellAttributes() ?>>
<span id="el_v_kerjasama_jenispel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="v_kerjasama" data-field="x_jenispel" data-value-separator="<?php echo $v_kerjasama_add->jenispel->displayValueSeparatorAttribute() ?>" id="x_jenispel" name="x_jenispel"<?php echo $v_kerjasama_add->jenispel->editAttributes() ?>>
			<?php echo $v_kerjasama_add->jenispel->selectOptionListHtml("x_jenispel") ?>
		</select>
</div>
</span>
<?php echo $v_kerjasama_add->jenispel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_add->kdkategori->Visible) { // kdkategori ?>
	<div id="r_kdkategori" class="form-group row">
		<label id="elh_v_kerjasama_kdkategori" for="x_kdkategori" class="<?php echo $v_kerjasama_add->LeftColumnClass ?>"><?php echo $v_kerjasama_add->kdkategori->caption() ?><?php echo $v_kerjasama_add->kdkategori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_add->RightColumnClass ?>"><div <?php echo $v_kerjasama_add->kdkategori->cellAttributes() ?>>
<span id="el_v_kerjasama_kdkategori">
<?php $v_kerjasama_add->kdkategori->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="v_kerjasama" data-field="x_kdkategori" data-value-separator="<?php echo $v_kerjasama_add->kdkategori->displayValueSeparatorAttribute() ?>" id="x_kdkategori" name="x_kdkategori"<?php echo $v_kerjasama_add->kdkategori->editAttributes() ?>>
			<?php echo $v_kerjasama_add->kdkategori->selectOptionListHtml("x_kdkategori") ?>
		</select>
</div>
<?php echo $v_kerjasama_add->kdkategori->Lookup->getParamTag($v_kerjasama_add, "p_x_kdkategori") ?>
</span>
<?php echo $v_kerjasama_add->kdkategori->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_add->kerjasama->Visible) { // kerjasama ?>
	<div id="r_kerjasama" class="form-group row">
		<label id="elh_v_kerjasama_kerjasama" class="<?php echo $v_kerjasama_add->LeftColumnClass ?>"><?php echo $v_kerjasama_add->kerjasama->caption() ?><?php echo $v_kerjasama_add->kerjasama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_add->RightColumnClass ?>"><div <?php echo $v_kerjasama_add->kerjasama->cellAttributes() ?>>
<span id="el_v_kerjasama_kerjasama">
<?php
$onchange = $v_kerjasama_add->kerjasama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$v_kerjasama_add->kerjasama->EditAttrs["onchange"] = "";
?>
<span id="as_x_kerjasama">
	<input type="text" class="form-control" name="sv_x_kerjasama" id="sv_x_kerjasama" value="<?php echo RemoveHtml($v_kerjasama_add->kerjasama->EditValue) ?>" size="100" maxlength="11" placeholder="<?php echo HtmlEncode($v_kerjasama_add->kerjasama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($v_kerjasama_add->kerjasama->getPlaceHolder()) ?>"<?php echo $v_kerjasama_add->kerjasama->editAttributes() ?>>
</span>
<input type="hidden" data-table="v_kerjasama" data-field="x_kerjasama" data-value-separator="<?php echo $v_kerjasama_add->kerjasama->displayValueSeparatorAttribute() ?>" name="x_kerjasama" id="x_kerjasama" value="<?php echo HtmlEncode($v_kerjasama_add->kerjasama->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fv_kerjasamaadd"], function() {
	fv_kerjasamaadd.createAutoSuggest({"id":"x_kerjasama","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $v_kerjasama_add->kerjasama->Lookup->getParamTag($v_kerjasama_add, "p_x_kerjasama") ?>
</span>
<?php echo $v_kerjasama_add->kerjasama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_add->biaya->Visible) { // biaya ?>
	<div id="r_biaya" class="form-group row">
		<label id="elh_v_kerjasama_biaya" for="x_biaya" class="<?php echo $v_kerjasama_add->LeftColumnClass ?>"><?php echo $v_kerjasama_add->biaya->caption() ?><?php echo $v_kerjasama_add->biaya->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_add->RightColumnClass ?>"><div <?php echo $v_kerjasama_add->biaya->cellAttributes() ?>>
<span id="el_v_kerjasama_biaya">
<input type="text" data-table="v_kerjasama" data-field="x_biaya" name="x_biaya" id="x_biaya" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($v_kerjasama_add->biaya->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_add->biaya->EditValue ?>"<?php echo $v_kerjasama_add->biaya->editAttributes() ?>>
</span>
<?php echo $v_kerjasama_add->biaya->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_add->tempat->Visible) { // tempat ?>
	<div id="r_tempat" class="form-group row">
		<label id="elh_v_kerjasama_tempat" for="x_tempat" class="<?php echo $v_kerjasama_add->LeftColumnClass ?>"><?php echo $v_kerjasama_add->tempat->caption() ?><?php echo $v_kerjasama_add->tempat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_add->RightColumnClass ?>"><div <?php echo $v_kerjasama_add->tempat->cellAttributes() ?>>
<span id="el_v_kerjasama_tempat">
<input type="text" data-table="v_kerjasama" data-field="x_tempat" name="x_tempat" id="x_tempat" placeholder="<?php echo HtmlEncode($v_kerjasama_add->tempat->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_add->tempat->EditValue ?>"<?php echo $v_kerjasama_add->tempat->editAttributes() ?>>
</span>
<?php echo $v_kerjasama_add->tempat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_add->target_peserta->Visible) { // target_peserta ?>
	<div id="r_target_peserta" class="form-group row">
		<label id="elh_v_kerjasama_target_peserta" for="x_target_peserta" class="<?php echo $v_kerjasama_add->LeftColumnClass ?>"><?php echo $v_kerjasama_add->target_peserta->caption() ?><?php echo $v_kerjasama_add->target_peserta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_add->RightColumnClass ?>"><div <?php echo $v_kerjasama_add->target_peserta->cellAttributes() ?>>
<span id="el_v_kerjasama_target_peserta">
<input type="text" data-table="v_kerjasama" data-field="x_target_peserta" name="x_target_peserta" id="x_target_peserta" placeholder="<?php echo HtmlEncode($v_kerjasama_add->target_peserta->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_add->target_peserta->EditValue ?>"<?php echo $v_kerjasama_add->target_peserta->editAttributes() ?>>
</span>
<?php echo $v_kerjasama_add->target_peserta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_add->durasi1->Visible) { // durasi1 ?>
	<div id="r_durasi1" class="form-group row">
		<label id="elh_v_kerjasama_durasi1" for="x_durasi1" class="<?php echo $v_kerjasama_add->LeftColumnClass ?>"><?php echo $v_kerjasama_add->durasi1->caption() ?><?php echo $v_kerjasama_add->durasi1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_add->RightColumnClass ?>"><div <?php echo $v_kerjasama_add->durasi1->cellAttributes() ?>>
<span id="el_v_kerjasama_durasi1">
<input type="text" data-table="v_kerjasama" data-field="x_durasi1" name="x_durasi1" id="x_durasi1" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($v_kerjasama_add->durasi1->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_add->durasi1->EditValue ?>"<?php echo $v_kerjasama_add->durasi1->editAttributes() ?>>
<?php if (!$v_kerjasama_add->durasi1->ReadOnly && !$v_kerjasama_add->durasi1->Disabled && !isset($v_kerjasama_add->durasi1->EditAttrs["readonly"]) && !isset($v_kerjasama_add->durasi1->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fv_kerjasamaadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fv_kerjasamaadd", "x_durasi1", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $v_kerjasama_add->durasi1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_add->durasi2->Visible) { // durasi2 ?>
	<div id="r_durasi2" class="form-group row">
		<label id="elh_v_kerjasama_durasi2" for="x_durasi2" class="<?php echo $v_kerjasama_add->LeftColumnClass ?>"><?php echo $v_kerjasama_add->durasi2->caption() ?><?php echo $v_kerjasama_add->durasi2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_add->RightColumnClass ?>"><div <?php echo $v_kerjasama_add->durasi2->cellAttributes() ?>>
<span id="el_v_kerjasama_durasi2">
<input type="text" data-table="v_kerjasama" data-field="x_durasi2" name="x_durasi2" id="x_durasi2" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($v_kerjasama_add->durasi2->getPlaceHolder()) ?>" value="<?php echo $v_kerjasama_add->durasi2->EditValue ?>"<?php echo $v_kerjasama_add->durasi2->editAttributes() ?>>
</span>
<?php echo $v_kerjasama_add->durasi2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_add->nmou->Visible) { // nmou ?>
	<div id="r_nmou" class="form-group row">
		<label id="elh_v_kerjasama_nmou" class="<?php echo $v_kerjasama_add->LeftColumnClass ?>"><?php echo $v_kerjasama_add->nmou->caption() ?><?php echo $v_kerjasama_add->nmou->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_add->RightColumnClass ?>"><div <?php echo $v_kerjasama_add->nmou->cellAttributes() ?>>
<span id="el_v_kerjasama_nmou">
<div id="fd_x_nmou">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $v_kerjasama_add->nmou->title() ?>" data-table="v_kerjasama" data-field="x_nmou" name="x_nmou" id="x_nmou" lang="<?php echo CurrentLanguageID() ?>"<?php echo $v_kerjasama_add->nmou->editAttributes() ?><?php if ($v_kerjasama_add->nmou->ReadOnly || $v_kerjasama_add->nmou->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_nmou"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_nmou" id= "fn_x_nmou" value="<?php echo $v_kerjasama_add->nmou->Upload->FileName ?>">
<input type="hidden" name="fa_x_nmou" id= "fa_x_nmou" value="0">
<input type="hidden" name="fs_x_nmou" id= "fs_x_nmou" value="255">
<input type="hidden" name="fx_x_nmou" id= "fx_x_nmou" value="<?php echo $v_kerjasama_add->nmou->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_nmou" id= "fm_x_nmou" value="<?php echo $v_kerjasama_add->nmou->UploadMaxFileSize ?>">
</div>
<table id="ft_x_nmou" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $v_kerjasama_add->nmou->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_add->nmou2->Visible) { // nmou2 ?>
	<div id="r_nmou2" class="form-group row">
		<label id="elh_v_kerjasama_nmou2" class="<?php echo $v_kerjasama_add->LeftColumnClass ?>"><?php echo $v_kerjasama_add->nmou2->caption() ?><?php echo $v_kerjasama_add->nmou2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_add->RightColumnClass ?>"><div <?php echo $v_kerjasama_add->nmou2->cellAttributes() ?>>
<span id="el_v_kerjasama_nmou2">
<div id="fd_x_nmou2">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $v_kerjasama_add->nmou2->title() ?>" data-table="v_kerjasama" data-field="x_nmou2" name="x_nmou2" id="x_nmou2" lang="<?php echo CurrentLanguageID() ?>"<?php echo $v_kerjasama_add->nmou2->editAttributes() ?><?php if ($v_kerjasama_add->nmou2->ReadOnly || $v_kerjasama_add->nmou2->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_nmou2"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_nmou2" id= "fn_x_nmou2" value="<?php echo $v_kerjasama_add->nmou2->Upload->FileName ?>">
<input type="hidden" name="fa_x_nmou2" id= "fa_x_nmou2" value="0">
<input type="hidden" name="fs_x_nmou2" id= "fs_x_nmou2" value="255">
<input type="hidden" name="fx_x_nmou2" id= "fx_x_nmou2" value="<?php echo $v_kerjasama_add->nmou2->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_nmou2" id= "fm_x_nmou2" value="<?php echo $v_kerjasama_add->nmou2->UploadMaxFileSize ?>">
</div>
<table id="ft_x_nmou2" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $v_kerjasama_add->nmou2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($v_kerjasama_add->statuspel->Visible) { // statuspel ?>
	<div id="r_statuspel" class="form-group row">
		<label id="elh_v_kerjasama_statuspel" for="x_statuspel" class="<?php echo $v_kerjasama_add->LeftColumnClass ?>"><?php echo $v_kerjasama_add->statuspel->caption() ?><?php echo $v_kerjasama_add->statuspel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $v_kerjasama_add->RightColumnClass ?>"><div <?php echo $v_kerjasama_add->statuspel->cellAttributes() ?>>
<span id="el_v_kerjasama_statuspel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="v_kerjasama" data-field="x_statuspel" data-value-separator="<?php echo $v_kerjasama_add->statuspel->displayValueSeparatorAttribute() ?>" id="x_statuspel" name="x_statuspel"<?php echo $v_kerjasama_add->statuspel->editAttributes() ?>>
			<?php echo $v_kerjasama_add->statuspel->selectOptionListHtml("x_statuspel") ?>
		</select>
</div>
</span>
<?php echo $v_kerjasama_add->statuspel->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$v_kerjasama_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $v_kerjasama_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $v_kerjasama_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$v_kerjasama_add->showPageFooter();
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
$v_kerjasama_add->terminate();
?>