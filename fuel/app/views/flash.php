 <?php if(Session::get_flash('flash_msg')): ?>
    <div class="nNote <?php echo Arr::get(Session::get_flash('flash_msg'), 'msg_type') ?>">
        <p><?php echo Arr::get(Session::get_flash('flash_msg'), 'msg_content'); ?></p>
    </div>
<?php endif ?>