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
        <h3>Orders</h3>
<!--        <button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#supplierModal" onclick="prepare_form('supplierModal', 'Suppliers', 'btn-supplier', add_supplier, true, null);"><i class="fa fa-plus"></i> Add Supplier</button>-->
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Order</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">

        <div class="table-responsive">
            <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Order Date</th>
                        <th>Customer Name</th>
                        <th>City</th>
                        <th>Mobile</th>
                        <th>Order Age</th>
                        <th class="text-center">Order Status</th>
                        <th class="text-center">Is Invoice</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Order Number</th>
                        <th>Order Date</th>
                        <th>Customer Name</th>
                        <th>City</th>
                        <th>Mobile</th>
                        <th>Age</th>
                        <th class="text-center">Order Status</th>
                        <th class="text-center">Invoice Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($orders as $order) {
                        $datetime = new DateTime($order['created_on']);
                        $datetime->format('Y-m-d H:i:s');
                        $business_time_zone = new DateTimeZone(BUSINESS_TIME_ZONE);
                        $datetime->setTimezone($business_time_zone);
                        $created_on_time = $datetime->format('Y-m-d');

                        $del_open = $del_close = '';
                        if ($order['enabled'] == 0) {
                            $del_open = '<del>';
                            $del_close = '</del>';
                        }
                        echo '<tr>';
                        echo '<input type="hidden"  class="table_id" value="' . $order['id'] . '" />';
                        echo '<input type="hidden" class="table_order_number" value="' . $order['order_number'] . '" />';
                        echo '<input type="hidden" class="table_first_name" value="' . $order['first_name'] . '" />';
                        echo '<input type="hidden"  class="table_last_name" value="' . $order['last_name'] . '" />';
                        echo '<input type="hidden"  class="table_address" value="' . $order['shipping_details']['address'] . '" />';
                        echo '<input type="hidden"  class="table_city" value="' . $order['shipping_details']['city'] . '" />';
                        echo '<input type="hidden"  class="table_country" value="' . $order['shipping_details']['country'] . '" />';
                        if (!empty($order['prescription_details'])) {
                            echo '<input type="hidden"  class="table_pre_id" value="' . $order['prescription_details']['id'] . '" />';
                            echo '<input type="hidden"  class="table_pre_order_id" value="' . $order['prescription_details']['order_id'] . '" />';
                            echo '<input type="hidden"  class="table_pre_right_cyl" value="' . $order['prescription_details']['right_cyl'] . '" />';
                            echo '<input type="hidden"  class="table_pre_right_sph" value="' . $order['prescription_details']['right_sph'] . '" />';
                            echo '<input type="hidden"  class="table_pre_right_axis" value="' . $order['prescription_details']['right_axis'] . '" />';
                            echo '<input type="hidden"  class="table_pre_left_cyl" value="' . $order['prescription_details']['left_cyl'] . '" />';
                            echo '<input type="hidden"  class="table_pre_left_sph" value="' . $order['prescription_details']['left_sph'] . '" />';
                            echo '<input type="hidden"  class="table_pre_left_axis" value="' . $order['prescription_details']['left_axis'] . '" />';
                            echo '<input type="hidden"  class="table_pre_distance_pd" value="' . $order['prescription_details']['distance_pd'] . '" />';
                            echo '<input type="hidden"  class="table_pre_distance_lence_type" value="' . $order['prescription_details']['distance_lence_type'] . '" />';
                            echo '<input type="hidden"  class="table_pre_near_right" value="' . $order['prescription_details']['near_right'] . '" />';
                            echo '<input type="hidden"  class="table_pre_near_left" value="' . $order['prescription_details']['near_left'] . '" />';
                            echo '<input type="hidden"  class="table_pre_near_pd" value="' . $order['prescription_details']['near_pd'] . '" />';
                            echo '<input type="hidden"  class="table_pre_near_lens_type" value="' . $order['prescription_details']['near_lens_type'] . '" />';
                            echo '<input type="hidden"  class="table_pre_image" value="' . $order['prescription_details']['image_file'] . '" />';
                        }

                        echo '<td>' . $del_open . $order['order_number'] . $del_close . '</td>';
                        echo '<td>' . $del_open . $created_on_time . $del_close . '</td>';
                        echo '<td>' . $del_open . $order['first_name'] . ' ' . $order['last_name'] . $del_close . '</td>';
                        echo '<td>' . $del_open . $order['city'] . $del_close . '</td>';
                        echo '<td>' . $del_open . $order['mobile_phone'] . $del_close . '</td>';

                        echo '<td>' . $del_open . $this->uti->get_time_age($order['created_on'], BUSINESS_TIME_ZONE) . $del_close . '</td>';
                        echo '<td class="text-center">' . $del_open . $order['order_status'] . $del_close . '</td>';
                        echo '<td class="text-center">' . $del_open . $order['invoice_status'] . $del_close . '</td>';
                        echo '<td class="text-left">';
                        echo '<a href="' . base_url() . 'order/order_card/' . $order['key'] . '" target="_BLANK"><button type="button" class="btn btn-xs btn-primary status-toggle view_order_card" title="View Order Card"><i class="fa fa-search"></i></button></a>';

                        echo '<button type="button" class="btn btn-xs btn-info status-toggle view_shipping_details" title="View Shipping Details"><i class="fa fa-shipping-fast"></i></button>';
                        if (!empty($order['prescription_details'])) {
                            echo '<button type="button" class="btn btn-xs btn-warning status-toggle view_prescription_details" title="View Prescription Details"><i class="fa fa-file"></i></button>';
                        }
                        $enable_title = 'Disable';
                        $btn_class = 'btn-danger';
                        $enable_class = 'fa-times';
                        if ($order['enabled'] == 0) {
                            $enable_title = 'Enable';
                            $btn_class = 'btn-success';
                            $enable_class = 'fa-check';
                            $status_msg_id = 594;
                        } else {
                            $status_msg_id = 595;
                        }
                        //echo '<button type="button" class="btn btn-xs status-toggle ' . $btn_class . '" title="' . $enable_title . '" onclick="show_confirmation(' . $status_msg_id . ', messages[' . $status_msg_id . '], null, \'supplier\', ' . $order['id'] . ', supplier_status_success, supplier_status_fail);"><i class="fa ' . $enable_class . '"></i></button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>  
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
        <div class="modal fade" id="prescriptionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1500;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header form-modal-header">
                        <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Prescription Details</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered prescription-table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Distance</th>
                                            <th>Near</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Left</td>
                                            <td>
                                                <table class="table table-bordered prescription-table">
                                                    <thead>
                                                        <tr>
                                                            <th>SPH</th>
                                                            <th>CYL</th>
                                                            <th>AXIS</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><span id="left_sph"></span></td>
                                                            <td><span id="left_cyl"></span></td>
                                                            <td><span id="left_axis"></span></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </td>
                                            <td><span id="near_right"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Right</td>
                                            <td>
                                                <table class="table table-bordered prescription-table">
                                                    <thead>
                                                        <tr>
                                                            <th>SPH</th>
                                                            <th>CYL</th>
                                                            <th>AXIS</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><span id="right_sph"></span></td>
                                                            <td><span id="right_cyl"></span></td>
                                                            <td><span id="right_axis"></span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td><span id="near_left"></span></td>
                                        </tr>
                                        <tr>
                                            <td>PD</td>
                                            <td><span id="distance_pd"></span></td>
                                            <td><span id="near_pd"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Lens Type</td>
                                            <td><span id="distance_lenstype"></span></td>
                                            <td><span id="near_lenstype"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Prescription Image:</label>
                                    <div id="pre_image"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>


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

            Dropzone.autoDiscover = false;
            var myDropzone;
            var bradTable;
            var parsley_brand_form;
            $(function () {
                parsley_supplier_form = $('#supplier-form');
                parsley_supplier_form.parsley();
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

            $('.view_prescription_details').click(function () {
                view_prescription_details($(this));
            });

            function view_prescription_details(al) {
                var left_cyl = al.closest('tr').find('.table_pre_left_cyl').val();
                var left_sph = al.closest('tr').find('.table_pre_left_sph').val();
                var left_axis = al.closest('tr').find('.table_pre_left_axis').val();
                var right_cyl = al.closest('tr').find('.table_pre_right_cyl').val();
                var right_sph = al.closest('tr').find('.table_pre_right_sph').val();
                var right_axis = al.closest('tr').find('.table_pre_right_axis').val();
                var distance_pd = al.closest('tr').find('.table_pre_distance_pd').val();
                var distance_lence_type = al.closest('tr').find('.table_pre_distance_lence_type').val();
                var near_right = al.closest('tr').find('.table_pre_near_right').val();
                var near_left = al.closest('tr').find('.table_pre_near_left').val();
                var near_pd = al.closest('tr').find('.table_pre_near_pd').val();
                var near_lens_type = al.closest('tr').find('.table_pre_near_lens_type').val();
                var image_file = al.closest('tr').find('.table_pre_image').val();

                $('#left_cyl').text(left_cyl);
                $('#left_sph').text(left_sph);
                $('#left_axis').text(left_axis);
                $('#right_sph').text(right_sph);
                $('#right_cyl').text(right_cyl);
                $('#right_axis').text(right_axis);
                $('#distance_pd').text(distance_pd);
                $('#distance_lenstype').text(distance_lence_type);
                $('#near_right').text(near_right);
                $('#near_left').text(near_left);
                $('#near_pd').text(near_pd);
                $('#near_lenstype').text(near_lens_type);
                if (image_file != "") {
                    $('#pre_image').html('<img src="' + BASEURL + 'public/runningimages/prescription/' + image_file + '" width="400"/><a href="' + BASEURL + 'public/runningimages/prescription/' + image_file + '" target="_BLANK"><button class="btn btn-success pull-right" style="margin-top:20px;">View</button></a>');
                } else {
                    $('#pre_image').html('');
                }
                $('#prescriptionModal').modal('show');
            }

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
