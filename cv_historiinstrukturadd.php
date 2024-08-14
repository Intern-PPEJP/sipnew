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
$cv_historiinstruktur_add = new cv_historiinstruktur_add();

// Run the page
$cv_historiinstruktur_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cv_historiinstruktur_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcv_historiinstrukturadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcv_historiinstrukturadd = currentForm = new ew.Form("fcv_historiinstrukturadd", "add");

	// Validate form
	fcv_historiinstrukturadd.validate = function() {
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
			<?php if ($cv_historiinstruktur_add->kdpelat->Required) { ?>
				elm = this.getElements("x" + infix + "_kdpelat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historiinstruktur_add->kdpelat->caption(), $cv_historiinstruktur_add->kdpelat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cv_historiinstruktur_add->bioid->Required) { ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cv_historiinstruktur_add->bioid->caption(), $cv_historiinstruktur_add->bioid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cv_historiinstruktur_add->bioid->errorMessage()) ?>");

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
	fcv_historiinstrukturadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcv_historiinstrukturadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcv_historiinstrukturadd.lists["x_bioid"] = <?php echo $cv_historiinstruktur_add->bioid->Lookup->toClientList($cv_historiinstruktur_add) ?>;
	fcv_historiinstrukturadd.lists["x_bioid"].options = <?php echo JsonEncode($cv_historiinstruktur_add->bioid->lookupOptions()) ?>;
	fcv_historiinstrukturadd.autoSuggests["x_bioid"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fcv_historiinstrukturadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cv_historiinstruktur_add->showPageHeader(); ?>
<?php
$cv_historiinstruktur_add->showMessage();
?>
<form name="fcv_historiinstrukturadd" id="fcv_historiinstrukturadd" class="<?php echo $cv_historiinstruktur_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cv_historiinstruktur">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$cv_historiinstruktur_add->IsModal ?>">
<?php if ($cv_historiinstruktur->getCurrentMasterTable() == "t_pelatihan") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_pelatihan">
<input type="hidden" name="fk_kdpelat" value="<?php echo HtmlEncode($cv_historiinstruktur_add->kdpelat->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($cv_historiinstruktur_add->kdpelat->Visible) { // kdpelat ?>
	<div id="r_kdpelat" class="form-group row">
		<label id="elh_cv_historiinstruktur_kdpelat" for="x_kdpelat" class="<?php echo $cv_historiinstruktur_add->LeftColumnClass ?>"><?php echo $cv_historiinstruktur_add->kdpelat->caption() ?><?php echo $cv_historiinstruktur_add->kdpelat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cv_historiinstruktur_add->RightColumnClass ?>"><div <?php echo $cv_historiinstruktur_add->kdpelat->cellAttributes() ?>>
<?php if ($cv_historiinstruktur_add->kdpelat->getSessionValue() != "") { ?>
<span id="el_cv_historiinstruktur_kdpelat">
<span<?php echo $cv_historiinstruktur_add->kdpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cv_historiinstruktur_add->kdpelat->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_kdpelat" name="x_kdpelat" value="<?php echo HtmlEncode($cv_historiinstruktur_add->kdpelat->CurrentValue) ?>">
<?php } else { ?>
<span id="el_cv_historiinstruktur_kdpelat">
<input type="text" data-table="cv_historiinstruktur" data-field="x_kdpelat" name="x_kdpelat" id="x_kdpelat" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($cv_historiinstruktur_add->kdpelat->getPlaceHolder()) ?>" value="<?php echo $cv_historiinstruktur_add->kdpelat->EditValue ?>"<?php echo $cv_historiinstruktur_add->kdpelat->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $cv_historiinstruktur_add->kdpelat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cv_historiinstruktur_add->bioid->Visible) { // bioid ?>
	<div id="r_bioid" class="form-group row">
		<label id="elh_cv_historiinstruktur_bioid" class="<?php echo $cv_historiinstruktur_add->LeftColumnClass ?>"><?php echo $cv_historiinstruktur_add->bioid->caption() ?><?php echo $cv_historiinstruktur_add->bioid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cv_historiinstruktur_add->RightColumnClass ?>"><div <?php echo $cv_historiinstruktur_add->bioid->cellAttributes() ?>>
<span id="el_cv_historiinstruktur_bioid">
<?php
$onchange = $cv_historiinstruktur_add->bioid->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$cv_historiinstruktur_add->bioid->EditAttrs["onchange"] = "";
?>
<span id="as_x_bioid">
	<input type="text" class="form-control" name="sv_x_bioid" id="sv_x_bioid" value="<?php echo RemoveHtml($cv_historiinstruktur_add->bioid->EditValue) ?>" size="100" placeholder="<?php echo HtmlEncode($cv_historiinstruktur_add->bioid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($cv_historiinstruktur_add->bioid->getPlaceHolder()) ?>"<?php echo $cv_historiinstruktur_add->bioid->editAttributes() ?>>
</span>
<input type="hidden" data-table="cv_historiinstruktur" data-field="x_bioid" data-value-separator="<?php echo $cv_historiinstruktur_add->bioid->displayValueSeparatorAttribute() ?>" name="x_bioid" id="x_bioid" value="<?php echo HtmlEncode($cv_historiinstruktur_add->bioid->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcv_historiinstrukturadd"], function() {
	fcv_historiinstrukturadd.createAutoSuggest({"id":"x_bioid","forceSelect":false});
});
</script>
<?php echo $cv_historiinstruktur_add->bioid->Lookup->getParamTag($cv_historiinstruktur_add, "p_x_bioid") ?>
</span>
<?php echo $cv_historiinstruktur_add->bioid->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cv_historiinstruktur_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cv_historiinstruktur_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cv_historiinstruktur_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cv_historiinstruktur_add->showPageFooter();
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
$cv_historiinstruktur_add->terminate();
?>