<?php

namespace PHPMaker2021\simtrial;

// Page object
$UsersView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fusersview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fusersview = currentForm = new ew.Form("fusersview", "view");
    loadjs.done("fusersview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.users) ew.vars.tables.users = <?= JsonEncode(GetClientVar("tables", "users")) ?>;
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
<form name="fusersview" id="fusersview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_users_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->fullname->Visible) { // fullname ?>
    <tr id="r_fullname">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_fullname"><?= $Page->fullname->caption() ?></span></td>
        <td data-name="fullname" <?= $Page->fullname->cellAttributes() ?>>
<span id="el_users_fullname">
<span<?= $Page->fullname->viewAttributes() ?>>
<?= $Page->fullname->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <tr id="r__email">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users__email"><?= $Page->_email->caption() ?></span></td>
        <td data-name="_email" <?= $Page->_email->cellAttributes() ?>>
<span id="el_users__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
    <tr id="r__username">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users__username"><?= $Page->_username->caption() ?></span></td>
        <td data-name="_username" <?= $Page->_username->cellAttributes() ?>>
<span id="el_users__username">
<span<?= $Page->_username->viewAttributes() ?>>
<?= $Page->_username->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
    <tr id="r_phone">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_phone"><?= $Page->phone->caption() ?></span></td>
        <td data-name="phone" <?= $Page->phone->cellAttributes() ?>>
<span id="el_users_phone">
<span<?= $Page->phone->viewAttributes() ?>>
<?= $Page->phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nik->Visible) { // nik ?>
    <tr id="r_nik">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_nik"><?= $Page->nik->caption() ?></span></td>
        <td data-name="nik" <?= $Page->nik->cellAttributes() ?>>
<span id="el_users_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->role->Visible) { // role ?>
    <tr id="r_role">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_role"><?= $Page->role->caption() ?></span></td>
        <td data-name="role" <?= $Page->role->cellAttributes() ?>>
<span id="el_users_role">
<span<?= $Page->role->viewAttributes() ?>>
<?= $Page->role->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->iddepartemen->Visible) { // iddepartemen ?>
    <tr id="r_iddepartemen">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_iddepartemen"><?= $Page->iddepartemen->caption() ?></span></td>
        <td data-name="iddepartemen" <?= $Page->iddepartemen->cellAttributes() ?>>
<span id="el_users_iddepartemen">
<span<?= $Page->iddepartemen->viewAttributes() ?>>
<?= $Page->iddepartemen->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("departemen", explode(",", $Page->getCurrentDetailTable())) && $departemen->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("departemen", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "DepartemenGrid.php" ?>
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
