<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="col-md-12 back-btn-panel">
            <button type="button" onclick="window.history.back();" class="btn btn-success btn-back"><i class="fa fa-chevron-left"></i> Back</button>
        </div>
    </div>
</div>

<div class="page-inner">
    <div class="page-title">
        <h3>Fields List (Product: <?= $product_data['name'] ?> )</h3>
        <button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#fieldModal" onclick="prepare_form('fieldModal', 'Field', 'btn-field', add_field, true, null, null);"><i class="fa fa-plus"></i> Select Field</button>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Product Field List</li>
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
                                                <th>Display Order</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Field Name</th>
                                                <th>Display Order</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $selected_field_ids = [];
                                            $c = 0;
                                            foreach ($product_fields as $field) {
                                                $selected_field_ids[] = $field['id'];
                                                $del_open = $del_close = '';
                                                $enable_message = 444;
                                                $enable_title = 'Disable';
                                                $btn_class = 'btn-danger';
                                                $enable_class = 'fa-times';
                                                if ($field['pf_enabled'] == 0) {
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
                                            <td><?= $del_open . $field['field_name'] . $del_close ?></td>
                                            <td>
                                                <?php
                                                if ($field['enabled'] == 1) {
                                                    if ($c != 0) {
                                                        ?>
                                                        <!--<a title="Move Up" href='<?= base_url('item/product_field_display_dec/' . $field['id']) ?>' >Up</a>-->
                                                        <?php
                                                    }
                                                    if ($c > 0 && $c < (count($product_fields) - 1)) {
//                                                        echo "|";
                                                    }
                                                    if ($c < (count($product_fields) - 1)) {
                                                        ?>
                                                        <!--<a title="Move Down" href='<?= base_url('item/product_field_display_inc/' . $field['id']) ?>'>Down</a>-->
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-xs status-toggle <?= $btn_class ?>" title="<?= $enable_title ?>" onclick="show_confirmation(<?= $enable_message ?>, messages[<?= $enable_message ?>], null, 'product_field', '<?= $field['product_field_id'] ?>', on_enable_field_success, on_enable_field_fail);"><i class="fa <?= $enable_class ?>"></i></button>
                                            </td>

                                            </tr>
                                            <?php
                                            $c++;
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
        <div class="modal fade" id="fieldModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1500;" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?= base_url('item/add_product_fields') ?>" method="post"  id="product-field-form" >
                        <div class="modal-header form-modal-header">
                            <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="product-id" id="product-id" value="<?= $product_data['id'] ?>"/>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr><th>Select</th><th>Field Name</th></tr>
                                        </thead>
                                        <tbody>                                            
                                            <?php
                                            $field_count = 0;
                                            foreach ($all_fields as $f) {
                                                if ($f['enabled'] == 1 && !in_array($f['id'], $selected_field_ids)) {
                                                    $field_count++;
                                                    ?>
                                                    <tr>
                                                        <td><input type="checkbox" name="selected_fields[]" class="selected_fields" value="<?= $f['id'] ?>"/></td><td><?= $f['field_name'] ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            if ($field_count == 0) {
                                                ?>
                                                <tr><td colspan="2" class="text-center">There ate no fields to select.</td></tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>                                 
                        </div>
                        <div class="modal-footer">
                            <img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>"/>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="btn-product-field">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End: Brand Modal -->


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
                                                    brandTable = $('#example').DataTable({
                                                        "ordering": false,
                                                        "columnDefs": [
                                                            {width: 900, targets: 0},
                                                            {width: 100, targets: 1}
                                                        ]
                                                    });
                                                });
                                                const BASEURL = '<?= base_url() ?>';
        </script>
