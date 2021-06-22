<?php

namespace PHPMaker2021\simtrial;

// Page object
$TiketDetailAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftiket_detailadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    ftiket_detailadd = currentForm = new ew.Form("ftiket_detailadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "tiket_detail")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.tiket_detail)
        ew.vars.tables.tiket_detail = currentTable;
    ftiket_detailadd.addFields([
        ["tanggal", [fields.tanggal.visible && fields.tanggal.required ? ew.Validators.required(fields.tanggal.caption) : null, ew.Validators.datetime(0)], fields.tanggal.isInvalid],
        ["idtiket", [fields.idtiket.visible && fields.idtiket.required ? ew.Validators.required(fields.idtiket.caption) : null, ew.Validators.integer], fields.idtiket.isInvalid],
        ["deskripsi", [fields.deskripsi.visible && fields.deskripsi.required ? ew.Validators.required(fields.deskripsi.caption) : null], fields.deskripsi.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = ftiket_detailadd,
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
    ftiket_detailadd.validate = function () {
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
    ftiket_detailadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftiket_detailadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    ftiket_detailadd.lists.idtiket = <?= $Page->idtiket->toClientList($Page) ?>;
    loadjs.done("ftiket_detailadd");
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
<form name="ftiket_detailadd" id="ftiket_detailadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="tiket_detail">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "tiket") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="tiket">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->idtiket->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->tanggal->Visible) { // tanggal ?>
    <div id="r_tanggal" class="form-group row">
        <label id="elh_tiket_detail_tanggal" for="x_tanggal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggal->caption() ?><?= $Page->tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tanggal->cellAttributes() ?>>
<span id="el_tiket_detail_tanggal">
<input type="<?= $Page->tanggal->getInputTextType() ?>" data-table="tiket_detail" data-field="x_tanggal" name="x_tanggal" id="x_tanggal" placeholder="<?= HtmlEncode($Page->tanggal->getPlaceHolder()) ?>" value="<?= $Page->tanggal->EditValue ?>"<?= $Page->tanggal->editAttributes() ?> aria-describedby="x_tanggal_help">
<?= $Page->tanggal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggal->getErrorMessage() ?></div>
<?php if (!$Page->tanggal->ReadOnly && !$Page->tanggal->Disabled && !isset($Page->tanggal->EditAttrs["readonly"]) && !isset($Page->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftiket_detailadd", "datetimepicker"], function() {
    ew.createDateTimePicker("ftiket_detailadd", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->idtiket->Visible) { // idtiket ?>
    <div id="r_idtiket" class="form-group row">
        <label id="elh_tiket_detail_idtiket" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idtiket->caption() ?><?= $Page->idtiket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->idtiket->cellAttributes() ?>>
<?php if ($Page->idtiket->getSessionValue() != "") { ?>
<span id="el_tiket_detail_idtiket">
<span<?= $Page->idtiket->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->idtiket->getDisplayValue($Page->idtiket->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_idtiket" name="x_idtiket" value="<?= HtmlEncode($Page->idtiket->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_tiket_detail_idtiket">
<?php
$onchange = $Page->idtiket->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Page->idtiket->EditAttrs["onchange"] = "";
?>
<span id="as_x_idtiket" class="ew-auto-suggest">
    <input type="<?= $Page->idtiket->getInputTextType() ?>" class="form-control" name="sv_x_idtiket" id="sv_x_idtiket" value="<?= RemoveHtml($Page->idtiket->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Page->idtiket->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->idtiket->getPlaceHolder()) ?>"<?= $Page->idtiket->editAttributes() ?> aria-describedby="x_idtiket_help">
</span>
<input type="hidden" is="selection-list" class="form-control" data-table="tiket_detail" data-field="x_idtiket" data-input="sv_x_idtiket" data-value-separator="<?= $Page->idtiket->displayValueSeparatorAttribute() ?>" name="x_idtiket" id="x_idtiket" value="<?= HtmlEncode($Page->idtiket->CurrentValue) ?>"<?= $onchange ?>>
<?= $Page->idtiket->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->idtiket->getErrorMessage() ?></div>
<script>
loadjs.ready(["ftiket_detailadd"], function() {
    ftiket_detailadd.createAutoSuggest(Object.assign({"id":"x_idtiket","forceSelect":false}, ew.vars.tables.tiket_detail.fields.idtiket.autoSuggestOptions));
});
</script>
<?= $Page->idtiket->Lookup->getParamTag($Page, "p_x_idtiket") ?>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
    <div id="r_deskripsi" class="form-group row">
        <label id="elh_tiket_detail_deskripsi" for="x_deskripsi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->deskripsi->caption() ?><?= $Page->deskripsi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->deskripsi->cellAttributes() ?>>
<span id="el_tiket_detail_deskripsi">
<textarea data-table="tiket_detail" data-field="x_deskripsi" name="x_deskripsi" id="x_deskripsi" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->deskripsi->getPlaceHolder()) ?>"<?= $Page->deskripsi->editAttributes() ?> aria-describedby="x_deskripsi_help"><?= $Page->deskripsi->EditValue ?></textarea>
<?= $Page->deskripsi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->deskripsi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
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
    ew.addEventHandlers("tiket_detail");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
