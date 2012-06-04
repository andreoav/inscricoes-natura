<div class="row">
	<div class="span12">
		<div class="page-header">
			<h1>Novo Campeonato</h1>
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
				<?php echo Html::anchor('admin/campeonatos', 'Campeonatos'); ?> <span class="divider">/</span>
			</li>
			<li class="active">Novo Campeonato</li>
		</ul>
	</div>
	<!-- Fim Breadcrumb -->
	<div class="span12">
		<form action="<?php echo Uri::create('admin/campeonatos/novo'); ?>" id="novo_campeonato_form" class="form form-horizontal" method="POST">
			<fieldset>
	          	<div class="control-group">
	          		<?php echo Form::label('Nome', 'campeonato_nome', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<?php echo Form::input('campeonato_nome', null, array('id' => 'campeonato_nome', 'class' => 'input-xxlarge')); ?>
	            	</div>
	          	</div>
	          	<div class="form-actions">
	            	<button type="submit" class="btn btn-primary">Criar Campeonato</button>
	            	<a href="<?php echo Uri::create('admin/campeonatos'); ?>" class="btn btn-warning">Cancelar</a>
	          	</div>
	        </fieldset>
		</form>
	</div>
</div>