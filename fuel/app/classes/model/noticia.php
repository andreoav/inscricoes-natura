<?php

class Model_Noticia extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'titulo',
		'conteudo',
		'created_at',
		'updated_at',
		'user_id'
	);

	protected static $_belongs_to = array(
		'user'
	);

	protected static $_observers = array(
	    '\Orm\Observer_CreatedAt' => array(
	        'events' => array('before_insert')
	    ),
	    '\Orm\Observer_UpdatedAt' => array(
	    	'events' => array('before_save')
	    )
	);
}