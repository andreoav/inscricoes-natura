<div class="row">
    <div class="span12">
        <div class="page-header"><h1>Administração do Sistema</h1></div>
    </div>
</div>
<div class="row">
    <div class="span4">
        <div style="padding: 8px 0;" class="well">
            <ul class="nav nav-list">
                <li class="nav-header">Navegação</li>
                <li class="active">
                    <a href="<?php echo Uri::create('home'); ?>"><i class="icon-white icon-home"></i> Início</a>
                </li>
                <li>
                    <a href="<?php echo Uri::create('admin/email'); ?>"><i class="icon-envelope"></i> Email</a>
                </li>
                <li>
                    <a href="<?php echo Uri::create('usuario/atletas'); ?>"><i class="icon-user"></i> Atletas</a>
                </li>
                <li>
                    <a href="<?php echo Uri::create('admin/etapas'); ?>"><i class="icon-calendar"></i> Etapas</a>
                </li>
                <li>
                    <a href="<?php echo Uri::create('admin/inscricoes'); ?>"><i class="icon-list-alt"></i> Inscrições</a>
                </li>

                <li class="divider"></li>
                <li>
                    <a href="<?php echo Uri::create('admin/noticias/nova'); ?>"><i class="icon-plus"></i> Inserir Notícia</a>
                </li>
                <li>
                    <a href="<?php echo Uri::create('admin/etapas/nova'); ?>"><i class="icon-plus"></i> Cadastrar Etapa</a>
                </li>
                <li>
                    <a href="<?php echo Uri::create('admin/campeonatos/novo'); ?>"><i class="icon-plus"></i> Cadastrar Campeonato</a>
                </li>

                <li class="divider"></li>
                <li>
                    <a href="<?php echo Uri::create('#'); ?>"><i class="icon-cog"></i> Configurações</a>
                </li>
                <li>
                    <a href="<?php echo Uri::create('logout'); ?>"><i class="icon-off"></i> Sair</a>
                </li>
            </ul>
          </div>
    </div>

    <div class="span4">
        <h3>Estatísticas do Sistema</h3>
        <p>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td class="center"><span class="badge badge-info"><?php echo Model_User::count(); ?></span></td>
                        <th>Atletas Cadastrados</th>
                    </tr>
                    <tr>
                        <td class="center"><span class="badge badge-info"><?php echo Model_Etapa::count(); ?></span></td>
                        <th>Etapas Cadastradas</th>
                    </tr>
                    <tr>
                        <td class="center"><span class="badge badge-success"><?php echo Model_Inscricao::count(array('where' => array('status' => Model_Inscricao::INSCRICAO_ACEITA))); ?></span></td>
                        <th>Inscrições já realizadas</th>
                    </tr>
                    <tr>
                        <td class="center"><span class="badge badge-warning"><?php echo Model_Inscricao::count(array('where' => array('status' => Model_Inscricao::INSCRICAO_PENDENTE))); ?></span></td>
                        <th>Inscrições Pendentes</th>
                    </tr>
                </tbody>
          </table>
        </p>
    </div>
</div>

<div class="row">
    <div class="span12">
        <div class="page-header">
            <h1>Inscrições Pendentes</h1>
        </div>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="admin_inscricoes_pendentes">
            <thead>
            <tr>
                <th>Nº</th>
                <th>Atleta</th>
                <th>Etapa</th>
                <th>Campeonato</th>
                <th>Status</th>
                <th>A&ccedil;&otilde;es</th>
            </tr>
            </thead>
        </table>
    </div>
</div>