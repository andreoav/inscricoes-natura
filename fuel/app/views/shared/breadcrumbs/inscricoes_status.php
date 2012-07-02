<div class="breadLinks">
    <ul>
        <li>
            <a href="#" title="Aprovadas" class="tipS">
                <i class="icos-check"></i>
                <strong>
                    <?php echo Model_Inscricao::count(array(
                        'related' => array(
                            'user' => array(
                                'where' => array('id' => Sentry::user()->get('id'))
                            )
                        ),
                        'where' => array('status' => Model_Inscricao::INSCRICAO_ACEITA)
                    )); ?>
                </strong>
        </a>
        </li>
        <li>
            <a href="#" title="Pendentes" class="tipS">
                <i class="icos-alert"></i>
                <strong>
                    <?php echo Model_Inscricao::count(array(
                        'related' => array(
                            'user' => array(
                                'where' => array('id' => Sentry::user()->get('id'))
                            )
                        ),
                        'where' => array('status' => Model_Inscricao::INSCRICAO_PENDENTE)
                    )); ?>
                </strong>
            </a>
        </li>
        <li>
            <a href="#" title="Rejeitadas" class="tipS">
                <i class="icos-cross"></i>
                <strong>
                    <?php echo Model_Inscricao::count(array(
                        'related' => array(
                            'user' => array(
                                'where' => array('id' => Sentry::user()->get('id'))
                            )
                        ),
                        'where' => array('status' => Model_Inscricao::INSCRICAO_REJEITADA)
                    )); ?>
                </strong>
            </a>
        </li>
    </ul>
    <div class="clear"></div>
</div>