<div class="row">
	<div class="span12">
		<div class="page-header">
			<h1>Meu Perfil <small>Atualize os seus dados pessoais</small></h1>
		</div>
		<div class="alert alert-info">
			<button class="close" data-dismiss="alert">×</button>
			<strong>Dica:</strong> Atualizando os seus dados corretamente será possível realizar inscrições utilizando o sistema.
		</div>
		<form action="<?php echo Uri::create('usuario/perfil'); ?>" id="usuario_perfil_form" class="form form-horizontal" method="POST">
			<fieldset>
	          	<div class="control-group">
	          		<?php echo Form::label('Nome Completo', 'usuario_nome', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<?php echo Form::input('usuario_nome', $usuario_dados['nome'], array('id' => 'usuario_nome', 'class' => 'input-xlarge')); ?>
	            	</div>
	          	</div>

	          	<div class="control-group">
	          		<?php echo Form::label('Identidade', 'usuario_identidade', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<?php echo Form::input('usuario_identidade', $usuario_dados['identidade'], array('id' => 'usuario_identidade', 'class' => 'input-xlarge', 'maxlength' => 10)); ?>
	            	</div>
	          	</div>

	          	<div class="control-group">
	          		<?php echo Form::label('CPF', 'usuario_cpf', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<?php echo Form::input('usuario_cpf', $usuario_dados['cpf'], array('id' => 'usuario_cpf', 'class' => 'input-xlarge')); ?>
	            	</div>
	          	</div>

	          	<div class="control-group">
	          		<?php echo Form::label('Data de Nascimento', 'usuario_nascimento', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<?php echo Form::input('usuario_nascimento', $usuario_dados['nascimento'], array('id' => 'usuario_nascimento', 'class' => 'input-xlarge dataBR')); ?>
	            	</div>
	          	</div>

	          	<div class="control-group">
	          		<?php echo Form::label('Número CBO', 'usuario_ncbo', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<?php echo Form::input('usuario_ncbo', $usuario_dados['numero_cbo'], array('id' => 'usuario_ncbo', 'class' => 'input-xlarge')); ?>
	            	</div>
	          	</div>

	          	<div class="control-group">
	          		<?php echo Form::label('Número SI Card', 'usuario_sicard', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<?php echo Form::input('usuario_sicard', $usuario_dados['sicard'], array('id' => 'usuario_sicard', 'class' => 'input-xlarge')); ?>
	            	</div>
	          	</div>

	          	<div class="control-group">
	          		<?php echo Form::label('Alergia', 'usuario_alergia', array('class' => 'control-label')); ?>
    			    <div class="controls">
              			<label class="checkbox">
              				<?php echo Form::checkbox('usuario_alergia', 1, $usuario_dados['alergia'] == 1 ?: null, array('id' => 'usuario_alergia', 'class' => 'input-xlarge')); ?>
                			Declaro que possuo algum tipo de alergia
              			</label>
            		</div>
          		</div>

	          	<div class="form-actions">
	            	<button type="submit" class="btn btn-primary">Atualizar perfil</button>
	          	</div>
	        </fieldset>
		</form>
	</div>
</div>