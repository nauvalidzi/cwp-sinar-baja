<?php

namespace PHPMaker2021\simtrial;

// Page object
$PenjualanDetailView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpenjualan_detailview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fpenjualan_detailview = currentForm = new ew.Form("fpenjualan_detailview", "view");
    loadjs.done("fpenjualan_detailview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.penjualan_detail) ew.vars.tables.penjualan_detail = <?= JsonEncode(GetClientVar("tables", "penjualan_detail")) ?>;
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
<form name="fpenjualan_detailview" id="fpenjualan_detailview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penjualan_detail">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penjualan_detail_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_penjualan_detail_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->idproduk->Visible) { // idproduk ?>
    <tr id="r_idproduk">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penjualan_detail_idproduk"><?= $Page->idproduk->caption() ?></span></td>
        <td data-name="idproduk" <?= $Page->idproduk->cellAttributes() ?>>
<span id="el_penjualan_detail_idproduk">
<span<?= $Page->idproduk->viewAttributes() ?>>
<?= $Page->idproduk->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jumlah->Visible) { // jumlah ?>
    <tr id="r_jumlah">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penjualan_detail_jumlah"><?= $Page->jumlah->caption() ?></span></td>
        <td data-name="jumlah" <?= $Page->jumlah->cellAttributes() ?>>
<span id="el_penjualan_detail_jumlah">
<span<?= $Page->jumlah->viewAttributes() ?>>
<?= $Page->jumlah->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->harga->Visible) { // harga ?>
    <tr id="r_harga">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penjualan_detail_harga"><?= $Page->harga->caption() ?></span></td>
        <td data-name="harga" <?= $Page->harga->cellAttributes() ?>>
<span id="el_penjualan_detail_harga">
<span<?= $Page->harga->viewAttributes() ?>>
<?= $Page->harga->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->catatan->Visible) { // catatan ?>
    <tr id="r_catatan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penjualan_detail_catatan"><?= $Page->catatan->caption() ?></span></td>
        <td data-name="catatan" <?= $Page->catatan->cellAttributes() ?>>
<span id="el_penjualan_detail_catatan">
<span<?= $Page->catatan->viewAttributes() ?>>
<?= $Page->catatan->getViewValue() ?></span>
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
