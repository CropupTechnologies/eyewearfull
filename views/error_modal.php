<html>
    <head>
        <title>SEB Error Handler</title>
    </head>
    <body>
        <link rel="stylesheet" type="text/css" href="<?= base_url('public/css/errormodal.css') ?>"/>
        <div id="err_window_container"></div>
        <div class="err_modal_window" id="err_errorwindow">
            <div class="err_title" id="err_title"><b><a id="err_smart" title="SmarteDesigners" href="http://www.smartedesigners.com" target="_blank">Smart eDesigners - Corporate Error Handler</a></b></div>
            <div id="err_errormodalinner">
                <img src="<?= base_url('public/images/erclose.png') ?>" id="err_closebutton"/>
                <div id="err_warning"></div>
                <div id="err_errormessage"><span id="err_company"><?= APP_NAME ?></span> has encountered an error and needs to close.<br/><br/> We are sorry for the inconvinience.</div>
                <div id="err_message1">
                    <p>If you were in the middle of doing something, the information you were working on might be lost.<br>
                    <p><b>Please tell <a id="err_smart" title="Smart eDesigners" href="http://www.smartedesigners.com" target="_blank">Smart eDesigners</a> about this problem.</b></p>
                    <p>We have created an error report that you can send to us. We will treat this error report as confidential and anonymous.</p>
                    <p>To see what data this error report contains <a id="err_errorexpand">click here.</a></p>
                </div>
            </div>
            <div id="err_erromodalouter">
                <?= $message ?> 
            </div>
            <div id="err_buttons">
                <ul>
                    <li><a id="err_send"></a></li>
                    <!--<li><a href="<?= base_url() ?>" id="err_dontsend"></a></li>-->
                    <li><a onclick="window.history.back();" id="err_dontsend"></a></li>
                </ul>
            </div>
        </div>
        <div id="err_errormask" class="err_close_modal"></div>
        <script
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
        <script src="<?= base_url('public/js/model_window.js') ?>"></script>
    </body>
</html>
