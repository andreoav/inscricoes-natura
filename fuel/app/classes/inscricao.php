<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 19/06/12
 * Time: 19:12
 * To change this template use File | Settings | File Templates.
 */
abstract class Inscricao
{
    protected $etapa;
    protected $sheet;

    public function __construct($etapa)
    {
        $this->etapa = $etapa;
    }

    public function getSheet()
    {
        return $this->sheet;
    }

    abstract public function buildExcelFile();
    abstract protected function generateHeader();
    abstract protected function parseEtapa();
}
