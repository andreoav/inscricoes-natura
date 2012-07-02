<?php echo View::forge('template/topbar', array('tPage' => 'Meu Painel', 'icon' => 'icon-screen')); ?>
<div class="breadLine">
    <?php echo Utils::criarBreadcrumb(Uri::segments()); ?>
    <?php echo View::forge('shared/breadcrumbs/inscricoes_status'); ?>
</div>

<div class="wrapper">
    <?php echo View::forge('flash'); ?>
    <div class="fluid">
        <div class="widget">
            <?php echo View::forge('shared/ultimas_noticias'); ?>
        </div>
    </div>

    <div class="grid12">
        <div class="wButton">
            <button class="buttonL bBlue first" disabled="disabled">Carregar Mais</button>
        </div>
    </div>
</div>