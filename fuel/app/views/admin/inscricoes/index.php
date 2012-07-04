<?php echo View::forge('template/topbar', array('tPage' => 'Administração', 'icon' => 'icon-screen')); ?>

<div class="breadLine">
    <?php echo Utils::criarBreadcrumb(Uri::segments()); ?>
    <?php echo View::forge('shared/breadcrumbs/inscricoes_status'); ?>
</div>

<!-- Main content -->
<div class="wrapper">
    <?php echo View::forge('flash'); ?>

    <div class="widget">
        <div class="whead"><h6>Todas Inscrições</h6><div class="clear"></div></div>
        <div id="dyn" class="hiddenpars">
            <a class="tOptions tipS" title="Opções"><?php echo Casset::img('aquincum::icons/options'); ?></a>
            <table id="admin_inscricoes_todas">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Atleta</th>
                        <th>Etapa</th>
                        <th>Campeonato</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div class="clear"></div>
    </div>


</div>