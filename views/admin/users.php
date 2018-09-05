<?php
$this->load->view('admin/includes/side_bar');
?>
<div class="page-inner">
    <div class="page-title">
        <h3>Users</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Users</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <button type="button" class="btn btn-success btn-addon m-b-sm" data-toggle="modal" data-target="#userModal" onclick="prepare_form('userModal', 'User', 'btn-user', add_user, true, null);"><i class="fa fa-plus"></i> Add User</button>
        <div class="table-responsive">
            <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>User Type</th>
                        <th>Created By</th>
                        <th>Created On</th>
                        <th>Updated By</th>
                        <th>Updated On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>User Type</th>
                        <th>Created By</th>
                        <th>Created On</th>
                        <th>Updated By</th>
                        <th>Updated On</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($users as $user) {
                        $del_open = $del_close = '';
                        if ($user['enabled'] == 0) {
                            $del_open = '<del>';
                            $del_close = '</del>';
                        }
                        echo '<tr>';
                        echo '<input type="hidden" class="table_user_id" value="' . $user['id'] . '" />';
                        echo '<input type="hidden" class="table_user_type" value="' . $user['sed_sys_user_type'] . '" />';
                        echo '<input type="hidden" class="table_user_name" value="' . $user['name'] . '" />';
                        echo '<input type="hidden" class="table_user_username" value="' . $user['username'] . '" />';
                        echo '<input type="hidden" class="table_user_recovery_phone" value="' . $user['recovery_phone'] . '" />';
                        echo '<input type="hidden" class="table_recovery_mail" value="' . $user['recovery_email'] . '" />';

                        echo '<td>' . $del_open . $user['name'] . $del_close . '</td>';
                        echo '<td>' . $del_open . $user['username'] . $del_close . '</td>';
                        echo '<td>' . $del_open . $user['type_name'] . $del_close . '</td>';
                        echo '<td>' . $del_open . $user['created_user'] . $del_close . '</td>';
                        echo '<td>' . $del_open . date('Y-m-d H:ia', strtotime($user['created_on'])) . $del_close . '</td>';
                        echo '<td>' . $del_open . $user['updated_user'] . $del_close . '</td>';
                        echo '<td>' . $del_open . date('Y-m-d H:ia', strtotime($user['lastupdated_on'])) .$del_close .  '</td>';
                        echo '<td>';
                        if ($user['enabled'] == 1) {
                            echo '<button type="button" class="btn btn-warning btn-xs" title="Edit" data-toggle="modal" data-target="#userModal" onclick="prepare_form(\'userModal\', \'User\', \'btn-user\', edit_user, false, user_populate,$(this).closest(\'tr\'));"><i class="fa fa-pencil"></i></button>';
                        } else {
                            echo '<button type="button" class="btn btn-warning btn-xs" title="Edit" onclick="show_message(45, \'' . $this->config->item(45, 'msg') . '\', null, false, \'' . APP_NAME . ' Update\');"><i class="fa fa-pencil"></i></button>';
                        }
                        $enable_title = 'Disable';
                        $btn_class = 'btn-danger';
                        $enable_class = 'fa-times';
                        if ($user['enabled'] == 0) {
                            $enable_title = 'Enable';
                            $btn_class = 'btn-success';
                            $enable_class = 'fa-check';
                            $status_msg_id = 170;
                        } else {
                            $status_msg_id = 171;
                        }
                        echo '<button type="button" class="btn btn-xs status-toggle ' . $btn_class . '" title="' . $enable_title . '" onclick="show_confirmation(' . $status_msg_id . ', messages[' . $status_msg_id . '], null, \'sed_sys_user\', ' . $user['id'] . ', enable_user_success, enable_user_fail);"><i class="fa ' . $enable_class . '"></i></button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>  
        </div>
        <!-- Brand Modal -->
        <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1500;" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header form-modal-header">
                        <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <form action=""  id="user-form" >
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" id="hidden_id" name="hidden_id" />
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="brand_name">Username</label>
                                        <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter username" required="true">
                                    </div>
                                </div>
                                <div class="col-md-6 password-class">
                                    <div class="form-group">
                                        <label for="password1">Password</label>
                                        <input type="password" class="form-control" id="password1" name="password1" placeholder="Enter Password" required="true">
                                    </div>
                                </div>
                                <div class="col-md-6 password-class">
                                    <div class="form-group">
                                        <label for="password2">Re-type Password</label>
                                        <input type="password" class="form-control" id="password2" name="password2" parsley-equalto="#password1" placeholder="Re-type Password" required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_type">User Type</label>
                                        <select class="form-control" id="user_type" name="user_type" required="true">
                                            <?php
                                            foreach ($user_types as $type) {
                                                echo "<option value='" . $type['id'] . "'>" . $type['type_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="recovery_email">Recovery Email </label>&nbsp;&nbsp;<span data-toggle="tooltip" data-placement="top" title="<?= $this->config->item(153, 'msg') ?>"><i class="glyphicon glyphicon-question-sign"></i></span>
                                        <input type="email" class="form-control" id="recovery_email" name="recovery_email" placeholder="Enter Recovey Email Address" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="recovery_phone">Recovery Phone</label>&nbsp;&nbsp;<span data-toggle="tooltip" data-placement="top" title="<?= $this->config->item(154, 'msg') ?>"><i class="glyphicon glyphicon-question-sign"></i></span>
                                        <input type="text" class="form-control" id="recovery_phone" name="recovery_phone" placeholder="Recovery Phone Number" >
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="btn-user"></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Brand Modal -->
        <script src="<?= base_url('public/') ?>js/admin/users.js"></script>
        <script>
            var messages = [];
            messages[1000] = '<?= $this->config->item(1000, 'msg') ?>';
            messages[1001] = '<?= $this->config->item(1001, 'msg') ?>';
            messages[1002] = '<?= $this->config->item(1002, 'msg') ?>';
            messages[1003] = '<?= $this->config->item(1003, 'msg') ?>';
            messages[1004] = '<?= $this->config->item(1004, 'msg') ?>';
            messages[1005] = '<?= $this->config->item(1005, 'msg') ?>';
            messages[150] = '<?= $this->config->item(150, 'msg') ?>';
            messages[151] = '<?= $this->config->item(151, 'msg') ?>';
            messages[152] = '<?= $this->config->item(152, 'msg') ?>';
            messages[155] = '<?= $this->config->item(155, 'msg') ?>';
            messages[156] = '<?= $this->config->item(156, 'msg') ?>';
            messages[170] = '<?= $this->config->item(170, 'msg') ?>';
            messages[171] = '<?= $this->config->item(171, 'msg') ?>';
            var bradTable;
            Dropzone.autoDiscover = false;
            var myDropzone;
            var bradTable;
            var parsley_user_form;
            $(function () {
                parsley_user_form = $('#user-form');
                parsley_user_form.parsley();
                brandTable = $('#example').DataTable({});
            });
            const BASEURL = '<?= base_url() ?>';
        </script>
