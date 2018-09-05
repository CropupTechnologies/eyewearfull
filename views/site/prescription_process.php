<div id="preloader"></div>
<div id="main-slider">
</div>
<div class="main-container col1-layout">
    <div class="breadcrumbs">
        <div class="container">
            <ul>
                <li class="home">
                    <a href="#" title="Go to Home Page">Home</a>
                    <span class="fa fa-angle-right"></span>
                </li>
                <li class="product">
                    <a href="#" title="Shopping Cart">
                        <strong>Prescription Process</strong>
                    </a>
                </li>
            </ul>

        </div>
    </div>
    <div class="container">
        <div class="main">
            <div class="col-md-12 prescription-vailable-div">
                <h3 style="display:inline;"> Prescription is available with you?</h3> &nbsp;&nbsp;
                <input type="checkbox" name="prescription_available" id="prescription_available" class=""/>
            </div>
            <div class="clearfix"></div>
            <div class="col-main prescription-div">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="prescription-div-2">
                        <div class="col-md-12">

                            <div class="padding-s">


                                <h3 >Prescription</h3>

                                <table class="table table-striped table-bordered" id="prescription_table">
                                    <thead>
                                        <tr>
                                            <th style="width:10%"></th>
                                            <th class="text-center" style="width:35%">Left</th>
                                            <th class="text-center" style="width:35%">Right</th>
                                            <th class="text-center" style="width:10%">PD</th>
                                            <th class="text-center" style="width:10%">Lens Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>                                
                                            <td class="text-left"><h5>Distance</h5></td>
                                            <td class="text-left">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>CYL</th>
                                                            <th>SPH</th>
                                                            <th>AXIS</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><input type="number" name="left_cyl" id="left_cyl" class="prescription_field" placeholder="Enter here"/></td>
                                                            <td><input type="number" name="left_sph" id="left_sph" class="prescription_field" placeholder="Enter here"/></td>
                                                            <td><input type="number" name="left_axis" id="left_axis" class="prescription_field" placeholder="Enter here"/></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td class="text-left">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>CYL</th>
                                                            <th>SPH</th>
                                                            <th>AXIS</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><input type="number" name="right_cyl" id="right_cyl" class="prescription_field" placeholder="Enter here"/></td>
                                                            <td><input type="number" name="right_sph" id="right_sph" class="prescription_field" placeholder="Enter here"/></td>
                                                            <td><input type="number" name="right_axis" id="right_axis" class="prescription_field" placeholder="Enter here"/></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </td>
                                            <td class="text-left"><input type="number" name="pd" id="pd" class="prescription_field" placeholder="Enter here"/></td>
                                            <td class="text-left"><input type="text" name="lens_type" id="lens_type" class="prescription_field" placeholder="Enter here"/></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left"><h5>Near</h5></td>
                                            <td class="text-center"><input type="number" name="near_right" id="near_right" class="prescription_field" placeholder="Enter here"/></td>
                                            <td class="text-center"><input type="number" name="near_left" id="near_left" class="prescription_field" placeholder="Enter here"/></td>
                                            <td class="text-center"><input type="number" name="near_pd" id="near_pd" class="prescription_field" placeholder="Enter here"/></td>
                                            <td class="text-center"><input type="text" name="near_lens_type" id="near_lens_type" class="prescription_field" placeholder="Enter here"/></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="clearfix"></div>
                                <div class="col-md-12">
                                </div>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-6">
                            <h3>Remarks:</h3>
                            <textarea name="remarks" id="remarks" rows="8"></textarea>
                        </div>
                        <div class="col-md-6">
                            <h3>Prescription Image:</h3>
                            <div class="form-group dropzone" id="dropzone">
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
                            </div>
                            <input type="hidden" name="prescription_image" id="prescription_image" value=""/>
                            <input type="hidden" name="prescription_image_id" id="prescription_image_id" value=""/>
                            <div class="form-group image-upload-details">
                                <span class="max_image_size">Maximum Image size: <?= PRESCRIPTION_MAXWIDTH . 'px x ' . PRESCRIPTION_MAXHEIGHT . 'px </br>(Maximum upload file size ' . PRESCRIPTION_MAXSIZE . ' KB)' ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6 margin-bottom-30 margin-top-50">
                        <button type="button" title="Back" class="button btn-back pull-left" onclick="window.history.back();"><span><i class="fa fa-arrow-left"></i> &nbsp;Back</span></button>

                    </div>

                    <div class="col-md-6 margin-bottom-30">
                        <?php
                        $button_action = "save_prescription_data();window.location.href='" . base_url('site/shipping_data') . "'";
                        if (!isset($customer)) {
                            $button_action = "show_message(710, messages[710], null, false, 'Eyewear Notification');";
                        }
                        ?>
                        <button type="button" title="Proceed Order" id='btn-checkout' class="button btn-default pull-right" onclick="<?= $button_action ?>"><span><i class="fa fa-shopping-cart">&nbsp;&nbsp;&nbsp;</i>Shipping Details</span></button>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Signup Modal-->

<!--End:Signup Modal-->

<!--Signout Modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="signout-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sign Out</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="signup-form">
                    <div class="row">
                        <div class="col-md-12">
                            <p><?= $this->config->item(756, 'msg') ?></p>
                        </div>                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>" style="display: none;"/>
                <button type="button" class="button btn-close" data-dismiss="modal">No</button>
                <button type="button" onclick="signout_customer()" class="button btn-submit">Yes</button>
            </div>
        </div>
    </div>
</div>
<!--End:Signup Modal-->


<!--<script type="text/javascript" src="js/543f86c12e2a2f8823ae800a74ce64ba.js"></script>-->
<script src="<?= base_url('public/') ?>js/site/email-decode.min.js"></script>
<script src="<?= base_url('public/') ?>js/site/easyzoom.js"></script>
<link href="<?= base_url('public/') ?>css/site/easyzoom.css" rel="stylesheet" type="text/css"/>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="<?= base_url('public/') ?>js/site/order_process.js"></script>
<script src="<?= base_url('public/') ?>js/site/customer_utils.js"></script>

<style>
    .product{
        width:225px;
        display: inline-block;
    }

    .easyzoom--overlay{
        padding: 0 !important;
    } 
</style>
<script type="text/javascript">
                            $(document).ready(function () {
                                $('.main-menu').hide();
                                $('.page-header-container').css('justify-content', 'center');


                            });
                            Dropzone.autoDiscover = false;
                            messages[710] = '<?= $this->config->item(710, 'msg') ?>';
                            messages[751] = '<?= $this->config->item(751, 'msg') ?>';
                            messages[752] = '<?= $this->config->item(752, 'msg') ?>';
                            messages[753] = '<?= $this->config->item(753, 'msg') ?>';
                            messages[754] = '<?= $this->config->item(754, 'msg') ?>';
                            messages[755] = '<?= $this->config->item(755, 'msg') ?>';
                            messages[757] = '<?= $this->config->item(757, 'msg') ?>';
                            const BASEURL = '<?= base_url() ?>';
                            var $easyzoom = $('.easyzoom').easyZoom();
                            var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

                            $('.thumbnails').on('click', 'a', function (e) {
                                var $this = $(this);

                                e.preventDefault();

                                // Use EasyZoom's `swap` method
                                api1.swap($this.data('standard'), $this.attr('href'));
                            });

                            $(function () {


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
                                            $('#prescription_image').val(response.upload_data.file_name);
                                        }
                                    },
                                    paramName: 'prescription-image',
                                    params: {
                                        'image_type': 'prescription-image',
                                    }
                                });

                            });
</script>
<script>
//    $('#btn-checkout').click(function () {
//        save_prescription_data();
//    });

    $(document).ready(function () {
        if ($('#prescription_available').is(":checked")) {
            $('.prescription-div-2').show();
        } else {
            $('.prescription-div-2').hide();
        }
    });
    $('#prescription_available').click(function () {
        if ($(this).is(":checked")) {
            $('.prescription-div-2').show();
        } else {
            $('.prescription-div-2').hide();
        }
    });


    function save_prescription_data() {
        var right_cyl = $('#right_cyl').val();
        var right_sph = $('#right_sph').val();
        var right_axis = $('#right_axis').val();
        var left_cyl = $('#left_cyl').val();
        var left_sph = $('#left_sph').val();
        var left_axis = $('#left_axis').val();
        var pd = $('#pd').val();
        var lens_type = $('#lens_type').val();
        var near_right = $('#near_right').val();
        var near_left = $('#near_left').val();
        var near_pd = $('#near_pd').val();
        var near_lens_type = $('#near_lens_type').val();
        var remarks = $('#remarks').val();
        var prescription_image = $('#prescription_image').val();
        if ($("#prescription_available").is(":checked")) {
            $.ajax({
                url: '<?= base_url(); ?>ajax/save_prescription_data',
                type: 'post',
                dataType: 'json',
                data: {right_cyl: right_cyl, right_sph: right_sph, right_axis: right_axis, left_cyl: left_cyl, left_sph: left_sph, left_axis: left_axis, pd: pd, lens_type: lens_type, near_right: near_right, near_left: near_left, near_pd: near_pd, near_lens_type: near_lens_type, remarks: remarks, prescription_image: prescription_image},
                success: function (res) {
                    if (res.success == 1) {

                    }

                }
            });
        } else {

        }
    }

</script>

<script src="<?= base_url('public/') ?>plugins/jquery-cookie/jquery.cookie.js" type="text/javascript"></script>
<script src="<?= base_url('public/') ?>js/site/item_view.js" type="text/javascript"></script>
<script src="<?= base_url('public/') ?>js/site/custom.js" type="text/javascript"></script>


