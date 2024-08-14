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
$t_faskur_add = new t_faskur_add();

// Run the page
$t_faskur_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_faskur_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_faskuradd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_faskuradd = currentForm = new ew.Form("ft_faskuradd", "add");

	// Validate form
	ft_faskuradd.validate = function() {
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
			<?php if ($t_faskur_add->bioid->Required) { ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_faskur_add->bioid->caption(), $t_faskur_add->bioid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_bioid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_faskur_add->bioid->errorMessage()) ?>");
			<?php if ($t_faskur_add->kurikulumid->Required) { ?>
				elm = this.getElements("x" + infix + "_kurikulumid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_faskur_add->kurikulumid->caption(), $t_faskur_add->kurikulumid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kurikulumid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_faskur_add->kurikulumid->errorMessage()) ?>");

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
	ft_faskuradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_faskuradd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_faskuradd.lists["x_bioid"] = <?php echo $t_faskur_add->bioid->Lookup->toClientList($t_faskur_add) ?>;
	ft_faskuradd.lists["x_bioid"].options = <?php echo JsonEncode($t_faskur_add->bioid->lookupOptions()) ?>;
	ft_faskuradd.autoSuggests["x_bioid"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_faskuradd.lists["x_kurikulumid"] = <?php echo $t_faskur_add->kurikulumid->Lookup->toClientList($t_faskur_add) ?>;
	ft_faskuradd.lists["x_kurikulumid"].options = <?php echo JsonEncode($t_faskur_add->kurikulumid->lookupOptions()) ?>;
	ft_faskuradd.autoSuggests["x_kurikulumid"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("ft_faskuradd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_faskur_add->showPageHeader(); ?>
<?php
$t_faskur_add->showMessage();
?>
<form name="ft_faskuradd" id="ft_faskuradd" class="<?php echo $t_faskur_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_faskur">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_faskur_add->IsModal ?>">
<?php if ($t_faskur->getCurrentMasterTable() == "t_biointruktur") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_biointruktur">
<input type="hidden" name="fk_bioid" value="<?php echo HtmlEncode($t_faskur_add->bioid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($t_faskur_add->bioid->Visible) { // bioid ?>
	<div id="r_bioid" class="form-group row">
		<label id="elh_t_faskur_bioid" class="<?php echo $t_faskur_add->LeftColumnClass ?>"><?php echo $t_faskur_add->bioid->caption() ?><?php echo $t_faskur_add->bioid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_faskur_add->RightColumnClass ?>"><div <?php echo $t_faskur_add->bioid->cellAttributes() ?>>
<?php if ($t_faskur_add->bioid->getSessionValue() != "") { ?>
<span id="el_t_faskur_bioid">
<span<?php echo $t_faskur_add->bioid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_faskur_add->bioid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_bioid" name="x_bioid" value="<?php echo HtmlEncode($t_faskur_add->bioid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_faskur_bioid">
<?php
$onchange = $t_faskur_add->bioid->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_faskur_add->bioid->EditAttrs["onchange"] = "";
?>
<span id="as_x_bioid">
	<input type="text" class="form-control" name="sv_x_bioid" id="sv_x_bioid" value="<?php echo RemoveHtml($t_faskur_add->bioid->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($t_faskur_add->bioid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_faskur_add->bioid->getPlaceHolder()) ?>"<?php echo $t_faskur_add->bioid->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_faskur" data-field="x_bioid" data-value-separator="<?php echo $t_faskur_add->bioid->displayValueSeparatorAttribute() ?>" name="x_bioid" id="x_bioid" value="<?php echo HtmlEncode($t_faskur_add->bioid->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_faskuradd"], function() {
	ft_faskuradd.createAutoSuggest({"id":"x_bioid","forceSelect":false,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_faskur_add->bioid->Lookup->getParamTag($t_faskur_add, "p_x_bioid") ?>
</span>
<?php } ?>
<?php echo $t_faskur_add->bioid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_faskur_add->kurikulumid->Visible) { // kurikulumid ?>
	<div id="r_kurikulumid" class="form-group row">
		<label id="elh_t_faskur_kurikulumid" class="<?php echo $t_faskur_add->LeftColumnClass ?>"><?php echo $t_faskur_add->kurikulumid->caption() ?><?php echo $t_faskur_add->kurikulumid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_faskur_add->RightColumnClass ?>"><div <?php echo $t_faskur_add->kurikulumid->cellAttributes() ?>>
<span id="el_t_faskur_kurikulumid">
<?php
$onchange = $t_faskur_add->kurikulumid->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_faskur_add->kurikulumid->EditAttrs["onchange"] = "";
?>
<span id="as_x_kurikulumid">
	<input type="text" class="form-control" name="sv_x_kurikulumid" id="sv_x_kurikulumid" value="<?php echo RemoveHtml($t_faskur_add->kurikulumid->EditValue) ?>" size="50" placeholder="<?php echo HtmlEncode($t_faskur_add->kurikulumid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_faskur_add->kurikulumid->getPlaceHolder()) ?>"<?php echo $t_faskur_add->kurikulumid->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_faskur" data-field="x_kurikulumid" data-value-separator="<?php echo $t_faskur_add->kurikulumid->displayValueSeparatorAttribute() ?>" name="x_kurikulumid" id="x_kurikulumid" value="<?php echo HtmlEncode($t_faskur_add->kurikulumid->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_faskuradd"], function() {
	ft_faskuradd.createAutoSuggest({"id":"x_kurikulumid","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_faskur_add->kurikulumid->Lookup->getParamTag($t_faskur_add, "p_x_kurikulumid") ?>
</span>
<?php echo $t_faskur_add->kurikulumid->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_faskur_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_faskur_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_faskur_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_faskur_add->showPageFooter();
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
$t_faskur_add->terminate();
?>