<?php echo View::forge('template/topbar', array('tPage' => 'Administração', 'icon' => 'icon-screen')); ?>

<div class="breadLine">
    <?php echo Utils::criarBreadcrumb(Uri::segments()); ?>
    <?php echo View::forge('shared/breadcrumbs/inscricoes_status'); ?>
</div>

<!-- Main content -->
<div class="wrapper">
    <?php echo View::forge('flash'); ?>

    <div class="fluid">

        <?php echo Form::open(array('action' => 'admin/email', 'id' => 'admin_email_form')); ?>
            <fieldset>
                <div class="widget">
                    <div class="whead">
                        <h6>Enviar Email</h6>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label for="email_targets">Para:</label></div>
                        <div class="grid9">
                            <select class="fullwidth select" name="email_targets[]" id="email_targets" multiple="" data-placeholder="Selecione os contatos.">
                                <option value="-1">Todos</option>
                                <?php foreach($usuarios as $user): ?>
                                    <option value="<?php echo Sentry::user((int) $user->id)->get('email'); ?>">
                                        <?php echo Sentry::user((int) $user->id)->get('metadata.nome'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label for="email_assunto">Assunto:</label></div>
                        <div class="grid9">
                            <input class="fullwidth" type="text" name="email_assunto" id="email_assunto">
                        </div>
                        <div class="clear"></div>
                    </div>

                </div>

                <div class="widget">
                    <div class="whead">
                        <h6>Conteúdo</h6>
                        <div class="clear"></div>
                    </div>
                    <textarea name="email_content" id="email_content" class="wysiwyg" cols="16"></textarea>
                </div>
            </fieldset>

            <br />
            <div class="wbutton">
                <input type="submit" value="Enviar" class="buttonL bBlue first">
            </div>

        <?php echo Form::close(); ?>
    </div>
</div>