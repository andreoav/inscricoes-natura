<?php echo View::forge('template/topbar', array('tPage' => 'Nova Inscrição', 'icon' => 'icon-screen')); ?>
<div class="breadLine">
    <?php echo Utils::criarBreadcrumb(Uri::segments()); ?>
    <?php echo View::forge('shared/breadcrumbs/inscricoes_status'); ?>
</div>

<div class="wrapper">
    <?php echo View::forge('flash'); ?>

    <form action="<?php echo Uri::create('inscricoes/nova'); ?>" class="main" id="nova_inscricao_form" method="POST" enctype="multipart/form-data">
        <fieldset>
            <div class="fluid">
                <div class="widget grid6">
                    <div class="whead"><h6>Formulário de Inscrição</h6><div class="clear"></div></div>

                    <!-- ETAPA -->
                    <div class="formRow">
                        <div class="grid3"><label for="inscricao_etapa">Etapa:</label></div>
                        <div class="grid9 searchDrop">
                            <select data-placeholder="Selecione uma etapa..." name="inscricao_etapa" id="inscricao_etapa" class="fullwidth select">
                                <option value=""></option>
                                <?php echo Utils::etapasOptGroup($etapas) ?>
                            </select>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <!-- /ETAPA -->

                    <!-- CATEGORIA -->
                    <div class="formRow">
                        <div class="grid3"><label for="inscricao_categoria">Categoria:</label></div>
                        <div class="grid9 searchDrop">
                            <select data-placeholder="Selecione um categoria..." name="inscricao_categoria" id="inscricao_categoria" class="fullwidth select">
                                <option value=""></option>
                                <?php foreach(Utils::$categorias as $categoria): ?>
                                    <option value="<?php echo $categoria ?>"><?php echo $categoria ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <!-- /CATEGORIA -->

                    <div class="formRow">
                        <div class="grid3"><label for="inscricao_comprovante">Comprovante:</label></div>
                        <div class="grid9">
                            <input type="file" name="inscricao_comprovante" id="inscricao_comprovante" class="fileInput">
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label for="inscricao_observacao">Observação:</label></div>
                        <div class="grid9">
                            <textarea name="inscricao_observacao" id="inscricao_observacao" cols="" rows="8" class="auto"></textarea>
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow">
                        <input class="buttonM formSubmit bBlue" type="submit" value="Enviar &raquo;">
                        <div class="clear"></div>
                    </div>
                </div>

                <div class="widget grid6" id="informacao_etapa_container">
                    <div class="whead">
                        <h6>Informações da Etapa</h6>
                        <div class="clear"></div>
                    </div>
                    <div class="body" id="informacao_etapa">
                        <div class="clear"></div>
                    </div>
                </div>

            </div>
        </fieldset>
    </form>
</div>