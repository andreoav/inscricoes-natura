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

	public function action_aprovar($_inscricao_id = null)
	{
		if(($_inscricao = Model_Inscricao::find($_inscricao_id)) == null)
		{
			Session::set_flash('flash_msg', array(
				'msg_type'    => 'alert-error',
				'msg_content' => 'Não foi possível encontrar esta inscrição.'
			));
		}
		else
		{
			$_inscricao->status = Model_Inscricao::INSCRICAO_ACEITA;
			if($_inscricao->save())
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-success',
					'msg_content' => 'Inscrição aprovada com sucesso.'
				));
			}
			else
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-error',
					'msg_content' => 'Não foi possível aprovar esta inscrição.'
				));
			}

			Response::redirect('inscricoes/visualizar/' . $_inscricao_id);
		}

		Response::redirect('admin/inscricoes');
	}

	public function action_rejeitar($_inscricao_id = null)
	{
		if(($_inscricao = Model_Inscricao::find($_inscricao_id)) == null)
		{
			Session::set_flash('flash_msg', array(
				'msg_type'    => 'alert-error',
				'msg_content' => 'Não foi possível encontrar esta inscrição.'
			));
		}
		else
		{
			$_inscricao->status = Model_Inscricao::INSCRICAO_REJEITADA;
			if($_inscricao->save())
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-success',
					'msg_content' => 'Inscrição rejeitada com sucesso.'
				));
			}
			else
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-error',
					'msg_content' => 'Não foi possível rejeitar esta inscrição.'
				));
			}

			Response::redirect('inscricoes/visualizar/' . $_inscricao_id);
		}

		Response::redirect('admin/inscricoes');
	}


    /**
     * Métodos Rest
     */

    public function post_update()
    {
        if(Sentry::check() && Sentry::user()->is_admin())
        {
            $_inscricao_id = Input::post('inscricao_id');
            $_update_type  = Input::post('update_type');

            $result = DB::update('inscricoes')->set(array('status' => $_update_type))->where('id', '=',  $_inscricao_id)->execute();
            if($result)
            {
                $typeStr = $_update_type == 1 ? 'aprovada' : 'rejeitada';
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
        if(Sentry::check() && Sentry::user()->is_admin())
        {
            $_inscricoesData = Model_Inscricao::find('all', array(
                'where' => array(
                    'status' => Model_Inscricao::INSCRICAO_PENDENTE
                )
            ));

            $_returnData     = array();
            foreach($_inscricoesData as $_inscricao)
            {
                $_acoes  = Html::anchor('inscricoes/visualizar/' . $_inscricao->id, 'Visualizar', array('class' => 'btn btn-primary btn-mini'));
                $_acoes .= ' ' . Html::anchor('inscricoes/excluir/' . $_inscricao->id, 'Excluir', array('class' => 'btn btn-danger btn-mini'));
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
        if(Sentry::check() && Sentry::user()->is_admin())
        {
            $_returnData     = array();
            foreach(Model_Inscricao::find('all') as $_inscricao)
            {
                $_acoes  = Html::anchor('inscricoes/visualizar/' . $_inscricao->id, 'Visualizar', array('class' => 'btn btn-primary btn-mini'));
                $_acoes .= ' ' . Html::anchor('inscricoes/excluir/' . $_inscricao->id, 'Excluir', array('class' => 'btn btn-danger btn-mini'));
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