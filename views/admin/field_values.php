<?php
$this->load->view('admin/includes/side_bar');
?>
<div class="page-inner">
    <div class="page-title">
        <h3>Field Values</h3>
        <?php
        if ($attribute_data['data_type'] != 'BOOLEAN') {
            ?>
            <button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#valueModal" onclick="prepare_form('valueModal', 'Field Value', 'value-form', '<?= base_url('item/add_attribute_value') ?>', 'btn-value', add_value, true, null, null);"><i class="fa fa-plus"></i> Add Field Value</button>
            <?php
        }
        ?>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li><a href="<?= base_url('admin/metadata') ?>">Meta Data</a></li>
                <li class="active">Field Values</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h4>Field Values</h4>
                                <?php
                                if ($attribute_data['data_type'] != 'BOOLEAN') {
                                    ?>
                                    <div class="table-responsive">
                                        <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                            <thead>
                                                <tr>
                                                    <th>Display Order</th>
                                                    <th>Value</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Display Order</th>
                                                    <th>Value</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                foreach ($attribute_data['values'] as $index => $val) {
                                                    $del_open = $del_close = '';
                                                    $enable_message = 450;
                                                    $enable_title = 'Disable';
                                                    $btn_class = 'btn-danger';
                                                    $enable_class = 'fa-times';
                                                    if ($val['enabled'] == 0) {
                                                        $del_open = '<del>';
                                                        $del_close = '</del>';
                                                        $enable_message = 451;
                                                        $enable_title = 'Enable';
                                                        $btn_class = 'btn-success';
                                                        $enable_class = 'fa-check';
                                                    }
                                                    ?>
                                                    <tr>
                                                <input type="hidden" class="tr-value-id"   value="<?= $val['id'] ?>"/>
                                                <input type="hidden" class="tr-value"      value="<?= $val['value'] ?>"/>
                                                <input type="hidden" class="tr-display-order" value="<?= $val['display_order'] ?>"/>
                                                <td><?= $del_open . $val['display_order'] . $del_close ?></td>
                                                <td><?= $del_open . $val['value'] . $del_close ?></td>
                                                <td>
                                                    <?php if ($val['enabled'] == 1) { ?>
                                                        <button type="button" class="btn btn-warning btn-xs" title="Edit" data-toggle="modal" data-target="#valueModal" onclick="prepare_form('valueModal', 'Field Value', 'value-form', '<?= base_url('item/edit_attribute_value/' . $val['id']) ?>', 'btn-value', edit_value, false, value_populate, $(this).closest('tr'));"><i class="fa fa-pencil"></i></button>
                                                    <?php } else { ?>
                                                        <button type="button" class="btn btn-warning btn-xs" title="Edit" onclick="show_message(45, '<?= $this->config->item(45, 'msg') ?>', null, false, '<?= APP_NAME ?> Update');"><i class="fa fa-pencil"></i></button>
                                                    <?php }
                                                    ?>
                                                    <button type="button" class="btn btn-xs status-toggle <?= $btn_class ?>" title="<?= $enable_title ?>" onclick="show_confirmation(<?= $enable_message ?>, messages[<?= $enable_message ?>], null, 'field_value', '<?= $val['id'] ?>', on_enable_val_success, on_enable_val_fail);"><i class="fa <?= $enable_class ?>"></i></button>
                                                </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>                                            

                                            </tbody>
                                        </table>  
                                    </div>
                                    <?php
                                }else{
                                    echo '<p>'.$this->config->item(452, 'msg').'</p>';
                                }
                                ?>
                            </div>
                            <div class="col-md-4">
                                <table class="table table-bordered">
                                    <tr><th colspan="2" class="text-center">Meta Data Information</th></tr>
                                    <tr><td><dt>Field Name</dt></td><td><?= $attribute_data['field_name'] ?></td></tr>
                                    <tr><td><dt>System Entity</dt></td><td><?= $attribute_data['system_entity'] ?></td></tr>
                                    <tr><td><dt>Data Type</dt></td><td><?= $attribute_data['data_type'] ?></td></tr>
                                    <tr><td><dt>Unit</dt></td><td><?= $attribute_data['unit'] ?></td></tr>
                                    <tr><td><dt>Is Mandatory Field</dt></td><td><?= ($attribute_data['is_mandatory'] == 1) ? 'Yes' : 'No' ?></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
        <!-- Brand Modal -->
        <div class="modal fade" id="valueModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1500;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header form-modal-header">
                        <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <form action=""  id="value-form" >
                            <input type="hidden" id="attr-id" value="<?= $attribute_data['id'] ?>"/>
                            <input type="hidden" id="value-id" value=""/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="display-order">Display Order</label>
                                        <input type="number" min="0" step="1" class="form-control" id="display-order" name="display-order" value="0" placeholder="Display Order"  required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        //add vaidation according to data type
                                        $type = 'text';
                                        $step = $min = '';
                                        switch ($attribute_data['data_type']) {
                                            case 'TEXT':
                                                break;
                                            case 'NUMBER':
                                                $type = 'number';
                                                $min = 'min="0"';
                                                $step = 'step="1"';
                                                break;
                                            case 'FLOAT':
                                                $type = 'number';
                                                $min = 'min="0"';
                                                $step = 'step="0.001"';
                                                break;
                                        }
                                        ?>
                                        <label for="attribute-value">Value</label>
                                        <input type="<?= $type ?>" <?= $step.' '.$min ?> class="form-control" id="attribute-value" name="attribute-value" placeholder="Enter field value" required="true">
                                    </div>
                                </div>
                            </div>                                 
                        </form>
                    </div>
                    <div class="modal-footer">
                        <img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="btn-value"></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Brand Modal -->


        <script src="<?= base_url('public/') ?>js/admin/field_values.js"></script>
        <script>
                                                    var messages = [];
                                                    messages[9] = '<?= $this->config->item(9, 'msg') ?>';
                                                    messages[43] = '<?= $this->config->item(43, 'msg') ?>';
                                                    messages[44] = '<?= $this->config->item(44, 'msg') ?>';
                                                    messages[446] = '<?= $this->config->item(446, 'msg') ?>';
                                                    messages[447] = '<?= $this->config->item(447, 'msg') ?>';
                                                    messages[450] = '<?= $this->config->item(450, 'msg') ?>';
                                                    messages[451] = '<?= $this->config->item(451, 'msg') ?>';
                                                    Dropzone.autoDiscover = false;
                                                    var myDropzone;
                                                    var bradTable;
                                                    var parsley_brand_form;
                                                    $(function () {
                                                        parsley_category_form = $('#category-form');
                                                        parsley_category_form.parsley();
                                                        brandTable = $('#example').DataTable({});
                                                    });
                                                    const BASEURL = '<?= base_url() ?>';
        </script>
