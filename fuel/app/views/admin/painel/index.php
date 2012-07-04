<?php echo View::forge('template/topbar', array('tPage' => 'Administração', 'icon' => 'icon-screen')); ?>

<div class="breadLine">
    <?php echo Utils::criarBreadcrumb(Uri::segments()); ?>
    <?php echo View::forge('shared/breadcrumbs/inscricoes_status'); ?>
</div>

<!-- Main content -->
<div class="wrapper">
    <?php echo View::forge('flash'); ?>

    <div class="fluid">

        <div class="widget grid4">
            <div class="whead">
                <h6>Estatísticas do Sistema</h6>
                <div class="clear"></div>
            </div>
            <table cellpadding="0" cellspacing="0" width="100%" class="tAlt">
                <thead>
                    <tr>
                        <td width="60">Quantidade</td>
                        <td>Tipo</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td align="center"><a href="#" title="" class="webStatsLink"><?php echo Model_User::count(); ?></a></td>
                        <td>Usuários cadastrados</td>
                    </tr>
                    <tr>
                        <td align="center"><a href="#" title="" class="webStatsLink"><?php echo Model_Etapa::count(); ?></a></td>
                        <td>Etapas cadastradas</td>
                    </tr>
                    <tr>
                        <td align="center"><a href="#" title="" class="webStatsLink"><?php echo Model_Inscricao::count(); ?></a></td>
                        <td>Inscrições realizadas</td>
                    </tr>
                    <tr>
                        <td align="center"><a href="#" title="" class="webStatsLink"><?php echo Model_Inscricao::count(array('where' => array('status' => Model_Inscricao::INSCRICAO_ACEITA))); ?></a></td>
                        <td>Inscrições aprovadas</td>
                    </tr>
                    <tr>
                        <td align="center"><a href="#" title="" class="webStatsLink"><?php echo Model_Inscricao::count(array('where' => array('status' => Model_Inscricao::INSCRICAO_PENDENTE))); ?></a></td>
                        <td>Inscrições pendentes</td>
                    </tr>
                    <tr>
                        <td align="center"><a href="#" title="" class="webStatsLink"><?php echo Model_Inscricao::count(array('where' => array('status' => Model_Inscricao::INSCRICAO_REJEITADA))); ?></a></td>
                        <td>Inscrições rejeitadas</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="widget grid8">
            <div class="whead">
                <h6>Gráfico</h6>
                <div class="clear"></div>
            </div>
        </div>

    </div>

    <!--
        Inscrições Pendentes
    -->
    <div class="widget grid12">
        <div class="whead"><h6>Inscrições Pendentes</h6><div class="clear"></div></div>
        <div id="dyn" class="hiddenpars">
            <a class="tOptions tipS" title="Opções"><?php echo Casset::img('aquincum::icons/options.png'); ?></a>
            <table id="admin_inscricoes_pendentes">
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
    <!--
        Fim das Inscrições Pendentes
    -->

</div>