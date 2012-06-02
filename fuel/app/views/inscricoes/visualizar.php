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

	<div class="span8">
		<dl class="dl-horizontal">
			<dt>ID</dt><dd><?php echo $inscricao_info->id; ?></dd>
			<dt>Etapa</dt><dd><?php echo \Html::anchor('etapas/visualizar/' . $inscricao_info->etapa->id, $inscricao_info->etapa->nome); ?></dd>
			<dt>Campeonato</dt><dd><?php echo $inscricao_info->etapa->campeonato->nome; ?></dd>
			<dt>Realizada em</dt><dd><?php echo Date::forge($inscricao_info->created_at)->format('%d/%m/%Y %H:%M:%S'); ?></dd>
			<dt>Status</dt><dd><?php echo Utils::status2label($inscricao_info->status); ?></dd>
			<?php if($inscricao_info->observacao): ?>
				<dt>Observações</dt><dd><?php echo $inscricao_info->observacao; ?></dd>
			<?php endif; ?>
			<dt></dt><dd>&nbsp;</dd>
			<dt>Comprovante</dt>
			<dd>
				<ul class="thumbnails">
			        <li class="span4">
			          	<a class="thumbnail" href="<?php echo Asset::get_file(Utils::getComprovanteSegments($inscricao_info->comprovante), 'img', Utils::getComprovanteSegments($inscricao_info->comprovante, false)); ?>">
				            <?php echo Asset::img($inscricao_info->comprovante, array('height' => 400)); ?>
			          	</a><br />
			          	<a href="<?php echo Uri::create('inscricoes/download_comprovante/' . $inscricao_info->id); ?>" target="_blank" class="btn btn-success"><i class="icon-download-alt icon-white"></i> Salvar Comprovante</a>
		    	    </li>
		      	</ul>
			</dd>
		</dl>
		<br />
	</div>

	<!-- Inicio Actions -->
	<div class="span4">
		<div class="btn-group pull-right">
			<a href="#" class="btn btn-large dropdown-toggle" data-toggle="dropdown">
				<i class="icon-cog"></i> Ações
				<span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
				<li><a href="#excluirInscricaoD" data-toggle="modal"><i class="icon-trash"></i> Excluir Inscrição</a></li>
				<?php if(Sentry::user()->is_admin()): ?>
					<li class="divider"></li>
					<li><?php echo Html::anchor('admin/inscricoes/aprovar/'  . $inscricao_info->id, '<i class="icon-ok"></i> Aprovar'); ?></li>
					<li><?php echo Html::anchor('admin/inscricoes/rejeitar/' . $inscricao_info->id, '<i class="icon-remove"></i> Rejeitar'); ?></li>
				<?php endif; ?>
			</ul>
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
		<h2>Insira uma resposta</h2>
		<form action="<?php echo Uri::create('inscricoes/responder/' . $inscricao_info->id); ?>" class="form form-dovalidation" method="POST">
        	<fieldset>
	          	<div class="control-group">
	            	<div class="controls">
	              		<textarea name="inscricao_resposta" id="inscricao_resposta" rows="5" class="input span12" data-validation-engine="validate[required]"></textarea>
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