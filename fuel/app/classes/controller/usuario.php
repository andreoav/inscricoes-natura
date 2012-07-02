<?php

class Controller_Usuario extends Controller_Auth
{
	public $template = 'template';

	public function before()
	{
		parent::before();

		// Assets
		Casset::js('jquery.maskedinput-1.3.min.js');
	}

	public function action_perfil()
	{
		if(Input::method() == 'POST')
		{
			$_novo_nome       = Input::post('usuario_nome');
			$_novo_cpf        = Input::post('usuario_cpf');
			$_nova_identidade = Input::post('usuario_identidade');
			$_novo_nascimento = Input::post('usuario_nascimento');
			$_novo_numero_cbo = Input::post('usuario_ncbo');
			$_novo_sicard     = Input::post('usuario_sicard');
			$_novo_alergia    = Input::post('usuario_alergia');

			$_new_metadata = array(
				'metadata' => array(
					'nome'       => $_novo_nome,
					'cpf'        => $_novo_cpf,
					'identidade' => $_nova_identidade,
					'nascimento' => $_novo_nascimento,
					'numero_cbo' => $_novo_numero_cbo,
					'sicard'     => $_novo_sicard,
					'alergia'    => $_novo_alergia
				)
			);

			try
			{
				if(Sentry::user()->update($_new_metadata))
				{
					Session::set_flash('flash_msg', array(
						'msg_type'    => 'nSuccess',
						'msg_content' => 'Seu perfil foi atualizado com sucesso.'
					));
				}
				else
				{
					Session::set_flash('flash_msg', array(
						'msg_type'    => 'nFailure',
						'msg_content' => 'Não foi possível atualizar o seu perfil.'
					));
				}
			}
			catch(SentryUserException $e)
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-error',
					'msg_content' => $e->getMessage()
				));
			}

			Response::redirect('home');
		}

		$this->template->conteudo = View::forge('usuario/perfil');
        $this->template->conteudo->set('usuario_dados', Sentry::user()->get('metadata'));
        $this->template->conteudo->set_global('pagina_titulo', 'Inscrições :: Perfil');
	}

	public function post_cancelGuide()
	{
		if(Input::post('cancelGuide') == true)
		{
			if(Sentry::check())
			{
				try
				{
					$_usuario = Sentry::user();
					$_update  = $_usuario->update(array(
						'metadata' => array(
							'sistema_tour' => 1
						)
					));
					
					if($_update)
					{
						$this->response(array('return' => 'success'));
					}
					else
					{
						$this->response(array('return' => 'error'), 400);
					}
				}
				catch(SentryUserException $e) {
					$this->response(array('return' => 'error'), 400);
				}
			}
		}
	}
}