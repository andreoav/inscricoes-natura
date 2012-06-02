<?php

/**
*
*/
class Controller_Admin_Painel extends Controller_Auth
{
	public $template = 'template';

	public function before()
	{
		parent::before();

		// Verifica se o usuário é administrador
		if(! Sentry::user()->is_admin() )
		{
			Session::set_flash('flash_msg', array(
				'msg_type'    => 'alert-error',
				'msg_content' => '<strong>Erro!</strong> Você não possui permissão para acessar este recurso.'
			));
		}
	}

	public function action_index()
	{
		$this->template->conteudo = View::forge('admin/painel/index');
	}
}