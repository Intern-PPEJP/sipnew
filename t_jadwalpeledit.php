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
$t_jadwalpel_edit = new t_jadwalpel_edit();

// Run the page
$t_jadwalpel_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_jadwalpel_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_jadwalpeledit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_jadwalpeledit = currentForm = new ew.Form("ft_jadwalpeledit", "edit");

	// Validate form
	ft_jadwalpeledit.validate = function() {
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
			<?php if ($t_jadwalpel_edit->idpelat->Required) { ?>
				elm = this.getElements("x" + infix + "_idpelat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_edit->idpelat->caption(), $t_jadwalpel_edit->idpelat->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_idpelat");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalpel_edit->idpelat->errorMessage()) ?>");
			<?php if ($t_jadwalpel_edit->kdjudul->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjudul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_edit->kdjudul->caption(), $t_jadwalpel_edit->kdjudul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalpel_edit->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_edit->tgl->caption(), $t_jadwalpel_edit->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalpel_edit->tgl->errorMessage()) ?>");
			<?php if ($t_jadwalpel_edit->jam->Required) { ?>
				elm = this.getElements("x" + infix + "_jam");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_edit->jam->caption(), $t_jadwalpel_edit->jam->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalpel_edit->jam->errorMessage()) ?>");
			<?php if ($t_jadwalpel_edit->jam_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_jam_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_edit->jam_akhir->caption(), $t_jadwalpel_edit->jam_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam_akhir");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalpel_edit->jam_akhir->errorMessage()) ?>");
			<?php if ($t_jadwalpel_edit->materi->Required) { ?>
				elm = this.getElements("x" + infix + "_materi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_edit->materi->caption(), $t_jadwalpel_edit->materi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalpel_edit->instruktur->Required) { ?>
				elm = this.getElements("x" + infix + "_instruktur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_edit->instruktur->caption(), $t_jadwalpel_edit->instruktur->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalpel_edit->instansi->Required) { ?>
				elm = this.getElements("x" + infix + "_instansi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_edit->instansi->caption(), $t_jadwalpel_edit->instansi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalpel_edit->ket->Required) { ?>
				elm = this.getElements("x" + infix + "_ket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalpel_edit->ket->caption(), $t_jadwalpel_edit->ket->RequiredErrorMessage)) ?>");
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
	ft_jadwalpeledit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_jadwalpeledit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_jadwalpeledit.lists["x_kdjudul"] = <?php echo $t_jadwalpel_edit->kdjudul->Lookup->toClientList($t_jadwalpel_edit) ?>;
	ft_jadwalpeledit.lists["x_kdjudul"].options = <?php echo JsonEncode($t_jadwalpel_edit->kdjudul->lookupOptions()) ?>;
	ft_jadwalpeledit.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_jadwalpeledit.lists["x_materi"] = <?php echo $t_jadwalpel_edit->materi->Lookup->toClientList($t_jadwalpel_edit) ?>;
	ft_jadwalpeledit.lists["x_materi"].options = <?php echo JsonEncode($t_jadwalpel_edit->materi->lookupOptions()) ?>;
	ft_jadwalpeledit.lists["x_instruktur"] = <?php echo $t_jadwalpel_edit->instruktur->Lookup->toClientList($t_jadwalpel_edit) ?>;
	ft_jadwalpeledit.lists["x_instruktur"].options = <?php echo JsonEncode($t_jadwalpel_edit->instruktur->lookupOptions()) ?>;
	loadjs.done("ft_jadwalpeledit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_jadwalpel_edit->showPageHeader(); ?>
<?php
$t_jadwalpel_edit->showMessage();
?>
<form name="ft_jadwalpeledit" id="ft_jadwalpeledit" class="<?php echo $t_jadwalpel_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_jadwalpel">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_jadwalpel_edit->IsModal ?>">
<?php if ($t_jadwalpel->getCurrentMasterTable() == "t_pelatihan") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_pelatihan">
<input type="hidden" name="fk_idpelat" value="<?php echo HtmlEncode($t_jadwalpel_edit->idpelat->getSessionValue()) ?>">
<input type="hidden" name="fk_kdjudul" value="<?php echo HtmlEncode($t_jadwalpel_edit->kdjudul->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_jadwalpel_edit->idpelat->Visible) { // idpelat ?>
	<div id="r_idpelat" class="form-group row">
		<label id="elh_t_jadwalpel_idpelat" for="x_idpelat" class="<?php echo $t_jadwalpel_edit->LeftColumnClass ?>"><?php echo $t_jadwalpel_edit->idpelat->caption() ?><?php echo $t_jadwalpel_edit->idpelat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalpel_edit->RightColumnClass ?>"><div <?php echo $t_jadwalpel_edit->idpelat->cellAttributes() ?>>
<?php if ($t_jadwalpel_edit->idpelat->getSessionValue() != "") { ?>
<span id="el_t_jadwalpel_idpelat">
<span<?php echo $t_jadwalpel_edit->idpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_jadwalpel_edit->idpelat->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_idpelat" name="x_idpelat" value="<?php echo HtmlEncode($t_jadwalpel_edit->idpelat->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_jadwalpel_idpelat">
<input type="text" data-table="t_jadwalpel" data-field="x_idpelat" name="x_idpelat" id="x_idpelat" size="30" placeholder="<?php echo HtmlEncode($t_jadwalpel_edit->idpelat->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_edit->idpelat->EditValue ?>"<?php echo $t_jadwalpel_edit->idpelat->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $t_jadwalpel_edit->idpelat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalpel_edit->kdjudul->Visible) { // kdjudul ?>
	<div id="r_kdjudul" class="form-group row">
		<label id="elh_t_jadwalpel_kdjudul" class="<?php echo $t_jadwalpel_edit->LeftColumnClass ?>"><?php echo $t_jadwalpel_edit->kdjudul->caption() ?><?php echo $t_jadwalpel_edit->kdjudul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalpel_edit->RightColumnClass ?>"><div <?php echo $t_jadwalpel_edit->kdjudul->cellAttributes() ?>>
<?php if ($t_jadwalpel_edit->kdjudul->getSessionValue() != "") { ?>
<span id="el_t_jadwalpel_kdjudul">
<span<?php echo $t_jadwalpel_edit->kdjudul->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_jadwalpel_edit->kdjudul->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_kdjudul" name="x_kdjudul" value="<?php echo HtmlEncode($t_jadwalpel_edit->kdjudul->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_jadwalpel_kdjudul">
<?php
$onchange = $t_jadwalpel_edit->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_jadwalpel_edit->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($t_jadwalpel_edit->kdjudul->EditValue) ?>" size="30" maxlength="9" placeholder="<?php echo HtmlEncode($t_jadwalpel_edit->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_jadwalpel_edit->kdjudul->getPlaceHolder()) ?>"<?php echo $t_jadwalpel_edit->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalpel" data-field="x_kdjudul" data-value-separator="<?php echo $t_jadwalpel_edit->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($t_jadwalpel_edit->kdjudul->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_jadwalpeledit"], function() {
	ft_jadwalpeledit.createAutoSuggest({"id":"x_kdjudul","forceSelect":false});
});
</script>
<?php echo $t_jadwalpel_edit->kdjudul->Lookup->getParamTag($t_jadwalpel_edit, "p_x_kdjudul") ?>
</span>
<?php } ?>
<?php echo $t_jadwalpel_edit->kdjudul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalpel_edit->tgl->Visible) { // tgl ?>
	<div id="r_tgl" class="form-group row">
		<label id="elh_t_jadwalpel_tgl" for="x_tgl" class="<?php echo $t_jadwalpel_edit->LeftColumnClass ?>"><?php echo $t_jadwalpel_edit->tgl->caption() ?><?php echo $t_jadwalpel_edit->tgl->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalpel_edit->RightColumnClass ?>"><div <?php echo $t_jadwalpel_edit->tgl->cellAttributes() ?>>
<span id="el_t_jadwalpel_tgl">
<input type="text" data-table="t_jadwalpel" data-field="x_tgl" name="x_tgl" id="x_tgl" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_jadwalpel_edit->tgl->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_edit->tgl->EditValue ?>"<?php echo $t_jadwalpel_edit->tgl->editAttributes() ?>>
<?php if (!$t_jadwalpel_edit->tgl->ReadOnly && !$t_jadwalpel_edit->tgl->Disabled && !isset($t_jadwalpel_edit->tgl->EditAttrs["readonly"]) && !isset($t_jadwalpel_edit->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpeledit", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_jadwalpeledit", "x_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_jadwalpel_edit->tgl->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalpel_edit->jam->Visible) { // jam ?>
	<div id="r_jam" class="form-group row">
		<label id="elh_t_jadwalpel_jam" for="x_jam" class="<?php echo $t_jadwalpel_edit->LeftColumnClass ?>"><?php echo $t_jadwalpel_edit->jam->caption() ?><?php echo $t_jadwalpel_edit->jam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalpel_edit->RightColumnClass ?>"><div <?php echo $t_jadwalpel_edit->jam->cellAttributes() ?>>
<span id="el_t_jadwalpel_jam">
<input type="text" data-table="t_jadwalpel" data-field="x_jam" name="x_jam" id="x_jam" size="5" placeholder="<?php echo HtmlEncode($t_jadwalpel_edit->jam->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_edit->jam->EditValue ?>"<?php echo $t_jadwalpel_edit->jam->editAttributes() ?>>
<?php if (!$t_jadwalpel_edit->jam->ReadOnly && !$t_jadwalpel_edit->jam->Disabled && !isset($t_jadwalpel_edit->jam->EditAttrs["readonly"]) && !isset($t_jadwalpel_edit->jam->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpeledit", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalpeledit", "x_jam", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<?php echo $t_jadwalpel_edit->jam->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalpel_edit->jam_akhir->Visible) { // jam_akhir ?>
	<div id="r_jam_akhir" class="form-group row">
		<label id="elh_t_jadwalpel_jam_akhir" for="x_jam_akhir" class="<?php echo $t_jadwalpel_edit->LeftColumnClass ?>"><?php echo $t_jadwalpel_edit->jam_akhir->caption() ?><?php echo $t_jadwalpel_edit->jam_akhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalpel_edit->RightColumnClass ?>"><div <?php echo $t_jadwalpel_edit->jam_akhir->cellAttributes() ?>>
<span id="el_t_jadwalpel_jam_akhir">
<input type="text" data-table="t_jadwalpel" data-field="x_jam_akhir" name="x_jam_akhir" id="x_jam_akhir" size="5" placeholder="<?php echo HtmlEncode($t_jadwalpel_edit->jam_akhir->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_edit->jam_akhir->EditValue ?>"<?php echo $t_jadwalpel_edit->jam_akhir->editAttributes() ?>>
<?php if (!$t_jadwalpel_edit->jam_akhir->ReadOnly && !$t_jadwalpel_edit->jam_akhir->Disabled && !isset($t_jadwalpel_edit->jam_akhir->EditAttrs["readonly"]) && !isset($t_jadwalpel_edit->jam_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalpeledit", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalpeledit", "x_jam_akhir", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<?php echo $t_jadwalpel_edit->jam_akhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalpel_edit->materi->Visible) { // materi ?>
	<div id="r_materi" class="form-group row">
		<label id="elh_t_jadwalpel_materi" for="x_materi" class="<?php echo $t_jadwalpel_edit->LeftColumnClass ?>"><?php echo $t_jadwalpel_edit->materi->caption() ?><?php echo $t_jadwalpel_edit->materi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalpel_edit->RightColumnClass ?>"><div <?php echo $t_jadwalpel_edit->materi->cellAttributes() ?>>
<span id="el_t_jadwalpel_materi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_jadwalpel" data-field="x_materi" data-value-separator="<?php echo $t_jadwalpel_edit->materi->displayValueSeparatorAttribute() ?>" id="x_materi" name="x_materi"<?php echo $t_jadwalpel_edit->materi->editAttributes() ?>>
			<?php echo $t_jadwalpel_edit->materi->selectOptionListHtml("x_materi") ?>
		</select>
</div>
<?php echo $t_jadwalpel_edit->materi->Lookup->getParamTag($t_jadwalpel_edit, "p_x_materi") ?>
</span>
<?php echo $t_jadwalpel_edit->materi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalpel_edit->instruktur->Visible) { // instruktur ?>
	<div id="r_instruktur" class="form-group row">
		<label id="elh_t_jadwalpel_instruktur" for="x_instruktur" class="<?php echo $t_jadwalpel_edit->LeftColumnClass ?>"><?php echo $t_jadwalpel_edit->instruktur->caption() ?><?php echo $t_jadwalpel_edit->instruktur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalpel_edit->RightColumnClass ?>"><div <?php echo $t_jadwalpel_edit->instruktur->cellAttributes() ?>>
<span id="el_t_jadwalpel_instruktur">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_jadwalpel" data-field="x_instruktur" data-value-separator="<?php echo $t_jadwalpel_edit->instruktur->displayValueSeparatorAttribute() ?>" id="x_instruktur" name="x_instruktur"<?php echo $t_jadwalpel_edit->instruktur->editAttributes() ?>>
			<?php echo $t_jadwalpel_edit->instruktur->selectOptionListHtml("x_instruktur") ?>
		</select>
</div>
<?php echo $t_jadwalpel_edit->instruktur->Lookup->getParamTag($t_jadwalpel_edit, "p_x_instruktur") ?>
</span>
<?php echo $t_jadwalpel_edit->instruktur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalpel_edit->instansi->Visible) { // instansi ?>
	<div id="r_instansi" class="form-group row">
		<label id="elh_t_jadwalpel_instansi" for="x_instansi" class="<?php echo $t_jadwalpel_edit->LeftColumnClass ?>"><?php echo $t_jadwalpel_edit->instansi->caption() ?><?php echo $t_jadwalpel_edit->instansi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalpel_edit->RightColumnClass ?>"><div <?php echo $t_jadwalpel_edit->instansi->cellAttributes() ?>>
<span id="el_t_jadwalpel_instansi">
<input type="text" data-table="t_jadwalpel" data-field="x_instansi" name="x_instansi" id="x_instansi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_jadwalpel_edit->instansi->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_edit->instansi->EditValue ?>"<?php echo $t_jadwalpel_edit->instansi->editAttributes() ?>>
</span>
<?php echo $t_jadwalpel_edit->instansi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalpel_edit->ket->Visible) { // ket ?>
	<div id="r_ket" class="form-group row">
		<label id="elh_t_jadwalpel_ket" for="x_ket" class="<?php echo $t_jadwalpel_edit->LeftColumnClass ?>"><?php echo $t_jadwalpel_edit->ket->caption() ?><?php echo $t_jadwalpel_edit->ket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalpel_edit->RightColumnClass ?>"><div <?php echo $t_jadwalpel_edit->ket->cellAttributes() ?>>
<span id="el_t_jadwalpel_ket">
<input type="text" data-table="t_jadwalpel" data-field="x_ket" name="x_ket" id="x_ket" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_jadwalpel_edit->ket->getPlaceHolder()) ?>" value="<?php echo $t_jadwalpel_edit->ket->EditValue ?>"<?php echo $t_jadwalpel_edit->ket->editAttributes() ?>>
</span>
<?php echo $t_jadwalpel_edit->ket->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="t_jadwalpel" data-field="x_idjadwal" name="x_idjadwal" id="x_idjadwal" value="<?php echo HtmlEncode($t_jadwalpel_edit->idjadwal->CurrentValue) ?>">
<?php if (!$t_jadwalpel_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_jadwalpel_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_jadwalpel_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_jadwalpel_edit->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$("#idpelat").hide();
});
</script>
<?php include_once "footer.php"; ?>
<?php
$t_jadwalpel_edit->terminate();
?>