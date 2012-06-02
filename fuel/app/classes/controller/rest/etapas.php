<?php

/**
*
*/
class Controller_Rest_Etapas extends Controller_Rest
{
	public function get_cadastradas()
	{
		if (Sentry::check())
		{
			$_etapasData = Model_Etapa::find('all');

			$_returnData     = array();
			foreach($_etapasData as $_etapa)
			{
				$_acoes  = Html::anchor('etapas/visualizar/' . $_etapa->id, 'Visualizar', array('class' => 'btn btn-primary btn-mini'));

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