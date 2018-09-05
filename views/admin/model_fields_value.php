<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="col-md-12 back-btn-panel">
            <button type="button" class="btn btn-success btn-back"><i class="fa fa-chevron-left"></i> Back</button>
        </div>
    </div>
</div>
<?php
$model_hidden_field_id = $this->input->get('model_field');
?>

<input type="hidden" class="model_field_id" value="<?= $model_hidden_field_id ?>">
<div class="page-inner">
    <div class="page-title">
        <h3>Model Fields Values</h3>
        <button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#model-field-valuesModal" onclick="prepare_form('model-field-valuesModal', 'Model Field Value', 'btn-model-field-values', add_model_field_values, true, null, null);"><i class="fa fa-plus"></i> Add Value</button>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Model Fields Values</li>
                <li class="active"><?= $model_field[0]['field_name']; ?></li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>

                                                <th>Model Field Name</th>
                                                <th style="text-align:center;">Value</th>
                                                <th style="text-align:center;">Display Order</th>
                                                <th style="text-align:center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Model Field Name</th>
                                                <th>Value</th>
                                                <th>Display Order</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            foreach ($field_values as $values) {
                                                $del_open = $del_close = '';
                                                $enable_message = 564;
                                                $enable_title = 'Disable';
                                                $btn_class = 'btn-danger';
                                                $enable_class = 'fa-times';
                                                if ($values['enabled'] == 0) {
                                                    $del_open = '<del>';
                                                    $del_close = '</del>';
                                                    $enable_message = 564;
                                                    $enable_title = 'Enable';
                                                    $btn_class = 'btn-success';
                                                    $enable_class = 'fa-check';
                                                } else {
                                                    $enable_message = 565;
                                                }
                                                ?>
                                                <tr>
                                            <input type="hidden" class="tr-attr-id"   value="<?= $values['id'] ?>"/>
                                            <input type="hidden" class="tr-name"      value="<?= $values['field_name'] ?>"/>
                                            <input type="hidden" class="tr-order-id"  value="<?= $values['display_order'] ?>"/>
                                            <input type="hidden" class="tr-value"       value="<?= $values['value'] ?>"/>
                                            <input type="hidden" class="tr-model_field_id"       value="<?= $values['model_field_id'] ?>"/>

                                            <td ><?= $del_open . $values['field_name'] . $del_close ?></td>
                                            <td style="text-align:center;"><?= $del_open . $values['value'] . $del_close ?></td>
                                            <td style="text-align:center;"><?= $del_open . $values['display_order'] . $del_close ?></td>
                                            <td style="text-align:center;">
    <!--<button type="button" class="btn btn-xs btn-info" title="Values" onclick="window.location.href = '<?= base_url('item/field_values/' . $values['id']) ?>'"><i class="glyphicon glyphicon-option-horizontal"></i></button>-->
                                                <?php if ($values['enabled'] == 1) { ?>

                                                    <button type="button" class="btn btn-warning btn-xs" title="Edit" data-toggle="modal" data-target="#model-field-valuesModal" onclick="prepare_form('model-field-valuesModal', 'Model Field Value', 'btn-model-field-values', edit_model_field_values, false, model_field_values_populate, $(this).closest('tr'));"><i class="fa fa-pencil"></i></button>
                                                <?php } else { ?>

                                                    <button type="button" class="btn btn-warning btn-xs" title="Edit" onclick="show_message(45, '<?= $this->config->item(45, 'msg') ?>', null, false, '<?= APP_NAME ?> Update');"><i class="fa fa-pencil"></i></button>
                                                <?php }
                                                ?>
                                                <button type="button" class="btn btn-xs status-toggle <?= $btn_class ?>" title="<?= $enable_title ?>" onclick="show_confirmation(<?= $enable_message ?>, messages[<?= $enable_message ?>], null, 'model_field_value', '<?= $values['id'] ?>', on_enable_model_field_value_success, on_enable_model_field_value_fail);"><i class="fa <?= $enable_class ?>"></i></button>
                                            </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>                                            
                                        </tbody>
                                    </table>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
        <!-- Brand Modal -->
        <div class="modal fade" id="model-field-valuesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1500;" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header form-modal-header">
                        <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <form action=""  id="model-field-values-form" >
                            <input type="hidden" id="attr-id" value=""/>
                            <input type="hidden" id="model-field-hidden-id" value=""/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="unit">Value</label>
                                        <input type="text" class="form-control" id="value" name="value" placeholder="Unit of the field" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="order-id">Display Order</label>
                                        <input type="number" step="1" min="0" class="form-control" value="0" id="order-id" name="order-id" placeholder="Display Order" >
                                    </div>
                                </div>

                            </div>                                 
                        </form>
                    </div>

                    <div class="modal-footer">
                        <img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="btn-model-field-values"></button>
                    </div>

                </div>

            </div>
        </div>
        <!-- End: Brand Modal -->


        <script src="<?= base_url('public/') ?>js/admin/model_field_value.js"></script>
        <script>
                                                var messages = [];
                                                messages[43] = '<?= $this->config->item(43, 'msg') ?>';
                                                messages[44] = '<?= $this->config->item(44, 'msg') ?>';
                                                messages[560] = '<?= $this->config->item(560, 'msg') ?>';
                                                messages[561] = '<?= $this->config->item(560, 'msg') ?>';
                                                messages[562] = '<?= $this->config->item(562, 'msg') ?>';
                                                messages[563] = '<?= $this->config->item(563, 'msg') ?>';
                                                messages[564] = '<?= $this->config->item(564, 'msg') ?>';
                                                messages[565] = '<?= $this->config->item(565, 'msg') ?>';
                                                Dropzone.autoDiscover = false;
                                                var myDropzone;
                                                var bradTable;
                                                var parsley_model_field_values;
                                                $(function () {
                                                    parsley_model_field_values = $('#model-field-values-form');
                                                    parsley_model_field_values.parsley();
                                                    brandTable = $('#example').DataTable({});
                                                });
                                                const BASEURL = '<?= base_url() ?>';

                                                $('.add-value').click(function () {
                                                    var model_field = $(this).closest('tr').find('.tr-attr-id').val();
                                                    window.location.href = '<?= base_url() ?>item/model_fields_value?model_field=' + model_field;
                                                });
                                                $('.btn-back').click(function () {
                                                    window.location.href = '<?= base_url() ?>item/model_fields';
                                                });
        </script>
