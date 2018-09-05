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
                        <strong>Shipping Details</strong>
                    </a>
                </li>
            </ul>
            <!--<button type="button" title="Back" class="button btn-back pull-right" onclick="window.history.back();"><span>Back</span></button>-->
        </div>
    </div>
    <div class="container">
        <div class="main">
            <div class="col-main" style="min-height: 350px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <h3>Add New Shipping Address</h3>

                                <p>
                                    When you're buying an item, you can select your shipping address previously you entered. Make sure this is where you want your item to be sent before completing your purchase. 
                                </p>
                                <p>
                                    If you want to make a change, select a different address in the Ship to field on the checkout page. If the address you want your item delivered to isn't shown, select Add a new address and complete the required details. 
                                </p>
                                <button class="button pull-left" id="btn-add-shipping-profile" onclick="open_for_add();"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-6">
                            <?php
                            if (!empty($shipping_profiles)) {
                                ?>
                                <dl>
                                    <dd>
                                    <dt><h3 >Select Shipping Profile</h3></dt>
                                    <div class="input-box">
                                        <select name="shipping-profile-id" id="shipping-profile-id" class=" required-entry product-custom-option" title="Shipping Profile">
                                            <option value="">-- Please Select --</option>
                                            <?php
                                            if ($shipping_profiles != NULL && count($shipping_profiles) > 0) {
                                                foreach ($shipping_profiles as $profile) {
                                                    $selected = '';
                                                    if (isset($selected_profile) && $selected_profile != NULL && $selected_profile['id'] == $profile['id']) {
                                                        $selected = 'selected';
                                                    }
                                                    if ($profile['enabled'] == 1) {
                                                        ?>
                                                        <option value="<?= $profile['id'] ?>" <?= $selected ?>><?= $profile['profile_name'] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    </dd>
                                </dl>
                                <?php
                            }
                            ?>

                            <?php
                            if (isset($selected_profile) && $selected_profile != NULL) {
                                ?>
                                <form id="frm-address">
                                    <input type="hidden" name="edit-profile-id" id="edit-profile-id" value="<?= $selected_profile['id'] ?>"/>
                                    <input type="hidden" name="edit-profile-name" id="edit-profile-name" value="<?= $selected_profile['profile_name'] ?>"/>
                                    <input type="hidden" name="edit-profile-address" id="edit-profile-address" value="<?= $selected_profile['address'] ?>"/>
                                    <input type="hidden" name="edit-profile-city" id="edit-profile-city" value="<?= $selected_profile['city'] ?>"/>
                                    <input type="hidden" name="edit-profile-state" id="edit-profile-state" value="<?= $selected_profile['state'] ?>"/>
                                    <input type="hidden" name="edit-profile-country" id="edit-profile-country" value="<?= $selected_profile['country'] ?>"/>
                                    <input type="hidden" name="edit-profile-zip" id="edit-profile-zip" value="<?= $selected_profile['zip_code'] ?>"/>
                                    <input type="hidden" name="edit-profile-contact" id="edit-profile-contact" value="<?= $selected_profile['contact_number'] ?>"/>
                                    <div class="clearfix"></div>
                                    <div class="col-md-8" id="address-area">
                                        <?php
                                        $address_parts = [];
                                        if (strlen($selected_profile['address'])) {
                                            $address_parts[] = '<p class="p-inline">' . $selected_profile['address'] . '</p>';
                                        }
                                        if (strlen($selected_profile['city'])) {
                                            $address_parts[] = '<p class="p-inline">' . $selected_profile['city'] . '</p>';
                                        }
                                        if (strlen($selected_profile['state'])) {
                                            $address_parts[] = '<p class="p-inline">' . $selected_profile['state'] . '</p>';
                                        }
                                        if (strlen($selected_profile['country'])) {
                                            $address_parts[] = '<p class="p-inline">' . $selected_profile['country'] . '</p>';
                                        }
                                        if (strlen($selected_profile['zip_code'])) {
                                            $address_parts[] = '<p class="p-inline">' . $selected_profile['zip_code'] . '</p>';
                                        }
                                        if (strlen($selected_profile['contact_number'])) {
                                            $address_parts[] = '<p class="p-inline">Phone : ' . $selected_profile['contact_number'] . '</p>';
                                        }
                                        ?>
                                        <h3 class="standart-text"><?= $selected_profile['profile_name'] ?></h3>
                                        <?php
                                        echo implode(',<br/>', $address_parts);
                                        ?>
                                    </div>
                                    <div class="col-md-4"><button type="button" class="button pull-right shipping-address-edit-btn" title="Edit" onclick="open_profile_for_edit();"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Edit</button></div>
                                    <div class="clearfix"></div>
                                </form>
                                <?php
                            } else {
                                ?>
                                <div class="col-md-12">
                                    <h4 class="standart-text">No shipping address exists for your account.</h4>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                    </div>
                    <div class="col-md-12">

                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6 margin-bottom-30 margin-top-50">
                        <button type="button" title="Back" class="button btn-back pull-left" onclick="window.history.back();"><span><i class="fa fa-arrow-left"></i> &nbsp;Back</span></button>

                    </div>
                    <div class="col-md-6">
                        <?php
                        $button_action = "show_message(762, messages[762], null, false, 'Eyewear Notification');";
                        if (isset($selected_profile) && $selected_profile != NULL) {
                            $button_action = "proceed_to_prescrition($('#shipping-profile-id').val());";
                        }
                        ?>
                        <button type="button" title="Proceed Order" id='btn-checkout' class="button btn-default pull-right" onclick="<?= $button_action ?>" ><span>Order Confirmation</span>&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--Shiping profile Modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="shipping-profile-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title site-modal-header">Add Shipping Profile</h5>

            </div>
            <div class="modal-body">
                <form id="shipping-profile-form">
                    <input type="hidden" id="profile-customer-id" name="profile-customer-id" value="<?= $_SESSION['customer']['id'] ?>"/>
                    <div class="row">
                        <div class="col-md-12">                            
                            <dl>
                                <dt><label id="frame_color_label">Profile Title</label></dt>
                                <dd>
                                    <div class="input-box">
                                        <input type="text" id="profile-title" class="product-custom-option model-field-value" required="required" />
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">                            
                            <dl>
                                <dt><label id="frame_color_label">Address</label></dt>
                                <dd>
                                    <div class="input-box">
                                        <input type="text" id="profile-address" class="product-custom-option model-field-value" required="required" />
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-md-4">                            
                            <dl>
                                <dt><label id="frame_color_label">City</label></dt>
                                <dd>
                                    <div class="input-box">
                                        <input type="text" id="profile-city" class="product-custom-option model-field-value"  required="required"/>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-md-4">                            
                            <dl>
                                <dt><label id="frame_color_label">State</label></dt>
                                <dd>
                                    <div class="input-box">
                                        <input type="text" id="profile-state" class="product-custom-option model-field-value"  required="required"/>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">                            
                            <dl>
                                <dt><label id="frame_color_label">Country</label></dt>
                                <dd>
                                    <div class="input-box">
                                        <input type="text"  id="profile-country" class="product-custom-option model-field-value"  required="required" />
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-md-4">                            
                            <dl>
                                <dt><label id="frame_color_label">Zip Code</label></dt>
                                <dd>
                                    <div class="input-box">
                                        <input type="text" maxlength="10" id="profile-zip" class="product-custom-option model-field-value"  required="required" />
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-md-4">                            
                            <dl>
                                <dt><label id="frame_color_label">Contact Number</label></dt>
                                <dd>
                                    <div class="input-box">
                                        <input type="text" maxlength="30" id="profile-contact" class="product-custom-option model-field-value"  required="required" />
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>" style="display: none;"/>
                <button type="button" class="button btn-close" data-dismiss="modal">Close</button>
                <button type="button" id="btn-signup-action"  class="button btn-submit">Add Profile</button>
            </div>
        </div>
    </div>
</div>
<!--End:Shipping profile Modal-->




                        <!--<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>-->
                        <!--<script type="text/javascript" src="js/543f86c12e2a2f8823ae800a74ce64ba.js"></script>-->
<script src="<?= base_url('public/') ?>js/site/email-decode.min.js"></script>
<script src="<?= base_url('public/') ?>js/site/easyzoom.js"></script>
<link href="<?= base_url('public/') ?>css/site/easyzoom.css" rel="stylesheet" type="text/css"/>

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
                            const BASEURL = '<?= base_url() ?>';
                            messages[758] = '<?= $this->config->item(758, 'msg') ?>'
                            messages[759] = '<?= $this->config->item(759, 'msg') ?>'
                            messages[760] = '<?= $this->config->item(760, 'msg') ?>'
                            messages[761] = '<?= $this->config->item(761, 'msg') ?>'
                            messages[762] = '<?= $this->config->item(762, 'msg') ?>'
                            messages[763] = '<?= $this->config->item(763, 'msg') ?>'
//                    messages[709] = '<?= $this->config->item(709, 'msg') ?>'
                            var $easyzoom = $('.easyzoom').easyZoom();
                            var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

                            $('.thumbnails').on('click', 'a', function (e) {
                                var $this = $(this);

                                e.preventDefault();

                                // Use EasyZoom's `swap` method
                                api1.swap($this.data('standard'), $this.attr('href'));
                            });

                            $('#btn-checkout').click(function () {
                                var shipping_address_id = $('#shipping-profile-id').val();
                               
                                if (shipping_address_id > 0) {
                                    $.ajax({
                                        url: '<?= base_url(); ?>site/set_shipping_address',
                                        type: 'post',
                                        dataType: 'json',
                                        data: {shipping_address_id: shipping_address_id},
                                        success: function () {

                                        }
                                    });
                                }
                            });

                            $('#shipping-profile-id').change(function () {
                                var shipping_address_id = $(this).val();
                                
                                if (shipping_address_id > 0) {
                                    $.ajax({
                                        url: '<?= base_url(); ?>site/set_shipping_address',
                                        type: 'post',
                                        dataType: 'json',
                                        data: {shipping_address_id: shipping_address_id},
                                        success: function () {

                                        }
                                    });
                                }
                            });

</script>


<script src="<?= base_url('public/') ?>plugins/jquery-cookie/jquery.cookie.js" type="text/javascript"></script>
<script src="<?= base_url('public/') ?>js/site/shipping_data.js" type="text/javascript"></script>
<script src="<?= base_url('public/') ?>js/site/custom.js" type="text/javascript"></script>


