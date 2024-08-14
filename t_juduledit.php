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
$t_judul_edit = new t_judul_edit();

// Run the page
$t_judul_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_judul_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_juduledit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_juduledit = currentForm = new ew.Form("ft_juduledit", "edit");

	// Validate form
	ft_juduledit.validate = function() {
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
			<?php if ($t_judul_edit->kdjudul->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjudul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_judul_edit->kdjudul->caption(), $t_judul_edit->kdjudul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_judul_edit->kdbidang->Required) { ?>
				elm = this.getElements("x" + infix + "_kdbidang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_judul_edit->kdbidang->caption(), $t_judul_edit->kdbidang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_judul_edit->judul->Required) { ?>
				elm = this.getElements("x" + infix + "_judul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_judul_edit->judul->caption(), $t_judul_edit->judul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_judul_edit->singkatan->Required) { ?>
				elm = this.getElements("x" + infix + "_singkatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_judul_edit->singkatan->caption(), $t_judul_edit->singkatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_judul_edit->created_at->Required) { ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_judul_edit->created_at->caption(), $t_judul_edit->created_at->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_judul_edit->user_created_by->Required) { ?>
				elm = this.getElements("x" + infix + "_user_created_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_judul_edit->user_created_by->caption(), $t_judul_edit->user_created_by->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_judul_edit->updated_at->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_judul_edit->updated_at->caption(), $t_judul_edit->updated_at->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_judul_edit->user_updated_by->Required) { ?>
				elm = this.getElements("x" + infix + "_user_updated_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_judul_edit->user_updated_by->caption(), $t_judul_edit->user_updated_by->RequiredErrorMessage)) ?>");
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
	ft_juduledit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_juduledit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_juduledit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_judul_edit->showPageHeader(); ?>
<?php
$t_judul_edit->showMessage();
?>
<form name="ft_juduledit" id="ft_juduledit" class="<?php echo $t_judul_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_judul">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_judul_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_judul_edit->kdjudul->Visible) { // kdjudul ?>
	<div id="r_kdjudul" class="form-group row">
		<label id="elh_t_judul_kdjudul" for="x_kdjudul" class="<?php echo $t_judul_edit->LeftColumnClass ?>"><?php echo $t_judul_edit->kdjudul->caption() ?><?php echo $t_judul_edit->kdjudul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_judul_edit->RightColumnClass ?>"><div <?php echo $t_judul_edit->kdjudul->cellAttributes() ?>>
<span id="el_t_judul_kdjudul">
<span<?php echo $t_judul_edit->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_judul_edit->kdjudul->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_judul" data-field="x_kdjudul" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($t_judul_edit->kdjudul->CurrentValue) ?>">
<?php echo $t_judul_edit->kdjudul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_judul_edit->kdbidang->Visible) { // kdbidang ?>
	<div id="r_kdbidang" class="form-group row">
		<label id="elh_t_judul_kdbidang" for="x_kdbidang" class="<?php echo $t_judul_edit->LeftColumnClass ?>"><?php echo $t_judul_edit->kdbidang->caption() ?><?php echo $t_judul_edit->kdbidang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_judul_edit->RightColumnClass ?>"><div <?php echo $t_judul_edit->kdbidang->cellAttributes() ?>>
<span id="el_t_judul_kdbidang">
<span<?php echo $t_judul_edit->kdbidang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_judul_edit->kdbidang->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_judul" data-field="x_kdbidang" name="x_kdbidang" id="x_kdbidang" value="<?php echo HtmlEncode($t_judul_edit->kdbidang->CurrentValue) ?>">
<?php echo $t_judul_edit->kdbidang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_judul_edit->judul->Visible) { // judul ?>
	<div id="r_judul" class="form-group row">
		<label id="elh_t_judul_judul" for="x_judul" class="<?php echo $t_judul_edit->LeftColumnClass ?>"><?php echo $t_judul_edit->judul->caption() ?><?php echo $t_judul_edit->judul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_judul_edit->RightColumnClass ?>"><div <?php echo $t_judul_edit->judul->cellAttributes() ?>>
<span id="el_t_judul_judul">
<input type="text" data-table="t_judul" data-field="x_judul" name="x_judul" id="x_judul" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($t_judul_edit->judul->getPlaceHolder()) ?>" value="<?php echo $t_judul_edit->judul->EditValue ?>"<?php echo $t_judul_edit->judul->editAttributes() ?>>
</span>
<?php echo $t_judul_edit->judul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_judul_edit->singkatan->Visible) { // singkatan ?>
	<div id="r_singkatan" class="form-group row">
		<label id="elh_t_judul_singkatan" for="x_singkatan" class="<?php echo $t_judul_edit->LeftColumnClass ?>"><?php echo $t_judul_edit->singkatan->caption() ?><?php echo $t_judul_edit->singkatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_judul_edit->RightColumnClass ?>"><div <?php echo $t_judul_edit->singkatan->cellAttributes() ?>>
<span id="el_t_judul_singkatan">
<input type="text" data-table="t_judul" data-field="x_singkatan" name="x_singkatan" id="x_singkatan" size="5" maxlength="5" placeholder="<?php echo HtmlEncode($t_judul_edit->singkatan->getPlaceHolder()) ?>" value="<?php echo $t_judul_edit->singkatan->EditValue ?>"<?php echo $t_judul_edit->singkatan->editAttributes() ?>>
</span>
<?php echo $t_judul_edit->singkatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("t_juduldetail", explode(",", $t_judul->getCurrentDetailTable())) && $t_juduldetail->DetailEdit) {
?>
<?php if ($t_judul->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("t_juduldetail", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "t_juduldetailgrid.php" ?>
<?php } ?>
<?php if (!$t_judul_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_judul_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_judul_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_judul_edit->showPageFooter();
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
$t_judul_edit->terminate();
?>