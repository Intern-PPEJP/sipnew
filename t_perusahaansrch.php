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
$t_perusahaan_search = new t_perusahaan_search();

// Run the page
$t_perusahaan_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_perusahaan_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_perusahaansearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($t_perusahaan_search->IsModal) { ?>
	ft_perusahaansearch = currentAdvancedSearchForm = new ew.Form("ft_perusahaansearch", "search");
	<?php } else { ?>
	ft_perusahaansearch = currentForm = new ew.Form("ft_perusahaansearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	ft_perusahaansearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_idp");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_perusahaan_search->idp->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_jpeserta");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_perusahaan_search->jpeserta->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	ft_perusahaansearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_perusahaansearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_perusahaansearch.lists["x_idp"] = <?php echo $t_perusahaan_search->idp->Lookup->toClientList($t_perusahaan_search) ?>;
	ft_perusahaansearch.lists["x_idp"].options = <?php echo JsonEncode($t_perusahaan_search->idp->lookupOptions()) ?>;
	ft_perusahaansearch.autoSuggests["x_idp"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_perusahaansearch.lists["x_kdlokasi"] = <?php echo $t_perusahaan_search->kdlokasi->Lookup->toClientList($t_perusahaan_search) ?>;
	ft_perusahaansearch.lists["x_kdlokasi"].options = <?php echo JsonEncode($t_perusahaan_search->kdlokasi->lookupOptions()) ?>;
	ft_perusahaansearch.lists["x_kdprop"] = <?php echo $t_perusahaan_search->kdprop->Lookup->toClientList($t_perusahaan_search) ?>;
	ft_perusahaansearch.lists["x_kdprop"].options = <?php echo JsonEncode($t_perusahaan_search->kdprop->lookupOptions()) ?>;
	ft_perusahaansearch.lists["x_kdkota"] = <?php echo $t_perusahaan_search->kdkota->Lookup->toClientList($t_perusahaan_search) ?>;
	ft_perusahaansearch.lists["x_kdkota"].options = <?php echo JsonEncode($t_perusahaan_search->kdkota->lookupOptions()) ?>;
	ft_perusahaansearch.lists["x_kdkec"] = <?php echo $t_perusahaan_search->kdkec->Lookup->toClientList($t_perusahaan_search) ?>;
	ft_perusahaansearch.lists["x_kdkec"].options = <?php echo JsonEncode($t_perusahaan_search->kdkec->lookupOptions()) ?>;
	ft_perusahaansearch.lists["x_kdjenis"] = <?php echo $t_perusahaan_search->kdjenis->Lookup->toClientList($t_perusahaan_search) ?>;
	ft_perusahaansearch.lists["x_kdjenis"].options = <?php echo JsonEncode($t_perusahaan_search->kdjenis->lookupOptions()) ?>;
	ft_perusahaansearch.lists["x_kdproduknafed"] = <?php echo $t_perusahaan_search->kdproduknafed->Lookup->toClientList($t_perusahaan_search) ?>;
	ft_perusahaansearch.lists["x_kdproduknafed"].options = <?php echo JsonEncode($t_perusahaan_search->kdproduknafed->lookupOptions()) ?>;
	ft_perusahaansearch.lists["x_kdexport"] = <?php echo $t_perusahaan_search->kdexport->Lookup->toClientList($t_perusahaan_search) ?>;
	ft_perusahaansearch.lists["x_kdexport"].options = <?php echo JsonEncode($t_perusahaan_search->kdexport->lookupOptions()) ?>;
	ft_perusahaansearch.lists["x_kdskala"] = <?php echo $t_perusahaan_search->kdskala->Lookup->toClientList($t_perusahaan_search) ?>;
	ft_perusahaansearch.lists["x_kdskala"].options = <?php echo JsonEncode($t_perusahaan_search->kdskala->lookupOptions()) ?>;
	ft_perusahaansearch.lists["x_kdkategori"] = <?php echo $t_perusahaan_search->kdkategori->Lookup->toClientList($t_perusahaan_search) ?>;
	ft_perusahaansearch.lists["x_kdkategori"].options = <?php echo JsonEncode($t_perusahaan_search->kdkategori->lookupOptions()) ?>;
	loadjs.done("ft_perusahaansearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_perusahaan_search->showPageHeader(); ?>
<?php
$t_perusahaan_search->showMessage();
?>
<form name="ft_perusahaansearch" id="ft_perusahaansearch" class="<?php echo $t_perusahaan_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_perusahaan">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$t_perusahaan_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($t_perusahaan_search->namap->Visible) { // namap ?>
	<div id="r_namap" class="form-group row">
		<label for="x_namap" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_namap"><?php echo $t_perusahaan_search->namap->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_namap" id="z_namap" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->namap->cellAttributes() ?>>
			<span id="el_t_perusahaan_namap" class="ew-search-field">
<input type="text" data-table="t_perusahaan" data-field="x_namap" name="x_namap" id="x_namap" size="75" maxlength="150" placeholder="<?php echo HtmlEncode($t_perusahaan_search->namap->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_search->namap->EditValue ?>"<?php echo $t_perusahaan_search->namap->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->kontak->Visible) { // kontak ?>
	<div id="r_kontak" class="form-group row">
		<label for="x_kontak" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_kontak"><?php echo $t_perusahaan_search->kontak->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_kontak" id="z_kontak" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->kontak->cellAttributes() ?>>
			<span id="el_t_perusahaan_kontak" class="ew-search-field">
<input type="text" data-table="t_perusahaan" data-field="x_kontak" name="x_kontak" id="x_kontak" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($t_perusahaan_search->kontak->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_search->kontak->EditValue ?>"<?php echo $t_perusahaan_search->kontak->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->kdlokasi->Visible) { // kdlokasi ?>
	<div id="r_kdlokasi" class="form-group row">
		<label for="x_kdlokasi" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_kdlokasi"><?php echo $t_perusahaan_search->kdlokasi->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdlokasi" id="z_kdlokasi" value="=">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->kdlokasi->cellAttributes() ?>>
			<span id="el_t_perusahaan_kdlokasi" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdlokasi" data-value-separator="<?php echo $t_perusahaan_search->kdlokasi->displayValueSeparatorAttribute() ?>" id="x_kdlokasi" name="x_kdlokasi"<?php echo $t_perusahaan_search->kdlokasi->editAttributes() ?>>
			<?php echo $t_perusahaan_search->kdlokasi->selectOptionListHtml("x_kdlokasi") ?>
		</select>
</div>
<?php echo $t_perusahaan_search->kdlokasi->Lookup->getParamTag($t_perusahaan_search, "p_x_kdlokasi") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->kdprop->Visible) { // kdprop ?>
	<div id="r_kdprop" class="form-group row">
		<label for="x_kdprop" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_kdprop"><?php echo $t_perusahaan_search->kdprop->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdprop" id="z_kdprop" value="=">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->kdprop->cellAttributes() ?>>
			<span id="el_t_perusahaan_kdprop" class="ew-search-field">
<?php $t_perusahaan_search->kdprop->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdprop" data-value-separator="<?php echo $t_perusahaan_search->kdprop->displayValueSeparatorAttribute() ?>" id="x_kdprop" name="x_kdprop"<?php echo $t_perusahaan_search->kdprop->editAttributes() ?>>
			<?php echo $t_perusahaan_search->kdprop->selectOptionListHtml("x_kdprop") ?>
		</select>
</div>
<?php echo $t_perusahaan_search->kdprop->Lookup->getParamTag($t_perusahaan_search, "p_x_kdprop") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->kdkota->Visible) { // kdkota ?>
	<div id="r_kdkota" class="form-group row">
		<label for="x_kdkota" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_kdkota"><?php echo $t_perusahaan_search->kdkota->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdkota" id="z_kdkota" value="=">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->kdkota->cellAttributes() ?>>
			<span id="el_t_perusahaan_kdkota" class="ew-search-field">
<?php $t_perusahaan_search->kdkota->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdkota" data-value-separator="<?php echo $t_perusahaan_search->kdkota->displayValueSeparatorAttribute() ?>" id="x_kdkota" name="x_kdkota"<?php echo $t_perusahaan_search->kdkota->editAttributes() ?>>
			<?php echo $t_perusahaan_search->kdkota->selectOptionListHtml("x_kdkota") ?>
		</select>
</div>
<?php echo $t_perusahaan_search->kdkota->Lookup->getParamTag($t_perusahaan_search, "p_x_kdkota") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->kdkec->Visible) { // kdkec ?>
	<div id="r_kdkec" class="form-group row">
		<label for="x_kdkec" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_kdkec"><?php echo $t_perusahaan_search->kdkec->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdkec" id="z_kdkec" value="=">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->kdkec->cellAttributes() ?>>
			<span id="el_t_perusahaan_kdkec" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdkec" data-value-separator="<?php echo $t_perusahaan_search->kdkec->displayValueSeparatorAttribute() ?>" id="x_kdkec" name="x_kdkec"<?php echo $t_perusahaan_search->kdkec->editAttributes() ?>>
			<?php echo $t_perusahaan_search->kdkec->selectOptionListHtml("x_kdkec") ?>
		</select>
</div>
<?php echo $t_perusahaan_search->kdkec->Lookup->getParamTag($t_perusahaan_search, "p_x_kdkec") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->alamatp->Visible) { // alamatp ?>
	<div id="r_alamatp" class="form-group row">
		<label for="x_alamatp" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_alamatp"><?php echo $t_perusahaan_search->alamatp->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_alamatp" id="z_alamatp" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->alamatp->cellAttributes() ?>>
			<span id="el_t_perusahaan_alamatp" class="ew-search-field">
<input type="text" data-table="t_perusahaan" data-field="x_alamatp" name="x_alamatp" id="x_alamatp" size="50" placeholder="<?php echo HtmlEncode($t_perusahaan_search->alamatp->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_search->alamatp->EditValue ?>"<?php echo $t_perusahaan_search->alamatp->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->kdpos->Visible) { // kdpos ?>
	<div id="r_kdpos" class="form-group row">
		<label for="x_kdpos" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_kdpos"><?php echo $t_perusahaan_search->kdpos->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_kdpos" id="z_kdpos" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->kdpos->cellAttributes() ?>>
			<span id="el_t_perusahaan_kdpos" class="ew-search-field">
<input type="text" data-table="t_perusahaan" data-field="x_kdpos" name="x_kdpos" id="x_kdpos" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_perusahaan_search->kdpos->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_search->kdpos->EditValue ?>"<?php echo $t_perusahaan_search->kdpos->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->telpp->Visible) { // telpp ?>
	<div id="r_telpp" class="form-group row">
		<label for="x_telpp" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_telpp"><?php echo $t_perusahaan_search->telpp->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_telpp" id="z_telpp" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->telpp->cellAttributes() ?>>
			<span id="el_t_perusahaan_telpp" class="ew-search-field">
<input type="text" data-table="t_perusahaan" data-field="x_telpp" name="x_telpp" id="x_telpp" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_search->telpp->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_search->telpp->EditValue ?>"<?php echo $t_perusahaan_search->telpp->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->faxp->Visible) { // faxp ?>
	<div id="r_faxp" class="form-group row">
		<label for="x_faxp" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_faxp"><?php echo $t_perusahaan_search->faxp->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_faxp" id="z_faxp" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->faxp->cellAttributes() ?>>
			<span id="el_t_perusahaan_faxp" class="ew-search-field">
<input type="text" data-table="t_perusahaan" data-field="x_faxp" name="x_faxp" id="x_faxp" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_search->faxp->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_search->faxp->EditValue ?>"<?php echo $t_perusahaan_search->faxp->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->emailp->Visible) { // emailp ?>
	<div id="r_emailp" class="form-group row">
		<label for="x_emailp" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_emailp"><?php echo $t_perusahaan_search->emailp->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_emailp" id="z_emailp" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->emailp->cellAttributes() ?>>
			<span id="el_t_perusahaan_emailp" class="ew-search-field">
<input type="text" data-table="t_perusahaan" data-field="x_emailp" name="x_emailp" id="x_emailp" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_search->emailp->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_search->emailp->EditValue ?>"<?php echo $t_perusahaan_search->emailp->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->webp->Visible) { // webp ?>
	<div id="r_webp" class="form-group row">
		<label for="x_webp" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_webp"><?php echo $t_perusahaan_search->webp->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_webp" id="z_webp" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->webp->cellAttributes() ?>>
			<span id="el_t_perusahaan_webp" class="ew-search-field">
<input type="text" data-table="t_perusahaan" data-field="x_webp" name="x_webp" id="x_webp" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_search->webp->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_search->webp->EditValue ?>"<?php echo $t_perusahaan_search->webp->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->kdjenis->Visible) { // kdjenis ?>
	<div id="r_kdjenis" class="form-group row">
		<label for="x_kdjenis" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_kdjenis"><?php echo $t_perusahaan_search->kdjenis->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdjenis" id="z_kdjenis" value="=">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->kdjenis->cellAttributes() ?>>
			<span id="el_t_perusahaan_kdjenis" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdjenis" data-value-separator="<?php echo $t_perusahaan_search->kdjenis->displayValueSeparatorAttribute() ?>" id="x_kdjenis" name="x_kdjenis"<?php echo $t_perusahaan_search->kdjenis->editAttributes() ?>>
			<?php echo $t_perusahaan_search->kdjenis->selectOptionListHtml("x_kdjenis") ?>
		</select>
</div>
<?php echo $t_perusahaan_search->kdjenis->Lookup->getParamTag($t_perusahaan_search, "p_x_kdjenis") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->kdproduknafed->Visible) { // kdproduknafed ?>
	<div id="r_kdproduknafed" class="form-group row">
		<label for="x_kdproduknafed" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_kdproduknafed"><?php echo $t_perusahaan_search->kdproduknafed->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdproduknafed" id="z_kdproduknafed" value="=">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->kdproduknafed->cellAttributes() ?>>
			<span id="el_t_perusahaan_kdproduknafed" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdproduknafed" data-value-separator="<?php echo $t_perusahaan_search->kdproduknafed->displayValueSeparatorAttribute() ?>" id="x_kdproduknafed" name="x_kdproduknafed"<?php echo $t_perusahaan_search->kdproduknafed->editAttributes() ?>>
			<?php echo $t_perusahaan_search->kdproduknafed->selectOptionListHtml("x_kdproduknafed") ?>
		</select>
</div>
<?php echo $t_perusahaan_search->kdproduknafed->Lookup->getParamTag($t_perusahaan_search, "p_x_kdproduknafed") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->pproduk->Visible) { // pproduk ?>
	<div id="r_pproduk" class="form-group row">
		<label for="x_pproduk" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_pproduk"><?php echo $t_perusahaan_search->pproduk->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_pproduk" id="z_pproduk" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->pproduk->cellAttributes() ?>>
			<span id="el_t_perusahaan_pproduk" class="ew-search-field">
<input type="text" data-table="t_perusahaan" data-field="x_pproduk" name="x_pproduk" id="x_pproduk" size="50" placeholder="<?php echo HtmlEncode($t_perusahaan_search->pproduk->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_search->pproduk->EditValue ?>"<?php echo $t_perusahaan_search->pproduk->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->kdexport->Visible) { // kdexport ?>
	<div id="r_kdexport" class="form-group row">
		<label for="x_kdexport" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_kdexport"><?php echo $t_perusahaan_search->kdexport->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdexport" id="z_kdexport" value="=">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->kdexport->cellAttributes() ?>>
			<span id="el_t_perusahaan_kdexport" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdexport" data-value-separator="<?php echo $t_perusahaan_search->kdexport->displayValueSeparatorAttribute() ?>" id="x_kdexport" name="x_kdexport"<?php echo $t_perusahaan_search->kdexport->editAttributes() ?>>
			<?php echo $t_perusahaan_search->kdexport->selectOptionListHtml("x_kdexport") ?>
		</select>
</div>
<?php echo $t_perusahaan_search->kdexport->Lookup->getParamTag($t_perusahaan_search, "p_x_kdexport") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->nexport->Visible) { // nexport ?>
	<div id="r_nexport" class="form-group row">
		<label for="x_nexport" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_nexport"><?php echo $t_perusahaan_search->nexport->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nexport" id="z_nexport" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->nexport->cellAttributes() ?>>
			<span id="el_t_perusahaan_nexport" class="ew-search-field">
<input type="text" data-table="t_perusahaan" data-field="x_nexport" name="x_nexport" id="x_nexport" size="50" placeholder="<?php echo HtmlEncode($t_perusahaan_search->nexport->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_search->nexport->EditValue ?>"<?php echo $t_perusahaan_search->nexport->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->kdskala->Visible) { // kdskala ?>
	<div id="r_kdskala" class="form-group row">
		<label for="x_kdskala" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_kdskala"><?php echo $t_perusahaan_search->kdskala->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdskala" id="z_kdskala" value="=">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->kdskala->cellAttributes() ?>>
			<span id="el_t_perusahaan_kdskala" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdskala" data-value-separator="<?php echo $t_perusahaan_search->kdskala->displayValueSeparatorAttribute() ?>" id="x_kdskala" name="x_kdskala"<?php echo $t_perusahaan_search->kdskala->editAttributes() ?>>
			<?php echo $t_perusahaan_search->kdskala->selectOptionListHtml("x_kdskala") ?>
		</select>
</div>
<?php echo $t_perusahaan_search->kdskala->Lookup->getParamTag($t_perusahaan_search, "p_x_kdskala") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->kdkategori->Visible) { // kdkategori ?>
	<div id="r_kdkategori" class="form-group row">
		<label for="x_kdkategori" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_kdkategori"><?php echo $t_perusahaan_search->kdkategori->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdkategori" id="z_kdkategori" value="=">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->kdkategori->cellAttributes() ?>>
			<span id="el_t_perusahaan_kdkategori" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdkategori" data-value-separator="<?php echo $t_perusahaan_search->kdkategori->displayValueSeparatorAttribute() ?>" id="x_kdkategori" name="x_kdkategori"<?php echo $t_perusahaan_search->kdkategori->editAttributes() ?>>
			<?php echo $t_perusahaan_search->kdkategori->selectOptionListHtml("x_kdkategori") ?>
		</select>
</div>
<?php echo $t_perusahaan_search->kdkategori->Lookup->getParamTag($t_perusahaan_search, "p_x_kdkategori") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->omzet_saat_ini->Visible) { // omzet_saat_ini ?>
	<div id="r_omzet_saat_ini" class="form-group row">
		<label for="x_omzet_saat_ini" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_omzet_saat_ini"><?php echo $t_perusahaan_search->omzet_saat_ini->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_omzet_saat_ini" id="z_omzet_saat_ini" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->omzet_saat_ini->cellAttributes() ?>>
			<span id="el_t_perusahaan_omzet_saat_ini" class="ew-search-field">
<input type="text" data-table="t_perusahaan" data-field="x_omzet_saat_ini" name="x_omzet_saat_ini" id="x_omzet_saat_ini" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_search->omzet_saat_ini->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_search->omzet_saat_ini->EditValue ?>"<?php echo $t_perusahaan_search->omzet_saat_ini->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->kapasitas_saat_ini->Visible) { // kapasitas_saat_ini ?>
	<div id="r_kapasitas_saat_ini" class="form-group row">
		<label for="x_kapasitas_saat_ini" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_kapasitas_saat_ini"><?php echo $t_perusahaan_search->kapasitas_saat_ini->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_kapasitas_saat_ini" id="z_kapasitas_saat_ini" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->kapasitas_saat_ini->cellAttributes() ?>>
			<span id="el_t_perusahaan_kapasitas_saat_ini" class="ew-search-field">
<input type="text" data-table="t_perusahaan" data-field="x_kapasitas_saat_ini" name="x_kapasitas_saat_ini" id="x_kapasitas_saat_ini" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_search->kapasitas_saat_ini->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_search->kapasitas_saat_ini->EditValue ?>"<?php echo $t_perusahaan_search->kapasitas_saat_ini->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->kapasitas_stl_1thn->Visible) { // kapasitas_stl_1thn ?>
	<div id="r_kapasitas_stl_1thn" class="form-group row">
		<label for="x_kapasitas_stl_1thn" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_kapasitas_stl_1thn"><?php echo $t_perusahaan_search->kapasitas_stl_1thn->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_kapasitas_stl_1thn" id="z_kapasitas_stl_1thn" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->kapasitas_stl_1thn->cellAttributes() ?>>
			<span id="el_t_perusahaan_kapasitas_stl_1thn" class="ew-search-field">
<input type="text" data-table="t_perusahaan" data-field="x_kapasitas_stl_1thn" name="x_kapasitas_stl_1thn" id="x_kapasitas_stl_1thn" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_search->kapasitas_stl_1thn->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_search->kapasitas_stl_1thn->EditValue ?>"<?php echo $t_perusahaan_search->kapasitas_stl_1thn->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->kapasitas_stl_2thn->Visible) { // kapasitas_stl_2thn ?>
	<div id="r_kapasitas_stl_2thn" class="form-group row">
		<label for="x_kapasitas_stl_2thn" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_kapasitas_stl_2thn"><?php echo $t_perusahaan_search->kapasitas_stl_2thn->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_kapasitas_stl_2thn" id="z_kapasitas_stl_2thn" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->kapasitas_stl_2thn->cellAttributes() ?>>
			<span id="el_t_perusahaan_kapasitas_stl_2thn" class="ew-search-field">
<input type="text" data-table="t_perusahaan" data-field="x_kapasitas_stl_2thn" name="x_kapasitas_stl_2thn" id="x_kapasitas_stl_2thn" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_search->kapasitas_stl_2thn->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_search->kapasitas_stl_2thn->EditValue ?>"<?php echo $t_perusahaan_search->kapasitas_stl_2thn->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_search->jpeserta->Visible) { // jpeserta ?>
	<div id="r_jpeserta" class="form-group row">
		<label for="x_jpeserta" class="<?php echo $t_perusahaan_search->LeftColumnClass ?>"><span id="elh_t_perusahaan_jpeserta"><?php echo $t_perusahaan_search->jpeserta->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jpeserta" id="z_jpeserta" value="=">
</span>
		</label>
		<div class="<?php echo $t_perusahaan_search->RightColumnClass ?>"><div <?php echo $t_perusahaan_search->jpeserta->cellAttributes() ?>>
			<span id="el_t_perusahaan_jpeserta" class="ew-search-field">
<input type="text" data-table="t_perusahaan" data-field="x_jpeserta" name="x_jpeserta" id="x_jpeserta" size="30" placeholder="<?php echo HtmlEncode($t_perusahaan_search->jpeserta->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_search->jpeserta->EditValue ?>"<?php echo $t_perusahaan_search->jpeserta->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_perusahaan_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_perusahaan_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_perusahaan_search->showPageFooter();
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
$t_perusahaan_search->terminate();
?>