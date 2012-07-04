 <?php if(Session::get_flash('flash_msg')): ?>
    <div class="nNote <?php echo Arr::get(Session::get_flash('flash_msg'), 'msg_type') ?>">
        <p><?php echo Arr::get(Session::get_flash('flash_msg'), 'msg_content'); ?></p>
    </div>
<?php endif ?>

 <?php if(Session::get('profile_unfinished') == true and Sentry::check()): ?>
    <div class="grid12 fluid">
         <div class="nNote nFailure">
             <p>
                 <strong>Perfil Incompleto!</strong> Não será possível realizar uma nova inscrição até que dados como seu cpf, data de nascimento e nome completo estejam cadastrados em seu perfil!
                 Atualize o seu perfil através <?php echo Html::anchor('perfil', 'deste link', array('title' => 'Atualize o seu perfil!', 'class' => 'tipS')); ?>.
             </p>
             <div class="clear"></div>
         </div>
    </div>
 <?php endif; ?>