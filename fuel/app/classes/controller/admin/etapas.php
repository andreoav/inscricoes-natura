<?php
/**
* 
*/
class Controller_Admin_Etapas extends Controller_Admin_Painel
{
	public function before()
	{
		parent::before();
	}

	public function action_index()
	{
		$this->template->conteudo = View::forge('admin/etapas/index');
	}

	/**
	 * Cadastra uma nova etapa no sistema
	 * @return [type] [description]
	 */
	public function action_nova()
	{
		Casset::css('chosen.css');
		Casset::js('chosen.jquery.min.js');
		Casset::js('jquery.maskedinput-1.3.min.js');

		if(Model_Campeonato::count() < 1)
		{
			Session::set_flash('flash_msg', array(
				'msg_type'    => 'alert-error',
				'msg_content' => '<strong>Erro!</strong> Atualmente não existe uma campeonato cadastrado no sistema!'
			));

			Response::redirect('admin');
		}

		if(Input::method() == 'POST')
		{
			$_etapa_campeonato     = Model_Campeonato::find((int) Input::post('etapa_campeonato'));
			$_etapa_nome           = Input::post('etapa_nome');
			$_etapa_localidade     = Input::post('etapa_localidade');
			$_etapa_inicio         = Utils::data2unix(Input::post('etapa_inicio'));
			$_etapa_final          = Utils::data2unix(Input::post('etapa_final'));
			$_etapa_inscricoes_ate = Utils::data2unix(Input::post('etapa_inscricoes_ate'));

			$_nova_etapa                = new Model_Etapa;
			$_nova_etapa->nome          = $_etapa_nome;
			$_nova_etapa->localidade    = $_etapa_localidade;
			$_nova_etapa->data_inicio   = $_etapa_inicio;
			$_nova_etapa->data_final    = $_etapa_final;
			$_nova_etapa->inscricao_ate = $_etapa_inscricoes_ate;
			$_nova_etapa->campeonato    = $_etapa_campeonato;

			var_dump($_etapa_inicio);
			var_dump($_etapa_final);
			var_dump($_etapa_inscricoes_ate);

			if($_nova_etapa->save())
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-success',
					'msg_content' => '<strong>Nova etapa cadastrada com sucesso!</strong>'
				));
			}
			else
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-error',
					'msg_content' => '<strong>Erro!</strong> Não foi possível cadastrar esta etapa.'
				));
			}

			Response::redirect('admin');
		}

		$data = array();
		$data['campeonatos'] = Model_Campeonato::find('all');
		$this->template->conteudo = View::forge('admin/etapas/nova', $data);
	}

	/**
	 * [action_excluir description]
	 * @param  [type] $_etapa_id [description]
	 * @return [type]            [description]
	 */
	public function action_excluir($_etapa_id = null)
	{

	}

	public function action_inscritos($_etapa_id = null)
	{
		if($_etapa_id == null || ($_etapa_info = Model_Etapa::find($_etapa_id)) == null)
		{
			Session::set_flash('flash_msg', array(
				'msg_type'    => 'alert-error',
				'msg_content' => '<strong>Erro!</strong> Não foi possível encontrar esta etapa.'
			));

			Response::redirect('admin/etapas');
		}

		$_html_table = View::forge('admin/etapas/inscritos', array('etapa_info' => $_etapa_info));
		/*$_response = new Response();
		$_response->set_header('Content-Type', 'application/vnd.ms-excel');
		$_response->set_header('Content-Type', 'application/force-download');
		$_response->set_header('Content-Disposition', 'attachment; filename=teste.xls');
		$_response->set_header('Pragma', 'no-cache');*/
	}
}

// End of admin/etapas.php