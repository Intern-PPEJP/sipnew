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
$t_evaluasifas_add = new t_evaluasifas_add();

// Run the page
$t_evaluasifas_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_evaluasifas_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_evaluasifasadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_evaluasifasadd = currentForm = new ew.Form("ft_evaluasifasadd", "add");

	// Validate form
	ft_evaluasifasadd.validate = function() {
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
			<?php if ($t_evaluasifas_add->bioid->Required) { ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_evaluasifas_add->bioid->caption(), $t_evaluasifas_add->bioid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_evaluasifas_add->bioid->errorMessage()) ?>");
			<?php if ($t_evaluasifas_add->idpelat->Required) { ?>
				elm = this.getElements("x" + infix + "_idpelat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_evaluasifas_add->idpelat->caption(), $t_evaluasifas_add->idpelat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_evaluasifas_add->kurikulumid->Required) { ?>
				elm = this.getElements("x" + infix + "_kurikulumid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_evaluasifas_add->kurikulumid->caption(), $t_evaluasifas_add->kurikulumid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_evaluasifas_add->nilai->Required) { ?>
				elm = this.getElements("x" + infix + "_nilai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_evaluasifas_add->nilai->caption(), $t_evaluasifas_add->nilai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nilai");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_evaluasifas_add->nilai->errorMessage()) ?>");
			<?php if ($t_evaluasifas_add->komentar->Required) { ?>
				elm = this.getElements("x" + infix + "_komentar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_evaluasifas_add->komentar->caption(), $t_evaluasifas_add->komentar->RequiredErrorMessage)) ?>");
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
	ft_evaluasifasadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_evaluasifasadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_evaluasifasadd.lists["x_bioid"] = <?php echo $t_evaluasifas_add->bioid->Lookup->toClientList($t_evaluasifas_add) ?>;
	ft_evaluasifasadd.lists["x_bioid"].options = <?php echo JsonEncode($t_evaluasifas_add->bioid->lookupOptions()) ?>;
	ft_evaluasifasadd.autoSuggests["x_bioid"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_evaluasifasadd.lists["x_idpelat"] = <?php echo $t_evaluasifas_add->idpelat->Lookup->toClientList($t_evaluasifas_add) ?>;
	ft_evaluasifasadd.lists["x_idpelat"].options = <?php echo JsonEncode($t_evaluasifas_add->idpelat->lookupOptions()) ?>;
	ft_evaluasifasadd.lists["x_kurikulumid"] = <?php echo $t_evaluasifas_add->kurikulumid->Lookup->toClientList($t_evaluasifas_add) ?>;
	ft_evaluasifasadd.lists["x_kurikulumid"].options = <?php echo JsonEncode($t_evaluasifas_add->kurikulumid->lookupOptions()) ?>;
	loadjs.done("ft_evaluasifasadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_evaluasifas_add->showPageHeader(); ?>
<?php
$t_evaluasifas_add->showMessage();
?>
<form name="ft_evaluasifasadd" id="ft_evaluasifasadd" class="<?php echo $t_evaluasifas_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_evaluasifas">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_evaluasifas_add->IsModal ?>">
<?php if ($t_evaluasifas->getCurrentMasterTable() == "t_biointruktur") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_biointruktur">
<input type="hidden" name="fk_bioid" value="<?php echo HtmlEncode($t_evaluasifas_add->bioid->getSessionValue()) ?>">
<?php } ?>
<?php if ($t_evaluasifas->getCurrentMasterTable() == "cv_jp") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="cv_jp">
<input type="hidden" name="fk_bioid" value="<?php echo HtmlEncode($t_evaluasifas_add->bioid->getSessionValue()) ?>">
<input type="hidden" name="fk_idpelat" value="<?php echo HtmlEncode($t_evaluasifas_add->idpelat->getSessionValue()) ?>">
<input type="hidden" name="fk_kurikulumid" value="<?php echo HtmlEncode($t_evaluasifas_add->kurikulumid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($t_evaluasifas_add->bioid->Visible) { // bioid ?>
	<div id="r_bioid" class="form-group row">
		<label id="elh_t_evaluasifas_bioid" class="<?php echo $t_evaluasifas_add->LeftColumnClass ?>"><?php echo $t_evaluasifas_add->bioid->caption() ?><?php echo $t_evaluasifas_add->bioid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_evaluasifas_add->RightColumnClass ?>"><div <?php echo $t_evaluasifas_add->bioid->cellAttributes() ?>>
<?php if ($t_evaluasifas_add->bioid->getSessionValue() != "") { ?>
<span id="el_t_evaluasifas_bioid">
<span<?php echo $t_evaluasifas_add->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_evaluasifas_add->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_bioid" name="x_bioid" value="<?php echo HtmlEncode($t_evaluasifas_add->bioid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_evaluasifas_bioid">
<?php
$onchange = $t_evaluasifas_add->bioid->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_evaluasifas_add->bioid->EditAttrs["onchange"] = "";
?>
<span id="as_x_bioid">
	<input type="text" class="form-control" name="sv_x_bioid" id="sv_x_bioid" value="<?php echo RemoveHtml($t_evaluasifas_add->bioid->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($t_evaluasifas_add->bioid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_evaluasifas_add->bioid->getPlaceHolder()) ?>"<?php echo $t_evaluasifas_add->bioid->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_evaluasifas" data-field="x_bioid" data-page="1" data-value-separator="<?php echo $t_evaluasifas_add->bioid->displayValueSeparatorAttribute() ?>" name="x_bioid" id="x_bioid" value="<?php echo HtmlEncode($t_evaluasifas_add->bioid->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_evaluasifasadd"], function() {
	ft_evaluasifasadd.createAutoSuggest({"id":"x_bioid","forceSelect":false});
});
</script>
<?php echo $t_evaluasifas_add->bioid->Lookup->getParamTag($t_evaluasifas_add, "p_x_bioid") ?>
</span>
<?php } ?>
<?php echo $t_evaluasifas_add->bioid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_evaluasifas_add->idpelat->Visible) { // idpelat ?>
	<div id="r_idpelat" class="form-group row">
		<label id="elh_t_evaluasifas_idpelat" for="x_idpelat" class="<?php echo $t_evaluasifas_add->LeftColumnClass ?>"><?php echo $t_evaluasifas_add->idpelat->caption() ?><?php echo $t_evaluasifas_add->idpelat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_evaluasifas_add->RightColumnClass ?>"><div <?php echo $t_evaluasifas_add->idpelat->cellAttributes() ?>>
<?php if ($t_evaluasifas_add->idpelat->getSessionValue() != "") { ?>
<span id="el_t_evaluasifas_idpelat">
<span<?php echo $t_evaluasifas_add->idpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_evaluasifas_add->idpelat->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_idpelat" name="x_idpelat" value="<?php echo HtmlEncode($t_evaluasifas_add->idpelat->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_evaluasifas_idpelat">
<?php $t_evaluasifas_add->idpelat->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_evaluasifas" data-field="x_idpelat" data-page="1" data-value-separator="<?php echo $t_evaluasifas_add->idpelat->displayValueSeparatorAttribute() ?>" id="x_idpelat" name="x_idpelat"<?php echo $t_evaluasifas_add->idpelat->editAttributes() ?>>
			<?php echo $t_evaluasifas_add->idpelat->selectOptionListHtml("x_idpelat") ?>
		</select>
</div>
<?php echo $t_evaluasifas_add->idpelat->Lookup->getParamTag($t_evaluasifas_add, "p_x_idpelat") ?>
</span>
<?php } ?>
<?php echo $t_evaluasifas_add->idpelat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_evaluasifas_add->kurikulumid->Visible) { // kurikulumid ?>
	<div id="r_kurikulumid" class="form-group row">
		<label id="elh_t_evaluasifas_kurikulumid" for="x_kurikulumid" class="<?php echo $t_evaluasifas_add->LeftColumnClass ?>"><?php echo $t_evaluasifas_add->kurikulumid->caption() ?><?php echo $t_evaluasifas_add->kurikulumid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_evaluasifas_add->RightColumnClass ?>"><div <?php echo $t_evaluasifas_add->kurikulumid->cellAttributes() ?>>
<?php if ($t_evaluasifas_add->kurikulumid->getSessionValue() != "") { ?>
<span id="el_t_evaluasifas_kurikulumid">
<span<?php echo $t_evaluasifas_add->kurikulumid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_evaluasifas_add->kurikulumid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_kurikulumid" name="x_kurikulumid" value="<?php echo HtmlEncode($t_evaluasifas_add->kurikulumid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_evaluasifas_kurikulumid">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_evaluasifas" data-field="x_kurikulumid" data-page="1" data-value-separator="<?php echo $t_evaluasifas_add->kurikulumid->displayValueSeparatorAttribute() ?>" id="x_kurikulumid" name="x_kurikulumid"<?php echo $t_evaluasifas_add->kurikulumid->editAttributes() ?>>
			<?php echo $t_evaluasifas_add->kurikulumid->selectOptionListHtml("x_kurikulumid") ?>
		</select>
</div>
<?php echo $t_evaluasifas_add->kurikulumid->Lookup->getParamTag($t_evaluasifas_add, "p_x_kurikulumid") ?>
</span>
<?php } ?>
<?php echo $t_evaluasifas_add->kurikulumid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_evaluasifas_add->nilai->Visible) { // nilai ?>
	<div id="r_nilai" class="form-group row">
		<label id="elh_t_evaluasifas_nilai" for="x_nilai" class="<?php echo $t_evaluasifas_add->LeftColumnClass ?>"><?php echo $t_evaluasifas_add->nilai->caption() ?><?php echo $t_evaluasifas_add->nilai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_evaluasifas_add->RightColumnClass ?>"><div <?php echo $t_evaluasifas_add->nilai->cellAttributes() ?>>
<span id="el_t_evaluasifas_nilai">
<input type="text" data-table="t_evaluasifas" data-field="x_nilai" data-page="1" name="x_nilai" id="x_nilai" size="4" maxlength="7" placeholder="<?php echo HtmlEncode($t_evaluasifas_add->nilai->getPlaceHolder()) ?>" value="<?php echo $t_evaluasifas_add->nilai->EditValue ?>"<?php echo $t_evaluasifas_add->nilai->editAttributes() ?>>
</span>
<?php echo $t_evaluasifas_add->nilai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_evaluasifas_add->komentar->Visible) { // komentar ?>
	<div id="r_komentar" class="form-group row">
		<label id="elh_t_evaluasifas_komentar" for="x_komentar" class="<?php echo $t_evaluasifas_add->LeftColumnClass ?>"><?php echo $t_evaluasifas_add->komentar->caption() ?><?php echo $t_evaluasifas_add->komentar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_evaluasifas_add->RightColumnClass ?>"><div <?php echo $t_evaluasifas_add->komentar->cellAttributes() ?>>
<span id="el_t_evaluasifas_komentar">
<textarea data-table="t_evaluasifas" data-field="x_komentar" data-page="1" name="x_komentar" id="x_komentar" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_evaluasifas_add->komentar->getPlaceHolder()) ?>"<?php echo $t_evaluasifas_add->komentar->editAttributes() ?>><?php echo $t_evaluasifas_add->komentar->EditValue ?></textarea>
</span>
<?php echo $t_evaluasifas_add->komentar->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_evaluasifas_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_evaluasifas_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_evaluasifas_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_evaluasifas_add->showPageFooter();
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
$t_evaluasifas_add->terminate();
?>