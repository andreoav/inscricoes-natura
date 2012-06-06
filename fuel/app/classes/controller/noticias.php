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

    }

    /**
     * [action_visualizar description]
     * @param  [type] $_noticia_id [description]
     * @return [type]              [description]
     */
    public function action_visualizar($_noticia_id = null)
    {
    	if($_noticia_id == null || ($_noticia_info = Model_Noticia::find($_noticia_id)) == null)
		{
			Session::set_flash('flash_msg', array(
				'msg_type'    => 'alert-error',
				'msg_content' => '<strong>Não foi possível encontrar esta notícia.</strong>'
			));

			Response::redirect('home');
		}

		$data = array();
		$data['noticia_info'] = $_noticia_info;
		$this->template->conteudo = View::forge('noticias/visualizar', $data, false);
    }
}