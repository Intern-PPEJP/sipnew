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
$t_produknafed_add = new t_produknafed_add();

// Run the page
$t_produknafed_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_produknafed_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_produknafedadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_produknafedadd = currentForm = new ew.Form("ft_produknafedadd", "add");

	// Validate form
	ft_produknafedadd.validate = function() {
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
			<?php if ($t_produknafed_add->produknafed->Required) { ?>
				elm = this.getElements("x" + infix + "_produknafed");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_produknafed_add->produknafed->caption(), $t_produknafed_add->produknafed->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_produknafed_add->produknafedid->Required) { ?>
				elm = this.getElements("x" + infix + "_produknafedid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_produknafed_add->produknafedid->caption(), $t_produknafed_add->produknafedid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_produknafed_add->created_at->Required) { ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_produknafed_add->created_at->caption(), $t_produknafed_add->created_at->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_produknafed_add->user_created_by->Required) { ?>
				elm = this.getElements("x" + infix + "_user_created_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_produknafed_add->user_created_by->caption(), $t_produknafed_add->user_created_by->RequiredErrorMessage)) ?>");
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
	ft_produknafedadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_produknafedadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_produknafedadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_produknafed_add->showPageHeader(); ?>
<?php
$t_produknafed_add->showMessage();
?>
<form name="ft_produknafedadd" id="ft_produknafedadd" class="<?php echo $t_produknafed_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_produknafed">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_produknafed_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($t_produknafed_add->produknafed->Visible) { // produknafed ?>
	<div id="r_produknafed" class="form-group row">
		<label id="elh_t_produknafed_produknafed" for="x_produknafed" class="<?php echo $t_produknafed_add->LeftColumnClass ?>"><?php echo $t_produknafed_add->produknafed->caption() ?><?php echo $t_produknafed_add->produknafed->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_produknafed_add->RightColumnClass ?>"><div <?php echo $t_produknafed_add->produknafed->cellAttributes() ?>>
<span id="el_t_produknafed_produknafed">
<input type="text" data-table="t_produknafed" data-field="x_produknafed" name="x_produknafed" id="x_produknafed" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_produknafed_add->produknafed->getPlaceHolder()) ?>" value="<?php echo $t_produknafed_add->produknafed->EditValue ?>"<?php echo $t_produknafed_add->produknafed->editAttributes() ?>>
</span>
<?php echo $t_produknafed_add->produknafed->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_produknafed_add->produknafedid->Visible) { // produknafedid ?>
	<div id="r_produknafedid" class="form-group row">
		<label id="elh_t_produknafed_produknafedid" for="x_produknafedid" class="<?php echo $t_produknafed_add->LeftColumnClass ?>"><?php echo $t_produknafed_add->produknafedid->caption() ?><?php echo $t_produknafed_add->produknafedid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_produknafed_add->RightColumnClass ?>"><div <?php echo $t_produknafed_add->produknafedid->cellAttributes() ?>>
<span id="el_t_produknafed_produknafedid">
<input type="text" data-table="t_produknafed" data-field="x_produknafedid" name="x_produknafedid" id="x_produknafedid" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_produknafed_add->produknafedid->getPlaceHolder()) ?>" value="<?php echo $t_produknafed_add->produknafedid->EditValue ?>"<?php echo $t_produknafed_add->produknafedid->editAttributes() ?>>
</span>
<?php echo $t_produknafed_add->produknafedid->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_produknafed_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_produknafed_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_produknafed_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_produknafed_add->showPageFooter();
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
$t_produknafed_add->terminate();
?>