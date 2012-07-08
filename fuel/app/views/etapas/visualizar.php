<?php echo View::forge('template/topbar', array('tPage' => 'Visualizar Etapa', 'icon' => 'icon-screen')); ?>

<div class="breadLine" xmlns="http://www.w3.org/1999/html">
    <?php echo Utils::criarBreadcrumb(Uri::segments()); ?>
    <?php echo View::forge('shared/breadcrumbs/inscricoes_status'); ?>
</div>

<!-- Main content -->
<div class="wrapper">
    <?php echo View::forge('flash'); ?>

    <div class="fluid">
        <div class="widget grid8">
            <div class="whead">
                <h6>Informações da Etapa</h6>
                <ul class="headIconSet">
                    <?php if(Sentry::user()->is_admin()): ?>
                        <li><a href="#" class="icon-list tipS" title="Lista de Inscritos" id="lista_inscritos" data-etapa-id="<?php echo $etapa_info->id; ?>"></a></li>
                        <li><a href="#" class="icon-remove tipS" title="Excluir" id="etapa_excluir" data-etapa-id="<?php echo $etapa_info->id; ?>"></a></li>
                    <?php endif ?>
                </ul>
                <div class="clear"></div>
            </div>
            <div class="body">
                <ul class="liArrow">
                    <li>
                        <strong>Nome:</strong>
                        <?php echo $etapa_info->nome ?>
                    </li>
                    <li>
                        <strong>Campeonato:</strong>
                        <?php echo $etapa_info->campeonato->nome ?>
                    </li>
                    <li>
                        <strong>Localidade:</strong>
                        <?php echo $etapa_info->localidade ?>
                    </li>
                    <li>
                        <strong>Data de início:</strong>
                        <?php echo Date::forge($etapa_info->data_inicio)->format('%d/%m/%Y') ?>
                    </li>
                    <li>
                        <strong>Data de encerramento:</strong>
                        <?php echo Date::forge($etapa_info->data_final)->format('%d/%m/%Y') ?>
                    </li>
                    <li>
                        <strong>Inscrições até</strong>
                        <?php echo Date::forge($etapa_info->inscricao_ate)->format('%d/%m/%Y') ?>
                    </li>
                </ul>
            </div>
        </div>

        <div class="widget grid4">
            <div class="whead">
                <h6>Arquivos Disponíveis</h6>
                <div class="clear"></div>
            </div>
            <?php if($arquivos): ?>
                <table cellpadding="0" cellspacing="0" width="100%" class="tDefault checkAll tMedia" id="checkAll">
                    <thead>
                    <tr>
                        <td width="50">Arquivo</td>
                        <td width="100">Ações</td>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($arquivos as $arquivo): ?>
                            <tr>
                                <td><?php echo $arquivo['nome']; ?></td>
                                <td class="tableActs">
                                    <a href="<?php echo Uri::create('etapas/arquivo/' . $arquivo['id']); ?>" class="tablectrl_small bDefault tipS" title="Salvar Arquivo">
                                        <i class="icon-download"></i>Download
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="body">
                    <strong>Nenhum arquivo disponível para esta etapa.</strong>
                </div>
            <?php endif ?>
        </div>
    </div>

    <div class="fluid">
        <?php if (Session::get('profile_unfinished') == false): ?>
        <?php if ($inscricoes_encerradas): ?>
            <div class="nNote nFailure">
                <p><strong>Ops!</strong> As inscrições para esta etapa já estão encerradas.</p>
            </div>
            <?php elseif ($ja_inscrito): ?>
            <div class="nNote nInformation">
                <p>Você já está inscrito nesta etapa.</p>
            </div>
            <?php else: ?>
            <form action="<?php echo Uri::create('inscricoes/nova/' . $etapa_info->id); ?>" id="nova_inscricao_form" class="form form-horizontal" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <div class="fluid">
                        <div class="widget">
                            <div class="whead"><h6>Formulário de Inscrição</h6><div class="clear"></div></div>

                            <!-- CATEGORIA -->
                            <div class="formRow">
                                <div class="grid3"><label for="inscricao_categoria">Categoria:</label></div>
                                <div class="grid9 searchDrop">
                                    <select data-placeholder="Selecione um categoria..." name="inscricao_categoria" id="inscricao_categoria" class="fullwidth select">
                                        <option value=""></option>
                                        <?php foreach(Utils::$categorias as $categoria): ?>
                                            <option value="<?php echo $categoria ?>"><?php echo $categoria ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <!-- /CATEGORIA -->

                            <div class="formRow">
                                <div class="grid3"><label for="inscricao_comprovante">Comprovante:</label></div>
                                <div class="grid9">
                                    <input type="file" name="inscricao_comprovante" id="inscricao_comprovante" class="fileInput">
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="formRow">
                                <div class="grid3"><label for="inscricao_observacao">Observação:</label></div>
                                <div class="grid9">
                                    <textarea name="inscricao_observacao" id="inscricao_observacao" cols="" rows="8" class="auto"></textarea>
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="formRow">
                                <input type="hidden" name="etapa_id_verify" value="<?php echo $etapa_info->id; ?>">
                                <input class="buttonM formSubmit bBlue" type="submit" value="Enviar &raquo;">
                                <div class="clear"></div>
                            </div>
                        </div>

                    </div>
                </fieldset>
            </form>
            <?php endif ?>
        <?php else: ?>
        <div class="nNote nFailure">
            <p>
                <strong>Você deve completar o seu perfil no sistema antes de realizar uma inscrição.</strong>
                <?php echo Html::anchor('usuario/perfil', 'Completar Perfil'); ?>
            </p>
        </div>
        <?php endif; ?>
    </div>
</div>

<div id="inscritos_modal" title="Gerar lista de inscritos">
    <p>Escolha um tipo de modelo para gerar o relatório dos atletas inscritos.</p>
</div>