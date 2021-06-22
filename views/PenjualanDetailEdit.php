<?php

namespace PHPMaker2021\simtrial;

// Page object
$PenjualanDetailEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpenjualan_detailedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fpenjualan_detailedit = currentForm = new ew.Form("fpenjualan_detailedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "penjualan_detail")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.penjualan_detail)
        ew.vars.tables.penjualan_detail = currentTable;
    fpenjualan_detailedit.addFields([
        ["idproduk", [fields.idproduk.visible && fields.idproduk.required ? ew.Validators.required(fields.idproduk.caption) : null], fields.idproduk.isInvalid],
        ["jumlah", [fields.jumlah.visible && fields.jumlah.required ? ew.Validators.required(fields.jumlah.caption) : null, ew.Validators.integer], fields.jumlah.isInvalid],
        ["harga", [fields.harga.visible && fields.harga.required ? ew.Validators.required(fields.harga.caption) : null, ew.Validators.float], fields.harga.isInvalid],
        ["catatan", [fields.catatan.visible && fields.catatan.required ? ew.Validators.required(fields.catatan.caption) : null], fields.catatan.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpenjualan_detailedit,
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
    fpenjualan_detailedit.validate = function () {
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
    fpenjualan_detailedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpenjualan_detailedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fpenjualan_detailedit.lists.idproduk = <?= $Page->idproduk->toClientList($Page) ?>;
    loadjs.done("fpenjualan_detailedit");
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
<form name="fpenjualan_detailedit" id="fpenjualan_detailedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penjualan_detail">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "produk") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="produk">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->idproduk->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "penjualan") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="penjualan">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->idpenjualan->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->idproduk->Visible) { // idproduk ?>
    <div id="r_idproduk" class="form-group row">
        <label id="elh_penjualan_detail_idproduk" for="x_idproduk" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idproduk->caption() ?><?= $Page->idproduk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->idproduk->cellAttributes() ?>>
<?php if ($Page->idproduk->getSessionValue() != "") { ?>
<span id="el_penjualan_detail_idproduk">
<span<?= $Page->idproduk->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->idproduk->getDisplayValue($Page->idproduk->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_idproduk" name="x_idproduk" value="<?= HtmlEncode($Page->idproduk->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_penjualan_detail_idproduk">
    <select
        id="x_idproduk"
        name="x_idproduk"
        class="form-control ew-select<?= $Page->idproduk->isInvalidClass() ?>"
        data-select2-id="penjualan_detail_x_idproduk"
        data-table="penjualan_detail"
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
    var el = document.querySelector("select[data-select2-id='penjualan_detail_x_idproduk']"),
        options = { name: "x_idproduk", selectId: "penjualan_detail_x_idproduk", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.penjualan_detail.fields.idproduk.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jumlah->Visible) { // jumlah ?>
    <div id="r_jumlah" class="form-group row">
        <label id="elh_penjualan_detail_jumlah" for="x_jumlah" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jumlah->caption() ?><?= $Page->jumlah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jumlah->cellAttributes() ?>>
<span id="el_penjualan_detail_jumlah">
<input type="<?= $Page->jumlah->getInputTextType() ?>" data-table="penjualan_detail" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" placeholder="<?= HtmlEncode($Page->jumlah->getPlaceHolder()) ?>" value="<?= $Page->jumlah->EditValue ?>"<?= $Page->jumlah->editAttributes() ?> aria-describedby="x_jumlah_help">
<?= $Page->jumlah->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jumlah->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->harga->Visible) { // harga ?>
    <div id="r_harga" class="form-group row">
        <label id="elh_penjualan_detail_harga" for="x_harga" class="<?= $Page->LeftColumnClass ?>"><?= $Page->harga->caption() ?><?= $Page->harga->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->harga->cellAttributes() ?>>
<span id="el_penjualan_detail_harga">
<input type="<?= $Page->harga->getInputTextType() ?>" data-table="penjualan_detail" data-field="x_harga" name="x_harga" id="x_harga" size="30" placeholder="<?= HtmlEncode($Page->harga->getPlaceHolder()) ?>" value="<?= $Page->harga->EditValue ?>"<?= $Page->harga->editAttributes() ?> aria-describedby="x_harga_help">
<?= $Page->harga->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->harga->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->catatan->Visible) { // catatan ?>
    <div id="r_catatan" class="form-group row">
        <label id="elh_penjualan_detail_catatan" for="x_catatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->catatan->caption() ?><?= $Page->catatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->catatan->cellAttributes() ?>>
<span id="el_penjualan_detail_catatan">
<textarea data-table="penjualan_detail" data-field="x_catatan" name="x_catatan" id="x_catatan" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->catatan->getPlaceHolder()) ?>"<?= $Page->catatan->editAttributes() ?> aria-describedby="x_catatan_help"><?= $Page->catatan->EditValue ?></textarea>
<?= $Page->catatan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->catatan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="penjualan_detail" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
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
    ew.addEventHandlers("penjualan_detail");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
