<?php

/**
 * 
 */
class Controller_Noticias extends Controller_Auth
{
	public $template = 'template';

    public function before()
    {
        parent::before();
    }

    public function action_index()
    {
        $this->template->conteudo = View::forge('noticias/index');
    }

    public function action_visualizar($_noticia_id = null)
    {
    	if($_noticia_id == null || ($_noticia_info = Model_Noticia::find_one_by_id($_noticia_id)) == null)
		{
			Session::set_flash('flash_msg', array(
				'msg_type'    => 'alert-error',
				'msg_content' => 'Não foi possível encontrar esta notícia.'
			));

			Response::redirect('home');
		}

		$this->template->conteudo = View::forge('noticias/visualizar');
        $this->template->conteudo->set('noticia_info', $_noticia_info, false);
    }
}