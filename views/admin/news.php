<?php
$this->load->view('admin/includes/side_bar');
?>
<div class="page-inner">
    <div class="page-title">
        <h3>News</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">News</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <button type="button" class="btn btn-success btn-addon m-b-sm" data-toggle="modal" data-target="#newsModal" onclick="prepare_form('newsModal', 'News',  'btn-news', add_news, true, null);"><i class="fa fa-plus"></i> Add News</button>
        <div class="table-responsive">
            <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Image</th>
                        <th>Expiry Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Image</th>
                        <th>Expiry Date</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($news as $n) {
                        $del_open = $del_close = '';
                        $enable_message = 214;
                        if ($n['enabled'] == 0) {
                            $del_open = '<del>';
                            $del_close = '</del>';
                            $enable_message = 215;
                        }
                        echo '<tr>';
                        echo '<input type="hidden" class="tr-news-id" name="tr-news-id" value="' . $n['id'] . '"/>';
                        echo '<input type="hidden" class="tr-news-title" name="tr-news-title" value="' . $n['title'] . '"/>';
                        echo '<input type="hidden" class="tr-news-content" name="tr-news-content" value="' . $n['content'] . '"/>';
                        echo '<input type="hidden" class="tr-news-expiry" name="tr-news-expiry" value="' . $n['expiry_date'] . '"/>';
                        echo '<input type="hidden" class="tr-news-image" name="tr-news-image" value="' . $n['image_name'] . '"/>';
                        echo '<input type="hidden" class="tr-news-enabled" name="tr-news-enabled" value="' . $n['enabled'] . '"/>';
                        echo '<td>' . $del_open . $n['title'] . $del_close . '</td>';
                        echo '<td>' . $del_open . $n['content'] . $del_close . '</td>';
                        echo '<td><img class="table-preview-image" src="' . base_url('public/runningimages/news/') . $n['image_name'] . '" /></td>';
                        echo '<td>' . $del_open . date('h:i:s a m/d/Y', strtotime($n['expiry_date'])) . $del_close . '</td>';
                        echo '<td>';
                        if ($n['enabled'] == 1) {
                            echo '<button type="button" class="btn btn-warning btn-xs" title="Edit" data-toggle="modal" data-target="#newsModal" onclick="prepare_form(\'newsModal\', \'News\', \'news-form\', \'' . base_url('admin_action/edit_news/' . $n['id']) . '\', \'btn-news\', edit_news, false, populate_news, $(this).closest(\'tr\'));"><i class="fa fa-pencil"></i></button>';
                        } else {
                            echo '<button type="button" class="btn btn-warning btn-xs" title="Edit" onclick="show_message(45, \'' . $this->config->item(45, 'msg') . '\', null, false, \'' . APP_NAME . ' Update\');"><i class="fa fa-pencil"></i></button>';
                        }
                        $enable_title = 'Disable';
                        $btn_class = 'btn-danger';
                        $enable_class = 'fa-times';
                        if ($n['enabled'] == 0) {
                            $enable_title = 'Enable';
                            $btn_class = 'btn-success';
                            $enable_class = 'fa-check';
                        }
                        echo '<button type="button" class="btn btn-xs status-toggle ' . $btn_class . '" title="' . $enable_title . '" onclick="show_confirmation(' . $enable_message . ', messages[' . $enable_message . '], null, \'news\', ' . $n['id'] . ', on_toggle_success, on_toggle_fail);"><i class="fa ' . $enable_class . '"></i></button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>  
        </div>
        <!-- Brand Modal -->
        <div class="modal fade" id="newsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1500;" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header form-modal-header">
                        <button type="button" class="close form-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <form action=""  id="news-form" >
                            <div class="form-group">
                                <label for="news_title">News Title</label>
                                <input type="text" class="form-control" id="news_title" name="news_title" placeholder="Enter Title" required="true">
                            </div>
                            <div class="form-group">
                                <label for="news_content">Content</label>
                                <textarea class="form-control" id="news_content" name="news_content" placeholder="Content goes here." required="true"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="news_expiry">Expiry Date</label>
                                <input type="text" class="form-control date-picker" id="news_expiry" name="news_expiry" placeholder="Expiry Date" required="true" readonly="true">
                            </div>
                            <label for="brand_logo">News Image</label>
                            <div class="form-group dropzone" id="dropzone">
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
                            </div>
                            <input type="hidden" name="news_file_name" id="news_file_name" value=""/>
                            <input type="hidden" name="news_id" id="news_id" value=""/>
                            <div class="form-group">
                                <span class="max_image_size">Recommended size: <?= NEWS_MINWIDTH . 'px x ' . NEWS_MINHEIGHT . 'px </br>(less than ' . NEWS_MAXSIZE . ' KB)' ?></span>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="btn-news"></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Brand Modal -->
        <script src="<?= base_url('public/') ?>js/admin/news.js"></script>
        <script>
            var messages = [];
            messages[1000] = '<?= $this->config->item(1000, 'msg') ?>';
            messages[1001] = '<?= $this->config->item(1001, 'msg') ?>';
            messages[1002] = '<?= $this->config->item(1002, 'msg') ?>';
            messages[1003] = '<?= $this->config->item(1003, 'msg') ?>';
            messages[1004] = '<?= $this->config->item(1004, 'msg') ?>';
            messages[1005] = '<?= $this->config->item(1005, 'msg') ?>';
            messages[210] = '<?= $this->config->item(210, 'msg') ?>';
            messages[211] = '<?= $this->config->item(211, 'msg') ?>';
            messages[212] = '<?= $this->config->item(212, 'msg') ?>';
            messages[213] = '<?= $this->config->item(213, 'msg') ?>';
            messages[214] = '<?= $this->config->item(214, 'msg') ?>';
            messages[215] = '<?= $this->config->item(215, 'msg') ?>';
            messages[40] = '<?= $this->config->item(40, 'msg') ?>';
            messages[41] = '<?= $this->config->item(41, 'msg') ?>';
            messages[42] = '<?= $this->config->item(42, 'msg') ?>';
            Dropzone.autoDiscover = false;
            var myDropzone;
            var bradTable;
            var parsley_brand_form;
            $(function () {
                parsley_news_form = $('#news-form');
                parsley_news_form.parsley();
                brandTable = $('#example').DataTable({});
                myDropzone = new Dropzone("div#dropzone", {
                    url: "<?= base_url('ajax/upload_image') ?>",
                    maxFiles: 1,
                    maxFilesize: <?= (NEWS_MAXSIZE / 1000) ?>,
                    addRemoveLinks: true,
                    thumbnailWidth: null,
                    thumbnailHeight: "120",
                    success: function (file, response) {
                        console.log(response);
                        if (response.error_no > 0) {
                            show_message(response.error_no, response.error_data, null, false, 'Image Upload');
                            myDropzone.removeAllFiles(true);
                        } else {
                            $('#news_file_name').val(response.upload_data.file_name);
                        }
                    },
                    paramName: 'news-image',
                    params: {
                        'image_type': 'news-image',
                    }
                });
                var today = new Date();
                $('.date-picker').datepicker({
                    startDate: today,
                    autoclose: true,
                    format: 'yyyy-mm-dd'
                });
                var dat = new Date(today.valueOf());
                dat.setDate(dat.getDate() + 30);
                $('#news_expiry').datepicker('update', dat);

//                $('#news_expiry').datepicker('setStartDate', today);
            });
            const BASEURL = '<?= base_url() ?>';
        </script>
