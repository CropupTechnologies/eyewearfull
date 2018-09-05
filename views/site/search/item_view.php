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
                <li class="category3">
                    <a href="<?= base_url('search?product=' . $product['id']) ?>" title="<?= (isset($product)) ? $product['name'] : '' ?>"><?= (isset($product)) ? $product['name'] : '' ?></a>
                    <span class="fa fa-angle-right"></span>
                </li>
                <li class="category4">
                    <a href="<?= base_url('search?product=' . $product['id'] . '&category=' . $category_tree['id']) ?>" title="<?= isset($category_tree) ? $category_tree['name'] : '' ?>"><?= isset($category_tree) ? $category_tree['name'] : '' ?></a>
                    <span class="fa fa-angle-right"></span>
                </li>
                <li class="product">
                    <a href="<?= base_url('search?product=' . $product['id'] . '&category=' . $category_tree['sub_category']['id']) ?>" title="<?= isset($category_tree) ? $category_tree['sub_category']['name'] : '' ?>">
                        <strong><?= isset($category_tree) ? $category_tree['sub_category']['name'] : '' ?></strong>
                    </a>

                </li>
            </ul>
            <button type="button" title="Back" class="button btn-back pull-right" onclick="window.history.back();"><span>Back</span></button>
        </div>
    </div>
    <div class="container">
        <div class="main">
            <div class="col-main">

                <div class="padding-s">
                    <?php
                    if ($item == NULL) {
                        ?>
                        <div id="messages_item_view">No Matching Item Found.</div>
                        <?php
                    } else {
                        ?>
                        <div class="product-view large-image-type" itemscope itemtype="http://schema.org/Offer">
                            <div class="product-essential row">
                                <form action="<?= base_url('search/item_view') ?>" method="post" id="product_addtocart_form" enctype="multipart/form-data">
                                    <div class="no-display">
                                        <input type="hidden" name="model-id" value="<?= $model['id'] ?>" />
                                    </div>
                                    <div class="product-name">
                                        <h1><?= $item['name'] ?></h1>
                                    </div>
                                    <div class="product-img-box col-xs-12  col-lg-8 col-sm-6">
                                        <?php
                                        $images = [];
                                        $enable_count = 0;
                                        if (count($all_item_images) > 0) {
                                            for ($n = 0; $n < count($model['images']); $n++) {
                                                if ($all_item_images[$n]['enabled'] == 1) {
                                                    $enable_count++;
                                                }
                                            }
                                        }
                                        if ($all_item_images > 0) {
                                            for ($n = 0; $n < count($all_item_images); $n++) {
                                                if ($all_item_images[$n]['enabled'] == 1) {
                                                    $images[] = [
                                                        base_url('public/runningimages/item/image/' . $all_item_images[$n]['image_name']),
                                                        base_url('public/runningimages/item/zoom/' . $all_item_images[$n]['zoom_image_name']),
                                                        base_url('public/runningimages/item/thumbnail/' . $all_item_images[$n]['thumbnail_image_name']),
                                                    ];
                                                }
                                            }
                                        } else {
                                            $images[] = [
                                                'holder.js/640x360?random=no',
                                                'holder.js/300x300?random=no',
                                                'holder.js/88x88?random=no',
                                            ];
                                        }
                                        ?>

                                        <ul class="thumbnails col-lg-2">
                                            <?php
                                            foreach ($images as $i) {
                                                ?>
                                                <li>
                                                    <a href="<?= $i[1] ?>" data-standard="<?= $i[1] ?>">
                                                        <img src="<?= $i[2] ?>" alt="">
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                        <?php
                                        if (!empty($images)) {
                                            ?>
                                            <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails is-ready col-lg-10" >
                                                <a href="<?= $images[0][1] ?>">
                                                    <img src="<?= $images[0][0] ?>" alt="" width="640" height="360">
                                                </a>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                        <div class="col-md-12">
                                            <!--                                            <div class="add-to-cart-buttons" style="margin-top:25px;">
                                                                                            <button type="button" title="Virtual Try On" class="button btn-cart" onclick=""><span><span><i class="fa fa-binoculars"></i>&nbsp;&nbsp; Virtual Try On</span></span>
                                                                                            </button>
                                                                                        </div>-->
                                        </div>
                                        <div class="col-md-12">
                                            <div class="model-desc">
                                                <h3>Description</h3>
                                                <p><?= htmlspecialchars_decode($item['description']) ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-lg-4 col-sm-6">
                                        <div class="product-shop">

                                            <!-- center mode -->
                                            <!-- /center mode -->

                                            <!--                                        <div class="additional-info">
                                                                                        <p class="availability in-stock" itemprop="availability">
                                                                                            <span class="label">Availability:</span>
                                                                                            <span class="value">In stock</span>
                                                                                        </p>
                                                                                        <div class="clear"></div>
                                                                                    </div>-->
                                            <div class="price-info" itemprop="price">

                                                <div class="price-box">

                        <!--                                                    <p class="special-price">
                                                                                <span class="price-label">Special Price</span>
                                                                                <span class="price" id="product-price-36"><?= DEFAULT_CURRENCY . ' ' . number_format($model['display_price_sale'], 2) ?> </span>
                                                                            </p>-->
                                                    <?php
                                                    $item_price = $item_selling_price;
                                                    if ($item_selling_price == FALSE) {
                                                        $item_price = 'N/A';
                                                    } else {
                                                        $item_price = DEFAULT_CURRENCY . ' ' . number_format($item_selling_price, 2);
                                                    }
                                                    ?>
                                                    <p class="special-price">
                                                        <span class="price-label">Regular Price:</span>
                                                        <span class="price" id="product-price-36"><?= $item_price ?></span>
                                                    </p>
                                                    <?php
                                                    ?>
                                                </div>

                                            </div>

                                            <div class="clear"></div>

                                            <div class="product-options" id="product-options-wrapper">

                                                <dl id="model-fields">
                                                    <?php
                                                    if ($model_fields != NULL && count($model_fields) > 0) {
                                                        foreach ($model_fields as $m_field) {
                                                            ?>
                                                            <dt><label id="frame_color_label"><?= $m_field['field_name'] ?></label></dt>
                                                            <dd>
                                                                <div class="input-box">
                                                                    <input type="text" class="product-custom-option model-field-value" value="<?= $m_field['value'] ?>" disabled="disabled"/>
                                                                </div>
                                                            </dd>
                                                            <?php
                                                        }
                                                    }
                                                    if ($item_field_values != NULL && count($item_field_values) > 0) {
                                                        foreach ($item_field_values as $m_field) {
                                                            $field_value = $m_field['field_value'];
                                                            ?>
                                                            <dt><label id="frame_color_label"><?= $m_field['field_name'] ?></label></dt>
                                                            <dd>
                                                                <div class="input-box">
                                                                    <input type="text" class="product-custom-option model-field-value" value="<?= $field_value ?>" disabled="disabled"/>
                                                                </div>
                                                            </dd>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <dt><label id="frame_color_label"><strong>Quantity</strong></label></dt>
                                                    <dd>
                                                        <div class="input-box">
                                                            <input type="number" class="product-custom-option model-field-value" name="qty" id="qty" required="required" value="1" style="background: yellow;"/>
                                                        </div>
                                                    </dd>
                                                </dl>
                                            </div>
                                            <div class="pull-right">
                                                <?php
                                                $button_action = "show_message(712, messages[712], null, false, 'Eyewear Notification');";
                                                if ($item_selling_price > 0) {
                                                    $button_action = "add_to_cart(" . $item['id'] . ", 1);";
                                                }
                                                ?>
                                                <button type="button" title="Add to Cart" class="btn btn-primary no-border-radious" onclick="<?= $button_action ?>"><span><span><i class="fa fa-cart-plus"></i>&nbsp;&nbsp;Check Stock & Add to Cart</span></span>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div id="product-collateral" class="product-collateral toggle-content tabs">
                                <dl id="collateral-tabs" class="collateral-tabs">
                                </dl>
                            </div>

                            <div id="block-related">
                                <h2>Recently Visited Items</h2>
                                <div class="swipe-carousel">
                                    <div class="swiper-wrapper related-carousel">
                                        <?php
                                        if (count($recent_items) > 1) {
                                            foreach ($recent_items as $m) {
                                                if ($m['id'] != $model['id']) {
                                                    $price = $m['price'];
                                                    ?>
                                                    <div class="product">
                                                        <a href="<?= base_url('search/item_view/' . $m['id']) ?>" title="<?= $m['name'] ?>" class="product-image"><img src="<?= $m['image'] ?>" alt="<?= $m['model_name'] ?>" /></a>
                                                        <div class="product-details">

                                                            <div class="price-box">
                                                                <span class="regular-price" id="product-price-8-related">
                                                                    <span class="price"><?= DEFAULT_CURRENCY . ' ' . number_format($price, 2) ?></span> </span>

                                                            </div>

                                                            <p class="product-name"><a href="<?= base_url('search/item_view/' . $m['id']) ?>"><?= $m['model_name'] ?></a></p>
                                                            <a href="#" class="link-wishlist">Add to Wishlist</a>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        } else {
                                            ?>
                                            <div class="col-md-12 text-center"><p>There are no recent views.</p></div>
                                            <?php
                                        }
                                        ?>

                                    </div>

                                </div>

                            </div>

                            <div id="upsell-product">
                                <h2>You may also be interested in the following product(s)</h2>
                                <div class="up-sell-carousel" id="upsell-product-table">
                                    <?php
                                    if (count($related_items) > 1) {
                                        foreach ($related_items as $m) {
                                            if ($m['id'] != $model['id']) {
                                                $price = $m['price'];
                                                $image = $m['image'];
                                                ?>
                                                <div class="product">
                                                    <a href="<?= base_url('search/item_view/' . $m['id']) ?>" title="<?= $m['name'] ?>" class="product-image"><img src="<?= $image ?>" alt="<?= $m['model_name'] ?>" /></a>
                                                    <div class="product-details">

                                                        <div class="price-box">
                                                            <span class="regular-price" id="product-price-8-related">
                                                                <span class="price"><?= DEFAULT_CURRENCY . ' ' . number_format($price, 2) ?></span> </span>

                                                        </div>

                                                        <p class="product-name"><a href="<?= base_url('search/item_view/' . $m['id']) ?>"><?= $m['model_name'] ?></a></p>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                    } else {
                                        ?>
                                        <div class="col-md-12 text-center"><p>There are no related items.</p></div>
                                        <?php
                                    }
                                    ?>


                                </div>

                            </div>

                        </div>
                        <?php
                    }
                    ?>
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
                const BASEURL = '<?= base_url() ?>';
                messages[712] = "<?= $this->config->item(712, 'msg') ?>"
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



