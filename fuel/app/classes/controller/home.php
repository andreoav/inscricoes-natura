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
        Response::redirect('home/index');
        //$this->template->conteudo = View::forge('home/404');
	}

	public function action_index()
    {
        $_noticias = DB::select()->from('noticias')->order_by('id', 'desc')->limit(5)->as_object()->execute();

        $this->template->conteudo  = \View::forge('home/index', null, false);
		$this->template->conteudo->set_global('noticias', $_noticias, false);
	}

    public function action_faleconosco()
    {
        Session::set_flash('flash_msg', array(
            'msg_type'    => 'nInformation',
            'msg_content' => 'Esta recurso ainda não está implementado, em breve estará funcionando...'
        ));

        Response::redirect('home');
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
				'email'    => Input::post('cadastro_username'),
				'username' => Input::post('cadastro_username'),
				'password' => Input::post('cadastro_password')
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
								'msg_type'    => 'nSuccess',
								'msg_content' => 'Cadastro efetuado com sucesso. Seja muito bem vindo!'
							));

							//Response::redirect('home#guider=g1');
                            Response::redirect('home/index');
						}
					}
					catch (SentryAuthException $e)
					{
						Session::set_flash('flash_msg', array(
							'msg_type'    => 'nFailure',
							'msg_content' => 'Não foi possível efetuar login no sistema.'
						));

						Response::redirect('login');
					}
				}
				else
				{
					Session::set_flash('flash_msg', array(
						'msg_type'    => 'nFailure',
						'msg_content' => 'Não foi possível realizar o seu cadastro.'
					));
				}
			}
			catch(SentryUserException $e)
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'nFailure',
					'msg_content' => 'Não foi possível realizar o seu cadastro pois este email/usuário já está cadastrado.'
				));
			}

			Response::redirect('cadastro');
		}
        else
        {
            Response::redirect('login');
        }
	}
}