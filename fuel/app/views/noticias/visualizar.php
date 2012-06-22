<article id="noticiaVisualizar">
	<div class="row">
		<div class="span12">
			<div class="page-header">
				<h1><?php echo $noticia_info->titulo; ?></h1>
			</div>
		</div>

		<div class="span12">
			<ul class="breadcrumb">
				<li>
					<?php echo Html::anchor('home', 'Home'); ?> <span class="divider">/</span>
				</li>
				<li>
					<?php echo Html::anchor('noticias', 'Notícias'); ?> <span class="divider">/</span>
				</li>
				<li class="active"><?php echo $noticia_info->titulo; ?></li>
			</ul>
		</div>

		<div class="span<?php echo Sentry::user()->is_admin() ? '10' : '12'; ?>" id="noticiaContent">
			<?php echo $noticia_info->conteudo; ?>
		</div>

        <!-- Inicio Actions -->
        <?php if (Sentry::user()->is_admin()): ?>
            <div class="span2" id="toolbar-actions">
                <div class="btn-toolbar pull-right">
                    <div class="btn-group">
                        <a href="<?php echo Uri::create('admin/noticias/editar/' . $noticia_info->id) ?>" class="btn btn-large" rel="tooltip" title="Editar"><i class="icon-pencil"></i></a>
                        <a href="<?php echo Uri::create('admin/noticias/excluir/' . $noticia_info->id) ?>" class="btn btn-large" rel="tooltip" title="Excluir"><i class="icon-trash"></i></a>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <!-- Fim Actions -->

		<div class="span12">
			<p class="pull-right">
				<span class="label label-info"><?php echo Sentry::user((int) $noticia_info->user_id)->get('metadata.nome'); ?></span>
                <span class="label label-info"><?php echo Date::forge($noticia_info->created_at)->format('%d/%m/%Y às %H:%M:%S'); ?></span>
			</p>
		</div>
	</div>
</article>