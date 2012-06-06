<?php

class Model_User extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'username',
		'email',
		'password',
		'password_reset_hash',
		'temp_password',
		'remember_me',
		'activation_hash',
		'last_login',
		'ip_address',
		'updated_at',
		'created_at',
		'status',
		'activated'
	);

	protected static $_has_many = array(
		'noticias',
		'inscricoes' => array(
			'model_to' => 'Model_Inscricao'
		)
	);

	/**
	 * Valida os dados do perfil do usuário, verificando se todos os dados obrigatório estão complentos
	 * Caso o perfil esteja incompleto, o usuário não será capaz de realizar novas inscrições
	 *
	 * @version 1.0
	 * @since 1.0
	 * @return boolean Retorna true se o usuário está com o perfil completo, false se ele está incompleto
	 */
	public static function validate_profile()
	{
		$_user_metadata = Sentry::user()->get('metadata');
		if(empty($_user_metadata['nome'])  || empty($_user_metadata['cpf']) || empty($_user_metadata['nascimento']) || empty($_user_metadata['identidade']))
		{
			return false;
		}

		return true;
	}
}