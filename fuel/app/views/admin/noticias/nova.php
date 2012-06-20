<div class="row">
    <div class="span12">
        <div class="page-header">
            <h1>Postar Notícia</h1>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="span12">
        <ul class="breadcrumb">
            <li>
                <?php echo Html::anchor('home', 'Home'); ?> <span class="divider">/</span>
            </li>
            <li>
                <?php echo Html::anchor('admin', 'Administração'); ?> <span class="divider">/</span>
            </li>
            <li class="active">Nova Notícia</li>
        </ul>
    </div>
    <!--\Breadcrumb -->

    <!-- Formulário de Inserção -->
    <div class="span12">
        <form action="<?php echo Uri::create('admin/noticias/nova') ?>" id="nova_noticia_form" class="form well" method="POST">
            <fieldset>
                <div class="control-group">
                    <div class="control-label">
                        <label for="noticia_titulo">Título</label>
                    </div>
                    <div class="controls">
                        <input type="text" rel="popover" title="Título" data-content="Insira um título para a notícia." data-placement="top" id="noticia_titulo" name="noticia_titulo" class="input-xxlarge span8">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <textarea name="noticia_conteudo" id="noticia_conteudo" rows="10" class="span12 redactor_content"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button class="btn btn-success pull-right"><i class="icon-file icon-white"></i> Postar</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <!--\Formlário de Inserção -->

</div>