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
$t_area_add = new t_area_add();

// Run the page
$t_area_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_area_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_areaadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_areaadd = currentForm = new ew.Form("ft_areaadd", "add");

	// Validate form
	ft_areaadd.validate = function() {
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
			<?php if ($t_area_add->area->Required) { ?>
				elm = this.getElements("x" + infix + "_area");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_area_add->area->caption(), $t_area_add->area->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_area_add->ket->Required) { ?>
				elm = this.getElements("x" + infix + "_ket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_area_add->ket->caption(), $t_area_add->ket->RequiredErrorMessage)) ?>");
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
	ft_areaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_areaadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_areaadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_area_add->showPageHeader(); ?>
<?php
$t_area_add->showMessage();
?>
<form name="ft_areaadd" id="ft_areaadd" class="<?php echo $t_area_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_area">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_area_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($t_area_add->area->Visible) { // area ?>
	<div id="r_area" class="form-group row">
		<label id="elh_t_area_area" for="x_area" class="<?php echo $t_area_add->LeftColumnClass ?>"><?php echo $t_area_add->area->caption() ?><?php echo $t_area_add->area->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_area_add->RightColumnClass ?>"><div <?php echo $t_area_add->area->cellAttributes() ?>>
<span id="el_t_area_area">
<input type="text" data-table="t_area" data-field="x_area" name="x_area" id="x_area" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_area_add->area->getPlaceHolder()) ?>" value="<?php echo $t_area_add->area->EditValue ?>"<?php echo $t_area_add->area->editAttributes() ?>>
</span>
<?php echo $t_area_add->area->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_area_add->ket->Visible) { // ket ?>
	<div id="r_ket" class="form-group row">
		<label id="elh_t_area_ket" for="x_ket" class="<?php echo $t_area_add->LeftColumnClass ?>"><?php echo $t_area_add->ket->caption() ?><?php echo $t_area_add->ket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_area_add->RightColumnClass ?>"><div <?php echo $t_area_add->ket->cellAttributes() ?>>
<span id="el_t_area_ket">
<input type="text" data-table="t_area" data-field="x_ket" name="x_ket" id="x_ket" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_area_add->ket->getPlaceHolder()) ?>" value="<?php echo $t_area_add->ket->EditValue ?>"<?php echo $t_area_add->ket->editAttributes() ?>>
</span>
<?php echo $t_area_add->ket->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_area_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_area_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_area_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_area_add->showPageFooter();
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
$t_area_add->terminate();
?>