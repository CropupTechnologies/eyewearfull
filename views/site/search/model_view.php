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
                    <div id="messages_product_view"></div>
                    <div class="product-view large-image-type" itemscope itemtype="http://schema.org/Offer">
                        <div class="product-essential row">
                            <form action="<?= base_url('search/search_stock') ?>" method="post" id="product-addtocart-form" >
                                <div class="no-display">
                                    <input type="hidden" name="model-id" value="<?= $model['id'] ?>" />
                                </div>
                                <div class="product-name">
                                    <h1><?= $model['model_name'] ?></h1>
                                </div>
                                <div class="product-img-box col-xs-12  col-lg-8 col-sm-6">
                                    <?php
                                    $images = [];
                                    $enable_count = 0;
                                    if (count($all_model_images) > 0) {
                                        for ($n = 0; $n < count($model['images']); $n++) {
                                            if ($all_model_images[$n]['enabled'] == 1) {
                                                $enable_count++;
                                            }
                                        }
                                    }
                                    if ($enable_count > 0) {
                                        for ($n = 0; $n < count($all_model_images); $n++) {
                                            if ($all_model_images[$n]['enabled'] == 1) {
                                                $images[] = [
                                                    base_url('public/runningimages/model/image/' . $all_model_images[$n]['image_name']),
                                                    base_url('public/runningimages/model/zoom/' . $all_model_images[$n]['zoom_image_name']),
                                                    base_url('public/runningimages/model/thumbnail/' . $all_model_images[$n]['thumbnail_image_name']),
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
                                    <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails is-ready col-lg-10" >
                                        <a href="<?= $images[0][1] ?>">
                                            <img src="<?= $images[0][0] ?>" alt="" width="640" height="360">
                                        </a>
                                    </div>
                                    <div class="col-md-12">
<!--                                        <div class="add-to-cart-buttons" style="margin-top:25px;">
                                            <button type="button" title="Virtual Try On" class="button btn-cart" onclick=""><span><span><i class="fa fa-binoculars"></i>&nbsp;&nbsp; Virtual Try On</span></span>
                                            </button>
                                        </div>-->
                                    </div>
                                    <div class="col-md-12">
                                        <div class="model-desc">
                                            <h3>Description</h3>
                                            <p><?= htmlspecialchars_decode($model['description']) ?></p>
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

                                            <h3>Please choose your options</h3>
                                        </div>

                                        <div class="clear"></div>

                                        <div class="product-options" id="product-options-wrapper">
                                            <p class="required">All Fields Required</p>

                                            <dl id="model-fields">
                                                <?php
                                                if ($model_fields != NULL && count($model_fields) > 0) {
                                                    foreach ($model_fields as $m_field) {
                                                        if ($m_field['enabled'] == 1) {
                                                            ?>
                                                            <dt><label id="frame_color_label"><?= $m_field['field_name'] ?></label></dt>
                                                            <dd>
                                                                <div class="input-box">
                                                                    <input type="text" class="model-field-value" value="<?= $m_field['value'] ?>" disabled="disabled"/>
                                                                </div>
                                                            </dd>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </dl>
                                            <dl>
                                                <?php
                                                if ($product_fields != NULL && count($product_fields) > 0) {
                                                    foreach ($product_fields as $field) {
                                                        if ($field['enabled'] == 1) {
                                                            if ($field['field_type'] == 'LIST') {
                                                                $required_asterix = '';
//                                                            $required_class = '';
                                                                $required_class = 'class="required"';
//                                                            if ($field['is_optional'] == 1) {
//                                                                $required_asterix = '*';
//                                                            }
                                                                ?>
                                                                <dt><label ><em><?= $required_asterix ?></em><?= $field['field_name'] . ' ' . $field['unit'] ?></label></dt>
                                                                <dd>
                                                                    <div class="input-box">
                                                                        <select name="<?= $field['html_id'] ?>" id="<?= $field['html_id'] ?>" class=" required-entry product-custom-option" title="" <?= $required_class ?>>
                                                                            <option value="">-- Please Select --</option>
                                                                            <?php
                                                                            foreach ($field['all_values'] as $val) {
                                                                                $v = $val['value'];
                                                                                if (isset($val['text_value'])) {
                                                                                    $v = $val['text_value'];
                                                                                }
                                                                                ?>
                                                                                <option value="<?= $val['id'] ?>"><?= $v ?></option>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </dd>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                            </dl>
                                        </div>
                                        <div class="pull-right">
                                            <button type="button" onclick="search_submit()" title="Check Stock Availability" id='btn-check-stock' class="btn btn-success no-border-radious" onclick=""><span>Check Stock Availability&nbsp;&nbsp; <i class="fa fa-arrow-right"></i></span></span>
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
<script>
                                                var $easyzoom = $('.easyzoom').easyZoom();
                                                var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');
                                                messages[705] = '<?= $this->config->item(705, 'msg') ?>';
                                                $('.thumbnails').on('click', 'a', function (e) {
                                                    var $this = $(this);

                                                    e.preventDefault();

                                                    // Use EasyZoom's `swap` method
                                                    api1.swap($this.data('standard'), $this.attr('href'));
                                                });
                                                function search_submit() {
                                                    $('#product-addtocart-form').parsley();
                                                    $('#product-addtocart-form').parsley('validate');
                                                    if ($('#product-addtocart-form').parsley().isValid()) {
                                                        var valid = true;
                                                        $('.product-custom-option').each(function (index, item) {
                                                            var value = $(item).val().trim();
                                                            if (value == undefined || value.length == 0) {
                                                                valid = false;
                                                                return;
                                                            }
                                                        });
                                                        if (valid) {
                                                            $('#product-addtocart-form')[0].submit();
                                                        } else {
                                                            show_message(705, messages[705], null, false, "Eyewear Notification");
                                                        }
                                                    }
                                                }
                                                //<![CDATA[
//                                                                            Mage.Cookies.path = '../magento_61193';
//                                                                            Mage.Cookies.domain = '.ld-magento.template-help.com';
                                                //]]>
</script>

<!--<script type="text/javascript">
    //<![CDATA[
    optionalZipCountries = ["HK", "IE", "MO", "PA"];
    //]]>
</script>
<script type="text/javascript">
    //<![CDATA[
//                                        var Translator = new Translate([]);
    //]]>
</script>
<script type="text/javascript">
//                                        truncateOptions();
    decorateList('cart-sidebar', 'none-recursive');
    $j('document').ready(function () {
        var minicartOptions = {
            formKey: "w3uyieDxFkE5Whyx"
        }
        if (typeof Minicart != 'undefined') {
            var Mini = new Minicart(minicartOptions);
            Mini.init();
        }
        ;

    });
</script>
<script type="text/javascript">
//                                        truncateOptions();
    decorateList('cart-sidebar', 'none-recursive');
    $j('document').ready(function () {
        var minicartOptions = {
            formKey: "w3uyieDxFkE5Whyx"
        }
        if (typeof Minicart != 'undefined') {
            var Mini = new Minicart(minicartOptions);
            Mini.init();
        }
        ;

    });
</script>
<script type="text/javascript">
    var optionsPrice = new Product.OptionsPrice({
        "productId": "36",
        "priceFormat": {
            "pattern": "\u20ac%s",
            "precision": 2,
            "requiredPrecision": 2,
            "decimalSymbol": ".",
            "groupSymbol": ",",
            "groupLength": 3,
            "integerRequired": 1
        },
        "includeTax": "false",
        "showIncludeTax": false,
        "showBothPrices": false,
        "productPrice": 28.268,
        "productOldPrice": 32.5082,
        "priceInclTax": 28.268,
        "priceExclTax": 28.268,
        "skipCalculate": 1,
        "defaultTax": 8.25,
        "currentTax": 0,
        "idSuffix": "_clone",
        "oldPlusDisposition": 0,
        "plusDisposition": 0,
        "plusDispositionTax": 0,
        "oldMinusDisposition": 0,
        "minusDisposition": 0,
        "tierPrices": [],
        "tierPricesInclTax": []
    });
</script>

<script type="text/javascript">
    $j(document).on('product-media-loaded', function () {
        ConfigurableMediaImages.init('base_image');
        ConfigurableMediaImages.setImageFallback(36, $j.parseJSON('{"option_labels":{"brown":{"configurable_product":{"small_image":null,"base_image":null},"products":["37","38"]},"black":{"configurable_product":{"small_image":null,"base_image":null},"products":["39"]},"40 mm":{"configurable_product":{"small_image":null,"base_image":null},"products":["37"]},"50 mm":{"configurable_product":{"small_image":null,"base_image":null},"products":["38"]},"57 mm":{"configurable_product":{"small_image":null,"base_image":null},"products":["39"]}},"small_image":[],"base_image":{"37":"<?= base_url('public') ?>/images/product_images/image/1/specsavers_unisex_341_3_1.jpg","38":"<?= base_url('public') ?>/images/product_images/image/1/specsavers_unisex_341_3_2.jpg","39":"<?= base_url('public') ?>/images/product_images/image/1/specsavers_unisex_341_2_1.jpg","36":"<?= base_url('public') ?>/images/product_images/image/1/specsavers_unisex_341_1.jpg"}}'));
        $j(document).trigger('configurable-media-images-init', ConfigurableMediaImages);
    });
</script>
<script type="text/javascript">
    //<![CDATA[
    // $('stock-qty-36').observe('click', function(event){
    //     this.toggleClassName('expanded');
    //     $('stock-qty-36-details').toggleClassName('no-display');
    //     event.stop();
    //     decorateTable('stock-qty-36-details');
    // });
    //]]>
</script>

<script type="text/javascript">
    jQuery(document).ready(function () {

        jQuery('a.moveToTab').click(function (e) {
            moveToTab();
        })
    });

    function moveToTab() {
        jQuery('dt, dd', '#collateral-tabs').each(function () {
            jQuery(this).removeClass('current');
        });
        jQuery('.product-collateral .toggle-tabs li').each(function () {
            jQuery(this).removeClass('current');
            jQuery('#reviews', this).parents('li').click();
        })
        jQuery('html, body').animate({
            scrollTop: jQuery('.product-collateral').offset().top - 80
        }, 'fast');
    }
</script>
<script type="text/javascript">
    var spConfig = new Product.Config({
        "attributes": {
            "147": {
                "id": "147",
                "code": "frame_color",
                "label": "Frame color",
                "options": [{
                        "id": "33",
                        "label": "brown",
                        "price": "0",
                        "oldPrice": "0",
                        "products": ["37", "38"]
                    }, {
                        "id": "34",
                        "label": "black",
                        "price": "0",
                        "oldPrice": "0",
                        "products": ["39"]
                    }]
            },
            "148": {
                "id": "148",
                "code": "size",
                "label": "Size",
                "options": [{
                        "id": "36",
                        "label": "40 mm",
                        "price": "3.53",
                        "oldPrice": "3.53",
                        "products": ["37"]
                    }, {
                        "id": "37",
                        "label": "50 mm",
                        "price": "7.07",
                        "oldPrice": "7.07",
                        "products": ["38"]
                    }, {
                        "id": "38",
                        "label": "57 mm",
                        "price": "10.6",
                        "oldPrice": "10.6",
                        "products": ["39"]
                    }]
            }
        },
        "template": "\u20ac#{price}",
        "basePrice": "28.268",
        "oldPrice": "32.5082",
        "productId": "36",
        "chooseText": "Choose an Option...",
        "taxConfig": {
            "includeTax": false,
            "showIncludeTax": false,
            "showBothPrices": false,
            "defaultTax": 8.25,
            "currentTax": 0,
            "inclTaxTitle": "Incl. Tax"
        }
    });
</script>
<script type="text/javascript">
    document.observe('dom:loaded', function () {
        var swatchesConfig = new Product.ConfigurableSwatches(spConfig);
    });
</script>
<script type="text/javascript">
    //<![CDATA[
    var DateOption = Class.create({
        getDaysInMonth: function (month, year) {
            var curDate = new Date();
            if (!month) {
                month = curDate.getMonth();
            }
            if (2 == month && !year) { // leap year assumption for unknown year
                return 29;
            }
            if (!year) {
                year = curDate.getFullYear();
            }
            return 32 - new Date(year, month - 1, 32).getDate();
        },
        reloadMonth: function (event) {
            var selectEl = event.findElement();
            var idParts = selectEl.id.split("_");
            if (idParts.length != 3) {
                return false;
            }
            var optionIdPrefix = idParts[0] + "_" + idParts[1];
            var month = parseInt($(optionIdPrefix + "_month").value);
            var year = parseInt($(optionIdPrefix + "_year").value);
            var dayEl = $(optionIdPrefix + "_day");

            var days = this.getDaysInMonth(month, year);

            //remove days
            for (var i = dayEl.options.length - 1; i >= 0; i--) {
                if (dayEl.options[i].value > days) {
                    dayEl.remove(dayEl.options[i].index);
                }
            }

            // add days
            var lastDay = parseInt(dayEl.options[dayEl.options.length - 1].value);
            for (i = lastDay + 1; i <= days; i++) {
                this.addOption(dayEl, i, i);
            }
        },
        addOption: function (select, text, value) {
            var option = document.createElement('OPTION');
            option.value = value;
            option.text = text;

            if (select.options.add) {
                select.options.add(option);
            } else {
                select.appendChild(option);
            }
        }
    });
    dateOption = new DateOption();
    //]]>
</script>

<script type="text/javascript">
    //<![CDATA[
    var optionFileUpload = {
        productForm: $('product_addtocart_form'),
        formAction: '',
        formElements: {},
        upload: function (element) {
            this.formElements = this.productForm.select('input', 'select', 'textarea', 'button');
            this.removeRequire(element.readAttribute('id').sub('option_', ''));

            template = '<iframe id="upload_target" name="upload_target" style="width:0; height:0; border:0;"><\/iframe>';

            Element.insert($('option_' + element.readAttribute('id').sub('option_', '') + '_uploaded_file'), {
                after: template
            });

            this.formAction = this.productForm.action;

            var baseUrl = 'catalog/product/upload/';
            var urlExt = 'option_id/' + element.readAttribute('id').sub('option_', '');

            this.productForm.action = parseSidUrl(baseUrl, urlExt);
            this.productForm.target = 'upload_target';
            this.productForm.submit();
            this.productForm.target = '';
            this.productForm.action = this.formAction;
        },
        removeRequire: function (skipElementId) {
            for (var i = 0; i < this.formElements.length; i++) {
                if (this.formElements[i].readAttribute('id') != 'option_' + skipElementId + '_file' && this.formElements[i].type != 'button') {
                    this.formElements[i].disabled = 'disabled';
                }
            }
        },
        addRequire: function (skipElementId) {
            for (var i = 0; i < this.formElements.length; i++) {
                if (this.formElements[i].readAttribute('name') != 'options_' + skipElementId + '_file' && this.formElements[i].type != 'button') {
                    this.formElements[i].disabled = '';
                }
            }
        },
        uploadCallback: function (data) {
            this.addRequire(data.optionId);
            $('upload_target').remove();

            if (data.error) {

            } else {
                $('option_' + data.optionId + '_uploaded_file').value = data.fileName;
                $('option_' + data.optionId + '_file').value = '';
                $('option_' + data.optionId + '_file').hide();
                $('option_' + data.optionId + '').hide();
                template = '<div id="option_' + data.optionId + '_file_box"><a href="#"><img src="var/options/' + data.fileName + '" alt=""><\/a><a href="#" onclick="optionFileUpload.removeFile(' + data.optionId + ')" title="Remove file" \/>Remove file<\/a>';

                Element.insert($('option_' + data.optionId + '_uploaded_file'), {
                    after: template
                });
            }
        },
        removeFile: function (optionId) {
            $('option_' + optionId + '_uploaded_file').value = '';
            $('option_' + optionId + '_file').show();
            $('option_' + optionId + '').show();

            $('option_' + optionId + '_file_box').remove();
        }
    }
    var optionTextCounter = {
        count: function (field, cntfield, maxlimit) {
            if (field.value.length > maxlimit) {
                field.value = field.value.substring(0, maxlimit);
            } else {
                cntfield.innerHTML = maxlimit - field.value.length;
            }
        }
    }

    Product.Options = Class.create();
    Product.Options.prototype = {
        initialize: function (config) {
            this.config = config;
            this.reloadPrice();
            document.observe("dom:loaded", this.reloadPrice.bind(this));
        },
        reloadPrice: function () {
            var config = this.config;
            var skipIds = [];
            $$('body .product-custom-option').each(function (element) {
                var optionId = 0;
                element.name.sub(/[0-9]+/, function (match) {
                    optionId = parseInt(match[0], 10);
                });
                if (config[optionId]) {
                    var configOptions = config[optionId];
                    var curConfig = {
                        price: 0
                    };
                    if (element.type == 'checkbox' || element.type == 'radio') {
                        if (element.checked) {
                            if (typeof configOptions[element.getValue()] != 'undefined') {
                                curConfig = configOptions[element.getValue()];
                            }
                        }
                    } else if (element.hasClassName('datetime-picker') && !skipIds.include(optionId)) {
                        dateSelected = true;
                        $$('.product-custom-option[id^="options_' + optionId + '"]').each(function (dt) {
                            if (dt.getValue() == '') {
                                dateSelected = false;
                            }
                        });
                        if (dateSelected) {
                            curConfig = configOptions;
                            skipIds[optionId] = optionId;
                        }
                    } else if (element.type == 'select-one' || element.type == 'select-multiple') {
                        if ('options' in element) {
                            $A(element.options).each(function (selectOption) {
                                if ('selected' in selectOption && selectOption.selected) {
                                    if (typeof (configOptions[selectOption.value]) != 'undefined') {
                                        curConfig = configOptions[selectOption.value];
                                    }
                                }
                            });
                        }
                    } else {
                        if (element.getValue().strip() != '') {
                            curConfig = configOptions;
                        }
                    }
                    if (element.type == 'select-multiple' && ('options' in element)) {
                        $A(element.options).each(function (selectOption) {
                            if (('selected' in selectOption) && typeof (configOptions[selectOption.value]) != 'undefined') {
                                if (selectOption.selected) {
                                    curConfig = configOptions[selectOption.value];
                                } else {
                                    curConfig = {
                                        price: 0
                                    };
                                }
                                optionsPrice.addCustomPrices(optionId + '-' + selectOption.value, curConfig);
                                optionsPrice.reload();
                            }
                        });
                    } else {
                        optionsPrice.addCustomPrices(element.id || optionId, curConfig);
                        optionsPrice.reload();
                    }
                }
            });
        }
    }

    function validateOptionsCallback(elmId, result) {
        var container = $(elmId).up('ul.options-list');
        if (result == 'failed') {
            container.removeClassName('validation-passed');
            container.addClassName('validation-failed');
        } else {
            container.removeClassName('validation-failed');
            container.addClassName('validation-passed');
        }
    }
    var opConfig = new Product.Options({
        "37": {
            "79": {
                "price": 14.8407,
                "oldPrice": 14.8407,
                "priceValue": "21.0000",
                "type": "fixed",
                "excludeTax": 14.84,
                "includeTax": 14.84
            },
            "78": {
                "price": 10.6005,
                "oldPrice": 10.6005,
                "priceValue": "15.0000",
                "type": "fixed",
                "excludeTax": 10.6,
                "includeTax": 10.6
            }
        },
        "36": {
            "76": {
                "price": 10.6005,
                "oldPrice": 10.6005,
                "priceValue": "15.0000",
                "type": "fixed",
                "excludeTax": 10.6,
                "includeTax": 10.6
            },
            "77": {
                "price": 3.5335,
                "oldPrice": 3.5335,
                "priceValue": "5.0000",
                "type": "fixed",
                "excludeTax": 3.53,
                "includeTax": 3.53
            }
        },
        "38": {
            "80": {
                "price": 0,
                "oldPrice": 0,
                "priceValue": "0.0000",
                "type": "fixed",
                "excludeTax": 0,
                "includeTax": 0
            }
        }
    });
    //]]>
</script>

<script type="text/javascript">
    //<![CDATA[
    enUS = {
        "m": {
            "wide": ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            "abbr": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
        }
    }; // en_US locale reference
    Calendar._DN = ["domingo", "lunes", "martes", "mi\u00e9rcoles", "jueves", "viernes", "s\u00e1bado"]; // full day names
    Calendar._SDN = ["dom.", "lun.", "mar.", "mi\u00e9.", "jue.", "vie.", "s\u00e1b."]; // short day names
    Calendar._FD = 0; // First day of the week. "0" means display Sunday first, "1" means display Monday first, etc.
    Calendar._MN = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"]; // full month names
    Calendar._SMN = ["ene.", "feb.", "mar.", "abr.", "may.", "jun.", "jul.", "ago.", "sept.", "oct.", "nov.", "dic."]; // short month names
    Calendar._am = "a. m."; // am/pm
    Calendar._pm = "p. m.";

    // tooltips
    Calendar._TT = {};
    Calendar._TT["INFO"] = 'About the calendar';

    Calendar._TT["ABOUT"] =
            'DHTML Date/Time Selector\n' +
            "(c) dynarch.com 2002-2005 / Author: Mihai Bazon\n" +
            'For latest version visit: http://www.dynarch.com/projects/calendar/\n' +
            'Distributed under GNU LGPL. See http://gnu.org/licenses/lgpl.html for details.' +
            '\n\n' +
            'Date selection:\n' +
            '- Use the \xab, \xbb buttons to select year\n' +
            '- Use the \u2039 buttons to select month\n' +
            '- Hold mouse button on any of the above buttons for faster selection.';
    Calendar._TT["ABOUT_TIME"] = '\n\n' +
            'Time selection:\n' +
            '- Click on any of the time parts to increase it\n' +
            '- or Shift-click to decrease it\n' +
            '- or click and drag for faster selection.';

    Calendar._TT["PREV_YEAR"] = 'Prev. year (hold for menu)';
    Calendar._TT["PREV_MONTH"] = 'Prev. month (hold for menu)';
    Calendar._TT["GO_TODAY"] = 'Go Today';
    Calendar._TT["NEXT_MONTH"] = 'Next month (hold for menu)';
    Calendar._TT["NEXT_YEAR"] = 'Next year (hold for menu)';
    Calendar._TT["SEL_DATE"] = 'Select date';
    Calendar._TT["DRAG_TO_MOVE"] = 'Drag to move';
    Calendar._TT["PART_TODAY"] = ' (' + "hoy" + ')';

    // the following is to inform that "%s" is to be the first day of week
    Calendar._TT["DAY_FIRST"] = 'Display %s first';

    // This may be locale-dependent. It specifies the week-end days, as an array
    // of comma-separated numbers. The numbers are from 0 to 6: 0 means Sunday, 1
    // means Monday, etc.
    Calendar._TT["WEEKEND"] = "0,6";

    Calendar._TT["CLOSE"] = 'Close';
    Calendar._TT["TODAY"] = "hoy";
    Calendar._TT["TIME_PART"] = '(Shift-)Click or drag to change value';

    // date formats
    Calendar._TT["DEF_DATE_FORMAT"] = "%m\/%d\/%Y";
    Calendar._TT["TT_DATE_FORMAT"] = "%e '%ee' %B '%ee' %Y";

    Calendar._TT["WK"] = "semana";
    Calendar._TT["TIME"] = 'Time:';
    //]]>
</script>
<script type="text/javascript">
    decorateGeneric($$('#product-options-wrapper dl'), ['last']);
</script>

<script type='text/javascript'>
    var addthis_product = 'mag-1.0.1';
    var addthis_config = {
        pubid: 'unknown'

    }
</script>
<script type="text/javascript" src="<?= base_url('public/') ?>js/site/addthis_widget.js"></script>
<script type="text/javascript">

    //<![CDATA[
    var productAddToCartForm = new VarienForm('product_addtocart_form');
    productAddToCartForm.submit = function (button, url) {
        if (this.validator.validate()) {
            var form = this.form;
            var oldUrl = form.action;

            if (url) {
                form.action = url;
            }
            var e = null;
            try {
                this.form.submit();
            } catch (e) {
            }
            this.form.action = oldUrl;
            if (e) {
                throw e;
            }

            if (button && button != 'undefined') {
                button.disabled = true;
            }
        }
    }.bind(productAddToCartForm);

    productAddToCartForm.submitLight = function (button, url) {
        if (this.validator) {
            var nv = Validation.methods;
            delete Validation.methods['required-entry'];
            delete Validation.methods['validate-one-required'];
            delete Validation.methods['validate-one-required-by-name'];
            // Remove custom datetime validators
            for (var methodName in Validation.methods) {
                if (methodName.match(/^validate-datetime-.*/i)) {
                    delete Validation.methods[methodName];
                }
            }

            if (this.validator.validate()) {
                if (url) {
                    this.form.action = url;
                }
                this.form.submit();
            }
            Object.extend(Validation.methods, nv);
        }
    }.bind(productAddToCartForm);
    //]]>
</script>
<script type="text/javascript">
    decorateTable('product-attribute-specs-table')
</script>
<script type="text/javascript">
    //<![CDATA[
    var addTagFormJs = new VarienForm('addTagForm');

    function submitTagForm() {
        if (addTagFormJs.validator.validate()) {
            addTagFormJs.form.submit();
        }
    }
    //]]>
</script>
<script type="text/javascript">
    jQuery('#video-frame').attr('frameborder', '0');
</script>
<script type="text/javascript">
    decorateList('block-related', 'none-recursive')
</script>
<script type="text/javascript">
    //<![CDATA[
    $$('.related-checkbox').each(function (elem) {
        Event.observe(elem, 'click', addRelatedToProduct)
    });

    var relatedProductsCheckFlag = false;

    function selectAllRelated(txt) {
        if (relatedProductsCheckFlag == false) {
            $$('.related-checkbox').each(function (elem) {
                elem.checked = true;
            });
            relatedProductsCheckFlag = true;
            txt.innerHTML = "unselect all";
        } else {
            $$('.related-checkbox').each(function (elem) {
                elem.checked = false;
            });
            relatedProductsCheckFlag = false;
            txt.innerHTML = "select all";
        }
        addRelatedToProduct();
    }

    function addRelatedToProduct() {
        var checkboxes = $$('.related-checkbox');
        var values = [];
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked)
                values.push(checkboxes[i].value);
        }
        if ($('related-products-field')) {
            $('related-products-field').value = values.join(',');
        }
    }
    //]]>
</script>

<script type="text/javascript">
    jQuery(document).ready(function () {

        jQuery('a.moveToTab').click(function (e) {
            moveToTab();
        })
    });

    function moveToTab() {
        jQuery('dt, dd', '#collateral-tabs').each(function () {
            jQuery(this).removeClass('current');
        });
        jQuery('.product-collateral .toggle-tabs li').each(function () {
            jQuery(this).removeClass('current');
            jQuery('#reviews', this).parents('li').click();
        })
        jQuery('html, body').animate({
            scrollTop: jQuery('.product-collateral').offset().top - 80
        }, 'fast');
    }
</script>

<script type="text/javascript">
    jQuery(document).ready(function () {

        jQuery('a.moveToTab').click(function (e) {
            moveToTab();
        })
    });

    function moveToTab() {
        jQuery('dt, dd', '#collateral-tabs').each(function () {
            jQuery(this).removeClass('current');
        });
        jQuery('.product-collateral .toggle-tabs li').each(function () {
            jQuery(this).removeClass('current');
            jQuery('#reviews', this).parents('li').click();
        })
        jQuery('html, body').animate({
            scrollTop: jQuery('.product-collateral').offset().top - 80
        }, 'fast');
    }
</script>

<script type="text/javascript">
    jQuery(document).ready(function () {

        jQuery('a.moveToTab').click(function (e) {
            moveToTab();
        })
    });

    function moveToTab() {
        jQuery('dt, dd', '#collateral-tabs').each(function () {
            jQuery(this).removeClass('current');
        });
        jQuery('.product-collateral .toggle-tabs li').each(function () {
            jQuery(this).removeClass('current');
            jQuery('#reviews', this).parents('li').click();
        })
        jQuery('html, body').animate({
            scrollTop: jQuery('.product-collateral').offset().top - 80
        }, 'fast');
    }
</script>

<script type="text/javascript">
    var lifetime = 3600;
    var expireAt = Mage.Cookies.expires;
    if (lifetime > 0) {
        expireAt = new Date();
        expireAt.setTime(expireAt.getTime() + lifetime * 1000);
    }
    Mage.Cookies.set('external_no_cache', 1, expireAt);
</script>
<script type="text/javascript">
    //<![CDATA[
    var newsletterSubscriberFormDetail = new VarienForm('newsletter-validate-detail');
    document.getElementById("newsletter").setAttribute('autocapitalize', 'off');
    document.getElementById("newsletter").setAttribute('autocorrect', 'off');
    //]]>
</script>

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "<?= base_url('public/') ?>js/site/sdk.js#xfbml=1&version=v2.3&appId=734741803247761";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    if (jQuery) {
        (function (jQuery) {
            var o = jQuery('.fb-page');

            jQuery(window).load(function () {
                o.css({
                    'display': 'block'
                })
                        .find('span').css({
                    'width': '100%',
                    'display': 'block',
                    'text-align': 'inherit'
                })
                        .find('iframe').css({
                    'display': 'inline-block',
                    'position': 'static'
                });
            });

            jQuery(window).on('load resize', function () {
                if (o.parent().width() < o.find('iframe').width()) {
                    o.find('iframe').css({
                        'transform': 'scale(' + (o.width() / o.find('iframe').width()) + ')',
                        'transform-origin': '0% 0%'
                    })
                            .parent().css({
                        'height': (o.find('iframe').height() * (o.width() / o.find('iframe').width())) + 'px'
                    });
                } else {
                    o
                            .find('span').css({
                        'height': 'auto'
                    })
                            .find('iframe').css({
                        'transform': 'none'
                    });
                }
            });
        })(jQuery);
    }
</script>-->

<script src="<?= base_url('public/') ?>js/site/custom.js" type="text/javascript"></script>


