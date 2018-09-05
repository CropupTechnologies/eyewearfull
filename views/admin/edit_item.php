<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="col-md-12 back-btn-panel">
            <button type="button" onclick="window.history.back();" class="btn btn-success btn-back"><i class="fa fa-chevron-left"></i> Back</button>
        </div>
    </div>
</div>

<div class="page-inner">
    <div class="page-title">
        <h3>Edit Item</h3>
        <!--<button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#modelModal" ><i class="fa fa-plus"></i> Add Item</button>-->
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Edit Item</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <form id="frm-add-item-initial" method="post" action="<?= base_url('item/edit_item_save') ?>">
                            <input type="hidden" name="item-id" value="<?= $item['id'] ?>" />
                            <input type="hidden" name="model-id" value="<?= $item['model_id'] ?>" />
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="item-name">Item Name</label>
                                        <input type="text" class="form-control" id="item-name" name="item-name" placeholder="Enter Item Name" required="true" value="<?= $item['name'] ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="item-code">Item Code (SKU)</label>
                                        <input type="text" class="form-control" id="item-code" name="item-code" placeholder="Enter Item Code" maxlength="25"  required="true" value="<?= $item['code'] ?>"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="model-name">Model</label>
                                        <span class="form-control" disabled="disabled"><?= $item['model_name'] ?></span>
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
                                        $sub_category = ($category_tree != FALSE) ? $category_tree['sub_category']['name'] : '';
                                        ?>
                                        <span class="form-control" disabled="disabled">&nbsp;&nbsp;&nbsp;&nbsp;<?= $sub_category ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="show-selling-price">Show Selling Price</label>
                                        <input type="text" class="form-control" id="show-selling-price" name="show-selling-price" placeholder="Enter Show Selling Price" value="<?= $item['show_selling_price'] ?>"  required="true" readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" name="item-unit" value="<?= $item['unit'] ?>"/>
                                        <label for="item-unit">Item Unit</label>
                                        <select class="form-control" id="item-unit" name="item-unit" required="required" disabled>
                                            <option value="">Select Unit..</option>
                                            <?php
                                            foreach ($units as $unit) {
                                                $selected = '';
                                                if ($item['unit'] == $unit['id']) {
                                                    $selected = 'selected';
                                                }
                                                ?>
                                                <option value="<?= $unit['id'] ?>" <?= $selected ?>><?= $unit['unit'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="item-desc">Description</label>
                                        <textarea rows="6" class="form-control" id="item-desc" name="item-desc" placeholder="Enter Description" ><?= htmlspecialchars_decode($item['description']) ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <hr/>
                            </div>
                            <div class="row dynamic">
                                <?php
                                foreach ($item['fields'] as $field) {
                                    $html_id = $field['html_id'];
                                    $value = NULL;
                                    if (isset($field['value'])) {
                                        $value = $field['value'];
                                    }
                                    $field_html = $this->Common->render_field($field, $item['model_id'], $value);
                                    $unit = (strlen($field['unit']) > 0) ? ' (' . $field['unit'] . ')' : '';
                                    ?>
                                    <?php
                                    if ($field['field_type'] == 'TEXT') {
                                        ?>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="<?= $html_id ?>"><?= $field['field_name'] . $unit ?></label>
                                                <input type="text" name="<?= $field['html_id'] ?>" class="form-control" id="<?= $field['html_id'] ?>" value="<?= $field['value'] ?>" readonly="readonly"/>
                                            </div>
                                        </div>
                                        <?php
                                    } else if ($field['field_type'] == 'LIST') {
                                        ?>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="<?= $html_id ?>"><?= $field['field_name'] . $unit ?></label>
                                                <input type="text" class="form-control" name="<?= $field['html_id'] ?>" id="<?= $field['html_id'] ?>" value="<?= (!empty($field['all_values']) ? $field['all_values'][0]['value'] : '') ?>" readonly="readonly"/>
                                            </div>
                                        </div>
                                        <?php
                                    } else {
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
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-md-offset-10 pull-right">
                                    <button type="button" class="btn btn-default btn-lg" onclick="window.history.back();">Cancel</button>
                                    <button type="button" id="btn-add-item-next" class="btn btn-info btn-lg pull-right">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- Row -->

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
            $('#btn-add-item-next').click(function (e) {
                $('#frm-add-item-initial').parsley().validate();
                if ($('#frm-add-item-initial').parsley().isValid()) {
                    $('#frm-add-item-initial')[0].submit();
                }
            });
            const BASEURL = '<?= base_url() ?>';

//            $(document).ready(function(){
//                $('.dynamic').hide();
//            });
        </script>
