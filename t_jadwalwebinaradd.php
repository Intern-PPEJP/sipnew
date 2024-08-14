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
$t_jadwalwebinar_add = new t_jadwalwebinar_add();

// Run the page
$t_jadwalwebinar_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_jadwalwebinar_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_jadwalwebinaradd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_jadwalwebinaradd = currentForm = new ew.Form("ft_jadwalwebinaradd", "add");

	// Validate form
	ft_jadwalwebinaradd.validate = function() {
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
			<?php if ($t_jadwalwebinar_add->idpelat->Required) { ?>
				elm = this.getElements("x" + infix + "_idpelat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_add->idpelat->caption(), $t_jadwalwebinar_add->idpelat->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_idpelat");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalwebinar_add->idpelat->errorMessage()) ?>");
			<?php if ($t_jadwalwebinar_add->kdjudul->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjudul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_add->kdjudul->caption(), $t_jadwalwebinar_add->kdjudul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalwebinar_add->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_add->tgl->caption(), $t_jadwalwebinar_add->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalwebinar_add->tgl->errorMessage()) ?>");
			<?php if ($t_jadwalwebinar_add->jam->Required) { ?>
				elm = this.getElements("x" + infix + "_jam");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_add->jam->caption(), $t_jadwalwebinar_add->jam->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalwebinar_add->jam->errorMessage()) ?>");
			<?php if ($t_jadwalwebinar_add->jam_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_jam_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_add->jam_akhir->caption(), $t_jadwalwebinar_add->jam_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam_akhir");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalwebinar_add->jam_akhir->errorMessage()) ?>");
			<?php if ($t_jadwalwebinar_add->materi->Required) { ?>
				elm = this.getElements("x" + infix + "_materi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_add->materi->caption(), $t_jadwalwebinar_add->materi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalwebinar_add->instruktur->Required) { ?>
				elm = this.getElements("x" + infix + "_instruktur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_add->instruktur->caption(), $t_jadwalwebinar_add->instruktur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_instruktur");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_jadwalwebinar_add->instruktur->errorMessage()) ?>");
			<?php if ($t_jadwalwebinar_add->instansi->Required) { ?>
				elm = this.getElements("x" + infix + "_instansi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_add->instansi->caption(), $t_jadwalwebinar_add->instansi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_jadwalwebinar_add->ket->Required) { ?>
				elm = this.getElements("x" + infix + "_ket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_jadwalwebinar_add->ket->caption(), $t_jadwalwebinar_add->ket->RequiredErrorMessage)) ?>");
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
	ft_jadwalwebinaradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_jadwalwebinaradd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Multi-Page
	ft_jadwalwebinaradd.multiPage = new ew.MultiPage("ft_jadwalwebinaradd");

	// Dynamic selection lists
	ft_jadwalwebinaradd.lists["x_kdjudul"] = <?php echo $t_jadwalwebinar_add->kdjudul->Lookup->toClientList($t_jadwalwebinar_add) ?>;
	ft_jadwalwebinaradd.lists["x_kdjudul"].options = <?php echo JsonEncode($t_jadwalwebinar_add->kdjudul->lookupOptions()) ?>;
	ft_jadwalwebinaradd.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("ft_jadwalwebinaradd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_jadwalwebinar_add->showPageHeader(); ?>
<?php
$t_jadwalwebinar_add->showMessage();
?>
<form name="ft_jadwalwebinaradd" id="ft_jadwalwebinaradd" class="<?php echo $t_jadwalwebinar_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_jadwalwebinar">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_jadwalwebinar_add->IsModal ?>">
<?php if ($t_jadwalwebinar->getCurrentMasterTable() == "webinar") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="webinar">
<input type="hidden" name="fk_rkwid" value="<?php echo HtmlEncode($t_jadwalwebinar_add->idpelat->getSessionValue()) ?>">
<?php } ?>
<div class="ew-multi-page"><!-- multi-page -->
<div class="ew-nav-tabs" id="t_jadwalwebinar_add"><!-- multi-page tabs -->
	<ul class="<?php echo $t_jadwalwebinar_add->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $t_jadwalwebinar_add->MultiPages->pageStyle(1) ?>" href="#tab_t_jadwalwebinar1" data-toggle="tab"><?php echo $t_jadwalwebinar->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $t_jadwalwebinar_add->MultiPages->pageStyle(2) ?>" href="#tab_t_jadwalwebinar2" data-toggle="tab"><?php echo $t_jadwalwebinar->pageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page tabs .tab-content -->
		<div class="tab-pane<?php echo $t_jadwalwebinar_add->MultiPages->pageStyle(1) ?>" id="tab_t_jadwalwebinar1"><!-- multi-page .tab-pane -->
<div class="ew-add-div"><!-- page* -->
<?php if ($t_jadwalwebinar_add->idpelat->Visible) { // idpelat ?>
	<div id="r_idpelat" class="form-group row">
		<label id="elh_t_jadwalwebinar_idpelat" for="x_idpelat" class="<?php echo $t_jadwalwebinar_add->LeftColumnClass ?>"><?php echo $t_jadwalwebinar_add->idpelat->caption() ?><?php echo $t_jadwalwebinar_add->idpelat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalwebinar_add->RightColumnClass ?>"><div <?php echo $t_jadwalwebinar_add->idpelat->cellAttributes() ?>>
<?php if ($t_jadwalwebinar_add->idpelat->getSessionValue() != "") { ?>
<span id="el_t_jadwalwebinar_idpelat">
<span<?php echo $t_jadwalwebinar_add->idpelat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_jadwalwebinar_add->idpelat->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_idpelat" name="x_idpelat" value="<?php echo HtmlEncode($t_jadwalwebinar_add->idpelat->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_jadwalwebinar_idpelat">
<input type="text" data-table="t_jadwalwebinar" data-field="x_idpelat" data-page="1" name="x_idpelat" id="x_idpelat" size="30" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_add->idpelat->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_add->idpelat->EditValue ?>"<?php echo $t_jadwalwebinar_add->idpelat->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $t_jadwalwebinar_add->idpelat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalwebinar_add->kdjudul->Visible) { // kdjudul ?>
	<div id="r_kdjudul" class="form-group row">
		<label id="elh_t_jadwalwebinar_kdjudul" class="<?php echo $t_jadwalwebinar_add->LeftColumnClass ?>"><?php echo $t_jadwalwebinar_add->kdjudul->caption() ?><?php echo $t_jadwalwebinar_add->kdjudul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalwebinar_add->RightColumnClass ?>"><div <?php echo $t_jadwalwebinar_add->kdjudul->cellAttributes() ?>>
<span id="el_t_jadwalwebinar_kdjudul">
<?php
$onchange = $t_jadwalwebinar_add->kdjudul->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_jadwalwebinar_add->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($t_jadwalwebinar_add->kdjudul->EditValue) ?>" size="30" maxlength="9" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_add->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_jadwalwebinar_add->kdjudul->getPlaceHolder()) ?>"<?php echo $t_jadwalwebinar_add->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_jadwalwebinar" data-field="x_kdjudul" data-page="1" data-value-separator="<?php echo $t_jadwalwebinar_add->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($t_jadwalwebinar_add->kdjudul->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_jadwalwebinaradd"], function() {
	ft_jadwalwebinaradd.createAutoSuggest({"id":"x_kdjudul","forceSelect":false});
});
</script>
<?php echo $t_jadwalwebinar_add->kdjudul->Lookup->getParamTag($t_jadwalwebinar_add, "p_x_kdjudul") ?>
</span>
<?php echo $t_jadwalwebinar_add->kdjudul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalwebinar_add->tgl->Visible) { // tgl ?>
	<div id="r_tgl" class="form-group row">
		<label id="elh_t_jadwalwebinar_tgl" for="x_tgl" class="<?php echo $t_jadwalwebinar_add->LeftColumnClass ?>"><?php echo $t_jadwalwebinar_add->tgl->caption() ?><?php echo $t_jadwalwebinar_add->tgl->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalwebinar_add->RightColumnClass ?>"><div <?php echo $t_jadwalwebinar_add->tgl->cellAttributes() ?>>
<span id="el_t_jadwalwebinar_tgl">
<input type="text" data-table="t_jadwalwebinar" data-field="x_tgl" data-page="1" name="x_tgl" id="x_tgl" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_add->tgl->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_add->tgl->EditValue ?>"<?php echo $t_jadwalwebinar_add->tgl->editAttributes() ?>>
<?php if (!$t_jadwalwebinar_add->tgl->ReadOnly && !$t_jadwalwebinar_add->tgl->Disabled && !isset($t_jadwalwebinar_add->tgl->EditAttrs["readonly"]) && !isset($t_jadwalwebinar_add->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalwebinaradd", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_jadwalwebinaradd", "x_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $t_jadwalwebinar_add->tgl->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalwebinar_add->jam->Visible) { // jam ?>
	<div id="r_jam" class="form-group row">
		<label id="elh_t_jadwalwebinar_jam" for="x_jam" class="<?php echo $t_jadwalwebinar_add->LeftColumnClass ?>"><?php echo $t_jadwalwebinar_add->jam->caption() ?><?php echo $t_jadwalwebinar_add->jam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalwebinar_add->RightColumnClass ?>"><div <?php echo $t_jadwalwebinar_add->jam->cellAttributes() ?>>
<span id="el_t_jadwalwebinar_jam">
<input type="text" data-table="t_jadwalwebinar" data-field="x_jam" data-page="1" name="x_jam" id="x_jam" size="5" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_add->jam->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_add->jam->EditValue ?>"<?php echo $t_jadwalwebinar_add->jam->editAttributes() ?>>
<?php if (!$t_jadwalwebinar_add->jam->ReadOnly && !$t_jadwalwebinar_add->jam->Disabled && !isset($t_jadwalwebinar_add->jam->EditAttrs["readonly"]) && !isset($t_jadwalwebinar_add->jam->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalwebinaradd", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalwebinaradd", "x_jam", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<?php echo $t_jadwalwebinar_add->jam->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalwebinar_add->jam_akhir->Visible) { // jam_akhir ?>
	<div id="r_jam_akhir" class="form-group row">
		<label id="elh_t_jadwalwebinar_jam_akhir" for="x_jam_akhir" class="<?php echo $t_jadwalwebinar_add->LeftColumnClass ?>"><?php echo $t_jadwalwebinar_add->jam_akhir->caption() ?><?php echo $t_jadwalwebinar_add->jam_akhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalwebinar_add->RightColumnClass ?>"><div <?php echo $t_jadwalwebinar_add->jam_akhir->cellAttributes() ?>>
<span id="el_t_jadwalwebinar_jam_akhir">
<input type="text" data-table="t_jadwalwebinar" data-field="x_jam_akhir" data-page="1" name="x_jam_akhir" id="x_jam_akhir" size="5" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_add->jam_akhir->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_add->jam_akhir->EditValue ?>"<?php echo $t_jadwalwebinar_add->jam_akhir->editAttributes() ?>>
<?php if (!$t_jadwalwebinar_add->jam_akhir->ReadOnly && !$t_jadwalwebinar_add->jam_akhir->Disabled && !isset($t_jadwalwebinar_add->jam_akhir->EditAttrs["readonly"]) && !isset($t_jadwalwebinar_add->jam_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_jadwalwebinaradd", "timepicker"], function() {
	ew.createTimePicker("ft_jadwalwebinaradd", "x_jam_akhir", {"timeFormat":"H" + ew.TIME_SEPARATOR + "i","step":5});
});
</script>
<?php } ?>
</span>
<?php echo $t_jadwalwebinar_add->jam_akhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalwebinar_add->materi->Visible) { // materi ?>
	<div id="r_materi" class="form-group row">
		<label id="elh_t_jadwalwebinar_materi" for="x_materi" class="<?php echo $t_jadwalwebinar_add->LeftColumnClass ?>"><?php echo $t_jadwalwebinar_add->materi->caption() ?><?php echo $t_jadwalwebinar_add->materi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalwebinar_add->RightColumnClass ?>"><div <?php echo $t_jadwalwebinar_add->materi->cellAttributes() ?>>
<span id="el_t_jadwalwebinar_materi">
<input type="text" data-table="t_jadwalwebinar" data-field="x_materi" data-page="1" name="x_materi" id="x_materi" size="50" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_add->materi->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_add->materi->EditValue ?>"<?php echo $t_jadwalwebinar_add->materi->editAttributes() ?>>
</span>
<?php echo $t_jadwalwebinar_add->materi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalwebinar_add->ket->Visible) { // ket ?>
	<div id="r_ket" class="form-group row">
		<label id="elh_t_jadwalwebinar_ket" for="x_ket" class="<?php echo $t_jadwalwebinar_add->LeftColumnClass ?>"><?php echo $t_jadwalwebinar_add->ket->caption() ?><?php echo $t_jadwalwebinar_add->ket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalwebinar_add->RightColumnClass ?>"><div <?php echo $t_jadwalwebinar_add->ket->cellAttributes() ?>>
<span id="el_t_jadwalwebinar_ket">
<input type="text" data-table="t_jadwalwebinar" data-field="x_ket" data-page="1" name="x_ket" id="x_ket" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_add->ket->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_add->ket->EditValue ?>"<?php echo $t_jadwalwebinar_add->ket->editAttributes() ?>>
</span>
<?php echo $t_jadwalwebinar_add->ket->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $t_jadwalwebinar_add->MultiPages->pageStyle(2) ?>" id="tab_t_jadwalwebinar2"><!-- multi-page .tab-pane -->
<div class="ew-add-div"><!-- page* -->
<?php if ($t_jadwalwebinar_add->instruktur->Visible) { // instruktur ?>
	<div id="r_instruktur" class="form-group row">
		<label id="elh_t_jadwalwebinar_instruktur" for="x_instruktur" class="<?php echo $t_jadwalwebinar_add->LeftColumnClass ?>"><?php echo $t_jadwalwebinar_add->instruktur->caption() ?><?php echo $t_jadwalwebinar_add->instruktur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalwebinar_add->RightColumnClass ?>"><div <?php echo $t_jadwalwebinar_add->instruktur->cellAttributes() ?>>
<span id="el_t_jadwalwebinar_instruktur">
<input type="text" data-table="t_jadwalwebinar" data-field="x_instruktur" data-page="2" name="x_instruktur" id="x_instruktur" size="30" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_add->instruktur->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_add->instruktur->EditValue ?>"<?php echo $t_jadwalwebinar_add->instruktur->editAttributes() ?>>
</span>
<?php echo $t_jadwalwebinar_add->instruktur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jadwalwebinar_add->instansi->Visible) { // instansi ?>
	<div id="r_instansi" class="form-group row">
		<label id="elh_t_jadwalwebinar_instansi" for="x_instansi" class="<?php echo $t_jadwalwebinar_add->LeftColumnClass ?>"><?php echo $t_jadwalwebinar_add->instansi->caption() ?><?php echo $t_jadwalwebinar_add->instansi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_jadwalwebinar_add->RightColumnClass ?>"><div <?php echo $t_jadwalwebinar_add->instansi->cellAttributes() ?>>
<span id="el_t_jadwalwebinar_instansi">
<input type="text" data-table="t_jadwalwebinar" data-field="x_instansi" data-page="2" name="x_instansi" id="x_instansi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_jadwalwebinar_add->instansi->getPlaceHolder()) ?>" value="<?php echo $t_jadwalwebinar_add->instansi->EditValue ?>"<?php echo $t_jadwalwebinar_add->instansi->editAttributes() ?>>
</span>
<?php echo $t_jadwalwebinar_add->instansi->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page tabs .tab-content -->
</div><!-- /multi-page tabs -->
</div><!-- /multi-page -->
<?php if (!$t_jadwalwebinar_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_jadwalwebinar_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_jadwalwebinar_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_jadwalwebinar_add->showPageFooter();
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
$t_jadwalwebinar_add->terminate();
?>