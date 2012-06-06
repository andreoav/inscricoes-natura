<?php

class Controller_Etapas extends Controller_Home
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
		if($_etapa_id == null || ($_etapa_info = Model_Etapa::find($_etapa_id)) == null)
		{
			Session::set_flash('flash_msg', array(
				'msg_type'    => 'alert-error',
				'msg_content' => '<strong>Erro!</strong> Não foi possível encontrar esta etapa.'
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
			)
		));

		$data = array();
		$data['etapa_info']  = $_etapa_info;
		$data['ja_inscrito'] = $_ja_inscrito;
		$data['inscricoes_encerradas'] = $_etapa_info->inscricao_ate < time();

		View::set_global('localidade_map', $_etapa_info->localidade, false);
		$this->template->conteudo = View::forge('etapas/visualizar', $data);
	}
}