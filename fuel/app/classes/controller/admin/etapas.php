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

			var_dump($_etapa_inicio);
			var_dump($_etapa_final);
			var_dump($_etapa_inscricoes_ate);

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
				'msg_content' => 'Não foi possível encontrar esta etapa.'
			));

			Response::redirect('admin/etapas');
		}
        else
        {
            static::buildSheet($_etapa_info);
        }
	}

    public static function buildSheet(Model_Etapa $etapaInfo)
    {
        // Build spreadsheet
        require_once APPPATH . 'vendor/phpexcel/PHPExcel.php';

        $sheet = new PHPExcel();
        $sheet->getProperties()->setCreator(Config::get('sysconfig.app.name'))
                               ->setLastModifiedBy(Config::get('sysconfig.app.name'))
                               ->setTitle('Inscritos - Etapa: ' . $etapaInfo->nome);

        $sheet->setActiveSheetIndex(0);

        // Nome do compeonato
        $sheet->getActiveSheet()->setCellValue('A1', $etapaInfo->campeonato->nome);
        $sheet->getActiveSheet()->mergeCells('A1:G1');
        $sheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        $sheet->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $sheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        // Nome da etapa
        $sheet->getActiveSheet()->setCellValue('A2', $etapaInfo->nome . ' - ' . $etapaInfo->localidade . ' - ' . Date::forge($etapaInfo->data_inicio)->format('%d/%m/%Y'));
        $sheet->getActiveSheet()->mergeCells('A2:G2');
        $sheet->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        // Nome do clube
        $_richText = new PHPExcel_RichText();
        $_richText1 = $_richText->createTextRun('CLUBE: ');
        $_richText1->getFont()->setBold(true);
        $_richText->createText('Natura CO');
        $sheet->getActiveSheet()->getCell('A3')->setValue($_richText);
        $sheet->getActiveSheet()->mergeCells('A3:C3');

        // Estado
        $sheet->getActiveSheet()->setCellValue('D3', 'UF: RS');
        $sheet->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);

        // Email
        $sheet->getActiveSheet()->setCellValue('E3', 'Email: tesoureiro@naturaco.org');
        $sheet->getActiveSheet()->mergeCells('E3:G3');

        // Tecnico
        $sheet->getActiveSheet()->setCellValue('A4', 'Tecnico: ');
        $sheet->getActiveSheet()->mergeCells('A4:D4');
        $sheet->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);

        // Telefone
        $sheet->getActiveSheet()->setCellValue('E4', 'Tel/Cel: ');
        $sheet->getActiveSheet()->mergeCells('E4:G4');
        $sheet->getActiveSheet()->getStyle('E4')->getFont()->setBold(true);

        // Data Limite inscricoes
        $sheet->getActiveSheet()->setCellValue('A5', 'DATA LIMITE ' . Date::forge($etapaInfo->inscricao_ate)->format('%d/%m/%Y'));
        $sheet->getActiveSheet()->mergeCells('A5:G5');
        $sheet->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);
        $sheet->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        // Ord

        // Prepare to download
        require_once APPPATH . 'vendor/phpexcel/PHPExcel/IOFactory.php';
        $sheetWriter = PHPExcel_IOFactory::createWriter($sheet, 'Excel2007');

        //$sheetWriter->save('php://output');
        $savePath = DOCROOT . Config::get('sysconfig.app.upload_root') . Controller_Inscricoes::criarUploadPath($etapaInfo) . 'inscritos.xlsx';
        $sheetWriter->save($savePath);

        File::download($savePath, null, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    }
}

// End of admin/etapas.php