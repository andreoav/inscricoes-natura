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
        $this->format = 'json';
        parent::before();

        // Inclui os assets comuns para a maioria das views
        // JavaScripts
        Casset::js('jquery-1.7.2.min.js');
        Casset::js('bootstrap.js');
        Casset::js('jquery.dataTables.js');
        Casset::js('jquery.dataTables-bootstrap.js');
        Casset::js('jquery.validate.js');
        Casset::js('bootstrap-datepicker.js');
        Casset::js('amplify.min.js');
        Casset::js('amplify.request.min.js');
        Casset::js('jquery.noty.js');
        Casset::js('xdate.js');
        Casset::js('app.core.js');
        Casset::js('app.core.validations.js');

        // Css
        Casset::css('bootstrap.css');
        Casset::css('bootstrap-responsive.min.css');
        Casset::css('jquery.dataTables-bootstrap.css');
        Casset::css('datepicker.css');
        Casset::css('jquery.noty.css');
        Casset::css('noty_theme_default.css');
        //Casset::css('noty_theme_twitter.css');

        // Autenticacao
        if(in_arrayi($this->request->action, $this->_allowed_actions))
        {
            return;
        }
        else
        {
            try
            {
                // Verifica usuário logado
                if(Sentry::check())
                {
                    // Habilita o guia de acordo com as opções do sistema.
                    if(Config::get('sysconfig.app.show_guide') and Sentry::user()->get('metadata.sistema_tour') == 0)
                    {
                        // Guide related JS
                        Casset::js('jquery.guiders.js');
                        Casset::js('guides/home.guide.js');

                        // Guide related Css
                        Casset::css('guiders.css');
                    }

                    // Usuario logado, verificar permissoes e perfil completo
                    Session::set('profile_unfinished', ! Model_User::validate_profile());
                }
                else
                {
                    // Usuario não esta logado
                    Session::set_flash('flash_msg', array(
                        'msg_type' => 'alert-error',
                        'msg_content' => 'Você precisa estar logado no sistema para acessar este recurso.'
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
                        'msg_content' => 'Login efetuado com sucesso.'
                    ));

                    Response::redirect(Session::get_flash('redir_location'));
                }
                else
                {
                    Session::set_flash('flash_msg', array(
                        'msg_type' => 'alert-error',
                        'msg_content' => 'A senha digitada está incorreta. <small>' . Html::anchor('#', '(Esqueci minha senha!)') .'</small>'
                    ));
                }
            }
            catch(SentryAuthException $e)
            {
                Session::set_flash('flash_msg', array(
                    'msg_type' => 'alert-error',
                    'msg_content' => 'Não foi possível encontrar um usuário cadastrado com este email.'
                ));
            }

            Response::redirect('login?redir=' . Session::get_flash('redir_location'));
        }

        $redir_location =  Input::get('redir') != null ? Input::get('redir') : 'home';
        Session::set_flash('redir_location', $redir_location);

        $this->template->conteudo = View::forge('auth/login');
    }


    /**
     *
     */
    public function action_logout()
    {
        Sentry::logout();

        Session::set_flash('flash_msg', array(
            'msg_type' => 'alert-success',
            'msg_content' => 'Você deslogou do sistema com sucesso.'
        ));

        Response::redirect('login');
    }
}