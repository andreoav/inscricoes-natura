<?php
return array(
    /* Home Controller */
	'_root_'  => 'auth/login',  // The default route
	'_404_'   => 'home/404',    // The main 404 route

    /* Auth Controller */
    'login' => 'auth/login',
    'logout' => 'auth/logout',

    // rota para resetar a senha
    'recuperar-senha' => 'auth/recuperar_senha',
    'recuperar-senha/(:alnum)/(:alnum)' => 'auth/recuperar_senha/$1/$2',

    'admin' => 'admin/painel',
    'cadastro' => 'home/cadastro',
    'perfil'   => 'usuario/perfil',
    'faq'      => 'home/faq',
    'fale-conosco' => 'home/faleconosco',

    // Routing para visualização da notícia
    'noticias/(:num)' => 'noticias/visualizar/$1',
);