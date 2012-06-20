<?php

class Model_Etapa extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'nome' => array(
            'data_type'  => 'varchar',
            'validation' => array(
                'required',
                'max_length' => array(255)
            )
        ),
		'localidade' => array(
            'data_type'  => 'varchar',
            'validation' => array(
                'required',
                'max_length' => array(255)
            )
        ),
		'data_inicio' => array(
            'data_type' => 'int'
        ),
		'data_final' => array(
            'data_type' => 'int'
        ),
		'inscricao_ate' => array(
            'data_type' => 'int'
        ),
		'campeonato_id' => array(
            'data_type' => 'int'
        )
	);

	protected static $_belongs_to = array(
        'campeonato'
    );

    protected static $_has_many = array(
        'inscricoes' => array(
            'model_to' => 'Model_Inscricao'
        )
    );
}