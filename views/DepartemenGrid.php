<?php

namespace PHPMaker2021\simtrial;

// Set up and run Grid object
$Grid = Container("DepartemenGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fdepartemengrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fdepartemengrid = new ew.Form("fdepartemengrid", "grid");
    fdepartemengrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "departemen")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.departemen)
        ew.vars.tables.departemen = currentTable;
    fdepartemengrid.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["nama", [fields.nama.visible && fields.nama.required ? ew.Validators.required(fields.nama.caption) : null], fields.nama.isInvalid],
        ["deskripsi", [fields.deskripsi.visible && fields.deskripsi.required ? ew.Validators.required(fields.deskripsi.caption) : null], fields.deskripsi.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fdepartemengrid,
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
    fdepartemengrid.validate = function () {
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
    fdepartemengrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "nama", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "deskripsi", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fdepartemengrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdepartemengrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fdepartemengrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> departemen">
<div id="fdepartemengrid" class="ew-form ew-list-form form-inline">
<div id="gmp_departemen" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_departemengrid" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_departemen_id" class="departemen_id"><?= $Grid->renderSort($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->nama->Visible) { // nama ?>
        <th data-name="nama" class="<?= $Grid->nama->headerCellClass() ?>"><div id="elh_departemen_nama" class="departemen_nama"><?= $Grid->renderSort($Grid->nama) ?></div></th>
<?php } ?>
<?php if ($Grid->deskripsi->Visible) { // deskripsi ?>
        <th data-name="deskripsi" class="<?= $Grid->deskripsi->headerCellClass() ?>"><div id="elh_departemen_deskripsi" class="departemen_deskripsi"><?= $Grid->renderSort($Grid->deskripsi) ?></div></th>
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_departemen", "data-rowtype" => $Grid->RowType]);

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
<span id="el<?= $Grid->RowCount ?>_departemen_id" class="form-group"></span>
<input type="hidden" data-table="departemen" data-field="x_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_departemen_id" class="form-group">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="departemen" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_departemen_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="departemen" data-field="x_id" data-hidden="1" name="fdepartemengrid$x<?= $Grid->RowIndex ?>_id" id="fdepartemengrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="departemen" data-field="x_id" data-hidden="1" name="fdepartemengrid$o<?= $Grid->RowIndex ?>_id" id="fdepartemengrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="departemen" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->nama->Visible) { // nama ?>
        <td data-name="nama" <?= $Grid->nama->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_departemen_nama" class="form-group">
<input type="<?= $Grid->nama->getInputTextType() ?>" data-table="departemen" data-field="x_nama" name="x<?= $Grid->RowIndex ?>_nama" id="x<?= $Grid->RowIndex ?>_nama" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->nama->getPlaceHolder()) ?>" value="<?= $Grid->nama->EditValue ?>"<?= $Grid->nama->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nama->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="departemen" data-field="x_nama" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nama" id="o<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_departemen_nama" class="form-group">
<input type="<?= $Grid->nama->getInputTextType() ?>" data-table="departemen" data-field="x_nama" name="x<?= $Grid->RowIndex ?>_nama" id="x<?= $Grid->RowIndex ?>_nama" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->nama->getPlaceHolder()) ?>" value="<?= $Grid->nama->EditValue ?>"<?= $Grid->nama->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nama->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_departemen_nama">
<span<?= $Grid->nama->viewAttributes() ?>>
<?= $Grid->nama->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="departemen" data-field="x_nama" data-hidden="1" name="fdepartemengrid$x<?= $Grid->RowIndex ?>_nama" id="fdepartemengrid$x<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->FormValue) ?>">
<input type="hidden" data-table="departemen" data-field="x_nama" data-hidden="1" name="fdepartemengrid$o<?= $Grid->RowIndex ?>_nama" id="fdepartemengrid$o<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->deskripsi->Visible) { // deskripsi ?>
        <td data-name="deskripsi" <?= $Grid->deskripsi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_departemen_deskripsi" class="form-group">
<textarea data-table="departemen" data-field="x_deskripsi" name="x<?= $Grid->RowIndex ?>_deskripsi" id="x<?= $Grid->RowIndex ?>_deskripsi" cols="5" rows="4" placeholder="<?= HtmlEncode($Grid->deskripsi->getPlaceHolder()) ?>"<?= $Grid->deskripsi->editAttributes() ?>><?= $Grid->deskripsi->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->deskripsi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="departemen" data-field="x_deskripsi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_deskripsi" id="o<?= $Grid->RowIndex ?>_deskripsi" value="<?= HtmlEncode($Grid->deskripsi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_departemen_deskripsi" class="form-group">
<textarea data-table="departemen" data-field="x_deskripsi" name="x<?= $Grid->RowIndex ?>_deskripsi" id="x<?= $Grid->RowIndex ?>_deskripsi" cols="5" rows="4" placeholder="<?= HtmlEncode($Grid->deskripsi->getPlaceHolder()) ?>"<?= $Grid->deskripsi->editAttributes() ?>><?= $Grid->deskripsi->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->deskripsi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_departemen_deskripsi">
<span<?= $Grid->deskripsi->viewAttributes() ?>>
<?= $Grid->deskripsi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="departemen" data-field="x_deskripsi" data-hidden="1" name="fdepartemengrid$x<?= $Grid->RowIndex ?>_deskripsi" id="fdepartemengrid$x<?= $Grid->RowIndex ?>_deskripsi" value="<?= HtmlEncode($Grid->deskripsi->FormValue) ?>">
<input type="hidden" data-table="departemen" data-field="x_deskripsi" data-hidden="1" name="fdepartemengrid$o<?= $Grid->RowIndex ?>_deskripsi" id="fdepartemengrid$o<?= $Grid->RowIndex ?>_deskripsi" value="<?= HtmlEncode($Grid->deskripsi->OldValue) ?>">
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
loadjs.ready(["fdepartemengrid","load"], function () {
    fdepartemengrid.updateLists(<?= $Grid->RowIndex ?>);
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_departemen", "data-rowtype" => ROWTYPE_ADD]);
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
<span id="el$rowindex$_departemen_id" class="form-group departemen_id"></span>
<?php } else { ?>
<span id="el$rowindex$_departemen_id" class="form-group departemen_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="departemen" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="departemen" data-field="x_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->nama->Visible) { // nama ?>
        <td data-name="nama">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_departemen_nama" class="form-group departemen_nama">
<input type="<?= $Grid->nama->getInputTextType() ?>" data-table="departemen" data-field="x_nama" name="x<?= $Grid->RowIndex ?>_nama" id="x<?= $Grid->RowIndex ?>_nama" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->nama->getPlaceHolder()) ?>" value="<?= $Grid->nama->EditValue ?>"<?= $Grid->nama->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nama->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_departemen_nama" class="form-group departemen_nama">
<span<?= $Grid->nama->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->nama->getDisplayValue($Grid->nama->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="departemen" data-field="x_nama" data-hidden="1" name="x<?= $Grid->RowIndex ?>_nama" id="x<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="departemen" data-field="x_nama" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nama" id="o<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->deskripsi->Visible) { // deskripsi ?>
        <td data-name="deskripsi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_departemen_deskripsi" class="form-group departemen_deskripsi">
<textarea data-table="departemen" data-field="x_deskripsi" name="x<?= $Grid->RowIndex ?>_deskripsi" id="x<?= $Grid->RowIndex ?>_deskripsi" cols="5" rows="4" placeholder="<?= HtmlEncode($Grid->deskripsi->getPlaceHolder()) ?>"<?= $Grid->deskripsi->editAttributes() ?>><?= $Grid->deskripsi->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->deskripsi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_departemen_deskripsi" class="form-group departemen_deskripsi">
<span<?= $Grid->deskripsi->viewAttributes() ?>>
<?= $Grid->deskripsi->ViewValue ?></span>
</span>
<input type="hidden" data-table="departemen" data-field="x_deskripsi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_deskripsi" id="x<?= $Grid->RowIndex ?>_deskripsi" value="<?= HtmlEncode($Grid->deskripsi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="departemen" data-field="x_deskripsi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_deskripsi" id="o<?= $Grid->RowIndex ?>_deskripsi" value="<?= HtmlEncode($Grid->deskripsi->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fdepartemengrid","load"], function() {
    fdepartemengrid.updateLists(<?= $Grid->RowIndex ?>);
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
<input type="hidden" name="detailpage" value="fdepartemengrid">
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
    ew.addEventHandlers("departemen");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
