<?php

class Model_Resposta extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'conteudo',
		'created_at',
		'user_id',
		'inscricao_id'
	);

	protected static $_belongs_to = array(
		'user',
		'inscricao' => array(
			'model_to' => 'Model_Inscricao'
		)
	);

	protected static $_observers = array(
	    '\Orm\Observer_CreatedAt' => array(
	        'events' => array('before_insert'),
	    ),
	);
}