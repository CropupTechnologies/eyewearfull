<?php
$this->load->view('admin/includes/side_bar');
?>
<div class="page-inner">
    <div class="page-title">
        <h3>Fields List</h3>
        <button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#fieldModal" onclick="prepare_form('fieldModal', 'Field', 'btn-field', add_field, true, null, null);"><i class="fa fa-plus"></i> Add Field</button>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Field List</li>
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
                                    <table id="tbl-fields" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>Field Name</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Field Name</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            foreach ($fields as $field) {
                                                $field_type = $this->Common->get_field_readable_type($field['field_type']);
                                                $del_open = $del_close = '';
                                                $enable_message = 444;
                                                $enable_title = 'Disable';
                                                $btn_class = 'btn-danger';
                                                $enable_class = 'fa-times';
                                                if ($field['enabled'] == 0) {
                                                    $del_open = '<del>';
                                                    $del_close = '</del>';
                                                    $enable_message = 445;
                                                    $enable_title = 'Enable';
                                                    $btn_class = 'btn-success';
                                                    $enable_class = 'fa-check';
                                                }
                                                ?>
                                                <tr>
                                            <input type="hidden" class="tr-field-id"   value="<?= $field['id'] ?>"/>
                                            <input type="hidden" class="tr-name"      value="<?= $field['field_name'] ?>"/>
                                            <input type="hidden" class="tr-type"      value="<?= $field['field_type'] ?>"/>
                                            <input type="hidden" class="tr-min-value"      value="<?= $field['min_value'] ?>"/>
                                            <input type="hidden" class="tr-max-value"      value="<?= $field['max_value'] ?>"/>
                                            <input type="hidden" class="tr-unit"      value="<?= $field['unit'] ?>"/>
                                            <input type="hidden" class="tr-max-characters"      value="<?= $field['max_nof_characters'] ?>"/>
                                            <td><?= $del_open . $field['field_name'] . $del_close ?></td>
                                            <td><?= $del_open . $field_type . $del_close ?>
                                                <?php if ($field['field_type'] == "LIST") { ?>
                                                    <button type="button" class="btn btn-xs btn-primary btn-values" title="Values" onclick="window.location.href = '<?= base_url('admin/field_values/' . $field['id']) ?>'"><i class="fa fa-table"></i></button>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($field['enabled'] == 1) { ?>
                                                    <button type="button" class="btn btn-warning btn-xs" title="Edit" data-toggle="modal" data-target="#fieldModal" onclick="prepare_form('fieldModal', 'Field', 'btn-field', edit_field, false, field_populate, $(this).closest('tr'));"><i class="fa fa-pencil"></i></button>
                                                <?php } else { ?>
                                                    <button type="button" class="btn btn-warning btn-xs" title="Edit" onclick="show_message(45, '<?= $this->config->item(45, 'msg') ?>', null, false, '<?= APP_NAME ?> Update');"><i class="fa fa-pencil"></i></button>
                                                <?php }
                                                ?>
                                                <button type="button" class="btn btn-xs status-toggle <?= $btn_class ?>" title="<?= $enable_title ?>" onclick="show_confirmation(<?= $enable_message ?>, messages[<?= $enable_message ?>], null, 'field', '<?= $field['id'] ?>', on_enable_field_success, on_enable_field_fail);"><i class="fa <?= $enable_class ?>"></i></button>
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
        <!-- Field Modal -->
        <div class="modal fade" id="fieldModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1500;" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header form-modal-header">
                        <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <form action=""  id="field-form" >
                            <input type="hidden" id="field-id" value=""/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-name">Field Name</label>
                                        <input type="text" class="form-control" id="field-name" name="field-name" placeholder="Enter field name" required="true">
                                    </div>
                                </div>                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-type">Type</label>
                                        <select class="form-control" id="field-type" name="field-type" required="true">
                                            <option value="TEXT">Text</option>
                                            <option value="RICH_TEXT">Rich Text</option>
                                            <option value="MEMO">Memo</option>
                                            <option value="INT">Integer</option>
                                            <option value="FLOAT">Float</option>
                                            <option value="BOOLEAN">Boolean</option>
                                            <option value="DATE">Date</option>
                                            <option value="LIST">List</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12"><h4 class="text-center">Number Properties</h4></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="min-value">Minimum Value</label>
                                        <input type="number" min="0" step="0.01" class="form-control" id="min-value" name="min-value" placeholder="Minimum value" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="max-value">Maximum Value</label>
                                        <input type="number" min="0" step="0.01"  class="form-control" id="max-value" name="max-value" placeholder="Maximum Value" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="unit">Unit</label>
                                        <input type="text" class="form-control" id="unit" name="unit" placeholder="Unit of the field" >
                                    </div>
                                </div>
                            </div>                                 
                            <div class="row">
                                <div class="col-md-12"><h4 class="text-center">Text Properties</h4></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="max-characters">Maximum Number of Characters</label>
                                        <input type="number" min="0" class="form-control" id="max-characters" name="max-characters" placeholder="Maximum Number of Characters" >
                                    </div>
                                </div>
                            </div>                                 
                        </form>
                    </div>
                    <div class="modal-footer">
                        <img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="btn-field"></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Field Modal -->



        <script src="<?= base_url('public/') ?>js/admin/fields/fields.js"></script>
        <script>
                                                var messages = [];
                                                messages[43] = '<?= $this->config->item(43, 'msg') ?>';
                                                messages[44] = '<?= $this->config->item(44, 'msg') ?>';
                                                messages[440] = '<?= $this->config->item(440, 'msg') ?>';
                                                messages[441] = '<?= $this->config->item(441, 'msg') ?>';
                                                messages[444] = '<?= $this->config->item(444, 'msg') ?>';
                                                messages[445] = '<?= $this->config->item(445, 'msg') ?>';
                                                $(function () {
                                                    $('#tbl-fields').DataTable({
                                                        columnDefs: [
                                                            {width: 600, targets: 0},
                                                            {width: 200, targets: 1}
                                                        ]
                                                    });
                                                });
                                                const BASEURL = '<?= base_url() ?>';
        </script>
