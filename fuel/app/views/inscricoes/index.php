<?php echo View::forge('template/topbar', array('tPage' => 'Meu Painel', 'icon' => 'icon-screen')); ?>
<div class="breadLine">
    <?php echo Utils::criarBreadcrumb(Uri::segments()); ?>
    <?php echo View::forge('shared/breadcrumbs/inscricoes_status'); ?>
</div>

<div class="wrapper">
    <?php echo View::forge('flash'); ?>
    <?php echo View::forge('shared/minhas_inscricoes'); ?>
</div>