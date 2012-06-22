<div class="row">
    <div class="span12">
        <div class="page-header">
            <h1>Notícias <small>Fique por dentro das últimas novidades</small></h1>
        </div>
    </div>

    <article id="news">
        <div class="span12">
            <div class="row">
                <div class="span9" id="newsContainer">
                    <?php foreach($noticias as $noticia): ?>
                        <div class="row">
                            <div class="span1">
                                <span class="label label-info"><?php echo Date::forge($noticia['created_at'])->format('%d/%m %H:%M'); ?></span>
                            </div>
                            <div class="span8">
                                <p class="lead">Titulo</p>
                                <p>Conteudo</p>
                            </div>
                        </div><hr />
                    <?php endforeach; ?>
                </div>
                <div class="span3">
                    <div class="well" style="padding: 8px 0;">
                        <ul class="nav nav-list">
                            <li class="nav-header">Mais Lidas</li>
                            <li class="active"><a href="#"><i class="icon-white icon-home"></i> Home</a></li>
                            <li><a href="#"><i class="icon-book"></i> Library</a></li>
                            <li><a href="#"><i class="icon-pencil"></i> Applications</a></li>
                            <li class="nav-header">Another list header</li>
                            <li><a href="#"><i class="icon-user"></i> Profile</a></li>
                            <li><a href="#"><i class="icon-cog"></i> Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="icon-flag"></i> Help</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row" id="loadMoreContainer">
                <button id="<?php echo Arr::get(end($noticias), 'id'); ?>" class="btn btn-info btn-large span9 more" autocomplete="off" data-loading-text="Carregando, aguarde...">
                    Mais Notícias &raquo;
                </button>
            </div>
        </div>
    </article>
</div>