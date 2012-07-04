<?php echo View::forge('template/topbar', array('tPage' => 'Administração', 'icon' => 'icon-screen')); ?>

<div class="breadLine">
    <?php echo Utils::criarBreadcrumb(Uri::segments()); ?>
    <?php echo View::forge('shared/breadcrumbs/inscricoes_status'); ?>
</div>

<!-- Main content -->
<div class="wrapper">
    <?php echo View::forge('flash'); ?>

    <div class="fluid">

        <?php echo Form::open(array('action' => 'admin/campeonatos/novo', 'id' => 'novo_campeonato_form')); ?>
            <fieldset>
                <div class="widget">
                    <div class="whead">
                        <h6>Cadastrar Campeonato</h6>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label for="campeonato_nome">Nome:</label></div>
                        <div class="grid9">
                            <input class="fullwidth" type="text" name="campeonato_nome" id="campeonato_nome">
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow">
                        <input class="buttonM formSubmit bBlue" type="submit" value="Cadastrar &raquo;">
                        <div class="clear"></div>
                    </div>

                </div>
            </fieldset>
        <?php echo Form::close(); ?>
    </div>
</div>