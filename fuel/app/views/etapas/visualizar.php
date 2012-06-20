<div class="row">
	<div class="span12">
		<div class="page-header">
			<h1>Visualizar Etapa</h1>
		</div>
	</div>
	<div class="span12">
		<ul class="breadcrumb">
			<li>
				<?php echo Html::anchor('home', 'Home'); ?> <span class="divider">/</span>
			</li>
			<li>
				<?php echo Html::anchor('etapas', 'Etapas'); ?> <span class="divider">/</span>
			</li>
			<li class="active">Visualizar</li>
		</ul>
	</div>
</div>

<div class="row">
    <article id="etapaInfo">
        <div class="span10">
            <p>
                <strong>Nome:</strong>
                <?php echo $etapa_info->nome; ?>
            </p>
            <p>
                <strong>Campeonato:</strong>
                <?php echo $etapa_info->campeonato->nome; ?>
            </p>
            <p>
                <strong>Localidade:</strong>
                <?php echo $etapa_info->localidade; ?>
            </p>
            <p>
                <strong>Inicio / Final:</strong>
                <?php echo Date::forge($etapa_info->data_inicio)->format('%d/%m/%Y'); ?> - <?php echo Date::forge($etapa_info->data_final)->format('%d/%m/%Y'); ?>
            </p>
            <p>
                <strong>Inscrições até:</strong>
                <?php echo Date::forge($etapa_info->inscricao_ate)->format('%d/%m/%Y'); ?>
            </p>
        </div>

        <!-- Toolbar -->
        <div class="span2">
            <div class="btn-toolbar pull-right">
                <div class="btn-group">
                    <a href="#" class="btn btn-large" data-toggle="collapse" data-target="#demo" title="Visualizar Mapa">
                        <i class="icon-map-marker"></i>
                    </a>
                    <?php if (Sentry::user()->is_admin()): ?>
                        <a href="#exportModal" class="btn btn-large" rel="tooltip" title="Gerar Lista de Inscritos" data-toggle="modal">
                            <i class="icon-list-alt"></i>
                        </a>
                        <a href="#" class="btn btn-large" rel="tooltip" title="Excluir Etapa">
                            <i class="icon-trash"></i>
                        </a>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <!-- Fim da toolbar -->

        <!-- Mapa da localidade -->
        <div id="demo" class="span12 collapse">
            <div class="map" id="localidade_map"></div>
        </div>
        <!-- Fim do mapa -->

        <div class="span12">
            <?php if (Session::get('profile_unfinished') == false): ?>
                <?php if ($inscricoes_encerradas): ?>
                    <div class="alert alert-error fade in">
                        <strong>Ops!</strong> As inscrições para esta etapa já estão encerradas.
                    </div>
                <?php elseif ($ja_inscrito): ?>
                    <div class="alert alert-info fade in">
                        <strong>Você já está inscrito nesta etapa.</strong>
                    </div>
                <?php else: ?>
                    <div class="page-header">
                        <h1>Nova Inscrição</h1>
                    </div>
                    <form action="<?php echo Uri::create('inscricoes/nova/' . $etapa_info->id); ?>" id="nova_inscricao_form" class="form form-horizontal" method="POST" enctype="multipart/form-data">
                        <fieldset>
                            <div class="control-group">
                                <?php echo Form::label('Etapa', 'inscricao_categoria', array('class' => 'control-label')); ?>
                                <div class="controls">
                                    <select name="inscricao_categoria" id="inscricao_categoria" class="input-xxlarge chzn-select">
                                        <?php foreach(Utils::$categorias as $categoria): ?>
                                            <option value="<?php echo $categoria; ?>"><?php echo $categoria; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <?php echo Form::label('Comprovante', 'inscricao_comprovante', array('class' => 'control-label')); ?>
                                <div class="controls">
                                    <input type="file" name="inscricao_comprovante" id="inscricao_comprovante" class="input-file input-xxlarge">
                                </div>
                            </div>
                            <div class="control-group">
                                <?php echo Form::label('Observação', 'inscricao_observacao', array('class' => 'control-label')); ?>
                                <div class="controls">
                                    <textarea name="inscricao_observacao" id="inscricao_observacao" rows="5" class="input-xxlarge"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <input type="hidden" name="etapa_id_verify" value="<?php echo $etapa_info->id; ?>">
                                    <button type="submit" class="btn btn-primary">Enviar Pedido</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                <?php endif ?>
                <?php else: ?>
                    <div class="alert alert-info fade in">
                        <strong>Você deve completar o seu perfil no sistema antes de realizar uma inscrição.</strong>
                        <?php echo Html::anchor('usuario/perfil', 'Completar Perfil'); ?>
                    </div>
            <?php endif; ?>
        </div>
    </article>
</div>

<?php if(Sentry::user()->is_admin()): ?>
    <div class="modal hide fade" id="exportModal">
        <div class="modal-header">
            <button class="close" data-dismiss="modal">&times;</button>
            <h3>Exportar Inscritos</h3>
        </div>

        <div class="modal-body modal-form alert alert-info face in">
            <strong>Escola um dos formatos disponíveis para gerar o arquivo com os atletas inscritos.</strong>
        </div>

        <div class="modal-footer">
            <?php echo Html::anchor('admin/etapas/inscritos/' . $etapa_info->id . '/' . Padrao_FGO::$myType . '/', 'Modelo FGO', array('id' => 'btnFGO', 'class' => 'btn btn-success', 'title' => 'Federação Gaúcha de Orientação')); ?>
            <?php echo Html::anchor('admin/etapas/inscritos/' . $etapa_info->id . '/' . Padrao_CBO::$myType . '/', 'Modelo CBO', array('id' => 'btnCBO', 'class' => 'btn btn-info', 'title' => 'Confederação Brasileira de Orientação')); ?>
        </div>
    </div>
<?php endif; ?>