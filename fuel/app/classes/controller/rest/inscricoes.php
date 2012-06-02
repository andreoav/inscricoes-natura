<?php

class Controller_Rest_Inscricoes extends Controller_Rest
{
	public function get_minhas_inscricoes()
	{
		if(Sentry::check())
		{
			$_inscricoesData = Model_User::find(Sentry::user()->get('id'))->inscricoes;

			$_returnData     = array();
			foreach($_inscricoesData as $_inscricao)
			{
				$_acoes  = Html::anchor('inscricoes/visualizar/' . $_inscricao->id, 'Visualizar', array('class' => 'btn btn-primary btn-mini'));
				$_acoes .= ' ' . Html::anchor('inscricoes/excluir/' . $_inscricao->id, 'Excluir', array('class' => 'btn btn-danger btn-mini'));

				$_tableData = array(
					'id'         => $_inscricao->id,
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
}