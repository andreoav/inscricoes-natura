<?php

class Controller_Etapas extends Controller_Auth
{
    public $template = 'template';

    public function before()
    {
        parent::before();
    }

    public function action_index()
    {
        $this->template->conteudo = View::forge('etapas/index');
    }

    public function action_visualizar($_etapa_id = null)
    {
        if($_etapa_id == null || ($_etapa_info = Model_Etapa::find($_etapa_id)) == null)
        {
            Session::set_flash('flash_msg', array(
                'msg_type'    => 'alert-error',
                'msg_content' => 'Não foi possível encontrar esta etapa.'
            ));

            Response::redirect('etapas');
        }

        $_ja_inscrito = Model_User::find('all', array(
            'related' => array(
                'inscricoes' => array(
                    'related' => array(
                        'etapa' => array(
                            'where' => array('id' => $_etapa_id)
                        )
                    )
                )
            ),
            'where' => array(
                'id' => Sentry::user()->get('id')
            )
        ));

        $_arquivos = DB::select("id", "nome")->from('boletins')->where('etapa_id', '=', $_etapa_id)->execute()->as_array();

        $this->template->conteudo = View::forge('etapas/visualizar');
        $this->template->conteudo->set('etapa_info', $_etapa_info);
        $this->template->conteudo->set('ja_inscrito', $_ja_inscrito);
        $this->template->conteudo->set('inscricoes_encerradas', $_etapa_info->inscricao_ate < time());
        $this->template->conteudo->set('arquivos', $_arquivos);
    }

    public function action_arquivo($_arquivo = null)
    {
        $_tmp = DB::select('nome', 'etapa_id')->from('boletins')->where('id', '=', $_arquivo)->limit(1)->execute()->as_array();
        $_etapa_nome = Inflector::friendly_title(Str::lower(Model_Etapa::find($_tmp[0]['etapa_id'])->nome));

        File::download(DOCROOT . Config::get('sysconfig.app.upload_root') . 'arquivos/' . $_etapa_nome . '/' . $_tmp[0]['nome']);
    }

    // ------------------- Métodos Rest ------------------- //

    /**
     * // TODO: Documentation
     */
    public function get_cadastradas()
    {
        if (Sentry::check())
        {
            $_etapasData = Model_Etapa::find('all');

            $_returnData     = array();
            foreach($_etapasData as $_etapa)
            {
                $_acoes  = Html::anchor('etapas/visualizar/' . $_etapa->id, '<span class="iconb" data-icon="&#xe044;"></span>', array(
                    'class' => 'tablectrl_large bDefault tipS',
                    'title' => 'Visualizar Etapa'
                ));

                if($_etapa->inscricao_ate < time())
                {
                    $_status = '<span class="label label-important">Encerradas</span>';
                }
                else
                {
                    $_status = '<span class="label label-success">Abertas</span>';
                }

                $_tableData = array(
                    'id'         => $_etapa->id,
                    'nome'       => $_etapa->nome,
                    'campeonato' => $_etapa->campeonato->nome,
                    'localidade' => $_etapa->localidade,
                    'status'     => $_status,
                    'acoes'      => $_acoes
                );

                $_returnData[] = $_tableData;
            }

            $this->response(array('aaData' => $_returnData));
        }
    }

    public function post_informacaoEtapa()
    {
        if(Input::method() == 'POST' and Input::is_ajax())
        {
            $_etapa_id = Input::post('etapa_id');

            if(($etapa = Model_Etapa::find($_etapa_id)))
            {
                $data = array(
                    'valid'      => true,
                    'localidade' => $etapa->localidade,
                    'inicio'     => $etapa->data_inicio,
                    'fim'        => $etapa->data_final,
                    'ate'        => $etapa->inscricao_ate,
                );

                $this->response($data);
            }
            else
            {
                $this->response(array('valid' => false));
            }
        }
    }

}