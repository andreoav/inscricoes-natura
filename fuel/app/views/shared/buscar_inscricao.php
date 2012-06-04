<div class="<?php echo isset($span_size) ? $span_size : 'span8' ?>">
    <form class="well form form-horizontal" id="inscricao_busca_form" action="<?php echo Uri::create('inscricoes/buscar'); ?>" method="POST">
    	<fieldset>
    		<div class="control-group">
    			<label class="control-label"><strong>Número da Inscrição</strong></label>
    			<div class="controls">
    				<input type="text" name="inscricao_numero" id="inscricao_numero" class="input-xlarge">
    				<button type="submit" class="btn btn-info" rel="tooltip" title="Buscar Inscrição"><i class="icon-search icon-white"></i></button>
    			</div>
    		</div>
    	</fieldset>
    </form>
</div>