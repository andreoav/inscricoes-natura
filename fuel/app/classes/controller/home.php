<?php

class Controller_Home extends Controller_Auth
{
    public $template = 'template';

    public function before()
    {
        parent::before();
    }

    public function action_index()
    {
        $data = array();
        $data['minhas_inscricoes'] = Model_User::find(Sentry::user()->get('id'))->inscricoes;
        $this->template->conteudo = \View::forge('home/index', $data);
    }

    public function action_saibamais()
    {
        $this->template->conteudo = \View::forge('home/saibamais');
    }
}