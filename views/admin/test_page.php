
<div class="page-inner">
    <div class="page-title">
        <h3>Test Page</h3> 
        <?= $test_content ?>
    </div>
    <div id="main-wrapper">

        <style>
            .search-anim-image{
                background: url('<?= base_url('public/images/loading_blue.gif') ?>') !important;
                background-color: #ffffff !important;
                background-position:right center !important;
                background-repeat: no-repeat !important;
            }
        </style>
        <script src="<?= base_url('public/js/admin/select_item.js') ?>"></script>
        <script>
            var messages = [];
            var categories = <?= json_encode($categories, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) ?>;
            var items = <?= json_encode($items, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) ?>;
            messages[43] = '<?= $this->config->item(43, 'msg') ?>';
            messages[44] = '<?= $this->config->item(44, 'msg') ?>';
            messages[600] = '<?= $this->config->item(600, 'msg') ?>';
            messages[601] = '<?= $this->config->item(601, 'msg') ?>';
            messages[604] = '<?= $this->config->item(604, 'msg') ?>';
            messages[605] = '<?= $this->config->item(605, 'msg') ?>';
            messages[606] = '<?= $this->config->item(606, 'msg') ?>';
                    const BASEURL = '<?= base_url() ?>';
                    const LOADING_IMAGE = '<?= base_url('public/images/loading_blue.gif') ?>';
        </script>
