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

	public function action_nova()
	{
		Casset::css('chosen.css');
		Casset::js('chosen.jquery.min.js');
		Casset::js('jquery.maskedinput-1.3.min.js');

		if(Model_Campeonato::count() < 1)
		{
			Session::set_flash('flash_msg', array(
				'msg_type'    => 'alert-error',
				'msg_content' => 'Atualmente não existe uma campeonato cadastrado no sistema!'
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

			if($_nova_etapa->save())
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-success',
					'msg_content' => 'Nova etapa cadastrada com sucesso.'
				));
			}
			else
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-error',
					'msg_content' => 'Não foi possível cadastrar esta etapa.'
				));
			}

			Response::redirect('admin');
		}

		$this->template->conteudo = View::forge('admin/etapas/nova');
        $this->template->conteudo->set('campeonatos', Model_Campeonato::find('all'));
	}

    // TODO: Implementar a exclusão de uma etapa
	public function action_excluir($_etapa_id = null)
	{
        if(Input::method() == 'POST')
        {

        }

        Response::redirect('etapas/visualizar/' . $_etapa_id);
	}

    /**
     * TODO: DOC
     * TODO: Maneira genérica de modelo onde o administrador pode escolher a ordem das colunas
     *
     * @param null $_etapa_id   ID da etapa que deseja-se obter a lista de atletas inscritos
     * @param int  $_formato    Modelo que será gerado o arquivo de atletas inscritos
     */
    public function action_inscritos($_etapa_id = null, $_formato = 1)
	{
		if($_etapa_id == null)
		{
			Session::set_flash('flash_msg', array(
				'msg_type'    => 'alert-error',
				'msg_content' => 'Não foi possível encontrar esta etapa.'
			));

			Response::redirect('admin/etapas');
		}
        else
        {
            $_etapa_info = Model_Etapa::find($_etapa_id, array(
                'related' => array(
                    'inscricoes' => array(
                        'where' => array('status' => Model_Inscricao::INSCRICAO_ACEITA)
                    )
                )
            ));

            if($_etapa_info != null)
            {
                switch($_formato)
                {
                    // Modelo da FGO
                    case Padrao_FGO::$myType:
                        $sheetModel = new Padrao_FGO($_etapa_info);
                    break;

                    // Modelo da CBO
                    case 2:
                        // TODO: Gerar modelo da CBO
                    break;
                }

                $sheetPath = $sheetModel->buildExcelFile();
                File::download($sheetPath, null, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            }
            else
            {
                Session::set_flash('flash_msg', array(
                    'msg_type'    => 'alert-error',
                    'msg_content' => 'Não foi efetuada nenhuma inscrição nesta estapa.'
                ));

                Response::redirect('etapas/visualizar/' . $_etapa_id);
            }
        }
	}
}
// End of admin/etapas.php