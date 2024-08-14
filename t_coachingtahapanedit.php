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
$t_coachingtahapan_edit = new t_coachingtahapan_edit();

// Run the page
$t_coachingtahapan_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_coachingtahapan_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_coachingtahapanedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_coachingtahapanedit = currentForm = new ew.Form("ft_coachingtahapanedit", "edit");

	// Validate form
	ft_coachingtahapanedit.validate = function() {
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
			<?php if ($t_coachingtahapan_edit->area->Required) { ?>
				elm = this.getElements("x" + infix + "_area");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_edit->area->caption(), $t_coachingtahapan_edit->area->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coachingtahapan_edit->jenispel->Required) { ?>
				elm = this.getElements("x" + infix + "_jenispel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_edit->jenispel->caption(), $t_coachingtahapan_edit->jenispel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coachingtahapan_edit->kdkategori->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkategori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_edit->kdkategori->caption(), $t_coachingtahapan_edit->kdkategori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coachingtahapan_edit->kerjasama->Required) { ?>
				elm = this.getElements("x" + infix + "_kerjasama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_edit->kerjasama->caption(), $t_coachingtahapan_edit->kerjasama->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kerjasama");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coachingtahapan_edit->kerjasama->errorMessage()) ?>");
			<?php if ($t_coachingtahapan_edit->tglpelak1->Required) { ?>
				elm = this.getElements("x" + infix + "_tglpelak1");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_edit->tglpelak1->caption(), $t_coachingtahapan_edit->tglpelak1->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coachingtahapan_edit->targetpes1->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes1");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_edit->targetpes1->caption(), $t_coachingtahapan_edit->targetpes1->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes1");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coachingtahapan_edit->targetpes1->errorMessage()) ?>");
			<?php if ($t_coachingtahapan_edit->tglpelak2->Required) { ?>
				elm = this.getElements("x" + infix + "_tglpelak2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_edit->tglpelak2->caption(), $t_coachingtahapan_edit->tglpelak2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coachingtahapan_edit->targetpes2->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_edit->targetpes2->caption(), $t_coachingtahapan_edit->targetpes2->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes2");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coachingtahapan_edit->targetpes2->errorMessage()) ?>");
			<?php if ($t_coachingtahapan_edit->tglpelak3->Required) { ?>
				elm = this.getElements("x" + infix + "_tglpelak3");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_edit->tglpelak3->caption(), $t_coachingtahapan_edit->tglpelak3->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coachingtahapan_edit->targetpes3->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes3");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_edit->targetpes3->caption(), $t_coachingtahapan_edit->targetpes3->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes3");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coachingtahapan_edit->targetpes3->errorMessage()) ?>");
			<?php if ($t_coachingtahapan_edit->tglpelak4->Required) { ?>
				elm = this.getElements("x" + infix + "_tglpelak4");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_edit->tglpelak4->caption(), $t_coachingtahapan_edit->tglpelak4->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coachingtahapan_edit->targetpes4->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes4");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_edit->targetpes4->caption(), $t_coachingtahapan_edit->targetpes4->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes4");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coachingtahapan_edit->targetpes4->errorMessage()) ?>");
			<?php if ($t_coachingtahapan_edit->tglpelak5->Required) { ?>
				elm = this.getElements("x" + infix + "_tglpelak5");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_edit->tglpelak5->caption(), $t_coachingtahapan_edit->tglpelak5->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coachingtahapan_edit->targetpes5->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes5");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_edit->targetpes5->caption(), $t_coachingtahapan_edit->targetpes5->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes5");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coachingtahapan_edit->targetpes5->errorMessage()) ?>");
			<?php if ($t_coachingtahapan_edit->tglpelak6->Required) { ?>
				elm = this.getElements("x" + infix + "_tglpelak6");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_edit->tglpelak6->caption(), $t_coachingtahapan_edit->tglpelak6->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coachingtahapan_edit->targetpes6->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes6");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_edit->targetpes6->caption(), $t_coachingtahapan_edit->targetpes6->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes6");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coachingtahapan_edit->targetpes6->errorMessage()) ?>");
			<?php if ($t_coachingtahapan_edit->tglpelak7->Required) { ?>
				elm = this.getElements("x" + infix + "_tglpelak7");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_edit->tglpelak7->caption(), $t_coachingtahapan_edit->tglpelak7->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coachingtahapan_edit->targetpes7->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes7");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_edit->targetpes7->caption(), $t_coachingtahapan_edit->targetpes7->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes7");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coachingtahapan_edit->targetpes7->errorMessage()) ?>");
			<?php if ($t_coachingtahapan_edit->tglpelak8->Required) { ?>
				elm = this.getElements("x" + infix + "_tglpelak8");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_edit->tglpelak8->caption(), $t_coachingtahapan_edit->tglpelak8->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_coachingtahapan_edit->targetpes8->Required) { ?>
				elm = this.getElements("x" + infix + "_targetpes8");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_coachingtahapan_edit->targetpes8->caption(), $t_coachingtahapan_edit->targetpes8->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_targetpes8");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_coachingtahapan_edit->targetpes8->errorMessage()) ?>");

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
	ft_coachingtahapanedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_coachingtahapanedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Multi-Page
	ft_coachingtahapanedit.multiPage = new ew.MultiPage("ft_coachingtahapanedit");

	// Dynamic selection lists
	ft_coachingtahapanedit.lists["x_area"] = <?php echo $t_coachingtahapan_edit->area->Lookup->toClientList($t_coachingtahapan_edit) ?>;
	ft_coachingtahapanedit.lists["x_area"].options = <?php echo JsonEncode($t_coachingtahapan_edit->area->lookupOptions()) ?>;
	ft_coachingtahapanedit.lists["x_jenispel"] = <?php echo $t_coachingtahapan_edit->jenispel->Lookup->toClientList($t_coachingtahapan_edit) ?>;
	ft_coachingtahapanedit.lists["x_jenispel"].options = <?php echo JsonEncode($t_coachingtahapan_edit->jenispel->options(FALSE, TRUE)) ?>;
	ft_coachingtahapanedit.lists["x_kdkategori"] = <?php echo $t_coachingtahapan_edit->kdkategori->Lookup->toClientList($t_coachingtahapan_edit) ?>;
	ft_coachingtahapanedit.lists["x_kdkategori"].options = <?php echo JsonEncode($t_coachingtahapan_edit->kdkategori->lookupOptions()) ?>;
	ft_coachingtahapanedit.lists["x_kerjasama"] = <?php echo $t_coachingtahapan_edit->kerjasama->Lookup->toClientList($t_coachingtahapan_edit) ?>;
	ft_coachingtahapanedit.lists["x_kerjasama"].options = <?php echo JsonEncode($t_coachingtahapan_edit->kerjasama->lookupOptions()) ?>;
	ft_coachingtahapanedit.autoSuggests["x_kerjasama"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("ft_coachingtahapanedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_coachingtahapan_edit->showPageHeader(); ?>
<?php
$t_coachingtahapan_edit->showMessage();
?>
<form name="ft_coachingtahapanedit" id="ft_coachingtahapanedit" class="<?php echo $t_coachingtahapan_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_coachingtahapan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_coachingtahapan_edit->IsModal ?>">
<?php if ($t_coachingtahapan->getCurrentMasterTable() == "t_rkcoaching") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_rkcoaching">
<input type="hidden" name="fk_rkid" value="<?php echo HtmlEncode($t_coachingtahapan_edit->rkid->getSessionValue()) ?>">
<input type="hidden" name="fk_area" value="<?php echo HtmlEncode($t_coachingtahapan_edit->area->getSessionValue()) ?>">
<?php } ?>
<div class="ew-multi-page"><!-- multi-page -->
<div class="ew-nav-tabs" id="t_coachingtahapan_edit"><!-- multi-page tabs -->
	<ul class="<?php echo $t_coachingtahapan_edit->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $t_coachingtahapan_edit->MultiPages->pageStyle(1) ?>" href="#tab_t_coachingtahapan1" data-toggle="tab"><?php echo $t_coachingtahapan->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $t_coachingtahapan_edit->MultiPages->pageStyle(2) ?>" href="#tab_t_coachingtahapan2" data-toggle="tab"><?php echo $t_coachingtahapan->pageCaption(2) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $t_coachingtahapan_edit->MultiPages->pageStyle(3) ?>" href="#tab_t_coachingtahapan3" data-toggle="tab"><?php echo $t_coachingtahapan->pageCaption(3) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $t_coachingtahapan_edit->MultiPages->pageStyle(4) ?>" href="#tab_t_coachingtahapan4" data-toggle="tab"><?php echo $t_coachingtahapan->pageCaption(4) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $t_coachingtahapan_edit->MultiPages->pageStyle(5) ?>" href="#tab_t_coachingtahapan5" data-toggle="tab"><?php echo $t_coachingtahapan->pageCaption(5) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $t_coachingtahapan_edit->MultiPages->pageStyle(6) ?>" href="#tab_t_coachingtahapan6" data-toggle="tab"><?php echo $t_coachingtahapan->pageCaption(6) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $t_coachingtahapan_edit->MultiPages->pageStyle(7) ?>" href="#tab_t_coachingtahapan7" data-toggle="tab"><?php echo $t_coachingtahapan->pageCaption(7) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $t_coachingtahapan_edit->MultiPages->pageStyle(8) ?>" href="#tab_t_coachingtahapan8" data-toggle="tab"><?php echo $t_coachingtahapan->pageCaption(8) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $t_coachingtahapan_edit->MultiPages->pageStyle(9) ?>" href="#tab_t_coachingtahapan9" data-toggle="tab"><?php echo $t_coachingtahapan->pageCaption(9) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page tabs .tab-content -->
		<div class="tab-pane<?php echo $t_coachingtahapan_edit->MultiPages->pageStyle(1) ?>" id="tab_t_coachingtahapan1"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_coachingtahapan_edit->area->Visible) { // area ?>
	<div id="r_area" class="form-group row">
		<label id="elh_t_coachingtahapan_area" for="x_area" class="<?php echo $t_coachingtahapan_edit->LeftColumnClass ?>"><?php echo $t_coachingtahapan_edit->area->caption() ?><?php echo $t_coachingtahapan_edit->area->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coachingtahapan_edit->RightColumnClass ?>"><div <?php echo $t_coachingtahapan_edit->area->cellAttributes() ?>>
<?php if ($t_coachingtahapan_edit->area->getSessionValue() != "") { ?>
<span id="el_t_coachingtahapan_area">
<span<?php echo $t_coachingtahapan_edit->area->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_coachingtahapan_edit->area->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_area" name="x_area" value="<?php echo HtmlEncode($t_coachingtahapan_edit->area->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t_coachingtahapan_area">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coachingtahapan" data-field="x_area" data-page="1" data-value-separator="<?php echo $t_coachingtahapan_edit->area->displayValueSeparatorAttribute() ?>" id="x_area" name="x_area"<?php echo $t_coachingtahapan_edit->area->editAttributes() ?>>
			<?php echo $t_coachingtahapan_edit->area->selectOptionListHtml("x_area") ?>
		</select>
</div>
<?php echo $t_coachingtahapan_edit->area->Lookup->getParamTag($t_coachingtahapan_edit, "p_x_area") ?>
</span>
<?php } ?>
<?php echo $t_coachingtahapan_edit->area->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coachingtahapan_edit->jenispel->Visible) { // jenispel ?>
	<div id="r_jenispel" class="form-group row">
		<label id="elh_t_coachingtahapan_jenispel" for="x_jenispel" class="<?php echo $t_coachingtahapan_edit->LeftColumnClass ?>"><?php echo $t_coachingtahapan_edit->jenispel->caption() ?><?php echo $t_coachingtahapan_edit->jenispel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coachingtahapan_edit->RightColumnClass ?>"><div <?php echo $t_coachingtahapan_edit->jenispel->cellAttributes() ?>>
<span id="el_t_coachingtahapan_jenispel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coachingtahapan" data-field="x_jenispel" data-page="1" data-value-separator="<?php echo $t_coachingtahapan_edit->jenispel->displayValueSeparatorAttribute() ?>" id="x_jenispel" name="x_jenispel"<?php echo $t_coachingtahapan_edit->jenispel->editAttributes() ?>>
			<?php echo $t_coachingtahapan_edit->jenispel->selectOptionListHtml("x_jenispel") ?>
		</select>
</div>
</span>
<?php echo $t_coachingtahapan_edit->jenispel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coachingtahapan_edit->kdkategori->Visible) { // kdkategori ?>
	<div id="r_kdkategori" class="form-group row">
		<label id="elh_t_coachingtahapan_kdkategori" for="x_kdkategori" class="<?php echo $t_coachingtahapan_edit->LeftColumnClass ?>"><?php echo $t_coachingtahapan_edit->kdkategori->caption() ?><?php echo $t_coachingtahapan_edit->kdkategori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coachingtahapan_edit->RightColumnClass ?>"><div <?php echo $t_coachingtahapan_edit->kdkategori->cellAttributes() ?>>
<span id="el_t_coachingtahapan_kdkategori">
<?php $t_coachingtahapan_edit->kdkategori->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_coachingtahapan" data-field="x_kdkategori" data-page="1" data-value-separator="<?php echo $t_coachingtahapan_edit->kdkategori->displayValueSeparatorAttribute() ?>" id="x_kdkategori" name="x_kdkategori"<?php echo $t_coachingtahapan_edit->kdkategori->editAttributes() ?>>
			<?php echo $t_coachingtahapan_edit->kdkategori->selectOptionListHtml("x_kdkategori") ?>
		</select>
</div>
<?php echo $t_coachingtahapan_edit->kdkategori->Lookup->getParamTag($t_coachingtahapan_edit, "p_x_kdkategori") ?>
</span>
<?php echo $t_coachingtahapan_edit->kdkategori->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coachingtahapan_edit->kerjasama->Visible) { // kerjasama ?>
	<div id="r_kerjasama" class="form-group row">
		<label id="elh_t_coachingtahapan_kerjasama" class="<?php echo $t_coachingtahapan_edit->LeftColumnClass ?>"><?php echo $t_coachingtahapan_edit->kerjasama->caption() ?><?php echo $t_coachingtahapan_edit->kerjasama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coachingtahapan_edit->RightColumnClass ?>"><div <?php echo $t_coachingtahapan_edit->kerjasama->cellAttributes() ?>>
<span id="el_t_coachingtahapan_kerjasama">
<?php
$onchange = $t_coachingtahapan_edit->kerjasama->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_coachingtahapan_edit->kerjasama->EditAttrs["onchange"] = "";
?>
<span id="as_x_kerjasama">
	<input type="text" class="form-control" name="sv_x_kerjasama" id="sv_x_kerjasama" value="<?php echo RemoveHtml($t_coachingtahapan_edit->kerjasama->EditValue) ?>" size="100" maxlength="11" placeholder="<?php echo HtmlEncode($t_coachingtahapan_edit->kerjasama->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_coachingtahapan_edit->kerjasama->getPlaceHolder()) ?>"<?php echo $t_coachingtahapan_edit->kerjasama->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_coachingtahapan" data-field="x_kerjasama" data-page="1" data-value-separator="<?php echo $t_coachingtahapan_edit->kerjasama->displayValueSeparatorAttribute() ?>" name="x_kerjasama" id="x_kerjasama" value="<?php echo HtmlEncode($t_coachingtahapan_edit->kerjasama->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_coachingtahapanedit"], function() {
	ft_coachingtahapanedit.createAutoSuggest({"id":"x_kerjasama","forceSelect":true,"minWidth":"525px","maxHeight":"333px"});
});
</script>
<?php echo $t_coachingtahapan_edit->kerjasama->Lookup->getParamTag($t_coachingtahapan_edit, "p_x_kerjasama") ?>
</span>
<?php echo $t_coachingtahapan_edit->kerjasama->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $t_coachingtahapan_edit->MultiPages->pageStyle(2) ?>" id="tab_t_coachingtahapan2"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_coachingtahapan_edit->tglpelak1->Visible) { // tglpelak1 ?>
	<div id="r_tglpelak1" class="form-group row">
		<label id="elh_t_coachingtahapan_tglpelak1" for="x_tglpelak1" class="<?php echo $t_coachingtahapan_edit->LeftColumnClass ?>"><?php echo $t_coachingtahapan_edit->tglpelak1->caption() ?><?php echo $t_coachingtahapan_edit->tglpelak1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coachingtahapan_edit->RightColumnClass ?>"><div <?php echo $t_coachingtahapan_edit->tglpelak1->cellAttributes() ?>>
<span id="el_t_coachingtahapan_tglpelak1">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak1" data-page="2" name="x_tglpelak1" id="x_tglpelak1" placeholder="<?php echo HtmlEncode($t_coachingtahapan_edit->tglpelak1->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_edit->tglpelak1->EditValue ?>"<?php echo $t_coachingtahapan_edit->tglpelak1->editAttributes() ?>>
</span>
<?php echo $t_coachingtahapan_edit->tglpelak1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coachingtahapan_edit->targetpes1->Visible) { // targetpes1 ?>
	<div id="r_targetpes1" class="form-group row">
		<label id="elh_t_coachingtahapan_targetpes1" for="x_targetpes1" class="<?php echo $t_coachingtahapan_edit->LeftColumnClass ?>"><?php echo $t_coachingtahapan_edit->targetpes1->caption() ?><?php echo $t_coachingtahapan_edit->targetpes1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coachingtahapan_edit->RightColumnClass ?>"><div <?php echo $t_coachingtahapan_edit->targetpes1->cellAttributes() ?>>
<span id="el_t_coachingtahapan_targetpes1">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes1" data-page="2" name="x_targetpes1" id="x_targetpes1" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_edit->targetpes1->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_edit->targetpes1->EditValue ?>"<?php echo $t_coachingtahapan_edit->targetpes1->editAttributes() ?>>
</span>
<?php echo $t_coachingtahapan_edit->targetpes1->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $t_coachingtahapan_edit->MultiPages->pageStyle(3) ?>" id="tab_t_coachingtahapan3"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_coachingtahapan_edit->tglpelak2->Visible) { // tglpelak2 ?>
	<div id="r_tglpelak2" class="form-group row">
		<label id="elh_t_coachingtahapan_tglpelak2" for="x_tglpelak2" class="<?php echo $t_coachingtahapan_edit->LeftColumnClass ?>"><?php echo $t_coachingtahapan_edit->tglpelak2->caption() ?><?php echo $t_coachingtahapan_edit->tglpelak2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coachingtahapan_edit->RightColumnClass ?>"><div <?php echo $t_coachingtahapan_edit->tglpelak2->cellAttributes() ?>>
<span id="el_t_coachingtahapan_tglpelak2">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak2" data-page="3" name="x_tglpelak2" id="x_tglpelak2" placeholder="<?php echo HtmlEncode($t_coachingtahapan_edit->tglpelak2->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_edit->tglpelak2->EditValue ?>"<?php echo $t_coachingtahapan_edit->tglpelak2->editAttributes() ?>>
</span>
<?php echo $t_coachingtahapan_edit->tglpelak2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coachingtahapan_edit->targetpes2->Visible) { // targetpes2 ?>
	<div id="r_targetpes2" class="form-group row">
		<label id="elh_t_coachingtahapan_targetpes2" for="x_targetpes2" class="<?php echo $t_coachingtahapan_edit->LeftColumnClass ?>"><?php echo $t_coachingtahapan_edit->targetpes2->caption() ?><?php echo $t_coachingtahapan_edit->targetpes2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coachingtahapan_edit->RightColumnClass ?>"><div <?php echo $t_coachingtahapan_edit->targetpes2->cellAttributes() ?>>
<span id="el_t_coachingtahapan_targetpes2">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes2" data-page="3" name="x_targetpes2" id="x_targetpes2" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_edit->targetpes2->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_edit->targetpes2->EditValue ?>"<?php echo $t_coachingtahapan_edit->targetpes2->editAttributes() ?>>
</span>
<?php echo $t_coachingtahapan_edit->targetpes2->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $t_coachingtahapan_edit->MultiPages->pageStyle(4) ?>" id="tab_t_coachingtahapan4"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_coachingtahapan_edit->tglpelak3->Visible) { // tglpelak3 ?>
	<div id="r_tglpelak3" class="form-group row">
		<label id="elh_t_coachingtahapan_tglpelak3" for="x_tglpelak3" class="<?php echo $t_coachingtahapan_edit->LeftColumnClass ?>"><?php echo $t_coachingtahapan_edit->tglpelak3->caption() ?><?php echo $t_coachingtahapan_edit->tglpelak3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coachingtahapan_edit->RightColumnClass ?>"><div <?php echo $t_coachingtahapan_edit->tglpelak3->cellAttributes() ?>>
<span id="el_t_coachingtahapan_tglpelak3">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak3" data-page="4" name="x_tglpelak3" id="x_tglpelak3" placeholder="<?php echo HtmlEncode($t_coachingtahapan_edit->tglpelak3->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_edit->tglpelak3->EditValue ?>"<?php echo $t_coachingtahapan_edit->tglpelak3->editAttributes() ?>>
</span>
<?php echo $t_coachingtahapan_edit->tglpelak3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coachingtahapan_edit->targetpes3->Visible) { // targetpes3 ?>
	<div id="r_targetpes3" class="form-group row">
		<label id="elh_t_coachingtahapan_targetpes3" for="x_targetpes3" class="<?php echo $t_coachingtahapan_edit->LeftColumnClass ?>"><?php echo $t_coachingtahapan_edit->targetpes3->caption() ?><?php echo $t_coachingtahapan_edit->targetpes3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coachingtahapan_edit->RightColumnClass ?>"><div <?php echo $t_coachingtahapan_edit->targetpes3->cellAttributes() ?>>
<span id="el_t_coachingtahapan_targetpes3">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes3" data-page="4" name="x_targetpes3" id="x_targetpes3" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_edit->targetpes3->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_edit->targetpes3->EditValue ?>"<?php echo $t_coachingtahapan_edit->targetpes3->editAttributes() ?>>
</span>
<?php echo $t_coachingtahapan_edit->targetpes3->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $t_coachingtahapan_edit->MultiPages->pageStyle(5) ?>" id="tab_t_coachingtahapan5"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_coachingtahapan_edit->tglpelak4->Visible) { // tglpelak4 ?>
	<div id="r_tglpelak4" class="form-group row">
		<label id="elh_t_coachingtahapan_tglpelak4" for="x_tglpelak4" class="<?php echo $t_coachingtahapan_edit->LeftColumnClass ?>"><?php echo $t_coachingtahapan_edit->tglpelak4->caption() ?><?php echo $t_coachingtahapan_edit->tglpelak4->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coachingtahapan_edit->RightColumnClass ?>"><div <?php echo $t_coachingtahapan_edit->tglpelak4->cellAttributes() ?>>
<span id="el_t_coachingtahapan_tglpelak4">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak4" data-page="5" name="x_tglpelak4" id="x_tglpelak4" placeholder="<?php echo HtmlEncode($t_coachingtahapan_edit->tglpelak4->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_edit->tglpelak4->EditValue ?>"<?php echo $t_coachingtahapan_edit->tglpelak4->editAttributes() ?>>
</span>
<?php echo $t_coachingtahapan_edit->tglpelak4->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coachingtahapan_edit->targetpes4->Visible) { // targetpes4 ?>
	<div id="r_targetpes4" class="form-group row">
		<label id="elh_t_coachingtahapan_targetpes4" for="x_targetpes4" class="<?php echo $t_coachingtahapan_edit->LeftColumnClass ?>"><?php echo $t_coachingtahapan_edit->targetpes4->caption() ?><?php echo $t_coachingtahapan_edit->targetpes4->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coachingtahapan_edit->RightColumnClass ?>"><div <?php echo $t_coachingtahapan_edit->targetpes4->cellAttributes() ?>>
<span id="el_t_coachingtahapan_targetpes4">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes4" data-page="5" name="x_targetpes4" id="x_targetpes4" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_edit->targetpes4->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_edit->targetpes4->EditValue ?>"<?php echo $t_coachingtahapan_edit->targetpes4->editAttributes() ?>>
</span>
<?php echo $t_coachingtahapan_edit->targetpes4->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $t_coachingtahapan_edit->MultiPages->pageStyle(6) ?>" id="tab_t_coachingtahapan6"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_coachingtahapan_edit->tglpelak5->Visible) { // tglpelak5 ?>
	<div id="r_tglpelak5" class="form-group row">
		<label id="elh_t_coachingtahapan_tglpelak5" for="x_tglpelak5" class="<?php echo $t_coachingtahapan_edit->LeftColumnClass ?>"><?php echo $t_coachingtahapan_edit->tglpelak5->caption() ?><?php echo $t_coachingtahapan_edit->tglpelak5->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coachingtahapan_edit->RightColumnClass ?>"><div <?php echo $t_coachingtahapan_edit->tglpelak5->cellAttributes() ?>>
<span id="el_t_coachingtahapan_tglpelak5">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak5" data-page="6" name="x_tglpelak5" id="x_tglpelak5" placeholder="<?php echo HtmlEncode($t_coachingtahapan_edit->tglpelak5->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_edit->tglpelak5->EditValue ?>"<?php echo $t_coachingtahapan_edit->tglpelak5->editAttributes() ?>>
</span>
<?php echo $t_coachingtahapan_edit->tglpelak5->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coachingtahapan_edit->targetpes5->Visible) { // targetpes5 ?>
	<div id="r_targetpes5" class="form-group row">
		<label id="elh_t_coachingtahapan_targetpes5" for="x_targetpes5" class="<?php echo $t_coachingtahapan_edit->LeftColumnClass ?>"><?php echo $t_coachingtahapan_edit->targetpes5->caption() ?><?php echo $t_coachingtahapan_edit->targetpes5->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coachingtahapan_edit->RightColumnClass ?>"><div <?php echo $t_coachingtahapan_edit->targetpes5->cellAttributes() ?>>
<span id="el_t_coachingtahapan_targetpes5">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes5" data-page="6" name="x_targetpes5" id="x_targetpes5" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_edit->targetpes5->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_edit->targetpes5->EditValue ?>"<?php echo $t_coachingtahapan_edit->targetpes5->editAttributes() ?>>
</span>
<?php echo $t_coachingtahapan_edit->targetpes5->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $t_coachingtahapan_edit->MultiPages->pageStyle(7) ?>" id="tab_t_coachingtahapan7"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_coachingtahapan_edit->tglpelak6->Visible) { // tglpelak6 ?>
	<div id="r_tglpelak6" class="form-group row">
		<label id="elh_t_coachingtahapan_tglpelak6" for="x_tglpelak6" class="<?php echo $t_coachingtahapan_edit->LeftColumnClass ?>"><?php echo $t_coachingtahapan_edit->tglpelak6->caption() ?><?php echo $t_coachingtahapan_edit->tglpelak6->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coachingtahapan_edit->RightColumnClass ?>"><div <?php echo $t_coachingtahapan_edit->tglpelak6->cellAttributes() ?>>
<span id="el_t_coachingtahapan_tglpelak6">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak6" data-page="7" name="x_tglpelak6" id="x_tglpelak6" placeholder="<?php echo HtmlEncode($t_coachingtahapan_edit->tglpelak6->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_edit->tglpelak6->EditValue ?>"<?php echo $t_coachingtahapan_edit->tglpelak6->editAttributes() ?>>
</span>
<?php echo $t_coachingtahapan_edit->tglpelak6->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coachingtahapan_edit->targetpes6->Visible) { // targetpes6 ?>
	<div id="r_targetpes6" class="form-group row">
		<label id="elh_t_coachingtahapan_targetpes6" for="x_targetpes6" class="<?php echo $t_coachingtahapan_edit->LeftColumnClass ?>"><?php echo $t_coachingtahapan_edit->targetpes6->caption() ?><?php echo $t_coachingtahapan_edit->targetpes6->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coachingtahapan_edit->RightColumnClass ?>"><div <?php echo $t_coachingtahapan_edit->targetpes6->cellAttributes() ?>>
<span id="el_t_coachingtahapan_targetpes6">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes6" data-page="7" name="x_targetpes6" id="x_targetpes6" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_edit->targetpes6->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_edit->targetpes6->EditValue ?>"<?php echo $t_coachingtahapan_edit->targetpes6->editAttributes() ?>>
</span>
<?php echo $t_coachingtahapan_edit->targetpes6->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $t_coachingtahapan_edit->MultiPages->pageStyle(8) ?>" id="tab_t_coachingtahapan8"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_coachingtahapan_edit->tglpelak7->Visible) { // tglpelak7 ?>
	<div id="r_tglpelak7" class="form-group row">
		<label id="elh_t_coachingtahapan_tglpelak7" for="x_tglpelak7" class="<?php echo $t_coachingtahapan_edit->LeftColumnClass ?>"><?php echo $t_coachingtahapan_edit->tglpelak7->caption() ?><?php echo $t_coachingtahapan_edit->tglpelak7->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coachingtahapan_edit->RightColumnClass ?>"><div <?php echo $t_coachingtahapan_edit->tglpelak7->cellAttributes() ?>>
<span id="el_t_coachingtahapan_tglpelak7">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak7" data-page="8" name="x_tglpelak7" id="x_tglpelak7" placeholder="<?php echo HtmlEncode($t_coachingtahapan_edit->tglpelak7->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_edit->tglpelak7->EditValue ?>"<?php echo $t_coachingtahapan_edit->tglpelak7->editAttributes() ?>>
</span>
<?php echo $t_coachingtahapan_edit->tglpelak7->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coachingtahapan_edit->targetpes7->Visible) { // targetpes7 ?>
	<div id="r_targetpes7" class="form-group row">
		<label id="elh_t_coachingtahapan_targetpes7" for="x_targetpes7" class="<?php echo $t_coachingtahapan_edit->LeftColumnClass ?>"><?php echo $t_coachingtahapan_edit->targetpes7->caption() ?><?php echo $t_coachingtahapan_edit->targetpes7->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coachingtahapan_edit->RightColumnClass ?>"><div <?php echo $t_coachingtahapan_edit->targetpes7->cellAttributes() ?>>
<span id="el_t_coachingtahapan_targetpes7">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes7" data-page="8" name="x_targetpes7" id="x_targetpes7" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_edit->targetpes7->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_edit->targetpes7->EditValue ?>"<?php echo $t_coachingtahapan_edit->targetpes7->editAttributes() ?>>
</span>
<?php echo $t_coachingtahapan_edit->targetpes7->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $t_coachingtahapan_edit->MultiPages->pageStyle(9) ?>" id="tab_t_coachingtahapan9"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_coachingtahapan_edit->tglpelak8->Visible) { // tglpelak8 ?>
	<div id="r_tglpelak8" class="form-group row">
		<label id="elh_t_coachingtahapan_tglpelak8" for="x_tglpelak8" class="<?php echo $t_coachingtahapan_edit->LeftColumnClass ?>"><?php echo $t_coachingtahapan_edit->tglpelak8->caption() ?><?php echo $t_coachingtahapan_edit->tglpelak8->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coachingtahapan_edit->RightColumnClass ?>"><div <?php echo $t_coachingtahapan_edit->tglpelak8->cellAttributes() ?>>
<span id="el_t_coachingtahapan_tglpelak8">
<input type="text" data-table="t_coachingtahapan" data-field="x_tglpelak8" data-page="9" name="x_tglpelak8" id="x_tglpelak8" placeholder="<?php echo HtmlEncode($t_coachingtahapan_edit->tglpelak8->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_edit->tglpelak8->EditValue ?>"<?php echo $t_coachingtahapan_edit->tglpelak8->editAttributes() ?>>
</span>
<?php echo $t_coachingtahapan_edit->tglpelak8->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_coachingtahapan_edit->targetpes8->Visible) { // targetpes8 ?>
	<div id="r_targetpes8" class="form-group row">
		<label id="elh_t_coachingtahapan_targetpes8" for="x_targetpes8" class="<?php echo $t_coachingtahapan_edit->LeftColumnClass ?>"><?php echo $t_coachingtahapan_edit->targetpes8->caption() ?><?php echo $t_coachingtahapan_edit->targetpes8->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_coachingtahapan_edit->RightColumnClass ?>"><div <?php echo $t_coachingtahapan_edit->targetpes8->cellAttributes() ?>>
<span id="el_t_coachingtahapan_targetpes8">
<input type="text" data-table="t_coachingtahapan" data-field="x_targetpes8" data-page="9" name="x_targetpes8" id="x_targetpes8" size="30" placeholder="<?php echo HtmlEncode($t_coachingtahapan_edit->targetpes8->getPlaceHolder()) ?>" value="<?php echo $t_coachingtahapan_edit->targetpes8->EditValue ?>"<?php echo $t_coachingtahapan_edit->targetpes8->editAttributes() ?>>
</span>
<?php echo $t_coachingtahapan_edit->targetpes8->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page tabs .tab-content -->
</div><!-- /multi-page tabs -->
</div><!-- /multi-page -->
	<input type="hidden" data-table="t_coachingtahapan" data-field="x_ctid" name="x_ctid" id="x_ctid" value="<?php echo HtmlEncode($t_coachingtahapan_edit->ctid->CurrentValue) ?>">
<?php if (!$t_coachingtahapan_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_coachingtahapan_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_coachingtahapan_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_coachingtahapan_edit->showPageFooter();
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
$t_coachingtahapan_edit->terminate();
?>