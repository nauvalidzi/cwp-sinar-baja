<?php

namespace PHPMaker2021\simtrial;

// Page object
$TiketAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftiketadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    ftiketadd = currentForm = new ew.Form("ftiketadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "tiket")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.tiket)
        ew.vars.tables.tiket = currentTable;
    ftiketadd.addFields([
        ["subjek", [fields.subjek.visible && fields.subjek.required ? ew.Validators.required(fields.subjek.caption) : null], fields.subjek.isInvalid],
        ["tanggal", [fields.tanggal.visible && fields.tanggal.required ? ew.Validators.required(fields.tanggal.caption) : null, ew.Validators.datetime(7)], fields.tanggal.isInvalid],
        ["kode", [fields.kode.visible && fields.kode.required ? ew.Validators.required(fields.kode.caption) : null], fields.kode.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["deskripsi", [fields.deskripsi.visible && fields.deskripsi.required ? ew.Validators.required(fields.deskripsi.caption) : null], fields.deskripsi.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = ftiketadd,
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
    ftiketadd.validate = function () {
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
    ftiketadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftiketadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    ftiketadd.lists.subjek = <?= $Page->subjek->toClientList($Page) ?>;
    ftiketadd.lists.status = <?= $Page->status->toClientList($Page) ?>;
    loadjs.done("ftiketadd");
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
<form name="ftiketadd" id="ftiketadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="tiket">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->subjek->Visible) { // subjek ?>
    <div id="r_subjek" class="form-group row">
        <label id="elh_tiket_subjek" class="<?= $Page->LeftColumnClass ?>"><?= $Page->subjek->caption() ?><?= $Page->subjek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->subjek->cellAttributes() ?>>
<span id="el_tiket_subjek">
<?php
$onchange = $Page->subjek->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Page->subjek->EditAttrs["onchange"] = "";
?>
<span id="as_x_subjek" class="ew-auto-suggest">
    <input type="<?= $Page->subjek->getInputTextType() ?>" class="form-control" name="sv_x_subjek" id="sv_x_subjek" value="<?= RemoveHtml($Page->subjek->EditValue) ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->subjek->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->subjek->getPlaceHolder()) ?>"<?= $Page->subjek->editAttributes() ?> aria-describedby="x_subjek_help">
</span>
<input type="hidden" is="selection-list" class="form-control" data-table="tiket" data-field="x_subjek" data-input="sv_x_subjek" data-value-separator="<?= $Page->subjek->displayValueSeparatorAttribute() ?>" name="x_subjek" id="x_subjek" value="<?= HtmlEncode($Page->subjek->CurrentValue) ?>"<?= $onchange ?>>
<?= $Page->subjek->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->subjek->getErrorMessage() ?></div>
<script>
loadjs.ready(["ftiketadd"], function() {
    ftiketadd.createAutoSuggest(Object.assign({"id":"x_subjek","forceSelect":true}, ew.vars.tables.tiket.fields.subjek.autoSuggestOptions));
});
</script>
<?= $Page->subjek->Lookup->getParamTag($Page, "p_x_subjek") ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
    <div id="r_tanggal" class="form-group row">
        <label id="elh_tiket_tanggal" for="x_tanggal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggal->caption() ?><?= $Page->tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tanggal->cellAttributes() ?>>
<span id="el_tiket_tanggal">
<input type="<?= $Page->tanggal->getInputTextType() ?>" data-table="tiket" data-field="x_tanggal" data-format="7" name="x_tanggal" id="x_tanggal" placeholder="<?= HtmlEncode($Page->tanggal->getPlaceHolder()) ?>" value="<?= $Page->tanggal->EditValue ?>"<?= $Page->tanggal->editAttributes() ?> aria-describedby="x_tanggal_help">
<?= $Page->tanggal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggal->getErrorMessage() ?></div>
<?php if (!$Page->tanggal->ReadOnly && !$Page->tanggal->Disabled && !isset($Page->tanggal->EditAttrs["readonly"]) && !isset($Page->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftiketadd", "datetimepicker"], function() {
    ew.createDateTimePicker("ftiketadd", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode->Visible) { // kode ?>
    <div id="r_kode" class="form-group row">
        <label id="elh_tiket_kode" for="x_kode" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode->caption() ?><?= $Page->kode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode->cellAttributes() ?>>
<span id="el_tiket_kode">
<input type="<?= $Page->kode->getInputTextType() ?>" data-table="tiket" data-field="x_kode" name="x_kode" id="x_kode" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->kode->getPlaceHolder()) ?>" value="<?= $Page->kode->EditValue ?>"<?= $Page->kode->editAttributes() ?> aria-describedby="x_kode_help">
<?= $Page->kode->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status" class="form-group row">
        <label id="elh_tiket_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status->cellAttributes() ?>>
<span id="el_tiket_status">
    <select
        id="x_status"
        name="x_status"
        class="form-control ew-select<?= $Page->status->isInvalidClass() ?>"
        data-select2-id="tiket_x_status"
        data-table="tiket"
        data-field="x_status"
        data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"
        <?= $Page->status->editAttributes() ?>>
        <?= $Page->status->selectOptionListHtml("x_status") ?>
    </select>
    <?= $Page->status->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='tiket_x_status']"),
        options = { name: "x_status", selectId: "tiket_x_status", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.data = ew.vars.tables.tiket.fields.status.lookupOptions;
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.tiket.fields.status.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
    <div id="r_deskripsi" class="form-group row">
        <label id="elh_tiket_deskripsi" for="x_deskripsi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->deskripsi->caption() ?><?= $Page->deskripsi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->deskripsi->cellAttributes() ?>>
<span id="el_tiket_deskripsi">
<textarea data-table="tiket" data-field="x_deskripsi" name="x_deskripsi" id="x_deskripsi" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->deskripsi->getPlaceHolder()) ?>"<?= $Page->deskripsi->editAttributes() ?> aria-describedby="x_deskripsi_help"><?= $Page->deskripsi->EditValue ?></textarea>
<?= $Page->deskripsi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->deskripsi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("tiket_detail", explode(",", $Page->getCurrentDetailTable())) && $tiket_detail->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("tiket_detail", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "TiketDetailGrid.php" ?>
<?php } ?>
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
    ew.addEventHandlers("tiket");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
