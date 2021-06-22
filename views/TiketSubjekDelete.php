<?php

namespace PHPMaker2021\simtrial;

// Page object
$TiketSubjekDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftiket_subjekdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    ftiket_subjekdelete = currentForm = new ew.Form("ftiket_subjekdelete", "delete");
    loadjs.done("ftiket_subjekdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.tiket_subjek) ew.vars.tables.tiket_subjek = <?= JsonEncode(GetClientVar("tables", "tiket_subjek")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="ftiket_subjekdelete" id="ftiket_subjekdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="tiket_subjek">
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
<?php if ($Page->subjek->Visible) { // subjek ?>
        <th class="<?= $Page->subjek->headerCellClass() ?>"><span id="elh_tiket_subjek_subjek" class="tiket_subjek_subjek"><?= $Page->subjek->caption() ?></span></th>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
        <th class="<?= $Page->deskripsi->headerCellClass() ?>"><span id="elh_tiket_subjek_deskripsi" class="tiket_subjek_deskripsi"><?= $Page->deskripsi->caption() ?></span></th>
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
<?php if ($Page->subjek->Visible) { // subjek ?>
        <td <?= $Page->subjek->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_tiket_subjek_subjek" class="tiket_subjek_subjek">
<span<?= $Page->subjek->viewAttributes() ?>>
<?= $Page->subjek->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
        <td <?= $Page->deskripsi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_tiket_subjek_deskripsi" class="tiket_subjek_deskripsi">
<span<?= $Page->deskripsi->viewAttributes() ?>>
<?= $Page->deskripsi->getViewValue() ?></span>
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
