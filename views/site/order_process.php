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
                        <strong>Order Process</strong>
                    </a>
                </li>
            </ul>

        </div>
    </div>
    <div class="container">
        <div class="main">
            <div class="col-main">
                <div class="col-md-8">

                    <div class="padding-s">
                        <?php
                        if (count($cart_items) == 0) {
                            ?>
                            <div id="messages_item_view">No Item Found.</div>
                            <?php
                        } else {
                            ?>
                            <h3 >My Order</h3>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th class="text-right"> Price</th>
                                        <th class="text-center">Qty</th>
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
                                                <td class="text-td text-right" title="Each Price"><?= number_format($item_data['price'], 2) ?></td>
                                                <td class="text-td text-center" title="Qty"><?= $item['qty'] ?></td>
                                                <td class="text-td text-right" title="Total Price"><?= number_format(($item_data['price'] * $item['qty']), 2) ?></td>

                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <tr class="shopping-cart-item">
                                        <td></td>
                                        <td></td>
                                        <td class="text-right text-td" style="font-weight:bold;">Net Total</td>
                                        <td class="text-right text-td" style="font-weight:bold;"><?= number_format($cart_total, 2); ?></td>
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
                </div>
                <div class="col-md-4">
                    <?php if (!isset($customer)) { ?>
                        <div class="col-md-12 user-log-box">
                            <div class="col-md-12">
                                <form id="customer-login-form">
                                    <h3 class="text-center customer-login-header">Customer Login</h3>
                                    <p>Welcome back, please login to your account. Now you can login with your facebook and google plus accounts.</p>

                                    <button type="button" title="Facebook" class="btn facebook-login-btn" onclick=""><span><span class="fa fa-facebook"></span> &nbsp;Facebook</span></button>


                                    <button type="button" title="Facebook" class="btn gplus-login-btn pull-right" onclick=""><span><span class="fa fa-google-plus"></span> &nbsp;Google Plus</span></button>

                                    <div class="clearfix"></div>
                                    <h4 class="text-center login-breaker">OR</h4>
                                    <dl>

                                        <dd>
                                            <div class="input-box">
                                                <input type="text" id="username" class="product-custom-option model-field-value login-box-text-field" placeholder="Enter your email" required="required"/>
                                            </div>
                                        </dd>

                                        <dd>
                                            <div class="input-box">
                                                <input type="password" id="password" class="product-custom-option model-field-value login-box-text-field login-box-password-text" placeholder="Enter your password"  required="required"/>
                                            </div>
                                        </dd>
                                    </dl>

                                    <button type="button" title="Sign In" class="btn login-box-signin-btn" onclick="login_customer();"><span><span>Sign In</span></span></button>


                                    <a href="#" class="pull-right forgot-pass-link">Forget Password</a>
                                    <div class="clearfix"></div>
                                    <hr>



                                    <!--                                <div class="col-md-12 margin-bottom-30">
                                                                        <div class="form-group">
                                                                            <div class="col-md-6">
                                                                                <button type="button" title="Facebook" class="button btn-cart btn-sign-in pull-left" onclick=""><span><span>Facebook</span></span></button>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <button type="button" title="Google" class="button btn-cart btn-sign-in pull-right" onclick=""><span><span>Google</span></span></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>-->


                                    <span>If you don't haven't account click here <i class="fa fa-chevron-down"></i></span>
                                    <button type="button" id="btn-sign-up" title="Sign Up" class="btn login-box-signup-btn" data-toggle="modal" data-target="#signup-modal" onclick=""><span><span>Sign Up</span></span></button>

                                </form>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-md-12 user-log-box">
                        <img id="user-icon" src="<?= base_url('public/images/admin_images/avatar1.png') ?>" class="img-rounded"/>
                        <p class="text-center login-box-username"><?= $customer['first_name'] . ' ' . $customer['last_name'] ?></p>
                        <div class="col-md-8 col-md-offset-2 text-center">
                            <button type="button" id="btn-sign-out" title="Sign Out" class="btn login-box-signout-btn" data-toggle="modal" data-target="#signout-modal" ><span><span>Sign Out</span></span></button>
                        </div>
                    </div>

                <?php } ?>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-6 margin-bottom-30 margin-top-50">
                <button type="button" title="Back" class="button btn-back pull-left" onclick="window.history.back();"><span><i class="fa fa-arrow-left"></i> &nbsp;Back</span></button>

            </div>
            <div class="col-md-6">
                <?php
                $button_action = "window.location.href='" . base_url('site/prescription_process') . "'";
                if (!isset($customer)) {
                    $button_action = "show_message(710, messages[710], null, false, 'Eyewear Notification');";
                }
                ?>
                <button type="button" title="Proceed Order" id='btn-checkout' class="button btn-default pull-right" onclick="<?= $button_action ?>"><span><i class="fa fa-file">&nbsp;&nbsp;&nbsp;</i>Enter Prescription</span></button>
            </div>
            <div class="clearfix"></div>

        </div>
    </div>
</div>
</div>

<!--Signup Modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="signup-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title site-modal-header">Sign Up New User</h5>

            </div>
            <div class="modal-body">
                <form id="signup-form">
                    <div class="row">
                        <div class="col-md-6">                            
                            <dl>
                                <dt><label id="frame_color_label">First Name</label></dt>
                                <dd>
                                    <div class="input-box">
                                        <input type="text" id="customer-first-name" class="product-custom-option model-field-value" required="required" />
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-md-6">                            
                            <dl>
                                <dt><label id="frame_color_label">Last Name</label></dt>
                                <dd>
                                    <div class="input-box">
                                        <input type="text" id="customer-last-name" class="product-custom-option model-field-value"  required="required"/>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">                            
                            <dl>
                                <dt><label id="frame_color_label">Email</label></dt>
                                <dd>
                                    <div class="input-box">
                                        <input type="email" onblur="check_email_exists($(this).val());" id="customer-email" class="product-custom-option model-field-value"  required="required" />
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-md-4">                            
                            <dl>
                                <dt><label id="frame_color_label">Land Phone</label></dt>
                                <dd>
                                    <div class="input-box">
                                        <input type="text" id="customer-land-phone" class="product-custom-option model-field-value"  required="required" />
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-md-4">                            
                            <dl>
                                <dt><label id="frame_color_label">Mobile Phone</label></dt>
                                <dd>
                                    <div class="input-box">
                                        <input type="text" id="customer-mobile" class="product-custom-option model-field-value"  required="required" />
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">                            
                            <dl>
                                <dt><label id="frame_color_label">Password</label></dt>
                                <dd>
                                    <div class="input-box">
                                        <input type="password" minlength="6" maxlength="15" id="customer-password" class="product-custom-option model-field-value" required="required" />
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-md-6">                            
                            <dl>
                                <dt><label id="frame_color_label">Re-type Password</label></dt>
                                <dd>
                                    <div class="input-box">
                                        <input type="password" minlength="6" maxlength="15" id="customer-password2" class="product-custom-option model-field-value" required="required" />
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">                            
                            <dl>
                                <dt><label id="frame_color_label">Government Issued ID</label></dt>
                                <dd>
                                    <div class="input-box">
                                        <input type="text" id="customer-gov-id" class="product-custom-option model-field-value" required="required" />
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-md-6">                            
                            <dl>
                                <dt><label id="frame_color_label">ID Type</label></dt>
                                <dd>
                                    <div class="input-box">
                                        <select  id="customer-gov-id-type" class=" required-entry product-custom-option" title="" required="required">
                                            <option value="">-- Please Select --</option>
                                            <?php
                                            foreach ($id_types as $type) {
                                                $txt = '';
                                                if ($type == 'GOV_ID') {
                                                    $txt = 'National ID';
                                                } else {
                                                    $txt = ucfirst(strtolower(str_replace('_', ' ', $type)));
                                                }
                                                ?>
                                                <option value="<?= $type ?>"><?= $txt ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
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
                                        <input type="text" id="customer-address" class="product-custom-option model-field-value"  required="required" />
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-md-4">                            
                            <dl>
                                <dt><label id="frame_color_label">City</label></dt>
                                <dd>
                                    <div class="input-box">
                                        <input type="text" id="customer-city" class="product-custom-option model-field-value"  required="required" />
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-md-4">                            
                            <dl>
                                <dt><label id="frame_color_label">Country</label></dt>
                                <dd>
                                    <div class="input-box">
                                        <input type="text" id="customer-country" class="product-custom-option model-field-value"  required="required" />
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
                <button type="button" id="btn-signup-action" onclick="signup_customer()" class="button btn-submit">Sign Up</button>
            </div>
        </div>
    </div>
</div>
<!--End:Signup Modal-->

<!--Signout Modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="signout-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title site-modal-header">Sign Out</h5>

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
</script>


<script src="<?= base_url('public/') ?>plugins/jquery-cookie/jquery.cookie.js" type="text/javascript"></script>
<script src="<?= base_url('public/') ?>js/site/item_view.js" type="text/javascript"></script>
<script src="<?= base_url('public/') ?>js/site/custom.js" type="text/javascript"></script>


