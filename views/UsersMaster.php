<?php

namespace PHPMaker2021\simtrial;

// Table
$users = Container("users");
?>
<?php if ($users->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_usersmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($users->id->Visible) { // id ?>
        <tr id="r_id">
            <td class="<?= $users->TableLeftColumnClass ?>"><?= $users->id->caption() ?></td>
            <td <?= $users->id->cellAttributes() ?>>
<span id="el_users_id">
<span<?= $users->id->viewAttributes() ?>>
<?= $users->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($users->fullname->Visible) { // fullname ?>
        <tr id="r_fullname">
            <td class="<?= $users->TableLeftColumnClass ?>"><?= $users->fullname->caption() ?></td>
            <td <?= $users->fullname->cellAttributes() ?>>
<span id="el_users_fullname">
<span<?= $users->fullname->viewAttributes() ?>>
<?= $users->fullname->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($users->_email->Visible) { // email ?>
        <tr id="r__email">
            <td class="<?= $users->TableLeftColumnClass ?>"><?= $users->_email->caption() ?></td>
            <td <?= $users->_email->cellAttributes() ?>>
<span id="el_users__email">
<span<?= $users->_email->viewAttributes() ?>>
<?= $users->_email->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($users->_username->Visible) { // username ?>
        <tr id="r__username">
            <td class="<?= $users->TableLeftColumnClass ?>"><?= $users->_username->caption() ?></td>
            <td <?= $users->_username->cellAttributes() ?>>
<span id="el_users__username">
<span<?= $users->_username->viewAttributes() ?>>
<?= $users->_username->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($users->phone->Visible) { // phone ?>
        <tr id="r_phone">
            <td class="<?= $users->TableLeftColumnClass ?>"><?= $users->phone->caption() ?></td>
            <td <?= $users->phone->cellAttributes() ?>>
<span id="el_users_phone">
<span<?= $users->phone->viewAttributes() ?>>
<?= $users->phone->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($users->nik->Visible) { // nik ?>
        <tr id="r_nik">
            <td class="<?= $users->TableLeftColumnClass ?>"><?= $users->nik->caption() ?></td>
            <td <?= $users->nik->cellAttributes() ?>>
<span id="el_users_nik">
<span<?= $users->nik->viewAttributes() ?>>
<?= $users->nik->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($users->role->Visible) { // role ?>
        <tr id="r_role">
            <td class="<?= $users->TableLeftColumnClass ?>"><?= $users->role->caption() ?></td>
            <td <?= $users->role->cellAttributes() ?>>
<span id="el_users_role">
<span<?= $users->role->viewAttributes() ?>>
<?= $users->role->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($users->iddepartemen->Visible) { // iddepartemen ?>
        <tr id="r_iddepartemen">
            <td class="<?= $users->TableLeftColumnClass ?>"><?= $users->iddepartemen->caption() ?></td>
            <td <?= $users->iddepartemen->cellAttributes() ?>>
<span id="el_users_iddepartemen">
<span<?= $users->iddepartemen->viewAttributes() ?>>
<?= $users->iddepartemen->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
