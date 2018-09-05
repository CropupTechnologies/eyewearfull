<style>
    .prescription-table td,.prescription-table th {
        vertical-align: middle !important;
        text-align: center;
    }
</style>
<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="col-md-12 back-btn-panel">
            <button type="button" onclick="window.history.back();" class="btn btn-success btn-back"><i class="fa fa-chevron-left"></i> Back</button>
        </div>
    </div>
</div>
<div class="page-inner">
    <div class="page-title">
        <h3>Payment Process</h3>
<!--        <button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#supplierModal" onclick="prepare_form('supplierModal', 'Suppliers', 'btn-supplier', add_supplier, true, null);"><i class="fa fa-plus"></i> Add Supplier</button>-->
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Payment Process</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h2 class="panel-title">Invoice Details</h2>
                    </div>
                    <div class="panel-body">
                        <?php
                        $tax_amount = 0;
                        $invoice_total = $invoice_details['amount'];
                        if (!empty($invoice_details['taxes'])) {
                            foreach ($invoice_details['taxes'] as $tax) {
                                $tax_amount += $tax['tax_amount'];
                            }
                            $invoice_total = $invoice_details['amount'] + $tax_amount;
                        }
                        ?>
                        <h4>Invoice Code&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;<span><?= $invoice_details['invoice_code'] ?></span></h4>
                        <h4>Invoice Amount&nbsp;: &nbsp;&nbsp;<span><?= DEFAULT_CURRENCY . ' ' . number_format($invoice_total, 2) ?></span></h4>
                        <h4>Order Number&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;<span><?= $invoice_details['order_number'] ?></span></h4>
                    </div>
                </div>
            </div>
            <?php
            $total_payment = 0;
            if (!empty($invoice_details['payment_details'])) {
                ?>
                <div class="col-md-12">
                    <div class="panel panel-white">
                        <div class="panel-heading clearfix">
                            <h3 class="panel-title">Payment Details</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                    <thead>
                                        <tr>
                                            <th>Payment Reference</th>
                                            <th class="text-center">Payment Date</th>
                                            <th class="text-center">Mode of Payment</th>
                                            <th class="text-right">Payment Amount</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Payment Reference</th>
                                            <th class="text-center">Payment Date</th>
                                            <th class="text-center">Mode of Payment</th>
                                            <th class="text-right">Payment Amount</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        foreach ($invoice_details['payment_details'] as $payment) {
                                            $date = new DateTime($payment['created_on'], new DateTimeZone(SERVER_TIME_ZONE));
                                            $date->setTimezone(new DateTimeZone(LOCAL_TIME_ZONE));
                                            $time = $date->format('Y-m-d');

                                            echo '<tr>';
                                            echo '<td>' . $payment['payment_reference'] . '</td>';
                                            echo '<td class="text-center">' . $time . '</td>';
                                            echo '<td class="text-center">' . $payment['mode_of_payment'] . '</td>';
                                            echo '<td class="text-right">' . DEFAULT_CURRENCY . ' ' . number_format($payment['amount'], 2) . '</td>';
                                            $total_payment += $payment['amount'];
                                             echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>  
                            </div>
                        </div>
                    </div>

                </div>
                <?php
            }
            ?>
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <form action="<?= base_url('payments/payment_process_next') ?>" method="post">
                            <div class="col-md-4">
                                <label class="control-label">Mode of Payment</label>
                                <select class="form-control m-b-sm" name="mode_of_payment">
                                    <?php
                                    foreach ($mode_of_payments as $mode) {
                                        ?>
                                        <option value="<?= $mode['id'] ?>"><?= $mode['name'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-offset-4 col-md-4">
                                <h4>Invoice Amount  <span style="float:right;"><?= DEFAULT_CURRENCY . ' ' . number_format($invoice_total, 2); ?></span></h4>
                                <h4>Paid Amount  <span style="float:right;"><?= DEFAULT_CURRENCY . ' ' . number_format($total_payment, 2); ?></span></h4>
                                <?php
                                $total_payable = $invoice_total - $total_payment;
                                ?>
                                <hr>
                                <h4>Total Payable  <span style="float:right;"><?= DEFAULT_CURRENCY . ' ' . number_format($total_payable, 2); ?></span></h4>
                                <hr>
                            </div>

                            <input type="hidden" name="invoice_id" value="<?= $invoice_details['id'] ?>">
                            <input type="hidden" name="total_payable" value="<?= $total_payable ?>">
                            <button type="submit" class="btn btn-success m-b-sm pull-right" name="payment_process">Next &nbsp;<i class="fa fa-arrow-right"></i></button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <script src="<?= base_url('public/') ?>js/admin/supplier.js"></script>

        <script>
            brandTable = $('#example').DataTable({});
        </script>
