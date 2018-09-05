<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="col-md-12 back-btn-panel">
            <button type="button" onclick="window.history.back();" class="btn btn-success btn-back"><i class="fa fa-chevron-left"></i> Back</button>
        </div>
    </div>
</div>
<div class="page-inner">
    <div class="page-title">
        <h3>GRN Detail</h3>        
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">GRN Detail</li>
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
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr><th class="th-detail-first">Ref. Number</th><td><?= $grn['ref_number'] ?></td></tr> 
                                        <tr><th class="th-detail-first">Date</th><td><?= $grn['date'] ?></td></tr> 
                                        <tr><th class="th-detail-first">Supplier</th><td><?= $grn['supplier_name'] ?></td></tr> 
                                        <tr><th class="th-detail-first">Total Amount (Rs)</th><td><?= number_format($grn['total'],2) ?></td></tr> 
                                    </tbody>                            
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center">GRN Items</h4>
                                <table class="table table-striped" id="tbl-grn-items">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Item Code</th>
                                            <th class="text-center">Item Name</th>
                                            <th class="text-center">Cost</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Expiry Date</th>
                                            <th class="text-center">Selling Price</th>
                                            <th class="text-center">Stock In Hand</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">Item Code</th>
                                            <th class="text-center">Item Name</th>
                                            <th class="text-center">Cost</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Expiry Date</th>
                                            <th class="text-center">Selling Price</th>
                                            <th class="text-center">Stock In Hand</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            foreach ($grn['items'] as $item){
                                                ?>
                                        <tr>
                                            <td><?= $item['code'] ?></td>
                                            <td><?= $item['item_name'] ?></td>
                                            <td class="text-right"><?= number_format($item['item_cost'], 2) ?></td>
                                            <td class="text-right"><?= number_format($item['item_qty'], 2) ?></td>
                                            <td class="text-center"><?= ($item['expiry_date'] != '0000-00-00')?$item['expiry_date']:'' ?></td>
                                            <td class="text-right"><?= number_format($item['selling_price'], 2) ?></td>
                                            <td class="text-right"><?= number_format($item['stock_in_hand'], 2) ?></td>
                                            <td></td>
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
            $(function(){
                $('#tbl-grn-items').DataTable();
            });
            </script>