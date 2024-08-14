<?php

namespace PHPMaker2021\import_ppei;

// Page object
$PerusahaanList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fPerusahaanlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fPerusahaanlist = currentForm = new ew.Form("fPerusahaanlist", "list");
    fPerusahaanlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fPerusahaanlist");
});
var fPerusahaanlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fPerusahaanlistsrch = currentSearchForm = new ew.Form("fPerusahaanlistsrch");

    // Dynamic selection lists

    // Filters
    fPerusahaanlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fPerusahaanlistsrch");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction) { ?>
<form name="fPerusahaanlistsrch" id="fPerusahaanlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fPerusahaanlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Perusahaan">
    <div class="ew-extended-search">
<div id="xsr_<?= $Page->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
    <div class="ew-quick-search input-group">
        <input type="text" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>">
        <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
        <div class="input-group-append">
            <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
            <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?= $Language->phrase("QuickSearchAuto") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?= $Language->phrase("QuickSearchExact") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?= $Language->phrase("QuickSearchAll") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?= $Language->phrase("QuickSearchAny") ?></a>
            </div>
        </div>
    </div>
</div>
    </div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Perusahaan">
<?php if (!$Page->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fPerusahaanlist" id="fPerusahaanlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="Perusahaan">
<div id="gmp_Perusahaan" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_Perusahaanlist" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->idp->Visible) { // idp ?>
        <th data-name="idp" class="<?= $Page->idp->headerCellClass() ?>"><div id="elh_Perusahaan_idp" class="Perusahaan_idp"><?= $Page->renderSort($Page->idp) ?></div></th>
<?php } ?>
<?php if ($Page->namap->Visible) { // namap ?>
        <th data-name="namap" class="<?= $Page->namap->headerCellClass() ?>"><div id="elh_Perusahaan_namap" class="Perusahaan_namap"><?= $Page->renderSort($Page->namap) ?></div></th>
<?php } ?>
<?php if ($Page->kontak->Visible) { // kontak ?>
        <th data-name="kontak" class="<?= $Page->kontak->headerCellClass() ?>"><div id="elh_Perusahaan_kontak" class="Perusahaan_kontak"><?= $Page->renderSort($Page->kontak) ?></div></th>
<?php } ?>
<?php if ($Page->kdprop->Visible) { // kdprop ?>
        <th data-name="kdprop" class="<?= $Page->kdprop->headerCellClass() ?>"><div id="elh_Perusahaan_kdprop" class="Perusahaan_kdprop"><?= $Page->renderSort($Page->kdprop) ?></div></th>
<?php } ?>
<?php if ($Page->kdkota->Visible) { // kdkota ?>
        <th data-name="kdkota" class="<?= $Page->kdkota->headerCellClass() ?>"><div id="elh_Perusahaan_kdkota" class="Perusahaan_kdkota"><?= $Page->renderSort($Page->kdkota) ?></div></th>
<?php } ?>
<?php if ($Page->emailp->Visible) { // emailp ?>
        <th data-name="emailp" class="<?= $Page->emailp->headerCellClass() ?>"><div id="elh_Perusahaan_emailp" class="Perusahaan_emailp"><?= $Page->renderSort($Page->emailp) ?></div></th>
<?php } ?>
<?php if ($Page->webp->Visible) { // webp ?>
        <th data-name="webp" class="<?= $Page->webp->headerCellClass() ?>"><div id="elh_Perusahaan_webp" class="Perusahaan_webp"><?= $Page->renderSort($Page->webp) ?></div></th>
<?php } ?>
<?php if ($Page->medsos->Visible) { // medsos ?>
        <th data-name="medsos" class="<?= $Page->medsos->headerCellClass() ?>"><div id="elh_Perusahaan_medsos" class="Perusahaan_medsos"><?= $Page->renderSort($Page->medsos) ?></div></th>
<?php } ?>
<?php if ($Page->kdproduknafed->Visible) { // kdproduknafed ?>
        <th data-name="kdproduknafed" class="<?= $Page->kdproduknafed->headerCellClass() ?>"><div id="elh_Perusahaan_kdproduknafed" class="Perusahaan_kdproduknafed"><?= $Page->renderSort($Page->kdproduknafed) ?></div></th>
<?php } ?>
<?php if ($Page->kdskala->Visible) { // kdskala ?>
        <th data-name="kdskala" class="<?= $Page->kdskala->headerCellClass() ?>"><div id="elh_Perusahaan_kdskala" class="Perusahaan_kdskala"><?= $Page->renderSort($Page->kdskala) ?></div></th>
<?php } ?>
<?php if ($Page->kdjenis->Visible) { // kdjenis ?>
        <th data-name="kdjenis" class="<?= $Page->kdjenis->headerCellClass() ?>"><div id="elh_Perusahaan_kdjenis" class="Perusahaan_kdjenis"><?= $Page->renderSort($Page->kdjenis) ?></div></th>
<?php } ?>
<?php if ($Page->kdexport->Visible) { // kdexport ?>
        <th data-name="kdexport" class="<?= $Page->kdexport->headerCellClass() ?>"><div id="elh_Perusahaan_kdexport" class="Perusahaan_kdexport"><?= $Page->renderSort($Page->kdexport) ?></div></th>
<?php } ?>
<?php if ($Page->kdkategori->Visible) { // kdkategori ?>
        <th data-name="kdkategori" class="<?= $Page->kdkategori->headerCellClass() ?>"><div id="elh_Perusahaan_kdkategori" class="Perusahaan_kdkategori"><?= $Page->renderSort($Page->kdkategori) ?></div></th>
<?php } ?>
<?php if ($Page->omzet_saat_ini->Visible) { // omzet_saat_ini ?>
        <th data-name="omzet_saat_ini" class="<?= $Page->omzet_saat_ini->headerCellClass() ?>"><div id="elh_Perusahaan_omzet_saat_ini" class="Perusahaan_omzet_saat_ini"><?= $Page->renderSort($Page->omzet_saat_ini) ?></div></th>
<?php } ?>
<?php if ($Page->kapasitas_saat_ini->Visible) { // kapasitas_saat_ini ?>
        <th data-name="kapasitas_saat_ini" class="<?= $Page->kapasitas_saat_ini->headerCellClass() ?>"><div id="elh_Perusahaan_kapasitas_saat_ini" class="Perusahaan_kapasitas_saat_ini"><?= $Page->renderSort($Page->kapasitas_saat_ini) ?></div></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th data-name="created_at" class="<?= $Page->created_at->headerCellClass() ?>"><div id="elh_Perusahaan_created_at" class="Perusahaan_created_at"><?= $Page->renderSort($Page->created_at) ?></div></th>
<?php } ?>
<?php if ($Page->imp->Visible) { // imp ?>
        <th data-name="imp" class="<?= $Page->imp->headerCellClass() ?>"><div id="elh_Perusahaan_imp" class="Perusahaan_imp"><?= $Page->renderSort($Page->imp) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif (!$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row id / data-rowindex
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_Perusahaan", "data-rowtype" => $Page->RowType]);

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->idp->Visible) { // idp ?>
        <td data-name="idp" <?= $Page->idp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Perusahaan_idp">
<span<?= $Page->idp->viewAttributes() ?>>
<?= $Page->idp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->namap->Visible) { // namap ?>
        <td data-name="namap" <?= $Page->namap->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Perusahaan_namap">
<span<?= $Page->namap->viewAttributes() ?>>
<?= $Page->namap->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kontak->Visible) { // kontak ?>
        <td data-name="kontak" <?= $Page->kontak->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Perusahaan_kontak">
<span<?= $Page->kontak->viewAttributes() ?>>
<?= $Page->kontak->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kdprop->Visible) { // kdprop ?>
        <td data-name="kdprop" <?= $Page->kdprop->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Perusahaan_kdprop">
<span<?= $Page->kdprop->viewAttributes() ?>>
<?= $Page->kdprop->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kdkota->Visible) { // kdkota ?>
        <td data-name="kdkota" <?= $Page->kdkota->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Perusahaan_kdkota">
<span<?= $Page->kdkota->viewAttributes() ?>>
<?= $Page->kdkota->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->emailp->Visible) { // emailp ?>
        <td data-name="emailp" <?= $Page->emailp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Perusahaan_emailp">
<span<?= $Page->emailp->viewAttributes() ?>>
<?= $Page->emailp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->webp->Visible) { // webp ?>
        <td data-name="webp" <?= $Page->webp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Perusahaan_webp">
<span<?= $Page->webp->viewAttributes() ?>>
<?= $Page->webp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->medsos->Visible) { // medsos ?>
        <td data-name="medsos" <?= $Page->medsos->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Perusahaan_medsos">
<span<?= $Page->medsos->viewAttributes() ?>>
<?= $Page->medsos->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kdproduknafed->Visible) { // kdproduknafed ?>
        <td data-name="kdproduknafed" <?= $Page->kdproduknafed->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Perusahaan_kdproduknafed">
<span<?= $Page->kdproduknafed->viewAttributes() ?>>
<?= $Page->kdproduknafed->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kdskala->Visible) { // kdskala ?>
        <td data-name="kdskala" <?= $Page->kdskala->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Perusahaan_kdskala">
<span<?= $Page->kdskala->viewAttributes() ?>>
<?= $Page->kdskala->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kdjenis->Visible) { // kdjenis ?>
        <td data-name="kdjenis" <?= $Page->kdjenis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Perusahaan_kdjenis">
<span<?= $Page->kdjenis->viewAttributes() ?>>
<?= $Page->kdjenis->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kdexport->Visible) { // kdexport ?>
        <td data-name="kdexport" <?= $Page->kdexport->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Perusahaan_kdexport">
<span<?= $Page->kdexport->viewAttributes() ?>>
<?= $Page->kdexport->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kdkategori->Visible) { // kdkategori ?>
        <td data-name="kdkategori" <?= $Page->kdkategori->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Perusahaan_kdkategori">
<span<?= $Page->kdkategori->viewAttributes() ?>>
<?= $Page->kdkategori->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->omzet_saat_ini->Visible) { // omzet_saat_ini ?>
        <td data-name="omzet_saat_ini" <?= $Page->omzet_saat_ini->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Perusahaan_omzet_saat_ini">
<span<?= $Page->omzet_saat_ini->viewAttributes() ?>>
<?= $Page->omzet_saat_ini->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kapasitas_saat_ini->Visible) { // kapasitas_saat_ini ?>
        <td data-name="kapasitas_saat_ini" <?= $Page->kapasitas_saat_ini->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Perusahaan_kapasitas_saat_ini">
<span<?= $Page->kapasitas_saat_ini->viewAttributes() ?>>
<?= $Page->kapasitas_saat_ini->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->created_at->Visible) { // created_at ?>
        <td data-name="created_at" <?= $Page->created_at->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Perusahaan_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->imp->Visible) { // imp ?>
        <td data-name="imp" <?= $Page->imp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Perusahaan_imp">
<span<?= $Page->imp->viewAttributes() ?>>
<?= $Page->imp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Page->TotalRecords == 0 && !$Page->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("Perusahaan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
