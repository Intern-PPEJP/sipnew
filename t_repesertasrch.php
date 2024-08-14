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
$t_repeserta_search = new t_repeserta_search();

// Run the page
$t_repeserta_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_repeserta_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_repesertasearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($t_repeserta_search->IsModal) { ?>
	ft_repesertasearch = currentAdvancedSearchForm = new ew.Form("ft_repesertasearch", "search");
	<?php } else { ?>
	ft_repesertasearch = currentForm = new ew.Form("ft_repesertasearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	ft_repesertasearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_tgl_daftar");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_repeserta_search->tgl_daftar->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tgl_bayar");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($t_repeserta_search->tgl_bayar->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	ft_repesertasearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_repesertasearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_repesertasearch.lists["x_jabatan"] = <?php echo $t_repeserta_search->jabatan->Lookup->toClientList($t_repeserta_search) ?>;
	ft_repesertasearch.lists["x_jabatan"].options = <?php echo JsonEncode($t_repeserta_search->jabatan->lookupOptions()) ?>;
	ft_repesertasearch.autoSuggests["x_jabatan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ft_repesertasearch.lists["x_cara_bayar"] = <?php echo $t_repeserta_search->cara_bayar->Lookup->toClientList($t_repeserta_search) ?>;
	ft_repesertasearch.lists["x_cara_bayar"].options = <?php echo JsonEncode($t_repeserta_search->cara_bayar->options(FALSE, TRUE)) ?>;
	ft_repesertasearch.lists["x_kdinformasi"] = <?php echo $t_repeserta_search->kdinformasi->Lookup->toClientList($t_repeserta_search) ?>;
	ft_repesertasearch.lists["x_kdinformasi"].options = <?php echo JsonEncode($t_repeserta_search->kdinformasi->lookupOptions()) ?>;
	ft_repesertasearch.lists["x_konfirmasi"] = <?php echo $t_repeserta_search->konfirmasi->Lookup->toClientList($t_repeserta_search) ?>;
	ft_repesertasearch.lists["x_konfirmasi"].options = <?php echo JsonEncode($t_repeserta_search->konfirmasi->options(FALSE, TRUE)) ?>;
	ft_repesertasearch.lists["x_ket"] = <?php echo $t_repeserta_search->ket->Lookup->toClientList($t_repeserta_search) ?>;
	ft_repesertasearch.lists["x_ket"].options = <?php echo JsonEncode($t_repeserta_search->ket->options(FALSE, TRUE)) ?>;
	loadjs.done("ft_repesertasearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_repeserta_search->showPageHeader(); ?>
<?php
$t_repeserta_search->showMessage();
?>
<form name="ft_repesertasearch" id="ft_repesertasearch" class="<?php echo $t_repeserta_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_repeserta">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$t_repeserta_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($t_repeserta_search->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label for="x_nama" class="<?php echo $t_repeserta_search->LeftColumnClass ?>"><span id="elh_t_repeserta_nama"><?php echo $t_repeserta_search->nama->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nama" id="z_nama" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_repeserta_search->RightColumnClass ?>"><div <?php echo $t_repeserta_search->nama->cellAttributes() ?>>
			<span id="el_t_repeserta_nama" class="ew-search-field">
<input type="text" data-table="t_repeserta" data-field="x_nama" name="x_nama" id="x_nama" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_search->nama->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_search->nama->EditValue ?>"<?php echo $t_repeserta_search->nama->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_search->perusahaan->Visible) { // perusahaan ?>
	<div id="r_perusahaan" class="form-group row">
		<label for="x_perusahaan" class="<?php echo $t_repeserta_search->LeftColumnClass ?>"><span id="elh_t_repeserta_perusahaan"><?php echo $t_repeserta_search->perusahaan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_perusahaan" id="z_perusahaan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_repeserta_search->RightColumnClass ?>"><div <?php echo $t_repeserta_search->perusahaan->cellAttributes() ?>>
			<span id="el_t_repeserta_perusahaan" class="ew-search-field">
<input type="text" data-table="t_repeserta" data-field="x_perusahaan" name="x_perusahaan" id="x_perusahaan" size="55" maxlength="255" placeholder="<?php echo HtmlEncode($t_repeserta_search->perusahaan->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_search->perusahaan->EditValue ?>"<?php echo $t_repeserta_search->perusahaan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_search->jabatan->Visible) { // jabatan ?>
	<div id="r_jabatan" class="form-group row">
		<label class="<?php echo $t_repeserta_search->LeftColumnClass ?>"><span id="elh_t_repeserta_jabatan"><?php echo $t_repeserta_search->jabatan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_jabatan" id="z_jabatan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_repeserta_search->RightColumnClass ?>"><div <?php echo $t_repeserta_search->jabatan->cellAttributes() ?>>
			<span id="el_t_repeserta_jabatan" class="ew-search-field">
<?php
$onchange = $t_repeserta_search->jabatan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$t_repeserta_search->jabatan->EditAttrs["onchange"] = "";
?>
<span id="as_x_jabatan">
	<input type="text" class="form-control" name="sv_x_jabatan" id="sv_x_jabatan" value="<?php echo RemoveHtml($t_repeserta_search->jabatan->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_search->jabatan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($t_repeserta_search->jabatan->getPlaceHolder()) ?>"<?php echo $t_repeserta_search->jabatan->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_repeserta" data-field="x_jabatan" data-value-separator="<?php echo $t_repeserta_search->jabatan->displayValueSeparatorAttribute() ?>" name="x_jabatan" id="x_jabatan" value="<?php echo HtmlEncode($t_repeserta_search->jabatan->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ft_repesertasearch"], function() {
	ft_repesertasearch.createAutoSuggest({"id":"x_jabatan","forceSelect":true});
});
</script>
<?php echo $t_repeserta_search->jabatan->Lookup->getParamTag($t_repeserta_search, "p_x_jabatan") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_search->tgl_daftar->Visible) { // tgl_daftar ?>
	<div id="r_tgl_daftar" class="form-group row">
		<label for="x_tgl_daftar" class="<?php echo $t_repeserta_search->LeftColumnClass ?>"><span id="elh_t_repeserta_tgl_daftar"><?php echo $t_repeserta_search->tgl_daftar->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tgl_daftar" id="z_tgl_daftar" value="=">
</span>
		</label>
		<div class="<?php echo $t_repeserta_search->RightColumnClass ?>"><div <?php echo $t_repeserta_search->tgl_daftar->cellAttributes() ?>>
			<span id="el_t_repeserta_tgl_daftar" class="ew-search-field">
<input type="text" data-table="t_repeserta" data-field="x_tgl_daftar" name="x_tgl_daftar" id="x_tgl_daftar" size="10" maxlength="19" placeholder="<?php echo HtmlEncode($t_repeserta_search->tgl_daftar->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_search->tgl_daftar->EditValue ?>"<?php echo $t_repeserta_search->tgl_daftar->editAttributes() ?>>
<?php if (!$t_repeserta_search->tgl_daftar->ReadOnly && !$t_repeserta_search->tgl_daftar->Disabled && !isset($t_repeserta_search->tgl_daftar->EditAttrs["readonly"]) && !isset($t_repeserta_search->tgl_daftar->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_repesertasearch", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_repesertasearch", "x_tgl_daftar", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_search->telp->Visible) { // telp ?>
	<div id="r_telp" class="form-group row">
		<label for="x_telp" class="<?php echo $t_repeserta_search->LeftColumnClass ?>"><span id="elh_t_repeserta_telp"><?php echo $t_repeserta_search->telp->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_telp" id="z_telp" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_repeserta_search->RightColumnClass ?>"><div <?php echo $t_repeserta_search->telp->cellAttributes() ?>>
			<span id="el_t_repeserta_telp" class="ew-search-field">
<input type="text" data-table="t_repeserta" data-field="x_telp" name="x_telp" id="x_telp" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_search->telp->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_search->telp->EditValue ?>"<?php echo $t_repeserta_search->telp->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_search->fax->Visible) { // fax ?>
	<div id="r_fax" class="form-group row">
		<label for="x_fax" class="<?php echo $t_repeserta_search->LeftColumnClass ?>"><span id="elh_t_repeserta_fax"><?php echo $t_repeserta_search->fax->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_fax" id="z_fax" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_repeserta_search->RightColumnClass ?>"><div <?php echo $t_repeserta_search->fax->cellAttributes() ?>>
			<span id="el_t_repeserta_fax" class="ew-search-field">
<input type="text" data-table="t_repeserta" data-field="x_fax" name="x_fax" id="x_fax" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_search->fax->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_search->fax->EditValue ?>"<?php echo $t_repeserta_search->fax->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_search->hp->Visible) { // hp ?>
	<div id="r_hp" class="form-group row">
		<label for="x_hp" class="<?php echo $t_repeserta_search->LeftColumnClass ?>"><span id="elh_t_repeserta_hp"><?php echo $t_repeserta_search->hp->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_hp" id="z_hp" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_repeserta_search->RightColumnClass ?>"><div <?php echo $t_repeserta_search->hp->cellAttributes() ?>>
			<span id="el_t_repeserta_hp" class="ew-search-field">
<input type="text" data-table="t_repeserta" data-field="x_hp" name="x_hp" id="x_hp" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($t_repeserta_search->hp->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_search->hp->EditValue ?>"<?php echo $t_repeserta_search->hp->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_search->produk->Visible) { // produk ?>
	<div id="r_produk" class="form-group row">
		<label for="x_produk" class="<?php echo $t_repeserta_search->LeftColumnClass ?>"><span id="elh_t_repeserta_produk"><?php echo $t_repeserta_search->produk->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_produk" id="z_produk" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_repeserta_search->RightColumnClass ?>"><div <?php echo $t_repeserta_search->produk->cellAttributes() ?>>
			<span id="el_t_repeserta_produk" class="ew-search-field">
<input type="text" data-table="t_repeserta" data-field="x_produk" name="x_produk" id="x_produk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($t_repeserta_search->produk->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_search->produk->EditValue ?>"<?php echo $t_repeserta_search->produk->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_search->cara_bayar->Visible) { // cara_bayar ?>
	<div id="r_cara_bayar" class="form-group row">
		<label class="<?php echo $t_repeserta_search->LeftColumnClass ?>"><span id="elh_t_repeserta_cara_bayar"><?php echo $t_repeserta_search->cara_bayar->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_cara_bayar" id="z_cara_bayar" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_repeserta_search->RightColumnClass ?>"><div <?php echo $t_repeserta_search->cara_bayar->cellAttributes() ?>>
			<span id="el_t_repeserta_cara_bayar" class="ew-search-field">
<div id="tp_x_cara_bayar" class="ew-template"><input type="radio" class="custom-control-input" data-table="t_repeserta" data-field="x_cara_bayar" data-value-separator="<?php echo $t_repeserta_search->cara_bayar->displayValueSeparatorAttribute() ?>" name="x_cara_bayar" id="x_cara_bayar" value="{value}"<?php echo $t_repeserta_search->cara_bayar->editAttributes() ?>></div>
<div id="dsl_x_cara_bayar" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $t_repeserta_search->cara_bayar->radioButtonListHtml(FALSE, "x_cara_bayar") ?>
</div></div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_search->ket_bayar->Visible) { // ket_bayar ?>
	<div id="r_ket_bayar" class="form-group row">
		<label for="x_ket_bayar" class="<?php echo $t_repeserta_search->LeftColumnClass ?>"><span id="elh_t_repeserta_ket_bayar"><?php echo $t_repeserta_search->ket_bayar->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ket_bayar" id="z_ket_bayar" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_repeserta_search->RightColumnClass ?>"><div <?php echo $t_repeserta_search->ket_bayar->cellAttributes() ?>>
			<span id="el_t_repeserta_ket_bayar" class="ew-search-field">
<input type="text" data-table="t_repeserta" data-field="x_ket_bayar" name="x_ket_bayar" id="x_ket_bayar" size="35" placeholder="<?php echo HtmlEncode($t_repeserta_search->ket_bayar->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_search->ket_bayar->EditValue ?>"<?php echo $t_repeserta_search->ket_bayar->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_search->tgl_bayar->Visible) { // tgl_bayar ?>
	<div id="r_tgl_bayar" class="form-group row">
		<label for="x_tgl_bayar" class="<?php echo $t_repeserta_search->LeftColumnClass ?>"><span id="elh_t_repeserta_tgl_bayar"><?php echo $t_repeserta_search->tgl_bayar->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tgl_bayar" id="z_tgl_bayar" value="=">
</span>
		</label>
		<div class="<?php echo $t_repeserta_search->RightColumnClass ?>"><div <?php echo $t_repeserta_search->tgl_bayar->cellAttributes() ?>>
			<span id="el_t_repeserta_tgl_bayar" class="ew-search-field">
<input type="text" data-table="t_repeserta" data-field="x_tgl_bayar" name="x_tgl_bayar" id="x_tgl_bayar" size="10" maxlength="19" placeholder="<?php echo HtmlEncode($t_repeserta_search->tgl_bayar->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_search->tgl_bayar->EditValue ?>"<?php echo $t_repeserta_search->tgl_bayar->editAttributes() ?>>
<?php if (!$t_repeserta_search->tgl_bayar->ReadOnly && !$t_repeserta_search->tgl_bayar->Disabled && !isset($t_repeserta_search->tgl_bayar->EditAttrs["readonly"]) && !isset($t_repeserta_search->tgl_bayar->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ft_repesertasearch", "datetimepicker"], function() {
	ew.createDateTimePicker("ft_repesertasearch", "x_tgl_bayar", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_search->kdinformasi->Visible) { // kdinformasi ?>
	<div id="r_kdinformasi" class="form-group row">
		<label for="x_kdinformasi" class="<?php echo $t_repeserta_search->LeftColumnClass ?>"><span id="elh_t_repeserta_kdinformasi"><?php echo $t_repeserta_search->kdinformasi->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kdinformasi" id="z_kdinformasi" value="=">
</span>
		</label>
		<div class="<?php echo $t_repeserta_search->RightColumnClass ?>"><div <?php echo $t_repeserta_search->kdinformasi->cellAttributes() ?>>
			<span id="el_t_repeserta_kdinformasi" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_repeserta" data-field="x_kdinformasi" data-value-separator="<?php echo $t_repeserta_search->kdinformasi->displayValueSeparatorAttribute() ?>" id="x_kdinformasi" name="x_kdinformasi"<?php echo $t_repeserta_search->kdinformasi->editAttributes() ?>>
			<?php echo $t_repeserta_search->kdinformasi->selectOptionListHtml("x_kdinformasi") ?>
		</select>
</div>
<?php echo $t_repeserta_search->kdinformasi->Lookup->getParamTag($t_repeserta_search, "p_x_kdinformasi") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_search->konfirmasi->Visible) { // konfirmasi ?>
	<div id="r_konfirmasi" class="form-group row">
		<label for="x_konfirmasi" class="<?php echo $t_repeserta_search->LeftColumnClass ?>"><span id="elh_t_repeserta_konfirmasi"><?php echo $t_repeserta_search->konfirmasi->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_konfirmasi" id="z_konfirmasi" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_repeserta_search->RightColumnClass ?>"><div <?php echo $t_repeserta_search->konfirmasi->cellAttributes() ?>>
			<span id="el_t_repeserta_konfirmasi" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_repeserta" data-field="x_konfirmasi" data-value-separator="<?php echo $t_repeserta_search->konfirmasi->displayValueSeparatorAttribute() ?>" id="x_konfirmasi" name="x_konfirmasi"<?php echo $t_repeserta_search->konfirmasi->editAttributes() ?>>
			<?php echo $t_repeserta_search->konfirmasi->selectOptionListHtml("x_konfirmasi") ?>
		</select>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_search->ket->Visible) { // ket ?>
	<div id="r_ket" class="form-group row">
		<label for="x_ket" class="<?php echo $t_repeserta_search->LeftColumnClass ?>"><span id="elh_t_repeserta_ket"><?php echo $t_repeserta_search->ket->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ket" id="z_ket" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_repeserta_search->RightColumnClass ?>"><div <?php echo $t_repeserta_search->ket->cellAttributes() ?>>
			<span id="el_t_repeserta_ket" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_repeserta" data-field="x_ket" data-value-separator="<?php echo $t_repeserta_search->ket->displayValueSeparatorAttribute() ?>" id="x_ket" name="x_ket"<?php echo $t_repeserta_search->ket->editAttributes() ?>>
			<?php echo $t_repeserta_search->ket->selectOptionListHtml("x_ket") ?>
		</select>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_repeserta_search->ket_lainnya->Visible) { // ket_lainnya ?>
	<div id="r_ket_lainnya" class="form-group row">
		<label for="x_ket_lainnya" class="<?php echo $t_repeserta_search->LeftColumnClass ?>"><span id="elh_t_repeserta_ket_lainnya"><?php echo $t_repeserta_search->ket_lainnya->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ket_lainnya" id="z_ket_lainnya" value="LIKE">
</span>
		</label>
		<div class="<?php echo $t_repeserta_search->RightColumnClass ?>"><div <?php echo $t_repeserta_search->ket_lainnya->cellAttributes() ?>>
			<span id="el_t_repeserta_ket_lainnya" class="ew-search-field">
<input type="text" data-table="t_repeserta" data-field="x_ket_lainnya" name="x_ket_lainnya" id="x_ket_lainnya" size="35" placeholder="<?php echo HtmlEncode($t_repeserta_search->ket_lainnya->getPlaceHolder()) ?>" value="<?php echo $t_repeserta_search->ket_lainnya->EditValue ?>"<?php echo $t_repeserta_search->ket_lainnya->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_repeserta_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_repeserta_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_repeserta_search->showPageFooter();
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
$t_repeserta_search->terminate();
?>