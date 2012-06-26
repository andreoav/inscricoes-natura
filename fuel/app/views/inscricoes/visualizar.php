<div class="row" xmlns="http://www.w3.org/1999/html">
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
            <?php if(Sentry::user()->is_admin()): ?>
                <li>
                    <?php echo Html::anchor('admin/inscricoes', 'Inscrições'); ?> <span class="divider">/</span>
                </li>
            <?php else: ?>
                <li>
                    <?php echo Html::anchor('inscricoes', 'Inscrições'); ?> <span class="divider">/</span>
                </li>
            <?php endif; ?>
			<li class="active">Visualizar</li>
		</ul>
	</div>

	<div class="span9">
		<p>
			<strong>ID:</strong>
			<?php echo $inscricao_info->id; ?>
        </p>
		<p>
			<strong>Etapa:</strong>
			<?php echo \Html::anchor('etapas/visualizar/' . $inscricao_info->etapa->id, $inscricao_info->etapa->nome, array(
                'rel' => 'popover',
                'title' => 'Informações',
                'data-content' => Utils::etapaPopover($inscricao_info->etapa)
            )); ?>
		</p>
		<p>
			<strong>Campeonato:</strong>
			<?php echo $inscricao_info->etapa->campeonato->nome; ?>
		</p>
        <p>
            <strong>Categoria:</strong>
            <?php echo $inscricao_info->categoria; ?>
        </p>
		<p>
			<strong>Realizada em:</strong>
			<?php echo Date::forge($inscricao_info->created_at)->format('%d/%m/%Y %H:%M:%S'); ?>
		</p>
        <p>
            <strong>Atleta:</strong>
            <?php echo Sentry::user((int) $inscricao_info->user->id)->get('metadata.nome'); ?>
        </p>
		<p id="inscricaoStatus">
			<strong>Status:</strong>
			<?php echo Utils::status2label($inscricao_info->status); ?>
		</p>
		<?php if($inscricao_info->observacao): ?>
			<p>
				<strong>Observações:</strong>
				<?php echo $inscricao_info->observacao; ?>
            </p>
		<?php endif; ?>
        <p>
            <strong>Comprovante:</strong>
            <?php if (Utils::isImage(Arr::get(File::file_info(Asset::instance()->find_file($inscricao_info->comprovante, 'img')), 'mimetype'))): ?>
                <a class="comprovanteMiniatura" href="<?php echo Asset::get_file($inscricao_info->comprovante, 'img'); ?>" rel="tooltip" title="Visualizar Comprovante">
                    Visualizar comprovante
                </a>
            <?php else: ?>
                Use o menu ao lado para visualizar este comprovante.
            <?php endif ?>
        </p>
	</div>

	<!-- Inicio Actions -->
	<div class="span3">
		<div class="btn-toolbar pull-right">
			<div class="btn-group" id="inscricao_actions">
                <button class="btn btn-large" id="inscricaoExcluir" rel="tooltip" title="Excluir Inscrição" data-inscricao-id="<?php echo $inscricao_info->id; ?>"><i class="icon-trash"></i></button>
				<?php echo Html::anchor('inscricoes/download_comprovante/' . $inscricao_info->id, '<i class="icon-download-alt"></i>', array('class' => 'btn btn-large download', 'rel' => 'tooltip', 'title' => 'Salvar Comprovante', 'target' => '_blank')); ?>
				<?php if (Sentry::user()->is_admin()): ?>
                    <button <?php echo $inscricao_info->status == 1 ? 'disabled' : '' ?> class="btn btn-large updateBtn" data-inscricao-id="<?php echo $inscricao_info->id; ?>" data-update-type="aprovar" rel="tooltip" title="Aprovar Inscrição">
                        <i class="icon-ok"></i>
                    </button>
                    <button <?php echo $inscricao_info->status == 0 ? 'disabled' : '' ?> class="btn btn-large updateBtn" data-inscricao-id="<?php echo $inscricao_info->id; ?>" data-update-type="rejeitar" rel="tooltip" title="Rejeitar Inscrição">
                        <i class="icon-remove"></i>
                    </button>
				<?php endif ?>
			</div>
		</div>
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
    <?php foreach($inscricao_info->respostas as $resposta): ?>
        <div class="span12">
            <div class="well">
                <p>
                    <?php echo $resposta->conteudo; ?>
                    <span class="pull-right">
                        <small>
                            <i class="icon-user"></i> <?php echo Sentry::user((int)$resposta->user->id)->get('metadata.nome'); ?><br />
                            <i class="icon-time"></i> <?php echo Date::forge($resposta->created_at)->format('%d/%m/%Y às %H:%M:%S'); ?>
                        </small>
                    </span>
                </p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="row">
	<div class="span12">
		<form action="<?php echo Uri::create('inscricoes/responder/' . $inscricao_info->id); ?>" id="inscricao_resposta_form" class="form" method="POST">
			<fieldset>
				<div class="control-group">
					<div class="controls">
						<textarea name="inscricao_resposta" id="inscricao_resposta" rows="5" class="span12"></textarea>
					</div>
				</div>
                <div class="control-group">
                    <div class="controls">
                        <button class="btn btn-primary pull-right" type="submit"><i class="icon-comment icon-white"></i> Enviar</button>
                    </div>
                </div>
			</fieldset>
		</form>
	</div>
</div>
<!-- Fim Respostas -->