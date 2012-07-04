<?php echo View::forge('template/topbar', array('tPage' => 'Meu Perfil', 'icon' => 'icon-screen')); ?>

<div class="breadLine">
    <?php echo Utils::criarBreadcrumb(Uri::segments()); ?>
    <?php echo View::forge('shared/breadcrumbs/inscricoes_status'); ?>
</div>

<div class="wrapper">
    <?php echo View::forge('flash'); ?>
    <form class="main" id="usuario_perfil_form" action="<?php Uri::create('perfil');?>" method="POST">
        <fieldset>
            <div class="widget fluid">
                <div class="whead">
                    <h6>Minhas Informações</h6>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <div class="grid2"><?php echo Form::label('Nome Completo', 'usuario_nome'); ?></div>
                    <div class="grid10">
                        <?php echo Form::input('usuario_nome', $usuario_dados['nome'], array('id' => 'usuario_nome')); ?>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <div class="grid2"><?php echo Form::label('Identidade', 'usuario_identidade'); ?></div>
                    <div class="grid10">
                        <?php echo Form::input('usuario_identidade', $usuario_dados['identidade'], array('id' => 'usuario_identidade', 'maxlength' => 10)); ?>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <div class="grid2"><?php echo Form::label('CPF', 'usuario_cpf'); ?></div>
                    <div class="grid10">
                        <?php echo Form::input('usuario_cpf', $usuario_dados['cpf'], array('id' => 'usuario_cpf')); ?>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <div class="grid2"><?php echo Form::label('Data de Nascimento', 'usuario_nascimento'); ?></div>
                    <div class="grid10">
                        <?php echo Form::input('usuario_nascimento', $usuario_dados['nascimento'], array('id' => 'usuario_nascimento', 'class' => 'dataBR maskDate datepicker')); ?>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <div class="grid2"><?php echo Form::label('Número CBO', 'usuario_ncbo'); ?></div>
                    <div class="grid10">
                        <?php echo Form::input('usuario_ncbo', $usuario_dados['numero_cbo'], array('id' => 'usuario_ncbo')); ?>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <div class="grid2"><?php echo Form::label('SI Card', 'usuario_sicard'); ?></div>
                    <div class="grid10">
                        <?php echo Form::input('usuario_sicard', $usuario_dados['sicard'], array('id' => 'usuario_sicard')); ?>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <div class="grid2"><?php echo Form::label('Alergia'); ?></div>
                    <div class="grid10 check">
                        <?php echo Form::checkbox('usuario_alergia', 1, $usuario_dados['alergia'] == 1 ?: null, array('id' => 'usuario_alergia')); ?>
                        <label for="usuario_alergia">Declaro que possuo algum tipo de alergia</label>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <input class="buttonM formSubmit bBlue" type="submit" value="Atualizar &raquo;">
                    <div class="clear"></div>
                </div>

            </div>
        </fieldset>
    </form>
</div>