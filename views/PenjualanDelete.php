<?php

namespace PHPMaker2021\simtrial;

// Page object
$PenjualanDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpenjualandelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fpenjualandelete = currentForm = new ew.Form("fpenjualandelete", "delete");
    loadjs.done("fpenjualandelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.penjualan) ew.vars.tables.penjualan = <?= JsonEncode(GetClientVar("tables", "penjualan")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpenjualandelete" id="fpenjualandelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penjualan">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_penjualan_id" class="penjualan_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
        <th class="<?= $Page->tanggal->headerCellClass() ?>"><span id="elh_penjualan_tanggal" class="penjualan_tanggal"><?= $Page->tanggal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kode->Visible) { // kode ?>
        <th class="<?= $Page->kode->headerCellClass() ?>"><span id="elh_penjualan_kode" class="penjualan_kode"><?= $Page->kode->caption() ?></span></th>
<?php } ?>
<?php if ($Page->region->Visible) { // region ?>
        <th class="<?= $Page->region->headerCellClass() ?>"><span id="elh_penjualan_region" class="penjualan_region"><?= $Page->region->caption() ?></span></th>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
        <th class="<?= $Page->total->headerCellClass() ?>"><span id="elh_penjualan_total" class="penjualan_total"><?= $Page->total->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_penjualan_id" class="penjualan_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
        <td <?= $Page->tanggal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penjualan_tanggal" class="penjualan_tanggal">
<span<?= $Page->tanggal->viewAttributes() ?>>
<?= $Page->tanggal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kode->Visible) { // kode ?>
        <td <?= $Page->kode->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penjualan_kode" class="penjualan_kode">
<span<?= $Page->kode->viewAttributes() ?>>
<?= $Page->kode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->region->Visible) { // region ?>
        <td <?= $Page->region->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penjualan_region" class="penjualan_region">
<span<?= $Page->region->viewAttributes() ?>>
<?= $Page->region->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
        <td <?= $Page->total->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penjualan_total" class="penjualan_total">
<span<?= $Page->total->viewAttributes() ?>>
<?= $Page->total->getViewValue() ?></span>
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
