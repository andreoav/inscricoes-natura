<?php echo View::forge('template/topbar', array('tPage' => 'Administração', 'icon' => 'icon-screen')); ?>

<div class="breadLine">
    <?php echo Utils::criarBreadcrumb(Uri::segments()); ?>
    <?php echo View::forge('shared/breadcrumbs/inscricoes_status'); ?>
</div>

<!-- Main content -->
<div class="wrapper">
    <?php echo View::forge('flash'); ?>

    <div class="fluid">

        <?php echo Form::open(array('action' => 'admin/noticias/nova', 'id' => 'nova_noticia_form')); ?>
        <fieldset>
            <div class="widget">
                <div class="whead">
                    <h6>Inserir Notícia</h6>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <div class="grid3"><label for="noticia_titulo">Título:</label></div>
                    <div class="grid9">
                        <input class="fullwidth" type="text" name="noticia_titulo" id="noticia_titulo">
                    </div>
                    <div class="clear"></div>
                </div>

            </div>

            <div class="widget">
                <div class="whead">
                    <h6>Conteúdo</h6>
                    <div class="clear"></div>
                </div>
                <textarea name="noticia_conteudo" id="noticia_conteudo" class="wysiwyg" cols="16"></textarea>
            </div>
        </fieldset>

        <br />
        <div class="wbutton">
            <input type="submit" value="Enviar" class="buttonL bBlue first">
        </div>

        <?php echo Form::close(); ?>
    </div>
</div>