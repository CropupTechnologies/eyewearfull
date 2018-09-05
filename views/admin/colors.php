<?php
$this->load->view('admin/includes/side_bar');
?>
<link href="<?= base_url('public/css/admin/spectrum.css') ?>" rel="stylesheet" type="text/css"/>
<div class="page-inner">
    <div class="page-title">
        <h3>Colors</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Colors</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <button type="button" class="btn btn-success btn-addon m-b-sm" data-toggle="modal" data-target="#colorModal" onclick="prepare_form('colorModal', 'Color', 'btn-color', add_color, true, null);"><i class="fa fa-plus"></i> Add Color</button>
        <div class="table-responsive">
            <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Color</th>
                        <th>Shades</th>
                        <th>Style</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Color</th>
                        <th>Shades</th>
                        <th>Style</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($colors as $color) {
                        $del_open = $del_close = '';
                        if ($color['enabled'] == 0) {
                            $del_open = '<del>';
                            $del_close = '</del>';
                        }
                        echo '<tr>';
                        echo '<input type="hidden" class="table_id" value="' . $color['id'] . '" />';
                        echo '<input type="hidden" class="table_color" value="' . $color['color'] . '" />';
                        echo '<input type="hidden" class="table_name" value="' . $color['name'] . '" />';
                        echo '<input type="hidden" class="table_shade" value="' . $color['shade'] . '" />';
                        echo '<input type="hidden" class="table_style" value="' . $color['style'] . '" />';
                        echo '<td>' . $del_open . $color['name'] . $del_close . '</td>';
                        echo '<td> <div style="width:20px;height:20px;background-color:' . $color['color'] . '"></div></td>';
                        echo '<td>' . $del_open . $color['shade'] . $del_close . '</td>';
                        echo '<td>' . $del_open . $color['style'] . $del_close . '</td>';
                        echo '<td>';
                        if ($color['enabled'] == 1) {
                            echo '<button type="button" class="btn btn-warning btn-xs" title="Edit" data-toggle="modal" data-target="#colorModal" onclick="prepare_form(\'colorModal\', \'Color\', \'btn-color\', edit_color, false, color_populate,$(this).closest(\'tr\'));"><i class="fa fa-pencil"></i></button>';
                        } else {
                            echo '<button type="button" class="btn btn-warning btn-xs" title="Edit" onclick="show_message(45, \'' . $this->config->item(45, 'msg') . '\', null, false, \'' . APP_NAME . ' Update\');"><i class="fa fa-pencil"></i></button>';
                        }
                        $enable_title = 'Disable';
                        $btn_class = 'btn-danger';
                        $enable_class = 'fa-times';
                        if ($color['enabled'] == 0) {
                            $enable_title = 'Enable';
                            $btn_class = 'btn-success';
                            $enable_class = 'fa-check';
                            $status_msg_id = 554;
                        } else {
                            $status_msg_id = 555;
                        }
                        echo '<button type="button" class="btn btn-xs status-toggle ' . $btn_class . '" title="' . $enable_title . '" onclick="show_confirmation(' . $status_msg_id . ', messages[' . $status_msg_id . '], null, \'colors\', ' . $color['id'] . ', enable_color_success, enable_color_fail);"><i class="fa ' . $enable_class . '"></i></button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>  
        </div>
        <!-- Brand Modal -->
        <div class="modal fade" id="colorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1500;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header form-modal-header">
                        <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <form action=""  id="color-form" >
                            <input type="hidden" id="hidden_id" name="hidden_id" />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name"  name="name" required="true"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="color">Color</label>
                                        <input type="text" class="form-control" id="color" value="#000000"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="shade">Shade</label>
                                        <input type="text" class="form-control" id="shade" name="shade" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="style">Style</label>
                                        <select name="style" id="style" class="form-control" required="true">
                                            <option value="SOLID">SOLID</option>
                                            <option value="GRADIENT">GRADIENT</option>
                                            <option value="TEXTURE">TEXTURE</option>
                                            <option value="SEPERATE">SEPERATE</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="btn-color"></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Brand Modal -->

        <script src="<?= base_url('public/') ?>js/admin/colors.js"></script>
        <script src="<?php echo base_url('public/js/admin/pages/spectrum.js') ?>" type="text/javascript"></script>
        <script>
            var messages = [];
            messages[550] = '<?= $this->config->item(550, 'msg') ?>';
            messages[551] = '<?= $this->config->item(551, 'msg') ?>';
            messages[552] = '<?= $this->config->item(552, 'msg') ?>';
            messages[553] = '<?= $this->config->item(553, 'msg') ?>';
            messages[554] = '<?= $this->config->item(554, 'msg') ?>';
            messages[43] = '<?= $this->config->item(43, 'msg') ?>';
            messages[44] = '<?= $this->config->item(44, 'msg') ?>';
            messages[555] = '<?= $this->config->item(555, 'msg') ?>';


            var bradTable;
            Dropzone.autoDiscover = false;
            var myDropzone;
            var bradTable;
            var parsley_user_form;


            $(function () {
                parsley_color_form = $('#color-form');
                parsley_color_form.parsley();
                brandTable = $('#example').DataTable({});
            });
            const BASEURL = '<?= base_url() ?>';

            $('.close').click(function () {
                $('#color-form').parsley().reset();

            });

        </script>
        <script>
            $("#color").spectrum({
                preferredFormat: "hex",
                showInput: true,
                showPalette: true,
                palette: [["red", "rgba(0, 255, 0, .5)", "rgb(0, 0, 255)"]]
            });
        </script>
