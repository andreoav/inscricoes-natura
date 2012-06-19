<div class="row">
    <div class="span12" id="flash_msgs">
        <?php if(Session::get_flash('flash_msg')): ?>
        <div class="alert <?php echo Arr::get(Session::get_flash('flash_msg'), 'msg_type') ?> fade in">
            <button class="close" data-dismiss="alert">&times;</button>
            <strong><?php echo Arr::get(Session::get_flash('flash_msg'), 'msg_content'); ?></strong>
        </div>
        <?php endif ?>
    </div>
</div>