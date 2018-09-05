<?php
$this->load->view('admin/includes/side_bar');
?>
<div class="page-inner">
    <div class="page-title">
        <h3>Branch</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Branch</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <button type="button" class="btn btn-success btn-addon m-b-sm" data-toggle="modal" data-target="#branchModal" onclick="prepare_form('branchModal', 'Branch', 'btn-branch', add_branch, true, null);"><i class="fa fa-plus"></i> Add Branch</button>
        <div class="table-responsive">
            <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>City</th>
                        <th>Telephone</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>City</th>
                        <th>telephone</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($branches as $branch) {
                        $del_open = $del_close = '';
                        if ($branch['enabled'] == 0) {
                            $del_open = '<del>';
                            $del_close = '</del>';
                        }
                        echo '<tr>';
                        echo '<input type="hidden" name="table_branch_id" class="table_branch_id" value="' . $branch['id'] . '" />';
                        echo '<input type="hidden" name="table_branch_name" class="table_branch_name" value="' . $branch['name'] . '" />';
                        echo '<input type="hidden" name="table_branch_address1" class="table_branch_address1" value="' . $branch['address1'] . '" />';
                        echo '<input type="hidden" name="table_branch_address2" class="table_branch_address2" value="' . $branch['address2'] . '" />';
                        echo '<input type="hidden" name="table_branch_email" class="table_branch_email" value="' . $branch['email'] . '" />';
                        echo '<input type="hidden" name="table_branch_telephone" class="table_branch_telephone" value="' . $branch['telephone'] . '" />';
                        echo '<input type="hidden" name="table_branch_city" class="table_branch_city" value="' . $branch['city'] . '" />';
                        echo '<input type="hidden" name="table_branch_latitude" class="table_branch_latitude" value="' . $branch['Latitude'] . '" />';
                        echo '<input type="hidden" name="table_branch_longitude" class="table_branch_longitude" value="' . $branch['Longitude'] . '" />';
                        echo '<td>' . $del_open . $branch['name'] . $del_close . '</td>';
                        echo '<td>' . $del_open . $branch['city'] . $del_close . '</td>';
                        echo '<td>' . $del_open . $branch['telephone'] . $del_close . '</td>';
                        echo '<td>' . $del_open . $branch['email'] . $del_close . '</td>';
                        echo '<td>';
                        if ($branch['enabled'] == 1) {
                            echo '<button type="button" class="btn btn-warning btn-xs" title="Edit" data-toggle="modal" data-target="#branchModal" onclick="prepare_form(\'branchModal\', \'Branch\', \'btn-branch\', edit_branch, false, branch_populate,$(this).closest(\'tr\'));"><i class="fa fa-pencil"></i></button>';
                        } else {
                            echo '<button type="button" class="btn btn-warning btn-xs" title="Edit" onclick="show_message(45, \''.$this->config->item(45, 'msg').'\', null, false, \'' . APP_NAME . ' Update\');"><i class="fa fa-pencil"></i></button>';
                        }

                        $enable_title = 'Disable';
                        $btn_class = 'btn-danger';
                        $enable_class = 'fa-times';
                        if ($branch['enabled'] == 0) {
                            $enable_title = 'Enable';
                            $btn_class = 'btn-success';
                            $enable_class = 'fa-check';
                            $status_msg_id = 404;
                        } else {
                            $status_msg_id = 405;
                        }
                        echo '<button type="button" class="btn btn-xs status-toggle ' . $btn_class . '" title="' . $enable_title . '" onclick="show_confirmation(' . $status_msg_id . ', messages[' . $status_msg_id . '], null, \'branch\', ' . $branch['id'] . ', branch_status_success, branch_status_fail);"><i class="fa ' . $enable_class . '"></i></button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>  
        </div>
        <!-- Brand Modal -->
        <div class="modal fade" id="branchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header form-modal-header">
                        <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <form action=""  id="branch-form" >
                            <input type="hidden" name="hidden-branchid" id="hidden-branchid"/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="branch_name">Branch Name</label>
                                        <input type="text" class="form-control" id="branch_name" name="branch_name" placeholder="Enter branch Name" required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="branch_telephone">Telephone Number</label>
                                        <input type="text" class="form-control" id="branch_telephone" name="branch_telephone" placeholder="Enter branch telephone" required="true">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="branch_address1">Branch Address 1</label>
                                        <input type="text" class="form-control" id="branch_address1" name="branch_address1" placeholder="Enter branch address 1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="branch_address2">Branch Address 2</label>
                                        <input type="text" class="form-control" id="branch_address2" name="branch_address2" placeholder="Enter branch address 2">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="branch_city">City</label>
                                        <input type="text" class="form-control" id="branch_city" name="branch_city" placeholder="Enter branch city">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="branch_email">Branch Email</label>
                                        <input type="email" class="form-control" id="branch_email" name="branch_email" placeholder="Enter branch email" required="true">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="branch_latitude">Latitude</label>
                                        <input type="text" class="form-control" id="branch_latitude" name="branch_latitude" placeholder="Enter branch latitude">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="branch_longitude">Longitude</label>
                                        <input type="text" class="form-control" id="branch_longitude" name="branch_longitude" placeholder="Enter branch longitude">
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="btn-branch"></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Brand Modal -->
        <script src="<?= base_url('public/') ?>js/admin/branch.js"></script>

        <script>
            var messages = [];
            messages[400] = '<?= $this->config->item(400, 'msg') ?>';
            messages[401] = '<?= $this->config->item(401, 'msg') ?>';
            messages[402] = '<?= $this->config->item(402, 'msg') ?>';
            messages[403] = '<?= $this->config->item(403, 'msg') ?>';
            messages[404] = '<?= $this->config->item(404, 'msg') ?>';
            messages[405] = '<?= $this->config->item(405, 'msg') ?>';
            messages[43] = '<?= $this->config->item(43, 'msg') ?>';
            messages[44] = '<?= $this->config->item(44, 'msg') ?>';

            Dropzone.autoDiscover = false;
            var myDropzone;
            var bradTable;
            var parsley_brand_form;
            $(function () {
                parsley_branch_form = $('#branch-form');
                parsley_branch_form.parsley();
                brandTable = $('#example').DataTable({});

            });
            const BASEURL = '<?= base_url() ?>';
        </script>
