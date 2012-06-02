<div class="row">
	<div class="span12">
		<div class="page-header">
			<h1>Nova Etapa</h1>
		</div>
	</div>
	<!-- Início Breadcrumb -->
	<div class="span12">
		<ul class="breadcrumb">
			<li>
				<?php echo Html::anchor('home', 'Home'); ?> <span class="divider">/</span>
			</li>
			<li>
				<?php echo Html::anchor('admin', 'Administração'); ?> <span class="divider">/</span>
			</li>
			<li>
				<?php echo Html::anchor('admin/etapas', 'Etapas'); ?> <span class="divider">/</span>
			</li>
			<li class="active">Nova Etapa</li>
		</ul>
	</div>
	<!-- Fim Breadcrumb -->
	<div class="span12">
		<form action="<?php echo Uri::create('admin/etapas/nova'); ?>" class="form form-horizontal form-dovalidation" method="POST">
			<fieldset>
	          	<div class="control-group">
	          		<?php echo Form::label('Campeonato', 'etapa_campeonato', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<select name="etapa_campeonato" id="etapa_campeonato" class="input-xxlarge">
	            			<?php foreach($campeonatos as $campeonato): ?>
	            				<option value="<?php echo $campeonato->id; ?>"><?php echo $campeonato->nome; ?></option>
	            			<?php endforeach; ?>
	            		</select>
	            	</div>
	          	</div>
	          	<div class="control-group">
	          		<?php echo Form::label('Nome', 'etapa_nome', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<?php echo Form::input('etapa_nome', null, array('id' => 'etapa_nome', 'class' => 'input-xxlarge', 'data-validation-engine' => 'validate[required]')); ?>
	            	</div>
	          	</div>
	          	<div class="control-group">
	          		<?php echo Form::label('Localidade', 'etapa_localidade', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<?php echo Form::input('etapa_localidade', null, array('id' => 'etapa_localidade', 'class' => 'input-xxlarge', 'data-validation-engine' => 'validate[required]')); ?>
	            		<p class="help-block">Clique aqui para saber como usar este campo...</p>
	            	</div>
	          	</div>
	          	<div class="control-group">
	          		<?php echo Form::label('Início - Fim', 'etapa_inicio', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<?php echo Form::input('etapa_inicio', null, array('id' => 'etapa_inicio', 'class' => 'input-small dataBR', 'data-validation-engine' => 'validate[required, custom[dateBR]]', 'data-prompt-position' => 'topLeft')); ?> -
	            		<?php echo Form::input('etapa_final', null, array('id' => 'etapa_final', 'class' => 'input-small dataBR', 'data-validation-engine' => 'validate[required, custom[dateBR]]', 'data-prompt-position' => 'bottomRight')); ?>
	            	</div>
	          	</div>
	          	<div class="control-group">
	          		<?php echo Form::label('Inscrições até', 'etapa_inscricoes_ate', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<?php echo Form::input('etapa_inscricoes_ate', null, array('id' => 'etapa_inscricoes_ate', 'class' => 'input-small dataBR', 'data-validation-engine' => 'validate[required, custom[dateBR]]')); ?>
	            	</div>
	          	</div>
	          	<div class="form-actions">
	            	<button type="submit" class="btn btn-primary">Criar Etapa</button>
	            	<a href="<?php echo Uri::create('admin/etapas'); ?>" class="btn btn-warning">Cancelar</a>
	          	</div>
	        </fieldset>
		</form>
	</div>
</div>