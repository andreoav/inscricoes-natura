<?php

/**
*
*/
class Controller_Admin_Inscricoes extends Controller_Admin_Painel
{
	public function before()
	{
		parent::before();
	}

	public function action_index()
	{
		$this->template->conteudo = View::forge('admin/inscricoes/index');
	}


    // ==================== REST ==================== //

    public function post_update()
    {
        if(Sentry::check() and Sentry::user()->is_admin())
        {
            $_inscricao_id = Input::post('inscricao_id');
            $_update_type  = Input::post('update_type');

            $result = DB::update('inscricoes')->set(array('status' => $_update_type))->where('id', '=',  $_inscricao_id)->execute();
            if($result)
            {
                $typeStr = $_update_type == 1 ? 'aprovada' : 'rejeitada';

                $_user = DB::select('user_id')->from('inscricoes')->where('id', '=', $_inscricao_id)->limit(1)->execute()->as_array();
                $_body  = '<p>Houve uma interação em seu pedido de inscrição.</p>';
                $_body .= '<p>Para visualizar a sua inscrição <a href="' . Uri::create('inscricoes/visualizar/' . $_inscricao_id) . '">clique aqui</a>.</p>';
                $_body .= '<br /><p>Natura Clube de Orientação - Sistema de Inscrição</p>';

                try
                {
                    $_notification = Email::forge();
                    $_notification->subject('Nova interação em sua inscrição');
                    $_notification->to(Sentry::user((int) $_user[0]['user_id'])->get('email'));
                    $_notification->body($_body);
                    $_notification->send();
                }
                catch(Exception $e)
                {
                    $this->response(array('valid' => true, 'msg' => 'Essa inscrição foi ' . $typeStr .' com sucesso.'), 200);
                }

                $this->response(array('valid' => true, 'msg' => 'Essa inscrição foi ' . $typeStr .' com sucesso.'), 200);
            }
            else
            {
                $this->response(array('valid' => false, 'msg' => 'Não foi possível atualizar esta inscrição.'), 200);
            }
        }
    }

    public function get_pendentes()
    {
        if(Sentry::check() and Sentry::user()->is_admin())
        {
            $_inscricoesData = Model_Inscricao::find('all', array(
                'where' => array(
                    'status' => Model_Inscricao::INSCRICAO_PENDENTE
                )
            ));

            $_returnData     = array();
            foreach($_inscricoesData as $_inscricao)
            {
                $_acoes  = Html::anchor('inscricoes/visualizar/' . $_inscricao->id, '<span class="iconb" data-icon="&#xe044;"></span>', array(
                    'class' => 'tablectrl_large bDefault tipS',
                    'title' => 'Visualizar Inscrição'
                ));

                $_tableData = array(
                    'id'         => $_inscricao->id,
                    'atleta'     => Sentry::user((int) $_inscricao->user->id)->get('metadata.nome'),
                    'etapa'      => $_inscricao->etapa->nome,
                    'campeonato' => $_inscricao->etapa->campeonato->nome,
                    'status'     => Utils::status2label($_inscricao->status),
                    'acoes'      => $_acoes
                );

                $_returnData[] = $_tableData;
            }

            $this->response(array('aaData' => $_returnData));
        }
    }

    public function get_inscricoes()
    {
        if(Sentry::check() and Sentry::user()->is_admin())
        {
            $_returnData     = array();
            foreach(Model_Inscricao::find('all') as $_inscricao)
            {
                $_acoes  = Html::anchor('inscricoes/visualizar/' . $_inscricao->id, '<span class="iconb" data-icon="&#xe044;"></span>', array(
                    'class' => 'tablectrl_large bDefault tipS',
                    'title' => 'Visualizar Inscrição'
                ));

                $_tableData = array(
                    'id'         => $_inscricao->id,
                    'atleta'     => Sentry::user((int) $_inscricao->user->id)->get('metadata.nome'),
                    'etapa'      => Html::anchor('etapas/visualizar/' . $_inscricao->etapa->id, $_inscricao->etapa->nome),
                    'campeonato' => $_inscricao->etapa->campeonato->nome,
                    'status'     => Utils::status2label($_inscricao->status),
                    'acoes'      => $_acoes
                );

                $_returnData[] = $_tableData;
            }

            $this->response(array('aaData' => $_returnData));
        }
    }
}