<?php

namespace PHPMaker2021\simtrial;

// Page object
$ProdukView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fprodukview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fprodukview = currentForm = new ew.Form("fprodukview", "view");
    loadjs.done("fprodukview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.produk) ew.vars.tables.produk = <?= JsonEncode(GetClientVar("tables", "produk")) ?>;
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
<form name="fprodukview" id="fprodukview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="produk">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_produk_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_produk_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode->Visible) { // kode ?>
    <tr id="r_kode">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_produk_kode"><?= $Page->kode->caption() ?></span></td>
        <td data-name="kode" <?= $Page->kode->cellAttributes() ?>>
<span id="el_produk_kode">
<span<?= $Page->kode->viewAttributes() ?>>
<?= $Page->kode->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <tr id="r_nama">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_produk_nama"><?= $Page->nama->caption() ?></span></td>
        <td data-name="nama" <?= $Page->nama->cellAttributes() ?>>
<span id="el_produk_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
    <tr id="r_deskripsi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_produk_deskripsi"><?= $Page->deskripsi->caption() ?></span></td>
        <td data-name="deskripsi" <?= $Page->deskripsi->cellAttributes() ?>>
<span id="el_produk_deskripsi">
<span<?= $Page->deskripsi->viewAttributes() ?>>
<?= $Page->deskripsi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->harga->Visible) { // harga ?>
    <tr id="r_harga">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_produk_harga"><?= $Page->harga->caption() ?></span></td>
        <td data-name="harga" <?= $Page->harga->cellAttributes() ?>>
<span id="el_produk_harga">
<span<?= $Page->harga->viewAttributes() ?>>
<?= $Page->harga->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("produksi_detail", explode(",", $Page->getCurrentDetailTable())) && $produksi_detail->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("produksi_detail", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "ProduksiDetailGrid.php" ?>
<?php } ?>
<?php
    if (in_array("penjualan_detail", explode(",", $Page->getCurrentDetailTable())) && $penjualan_detail->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("penjualan_detail", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PenjualanDetailGrid.php" ?>
<?php } ?>
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
