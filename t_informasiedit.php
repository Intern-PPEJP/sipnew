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
$t_informasi_edit = new t_informasi_edit();

// Run the page
$t_informasi_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_informasi_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_informasiedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_informasiedit = currentForm = new ew.Form("ft_informasiedit", "edit");

	// Validate form
	ft_informasiedit.validate = function() {
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
			<?php if ($t_informasi_edit->kdinformasi->Required) { ?>
				elm = this.getElements("x" + infix + "_kdinformasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_informasi_edit->kdinformasi->caption(), $t_informasi_edit->kdinformasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_informasi_edit->informasi->Required) { ?>
				elm = this.getElements("x" + infix + "_informasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_informasi_edit->informasi->caption(), $t_informasi_edit->informasi->RequiredErrorMessage)) ?>");
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
	ft_informasiedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_informasiedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_informasiedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_informasi_edit->showPageHeader(); ?>
<?php
$t_informasi_edit->showMessage();
?>
<form name="ft_informasiedit" id="ft_informasiedit" class="<?php echo $t_informasi_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_informasi">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_informasi_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_informasi_edit->kdinformasi->Visible) { // kdinformasi ?>
	<div id="r_kdinformasi" class="form-group row">
		<label id="elh_t_informasi_kdinformasi" class="<?php echo $t_informasi_edit->LeftColumnClass ?>"><?php echo $t_informasi_edit->kdinformasi->caption() ?><?php echo $t_informasi_edit->kdinformasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_informasi_edit->RightColumnClass ?>"><div <?php echo $t_informasi_edit->kdinformasi->cellAttributes() ?>>
<span id="el_t_informasi_kdinformasi">
<span<?php echo $t_informasi_edit->kdinformasi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_informasi_edit->kdinformasi->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_informasi" data-field="x_kdinformasi" name="x_kdinformasi" id="x_kdinformasi" value="<?php echo HtmlEncode($t_informasi_edit->kdinformasi->CurrentValue) ?>">
<?php echo $t_informasi_edit->kdinformasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_informasi_edit->informasi->Visible) { // informasi ?>
	<div id="r_informasi" class="form-group row">
		<label id="elh_t_informasi_informasi" for="x_informasi" class="<?php echo $t_informasi_edit->LeftColumnClass ?>"><?php echo $t_informasi_edit->informasi->caption() ?><?php echo $t_informasi_edit->informasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_informasi_edit->RightColumnClass ?>"><div <?php echo $t_informasi_edit->informasi->cellAttributes() ?>>
<span id="el_t_informasi_informasi">
<input type="text" data-table="t_informasi" data-field="x_informasi" name="x_informasi" id="x_informasi" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_informasi_edit->informasi->getPlaceHolder()) ?>" value="<?php echo $t_informasi_edit->informasi->EditValue ?>"<?php echo $t_informasi_edit->informasi->editAttributes() ?>>
</span>
<?php echo $t_informasi_edit->informasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_informasi_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_informasi_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_informasi_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_informasi_edit->showPageFooter();
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
$t_informasi_edit->terminate();
?>