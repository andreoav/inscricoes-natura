<?php

class Model_Campeonato extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'nome'
	);

	protected static $_has_many = array('etapas');
}