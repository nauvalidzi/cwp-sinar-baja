<?php

namespace PHPMaker2021\simtrial;

// Page object
$TiketSubjekView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var ftiket_subjekview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    ftiket_subjekview = currentForm = new ew.Form("ftiket_subjekview", "view");
    loadjs.done("ftiket_subjekview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.tiket_subjek) ew.vars.tables.tiket_subjek = <?= JsonEncode(GetClientVar("tables", "tiket_subjek")) ?>;
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
<form name="ftiket_subjekview" id="ftiket_subjekview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="tiket_subjek">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tiket_subjek_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_tiket_subjek_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->subjek->Visible) { // subjek ?>
    <tr id="r_subjek">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tiket_subjek_subjek"><?= $Page->subjek->caption() ?></span></td>
        <td data-name="subjek" <?= $Page->subjek->cellAttributes() ?>>
<span id="el_tiket_subjek_subjek">
<span<?= $Page->subjek->viewAttributes() ?>>
<?= $Page->subjek->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
    <tr id="r_deskripsi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tiket_subjek_deskripsi"><?= $Page->deskripsi->caption() ?></span></td>
        <td data-name="deskripsi" <?= $Page->deskripsi->cellAttributes() ?>>
<span id="el_tiket_subjek_deskripsi">
<span<?= $Page->deskripsi->viewAttributes() ?>>
<?= $Page->deskripsi->getViewValue() ?></span>
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
