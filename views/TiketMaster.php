<?php

namespace PHPMaker2021\simtrial;

// Table
$tiket = Container("tiket");
?>
<?php if ($tiket->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_tiketmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($tiket->id->Visible) { // id ?>
        <tr id="r_id">
            <td class="<?= $tiket->TableLeftColumnClass ?>"><?= $tiket->id->caption() ?></td>
            <td <?= $tiket->id->cellAttributes() ?>>
<span id="el_tiket_id">
<span<?= $tiket->id->viewAttributes() ?>>
<?= $tiket->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($tiket->subjek->Visible) { // subjek ?>
        <tr id="r_subjek">
            <td class="<?= $tiket->TableLeftColumnClass ?>"><?= $tiket->subjek->caption() ?></td>
            <td <?= $tiket->subjek->cellAttributes() ?>>
<span id="el_tiket_subjek">
<span<?= $tiket->subjek->viewAttributes() ?>>
<?= $tiket->subjek->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($tiket->tanggal->Visible) { // tanggal ?>
        <tr id="r_tanggal">
            <td class="<?= $tiket->TableLeftColumnClass ?>"><?= $tiket->tanggal->caption() ?></td>
            <td <?= $tiket->tanggal->cellAttributes() ?>>
<span id="el_tiket_tanggal">
<span<?= $tiket->tanggal->viewAttributes() ?>>
<?= $tiket->tanggal->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($tiket->kode->Visible) { // kode ?>
        <tr id="r_kode">
            <td class="<?= $tiket->TableLeftColumnClass ?>"><?= $tiket->kode->caption() ?></td>
            <td <?= $tiket->kode->cellAttributes() ?>>
<span id="el_tiket_kode">
<span<?= $tiket->kode->viewAttributes() ?>>
<?= $tiket->kode->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($tiket->status->Visible) { // status ?>
        <tr id="r_status">
            <td class="<?= $tiket->TableLeftColumnClass ?>"><?= $tiket->status->caption() ?></td>
            <td <?= $tiket->status->cellAttributes() ?>>
<span id="el_tiket_status">
<span<?= $tiket->status->viewAttributes() ?>>
<?= $tiket->status->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
