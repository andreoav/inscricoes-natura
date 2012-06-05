<section id="sistemaHome">
    <div class="row">
        <div class="span12">
            <div class="page-header"><h1>Meu Painel</h1></div>
        </div>
    </div>
    <div class="row">
        <div class="span4">
            <div style="padding: 8px 0;" class="well">
                <ul class="nav nav-list">
                    <li class="nav-header">Navegação</li>
                    <li class="active">
                        <a href="<?php echo Uri::create('/'); ?>"><i class="icon-white icon-home"></i> Início</a>
                    </li>
                    <li>
                        <a href="<?php echo Uri::create('inscricoes/nova'); ?>"><i class="icon-plus"></i> Nova Inscrição</a>
                    </li>
                    <li>
                        <a href="<?php echo Uri::create('etapas'); ?>"><i class="icon-calendar"></i> Etapas</a>
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
              </div>
        </div>
        <div class="span8">
            <div id="myCarousel" class="carousel slide">
                <!-- Carousel items -->
                <div class="carousel-inner">
                    <div class="item active">
                        <?php echo Asset::img('nature1.jpg'); ?>
                        <div class="carousel-caption">
                            <h4>First Thumbnail label</h4>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        </div>
                    </div>
                    <div class="item">
                        <?php echo Asset::img('nature2.jpg'); ?>
                        <div class="carousel-caption">
                            <h4>First Thumbnail label</h4>
                            <p>Cras justo odio, <a href="#">dapibus</a> ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        </div>
                    </div>
                </div>
                <!-- Carousel nav -->
                <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
            </div>
        </div>
    </div>
    <?php echo View::forge('shared/minhas_inscricoes'); ?>
</section>