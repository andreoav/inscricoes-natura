<div class="row">
    <div class="span12">
        <div class="page-header">
            <h1>Notícias</h1>
        </div>
    </div>

    <article id="news">
        <div class="span12">
            <div class="row">
                <div class="span12" id="newsContainer">
                    <?php foreach($noticias as $noticia): ?>
                        <div class="row">
                            <div class="span1">
                                <?php echo '<span class="label label-info">Horario</span>'; ?>
                            </div>
                            <div class="span11">
                                <p class="lead">Titulo</p>
                                <p>Conteudo</p>
                            </div>
                        </div><hr>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="row" id="loadMoreContainer">
                <button id="<?php echo Arr::get(end($noticias), 'id'); ?>" class="btn btn-info btn-large span12 more" autocomplete="off" data-loading-text="Carregando, aguarde...">
                    Mais Notícias &raquo;
                </button>
            </div>
        </div>
    </article>
</div>