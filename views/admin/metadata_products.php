<?php
$this->load->view('admin/includes/side_bar');
?>
<div class="page-inner">
    <div class="page-title">
        <h3>Products</h3>
        <button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#productModal" onclick="prepare_form('productModal', 'Product', 'btn-product', add_product, true, null, null);"><i class="fa fa-plus"></i> Add Product</button>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Products</li>
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
                                    <table id="produts-table" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Last Updated By</th>
                                                <th>Last Updated On</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Last Updated By</th>
                                                <th>Last Updated On</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            foreach ($products as $p) {
                                                $del_open = $del_close = '';
                                                $enable_message = 322;
                                                $enable_title = 'Disable';
                                                $btn_class = 'btn-danger';
                                                $enable_class = 'fa-times';
                                                if ($p['enabled'] == 0) {
                                                    $del_open = '<del>';
                                                    $del_close = '</del>';
                                                    $enable_message = 323;
                                                    $enable_title = 'Enable';
                                                    $btn_class = 'btn-success';
                                                    $enable_class = 'fa-check';
                                                }
                                                $description = trim($p['description']);
                                                ?>
                                                <tr>
                                            <input type="hidden" class="tr-product-id"   value="<?= $p['id'] ?>"/>
                                            <input type="hidden" class="tr-name"      value="<?= $p['name'] ?>"/>
                                            <input type="hidden" class="tr-type" value="<?= $p['product_type'] ?>"/>
                                            <input type="hidden" class="tr-counting-bahaviour" value="<?= $p['counting_behaviour'] ?>"/>
                                            <input type="hidden" class="tr-description"  value="<?= $description ?>"/>
                                            <td><?= $del_open . $p['name'] . $del_close ?></td>
                                            <td><?= $del_open . $p['type_name'] . $del_close ?></td>
                                            <td><?= $del_open . $p['lastupdated_user'] . $del_close ?></td>
                                            <td><?= $del_open . date('Y-m-d h:i a', strtotime($p['lastupdated_on'])) . $del_close ?></td>
                                            <td>
                                                <button type="button" class="btn btn-xs btn-info" title="Product Fields" onclick="window.location.href = '<?= base_url('item/metadata_product_fields/' . $p['id']) ?>'"><i class="glyphicon glyphicon-option-horizontal"></i></button>
                                                <?php if ($p['enabled'] == 1) { ?>
                                                    <button type="button" class="btn btn-warning btn-xs" title="Edit" data-toggle="modal" data-target="#productModal" onclick="prepare_form('productModal', 'Produtct', 'btn-product', edit_product, false, product_populate, $(this).closest('tr'));"><i class="fa fa-pencil"></i></button>
                                                <?php } else { ?>
                                                    <button type="button" class="btn btn-warning btn-xs" title="Edit" onclick="show_message(45, '<?= $this->config->item(45, 'msg') ?>', null, false, '<?= APP_NAME ?> Update');"><i class="fa fa-pencil"></i></button>
                                                <?php } ?>
                                                <button type="button" class="btn btn-xs status-toggle <?= $btn_class ?>" title="<?= $enable_title ?>" onclick="show_confirmation(<?= $enable_message ?>, messages[<?= $enable_message ?>], null, 'metadata_product', '<?= $p['id'] ?>', on_enable_product_success, on_enable_product_fail);"><i class="fa <?= $enable_class ?>"></i></button>
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
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1500;" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header form-modal-header">
                        <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <form action=""  id="product-form" >
                            <input type="hidden" id="product-id" value=""/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="product-name">Product Name</label>
                                        <input type="text" class="form-control" id="product-name" name="product-name" placeholder="Enter product name" required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product-type">Product Type</label>
                                        <select class="form-control" id="product-type" name="product-type" required="true">
                                            <?php
                                            foreach ($product_types as $p_type) {
                                                echo "<option value='" . $p_type['id'] . "'>" . $p_type['type_name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="counting-behaviour">Counting Behaviour</label>
                                        <select class="form-control" id="counting-behaviour" name="counting-behaviour" required="true">
                                            <?php
                                            foreach ($counting_behaviours as $c_type) {
                                                echo "<option value='" . $c_type . "'>" . ucfirst(strtolower(str_replace('_', ' ', $c_type))) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" rows="6" id="description" name="description" placeholder="Product Description" ></textarea>
                                    </div>
                                </div>
                            </div>                                 
                        </form>
                    </div>
                    <div class="modal-footer">
                        <img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="btn-product"></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Brand Modal -->


        <script src="<?= base_url('public/') ?>js/admin/metadata_products.js"></script>
        <script>
                                                var messages = [];
                                                messages[43] = '<?= $this->config->item(43, 'msg') ?>';
                                                messages[44] = '<?= $this->config->item(44, 'msg') ?>';
                                                messages[320] = '<?= $this->config->item(320, 'msg') ?>';
                                                messages[321] = '<?= $this->config->item(321, 'msg') ?>';
                                                messages[322] = '<?= $this->config->item(322, 'msg') ?>';
                                                messages[323] = '<?= $this->config->item(323, 'msg') ?>';
                                                messages[324] = '<?= $this->config->item(324, 'msg') ?>';
                                                messages[325] = '<?= $this->config->item(325, 'msg') ?>';
                                                var parsley_procut_form;
                                                $(function () {
                                                    parsley_product_form = $('#product-form');
                                                    parsley_product_form.parsley();
                                                    $('#produts-table').DataTable({
                                                        columnDefs: [
                                                            {width: 400, targets: 0},
                                                            {width: 150, targets: 1},
                                                            {width: 140, targets: 2},
                                                            {width: 120, targets: 3},
                                                            {width: 80, targets: 4}
                                                        ],
                                                    });
                                                });
                                                const BASEURL = '<?= base_url() ?>';
        </script>
