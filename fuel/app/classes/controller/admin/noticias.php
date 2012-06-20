<?php

class Controller_Admin_Noticias extends Controller_Admin_Painel
{
	public function before()
	{
		parent::before();
	}

	public function action_nova()
	{
        Casset::css('redactor.css');
        Casset::js('redactor.js');

		if(Input::method() == 'POST')
		{
			$_noticia_titulo   = Input::post('noticia_titulo');
			$_noticia_conteudo = Input::post('noticia_conteudo');

			$_nova_noticia           = new Model_Noticia;
			$_nova_noticia->titulo   = $_noticia_titulo;
			$_nova_noticia->conteudo = $_noticia_conteudo;
			$_nova_noticia->user     = Model_User::find(Sentry::user()->get('id'));

			if($_nova_noticia->save())
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-success',
					'msg_content' => 'Nova notícia inserida com sucesso.'
				));
			}
			else
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-error',
					'msg_content' => 'Não foi possível inserir esta notícia.'
				));
			}

            Response::redirect('admin/painel');
		}

        $this->template->conteudo = View::forge('admin/noticias/nova');
	}

	public function action_editar($_noticia_id = null)
	{
		# code...
        $this->template->conteudo = View::forge('admin/noticias/editar');
	}

	public function action_excluir($_noticia_id = null)
	{
		# code...
	}
}