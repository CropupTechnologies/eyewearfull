<?php
$cart_total = 0;
//check enable count
$enable_count = 0;
if ($cart_items && count($cart_items) > 0) {
    foreach ($cart_items as $c_item) {
        if ($c_item['enabled']) {
            $enable_count++;
        }
    }
}
?>

<!-- end Top Links -->
<div class="header-minicart desktop">

    <a href="#" data-target-element="#header-cart" class="skip-link skip-cart ">
        <span class="icon"></span>
        <span class="label">Cart</span>
        <span class="count"><?= $enable_count ?></span>
    </a>

    <div id="header-cart" class="block block-cart skip-content">

        <div id="minicart-error-message" class="minicart-message"></div>
        <div id="minicart-success-message" class="minicart-message"></div>

        <div class="minicart-wrapper">

            <?php
            if ($enable_count > 0) {
                ?>
                                                                                                                        <!--                <p class="block-subtitle">
                                                                                                                                            Recently added item(s)
                                                                                                                                            <a class="close skip-link-close material-design-cancel19" href="#" title="Close"></a>
                                                                                                                                        </p>-->
                <div>
                    <ul id="cart-sidebar" class="mini-products-list">
                        <?php
                        foreach ($cart_items as $item) {
                            if ($item['enabled']) {
                                $item_data = $item['item_data'];
                                $price = floatval($item['qty']) * floatval($item_data['price']);
                                $cart_total += $price;
                                $images = $this->Itemmodel->get_item_images($item['item']);
                                $image_src = 'holder.js/90x90';
                                if (count($images) > 0) {
                                    $image = NULL;
                                    foreach ($images as $img) {
                                        if ($img['is_preferred_image'] == 1) {
                                            $image = $img;
                                        }
                                    }
                                    if ($image == NULL) {
                                        $image = $images[0];
                                    }
                                    $image_src = base_url('public/runningimages/item/thumbnail/' . $image['thumbnail_image_name']);
                                }
                                ?>
                                <li class="item" xmlns="http://www.w3.org/1999/html">
                                    <a href="#" title="Alex Perry  " class="product-image"><img src="<?= $image_src ?>" alt="Alex Perry  " /></a>
                                    <div class="product-details">
                                        <p class="product-name"><a href="#"><?= $item_data['name'] ?></a></p>

                                        <div class="product-wrapper">

                                            <table class="info-wrapper">
                                                <tbody>
                                                    <tr>
                                                        <th>Price</th>
                                                        <td>
                                                            <span class="price"><?= number_format($price, 2) ?></span>
                                                        </td>
                                                    </tr>
                                                    <tr class="qty-wrapper">
                                                        <input type="hidden" class="curren_item_id" value="<?= $item['item_data']['id'] ?>"/>
                                                        <input type="hidden" class="curren_item_price" value="<?= $item_data['price'] ?>"/>
                                                        <th>Qty</th>
                                                        <td>
                                                            <input id="" data-link="http://ld-magento.template-help.com/magento_61193/checkout/cart/ajaxUpdate/id/741/uenc/aHR0cDovL2xkLW1hZ2VudG8udGVtcGxhdGUtaGVscC5jb20vbWFnZW50b182MTE5My95b3V0aC5odG1sLw,,/" data-item-id="741" class="qty cart-item-quantity input-text" name="" value="<?= $item['qty'] ?>" readonly="true"/>

                                                            <button id=" data-item-id="741" disabled="disabled" data-update class="button quantity-button">
                                                                <span><span>ok</span></span>
                                                            </button>
                                                            <div class="action-icons">
                                                                <!--                                        <a href="#" title="Edit item" class="btn-edit">
                                                                                                            Edit item            </a>-->
                                                                <!--<a title="Remove This Item" class="remove" onclick="remove_from_cart(<?= $item_data['id'] ?>);">Remove Item</a>-->
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>


                                    </div>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <?php
            } else {
                ?>
                <p class="block-subtitle">There are no items</p>
                <?php
            }
            ?>

            <!--            <div id="minicart-widgets">
                        </div>-->
            <?php
            if (count($cart_items) > 0) {
                ?>
                <div class="minicart-actions">
                    <a title="Checkout" class="button checkout-button" href="<?= base_url('site/shopping_cart') ?>">
                        <span><span>Checkout</span></span>
                    </a>
                    <!--                    <ul class="checkout-types minicart">
                                            <li>
                                            </li>
                                        </ul>-->
                    <!--                    <a class="cart-link" href="../checkout/cart/default.htm">
                                            View Shopping Cart            </a>-->
                </div>
                <?php
            }
            ?>

        </div>
    </div>
</div>
<script>
    messages[701] = '<?= $this->config->item(701, 'msg') ?>';
    messages[702] = '<?= $this->config->item(702, 'msg') ?>';
    messages[704] = '<?= $this->config->item(704, 'msg') ?>';
    messages[718] = '<?= $this->config->item(718, 'msg') ?>';

    
    
    $('.cart-item-quantity').keyup(function () {
        update_cart_items($(this));
    });

    function update_cart_items(el) {
        var update_item_qty = parseInt(el.val());
        var update_item_id = parseInt(el.closest('tr').find('.curren_item_id').val());
        var update_item_price = parseInt(el.closest('tr').find('.curren_item_price').val());

        update_total = update_item_qty * update_item_price;
        el.closest('li').find('.price').text(number_format(update_total, 2, '.', ','));

        $.ajax({
            url: '<?= base_url() ?>site/update_cart',
            type: 'post',
            dataType: 'json',
            data: {update_item_qty: update_item_qty, update_item_id: update_item_id, update_item_price: update_item_price},
            success: function (res) {
                show_message(res.error_no,res.message);
            }
        });


    }

    number_format = function (number, decimals, dec_point, thousands_sep) {
        number = number.toFixed(decimals);

        var nstr = number.toString();
        nstr += '';
        x = nstr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? dec_point + x[1] : '';
        var rgx = /(\d+)(\d{3})/;

        while (rgx.test(x1))
            x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');

        return x1 + x2;
    }
</script>
<script src="<?= base_url('public/') ?>js/site/shopping_cart.js"></script>