<div class="row">
    <div class="span12">
        <div class="page-header">
            <h1>Minhas Inscrições</h1>
        </div>
    </div>
    <?php if (isset($breadcrumbs)): ?>
        <!-- Início Breadcrumb -->
        <div class="span12">
            <ul class="breadcrumb">
                <li>
                    <?php echo Html::anchor('home', 'Home'); ?> <span class="divider">/</span>
                </li>
                <li class="active">Inscrições</li>
            </ul>
        </div>
        <!-- Fim Breadcrumb -->
    <?php endif ?>
    <div class="span12">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="inscricoes_feitas">
            <thead>
                <tr>
                    <th>Nº</th>
                    <th>Etapa</th>
                    <th>Campeonato</th>
                    <th>Status</th>
                    <th>A&ccedil;&otilde;es</th>
                </tr>
            </thead>
        </table>
    </div><!--/span-->
</div><!--/row-->