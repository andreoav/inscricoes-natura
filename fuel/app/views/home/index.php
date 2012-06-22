<div class="row">
    <div class="span12">
        <div class="page-header"><h1>Meu Painel</h1></div>
    </div>

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

    <section id="lastNewsSection">
        <div class="span8">
            <table class="table" id="lastNews">
                <thead>
                    <tr>
                        <th><h2>Últimas Notícias</h2></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($noticias as $noticia): ?>
                        <tr>
                            <td>
                                <?php echo  '<span class="label label-info">' . Date::forge($noticia->created_at)->format('%d/%m às %H:%I') . '</span> &raquo; ' . $noticia->titulo; ?>
                                <?php echo Html::anchor('noticias/' . $noticia->id, 'Leia mais &raquo;', array('class' => 'btn btn-mini btn-info pull-right hide', 'rel' => 'tooltip', 'title' => 'Leia a notícia completa.')); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

</div>
<?php echo View::forge('shared/minhas_inscricoes'); ?>