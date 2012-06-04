<div class="box">
    <h2>Formulário de Login</h2>
    <?php echo Form::open(array('action' => 'login', 'id' => 'login-form', 'class' => 'form')); ?>
        <fieldset>
            <?php if(Session::get_flash('flash_msg')): ?>
                <div class="row">
                    <?php echo '<div class="alert ' . \Arr::get(\Session::get_flash('flash_msg'), 'msg_type') . '">' .
                        \Arr::get(\Session::get_flash('flash_msg'), 'msg_content').'</div>';
                    ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <?php echo Form::input('username', null, array('class' => 'login', 'id' => 'username', 'placeholder' => 'Nome de Usuário', 'data-validation-engine' => 'validate[required] ')); ?>
            </div>
            <div class="row">
                <?php echo Form::password('password', null, array('class' => 'password', 'id' => 'password', 'placeholder' => 'Senha', 'data-validation-engine' => 'validate[required] ')); ?>
                <?php echo Html::anchor('cadastro', 'Cadastrar-se', array('class' => 'forgot')); ?>
            </div>
            <div class="row">
                <?php echo Form::checkbox('remember', 1, true, array('class' => 'remember', 'id' => 'form_remember')); ?>
                <?php echo Form::label('Mantenha-me conectado', 'remember'); ?>
                <?php echo Form::submit('btn-entrar', 'Entrar'); ?>
            </div>
        </fieldset>
    <?php echo Form::close(); ?>
</div>