<?php

namespace PHPMaker2021\import_ppei;

// Page object
$PesertaList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fPesertalist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fPesertalist = currentForm = new ew.Form("fPesertalist", "list");
    fPesertalist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fPesertalist");
});
var fPesertalistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fPesertalistsrch = currentSearchForm = new ew.Form("fPesertalistsrch");

    // Dynamic selection lists

    // Filters
    fPesertalistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fPesertalistsrch");
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
<form name="fPesertalistsrch" id="fPesertalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fPesertalistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Peserta">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Peserta">
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
<form name="fPesertalist" id="fPesertalist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="Peserta">
<div id="gmp_Peserta" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_Pesertalist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_Peserta_id" class="Peserta_id"><?= $Page->renderSort($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <th data-name="nama" class="<?= $Page->nama->headerCellClass() ?>"><div id="elh_Peserta_nama" class="Peserta_nama"><?= $Page->renderSort($Page->nama) ?></div></th>
<?php } ?>
<?php if ($Page->idp->Visible) { // idp ?>
        <th data-name="idp" class="<?= $Page->idp->headerCellClass() ?>"><div id="elh_Peserta_idp" class="Peserta_idp"><?= $Page->renderSort($Page->idp) ?></div></th>
<?php } ?>
<?php if ($Page->tlahir->Visible) { // tlahir ?>
        <th data-name="tlahir" class="<?= $Page->tlahir->headerCellClass() ?>"><div id="elh_Peserta_tlahir" class="Peserta_tlahir"><?= $Page->renderSort($Page->tlahir) ?></div></th>
<?php } ?>
<?php if ($Page->telp->Visible) { // telp ?>
        <th data-name="telp" class="<?= $Page->telp->headerCellClass() ?>"><div id="elh_Peserta_telp" class="Peserta_telp"><?= $Page->renderSort($Page->telp) ?></div></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th data-name="_email" class="<?= $Page->_email->headerCellClass() ?>"><div id="elh_Peserta__email" class="Peserta__email"><?= $Page->renderSort($Page->_email) ?></div></th>
<?php } ?>
<?php if ($Page->kdprop->Visible) { // kdprop ?>
        <th data-name="kdprop" class="<?= $Page->kdprop->headerCellClass() ?>"><div id="elh_Peserta_kdprop" class="Peserta_kdprop"><?= $Page->renderSort($Page->kdprop) ?></div></th>
<?php } ?>
<?php if ($Page->kdkota->Visible) { // kdkota ?>
        <th data-name="kdkota" class="<?= $Page->kdkota->headerCellClass() ?>"><div id="elh_Peserta_kdkota" class="Peserta_kdkota"><?= $Page->renderSort($Page->kdkota) ?></div></th>
<?php } ?>
<?php if ($Page->kdsex->Visible) { // kdsex ?>
        <th data-name="kdsex" class="<?= $Page->kdsex->headerCellClass() ?>"><div id="elh_Peserta_kdsex" class="Peserta_kdsex"><?= $Page->renderSort($Page->kdsex) ?></div></th>
<?php } ?>
<?php if ($Page->hp->Visible) { // hp ?>
        <th data-name="hp" class="<?= $Page->hp->headerCellClass() ?>"><div id="elh_Peserta_hp" class="Peserta_hp"><?= $Page->renderSort($Page->hp) ?></div></th>
<?php } ?>
<?php if ($Page->kdjabat->Visible) { // kdjabat ?>
        <th data-name="kdjabat" class="<?= $Page->kdjabat->headerCellClass() ?>"><div id="elh_Peserta_kdjabat" class="Peserta_kdjabat"><?= $Page->renderSort($Page->kdjabat) ?></div></th>
<?php } ?>
<?php if ($Page->kdpend->Visible) { // kdpend ?>
        <th data-name="kdpend" class="<?= $Page->kdpend->headerCellClass() ?>"><div id="elh_Peserta_kdpend" class="Peserta_kdpend"><?= $Page->renderSort($Page->kdpend) ?></div></th>
<?php } ?>
<?php if ($Page->kdinformasi->Visible) { // kdinformasi ?>
        <th data-name="kdinformasi" class="<?= $Page->kdinformasi->headerCellClass() ?>"><div id="elh_Peserta_kdinformasi" class="Peserta_kdinformasi"><?= $Page->renderSort($Page->kdinformasi) ?></div></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th data-name="created_at" class="<?= $Page->created_at->headerCellClass() ?>"><div id="elh_Peserta_created_at" class="Peserta_created_at"><?= $Page->renderSort($Page->created_at) ?></div></th>
<?php } ?>
<?php if ($Page->imp->Visible) { // imp ?>
        <th data-name="imp" class="<?= $Page->imp->headerCellClass() ?>"><div id="elh_Peserta_imp" class="Peserta_imp"><?= $Page->renderSort($Page->imp) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_Peserta", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Peserta_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nama->Visible) { // nama ?>
        <td data-name="nama" <?= $Page->nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Peserta_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->idp->Visible) { // idp ?>
        <td data-name="idp" <?= $Page->idp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Peserta_idp">
<span<?= $Page->idp->viewAttributes() ?>>
<?= $Page->idp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tlahir->Visible) { // tlahir ?>
        <td data-name="tlahir" <?= $Page->tlahir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Peserta_tlahir">
<span<?= $Page->tlahir->viewAttributes() ?>>
<?= $Page->tlahir->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->telp->Visible) { // telp ?>
        <td data-name="telp" <?= $Page->telp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Peserta_telp">
<span<?= $Page->telp->viewAttributes() ?>>
<?= $Page->telp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_email->Visible) { // email ?>
        <td data-name="_email" <?= $Page->_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Peserta__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kdprop->Visible) { // kdprop ?>
        <td data-name="kdprop" <?= $Page->kdprop->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Peserta_kdprop">
<span<?= $Page->kdprop->viewAttributes() ?>>
<?= $Page->kdprop->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kdkota->Visible) { // kdkota ?>
        <td data-name="kdkota" <?= $Page->kdkota->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Peserta_kdkota">
<span<?= $Page->kdkota->viewAttributes() ?>>
<?= $Page->kdkota->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kdsex->Visible) { // kdsex ?>
        <td data-name="kdsex" <?= $Page->kdsex->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Peserta_kdsex">
<span<?= $Page->kdsex->viewAttributes() ?>>
<?= $Page->kdsex->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->hp->Visible) { // hp ?>
        <td data-name="hp" <?= $Page->hp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Peserta_hp">
<span<?= $Page->hp->viewAttributes() ?>>
<?= $Page->hp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kdjabat->Visible) { // kdjabat ?>
        <td data-name="kdjabat" <?= $Page->kdjabat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Peserta_kdjabat">
<span<?= $Page->kdjabat->viewAttributes() ?>>
<?= $Page->kdjabat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kdpend->Visible) { // kdpend ?>
        <td data-name="kdpend" <?= $Page->kdpend->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Peserta_kdpend">
<span<?= $Page->kdpend->viewAttributes() ?>>
<?= $Page->kdpend->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kdinformasi->Visible) { // kdinformasi ?>
        <td data-name="kdinformasi" <?= $Page->kdinformasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Peserta_kdinformasi">
<span<?= $Page->kdinformasi->viewAttributes() ?>>
<?= $Page->kdinformasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->created_at->Visible) { // created_at ?>
        <td data-name="created_at" <?= $Page->created_at->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Peserta_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->imp->Visible) { // imp ?>
        <td data-name="imp" <?= $Page->imp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Peserta_imp">
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
    ew.addEventHandlers("Peserta");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
