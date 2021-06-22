<?php

namespace PHPMaker2021\simtrial;

// Table
$produk = Container("produk");
?>
<?php if ($produk->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_produkmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($produk->id->Visible) { // id ?>
        <tr id="r_id">
            <td class="<?= $produk->TableLeftColumnClass ?>"><?= $produk->id->caption() ?></td>
            <td <?= $produk->id->cellAttributes() ?>>
<span id="el_produk_id">
<span<?= $produk->id->viewAttributes() ?>>
<?= $produk->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($produk->kode->Visible) { // kode ?>
        <tr id="r_kode">
            <td class="<?= $produk->TableLeftColumnClass ?>"><?= $produk->kode->caption() ?></td>
            <td <?= $produk->kode->cellAttributes() ?>>
<span id="el_produk_kode">
<span<?= $produk->kode->viewAttributes() ?>>
<?= $produk->kode->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($produk->nama->Visible) { // nama ?>
        <tr id="r_nama">
            <td class="<?= $produk->TableLeftColumnClass ?>"><?= $produk->nama->caption() ?></td>
            <td <?= $produk->nama->cellAttributes() ?>>
<span id="el_produk_nama">
<span<?= $produk->nama->viewAttributes() ?>>
<?= $produk->nama->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($produk->harga->Visible) { // harga ?>
        <tr id="r_harga">
            <td class="<?= $produk->TableLeftColumnClass ?>"><?= $produk->harga->caption() ?></td>
            <td <?= $produk->harga->cellAttributes() ?>>
<span id="el_produk_harga">
<span<?= $produk->harga->viewAttributes() ?>>
<?= $produk->harga->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
