<?php

namespace PHPMaker2021\simtrial;

// Set up and run Grid object
$Grid = Container("ProduksiDetailGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fproduksi_detailgrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fproduksi_detailgrid = new ew.Form("fproduksi_detailgrid", "grid");
    fproduksi_detailgrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "produksi_detail")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.produksi_detail)
        ew.vars.tables.produksi_detail = currentTable;
    fproduksi_detailgrid.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["idproduksi", [fields.idproduksi.visible && fields.idproduksi.required ? ew.Validators.required(fields.idproduksi.caption) : null, ew.Validators.integer], fields.idproduksi.isInvalid],
        ["idproduk", [fields.idproduk.visible && fields.idproduk.required ? ew.Validators.required(fields.idproduk.caption) : null], fields.idproduk.isInvalid],
        ["target", [fields.target.visible && fields.target.required ? ew.Validators.required(fields.target.caption) : null, ew.Validators.integer], fields.target.isInvalid],
        ["realisasi", [fields.realisasi.visible && fields.realisasi.required ? ew.Validators.required(fields.realisasi.caption) : null, ew.Validators.integer], fields.realisasi.isInvalid],
        ["persentase", [fields.persentase.visible && fields.persentase.required ? ew.Validators.required(fields.persentase.caption) : null, ew.Validators.integer], fields.persentase.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fproduksi_detailgrid,
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
    fproduksi_detailgrid.validate = function () {
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
            var checkrow = (gridinsert) ? !this.emptyRow(rowIndex) : true;
            if (checkrow) {
                addcnt++;

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
            } // End Grid Add checking
        }
        return true;
    }

    // Check empty row
    fproduksi_detailgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "idproduksi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "idproduk", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "target", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "realisasi", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "persentase", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fproduksi_detailgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fproduksi_detailgrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fproduksi_detailgrid.lists.idproduksi = <?= $Grid->idproduksi->toClientList($Grid) ?>;
    fproduksi_detailgrid.lists.idproduk = <?= $Grid->idproduk->toClientList($Grid) ?>;
    loadjs.done("fproduksi_detailgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> produksi_detail">
<div id="fproduksi_detailgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_produksi_detail" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_produksi_detailgrid" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Grid->RowType = ROWTYPE_HEADER;

// Render list options
$Grid->renderListOptions();

// Render list options (header, left)
$Grid->ListOptions->render("header", "left");
?>
<?php if ($Grid->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_produksi_detail_id" class="produksi_detail_id"><?= $Grid->renderSort($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->idproduksi->Visible) { // idproduksi ?>
        <th data-name="idproduksi" class="<?= $Grid->idproduksi->headerCellClass() ?>"><div id="elh_produksi_detail_idproduksi" class="produksi_detail_idproduksi"><?= $Grid->renderSort($Grid->idproduksi) ?></div></th>
<?php } ?>
<?php if ($Grid->idproduk->Visible) { // idproduk ?>
        <th data-name="idproduk" class="<?= $Grid->idproduk->headerCellClass() ?>"><div id="elh_produksi_detail_idproduk" class="produksi_detail_idproduk"><?= $Grid->renderSort($Grid->idproduk) ?></div></th>
<?php } ?>
<?php if ($Grid->target->Visible) { // target ?>
        <th data-name="target" class="<?= $Grid->target->headerCellClass() ?>"><div id="elh_produksi_detail_target" class="produksi_detail_target"><?= $Grid->renderSort($Grid->target) ?></div></th>
<?php } ?>
<?php if ($Grid->realisasi->Visible) { // realisasi ?>
        <th data-name="realisasi" class="<?= $Grid->realisasi->headerCellClass() ?>"><div id="elh_produksi_detail_realisasi" class="produksi_detail_realisasi"><?= $Grid->renderSort($Grid->realisasi) ?></div></th>
<?php } ?>
<?php if ($Grid->persentase->Visible) { // persentase ?>
        <th data-name="persentase" class="<?= $Grid->persentase->headerCellClass() ?>"><div id="elh_produksi_detail_persentase" class="produksi_detail_persentase"><?= $Grid->renderSort($Grid->persentase) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Grid->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
$Grid->StartRecord = 1;
$Grid->StopRecord = $Grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($Grid->isConfirm() || $Grid->EventCancelled)) {
    $CurrentForm->Index = -1;
    if ($CurrentForm->hasValue($Grid->FormKeyCountName) && ($Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm())) {
        $Grid->KeyCount = $CurrentForm->getValue($Grid->FormKeyCountName);
        $Grid->StopRecord = $Grid->StartRecord + $Grid->KeyCount - 1;
    }
}
$Grid->RecordCount = $Grid->StartRecord - 1;
if ($Grid->Recordset && !$Grid->Recordset->EOF) {
    // Nothing to do
} elseif (!$Grid->AllowAddDeleteRow && $Grid->StopRecord == 0) {
    $Grid->StopRecord = $Grid->GridAddRowCount;
}

// Initialize aggregate
$Grid->RowType = ROWTYPE_AGGREGATEINIT;
$Grid->resetAttributes();
$Grid->renderRow();
if ($Grid->isGridAdd())
    $Grid->RowIndex = 0;
if ($Grid->isGridEdit())
    $Grid->RowIndex = 0;
while ($Grid->RecordCount < $Grid->StopRecord) {
    $Grid->RecordCount++;
    if ($Grid->RecordCount >= $Grid->StartRecord) {
        $Grid->RowCount++;
        if ($Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm()) {
            $Grid->RowIndex++;
            $CurrentForm->Index = $Grid->RowIndex;
            if ($CurrentForm->hasValue($Grid->FormActionName) && ($Grid->isConfirm() || $Grid->EventCancelled)) {
                $Grid->RowAction = strval($CurrentForm->getValue($Grid->FormActionName));
            } elseif ($Grid->isGridAdd()) {
                $Grid->RowAction = "insert";
            } else {
                $Grid->RowAction = "";
            }
        }

        // Set up key count
        $Grid->KeyCount = $Grid->RowIndex;

        // Init row class and style
        $Grid->resetAttributes();
        $Grid->CssClass = "";
        if ($Grid->isGridAdd()) {
            if ($Grid->CurrentMode == "copy") {
                $Grid->loadRowValues($Grid->Recordset); // Load row values
                $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
            } else {
                $Grid->loadRowValues(); // Load default values
                $Grid->OldKey = "";
            }
        } else {
            $Grid->loadRowValues($Grid->Recordset); // Load row values
            $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
        }
        $Grid->setKey($Grid->OldKey);
        $Grid->RowType = ROWTYPE_VIEW; // Render view
        if ($Grid->isGridAdd()) { // Grid add
            $Grid->RowType = ROWTYPE_ADD; // Render add
        }
        if ($Grid->isGridAdd() && $Grid->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) { // Insert failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->isGridEdit()) { // Grid edit
            if ($Grid->EventCancelled) {
                $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
            }
            if ($Grid->RowAction == "insert") {
                $Grid->RowType = ROWTYPE_ADD; // Render add
            } else {
                $Grid->RowType = ROWTYPE_EDIT; // Render edit
            }
        }
        if ($Grid->isGridEdit() && ($Grid->RowType == ROWTYPE_EDIT || $Grid->RowType == ROWTYPE_ADD) && $Grid->EventCancelled) { // Update failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->RowType == ROWTYPE_EDIT) { // Edit row
            $Grid->EditRowCount++;
        }
        if ($Grid->isConfirm()) { // Confirm row
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }

        // Set up row id / data-rowindex
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_produksi_detail", "data-rowtype" => $Grid->RowType]);

        // Render row
        $Grid->renderRow();

        // Render list options
        $Grid->renderListOptions();

        // Skip delete row / empty row for confirm page
        if ($Grid->RowAction != "delete" && $Grid->RowAction != "insertdelete" && !($Grid->RowAction == "insert" && $Grid->isConfirm() && $Grid->emptyRow())) {
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowCount);
?>
    <?php if ($Grid->id->Visible) { // id ?>
        <td data-name="id" <?= $Grid->id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_produksi_detail_id" class="form-group"></span>
<input type="hidden" data-table="produksi_detail" data-field="x_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_produksi_detail_id" class="form-group">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="produksi_detail" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_produksi_detail_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="produksi_detail" data-field="x_id" data-hidden="1" name="fproduksi_detailgrid$x<?= $Grid->RowIndex ?>_id" id="fproduksi_detailgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="produksi_detail" data-field="x_id" data-hidden="1" name="fproduksi_detailgrid$o<?= $Grid->RowIndex ?>_id" id="fproduksi_detailgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="produksi_detail" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->idproduksi->Visible) { // idproduksi ?>
        <td data-name="idproduksi" <?= $Grid->idproduksi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->idproduksi->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_produksi_detail_idproduksi" class="form-group">
<span<?= $Grid->idproduksi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->idproduksi->getDisplayValue($Grid->idproduksi->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_idproduksi" name="x<?= $Grid->RowIndex ?>_idproduksi" value="<?= HtmlEncode($Grid->idproduksi->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_produksi_detail_idproduksi" class="form-group">
<?php
$onchange = $Grid->idproduksi->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Grid->idproduksi->EditAttrs["onchange"] = "";
?>
<span id="as_x<?= $Grid->RowIndex ?>_idproduksi" class="ew-auto-suggest">
    <input type="<?= $Grid->idproduksi->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_idproduksi" id="sv_x<?= $Grid->RowIndex ?>_idproduksi" value="<?= RemoveHtml($Grid->idproduksi->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Grid->idproduksi->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->idproduksi->getPlaceHolder()) ?>"<?= $Grid->idproduksi->editAttributes() ?>>
</span>
<input type="hidden" is="selection-list" class="form-control" data-table="produksi_detail" data-field="x_idproduksi" data-input="sv_x<?= $Grid->RowIndex ?>_idproduksi" data-value-separator="<?= $Grid->idproduksi->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_idproduksi" id="x<?= $Grid->RowIndex ?>_idproduksi" value="<?= HtmlEncode($Grid->idproduksi->CurrentValue) ?>"<?= $onchange ?>>
<div class="invalid-feedback"><?= $Grid->idproduksi->getErrorMessage() ?></div>
<script>
loadjs.ready(["fproduksi_detailgrid"], function() {
    fproduksi_detailgrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_idproduksi","forceSelect":false}, ew.vars.tables.produksi_detail.fields.idproduksi.autoSuggestOptions));
});
</script>
<?= $Grid->idproduksi->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idproduksi") ?>
</span>
<?php } ?>
<input type="hidden" data-table="produksi_detail" data-field="x_idproduksi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idproduksi" id="o<?= $Grid->RowIndex ?>_idproduksi" value="<?= HtmlEncode($Grid->idproduksi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->idproduksi->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_produksi_detail_idproduksi" class="form-group">
<span<?= $Grid->idproduksi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->idproduksi->getDisplayValue($Grid->idproduksi->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_idproduksi" name="x<?= $Grid->RowIndex ?>_idproduksi" value="<?= HtmlEncode($Grid->idproduksi->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_produksi_detail_idproduksi" class="form-group">
<?php
$onchange = $Grid->idproduksi->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Grid->idproduksi->EditAttrs["onchange"] = "";
?>
<span id="as_x<?= $Grid->RowIndex ?>_idproduksi" class="ew-auto-suggest">
    <input type="<?= $Grid->idproduksi->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_idproduksi" id="sv_x<?= $Grid->RowIndex ?>_idproduksi" value="<?= RemoveHtml($Grid->idproduksi->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Grid->idproduksi->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->idproduksi->getPlaceHolder()) ?>"<?= $Grid->idproduksi->editAttributes() ?>>
</span>
<input type="hidden" is="selection-list" class="form-control" data-table="produksi_detail" data-field="x_idproduksi" data-input="sv_x<?= $Grid->RowIndex ?>_idproduksi" data-value-separator="<?= $Grid->idproduksi->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_idproduksi" id="x<?= $Grid->RowIndex ?>_idproduksi" value="<?= HtmlEncode($Grid->idproduksi->CurrentValue) ?>"<?= $onchange ?>>
<div class="invalid-feedback"><?= $Grid->idproduksi->getErrorMessage() ?></div>
<script>
loadjs.ready(["fproduksi_detailgrid"], function() {
    fproduksi_detailgrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_idproduksi","forceSelect":false}, ew.vars.tables.produksi_detail.fields.idproduksi.autoSuggestOptions));
});
</script>
<?= $Grid->idproduksi->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idproduksi") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_produksi_detail_idproduksi">
<span<?= $Grid->idproduksi->viewAttributes() ?>>
<?= $Grid->idproduksi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="produksi_detail" data-field="x_idproduksi" data-hidden="1" name="fproduksi_detailgrid$x<?= $Grid->RowIndex ?>_idproduksi" id="fproduksi_detailgrid$x<?= $Grid->RowIndex ?>_idproduksi" value="<?= HtmlEncode($Grid->idproduksi->FormValue) ?>">
<input type="hidden" data-table="produksi_detail" data-field="x_idproduksi" data-hidden="1" name="fproduksi_detailgrid$o<?= $Grid->RowIndex ?>_idproduksi" id="fproduksi_detailgrid$o<?= $Grid->RowIndex ?>_idproduksi" value="<?= HtmlEncode($Grid->idproduksi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->idproduk->Visible) { // idproduk ?>
        <td data-name="idproduk" <?= $Grid->idproduk->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->idproduk->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_produksi_detail_idproduk" class="form-group">
<span<?= $Grid->idproduk->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->idproduk->getDisplayValue($Grid->idproduk->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_idproduk" name="x<?= $Grid->RowIndex ?>_idproduk" value="<?= HtmlEncode($Grid->idproduk->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_produksi_detail_idproduk" class="form-group">
    <select
        id="x<?= $Grid->RowIndex ?>_idproduk"
        name="x<?= $Grid->RowIndex ?>_idproduk"
        class="form-control ew-select<?= $Grid->idproduk->isInvalidClass() ?>"
        data-select2-id="produksi_detail_x<?= $Grid->RowIndex ?>_idproduk"
        data-table="produksi_detail"
        data-field="x_idproduk"
        data-value-separator="<?= $Grid->idproduk->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->idproduk->getPlaceHolder()) ?>"
        <?= $Grid->idproduk->editAttributes() ?>>
        <?= $Grid->idproduk->selectOptionListHtml("x{$Grid->RowIndex}_idproduk") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->idproduk->getErrorMessage() ?></div>
<?= $Grid->idproduk->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idproduk") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='produksi_detail_x<?= $Grid->RowIndex ?>_idproduk']"),
        options = { name: "x<?= $Grid->RowIndex ?>_idproduk", selectId: "produksi_detail_x<?= $Grid->RowIndex ?>_idproduk", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.produksi_detail.fields.idproduk.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="produksi_detail" data-field="x_idproduk" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idproduk" id="o<?= $Grid->RowIndex ?>_idproduk" value="<?= HtmlEncode($Grid->idproduk->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->idproduk->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_produksi_detail_idproduk" class="form-group">
<span<?= $Grid->idproduk->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->idproduk->getDisplayValue($Grid->idproduk->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_idproduk" name="x<?= $Grid->RowIndex ?>_idproduk" value="<?= HtmlEncode($Grid->idproduk->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_produksi_detail_idproduk" class="form-group">
    <select
        id="x<?= $Grid->RowIndex ?>_idproduk"
        name="x<?= $Grid->RowIndex ?>_idproduk"
        class="form-control ew-select<?= $Grid->idproduk->isInvalidClass() ?>"
        data-select2-id="produksi_detail_x<?= $Grid->RowIndex ?>_idproduk"
        data-table="produksi_detail"
        data-field="x_idproduk"
        data-value-separator="<?= $Grid->idproduk->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->idproduk->getPlaceHolder()) ?>"
        <?= $Grid->idproduk->editAttributes() ?>>
        <?= $Grid->idproduk->selectOptionListHtml("x{$Grid->RowIndex}_idproduk") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->idproduk->getErrorMessage() ?></div>
<?= $Grid->idproduk->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idproduk") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='produksi_detail_x<?= $Grid->RowIndex ?>_idproduk']"),
        options = { name: "x<?= $Grid->RowIndex ?>_idproduk", selectId: "produksi_detail_x<?= $Grid->RowIndex ?>_idproduk", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.produksi_detail.fields.idproduk.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_produksi_detail_idproduk">
<span<?= $Grid->idproduk->viewAttributes() ?>>
<?= $Grid->idproduk->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="produksi_detail" data-field="x_idproduk" data-hidden="1" name="fproduksi_detailgrid$x<?= $Grid->RowIndex ?>_idproduk" id="fproduksi_detailgrid$x<?= $Grid->RowIndex ?>_idproduk" value="<?= HtmlEncode($Grid->idproduk->FormValue) ?>">
<input type="hidden" data-table="produksi_detail" data-field="x_idproduk" data-hidden="1" name="fproduksi_detailgrid$o<?= $Grid->RowIndex ?>_idproduk" id="fproduksi_detailgrid$o<?= $Grid->RowIndex ?>_idproduk" value="<?= HtmlEncode($Grid->idproduk->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->target->Visible) { // target ?>
        <td data-name="target" <?= $Grid->target->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_produksi_detail_target" class="form-group">
<input type="<?= $Grid->target->getInputTextType() ?>" data-table="produksi_detail" data-field="x_target" name="x<?= $Grid->RowIndex ?>_target" id="x<?= $Grid->RowIndex ?>_target" size="30" placeholder="<?= HtmlEncode($Grid->target->getPlaceHolder()) ?>" value="<?= $Grid->target->EditValue ?>"<?= $Grid->target->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->target->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="produksi_detail" data-field="x_target" data-hidden="1" name="o<?= $Grid->RowIndex ?>_target" id="o<?= $Grid->RowIndex ?>_target" value="<?= HtmlEncode($Grid->target->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_produksi_detail_target" class="form-group">
<input type="<?= $Grid->target->getInputTextType() ?>" data-table="produksi_detail" data-field="x_target" name="x<?= $Grid->RowIndex ?>_target" id="x<?= $Grid->RowIndex ?>_target" size="30" placeholder="<?= HtmlEncode($Grid->target->getPlaceHolder()) ?>" value="<?= $Grid->target->EditValue ?>"<?= $Grid->target->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->target->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_produksi_detail_target">
<span<?= $Grid->target->viewAttributes() ?>>
<?= $Grid->target->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="produksi_detail" data-field="x_target" data-hidden="1" name="fproduksi_detailgrid$x<?= $Grid->RowIndex ?>_target" id="fproduksi_detailgrid$x<?= $Grid->RowIndex ?>_target" value="<?= HtmlEncode($Grid->target->FormValue) ?>">
<input type="hidden" data-table="produksi_detail" data-field="x_target" data-hidden="1" name="fproduksi_detailgrid$o<?= $Grid->RowIndex ?>_target" id="fproduksi_detailgrid$o<?= $Grid->RowIndex ?>_target" value="<?= HtmlEncode($Grid->target->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->realisasi->Visible) { // realisasi ?>
        <td data-name="realisasi" <?= $Grid->realisasi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_produksi_detail_realisasi" class="form-group">
<input type="<?= $Grid->realisasi->getInputTextType() ?>" data-table="produksi_detail" data-field="x_realisasi" name="x<?= $Grid->RowIndex ?>_realisasi" id="x<?= $Grid->RowIndex ?>_realisasi" size="30" placeholder="<?= HtmlEncode($Grid->realisasi->getPlaceHolder()) ?>" value="<?= $Grid->realisasi->EditValue ?>"<?= $Grid->realisasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->realisasi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="produksi_detail" data-field="x_realisasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_realisasi" id="o<?= $Grid->RowIndex ?>_realisasi" value="<?= HtmlEncode($Grid->realisasi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_produksi_detail_realisasi" class="form-group">
<input type="<?= $Grid->realisasi->getInputTextType() ?>" data-table="produksi_detail" data-field="x_realisasi" name="x<?= $Grid->RowIndex ?>_realisasi" id="x<?= $Grid->RowIndex ?>_realisasi" size="30" placeholder="<?= HtmlEncode($Grid->realisasi->getPlaceHolder()) ?>" value="<?= $Grid->realisasi->EditValue ?>"<?= $Grid->realisasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->realisasi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_produksi_detail_realisasi">
<span<?= $Grid->realisasi->viewAttributes() ?>>
<?= $Grid->realisasi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="produksi_detail" data-field="x_realisasi" data-hidden="1" name="fproduksi_detailgrid$x<?= $Grid->RowIndex ?>_realisasi" id="fproduksi_detailgrid$x<?= $Grid->RowIndex ?>_realisasi" value="<?= HtmlEncode($Grid->realisasi->FormValue) ?>">
<input type="hidden" data-table="produksi_detail" data-field="x_realisasi" data-hidden="1" name="fproduksi_detailgrid$o<?= $Grid->RowIndex ?>_realisasi" id="fproduksi_detailgrid$o<?= $Grid->RowIndex ?>_realisasi" value="<?= HtmlEncode($Grid->realisasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->persentase->Visible) { // persentase ?>
        <td data-name="persentase" <?= $Grid->persentase->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_produksi_detail_persentase" class="form-group">
<input type="<?= $Grid->persentase->getInputTextType() ?>" data-table="produksi_detail" data-field="x_persentase" name="x<?= $Grid->RowIndex ?>_persentase" id="x<?= $Grid->RowIndex ?>_persentase" size="30" placeholder="<?= HtmlEncode($Grid->persentase->getPlaceHolder()) ?>" value="<?= $Grid->persentase->EditValue ?>"<?= $Grid->persentase->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->persentase->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="produksi_detail" data-field="x_persentase" data-hidden="1" name="o<?= $Grid->RowIndex ?>_persentase" id="o<?= $Grid->RowIndex ?>_persentase" value="<?= HtmlEncode($Grid->persentase->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_produksi_detail_persentase" class="form-group">
<input type="<?= $Grid->persentase->getInputTextType() ?>" data-table="produksi_detail" data-field="x_persentase" name="x<?= $Grid->RowIndex ?>_persentase" id="x<?= $Grid->RowIndex ?>_persentase" size="30" placeholder="<?= HtmlEncode($Grid->persentase->getPlaceHolder()) ?>" value="<?= $Grid->persentase->EditValue ?>"<?= $Grid->persentase->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->persentase->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_produksi_detail_persentase">
<span<?= $Grid->persentase->viewAttributes() ?>>
<?= $Grid->persentase->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="produksi_detail" data-field="x_persentase" data-hidden="1" name="fproduksi_detailgrid$x<?= $Grid->RowIndex ?>_persentase" id="fproduksi_detailgrid$x<?= $Grid->RowIndex ?>_persentase" value="<?= HtmlEncode($Grid->persentase->FormValue) ?>">
<input type="hidden" data-table="produksi_detail" data-field="x_persentase" data-hidden="1" name="fproduksi_detailgrid$o<?= $Grid->RowIndex ?>_persentase" id="fproduksi_detailgrid$o<?= $Grid->RowIndex ?>_persentase" value="<?= HtmlEncode($Grid->persentase->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == ROWTYPE_ADD || $Grid->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fproduksi_detailgrid","load"], function () {
    fproduksi_detailgrid.updateLists(<?= $Grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
    }
    } // End delete row checking
    if (!$Grid->isGridAdd() || $Grid->CurrentMode == "copy")
        if (!$Grid->Recordset->EOF) {
            $Grid->Recordset->moveNext();
        }
}
?>
<?php
    if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy" || $Grid->CurrentMode == "edit") {
        $Grid->RowIndex = '$rowindex$';
        $Grid->loadRowValues();

        // Set row properties
        $Grid->resetAttributes();
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_produksi_detail", "data-rowtype" => ROWTYPE_ADD]);
        $Grid->RowAttrs->appendClass("ew-template");
        $Grid->RowType = ROWTYPE_ADD;

        // Render row
        $Grid->renderRow();

        // Render list options
        $Grid->renderListOptions();
        $Grid->StartRowCount = 0;
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowIndex);
?>
    <?php if ($Grid->id->Visible) { // id ?>
        <td data-name="id">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_produksi_detail_id" class="form-group produksi_detail_id"></span>
<?php } else { ?>
<span id="el$rowindex$_produksi_detail_id" class="form-group produksi_detail_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="produksi_detail" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="produksi_detail" data-field="x_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->idproduksi->Visible) { // idproduksi ?>
        <td data-name="idproduksi">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->idproduksi->getSessionValue() != "") { ?>
<span id="el$rowindex$_produksi_detail_idproduksi" class="form-group produksi_detail_idproduksi">
<span<?= $Grid->idproduksi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->idproduksi->getDisplayValue($Grid->idproduksi->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_idproduksi" name="x<?= $Grid->RowIndex ?>_idproduksi" value="<?= HtmlEncode($Grid->idproduksi->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_produksi_detail_idproduksi" class="form-group produksi_detail_idproduksi">
<?php
$onchange = $Grid->idproduksi->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Grid->idproduksi->EditAttrs["onchange"] = "";
?>
<span id="as_x<?= $Grid->RowIndex ?>_idproduksi" class="ew-auto-suggest">
    <input type="<?= $Grid->idproduksi->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_idproduksi" id="sv_x<?= $Grid->RowIndex ?>_idproduksi" value="<?= RemoveHtml($Grid->idproduksi->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Grid->idproduksi->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->idproduksi->getPlaceHolder()) ?>"<?= $Grid->idproduksi->editAttributes() ?>>
</span>
<input type="hidden" is="selection-list" class="form-control" data-table="produksi_detail" data-field="x_idproduksi" data-input="sv_x<?= $Grid->RowIndex ?>_idproduksi" data-value-separator="<?= $Grid->idproduksi->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_idproduksi" id="x<?= $Grid->RowIndex ?>_idproduksi" value="<?= HtmlEncode($Grid->idproduksi->CurrentValue) ?>"<?= $onchange ?>>
<div class="invalid-feedback"><?= $Grid->idproduksi->getErrorMessage() ?></div>
<script>
loadjs.ready(["fproduksi_detailgrid"], function() {
    fproduksi_detailgrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_idproduksi","forceSelect":false}, ew.vars.tables.produksi_detail.fields.idproduksi.autoSuggestOptions));
});
</script>
<?= $Grid->idproduksi->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idproduksi") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_produksi_detail_idproduksi" class="form-group produksi_detail_idproduksi">
<span<?= $Grid->idproduksi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->idproduksi->getDisplayValue($Grid->idproduksi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="produksi_detail" data-field="x_idproduksi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idproduksi" id="x<?= $Grid->RowIndex ?>_idproduksi" value="<?= HtmlEncode($Grid->idproduksi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="produksi_detail" data-field="x_idproduksi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idproduksi" id="o<?= $Grid->RowIndex ?>_idproduksi" value="<?= HtmlEncode($Grid->idproduksi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->idproduk->Visible) { // idproduk ?>
        <td data-name="idproduk">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->idproduk->getSessionValue() != "") { ?>
<span id="el$rowindex$_produksi_detail_idproduk" class="form-group produksi_detail_idproduk">
<span<?= $Grid->idproduk->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->idproduk->getDisplayValue($Grid->idproduk->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_idproduk" name="x<?= $Grid->RowIndex ?>_idproduk" value="<?= HtmlEncode($Grid->idproduk->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_produksi_detail_idproduk" class="form-group produksi_detail_idproduk">
    <select
        id="x<?= $Grid->RowIndex ?>_idproduk"
        name="x<?= $Grid->RowIndex ?>_idproduk"
        class="form-control ew-select<?= $Grid->idproduk->isInvalidClass() ?>"
        data-select2-id="produksi_detail_x<?= $Grid->RowIndex ?>_idproduk"
        data-table="produksi_detail"
        data-field="x_idproduk"
        data-value-separator="<?= $Grid->idproduk->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->idproduk->getPlaceHolder()) ?>"
        <?= $Grid->idproduk->editAttributes() ?>>
        <?= $Grid->idproduk->selectOptionListHtml("x{$Grid->RowIndex}_idproduk") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->idproduk->getErrorMessage() ?></div>
<?= $Grid->idproduk->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idproduk") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='produksi_detail_x<?= $Grid->RowIndex ?>_idproduk']"),
        options = { name: "x<?= $Grid->RowIndex ?>_idproduk", selectId: "produksi_detail_x<?= $Grid->RowIndex ?>_idproduk", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.produksi_detail.fields.idproduk.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_produksi_detail_idproduk" class="form-group produksi_detail_idproduk">
<span<?= $Grid->idproduk->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->idproduk->getDisplayValue($Grid->idproduk->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="produksi_detail" data-field="x_idproduk" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idproduk" id="x<?= $Grid->RowIndex ?>_idproduk" value="<?= HtmlEncode($Grid->idproduk->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="produksi_detail" data-field="x_idproduk" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idproduk" id="o<?= $Grid->RowIndex ?>_idproduk" value="<?= HtmlEncode($Grid->idproduk->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->target->Visible) { // target ?>
        <td data-name="target">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_produksi_detail_target" class="form-group produksi_detail_target">
<input type="<?= $Grid->target->getInputTextType() ?>" data-table="produksi_detail" data-field="x_target" name="x<?= $Grid->RowIndex ?>_target" id="x<?= $Grid->RowIndex ?>_target" size="30" placeholder="<?= HtmlEncode($Grid->target->getPlaceHolder()) ?>" value="<?= $Grid->target->EditValue ?>"<?= $Grid->target->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->target->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_produksi_detail_target" class="form-group produksi_detail_target">
<span<?= $Grid->target->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->target->getDisplayValue($Grid->target->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="produksi_detail" data-field="x_target" data-hidden="1" name="x<?= $Grid->RowIndex ?>_target" id="x<?= $Grid->RowIndex ?>_target" value="<?= HtmlEncode($Grid->target->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="produksi_detail" data-field="x_target" data-hidden="1" name="o<?= $Grid->RowIndex ?>_target" id="o<?= $Grid->RowIndex ?>_target" value="<?= HtmlEncode($Grid->target->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->realisasi->Visible) { // realisasi ?>
        <td data-name="realisasi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_produksi_detail_realisasi" class="form-group produksi_detail_realisasi">
<input type="<?= $Grid->realisasi->getInputTextType() ?>" data-table="produksi_detail" data-field="x_realisasi" name="x<?= $Grid->RowIndex ?>_realisasi" id="x<?= $Grid->RowIndex ?>_realisasi" size="30" placeholder="<?= HtmlEncode($Grid->realisasi->getPlaceHolder()) ?>" value="<?= $Grid->realisasi->EditValue ?>"<?= $Grid->realisasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->realisasi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_produksi_detail_realisasi" class="form-group produksi_detail_realisasi">
<span<?= $Grid->realisasi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->realisasi->getDisplayValue($Grid->realisasi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="produksi_detail" data-field="x_realisasi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_realisasi" id="x<?= $Grid->RowIndex ?>_realisasi" value="<?= HtmlEncode($Grid->realisasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="produksi_detail" data-field="x_realisasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_realisasi" id="o<?= $Grid->RowIndex ?>_realisasi" value="<?= HtmlEncode($Grid->realisasi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->persentase->Visible) { // persentase ?>
        <td data-name="persentase">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_produksi_detail_persentase" class="form-group produksi_detail_persentase">
<input type="<?= $Grid->persentase->getInputTextType() ?>" data-table="produksi_detail" data-field="x_persentase" name="x<?= $Grid->RowIndex ?>_persentase" id="x<?= $Grid->RowIndex ?>_persentase" size="30" placeholder="<?= HtmlEncode($Grid->persentase->getPlaceHolder()) ?>" value="<?= $Grid->persentase->EditValue ?>"<?= $Grid->persentase->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->persentase->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_produksi_detail_persentase" class="form-group produksi_detail_persentase">
<span<?= $Grid->persentase->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->persentase->getDisplayValue($Grid->persentase->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="produksi_detail" data-field="x_persentase" data-hidden="1" name="x<?= $Grid->RowIndex ?>_persentase" id="x<?= $Grid->RowIndex ?>_persentase" value="<?= HtmlEncode($Grid->persentase->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="produksi_detail" data-field="x_persentase" data-hidden="1" name="o<?= $Grid->RowIndex ?>_persentase" id="o<?= $Grid->RowIndex ?>_persentase" value="<?= HtmlEncode($Grid->persentase->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fproduksi_detailgrid","load"], function() {
    fproduksi_detailgrid.updateLists(<?= $Grid->RowIndex ?>);
});
</script>
    </tr>
<?php
    }
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "edit") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fproduksi_detailgrid">
</div><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Grid->Recordset) {
    $Grid->Recordset->close();
}
?>
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $Grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Grid->TotalRecords == 0 && !$Grid->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$Grid->isExport()) { ?>
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
<?php } ?>
