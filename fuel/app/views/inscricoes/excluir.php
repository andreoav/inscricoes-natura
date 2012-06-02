<div class="row">
	<div class="span12">
		<div class="page-header">
			<h1>Excluir Inscrição <small>Confirme a operação</small></h1>
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
			<li class="active">Excluir Inscrição</li>
		</ul>
	</div>
	<!-- Fim Breadcrumb -->
	<div class="span12">
		<div class="alert alert-error fade in">
        	<strong>Atenção!</strong> A operação que você está prestes a fazer é irreversível.
      	</div>
      	<form action="<?php echo Uri::create('inscricoes/excluir/' . $inscricao_info->id); ?>" class="form form-inline" method="POST">
      		<?php echo Html::anchor('inscricoes/visualizar/' . $inscricao_info->id, 'Cancelar', array('class' => 'btn')); ?>
      		<button class="btn btn-danger" type="submit">Excluir</button>
      	</form>
	</div>
</div>