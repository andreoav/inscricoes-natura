<?php

class Controller_Admin_Email extends Controller_Admin_Painel
{
	public function before()
	{
		parent::before();
	}

	public function action_index()
	{
		Casset::js('redactor.js');

		$this->template->conteudo = View::forge('admin/email/index');
	}
}
