<div class="row">
    <div class="span12">
        <div class="page-header">
            <h1>Inscrições <small>Painel de Administração</small></h1>
        </div>
    </div>

    <!-- Início Breadcrumb -->
    <div class="span12">
        <ul class="breadcrumb">
            <li>
                <?php echo Html::anchor('home', 'Home'); ?> <span class="divider">/</span>
            </li>
            <li>
                <?php echo Html::anchor('admin', 'Administração'); ?> <span class="divider">/</span>
            </li>
            <li class="active">Inscrições</li>
        </ul>
    </div>
    <!-- Fim Breadcrumb -->

    <div class="span12">
        <div class="page-header">
            <h1>Outras Inscrições</h1>
        </div>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="admin_inscricoes_todas">
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