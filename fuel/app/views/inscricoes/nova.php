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

	<!-- Formulário de Inscrição -->
	<div class="span12">
		<form action="<?php echo Uri::create('inscricoes/nova'); ?>" class="form form-horizontal" id="nova_inscricao_form" method="POST" enctype="multipart/form-data">
			<fieldset>
				<!-- Select para a etapa -->
	          	<div class="control-group">
	          		<?php echo Form::label('Etapa', 'inscricao_etapa', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<select name="inscricao_etapa" id="inscricao_etapa" class="input-xxlarge chzn-select">
	            			<?php foreach($etapas as $etapa): ?>
	            				<option value="<?php echo $etapa->id; ?>"><?php echo $etapa->nome . ' - ' . $etapa->campeonato->nome; ?></option>
	            			<?php endforeach; ?>
	            		</select>
	            	</div>
	          	</div>
	          	<!-- \Select para a etapa -->

	          	<!-- Select pata a categoria -->
	          	<div class="control-group">
	          		<?php echo Form::label('Etapa', 'inscricao_categoria', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<select name="inscricao_categoria" id="inscricao_categoria" class="input-xxlarge chzn-select">
                            <?php foreach(Utils::$categorias as $categoria): ?>
                                <option value="<?php echo $categoria ?>"><?php echo $categoria ?></option>
                            <?php endforeach ?>
	            		</select>
	            	</div>
	          	</div>
	          	<!-- \Select para a categoria -->

	          	<!-- File para comprovante -->
	          	<div class="control-group">
	          		<?php echo Form::label('Comprovante', 'inscricao_comprovante', array('class' => 'control-label')); ?>
	            	<div class="controls">
	            		<input type="file" name="inscricao_comprovante" id="inscricao_comprovante" class="input-file input-xxlarge">
	        		</div>
	          	</div>
	          	<!-- \File para comprovante -->

	          	<!-- Observações -->
	          	<div class="control-group">
	          		<?php echo Form::label('Observação', 'inscricao_observacao', array('class' => 'control-label')); ?>
	            	<div class="controls">
	              		<textarea name="inscricao_observacao" id="inscricao_observacao" rows="5" class="input-xxlarge"></textarea>
	        		</div>
	          	</div>
	          	<!-- \Observações -->

	          	<div class="form-actions">
	            	<button type="submit" class="btn btn-primary">Enviar Pedido</button>
	            	<a href="<?php echo Uri::create('home'); ?>" class="btn btn-warning">Cancelar</a>
	          	</div>
	        </fieldset>
		</form>
	</div>
	<!-- \Formulário de Inscrição -->
</div>