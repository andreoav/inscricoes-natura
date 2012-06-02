<?php
return array(
    /* Home Controller */
	'_root_'  => 'auth/login',  // The default route
	'_404_'   => 'home/404',    // The main 404 route

    /* Auth Controller */
    'login' => 'auth/login',
    'logout' => 'auth/logout',

    'admin' => 'admin/painel',
);