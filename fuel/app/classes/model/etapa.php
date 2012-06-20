<?php

class Model_Etapa extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'nome',
		'localidade',
		'data_inicio',
		'data_final',
		'inscricao_ate',
		'campeonato_id'
	);

	protected static $_belongs_to = array('campeonato');
    protected static $_has_many = array(
        'inscricoes' => array(
            'model_to' => 'Model_Inscricao'
        )
    );
}