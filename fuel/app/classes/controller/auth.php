<?php

/**
 *
 */
class Controller_Auth extends Controller_Hybrid
{
    public    $template = 'login';
    protected $_allowed_actions = array('login', 'cadastro', 'recuperar_senha', '404');

    public function before()
    {
        parent::before();
        $this->format = 'json';

        self::include_assets();
        Date::display_timezone('America/Sao_Paulo');

        // Autenticacao
        if(! in_arrayi($this->request->action, $this->_allowed_actions))
        {
            try
            {
                // Verifica usuário logado
                if(Sentry::check())
                {
                    // Habilita o guia de acordo com as opções do sistema.
                    /*if(Config::get('sysconfig.app.show_guide') and Sentry::user()->get('metadata.sistema_tour') == 0)
                    {
                        // Guide related JS
                        //Casset::js('jquery.guiders.js');
                        //Casset::js('guides/home.guide.js');

                        // Guide related Css
                        //Casset::css('guiders.css');
                    }

                    // Usuario logado, verificar permissoes e perfil completo*/
                    Session::set('profile_unfinished', ! Model_User::validate_profile());
                }
                else
                {
                    // Usuario não esta logado
                    Session::set_flash('flash_msg', array(
                        'msg_type' => 'nFailure',
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
        Casset::js('aquincum::files/login.js');

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
            $_remember = true;

            if(Session::get('redirect'))
            {
                $_redirect = Session::get('redirect');
                Session::delete('redirect');
            }
            else
            {
                $_redirect = 'home/index';
            }


            try
            {
                if(Sentry::login($_username, $_password, $_remember))
                {
                    Session::set_flash('flash_msg', array(
                        'msg_type' => 'nSuccess',
                        'msg_content' => 'Você efetuou login no sistema com sucesso.'
                    ));

                    Response::redirect($_redirect == 'home/404' ? 'home/index' : $_redirect);
                }
                else
                {
                    Session::set_flash('flash_msg', array(
                        'msg_type' => 'nFailure',
                        'msg_content' => 'A senha digitada está incorreta. <small>' . Html::anchor('#recuperar_senha_modal', '(Esqueci minha senha!)', array('data-toggle' => 'modal')) .'</small>'
                    ));
                }
            }
            catch(SentryAuthException $e)
            {
                Session::set_flash('flash_msg', array(
                    'msg_type' => 'nFailure',
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
            'msg_type'    => 'nSuccess',
            'msg_content' => 'Você deslogou do sistema com sucesso.'
        ));

        Response::redirect('login');
    }

    public static function include_assets()
    {
        Casset::add_path('aquincum', 'aquincum/');

        Casset::css('aquincum::styles.css'); // General Styles
        Casset::js('aquincum::jquery.min.js'); // Jquery

        // Forms
        Casset::js('aquincum::plugins/forms/ui.spinner.js');
		Casset::js('aquincum::plugins/forms/jquery.mousewheel.js');
        
		// Jquery UI
		Casset::js('aquincum::jquery-ui.min.js');
        Casset::js('aquincum::plugins/ui/jquery.ui.datepicker-pt-BR.js');

        // Charts
        Casset::js('aquincum::plugins/charts/excanvas.min.js');
        Casset::js('aquincum::plugins/charts/jquery.flot.js');
        Casset::js('aquincum::plugins/charts/jquery.flot.orderBars.js');
        Casset::js('aquincum::plugins/charts/jquery.flot.pie.js');
        Casset::js('aquincum::plugins/charts/jquery.flot.resize.js');
        Casset::js('aquincum::plugins/charts/jquery.sparkline.min.js');

        // Tables
        Casset::js('aquincum::plugins/tables/jquery.dataTables.js');
        Casset::js('aquincum::plugins/tables/jquery.sortable.js');
        Casset::js('aquincum::plugins/tables/jquery.resizable.js');

        // Forms [2]
        Casset::js('aquincum::plugins/forms/autogrowtextarea.js');
        Casset::js('aquincum::plugins/forms/jquery.uniform.js');
        Casset::js('aquincum::plugins/forms/jquery.inputlimiter.min.js');
        Casset::js('aquincum::plugins/forms/jquery.tagsinput.min.js');
        Casset::js('aquincum::plugins/forms/jquery.maskedinput.min.js');
        Casset::js('aquincum::plugins/forms/jquery.autotab.js');
        Casset::js('aquincum::plugins/forms/jquery.chosen.min.js');
        Casset::js('aquincum::plugins/forms/jquery.dualListBox.js');
        Casset::js('aquincum::plugins/forms/jquery.cleditor.js');
        Casset::js('aquincum::plugins/forms/jquery.ibutton.js');
        Casset::js('aquincum::plugins/forms/jquery.validationEngine-en.js');
        Casset::js('aquincum::plugins/forms/jquery.validationEngine.js');


        // File upload
        Casset::js('aquincum::plugins/uploader/plupload.js');
        Casset::js('aquincum::plugins/uploader/plupload.html4.js');
        Casset::js('aquincum::plugins/uploader/plupload.html5.js');
        Casset::js('aquincum::plugins/uploader/jquery.plupload.queue.js');

        // Wizards
        Casset::js('aquincum::plugins/wizards/jquery.form.wizard.js');
        Casset::js('aquincum::plugins/wizards/jquery.validate.js');
        Casset::js('aquincum::plugins/forms/methods_pt.js');
        Casset::js('aquincum::plugins/forms/messages_ptbr.js');
        Casset::js('aquincum::plugins/wizards/jquery.form.js');

        // UI
        Casset::js('aquincum::plugins/ui/jquery.collapsible.min.js');
        Casset::js('aquincum::plugins/ui/jquery.breadcrumbs.js');
        Casset::js('aquincum::plugins/ui/jquery.tipsy.js');
        Casset::js('aquincum::plugins/ui/jquery.progress.js');
        Casset::js('aquincum::plugins/ui/jquery.timeentry.min.js');
        Casset::js('aquincum::plugins/ui/jquery.colorpicker.js');
        Casset::js('aquincum::plugins/ui/jquery.jgrowl.js');
        Casset::js('aquincum::plugins/ui/jquery.fancybox.js');
        Casset::js('aquincum::plugins/ui/jquery.fileTree.js');
        Casset::js('aquincum::plugins/ui/jquery.sourcerer.js');

        // Others
        Casset::js('aquincum::plugins/others/jquery.fullcalendar.js');
        Casset::js('aquincum::plugins/others/jquery.elfinder.js');

        // TODO: MUDAR DE DIRETÓRIO
        Casset::js('amplify.min.js');
        Casset::js('amplify.request.min.js'); // TODO: MUDAR DE DIRETÓRIO
        Casset::js('xdate.js'); // TODO: MUDAR DE DIRETÓRIO

        // Custom
        Casset::js('aquincum::plugins/ui/jquery.easytabs.min.js');
        Casset::js('aquincum::files/bootstrap.js');
        Casset::js('aquincum::app.core.js');
        Casset::js('aquincum::app.core.validations.js');
        Casset::js('aquincum::files/functions.js');
    }
}