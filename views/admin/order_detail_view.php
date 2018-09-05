<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="col-md-12 back-btn-panel">
            <button type="button" onclick="window.history.back();" class="btn btn-success btn-back"><i class="fa fa-chevron-left"></i> Back</button>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<style>
    .prescription-table td,.prescription-table th {
        vertical-align: middle !important;
        text-align: center;
    }
</style>
<div class="page-inner">
    <div class="page-title">
        <h3>Order Details</h3>
<!--        <button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#supplierModal" onclick="prepare_form('supplierModal', 'Suppliers', 'btn-supplier', add_supplier, true, null);"><i class="fa fa-plus"></i> Add Supplier</button>-->
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Order Details</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="panel panel-white">
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <h4>Order Number</h4>
                    </div>
                    <div class="col-md-1">
                        <h4>:</h4>
                    </div>
                    <div class="col-md-3">
                        <h4><?= $order_details['order_number'] ?></h4>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-3">
                        <h4>Customer Name</h4>
                    </div>
                    <div class="col-md-1">
                        <h4>:</h4>
                    </div>
                    <div class="col-md-3">
                        <h4><?= $order_details['first_name'] ?> <?= $order_details['last_name'] ?></h4>
                    </div>
                </div>
                <?php
                if (!empty($order_details['shipping'])) {
                    ?>
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <h4>Customer Address</h4>
                        </div>
                        <div class="col-md-1">
                            <h4>:</h4>
                        </div>
                        <div class="col-md-6">
                            <h4><?= $order_details['shipping']['address'] ?>, <?= $order_details['shipping']['city'] ?>, <?= $order_details['shipping']['country'] ?></h4>
                        </div>
                    </div>
                    <?php
                }
                ?>

            </div>
        </div>
        <div class="panel panel-white">
            <div class="panel-body">
                <h3>Order Items</h3>
                <div class="table-responsive">
                    <table id="" class="display table" style="width: 100%; cellspacing: 0;">
                        <?php
                        if (!empty($order_details['items'])) {
                            $grand_total = 0;
                            $item_total = 0;
                            $tax_total = 0;
                            ?>
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th class="text-center">Item Qty</th>
                                    <th class="text-right">Item Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($order_details['items'] as $order_item) {
                                    ?>
                                    <tr>
                                        <td><?= $order_item['item_data']['name'] ?></td>
                                        <td class="text-center"><?= $order_item['qty'] ?></td>
                                        <td class="text-right"><?= number_format($order_item['each_price'], 2) ?></td>
                                    </tr>

                                    <?php
                                    $each_price = $order_item['each_price'];
                                    $qty = $order_item['qty'];
                                    $item_price = $each_price * $qty;
                                    $item_total += $item_price;
                                }
                                ?>

                            </tbody>
                            <tr>
                                <td></td>
                                <td class="text-right"><strong>Gross Total</strong></td>
                                <td class="text-right"><strong><?= number_format($item_total, 2) ?></strong></td>
                            </tr>
                            <?php
                            //Tax Calculation
                            if (!empty($order_details['taxes'])) {

                                foreach ($order_details['taxes'] as $tax) {
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td class="text-right"><?= $tax['tax_name'] ?></td>
                                        <td class="text-right"><?= number_format($tax['tax_amount'], 2) ?></td>
                                    </tr>
                                    <?php
                                    $tax_total += $tax['tax_amount'];
                                }
                            }
                            ?>
                            <?php
                            $grand_total = $tax_total + $item_total;
                            ?>
                            <tr>
                                <td></td>
                                <td class="text-right"><strong>Grand Total</strong></td>
                                <td class="text-right"><strong><?= number_format($grand_total, 2) ?></strong></td>
                            </tr>    
                            <?php
                        }
                        ?>
                    </table>  
                </div>
            </div>
        </div>
        <?php
        if (!empty($invoice_details)) {
            ?>
            <div class="panel panel-white">
                <div class="panel-body">
                    <h3>Order Invoice(s)</h3>
                    <div class="table-responsive">
                        <table id="" class="display table" style="width: 100%; cellspacing: 0;">
                            <thead>
                                <tr>
                                    <td>Invoice Ref</td>
                                    <td class="text-center">Date</td>
                                    <td class="text-center">Status</td>
                                    <td class="text-right">Amount</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($invoice_details as $invoice) {
                                    ?><tr>
                                        <td><?= $invoice['invoice_code'] ?></td>
                                        <td class="text-center"><?= date('Y-m-d', strtotime($invoice['created_on'])) ?></td>
                                        <td class="text-center"><?= $invoice['status'] ?></td>
                                        <td class="text-right"><?= number_format($grand_total, 2) ?></td>
                                    </tr>

                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <?php
        if (!empty($invoice_details)) {
            if (!empty($invoice_details[0]['payments'])) {
                ?>
                <div class="panel panel-white">
                    <div class="panel-body">
                        <h3>Payments</h3>
                        <div class="table-responsive">
                            <table id="" class="display table" style="width: 100%; cellspacing: 0;">
                                <thead>
                                    <tr>
                                        <td>Payment Ref</td>
                                        <td class="text-center">Date</td>
                                        <td class="text-center">Method</td>
                                        <td class="text-right">Amount</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($invoice_details[0]['payments'] as $payment) {
                                        ?><tr>
                                            <td><?= $payment['payment_reference'] ?></td>
                                            <td class="text-center"><?= date('Y-m-d', strtotime($payment['created_on'])) ?></td>
                                            <td class="text-center"><?= $payment['mode_of_payment'] ?></td>
                                            <td class="text-right"><?= number_format($payment['amount'], 2) ?></td>
                                        </tr>

                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>  
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>




        <!--        shipping details modal-->



        <!-- End: shipping Modal -->

        <script src="<?= base_url('public/') ?>js/admin/supplier.js"></script>

        <script>
                var messages = [];
                messages[590] = '<?= $this->config->item(590, 'msg') ?>';
                messages[591] = '<?= $this->config->item(591, 'msg') ?>';
                messages[592] = '<?= $this->config->item(592, 'msg') ?>';
                messages[593] = '<?= $this->config->item(593, 'msg') ?>';
                messages[594] = '<?= $this->config->item(594, 'msg') ?>';
                messages[595] = '<?= $this->config->item(595, 'msg') ?>';
                messages[43] = '<?= $this->config->item(43, 'msg') ?>';
                messages[44] = '<?= $this->config->item(44, 'msg') ?>';


                var bradTable;

                $(function () {
                    brandTable = $('#example').DataTable({
                        "order": [[1, "desc"]]
                    });

                });
                const BASEURL = '<?= base_url() ?>';

                $('#supplierModal').on('hidden.bs.modal', function () {
                    $('#supplier-form').trigger("reset");
                });

                $('.view_shipping_details').click(function () {
                    view_shipping_details($(this));
                });


                function view_shipping_details(el) {
                    var fname = el.closest('tr').find('.table_first_name').val();
                    var lname = el.closest('tr').find('.table_last_name').val();
                    var address = el.closest('tr').find('.table_address').val();
                    var city = el.closest('tr').find('.table_city').val();
                    var country = el.closest('tr').find('.table_country').val();
                    var name = fname + ' ' + lname;
                    var shipping_address = address + ' ' + city + ' ' + country;

                    $('#customer_name').text(name);
                    $('#customer_address').text(shipping_address);
                    $('#shippingModal').modal('show');

                }

                function order_card_view(el) {
                    var order_id = el.closest('tr').find('.table_id').val();
                    if (order_id > 0 && order_id != null) {
                        window.location.href = BASEURL + 'order/order_card/' + order_id;
                    }
                }
        </script>
