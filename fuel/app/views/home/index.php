<?php echo View::forge('template/topbar', array('tPage' => 'Meu Painel', 'icon' => 'icon-screen')); ?>

<div class="breadLine">
    <?php echo Utils::criarBreadcrumb(Uri::segments()); ?>
    <?php echo View::forge('shared/breadcrumbs/inscricoes_status'); ?>
</div>

<!-- Main content -->
<div class="wrapper">
    <?php echo View::forge('flash'); ?>

    <!-- First row -->
    <div class="fluid">

        <!-- LAST NEWS -->
        <div class="widget grid6">
            <?php echo View::forge('shared/ultimas_noticias'); ?>
        </div>
        <!-- END LAST NEWS -->

        <!-- CONTATO -->
        <div class="widget grid6">
            <div class="whead">
                <h6>Fale Conosco</h6>
                <div class="clear"></div>
            </div>
            <div class="body">
                <div class="messageTo">
                    <a class="uName" title="" href="#"></a><span> Envie uma mensagem para <strong>Natura CO</strong></span>
                    <a class="uEmail" title="" href="#">natura@naturaco.org</a>
                </div>
                <textarea placeholder="Escreva a sua mensagem" class="auto" name="textarea" cols="" rows="5" ></textarea>
                <div class="mesControls">
                    <span><span data-icon="&#xe20d;" class="iconb"></span><a title="" href="#">HTML</a> básico habilitado</span>

                    <div class="sendBtn sendwidget">
                        <button type="submit" class="buttonM bLightBlue" id="btnEnviar"><i class="icol-arrowright"></i>&nbsp; Enviar</button>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <!-- FIM CONTATO -->

    </div>
    <!-- END FIRST ROW -->
    <?php echo View::forge('shared/minhas_inscricoes'); ?>
</div>