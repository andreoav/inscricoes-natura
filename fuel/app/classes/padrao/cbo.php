<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 19/06/12
 * Time: 19:34
 * To change this template use File | Settings | File Templates.
 */
// TODO: Procurar um modo para que o admin escolha uma ordem das colunas.
class Padrao_CBO extends Inscricao
{
    public static $myType = 2;

    public function buildExcelFile()
    {
        if( ! isset($this->etapa) )
        {
            return false;
        }

        // Build spreadsheet
        require_once APPPATH . 'vendor/phpexcel/PHPExcel.php';

        // Cria uma nova tabela
        $this->sheet = new PHPExcel();
        // Gera a informação inicial da tabela de inscricoes
        $this->generateHeader();
        // Preenche a planilha com as inscricoes
        $this->parseEtapa();


        // TODO: mudaar de lugar
        // Tamanho das colunas
        $this->sheet->getActiveSheet()->getColumnDimension('A')->setWidth(12);
        $this->sheet->getActiveSheet()->getColumnDimension('B')->setWidth(12);
        $this->sheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $this->sheet->getActiveSheet()->getColumnDimension('D')->setWidth(12);
        $this->sheet->getActiveSheet()->getColumnDimension('E')->setWidth(12);
        $this->sheet->getActiveSheet()->getColumnDimension('F')->setWidth(12);
        $this->sheet->getActiveSheet()->getColumnDimension('G')->setWidth(12);

        $sheetBorders = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                )
            )
        );
        $this->sheet->getActiveSheet()->getStyle('A1:G' . strval(6 + count($this->etapa->inscricoes)))->applyFromArray($sheetBorders);

        // Prepare to save
        require_once APPPATH . 'vendor/phpexcel/PHPExcel/IOFactory.php';
        // build save path
        $savePath = DOCROOT . Config::get('sysconfig.app.upload_root') . Controller_Inscricoes::criarUploadPath($this->etapa) . 'Inscritos[' . $this->etapa->nome . '].xlsx';

        // Save to disk
        $sheetWriter = PHPExcel_IOFactory::createWriter($this->getSheet(), 'Excel2007');
        $sheetWriter->save($savePath);

        // return saved path
        return $savePath;
    }

    protected function generateHeader()
    {
        $this->sheet->getProperties()->setCreator(Config::get('sysconfig.app.name'))
            ->setLastModifiedBy(Config::get('sysconfig.app.name'))
            ->setTitle('Inscritos - Etapa: ' . $this->etapa->nome);

        $this->sheet->setActiveSheetIndex(0);

        // Nome do compeonato
        $this->sheet->getActiveSheet()->setCellValue('A1', $this->etapa->campeonato->nome);
        $this->sheet->getActiveSheet()->mergeCells('A1:G1');
        $this->sheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
        $this->sheet->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->sheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // Fim Campeonato

        // Nome da etapa
        $this->sheet->getActiveSheet()->setCellValue('A2', $this->etapa->nome . ' - ' . $this->etapa->localidade . ' - ' . Date::forge($this->etapa->data_inicio)->format('%d/%m/%Y'));
        $this->sheet->getActiveSheet()->mergeCells('A2:G2');
        $this->sheet->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // Fim nome Etapa

        // Nome do clube
        $_richText = new PHPExcel_RichText();
        $_richText1 = $_richText->createTextRun('CLUBE: ');
        $_richText1->getFont()->setBold(true);
        $_richText->createText('Natura CO');

        $this->sheet->getActiveSheet()->getCell('A3')->setValue($_richText);
        $this->sheet->getActiveSheet()->mergeCells('A3:C3');
        // Fim do nome do Clube

        // Estado
        $this->sheet->getActiveSheet()->setCellValue('D3', 'UF: RS');
        $this->sheet->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
        // Fim Estado

        // Email
        $this->sheet->getActiveSheet()->setCellValue('E3', 'Email: tesoureiro@naturaco.org');
        $this->sheet->getActiveSheet()->mergeCells('E3:G3');
        $this->sheet->getActiveSheet()->getStyle('E3')->getFont()->setBold(true);
        // Fim email

        // Tecnico
        $this->sheet->getActiveSheet()->setCellValue('A4', 'Tecnico: ');
        $this->sheet->getActiveSheet()->mergeCells('A4:D4');
        $this->sheet->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
        // Fim Tecnico

        // Telefone
        $this->sheet->getActiveSheet()->setCellValue('E4', 'Tel/Cel: ');
        $this->sheet->getActiveSheet()->mergeCells('E4:G4');
        $this->sheet->getActiveSheet()->getStyle('E4')->getFont()->setBold(true);
        // Fim Telefone

        // Data Limite inscricoes
        $this->sheet->getActiveSheet()->setCellValue('A5', 'DATA LIMITE: ' . Date::forge($this->etapa->inscricao_ate)->format('%d/%m/%Y'));
        $this->sheet->getActiveSheet()->mergeCells('A5:G5');
        $this->sheet->getActiveSheet()->getStyle('A5')->getFont()->setSize(14);
        $this->sheet->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);
        $this->sheet->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // Fim limite inscricoes

        // Cabeçalho das inscricoes
        $this->sheet->getActiveSheet()->setCellValue('A6', 'Ord');
        $this->sheet->getActiveSheet()->getStyle('A6')->getFont()->setBold(true);
        $this->sheet->getActiveSheet()->getStyle('A6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // Fim cabeçalho das inscricoes

        // Numero de Registro
        $this->sheet->getActiveSheet()->setCellValue('B6', 'Reg.');
        $this->sheet->getActiveSheet()->getStyle('B6')->getFont()->setBold(true);
        $this->sheet->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // Fim numero de registro

        // Nome Completo
        $this->sheet->getActiveSheet()->setCellValue('C6', 'Nome Completo.');
        $this->sheet->getActiveSheet()->getStyle('C6')->getFont()->setBold(true);
        $this->sheet->getActiveSheet()->getStyle('C6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // Fim nome completo

        // Categoria
        $this->sheet->getActiveSheet()->setCellValue('D6', 'Categ.');
        $this->sheet->getActiveSheet()->getStyle('D6')->getFont()->setBold(true);
        $this->sheet->getActiveSheet()->getStyle('D6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // Fim categoria

        // CGO
        // TODO: Verificar o que é este campo
        $this->sheet->getActiveSheet()->setCellValue('E6', 'CGO');
        $this->sheet->getActiveSheet()->getStyle('E6')->getFont()->setBold(true);
        $this->sheet->getActiveSheet()->getStyle('E6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // Fim CGO

        // Inicio SICard
        $this->sheet->getActiveSheet()->setCellValue('F6', 'SICard');
        $this->sheet->getActiveSheet()->getStyle('F6')->getFont()->setBold(true);
        $this->sheet->getActiveSheet()->getStyle('F6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // Fim SICard

        // Anuidade
        $this->sheet->getActiveSheet()->setCellValue('G6', 'Anuidade');
        $this->sheet->getActiveSheet()->getStyle('G6')->getFont()->setBold(true);
        $this->sheet->getActiveSheet()->getStyle('G6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // Anuidade
    }

    protected function parseEtapa()
    {
        $contador = 1; $init = 6;
        $columnval = array(
            1 => 'A',
            2 => 'B',
            3 => 'C',
            4 => 'D',
            5 => 'E',
            6 => 'F',
            7 => 'G'
        );

        foreach($this->etapa->inscricoes as $inscricao)
        {
            // Usuário que realizou a inscrição
            $dono = Sentry::user((int) $inscricao->user->id);

            $column = 1; // Variavel de controle

            // Ord
            $this->sheet->getActiveSheet()->setCellValue($columnval[$column] . strval($contador + $init), $contador);
            $this->sheet->getActiveSheet()->getStyle($columnval[$column] . strval($contador + $init))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $column++;

            // Reg
            $this->sheet->getActiveSheet()->setCellValue($columnval[$column] . strval($contador + $init), $dono->get('metadata.numero_cbo'));
            $this->sheet->getActiveSheet()->getStyle($columnval[$column] . strval($contador + $init))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $column++;

            // Nome Completo
            $this->sheet->getActiveSheet()->setCellValue($columnval[$column] . strval($contador + $init), $dono->get('metadata.nome'));
            $this->sheet->getActiveSheet()->getStyle($columnval[$column] . strval($contador + $init))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $column++;

            // Categoria
            $this->sheet->getActiveSheet()->setCellValue($columnval[$column] . strval($contador + $init), $inscricao->categoria);
            $this->sheet->getActiveSheet()->getStyle($columnval[$column] . strval($contador + $init))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $column++;

            //CGO
            $this->sheet->getActiveSheet()->setCellValue($columnval[$column] . strval($contador + $init), '');
            $this->sheet->getActiveSheet()->getStyle($columnval[$column] . strval($contador + $init))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $column++;

            //SICARD
            $this->sheet->getActiveSheet()->setCellValue($columnval[$column] . strval($contador + $init), $dono->get('metadata.sicard'));
            $this->sheet->getActiveSheet()->getStyle($columnval[$column] . strval($contador + $init))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $column++;

            //Anuidade
            $this->sheet->getActiveSheet()->setCellValue($columnval[$column] . strval($contador + $init), '');
            $this->sheet->getActiveSheet()->getStyle($columnval[$column] . strval($contador + $init))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $contador++;
        }
    }
}