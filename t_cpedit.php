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
$t_cp_edit = new t_cp_edit();

// Run the page
$t_cp_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_cp_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_cpedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_cpedit = currentForm = new ew.Form("ft_cpedit", "edit");

	// Validate form
	ft_cpedit.validate = function() {
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
			<?php if ($t_cp_edit->namap->Required) { ?>
				elm = this.getElements("x" + infix + "_namap");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_cp_edit->namap->caption(), $t_cp_edit->namap->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_namap");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_cp_edit->namap->errorMessage()) ?>");
			<?php if ($t_cp_edit->cp1->Required) { ?>
				elm = this.getElements("x" + infix + "_cp1");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_cp_edit->cp1->caption(), $t_cp_edit->cp1->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_cp_edit->cp2->Required) { ?>
				elm = this.getElements("x" + infix + "_cp2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_cp_edit->cp2->caption(), $t_cp_edit->cp2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_cp_edit->cp3->Required) { ?>
				elm = this.getElements("x" + infix + "_cp3");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_cp_edit->cp3->caption(), $t_cp_edit->cp3->RequiredErrorMessage)) ?>");
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
	ft_cpedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_cpedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_cpedit.lists["x_namap"] = <?php echo $t_cp_edit->namap->Lookup->toClientList($t_cp_edit) ?>;
	ft_cpedit.lists["x_namap"].options = <?php echo JsonEncode($t_cp_edit->namap->lookupOptions()) ?>;
	ft_cpedit.autoSuggests["x_namap"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("ft_cpedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_cp_edit->showPageHeader(); ?>
<?php
$t_cp_edit->showMessage();
?>
<form name="ft_cpedit" id="ft_cpedit" class="<?php echo $t_cp_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_cp">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_cp_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_cp_edit->namap->Visible) { // namap ?>
	<div id="r_namap" class="form-group row">
		<label id="elh_t_cp_namap" class="<?php echo $t_cp_edit->LeftColumnClass ?>"><?php echo $t_cp_edit->namap->caption() ?><?php echo $t_cp_edit->namap->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_cp_edit->RightColumnClass ?>"><div <?php echo $t_cp_edit->namap->cellAttributes() ?>>
<span id="el_t_cp_namap">
<?php
$onchange = $t_cp_edit->namap->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_cp_edit->namap->EditAttrs["onchange"] = "";
?>
<span id="as_x_namap">
	<input type="text" class="form-control" name="sv_x_namap" id="sv_x_namap" value="<?php echo RemoveHtml($t_cp_edit->namap->EditValue) ?>" size="75" maxlength="25" placeholder="<?php echo HtmlEncode($t_cp_edit->namap->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_cp_edit->namap->getPlaceHolder()) ?>"<?php echo $t_cp_edit->namap->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_cp" data-field="x_namap" data-value-separator="<?php echo $t_cp_edit->namap->displayValueSeparatorAttribute() ?>" name="x_namap" id="x_namap" value="<?php echo HtmlEncode($t_cp_edit->namap->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_cpedit"], function() {
	ft_cpedit.createAutoSuggest({"id":"x_namap","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_cp_edit->namap->Lookup->getParamTag($t_cp_edit, "p_x_namap") ?>
</span>
<?php echo $t_cp_edit->namap->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_cp_edit->cp1->Visible) { // cp1 ?>
	<div id="r_cp1" class="form-group row">
		<label id="elh_t_cp_cp1" for="x_cp1" class="<?php echo $t_cp_edit->LeftColumnClass ?>"><?php echo $t_cp_edit->cp1->caption() ?><?php echo $t_cp_edit->cp1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_cp_edit->RightColumnClass ?>"><div <?php echo $t_cp_edit->cp1->cellAttributes() ?>>
<span id="el_t_cp_cp1">
<textarea data-table="t_cp" data-field="x_cp1" name="x_cp1" id="x_cp1" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_cp_edit->cp1->getPlaceHolder()) ?>"<?php echo $t_cp_edit->cp1->editAttributes() ?>><?php echo $t_cp_edit->cp1->EditValue ?></textarea>
</span>
<?php echo $t_cp_edit->cp1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_cp_edit->cp2->Visible) { // cp2 ?>
	<div id="r_cp2" class="form-group row">
		<label id="elh_t_cp_cp2" for="x_cp2" class="<?php echo $t_cp_edit->LeftColumnClass ?>"><?php echo $t_cp_edit->cp2->caption() ?><?php echo $t_cp_edit->cp2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_cp_edit->RightColumnClass ?>"><div <?php echo $t_cp_edit->cp2->cellAttributes() ?>>
<span id="el_t_cp_cp2">
<textarea data-table="t_cp" data-field="x_cp2" name="x_cp2" id="x_cp2" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_cp_edit->cp2->getPlaceHolder()) ?>"<?php echo $t_cp_edit->cp2->editAttributes() ?>><?php echo $t_cp_edit->cp2->EditValue ?></textarea>
</span>
<?php echo $t_cp_edit->cp2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_cp_edit->cp3->Visible) { // cp3 ?>
	<div id="r_cp3" class="form-group row">
		<label id="elh_t_cp_cp3" for="x_cp3" class="<?php echo $t_cp_edit->LeftColumnClass ?>"><?php echo $t_cp_edit->cp3->caption() ?><?php echo $t_cp_edit->cp3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_cp_edit->RightColumnClass ?>"><div <?php echo $t_cp_edit->cp3->cellAttributes() ?>>
<span id="el_t_cp_cp3">
<textarea data-table="t_cp" data-field="x_cp3" name="x_cp3" id="x_cp3" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_cp_edit->cp3->getPlaceHolder()) ?>"<?php echo $t_cp_edit->cp3->editAttributes() ?>><?php echo $t_cp_edit->cp3->EditValue ?></textarea>
</span>
<?php echo $t_cp_edit->cp3->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="t_cp" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($t_cp_edit->id->CurrentValue) ?>">
<?php if (!$t_cp_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_cp_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_cp_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_cp_edit->showPageFooter();
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
$t_cp_edit->terminate();
?>