<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">

        <ul class="menu accordion-menu">
            <li class=""><a href="<?= base_url('admin'); ?>" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>
            <li class="droplink"><a href="<?= base_url('admin/items'); ?>" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-list-alt"></span><p>Sales</p><span class="arrow"></span></a>
                <ul class="sub-menu">
                    <li><a href="<?= base_url('order') ?>" class="waves-effect waves-button"><p>Orders</p></a></li>
                    <li><a href="<?= base_url('admin/invoice') ?>" class="waves-effect waves-button"><p>Invoices</p></a></li>
                </ul>
            </li>
            <li class="droplink"><a href="<?= base_url('admin/items'); ?>" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-list-alt"></span><p>Item Registry</p><span class="arrow"></span></a>
                <ul class="sub-menu">
                    <li><a href="<?= base_url('item/items') ?>" class="waves-effect waves-button"><p>Items</p></a></li>
                    <li><a href="<?= base_url('item/pricing') ?>" class="waves-effect waves-button"><p>Pricing</p></a></li>
                </ul>
            </li>
            <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-list"></span><p>Entities</p><span class="arrow"></span></a>
                <ul class="sub-menu">
                    <li><a href="<?= base_url('admin/brands') ?>" class="waves-effect waves-button"><p>Brands</p></a></li>
                    <li><a href="<?= base_url('category') ?>" class="waves-effect waves-button"><p>Category</p></a></li>
                    <li><a href="<?= base_url('branch') ?>" class="waves-effect waves-button"><p>Branch</p></a></li>
                    <li><a href="<?= base_url('admin/colors'); ?>" class="waves-effect waves-button"><p>Colors</p></a></li>
                </ul>
            </li>
            <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th"></span><p>Miscellaneous</p><span class="arrow"></span></a>
                <ul class="sub-menu">
                    <li><a href="<?= base_url('admin/news') ?>" class="waves-effect waves-button"><p>News</p></a></li>
                </ul>
            </li>
            <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon fa fa-clipboard"></span><p>Stock</p><span class="arrow"></span></a>
                <ul class="sub-menu">
                    <li><a href="<?= base_url('item/grn') ?>" class="waves-effect waves-button"><p>GRN</p></a></li>
                </ul>
            </li>
            <li><a href="<?= base_url('admin/users') ?>" class="waves-effect waves-button"><span class="menu-icon fa fa-user"></span><p>Users</p></a></li>

            <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon fa fa-bank"></span><p>Master Data</p><span class="arrow"></span></a>
                <ul class="sub-menu">
                    <!--<li><a href="<?= base_url('item/model_fields') ?>" class="waves-effect waves-button"><p>Model Fields</p></a></li>-->
                    <li><a href="<?= base_url('item/metadata_products') ?>" class="waves-effect waves-button"><p>Products</p></a></li>
                    <li><a href="<?= base_url('product_type') ?>" class="waves-effect waves-button"><p>Product Type</p></a></li>
                    <li><a href="<?= base_url('item/models') ?>" class="waves-effect waves-button"><p>Models</p></a></li>
                </ul>
            </li>
            <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon fa fa-cog"></span><p>Meta Data</p><span class="arrow"></span></a>
                <ul class="sub-menu">
                    <li><a href="<?= base_url('admin/fields') ?>" class="waves-effect waves-button"><p>Field List</p></a></li>
                </ul>
            </li>
            <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon fa fa-file"></span><p>Mater File</p><span class="arrow"></span></a>
                <ul class="sub-menu">
                    <li><a href="<?= base_url('suppliers') ?>" class="waves-effect waves-button"><p>Suppliers</p></a></li>
                </ul>
            </li>
            <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon fa fa-tags"></span><p>Promotions</p><span class="arrow"></span></a>
                <ul class="sub-menu">
                    <li><a href="<?= base_url('promotion') ?>" class="waves-effect waves-button"><p>Promotions</p></a></li>
                    <li><a href="<?= base_url('promotion/promotion_items') ?>" class="waves-effect waves-button"><p>Add Promotion Item</p></a></li>
                </ul>
            </li>
            <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon fa fa-file"></span><p>Reports</p><span class="arrow"></span></a>
                <ul class="sub-menu">
                    <li><a href="<?= base_url('report/pending_orders') ?>" class="waves-effect waves-button"><p>Pending Orders</p></a></li>
                    <li><a href="<?= base_url('report/cash_receipts') ?>" class="waves-effect waves-button"><p>Cash Receipts</p></a></li>
                </ul>
            </li>

        </ul>
    </div><!-- Page Sidebar Inner -->
</div><!-- Page Sidebar -->