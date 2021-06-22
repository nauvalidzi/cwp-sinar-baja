<?php

namespace PHPMaker2021\simtrial;

// Page object
$ProduksiDetailList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fproduksi_detaillist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fproduksi_detaillist = currentForm = new ew.Form("fproduksi_detaillist", "list");
    fproduksi_detaillist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fproduksi_detaillist");
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
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Page->isExport() || Config("EXPORT_MASTER_RECORD") && $Page->isExport("print")) { ?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "produk") {
    if ($Page->MasterRecordExists) {
        include_once "views/ProdukMaster.php";
    }
}
?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "produksi") {
    if ($Page->MasterRecordExists) {
        include_once "views/ProduksiMaster.php";
    }
}
?>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> produksi_detail">
<form name="fproduksi_detaillist" id="fproduksi_detaillist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="produksi_detail">
<?php if ($Page->getCurrentMasterTable() == "produk" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="produk">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->idproduk->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "produksi" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="produksi">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->idproduksi->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_produksi_detail" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_produksi_detaillist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_produksi_detail_id" class="produksi_detail_id"><?= $Page->renderSort($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->idproduksi->Visible) { // idproduksi ?>
        <th data-name="idproduksi" class="<?= $Page->idproduksi->headerCellClass() ?>"><div id="elh_produksi_detail_idproduksi" class="produksi_detail_idproduksi"><?= $Page->renderSort($Page->idproduksi) ?></div></th>
<?php } ?>
<?php if ($Page->idproduk->Visible) { // idproduk ?>
        <th data-name="idproduk" class="<?= $Page->idproduk->headerCellClass() ?>"><div id="elh_produksi_detail_idproduk" class="produksi_detail_idproduk"><?= $Page->renderSort($Page->idproduk) ?></div></th>
<?php } ?>
<?php if ($Page->target->Visible) { // target ?>
        <th data-name="target" class="<?= $Page->target->headerCellClass() ?>"><div id="elh_produksi_detail_target" class="produksi_detail_target"><?= $Page->renderSort($Page->target) ?></div></th>
<?php } ?>
<?php if ($Page->realisasi->Visible) { // realisasi ?>
        <th data-name="realisasi" class="<?= $Page->realisasi->headerCellClass() ?>"><div id="elh_produksi_detail_realisasi" class="produksi_detail_realisasi"><?= $Page->renderSort($Page->realisasi) ?></div></th>
<?php } ?>
<?php if ($Page->persentase->Visible) { // persentase ?>
        <th data-name="persentase" class="<?= $Page->persentase->headerCellClass() ?>"><div id="elh_produksi_detail_persentase" class="produksi_detail_persentase"><?= $Page->renderSort($Page->persentase) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_produksi_detail", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_produksi_detail_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->idproduksi->Visible) { // idproduksi ?>
        <td data-name="idproduksi" <?= $Page->idproduksi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_produksi_detail_idproduksi">
<span<?= $Page->idproduksi->viewAttributes() ?>>
<?= $Page->idproduksi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->idproduk->Visible) { // idproduk ?>
        <td data-name="idproduk" <?= $Page->idproduk->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_produksi_detail_idproduk">
<span<?= $Page->idproduk->viewAttributes() ?>>
<?= $Page->idproduk->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->target->Visible) { // target ?>
        <td data-name="target" <?= $Page->target->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_produksi_detail_target">
<span<?= $Page->target->viewAttributes() ?>>
<?= $Page->target->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->realisasi->Visible) { // realisasi ?>
        <td data-name="realisasi" <?= $Page->realisasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_produksi_detail_realisasi">
<span<?= $Page->realisasi->viewAttributes() ?>>
<?= $Page->realisasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->persentase->Visible) { // persentase ?>
        <td data-name="persentase" <?= $Page->persentase->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_produksi_detail_persentase">
<span<?= $Page->persentase->viewAttributes() ?>>
<?= $Page->persentase->getViewValue() ?></span>
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
    ew.addEventHandlers("produksi_detail");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
