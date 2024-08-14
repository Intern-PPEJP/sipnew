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
$t_bagian_view = new t_bagian_view();

// Run the page
$t_bagian_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_bagian_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_bagian_view->isExport()) { ?>
<script>
var ft_bagianview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ft_bagianview = currentForm = new ew.Form("ft_bagianview", "view");
	loadjs.done("ft_bagianview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_bagian_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_bagian_view->ExportOptions->render("body") ?>
<?php $t_bagian_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_bagian_view->showPageHeader(); ?>
<?php
$t_bagian_view->showMessage();
?>
<form name="ft_bagianview" id="ft_bagianview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_bagian">
<input type="hidden" name="modal" value="<?php echo (int)$t_bagian_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_bagian_view->kdbagian->Visible) { // kdbagian ?>
	<tr id="r_kdbagian">
		<td class="<?php echo $t_bagian_view->TableLeftColumnClass ?>"><span id="elh_t_bagian_kdbagian"><?php echo $t_bagian_view->kdbagian->caption() ?></span></td>
		<td data-name="kdbagian" <?php echo $t_bagian_view->kdbagian->cellAttributes() ?>>
<span id="el_t_bagian_kdbagian">
<span<?php echo $t_bagian_view->kdbagian->viewAttributes() ?>><?php echo $t_bagian_view->kdbagian->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_bagian_view->namabagian->Visible) { // namabagian ?>
	<tr id="r_namabagian">
		<td class="<?php echo $t_bagian_view->TableLeftColumnClass ?>"><span id="elh_t_bagian_namabagian"><?php echo $t_bagian_view->namabagian->caption() ?></span></td>
		<td data-name="namabagian" <?php echo $t_bagian_view->namabagian->cellAttributes() ?>>
<span id="el_t_bagian_namabagian">
<span<?php echo $t_bagian_view->namabagian->viewAttributes() ?>><?php echo $t_bagian_view->namabagian->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$t_bagian_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_bagian_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$t_bagian_view->terminate();
?>