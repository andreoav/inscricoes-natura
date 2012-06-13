<div class="row">
	<div class="span12">
		<div class="page-header">
			<h1>Visualizar Inscrição</h1>
		</div>
	</div>

	<div class="span12">
		<ul class="breadcrumb">
			<li>
				<?php echo Html::anchor('home', 'Home'); ?> <span class="divider">/</span>
			</li>
			<li>
				<?php echo Html::anchor('inscricoes', 'Inscrições'); ?> <span class="divider">/</span>
			</li>
			<li class="active">Visualizar</li>
		</ul>
	</div>

	<div class="span9">
		<h3>Informações da Inscrição</h3><br />
		<p>
			<strong>ID:</strong>
			<?php echo $inscricao_info->id; ?></p>
		<p>
			<strong>Etapa:</strong>
			<?php echo \Html::anchor('etapas/visualizar/' . $inscricao_info->etapa->id, $inscricao_info->etapa->nome, array('rel' => 'popover', 'title' => 'Informações',
				'data-content' => '<ul><li>Início: ' . Date::forge($inscricao_info->etapa->data_inicio)->format('%d/%m/%Y') . '</li><li>Fim: ' . Date::forge($inscricao_info->etapa->data_final)->format('%d/%m/%Y') . '</li><li>Inscrições até: ' . Date::forge($inscricao_info->etapa->inscricao_ate)->format('%d/%m/%Y') . '</li></ul>'
			)); ?>
		</p>
		<p>
			<strong>Campeonato:</strong>
			<?php echo $inscricao_info->etapa->campeonato->nome; ?>
		</p>
		<p>
			<strong>Realizada em:</strong>
			<?php echo Date::forge($inscricao_info->created_at)->format('%d/%m/%Y %H:%M:%S'); ?>
		</p>
		<p>
			<strong>Status:</strong>
			<?php echo Utils::status2label($inscricao_info->status); ?>
		</p>
		<?php if($inscricao_info->observacao): ?>
			<p>
				<strong>Observações:</strong>
				<?php echo $inscricao_info->observacao; ?></p>
		<?php endif; ?>
		<p>
			<strong>Comprovante:</strong>
			<ul class="thumbnails">
				<li class="span4">
					<?php if (Utils::isImage(Arr::get(File::file_info(Asset::instance()->find_file($inscricao_info->comprovante, 'img')), 'mimetype'))): ?>
						<p>
							<a class="thumbnail" href="<?php echo Asset::get_file($inscricao_info->comprovante, 'img'); ?>">
								<?php echo Asset::img($inscricao_info->comprovante, array('height' => 400)); ?>
							</a>
						</p>
					<?php else: ?>
						<p><a href="<?php echo Uri::create('inscricoes/download_comprovante/' . $inscricao_info->id); ?>" target="_blank"><?php echo Asset::img(Utils::get_mimeTypeIcon(Arr::get(File::file_info(Asset::instance()->find_file($inscricao_info->comprovante, 'img')), 'mimetype'))); ?></a></p>
					<?php endif ?>
				</li>
			</ul>
		</p>	
	</div>

	<!-- Inicio Actions -->
	<div class="span3">
		<div class="btn-toolbar pull-right">
			<div class="btn-group">
				<?php echo Html::anchor('#excluirInscricaoD', '<i class="icon-trash"></i>', array('class' => 'btn btn-large', 'rel' => 'tooltip', 'title' => 'Excluir Inscrição', 'data-toggle' => 'modal')); ?>
				<?php echo Html::anchor('inscricoes/download_comprovante/' . $inscricao_info->id, '<i class="icon-download-alt"></i>', array('class' => 'btn btn-large', 'rel' => 'tooltip', 'title' => 'Salvar Arquivo', 'target' => '_blank')); ?>
				<?php if (Sentry::user()->is_admin()): ?>
					<?php echo Html::anchor('admin/inscricoes/aprovar/'  . $inscricao_info->id, '<i class="icon-ok"></i>', array('class' => 'btn btn-large', 'rel' => 'tooltip', 'title' => 'Aprovar Inscrição')); ?>
					<?php echo Html::anchor('admin/inscricoes/rejeitar/' . $inscricao_info->id, '<i class="icon-remove"></i>', array('class' => 'btn btn-large', 'rel' => 'tooltip', 'title' => 'Rejeitar Inscrição')); ?>
				<?php endif ?>
			</div>
		</div>
		<p>
			
		</p>
	</div>
	<!-- Fim Actions -->
</div>

<!-- Inicio Respostas -->
<div class="row">
	<div class="span12">
		<div class="page-header">
			<h1>Respostas</h1>
		</div>
	</div>
	<?php $i = 0 ; foreach($inscricao_info->respostas as $resposta): ?>
		<div class="span12">
			<blockquote class="<?php echo ($i % 2) == 0 ? 'pull-left' : 'pull-right'; ?>">
				<?php echo $resposta->conteudo; ?>
				<small>Postado por <strong><?php echo Sentry::user((int)$resposta->user->id)->get('metadata.nome'); ?></strong> em <?php echo Date::forge($resposta->created_at)->format('%d/%m/%Y %H:%M:%S'); ?></small>
			</blockquote>
		</div>
	<?php $i++; endforeach; ?>
</div>
<div class="row">
	<div class="span12">
		<form action="<?php echo Uri::create('inscricoes/responder/' . $inscricao_info->id); ?>" id="inscricao_resposta_form" class="form" method="POST">
			<fieldset>
				<div class="control-group">
					<div class="controls">
						<textarea name="inscricao_resposta" id="inscricao_resposta" rows="5" class="input span12"></textarea>
						<button class="btn btn-primary pull-right" type="submit"><i class="icon-comment icon-white"></i> Enviar</button>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
<!-- Fim Respostas -->

<!-- Modal de Exclusão -->
<div class="modal hide fade" id="excluirInscricaoD">
	<div class="modal-header">
		<button class="close" data-dismiss="modal">&times;</button>
		<h3>Excluir Inscrição</h3>
	</div>
	<form action="<?php echo Uri::create('inscricoes/excluir/' . $inscricao_info->id); ?>" class="modal-form" method="POST">
		<div class="modal-body modal-form alert alert-error fade in">
			<strong>Atenção!</strong> A operação que você está prestes a fazer é irreversível.
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
			<button type="submit" class="btn btn-danger">Excluir</button>
		</div>
	</form>
</div>
<!-- Fim modal de exclusão -->