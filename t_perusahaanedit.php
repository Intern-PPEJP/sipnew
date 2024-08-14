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
$t_perusahaan_edit = new t_perusahaan_edit();

// Run the page
$t_perusahaan_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_perusahaan_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_perusahaanedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_perusahaanedit = currentForm = new ew.Form("ft_perusahaanedit", "edit");

	// Validate form
	ft_perusahaanedit.validate = function() {
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
			<?php if ($t_perusahaan_edit->namap->Required) { ?>
				elm = this.getElements("x" + infix + "_namap");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->namap->caption(), $t_perusahaan_edit->namap->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->kontak->Required) { ?>
				elm = this.getElements("x" + infix + "_kontak");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->kontak->caption(), $t_perusahaan_edit->kontak->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->kdlokasi->Required) { ?>
				elm = this.getElements("x" + infix + "_kdlokasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->kdlokasi->caption(), $t_perusahaan_edit->kdlokasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->kdprop->Required) { ?>
				elm = this.getElements("x" + infix + "_kdprop");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->kdprop->caption(), $t_perusahaan_edit->kdprop->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->kdkota->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkota");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->kdkota->caption(), $t_perusahaan_edit->kdkota->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->kdkec->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkec");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->kdkec->caption(), $t_perusahaan_edit->kdkec->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->alamatp->Required) { ?>
				elm = this.getElements("x" + infix + "_alamatp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->alamatp->caption(), $t_perusahaan_edit->alamatp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->kdpos->Required) { ?>
				elm = this.getElements("x" + infix + "_kdpos");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->kdpos->caption(), $t_perusahaan_edit->kdpos->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->telpp->Required) { ?>
				elm = this.getElements("x" + infix + "_telpp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->telpp->caption(), $t_perusahaan_edit->telpp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->faxp->Required) { ?>
				elm = this.getElements("x" + infix + "_faxp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->faxp->caption(), $t_perusahaan_edit->faxp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->emailp->Required) { ?>
				elm = this.getElements("x" + infix + "_emailp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->emailp->caption(), $t_perusahaan_edit->emailp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->webp->Required) { ?>
				elm = this.getElements("x" + infix + "_webp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->webp->caption(), $t_perusahaan_edit->webp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->medsos->Required) { ?>
				elm = this.getElements("x" + infix + "_medsos");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->medsos->caption(), $t_perusahaan_edit->medsos->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->kdjenis->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjenis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->kdjenis->caption(), $t_perusahaan_edit->kdjenis->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->kdproduknafed->Required) { ?>
				elm = this.getElements("x" + infix + "_kdproduknafed");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->kdproduknafed->caption(), $t_perusahaan_edit->kdproduknafed->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->kdproduknafed2->Required) { ?>
				elm = this.getElements("x" + infix + "_kdproduknafed2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->kdproduknafed2->caption(), $t_perusahaan_edit->kdproduknafed2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->kdproduknafed3->Required) { ?>
				elm = this.getElements("x" + infix + "_kdproduknafed3");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->kdproduknafed3->caption(), $t_perusahaan_edit->kdproduknafed3->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->pproduk->Required) { ?>
				elm = this.getElements("x" + infix + "_pproduk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->pproduk->caption(), $t_perusahaan_edit->pproduk->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->kdexport->Required) { ?>
				elm = this.getElements("x" + infix + "_kdexport");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->kdexport->caption(), $t_perusahaan_edit->kdexport->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->nexport->Required) { ?>
				elm = this.getElements("x" + infix + "_nexport");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->nexport->caption(), $t_perusahaan_edit->nexport->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->kdskala->Required) { ?>
				elm = this.getElements("x" + infix + "_kdskala");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->kdskala->caption(), $t_perusahaan_edit->kdskala->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->kdkategori->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkategori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->kdkategori->caption(), $t_perusahaan_edit->kdkategori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->omzet_saat_ini->Required) { ?>
				elm = this.getElements("x" + infix + "_omzet_saat_ini");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->omzet_saat_ini->caption(), $t_perusahaan_edit->omzet_saat_ini->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->kapasitas_saat_ini->Required) { ?>
				elm = this.getElements("x" + infix + "_kapasitas_saat_ini");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->kapasitas_saat_ini->caption(), $t_perusahaan_edit->kapasitas_saat_ini->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->kapasitas_stl_1thn->Required) { ?>
				elm = this.getElements("x" + infix + "_kapasitas_stl_1thn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->kapasitas_stl_1thn->caption(), $t_perusahaan_edit->kapasitas_stl_1thn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->kapasitas_stl_2thn->Required) { ?>
				elm = this.getElements("x" + infix + "_kapasitas_stl_2thn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->kapasitas_stl_2thn->caption(), $t_perusahaan_edit->kapasitas_stl_2thn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->updated_at->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->updated_at->caption(), $t_perusahaan_edit->updated_at->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_edit->user_updated_by->Required) { ?>
				elm = this.getElements("x" + infix + "_user_updated_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_edit->user_updated_by->caption(), $t_perusahaan_edit->user_updated_by->RequiredErrorMessage)) ?>");
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
	ft_perusahaanedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_perusahaanedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_perusahaanedit.lists["x_kdlokasi"] = <?php echo $t_perusahaan_edit->kdlokasi->Lookup->toClientList($t_perusahaan_edit) ?>;
	ft_perusahaanedit.lists["x_kdlokasi"].options = <?php echo JsonEncode($t_perusahaan_edit->kdlokasi->lookupOptions()) ?>;
	ft_perusahaanedit.lists["x_kdprop"] = <?php echo $t_perusahaan_edit->kdprop->Lookup->toClientList($t_perusahaan_edit) ?>;
	ft_perusahaanedit.lists["x_kdprop"].options = <?php echo JsonEncode($t_perusahaan_edit->kdprop->lookupOptions()) ?>;
	ft_perusahaanedit.lists["x_kdkota"] = <?php echo $t_perusahaan_edit->kdkota->Lookup->toClientList($t_perusahaan_edit) ?>;
	ft_perusahaanedit.lists["x_kdkota"].options = <?php echo JsonEncode($t_perusahaan_edit->kdkota->lookupOptions()) ?>;
	ft_perusahaanedit.lists["x_kdkec"] = <?php echo $t_perusahaan_edit->kdkec->Lookup->toClientList($t_perusahaan_edit) ?>;
	ft_perusahaanedit.lists["x_kdkec"].options = <?php echo JsonEncode($t_perusahaan_edit->kdkec->lookupOptions()) ?>;
	ft_perusahaanedit.lists["x_kdjenis"] = <?php echo $t_perusahaan_edit->kdjenis->Lookup->toClientList($t_perusahaan_edit) ?>;
	ft_perusahaanedit.lists["x_kdjenis"].options = <?php echo JsonEncode($t_perusahaan_edit->kdjenis->lookupOptions()) ?>;
	ft_perusahaanedit.lists["x_kdproduknafed"] = <?php echo $t_perusahaan_edit->kdproduknafed->Lookup->toClientList($t_perusahaan_edit) ?>;
	ft_perusahaanedit.lists["x_kdproduknafed"].options = <?php echo JsonEncode($t_perusahaan_edit->kdproduknafed->lookupOptions()) ?>;
	ft_perusahaanedit.lists["x_kdproduknafed2"] = <?php echo $t_perusahaan_edit->kdproduknafed2->Lookup->toClientList($t_perusahaan_edit) ?>;
	ft_perusahaanedit.lists["x_kdproduknafed2"].options = <?php echo JsonEncode($t_perusahaan_edit->kdproduknafed2->lookupOptions()) ?>;
	ft_perusahaanedit.lists["x_kdproduknafed3"] = <?php echo $t_perusahaan_edit->kdproduknafed3->Lookup->toClientList($t_perusahaan_edit) ?>;
	ft_perusahaanedit.lists["x_kdproduknafed3"].options = <?php echo JsonEncode($t_perusahaan_edit->kdproduknafed3->lookupOptions()) ?>;
	ft_perusahaanedit.lists["x_kdexport"] = <?php echo $t_perusahaan_edit->kdexport->Lookup->toClientList($t_perusahaan_edit) ?>;
	ft_perusahaanedit.lists["x_kdexport"].options = <?php echo JsonEncode($t_perusahaan_edit->kdexport->lookupOptions()) ?>;
	ft_perusahaanedit.lists["x_kdskala"] = <?php echo $t_perusahaan_edit->kdskala->Lookup->toClientList($t_perusahaan_edit) ?>;
	ft_perusahaanedit.lists["x_kdskala"].options = <?php echo JsonEncode($t_perusahaan_edit->kdskala->lookupOptions()) ?>;
	ft_perusahaanedit.lists["x_kdkategori"] = <?php echo $t_perusahaan_edit->kdkategori->Lookup->toClientList($t_perusahaan_edit) ?>;
	ft_perusahaanedit.lists["x_kdkategori"].options = <?php echo JsonEncode($t_perusahaan_edit->kdkategori->lookupOptions()) ?>;
	loadjs.done("ft_perusahaanedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//document.write('<?php echo cs_judul("edit","Perusahaan : Mengubah Data");?>');

});
</script>
<?php $t_perusahaan_edit->showPageHeader(); ?>
<?php
$t_perusahaan_edit->showMessage();
?>
<form name="ft_perusahaanedit" id="ft_perusahaanedit" class="<?php echo $t_perusahaan_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_perusahaan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_perusahaan_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_perusahaan_edit->namap->Visible) { // namap ?>
	<div id="r_namap" class="form-group row">
		<label id="elh_t_perusahaan_namap" for="x_namap" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->namap->caption() ?><?php echo $t_perusahaan_edit->namap->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->namap->cellAttributes() ?>>
<span id="el_t_perusahaan_namap">
<input type="text" data-table="t_perusahaan" data-field="x_namap" name="x_namap" id="x_namap" size="75" maxlength="150" placeholder="<?php echo HtmlEncode($t_perusahaan_edit->namap->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_edit->namap->EditValue ?>"<?php echo $t_perusahaan_edit->namap->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_edit->namap->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->kontak->Visible) { // kontak ?>
	<div id="r_kontak" class="form-group row">
		<label id="elh_t_perusahaan_kontak" for="x_kontak" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->kontak->caption() ?><?php echo $t_perusahaan_edit->kontak->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->kontak->cellAttributes() ?>>
<span id="el_t_perusahaan_kontak">
<input type="text" data-table="t_perusahaan" data-field="x_kontak" name="x_kontak" id="x_kontak" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($t_perusahaan_edit->kontak->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_edit->kontak->EditValue ?>"<?php echo $t_perusahaan_edit->kontak->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_edit->kontak->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->kdlokasi->Visible) { // kdlokasi ?>
	<div id="r_kdlokasi" class="form-group row">
		<label id="elh_t_perusahaan_kdlokasi" for="x_kdlokasi" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->kdlokasi->caption() ?><?php echo $t_perusahaan_edit->kdlokasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->kdlokasi->cellAttributes() ?>>
<span id="el_t_perusahaan_kdlokasi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdlokasi" data-value-separator="<?php echo $t_perusahaan_edit->kdlokasi->displayValueSeparatorAttribute() ?>" id="x_kdlokasi" name="x_kdlokasi"<?php echo $t_perusahaan_edit->kdlokasi->editAttributes() ?>>
			<?php echo $t_perusahaan_edit->kdlokasi->selectOptionListHtml("x_kdlokasi") ?>
		</select>
</div>
<?php echo $t_perusahaan_edit->kdlokasi->Lookup->getParamTag($t_perusahaan_edit, "p_x_kdlokasi") ?>
</span>
<?php echo $t_perusahaan_edit->kdlokasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->kdprop->Visible) { // kdprop ?>
	<div id="r_kdprop" class="form-group row">
		<label id="elh_t_perusahaan_kdprop" for="x_kdprop" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->kdprop->caption() ?><?php echo $t_perusahaan_edit->kdprop->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->kdprop->cellAttributes() ?>>
<span id="el_t_perusahaan_kdprop">
<?php $t_perusahaan_edit->kdprop->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdprop" data-value-separator="<?php echo $t_perusahaan_edit->kdprop->displayValueSeparatorAttribute() ?>" id="x_kdprop" name="x_kdprop"<?php echo $t_perusahaan_edit->kdprop->editAttributes() ?>>
			<?php echo $t_perusahaan_edit->kdprop->selectOptionListHtml("x_kdprop") ?>
		</select>
</div>
<?php echo $t_perusahaan_edit->kdprop->Lookup->getParamTag($t_perusahaan_edit, "p_x_kdprop") ?>
</span>
<?php echo $t_perusahaan_edit->kdprop->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->kdkota->Visible) { // kdkota ?>
	<div id="r_kdkota" class="form-group row">
		<label id="elh_t_perusahaan_kdkota" for="x_kdkota" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->kdkota->caption() ?><?php echo $t_perusahaan_edit->kdkota->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->kdkota->cellAttributes() ?>>
<span id="el_t_perusahaan_kdkota">
<?php $t_perusahaan_edit->kdkota->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdkota" data-value-separator="<?php echo $t_perusahaan_edit->kdkota->displayValueSeparatorAttribute() ?>" id="x_kdkota" name="x_kdkota"<?php echo $t_perusahaan_edit->kdkota->editAttributes() ?>>
			<?php echo $t_perusahaan_edit->kdkota->selectOptionListHtml("x_kdkota") ?>
		</select>
</div>
<?php echo $t_perusahaan_edit->kdkota->Lookup->getParamTag($t_perusahaan_edit, "p_x_kdkota") ?>
</span>
<?php echo $t_perusahaan_edit->kdkota->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->kdkec->Visible) { // kdkec ?>
	<div id="r_kdkec" class="form-group row">
		<label id="elh_t_perusahaan_kdkec" for="x_kdkec" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->kdkec->caption() ?><?php echo $t_perusahaan_edit->kdkec->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->kdkec->cellAttributes() ?>>
<span id="el_t_perusahaan_kdkec">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdkec" data-value-separator="<?php echo $t_perusahaan_edit->kdkec->displayValueSeparatorAttribute() ?>" id="x_kdkec" name="x_kdkec"<?php echo $t_perusahaan_edit->kdkec->editAttributes() ?>>
			<?php echo $t_perusahaan_edit->kdkec->selectOptionListHtml("x_kdkec") ?>
		</select>
</div>
<?php echo $t_perusahaan_edit->kdkec->Lookup->getParamTag($t_perusahaan_edit, "p_x_kdkec") ?>
</span>
<?php echo $t_perusahaan_edit->kdkec->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->alamatp->Visible) { // alamatp ?>
	<div id="r_alamatp" class="form-group row">
		<label id="elh_t_perusahaan_alamatp" for="x_alamatp" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->alamatp->caption() ?><?php echo $t_perusahaan_edit->alamatp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->alamatp->cellAttributes() ?>>
<span id="el_t_perusahaan_alamatp">
<textarea data-table="t_perusahaan" data-field="x_alamatp" name="x_alamatp" id="x_alamatp" cols="50" rows="2" placeholder="<?php echo HtmlEncode($t_perusahaan_edit->alamatp->getPlaceHolder()) ?>"<?php echo $t_perusahaan_edit->alamatp->editAttributes() ?>><?php echo $t_perusahaan_edit->alamatp->EditValue ?></textarea>
</span>
<?php echo $t_perusahaan_edit->alamatp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->kdpos->Visible) { // kdpos ?>
	<div id="r_kdpos" class="form-group row">
		<label id="elh_t_perusahaan_kdpos" for="x_kdpos" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->kdpos->caption() ?><?php echo $t_perusahaan_edit->kdpos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->kdpos->cellAttributes() ?>>
<span id="el_t_perusahaan_kdpos">
<input type="text" data-table="t_perusahaan" data-field="x_kdpos" name="x_kdpos" id="x_kdpos" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_perusahaan_edit->kdpos->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_edit->kdpos->EditValue ?>"<?php echo $t_perusahaan_edit->kdpos->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_edit->kdpos->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->telpp->Visible) { // telpp ?>
	<div id="r_telpp" class="form-group row">
		<label id="elh_t_perusahaan_telpp" for="x_telpp" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->telpp->caption() ?><?php echo $t_perusahaan_edit->telpp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->telpp->cellAttributes() ?>>
<span id="el_t_perusahaan_telpp">
<input type="text" data-table="t_perusahaan" data-field="x_telpp" name="x_telpp" id="x_telpp" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_edit->telpp->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_edit->telpp->EditValue ?>"<?php echo $t_perusahaan_edit->telpp->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_edit->telpp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->faxp->Visible) { // faxp ?>
	<div id="r_faxp" class="form-group row">
		<label id="elh_t_perusahaan_faxp" for="x_faxp" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->faxp->caption() ?><?php echo $t_perusahaan_edit->faxp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->faxp->cellAttributes() ?>>
<span id="el_t_perusahaan_faxp">
<input type="text" data-table="t_perusahaan" data-field="x_faxp" name="x_faxp" id="x_faxp" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_edit->faxp->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_edit->faxp->EditValue ?>"<?php echo $t_perusahaan_edit->faxp->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_edit->faxp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->emailp->Visible) { // emailp ?>
	<div id="r_emailp" class="form-group row">
		<label id="elh_t_perusahaan_emailp" for="x_emailp" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->emailp->caption() ?><?php echo $t_perusahaan_edit->emailp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->emailp->cellAttributes() ?>>
<span id="el_t_perusahaan_emailp">
<input type="text" data-table="t_perusahaan" data-field="x_emailp" name="x_emailp" id="x_emailp" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_edit->emailp->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_edit->emailp->EditValue ?>"<?php echo $t_perusahaan_edit->emailp->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_edit->emailp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->webp->Visible) { // webp ?>
	<div id="r_webp" class="form-group row">
		<label id="elh_t_perusahaan_webp" for="x_webp" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->webp->caption() ?><?php echo $t_perusahaan_edit->webp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->webp->cellAttributes() ?>>
<span id="el_t_perusahaan_webp">
<input type="text" data-table="t_perusahaan" data-field="x_webp" name="x_webp" id="x_webp" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_edit->webp->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_edit->webp->EditValue ?>"<?php echo $t_perusahaan_edit->webp->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_edit->webp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->medsos->Visible) { // medsos ?>
	<div id="r_medsos" class="form-group row">
		<label id="elh_t_perusahaan_medsos" for="x_medsos" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->medsos->caption() ?><?php echo $t_perusahaan_edit->medsos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->medsos->cellAttributes() ?>>
<span id="el_t_perusahaan_medsos">
<input type="text" data-table="t_perusahaan" data-field="x_medsos" name="x_medsos" id="x_medsos" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_edit->medsos->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_edit->medsos->EditValue ?>"<?php echo $t_perusahaan_edit->medsos->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_edit->medsos->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->kdjenis->Visible) { // kdjenis ?>
	<div id="r_kdjenis" class="form-group row">
		<label id="elh_t_perusahaan_kdjenis" for="x_kdjenis" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->kdjenis->caption() ?><?php echo $t_perusahaan_edit->kdjenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->kdjenis->cellAttributes() ?>>
<span id="el_t_perusahaan_kdjenis">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdjenis" data-value-separator="<?php echo $t_perusahaan_edit->kdjenis->displayValueSeparatorAttribute() ?>" id="x_kdjenis" name="x_kdjenis"<?php echo $t_perusahaan_edit->kdjenis->editAttributes() ?>>
			<?php echo $t_perusahaan_edit->kdjenis->selectOptionListHtml("x_kdjenis") ?>
		</select>
</div>
<?php echo $t_perusahaan_edit->kdjenis->Lookup->getParamTag($t_perusahaan_edit, "p_x_kdjenis") ?>
</span>
<?php echo $t_perusahaan_edit->kdjenis->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->kdproduknafed->Visible) { // kdproduknafed ?>
	<div id="r_kdproduknafed" class="form-group row">
		<label id="elh_t_perusahaan_kdproduknafed" for="x_kdproduknafed" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->kdproduknafed->caption() ?><?php echo $t_perusahaan_edit->kdproduknafed->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->kdproduknafed->cellAttributes() ?>>
<span id="el_t_perusahaan_kdproduknafed">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdproduknafed" data-value-separator="<?php echo $t_perusahaan_edit->kdproduknafed->displayValueSeparatorAttribute() ?>" id="x_kdproduknafed" name="x_kdproduknafed"<?php echo $t_perusahaan_edit->kdproduknafed->editAttributes() ?>>
			<?php echo $t_perusahaan_edit->kdproduknafed->selectOptionListHtml("x_kdproduknafed") ?>
		</select>
</div>
<?php echo $t_perusahaan_edit->kdproduknafed->Lookup->getParamTag($t_perusahaan_edit, "p_x_kdproduknafed") ?>
</span>
<?php echo $t_perusahaan_edit->kdproduknafed->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->kdproduknafed2->Visible) { // kdproduknafed2 ?>
	<div id="r_kdproduknafed2" class="form-group row">
		<label id="elh_t_perusahaan_kdproduknafed2" for="x_kdproduknafed2" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->kdproduknafed2->caption() ?><?php echo $t_perusahaan_edit->kdproduknafed2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->kdproduknafed2->cellAttributes() ?>>
<span id="el_t_perusahaan_kdproduknafed2">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdproduknafed2" data-value-separator="<?php echo $t_perusahaan_edit->kdproduknafed2->displayValueSeparatorAttribute() ?>" id="x_kdproduknafed2" name="x_kdproduknafed2"<?php echo $t_perusahaan_edit->kdproduknafed2->editAttributes() ?>>
			<?php echo $t_perusahaan_edit->kdproduknafed2->selectOptionListHtml("x_kdproduknafed2") ?>
		</select>
</div>
<?php echo $t_perusahaan_edit->kdproduknafed2->Lookup->getParamTag($t_perusahaan_edit, "p_x_kdproduknafed2") ?>
</span>
<?php echo $t_perusahaan_edit->kdproduknafed2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->kdproduknafed3->Visible) { // kdproduknafed3 ?>
	<div id="r_kdproduknafed3" class="form-group row">
		<label id="elh_t_perusahaan_kdproduknafed3" for="x_kdproduknafed3" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->kdproduknafed3->caption() ?><?php echo $t_perusahaan_edit->kdproduknafed3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->kdproduknafed3->cellAttributes() ?>>
<span id="el_t_perusahaan_kdproduknafed3">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdproduknafed3" data-value-separator="<?php echo $t_perusahaan_edit->kdproduknafed3->displayValueSeparatorAttribute() ?>" id="x_kdproduknafed3" name="x_kdproduknafed3"<?php echo $t_perusahaan_edit->kdproduknafed3->editAttributes() ?>>
			<?php echo $t_perusahaan_edit->kdproduknafed3->selectOptionListHtml("x_kdproduknafed3") ?>
		</select>
</div>
<?php echo $t_perusahaan_edit->kdproduknafed3->Lookup->getParamTag($t_perusahaan_edit, "p_x_kdproduknafed3") ?>
</span>
<?php echo $t_perusahaan_edit->kdproduknafed3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->pproduk->Visible) { // pproduk ?>
	<div id="r_pproduk" class="form-group row">
		<label id="elh_t_perusahaan_pproduk" for="x_pproduk" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->pproduk->caption() ?><?php echo $t_perusahaan_edit->pproduk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->pproduk->cellAttributes() ?>>
<span id="el_t_perusahaan_pproduk">
<textarea data-table="t_perusahaan" data-field="x_pproduk" name="x_pproduk" id="x_pproduk" cols="50" rows="4" placeholder="<?php echo HtmlEncode($t_perusahaan_edit->pproduk->getPlaceHolder()) ?>"<?php echo $t_perusahaan_edit->pproduk->editAttributes() ?>><?php echo $t_perusahaan_edit->pproduk->EditValue ?></textarea>
</span>
<?php echo $t_perusahaan_edit->pproduk->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->kdexport->Visible) { // kdexport ?>
	<div id="r_kdexport" class="form-group row">
		<label id="elh_t_perusahaan_kdexport" for="x_kdexport" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->kdexport->caption() ?><?php echo $t_perusahaan_edit->kdexport->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->kdexport->cellAttributes() ?>>
<span id="el_t_perusahaan_kdexport">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdexport" data-value-separator="<?php echo $t_perusahaan_edit->kdexport->displayValueSeparatorAttribute() ?>" id="x_kdexport" name="x_kdexport"<?php echo $t_perusahaan_edit->kdexport->editAttributes() ?>>
			<?php echo $t_perusahaan_edit->kdexport->selectOptionListHtml("x_kdexport") ?>
		</select>
</div>
<?php echo $t_perusahaan_edit->kdexport->Lookup->getParamTag($t_perusahaan_edit, "p_x_kdexport") ?>
</span>
<?php echo $t_perusahaan_edit->kdexport->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->nexport->Visible) { // nexport ?>
	<div id="r_nexport" class="form-group row">
		<label id="elh_t_perusahaan_nexport" for="x_nexport" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->nexport->caption() ?><?php echo $t_perusahaan_edit->nexport->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->nexport->cellAttributes() ?>>
<span id="el_t_perusahaan_nexport">
<textarea data-table="t_perusahaan" data-field="x_nexport" name="x_nexport" id="x_nexport" cols="50" rows="1" placeholder="<?php echo HtmlEncode($t_perusahaan_edit->nexport->getPlaceHolder()) ?>"<?php echo $t_perusahaan_edit->nexport->editAttributes() ?>><?php echo $t_perusahaan_edit->nexport->EditValue ?></textarea>
</span>
<?php echo $t_perusahaan_edit->nexport->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->kdskala->Visible) { // kdskala ?>
	<div id="r_kdskala" class="form-group row">
		<label id="elh_t_perusahaan_kdskala" for="x_kdskala" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->kdskala->caption() ?><?php echo $t_perusahaan_edit->kdskala->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->kdskala->cellAttributes() ?>>
<span id="el_t_perusahaan_kdskala">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdskala" data-value-separator="<?php echo $t_perusahaan_edit->kdskala->displayValueSeparatorAttribute() ?>" id="x_kdskala" name="x_kdskala"<?php echo $t_perusahaan_edit->kdskala->editAttributes() ?>>
			<?php echo $t_perusahaan_edit->kdskala->selectOptionListHtml("x_kdskala") ?>
		</select>
</div>
<?php echo $t_perusahaan_edit->kdskala->Lookup->getParamTag($t_perusahaan_edit, "p_x_kdskala") ?>
</span>
<?php echo $t_perusahaan_edit->kdskala->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->kdkategori->Visible) { // kdkategori ?>
	<div id="r_kdkategori" class="form-group row">
		<label id="elh_t_perusahaan_kdkategori" for="x_kdkategori" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->kdkategori->caption() ?><?php echo $t_perusahaan_edit->kdkategori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->kdkategori->cellAttributes() ?>>
<span id="el_t_perusahaan_kdkategori">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdkategori" data-value-separator="<?php echo $t_perusahaan_edit->kdkategori->displayValueSeparatorAttribute() ?>" id="x_kdkategori" name="x_kdkategori"<?php echo $t_perusahaan_edit->kdkategori->editAttributes() ?>>
			<?php echo $t_perusahaan_edit->kdkategori->selectOptionListHtml("x_kdkategori") ?>
		</select>
</div>
<?php echo $t_perusahaan_edit->kdkategori->Lookup->getParamTag($t_perusahaan_edit, "p_x_kdkategori") ?>
</span>
<?php echo $t_perusahaan_edit->kdkategori->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->omzet_saat_ini->Visible) { // omzet_saat_ini ?>
	<div id="r_omzet_saat_ini" class="form-group row">
		<label id="elh_t_perusahaan_omzet_saat_ini" for="x_omzet_saat_ini" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->omzet_saat_ini->caption() ?><?php echo $t_perusahaan_edit->omzet_saat_ini->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->omzet_saat_ini->cellAttributes() ?>>
<span id="el_t_perusahaan_omzet_saat_ini">
<input type="text" data-table="t_perusahaan" data-field="x_omzet_saat_ini" name="x_omzet_saat_ini" id="x_omzet_saat_ini" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_edit->omzet_saat_ini->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_edit->omzet_saat_ini->EditValue ?>"<?php echo $t_perusahaan_edit->omzet_saat_ini->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_edit->omzet_saat_ini->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->kapasitas_saat_ini->Visible) { // kapasitas_saat_ini ?>
	<div id="r_kapasitas_saat_ini" class="form-group row">
		<label id="elh_t_perusahaan_kapasitas_saat_ini" for="x_kapasitas_saat_ini" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->kapasitas_saat_ini->caption() ?><?php echo $t_perusahaan_edit->kapasitas_saat_ini->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->kapasitas_saat_ini->cellAttributes() ?>>
<span id="el_t_perusahaan_kapasitas_saat_ini">
<input type="text" data-table="t_perusahaan" data-field="x_kapasitas_saat_ini" name="x_kapasitas_saat_ini" id="x_kapasitas_saat_ini" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_edit->kapasitas_saat_ini->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_edit->kapasitas_saat_ini->EditValue ?>"<?php echo $t_perusahaan_edit->kapasitas_saat_ini->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_edit->kapasitas_saat_ini->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->kapasitas_stl_1thn->Visible) { // kapasitas_stl_1thn ?>
	<div id="r_kapasitas_stl_1thn" class="form-group row">
		<label id="elh_t_perusahaan_kapasitas_stl_1thn" for="x_kapasitas_stl_1thn" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->kapasitas_stl_1thn->caption() ?><?php echo $t_perusahaan_edit->kapasitas_stl_1thn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->kapasitas_stl_1thn->cellAttributes() ?>>
<span id="el_t_perusahaan_kapasitas_stl_1thn">
<input type="text" data-table="t_perusahaan" data-field="x_kapasitas_stl_1thn" name="x_kapasitas_stl_1thn" id="x_kapasitas_stl_1thn" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_edit->kapasitas_stl_1thn->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_edit->kapasitas_stl_1thn->EditValue ?>"<?php echo $t_perusahaan_edit->kapasitas_stl_1thn->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_edit->kapasitas_stl_1thn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_edit->kapasitas_stl_2thn->Visible) { // kapasitas_stl_2thn ?>
	<div id="r_kapasitas_stl_2thn" class="form-group row">
		<label id="elh_t_perusahaan_kapasitas_stl_2thn" for="x_kapasitas_stl_2thn" class="<?php echo $t_perusahaan_edit->LeftColumnClass ?>"><?php echo $t_perusahaan_edit->kapasitas_stl_2thn->caption() ?><?php echo $t_perusahaan_edit->kapasitas_stl_2thn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_edit->RightColumnClass ?>"><div <?php echo $t_perusahaan_edit->kapasitas_stl_2thn->cellAttributes() ?>>
<span id="el_t_perusahaan_kapasitas_stl_2thn">
<input type="text" data-table="t_perusahaan" data-field="x_kapasitas_stl_2thn" name="x_kapasitas_stl_2thn" id="x_kapasitas_stl_2thn" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_edit->kapasitas_stl_2thn->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_edit->kapasitas_stl_2thn->EditValue ?>"<?php echo $t_perusahaan_edit->kapasitas_stl_2thn->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_edit->kapasitas_stl_2thn->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="t_perusahaan" data-field="x_idp" name="x_idp" id="x_idp" value="<?php echo HtmlEncode($t_perusahaan_edit->idp->CurrentValue) ?>">
<?php
	if (in_array("t_peserta", explode(",", $t_perusahaan->getCurrentDetailTable())) && $t_peserta->DetailEdit) {
?>
<?php if ($t_perusahaan->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("t_peserta", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "t_pesertagrid.php" ?>
<?php } ?>
<?php if (!$t_perusahaan_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_perusahaan_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_perusahaan_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_perusahaan_edit->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$("#x_emailp").after("<div><span class='label label-info'>Email lebih dari satu pisahkan dengan koma</span></div>"),$("#x_webp").after("<div><span class='label label-info'>Website lebih dari satu pisahkan dengan koma</span></div>"),$("#x_medsos").after("<div><span class='label label-info'>Medsos lebih dari satu pisahkan dengan koma</span></div>");
});
</script>
<?php include_once "footer.php"; ?>
<?php
$t_perusahaan_edit->terminate();
?>