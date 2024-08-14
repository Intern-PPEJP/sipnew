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
$t_jadwalwebinar_edit = new t_jadwalwebinar_edit();

// Run the page
$t_jadwalwebinar_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_jadwalwebinar_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_jadwalwebinaredit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_jadwalwebinaredit = currentForm = new ew.Form("ft_jadwalwebinaredit", "edit");

	// Validate form
	ft_jadwalwebinaredit.validate = function() {
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
			<?php if ($t_jadwalwebinar_edit->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_edit->tgl->caption(), $t_jadwalwebinar_edit->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalwebinar_edit->tgl->errorMessage()) ?>");
			<?php if ($t_jadwalwebinar_edit->jam->Required) { ?>
				elm = this.getElements("x" + infix + "_jam");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_edit->jam->caption(), $t_jadwalwebinar_edit->jam->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalwebinar_edit->jam->errorMessage()) ?>");
			<?php if ($t_jadwalwebinar_edit->jam_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_jam_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_edit->jam_akhir->caption(), $t_jadwalwebinar_edit->jam_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam_akhir");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalwebinar_edit->jam_akhir->errorMessage()) ?>");
			<?php if ($t_jadwalwebinar_edit->materi->Required) { ?>
				elm = this.getElements("x" + infix + "_materi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_edit->materi->caption(), $t_jadwalwebinar_edit->materi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalwebinar_edit->instruktur->Required) { ?>
				elm = this.getElements("x" + infix + "_instruktur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_edit->instruktur->caption(), $t_jadwalwebinar_edit->instruktur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_instruktur");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalwebinar_edit->instruktur->errorMessage()) ?>");
			<?php if ($t_jadwalwebinar_edit->instansi->Required) { ?>
				elm = this.getElements("x" + infix + "_instansi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_edit->instansi->caption(), $t_jadwalwebinar_edit->instansi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalwebinar_edit->ket->Required) { ?>
				elm = this.getElements("x" + infix + "_ket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_edit->ket->caption(), $t_jadwalwebinar_edit->ket->RequiredErrorMessage)) ?>");
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
	ft_jadwalwebinaredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_jadwalwebinaredit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_jadwalwebinaredit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_jadwalwebinar_edit->showPageHeader(); ?>
<?php
$t_jadwalwebinar_edit->showMessage();
?>
<form name="ft_jadwalwebinaredit" id="ft_jadwalwebinaredit" class="<?php echo $t_jadwalwebinar_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_jadwalwebinar">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_jadwalwebinar_edit->IsModal ?>">
<?php if ($t_jadwalwebinar->getCurrentMasterTable() == "webinar") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="webinar">
<input type="hidden" name="fk_rkwid" value="<?php echo HtmlEncode($t_jadwalwebinar_edit->idpelat->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_jadwalwebinar_edit->tgl->Visible) { // tgl ?>
	<div id="r_tgl" class="form-group row">
		<label id="elh_t_jadwalwebinar_tgl" for="x_tgl" class="<?php echo $t_jadwalwebinar_edit->LeftColumnClass ?>"><?php echo $t_jadwalwebinar_edit->tgl->caption() ?><?php echo $t_jadwalwebinar_edit->tgl->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalwebinar_edit->RightColumnClass ?>"><div <?php echo $t_jadwalwebinar_edit->tgl->cellAttributes() ?>>
<span id="el_t_jadwalwebinar_tgl">
<input type="text" data-table="t_jadwalwebinar" data-field="x_tgl" name="x_tgl" id="x_tgl" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_edit->tgl->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_edit->tgl->EditValue ?>"<?php echo $t_jadwalwebinar_edit->tgl->editAttributes() ?>>
<?php if (!$t_jadwalwebinar_edit->tgl->ReadOnly && !$t_jadwalwebinar_edit->tgl->Disabled && !isset($t_jadwalwebinar_edit->tgl->EditAttrs["readonly"]) && !isset($t_jadwalwebinar_edit->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalwebinaredit", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_jadwalwebinaredit", "x_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_jadwalwebinar_edit->tgl->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalwebinar_edit->jam->Visible) { // jam ?>
	<div id="r_jam" class="form-group row">
		<label id="elh_t_jadwalwebinar_jam" for="x_jam" class="<?php echo $t_jadwalwebinar_edit->LeftColumnClass ?>"><?php echo $t_jadwalwebinar_edit->jam->caption() ?><?php echo $t_jadwalwebinar_edit->jam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalwebinar_edit->RightColumnClass ?>"><div <?php echo $t_jadwalwebinar_edit->jam->cellAttributes() ?>>
<span id="el_t_jadwalwebinar_jam">
<input type="text" data-table="t_jadwalwebinar" data-field="x_jam" name="x_jam" id="x_jam" size="5" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_edit->jam->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_edit->jam->EditValue ?>"<?php echo $t_jadwalwebinar_edit->jam->editAttributes() ?>>
<?php if (!$t_jadwalwebinar_edit->jam->ReadOnly && !$t_jadwalwebinar_edit->jam->Disabled && !isset($t_jadwalwebinar_edit->jam->EditAttrs["readonly"]) && !isset($t_jadwalwebinar_edit->jam->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalwebinaredit", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalwebinaredit", "x_jam", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<?php echo $t_jadwalwebinar_edit->jam->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalwebinar_edit->jam_akhir->Visible) { // jam_akhir ?>
	<div id="r_jam_akhir" class="form-group row">
		<label id="elh_t_jadwalwebinar_jam_akhir" for="x_jam_akhir" class="<?php echo $t_jadwalwebinar_edit->LeftColumnClass ?>"><?php echo $t_jadwalwebinar_edit->jam_akhir->caption() ?><?php echo $t_jadwalwebinar_edit->jam_akhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalwebinar_edit->RightColumnClass ?>"><div <?php echo $t_jadwalwebinar_edit->jam_akhir->cellAttributes() ?>>
<span id="el_t_jadwalwebinar_jam_akhir">
<input type="text" data-table="t_jadwalwebinar" data-field="x_jam_akhir" name="x_jam_akhir" id="x_jam_akhir" size="5" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_edit->jam_akhir->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_edit->jam_akhir->EditValue ?>"<?php echo $t_jadwalwebinar_edit->jam_akhir->editAttributes() ?>>
<?php if (!$t_jadwalwebinar_edit->jam_akhir->ReadOnly && !$t_jadwalwebinar_edit->jam_akhir->Disabled && !isset($t_jadwalwebinar_edit->jam_akhir->EditAttrs["readonly"]) && !isset($t_jadwalwebinar_edit->jam_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalwebinaredit", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalwebinaredit", "x_jam_akhir", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<?php echo $t_jadwalwebinar_edit->jam_akhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalwebinar_edit->materi->Visible) { // materi ?>
	<div id="r_materi" class="form-group row">
		<label id="elh_t_jadwalwebinar_materi" for="x_materi" class="<?php echo $t_jadwalwebinar_edit->LeftColumnClass ?>"><?php echo $t_jadwalwebinar_edit->materi->caption() ?><?php echo $t_jadwalwebinar_edit->materi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalwebinar_edit->RightColumnClass ?>"><div <?php echo $t_jadwalwebinar_edit->materi->cellAttributes() ?>>
<span id="el_t_jadwalwebinar_materi">
<input type="text" data-table="t_jadwalwebinar" data-field="x_materi" name="x_materi" id="x_materi" size="50" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_edit->materi->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_edit->materi->EditValue ?>"<?php echo $t_jadwalwebinar_edit->materi->editAttributes() ?>>
</span>
<?php echo $t_jadwalwebinar_edit->materi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalwebinar_edit->instruktur->Visible) { // instruktur ?>
	<div id="r_instruktur" class="form-group row">
		<label id="elh_t_jadwalwebinar_instruktur" for="x_instruktur" class="<?php echo $t_jadwalwebinar_edit->LeftColumnClass ?>"><?php echo $t_jadwalwebinar_edit->instruktur->caption() ?><?php echo $t_jadwalwebinar_edit->instruktur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalwebinar_edit->RightColumnClass ?>"><div <?php echo $t_jadwalwebinar_edit->instruktur->cellAttributes() ?>>
<span id="el_t_jadwalwebinar_instruktur">
<input type="text" data-table="t_jadwalwebinar" data-field="x_instruktur" name="x_instruktur" id="x_instruktur" size="30" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_edit->instruktur->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_edit->instruktur->EditValue ?>"<?php echo $t_jadwalwebinar_edit->instruktur->editAttributes() ?>>
</span>
<?php echo $t_jadwalwebinar_edit->instruktur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalwebinar_edit->instansi->Visible) { // instansi ?>
	<div id="r_instansi" class="form-group row">
		<label id="elh_t_jadwalwebinar_instansi" for="x_instansi" class="<?php echo $t_jadwalwebinar_edit->LeftColumnClass ?>"><?php echo $t_jadwalwebinar_edit->instansi->caption() ?><?php echo $t_jadwalwebinar_edit->instansi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalwebinar_edit->RightColumnClass ?>"><div <?php echo $t_jadwalwebinar_edit->instansi->cellAttributes() ?>>
<span id="el_t_jadwalwebinar_instansi">
<input type="text" data-table="t_jadwalwebinar" data-field="x_instansi" name="x_instansi" id="x_instansi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_edit->instansi->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_edit->instansi->EditValue ?>"<?php echo $t_jadwalwebinar_edit->instansi->editAttributes() ?>>
</span>
<?php echo $t_jadwalwebinar_edit->instansi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalwebinar_edit->ket->Visible) { // ket ?>
	<div id="r_ket" class="form-group row">
		<label id="elh_t_jadwalwebinar_ket" for="x_ket" class="<?php echo $t_jadwalwebinar_edit->LeftColumnClass ?>"><?php echo $t_jadwalwebinar_edit->ket->caption() ?><?php echo $t_jadwalwebinar_edit->ket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalwebinar_edit->RightColumnClass ?>"><div <?php echo $t_jadwalwebinar_edit->ket->cellAttributes() ?>>
<span id="el_t_jadwalwebinar_ket">
<input type="text" data-table="t_jadwalwebinar" data-field="x_ket" name="x_ket" id="x_ket" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_edit->ket->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_edit->ket->EditValue ?>"<?php echo $t_jadwalwebinar_edit->ket->editAttributes() ?>>
</span>
<?php echo $t_jadwalwebinar_edit->ket->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="t_jadwalwebinar" data-field="x_idjadwal" name="x_idjadwal" id="x_idjadwal" value="<?php echo HtmlEncode($t_jadwalwebinar_edit->idjadwal->CurrentValue) ?>">
<?php if (!$t_jadwalwebinar_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_jadwalwebinar_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_jadwalwebinar_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_jadwalwebinar_edit->showPageFooter();
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
$t_jadwalwebinar_edit->terminate();
?>