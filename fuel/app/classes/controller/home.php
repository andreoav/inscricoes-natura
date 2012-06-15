<?php

class Controller_Home extends Controller_Auth
{
    public $template = 'template';

    public function before()
    {
        parent::before();
    }

    public function action_index()
    {
        /*if(Config::get('sysconfig.app.show_guide')) //&& Sentry::user()->get('metadata.sistema_tour') == 0)
        {
            Casset::js('guides/home.guide.js');
        }*/

        $data = array();
        $data['noticias']  = Model_Noticia::find('all', array(
            'order_by' => array('id' => 'desc'),
            'limit' => 5
        ));
        $data['minhas_inscricoes'] = Model_User::find(Sentry::user()->get('id'))->inscricoes;
        $this->template->conteudo  = \View::forge('home/index', $data, false);
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
                            'msg_content' => '<strong>Não foi possível logar no sistema.</strong>'
                        ));

                        Response::redirect('login');
                    }
                }
                else
                {
                    Session::set_flash('flash_msg', array(
                        'msg_type'    => 'alert-error',
                        'msg_content' => '<strong>Não foi possível realizar o seu cadastro.</strong>'
                    ));
                }
            }
            catch(SentryUserException $e)
            {
                Session::set_flash('flash_msg', array(
                    'msg_type'    => 'alert-error',
                    'msg_content' => '<strong>Não foi possível realizar o seu cadastro pois este email/usuário já está cadastrado.</strong>'
                ));
            }

            Response::redirect('cadastro');
        }

        $this->template->conteudo = View::forge('home/cadastro', null, false);
    }
}