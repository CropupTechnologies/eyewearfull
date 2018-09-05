<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="col-md-12 back-btn-panel">
            <button type="button" onclick="window.history.back();" class="btn btn-success btn-back"><i class="fa fa-chevron-left"></i> Back</button>
        </div>
    </div>
</div>

<div class="page-inner">
    <div class="page-title">
        <h3>Add Goods Receive Note</h3>        
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Add GRN</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <form id="frm-add-grn" method="post" action="<?= base_url('item/add_grn') ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="supplier">Supplier</label>
                                        <select class="form-control" id="supplier" name="supplier" required="required">
                                            <option value="">Select Supplier..</option>
                                            <?php
                                            foreach ($suppliers as $sup) {
                                                ?>
                                                <option value="<?= $sup['id'] ?>"><?= $sup['name'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="grn-date">Date</label>
                                        <input type="text" class="form-control date-picker" id="grn-date" name="grn-date" readonly="readonly"  required="true" value="<?= date('Y-m-d') ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="grn-ref">Reference Number</label>
                                        <input type="text" class="form-control" id="grn-ref" name="grn-ref" placeholder="Enter Reference Number" maxlength="25"  required="true"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="grn-total">Total Amount</label>
                                        <input type="number" min="1" step="0.01" class="form-control" id="grn-total" value="0" name="grn-total" placeholder="Enter Total Amount" maxlength="25"  required="true"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="grn-vahicle">Vehicle Number</label>
                                        <input type="text" class="form-control" id="grn-vahicle" name="grn-vahicle" placeholder="Enter Vehicle Number" maxlength="25" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="grn-driver">Driver Name</label>
                                        <input type="text" class="form-control" id="grn-driver" name="grn-driver" placeholder="Enter Drive Info" maxlength="25"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="grn-unloading">Unloading Tips</label>
                                        <input  type="number" min="0" step="0.01" class="form-control" id="grn-unloading" value="0" name="grn-unloading" placeholder="Enter Unloading Fee" maxlength="25"  required="true"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="grn-tips">Other Tips</label>
                                        <input type="number" min="0" step="0.01" class="form-control" value="0" id="grn-tips" name="grn-tips" placeholder="Enter Tips Amount" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <select class="form-control" id="location" name="location"  required="required">
                                                    <option value="">Select Location..</option>
                                            <?php
                                            if (count($branches) > 0) {
                                                foreach ($branches as $b) {
                                                    ?>
                                                    <option value="<?= $b['id'] ?>"><?= $b['name'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#grnItemModal" ><i class="fa fa-plus"></i> Add Item</button>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="tbl-items" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Item Code</th>
                                                <th>Name</th>
                                                <th>Serial Number</th>
                                                <th>Qty</th>
                                                <th>Cost</th>
                                                <th>Expity Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-md-offset-10 pull-right">
                                    <button type="button" class="btn btn-default btn-lg" onclick="window.history.back();">Cancel</button>
                                    <button type="button" id="btn-add-grn" class="btn btn-info btn-lg pull-right">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
        <!-- Grn Item Modal -->
        <div class="modal fade" id="grnItemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1500;" data-backdrop="static" data-keyboard="false" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header form-modal-header">
                        <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add GRN Item</h4>
                    </div>
                    <div class="modal-body">
                        <form action=""  id="grn-item-form" >
                            <input type="hidden" name="item-id" id="item-id" value=""/>
                            <input type="hidden" name="is-unique-item" id="is-unique-item" />
                            <?= $search_item_html ?>
                            <div id="other-f-ing-details">
                                <div class="row">
                                    <div class="col-md-6">                                    
                                        <div class="form-group">
                                            <div  id="serial-number-div">
                                                <label for="serial-number">Serial Number</label>
                                                <input type="text" class="form-control" id="serial-number" placeholder="Enter Serial Number" readonly="readonly" value="N/A"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="expiry-date">Expiry Date</label>
                                            <input type="text" class="form-control date-picker" id="expiry-date" name="expiry-date" readonly="readonly"/>
                                        </div>
                                    </div>                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="item-cost">Cost</label>
                                            <input type="number" min="0" step="0.01" class="form-control" id="item-cost" name="item-cost" value="0"/>
                                        </div>
                                    </div>                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="item-qty">Qty</label>
                                            <input class="form-control" type="number" min="0" step="0.01" class="item-qty" id="item-qty" value="0"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="btn-add-item">Add</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Field Modal -->

        <script src="<?= base_url('public/js/admin/grn.js') ?>"></script>
        <style>
            .search-anim-image{
                background: url('<?= base_url('public/images/loading_blue.gif') ?>') !important;
                background-color: #ffffff !important;
                background-position:right center !important;
                background-repeat: no-repeat !important;
            }
        </style>
        <script>
                                        var messages = [];
                                        var categories = <?= json_encode($categories, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) ?>;
                                        var items = <?= json_encode($items, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) ?>;
                                        messages[43] = '<?= $this->config->item(43, 'msg') ?>';
                                        messages[44] = '<?= $this->config->item(44, 'msg') ?>';
                                        messages[600] = '<?= $this->config->item(600, 'msg') ?>';
                                        messages[601] = '<?= $this->config->item(601, 'msg') ?>';
                                        messages[604] = '<?= $this->config->item(604, 'msg') ?>';
                                        messages[605] = '<?= $this->config->item(605, 'msg') ?>';
                                        messages[606] = '<?= $this->config->item(606, 'msg') ?>';
                                        messages[611] = '<?= $this->config->item(611, 'msg') ?>';
                                        $(function () {
                                            $('#example').DataTable({
                                                columnDefs: [
                                                    {width: 400, targets: 0},
                                                    {width: 200, targets: 1}
                                                ]
                                            });
                                        });

                                        const BASEURL = '<?= base_url() ?>';
                                                const LOADING_IMAGE = '<?= base_url('public/images/loading_blue.gif') ?>';
        </script>
        <script src="<?= base_url('public/js/admin/select_item.js') ?>"></script>
