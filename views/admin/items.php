<?php
$this->load->view('admin/includes/side_bar');
$message = $this->session->flashdata('message');
if ($message != NULL) {
    ?>
    <script>
        $(function () {
            show_message(<?= $message[0] ?>, '<?= $message[1] ?>', null, false, 'Manage Items');
        });
    </script>
    <?php
}
?>
<div class="page-inner">
    <div class="page-title">
        <h3>Items</h3>
        <button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#modelModal" ><i class="fa fa-plus"></i> Add Item</button>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Items</li>
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
                                                <th>Item Code</th>
                                                <th>Item Name</th>
                                                <th>Model</th>
                                                <th>Category</th>
                                                <th>Sub Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Item Code</th>
                                                <th>Item Name</th>
                                                <th>Model</th>
                                                <th>Category</th>
                                                <th>Sub Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            if (!empty($items)) {
                                                foreach ($items as $item) {
                                                    $del_open = $del_close = '';
                                                    $enable_message = 574;
                                                    $enable_title = 'Disable';
                                                    $btn_class = 'btn-danger';
                                                    $enable_class = 'fa-times';
                                                    if ($item['enabled'] == 0) {
                                                        $del_open = '<del>';
                                                        $del_close = '</del>';
                                                        $enable_message = 573;
                                                        $enable_title = 'Enable';
                                                        $btn_class = 'btn-success';
                                                        $enable_class = 'fa-check';
                                                    }
                                                    ?>
                                                    <tr>
                                                <input type="hidden" class="tr-item-id"   value="<?= $item['id'] ?>"/>
                                                <input type="hidden" class="tr-name"      value="<?= $item['name'] ?>"/>
                                                <td><?= $del_open . $item['code'] . $del_close ?></td>
                                                <td><?= $del_open . $item['name'] . $del_close ?></td>
                                                <td><?= $del_open . $item['model_name'] . $del_close ?></td>
                                                <td><?= $del_open . $item['parent_category'] . $del_close ?></td>
                                                <td><?= $del_open . $item['sub_category'] . $del_close ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-xs" title="Details" onclick="window.location.href = '<?= base_url('item/item_details/' . $item['id']) ?>'"><i class="fa fa-search"></i></button>
                                                    <?php if ($item['enabled'] == 1) { ?>
                                                        <button type="button" class="btn btn-warning btn-xs" title="Edit" data-toggle="modal"  onclick="window.location.href = '<?= base_url('item/edit_item_view/' . $item['id']) ?>'"><i class="fa fa-pencil"></i></button>
                                                    <?php } else { ?>
                                                        <button type="button" class="btn btn-warning btn-xs" title="Edit" onclick="show_message(45, '<?= $this->config->item(45, 'msg') ?>', null, false, '<?= APP_NAME ?> Update');"><i class="fa fa-pencil"></i></button>
                                                    <?php }
                                                    ?>
                                                    <button type="button" class="btn btn-xs " title="Images" onclick="window.location.href = '<?= base_url('item/item_images/' . $item['id']) ?>'"><i class="fa fa-image"></i></button>
                                                    <button type="button" class="btn btn-xs status-toggle <?= $btn_class ?>" title="<?= $enable_title ?>" onclick="show_confirmation(<?= $enable_message ?>, messages[<?= $enable_message ?>], null, 'item', '<?= $item['id'] ?>', on_enable_model_success, on_enable_model_fail);"><i class="fa <?= $enable_class ?>"></i></button>
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
                    <form action=""  id="model-form" >
                        <div class="modal-header form-modal-header">
                            <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Select Model</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="item-model">Model</label>
                                        <select class="form-control" id="item-model" name="item-model">
                                            <?php
                                            foreach ($models as $model) {
                                                ?>
                                                <option value="<?= $model['id'] ?>"><?= $model['model_name'] ?></option>
                                                <?php
                                            }
                                            ?>                                            
                                        </select>
                                    </div>
                                </div>       
                            </div>       
                        </div>
                        <div class="modal-footer">
                            <img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>"/>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="btn-model" onclick="window.location.href = '<?= base_url('item/add_item_view') ?>/' + $('#item-model').val()">Proceed</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End: Field Modal -->



<!--        <script src="<?= base_url('public/') ?>js/admin/models.js"></script>-->
        <script>
                                var messages = [];
                                messages[43] = '<?= $this->config->item(43, 'msg') ?>';
                                messages[44] = '<?= $this->config->item(44, 'msg') ?>';
                                messages[572] = '<?= $this->config->item(572, 'msg') ?>';
                                messages[573] = '<?= $this->config->item(573, 'msg') ?>';
                                messages[574] = '<?= $this->config->item(574, 'msg') ?>';
                                messages[582] = '<?= $this->config->item(582, 'msg') ?>';
                                messages[583] = '<?= $this->config->item(583, 'msg') ?>';
                                $(function () {
                                    $('#example').DataTable({
                                        columnDefs: [
                                            {width: 80, targets: 0},
                                            {width: 400, targets: 1}
                                        ]
                                    });
                                });
                                const BASEURL = '<?= base_url() ?>';
        </script>
