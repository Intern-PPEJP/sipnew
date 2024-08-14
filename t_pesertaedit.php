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
$t_peserta_edit = new t_peserta_edit();

// Run the page
$t_peserta_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_peserta_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_pesertaedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_pesertaedit = currentForm = new ew.Form("ft_pesertaedit", "edit");

	// Validate form
	ft_pesertaedit.validate = function() {
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
			<?php if ($t_peserta_edit->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_edit->nama->caption(), $t_peserta_edit->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_edit->idp->Required) { ?>
				elm = this.getElements("x" + infix + "_idp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_edit->idp->caption(), $t_peserta_edit->idp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_edit->tempat->Required) { ?>
				elm = this.getElements("x" + infix + "_tempat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_edit->tempat->caption(), $t_peserta_edit->tempat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_edit->tlahir->Required) { ?>
				elm = this.getElements("x" + infix + "_tlahir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_edit->tlahir->caption(), $t_peserta_edit->tlahir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tlahir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_peserta_edit->tlahir->errorMessage()) ?>");
			<?php if ($t_peserta_edit->kdagama->Required) { ?>
				elm = this.getElements("x" + infix + "_kdagama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_edit->kdagama->caption(), $t_peserta_edit->kdagama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_edit->kdsex->Required) { ?>
				elm = this.getElements("x" + infix + "_kdsex");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_edit->kdsex->caption(), $t_peserta_edit->kdsex->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_edit->kdprop->Required) { ?>
				elm = this.getElements("x" + infix + "_kdprop");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_edit->kdprop->caption(), $t_peserta_edit->kdprop->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_edit->kdkota->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkota");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_edit->kdkota->caption(), $t_peserta_edit->kdkota->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_edit->kdkec->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkec");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_edit->kdkec->caption(), $t_peserta_edit->kdkec->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_edit->alamat->Required) { ?>
				elm = this.getElements("x" + infix + "_alamat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_edit->alamat->caption(), $t_peserta_edit->alamat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_edit->kdpos->Required) { ?>
				elm = this.getElements("x" + infix + "_kdpos");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_edit->kdpos->caption(), $t_peserta_edit->kdpos->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_edit->telp->Required) { ?>
				elm = this.getElements("x" + infix + "_telp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_edit->telp->caption(), $t_peserta_edit->telp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_edit->hp->Required) { ?>
				elm = this.getElements("x" + infix + "_hp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_edit->hp->caption(), $t_peserta_edit->hp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_edit->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_edit->_email->caption(), $t_peserta_edit->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_edit->kdjabat->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjabat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_edit->kdjabat->caption(), $t_peserta_edit->kdjabat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_edit->kdpend->Required) { ?>
				elm = this.getElements("x" + infix + "_kdpend");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_edit->kdpend->caption(), $t_peserta_edit->kdpend->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_edit->kdbahasa->Required) { ?>
				elm = this.getElements("x" + infix + "_kdbahasa");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_edit->kdbahasa->caption(), $t_peserta_edit->kdbahasa->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_peserta_edit->updated_at->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_peserta_edit->updated_at->caption(), $t_peserta_edit->updated_at->RequiredErrorMessage)) ?>");
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
	ft_pesertaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_pesertaedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_pesertaedit.lists["x_idp"] = <?php echo $t_peserta_edit->idp->Lookup->toClientList($t_peserta_edit) ?>;
	ft_pesertaedit.lists["x_idp"].options = <?php echo JsonEncode($t_peserta_edit->idp->lookupOptions()) ?>;
	ft_pesertaedit.autoSuggests["x_idp"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_pesertaedit.lists["x_kdagama"] = <?php echo $t_peserta_edit->kdagama->Lookup->toClientList($t_peserta_edit) ?>;
	ft_pesertaedit.lists["x_kdagama"].options = <?php echo JsonEncode($t_peserta_edit->kdagama->lookupOptions()) ?>;
	ft_pesertaedit.lists["x_kdsex"] = <?php echo $t_peserta_edit->kdsex->Lookup->toClientList($t_peserta_edit) ?>;
	ft_pesertaedit.lists["x_kdsex"].options = <?php echo JsonEncode($t_peserta_edit->kdsex->options(FALSE, TRUE)) ?>;
	ft_pesertaedit.lists["x_kdprop"] = <?php echo $t_peserta_edit->kdprop->Lookup->toClientList($t_peserta_edit) ?>;
	ft_pesertaedit.lists["x_kdprop"].options = <?php echo JsonEncode($t_peserta_edit->kdprop->lookupOptions()) ?>;
	ft_pesertaedit.lists["x_kdkota"] = <?php echo $t_peserta_edit->kdkota->Lookup->toClientList($t_peserta_edit) ?>;
	ft_pesertaedit.lists["x_kdkota"].options = <?php echo JsonEncode($t_peserta_edit->kdkota->lookupOptions()) ?>;
	ft_pesertaedit.lists["x_kdkec"] = <?php echo $t_peserta_edit->kdkec->Lookup->toClientList($t_peserta_edit) ?>;
	ft_pesertaedit.lists["x_kdkec"].options = <?php echo JsonEncode($t_peserta_edit->kdkec->lookupOptions()) ?>;
	ft_pesertaedit.lists["x_kdjabat"] = <?php echo $t_peserta_edit->kdjabat->Lookup->toClientList($t_peserta_edit) ?>;
	ft_pesertaedit.lists["x_kdjabat"].options = <?php echo JsonEncode($t_peserta_edit->kdjabat->lookupOptions()) ?>;
	ft_pesertaedit.lists["x_kdpend"] = <?php echo $t_peserta_edit->kdpend->Lookup->toClientList($t_peserta_edit) ?>;
	ft_pesertaedit.lists["x_kdpend"].options = <?php echo JsonEncode($t_peserta_edit->kdpend->lookupOptions()) ?>;
	ft_pesertaedit.lists["x_kdbahasa"] = <?php echo $t_peserta_edit->kdbahasa->Lookup->toClientList($t_peserta_edit) ?>;
	ft_pesertaedit.lists["x_kdbahasa"].options = <?php echo JsonEncode($t_peserta_edit->kdbahasa->lookupOptions()) ?>;
	loadjs.done("ft_pesertaedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//document.write('<?php echo cs_judul("edit","Peserta : Mengubah Data");?>');

});
</script>
<?php $t_peserta_edit->showPageHeader(); ?>
<?php
$t_peserta_edit->showMessage();
?>
<form name="ft_pesertaedit" id="ft_pesertaedit" class="<?php echo $t_peserta_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_peserta">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_peserta_edit->IsModal ?>">
<?php if ($t_peserta->getCurrentMasterTable() == "t_perusahaan") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_perusahaan">
<input type="hidden" name="fk_idp" value="<?php echo HtmlEncode($t_peserta_edit->idp->getSessionValue()) ?>">
<?php } ?>
<?php if ($t_peserta->getCurrentMasterTable() == "t_kota") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_kota">
<input type="hidden" name="fk_kdkota" value="<?php echo HtmlEncode($t_peserta_edit->kdkota->getSessionValue()) ?>">
<?php } ?>
<?php if ($t_peserta->getCurrentMasterTable() == "t_prop") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_prop">
<input type="hidden" name="fk_kdprop" value="<?php echo HtmlEncode($t_peserta_edit->kdprop->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_peserta_edit->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_t_peserta_nama" for="x_nama" class="<?php echo $t_peserta_edit->LeftColumnClass ?>"><?php echo $t_peserta_edit->nama->caption() ?><?php echo $t_peserta_edit->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_peserta_edit->RightColumnClass ?>"><div <?php echo $t_peserta_edit->nama->cellAttributes() ?>>
<span id="el_t_peserta_nama">
<input type="text" data-table="t_peserta" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_peserta_edit->nama->getPlaceHolder()) ?>" value="<?php echo $t_peserta_edit->nama->EditValue ?>"<?php echo $t_peserta_edit->nama->editAttributes() ?>>
</span>
<?php echo $t_peserta_edit->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_edit->idp->Visible) { // idp ?>
	<div id="r_idp" class="form-group row">
		<label id="elh_t_peserta_idp" class="<?php echo $t_peserta_edit->LeftColumnClass ?>"><?php echo $t_peserta_edit->idp->caption() ?><?php echo $t_peserta_edit->idp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_peserta_edit->RightColumnClass ?>"><div <?php echo $t_peserta_edit->idp->cellAttributes() ?>>
<?php if ($t_peserta_edit->idp->getSessionValue() != "") { ?>
<span id="el_t_peserta_idp">
<span<?php echo $t_peserta_edit->idp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_edit->idp->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_idp" name="x_idp" value="<?php echo HtmlEncode($t_peserta_edit->idp->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_peserta_idp">
<?php
$onchange = $t_peserta_edit->idp->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_peserta_edit->idp->EditAttrs["onchange"] = "";
?>
<span id="as_x_idp">
	<input type="text" class="form-control" name="sv_x_idp" id="sv_x_idp" value="<?php echo RemoveHtml($t_peserta_edit->idp->EditValue) ?>" size="75" placeholder="<?php echo HtmlEncode($t_peserta_edit->idp->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_peserta_edit->idp->getPlaceHolder()) ?>"<?php echo $t_peserta_edit->idp->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_peserta" data-field="x_idp" data-value-separator="<?php echo $t_peserta_edit->idp->displayValueSeparatorAttribute() ?>" name="x_idp" id="x_idp" value="<?php echo HtmlEncode($t_peserta_edit->idp->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_pesertaedit"], function() {
	ft_pesertaedit.createAutoSuggest({"id":"x_idp","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_peserta_edit->idp->Lookup->getParamTag($t_peserta_edit, "p_x_idp") ?>
</span>
<?php } ?>
<?php echo $t_peserta_edit->idp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_edit->tempat->Visible) { // tempat ?>
	<div id="r_tempat" class="form-group row">
		<label id="elh_t_peserta_tempat" for="x_tempat" class="<?php echo $t_peserta_edit->LeftColumnClass ?>"><?php echo $t_peserta_edit->tempat->caption() ?><?php echo $t_peserta_edit->tempat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_peserta_edit->RightColumnClass ?>"><div <?php echo $t_peserta_edit->tempat->cellAttributes() ?>>
<span id="el_t_peserta_tempat">
<input type="text" data-table="t_peserta" data-field="x_tempat" name="x_tempat" id="x_tempat" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($t_peserta_edit->tempat->getPlaceHolder()) ?>" value="<?php echo $t_peserta_edit->tempat->EditValue ?>"<?php echo $t_peserta_edit->tempat->editAttributes() ?>>
</span>
<?php echo $t_peserta_edit->tempat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_edit->tlahir->Visible) { // tlahir ?>
	<div id="r_tlahir" class="form-group row">
		<label id="elh_t_peserta_tlahir" for="x_tlahir" class="<?php echo $t_peserta_edit->LeftColumnClass ?>"><?php echo $t_peserta_edit->tlahir->caption() ?><?php echo $t_peserta_edit->tlahir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_peserta_edit->RightColumnClass ?>"><div <?php echo $t_peserta_edit->tlahir->cellAttributes() ?>>
<span id="el_t_peserta_tlahir">
<input type="text" data-table="t_peserta" data-field="x_tlahir" name="x_tlahir" id="x_tlahir" size="10" placeholder="<?php echo HtmlEncode($t_peserta_edit->tlahir->getPlaceHolder()) ?>" value="<?php echo $t_peserta_edit->tlahir->EditValue ?>"<?php echo $t_peserta_edit->tlahir->editAttributes() ?>>
<?php if (!$t_peserta_edit->tlahir->ReadOnly && !$t_peserta_edit->tlahir->Disabled && !isset($t_peserta_edit->tlahir->EditAttrs["readonly"]) && !isset($t_peserta_edit->tlahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_pesertaedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_pesertaedit", "x_tlahir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_peserta_edit->tlahir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_edit->kdagama->Visible) { // kdagama ?>
	<div id="r_kdagama" class="form-group row">
		<label id="elh_t_peserta_kdagama" for="x_kdagama" class="<?php echo $t_peserta_edit->LeftColumnClass ?>"><?php echo $t_peserta_edit->kdagama->caption() ?><?php echo $t_peserta_edit->kdagama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_peserta_edit->RightColumnClass ?>"><div <?php echo $t_peserta_edit->kdagama->cellAttributes() ?>>
<span id="el_t_peserta_kdagama">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdagama" data-value-separator="<?php echo $t_peserta_edit->kdagama->displayValueSeparatorAttribute() ?>" id="x_kdagama" name="x_kdagama"<?php echo $t_peserta_edit->kdagama->editAttributes() ?>>
			<?php echo $t_peserta_edit->kdagama->selectOptionListHtml("x_kdagama") ?>
		</select>
</div>
<?php echo $t_peserta_edit->kdagama->Lookup->getParamTag($t_peserta_edit, "p_x_kdagama") ?>
</span>
<?php echo $t_peserta_edit->kdagama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_edit->kdsex->Visible) { // kdsex ?>
	<div id="r_kdsex" class="form-group row">
		<label id="elh_t_peserta_kdsex" class="<?php echo $t_peserta_edit->LeftColumnClass ?>"><?php echo $t_peserta_edit->kdsex->caption() ?><?php echo $t_peserta_edit->kdsex->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_peserta_edit->RightColumnClass ?>"><div <?php echo $t_peserta_edit->kdsex->cellAttributes() ?>>
<span id="el_t_peserta_kdsex">
<div id="tp_x_kdsex" class="ew-template"><input type="radio" class="custom-control-input" data-table="t_peserta" data-field="x_kdsex" data-value-separator="<?php echo $t_peserta_edit->kdsex->displayValueSeparatorAttribute() ?>" name="x_kdsex" id="x_kdsex" value="{value}"<?php echo $t_peserta_edit->kdsex->editAttributes() ?>></div>
<div id="dsl_x_kdsex" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_peserta_edit->kdsex->radioButtonListHtml(FALSE, "x_kdsex") ?>
</div></div>
</span>
<?php echo $t_peserta_edit->kdsex->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_edit->kdprop->Visible) { // kdprop ?>
	<div id="r_kdprop" class="form-group row">
		<label id="elh_t_peserta_kdprop" for="x_kdprop" class="<?php echo $t_peserta_edit->LeftColumnClass ?>"><?php echo $t_peserta_edit->kdprop->caption() ?><?php echo $t_peserta_edit->kdprop->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_peserta_edit->RightColumnClass ?>"><div <?php echo $t_peserta_edit->kdprop->cellAttributes() ?>>
<?php if ($t_peserta_edit->kdprop->getSessionValue() != "") { ?>
<span id="el_t_peserta_kdprop">
<span<?php echo $t_peserta_edit->kdprop->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_edit->kdprop->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_kdprop" name="x_kdprop" value="<?php echo HtmlEncode($t_peserta_edit->kdprop->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_peserta_kdprop">
<?php $t_peserta_edit->kdprop->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdprop" data-value-separator="<?php echo $t_peserta_edit->kdprop->displayValueSeparatorAttribute() ?>" id="x_kdprop" name="x_kdprop"<?php echo $t_peserta_edit->kdprop->editAttributes() ?>>
			<?php echo $t_peserta_edit->kdprop->selectOptionListHtml("x_kdprop") ?>
		</select>
</div>
<?php echo $t_peserta_edit->kdprop->Lookup->getParamTag($t_peserta_edit, "p_x_kdprop") ?>
</span>
<?php } ?>
<?php echo $t_peserta_edit->kdprop->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_edit->kdkota->Visible) { // kdkota ?>
	<div id="r_kdkota" class="form-group row">
		<label id="elh_t_peserta_kdkota" for="x_kdkota" class="<?php echo $t_peserta_edit->LeftColumnClass ?>"><?php echo $t_peserta_edit->kdkota->caption() ?><?php echo $t_peserta_edit->kdkota->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_peserta_edit->RightColumnClass ?>"><div <?php echo $t_peserta_edit->kdkota->cellAttributes() ?>>
<?php if ($t_peserta_edit->kdkota->getSessionValue() != "") { ?>
<span id="el_t_peserta_kdkota">
<span<?php echo $t_peserta_edit->kdkota->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_peserta_edit->kdkota->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_kdkota" name="x_kdkota" value="<?php echo HtmlEncode($t_peserta_edit->kdkota->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_peserta_kdkota">
<?php $t_peserta_edit->kdkota->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdkota" data-value-separator="<?php echo $t_peserta_edit->kdkota->displayValueSeparatorAttribute() ?>" id="x_kdkota" name="x_kdkota"<?php echo $t_peserta_edit->kdkota->editAttributes() ?>>
			<?php echo $t_peserta_edit->kdkota->selectOptionListHtml("x_kdkota") ?>
		</select>
</div>
<?php echo $t_peserta_edit->kdkota->Lookup->getParamTag($t_peserta_edit, "p_x_kdkota") ?>
</span>
<?php } ?>
<?php echo $t_peserta_edit->kdkota->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_edit->kdkec->Visible) { // kdkec ?>
	<div id="r_kdkec" class="form-group row">
		<label id="elh_t_peserta_kdkec" for="x_kdkec" class="<?php echo $t_peserta_edit->LeftColumnClass ?>"><?php echo $t_peserta_edit->kdkec->caption() ?><?php echo $t_peserta_edit->kdkec->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_peserta_edit->RightColumnClass ?>"><div <?php echo $t_peserta_edit->kdkec->cellAttributes() ?>>
<span id="el_t_peserta_kdkec">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdkec" data-value-separator="<?php echo $t_peserta_edit->kdkec->displayValueSeparatorAttribute() ?>" id="x_kdkec" name="x_kdkec"<?php echo $t_peserta_edit->kdkec->editAttributes() ?>>
			<?php echo $t_peserta_edit->kdkec->selectOptionListHtml("x_kdkec") ?>
		</select>
</div>
<?php echo $t_peserta_edit->kdkec->Lookup->getParamTag($t_peserta_edit, "p_x_kdkec") ?>
</span>
<?php echo $t_peserta_edit->kdkec->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_edit->alamat->Visible) { // alamat ?>
	<div id="r_alamat" class="form-group row">
		<label id="elh_t_peserta_alamat" for="x_alamat" class="<?php echo $t_peserta_edit->LeftColumnClass ?>"><?php echo $t_peserta_edit->alamat->caption() ?><?php echo $t_peserta_edit->alamat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_peserta_edit->RightColumnClass ?>"><div <?php echo $t_peserta_edit->alamat->cellAttributes() ?>>
<span id="el_t_peserta_alamat">
<textarea data-table="t_peserta" data-field="x_alamat" name="x_alamat" id="x_alamat" cols="50" rows="2" placeholder="<?php echo HtmlEncode($t_peserta_edit->alamat->getPlaceHolder()) ?>"<?php echo $t_peserta_edit->alamat->editAttributes() ?>><?php echo $t_peserta_edit->alamat->EditValue ?></textarea>
</span>
<?php echo $t_peserta_edit->alamat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_edit->kdpos->Visible) { // kdpos ?>
	<div id="r_kdpos" class="form-group row">
		<label id="elh_t_peserta_kdpos" for="x_kdpos" class="<?php echo $t_peserta_edit->LeftColumnClass ?>"><?php echo $t_peserta_edit->kdpos->caption() ?><?php echo $t_peserta_edit->kdpos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_peserta_edit->RightColumnClass ?>"><div <?php echo $t_peserta_edit->kdpos->cellAttributes() ?>>
<span id="el_t_peserta_kdpos">
<input type="text" data-table="t_peserta" data-field="x_kdpos" name="x_kdpos" id="x_kdpos" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_peserta_edit->kdpos->getPlaceHolder()) ?>" value="<?php echo $t_peserta_edit->kdpos->EditValue ?>"<?php echo $t_peserta_edit->kdpos->editAttributes() ?>>
</span>
<?php echo $t_peserta_edit->kdpos->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_edit->telp->Visible) { // telp ?>
	<div id="r_telp" class="form-group row">
		<label id="elh_t_peserta_telp" for="x_telp" class="<?php echo $t_peserta_edit->LeftColumnClass ?>"><?php echo $t_peserta_edit->telp->caption() ?><?php echo $t_peserta_edit->telp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_peserta_edit->RightColumnClass ?>"><div <?php echo $t_peserta_edit->telp->cellAttributes() ?>>
<span id="el_t_peserta_telp">
<input type="text" data-table="t_peserta" data-field="x_telp" name="x_telp" id="x_telp" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_peserta_edit->telp->getPlaceHolder()) ?>" value="<?php echo $t_peserta_edit->telp->EditValue ?>"<?php echo $t_peserta_edit->telp->editAttributes() ?>>
</span>
<?php echo $t_peserta_edit->telp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_edit->hp->Visible) { // hp ?>
	<div id="r_hp" class="form-group row">
		<label id="elh_t_peserta_hp" for="x_hp" class="<?php echo $t_peserta_edit->LeftColumnClass ?>"><?php echo $t_peserta_edit->hp->caption() ?><?php echo $t_peserta_edit->hp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_peserta_edit->RightColumnClass ?>"><div <?php echo $t_peserta_edit->hp->cellAttributes() ?>>
<span id="el_t_peserta_hp">
<input type="text" data-table="t_peserta" data-field="x_hp" name="x_hp" id="x_hp" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_peserta_edit->hp->getPlaceHolder()) ?>" value="<?php echo $t_peserta_edit->hp->EditValue ?>"<?php echo $t_peserta_edit->hp->editAttributes() ?>>
</span>
<?php echo $t_peserta_edit->hp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_edit->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_t_peserta__email" for="x__email" class="<?php echo $t_peserta_edit->LeftColumnClass ?>"><?php echo $t_peserta_edit->_email->caption() ?><?php echo $t_peserta_edit->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_peserta_edit->RightColumnClass ?>"><div <?php echo $t_peserta_edit->_email->cellAttributes() ?>>
<span id="el_t_peserta__email">
<input type="text" data-table="t_peserta" data-field="x__email" name="x__email" id="x__email" size="50" maxlength="80" placeholder="<?php echo HtmlEncode($t_peserta_edit->_email->getPlaceHolder()) ?>" value="<?php echo $t_peserta_edit->_email->EditValue ?>"<?php echo $t_peserta_edit->_email->editAttributes() ?>>
</span>
<?php echo $t_peserta_edit->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_edit->kdjabat->Visible) { // kdjabat ?>
	<div id="r_kdjabat" class="form-group row">
		<label id="elh_t_peserta_kdjabat" for="x_kdjabat" class="<?php echo $t_peserta_edit->LeftColumnClass ?>"><?php echo $t_peserta_edit->kdjabat->caption() ?><?php echo $t_peserta_edit->kdjabat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_peserta_edit->RightColumnClass ?>"><div <?php echo $t_peserta_edit->kdjabat->cellAttributes() ?>>
<span id="el_t_peserta_kdjabat">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdjabat" data-value-separator="<?php echo $t_peserta_edit->kdjabat->displayValueSeparatorAttribute() ?>" id="x_kdjabat" name="x_kdjabat"<?php echo $t_peserta_edit->kdjabat->editAttributes() ?>>
			<?php echo $t_peserta_edit->kdjabat->selectOptionListHtml("x_kdjabat") ?>
		</select>
</div>
<?php echo $t_peserta_edit->kdjabat->Lookup->getParamTag($t_peserta_edit, "p_x_kdjabat") ?>
</span>
<?php echo $t_peserta_edit->kdjabat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_edit->kdpend->Visible) { // kdpend ?>
	<div id="r_kdpend" class="form-group row">
		<label id="elh_t_peserta_kdpend" for="x_kdpend" class="<?php echo $t_peserta_edit->LeftColumnClass ?>"><?php echo $t_peserta_edit->kdpend->caption() ?><?php echo $t_peserta_edit->kdpend->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_peserta_edit->RightColumnClass ?>"><div <?php echo $t_peserta_edit->kdpend->cellAttributes() ?>>
<span id="el_t_peserta_kdpend">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdpend" data-value-separator="<?php echo $t_peserta_edit->kdpend->displayValueSeparatorAttribute() ?>" id="x_kdpend" name="x_kdpend"<?php echo $t_peserta_edit->kdpend->editAttributes() ?>>
			<?php echo $t_peserta_edit->kdpend->selectOptionListHtml("x_kdpend") ?>
		</select>
</div>
<?php echo $t_peserta_edit->kdpend->Lookup->getParamTag($t_peserta_edit, "p_x_kdpend") ?>
</span>
<?php echo $t_peserta_edit->kdpend->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_peserta_edit->kdbahasa->Visible) { // kdbahasa ?>
	<div id="r_kdbahasa" class="form-group row">
		<label id="elh_t_peserta_kdbahasa" for="x_kdbahasa" class="<?php echo $t_peserta_edit->LeftColumnClass ?>"><?php echo $t_peserta_edit->kdbahasa->caption() ?><?php echo $t_peserta_edit->kdbahasa->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_peserta_edit->RightColumnClass ?>"><div <?php echo $t_peserta_edit->kdbahasa->cellAttributes() ?>>
<span id="el_t_peserta_kdbahasa">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_peserta" data-field="x_kdbahasa" data-value-separator="<?php echo $t_peserta_edit->kdbahasa->displayValueSeparatorAttribute() ?>" id="x_kdbahasa" name="x_kdbahasa"<?php echo $t_peserta_edit->kdbahasa->editAttributes() ?>>
			<?php echo $t_peserta_edit->kdbahasa->selectOptionListHtml("x_kdbahasa") ?>
		</select>
</div>
<?php echo $t_peserta_edit->kdbahasa->Lookup->getParamTag($t_peserta_edit, "p_x_kdbahasa") ?>
</span>
<?php echo $t_peserta_edit->kdbahasa->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="t_peserta" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($t_peserta_edit->id->CurrentValue) ?>">
<?php
	if (in_array("cv_historipelatihanpeserta", explode(",", $t_peserta->getCurrentDetailTable())) && $cv_historipelatihanpeserta->DetailEdit) {
?>
<?php if ($t_peserta->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("cv_historipelatihanpeserta", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "cv_historipelatihanpesertagrid.php" ?>
<?php } ?>
<?php if (!$t_peserta_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_peserta_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_peserta_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_peserta_edit->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$("#x__email").after("<div><span class='label label-info'>Email lebih dari satu pisahkan dengan koma</span></div>");
});
</script>
<?php include_once "footer.php"; ?>
<?php
$t_peserta_edit->terminate();
?>