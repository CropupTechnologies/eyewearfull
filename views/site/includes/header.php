<div class="wrapper">
    <noscript>
    <div class="global-site-notice noscript">
        <div class="notice-inner">
            <p>
                <strong>JavaScript seems to be disabled in your browser.</strong>
                <br /> You must have JavaScript enabled in your browser to utilize the functionality of this website. </p>
        </div>
    </div>
    </noscript>
    <div class="page">

        <!-- Ajax Login -->
        <div class="skip-links2"> <span class="skip-link2 skip-account2"></span></div>
        <div id="header-account2" class="skip-content2"></div>
        <!-- End Ajax Login -->



        <header id="header" class="page-header">

            <div class="header-row-background">     
                <div class="container">
                    <div class="header-row clearfix">

                        <div class="header-switchers">

                            <div class="header-button currency-list full_mode">
                                <div class="header-button-title">
                                    <span class="label">LK Rupees</span>
                                </div>

                                <ul>
                                    <li>
                                        <a href="#" title="EUR"><span>€ euro</span><span class="mobile-part">EUR</span></a>
                                    </li>
                                    <li>
                                        <a class="selected" href="#" title="USD"><span>$ dólar estadounidense</span><span class="mobile-part">USD</span></a>
                                    </li>
                                </ul>
                            </div>

                            <div class="header-button lang-list full_mode">
                                <div class="header-button-title">
                                    <span class="label">Your Language:</span>
                                    <span class="current">English</span>
                                </div>
                                <ul>
                                    <li>
                                        <a href="#" title="en_US"><span>English</span><span class="mobile-part">en</span></a>
                                    </li>
                                    <li>
                                        <a href="#" title="de_DE"><span>Sinhala</span><span class="mobile-part">de</span></a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <!-- Top Links -->
                        <!--                        <div class="top-links">
                                                    <a title="Log In" href="#" class="log-in-link">
                                                         Log In<i class="fa fa-angle-right"></i> 
                                                        <form>
                                                            <input type="text" name="" placeholder="Track My Order" class="top_search">
                                                        </form>
                                                    </a>
                                                </div>-->
                        <!-- end Top Links -->
                        <?php
//                        $CI =& get_instance();
//                        $CI->load->model('Search_model');
//                        $CI->load->model('Itemmodel');
                        ?>
                        <?= $this->load->view('site/includes/mini_cart', ['cart_items' => $this->Search_model->get_shopping_cart_data()], TRUE) ?>
                        <div class="top-account">
                            <?php
                            if (isset($_SESSION['customer'])) {
                                ?>
                                <a href="#" data-target-element="#">
                                    <span>My Account</span>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                        <!-- <p class="welcome-msg">¡Bienvenidos a nuestra tienda en línea! </p> -->
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="page-header-container">
                    <!-- logo -->
                    <a class="logo" href="<?= base_url() ?>">
                        <img src="<?= base_url('public/images/logo_gg.png') ?>" alt="Magento Commerce" />
                    </a>
                    <!-- end logo -->

                    <!-- Search -->
                    <!--                    <div class="header-search desktop">
                    
                                            <form id="search_mini_form" action="http://ld-magento.template-help.com/magento_61193/catalogsearch/result/" method="get">
                                                <div class="input-box">
                                                    <label for="search">Search:</label>
                                                    <input id="search" type="search" autocomplete="off" class="input-text required-entry" name="q" value="" maxlength="128" placeholder="Search entire store here..." />
                                                    <button type="submit" title="Search" class="button search-button">
                                                        <span>
                                                            <span>
                                                                Search                </span>
                                                        </span>
                                                    </button>
                                                </div>
                    
                                                <div id="search_autocomplete" class="search-autocomplete">
                                                </div>
                                            </form>
                                        </div>-->
                    <!-- end Search -->

                </div>
            </div>

            <div class="main-menu" style="z-index: 900;">
                <div class="container">
                    <div id="header-nav" class="skip-content nav-content">
                        <div class="nav-container-mobile">
                            <div class="sf-menu-block">
                                <ul class="sf-menu-phone">
                                    <li class="level0 nav-1 first parent"><a href="<?= base_url('search?product=4') ?>" class="level0 has-children">Spectacles</a>
                                        <ul class="level0">
                                            <li class="level1 nav-1-1 first parent"><a href="#" class="level1 has-children">Shop by Gender:</a>
                                                <ul class="level1">
                                                    <li class="level2 nav-1-1-1 first"><a href="#" class="level2 "> Women</a></li>
                                                    <li class="level2 nav-1-1-2"><a href="#" class="level2 "> Men</a></li>
                                                    <li class="level2 nav-1-1-3"><a href="#" class="level2 "> Kids</a></li>
                                                    <li class="level2 nav-1-1-4 last"><a href="#" class="level2 ">Unisex</a></li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-1-2 parent"><a href="#" class="level1 has-children">Shop by Shape:</a>
                                                <ul class="level1">
                                                    <li class="level2 nav-1-2-1 first"><a href="#" class="level2 "> Rectangle</a></li>
                                                    <li class="level2 nav-1-2-2"><a href="#" class="level2 "> Round</a></li>
                                                    <li class="level2 nav-1-2-3"><a href="#" class="level2 "> Oval</a></li>
                                                    <li class="level2 nav-1-2-4"><a href="#" class="level2 "> Cat Eye</a></li>
                                                    <li class="level2 nav-1-2-5"><a href="#" class="level2 "> Aviator</a></li>
                                                    <li class="level2 nav-1-2-6 last"><a href="#" class="level2 "> Unique</a></li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-1-3 parent"><a href="#" class="level1 has-children">Shop by Size:</a>
                                                <ul class="level1">
                                                    <li class="level2 nav-1-3-1 first"><a href="#" class="level2 "> S </a></li>
                                                    <li class="level2 nav-1-3-2"><a href="#" class="level2 "> M </a></li>
                                                    <li class="level2 nav-1-3-3 last"><a href="#" class="level2 "> L</a></li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-1-4 parent"><a href="#" class="level1 has-children">Shop by Frame Material:</a>
                                                <ul class="level1">
                                                    <li class="level2 nav-1-4-1 first"><a href="#" class="level2 "> Plastic</a></li>
                                                    <li class="level2 nav-1-4-2"><a href="#" class="level2 "> Metal</a></li>
                                                    <li class="level2 nav-1-4-3"><a href="#" class="level2 "> Rimless</a></li>
                                                    <li class="level2 nav-1-4-4"><a href="#" class="level2 "> Semi-Rimless</a></li>
                                                    <li class="level2 nav-1-4-5"><a href="#" class="level2 "> Bendable Titanium</a></li>
                                                    <li class="level2 nav-1-4-6 last"><a href="#" class="level2 "> Re-Lens Your Own Frame</a></li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-1-5 last parent"><a href="#" class="level1 has-children">Shop by Lens Type:</a>
                                                <ul class="level1">
                                                    <li class="level2 nav-1-5-1 first"><a href="#" class="level2 "> Full Time Wear</a></li>
                                                    <li class="level2 nav-1-5-2"><a href="#" class="level2 "> Reading Glasses</a></li>
                                                    <li class="level2 nav-1-5-3"><a href="#" class="level2 "> Regular Bifocals</a></li>
                                                    <li class="level2 nav-1-5-4"><a href="#" class="level2 "> Progressive </a></li>
                                                    <li class="level2 nav-1-5-5 last"><a href="#" class="level2 "> Prescription Sunglasses</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="level0 nav-2"><a href="<?= base_url('search?product=3') ?>" class="level0 ">Accessories</a></li>
                                    <li class="level0 nav-3 active"><a href="<?= base_url('search?product=2') ?>" class="level0 ">Contact Lenses</a></li>
                                    <li class="level0 nav-4 last"><a href="<?= base_url('search?product=1') ?>" class="level0 ">Sun Wear</a></li>
                                </ul>
                                <div class="clear"></div>
                            </div>
                        </div>

                        <div class="nav-container">
                            <div class="nav">

                                <ul id="nav" class="grid-full">

                                    <li class="level nav-1 first parent  no-level-thumbnail ">
                                        <a style="background-color:" href="<?= base_url('search?product=4') ?>">
                                            <div class="thumbnail"></div>
                                            <span style="color:;">Spectacles</span><span class="spanchildren"></span>
                                        </a>
                                        <div class="level-top">
                                            <div class="level  column5" style="width:930px;">

                                                <ul class=" level">
                                                    <li>

                                                        <ul class="catagory_children">
                                                            <li class="li-wrapper">
                                                                <div class="level1 nav-1-1 first parent item  no-level-thumbnail " style="width:20%;">
                                                                    <a style=" default.htm" class="catagory-level1" href="../women-s/casual.html">
                                                                        <div class="thumbnail"></div>
                                                                        <span style="color:;">Shop by Gender:</span><span class="spanchildren"></span>
                                                                    </a>

                                                                    <div class="level-top">
                                                                        <div class="level1  column1">

                                                                            <ul class="d level1">
                                                                                <li class="catagory_children  column1">
                                                                                    <div class="level2 nav-1-1-1 first  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/casual/women.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> Women</span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="level2 nav-1-1-2  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/casual/men.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> Men</span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="level2 nav-1-1-3  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/casual/kids.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> Kids</span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="level2 nav-1-1-4 last  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/casual/re-lens-your-own-frame.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  ">Unisex</span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>

                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="level1 nav-1-2 parent item  no-level-thumbnail " style="width:20%;">
                                                                    <a style=" default.htm" class="catagory-level1" href="../women-s/sport.html">
                                                                        <div class="thumbnail"></div>
                                                                        <span style="color:;">Shop by Shape:</span><span class="spanchildren"></span>
                                                                    </a>

                                                                    <div class="level-top">
                                                                        <div class="level1  column1">

                                                                            <ul class="d level1">
                                                                                <li class="catagory_children  column1">
                                                                                    <div class="level2 nav-1-2-5 first  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/sport/rectangle.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> Rectangle</span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="level2 nav-1-2-6  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/sport/round.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> Round</span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="level2 nav-1-2-7  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/sport/oval.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> Oval</span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="level2 nav-1-2-8  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/sport/cat-eye.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> Cat Eye</span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="level2 nav-1-2-9  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/sport/aviator.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> Aviator</span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="level2 nav-1-2-10 last  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/sport/unique.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> Unique</span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>

                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="level1 nav-1-3 parent item  no-level-thumbnail " style="width:20%;">
                                                                    <a style=" default.htm" class="catagory-level1" href="../women-s/fashion.html">
                                                                        <div class="thumbnail"></div>
                                                                        <span style="color:;">Shop by Size:</span><span class="spanchildren"></span>
                                                                    </a>

                                                                    <div class="level-top">
                                                                        <div class="level1  column1">

                                                                            <ul class="d level1">
                                                                                <li class="catagory_children  column1">
                                                                                    <div class="level2 nav-1-3-11 first  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/fashion/s.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> S </span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="level2 nav-1-3-12  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/fashion/m.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> M </span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="level2 nav-1-3-13 last  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/fashion/l.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> L</span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>

                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="level1 nav-1-4 parent item  no-level-thumbnail " style="width:20%;">
                                                                    <a style=" default.htm" class="catagory-level1" href="../women-s/shop-by-frame-material.html">
                                                                        <div class="thumbnail"></div>
                                                                        <span style="color:;">Shop by Frame Material:</span><span class="spanchildren"></span>
                                                                    </a>

                                                                    <div class="level-top">
                                                                        <div class="level1  column1">

                                                                            <ul class="d level1">
                                                                                <li class="catagory_children  column1">
                                                                                    <div class="level2 nav-1-4-14 first  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/shop-by-frame-material/plastic.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> Plastic</span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="level2 nav-1-4-15  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/shop-by-frame-material/metal.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> Metal</span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="level2 nav-1-4-16  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/shop-by-frame-material/rimless.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> Rimless</span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="level2 nav-1-4-17  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/shop-by-frame-material/semi-rimless.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> Semi-Rimless</span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="level2 nav-1-4-18  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/shop-by-frame-material/bendable-titanium.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> Bendable Titanium</span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="level2 nav-1-4-19 last  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/shop-by-frame-material/re-lens-your-own-frame.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> Re-Lens Your Own Frame</span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>

                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="level1 nav-1-5 last parent item  no-level-thumbnail " style="width:20%;">
                                                                    <a style=" default.htm" class="catagory-level1" href="../women-s/shop-by-lens-type.html">
                                                                        <div class="thumbnail"></div>
                                                                        <span style="color:;">Shop by Lens Type:</span><span class="spanchildren"></span>
                                                                    </a>

                                                                    <div class="level-top">
                                                                        <div class="level1  column1">

                                                                            <ul class="d level1">
                                                                                <li class="catagory_children  column1">
                                                                                    <div class="level2 nav-1-5-20 first  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/shop-by-lens-type/full-time-wear.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> Full Time Wear</span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="level2 nav-1-5-21  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/shop-by-lens-type/reading-glasses.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> Reading Glasses</span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="level2 nav-1-5-22  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/shop-by-lens-type/regular-bifocals.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> Regular Bifocals</span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="level2 nav-1-5-23  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/shop-by-lens-type/progressive-no-line-bifocals.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> Progressive </span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="level2 nav-1-5-24 last  no-level-thumbnail ">
                                                                                        <a style="background-color:" href="../women-s/shop-by-lens-type/prescription-sunglasses.html">
                                                                                            <div class="thumbnail"></div>
                                                                                            <span style="color:;  "> Prescription Sunglasses</span>
                                                                                        </a>
                                                                                        <div class="level-top">
                                                                                            <div class="level2  column1">

                                                                                                <ul class="d level2">

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>

                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <ul class="static-block">
                                                <div class="menu-banner">
                                                    <div class="banner-wrapper clearfix">
                                                        <a href="#" class="banner-link f-left"><img src="holder.js/540x150?random=yes" alt="menu_banner_img"></a>
                                                        <a href="default.htm" class="banner-link f-right"><img src="holder.js/540x150?random=yes" alt="menu_banner_img"></a>
                                                    </div>
                                                </div>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="level nav-2  no-level-thumbnail ">
                                        <a style="background-color:" href="<?= base_url('search?product=3') ?>">
                                            <div class="thumbnail"></div>
                                            <span style="color:;  ">Accessories</span>
                                        </a>
                                        <div class="level-top">
                                            <div class="level  column1" style="width:930px;">

                                                <ul class=" level">
                                                    <li>

                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="level nav-3 active  no-level-thumbnail ">
                                        <a style="background-color:" href="<?= base_url('search?product=2') ?>">
                                            <div class="thumbnail"></div>
                                            <span style="color:;  ">Contact Lenses</span>
                                        </a>
                                        <div class="level-top">
                                            <div class="level  column1" style="width:930px;">

                                                <ul class=" level">
                                                    <li>

                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="level nav-4 last  no-level-thumbnail ">
                                        <a style="background-color:" href="<?= base_url('search?product=1') ?>">
                                            <div class="thumbnail"></div>
                                            <span style="color:;  ">Sun Wear</span>
                                        </a>
                                        <div class="level-top">
                                            <div class="level  column1" style="width:930px;">

                                                <ul class=" level">
                                                    <li>

                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li></li>
                                </ul>
                            </div>
                            <!-- end: nav -->
                        </div>
                        <!-- end: nav-container -->
                    </div>
                </div>
            </div>

            <!-- *************  Skip Container for Mobile ************* -->
            <div class="skip-container mobile">
                <div class="container">
                    <div class="skip-links">

                        <!-- Menu Label -->
                        <a href="#header-nav" class="skip-link skip-nav">
                            <span class="icon"></span>
                            <span class="label">Menu</span>
                        </a>

                        <!-- Search Label -->
                        <a href="#header-search" class="skip-link skip-search">
                            <span class="icon"></span>
                            <span class="label">Search</span>
                        </a>
                        <!-- Search content -->
                        <div id="header-search" class="skip-content">
                            <form id="search_mini_form" action="http://ld-magento.template-help.com/magento_61193/catalogsearch/result/" method="get">
                                <div class="input-box">
                                    <label for="search">Search:</label>
                                    <input id="search" type="search" autocomplete="off" class="input-text required-entry" name="q" value="" maxlength="128" placeholder="Search entire store here..." />
                                    <button type="submit" title="Search" class="button search-button">
                                        <span>
                                            <span>
                                                Search                </span>
                                        </span>
                                    </button>
                                </div>

                                <div id="search_autocomplete" class="search-autocomplete">
                                </div>
                            </form>
                        </div>

                        <!-- Account Label -->
                        <a href="#" data-target-element="#header-account" class="skip-link skip-account">
                            <span class="icon"></span>
                            <span class="label">Account</span>
                        </a>
                        <!-- Account content -->
                        <div id="header-account" class="skip-content">

                            <div class="header-button lang-list full_mode">

                                <div class="header-button-title"><span class="label">Your Language:</span> <span class="current">Spanish</span></div>
                                <ul>
                                    <li>
                                        <a href="#" title="en_US"><span>English</span><span class="mobile-part">en</span></a>
                                    </li>
                                    <li>
                                        <a href="#" title="de_DE"><span>German</span><span class="mobile-part">de</span></a>
                                    </li>
                                    <li>
                                        <a class="selected" href="#" title="es_PA"><span>Spanish</span><span class="mobile-part">es</span></a>
                                    </li>
                                    <li>
                                        <a href="#" title="ru_RU"><span>Russian</span><span class="mobile-part">ru</span></a>
                                    </li>
                                </ul>
                            </div>

                            <div class="header-button currency-list full_mode">
                                <div class="header-button-title">
                                    <span class="label">Currency:</span><span class="current">USD</span>
                                </div>

                                <ul>
                                    <li>
                                        <a href="#" title="EUR"><span>€ euro</span><span class="mobile-part">EUR</span></a>
                                    </li>
                                    <li>
                                        <a class="selected" href="#" title="USD"><span>$ dólar estadounidense</span><span class="mobile-part">USD</span></a>
                                    </li>
                                </ul>
                            </div>

                            <div class="links">
                                <ul>
                                    <li class="first"><a href="#" title="My Account" class="my-account-link">My Account</a></li>
                                    <li><a href="#" title="My Wishlist" class="wishlist-link">My Wishlist</a></li>
                                    <li><a href="#" title="My Cart (80 items)" class="top-link-cart">My Cart (80 items)</a></li>
                                    <li><a href="#" title="Blog" class="top-link-blog">Blog</a></li>
                                    <li><a href="#" title="Checkout" class="top-link-checkout">Checkout</a></li>
                                    <li><a href="#" title="Register" class="register-link">Register</a></li>
                                    <li class=" last"><a href="#" title="Log In" class="log-in-link">Log In</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Cart -->
                        <div class="header-minicart mobile">

                            <a href="#" data-target-element="#header-cart-mobile" class="skip-link skip-cart ">
                                <span class="icon"></span>
                                <span class="label">Cart</span>
                                <span class="count">01</span>
                            </a>

                            <div id="header-cart-mobile" class="block block-cart skip-content">

                                <div id="minicart-error-message" class="minicart-message"></div>
                                <div id="minicart-success-message" class="minicart-message"></div>

                                <div class="minicart-wrapper">

                                    <p class="block-subtitle">
                                        Recently added item(s)
                                        <a class="close skip-link-close material-design-cancel19" href="#" title="Close"></a>
                                    </p>

                                    <div>
                                        <ul id="cart-sidebar" class="mini-products-list">
                                            <li class="item" xmlns="http://www.w3.org/1999/html">
                                                <a href="#" title="Alex Perry  " class="product-image"><img src="images/product_list/alex_perry_ap_30_1.jpg" alt="Alex Perry  " /></a>
                                                <div class="product-details">
                                                    <p class="product-name"><a href="#">Alex Perry  </a></p>

                                                    <div class="product-wrapper">

                                                        <table class="info-wrapper">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Price</th>
                                                                    <td>

                                                                        <span class="price">$45.00</span>

                                                                    </td>
                                                                </tr>
                                                                <tr class="qty-wrapper">
                                                                    <th>Qty</th>
                                                                    <td>
                                                                        <input data-link="http://ld-magento.template-help.com/magento_61193/checkout/cart/ajaxUpdate/id/741/uenc/aHR0cDovL2xkLW1hZ2VudG8udGVtcGxhdGUtaGVscC5jb20vbWFnZW50b182MTE5My95b3V0aC5odG1sLw,,/" data-item-id="741" class="qty cart-item-quantity input-text" name="" value="1" />

                                                                        <button  data-item-id="741" disabled="disabled" data-update class="button quantity-button">
                                                                            <span><span>ok</span></span>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>

                                                    <div class="action-icons">
                                                        <a href="#" title="Edit item" class="btn-edit">
                                                            Edit item            </a>
                                                        <a href="#" title="Remove This Item" data-confirm="Are you sure you would like to remove this item from the shopping cart?" class="remove">
                                                            Remove Item                    </a>
                                                    </div>

                                                </div>
                                            </li>
                                            <li class="item" xmlns="http://www.w3.org/1999/html">
                                                <a href="#" title="Specsavers CHRIS" class="product-image"><img src="images/catalog/product/cache/3/thumbnail/100x100/9df78eab33525d08d6e5fb8d27136e95/s/p/specsavers_chris_1.jpg" alt="Specsavers CHRIS" /></a>
                                                <div class="product-details">
                                                    <p class="product-name"><a href="#">Specsavers CHRIS</a></p>

                                                    <div class="product-wrapper">

                                                        <table class="info-wrapper">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Price</th>
                                                                    <td>

                                                                        <span class="price">$77.00</span>

                                                                    </td>
                                                                </tr>
                                                                <tr class="qty-wrapper">
                                                                    <th>Qty</th>
                                                                    <td>
                                                                        <input id="qinput-740" data-link="http://ld-magento.template-help.com/magento_61193/checkout/cart/ajaxUpdate/id/740/uenc/aHR0cDovL2xkLW1hZ2VudG8udGVtcGxhdGUtaGVscC5jb20vbWFnZW50b182MTE5My95b3V0aC5odG1sLw,,/" data-item-id="740" class="qty cart-item-quantity input-text" name="" value="1" />

                                                                        <button id="qbutton-740" data-item-id="740" disabled="disabled" data-update class="button quantity-button">
                                                                            <span><span>ok</span></span>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>

                                                    <div class="action-icons">
                                                        <a href="#" title="Edit item" class="btn-edit">
                                                            Edit item            </a>
                                                        <a href="#" title="Remove This Item" data-confirm="Are you sure you would like to remove this item from the shopping cart?" class="remove">
                                                            Remove Item                    </a>
                                                    </div>

                                                </div>
                                            </li>
                                            <li class="item" xmlns="http://www.w3.org/1999/html">
                                                <a href="#" title="CONVERSE SUN RX " class="product-image"><img src="images/catalog/product/cache/3/thumbnail/100x100/9df78eab33525d08d6e5fb8d27136e95/c/o/converse_sun_rx_04_1.jpg" alt="CONVERSE SUN RX " /></a>
                                                <div class="product-details">
                                                    <p class="product-name"><a href="#">CONVERSE SUN RX </a></p>

                                                    <div class="product-wrapper">

                                                        <table class="info-wrapper">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Price</th>
                                                                    <td>

                                                                        <span class="price">$45.00</span>

                                                                    </td>
                                                                </tr>
                                                                <tr class="qty-wrapper">
                                                                    <th>Qty</th>
                                                                    <td>
                                                                        <input id="qinput-739" data-link="http://ld-magento.template-help.com/magento_61193/checkout/cart/ajaxUpdate/id/739/uenc/aHR0cDovL2xkLW1hZ2VudG8udGVtcGxhdGUtaGVscC5jb20vbWFnZW50b182MTE5My95b3V0aC5odG1sLw,,/" data-item-id="739" class="qty cart-item-quantity input-text" name="" value="1" />

                                                                        <button id="qbutton-739" data-item-id="739" disabled="disabled" data-update class="button quantity-button">
                                                                            <span><span>ok</span></span>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>

                                                    <div class="action-icons">
                                                        <a href="#" title="Edit item" class="btn-edit">
                                                            Edit item            </a>
                                                        <a href="#" title="Remove This Item" data-confirm="Are you sure you would like to remove this item from the shopping cart?" class="remove">
                                                            Remove Item                    </a>
                                                    </div>

                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div id="minicart-widgets">
                                    </div>
                                    <div class="block-content">
                                        <p class="subtotal">
                                            <span class="label">Cart Subtotal:</span> <span class="price">$3,841.00</span> </p>
                                    </div>

                                    <div class="minicart-actions">
                                        <ul class="checkout-types minicart">
                                            <li>
                                                <a title="Checkout" class="button checkout-button" href="../checkout/onepage/default.htm">
                                                    <span><span>Checkout</span></span>
                                                </a>
                                            </li>
                                        </ul>
                                        <a class="cart-link" href="../checkout/cart/default.htm">
                                            View Shopping Cart            </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- *************  End Skip Container ************* -->
        </header>
        <script src="<?= base_url('public/') ?>js/sed_common.js" type="text/javascript"></script>