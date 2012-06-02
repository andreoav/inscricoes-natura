<?php

class Model_Inscricao extends \Orm\Model
{
	const INSCRICAO_ACEITA = 1;
	const INSCRICAO_PENDENTE = 2;
	const INSCRICAO_REJEITADA = 3;

	protected static $_table_name = 'inscricoes';
	protected static $_properties = array(
		'id',
		'categoria',
		'comprovante',
		'status',
		'observacao',
		'etapa_id',
		'user_id',
		'created_at'
	);

	protected static $_belongs_to = array('user', 'etapa');
	protected static $_has_many   = array('respostas');

	protected static $_observers = array(
	    '\Orm\Observer_CreatedAt' => array(
	        'events' => array('before_insert'),
	    ),
	);
}