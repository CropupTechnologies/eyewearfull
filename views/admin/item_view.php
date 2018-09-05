<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="col-md-12 back-btn-panel">
            <button type="button" onclick="window.history.back();" class="btn btn-success btn-back"><i class="fa fa-chevron-left"></i> Back</button>
        </div>
    </div>
</div>
<div class="page-inner">
    <div class="page-title">
        <h3>Item Details</h3>        
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Item Details</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-9">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr><th class="th-detail-first">Item Name</th><td><?= $item['name'] ?></td></tr> 
                                        <tr><th class="th-detail-first">Code</th><td><?= $item['code'] ?></td></tr> 
                                        <tr><th class="th-detail-first">Model</th><td><?= $item['model_name'] ?></td></tr> 
                                        <tr><th class="th-detail-first">Sub Category</th><td><?= $item['sub_category'] ?></td></tr> 
                                    </tbody>                            
                                </table>
                            </div>
                            <div class="col-md-3">
                                <div class="item-image-box">
                                    <img src="<?= $image_path ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h2>GR History</h2>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-bordered" id="tbl-gr-history">
                                    <thead>
                                        <tr>
                                            <th class="text-center">GRN Number</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Location</th>
                                            <th class="text-center">Cost</th>
                                            <th class="text-center">Quantity <?= (strlen($item['unit_symbol']) > 0) ? ' (' . $item['unit_symbol'] . ')' : '' ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($grn_history as $row) {
                                            ?>
                                            <tr>
                                                <td><?= $row['ref_number'] ?></td>
                                                <td><?= $row['date'] ?></td>
                                                <td><?= $row['location_name'] ?></td>
                                                <td class="text-right"><?= number_format($row['item_cost'], 2) ?></td>
                                                <td class="text-right"><?= number_format($row['item_qty'], 2) ?></td>
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
        </div><!-- Row -->
        <script>
            $(function () {
                $('#tbl-gr-history').DataTable({"order": [[1, 'desc']]});
            });
        </script>