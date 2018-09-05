<?php
$message = $this->session->flashdata('message');
if ($message != NULL) {
    ?>
    <script>
        $(function () {
            show_message(<?= $message[0] ?>, '<?= $message[1] ?>', null, false, 'Model Field');
        });
    </script>
    <?php
}
?>

<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="col-md-12 back-btn-panel">
            <button type="button" onclick="window.location.href = '<?= base_url('item/models') ?>';" class="btn btn-success btn-back"><i class="fa fa-chevron-left"></i> Back</button>
        </div>
    </div>
</div>

<div class="page-inner">
    <div class="page-title">
        <h3>Model Fields List (Model: <?= $model_data['model_name'] ?> )</h3>
        <button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#fieldModal" ><i class="fa fa-plus"></i> Add Model Field</button>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Model Field List</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <form method="post" action="<?= base_url('item/select_model_field_values') ?>" id="frm-update-field-values">
                        <input type="hidden" name="model-id"   value="<?= $model_data['id'] ?>"/>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                            <thead>
                                                <tr>
                                                    <th>Field Name</th>
                                                    <th>Value</th>
                                                    <th>Display Order</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Field Name</th>
                                                    <th>Value</th>
                                                    <th>Display Order</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                if ($model_fields != FALSE && count($model_fields) > 0) {
                                                    foreach ($model_fields as $field) {
                                                        $del_open = $del_close = '';
                                                        $enable_message = 444;
                                                        $enable_title = 'Disable';
                                                        $btn_class = 'btn-danger';
                                                        $enable_class = 'fa-times';
                                                        $select_disabled = '';
                                                        $select_required = 'required="required"';
                                                        if ($field['enabled'] == 0) {
                                                            $select_disabled = 'readonly="readonly"';
                                                            $select_required = '';
                                                            $del_open = '<del>';
                                                            $del_close = '</del>';
                                                            $enable_message = 445;
                                                            $enable_title = 'Enable';
                                                            $btn_class = 'btn-success';
                                                            $enable_class = 'fa-check';
                                                        }
                                                        ?>
                                                        <tr>
                                                    <input type="hidden" name="model-field-id[]"   value="<?= $field['id'] ?>"/>
                                                    <input type="hidden" name="model-field-enabled[]"   value="<?= $field['enabled'] ?>"/>
                                                    <td><?= $del_open . $field['field_name'] . $del_close ?></td>
                                                    <td>
                                                        <select class="form-control" name="model-field-value[]" <?= $select_disabled . ' ' . $select_required ?> >
                                                            <option value="">Select a value...</option>
                                                            <?php
                                                            foreach ($field['values'] as $val) {
                                                                $option_selelcted = '';
                                                                if ($field['value_id'] == $val['id']) {
                                                                    $option_selelcted = 'selected';
                                                                }
                                                                ?>
                                                                <option value="<?= $val['id'] ?>" <?= $option_selelcted ?>><?= $val['value'] ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-xs status-toggle <?= $btn_class ?>" title="<?= $enable_title ?>" onclick="show_confirmation(<?= $enable_message ?>, messages[<?= $enable_message ?>], null, 'model_field', '<?= $field['id'] ?>', on_enable_field_success, on_enable_field_fail);"><i class="fa <?= $enable_class ?>"></i></button>
                                                    </td>

                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>                          
                                            </tbody>
                                        </table>  
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-success btn-addon m-b-sm pull-right"  id="btn-update-values"> Update Values</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- Row -->
        <!-- Brand Modal -->
        <div class="modal fade" id="fieldModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1500;" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?= base_url('item/add_model_field') ?>" method="post"  id="model-field-form" >
                        <div class="modal-header form-modal-header">
                            <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add Model Filed</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="model-id" id="model-id" value="<?= $model_data['id'] ?>"/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="field-id">Field Name</label>
                                        <select id="field-id" name="field-id" class="form-control" required="required">
                                            <option value="">Select Field...</option>
                                            <?php
                                            if ($list_fields != FALSE && count($list_fields) > 0) {
                                                foreach ($list_fields as $list_field) {
                                                    $added = FALSE;
                                                    if ($model_fields != FALSE && count($model_fields) > 0) {
                                                        foreach ($model_fields as $mf) {
                                                            if ($list_field['id'] == $mf['field_id']) {
                                                                $added = TRUE;
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    if (!$added) {
                                                        ?>
                                                        <option value="<?= $list_field['id'] ?>"><?= $list_field['field_name'] ?></option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>                                 
                        </div>
                        <div class="modal-footer">
                            <!--<img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>"/>-->
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="btn-model-field">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End: Brand Modal -->


        <script src="<?= base_url('public/') ?>js/admin/fields/model_fields.js"></script>
        <script>
                                                            var messages = [];
                                                            messages[43] = '<?= $this->config->item(43, 'msg') ?>';
                                                            messages[44] = '<?= $this->config->item(44, 'msg') ?>';
                                                            messages[440] = '<?= $this->config->item(440, 'msg') ?>';
                                                            messages[441] = '<?= $this->config->item(441, 'msg') ?>';
                                                            messages[444] = '<?= $this->config->item(444, 'msg') ?>';
                                                            messages[445] = '<?= $this->config->item(445, 'msg') ?>';
                                                            $(function () {
                                                                brandTable = $('#example').DataTable({
                                                                    "ordering": false,
                                                                    "columnDefs": [
                                                                        {width: 400, targets: 0},
                                                                        {width: 350, targets: 1}
                                                                    ]
                                                                });
                                                            });
                                                            const BASEURL = '<?= base_url() ?>';
        </script>
