<div class="<?php echo isset($span_size) ? $span_size : 'span8' ?>">
    <form class="well form form-horizontal form-dovalidation" action="<?php echo Uri::create('inscricoes/buscar'); ?>" method="POST">
        <label><strong>Número da Inscrição</strong></label>
        <input type="text" name="inscricao_numero" id="inscricao_numero" class="input-xlarge" data-validation-engine="validate[required, custom[onlyNumberSp]]">
        <button type="submit" class="btn btn-info"><i class="icon-search icon-white"></i> Buscar Inscrição</button>
    </form>
</div>