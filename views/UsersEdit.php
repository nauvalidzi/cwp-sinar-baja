<?php

namespace PHPMaker2021\simtrial;

// Page object
$UsersEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fusersedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fusersedit = currentForm = new ew.Form("fusersedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "users")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.users)
        ew.vars.tables.users = currentTable;
    fusersedit.addFields([
        ["fullname", [fields.fullname.visible && fields.fullname.required ? ew.Validators.required(fields.fullname.caption) : null], fields.fullname.isInvalid],
        ["_email", [fields._email.visible && fields._email.required ? ew.Validators.required(fields._email.caption) : null], fields._email.isInvalid],
        ["_username", [fields._username.visible && fields._username.required ? ew.Validators.required(fields._username.caption) : null], fields._username.isInvalid],
        ["_password", [fields._password.visible && fields._password.required ? ew.Validators.required(fields._password.caption) : null], fields._password.isInvalid],
        ["phone", [fields.phone.visible && fields.phone.required ? ew.Validators.required(fields.phone.caption) : null], fields.phone.isInvalid],
        ["nik", [fields.nik.visible && fields.nik.required ? ew.Validators.required(fields.nik.caption) : null], fields.nik.isInvalid],
        ["role", [fields.role.visible && fields.role.required ? ew.Validators.required(fields.role.caption) : null], fields.role.isInvalid],
        ["iddepartemen", [fields.iddepartemen.visible && fields.iddepartemen.required ? ew.Validators.required(fields.iddepartemen.caption) : null], fields.iddepartemen.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fusersedit,
            fobj = f.getForm(),
            $fobj = $(fobj),
            $k = $fobj.find("#" + f.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            f.setInvalid(rowIndex);
        }
    });

    // Validate form
    fusersedit.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj);
        if ($fobj.find("#confirm").val() == "confirm")
            return true;
        var addcnt = 0,
            $k = $fobj.find("#" + this.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1, // Check rowcnt == 0 => Inline-Add
            gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            $fobj.data("rowindex", rowIndex);

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
        }

        // Process detail forms
        var dfs = $fobj.find("input[name='detailpage']").get();
        for (var i = 0; i < dfs.length; i++) {
            var df = dfs[i],
                val = df.value,
                frm = ew.forms.get(val);
            if (val && frm && !frm.validate())
                return false;
        }
        return true;
    }

    // Form_CustomValidate
    fusersedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fusersedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fusersedit.lists.role = <?= $Page->role->toClientList($Page) ?>;
    fusersedit.lists.iddepartemen = <?= $Page->iddepartemen->toClientList($Page) ?>;
    loadjs.done("fusersedit");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fusersedit" id="fusersedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->fullname->Visible) { // fullname ?>
    <div id="r_fullname" class="form-group row">
        <label id="elh_users_fullname" for="x_fullname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fullname->caption() ?><?= $Page->fullname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->fullname->cellAttributes() ?>>
<span id="el_users_fullname">
<input type="<?= $Page->fullname->getInputTextType() ?>" data-table="users" data-field="x_fullname" name="x_fullname" id="x_fullname" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->fullname->getPlaceHolder()) ?>" value="<?= $Page->fullname->EditValue ?>"<?= $Page->fullname->editAttributes() ?> aria-describedby="x_fullname_help">
<?= $Page->fullname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fullname->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <div id="r__email" class="form-group row">
        <label id="elh_users__email" for="x__email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?><?= $Page->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_email->cellAttributes() ?>>
<span id="el_users__email">
<input type="<?= $Page->_email->getInputTextType() ?>" data-table="users" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>" value="<?= $Page->_email->EditValue ?>"<?= $Page->_email->editAttributes() ?> aria-describedby="x__email_help">
<?= $Page->_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
    <div id="r__username" class="form-group row">
        <label id="elh_users__username" for="x__username" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_username->caption() ?><?= $Page->_username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_username->cellAttributes() ?>>
<span id="el_users__username">
<input type="<?= $Page->_username->getInputTextType() ?>" data-table="users" data-field="x__username" name="x__username" id="x__username" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->_username->getPlaceHolder()) ?>" value="<?= $Page->_username->EditValue ?>"<?= $Page->_username->editAttributes() ?> aria-describedby="x__username_help">
<?= $Page->_username->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_username->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
    <div id="r__password" class="form-group row">
        <label id="elh_users__password" for="x__password" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_password->caption() ?><?= $Page->_password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_password->cellAttributes() ?>>
<span id="el_users__password">
<input type="<?= $Page->_password->getInputTextType() ?>" data-table="users" data-field="x__password" name="x__password" id="x__password" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_password->getPlaceHolder()) ?>" value="<?= $Page->_password->EditValue ?>"<?= $Page->_password->editAttributes() ?> aria-describedby="x__password_help">
<?= $Page->_password->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_password->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
    <div id="r_phone" class="form-group row">
        <label id="elh_users_phone" for="x_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->phone->caption() ?><?= $Page->phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->phone->cellAttributes() ?>>
<span id="el_users_phone">
<input type="<?= $Page->phone->getInputTextType() ?>" data-table="users" data-field="x_phone" name="x_phone" id="x_phone" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->phone->getPlaceHolder()) ?>" value="<?= $Page->phone->EditValue ?>"<?= $Page->phone->editAttributes() ?> aria-describedby="x_phone_help">
<?= $Page->phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nik->Visible) { // nik ?>
    <div id="r_nik" class="form-group row">
        <label id="elh_users_nik" for="x_nik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nik->caption() ?><?= $Page->nik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nik->cellAttributes() ?>>
<span id="el_users_nik">
<input type="<?= $Page->nik->getInputTextType() ?>" data-table="users" data-field="x_nik" name="x_nik" id="x_nik" size="30" maxlength="30" placeholder="<?= HtmlEncode($Page->nik->getPlaceHolder()) ?>" value="<?= $Page->nik->EditValue ?>"<?= $Page->nik->editAttributes() ?> aria-describedby="x_nik_help">
<?= $Page->nik->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nik->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->role->Visible) { // role ?>
    <div id="r_role" class="form-group row">
        <label id="elh_users_role" for="x_role" class="<?= $Page->LeftColumnClass ?>"><?= $Page->role->caption() ?><?= $Page->role->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->role->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_users_role">
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->role->getDisplayValue($Page->role->EditValue))) ?>">
</span>
<?php } else { ?>
<span id="el_users_role">
    <select
        id="x_role"
        name="x_role"
        class="form-control ew-select<?= $Page->role->isInvalidClass() ?>"
        data-select2-id="users_x_role"
        data-table="users"
        data-field="x_role"
        data-value-separator="<?= $Page->role->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->role->getPlaceHolder()) ?>"
        <?= $Page->role->editAttributes() ?>>
        <?= $Page->role->selectOptionListHtml("x_role") ?>
    </select>
    <?= $Page->role->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->role->getErrorMessage() ?></div>
<?= $Page->role->Lookup->getParamTag($Page, "p_x_role") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='users_x_role']"),
        options = { name: "x_role", selectId: "users_x_role", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.users.fields.role.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->iddepartemen->Visible) { // iddepartemen ?>
    <div id="r_iddepartemen" class="form-group row">
        <label id="elh_users_iddepartemen" for="x_iddepartemen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->iddepartemen->caption() ?><?= $Page->iddepartemen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->iddepartemen->cellAttributes() ?>>
<span id="el_users_iddepartemen">
    <select
        id="x_iddepartemen"
        name="x_iddepartemen"
        class="form-control ew-select<?= $Page->iddepartemen->isInvalidClass() ?>"
        data-select2-id="users_x_iddepartemen"
        data-table="users"
        data-field="x_iddepartemen"
        data-value-separator="<?= $Page->iddepartemen->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->iddepartemen->getPlaceHolder()) ?>"
        <?= $Page->iddepartemen->editAttributes() ?>>
        <?= $Page->iddepartemen->selectOptionListHtml("x_iddepartemen") ?>
    </select>
    <?= $Page->iddepartemen->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->iddepartemen->getErrorMessage() ?></div>
<?= $Page->iddepartemen->Lookup->getParamTag($Page, "p_x_iddepartemen") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='users_x_iddepartemen']"),
        options = { name: "x_iddepartemen", selectId: "users_x_iddepartemen", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.users.fields.iddepartemen.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="users" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
<?php
    if (in_array("departemen", explode(",", $Page->getCurrentDetailTable())) && $departemen->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("departemen", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "DepartemenGrid.php" ?>
<?php } ?>
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("users");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
