<div id="preloader"></div>
<div id="main-slider">
</div>
<div class="main-container col2-left-layout">
    <div class="breadcrumbs">
        <div class="container">
            <ul>
                <li class="home">
                    <a href="#" title="Go to Home Page">Home</a>
                    <span class="fa fa-angle-right"></span>
                </li>
                <li class="category3">
                    <a href="<?= base_url('search?product=' . $product['id']) ?>" title=""><?= (isset($product)) ? $product['name'] : '' ?></a>
                    <!--<span class="fa fa-angle-right"></span>-->
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="main">
            <div class="row">
                <div class="col-main col-xs-12 col-sm-9">

                    <div class="category-products">
                        <div class="toolbar">
                            <div class="sorter">
                                <p class="view-mode">
                                    <label>View as</label>
                                    <?php
                                    if ($view == 'grid') {
                                        ?>
                                        <strong title="Grid" class="grid">Grid</strong>
                                        <a href="<?= $url . '&view=list' ?>" title="List" class="list">List</a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?= $url . '&view=grid' ?>" title="Grid" class="grid">Grid</a>
                                        <strong title="List" class="list">List</strong>
                                        <?php
                                    }
                                    ?>
                                </p>
                                <div class="sort-by">
                                    <label>Sort By</label>
                                    <select id="arrange-by" class="form-control" title="Sort By">
                                        <?php
                                        if ($arrange_by == 'price') {
                                            ?>
                                            <option value="price" selected="selected"> Price </option>
                                            <option value="name"> Name </option>
                                            <?php
                                        } else {
                                            ?>
                                            <option value="price" > Price </option>
                                            <option value="name" selected="selected"> Name </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <?php
                                    $new_arrange_mode = 'asc';
                                    $new_arrange_class = 'desc';
                                    $new_arrange_title = 'Ascending';
                                    if ($arrange_mode == 'asc') {
                                        $new_arrange_mode = 'desc';
                                        $new_arrange_class = 'asc';
                                        $new_arrange_title = 'Descending';
                                    }
                                    ?>
                                    <a href="<?= $url . '&arrange_mode=' . $new_arrange_mode ?>" class="sort-by-switcher sort-by-switcher--<?= $new_arrange_class ?>" title="Set <?= $new_arrange_title ?> Direction">Set <?= $new_arrange_title ?> Direction</a>
                                </div>
                            </div>
                            <div class="pager">
                                <div class="count-container">
                                    <p class="amount amount--no-pages">
                                        <strong><?= count($models) ?> Item(s)</strong>
                                    </p>

                                    <div class="limiter">
                                        <label>Show</label>
                                        <select id="show-amount" title="Results per page">
                                            <?php
                                            $values = [12, 24, 36];
                                            foreach ($values as $v) {
                                                $selected = '';
                                                if ($v == $show_amount) {
                                                    $selected = 'selected="selected"';
                                                }
                                                ?>
                                                <option value="<?= $v ?>" <?= $selected ?>><?= $v ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <ul class="products-<?= $view ?> row">
                            <?php
                            if (count($models) > 0) {
                                foreach ($models as $model) {
                                    $original_price = $model['display_price_original'];
                                    $sale_price = $model['display_price_sale'];
                                    $desc = htmlspecialchars_decode($model['description']);
                                    if (str_word_count($desc) > 20) {
                                        $desc = substr($desc, 0, 150);
                                        $desc .= '...';
                                    }
                                    if ($view == 'grid') {
                                        ?>
                                        <li class="item col-xs-12 col-sm-4" itemscope itemtype="http://schema.org/product">
                                            <div class="wrapper-hover clearfix">
                                                <div class="product-image-container">
                                                    <a href="<?= base_url('search/model_view/' . $model['id']) ?>" title="<?= $model['model_name'] ?>" class="product-image" itemprop="url">
                                                        <img id="product-collection-image-2" src="<?= $model['image'] ?>" alt="<?= $model['model_name'] ?>" width="270" height="270" itemprop="image" />
                                                    </a>
                                                </div>
                                                <div class="product-details">
                                                    <h2 class="product-name" ><?= $model['brand'] ?></h2>
                                                    <h2 class="product-name" itemprop="name"><a href="<?= base_url('search/model_view/' . $model['id']) ?>" title="<?= $model['model_name'] ?>"><?= $model['model_name'] ?></a></h2>
                                                    <div class="price-box">
                                                        <span class="regular-price" id="product-price-2">
                                                            <span class="price"><?= number_format($sale_price, 2) ?></span> 
                                                        </span>
                                                        <?php
                                                        if ($sale_price < $original_price) {
                                                            ?>
                                                            <p class="old-price">
                                                                <span class="price-label"></span>
                                                                <span class="price" id="old-price-36"><?= DEFAULT_CURRENCY . ' ' . number_format($original_price, 2) ?></span>
                                                            </p>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <!--                                                                                                        <div class="wrapper-hover-hiden">
                                                                                                                                                                <div class="ratings">
                                                                                                                                                                    <span class="amount"><a href="<?= base_url('search/model_view/' . $model['id']) ?>" >1 Review(s)</a></span>
                                                                                                                                                                </div>
                                                                                                                                                                <div class="actions">
                                                                                                                                                                    <button type="button" title="Add to Cart" class="button btn-cart" onclick=""><span><span></span></span>
                                                                                                                                                                    </button>
                                                                                                                                                                    <ul class="add-to-links">
                                                                                                                                                                        <li>
                                                                                                                                                                            <a href="#" class="link-wishlist" title="Add to Wishlist"></a>
                                                                                                                                                                        </li>
                                                                                                                                                                                    <li><span class="separator">|</span>
                                                                                                                                                                            <a href="#" class="link-compare" title="Add to Compare"></a>
                                                                                                                                                                        </li>
                                                                                                                                                                    </ul>
                                                                                                                                                                </div>
                                                                                                                                                            </div>-->
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    } else {
                                        ?>
                                        <li class="item" itemscope itemtype="http://schema.org/product">
                                            <div class="product-image-container">
                                                <div class="label-product">             
                                                    <!--<span class="new">New</span>-->                            
                                                </div>
                                                <a href="<?= base_url('search/model_view/' . $model['id']) ?>" title="<?= $model['model_name'] ?>" class="product-image" itemprop="url" style="width:290px;">
                                                    <img id="product-collection-image-2" src="<?= $model['image'] ?>" width="270" height="152" alt="<?= $model['model_name'] ?>" itemprop="image" />
                                                </a>
                                            </div>
                                            <div class="product-shop">
                                                <div class="f-fix">
                                                    <div class="product-primary">
                                                        <h2 class="product-name" ><?= $model['brand'] ?></h2>
                                                        <h2 class="product-name" itemprop="name"><a href="<?= base_url('search/model_view/' . $model['id']) ?>" title="<?= $model['model_name'] ?>"><?= $model['model_name'] ?></a></h2>
                                                        <div itemprop="description"><?= $desc ?></div>
                                                        <a href="<?= base_url('search/model_view/' . $model['id']) ?>" title="<?= $model['model_name'] ?>" class="link-learn">View More</a>
                                                    </div>
                                                </div>
                                                <div class="product-secondary">
                                                    <div class="price-box">
                                                        <span class="regular-price" id="product-price-2">
                                                            <span class="price"><?= DEFAULT_CURRENCY . ' ' . number_format($sale_price, 2) ?></span>                                    
                                                        </span>
                                                        <?php
                                                        if ($sale_price < $original_price) {
                                                            ?>
                                                            <p class="old-price">
                                                                <span class="price-label"></span>
                                                                <span class="price" id="old-price-36"><?= DEFAULT_CURRENCY . ' ' . number_format($original_price, 2) ?></span>
                                                            </p>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <p class="actions">
                                                        <button type="button" title="Select" onclick="window.location.href = '<?= base_url('search/model_view/' . $model['id']) ?>';" class="button btn-cart" ><span><span>Select</span></span></button>
                                                    </p><!--
                                                    </div>-->
            <!--                                                    <p class="actions">
                                                        <button type="button" title="Add to Cart" class="button btn-cart" ><span><span>Add to Cart</span></span></button>
                                                    </p>
                                                    <ul class="add-to-links">
                                                        <li><a title="Add to Wishlist" href="#" class="link-wishlist tooltips">Add to Wishlist</a></li>
                                                        <li><span class="separator">|</span> <a title="Add to Compare" href="#" class="link-compare tooltips">Add to Compare</a></li>
                                                    </ul>-->
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                }
                            } else {
                                ?>
                                <li class="col-md-12">
                                    <p class="text-center">There are no models to show.</p>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <ul class="products-grid row">
                            <div class="toolbar-bottom">
                                <div class="toolbar">
                                    <div class="sorter">
                                        <p class="view-mode">
                                            <label>View as</label>
                                            <strong title="Grid" class="grid">Grid</strong>
                                            <a href="Product_List.htm@mode=list" title="List" class="list">List</a>
                                        </p>
                                        <div class="sort-by">
                                            <label>Sort By</label>
                                            <select onchange="setLocation(this.value)" class="form-control"> title="Sort By">
                                                <option value="Product_List.htm@dir=asc&order=position" selected="selected">
                                                    Position </option>
                                                <option value="Product_List.htm@dir=asc&order=name">
                                                    Name </option>
                                                <option value="Product_List.htm@dir=asc&order=price">
                                                    Price </option>
                                                <option value="Product_List.htm@dir=asc&order=frame_color">
                                                    Frame color </option>
                                                <option value="Product_List.htm@dir=asc&order=size">
                                                    Size </option>
                                            </select>
                                            <a href="Product_List.htm@dir=desc&order=position" class="sort-by-switcher sort-by-switcher--asc" title="Set Descending Direction">Set Descending Direction</a>
                                        </div>
                                    </div>
                                    <div class="pager">
                                        <div class="count-container">
                                            <p class="amount amount--no-pages">
                                                <strong><?= count($models) ?> Item(s)</strong>
                                            </p>

                                            <div class="limiter">
                                                <label>Show</label>
                                                <select onchange="setLocation(this.value)" title="Results per page">
                                                    <option value="Product_List.htm@limit=12">
                                                        12 </option>
                                                    <option value="Product_List.htm@limit=24">
                                                        24 </option>
                                                    <option value="Product_List.htm@limit=36" selected="selected">
                                                        36 </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="col-left sidebar col-xs-12 col-sm-3">
                    <div class="col-left-first">
                        <div class="block block-layered-nav block-layered-nav--no-filters">
                            <div class="block-title">
                                <strong><span>Shop by</span></strong>
                            </div>
                            <div class="block-content toggle-content">
                                <div class="selected-filter">
                                </div>
                                <p class="block-subtitle block-subtitle--filter">Filter</p>
                                <dl id="narrow-by-list">
                                    <?php
                                    foreach ($fields as $field) {
                                        if ($field['field_type'] == 'LIST') {
                                            $unit = $field['unit'];
                                            ?>
                                            <dt><?= $field['field_name'] ?></dt>
                                            <dd>
                                                <ol class="configurable-swatch-list">
                                                    <?php
                                                    foreach ($field['values'] as $value) {
                                                        ?>
                                                        <ol>
                                                            <li>
                                                                <a href="#">
                                                                    <span class="price"><?= $value['value'] . ' ' . $field['unit'] ?></span> <span class="count"></span>
                                                                </a>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ol>
                                            </dd>
                                            <?php
                                        }
                                    }
                                    ?>
                                </dl>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('public/') ?>js/site/jquery.easydropdown.min.js"></script>

<script>
                                                    const BASEURL = '<?= base_url() ?>';
                                                    $(function () {
                                                        $('#arrange-by').easyDropDown({
                                                            onChange: function (selected) {
                                                                window.location.href = '<?= $url ?>&arrange_by=' + selected.value;
                                                            }
                                                        });
                                                        $('#show-amount').easyDropDown({
                                                            onChange: function (selected) {
                                                                window.location.href = '<?= $url ?>&show_amount=' + selected.value;
                                                            },
                                                        });
                                                    });
</script>

