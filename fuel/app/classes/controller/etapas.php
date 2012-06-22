<?php

class Controller_Etapas extends Controller_Auth
{
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
        Casset::css('chosen.css');
        Casset::js('chosen.jquery.min.js');
        Casset::js('jquery.gmap.min.js');

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

        $this->template->conteudo = View::forge('etapas/visualizar');
        $this->template->conteudo->set('etapa_info', $_etapa_info);
        $this->template->conteudo->set('ja_inscrito', $_ja_inscrito);
        $this->template->conteudo->set('inscricoes_encerradas', $_etapa_info->inscricao_ate < time());
        $this->template->conteudo->set_global('localidade_map', $_etapa_info->localidade);
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
                $_acoes  = Html::anchor('etapas/visualizar/' . $_etapa->id, '<i class="icon-search icon-white"></i>', array(
                    'class' => 'btn btn-primary btn-mini',
                    'rel'   => 'tooltip',
                    'title' => 'Visualizar Inscrição'
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
}