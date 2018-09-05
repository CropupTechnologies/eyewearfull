<?php
$this->load->view('admin/includes/side_bar');
?>
<div class="page-inner">
    <div class="page-title">
        <h3>Promotions</h3>
        <button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#promotionModal" onclick="prepare_form('promotionModal', 'Promotions', 'btn-promotion', add_promotion, true, null, null);"><i class="fa fa-plus"></i> Add Promotion</button>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Promotions</li>
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
                                                <th style="width:15%;">Name</th>
                                                <th class="text-center">Type</th>
                                                <th class="text-center">Value Type</th>
                                                <th class="text-center">Value</th>
                                                <th class="text-center">Start Date</th>
                                                <th class="text-center">End Date</th>
                                                <th class="text-center" style="width:8%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th style="width:15%;">Name</th>
                                                <th class="text-center">Type</th>
                                                <th class="text-center">Value Type</th>
                                                <th class="text-center">Value</th>
                                                <th class="text-center">Start Date</th>
                                                <th class="text-center">End Date</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            foreach ($promotions as $promotion) {
                                                $del_open = $del_close = '';
                                                $enable_message = 836;
                                                $enable_title = 'Disable';
                                                $btn_class = 'btn-danger';
                                                $enable_class = 'fa-times';
                                                if ($promotion['enabled'] == 0) {
                                                    $del_open = '<del>';
                                                    $del_close = '</del>';
                                                    $enable_message = 837;
                                                    $enable_title = 'Enable';
                                                    $btn_class = 'btn-success';
                                                    $enable_class = 'fa-check';
                                                }
                                                ?>
                                                <tr>
                                            <input type="hidden" class="table_id" value="<?= $promotion['id'] ?>"/>
                                            <input type="hidden" class="table_name" value="<?= $promotion['name'] ?>"/>
                                            <input type="hidden" class="table_description" value="<?= $promotion['description'] ?>"/>
                                            <input type="hidden" class="table_type" value="<?= $promotion['type'] ?>"/>
                                            <input type="hidden" class="table_value_type" value="<?= $promotion['value_type'] ?>"/>
                                            <input type="hidden" class="table_value" value="<?= $promotion['value'] ?>"/>
                                            <input type="hidden" class="table_min_total" value="<?= $promotion['min_total'] ?>"/>
                                            <input type="hidden" class="table_min_qty" value="<?= $promotion['min_qty'] ?>"/>
                                            <input type="hidden" class="table_ui_class" value="<?= $promotion['ui_class'] ?>"/>
                                            <input type="hidden" class="table_start_date" value="<?= $promotion['start_date'] ?>"/>
                                            <input type="hidden" class="table_end_date" value="<?= $promotion['end_date'] ?>"/>

                                            <td><?= $del_open . $promotion['name'] . $del_close ?></td>
                                            <td class="text-center"><?= $del_open . $promotion['type'] . $del_close ?></td>
                                            <td class="text-center"><?= $del_open . $promotion['value_type'] . $del_close ?></td>
                                            <td class="text-center"><?= $del_open . $promotion['value'] . $del_close ?></td>
                                            <td class="text-center"><?= $del_open . $promotion['start_date'] . $del_close ?></td>
                                            <td class="text-center"><?= $del_open . $promotion['end_date'] . $del_close ?></td>
                                            <?php
                                            echo '<td class="text-center">';
                                            if ($promotion['enabled'] == 1) {
                                                echo '<button type="button" class="btn btn-warning btn-xs" title="Edit" data-toggle="modal" data-target="#promotionModal" onclick="prepare_form(\'promotionModal\', \'Promotions\', \'btn-promotion\', edit_promotion, false, promotion_populate,$(this).closest(\'tr\'));"><i class="fa fa-pencil"></i></button>';
                                            } else {
                                                echo '<button type="button" class="btn btn-warning btn-xs" title="Edit" onclick="show_message(45, \'' . $this->config->item(45, 'msg') . '\', null, false, \'' . APP_NAME . ' Update\');"><i class="fa fa-pencil"></i></button>';
                                            }
                                            $enable_title = 'Disable';
                                            $btn_class = 'btn-danger';
                                            $enable_class = 'fa-times';
                                            if ($promotion['enabled'] == 0) {
                                                $enable_title = 'Enable';
                                                $btn_class = 'btn-success';
                                                $enable_class = 'fa-check';
                                            }
                                            echo '<button type="button" class="btn btn-xs status-toggle ' . $btn_class . '" title="' . $enable_title . '" onclick="show_confirmation(' . $enable_message . ', messages[' . $enable_message . '], null, \'promotion\', ' . $promotion['id'] . ', on_toggle_success, on_toggle_fail);"><i class="fa ' . $enable_class . '"></i></button>';
                                            echo '</td>';
                                            ?>
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
        <div class="modal fade" id="promotionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1500;" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header form-modal-header">
                        <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <form action=""  id="promotion-form" >
                            <input type="hidden" value="" id="hidden-id"/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required="true">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" placeholder="Enter Description"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Promotion Type</label>
                                        <select class="form-control" id="type" name="type" required="required">
                                            <option value="DISCOUNT_CALCULATION">DISCOUNT_CALCULATION</option>
                                            <option value="ADD_ANOTHER_ITEM">ADD_ANOTHER_ITEM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="value_type">Value Type</label>
                                        <select class="form-control" id="value_type" name="value_type" required="required">
                                            <option value="PERCENTAGE">PERCENTAGE</option>
                                            <option value="AMOUNT">AMOUNT</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="value">Value</label>
                                        <input type="number" class="form-control" id="value" name="value" placeholder="Enter Value" required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ui_class">UI Class</label>
                                        <input type="text" class="form-control" id="ui_class" name="ui_class" placeholder="Enter UI Class" required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="min_qty">Minimum Quantity</label>
                                        <input type="number" class="form-control" id="min_qty" name="min_qty" placeholder="Enter Min.Qty">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="min_amount">Minimum Amount</label>
                                        <input type="number" class="form-control" id="min_amount" name="min_amount" placeholder="Enter Min.Amount">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">Start Date</label>
                                        <input type="text" class="form-control date-picker" id="start_date" name="start_date" required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date">End Date</label>
                                        <input type="text" class="form-control date-picker" id="end_date" name="end_date" required="true">
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                    <div class="modal-footer">
                        <img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="btn-promotion"></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Brand Modal -->


        <script src="<?= base_url('public/') ?>js/admin/promotions.js"></script>
        <script>
            var messages = [];
            messages[40] = '<?= $this->config->item(40, 'msg') ?>';
            messages[41] = '<?= $this->config->item(41, 'msg') ?>';
            messages[43] = '<?= $this->config->item(43, 'msg') ?>';
            messages[44] = '<?= $this->config->item(44, 'msg') ?>';
            messages[832] = '<?= $this->config->item(832, 'msg') ?>';
            messages[833] = '<?= $this->config->item(833, 'msg') ?>';
            messages[835] = '<?= $this->config->item(835, 'msg') ?>';
            messages[834] = '<?= $this->config->item(834, 'msg') ?>';
            messages[836] = '<?= $this->config->item(836, 'msg') ?>';
            messages[837] = '<?= $this->config->item(837, 'msg') ?>';
            messages[838] = '<?= $this->config->item(838, 'msg') ?>';
            messages[839] = '<?= $this->config->item(839, 'msg') ?>';
            var parsley_promotions_form;
            $(function () {
                parsley_promotions_form = $('#promotion-form');
                parsley_promotions_form.parsley();
                $('#produts-table').DataTable();
            });
            const BASEURL = '<?= base_url() ?>';
        </script>
