<?php

namespace PHPMaker2021\simtrial;

// Set up and run Grid object
$Grid = Container("PenjualanDetailGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpenjualan_detailgrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fpenjualan_detailgrid = new ew.Form("fpenjualan_detailgrid", "grid");
    fpenjualan_detailgrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "penjualan_detail")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.penjualan_detail)
        ew.vars.tables.penjualan_detail = currentTable;
    fpenjualan_detailgrid.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["idproduk", [fields.idproduk.visible && fields.idproduk.required ? ew.Validators.required(fields.idproduk.caption) : null], fields.idproduk.isInvalid],
        ["jumlah", [fields.jumlah.visible && fields.jumlah.required ? ew.Validators.required(fields.jumlah.caption) : null, ew.Validators.integer], fields.jumlah.isInvalid],
        ["harga", [fields.harga.visible && fields.harga.required ? ew.Validators.required(fields.harga.caption) : null, ew.Validators.float], fields.harga.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpenjualan_detailgrid,
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
    fpenjualan_detailgrid.validate = function () {
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
    fpenjualan_detailgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "idproduk", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "jumlah", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "harga", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fpenjualan_detailgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpenjualan_detailgrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fpenjualan_detailgrid.lists.idproduk = <?= $Grid->idproduk->toClientList($Grid) ?>;
    loadjs.done("fpenjualan_detailgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> penjualan_detail">
<div id="fpenjualan_detailgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_penjualan_detail" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_penjualan_detailgrid" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_penjualan_detail_id" class="penjualan_detail_id"><?= $Grid->renderSort($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->idproduk->Visible) { // idproduk ?>
        <th data-name="idproduk" class="<?= $Grid->idproduk->headerCellClass() ?>"><div id="elh_penjualan_detail_idproduk" class="penjualan_detail_idproduk"><?= $Grid->renderSort($Grid->idproduk) ?></div></th>
<?php } ?>
<?php if ($Grid->jumlah->Visible) { // jumlah ?>
        <th data-name="jumlah" class="<?= $Grid->jumlah->headerCellClass() ?>"><div id="elh_penjualan_detail_jumlah" class="penjualan_detail_jumlah"><?= $Grid->renderSort($Grid->jumlah) ?></div></th>
<?php } ?>
<?php if ($Grid->harga->Visible) { // harga ?>
        <th data-name="harga" class="<?= $Grid->harga->headerCellClass() ?>"><div id="elh_penjualan_detail_harga" class="penjualan_detail_harga"><?= $Grid->renderSort($Grid->harga) ?></div></th>
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_penjualan_detail", "data-rowtype" => $Grid->RowType]);

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
<span id="el<?= $Grid->RowCount ?>_penjualan_detail_id" class="form-group"></span>
<input type="hidden" data-table="penjualan_detail" data-field="x_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penjualan_detail_id" class="form-group">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="penjualan_detail" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penjualan_detail_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penjualan_detail" data-field="x_id" data-hidden="1" name="fpenjualan_detailgrid$x<?= $Grid->RowIndex ?>_id" id="fpenjualan_detailgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="penjualan_detail" data-field="x_id" data-hidden="1" name="fpenjualan_detailgrid$o<?= $Grid->RowIndex ?>_id" id="fpenjualan_detailgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="penjualan_detail" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->idproduk->Visible) { // idproduk ?>
        <td data-name="idproduk" <?= $Grid->idproduk->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->idproduk->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_penjualan_detail_idproduk" class="form-group">
<span<?= $Grid->idproduk->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->idproduk->getDisplayValue($Grid->idproduk->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_idproduk" name="x<?= $Grid->RowIndex ?>_idproduk" value="<?= HtmlEncode($Grid->idproduk->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_penjualan_detail_idproduk" class="form-group">
    <select
        id="x<?= $Grid->RowIndex ?>_idproduk"
        name="x<?= $Grid->RowIndex ?>_idproduk"
        class="form-control ew-select<?= $Grid->idproduk->isInvalidClass() ?>"
        data-select2-id="penjualan_detail_x<?= $Grid->RowIndex ?>_idproduk"
        data-table="penjualan_detail"
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
    var el = document.querySelector("select[data-select2-id='penjualan_detail_x<?= $Grid->RowIndex ?>_idproduk']"),
        options = { name: "x<?= $Grid->RowIndex ?>_idproduk", selectId: "penjualan_detail_x<?= $Grid->RowIndex ?>_idproduk", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.penjualan_detail.fields.idproduk.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="penjualan_detail" data-field="x_idproduk" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idproduk" id="o<?= $Grid->RowIndex ?>_idproduk" value="<?= HtmlEncode($Grid->idproduk->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->idproduk->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_penjualan_detail_idproduk" class="form-group">
<span<?= $Grid->idproduk->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->idproduk->getDisplayValue($Grid->idproduk->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_idproduk" name="x<?= $Grid->RowIndex ?>_idproduk" value="<?= HtmlEncode($Grid->idproduk->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_penjualan_detail_idproduk" class="form-group">
    <select
        id="x<?= $Grid->RowIndex ?>_idproduk"
        name="x<?= $Grid->RowIndex ?>_idproduk"
        class="form-control ew-select<?= $Grid->idproduk->isInvalidClass() ?>"
        data-select2-id="penjualan_detail_x<?= $Grid->RowIndex ?>_idproduk"
        data-table="penjualan_detail"
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
    var el = document.querySelector("select[data-select2-id='penjualan_detail_x<?= $Grid->RowIndex ?>_idproduk']"),
        options = { name: "x<?= $Grid->RowIndex ?>_idproduk", selectId: "penjualan_detail_x<?= $Grid->RowIndex ?>_idproduk", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.penjualan_detail.fields.idproduk.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penjualan_detail_idproduk">
<span<?= $Grid->idproduk->viewAttributes() ?>>
<?= $Grid->idproduk->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penjualan_detail" data-field="x_idproduk" data-hidden="1" name="fpenjualan_detailgrid$x<?= $Grid->RowIndex ?>_idproduk" id="fpenjualan_detailgrid$x<?= $Grid->RowIndex ?>_idproduk" value="<?= HtmlEncode($Grid->idproduk->FormValue) ?>">
<input type="hidden" data-table="penjualan_detail" data-field="x_idproduk" data-hidden="1" name="fpenjualan_detailgrid$o<?= $Grid->RowIndex ?>_idproduk" id="fpenjualan_detailgrid$o<?= $Grid->RowIndex ?>_idproduk" value="<?= HtmlEncode($Grid->idproduk->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->jumlah->Visible) { // jumlah ?>
        <td data-name="jumlah" <?= $Grid->jumlah->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penjualan_detail_jumlah" class="form-group">
<input type="<?= $Grid->jumlah->getInputTextType() ?>" data-table="penjualan_detail" data-field="x_jumlah" name="x<?= $Grid->RowIndex ?>_jumlah" id="x<?= $Grid->RowIndex ?>_jumlah" size="30" placeholder="<?= HtmlEncode($Grid->jumlah->getPlaceHolder()) ?>" value="<?= $Grid->jumlah->EditValue ?>"<?= $Grid->jumlah->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jumlah->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penjualan_detail" data-field="x_jumlah" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jumlah" id="o<?= $Grid->RowIndex ?>_jumlah" value="<?= HtmlEncode($Grid->jumlah->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penjualan_detail_jumlah" class="form-group">
<input type="<?= $Grid->jumlah->getInputTextType() ?>" data-table="penjualan_detail" data-field="x_jumlah" name="x<?= $Grid->RowIndex ?>_jumlah" id="x<?= $Grid->RowIndex ?>_jumlah" size="30" placeholder="<?= HtmlEncode($Grid->jumlah->getPlaceHolder()) ?>" value="<?= $Grid->jumlah->EditValue ?>"<?= $Grid->jumlah->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jumlah->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penjualan_detail_jumlah">
<span<?= $Grid->jumlah->viewAttributes() ?>>
<?= $Grid->jumlah->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penjualan_detail" data-field="x_jumlah" data-hidden="1" name="fpenjualan_detailgrid$x<?= $Grid->RowIndex ?>_jumlah" id="fpenjualan_detailgrid$x<?= $Grid->RowIndex ?>_jumlah" value="<?= HtmlEncode($Grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="penjualan_detail" data-field="x_jumlah" data-hidden="1" name="fpenjualan_detailgrid$o<?= $Grid->RowIndex ?>_jumlah" id="fpenjualan_detailgrid$o<?= $Grid->RowIndex ?>_jumlah" value="<?= HtmlEncode($Grid->jumlah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->harga->Visible) { // harga ?>
        <td data-name="harga" <?= $Grid->harga->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_penjualan_detail_harga" class="form-group">
<input type="<?= $Grid->harga->getInputTextType() ?>" data-table="penjualan_detail" data-field="x_harga" name="x<?= $Grid->RowIndex ?>_harga" id="x<?= $Grid->RowIndex ?>_harga" size="30" placeholder="<?= HtmlEncode($Grid->harga->getPlaceHolder()) ?>" value="<?= $Grid->harga->EditValue ?>"<?= $Grid->harga->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->harga->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="penjualan_detail" data-field="x_harga" data-hidden="1" name="o<?= $Grid->RowIndex ?>_harga" id="o<?= $Grid->RowIndex ?>_harga" value="<?= HtmlEncode($Grid->harga->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_penjualan_detail_harga" class="form-group">
<input type="<?= $Grid->harga->getInputTextType() ?>" data-table="penjualan_detail" data-field="x_harga" name="x<?= $Grid->RowIndex ?>_harga" id="x<?= $Grid->RowIndex ?>_harga" size="30" placeholder="<?= HtmlEncode($Grid->harga->getPlaceHolder()) ?>" value="<?= $Grid->harga->EditValue ?>"<?= $Grid->harga->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->harga->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_penjualan_detail_harga">
<span<?= $Grid->harga->viewAttributes() ?>>
<?= $Grid->harga->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="penjualan_detail" data-field="x_harga" data-hidden="1" name="fpenjualan_detailgrid$x<?= $Grid->RowIndex ?>_harga" id="fpenjualan_detailgrid$x<?= $Grid->RowIndex ?>_harga" value="<?= HtmlEncode($Grid->harga->FormValue) ?>">
<input type="hidden" data-table="penjualan_detail" data-field="x_harga" data-hidden="1" name="fpenjualan_detailgrid$o<?= $Grid->RowIndex ?>_harga" id="fpenjualan_detailgrid$o<?= $Grid->RowIndex ?>_harga" value="<?= HtmlEncode($Grid->harga->OldValue) ?>">
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
loadjs.ready(["fpenjualan_detailgrid","load"], function () {
    fpenjualan_detailgrid.updateLists(<?= $Grid->RowIndex ?>);
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_penjualan_detail", "data-rowtype" => ROWTYPE_ADD]);
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
<span id="el$rowindex$_penjualan_detail_id" class="form-group penjualan_detail_id"></span>
<?php } else { ?>
<span id="el$rowindex$_penjualan_detail_id" class="form-group penjualan_detail_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penjualan_detail" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penjualan_detail" data-field="x_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->idproduk->Visible) { // idproduk ?>
        <td data-name="idproduk">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->idproduk->getSessionValue() != "") { ?>
<span id="el$rowindex$_penjualan_detail_idproduk" class="form-group penjualan_detail_idproduk">
<span<?= $Grid->idproduk->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->idproduk->getDisplayValue($Grid->idproduk->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_idproduk" name="x<?= $Grid->RowIndex ?>_idproduk" value="<?= HtmlEncode($Grid->idproduk->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_penjualan_detail_idproduk" class="form-group penjualan_detail_idproduk">
    <select
        id="x<?= $Grid->RowIndex ?>_idproduk"
        name="x<?= $Grid->RowIndex ?>_idproduk"
        class="form-control ew-select<?= $Grid->idproduk->isInvalidClass() ?>"
        data-select2-id="penjualan_detail_x<?= $Grid->RowIndex ?>_idproduk"
        data-table="penjualan_detail"
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
    var el = document.querySelector("select[data-select2-id='penjualan_detail_x<?= $Grid->RowIndex ?>_idproduk']"),
        options = { name: "x<?= $Grid->RowIndex ?>_idproduk", selectId: "penjualan_detail_x<?= $Grid->RowIndex ?>_idproduk", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.penjualan_detail.fields.idproduk.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_penjualan_detail_idproduk" class="form-group penjualan_detail_idproduk">
<span<?= $Grid->idproduk->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->idproduk->getDisplayValue($Grid->idproduk->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penjualan_detail" data-field="x_idproduk" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idproduk" id="x<?= $Grid->RowIndex ?>_idproduk" value="<?= HtmlEncode($Grid->idproduk->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penjualan_detail" data-field="x_idproduk" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idproduk" id="o<?= $Grid->RowIndex ?>_idproduk" value="<?= HtmlEncode($Grid->idproduk->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->jumlah->Visible) { // jumlah ?>
        <td data-name="jumlah">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penjualan_detail_jumlah" class="form-group penjualan_detail_jumlah">
<input type="<?= $Grid->jumlah->getInputTextType() ?>" data-table="penjualan_detail" data-field="x_jumlah" name="x<?= $Grid->RowIndex ?>_jumlah" id="x<?= $Grid->RowIndex ?>_jumlah" size="30" placeholder="<?= HtmlEncode($Grid->jumlah->getPlaceHolder()) ?>" value="<?= $Grid->jumlah->EditValue ?>"<?= $Grid->jumlah->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jumlah->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penjualan_detail_jumlah" class="form-group penjualan_detail_jumlah">
<span<?= $Grid->jumlah->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->jumlah->getDisplayValue($Grid->jumlah->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penjualan_detail" data-field="x_jumlah" data-hidden="1" name="x<?= $Grid->RowIndex ?>_jumlah" id="x<?= $Grid->RowIndex ?>_jumlah" value="<?= HtmlEncode($Grid->jumlah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penjualan_detail" data-field="x_jumlah" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jumlah" id="o<?= $Grid->RowIndex ?>_jumlah" value="<?= HtmlEncode($Grid->jumlah->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->harga->Visible) { // harga ?>
        <td data-name="harga">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_penjualan_detail_harga" class="form-group penjualan_detail_harga">
<input type="<?= $Grid->harga->getInputTextType() ?>" data-table="penjualan_detail" data-field="x_harga" name="x<?= $Grid->RowIndex ?>_harga" id="x<?= $Grid->RowIndex ?>_harga" size="30" placeholder="<?= HtmlEncode($Grid->harga->getPlaceHolder()) ?>" value="<?= $Grid->harga->EditValue ?>"<?= $Grid->harga->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->harga->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_penjualan_detail_harga" class="form-group penjualan_detail_harga">
<span<?= $Grid->harga->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->harga->getDisplayValue($Grid->harga->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="penjualan_detail" data-field="x_harga" data-hidden="1" name="x<?= $Grid->RowIndex ?>_harga" id="x<?= $Grid->RowIndex ?>_harga" value="<?= HtmlEncode($Grid->harga->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="penjualan_detail" data-field="x_harga" data-hidden="1" name="o<?= $Grid->RowIndex ?>_harga" id="o<?= $Grid->RowIndex ?>_harga" value="<?= HtmlEncode($Grid->harga->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fpenjualan_detailgrid","load"], function() {
    fpenjualan_detailgrid.updateLists(<?= $Grid->RowIndex ?>);
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
<input type="hidden" name="detailpage" value="fpenjualan_detailgrid">
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
    ew.addEventHandlers("penjualan_detail");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
