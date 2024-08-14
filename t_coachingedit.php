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
$t_coaching_edit = new t_coaching_edit();

// Run the page
$t_coaching_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_coaching_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_coachingedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_coachingedit = currentForm = new ew.Form("ft_coachingedit", "edit");

	// Validate form
	ft_coachingedit.validate = function() {
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
			<?php if ($t_coaching_edit->kdcoaching->Required) { ?>
				elm = this.getElements("x" + infix + "_kdcoaching");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_edit->kdcoaching->caption(), $t_coaching_edit->kdcoaching->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coaching_edit->kdtahapan->Required) { ?>
				elm = this.getElements("x" + infix + "_kdtahapan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_edit->kdtahapan->caption(), $t_coaching_edit->kdtahapan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coaching_edit->kdkursil->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkursil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_edit->kdkursil->caption(), $t_coaching_edit->kdkursil->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coaching_edit->tawal->Required) { ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_edit->tawal->caption(), $t_coaching_edit->tawal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coaching_edit->tawal->errorMessage()) ?>");
			<?php if ($t_coaching_edit->takhir->Required) { ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_edit->takhir->caption(), $t_coaching_edit->takhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coaching_edit->takhir->errorMessage()) ?>");
			<?php if ($t_coaching_edit->jmlhari->Required) { ?>
				elm = this.getElements("x" + infix + "_jmlhari");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_edit->jmlhari->caption(), $t_coaching_edit->jmlhari->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jmlhari");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coaching_edit->jmlhari->errorMessage()) ?>");
			<?php if ($t_coaching_edit->kdprop->Required) { ?>
				elm = this.getElements("x" + infix + "_kdprop");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_edit->kdprop->caption(), $t_coaching_edit->kdprop->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coaching_edit->ketua->Required) { ?>
				elm = this.getElements("x" + infix + "_ketua");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_edit->ketua->caption(), $t_coaching_edit->ketua->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coaching_edit->sekretaris->Required) { ?>
				elm = this.getElements("x" + infix + "_sekretaris");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_edit->sekretaris->caption(), $t_coaching_edit->sekretaris->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coaching_edit->bendahara->Required) { ?>
				elm = this.getElements("x" + infix + "_bendahara");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_edit->bendahara->caption(), $t_coaching_edit->bendahara->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coaching_edit->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_edit->status->caption(), $t_coaching_edit->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coaching_edit->jenisevaluasi->Required) { ?>
				elm = this.getElements("x" + infix + "_jenisevaluasi[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_edit->jenisevaluasi->caption(), $t_coaching_edit->jenisevaluasi->RequiredErrorMessage)) ?>");
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
	ft_coachingedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_coachingedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_coachingedit.lists["x_kdtahapan"] = <?php echo $t_coaching_edit->kdtahapan->Lookup->toClientList($t_coaching_edit) ?>;
	ft_coachingedit.lists["x_kdtahapan"].options = <?php echo JsonEncode($t_coaching_edit->kdtahapan->lookupOptions()) ?>;
	ft_coachingedit.lists["x_kdkursil"] = <?php echo $t_coaching_edit->kdkursil->Lookup->toClientList($t_coaching_edit) ?>;
	ft_coachingedit.lists["x_kdkursil"].options = <?php echo JsonEncode($t_coaching_edit->kdkursil->lookupOptions()) ?>;
	ft_coachingedit.lists["x_kdprop"] = <?php echo $t_coaching_edit->kdprop->Lookup->toClientList($t_coaching_edit) ?>;
	ft_coachingedit.lists["x_kdprop"].options = <?php echo JsonEncode($t_coaching_edit->kdprop->lookupOptions()) ?>;
	ft_coachingedit.lists["x_ketua"] = <?php echo $t_coaching_edit->ketua->Lookup->toClientList($t_coaching_edit) ?>;
	ft_coachingedit.lists["x_ketua"].options = <?php echo JsonEncode($t_coaching_edit->ketua->lookupOptions()) ?>;
	ft_coachingedit.autoSuggests["x_ketua"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_coachingedit.lists["x_sekretaris"] = <?php echo $t_coaching_edit->sekretaris->Lookup->toClientList($t_coaching_edit) ?>;
	ft_coachingedit.lists["x_sekretaris"].options = <?php echo JsonEncode($t_coaching_edit->sekretaris->lookupOptions()) ?>;
	ft_coachingedit.autoSuggests["x_sekretaris"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_coachingedit.lists["x_bendahara"] = <?php echo $t_coaching_edit->bendahara->Lookup->toClientList($t_coaching_edit) ?>;
	ft_coachingedit.lists["x_bendahara"].options = <?php echo JsonEncode($t_coaching_edit->bendahara->lookupOptions()) ?>;
	ft_coachingedit.autoSuggests["x_bendahara"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_coachingedit.lists["x_status"] = <?php echo $t_coaching_edit->status->Lookup->toClientList($t_coaching_edit) ?>;
	ft_coachingedit.lists["x_status"].options = <?php echo JsonEncode($t_coaching_edit->status->options(FALSE, TRUE)) ?>;
	ft_coachingedit.lists["x_jenisevaluasi[]"] = <?php echo $t_coaching_edit->jenisevaluasi->Lookup->toClientList($t_coaching_edit) ?>;
	ft_coachingedit.lists["x_jenisevaluasi[]"].options = <?php echo JsonEncode($t_coaching_edit->jenisevaluasi->lookupOptions()) ?>;
	loadjs.done("ft_coachingedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_coaching_edit->showPageHeader(); ?>
<?php
$t_coaching_edit->showMessage();
?>
<form name="ft_coachingedit" id="ft_coachingedit" class="<?php echo $t_coaching_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_coaching">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_coaching_edit->IsModal ?>">
<?php if ($t_coaching->getCurrentMasterTable() == "t_rkcoaching") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_rkcoaching">
<input type="hidden" name="fk_rkid" value="<?php echo HtmlEncode($t_coaching_edit->rkid->getSessionValue()) ?>">
<input type="hidden" name="fk_area" value="<?php echo HtmlEncode($t_coaching_edit->kdprop->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_coaching_edit->kdcoaching->Visible) { // kdcoaching ?>
	<div id="r_kdcoaching" class="form-group row">
		<label id="elh_t_coaching_kdcoaching" class="<?php echo $t_coaching_edit->LeftColumnClass ?>"><?php echo $t_coaching_edit->kdcoaching->caption() ?><?php echo $t_coaching_edit->kdcoaching->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_edit->RightColumnClass ?>"><div <?php echo $t_coaching_edit->kdcoaching->cellAttributes() ?>>
<span id="el_t_coaching_kdcoaching">
<span<?php echo $t_coaching_edit->kdcoaching->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coaching_edit->kdcoaching->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_kdcoaching" name="x_kdcoaching" id="x_kdcoaching" value="<?php echo HtmlEncode($t_coaching_edit->kdcoaching->CurrentValue) ?>">
<?php echo $t_coaching_edit->kdcoaching->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coaching_edit->kdtahapan->Visible) { // kdtahapan ?>
	<div id="r_kdtahapan" class="form-group row">
		<label id="elh_t_coaching_kdtahapan" for="x_kdtahapan" class="<?php echo $t_coaching_edit->LeftColumnClass ?>"><?php echo $t_coaching_edit->kdtahapan->caption() ?><?php echo $t_coaching_edit->kdtahapan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_edit->RightColumnClass ?>"><div <?php echo $t_coaching_edit->kdtahapan->cellAttributes() ?>>
<span id="el_t_coaching_kdtahapan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coaching" data-field="x_kdtahapan" data-value-separator="<?php echo $t_coaching_edit->kdtahapan->displayValueSeparatorAttribute() ?>" id="x_kdtahapan" name="x_kdtahapan"<?php echo $t_coaching_edit->kdtahapan->editAttributes() ?>>
			<?php echo $t_coaching_edit->kdtahapan->selectOptionListHtml("x_kdtahapan") ?>
		</select>
</div>
<?php echo $t_coaching_edit->kdtahapan->Lookup->getParamTag($t_coaching_edit, "p_x_kdtahapan") ?>
</span>
<?php echo $t_coaching_edit->kdtahapan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coaching_edit->kdkursil->Visible) { // kdkursil ?>
	<div id="r_kdkursil" class="form-group row">
		<label id="elh_t_coaching_kdkursil" for="x_kdkursil" class="<?php echo $t_coaching_edit->LeftColumnClass ?>"><?php echo $t_coaching_edit->kdkursil->caption() ?><?php echo $t_coaching_edit->kdkursil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_edit->RightColumnClass ?>"><div <?php echo $t_coaching_edit->kdkursil->cellAttributes() ?>>
<span id="el_t_coaching_kdkursil">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coaching" data-field="x_kdkursil" data-value-separator="<?php echo $t_coaching_edit->kdkursil->displayValueSeparatorAttribute() ?>" id="x_kdkursil" name="x_kdkursil"<?php echo $t_coaching_edit->kdkursil->editAttributes() ?>>
			<?php echo $t_coaching_edit->kdkursil->selectOptionListHtml("x_kdkursil") ?>
		</select>
</div>
<?php echo $t_coaching_edit->kdkursil->Lookup->getParamTag($t_coaching_edit, "p_x_kdkursil") ?>
</span>
<?php echo $t_coaching_edit->kdkursil->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coaching_edit->tawal->Visible) { // tawal ?>
	<div id="r_tawal" class="form-group row">
		<label id="elh_t_coaching_tawal" for="x_tawal" class="<?php echo $t_coaching_edit->LeftColumnClass ?>"><?php echo $t_coaching_edit->tawal->caption() ?><?php echo $t_coaching_edit->tawal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_edit->RightColumnClass ?>"><div <?php echo $t_coaching_edit->tawal->cellAttributes() ?>>
<span id="el_t_coaching_tawal">
<input type="text" data-table="t_coaching" data-field="x_tawal" name="x_tawal" id="x_tawal" size="10" placeholder="<?php echo HtmlEncode($t_coaching_edit->tawal->getPlaceHolder()) ?>" value="<?php echo $t_coaching_edit->tawal->EditValue ?>"<?php echo $t_coaching_edit->tawal->editAttributes() ?>>
<?php if (!$t_coaching_edit->tawal->ReadOnly && !$t_coaching_edit->tawal->Disabled && !isset($t_coaching_edit->tawal->EditAttrs["readonly"]) && !isset($t_coaching_edit->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_coachingedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_coachingedit", "x_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_coaching_edit->tawal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coaching_edit->takhir->Visible) { // takhir ?>
	<div id="r_takhir" class="form-group row">
		<label id="elh_t_coaching_takhir" for="x_takhir" class="<?php echo $t_coaching_edit->LeftColumnClass ?>"><?php echo $t_coaching_edit->takhir->caption() ?><?php echo $t_coaching_edit->takhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_edit->RightColumnClass ?>"><div <?php echo $t_coaching_edit->takhir->cellAttributes() ?>>
<span id="el_t_coaching_takhir">
<input type="text" data-table="t_coaching" data-field="x_takhir" name="x_takhir" id="x_takhir" size="10" placeholder="<?php echo HtmlEncode($t_coaching_edit->takhir->getPlaceHolder()) ?>" value="<?php echo $t_coaching_edit->takhir->EditValue ?>"<?php echo $t_coaching_edit->takhir->editAttributes() ?>>
<?php if (!$t_coaching_edit->takhir->ReadOnly && !$t_coaching_edit->takhir->Disabled && !isset($t_coaching_edit->takhir->EditAttrs["readonly"]) && !isset($t_coaching_edit->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_coachingedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_coachingedit", "x_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_coaching_edit->takhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coaching_edit->jmlhari->Visible) { // jmlhari ?>
	<div id="r_jmlhari" class="form-group row">
		<label id="elh_t_coaching_jmlhari" for="x_jmlhari" class="<?php echo $t_coaching_edit->LeftColumnClass ?>"><?php echo $t_coaching_edit->jmlhari->caption() ?><?php echo $t_coaching_edit->jmlhari->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_edit->RightColumnClass ?>"><div <?php echo $t_coaching_edit->jmlhari->cellAttributes() ?>>
<span id="el_t_coaching_jmlhari">
<input type="text" data-table="t_coaching" data-field="x_jmlhari" name="x_jmlhari" id="x_jmlhari" size="5" maxlength="5" placeholder="<?php echo HtmlEncode($t_coaching_edit->jmlhari->getPlaceHolder()) ?>" value="<?php echo $t_coaching_edit->jmlhari->EditValue ?>"<?php echo $t_coaching_edit->jmlhari->editAttributes() ?>>
</span>
<?php echo $t_coaching_edit->jmlhari->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coaching_edit->kdprop->Visible) { // kdprop ?>
	<div id="r_kdprop" class="form-group row">
		<label id="elh_t_coaching_kdprop" for="x_kdprop" class="<?php echo $t_coaching_edit->LeftColumnClass ?>"><?php echo $t_coaching_edit->kdprop->caption() ?><?php echo $t_coaching_edit->kdprop->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_edit->RightColumnClass ?>"><div <?php echo $t_coaching_edit->kdprop->cellAttributes() ?>>
<?php if ($t_coaching_edit->kdprop->getSessionValue() != "") { ?>
<span id="el_t_coaching_kdprop">
<span<?php echo $t_coaching_edit->kdprop->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coaching_edit->kdprop->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_kdprop" name="x_kdprop" value="<?php echo HtmlEncode($t_coaching_edit->kdprop->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_coaching_kdprop">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coaching" data-field="x_kdprop" data-value-separator="<?php echo $t_coaching_edit->kdprop->displayValueSeparatorAttribute() ?>" id="x_kdprop" name="x_kdprop"<?php echo $t_coaching_edit->kdprop->editAttributes() ?>>
			<?php echo $t_coaching_edit->kdprop->selectOptionListHtml("x_kdprop") ?>
		</select>
</div>
<?php echo $t_coaching_edit->kdprop->Lookup->getParamTag($t_coaching_edit, "p_x_kdprop") ?>
</span>
<?php } ?>
<?php echo $t_coaching_edit->kdprop->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coaching_edit->ketua->Visible) { // ketua ?>
	<div id="r_ketua" class="form-group row">
		<label id="elh_t_coaching_ketua" class="<?php echo $t_coaching_edit->LeftColumnClass ?>"><?php echo $t_coaching_edit->ketua->caption() ?><?php echo $t_coaching_edit->ketua->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_edit->RightColumnClass ?>"><div <?php echo $t_coaching_edit->ketua->cellAttributes() ?>>
<span id="el_t_coaching_ketua">
<?php
$onchange = $t_coaching_edit->ketua->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_coaching_edit->ketua->EditAttrs["onchange"] = "";
?>
<span id="as_x_ketua">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ketua" id="sv_x_ketua" value="<?php echo RemoveHtml($t_coaching_edit->ketua->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($t_coaching_edit->ketua->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_coaching_edit->ketua->getPlaceHolder()) ?>"<?php echo $t_coaching_edit->ketua->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_coaching_edit->ketua->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ketua',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($t_coaching_edit->ketua->ReadOnly || $t_coaching_edit->ketua->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_ketua" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_coaching_edit->ketua->displayValueSeparatorAttribute() ?>" name="x_ketua" id="x_ketua" value="<?php echo HtmlEncode($t_coaching_edit->ketua->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_coachingedit"], function() {
	ft_coachingedit.createAutoSuggest({"id":"x_ketua","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $t_coaching_edit->ketua->Lookup->getParamTag($t_coaching_edit, "p_x_ketua") ?>
</span>
<?php echo $t_coaching_edit->ketua->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coaching_edit->sekretaris->Visible) { // sekretaris ?>
	<div id="r_sekretaris" class="form-group row">
		<label id="elh_t_coaching_sekretaris" class="<?php echo $t_coaching_edit->LeftColumnClass ?>"><?php echo $t_coaching_edit->sekretaris->caption() ?><?php echo $t_coaching_edit->sekretaris->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_edit->RightColumnClass ?>"><div <?php echo $t_coaching_edit->sekretaris->cellAttributes() ?>>
<span id="el_t_coaching_sekretaris">
<?php
$onchange = $t_coaching_edit->sekretaris->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_coaching_edit->sekretaris->EditAttrs["onchange"] = "";
?>
<span id="as_x_sekretaris">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_sekretaris" id="sv_x_sekretaris" value="<?php echo RemoveHtml($t_coaching_edit->sekretaris->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($t_coaching_edit->sekretaris->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_coaching_edit->sekretaris->getPlaceHolder()) ?>"<?php echo $t_coaching_edit->sekretaris->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_coaching_edit->sekretaris->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_sekretaris',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($t_coaching_edit->sekretaris->ReadOnly || $t_coaching_edit->sekretaris->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_sekretaris" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_coaching_edit->sekretaris->displayValueSeparatorAttribute() ?>" name="x_sekretaris" id="x_sekretaris" value="<?php echo HtmlEncode($t_coaching_edit->sekretaris->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_coachingedit"], function() {
	ft_coachingedit.createAutoSuggest({"id":"x_sekretaris","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $t_coaching_edit->sekretaris->Lookup->getParamTag($t_coaching_edit, "p_x_sekretaris") ?>
</span>
<?php echo $t_coaching_edit->sekretaris->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coaching_edit->bendahara->Visible) { // bendahara ?>
	<div id="r_bendahara" class="form-group row">
		<label id="elh_t_coaching_bendahara" class="<?php echo $t_coaching_edit->LeftColumnClass ?>"><?php echo $t_coaching_edit->bendahara->caption() ?><?php echo $t_coaching_edit->bendahara->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_edit->RightColumnClass ?>"><div <?php echo $t_coaching_edit->bendahara->cellAttributes() ?>>
<span id="el_t_coaching_bendahara">
<?php
$onchange = $t_coaching_edit->bendahara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_coaching_edit->bendahara->EditAttrs["onchange"] = "";
?>
<span id="as_x_bendahara">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_bendahara" id="sv_x_bendahara" value="<?php echo RemoveHtml($t_coaching_edit->bendahara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($t_coaching_edit->bendahara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_coaching_edit->bendahara->getPlaceHolder()) ?>"<?php echo $t_coaching_edit->bendahara->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_coaching_edit->bendahara->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_bendahara',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($t_coaching_edit->bendahara->ReadOnly || $t_coaching_edit->bendahara->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_bendahara" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_coaching_edit->bendahara->displayValueSeparatorAttribute() ?>" name="x_bendahara" id="x_bendahara" value="<?php echo HtmlEncode($t_coaching_edit->bendahara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_coachingedit"], function() {
	ft_coachingedit.createAutoSuggest({"id":"x_bendahara","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $t_coaching_edit->bendahara->Lookup->getParamTag($t_coaching_edit, "p_x_bendahara") ?>
</span>
<?php echo $t_coaching_edit->bendahara->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coaching_edit->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_t_coaching_status" for="x_status" class="<?php echo $t_coaching_edit->LeftColumnClass ?>"><?php echo $t_coaching_edit->status->caption() ?><?php echo $t_coaching_edit->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_edit->RightColumnClass ?>"><div <?php echo $t_coaching_edit->status->cellAttributes() ?>>
<span id="el_t_coaching_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coaching" data-field="x_status" data-value-separator="<?php echo $t_coaching_edit->status->displayValueSeparatorAttribute() ?>" id="x_status" name="x_status"<?php echo $t_coaching_edit->status->editAttributes() ?>>
			<?php echo $t_coaching_edit->status->selectOptionListHtml("x_status") ?>
		</select>
</div>
</span>
<?php echo $t_coaching_edit->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coaching_edit->jenisevaluasi->Visible) { // jenisevaluasi ?>
	<div id="r_jenisevaluasi" class="form-group row">
		<label id="elh_t_coaching_jenisevaluasi" class="<?php echo $t_coaching_edit->LeftColumnClass ?>"><?php echo $t_coaching_edit->jenisevaluasi->caption() ?><?php echo $t_coaching_edit->jenisevaluasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_edit->RightColumnClass ?>"><div <?php echo $t_coaching_edit->jenisevaluasi->cellAttributes() ?>>
<span id="el_t_coaching_jenisevaluasi">
<div id="tp_x_jenisevaluasi" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="t_coaching" data-field="x_jenisevaluasi" data-value-separator="<?php echo $t_coaching_edit->jenisevaluasi->displayValueSeparatorAttribute() ?>" name="x_jenisevaluasi[]" id="x_jenisevaluasi[]" value="{value}"<?php echo $t_coaching_edit->jenisevaluasi->editAttributes() ?>></div>
<div id="dsl_x_jenisevaluasi" data-repeatcolumn="1" class="ew-item-list d-none"><div>
<?php echo $t_coaching_edit->jenisevaluasi->checkBoxListHtml(FALSE, "x_jenisevaluasi[]") ?>
</div></div>
<?php echo $t_coaching_edit->jenisevaluasi->Lookup->getParamTag($t_coaching_edit, "p_x_jenisevaluasi") ?>
</span>
<?php echo $t_coaching_edit->jenisevaluasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_coaching_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_coaching_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_coaching_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_coaching_edit->showPageFooter();
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
$t_coaching_edit->terminate();
?>