<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="col-md-12 back-btn-panel">
            <button type="button" onclick="window.history.back();" class="btn btn-success btn-back"><i class="fa fa-chevron-left"></i> Back</button>
        </div>
    </div>
</div>
<div class="page-inner">
    <div class="page-title">
        <h3>Items Promotion</h3>        
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Items Promotion</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <?= $search_item_html ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <h4>Item</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="tbl-promotion" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td>Name</td>
                                            <td>Code</td>
                                            <td>Model Name</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl-promotion-body">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>Name</td>
                                            <td>Code</td>
                                            <td>Model Name</td>
                                            <td>Action</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
    </div>
    <!-- Promotion Modal -->
    <div class="modal fade" id="promotionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" href="#" style="z-index:1500">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header form-modal-header">
                    <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Promotion</h4>
                </div>
                <div class="modal-body">
                    <form action=""  id="promotion-form">
                        <input type="hidden" value="" name="hidden-item-id" id="hidden-item-id"/>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="promotion">Promotions</label>
                                    <select type="text" class="form-control" id="promotion" required="required">
                                        <?php
                                        foreach ($promotions as $promotion) {
                                            ?>
                                            <option value="<?= $promotion['id'] ?>"><?= $promotion['name'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="text" class="form-control date-picker" id="start_date" required="required"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input type="text" class="form-control date-picker" id="end_date" required="required"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btn-promotion">Add</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End: Promotion Modal -->

    <style>
        span.or{
            left: 48.5%;
            top: 123px;
        }

        .vl{
            top: 55px;
        }

        .search-anim-image{
            background: url('<?= base_url('public/images/loading_blue.gif') ?>') !important;
            background-color: #ffffff !important;
            background-position:right center !important;
            background-repeat: no-repeat !important;
        }
    </style>
    <script>
        var table;
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
        messages[650] = '<?= $this->config->item(650, 'msg') ?>';
        messages[651] = '<?= $this->config->item(651, 'msg') ?>';
        messages[652] = '<?= $this->config->item(652, 'msg') ?>';
        messages[830] = '<?= $this->config->item(830, 'msg') ?>';
        messages[831] = '<?= $this->config->item(831, 'msg') ?>';
        const BASEURL = '<?= base_url() ?>';
        const LOADING_IMAGE = '<?= base_url('public/images/loading_blue.gif') ?>';
    </script>
    <script src="<?= base_url('public/js/admin/promotion.js') ?>"></script>