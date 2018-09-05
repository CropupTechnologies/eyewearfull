<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="col-md-12 back-btn-panel">
            <button type="button" onclick="window.history.back();" class="btn btn-success btn-back"><i class="fa fa-chevron-left"></i> Back</button>
        </div>
    </div>
</div>
<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    ?>
    <script>
        $(function () {
            show_message('<?= $message['id'] ?>', '<?= $message['message'] ?>', null, false);
        });
    </script>
    <?php
    unset($_SESSION['message']);
}
?>


<div class="page-inner">
    <div class="page-title">
        <h3>Model Details (Model: <?= $model['model_name'] ?> )</h3>
        <!--<button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#fieldModal" onclick="prepare_form('fieldModal', 'Field', 'btn-field', add_field, true, null, null);"><i class="fa fa-plus"></i> Select Field</button>-->
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Model Details</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <form method="post" action="<?= base_url('item/update_model_field_values') ?>">
                            <input type="hidden" name="model-id" value="<?= $model['id'] ?>"/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="tbl-modal-details" class="display table" style="width: 100%; cellspacing: 0;">
                                            <thead>
                                                <tr>
                                                    <th>Field Name</th>
                                                    <th>Field Type</th>
                                                    <th>Is Optional</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Field Name</th>
                                                    <th>Field Type</th>
                                                    <th>Is Optional</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                foreach ($model_fields as $mf) {
                                                    $field_type = $this->Common->get_field_readable_type($mf['field_type']);
                                                    ?>
                                                    <tr>
                                                        <td><?= $mf['field_name'] ?></td>
                                                        <td><?= $field_type ?>
                                                            <?php
                                                            if ($mf['field_type'] == 'LIST') {
                                                                $txt_values = json_encode($mf['backend_values'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
                                                                ?>
                                                                <input type="hidden" class="field-id" name="field-id[]" value='<?= $mf['id'] ?>'/>
                                                                <input type="hidden" class="field-values" name="field-values[]" value='<?= $txt_values ?>'/>
                                                                <button type="button" onclick="show_values($(this).closest('tr'));"  class="btn btn-xs btn-primary btn-values" title="Values" ><i class="fa fa-table"></i></button>
    <?php } ?>
                                                        </td>
                                                        <td><?= ($mf['is_optional'] == 1) ? 'YES' : 'NO' ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>  
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-1 col-md-offset-11">
                                    <button type="submit" class="btn btn-info">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
        <!-- Brand Modal -->
        <div class="modal fade" id="valuesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1500;" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?= base_url('item/add_product_fields') ?>" method="post"  id="product-field-form" >
                        <div class="modal-header form-modal-header">
                            <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Relevant Field Values</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="selected-values" value=""/>
                            <input type="hidden" name="model-id" id="model-id" value="<?= $model['id'] ?>"/>
                            <input type="hidden" name="field-id" id="field-id" value=""/>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped" id="tbl-values">
                                        <thead>
                                            <tr><th>Select</th><th>Value</th></tr>
                                        </thead>
                                        <tbody>                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>                                 
                        </div>
                        <div class="modal-footer">
                            <img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>"/>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="btn-update-field-values">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End: Brand Modal -->


        <script src="<?= base_url('public/') ?>js/admin/model_details.js"></script>
        <script>
                                                            var messages = [];
                                                            messages[43] = '<?= $this->config->item(43, 'msg') ?>';
                                                            messages[44] = '<?= $this->config->item(44, 'msg') ?>';
                                                            messages[440] = '<?= $this->config->item(440, 'msg') ?>';
                                                            messages[441] = '<?= $this->config->item(441, 'msg') ?>';
                                                            messages[444] = '<?= $this->config->item(444, 'msg') ?>';
                                                            messages[445] = '<?= $this->config->item(445, 'msg') ?>';
                                                            $(function () {
                                                                brandTable = $('#tbl-modal-details').DataTable({
                                                                    "ordering": false,
                                                                    "columnDefs": [
                                                                        {width: 600, targets: 0},
                                                                        {width: 100, targets: 1}
                                                                    ]
                                                                });
                                                            });
                                                            const BASEURL = '<?= base_url() ?>';
        </script>
