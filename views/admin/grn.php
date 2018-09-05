<?php
$this->load->view('admin/includes/side_bar');
$message = $this->session->flashdata('message');
if (isset($message) && $message != NULL) {
    ?>
    <script>
        $(function () {
            show_message(<?= $message[0] ?>, '<?= $message[1] ?>', null, false, 'Manage Items');
        });
    </script>
    <?php
}
?>
<div class="page-inner">
    <div class="page-title">
        <h3>Goods Receive Notes</h3>
        <button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" onclick="window.location.href = '<?= base_url('item/add_grn_view') ?>'" ><i class="fa fa-plus"></i> Add GRN</button>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">GRNs</li>
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
                                <div class="table-responsive">
                                    <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>Reference No.</th>
                                                <th>Supplier</th>
                                                <th>Date</th>
                                                <th>Created By</th>
                                                <th>Created On</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Reference No.</th>
                                                <th>Supplier</th>
                                                <th>Date</th>
                                                <th>Created By</th>
                                                <th>Created On</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            if (isset($grns) && $grns != FALSE) {
                                                foreach ($grns as $grn) {
                                                    $del_open = $del_close = '';
                                                    $enable_message = 610;
                                                    $enable_title = 'Disable';
                                                    $btn_class = 'btn-danger';
                                                    $enable_class = 'fa-times';
                                                    if ($grn['enabled'] == 0) {
                                                        $del_open = '<del>';
                                                        $del_close = '</del>';
                                                        $enable_message = 609;
                                                        $enable_title = 'Enable';
                                                        $btn_class = 'btn-success';
                                                        $enable_class = 'fa-check';
                                                    }
                                                    ?>
                                                    <tr>
                                                <input type="hidden" class="tr-item-id"   value="<?= $grn['id'] ?>"/>
                                                <td><?= $del_open . $grn['ref_number'] . $del_close ?></td>
                                                <td><?= $del_open . $grn['supplier_name'] . $del_close ?></td>
                                                <td><?= $del_open . $grn['date'] . $del_close ?></td>
                                                <td><?= $del_open . $grn['created_user'] . $del_close ?></td>
                                                <td><?= $del_open . date('Y-m-d H:i a', strtotime($grn['created_on'])) . $del_close ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-xs" title="Details" onclick="window.location.href = '<?= base_url('item/grn_details/' . $grn['id']) ?>'"><i class="fa fa-search"></i></button>
                                                    <button type="button" class="btn btn-xs status-toggle <?= $btn_class ?>" title="<?= $enable_title ?>" onclick="show_confirmation(<?= $enable_message ?>, messages[<?= $enable_message ?>], null, 'grn', '<?= $grn['id'] ?>', on_enable_grn_success, on_enable_grn_fail);"><i class="fa <?= $enable_class ?>"></i></button>
                                                </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>                          
                                        </tbody>
                                    </table>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Row -->

        <script>
            var messages = [];
            messages[43] = '<?= $this->config->item(43, 'msg') ?>';
            messages[44] = '<?= $this->config->item(44, 'msg') ?>';
            messages[609] = '<?= $this->config->item(609, 'msg') ?>';
            messages[610] = '<?= $this->config->item(610, 'msg') ?>';
            $(function () {
                $('#example').DataTable({
                    columnDefs: [
                        {width: 80, targets: 0},
                        {width: 400, targets: 1}
                    ]
                });
            });
            const BASEURL = '<?= base_url() ?>';

            function on_enable_grn_success() {
                show_message(43, messages[43], null, true, 'Update GRN');
            }

            function on_enable_grn_fail() {
                show_message(44, messages[44], null, true, 'Update GRN');
            }
        </script>
