<?php
$this->load->view('admin/includes/side_bar');
?>
<link href="<?php echo base_url(); ?>public/plugins/nestable/nestable.css" rel="stylesheet" type="text/css"/>
<div class="page-inner">
    <div class="page-title">
        <h3>Category</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Category</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <button type="button" class="btn btn-success btn-addon m-b-sm" data-toggle="modal" data-target="#categoryModal" onclick="prepare_form('categoryModal', 'Category', 'btn-category', add_category, true, null);"><i class="fa fa-plus"></i> Add Category</button>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <?php
                                if (empty($nestable_categories)) {
                                    echo $this->config->item(3, 'msg');
                                }
                                ?>
                                <div class="dd" id="nestable3">
                                    <ol class="dd-list">
                                        <?php
                                        foreach ($nestable_categories as $nestable_category) {
                                            $del_open = $del_close = '';
                                            if ($nestable_category->enabled == 0) {
                                                $del_open = '<del>';
                                                $del_close = '</del>';
                                            }
                                            ?>
                                            <li class="dd-item dd3-item" data-id="13">
                                                <div class="dd-handle dd3-handle">Drag</div><div class="dd3-content"><?= $del_open; ?><?= $nestable_category->name; ?><?= $del_close; ?>
                                                    <input type="hidden" class="hidden_category_id" name="hidden_category_id" value="<?= $nestable_category->id; ?>" />
                                                    <input type="hidden" class="hidden_category_name" name="hidden_category_name" value="<?= $nestable_category->name; ?>" />
                                                    <input type="hidden" class="hidden_category_parent" name="hidden_category_parent" value="<?= $nestable_category->parent_category_id; ?>" />
                                                    <input type="hidden" class="hidden_category_description" name="hidden_category_description" value="<?= $nestable_category->description; ?>" />
                                                    <?php
                                                    $enable_title = 'Disable';
                                                    $btn_class = 'btn-danger';
                                                    $enable_class = 'fa-times';
                                                    if ($nestable_category->enabled == 0) {
                                                        $enable_title = 'Enable';
                                                        $btn_class = 'btn-success';
                                                        $enable_class = 'fa-check';
                                                        $status_msg_id = 303;
                                                    } else {
                                                        $status_msg_id = 302;
                                                    }
                                                    echo '<button type="button" class="btn btn-xs nestable-cat-btn status-toggle ' . $btn_class . '" title="' . $enable_title . '" onclick="show_confirmation(' . $status_msg_id . ', messages[' . $status_msg_id . '], null, \'category\', ' . $nestable_category->id . ', category_status_success, category_status_fail);"><i class="fa ' . $enable_class . '"></i></button>';
                                                    if ($nestable_category->enabled == 1) {
                                                        echo '<button type="button" class="btn btn-warning btn-xs nestable-cat-btn" title="Edit" data-toggle="modal" data-target="#categoryModal" onclick="prepare_form(\'categoryModal\', \'Category\', \'btn-category\', edit_category, false, category_populate,$(this).parent());"><i class="fa fa-pencil"></i></button>';
                                                    } else {
                                                        echo '<button type="button" class="btn btn-warning btn-xs nestable-cat-btn" title="Edit" onclick="show_message(45, \'' . $this->config->item(45, 'msg') . '\', null, false, \'' . APP_NAME . ' Update\');"><i class="fa fa-pencil"></i></button>';
                                                    }
                                                    ?>
                                                </div>
                                                <?php
                                                if (isset($nestable_category->subs)) {
                                                    ?>
                                                    <ol class="dd-list">
                                                        <?php
                                                        foreach ($nestable_category->subs as $subs) {
                                                            $del_open = $del_close = '';
                                                            if ($subs->enabled == 0) {
                                                                $del_open = '<del>';
                                                                $del_close = '</del>';
                                                            }
                                                            ?>
                                                            <li class="dd-item dd3-item" data-id="16">
                                                                <div class="dd-handle dd3-handle">Drag</div><div class="dd3-content"><?= $del_open; ?><?= $subs->name; ?><?= $del_close; ?>
                                                                    <input type="hidden" class="hidden_category_id" name="hidden_category_id" value="<?= $subs->id; ?>" />
                                                                    <input type="hidden" class="hidden_category_name" name="hidden_category_name" value="<?= $subs->name; ?>" />
                                                                    <input type="hidden" class="hidden_category_parent" name="hidden_category_parent" value="<?= $subs->parent_category_id; ?>" />
                                                                    <input type="hidden" class="hidden_category_description" name="hidden_category_description" value="<?= $subs->description; ?>" />
                                                                    <?php
                                                                    $enable_title = 'Disable';
                                                                    $btn_class = 'btn-danger';
                                                                    $enable_class = 'fa-times';
                                                                    if ($subs->enabled == 0) {
                                                                        $enable_title = 'Enable';
                                                                        $btn_class = 'btn-success';
                                                                        $enable_class = 'fa-check';
                                                                        $status_msg_id = 303;
                                                                    } else {
                                                                        $status_msg_id = 302;
                                                                    }
                                                                    echo '<button type="button" class="btn btn-xs nestable-cat-btn status-toggle ' . $btn_class . '" title="' . $enable_title . '" onclick="show_confirmation(' . $status_msg_id . ', messages[' . $status_msg_id . '], null, \'category\', ' . $subs->id . ', category_status_success, category_status_fail);"><i class="fa ' . $enable_class . '"></i></button>';
                                                                    if ($subs->enabled == 1) {
                                                                        echo '<button type="button" class="btn btn-warning btn-xs nestable-cat-btn" title="Edit" data-toggle="modal" data-target="#categoryModal" onclick="prepare_form(\'categoryModal\', \'Category\', \'btn-category\', edit_category, false, category_populate,$(this).parent());"><i class="fa fa-pencil"></i></button>';
                                                                    } else {
                                                                        echo '<button type="button" class="btn btn-warning btn-xs nestable-cat-btn" title="Edit" onclick="show_message(45, \'' . $this->config->item(45, 'msg') . '\', null, false, \'' . APP_NAME . ' Update\');"><i class="fa fa-pencil"></i></button>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ol>
                                                    <?php
                                                }
                                                ?>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
        <!-- Brand Modal -->
        <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1500;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header form-modal-header">
                        <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <form action=""  id="category-form" >
                            <input type="hidden" name="hidden-id" id="hidden-id"/>
                            <div class="form-group">
                                <label for="brand_name">Main Category</label>
                                <select class="form-control" id="parent_category" name="parent_category" placeholder="Select Parent Category" required="true">
                                    <option value="0">None</option>
                                    <?php
                                    foreach ($main_categories as $main_category) {
                                        ?>
                                        <option value="<?= $main_category['id'] ?>"><?= $main_category['name'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="brand_name">Category Name</label>
                                <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter category Name" required="true">
                            </div>
                            <div class="form-group">
                                <label for="brand_name">Category Description</label>
                                <textarea class="form-control" id="category_description" name="category_description" rows="5" placeholder="Enter category description" required="false"></textarea>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="btn-category"></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Brand Modal -->


        <script src="<?= base_url('public/') ?>js/admin/category.js"></script>
        <script>
            var messages = [];
            messages[300] = '<?= $this->config->item(300, 'msg') ?>';
            messages[301] = '<?= $this->config->item(301, 'msg') ?>';
            messages[303] = '<?= $this->config->item(303, 'msg') ?>';
            messages[304] = '<?= $this->config->item(304, 'msg') ?>';
            messages[302] = '<?= $this->config->item(302, 'msg') ?>';
            messages[43] = '<?= $this->config->item(43, 'msg') ?>';
            messages[44] = '<?= $this->config->item(44, 'msg') ?>';
            messages[305] = '<?= $this->config->item(305, 'msg') ?>';


            Dropzone.autoDiscover = false;
            var myDropzone;
            var bradTable;
            var parsley_brand_form;
            $(function () {
                parsley_category_form = $('#category-form');
                parsley_category_form.parsley();
                brandTable = $('#example').DataTable({});

            });
            const BASEURL = '<?= base_url() ?>';
        </script>
