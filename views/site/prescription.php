
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
                        <strong>Prescription</strong>
                        <table class="table table-bordered">
                            <tbody>
                                <tr><td rowspan="2"></td><td colspan="3">RIGHT</td><td colspan="3">LEFT</td><td rowspan="2">PD</td><td rowspan="2">LENSE TYPE</td></tr>
                                <tr><td>SPH</td><td>CYL</td><td>AXIS</td><td>SPH</td><td>CYL</td><td>AXIS</td></tr>
                                <tr><td>Distance</td><td><input class="pc_input" type="text" name="r_sph"/></td><td><input class="pc_input" type="text" name="r_cyl"/></td><td><input class="pc_input" type="text" name="r_axis"/></td><td><input class="pc_input" type="text" name="l_sph"/></td><td><input class="pc_input" type="text" name="l_cyl"/></td><td><input class="pc_input" type="text" name="l_axis"/></td><td><input class="pc_input" type="text" name="pd"/></td><td><input class="pc_input" type="text" name="lt"/></td></tr>
                                <tr><td>Near</td><td colspan="3"><input type="text" name="r_near"/></td><td colspan="3"><input type="text" name="l_near"/></td><td><input class="pc_input" type="text" name="pd_near"/></td><td><input class="pc_input" type="text" name="lese_type_near"/></td></tr>
                            </tbody>
                        </table>
                    </a>
                </li>
            </ul>
            <button type="button" title="Back" class="button btn-back pull-right" onclick="window.history.back();"><span>Back</span></button>
        </div>
    </div>
    <div class="container">
        <div class="main-container col1-layout">

        </div>
    </div>
</div>
<style>
    input.pc_input{
        width: 50px;
    }
</style>


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
                });</script>


<script src="<?= base_url('public/') ?>plugins/jquery-cookie/jquery.cookie.js" type="text/javascript"></script>
<script src="<?= base_url('public/') ?>js/site/item_view.js" type="text/javascript"></script>
<script src="<?= base_url('public/') ?>js/site/custom.js" type="text/javascript"></script>


