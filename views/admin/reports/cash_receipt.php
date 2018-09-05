<?php
$this->load->view('admin/includes/side_bar');
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<style>
    .prescription-table td,.prescription-table th {
        vertical-align: middle !important;
        text-align: center;
    }
</style>
<div class="page-inner">
    <div class="page-title">
        <h3>Cash Receipts</h3>
<!--        <button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#supplierModal" onclick="prepare_form('supplierModal', 'Suppliers', 'btn-supplier', add_supplier, true, null);"><i class="fa fa-plus"></i> Add Supplier</button>-->
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Cash Receipts</li>
            </ol>
        </div>
    </div>
    <?php
    if ($to == null) {
        $to = date('Y-m-d');
    }
    if ($from == null) {
        $from = date('Y-m-d', strtotime("-1 month"));
    }
    ?>
    <div id="main-wrapper">
        <div class="panel panel-white">
            <div class="panel-body">
                <div class="row">
                    <form method="post" action="">
                        <input type="hidden" name="filter"/>
                        <div class="col-md-3">
                            <label>From</label>
                            <input type="text" class="form-control date-picker" name="fromDate" id="fromDate" value="<?= $from ?>"/>
                        </div>
                        <div class="col-md-3">
                            <label>To</label>
                            <input type="text" class="form-control date-picker" name="toDate" id="toDate" value="<?= $to ?>"/>
                        </div>
                        <div class="col-md-3">
                            <label>Mode of Payment</label>
                            <select name="mode_of_payment" id="mode_of_payment" class="form-control">
                                <option value="null">All</option>
                                <?php
                                foreach ($mode_of_payments as $mop) {
                                    ?>
                                    <option value="<?= $mop['id'] ?>" <?php
                                    if ($select_mop == $mop['id']) {
                                        echo 'selected="selected"';
                                    }
                                    ?>><?= $mop['name'] ?></option>
                                            <?php
                                        }
                                        ?>
                            </select>
                        </div>
                        <div class="col-md-3" style="margin-top:24px;">
                            <input type="submit" class="btn btn-success" value="Search"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="panel panel-white">
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                        <thead>
                            <tr>
                                <th>Receipt Ref</th>
                                <th class="text-center">Date</th>
                                <th>Invoice Ref</th>
                                <th class="text-right">Amount</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Receipt Ref</th>
                                <th class="text-center">Date</th>
                                <th>Invoice Ref</th>
                                <th class="text-right">Amount</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            foreach ($cash_receipts as $cash_receipts) {
                                $datetime = new DateTime($cash_receipts['created_on']);
                                $datetime->format('Y-m-d H:i:s');
                                $business_time_zone = new DateTimeZone(BUSINESS_TIME_ZONE);
                                $datetime->setTimezone($business_time_zone);
                                $created_on_time = $datetime->format('Y-m-d');

                                $del_open = $del_close = '';
                                if ($cash_receipts['enabled'] == 0) {
                                    $del_open = '<del>';
                                    $del_close = '</del>';
                                }
                                echo '<tr>';
                                echo '<td>' . $del_open . $cash_receipts['payment_reference'] . $del_close . '</td>';
                                echo '<td>' . $del_open . $created_on_time . $del_close . '</td>';
                                echo '<td>' . $del_open . $cash_receipts['invoice_code'] . $del_close . '</td>';
                                echo '<td class="text-right">' . $del_open . number_format($cash_receipts['amount'], 2) . $del_close . '</td>';
                                echo '<td class="text-center">';
                                //echo '<a href="#"><button type="button" class="btn btn-xs btn-primary status-toggle view_order_card" title="View Order Card"><i class="fa fa-search"></i></button></a>';
                                //echo '<button type="button" class="btn btn-xs btn-info status-toggle view_shipping_details" title="View Shipping Details"><i class="fa fa-shipping-fast"></i></button>';
                                //echo '<button type="button" class="btn btn-xs btn-warning status-toggle update_order" title="Update Order"><i class="fa fa-edit"></i></button>';

                                echo '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>

        <!--        shipping details modal-->

        <div class="modal fade" id="shippingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1500;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header form-modal-header">
                        <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Shipping Address</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Customer Name: </label> <span id="customer_name"></span>
                        </div>
                        <div class="form-group">
                            <label>Customer Address: </label> <span id="customer_address"></span>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>

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

            //            $('#toDate').datepicker({
            //                "setDate": new Date(),
            //                "autoclose": true
            //            });


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
