<?php
$this->load->view('admin/includes/side_bar');
?>
<div class="page-inner">
    <div class="page-title">
        <h3>Product Type</h3>
         <button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#product_typeModal" onclick="prepare_form('product_typeModal', 'Product Type', 'btn-product_type', add_product_type, true, null);"><i class="fa fa-plus"></i> Add Product Type</button>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Product Type</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
       
        <div class="table-responsive">
            <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th class="text-center">Created On</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th class="text-center">Created On</th>
                        <th class="text-center">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($categories as $category) {
                        $del_open = $del_close = '';
                        if ($category['enabled'] == 0) {
                            $del_open = '<del>';
                            $del_close = '</del>';
                        }
                        echo '<tr>';
                        echo '<input type="hidden"  class="table_id" value="' . $category['id'] . '" />';
                        echo '<input type="hidden" class="table_name" value="' . $category['type_name'] . '" />';

                        echo '<td>' . $del_open . $category['type_name'] . $del_close . '</td>';
                        echo '<td class="text-center">' . $del_open . date('Y-m-d h:i a', strtotime($category['created_on'])) . $del_close . '</td>';
                        echo '<td class="text-center">';
                        if ($category['enabled'] == 1) {
                            echo '<button type="button" class="btn btn-warning btn-xs" title="Edit" data-toggle="modal" data-target="#product_typeModal" onclick="prepare_form(\'product_typeModal\', \'Product Type\', \'btn-product_type\', edit_product_type, false, product_type_populate,$(this).closest(\'tr\'));"><i class="fa fa-pencil"></i></button>';
                        } else {
                            echo '<button type="button" class="btn btn-warning btn-xs" title="Edit" onclick="show_message(45, \'' . $this->config->item(45, 'msg') . '\', null, false, \'' . APP_NAME . ' Update\');"><i class="fa fa-pencil"></i></button>';
                        }

                        $enable_title = 'Disable';
                        $btn_class = 'btn-danger';
                        $enable_class = 'fa-times';
                        if ($category['enabled'] == 0) {
                            $enable_title = 'Enable';
                            $btn_class = 'btn-success';
                            $enable_class = 'fa-check';
                            $status_msg_id = 654;
                        } else {
                            $status_msg_id = 655;
                        }
                        echo '<button type="button" class="btn btn-xs status-toggle ' . $btn_class . '" title="' . $enable_title . '" onclick="show_confirmation(' . $status_msg_id . ', messages[' . $status_msg_id . '], null, \'product_type\', ' . $category['id'] . ', supplier_status_success, supplier_status_fail);"><i class="fa ' . $enable_class . '"></i></button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>  
        </div>
        <!-- Brand Modal -->
        <div class="modal fade" id="product_typeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header form-modal-header">
                        <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <form action=""  id="product_type-form" >
                            <input type="hidden" name="hidden-id" id="hidden-id"/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name"> Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required="true">
                                    </div>
                                </div>                                
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="btn-product_type"></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Brand Modal -->
        <script src="<?= base_url('public/') ?>js/admin/product_type.js"></script>

        <script>
            var messages = [];
            messages[650] = '<?= $this->config->item(650, 'msg') ?>';
            messages[651] = '<?= $this->config->item(651, 'msg') ?>';
            messages[652] = '<?= $this->config->item(652, 'msg') ?>';
            messages[653] = '<?= $this->config->item(653, 'msg') ?>';
            messages[654] = '<?= $this->config->item(654, 'msg') ?>';
            messages[655] = '<?= $this->config->item(655, 'msg') ?>';
            messages[43] = '<?= $this->config->item(43, 'msg') ?>';
            messages[44] = '<?= $this->config->item(44, 'msg') ?>';


            var bradTable;
            var parsley_product_type_form;
            $(function () {
                parsley_product_type_form = $('#product_type-form');
                parsley_product_type_form.parsley();
                brandTable = $('#example').DataTable({});

            });
            const BASEURL = '<?= base_url() ?>';

            $('#supplierModal').on('hidden.bs.modal', function () {
                $('#supplier-form').trigger("reset");
            });
        </script>
