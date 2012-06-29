<?php

/**
 *
 */
class Controller_Auth extends Controller_Hybrid
{
    public    $template = 'template';
    protected $_allowed_actions = array('login', 'cadastro', 'recuperar_senha', '404');

    public function before()
    {
        parent::before();
        $this->format = 'json';

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
        Casset::js('underscore-min.js');
        Casset::js('app.core.js');
        Casset::js('app.core.validations.js');

        // Css
        Casset::css('bootstrap.css');
        Casset::css('bootstrap-responsive.min.css');
        Casset::css('font-awesome.css');
        Casset::css('jquery.dataTables-bootstrap.css');
        Casset::css('datepicker.css');
        Casset::css('jquery.noty.css');
        Casset::css('noty_theme_default.css');
        //Casset::css('noty_theme_twitter.css');

        // Autenticacao
        if(! in_arrayi($this->request->action, $this->_allowed_actions))
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
                    Response::redirect('login?redirect=' . Uri::string());
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

            if(Session::get('redirect'))
            {
                $_redirect = Session::get('redirect');
                Session::delete('redirect');
            }

            try
            {
                if(Sentry::login($_username, $_password, $_remember))
                {
                    Session::set_flash('flash_msg', array(
                        'msg_type' => 'alert-success',
                        'msg_content' => 'Login efetuado com sucesso.'
                    ));

                    Response::redirect($_redirect == 'home/404' ? 'home/index' : $_redirect);
                }
                else
                {
                    Session::set_flash('flash_msg', array(
                        'msg_type' => 'alert-error',
                        'msg_content' => 'A senha digitada está incorreta. <small>' . Html::anchor('#recuperar_senha_modal', '(Esqueci minha senha!)', array('data-toggle' => 'modal')) .'</small>'
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
        }

        $_redirect = Input::get('redirect') != null ? Input::get('redirect') : 'home/index';

        Session::set('redirect', $_redirect);
        $this->template->conteudo = View::forge('auth/login');
    }

    public function action_recuperar_senha($_email_hash, $_password_hash = null)
    {
        if(Input::method() == 'POST')
        {
            $_email    = Input::post('email');
            $_new_pass = Input::post('senha');

            // TODO: Fazer sem o ORM
            if(($_user = Model_User::find_by_email($_email)) != null)
            {
                try
                {
                    $_reset = Sentry::reset_password($_email, $_new_pass);
                    if($_reset)
                    {
                        $_novoEmail = Email::forge();
                        $_novoEmail->to($_email);
                        $_novoEmail->subject('Redefinição de Senha');
                        $_novoEmail->body('Para confirmar a recuperação de sua senha ' . Html::anchor(Uri::create('recuperar-senha/'. $_reset['link']), 'Clique Aqui'));
                        $_novoEmail->send();

                        Session::set_flash('flash_msg', array(
                            'msg_type' => 'alert-info',
                            'msg_content' => 'As instruções para a recuperação de sua senha foram enviadas para o seu email.'
                        ));
                    }
                }
                catch(SentryAuthException $e)
                {
                    Session::set_flash('flash_msg', array(
                        'msg_type'    => 'alert-error',
                        'msg_content' => 'Não foi possível recuperar sua senha.'
                    ));
                }
            }
            else
            {
                Session::set_flash('flash_msg', array(
                    'msg_type'    => 'alert-error',
                    'msg_content' => 'Não encontramos nenhum usuário cadastrado com esse email.'
                ));
            }
        }
        else
        {
            if($_email_hash != null and $_password_hash != null)
            {
                try
                {
                    $_reset = Sentry::reset_password_confirm($_email_hash, $_password_hash);
                    if($_reset)
                    {
                        Session::set_flash('flash_msg', array(
                            'msg_type'    => 'alert-success',
                            'msg_content' => 'Sua senha foi recuperada com sucesse. Use sua nova senha para entrar no sistema.'
                        ));
                    }
                    else
                    {
                        Session::set_flash('flash_msg', array(
                            'msg_type'    => 'alert-error',
                            'msg_content' => 'Não foi possível recuperar sua senha.'
                        ));
                    }
                }
                catch(SentryAuthException $e)
                {
                    Session::set_flash('flash_msg', array(
                        'msg_type'    => 'alert-error',
                        'msg_content' => 'Não foi possível recuperar sua senha.'
                    ));
                }
            }
        }

        Response::redirect('login');
    }


    /**
     *
     */
    public function action_logout()
    {
        Sentry::logout();
        Session::delete('profile_unfinished');

        Session::set_flash('flash_msg', array(
            'msg_type' => 'alert-success',
            'msg_content' => 'Você deslogou do sistema com sucesso.'
        ));

        Response::redirect('login');
    }
}