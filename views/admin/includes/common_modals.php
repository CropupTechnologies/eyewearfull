<!-- Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1600" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header common-modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><strong>Modal title</strong></h4>
            </div>
            <div class="modal-body common-modal-body">
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.<br><br>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
            </div>
            <div class="modal-footer common-modal-footer">
                <p class="message-id"></p>
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <button type="button" class="btn btn-success message-btn" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
<!-- End : Message Modal -->

<!-- Yes No Modal -->
<div class="modal fade" id="yesNoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1500" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.<br><br>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
            </div>
            <div class="modal-footer">
                <p class="message-id"></p>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-success yes-btn" data-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>
<!-- End : Yes No Modal -->

<!-- Forgot Password Modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1050" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Reset Password</h4>
            </div>
            <div class="modal-body">
                <?= $this->config->item(4, 'msg') ?>
                <form id="password-reset-form" class="m-t-md" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="forgot-username"  id="forgot-username" placeholder="Username / recovery email" required="true">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p class="message-id">4</p>
                <img class="loading-circle" src="<?= base_url("public/images/admin_images/reload.gif") ?>"/>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success yes-btn" onclick="reset_password()">Ok</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('public/') ?>js/login_utils.js"></script>
<!-- End : Yes No Modal -->