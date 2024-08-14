<?php
namespace PHPMaker2020\input_ecp;

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
$dm_pesertaecp_add = new dm_pesertaecp_add();

// Run the page
$dm_pesertaecp_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dm_pesertaecp_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdm_pesertaecpadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdm_pesertaecpadd = currentForm = new ew.Form("fdm_pesertaecpadd", "add");

	// Validate form
	fdm_pesertaecpadd.validate = function() {
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
			<?php if ($dm_pesertaecp_add->Nama->Required) { ?>
				elm = this.getElements("x" + infix + "_Nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_add->Nama->caption(), $dm_pesertaecp_add->Nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_add->Perusahaan->Required) { ?>
				elm = this.getElements("x" + infix + "_Perusahaan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_add->Perusahaan->caption(), $dm_pesertaecp_add->Perusahaan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_add->Alamat->Required) { ?>
				elm = this.getElements("x" + infix + "_Alamat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_add->Alamat->caption(), $dm_pesertaecp_add->Alamat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_add->Produk->Required) { ?>
				elm = this.getElements("x" + infix + "_Produk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_add->Produk->caption(), $dm_pesertaecp_add->Produk->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_add->Kapasitas_Produksi->Required) { ?>
				elm = this.getElements("x" + infix + "_Kapasitas_Produksi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_add->Kapasitas_Produksi->caption(), $dm_pesertaecp_add->Kapasitas_Produksi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_add->Omset->Required) { ?>
				elm = this.getElements("x" + infix + "_Omset");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_add->Omset->caption(), $dm_pesertaecp_add->Omset->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_add->Jumlah_Pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_Jumlah_Pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_add->Jumlah_Pegawai->caption(), $dm_pesertaecp_add->Jumlah_Pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_add->Legalitas_Perusahaan->Required) { ?>
				elm = this.getElements("x" + infix + "_Legalitas_Perusahaan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_add->Legalitas_Perusahaan->caption(), $dm_pesertaecp_add->Legalitas_Perusahaan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_add->Sertifikasi_dimiliki->Required) { ?>
				elm = this.getElements("x" + infix + "_Sertifikasi_dimiliki");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_add->Sertifikasi_dimiliki->caption(), $dm_pesertaecp_add->Sertifikasi_dimiliki->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_add->Handphone->Required) { ?>
				elm = this.getElements("x" + infix + "_Handphone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_add->Handphone->caption(), $dm_pesertaecp_add->Handphone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_add->Email_Add->Required) { ?>
				elm = this.getElements("x" + infix + "_Email_Add");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_add->Email_Add->caption(), $dm_pesertaecp_add->Email_Add->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_add->Website->Required) { ?>
				elm = this.getElements("x" + infix + "_Website");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_add->Website->caption(), $dm_pesertaecp_add->Website->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_add->Tahun_Berdiri->Required) { ?>
				elm = this.getElements("x" + infix + "_Tahun_Berdiri");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_add->Tahun_Berdiri->caption(), $dm_pesertaecp_add->Tahun_Berdiri->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_add->Alamat_Produksi->Required) { ?>
				elm = this.getElements("x" + infix + "_Alamat_Produksi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_add->Alamat_Produksi->caption(), $dm_pesertaecp_add->Alamat_Produksi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_add->Wilayah_ECP->Required) { ?>
				elm = this.getElements("x" + infix + "_Wilayah_ECP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_add->Wilayah_ECP->caption(), $dm_pesertaecp_add->Wilayah_ECP->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dm_pesertaecp_add->Tahun_ECP->Required) { ?>
				elm = this.getElements("x" + infix + "_Tahun_ECP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dm_pesertaecp_add->Tahun_ECP->caption(), $dm_pesertaecp_add->Tahun_ECP->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Tahun_ECP");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dm_pesertaecp_add->Tahun_ECP->errorMessage()) ?>");

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
	fdm_pesertaecpadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdm_pesertaecpadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdm_pesertaecpadd.lists["x_Wilayah_ECP"] = <?php echo $dm_pesertaecp_add->Wilayah_ECP->Lookup->toClientList($dm_pesertaecp_add) ?>;
	fdm_pesertaecpadd.lists["x_Wilayah_ECP"].options = <?php echo JsonEncode($dm_pesertaecp_add->Wilayah_ECP->lookupOptions()) ?>;
	loadjs.done("fdm_pesertaecpadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $dm_pesertaecp_add->showPageHeader(); ?>
<?php
$dm_pesertaecp_add->showMessage();
?>
<form name="fdm_pesertaecpadd" id="fdm_pesertaecpadd" class="<?php echo $dm_pesertaecp_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dm_pesertaecp">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$dm_pesertaecp_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($dm_pesertaecp_add->Nama->Visible) { // Nama ?>
	<div id="r_Nama" class="form-group row">
		<label id="elh_dm_pesertaecp_Nama" for="x_Nama" class="<?php echo $dm_pesertaecp_add->LeftColumnClass ?>"><?php echo $dm_pesertaecp_add->Nama->caption() ?><?php echo $dm_pesertaecp_add->Nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_add->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_add->Nama->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Nama">
<input type="text" data-table="dm_pesertaecp" data-field="x_Nama" name="x_Nama" id="x_Nama" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($dm_pesertaecp_add->Nama->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_add->Nama->EditValue ?>"<?php echo $dm_pesertaecp_add->Nama->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_add->Nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_add->Perusahaan->Visible) { // Perusahaan ?>
	<div id="r_Perusahaan" class="form-group row">
		<label id="elh_dm_pesertaecp_Perusahaan" for="x_Perusahaan" class="<?php echo $dm_pesertaecp_add->LeftColumnClass ?>"><?php echo $dm_pesertaecp_add->Perusahaan->caption() ?><?php echo $dm_pesertaecp_add->Perusahaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_add->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_add->Perusahaan->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Perusahaan">
<input type="text" data-table="dm_pesertaecp" data-field="x_Perusahaan" name="x_Perusahaan" id="x_Perusahaan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_pesertaecp_add->Perusahaan->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_add->Perusahaan->EditValue ?>"<?php echo $dm_pesertaecp_add->Perusahaan->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_add->Perusahaan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_add->Alamat->Visible) { // Alamat ?>
	<div id="r_Alamat" class="form-group row">
		<label id="elh_dm_pesertaecp_Alamat" for="x_Alamat" class="<?php echo $dm_pesertaecp_add->LeftColumnClass ?>"><?php echo $dm_pesertaecp_add->Alamat->caption() ?><?php echo $dm_pesertaecp_add->Alamat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_add->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_add->Alamat->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Alamat">
<textarea data-table="dm_pesertaecp" data-field="x_Alamat" name="x_Alamat" id="x_Alamat" cols="35" rows="4" placeholder="<?php echo HtmlEncode($dm_pesertaecp_add->Alamat->getPlaceHolder()) ?>"<?php echo $dm_pesertaecp_add->Alamat->editAttributes() ?>><?php echo $dm_pesertaecp_add->Alamat->EditValue ?></textarea>
</span>
<?php echo $dm_pesertaecp_add->Alamat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_add->Produk->Visible) { // Produk ?>
	<div id="r_Produk" class="form-group row">
		<label id="elh_dm_pesertaecp_Produk" for="x_Produk" class="<?php echo $dm_pesertaecp_add->LeftColumnClass ?>"><?php echo $dm_pesertaecp_add->Produk->caption() ?><?php echo $dm_pesertaecp_add->Produk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_add->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_add->Produk->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Produk">
<input type="text" data-table="dm_pesertaecp" data-field="x_Produk" name="x_Produk" id="x_Produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_pesertaecp_add->Produk->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_add->Produk->EditValue ?>"<?php echo $dm_pesertaecp_add->Produk->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_add->Produk->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_add->Kapasitas_Produksi->Visible) { // Kapasitas_Produksi ?>
	<div id="r_Kapasitas_Produksi" class="form-group row">
		<label id="elh_dm_pesertaecp_Kapasitas_Produksi" for="x_Kapasitas_Produksi" class="<?php echo $dm_pesertaecp_add->LeftColumnClass ?>"><?php echo $dm_pesertaecp_add->Kapasitas_Produksi->caption() ?><?php echo $dm_pesertaecp_add->Kapasitas_Produksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_add->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_add->Kapasitas_Produksi->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Kapasitas_Produksi">
<input type="text" data-table="dm_pesertaecp" data-field="x_Kapasitas_Produksi" name="x_Kapasitas_Produksi" id="x_Kapasitas_Produksi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dm_pesertaecp_add->Kapasitas_Produksi->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_add->Kapasitas_Produksi->EditValue ?>"<?php echo $dm_pesertaecp_add->Kapasitas_Produksi->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_add->Kapasitas_Produksi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_add->Omset->Visible) { // Omset ?>
	<div id="r_Omset" class="form-group row">
		<label id="elh_dm_pesertaecp_Omset" for="x_Omset" class="<?php echo $dm_pesertaecp_add->LeftColumnClass ?>"><?php echo $dm_pesertaecp_add->Omset->caption() ?><?php echo $dm_pesertaecp_add->Omset->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_add->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_add->Omset->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Omset">
<input type="text" data-table="dm_pesertaecp" data-field="x_Omset" name="x_Omset" id="x_Omset" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_pesertaecp_add->Omset->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_add->Omset->EditValue ?>"<?php echo $dm_pesertaecp_add->Omset->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_add->Omset->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_add->Jumlah_Pegawai->Visible) { // Jumlah_Pegawai ?>
	<div id="r_Jumlah_Pegawai" class="form-group row">
		<label id="elh_dm_pesertaecp_Jumlah_Pegawai" for="x_Jumlah_Pegawai" class="<?php echo $dm_pesertaecp_add->LeftColumnClass ?>"><?php echo $dm_pesertaecp_add->Jumlah_Pegawai->caption() ?><?php echo $dm_pesertaecp_add->Jumlah_Pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_add->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_add->Jumlah_Pegawai->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Jumlah_Pegawai">
<input type="text" data-table="dm_pesertaecp" data-field="x_Jumlah_Pegawai" name="x_Jumlah_Pegawai" id="x_Jumlah_Pegawai" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($dm_pesertaecp_add->Jumlah_Pegawai->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_add->Jumlah_Pegawai->EditValue ?>"<?php echo $dm_pesertaecp_add->Jumlah_Pegawai->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_add->Jumlah_Pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_add->Legalitas_Perusahaan->Visible) { // Legalitas_Perusahaan ?>
	<div id="r_Legalitas_Perusahaan" class="form-group row">
		<label id="elh_dm_pesertaecp_Legalitas_Perusahaan" for="x_Legalitas_Perusahaan" class="<?php echo $dm_pesertaecp_add->LeftColumnClass ?>"><?php echo $dm_pesertaecp_add->Legalitas_Perusahaan->caption() ?><?php echo $dm_pesertaecp_add->Legalitas_Perusahaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_add->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_add->Legalitas_Perusahaan->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Legalitas_Perusahaan">
<input type="text" data-table="dm_pesertaecp" data-field="x_Legalitas_Perusahaan" name="x_Legalitas_Perusahaan" id="x_Legalitas_Perusahaan" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($dm_pesertaecp_add->Legalitas_Perusahaan->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_add->Legalitas_Perusahaan->EditValue ?>"<?php echo $dm_pesertaecp_add->Legalitas_Perusahaan->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_add->Legalitas_Perusahaan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_add->Sertifikasi_dimiliki->Visible) { // Sertifikasi_dimiliki ?>
	<div id="r_Sertifikasi_dimiliki" class="form-group row">
		<label id="elh_dm_pesertaecp_Sertifikasi_dimiliki" for="x_Sertifikasi_dimiliki" class="<?php echo $dm_pesertaecp_add->LeftColumnClass ?>"><?php echo $dm_pesertaecp_add->Sertifikasi_dimiliki->caption() ?><?php echo $dm_pesertaecp_add->Sertifikasi_dimiliki->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_add->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_add->Sertifikasi_dimiliki->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Sertifikasi_dimiliki">
<input type="text" data-table="dm_pesertaecp" data-field="x_Sertifikasi_dimiliki" name="x_Sertifikasi_dimiliki" id="x_Sertifikasi_dimiliki" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($dm_pesertaecp_add->Sertifikasi_dimiliki->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_add->Sertifikasi_dimiliki->EditValue ?>"<?php echo $dm_pesertaecp_add->Sertifikasi_dimiliki->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_add->Sertifikasi_dimiliki->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_add->Handphone->Visible) { // Handphone ?>
	<div id="r_Handphone" class="form-group row">
		<label id="elh_dm_pesertaecp_Handphone" for="x_Handphone" class="<?php echo $dm_pesertaecp_add->LeftColumnClass ?>"><?php echo $dm_pesertaecp_add->Handphone->caption() ?><?php echo $dm_pesertaecp_add->Handphone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_add->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_add->Handphone->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Handphone">
<input type="text" data-table="dm_pesertaecp" data-field="x_Handphone" name="x_Handphone" id="x_Handphone" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($dm_pesertaecp_add->Handphone->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_add->Handphone->EditValue ?>"<?php echo $dm_pesertaecp_add->Handphone->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_add->Handphone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_add->Email_Add->Visible) { // Email_Add ?>
	<div id="r_Email_Add" class="form-group row">
		<label id="elh_dm_pesertaecp_Email_Add" for="x_Email_Add" class="<?php echo $dm_pesertaecp_add->LeftColumnClass ?>"><?php echo $dm_pesertaecp_add->Email_Add->caption() ?><?php echo $dm_pesertaecp_add->Email_Add->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_add->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_add->Email_Add->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Email_Add">
<input type="text" data-table="dm_pesertaecp" data-field="x_Email_Add" name="x_Email_Add" id="x_Email_Add" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_pesertaecp_add->Email_Add->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_add->Email_Add->EditValue ?>"<?php echo $dm_pesertaecp_add->Email_Add->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_add->Email_Add->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_add->Website->Visible) { // Website ?>
	<div id="r_Website" class="form-group row">
		<label id="elh_dm_pesertaecp_Website" for="x_Website" class="<?php echo $dm_pesertaecp_add->LeftColumnClass ?>"><?php echo $dm_pesertaecp_add->Website->caption() ?><?php echo $dm_pesertaecp_add->Website->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_add->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_add->Website->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Website">
<input type="text" data-table="dm_pesertaecp" data-field="x_Website" name="x_Website" id="x_Website" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_pesertaecp_add->Website->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_add->Website->EditValue ?>"<?php echo $dm_pesertaecp_add->Website->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_add->Website->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_add->Tahun_Berdiri->Visible) { // Tahun_Berdiri ?>
	<div id="r_Tahun_Berdiri" class="form-group row">
		<label id="elh_dm_pesertaecp_Tahun_Berdiri" for="x_Tahun_Berdiri" class="<?php echo $dm_pesertaecp_add->LeftColumnClass ?>"><?php echo $dm_pesertaecp_add->Tahun_Berdiri->caption() ?><?php echo $dm_pesertaecp_add->Tahun_Berdiri->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_add->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_add->Tahun_Berdiri->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Tahun_Berdiri">
<input type="text" data-table="dm_pesertaecp" data-field="x_Tahun_Berdiri" name="x_Tahun_Berdiri" id="x_Tahun_Berdiri" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dm_pesertaecp_add->Tahun_Berdiri->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_add->Tahun_Berdiri->EditValue ?>"<?php echo $dm_pesertaecp_add->Tahun_Berdiri->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_add->Tahun_Berdiri->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_add->Alamat_Produksi->Visible) { // Alamat_Produksi ?>
	<div id="r_Alamat_Produksi" class="form-group row">
		<label id="elh_dm_pesertaecp_Alamat_Produksi" for="x_Alamat_Produksi" class="<?php echo $dm_pesertaecp_add->LeftColumnClass ?>"><?php echo $dm_pesertaecp_add->Alamat_Produksi->caption() ?><?php echo $dm_pesertaecp_add->Alamat_Produksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_add->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_add->Alamat_Produksi->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Alamat_Produksi">
<textarea data-table="dm_pesertaecp" data-field="x_Alamat_Produksi" name="x_Alamat_Produksi" id="x_Alamat_Produksi" cols="35" rows="4" placeholder="<?php echo HtmlEncode($dm_pesertaecp_add->Alamat_Produksi->getPlaceHolder()) ?>"<?php echo $dm_pesertaecp_add->Alamat_Produksi->editAttributes() ?>><?php echo $dm_pesertaecp_add->Alamat_Produksi->EditValue ?></textarea>
</span>
<?php echo $dm_pesertaecp_add->Alamat_Produksi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_add->Wilayah_ECP->Visible) { // Wilayah_ECP ?>
	<div id="r_Wilayah_ECP" class="form-group row">
		<label id="elh_dm_pesertaecp_Wilayah_ECP" for="x_Wilayah_ECP" class="<?php echo $dm_pesertaecp_add->LeftColumnClass ?>"><?php echo $dm_pesertaecp_add->Wilayah_ECP->caption() ?><?php echo $dm_pesertaecp_add->Wilayah_ECP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_add->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_add->Wilayah_ECP->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Wilayah_ECP">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dm_pesertaecp" data-field="x_Wilayah_ECP" data-value-separator="<?php echo $dm_pesertaecp_add->Wilayah_ECP->displayValueSeparatorAttribute() ?>" id="x_Wilayah_ECP" name="x_Wilayah_ECP"<?php echo $dm_pesertaecp_add->Wilayah_ECP->editAttributes() ?>>
			<?php echo $dm_pesertaecp_add->Wilayah_ECP->selectOptionListHtml("x_Wilayah_ECP") ?>
		</select>
</div>
<?php echo $dm_pesertaecp_add->Wilayah_ECP->Lookup->getParamTag($dm_pesertaecp_add, "p_x_Wilayah_ECP") ?>
</span>
<?php echo $dm_pesertaecp_add->Wilayah_ECP->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dm_pesertaecp_add->Tahun_ECP->Visible) { // Tahun_ECP ?>
	<div id="r_Tahun_ECP" class="form-group row">
		<label id="elh_dm_pesertaecp_Tahun_ECP" for="x_Tahun_ECP" class="<?php echo $dm_pesertaecp_add->LeftColumnClass ?>"><?php echo $dm_pesertaecp_add->Tahun_ECP->caption() ?><?php echo $dm_pesertaecp_add->Tahun_ECP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dm_pesertaecp_add->RightColumnClass ?>"><div <?php echo $dm_pesertaecp_add->Tahun_ECP->cellAttributes() ?>>
<span id="el_dm_pesertaecp_Tahun_ECP">
<input type="text" data-table="dm_pesertaecp" data-field="x_Tahun_ECP" name="x_Tahun_ECP" id="x_Tahun_ECP" size="4" maxlength="4" placeholder="<?php echo HtmlEncode($dm_pesertaecp_add->Tahun_ECP->getPlaceHolder()) ?>" value="<?php echo $dm_pesertaecp_add->Tahun_ECP->EditValue ?>"<?php echo $dm_pesertaecp_add->Tahun_ECP->editAttributes() ?>>
</span>
<?php echo $dm_pesertaecp_add->Tahun_ECP->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$dm_pesertaecp_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $dm_pesertaecp_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $dm_pesertaecp_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$dm_pesertaecp_add->showPageFooter();
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
$dm_pesertaecp_add->terminate();
?>