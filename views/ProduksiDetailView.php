<?php

namespace PHPMaker2021\simtrial;

// Page object
$ProduksiDetailView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fproduksi_detailview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fproduksi_detailview = currentForm = new ew.Form("fproduksi_detailview", "view");
    loadjs.done("fproduksi_detailview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.produksi_detail) ew.vars.tables.produksi_detail = <?= JsonEncode(GetClientVar("tables", "produksi_detail")) ?>;
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
<form name="fproduksi_detailview" id="fproduksi_detailview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="produksi_detail">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_produksi_detail_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_produksi_detail_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->idproduksi->Visible) { // idproduksi ?>
    <tr id="r_idproduksi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_produksi_detail_idproduksi"><?= $Page->idproduksi->caption() ?></span></td>
        <td data-name="idproduksi" <?= $Page->idproduksi->cellAttributes() ?>>
<span id="el_produksi_detail_idproduksi">
<span<?= $Page->idproduksi->viewAttributes() ?>>
<?= $Page->idproduksi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->idproduk->Visible) { // idproduk ?>
    <tr id="r_idproduk">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_produksi_detail_idproduk"><?= $Page->idproduk->caption() ?></span></td>
        <td data-name="idproduk" <?= $Page->idproduk->cellAttributes() ?>>
<span id="el_produksi_detail_idproduk">
<span<?= $Page->idproduk->viewAttributes() ?>>
<?= $Page->idproduk->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->target->Visible) { // target ?>
    <tr id="r_target">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_produksi_detail_target"><?= $Page->target->caption() ?></span></td>
        <td data-name="target" <?= $Page->target->cellAttributes() ?>>
<span id="el_produksi_detail_target">
<span<?= $Page->target->viewAttributes() ?>>
<?= $Page->target->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->realisasi->Visible) { // realisasi ?>
    <tr id="r_realisasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_produksi_detail_realisasi"><?= $Page->realisasi->caption() ?></span></td>
        <td data-name="realisasi" <?= $Page->realisasi->cellAttributes() ?>>
<span id="el_produksi_detail_realisasi">
<span<?= $Page->realisasi->viewAttributes() ?>>
<?= $Page->realisasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->persentase->Visible) { // persentase ?>
    <tr id="r_persentase">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_produksi_detail_persentase"><?= $Page->persentase->caption() ?></span></td>
        <td data-name="persentase" <?= $Page->persentase->cellAttributes() ?>>
<span id="el_produksi_detail_persentase">
<span<?= $Page->persentase->viewAttributes() ?>>
<?= $Page->persentase->getViewValue() ?></span>
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
