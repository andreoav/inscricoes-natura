<div class="row">
	<div class="span12">
		<div class="page-header">
			<h1>Visualizar Etapa</h1>
		</div>
	</div>
	<div class="span12">
		<ul class="breadcrumb">
			<li>
				<?php echo Html::anchor('home', 'Home'); ?> <span class="divider">/</span>
			</li>
			<li>
				<?php echo Html::anchor('etapas', 'Etapas'); ?> <span class="divider">/</span>
			</li>
			<li class="active">Visualizar</li>
		</ul>
	</div>

	<div class="span12">
		<ul class="nav nav-tabs" id="etapaTab">
			<li class="active">
				<a href="#etapaInfo" data-toggle="tab">Informações</a>
			</li>
			<li class="">
				<a href="#etapaInscricaoNova" data-toggle="tab">Inscrição</a>
			</li>
		</ul>
	</div>
</div>

<div class="row">
	<div id="etapaTabContent" class="tab-content">
		<div id="etapaInfo" class="tab-pane fade active in">
			<div class="span8">
				<dl class="dl-horizontal">
					<dt>Nome:</dt><dd><?php echo $etapa_info->nome; ?></dd>
					<dt>Campeonato:</dt><dd><?php echo $etapa_info->campeonato->nome; ?></dd>
					<dt>Localidade:</dt><dd><?php echo $etapa_info->localidade; ?></dd>
					<dt>Início / Final:</dt><dd><?php echo Date::forge($etapa_info->data_inicio)->format('%d/%m/%Y'); ?> - <?php echo Date::forge($etapa_info->data_final)->format('%d/%m/%Y'); ?></dd>
					<dt>Inscrições até:</dt><dd><?php echo Date::forge($etapa_info->inscricao_ate)->format('%d/%m/%Y'); ?></dd>
				</dl>
			</div>
			<?php if (Sentry::user()->is_admin()): ?>
				<div class="span4">
				      <div style="margin-bottom: 9px" class="btn-toolbar pull-right">
				        <div class="btn-group">
				          	<a href="#" class="btn btn-large btn-info" rel="tooltip" title="Gerar Lista de Inscritos">
				          		<i class="icon-list-alt icon-white"></i>
				          	</a>
				          	<a href="#" class="btn btn-large btn-danger" rel="tooltip" title="Excluir Etapa">
				          		<i class="icon-trash icon-white"></i>
				          	</a>
				        </div>
				    </div>
			    </div>
			<?php endif ?>

			<div class="span10 offset1 map" id="localidade_map"></div>
		</div>
		<div id="etapaInscricaoNova" class="tab-pane fade">
			<?php if ($inscricoes_encerradas): ?>
				<div class="span12">
					<div class="alert alert-error fade in">
						<strong>Ops!</strong> As inscrições para esta etapa já estão encerradas.
					</div>
				</div>
			<?php elseif ($ja_inscrito): ?>
				<div class="span12">
					<div class="alert alert-info fade in">
						<strong>Você já está inscrito nesta etapa.</strong>
					</div>
				</div>
			<?php else: ?>
				<div class="span12">
					<form action="<?php echo Uri::create('inscricoes/nova/' . $etapa_info->id); ?>" class="form form-horizontal form-dovalidation" method="POST" enctype="multipart/form-data">
						<fieldset>
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
				          		<input type="hidden" name="etapa_id_verify" value="<?php echo $etapa_info->id; ?>">
				            	<button type="submit" class="btn btn-primary">Enviar Pedido</button>
				          	</div>
				        </fieldset>
					</form>
				</div>
			<?php endif ?>
		</div>
	</div>
</div>