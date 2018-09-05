
<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="col-md-12 back-btn-panel">
            <button type="button" onclick="window.history.back();" class="btn btn-success btn-back"><i class="fa fa-chevron-left"></i> Back</button>
        </div>
    </div>
</div>

<div class="page-inner">
    <div class="page-title">
        <h3>Add Item Images</h3>
        <button type="button" class="btn btn-success btn-addon m-b-sm pull-right" data-toggle="modal" data-target="#imageModal" onclick=""><i class="fa fa-plus"></i> Add Item Image</button>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin/') ?>">Admin Home</a></li>
                <li class="active">Add Item Images</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <form id="frm-save-item" method="post" action="<?= base_url('item/add_item_save') ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="tbl-images" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Preferred Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" id="btn-save-item" class="btn btn-info btn-lg pull-right">Save</button>
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
                                <span class="max_image_size">Recommended size: <?= ITEM_MINWIDTH . 'px x ' . ITEM_MINHEIGHT . 'px </br>(less than ' . ITEM_MAXSIZE . ' KB)' ?></span>
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
            messages[43] = '<?= $this->config->item(43, 'msg') ?>';
            messages[44] = '<?= $this->config->item(44, 'msg') ?>';
            messages[580] = '<?= $this->config->item(580, 'msg') ?>';
            messages[581] = '<?= $this->config->item(581, 'msg') ?>';
            messages[582] = '<?= $this->config->item(582, 'msg') ?>';
            messages[583] = '<?= $this->config->item(583, 'msg') ?>';
            Dropzone.autoDiscover = false;
            var myDropzone = null;
            $(function () {
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
            $('#btn-save-item').click(function (e) {
                $('#frm-save-item')[0].submit();
            });
            $('#imageModal').on('hidden.bs.modal', function(e){
                myDropzone.removeAllFiles();
            });
            
            const BASEURL = '<?= base_url() ?>';
            const ITEM_MAXSIZE = '<?= ITEM_MAXSIZE ?>';
            const DROPZONE_DIV = "div#dropzone";
            const DROPZONE_PARAM_NAME = "item-image";
            const ITEM_IMAGE_PATH = '<?= ITEM_UPLOAD_PATH ?>';
            const DROPZONE_UPLOAD_URL = '<?= base_url('ajax/upload_image_with_thumbnails') ?>';
            
            function add_images(){
                console.log(myDropzone.files);
                $.each(myDropzone.files, function(index, file){
                   if(file.accepted == true){
                       var upload = JSON.parse(file.xhr.responseText);
                       var upload_file_name = upload.upload_data.file_name;
                       $('<tr>')
                               .append($('<td>')
                                .append($('<input>', {'type':'hidden', 'name':'file-name[]'}).val(upload_file_name))
                                .append($('<img>', {'src':BASEURL + 'public/runningimages/item/' + upload_file_name}).addClass('item-image-preview'))
                               )
                               .append($('<td>').append($('<input>', {'type':'radio', 'name':'prefered_image'})))
                               .append($('<td>').append($('<button type="button" class="btn btn-xs status-toggle btn-danger btn-remove-image" title="Remove Image" ><i class="fa fa-times"></i></button>').click(function(e){$(this).closest('tr').remove();})))
                               .appendTo('#tbl-images tbody');
                   } 
                });
                $('#imageModal').modal('hide');
            }
            
        </script>
