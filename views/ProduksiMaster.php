<?php

namespace PHPMaker2021\simtrial;

// Table
$produksi = Container("produksi");
?>
<?php if ($produksi->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_produksimaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($produksi->id->Visible) { // id ?>
        <tr id="r_id">
            <td class="<?= $produksi->TableLeftColumnClass ?>"><?= $produksi->id->caption() ?></td>
            <td <?= $produksi->id->cellAttributes() ?>>
<span id="el_produksi_id">
<span<?= $produksi->id->viewAttributes() ?>>
<?= $produksi->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($produksi->tanggal->Visible) { // tanggal ?>
        <tr id="r_tanggal">
            <td class="<?= $produksi->TableLeftColumnClass ?>"><?= $produksi->tanggal->caption() ?></td>
            <td <?= $produksi->tanggal->cellAttributes() ?>>
<span id="el_produksi_tanggal">
<span<?= $produksi->tanggal->viewAttributes() ?>>
<?= $produksi->tanggal->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($produksi->kode->Visible) { // kode ?>
        <tr id="r_kode">
            <td class="<?= $produksi->TableLeftColumnClass ?>"><?= $produksi->kode->caption() ?></td>
            <td <?= $produksi->kode->cellAttributes() ?>>
<span id="el_produksi_kode">
<span<?= $produksi->kode->viewAttributes() ?>>
<?= $produksi->kode->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($produksi->total->Visible) { // total ?>
        <tr id="r_total">
            <td class="<?= $produksi->TableLeftColumnClass ?>"><?= $produksi->total->caption() ?></td>
            <td <?= $produksi->total->cellAttributes() ?>>
<span id="el_produksi_total">
<span<?= $produksi->total->viewAttributes() ?>>
<?= $produksi->total->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
