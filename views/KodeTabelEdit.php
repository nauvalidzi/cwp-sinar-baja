<?php

namespace PHPMaker2021\simtrial;

// Page object
$KodeTabelEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fkode_tabeledit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fkode_tabeledit = currentForm = new ew.Form("fkode_tabeledit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "kode_tabel")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.kode_tabel)
        ew.vars.tables.kode_tabel = currentTable;
    fkode_tabeledit.addFields([
        ["modul", [fields.modul.visible && fields.modul.required ? ew.Validators.required(fields.modul.caption) : null], fields.modul.isInvalid],
        ["kode", [fields.kode.visible && fields.kode.required ? ew.Validators.required(fields.kode.caption) : null], fields.kode.isInvalid],
        ["digit", [fields.digit.visible && fields.digit.required ? ew.Validators.required(fields.digit.caption) : null, ew.Validators.integer], fields.digit.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fkode_tabeledit,
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
    fkode_tabeledit.validate = function () {
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
    fkode_tabeledit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fkode_tabeledit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fkode_tabeledit");
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
<form name="fkode_tabeledit" id="fkode_tabeledit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kode_tabel">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->modul->Visible) { // modul ?>
    <div id="r_modul" class="form-group row">
        <label id="elh_kode_tabel_modul" for="x_modul" class="<?= $Page->LeftColumnClass ?>"><?= $Page->modul->caption() ?><?= $Page->modul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->modul->cellAttributes() ?>>
<span id="el_kode_tabel_modul">
<input type="<?= $Page->modul->getInputTextType() ?>" data-table="kode_tabel" data-field="x_modul" name="x_modul" id="x_modul" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->modul->getPlaceHolder()) ?>" value="<?= $Page->modul->EditValue ?>"<?= $Page->modul->editAttributes() ?> aria-describedby="x_modul_help">
<?= $Page->modul->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->modul->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode->Visible) { // kode ?>
    <div id="r_kode" class="form-group row">
        <label id="elh_kode_tabel_kode" for="x_kode" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode->caption() ?><?= $Page->kode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode->cellAttributes() ?>>
<span id="el_kode_tabel_kode">
<input type="<?= $Page->kode->getInputTextType() ?>" data-table="kode_tabel" data-field="x_kode" name="x_kode" id="x_kode" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->kode->getPlaceHolder()) ?>" value="<?= $Page->kode->EditValue ?>"<?= $Page->kode->editAttributes() ?> aria-describedby="x_kode_help">
<?= $Page->kode->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->digit->Visible) { // digit ?>
    <div id="r_digit" class="form-group row">
        <label id="elh_kode_tabel_digit" for="x_digit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->digit->caption() ?><?= $Page->digit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->digit->cellAttributes() ?>>
<span id="el_kode_tabel_digit">
<input type="<?= $Page->digit->getInputTextType() ?>" data-table="kode_tabel" data-field="x_digit" name="x_digit" id="x_digit" size="30" placeholder="<?= HtmlEncode($Page->digit->getPlaceHolder()) ?>" value="<?= $Page->digit->EditValue ?>"<?= $Page->digit->editAttributes() ?> aria-describedby="x_digit_help">
<?= $Page->digit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->digit->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="kode_tabel" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
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
    ew.addEventHandlers("kode_tabel");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
