<section id="loginForm">
    <div class="row">
        <div class="span12">
            <div class="page-header">
                <h1>Sobre o Sistema</h1>
            </div>
            <p>O Natura Clube de Orientação apresenta sua mais nova ferramenta para gerenciamento de atletas e inscrições em etapas. Veja os recursos disponíveis no sistema:</p>
            <ul>
                <li>Controle de Atletas do Clube</li>
                <li>Controle de Inscrições</li>
                <li>Etapas dos vários compeonatos disponível com informações completas e mapas</li>
                <li>Envio de email para todos atletas cadastrados de maneira prática. <span class="label label-success">Novo!</span></li>
                <li>Entre muitos outros...</li>
            </ul>
            <p>Se você já está cadastrado no sistema, use o formulário ao lado para efetuar o seu login, se você ainda não se cadastrou clique no botão abaixo e crie a sua conta.</p>
            <p>
                <?php echo Html::anchor('cadastro', 'Cadastrar-se', array('class' => 'btn btn-large btn-info')); ?>
                <?php echo Html::anchor('#loginModal', 'Efetuar Login', array('class' => 'btn btn-large btn-primary', 'data-toggle' => 'modal')); ?>
            </p>
        </div>
    </div>
</section>

<div class="modal fade hide" id="loginModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3>Formulário de Login</h3>
    </div>
    <?php echo Form::open(array('action' => 'login', 'id' => 'login-form', 'class' => 'form-horizontal modal-form')); ?>
        <div class="modal-body modal-form">
            <div class="control-group">
                <label for="username" class="control-label">Usuário:</label>
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-user"></i></span><input type="text" class="input-large" name="username" id="username">
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label for="password" class="control-label">Senha:</label>
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-lock"></i></span><input type="password" class="input-large" name="password" id="password">
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox" value="1" id="optionsCheckbox" name="remember">
                        Mantenha-me conectado
                    </label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Efetuar Login</button>
        </div>
    <?php echo Form::close(); ?>
</div>