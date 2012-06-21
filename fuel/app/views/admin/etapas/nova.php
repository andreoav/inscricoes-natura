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
		<form action="<?php echo Uri::create('admin/etapas/nova'); ?>" id="nova_etapa_form" class="form form-horizontal" method="POST">
			<fieldset>
	          	<div class="control-group">
	          		<?php echo Form::label('Campeonato', 'etapa_campeonato', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<select name="etapa_campeonato" id="etapa_campeonato" class="input-xxlarge chzn-select">
	            			<?php foreach($campeonatos as $campeonato): ?>
	            				<option value="<?php echo $campeonato->id; ?>"><?php echo $campeonato->nome; ?></option>
	            			<?php endforeach; ?>
	            		</select>
	            	</div>
	          	</div>

	          	<div class="control-group">
	          		<?php echo Form::label('Nome', 'etapa_nome', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<?php echo Form::input('etapa_nome', null, array('id' => 'etapa_nome', 'class' => 'input-xxlarge')); ?>
	            	</div>
	          	</div>

	          	<div class="control-group">
	          		<?php echo Form::label('Localidade', 'etapa_localidade', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<?php echo Form::input('etapa_localidade', null, array('id' => 'etapa_localidade', 'class' => 'input-xxlarge')); ?>
	            	</div>
	          	</div>

	          	<div class="control-group">
	          		<?php echo Form::label('Início', 'etapa_inicio', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<?php echo Form::input('etapa_inicio', null, array('id' => 'etapa_inicio', 'class' => 'input dataBR datepicker')); ?>
	            	</div>
	          	</div>

	          	<div class="control-group">
	          		<?php echo Form::label('Final', 'etapa_final', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<?php echo Form::input('etapa_final', null, array('id' => 'etapa_final', 'class' => 'input dataBR datepicker')); ?>
	            	</div>
	          	</div>

	          	<div class="control-group">
	          		<?php echo Form::label('Inscrições até', 'etapa_inscricoes_ate', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<?php echo Form::input('etapa_inscricoes_ate', null, array('id' => 'etapa_inscricoes_ate', 'class' => 'input dataBR datepicker')); ?>
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