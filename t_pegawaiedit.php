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
$t_pegawai_edit = new t_pegawai_edit();

// Run the page
$t_pegawai_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_pegawai_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_pegawaiedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_pegawaiedit = currentForm = new ew.Form("ft_pegawaiedit", "edit");

	// Validate form
	ft_pegawaiedit.validate = function() {
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
			<?php if ($t_pegawai_edit->nip->Required) { ?>
				elm = this.getElements("x" + infix + "_nip");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pegawai_edit->nip->caption(), $t_pegawai_edit->nip->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pegawai_edit->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pegawai_edit->nama->caption(), $t_pegawai_edit->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pegawai_edit->bagian->Required) { ?>
				elm = this.getElements("x" + infix + "_bagian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pegawai_edit->bagian->caption(), $t_pegawai_edit->bagian->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pegawai_edit->updated_at->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pegawai_edit->updated_at->caption(), $t_pegawai_edit->updated_at->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pegawai_edit->user_updated_by->Required) { ?>
				elm = this.getElements("x" + infix + "_user_updated_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pegawai_edit->user_updated_by->caption(), $t_pegawai_edit->user_updated_by->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_pegawai_edit->aktif->Required) { ?>
				elm = this.getElements("x" + infix + "_aktif[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_pegawai_edit->aktif->caption(), $t_pegawai_edit->aktif->RequiredErrorMessage)) ?>");
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
	ft_pegawaiedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_pegawaiedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_pegawaiedit.lists["x_bagian"] = <?php echo $t_pegawai_edit->bagian->Lookup->toClientList($t_pegawai_edit) ?>;
	ft_pegawaiedit.lists["x_bagian"].options = <?php echo JsonEncode($t_pegawai_edit->bagian->lookupOptions()) ?>;
	ft_pegawaiedit.lists["x_aktif[]"] = <?php echo $t_pegawai_edit->aktif->Lookup->toClientList($t_pegawai_edit) ?>;
	ft_pegawaiedit.lists["x_aktif[]"].options = <?php echo JsonEncode($t_pegawai_edit->aktif->options(FALSE, TRUE)) ?>;
	loadjs.done("ft_pegawaiedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_pegawai_edit->showPageHeader(); ?>
<?php
$t_pegawai_edit->showMessage();
?>
<form name="ft_pegawaiedit" id="ft_pegawaiedit" class="<?php echo $t_pegawai_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_pegawai">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_pegawai_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_pegawai_edit->nip->Visible) { // nip ?>
	<div id="r_nip" class="form-group row">
		<label id="elh_t_pegawai_nip" for="x_nip" class="<?php echo $t_pegawai_edit->LeftColumnClass ?>"><?php echo $t_pegawai_edit->nip->caption() ?><?php echo $t_pegawai_edit->nip->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pegawai_edit->RightColumnClass ?>"><div <?php echo $t_pegawai_edit->nip->cellAttributes() ?>>
<span id="el_t_pegawai_nip">
<span<?php echo $t_pegawai_edit->nip->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_pegawai_edit->nip->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_pegawai" data-field="x_nip" name="x_nip" id="x_nip" value="<?php echo HtmlEncode($t_pegawai_edit->nip->CurrentValue) ?>">
<?php echo $t_pegawai_edit->nip->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pegawai_edit->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_t_pegawai_nama" for="x_nama" class="<?php echo $t_pegawai_edit->LeftColumnClass ?>"><?php echo $t_pegawai_edit->nama->caption() ?><?php echo $t_pegawai_edit->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pegawai_edit->RightColumnClass ?>"><div <?php echo $t_pegawai_edit->nama->cellAttributes() ?>>
<span id="el_t_pegawai_nama">
<input type="text" data-table="t_pegawai" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_pegawai_edit->nama->getPlaceHolder()) ?>" value="<?php echo $t_pegawai_edit->nama->EditValue ?>"<?php echo $t_pegawai_edit->nama->editAttributes() ?>>
</span>
<?php echo $t_pegawai_edit->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pegawai_edit->bagian->Visible) { // bagian ?>
	<div id="r_bagian" class="form-group row">
		<label id="elh_t_pegawai_bagian" for="x_bagian" class="<?php echo $t_pegawai_edit->LeftColumnClass ?>"><?php echo $t_pegawai_edit->bagian->caption() ?><?php echo $t_pegawai_edit->bagian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pegawai_edit->RightColumnClass ?>"><div <?php echo $t_pegawai_edit->bagian->cellAttributes() ?>>
<span id="el_t_pegawai_bagian">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_pegawai" data-field="x_bagian" data-value-separator="<?php echo $t_pegawai_edit->bagian->displayValueSeparatorAttribute() ?>" id="x_bagian" name="x_bagian"<?php echo $t_pegawai_edit->bagian->editAttributes() ?>>
			<?php echo $t_pegawai_edit->bagian->selectOptionListHtml("x_bagian") ?>
		</select>
</div>
<?php echo $t_pegawai_edit->bagian->Lookup->getParamTag($t_pegawai_edit, "p_x_bagian") ?>
</span>
<?php echo $t_pegawai_edit->bagian->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_pegawai_edit->aktif->Visible) { // aktif ?>
	<div id="r_aktif" class="form-group row">
		<label id="elh_t_pegawai_aktif" class="<?php echo $t_pegawai_edit->LeftColumnClass ?>"><?php echo $t_pegawai_edit->aktif->caption() ?><?php echo $t_pegawai_edit->aktif->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_pegawai_edit->RightColumnClass ?>"><div <?php echo $t_pegawai_edit->aktif->cellAttributes() ?>>
<span id="el_t_pegawai_aktif">
<?php
$selwrk = ConvertToBool($t_pegawai_edit->aktif->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="t_pegawai" data-field="x_aktif" name="x_aktif[]" id="x_aktif[]_525630" value="1"<?php echo $selwrk ?><?php echo $t_pegawai_edit->aktif->editAttributes() ?>>
	<label class="custom-control-label" for="x_aktif[]_525630"></label>
</div>
</span>
<?php echo $t_pegawai_edit->aktif->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="t_pegawai" data-field="x_id_peg" name="x_id_peg" id="x_id_peg" value="<?php echo HtmlEncode($t_pegawai_edit->id_peg->CurrentValue) ?>">
<?php if (!$t_pegawai_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_pegawai_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_pegawai_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_pegawai_edit->showPageFooter();
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
$t_pegawai_edit->terminate();
?>