<?php
$this->load->view('admin/includes/side_bar');
?>
<div class="page-inner">
    <div class="page-title">
        <h3>Suppliers</h3>
         <button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#supplierModal" onclick="prepare_form('supplierModal', 'Suppliers', 'btn-supplier', add_supplier, true, null);"><i class="fa fa-plus"></i> Add Supplier</button>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Suppliers</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
       
        <div class="table-responsive">
            <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Telephone</th>
                        <th>Email</th>
                        <th>Contact Person</th>
                        <th>Category</th>
                        <th>Created On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Telephone</th>
                        <th>Email</th>
                        <th>Contact Person</th>
                        <th>Category</th>
                        <th>Created On</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($suppliers as $supplier) {
                        $business_tz = new DateTimeZone(LOCAL_TIME_ZONE);
                        $created_on = new DateTime($supplier['created_on'], new DateTimeZone('GMT'));
                        $created_on->setTimezone($business_tz);
                        $created_on_time = $created_on->format('Y-m-d H:ia');

                        $del_open = $del_close = '';
                        if ($supplier['enabled'] == 0) {
                            $del_open = '<del>';
                            $del_close = '</del>';
                        }
                        echo '<tr>';
                        echo '<input type="hidden"  class="table_id" value="' . $supplier['id'] . '" />';
                        echo '<input type="hidden" class="table_name" value="' . $supplier['name'] . '" />';
                        echo '<input type="hidden" class="table_email" value="' . $supplier['email'] . '" />';
                        echo '<input type="hidden"  class="table_phone" value="' . $supplier['phone'] . '" />';
                        echo '<input type="hidden" class="table_mobile" value="' . $supplier['mobile'] . '" />';
                        echo '<input type="hidden" class="table_fax" value="' . $supplier['fax'] . '" />';
                        echo '<input type="hidden" class="table_contact_person" value="' . $supplier['contact_person'] . '" />';
                        echo '<input type="hidden" class="table_address" value="' . $supplier['address'] . '" />';
                        echo '<input type="hidden" class="table_category" value="' . $supplier['category'] . '" />';

                        echo '<input type="hidden" class="table_category_name" value="' . $supplier['category_name'] . '" />';
                        echo '<td>' . $del_open . $supplier['name'] . $del_close . '</td>';
                        echo '<td>' . $del_open . $supplier['mobile'] . $del_close . '</td>';
                        echo '<td>' . $del_open . $supplier['phone'] . $del_close . '</td>';
                        echo '<td>' . $del_open . $supplier['email'] . $del_close . '</td>';
                        echo '<td>' . $del_open . $supplier['contact_person'] . $del_close . '</td>';
                        echo '<td>' . $del_open . $supplier['category_name'] . $del_close . '</td>';
                        echo '<td>' . $del_open . date('Y-m-d h:i a', strtotime($supplier['created_on'])) . $del_close . '</td>';
                        echo '<td>';
                        if ($supplier['enabled'] == 1) {
                            echo '<button type="button" class="btn btn-warning btn-xs" title="Edit" data-toggle="modal" data-target="#supplierModal" onclick="prepare_form(\'supplierModal\', \'Suppliers\', \'btn-supplier\', edit_supplier, false, supplier_populate,$(this).closest(\'tr\'));"><i class="fa fa-pencil"></i></button>';
                        } else {
                            echo '<button type="button" class="btn btn-warning btn-xs" title="Edit" onclick="show_message(45, \'' . $this->config->item(45, 'msg') . '\', null, false, \'' . APP_NAME . ' Update\');"><i class="fa fa-pencil"></i></button>';
                        }

                        $enable_title = 'Disable';
                        $btn_class = 'btn-danger';
                        $enable_class = 'fa-times';
                        if ($supplier['enabled'] == 0) {
                            $enable_title = 'Enable';
                            $btn_class = 'btn-success';
                            $enable_class = 'fa-check';
                            $status_msg_id = 594;
                        } else {
                            $status_msg_id = 595;
                        }
                        echo '<button type="button" class="btn btn-xs status-toggle ' . $btn_class . '" title="' . $enable_title . '" onclick="show_confirmation(' . $status_msg_id . ', messages[' . $status_msg_id . '], null, \'supplier\', ' . $supplier['id'] . ', supplier_status_success, supplier_status_fail);"><i class="fa ' . $enable_class . '"></i></button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>  
        </div>
        <!-- Brand Modal -->
        <div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header form-modal-header">
                        <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <form action=""  id="supplier-form" >
                            <input type="hidden" name="hidden-id" id="hidden-id"/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name"> Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email"> Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telephone">Telephone Number</label>
                                        <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Enter telephone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number</label>
                                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile Number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fax">Fax Number</label>
                                        <input type="text" class="form-control" id="fax" name="fax" placeholder="Enter Fax Number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_person">Contact Person</label>
                                        <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Enter Contact Person">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Supplier Type</label>
                                        <select class="form-control" id="category" name="category" required="true">
                                            <option disabled="disabled" selected="selected">Select Type</option>
                                            <?php
                                            foreach ($categories as $category) {
                                                ?>
                                                <option value="<?= $category['id']; ?>"><?= $category['type_name']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="btn-supplier"></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Brand Modal -->
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
                brandTable = $('#example').DataTable({});

            });
            const BASEURL = '<?= base_url() ?>';

            $('#supplierModal').on('hidden.bs.modal', function () {
                $('#supplier-form').trigger("reset");
            });
        </script>
