<?php
$message = $this->session->flashdata('message');
if ($message != NULL) {
    ?>
    <script>
        $(function () {
            show_message(<?= $message[0] ?>, '<?= $message[1] ?>', null, false, 'Manage Items');
        });
    </script>
    <?php
}
?>
<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="col-md-12 back-btn-panel">
            <button type="button" onclick="window.history.back();" class="btn btn-success btn-back"><i class="fa fa-chevron-left"></i> Back</button>
        </div>
    </div>
</div>
<div class="page-inner">
    <div class="page-title">
        <h3>Model Images</h3>        
        <div class="page-breadcrumb">
            <button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#imageModal" onclick=""><i class="fa fa-plus"></i> Add Images</button>
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Model Images</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr><th>Model Name</th><td><?= $model['model_name'] ?></td></tr> 
                                    </tbody>                            
                                </table>
                            </div>
                        </div>
                        <form id="frm-save-images" method="post" action="<?= base_url('item/update_model_images') ?>">
                            <input type="hidden" name="model-id" value="<?= $model['id'] ?>"/>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered" id="tbl-images">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Is Preferred Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                            
                                        <tbody>
                                            <?php
                                            if (count($images) > 0) {
                                                foreach ($images as $img) {
                                                    $btn_class = 'btn-danger';
                                                    $btn_icon = 'fa-times';
                                                    $title = "Disable Image";
                                                    $enable_message_id = 1111;
                                                    if ($img['enabled'] == 0) {
                                                        $enable_message_id = 1110;
                                                        $title = "Enable Image";
                                                        $btn_class = 'btn-success';
                                                        $btn_icon = 'fa-check';
                                                    }
                                                    $enable_message = $this->config->item($enable_message_id, 'msg');
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <input type="hidden" name="image-id[]" value="<?= $img['id'] ?>" />
                                                            <input type="hidden" name="preferred-image[]" value="<?= $img['is_preferred_image'] ?>" class="preferred"/>
                                                            <input type="hidden" name="hq-file-name[]" value="<?= $img['image_name'] ?>" />
                                                            <input type="hidden" name="zoom-file-name[]" value="<?= $img['zoom_image_name'] ?>" />
                                                            <input type="hidden" name="thumbnail-file-name[]" value="<?= $img['thumbnail_image_name'] ?>" />
                                                            <input type="hidden" name="image-enabled[]" value="<?= $img['enabled'] ?>"  class="enabled"/>
                                                            <input type="hidden" name="image-existing[]" value="1" />
                                                            <img class="item-image-preview" src="<?= base_url('public/runningimages/model/image') . '/' . $img['image_name'] ?>"
                                                        </td>
                                                        <td>
                                                            <input type="radio" class="is-preferred-radio" name="is-preferred" checked="<?= ($img['is_preferred_image'] == 1) ? 'true' : '' ?>" />
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-xs status-toggle <?= $btn_class ?> btn-disable-image" title="<?= $title ?>" ><i class="fa <?= $btn_icon ?>"></i></button>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <tr class="dummy-row"><td colspan="3" class="text-center">No Images Found</td></tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>                            
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" id="btn-save-images" class="btn btn-info btn-lg pull-right">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
        <!-- Image Modal -->
        <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1500;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header form-modal-header">
                        <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Image</h4>
                    </div>
                    <div class="modal-body">
                        <form action=""  id="news-form" >
                            <label for="item-image">Item Images</label>
                            <div class="form-group dropzone" id="dropzone">
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="max_image_size">Recommended size: <?= MODEL_MINWIDTH . 'px x ' . MODEL_MINHEIGHT . 'px </br>(less than ' . ITEM_MAXSIZE . ' KB)' ?></span>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" onclick="add_images();">Add</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Image Modal -->
        <script src="<?= base_url('public/js/dropzone_custom.js') ?>"></script>
        <script>
                            var messages = [];
                            messages[1110] = '<?= $this->config->item(1110, 'msg') ?>';
                            messages[1111] = '<?= $this->config->item(1111, 'msg') ?>';
                            Dropzone.autoDiscover = false;
                            $(function () {
                                $('.dz-default span img').prop('src', '../../public/images/upload.png');
                                window.setTimeout(function () {
                                    undo_radio_change();
                                }, 800)
                            });
                            function undo_radio_change() {
                                $('#tbl-images').buttonset();
                                $.each($('.radio'), function (index, item) {
//                                    var checked = $(item).closest('.preferred').val() == 1;
                                    var checked = $(item).parent().parent().children().first().children('input').eq(1).val() == 1;
                                    var radio = $(item).children().eq(0).children().eq(0);
                                    var parent = $(item).parent('td');
                                    item.remove();
                                    $(parent).append(radio);
                                    $(radio).prop('checked', checked);
                                    $('#tbl-images').buttonset('refresh');
                                });
                            }
                            var myDropzone = null;
                            $('.is-preferred-radio').change(function (e) {
                                update_preferred(this);
                            });
                            $('.btn-disable-image').click(function (e) {
                                console.log($(this).parent().parent().find('.enabled'));
                                toggle_enable(this);
                            });
                            function show_confirm(btn) {
                                var title_text = 'Eyewear Notification';
                                $('#yesNoModal h4.modal-title').text(title_text);
                                $('#yesNoModal .modal-body').text(messages[message_id]);
                                $('#yesNoModal .message-id').text(message_id);
                                var button = $('#yesNoModal .yes-btn');
                                if (typeof (button) != undefined) {
                                    button.unbind('click');
                                    button.click(function () {
                                        toggle_enable(btn);
                                    });
                                }
                                $('#yesNoModal').modal('show');
                            }

                            function toggle_enable(btn) {
                                var enabled = $(btn).parent().parent().find('.enabled').val();
                                var title_text = 'Eyewear Notification';
                                var message_id;
                                if (enabled == 1) {
                                    message_id = 1111;
                                } else {
                                    message_id = 1110;
                                }
                                $('#yesNoModal h4.modal-title').text(title_text);
                                $('#yesNoModal .modal-body').text(messages[message_id]);
                                $('#yesNoModal .message-id').text(message_id);
                                var button = $('#yesNoModal .yes-btn');
                                if (typeof (button) != undefined) {
                                    button.unbind('click');
                                    button.click(function () {
                                        var btn_add_class, btn_remove_class;
                                        var btn_add_icon, btn_remove_icon;
                                        var new_enabled, message_id;
                                        if (enabled == 1) {
                                            new_enabled = 0;
                                            message_id = 1111;
                                            btn_remove_class = 'btn-danger';
                                            btn_remove_icon = 'fa-times';
                                            btn_add_class = 'btn-success';
                                            btn_add_icon = 'fa-check';
                                        } else {
                                            new_enabled = 1;
                                            message_id = 1110;
                                            btn_remove_class = 'btn-success';
                                            btn_remove_icon = 'fa-check';
                                            btn_add_class = 'btn-danger';
                                            btn_add_icon = 'fa-times';
                                        }
                                        $(btn).parent().parent().find('.enabled').val(new_enabled);
                                        $(btn).removeClass(btn_remove_class);
                                        $(btn).children('i').removeClass(btn_remove_icon);
                                        $(btn).addClass(btn_add_class);
                                        $(btn).children('i').addClass(btn_add_icon);
                                    });
                                }
                                $('#yesNoModal').modal('show');
                            }
                            function update_preferred(radio) {
                                $('.preferred').val(0);
                                var val = 0;
                                if ($(radio).is(':checked')) {
                                    val = 1;
                                }
                                $(radio).parent().parent().children().first().children('input').eq(1).val(val);
                            }
                            $('#btn-save-images').click(function (e) {
                                $('#frm-save-images').parsley();
                                if ($('#frm-save-images').parsley().isValid()) {
                                    $('#frm-save-images')[0].submit();
                                }
                            });
                            $('#imageModal').on('hidden.bs.modal', function (e) {
                                myDropzone.removeAllFiles();
                            });
                                    const BASEURL = '<?= base_url() ?>';
                                    const ITEM_MAXSIZE = '<?= ITEM_MAXSIZE ?>';
                                    const DROPZONE_UPLOAD_URL = '<?= base_url('ajax/upload_image_with_thumbnails') ?>';
                                    const DROPZONE_DIV = "div#dropzone";
                                    const DROPZONE_PARAM_NAME = "model-image";
                                    const MODEL_IMAGE_PATH = '<?= MODEL_UPLOAD_PATH ?>';
                                    function add_images() {
                                        $('#tbl-images .dummy-row').remove();
                                        console.log(myDropzone.files);
                                        $.each(myDropzone.files, function (index, file) {
                                            if (file.accepted == true) {
                                                var upload = JSON.parse(file.xhr.responseText);
                                                var upload_file_name = upload.upload_data.file_name;
                                                $('<tr>')
                                                        .append($('<td>')
                                                                .append($('<input>', {'type': 'hidden', 'name': 'image-id[]'}).val(0))
                                                                .append($('<input>', {'type': 'hidden', 'name': 'preferred-image[]'}).val(0).addClass('preferred'))
                                                                .append($('<input>', {'type': 'hidden', 'name': 'hq-file-name[]'}).val(upload.hq_image_name))
                                                                .append($('<input>', {'type': 'hidden', 'name': 'zoom-file-name[]'}).val(upload.zoom_image_name))
                                                                .append($('<input>', {'type': 'hidden', 'name': 'thumbnail-file-name[]'}).val(upload.thumbnail_image_name))
                                                                .append($('<input>', {'type': 'hidden', 'name': 'image-enabled[]'}).val(1).addClass('enabled'))
                                                                .append($('<input>', {'type': 'hidden', 'name': 'image-existing[]'}).val(0))
                                                                .append($('<img>', {'src': BASEURL + 'public/runningimages/model/image/' + upload.hq_image_name}).addClass('item-image-preview'))
                                                                )
                                                        .append($('<td>').append($('<input>', {'type': 'radio', 'name': 'is-preferred'}).addClass('is-preferred-radio').on('change', function (e) {
                                                            update_preferred(this);
                                                        })))
                                                        .append($('<td>').append($('<button type="button" class="btn btn-xs status-toggle btn-danger btn-remove-image" title="Disable Image" ><i class="fa fa-times"></i></button>').click(function (e) {
                                                            $(this).closest('tr').remove();
                                                        })))
                                                        .appendTo('#tbl-images tbody');
                                            }
                                        });
                                        $('#imageModal').modal('hide');
                                    }
        </script>