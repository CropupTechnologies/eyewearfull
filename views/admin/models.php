<?php
$this->load->view('admin/includes/side_bar');
?>
<div class="page-inner">
    <div class="page-title">
        <h3>Models</h3>
        <button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#modelModal" onclick="prepare_form('modelModal', 'Model', 'btn-model', add_model, true, null, null);"><i class="fa fa-plus"></i> Add Model</button>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Models</li>
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
                                                <th>Model Name</th>
                                                <th>Product</th>
                                                <th>Category</th>
                                                <th>Sub Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Model Name</th>
                                                <th>Product</th>
                                                <th>Category</th>
                                                <th>Sub Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            if (isset($models)) {
                                                foreach ($models as $model) {
                                                    $del_open = $del_close = '';
                                                    $enable_message = 580;
                                                    $enable_title = 'Disable';
                                                    $btn_class = 'btn-danger';
                                                    $enable_class = 'fa-times';
                                                    if ($model['enabled'] == 0) {
                                                        $del_open = '<del>';
                                                        $del_close = '</del>';
                                                        $enable_message = 581;
                                                        $enable_title = 'Enable';
                                                        $btn_class = 'btn-success';
                                                        $enable_class = 'fa-check';
                                                    }
                                                    ?>
                                                    <tr>
                                                <input type="hidden" class="tr-model-id"   value="<?= $model['id'] ?>"/>
                                                <input type="hidden" class="tr-name"      value="<?= $model['model_name'] ?>"/>
                                                <input type="hidden" class="tr-sub-cat"      value="<?= $model['sub_category'] ?>"/>
                                                <input type="hidden" class="tr-product"      value="<?= $model['product_id'] ?>"/>
                                                <input type="hidden" class="tr-desc"      value="<?= $model['description'] ?>"/>
                                                <input type="hidden" class="tr-display-price-original"      value="<?= $model['display_price_original'] ?>"/>
                                                <input type="hidden" class="tr-display-price-sale"      value="<?= $model['display_price_sale'] ?>"/>
                                                <td><?= $del_open . $model['model_name'] . $del_close ?></td>
                                                <td><?= $del_open . $model['product_name'] . $del_close ?></td>
                                                <td><?= $del_open . $model['parent_category_name'] . $del_close ?></td>
                                                <td><?= $del_open . $model['sub_category_name'] . $del_close ?></td>
                                                <td>
                                                    <?php if ($model['enabled'] == 1) { ?>
                                                        <button type="button" class="btn btn-info btn-xs" title="Details" onclick="window.location.href = '<?= base_url('item/model_details/' . $model['id']) ?>'"><i class="fa fa-search"></i></button>
                                                        <button type="button" class="btn btn-warning btn-xs" title="Edit" data-toggle="modal" data-target="#modelModal" onclick="prepare_form('modelModal', 'Model', 'btn-model', edit_model, false, model_populate, $(this).closest('tr'));"><i class="fa fa-pencil"></i></button>
                                                    <?php } else { ?>
                                                        <button type="button" class="btn btn-info btn-xs" title="Details" onclick="show_message(584, '<?= $this->config->item(584, 'msg') ?>', null, false, '<?= APP_NAME ?> Update');"><i class="fa fa-search"></i></button>
                                                        <button type="button" class="btn btn-warning btn-xs" title="Edit" onclick="show_message(45, '<?= $this->config->item(45, 'msg') ?>', null, false, '<?= APP_NAME ?> Update');"><i class="fa fa-pencil"></i></button>
                                                    <?php }
                                                    ?>
                                                    <button type="button" class="btn btn-xs btn-primary" title="Model Fields" onclick="window.location.href = '<?= base_url('item/model_field_select/' . $model['id']) ?>'"><i class="glyphicon glyphicon-option-horizontal"></i></button>
                                                        <button type="button" class="btn btn-xs " title="Images" onclick="window.location.href = '<?= base_url('item/model_images/' . $model['id']) ?>'"><i class="fa fa-image"></i></button>
                                                    <button type="button" class="btn btn-xs status-toggle <?= $btn_class ?>" title="<?= $enable_title ?>" onclick="show_confirmation(<?= $enable_message ?>, messages[<?= $enable_message ?>], null, 'model', '<?= $model['id'] ?>', on_enable_model_success, on_enable_model_fail);"><i class="fa <?= $enable_class ?>"></i></button>
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
        <!-- Field Modal -->
        <div class="modal fade" id="modelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1500;" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header form-modal-header">
                        <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <form action=""  id="model-form" >
                            <input type="hidden" id="model-id" value=""/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="model-name">Model Name</label>
                                        <input type="text" class="form-control" id="model-name" name="model-name" placeholder="Enter model name" required="true">
                                    </div>
                                </div>                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="model-product">Product</label>
                                        <select id="model-product" class="form-control">
                                            <?php
                                            foreach ($products as $product) {
                                                echo "<option value='" . $product['id'] . "'>" . $product['name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="model-number">Sub Category</label>
                                        <select class="form-control" id="sub-category">
                                            <?php
                                            foreach ($category_tree as $parent) {
                                                ?>
                                                <optgroup label="<?= $parent['parent_name'] ?>">
                                                    <?php
                                                    foreach ($parent['sub_categories'] as $sub) {
                                                        ?>
                                                        <option value="<?= $sub['sub_id'] ?>"><?= $sub['sub_name'] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </optgroup>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="display-price-original">Display Price Original</label>
                                        <input class="form-control" id="display-price-original" type="text" min="0" step="0.01" placeholder="Display Price Original"/>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="display-price-sale">Display Price Sale</label>
                                        <input class="form-control" id="display-price-sale" type="text" min="0" step="0.01" placeholder="Display Price Original"/>
                                    </div>
                                </div> 
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="model-desc">Description</label>
                                        <textarea class="form-control" id="model-desc" name="model-desc" placeholder="Enter model description" required="true"></textarea>
                                    </div>
                                </div>                                
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="btn-model"></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Field Modal -->



        <script src="<?= base_url('public/') ?>js/admin/models.js"></script>
        <script>
                                                var messages = [];
                                                messages[43] = '<?= $this->config->item(43, 'msg') ?>';
                                                messages[44] = '<?= $this->config->item(44, 'msg') ?>';
                                                messages[580] = '<?= $this->config->item(580, 'msg') ?>';
                                                messages[581] = '<?= $this->config->item(581, 'msg') ?>';
                                                messages[582] = '<?= $this->config->item(582, 'msg') ?>';
                                                messages[583] = '<?= $this->config->item(583, 'msg') ?>';
                                                $(function () {
                                                    $('#example').DataTable({
                                                        columnDefs: [
                                                            {width: 400, targets: 0},
                                                            {width: 200, targets: 1}
                                                        ]
                                                    });
                                                });
                                                const BASEURL = '<?= base_url() ?>';
        </script>
