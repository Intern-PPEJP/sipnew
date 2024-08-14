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
$diklatkerjasama_add = new diklatkerjasama_add();

// Run the page
$diklatkerjasama_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$diklatkerjasama_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdiklatkerjasamaadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdiklatkerjasamaadd = currentForm = new ew.Form("fdiklatkerjasamaadd", "add");

	// Validate form
	fdiklatkerjasamaadd.validate = function() {
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
			<?php if ($diklatkerjasama_add->kdjudul->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjudul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_add->kdjudul->caption(), $diklatkerjasama_add->kdjudul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_add->kdkursil->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkursil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_add->kdkursil->caption(), $diklatkerjasama_add->kdkursil->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_add->tawal->Required) { ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_add->tawal->caption(), $diklatkerjasama_add->tawal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tawal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatkerjasama_add->tawal->errorMessage()) ?>");
			<?php if ($diklatkerjasama_add->takhir->Required) { ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_add->takhir->caption(), $diklatkerjasama_add->takhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_takhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatkerjasama_add->takhir->errorMessage()) ?>");
			<?php if ($diklatkerjasama_add->jml_hari->Required) { ?>
				elm = this.getElements("x" + infix + "_jml_hari");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_add->jml_hari->caption(), $diklatkerjasama_add->jml_hari->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jml_hari");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatkerjasama_add->jml_hari->errorMessage()) ?>");
			<?php if ($diklatkerjasama_add->targetpes->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_add->targetpes->caption(), $diklatkerjasama_add->targetpes->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatkerjasama_add->targetpes->errorMessage()) ?>");
			<?php if ($diklatkerjasama_add->ketua->Required) { ?>
				elm = this.getElements("x" + infix + "_ketua");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_add->ketua->caption(), $diklatkerjasama_add->ketua->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_add->sekretaris->Required) { ?>
				elm = this.getElements("x" + infix + "_sekretaris");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_add->sekretaris->caption(), $diklatkerjasama_add->sekretaris->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_add->bendahara->Required) { ?>
				elm = this.getElements("x" + infix + "_bendahara");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_add->bendahara->caption(), $diklatkerjasama_add->bendahara->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_add->anggota2->Required) { ?>
				elm = this.getElements("x" + infix + "_anggota2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_add->anggota2->caption(), $diklatkerjasama_add->anggota2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_add->widyaiswara->Required) { ?>
				elm = this.getElements("x" + infix + "_widyaiswara");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_add->widyaiswara->caption(), $diklatkerjasama_add->widyaiswara->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_widyaiswara");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatkerjasama_add->widyaiswara->errorMessage()) ?>");
			<?php if ($diklatkerjasama_add->kdprop->Required) { ?>
				elm = this.getElements("x" + infix + "_kdprop");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_add->kdprop->caption(), $diklatkerjasama_add->kdprop->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_add->kdkota->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkota");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_add->kdkota->caption(), $diklatkerjasama_add->kdkota->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_add->tempat->Required) { ?>
				elm = this.getElements("x" + infix + "_tempat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_add->tempat->caption(), $diklatkerjasama_add->tempat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_add->biaya->Required) { ?>
				elm = this.getElements("x" + infix + "_biaya");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_add->biaya->caption(), $diklatkerjasama_add->biaya->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_biaya");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($diklatkerjasama_add->biaya->errorMessage()) ?>");
			<?php if ($diklatkerjasama_add->statuspel->Required) { ?>
				elm = this.getElements("x" + infix + "_statuspel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_add->statuspel->caption(), $diklatkerjasama_add->statuspel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($diklatkerjasama_add->jenisevaluasi->Required) { ?>
				elm = this.getElements("x" + infix + "_jenisevaluasi[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $diklatkerjasama_add->jenisevaluasi->caption(), $diklatkerjasama_add->jenisevaluasi->RequiredErrorMessage)) ?>");
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
	fdiklatkerjasamaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdiklatkerjasamaadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Multi-Page
	fdiklatkerjasamaadd.multiPage = new ew.MultiPage("fdiklatkerjasamaadd");

	// Dynamic selection lists
	fdiklatkerjasamaadd.lists["x_kdjudul"] = <?php echo $diklatkerjasama_add->kdjudul->Lookup->toClientList($diklatkerjasama_add) ?>;
	fdiklatkerjasamaadd.lists["x_kdjudul"].options = <?php echo JsonEncode($diklatkerjasama_add->kdjudul->lookupOptions()) ?>;
	fdiklatkerjasamaadd.autoSuggests["x_kdjudul"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatkerjasamaadd.lists["x_kdkursil"] = <?php echo $diklatkerjasama_add->kdkursil->Lookup->toClientList($diklatkerjasama_add) ?>;
	fdiklatkerjasamaadd.lists["x_kdkursil"].options = <?php echo JsonEncode($diklatkerjasama_add->kdkursil->lookupOptions()) ?>;
	fdiklatkerjasamaadd.lists["x_ketua"] = <?php echo $diklatkerjasama_add->ketua->Lookup->toClientList($diklatkerjasama_add) ?>;
	fdiklatkerjasamaadd.lists["x_ketua"].options = <?php echo JsonEncode($diklatkerjasama_add->ketua->lookupOptions()) ?>;
	fdiklatkerjasamaadd.autoSuggests["x_ketua"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatkerjasamaadd.lists["x_sekretaris"] = <?php echo $diklatkerjasama_add->sekretaris->Lookup->toClientList($diklatkerjasama_add) ?>;
	fdiklatkerjasamaadd.lists["x_sekretaris"].options = <?php echo JsonEncode($diklatkerjasama_add->sekretaris->lookupOptions()) ?>;
	fdiklatkerjasamaadd.autoSuggests["x_sekretaris"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatkerjasamaadd.lists["x_bendahara"] = <?php echo $diklatkerjasama_add->bendahara->Lookup->toClientList($diklatkerjasama_add) ?>;
	fdiklatkerjasamaadd.lists["x_bendahara"].options = <?php echo JsonEncode($diklatkerjasama_add->bendahara->lookupOptions()) ?>;
	fdiklatkerjasamaadd.autoSuggests["x_bendahara"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatkerjasamaadd.lists["x_anggota2"] = <?php echo $diklatkerjasama_add->anggota2->Lookup->toClientList($diklatkerjasama_add) ?>;
	fdiklatkerjasamaadd.lists["x_anggota2"].options = <?php echo JsonEncode($diklatkerjasama_add->anggota2->lookupOptions()) ?>;
	fdiklatkerjasamaadd.autoSuggests["x_anggota2"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatkerjasamaadd.lists["x_widyaiswara"] = <?php echo $diklatkerjasama_add->widyaiswara->Lookup->toClientList($diklatkerjasama_add) ?>;
	fdiklatkerjasamaadd.lists["x_widyaiswara"].options = <?php echo JsonEncode($diklatkerjasama_add->widyaiswara->lookupOptions()) ?>;
	fdiklatkerjasamaadd.autoSuggests["x_widyaiswara"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdiklatkerjasamaadd.lists["x_kdprop"] = <?php echo $diklatkerjasama_add->kdprop->Lookup->toClientList($diklatkerjasama_add) ?>;
	fdiklatkerjasamaadd.lists["x_kdprop"].options = <?php echo JsonEncode($diklatkerjasama_add->kdprop->lookupOptions()) ?>;
	fdiklatkerjasamaadd.lists["x_kdkota"] = <?php echo $diklatkerjasama_add->kdkota->Lookup->toClientList($diklatkerjasama_add) ?>;
	fdiklatkerjasamaadd.lists["x_kdkota"].options = <?php echo JsonEncode($diklatkerjasama_add->kdkota->lookupOptions()) ?>;
	fdiklatkerjasamaadd.lists["x_statuspel"] = <?php echo $diklatkerjasama_add->statuspel->Lookup->toClientList($diklatkerjasama_add) ?>;
	fdiklatkerjasamaadd.lists["x_statuspel"].options = <?php echo JsonEncode($diklatkerjasama_add->statuspel->options(FALSE, TRUE)) ?>;
	fdiklatkerjasamaadd.lists["x_jenisevaluasi[]"] = <?php echo $diklatkerjasama_add->jenisevaluasi->Lookup->toClientList($diklatkerjasama_add) ?>;
	fdiklatkerjasamaadd.lists["x_jenisevaluasi[]"].options = <?php echo JsonEncode($diklatkerjasama_add->jenisevaluasi->lookupOptions()) ?>;
	loadjs.done("fdiklatkerjasamaadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $diklatkerjasama_add->showPageHeader(); ?>
<?php
$diklatkerjasama_add->showMessage();
?>
<form name="fdiklatkerjasamaadd" id="fdiklatkerjasamaadd" class="<?php echo $diklatkerjasama_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="diklatkerjasama">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$diklatkerjasama_add->IsModal ?>">
<?php if ($diklatkerjasama->getCurrentMasterTable() == "t_rpkerjasama") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_rpkerjasama">
<input type="hidden" name="fk_rpkid" value="<?php echo HtmlEncode($diklatkerjasama_add->rid->getSessionValue()) ?>">
<input type="hidden" name="fk_jenispel" value="<?php echo HtmlEncode($diklatkerjasama_add->jenispel->getSessionValue()) ?>">
<?php } ?>
<div class="ew-multi-page"><!-- multi-page -->
<div class="ew-nav-tabs" id="diklatkerjasama_add"><!-- multi-page tabs -->
	<ul class="<?php echo $diklatkerjasama_add->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $diklatkerjasama_add->MultiPages->pageStyle(1) ?>" href="#tab_diklatkerjasama1" data-toggle="tab"><?php echo $diklatkerjasama->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $diklatkerjasama_add->MultiPages->pageStyle(2) ?>" href="#tab_diklatkerjasama2" data-toggle="tab"><?php echo $diklatkerjasama->pageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page tabs .tab-content -->
		<div class="tab-pane<?php echo $diklatkerjasama_add->MultiPages->pageStyle(1) ?>" id="tab_diklatkerjasama1"><!-- multi-page .tab-pane -->
<div class="ew-add-div"><!-- page* -->
<?php if ($diklatkerjasama_add->kdjudul->Visible) { // kdjudul ?>
	<div id="r_kdjudul" class="form-group row">
		<label id="elh_diklatkerjasama_kdjudul" class="<?php echo $diklatkerjasama_add->LeftColumnClass ?>"><?php echo $diklatkerjasama_add->kdjudul->caption() ?><?php echo $diklatkerjasama_add->kdjudul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_add->RightColumnClass ?>"><div <?php echo $diklatkerjasama_add->kdjudul->cellAttributes() ?>>
<span id="el_diklatkerjasama_kdjudul">
<?php
$onchange = $diklatkerjasama_add->kdjudul->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_add->kdjudul->EditAttrs["onchange"] = "";
?>
<span id="as_x_kdjudul">
	<input type="text" class="form-control" name="sv_x_kdjudul" id="sv_x_kdjudul" value="<?php echo RemoveHtml($diklatkerjasama_add->kdjudul->EditValue) ?>" size="25" placeholder="<?php echo HtmlEncode($diklatkerjasama_add->kdjudul->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_add->kdjudul->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_add->kdjudul->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_kdjudul" data-page="1" data-value-separator="<?php echo $diklatkerjasama_add->kdjudul->displayValueSeparatorAttribute() ?>" name="x_kdjudul" id="x_kdjudul" value="<?php echo HtmlEncode($diklatkerjasama_add->kdjudul->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamaadd"], function() {
	fdiklatkerjasamaadd.createAutoSuggest({"id":"x_kdjudul","forceSelect":true,"minWidth":"650px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_add->kdjudul->Lookup->getParamTag($diklatkerjasama_add, "p_x_kdjudul") ?>
</span>
<?php echo $diklatkerjasama_add->kdjudul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_add->kdkursil->Visible) { // kdkursil ?>
	<div id="r_kdkursil" class="form-group row">
		<label id="elh_diklatkerjasama_kdkursil" for="x_kdkursil" class="<?php echo $diklatkerjasama_add->LeftColumnClass ?>"><?php echo $diklatkerjasama_add->kdkursil->caption() ?><?php echo $diklatkerjasama_add->kdkursil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_add->RightColumnClass ?>"><div <?php echo $diklatkerjasama_add->kdkursil->cellAttributes() ?>>
<span id="el_diklatkerjasama_kdkursil">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatkerjasama" data-field="x_kdkursil" data-page="1" data-value-separator="<?php echo $diklatkerjasama_add->kdkursil->displayValueSeparatorAttribute() ?>" id="x_kdkursil" name="x_kdkursil"<?php echo $diklatkerjasama_add->kdkursil->editAttributes() ?>>
			<?php echo $diklatkerjasama_add->kdkursil->selectOptionListHtml("x_kdkursil") ?>
		</select>
</div>
<?php echo $diklatkerjasama_add->kdkursil->Lookup->getParamTag($diklatkerjasama_add, "p_x_kdkursil") ?>
</span>
<?php echo $diklatkerjasama_add->kdkursil->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_add->tawal->Visible) { // tawal ?>
	<div id="r_tawal" class="form-group row">
		<label id="elh_diklatkerjasama_tawal" for="x_tawal" class="<?php echo $diklatkerjasama_add->LeftColumnClass ?>"><?php echo $diklatkerjasama_add->tawal->caption() ?><?php echo $diklatkerjasama_add->tawal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_add->RightColumnClass ?>"><div <?php echo $diklatkerjasama_add->tawal->cellAttributes() ?>>
<span id="el_diklatkerjasama_tawal">
<input type="text" data-table="diklatkerjasama" data-field="x_tawal" data-page="1" name="x_tawal" id="x_tawal" size="10" placeholder="<?php echo HtmlEncode($diklatkerjasama_add->tawal->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_add->tawal->EditValue ?>"<?php echo $diklatkerjasama_add->tawal->editAttributes() ?>>
<?php if (!$diklatkerjasama_add->tawal->ReadOnly && !$diklatkerjasama_add->tawal->Disabled && !isset($diklatkerjasama_add->tawal->EditAttrs["readonly"]) && !isset($diklatkerjasama_add->tawal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiklatkerjasamaadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fdiklatkerjasamaadd", "x_tawal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $diklatkerjasama_add->tawal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_add->takhir->Visible) { // takhir ?>
	<div id="r_takhir" class="form-group row">
		<label id="elh_diklatkerjasama_takhir" for="x_takhir" class="<?php echo $diklatkerjasama_add->LeftColumnClass ?>"><?php echo $diklatkerjasama_add->takhir->caption() ?><?php echo $diklatkerjasama_add->takhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_add->RightColumnClass ?>"><div <?php echo $diklatkerjasama_add->takhir->cellAttributes() ?>>
<span id="el_diklatkerjasama_takhir">
<input type="text" data-table="diklatkerjasama" data-field="x_takhir" data-page="1" name="x_takhir" id="x_takhir" size="10" placeholder="<?php echo HtmlEncode($diklatkerjasama_add->takhir->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_add->takhir->EditValue ?>"<?php echo $diklatkerjasama_add->takhir->editAttributes() ?>>
<?php if (!$diklatkerjasama_add->takhir->ReadOnly && !$diklatkerjasama_add->takhir->Disabled && !isset($diklatkerjasama_add->takhir->EditAttrs["readonly"]) && !isset($diklatkerjasama_add->takhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiklatkerjasamaadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fdiklatkerjasamaadd", "x_takhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $diklatkerjasama_add->takhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_add->jml_hari->Visible) { // jml_hari ?>
	<div id="r_jml_hari" class="form-group row">
		<label id="elh_diklatkerjasama_jml_hari" for="x_jml_hari" class="<?php echo $diklatkerjasama_add->LeftColumnClass ?>"><?php echo $diklatkerjasama_add->jml_hari->caption() ?><?php echo $diklatkerjasama_add->jml_hari->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_add->RightColumnClass ?>"><div <?php echo $diklatkerjasama_add->jml_hari->cellAttributes() ?>>
<span id="el_diklatkerjasama_jml_hari">
<input type="text" data-table="diklatkerjasama" data-field="x_jml_hari" data-page="1" name="x_jml_hari" id="x_jml_hari" size="5" maxlength="3" placeholder="<?php echo HtmlEncode($diklatkerjasama_add->jml_hari->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_add->jml_hari->EditValue ?>"<?php echo $diklatkerjasama_add->jml_hari->editAttributes() ?>>
</span>
<?php echo $diklatkerjasama_add->jml_hari->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_add->targetpes->Visible) { // targetpes ?>
	<div id="r_targetpes" class="form-group row">
		<label id="elh_diklatkerjasama_targetpes" for="x_targetpes" class="<?php echo $diklatkerjasama_add->LeftColumnClass ?>"><?php echo $diklatkerjasama_add->targetpes->caption() ?><?php echo $diklatkerjasama_add->targetpes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_add->RightColumnClass ?>"><div <?php echo $diklatkerjasama_add->targetpes->cellAttributes() ?>>
<span id="el_diklatkerjasama_targetpes">
<input type="text" data-table="diklatkerjasama" data-field="x_targetpes" data-page="1" name="x_targetpes" id="x_targetpes" size="5" maxlength="3" placeholder="<?php echo HtmlEncode($diklatkerjasama_add->targetpes->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_add->targetpes->EditValue ?>"<?php echo $diklatkerjasama_add->targetpes->editAttributes() ?>>
</span>
<?php echo $diklatkerjasama_add->targetpes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_add->kdprop->Visible) { // kdprop ?>
	<div id="r_kdprop" class="form-group row">
		<label id="elh_diklatkerjasama_kdprop" for="x_kdprop" class="<?php echo $diklatkerjasama_add->LeftColumnClass ?>"><?php echo $diklatkerjasama_add->kdprop->caption() ?><?php echo $diklatkerjasama_add->kdprop->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_add->RightColumnClass ?>"><div <?php echo $diklatkerjasama_add->kdprop->cellAttributes() ?>>
<span id="el_diklatkerjasama_kdprop">
<?php $diklatkerjasama_add->kdprop->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatkerjasama" data-field="x_kdprop" data-page="1" data-value-separator="<?php echo $diklatkerjasama_add->kdprop->displayValueSeparatorAttribute() ?>" id="x_kdprop" name="x_kdprop"<?php echo $diklatkerjasama_add->kdprop->editAttributes() ?>>
			<?php echo $diklatkerjasama_add->kdprop->selectOptionListHtml("x_kdprop") ?>
		</select>
</div>
<?php echo $diklatkerjasama_add->kdprop->Lookup->getParamTag($diklatkerjasama_add, "p_x_kdprop") ?>
</span>
<?php echo $diklatkerjasama_add->kdprop->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_add->kdkota->Visible) { // kdkota ?>
	<div id="r_kdkota" class="form-group row">
		<label id="elh_diklatkerjasama_kdkota" for="x_kdkota" class="<?php echo $diklatkerjasama_add->LeftColumnClass ?>"><?php echo $diklatkerjasama_add->kdkota->caption() ?><?php echo $diklatkerjasama_add->kdkota->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_add->RightColumnClass ?>"><div <?php echo $diklatkerjasama_add->kdkota->cellAttributes() ?>>
<span id="el_diklatkerjasama_kdkota">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatkerjasama" data-field="x_kdkota" data-page="1" data-value-separator="<?php echo $diklatkerjasama_add->kdkota->displayValueSeparatorAttribute() ?>" id="x_kdkota" name="x_kdkota"<?php echo $diklatkerjasama_add->kdkota->editAttributes() ?>>
			<?php echo $diklatkerjasama_add->kdkota->selectOptionListHtml("x_kdkota") ?>
		</select>
</div>
<?php echo $diklatkerjasama_add->kdkota->Lookup->getParamTag($diklatkerjasama_add, "p_x_kdkota") ?>
</span>
<?php echo $diklatkerjasama_add->kdkota->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_add->tempat->Visible) { // tempat ?>
	<div id="r_tempat" class="form-group row">
		<label id="elh_diklatkerjasama_tempat" for="x_tempat" class="<?php echo $diklatkerjasama_add->LeftColumnClass ?>"><?php echo $diklatkerjasama_add->tempat->caption() ?><?php echo $diklatkerjasama_add->tempat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_add->RightColumnClass ?>"><div <?php echo $diklatkerjasama_add->tempat->cellAttributes() ?>>
<span id="el_diklatkerjasama_tempat">
<input type="text" data-table="diklatkerjasama" data-field="x_tempat" data-page="1" name="x_tempat" id="x_tempat" size="40" maxlength="255" placeholder="<?php echo HtmlEncode($diklatkerjasama_add->tempat->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_add->tempat->EditValue ?>"<?php echo $diklatkerjasama_add->tempat->editAttributes() ?>>
</span>
<?php echo $diklatkerjasama_add->tempat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_add->biaya->Visible) { // biaya ?>
	<div id="r_biaya" class="form-group row">
		<label id="elh_diklatkerjasama_biaya" for="x_biaya" class="<?php echo $diklatkerjasama_add->LeftColumnClass ?>"><?php echo $diklatkerjasama_add->biaya->caption() ?><?php echo $diklatkerjasama_add->biaya->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_add->RightColumnClass ?>"><div <?php echo $diklatkerjasama_add->biaya->cellAttributes() ?>>
<span id="el_diklatkerjasama_biaya">
<input type="text" data-table="diklatkerjasama" data-field="x_biaya" data-page="1" name="x_biaya" id="x_biaya" size="15" maxlength="17" placeholder="<?php echo HtmlEncode($diklatkerjasama_add->biaya->getPlaceHolder()) ?>" value="<?php echo $diklatkerjasama_add->biaya->EditValue ?>"<?php echo $diklatkerjasama_add->biaya->editAttributes() ?>>
</span>
<?php echo $diklatkerjasama_add->biaya->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_add->statuspel->Visible) { // statuspel ?>
	<div id="r_statuspel" class="form-group row">
		<label id="elh_diklatkerjasama_statuspel" for="x_statuspel" class="<?php echo $diklatkerjasama_add->LeftColumnClass ?>"><?php echo $diklatkerjasama_add->statuspel->caption() ?><?php echo $diklatkerjasama_add->statuspel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_add->RightColumnClass ?>"><div <?php echo $diklatkerjasama_add->statuspel->cellAttributes() ?>>
<span id="el_diklatkerjasama_statuspel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="diklatkerjasama" data-field="x_statuspel" data-page="1" data-value-separator="<?php echo $diklatkerjasama_add->statuspel->displayValueSeparatorAttribute() ?>" id="x_statuspel" name="x_statuspel"<?php echo $diklatkerjasama_add->statuspel->editAttributes() ?>>
			<?php echo $diklatkerjasama_add->statuspel->selectOptionListHtml("x_statuspel") ?>
		</select>
</div>
</span>
<?php echo $diklatkerjasama_add->statuspel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_add->jenisevaluasi->Visible) { // jenisevaluasi ?>
	<div id="r_jenisevaluasi" class="form-group row">
		<label id="elh_diklatkerjasama_jenisevaluasi" class="<?php echo $diklatkerjasama_add->LeftColumnClass ?>"><?php echo $diklatkerjasama_add->jenisevaluasi->caption() ?><?php echo $diklatkerjasama_add->jenisevaluasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_add->RightColumnClass ?>"><div <?php echo $diklatkerjasama_add->jenisevaluasi->cellAttributes() ?>>
<span id="el_diklatkerjasama_jenisevaluasi">
<div id="tp_x_jenisevaluasi" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="diklatkerjasama" data-field="x_jenisevaluasi" data-page="1" data-value-separator="<?php echo $diklatkerjasama_add->jenisevaluasi->displayValueSeparatorAttribute() ?>" name="x_jenisevaluasi[]" id="x_jenisevaluasi[]" value="{value}"<?php echo $diklatkerjasama_add->jenisevaluasi->editAttributes() ?>></div>
<div id="dsl_x_jenisevaluasi" data-repeatcolumn="1" class="ew-item-list d-none"><div>
<?php echo $diklatkerjasama_add->jenisevaluasi->checkBoxListHtml(FALSE, "x_jenisevaluasi[]", 1) ?>
</div></div>
<?php echo $diklatkerjasama_add->jenisevaluasi->Lookup->getParamTag($diklatkerjasama_add, "p_x_jenisevaluasi") ?>
</span>
<?php echo $diklatkerjasama_add->jenisevaluasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $diklatkerjasama_add->MultiPages->pageStyle(2) ?>" id="tab_diklatkerjasama2"><!-- multi-page .tab-pane -->
<div class="ew-add-div"><!-- page* -->
<?php if ($diklatkerjasama_add->ketua->Visible) { // ketua ?>
	<div id="r_ketua" class="form-group row">
		<label id="elh_diklatkerjasama_ketua" class="<?php echo $diklatkerjasama_add->LeftColumnClass ?>"><?php echo $diklatkerjasama_add->ketua->caption() ?><?php echo $diklatkerjasama_add->ketua->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_add->RightColumnClass ?>"><div <?php echo $diklatkerjasama_add->ketua->cellAttributes() ?>>
<span id="el_diklatkerjasama_ketua">
<?php
$onchange = $diklatkerjasama_add->ketua->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_add->ketua->EditAttrs["onchange"] = "";
?>
<span id="as_x_ketua">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ketua" id="sv_x_ketua" value="<?php echo RemoveHtml($diklatkerjasama_add->ketua->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_add->ketua->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_add->ketua->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_add->ketua->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($diklatkerjasama_add->ketua->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ketua',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($diklatkerjasama_add->ketua->ReadOnly || $diklatkerjasama_add->ketua->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_ketua" data-page="2" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $diklatkerjasama_add->ketua->displayValueSeparatorAttribute() ?>" name="x_ketua" id="x_ketua" value="<?php echo HtmlEncode($diklatkerjasama_add->ketua->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamaadd"], function() {
	fdiklatkerjasamaadd.createAutoSuggest({"id":"x_ketua","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_add->ketua->Lookup->getParamTag($diklatkerjasama_add, "p_x_ketua") ?>
</span>
<?php echo $diklatkerjasama_add->ketua->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_add->sekretaris->Visible) { // sekretaris ?>
	<div id="r_sekretaris" class="form-group row">
		<label id="elh_diklatkerjasama_sekretaris" class="<?php echo $diklatkerjasama_add->LeftColumnClass ?>"><?php echo $diklatkerjasama_add->sekretaris->caption() ?><?php echo $diklatkerjasama_add->sekretaris->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_add->RightColumnClass ?>"><div <?php echo $diklatkerjasama_add->sekretaris->cellAttributes() ?>>
<span id="el_diklatkerjasama_sekretaris">
<?php
$onchange = $diklatkerjasama_add->sekretaris->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_add->sekretaris->EditAttrs["onchange"] = "";
?>
<span id="as_x_sekretaris">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_sekretaris" id="sv_x_sekretaris" value="<?php echo RemoveHtml($diklatkerjasama_add->sekretaris->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_add->sekretaris->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_add->sekretaris->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_add->sekretaris->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($diklatkerjasama_add->sekretaris->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_sekretaris',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($diklatkerjasama_add->sekretaris->ReadOnly || $diklatkerjasama_add->sekretaris->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_sekretaris" data-page="2" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $diklatkerjasama_add->sekretaris->displayValueSeparatorAttribute() ?>" name="x_sekretaris" id="x_sekretaris" value="<?php echo HtmlEncode($diklatkerjasama_add->sekretaris->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamaadd"], function() {
	fdiklatkerjasamaadd.createAutoSuggest({"id":"x_sekretaris","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_add->sekretaris->Lookup->getParamTag($diklatkerjasama_add, "p_x_sekretaris") ?>
</span>
<?php echo $diklatkerjasama_add->sekretaris->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_add->bendahara->Visible) { // bendahara ?>
	<div id="r_bendahara" class="form-group row">
		<label id="elh_diklatkerjasama_bendahara" class="<?php echo $diklatkerjasama_add->LeftColumnClass ?>"><?php echo $diklatkerjasama_add->bendahara->caption() ?><?php echo $diklatkerjasama_add->bendahara->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_add->RightColumnClass ?>"><div <?php echo $diklatkerjasama_add->bendahara->cellAttributes() ?>>
<span id="el_diklatkerjasama_bendahara">
<?php
$onchange = $diklatkerjasama_add->bendahara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_add->bendahara->EditAttrs["onchange"] = "";
?>
<span id="as_x_bendahara">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_bendahara" id="sv_x_bendahara" value="<?php echo RemoveHtml($diklatkerjasama_add->bendahara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_add->bendahara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_add->bendahara->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_add->bendahara->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($diklatkerjasama_add->bendahara->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_bendahara',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($diklatkerjasama_add->bendahara->ReadOnly || $diklatkerjasama_add->bendahara->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_bendahara" data-page="2" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $diklatkerjasama_add->bendahara->displayValueSeparatorAttribute() ?>" name="x_bendahara" id="x_bendahara" value="<?php echo HtmlEncode($diklatkerjasama_add->bendahara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamaadd"], function() {
	fdiklatkerjasamaadd.createAutoSuggest({"id":"x_bendahara","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_add->bendahara->Lookup->getParamTag($diklatkerjasama_add, "p_x_bendahara") ?>
</span>
<?php echo $diklatkerjasama_add->bendahara->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_add->anggota2->Visible) { // anggota2 ?>
	<div id="r_anggota2" class="form-group row">
		<label id="elh_diklatkerjasama_anggota2" class="<?php echo $diklatkerjasama_add->LeftColumnClass ?>"><?php echo $diklatkerjasama_add->anggota2->caption() ?><?php echo $diklatkerjasama_add->anggota2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_add->RightColumnClass ?>"><div <?php echo $diklatkerjasama_add->anggota2->cellAttributes() ?>>
<span id="el_diklatkerjasama_anggota2">
<?php
$onchange = $diklatkerjasama_add->anggota2->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_add->anggota2->EditAttrs["onchange"] = "";
?>
<span id="as_x_anggota2">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_anggota2" id="sv_x_anggota2" value="<?php echo RemoveHtml($diklatkerjasama_add->anggota2->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_add->anggota2->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_add->anggota2->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_add->anggota2->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($diklatkerjasama_add->anggota2->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_anggota2',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($diklatkerjasama_add->anggota2->ReadOnly || $diklatkerjasama_add->anggota2->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_anggota2" data-page="2" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $diklatkerjasama_add->anggota2->displayValueSeparatorAttribute() ?>" name="x_anggota2" id="x_anggota2" value="<?php echo HtmlEncode($diklatkerjasama_add->anggota2->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamaadd"], function() {
	fdiklatkerjasamaadd.createAutoSuggest({"id":"x_anggota2","forceSelect":true,"minWidth":"233px","maxHeight":"333px"});
});
</script>
<?php echo $diklatkerjasama_add->anggota2->Lookup->getParamTag($diklatkerjasama_add, "p_x_anggota2") ?>
</span>
<?php echo $diklatkerjasama_add->anggota2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($diklatkerjasama_add->widyaiswara->Visible) { // widyaiswara ?>
	<div id="r_widyaiswara" class="form-group row">
		<label id="elh_diklatkerjasama_widyaiswara" class="<?php echo $diklatkerjasama_add->LeftColumnClass ?>"><?php echo $diklatkerjasama_add->widyaiswara->caption() ?><?php echo $diklatkerjasama_add->widyaiswara->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $diklatkerjasama_add->RightColumnClass ?>"><div <?php echo $diklatkerjasama_add->widyaiswara->cellAttributes() ?>>
<span id="el_diklatkerjasama_widyaiswara">
<?php
$onchange = $diklatkerjasama_add->widyaiswara->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$diklatkerjasama_add->widyaiswara->EditAttrs["onchange"] = "";
?>
<span id="as_x_widyaiswara">
	<input type="text" class="form-control" name="sv_x_widyaiswara" id="sv_x_widyaiswara" value="<?php echo RemoveHtml($diklatkerjasama_add->widyaiswara->EditValue) ?>" size="15" maxlength="40" placeholder="<?php echo HtmlEncode($diklatkerjasama_add->widyaiswara->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($diklatkerjasama_add->widyaiswara->getPlaceHolder()) ?>"<?php echo $diklatkerjasama_add->widyaiswara->editAttributes() ?>>
</span>
<input type="hidden" data-table="diklatkerjasama" data-field="x_widyaiswara" data-page="2" data-value-separator="<?php echo $diklatkerjasama_add->widyaiswara->displayValueSeparatorAttribute() ?>" name="x_widyaiswara" id="x_widyaiswara" value="<?php echo HtmlEncode($diklatkerjasama_add->widyaiswara->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdiklatkerjasamaadd"], function() {
	fdiklatkerjasamaadd.createAutoSuggest({"id":"x_widyaiswara","forceSelect":true});
});
</script>
<?php echo $diklatkerjasama_add->widyaiswara->Lookup->getParamTag($diklatkerjasama_add, "p_x_widyaiswara") ?>
</span>
<?php echo $diklatkerjasama_add->widyaiswara->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page tabs .tab-content -->
</div><!-- /multi-page tabs -->
</div><!-- /multi-page -->
	<?php if (strval($diklatkerjasama_add->rid->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_rid" id="x_rid" value="<?php echo HtmlEncode(strval($diklatkerjasama_add->rid->getSessionValue())) ?>">
	<?php } ?>
	<?php if (strval($diklatkerjasama_add->jenispel->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_jenispel" id="x_jenispel" value="<?php echo HtmlEncode(strval($diklatkerjasama_add->jenispel->getSessionValue())) ?>">
	<?php } ?>
<?php if (!$diklatkerjasama_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $diklatkerjasama_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $diklatkerjasama_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$diklatkerjasama_add->showPageFooter();
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
$diklatkerjasama_add->terminate();
?>