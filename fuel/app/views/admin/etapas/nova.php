<?php echo View::forge('template/topbar', array('tPage' => 'Administração', 'icon' => 'icon-screen')); ?>

<div class="breadLine">
    <?php echo Utils::criarBreadcrumb(Uri::segments()); ?>
    <?php echo View::forge('shared/breadcrumbs/inscricoes_status'); ?>
</div>

<!-- Main content -->
<div class="wrapper">
    <?php echo View::forge('flash'); ?>

    <div class="fluid">

        <?php echo Form::open(array('action' => 'admin/etapas/nova', 'id' => 'nova_etapa_form')); ?>
        <fieldset>
            <div class="widget grid8">
                <div class="whead">
                    <h6>Cadastrar Etapa</h6>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <div class="grid3"><label for="etapa_campeonato">Campeonato:</label></div>
                    <div class="grid9 searchDrop">
                        <select name="etapa_campeonato" id="etapa_campeonato" class="fullwidth select">
                            <?php foreach($campeonatos as $campeonato): ?>
                                <option value="<?php echo $campeonato->id; ?>"><?php echo $campeonato->nome; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <div class="grid3"><label for="etapa_nome">Nome:</label></div>
                    <div class="grid9">
                        <input type="text" id="etapa_nome" name="etapa_nome" class="fullwidth">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <div class="grid3"><label for="etapa_localidade">Localidade:</label></div>
                    <div class="grid9">
                        <input class="fullwidth" type="text" id="etapa_localidade" name="etapa_localidade">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <div class="grid3"><label for="etapa_inicio">Início?</label></div>
                    <div class="grid9">
                        <input class="datepicker" type="text" id="etapa_inicio" name="etapa_inicio">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <div class="grid3"><label for="etapa_final">Final:</label></div>
                    <div class="grid9">
                        <input class="datepicker" type="text" id="etapa_final" name="etapa_final">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <div class="grid3"><label for="etapa_inscricoes_ate">Inscrições Até:</label></div>
                    <div class="grid9">
                        <input class="datepicker" type="text" id="etapa_inscricoes_ate" name="etapa_inscricoes_ate">
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <input class="buttonM formSubmit bBlue" type="submit" value="Cadastrar &raquo;">
                    <div class="clear"></div>
                </div>
            </div>

            <div class="widget grid4">
                <div class="whead">
                    <h6>Arquivos da Etapa</h6>
                    <div class="clear"></div>
                </div>
                <div id="arquivos_upload"></div>
            </div>

        </fieldset>
        <?php echo Form::close(); ?>

    </div>
</div>