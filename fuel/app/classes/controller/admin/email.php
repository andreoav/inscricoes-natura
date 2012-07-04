<?php

class Controller_Admin_Email extends Controller_Admin_Painel
{
    const TODOS = -1;

	public function before()
	{
		parent::before();
	}

	public function action_index()
	{
        if(Input::method() == 'POST')
        {
            $_targets = Input::post('email_targets');
            $_subject = Input::post('email_assunto');
            $_content = Input::post('email_content');

            if(in_arrayi(self::TODOS, $_targets))
            {
                $_users = DB::select('users.email')->from('users')->join('users_metadata', 'LEFT')->on('users_metadata.user_id', '=', 'users.id')
                    ->where('users_metadata.nome' , '!=', null)->execute()->as_array();

                $_to = array();
                foreach($_users as $_user)
                {
                    $_to[] = $_user['email'];
                }
            }
            else
            {
                $_to = $_targets;
            }

            try
            {
                $_novoEmail = Email::forge();
                $_novoEmail->to($_to);
                $_novoEmail->subject($_subject);
                $_novoEmail->body($_content);
                $_novoEmail->send();

                Session::set_flash('flash_msg', array(
                    'msg_type'    => 'nSuccess',
                    'msg_content' => 'Email enviado com sucesso.'
                ));
            }
            catch(\EmailValidationFailedException $e)
            {
                Session::set_flash('flash_msg', array(
                    'msg_type'    => 'nFailure',
                    'msg_content' => 'Não foi possível enviar este email. Motivo: ' . $e->getMessage()
                ));
            }
            catch(\EmailSendingFailedException $e)
            {
                // The driver could not send the email
                Session::set_flash('flash_msg', array(
                    'msg_type'    => 'nFailure',
                    'msg_content' => 'Não foi possível enviar este email. Motivo: ' . $e->getMessage()
                ));
            }

            Response::redirect('admin/email');
        }

        $_users = DB::select('users.id')->from('users')->join('users_metadata', 'LEFT')->on('users_metadata.user_id', '=', 'users.id')
            ->where('users_metadata.nome' , '!=', null)->as_object()->execute();

		$this->template->conteudo = View::forge('admin/email/index');
        $this->template->conteudo->set('usuarios', $_users, false);
	}
}
