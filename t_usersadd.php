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
$t_users_add = new t_users_add();

// Run the page
$t_users_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_users_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_usersadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_usersadd = currentForm = new ew.Form("ft_usersadd", "add");

	// Validate form
	ft_usersadd.validate = function() {
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
			<?php if ($t_users_add->username->Required) { ?>
				elm = this.getElements("x" + infix + "_username");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_users_add->username->caption(), $t_users_add->username->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_users_add->pass->Required) { ?>
				elm = this.getElements("x" + infix + "_pass");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_users_add->pass->caption(), $t_users_add->pass->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_users_add->_userlevel->Required) { ?>
				elm = this.getElements("x" + infix + "__userlevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_users_add->_userlevel->caption(), $t_users_add->_userlevel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_users_add->aktif->Required) { ?>
				elm = this.getElements("x" + infix + "_aktif[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_users_add->aktif->caption(), $t_users_add->aktif->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_users_add->created_at->Required) { ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_users_add->created_at->caption(), $t_users_add->created_at->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_users_add->user_created_by->Required) { ?>
				elm = this.getElements("x" + infix + "_user_created_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_users_add->user_created_by->caption(), $t_users_add->user_created_by->RequiredErrorMessage)) ?>");
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
	ft_usersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_usersadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_usersadd.lists["x_username"] = <?php echo $t_users_add->username->Lookup->toClientList($t_users_add) ?>;
	ft_usersadd.lists["x_username"].options = <?php echo JsonEncode($t_users_add->username->lookupOptions()) ?>;
	ft_usersadd.autoSuggests["x_username"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_usersadd.lists["x__userlevel"] = <?php echo $t_users_add->_userlevel->Lookup->toClientList($t_users_add) ?>;
	ft_usersadd.lists["x__userlevel"].options = <?php echo JsonEncode($t_users_add->_userlevel->lookupOptions()) ?>;
	ft_usersadd.lists["x_aktif[]"] = <?php echo $t_users_add->aktif->Lookup->toClientList($t_users_add) ?>;
	ft_usersadd.lists["x_aktif[]"].options = <?php echo JsonEncode($t_users_add->aktif->options(FALSE, TRUE)) ?>;
	loadjs.done("ft_usersadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_users_add->showPageHeader(); ?>
<?php
$t_users_add->showMessage();
?>
<form name="ft_usersadd" id="ft_usersadd" class="<?php echo $t_users_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_users">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_users_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($t_users_add->username->Visible) { // username ?>
	<div id="r_username" class="form-group row">
		<label id="elh_t_users_username" class="<?php echo $t_users_add->LeftColumnClass ?>"><?php echo $t_users_add->username->caption() ?><?php echo $t_users_add->username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_users_add->RightColumnClass ?>"><div <?php echo $t_users_add->username->cellAttributes() ?>>
<span id="el_t_users_username">
<?php
$onchange = $t_users_add->username->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_users_add->username->EditAttrs["onchange"] = "";
?>
<span id="as_x_username">
	<input type="text" class="form-control" name="sv_x_username" id="sv_x_username" value="<?php echo RemoveHtml($t_users_add->username->EditValue) ?>" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($t_users_add->username->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_users_add->username->getPlaceHolder()) ?>"<?php echo $t_users_add->username->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_users" data-field="x_username" data-value-separator="<?php echo $t_users_add->username->displayValueSeparatorAttribute() ?>" name="x_username" id="x_username" value="<?php echo HtmlEncode($t_users_add->username->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_usersadd"], function() {
	ft_usersadd.createAutoSuggest({"id":"x_username","forceSelect":true,"minWidth":"500px","maxHeight":"600px"});
});
</script>
<?php echo $t_users_add->username->Lookup->getParamTag($t_users_add, "p_x_username") ?>
</span>
<?php echo $t_users_add->username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_users_add->pass->Visible) { // pass ?>
	<div id="r_pass" class="form-group row">
		<label id="elh_t_users_pass" for="x_pass" class="<?php echo $t_users_add->LeftColumnClass ?>"><?php echo $t_users_add->pass->caption() ?><?php echo $t_users_add->pass->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_users_add->RightColumnClass ?>"><div <?php echo $t_users_add->pass->cellAttributes() ?>>
<span id="el_t_users_pass">
<div class="input-group" id="ig_pass">
<input type="password" autocomplete="new-password" data-table="t_users" data-field="x_pass" name="x_pass" id="x_pass" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_users_add->pass->getPlaceHolder()) ?>"<?php echo $t_users_add->pass->editAttributes() ?>>
<div class="input-group-append">
	<button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button>
	<button type="button" class="btn btn-default ew-password-generator" title="<?php echo HtmlTitle($Language->phrase("GeneratePassword")) ?>" data-password-field="x_pass" data-password-confirm="c_pass"><?php echo $Language->phrase("GeneratePassword") ?></button>
</div>
</div>
</span>
<?php echo $t_users_add->pass->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_users_add->_userlevel->Visible) { // userlevel ?>
	<div id="r__userlevel" class="form-group row">
		<label id="elh_t_users__userlevel" for="x__userlevel" class="<?php echo $t_users_add->LeftColumnClass ?>"><?php echo $t_users_add->_userlevel->caption() ?><?php echo $t_users_add->_userlevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_users_add->RightColumnClass ?>"><div <?php echo $t_users_add->_userlevel->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_t_users__userlevel">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_users_add->_userlevel->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el_t_users__userlevel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_users" data-field="x__userlevel" data-value-separator="<?php echo $t_users_add->_userlevel->displayValueSeparatorAttribute() ?>" id="x__userlevel" name="x__userlevel"<?php echo $t_users_add->_userlevel->editAttributes() ?>>
			<?php echo $t_users_add->_userlevel->selectOptionListHtml("x__userlevel") ?>
		</select>
</div>
<?php echo $t_users_add->_userlevel->Lookup->getParamTag($t_users_add, "p_x__userlevel") ?>
</span>
<?php } ?>
<?php echo $t_users_add->_userlevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_users_add->aktif->Visible) { // aktif ?>
	<div id="r_aktif" class="form-group row">
		<label id="elh_t_users_aktif" class="<?php echo $t_users_add->LeftColumnClass ?>"><?php echo $t_users_add->aktif->caption() ?><?php echo $t_users_add->aktif->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_users_add->RightColumnClass ?>"><div <?php echo $t_users_add->aktif->cellAttributes() ?>>
<span id="el_t_users_aktif">
<?php
$selwrk = ConvertToBool($t_users_add->aktif->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="t_users" data-field="x_aktif" name="x_aktif[]" id="x_aktif[]_300657" value="1"<?php echo $selwrk ?><?php echo $t_users_add->aktif->editAttributes() ?>>
	<label class="custom-control-label" for="x_aktif[]_300657"></label>
</div>
</span>
<?php echo $t_users_add->aktif->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_users_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_users_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_users_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_users_add->showPageFooter();
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
$t_users_add->terminate();
?>