<div id="preloader"></div>
<?php
$enable_count = 0;
if ($cart_items && count($cart_items) > 0) {
    foreach ($cart_items as $c_item) {
        if ($c_item['enabled']) {
            $enable_count++;
        }
    }
}
?>
<link href="<?= base_url('public/') ?>css/site/e3edbd6f5f9f7a65762d552b85dd2065.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('public/') ?>css/site/shopping_cart.css" rel="stylesheet" type="text/css"/>
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
                        <strong>Shopping Cart</strong>
                    </a>
                </li>
            </ul>
            <button type="button" title="Back" class="button btn-back pull-right" onclick="window.history.back();"><span><i class="fa fa-arrow-left"></i> &nbsp;Back</span></button>
        </div>
    </div>
    <div class="container">
        <div class="main-container col1-layout">
            <div class="container">

                <div class="main">
                    <div class="col-main">

                        <div class="padding-s theme-block">
                            <?php
                            if (count($cart_items) == 0) {
                                ?>
                                <div id="messages_item_view">No Item Found.</div>
                                <?php
                            } else {
                                ?>
                                <form action="http://ld-magento.template-help.com/magento_61193/checkout/cart/updatePost/" method="post">
                                    <table id="shopping-cart-table" class="cart-table data-table">
                                        <colgroup><col width="1">
                                            <col width="1">
                                            <col width="1">
                                            <col width="1">
                                            <col width="1">
                                            <col width="1">

                                        </colgroup>
                                        <thead>
                                            <tr class="first last">
                                                <th rowspan="1"><span class="nobr">Product</span></th>
                                                <th rowspan="1">&nbsp;</th>
                                                <th class="cart-price-head" colspan="1">
                                                    <span class="nobr">Price (<?= DEFAULT_CURRENCY ?>)</span>
                                                </th>
                                                <th rowspan="1">Qty</th>
                                                <th class="cart-total-head" colspan="1">Subtotal (<?= DEFAULT_CURRENCY ?>)</th>
                                                <th rowspan="1">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr class="first last">
                                                <td colspan="50" class="a-right cart-footer-actions last">
                                                    <!--<button type="submit" style="visibility:hidden;" name="update_cart_action" value="update_qty" title="Update Shopping Cart" class="button button-secondary btn-update"><span><span>Update Shopping Cart</span></span></button>-->
                                                    <button type="button" name="update_cart_action" value="empty_cart" title="Empty Cart" class="button2 btn-empty" id="empty_cart_button"><span><span>Empty Cart</span></span></button>
                                                    <!--<button type="submit" name="update_cart_action" value="update_qty" title="Update Shopping Cart" class="button button-secondary btn-update"><span><span>Update Shopping Cart</span></span></button>-->
                                                    <button type="button" title="Continue Shopping" class="button btn-continue" onclick="window.history.back();"><span><span>Continue Shopping</span></span></button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $cart_total = 0;
                                            foreach ($cart_items as $item) {
                                                $item_data = $item['item_data'];
                                                $del_open = $del_close = '';
                                                $enable_message = 574;
                                                $enable_title = 'Disable';
                                                $btn_class = 'btn-danger';
                                                $enable_class = 'fa-times';
                                                if ($item['enabled'] == FALSE) {
                                                    $del_open = '<del>';
                                                    $del_close = '</del>';
                                                    $enable_message = 573;
                                                    $enable_title = 'Enable';
                                                    $btn_class = 'btn-success';
                                                    $enable_class = 'fa-check';
                                                } else {
                                                    
                                                }
                                                ?>
                                                <?php
                                                if (ALLOW_ORDER_OUT_OF_STOCKS == FALSE) {
                                                    //Not allowed out of stock order
                                                    if ($item_data['stock'] >= $item['qty'] && $item_data['stock'] != null) {
                                                        $cart_total += $item_data['price'] * $item['qty'];
                                                        ?>
                                                        <tr>
                                                            <td class="product-cart-image">
                                                                <a href="" title="<?= $item_data['name'] ?>" class="product-image">
                                                                    <img src="<?= $item_data['image'] ?>" alt="<?= $item_data['name'] ?>">
                                                                </a>
                                                                <ul class="cart-links">
                                                                    <li>
                                                                        <!--<a href="" title="Edit item parameters">Edit</a>-->
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                            <td class="product-cart-info">
                                                                <a href="" title="Remove Item" class="btn-remove btn-remove2">Remove Item</a>
                                                                <h2 class="product-name">
                                                                    <a href=""><?= $item_data['name'] ?></a>
                                                                </h2>
                                                                <div class="product-cart-sku">
                                                                    <span class="label">SKU:</span><?= $item_data['code'] ?></div>
                                                            </td>
                                                            <td class="product-cart-price" data-rwd-label="Price" data-rwd-tax-label="Excl. Tax">
                                                                <span class="cart-price">
                                                                    <span class="price"><?= $del_open . number_format($item_data['price'], 2) . $del_close ?></span>                
                                                                </span>
                                                            </td>
                                                            <td class="product-cart-price" data-rwd-label="Qty">
                                                                <span class="cart-price">
                                                                    <span class="price"><?= $del_open . $item['qty'] . $del_close ?></span>                
                                                                </span>

                                                                                                                                                                            <!--<input type="text"  value="<?= $del_open . $item['qty'] . $del_close ?>" size="4"  title="Qty" class="input-text qty" maxlength="12">-->
                                                                                                                                                                            <!--                                            <button type="submit" name="update_cart_action" data-cart-item-update="" value="update_qty" title="Update" class="button btn-update"><span><span>Update</span></span>
                                                                                                                                                                            </button>-->
                                                                <!--                                            <ul class="cart-links">
                                                                                                                <li>
                                                                                                                    <a href="" title="Edit item parameters">Edit</a>
                                                                                                                </li>
                                                                                                            </ul>-->
                                                            </td>
                                                            <td class="product-cart-total" data-rwd-label="Subtotal">
                                                                <span class="cart-price">
                                                                    <span class="price"><?= $del_open . number_format(($item_data['price'] * $item['qty']), 2) . $del_close ?></span>                            
                                                                </span>
                                                            </td>
                                                            <td class="a-center product-cart-remove last">
                                                                <!--<a href="" title="Remove Item" class="btn-remove btn-remove2">Remove Item</a>-->
                                                                <button class="btn <?= $btn_class ?>" type="button" title="<?= $enable_title ?>" onclick="flip_enable(<?= $item['item'] ?>, <?= $enable_message ?>);"><i class="fa <?= $enable_class ?>"></i></button>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    } else {
                                                        //out of stock items show
                                                        $item_data['price'] = 0;
                                                        $item['qty'] = 0;
                                                        $cart_total += $item_data['price'] * $item['qty'];
                                                        ?>
                                                        <tr>
                                                            <td class="product-cart-image">
                                                                <a href="" title="<?= $item_data['name'] ?>" class="product-image">
                                                                    <img src="<?= $item_data['image'] ?>" alt="<?= $item_data['name'] ?>">
                                                                </a>
                                                                <ul class="cart-links">
                                                                    <li>
                                                                        <!--<a href="" title="Edit item parameters">Edit</a>-->
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                            <td class="product-cart-info">
                                                                <a href="" title="Remove Item" class="btn-remove btn-remove2">Remove Item</a>
                                                                <h2 class="product-name">
                                                                    <a href=""><?= $item_data['name'] ?></a>
                                                                </h2>
                                                                <div class="product-cart-sku">
                                                                    <span class="label">SKU:</span><?= $item_data['code'] ?></div>
                                                            </td>
                                                            <td class="product-cart-price text-center" data-rwd-label="Price" data-rwd-tax-label="Excl. Tax" colspan="3" style="text-align:center;vertical-align: middle;">
                                                                <span class="cart-price">
                                                                    <span class="price">Out Of Stocks</span>                
                                                                </span>
                                                            </td>

                                                            <td class="a-center product-cart-remove last" style="text-align:center;vertical-align: middle;">
                                                                <!--<a href="" title="Remove Item" class="btn-remove btn-remove2">Remove Item</a>-->
                                                                <button class="btn <?= $btn_class ?>" type="button" title="<?= $enable_title ?>" onclick="flip_enable(<?= $item['item'] ?>, <?= $enable_message ?>);"><i class="fa <?= $enable_class ?>"></i></button>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                   
                                                    <?php
                                                } else {
                                                    //allow order out of stock
                                                    $cart_total += $item_data['price'] * $item['qty'];
                                                    ?>
                                                    <tr>
                                                        <td class="product-cart-image">
                                                            <a href="" title="<?= $item_data['name'] ?>" class="product-image">
                                                                <img src="<?= $item_data['image'] ?>" alt="<?= $item_data['name'] ?>">
                                                            </a>
                                                            <ul class="cart-links">
                                                                <li>
                                                                    <!--<a href="" title="Edit item parameters">Edit</a>-->
                                                                </li>
                                                            </ul>
                                                        </td>
                                                        <td class="product-cart-info">
                                                            <a href="" title="Remove Item" class="btn-remove btn-remove2">Remove Item</a>
                                                            <h2 class="product-name">
                                                                <a href=""><?= $item_data['name'] ?></a>
                                                            </h2>
                                                            <div class="product-cart-sku">
                                                                <span class="label">SKU:</span><?= $item_data['code'] ?></div>
                                                        </td>
                                                        <td class="product-cart-price" data-rwd-label="Price" data-rwd-tax-label="Excl. Tax">
                                                            <span class="cart-price">
                                                                <span class="price"><?= $del_open . number_format($item_data['price'], 2) . $del_close ?></span>                
                                                            </span>
                                                        </td>
                                                        <td class="product-cart-price" data-rwd-label="Qty">
                                                            <span class="cart-price">
                                                                <span class="price"><?= $del_open . $item['qty'] . $del_close ?></span>                
                                                            </span>

                                                                                                                                                                <!--<input type="text"  value="<?= $del_open . $item['qty'] . $del_close ?>" size="4"  title="Qty" class="input-text qty" maxlength="12">-->
                                                                                                                                                                <!--                                            <button type="submit" name="update_cart_action" data-cart-item-update="" value="update_qty" title="Update" class="button btn-update"><span><span>Update</span></span>
                                                                                                                                                                </button>-->
                                                            <!--                                            <ul class="cart-links">
                                                                                                            <li>
                                                                                                                <a href="" title="Edit item parameters">Edit</a>
                                                                                                            </li>
                                                                                                        </ul>-->
                                                        </td>
                                                        <td class="product-cart-total" data-rwd-label="Subtotal">
                                                            <span class="cart-price">
                                                                <span class="price"><?= $del_open . number_format(($item_data['price'] * $item['qty']), 2) . $del_close ?></span>                            
                                                            </span>
                                                        </td>
                                                        <td class="a-center product-cart-remove last">
                                                            <!--<a href="" title="Remove Item" class="btn-remove btn-remove2">Remove Item</a>-->
                                                            <button class="btn <?= $btn_class ?>" type="button" title="<?= $enable_title ?>" onclick="flip_enable(<?= $item['item'] ?>, <?= $enable_message ?>);"><i class="fa <?= $enable_class ?>"></i></button>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>     
                                        </tbody>
                                    </table>
                                </form>

                                <?php
                            }
                            ?>

                            <div class="cart-totals-wrapper">
                                <div class="cart-totals">
                                    <table id="shopping-cart-totals-table">
                                        <colgroup><col>
                                            <col width="1">
                                        </colgroup><tfoot>
                                            <tr>
                                                <td  id="grand-total-td"  class="a-right" colspan="1">
                                                    Net Total
                                                </td>
                                                <td  class="a-right">
                                                    <strong><span id="grand-total-span" class="price"><?= DEFAULT_CURRENCY . ' ' . number_format($cart_total, 2) ?></span></strong>
                                                </td>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <tr>
                                                <td id="sub-total-td" class="a-right" colspan="1">
                                                    Subtotal    </td>
                                                <td class="a-right" style="padding-top: 41px; ">
                                                    <span id="sub-total-span"  class="price" ><?= DEFAULT_CURRENCY . ' ' . number_format($cart_total, 2) ?></span>    </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <ul class="checkout-types bottom">
                                        <li class="method-checkout-cart-methods-onepage-bottom">    
                                            <?php
                                            $btn_action = "window.location.href = '" . base_url('site/order_process') . "'";
                                            if ($enable_count == 0) {
                                                $btn_action = "show_message(709, messages[709], null, false, 'Eyewear Notification');";
                                            }
                                            ?>
                                            <button type="button" title="Order Process" id='btn-checkout' class="button btn-default pull-right" onclick="<?= $btn_action ?>"><span><i class="fa fa-shopping-cart">&nbsp;&nbsp;&nbsp;</i>Order Process</span></button>
                                                            <!--<button id="btn-proceed-checkout" type="button" title="Proceed to Checkout" class="button btn-proceed-checkout btn-checkout" onclick="window.location = & #39; https://ld-magento.template-help.com/magento_61193/checkout/onepage/&#39;;"><span><span>Proceed to Checkout</span></span></button>-->
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-8">


                            </div>

                            <div class="col-xs-12 col-md-4">



                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



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
                                                                    hide_check_out_button();
                                                                });

                                                                const BASEURL = '<?= base_url() ?>';
                                                                messages[707] = '<?= $this->config->item(707, 'msg') ?>'
                                                                messages[708] = '<?= $this->config->item(708, 'msg') ?>'
                                                                messages[573] = '<?= $this->config->item(573, 'msg') ?>'
                                                                messages[574] = '<?= $this->config->item(574, 'msg') ?>'
                                                                messages[709] = '<?= $this->config->item(709, 'msg') ?>'
                                                                var $easyzoom = $('.easyzoom').easyZoom();
                                                                var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');
                                                                $('.thumbnails').on('click', 'a', function (e) {
                                                                    var $this = $(this);
                                                                    e.preventDefault();
                                                                    // Use EasyZoom's `swap` method
                                                                    api1.swap($this.data('standard'), $this.attr('href'));
                                                                });

                                                                function hide_check_out_button() {
                                                                    var amount = $('#grand-total-span').text();
                                                                    grand_amount = parseInt(amount.replace(/\D/g, ''));
                                                                    if (grand_amount > 0) {
                                                                        $('#btn-checkout').attr('disabled', false);
                                                                    } else {
                                                                        $('#btn-checkout').attr('disabled', true);
                                                                    }
                                                                }

</script>


<script src="<?= base_url('public/') ?>plugins/jquery-cookie/jquery.cookie.js" type="text/javascript"></script>
<script src="<?= base_url('public/') ?>js/site/item_view.js" type="text/javascript"></script>
<script src="<?= base_url('public/') ?>js/site/custom.js" type="text/javascript"></script>


