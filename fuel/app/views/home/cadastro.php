<div class="row">
	<div class="span12">
        <div class="page-header">
            <h1>Formulário de Cadastro</h1>
        </div>
		<form action="<?php echo Uri::create('cadastro'); ?>" class="form-horizontal form-dovalidation" method="POST">
            <fieldset>
                <div class="control-group">
                    <label for="cadastro-email" class="control-label">Email</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-envelope"></i></span><input type="text" id="cadastro-email" name="cadastro-email" class="input-xlarge" data-validation-engine="validate[required, custom[email]]">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label for="cadastro-usuario" class="control-label">Nome de Usuário</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span><input type="text" id="cadastro-usuario" name="cadastro-usuario" class="input-xlarge" data-validation-engine="validate[required]">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label for="cadastro-senha" class="control-label">Senha</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span><input type="password" id="cadastro-senha" name="cadastro-senha" class="input-xlarge" data-validation-engine="validate[required]">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label for="cadastro-senha-verify" class="control-label">Confirme a Senha</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span><input type="password" id="cadastro-senha-verify" name="cadastro-senha-verify" class="input-xlarge" data-validation-engine="validate[required, equals[cadastro-senha]]">
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button class="btn btn-primary" type="submit">Realizar Cadastro</button>
                </div>
            </fieldset>
        </form>
	</div>
</div>