<?php
    $routes = array(
		'Httpstatus' => [
			'home' => '/',
			'add' => '/add',
			'view' => '/view/{id}',
			'login' => '/connexion',
			'logout' => '/deconnexion',
			'admin' => '/admin',
			'delete' => '/delete/{id}',
			'update' => '/update/{id}'
        ],

        'Api' => [
        	'home' => '/api/',
        	'list' => '/api/list',
        	'insert' => '/api/add',
        	'delete' => '/api/delete/{id}'
        ]
    );

    define('ROUTES', $routes);
