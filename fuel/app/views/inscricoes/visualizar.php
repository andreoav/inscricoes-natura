<?php echo View::forge('template/topbar', array('tPage' => 'Visualizar Inscrição', 'icon' => 'icon-screen')); ?>
<?php echo Utils::criarBreadcrumb(Uri::segments()); ?>

<div class="wrapper">
    <?php echo View::forge('flash'); ?>

    <div class="fluid">
        <div class="widget grid8">
            <div class="whead">
                <h6>Visualizar Inscrição</h6>
                <ul class="headIconSet">
                    <li><a class="icon-remove-3 tipS" href="#" title="Excluir Inscrição"></a></li>
                    <?php if(Sentry::user()->is_admin()): ?>
                        <li><a class="icon-checkmark updateBtn tipS" href="#"  title="Aprovar" data-inscricao-id="<?php echo $inscricao_info->id; ?>" data-update-type="aprovar"></a></li>
                        <li><a class="icon-minus-2 updateBtn tipS" href="#"  title="Rejeitar" data-inscricao-id="<?php echo $inscricao_info->id; ?>" data-update-type="rejeitar"></a></li>
                    <?php endif ?>
                </ul>
                <div class="clear"></div>
            </div>
            <div class="body">
                <ul class="liArrow">
                    <li>
                        <strong>Número:</strong> <?php echo $inscricao_info->id; ?>
                    </li>
                    <li>
                        <strong>Atleta:</strong> <?php echo Sentry::user((int) $inscricao_info->user->id)->get('metadata.nome'); ?>
                    </li>
                    <li>
                        <strong>Categoria:</strong> <?php echo $inscricao_info->categoria; ?>
                    </li>
                    <li>
                        <strong>Realizada em:</strong> <?php echo Date::forge($inscricao_info->created_at)->format('%d/%m/%Y %H:%M:%S'); ?>
                    </li>
                    <li>
                        <strong>Campeonato:</strong> <?php echo $inscricao_info->etapa->campeonato->nome; ?>
                    </li>
                    <li>
                        <strong>Etapa:</strong> <?php echo $inscricao_info->etapa->nome; ?>
                    </li>
                    <li id="inscricaoStatus">
                        <strong>Status:</strong> <?php echo Utils::status2label($inscricao_info->status); ?>
                    </li>
                    <?php if($inscricao_info->observacao): ?>
                        <li>
                            <strong>Observação:</strong> <?php echo $inscricao_info->observacao; ?>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>

        <!-- Comprovante de Pagamento -->
        <div class="widget grid4">
            <div class="whead">
                <h6>Comprovante de Pagamento</h6>
                <div class="clear"></div>
            </div>
            <table cellpadding="0" cellspacing="0" width="100%" class="tDefault checkAll tMedia" id="checkAll">
                <thead>
                    <tr>
                        <td width="50">Arquivo</td>
                        <td width="120">Informações</td>
                        <td width="100">Ações</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php if (Utils::isImage(Arr::get(File::file_info(Asset::instance()->find_file($inscricao_info->comprovante, 'img')), 'mimetype'))): ?>
                                <a class="lightbox" href="<?php echo Asset::get_file($inscricao_info->comprovante, 'img'); ?>"><?php echo Asset::img($inscricao_info->comprovante, array('width' => 37, 'height' => 36)); ?></a>
                            <?php else: ?>
                                <?php echo Asset::img(Utils::get_mimeTypeIcon(Arr::get(File::file_info(Asset::instance()->find_file($inscricao_info->comprovante, 'img')), 'mimetype')), array('width' => 37, 'height' => 36)); ?>
                            <?php endif ?>
                        </td>
                        <td class="fileInfo">
                            <span><strong>Tamanho:</strong> <?php echo (int)(Arr::get(File::file_info(Asset::instance()->find_file($inscricao_info->comprovante, 'img')), 'size') / 1024); ?> Kb</span>
                            <span><strong>Formato:</strong> <?php echo Arr::get(File::file_info(Asset::instance()->find_file($inscricao_info->comprovante, 'img')), 'extension'); ?></span>
                        </td>
                        <td class="tableActs">
                            <a href="<?php echo Uri::create('inscricoes/download_comprovante/' . $inscricao_info->id); ?>" class="tablectrl_small bDefault tipS" title="Salvar Comprovante"><i class="icon-download"></i>Download</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Respostas -->
    <div id="inscricao_mensagens">
        <?php if($inscricao_info->respostas): ?>
            <div class="widget">
            <div class="whead">
                <h6>Respostas</h6>
                <div class="clear"></div>
            </div>

                <ul class="messagesTwo">
                    <?php foreach($inscricao_info->respostas as $resposta): ?>
                        <?php if($resposta->user->id === Sentry::user()->get('id')): ?>
                            <li class="by_me">
                                <a href="#"><?php echo Casset::img('aquincum::icons/color/user.png', null, array('width' => 37, 'height' => 35)); ?></a>
                                <div class="messageArea">
                                    <div class="infoRow">
                                        <span class="name"><strong><?php echo Sentry::user((int) $resposta->user->id)->get('metadata.nome') ?></strong> postou:</span>
                                        <span class="time"><?php echo Date::forge($resposta->created_at)->format('%d/%m/%Y às %H:%M:%S'); ?></span>
                                        <span class="clear"></span>
                                    </div>
                                    <?php echo $resposta->conteudo ?>
                                </div>
                            </li>
                        <?php else: ?>
                            <li class="by_user">
                                <a href="#"><?php echo Casset::img('aquincum::icons/color/user.png', null, array('width' => 37, 'height' => 35)); ?></a>
                                <div class="messageArea">
                                    <div class="infoRow">
                                        <span class="name"><strong><?php echo Sentry::user((int) $resposta->user->id)->get('metadata.nome') ?></strong> postou:</span>
                                        <span class="time"><?php echo Date::forge($resposta->created_at)->format('%d/%m/%Y às %H:%M:%S'); ?></span>
                                        <span class="clear"></span>
                                    </div>
                                    <?php echo $resposta->conteudo ?>
                                </div>
                            </li>
                        <?php endif ?>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>
    </div>

    <!-- Campo para inserir uma resposta -->
    <div class="enterMessage">
        <?php echo Form::open(array('action' => 'inscricoes/responder/' . $inscricao_info->id, 'id' => 'inscricao_resposta_form')); ?>
            <input type="text" name="inscricao_resposta" id="inscricao_resposta" placeholder="Envie uma mensagem nesta inscrição." />
            <div class="sendBtn">
                <input type="hidden" name="inscricaoID" id="inscricaoID" value="<?php echo $inscricao_info->id; ?>" />
                <input type="hidden" name="inscricaoUSER" id="inscricaoUSER" value="<?php echo Sentry::user()->get('metadata.nome'); ?>" />
                <input type="submit" class="buttonS bLightBlue" value="Enviar" />
            </div>
        <?php echo Form::close(); ?>
    </div>
    <!-- Fim do campo para inserir uma resposta -->

</div>