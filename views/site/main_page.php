<div id="main-slider">
    <div class="widget widget-static-block">
        <link rel="stylesheet" type="text/css" href="<?= base_url('public/css/site/') ?>/camera.css">

        <div class="slider-block">
            <div class="fluid_container_wrap">
                <div class="fluid_container">
                    <div class="camera_wrap" id="camera_wrap">
                        <div data-src="<?= base_url('public/images') ?>/slide/slide2.jpg">
                            <div class="camera_caption slide-1 moveFromLeft">
                                <h3 class="slide-title">a new <span>world</span> <span>of style</span></h3>
                            </div>
                        </div>
                        <div data-src="<?= base_url('public/images') ?>/slide/slide1.jpg">
                            <div class="camera_caption slide-2 moveFromLeft">
                                <h3 class="slide-title">Buy the <span> hottest</span> <span>trends</span></h3>
                            </div>
                        </div>
                        <div data-src="<?= base_url('public/images') ?>/slide/slide3.jpg">
                            <div class="camera_caption slide-3 moveFromLeft">
                                <h3 class="slide-title">Brand <span>new</span> <span>eyewear</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-container col1-layout">
    <div class="container">
        <div class="main">
            <div class="col-main">
                <div class="padding-s">
                    <div class="std">
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="widget widget-new-products container">
        <div class="widget-title">
            <h2>MAKE YOUR ORDER</h2>
        </div>
        <div class="widget-products row">

            <ul class="promotion-item-container-ul">
                <?php
                if (!empty($random_items)) {
                    foreach ($random_items as $random_item) {
                        ?>
                        <li class="col-xs-12 col-sm-4 col-md-3 promotion-item-container-li">
                            <div>
                                <a href="<?= base_url('search/item_view/' . $random_item['id']) ?>" title="" class="product-image" itemprop="url">
                                    <div>
                                        <img src = "<?= base_url(); ?>public/images/promotion-sale.png" class="<?= (!empty($random_item['promotion'])) ? $random_item['promotion']['ui_class'] : ""; ?> promotion-sale-def"/>
                                        <img src = "<?= $random_item['image'] ?>" class="promotion-img-display"/>
                                    </div>
                                </a>

                                <div class="product-details product-details-container">
                                    <h2 class="product-name" itemprop="name"><a href="product_item.html" title="Specsavers UNISEX "><?= $random_item['name'] ?> </a></h2>
                                    <div class="price-box">
                                        <p class="special-price">
                                            <span class="price-label">Special Price</span>
                                            <span class="price" id="product-price-36">
                                                <?= number_format($random_item['price'], 2) ?> 
                                            </span>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </li>
                        <?php
                    }
                }
                ?>                                
            </ul>
        </div>
    </div>

    <div class="widget widget-static-block">
        <div class="banners">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="<?= base_url('site/product_list') ?>" class="banner-3">
                            <div class="img-box"><img src="holder.js/370x770?random=yes" alt="baner-img"></div>
                            <div class="s-desc">
                                <h1>
                                    <span>metal</span>
                                    style
                                </h1>
                                <h4><span>for contemporary</span>
                                    individuals with attitude</h4>
                                <span class="btn-banner">Shop now!</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="<?= base_url('site/product_list') ?>" class="banner-4">
                                    <div class="img-box"><img src="holder.js/370x370?random=yes" alt="baner-img">
                                    </div>
                                    <div class="s-desc">
                                        <h2>
                                            <span>best selling</span>
                                            shapes
                                        </h2>
                                        <h4>in versatile tones</h4>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="<?= base_url('site/product_list') ?>" class="banner-5">
                                    <div class="img-box"><img src="holder.js/370x370?random=yes" alt="baner-img">
                                    </div>
                                    <div class="s-desc">
                                        <h4>Clearance</h4>
                                        <h5>starting at</h5>

                                        <h2>$38</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <a href="<?= base_url('site/product_list') ?>" class="banner-6">
                            <div class="img-box"><img src="<?= base_url('public/images/offer-770-370-01.gif') ?>" alt="baner-img"></div>
                            <div class="s-desc">
<!--                                <h1><span>women’s</span>
                                    sunglasses</h1>-->
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="widget widget-new-products container">
        <div class="widget-title">
            <h2>Products</h2>
        </div>
        <div class="widget-products row">
            <ul class="products-grid new-product-carousel sale-product-carousel">
                <?php
                foreach ($random_products as $product) {
                    ?>
                    <li class="item" itemscope itemtype="http://schema.org/product">
                        <div class="wrapper-hover">
                            <div class="product-image-container">

                                <!--                                <div class="label-product">
                                                                    <span class="new">Sale</span> <span class="sale">Free</span> 
                                                                </div>-->

                                <a href="<?= base_url('search/model_view/') . $product['id'] ?>" title="Specsavers UNISEX " class="product-image" itemprop="url">
                                    <img id="product-collection-image-36" src="<?= base_url() . MODEL_IMAGE_FILE_PATH . $product['image_name']; ?>" alt="Specsavers UNISEX " width="270" height="270" itemprop="image" />
                                </a>

                            </div>

                            <div class="product-details">

                                <h2 class="product-name" itemprop="name"><a href="product_item.html" title="<?= $product['model_name'] ?>"><?= $product['model_name'] ?> </a></h2>

                                <div class="price-box">

                                    <p class="special-price">
                                        <span class="price-label">Special Price</span>
                                        <span class="price" id="product-price-36-widget-catalogsale-">
                                            <?= number_format($product['display_price_sale'], 2) ?>                </span>
                                    </p>
                                    <?php
                                    if ($product['display_price_sale'] != $product['display_price_original']) {
                                        ?>
                                        <p class="old-price">
                                            <span class="price-label">Обычная цена:</span>
                                            <span class="price" id="old-price-36-widget-catalogsale-">
                                                LKR <?= number_format($product['display_price_original'], 2) ?>               </span>
                                        </p>
                                        <?php
                                    }
                                    ?>


                                </div>

                                <div class="wrapper-hover-hiden">

                                    <!--                                    <div class="ratings">
                                                                            <div class="rating-box stars">
                                                                                <i class="review-icon"></i>
                                                                                <i class="review-icon"></i>
                                                                                <i class="review-icon"></i>
                                                                                <i class="review-icon"></i>
                                                                                <i class="review-icon"></i>
                                                                                <div class="rating" style="width:67%">
                                                                                    <div class="mask">
                                                                                        <i class="review-icon"></i>
                                                                                        <i class="review-icon"></i>
                                                                                        <i class="review-icon"></i>
                                                                                        <i class="review-icon"></i>
                                                                                        <i class="review-icon"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <span class="amount"><a href="#" onclick="var t = opener ? opener.window : window; t.location.href = 'review/product/list/id/36/default.htm'; return false;">Отзывы (1)</a></span>
                                                                        </div>-->

                                    <!--                                    <div class="actions">
                                                                            <a title="Подробнее" class="button btn-details" href="product_item.html"><span><span></span></span></a>
                                                                            <ul class="add-to-links">
                                                                                <li>
                                                                                    <a href="#" class="link-wishlist" title="Добавить в лист пожеланий"></a>
                                                                                </li>
                                                                                <li><span class="separator">|</span>
                                                                                    <a href="#" class="link-compare" title="Добавить в сравнение"></a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>-->

                                </div>
                            </div>

                        </div>
                    </li>

                    <?php
                }
                ?>

            </ul>
        </div>
    </div>

    <div class="widget widget-static-block">
        <div id="parallax-block" class="banner-container-2" data-source-url="<?= base_url('public/images/site_images') ?>/parallax-bg.jpg">
            <div class="container">
                <div class="text-wrapper">
                    <h3 class="banner-title">FEMININE <span>PERFECTION</span></h3>
                    <h4>Our best-selling Women's eyeglasses</h4>
                    <a href="<?= base_url('site/product_list') ?>" class="banner-lnk">Shop now!</a>
                </div>
            </div>
        </div>
    </div>
    <div class="blog-bg">
        <div class="widget-latest">
            <div class="container">
                <div class="widget-title center">
                    <h1>EyeWear News</h1>
                </div>
                <div class="row">
                    <ul class="blog-carousel">
                        <li class="blog-item">
                            <div class="postWidget">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="postImage">
                                            <a target="_blank" href="https://www.aop.org.uk/about-aop/aop-news/2017/07/19/children-and-screen-time"><img src="<?= base_url('public/images/home-news1.jpg') ?>" alt="post-img" /></a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">                                       
                                        <div class="widget-latest-title"><a target="_blank" href="https://www.aop.org.uk/about-aop/aop-news/2017/07/19/children-and-screen-time">CHILDREN AND SCREEN TIME</a></div>
                                        <div class="postContent">Our recent Voice of Optometry insight panel survey showed us that parents are worried that screen use is damaging their children’s eyes – with 80% of optometrists reporting they have had patients, in the last month, who have raised concerns. With school summer holiday’s starting this week, and more screen time likely, we’re offering parents four simple tips to help make sure their child’s eyes stay healthy this summer.</div>
                                        <div class="widget-latest-details">
                                            <!--<a class="widget-latest-comment" href="#">-->
                                                <!--<i class="fa fa-comment-o"></i> 3 Comments </a>-->
                                            <span class="widget-latest-data news-source-home">Source : Association of Optometrists</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="blog-item">
                            <div class="postWidget">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="postImage">
                                            <a target="_blank" href="https://www.fashionbeans.com/article/wear-summer-pieces-winter/"><img src="<?= base_url('public/images/home-news2.jpg') ?>" alt="post-img" /></a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">

                                        <div class="widget-latest-title"><a target="_blank" href="https://www.fashionbeans.com/article/wear-summer-pieces-winter/">FDA APPROVES AI FOR DETECTION OF EYE DISEASE</a></div>
                                        <div class="postContent">The US Food and Drug Administration (FDA) has approved the use of artificial intelligence (AI) technology for the detection of diabetic retinopathy and macular oedema.</div>
                                        <div class="widget-latest-details">
                                            <!--                                            <a class="widget-latest-comment" href="#">
                                                                                            <i class="fa fa-comment-o"></i> 4 Comments </a>-->
                                            <span class="widget-latest-data news-source-home">Source : FashionBeans</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!--                        <li class="blog-item">
                                                    <div class="postWidget">
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <div class="postImage">
                                                                    <a href="<?= base_url('site/product_list') ?>"><img src="" alt="post-img" /></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12">
                                                                <span class="widget-latest-data">01 / 10 / 2015</span>
                                                                <div class="widget-latest-title"><a href="<?= base_url('site/product_list') ?>">COPENHAGEN SPECS: Scandinavia On Show</a></div>
                                                                <div class="postContent">The third edition of COPENHAGEN SPECS – the biggest independent eyewear show in Scandinavia – was held the 5th – 6th of March 2016 in the more than 100 year old train show “Lokomotivværkstedet” in the center of Copenhagen. The show was once again a great success and Founder and CEO, Morten Gammelmark, is very pleased with this year’s show, </div>
                                                                <div class="widget-latest-details">
                                                                    <a class="widget-latest-comment" href="#">
                                                                        <i class="fa fa-comment-o"></i> 3 Комментарии </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>-->
                        <!--                        <li class="blog-item">
                                                    <div class="postWidget">
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <div class="postImage">
                                                                    <a href="<?= base_url('site/product_list') ?>"><img src="" alt="post-img" /></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12">
                                                                <span class="widget-latest-data">01 / 10 / 2015</span>
                                                                <div class="widget-latest-title"><a href="<?= base_url('site/product_list') ?>">MYKITA: Sequences Of An Island</a></div>
                                                                <div class="postContent">Long-time collaborator and friend of the MYKITA HAUS, artist Mark Borthwick photographs the new MYKITA eyewear collection in its rightful element.
                                                                    Eyes squint skyward in the searing midday heat, feet move through cool, crystalline water, a deep breath reveals the taste of salt in the air – the 2016 campaign transports the senses to a Mediterranean island in high summer.</div>
                                                                <div class="widget-latest-details">
                                                                    <a class="widget-latest-comment" href="#">
                                                                        <i class="fa fa-comment-o"></i> 3 Комментарии </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>-->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="widget widget-static-block">
        <div class="banner-container-3">
            <div class="container">
                <div class="widget-title">Our Brands</div>
                <ul class="man-carousel">
                    <li class="man-item">
                        <a href="#"><img src="<?= base_url('public/images/brand/1.jpg') ?>" alt="manufacturer image"></a>
                    </li>
                    <li class="man-item">
                        <a href="#"><img src="<?= base_url('public/images/brand/2.jpg') ?>" alt="manufacturer image"></a>
                    </li>
                    <li class="man-item">
                        <a href="#"><img src="<?= base_url('public/images/brand/3.jpg') ?>" alt="manufacturer image"></a>
                    </li>
                    <li class="man-item">
                        <a href="#"><img src="<?= base_url('public/images/brand/4.jpg') ?>" alt="manufacturer image"></a>
                    </li>
                    <li class="man-item">
                        <a href="#"><img src="<?= base_url('public/images/brand/5.jpg') ?>" alt="manufacturer image"></a>
                    </li>
                    <li class="man-item">
                        <a href="#"><img src="<?= base_url('public/images/brand/6.jpg') ?>" alt="manufacturer image"></a>
                    </li>
                    <li class="man-item">
                        <a href="#"><img src="<?= base_url('public/images/brand/7.jpg') ?>" alt="manufacturer image"></a>
                    </li>
                    <li class="man-item">
                        <a href="#"><img src="<?= base_url('public/images/brand/8.jpg') ?>" alt="manufacturer image"></a>
                    </li>
                    <li class="man-item">
                        <a href="#"><img src="<?= base_url('public/images/brand/9.jpg') ?>" alt="manufacturer image"></a>
                    </li>
                    <li class="man-item">
                        <a href="#"><img src="<?= base_url('public/images/brand/10.jpg') ?>" alt="manufacturer image"></a>
                    </li>
                    <li class="man-item">
                        <a href="#"><img src="<?= base_url('public/images/brand/11.jpg') ?>" alt="manufacturer image"></a>
                    </li>
                    <li class="man-item">
                        <a href="#"><img src="<?= base_url('public/images/brand/12.jpg') ?>" alt="manufacturer image"></a>
                    </li>
                    <li class="man-item">
                        <a href="#"><img src="<?= base_url('public/images/brand/13.jpg') ?>" alt="manufacturer image"></a>
                    </li>
                    <li class="man-item">
                        <a href="#"><img src="<?= base_url('public/images/brand/14.jpg') ?>" alt="manufacturer image"></a>
                    </li>
                    <li class="man-item">
                        <a href="#"><img src="<?= base_url('public/images/brand/15.jpg') ?>" alt="manufacturer image"></a>
                    </li>
                    <li class="man-item">
                        <a href="#"><img src="<?= base_url('public/images/brand/16.jpg') ?>" alt="manufacturer image"></a>
                    </li>
                    <li class="man-item">
                        <a href="#"><img src="<?= base_url('public/images/brand/17.jpg') ?>" alt="manufacturer image"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>




<!--[if lt IE 7]>
<script type="text/javascript">
//<![CDATA[
var BLANK_URL = 'js/blank.html';
var BLANK_IMG = 'js/spacer.gif';
//]]>
</script>
<![endif]-->

<script type="text/javascript">
    //<![CDATA[
    Mage.Cookies.path = '../magento_61193';
    Mage.Cookies.domain = '.ld-magento.template-help.com';
    //]]>
</script>

<script type="text/javascript">
    //<![CDATA[
    optionalZipCountries = ["HK", "IE", "MO", "PA"];
    //]]>
</script>
<script type="text/javascript">
    //<![CDATA[
    var Translator = new Translate({
        "Please select an option.": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0432\u044b\u0431\u0435\u0440\u0438\u0442\u0435 \u043e\u0434\u0438\u043d \u0432\u0430\u0440\u0438\u0430\u043d\u0442.",
        "This is a required field.": "\u042d\u0442\u043e \u043f\u043e\u043b\u0435 \u043e\u0431\u044f\u0437\u0430\u0442\u0435\u043b\u044c\u043d\u043e \u0434\u043b\u044f \u0437\u0430\u043f\u043e\u043b\u043d\u0435\u043d\u0438\u044f.",
        "Please enter a valid number in this field.": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0432\u0432\u0435\u0434\u0438\u0442\u0435 \u0432 \u044d\u0442\u043e \u043f\u043e\u043b\u0435 \u0434\u0435\u0439\u0441\u0442\u0432\u0438\u0442\u0435\u043b\u044c\u043d\u043e\u0435 \u0447\u0438\u0441\u043b\u043e.",
        "Please use letters only (a-z or A-Z) in this field.": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0438\u0441\u043f\u043e\u043b\u044c\u0437\u0443\u0439\u0442\u0435 \u0432 \u044d\u0442\u043e\u043c \u043f\u043e\u043b\u0435 \u0442\u043e\u043b\u044c\u043a\u043e \u0431\u0443\u043a\u0432\u044b (a-z \u0438\u043b\u0438 A-Z).",
        "Please use only letters (a-z), numbers (0-9) or underscore(_) in this field, first character should be a letter.": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0438\u0441\u043f\u043e\u043b\u044c\u0437\u0443\u0439\u0442\u0435 \u0432 \u044d\u0442\u043e\u043c \u043f\u043e\u043b\u0435 \u0442\u043e\u043b\u044c\u043a\u043e \u0431\u0443\u043a\u0432\u044b (a-z), \u0446\u0438\u0444\u0440\u044b (0-9) \u0438\u043b\u0438 \u043f\u043e\u0434\u0447\u0451\u0440\u043a\u0438\u0432\u0430\u043d\u0438\u044f(_). \u041f\u0435\u0440\u0432\u044b\u0439 \u0441\u0438\u043c\u0432\u043e\u043b \u0434\u043e\u043b\u0436\u0435\u043d \u0431\u044b\u0442\u044c \u0431\u0443\u043a\u0432\u043e\u0439.",
        "Please enter a valid phone number. For example (123) 456-7890 or 123-456-7890.": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0432\u0432\u0435\u0434\u0438\u0442\u0435 \u043f\u0440\u0430\u0432\u0438\u043b\u044c\u043d\u044b\u0439 \u043d\u043e\u043c\u0435\u0440 \u0442\u0435\u043b\u0435\u0444\u043e\u043d\u0430. \u041d\u0430\u043f\u0440\u0438\u043c\u0435\u0440 (123) 456-7890 \u0438\u043b\u0438 123-456-7890.",
        "Please enter a valid date.": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0432\u0432\u0435\u0434\u0438\u0442\u0435 \u0434\u0435\u0439\u0441\u0442\u0432\u0438\u0442\u0435\u043b\u044c\u043d\u0443\u044e \u0434\u0430\u0442\u0443.",
        "Please enter a valid email address. For example johndoe@domain.com.": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0432\u0432\u0435\u0434\u0438\u0442\u0435 \u0434\u0435\u0439\u0441\u0442\u0432\u0438\u0442\u0435\u043b\u044c\u043d\u044b\u0439 \u0430\u0434\u0440\u0435\u0441 \u044d\u043b\u0435\u043a\u0442\u0440\u043e\u043d\u043d\u043e\u0439 \u043f\u043e\u0447\u0442\u044b. \u041d\u0430\u043f\u0440\u0438\u043c\u0435\u0440 johndoe@domain.com.",
        "Please enter 6 or more characters. Leading or trailing spaces will be ignored.": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0432\u0432\u0435\u0434\u0438\u0442\u0435 6 \u0438\u043b\u0438 \u0431\u043e\u043b\u0435\u0435 \u0441\u0438\u043c\u0432\u043e\u043b\u043e\u0432. \u041f\u0440\u043e\u0431\u0435\u043b\u044b \u043f\u0435\u0440\u0435\u0434 \u0438 \u043f\u043e\u0441\u043b\u0435 \u0441\u0438\u043c\u0432\u043e\u043b\u043e\u0432 \u0431\u0443\u0434\u0443\u0442 \u043f\u0440\u043e\u0438\u0433\u043d\u043e\u0440\u0438\u0440\u043e\u0432\u0430\u043d\u044b.",
        "Please make sure your passwords match.": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430 \u0443\u0431\u0435\u0434\u0438\u0442\u0435\u0441\u044c, \u0447\u0442\u043e \u0432\u0430\u0448\u0438 \u043f\u0430\u0440\u043e\u043b\u0438 \u0441\u043e\u0432\u043f\u0430\u0434\u0430\u044e\u0442.",
        "Please enter a valid URL. For example ../../www.example.comorwww.example.com/default.htm": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0432\u0432\u0435\u0434\u0438\u0442\u0435 \u043f\u0440\u0430\u0432\u0438\u043b\u044c\u043d\u044b\u0439 URL. \u041d\u0430\u043f\u0440\u0438\u043c\u0435\u0440, ../../www.example.com/u0438/u043b/u0438 www.example.com",
        "Please enter a valid social security number. For example 123-45-6789.": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0432\u0432\u0435\u0434\u0438\u0442\u0435 \u043f\u0440\u0430\u0432\u0438\u043b\u044c\u043d\u044b\u0439 \u043d\u043e\u043c\u0435\u0440 \u0441\u043e\u0446\u0438\u0430\u043b\u044c\u043d\u043e\u0433\u043e \u0441\u0442\u0440\u0430\u0445\u043e\u0432\u0430\u043d\u0438\u044f. \u041d\u0430\u043f\u0440\u0438\u043c\u0435\u0440 123-45-6789.",
        "Please enter a valid zip code. For example 90602 or 90602-1234.": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0432\u0432\u0435\u0434\u0438\u0442\u0435 \u043f\u0440\u0430\u0432\u0438\u043b\u044c\u043d\u044b\u0439 \u043f\u043e\u0447\u0442\u043e\u0432\u044b\u0439 \u0438\u043d\u0434\u0435\u043a\u0441. \u041d\u0430\u043f\u0440\u0438\u043c\u0435\u0440, 9060 \u0438\u043b\u0438 90602-1234.",
        "Please enter a valid zip code.": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0432\u0432\u0435\u0434\u0438\u0442\u0435 \u043f\u0440\u0430\u0432\u0438\u043b\u044c\u043d\u044b\u0439 \u043f\u043e\u0447\u0442\u043e\u0432\u044b\u0439 \u0438\u043d\u0434\u0435\u043a\u0441.",
        "Please use this date format: dd\/mm\/yyyy. For example 17\/03\/2006 for the 17th of March, 2006.": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0438\u0441\u043f\u043e\u043b\u044c\u0437\u0443\u0439\u0442\u0435 \u0434\u043b\u044f \u0434\u0430\u0442\u044b \u0444\u043e\u0440\u043c\u0430\u0442: dd\/mm\/yyyy. \u041d\u0430\u043f\u0440\u0438\u043c\u0435\u0440, 17\/03\/2006 \u0434\u043b\u044f 17-\u0433\u043e \u043c\u0430\u0440\u0442\u0430 2006 \u0433\u043e\u0434\u0430.",
        "Please enter a valid $ amount. For example $100.00.": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0432\u0432\u0435\u0434\u0438\u0442\u0435 \u0441\u0443\u043c\u043c\u0443. \u041d\u0430\u043f\u0440\u0438\u043c\u0435\u0440, $100.00.",
        "Please select one of the above options.": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0432\u044b\u0431\u0435\u0440\u0438\u0442\u0435 \u043e\u0434\u0438\u043d \u0438\u0437 \u0432\u044b\u0448\u0435\u0443\u043a\u0430\u0437\u0430\u043d\u043d\u044b\u0445 \u0432\u0430\u0440\u0438\u0430\u043d\u0442\u043e\u0432.",
        "Please select one of the options.": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0432\u044b\u0431\u0435\u0440\u0438\u0442\u0435 \u043e\u0434\u0438\u043d \u0438\u0437 \u0432\u0430\u0440\u0438\u0430\u043d\u0442\u043e\u0432.",
        "Please select State\/Province.": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0432\u044b\u0431\u0435\u0440\u0438\u0442\u0435 \u0448\u0442\u0430\u0442\/\u043f\u0440\u043e\u0432\u0438\u043d\u0446\u0438\u044e.",
        "Please enter a number greater than 0 in this field.": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0432\u0432\u0435\u0434\u0438\u0442\u0435 \u0432 \u044d\u0442\u043e \u043f\u043e\u043b\u0435 \u0447\u0438\u0441\u043b\u043e \u0431\u043e\u043b\u044c\u0448\u0435 0.",
        "Please enter a valid credit card number.": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0432\u0432\u0435\u0434\u0438\u0442\u0435 \u0434\u0435\u0439\u0441\u0442\u0432\u0438\u0442\u0435\u043b\u044c\u043d\u044b\u0439 \u043d\u043e\u043c\u0435\u0440 \u043a\u0440\u0435\u0434\u0438\u0442\u043d\u043e\u0439 \u043a\u0430\u0440\u0442\u044b.",
        "Please wait, loading...": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u043f\u043e\u0434\u043e\u0436\u0434\u0438\u0442\u0435, \u0438\u0434\u0435\u0442 \u0437\u0430\u0433\u0440\u0443\u0437\u043a\u0430...",
        "Complete": "\u0417\u0430\u0432\u0435\u0440\u0448\u0451\u043d",
        "Add Products": "\u0414\u043e\u0431\u0430\u0432\u0438\u0442\u044c \u0442\u043e\u0432\u0430\u0440\u044b",
        "Please choose to register or to checkout as a guest": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0441\u0434\u0435\u043b\u0430\u0439\u0442\u0435 \u0432\u044b\u0431\u043e\u0440: \u0437\u0430\u0440\u0435\u0433\u0438\u0441\u0442\u0440\u0438\u0440\u043e\u0432\u0430\u0442\u044c\u0441\u044f \u0438\u043b\u0438 \u043e\u0444\u043e\u0440\u043c\u0438\u0442\u044c \u0437\u0430\u043a\u0430\u0437 \u0431\u0435\u0437 \u0440\u0435\u0433\u0438\u0441\u0442\u0440\u0430\u0446\u0438\u0438 \u043d\u0430 \u0441\u0430\u0439\u0442\u0435",
        "Please specify shipping method.": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0443\u043a\u0430\u0436\u0438\u0442\u0435 \u043c\u0435\u0442\u043e\u0434 \u0434\u043e\u0441\u0442\u0430\u0432\u043a\u0438.",
        "Please specify payment method.": "\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0443\u043a\u0430\u0436\u0438\u0442\u0435 \u043c\u0435\u0442\u043e\u0434 \u043e\u043f\u043b\u0430\u0442\u044b.",
        "Add to Cart": "\u0414\u043e\u0431\u0430\u0432\u0438\u0442\u044c \u0432 \u043a\u043e\u0440\u0437\u0438\u043d\u0443",
        "In Stock": "\u0415\u0441\u0442\u044c \u0432 \u043d\u0430\u043b\u0438\u0447\u0438\u0438",
        "Out of Stock": "\u041d\u0435\u0442 \u0432 \u043d\u0430\u043b\u0438\u0447\u0438\u0438"
    });
    //]]>
</script>
<script type="text/javascript">
    truncateOptions();
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
    truncateOptions();
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
<script src="<?= base_url('public/js/site/') ?>/camera.js">
</script>
<script>
    jQuery(function () {
        jQuery('#camera_wrap').camera({
            alignmen: 'topCenter',
            height: '495px',
            minHeight: '205px',
            loader: false,
            navigation: true,
            fx: 'simpleFade',
            navigationHover: false,
            thumbnails: false,
            playPause: false,
            pagination: false,
        });
    });
</script>

<script type="text/javascript">
    $j(window).load(function () {
        var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent);
        if (!isMobile) {
            if ($j("#parallax-block").length) {
                $j("#parallax-block").cherryFixedParallax({
                    invert: false
                });
            }
            ;
        }
        ;
    });
</script>

<script>
    $j(".blog-carousel").owlCarousel({
        items: 2,
        itemsDesktop: [bp.xlarge, 2],
        itemsDesktopSmall: [bp.large, 2],
        itemsTablet: [bp.medium, 1],
        itemsTabletSmall: [bp.medium, 1],
        itemsMobile: [bp.xsmall, 1],
        pagination: false,
        navigation: true,
    });
</script>

<script>
    $j(".man-carousel").owlCarousel({
        items: 10,
        itemsDesktop: [1199, 8],
        itemsDesktopSmall: [980, 6],
        itemsTablet: [767, 4],
        itemsTabletSmall: [560, 3],
        itemsMobile: [480, 2],
        pagination: false,
        navigation: true,
    });
</script>
<script type="text/javascript">
    //<![CDATA[
//        var newsletterSubscriberFormDetail = new VarienForm('newsletter-validate-detail');
//        document.getElementById("newsletter").setAttribute('autocapitalize', 'off');
//        document.getElementById("newsletter").setAttribute('autocorrect', 'off');
    //]]>
</script>

<script>
//        (function(d, s, id) {
//            var js, fjs = d.getElementsByTagName(s)[0];
//            if (d.getElementById(id)) return;
//            js = d.createElement(s);
//            js.id = id;
//            js.src = "//https@connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=734741803247761";
//            fjs.parentNode.insertBefore(js, fjs);
//        }(document, 'script', 'facebook-jssdk'));

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
</script>

<script type="text/javascript">
    //<![CDATA[
    var newsletterSubscriberFormDetail = new VarienForm('newsletter-validate-detail2');
    //]]>
</script>

<script>
    jQuery(document).ready(function () {

        var newsPopup = jQuery('#newsletterpopup');
        var newsPopupClose = newsPopup.find('.close');
        var showNewsPopup = sessionStorage.getItem("showNewsPopup");
        if (showNewsPopup != '0') {
            newsPopup.modal();
            disable_scroll();
        }
        ;

        newsPopupClose.click(function () {
            sessionStorage.setItem("showNewsPopup", '0');
            enable_scroll();
        });
        jQuery('body').click(function () {
            enable_scroll();
        });

    });

    function disable_scroll() {
        jQuery('body').bind('touchmove', function (e) {
            e.preventDefault()
        });
    }

    function enable_scroll() {
        jQuery('body').unbind('touchmove');
    }
</script>

</body>

</html>
