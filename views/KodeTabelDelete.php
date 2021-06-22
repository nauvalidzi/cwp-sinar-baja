<?php

namespace PHPMaker2021\simtrial;

// Page object
$KodeTabelDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fkode_tabeldelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fkode_tabeldelete = currentForm = new ew.Form("fkode_tabeldelete", "delete");
    loadjs.done("fkode_tabeldelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.kode_tabel) ew.vars.tables.kode_tabel = <?= JsonEncode(GetClientVar("tables", "kode_tabel")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fkode_tabeldelete" id="fkode_tabeldelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kode_tabel">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_kode_tabel_id" class="kode_tabel_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->modul->Visible) { // modul ?>
        <th class="<?= $Page->modul->headerCellClass() ?>"><span id="elh_kode_tabel_modul" class="kode_tabel_modul"><?= $Page->modul->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kode->Visible) { // kode ?>
        <th class="<?= $Page->kode->headerCellClass() ?>"><span id="elh_kode_tabel_kode" class="kode_tabel_kode"><?= $Page->kode->caption() ?></span></th>
<?php } ?>
<?php if ($Page->digit->Visible) { // digit ?>
        <th class="<?= $Page->digit->headerCellClass() ?>"><span id="elh_kode_tabel_digit" class="kode_tabel_digit"><?= $Page->digit->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_kode_tabel_id" class="kode_tabel_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->modul->Visible) { // modul ?>
        <td <?= $Page->modul->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kode_tabel_modul" class="kode_tabel_modul">
<span<?= $Page->modul->viewAttributes() ?>>
<?= $Page->modul->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kode->Visible) { // kode ?>
        <td <?= $Page->kode->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kode_tabel_kode" class="kode_tabel_kode">
<span<?= $Page->kode->viewAttributes() ?>>
<?= $Page->kode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->digit->Visible) { // digit ?>
        <td <?= $Page->digit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kode_tabel_digit" class="kode_tabel_digit">
<span<?= $Page->digit->viewAttributes() ?>>
<?= $Page->digit->getViewValue() ?></span>
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
