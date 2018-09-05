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
                        <strong>Order Confirmation</strong>
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
                            <h3 >My Order</h3>
                            <div class="padding-s">
                                <?php
                                if (count($cart_items) == 0) {
                                    ?>
                                    <div id="messages_item_view">No Item Found.</div>
                                    <?php
                                } else {
                                    ?>

                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Item Name</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-right">Each Price</th>
                                                <th class="text-right">Sub Total</th>

                                            </tr>
                                        </thead>
                                        <tbody>                                
                                            <?php
                                            $cart_total = 0;
                                            $acc_amount = 0;
                                            foreach ($cart_items as $item) {
                                                if ($item['enabled']) {
                                                    $item_data = $item['item_data'];
                                                    $cart_total += $item_data['price'] * $item['qty'];
                                                    ?>
                                                    <tr class="shopping-cart-item">
                                                        <td class="text-td" title="Name"><?= $item_data['name'] ?></td>
                                                        <td class="text-td text-center" title="Qty"><?= $item['qty'] ?></td>
                                                        <td class="text-td text-right" title="Each Price"><?= number_format($item_data['price'], 2) ?></td>
                                                        <td class="text-td text-right" title="Total Price"><?= number_format(($item_data['price'] * $item['qty']), 2) ?></td>

                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <tr class="shopping-cart-item">
                                                <td></td>
                                                <td></td>
                                                <td class="text-right text-td" style="font-weight:bold;">NET TOTAL</td>
                                                <td class="text-right text-td" style="font-weight:bold;"><?=  number_format($cart_total, 2); ?></td>
                                            </tr>
                                            <?php
                                            $item_total_price = $cart_total;
                                            $total_amount = 0;
                                            $acc_amount = $cart_total;
                                            if (!empty($taxes)) {
                                                foreach ($taxes as $tax) {
                                                    if ($tax['accumilative'] == 0) {
                                                        $tax_amount = $acc_amount * $tax['percentage'] * 0.01;
                                                        $total_amount += $tax_amount;
                                                    } else {
                                                        $tax_amount = $total_amount * $tax['percentage'] * 0.01;
                                                        $total_amount += $tax_amount;
                                                    }
                                                    ?>
                                                    <tr class="shopping-cart-item">
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-right text-td"><?= $tax['tax_name'] . ' (' . $tax['percentage'] . '%)'; ?></td>
                                                        <td class="text-right text-td"><?= number_format($tax_amount, 2); ?></td>
                                                    </tr>
                                                    <?php
                                                    $item_total_price += $tax_amount;
                                                }
                                            }
                                            ?>
                                            <tr class="shopping-cart-item">
                                                <td></td>
                                                <td></td>
                                                <td class="text-right text-td" style="font-weight:bold;">GROSS TOTAL</td>
                                                <td class="text-right text-td" style="font-weight:bold;"><?= DEFAULT_CURRENCY . ' ' . number_format($item_total_price, 2); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                    </div>
                                    <?php
                                }
                                ?>
                                <div id="product-collateral" class="product-collateral toggle-content tabs">
                                    <dl id="collateral-tabs" class="collateral-tabs">
                                    </dl>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-6">
                            <h3>Shipping Details</h3>
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
                                    <div class="col-md-12" id="address-area">
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

                                    <div class="clearfix"></div>
                                </form>
                                <?php
                            } else {
                                ?>
                                <div class="col-md-12">
                                    <h4 class="standart-text">No Shipping Data Specified. Please add shipping data.</h4>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="clearfix"></div>
                        <?php
                        if (!empty($_SESSION['prescription_session'])) {
                            ?>
                            <div class="col-main prescription-div order-confirmation-prescription">
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
                                                                    <th class="text-center">CYL</th>
                                                                    <th class="text-center">SPH</th>
                                                                    <th class="text-center">AXIS</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-center"><?= $_SESSION['prescription_session']['left_cyl']; ?></td>
                                                                    <td class="text-center"><?= $_SESSION['prescription_session']['left_sph']; ?></td>
                                                                    <td class="text-center"><?= $_SESSION['prescription_session']['left_axis']; ?></td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td class="text-left">
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">CYL</th>
                                                                    <th class="text-center">SPH</th>
                                                                    <th class="text-center">AXIS</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-center"><?= $_SESSION['prescription_session']['right_cyl']; ?></td>
                                                                    <td class="text-center"><?= $_SESSION['prescription_session']['right_sph']; ?></td>
                                                                    <td class="text-center"><?= $_SESSION['prescription_session']['right_axis']; ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td class="text-center"><?= $_SESSION['prescription_session']['pd']; ?></td>
                                                    <td class="text-center"><?= $_SESSION['prescription_session']['lens_type']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left"><h5>Near</h5></td>
                                                    <td class="text-center"><?= $_SESSION['prescription_session']['near_right']; ?></td>
                                                    <td class="text-center"><?= $_SESSION['prescription_session']['near_left']; ?></td>
                                                    <td class="text-center"><?= $_SESSION['prescription_session']['near_pd']; ?></td>
                                                    <td class="text-center"><?= $_SESSION['prescription_session']['near_lens_type']; ?></td>
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
                                    <?= $_SESSION['prescription_session']['remarks']; ?>
                                </div>
                                <?php
                                if (isset($_SESSION['prescription_session']['prescription_image']) && $_SESSION['prescription_session']['prescription_image'] != NULL && $_SESSION['prescription_session']['prescription_image'] != '') {
                                    ?>
                                    <div class="col-md-6">
                                        <h3>Prescription Image:</h3>
                                        <a href="<?= base_url() . PRESCRIPTION_IMAGE_FILE_PATH . $_SESSION['prescription_session']['prescription_image'] ?>" target="_BLANK"><img src="<?= base_url() . PRESCRIPTION_IMAGE_FILE_PATH . $_SESSION['prescription_session']['prescription_image'] ?>" width="120"/></a>
                                    </div>
                                    <?php
                                }
                                ?>


                            </div>

                            <?php
                        }
                        ?>


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
                            $button_action = "window.location.href='" . base_url('site/order') . "'";
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

</script>


<script src="<?= base_url('public/') ?>plugins/jquery-cookie/jquery.cookie.js" type="text/javascript"></script>
<script src="<?= base_url('public/') ?>js/site/shipping_data.js" type="text/javascript"></script>
<script src="<?= base_url('public/') ?>js/site/custom.js" type="text/javascript"></script>


