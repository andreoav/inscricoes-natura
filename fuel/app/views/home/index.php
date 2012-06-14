<section id="sistemaHome">
    <div class="row">
        <div class="span12">
            <div class="page-header"><h1>Meu Painel</h1></div>
        </div>
    </div>

    <div class="row">
        <aside id="sistemaNavegacao">
            <div class="span4">
                <nav style="padding: 8px 0;" class="well">
                    <ul class="nav nav-list" id="navegacao">
                        <li class="nav-header">Navegação</li>
                        <li class="active">
                            <a href="<?php echo Uri::create('home'); ?>"><i class="icon-white icon-home"></i> Início</a>
                        </li>
                        <li>
                            <a href="<?php echo Uri::create('noticias'); ?>"><i class="icon-bullhorn"></i> Notícias</a>
                        </li>
                        <li>
                            <a href="<?php echo Uri::create('etapas'); ?>"><i class="icon-calendar"></i> Etapas</a>
                        </li>
                        <li>
                            <a href="<?php echo Uri::create('inscricoes/nova'); ?>"><i class="icon-plus"></i> Nova Inscrição</a>
                        </li>
                        <?php if (Sentry::user()->is_admin()): ?>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo Uri::create('admin/painel'); ?>"><i class="icon-wrench"></i> Administração</a>
                            </li>
                        <?php endif ?>

                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo Uri::create('usuario/perfil'); ?>"><i class="icon-user"></i> Perfil</a>
                        </li>
                        <li>
                            <a href="<?php echo Uri::create('logout'); ?>"><i class="icon-off"></i> Sair</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <section id="news">
            <div class="span8">
                <h2>Notícias</h2><hr>
                <div id="newsCarousel" class="carousel slide">
                    <div class="carousel-inner">
                        <?php $i = 0; foreach ($noticias as $noticia): ?>
                            <div class="item <?php echo $i == 0 ? 'active' : '' ?>">
                                <p class="lead"><?php echo $noticia->titulo; ?></p>
                                <?php echo preg_replace("/<img[^>]+\>/i", "", Str::truncate($noticia->conteudo, 500, '...', false)); ?>
                                <p>
                                    <br><a href="<?php echo Uri::create('noticias/' . $noticia->id) ?>" id="btnLeiaMais" class="btn btn-small btn-info" rel="tooltip" title="Ler notícia completa">Leia mais &raquo;</a>
                                </p>
                                <p class="pull-right">
                                    <span class="label label-info"><?php echo Sentry::user((int) $noticia->user->id)->get('metadata.nome'); ?></span>
                                    <span class="label label-info"><?php echo Date::forge($noticia->created_at)->format('%d/%m/%Y às %H:%S:%I'); ?></span>
                                </p>
                            </div>
                        <?php $i++; endforeach; ?>
                    </div>

                </div>
            </div>
        </section>

    </div>
    <?php echo View::forge('shared/minhas_inscricoes'); ?>
</section>