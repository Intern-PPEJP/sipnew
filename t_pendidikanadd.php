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
$t_pendidikan_add = new t_pendidikan_add();

// Run the page
$t_pendidikan_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pendidikan_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_pendidikanadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_pendidikanadd = currentForm = new ew.Form("ft_pendidikanadd", "add");

	// Validate form
	ft_pendidikanadd.validate = function() {
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
			<?php if ($t_pendidikan_add->pendidikan->Required) { ?>
				elm = this.getElements("x" + infix + "_pendidikan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pendidikan_add->pendidikan->caption(), $t_pendidikan_add->pendidikan->RequiredErrorMessage)) ?>");
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
	ft_pendidikanadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_pendidikanadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_pendidikanadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_pendidikan_add->showPageHeader(); ?>
<?php
$t_pendidikan_add->showMessage();
?>
<form name="ft_pendidikanadd" id="ft_pendidikanadd" class="<?php echo $t_pendidikan_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_pendidikan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_pendidikan_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($t_pendidikan_add->pendidikan->Visible) { // pendidikan ?>
	<div id="r_pendidikan" class="form-group row">
		<label id="elh_t_pendidikan_pendidikan" for="x_pendidikan" class="<?php echo $t_pendidikan_add->LeftColumnClass ?>"><?php echo $t_pendidikan_add->pendidikan->caption() ?><?php echo $t_pendidikan_add->pendidikan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pendidikan_add->RightColumnClass ?>"><div <?php echo $t_pendidikan_add->pendidikan->cellAttributes() ?>>
<span id="el_t_pendidikan_pendidikan">
<input type="text" data-table="t_pendidikan" data-field="x_pendidikan" name="x_pendidikan" id="x_pendidikan" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($t_pendidikan_add->pendidikan->getPlaceHolder()) ?>" value="<?php echo $t_pendidikan_add->pendidikan->EditValue ?>"<?php echo $t_pendidikan_add->pendidikan->editAttributes() ?>>
</span>
<?php echo $t_pendidikan_add->pendidikan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_pendidikan_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_pendidikan_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_pendidikan_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_pendidikan_add->showPageFooter();
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
$t_pendidikan_add->terminate();
?>