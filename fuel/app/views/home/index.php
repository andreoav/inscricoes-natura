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
                    <a href="<?php echo Uri::create('etapas'); ?>"><i class="icon-list"></i> Etapas</a>
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
    <?php echo View::forge('shared/buscar_inscricao'); ?>
</div>
<?php echo View::forge('shared/minhas_inscricoes'); ?>