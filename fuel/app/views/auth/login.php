<section id="loginForm">
    <div class="row">
        <div class="span6">
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
                <?php echo Html::anchor('cadastro', 'Cadastrar-se &raquo;', array('class' => 'btn btn-large btn-info', 'rel' => 'tooltip', 'title' => 'Cadastrar-se no Sistema')); ?>
            </p>
        </div>
        <div class="span5">
            <div class="page-header">
                <h1>Formulário de Login</h1>
            </div>
            <div id="loginModal">
                <?php echo Form::open(array('action' => Uri::base(), 'id' => 'login-form', 'class' => 'form-horizontal')); ?>
                <fieldset>
                    <div class="control-group">
                        <label for="username" class="control-label">Usuário:</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-user"></i></span><input type="text" class="input-xlarge" name="username" id="username">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="password" class="control-label">Senha:</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-lock"></i></span><input type="password" class="input-xlarge" name="password" id="password">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-primary">Efetuar Login &raquo;</button>
                            <input type="hidden" value="1" id="optionsCheckbox" name="remember">
                            <input type="hidden" value="<?php echo $redir; ?>" name="redir">
                        </div>
                    </div>
                </fieldset>
                <?php echo Form::close(); ?>
            </div>
        </div>
    </div>
</section>