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

    <div class="fluid">
        <div class="grid2">
            <div class="wButton">
                <a class="buttonL bGreen first" href="#" id="noticias_carregar_mais">Carregar Mais</a>
            </div>
        </div>
    </div>

</div>