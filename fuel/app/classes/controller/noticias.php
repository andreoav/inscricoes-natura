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
        $_noticias = DB::select('*')->from('noticias')->order_by('id', 'desc')->limit(5)->execute()->as_array();

        $this->template->conteudo = View::forge('noticias/index');
        $this->template->conteudo->set('noticias', $_noticias, false);
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


    public function post_loadMore()
    {
        if(Sentry::check())
        {
            try
            {
                $_last_id = (int) Input::post('last_id');
                $_more_result = DB::select('*')->from('noticias')->where('id', '<', $_last_id)->order_by('id', 'desc')->limit(5)->execute()->as_array();

                $_new_last_id = null;
                if($_more_result)
                {
                    $_new_last_id = array(Arr::get(end($_more_result), 'id'));
                }

                $this->response(array('valid' => true, 'news' => $_more_result, 'last_id' => $_new_last_id));
            }
            catch(Exception $e)
            {
                $this->response(array('valid' => false, 'msg' => 'Ocorreu um erro ao carregar as notícias.'));
            }
        }
    }
}