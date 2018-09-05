<?php
$this->load->view('admin/includes/side_bar');
?>
<div class="page-inner">
    <div class="page-title">
        <h3>Brands</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Brands</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <button type="button" class="btn btn-success btn-addon m-b-sm" data-toggle="modal" data-target="#brandModal" onclick="prepare_form('brandModal', 'Brand', 'btn-brand', add_brand, true, null);"><i class="fa fa-plus"></i> Add Brand</button>
        <div class="table-responsive">
            <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Updated On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Updated On</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($brands as $brand) {
                        $del_open = $del_close = '';
                        $enable_message = 204;
                        if ($brand['enabled'] == 0) {
                            $del_open = '<del>';
                            $del_close = '</del>';
                            $enable_message = 205;
                        }
                        $image_path = base_url('public/images/no-image.png');
                        if ($brand['logo_image'] != NULL && strlen(trim($brand['logo_image'])) > 0) {
                            $image_path = base_url('public/runningimages/brands/' . $brand['logo_image']);
                        }
                        echo '<tr>';
                        echo '<input type="hidden" class="tr-brand-id" name="brand-id" value="' . $brand['id'] . '"/>';
                        echo '<input type="hidden" class="tr-brand-name" name="brand-name" value="' . $brand['name'] . '"/>';
                        echo '<input type="hidden" class="tr-brand-image" name="brand-image" value="' . $brand['logo_image'] . '"/>';
                        echo '<input type="hidden" class="tr-brand-enabled" name="brand-enabled" value="' . $brand['enabled'] . '"/>';

                        echo '<td>' . $del_open . $brand['name'] . $del_close . '</td>';
                        echo '<td><img class="table-preview-image" src="' . $image_path . '" /></td>';
                        echo '<td>' . $del_open . date('Y-m-d H:ia', strtotime($brand['lastupdated_on'])) . $del_close . '</td>';
                        echo '<td>';
                        $edit_action = 'show_message(45, messages[45], null, false, "' . APP_NAME . ' Update");';
                        if ($brand['enabled'] == 1) {
                            echo '<button type="button" class="btn btn-warning btn-xs" title="Edit" data-toggle="modal" data-target="#brandModal" onclick="prepare_form(\'brandModal\', \'Brands\', \'btn-brand\', edit_brand, false, brand_populate, $(this).closest(\'tr\'));"><i class="fa fa-pencil"></i></button>';
                        } else {
                            echo '<button type="button" class="btn btn-warning btn-xs" title="Edit" onclick="show_message(45, \''.$this->config->item(45, 'msg').'\', null, false, \'' . APP_NAME . ' Update\');"><i class="fa fa-pencil"></i></button>';
                        }
                        $enable_title = 'Disable';
                        $btn_class = 'btn-danger';
                        $enable_class = 'fa-times';
                        if ($brand['enabled'] == 0) {
                            $enable_title = 'Enable';
                            $btn_class = 'btn-success';
                            $enable_class = 'fa-check';
                        }
                        echo '<button type="button" class="btn btn-xs status-toggle ' . $btn_class . '" title="' . $enable_title . '" onclick="show_confirmation(' . $enable_message . ', messages[' . $enable_message . '], null, \'brand\', ' . $brand['id'] . ', on_toggle_success, on_toggle_fail);"><i class="fa ' . $enable_class . '"></i></button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>  
        </div>
        <!-- Brand Modal -->
        <div class="modal fade" id="brandModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1500;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header form-modal-header">
                        <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <form action=""  id="brand-form" >
                            <input type="hidden" name="hidden-id" id="hidden-id"/>
                            <div class="form-group">
                                <label for="brand_name">Brand Name</label>
                                <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Enter brand name" required="true">
                            </div>
                            <label for="brand_logo">Logo Image</label>
                            <div class="form-group dropzone" id="dropzone">
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
                            </div>
                            <input type="hidden" name="brand_file_name" id="brand_file_name" value=""/>
                            <div class="form-group">
                                <span class="max_image_size">Recommended size: <?= BRAND_LOGO_MINWIDTH . 'px x ' . BRAND_LOGO_MINHEIGHT . 'px </br>(less than ' . BRAND_LOGO_MAXSIZE . ' KB)' ?></span>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="btn-brand"></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Brand Modal -->
        <script src="<?= base_url('public/') ?>js/admin/brands.js"></script>
        <script>
            var messages = [];
            messages[1000] = '<?= $this->config->item(1000, 'msg') ?>';
            messages[1001] = '<?= $this->config->item(1001, 'msg') ?>';
            messages[1002] = '<?= $this->config->item(1002, 'msg') ?>';
            messages[1003] = '<?= $this->config->item(1003, 'msg') ?>';
            messages[1004] = '<?= $this->config->item(1004, 'msg') ?>';
            messages[1005] = '<?= $this->config->item(1005, 'msg') ?>';
            messages[200] = '<?= $this->config->item(200, 'msg') ?>';
            messages[201] = '<?= $this->config->item(201, 'msg') ?>';
            messages[202] = '<?= $this->config->item(202, 'msg') ?>';
            messages[203] = '<?= $this->config->item(203, 'msg') ?>';
            messages[204] = '<?= $this->config->item(204, 'msg') ?>';
            messages[205] = '<?= $this->config->item(205, 'msg') ?>';
            messages[40] = '<?= $this->config->item(40, 'msg') ?>';
            messages[41] = '<?= $this->config->item(41, 'msg') ?>';
            messages[42] = '<?= $this->config->item(42, 'msg') ?>';
            Dropzone.autoDiscover = false;
            var myDropzone;
            var bradTable;
            var parsley_brand_form;
            $(function () {
                parsley_brand_form = $('#brand-form');
                parsley_brand_form.parsley();
                brandTable = $('#example').DataTable({});
                myDropzone = new Dropzone("div#dropzone", {
                    url: "<?= base_url('ajax/upload_image') ?>",
                    maxFiles: 1,
                    maxFilesize: 1,
                    addRemoveLinks: true,
                    thumbnailWidth: null,
                    thumbnailHeight: "120",
                    success: function (file, response) {
                        console.log(response);
                        if (response.error_no > 0) {
                            show_message(response.error_no, response.error_data, null, false, 'Image Upload');
                            myDropzone.removeAllFiles(true);
                        } else {
                            $('#brand_file_name').val(response.upload_data.file_name);
                        }
                    },
                    paramName: 'brand-logo',
                    params: {
                        'image_type': 'brand-logo-image'
                    }
                });
            });
            const BASEURL = '<?= base_url() ?>';
        </script>
