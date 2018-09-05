<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="col-md-12 back-btn-panel">
            <button type="button" onclick="window.history.back();" class="btn btn-success btn-back"><i class="fa fa-chevron-left"></i> Back</button>
        </div>
    </div>
</div>

<div class="page-inner">
    <div class="page-title">
        <h3>Field Values (Field: <?= $field_data['field_name'] ?>)</h3>
        <button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#valuesModal" onclick="prepare_form('valuesModal', 'Value', 'btn-values', add_field_value, true, null, null);"><i class="fa fa-plus"></i> Add Value</button>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
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
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="tbl-values" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>Value</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                            
                                            <?php
                                            if ($field_values != FALSE) {
                                                foreach ($field_values as $fv) {
                                                    $del_open = $del_close = '';
                                                    $enable_message = 450;
                                                    $enable_title = 'Disable';
                                                    $btn_class = 'btn-danger';
                                                    $enable_class = 'fa-times';
                                                    if ($fv['enabled'] == 0) {
                                                        $del_open = '<del>';
                                                        $del_close = '</del>';
                                                        $enable_message = 451;
                                                        $enable_title = 'Enable';
                                                        $btn_class = 'btn-success';
                                                        $enable_class = 'fa-check';
                                                    }
                                                    ?>
                                                    <tr>
                                                <input type="hidden" class="tr-value-id" value="<?= $fv['id'] ?>"/>
                                                <input type="hidden" class="tr-value" value="<?= $fv['value'] ?>"/>
                                                <td><?= $del_open . $fv['value'] . $del_close ?></td>
                                                <td>
                                                    <?php if ($fv['enabled'] == 1) { ?>
                                                        <button type="button" class="btn btn-warning btn-xs" title="Edit" data-toggle="modal" data-target="#valuesModal" onclick="prepare_form('valuesModal', 'Field Value', 'btn-values', edit_value, false, value_populate, $(this).closest('tr'));"><i class="fa fa-pencil"></i></button>
                                                    <?php } else { ?>
                                                        <button type="button" class="btn btn-warning btn-xs" title="Edit" onclick="show_message(45, '<?= $this->config->item(45, 'msg') ?>', null, false, '<?= APP_NAME ?> Update');"><i class="fa fa-pencil"></i></button>
                                                    <?php }
                                                    ?>
                                                    <button type="button" class="btn btn-xs status-toggle <?= $btn_class ?>" title="<?= $enable_title ?>" onclick="show_confirmation(<?= $enable_message ?>, messages[<?= $enable_message ?>], null, 'field_value', '<?= $fv['id'] ?>', on_enable_val_success, on_enable_val_fail);"><i class="fa <?= $enable_class ?>"></i></button>
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
                    </div>
                </div>
            </div>
        </div><!-- Row -->
        <!-- Brand Modal -->
        <div class="modal fade" id="valuesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1500;" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header form-modal-header">
                        <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <form action=""  id="value-form" >
                            <input type="hidden" id="field-id" value="<?= $field_data['id'] ?>"/>
                            <input type="hidden" id="value-id" value=""/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="field-value">Value</label>
                                        <input type="text" class="form-control" id="field-value" name="field-value" placeholder="New field value" required="true">
                                    </div>
                                </div>
                            </div>                                 
                        </form>
                    </div>
                    <div class="modal-footer">
                        <img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="btn-values"></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Brand Modal -->


        <script src="<?= base_url('public/') ?>js/admin/field_values.js"></script>
        <script>
                                                var messages = [];
                                                messages[43] = '<?= $this->config->item(43, 'msg') ?>';
                                                messages[44] = '<?= $this->config->item(44, 'msg') ?>';
                                                messages[446] = '<?= $this->config->item(446, 'msg') ?>';
                                                messages[447] = '<?= $this->config->item(447, 'msg') ?>';
                                                messages[450] = '<?= $this->config->item(450, 'msg') ?>';
                                                messages[451] = '<?= $this->config->item(451, 'msg') ?>';
                                                $(function () {
                                                    $('#tbl-values').DataTable({
                                                        "ordering": false,
                                                        "columnDefs": [
                                                            {width: 900, targets: 0}
                                                        ]
                                                    });
                                                });
                                                const BASEURL = '<?= base_url() ?>';
        </script>
