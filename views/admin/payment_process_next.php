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
        <h3>Payment Process Next</h3>
<!--        <button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#supplierModal" onclick="prepare_form('supplierModal', 'Suppliers', 'btn-supplier', add_supplier, true, null);"><i class="fa fa-plus"></i> Add Supplier</button>-->
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Payment Process Next</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title">Payment Details</h3>
                </div>
                <hr>
                <div class="panel-body">
                    <form class="form-horizontal" id="payment_details_form" action="<?= base_url('payments/payment_save'); ?>" method="post">
                        <input type="hidden" id="total_payable" name="total_payable" value="<?= $total_payable ?>"/>
                        <input type="hidden" id="mode_of_payment" name="mode_of_payment" value="<?= $mode_of_payment ?>"/>
                        <input type="hidden" id="invoice_id" name="invoice_id" value="<?= $invoice_id ?>"/>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Amount</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="amount" name="amount" required="required"/>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (!empty($fields)) {
                            foreach ($fields as $field) {
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 control-label"><?= $field['field_name'] ?></label>
                                        <div class="col-sm-8">
                                            <?= $field['html_content'] ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <div class="clearfix"></div>
                        <button type="button" class="btn btn-success m-b-sm pull-right pay-button" name="payment_process">Pay</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            var messages = [];
            messages[800] = '<?= $this->config->item(800, 'msg') ?>';
            messages[801] = '<?= $this->config->item(801, 'msg') ?>';

            $(document).ready(function () {
                $('.pay-button').click(function () {
                    $('#payment_details_form').parsley().validate();
                    if ($('#payment_details_form').parsley().isValid()) {
                        if (checkPayAmountValid()) {
                            $('#payment_details_form')[0].submit();
                        } else {
                            //show_message(800, messages[800]);
                        }
                    }
                });
            });


            function checkPayAmountValid() {
                payable = parseInt($('#total_payable').val());
                pay = parseInt($('#amount').val());
                if (pay != 0) {
                    if (pay <= payable) {
                        return true;
                    } else {
                        // pay amout greater than payable amount
                        show_message(800, messages[800]);
                        return false;
                    }
                } else {
                    // pay amout 0;
                    show_message(801, messages[801]);
                }


            }
        </script>