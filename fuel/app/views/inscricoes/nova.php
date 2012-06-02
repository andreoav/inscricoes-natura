<div class="row">
	<div class="span12">
		<div class="page-header">
			<h1>Nova Inscrição</h1>
		</div>
	</div>

	<!-- Início Breadcrumb -->
	<div class="span12">
		<ul class="breadcrumb">
			<li>
				<?php echo Html::anchor('home', 'Home'); ?> <span class="divider">/</span>
			</li>
			<li>
				<?php echo Html::anchor('inscricoes', 'Inscrições'); ?> <span class="divider">/</span>
			</li>
			<li class="active">Nova Inscrição</li>
		</ul>
	</div>
	<!-- Fim Breadcrumb -->

	<div class="span12">
		<form action="<?php echo Uri::create('inscricoes/nova'); ?>" class="form form-horizontal form-dovalidation" method="POST" enctype="multipart/form-data">
			<fieldset>
	          	<div class="control-group">
	          		<?php echo Form::label('Etapa', 'inscricao_etapa', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<select name="inscricao_etapa" id="inscricao_etapa" class="input-xxlarge">
	            			<?php foreach($etapas as $etapa): ?>
	            				<option value="<?php echo $etapa->id; ?>"><?php echo $etapa->nome . ' - ' . $etapa->campeonato->nome; ?></option>
	            			<?php endforeach; ?>
	            		</select>
	            	</div>
	          	</div>
	          	<div class="control-group">
	          		<?php echo Form::label('Etapa', 'inscricao_categoria', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<select name="inscricao_categoria" id="inscricao_categoria" class="input-xxlarge">
            				<option value="H21E">H21E</option>
	            		</select>
	            	</div>
	          	</div>
	          	<div class="control-group">
	          		<?php echo Form::label('Comprovante', 'inscricao_comprovante', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<input type="file" name="inscricao_comprovante" id="inscricao_comprovante" class="input-file input-xxlarge" data-validation-engine="validate[required]">
	            		<p class="help-block"><strong>Insira o comprovante de pagamento!</strong> <small>Ex: Scanei o seu comprovante e anexe neste campo.</small></p>
	        		</div>
	          	</div>
	          	<div class="control-group">
	          		<?php echo Form::label('Observação', 'inscricao_observacao', array('class' => 'control-label')); ?>
	            	<div class="controls">
	              		<textarea name="inscricao_observacao" id="inscricao_observacao" rows="5" class="input-xxlarge"></textarea>
	        		</div>
	          	</div>
	          	<div class="form-actions">
	            	<button type="submit" class="btn btn-primary">Enviar Pedido</button>
	            	<a href="<?php echo Uri::create('home'); ?>" class="btn btn-warning">Cancelar</a>
	          	</div>
	        </fieldset>
		</form>
	</div>
</div>