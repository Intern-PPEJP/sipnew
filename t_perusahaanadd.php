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
$t_perusahaan_add = new t_perusahaan_add();

// Run the page
$t_perusahaan_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_perusahaan_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_perusahaanadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_perusahaanadd = currentForm = new ew.Form("ft_perusahaanadd", "add");

	// Validate form
	ft_perusahaanadd.validate = function() {
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
			<?php if ($t_perusahaan_add->namap->Required) { ?>
				elm = this.getElements("x" + infix + "_namap");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->namap->caption(), $t_perusahaan_add->namap->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->kontak->Required) { ?>
				elm = this.getElements("x" + infix + "_kontak");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->kontak->caption(), $t_perusahaan_add->kontak->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->kdlokasi->Required) { ?>
				elm = this.getElements("x" + infix + "_kdlokasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->kdlokasi->caption(), $t_perusahaan_add->kdlokasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->kdprop->Required) { ?>
				elm = this.getElements("x" + infix + "_kdprop");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->kdprop->caption(), $t_perusahaan_add->kdprop->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->kdkota->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkota");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->kdkota->caption(), $t_perusahaan_add->kdkota->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->kdkec->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkec");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->kdkec->caption(), $t_perusahaan_add->kdkec->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->alamatp->Required) { ?>
				elm = this.getElements("x" + infix + "_alamatp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->alamatp->caption(), $t_perusahaan_add->alamatp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->kdpos->Required) { ?>
				elm = this.getElements("x" + infix + "_kdpos");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->kdpos->caption(), $t_perusahaan_add->kdpos->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->telpp->Required) { ?>
				elm = this.getElements("x" + infix + "_telpp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->telpp->caption(), $t_perusahaan_add->telpp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->faxp->Required) { ?>
				elm = this.getElements("x" + infix + "_faxp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->faxp->caption(), $t_perusahaan_add->faxp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->emailp->Required) { ?>
				elm = this.getElements("x" + infix + "_emailp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->emailp->caption(), $t_perusahaan_add->emailp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->webp->Required) { ?>
				elm = this.getElements("x" + infix + "_webp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->webp->caption(), $t_perusahaan_add->webp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->medsos->Required) { ?>
				elm = this.getElements("x" + infix + "_medsos");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->medsos->caption(), $t_perusahaan_add->medsos->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->kdjenis->Required) { ?>
				elm = this.getElements("x" + infix + "_kdjenis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->kdjenis->caption(), $t_perusahaan_add->kdjenis->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->kdproduknafed->Required) { ?>
				elm = this.getElements("x" + infix + "_kdproduknafed");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->kdproduknafed->caption(), $t_perusahaan_add->kdproduknafed->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->kdproduknafed2->Required) { ?>
				elm = this.getElements("x" + infix + "_kdproduknafed2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->kdproduknafed2->caption(), $t_perusahaan_add->kdproduknafed2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->kdproduknafed3->Required) { ?>
				elm = this.getElements("x" + infix + "_kdproduknafed3");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->kdproduknafed3->caption(), $t_perusahaan_add->kdproduknafed3->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->pproduk->Required) { ?>
				elm = this.getElements("x" + infix + "_pproduk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->pproduk->caption(), $t_perusahaan_add->pproduk->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->kdexport->Required) { ?>
				elm = this.getElements("x" + infix + "_kdexport");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->kdexport->caption(), $t_perusahaan_add->kdexport->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->nexport->Required) { ?>
				elm = this.getElements("x" + infix + "_nexport");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->nexport->caption(), $t_perusahaan_add->nexport->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->kdskala->Required) { ?>
				elm = this.getElements("x" + infix + "_kdskala");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->kdskala->caption(), $t_perusahaan_add->kdskala->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->kdkategori->Required) { ?>
				elm = this.getElements("x" + infix + "_kdkategori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->kdkategori->caption(), $t_perusahaan_add->kdkategori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->omzet_saat_ini->Required) { ?>
				elm = this.getElements("x" + infix + "_omzet_saat_ini");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->omzet_saat_ini->caption(), $t_perusahaan_add->omzet_saat_ini->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->kapasitas_saat_ini->Required) { ?>
				elm = this.getElements("x" + infix + "_kapasitas_saat_ini");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->kapasitas_saat_ini->caption(), $t_perusahaan_add->kapasitas_saat_ini->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->kapasitas_stl_1thn->Required) { ?>
				elm = this.getElements("x" + infix + "_kapasitas_stl_1thn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->kapasitas_stl_1thn->caption(), $t_perusahaan_add->kapasitas_stl_1thn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->kapasitas_stl_2thn->Required) { ?>
				elm = this.getElements("x" + infix + "_kapasitas_stl_2thn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->kapasitas_stl_2thn->caption(), $t_perusahaan_add->kapasitas_stl_2thn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->created_at->Required) { ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->created_at->caption(), $t_perusahaan_add->created_at->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_perusahaan_add->user_created_by->Required) { ?>
				elm = this.getElements("x" + infix + "_user_created_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_perusahaan_add->user_created_by->caption(), $t_perusahaan_add->user_created_by->RequiredErrorMessage)) ?>");
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
	ft_perusahaanadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_perusahaanadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_perusahaanadd.lists["x_kdlokasi"] = <?php echo $t_perusahaan_add->kdlokasi->Lookup->toClientList($t_perusahaan_add) ?>;
	ft_perusahaanadd.lists["x_kdlokasi"].options = <?php echo JsonEncode($t_perusahaan_add->kdlokasi->lookupOptions()) ?>;
	ft_perusahaanadd.lists["x_kdprop"] = <?php echo $t_perusahaan_add->kdprop->Lookup->toClientList($t_perusahaan_add) ?>;
	ft_perusahaanadd.lists["x_kdprop"].options = <?php echo JsonEncode($t_perusahaan_add->kdprop->lookupOptions()) ?>;
	ft_perusahaanadd.lists["x_kdkota"] = <?php echo $t_perusahaan_add->kdkota->Lookup->toClientList($t_perusahaan_add) ?>;
	ft_perusahaanadd.lists["x_kdkota"].options = <?php echo JsonEncode($t_perusahaan_add->kdkota->lookupOptions()) ?>;
	ft_perusahaanadd.lists["x_kdkec"] = <?php echo $t_perusahaan_add->kdkec->Lookup->toClientList($t_perusahaan_add) ?>;
	ft_perusahaanadd.lists["x_kdkec"].options = <?php echo JsonEncode($t_perusahaan_add->kdkec->lookupOptions()) ?>;
	ft_perusahaanadd.lists["x_kdjenis"] = <?php echo $t_perusahaan_add->kdjenis->Lookup->toClientList($t_perusahaan_add) ?>;
	ft_perusahaanadd.lists["x_kdjenis"].options = <?php echo JsonEncode($t_perusahaan_add->kdjenis->lookupOptions()) ?>;
	ft_perusahaanadd.lists["x_kdproduknafed"] = <?php echo $t_perusahaan_add->kdproduknafed->Lookup->toClientList($t_perusahaan_add) ?>;
	ft_perusahaanadd.lists["x_kdproduknafed"].options = <?php echo JsonEncode($t_perusahaan_add->kdproduknafed->lookupOptions()) ?>;
	ft_perusahaanadd.lists["x_kdproduknafed2"] = <?php echo $t_perusahaan_add->kdproduknafed2->Lookup->toClientList($t_perusahaan_add) ?>;
	ft_perusahaanadd.lists["x_kdproduknafed2"].options = <?php echo JsonEncode($t_perusahaan_add->kdproduknafed2->lookupOptions()) ?>;
	ft_perusahaanadd.lists["x_kdproduknafed3"] = <?php echo $t_perusahaan_add->kdproduknafed3->Lookup->toClientList($t_perusahaan_add) ?>;
	ft_perusahaanadd.lists["x_kdproduknafed3"].options = <?php echo JsonEncode($t_perusahaan_add->kdproduknafed3->lookupOptions()) ?>;
	ft_perusahaanadd.lists["x_kdexport"] = <?php echo $t_perusahaan_add->kdexport->Lookup->toClientList($t_perusahaan_add) ?>;
	ft_perusahaanadd.lists["x_kdexport"].options = <?php echo JsonEncode($t_perusahaan_add->kdexport->lookupOptions()) ?>;
	ft_perusahaanadd.lists["x_kdskala"] = <?php echo $t_perusahaan_add->kdskala->Lookup->toClientList($t_perusahaan_add) ?>;
	ft_perusahaanadd.lists["x_kdskala"].options = <?php echo JsonEncode($t_perusahaan_add->kdskala->lookupOptions()) ?>;
	ft_perusahaanadd.lists["x_kdkategori"] = <?php echo $t_perusahaan_add->kdkategori->Lookup->toClientList($t_perusahaan_add) ?>;
	ft_perusahaanadd.lists["x_kdkategori"].options = <?php echo JsonEncode($t_perusahaan_add->kdkategori->lookupOptions()) ?>;
	loadjs.done("ft_perusahaanadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//document.write('<?php echo cs_judul("add","Menambah Data Perusahaan");?>');

});
</script>
<?php $t_perusahaan_add->showPageHeader(); ?>
<?php
$t_perusahaan_add->showMessage();
?>
<form name="ft_perusahaanadd" id="ft_perusahaanadd" class="<?php echo $t_perusahaan_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_perusahaan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_perusahaan_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($t_perusahaan_add->namap->Visible) { // namap ?>
	<div id="r_namap" class="form-group row">
		<label id="elh_t_perusahaan_namap" for="x_namap" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->namap->caption() ?><?php echo $t_perusahaan_add->namap->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->namap->cellAttributes() ?>>
<span id="el_t_perusahaan_namap">
<input type="text" data-table="t_perusahaan" data-field="x_namap" name="x_namap" id="x_namap" size="75" maxlength="150" placeholder="<?php echo HtmlEncode($t_perusahaan_add->namap->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_add->namap->EditValue ?>"<?php echo $t_perusahaan_add->namap->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_add->namap->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->kontak->Visible) { // kontak ?>
	<div id="r_kontak" class="form-group row">
		<label id="elh_t_perusahaan_kontak" for="x_kontak" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->kontak->caption() ?><?php echo $t_perusahaan_add->kontak->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->kontak->cellAttributes() ?>>
<span id="el_t_perusahaan_kontak">
<input type="text" data-table="t_perusahaan" data-field="x_kontak" name="x_kontak" id="x_kontak" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($t_perusahaan_add->kontak->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_add->kontak->EditValue ?>"<?php echo $t_perusahaan_add->kontak->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_add->kontak->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->kdlokasi->Visible) { // kdlokasi ?>
	<div id="r_kdlokasi" class="form-group row">
		<label id="elh_t_perusahaan_kdlokasi" for="x_kdlokasi" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->kdlokasi->caption() ?><?php echo $t_perusahaan_add->kdlokasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->kdlokasi->cellAttributes() ?>>
<span id="el_t_perusahaan_kdlokasi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdlokasi" data-value-separator="<?php echo $t_perusahaan_add->kdlokasi->displayValueSeparatorAttribute() ?>" id="x_kdlokasi" name="x_kdlokasi"<?php echo $t_perusahaan_add->kdlokasi->editAttributes() ?>>
			<?php echo $t_perusahaan_add->kdlokasi->selectOptionListHtml("x_kdlokasi") ?>
		</select>
</div>
<?php echo $t_perusahaan_add->kdlokasi->Lookup->getParamTag($t_perusahaan_add, "p_x_kdlokasi") ?>
</span>
<?php echo $t_perusahaan_add->kdlokasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->kdprop->Visible) { // kdprop ?>
	<div id="r_kdprop" class="form-group row">
		<label id="elh_t_perusahaan_kdprop" for="x_kdprop" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->kdprop->caption() ?><?php echo $t_perusahaan_add->kdprop->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->kdprop->cellAttributes() ?>>
<span id="el_t_perusahaan_kdprop">
<?php $t_perusahaan_add->kdprop->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdprop" data-value-separator="<?php echo $t_perusahaan_add->kdprop->displayValueSeparatorAttribute() ?>" id="x_kdprop" name="x_kdprop"<?php echo $t_perusahaan_add->kdprop->editAttributes() ?>>
			<?php echo $t_perusahaan_add->kdprop->selectOptionListHtml("x_kdprop") ?>
		</select>
</div>
<?php echo $t_perusahaan_add->kdprop->Lookup->getParamTag($t_perusahaan_add, "p_x_kdprop") ?>
</span>
<?php echo $t_perusahaan_add->kdprop->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->kdkota->Visible) { // kdkota ?>
	<div id="r_kdkota" class="form-group row">
		<label id="elh_t_perusahaan_kdkota" for="x_kdkota" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->kdkota->caption() ?><?php echo $t_perusahaan_add->kdkota->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->kdkota->cellAttributes() ?>>
<span id="el_t_perusahaan_kdkota">
<?php $t_perusahaan_add->kdkota->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdkota" data-value-separator="<?php echo $t_perusahaan_add->kdkota->displayValueSeparatorAttribute() ?>" id="x_kdkota" name="x_kdkota"<?php echo $t_perusahaan_add->kdkota->editAttributes() ?>>
			<?php echo $t_perusahaan_add->kdkota->selectOptionListHtml("x_kdkota") ?>
		</select>
</div>
<?php echo $t_perusahaan_add->kdkota->Lookup->getParamTag($t_perusahaan_add, "p_x_kdkota") ?>
</span>
<?php echo $t_perusahaan_add->kdkota->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->kdkec->Visible) { // kdkec ?>
	<div id="r_kdkec" class="form-group row">
		<label id="elh_t_perusahaan_kdkec" for="x_kdkec" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->kdkec->caption() ?><?php echo $t_perusahaan_add->kdkec->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->kdkec->cellAttributes() ?>>
<span id="el_t_perusahaan_kdkec">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdkec" data-value-separator="<?php echo $t_perusahaan_add->kdkec->displayValueSeparatorAttribute() ?>" id="x_kdkec" name="x_kdkec"<?php echo $t_perusahaan_add->kdkec->editAttributes() ?>>
			<?php echo $t_perusahaan_add->kdkec->selectOptionListHtml("x_kdkec") ?>
		</select>
</div>
<?php echo $t_perusahaan_add->kdkec->Lookup->getParamTag($t_perusahaan_add, "p_x_kdkec") ?>
</span>
<?php echo $t_perusahaan_add->kdkec->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->alamatp->Visible) { // alamatp ?>
	<div id="r_alamatp" class="form-group row">
		<label id="elh_t_perusahaan_alamatp" for="x_alamatp" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->alamatp->caption() ?><?php echo $t_perusahaan_add->alamatp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->alamatp->cellAttributes() ?>>
<span id="el_t_perusahaan_alamatp">
<textarea data-table="t_perusahaan" data-field="x_alamatp" name="x_alamatp" id="x_alamatp" cols="50" rows="2" placeholder="<?php echo HtmlEncode($t_perusahaan_add->alamatp->getPlaceHolder()) ?>"<?php echo $t_perusahaan_add->alamatp->editAttributes() ?>><?php echo $t_perusahaan_add->alamatp->EditValue ?></textarea>
</span>
<?php echo $t_perusahaan_add->alamatp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->kdpos->Visible) { // kdpos ?>
	<div id="r_kdpos" class="form-group row">
		<label id="elh_t_perusahaan_kdpos" for="x_kdpos" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->kdpos->caption() ?><?php echo $t_perusahaan_add->kdpos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->kdpos->cellAttributes() ?>>
<span id="el_t_perusahaan_kdpos">
<input type="text" data-table="t_perusahaan" data-field="x_kdpos" name="x_kdpos" id="x_kdpos" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($t_perusahaan_add->kdpos->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_add->kdpos->EditValue ?>"<?php echo $t_perusahaan_add->kdpos->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_add->kdpos->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->telpp->Visible) { // telpp ?>
	<div id="r_telpp" class="form-group row">
		<label id="elh_t_perusahaan_telpp" for="x_telpp" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->telpp->caption() ?><?php echo $t_perusahaan_add->telpp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->telpp->cellAttributes() ?>>
<span id="el_t_perusahaan_telpp">
<input type="text" data-table="t_perusahaan" data-field="x_telpp" name="x_telpp" id="x_telpp" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_add->telpp->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_add->telpp->EditValue ?>"<?php echo $t_perusahaan_add->telpp->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_add->telpp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->faxp->Visible) { // faxp ?>
	<div id="r_faxp" class="form-group row">
		<label id="elh_t_perusahaan_faxp" for="x_faxp" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->faxp->caption() ?><?php echo $t_perusahaan_add->faxp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->faxp->cellAttributes() ?>>
<span id="el_t_perusahaan_faxp">
<input type="text" data-table="t_perusahaan" data-field="x_faxp" name="x_faxp" id="x_faxp" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_add->faxp->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_add->faxp->EditValue ?>"<?php echo $t_perusahaan_add->faxp->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_add->faxp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->emailp->Visible) { // emailp ?>
	<div id="r_emailp" class="form-group row">
		<label id="elh_t_perusahaan_emailp" for="x_emailp" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->emailp->caption() ?><?php echo $t_perusahaan_add->emailp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->emailp->cellAttributes() ?>>
<span id="el_t_perusahaan_emailp">
<input type="text" data-table="t_perusahaan" data-field="x_emailp" name="x_emailp" id="x_emailp" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_add->emailp->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_add->emailp->EditValue ?>"<?php echo $t_perusahaan_add->emailp->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_add->emailp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->webp->Visible) { // webp ?>
	<div id="r_webp" class="form-group row">
		<label id="elh_t_perusahaan_webp" for="x_webp" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->webp->caption() ?><?php echo $t_perusahaan_add->webp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->webp->cellAttributes() ?>>
<span id="el_t_perusahaan_webp">
<input type="text" data-table="t_perusahaan" data-field="x_webp" name="x_webp" id="x_webp" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_add->webp->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_add->webp->EditValue ?>"<?php echo $t_perusahaan_add->webp->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_add->webp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->medsos->Visible) { // medsos ?>
	<div id="r_medsos" class="form-group row">
		<label id="elh_t_perusahaan_medsos" for="x_medsos" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->medsos->caption() ?><?php echo $t_perusahaan_add->medsos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->medsos->cellAttributes() ?>>
<span id="el_t_perusahaan_medsos">
<input type="text" data-table="t_perusahaan" data-field="x_medsos" name="x_medsos" id="x_medsos" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_add->medsos->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_add->medsos->EditValue ?>"<?php echo $t_perusahaan_add->medsos->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_add->medsos->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->kdjenis->Visible) { // kdjenis ?>
	<div id="r_kdjenis" class="form-group row">
		<label id="elh_t_perusahaan_kdjenis" for="x_kdjenis" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->kdjenis->caption() ?><?php echo $t_perusahaan_add->kdjenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->kdjenis->cellAttributes() ?>>
<span id="el_t_perusahaan_kdjenis">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdjenis" data-value-separator="<?php echo $t_perusahaan_add->kdjenis->displayValueSeparatorAttribute() ?>" id="x_kdjenis" name="x_kdjenis"<?php echo $t_perusahaan_add->kdjenis->editAttributes() ?>>
			<?php echo $t_perusahaan_add->kdjenis->selectOptionListHtml("x_kdjenis") ?>
		</select>
</div>
<?php echo $t_perusahaan_add->kdjenis->Lookup->getParamTag($t_perusahaan_add, "p_x_kdjenis") ?>
</span>
<?php echo $t_perusahaan_add->kdjenis->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->kdproduknafed->Visible) { // kdproduknafed ?>
	<div id="r_kdproduknafed" class="form-group row">
		<label id="elh_t_perusahaan_kdproduknafed" for="x_kdproduknafed" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->kdproduknafed->caption() ?><?php echo $t_perusahaan_add->kdproduknafed->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->kdproduknafed->cellAttributes() ?>>
<span id="el_t_perusahaan_kdproduknafed">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdproduknafed" data-value-separator="<?php echo $t_perusahaan_add->kdproduknafed->displayValueSeparatorAttribute() ?>" id="x_kdproduknafed" name="x_kdproduknafed"<?php echo $t_perusahaan_add->kdproduknafed->editAttributes() ?>>
			<?php echo $t_perusahaan_add->kdproduknafed->selectOptionListHtml("x_kdproduknafed") ?>
		</select>
</div>
<?php echo $t_perusahaan_add->kdproduknafed->Lookup->getParamTag($t_perusahaan_add, "p_x_kdproduknafed") ?>
</span>
<?php echo $t_perusahaan_add->kdproduknafed->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->kdproduknafed2->Visible) { // kdproduknafed2 ?>
	<div id="r_kdproduknafed2" class="form-group row">
		<label id="elh_t_perusahaan_kdproduknafed2" for="x_kdproduknafed2" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->kdproduknafed2->caption() ?><?php echo $t_perusahaan_add->kdproduknafed2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->kdproduknafed2->cellAttributes() ?>>
<span id="el_t_perusahaan_kdproduknafed2">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdproduknafed2" data-value-separator="<?php echo $t_perusahaan_add->kdproduknafed2->displayValueSeparatorAttribute() ?>" id="x_kdproduknafed2" name="x_kdproduknafed2"<?php echo $t_perusahaan_add->kdproduknafed2->editAttributes() ?>>
			<?php echo $t_perusahaan_add->kdproduknafed2->selectOptionListHtml("x_kdproduknafed2") ?>
		</select>
</div>
<?php echo $t_perusahaan_add->kdproduknafed2->Lookup->getParamTag($t_perusahaan_add, "p_x_kdproduknafed2") ?>
</span>
<?php echo $t_perusahaan_add->kdproduknafed2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->kdproduknafed3->Visible) { // kdproduknafed3 ?>
	<div id="r_kdproduknafed3" class="form-group row">
		<label id="elh_t_perusahaan_kdproduknafed3" for="x_kdproduknafed3" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->kdproduknafed3->caption() ?><?php echo $t_perusahaan_add->kdproduknafed3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->kdproduknafed3->cellAttributes() ?>>
<span id="el_t_perusahaan_kdproduknafed3">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdproduknafed3" data-value-separator="<?php echo $t_perusahaan_add->kdproduknafed3->displayValueSeparatorAttribute() ?>" id="x_kdproduknafed3" name="x_kdproduknafed3"<?php echo $t_perusahaan_add->kdproduknafed3->editAttributes() ?>>
			<?php echo $t_perusahaan_add->kdproduknafed3->selectOptionListHtml("x_kdproduknafed3") ?>
		</select>
</div>
<?php echo $t_perusahaan_add->kdproduknafed3->Lookup->getParamTag($t_perusahaan_add, "p_x_kdproduknafed3") ?>
</span>
<?php echo $t_perusahaan_add->kdproduknafed3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->pproduk->Visible) { // pproduk ?>
	<div id="r_pproduk" class="form-group row">
		<label id="elh_t_perusahaan_pproduk" for="x_pproduk" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->pproduk->caption() ?><?php echo $t_perusahaan_add->pproduk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->pproduk->cellAttributes() ?>>
<span id="el_t_perusahaan_pproduk">
<textarea data-table="t_perusahaan" data-field="x_pproduk" name="x_pproduk" id="x_pproduk" cols="50" rows="4" placeholder="<?php echo HtmlEncode($t_perusahaan_add->pproduk->getPlaceHolder()) ?>"<?php echo $t_perusahaan_add->pproduk->editAttributes() ?>><?php echo $t_perusahaan_add->pproduk->EditValue ?></textarea>
</span>
<?php echo $t_perusahaan_add->pproduk->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->kdexport->Visible) { // kdexport ?>
	<div id="r_kdexport" class="form-group row">
		<label id="elh_t_perusahaan_kdexport" for="x_kdexport" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->kdexport->caption() ?><?php echo $t_perusahaan_add->kdexport->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->kdexport->cellAttributes() ?>>
<span id="el_t_perusahaan_kdexport">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdexport" data-value-separator="<?php echo $t_perusahaan_add->kdexport->displayValueSeparatorAttribute() ?>" id="x_kdexport" name="x_kdexport"<?php echo $t_perusahaan_add->kdexport->editAttributes() ?>>
			<?php echo $t_perusahaan_add->kdexport->selectOptionListHtml("x_kdexport") ?>
		</select>
</div>
<?php echo $t_perusahaan_add->kdexport->Lookup->getParamTag($t_perusahaan_add, "p_x_kdexport") ?>
</span>
<?php echo $t_perusahaan_add->kdexport->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->nexport->Visible) { // nexport ?>
	<div id="r_nexport" class="form-group row">
		<label id="elh_t_perusahaan_nexport" for="x_nexport" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->nexport->caption() ?><?php echo $t_perusahaan_add->nexport->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->nexport->cellAttributes() ?>>
<span id="el_t_perusahaan_nexport">
<textarea data-table="t_perusahaan" data-field="x_nexport" name="x_nexport" id="x_nexport" cols="50" rows="1" placeholder="<?php echo HtmlEncode($t_perusahaan_add->nexport->getPlaceHolder()) ?>"<?php echo $t_perusahaan_add->nexport->editAttributes() ?>><?php echo $t_perusahaan_add->nexport->EditValue ?></textarea>
</span>
<?php echo $t_perusahaan_add->nexport->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->kdskala->Visible) { // kdskala ?>
	<div id="r_kdskala" class="form-group row">
		<label id="elh_t_perusahaan_kdskala" for="x_kdskala" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->kdskala->caption() ?><?php echo $t_perusahaan_add->kdskala->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->kdskala->cellAttributes() ?>>
<span id="el_t_perusahaan_kdskala">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdskala" data-value-separator="<?php echo $t_perusahaan_add->kdskala->displayValueSeparatorAttribute() ?>" id="x_kdskala" name="x_kdskala"<?php echo $t_perusahaan_add->kdskala->editAttributes() ?>>
			<?php echo $t_perusahaan_add->kdskala->selectOptionListHtml("x_kdskala") ?>
		</select>
</div>
<?php echo $t_perusahaan_add->kdskala->Lookup->getParamTag($t_perusahaan_add, "p_x_kdskala") ?>
</span>
<?php echo $t_perusahaan_add->kdskala->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->kdkategori->Visible) { // kdkategori ?>
	<div id="r_kdkategori" class="form-group row">
		<label id="elh_t_perusahaan_kdkategori" for="x_kdkategori" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->kdkategori->caption() ?><?php echo $t_perusahaan_add->kdkategori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->kdkategori->cellAttributes() ?>>
<span id="el_t_perusahaan_kdkategori">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_perusahaan" data-field="x_kdkategori" data-value-separator="<?php echo $t_perusahaan_add->kdkategori->displayValueSeparatorAttribute() ?>" id="x_kdkategori" name="x_kdkategori"<?php echo $t_perusahaan_add->kdkategori->editAttributes() ?>>
			<?php echo $t_perusahaan_add->kdkategori->selectOptionListHtml("x_kdkategori") ?>
		</select>
</div>
<?php echo $t_perusahaan_add->kdkategori->Lookup->getParamTag($t_perusahaan_add, "p_x_kdkategori") ?>
</span>
<?php echo $t_perusahaan_add->kdkategori->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->omzet_saat_ini->Visible) { // omzet_saat_ini ?>
	<div id="r_omzet_saat_ini" class="form-group row">
		<label id="elh_t_perusahaan_omzet_saat_ini" for="x_omzet_saat_ini" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->omzet_saat_ini->caption() ?><?php echo $t_perusahaan_add->omzet_saat_ini->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->omzet_saat_ini->cellAttributes() ?>>
<span id="el_t_perusahaan_omzet_saat_ini">
<input type="text" data-table="t_perusahaan" data-field="x_omzet_saat_ini" name="x_omzet_saat_ini" id="x_omzet_saat_ini" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_add->omzet_saat_ini->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_add->omzet_saat_ini->EditValue ?>"<?php echo $t_perusahaan_add->omzet_saat_ini->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_add->omzet_saat_ini->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->kapasitas_saat_ini->Visible) { // kapasitas_saat_ini ?>
	<div id="r_kapasitas_saat_ini" class="form-group row">
		<label id="elh_t_perusahaan_kapasitas_saat_ini" for="x_kapasitas_saat_ini" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->kapasitas_saat_ini->caption() ?><?php echo $t_perusahaan_add->kapasitas_saat_ini->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->kapasitas_saat_ini->cellAttributes() ?>>
<span id="el_t_perusahaan_kapasitas_saat_ini">
<input type="text" data-table="t_perusahaan" data-field="x_kapasitas_saat_ini" name="x_kapasitas_saat_ini" id="x_kapasitas_saat_ini" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_add->kapasitas_saat_ini->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_add->kapasitas_saat_ini->EditValue ?>"<?php echo $t_perusahaan_add->kapasitas_saat_ini->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_add->kapasitas_saat_ini->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->kapasitas_stl_1thn->Visible) { // kapasitas_stl_1thn ?>
	<div id="r_kapasitas_stl_1thn" class="form-group row">
		<label id="elh_t_perusahaan_kapasitas_stl_1thn" for="x_kapasitas_stl_1thn" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->kapasitas_stl_1thn->caption() ?><?php echo $t_perusahaan_add->kapasitas_stl_1thn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->kapasitas_stl_1thn->cellAttributes() ?>>
<span id="el_t_perusahaan_kapasitas_stl_1thn">
<input type="text" data-table="t_perusahaan" data-field="x_kapasitas_stl_1thn" name="x_kapasitas_stl_1thn" id="x_kapasitas_stl_1thn" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_add->kapasitas_stl_1thn->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_add->kapasitas_stl_1thn->EditValue ?>"<?php echo $t_perusahaan_add->kapasitas_stl_1thn->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_add->kapasitas_stl_1thn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_perusahaan_add->kapasitas_stl_2thn->Visible) { // kapasitas_stl_2thn ?>
	<div id="r_kapasitas_stl_2thn" class="form-group row">
		<label id="elh_t_perusahaan_kapasitas_stl_2thn" for="x_kapasitas_stl_2thn" class="<?php echo $t_perusahaan_add->LeftColumnClass ?>"><?php echo $t_perusahaan_add->kapasitas_stl_2thn->caption() ?><?php echo $t_perusahaan_add->kapasitas_stl_2thn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_perusahaan_add->RightColumnClass ?>"><div <?php echo $t_perusahaan_add->kapasitas_stl_2thn->cellAttributes() ?>>
<span id="el_t_perusahaan_kapasitas_stl_2thn">
<input type="text" data-table="t_perusahaan" data-field="x_kapasitas_stl_2thn" name="x_kapasitas_stl_2thn" id="x_kapasitas_stl_2thn" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_perusahaan_add->kapasitas_stl_2thn->getPlaceHolder()) ?>" value="<?php echo $t_perusahaan_add->kapasitas_stl_2thn->EditValue ?>"<?php echo $t_perusahaan_add->kapasitas_stl_2thn->editAttributes() ?>>
</span>
<?php echo $t_perusahaan_add->kapasitas_stl_2thn->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("t_peserta", explode(",", $t_perusahaan->getCurrentDetailTable())) && $t_peserta->DetailAdd) {
?>
<?php if ($t_perusahaan->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("t_peserta", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "t_pesertagrid.php" ?>
<?php } ?>
<?php if (!$t_perusahaan_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_perusahaan_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_perusahaan_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_perusahaan_add->showPageFooter();
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
$t_perusahaan_add->terminate();
?>