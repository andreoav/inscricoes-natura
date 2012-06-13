<?php
if(\Session::get_flash('flash_msg'))
{
    echo '<div class="row"><div class="span12">';
    echo '<div class="alert ' .
         \Arr::get(\Session::get_flash('flash_msg'), 'msg_type') . ' fade in">' .
         '<button class="close" data-dismiss="alert">&times;</button><strong>' .
         \Arr::get(\Session::get_flash('flash_msg'), 'msg_content').'</strong></div>';
    echo '</div></div>';
}