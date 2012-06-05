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
        <a href="<?php echo Uri::create('login'); ?>" class="btn btn-large btn-info">Já sou cadastrado!</a>
    </div>
	<div class="span6">
        <div class="page-header">
            <h1>Formulário de Cadastro</h1>
        </div>
		<form action="<?php echo Uri::create('cadastro'); ?>" id="cadastro_form" class="form-horizontal" method="POST">
            <fieldset>
                <div class="control-group">
                    <label for="cadastro_email" class="control-label">Email</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-envelope"></i></span><input type="text" id="cadastro_email" name="cadastro_email" class="input-xlarge">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label for="cadastro_usuario" class="control-label">Nome de Usuário</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span><input type="text" id="cadastro_usuario" name="cadastro_usuario" class="input-xlarge">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label for="cadastro_senha" class="control-label">Senha</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span><input type="password" id="cadastro_senha" name="cadastro_senha" class="input-xlarge">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label for="cadastro_senha_verify" class="control-label">Confirme a Senha</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span><input type="password" id="cadastro_senha_verify" name="cadastro_senha_verify" class="input-xlarge">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button class="btn btn-primary" type="submit">Enviar Cadastro</button>
                    </div>
                </div>
            </fieldset>
        </form>
	</div>
</div>