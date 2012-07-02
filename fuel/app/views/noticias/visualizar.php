<?php echo View::forge('template/topbar', array('tPage' => 'Notícias', 'icon' => 'icon-screen')); ?>
<div class="breadLine">
    <?php echo Utils::criarBreadcrumb(Uri::segments()); ?>
    <?php echo View::forge('shared/breadcrumbs/inscricoes_status'); ?>
</div>

<div class="wrapper">
    <?php echo View::forge('flash'); ?>
    <div class="fluid">
        <div class="widget">
            <div class="whead">
                <h6><?php echo $noticia['titulo']; ?></h6>
                <a class="dataNumBlue" href="#"><?php echo Sentry::user((int) $noticia['user_id'])->get('metadata.nome'); ?></a>
                <a class="dataNumBlue" href="#"><?php echo Date::forge($noticia['created_at'])->format('%d/%m/%Y às %H:%M:%S'); ?></a>
                <div class="clear"></div>
            </div>
            <div class="body">
                <?php echo $noticia['conteudo']; ?>
            </div>
        </div>
    </div>
</div>