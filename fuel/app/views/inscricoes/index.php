<?php echo View::forge('template/topbar', array('tPage' => 'Meu Painel', 'icon' => 'icon-screen')); ?>
<?php echo Utils::criarBreadcrumb(Uri::segments()); ?>

<div class="wrapper">
    <?php echo View::forge('flash'); ?>
    <?php echo View::forge('shared/minhas_inscricoes'); ?>
</div>