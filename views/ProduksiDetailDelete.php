<?php

namespace PHPMaker2021\simtrial;

// Page object
$ProduksiDetailDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fproduksi_detaildelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fproduksi_detaildelete = currentForm = new ew.Form("fproduksi_detaildelete", "delete");
    loadjs.done("fproduksi_detaildelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.produksi_detail) ew.vars.tables.produksi_detail = <?= JsonEncode(GetClientVar("tables", "produksi_detail")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fproduksi_detaildelete" id="fproduksi_detaildelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="produksi_detail">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_produksi_detail_id" class="produksi_detail_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->idproduksi->Visible) { // idproduksi ?>
        <th class="<?= $Page->idproduksi->headerCellClass() ?>"><span id="elh_produksi_detail_idproduksi" class="produksi_detail_idproduksi"><?= $Page->idproduksi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->idproduk->Visible) { // idproduk ?>
        <th class="<?= $Page->idproduk->headerCellClass() ?>"><span id="elh_produksi_detail_idproduk" class="produksi_detail_idproduk"><?= $Page->idproduk->caption() ?></span></th>
<?php } ?>
<?php if ($Page->target->Visible) { // target ?>
        <th class="<?= $Page->target->headerCellClass() ?>"><span id="elh_produksi_detail_target" class="produksi_detail_target"><?= $Page->target->caption() ?></span></th>
<?php } ?>
<?php if ($Page->realisasi->Visible) { // realisasi ?>
        <th class="<?= $Page->realisasi->headerCellClass() ?>"><span id="elh_produksi_detail_realisasi" class="produksi_detail_realisasi"><?= $Page->realisasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->persentase->Visible) { // persentase ?>
        <th class="<?= $Page->persentase->headerCellClass() ?>"><span id="elh_produksi_detail_persentase" class="produksi_detail_persentase"><?= $Page->persentase->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->id->Visible) { // id ?>
        <td <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_produksi_detail_id" class="produksi_detail_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->idproduksi->Visible) { // idproduksi ?>
        <td <?= $Page->idproduksi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_produksi_detail_idproduksi" class="produksi_detail_idproduksi">
<span<?= $Page->idproduksi->viewAttributes() ?>>
<?= $Page->idproduksi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->idproduk->Visible) { // idproduk ?>
        <td <?= $Page->idproduk->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_produksi_detail_idproduk" class="produksi_detail_idproduk">
<span<?= $Page->idproduk->viewAttributes() ?>>
<?= $Page->idproduk->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->target->Visible) { // target ?>
        <td <?= $Page->target->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_produksi_detail_target" class="produksi_detail_target">
<span<?= $Page->target->viewAttributes() ?>>
<?= $Page->target->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->realisasi->Visible) { // realisasi ?>
        <td <?= $Page->realisasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_produksi_detail_realisasi" class="produksi_detail_realisasi">
<span<?= $Page->realisasi->viewAttributes() ?>>
<?= $Page->realisasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->persentase->Visible) { // persentase ?>
        <td <?= $Page->persentase->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_produksi_detail_persentase" class="produksi_detail_persentase">
<span<?= $Page->persentase->viewAttributes() ?>>
<?= $Page->persentase->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
