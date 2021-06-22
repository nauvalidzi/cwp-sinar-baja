<?php

namespace PHPMaker2021\simtrial;

// Page object
$KodeTabelView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fkode_tabelview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fkode_tabelview = currentForm = new ew.Form("fkode_tabelview", "view");
    loadjs.done("fkode_tabelview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.kode_tabel) ew.vars.tables.kode_tabel = <?= JsonEncode(GetClientVar("tables", "kode_tabel")) ?>;
</script>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fkode_tabelview" id="fkode_tabelview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kode_tabel">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kode_tabel_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_kode_tabel_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->modul->Visible) { // modul ?>
    <tr id="r_modul">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kode_tabel_modul"><?= $Page->modul->caption() ?></span></td>
        <td data-name="modul" <?= $Page->modul->cellAttributes() ?>>
<span id="el_kode_tabel_modul">
<span<?= $Page->modul->viewAttributes() ?>>
<?= $Page->modul->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode->Visible) { // kode ?>
    <tr id="r_kode">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kode_tabel_kode"><?= $Page->kode->caption() ?></span></td>
        <td data-name="kode" <?= $Page->kode->cellAttributes() ?>>
<span id="el_kode_tabel_kode">
<span<?= $Page->kode->viewAttributes() ?>>
<?= $Page->kode->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->digit->Visible) { // digit ?>
    <tr id="r_digit">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kode_tabel_digit"><?= $Page->digit->caption() ?></span></td>
        <td data-name="digit" <?= $Page->digit->cellAttributes() ?>>
<span id="el_kode_tabel_digit">
<span<?= $Page->digit->viewAttributes() ?>>
<?= $Page->digit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
