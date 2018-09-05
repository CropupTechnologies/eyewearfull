<?php
$this->load->view('admin/includes/side_bar');
?>
<div class="page-inner">
    <div class="page-title">
        <h3>Model Fields</h3>
        <button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#attributeModal" onclick="prepare_form('attributeModal', 'Field', 'btn-attribute', add_attribute, true, null, null);"><i class="fa fa-plus"></i> Add Field</button>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Model Fields</li>
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

                                                <th>Field Name</th>
                                                <th>Data Type</th>
                                                <th>Unit</th>
                                                <th>Display Order</th>
                                                <th>Min Value</th>
                                                <th>Max Value</th>
                                                <th>Is Mandatory</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Field Name</th>
                                                <th>Data Type</th>
                                                <th>Unit</th>
                                                <th>Display Order</th>
                                                <th>Min Value</th>
                                                <th>Max Value</th>
                                                <th>Is Mandatory</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            foreach ($model_fields as $att) {
                                                $del_open = $del_close = '';
                                                $enable_message = 444;
                                                $enable_title = 'Disable';
                                                $btn_class = 'btn-danger';
                                                $enable_class = 'fa-times';
                                                if ($att['enabled'] == 0) {
                                                    $del_open = '<del>';
                                                    $del_close = '</del>';
                                                    $enable_message = 445;
                                                    $enable_title = 'Enable';
                                                    $btn_class = 'btn-success';
                                                    $enable_class = 'fa-check';
                                                }
                                                ?>
                                                <tr>
                                            <input type="hidden" class="tr-attr-id"   value="<?= $att['id'] ?>"/>
                                            <input type="hidden" class="tr-name"      value="<?= $att['field_name'] ?>"/>
                                            <input type="hidden" class="tr-data-type" value="<?= $att['data_type'] ?>"/>
                                            <input type="hidden" class="tr-unit"      value="<?= $att['unit'] ?>"/>
                                            <input type="hidden" class="tr-order-id"  value="<?= $att['display_order'] ?>"/>
                                            <input type="hidden" class="tr-min"       value="<?= $att['min_value'] ?>"/>
                                            <input type="hidden" class="tr-max"       value="<?= $att['max_value'] ?>"/>
                                            <input type="hidden" class="tr-mandatory" value="<?= $att['is_mandatory'] ?>"/>
                                            <td><?= $del_open . $att['field_name'] . $del_close ?></td>
                                            <td><?= $del_open . $att['data_type'] . $del_close ?></td>
                                            <td><?= $del_open . $att['unit'] . $del_close ?></td>
                                            <td><?= $del_open . $att['display_order'] . $del_close ?></td>
                                            <td><?= $del_open . $att['min_value'] . $del_close ?></td>
                                            <td><?= $del_open . $att['max_value'] . $del_close ?></td>
                                            <td><?= $del_open . (($att['is_mandatory'] == 1) ? 'YES' : 'NO') . $del_close ?></td>
                                            <td>
                                                <!--<button type="button" class="btn btn-xs btn-info" title="Values" onclick="window.location.href = '<?= base_url('item/field_values/' . $att['id']) ?>'"><i class="glyphicon glyphicon-option-horizontal"></i></button>-->
                                                <?php if ($att['enabled'] == 1) { ?>
                                                    <button type="button" class="btn btn-xs btn-info add-value" title="Add Model Field Values"><i class="glyphicon glyphicon-option-horizontal"></i></button>
                                                    <button type="button" class="btn btn-warning btn-xs" title="Edit" data-toggle="modal" data-target="#attributeModal" onclick="prepare_form('attributeModal', 'Field', 'btn-attribute', edit_attribute, false, attribute_populate, $(this).closest('tr'));"><i class="fa fa-pencil"></i></button>
                                                <?php } else { ?>
                                                    <button type="button" class="btn btn-warning btn-xs" title="Add Model Field Values" onclick="show_message(46, '<?= $this->config->item(46, 'msg') ?>', null, false, '<?= APP_NAME ?> Update');"><i class="glyphicon glyphicon-option-horizontal"></i></button>
                                                    <button type="button" class="btn btn-warning btn-xs" title="Edit" onclick="show_message(45, '<?= $this->config->item(45, 'msg') ?>', null, false, '<?= APP_NAME ?> Update');"><i class="fa fa-pencil"></i></button>
                                                <?php }
                                                ?>
                                                <button type="button" class="btn btn-xs status-toggle <?= $btn_class ?>" title="<?= $enable_title ?>" onclick="show_confirmation(<?= $enable_message ?>, messages[<?= $enable_message ?>], null, 'model_field', '<?= $att['id'] ?>', on_enable_attr_success, on_enable_attr_fail);"><i class="fa <?= $enable_class ?>"></i></button>
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
        <div class="modal fade" id="attributeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1500;" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header form-modal-header">
                        <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <form action=""  id="attribute-form" >
                            <input type="hidden" id="attr-id" value=""/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sub-field-name">Field Name</label>
                                        <input type="text" class="form-control" id="sub-field-name" name="sub-field-name" placeholder="Enter sub field name" required="true">
                                    </div>
                                </div>                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="data-type">Data Type</label>
                                        <select class="form-control" id="data-type" name="data-type" required="true">
                                            <option value="TEXT">Text</option>
                                            <option value="NUMBER">Number</option>
                                            <option value="BOOLEAN">Boolean</option>
                                            <option value="FLOAT">Float</option>
                                            <option value="IMAGE">Image</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="unit">Unit</label>
                                        <input type="text" class="form-control" id="unit" name="unit" placeholder="Unit of the field" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="order-id">Display Order</label>
                                        <input type="number" step="1" min="0" class="form-control" value="0" id="order-id" name="order-id" placeholder="Display Order" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="min-value">Minimum Value</label>
                                        <input type="text" class="form-control" id="min-value" name="min-value" placeholder="Minimum value" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="max-value">Maximum Value</label>
                                        <input type="text" class="form-control" id="max-value" name="max-value" placeholder="Maximum Value" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="data-type">Is Mandatory Field</label>
                                        <select class="form-control" id="is-mandatory" name="is-mandatory" required="true">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>                                 
                        </form>
                    </div>

                    <div class="modal-footer">
                        <img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="btn-producr"></button>
                    </div>

                </div>

            </div>
        </div>
        <!-- End: Brand Modal -->


        <script src="<?= base_url('public/') ?>js/admin/model_fields.js"></script>
        <script>
                                                    var messages = [];
                                                    messages[43] = '<?= $this->config->item(43, 'msg') ?>';
                                                    messages[44] = '<?= $this->config->item(44, 'msg') ?>';
                                                    messages[440] = '<?= $this->config->item(440, 'msg') ?>';
                                                    messages[441] = '<?= $this->config->item(441, 'msg') ?>';
                                                    messages[444] = '<?= $this->config->item(444, 'msg') ?>';
                                                    messages[445] = '<?= $this->config->item(445, 'msg') ?>';
                                                    Dropzone.autoDiscover = false;
                                                    var myDropzone;
                                                    var bradTable;
                                                    var parsley_attribute_form;
                                                    $(function () {
                                                        parsley_attribute_form = $('#attribute-form');
                                                        parsley_attribute_form.parsley();
                                                        brandTable = $('#example').DataTable({});
                                                    });
                                                    const BASEURL = '<?= base_url() ?>';

                                                    $('.add-value').click(function () {
                                                        var model_field = $(this).closest('tr').find('.tr-attr-id').val();
                                                        window.location.href = '<?= base_url() ?>item/model_fields_value?model_field=' + model_field;
                                                    });
        </script>
