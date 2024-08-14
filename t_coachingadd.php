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
$t_coaching_add = new t_coaching_add();

// Run the page
$t_coaching_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_coaching_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_coachingadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_coachingadd = currentForm = new ew.Form("ft_coachingadd", "add");

	// Validate form
	ft_coachingadd.validate = function() {
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
			<?php if ($t_coaching_add->rkid->Required) { ?>
				elm = this.getElements("x" + infix + "_rkid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_add->rkid->caption(), $t_coaching_add->rkid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_rkid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coaching_add->rkid->errorMessage()) ?>");
			<?php if ($t_coaching_add->kdtahapan->Required) { ?>
				elm = this.getElements("x" + infix + "_kdtahapan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_add->kdtahapan->caption(), $t_coaching_add->kdtahapan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coaching_add->kdkursil->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkursil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_add->kdkursil->caption(), $t_coaching_add->kdkursil->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coaching_add->tawal->Required) { ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_add->tawal->caption(), $t_coaching_add->tawal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coaching_add->tawal->errorMessage()) ?>");
			<?php if ($t_coaching_add->takhir->Required) { ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_add->takhir->caption(), $t_coaching_add->takhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coaching_add->takhir->errorMessage()) ?>");
			<?php if ($t_coaching_add->jmlhari->Required) { ?>
				elm = this.getElements("x" + infix + "_jmlhari");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_add->jmlhari->caption(), $t_coaching_add->jmlhari->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jmlhari");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coaching_add->jmlhari->errorMessage()) ?>");
			<?php if ($t_coaching_add->kdprop->Required) { ?>
				elm = this.getElements("x" + infix + "_kdprop");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_add->kdprop->caption(), $t_coaching_add->kdprop->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coaching_add->ketua->Required) { ?>
				elm = this.getElements("x" + infix + "_ketua");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_add->ketua->caption(), $t_coaching_add->ketua->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coaching_add->sekretaris->Required) { ?>
				elm = this.getElements("x" + infix + "_sekretaris");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_add->sekretaris->caption(), $t_coaching_add->sekretaris->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coaching_add->bendahara->Required) { ?>
				elm = this.getElements("x" + infix + "_bendahara");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_add->bendahara->caption(), $t_coaching_add->bendahara->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coaching_add->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_add->status->caption(), $t_coaching_add->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coaching_add->jenisevaluasi->Required) { ?>
				elm = this.getElements("x" + infix + "_jenisevaluasi[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coaching_add->jenisevaluasi->caption(), $t_coaching_add->jenisevaluasi->RequiredErrorMessage)) ?>");
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
	ft_coachingadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_coachingadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_coachingadd.lists["x_kdtahapan"] = <?php echo $t_coaching_add->kdtahapan->Lookup->toClientList($t_coaching_add) ?>;
	ft_coachingadd.lists["x_kdtahapan"].options = <?php echo JsonEncode($t_coaching_add->kdtahapan->lookupOptions()) ?>;
	ft_coachingadd.lists["x_kdkursil"] = <?php echo $t_coaching_add->kdkursil->Lookup->toClientList($t_coaching_add) ?>;
	ft_coachingadd.lists["x_kdkursil"].options = <?php echo JsonEncode($t_coaching_add->kdkursil->lookupOptions()) ?>;
	ft_coachingadd.lists["x_kdprop"] = <?php echo $t_coaching_add->kdprop->Lookup->toClientList($t_coaching_add) ?>;
	ft_coachingadd.lists["x_kdprop"].options = <?php echo JsonEncode($t_coaching_add->kdprop->lookupOptions()) ?>;
	ft_coachingadd.lists["x_ketua"] = <?php echo $t_coaching_add->ketua->Lookup->toClientList($t_coaching_add) ?>;
	ft_coachingadd.lists["x_ketua"].options = <?php echo JsonEncode($t_coaching_add->ketua->lookupOptions()) ?>;
	ft_coachingadd.autoSuggests["x_ketua"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_coachingadd.lists["x_sekretaris"] = <?php echo $t_coaching_add->sekretaris->Lookup->toClientList($t_coaching_add) ?>;
	ft_coachingadd.lists["x_sekretaris"].options = <?php echo JsonEncode($t_coaching_add->sekretaris->lookupOptions()) ?>;
	ft_coachingadd.autoSuggests["x_sekretaris"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_coachingadd.lists["x_bendahara"] = <?php echo $t_coaching_add->bendahara->Lookup->toClientList($t_coaching_add) ?>;
	ft_coachingadd.lists["x_bendahara"].options = <?php echo JsonEncode($t_coaching_add->bendahara->lookupOptions()) ?>;
	ft_coachingadd.autoSuggests["x_bendahara"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_coachingadd.lists["x_status"] = <?php echo $t_coaching_add->status->Lookup->toClientList($t_coaching_add) ?>;
	ft_coachingadd.lists["x_status"].options = <?php echo JsonEncode($t_coaching_add->status->options(FALSE, TRUE)) ?>;
	ft_coachingadd.lists["x_jenisevaluasi[]"] = <?php echo $t_coaching_add->jenisevaluasi->Lookup->toClientList($t_coaching_add) ?>;
	ft_coachingadd.lists["x_jenisevaluasi[]"].options = <?php echo JsonEncode($t_coaching_add->jenisevaluasi->lookupOptions()) ?>;
	loadjs.done("ft_coachingadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_coaching_add->showPageHeader(); ?>
<?php
$t_coaching_add->showMessage();
?>
<form name="ft_coachingadd" id="ft_coachingadd" class="<?php echo $t_coaching_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_coaching">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_coaching_add->IsModal ?>">
<?php if ($t_coaching->getCurrentMasterTable() == "t_rkcoaching") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_rkcoaching">
<input type="hidden" name="fk_rkid" value="<?php echo HtmlEncode($t_coaching_add->rkid->getSessionValue()) ?>">
<input type="hidden" name="fk_area" value="<?php echo HtmlEncode($t_coaching_add->kdprop->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($t_coaching_add->rkid->Visible) { // rkid ?>
	<div id="r_rkid" class="form-group row">
		<label id="elh_t_coaching_rkid" for="x_rkid" class="<?php echo $t_coaching_add->LeftColumnClass ?>"><?php echo $t_coaching_add->rkid->caption() ?><?php echo $t_coaching_add->rkid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_add->RightColumnClass ?>"><div <?php echo $t_coaching_add->rkid->cellAttributes() ?>>
<?php if ($t_coaching_add->rkid->getSessionValue() != "") { ?>
<span id="el_t_coaching_rkid">
<span<?php echo $t_coaching_add->rkid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coaching_add->rkid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_rkid" name="x_rkid" value="<?php echo HtmlEncode($t_coaching_add->rkid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_coaching_rkid">
<input type="text" data-table="t_coaching" data-field="x_rkid" name="x_rkid" id="x_rkid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($t_coaching_add->rkid->getPlaceHolder()) ?>" value="<?php echo $t_coaching_add->rkid->EditValue ?>"<?php echo $t_coaching_add->rkid->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $t_coaching_add->rkid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coaching_add->kdtahapan->Visible) { // kdtahapan ?>
	<div id="r_kdtahapan" class="form-group row">
		<label id="elh_t_coaching_kdtahapan" for="x_kdtahapan" class="<?php echo $t_coaching_add->LeftColumnClass ?>"><?php echo $t_coaching_add->kdtahapan->caption() ?><?php echo $t_coaching_add->kdtahapan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_add->RightColumnClass ?>"><div <?php echo $t_coaching_add->kdtahapan->cellAttributes() ?>>
<span id="el_t_coaching_kdtahapan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coaching" data-field="x_kdtahapan" data-value-separator="<?php echo $t_coaching_add->kdtahapan->displayValueSeparatorAttribute() ?>" id="x_kdtahapan" name="x_kdtahapan"<?php echo $t_coaching_add->kdtahapan->editAttributes() ?>>
			<?php echo $t_coaching_add->kdtahapan->selectOptionListHtml("x_kdtahapan") ?>
		</select>
</div>
<?php echo $t_coaching_add->kdtahapan->Lookup->getParamTag($t_coaching_add, "p_x_kdtahapan") ?>
</span>
<?php echo $t_coaching_add->kdtahapan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coaching_add->kdkursil->Visible) { // kdkursil ?>
	<div id="r_kdkursil" class="form-group row">
		<label id="elh_t_coaching_kdkursil" for="x_kdkursil" class="<?php echo $t_coaching_add->LeftColumnClass ?>"><?php echo $t_coaching_add->kdkursil->caption() ?><?php echo $t_coaching_add->kdkursil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_add->RightColumnClass ?>"><div <?php echo $t_coaching_add->kdkursil->cellAttributes() ?>>
<span id="el_t_coaching_kdkursil">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coaching" data-field="x_kdkursil" data-value-separator="<?php echo $t_coaching_add->kdkursil->displayValueSeparatorAttribute() ?>" id="x_kdkursil" name="x_kdkursil"<?php echo $t_coaching_add->kdkursil->editAttributes() ?>>
			<?php echo $t_coaching_add->kdkursil->selectOptionListHtml("x_kdkursil") ?>
		</select>
</div>
<?php echo $t_coaching_add->kdkursil->Lookup->getParamTag($t_coaching_add, "p_x_kdkursil") ?>
</span>
<?php echo $t_coaching_add->kdkursil->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coaching_add->tawal->Visible) { // tawal ?>
	<div id="r_tawal" class="form-group row">
		<label id="elh_t_coaching_tawal" for="x_tawal" class="<?php echo $t_coaching_add->LeftColumnClass ?>"><?php echo $t_coaching_add->tawal->caption() ?><?php echo $t_coaching_add->tawal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_add->RightColumnClass ?>"><div <?php echo $t_coaching_add->tawal->cellAttributes() ?>>
<span id="el_t_coaching_tawal">
<input type="text" data-table="t_coaching" data-field="x_tawal" name="x_tawal" id="x_tawal" size="10" placeholder="<?php echo HtmlEncode($t_coaching_add->tawal->getPlaceHolder()) ?>" value="<?php echo $t_coaching_add->tawal->EditValue ?>"<?php echo $t_coaching_add->tawal->editAttributes() ?>>
<?php if (!$t_coaching_add->tawal->ReadOnly && !$t_coaching_add->tawal->Disabled && !isset($t_coaching_add->tawal->EditAttrs["readonly"]) && !isset($t_coaching_add->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_coachingadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_coachingadd", "x_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_coaching_add->tawal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coaching_add->takhir->Visible) { // takhir ?>
	<div id="r_takhir" class="form-group row">
		<label id="elh_t_coaching_takhir" for="x_takhir" class="<?php echo $t_coaching_add->LeftColumnClass ?>"><?php echo $t_coaching_add->takhir->caption() ?><?php echo $t_coaching_add->takhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_add->RightColumnClass ?>"><div <?php echo $t_coaching_add->takhir->cellAttributes() ?>>
<span id="el_t_coaching_takhir">
<input type="text" data-table="t_coaching" data-field="x_takhir" name="x_takhir" id="x_takhir" size="10" placeholder="<?php echo HtmlEncode($t_coaching_add->takhir->getPlaceHolder()) ?>" value="<?php echo $t_coaching_add->takhir->EditValue ?>"<?php echo $t_coaching_add->takhir->editAttributes() ?>>
<?php if (!$t_coaching_add->takhir->ReadOnly && !$t_coaching_add->takhir->Disabled && !isset($t_coaching_add->takhir->EditAttrs["readonly"]) && !isset($t_coaching_add->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_coachingadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_coachingadd", "x_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_coaching_add->takhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coaching_add->jmlhari->Visible) { // jmlhari ?>
	<div id="r_jmlhari" class="form-group row">
		<label id="elh_t_coaching_jmlhari" for="x_jmlhari" class="<?php echo $t_coaching_add->LeftColumnClass ?>"><?php echo $t_coaching_add->jmlhari->caption() ?><?php echo $t_coaching_add->jmlhari->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_add->RightColumnClass ?>"><div <?php echo $t_coaching_add->jmlhari->cellAttributes() ?>>
<span id="el_t_coaching_jmlhari">
<input type="text" data-table="t_coaching" data-field="x_jmlhari" name="x_jmlhari" id="x_jmlhari" size="5" maxlength="5" placeholder="<?php echo HtmlEncode($t_coaching_add->jmlhari->getPlaceHolder()) ?>" value="<?php echo $t_coaching_add->jmlhari->EditValue ?>"<?php echo $t_coaching_add->jmlhari->editAttributes() ?>>
</span>
<?php echo $t_coaching_add->jmlhari->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coaching_add->kdprop->Visible) { // kdprop ?>
	<div id="r_kdprop" class="form-group row">
		<label id="elh_t_coaching_kdprop" for="x_kdprop" class="<?php echo $t_coaching_add->LeftColumnClass ?>"><?php echo $t_coaching_add->kdprop->caption() ?><?php echo $t_coaching_add->kdprop->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_add->RightColumnClass ?>"><div <?php echo $t_coaching_add->kdprop->cellAttributes() ?>>
<?php if ($t_coaching_add->kdprop->getSessionValue() != "") { ?>
<span id="el_t_coaching_kdprop">
<span<?php echo $t_coaching_add->kdprop->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coaching_add->kdprop->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_kdprop" name="x_kdprop" value="<?php echo HtmlEncode($t_coaching_add->kdprop->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_coaching_kdprop">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coaching" data-field="x_kdprop" data-value-separator="<?php echo $t_coaching_add->kdprop->displayValueSeparatorAttribute() ?>" id="x_kdprop" name="x_kdprop"<?php echo $t_coaching_add->kdprop->editAttributes() ?>>
			<?php echo $t_coaching_add->kdprop->selectOptionListHtml("x_kdprop") ?>
		</select>
</div>
<?php echo $t_coaching_add->kdprop->Lookup->getParamTag($t_coaching_add, "p_x_kdprop") ?>
</span>
<?php } ?>
<?php echo $t_coaching_add->kdprop->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coaching_add->ketua->Visible) { // ketua ?>
	<div id="r_ketua" class="form-group row">
		<label id="elh_t_coaching_ketua" class="<?php echo $t_coaching_add->LeftColumnClass ?>"><?php echo $t_coaching_add->ketua->caption() ?><?php echo $t_coaching_add->ketua->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_add->RightColumnClass ?>"><div <?php echo $t_coaching_add->ketua->cellAttributes() ?>>
<span id="el_t_coaching_ketua">
<?php
$onchange = $t_coaching_add->ketua->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_coaching_add->ketua->EditAttrs["onchange"] = "";
?>
<span id="as_x_ketua">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ketua" id="sv_x_ketua" value="<?php echo RemoveHtml($t_coaching_add->ketua->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($t_coaching_add->ketua->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_coaching_add->ketua->getPlaceHolder()) ?>"<?php echo $t_coaching_add->ketua->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_coaching_add->ketua->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ketua',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($t_coaching_add->ketua->ReadOnly || $t_coaching_add->ketua->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_ketua" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_coaching_add->ketua->displayValueSeparatorAttribute() ?>" name="x_ketua" id="x_ketua" value="<?php echo HtmlEncode($t_coaching_add->ketua->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_coachingadd"], function() {
	ft_coachingadd.createAutoSuggest({"id":"x_ketua","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $t_coaching_add->ketua->Lookup->getParamTag($t_coaching_add, "p_x_ketua") ?>
</span>
<?php echo $t_coaching_add->ketua->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coaching_add->sekretaris->Visible) { // sekretaris ?>
	<div id="r_sekretaris" class="form-group row">
		<label id="elh_t_coaching_sekretaris" class="<?php echo $t_coaching_add->LeftColumnClass ?>"><?php echo $t_coaching_add->sekretaris->caption() ?><?php echo $t_coaching_add->sekretaris->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_add->RightColumnClass ?>"><div <?php echo $t_coaching_add->sekretaris->cellAttributes() ?>>
<span id="el_t_coaching_sekretaris">
<?php
$onchange = $t_coaching_add->sekretaris->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_coaching_add->sekretaris->EditAttrs["onchange"] = "";
?>
<span id="as_x_sekretaris">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_sekretaris" id="sv_x_sekretaris" value="<?php echo RemoveHtml($t_coaching_add->sekretaris->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($t_coaching_add->sekretaris->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_coaching_add->sekretaris->getPlaceHolder()) ?>"<?php echo $t_coaching_add->sekretaris->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_coaching_add->sekretaris->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_sekretaris',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($t_coaching_add->sekretaris->ReadOnly || $t_coaching_add->sekretaris->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_sekretaris" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_coaching_add->sekretaris->displayValueSeparatorAttribute() ?>" name="x_sekretaris" id="x_sekretaris" value="<?php echo HtmlEncode($t_coaching_add->sekretaris->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_coachingadd"], function() {
	ft_coachingadd.createAutoSuggest({"id":"x_sekretaris","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $t_coaching_add->sekretaris->Lookup->getParamTag($t_coaching_add, "p_x_sekretaris") ?>
</span>
<?php echo $t_coaching_add->sekretaris->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coaching_add->bendahara->Visible) { // bendahara ?>
	<div id="r_bendahara" class="form-group row">
		<label id="elh_t_coaching_bendahara" class="<?php echo $t_coaching_add->LeftColumnClass ?>"><?php echo $t_coaching_add->bendahara->caption() ?><?php echo $t_coaching_add->bendahara->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_add->RightColumnClass ?>"><div <?php echo $t_coaching_add->bendahara->cellAttributes() ?>>
<span id="el_t_coaching_bendahara">
<?php
$onchange = $t_coaching_add->bendahara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_coaching_add->bendahara->EditAttrs["onchange"] = "";
?>
<span id="as_x_bendahara">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_bendahara" id="sv_x_bendahara" value="<?php echo RemoveHtml($t_coaching_add->bendahara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($t_coaching_add->bendahara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_coaching_add->bendahara->getPlaceHolder()) ?>"<?php echo $t_coaching_add->bendahara->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_coaching_add->bendahara->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_bendahara',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($t_coaching_add->bendahara->ReadOnly || $t_coaching_add->bendahara->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="t_coaching" data-field="x_bendahara" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_coaching_add->bendahara->displayValueSeparatorAttribute() ?>" name="x_bendahara" id="x_bendahara" value="<?php echo HtmlEncode($t_coaching_add->bendahara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_coachingadd"], function() {
	ft_coachingadd.createAutoSuggest({"id":"x_bendahara","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $t_coaching_add->bendahara->Lookup->getParamTag($t_coaching_add, "p_x_bendahara") ?>
</span>
<?php echo $t_coaching_add->bendahara->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coaching_add->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_t_coaching_status" for="x_status" class="<?php echo $t_coaching_add->LeftColumnClass ?>"><?php echo $t_coaching_add->status->caption() ?><?php echo $t_coaching_add->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_add->RightColumnClass ?>"><div <?php echo $t_coaching_add->status->cellAttributes() ?>>
<span id="el_t_coaching_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coaching" data-field="x_status" data-value-separator="<?php echo $t_coaching_add->status->displayValueSeparatorAttribute() ?>" id="x_status" name="x_status"<?php echo $t_coaching_add->status->editAttributes() ?>>
			<?php echo $t_coaching_add->status->selectOptionListHtml("x_status") ?>
		</select>
</div>
</span>
<?php echo $t_coaching_add->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coaching_add->jenisevaluasi->Visible) { // jenisevaluasi ?>
	<div id="r_jenisevaluasi" class="form-group row">
		<label id="elh_t_coaching_jenisevaluasi" class="<?php echo $t_coaching_add->LeftColumnClass ?>"><?php echo $t_coaching_add->jenisevaluasi->caption() ?><?php echo $t_coaching_add->jenisevaluasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coaching_add->RightColumnClass ?>"><div <?php echo $t_coaching_add->jenisevaluasi->cellAttributes() ?>>
<span id="el_t_coaching_jenisevaluasi">
<div id="tp_x_jenisevaluasi" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="t_coaching" data-field="x_jenisevaluasi" data-value-separator="<?php echo $t_coaching_add->jenisevaluasi->displayValueSeparatorAttribute() ?>" name="x_jenisevaluasi[]" id="x_jenisevaluasi[]" value="{value}"<?php echo $t_coaching_add->jenisevaluasi->editAttributes() ?>></div>
<div id="dsl_x_jenisevaluasi" data-repeatcolumn="1" class="ew-item-list d-none"><div>
<?php echo $t_coaching_add->jenisevaluasi->checkBoxListHtml(FALSE, "x_jenisevaluasi[]") ?>
</div></div>
<?php echo $t_coaching_add->jenisevaluasi->Lookup->getParamTag($t_coaching_add, "p_x_jenisevaluasi") ?>
</span>
<?php echo $t_coaching_add->jenisevaluasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_coaching_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_coaching_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_coaching_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_coaching_add->showPageFooter();
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
$t_coaching_add->terminate();
?>