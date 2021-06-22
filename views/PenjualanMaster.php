<?php

namespace PHPMaker2021\simtrial;

// Table
$penjualan = Container("penjualan");
?>
<?php if ($penjualan->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_penjualanmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($penjualan->id->Visible) { // id ?>
        <tr id="r_id">
            <td class="<?= $penjualan->TableLeftColumnClass ?>"><?= $penjualan->id->caption() ?></td>
            <td <?= $penjualan->id->cellAttributes() ?>>
<span id="el_penjualan_id">
<span<?= $penjualan->id->viewAttributes() ?>>
<?= $penjualan->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($penjualan->tanggal->Visible) { // tanggal ?>
        <tr id="r_tanggal">
            <td class="<?= $penjualan->TableLeftColumnClass ?>"><?= $penjualan->tanggal->caption() ?></td>
            <td <?= $penjualan->tanggal->cellAttributes() ?>>
<span id="el_penjualan_tanggal">
<span<?= $penjualan->tanggal->viewAttributes() ?>>
<?= $penjualan->tanggal->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($penjualan->kode->Visible) { // kode ?>
        <tr id="r_kode">
            <td class="<?= $penjualan->TableLeftColumnClass ?>"><?= $penjualan->kode->caption() ?></td>
            <td <?= $penjualan->kode->cellAttributes() ?>>
<span id="el_penjualan_kode">
<span<?= $penjualan->kode->viewAttributes() ?>>
<?= $penjualan->kode->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($penjualan->region->Visible) { // region ?>
        <tr id="r_region">
            <td class="<?= $penjualan->TableLeftColumnClass ?>"><?= $penjualan->region->caption() ?></td>
            <td <?= $penjualan->region->cellAttributes() ?>>
<span id="el_penjualan_region">
<span<?= $penjualan->region->viewAttributes() ?>>
<?= $penjualan->region->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($penjualan->total->Visible) { // total ?>
        <tr id="r_total">
            <td class="<?= $penjualan->TableLeftColumnClass ?>"><?= $penjualan->total->caption() ?></td>
            <td <?= $penjualan->total->cellAttributes() ?>>
<span id="el_penjualan_total">
<span<?= $penjualan->total->viewAttributes() ?>>
<?= $penjualan->total->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
