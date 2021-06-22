<?php

namespace PHPMaker2021\simtrial;

// Page object
$ProduksiDetailAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fproduksi_detailadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fproduksi_detailadd = currentForm = new ew.Form("fproduksi_detailadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "produksi_detail")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.produksi_detail)
        ew.vars.tables.produksi_detail = currentTable;
    fproduksi_detailadd.addFields([
        ["idproduksi", [fields.idproduksi.visible && fields.idproduksi.required ? ew.Validators.required(fields.idproduksi.caption) : null, ew.Validators.integer], fields.idproduksi.isInvalid],
        ["idproduk", [fields.idproduk.visible && fields.idproduk.required ? ew.Validators.required(fields.idproduk.caption) : null], fields.idproduk.isInvalid],
        ["target", [fields.target.visible && fields.target.required ? ew.Validators.required(fields.target.caption) : null, ew.Validators.integer], fields.target.isInvalid],
        ["realisasi", [fields.realisasi.visible && fields.realisasi.required ? ew.Validators.required(fields.realisasi.caption) : null, ew.Validators.integer], fields.realisasi.isInvalid],
        ["persentase", [fields.persentase.visible && fields.persentase.required ? ew.Validators.required(fields.persentase.caption) : null, ew.Validators.integer], fields.persentase.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fproduksi_detailadd,
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
    fproduksi_detailadd.validate = function () {
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
    fproduksi_detailadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fproduksi_detailadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fproduksi_detailadd.lists.idproduksi = <?= $Page->idproduksi->toClientList($Page) ?>;
    fproduksi_detailadd.lists.idproduk = <?= $Page->idproduk->toClientList($Page) ?>;
    loadjs.done("fproduksi_detailadd");
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
<form name="fproduksi_detailadd" id="fproduksi_detailadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="produksi_detail">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "produk") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="produk">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->idproduk->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "produksi") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="produksi">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->idproduksi->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->idproduksi->Visible) { // idproduksi ?>
    <div id="r_idproduksi" class="form-group row">
        <label id="elh_produksi_detail_idproduksi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idproduksi->caption() ?><?= $Page->idproduksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->idproduksi->cellAttributes() ?>>
<?php if ($Page->idproduksi->getSessionValue() != "") { ?>
<span id="el_produksi_detail_idproduksi">
<span<?= $Page->idproduksi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->idproduksi->getDisplayValue($Page->idproduksi->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_idproduksi" name="x_idproduksi" value="<?= HtmlEncode($Page->idproduksi->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_produksi_detail_idproduksi">
<?php
$onchange = $Page->idproduksi->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Page->idproduksi->EditAttrs["onchange"] = "";
?>
<span id="as_x_idproduksi" class="ew-auto-suggest">
    <input type="<?= $Page->idproduksi->getInputTextType() ?>" class="form-control" name="sv_x_idproduksi" id="sv_x_idproduksi" value="<?= RemoveHtml($Page->idproduksi->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Page->idproduksi->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->idproduksi->getPlaceHolder()) ?>"<?= $Page->idproduksi->editAttributes() ?> aria-describedby="x_idproduksi_help">
</span>
<input type="hidden" is="selection-list" class="form-control" data-table="produksi_detail" data-field="x_idproduksi" data-input="sv_x_idproduksi" data-value-separator="<?= $Page->idproduksi->displayValueSeparatorAttribute() ?>" name="x_idproduksi" id="x_idproduksi" value="<?= HtmlEncode($Page->idproduksi->CurrentValue) ?>"<?= $onchange ?>>
<?= $Page->idproduksi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->idproduksi->getErrorMessage() ?></div>
<script>
loadjs.ready(["fproduksi_detailadd"], function() {
    fproduksi_detailadd.createAutoSuggest(Object.assign({"id":"x_idproduksi","forceSelect":false}, ew.vars.tables.produksi_detail.fields.idproduksi.autoSuggestOptions));
});
</script>
<?= $Page->idproduksi->Lookup->getParamTag($Page, "p_x_idproduksi") ?>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->idproduk->Visible) { // idproduk ?>
    <div id="r_idproduk" class="form-group row">
        <label id="elh_produksi_detail_idproduk" for="x_idproduk" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idproduk->caption() ?><?= $Page->idproduk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->idproduk->cellAttributes() ?>>
<?php if ($Page->idproduk->getSessionValue() != "") { ?>
<span id="el_produksi_detail_idproduk">
<span<?= $Page->idproduk->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->idproduk->getDisplayValue($Page->idproduk->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_idproduk" name="x_idproduk" value="<?= HtmlEncode($Page->idproduk->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_produksi_detail_idproduk">
    <select
        id="x_idproduk"
        name="x_idproduk"
        class="form-control ew-select<?= $Page->idproduk->isInvalidClass() ?>"
        data-select2-id="produksi_detail_x_idproduk"
        data-table="produksi_detail"
        data-field="x_idproduk"
        data-value-separator="<?= $Page->idproduk->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->idproduk->getPlaceHolder()) ?>"
        <?= $Page->idproduk->editAttributes() ?>>
        <?= $Page->idproduk->selectOptionListHtml("x_idproduk") ?>
    </select>
    <?= $Page->idproduk->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->idproduk->getErrorMessage() ?></div>
<?= $Page->idproduk->Lookup->getParamTag($Page, "p_x_idproduk") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='produksi_detail_x_idproduk']"),
        options = { name: "x_idproduk", selectId: "produksi_detail_x_idproduk", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.produksi_detail.fields.idproduk.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->target->Visible) { // target ?>
    <div id="r_target" class="form-group row">
        <label id="elh_produksi_detail_target" for="x_target" class="<?= $Page->LeftColumnClass ?>"><?= $Page->target->caption() ?><?= $Page->target->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->target->cellAttributes() ?>>
<span id="el_produksi_detail_target">
<input type="<?= $Page->target->getInputTextType() ?>" data-table="produksi_detail" data-field="x_target" name="x_target" id="x_target" size="30" placeholder="<?= HtmlEncode($Page->target->getPlaceHolder()) ?>" value="<?= $Page->target->EditValue ?>"<?= $Page->target->editAttributes() ?> aria-describedby="x_target_help">
<?= $Page->target->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->target->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->realisasi->Visible) { // realisasi ?>
    <div id="r_realisasi" class="form-group row">
        <label id="elh_produksi_detail_realisasi" for="x_realisasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->realisasi->caption() ?><?= $Page->realisasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->realisasi->cellAttributes() ?>>
<span id="el_produksi_detail_realisasi">
<input type="<?= $Page->realisasi->getInputTextType() ?>" data-table="produksi_detail" data-field="x_realisasi" name="x_realisasi" id="x_realisasi" size="30" placeholder="<?= HtmlEncode($Page->realisasi->getPlaceHolder()) ?>" value="<?= $Page->realisasi->EditValue ?>"<?= $Page->realisasi->editAttributes() ?> aria-describedby="x_realisasi_help">
<?= $Page->realisasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->realisasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->persentase->Visible) { // persentase ?>
    <div id="r_persentase" class="form-group row">
        <label id="elh_produksi_detail_persentase" for="x_persentase" class="<?= $Page->LeftColumnClass ?>"><?= $Page->persentase->caption() ?><?= $Page->persentase->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->persentase->cellAttributes() ?>>
<span id="el_produksi_detail_persentase">
<input type="<?= $Page->persentase->getInputTextType() ?>" data-table="produksi_detail" data-field="x_persentase" name="x_persentase" id="x_persentase" size="30" placeholder="<?= HtmlEncode($Page->persentase->getPlaceHolder()) ?>" value="<?= $Page->persentase->EditValue ?>"<?= $Page->persentase->editAttributes() ?> aria-describedby="x_persentase_help">
<?= $Page->persentase->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->persentase->getErrorMessage() ?></div>
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
    ew.addEventHandlers("produksi_detail");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
