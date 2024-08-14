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
$t_lokasi_add = new t_lokasi_add();

// Run the page
$t_lokasi_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_lokasi_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_lokasiadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_lokasiadd = currentForm = new ew.Form("ft_lokasiadd", "add");

	// Validate form
	ft_lokasiadd.validate = function() {
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
			<?php if ($t_lokasi_add->kdlokasi->Required) { ?>
				elm = this.getElements("x" + infix + "_kdlokasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_lokasi_add->kdlokasi->caption(), $t_lokasi_add->kdlokasi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kdlokasi");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_lokasi_add->kdlokasi->errorMessage()) ?>");
			<?php if ($t_lokasi_add->lokasi->Required) { ?>
				elm = this.getElements("x" + infix + "_lokasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_lokasi_add->lokasi->caption(), $t_lokasi_add->lokasi->RequiredErrorMessage)) ?>");
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
	ft_lokasiadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_lokasiadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_lokasiadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_lokasi_add->showPageHeader(); ?>
<?php
$t_lokasi_add->showMessage();
?>
<form name="ft_lokasiadd" id="ft_lokasiadd" class="<?php echo $t_lokasi_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_lokasi">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_lokasi_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($t_lokasi_add->kdlokasi->Visible) { // kdlokasi ?>
	<div id="r_kdlokasi" class="form-group row">
		<label id="elh_t_lokasi_kdlokasi" for="x_kdlokasi" class="<?php echo $t_lokasi_add->LeftColumnClass ?>"><?php echo $t_lokasi_add->kdlokasi->caption() ?><?php echo $t_lokasi_add->kdlokasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_lokasi_add->RightColumnClass ?>"><div <?php echo $t_lokasi_add->kdlokasi->cellAttributes() ?>>
<span id="el_t_lokasi_kdlokasi">
<input type="text" data-table="t_lokasi" data-field="x_kdlokasi" name="x_kdlokasi" id="x_kdlokasi" size="30" placeholder="<?php echo HtmlEncode($t_lokasi_add->kdlokasi->getPlaceHolder()) ?>" value="<?php echo $t_lokasi_add->kdlokasi->EditValue ?>"<?php echo $t_lokasi_add->kdlokasi->editAttributes() ?>>
</span>
<?php echo $t_lokasi_add->kdlokasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_lokasi_add->lokasi->Visible) { // lokasi ?>
	<div id="r_lokasi" class="form-group row">
		<label id="elh_t_lokasi_lokasi" for="x_lokasi" class="<?php echo $t_lokasi_add->LeftColumnClass ?>"><?php echo $t_lokasi_add->lokasi->caption() ?><?php echo $t_lokasi_add->lokasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_lokasi_add->RightColumnClass ?>"><div <?php echo $t_lokasi_add->lokasi->cellAttributes() ?>>
<span id="el_t_lokasi_lokasi">
<input type="text" data-table="t_lokasi" data-field="x_lokasi" name="x_lokasi" id="x_lokasi" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($t_lokasi_add->lokasi->getPlaceHolder()) ?>" value="<?php echo $t_lokasi_add->lokasi->EditValue ?>"<?php echo $t_lokasi_add->lokasi->editAttributes() ?>>
</span>
<?php echo $t_lokasi_add->lokasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_lokasi_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_lokasi_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_lokasi_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_lokasi_add->showPageFooter();
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
$t_lokasi_add->terminate();
?>