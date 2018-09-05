<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="col-md-12 back-btn-panel">
            <button type="button" onclick="window.history.back();" class="btn btn-success btn-back"><i class="fa fa-chevron-left"></i> Back</button>
        </div>
    </div>
</div>

<div class="page-inner">
    <div class="page-title">
        <h3>Add Item</h3>
        <!--<button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#modelModal" ><i class="fa fa-plus"></i> Add Item</button>-->
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Add Item</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <form id="frm-add-item-initial" method="post" action="<?= base_url('item/add_item_next') ?>">
                            <input type="hidden" name="model-id" value="<?= $model['id'] ?>" />
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="item-name">Item Name</label>
                                        <input type="text" class="form-control" id="item-name" name="item-name" placeholder="Enter Item Name" required="true"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="item-code">Item Code (SKU)</label>
                                        <input type="text" class="form-control" id="item-code" name="item-code" placeholder="Enter Item Code" maxlength="25"  required="true"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="model-name">Model</label>
                                        <span class="form-control" disabled="disabled"><?= $model['model_name'] ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cat-name">Parent Category</label>
                                        <?php
                                        $parent_category = ($category_tree != FALSE) ? $category_tree['name'] : '';
                                        ?>
                                        <span class="form-control" disabled="disabled">&nbsp;&nbsp;&nbsp;&nbsp;<?= $parent_category ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cat-name">Sub Category</label>
                                        <?php
                                        $sub_category = ($category_tree != FALSE) ? $category_tree['name'] : '';
                                        ?>
                                        <span class="form-control" disabled="disabled">&nbsp;&nbsp;&nbsp;&nbsp;<?= $sub_category ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="show-selling-price">Show Selling Price</label>
                                        <input type="text" class="form-control" id="show-selling-price" name="show-selling-price" placeholder="Enter Show Selling Price"  required="true"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="item-unit">Item Unit</label>
                                        <select class="form-control" id="item-unit" name="item-unit" required="">
                                            <option value="">Select Unit..</option>
                                            <?php
                                            foreach ($units as $unit) {
                                                ?>
                                            <option value="<?= $unit['id'] ?>"><?= $unit['unit'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="item-desc">Description</label>
                                        <textarea rows="6" class="form-control" id="item-desc" name="item-desc" placeholder="Enter Description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <hr/>
                            </div>
                            <div class="row">
                                <?php
                                foreach ($model_fields as $field) {
                                    $html_id = $field['html_id'];
                                    $field_html = $this->Common->render_field($field, $model['id']);
                                    $unit = (strlen($field['unit']) > 0) ? ' (' . $field['unit'] . ')' : '';
                                    ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="<?= $html_id ?>"><?= $field['field_name'] . $unit ?></label>
                                            <?= $field_html ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-md-offset-10 pull-right">
                                    <button type="button" class="btn btn-default btn-lg" onclick="window.history.back();">Cancel</button>
                                    <button type="button" id="btn-add-item-next" class="btn btn-info btn-lg pull-right">Next</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- Row -->

        <script>
            var messages = [];
            const BASEURL = '<?= base_url() ?>';
            messages[43] = '<?= $this->config->item(43, 'msg') ?>';
            messages[44] = '<?= $this->config->item(44, 'msg') ?>';
            messages[568] = '<?= $this->config->item(568, 'msg') ?>';
            messages[569] = '<?= $this->config->item(569, 'msg') ?>';
            messages[570] = '<?= $this->config->item(570, 'msg') ?>';
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
            $('#btn-add-item-next').click(function (e) {
                $('#frm-add-item-initial').parsley().validate();
                if ($('#frm-add-item-initial').parsley().isValid()) {
                    $('#frm-add-item-initial')[0].submit();
                }
            });
            $('#item-code').blur(function (e) {
                var item_code = $(this).val();
                if (item_code.trim().length > 0) {
                    sed_ajax('<?= base_url('item/check_item_code') ?>', {'item-code': item_code}, 'json', on_item_check_success, on_item_check_fail);
                } else {
                    show_message(568, messages[568], null, false, 'Add Item');
                    $('#btn-add-item-next').prop('disabled', true);
                }
            });

            function on_item_check_success(res) {
                if (res.existing == true) {
                    show_message(569, messages[569], null, false, 'Add Item');
                    $('#btn-add-item-next').prop('disabled', true);
                } else {
                    $('#btn-add-item-next').prop('disabled', false);
                }
            }

            function on_item_check_fail(res) {
                show_message(570, messages[570], null, false, 'Add Item');
            }
        </script>
