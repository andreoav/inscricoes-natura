<?php

class Model_Noticia extends Model_Crud
{
    protected static $_table_name = 'noticias';
	protected static $_properties = array(
		'id',
		'titulo',
		'conteudo',
		'created_at',
		'updated_at',
		'user_id'
	);

    protected static $_created_at = 'created_at';
    protected static $_updated_at = 'updated_at';
}