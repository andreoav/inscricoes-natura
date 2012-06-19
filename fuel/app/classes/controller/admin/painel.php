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
				'msg_content' => 'Você não possui permissão para acessar este recurso.'
			));

			Response::redirect('home');
		}
	}

	public function action_index()
	{
		Casset::css('redactor.css');
		Casset::js('redactor.js');

		$this->template->conteudo = View::forge('admin/painel/index');
	}
}