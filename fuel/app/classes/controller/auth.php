<?php

/**
 *
 */
class Controller_Auth extends Controller_Hybrid
{
    public    $template = 'template';
    protected $_allowed_actions = array('login', 'auth', 'cadastro');

    public function before()
    {
        parent::before();

        // Inclui os assets comuns para a maioria das views
        Casset::js('jquery-1.7.2.min.js');
        Casset::js('bootstrap.js');
        Casset::js('jquery.dataTables.js');
        Casset::js('jquery.dataTables-bootstrap.js');
        Casset::js('jquery.validate.js');
        Casset::js('app.core.js');
        Casset::js('app.core.validations.js');

        // Autenticacao
        if(in_arrayi($this->request->action, $this->_allowed_actions))
        {
            return;
        }
        else
        {
            try
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
                        'msg_content' => '<strong>Você precisa estar logado no sistema para acessar este recurso.</strong>'
                    ));

                    // Redireciona para o formulario de login
                    Response::redirect('login?redir=' . (Uri::string() == '' ? 'home' : Uri::string()));
                }
            }
            catch(Exception $e)
            {
                Sentry::logout();
                Response::redirect('login');
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
                        'msg_content' => '<strong>Login efetuado com sucesso!</strong>'
                    ));

                    Response::redirect(Session::get_flash('redir_location'));
                }
                else
                {
                    Session::set_flash('flash_msg', array(
                        'msg_type' => 'alert-error',
                        'msg_content' => '<strong>A senha digitada está incorreta.</strong> <small>' . Html::anchor('#', '(Esqueci minha senha!)') .'</small>'
                    ));
                }
            }
            catch(SentryAuthException $e)
            {
                Session::set_flash('flash_msg', array(
                    'msg_type' => 'alert-error',
                    'msg_content' => '<strong>Não foi possível encontrar um usuário cadastrado com este email.</strong>.'
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
            'msg_content' => '<strong>Você deslogou do sistema com sucesso.</strong>'
        ));

        Response::redirect('login');
    }
}