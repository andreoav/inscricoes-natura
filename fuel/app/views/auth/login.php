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
            <p><a href="<?php echo Uri::create('cadastro') ?>" class="btn btn-large btn-info">Cadastrar-se</a></p>
        </div>
        <div class="span6">
            <div class="page-header">
                <h1>Login</h1>
            </div>
            <?php echo Form::open(array('action' => 'login', 'id' => 'login-form', 'class' => 'form-horizontal')); ?>
                <fieldset>
                    <div class="control-group">
                        <label for="username" class="control-label">Nome de Usuário:</label>
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
                             <button class="btn btn-primary btn-large">Efetuar Login</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</section>