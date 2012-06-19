<?php

class Controller_Admin_Email extends Controller_Admin_Painel
{
	public function before()
	{
		parent::before();
	}

	public function action_index()
	{
		Casset::css('redactor.css');
		Casset::js('redactor.js');

        // TESTE de ENVIO DE EMAIL
        $_novoEmail = Email::forge();
        $_novoEmail->from('inscricoes@naturaco.org', 'Inscriçoes - Natura CO');
        $_novoEmail->to('andreoav@gmail.com', 'Andreo Vieira');
        $_novoEmail->subject('Teste de Envio');
        $_novoEmail->body('COnteudo do email');
        try
        {
            //$_novoEmail->send();
        }
        catch(\EmailValidationFailedException $e)
        {
            // The validation failed
        }
        catch(\EmailSendingFailedException $e)
        {
            // The driver could not send the email
            echo $e->getMessage();
        }
        // TESTE DE ENVIO DE EMAIL

		$this->template->conteudo = View::forge('admin/email/index');
	}
}
