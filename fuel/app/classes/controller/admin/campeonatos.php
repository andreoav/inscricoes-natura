<?php

class Controller_Admin_Campeonatos extends Controller_Admin_Painel
{
	public function before()
	{
		parent::before();
	}

	public function action_novo()
	{
		Casset::css('chosen.css');
		Casset::js('chosen.jquery.min.js');
		Casset::js('jquery.maskedinput-1.3.min.js');

		if(Input::method() == 'POST')
		{
			$_nome_campeonato = Input::post('campeonato_nome');

			$_novo_campeonato = new Model_Campeonato;
			$_novo_campeonato->nome = $_nome_campeonato;

			if($_novo_campeonato->save())
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-success',
					'msg_content' => 'Novo campeonato cadastrado com sucesso!'
				));
			}
			else
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-error',
					'msg_content' => 'Não foi possível cadastrar este campeonato.'
				));
			}

			Response::redirect('admin');
		}

		$this->template->conteudo = View::forge('admin/campeonatos/novo');
	}
}