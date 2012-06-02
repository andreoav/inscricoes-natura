<div class="row">
    <div class="span12">
        <div class="page-header">
            <h1>Etapas</h1>
        </div>
    </div>
    <?php if (isset($breadcrumbs)): ?>
        <!-- Início Breadcrumb -->
        <div class="span12">
            <ul class="breadcrumb">
                <li>
                    <?php echo Html::anchor('home', 'Home'); ?> <span class="divider">/</span>
                </li>
                <?php if (Sentry::user()->is_admin()): ?>
                    <li>
                        <?php echo Html::anchor('admin', 'Administração'); ?> <span class="divider">/</span>
                    </li>
                <?php endif ?>
                <li class="active">Etapas</li>
            </ul>
        </div>
        <!-- Fim Breadcrumb -->
    <?php endif ?>
    <div class="span12">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="etapas_cadastradas">
            <thead>
                <tr>
                    <th>ID</th>    
                    <th>Nome</th>
                    <th>Campeonato</th>
                    <th>Localidade</th>
                    <th>Inscrições</th>
                    <th>A&ccedil;&otilde;es</th>
                </tr>
            </thead>
        </table>
    </div><!--/span-->
</div><!--/row-->