<?php

namespace PHPMaker2021\simtrial;

// Page object
$TiketSubjekEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftiket_subjekedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    ftiket_subjekedit = currentForm = new ew.Form("ftiket_subjekedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "tiket_subjek")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.tiket_subjek)
        ew.vars.tables.tiket_subjek = currentTable;
    ftiket_subjekedit.addFields([
        ["subjek", [fields.subjek.visible && fields.subjek.required ? ew.Validators.required(fields.subjek.caption) : null], fields.subjek.isInvalid],
        ["deskripsi", [fields.deskripsi.visible && fields.deskripsi.required ? ew.Validators.required(fields.deskripsi.caption) : null], fields.deskripsi.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = ftiket_subjekedit,
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
    ftiket_subjekedit.validate = function () {
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
    ftiket_subjekedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftiket_subjekedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("ftiket_subjekedit");
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
<form name="ftiket_subjekedit" id="ftiket_subjekedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="tiket_subjek">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->subjek->Visible) { // subjek ?>
    <div id="r_subjek" class="form-group row">
        <label id="elh_tiket_subjek_subjek" for="x_subjek" class="<?= $Page->LeftColumnClass ?>"><?= $Page->subjek->caption() ?><?= $Page->subjek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->subjek->cellAttributes() ?>>
<span id="el_tiket_subjek_subjek">
<input type="<?= $Page->subjek->getInputTextType() ?>" data-table="tiket_subjek" data-field="x_subjek" name="x_subjek" id="x_subjek" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->subjek->getPlaceHolder()) ?>" value="<?= $Page->subjek->EditValue ?>"<?= $Page->subjek->editAttributes() ?> aria-describedby="x_subjek_help">
<?= $Page->subjek->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->subjek->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
    <div id="r_deskripsi" class="form-group row">
        <label id="elh_tiket_subjek_deskripsi" for="x_deskripsi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->deskripsi->caption() ?><?= $Page->deskripsi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->deskripsi->cellAttributes() ?>>
<span id="el_tiket_subjek_deskripsi">
<textarea data-table="tiket_subjek" data-field="x_deskripsi" name="x_deskripsi" id="x_deskripsi" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->deskripsi->getPlaceHolder()) ?>"<?= $Page->deskripsi->editAttributes() ?> aria-describedby="x_deskripsi_help"><?= $Page->deskripsi->EditValue ?></textarea>
<?= $Page->deskripsi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->deskripsi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="tiket_subjek" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
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
    ew.addEventHandlers("tiket_subjek");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
