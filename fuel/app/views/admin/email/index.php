<section id="adminEmail">
	<div class="row">
		<div class="span12">
			<div class="page-header">
				<h1>Envio de Email</h1>
			</div>
            <?php echo Form::open(array('action' => 'admin/email', 'class' => 'form form-horizontal')); ?>
			<form action="" class="form form-horizontal">
				<fieldset>
					<div class="control-group">
						<label for="email_targets" class="control-label">Para:</label>
						<div class="controls">
                            <select class="input-xxlarge chzn-select" name="email_targets[]" id="email_targets" multiple="" data-placeholder="Selecione os contatos.">
                                <option value="-1">Todos</option>
                                <?php foreach($usuarios as $user): ?>
                                    <option value="<?php echo Sentry::user((int) $user->id)->get('email'); ?>">
                                        <?php echo Sentry::user((int) $user->id)->get('metadata.nome'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
						</div>
					</div>
                    <div class="control-group">
                        <label class="control-label" for="email_assunto">Assunto:</label>
                        <div class="controls">
                            <input class="input-xxlarge" type="text" name="email_assunto" id="email_assunto">
                        </div>
                    </div>
					<div class="control-group">
						<label for="email_content" class="control-label">Mensagem:</label>
						<div class="controls">
							<textarea id="email_content" name="content" style="height: 360px;" class="span10 redactor_content"></textarea>
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<button class="btn btn-large btn-success"><i class="icon-share-alt icon-white"></i> Enviar Email</button>
						</div>
					</div>
				</fieldset>
			<?php echo Form::close(); ?>
		</div>
	</div>
</section>