<?php

namespace PHPMaker2021\simtrial;

// Page object
$ProduksiView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fproduksiview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fproduksiview = currentForm = new ew.Form("fproduksiview", "view");
    loadjs.done("fproduksiview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.produksi) ew.vars.tables.produksi = <?= JsonEncode(GetClientVar("tables", "produksi")) ?>;
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
<form name="fproduksiview" id="fproduksiview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="produksi">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_produksi_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_produksi_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
    <tr id="r_tanggal">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_produksi_tanggal"><?= $Page->tanggal->caption() ?></span></td>
        <td data-name="tanggal" <?= $Page->tanggal->cellAttributes() ?>>
<span id="el_produksi_tanggal">
<span<?= $Page->tanggal->viewAttributes() ?>>
<?= $Page->tanggal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode->Visible) { // kode ?>
    <tr id="r_kode">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_produksi_kode"><?= $Page->kode->caption() ?></span></td>
        <td data-name="kode" <?= $Page->kode->cellAttributes() ?>>
<span id="el_produksi_kode">
<span<?= $Page->kode->viewAttributes() ?>>
<?= $Page->kode->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
    <tr id="r_total">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_produksi_total"><?= $Page->total->caption() ?></span></td>
        <td data-name="total" <?= $Page->total->cellAttributes() ?>>
<span id="el_produksi_total">
<span<?= $Page->total->viewAttributes() ?>>
<?= $Page->total->getViewValue() ?></span>
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
