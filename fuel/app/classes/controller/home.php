<?php

class Controller_Home extends Controller_Auth
{
	public $template = 'template';

	public function before()
	{
		parent::before();
	}

	public function action_404()
	{

	}

	public function action_index()
    {
        $this->template->conteudo  = \View::forge('home/index', null, false);
		$this->template->conteudo->set('noticias',
            DB::select('id', 'titulo', 'created_at')->from('noticias')->order_by('id', 'desc')->limit(5)->as_object()->execute()
        );
	}

	public function action_cadastro()
	{
		if(Sentry::check())
		{
			Response::redirect('home');
		}

		if(Input::method() == 'POST')
		{
			$_user_data = array(
				'email'    => Input::post('cadastro_email'),
				'username' => Input::post('cadastro_usuario'),
				'password' => Input::post('cadastro_senha')
			);

			try
			{
				$_user_id = Sentry::user()->create($_user_data);

				if($_user_id)
				{
					Sentry::user($_user_id)->add_to_group(2);
					try
					{
						if(Sentry::login(Arr::get($_user_data, 'email'), Arr::get($_user_data, 'password'), false))
						{
							Session::set_flash('flash_msg', array(
								'msg_type'    => 'alert-success',
								'msg_content' => 'Login efetuado com sucesso!'
							));

							Response::redirect('home#guider=g1');
						}
					}
					catch (SentryAuthException $e)
					{
						Session::set_flash('flash_msg', array(
							'msg_type'    => 'alert-error',
							'msg_content' => 'Não foi possível logar no sistema.'
						));

						Response::redirect('login');
					}
				}
				else
				{
					Session::set_flash('flash_msg', array(
						'msg_type'    => 'alert-error',
						'msg_content' => 'Não foi possível realizar o seu cadastro.'
					));
				}
			}
			catch(SentryUserException $e)
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-error',
					'msg_content' => 'Não foi possível realizar o seu cadastro pois este email/usuário já está cadastrado.'
				));
			}

			Response::redirect('cadastro');
		}

		$this->template->conteudo = View::forge('home/cadastro');
	}
}