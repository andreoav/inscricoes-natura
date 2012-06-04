<?php

/**
 *
 */
class Controller_Auth extends \Controller_Template
{
    public    $template = 'auth_template';
    protected $_allowed_actions = array('login', 'auth', 'cadastro');

    public function before()
    {
        parent::before();

        // Autenticacao
        if(in_arrayi($this->request->action, $this->_allowed_actions))
        {
            return;
        }
        else
        {
            if(Sentry::check())
            {
                // Usuario logado, verificar permissoes e perfil completo
                Session::set('profile_unfinished', ! Model_User::validate_profile());
            }
            else
            {
                // Usuario não esta logado
                Session::set_flash('flash_msg', array(
                    'msg_type' => 'alert-error',
                    'msg_content' => '<strong>Erro!</strong> É necessário estar logado no sistema!'
                ));

                // Redireciona para o formulario de login
                Response::redirect('login?redir=' . (Uri::string() == '' ? 'home' : Uri::string()));
            }
        }
    }

    /**
     * Verifica e valida o login do usuário no sistema.
     *
     */
    public function action_login()
    {
        // Caso o usuário já esteja logado redireciona o mesmo para a dashboard do sistema
        if(Sentry::check())
        {
            Response::redirect('home');
        }

        // Formulário de login enviado
        if(Input::method() == 'POST')
        {
            $_username = Input::post('username');
            $_password = Input::post('password');
            $_remember = Input::post('remember') == 1 ? true : false;

            try
            {
                if(Sentry::login($_username, $_password, $_remember))
                {
                    Session::set_flash('flash_msg', array(
                        'msg_type' => 'alert-success',
                        'msg_content' => 'Login efetuado com sucesso!'
                    ));

                    Response::redirect(Session::get_flash('redir_location'));
                }
                else
                {
                    Session::set_flash('flash_msg', array(
                        'msg_type' => 'alert-error',
                        'msg_content' => '<strong>Erro!</strong> A senha digitada está incorreta.'
                    ));
                }
            }
            catch(SentryAuthException $e)
            {
                Session::set_flash('flash_msg', array(
                    'msg_type' => 'alert-error',
                    'msg_content' => '<strong>Erro!</strong> Usuário não encontrado.'
                ));
            }
        }

        Session::set_flash('redir_location', Input::get('redir') ? Input::get('redir') : '/');
        $this->template->conteudo = View::forge('auth/login', null, false);
    }

    public function action_logout()
    {
        Sentry::logout();

        Session::set_flash('flash_msg', array(
            'msg_type' => 'alert-success',
            'msg_content' => 'Você deslogou do sistema com sucesso!'
        ));

        Response::redirect('login');
    }
}