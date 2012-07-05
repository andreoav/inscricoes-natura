<?php

class Controller_Admin_Usuarios extends Controller_Admin_Painel
{
    // TODO: Página dos usuários
    public function before()
    {
        parent::before();
    }

    /**
     * Rendezira a lista de usuários cadastrados no sistema
     *
     * @author  Andreo Vieira <andreoav@gmail.com>
     * @since   v1.0
     * @version v1.0
     * @returns Renderiza a página de administração dos usuarios cadastrados
     */
    public function action_index()
    {
        $_usuarios = Model_User::find('all', array('limit' => 10));
        $_countUsuarios = Model_User::count();
    }
}
